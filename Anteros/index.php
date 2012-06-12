<?php get_header(); ?>
<div class="container">
  <?php 
    if ( function_exists( 'meteor_slideshow' ) ) { 
    meteor_slideshow(); 
    }
    ?>
  <div id="content_area" class="block">
    <div class="block_inside">
      <?php 
        if( have_posts () ) : 
        while( have_posts () ) : 
        the_post(); 
        ?>
      <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?></a></h2>
        <small>on <?php the_time('M d'); ?> in 
          <?php the_category( ', ' ); ?> tagged 
          <?php the_tags( '' ); ?> by 
          <?php the_author_posts_link(); ?>
        </small>
      <?php the_content('Read More'); ?>
        <div class="separator biggap"></div>
      <?php endwhile ?>
        <div id="posts_navigation">
          <?php previous_posts_link(); next_posts_link(); 
            ?>
        </div>
      <?php else : ?>
        <h2 class="center">Not Found</h2>
        <p class="center">Sorry, but you are looking for something that isn't here.</p>
      <?php endif; ?><!-- </ul> -->
    </div>
  </div>
<?php get_footer(); ?>