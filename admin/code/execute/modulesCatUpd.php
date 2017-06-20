<?php
include_once("../../core/admin.php");
admin::initialize('subastas','subastasList');
$dca_uid = admin::getParam("dca_uid");
// PARA LOS LENGUAGES EN LAS CATEGORIAS
$titlecategory = admin::toSql(admin::getParam("dca_category"),"Text");
$sql = "update mdl_team_category set 
		tca_category='" . $titlecategory . "',  
		tca_url='" . admin::urlsFriendly($titlecategory) . "', 
		tca_status='" . admin::toSql(admin::getParam("dcl_status"),"Text") . "'
		WHERE tca_uid=" . $dca_uid . " and tca_delete=0";
$db->query($sql);
	
header('Location: ../../teamList.php');	
?>