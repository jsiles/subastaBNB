<?php
include_once("../../core/admin.php");
//admin::initialize('autorizacion','autorizacionList',false);
admin::initialize('client','clientNew',false);
$cli_uid = admin::getParam("uid");
$sql = "update mdl_client set cli_status_main=1, cli_status=0 where cli_uid=".$cli_uid;
$db->query($sql);
echo $sql;      
?>