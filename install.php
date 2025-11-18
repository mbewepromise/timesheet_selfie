<?php
defined('BASEPATH') or exit('No direct script access allowed');
$db_prefix = db_prefix();
$db->query("CREATE TABLE IF NOT EXISTS `{$db_prefix}timesheet_selfie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staffid` int(11) NOT NULL,
  `action` enum('in','out','break_start','break_end','lunch_start','lunch_end') NOT NULL,
  `selfie_file` varchar(255) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `lat` varchar(25) DEFAULT NULL,
  `lng` varchar(25) DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
add_option('timesheet_selfie_ip_whitelist','');
add_option('timesheet_selfie_voice_in','Hi {name}, you have signed in successfully.');
add_option('timesheet_selfie_voice_out','Goodbye {name}, have a nice day.');
add_option('timesheet_selfie_voice_break','Break started, enjoy.');
add_option('timesheet_selfie_voice_lunch','Lunch started, bon appétit.');
add_option('timesheet_selfie_voice_late','Welcome back, you are late.');
add_option('timesheet_selfie_geofence','0');
add_option('timesheet_selfie_lat','');
add_option('timesheet_selfie_lng','');
add_option('timesheet_selfie_radius','100');
