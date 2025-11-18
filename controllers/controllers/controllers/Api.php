<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends AppController{
    public function __construct(){ parent::__construct(); $this->load->model('timesheet_selfie_model'); }
    public function punch(){
        $this->check_ip();
        $staffid = (int)$this->input->post('staffid');
        $action  = $this->input->post('action');
        if (!$staffid || !$action) exit_json(['success'=>0,'msg'=>'Missing data']);
        $staff = $this->db->where('staffid',$staffid)->get(db_prefix().'staff')->row();
        if (!$staff) exit_json(['success'=>0,'msg'=>'Invalid staff']);
        if (get_option('timesheet_selfie_geofence')==1){
            $dist = $this->distance($this->input->post('lat'),$this->input->post('lng'),get_option('timesheet_selfie_lat'),get_option('timesheet_selfie_lng'));
            if ($dist > (int)get_option('timesheet_selfie_radius')) exit_json(['success'=>0,'msg'=>'Outside allowed location']);
        }
        $selfie_name = null;
        if (!empty($_FILES['selfie']['name'])){
            $this->load->library('upload');
            $config['upload_path']   = TIMESHEET_SELFIE_SELFIE_PATH;
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name']     = $staffid.'_'.time().'.jpg';
            $this->upload->initialize($config);
            if ($this->upload->do_upload('selfie')) $selfie_name = $this->upload->data('file_name');
        }
        $this->timesheet_selfie_model->add_log([
            'staffid'=>$staffid,'action'=>$action,'selfie_file'=>$selfie_name,
            'ip'=>$this->input->ip_address(),'lat'=>$this->input->post('lat'),'lng'=>$this->input->post('lng')
        ]);
        $voice = '';
        if ($action=='in'){
            $voice = get_option('timesheet_selfie_voice_in');
            $first = $this->timesheet_selfie_model->first_in_today($staffid);
            if ($first && strtotime($first->datetime)>strtotime(date('Y-m-d').' 09:30:00')) $voice = get_option('timesheet_selfie_voice_late');
        }
        if ($action=='out')      $voice = get_option('timesheet_selfie_voice_out');
        if ($action=='break_start') $voice = get_option('timesheet_selfie_voice_break');
        if ($action=='lunch_start') $voice = get_option('timesheet_selfie_voice_lunch');
        $voice = str_replace('{name}', $staff->firstname, $voice);
        exit_json(['success'=>1,'voice'=>$voice]);
    }
    private function distance($lat1,$lon1,$lat2,$lon2){
        $theta = $lon1 - $lon2;
        $dist  = acos(sin(deg2rad($lat1))*sin(deg2rad($lat2)) + cos(deg2rad($lat1))*cos(deg2rad($lat2))*cos(deg2rad($theta)));
        return rad2deg($dist)*60*1.1515*1609.344;
    }
}
