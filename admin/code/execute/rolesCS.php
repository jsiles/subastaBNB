<?php
include_once("../../core/admin.php");
admin::initialize('users','createRoles',false);

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
$sql="update mdl_roles set rol_status='" . $newStatus . "' where rol_uid=" . $uid;
//echo $sql;
$db->query($sql);
?>
<a href="javascript:rolesCS('<?=$uid?>','<?=$newStatus?>');">
<img border="0" src="<?=$imgStatus?>" title="<?=admin::labels('status_on')?>" alt="<?=admin::labels('status_on')?>">
</a>