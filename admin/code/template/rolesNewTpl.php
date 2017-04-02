<br />
<form name="frmRoles" id="frmRoles" method="post" action="code/execute/rolesAdd.php?token=<?=admin::getParam("token");?>" onsubmit="return false;" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
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
			<input name="rol_name" type="text" class="input" id="rol_name" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_rol_name').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_rol_name').style.display='none';" /><br />
            <span id="div_rol_name" style="display:none;" class="error">Campo Requerido</span>			
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
            <table width="98%" border="0" align="right" cellpadding="0" cellspacing="5" class="box">

         <!-- <tr>
            <td colspan="2" class="titleBox"><?=admin::labels('users','rights');?></td>
          </tr>-->
          
<?php 
$sqldat="select * from sys_modules where mod_language='".$lang."' and mod_parent=0  and  mod_status='ACTIVE' order by mod_position asc"; 


$db3->query($sqldat);
while($row3 = $db3->next_record()){
?>
          <tr <?=$displaynone;?> >
            <td width="1%">
            <input name="mod_uid[<?=$row3["mod_uid"]?>]" type="checkbox" id="mod_uid[<?=$row3["mod_uid"]?>]" value="<?=$row3["mod_uid"]?>" onclick="checkAll('mod_uid[<?=$row3["mod_uid"]?>]')" />
			</td>
                        <td colspan="15"><?=$row3["mod_name"]?></td>
            
          </tr>
         <tr>
                    
        <td width="1%">
        </td>
        <!--<td width="99%">-->
 		<!--	<table class="box" border="0" width="100%">
                            <tr>       -->
 <?php
                $uidModuleAcces='';
		$sql2="select * from sys_modules where mod_language='".$lang."' and mod_parent=".$row3["mod_uid"]." order by mod_uid asc";	
		$db2->query($sql2);
		while($row2 = $db2->next_record()){
                    
                    if(strlen($uidModuleAcces)==0) $uidModuleAcces="(".$row2["mod_uid"];
                    else $uidModuleAcces.= ",".$row2["mod_uid"];
                            
?>
                <div style="display:none">
                    <input name="mod_uid[<?=$row3["mod_uid"]?>][]" id="mod_uid[<?=$row3["mod_uid"]?>][]" type="checkbox"  value="<?=$row2["mod_uid"]?>" />
                    <?=$row2["mod_name"]?> 
                </div>
           
                                <?php	}  
                                //echo $uidModuleAcces;
                                if(strlen($uidModuleAcces)>0)
                                {
                                    $uidModuleAcces.=")";
                        $sSQL = "select mop_uid, mop_mod_uid, mop_lab_category, mop_status from sys_modules_options where mop_mod_uid in ".$uidModuleAcces." order by mop_uid";
                        $cantidadOp=$db->numrows($sSQL);
                        //echo $sSQL;
                        //echo $cantidadOp;
                        if($cantidadOp>0){                                                
			?>
            
                	        <?php
                                $db->query($sSQL);
                                while($options=$db->next_record())
                                {
                                    ($options["mop_status"]=="ACTIVE")?$lblStatus = "":$lblStatus = 'disabled="disabled"';
                                    
                                ?>
                                <td width="1%"><input name="mod_uid[<?=$row3["mod_uid"]?>][<?=$options["mop_mod_uid"]?>][]" id="mod_uid[<?=$row3["mod_uid"]?>][<?=$options["mop_mod_uid"]?>][]" <?=$lblStatus?>  type="checkbox" value="<?=$options["mop_uid"]?>" /></td>
                        	<td width="10%"><?=$options["mop_lab_category"]?></td>
                                <?php
                                }
                                ?>
            <?php
			}
                                }
            ?>
        	<!--</tr>-->

          <!--  </tr>
            </table>-->
               
       <!-- </td>-->
      </tr>

<?php } ?>                    

        </table>
                
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
            <td width="50%" valign="top"><table width="98%" border="0" align="right" cellpadding="0" cellspacing="5" class="box">
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
?>
          <tr>
            <td width="10"><input name="con_uid[<?=$row["con_uid"]?>]" type="checkbox"  id="con_uid[<?=$row["con_uid"]?>]" value="<?=$row["con_uid"]?>" onclick="checkAll('con_uid[<?=$row["con_uid"]?>]')" />
			</td>
            <td><?=$row["col_title"]?>:</td>
          </tr>
<?php
		$sql2="select * 
				from mdl_contents
				left join mdl_contents_languages on (con_uid=col_con_uid)
				where col_language='".$lang."' and 
					  con_parent=".$row["con_uid"]." and 
					  con_delete<>1 
					  and con_uid not in (1) 
				order by con_position asc";	
		
		$db2->query($sql2);
		while($row2 = $db2->next_record()){		
?>
		<tr>
        <td>
        </td>
        <td>
 			<table class="box"><tr>       
            <td width="10"><input name="con_uid[<?=$row["con_uid"]?>][]" type="checkbox"   value="<?=$row2["con_uid"]?>" onclick="checkedVerify('con_uid[<?=$row["con_uid"]?>]')" />
			</td>
            <td><?=$row2["col_title"]?>:</td>
        	</tr></table>
               
        </td>
        
          </tr>

<?php
		}
}?>

        </table>
                
                
                <span id="div_con_uid" style="display:none;" class="error">Seleccione al menos un Contenido</span>
        </td>
          </tr>
		  
        </table>
        
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
				<?=admin::labels('register');?>
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="userList.php?token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table></div>