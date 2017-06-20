<?php
include_once("../../core/admin.php");
admin::initialize('modules','modulesList',false);

$mod_name	=	admin::toSql(safeHtml(admin::getParam("mod_name")),"Text");
$mod_alias	=	admin::toSql(safeHtml(admin::getParam("mod_alias")),"Text");
$mod_index	=	admin::toSql(safeHtml(admin::getParam("mod_index")),"Text");
$mod_status =	admin::toSql(safeHtml(admin::getParam("dol_status")),"Text");
$mod_parent =	admin::toSql(safeHtml(admin::getParam("doc_dca_uid")),"Number");

$token = admin::getParam('token');
$nextUrl ='modulesList.php';

$mod_max = admin::getDBValue("select ifnull(max(mod_uid),0)+1 AS mod_max from sys_modules");

$mod_position = admin::getDBValue("select ifnull(max(mod_position),0)+1 AS pos_max from sys_modules where mod_delete=0  and mod_language='".$lang."'");

// REGISTRANDO LENGUAGES
$sql = "select * from sys_language where lan_delete<>1";
$db2->query($sql);
while ($sys_language = $db2->next_record())	{
	// ACTIVANDO SOLO EN EL LENGUAJE EN EL QUE FUE CREADO
	$_status = $lang==$sys_language["lan_code"] ? $mod_status : "INACTIVE";	
	$sql = "insert into sys_modules set 
	mod_uid = '".$mod_max."',
	mod_language='".$sys_language["lan_code"]."',
	mod_alias='".$mod_alias."',
	mod_parent='".$mod_parent."',
	mod_name='".$mod_name."',
	mod_position='".$mod_position."',
	mod_delete='0',
	mod_status='".$_status."',
	mod_index='".$mod_index."'";
	
	$db->query($sql);
	
}

$sql = "insert into sys_modules_users set mus_rol_uid=2, mus_mod_uid=".$mod_max .", mus_place='MODULE', mus_delete=0";
$db->query($sql);
$sql = "insert into sys_modules_users set mus_rol_uid=1, mus_mod_uid=".$mod_max .", mus_place='MODULE', mus_delete=0";
$db->query($sql);

	
header('Location: ../../'.$nextUrl);	
?>