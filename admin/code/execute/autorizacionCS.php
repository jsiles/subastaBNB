<?php
include_once("../../core/admin.php");
admin::initialize('subasta','subastaCS'); 
// Cambiamos el estado del contenido de activo a inactivo
$uid = admin::getParam("uid");
$status = admin::getParam("status");
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
$sql="update mdl_subasta set sub_status='" . $newStatus . "' where sub_uid=" . $uid;
$db->query($sql);
?>
<a href="javascript:subastaCS('<?=$uid?>','<?=$newStatus?>');">
<img border="0" src="<?=$imgStatus?>" title="<?=admin::labelsExecute('status_on')?>" alt="<?=admin::labelsExecute('status_on')?>">
</a>