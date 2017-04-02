<?php
include_once("../../core/admin.php");
admin::initialize('content','contentList',false); 
$itemList=admin::getParam("itemList");
//parse_str(admin::getParam("data"));
if ($itemList!='')
    {
	for ($i=0;$i<count($itemList);$i++)
		{
		$position = $i + 1;
		$sSQL = "update mdl_contents 
				 set con_position=" . $position . " 
				 where con_uid='" . $itemList[$i]."'";
		 $db->query($sSQL); 
		}
	}
else                               
    {
	$sSQL ="select * 
			from mdl_contents
			left join mdl_contents_languages on (con_uid=col_con_uid)
			where col_language='".$lang."' and 
				  con_parent=0 and 
				  con_delete<>1  
			order by con_position asc";   
        $db->query($sSQL);   
        while ($values=$db->next_record())
        {
            $uid = $values['con_uid'];
            $sSQL1 = "select count(*) as cantidad 
            from mdl_contents 
            left join mdl_contents_languages on (con_uid=col_con_uid) 
            where col_language='".$lang."' and con_parent=".$uid." and con_delete<>1 
            order by con_position asc";
            $db2->query($sSQL1);
            $cant = $db2->next_record();
            $nro = $cant['cantidad'];

                if ($nro>1) 
                    {
                     //   echo $nro.'-'.$uid.'<br>';
                        $subList = admin::getParam("subList_".$uid);

                        if ($subList !='')
                        {
                        //    print_r($subList);die;
                        for ($i=0;$i<count($subList);$i++)
                        {
                            $j = $i + 1;
                            $sSQL = "update mdl_contents set con_position=" .  $j . " where con_uid='" . $subList[$i]."'";
                            $db3->query($sSQL); 
                            }
                        }
                    }
        }
    }
?>