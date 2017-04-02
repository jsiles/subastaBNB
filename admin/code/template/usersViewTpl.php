<?
$use_uid=$_REQUEST["use_uid"];
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
    <td width="77%" height="40"><span class="title"><?=admin::labels('user','view');?></span></td>
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
			<td width="84%"><?=$regusers["use_name"]?>
			</td>
		</tr>
		<tr>
			<td width="16%"><?=admin::labels('lastname');?>:</td>
			<td width="84%"><?=$regusers["use_lastname"]?></td>
			</tr>	
		<tr>
		<td><?=admin::labels('birthday');?>:</td>
            <td>
			<?=$regusers["use_fecha"]?></td>
          </tr>
          <tr>
            <td><?=admin::labels('gender');?>:</td>
            <td><? if ($regusers["use_gender"]=='M') echo "Masculino"; else echo "Femenino"; ?>
			</td>
		</tr>
		<tr>
		  <td width="16%"><?=admin::labels('country');?>:</td>
            <td width="84%"><?=$regusers["use_country"]?></td>
		  </tr>
		  <tr>
		  <td width="16%"><?=admin::labels('city');?>:</td>
            <td width="84%"><?=$regusers["use_city"]?></td>
		  </tr>
		   <tr>
		  <td width="16%"><?=admin::labels('address');?>:</td>
            <td width="84%"><?=$regusers["use_address"]?></td>
          </tr>
		  <tr>
		  <td width="16%"><?=admin::labels('phone');?>:</td>
            <td width="84%"><?=$regusers["use_phone"]?></td>
		  </tr>
		  <tr>
		  <td width="16%"><?=admin::labels('cellular');?>:</td>
            <td width="84%"><?=$regusers["use_cellular"]?></td>
		  </tr>
		  <td width="16%"><?=admin::labels('email');?>:</td>
            <td width="84%"><?=$regusers["use_mail"]?></td>
          </tr>
		   <tr>
            <td width="16%" valign="top"><?=admin::labels('login','password');?>:</td>
            <td width="84%">xxxxxxxxxxxxx</td>
		</tr>
		  <tr>
            <td width="16%"><?=admin::labels('photo');?>:</td>
            <td width="84%">
			<?
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
				<?=$regusers["use_image"]?></td>
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
			<?	} ?>
			</td>
          </tr>
          <tr>
            <td><?=admin::labels('status');?>:</td>
            <td><? if ($regusers["use_status"]=='ACTIVE') echo admin::labels('active'); else echo admin::labels('inactive'); ?></td>
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
				<a href="usersList.php" class="button">
				<?=admin::labels('cancel');?>
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
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
