<?php
include_once("../../core/admin.php");
admin::initialize('image','imageList',false); 
// Cambiamos el estado del contenido de activo a inactivo
$uid = admin::getParam("uid");
$status = admin::getParam("status");
if ($status=='ACTIVE')
	{
	$newStatus = 'INACTIVE';
	$imgStatus = "lib/inactive_es.gif";
	}
else
	{
	$newStatus = 'ACTIVE';
	$imgStatus = "lib/active_es.gif";	
	}
$sql="update mdl_image set mim_status='".$newStatus."' where mim_uid=".$uid;
$db->query($sql);
?>
<a href="javascript:imageCS('<?=$uid?>','<?=$newStatus?>');">
<img border="0" src="<?=$imgStatus?>" title="<?=admin::labels('status_on')?>" alt="<?=admin::labels('status_on')?>">
</a>