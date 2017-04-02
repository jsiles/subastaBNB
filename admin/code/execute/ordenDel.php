<?php
include_once("../../core/admin.php");
admin::initialize('users','usersNew',false);
$orc_uid = $_POST["uid"];
$sql = "update mdl_orden_compra set orc_delete=1 where orc_uid=".$orc_uid;
$db->query($sql);
?>