<script language="javascript" type="text/javascript">
function verifyFileUpload()
	{
	document.getElementById('div_sol_document').style.display="none";
	var cv = document.getElementById('sol_document').value;
	var filepart = cv.split(".");
	var part = filepart.length-1;
	var extension = filepart[part];
	extension = extension.toLowerCase();
	if (extension!='jpg' && extension!='jpeg' && extension!='bmp' && extension!='gif' && extension!='png'&& extension!='doc'&& extension!='docx'&& extension!='xls'&& extension!='xlsx'&& extension!='pdf')	
		{
		document.getElementById('sol_document').value="";
		$('#div_sol_document').fadeIn(500);
		}
	}
</script>

<?php
define(SYS_LANG,$lang);
if ($lang=='es') $urlFrontLang='';
else $urlFrontLang=$lang.'/';
$not_uid=  admin::getParam("not_uid");
$sSQL="select * from mdl_notificacion_template where not_uid=$not_uid";
$db->query($sSQL);
$notEdit=$db->next_record();
?>
<div id="DIV_WAIT1" style="display:none;"><img border="0" src="lib/loading.gif"></div>
<br>
<form name="updNot" method="post" action="code/execute/notificacionUpd.php" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::modulesLabels()?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" valign="top"><table width="100%" border="0" cellpadding="5" cellspacing="5" class="box">
         <tr>
            <td colspan="3" class="titleBox">Datos Plantilla</td>
         </tr>
          
	<tr>
            <td width="5%" >Para:</td>
            <td width="20%">XXXXXXXXXX<input id="not_uid" name="not_uid" type="hidden" value="<?=$not_uid?>" /><input id="tipUid" name="tipUid" type="hidden" value="<?=$tipUid?>" /></td>
            <td width="7%">&nbsp;</td>
        </tr>
      	<tr>
            <td width="5%" >Asunto:</td>
            <td width="20%"><input id="not_subject" name="not_subject" class="input3" size="100" maxlength="100" value="<?=$notEdit["not_subject"]?>" /></td>
            <td width="7%">&nbsp;</td>
        </tr>
      	<tr>
            <td width="5%" >Cuerpo:</td>
            <td width="20%"><textarea name="not_template" id="not_template" rows="10" cols="50">
                <?=$notEdit["not_template"]?>
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'not_template' );
            </script>
            </td>
            <td width="7%">&nbsp;</td>
        </tr>
      <!--	<tr>
            <td width="5%" >Firma:</td>
            <td width="20%"><textarea cols="100" class="textarea" rows="5" name="not_sign"><?=$notEdit["not_sign"]?></textarea></td>
            <td width="7%">&nbsp;</td>
        </tr>-->

        
        
    </table>
            
</div>
</td></tr>
</table>
    </td>
  </tr>
</table>
     </form>  
     <br>
            <br>
            <br>

            
    
<br />
      <br />
      
      <div id="contentButton"  style="display:">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="tbl_subasta" >
			<tr>
				<td width="59%" align="center">
                                    <a href="finaliza" onclick="document.updNot.submit();return false;" class="button">Finalizar</a></td>
		<td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="notificacionList.php?tipUid=<?=admin::getParam("tipUid")?>" ><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table>
      
      </div>
<br />
<br />
    
      <br />
      <br />

