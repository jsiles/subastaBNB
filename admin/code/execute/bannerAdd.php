<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
include_once("../../core/thumb.php");
admin::initialize('banners','bannerList',false);
$mythumb = new thumb(); 

$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
}

$sql = "insert into mdl_banners(
								ban_title, 
								ban_url,
								ban_content,
								ban_file
								)
						values (							
							'".admin::toSql(admin::getParam("ban_title"),"Text")."',
							'',  
							'".$randomString."',
							''
							)";
$db->query($sql);


$sql="SELECT ban_uid from mdl_banners where ban_title='".admin::getParam("ban_title")."' and ban_content='".$randomString."';";
$db2->query($sql);
$content = $db2->next_record();
$ban_uid = $content["ban_uid"];

// SUBIENDO LA IMAGEN DE PUBLICACIONES
$FILES = $_FILES ['ban_adjunt'];
if ($FILES["name"] != '')
{
	// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
	$extensionFile = admin::getExtension($FILES["name"]);
	$fileName = admin::imageName(admin::toSql(admin::getParam("ban_title"),"Text"))."_".$ban_uid.".".$extensionFile;

	// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
	$image1 = PATH_ROOT.'/img/banner/Original_'.$fileName;
	classfile::uploadFile($FILES,$image1);
		
	$sql = "UPDATE mdl_banners SET ban_file='".$fileName."' WHERE ban_uid=".$ban_uid;
	$db->query($sql);

	// Subimos el archivo con el nombre original
	$gifCode='<img src="'.$domain.'/img/banner/'.$fileName.'" alt="'.admin::toSql(admin::getParam("ban_title"),"Text").'" title="'.admin::toSql(admin::getParam("ban_title"),"Text").'" />';
	
	$sql = "UPDATE mdl_banners SET ban_content='".$gifCode."' WHERE ban_uid=".$ban_uid;
	$db->query($sql);
}

		$mbc_uid=admin::getDBvalue("select max(mbc_uid) from mdl_banners_contents");
		$mbc_uid++;
		
		$mbc_position=admin::getDBvalue("select max(mbc_position) from mdl_banners_contents where mbc_place=2 and mbc_ban_uid=".$ban_uid);
		$mbc_position++;
		
		if(admin::getParam("ban_status")=='ACTIVE') {
		    $sql = "UPDATE mdl_banners_contents set mbc_status='INACTIVE'";
		    $db2->query($sql);
		}
		$sql = "insert into mdl_banners_contents(
										mbc_uid, 
										mbc_con_uid, 
										mbc_ban_uid,
										mbc_place, 
										mbc_position, 
										mbc_delete,
										mbc_status
										)
								values (							
									'".$mbc_uid."', 
									'1',
									'".$ban_uid."',
									2,  
									'".$mbc_position."',
									0,
									'".admin::toSql(admin::getParam("ban_status"),"Text")."' 
									)";
		$db2->query($sql);
		
	
header('Location: ../../bannerNew2.php?ban_uid='.$ban_uid);
?>