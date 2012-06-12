<div class="sidebar">
  <div class="widget-wrapper">
    <div class="top-sidebar">
      <?php if ( function_exists ( dynamic_sidebar( 1 ) ) ) :dynamic_sidebar ( 1 ); 
        endif;
      ?>
    </div>
  </div>
  <div class="widget-wrapper">
    <div class="bottom-sidebar">
      <?php if ( function_exists ( dynamic_sidebar ( 2 ) ) ) : dynamic_sidebar (2);
        endif; 
      ?>
    </div>
  </div><!-- .sidebar -->
  <?php
    $children = wp_list_pages( 'title_li=&child_of=' . $post->ID . '&echo=0' );
    if ( $children ) { ?>
    <ul><?php echo $children; ?></ul><?php 
    } ?>
</div>