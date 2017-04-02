<?
// echo "en contruccion"; die; 
include_once("../../database/connection.php");  
include_once("../../core/admin.php");
admin::initialize('users','usersCS'); 
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
$sql="update mdl_users set use_status='" . $newStatus . "' where use_uid=" . $uid;
$db->query($sql);
?>
<a href="javascript:usersCS('<?=$uid?>','<?=$newStatus?>');">
<img border="0" src="<?=$imgStatus?>" title="<?=admin::labelsExecute('status_on')?>" alt="<?=admin::labels('status_on')?>">
</a>