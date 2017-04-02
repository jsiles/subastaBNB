<?php
  require_once "../phpmailer/class.phpmailer.php";
  require_once "./mail.cfg";
  require_once "./admin.php";
  set_time_limit(310);
  $mail = new phpmailer();
  $mail->PluginDir = "";
  $mail->Mailer = "smtp";
  $mail->Host = "mail.sintesis.com.bo";
  $mail->SMTPAuth = true;
  $mail->Username = "jorges"; 
  $mail->Password = "0bje.TIVO";
  $mail->From = "jorges@sintesis.com.bo";
  $mail->FromName = "Jorge Siles";
  $mail->Timeout=300;
  $mail->SMTPSecure = "";
  $mail->Port=25;
   
  $mail->SetLanguage("en", '../phpmailer/language/');
  
  $sSQL="select * from mdl_notificacion_envio where noe_status=0 and noe_retry<=2 and noe_email!=''";
  $nroReg=$db->numrows($sSQL);
  if($nroReg>0){
    $db->query($sSQL);
    while($noe=$db->next_record())
    {
        //echo $noe["noe_email"];
        $mail->AddAddress($noe["noe_email"]);
        $mail->Subject =admin::getDbValue("select not_subject from mdl_notificacion_template where not_nti_uid=".$noe["noe_tip_uid"]);
        $mail->Body =admin::getDbValue("select concat(not_template,'\n',not_sign) as body from mdl_notificacion_template where not_nti_uid=".$noe["noe_tip_uid"]);
        if($noe["noe_attach"]!=""){
        $mail->addAttachment(PATH_ROOT.$noe["noe_attach"]);
        }
      //  $mail->AltBody = "Mensaje de prueba mandado con phpmailer en formato solo texto";
        $exito = $mail->Send();
        $intentos=1; 
        while ((!$exito) && ($intentos < 3)) {
              sleep(5);
              $exito = $mail->Send();
              $intentos=$intentos+1;	
         }
         if(!$exito)
         {
             //echo 'falla ';
             admin::getDbValue("update mdl_notificacion_envio set noe_retry=$intentos, noe_response='".$mail->ErrorInfo."' where noe_uid=".$noe["noe_uid"]);
             //echo "update mdl_notificacion_envio set noe_retry=$intentos, noe_response='".$mail->ErrorInfo."' where noe_uid=".$noe["noe_uid"];
         }
         else
         {
             //echo 'Ok';
             admin::getDbValue("update mdl_notificacion_envio set noe_retry=$intentos, noe_status=1, noe_response='OK' where noe_uid=".$noe["noe_uid"]);	
         } 
    }
  }
?>
