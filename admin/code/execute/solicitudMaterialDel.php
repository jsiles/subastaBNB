<?php
include_once("../../core/admin.php");
$som_uid = $_POST["som_uid"];
$sql = "update mdl_solicitud_material set som_delete=1 where som_uid=".$som_uid;
$db->query($sql);
?>