<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
admin::initialize('myprofile','myprofileUPD'); 
$usr_uid = admin::getParam("uid");
$sql = "update sys_users 
		set usr_photo='' 
		where usr_uid=" . $usr_uid;
$db->query($sql);
?>
