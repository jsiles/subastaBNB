<?php
include ("core/admin.php");
admin::initialize('content','contentList'); 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">    
<html>
<head>
<title>Sistema de Subastas > <?=admin::labels('htmltitlepage')?></title>
<link rel="shortcut icon" href="lib/favicon.ico" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/dhtml_horiz.css" type="text/css" />
<META NAME="author" CONTENT="DEVZONE">
<META NAME="reply-to" CONTENT="info@devzone.xyz">
<META NAME="copyright" CONTENT="Software propietario de DEVZONE">
<META NAME="rating" CONTENT="General">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; ISO-8859-1">
<script type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/ajaxlib.js?version=<?=VERSION?>"></script>
<script type="text/javascript" src="js/interface.js"></script>

<!--BEGINIMPROMTU-->
<link rel="stylesheet" type="text/css" href="css/impromptu.css">
<script type="text/javascript" src="js/jquery.Impromptu.js"></script>
<!--ENDIMPROMTU--> 

<script type="text/javascript">        
            function removeList(id, parent, nivel){
                var txt = '<?=admin::labels('delete','sure')?><br><input type="hidden" id="list" name="list" value="'+ id +'" />';
                $.prompt(txt,{
                    show:'fadeIn' ,
                    opacity:0,
                    buttons:{Eliminar:true, Cancelar:false},
                    callback: function(v,m){
                        
                        if(v){
                            var uid = m.find('#list').val();
                            if (nivel==3)
                            {
                             valor =  subSubList[parent] -1;
                             subSubList[parent] = valor 
                            }
                            if (nivel==2)
                            {
                             valor =  SubList[parent] -1;
                             SubList[parent] = valor 
                            }
                            if (nivel==1)
                            {
                             valor =  List[parent];
                            }
                            
                              if (valor>0)
                              {
                              $('#'+uid).fadeOut(500, function(){ $(this).remove(); });
                                  $.ajax({
                                    url: 'code/execute/contentDel.php',
                                    type: 'POST',
                                    data: 'con_uid='+uid
                                });
                                serial = $.SortSerialize('itemList');
                                resetOrderRemove (serial.hash,uid);
                              }
                              else
                              {
                                  moreOffContent(parent);
                                  $('#'+uid).fadeOut(500, function(){ $(this).remove(); });
                                      $.ajax({
                                        url: 'code/execute/contentDel.php',
                                        type: 'POST',
                                        data: 'con_uid='+uid
                                    });                              
                                    serial = $.SortSerialize('itemList');
                                    resetOrderRemove (serial.hash,uid);
                              }
                     
                        }
                        else{}
                        
                    }
                });
            }
            
</script>

</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top"><? include_once("skin/header.php");?>
</td></tr>
  
  <tr>
    <td valign="top" id="content"><? include_once("code/template/contentListTpl.php"); ?></td>
  </tr>
<tr><td>
  <? include("skin/footer.php"); ?>
  </td></tr>
</table>
</body>
</html>