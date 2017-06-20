<?php
include_once("../../core/admin.php");
admin::initialize('labels','labelsNew');
global $lang;
$label_table = admin::toSql(admin::getParam("label_table"),"Text");
if($label_table=='tbl_labels'){
	$lab_uid = admin::toSql(admin::getParam("lab_uid"),"Text");
	$lab_category = admin::toSql(admin::getParam("lab_category"),"Text");
}
else{
	$lab_uid = admin::toSql(admin::getParam("lab_category"),"Text");
	$lab_category = admin::toSql(admin::getParam("lab_uid"),"Text");
}

$lab_label = admin::toSql(admin::getParam("lab_label"),"Text");
$ofl_status = admin::toSql(admin::getParam("ofl_status"),"Text");

$lab_uid = str_replace(" ","",strtolower(trim($lab_uid)));
$lab_category = str_replace(" ","",strtolower(trim($lab_category)));

// REGISTRANDO LENGUAGES
$sql = "select * from sys_language where lan_status='ACTIVE' and lan_delete<>1";
$db2->query($sql);
while ($sys_language = $db2->next_record())
	{
	// ACTIVANDO SOLO EN EL LENGUAJE EN EL QUE FUE CREADO
	//if ($lang==$sys_language["lan_code"]) $lab_status = $ofl_status;
	//else $lab_status="INACTIVE";	
	
	$lab_status = $ofl_status;
	
	$sql="select * from ".$label_table . " where lab_uid='".$lab_uid."' and lab_category='".$lab_category."' and lab_language='".$sys_language["lan_code"]."'";
	$db->query($sql);
	if($db->numrows()==0){
		$sql = "insert into ".$label_table." set 
			lab_uid='".$lab_uid."',
			lab_category='".$lab_category."',
			lab_language='".$sys_language["lan_code"]."',
			lab_label='".$lab_label."', 			
			lab_status='".$lab_status."',
			lab_delete=0";
							
		$db->query($sql);
	}
}
	
	
$nextUrl="labelsList.php";




header('Location: ../../'.$nextUrl);	
?>