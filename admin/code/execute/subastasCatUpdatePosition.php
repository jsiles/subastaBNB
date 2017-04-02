<?php
include_once("../../core/admin.php");
admin::initialize("news","newsposition");
$itemList=admin::getParam("itemList");
//parse_str(admin::getParam("data"));
if ($itemList!='')
    {
	for ($i=0;$i<count($itemList);$i++)
		{
		$position = $i + 1;
		$sSQL = "update mdl_subasta_category
				 set pca_position=" . $position . " 
				 where pca_uid=" . $itemList[$i];
		$db->query($sSQL); 
		}
	}

?>