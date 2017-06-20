<?php
$rol_uid = admin::toSql(admin::getParam("rol_uid"),"Number");
$titleRol=admin::getDBvalue("SELECT rol_description FROM mdl_roles where rol_uid=".$rol_uid);
?>
<br />
<form name="frmRoles" method="post" action="code/execute/rolesUpd.php" onsubmit="return false;" enctype="multipart/form-data">
<input name="rol_uid" type="hidden" value="<?=$rol_uid?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::labels('roles','edit');?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="2" id="contentListing">
    	
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        <td width="50%" valign="top">
        
        <table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td width="15%"><?=admin::labels('user','nameRol');?>:</td>
            <td >
			<input name="rol_name" type="text" class="input" id="rol_name" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_rol_name').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_rol_name').style.display='none';" value="<?=$titleRol?>" />
            <br /><span id="div_rol_name" style="display:none;" class="error">Campo Requerido</span>			
            </td>
           </tr>
         </table>
         <br />
         <table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td colspan="2" class="titleBox">Modulos:</td>
          </tr>
          
           <tr>
            <td width="50%" valign="top">
            <table width="98%" border="0"  align="right" cellpadding="0" cellspacing="5" class="box">

          <!--<tr>
            <td colspan="2" class="titleBox"><?=admin::labels('users','rights');?></td>
          </tr>-->
          
<?php 
$sqldat="select * from sys_modules where mod_language='".$lang."' and mod_parent=0  and  mod_status='ACTIVE' order by mod_position asc"; //and mod_uid!=1
$db->query($sqldat);
while($row = $db->next_record()){
$OnOff3 =admin::getDBvalue("select count(mus_uid) from sys_modules_users where mus_rol_uid='".$rol_uid."' and mus_mod_uid=".$row["mod_uid"]." and mus_delete=0 and mus_place='MODULE'");
		if ($OnOff3!=0) $OnOff3='checked="checked"';
		else $OnOff3='';		
?>
          <tr <?=$displaynone;?> >
            <td width="1%">
            <input name="mod_uid[<?=$row["mod_uid"]?>]" type="checkbox" id="mod_uid[<?=$row["mod_uid"]?>]" <?=$OnOff3?> value="<?=$row["mod_uid"]?>" onclick="checkAll('mod_uid[<?=$row["mod_uid"]?>]')" />
			</td>
                        <td colspan="15"><?=$row["mod_name"]?></td>
            
          </tr>
       <tr>
                    
        <td width="1%">
        </td>
        <!--<td>
 			<table class="box" border="0" width="100%">-->
			 <?php
                         $uidModuleAcces='';
             $sql2="select mod_uid,mod_name from sys_modules where mod_language='".$lang."' and 
                          mod_parent=".$row["mod_uid"]." order by mod_uid asc";
					
                    $db2->query($sql2);
                    //echo $sql2."<br>";
                    while($row2 = $db2->next_record()){	
            			$OnOff4 =admin::getDBvalue("select count(mus_uid) from sys_modules_users where mus_rol_uid='".$rol_uid."' and mus_mod_uid=".$row2["mod_uid"]." and mus_delete=0 and mus_place='MODULE'");
                    	if ($OnOff4!=0) $OnOff4='checked="checked"';
                    	else $OnOff4='';
                         if(strlen($uidModuleAcces)==0) $uidModuleAcces="(".$row2["mod_uid"];
                    else $uidModuleAcces.= ",".$row2["mod_uid"];
                   
            ?>
             <div style="display:none">
                <input name="mod_uid[<?=$row["mod_uid"]?>][]" id="mod_uid[<?=$row["mod_uid"]?>][]" type="checkbox"  <?=$OnOff4?> value="<?=$row2["mod_uid"]?>"  />
		<?=$row2["mod_name"]?>
            </div>
             <?php
                    }
                    if(strlen($uidModuleAcces)>0)
                                {
                        $uidModuleAcces.=")";
                        $sSQL = "select mop_uid, mop_mod_uid, mop_lab_category, mop_status from sys_modules_options where mop_mod_uid in ".$uidModuleAcces." order by mop_uid";
                        $cantidadOp=$db4->numrows($sSQL);
                        //echo $sSQL."<br>";
                        //echo $cantidadOp."<br>";
                        if($cantidadOp>0){                          
                            
	                     $db4->query($sSQL);
                                while($options=$db4->next_record())
                                {
                                    $active = admin::getDbValue("select moa_status from sys_modules_access where moa_mop_uid=".$options["mop_uid"]." and moa_rol_uid=$rol_uid");
                                    //echo "select moa_status from sys_modules_access where moa_mop_uid=".$options["mop_uid"]." and moa_rol_uid=$rol_uid"."<BR>";
                                    if($active=='ACTIVE') $checked='checked';
                                    else $checked='';
                                    ($options["mop_status"]=="ACTIVE")?$lblStatus = "":$lblStatus = 'disabled="disabled"';
                                ?>
                                <td width="1%"><input name="mod_uid[<?=$row["mod_uid"]?>][<?=$options["mop_mod_uid"]?>][]" <?=$checked?> type="checkbox" value="<?=$options["mop_uid"]?>" <?=$lblStatus?> /></td>
                        	<td  width="10%"><?=$options["mop_lab_category"]?></td>
                                <?php
                                }
                              
                                }
                                
                                }
            ?>
        	</tr>
            
	<?php	} ?>            
            
	
       </table>&nbsp;
        </td>
          </tr>
		  
        </table>
         </td>
                
        <td width="50%" valign="top">
        <table width="98%" border="0" cellpadding="5" cellspacing="5" class="box" style="display:none">
         
		   <tr>
            <td colspan="2" class="titleBox">Contenidos:</td>
          </tr> 
           <tr>
            <td width="50%" valign="top">
            <table width="98%" border="0"  align="right" cellpadding="0" cellspacing="5" class="box">
