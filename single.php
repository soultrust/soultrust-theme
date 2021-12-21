<?php

get_header();

while(have_posts()) {
  the_post(); ?>
  <h2><?php the_title(); ?></h2>
  <?php the_content(); ?>
  <div class="post-meta">
<?php
$taxonomy = 'category';

// Get the term IDs assigned to post.
$post_terms = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));

// Separator between links.
$separator = ', ';
$categoryIndex = array_search('1', $post_terms);

if ($categoryIndex !== '') {
  if ($categoryIndex === 0 || $categoryIndex > 0) {
    if (get_cat_name($post_terms[$categoryIndex]) === 'Uncategorized') {
      unset($post_terms[$categoryIndex]);
    }
  }
}

if (!empty($post_terms ) && !is_wp_error($post_terms)) {
  $terms = wp_list_categories(array(
    'title_li' => '',
    'style'    => 'none',
    'echo'     => false,
    'taxonomy' => $taxonomy,
    'include'  => $post_terms,
    'exclude'  => ['1']
  ));

  $terms = rtrim(trim(str_replace('<br />', $separator, $terms)), $separator);
?>
<span class="post-meta__categories">
  <span class="post-meta__key">categories:</span>
  <span class="post-meta__value">
  <?php // Display post categories.
    echo  $terms;
  ?>
  </span>
</span>
<?php
}
?>

	  <span class="tags">
      <?php the_tags( 
        '<span class="post-meta__key">tags:</span><span class="post-meta__value">', 
        ', ', 
        '</span>'
      ); ?>
    </span>
  </div>
  <?php 
}

get_footer();

?>