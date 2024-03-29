<?php
/*
Template Name: Contact
*/
?>
<?php
if( isset($_POST['submitted']) ) {
  if( trim( $_POST['contactName'] ) === '' ) {
    $nameError = 'Please enter your name.';
    $hasError = true;
    }
  else {
    $name = trim( $_POST['contactName'] );
    }
  if(trim($_POST['email']) === '')  {
    $emailError = 'Please enter your email address.';
    $hasError = true;
    }
  else if ( !eregi( "^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim( $_POST['email'] ) ) ) {
    $emailError = 'You entered an invalid email address.';
    $hasError = true;
    }
  else {
    $email = trim($_POST['email']);
    }
  if(trim($_POST['comments']) === '') {
    $commentError = 'Please enter a message.';
    $hasError = true;
    }
  else {
    if(function_exists('stripslashes')) {
      $comments = stripslashes(trim($_POST['comments']));
      } 
    else {
      $comments = trim($_POST['comments']);
      }
    }
  if(!isset($hasError)) {
    $emailTo = get_option('tz_email');
    if (!isset($emailTo) || ($emailTo == '') ){
      $emailTo = get_option('admin_email');
      }
    $subject = '[PHP Snippets] From '.$name;
    $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
    $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
    mail($emailTo, $subject, $body, $headers);
    $emailSent = true;
    }
  } 
?>
<?php get_header(); ?>
<div class="container">
<div id="content_area" class="block">
<div class="block_inside">
  <div id="page">
    <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
      <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
      <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="entry-content">
          <?php if( isset($emailSent) && $emailSent == true ) { ?>
          <div class="thanks">
            <p>Thanks, your email was sent successfully.</p>
          </div>
          <?php } else { ?>
          <?php the_content(); if( isset( $hasError ) || isset( $captchaError ) ) {
            ?>
            <p class="error">Sorry, an error occured.<p>
            <?php } ?>
            <form action="<?php the_permalink(); ?>" id="contactForm" method="post">
              <ul class="contactform">
                <li>
                  <label for="contactName">Name:</label>
                  <input type="text" name="contactName" id="contactName" value="<?php if( isset( $_POST['contactName'] ) ) echo $_POST['contactName'];?>" class="required requiredField" />
                </li>
                <li>
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" value="<?php if( isset( $_POST['email'] ) ) echo $_POST['email'];?>" class="required requiredField email" />
                </li>
                <li>
                  <label for="commentsText">Message:</label>
                  <textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField">
                    <?php if(isset( $_POST['comments'] ) ) { 
                      if( function_exists('stripslashes' ) ) {
                        echo stripslashes($_POST['comments']); 
                        }
                      else {
                        echo $_POST['comments'];
                        }
                      }
                    ?>
                  </textarea>
                </li>
                <li><input type="submit"/>Send email</input></li>
              </ul>
              <input type="hidden" name="submitted" id="submitted" value="true" />
            </form>
          <?php } ?>
        </div><!-- .entry-content -->
      </div><!-- .post -->
    <?php endwhile; endif; ?>
  </div><!-- #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>