<br />
<form name="frmClient" method="post" action="code/execute/clientAdd.php?token=<?=admin::getParam("token");?>" onsubmit="return false;" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title">Crear proveedor</span></td>
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
               <td width="29%">NIT o CI:</td>
            <td width="54%">
<input name="cli_nit_ci" type="text" class="input" id="cli_nit_ci" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_nit_ci').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_nit_ci').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_nit_ci').style.display='none';" /><br />
<span id="div_cli_nit_ci" style="" class="error">NIT o CI es obligatorio</span>			</td>
            <td width="17%">&nbsp;</td>
          </tr>
          
          <tr>
            <td >Codigo interno:</td>
            <td>
<input name="cli_interno" type="text" class="input" id="cli_interno" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_interno').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_interno').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_interno').style.display='none';" /><br />
<span id="div_cli_interno" style="" class="error">Codigo interno es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>Clasificacion juridica:</td>
            <td>
            <div id="div_cli_lec_uid_select">
            <select name="cli_lec_uid" class="txt10" id="cli_lec_uid">
                <?php
				$sql = "select lec_uid, lec_name from mdl_legalclassification where lec_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{
				?>
            	    <option value="<?=$content["lec_uid"]?>"><?=$content["lec_name"]?></option>	
              	<?php 
					}
				?>
			</select>
            <a href="javascript:changeClientCategory();" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="javascript:deleteClientCategory();" class="small3"><?=admin::labels('del');?></a>
                <div id="div_client_category" style="display:none;">
		<input type="text" name="client_category" id="client_category" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_cli_lec_uid').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_cli_lec_uid').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_cli_lec_uid').style.display='none';"/>		
		<a href="javascript:cagetogyClientAdd()" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeClientCategory();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_cli_lec_uid" style="display:none;" class="error">Clasificacion juridica es necesaria</span>	</div>
                </td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>Cobertura:</td>
            <td>
            <div id="div_cli_cov_uid_select">
            <select name="cli_cov_uid" class="txt10" id="cli_cov_uid">
                <?php
				$sql = "select cov_uid, cov_name from mdl_coverage where cov_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{
				?>
            	    <option value="<?=$content["cov_uid"]?>"><?=$content["cov_name"]?></option>	
              	<?php 
					}
				?>
			</select>
            <a href="javascript:changeClientCoverage();" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="javascript:deleteClientCoverage();" class="small3"><?=admin::labels('del');?></a>
                <div id="div_client_coverage" style="display:none;">
		<input type="text" name="client_coverage" id="client_coverage" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_cli_cov_uid').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_cli_cov_uid').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_cli_cov_uid').style.display='none';"/>		
		<a href="javascript:coverageClientAdd()" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeClientCoverage();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_cli_cov_uid" style="display:none;" class="error">Cobertura es necesaria</span>	</div>
                </td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>Razon social:</td>
            <td>
<input name="cli_socialreason" type="text" class="input" id="cli_socialreason" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_socialreason').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_socialreason').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_socialreason').style.display='none';" /><br />
<span id="div_cli_socialreason" style="" class="error">Razon social es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>Direccion legal:</td>
            <td>
<input name="cli_legaldirection" type="text" class="input" id="cli_legaldirection" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legaldirection').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legaldirection').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legaldirection').style.display='none';" /><br /><span id="div_cli_legaldirection" style="display:none;" class="error">Direccion legal es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>Telefono fijo:</td>
            <td>
<input name="cli_phone" type="text" class="input" id="cli_phone" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_phone').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_phone').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_phone').style.display='none';" /><br /><span id="div_cli_phone" style="display:none;" class="error">Telefono fijo es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>Email administrativo:</td>
            <td>
<input name="cli_mainemail" type="text" class="input" id="cli_mainemail" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_mainemail').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_mainemail').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_mainemail').style.display='none';" /><br />
<span id="div_cli_mainemail" style="" class="error">Email administrativo es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>Email comercial:</td>
            <td>
<input name="cli_commercialemail" type="text" class="input" id="cli_commercialemail" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_commercialemail').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_commercialemail').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_commercialemail').style.display='none';" /><br /><span id="div_cli_commercialemail" style="display:none;" class="error">Email comercial es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>CI Adm/legal:</td>
            <td>
<input name="cli_legal_ci" type="text" class="input" id="cli_legal_ci" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legal_ci').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legal_ci').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legal_ci').style.display='none';" /><br /><span id="div_cli_legal_ci" style="display:none;" class="error">CI Adm/legal es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>Nombre Adm/legal:</td>
            <td>
<input name="cli_legalname" type="text" class="input" id="cli_legalname" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legalname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legalname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legalname').style.display='none';" /><br />
<span id="div_cli_legalname" style="" class="error">Nombre Adm/legal es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>Apellido Adm/legal:</td>
            <td>
