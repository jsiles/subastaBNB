<script language="javascript" type="text/javascript">
function verifyImageUpload()
	{
	document.getElementById('div_cli_photo').style.display="none";
	var cv = document.getElementById('cli_photo').value;
	var filepart = cv.split(".");
	var part = filepart.length-1;
	var extension = filepart[part];
	extension = extension.toLowerCase();
	if (extension!='jpg' && extension!='jpeg' && extension!='bmp' && extension!='gif' && extension!='png')	
		{
		document.getElementById('cli_photo').value="";
		$('#div_cli_photo').fadeIn(500);
		}
	}
</script>	
<?php
$cli_uid=admin::toSql($_REQUEST["cli_uid"],"String");
$sql = "select * from mdl_client where cli_uid=".$cli_uid;
$db->query($sql);
$regusers = $db->next_record();
?>
<br />
<form name="frmClient" method="post" action="code/execute/clientUpd.php?token=<?=admin::getParam("token");?>" onsubmit="return false;" enctype="multipart/form-data">
<input type="hidden" name="cli_uid" value="<?=$regusers["cli_uid"]?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title">Editar proveedor</span></td>
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
            <td width="64%"><?=$regusers["cli_nit_ci"]?>
            
            <div style="display:none">
            <input name="cli_nit_ci" type="text" class="input" id="cli_nit_ci" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_nit_ci').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_nit_ci').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_nit_ci').style.display='none';" value="<?=$regusers["cli_nit_ci"]?>" /><br /><span id="div_cli_nit_ci" style="display:none;" class="error">NIT o CI es necesario</span>
            </div>
            
            </td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
               <td >Codigo interno:</td>
            <td>
<input name="cli_interno" type="text" class="input" id="cli_interno" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_interno').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_interno').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_interno').style.display='none';" value="<?=$regusers["cli_interno"]?>" /><br /><span id="div_cli_interno" style="display:none;" class="error">Codigo interno es necesario</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Clasificacion juridica:</td>
            <td width="64%">
            <div id="div_cli_lec_uid_select">
            <select name="cli_lec_uid" class="txt10" id="cli_lec_uid">
                <? 
				$sql = "select lec_uid, lec_name from mdl_legalclassification where lec_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{
						($content["lec_uid"]==$regusers["cli_lec_uid"])?$selected="selected":$selected=""; 
				?>
            	    <option value="<?=$content["lec_uid"]?>" <?=$selected?>><?=$content["lec_name"]?></option>	
              	<? 
					}
				?>
			</select>
            <a href="javascript:changeClientCategory();" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="javascript:deleteClientCategory();" class="small3"><?=admin::labels('del');?></a>
                <div id="div_client_category" style="display:none;">
		<input type="text" name="client_category" id="client_category" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_cli_lec_uid').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_cli_lec_uid').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_cli_lec_uid').style.display='none';"/>		
		<a href="javascript:cagetogyClientAdd()" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeClientCategory();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_cli_lec_uid" style="display:none;" class="error">Clasificacion juridica es necesaria</span>	</div>	</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td>Cobertura:</td>
            <td>
            <div id="div_cli_cov_uid_select">
            <select name="cli_cov_uid" class="txt10" id="cli_cov_uid">
                <? 
				$sql = "select cov_uid, cov_name from mdl_coverage where cov_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{
						($content["cov_uid"]==$regusers["cli_cov_uid"])?$selected="selected":$selected="";
				?>
            	    <option value="<?=$content["cov_uid"]?>" <?=$selected?>><?=$content["cov_name"]?></option>	
              	<? 
					}
				?>
			</select>
            <a href="javascript:changeClientCoverage();" class="small2"><?=strtolower(admin::labels('add'));?></a> | 
                <a href="javascript:deleteClientCoverage();" class="small3"><?=admin::labels('del');?></a>
                <div id="div_client_coverage" style="display:none;">
		<input type="text" name="client_coverage" id="client_coverage" class="input3" onfocus="setClassInput3(this,'ON');document.getElementById('div_cli_cov_uid').style.display='none';" onblur="setClassInput3(this,'OFF');document.getElementById('div_cli_cov_uid').style.display='none';" onclick="setClassInput3(this,'ON');document.getElementById('div_cli_cov_uid').style.display='none';"/>		
		<a href="javascript:coverageClientAdd()" class="button3"><?=admin::labels('add');?></a><a href="javascript:changeClientCoverage();" class="link2">Cerrar</a>		</div>
				<br /><span id="div_cli_cov_uid" style="display:none;" class="error">Covertura es necesaria</span>	</div>
                </td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Razon social:</td>
            <td width="64%">
