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
$sql="update sys_users set usr_status='" . $newStatus . "' where usr_uid=" . $uid;
$db->query($sql);
?>
<a href="javascript:userCS('<?=$uid?>','<?=$newStatus?>');">
<img border="0" src="<?=$imgStatus?>" title="<?=admin::labels('status_on')?>" alt="<?=admin::labels('status_on')?>">
</a>