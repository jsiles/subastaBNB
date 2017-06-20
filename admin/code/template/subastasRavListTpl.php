<?php
define (SYS_LANG,$lang);
$maxLine=20;
$order=0; 
//variables para filtros de productos*******************************************
$timeNow= date("Y-m-d H:i:s");//sub_finish<>0
//echo $timeNow;
$maxLine2 = admin::toSql(admin::getParam("maxLineP"),"Number");
if ($maxLine2) {$maxLine=$maxLine2; admin::setSession("maxLineP",$maxLine2);}
else {
		$maxLine2=admin::getSession("maxLineP");
		if ($maxLine2) $maxLine=$maxLine2;
	}

if ($lang=='es') $urlFrontLang='';
else $urlFrontLang=$lang.'/';

$UrlProduct=admin::getDBvalue("select col_url FROM mdl_contents_languages where col_con_uid=3 and col_language='".$lang."'");

$contentURL = admin::getContentUrl($con_uid,SYS_LANG);
$qsearch="select * from mdl_rav where rav_tipologia=$tipUid and rav_delete=0 order by rav_uid asc";
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
      <td width="23%" height="40" align="right">
        <?php
       
        $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleCrearId and mop_lab_category='Crear' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){?>
          
          <a href="<?=admin::modulesLink($etiquetaCrear)?>"><?=admin::modulesLabels($etiquetaCrear)?></a>
        <?php
        }
        ?>
        &nbsp;
      </td>
  </tr>
  <tr>
	<td width="90%" height="40"></td>
    <td>
    </td>
  </tr>
  <tr>
      <td colspan="2" width="100%">
  <table width="100%" border="0">
	<tr>
            <td width="5%"><span class="txt11 color2"><?=admin::labels('code');?></span></td>
            <td width="15%" ><span class="txt11 color2">Rol</span></td>
            <td width="11%" ><span class="txt11 color2">Monto Inferior</span></td>
            <td width="11%" ><span class="txt11 color2">Monto Superior</span></td>
            <td width="11%"><span class="txt11 color2">Unidad Solicitante</span></td>
            <td width="11%"><span class="txt11 color2">Moneda</span></td>
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
	$rav_uid = trim($subasta_list["rav_uid"]);		
        $rav_rol = admin::getDbValue("select rol_description from mdl_roles where rol_uid=". $subasta_list["rav_rol_uid"]);
	$rav_monto = trim($subasta_list["rav_monto_inf"]);
	$rav_monto1 = ($subasta_list["rav_monto_sup"]!=0)?$subasta_list["rav_monto_sup"]:"Sin l&iacute;mite";
        
	$unidadArray =  admin::dbFillArray("select uni_uid, uni_description from mdl_unidad, mdl_rav_access where raa_uni_uid=uni_uid and raa_rav_uid=$rav_uid group by uni_uid, uni_description");
        $k=0; 
        $rav_unidad="";
        if(is_array($unidadArray))
        foreach($unidadArray as $key => $value)
        {
            if($k==0) $rav_unidad.= $value;
            else $rav_unidad.= ",".$value;
            $k++;
        }
        else $rav_unidad="Sin asignar";
        //echo $rav_unidad;
        //print_r($unidadArray);
        $rav_status = $subasta_list["rav_status"];
        $rav_delete = $subasta_list["rav_delete"];
        $rav_moneda = admin::getDbValue("select cur_description from mdl_currency where cur_uid=".$subasta_list["rav_cur_uid"]);
        $dest="";
		?> 
	<div class="groupItem" id="<?=$pro_uid?>">
    
    <div id="list_<?=$rav_uid?>" class="<?=$class?>" style="width:100%" >
    
    <table class="list" width="100%" border="0" style="">
	<tr>
		<td width="5%" ><span <?=$dest?>><?=admin::toHtml($rav_uid)?></span></td>
        <td width="15%" ><span <?=$dest?>><?=$rav_rol?></span></td>
        <td width="11%" ><span ><?=admin::numberFormat($rav_monto)?></span></td>
        <td width="11%" ><span><?=admin::numberFormat($rav_monto1)?></span></td>
        <td width="11%" ><span><?=$rav_unidad?></span></td>
        <td width="11%" ><span><?=$rav_moneda?></span></td>
                <td align="center" width="5%" height="5">
            <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Ver' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){
            ?>
                    <a href="subastasRavView.php?rav_uid=<?=$rav_uid?>&tipUid=<?=admin::getParam("tipUid")?>">
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
	if($valuePermit=='ACTIVE'){
            ?>
		<a href="subastasRavEdit.php?rav_uid=<?=$rav_uid?>&tipUid=<?=admin::getParam("tipUid")?>">
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
	if($valuePermit=='ACTIVE'){
            ?>  
		<a href="" onclick="removeList(<?=$rav_uid?>); return false;">
		<img src="lib/delete_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
		</a>
    <?php }
	else{?>
                <img src="lib/delete_off_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
              <?php
        }
    ?>            
	</td>
	<td align="center" width="5%" height="5">
	<div id="status_<?=$rav_uid?>">
        <?php
            $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleListId and mop_lab_category='Estado' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){
            $status = ($rav_status=='ACTIVE') ? 'active_es.gif':'inactive_es.gif';
            ?>            
	   <a href=""  onclick="ravCS('<?=$rav_uid?>','<?=$rav_status?>'); return false;">
		<img src="lib/<?=$status?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
		</a>
              <?php }
	else{
            $status = ($rav_status=='ACTIVE') ? 'active_off_es.gif':'inactive_off_es.gif';
            ?>
             <img src="lib/<?=$status?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
        <?php
        
        }
        ?>

	</div>
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
            <a href="<?=admin::modulesLink($etiquetaCrear)?>"><?=admin::modulesLabels($etiquetaCrear)?></a>
        <?php
        }
        ?>
        &nbsp;
    </td>
  </tr>
    <tr>
	<td width="90%" height="40"></td>
    <td>
    </td>
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
</td></tr>
</table>
</form>

<?php 	} 
?>