<?php
include_once("../../core/admin.php");
$pro_uid =admin::getParam("uid");
$sql = "update mdl_solicitud_compra  
		set sol_doc='' 
		where sol_uid=" . $pro_uid;
$db->query($sql);
?>
