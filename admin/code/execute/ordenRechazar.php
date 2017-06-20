<?php
include_once("../../core/admin.php");
admin::initialize('autorizacion','autorizacionList',false);
$uid = admin::getParam("uid");
$sql = "update mdl_orden_compra set orc_estado=2, orc_aprusr_uid=".admin::getSession("usr_uid").",orc_apr_datetime=GETDATE() where orc_uid=".$uid;
$db->query($sql);

?>