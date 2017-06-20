<?php
include_once("../../core/admin.php");
admin::initialize('modules','modulesList',false);
// Cambiamos el estado del contenido de activo a inactivo
$uid = admin::getParam("uid");
$status = admin::getParam("status");
if ($status=='ACTIVE'){
	$newStatus = 'INACTIVE';
	$imgStatus = "lib/inactive_" . $lang . ".gif";
}
else{
	$newStatus = 'ACTIVE';
	$imgStatus = "lib/active_" . $lang . ".gif";	
}
$sql="update sys_modules set mod_status='" . $newStatus . "' where mod_uid=" . $uid . " and mod_language='".$lang."'";
$db->query($sql);
?>
<a href="javascript:modulesCSC('<?=$uid?>','<?=$newStatus?>');">
<img border="0" src="<?=$imgStatus?>" title="<?=admin::labels('status_on')?>" alt="<?=admin::labels('status_on')?>">
</a>