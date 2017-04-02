<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
admin::initialize('subasta','subastaCatImageDel'); 
$pca_uid = $_REQUEST["uid"];
$sql = "update mdl_subasta_category_languages 
		set pcl_banner='', pcl_banner_type=NULL  
		where pcl_pca_uid=" . $pca_uid;
$db->query($sql);
?>
