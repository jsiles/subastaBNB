<?php
include_once("../../core/admin.php");
admin::initialize('docs','docsNew',false); 
$itemList=admin::getParam("itemList");

if ($itemList!='')
    {
	for ($i=0;$i<count($itemList);$i++)
		{
		$position = $i + 1;
		$sSQL = "update mdl_docs_category
				 set dca_position=" . $position . " 
				 where dca_uid=" . $itemList[$i];
		$db->query($sSQL); 
		}
	}
?>