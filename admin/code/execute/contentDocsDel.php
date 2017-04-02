<?php
include_once("../../core/admin.php");
admin::initialize('content','contentEdit',false);

$cdo_uid=admin::getParam("uid");

 $sql = "update mdl_contents_docs set mcd_delete=1 where mcd_uid=".$cdo_uid;
$db->query($sql);
?>