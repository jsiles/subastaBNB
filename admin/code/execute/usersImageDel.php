<?php
include_once("../../core/admin.php");
//include_once("../../core/files.php");
admin::initialize('users','usersImageDel'); 
$use_uid = $_REQUEST["uid"];
$sql = "update sys_users
		set usr_photo='' 
		where usr_uid=" . $use_uid;
$db->query($sql);

?>
