<?php

if(isset($_POST['update_style']))
{
	$f = fopen("../wp-content/plugins/fgallery/css/fim_style.css", "w");
	$style = $_POST['style'];
	fwrite($f, $style);
	fclose($f);
	echo "<div class='updated fade' id='message'><p>".__('CSS successfully updated.', 'fgallery')."</p></div>";
}
?>

<?php
if(isset($_POST['reset_style']))
{
	$f = fopen("../wp-content/plugins/fgallery/css/fim_style.css", "w");
	fwrite($f, fim_get_css());
	fclose($f);
	echo "<div class='updated fade' id='message'><p>".__('CSS reset successfull.', 'fgallery')."</p></div>";

}
?>

<div class=wrap>
  <h2><?php _e('Edit css', 'fgallery')?></h2>
  <?php 
  	$file = file("../wp-content/plugins/fgallery/css/fim_style.css");
	?>
  
  <form method="post" action="">
      <textarea name="style" cols="100" rows="20"><?php foreach($file as $f)echo $f; ?></textarea>
    <div class="submit">
	  <input type="submit" name="reset_style" value="<?php _e('Reset all css', 'fgallery')?> &raquo;" />     
	  <input type="submit" name="update_style" value="<?php _e('Update css', 'fgallery')?> &raquo;" />      
</div>

  </form>
  </div>
