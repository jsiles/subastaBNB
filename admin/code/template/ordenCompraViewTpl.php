<?php
define(SYS_LANG,$lang);
if ($lang=='es') $urlFrontLang='';
else $urlFrontLang=$lang.'/';
$usuario =  admin::getDbValue("select concat(usr_firstname,' ',usr_lastname) from sys_users where usr_uid=".admin::getSession("usr_uid"));
$orc_uid=  admin::getParam("orc_uid");
$sSQL="select * from mdl_orden_compra where orc_uid=$orc_uid";
if($db->query($sSQL)) $oc=$db->next_record();

?>
<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<br>
<form name="addOC" method="post" action="code/execute/ordenCompraUpd.php?token=<?=admin::getParam("token")?>" enctype="multipart/form-data">
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
            <td><input name="orc_uid" type="hidden" value="<?=$orc_uid?>" class="input"></td>
         </tr>
          
	<tr>
            <td width="5%" >Nro de Solicitud:</td>
            <td width="20%"><input name="orc_sol_uid" id="orc_sol_uid" disabled="disabled" value="<?=$oc["orc_sol_uid"]?>" class="input">
             <br /><span id="div_orc_sol_uid" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
             </td>
            <td width="7%">&nbsp;</td>
            
        </tr>
        <tr>
            <td width="5%" >Nro Orden de Compra:</td>    
            <td width="20%" ><input name="orc_nro_oc" disabled="disabled" id="orc_nro_oc" value="<?=$oc["orc_nro_oc"]?>" class="input">
            <br /><span id="div_orc_nro_oc" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
            </td>
            <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td width="5%" >Unidad Solicitante:</td>
             <td width="20%">
                                 <input name="sol_uid" id="sol_uid" value="<?=$sol_uid?>" type="hidden" />
                <input name="tipUid" id="tipUid" value="<?=$tipUid?>" type="hidden" />

                  <span id="div_sub_unidad">
                <?php
                  $uUnidad = admin::getDbValue("select max(uni_uid) from mdl_unidad where uni_delete=0");
                  $arrayUnidad = admin::dbFillArray("select uni_uid, uni_description from mdl_unidad where uni_delete=0 order by uni_uid");
                  if(is_array($arrayUnidad)){
                      $unidades=true;
                  foreach($arrayUnidad as $key=>$value)
                   {            
                      
                        if($key==$uUnidad) $nuevaLinea = "";
                        else $nuevaLinea = "<br>";
                        $valChecked=admin::getDbValue("select count(oru_uni_uid) from mdl_orden_unidad where oru_uni_uid=$key and oru_orc_uid=$orc_uid");
                        if($valChecked>0)$selectUni ='checked="checked"';
                        else $selectUni ="";
                        ?>
                      <input name="rav_uni_uid[]" disabled="disabled" value="<?=$key?>" class="input" type="checkbox" <?=$selectUni?>>&nbsp;<span class="txt10"><?=$value?></span>&nbsp;<?=$nuevaLinea?>
                        <?php
                   }
                  } else{
                        $unidades=false;
		?>
                        <span class="txt10">No existen unidades.</span>&nbsp;
                <?php
                    }
                ?>
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
            <td width="40%" ><input name="orc_monto" id="orc_monto" disabled="disabled" type="text" value="<?=admin::numberFormat($oc["orc_monto"])?>" class="input">
                <?php 
				$arrayMoneda = admin::dbFillArray("select cur_uid, cur_description from mdl_currency where cur_delete=0");
				
				?>
                <span id="div_sub_moneda">
                    <select name="sub_moneda" id="sub_moneda" disabled="disabled" class="input" >
                <?php
				foreach($arrayMoneda as $key=>$value)
				{                
				?>
                	<option <?php if ($key==$orc["orc_moneda"]) echo 'selected="selected"';?> value="<?=$key?>"><?=$value?></option>
				<?php
				}
				?>
                </select>

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
				<input name="orc_fecha" type="text" class="input" disabled="disabled"  id="orc_fecha" value="<?=$oc["orc_fecha"]?>" size="15" >
				</td>
				</tr>
                </table>
            <br /><span id="div_orc_fecha" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
            </td>
            <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td width="5%" >Hora:</td>
            <td width="20%" ><input name="orc_hora" disabled="disabled" type="text" value="<?=substr($oc["orc_hora"],0,5)?>" class="input">
             <br /><span id="div_orc_hora" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
            </td>
            <td width="7%">&nbsp;</td>
        </tr>

        <tr>
            <td width="5%" >Proveedores:</td>
            <td width="20%"><select name="orc_cli_uid" id="orc_cli_uid" disabled="disabled" class="input">
         <?php
        $arrayClient = admin::dbFillArray("select cli_uid, cli_socialreason as name from mdl_client where cli_delete=0 ");
        if(is_array($arrayClient))
        {
            foreach($arrayClient as $value=>$name)
            {
                if($value==$oc["orc_cli_uid"]) {$selected = "selected='selected'";}
                else {$selected = "";}
            ?>
                    <option value="<?=$value?>" <?=$selected?>><?=$name?></option>>
        <?php
            }
        }
        
        ?>
                </select>
                <br /><span id="div_orc_cli_uid" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
            </td>
                       <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td width="5%" >Elaborado por:</td>
            <td width="20%" ><input name="orc_aprobado" type="text" disabled="disabled" value="<?=$oc["orc_aprobado"]?>" class="input">
            <br /><span id="div_orc_aprobado" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
            </td>
            <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td width="5%" >Documento PDF:</td>
            <td width="20%" >
                <?php
			$docsSavedroot = PATH_ROOT."/admin/upload/oc/".$oc["orc_document"];
                        $extension = pathinfo($docsSavedroot, PATHINFO_EXTENSION);
                        //echo $solEdit["sol_doc"]."##";
			if (file_exists($docsSavedroot) && $oc["orc_document"]!=""){
                            switch ($extension){
                                case 'jpg':
                                    $imgSaved=PATH_DOMAIN."/admin/lib/ext/image.gif";
                                    break;
                                case 'png':
                                    $imgSaved=PATH_DOMAIN."/admin/lib/ext/image.gif";
                                    break;
                                case 'pdf':
                                    $imgSaved=PATH_DOMAIN."/admin/lib/ext/pdf.gif";
                                    break;
                                case 'xls':
                                    $imgSaved=PATH_DOMAIN."/admin/lib/ext/excel.gif";
                                    break;
                                case 'xlsx':
                                    $imgSaved=PATH_DOMAIN."/admin/lib/ext/excel.gif";
                                    break;
                                case 'doc':
                                    $imgSaved=PATH_DOMAIN."/admin/lib/ext/word.gif";
                                    break;
                                case 'docx':
                                    $imgSaved=PATH_DOMAIN."/admin/lib/ext/word.gif";
                                    break;
                                
                                default :
                                    $imgSaved=PATH_DOMAIN."/admin/lib/ext/doc-txt.png";
                                    break;
                            }
                              // echo $imgSaved."##".$extension;
			?>
			<div id="image_edit_<?=$oc["orc_uid"]?>">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableUpload">
			<tr>
				<td width="25%" rowspan="2" align="center" valign="middle" style="padding:4px;">
                                    <a target="blank" href="<?=PATH_DOMAIN."/admin/upload/oc/".$oc["orc_document"];?>"><img src="<?=$imgSaved?>?<?=time();?>" border="0" /></a>
                                </td>
				<td width="75%" style="font-size:11px;">
				<?=$oc["orc_document"]?><br />
                                </td>
			</tr>
			<tr>
				<td height="24">
				<div id="imageChange1" style="display:none">
                                    <input type="file" name="orc_document" id="sol_document" size="14" style="font-size:11px;" onclick="verifyFileUpload()" >  
                        <a href="javascript:viewInputFile('off')" 
                           onclick="document.getElementById('orc_document').value='';document.getElementById('button_next').innerHTML='<?=admin::labels('public');?>';">
                            <img border="0" src="lib/close.gif" align="top"/></a>
			
			<span id="div_orc_document" class="error" style="display:none">Solo archivos jpg bmp gif png doc pdf xls</span></div></td>
			</tr>
			</table>
			</div>
			<div id="image_add_<?=$oc["orc_uid"]?>" style="display:none;"></div>
			<?php
                        }
			else
				{ ?>
				<input name="orc_document" type="file" value="" class="input">
                            <br /><span id="div_orc_document" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
			<?php
                        } 
                        ?>
                
                
                
                
            </td>
            <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top"><?=admin::labels('status');?></td>
            <td><select name="orc_status" class="listMenu" id="sol_status">
            	<option selected="selected" disabled="disabled" value="ACTIVE"><?=admin::labels('active');?></option>
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
				<a href="ordenCompraList.php?$tipUid=<?=$tipUid?>&token=<?=admin::getParam("token")?>"  class="button">Volver
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
              &nbsp;
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