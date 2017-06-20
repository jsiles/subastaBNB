<?php 
$get_msg = admin::getParam("message");
$get_msg = filter_var($get_msg,FILTER_SANITIZE_STRING);
$get_msg = filter_var($get_msg,FILTER_SANITIZE_SPECIAL_CHARS);
$get_msg = filter_var($get_msg,FILTER_SANITIZE_STRIPPED);
if ($get_msg!="") $message=$get_msg; else $message=0; 
$error=admin::getParam("error");
$error= filter_var($error,FILTER_SANITIZE_SPECIAL_CHARS);
$error= filter_var($error,FILTER_SANITIZE_STRING);
$error= filter_var($error,FILTER_SANITIZE_STRIPPED);
$lockedAccount=admin::getSession("LOCK_IP");
$flagIP =admin::getSession("CHECK_IP");
if(strlen($sFormAction)>0){if($sFormAction=='ingresar') showLogin();else admin::lockFailed();}

//echo "SS".$lockedAccount;
if ((!$lockedAccount)&&(!$flagIP)) {

  ?>

<br />
<br />
<br />
<script language="javascript" type="text/javascript">
function aceptar(){
    //alert(1);
    var sena = document.getElementById("contrasena").value;
    var usuario = document.getElementById("usuario").value;
    var captcha = document.getElementById("captcha").value;
    sw=true;
    
    if(usuario.length==0) { document.getElementById('usuario').className='inputError';
		document.getElementById('divusuario').style.display='';
		sw=false;
    }
    if(sena.length==0) { document.getElementById('contrasena').className='inputError';
        document.getElementById('divsena').style.display='';
        sw=false;
    }
    if(captcha.length==0) { document.getElementById('captcha').className='inputError';
        document.getElementById('divcaptcha').style.display='';
        sw=false;
    }
     

    if(sw){
         
        document.getElementById("contrasena").value=md5(sena);
        document.getElementById("sFormAction").value='ingresar';
        document.formulario.submit();
    }else{scroll(0,0); return false;}
}
</script>
<form name="formulario" method="POST" enctype="multipart/form-data">
<input type="hidden" name="message" value="<?=$message?>" />
<table width="70%" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr>
     <td width="99%" height="40"  align="center"><span class="title">SISTEMA ELECTR&Oacute;NICO DE ADQUISICIONES Y REGISTRO DE PROVEEDORES</span></td>
  </tr>
  <tr><td>
      
<table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
 
  <tr>
      <td width="77%" height="40"><span>M&oacute;dulo: USUARIOS</span></td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top">
			<table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
			<input type="hidden" name="message" value="<?=$message?>" />
			<tr><td colspan="3" height="2"></td></tr>
			<tr>
            <td width="29%"><?=admin::labels('login','user');?>:</td>
            <td width="64%"><input name="usuario" id="usuario" type="text" autocomplete="off" class="inputl" size="30" value=""  onclick="setClassInputLogin(this,'ON');"  onfocus="setClassInputLogin(this,'ON');" onblur="setClassInputLogin(this,'OFF');" tabindex="1" onkeyup="if (event.keyCode==13) document.getElementById('contrasena').focus();"/></td>
            <td width="7%">&nbsp;</td>
          </tr>
            <tr><td></td><td colspan="2"><div id="divusuario" class="error" style="display:none;">Ingrese nombre de usuario</div></td></tr>
          <tr>
            <td><?=admin::labels('login','password');?>: </td>
            <td><input name="contrasena" id="contrasena" autocomplete="off" type="password" class="inputl" size="30"  onclick="setClassInputLogin(this,'ON');"  onfocus="setClassInputLogin(this,'ON');" onblur="setClassInputLogin(this,'OFF');" tabindex="2" onkeyup="if (event.keyCode==13) document.getElementById('captcha').focus();"/></td>
            <td>&nbsp;</td>
          </tr>
          <tr><td></td><td colspan="2"><div id="divsena" class="error" style="display:none;">Ingrese contrase&ntilde;a</div></td></tr>
          <tr>
              <td>&nbsp;</td>
            <td><img src="core/captcha.php?t=<?=$code?>" alt="CAPTCHA" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
              <td>C&oacute;digo de verificaci&oacute;n:&nbsp;</td>
            <td><input name="captcha" id="captcha" autocomplete="off" type="captcha" class="inputl" size="30"  onclick="setClassInputLogin(this,'ON');"  onfocus="setClassInputLogin(this,'ON');" onblur="setClassInputLogin(this,'OFF');" tabindex="2" onkeyup="if (event.keyCode==13) aceptar();"/>&nbsp;</td>
            <td><input type="hidden" name="csrf_token" id="csrf_token" value="<?=admin::generateToken('protectedForm')?>"/>
                <input type="hidden" id="sFormAction" name="sFormAction" value="<?=sha1(admin::generateToken('protectedForm'))?>"/>&nbsp;</td>
          </tr>
		   <tr><td></td><td colspan="2"><div id="divcaptcha" class="error" style="display:none;">Ingrese captcha</div></td></tr>
          <tr>
		  <td></td>
            <td colspan="2">
                <a href="#" onclick="aceptar();" class="button" tabindex="3">Aceptar</a>	  		</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    </tr>
</table>
      </td>
  </tr></table>
</form><br />
<?php 
if ($message!=0) 
	{ 
	?>
<table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td colspan="2" align="center" >
	<div class="error"><?=admin::labels('login','error');?></div>
	</td>
    </tr>
</table>
<?php }
if($error==1)
{
?>
<table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td colspan="2" align="center" >
	<div class="error">ROL Sin modulos asignados</div>
	</td>
    </tr>
</table>
<?php
}else if($error==2)
{
?>
<table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td colspan="2" align="center" >
        <div class="error">No coincide el C&oacute;digo de verificaci&oacute;n</div>
	</td>
    </tr>
</table>
<?php
}
}else{
   // header('HTTP/1.1 403 Forbidden');
    //header("Refresh:2; url=index.php"); 
    ?>
<table width="70%" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr>
     <td width="99%" height="40"  align="center"><span class="title">SISTEMA ELECTR&Oacute;NICO DE ADQUISICIONES Y REGISTRO DE PROVEEDORES</span></td>
  </tr>
  <tr><td>
      
<table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
 
  <tr>
      <td width="77%" height="40"><span>M&oacute;dulo: USUARIOS</span></td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top">
            <?php
            
            if(!$flagIP){
                
            
?>
			<table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
                            <tr><td class="title">
                                    <b>Cuenta Bloqueada</b><br><br> <b>Hasta horas:</b> <?=admin::getSession("LOCK_TIME")?><br><br> espere e <a class="linkBold2" href="<?=PATH_DOMAIN?>/admin/" title="ingresar">ingrese nuevamente</a>
                                </td></tr>
                        </table>
            <?php 
            }else{
            ?>
            	<table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
                            <tr><td class="title">
                                    <b>IP NO habilitado, cont&aacute;ctese con el administrador, e <a class="linkBold2" href="<?=PATH_DOMAIN?>/admin/" title="ingresar">ingrese nuevamente</a>
                                </td></tr>
                        </table>
            <?php } ?>
        </td>
      </tr>
    </table></td>
    </tr>
</table>
      </td>
  </tr></table>
        <?php

}
?>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<?php
function showLogin()
{
    global $db;
$usuario    = admin::getParam('usuario');
$contrasena = admin::getParam('contrasena');
$captcha = admin::getParam('captcha');
$sCaptcha= SymmetricCrypt::Decrypt(urldecode(admin::getSession("code")));
$sTokenCSRF=admin::getParam('csrf_token');
//echo $captcha ."/".$sCaptcha;die;
if(is_numeric(safeHtml(admin::getParam("message"))))
$message = safeHtml(admin::getParam("message")) + 1;
else $message = 1;
//echo "Tok:".$sTokenCSRF;
if ( !empty( $sTokenCSRF ) ) {
 //echo "Si@";
    if(admin::checkToken($sTokenCSRF, 'protectedForm' ) ) {
        // valid form, continue
//echo "Tok3n:".$sTokenCSRF;

            if(isset($captcha)&&$captcha!=""&&$captcha==$sCaptcha)
            {
                if ($usuario=="" || $contrasena==""){
                        header('Location: index.php?&message=$message');	
                        admin::lockFailed();
                }

                //echo $contrasena;
                $sql = "SELECT * FROM sys_users " .
                        "		WHERE usr_login='".admin::toSql($usuario,'text')."' and ".
                        " usr_pass ='".admin::toSql($contrasena)."' ";

                $numfiles = admin::getDbValue("SELECT count(*) FROM sys_users " .
                        "		WHERE usr_login='".admin::toSql($usuario,'text')."' and ".
                        " usr_pass ='".admin::toSql($contrasena)."' ");
                //if($usuario=="director4") admin::doLog("SQL:".$sql.":cantidad:".$numfiles);        
                                          //usr_pass=LOWER(CONVERT(VARCHAR(32),HashBytes('MD5','".admin::toSql($contrasena,'text')."'),2))";

                $db->query($sql);


                //echo " numfiles ". $numfiles ." ". $sql;die;
                //echo $captcha. "@@".$sCaptcha["code"];die;
                if(($numfiles==0)) {	
                        admin::lockFailed();
                        header('Location: index.php?message='.$message);
                        }
                else
                        {
                        $Datos = $db->next_record();
                                // GENERANDO LAS VARIABLES DE SESSION
                                $_SESSION['USER_LOGGED'] = $uid;
                //        echo $rol;die;
                                $rol=admin::getDBvalue("SELECT rus_rol_uid FROM mdl_roles_users where rus_usr_uid=".$Datos["usr_uid"]);
                                //if($usuario=="director4") admin::doLog("Rol:".$rol);
                                //session_set_cookie_params(100*100);
                //		@session_start();
                                $_SESSION["authenticated"]=true; // identificador si se encuentra logueado
                                $_SESSION["usr_uid"]=$Datos["usr_uid"];
                                $_SESSION["usr_rol"]=$rol;	
                                $_SESSION["usr_photo"] = $Datos["usr_photo"];
                                $_SESSION["usr_firstname"] = $Datos["usr_firstname"];
                                $_SESSION["usr_lastname"] = $Datos["usr_lastname"];
                                /*if($usuario=="director4") admin::doLog("auth;".$_SESSION["authenticated"]);
                                if($usuario=="director4") admin::doLog("UID;".$_SESSION["usr_uid"]);
                                if($usuario=="director4") admin::doLog("ROL;".$_SESSION["usr_rol"]);*/
                                /*
                                Estados de token
                                0 = activo
                                1 = salio correctamente
                                2 = banneado al conectarse desde otra sesion
                                */
                //var_dump(MULTIPLE_INSTANCES);
                                if((MULTIPLE_INSTANCES===true)){
                                        $sql = "update sys_users_verify set suv_status=2 where suv_cli_uid='" . $Datos["usr_uid"] . "' and suv_status=0";
                                        //die($sql);
                                        $db->query($sql); 
                                }

                                $token = sha1(PREFIX.uniqid( rand(), TRUE ));	
                                $_SESSION["token"]=$token;
                                $sSQL  = "insert into sys_users_verify (suv_cli_uid,suv_token,suv_date,suv_ip,suv_status) values (". $Datos["usr_uid"].",'".$token."',GETDATE(),'". $_SERVER['REMOTE_ADDR'] ."',0)";
                                //die($sSQL);
                                $db->query($sSQL); 
                                //if($usuario=="director4") admin::doLog("SQLtoken:".$sSQL."|");
                                $rolDesc=admin::getDBvalue("SELECT rol_description FROM mdl_roles where rol_uid=".$rol);

                                $modAccess = admin::getDBvalue("select top 1 a.mus_mod_uid from sys_modules_users a, sys_modules b where a.mus_rol_uid=".$rol." and a.mus_mod_uid=b.mod_uid and b.mod_status='ACTIVE' and b.mod_parent=0 order by b.mod_position");
                                //if($usuario=="director4") admin::doLog("ModACCess:".$modAccess);
                                $urlSite = admin::getDBValue("select mod_index from sys_modules where mod_uid=". $modAccess ." and mod_status='ACTIVE'");

                                //echo "ROl:".$rolDesc."-". $modAccess."-".$urlSite;die;
                                if($urlSite){

                                //echo $urlSite;die;                                                
                                //if($usuario=="director4") admin::doLog("urlSites:".$urlSite."|token:".$token);                                                
                                admin::unlockIp();
                                header("Location: ".$urlSite);
                                
                                }else{
                                    admin::lockFailed();
                                    header("Location: index.php?error=1");
                                }
                        }
            }else{
                         admin::lockFailed();
                         header("Location: index.php?error=2&message=$message");
                    }

        }else{
            //echo 11;
            admin::lockFailed();
           // admin::doLog("Failed XSS Protection");
            /*header("HTTP/1.0 403 Forbidden");
            header("Location: 403.php");            die;*/
        }
 
}  else {
    admin::lockFailed();
    /*header("HTTP/1.0 403 Forbidden");
    header("Location: 403.php");
die;*/
}
}