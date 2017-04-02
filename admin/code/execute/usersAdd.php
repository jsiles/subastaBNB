<?php
include_once("../../database/connection.php");  
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('users','usersAdd'); 
$sessionUser = $_SESSION["usr_uid"];
if ($sessionUser==1 || $sessionUser==2)
	$usr_uid_tmp=0;
else
	$usr_uid_tmp = $sessionUser;
// use_uid,use_delete,use_confirmed
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

if ($_POST["use_password"]!="") 
	{
	$changepass1 = " use_password, ";
	$changepass2 = " '" . md5($_POST["use_password"]) . "', ";
	$confirmed=1;
	}
else 
	{
	$confirmed=0;
	$changepass1 = "";
	$changepass2 = "";
	}
// use_uid use_are_uid use_charge use_image use_ci use_delete use_login use_confirmed use_new use_cookie
$sql = "insert into mdl_users(							
							use_gender,
							use_name,
							use_lastname,
							use_datenac,
							use_country,
							use_city,
							use_address,
							use_dateing,
							use_status,
							" . $changepass1 . "
							use_phone,
							use_cellular,							
							use_mail,
							use_usr_uid
							)
					values	(
							'" . $use_gender . "',
							'" . $use_name . "', 
							'" . $use_lastname . "', 
							'" . $use_datenac . "',							
							'" . $use_country . "',
							'" . $use_city . "',
							'" . $use_address . "',
							GETDATE(),
							'" . $use_status . "',
							" . $changepass2 . "
							'" . $use_phone . "',
							'" . $use_cellular . "',
							'" . $use_email . "',
							" . $usr_uid_tmp . "
							)";
					
$db->query($sql);

// OBTENEMOS EL ULTIMO ID INTRODUCIDO POR EL USUARIO EN LA BASE DE DATOS
// ULTIMO REGISTRO
$sql="SELECT LAST_INSERT_ID() as UID;";
$db2->query($sql);
$content = $db2->next_record();
$use_uid = $content["UID"];

// SUBIENDO LA IMAGEN NOTICIAS
$FILES = $_FILES ['use_image'];
if ($FILES["name"] != '')
	{
	// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
	$extensionFile = admin::getExtension($FILES["name"]);
	$fileName = admin::imageName($use_lastname) . "_". $use_uid . "." . $extensionFile;
	// DATOS DE REDIMENCION DE IMAGENES
	$nomIMG = admin::imageName($use_lastname) . "_". $use_uid .".jpg";
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
?>
<script language="javascript" type="text/javascript">
document.location.href='../../usersList.php'; 
</script>