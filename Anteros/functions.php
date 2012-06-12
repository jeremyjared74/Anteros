<?php
  if ( ! isset( $content_width ) ) $content_width = 640;
  add_action( 'after_setup_theme', 'anteros_setup' );
  if ( ! function_exists( 'anteros_setup' ) ):
  function anteros_setup() {
    // Styles the visual editor with editor-style.css to match the theme.
    add_editor_style();
    add_theme_support( 'automatic-feed-links' );
    
    // Register The Menu's'   
    register_nav_menus(
      array(
        'main' => 'main',
        'secondary' => 'secondary',
        'tertiary' => 'tertiary',
        ) );
    // Add Post Thumbs and Custom Image Sizes
    add_theme_support( 'post-thumbnails', array( 'post' ) );
    
    // 50 pixels wide by 50 pixels tall, hard crop mode
    set_post_thumbnail_size( 150, 150, true ); 
    
    // Rotator thumbnail size, hard crop mode
    add_image_size( 'nav-image', 130, 40, true ); 
    
     // Rotator large size, hard crop mode
    add_image_size( 'rotator-post-image', 980, 350, true );
    
    // Add support for a variety of post formats
    add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );
    }
  
/**
 * Reginser Our SideBars
 */  
  register_sidebar( array(
    'name'=>'sidebar1',
    'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
    'after_widget' => "</li></ul>",
    'before_title' => '<h2 class="widgettitle">',
    'after_title' => "</h2>"
    ));
  register_sidebar( array(
    'name'=>'sidebar2',
    'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
    'after_widget' => "</li></ul>",
    'before_title' => '<h2 class="widgettitle">',
    'after_title' => "</h2>"
    ));
  register_sidebar( array(
    'name'=>'footer1',
    'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
    'after_widget' => "</li></ul>",
    'before_title' => '<h2 class="widgettitle">',
    'after_title' => "</h2>"
    ));
  register_sidebar( array(
    'name'=>'footer2',
    'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
    'after_widget' => "</li></ul>",
    'before_title' => '<h2 class="widgettitle">',
    'after_title' => "</h2>"
    ));
    
  endif; // END Anteros_setup
  
/**
 * enqueue scripts and styles
 */

  function add_themescript(){
    if( !is_admin() ){
      wp_enqueue_script('thickbox',null,array('jquery'));
      wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/
      thickbox.css', null, '1.0');
      wp_enqueue_style( 'mysyntax_style', get_template_directory_uri() . '/syntax.css');
      }
    }
  add_action('init','add_themescript');
  define("IMAGE_FILETYPE", "(bmp|gif|jpeg|jpg|png)", true);
  function wp_thickbox( $string ) {
    $pattern = '/(<a(.*?)href="([^"]*.)'.IMAGE_FILETYPE.'"(.*?)><img)/ie';
    $replacement = 'stripslashes(strstr("\2\5","rel=") ? "\1" : "<a\2href=
    \"\3\4\"\5 class=\"thickbox\"><img")';
    return preg_replace($pattern, $replacement, $string);
    }
  function wp_thickbox_rel( $attachment_link ) {
  $attachment_link = str_replace( 'a href' , 'a rel="thickbox-gallery"
  class="thickbox" href' , $attachment_link );
  return $attachment_link;
  }
  add_filter('the_content', 'wp_thickbox');
  add_filter('wp_get_attachment_link' , 'wp_thickbox_rel');

  function contact_form_script() {
    if ( !is_page_template( 'contact.php' ) )
    return;
    wp_enqueue_script( 'mypagescript', get_template_directory_uri() . '/js/jquery.validate.min.js', array( 'jquery' ));
    wp_enqueue_script( 'mypagescripttwo', get_template_directory_uri() . '/js/verify.js', array( 'jquery' ));
    }
  add_action( 'template_redirect', 'contact_form_script' );
  function my_slider_script() {
    if ( !is_page_template( 'slider.php' ) )
    return;
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script( 'my_rotator_script', get_template_directory_uri() . '/js/photo_rotator_tabs.js', array('jquery'));
    }
  add_action( 'template_redirect', 'my_slider_script' );
  
  // Show Theme File
  function getWpTemplate() {
    if (defined('WP_USE_THEMES') && WP_USE_THEMES) {
      $template = false;
      if     ( is_404() && $template = get_404_template()):
      elseif ( is_search() && $template = get_search_template() ):
      elseif ( is_tax() && $template = get_taxonomy_template() ):
      elseif ( is_front_page() && $template = get_front_page_template() ):
      elseif ( is_home() && $template = get_home_template() ):
      elseif ( is_attachment() && $template = get_attachment_template() ):
      elseif ( is_single() && $template = get_single_template() ):
      elseif ( is_page() && $template = get_page_template() ):
      elseif ( is_category() && $template = get_category_template() ):
      elseif ( is_tag() && $template = get_tag_template() ):
      elseif ( is_author() && $template = get_author_template() ):
      elseif ( is_date() && $template = get_date_template() ):
      elseif ( is_archive() && $template = get_archive_template() ):
      elseif ( is_comments_popup() && $template = get_comments_popup_template() ):
      elseif ( is_paged() && $template = get_paged_template() ):
      else:
      $template = get_index_template();
      endif;
      return str_replace(ABSPATH, '', $template);
      } 
    else {
      return null;
      }
    }
  function outputThemeFilename() {
    global $stfOptions;
    echo '<div id="showtheme" style="position: absolute; z-index: 9999; padding: 8px; background: white; color: black; opacity: 0.8;right:0; top:20;">';
    echo ( getWpTemplate() !== null ) ? getWpTemplate() : 'Unknown theme file';
    echo '</div>';
    return;
    }
  $stfOptions = array('require_admin' => true);
  if ($stfOptions['require_admin'] == true) {
  if (current_user_can( 'administrator' )) {
  add_action('wp_head', 'outputThemeFilename');
  }
  }
  else {
  add_action('wp_head', 'outputThemeFilename');
  }
?>