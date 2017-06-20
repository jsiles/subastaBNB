<?php
include_once("../../core/admin.php");
admin::initialize('modules','modulesList');
$dca_uid = admin::getParam("uid");
$sql = "update sys_modules 
		set mod_delete=1,
		mod_status='INACTIVE' 
		where mod_uid=" . $dca_uid."  and mod_parent=0";
$db->query($sql);
?>