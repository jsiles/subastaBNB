<?php
include_once("../../core/admin.php");
admin::initialize('subastas','subastasList');
global $lang;
$label_table = admin::toSql(admin::getParam("label_table"),"String");
if($label_table=='tbl_labels'){
	$label_uid = admin::toSql(admin::getParam("label_uid"),"String");
	$lab_category = admin::toSql(admin::getParam("lab_category"),"String");
}
else{
	$label_uid = admin::toSql(admin::getParam("lab_category"),"String");
	$lab_category = admin::toSql(admin::getParam("label_uid"),"String");
}
$lab_label = admin::toSql(admin::getParam("lab_label"),"String");
$ofl_status = admin::toSql(admin::getParam("ofl_status"),"String");

$nextUrl="labelsList.php";

$sql = "update ".$label_table." set 
			lab_label='".$lab_label."', 			
			lab_status='".$ofl_status."'
		where lab_uid='".$label_uid."' and lab_category='".$lab_category."' and lab_language='".$lang."' and lab_delete=0";
$db->query($sql);

header('Location: ../../'.$nextUrl);	
?>