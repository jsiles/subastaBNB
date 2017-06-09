<?php
$categoria = " and cli_delete=0 ";
if ($lang!='es') $urlLangAux=$lang.'/';
else $urlLangAux='';

$search = admin::toSql(admin::getParam("search"),"String");
if ($tipUid==2) $aprSel=" and orc_estado=0 ";
if ($search!='')
{
    $Where= " and ((cli_socialreason like '%$search%')or(orc_date like '%$search%'))";
}

$rol=admin::getSession("usr_rol");
    $unidadHabilitada =admin::dbFillArray("select raa_uni_uid,rav_uid from mdl_rav,mdl_rav_access where rav_uid=raa_rav_uid and rav_tipologia=4 and rav_delete=0 and rav_rol_uid=$rol");
    //print_r($unidadHabilitada);
    if(is_array($unidadHabilitada)){
        $k=0;
        $unidadHabUid="";
        foreach ($unidadHabilitada as $key => $value) {
            if($k==0) {
                $unidadHabUid.= $key;
            }
        else {
            $unidadHabUid.= ",".$key;
            }
            $k++;
        }
        if($tipUid==2) $Where .=" and oru_uni_uid in ($unidadHabUid) ";
    }else{
        
         if($tipUid==2) $Where .=" and oru_uni_uid=-1";
    }


$_pagi_sql= "select * from mdl_orden_compra,mdl_client, mdl_orden_unidad where orc_uid=oru_orc_uid and orc_cli_uid=cli_uid and  orc_delete=0 $Where $aprSel ";


$order= admin::toSql(admin::getParam("order"),"Number");
if(!isset($order)) $order=0;
/*if ($order) admin::setSession("order",$order);
else $order=admin::getSession("order");
*/
if ($order==0) {$orderCode=' order by orc_fecha desc'; $uidClass='down'; $fecClass='down'; $uniClass='up';$estClass='up'; $orcClass='up';}
elseif ($order==1) {$orderCode=' order by orc_fecha asc'; $uidClass='up'; $fecClass='up'; $uniClass='up';$estClass='up';$orcClass='down';}
elseif ($order==2) {$orderCode='  order by orc_sol_uid desc'; $uidClass='down'; $fecClass='down'; $uniClass='up';$estClass='up';$orcClass='up';}
elseif ($order==3) {$orderCode='  order by orc_sol_uid asc'; $uidClass='up'; $fecClass='up'; $uniClass='up';$estClass='down';$orcClass='down';}
elseif ($order==4) {$orderCode='  order by orc_nro_oc desc'; $uidClass='down'; $fecClass='down'; $uniClass='up';$estClass='up';$orcClass='up';}
elseif ($order==5) {$orderCode='  order by orc_nro_oc asc'; $uidClass='up'; $fecClass='up'; $uniClass='up';$estClass='down';$orcClass='down';}
elseif ($order==6) {$orderCode='  order by orc_cli_uid asc'; $uidClass='down'; $fecClass='down'; $uniClass='up';$estClass='up';$orcClass='up';}
elseif ($order==7) {$orderCode='  order by orc_cli_uid desc'; $uidClass='up'; $fecClass='up'; $uniClass='down';$estClass='down';$orcClass='down';}
elseif ($order==8) {$orderCode='  order by orc_estado asc'; $uidClass='down'; $fecClass='down'; $uniClass='up';$estClass='up';$orcClass='up';}
elseif ($order==9) {$orderCode='  order by orc_estado desc'; $uidClass='up'; $fecClass='up'; $uniClass='up';$estClass='down';$orcClass='down';}

if ($uidClass=='up') $uidOrder=2;
else $uidOrder=3;
if ($fecClass=='up') $fecOrder=0;
else $fecOrder=1;
if ($uniClass=='up') $uniOrder=6;
else $uniOrder=7;
if ($estClass=='up') $estOrder=9;
else $estOrder=8;
if ($orcClass=='up') $orcOrder=5;
else $orcOrder=4;
$_pagi_sql.=$orderCode;


//echo $_pagi_sql;

$_pagi_cuantos = 20;//Elegí un número pequeño para que se generen varias páginas
//cantidad de enlaces que se mostrarán como máximo en la barra de navegación
$_pagi_nav_num_enlaces = 5;//Elegí un número pequeño para que se note el resultado
//Decidimos si queremos que se muesten los errores de mysql
$_pagi_mostrar_errores = false;//recomendado true sólo en tiempo de desarrollo.

