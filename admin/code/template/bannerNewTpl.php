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
<br>
<form name="frmBanner" method="post" action="code/execute/bannerAdd.php?token=<?=admin::getParam("token");?>" onsubmit="return false;" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
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
<input name="ban_title" type="text" class="input" id="ban_title" size="50" onfocus="setClassInput(this,'ON');document.getElementById('div_ban_title').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_ban_title').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_ban_title').style.display='none';" />
<br /><span id="div_ban_title" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('banner','titleerror');?></span>
			</td>
          </tr>

		   <tr>
            <td><?=admin::labels('banner','label');?> (bmp, jpg, jpeg, gif, png): </td>
            <td><input type="file" name="ban_adjunt" id="ban_adjunt" size="31" onclick="setClassInput(this,'ON');document.getElementById('div_ban_adjunt').style.display='none';" class="input" onchange="verifyImageUpload();">
            <br /><span id="div_ban_adjunt" style="display:none;" class="error">Solo extenciones bmp, jpg, jpeg, gif, png</span>
            <?php 
			    if($_REQUEST["error"]=='ok') {?><br /><span class="error">Imagen no permitida</span> <?php }
			?>
			</td>
          </tr>
        
          <tr>
            <td><?=admin::labels('status');?>:</td>
            <td>
			<select name="ban_status" class="listMenu" id="ban_status">
            	<option selected="selected" value="ACTIVE"><?=admin::labels('active');?></option>
              	<option value="INACTIVE"><?=admin::labels('inactive');?></option>
			</select>
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
      <div id="contentButton">
	  	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="59%" align="center">
				<a href="#" onclick="verifyBanner();" class="button">
                                    Siguiente
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		o <a href="bannerList.php?token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table></div>
      <br /><br />
<br />