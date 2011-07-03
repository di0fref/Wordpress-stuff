<?php
/**
* Class imageMod
* From www.bram.us
* Modded by Fredrik Fahlstad
* Added gif and png support
* www.fahlstad.se
*/
class imageMod {
    var $format		= "";
    var $file		= "";
    var $path		= "";
    var $max_width	= 0;
    var $max_height	= 0;
    var $percent	= 0;
    var $extention	= "";

    function imageMod($path, $file, $type, $max_width, $max_height, $percent) {

	if ($max_width == 0 && $max_height == 0 && $percent == 0)  {
		$percent = 100;
	}

	$this->path			= $path;
	$this->max_width  	= $max_width;
	$this->max_height 	= $max_height;
	$this->percent	  	= $percent;
	$this->file	  		= $file;
	$this->type 		= $type;
	$this->extention	= strtolower(end(explode('.', $file)));

    }

    function calc_width($width, $height) {
		$new_width  = $this->max_width;
		$new_wp     = (100 * $new_width) / $width;
		$new_height = ($height * $new_wp) / 100;
		return array($new_width, $new_height);
    }

    function calc_height($width, $height) {
		$new_height = $this->max_height;
		$new_hp     = (100 * $new_height) / $height;
		$new_width  = ($width * $new_hp) / 100;
		return array($new_width, $new_height);
    }

    function calc_percent($width, $height) {
		$new_width  = ($width * $this->percent) / 100;
		$new_height = ($height * $this->percent) / 100;
		return array($new_width, $new_height);
    }

    function return_value($array) {
		$array[0] = intval($array[0]);
		$array[1] = intval($array[1]);
		return $array;
    }

    function calc_image_size($width, $height) {
		$new_size = array($width, $height);

		if ($this->max_width > 0) {
		    $new_size = $this->calc_width($width, $height);

		    if ($this->max_height > 0) {
			if ($new_size[1] > $this->max_height)
			    $new_size = $this->calc_height($new_size[0], $new_size[1]);
		    }

		    return $this->return_value($new_size);
		}

		if ($this->max_height > 0) {
		    $new_size = $this->calc_height($width, $height);
		    return $this->return_value($new_size);
		}

		if ($this->percent > 0) {
		    $new_size = $this->calc_percent($width, $height);
		    return $this->return_value($new_size);
		}
    }

    function resize() {

		$size      = GetImageSize($this->path.$this->file);
		$new_size  = $this->calc_image_size($size[0], $size[1]);
		switch($this->type){
			case "thumb": $img_target = $this->path.$this->type."_".$this->file;break;
			case "normal": $img_target = $this->path.$this->file; break;
		}


		// If the full size image fits within the dimensions specified in config.php,
		// or the thumbnail already exists, no need to go further.
		if ($this->type == 'normal' && ($size[1] <= $this->max_height && $size[0] <= $this->max_width)) {
			return;
	    }
		if ($this->type == 'thumb' && is_file($img_target)) {
			return;
	    }

		if (strtolower($this->extention) == "gif") {
		    $new_image = ImageCreate($new_size[0], $new_size[1]);
		} else {
		    $new_image = ImageCreateTrueColor($new_size[0], $new_size[1]);
		}
		switch(strtolower($this->extention))
		{
			case "gif": $old_image = imagecreatefromgif($this->path.$this->file);break;
			case "jpg":	$old_image = imagecreatefromjpeg($this->path.$this->file);break;
			case "jpeg":	$old_image = imagecreatefromjpeg($this->path.$this->file);break;
			case "png":	$old_image = imagecreatefrompng($this->path.$this->file);break;
		}
		ImageCopyResampled($new_image, $old_image, 0, 0, 0, 0, $new_size[0], $new_size[1], $size[0], $size[1]);
		switch(strtolower($this->extention))
		{
			case "jpg": $imgwrite = imagejpeg($new_image, $img_target);break;
			case "jpeg": $imgwrite = imagejpeg($new_image, $img_target);break;
			case "gif": $imgwrite = imagegif($new_image, $img_target);break;
			case "png": $imgwrite = imagepng($new_image, $img_target);break;
			DEFAULT: echo " DEFAULT";	break;
		}
		return;
	} // end resize function


} // end imageMod class
?>