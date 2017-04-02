<?php 
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include_once("../../core/admin.php");
admin::initialize('content','contentList',false);
$con_uid = admin::getParam("con_uid");
if ($lang=='es') $select = "Seleccionar";
else $select = "Select";
if ($con_uid!=0) 
{
  //  $val = admin::getDbValue("select con_parent from mdl_contents where con_uid=$con_uid"); 
                   $sql="select * 
                        from mdl_contents 
                        left join mdl_contents_languages on (con_uid=col_con_uid) 
                        where col_language='" . $lang . "' and con_delete=0 and con_parent=".$con_uid." order by con_position";
                    $db->query($sql);
                    $count = $db->numrows();
                        if ($count>0)
                        {
                                ?>
                                <select id="con_parent2" name="con_parent2" class="listMenu"> 
                                <option value="0"><?=$select?></option>
                                <?php
                                while ($list = $db->next_record())
                                {
                                   $key = $list["con_uid"];
                                   $value = $list["col_title"];
                                   echo  "<option value=\"$key\">$value</option>";
                                  }
                                ?>
                                </select> 
                                <?php
                        }                     
}
    
?>