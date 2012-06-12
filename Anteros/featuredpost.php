<div id="block_featuredblog" class="block">
  <img src="<?php get_template_directory_uri( ); ?>/images/ribbon_featured.png" class="ribbon" alt="Featured Project"/>
  <div class="block_inside">
    <?php
      $featured = new WP_Query();
      $featured->query( 'showposts=1&cat=-'.BLOG) ; // Category 1 is the Blog Posts, so we remove that
      while( $featured->have_posts( ) ) : $featured->the_post();
      $wp_query->in_the_loop = true; // so the_tags('') will work outside the regular loop.
      $featured_ID = $post->ID; // skip this post in the main loop
      ?>
    <?php if ( get_post_meta( $post->ID, 'large_preview', true )) { 
      ?>
      <div class="image_block">
        <img src="<?php echo get_post_meta( $post->ID, 'large_preview', true ); ?>" alt="Featured Post" />
      </div>
    <?php } ?>
    
      <div class="text_block">
        <h2><a href="<?php the_permalink( ); ?>" title="<?php the_title( ); ?>"><?php the_title( ); ?></a></h2>
        <small>in <?php the_category(', '); ?> tagged <?php the_tags(''); ?></small>
        <?php the_content( 'Read More' ); ?>
      </div>
    <?php endwhile; ?>
  </div>
</div>