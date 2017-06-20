<?php
$imgs = admin::getDbValue("select top 1 ban_file from mdl_banners_contents, mdl_banners where mbc_delete=0 and mbc_status='ACTIVE' and mbc_ban_uid=ban_uid order by mbc_position ,mbc_ban_uid");
$ban_name = admin::getDbValue("select top 1 ban_title from mdl_banners_contents, mdl_banners where mbc_delete=0 and mbc_status='ACTIVE' and mbc_ban_uid=ban_uid order by mbc_position ,mbc_ban_uid");

		$conParent = (!empty(admin::getParam("con_parent"))) ? '?con_parent='.admin::getParam("con_parent"): '';
                admin::updateSubasta();
?>
<script language="javascript" type="text/javascript">
    var today = new Date('<?=date("d M Y G:i:s")?>');
function startTime() {

    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('clockSys').innerHTML =
    h + ":" + m + ":" + s;
    today.setSeconds(today.getSeconds()+1);
    var t = setTimeout(startTime, 1000);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top">    
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="header">
        <tr><td height="10px" colspan="3"></td></tr>
      <tr>
          <td width="15%" height="135px"  rowspan="3" align="center"><div style="alignment-adjust: central"><img src="lib/logo.png"></div></td>
        <td width="60%" align="center"><?php if($imgs){?>

					<img src="<?=$domain?>/img/banner/img_<?=$imgs?>?<?=time()?>" alt="<?=$ban_name?>" title="<?=$ban_name?>" border="0"/>
                    <?php }?></td>
		<td width="25%" rowspan="2">
		<div id="changeDiv" style="display:none;">
		<form  method="post" id="change_language" method="post" action="code/execute/langChange.php<?=$conParent;?>" > 
		<?php	if ($_REQUEST["con_uid"]!="")
		$page_uid = "?con_uid=" . $_REQUEST["con_uid"];
		$urlorigin = $_SERVER['PHP_SELF'].$page_uid; ?>
		<input type="hidden" name="origin" value="<?=$urlorigin?>" />
		<select name="language" id="language" onchange="document.getElementById('change_language').submit();" class="input">
		<?php
		$sql ="select * from sys_language where lan_status='ACTIVE' and lan_delete<>1";
	
		$db->query($sql);
		$numlanguages = $db->numrows(); 
		while ($languages = $db->next_record())
			{ 
			if ($lang==$languages["lan_code"]) $language_name=$languages["lan_language"];
			?>
			<option value="<?=$languages["lan_code"]?>" <? if ($lang==$languages["lan_code"]) echo "selected"; ?>><?=$languages["lan_language"]?></option>
		<?php	} ?>
		</select>
		<a href="javascript:changeLanguageHeader('off');"  class='small'><img border="0" src="lib/close.gif" alt="cerrar" title="cerrar"/></a>	
		</form>		
		</div>	 
		
		<div id="exit">
		<a title="<?=admin::labelsSystem('logout')?>" href="<?=admin::labelsSystem('logout','link')?>"><img src="lib/buttons/logout.gif" alt="<?=admin::labelsSystem('logout')?>" width="21" height="21" border="0" /></a>
		</div>			
                    <div id="userDat">
                    <a href="userEdit_1.php" class="link3" title="<?=admin::labelsSystem('myProfile');?>"><img width="30" src="<?=$domain?>/admin/lib/pencil.png" alt="Cambiar Contrase&ntilde;a" title="Cambiar Contrase&ntilde;a" /></a><br />
                    <a href="userEdit_1.php" class="small" title="<?=admin::labelsSystem('myProfile');?>">&nbsp;&nbsp;Cambiar<br />Contrase&ntilde;a</a> <br />
		
		</div>
		<div id="userImg">
		<?php
		$usr_photo = admin::getDBValue('select usr_photo from sys_users where usr_uid='.$_SESSION['usr_uid']);
		$imgProfile = "upload/profile/thumb_" . $usr_photo;
	        if (file_exists($imgProfile) && $usr_photo!="") { ?>
		<a href="userEdit_1.php" title="<?=admin::labelsSystem('myProfile');?>">
			<img border="0" src="<?=$imgProfile?>?<?=time()?>" title="<?=admin::labelsSystem('myProfile');?>" alt="<?=admin::labelsSystem('myProfile');?>"/>
			</a>
		<?php } ?>		
		</div>
		<!--Definir tamaño de imagen ALTO POR ANCHO -->
			
			
		  </td>       
      </tr>
      <tr><td height="10px" colspan="3"></td></tr>
      <tr>
        <td height="31" valign="bottom">
		<div id="nav">
            <ul id="navmenu">
                <?=admin::labelsMenu()?>
            </ul>
        </div>
		</td>
        <td width="0%">   		</td>
      </tr>
    </table>
  </td>
  </tr>
  <tr>
    <td id="submenu"><?=admin::labelsSubMenu()?></td>
  </tr>
  </table>