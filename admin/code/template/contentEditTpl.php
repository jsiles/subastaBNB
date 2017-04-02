<?php
$con_uid = admin::toSql(admin::getParam("con_uid"),"Number");
$sql =  "select * from mdl_contents 
            left join mdl_contents_languages on (con_uid=col_con_uid) 
            where col_language='".$lang."' AND con_uid=".$con_uid;
$db->query($sql);
$content = $db->next_record();
$parent = admin::getDbValue("select con_parent from mdl_contents where con_uid=".$content["con_parent"]);

$nivel=admin::getDbValue("select con_level from mdl_contents where con_uid=".admin::toSql(admin::getParam("con_uid"),"Number"));
//echo $nivel;
?>
<br />
<form name="frmContent" method="post" action="code/execute/contentUpd.php?token=<?=admin::getParam("token")?>" onsubmit="return false;" enctype="multipart/form-data">
<input type="hidden" name="con_parent_ant" value="<?=$content["con_parent"]?>" />
<input type="hidden" name="con_position" value="<?=$content["con_position"]?>" />
<input type="hidden" name="con_uid" value="<?=$content["con_uid"]?>" />
<input type="hidden" name="parent" value="<?=$parent?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="77%" height="40"><span class="title"><?=admin::labels('contents','edit');?></span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="54%" valign="top"><table width="98%" border="0" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td colspan="3" class="titleBox"><?=admin::labels('contents','data');?></td>
            </tr>
          <tr>
            <td width="29%"><?=admin::labels('contents','name');?>:</td>
            <td width="64%">
<input name="col_title" type="text" class="input" id="col_title" tabindex="1" onfocus="setClassInput(this,'ON');document.getElementById('div_col_title').style.display='none';" onblur="setClassInput(this,'OFF');document.getElementById('div_col_title').style.display='none';" onclick="setClassInput(this,'ON');document.getElementById('div_col_title').style.display='none';" value="<?=$content["col_title"]?>" size="50"/>
<br />
<span id="div_col_title" style="display:none; padding-left:5px; padding-right:5px;" class="error">Nombre del contenido es necesario</span>			</td>
          </tr>
          <tr style="display:<?=$_GET["wys"]=="off" ? "none":""?>">
            <td><?=admin::labels('contents','in');?>: </td>
            <td>
			<?php
            if ($nivel==2)
            {
            $sql= "select * from mdl_contents where con_uid=".$content["con_parent"];
            $db->query($sql);
            $contenparent = $db->next_record();
            $con_parentuid = $contenparent["con_parent"];
            $sw=true;
            }
            else
            {
                $sw=false;
                $con_parentuid = $content["con_parent"];
            }
            
               $sql = "select * 
                        from mdl_contents 
                        left join mdl_contents_languages on (con_uid=col_con_uid) 
                        where col_language='" . $lang . "'  and 
							  con_uid<>" . $con_uid  . " and 
							  con_delete<>1 
                        and con_parent=0 order by con_position";
               $db->query($sql);                                
                //echo $sql;
                ($content["con_parent"]==0)?$selected="selected":$selected="";
                 //echo $content["con_parent"].$selected;
                ?>
				<select name="con_parent" class="listMenu" id="con_parent"  tabindex="2">	<!--onchange="subList(this);"-->			
				<option value="0" <?=$selected?>><?=admin::labels('principal');?></option>
				<?
				while ($category = $db->next_record())
				{ 
                    ($category["con_uid"]==$con_parentuid)?$selecte2="selected":$selecte2=""; 
                   //echo $category["con_uid"].$con_parentuid.$selecte2; 
                    ?>
				<option value="<?=$category["con_uid"]?>" <?=$selecte2?>><?=$category["col_title"]?></option>
				<? } ?>
            </select>
			<span id="div_con_parent" style="display:none;" class="error"></span>            </td>
          </tr>
          <tr>
            <td></td>
            <td><div style="display:none">
