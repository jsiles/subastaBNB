<?php
/*

 * ROLES
 * 3 ANALISTA
 * 4 SUBASTADOR
 * 5 JEFE NAL
 * 6 GERENTE

    ESTADOS DE UNA SUBASTA
    sub_finish
    0 SOLICITUD
    1 APROBADA
    2 SUBASTANDOSE
    3 CONCLUIDA
    4 ADJUDICADA
    5 ANULADA
    6 RECHAZADA
    7 DESIERTA
 */
define (SYS_LANG,$lang);
$maxLine=20;
$order=0; 
//variables para filtros de productos*******************************************
$queryFilter = admin::toSql(admin::getParam("qfiltro"),"Number");
$rolAplica = false;
$rol = $_SESSION["usr_rol"];
$search2 = admin::toSql(admin::getParam("search2"),"String");
if ($search2) $searchURL='&search2='.$search2.'&qfiltro=1';
else $searchURL='';
$timeNow= date("Y-m-d H:i:s");//sub_finish<>0
//echo $timeNow;
$qsearch="SELECT pro_uid, pro_name, pca_name, sub_status, sub_uid, sub_type, iif('$timeNow'>sub_deadtime,'concluida','subastandose') as deadtime, sub_finish as estado, sub_mount_base, sub_modalidad, sub_moneda FROM mdl_product, mdl_subasta, mdl_pro_category WHERE sub_uid=pro_sub_uid and pca_uid=sub_pca_uid and sub_delete=0 and sub_mode='SUBASTA' and sub_finish =0 ";
$maxLine2 = admin::toSql(admin::getParam("maxLineP"),"Number");
if ($maxLine2) {$maxLine=$maxLine2; admin::setSession("maxLineP",$maxLine2);}
else {
		$maxLine2=admin::getSession("maxLineP");
		if ($maxLine2) $maxLine=$maxLine2;
	}

$order= admin::toSql(admin::getParam("order"),"Number");
if ($order) admin::setSession("order",$order);
else $order=admin::getSession("order");

if ($order==0) {$orderCode=' ORDER BY pro_uid desc'; $uidClass='down'; $nameClass='up'; $linClass='up';}
elseif ($order==1) {$orderCode='  ORDER BY pro_uid asc'; $uidClass='up'; $nameClass='up'; $linClass='up';}
elseif ($order==2) {$orderCode='  ORDER BY pro_uid desc'; $uidClass='down'; $nameClass='up'; $linClass='up';}
elseif ($order==3) {$orderCode='  ORDER BY pro_name asc'; $uidClass='up'; $nameClass='up'; $linClass='up';}
elseif ($order==4) {$orderCode='  ORDER BY pro_name desc'; $uidClass='up'; $nameClass='down'; $linClass='up';}
elseif ($order==5) {$orderCode='  ORDER BY pca_name asc'; $uidClass='up'; $nameClass='up'; $linClass='up';}
elseif ($order==6) {$orderCode='  ORDER BY pca_name desc'; $uidClass='up'; $nameClass='up'; $linClass='down';}

if ($uidClass=='up') $uidOrder=2;
else $uidOrder=1;
if ($nameClass=='up') $nameOrder=4;
else $nameOrder=3;
if ($linClass=='up') $linOrder=6;
else $linOrder=5;

if ($lang=='es') $urlFrontLang='';
else $urlFrontLang=$lang.'/';

$UrlProduct=admin::getDBvalue("SELECT col_url FROM mdl_contents_languages WHERE col_con_uid=3 and col_language='".$lang."'");

$contentURL = admin::getContentUrl($con_uid,SYS_LANG);

?>
<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<?php
/********EndResetColorDelete*************/
$_pagi_sql=$qsearch.$orderCode;


$_pagi_cuantos = $maxLine;//Elegí un número pequeño para que se generen varias páginas
//cantidad de enlaces que se mostrarán como máximo en la barra de navegación
$_pagi_nav_num_enlaces = 5;//Elegí un número pequeño para que se note el resultado
//Decidimos si queremos que se muesten los errores de mysql
$_pagi_mostrar_errores = false;//recomendado true sólo en tiempo de desarrollo.
$nroReg = $db->numrows($_pagi_sql);
//echo $_pagi_sql;
//echo $nroReg;
$db->query($_pagi_sql);
//echo $_pagi_sql;
include("core/paginator.inc.php");

