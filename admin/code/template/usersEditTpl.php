<?php
$use_uid=admin::toSql($_REQUEST["use_uid"],"String");
$sql = "select *,DATE_FORMAT(use_datenac,'%d/%m/%Y') as use_fecha from mdl_users where use_uid=" . $use_uid;
//echo $sql;die;
$db->query($sql);
$regusers = $db->next_record();
?>
<br />
<form name="frmUsers" method="post" action="code/execute/usersUpd.php" enctype="multipart/form-data" onsubmit="return false;">
<input type="hidden" id="use_uid" name="use_uid" value="<?=$use_uid?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::labels('user','edit');?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td colspan="3" class="titleBox"><?=admin::labels('data');?></td>
            </tr>
			<tr>
			<td width="16%"><?=admin::labels('firstname');?>:</td>
			<td width="84%">
			<input name="use_name" type="text" class="input" id="use_name" onfocus="setClassInput(this,'ON');document.getElementById('div_use_name').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_use_name').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_use_name').style.display='none';" value="<?=$regusers["use_name"]?>" size="40"/><br /><span id="div_use_name" style="display:none;" class="error"><?=admin::labels('users','nameerror');?></span>
			</td>
		</tr>
		<tr>
			<td width="16%"><?=admin::labels('lastname');?>:</td>
			<td width="84%">
			<input name="use_lastname" type="text" class="input" id="use_lastname" onfocus="setClassInput(this,'ON');document.getElementById('div_use_lastname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_use_lastname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_use_lastname').style.display='none';" value="<?=$regusers["use_lastname"]?>" size="40"/><br /><span id="div_use_lastname" style="display:none;" class="error"><?=admin::labels('users','lasterror');?></span>
			</td>
			</tr>	
		<tr>
		<td><?=admin::labels('birthday');?>:</td>
            <td>
			
			
			
			<table border="0" cellpadding="0" cellspacing="0" width="41%">
				<tr><td width="45%" valign="middle"> 
				<input name="use_datenac" type="text" class="input3"  id="use_datenac" value="<?=$regusers["use_fecha"]?>" size="20">
				</td><td width="55%" valign="middle">
				<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmUsers.use_datenac);return false;" >
				<img border="0" src="calendario/icon_calendar.gif">
				</a>
				</td>
				</tr>
			</table>			</td>
          </tr>
          <tr>
            <td><?=admin::labels('gender');?>:</td>
            <td>
			<select name="use_gender" id="use_gender" class="txt10">
			<option <? if ($regusers["use_gender"]=='M') echo "selected"; ?> value="M">Masculino</option>
			<option <? if ($regusers["use_gender"]=='F') echo "selected"; ?> value="F">Femenino</option>
			</select>
			</td>
		</tr>
		<tr>
		  <td width="16%"><?=admin::labels('country');?>:</td>
            <td width="84%"><input name="use_country" type="text" class="input" id="use_country"  onfocus="setClassInput(this,'ON');document.getElementById('div_use_country').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_use_country').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_use_country').style.display='none';" size="40" value="<?=$regusers["use_country"]?>">
              <br /><span id="div_use_country" style="display:none;" class="error"><?=admin::labels('users','countryreq');?></span>
			  </td>
		  </tr>
		  <tr>
		  <td width="16%"><?=admin::labels('city');?>:</td>
            <td width="84%"><input name="use_city" type="text" class="input" id="use_city"  onfocus="setClassInput(this,'ON');document.getElementById('div_use_city').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_use_city').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_use_city').style.display='none';" size="40" value="<?=$regusers["use_city"]?>">
             <br /><span id="div_use_city" style="display:none;" class="error"><?=admin::labels('users','cityreq');?></span>
			  </td>
		  </tr>
		   <tr>
		  <td width="16%"><?=admin::labels('address');?>:</td>
            <td width="84%"><input name="use_address" type="text" class="input" id="use_address"  onfocus="setClassInput(this,'ON');document.getElementById('div_use_address').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_use_address').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_use_address').style.display='none';" size="40" value="<?=$regusers["use_address"]?>">
			<br /><span id="div_use_address" style="display:none;" class="error"><?=admin::labels('users','addressreq');?></span>
			</td>
          </tr>
		  <tr>
		  <td width="16%"><?=admin::labels('phone');?>:</td>
            <td width="84%"><input name="use_phone" type="text" class="input" id="use_phone"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" size="40"  value="<?=$regusers["use_phone"]?>"/>
              <span id="div_use_phone" style="display:none;" class="error"></span>			</td>
		  </tr>
		  <tr>
		  <td width="16%"><?=admin::labels('cellular');?>:</td>
            <td width="84%"><input name="use_cellular" type="text" class="input" id="use_cellular"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" size="40" value="<?=$regusers["use_cellular"]?>"/>
              <span id="div_use_cellular" style="display:none;" class="error"></span>			</td>
		  </tr>
		  <td width="16%"><?=admin::labels('email');?>:</td>
            <td width="84%">
