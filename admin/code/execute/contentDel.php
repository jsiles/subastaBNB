<?php
// echo "en contruccion"; die; 
include_once("../../core/admin.php");
admin::initialize('content','contentList',false); 
//con_uid
// contamos todos los registros que se encuentran en un nivel del contenido
 $sql = "update mdl_contents set con_delete=1 where con_uid='" . $_REQUEST["con_uid"]."'";
$db->query($sql);
?>