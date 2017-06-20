<?php 
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('banner','bannerList',false);

$token = admin::getParam("token");
$ban_uid = admin::getParam("ban_uid");
$til_image=admin::getDBvalue("SELECT ban_file FROM mdl_banners where ban_uid='".$ban_uid."'");
		
// DATOS PARA CROPEAR LA IMAGEN
$thumb_width = "770";						// Width of thumbnail image
$thumb_height = "150";						// Height of thumbnail image
$x1 = admin::getParam("x1");
$y1 = admin::getParam("y1");
$x2 = admin::getParam("x2");
$y2 = admin::getParam("y2");
$w = admin::getParam("w");
$h = admin::getParam("h");
$scale = $thumb_width/$w;
$image_location=PATH_ROOT . '/img/banner/Original_' . $til_image;
// CROPEANDO............... 
		
$cropped = resizeThumbnailImage($image_location, $image_location,$w,$h,$x1,$y1,$scale);
$nomIMG22 = "img_".$til_image;
$nomIMG2 = "thumb_".$til_image;
//redimImgWidth($image_location, PATH_ROOT . "/img/banner/". $nomIMG22,770,150);	
//redimImgWidth($image_location, PATH_ROOT . "/img/banner/". $nomIMG2,60,100);
redimImgWH($image_location, PATH_ROOT . "/img/banner/". $nomIMG22,770,150);	
redimImgWidth($image_location, PATH_ROOT . "/img/banner/". $nomIMG2,60,100);	
unlink($image_location);
?>
<script language="javascript" type="text/javascript">
document.location.href='../../bannerList.php';
</script>