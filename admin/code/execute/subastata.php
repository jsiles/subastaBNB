<?php
include_once("../../core/admin.php");
admin::initialize('subastas','subastasList',false); 
// Cambiamos el estado del contenido de activo a inactivo
$uid = $_POST["uid"];
$sub_status = $_POST["status"];

if ($sub_status=="ACTIVE")
	{
	$newStatus = "INACTIVE";
	$imgStatus = "lib/inactive_" . $lang . ".gif";
	$sql="update mdl_subasta set sub_status='INACTIVE' where sub_uid='".$uid."'";
	}
else
	{
	$newStatus = "ACTIVE";
	$imgStatus = "lib/active_" . $lang . ".gif";
	$sql="update mdl_subasta set sub_status='ACTIVE' where sub_uid='".$uid."'";
	}
$db->query($sql);
?>
<a href="javaScript:subastatatus('<?=$uid?>','<?=$newStatus?>');">
<img src="<?=$imgStatus?>" alt="<?=admin::labels('status_on')?>" border="0"/>
</a>