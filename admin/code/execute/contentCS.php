<?php
// echo "en contruccion"; die; 
include_once("../../core/admin.php");
admin::initialize('content','contentList',false); 
// Cambiamos el estado del contenido de activo a inactivo
$con_uid = $_POST["con_uid"];
$col_status = $_POST["col_status"];

if ($col_status=="ACTIVE")
	{
	$newStatus = "INACTIVE";
	$imgStatus = "lib/inactive_" . $lang . ".gif";
	$sql="update mdl_contents_languages set col_status='INACTIVE' 
		  where col_con_uid='" . $con_uid . "' and col_language='" . $lang . "'";
	}
else
	{
	$newStatus = "ACTIVE";
	$imgStatus = "lib/active_" . $lang . ".gif";
	$sql="update mdl_contents_languages set col_status='ACTIVE' 
		  where col_con_uid='" . $con_uid . "' and col_language='" . $lang . "'";
	}
$db->query($sql);
?>

<a href="javaScript:contentCS('<?=$con_uid?>','<?=$newStatus?>');">
<img src="<?=$imgStatus?>" alt="<?=admin::labels('status_on')?>" border="0"/>
</a>