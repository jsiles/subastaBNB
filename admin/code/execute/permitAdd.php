<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('client','permitAdd',false);
 
$mcc_permit = admin::toSql(safeHtml(admin::getParam("mcc_permit")),"String");
$mcc_mensual = admin::toSql(safeHtml(admin::getParam("mcc_mensual")),"String");
$mcc_trimestral = admin::toSql(safeHtml(admin::getParam("mcc_trimestral")),"String");
$mcc_semestral = admin::toSql(safeHtml(admin::getParam("mcc_semestral")),"String");
$mcc_anual = admin::toSql(safeHtml(admin::getParam("mcc_anual")),"String");

//***********************************************update del nombre de rol***************************************************
$maxPermit=admin::getDBvalue("select max(mcc_uid) from mdl_client_category");
$maxPermit++;
$sqldat = "insert into mdl_client_category set mcc_uid=".$maxPermit.", mcc_permit='".$mcc_permit."', mcc_mensual='".$mcc_mensual."', mcc_trimestral='".$mcc_trimestral."', mcc_semestral='".$mcc_semestral."', mcc_anual='".$mcc_anual."', mcc_delete=0";
$db->query($sqldat);
//********************************************update de los permisos************************************************
$campos = $_POST["con_uid"];
if (is_array($_POST["con_uid"]))
{
	foreach ($campos as $key => $value){
			$moduleId = is_array($value) ? $key : $value;
			$maxClient=admin::getDBvalue("select max(cli_uid) from mdl_client");
			$maxClient++;
			if($value==0)
			{
				$sql = "insert into mdl_client set cli_uid=".$maxClient.", cli_con_uid=4, cli_mcc_uid=".$maxPermit.", cli_delete=0";
				$db->query($sql);
				$sql = "insert into mdl_client set cli_uid=".$maxClient.", cli_con_uid=5, cli_mcc_uid=".$maxPermit.", cli_delete=0";
				$db->query($sql);
				$sql = "insert into mdl_client set cli_uid=".$maxClient.", cli_con_uid=6, cli_mcc_uid=".$maxPermit.", cli_delete=0";
				$db->query($sql);
				$sql = "insert into mdl_client set cli_uid=".$maxClient.", cli_con_uid=9, cli_mcc_uid=".$maxPermit.", cli_delete=0";
				$db->query($sql);
			} 
			else{
				$sql = "insert into mdl_client set cli_uid=".$maxClient.", cli_con_uid='".$value."', cli_mcc_uid=".$maxPermit.", cli_delete=0";
				$db->query($sql);
			}	
	}	
}
$token=admin::getParam("token");

header('Location: ../../permitList.php?token='.$token);
?>