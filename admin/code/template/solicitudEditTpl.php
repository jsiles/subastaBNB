<script language="javascript" type="text/javascript">
function verifyFileUpload()
	{
	document.getElementById('div_sol_document').style.display="none";
	var cv = document.getElementById('sol_document').value;
	var filepart = cv.split(".");
	var part = filepart.length-1;
	var extension = filepart[part];
	extension = extension.toLowerCase();
	if (extension!='jpg' && extension!='jpeg' && extension!='bmp' && extension!='gif' && extension!='png'&& extension!='doc'&& extension!='docx'&& extension!='xls'&& extension!='xlsx'&& extension!='pdf')	
		{
		document.getElementById('sol_document').value="";
		$('#div_sol_document').fadeIn(500);
		}
	}
</script>

<?php
define(SYS_LANG,$lang);
if ($lang=='es') $urlFrontLang='';
else $urlFrontLang=$lang.'/';
$sol_uid=  admin::getParam("sol_uid");
$sSQL="select * from mdl_solicitud_compra where sol_uid=$sol_uid";
$db->query($sSQL);
$solEdit=$db->next_record();
?>
<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<br>
<form name="updSol" method="post" action="code/execute/solicitudUpd.php?token=<?=admin::getParam("token")?>" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" valign="top"><table width="50%" border="0" cellpadding="5" cellspacing="5" class="box">
         <tr>
            <td colspan="3" class="titleBox">Datos Solicitud</td>
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
                        $valChecked=admin::getDbValue("select count(sou_uni_uid) from mdl_solicitud_unidad where sou_uni_uid=$key and sou_sol_uid=$sol_uid");
                        if($valChecked>0)$selectUni ='checked="checked"';
                        else $selectUni ="";
                        ?>
                      <input name="rav_uni_uid[]" value="<?=$key?>" class="input" type="checkbox" <?=$selectUni?>>&nbsp;<span class="txt10"><?=$value?></span>&nbsp;<?=$nuevaLinea?>
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
                         
             <!--   <a href="javascript:addUnidad();" class="small2">agregar</a> | 
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
            <td width="40%" ><input name="sol_monto" id="sol_monto" type="text" value="<?=$solEdit["sol_monto"]?>" class="input">
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
                                &nbsp;<a href="javascript:addCurrency();" class="small2">agregar</a> | 
                <a href="javascript:delCurrency();" class="small3"><?=admin::labels('del');?></a></span>

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
            <td width="20%" ><textarea id="sol_observaciones" name="sol_observaciones" col="200" rows="5" class="textarea"><?=$solEdit["sol_observaciones"]?></textarea>
                
            <td width="7%">&nbsp;</td>
        </tr>
        <tr>
            <td width="5%" >Documento:</td>
            <td width="20%" >
            <input name="tipUid" type="hidden" value="<?=$tipUid?>" class="input">
                        <?php
			$docsSavedroot = PATH_ROOT."/docs/subasta/".$solEdit["sol_doc"];
                        $extension = pathinfo($docsSavedroot, PATHINFO_EXTENSION);
                        //echo $solEdit["sol_doc"]."##";
			if (file_exists($docsSavedroot) && $solEdit["sol_doc"]!=""){
                            switch ($extension){
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
			<div id="image_edit_<?=$solEdit["sol_uid"]?>">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableUpload">
			<tr>
				<td width="25%" rowspan="2" align="center" valign="middle" style="padding:4px;">
                                    <a target="blank" href="<?=PATH_DOMAIN."/docs/subasta/".$solEdit["sol_doc"];?>"><img src="<?=$imgSaved?>?<?=time();?>" border="0" /></a>
                                </td>
				<td width="75%" style="font-size:11px;">
				<?=$solEdit["sol_doc"];?><br />
				<a href="javascript:viewInputFile('on')" title="<?=admin::labels('change');?>" class="small2"><?=admin::labels('change');?></a>
				<span class="pipe">|</span> <a href="#" onclick="removeImg(<?=$solEdit["sol_uid"]?>);return false;" title="<?=admin::labels('del')?>" class="small3"><?=admin::labels('del')?></a>				</td>
			</tr>
			<tr>
				<td height="24">
				<div id="imageChange1" style="display:none">
                                    <input type="file" name="sol_document" id="sol_document" size="14" style="font-size:11px;" onclick="verifyFileUpload()" >  
                        <a href="javascript:viewInputFile('off')" 
                           onclick="document.getElementById('sol_document').value='';">
                            <img border="0" src="lib/close.gif" align="top"/></a>
			
			<span id="div_sol_document" class="error" style="display:none">Solo archivos jpg bmp gif png doc pdf xls</span></div></td>
			</tr>
			</table>
			</div>
			<div id="image_add_<?=$solEdit["sol_uid"]?>" style="display:none;"></div>
			<?php
                        }
			else
				{ ?>
				<input type="file" name="sol_document" id="sol_document" size="32" class="input" onchange="verifyFileUpload();">
				<span id="div_sol_document" class="error" style="display:none">Solo archivos jpg bmp gif png </span>	
			<?php
                        } 
                        ?>
            
            
            
            </td>
            <td width="7%">&nbsp;</td>
        </tr>
<!--
        <tr>
            <td width="5%" >Proveedores:</td>
            <td width="20%">
         <?php
        $arrayClient = admin::dbFillArray("select cli_uid, cli_socialreason as name from mdl_client,mdl_solicitud_proveedor where sop_cli_uid=cli_uid and sop_sol_uid=$sol_uid and cli_delete=0 ");
        if(is_array($arrayClient))
        {
	foreach($arrayClient as $value=>$name)
	{
                  
	?>
                <input name="sol_cli_uid[]" type="checkbox" class="input3" value="<?=$value?>" size="9" checked="checked"/><?=$name?><br />
    
    
    <?php
        }
        ?>
            <div id="inputProveedor"></div>
                <br><br>
                <div>
                    
                    <input name="buscar" type="text" class="input3 proveedor" value="" size="20" /> &nbsp;<label style="color:#ff8a36">Buscar por Nit o Razon Social</label>
              
                <br><br>
                </div> 
            <?php
        }
        else{
	?>
           No existen proveedores.
        <?php
        }
        ?>
            </td>
                       <td width="7%">&nbsp;</td>
        </tr> -->
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
     </form>  
     <br>
            <br>
            <br>

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td width="77%" height="40"><span class="title">Material solicitado</span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="2" id="contentListing0">
    <div class="row0">
    <table class="list" width="100%">
	<tr><td width="12%" style="color:#16652f">Nivel 1&nbsp;</td>
    <td width="12%" style="color:#16652f">Nivel 2&nbsp;</td>
    <td width="12%" style="color:#16652f">Nivel 3&nbsp;</td>
    <td width="12%" style="color:#16652f">Descripci&oacute;n&nbsp;</td>
    <td width="12%" style="color:#16652f">Cantidad&nbsp;</td>
    <td width="12%" style="color:#16652f">Unidad&nbsp;</td>
    <td align="center" width="12%" height="5">&nbsp;</td>
    
	</tr>
	</table>
    </div>
    <div id="add<?=$ind_uid?>" class="row0">
    <form name="frmSolicitud" action="code/execute/solAdd2.php" enctype="multipart/form-data" > 
	<table class="list" width="100%">
	<tr>
            
            <td width="12%">
	   <div id="div_nivel1_select">
				<select name="nivel1_uid" id="nivel1_uid" class="input" onchange="actualizaNiveles()">
                                    <option value="" selected="selected">Seleccionar</option>
                	<?php
                    $sql = "select ca1_uid, ca1_description from mdl_categoria1 where ca1_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{	
					?>
					<option value="<?=$content["ca1_uid"]?>"><?=$content["ca1_description"]?></option>					
					<?php
					}
                    ?>
				</select>
                <a href="adicionar" onclick="addNivel1();return false;" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="borrar" onclick="deleteNivel1();return false;" class="small3"><?=admin::labels('del');?></a>
                <div id="div_nivel1" style="display:none;">
		<input type="text" name="nivel1" id="nivel1" class="input3" 
                       onfocus="setClassInput3(this,'ON');document.getElementById('div_nivel1_error').style.display='none';" 
                       onblur="setClassInput3(this,'OFF');document.getElementById('div_nivel1_error').style.display='none';" 
                       onclick="setClassInput3(this,'ON');document.getElementById('div_nivel1_error').style.display='none';"/>		
                
		<a href="" onclick="nivel1Add();return false;" class="button3"><?=admin::labels('add');?></a><a href="javascript:addNivel1();" class="link2">Cerrar</a>		
                </div>
				<br /><span id="div_nivel1_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
                </div>
                <input name="sol_uid" id="sol_uid" value="<?=$sol_uid?>" type="hidden" />
                <input name="tipUid" id="tipUid" value="<?=$tipUid?>" type="hidden" />
            </td>
            
            
    <td width="12%">
	   <div id="div_nivel2_select">
				<select name="nivel2_uid" id="nivel2_uid" class="input"  >
                                 <option value="" selected="selected" onchange="actualizaNiveles2();">Seleccionar</option>
				</select>
               <a href="adicionar" onclick="addNivel2();return false;" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="borrar" onclick="deleteNivel2();return false;" class="small3"><?=admin::labels('del');?></a>
                <div id="div_nivel2" style="display:none;">
		<input type="text" name="nivel2" id="nivel2" class="input3" 
                       onfocus="setClassInput3(this,'ON');document.getElementById('div_nivel2_error').style.display='none';" 
                       onblur="setClassInput3(this,'OFF');document.getElementById('div_nivel2_error').style.display='none';" 
                       onclick="setClassInput3(this,'ON');document.getElementById('div_nivel2_error').style.display='none';"/>		
                
		<a href="" onclick="nivel2Add();return false;" class="button3"><?=admin::labels('add');?></a><a href="javascript:addNivel2();" class="link2">Cerrar</a>		
                </div>
				<br /><span id="div_nivel2_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
               
           </div>
    </td>
    <td width="12%">
	   <div id="div_nivel3_select">
				<select name="nivel3_uid" id="nivel3_uid" class="input"  >
                                 <option value="" selected="selected">Seleccionar</option>
				</select>
               <a href="adicionar" onclick="addNivel3();return false;" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="borrar" onclick="deleteNivel3();return false;" class="small3"><?=admin::labels('del');?></a>
                <div id="div_nivel3" style="display:none;">
		<input type="text" name="nivel3" id="nivel3" class="input3" 
                       onfocus="setClassInput3(this,'ON');document.getElementById('div_nivel3_error').style.display='none';" 
                       onblur="setClassInput3(this,'OFF');document.getElementById('div_nivel3_error').style.display='none';" 
                       onclick="setClassInput3(this,'ON');document.getElementById('div_nivel3_error').style.display='none';"/>		
                
		<a href="" onclick="nivel3Add();return false;" class="button3"><?=admin::labels('add');?></a><a href="javascript:addNivel3();" class="link2">Cerrar</a>		
                </div>
				<br /><span id="div_nivel3_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
               
           </div>
    </td>
    <td width="12%">
        <input type="text" class="input3" name="sol_description" id="sol_description" />
        <br /><span id="div_sol_description_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
	</td>
