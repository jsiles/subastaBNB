<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
admin::initialize('news','newsDel'); 
$mim_uid = admin::getParam("uid");
$sql = "update mdl_image set mim_delete=1 where mim_uid=".$mim_uid;
$db->query($sql);
?>
