<?php
define(SYS_LANG,$lang);
if ($lang=='es') $urlFrontLang='';
else $urlFrontLang=$lang.'/';
$tipUid=  admin::getParam("tipUid");
$sol_uid=  admin::getParam("sol_uid");

?>
<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
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
    <td width="12%" style="color:#16652f">Unidad (Ej. Millones)&nbsp;</td>
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
<div id="contentButton"  style="display:">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="tbl_subasta" >
			<tr>
				<td width="59%" align="center">
				<a href="solicitudList.php?tipUid=<?=$tipUid?>&token=<?=admin::getParam("token")?>" class="button">Finalizar</a></td>
		
		</td>
          
        </tr>
      </table>
      
      </div>
<br /><br /><br /><br /><br />
</td></tr>
</table>
 

<br />
<br />

