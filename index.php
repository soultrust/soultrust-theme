<?php
get_header();
?>
<h2><?php wp_title( '' ); ?></h2>
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
