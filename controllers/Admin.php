<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends AdminController{
    public function __construct(){ parent::__construct(); $this->load->model('timesheet_selfie_model'); }
    public function settings(){
        if (!has_permission('settings','','view')) access_denied();
        if ($this->input->post()) {
            foreach(['ip_whitelist','voice_in','voice_out','voice_break','voice_lunch','voice_late','geofence','lat','lng','radius'] as $k)
                update_option('timesheet_selfie_'.$k, $this->input->post($k));
            set_alert('success', _l('settings_updated'));
            redirect(admin_url('timesheet_selfie/admin/settings'));
        }
        $data['log'] = $this->timesheet_selfie_model->get_log();
        $this->load->view('admin/settings', $data);
    }
}
