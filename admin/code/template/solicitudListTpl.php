<?php
$categoria = " and cli_delete=0 ";
if ($lang!='es') $urlLangAux=$lang.'/';
else $urlLangAux='';

$search = admin::toSql(admin::getParam("search"),"String");

if ($search || $search!='')
{
    $where = " and (sol_observaciones like '%$search%' ";
    $where .= " or sol_uid like '%$search%' ";
    $where .= " or CONVERT(VARCHAR(25), sol_date, 126) like '%$search%' )";
            
}
if($tipUid==2) { 
    /*
     * RAV tipologia 
     * 1 Proceso Compra
     * 2 Informe
     * 3 Solicitud Compra
     * 4 Aprobacion Compra
     * 
     */
    $where.=" and sol_estado=0 ";
}

    $rol=admin::getSession("usr_rol");
    $unidadHabilitada =admin::dbFillArray("select raa_uni_uid,rav_uid from mdl_rav,mdl_rav_access where rav_uid=raa_rav_uid and rav_tipologia=3 and rav_delete=0 and rav_rol_uid=$rol");
    //echo "select rav_uid,raa_uni_uid from mdl_rav,mdl_rav_access where rav_uid=raa_rav_uid and rav_tipologia=3 and rav_delete=0 and rav_rol_uid=$rol";
    //print_r($unidadHabilitada);
    if(is_array($unidadHabilitada)){
        $k=0;
        $unidadHabUid="";
        foreach ($unidadHabilitada as $key=>$value) {
            if($k==0) {
                $unidadHabUid.=$key;
            }
        else {
            $unidadHabUid.= ",".$key;
            }
            $k++;
        }
        if($tipUid==2) $where .=" and sou_uni_uid in ($unidadHabUid) ";
    }else{
        if($tipUid==2) $where .=" and sou_uni_uid=-1 ";
    }

$order= admin::toSql(admin::getParam("order"),"Number");
if(!isset($order)) $order=0;
/*if ($order) admin::setSession("order",$order);
else $order=admin::getSession("order");*/

if ($order==0) {$orderCode=' order by sol_uid desc'; $uidClass='down'; $fecClass='down'; $uniClass='up';$estClass='up';}
elseif ($order==1) {$orderCode=' order by sol_uid asc'; $uidClass='up'; $fecClass='up'; $uniClass='up';$estClass='up';}
elseif ($order==2) {$orderCode='  order by sol_date desc'; $uidClass='down'; $fecClass='down'; $uniClass='up';$estClass='up';}
elseif ($order==3) {$orderCode='  order by sol_date asc'; $uidClass='up'; $fecClass='up'; $uniClass='up';$estClass='down';}
elseif ($order==4) {$orderCode='  order by sou_uni_uid asc'; $uidClass='down'; $fecClass='down'; $uniClass='up';$estClass='up';}
elseif ($order==5) {$orderCode='  order by sou_uni_uid desc'; $uidClass='up'; $fecClass='up'; $uniClass='down';$estClass='down';}
elseif ($order==6) {$orderCode='  order by sol_estado asc'; $uidClass='down'; $fecClass='down'; $uniClass='up';$estClass='up';}
elseif ($order==7) {$orderCode='  order by sol_estado desc'; $uidClass='up'; $fecClass='up'; $uniClass='up';$estClass='down';}

if ($uidClass=='up') $uidOrder=0;
else $uidOrder=1;
if ($fecClass=='up') $fecOrder=2;
else $fecOrder=3;
if ($uniClass=='up') $uniOrder=5;
else $uniOrder=4;
if ($estClass=='up') $estOrder=7;
else $estOrder=6;

    
    
    
$_pagi_sql= "select * from mdl_solicitud_compra, mdl_solicitud_unidad where sol_uid=sou_sol_uid and sol_delete=0 ". $where;

$_pagi_sql.=$orderCode;

//echo $_pagi_sql;
$nroReg=$db->numrows($_pagi_sql);

//echo $_pagi_sql;
$_pagi_cuantos = 20;//Elegí un número pequeño para que se generen varias páginas
//cantidad de enlaces que se mostrarán como máximo en la barra de navegación
$_pagi_nav_num_enlaces = 5;//Elegí un número pequeño para que se note el resultado
//Decidimos si queremos que se muesten los errores de mysql
$_pagi_mostrar_errores = false;//recomendado true sólo en tiempo de desarrollo.

