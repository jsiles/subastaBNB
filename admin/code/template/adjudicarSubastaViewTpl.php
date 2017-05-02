<?php
$sub_uid=admin::getParam("sub_uid");
$sql = "SELECT * FROM mdl_product, mdl_subasta, mdl_pro_category WHERE sub_uid=pro_sub_uid and pca_uid=sub_pca_uid and sub_status='ACTIVE' and sub_uid='".$sub_uid."'";
$db->query($sql);
$prod = $db->next_record();

?>
<br />
<div id="div_wait" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<form name="frmsubasta" method="post" action="code/execute/adjudicarSubasta.php?token=<?=admin::getParam("token")?>&sub_uid=<?=$prod["sub_uid"]?>" enctype="multipart/form-data" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="77%" height="40">
                    <span class="title">&nbsp;</span>
		</td>
		<td width="23%" height="40">&nbsp;</td>
	</tr>
  	<tr>
	<td colspan="2" id="contentListing">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td width="50%" valign="top">
		<!--TABLA IZQUIERDA BEGIN-->
        
        <table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">			
			<tr>
			<td colspan="2" class="titleBox"><?=admin::labels('data');?> B&aacute;sicos:</td>
			</tr>
                         <tr>
                            <td width="29%">Nro de Solicitud:</td>
                            <td width="64%"><?=$prod["sub_sol_uid"]?>
                                <br /><span id="div_sol_uid" style="display:none; padding-left:5px; padding-right:5px;" class="error">Campo requerido</span>
                            </td>
                        </tr>
                         <tr>
                            <td width="29%">Nro de proceso:</td>
                            <td width="64%"><?=$prod["sub_uid"]?>
                                <br /><span id="div_sol_uid" style="display:none; padding-left:5px; padding-right:5px;" class="error">Campo requerido</span>
                            </td>
                        </tr>
                        
            <tr>
				<td><?=admin::labels('name');?>:</td>
				<td><?=$prod["pro_name"]?>
				<br /><span id="div_pro_name" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subasta','titleerror');?></span>
				</td>
			</tr>
            <tr>
				<td width="29%"><?=admin::labels('category','label');?>:</td>
				<td width="64%">
				<?php
                    $category = admin::getDbValue("select pca_name from mdl_pro_category where pca_delete=0 and pca_uid=".$prod["sub_pca_uid"]);
					echo $category;
					?>
					
				</td>
			</tr>
            
            <tr>
				<td><?=admin::labels('seo','metadescription');?> corta:</td>
				<td><?=$prod["sub_description"]?>
				</td>
			</tr>
            <tr>
				<td><?=admin::labels('seo','metadescription')?>:</td>
				<td><?=$prod["pro_description"]?>
				</td>
			</tr>
            <tr>
				<td><?=admin::labels('labels','quantity');?>:</td>
                                <td><?=admin::numberFormat($prod["pro_quantity"])?>
				</td>
			</tr>
             <tr>
				<td>Unidad (Ej. millones):</td>
				<td><?=$prod["pro_unidad"]?>
				</td>
			</tr>
         <tr>
            <td valign="top"><?=admin::labels('news','image');?>:</td>
            <td>
			<?php
			$imgSavedroot1 = PATH_ROOT."/img/subasta/thumb2_".$prod["pro_image"];
			$imgSaveddomain1 = PATH_DOMAIN."/img/subasta/thumb2_".$prod["pro_image"];
			$imgSaveddomain2 = PATH_DOMAIN."/img/subasta/img_".$prod["pro_image"];
			if (file_exists($imgSavedroot1) && $prod["pro_image"]!=""){
			?>
			<div id="image_edit_<?=$prod["pro_image"]?>">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableUpload">
			<tr>
				<td width="25%" rowspan="2" align="center" valign="middle" style="padding:4px;">
				<a href="<?=$imgSaveddomain2?>" target="_blank"><img src="<?=$imgSaveddomain1?>?<?=time();?>" border="0" /></a>				</td>
				<td width="75%" style="font-size:11px;">
				<?=$prod["pro_name"];?><br />
				</td>
			</tr>
			<tr>
				<td height="24">
				<div id="imageChange1" style="display:none">
			<input type="file" name="pro_image" id="pro_image" size="14" onchange="verifyImageUpload();" style="font-size:11px;"  >  <a href="javascript:viewInputFile('off')" onclick="document.getElementById('pro_image').value='';document.getElementById('button_next').innerHTML='<?=admin::labels('public');?>';"><img border="0" src="lib/close.gif" align="top"/></a>
			
			<span id="div_pro_image" class="error" style="display:none">Solo archivos jpg bmp gif png</span></div></td>
			</tr>
			</table>
			</div>
			<div id="image_add_<?=$prod["pro_uid"]?>" style="display:none;"></div>
			<?php	}
			?>			</td>
          </tr>
          <tr>
            <td valign="top"><?=admin::labels('annex','adjunt');?>:</td>
            <td>
			<?php 
			$imgSavedroot2=PATH_ROOT."/docs/subasta/".$prod["pro_document"];
			$imgSaveddomain2=PATH_DOMAIN."/docs/subasta/".$prod["pro_document"];
			//echo $imgSaveddomain2;die;
			if (file_exists($imgSavedroot2) && $prod["pro_document"]!="")
				{
				$extension = admin::getExtension($prod["pro_document"]);
//				echo $extension;die;
				$imgextension = admin::getExtensionImage($extension);
			//	echo $imgextension;die;
			?>
			<div id="document_edit_<?=$prod["pro_uid"]?>">
			<div id="changeFile">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="12%" rowspan="2" align="center" valign="top">
				<?php if ($imgextension!="") { ?>
					<a href="<?=$imgSaveddomain2?>" target="_blank"><img border="0" src="<?=$imgextension?>" width="16" height="16"/></a>
				<?php } ?>				</td>
				<td width="88%" style="font-size:11px;">
				<span class="nameFile"><?=substr($prod["pro_document"],0,20);?>...</span>
			<br />
				</td>
			</tr>
			<tr>
				<td height="24" valign="top"><div id="div_adjunt_file_change" style="display:none">
				<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td>
				<input type="file" name="pro_document" id="pro_document" size="13" style="font-size:11px;" class="input5"></td>
				<td> <a href="javascript:chageUploadFile('off')" onclick="document.getElementById('pro_document').value='';"><img border="0" src="lib/close.gif" align="top"/></a>				</td>
				</tr>
				</table>
				</div>				</td>
			</tr>
			</table>
			</div>
			</div>
			<div id="document_add_<?=$news["new_uid"]?>" style="display:none;"></div>
			<?php
                        } 
			 ?>
			</td>
          </tr>
          <tr>
            <td valign="top"><?=admin::labels('status');?></td>
            <td><?php if ('ACTIVE'==$prod["sub_status"]) echo "Activo"; else echo "Inactivo";?></td>
          </tr>
            <?php
        $elaborado= admin::getDbValue("select concat(a.usr_firstname, ' ', a.usr_lastname) FROM sys_users a, mdl_subasta b where a.usr_uid=b.sub_usr_uid and b.sub_uid=".$prod["sub_uid"]);
        
        $aprobado = admin::getDbValue("select concat(a.usr_firstname, ' ', a.usr_lastname) FROM sys_users a, mdl_subasta_aprobar b where a.usr_uid=b.sup_user_uid and b.sup_sub_uid=".$prod["sub_uid"]);
        ?>
        
        <tr>
            <td valign="top">Proceso de compra elaborado por:</td>
            <td><?=$elaborado?></td>
                       <td width="7%">&nbsp;</td>
        </tr>
        
        <tr>
            <td valign="top">Proceso de compra aprobado por:</td>
            <td><?=$aprobado?></td>
                       <td width="7%">&nbsp;</td>
        </tr>
        
          
        </table>

		<!--TABLA IZQUIERDA END-->

         	</td>
        <td width="50%" valign="top">
		<!--TABLA DERECHA BEGIN-->

		<table width="98%" border="0" align="right" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td colspan="2" class="titleBox"><?=admin::labels('data');?> Adicionales:</td>
          </tr>
                        
            <tr>
				<td width="29%">Modalidad:</td>
				<td width="64%">
				<?php if ('TIEMPO'==$prod["sub_modalidad"]) echo "Por tiempo";?>
				<?php if ('ITEM'==$prod["sub_modalidad"]) echo "Por Item"; ?>
				<?php if ('PRECIO'==$prod["sub_modalidad"]) echo "Por Precio"; ?>
                                    <input type="hidden" name="sub_modalidad" id="sub_modalidad" value="<?=$prod["sub_modalidad"]?>" />
				</td>
			</tr>         
                
                
                <tr>
				<td width="29%">Tipo:</td>
				<td width="64%">
				<?php if ('COMPRA'==$prod["sub_type"]) echo "Compra"; else echo "Venta";?></td>
			</tr>
            
       
