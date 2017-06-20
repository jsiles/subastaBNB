<br />
<form name="frmUsers" method="post" action="code/execute/userAdd.php" onsubmit="return false;" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" valign="top"><table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td colspan="3" class="titleBox"><?=admin::labels('user','personaldata');?></td>
            </tr>
          <tr>
            <td width="29%"><?=admin::labels('login','user');?>:</td>
            <td width="64%">
<input name="usr_login" type="text" class="input" id="usr_login" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_usr_login').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_usr_login').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_usr_login').style.display='none';" /><br /><span id="div_usr_login" style="display:none;" class="error">Usuario es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
		   <tr>
           <div id="pass_edit">
            <td width="29%"><?=admin::labels('login','password');?>:</td>
            <td width="64%">
<input name="usr_pass" type="text" class="input" id="usr_pass" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_usr_pass').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_usr_pass').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_usr_pass').style.display='none';" /><br /><span id="div_usr_pass" style="display:none;" class="error">Password es necesario</span>			</td>
            <td width="7%"><a href="pass" onClick="return generarPassword(this.form,'usr_pass',10);">Generar</a>&nbsp;</td>                        
            </div>
          </tr>
		  <tr>
            <td width="29%"><?=admin::labels('firstname');?>:</td>
            <td width="64%">
<input name="usr_firstname" type="text" class="input" id="usr_firstname" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_usr_firstname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_usr_firstname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_usr_firstname').style.display='none';" /><br /><span id="div_usr_firstname" style="display:none;" class="error">Nombre es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
		  <tr>
            <td width="29%"><?=admin::labels('lastname');?>:</td>
            <td width="64%">
<input name="usr_lastname" type="text" class="input" id="usr_lastname" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_usr_lastname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_usr_lastname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_usr_lastname').style.display='none';" /><br /><span id="div_usr_lastname" style="display:none;" class="error">Apellido es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td><?=admin::labels('email');?>: </td>
            <td>			
			<input name="usr_email" type="text" class="input" id="usr_email" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_usr_email').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_usr_email').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_usr_email').style.display='none';" /><br /><span id="div_usr_email" style="display:none;" class="error">Email es necesario</span>
			<span id="div_usr_email" style="display:none;" class="error"></span>            </td>
            <td>&nbsp;</td>
          </tr>
          
		  <tr>
            <td width="29%"><?=admin::labels('photo');?>:</td>
            <td width="64%">
<input name="usr_photo" type="file" id="usr_photo" class="txt10" size="45" />
<br /><span id="div_col_title" style="display:none;" class="error">Nombre del contenido es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>

          <tr>
            <td><?=admin::labels('user','userrol');?>:</td>
            <td>
            <select name="usr_rol" class="txt10" id="usr_rol">
            <?php
			$sql2="select rol_uid, rol_description from mdl_roles where rol_delete=0";	
			
			$db2->query($sql2);
			while($row = $db2->next_record())
			{
			$displaynone = $row["mod_uid"]==1 ? 'style="display:none"':'';	
            ?>
            	<option selected="selected" value="<?=$row["rol_uid"]?>"><?=$row["rol_description"]?></option>
            <?php
			}
            ?>
			</select>
			<span id="div_col_status" style="display:none;" class="error"></span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td><?=admin::labels('status');?>:</td>
            <td>
			<select name="usr_status" class="txt10" id="usr_status">
            	<option selected="selected" value="1"><?=admin::labels('active');?></option>
              	<option value="0"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_col_status" style="display:none;" class="error"></span>			</td>
            <td>&nbsp;</td>
          </tr>
          
        </table></td>
        <td width="50%" valign="top">&nbsp;
        
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
				<a href="#" onclick="verifyUsers();" class="button">
				<?=admin::labels('register');?>
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="userList.php" ><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table></div>
      <br /><br />
<br />
<br />

      <br />
      <br />
