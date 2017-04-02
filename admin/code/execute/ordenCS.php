<?php
include_once("../../core/admin.php");
admin::initialize('users','usersList',false);
// Cambiamos el estado del contenido de activo a inactivo
$uid = $_POST["uid"];
$status = $_POST["status"];
if ($status=='ACTIVE')
	{
	$newStatus = 'INACTIVE';
	$imgStatus = "lib/inactive_" . $lang . ".gif";
	}
else
	{
	$newStatus = 'ACTIVE';
	$imgStatus = "lib/active_" . $lang . ".gif";	
	}
$sql="update mdl_orden_compra set orc_status='".$newStatus."' where orc_uid=".$uid;
$db->query($sql);
//echo $sql;die;
?>
<a href="javascript:ordenCS('<?=$uid?>','<?=$newStatus?>');">
<img border="0" src="<?=$imgStatus?>" title="<?=admin::labels('status_on')?>" alt="<?=admin::labels('status_on')?>">
</a>