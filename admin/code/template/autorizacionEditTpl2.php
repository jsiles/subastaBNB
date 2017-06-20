<?php
$sub_uid=admin::getParam("sub_uid");
$pro_uid=admin::getParam("pro_uid");
if (!$sub_uid) header('Location: ../../autorizacionList.php');
$sql = "SELECT * FROM mdl_product, mdl_subasta, mdl_pro_category WHERE sub_uid=pro_sub_uid and pca_uid=sub_pca_uid and sub_status='ACTIVE' and sub_uid='".$sub_uid."'";
$db->query($sql);
$prod = $db->next_record();

?>
<br />
<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<br />

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="77%" height="40"><span class="title">Productos</span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="2" id="contentListing0">
    <div class="row0">
    <table class="list" width="100%">
	<tr>
    <td width="15%" style="color:#16652f" align="left">Producto</td>
    <td width="15%" style="color:#16652f" align="left">Descripci&oacute;n</td>
    <td width="20%" style="color:#16652f" align="left">Imagen</td>
    <td width="10%" style="color:#16652f" align="left">Precio Base</td> <?php
                        if($prod["sub_modalidad"]!="PRECIO")
                        {
                        ?>
    <td width="15%" style="color:#16652f" align="left">Unidad de mejora</td>
                        <?php } ?>
	<td width="15%" style="color:#16652f" align="left">Proveedor</td> <td align="center" width="10%" height="5">&nbsp;</td>
    
	</tr>
	</table>
    </div>
    <div id="add<?=$ind_uid?>" class="row0">
    <form name="frmIncoterm" method="post" action="code/execute/productAAdd.php" enctype="multipart/form-data" > 
	<table class="list" width="100%">
	<tr><td width="15%">
	  <input name="pro_product" id="pro_product" type="text"  size="15" autocomplete='off'/>	 
      <input name="sub_uid" id="sub_uid" value="<?=$sub_uid?>" type="hidden" />
      <input name="pro_uid" id="sub_uid" value="<?=$pro_uid?>" type="hidden" />
      </td>
    <td width="15%"><input name="pro_description" id="pro_description" type="text"  size="15" autocomplete='off'/></td>
    <td width="20%">
    	<input type="file" name="pro_image" id="pro_image" size="20" class="input">
				<span id="div_pro_uid" class="error" style="display:none">Solo archivos jpg bmp gif png </span>	
	</td>
    <td width="10%"><input name="pro_precio" id="pro_precio" type="text" size="9" />
                </td>
                 <?php
                        if($prod["sub_modalidad"]!="PRECIO")
                        {
                        ?>
    <td width="15%"><input name="pro_unidad" id="pro_unidad" type="text" size="9" />
                        </td>            <?php } ?>
    <td width="15%">
    <?php
    $arrayClient = admin::dbFillArray("select cli_uid, cli_socialreason as name from mdl_client, mdl_incoterm where inc_cli_uid=cli_uid and inc_sub_uid=$sub_uid");
	foreach($arrayClient as $value=>$name)
	{
	?>
    <input name="pro_cli_id[]" type="checkbox" value="<?=$value?>" size="9" /><?=$name?><br />
    <?php
    }
	?>
    </td>
	<td align="center" width="10%" height="5">
		<a href="guardar" onclick="verifyProduct(); return false;">
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
   $sSQL= "SELECT * FROM mdl_xitem WHERE xit_delete=0 and xit_sub_uid='".$sub_uid."' order by xit_uid asc";
$nroReg = admin::getDbValue("SELECT count(*) FROM mdl_xitem WHERE xit_delete=0 and xit_sub_uid='".$sub_uid."'");
//echo $nroReg."ssss";  
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
    <td width="12%" style="color:#16652f">Producto</td>
    <td width="12%" style="color:#16652f">Descripci&oacute;n</td>
    <td width="12%" style="color:#16652f">Imagen</td>
    <td width="12%" style="color:#16652f">Precio base</td>
     <?php
                        if($prod["sub_modalidad"]!="PRECIO")
                        {
                        ?>
    <td width="12%" style="color:#16652f">Unidad de mejora</td>
                        <?php } ?>
	<td width="12%" style="color:#16652f">Proveedor</td>
	<td align="center" width="12%" height="5">&nbsp;</td>
	</tr>
	</table>
    </div>
<div class="itemList" id="itemList" style="width:99%">  
	<?php
$i=1;
while ($list = $db2->next_record())
	{
	$flduid = $list["xit_uid"];
	$fldproduct = $list["xit_product"];
	$flddescription = $list["xit_description"];
	$fldimage = $list["xit_image"];
	$fldprice = $list["xit_price"];
	$fldunidad = $list["xit_unity"];
	if ($i%2==0) $class='row0';
	else  $class='row';
	if ($i%2==0) $class2='row';
	else  $class2='row1';
  	?> 
    <div class="groupItem" id="<?=$flduid?>">
  	<div id="list_<?=$flduid?>" class="<?=$class?>" style="width:100%" >
<table class="list" width="100%">
	<tr>
    
    <td width="12%"><?=($fldproduct)?></td>
    <td width="12%"><?=($flddescription)?></td>
    <td width="12%"><img src="<?=PATH_DOMAIN."/img/subasta/thumb2_".($fldimage)?>"  border="0"> </td>
    <td width="12%" align="center"><?=round($fldprice,2)?></td>
     <?php
                        if($prod["sub_modalidad"]!="PRECIO")
                        {
                        ?>
                        <td width="12%" align="center"><?=$fldunidad?></td><?php } ?>
	<td width="12%"><?php
    $db3->query("select clx_cli_uid from mdl_clixitem where clx_delete=0 and clx_xit_uid=$flduid ");
	
	while ($user = $db3->next_record())
	{
		
		$cli_name = admin::getDBvalue("select cli_socialreason as nombre from mdl_client WHERE cli_uid=".$user["clx_cli_uid"]);
		echo $cli_name."<br>";
	}
	
	?></td>
    <!--<td align="center" width="12%" height="5">
		<a href="#" onclick="showTab('list_<?=$inc_uid?>');showTab('Add_<?=$inc_uid?>'); return false;">
		<img src="lib/edit_es.gif" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
		</a>
	</td>-->
	<td align="center" width="12%" height="5">
		<a href="#" onclick="removeList(<?=$flduid?>);return false;">
		<img src="lib/delete_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
		</a>
	</td>
	</tr>
	</table>
	</div>
    </div>
    <div id="Add_<?=$inc_uid?>" class="<?=$class2?>" style="display:none">
    <form  method="post"  name="frmIncotermUpd<?=$inc_uid?>" id="frmIncotermUpd<?=$inc_uid?>" action="code/execute/IncotermUpd.php"  enctype="multipart/form-data" >
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
	No hay registros
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
				<a href="autorizacionList.php" class="button" >Finalizar</a></td>
		<td width="41%" style="font-size:11px;">&nbsp;
		</td>
          
        </tr>
      </table></div>
<br /><br /><br /><br /><br />
</td></tr>
</table>
      
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
