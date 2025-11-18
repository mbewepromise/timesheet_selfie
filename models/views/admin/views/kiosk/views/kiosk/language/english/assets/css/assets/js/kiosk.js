const uploadUrl = "<?= site_url('timesheet_selfie/api/punch') ?>";
const staffid   = document.getElementById('staffSelect');
const video     = document.getElementById('video');
const canvas    = document.getElementById('canvas');
const snapBtn   = document.getElementById('snapBtn');
const banner    = document.getElementById('banner');
const voiceDiv  = document.getElementById('voice');
let currentAction = '';
navigator.mediaDevices.getUserMedia({video:true})
.then(stream=>{ video.srcObject=stream; snapBtn.disabled=false; })
.catch(err=>{ alert('Camera error'); });
document.querySelectorAll('.act-btn').forEach(btn=>{
   btn.onclick = ()=>{ currentAction = btn.dataset.action; banner.textContent='Action: '+currentAction; };
});
snapBtn.onclick = ()=>{
   if(!currentAction){ alert('Choose action first'); return; }
   canvas.width = video.videoWidth; canvas.height=video.videoHeight;
   canvas.getContext('2d').drawImage(video,0,0);
   canvas.toBlob(blob=>{
      let fd = new FormData();
      fd.append('selfie', blob, 'selfie.jpg');
      fd.append('staffid', staffid.value);
      fd.append('action', currentAction);
      fd.append('lat', ''); fd.append('lng', '');
      fetch(uploadUrl,{method:'POST',body:fd})
      .then(r=>r.json())
      .then(j=>{ if(j.success){ speak(j.voice); setTimeout(()=>location.reload(),2500); }else{ alert(j.msg||'Error'); } });
   }, 'image/jpeg');
};
function speak(text){
   const u = new SpeechSynthesisUtterance(text); u.rate = 0.9;
   speechSynthesis.speak(u); voiceDiv.textContent = text; voiceDiv.classList.remove('hidden');
}
