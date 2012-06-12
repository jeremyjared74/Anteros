<?php get_header(); ?>
<div class="container"><div id="content_area" class="block">
  <div class="block_inside">
    <?php if ( have_posts () ): while ( have_posts () ): the_post(); ?>
    <div id="page">
    <h2><?php the_title(); ?></h2>
      <p>
        <span class="thedate">
          &nbsp;|&nbsp;<?php the_time( 'l, F jS, Y' ) ?> &nbsp;|&nbsp;Category:&nbsp;
          <?php the_category(', ') ?> &nbsp;|&nbsp;
          <?php the_content(); ?>
        </span>
      </p>
      <div class="navigation"><?php wp_link_pages(); ?>        
        <span class="left-link">
          <?php previous_post_link( '&#x300A; %link' ) ?>
        </span><div class="clearfix"></div>         
        <span class="right-link">
          <?php next_post_link( '%link &#x300B;' ) ?>
        </span><div class="separator biggap"></div>
      </div>
    </div>
    <?php endwhile; else: ?>
    <h2 class="center">Not Found</h2>
    <p class="center">Sorry, but you are looking for something that isn't here.</p>
    <?php endif; ?>
  </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>