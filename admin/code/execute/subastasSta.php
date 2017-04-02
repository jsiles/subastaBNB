<?php
include_once("../../core/admin.php");
admin::initialize('news','newsCS'); 
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
$sql="update mdl_subasta set pro_status='" . $newStatus . "' where pro_uid='" . $uid . "'";
$db->query($sql);
?>
<a href="javascript:subastatatus('<?=$uid?>','<?=$newStatus?>');">
<img border="0" src="<?=$imgStatus?>" title="<?=admin::labels('status_on')?>" alt="<?=admin::labels('status_on')?>">
</a>