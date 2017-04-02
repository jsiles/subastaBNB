<?php
$mcc_uid=admin::toSql($_REQUEST["mcc_uid"],"Number");
$sql = "select mcc_permit, mcc_mensual, mcc_trimestral, mcc_semestral, mcc_anual from mdl_client_category where mcc_uid=".$mcc_uid." and mcc_delete=0";
$db->query($sql);
$regusers = $db->next_record();
?>
<br />
<form name="frmPermit" method="post" action="code/execute/permitUpd.php?token=<?=admin::getParam("token");?>" enctype="multipart/form-data" onsubmit="return false;">
<input type="hidden" id="mcc_uid" name="mcc_uid" value="<?=$mcc_uid?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::labels('permit','upd');?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="2" id="contentListing">
    	
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        <td width="50%" valign="top">
        
        <table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td width="15%"><?=admin::labels('permit','name');?>:</td>
            <td >
			<input name="mcc_permit" type="text" class="input" id="mcc_permit" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_mcc_permit').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_mcc_permit').style.display='none';" value="<?=$regusers["mcc_permit"]?>" /><br />
            <span id="div_mcc_permit" style="display:none;" class="error">Campo Requerido</span>			
            </td>
           </tr>
         </table>
         <br />
         <table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
          <tr>
          <td colspan="2" class="titleBox"><?=admin::labels('capa','cost');?>:</td>
            </tr>
           <tr>
            <td width="15%"><?=admin::labels('labels','Mensual');?>:</td>
            <td >
			<input name="mcc_mensual" type="text" class="input" id="mcc_mensual" size="10" onfocus="setClassInput(this,'ON');document.getElementById('div_mcc_mensual').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_mcc_mensual').style.display='none';" value="<?=$regusers["mcc_mensual"]?>" /> Bs.<br />
            <span id="div_mcc_mensual" style="display:none;" class="error">Campo Requerido</span>			
            </td>
           </tr>
           <tr>
            <td width="15%"><?=admin::labels('labels','trimestral');?>:</td>
            <td >
			<input name="mcc_trimestral" type="text" class="input" id="mcc_trimestral" size="10" onfocus="setClassInput(this,'ON');document.getElementById('div_mcc_trimestral').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_mcc_trimestral').style.display='none';" value="<?=$regusers["mcc_trimestral"]?>" /> Bs.<br />
            <span id="div_mcc_trimestral" style="display:none;" class="error">Campo Requerido</span>			
            </td>
           </tr>
           <tr>
            <td width="15%"><?=admin::labels('labels','semestral');?>:</td>
            <td >
			<input name="mcc_semestral" type="text" class="input" id="mcc_semestral" size="10" onfocus="setClassInput(this,'ON');document.getElementById('div_mcc_semestral').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_mcc_semestral').style.display='none';" value="<?=$regusers["mcc_semestral"]?>" /> Bs.<br />
            <span id="div_mcc_semestral" style="display:none;" class="error">Campo Requerido</span>			
            </td>
           </tr>
           <tr>
            <td width="15%"><?=admin::labels('labels','anual');?>:</td>
            <td >
			<input name="mcc_anual" type="text" class="input" id="mcc_anual" size="10" onfocus="setClassInput(this,'ON');document.getElementById('div_mcc_anual').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_mcc_anual').style.display='none';" value="<?=$regusers["mcc_anual"]?>" /> Bs.<br />
            <span id="div_mcc_anual" style="display:none;" class="error">Campo Requerido</span>			
            </td>
           </tr>
          </table> 
         <br />
         <table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
         
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
			  con_delete<>1 
			  and con_uid in (4,13,14,15) 
		order by con_uid asc";	

$db->query($sqldat);
while($row = $db->next_record()){
$check=admin::getDBvalue("select cli_uid from mdl_client where cli_con_uid=".$row["con_uid"]." and cli_mcc_uid=".$mcc_uid." and cli_delete=0");
if ($check) $check='checked="checked"';
if ($check==4) $check='checked="checked"';
?>
          <tr>
            <td width="10">
            <input name="con_uid[]" type="checkbox" id="con_uid<?=$row["con_uid"]?>" <?=$check?>  onclick="hideMsg();" value="<? if($row["con_uid"]==4) echo 0; else echo $row["con_uid"];?>" />
			</td>
            <td><?=$row["col_title"]?>:</td>
          </tr>
<?php }?>
        </table><span id="div_con_uid" style="display:none;" class="error">Seleccione al menos un Contenido</span>
        </td>
          </tr>
        </table>
         </td>
        <td width="50%" valign="top">
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
				<a href="#" onclick="verifyPermit();" class="button">
				<?=admin::labels('register');?>
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="permitList.php?token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table></div>