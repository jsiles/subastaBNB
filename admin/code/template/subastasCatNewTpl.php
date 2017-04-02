<br />
<form name="frmCatProduct" method="post" action="code/execute/subastaCatAdd.php" enctype="multipart/form-data" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="77%" height="40">
		<span class="title"><?=admin::labels('subasta','catcreate');?></span>
		</td>
		<td width="23%" height="40">&nbsp;</td>
	</tr>
  	<tr>
    	<td colspan="2" id="contentListing">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		 	<tr>
			<td width="50%" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td width="57%" valign="top" rowspan="2">
			<table width="97%" border="0" cellpadding="5" cellspacing="5" class="box">			
				<tr>
				<td colspan="2" class="titleBox"><?=admin::labels('data');?></td>
				</tr>
				<tr>
				<td><?=admin::labels('code');?>:</td>
				<td>
				<input name="lin_uid" type="text" class="input" id="lin_uid" onfocus="setClassInput(this,'ON');document.getElementById('div_lin_uid').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_lin_uid').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_lin_uid').style.display='none';" size="50" />
				<br /><span id="div_lin_uid" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subasta','titleerror');?></span>				</td>
			  	</tr>
                <tr>
				<td><?=admin::labels('title');?>:</td>
				<td>
				<input name="lin_name" type="text" class="input" id="lin_name" onfocus="setClassInput(this,'ON');document.getElementById('div_lin_name').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_lin_name').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_lin_name').style.display='none';" size="50" />
				<br /><span id="div_lin_name" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('subasta','titleerror');?></span>				</td>
			  	</tr>
		<tr>
            <td valign="top"><?=admin::labels('status');?></td>
            <td><select name="lin_status" class="listMenu" id="lin_status">
            	<option selected="selected" value="ACTIVE"><?=admin::labels('active');?></option>
              	<option value="INACTIVE"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_lin_status" style="display:none;" class="error"></span>
			</td>
          </tr>
        </table>
			</td>
        <td width="43%" valign="top">
		<table width="98%" border="0" align="right" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td colspan="3" class="titleBox"><?=admin::labels('seo');?></td>
          </tr>
          <tr>
            <td width="25%"><?=admin::labels('seo','metatitle');?>:</td>
            <td width="66%"><input name="seo_metatitle" type="text" class="input" id="seo_metatitle"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" size="46"/>
			<span id="div_seo_metatitle" style="display:none;" class="error"></span>
			</td>
          </tr>
          <tr>
            <td><?=admin::labels('seo','metadescription');?>:</td>
            <td>
			<textarea name="seo_metadescription" cols="33" rows="6" class="textarea" id="seo_metadescription"  onfocus="setClassTextarea(this,'ON');" onblur="setClassTextarea(this,'OFF');" onclick="setClassTextarea(this,'ON');" onkeydown="growTextarea(this);" ></textarea>
			</td>
          </tr>
          <tr>
            <td><?=admin::labels('seo','metakeywords');?>: </td>
            <td>
			<textarea name="seo_metakeyword" cols="33" rows="6" class="textarea" id="seo_metakeyword"  onfocus="setClassTextarea(this,'ON');" onblur="setClassTextarea(this,'OFF');" onclick="setClassTextarea(this,'ON');" onkeydown="growTextarea(this);"></textarea>
			</td>
          </tr>
        </table>
		</td>
		</tr>
		<tr>
		<td valign="top" style="padding-top:20px;">&nbsp;</td>
      </tr>
    </table>
	</td>
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
		<a href="javascript:verifyCatProd();" class="button">
		<?=admin::labels('public');?>
		</a> 
		</td>
		<td width="41%" style="font-size:11px;">
		<?=admin::labels('or');?> <a href="subastaList.php" ><?=admin::labels('cancel');?></a> 
		</td>
		</tr>
	</table>
</div>
<br /><br /><br /><br /><br /><br />
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendario/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
