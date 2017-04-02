<?php
$categoria = " and cli_delete=0 ";
if ($lang!='es') $urlLangAux=$lang.'/';
else $urlLangAux='';

$search = admin::toSql(admin::getParam("search"),"String");
if($search=='')
{
$where="";        
}else
{
$where .= " and (CONVERT(VARCHAR(25), noe_fecha, 126) like '%". $search."%' or CONVERT(VARCHAR(25), noe_fecha_envio, 126) like '%".$search."%')";
$where .= " or (noe_email like '%". $search."%')";
$where .= " or (noe_sol_uid like '%". $search."%')";
$where .= " or (noe_nro_oc like '%". $search."%')";
$where .= " or (cli_socialreason like '%". $search."%')";
}
if($tipUid==1) $where.=" and noe_status=1";
else $where.=" and noe_status=0";
$_pagi_sql= "select * from mdl_notificacion_envio,mdl_client where cli_uid=noe_cli_uid  $where order by noe_uid asc ";
//$nroReg=admin::getDBvalue("select count(*) from mdl_notificacion_envio,mdl_client where cli_uid=noe_cli_uid $where");
$nroReg = $db->numrows($_pagi_sql);
$_pagi_cuantos = 20;//Elegí un número pequeño para que se generen varias páginas
//cantidad de enlaces que se mostrarán como máximo en la barra de navegación
$_pagi_nav_num_enlaces = 5;//Elegí un número pequeño para que se note el resultado
//Decidimos si queremos que se muesten los errores de mysql
$_pagi_mostrar_errores = false;//recomendado true sólo en tiempo de desarrollo.

//$db->query($_pagi_sql);
//echo $_pagi_sql;
include("core/paginator.inc.php");

if ($nroReg>0)
	{

	?>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
      <td width="23%" height="40" align="right">
        <?php
        $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleCrearId and mop_lab_category='Crear' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){?>
            <a href="<?=admin::modulesLink($etiquetaCrear)?>&token=<?=admin::getParam("token")?>"><?=admin::modulesLabels($etiquetaCrear)?></a>
        <?php
        }
        ?>
            &nbsp;  
      </td>
  </tr>
  <tr style="display:">
	<td width="90%" height="40"></td>
    <td>
        <div class="boxSearch">
        <form name="frmbuySearch" action="notificacionEnvList.php" >
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
          <td>
            <input type="text" name="search" id="search" value="<?=$search?>" class="input7" />
          </td>
          <td>
          <input name="Buscar" id="Buscar" type="image" src="lib/buscar.png" />
           <input type="hidden" name="qfiltro" id="qfiltro" value="1"/>
           <input type="hidden" name="token" value="<?=admin::getParam("token")?>" />
           <input type="hidden" name="tipUid" value="<?=admin::getParam("tipUid")?>" />
          </td>
         </tr>
        </table>
         </form>
       </div>
   </td>
  </tr>
  <tr>
    <td colspan="2" width="98%">
  <table width="98%" border="0"  style="padding-left:17px;">
	<tr>
            <td width="9%" class="list1a" style="color:#16652f;">Fecha:</td>
            <td width="9%" class="list1a" style="color:#16652f;">Fecha Envio:</td>
            <td width="9%" class="list1a" style="color:#16652f;">Proveedor:</td>
            <td width="9%" class="list1a" style="color:#16652f;">Email:</td>
            <td width="9%" class="list1a" style="color:#16652f;">Tipo:</td>
            <td width="9%" style="color:#16652f">Nro Solicitud:</td>
            <td width="9%" style="color:#16652f">Nro OC:</td>
            <td width="9%" style="color:#16652f">Adjunto:</td>
            <td width="9%" style="color:#16652f">Estado:</td>
            <td width="9%" style="color:#16652f">Nro Intentos:</td>
            <td width="9%" style="color:#16652f">Respuesta Server:</td>
	</tr>
	</table>
</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
	<?php