<td width="12%">
    <input type="text" class="input3" name="sol_cantidad" id="sol_cantidad" />
    <br /><span id="div_sol_cantidad_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
	</td>
<td width="12%">
    <input type="text" class="input3" name="sol_unidad" id="sol_unidad" />
    <br /><span id="div_sol_unidad_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
	</td>
<td width="12%">
    <a href="guardar" onclick="verifySolicitud(); return false;">
		<img src="lib/save_es.gif" border="0" title="<?=admin::labels('save')?>" alt="<?=admin::labels('save')?>">
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
   $sSQL= "select * from mdl_solicitud_material where som_sol_uid=$sol_uid and som_delete=0";
   //echo $sSQL;
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
    <tr>
        <td width="12%" style="color:#16652f">Nivel 1</td>
        <td width="12%" style="color:#16652f">Nivel 2</td>
        <td width="12%" style="color:#16652f">Nivel 3</td>
        <td width="12%" style="color:#16652f">Descripci&oacute;n</td>
        <td width="12%" style="color:#16652f">Cantidad</td>
        <td width="12%" style="color:#16652f">Unidad</td>
	<td align="center" width="12%" height="5">&nbsp;</td>
    </tr>
	</table>
    </div>
<div class="itemList" id="itemList" style="width:99%">  
	<?php
