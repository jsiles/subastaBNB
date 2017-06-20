<?php
include_once("../../core/admin.php");
admin::initialize('users','createRoles',false);
$use_uid = admin::getParam("uid");
$sql = "update mdl_client_category set mcc_delete=1 where mcc_uid=" . $use_uid;
$db->query($sql);
?>