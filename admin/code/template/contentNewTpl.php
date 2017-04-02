<br />
<form name="frmContent" method="post" action="code/execute/contentAdd.php?token=<?=admin::getParam("token")?>" onsubmit="return false;" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::labels('contents','create');?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="54%" valign="top">
		
		<table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td colspan="3" class="titleBox"><?=admin::labels('contents','data');?></td>
            </tr>
          <tr>
            <td width="29%"><?=admin::labels('contents','name');?>:</td>
            <td width="64%">
<input name="col_title" type="text" class="input" id="col_title" tabindex="1" onfocus="setClassInput(this,'ON');document.getElementById('div_col_title').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_col_title').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_col_title').style.display='none';" size="50" />
<br /><span id="div_col_title" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels('contents','titleerror');?></span>			</td>
          </tr>
          <tr>
            <td><?=admin::labels('contents','in');?>: </td>
            <td>
			
				<select name="con_parent" class="listMenu" id="con_parent"  tabindex="2">		<!--onchange="subList(this);"-->		
				<? 
				$sql = "select * from mdl_contents left join mdl_contents_languages on (con_uid=col_con_uid) 
						where col_language='".$lang."' and con_uid!=1 and con_parent=0 and con_delete<>1 order by con_position";
				$db->query($sql)				
				?>
				<option value="0" selected="selected"><?=admin::labels('principal');?></option>
				<?
				while ($category = $db->next_record())
				{ ?>
				<option value="<?=$category["con_uid"]?>"><?=$category["col_title"]?></option>
				<? } ?>
            </select>
			<span id="div_con_parent" style="display:none;" class="error"></span>            </td>
          </tr>
          <tr>
            <td></td>
            <td><span id="div_con_parent2" style="diplay:none">
            </span></td>
          </tr>
           
		   <?php  //include_once("load_image.php");?> 
           
          <tr>
            <td><?=admin::labels('status');?>:</td>
            <td>
			<select name="col_status" class="listMenu" id="col_status" tabindex="3">
            	<option selected="selected" value="ACTIVE"><?=admin::labels('active');?></option>
              	<option value="INACTIVE"><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_col_status" style="display:none;" class="error"></span>			</td>
          </tr>
        </table>
        <br />
 	   <? include_once("load_massUpload.php");?>
        
		</td>
        <td width="46%" valign="top">
		<table width="98%" border="0" align="right" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td colspan="3" class="titleBox"><?=admin::labels('seo');?></td>
          </tr>
          <tr>
            <td width="22%"><?=admin::labels('seo','metatitle');?>:</td>
            <td width="71%"><input name="col_metatitle" type="text" class="input" id="col_metatitle" tabindex="4"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" size="46"/>
			<span id="div_col_metatitle" style="display:none;" class="error"></span>			</td>
          </tr>
          <tr>
            <td valign="top"><?=admin::labels('seo','metadescription');?>:</td>
            <td>
			<textarea name="col_metadescription" cols="33" rows="3" class="textarea" id="col_metadescription" tabindex="5"  onfocus="setClassTextarea(this,'ON');" onblur="setClassTextarea(this,'OFF');" onclick="setClassTextarea(this,'ON');"  onkeydown="growTextarea(this);"></textarea>
			<span id="div_col_metadescription" style="display:none;" class="error"></span>			</td>
          </tr>
          <tr>
            <td valign="top"><?=admin::labels('seo','metakeywords');?>: </td>
            <td>
			<textarea name="col_metakeyword" cols="33" rows="3" class="textarea" id="col_metakeyword" tabindex="6"  onfocus="setClassTextarea(this,'ON');" onblur="setClassTextarea(this,'OFF');" onclick="setClassTextarea(this,'ON');"  onkeydown="growTextarea(this);"></textarea>
			<span id="div_col_metakeyword" style="display:none;" class="error"></span>			</td>
          </tr>
        </table>
		</td>
      </tr>
    </table></td>
    </tr>
</table>
      <br />
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" id="contentWysiwyg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			    <tr>
                <td align="center" valign="top" height="3px;"></td>
              </tr>
              <tr>
                <td align="center" valign="top"><?
			include("spaw/spaw.inc.php");
			$spaw1 = new SpawEditor("col_content"," "); 
			$spaw1->show(); 
		?></td>
              </tr>
              <tr>
                <td align="center" valign="top" height="3px;"></td>
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
				<a href="javascript:verifyContent();" class="button" tabindex="7">
				<?=admin::labels('public');?>
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="contentList.php?token=<?=admin::getParam("token")?>" tabindex="8" ><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table></div>
      <br /><br />
<br />
<br />