if ($nroReg>0)
	{
	?>
   
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
      <td width="23%" height="40" align="right">&nbsp;</td>
  </tr>
  <tr>
	<td width="90%" height="40"></td>
        <td>
        <div class="boxSearch">
        <form  method="post" name="frmSubastasSearch" action="subastasList.php" >
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
          <td>
            <input type="text" name="search2" id="search2" value="<?=$search2?>" class="input7" />
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
  <td colspan="2" width="100%" >
  <table width="100%" border="0">
	<tr>
	<td width="10%"><a href="subastasList.php?order=<?=$uidOrder?><?=$searchURL?>" class="<?=$uidClass;?>"><?=admin::labels('code');?>:</a></td>
        <td width="10%" ><a href="subastasList.php?order=<?=$nameOrder?><?=$searchURL?>" class="<?=$nameClass;?>"><?=admin::labels('name');?>:</a></td>
        <td width="10%" ><a href="subastasList.php?order=<?=$linOrder?><?=$searchURL?>" class="<?=$linClass;?>"><?=admin::labels('category');?>:</a></td>
        <td width="10%" ><span class="txt11 color2">Monto Referencial:</span></td>
        <td width="10%" ><span class="txt11 color2">Estado:</span></td>
	<td align="left" width="10%" height="5"><span class="txt11 color2">Lista de Ofertas</span></td>
        <td width="5%">&nbsp;</td>		
	<td align="center" width="5%" height="5">&nbsp;</td>
	<td align="center" width="5%" height="5">&nbsp;</td>
	<td align="center" width="5%" height="5">&nbsp;</td>
	<td align="center" width="5%" height="5">&nbsp;</td>
	<td align="center" width="5%" height="5">&nbsp;</td>
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
	$sub_monto = $subasta_list["sub_mount_base"];
        $sub_modalidad = $subasta_list["sub_modalidad"];
        $sub_status = $subasta_list["sub_status"];
        $sub_moneda = $subasta_list["sub_moneda"];
        if($sub_modalidad=="ITEM")
        {
            //echo "SELECT SUM(xit_price) FROM mdl_xitem WHERE xit_sub_uid=$sub_uid and xit_delete=0 ";
         $sub_monto = admin::getDbValue("SELECT SUM(xit_price) FROM mdl_xitem WHERE xit_sub_uid=$sub_uid and xit_delete=0 "); 
        }

//	echo $pro_status;
	$deadtime = $subasta_list["deadtime"];
	$sub_finish = $subasta_list["estado"];
        
        if(($deadtime=='subastandose')&&($sub_finish==1)) $sub_finish=2;
         $countBids=admin::getDBvalue("SELECT count(*) FROM mdl_bid where bid_sub_uid='".$sub_uid."' and bid_cli_uid!=0");
        if(($countBids==0)&&($sub_finish==3)) $sub_finish=7;
    /*
    
    ESTADOS DE UNA SUBASTA
    sub_finish
    0 SOLICITUD
    1 APROBADA
    2 SUBASTANDOSE
    3 INFORME
    4 ADJUDICADA
    5 ANULADA
    6 RECHAZADA
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
    		$sub_estado  ='INFORME';
    		break;
    	case  4:
    		$sub_estado  ='ADJUDICADA';
    		break;
    	case  5:
    		$sub_estado  ='ANULADA';
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
  	?> 
	<div class="groupItem" id="<?=$pro_uid?>">
    
    <div id="list_<?=$sub_uid?>" class="<?=$class?>" style="width:100%" >
    
    <table class="list" border="0" width="100%" style="">
	<tr>
		<td width="10%" ><span <?=$dest?>><?=admin::toHtml($sub_uid)?></span></td>
        <td width="10%" ><span <?=$dest?>><?=$pro_name?></span></td>
        <td width="10%" ><span <?=$dest?>><?=$pca_name?></span></td>
        <td width="10%" ><span><?=admin::numberFormat($sub_monto)?></span></td>
        <td width="10%" ><span><?=$sub_estado?></span></td>
		<td align="left" width="10%" height="5">
         <?php
		 if ($countBids>0){
		 ?>
        <a href="excel" onclick="document.location.href='ficheroExcel.php?subasta=<?=$sub_uid?>'; return false;" class="xls">
				<img src="lib/ext/excel.png" border="0" alt="Excel" title="Excel" />
					</a>
		<?php
                } 
                ?>	
		</td>
        <td align="center" width="5%" height="5">
    		 <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=20 and mop_lab_category='Ver' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if($valuePermit=='ACTIVE'){
            ?>
        <a href="autorizacionView.php?pro_uid=<?=$pro_uid?>">
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
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=20 and mop_lab_category='Editar' and moa_rol_uid=".$_SESSION['usr_rol']."");
            if($valuePermit=='ACTIVE'){
            ?>
		<a href="autorizacionEdit.php?pro_uid=<?=$pro_uid?>&sub_uid=<?=$sub_uid?>">
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
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=20 and mop_lab_category='Eliminar' and moa_rol_uid=".$_SESSION['usr_rol']."");
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
         }
        ?>
	</td>
        
        <td align="center" width="5%" height="5">
    <div id="status_<?=$sub_uid?>">
        <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=20 and mop_lab_category='Estado' and moa_rol_uid=".$_SESSION['usr_rol']."");
            if($valuePermit=='ACTIVE'){
            ?>
	   <a href=""  onclick="autorizacionCS('<?=$sub_uid?>','<?=$sub_status?>'); return false;">
		<img src="<?=admin::labels($labels_content,'linkImage')?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
	   </a>
        <?php
            }else{
                $status = ($sub_status=='ACTIVE') ? 'active_off_es.gif':'inactive_off_es.gif';
        ?>
        <img src="lib/<?=$status?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
        <?php
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
            //echo "ACA";
            $rolAplica = false;
            $sql =  "select count(*) from mdl_rav where rav_tipologia=1 and rav_delete=0 and rav_rol_uid=$rol and rav_cur_uid=".$sub_moneda;
            $valida = admin::getDbValue($sql);
            //echo $sql;
            if($valida>0)
            {   
                $montoBase = $sub_monto;
                $montoMenor = admin::getDbValue("SELECT rav_monto_inf FROM mdl_rav WHERE rav_tipologia=1 and rav_delete=0 and rav_rol_uid=".$rol." and rav_cur_uid=".$sub_moneda);
                $montoMayor = admin::getDbValue("SELECT rav_monto_sup FROM mdl_rav WHERE rav_tipologia=1 and rav_delete=0 and rav_rol_uid=".$rol." and rav_cur_uid=".$sub_moneda);
                if($montoMayor!=0){
            
                    if(($montoBase>=$montoMenor)&&($montoBase<=$montoMayor)) $rolAplica=true;
                   
                }else{if($montoBase>=$montoMenor) $rolAplica=true;}                
            }

            if($rolAplica)
            {
            ?>
                <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=20 and mop_lab_category='Aprobar' and moa_rol_uid=".$_SESSION['usr_rol']."");
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
            $rolAplica = false;
            $sql =  "select count(*) from mdl_rav where rav_tipologia=1 and rav_rol_uid=$rol";
            $valida = admin::getDbValue($sql);
            if($valida>0)
            {   
                $montoBase = $sub_monto;
                $montoMenor = admin::getDbValue("SELECT rav_monto_inf FROM mdl_rav WHERE rav_tipologia=1 and rav_rol_uid=".$rol);
                $montoMayor = admin::getDbValue("SELECT rav_monto_sup FROM mdl_rav WHERE rav_tipologia=1 and rav_rol_uid=".$rol);
                if($montoMayor!=0){
            
                    if(($montoBase>=$montoMenor)&&($montoBase<=$montoMayor)) $rolAplica=true;
                   
                }else{if($montoBase>=$montoMenor) $rolAplica=true;}                
            }

            if($rolAplica)
            {
            ?>
                <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=20 and mop_lab_category='Rechazar' and moa_rol_uid=".$_SESSION['usr_rol']."");
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
<?php
} 
?>
</div>
    </td>
    </tr>
	<tr>
    <td colspan="2">
    <br />
    </td>
    </tr>
    <tr>
    <td colspan="2">
    <!--<table width="100%">
	<form>    
    <tr style="display:none">
    <td align="right">
      <p><span>Ir a:</span> <input name='webPag' id='webPag' type="text" maxlength="5" size="6"/><input type="button" onclick="goToPag();" value="Ir" /><span name='div_webPag' id='div_webPag'></span></p>
    </td>
  <td align="right" width="10%">
   <select name="maxLineP" onchange="RowsF(this.value);">
   	<option value="10" <? if ($maxLineP==20)  echo 'selected="selected"';?>>20 resultados</option>
    <option value="20" <? if ($maxLineP==30)  echo 'selected="selected"';?>>30 resultados</option>
    <option value="30" <? if ($maxLineP==40)  echo 'selected="selected"';?>>40 resultados</option>
    <option value="50" <? if ($maxLineP==50)  echo 'selected="selected"';?>>50 resultados</option>
    <option value="100"<? if ($maxLineP==100)  echo 'selected="selected"';?>>100 resultados</option>
   </select>
  </td>
	<td align="right" class="txt11" width="20%">
	<?	
	//Incluimos la barra de navegación
	if ($nroReg==0) 
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
	</td>
    </tr>
	</form>
    </table>-->
    </td>
	</tr>
</table><br />
<br />
<br />
<?php
} 
else
	{ ?>
	<br />
<br />
<div id="itemList"> 
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
      <td width="23%" height="40" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
<div  style="background-color: #f7f8f8;">
<table class="list"  width="100%">
	<tr><td height="30px" align="center" class="bold">
	No existen registros
	</td></tr>	
 </table>
</div>
</td>
  </tr>
</table>

<?php
} 
?>