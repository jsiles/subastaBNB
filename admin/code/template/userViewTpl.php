<?php
$use_uidA=admin::toSql($_REQUEST["usr_uidA"],"String");
$sql = "select * from sys_users where usr_uid=" . $use_uidA;
$db->query($sql);
$regusers = $db->next_record();
?>
<br />
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
			<?=$regusers["usr_login"]?>
			</td>
		</tr>
        
        <tr>
			<td width="16%"><?=admin::labels('firstname');?>:</td>
			<td width="84%">
			<?=$regusers["usr_firstname"]?>
			</td>
		</tr>
		<tr>
			<td width="16%"><?=admin::labels('lastname');?>:</td>
			<td width="84%">
			<?=$regusers["usr_lastname"]?>
			</td>
			</tr>	
<tr>
		  <td width="16%"><?=admin::labels('email');?>:</td>
            <td width="84%">
			<?=$regusers["usr_email"]?>
	
			</td>
          </tr>
		   
		  <tr>
            <td width="16%"><?=admin::labels('photo');?>:</td>
            <td width="84%">
			<?
			$imgSavedroot1 = PATH_ROOT . "/admin/upload/profile/thumb_" . $regusers["usr_photo"];
			$imgSaveddomain1 = PATH_DOMAIN . "/admin/upload/profile/thumb_" . $regusers["usr_photo"];
			$imgSaveddomain2 = PATH_DOMAIN . "/admin/upload/profile/" . $regusers["usr_photo"];
			if (file_exists($imgSavedroot1) && $regusers["usr_photo"]!="")
				{
			?>
			<div id="image_edit_<?=$regusers["usr_uid"]?>" style="width:300px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableUpload">
			<tr>
				<td width="25%" rowspan="2" align="center" valign="middle" style="padding:4px;">
				<a href="<?=$imgSaveddomain2?>" target="_blank"><img src="<?=$imgSaveddomain1?>" border="0" /></a>				</td>
				<td width="75%" style="font-size:11px;">
				<?=$regusers["usr_photo"]?> </td>
			</tr>
			</table>
			</div>
			<?	}?>
			</td>
          </tr>
          
          <tr>
            <td><?=admin::labels('user','userrol');?>:</td>
            <td>
            <?php
			$UserRol=admin::getDBvalue("select rol_description from mdl_roles, mdl_roles_users where rus_rol_uid=rol_uid and rus_usr_uid=".$regusers["usr_uid"]);
			echo $UserRol;
            ?>
         	</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        
      </tr>
    </table></td>
        
    <td  colspan="2" id="contentListing" width="50%" valign="top">&nbsp;
    
    </td>
        
    </tr>
</table>

      <br />
      <br />
      <div id="contentButton">
	  		<a href="userList.php?token=<?=admin::getParam("token");?>" class="button"><?=admin::labels('back');?></a> 
		</div>
      <br /><br />
<br />
<br />

      <br />
      <br />
<br /><br /><br /><br /><br /><br />
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>