<input name="cli_legallastname" type="text" class="input" id="cli_legallastname" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legallastname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legallastname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legallastname').style.display='none';" /><br />
<span id="div_cli_legallastname" style="" class="error">Apellido Adm/legal es obligatorio</span>	</td>
            <td><a id="l2a" href="#" class="small2" onclick="nal2(1);return false;">+ agregar Adm/legal (2)</a>
            <a id="l2b" class="small3" style="display:none" href="#" class="small2" onclick="nal2(0);return false;">+ quitar Adm/legal (2)</a></td>
          </tr>
          
          <tr id="cal2" style="display:none">
            <td>CI Adm/legal (2):</td>
            <td>
<input name="cli_legal_ci2" type="text" class="input" id="cli_legal_ci2" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legal_ci2').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legal_ci2').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legal_ci2').style.display='none';" /><br /><span id="div_cli_legal_ci2" style="display:none;" class="error">CI Adm/legal es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr id="nal2" style="display:none">
            <td>Nombre Adm/legal (2):</td>
            <td>
<input name="cli_legalname2" type="text" class="input" id="cli_legalname2" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legalname2').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legalname2').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legalname2').style.display='none';" /><br /><span id="div_cli_legalname2" style="display:none;" class="error">Nombre Adm/legal es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr id="aal2" style="display:none">
            <td>Apellido Adm/legal (2):</td>
            <td>
<input name="cli_legallastname2" type="text" class="input" id="cli_legallastname2" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legallastname2').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legallastname2').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legallastname2').style.display='none';" /><br /><span id="div_cli_legallastname2" style="display:none;" class="error">Apellido Adm/legal es obligatorio</span>			</td>
            <td><a id="l3a" href="#" class="small2" onclick="nal3(1);return false;">+ agregar Adm/legal (3)</a>
            <a id="l3b" class="small3" style="display:none" href="#" class="small2" onclick="nal3(0);return false;">+ quitar Adm/legal (3)</a></td>
          </tr>
          
          <tr id="cal3" style="display:none">
            <td>CI Adm/legal (3):</td>
            <td>
<input name="cli_legal_ci3" type="text" class="input" id="cli_legal_ci3" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legal_ci3').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legal_ci3').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legal_ci3').style.display='none';" /><br /><span id="div_cli_legal_ci3" style="display:none;" class="error">CI Adm/legal es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr id="nal3" style="display:none">
            <td>Nombre Adm/legal (3):</td>
            <td>
<input name="cli_legalname3" type="text" class="input" id="cli_legalname3" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legalname3').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legalname3').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legalname3').style.display='none';" /><br /><span id="div_cli_legalname3" style="display:none;" class="error">Nombre Adm/legal es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr id="aal3" style="display:none">
            <td>Apellido Adm/legal (3):</td>
            <td>
<input name="cli_legallastname3" type="text" class="input" id="cli_legallastname3" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legallastname3').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legallastname3').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legallastname3').style.display='none';" /><br /><span id="div_cli_legallastname3" style="display:none;" class="error">Apellido Adm/legal es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>Nombre comercial:</td>
            <td>
<input name="cli_commercialname" type="text" class="input" id="cli_commercialname" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_commercialname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_commercialname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_commercialname').style.display='none';" /><br /><span id="div_cli_commercialname" style="display:none;" class="error">Nombre comercial es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>Apellido comercial:</td>
            <td>
<input name="cli_commerciallastname" type="text" class="input" id="cli_commerciallastname" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_commerciallastname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_commerciallastname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_commerciallastname').style.display='none';" /><br /><span id="div_cli_commerciallastname" style="display:none;" class="error">Apellido comercial es obligatorio</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          
        </table></td>
        <td width="50%" valign="top">
        <table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
                  
          <tr>
            <td width="29%">Usuario:</td>
            <td width="64%">
<input name="cli_user" type="text" class="input" id="cli_user" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_user').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_user').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_user').style.display='none';" /><br />
<span id="div_cli_user" style="" class="error">Usuario es obligatorio</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Contrase&ntilde;a:</td>
            <td width="64%">
