<?php
include_once("../../core/admin.php");
admin::initialize('autorizacion','autorizacionList',false); 
$xit_uid = admin::getParam("uid");
$sql = "update mdl_xitem set xit_delete=1 where xit_uid=".$xit_uid;
$db->query($sql);
?>