<tr>
			<td>Fecha:</td>
			<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr><td width="28%" valign="middle"> 
                <?php
                $date_end1=admin::changeFormatDate(substr($prod["sub_hour_end"],0,10),2);
				$hour_end1=substr($prod["sub_hour_end"],11,5);
				?>
				<?=$date_end1?>
				</td><td width="72%" valign="middle">
				
				</td>
				</tr>
				</table>			
				</td>
				</tr>          
                	<tr>
					<td>Hora:</td>
					<td><?=$hour_end1?>
					</td>
				</tr>  
              <tr id="tr_montobase" style="display:">
				<td>Monto Referencial:</td>
				<td><?=admin::numberFormat($prod["sub_mount_base"])?>
                <?=admin::getDbValue("select cur_description from mdl_currency where cur_uid=".$prod["sub_moneda"])?>
				</td>
			</tr>
                         <?php
                        if($prod["sub_modalidad"]!="PRECIO")
                        {
                        ?>
            <tr id="tr_unidadmejora" style="display:">
				<td>Unidad de mejora:</td>
				<td><?=admin::numberFormat($prod["sub_mount_unidad"])?>
				</td>
			</tr>
            <tr id="tr_numeroruedas" style="display:">
                <td>N&uacute;mero de ruedas:</td>
				<td><?=$prod["sub_wheels"]?></td>
			</tr>
                        <?php
                        }
                        ?>
			<tr>
				<td>Tiempo l&iacute;mite de mejora en min.:</td>
				<td><?=$prod["sub_tiempo"]?>
				</td>
			</tr>	
		<tr><td colspan="2">
        <?php $uidTpl=$prod["sub_uid"];
                                  include("./code/execute/listadoOfertas.php");?>
        </td></tr>	
   </table>
		<!--TABLA DERECHA END-->
		</td>
        </tr>
 	</table>
    </td>
    </tr>

