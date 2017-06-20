<?php
include_once("../../core/admin.php");
admin::initialize('users','usersList',false);
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
$sql="update mdl_rav set rav_status='" . $newStatus . "' where rav_uid=" . $uid;
$db->query($sql);
?>
<a href="javascript:ravCS('<?=$uid?>','<?=$newStatus?>');">
<img border="0" src="<?=$imgStatus?>" title="<?=admin::labels('status_on')?>" alt="<?=admin::labels('status_on')?>">
</a>