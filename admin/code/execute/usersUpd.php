<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('users','usersAdd'); 
$use_uid = $_POST["use_uid"];
$use_datenac = admin::changeFormatDate($_POST["use_datenac"],1);
$use_gender = admin::toSql($_POST["use_gender"],"String");
$use_name = admin::toSql($_POST["use_name"],"String");
$use_lastname = admin::toSql($_POST["use_lastname"],"String");
$use_country = admin::toSql($_POST["use_country"],"String");
$use_city = admin::toSql($_POST["use_city"],"String");
$use_address = admin::toSql($_POST["use_address"],"String");
$use_phone = admin::toSql($_POST["use_phone"],"String");
$use_cellular = admin::toSql($_POST["use_cellular"],"String");
$use_email = admin::toSql($_POST["use_email"],"String");
$use_status = admin::toSql($_POST["use_status"],"String");
$use_password = admin::toSql($_POST["use_password"],"String");


if ($use_password!="") $changepass = "use_password='" . md5($use_password) . "',";

$sql = "update mdl_users set
			use_gender='" . $use_gender . "',
			use_name='" . $use_name . "', 
			use_lastname='" . $use_lastname . "',
			use_datenac='" . $use_datenac . "',	
			use_country='" . $use_country . "',
			use_city='" . $use_city . "',
			use_address='" . $use_address . "',
			use_status='" . $use_status . "',
			" . $changepass . "
			use_phone='" . $use_phone . "',
			use_cellular='" . $use_cellular . "',
			use_mail='" . $use_email . "'
		where use_uid=" . $use_uid;
$db->query($sql);

// SUBIENDO LA IMAGEN NOTICIAS
$FILES = $_FILES ['use_image'];
if ($FILES["name"] != '')
	{
	// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
	$extensionFile = admin::getExtension($FILES["name"]);
	$fileName = admin::imageName($use_name) . "_". $use_uid . "." . $extensionFile;
	// DATOS DE REDIMENCION DE IMAGENES
	$nomIMG = admin::imageName($use_name) . "_". $use_uid .".jpg";
	$nomIMG2 = "thumb_" . $nomIMG;
	$nomIMG22 = "thumb2_" . $nomIMG;
	$nomIMG3 = "img_" . $nomIMG;
	// Subimos el archivo con el nombre original
	classfile::uploadFile($FILES,PATH_ROOT . '/admin/upload/users/',$fileName);
	// redimencionamos al mismo pero con extencion jpg en el mismo tamaño
	redimImgPercent(PATH_ROOT . "/admin/upload/users/" . $fileName, PATH_ROOT . "/admin/upload/users/". $nomIMG,100,100);
	// Redimencionamos el nuevo jpg por el ancho definido
	redimImgWH(PATH_ROOT . "/admin/upload/users/" . $nomIMG, PATH_ROOT . "/admin/upload/users/". $nomIMG2,60,100);
	// Redimencionamos el nuevo jpg por el ancho definido
	redimImgWidth(PATH_ROOT . "/admin/upload/users/" . $nomIMG, PATH_ROOT . "/admin/upload/users/". $nomIMG22,31,100);	
	// Redimencionamos el nuevo jpg por el ancho definido
	redimImgWidth(PATH_ROOT . "/admin/upload/users/" . $nomIMG, PATH_ROOT . "/admin/upload/users/". $nomIMG3,300,100);
	// GUARDAMOS LA PRINCIPAL EN BASE DE DATOS
	$sql = "UPDATE mdl_users SET use_image='" . $nomIMG . "' 
			WHERE  use_uid = " . $use_uid;
	$db->query($sql);
	}
if ($use_password!="")
	{
	// Enviando el correo con el password al usuario
	$ct_mail = "informaciones@empoderamientomujeres.org";
	$ct_name = "Empoderamiento";
	$ct_nameto = $use_lastname . " " . $use_name;
	//$ct_mailto = "informaciones@empoderamientomujeres.org";
	$ct_mailto = $use_email;
	include("../../phpmailer/config.php");
	include("../../phpmailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->From     = $ct_mail;
	$mail->FromName = $ct_name;
	$mail->Host     = MAILSERVER;
	$mail->Mailer   = MAILTYPE;
	$mail->Subject  = "Invitación Empoderamiento";
	$body  = '<img src="http://www.empoderamientomujeres.org/lib/logo.gif" alt="Convenio de Empoderamiento de la Mujer" title="Convenio de Empoderamiento de la Mujer"><br>
	<br>
	<div style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">Estimado(a) '. $ct_nameto . ' queremos que participe con nosotros en el foro de www.empoderamientomujeres.org, para su participación solo debe ingresar a nuestro foro con la siguiente información:</div>
	<br />
	
	<table border="0" cellpadding="0" cellspacing="3" width="500" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">
		<tr>
		<td width="23%">usuario:</td>
		<td width="77%">' . $ct_mailto . '</td>
		</tr>
		<tr>
		  <td valign="top">Contrase&ntilde;a:</td>
		  <td>' . $_POST["use_password"] . '</td>
		</tr>
	</table>';
	
	// Plain text body (for mail clients that cannot read HTML)
	$text_body  = '
	CONVENIO PARA EL EMPODERAMIENTO DE LA MUJER
	
	Estimado(a) '. $ct_name . ' queremos que participe con nosotros en el foro de www.empoderamientomujeres.org, para su participación solo debe ingresar a nuestro foro con la siguiente información:
	
	
	usuario:	' . $ct_mail . '
	
	Contraseña: 	' . $_POST["use_password"];
	
	$mail->Body    = $body;
	$mail->AltBody = $text_body; 
	
	$mail->AddAddress($ct_mailto, $ct_nameto);
	// $mail->AddBCC("logos@logoscomunicaciones.com", "Logos Comunicacion");
	// $mail->AddStringAttachment($row["photo"], "YourPhoto.jpg");´
	
	if(!$mail->Send())
		$msg= "Error al enviar la consulta.";
	else
		$msg="Su consulta fu&eacute; enviada correctamente.";
	// Clear all addresses and attachments for next loop
	$mail->ClearAddresses();
	//$mail->ClearAttachments();	

	}	
?>
<script language="javascript" type="text/javascript">
document.location.href='../../usersList.php'; 
</script>