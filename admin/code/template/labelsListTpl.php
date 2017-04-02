<?php
/**************Begin 1er NIVEL parent=0 ****************************/
$sSQL=" SELECT 2 as label_uid,'tbl_labels' AS label_table,'General' as label_description union SELECT 1 as label_uid,'sys_labels' AS label_table,'Sistema' as label_description";			
$db->query($sSQL);
$nroReg = $db->numrows();
if ($nroReg>0){
	?>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td width="77%" height="40"><span class="title"><?=admin::labels('labels','list')?></span></td>
    <td width="23%" height="40" align="right"><a href="labelsNew.php?token=<?=admin::getParam('token')?>" ><?=admin::labels('labels','new');?></a></td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
<div class="itemList1" id="itemList" style="width:99%"> 
<?php
$i=1;
while ($docs_list = $db->next_record()){
	$label_uid = $docs_list["label_uid"];
	$label_description = $docs_list["label_description"];
	$label_table = $docs_list["label_table"];
	$class = ($i%2==0) ? 'row' : 'row0';
	/**************End 1er NIVEL****************************/
	/**************Begin 2do NIVEL****************************/     
  ?> 
  <div id="category_<?=$label_uid?>" style="display:none;"><?=$class?></div>
      <div class="groupItem" id="<?=$label_uid?>">
            <div id="list_<?=$label_uid?>" class="<?=$class?>" style="width:100%">
                <table class="list" width="100%"><tr><td width="50%">
<?php
	// ************************* en este query se cambiara para el segundo nivel ************************************
	switch ($label_table){
		case 'tbl_labels' : $sSQL = "select distinct lab_category from ".$label_table." WHERE lab_status='ACTIVE' order by lab_category"; break;
		case 'sys_labels' : $sSQL = "select distinct lab_uid as lab_category from ".$label_table." WHERE lab_status='ACTIVE' order by lab_uid"; break;
	}
	$db2->query($sSQL);
	$nrmreg = $db2->numrows();
$j=0;
if ($nrmreg>0) { 
	/**************End 2do NIVEL****************************/
	/**************Begin 1er NIVEL****************************/    
    ?>
	<span id="div_more_<?=$label_uid?>">
		<a href="subList_<?=$label_uid?>" onclick="moreMinusContent('<?=$label_uid?>'); return false;">
			<img src="lib/buttons/more.gif" border="0" alt="<?=admin::labels('more_on')?>" title="<?=admin::labels('more_on')?>">		</a>	</span>
	<span id="div_minus_<?=$label_uid?>" style="display:none;">
		<a href="subList_<?=$label_uid?>" onclick="moreMinusContent('<?=$label_uid?>'); return false;">
		<img src="lib/buttons/minus.gif" border="0" alt="<?=admin::labels('minus_on')?>" title="<?=admin::labels('minus_on')?>">		</a>	</span>
	 <span id="div_more_off_<?=$label_uid?>" style="display:none;">
		<img src="lib/buttons/more_off.gif" title="<?=admin::labels('more_off')?>" alt="<?=admin::labels('more_off')?>">	</span>&nbsp;
	<?php
	/**************End 1er NIVEL****************************/
	/**************Begin 2do NIVEL****************************/
	$swSubmenu=true;                              
	}
else { ?>
	<span><img src="lib/buttons/more_off.gif" title="<?=admin::labels('more_off')?>" alt="<?=admin::labels('more_off')?>"></span>&nbsp;
	<?php
	$swSubmenu=false;
	} 
/**************End 2do NIVEL****************************/
/**************Begin 1er NIVEL****************************/    
    ?>
           <?=$label_description?></td>
	<td align="center" width="12%" height="5" style="display:none">
	<?php
	if ($nrmreg>0){ 
		$stylebuttonOn = "none";
		$stylebuttonOff = "";
		}
	else
		{ 
		$stylebuttonOn = "";  
		$stylebuttonOff = "none";
		}
		?>
		<span id="div_view_off_<?=$cty_url?>" style="display:none"><!--style="display:<1?=$stylebuttonOn?>;"-->
		<img src="lib/view_off_es.gif" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>">		</span>
		<span id="div_view_on_<?=$cty_url?>"> <!--style="display:<1?=$stylebuttonOn?>;"-->
		<a href="../<?=$contentURL?>/<?=$cty_url?>/" target="_blank">
		<img src="lib/view_es.gif" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>">		</a>		</span>	
		</td>
		</tr>
	</table>
<?php
//CREACION DE SUB MENU
//echo "-->" . $swSubmenu;die;
/**************End 1er NIVEL****************************/
/**************Begin 2do NIVEL****************************/
if ($swSubmenu){
	echo "\n";
    ?>
	<div class="subList_<?=$label_uid?>" id="subList_<?=$label_uid?>" style="display:none;width:100%">
	<?php
	}   
if ($nrmreg>0) $arrayscript .="
 SubList[$label_uid]=$nrmreg;
 ";	
 
while ($regSubContent=$db2->next_record()){
   $lab_category = $regSubContent["lab_category"]; 
   $title1 = $regSubContent["lab_category"];  
   $ofl_category = $regSubContent["lca_uid"];  
   $dest = $regSubContent["ofl_stress"]==1 ?  'style=" font-weight:bold;"' : '';
     
?>
<div class="clear"></div>
<div class="groupItem_<?=$label_uid?>" id="<?=$lab_category?>">
    <table class="list1a" width="100%"><tr><td width="50%">
    <li id="lista_<?=$lab_category?>" class="<?=$class?>a">
<?php
/**************End 2do NIVEL****************************/
/**************Begin 3er NIVEL****************************/ 

    	switch ($label_table){
		case 'tbl_labels' : $sSQL3 = "select * from tbl_labels where lab_language='".$lang."' and lab_delete=0 and lab_category='".$lab_category."'  order by lab_uid "; break;
		case 'sys_labels' : $sSQL3 = "select * from sys_labels where lab_language='".$lang."' and lab_delete=0 and lab_uid='".$lab_category."' order by lab_category"; break;
	}

    //echo $sSQL3;
    $db3->query($sSQL3);
    $nrmreg1 = $db3->numrows();
    $k=0;
    if ($nrmreg1>0) { ?>
                        <span id="div_more_<?=$lab_category?>">
                            <a href="treeList_<?=$lab_category?>" onclick="moreMinusSubList('<?=$lab_category?>'); return false;">
                                <img src="lib/buttons/more.gif" border="0" alt="<?=admin::labels('more_on')?>" title="<?=admin::labels('more_on')?>">
                            </a>
                        </span>
                        <span id="div_minus_<?=$lab_category?>" style="display:none;">
                            <a href="treeList_<?=$lab_category?>" onclick="moreMinusSubList('<?=$lab_category?>'); return false;">
                            <img src="lib/buttons/minus.gif" border="0" alt="<?=admin::labels('minus_on')?>" title="<?=admin::labels('minus_on')?>">
                            </a>
                        </span>
                        <span id="div_more_off_<?=$lab_category?>" style="display:none;">
                        <img src="lib/buttons/more_off.gif" title="<?=admin::labels('more_off')?>" alt="<?=admin::labels('more_off')?>">
                        </span>&nbsp;         
                    
        <?php
        $swSubmenu1=true;                              
        }
    else {
        ?>
                    <span><img src="lib/buttons/more_off.gif" title="<?=admin::labels('more_off')?>" alt="<?=admin::labels('more_off')?>"></span>&nbsp;
        <?php
        $swSubmenu1=false;
        } 
/**************End 3er NIVEL****************************/
/**************Begin 2do NIVEL****************************/
    ?>    
            <?=admin::toHtml($title1)?></li></td>
            <td align="center" width="12%" height="5" style="display:none">
    <?php 
    if ($nrmreg1>0) 
        { 
        $stylebuttonOn = "none";
        $stylebuttonOff = "";
        }
    else
        { 
        $stylebuttonOn = "";  
        $stylebuttonOff = "none";
        }
        ?>
        <span id="div_view_off_<?=$lab_category?>" style="display:<?=$stylebuttonOff?>;">
        <img src="lib/view_off_es.gif" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>">
        </span>
        <span id="div_view_on_<?=$lab_category?>" style="display:<?=$stylebuttonOn?>;">
        <a href="../<?=$urlProduct?>/<?=$regContent["col_url"]?>/<?=$regSubContent["col_url"]?>/" target="_blank">
        <img src="lib/view_es.gif" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>">
        </a>
        </span>
    </td>
</tr>
            </table>

<?php
/**************End 2do NIVEL****************************/
/**************Begin 3er NIVEL****************************/ 
//echo "-->" . $swSubmenu;die;
if ($swSubmenu1)
{ 

  //echo "\n";
    ?>
    <div class="treeList_<?=$lab_category?>" id="treeList_<?=$lab_category?>" style="display:none;width:100%">
                                        
    <?php
}   
if ($nrmreg1>0) $arrayscript .="
 subSubList[$lab_category]=$nrmreg1;";
 
while ($regSubContent3=$db3->next_record()){
	switch ($label_table){
		case 'tbl_labels' : $lab_uid = $regSubContent3["lab_uid"]; $title2 = $regSubContent3["lab_label"]; break;
		case 'sys_labels' : $lab_uid = $regSubContent3["lab_category"]; $title2 = $regSubContent3["lab_label"]; break;
	}
 
	$lab_status = $regSubContent3["lab_status"];  
	$labels_content2 = $lab_status =='ACTIVE' ? 'status_on' : 'status_off';
	
	?>
	<div class="groupSubItem_<?=$lab_uid?>" id="groupSubItem_<?=$lab_uid?>_<?=$lab_category?>" style="display:">
	<table class="list2a" width="100%" border="0"><tr><td width="49%">
	<li id="listado_<?=$lab_uid?>_<?=$lab_category?>" class="<?=$class?>a">
		<a href="edit" onclick="label_edit('<?=$lab_uid?>','<?=$lab_category?>','<?=$label_table?>');return false;"><?=$title2;?></a>
	</li>
	</td>
	<td align="center" width="13%" height="5">&nbsp;
	</td>
	<!--td align="center" width="11%" height="5">
	<a href="labelsEdit.php?label_uid=<?=$lab_uid?>&label_category=<?=$lab_category?>&label_table=<?=$label_table?>"><img src="lib/edit_es.gif" border="0" alt="<?=admin::labels('edit')?>" title="<?=admin::labels('edit')?>"></a>
	</td-->
	<td align="left" width="11%" height="5">
	<?=$lab_uid?>
	</td>	            
	<td align="center" width="13%" height="5">
		<a href="removeList" onclick="removeList('<?=$lab_uid?>','<?=$lab_category?>','<?=$label_table?>');return false;">
		<img src="lib/delete_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">		</a>	</td>
	<td align="center" width="14%" height="5">
	<div id="status_<?=$lab_uid?>_<?=$lab_category?>">
	   <a href="javascript:labelsCS('<?=$lab_uid?>','<?=$lab_category?>','<?=$label_table?>','<?=$lab_status?>');">
		<img src="<?=admin::labels($labels_content2,'linkImage')?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
	   </a>
	</div>    
	</td></tr>
	</table>
	</div>                                        
<?php

$k++;
}
if ($swSubmenu1)
{
?>
                                     </div>
                                     </div>
<?php
} else 
{
?> 
                                  </div>
<?php
}
/**************End 3er NIVEL****************************/

$j++;    
}
/**************Begin 2do NIVEL****************************/  
if ($swSubmenu)
	{
	?>
	</div>
	<?php
	}
$i++;
?>
	</div>
</div>
<?php
}  
/**************End 2do NIVEL****************************/
/**************Begin 1er NIVEL****************************/
?>
</div>
    </td>
    </tr>
</table><br />
<br />
<br />
<?php     } 
else
	{ ?>
	<br />
<br />
<div id="itemList"> 
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">   
  <tr>
    <td colspan="2" id="contentListing">
<div  style="background-color: #f7f8f8;">
<table class="list"  width="100%">
	<tr><td height="30px" align="center" class="bold">
	No existen registros.
	</td></tr>	
 </table>
</div>
</td></tr></table>
<?php 	
} 
/**************End 1er NIVEL****************************/ 
?>