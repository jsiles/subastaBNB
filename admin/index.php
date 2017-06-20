<?php
include ("core/admin.php");
admin::checkIP();
admin::lockUser();
$sFormAction= admin::getParam("sFormAction");
if($sFormAction!='ingresar') {
$code=rand(10000,99999);
$code=  urlencode(SymmetricCrypt::Encrypt($code));
admin::setSession("code", $code);}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="lib/favicon.ico" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/dhtml_horiz.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema de Subastas</title>
<META NAME="author" CONTENT="DEVZONE">
<META NAME="copyright" CONTENT="Software propietario de DEVZONE" />
<META NAME="rating" CONTENT="General">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link rel="stylesheet" href="<?=$domain?>/admin/css/style.css" type="text/css" />
<link rel="stylesheet" href="<?=$domain?>/admin/css/dhtml_horiz.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=$domain?>/admin/css/sweetTitles.css" />
<script language="javascript" type="text/javascript" src="js/addEvent.js"></script>
<script language="javascript" type="text/javascript" src="js/sweetTitles.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/md5.min.js"></script>
<script language="javascript" type="text/javascript" src="js/ajaxlib.js?version=<?=VERSION?>"></script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="header">
                <tr><td height="10px" colspan="3"></td></tr>
          <tr>
            <td width="21%" rowspan="3"></td>
            <td width="66%" height="36"><img  src="lib/logo.png"></td>
            <td width="13%" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center"></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="31" valign="bottom">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
              <table  width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><?php include_once('code/template/loginTpl.php'); ?></td>
                </tr>
            </table></td>
      </tr>
     <tr>
    <td valign="top" id="footer" align="right">&nbsp;</td>
  </tr>
    </table></td>
  </tr>
</table>
<div>
	<div style="float:left; margin-left:50px">
            <br/><span class="small">Derechos reservados &copy; SCLE LTDA.</span> <br/>
            <span class="small">Soluciones de Compras y Log&iacute;stica Empresarial</span><br />
            <span class="small">Versi&oacute;n: <?=VERSION?><?php echo " DB:".admin::getDbValue("select ver_uid from mdl_version");?></span>
    </div>
    <div  style="float:right; margin-right:50px">
    <img src="lib/scle.png" alt="scle">
    </div>
</div>
</body>

</html>