<input name="cli_socialreason" type="text" class="input" id="cli_socialreason" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_socialreason').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_socialreason').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_socialreason').style.display='none';" value="<?=$regusers["cli_socialreason"]?>" /><br /><span id="div_cli_socialreason" style="display:none;" class="error">Razon social es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Direccion legal:</td>
            <td width="64%">
<input name="cli_legaldirection" type="text" class="input" id="cli_legaldirection" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legaldirection').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legaldirection').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legaldirection').style.display='none';" value="<?=$regusers["cli_legaldirection"]?>" /><br /><span id="div_cli_legaldirection" style="display:none;" class="error">Direccion legal es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Telefono fijo:</td>
            <td width="64%">
<input name="cli_phone" type="text" class="input" id="cli_phone" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_phone').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_phone').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_phone').style.display='none';" value="<?=$regusers["cli_phone"]?>" /><br /><span id="div_cli_phone" style="display:none;" class="error">Telefono fijo es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Email administrativo:</td>
            <td width="64%">
<input name="cli_mainemail" type="text" class="input" id="cli_mainemail" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_mainemail').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_mainemail').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_mainemail').style.display='none';" value="<?=$regusers["cli_mainemail"]?>" /><br /><span id="div_cli_mainemail" style="display:none;" class="error">Email administrativo es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Email comercial:</td>
            <td width="64%">
<input name="cli_commercialemail" type="text" class="input" id="cli_commercialemail" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_commercialemail').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_commercialemail').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_commercialemail').style.display='none';" value="<?=$regusers["cli_commercialemail"]?>" /><br /><span id="div_cli_commercialemail" style="display:none;" class="error">Email comercial es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td>CI Adm/legal:</td>
            <td>
<input name="cli_legal_ci" type="text" class="input" id="cli_legal_ci" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legal_ci').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legal_ci').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legal_ci').style.display='none';" value="<?=$regusers["cli_legal_ci"]?>"  /><br /><span id="div_cli_legal_ci" style="display:none;" class="error">CI Adm/legal es necesario</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Nombre Adm/legal:</td>
            <td width="64%">
<input name="cli_legalname" type="text" class="input" id="cli_legalname" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legalname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legalname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legalname').style.display='none';" value="<?=$regusers["cli_legalname"]?>" /><br /><span id="div_cli_legalname" style="display:none;" class="error">Nombre Adm/legal es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Apellido Adm/legal:</td>
            <td width="64%">
<input name="cli_legallastname" type="text" class="input" id="cli_legallastname" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legallastname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legallastname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legallastname').style.display='none';" value="<?=$regusers["cli_legallastname"]?>" /><br /><span id="div_cli_legallastname" style="display:none;" class="error">Apellido Adm/legal es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr id="cal2" style="display:none">
            <td>CI Adm/legal (2):</td>
            <td>
<input name="cli_legal_ci2" type="text" class="input" id="cli_legal_ci2" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legal_ci2').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legal_ci2').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legal_ci2').style.display='none';" value="<?=$regusers["cli_legal_ci2"]?>" /><br /><span id="div_cli_legal_ci2" style="display:none;" class="error">CI Adm/legal es necesario</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Nombre Adm/legal (2):</td>
            <td width="64%">
