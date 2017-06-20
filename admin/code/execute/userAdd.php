<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
include_once("../../core/safeHtml.php");
admin::initialize('users','usersNew',false);

$usr_loginA = admin::toSql(safeHtml(admin::getParam("usr_login")),"String");
$usr_passA = admin::toSql(safeHtml(admin::getParam("usr_pass")),"String");
$usr_firstnameA = admin::toSql(safeHtml(admin::getParam("usr_firstname")),"String");
$usr_lastnameA = admin::toSql(safeHtml(admin::getParam("usr_lastname")),"String");
$usr_emailA = admin::toSql(safeHtml(admin::getParam("usr_email")),"String");
$usr_photoA = admin::toSql(safeHtml(admin::getParam("usr_photo")),"String");
$usr_statusA = admin::toSql(safeHtml(admin::getParam("usr_status")),"String");
$usr_rolA = admin::toSql(safeHtml(admin::getParam("usr_rol")),"Number");
$usr_statusA = ($usr_statusA==1)?'ACTIVE':'INACTIVE';
//admin::doLog("Usuario:".$usr_loginA."|Pass:".$usr_passA."|");
if ($usr_passA!="") 
	{
	$changepass1 = " usr_pass ";
	$changepass2 = " '".md5($usr_passA)."' ";
	$confirmed=1;
	}
else 
	{
	$confirmed=0;
	$changepass1 = "";
	$changepass2 = "";
	}


$usr_exist = admin::getDBvalue("select usr_login FROM sys_users where usr_login='".$usr_loginA."'");

if($usr_exist==""){
$usr_max = admin::getDBvalue("select max(usr_uid) FROM sys_users ");	
$usr_max++;
	$sql = "insert into sys_users(							
		                        usr_uid,
								usr_login,
								usr_firstname,
								usr_lastname,
								usr_email,
								usr_status,
								usr_delete,
                                                                usr_date,
								".$changepass1."
								)
						values	(
							    ".$usr_max.",
								'".$usr_loginA."',
								'".$usr_firstnameA."', 
								'".$usr_lastnameA."', 
								'".$usr_emailA."',							
								'".$usr_statusA."',
								0,
                                                                GETDATE(),
								".$changepass2."
								)";
        //echo $sql;die;
	$db->query($sql);

		// OBTENEMOS EL ULTIMO ID INTRODUCIDO POR EL USUARIO EN LA BASE DE DATOS
		// ULTIMO REGISTRO
/*		$sql="SELECT SCOPE_IDENTITY() as UID;";
		$db2->query($sql);
		$content = $db2->next_record();
		$use_uidA = $content["UID"];*/

	$maxRolUser=admin::getDBvalue("select max(rus_uid) from mdl_roles_users");	
	$maxRolUser++;
	$sql = "insert into mdl_roles_users(rus_uid,rus_usr_uid,rus_rol_uid) values (".$maxRolUser.",".$usr_max.",".$usr_rolA.")";

	$db->query($sql);
	// SUBIENDO LA IMAGEN 		
	$FILES = $_FILES ['usr_photo'];
		
        $allowedTypes = array("jpeg","jpg","gif","bmp", "png");
        $validFile = $FILES['name'] != '' && in_array( strtolower(pathinfo($FILES["name"],PATHINFO_EXTENSION)),$allowedTypes) ? true : false;		
//echo "validFile".$validFile."FILES:".$FILES['error'];		
//print_r($FILES);
$use_uidA= $usr_max;
if ($validFile && $FILES['error']==0)
	{
	// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
    //echo "FOTO"."<br>";
	$extensionFile = admin::getExtension($FILES["name"]);
	$fileName = admin::imageName($usr_loginA)."_".$use_uidA.".".$extensionFile;
	// DATOS DE REDIMENCION DE IMAGENES
	$nomIMG = admin::imageName($usr_loginA)."_".$use_uidA.".jpg";
	$nomIMG2 = "thumb_".$nomIMG;
	$nomIMG22 = "thumb2_".$nomIMG;
	$nomIMG3 = "img_".$nomIMG;
	// Subimos el archivo con el nombre original
        //echo "FOTO1"."<br>";
	classfile::uploadFile($FILES,PATH_ADMIN . '/upload/profile/',$fileName);
	// redimencionamos al mismo pero con extencion jpg en el mismo tamaño
        //echo "FOTO2"."<br>";
	redimImgPercent(PATH_ADMIN . "/upload/profile/" . $fileName, PATH_ADMIN . "/upload/profile/". $nomIMG,100,100);
	// Redimencionamos el nuevo jpg por el ancho definido
        //echo "FOTO3"."<br>";
	redimImgWH(PATH_ADMIN . "/upload/profile/" . $nomIMG, PATH_ADMIN . "/upload/profile/". $nomIMG2,60,100);
	// Redimencionamos el nuevo jpg por el ancho definido
        //echo "FOTO4"."<br>";
	redimImgWidth(PATH_ADMIN . "/upload/profile/" . $nomIMG, PATH_ADMIN . "/upload/profile/". $nomIMG22,31,100);	
	// Redimencionamos el nuevo jpg por el ancho definido
       // echo "FOTO5"."<br>";
	redimImgWidth(PATH_ADMIN . "/upload/profile/" . $nomIMG, PATH_ADMIN . "/upload/profile/". $nomIMG3,300,100);
	// GUARDAMOS LA PRINCIPAL EN BASE DE DATOS
        //echo "FOTO6"."<br>";
	$sql = "UPDATE sys_users SET usr_photo='".$nomIMG."' WHERE usr_uid=".$use_uidA;
       // echo $sql."<br>";
	$db->query($sql);
//        echo "FOTO7"."<br>";die;
	}
//        die;

}
$token=admin::getParam("token");		
	
header('Location: ../../userList.php');
?>