<?
$mod_uid=admin::toSql(admin::getParam("mod_uid"),"Number");
if (!$mod_uid) header('Location: ../modulesList.php);
$sql="select * from sys_modules where mod_language='".$lang."' AND mod_uid=".admin::toSql(admin::getParam("mod_uid"),"Number");
$db->query($sql);
$modules = $db->next_record();
$parent = admin::getDbValue("select mod_parent from sys_modules where mod_uid=".$modules["mod_parent"]);
?>
<br />
<form name="frmModules" method="post" action="code/execute/modulesUpd.php" enctype="multipart/form-data" >
<input type="hidden" name="mod_uid" id="mod_uid" value="<?=$modules["mod_uid"]?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="77%" height="40">
		<span class="title"><?=admin::modulesLabels('modulesNew');?></span>
		</td>
		<td width="23%" height="40">&nbsp;</td>
	</tr>
  	<tr>
    	<td colspan="2" id="contentListing">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		 	<tr>
			<td width="50%" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td width="57%" valign="top" rowspan="2">
		<table border="0" cellpadding="0" cellspacing="0" width="98%"  class="box">
			<tr><td height="367" valign="top">
			<table width="100%" border="0" cellpadding="5" cellspacing="5" class="box">			
				<tr>
				<td colspan="2" class="titleBox"><?=admin::labels('data');?></td>
				</tr>
				<tr>
				<td width="29%"><?=admin::labels('modules','name');?>:</td>
				<td width="64%">
	<input name="mod_name" type="text" class="input" id="mod_name" onfocus="setClassInput(this,'ON');document.getElementById('div_mod_name').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_mod_name').style.display='none';" size="50" value="<?=$modules["mod_name"]?>" />
<br /><span id="div_mod_name" style="display:none; padding-left:5px; padding-right:5px;" class="error">Nombre de modulo requerido</span>
				</td>
			  	</tr>
		<tr>
			<td valign="top"><?=admin::labels('modules','alias');?>: </td>
			<td>
            <input name="mod_alias" type="text" class="input" id="mod_alias" onfocus="setClassInput(this,'ON');document.getElementById('div_mod_alias').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_mod_alias').style.display='none';"  size="50" value="<?=$modules["mod_alias"]?>" />
			<br /><span id="div_mod_alias" style="display:none;" class="error">Alias requerido</span>
			</td>
		</tr>
		<tr>
			<td valign="top"><?=admin::labels('modules','php');?>: </td>
			<td>
            <input name="mod_index" type="text" class="input" id="mod_index" onfocus="setClassInput(this,'ON');document.getElementById('div_mod_index').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_mod_index').style.display='none';" size="50" value="<?=$modules["mod_index"]?>" />
			<br /><span id="div_mod_index" style="display:none;" class="error">pagina php requerido</span>
			</td>
		</tr>
          
                   
          <tr>
            <td valign="top"><?=admin::labels('modules','location');?>:</td>
            <td>
			<?php 
			$sql = "select *
						from sys_modules   
						where 
							  mod_delete=0 and
							  mod_parent=0 and 
							  mod_language='".$lang."' 
						order by mod_position";
				$db->query($sql);
				?>
			<div id="div_doc_dca_uid_select">
			<select name="mod_parent" class="listMenu" id="mod_parent" onfocus="this.className='listMenu';document.getElementById('div_doc_dca_uid').style.display='none';">				
			<option <? if($modules["mod_parent"]==0) echo 'selected="selected"';?> value="0">Menu principal</option>
			<? while ($category = $db->next_record())
				{ ?>
				<option  <? if($modules["mod_parent"]==$category["mod_uid"]) echo 'selected="selected"';?> value="<?=$category["mod_uid"]?>"><?=$category["mod_name"]?></option>
				<? } ?>				
            </select>			
						</div>
                 <span id="div_doc_dca_uid" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('docs','prcerror');?></span>       
					</td>
          </tr>
		  
          <tr>
            <td valign="top"><?=admin::labels('status');?>:</td>
            <td><select name="mod_status" class="listMenu" id="mod_status">
            	<option <? if($modules["mod_status"]=='ACTIVE') echo 'selected="selected"';?> value="ACTIVE"><?=admin::labels('active');?></option>
              	<option <? if($modules["mod_status"]=='INACTIVE') echo 'selected="selected"';?> value="INACTIVE"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_bal_status" style="display:none;" class="error"></span>
			</td>
          </tr>
        </table>
			</td>
		</tr>
	</table>
		</td>
        
		</tr>
		<tr>
		<td valign="top" style="padding-top:15px;" width="98%">

		</td>
      </tr>
    </table>
	</td>
      </tr>
    </table></td>
    </tr>
</table>
 
      
</form>
<br />
<br />
<div id="contentButton">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		<td width="59%" align="center">
		<a href="javascript:verifyModules();" class="button">
		<?=admin::labels('public');?>
		</a> 
		</td>
		<td width="41%" style="font-size:11px;">
		<?=admin::labels('or');?> <a href="modulesList.php" ><?=admin::labels('cancel');?></a> 
		</td>
		</tr>
	</table>
</div>
<br /><br /><br /><br /><br /><br />
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>