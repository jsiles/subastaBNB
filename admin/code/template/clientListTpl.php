<?php
$categoria = " and cli_delete=0 ";
if ($lang!='es') $urlLangAux=$lang.'/';
else $urlLangAux='';

$order = admin::toSql(admin::getParam("order"),"Number");
if(!isset($order)) $order=0;

if ($order==0) {$orderCode=' order by cli_uid desc'; $titClass='up'; $nameClass='up'; $dateClass='up';}
elseif ($order==1) {$orderCode='  order by cli_nit_ci asc'; $titClass='up'; $nameClass='up'; $dateClass='up';}
elseif ($order==2) {$orderCode='  order by cli_nit_ci desc'; $titClass='down'; $nameClass='up'; $dateClass='up';}
elseif ($order==3) {$orderCode='  order by cli_socialreason asc'; $titClass='up'; $nameClass='up'; $dateClass='up';}
elseif ($order==4) {$orderCode='  order by cli_socialreason desc'; $titClass='up'; $nameClass='down'; $dateClass='up';}

if ($titClass=='up') $titOrder=2;
else $titOrder=1;
if ($nameClass=='up') $nameOrder=4;
else $nameOrder=3;
if ($dateClass=='up') $dateOrder=6;
else $dateOrder=5;

$search = admin::toSql(admin::getParam("search"),"Text");
if (!$search || $search=='')
{
$_pagi_sql= "select cli_uid, cli_nit_ci, cli_socialreason, cli_user, cli_mainemail, cli_status, cli_phone, cli_status_main from mdl_client where 1=1 ".$categoria.$orderCode;
//$nroReg=admin::getDBvalue("select count(cli_uid) from mdl_client where cli_delete=0");
}
else
{
$_pagi_sql= "select cli_uid, cli_nit_ci, cli_socialreason, cli_user, cli_mainemail, cli_status, cli_phone, cli_status_main from mdl_client where (cli_socialreason like '%".$search."%' or cli_nit_ci like '%".$search."%' or cli_user like '%".$search."%' or cli_mainemail like '%".$search."%') ".$categoria.$orderCode;

//$nroReg=admin::getDBvalue("select count(cli_uid) from mdl_client where (cli_socialreason like '%".$search."%' or cli_nit_ci like '%".$search."%' or cli_user like '%".$search."%' or cli_mainemail like '%".$search."%') ".$categoria);
}
//echo $_pagi_sql;
$_pagi_cuantos = 20;//Elegí un número pequeño para que se generen varias páginas
//cantidad de enlaces que se mostrarán como máximo en la barra de navegación
$_pagi_nav_num_enlaces = 5;//Elegí un número pequeño para que se note el resultado
//Decidimos si queremos que se muesten los errores de mysql
$_pagi_mostrar_errores = false;//recomendado true sólo en tiempo de desarrollo.