$i=1;
while ($list = $db2->next_record())
	{
	$som_uid=$list["som_uid"];
	$som_sol_uid=$list["som_sol_uid"];
	$som_ca1_uid=admin::getDbValue("select ca1_description from mdl_categoria1 where ca1_uid=".$list["som_ca1_uid"]);
	$som_ca2_uid=admin::getDbValue("select ca2_description from mdl_categoria2 where ca2_uid=".$list["som_ca2_uid"]);
	$som_ca3_uid=admin::getDbValue("select ca3_description from mdl_categoria3 where ca3_uid=".$list["som_ca3_uid"]);
	$som_description=$list["som_description"];
	$som_cantidad=$list["som_cantidad"];
	$som_unidad=$list["som_unidad"];

	if ($i%2==0) $class='row0';
	else  $class='row';
	if ($i%2==0) $class2='row';
	else  $class2='row1';
  	?> 
    <div class="groupItem" id="<?=$som_uid?>">
  	<div id="list_<?=$som_uid?>" class="<?=$class?>" style="width:100%" >
<table class="list" width="100%">
	<tr>
    <td width="12%"><?=$som_ca1_uid?></td>
    <td width="12%"><?=$som_ca2_uid?></td>
    <td width="12%"><?=$som_ca3_uid?></td>
    <td width="12%"><?=$som_description?></td>
    <td width="12%"><?=$som_cantidad?></td>
    <td width="12%"><?=$som_unidad?></td>
	<td align="center" width="12%" height="5">
		<a href="#" onclick="removeList(<?=$som_uid?>);return false;">
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
	<tr><td height="30px" align="left" class="bold">
	No existen registros
	</td></tr>	
 </table>
</div>
</td></tr></table>
</td>
</tr>
<?php 	} ?>
<tr>
<td colspan="2">
    <br>
    <br>

<br /><br /><br /><br /><br />
</td></tr>
</table>
           
    
<br />
      <br />
      
      <div id="contentButton"  style="display:">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="tbl_subasta" >
			<tr>
				<td width="59%" align="center">
                                    <a href="finaliza" onclick="document.updSol.submit();return false;" class="button">Finalizar</a></td>
		
        </tr>
      </table>
      
      </div>
<br />
<br />
    
      <br />
      <br />

