</div></div></div>
<div class="wrapper" id="footer">
<div class="container">
    <div class="footer-left">
      <?php if ( function_exists ( dynamic_sidebar(3) ) ) : ?>
        <?php dynamic_sidebar (3); ?>
      <?php endif; ?>
    </div>

    <div class="footer-right">
      <?php if ( function_exists ( dynamic_sidebar(4) ) ) : ?>
        <?php dynamic_sidebar (4); ?>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php wp_footer() ?>
</body>
</html>