<?php
include_once("../../core/admin.php");
admin::initialize('subastas','subastasList');
global $lang;
$label_table = admin::toSql(admin::getParam("label_table"),"Text");
if($label_table=='tbl_labels'){
	$label_uid = admin::toSql(admin::getParam("label_uid"),"Text");
	$lab_category = admin::toSql(admin::getParam("lab_category"),"Text");
}
else{
	$label_uid = admin::toSql(admin::getParam("lab_category"),"Text");
	$lab_category = admin::toSql(admin::getParam("label_uid"),"Text");
}
$lab_label = admin::toSql(admin::getParam("lab_label"),"Text");
$ofl_status = admin::toSql(admin::getParam("ofl_status"),"Text");

$nextUrl="labelsList.php";

$sql = "update ".$label_table." set 
			lab_label='".$lab_label."', 			
			lab_status='".$ofl_status."'
		where lab_uid='".$label_uid."' and lab_category='".$lab_category."' and lab_language='".$lang."' and lab_delete=0";
$db->query($sql);

header('Location: ../../'.$nextUrl);	
?>