<?php
 function classCheck() {
  return $_COOKIE['mode'] === 'night' ? 'linkBtnNight' : 'linkBtnDay';
 }

 function cardsCheck() {
  return $_COOKIE['mode'] === 'night' ? 'nightCard textFormat' : 'dayCard textFormat';
 }
?>
