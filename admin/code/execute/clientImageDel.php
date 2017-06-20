<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
admin::initialize('client','clientEdit',false);
$mcl_uid = admin::getParam("uid");
$sql = "update mdl_client_languages set mcl_photo='' where mcl_uid=" . $mcl_uid;
$db->query($sql);
?>