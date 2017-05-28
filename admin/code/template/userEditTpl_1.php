<?php
$use_uidA=admin::getSession("usr_uid");
$sql = "select * from sys_users where usr_uid=" . $use_uidA;
$db->query($sql);
$regusers = $db->next_record();
//$rolLogged=admin::getSession("usr_rol");
        
?>
<br />
<form name="frmUsers" method="post" action="code/execute/userUpd_1.php?token=<?=admin::getParam("token");?>" enctype="multipart/form-data" onsubmit="return false;">
<input type="hidden" id="use_uidA" name="use_uidA" value="<?=$use_uidA?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" height="40"><span class="title"><?=admin::labels('user','edit');?></span></td>
    
  </tr>
  <tr>
    <td colspan="2" id="contentListing" width="50%">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td colspan="3" class="titleBox"><?=admin::labels('data');?></td>
            </tr>
            <tr>
			<td width="16%">Usuario:</td>
			<td width="84%">
                            <!--<input name="usr_login" type="text" class="input" id="usr_login" onfocus="setClassInput(this,'ON');document.getElementById('div_usr_login').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_usr_login').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_usr_login').style.display='none';" value="<?=$regusers["usr_login"]?>" size="60"/><br /><span id="div_usr_login" style="display:none;" class="error"><?=admin::labels('users','nameerror');?></span>-->
                            <?=$regusers["usr_login"]?>
			</td>
		</tr>
        <tr>
            <td width="16%" valign="top"><?=admin::labels('login','password');?>:</td>
            <td width="84%">
			<div id="pass_view">
			xxxxxxxxxxxxx <a href="javascript:void(0);" onclick="document.getElementById('pass_view').style.display='none';$('#pass_edit').fadeIn(500);" title="<?=admin::labels('change');?>" class="small2"><?=admin::labels('change');?></a>
			</div>
			<div id="pass_edit" style="display:none;">
<input name="usr_pass" type="text" class="input" id="usr_pass" onfocus="setClassInput(this,'ON');document.getElementById('div_usr_pass').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_usr_pass').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_usr_pass').style.display='none';" size="20" />
<!--<a href="javascript:void(0);" onclick="document.getElementById('usr_pass').value='';document.getElementById('pass_edit').style.display='none';$('#pass_view').fadeIn(500);document.getElementById('div_usr_pass').style.display='none';"  class="small3"> cancelar</a>-->
<a href="pass" onClick="return generarPassword(this.form,'usr_pass',10);">Generar</a>                        
			</div>
<span id="div_usr_pass" style="display:none;" class="error"><?=admin::labels('users','passreq');?></span>
			</td>
		</tr>
			<tr>
			<td width="16%"><?=admin::labels('firstname');?>:</td>
			<td width="84%">
			<input name="usr_firstname" type="text" class="input" id="usr_firstname" onfocus="setClassInput(this,'ON');document.getElementById('div_usr_firstname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_usr_firstname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_usr_firstname').style.display='none';" value="<?=$regusers["usr_firstname"]?>" size="60"/><br /><span id="div_usr_firstname" style="display:none;" class="error"><?=admin::labels('users','nameerror');?></span>
			</td>
		</tr>
		<tr>
			<td width="16%"><?=admin::labels('lastname');?>:</td>
			<td width="84%">
			<input name="usr_lastname" type="text" class="input" id="usr_lastname" onfocus="setClassInput(this,'ON');document.getElementById('div_usr_lastname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_usr_lastname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_usr_lastname').style.display='none';" value="<?=$regusers["usr_lastname"]?>" size="60"/><br /><span id="div_usr_lastname" style="display:none;" class="error"><?=admin::labels('users','lasterror');?></span>
			</td>
			</tr>	
<tr>
		  <td width="16%"><?=admin::labels('email');?>:</td>
            <td width="84%">
