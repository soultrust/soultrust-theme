<?php 

function phaedrus_files() {
  wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap');
  wp_enqueue_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
  wp_enqueue_style('phaedrus_main_styles', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'phaedrus_files');