<?php
$pro_uid = admin::toSql($_GET["pro_uid"],"String");
$sub_uid=admin::getParam("pro_uid");
if (!$pro_uid) header('Location: ../../subastasList.php?token='.$token);
$sql = "SELECT * FROM mdl_product, mdl_subasta, mdl_pro_category WHERE sub_uid=pro_sub_uid and pca_uid=sub_pca_uid and sub_status='ACTIVE' and pro_uid='".$pro_uid."'";
$db->query($sql);
$prod = $db->next_record();

?>
<br />
<div id="div_wait" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<form name="frmsubasta" method="post" action="code/execute/divisasUpd.php?token=<?=admin::getParam("token")?>" enctype="multipart/form-data" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="77%" height="40">
		<span class="title"><?=admin::labels('subastas','create');?></span>
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
			<td colspan="2" class="titleBox"><?=admin::labels('data');?> Producto:</td>
			</tr>
            <tr>
				<td><?=admin::labels('name');?>:</td>
				<td>
				<input name="pro_name" type="text" class="input" id="pro_name" onfocus="setClassInput(this,'ON');document.getElementById('div_pro_name').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_pro_name').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_pro_name').style.display='none';" size="50" value="<?=$prod["pro_name"]?>" />
				<br /><span id="div_pro_name" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subasta','titleerror');?></span>
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
				<td width="29%">Modalidad:</td>
				<td width="64%">
				<select name="sub_modalidad" id="sub_modalidad" class="input" onchange="subastaOpcion();">
                	<option  <? if ('MONTO'==$prod["sub_modalidad"]) echo 'selected="selected"';?> value="MONTO">Por monto</option>
                     <option <? if ('TC'==$prod["sub_modalidad"]) echo 'selected="selected"';?> value="TC">Por tipo de cambio</option>
                    </select>
				<br /><span id="div_sub_modalidad" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>	
				</td>
			</tr>         
                
                
                <tr>
				<td width="29%">Tipo de subasta:</td>
				<td width="64%">
				<select name="sub_type" id="sub_type" class="input" onchange="subastaOpcion();" >
                	<option <? if ('COMPRA'==$prod["sub_type"]) echo 'selected="selected"';?> value="COMPRA">Compra</option>
                    <option <? if ('VENTA'==$prod["sub_type"]) echo 'selected="selected"';?> value="VENTA">Venta</option>										
				</select>
				<br /><span id="div_sub_type" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>	
				</td>
			</tr>
            
       
