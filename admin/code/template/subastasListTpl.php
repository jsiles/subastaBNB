<?php
define (SYS_LANG,$lang);
$maxLine=20;
$order=0; 
$search2 = admin::toSql(admin::getParam("search2"),"String");
$timeNow= date("Y-m-d H:i:s");//sub_finish<>0
//echo $timeNow;
if ($search2!='')
{
	$Where=" and (sub_description like '%".$search2."%' or pro_name like '%".$search2."%')";
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
    $Where.=" and sub_finish=0 ";
}

    $rol=admin::getSession("usr_rol");
    $unidadHabilitada =admin::dbFillArray("select raa_uni_uid,rav_uid from mdl_rav,mdl_rav_access where rav_uid=raa_rav_uid and rav_tipologia=1 and rav_delete=0 and rav_rol_uid=$rol");
   // print_r($unidadHabilitada);
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
        if($tipUid==2) $Where .=" and suu_uni_uid in ($unidadHabUid) ";
    }else{
         if($tipUid==2) $Where .=" and suu_uni_uid=-1 ";
    }
    
$qsearch="select sub_mount_base, sub_modalidad, sub_moneda, pro_uid, pro_name, pca_name, sub_status, sub_uid, "
        . "sub_type, iif('$timeNow'>sub_deadtime,'concluida',iif('$timeNow'>sub_hour_end, 'subastandose', 'aprobada')) as deadtime, "
        . "sub_finish as estado "
        . "from mdl_product, mdl_subasta, mdl_pro_category, mdl_subasta_unidad "
        . "WHERE sub_uid=pro_sub_uid and pca_uid=sub_pca_uid and sub_delete=0 and sub_mode='SUBASTA' and sub_uid=suu_sub_uid "
        . " $Where ";

$GroupBy =" GROUP BY sub_mount_base, sub_modalidad, sub_moneda, pro_uid, pro_name, pca_name, sub_status, sub_uid, "
        . "sub_type, iif('$timeNow'>sub_deadtime,'concluida',iif('$timeNow'>sub_hour_end, 'subastandose', 'aprobada')), "
        . "sub_finish ";

//echo $qsearch;

$order= admin::toSql(admin::getParam("order"),"Number");
if(!isset($order)) $order=0;
/*if ($order) admin::setSession("order",$order);
else $order=admin::getSession("order");*/

if ($order==0) {$orderCode=' order by pro_uid desc'; $uidClass='down'; $nameClass='up'; $linClass='up';}
elseif ($order==1) {$orderCode='  order by pro_uid asc'; $uidClass='up'; $nameClass='up'; $linClass='up';}
elseif ($order==2) {$orderCode='  order by pro_uid desc'; $uidClass='down'; $nameClass='up'; $linClass='up';}
elseif ($order==3) {$orderCode='  order by pro_name asc'; $uidClass='up'; $nameClass='up'; $linClass='up';}
elseif ($order==4) {$orderCode='  order by pro_name desc'; $uidClass='up'; $nameClass='down'; $linClass='up';}
elseif ($order==5) {$orderCode='  order by pca_name asc'; $uidClass='up'; $nameClass='up'; $linClass='up';}
elseif ($order==6) {$orderCode='  order by pca_name desc'; $uidClass='up'; $nameClass='up'; $linClass='down';}

if ($uidClass=='up') $uidOrder=2;
else $uidOrder=1;
if ($nameClass=='up') $nameOrder=4;
else $nameOrder=3;
if ($linClass=='up') $linOrder=6;
else $linOrder=5;

?>
<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<?php
/********EndResetColorDelete*************/
$_pagi_sql=$qsearch.$GroupBy.$orderCode;
//echo $_pagi_sql;

