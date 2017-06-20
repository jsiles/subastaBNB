<?php
include_once("../../core/admin.php");
admin::initialize('users','usersList',false);
// Cambiamos el estado del contenido de activo a inactivo
$uid = admin::getParam("uid");
$status = admin::getParam("status");
if ($status==0)
	{
	$newStatus = 1;
	$imgStatus = "lib/inactive_" . $lang . ".gif";
	}
else
	{
	$newStatus = 0;
	$imgStatus = "lib/active_" . $lang . ".gif";	
	}
$sql="update mdl_client set cli_status='".$newStatus."' where cli_uid=".$uid;
$db->query($sql);
?>
<a href="javascript:clientCS('<?=$uid?>','<?=$newStatus?>');">
<img border="0" src="<?=$imgStatus?>" title="<?=admin::labels('status_on')?>" alt="<?=admin::labels('status_on')?>">
</a>