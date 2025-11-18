<?php
defined('BASEPATH') or exit('No direct script access allowed');
$db->query("DROP TABLE IF EXISTS `".db_prefix()."timesheet_selfie`;");
foreach(['ip_whitelist','voice_in','voice_out','voice_break','voice_lunch','voice_late','geofence','lat','lng','radius'] as $k){
    delete_option('timesheet_selfie_'.$k);
}
