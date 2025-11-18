<!DOCTYPE html><html><head><meta charset="utf-8"><title>Clock In / Out</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="<?= module_dir_url('timesheet_selfie','assets/css/kiosk.css') ?>"></head>
<body>
<div class="wrap">
<h1 id="banner">Tap action & scan selfie</h1>
<div class="btn-grid">
<button data-action="in" class="act-btn green">CLOCK IN</button>
<button data-action="out" class="act-btn red">CLOCK OUT</button>
<button data-action="break_start" class="act-btn blue">BREAK</button>
<button data-action="lunch_start" class="act-btn orange">LUNCH</button>
</div>
<div id="cam-box"><video id="video" autoplay playsinline></video><canvas id="canvas" style="display:none"></canvas></div>
<select id="staffSelect"><?php foreach(get_staff() as $s){
echo '<option value="'.$s['staffid'].'">'.$s['firstname'].' '.$s['lastname'].'</option>'; } ?></select>
<button id="snapBtn" disabled>Take Selfie & Save</button>
<div id="voice" class="hidden"></div>
</div>
<script src="<?= module_dir_url('timesheet_selfie','assets/js/kiosk.js') ?>"></script>
</body></html>
