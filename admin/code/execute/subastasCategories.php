<?php
include_once("../../core/admin.php");
admin::initialize('subasta','subastaCat'); 
$prd_uid = $_REQUEST["pro_selected"];
$sql = "select * 
		from mdl_subasta_category  
		left join mdl_subasta_category_languages on (pca_uid=pcl_pca_uid) 
		where pcl_language='" . $lang . "' 
			  and pca_delete<>1 
			  and pca_prd_uid=" . $prd_uid . " 
		order by pca_position asc";		
$db->query($sql);
?>
<select name="pro_pca_uid" id="pro_pca_uid" class="input" onfocus="document.getElementById('div_pro_pca_uid').style.display='none';">
	<option value="0"><?=admin::labelsExecute("select");?></option>	
	<?
	while ($categories = $db->next_record()) { ?>	
	<option value="<?=$categories["pca_uid"];?>"><?=utf8_encode($categories["pcl_title"]);?></option>	
	<?	} ?>
</select>