<?php
$mod_uidParam = admin::getParam("mod_uid");
$sSQL= "select rol_uid,rol_description,rol_delete,rol_status from mdl_roles where rol_delete=0 ";
$nroReg = $db->numrows($sSQL);
$db->query($sSQL);
//$nombreModulo = admin::getDbValue("select mod_name from sys_modules where mod_uid=$mod_uidParam ");

if ($nroReg>0)
	{
	?>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td width="85%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
    <td width="15%" height="40">
        <?php
        $moduleId=3;
        $valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=$moduleId and mop_lab_category='Crear' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){?>
        <a href="<?=admin::modulesLink('createRoles')?>"><?=admin::modulesLabels('createRoles')?></a>
        <?php
        }
        ?>
        &nbsp;
    </td>
    
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
	<?php
$i=1;
while ($user_list = $db->next_record())
	{
	$rol_uid = $user_list["rol_uid"];
	$rol_description = $user_list["rol_description"];
	$rol_status = $user_list["rol_status"];
	//echo $rol_status;
	if ($rol_status=='ACTIVE') $labels_content='status_on';
	else $labels_content='status_off';
	
	if ($i%2==0) $class='row';
	else  $class='row0';
  	?> 
  	<div id="<?=$rol_uid?>" class="<?=$class?>">
<table class="list" width="100%">
	<tr><td width="50%"><?=$rol_description?></td>
	<td align="center" width="12%" height="5">
    <?php 
	$valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=2 and mop_lab_category='Ver' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){?>
		 <a href="rolesView.php?rol_uid=<?=$rol_uid?>">
		<img src="lib/view_es.gif" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>">
		</a>
         <?php }else{
             ?>
                <img src="lib/view_off_es.gif" border="0" title="<?=admin::labels('view')?>" alt="<?=admin::labels('view')?>">
		
                <?php
         }
?>
	</td>
	<td align="center" width="12%" height="5">
    <?php 
	$valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=2 and mop_lab_category='Editar' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){?>
		<a href="rolesEdit.php?rol_uid=<?=$rol_uid?>">
		<img src="lib/edit_es.gif" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
		</a>
        <?php }
        else{
            ?>
            	<img src="lib/edit_off_es.gif" border="0" title="<?=admin::labels('edit')?>" alt="<?=admin::labels('edit')?>">
            <?php
        }
            ?>
	</td>
	<td align="center" width="12%" height="5">
    <?php 
	$valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=2 and mop_lab_category='Eliminar' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){?>
		<a href="#" onclick="removeList(<?=$rol_uid?>);return false;">
		<img src="lib/delete_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
		</a>
        <?php }
        else{
            ?>
            <img src="lib/delete_off_es.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
            <?php
        }
?>
	</td>
	<td align="center" width="14%" height="5">
    <?php 
	$valuePermit=admin::getDBvalue("select moa_status from sys_modules_options,sys_modules_access where mop_uid=moa_mop_uid and mop_status='ACTIVE'and mop_mod_uid=2 and mop_lab_category='Estado' and moa_rol_uid=".$_SESSION['usr_rol']."");
	if($valuePermit=='ACTIVE'){?>
	<div id="status_<?=$rol_uid?>">
	   <a href="javascript:rolesCS('<?=$rol_uid?>','<?=$rol_status?>');">
		<img src="<?=admin::labels($labels_content,'linkImage')?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">
		</a>
	</div>
    <?php }else
    {
        if($rol_status=='ACTIVE') $labels_status="lib/active_off_es.gif";
        else $labels_status="lib/inactive_off_es.gif";
   ?>
  <img src="<?=$labels_status?>" border="0" title="<?=admin::labels($labels_content)?>" alt="<?=admin::labels($labels_content)?>">     
       <?php     
    }?>
	</td>
		</tr>
	</table>
	</div>
	<?php
	$i++;
	}  ?>
    </td>
    </tr>
    
</table><br />
<br />
<br />
<?php 	} 
else
	{ ?>
	<br />
<br />
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

<?php 	} ?>