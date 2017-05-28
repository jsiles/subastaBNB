<br />
<form name="frmUsers" method="post" enctype="multipart/form-data" action="code/execute/usersAdd.php" onsubmit="return false;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::labels('user','new');?></span></td>
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
<input name="use_name" type="text" class="input" id="use_name" onfocus="setClassInput(this,'ON');document.getElementById('div_use_name').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_use_name').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_use_name').style.display='none';" size="40" /><br /><span id="div_use_name" style="display:none;" class="error"><?=admin::labels('users','nameerror');?></span>
			</td>
          </tr>
		  <tr>
            <td width="16%"><?=admin::labels('lastname');?>:</td>
            <td width="84%">
			<input name="use_lastname" type="text" class="input" id="use_lastname" onfocus="setClassInput(this,'ON');document.getElementById('div_use_lastname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_use_lastname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_use_lastname').style.display='none';" size="40" /><br /><span id="div_use_lastname" style="display:none;" class="error"><?=admin::labels('users','lasterror');?></span>
			</td>
          </tr>
		  <tr>
            <td><?=admin::labels('birthday');?>:</td>
            <td>
			
			
			
			<table border="0" cellpadding="0" cellspacing="0" width="41%">
				<tr><td width="45%" valign="middle"> 
				<input name="use_datenac" type="text" class="input3"  id="use_datenac" value="<?=date("d/m/Y");?>" size="20">
				</td><td width="55%" valign="middle">
				<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmUsers.use_datenac);return false;" >
				<img border="0" src="calendario/icon_calendar.gif">				</a>
				</td>
				</tr>
			</table>			</td>
          </tr>
          <tr>
            <td><?=admin::labels('gender');?>:</td>
            <td>
			<select name="use_gender" id="use_gender" class="txt10">
			<option value="M">Masculino</option>
			<option value="F">Femenino</option>
			</select>
			</td>
		  </tr>
		  <tr>
		  <td width="16%"><?=admin::labels('country');?>:</td>
            <td width="84%"><input name="use_country" type="text" class="input" id="use_country"  onfocus="setClassInput(this,'ON');document.getElementById('div_use_country').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_use_country').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_use_country').style.display='none';" size="40"/>
              <br /><span id="div_use_country" style="display:none;" class="error"><?=admin::labels('users','countryreq');?></span>
			  </td>
		  </tr>
		  <tr>
		  <td width="16%"><?=admin::labels('city');?>:</td>
            <td width="84%"><input name="use_city" type="text" class="input" id="use_city"  onfocus="setClassInput(this,'ON');document.getElementById('div_use_city').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_use_city').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_use_city').style.display='none';" size="40"/>
             <br /><span id="div_use_city" style="display:none;" class="error"><?=admin::labels('users','cityreq');?></span>
			  </td>
		  </tr>
		   <tr>
		  <td width="16%"><?=admin::labels('address');?>:</td>
            <td width="84%"><input name="use_address" type="text" class="input" id="use_address"  onfocus="setClassInput(this,'ON');document.getElementById('div_use_address').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_use_address').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_use_address').style.display='none';" size="40"/>
			<br /><span id="div_use_address" style="display:none;" class="error"><?=admin::labels('users','addressreq');?></span>
			</td>
          </tr>
		  <tr>
		  <td width="16%"><?=admin::labels('phone');?>:</td>
            <td width="84%"><input name="use_phone" type="text" class="input" id="use_phone"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" size="40"/>
              <span id="div_use_phone" style="display:none;" class="error"></span>			</td>
		  </tr>
		  <tr>
		  <td width="16%"><?=admin::labels('cellular');?>:</td>
            <td width="84%"><input name="use_cellular" type="text" class="input" id="use_cellular"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" size="40"/>
              <span id="div_use_cellular" style="display:none;" class="error"></span>			</td>
		  </tr>
		  <td width="16%"><?=admin::labels('email');?>:</td>
            <td width="84%">
<input name="use_email" type="text" class="input3" id="use_email" onfocus="setClassInput3(this,'ON');document.getElementById('div_use_email').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_use_email').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_use_email').style.display='none';" size="40" />
<br />
<span id="div_use_email" style="display:none;" class="error"><?=admin::labels('users','mailerror');?></span>			
			</td>
          </tr>
		   <tr>
            <td width="16%"><?=admin::labels('login','password');?>:</td>
            <td width="84%">
<input name="use_password" type="password" class="input" id="use_password" onfocus="setClassInput(this,'ON');document.getElementById('div_use_password').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_use_password').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_use_password').style.display='none';" size="20" />
<br /><span id="div_use_password" style="display:none;" class="error"><?=admin::labels('users','passreq');?></span>
			</td>
            <td width="7%"><a href="pass" onClick="return generarPassword(this.form,'use_password',10);">Generar</a>&nbsp;</td>                        
          <tr>
            <td width="16%"><?=admin::labels('photo');?>:</td>
            <td width="84%">
			<input name="use_image" type="file" id="use_image" class="txt10" size="31" />
			<br />
			<span id="div_use_image" style="display:none;" class="error">Nombre del contenido es necesario</span>
			</td>
          </tr>
          <tr>
            <td><?=admin::labels('status');?>:</td>
            <td>
			<select name="use_status" class="txt10" id="use_status">
            	<option selected="selected" value="ACTIVE"><?=admin::labels('active');?></option>
              	<option value="INACTIVE"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_col_status" style="display:none;" class="error"></span>			</td>
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
				<a href="javascript:verifyUsers(1);" class="button">
				<?=admin::labels('register');?>
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
