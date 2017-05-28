<?php 
$get_msg = admin::getParam("message");
if ($get_msg!="") $message=$get_msg; else $message=0; 
/*if ($message>3)  
setcookie("lockout","1",time() + 10*60,"/");
print_r($_COOKIE);
echo "Cookie:".$_COOKIE["lockout"].admin::getCookie("lockout");
if(admin::getCookie("lockout")!=1)
{   */ 
$error=admin::getParam("error");
/*if ($message>3) {
    header('HTTP/1.1 403 Forbidden');
    header("Refresh:2; url=index.php");
}*/
  ?>

<br />
<br />
<br />
<script language="javascript" type="text/javascript">
function onSubmit(){
    var sena = document.getElementById("contrasena").value;
    document.getElementById("contrasena").value=md5(sena);
    document.formulario.submit();
}
</script>
<form name="formulario" method="POST" enctype="multipart/form-data" action="code/execute/login.php">
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
            <td width="64%"><input name="usuario" type="text" autocomplete="off" class="inputl" size="30" value=""  onclick="setClassInputLogin(this,'ON');"  onfocus="setClassInputLogin(this,'ON');" onblur="setClassInputLogin(this,'OFF');" tabindex="1" onkeyup="if (event.keyCode==13) document.getElementById('contrasena').focus();"/></td>
            <td width="7%">&nbsp;</td>
          </tr>
		  <tr><td></td><td colspan="2"><div class="error" style="display:none;">Ingrese nombre de usuario</div></td></tr>
          <tr>
            <td><?=admin::labels('login','password');?>: </td>
            <td><input name="contrasena" id="contrasena" autocomplete="off" type="password" class="inputl" size="30"  onclick="setClassInputLogin(this,'ON');"  onfocus="setClassInputLogin(this,'ON');" onblur="setClassInputLogin(this,'OFF');" tabindex="2" onkeyup="if (event.keyCode==13) document.getElementById('captcha').focus();"/></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
              <td>&nbsp;</td>
            <td><img src="core/captcha.php?t=<?=$code?>" alt="CAPTCHA" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
              <td>C&oacute;digo de verificaci&oacute;n:&nbsp;</td>
            <td><input name="captcha" id="captcha" autocomplete="off" type="captcha" class="inputl" size="30"  onclick="setClassInputLogin(this,'ON');"  onfocus="setClassInputLogin(this,'ON');" onblur="setClassInputLogin(this,'OFF');" tabindex="2" onkeyup="if (event.keyCode==13) onSubmit();"/>&nbsp;</td>
            <td><input type="hidden" name="csrf_token" value="<?=admin::generateToken('protectedForm')?>"/>&nbsp;</td>
          </tr>
		   <tr><td></td><td colspan="2"><div class="error" style="display:none;">Ingrese nombre de usuario</div></td></tr>
          <tr>
		  <td></td>
            <td colspan="2">
			<a href="javascript:onSubmit();" class="button" tabindex="3">Aceptar</a>	  		</td>
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
/*}else{
    
    header("Location: 404.php");
}*/
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