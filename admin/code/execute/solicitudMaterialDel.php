<?php
include_once("../../core/admin.php");
admin::initialize('users','usersNew',false);
$som_uid = admin::getParam("som_uid");
$sql = "update mdl_solicitud_material set som_delete=1 where som_uid=".$som_uid;
$db->query($sql);
?>