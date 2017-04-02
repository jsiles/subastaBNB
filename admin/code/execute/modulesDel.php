<?php
include_once("../../core/admin.php");
admin::initialize('modules','modulesList',false);
$doc_uid = admin::toSql(safeHtml($_REQUEST["uid"]),'Number');
$token = admin::toSql(safeHtml(admin::getParam('token')),'Text');

$sql = "update sys_modules  
		set mod_delete=1 ,
		mod_status='INACTIVE' 
		where mod_uid=" . $doc_uid."";
$db->query($sql);
?>