<input name="cli_pass" type="text" class="input" id="cli_pass" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_pass').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_pass').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_pass').style.display='none';" /><br />
<span id="div_cli_pass" style="" class="error">Contrase&ntilde;a es obligatorio</span>			</td>
            <td width="7%"><a href="pass" onClick="return generarPassword(this.form,'cli_pass',10);">Generar</a>&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Rubro:</td>
            <td width="64%">
            <div style="float: left" id="div_nivel1_select">
						<select name="nivel1_uid" id="nivel1_uid" class="input" onchange="actualizaNiveles()">
                                    <option value="" selected="selected">Seleccionar</option>
                	<?php
                    $sql = "select ca1_uid, ca1_description from mdl_categoria1 where ca1_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{	
					?>
					<option value="<?=$content["ca1_uid"]?>"><?=$content["ca1_description"]?></option>					
					<?php
					}
                    ?>
				</select>
                <a href="adicionar" onclick="addNivel1();return false;" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="borrar" onclick="deleteNivel1();return false;" class="small3"><?=admin::labels('del');?></a>
                <div id="div_nivel1" style="display:none;">
		<input type="text" name="nivel1" id="nivel1" class="input3" 
                       onfocus="setClassInput3(this,'ON');document.getElementById('div_nivel1_error').style.display='none';" 
                       onblur="setClassInput3(this,'OFF');document.getElementById('div_nivel1_error').style.display='none';" 
                       onclick="setClassInput3(this,'ON');document.getElementById('div_nivel1_error').style.display='none';"/>		
                
		<a href="" onclick="nivel1Add();return false;" class="button3"><?=admin::labels('add');?></a><a href="javascript:addNivel1();" class="link2">Cerrar</a>		
                </div>
				<br /><span id="div_nivel1_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
               </div>
        
            <div style="float:left" id="div_nivel2_select">
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
               <select name="nivel2_uid" id="nivel2_uid" class="input"  >
                                 <option value="" selected="selected" onchange="actualizaNiveles2();">Seleccionar</option>
				</select>
               <a href="adicionar" onclick="addNivel2();return false;" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="borrar" onclick="deleteNivel2();return false;" class="small3"><?=admin::labels('del');?></a>
                <div id="div_nivel2" style="display:none;">
		<input type="text" name="nivel2" id="nivel2" class="input3" 
                       onfocus="setClassInput3(this,'ON');document.getElementById('div_nivel2_error').style.display='none';" 
                       onblur="setClassInput3(this,'OFF');document.getElementById('div_nivel2_error').style.display='none';" 
                       onclick="setClassInput3(this,'ON');document.getElementById('div_nivel2_error').style.display='none';"/>		
                
		<a href="" onclick="nivel2Add();return false;" class="button3"><?=admin::labels('add');?></a><a href="javascript:addNivel2();" class="link2">Cerrar</a>		
                </div>
				<br /><span id="div_nivel2_error" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('required');?></span>
               
               
           </div>
        
        
             </td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Forma de pago al proveedor:</td>
            <td width="64%">
            
            <select name="cli_pts_uid" class="txt10" onchange="ptsClient('<?=admin::getParam("token")?>'); return false;" id="cli_pts_uid">
                <? 
				$sql = "select pts_uid, pts_type from mdl_paymenttosupplier where pts_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{
				?>
            	    <option value="<?=$content["pts_uid"]?>" ><?=$content["pts_type"]?></option>	
              	<? 
					}
				?>
			</select>
            
             </td>
            <td width="7%">&nbsp;</td>
          </tr>
          <tr>
          <td colspan="3">

          <div id="div_cli_pts_uid_select">

          </div>

          </td>
          </tr>
          <tr>
            <td width="29%">Documentacion:<br />
            <p>Puede marcar los documentos entregados o Informacion completa para que se marquen todos</p>
            </td>
            <td width="64%">
            <!--<div style="float: left; width:50%">
            <? 
				$sql = "select doc_uid, doc_name from mdl_documents where doc_delete=0 and doc_uid=10";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{
				?><br /><br /><br /><br /><br />
            	    <input id="cli_doc_uid[<?=$content["doc_uid"]?>]" name="cli_doc_uid[<?=$content["doc_uid"]?>]" type="checkbox" class="subDocs2" onclick="checkinOut();" /><?=$content["doc_name"]?>	
              	<? 
					}
				?>
            </div>-->
            <div style="float: left; width:50%"><?php 
				$sql = "select doc_uid, doc_name from mdl_documents where doc_delete=0 ";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{
				?>
            	    <input id="cli_doc_uid[<?=$content["doc_uid"]?>]" name="cli_doc_uid[<?=$content["doc_uid"]?>]" type="checkbox" class="subDocs"  onclick="checkinOut2(<?=$content["doc_uid"]?>);" /><?=$content["doc_name"]?>	<br />
              	<?php 
					}
				?></div>

					</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="16%"><?=admin::labels('photo');?>:</td>
            <td width="84%">
			<input name="cli_logo" type="file" id="cli_logo" class="txt10" size="31" />
			<br />
			<span id="div_cli_logo" style="display:none;" class="error">Foto es obligatorio</span>
			</td>
          </tr>
          
		  <tr>
            <td><?=admin::labels('status');?>:</td>
            <td>
			<select name="cli_status" class="txt10" id="cli_status">
            	<option selected="selected" value="0"><?=admin::labels('active');?></option>
              	<option value="1"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_cli_status" style="display:none;" class="error"></span>			</td>
            <td>&nbsp;</td>
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
				<a href="#" onclick="verifyClient();" class="button">
				<?=admin::labels('register');?>
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="clientList.php?token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table></div>
<br /><br /><br />