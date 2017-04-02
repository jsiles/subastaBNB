<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('users','createRoles',false);
 
$mcc_uid =admin::toSql(admin::getParam("mcc_uid"),"Number");
$mcc_permit = admin::toSql(safeHtml(admin::getParam("mcc_permit")),"String");
$mcc_mensual = admin::toSql(safeHtml(admin::getParam("mcc_mensual")),"String");
$mcc_trimestral = admin::toSql(safeHtml(admin::getParam("mcc_trimestral")),"String");
$mcc_semestral = admin::toSql(safeHtml(admin::getParam("mcc_semestral")),"String");
$mcc_anual = admin::toSql(safeHtml(admin::getParam("mcc_anual")),"String");

//***********************************************update del nombre de rol***************************************************
$sqldat = "update mdl_client_category set mcc_permit='".$mcc_permit."', mcc_mensual='".$mcc_mensual."', mcc_trimestral='".$mcc_trimestral."', mcc_semestral='".$mcc_semestral."', mcc_anual='".$mcc_anual."' where mcc_uid=".$mcc_uid;
$db->query($sqldat);

//********************************************update de los permisos del rol************************************************
$sqldat ="update mdl_client set cli_delete=1 where cli_mcc_uid=".$mcc_uid;
$db->query($sqldat);

$campos = $_POST["con_uid"];
if (is_array($_POST["con_uid"]))
{
	foreach ($campos as $key => $value){
			$moduleId = is_array($value) ? $key : $value;
			if($value==0)
			{			
				$check=admin::getDBvalue("select cli_uid from mdl_client where cli_con_uid=4 and cli_mcc_uid=".$mcc_uid);
				if (!$check){
					$maxClient=admin::getDBvalue("select max(cli_uid) from mdl_client");
					$maxClient++;
					$sql = "insert into mdl_client set cli_uid=".$maxClient.", cli_con_uid=4, cli_mcc_uid=".$mcc_uid.", cli_delete=0";
					$db->query($sql);
				}
				else
				{
					$sqldat ="update mdl_client set cli_delete=0 where cli_con_uid=4 and cli_mcc_uid=".$mcc_uid;
					$db->query($sqldat);
				}
				
				$check=admin::getDBvalue("select cli_uid from mdl_client where cli_con_uid=5 and cli_mcc_uid=".$mcc_uid);
				if (!$check){
					$maxClient=admin::getDBvalue("select max(cli_uid) from mdl_client");
					$maxClient++;
					$sql = "insert into mdl_client set cli_uid=".$maxClient.", cli_con_uid=5, cli_mcc_uid=".$mcc_uid.", cli_delete=0";
					$db->query($sql);
				}
				else
				{
					$sqldat ="update mdl_client set cli_delete=0 where cli_con_uid=5 and cli_mcc_uid=".$mcc_uid;
					$db->query($sqldat);
				}
				
				$check=admin::getDBvalue("select cli_uid from mdl_client where cli_con_uid=6 and cli_mcc_uid=".$mcc_uid);
				if (!$check){
					$maxClient=admin::getDBvalue("select max(cli_uid) from mdl_client");
					$maxClient++;
					$sql = "insert into mdl_client set cli_uid=".$maxClient.", cli_con_uid=6, cli_mcc_uid=".$mcc_uid.", cli_delete=0";
					$db->query($sql);
				}
				else
				{
					$sqldat ="update mdl_client set cli_delete=0 where cli_con_uid=6 and cli_mcc_uid='".$mcc_uid."'";
					$db->query($sqldat);
				}
				
				$check=admin::getDBvalue("select cli_uid from mdl_client where cli_con_uid=9 and cli_mcc_uid='".$mcc_uid."'");
				if (!$check){
					$maxClient=admin::getDBvalue("select max(cli_uid) from mdl_client");
					$maxClient++;
					$sql = "insert into mdl_client set cli_uid=".$maxClient.", cli_con_uid=9, cli_mcc_uid=".$mcc_uid.", cli_delete=0";
					$db->query($sql);
				}
				else
				{
					$sqldat ="update mdl_client set cli_delete=0 where cli_con_uid=9 and cli_mcc_uid=".$mcc_uid;
					$db->query($sqldat);
				}
				
			}
			else
			{
				$check=admin::getDBvalue("select cli_uid from mdl_client where cli_con_uid='".$value."' and cli_mcc_uid=".$mcc_uid);
				if (!$check){
					$maxClient=admin::getDBvalue("select max(cli_uid) from mdl_client");
					$maxClient++;
					$sql = "insert into mdl_client set cli_uid=".$maxClient.", cli_con_uid='".$value."', cli_mcc_uid=".$mcc_uid.", cli_delete=0";
					$db->query($sql);
				}
				else
				{
					$sqldat ="update mdl_client set cli_delete=0 where cli_con_uid='".$value."' and cli_mcc_uid=".$mcc_uid;
					$db->query($sqldat);
				}
			}
	}	
}
$token=admin::getParam("token");

header('Location: ../../permitList.php?token='.$token);
?>