$nroReg=$db->numrows($_pagi_sql);
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
        $moduleId=15;
        $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleId and mop_lab_category='Crear' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){?>
            <a href="<?=admin::modulesLink('clientNew')?>"><?=admin::modulesLabels('clientNew')?></a>
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
        <form  method="post"  name="frmbuySearch" action="clientList.php" >
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
          <td>
            <input type="text" name="search" id="search" value="<?=$search?>" class="input7" />
          </td>
          <td>
          <input name="Buscar" id="Buscar" type="image" src="lib/buscar.png" />
           <input type="hidden" name="qfiltro" id="qfiltro" value="1"/>
           <input type="hidden" name="token" value="<?=admin::getParam("token")?>" />
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
            <td width="15%" class="list1a" style="color:#16652f;"><a href="clientList.php?order=<?=$titOrder?><?=$searchURL?>" class="<?=$titClass;?>">NIT o CI:</a></td>
            <td width="15%" class="list1a" style="color:#16652f;"><a href="clientList.php?order=<?=$nameOrder?><?=$searchURL?>" class="<?=$nameClass;?>">Raz&oacute;n social:</a></td>
	    <td width="15%" style="color:#16652f">Correo electr&oacute;nico:</td>
        <td width="15%" style="color:#16652f">Usuario:</td>
        <td width="10%" style="color:#16652f">Estado:</td>
        <td align="center" width="5%" height="5"></td>
   		<td align="center" width="5%" height="5"></td>
		<td align="center" width="5%" height="5"></td>
		<td align="center" width="5%" height="5"></td>
		<td align="center" width="5%" height="5"></td>
		<td align="center" width="5%" height="5"></td>
	</tr>
	</table>
</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
	<?php
$i=1;
while ($user_list = $pagDb->next_record())
	{
	$cli_uid = $user_list["cli_uid"];
	$cli_nit_ci = $user_list["cli_nit_ci"];
	$cli_socialreason = $user_list["cli_socialreason"];
	$cli_phone = $user_list["cli_phone"];
	$cli_mainemail = $user_list["cli_mainemail"];
	$cli_user= $user_list["cli_user"];
	$cli_status = $user_list["cli_status"];
	$cli_status_main = $user_list["cli_status_main"];

	if ($cli_status==0) $labels_content='status_on';
	else $labels_content='status_off';
	
	if ($i%2==0) $class='row';
	else  $class='row0';
	
	switch ($cli_status_main)
                      {  
                            case 0: $cli_status_literal = 'Solicitud';
                                break;
                            case 1: $cli_status_literal = 'Aprobado';
                                break;
                            case 2: $cli_status_literal = 'Rechazado';
                                break;
                        }
  	?> 
  	<div id="sub_<?=$cli_uid?>" class="<?=$class?>">
<table class="list" width="100%" border="0">
	<tr>
    	<td width="15%"><?=$cli_nit_ci;?></td>
    	<td width="15%"><?=$cli_socialreason;?></td>
    	<td width="15%"><?=$cli_mainemail;?></td>
    	<td width="15%"><?=$cli_user;?></td>
        <td width="10%"><?=$cli_status_literal;?></td>        
        <td align="center" width="5%" height="5">
            <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=14 and mop_lab_category='Ver' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if($valuePermit=='ACTIVE'){
            ?>
    	<a href="clientView.php?cli_uid=<?=$cli_uid?>">
            <img src="lib/view_es.gif" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>">
	</a>
            <?php
        }else{
            ?>
            <img src="lib/view_off_es.gif" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>">
        <?php
        
        }
        ?>
    </td>
	<td align="center" width="5%" height="5">
            <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=14 and mop_lab_category='Editar' and moa_rol_uid=".$_SESSION['usr_rol']."");
            if(($valuePermit=='ACTIVE')){
            ?>
    	<a href="clientEdit.php?cli_uid=<?=$cli_uid?>">
		<img src="lib/edit_es.gif" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
	</a>
            <?php
        }else{
            ?>
		<img src="lib/edit_off_es.gif" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">

            <?php
            }
            ?>
    </td>
	<td align="center" width="5%" height="5">
            <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=14 and mop_lab_category='Eliminar' and moa_rol_uid=".$_SESSION['usr_rol']."");
            if(($valuePermit=='ACTIVE')){
            ?>
                <a href="" onclick="removeList(<?=$cli_uid?>); return false;">
		<img src="lib/delete_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
		</a>
            <?php
            }else{
            ?>
            <img src="lib/delete_off_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
	    <?php
            }
            ?>
            
    </td>
	<td align="center" width="5%" height="5">
    <div id="status_<?=$cli_uid?>">
        <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=14 and mop_lab_category='Estado' and moa_rol_uid=".$_SESSION['usr_rol']."");
            if(($valuePermit=='ACTIVE')&&($cli_status_main==0)){
            ?>
	   <a href=""  onclick="clientCS('<?=$cli_uid?>','<?=$cli_status?>'); return false;">
		<img src="<?=admin::labels($labels_content,'linkImage')?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
	   </a>
        <?php
            }else{
                $status = ($cli_status=='ACTIVE') ? 'active_off_es.gif':'inactive_off_es.gif';
        ?>
        <img src="lib/<?=$status?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
        <?php
            }
        ?>
	</div>
    </td>
    <td align="center" width="5%" height="5">
	
                <?php
                $moduleId=14;
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleId and mop_lab_category='Aprobar' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if(($valuePermit=='ACTIVE')&&($cli_status_main==0)){
                ?>
                    <a href="aprobarSubasta" onclick="aprobarSubasta('<?=$cli_uid?>');return false;">
                        <img src="lib/aprobar_on.png" border="0" title="Aprobar" alt="Aprobar">
                    </a>
                <?php
                }else{
                ?>
                    <img src="lib/aprobar_off.png" border="0" title="Aprobar" alt="Aprobar">
	    <?php
                }
            ?>

	</td>
        
        <td align="center" width="5%" height="5">
	
                <?php
                $moduleId=14;
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleId and mop_lab_category='Rechazar' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if(($valuePermit=='ACTIVE')&&($cli_status_main==0)){
                ?>

         	    <a href="rechazarSubasta" onclick="rechazarSubasta('<?=$cli_uid?>');return false;">
                	<img src="lib/rechazar_on.png" border="0" title="Rechazar" alt="Rechazar">
                    </a>
                <?php
                    }else{
                ?>
                	<img src="lib/rechazar_off.png" border="0" title="Rechazar" alt="Rechazar">
		<?php
                    }
                ?>

	</td>
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
        $moduleId=15;
        $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleId and mop_lab_category='Crear' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){?>
            <a href="<?=admin::modulesLink('clientNew')?>"><?=admin::modulesLabels('clientNew')?></a>
        <?php
        }
        ?>
        
        &nbsp;</td>
  </tr>
  <tr>
	<td width="90%" height="40"></td>
    <td>
        <div class="boxSearch">
        <form method="post"  name="frmbuySearch" action="clientList.php" >
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
          <td>
            <input type="text" name="search" id="search" value="<?=$search?>" class="input7" />
          </td>
          <td>
          <input name="Buscar" id="Buscar" type="image" src="lib/buscar.png" />
           <input type="hidden" name="qfiltro" id="qfiltro" value="1"/>
           <input type="hidden" name="token" value="<?=admin::getParam("token")?>" />
          </td>
         </tr>
        </table>
         </form>
       </div>
   </td>
  </tr>  
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