<tr>
			<td>Fecha de subasta:</td>
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
					<td>Hora de subasta:</td>
					<td><input name="sub_hour_end1" type="text" class="input" id="sub_hour_end1" value="<?=$hour_end1?>" size="9"/>
					</td>
				</tr>  
               
              <tr>
				<td>Monto requerido:</td>
				<td>
                <input name="pro_quantity" type="text" class="input" id="pro_quantity" onfocus="setClassInput(this,'ON');document.getElementById('div_pro_quantity').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_pro_quantity').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_pro_quantity').style.display='none';" size="9" value="<?=$prod["pro_quantity"]?>" />
				<?php 
				$arrayMoneda = admin::dbFillArray("select cur_uid, cur_description from mdl_currency where cur_delete=0");
				?>
                <span id="div_sub_moneda1">
                <select name="sub_moneda1" id="sub_moneda1" class="input" >
                <?php
				foreach($arrayMoneda as $key=>$value)
				{                
				?>
                	<option <? if ($key==$prod["sub_moneda1"]) echo 'selected="selected"';?> value="<?=$key?>"><?=$value?></option>
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
				<td>Monto Referencial/ Tipo de cambio:</td>
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
                </div>
                
				<br /><span id="div_sub_mount_base" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subastas','titleerror');?></span>
				</td>
			</tr>
            
            
            
            <tr>
              <td>Unidad de mejora:</td>
              <td>
                <input name="sub_mount_unidad" type="text" class="input" id="sub_mount_unidad" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_mount_unidad').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" size="9" value="<?=$prod["sub_mount_unidad"]?>" />
                <br /><span id="div_sub_mount_unidad" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subasta','titleerror');?></span>
                </td>
            </tr>
            
			<tr>
				<td>Tiempo l&iacute;mite de mejora en min.:</td>
				<td>
				<input name="sub_tiempo" type="text" class="input" id="sub_sub_tiempo" onfocus="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_sub_mount_unidad').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_sub_mount_unidad').style.display='none';" size="9" value="<?=$prod["sub_tiempo"]?>"/>
				<br /><span id="div_sub_tiempo" style="display:none; padding-left:5px; padding-right:5px;" class="error"></span>
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
<?php
$countBids=admin::getDBvalue("SELECT count(*) FROM mdl_bid where bid_sub_uid='".$prod["sub_uid"]."' and bid_cli_uid!=0");
if($countBids>0) $style=""; else $style="none"		 
		 
?>
		<table width="98%" border="0" align="right" cellpadding="5" cellspacing="5" class="box" style="display:<?=$style?>">
        <tr><td colspan="2">
         <?php
		 if ($countBids>0){
		 ?>
         <table width="100%" border="0">
         <tr>
            <td colspan="2" class="titleBox">Listado de pujas:</td>
            <td><a href="excel" onclick="document.location.href='ficheroExcel.php?subasta=<?=$prod["sub_uid"]?>'; return false;" class="xls">
				<img border="0" src="lib/ext/excel.png" alt="Excel" title="Excel" />
					</a></td>
          </tr>
                
            <tr>
				<td width="40%" class="txt11 color2">Nombre de usuario:</td>
				<td width="30%" class="txt11 color2">Fecha y hora:</td>
                <td width="30%" class="txt11 color2">Monto:</td>
			</tr>         
               
                 <?php
				$sql2 = "SELECT * FROM mdl_bid where bid_sub_uid='".$prod["sub_uid"]."' and bid_cli_uid!=0";
				$db2->query($sql2);
				while ($content=$db2->next_record())
				{
				 $clientName=admin::getDBvalue("SELECT cli_socialreason FROM mdl_client where cli_uid='".$content["bid_cli_uid"]."'");
				 ?><tr>
				<td width="40%"><?=$clientName?></td>
				<td width="30%"><?=$content["bid_date"]?></td>
                <td width="30%"><?=$content["bid_mount"]?></td></tr>
             	<?php
				 }
				 ?>    
        </table>
         <?php
		 }
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

<div id="contentButton">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td width="59%" align="center">
		<a href="javascript:verifysubasta();" class="button">
		<?=admin::labels('save');?>
		</a> 
		</td>
		<td width="41%" style="font-size:11px;">
		<?=admin::labels('or');?> <a href="subastasList.php?token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		</td>
		</tr>
     </table>
</div>
</td></tr>
</table>
</form>
<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="77%" height="40"><span class="title">Usuarios habilitados</span></td>
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
    <td width="12%" style="color:#16652f">Factor de ajuste</td>
	<td align="center" width="12%" height="5">&nbsp;</td>
    
	</tr>
	</table>
    </div>
    <div id="add<?=$ind_uid?>" class="row0">
    <form name="frmIncoterm" action="code/execute/incotermAdd1.php" enctype="multipart/form-data" > 
	<table class="list" width="100%">
	<tr><td width="12%"><input name="cli_name" id="cli_name" onkeyup="lookup(this.value);" type="text" size="15"  onfocus="document.getElementById('div_cli_name_error').style.display='none';" onblur="document.getElementById('div_cli_name_error').style.display='none';" onclick="document.getElementById('div_cli_name_error').style.display='none';" autocomplete='off' />
					   	
    					<br /><span id="div_cli_name_error" style="display:none;" class="error">Seleccione un nombre del listado.</span>
                        <input name="cli_uid" id="cli_uid" value="" type="hidden" />
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
		<a href="" onclick="transporteAdd();return false;" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeOtherTransporte();" class="link2">Cerrar</a>		</div>
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
    <td width="12%"><input name="inc_ajuste" id="inc_ajuste" type="text" size="9" onfocus="document.getElementById('div_inc_ajuste_error').style.display='none';" onblur="document.getElementById('div_inc_ajuste_error').style.display='none';" onclick="document.getElementById('div_inc_ajuste_error').style.display='none';" />
    %<br /><span id="div_inc_ajuste_error" style="display:none;" class="error">Escriba un monto.</span></td>
	<td align="center" width="12%" height="5">
		<a href="guardar" onclick="verifyIncoterm(); return false;">
		<img src="lib/save_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
		</a>
	</td>
	</tr>
    <tr><td><div id='autocomplete' style="display:none"></div> </td></tr>
	</table>
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
    <td width="12%" style="color:#16652f">Factor de ajuste</td>
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
    <td width="12%"><?=round($inc_ajuste,2)?>%</td>
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
    <div id="Add_<?=$inc_uid?>" class="<?=$class2?>" style="display:none">
    <form name="frmIncotermUpd<?=$inc_uid?>" id="frmIncotermUpd<?=$inc_uid?>" action="code/execute/IncotermUpd1.php"  enctype="multipart/form-data" >
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
    <td width="12%"><input name="inc_ajuste2" id="inc_ajuste2" type="text" size="9" value="<?=round($inc_ajuste,2)?>"/></td>
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
<tr>
<td colspan="2">
<br />
<div id="contentButton">
	  	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="59%" align="center">
				<a href="subastasList.php?token=<?=admin::getParam("token")?>" class="button" >Volver</a>
				</td>
          
        </tr>
      </table></div>
<br /><br /><br /><br /><br />
</td></tr>
</table>
 
      
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
