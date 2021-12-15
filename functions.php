<?php 

function phaedrus_files() {
  wp_enqueue_style('phaedrus_main_styles', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'phaedrus_files');