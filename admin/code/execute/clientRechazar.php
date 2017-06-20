<?php
include_once("../../core/admin.php");
admin::initialize('subastas','subastasList');
$cli_uid = admin::getParam("uid");
$sql = "update mdl_client set cli_status_main=2, cli_status=1 where cli_uid=".$cli_uid;
$db->query($sql);

?>