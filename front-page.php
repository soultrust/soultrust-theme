<?php
get_header();
?>

<ul class="links-list">
<?php
while(have_posts()) {
  the_post(); ?>
  <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
  <?php
} ?>
</ul>

<?php
get_sidebar();
get_footer();
