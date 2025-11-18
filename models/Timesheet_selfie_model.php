<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Timesheet_selfie_model extends App_Model{
    protected $table = 'timesheet_selfie';
    public function add_log($data){ $this->db->insert(db_prefix().$this->table, $data); return $this->db->insert_id(); }
    public function get_log($limit=500){
        return $this->db->select('t.*, s.firstname, s.lastname')
               ->from(db_prefix().$this->table.' t')
               ->join(db_prefix().'staff s','s.staffid=t.staffid')
               ->order_by('t.id','desc')->limit($limit)->get()->result_array();
    }
    public function first_in_today($staffid){
        $today = date('Y-m-d');
        return $this->db->where('staffid',$staffid)->where('action','in')->where('DATE(datetime)',$today)
               ->order_by('id','asc')->get(db_prefix().$this->table)->row();
    }
}
