<?php
include_once("../../core/admin.php");
admin::initialize('dpf','dpfList',false); 
$itemList=admin::getParam("itemList");
if ($itemList!='')
    {
	for ($i=0;$i<count($itemList);$i++)
		{
		$position = $i + 1;
		$sSQL = "update mdl_indicadores set ind_position=".$position." where ind_uid=".$itemList[$i];
		$db->query($sSQL); 
		}
	}
?>