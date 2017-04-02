<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('client','clientNew',false); 
$ite_name=admin::getParam("ite_uid");
$item_uid=admin::getParam("item_uid");
// REGISTRANDO LENGUAGE DE LAS CATEGORIAS
$sql = "insert into mdl_item(
					ite_name, 
					ite_item,
					ite_delete
					)
				values
					(
						'".$ite_name."',
						'".$item_uid."', 
						0
					)";
$db->query($sql);	
// CONSTRUIMOS EL NUEVO SELECT	
?>
<select name="cli_ite_uid" id="cli_ite_uid" class="input" >
<?php
	$sql = "select ite_uid, ite_name from mdl_item where ite_delete=0 and ite_item='".$item_uid."'";
	$db2->query($sql);
	while ($content=$db2->next_record())
	{	
	    ($content["ite_name"]==$ite_name)?$selected="selected":$selected="";
	?>
	<option value="<?=$content["ite_uid"]?>" <?=$selected?>><?=$content["ite_name"]?></option>					
	<?php
	}
?>
</select>		
 <a href="javascript:changeClientItem();" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="javascript:deleteClientItem();" class="small3"><?=admin::labels('del');?></a>
                <div id="div_client_item" style="display:none;">
		<input type="text" name="client_item" id="client_item" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_cli_ite_uid').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_cli_ite_uid').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_cli_ite_uid').style.display='none';"/>		
		<a href="javascript:itemClientAdd()" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeClientItem();" class="link2">Cerrar</a>		</div>
        <br /><span id="div_cli_ite_uid" style="display:none;" class="error">Forma de pago al proveedor es necesaria</span>