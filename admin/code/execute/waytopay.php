<?php
include_once ("../../core/admin.php"); 
admin::initialize('users','usersList',false);
$pts_uid = admin::toSql(admin::getParam("uid"),"String");
$Exists = admin::getDbValue("SELECT count(distinct wtp_uid) FROM mdl_waytopay where wtp_pts_uid='".$pts_uid."'");

if ($Exists>0)
{	 
?>
<table width="92%" class="box">
<?
$sql = "select wtp_uid, wtp_name from mdl_waytopay where wtp_delete=0 and wtp_pts_uid='".$pts_uid."'";
			$db2->query($sql);
			while ($content=$db2->next_record())
			{
          ?>
          <tr>
            <td width="29%"><?=$content["wtp_name"]?>:</td>
            <td width="64%">
                    <input name="cli_pts_description<?=$content["wtp_uid"]?>" type="text" class="input" id="cli_pts_description<?=$content["wtp_uid"]?>" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_pts_description<?=$content["wtp_uid"]?>').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_pts_description<?=$content["wtp_uid"]?>').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_pts_description<?=$content["wtp_uid"]?>').style.display='none';" /><br /><span id="div_cli_pts_description<?=$content["wtp_uid"]?>" style="display:none;" class="error">Datos adicionales del pago es necesario</span>

			</td>
            <td width="7%">&nbsp;</td>
          </tr>
<? 
			}
?>			
</table>
<?
}
?>