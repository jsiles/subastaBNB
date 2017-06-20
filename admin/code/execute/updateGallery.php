<?php
include_once("../../core/admin.php");

admin::initialize('news','newsNew');
// DECLARANDO LAS VARIABLES PARA EVITAR SQL INJECTION

$new_gallery = admin::toSql(admin::getParam("value"),"Number");
$new_uid = admin::toSql(admin::getParam("new_uid"),"Number");

//$sql = "update mdl_news set new_gallery='0' where date_format(new_date_upd, '%Y-%m-%d')  ='".date('Y-m-d')."'";
	//		$db->query($sql);
$sql = "update mdl_news set new_gallery='".$new_gallery."' where new_uid='".$new_uid."'";
			$db->query($sql);
			
?>