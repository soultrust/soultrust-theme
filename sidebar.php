<div class="categories">
  <h2>Categories</h2>
  <ul class="categories-list links-list">
  <?php
  $categories = get_categories();
  if ( $categories ) :
    foreach ( $categories as $category ) : ?>
        <li><a href="<?php echo esc_url( get_tag_link( $category->term_id ) ); ?>" title="<?php echo esc_attr( $category->name ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
    <?php endforeach; ?>
  <?php endif; ?>
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


<ul>
    <?php
