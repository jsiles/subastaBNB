<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('users','usersEdit',false);

$use_uidA = admin::toSql(admin::getParam("use_uidA"),"Text");
$usr_loginA = admin::toSql(admin::getParam("usr_login"),"Text");
$usr_passA = admin::toSql(admin::getParam("usr_pass"),"Text");
$usr_firstnameA = admin::toSql(admin::getParam("usr_firstname"),"Text");
$usr_lastnameA = admin::toSql(admin::getParam("usr_lastname"),"Text");
$usr_emailA = admin::toSql(admin::getParam("usr_email"),"Text");
$usr_photoA = admin::toSql(admin::getParam("usr_photo"),"Text");
$usr_statusA = admin::toSql(admin::getParam("usr_status"),"Text");
$usr_rolA = admin::toSql(admin::getParam("usr_rol"),"Number");
if ($usr_passA!=""){ $changepassA = "usr_pass='" . md5($usr_passA) . "',";}


			
$sql = "update sys_users set
			usr_firstname='".$usr_firstnameA."', 
			usr_lastname='".$usr_lastnameA."',";
if($usr_statusA!='') {$sql .= "usr_status='".$usr_statusA."', ";}
                       $sql .= $changepassA." usr_email='".$usr_emailA."' where usr_uid=".$use_uidA;
$db->query($sql);
// SUBIENDO LA IMAGEN
$FILES = $_FILES ['usr_photo'];
		
        $allowedTypes = array("jpeg","jpg","gif","bmp", "png");
        $validFile = $FILES['name'] != '' && in_array( strtolower(pathinfo($FILES["name"],PATHINFO_EXTENSION)),$allowedTypes) ? true : false;		
		
if ($validFile && $FILES['error']==0)
	{
	// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
	$extensionFile = admin::getExtension($FILES["name"]);
	$fileName = admin::imageName($usr_loginA)."_".$use_uidA.".".$extensionFile;
	// DATOS DE REDIMENCION DE IMAGENES
	$nomIMG = admin::imageName($usr_loginA)."_".$use_uidA.".jpg";
	$nomIMG2 = "thumb_".$nomIMG;
	$nomIMG22 = "thumb2_".$nomIMG;
	$nomIMG3 = "img_".$nomIMG;
	// Subimos el archivo con el nombre original
	classfile::uploadFile($FILES,PATH_ADMIN . '/upload/profile/',$fileName);
	// redimencionamos al mismo pero con extencion jpg en el mismo tamaño
	redimImgPercent(PATH_ADMIN . "/upload/profile/" . $fileName, PATH_ADMIN . "/upload/profile/". $nomIMG,100,100);
	// Redimencionamos el nuevo jpg por el ancho definido
	redimImgWH(PATH_ADMIN . "/upload/profile/" . $nomIMG, PATH_ADMIN . "/upload/profile/". $nomIMG2,60,100);
	// Redimencionamos el nuevo jpg por el ancho definido
	redimImgWidth(PATH_ADMIN . "/upload/profile/" . $nomIMG, PATH_ADMIN . "/upload/profile/". $nomIMG22,31,100);	
	// Redimencionamos el nuevo jpg por el ancho definido
	redimImgWidth(PATH_ADMIN . "/upload/profile/" . $nomIMG, PATH_ADMIN . "/upload/profile/". $nomIMG3,300,100);
	// GUARDAMOS LA PRINCIPAL EN BASE DE DATOS
	$sql = "UPDATE sys_users SET usr_photo='".$nomIMG."' WHERE usr_uid=".$use_uidA;
	$db->query($sql);
	}
	
	$sql = "update mdl_roles_users set rus_rol_uid=".$usr_rolA." where rus_usr_uid=".$use_uidA;
	$db->query($sql);

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
            header("Location: ../../userList.php");		
        }
?>