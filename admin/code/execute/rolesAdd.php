<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('users','createRoles',false);
 
$rol_uid =admin::toSql(admin::getParam("rol_uid"),"Number");
$rol_name = admin::toSql(safeHtml(admin::getParam("rol_name")),"Text");

$maxRol= admin::getDBvalue("select max(rol_uid) from mdl_roles");
$rol_uid= ++$maxRol;

$sqldat = "insert into mdl_roles (rol_uid, rol_description, rol_delete, rol_status) values ($rol_uid, '".$rol_name."', 0,'ACTIVE')";
$db->query($sqldat);

admin::getDBvalue("delete from sys_modules_users where mus_rol_uid=".$rol_uid." and mus_place='MODULE'");
admin::getDbValue("delete from sys_modules_access where moa_rol_uid=$rol_uid");
                        
$modId = admin::getParam("mod_uid","strip");
//print_r($modId);die;
if(is_array($modId)){
    foreach ($modId as $key => $value) {
        $sql = "insert into sys_modules_users (mus_rol_uid,mus_mod_uid,mus_place,mus_delete) values (".$rol_uid.", ".$key.", 'MODULE', 0)";
        $db->query($sql);
        //echo "Modulo:".$key." - ".$value. "<br>";
        //echo $sql."<br>";
        if (is_array($value)){
            foreach ($value as $key1 => $value1) {
               // echo "submodulo:" . $key1." - " . $value1."<br>";
                $sql = "insert into sys_modules_users (mus_rol_uid,mus_mod_uid,mus_place,mus_delete) values (".$rol_uid.", ".$key1.", 'MODULE', 0)";
                $db->query($sql);
                //echo $sql."<br>";
                if (is_array($value1)){
                    foreach ($value1 as $value2) {
                        $sql = "insert into sys_modules_access (moa_rol_uid,moa_mop_uid, moa_status) values (".$rol_uid.", ".$value2.", 'ACTIVE')";
                        $db->query($sql);
                       //echo $sql."<br>";
                        //echo "opcion:" .  $value2."<br>";
                    }
                }
            }
        }       
    }
}
$token=admin::getParam("token");

header('Location: ../../rolesList.php');
?>