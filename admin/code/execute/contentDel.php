<?php
// echo "en contruccion"; die; 
include_once("../../core/admin.php");
admin::initialize('content','contentList',false); 
//con_uid
// contamos todos los registros que se encuentran en un nivel del contenido
 $sql = "update mdl_contents set con_delete=1 where con_uid='" . admin::toSql(admin::getParam("con_uid"),"Text")."'";
$db->query($sql);
?>