<?php 
$sqldat="select * 
		from mdl_contents
		left join mdl_contents_languages on (con_uid=col_con_uid)
		where col_language='".$lang."' and 
			  con_parent=0 and 
			  con_delete<>1 
			  and con_uid not in (1) 
		order by con_position asc";	

$db->query($sqldat);
while($row = $db->next_record()){
		$OnOff =admin::getDBvalue("select count(mus_uid) from sys_modules_users where mus_rol_uid='".$rol_uid."' and mus_mod_uid=".$row["con_uid"]." and mus_delete=0 and mus_place='CONTENT'");
		if ($OnOff!=0) $OnOff='checked="checked"';
		else $OnOff='';
?>
          <tr>
            <td width="10"><input name="con_uid[<?=$row["con_uid"]?>]" type="checkbox" id="con_uid[<?=$row["con_uid"]?>]" <?=$OnOff?> value="<?=$row["con_uid"]?>" onclick="checkAll('con_uid[<?=$row["con_uid"]?>]')" />
			</td>
            <td><?=$row["col_title"]?></td>
          </tr>
<?php
		$sql2="select * 
				from mdl_contents
				left join mdl_contents_languages on (con_uid=col_con_uid)
				where col_language='".$lang."' and 
					  con_parent=".$row["con_uid"]." and 
					  con_delete<>1 
				order by con_position asc";	
		
		$db2->query($sql2);

		while($row2 = $db2->next_record()){
		$OnOff2 =admin::getDBvalue("select count(mus_uid) from sys_modules_users where mus_rol_uid='".$rol_uid."' and mus_mod_uid=".$row2["con_uid"]." and mus_delete=0 and mus_place='CONTENT'");
		if ($OnOff2!=0) $OnOff2='checked="checked"';
		else $OnOff2='';		
?>
		<tr>
        <td> 
        </td>
        <td>
 			<table border="0"  class="box" width="100%">
            <tr>       
            <td width="10"><input name="con_uid[<?=$row["con_uid"]?>][]" type="checkbox"  <?=$OnOff2?> value="<?=$row2["con_uid"]?>" onclick="checkedVerify('con_uid[<?=$row["con_uid"]?>]')" />
			</td>
            <td><?=$row2["col_title"]?></td>
        	</tr>
  
            </table>
               
        </td>
        
          </tr>
<?php
		}


}?>

        </table><span id="div_con_uid" style="display:none;" class="error">Seleccione al menos un Contenido</span>
        </td>
          </tr>
		  
        </table>
 <!--inicicio  modulos-->        
        </td>
    </tr>
</table>
      </tr>
    </table>
</form>

      <div id="contentButton">
	  	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="59%" align="center">
				<a href="#" onclick="verifyRoles();" class="button">
				Actualizar
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="rolesList.php" ><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table></div>