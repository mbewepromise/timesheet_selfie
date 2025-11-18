<?php
defined('BASEPATH') or exit('No direct script access allowed');
hooks()->add_action('admin_init', 'timesheet_selfie_admin_menu');
function timesheet_selfie_admin_menu(){
    $CI = &get_instance();
    $CI->app_menu->add_sidebar_menu_item('timesheet-selfie', [
        'name'     => _l('timesheet_selfie'),
        'href'     => admin_url('timesheet_selfie/admin/settings'),
        'position' => 10,
        'icon'     => 'fa fa-clock-o',
    ]);
}
