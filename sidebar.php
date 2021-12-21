<div class="categories">
  <h2>Categories</h2>

  <?php
    $terms = wp_list_categories(array(
      'title_li' => '',
      'style'    => 'list',
      'echo'     => false,
      'taxonomy' => 'category',
      'exclude'  => ['1']
    ));
  ?>
  <ul class="categories-list links-list">
  <?php echo $terms; ?>
  </ul>
</div>
<div class="tags">
  <h2>Tags</h2>
  <ul class="tags-list links-list">
    <?php
    $tags = get_tags();
    if ( $tags ) :
      foreach ( $tags as $tag ) : ?>
        <li><a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" title="<?php echo esc_attr( $tag->name ); ?>"><?php echo esc_html( $tag->name ); ?></a></li>
      <?php endforeach; ?>
    <?php endif; ?>
  </ul>
<div>

