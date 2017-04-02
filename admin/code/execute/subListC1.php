<?php
include_once ("../../core/admin.php"); 

$lin_uid = admin::toSql(admin::getParam("lin_uid"),"String");

$Exists = admin::getDbValue("SELECT count(distinct prc_family) FROM mdl_subasta_categories where prc_lin_uid='".$lin_uid."'");

if ($Exists>0)
{	 
$sql = "SELECT distinct prc_family
		FROM mdl_subasta_categories
		where prc_lin_uid='".$lin_uid."'";
$db3->query($sql);

?>
  <select id="line2" name="line2" class="txt10" onchange="subListC2(this);">
       <option value="">Todos</option>
       <? while ($category_list = $db3->next_record()) { ?>
       <option value="<?=$category_list["prc_family"]?>" <? if ($Line==$category_list["prc_family"]) echo "selected";?>>
       <?=ucfirst(strtolower($category_list["prc_family"]))?>
       </option>
       <? } ?>
   </select>
<?php } ?>