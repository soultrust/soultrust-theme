<?php

get_header();

while(have_posts()) {
  the_post(); ?>
  <h2><?php the_title(); ?></h2>
  <?php the_content(); ?>
  <div class="post-meta">
    <span class="post-meta__categories">
      <span class="post-meta__key">categories:</span>
      <span class="post-meta__value">
      <?php

$taxonomy = 'category';
 
// Get the term IDs assigned to post.
$post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
 
// Separator between links.
$separator = ', ';
 
if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
 
    $term_ids = implode( ',' , $post_terms );
    // TODO: $post_terms is an array 
    // remove 1 (id for uncat) from array
    
    // foreach ($post_terms as &$id) {
      
    // }
 
    $terms = wp_list_categories( array(
        'title_li' => '',
        'style'    => 'none',
        'echo'     => false,
        'taxonomy' => $taxonomy,
        'include'  => $term_ids,
        'exclude'  => [1]
    ) );
 
    $terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
 
    // Display post categories.
    echo  $terms;
}
?>
   
      </span>
    </span>
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