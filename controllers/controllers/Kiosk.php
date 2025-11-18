<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kiosk extends AppController{
    public function __construct(){ parent::__construct(); $this->load->model('timesheet_selfie_model'); }
    public function index(){ $this->check_ip(); $this->load->view('kiosk/check'); }
    private function check_ip(){
        $list = get_option('timesheet_selfie_ip_whitelist');
        if (!$list) return;
        $allowed = array_map('trim', explode(',', $list));
        if (!in_array($this->input->ip_address(), $allowed)) show_error('Kiosk not allowed from this IP');
    }
}