<input name="cli_legalname2" type="text" class="input" id="cli_legalname2" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legalname2').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legalname2').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legalname2').style.display='none';" value="<?=$regusers["cli_legalname2"]?>" /><br /><span id="div_cli_legalname2" style="display:none;" class="error">Nombre Adm/legal (2) es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Apellido Adm/legal (2):</td>
            <td width="64%">
<input name="cli_legallastname2" type="text" class="input" id="cli_legallastname2" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legallastname2').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legallastname2').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legallastname2').style.display='none';" value="<?=$regusers["cli_legallastname2"]?>" /><br /><span id="div_cli_legallastname2" style="display:none;" class="error">Apellido Adm/legal (2) es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr id="cal3" style="display:none">
            <td>CI Adm/legal (3):</td>
            <td>
<input name="cli_legal_ci3" type="text" class="input" id="cli_legal_ci3" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legal_ci3').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legal_ci3').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legal_ci3').style.display='none';" value="<?=$regusers["cli_legal_ci3"]?>" /><br /><span id="div_cli_legal_ci3" style="display:none;" class="error">CI Adm/legal es necesario</span>			</td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Nombre Adm/legal (3):</td>
            <td width="64%">
<input name="cli_legalname3" type="text" class="input" id="cli_legalname3" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legalname3').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legalname3').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legalname3').style.display='none';" value="<?=$regusers["cli_legalname3"]?>" /><br /><span id="div_cli_legalname3" style="display:none;" class="error">Nombre Adm/legal (3) es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Apellido Adm/legal (3):</td>
            <td width="64%">
<input name="cli_legallastname3" type="text" class="input" id="cli_legallastname3" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_legallastname3').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_legallastname3').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_legallastname3').style.display='none';" value="<?=$regusers["cli_legallastname3"]?>" /><br /><span id="div_cli_legallastname3" style="display:none;" class="error">Apellido Adm/legal (3) es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Nombre comercial:</td>
            <td width="64%">
<input name="cli_commercialname" type="text" class="input" id="cli_commercialname" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_commercialname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_commercialname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_commercialname').style.display='none';" value="<?=$regusers["cli_commercialname"]?>" /><br /><span id="div_cli_commercialname" style="display:none;" class="error">Nombre comercial es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Apellido comercial:</td>
            <td width="64%">
<input name="cli_commerciallastname" type="text" class="input" id="cli_commerciallastname" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_commerciallastname').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_commerciallastname').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_commerciallastname').style.display='none';" value="<?=$regusers["cli_commerciallastname"]?>" /><br /><span id="div_cli_commerciallastname" style="display:none;" class="error">Apellido comercial es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          
        </table></td>
        <td width="50%" valign="top">
        <table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
                  
          <tr>
            <td width="29%">Usuario:</td>
            <td width="64%">
<input name="cli_user" type="text" class="input" id="cli_user" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_user').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_user').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_user').style.display='none';" value="<?=$regusers["cli_user"]?>" /><br /><span id="div_cli_user" style="display:none;" class="error">Usuario es necesario</span>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%"><?=admin::labels('login','password');?>:</td>
            <td width="64%"><span id="deltag">************ &nbsp;<a href="#" onclick="removePass();return false;" title="Cambiar" class="small3">Cambiar</a></span>
