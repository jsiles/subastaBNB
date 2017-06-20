<?php
include_once("../../core/admin.php");
admin::initialize('subastas','subastasList2',false); 
$inc_uid = admin::getParam("uid");
$sql = "update mdl_incoterm set inc_delete=1 where inc_uid=".$inc_uid;
$db->query($sql);
?>