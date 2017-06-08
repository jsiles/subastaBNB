<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="77%" height="40"><span class="title">Listado de Incoterm</span></td>
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
    <form name="frmIncoterm" action="code/execute/incotermAdd.php" enctype="multipart/form-data" > 
	<table class="list" width="100%">
	<tr><td width="12%"><input name="cli_name" id="cli_name" onkeyup="lookup(this.value);" type="text" size="15"  onfocus="document.getElementById('div_cli_name_error').style.display='none';" onblur="document.getElementById('div_cli_name_error').style.display='none';" onclick="document.getElementById('div_cli_name_error').style.display='none';" autocomplete='off' />
					   	
    					<br /><span id="div_cli_name_error" style="display:none;" class="error">Seleccione un nombre del listado.</span>
                        <input name="cli_uid" id="cli_uid" value="" type="hidden" />
                        <input name="sub_uid" id="sub_uid" value="<?=$sub_uid?>" type="hidden" /></td>
    <td width="12%"><input name="inc_lugar_entrega" id="inc_lugar_entrega" type="text"  size="15" autocomplete='off'/></td>
    <td width="12%"><div id="div_inc_tra_uid_select">
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
$db2->query($sSQL);
$nroReg = $db2->numrows();
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

	if ($i%2==0) $class='row1';
	else  $class='row2';
	if ($i%2==0) $class2='row';
	else  $class2='row1';
  	?> 
    <div class="groupItem" id="<?=$inc_uid?>">
  	<div id="list_<?=$inc_uid?>" class="<?=$class?>" style="width:100%" >
<table class="list" width="100%">
	<tr>
    <td width="12%"><?=$cli_name?></td>
    <td width="12%"><?=($inc_lugar_entrega)?></td>
    <td width="12%"><?=($tra_name)?></td>
    <td width="12%"><?=($inl_name)?></td>
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
    <form name="frmIncotermUpd<?=$inc_uid?>" id="frmIncotermUpd<?=$inc_uid?>" action="code/execute/IncotermUpd.php"  enctype="multipart/form-data" >
<table class="list" width="100%">
	<tr><td width="12%">
    			<input name="cli_name<?=$cli_uid?>" id="cli_name<?=$cli_uid?>" onkeyup="lookup(this.value,<?=$cli_uid?>);" type="text" size="15" value="<?=$cli_name?>" />
    			<div id='autocomplete<?=$cli_uid?>' style="display:none"></div>
                <input name="cli_uid<?=$cli_uid?>" id="cli_uid<?=$cli_uid?>" value="<?=$cli_uid?>" type="hidden" />
                <input name="sub_uid2" id="sub_uid2" value="<?=$sub_uid?>" type="hidden" /></td>
    <td width="12%"><input name="inc_lugar_entrega" id="inc_lugar_entrega" type="text"  size="15" value="<?=($inc_lugar_entrega)?>" /></td>
    <td width="12%">
    				<select name="inc_tra_uid<?=$tra_uid?>" id="inc_tra_uid<?=$tra_uid?>" class="input"  >
                	<?php
                    $sql3 = "select tra_uid, tra_name from mdl_transporte where tra_delete=0";
					$db3->query($sql3);
					while ($content=$db3->next_record())
					{	
					?>
					<option <? if($content["tra_name"]==$tra_name) echo 'selected="selected"';?> value="<?=$content["tra_uid"]?>"><?=($content["tra_name"])?></option>					
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
</table>
<br />
<div id="contentButton">
	  	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="59%" align="center">
				<a href="subastasList.php?token=<?=admin::getParam("token")?>" class="button" >Volver</a>
				</td>
          
        </tr>
      </table></div>