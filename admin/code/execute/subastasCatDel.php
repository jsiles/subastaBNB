<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
admin::initialize('subasta','subastaAdd'); 
$pca_uid = admin::getParam("uid");
$sql = "update mdl_subasta_category
		set pca_delete=1 
		where pca_uid=" . $pca_uid;
$db->query($sql);
?>