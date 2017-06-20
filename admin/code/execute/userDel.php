<?php
include_once("../../core/admin.php");
admin::initialize('users','usersNew',false);
$use_uidA = admin::getParam("uid");
/*$sql = "update sys_users set usr_delete=1 where usr_uid=".$use_uidA;
$db->query($sql);*/
$sql = "delete from sys_users where usr_uid=".$use_uidA;
$db->query($sql);
$sql= "delete from mdl_roles_users where rus_usr_uid=".$use_uidA;
$db->query($sql);
?>