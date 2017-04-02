<?php
include_once("../../core/admin.php");

$dca_uid = $_POST["dca_uid"];
// PARA LOS LENGUAGES EN LAS CATEGORIAS
$titlecategory = admin::toSql($_POST["dca_category"],"String");
$sql = "update mdl_team_category set 
		tca_category='" . $titlecategory . "',  
		tca_url='" . admin::urlsFriendly($titlecategory) . "', 
		tca_status='" . admin::toSql($_POST["dcl_status"],"String") . "'
		WHERE tca_uid=" . $dca_uid . " and tca_delete=0";
$db->query($sql);
	
header('Location: ../../teamList.php');	
?>