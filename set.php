<?php
  // Add Scripts
  function cal_add_scripts(){
     // Add CSS
     wp_enqueue_style('cal-main-style', plugins_url(). '/cal/css/main.css');

     // Add JSP
     wp_enqueue_script('cal-main-script', plugins_url(). '/cal/js/main.js');
   }


  // Hoow Function
  add_action('wp_enqueue_scripts', 'cal_add_scripts');