</table>
<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="77%" height="40"><span class="title">Proveedores habilitados</span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
    
   <?php 
   $sSQL= "select * from mdl_incoterm, mdl_incoterm_language, mdl_transporte, mdl_client where inc_inl_uid=inl_uid and inc_tra_uid=tra_uid and inc_cli_uid=cli_uid and inc_delete=0 and inc_sub_uid='".$sub_uid."' order by inc_uid desc";
   $nroReg = admin::getDbValue("select count(*) from mdl_incoterm, mdl_incoterm_language, mdl_transporte, mdl_client where inc_inl_uid=inl_uid and inc_tra_uid=tra_uid and inc_cli_uid=cli_uid and inc_delete=0 and inc_sub_uid='".$sub_uid."'");
   $db2->query($sSQL);
if ($nroReg>0)
	{
	?> 
   
  <tr>
    <td colspan="2" id="contentListing">
    <div class="row0">
    <table class="list" width="100%">
	<tr><td width="12%" style="color:#16652f">Proveedor</td>
    <td width="12%" style="color:#16652f">Lugar de entrega</td>
    <td width="12%" style="color:#16652f">Medio de transporte</td>
    <td width="12%" style="color:#16652f">Incoterm</td>
    <?php
    if($prod["sub_type"]!='VENTA'){
    ?>
   
    <td width="12%" style="color:#16652f">Factor de ajuste</td>
    <?php
    } ?>
	<td align="center" width="12%" height="5">&nbsp;</td>
    <td align="center" width="12%" height="5">&nbsp;</td>
	</tr>
	</table>
    </div>
<div class="itemList" id="itemList" style="width:99%">  
	<?php
$i=1;

while ($list = $db2->next_record())
	{
  
	$inc_uid = $list["inc_uid"];
	$cli_uid = $list["inc_cli_uid"];
	$cli_name = admin::getDBvalue("select cli_socialreason as nombre from mdl_client WHERE cli_uid='".$cli_uid."'");
	$inc_lugar_entrega = $list["inc_lugar_entrega"];
	$tra_uid = $list["inc_tra_uid"];
	$tra_name = admin::getDBvalue("select tra_name from mdl_transporte WHERE tra_uid='".$tra_uid."'");
	$inl_uid = $list["inc_inl_uid"];
	$inl_name = admin::getDBvalue("select inl_name from mdl_incoterm_language WHERE inl_uid='".$inl_uid."'");
	$inc_ajuste = $list["inc_ajuste"];

	if ($i%2==0) $class='row0';
	else  $class='row';
	if ($i%2==0) $class2='row';
	else  $class2='row1';
  	?> 
    <div class="groupItem" id="<?=$inc_uid?>">
  	<div id="list_<?=$inc_uid?>" class="<?=$class?>" style="width:100%" >
<table class="list" width="100%">
	<tr>
    <td width="12%"><?=$cli_name?></td>
    <td width="12%"><?=utf8_decode($inc_lugar_entrega)?></td>
    <td width="12%"><?=utf8_decode($tra_name)?></td>
    <td width="12%"><?=utf8_decode($inl_name)?></td>
    <?php
    if($prod["sub_type"]!='VENTA'){
    ?>
   
    <td width="12%"><?=round($inc_ajuste,2)?>%</td>
    <?php
    }
    ?>
	<td align="center" width="12%" height="5">
		<!--<a href="#" onclick="showTab('list_<?=$inc_uid?>');showTab('Add_<?=$inc_uid?>'); return false;">
		<img src="lib/edit_es.gif" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
		</a>-->
	</td>
	<td align="center" width="12%" height="5">
		<img src="lib/delete_off_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
			</td>
	</tr>
	</table>
	</div>
    </div>
    <div id="Add_<?=$inc_uid?>" class="<?=$class2?>" style="display:none">
    <form name="frmIncotermUpd<?=$inc_uid?>" id="frmIncotermUpd<?=$inc_uid?>" action="code/execute/IncotermUpd.php"  enctype="multipart/form-data" >
<table class="list" width="100%">
	<tr><td width="12%">
    			<input name="cli_name<?=$cli_uid?>" id="cli_name<?=$cli_uid?>" onkeyup="lookup(this.value,<?=$cli_uid?>);" type="text" size="15" value="<?=$cli_name?>" />
    			<div id='autocomplete<?=$cli_uid?>' style="display:none"></div>
                <input name="cli_uid<?=$cli_uid?>" id="cli_uid<?=$cli_uid?>" value="<?=$cli_uid?>" type="hidden" />
                <input name="sub_uid2" id="sub_uid2" value="<?=$sub_uid?>" type="hidden" /></td>
    <td width="12%"><input name="inc_lugar_entrega" id="inc_lugar_entrega" type="text"  size="15" value="<?=utf8_decode($inc_lugar_entrega)?>" /></td>
    <td width="12%">
    				<select name="inc_tra_uid<?=$tra_uid?>" id="inc_tra_uid<?=$tra_uid?>" class="input"  >
                	<?php
                    $sql3 = "select tra_uid, tra_name from mdl_transporte where tra_delete=0";
					$db3->query($sql3);
					while ($content=$db3->next_record())
					{	
					?>
					<option <? if($content["tra_name"]==$tra_name) echo 'selected="selected"';?> value="<?=$content["tra_uid"]?>"><?=utf8_decode($content["tra_name"])?></option>					
					<?php
					}
                    ?>
				</select>
                </td>
    <td width="12%">
				<select name="inc_inl_uid" id="inc_inl_uid" class="input"  >
                	<?php
                    $sql3 = "select inl_uid, inl_name from mdl_incoterm_language where inl_delete=0";
					$db3->query($sql3);
					while ($content=$db3->next_record())
					{	
					?>
					<option <? if($content["inl_name"]==$inl_name) echo 'selected="selected"';?> value="<?=$content["inl_uid"]?>"><?=$content["inl_name"]?></option>					
					<?php
					}
                    ?>
				</select>
                </td>
                <?php
    if($prod["sub_type"]!='VENTA'){
    ?>
   
    <td width="12%"><input name="inc_ajuste2" id="inc_ajuste2" type="text" size="9" value="<?=round($inc_ajuste,2)?>"/></td>
    <?php } ?>
	<td align="center" width="12%" height="5">
		<a href="#" onclick="editListDpf('<?=$inc_uid?>');return false;">
		<img src="lib/save_es.gif" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
		</a>
	</td>
	<td align="center" width="12%" height="5">
		<a href="#" onclick="showTab('list_<?=$inc_uid?>');showTab('Add_<?=$inc_uid?>'); return false;">
		<img src="lib/cancel_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
		</a>
	</td>
	</tr>
	</table>
     <input name="token" id="token" value="<?=admin::getParam("token")?>" type="hidden" />
     <input name="inc_uid" id="inc_uid" value="<?=$inc_uid?>" type="hidden" />
    </form>
     </div>
	<?php
	$i++;
	} 
 ?>
</div> 
    </td>
    </tr>
    <?php 	} 
