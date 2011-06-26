    <form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div><label class="hidden" for="s"><?php echo __('Search for:') ?></label>
        <input type="text" value="<?php echo the_search_query(); ?>" name="s" id="s" />
           <input type="submit" id="searchsubmit" value="Search" />
      </div>
    </form>