$_pagi_cuantos = $maxLine;//Elegí un número pequeño para que se generen varias páginas
//cantidad de enlaces que se mostrarán como máximo en la barra de navegación
$_pagi_nav_num_enlaces = 5;//Elegí un número pequeño para que se note el resultado
//Decidimos si queremos que se muesten los errores de mysql
$_pagi_mostrar_errores = false;//recomendado true sólo en tiempo de desarrollo.
$nroReg = $db->numrows($_pagi_sql);
//echo $nroReg;
$db->query($_pagi_sql);

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
          <a href="<?=admin::modulesLink($etiquetaCrear)?>?token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>"><?=admin::modulesLabels($etiquetaCrear)?></a>
        <?php
        }
        ?>
          &nbsp;</td>
  </tr>
  <tr>
	<td width="90%" height="40"></td>
    <td>
        <div class="boxSearch">
        <form name="frmSubastasSearch" action="subastasList.php" >
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
          <td>
            <input type="text" name="search2" id="search2" value="<?=$search2?>" class="input7" />
          </td>
          <td>
          <input name="Buscar" id="Buscar" type="image" src="lib/buscar.png" />
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
      <td colspan="2" width="100%">
  <table width="100%" border="0">
	<tr>
            <td width="10%"><a href="subastasList.php?order=<?=$uidOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>" class="<?=$uidClass;?>"><?=admin::labels('code');?>:</a></td>
        <td width="10%"><a href="subastasList.php?order=<?=$nameOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>" class="<?=$nameClass;?>"><?=admin::labels('name');?>:</a></td>
        <td width="10%"><a href="subastasList.php?order=<?=$linOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>" class="<?=$linClass;?>"><?=admin::labels('category');?>:</a></td>
        <td width="10%"><span class="txt11 color2">Estado:</span></td>
        <td width="10%"><span class="txt11 color2">Unidad Solicitante</span></td>
        <td width="5%">&nbsp;</td>		
	<td width="5%">&nbsp;</td>
	<td width="5%">&nbsp;</td>
	<td width="5%">&nbsp;</td>
	<td width="5%">&nbsp;</td>
	<td width="5%">&nbsp;</td>
	</tr>
	</table>
  </td>
  </tr>
  <tr>
    <td id="contentListing" colspan="2">
 	<?php
