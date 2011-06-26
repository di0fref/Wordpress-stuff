<p class="subscribe"><?php _e('Follow me', 'youare'); ?>:

  <?php $youare = get_option('Y_youare'); ?>
  <?php $youare_toggle = get_option('Y_youare_toggle_link'); ?>
  <?php $twitter = get_option('Y_twitter'); ?>
  <?php $twitter_toggle = get_option('Y_twitter_toggle_link'); ?>
 
  <?php if ($youare_toggle) { ?>
    <a class="youare" href="<?php if ($youare !== '') echo htmlspecialchars($youare, UTF-8); else echo "#"; ?>">YouAre</a>
  <?php } ?>
  <?php if ($twitter_toggle) { ?>
    <a class="twitter" href="<?php if ($twitter !== '') echo htmlspecialchars($twitter, UTF-8); else echo "#"; ?>">Twitter</a>
  <?php } ?>
</p>