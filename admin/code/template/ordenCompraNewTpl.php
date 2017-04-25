<?php
define(SYS_LANG,$lang);
if ($lang=='es') $urlFrontLang='';
else $urlFrontLang=$lang.'/';
$usuario =  admin::getDbValue("select concat(usr_firstname,' ',usr_lastname) from sys_users where usr_uid=".admin::getSession("usr_uid"));
?>
<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<br>
<form name="addOC" method="post" action="code/execute/ordenCompraAdd.php?token=<?=admin::getParam("token")?>" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="5" class="box">
         <tr>
            <td colspan="3" class="titleBox">Datos Orden Compra</td>
            <td><input name="tipUid" type="hidden" value="<?=$tipUid?>" class="input"></td>
         </tr>
          
	<tr>
            <td width="5%" >Nro de Solicitud:</td>
             <td width="20%"><input name="orc_sol_uid" id="orc_sol_uid" value="" class="input">
             <br /><span id="div_orc_sol_uid" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
             </td>
            <td width="7%">&nbsp;</td>
            
        </tr>
        <tr>
            <td width="5%" >Nro Orden de Compra:</td>    
            <td width="20%" ><input name="orc_nro_oc" id="orc_nro_oc" value="" class="input">
            <br /><span id="div_orc_nro_oc" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
            </td>
            <td width="7%">&nbsp;</td>
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
                         
               <!-- <a href="javascript:addUnidad();" class="small2">agregar</a> | 
                <a href="javascript:delUnidad();" class="small3"><?=admin::labels('del');?></a>

                 <div id="div_add_unidad" style="display:none;">
		<input type="text" name="add_unidad" id="add_unidad" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_add_unidad_error').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_add_unidad_error').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_add_unidad_error').style.display='none';"/>		
		<a href="javascript:addUnidadOption()" class="button3"><?=admin::labels('add');?></a><a href="javascript:closeUnidad();" class="link2">Cerrar</a>		
                 </div>-->
	     <br /><span id="div_add_unidad_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
                <br />
            </td>
            <td width="7%">&nbsp;</td>
            
        </tr>
        <tr>
            <td width="5%" >Monto:</td>
            <td width="40%" ><input name="orc_monto" id="orc_monto" type="text" value="" class="input">
                 <?php 
				$arrayMoneda = admin::dbFillArray("select cur_uid, cur_description from mdl_currency where cur_delete=0");
				
				?>
                <span id="div_sub_moneda">
                <select name="sub_moneda" id="sub_moneda" class="input" >
                <?php
				foreach($arrayMoneda as $key=>$value)
				{                
				?>
                	<option <?php if ($key==$orc["orc_moneda"]) echo 'selected="selected"';?> value="<?=$key?>"><?=$value?></option>
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
                
             <br /><span id="div_orc_monto" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
            </td>
            <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td width="5%" >Fecha:</td>
            <td width="20%" valign="top">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr><td width="28%" valign="middle"> 
				<input name="orc_fecha" type="text" class="input"  id="orc_fecha" value="<?=date("d/m/Y");?>" size="15" >
				</td><td width="72%" valign="middle">
				<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.addOC.orc_fecha);return false;" >
				<img border="0" src="calendario/icon_calendar.gif">				</a>
				</td>
				</tr>
                </table>
            <br /><span id="div_orc_fecha" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
            </td>
            <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td width="5%" >Hora:</td>
            <td width="20%" ><input name="orc_hora" type="text" value="<?=date('H:i')?>" class="input">
             <br /><span id="div_orc_hora" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
            </td>
            <td width="7%">&nbsp;</td>
        </tr>

        <tr>
            <td width="5%" >Proveedores:</td>
            <td width="20%"><!--<select name="orc_cli_uid" id="orc_cli_uid" class="input">
         <?php
        $arrayClient = admin::dbFillArray("select cli_uid, cli_socialreason as name from mdl_client where cli_delete=0 ");
        if(is_array($arrayClient))
        {
            foreach($arrayClient as $value=>$name)
            {
            ?>
                    <option value="<?=$value?>"><?=$name?></option>>
        <?php
            }
        }
        
        ?>
                </select>-->
                <div id="inputProveedor"></div>
                <br><br>
                <div id="busqueda">
                    
                    <input name="buscar" type="text" class="input3 proveedor" value="" size="20" /> <br /><label style="color:#ff8a36">Buscar por Nit o Razon Social</label>
                <br><br>
                </div>
                <br /><span id="div_orc_cli_uid" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
            </td>
                       <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td width="5%" >Elaborado por:</td>
            <td width="20%" ><input name="orc_aprobado" type="text" value="<?=$usuario?>" class="input">
            <br /><span id="div_orc_aprobado" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
            </td>
            <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td width="5%" >Documento PDF:</td>
            <td width="20%" ><input name="orc_document" type="file" value="" class="input">
            <br /><span id="div_orc_document" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
            </td>
            <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top"><?=admin::labels('status');?></td>
            <td><select name="orc_status" class="listMenu" id="sol_status">
            	<option selected="selected" value="ACTIVE"><?=admin::labels('active');?></option>
              	<option value="INACTIVE"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_sol_status" style="display:none;" class="error"></span></td>
                       <td width="7%">&nbsp;</td>
        </tr>
    </table>

</div>
</td></tr>
</table>
    </td>
  </tr>
</table>
 
<br />
      <br />
      <div id="contentButton">
	  	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="59%" align="center">
				<a href="" onclick="verifyOC(); return false;" class="button">Finalizar
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="ordenCompraList.php?$tipUid=<?=$tipUid?>&token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table></div>
      <br /><br />
<br />
<br />
    </form>      
      <br />
      <br />
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<br />

