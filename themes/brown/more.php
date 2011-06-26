<?php $posts = query_posts("showposts=3&offset=1");?>
<div id="more">
	
	<h2>Recent entries</h2>
	<div class="col">
		<ul class="latest">
			<?php while(have_posts()): the_post();?>
				<li><a href="<?php the_permalink();?>"><?php the_title();?><span><?php the_date();?></span></a></li>
			<?php endwhile;?>
		<ul>
	</div>
<?php $posts = query_posts("showposts=3&offset=4");?>

	<div class="col">
		<ul class="latest">
			<?php while(have_posts()): the_post();?>
				<li><a href="<?php the_permalink();?>"><?php the_title();?><span><?php the_date();?></span></a></li>
			<?php endwhile;?>
		<ul>
	</div>
</div>
