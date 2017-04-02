<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('client','clientNew',false); 
$lec_name=admin::getParam("lec_uid");

// REGISTRANDO LENGUAGE DE LAS CATEGORIAS
$sql = "insert into mdl_legalclassification(
					lec_name, 
					lec_status,
					lec_delete
					)
				values
					(
						'".$lec_name."', 
						'ACTIVE', 
						0
					)";
$db->query($sql);	
// CONSTRUIMOS EL NUEVO SELECT	
?>
<select name="cli_lec_uid" id="cli_lec_uid" class="input" >
<?php
	$sql = "select lec_uid, lec_name from mdl_legalclassification where lec_delete=0";
	$db2->query($sql);
	while ($content=$db2->next_record())
	{	
	    ($content["lec_name"]==$lec_name)?$selected="selected":$selected="";
	?>
	<option value="<?=$content["lec_uid"]?>" <?=$selected?>><?=$content["lec_name"]?></option>					
	<?php
	}
?>
</select>		
<a href="javascript:changeClientCategory();" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="javascript:deleteClientCategory();" class="small3"><?=admin::labels('del');?></a>
                <div id="div_client_category" style="display:none;">
		<input type="text" name="client_category" id="client_category" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_cli_lec_uid').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_cli_lec_uid').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_cli_lec_uid').style.display='none';"/>		
		<a href="javascript:cagetogyClientAdd()" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeClientCategory();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_cli_lec_uid" style="display:none;" class="error">Clasificacion juridica es necesaria</span>