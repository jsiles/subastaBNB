<br />
<div id="div_wait" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<form name="frmsubasta" method="post" action="code/execute/divisasAdd.php?token=<?=admin::getParam("token")?>" enctype="multipart/form-data" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="77%" height="40">
		<span class="title">Crear divisa</span>
		</td>
		<td width="23%" height="40">&nbsp;</td>
	</tr>
   <!-- <tr><td colspan="2">
    
         <div id="contentButton">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td width="59%" align="center">
		<a href="javascript:verifysubasta();" class="button">
		Guardar
		</a> 
		</td>
		<td width="41%" style="font-size:11px;">
		<?=admin::labels('or');?> <a href="subastasList.php?token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		</td>
		</tr>
	</table>
</div>

    </td></tr>
	<tr><td colspan="2"><br /></td></tr> -->
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
			<td colspan="2" class="titleBox"><?=admin::labels('data');?> divisa:</td>
			</tr>
            <tr>
				<td><?=admin::labels('name');?>:</td>
				<td>
				<input name="pro_name" type="text" class="input" id="pro_name" onfocus="setClassInput(this,'ON');document.getElementById('div_pro_name').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_pro_name').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_pro_name').style.display='none';" size="50" />
				<br /><span id="div_pro_name" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subasta','titleerror');?></span>
				</td>
			</tr>
          <!--  <tr>
				<td width="29%"><?=admin::labels('category','label');?>:</td>
				<td width="64%">
				<div id="div_doc_dca_uid_select">
				<select name="sub_pca_uid" id="sub_pca_uid" class="input" >
                	<?php
                    $sql = "select pca_uid, pca_name from mdl_pro_category where pca_delete=0";
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
			</tr>-->
            
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
				<td width="29%">Modalidad:</td>
				<td width="64%">
				<select name="sub_modalidad" id="sub_modalidad" class="input" onchange="subastaOpcion();" >
                	<option value="MONTO">Por monto</option>
                    <option value="TC">Por tipo de cambio</option>
                 </select>
				<br /><span id="div_sub_modalidad" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>	
				</td>
			</tr>				
				
<tr>
				<td width="29%">Tipo de subasta:</td>
				<td width="64%">
				<select name="sub_type" id="sub_type" class="input" onchange="subastaOpcion();" >
                	<option value="COMPRA">Compra</option>
                    <option value="VENTA">Venta</option>										
				</select>
				<br /><span id="div_sub_type" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>	
				</td>
			</tr>

            
            <tr>
			<td>Fecha de subasta:</td>
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
					<td>Hora de subasta:</td>
					<td><input name="sub_hour_end1" type="text" class="input" id="sub_hour_end1" onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" value="<?=date('H:i')?>" size="15"/>
					</td>
				</tr>
                
                   <tr>
				<td>Monto requerido:</td>
				<td><input name="pro_quantity" type="text" class="input" id="pro_quantity" onfocus="setClassInput(this,'ON');document.getElementById('div_pro_quantity').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_pro_quantity').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_pro_quantity').style.display='none';" size="9" value="<?=$prod["pro_quantity"]?>" />
				<?php 
				$arrayMoneda = admin::dbFillArray("select cur_uid, cur_description from mdl_currency where cur_delete=0");
				?>
                <span id="div_sub_moneda1">
                <select name="sub_moneda1" id="sub_moneda1" class="input" >
                <?php
				foreach($arrayMoneda as $key=>$value)
				{                
				?>
                	<option <?php if ($key==$prod["sub_moneda1"]) echo 'selected="selected"';?> value="<?=$key?>"><?=$value?></option>
				<?php
				}
				?>
                </select>
                                &nbsp;<a href="javascript:addCurrency1();" class="small2">agregar</a> | 
                <a href="javascript:delCurrency1();" class="small3"><?=admin::labels('del');?></a></span>

                 <div id="div_add_currency1" style="display:none;">
		<input type="text" name="add_currency1" id="add_currency1" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_add_currency_error1').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_add_currency_error1').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_add_currency_error1').style.display='none';"/>		
		<a href="javascript:addCurrencyOption1()" class="button3"><?=admin::labels('add');?></a><a href="javascript:closeCurrency1();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_add_currency_error1" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
                </div>
                <br />
				</td>
			</tr>    
                
			  <tr>
				<td>Monto Referencial/Tipo de cambio:</td>
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
          
            <tr>
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
            <td valign="top"><?=admin::labels('status');?></td>
            <td><select name="sub_status" class="listMenu" id="sub_status">
            	<option value="ACTIVE"><?=admin::labels('active');?></option>
              	<option value="INACTIVE"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_sub_status" style="display:none;" class="error"></span></td>
          </tr>
          
         </table>
         
        	</td>
        <td width="43%" valign="top">
		<table width="98%" border="0" align="right" cellpadding="5" cellspacing="5" class="box" style="display:none;">
          <tr>
            <td colspan="3" class="titleBox"><?=admin::labels('data');?> subasta:</td>
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
		Guardar
		</a> 
		</td>
		<td width="41%" style="font-size:11px;">
		<?=admin::labels('or');?> <a href="subastasList.php?token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		</td>
		</tr>
	</table>
</div>
<br />
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>