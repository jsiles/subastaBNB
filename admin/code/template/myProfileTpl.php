<script language="javascript" type="text/javascript">
function verifyProfile()
	{
	var sw = true;
	document.getElementById('div_usr_login').style.display="none";
//	document.getElementById('div_usr_pass').style.display="none";
	document.getElementById('div_usr_firstname').style.display="none";
//	document.getElementById('div_usr_lastname').style.display="none";
	
	if (document.getElementById('usr_login').value=="")
		{
		document.getElementById('div_usr_login').style.display="";
		sw=false;
		}
		
	if (document.getElementById('usr_firstname').value=="")
		{
		document.getElementById('div_usr_firstname').style.display="";
		sw=false;
		}
	/*	
	if (document.getElementById('usr_lastname').value=="")
		{
		document.getElementById('div_usr_lastname').style.display="";
		sw=false;
		}
*/
	if (sw)
		{
		document.frmProfile.submit();
		}
	}
</script>
<?
$sql = "select * 
		from sys_users 
		where usr_uid=" . $_SESSION["usr_uid"];
$db->query($sql);
$profile = $db->next_record();
?>
<br />
<form name="frmProfile" method="post" enctype="multipart/form-data" action="code/execute/myprofileUpd.php" onsubmit="return false;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::labels('myprofile');?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr><td width="50%" valign="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" class="box">
			<tr><td height="232" valign="top">
			<table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
          	<tr>
            <td colspan="3" class="titleBox"><?=admin::labels('user','personaldata');?></td>
            </tr>
          	<tr>
            <td width="29%"><?=admin::labels('login','user');?>:</td>
            <td width="64%">
<input name="usr_login" type="text" class="input" id="usr_login" onfocus="setClassInput(this,'ON');document.getElementById('div_usr_login').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_usr_login').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_usr_login').style.display='none';" value="<?=$profile["usr_login"]?>"/>
<br />
<span id="div_usr_login" style="display:none;" class="error">Nombre del contenido es necesario</span>
			</td>
			<td width="7%"><acronym alt="<?=admin::labels('login','alt');?>" title="<?=admin::labels('login','alt');?>"><!-- <a href="javascript:void(0);"><img src="lib/question_mark.gif" width="16" height="16" border="0" /></a> --></acronym></td>
          	</tr>
		   	<tr>
            <td width="29%"><?=admin::labels('login','password');?>:</td>
            <td width="64%">
<input name="usr_pass" type="password" class="input" id="usr_pass" onfocus="setClassInput(this,'ON');document.getElementById('div_usr_pass').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_usr_pass').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_usr_pass').style.display='none';" value="<? //=$profile["usr_pass"] ?>" />
<br />
<span id="div_usr_pass" style="display:none;" class="error">Nombre del contenido es necesario</span>
			</td>
            <td width="7%"><acronym alt="<?=admin::labels('password','alt');?>" title="<?=admin::labels('password','alt');?>"><!-- <a href="javascript:void(0);"><img src="lib/question_mark.gif" width="16" height="16" border="0" /></a> --></acronym></td>
          </tr>
		  <tr>
            <td width="29%"><?=admin::labels('firstname');?>:</td>
            <td width="64%">
<input name="usr_firstname" type="text" class="input" id="usr_firstname" onfocus="setClassInput(this,'ON');document.getElementById('div_usr_firstname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_usr_firstname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_usr_firstname').style.display='none';" value="<?=$profile["usr_firstname"]?>" />
<br />
<span id="div_usr_firstname" style="display:none;" class="error">Nombre del contenido es necesario</span>
			</td>
            <td width="7%"><acronym alt="<?=admin::labels('firstname','alt');?>" title="<?=admin::labels('firstname','alt');?>"><!-- <a href="javascript:void(0);"><img src="lib/question_mark.gif" width="16" height="16" border="0" /></a> --></acronym></td>
          </tr>
		  <tr>
            <td width="29%"><?=admin::labels('lastname');?>:</td>
            <td width="64%">
