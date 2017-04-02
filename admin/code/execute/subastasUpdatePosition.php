<?php
include_once("../../core/admin.php");
admin::initialize("subasta","subastaposition");
$sql = "select pca_uid 
		from mdl_subasta_category  
		left join mdl_subasta_category_languages on (pca_uid=pcl_pca_uid) 
		where pcl_language='" . $lang . "' 
			  and pca_delete<>1 			  
		order by pca_position asc";
$db->query($sql);
while ($categories = $db->next_record())
	{
	 $subList = admin::getParam("subList_" . $categories["pca_uid"]);
	 		
	if ($subList!='')
		{	
		// llega el valor como 	sub_[Numero] donde [Numero]= producto 
		for ($i=0;$i<count($subList);$i++)
			{
			$position = $i + 1;
			$productData = split("_",$subList[$i]);
			$sql = "update mdl_subasta
					 set pro_position=" . $position . " 
					 where pro_uid=" . $productData[1];
			echo $sql;
			$db->query($sql); 
			}
		}
	}
?>