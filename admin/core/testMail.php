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
  
        $mail->AddAddress("jorge.siles@gmail.com");
        $mail->Subject ="";
        $mail->Body =" test de envio ";
        $exito = $mail->Send();
        $intentos=1; 
        while ((!$exito) && ($intentos < 3)) {
              sleep(5);
              $exito = $mail->Send();
              $intentos=$intentos+1;	
         }
         if(!$exito)
         {
             echo 'falla ';
         }
         else
         {
             echo 'Ok';
         } 