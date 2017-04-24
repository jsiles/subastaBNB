<?php
include_once("../../core/admin.php");
admin::initialize('autorizacion','autorizacionList',false);
$sub_uid = admin::getParam("sub_uid");
/*$sql = "update mdl_subasta set sub_finish=4 where sub_uid=".$sub_uid;
$db->query($sql);*/
$userUID = admin::getSession("usr_uid");
$elaborado=admin::getParam("elaborado");
$aprobado = admin::getParam("aprobado");
$observaciones = admin::getParam("observaciones");
$ahorro = admin::getParam("ahorro");
$sua_uid = admin::getParam("sua_uid");
$token = admin::getParam("token");
$sql = "update mdl_subasta_informe set "
        . "sua_user_uid=$userUID, sua_sub_uid=$sub_uid, sua_elaborado='".admin::toSql($elaborado, "Text")."', sua_aprobado='".admin::toSql($aprobado, "Text")."',"
        . " sua_observaciones='".admin::toSql($observaciones, "Text")."', sua_date=GETDATE(), sua_ahorro=$ahorro"
        . " where sua_uid=$sua_uid";
//echo $sql;die;        
$db->query($sql);
header('Location: ../../informeList.php?token='.$token);
?>