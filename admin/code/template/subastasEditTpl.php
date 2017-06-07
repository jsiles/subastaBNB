<?php
//$pro_uid = admin::toSql($_GET["pro_uid"],"String");
$sub_uid=admin::getParam("sub_uid");
if (!$sub_uid) header('Location: ../../subastasList.php?token='.$token);
$sql = "SELECT * FROM mdl_product, mdl_subasta, mdl_pro_category WHERE sub_uid=pro_sub_uid and pca_uid=sub_pca_uid and sub_uid='".$sub_uid."'";
$db->query($sql);
$prod = $db->next_record();

?>
<br />
<div id="div_wait" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<form name="frmsubasta" method="post" action="code/execute/subastasUpd.php?token=<?=admin::getParam("token")?>" enctype="multipart/form-data" >
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
                <td width="64%"><input type="text" class="input3" value="<?=$prod["sub_sol_uid"]?>" name="sol_uid" id="sol_uid" />
                    <br /><span id="div_sol_uid" style="display:none; padding-left:5px; padding-right:5px;" class="error">Campo requerido</span>
                </td>
                
            </tr>
            <tr>
				<td><?=admin::labels('name');?>:</td>
				<td>
				<input name="pro_name" type="text" class="input" id="pro_name" onfocus="setClassInput(this,'ON');document.getElementById('div_pro_name').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_pro_name').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_pro_name').style.display='none';" size="50" value="<?=$prod["pro_name"]?>" />
				<br /><span id="div_pro_name" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subasta','titleerror');?></span>
				</td>
			</tr>
                        <tr>
            <td width="5%" >Unidad Solicitante:</td>
             <td width="20%">
                  <span id="div_sub_unidad">
                <select name="rav_uni_uid" id="rav_uni_uid" class="input" >
                <?php
                  $uUnidad = admin::getDbValue("select TOP 1 suu_uni_uid from mdl_subasta_unidad where suu_sub_uid=".$prod["sub_uid"]);
                  $arrayUnidad = admin::dbFillArray("select uni_uid, uni_description from mdl_unidad where uni_delete=0 order by uni_uid");
                  if(is_array($arrayUnidad)){
                      $unidades=true;
                  foreach($arrayUnidad as $key=>$value)
                   {            
                        ?>
                      <option <?php if ($key==$uUnidad) echo 'selected="selected"';?> value="<?=$key?>"><?=$value?></option>				
                        <?php
                   }
                  } 
                  ?>
                      </select>
                  </span>
               <!--          
                <a href="javascript:addUnidad();" class="small2">agregar</a> | 
                <a href="javascript:delUnidad();" class="small3"><?=admin::labels('del');?></a>

                 <div id="div_add_unidad" style="display:none;">
		<input type="text" name="add_unidad" id="add_unidad" class="input3" 
                       onfocus="setClassInput3(this,'ON');document.getElementById('div_add_unidad_error').style.display='none';" 
                       onblur="setClassInput3(this,'OFF');document.getElementById('div_add_unidad_error').style.display='none';" 
                       onclick="setClassInput3(this,'ON');document.getElementById('div_add_unidad_error').style.display='none';"/>		
		<a href="javascript:addUnidadOption()" class="button3"><?=admin::labels('add');?></a><a href="javascript:closeUnidad();" class="link2">Cerrar</a>		
                 </div>-->
	     <br /><span id="div_add_unidad_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
                <br />
            </td>
           
        </tr>
            <tr>
				<td width="29%"><?=admin::labels('category','label');?>:</td>
				<td width="64%"><div id="div_doc_dca_uid_select">
				<select name="sub_pca_uid" id="sub_pca_uid" class="input" >
                	<?php
                    $sql2 = "select pca_uid, pca_name from mdl_pro_category where pca_delete=0 and pca_uid!=6";
					$db2->query($sql2);
					while ($content=$db2->next_record())
					{	
					?>
					<option <? if($content["pca_uid"]==$prod["sub_pca_uid"]) echo 'selected="selected"'; ?> value="<?=$content["pca_uid"]?>"><?=$content["pca_name"]?></option>					
					<?php
					}
                    ?>
				</select>
                <a href="javascript:changeOtherCategory();" class="small2">agregar</a> | 
                <a href="javascript:deleteOtherCategory();" class="small3"><?=admin::labels('del');?></a>
                <div id="div_other_category" style="display:none;">
		<input type="text" name="other_category" id="other_category" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_other_category_error').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_other_category_error').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_other_category_error').style.display='none';"/>		
		<a href="javascript:cagetogyDocsAdd()" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeOtherCategory();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_other_category_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
                </div>
                <br /><span id="div_sub_pca_uid" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>	
				</td>
			</tr>
            
            <tr>
				<td><?=admin::labels('seo','metadescription');?> corta:</td>
				<td>
				<input name="sub_description" type="text" class="input" id="sub_description" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_description').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_description').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_description').style.display='none';" size="50" value="<?=$prod["sub_description"]?>"  />
				<br /><span id="div_sub_description" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subastas','titleerror');?></span>
				</td>
			</tr>
            <tr>
				<td><?=admin::labels('seo','metadescription')?>:</td>
				<td>
				<textarea name="pro_description" cols="38" rows="3" class="textarea" id="pro_description"  onfocus="setClassTextarea(this,'ON');" onblur="setClassTextarea(this,'OFF');" onclick="setClassTextarea(this,'ON');" onkeydown="growTextarea(this);"><?=$prod["pro_description"]?></textarea>
				<br /><span id="div_pro_description" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subastas','titleerror');?></span>
				</td>
			</tr>
            <tr>
				<td><?=admin::labels('labels','quantity');?>:</td>
				<td>
				<input name="pro_quantity" type="text" class="input" id="pro_quantity" onfocus="setClassInput(this,'ON');document.getElementById('div_pro_quantity').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_pro_quantity').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_pro_quantity').style.display='none';" size="50" value="<?=$prod["pro_quantity"]?>" />
				<br /><span id="div_pro_quantity" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subastas','titleerror');?></span>
				</td>
			</tr>
             <tr>
				<td>Unidad (Ej. millones):</td>
				<td>
				<input name="pro_unidad" type="text" class="input" id="pro_unidad" onfocus="setClassInput(this,'ON');document.getElementById('div_pro_unidad').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_pro_unidad').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_pro_unidad').style.display='none';" size="50" value="<?=$prod["pro_unidad"]?>" />
				<br /><span id="div_pro_unidad" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subastas','titleerror');?></span>
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
                                  
                                 <?php
                        if($tipUid==1){                            
                            ?>
				<a href="javascript:viewInputFile('on')" title="<?=admin::labels('change');?>" class="small2"><?=admin::labels('change');?></a>
				<span class="pipe">|</span> <a href="#" onclick="removeImg(<?=$prod["pro_uid"]?>);return false;" title="<?=admin::labels('del')?>" class="small3"><?=admin::labels('del')?></a>				
                                  
                                 <?php
                        }
                            ?>
                                </td>
			</tr>
			<tr>
				<td height="24">
                                      
                                 <?php
                        if($tipUid==1){                            
                            ?>
				<div id="imageChange1" style="display:none">
			<input type="file" name="pro_image" id="pro_image" size="14" style="font-size:11px;"  >  <a href="javascript:viewInputFile('off')" onclick="document.getElementById('pro_image').value='';document.getElementById('button_next').innerHTML='<?=admin::labels('public');?>';"><img border="0" src="lib/close.gif" align="top"/></a>
			
			<span id="div_pro_image" class="error" style="display:none">Solo archivos jpg bmp gif png</span></div>
                                
                                 <?php
                        }
                            ?>  
                                </td>
			</tr>
			</table>
			</div>
			<div id="image_add_<?=$prod["pro_uid"]?>" style="display:none;"></div>
			<?php	}
			else
				{ ?>
				<input type="file" name="pro_image" id="pro_image" size="32" class="input">
				<span id="div_pro_uid" class="error" style="display:none">Solo archivos jpg bmp gif png </span>	
			<?php	} ?>			</td>
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
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="12%" rowspan="2" align="center" valign="top">
				<? if ($imgextension!="") { ?>
					<a href="<?=$imgSaveddomain2?>" target="_blank"><img border="0" src="<?=$imgextension?>" width="16" height="16"/></a>
				<? } ?>				</td>
				<td width="88%" style="font-size:11px;">
				<span class="nameFile"><?=substr($prod["pro_document"],0,20);?>...</span>
			<br />
                        <?php
                        if($tipUid==1){                            
                            ?>
			<a href="javascript:changeInputFile('on')" class="small2">
			<?=admin::labels('change');?>
				</a> 
                        <span class="pipe">|</span> <a href="#" onclick="removeDoc(<?=$prod["pro_uid"]?>);return false;" title="<?=admin::labels('del')?>" class="small3"><?=admin::labels('del')?></a>				
                               <?php
                        }
                               ?>
                                </td>
			</tr>
			<tr>
                            <td width="88%">
                                  
                                 <?php
                        if($tipUid==1){                            
                            ?>
                                <div id="div_adjunt_file_change" style="display:none;">
				<input type="file" name="pro_document" id="pro_document" size="13" style="font-size:11px;" >
                              
                                <a href="javascript:changeInputFile('off')" onclick="document.getElementById('pro_document').value='';">
                                    <img border="0" src="lib/close.gif" align="top"/></a>
                                </div>
                                <span id="div_adjunt_file" class="error" style="display:none">Solo archivos jpg bmp gif png doc pdf xls</span>
                        <?php } ?>
                                
                            </td>
			</tr>
			</table>
			</div>
			<div id="document_add_<?=$news["new_uid"]?>" style="display:none;"></div>
			<?php 
                        } 
			else
				{ ?>
				<input type="file" name="pro_document" id="pro_document" size="31" class="input">
			<?php
                        } ?>
			</td>
          </tr>
          <tr>
            <td valign="top"><?=admin::labels('status');?></td>
            <td><select name="sub_status" class="listMenu" id="sub_status">
            	<option <?php if ('ACTIVE'==$prod["sub_status"]) echo 'selected="selected"';?> value="ACTIVE"><?=admin::labels('active');?></option>
              	<option  <?php if ('INACTIVE'==$prod["sub_status"]) echo 'selected="selected"';?> value="INACTIVE"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_sub_status" style="display:none;" class="error"></span></td>
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
				<td width="29%">Modalidad de subasta:</td>
				<td width="64%">
				<select name="sub_modalidad" id="sub_modalidad" class="input" onchange="subastaOpcion();">
                	<option  <?php if ('TIEMPO'==$prod["sub_modalidad"]) echo 'selected="selected"';?> value="TIEMPO">Por tiempo</option>
                     <option <?php if ('ITEM'==$prod["sub_modalidad"]) echo 'selected="selected"';?> value="ITEM">Por Item</option>
                    <option <?php if ('PRECIO'==$prod["sub_modalidad"]) echo 'selected="selected"';?> value="PRECIO">Por Precio</option>
                    </select>
				<br /><span id="div_sub_modalidad" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>	
				</td>
			</tr>         
                
                
                <tr>
				<td width="29%">Tipo de subasta:</td>
				<td width="64%">
				<select name="sub_type" id="sub_type" class="input" onchange="subastaOpcion();" >
                	<option <?php if ('COMPRA'==$prod["sub_type"]) echo 'selected="selected"';?> value="COMPRA">Compra</option>
                    <option <?php if ('VENTA'==$prod["sub_type"]) echo 'selected="selected"';?> value="VENTA">Venta</option>										
				</select>
				<br /><span id="div_sub_type" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>	
				</td>
			</tr>
            
       