$i=1;
while ($noe = $pagDb->next_record())
	{
	$noe_uid = $noe["noe_uid"];
	$noe_fecha = $noe["noe_fecha"];
	$noe_fecha_envio = $noe["noe_fecha_envio"];
	$noe_cli_uid = $noe["noe_cli_uid"];
	$noe_client = admin::getDbValue("select cli_socialreason from mdl_client where cli_uid=$noe_cli_uid");
        $noe_email = $noe["noe_email"];
	$noe_nti_uid = $noe["noe_nti_uid"];
        $noe_tipologia = admin::getDbValue("select nti_description from mdl_notificacion_tipologia where nti_uid=$noe_nti_uid");
        $noe_sol_uid = $noe["noe_sol_uid"];
        $noe_orc_uid = $noe["noe_orc_uid"];
        $noe_nro_oc = $noe["noe_nro_oc"];
        $noe_attach_exist = $noe["noe_attach_exist"];
        $noe_attach = $noe["noe_attach"];
        $noe_estado = $noe["noe_status"];
        $noe_retry = $noe["noe_retry"];
        $noe_response = $noe["noe_response"];
        
        switch ($noe_estado){
        case 0: $estado="Pendiente";
                break;
        case 1: $estado="Enviado";
                break;
        case 2: $estado="Con Error";
                break;
        default : $estado="Pendiente";
                break;
        }
        
        
        if ($i%2==0) $class='row0';
	else  $class='row';
	if ($i%2==0) $class2='row';
	else  $class2='row1';
        
        $i++;
  	?> 
  	<div id="sub_<?=$not_uid?>" class="<?=$class?>">
<table class="list" width="100%" border="0">
	<tr>
    	<td width="9%"><?=substr($noe_fecha,0,16)?></td>
    	<td width="9%"><?=substr($noe_fecha_envio,0,16)?></td>
    	<td width="9%"><?=$noe_client?></td>
    	<td width="9%"><?=$noe_email?></td>
    	<td width="9%"><?=$noe_tipologia?></td>
    	<td width="9%"><?=$noe_sol_uid?></td>
    	<td width="9%"><?=$noe_nro_oc?></td>
    	<td width="9%"><?php
           $docPath = PATH_ROOT.$noe_attach;
	   $imgDomain = PATH_DOMAIN."/admin/lib/ext/doc-txt.png";
	   $docDomain = PATH_DOMAIN.$noe_attach;
           
	   if (file_exists($docPath) && $noe_attach_exist==1&&$noe_attach!='')
                {
               ?>
            <a href="<?=$docDomain?>" target="blank"><img src="<?=$imgDomain?>" border="0"></a>
                   <?php
           }else{
               echo  "Sin adjunto";
           }
               
                
                ?></td>
    	<td width="9%"><?=$estado?></td>
    	<td width="9%"><?=$noe_retry?></td>
    	<td width="9%"><?=$noe_response?></td>
        </tr>
	</table>
	</div>
	<?php
	$i++;
	}  
        ?>
    </td>
    </tr>
    <tr><td width="100%">
	<table border="0" width="100%">
			  <td colspan="3" align="right" class="txt10"><span class="txt11">
			    <?php		   
				//Incluimos la barra de navegación
				if ($_pagi_totalReg==0) 
					{
					echo "<font face=arial></font>";
					}
					else
					{
					echo $_pagi_navegacion;
					//Incluimos la información de la página actual
					echo $_pagi_info;
					}		
				?>
			  </span></td>
			</tr>
			</table>
	</td></tr>
</table><br />
<br />
<br />
<?php
} 
else
	{ 
    ?>
	<br />
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
<tr>
        <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
    <td width="23%" height="40" align="right">
       <?php
        $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleCrearId and mop_lab_category='Crear' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){?>
            <a href="<?=admin::modulesLink($etiquetaCrear)?>&token=<?=admin::getParam("token")?>"><?=admin::modulesLabels($etiquetaCrear)?></a>
        <?php
        }
        ?>
            &nbsp;  
        
        &nbsp;</td>
  </tr>
 <!-- <tr>
	<td width="90%" height="40"></td>
    <td>
        <div class="boxSearch">
        <form name="frmbuySearch" action="solicitudList.php" >
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
          <td>
            <input type="text" name="search" id="search" value="<?=$search?>" class="input7" />
          </td>
          <td>
          <input name="Buscar" id="Buscar" type="image" src="lib/buscar.png" />
           <input type="hidden" name="qfiltro" id="qfiltro" value="1"/>
           <input type="hidden" name="token" value="<?=admin::getParam("token")?>" />
           <input type="hidden" name="tipUid" value="<?=admin::getParam("tipUid")?>" />
          </td>
         </tr>
        </table>
         </form>
       </div>
   </td>
  </tr> --> 
  <tr>
    <td colspan="2" id="contentListing">
<div  style="background-color: #f7f8f8;">
<table class="list"  width="100%">
	<tr><td height="30px" align="center" class="bold">
	No existen registros.
	</td></tr>	
 </table>
</div>
</td></tr></table>
<?php
}
?>