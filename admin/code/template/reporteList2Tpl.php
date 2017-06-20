<?php
define (SYS_LANG,$lang);
$maxLine=20;
$order=0; 
//variables para filtros de productos*******************************************
$queryFilter = admin::toSql(admin::getParam("qfiltro"),"Number");

$search2 = admin::toSql(admin::getParam("search2"),"String");
if ($search2) $searchURL='&search2='.$search2.'&qfiltro=1';
else $searchURL='';
$timeNow= date("Y-m-d H:i:s");//sub_finish<>0
//echo $timeNow;
if ($search2!="")
{
	$Where = " and (pro_name like '%" .$search2. "%' or pro_uid like '%" .$search2. "%') ";
	
}
    
$qsearch= " select distinct pro_uid, pro_name, pca_name, sub_status, sub_uid, sub_type, "
        . " sub_finish as estado "
        . " from mdl_product, mdl_subasta, mdl_pro_category, mdl_subasta_aprobar, mdl_subasta_informe "
        . " WHERE sub_uid=pro_sub_uid and sup_sub_uid = sub_uid and sua_sub_uid = sub_uid and sup_status='ACTIVE' "
        . " and sua_status='ACTIVE' and pca_uid=sub_pca_uid and sub_delete=0 and sub_mode='SUBASTA' $Where ";

$order= admin::toSql(admin::getParam("order"),"Number");
if ($order) admin::setSession("order",$order);
else $order=admin::getSession("order");

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
$_pagi_sql=$qsearch.$orderCode;
//echo $_pagi_sql;

$_pagi_cuantos = $maxLine;//Elegí un número pequeño para que se generen varias páginas
//cantidad de enlaces que se mostrarán como máximo en la barra de navegación
$_pagi_nav_num_enlaces = 5;//Elegí un número pequeño para que se note el resultado
//Decidimos si queremos que se muesten los errores de mysql
$_pagi_mostrar_errores = false;//recomendado true sólo en tiempo de desarrollo.
$nroReg = $db->numrows($_pagi_sql);
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
    <td width="23%" height="40" align="right"></td>
  </tr>
  <tr>
	<td width="90%" height="40"></td>
    <td>
        <div class="boxSearch">
        <form  method="post" name="frmSubastasSearch" action="reporteList2.php" >
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
          <td>
            <input type="text" name="search2" id="search2" value="<?=$search2?>" class="input7" />
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
  <td colspan="2">
  <table width="100%" border="0">
	<tr>
		<td width="5%"><a href="reporteList2.php?order=<?=$uidOrder?><?=$searchURL?>" class="<?=$uidClass;?>"><?=admin::labels('code');?>:</a></td>
        <td width="25%" ><a href="reporteList2.php?order=<?=$nameOrder?><?=$searchURL?>" class="<?=$nameClass;?>"><?=admin::labels('name');?>:</a></td>
        <td width="25%" ><a href="reporteList2.php?order=<?=$linOrder?><?=$searchURL?>" class="<?=$linClass;?>"><?=admin::labels('category');?>:</a></td>
        <td width="25%" ><span class="txt11 color2">Unidad Solicitante:</span></td>
        <!--<td width="15%" align="center"><span class="txt11 color2">Reporte PDF:</span></td>		-->
        <td width="20%"></td>
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
		<td width="5%" ><span <?=$dest?>><?=admin::toHtml($sub_uid)?></span></td>
        <td width="25%" ><span <?=$dest?>><?=$pro_name?></span></td>
        <td width="25%" ><span <?=$dest?>><?=$pca_name?></span></td>
        <td width="25%" ><?=$rav_unidad?></td>
	<!--<td align="center" width="15%" height="5"> <a href="code/execute/reporteTpl2XlsPdf.php?pro=<?=$sub_uid?>&type=pdf"><img src="lib/ext/acrobat.png" border="0" alt="Excel" title="Excel" /></a>
    
	</td>-->
        <td width="20%">
                   <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=27 and mop_lab_category='Ver' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if($valuePermit=='ACTIVE'){
            ?>
    	<a href="reporteView2.php?sub_uid=<?=$sub_uid?>">
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

        </tr>
	</table>
<?php
$i++; 
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
    <td width="23%" height="40" align="right"></td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
<div  style="background-color: #f7f8f8;">
<table class="list"  width="100%">
	<tr><td height="30px" align="center" class="bold">
	No se encontraron registros
	</td></tr>	
 </table>
</div>
</td></tr>
</table>


<?php 	} 
?>