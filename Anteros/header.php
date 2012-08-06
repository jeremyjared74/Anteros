?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php
      if ( function_exists( 'is_tag' ) && is_tag () ) {
        single_tag_title( "Tag Archive for &quot;" );
        echo'&quot; - ';
        }
      elseif ( is_archive () ) {
        wp_title (''); echo ' Archive - ';
        }
      elseif ( is_search () ) {
        echo 'Search for &quot;'.wp_specialchars( $s ).'&quot; - ';
        }
      elseif (!( is_404 () ) && ( is_single() ) || ( is_page ()) ) {
        wp_title(''); echo ' - '; 
        } 
      elseif ( is_404 () ) {
        echo 'Not Found - ';
        }
      if ( is_home () ) { 
        bloginfo ( 'name' );
        echo ' - '; bloginfo( 'description' );
        }
      else { 
        bloginfo ( 'name' );
        }
      if ($paged>1) {
        echo ' - page '. $paged;
        }
      ?>
    </title>
      <link href='http://fonts.googleapis.com/css?family=Play:400,700' rel='stylesheet' type='text/css'/>
      <link rel="stylesheet" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <?php wp_head(); ?>
  </head><!-- END THE HEAD -->
<body <?php body_class(); ?>>
<!-- header -->
  <div class="container">
    <div id="header">
      <div id="menu">
      <?php wp_nav_menu(
        array(
          'sort_column' => 'menu_order',
          'container_class' => 'menu-header',
          'theme_location' => 'main', )
          );
          ?>
      </div><!-- End #menu-->
      <div id="logo">
        <h2><a href="<?php echo get_option('home'); ?>">
        <img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="logo" /></a></h2>
      </div>
    </div>
  </div><div class="container"></div>
<div class="main-box"><div class="inside"><div class="wrapper">