$nroReg= $db->numrows($_pagi_sql);

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
        <form name="frmbuySearch" action="ordenCompraList.php" >
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
            <td width="10%" class="list1a" style="color:#16652f;"><a href="ordenCompraList.php?order=<?=$fecOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>" class="<?=$fecClass;?>">Fecha:</a></td>
            <td width="10%" class="list1a" style="color:#16652f;"><a href="ordenCompraList.php?order=<?=$uidOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>" class="<?=$uidClass;?>">Nro Solicitud:</a></td>
            <td width="10%" style="color:#16652f"><a href="ordenCompraList.php?order=<?=$orcOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>" class="<?=$orcClass;?>">Nro Orden de Compra:</a></td>
            <td width="10%" style="color:#16652f"><a href="ordenCompraList.php?order=<?=$uniOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>" class="<?=$uniClass;?>">Proveedor:</a></td>
            <td width="10%" style="color:#16652f">Unidad Solicitante:</td>
            <td width="10%" style="color:#16652f"><a href="ordenCompraList.php?order=<?=$estOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>" class="<?=$estClass;?>">Estado:</a></td>
            <td width="5%" align="center" style="color:#16652f">Monto:</td>
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
while ($orden_list = $pagDb->next_record())
	{
	$orc_uid = $orden_list["orc_uid"];
	$orc_fecha = $orden_list["orc_fecha"];
	$orc_sol_uid = $orden_list["orc_sol_uid"];
        $orc_nro_oc = $orden_list["orc_nro_oc"];
	$orc_proveedor = $orden_list["cli_socialreason"];
        $orc_estado_uid = $orden_list["orc_estado"];
        $orc_estado = $orden_list["orc_estado"];
        $orc_status = $orden_list["orc_status"];
        $orc_moneda = $orden_list["orc_moneda"];
        $orc_monto = $orden_list["orc_monto"];
        $unidadArray =  admin::dbFillArray("select uni_uid, uni_description from mdl_unidad, mdl_orden_unidad where oru_uni_uid=uni_uid and oru_orc_uid=$orc_uid group by uni_uid, uni_description");
        $monedaLit =admin::getDbValue("select cur_description from mdl_currency where cur_uid=$orc_moneda");

        $k=0; 
        $solUnidad="";
        $orc_uni_uidList="";
        if(is_array($unidadArray))
        foreach($unidadArray as $key => $value)
        {
            if($k==0) {$solUnidad.= $value;$orc_uni_uidList.=$key;}
        else {$solUnidad.= ",".$value;$orc_uni_uidList.=",".$key;}
            $k++;
        }
        if ($i%2==0) $class='row0';
	else  $class='row';
	if ($i%2==0) $class2='row';
	else  $class2='row1';
        
        switch ($orc_estado) {
            case 0:
                $orc_estado="Solicitud";
                break;
            case 1:
                $orc_estado="Aprobado";
                break;
            case 2:
                $orc_estado="Rechazado";
                break;
            default:
                $orc_estado="Solicitud";
                break;
        }
        if($orc_status=='ACTIVE')  $labels_content='status_on';
        else   $labels_content='status_off';
        $i++;
  	?> 
  	<div id="sub_<?=$orc_uid?>" class="<?=$class?>">
<table class="list" width="100%" border="0">
	<tr>
    	<td width="10%"><?=$orc_fecha?></td>
    	<td width="10%"><?=$orc_sol_uid?></td>
    	<td width="10%"><?=$orc_nro_oc?></td>
    	<td width="10%"><?=$orc_proveedor?></td>
    	<td width="10%"><?=$solUnidad?></td>
        <td width="10%"><?=$orc_estado?></td>        
        <td width="5%" align="right"><?=$orc_monto." ".$monedaLit?></td>        
        <td align="center" width="5%" height="5">
            <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Ver' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if($valuePermit=='ACTIVE'){
            ?>
    	<a href="ordenCompraView.php?orc_uid=<?=$orc_uid?>&token=<?=admin::getParam("token");?>&tipUid=<?=admin::getParam("tipUid")?>">
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
            if($valuePermit=='ACTIVE'&&$orc_estado_uid==0){
            ?>
            <a href="ordenCompraEdit.php?orc_uid=<?=$orc_uid?>&token=<?=admin::getParam("token");?>&tipUid=<?=admin::getParam("tipUid")?>">
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
            if($valuePermit=='ACTIVE'&&$orc_estado_uid==0){
            ?>
                <a href="" onclick="removeList(<?=$orc_uid?>); return false;">
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
    <div id="status_<?=$orc_uid?>">
        <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Estado' and moa_rol_uid=".$_SESSION['usr_rol']."");
            if($valuePermit=='ACTIVE'&&$orc_estado_uid==0){
                
               // echo $orc_status."##".$labels_content;
            ?>
	   <a href="#"  onclick="ordenCS('<?=$orc_uid?>','<?=$orc_status?>'); return false;">
		<img src="<?=admin::labels($labels_content,'linkImage')?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
	   </a>
        <?php
            }else{
                $status = ($orc_status=='ACTIVE') ? 'active_off_es.gif':'inactive_off_es.gif';
        ?>
        <img src="lib/<?=$status?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
        <?php
            }
        ?>
	</div>
    </td>
    <td align="center" width="5%" height="5">
	
                <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Aprobar' and moa_rol_uid=".$_SESSION['usr_rol']."");
                $rolAplica=admin::validaRav($orc_uid,admin::getSession("usr_rol"),4,$orc_moneda, $orc_monto, $orc_uni_uidList);
                if(($valuePermit=='ACTIVE')&&($rolAplica==1)){
                ?>
                    <a href="aprobar" onclick="aprobarOC('<?=$orc_uid?>');return false;">
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

         	    <a href="rechazar" onclick="rechazarOC('<?=$orc_uid?>');return false;">
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
  <!--<tr>
	<td width="90%" height="40"></td>
    <td>
        <div class="boxSearch">
        <form name="frmbuySearch" action="ordenCompraList.php" >
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
  </tr>  -->
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