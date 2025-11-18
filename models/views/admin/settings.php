<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper"><div class="content"><div class="row"><div class="col-md-8 col-md-offset-2">
<div class="panel_s"><div class="panel-heading">Timesheet Selfie Settings</div><div class="panel-body">
<?= form_open(); ?>
<h5>IP Whitelist (comma separated, leave empty to allow all)</h5>
<?= render_input('ip_whitelist','',get_option('timesheet_selfie_ip_whitelist')); ?>
<h5>Voice Prompts (use {name} placeholder)</h5>
<?= render_input('voice_in','Clock In',get_option('timesheet_selfie_voice_in')); ?>
<?= render_input('voice_out','Clock Out',get_option('timesheet_selfie_voice_out')); ?>
<?= render_input('voice_break','Break Start',get_option('timesheet_selfie_voice_break')); ?>
<?= render_input('voice_lunch','Lunch Start',get_option('timesheet_selfie_voice_lunch')); ?>
<?= render_input('voice_late','Late Message',get_option('timesheet_selfie_voice_late')); ?>
<h5>Geofence (require GPS inside radius)</h5>
<?= render_select('geofence',[['id'=>0,'name'=>'Off'],['id'=>1,'name'=>'On']],['id','name'],'',get_option('timesheet_selfie_geofence')); ?>
<?= render_input('lat','Office Latitude',get_option('timesheet_selfie_lat')); ?>
<?= render_input('lng','Office Longitude',get_option('timesheet_selfie_lng')); ?>
<?= render_input('radius','Radius (meters)',get_option('timesheet_selfie_radius')); ?>
<button type="submit" class="btn btn-primary">Save</button>
<?= form_close(); ?>
<hr><h4>Last 50 punches</h4>
<div class="table-responsive">
<table class="table table-bordered dt-table">
<thead><tr><th>Staff</th><th>Action</th><th>Selfie</th><th>IP</th><th>Date</th></tr></thead>
<tbody>
<?php foreach($log as $l): ?>
<tr>
<td><?= $l['firstname'].' '.$l['lastname'] ?></td>
<td><?= $l['action'] ?></td>
<td><?php if($l['selfie_file']) echo '<a target="_blank" href="'.base_url('uploads/timesheet_selfie/'.$l['selfie_file']).'">View</a>'; ?></td>
<td><?= $l['ip'] ?></td>
<td><?= _dt($l['datetime']) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div></div></div></div></div></div></div>
<?php init_tail(); ?>
