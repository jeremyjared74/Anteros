<?php get_header(); ?>
<div class="container">
  <div id="content_area" class="block">
    <div class="block_inside">
      <?php if ( have_posts () ) : while ( have_posts () ) : the_post(); ?>
        <h2><?php the_title(); ?></h2>
      <?php the_content(''); ?>
        <div class="separator biggap"></div>
      <?php endwhile; else : ?>
        <h2 class="center">Not Found</h2>
        <p class="center">Sorry, but you are looking for something that isn't here.</p>
      <?php endif; ?><!--/close loop-->
    </div>
  </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>