<? if ($sw)
    {

    ?>            
            <span id="div_con_parent2" style="diplay:">
    <? 
//                  echo  $con_parentuid . $content["con_parent"] ;
                  $sql="select * 
                        from mdl_contents 
                        left join mdl_contents_languages on (con_uid=col_con_uid) 
                        where col_language='" . $lang . "' and 
							  con_parent=". $con_parentuid ."
                        order by con_position";
                    $db->query($sql);
                    $count = $db->numrows();
                    if ($count>0)
                    {
                    ?>
                    <select id="con_parent2" name="con_parent2" class="listMenu" tabindex="3"> 
                    <option value="0"><?=admin::labels('select');?></option>
                    <?
                    while ($list = $db->next_record())
                    {
                       $key = $list["con_uid"];
                       $value = $list["col_title"];
                       if ($key==$content["con_parent"])  $option = "<option value=\"$key\" selected>$value</option>";
                       else $option = "<option value=\"$key\">$value</option>";
                       echo $option;
                       
                    }
                    ?>
                    </select> 
                    <?
                    }
                    ?>
            </span>
            
 <?
    }
    else
    {
 ?>
            <span id="div_con_parent2" style="diplay:none"></span>
 <?    
     }
 ?>
 </div>
 </td>

          </tr>
          
          <?php  //include_once("load_image.php");?> 
          
          <tr>
            <td><?=admin::labels('status');?>:</td>
            <td>

			<select name="col_status" class="listMenu" id="col_status" tabindex="4">
            	<option value="ACTIVE" <? if ($content["col_status"]=="ACTIVE") echo "selected"; ?>><?=admin::labels('active');?></option>
              	<option value="INACTIVE" <? if ($content["col_status"]=="INACTIVE") echo "selected"; ?>><?=admin::labels('inactive');?></option>
			</select>
			<span id="div_col_status" style="display:none;" class="error"></span>			</td>
          </tr>
         
          
          
        </table> 
        <br />
    <? include_once("load_massUpload.php");?>
    </td>
        <td width="46%" valign="top"><table width="100%" border="0" align="right" cellpadding="5" cellspacing="5" class="box">
          <tr>
            <td colspan="3" class="titleBox"><?=admin::labels('seo');?></td>
          </tr>
          <tr>
            <td width="22%"><?=admin::labels('seo','metatitle');?>:</td>
            <td width="71%"><input name="col_metatitle" type="text" class="input" id="col_metatitle" tabindex="5"  onfocus="setClassInput(this,'ON');" onblur="setClassInput(this,'OFF');" onclick="setClassInput(this,'ON');" value="<?=$content["col_metatitle"]?>" size="46"/>
			<span id="div_col_metatitle" style="display:none;" class="error"></span>			</td>
          </tr>
          <tr>
            <td valign="top"><?=admin::labels('seo','metadescription');?>:</td>
            <td>
			<textarea name="col_metadescription" cols="33" rows="3" class="textarea" id="col_metadescription" tabindex="6"  onfocus="setClassTextarea(this,'ON');" onblur="setClassTextarea(this,'OFF');" onclick="setClassTextarea(this,'ON');" onkeydown="growTextarea(this);"><?=$content["col_metadescription"]?></textarea>			
			<span id="div_col_metadescription" style="display:none;" class="error"></span>			</td>
          </tr>
          <tr>
            <td valign="top"><?=admin::labels('seo','metakeywords');?>: </td>
            <td><textarea name="col_metakeyword" cols="33" rows="3" class="textarea" id="col_metakeyword" tabindex="7"  onfocus="setClassTextarea(this,'ON');" onblur="setClassTextarea(this,'OFF');" onclick="setClassTextarea(this,'ON');" onkeydown="growTextarea(this);"><?=$content["col_metakeyword"]?></textarea>
			<span id="div_col_metakeyword" style="display:none;" class="error"></span>			</td>
          </tr>
          
        </table> </td>
      </tr>
    </table></td>
    </tr>
</table>
      <br />
	  <?
	if ($_REQUEST["wys"]!="off")
		{
		?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" valign="top" id="contentWysiwyg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			    <tr>
                <td align="center" valign="top" height="3px;"></td>
              </tr>
              <tr>
                <td align="center" valign="top"><?
		
			include("spaw/spaw.inc.php");
			$spaw1 = new SpawEditor("col_content",$content["col_content"]); 
			$spaw1->show(); 
			?></td>
              </tr>
              <tr>
                <td align="center" valign="top" height="3px;"></td>
              </tr>          
          </table></td>
        </tr>
      </table>
  <? } ?>
	  </form>
      <br />
      <br />
      <div id="contentButton">
	  	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="59%" align="center">
				<a href="javascript:verifyContent();" class="button" tabindex="8">
				<?=admin::labels('update');?>
				</a> 
				</td>
          <td width="41%" style="font-size:11px;">
		  		<?=admin::labels('or');?> <a href="contentList.php?token=<?=admin::getParam("token")?>" tabindex="9"><?=admin::labels('cancel');?></a> 
		  </td>
        </tr>
      </table></div>
      <br /><br />
<br />
<br />

      <br />
      <br />
