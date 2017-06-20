<?php
/********BeginResetColorDelete*************/
$arrayscript = "<script>
var items =new Array();
";
/********EndResetColorDelete*************/
$sSQL="select * 
		from mdl_banners_contents, mdl_banners
		where mbc_delete<>1 and mbc_ban_uid=ban_uid
		order by mbc_position ,mbc_ban_uid";
$nroReg = $db->numrows($sSQL);
$db->query($sSQL);

if ($nroReg>0)
	{
	?>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
      <td width="23%" height="40" align="right">
        <?php
        $moduleId=30;
        $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleId and mop_lab_category='Crear' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){?>
              <a href="<?=admin::modulesLink('bannerNew')?>"><?=admin::modulesLabels('bannerNew')?></a>
        <?php
        }
        ?>
          &nbsp;
        
      </td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
<div class="itemList" id="itemList" style="width:99%"> 
<?php
$i=1;
$j=0;
while ($nroReg = $db->next_record())
	{
	$ban_uid = $nroReg["mbc_ban_uid"];
	$ban_position = $nroReg["mbc_position"];

	$ban_title = $nroReg["ban_title"];
	$ban_status = $nroReg["mbc_status"];
	if ($ban_status=='ACTIVE') $labels_content='status_on';
	else $labels_content='status_off';
	if ($i%2==0) $class='row';
	else  $class='row0';
	/********BeginResetColorDelete*************/  
	$arrayscript .= "items[$j]=" . $ban_uid . ";";
	/********EndResetColorDelete*************/  
  	?> 
      <div class="groupItem" id="<?=$ban_uid?>">
            <div id="list_<?=$ban_uid?>" class="<?=$class?>" style="width:100%">
<table class="list" width="100%">
	<tr><td width="50%"><?=$ban_title?></td>
	<td align="center" width="12%" height="5">
		   
	</td>
        <td align="center" width="5%" height="5">
            <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=29 and mop_lab_category='Ver' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if($valuePermit=='ACTIVE'){
                ?>
		<a href="bannerView.php?ban_uid=<?=$ban_uid?>">
                    <img src="<?=admin::labels('view','linkImage')?>" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>">
		</a>
            <?php
                }else{
            ?>
                    <img src="lib/view_off_es.gif" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>">
            <?php
                }
            ?>
	</td>
	<td align="center" width="5%" height="5">
            <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=29 and mop_lab_category='Editar' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if($valuePermit=='ACTIVE'){
                ?>
		<a href="bannerEdit.php?ban_uid=<?=$ban_uid?>">
                    <img src="<?=admin::labels('edit','linkImage')?>" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
		</a>
            <?php
                }else{
            ?>
                    <img src="lib/edit_off_es.gif" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
            <?php
                }
            ?>
	</td>
	<td align="center" width="5%" height="5">
            <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=29 and mop_lab_category='Eliminar' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if($valuePermit=='ACTIVE'){
                ?>
		 <!--********BeginResetColorDelete*************-->
		<a href="removeList" onclick="removeList(<?=$ban_uid?>);return false;">
		<!--********EndResetColorDelete*************-->
                    <img src="<?=admin::labels('delete','linkImage')?>" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
		</a>
            <?php
                }else{
            ?>
                 <img src="lib/delete_off_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
            <?php
                }
            ?>
	</td>
	<td align="center" width="5%" height="5">
	<div id="status_<?=$ban_uid?>">
            <?php
                $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=29 and mop_lab_category='Estado' and moa_rol_uid=".$_SESSION['usr_rol']."");
                if($valuePermit=='ACTIVE'){
                ?>
                <a href="javascript:void(0);" onclick="bannerCS('<?=$ban_uid?>','<?=$ban_status?>');">
                    <img src="<?=admin::labels($labels_content,'linkImage')?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
		</a>
            <?php 
                }else{
                     $status = ($ban_status=='ACTIVE') ? 'active_off_es.gif':'inactive_off_es.gif';
            ?>
                    <img src="lib/<?=$status?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
            <?php }
            ?>
	</div>
	</td>
		</tr>
	</table>
	</div>
</div>
	<?php
	$j++;
	$i++;
	}  ?>
</div>
    </td>
    </tr>
</table><br />
<br />
<br />
<?php
/********BeginResetColorDelete*************/    
$arrayscript .= "
function resetOrderRemove(uid)
	{
	var nvector = new Array();
	j=0;
	for (i=0;i<items.length;i++)
		{
		if (items[i]!=uid)
			{
			nvector[j]= items[i]; 
			j++; 
			}
		 }
	 for (i=0;i<nvector.length;i++)
		{
		if (i%2!=0) document.getElementById('list_'+ nvector[i]).className='row';
		else document.getElementById('list_'+ nvector[i]).className='row0';
		}
	items=nvector;
	}
</script>\n";
echo $arrayscript;
/********EndResetColorDelete*************/  

 	} 
else
	{ ?>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">   
    <tr>
      <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
      <td width="23%" height="40" align="right">
        <?php
        $moduleId=30;
        $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleId and mop_lab_category='Crear' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){?>
              <a href="<?=admin::modulesLink('bannerNew')?>"><?=admin::modulesLabels('bannerNew')?></a>
        <?php
        }
        ?>          
          &nbsp;
      </td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
<div  style="background-color: #f7f8f8;">
<table class="list"  width="100%">
   
    
	<tr><td height="30px" align="center" class="bold">
	No existen registros
	</td></tr>	
 </table>
</div>
</td></tr></table>

<?php 	} ?>