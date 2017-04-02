<?php
include_once("../../core/admin.php");
//admin::initialize('content','contentDocDel'); 

$cdo_uid=admin::getParam("uid");

 $sql = "update tbl_publicaciones_docs set cdo_delete=1 where cdo_uid=".$cdo_uid;
$db->query($sql);
?>