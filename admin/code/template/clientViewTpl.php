<?php
$cli_uid=admin::toSql($_REQUEST["cli_uid"],"String");
$sql = "select * from mdl_client where cli_uid=".$cli_uid;
$db->query($sql);
$regusers = $db->next_record();
?>
<br />
<form name="frmClient" method="post" action="code/execute/clientUpd.php" onsubmit="return false;" enctype="multipart/form-data">
<input type="hidden" name="cli_uid" value="<?=$regusers["cli_uid"]?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title">Ver proveedor</span></td>
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
            <td width="64%"><?=$regusers["cli_nit_ci"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
               <td >Codigo interno:</td>
            <td><?=$regusers["cli_interno"]?></td>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Clasificacion juridica:</td>
            <td width="64%">
            	<? 
				$sql = "select lec_name from mdl_legalclassification where lec_delete=0 and lec_uid='".$regusers["cli_lec_uid"]."'";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{
				?>
            	    <?=$content["lec_name"]?>	
              	<? 
					}
				?>
            </td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Razon social:</td>
            <td width="64%"><?=$regusers["cli_socialreason"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Direccion legal:</td>
            <td width="64%"><?=$regusers["cli_legaldirection"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Telefono fijo:</td>
            <td width="64%"><?=$regusers["cli_phone"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Email administrativo:</td>
            <td width="64%"><?=$regusers["cli_mainemail"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Email comercial:</td>
            <td width="64%"><?=$regusers["cli_commercialemail"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Nombre Adm/legal:</td>
            <td width="64%"><?=$regusers["cli_legalname"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Apellido Adm/legal:</td>
            <td width="64%"><?=$regusers["cli_legallastname"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Nombre Adm/legal (2):</td>
            <td width="64%"><?=$regusers["cli_legalname2"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Apellido Adm/legal (2):</td>
            <td width="64%"><?=$regusers["cli_legallastname2"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Nombre Adm/legal (3):</td>
            <td width="64%"><?=$regusers["cli_legalname3"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Apellido Adm/legal (3):</td>
            <td width="64%"><?=$regusers["cli_legallastname3"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Nombre comercial:</td>
            <td width="64%"><?=$regusers["cli_commercialname"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Apellido comercial:</td>
            <td width="64%"><?=$regusers["cli_commerciallastname"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          
        </table></td>
        <td width="50%" valign="top">
        <table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
                  
          <tr>
            <td width="29%">Usuario:</td>
            <td width="64%"><?=$regusers["cli_user"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Contrase&ntilde;a:</td>
            <td width="64%">***************</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Forma de pago al proveedor:</td>
            <td width="64%">
                <?php 
				$sql = "select pts_type from mdl_paymenttosupplier where pts_delete=0 and pts_uid='".$regusers["cli_pts_uid"]."'";
					$db2->query($sql);
					while ($content=$db2->next_record())
					{
				?>
            	    <?=$content["pts_type"]?>	
              	<?php 
					}
				?>
			</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Datos adicionales del pago:</td>
            <td width="64%"><?=$regusers["cli_pts_description"]?></td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="29%">Documentacion:</td>
            <td width="64%">
                <?php 
				$sql = "select doc_uid, doc_name from mdl_documents where doc_delete=0";
					$db2->query($sql);
					$check = '';
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
            	    <input disabled="disabled" <?=$check?> id="cli_doc_uid[<?=$content["doc_uid"]?>]" name="cli_doc_uid[<?=$content["doc_uid"]?>]" type="checkbox" /><?=$content["doc_name"]?>	<br />
              	<?php 
					}
				?>
					</td>
            <td width="7%">&nbsp;</td>
          </tr>
          
          <tr>
            <td width="16%"><?=admin::labels('photo');?>:</td>
            <td width="84%">
            	<img src="<?=$domain?>/img/client/thumb_<?=$regusers["cli_logo"]?>?<?=time()?>" alt="<?=$regusers["cli_user"]?>" title="<?=$regusers["cli_user"]?>" border="0"/>
			</td>
          </tr>
          
		  <tr>
            <td><?=admin::labels('status');?>:</td>
            <td><?php
		switch ($regusers["cli_status"])
                      {  
                            case 0: echo 'ACTIVO';
                                break;
                            case 1: echo 'INACTIVO';
                                break;
                        }
			?></td>
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
				<td width="25%" align="center">&nbsp;
				
				</td>
          <td width="75%" style="font-size:11px;">
		  		<a href="clientList.php" class="button">Volver</a> 
		  </td>
        </tr>
      </table></div>
<br /><br /><br />