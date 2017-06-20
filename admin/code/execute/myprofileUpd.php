<?php
// echo "en contruccion"; die; 
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('myprofile','myprofileUpd');  
if (admin::getParam("usr_pass")!="")
	{
	$passwordChg = "usr_pass='" . admin::getParam("usr_pass") . "', ";
	}

$sql = "update sys_users set 
				usr_login='" . admin::getParam("usr_login") . "', 
				" . $passwordChg . "
				usr_firstname='" . admin::getParam("usr_firstname") . "', 
				usr_lastname='" . admin::getParam("usr_lastname") . "', 
				usr_email='" . admin::getParam("usr_email") . "', 
				usr_phone='" . admin::getParam("usr_phone") . "', 
				usr_fax='" . admin::getParam("usr_fax") . "', 
				usr_cellular='" . admin::getParam("usr_cellular") . "', 
				usr_address='" . admin::getParam("usr_address") . "', 
				usr_type='" . admin::getParam("usr_type") . "', 
				usr_status='" . admin::getParam("usr_status") . "', 
				usr_country='" . admin::getParam("usr_country") . "', 
				usr_state='" . admin::getParam("usr_state") . "', 
				usr_city='" . admin::getParam("usr_city") . "'				
		where usr_uid=" . $_SESSION["usr_uid"];
// usr_photo='" . admin::getParam("usr_photo"] . "'
//echo $sql;die;
$db->query($sql);

// SUBIENDO LA IMAGEN DE SALA DE PRENSA						
$FILES = $_FILES ['usr_photo'];
if ($FILES["name"] != '')
	{	
	// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
	$extensionFile = admin::getExtension($FILES["name"]);
	$fileName = admin::imageName(admin::getParam("usr_login")) . "_". $_SESSION["usr_uid"] . "." . $extensionFile;
	// CONVIRTIENDO FORMATOS
	$nomIMGStd = admin::imageName(admin::getParam("usr_login")) . "_". $_SESSION["usr_uid"] .".jpg";
	$nomIMG = "img_" . $nomIMGStd;
	$nomIMG2 = "thumb_" . $nomIMGStd;
	classfile::uploadFile($FILES,PATH_ROOT . '/admin/upload/profile/',$fileName);		
	// redimencionamos al mismo pero con extencion jpg en el mismo tamaño
	redimImgPercent(PATH_ROOT . "/admin/upload/profile/" . $fileName, PATH_ROOT . "/admin/upload/profile/". $nomIMGStd,100,100);
	
	redimImgWidth(PATH_ROOT . "/admin/upload/profile/" . $nomIMGStd, PATH_ROOT . "/admin/upload/profile/". $nomIMG,300,100);
	
	redimImgWH(PATH_ROOT . "/admin/upload/profile/" . $nomIMGStd, PATH_ROOT . "/admin/upload/profile/". $nomIMG2,50,100);
	$sql = "UPDATE sys_users SET usr_photo='" . $nomIMGStd . "' 
			WHERE  usr_uid = " . $_SESSION["usr_uid"];			
	$db->query($sql);
	$_SESSION["usr_photo"] = $nomIMGStd;
	}
$_SESSION["usr_firstname"]=admin::getParam("usr_firstname");
$_SESSION["usr_lastname"]=admin::getParam("usr_lastname");
?>
<script language="javascript" type="text/javascript">
document.location.href='../../<?=admin::getFirstModule($_SESSION["usr_uid"]);?>'; 
</script>