<input name="use_email" type="text" class="input3" id="use_email" onfocus="setClassInput3(this,'ON');document.getElementById('div_use_email').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_use_email').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_use_email').style.display='none';" size="40" value="<?=$regusers["use_mail"]?>" />
<br />
<span id="div_use_email" style="display:none;" class="error"><?=admin::labels('users','mailerror');?></span>			
			</td>
          </tr>
		   <tr>
            <td width="16%" valign="top"><?=admin::labels('login','password');?>:</td>
            <td width="84%">
			<div id="pass_view">
			xxxxxxxxxxxxx <a href="javascript:void(0);" onclick="document.getElementById('pass_view').style.display='none';$('#pass_edit').fadeIn(500);" title="<?=admin::labels('change');?>" class="small2"><?=admin::labels('change');?></a>
			</div>
			<div id="pass_edit" style="display:none;">
<input name="use_password" type="password" class="input" id="use_password" onfocus="setClassInput(this,'ON');document.getElementById('div_use_password').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_use_password').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_use_password').style.display='none';" size="20" /> <a href="javascript:void(0);" onclick="document.getElementById('use_password').value='';document.getElementById('pass_edit').style.display='none';$('#pass_view').fadeIn(500);document.getElementById('div_use_password').style.display='none';"  class="small3"> cancelar</a>
			</div>
<span id="div_use_password" style="display:none;" class="error"><?=admin::labels('users','passreq');?></span>
			</td>
		</tr>
		  <tr>
            <td width="16%"><?=admin::labels('photo');?>:</td>
            <td width="84%">
			<?php
			$imgSavedroot1 = PATH_ROOT . "/admin/upload/users/thumb_" . $regusers["use_image"];
			$imgSaveddomain1 = PATH_DOMAIN . "/admin/upload/users/thumb_" . $regusers["use_image"];
			$imgSaveddomain2 = PATH_DOMAIN . "/admin/upload/users/" . $regusers["use_image"];
			//echo $imgSaveddomain2;die;
			if (file_exists($imgSavedroot1) && $regusers["use_image"]!="")
				{
			?>
			<div id="image_edit_<?=$regusers["use_uid"]?>" style="width:300px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableUpload">
			<tr>
				<td width="25%" rowspan="2" align="center" valign="middle" style="padding:4px;">
				<a href="<?=$imgSaveddomain2?>" target="_blank"><img src="<?=$imgSaveddomain1?>" border="0" /></a>				</td>
				<td width="75%" style="font-size:11px;">
				<?=$regusers["use_image"]?> <br />
				<a href="javascript:viewInputFile('on')" title="<?=admin::labels('change');?>" class="small2"><?=admin::labels('change');?></a>
				<span class="pipe">|</span> <a href="#" onclick="removeImg(<?=$regusers["use_uid"]?>);return false;" title="<?=admin::labels('del')?>" class="small3"><?=admin::labels('del')?></a>				</td>
			</tr>
			<tr>
				<td height="24">
				<div id="imageChange1" style="display:none">
				<input type="file" name="use_image" id="use_image" size="14" style="font-size:11px;">  <a href="javascript:viewInputFile('off')" onclick="document.getElementById('use_image').value='';"><img border="0" src="lib/close.gif" align="top"/></a>
				</div>
				</td>
			</tr>
			</table>
			</div>
			<div id="image_add_<?=$regusers["use_uid"]?>" style="display:none;">			</div>
			<?php	}
			else
				{ ?>
				<input type="file" name="use_image" id="use_image" size="32" class="input">
			<?php	} ?>
			</td>
          </tr>
          <tr>
            <td><?=admin::labels('status');?>:</td>
            <td>
			<select name="use_status" class="txt10" id="use_status">
            	<option <? if ($regusers["use_status"]=='ACTIVE') echo "selected"; ?> value="ACTIVE"><?=admin::labels('active');?></option>
              	<option <? if ($regusers["use_status"]=='INACTIVE') echo "selected"; ?> value="INACTIVE"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_col_status" style="display:none;" class="error"></span>
			</td>
          </tr>
          
        </table></td>
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
				<a href="javascript:verifyUsers(2);" class="button">
				<?=admin::labels('update');?>
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="usersList.php" ><?=admin::labels('cancel');?></a> 
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