<input name="usr_email" type="text" class="input3" id="usr_email" onfocus="setClassInput3(this,'ON');document.getElementById('div_usr_email').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_usr_email').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_usr_email').style.display='none';" size="60" value="<?=$regusers["usr_email"]?>" />
<br />
<span id="div_usr_email" style="display:none;" class="error"><?=admin::labels('users','mailerror');?></span>			
			</td>
          </tr>
		   
		  <tr>
            <td width="16%"><?=admin::labels('photo');?>:</td>
            <td width="84%">
			<?php
			$imgSavedroot1 = PATH_ADMIN . "/upload/profile/thumb_" . $regusers["usr_photo"];
			$imgSaveddomain1 = PATH_DOMAIN . "/admin/upload/profile/thumb_" . $regusers["usr_photo"];
			$imgSaveddomain2 = PATH_DOMAIN . "/admin/upload/profile/" . $regusers["usr_photo"];
			//echo $imgSaveddomain2;die;
			if (file_exists($imgSavedroot1) && $regusers["usr_photo"]!="")
				{
			?>
			<div id="image_edit_<?=$regusers["usr_uid"]?>" style="width:300px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableUpload">
			<tr>
				<td width="25%" rowspan="2" align="center" valign="middle" style="padding:4px;">
				<a href="<?=$imgSaveddomain2?>" target="_blank"><img src="<?=$imgSaveddomain1?>?<?=time();?>" border="0" /></a>				</td>
				<td width="75%" style="font-size:11px;">
				<?=$regusers["usr_photo"]?> <br />
				<a href="javascript:viewInputFile('on')" title="<?=admin::labels('change');?>" class="small2"><?=admin::labels('change');?></a>
				<span class="pipe">|</span> <a href="#" onclick="removeImg(<?=$regusers["usr_uid"]?>);return false;" title="<?=admin::labels('del')?>" class="small3"><?=admin::labels('del')?></a>				</td>
			</tr>
			<tr>
				<td height="24">
				<div id="imageChange1" style="display:none">
				<input type="file" name="usr_photo" id="usr_photo" size="14" style="font-size:11px;">  <a href="javascript:viewInputFile('off')" onclick="document.getElementById('usr_photo').value='';"><img border="0" src="lib/close.gif" align="top"/></a>
				</div>
				</td>
			</tr>
			</table>
			</div>
			<div id="image_add_<?=$regusers["usr_uid"]?>" style="display:none;">			</div>
			<?php	}
			else
				{ ?>
				<input type="file" name="usr_photo" id="usr_photo" size="32" class="input">
			<?php	} ?>
			</td>
          </tr>
          
          <tr>
            <td><?=admin::labels('user','userrol');?>:</td>
            <td>
                <select name="usr_rol" disabled="disabled" class="txt10" id="usr_rol">
            <?php
			$sql2="select rol_uid, rol_description from mdl_roles where rol_delete=0 and rol_status='ACTIVE' ";	
			//die($sql2);
			$db2->query($sql2);
                        $rolUser = admin::getDbValue("select rus_rol_uid from mdl_roles_users where rus_usr_uid=".$regusers["usr_uid"]);
			while($row = $db2->next_record())
			{
            ?>
            	<option <?php if($rolUser==$row["rol_uid"]) echo 'selected="selected"';?> value="<?=$row["rol_uid"]?>"><?=$row["rol_description"]?></option>
            <?php
			}
            ?>
			</select>
			<span id="div_col_status" style="display:none;" class="error"></span>			</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        
      </tr>
    </table></td>
        
    <td  colspan="2" id="contentListing" width="50%" valign="top">&nbsp;
    
    </td>
        
    </tr>
</table>
	  </form>
      <br />
      <br />
      <div id="contentButton">
	  	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="59%" align="center">
				<a href="javascript:verifyUsersEdit();" class="button">
				<?=admin::labels('update');?>
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="userList.php?token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table></div>
      <br /><br />
<br />
<br />

      <br />
      <br />
<br /><br /><br /><br /><br /><br />
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>