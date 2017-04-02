<?php
$i=0;
$cantDocs=admin::getDbValue("select count(*) from tbl_publicaciones_docs where cdo_dol_uid='".$dol_uid."' and cdo_delete=0 and cdo_status='ACTIVE'");

if ($cantDocs>0)
{
?>
<div id="dname" style="display:none"><?=admin::labels('docs','name')?>: </div>
<div id="adname" style="display:none"><?=admin::labels('annex','adjunt')?>:</div>
 
<table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">			
			<tr>
			<td  class="titleBox"><br />&nbsp;&nbsp;&nbsp;<?=admin::labels('docs','adjunts');?>:</td>
            <td ></td>
			</tr>
			
		  <tr><td></td><td><a href="" onclick="addMoreCla2(); return false;">+ Agregar Uploaders</a></td></tr>
            <tr>
			<td colspan="2" >  
	   <div class="items">
  			<div class="clear"></div>        
            
            <div class="listOpt" id="child">
              <!-- <ul id="child">-->
               <?php
	  			$sql3 =  "select * from tbl_publicaciones_docs where cdo_dol_uid='".$dol_uid."' and cdo_delete=0 and cdo_status='ACTIVE'";
				//krumo($sql);
				$db3->query($sql3);
               	while ($content3= $db3->next_record())
			   	{ 
				$i++;
			   ?>
					<div class="list_<?=$i?>" id="list_<?=$i?>">
					<table width="100%" border="0" cellpadding="5" cellspacing="5">
					
		  
                  	<tr>
            			<td colspan="2">
							<?php 
                            $imgSavedroot2 = PATH_ROOT."/docs/publicaciones/".$content3["cdo_ruta"];
                            $imgSaveddomain2 = PATH_ROOT."/docs/publicaciones/".$content3["cdo_ruta"];
                            //echo $imgSaveddomain2;die;
                            if (file_exists($imgSavedroot2) && $content3["cdo_ruta"]!="")
                                { 
                                $extension = admin::getExtension($content3["cdo_ruta"]);
                            //echo $extension;die;
                                $imgextension = admin::getExtensionImage($extension);
                            //	echo $imgextension;die;
                            ?>
                            <div id="document_edit_<?=$content3["cdo_uid"]?>">
                            <div id="changeFile">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
							
                            <tr>
                                <td width="18%" rowspan="2" align="center" valign="top">
                                <? if ($imgextension!="") { ?>
                                    <a href="<?=$imgSaveddomain2?>" target="_blank"><img border="0" src="<?=$imgextension?>" width="16" height="16"/></a>
                                <? } ?>				</td>
                                <td width="82%" style="font-size:11px;">
                                <span class="nameFile"><?=substr($content3["cdo_ruta"],0,20);?>...</span>
                            <br />
                             <!--<a href="javascript:chageUploadFile('on',<?=$i?>)" class="small2">
                            <?=admin::labels('change');?>
                                </a> <span class="pipe">|</span>--><a href="#" onclick="removeDoc(<?=$content3["cdo_uid"]?>,<?=$i;?>);return false;" title="<?=admin::labels('del')?>" class="small3"><?=admin::labels('del')?></a>				</td>
                            </tr>
                            <tr>
                                <td  valign="top"><div id="div_adjunt_file_change_<?=$i?>" style="display:none">
                                <table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td>
                                <input type="file" name="edit_adjunt_<?=$content3["cdo_uid"]?>" id="edit_adjunt_<?=$content3["cdo_uid"]?>" size="13" style="font-size:11px;" class="input5"></td>
                                <td> <a href="#" onclick="chageUploadFile(<?=$i?>); return false;"><img border="0" src="lib/close.gif" align="top"/></a>				</td>
                                </tr>
                                </table>
                                </div>				</td>
                            </tr>
                            </table>
                            </div>
                            </div>
                            <div id="document_add_<?=$content3["cdo_uid"]?>" style="display:none;"></div>
                            <?php } 
                            else
                                { ?>
                                <input type="file" name="new_adjunt_<?=$i?>" id="new_adjunt_<?=$i?>" size="31" class="input">
                            <?php	} ?>
			</td>
          			</tr>
                    </table>
                	</div>
             <?php	
			} ?>        
         <!--   </ul>--> 
            </div>
            <div class="clear"></div>
            </div>    
            </td>
			</tr>
         </table><input id="maxVal" name="maxVal" value="<?=$i?>" type="hidden" />
<?php	
}
else
{ ?>                 
<table width="98%"  border="0" cellpadding="0" cellspacing="0" class="box">			
			<tr>
			<td colspan="2"  class="titleBox"><br />&nbsp;&nbsp;&nbsp;<?=admin::labels('docs','adjunts');?>:</td>
           
			</tr>
            <tr>
			<td colspan="2" >  
	   <div class="items">
  			<div class="clear"></div>        
         
            <div class="listOpt">
               <!--<ul id="child">-->
					<div class="list_1" id="child">
					<table width="100%" class="box" border="0" cellpadding="5" cellspacing="5">
		  <tr><td></td><td><a href="" onclick="addMoreCla2(); return false;">+ Agregar Uploaders</a></td></tr>
					<tr>
					<td width="29%" id="dname"><?=admin::labels('docs','name')?>: </td>
					<td><input type="text" name="text_adjunt_1" id="text_adjunt_1" size="50" class="input" />
					<br /><span id="div_text_adjunt_1" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('contents','titleerror');?></span>
					</td>
					</tr>
                  	<tr>
            			<td width="29%" id="adname"><?=admin::labels('annex','adjunt')?>: </td>
            			<td><input type="file" name="new_adjunt_1" id="new_adjunt_1" size="31" class="input">
						<br /><span id="div_new_adjunt_1" style="display:none; padding-left:5px; padding-right:5px;" class="error">Tipo de archivo no permitido</span>
						</td>
          			</tr>
                    </table>
                	</div>                                      
           <!-- </ul> -->
            </div>
            <div class="clear"></div>
            </div>    
            </td>
			</tr>
         </table>
          <input id="maxVal" name="maxVal" value="1" type="hidden" /> 
 <?php	} ?>        