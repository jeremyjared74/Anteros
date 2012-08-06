<?php
/*
Template Name: Slider
*/
get_header(); ?>
  <div id="photo-rotator">
    <?php
      $slide_id=1;
      $featuredPosts = new WP_Query();
      $featuredPosts->query( "showposts=4" );
      while ( $featuredPosts->have_posts() ) :
      $featuredPosts->the_post();
      ?>
      <div id="slide-<?php echo $slide_id; $slide_id++;?>">
        <a href="<?php the_permalink() ?>" class="post-image">
          <?php the_post_thumbnail( 'rotator-post-image' ); ?>
          <span class="title"><?php the_title(); ?></span>
        </a>
      </div><?php endwhile; ?><!--/close loop-->
      <?php $nav_id=1;
        while ( $featuredPosts->have_posts() ) :
        $featuredPosts->the_post();
        ?>
    <ul class="slide-nav">
      <li>
       <figure class="thumbnail">
          <a href="#slide-<?php echo $nav_id; ?>">
            <?php the_post_thumbnail( 'nav-image' ); ?>
            <?php the_title(); $nav_id++;?>
          </a>
      </figure>
      </li>
    </ul>
      <?php endwhile; ?><!--/close loop-->
  </div>
<div class="container">
  <div id="content_area" class="block">
    <div class="block_inside">
      <?php rewind_posts(); ?>
      <?php while (have_posts()) : the_post(); ?>
      <?php if ($post->ID != $slide_id) { ?>
      <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?></a></h2>
        <small>on <?php the_time('M d'); ?>
          in <?php the_category(', '); ?> tagged <?php the_tags(''); ?>
          by <?php the_author_posts_link(); ?>
        </small>
        <?php the_content('Read More'); ?>
      <div class="separator biggap"></div>
        <?php } ?>
      <div id="posts_navigation">
        <?php previous_posts_link(); ?>
        <?php next_posts_link(); ?>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>