else
	{ ?>
    <tr>
    <td colspan="2"><br /></td>
    </tr>
  <tr>
    <td colspan="2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">   
  <tr>
    <td colspan="2" id="contentListing">
<div  style="background-color: #f7f8f8;">
<table class="list"  width="100%">
	<tr><td height="30px" align="center" class="bold">
	<?=admin::labels('subastas','noIncoterm')?>
	</td></tr>	
 </table>
</div>
</td></tr></table>
</td>
</tr>
<?php 	} ?>
<?php
   $sSQL= "SELECT * FROM mdl_xitem WHERE xit_delete=0 and xit_sub_uid='".$sub_uid."' order by xit_uid asc";
   $nroReg = admin::getDbValue("SELECT count(*) FROM mdl_xitem WHERE xit_delete=0 and xit_sub_uid='".$sub_uid."'");
//echo $nroReg."ssss";  
$db2->query($sSQL);

if ($nroReg>0)
	{
	?> 
   <tr>
      <td width="77%" height="40"><span class="title"><?=admin::labels('list','dpflist')?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
    <div class="row0">
    <table class="list" width="100%">
	<tr>
    <td width="12%" style="color:#16652f">Producto</td>
    <td width="12%" style="color:#16652f">Descripci&oacute;n</td>
    <td width="12%" style="color:#16652f">Imagen</td>
    <td width="12%" style="color:#16652f">Precio base</td>
    <td width="12%" style="color:#16652f">Unidad de mejora</td>
	<td width="12%" style="color:#16652f">Proveedor</td>
	<td align="center" width="12%" height="5">&nbsp;</td>
	</tr>
	</table>
    </div>
<div class="itemList" id="itemList" style="width:99%">  
	<?php
$i=1;
while ($list = $db2->next_record())
	{
	$flduid = $list["xit_uid"];
	$fldproduct = $list["xit_product"];
	$flddescription = $list["xit_description"];
	$fldimage = $list["xit_image"];
	$fldprice = $list["xit_price"];
	$fldunidad = $list["xit_unity"];
	if ($i%2==0) $class='row0';
	else  $class='row';
	if ($i%2==0) $class2='row';
	else  $class2='row1';
  	?> 
    <div class="groupItem" id="<?=$flduid?>">
  	<div id="list_<?=$flduid?>" class="<?=$class?>" style="width:100%" >
<table class="list" width="100%">
	<tr>
    
    <td width="12%"><?=utf8_decode($fldproduct)?></td>
    <td width="12%"><?=utf8_decode($flddescription)?></td>
    <td width="12%"><img src="<?=PATH_DOMAIN."/img/subasta/thumb2_".utf8_decode($fldimage)?>"  border="0"> </td>
    <td width="12%" align="center"><?=admin::numberFormat($fldprice)?></td>
	<td width="12%" align="center"><?=$fldunidad?></td>
	<td width="12%"><?php
    $db3->query("select clx_cli_uid from mdl_clixitem where clx_delete=0 and clx_xit_uid=$flduid ");
	
	while ($user = $db3->next_record())
	{
		
		$cli_name = admin::getDBvalue("select cli_socialreason as nombre from mdl_client WHERE cli_uid=".$user["clx_cli_uid"]);
		echo $cli_name."<br>";
	}
	
	?></td>
    	<td align="center" width="12%" height="5">
		<img src="lib/delete_off_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
	</td>
	</tr>
	</table>
	</div>
    </div>
	<?php
	$i++;
	} 
 ?>
</div> 
    </td>
    </tr>
    <?php 	} 