<input name="cli_pass" style="display:none" type="text" class="input" id="cli_pass" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_pass').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_pass').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_pass').style.display='none';" value="" /><br /><span id="div_cli_pass" style="display:none;" class="error">Password es necesario</span></td>
            <td width="7%"><a href="pass" id="linkpass" style="display:none;" onClick="return generarPassword(this.form,'cli_pass',5);">Generar</a>&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Rubro:</td>
            <td width="64%">
            <div style="float: left" id="div_nivel1_select">
						<select name="nivel1_uid" id="nivel1_uid" class="input" onchange="actualizaNiveles()">
                                    <option value="" >Seleccionar</option>
                	<?php
                            $sql = "select ca1_uid, ca1_description from mdl_categoria1 where ca1_delete=0 ";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{	
                                          if($content["ca1_uid"]==$regusers["cli_item_uid"]) $sel="selected='selected'";
                                          else $sel="";
					?>
					<option <?=$sel?> value="<?=$content["ca1_uid"]?>"><?=$content["ca1_description"]?></option>					
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
                                 <?php
                            $sql = "select ca2_uid, ca2_description from mdl_categoria2 where ca2_delete=0 and ca2_ca1_uid=".$regusers["cli_item_uid"];
					$db2->query($sql);
					while ($content=$db2->next_record())
					{	
                                          if($content["ca2_uid"]==$regusers["cli_ite_uid"]) $sel="selected='selected'";
                                          else $sel="";
					?>
					<option <?=$sel?> value="<?=$content["ca2_uid"]?>"><?=$content["ca2_description"]?></option>					
					<?php
					}
                                ?>
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
            <select name="cli_pts_uid" class="txt10" id="cli_pts_uid" onchange="ptsClient('<?=admin::getParam("token")?>'); return false;">
                <?php 
				$sql = "select pts_uid, pts_type from mdl_paymenttosupplier where pts_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{
						($content["pts_uid"]==$regusers["cli_pts_uid"])?$selecteds="selected":$selecteds="";
				?>
            	    <option value="<?=$content["pts_uid"]?>" <?=$selecteds?>><?=$content["pts_type"]?></option>	
              	<?php 
					}
				?>
			</select>			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
          <td colspan="3">

          <div id="div_cli_pts_uid_select">
<table width="92%" class="box">
<?php
$sql2 = "select w.wtp_uid, w.wtp_name,  d.wde_description from mdl_waytopay w, mdl_way_desc d where wtp_delete=0 and wtp_pts_uid='".$regusers["cli_pts_uid"]."' and d.wde_wtp_uid=w.wtp_uid and d.wde_cli_uid='".$regusers["cli_uid"]."'";
			$db3->query($sql2);
			while ($content2=$db3->next_record())
			{
          ?>
          <tr>
            <td width="29%"><?=$content2["wtp_name"]?>:</td>
            <td width="64%">
                    <input name="cli_pts_description<?=$content2["wtp_uid"]?>" type="text" class="input" id="cli_pts_description<?=$content2["wtp_uid"]?>" size="60" onfocus="setClassInput(this,'ON');document.getElementById('div_cli_pts_description<?=$content2["wtp_uid"]?>').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_cli_pts_description<?=$content2["wtp_uid"]?>').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_cli_pts_description<?=$content2["wtp_uid"]?>').style.display='none';"  value="<?=$content2["wde_description"]?>" /><br /><span id="div_cli_pts_description<?=$content2["wtp_uid"]?>" style="display:none;" class="error">Datos adicionales del pago es necesario</span>

			</td>
            <td width="7%">&nbsp;</td>
          </tr>
<?php 
			}
