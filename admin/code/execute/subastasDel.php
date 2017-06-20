<?php
include_once("../../core/admin.php");
admin::initialize('subasta','subastaAdd',false); 
$sub_uid = admin::getParam("sub_uid");
$sql = "update mdl_subasta 
		set sub_delete=1 
		where sub_uid='".$sub_uid."'";
$db->query($sql);
?>