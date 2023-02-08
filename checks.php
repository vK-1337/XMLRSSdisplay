<?php
function modeCheck($url) {
  return empty($_GET['mode']) || $_GET['mode'] === 'day' ? "$url?mode=day" : "$url?mode=night";
}
?>
