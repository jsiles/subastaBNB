<?php
include_once("../../core/admin.php");
admin::initialize('users','createRoles',false);
$use_uid = admin::getParam("uid");
$sql = "update mdl_roles set rol_delete=1 where rol_uid=" . $use_uid;
$db->query($sql);
?>