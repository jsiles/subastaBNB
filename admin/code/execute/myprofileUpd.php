<?php
// echo "en contruccion"; die; 
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('myprofile','myprofileUpd'); 
// ban_uid
// usr_uid=" . $_POST["usr_uid"] . ", 
if ($_POST["usr_pass"]!="")
	{
	$passwordChg = "usr_pass='" . $_POST["usr_pass"] . "', ";
	}

$sql = "update sys_users set 
				usr_login='" . $_POST["usr_login"] . "', 
				" . $passwordChg . "
				usr_firstname='" . $_POST["usr_firstname"] . "', 
				usr_lastname='" . $_POST["usr_lastname"] . "', 
				usr_email='" . $_POST["usr_email"] . "', 
				usr_phone='" . $_POST["usr_phone"] . "', 
				usr_fax='" . $_POST["usr_fax"] . "', 
				usr_cellular='" . $_POST["usr_cellular"] . "', 
				usr_address='" . $_POST["usr_address"] . "', 
				usr_type='" . $_POST["usr_type"] . "', 
				usr_status='" . $_POST["usr_status"] . "', 
				usr_country='" . $_POST["usr_country"] . "', 
				usr_state='" . $_POST["usr_state"] . "', 
				usr_city='" . $_POST["usr_city"] . "'				
		where usr_uid=" . $_SESSION["usr_uid"];
// usr_photo='" . $_POST["usr_photo"] . "'
//echo $sql;die;
$db->query($sql);

// SUBIENDO LA IMAGEN DE SALA DE PRENSA						
$FILES = $_FILES ['usr_photo'];
if ($FILES["name"] != '')
	{	
	// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
	$extensionFile = admin::getExtension($FILES["name"]);
	$fileName = admin::imageName($_POST["usr_login"]) . "_". $_SESSION["usr_uid"] . "." . $extensionFile;
	// CONVIRTIENDO FORMATOS
	$nomIMGStd = admin::imageName($_POST["usr_login"]) . "_". $_SESSION["usr_uid"] .".jpg";
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
$_SESSION["usr_firstname"]=$_POST["usr_firstname"];
$_SESSION["usr_lastname"]=$_POST["usr_lastname"];
?>
<script language="javascript" type="text/javascript">
document.location.href='../../<?=admin::getFirstModule($_SESSION["usr_uid"]);?>'; 
</script>