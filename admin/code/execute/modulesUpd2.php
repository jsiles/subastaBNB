<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('subastas','subastasList');
$team_uid = admin::getParam("team_uid");
$sql = "select team_image
		from mdl_team  
		where team_uid=" . $team_uid ;
$db->query($sql);
$imagename = $db->next_record();

		
// DATOS PARA CROPEAR LA IMAGEN
$thumb_width = "90";						// Width of thumbnail image
$thumb_height = "110";						// Height of thumbnail image
$x1 = admin::getParam("x1");
$y1 = admin::getParam("y1");
$x2 = admin::getParam("x2");
$y2 = admin::getParam("y2");
$w = admin::getParam("w");
$h = admin::getParam("h");
$scale = $thumb_width/$w;
$thumb_image_location=PATH_ROOT . '/img/team/thumb2_' . $imagename["team_image"];
$large_image_location=PATH_ROOT . '/img/team/img_' . $imagename["team_image"];


// CROPEANDO............... 
//echo $large_image_location;die;		
$cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);

//$nomIMG22 = "thumb2_" . $imagename["team_image"]; //listado noticias 112x75
//redimImgWidth($thumb_image_location, PATH_ROOT . "/admin/upload/news/". $nomIMG22,90,100);	//listado noticias 112x75

	
header('Location: ../../teamList.php');	
?>