//$db->query($_pagi_sql);
//if($_SESSION["usr_uid"]==14) admin::doLog ("1123");
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
  </tr>
  <tr>
    <td colspan="2" width="98%">
  <table width="98%" border="0"  style="padding-left:17px;">
	<tr>
            <td width="5%" class="list1a" style="color:#16652f;"><a href="solicitudList.php?order=<?=$fecOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>" class="<?=$fecClass;?>">Fecha:</a></td>
            <td width="5%" class="list1a" style="color:#16652f;"><a href="solicitudList.php?order=<?=$uidOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>" class="<?=$uidClass;?>">Nro Solicitud:</a></td>
            <td width="12%" style="color:#16652f"><a href="solicitudList.php?order=<?=$uniOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>" class="<?=$uniClass;?>">Unidad Solicitante:</a></td>
            <td width="12%" style="color:#16652f">Monto:</td>
            <td width="12%" style="color:#16652f">Observaciones:</td>
            <td width="12%" style="color:#16652f">Usuario:</td>
            <td width="12%" style="color:#16652f"><a href="solicitudList.php?order=<?=$estOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>" class="<?=$estClass;?>">Estado:</a></td>
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
while ($sol_list = $pagDb->next_record())
	{
	$solUid = $sol_list["sol_uid"];
	$solDate = substr($sol_list["sol_date"],0,10);
	$solObservaciones = $sol_list["sol_observaciones"];
	$solUsuUid = admin::getDbValue("select concat(usr_firstname,' ',usr_lastname) from sys_users where usr_uid=".$sol_list["sol_usu_uid"]);
        $solEstadoUid = $sol_list["sol_estado"];
        $solEstado = $sol_list["sol_estado"];
        $solStatus = $sol_list["sol_status"];
        $solMonto = $sol_list["sol_monto"];
        $solMoneda = admin::getDbValue("select cur_description from mdl_currency where cur_uid=".$sol_list["sol_moneda"]);
        $unidadArray =  admin::dbFillArray("select uni_uid, uni_description from mdl_unidad, mdl_solicitud_unidad where sou_uni_uid=uni_uid and sou_sol_uid=$solUid group by uni_uid, uni_description");
        $k=0; 
        $solUnidad="";
        $solUnidadUid="";
        if(is_array($unidadArray))
        foreach($unidadArray as $key => $value)
        {
            if($k==0) {$solUnidad.= $value;$solUnidadUid.= $key;}
        else {$solUnidad.= ",".$value;$solUnidadUid.= ",".$key;}
            $k++;
        }
        else $solUnidad="Sin asignar";
        
        if ($i%2==0) $class='row0';
	else  $class='row';
	if ($i%2==0) $class2='row';
	else  $class2='row1';
        
        switch ($solEstado) {
            case 0:
                $solEstado="Solicitud";
                break;
            case 1:
                $solEstado="Aprobado";
                break;
            case 2:
                $solEstado="Rechazado";
                break;
            default:
                $solEstado="Solicitud";
                break;
        }
        if($solStatus=='ACTIVE')  $labels_content='status_on';
        else   $labels_content='status_off';
        $i++;
  	?> 
  	<div id="sol_<?=$solUid?>" class="<?=$class?>">
<table class="list" width="100%" border="0">
	<tr>
    	<td width="5%"><?=$solDate?></td>
    	<td width="5%" align="center"><?=$solUid?></td>
    	<td width="12%"><?=$solUnidad?></td>
    	<td width="12%"><?=admin::numberFormat($solMonto)." ".$solMoneda?></td>
    	<td width="12%"><?=$solObservaciones?></td>
        <td width="12%"><?=$solUsuUid?></td>        
        <td width="12%"><?=$solEstado?></td>        
        <td align="center" width="5%" height="5">
            <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Ver' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if($valuePermit=='ACTIVE'){
            ?>
    	<a href="solicitudView.php?sol_uid=<?=$solUid?>&token=<?=admin::getParam("token");?>&tipUid=<?=admin::getParam("tipUid")?>">
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
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Editar' and moa_rol_uid=".$_SESSION['usr_rol']."");
            if(($valuePermit=='ACTIVE')&&($solEstadoUid==0)){
            ?>
            <a href="solicitudEdit.php?sol_uid=<?=$solUid?>&token=<?=admin::getParam("token");?>&tipUid=<?=admin::getParam("tipUid")?>">
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
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Eliminar' and moa_rol_uid=".$_SESSION['usr_rol']."");
            if(($valuePermit=='ACTIVE')&&($solEstadoUid==0)){
            ?>
                <a href="" onclick="removeList(<?=$solUid?>); return false;">
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
    <div id="status_<?=$solUid?>">
        <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Estado' and moa_rol_uid=".$_SESSION['usr_rol']."");
            if(($valuePermit=='ACTIVE')&&($solEstadoUid==0)){
            ?>
	   <a href="#"  onclick="solicitudCS('<?=$solUid?>','<?=$solStatus?>'); return false;">
		<img src="<?=admin::labels($labels_content,'linkImage')?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
	   </a>
        <?php
            }else{
                $status = ($solStatus=='ACTIVE') ? 'active_off_es.gif':'inactive_off_es.gif';
        ?>
        <img src="lib/<?=$status?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
        <?php
            }
        ?>
	</div>
    </td>
    <td align="center" width="5%" height="5">
	
                <?php
                $rolAplica=admin::validaRav($solUid, admin::getSession("usr_rol"), 3, $sol_list["sol_moneda"], $solMonto, $solUnidadUid);
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Aprobar' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if(($valuePermit=='ACTIVE')&&($rolAplica==1)){
                ?>
                    <a href="aprobar" onclick="aprobarSolicitud('<?=$solUid?>');return false;">
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
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Rechazar' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if(($valuePermit=='ACTIVE')&&($rolAplica==1)){
                ?>

         	    <a href="rechazar" onclick="rechazarSolicitud('<?=$solUid?>');return false;">
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