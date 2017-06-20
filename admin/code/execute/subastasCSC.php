<?php
include_once("../../core/admin.php");
admin::initialize('subasta','subastaCSC'); 
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
$sql="update mdl_subasta_category set pca_status='" . $newStatus . "' where pca_uid=" . $uid;
$db->query($sql);
?>
<a href="javascript:subastaCSC('<?=$uid?>','<?=$newStatus?>');">
<img border="0" src="<?=$imgStatus?>" title="<?=admin::labelsExecute('status_on')?>" alt="<?=admin::labelsExecute('status_on')?>">
</a>