<tr>
			<td>Fecha del Proceso:</td>
			<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr><td width="28%" valign="middle"> 
                <?php
                $date_end1=admin::changeFormatDate(substr($prod["sub_hour_end"],0,10),2);
				$hour_end1=substr($prod["sub_hour_end"],11,5);
				?>
				<input name="sub_hour_end0" type="text" class="input"  id="sub_hour_end0" value="<?=$date_end1?>" size="15" readonly="">
				</td><td width="72%" valign="middle">
				<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmsubasta.sub_hour_end0);return false;" >
				<img border="0" src="calendario/icon_calendar.gif">				</a>
				</td>
				</tr>
				</table>			
				</td>
				</tr>          
                	<tr>
					<td>Hora:</td>
					<td><input name="sub_hour_end1" type="text" class="input" id="sub_hour_end1" value="<?=$hour_end1?>" size="9"/>
					</td>
				</tr>  
                <?php
                //echo "@@".$prod["sub_wheels"]."##".$prod["sub_modalidad"];
                        if($prod["sub_modalidad"]!="PRECIO")
                        {
                        ?>
                                
                <tr id="tr_numeroruedas" style="display:">
				<td width="29%">N&uacute;mero de ruedas:</td>
				<td width="64%">
				<input name="sub_wheels" type="text" class="input" id="sub_wheels" 
                                       onfocus="setClassInput(this,'ON');document.getElementById('div_sub_wheels').style.display='none';" 
                                       onblur="setClassInput(this,'OFF');document.getElementById('div_sub_wheels').style.display='none';" 
                                       onclick="setClassInput(this,'ON');document.getElementById('div_sub_wheels').style.display='none';" 
                                       size="9" value="<?=$prod["sub_wheels"]?>"/>
                                <br /><span id="div_sub_wheels" style="display:none; padding-left:5px; padding-right:5px;" class="error">N&uacute;mero de ruedas requerido</span>
				</td>
			</tr>
                        <?php } ?>
                
              <tr id="tr_montobase" style="display:">
				<td>Monto Referencial:</td>
				<td>
				<input name="sub_mount_base" type="text" class="input" id="sub_mount_base" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_mount_base').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_mount_base').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_mount_base').style.display='none';" size="9" value="<?=$prod["sub_mount_base"]?>" />
                <?php 
				
				$arrayMoneda = admin::dbFillArray("select cur_uid, cur_description from mdl_currency where cur_delete=0");
				
				//print_r($arrayMoneda); 
				
				?>
                <span id="div_sub_moneda">
                <select name="sub_moneda" id="sub_moneda" class="input" >
                <?php
				foreach($arrayMoneda as $key=>$value)
				{                
				?>
                	<option <? if ($key==$prod["sub_moneda"]) echo 'selected="selected"';?> value="<?=$key?>"><?=$value?></option>
				<?php
				}
				?>
                </select>
                                &nbsp;<a href="javascript:addCurrency();" class="small2">agregar</a> | 
                <a href="javascript:delCurrency();" class="small3"><?=admin::labels('del');?></a></span>

                 <div id="div_add_currency" style="display:none;">
		<input type="text" name="add_currency" id="add_currency" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_add_currency_error').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_add_currency_error').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_add_currency_error').style.display='none';"/>		
		<a href="javascript:addCurrencyOption()" class="button3"><?=admin::labels('add');?></a><a href="javascript:closeCurrency();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_add_currency_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
                </div>
                
				<br /><span id="div_sub_mount_base" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subastas','titleerror');?></span>
				</td>
			</tr>
            
            <tr id="tr_montodead" style="display:">
				<td width="29%" id="montotype">Monto M&aacute;ximo:</td>
				<td width="64%">
				<input name="sub_mountdead" type="text" class="input" id="sub_mountdead" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_mountdead').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_mountdead').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_mountdead').style.display='none';" size="9" value="<?=$prod["sub_mountdead"]?>"/>
                <br /><span id="div_sub_mountdead" style="display:none; padding-left:5px; padding-right:5px;" class="error"></span>
				</td>
			</tr>
                        <?php
                        if($prod["sub_modalidad"]!="PRECIO")
                        {
                        ?>
            
            <tr id="tr_unidadmejora" style="display:">
				<td>Unidad de mejora:</td>
				<td>
				<input name="sub_mount_unidad" type="text" class="input" id="sub_mount_unidad" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_mount_unidad').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" size="9" value="<?=$prod["sub_mount_unidad"]?>" />
				<br /><span id="div_sub_mount_unidad" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subasta','titleerror');?></span>
				</td>
			</tr>
                        <?php } ?>
			<tr>
				<td>Tiempo l&iacute;mite de mejora en min.:</td>
				<td>
				<input name="sub_tiempo" type="text" class="input" id="sub_sub_tiempo" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_mount_unidad').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" size="9" value="<?=$prod["sub_tiempo"]?>"/>
				<br /><span id="div_sub_tiempo" style="display:none; padding-left:5px; padding-right:5px;" class="error"></span>
				</td>
			</tr>
                        <?php
                        $xhoras =  admin::getDbValue("select nop_tiempo from mdl_notificacion_previa where nop_sub_uid=".$prod["sub_uid"]);
                        ?>
                        <tr>
				<td>Notificaci&oacute;n N horas antes:</td>
				<td>
				<input name="xhoras" type="text" class="input" id="xhoras" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_mount_unidad').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" size="3"  value="<?=$xhoras?>"/>
				<br /><span id="div_xhoras" style="display:none; padding-left:5px; padding-right:5px;" class="error"></span>
				</td>
			</tr>

		<tr><td colspan="2">
                                  <?php $uidTpl=$prod["sub_uid"];
                                  include("./code/execute/listadoOfertas.php");
                                  include("./code/execute/cuadroResumen.php");
                                  ?>
        </td></tr>	
   </table>
		<!--TABLA DERECHA END-->
		</td>
        </tr>
 	</table>
    </td>
    </tr>
