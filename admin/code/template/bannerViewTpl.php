<script language="javascript" type="text/javascript">
function verifyImageUpload(){
	document.getElementById('div_ban_adjunt').style.display="none";
	var cv = document.getElementById('ban_adjunt').value;
	var filepart = cv.split(".");
	var part = filepart.length-1;
	var extension = filepart[part];
	extension = extension.toLowerCase();
	if (extension!='jpg' && extension!='jpeg' && extension!='bmp' && extension!='gif' && extension!='png'){
		document.getElementById('ban_adjunt').value="";
		$('#div_ban_adjunt').fadeIn(500);
	}

}
</script>
<?php 
$sql =  "select distinct mdl_banners.*, mbc_place, mbc_status from mdl_banners, mdl_banners_contents where mbc_ban_uid=ban_uid and ban_uid=".$_REQUEST["ban_uid"]." and mbc_delete=0";
$bannerexist = $db->numrows($sql);  
$db->query($sql);
$banner = $db->next_record();

if ($bannerexist==0) echo '<script language="javascript" type="text/javascript">document.location.href=\'bannerList.php</script>';

?>
<br />
<form name="frmBanner" method="post" action="code/execute/bannerUpd.php" onsubmit="return false;" enctype="multipart/form-data">
<input type="hidden" name="uid" value="<?=$banner["ban_uid"]?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::labels('banner','edit');?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" valign="top"><table width="50%" border="0" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td colspan="3" class="titleBox"><?=admin::labels('data');?></td>
            </tr>
          <tr>
            <td width="29%"><?=admin::labels('banner','title');?>:</td>
            <td width="64%">
<?=$banner["ban_title"]?>
			</td>
          </tr>
                           
         <tr>
            <td valign="top"><?=admin::labels('banner','label');?> (bmp, jpg, jpeg, gif, png):</td>
            <td>
			<?php
			$imgSavedroot1 = PATH_ROOT."/img/banner/thumb_".$banner["ban_file"];
			$imgSaveddomain1 = PATH_DOMAIN."/img/banner/thumb_".$banner["ban_file"];
			$imgSaveddomain2 = PATH_DOMAIN."/img/banner/thumb_".$banner["ban_file"];
			$imgSaveddomain3 = PATH_DOMAIN."/img/banner/img_".$banner["ban_file"];
			if (file_exists($imgSavedroot1) && $banner["ban_file"]!="")
				{
				$extensionFile = admin::getExtension($banner["ban_file"]);
			?>
			<div id="image_edit_<?=$banner["ban_uid"]?>">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableUpload">
			<tr>
				<td width="25%" rowspan="2" align="center" valign="middle" style="padding:4px;">
				<a href="<?=$imgSaveddomain2?>" target="_blank"><img src="<?=$imgSaveddomain1?>?<?=time()?>" border="0" /></a>				</td>
				<td width="75%" style="font-size:11px;">
				<?=$banner["ban_title"];?><br />
				</td>
			</tr>
			<tr>
				<td height="24">
				<div id="imageChange1" style="display:none">
			<input type="file" name="ban_adjunt" id="ban_adjunt" size="14" style="font-size:11px;" onchange="verifyImageUpload();" /> 
                        
                            <img border="0" src="lib/close.gif" align="top"/>
			
			<span id="div_ban_adjunt" class="error" style="display:none">Solo extenciones bmp, jpg, jpeg, gif, png</span>			</div></td>
			</tr>
			</table>
			</div>
			<div id="image_add_<?=$banner["ban_uid"]?>" style="display:none;"></div>
			<?php	}
			else
				{ ?>
				<input type="file" name="ban_adjunt" id="ban_adjunt" size="32" class="input" onchange="verifyImageUpload();" />
				<span id="div_ban_adjunt" class="error" style="display:none">Solo extenciones bmp, jpg, jpeg, gif, png</span>	
			<?php	} ?>			</td>
          </tr>
        
          <tr>
            <td><?=admin::labels('status');?>:</td>
            <td>
			
            	<?php if ($banner["mbc_status"]=="ACTIVE") echo admin::labels('active'); else admin::labels('inactive');?>
			<span id="div_ban_status" style="display:none;" class="error"></span>			
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
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="77%" height="40"><span class="title">Vista previa</span></td>
          <td width="23%" height="40">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" id="contentListing"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="50%" valign="top">
            <table width="50%" border="0" cellpadding="5" cellspacing="5" class="box">
                <tr>
                    <td>
                        <img src="<?=$imgSaveddomain3?>?<?=time()?>" border="0" />
                    </td>
                </tr>

            </table>
              </td></tr></table>
          </td></tr></table>
      
      <br /><br />
      <div id="contentButton">
	  	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
                            <td width="59%" align="center" >
				<a href="bannerList.php" class="button">Volver</a>  
				</td>
          
        </tr>
      </table></div>
      <br /><br />
<br /><iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>