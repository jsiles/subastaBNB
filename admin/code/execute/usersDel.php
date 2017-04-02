<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
admin::initialize('users','usersDel'); 
$use_uid = $_REQUEST["uid"];
$sql = "update mdl_users 
		set use_delete=1 
		where use_uid=" . $use_uid;
$db->query($sql);
?>
