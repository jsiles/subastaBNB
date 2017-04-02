<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
include_once("../../core/thumb.php");
admin::initialize('solicitud','solicitudAdd'); 
$tipUid=  admin::getParam("tipUid");
$token= admin::getParam("token");
$not_uid= admin::getParam("not_uid");
$not_subject= admin::getParam("not_subject");
$not_template= admin::getParam("not_template");
$not_sign= admin::getParam("not_sign");

$sql = "update mdl_notificacion_template set
                                 not_subject= '$not_subject',
                                 not_template= '$not_template',
                                 not_sign= '$not_sign',
                                 not_usr_uid= ".admin::getSession("usr_uid").",
                                 not_fecha= GETDATE()
                                 where not_uid=$not_uid ";
//echo $sql;die;
	$db->query($sql);

        

header('Location: ../../notificacionList.php?token='.$token."&not_uid=".$not_uid."&tipUid=".$tipUid);	
?>