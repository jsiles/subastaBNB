<?php
include_once("../../core/admin.php");
admin::initialize('modules','modulesList',false);
$itemList=admin::getParam("itemList");
//parse_str(admin::getParam("data"));
if ($itemList!='')
    {
	for ($i=0;$i<count($itemList);$i++)
		{
		$position = $i + 1;
		$sSQL = "update sys_modules 
				 set mod_position=" . $position . " 
				 where mod_uid=" . $itemList[$i];
		 $db->query($sSQL); 
		}
	}
else                               
    {
	$sSQL ="select * from sys_modules
			where mod_language='".$lang."' and 
				  mod_parent=0 and 
				  mod_delete<>1 
				  order by mod_position asc";   
        $db->query($sSQL);   
        while ($values=$db->next_record())
        {
            $uid = $values['mod_uid'];
            $sSQL1 = "select count(*) as cantidad from sys_modules 
            where mod_language='".$lang."' and mod_parent=".$uid." 
			and mod_delete<>1 order by mod_position asc";
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
                            $sSQL = "update sys_modules set mod_position=" .  $j . " where mod_uid=" . $subList[$i];
                            $db3->query($sSQL); 
                            }
                        }
                    }
        }
    }
?>