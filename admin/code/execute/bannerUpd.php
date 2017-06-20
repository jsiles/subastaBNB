<?php 
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
include_once("../../core/thumb.php");
admin::initialize('banner','bannerList',false);
$mythumb = new thumb();
$ban_uid=admin::toSql(admin::getParam("uid"),"Number");

$sql = "update mdl_banners set ban_title='".admin::toSql(admin::getParam("ban_title"),"Text")."' where ban_uid=".$ban_uid;
$db->query($sql);

if(admin::getParam("ban_status")=='ACTIVE') {
		    $sql = "UPDATE mdl_banners_contents set mbc_status='INACTIVE'";
		    $db2->query($sql);
		}

$sql = "update mdl_banners_contents set mbc_status='".admin::toSql(admin::getParam("ban_status"),"Text")."' where mbc_ban_uid=".$ban_uid;
		$db->query($sql);

// SUBIENDO LA IMAGEN DE PUBLICACIONES
$FILES = $_FILES ['ban_adjunt'];
if ($FILES["name"] != '')
{
	// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
	$extensionFile = admin::getExtension($FILES["name"]);
	$fileName = admin::imageName(admin::toSql(admin::getParam("ban_title"),"Text"))."_".$ban_uid.".".$extensionFile;	
	
	// SUBIENDO LA IMAGEN DE TEMP


	// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
	$image1t = PATH_ROOT.'/img/banner/Original_'.$fileName;
	classfile::uploadFile($FILES,$image1t);
	
	$sql = "UPDATE mdl_banners SET ban_file='".$fileName."' WHERE ban_uid=".$ban_uid;
	$db->query($sql);
	
	$gifCode='<img src="'.$domain.'/img/banner/'.$fileName.'" alt="'.admin::toSql(admin::getParam("ban_title"),"Text").'" title="'.admin::toSql(admin::getParam("ban_title"),"Text").'" />';
	
	$sql = "UPDATE mdl_banners SET ban_content='".$gifCode."' WHERE ban_uid=".$ban_uid;
	$db->query($sql);
	
	header('Location: ../../bannerNew2.php?ban_uid='.$ban_uid);
}
else {
	header('Location: ../../bannerList.php?ban_uid='.$ban_uid);
	}
?>