<?php
include_once("../../database/connection.php");  
include_once("../../core/admin.php");
admin::initialize('banner','bannerList',false); 

$sSQL ="select mbc_place from mdl_banners_contents where mbc_delete=0 and mbc_status='ACTIVE'";   
$db->query($sSQL);   
while ($values=$db->next_record())
{
			echo "subList_".admin::imageName($values["mbc_place"]);
			$subList = admin::getParam("subList_".admin::imageName($values["mbc_place"]));
            if ($subList !='')
            {
	            for ($i=0;$i<count($subList);$i++)
	            {
					$sSQL2 = "update mdl_banners_contents set mbc_position=".$i." where mbc_ban_uid=".$subList[$i];
					echo $sSQL2;
                    $db3->query($sSQL2); 
                }
            }
}
?>