<tr><td colspan="2">  
<br />
<input id="maxVal" name="maxVal" value="0" type="hidden" />
<input id="pro_uid" name="pro_uid" value="<?=$prod["pro_uid"]?>" type="hidden" />
<input id="sub_uid" name="sub_uid" value="<?=$prod["sub_uid"]?>" type="hidden" />
<input id="tipUid" name="tipUid" value="<?=$tipUid?>" type="hidden" />

</td></tr>
</table>
</form>
<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="77%" height="40"><span class="title">Proveedores habilitados</span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="2" id="contentListing0">
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
    <?php } ?>
	<td align="center" width="12%" height="5">&nbsp;</td>
    
	</tr>
	</table>
    </div>
    <div id="add<?=$ind_uid?>" class="row0">
    <form name="frmIncoterm" action="code/execute/incotermAdd.php" enctype="multipart/form-data" > 
	<table class="list" width="100%">
	<tr><td width="12%"><!--<input name="cli_name" id="cli_name" onkeyup="lookup(this.value);" type="text" size="15"  onfocus="document.getElementById('div_cli_name_error').style.display='none';" onblur="document.getElementById('div_cli_name_error').style.display='none';" onclick="document.getElementById('div_cli_name_error').style.display='none';" autocomplete='off' />
					   	
    					<br /><span id="div_cli_name_error" style="display:none;" class="error">Seleccione un nombre del listado.</span>
                        <input name="cli_uid" id="cli_uid" value="" type="hidden" />-->
	<!--  <select name="cli_uid" id="cli_uid" class="input"  >
	    <?php
                    $sql = "select cli_uid, cli_socialreason as cli_name from mdl_client where cli_delete=0 order by cli_name";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{	
					?>
	    <option value="<?=$content["cli_uid"]?>">
	      <?=$content["cli_name"]?>
	      </option>
	    <?php
					}
                    ?>
	    </select>-->
                    <div id="inputProveedor"></div>
                <br><br>
                <div id="busqueda">
                    
                    <input name="buscar" type="text" class="input3 proveedor" value="" size="20" /> <br /><label style="color:#ff8a36">Buscar por Nit o Razon Social</label>
                <br><br>
                </div>
 
 <input name="sub_uid" id="sub_uid" value="<?=$sub_uid?>" type="hidden" /></td>
    <td width="12%"><input name="inc_lugar_entrega" id="inc_lugar_entrega" type="text"  size="15" autocomplete='off'/></td>
    <td width="12%">
    <div id="div_inc_tra_uid_select">
				<select name="inc_tra_uid" id="inc_tra_uid" class="input"  >
                	<?php
                    $sql = "select tra_uid, tra_name from mdl_transporte where tra_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{	
					?>
					<option value="<?=$content["tra_uid"]?>"><?=$content["tra_name"]?></option>					
					<?php
					}
                    ?>
				</select>
                <a href="nuevo" onclick="changeOtherTransporte();return false;" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="borrar" onclick="deleteOtherTransporte();return false;" class="small3"><?=admin::labels('del');?></a>
                <div id="div_other_transporte" style="display:none;">
		<input type="text" name="other_transporte" id="other_transporte" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_other_transporte_error').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_other_transporte_error').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_other_transporte_error').style.display='none';"/>		
		<a href="" onclick="transporteAdd();return false;" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeOtherTransporte();" class="link2">Cerrar</a>		
                </div>
				<br /><span id="div_other_transporte_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
                </div>
                
                </td>
    <td width="12%"><div id="div_inc_inl_uid_select">
				<select name="inc_inl_uid" id="inc_inl_uid" class="input"  >
                	<?php
                    $sql = "select inl_uid, inl_name from mdl_incoterm_language where inl_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{	
					?>
					<option value="<?=$content["inl_uid"]?>"><?=$content["inl_name"]?></option>					
					<?php
					}
                    ?>
				</select>
                <a href="nuevo" onclick="changeOtherIncoterm();return false;" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="borrar" onclick="deleteOtherIncoterm();return false;" class="small3"><?=admin::labels('del');?></a>
                <div id="div_other_incoterm" style="display:none;">
		<input type="text" name="other_incoterm" id="other_incoterm" class="input3" />		
		<a href="" onclick="incotermAdd();return false;" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeOtherincoterm();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_other_incoterm_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
                </div>
                </td>
                    <?php
    if($prod["sub_type"]!='VENTA'){
    ?>
                <td width="12%"><input name="inc_ajuste" id="inc_ajuste" type="text" size="9" onfocus="document.getElementById('div_inc_ajuste_error').style.display='none';" onblur="document.getElementById('div_inc_ajuste_error').style.display='none';" onclick="document.getElementById('div_inc_ajuste_error').style.display='none';" value="0" />
    %<br /><span id="div_inc_ajuste_error" style="display:none;" class="error">Escriba un monto.</span></td>
    <?php }
                ?>
	<td align="center" width="12%" height="5">
		<a href="#" onclick="document.frmIncoterm.submit();">
		<img src="lib/save_es.gif" border="0" title="<?=admin::labels('save')?>" alt="<?=admin::labels('save')?>">
		</a>
	</td>
	</tr>
    <tr><td><div id='autocomplete' style="display:none"></div> </td></tr>
	</table>
        <input id="tipUid" name="tipUid" value="<?=$tipUid?>" type="hidden" />
    <input name="token" id="token" value="<?=admin::getParam("token")?>" type="hidden" />
	</form>
    </div>
    
    </td>
    </tr>
   <?php 
   $sSQL= "select * from mdl_incoterm, mdl_incoterm_language, mdl_transporte, mdl_client where inc_inl_uid=inl_uid and inc_tra_uid=tra_uid and inc_cli_uid=cli_uid and inc_delete=0 and inc_sub_uid='".$sub_uid."' order by inc_uid desc";
   $nroReg = $db2->numrows($sSQL);
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
	<tr><td width="12%" style="color:#16652f">Proveedor</td>
    <td width="12%" style="color:#16652f">Lugar de entrega</td>
    <td width="12%" style="color:#16652f">Medio de transporte</td>
    <td width="12%" style="color:#16652f">Incoterm</td>
    <?php
    if($prod["sub_type"]!='VENTA'){
    ?>
   
    <td width="12%" style="color:#16652f">Factor de ajuste</td>
    <?php } ?>
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
    <?php } ?>
	<td align="center" width="12%" height="5">
		<!--<a href="#" onclick="showTab('list_<?=$inc_uid?>');showTab('Add_<?=$inc_uid?>'); return false;">
		<img src="lib/edit_es.gif" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
		</a>-->
	</td>
	<td align="center" width="12%" height="5">
		<a href="#" onclick="removeList(<?=$inc_uid?>);return false;">
		<img src="lib/delete_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
		</a>
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
    <?php
    } 
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
<tr>
<td colspan="2">
    
     <?php
     //echo $prod["sub_modalidad"]."##";
    if($prod["sub_modalidad"]=="TIEMPO"){
        $displayTiempo="";
        $displayItem="none";
    }else{
        $displayTiempo="none";
        $displayItem="";
    }
    ?>
