<?php 
include_once("../../core/admin.php");
//print_r($_SESSION);
$usuario    = admin::getParam('usuario');
$contrasena = admin::getParam('contrasena');
$captcha = admin::getParam('captcha');
$sCaptcha= admin::getSession("code");
$sTokenCSRF=admin::getParam('csrf_token');
//echo $captcha ."/".$sCaptcha;die;
if(is_numeric(safeHtml(admin::getParam("message"))))
$message = safeHtml(admin::getParam("message")) + 1;
else $message = 1;
//echo "Tok:".$sTokenCSRF;
if ( !empty( $sTokenCSRF ) ) {
 
    if(admin::checkToken($sTokenCSRF, 'protectedForm' ) ) {
        // valid form, continue
//echo "Tok:".$sTokenCSRF;
    
if(isset($captcha)&&$captcha!=""&&$captcha==$sCaptcha)
{
if ($usuario=="" || $contrasena==""){
	header('Location: ../../index.php?&message=$message');	
	die;
	}
        

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
	header('Location: ../../index.php?message='.$message);
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
		if(!(MULTIPLE_INSTANCES===true)){
			$sql = "update sys_users_verify set suv_status=2 where suv_cli_uid='" . $Datos["usr_uid"] . "' and suv_status=0";
			//die($sql);
			$db->query($sql); 
		}
					
		$token = sha1(PREFIX.uniqid( rand(), TRUE ));		
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
                     if(strpos($urlSite, '?')!==FALSE){
                                                    $urlSite.="&token=".$token;
                                                }else{
                                                    $urlSite.="?token=".$token;
                                                }
                //echo $urlSite;die;                                                
                //if($usuario=="director4") admin::doLog("urlSites:".$urlSite."|token:".$token);                                                
                header("Location: ../../".$urlSite);
                }else{
                    header("Location: ../../index.php?error=1");
                }
	}
}else{
             header("Location: ../../index.php?error=2&message=$message");
             die;
        }

        }
 
}  else {
header("HTTP/1.0 403 Forbidden");    
}
?>