<br />
<div id="div_wait" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<form name="frmsubasta" method="post" action="code/execute/subastasAdd.php?token=<?=admin::getParam("token")?>" enctype="multipart/form-data" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="77%" height="40">
		<span class="title"><?=admin::modulesLabels()?></span>
		</td>
		<td width="23%" height="40">&nbsp;</td>
	</tr>
  	<tr>
	<td colspan="2" id="contentListing">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td width="50%" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td width="57%" valign="top" rowspan="2">
		<table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">			
			<tr>
                            <td colspan="2" class="titleBox"><?=admin::labels('data');?> B&aacute;sicos:</td>
			</tr>
                        <tr>
		<td width="29%">Nro de Solicitud:</td>
                <td width="64%"><input type="text" class="input3" value="" name="sol_uid" id="sol_uid" /><input name="tipUid" type="hidden" value="<?=$tipUid?>">
                    <br /><span id="div_sol_uid" style="display:none; padding-left:5px; padding-right:5px;" class="error">Campo requerido</span>
                </td>
                <td width="7%">&nbsp;</td>
            </tr>
            <tr>
				<td><?=admin::labels('name');?>:</td>
				<td>
				<input name="pro_name" type="text" class="input" id="pro_name" onfocus="setClassInput(this,'ON');document.getElementById('div_pro_name').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_pro_name').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_pro_name').style.display='none';" size="50" />
				<br /><span id="div_pro_name" style="display:none; padding-left:5px; padding-right:5px;" class="error">Campo requerido</span>
				</td>
			</tr>
                        <tr>
            <td width="5%" >Unidad Solicitante:</td>
             <td width="20%">
                  <span id="div_sub_unidad">
                      <select name="rav_uni_uid" id="rav_uni_uid" class="input" >
                <?php
                  $uUnidad = admin::getDbValue("select TOP 1 uni_uid from mdl_subasta_unidad where suu_sub_uid=".$prod["sub_uid"]);
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
            <td width="7%">&nbsp;</td>
            
        </tr>
                
            <tr>
				<td width="29%"><?=admin::labels('category','label');?>:</td>
				<td width="64%">
				<div id="div_doc_dca_uid_select">
				<select name="sub_pca_uid" id="sub_pca_uid" class="input" >
                	<?php
                    $sql = "select pca_uid, pca_name from mdl_pro_category where pca_delete=0 and pca_uid!=6";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{	
					?>
					<option value="<?=$content["pca_uid"]?>"><?=$content["pca_name"]?></option>					
					<?php
					}
                    ?>
				</select>
                <a href="javascript:changeOtherCategory();" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="javascript:deleteOtherCategory();" class="small3"><?=admin::labels('del');?></a>
                <div id="div_other_category" style="display:none;">
		<input type="text" name="other_category" id="other_category" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_other_category_error').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_other_category_error').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_other_category_error').style.display='none';"/>		
		<a href="javascript:cagetogyDocsAdd()" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeOtherCategory();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_other_category_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
                </div>	
				</td>
			</tr>
            
            <tr>
				<td><?=admin::labels('seo','metadescription');?> corta:</td>
				<td>
				<input name="sub_description" type="text" class="input" id="sub_description" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_description').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_description').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_description').style.display='none';" size="50" />
				<br /><span id="div_sub_description" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subastas','titleerror');?></span>
				</td>
			</tr>
            <tr>
				<td><?=admin::labels('seo','metadescription')?>:</td>
				<td>
				<textarea name="pro_description" cols="38" rows="3" class="textarea" id="pro_description"  onfocus="setClassTextarea(this,'ON');" onblur="setClassTextarea(this,'OFF');" onclick="setClassTextarea(this,'ON');" onkeydown="growTextarea(this);"></textarea>
				<br /><span id="div_pro_description" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subastas','titleerror');?></span>
				</td>
			</tr>
            <tr>
				<td><?=admin::labels('labels','quantity');?>:</td>
				<td>
				<input name="pro_quantity" type="text" class="input" id="pro_quantity" onfocus="setClassInput(this,'ON');document.getElementById('div_pro_quantity').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_pro_quantity').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_pro_quantity').style.display='none';" size="50" />
				<br /><span id="div_pro_quantity" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subastas','titleerror');?></span>
				</td>
			</tr>
             <tr>
				<td>Unidad (Ej. millones):</td>
				<td>
				<input name="pro_unidad" type="text" class="input" id="pro_unidad" onfocus="setClassInput(this,'ON');document.getElementById('div_pro_unidad').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_pro_unidad').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_pro_unidad').style.display='none';" size="50" />
				<br /><span id="div_pro_unidad" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subastas','titleerror');?></span>
				</td>
			</tr>
			
            
          <tr>
            <td valign="top"><?=admin::labels('photo');?>:</td>
            <td>			
			<input type="file" name="pro_image" id="pro_image" size="31" class="input">
			</td>
          </tr>
		 <tr>
            <td><?=admin::labels('annex','adjunt');?>: </td>
            <td><input type="file" name="pro_adjunt" id="pro_adjunt" size="31" class="input">
            </td>
          </tr>
          <tr>
            <td valign="top"><?=admin::labels('status');?></td>
            <td><select name="sub_status" class="listMenu" id="sub_status">
            	<option selected="selected" value="ACTIVE"><?=admin::labels('active');?></option>
              	<option value="INACTIVE"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_sub_status" style="display:none;" class="error"></span></td>
          </tr>
         <!-- <tr>
            <td><?=admin::labels('stress');?>:</td>
            <td><input type="checkbox" name="pro_stress" id="pro_stress" value="OK"></td>
          </tr>-->
         </table>
         
        	</td>
        <td width="43%" valign="top">
		<table width="98%" border="0" align="right" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td colspan="3" class="titleBox"><?=admin::labels('data');?> Adicionales:</td>
          </tr>
  	<tr>
				<td width="29%">Modalidad:</td>
				<td width="64%">
				<select name="sub_modalidad" id="sub_modalidad" class="input" onchange="subastaOpcion();" >
                	<option value="TIEMPO">Por tiempo</option>
                   <!-- <option value="HOLANDESA">Inversa Holandesa</option>-->
                    
                    <option value="ITEM">Por Item</option>
                    <option value="PRECIO">Por Precio</option>
				</select>
				<br /><span id="div_sub_modalidad" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>	
				</td>
			</tr>				
				
