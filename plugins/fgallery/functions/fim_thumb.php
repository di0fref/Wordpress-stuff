<?php include("../../../../wp-blog-header.php");
include("class.imageMod.php");

// Check image type

switch(strtolower(substr(strrchr($_GET['image'], "."), 1))){
	case "jpg":		fim_jpg(); header("Content-type: ".image_type_to_mime_type(IMAGETYPE_JPEG)); break;
	case "jpeg":	fim_jpg(); header("Content-type: ".image_type_to_mime_type(IMAGETYPE_JPEG)); break;
	case "png":		fim_png(); header("Content-type: ".image_type_to_mime_type(IMAGETYPE_PNG));  break;
	case "gif": 	fim_gif(); header("Content-type: ".image_type_to_mime_type(IMAGETYPE_GIF));  break;
}


function fim_jpg(){	
	
	$album = $_GET['album'];
	$path = ABSPATH."wp-content/fgallery/$album/";
	$image = $path.$_GET['image'];
	
	if(get_option('fim_dynamic_thumbnails') == 'false'){
		$thumb = $path."thumb_".$_GET['image'];
		if(!file_exists($thumb)){
			$width = get_option('fim_th_size');
	    $th = new imageMod($path, $_GET['image'], "thumb", $width, $height, 50);
			$th->resize();
		}
		$bin_data = file_get_contents($thumb);
		echo $bin_data;	}
	else{
		$orginal = imagecreatefromjpeg($image);
	
		$size      	= GetImageSize($image);
		$new_size  	= calc_image_size($size[0], $size[1]);
		$thumb 			= ImageCreateTrueColor($new_size[0], $new_size[1]);
  
		ImageCopyResampled($thumb, $orginal, 0, 0, 0, 0, $new_size[0], $new_size[1], $size[0], $size[1]);
		imagejpeg($thumb);
		imagedestroy($thumb);
	}
}
function fim_png(){
	$album = $_GET['album'];
	$path = ABSPATH."wp-content/fgallery/$album/";
	$image = $path.$_GET['image'];
	if(get_option('fim_dynamic_thumbnails') == 'false'){
		$thumb = $path."thumb_".$_GET['image'];
		if(!file_exists($thumb)){
			$width = get_option('fim_th_size');
	    $th = new imageMod($path, $_GET['image'], "thumb", $width, $height, 50);
			$th->resize();
		}
		$bin_data = file_get_contents($thumb);
		echo $bin_data;	}
	else{
		$orginal = imagecreatefrompng($image);
	
		$size     	= GetImageSize($image);
		$new_size 	= calc_image_size($size[0], $size[1]);
		$thumb 			= ImageCreateTrueColor($new_size[0], $new_size[1]);
  
		ImageCopyResampled($thumb, $orginal, 0, 0, 0, 0, $new_size[0], $new_size[1], $size[0], $size[1]);
		imagepng($thumb);
		imagedestroy($thumb);
	}
}
function fim_gif(){
	$album = $_GET['album'];
	$path = ABSPATH."wp-content/fgallery/$album/";
	$image = $path.$_GET['image'];
	if(get_option('fim_dynamic_thumbnails') == 'false'){
		$thumb = $path."thumb_".$_GET['image'];
		if(!file_exists($thumb)){
			$width = get_option('fim_th_size');
	    $th = new imageMod($path, $_GET['image'], "thumb", $width, $height, 50);
			$th->resize();
		}
		$bin_data = file_get_contents($thumb);
		echo $bin_data;	}
	else{
		$orginal = imagecreatefromgif($image);
	
		$size      = GetImageSize($image);
		$new_size  = calc_image_size($size[0], $size[1]);
		$thumb = ImageCreate($new_size[0], $new_size[1]);
  
		ImageCopyResampled($thumb, $orginal, 0, 0, 0, 0, $new_size[0], $new_size[1], $size[0], $size[1]);
		imagegif($thumb);
		imagedestroy($thumb);
	}
}


function calc_width($width, $height) {
	if(isset($_GET['w']))
		$w = $_GET['w'];
	else
		$w = get_option('fim_th_size');
	$new_width  = $w;
	$new_wp     = (100 * $new_width) / $width;
	$new_height = ($height * $new_wp) / 100;
	return array($new_width, $new_height);
}

function calc_height($width, $height) {
	if(isset($_GET['w']))
		$w = $_GET['w'];
	else
		$w = get_option('fim_th_size');
	
	$new_height = $w;
	$new_hp     = (100 * $new_height) / $height;
	$new_width  = ($width * $new_hp) / 100;
	return array($new_width, $new_height);
}

function calc_percent($width, $height) {
	if(isset($_GET['w']))
		$w = $_GET['w'];
	else
		$w = get_option('fim_th_size');
	
	$new_width  = ($width * $w) / 100;
	$new_height = ($height * $w) / 100;
	return array($new_width, $new_height);
}

function return_value($array) {
	$array[0] = intval($array[0]);
	$array[1] = intval($array[1]);
	return $array;
}

function calc_image_size($width, $height) {
	global $quality;
	$new_size = array($width, $height);
	
	if(isset($_GET['w']))
		$w = $_GET['w'];
	else
		$w = get_option('fim_th_size');

	if ($w > 0) {
    $new_size = calc_width($width, $height);

		if ($w > 0) {
			if ($new_size[1] > $w)
	    	$new_size = calc_height($new_size[0], $new_size[1]);
    }

    return return_value($new_size);
	}

	if ($w > 0) {
    	$new_size = calc_height($width, $height);
    	return return_value($new_size);
	}

	if ($quality > 0) {
    $new_size = calc_percent($width, $height);
    return return_value($new_size);
	}
}
?>