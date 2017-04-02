<?php
include ("../../core/admin.php"); 

$lin_family = admin::toSql(admin::getParam("lin_family"),"String");

$Exists = admin::getDbValue("SELECT count(DISTINCT prc_level) FROM mdl_subasta_categories WHERE prc_family = '".$lin_family."' and prc_level!=''");
if ($Exists>0)
{
	 
$sql ="SELECT DISTINCT prc_level
		FROM mdl_subasta_categories
		WHERE prc_family = '".$lin_family."' and prc_level!=''";
$db3->query($sql);

?>
   <select id="line3" name="line3" class="txt10">
       <option value="">Todos</option>
       <?php while ($category_list = $db3->next_record()) { ?>
       <option value="<?=$category_list["prc_level"]?>" <?php if ($Line==$category_list["prc_level"]) echo "selected";?>>
       <?=ucfirst(strtolower($category_list["prc_level"]))?>
       </option>
       <?php } ?>
   </select>
<?php 
} 
?>