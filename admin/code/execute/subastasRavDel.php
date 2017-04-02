<?php
include_once("../../core/admin.php");
//admin::initialize('subasta','subastaAdd',false); 
$rav_uid = $_REQUEST["rav_uid"];
$sql = "update mdl_rav 
		set rav_delete=1 
		where rav_uid='".$rav_uid."'";
$db->query($sql);
?>