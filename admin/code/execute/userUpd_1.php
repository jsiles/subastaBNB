<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('users','usersEdit',false);

$use_uidA = admin::getSession("usr_uid");
$usr_loginA = admin::toSql(admin::getParam("usr_login"),"Text");
$usr_passA = admin::toSql(admin::getParam("usr_pass"),"Text");
$usr_firstnameA = admin::toSql(admin::getParam("usr_firstname"),"Text");
$usr_lastnameA = admin::toSql(admin::getParam("usr_lastname"),"Text");
$usr_emailA = admin::toSql(admin::getParam("usr_email"),"Text");
$usr_photoA = admin::toSql(admin::getParam("usr_photo"),"Text");
$usr_statusA = admin::toSql(admin::getParam("usr_status"),"Text");
$usr_rolA = admin::toSql(admin::getParam("usr_rol"),"Number");
if ($usr_passA!=""){ 	
$sql = "update sys_users set usr_pass='" . md5($usr_passA) . "'  where usr_uid=".$use_uidA;
$db->query($sql);
}
// SUBIENDO LA IMAGEN
	
	
        $token=admin::getParam("token");
                $token=admin::getParam("token");
        if(!admin::verifyModulePermission(5))
        {
            $modAccess = admin::getDBvalue("select top 1 a.mus_mod_uid from sys_modules_users a, sys_modules b where a.mus_rol_uid=".$_SESSION["usr_rol"]." and a.mus_mod_uid=b.mod_uid and b.mod_status='ACTIVE' and b.mod_parent=0 order by b.mod_position");
            $urlSite = admin::getDBValue("select mod_index from sys_modules where mod_uid=". $modAccess ." and mod_status='ACTIVE'");
            if($urlSite){
             
            header("Location: ".PATH_DOMAIN."/admin/".$urlSite);
            }else { //echo "@@";die;
                header("Location: ".PATH_DOMAIN."/admin/index.php");
            }
        }
        else {
            //echo "##";die;
            header("Location: ".PATH_DOMAIN."/admin/userList.php");		
        }