?>
</table>
<br>
<br>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
     <td width="77%" height="40"><span class="title">Informe Compra</span></td>
     <td width="23%" height="40">&nbsp;</td>
</tr>
<tr>
    <td colspan="2" id="contentListing">
    <div class="row0">
        <?php
        $sua_uid= admin::getParam("sua_uid");
        $sql="select * from mdl_subasta_informe where sua_uid=$sua_uid";
        $db2->query($sql);
        $informe = $db2->next_record();
        ?>
    <table class="list" width="100%">
	<!--<tr>
            <td width="12%" style="color:#16652f">Elaborado por:</td>
            <td><?=$informe["sua_elaborado"]?>
            <br /><span id="div_elaborado" style="display:none; padding-left:5px; padding-right:5px;" class="error">* Campo requerido</span>
            </td>
        </tr>
        <tr>
            <td width="12%" style="color:#16652f">Aprobado por:</td>
            <td><?=$informe["sua_aprobado"]?>
            <br /><span id="div_aprobado" style="display:none; padding-left:5px; padding-right:5px;" class="error">* Campo requerido</span>
            </td>
        </tr>-->
        <tr>
            <td width="12%" style="color:#16652f">Monto total adjudicar:</td>
            <td><?=admin::numberFormat($informe["sua_monto"])?>
            <br /><span id="div_monto" style="display:none; padding-left:5px; padding-right:5px;" class="error">* Campo requerido</span>
            </td>
        </tr>
        <tr>
            <td width="12%" style="color:#16652f">Ahorro econ&oacute;mico:</td>
            <td><?=admin::numberFormat($informe["sua_ahorro"])?>
            <br /><span id="div_ahorro" style="display:none; padding-left:5px; padding-right:5px;" class="error">* Campo requerido</span>
            </td>
        </tr>
        <tr>
            <td width="12%" style="color:#16652f">Observaciones:</td>
            <td><?=$informe["sua_observaciones"]?>
            <br /><span id="div_observaciones" style="display:none; padding-left:5px; padding-right:5px;" class="error">* Campo requerido</span>
            </td>
        </tr>
    </table>
    </div>
    </td>
</tr>
<tr>
<td colspan="2">
<br />
<div id="contentButton">
	  	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="59%" align="center">
                                    <a href="informeList.php?token=<?=admin::getParam("token")?>" class="button" >Volver</a>
				</td>
                              
        </tr>
      </table>
</div>
<br /><br /><br /><br /><br />
</td></tr>
</table>
</form>