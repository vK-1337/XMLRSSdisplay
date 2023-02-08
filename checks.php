<?php
 function linksCheck() {
  return $_COOKIE['mode'] === 'night' ? 'linkBtnNight' : 'linkBtnDay';
 }

 function cardsCheck() {
  return $_COOKIE['mode'] === 'night' ? 'nightCard textFormat' : 'dayCard textFormat';
 }

 function descriptionCheck() {
  return $_COOKIE['mode'] === 'night' ? 'cardRightSideNight ' : 'cardRightSideDay ';
 }
?>
