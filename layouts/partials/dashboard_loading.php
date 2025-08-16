<?php
// Dashboard Loading Overlay
?>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
.loader {
  height: 4px;
  width: 130px;
  --c:no-repeat linear-gradient(#6100ee 0 0);
  background: var(--c),var(--c),#d7b8fc;
  background-size: 60% 100%;
  animation: l16 3s infinite;
}
@keyframes l16 {
  0%   {background-position:-150% 0,-150% 0}
  66%  {background-position: 250% 0,-150% 0}
  100% {background-position: 250% 0, 250% 0}
}
</style>

<div id="dashboard-loading" class="fixed inset-0 bg-white bg-opacity-80 flex items-center justify-center z-50">
  <div class="flex flex-col items-center">
    <div class="loader"></div>
  </div>
</div>
<script>
window.addEventListener('load', function() {
  setTimeout(function() {
    document.getElementById('dashboard-loading').style.display = 'none';
  }, 900); // Show for 0.9 seconds
});
</script>