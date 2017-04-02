<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('subastas','docsCatAdd2',false); 
$pca_uid=admin::getParam("pca_uid");
$maxUid=admin::getDBvalue("SELECT max(pca_uid) FROM mdl_pro_category");
$maxUid++;
// REGISTRANDO LENGUAGE DE LAS CATEGORIAS
$sql = "update mdl_pro_category set pca_delete=1 where pca_uid='".$pca_uid."'";
			$db->query($sql);
// CONSTRUIMOS EL NUEVO SELECT	
?>
<select name="sub_pca_uid" id="sub_pca_uid" class="input" >
<?php
	$sql = "select pca_uid, pca_name from mdl_pro_category where pca_delete=0 and pca_uid!=6";
	$db2->query($sql);
	while ($content=$db2->next_record())
	{	
	?>
	<option value="<?=$content["pca_uid"]?>"><?=$content["pca_name"]?></option>					
	<?php
	}
?>
</select>		
<a href="javascript:changeOtherCategory('on');" class="small2">agregar</a>  | 
<a href="javascript:deleteOtherCategory();" class="small3"><?=admin::labels('del');?></a>
<div id="div_other_category" style="display:none;">
		<input type="text" name="other_category" id="other_category" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_other_category_error').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_other_category_error').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_other_category_error').style.display='none';"/>		
		<a href="javascript:cagetogyDocsAdd()" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeOtherCategory();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_other_category_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
                </div>