<tr>
				<td width="29%">Tipo:</td>
				<td width="64%">
				<select name="sub_type" id="sub_type" class="input" onchange="subastaOpcion();" >
                	<option value="COMPRA">Compra</option>
                    <option value="VENTA">Venta</option>										
				</select>
				<br /><span id="div_sub_type" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>	
				</td>
			</tr>

            
            <tr>
			<td>Fecha:</td>
			<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr><td width="28%" valign="middle"> 
				<input name="sub_hour_end0" type="text" class="input"  id="sub_hour_end0" value="<?=date("d/m/Y");?>" size="15" >
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
					<td><input name="sub_hour_end1" type="text" class="input" id="sub_hour_end1" onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" value="<?=date('H:i')?>" size="15"/>
					</td>
				</tr>
                
                <tr id="tr_numeroruedas" style="display:none">
				<td width="29%">N&uacute;mero de ruedas:</td>
				<td width="64%">
				<input name="sub_wheels" value="" type="text" class="input" id="sub_wheels" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_wheels').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_wheels').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_wheels').style.display='none';" size="9" />
                <br /><span id="div_sub_wheels" style="display:none; padding-left:5px; padding-right:5px;" class="error">N&uacaute;mero de ruedas requerido</span>
				</td>
			</tr>     
                             
  <tr id="tr_montobase" style="display:">
				<td>Monto Referencial:</td>
				<td>
				<input name="sub_mount_base" type="text" class="input" id="sub_mount_base" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_mount_base').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_mount_base').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_mount_base').style.display='none';" size="9" />
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
                	<option <?php if ($key==$prod["sub_moneda"]) echo 'selected="selected"';?> value="<?=$key?>"><?=$value?></option>
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
                <br /><span id="div_sub_mount_base" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subastas','titleerror');?></span>
				</td>
			</tr>              
                
            <tr id="tr_montodead" style="display:">
				<td width="29%" id="montotype">Monto M&aacute;ximo:</td>
				<td width="64%">
				<input name="sub_mountdead" type="text" class="input" id="sub_mountdead" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_mountdead').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_mountdead').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_mountdead').style.display='none';" size="9" />
                <br /><span id="div_sub_mountdead" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subastas','titleerror');?></span>
				</td>
			</tr>              
                
                
            <tr id="tr_unidadmejora" style="display:">
				<td>Unidad de mejora:</td>
				<td>
				<input name="sub_mount_unidad" type="text" class="input" id="sub_mount_unidad" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_mount_unidad').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" size="9" />
				<br /><span id="div_sub_mount_unidad" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subasta','titleerror');?></span>
				</td>
			</tr>
            
            <tr>
				<td>Tiempo l&iacute;mite (min).:</td>
				<td>
				<input name="sub_tiempo" type="text" class="input" id="sub_sub_tiempo" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_mount_unidad').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" size="9" />
				<br /><span id="div_sub_tiempo" style="display:none; padding-left:5px; padding-right:5px;" class="error"></span>
				</td>
			</tr>
                        
                        <tr>
				<td>Notificaci&oacute;n N horas antes:</td>
				<td>
				<input name="xhoras" type="text" class="input" id="xhoras" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_mount_unidad').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" size="3" />
				<br /><span id="div_xhoras" style="display:none; padding-left:5px; padding-right:5px;" class="error"></span>
				</td>
			</tr>
            
                    </table>
		</td>
		</tr>
        
    </table>
	</td>
      </tr>
    </table></td>
    </tr>
</table>
<input id="maxVal" name="maxVal" value="0" type="hidden" />
</form>
<br />
<br />
<div id="contentButton">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td width="59%" align="center">
		<a href="javascript:verifysubasta();" class="button">
		Siguiente
		</a> 
		</td>
		<td width="41%" style="font-size:11px;">
		<?=admin::labels('or');?> <a href="subastasList.php?token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		</td>
		</tr>
	</table>
</div>

<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<br />
<br />
<br />