?>			
</table>
          </div>

          </td>
          </tr>
          
          <tr>
            <td width="29%">Documentacion:</td>
            <td width="64%">
            <!--<div style="float: left; width:50%">
            <?php 
				$sql = "select doc_uid, doc_name from mdl_documents where doc_delete=0 and doc_uid=10";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{
						$MaxUid = admin::getDbValue("SELECT count(dcl_uid) FROM mdl_documentsclient WHERE dcl_cli_uid='".$regusers["cli_uid"]."' and dcl_doc_uid='".$content["doc_uid"]."'");
						if ($MaxUid==0){
							$check = '';
						}
						else{
							$check = 'checked="checked"';
						}
				?><br /><br /><br /><br /><br />
            	    <input id="cli_doc_uid[<?=$content["doc_uid"]?>]" name="cli_doc_uid[<?=$content["doc_uid"]?>]" type="checkbox" onclick="checkinOut();" <?=$check?> /><?=$content["doc_name"]?>	
              	<?php 
					}
				?>
            </div>-->
            <div style="float: left; width:50%"><?php 
				$sql = "select doc_uid, doc_name from mdl_documents where doc_delete=0";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{
						$MaxUid = admin::getDbValue("SELECT count(dcl_uid) FROM mdl_documentsclient WHERE dcl_cli_uid='".$regusers["cli_uid"]."' and dcl_doc_uid='".$content["doc_uid"]."'");
						if ($MaxUid==0){
							$check = '';
						}
						else{
							$check = 'checked="checked"';
						}
				?>
            	    <input id="cli_doc_uid[<?=$content["doc_uid"]?>]" name="cli_doc_uid[<?=$content["doc_uid"]?>]" type="checkbox" class="subDocs" <?=$check?> /><?=$content["doc_name"]?>	<br />
              	<?php 
					}
				?></div>
					</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="16%"><?=admin::labels('photo');?>:</td>
            <td width="84%">
			<?php
			$imgSavedroot1 = PATH_ROOT."/img/client/thumb_".$regusers["cli_logo"];
			$imgSaveddomain1 = PATH_DOMAIN."/img/client/thumb_".$regusers["cli_logo"];
			$imgSaveddomain2 = PATH_DOMAIN."/img/client/img_".$regusers["cli_logo"];
			if (file_exists($imgSavedroot1) && $regusers["cli_logo"]!=""){
			?>
			<div id="image_edit_<?=$regusers["cli_uid"]?>">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableUpload">
			<tr>
				<td width="25%" rowspan="2" align="center" valign="middle" style="padding:4px;">
				<a href="<?=$imgSaveddomain2?>" target="_blank"><img src="<?=$imgSaveddomain1?>?<?=time();?>" border="0" /></a>				</td>
				<td width="75%" style="font-size:11px;">
				<?=$regusers["cli_firstname"];?><br />
				<a href="javascript:viewInputFile('on')" title="<?=admin::labels('change');?>" class="small2"><?=admin::labels('change');?></a>
				<span class="pipe">|</span> <a href="#" onclick="removeImg(<?=$regusers["cli_uid"]?>);return false;" title="<?=admin::labels('del')?>" class="small3"><?=admin::labels('del')?></a>				</td>
			</tr>
			<tr>
				<td height="24">
				<div id="imageChange1" style="display:none">
			<input type="file" name="cli_photo" id="cli_photo" size="14" onchange="verifyImageUpload();" style="font-size:11px;"  >  <a href="javascript:viewInputFile('off')" onclick="document.getElementById('cli_photo').value='';document.getElementById('button_next').innerHTML='<?=admin::labels('public');?>';"><img border="0" src="lib/close.gif" align="top"/></a>
			
			<span id="div_cli_photo" class="error" style="display:none">Solo archivos jpg bmp gif png</span></div></td>
			</tr>
			</table>
			</div>
			<div id="image_add_<?=$regusers["cli_uid"]?>" style="display:none;"></div>
			<?php
                        }
			else
				{ ?>
				<input type="file" name="cli_photo" id="cli_photo" size="32" class="input" onchange="verifyImageUpload();">
				<span id="div_cli_photo" class="error" style="display:none">Solo archivos jpg bmp gif png </span>	
			<?php
                        } 
                        ?>	
			</td>
          </tr>
          
		  <tr>
            <td><?=admin::labels('status');?>:</td>
            <td>
            <?php
            ($regusers["cli_status"]==0)?$selected0="selected":$selected0="";
		    ($regusers["cli_status"]==1)?$selected1="selected":$selected1="";
			?>
			<select name="cli_status" class="txt10" id="cli_status">
            	<option value="0" <?=$selected0?> ><?=admin::labels('active');?></option>
              	<option value="1" <?=$selected1?> ><?=admin::labels('inactive');?></option>
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
				<a href="#" onclick="verifyClientEdit();" class="button">
				Actualizar
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="clientList.php?token=<?=admin::getParam("token")?>" ><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table></div>
<br /><br /><br />