<br />
<?php
  if($prod["sub_modalidad"]!="TIEMPO"){
  
?>
<div id="contentButton">
	  	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="tbl_subastaxitem" >
			<tr>
				<td width="59%" align="center">
				<!--<a href="subastasEdit2.php?token=<?=admin::getParam("token")?>&pro_uid=<?=admin::getParam("pro_uid")?>&sub_uid=<?=admin::getParam("sub_uid")?>" class="button" >Paso 1 de 2</a></td>-->
                                    <a href="save" onclick="document.frmsubasta.submit();return false;" class="button" >Paso 1 de 2</a></td>
		<td width="41%" style="font-size:11px;">
		<?=admin::labels('or');?> <a href="subastasList.php?token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		</td>
          
        </tr>
      </table>
<?php
  }else{
?>      </div>      

<div id="contentButton">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="tbl_subasta" style="">
	<tr>
            <td width="59%" align="center">
            <a href="javascript:verifysubasta();" class="button">
                                                    <?=admin::labels('save');?>
                                                    </a> 
                                                    </td>
                                                    <td width="41%" style="font-size:11px;">
                                                    <?=admin::labels('or');?> <a href="subastasList.php?token=<?=admin::getParam("token")?>&tipUid=<?=$tipUid?>" ><?=admin::labels('cancel');?></a> 
                                                    </td>
        </tr>
     </table>
</div>      
<?php
  }
?>
<br /><br /><br /><br /><br />
</td></tr>
</table>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>