$i=1;
?>
<div class="itemList" id="itemList" style="width:99%"> 
<?php
$j=0;
while ($subasta_list = $pagDb->next_record())
	{
	$pro_uid = trim($subasta_list["pro_uid"]);		
	$pro_name = trim($subasta_list["pro_name"]);
	$pca_name = trim($subasta_list["pca_name"]);
	$sub_uid = $subasta_list["sub_uid"];
	$sub_type = $subasta_list["sub_type"];
	$pro_status = $subasta_list["sub_status"];
        $deadtime = $subasta_list["deadtime"];
	$sub_finish = $subasta_list["estado"];
        $sub_monto = $subasta_list["sub_mount_base"];
        $sub_modalidad = $subasta_list["sub_modalidad"];
        $sub_status = $subasta_list["sub_status"];
        $sub_moneda = $subasta_list["sub_moneda"];
        if(($sub_modalidad=="ITEM")||($sub_modalidad=="PRECIO"))
        {
            //echo "SELECT SUM(xit_price) FROM mdl_xitem WHERE xit_sub_uid=$sub_uid and xit_delete=0 ";
         $sub_monto = admin::getDbValue("SELECT SUM(xit_price) FROM mdl_xitem WHERE xit_sub_uid=$sub_uid and xit_delete=0 "); 
         $countBids=admin::getDBvalue("SELECT count(*) FROM mdl_biditem where bid_sub_uid='".$sub_uid."' and bid_cli_uid!=0");
        }
        else{
            
            $countBids=admin::getDBvalue("SELECT count(*) FROM mdl_bid where bid_sub_uid='".$sub_uid."' and bid_cli_uid!=0");
        
        }
       
        
        if(($deadtime=='subastandose')&&($sub_finish==1)) $sub_finish=2;
        if(($countBids==0)&&($sub_finish==3)) $sub_finish=7;
     /*
    
    ESTADOS DE UNA SUBASTA
    sub_finish
    0 SOLICITUD
    1 APROBADA
    2 SUBASTANDOSE
    3 INFORME
    4 ADJUDICADA
    5 RECHAZADA
    6 ANULADA
    7 DESIERTA

     */

    switch ($sub_finish) {
    	case  0:
    		$sub_estado  ='SOLICITUD';
    		break;
    	case  1:
    		$sub_estado  ='APROBADA';
    		break;
    	case  2:
    		$sub_estado  ='SUBASTANDOSE';
    		break;
    	case  3:
    		$sub_estado  ='PENDIENTE INFORME';
    		break;
    	case  4:
    		$sub_estado  ='INFORME';
    		break;
    	case  5:
    		$sub_estado  ='ADJUDICADA';
    		break;
    	case  6:
    		$sub_estado  ='RECHAZADA';
    		break;
        case  7:
    		$sub_estado  ='DESIERTA';
    		break;   
    	default:
    		$sub_estado  ='SOLICITUD';
    		break;
    }


	if ($pro_status=='ACTIVE') $labels_content='status_on';
	else $labels_content='status_off';

	if ($i%2==0) $class='row';
	else  $class='row0';	

	if ($subasta_list["pro_stress"]==1) $dest = 'style=" font-weight:bold;"';
	else $dest = '';
        
        $unidadArray =  admin::dbFillArray("select uni_uid, uni_description from mdl_unidad, mdl_subasta_unidad where suu_uni_uid=uni_uid and suu_sub_uid=$sub_uid group by uni_uid, uni_description");
        $k=0; 
        $rav_unidad="";
        $unidadUid="";
        if(is_array($unidadArray))
        foreach($unidadArray as $key => $value)
        {
            if($k==0){$rav_unidad.= $value;$unidadUid.=$key;}
            else {$rav_unidad.= ",".$value;$unidadUid.=",".$key;}
            $k++;
        }
        else $rav_unidad="Sin asignar";
  	?> 
	<div class="groupItem" id="<?=$pro_uid?>">
    
    <div id="list_<?=$pro_uid?>" class="<?=$class?>" style="width:100%" >
    
    <table class="list" width="100%" style="">
	<tr>
		<td width="10%" ><span <?=$dest?>><?=admin::toHtml($sub_uid)?></span></td>
        <td width="10%" ><span <?=$dest?>><?=ucfirst(strtolower(trim(admin::toHtml($pro_name))))?></span></td>
        <td width="10%" ><span <?=$dest?>><?=ucwords(strtolower(trim(admin::toHtml($pca_name))))?></span></td>
        <td width="10%" ><span><?=$sub_estado?></span></td>
	<td align="left" width="10%" height="5"><span><?=$rav_unidad?></span>
         <?php
		 
		/* if ($countBids>0){
		 ?>
        <a href="excel" onclick="document.location.href='ficheroExcel.php?subasta=<?=$sub_uid?>'; return false;" class="xls">
				<img src="lib/ext/excel.png" border="0" alt="Excel" title="Excel" />
					</a>
		<?php }
                 * ?>	
                 */
         ?>
		</td>
        <td align="center" width="5%" height="5">
            <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Ver' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if($valuePermit=='ACTIVE'){
            ?>
        <a href="subastasView.php?pro_uid=<?=$pro_uid?>&token=<?=admin::getParam("token");?>&sub_uid=<?=$sub_uid?>&tipUid=<?=$tipUid?>">
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
	if($sub_finish!=0)
		{
	?>
		<img src="lib/edit_off_es.gif" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
	<?php
		}else{
	?>
                <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Editar' and moa_rol_uid=".$_SESSION['usr_rol']."");
            if($valuePermit=='ACTIVE'){
            ?>
		<a href="subastasEdit.php?token=<?=admin::getParam("token")?>&pro_uid=<?=$pro_uid?>&sub_uid=<?=$sub_uid?>&tipUid=<?=$tipUid?>">
		<img src="<?=admin::labels('edit','linkImage')?>" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
		</a>
                <?php
            }else{
                ?>
                <img src="lib/edit_off_es.gif" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
        <?php 
            }
            }
        ?>
	</td>
	<td align="center" width="5%" height="5">
    <?php 
		if($sub_finish!=0)
		{
	?>
		<img src="lib/delete_off_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
	<?php
		}else{
	?>
            <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Eliminar' and moa_rol_uid=".$_SESSION['usr_rol']."");
            if($valuePermit=='ACTIVE'){
            ?>
		<a href="removeList" onclick="removeList('<?=$sub_uid?>');return false;">
                    <img src="<?=admin::labels('delete','linkImage')?>" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
		</a>
            <?php
            }else{
                ?>
                <img src="lib/delete_off_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
        <?php
            }
        }?>
	</td>
	<td align="center" width="5%" height="5">
	<div id="status_<?=$sub_uid?>">
	<?php
		if($sub_finish!=0)
		{
        if ($pro_status=='ACTIVE'){
	?>
		<img src="lib/active_off_es.gif" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
    <?php
  }else{
    ?>
                <img src="lib/inactive_off_es.gif" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">

    <?php }
  }
	else{
            ?>
                <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Estado' and moa_rol_uid=".$_SESSION['usr_rol']."");
            if($valuePermit=='ACTIVE'){
            ?>
                 <a href="javascript:subastatatus('<?=$sub_uid?>','<?=$pro_status?>');">
		<img src="<?=admin::labels($labels_content,'linkImage')?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
		</a>
		<?php
	}else{
             $status = ($pro_status=='ACTIVE') ? 'active_off_es.gif':'inactive_off_es.gif';
		?>
                <img src="lib/<?=$status?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
                <?php
        }
        
        }
                ?>
	</div>
	</td>
        <td align="center" width="5%" height="5">
	<?php
		if($sub_finish!=0)
		{
	?>
		<img src="lib/aprobar_off.png" border="0" title="APROBAR" alt="APROBAR">
    <?php }
	else{
            $rolAplica =admin::validaRav($sub_uid,admin::getSession("usr_rol"),1,$sub_moneda, $sub_monto, $unidadUid);
            if($rolAplica==1)
            {
            ?>
                <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Aprobar' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if($valuePermit=='ACTIVE'){
                ?>
                    <a href="aprobarSubasta" onclick="aprobarSubasta('<?=$sub_uid?>');return false;">
                        <img src="lib/aprobar_on.png" border="0" title="Aprobar" alt="Aprobar">
                    </a>
                <?php
                }else{
                ?>
                    <img src="lib/aprobar_off.png" border="0" title="Aprobar" alt="Aprobar">
	    <?php
                }
            }else{
                ?>
		<img src="lib/aprobar_off.png" border="0" title="Aprobar" alt="Aprobar">
    <?php
                
            }
	}
		?>

	</td>
        
        <td align="center" width="5%" height="5">
	<?php
		if($sub_finish!=0)
		{
	?>
		<img src="lib/rechazar_off.png" border="0" title="Rechazar" alt="Rechazar">
    <?php }
	else{
            if($rolAplica==1)
            {
            ?>
                <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Rechazar' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if($valuePermit=='ACTIVE'){
                ?>

         	    <a href="rechazarSubasta" onclick="rechazarSubasta('<?=$sub_uid?>');return false;">
                	<img src="lib/rechazar_on.png" border="0" title="Rechazar" alt="Rechazar">
                    </a>
                <?php
                    }else{
                ?>
                	<img src="lib/rechazar_off.png" border="0" title="Rechazar" alt="Rechazar">
		<?php
                    }
            }else{
                ?>
		<img src="lib/rechazar_off.png" border="0" title="Rechazar" alt="Rechazar">
    <?php
                
            }
	}
		?>

	</td>
        
		</tr>
	</table>
<?php
$i++; 
$j++; 
?>
</div>
</div>
<?php } 
?>
</div>
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
    <tr>
    <td colspan="2">
    
    </td>
	</tr>
</table><br />
<br />
<br />
<?php 	} 
else
	{ ?>
	<br />
<br />
<div id="itemList"> 
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
      <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
      <td width="23%" height="40" align="right">
      <?php
        
        $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleCrearId and mop_lab_category='Crear' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){?>
           <a href="<?=admin::modulesLink($etiquetaCrear)?>?token=<?=admin::getParam("token")?>&tipUid=<?=admin::getParam("tipUid")?>"><?=admin::modulesLabels($etiquetaCrear)?></a>
        <?php
        }
        ?>
          &nbsp;
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
</td></tr>
</table>
<br>

</form>

<?php 	} 
?>