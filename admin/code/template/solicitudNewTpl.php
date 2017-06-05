<?php
define(SYS_LANG,$lang);
if ($lang=='es') $urlFrontLang='';
else $urlFrontLang=$lang.'/';

?>
<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<br>
<form name="addSol" method="post" action="code/execute/solicitudAdd.php?token=<?=admin::getParam("token")?>" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" valign="top"><table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
         <tr>
            <td colspan="3" class="titleBox">Datos Solicitud</td>
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
            <td width="40%" ><input name="sol_monto" id="sol_monto" type="text" value="" class="input">
                 <?php 
				$arrayMoneda = admin::dbFillArray("select cur_uid, cur_description from mdl_currency where cur_delete=0");
				
				?>
                <span id="div_sol_moneda">
                <select name="sol_moneda" id="sol_moneda" class="input" >
                <?php
				foreach($arrayMoneda as $key=>$value)
				{                
				?>
                	<option <?php if ($key==$solEdit["sol_moneda"]) echo 'selected="selected"';?> value="<?=$key?>"><?=$value?></option>
				<?php
				}
				?>
                </select>
                                &nbsp;<!--<a href="javascript:addCurrency();" class="small2">agregar</a> | 
                <a href="javascript:delCurrency();" class="small3"><?=admin::labels('del');?></a>-->
                
                </span>

                 <div id="div_add_currency" style="display:none;">
		<input type="text" name="add_currency" id="add_currency" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_add_currency_error').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_add_currency_error').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_add_currency_error').style.display='none';"/>		
		<a href="javascript:addCurrencyOption()" class="button3"><?=admin::labels('add');?></a><a href="javascript:closeCurrency();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_add_currency_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
                
             <br /><span id="div_sol_monto" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
            </td>
            <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td width="5%" >Observaciones:</td>    
            <td width="40%" ><textarea id="sol_observaciones" name="sol_observaciones" col="200" rows="5" class="textarea"></textarea>
            <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td width="5%" >Documento:</td>
            <td width="20%" ><input name="sol_document" type="file" value="" class="input">
            <input name="tipUid" type="hidden" value="<?=$tipUid?>" class="input">
            </td>
            <td width="7%">&nbsp;</td>
        </tr>

    <!--    <tr>
            <td width="5%" >Proveedores Sugeridos:</td>
            <td width="20%">
                <div id="inputProveedor"></div>
                <br><br>
                <div>
                    
                    <input name="buscar" type="text" class="input3 proveedor" value="" size="20" /> &nbsp;<label style="color:#ff8a36">Buscar por Nit o Razon Social</label>
                <br><br>
                </div> 
        
            </td>
                       <td width="7%">&nbsp;</td>
        </tr>-->
        <tr>
            <td valign="top"><?=admin::labels('status');?></td>
            <td><select name="sol_status" class="listMenu" id="sol_status">
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
				<a href="" onclick="document.addSol.submit(); return false;" class="button">Siguiente
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="solicitudList.php?$tipUid=<?=$tipUid?>&token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table></div>
      <br /><br />
<br />
<br />
    </form>      
      <br />
      <br />

