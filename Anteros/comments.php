<div id="comments">
  <?php
    $req = get_option('require_name_email');
    if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
    die ( 'Please do not load this page directly. Thanks!' );
    if ( ! empty($post->post_password) ) :
    if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) :
    ?>
  <div class="nopassword">This post is password protected. Enter the password to view any comments.</div>
</div><!-- .comments -->
  <?php return; endif; endif; ?>
  <?php if ( $comments ) : global $so_comment_alt; $ping_count = $comment_count = 0;
      foreach ( $comments as $comment )
      get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
      ?>
  <?php if ( $comment_count ) :$so_comment_alt = 0 ?>
  <div id="comments-list" class="comments">
    <h3><?php 
      printf($comment_count > 1 ? '<span>%d</span> Comments' : '<span>One</span> Comment', $comment_count) 
      ?>
    </h3>
    <ol>
      <?php wp_list_comments(
        array ('type' => 'comment','callback' => 'so_comments')); 
        ?>
    </ol>
  </div><!-- #comments-list .comments -->
<?php endif; ?>
  <?php 
    if ( $ping_count ) : 
    $so_comment_alt = 0 
    ?>
  <div id="trackbacks-list" class="comments">
    <h3>
      <?php printf($ping_count > 1 ? __('<span>%d</span> Trackbacks', 'sosimple') : __('<span>One</span> Trackback', 'sosimple'), $ping_count) ?>
    </h3>
    <ol>
      <?php wp_list_comments( array('type' => 'trackback','callback' => 'so_trackbacks')); ?>
    </ol>
  </div>
  <?php endif; endif;  
    if ( 'open' == $post->comment_status ) :
    ?>
  <div id="respond">
    <h3>Post a Comment</h3>
      <div class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></div>
      <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <p id="login-req">
          <?php 
            printf(__('You must be <a href="%s" title="Log in">logged in</a> to post a comment.', 'sosimple'),
            get_option('siteurl') . '/wp-login.php?redirect_to=' . 
            get_permalink() ) 
            ?>
        </p>
      <?php else : ?>
    <div class="formcontainer">
      <form id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
        <?php if ( $user_ID ) : ?>
          <p id="login">
            <?php printf('<span class="loggedin">Logged in as <a href="%1$s" title="Logged in as %2$s">%2$s</a>.</span> <span class="logout">
              <a href="%3$s" title="Log out of this account">Log out?</a></span>',
              get_option('siteurl') . '/wp-admin/profile.php',
              esc_htm($user_identity, true),
              get_option('siteurl') . '/wp-login.php?action=logout&amp;redirect_to=' . get_permalink() ) 
              ?>
          </p>
          <?php else : ?>
            <p id="comment-notes">
              Your email is <em>never</em> published nor shared. 
              <?php if ($req) _e('Required fields are marked <span class="required">*</span>') ?>
            </p>
          <div class="form-label">
            <label for="author">Name</label><?php if ($req) _e('<span class="required">*</span>') ?>
          </div>
          <div class="form-input">
            <input id="author" name="author" type="text" value="<?php echo $comment_author ?>" size="30" maxlength="20" tabindex="3" />
          </div>
          <div class="form-label">
            <label for="email">Email</label> <?php if ($req) _e('<span class="required">*</span>') ?>
          </div>
          <div class="form-input">
            <input id="email" name="email" type="text" value="<?php echo $comment_author_email ?>" size="30" maxlength="50" tabindex="4" />
          </div>
          <div class="form-label">
            <label for="url">Website</label>
          </div>
          <div class="form-input">
            <input id="url" name="url" type="text" value="<?php echo $comment_author_url ?>" size="30" maxlength="50" tabindex="5" />
          </div>
          <?php endif /* if ( $user_ID ) */ ?>
            <div class="form-label">
              <label for="comment">Comment</label>
            </div>
            <div class="form-textarea">
              <textarea id="comment" name="comment" cols="45" rows="8" tabindex="6"></textarea>
            </div>
            <div class="form-submit"><input id="submit" name="submit" type="submit" value="Post Comment" tabindex="7" />
              <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
            </div>
            <div><?php comment_id_fields(); ?></div>
        <?php do_action('comment_form', $post->ID); ?>
      </form><!-- #commentform -->
    </div><!-- .formcontainer -->
    <?php endif /* if ( get_option('comment_registration') && !$user_ID ) */ ?>
  </div><!-- #respond -->
<?php endif /* if ( 'open' == $post->comment_status ) */ ?>
</div><!-- #comments -->