<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head() ?>
</head>
<body <?php body_class(); ?>>
<div class="site">
  <?php if (is_front_page() && is_home()) { ?>
    <h1><?php echo get_bloginfo('name'); ?></h1>
  <?php } else { ?>
  <h1>
    <a href="<?php echo esc_url(home_url('/')); ?>">
      <?php echo get_bloginfo('name'); ?>
    </a>
  </h1>
<?php } ?>