<?php
include_once("../../core/admin.php");
admin::initialize('subasta','subastaAdd'); 
$sub_uid = admin::getParam("uid");
$sql = "update mdl_subasta 
		set sub_delete=1 
		where sub_uid='".$sub_uid."'";
$db->query($sql);
?>