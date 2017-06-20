<?php
include_once("../../core/admin.php");
admin::initialize('dpf','dpfList',false);

$ind_uid = admin::toSql(admin::getParam("ind_uid"),"Number");
$ind_description = admin::toSql(admin::getParam("ind_description2".$ind_uid),"Text");
$ind_por_bol = admin::toSql(admin::getParam("ind_por_bol2".$ind_uid),"Text");
$ind_por_dol = admin::toSql(admin::getParam("ind_por_dol2".$ind_uid),"Text");
$ind_por_ufv = admin::toSql(admin::getParam("ind_por_ufv2".$ind_uid),"Text");
$ind_plazo = admin::toSql(admin::getParam("ind_plazo2".$ind_uid),"Number");
$tipUid=admin::getParam("tipUid");


$sqldat = "update mdl_indicadores set ind_description='".$ind_description."', ind_por_bol='".$ind_por_bol."', ind_por_dol='".$ind_por_dol."', ind_por_ufv='".$ind_por_ufv."', ind_plazo='".$ind_plazo."' where ind_uid=".$ind_uid;
$db->query($sqldat);

$token=admin::getParam("token");
$nextUrl='dpfList.php';

header('Location: ../../'.$nextUrl);
?>