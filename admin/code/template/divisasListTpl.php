<?php
define (SYS_LANG,$lang);
$maxLine=20;
$order=0; 
//variables para filtros de productos*******************************************
$queryFilter = admin::toSql(admin::getParam("qfiltro"),"Number");

$search2 = admin::toSql(admin::getParam("search2"),"String");
if ($search2) $searchURL='&search2='.$search2.'&qfiltro=1';
else $searchURL='';

if ($queryFilter==1)
{
	if ($search2) $qsearch="SELECT pro_uid, pro_name, pca_name, sub_status, sub_uid, sub_type, iif(sub_finish<>0,'concluida','subastandose') as deadtime FROM mdl_product, mdl_subasta, mdl_pro_category WHERE sub_uid=pro_sub_uid and pca_uid=sub_pca_uid and sub_delete=0 and sub_mode='DIVISA' ";
	else $qsearch="SELECT pro_uid, pro_name, pca_name, sub_status, sub_uid, sub_type, iif(sub_finish<>0,'concluida','subastandose') as deadtime FROM mdl_product, mdl_subasta, mdl_pro_category WHERE sub_uid=pro_sub_uid and pca_uid=sub_pca_uid and sub_delete=0 and sub_mode='DIVISA' ";
}
else $qsearch="SELECT distinct pro_uid, pro_name, pca_name, sub_status, sub_uid, sub_type, iif(sub_finish<>0,'concluida','subastandose') as deadtime FROM mdl_product, mdl_subasta, mdl_pro_category WHERE sub_uid=pro_sub_uid and pca_uid=sub_pca_uid and sub_delete=0 and sub_mode='DIVISA' ";

$maxLine2 = admin::toSql(admin::getParam("maxLineP"),"Number");
if ($maxLine2) {$maxLine=$maxLine2; admin::setSession("maxLineP",$maxLine2);}
else {
		$maxLine2=admin::getSession("maxLineP");
		if ($maxLine2) $maxLine=$maxLine2;
	}

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

if ($lang=='es') $urlFrontLang='';
else $urlFrontLang=$lang.'/';
$UrlProduct=admin::getDBvalue("select col_url FROM mdl_contents_languages where col_con_uid=3 and col_language='".$lang."'");

$contentURL = admin::getContentUrl($con_uid,SYS_LANG);
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

//echo $_pagi_sql;
$nroReg = $db->numrows($_pagi_sql);
$db->query($_pagi_sql);

include("core/paginator.inc.php");

if ($nroReg>0)
	{
	?>
   
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td width="77%" height="40"><span class="title">Listado de divisas</span></td>
    <td width="23%" height="40" align="right"><a href="subastasNew.php?token=<?=admin::getParam("token")?>">Crear divisas</a></td>
  </tr>
  <tr>
	<td width="90%" height="40"></td>
    <td>
        <div class="boxSearch">
        <form name="frmSubastasSearch" action="divisasList.php" >
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
  <td>
  <table width="100%" border="0">
	<tr>
		<td width="8%"><a href="divisasList.php?order=<?=$uidOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>" class="<?=$uidClass;?>"><?=admin::labels('code');?>:</a></td>
        <td width="18%" ><a href="divisasList.php?order=<?=$nameOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>" class="<?=$nameClass;?>"><?=admin::labels('name');?>:</a></td>
        <td width="13%" ><a href="divisasList.php?order=<?=$linOrder?><?=$searchURL?>&token=<?=admin::getParam("token")?>" class="<?=$linClass;?>"><?=admin::labels('category');?>:</a></td>
        <td width="15%" ><span class="txt11 color2">Estado:</span></td>
		<td align="center" width="10%" height="5"><span class="txt11 color2">Lista de pujas</span></td>
        <td width="11%"></td>		
		<td align="center" width="12%" height="5"></td>
		<td align="center" width="12%" height="5"></td>
		<td align="center" width="14%" height="5"></td>
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
	if ($pro_status=='ACTIVE') $labels_content='status_on';
	else $labels_content='status_off';

	if ($i%2==0) $class='row';
	else  $class='row0';	

	if ($subasta_list["pro_stress"]==1) $dest = 'style=" font-weight:bold;"';
	else $dest = '';
  	?> 
	<div class="groupItem" id="<?=$pro_uid?>">
    
    <div id="list_<?=$pro_uid?>" class="<?=$class?>" style="width:100%" >
    
    <table class="list" width="100%" style="">
	<tr>
		<td width="5%" ><span <?=$dest?>><?=admin::toHtml($pro_uid)?></span></td>
        <td width="15%" ><span <?=$dest?>><?=ucfirst(strtolower(trim(admin::toHtml($pro_name))))?></span></td>
        <td width="10%" ><span <?=$dest?>><?=ucwords(strtolower(trim(admin::toHtml($pca_name))))?></span></td>
        <td width="15%" ><span><?=$deadtime?></span></td>
		<td align="left" width="10%" height="5">
         <?php
		 $countBids=admin::getDBvalue("SELECT count(*) FROM mdl_bid where bid_sub_uid='".$sub_uid."' and bid_cli_uid!=0");
		 if ($countBids>0){
		 ?>
        <a href="excel" onclick="document.location.href='ficheroExcel.php?subasta=<?=$sub_uid?>'; return false;" class="xls">
				<img src="lib/ext/excel.png" border="0" alt="Excel" title="Excel" />
					</a>
		<?php }?>	
		</td>
        <td align="center" width="5%" height="5">
        <a href="divisasView.php?pro_uid=<?=$pro_uid?>&token=<?=admin::getParam("token");?>"><img src="lib/view_es.gif" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>">
	</a>
        </td>
	<td align="center" width="12%" height="5">
    	<a href="divisasEdit.php?token=<?=admin::getParam("token")?>&pro_uid=<?=$pro_uid?>">
		<img src="<?=admin::labels('edit','linkImage')?>" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
		</a>
    </td>
	<td align="center" width="12%" height="5">
    	<a href="removeList" onclick="removeList('<?=$pro_uid?>');return false;">
		<img src="<?=admin::labels('delete','linkImage')?>" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
		</a>
    </td>
	<td align="center" width="14%" height="5">
    <div id="status_<?=$sub_uid?>">
	   <a href="javascript:subastatatus('<?=$sub_uid?>','<?=$pro_status?>');">
		<img src="<?=admin::labels($labels_content,'linkImage')?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
		</a>
	</div>
    </td>
		</tr>
	</table>
<?php
$i++; 
$j++; ?>
</div>
</div>
<?php } 
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
<?php 	} 
else
	{ ?>
	<br />
<br />
<div id="itemList"> 
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
      <td width="77%" height="40"><span class="title">Listado de divisas</span></td>
    <td width="23%" height="40" align="right"><a href="divisasNew.php">Crear divisas</a></td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
<div  style="background-color: #f7f8f8;">
<table class="list"  width="100%">
	<tr><td height="30px" align="center" class="bold">
	No hay divisas que mostrar
	</td></tr>	
 </table>
</div>
</td></tr>
</table>
</form>

<?php 	} 
?>