<input name="usr_lastname" type="text" class="input" id="usr_lastname" onfocus="setClassInput(this,'ON');document.getElementById('div_usr_lastname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_usr_lastname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_usr_lastname').style.display='none';" value="<?=$profile["usr_lastname"]?>" />
<br /><span id="div_usr_lastname" style="display:none;" class="error">Nombre del contenido es necesario</span>			</td>
            <td width="7%"><acronym alt="<?=admin::labels('lastname','alt');?>" title="<?=admin::labels('lastname','alt');?>"><!-- <a href="javascript:void(0);"><img src="lib/question_mark.gif" width="16" height="16" border="0" /></a> --></acronym></td>
          </tr>
		  <tr>
            <td width="29%"><?=admin::labels('email');?>:</td>
            <td width="64%">
<input name="usr_email" type="text" class="input" id="usr_email" onfocus="setClassInput(this,'ON');document.getElementById('div_usr_email').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_usr_email').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_usr_email').style.display='none';" value="<?=$profile["usr_email"]?>" />
<br /><span id="div_usr_email" style="display:none;" class="error">Nombre del contenido es necesario</span>			</td>
            <td width="7%"><acronym alt="<?=admin::labels('lastname','alt');?>" title="<?=admin::labels('lastname','alt');?>"><!-- <a href="javascript:void(0);"><img src="lib/question_mark.gif" width="16" height="16" border="0" /></a> --></acronym></td>
          </tr>
		   
		  <tr>
            <td width="29%" valign="top"><?=admin::labels('photo');?>:</td>
            <td width="64%" valign="top">
		<? 
		$imgSavedroot1 = PATH_ROOT . "/admin/upload/profile/thumb_" . $profile["usr_photo"];
		$imgSaveddomain1 = PATH_DOMAIN . "/admin/upload/profile/thumb_" . $profile["usr_photo"];
		$imgSaveddomain2 = PATH_DOMAIN . "/admin/upload/profile/img_" . $profile["usr_photo"];
	//	echo $imgSaveddomain1;die;
		if (file_exists($imgSavedroot1) && $profile["usr_photo"]!="") { ?>	
		<div id="image_edit_<?=$profile["usr_uid"]?>">	
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableUpload">
		<tr>
			<td width="25%" rowspan="2" align="center" valign="middle" style="padding:4px;">
			
		<a href="<?=$imgSaveddomain2?>" target="_blank"><img src="<?=$imgSaveddomain1?>" border="0" /></a>
		
			</td>
			<td width="75%" style="font-size:11px;">
			<?=$profile["usr_photo"]?> <br />
			<a href="javascript:viewInputFile('on')" title="<?=admin::labels('change');?>" class="small2"><?=admin::labels('change');?></a>
				<span class="pipe">|</span> <a href="#" onclick="removeImg(<?=$profile["usr_uid"]?>);return false;" title="<?=admin::labels('del')?>" class="small3"><?=admin::labels('del')?></a>				
			</td>
		</tr>
		<tr>
			<td height="24" valign="top">
			<div id="imageChange1" style="display:none">
			<input name="usr_photo" type="file" id="usr_photo" size="13" class="inputbrowser"/>
			<a href="javascript:viewInputFile('off')" onclick="document.getElementById('usr_photo').value='';"><img border="0" src="lib/close.gif" width="15" height="15" align="top"/></a>
			</div>
			</td>
		</tr>
		</table>
		</div>
		<div id="image_add_<?=$profile["usr_uid"]?>" style="display:none;">
			
		</div>
		<? }
		else
			{ ?>
			<input name="usr_photo" type="file" id="usr_photo" size="32" class="input"/>
		<?	}
			?>
		
			</td>
            <td width="7%" valign="top"><acronym alt="<?=admin::labels('photo','alt');?>" title="<?=admin::labels('photo','alt');?>"><!-- <a href="javascript:void(0);"><img src="lib/question_mark.gif" width="16" height="16" border="0" /></a> --></acronym></td>
          </tr>
		 
          <tr style="display:none;">
            <td><?=admin::labels('user','type');?>: </td>
            <td>
						  
	<select name="usr_type" class="txt10" id="usr_type">				
		<option value="USER" <? if ($profile["usr_type"]=="USER") echo "selected"; ?>>USER</option>
		<option value="ADMIN" <? if ($profile["usr_type"]=="ADMIN") echo "selected"; ?>>ADMIN</option>
		<option value="SUPERADMIN" <? if ($profile["usr_type"]=="SUPERADMIN") echo "selected"; ?>>SUPERADMIN</option>				
	</select> 
	<?=$profile["usr_type"]?>
			<span id="div_con_parent" style="display:none;" class="error"></span>

            </td>
            <td><acronym alt="<?=admin::labels('usertype','alt');?>" title="<?=admin::labels('usertype','alt');?>"><!-- <a href="javascript:void(0);"><img src="lib/question_mark.gif" width="16" height="16" border="0" /></a> --></acronym></td>
          </tr>
		  	
          <tr style="display:none;">
            <td><?=admin::labels('status');?>:</td>
            <td>
			<select name="usr_status" class="txt10" id="usr_status">
            	<option selected="selected" value="1"><?=admin::labels('active');?></option>
              	<option value="0"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_col_status" style="display:none;" class="error"></span>	
					
		
			</td>
            <td><acronym alt="<?=admin::labels('status','alt');?>" title="<?=admin::labels('status','alt');?>"><img src="lib/question_mark.gif" alt="?" width="16" height="16" border="0" /></a></acronym></td>
          </tr>
        </table>		
		</td></tr>
		</table>
		
		</td>
        <td width="50%" valign="top"><table width="98%" border="0" align="right" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td colspan="3" class="titleBox"><?=admin::labels('user','generaldata');?></td>
          </tr>
          <tr>
            <td width="22%"><?=admin::labels('phone');?>:</td>
            <td width="71%"><input name="usr_phone" type="text" class="input" id="usr_phone"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" value="<?=$profile["usr_phone"]?>"/>
			<span id="div_usr_phone" style="display:none;" class="error"></span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          <tr>
            <td><?=admin::labels('fax');?>:</td>
            <td><input name="usr_fax" type="text" class="input" id="usr_fax"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" value="<?=$profile["usr_fax"]?>"/>
			<span id="div_usr_fax" style="display:none;" class="error"></span>			</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?=admin::labels('cellular');?>: </td>
            <td><input name="usr_cellular" type="text" class="input" id="usr_cellular"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" value="<?=$profile["usr_cellular"]?>"/>
			<span id="div_usr_cellular" style="display:none;" class="error"></span>			</td>
            <td>&nbsp;</td>
          </tr>
		  <tr>
		  <td width="22%"><?=admin::labels('address');?>:</td>
            <td width="71%"><input name="usr_address" type="text" class="input" id="usr_address"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');"  value="<?=$profile["usr_address"]?>">
			<span id="div_usr_address" style="display:none;" class="error"></span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          <tr>
            <td><?=admin::labels('country');?>:</td>
            <td><input name="usr_country" type="text" class="input" id="usr_country"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" value="<?=$profile["usr_country"]?>"/>
			<span id="div_usr_country" style="display:none;" class="error"></span>			</td>
            <td>&nbsp;</td>
          </tr>
          <tr style="display:none;">
            <td><?=admin::labels('state');?>: </td>
            <td><input name="usr_state" type="text" class="input" id="usr_state"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" value="<?=$profile["usr_state"]?>"/>
			<span id="div_col_metakeyword" style="display:none;" class="error"></span>			</td>
            <td>&nbsp;</td>
		  </tr>
		  <tr>
            <td><?=admin::labels('city');?>: </td>
            <td><input name="usr_city" type="text" class="input" id="usr_city"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" value="<?=$profile["usr_city"]?>"/>
			<span id="div_usr_city" style="display:none;" class="error"></span>			</td>
            <td>&nbsp;</td>
		  </tr>          
        </table></td>
      </tr>
    </table></td>
    </tr>
</table>
      <br />      
	  </form>
      <div id="contentButton">
	  	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="59%" align="center">
				<a href="#" onclick="verifyProfile();" class="button">
				<?=admin::labels('update');?>
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="contentList.php?token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table></div>
      <br /><br />
<br />
<br />

      <br />
      <br />
