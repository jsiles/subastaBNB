<?php
   include ("core/admin.php"); 
admin::initialize('setting','setting');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">    
<html>
<head>
<title>Sistema de Subastas > <?=admin::labels('htmltitlepage')?></title>
<link rel="shortcut icon" href="lib/favicon.ico" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/dhtml_horiz.css" type="text/css" />
<!--[if gte IE 5.5]>
<script language="JavaScript" src="css/dhtml.js" type="text/JavaScript"></script>
<![endif]-->
<META NAME="author" CONTENT="DEVZONE">
<META NAME="reply-to" CONTENT="info@devzone.xyz">
<META NAME="copyright" CONTENT="Software propietario de DEVZONE">
<META NAME="rating" CONTENT="General">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; ISO-8859-1">
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
    include_once("skin/header.php");
  ?>
  
  <tr>
    <td valign="top" id="content"><br />
   <a href="#" onClick="serialize('divitem');">s</a>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
      <td width="77%" height="40"><span class="title">Listado de contenidos</span></td>
    <td width="23%" height="40">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" id="contentListing" align="left">
    <div id="divitem" style="list-style:none">
            <li id="tl_1" class="row1"> texto 1 </li>
            <li id="tl_2" class="row2"> texto 2 
            <div id="subitem" style="list-style:none">
                <li id="tl_11" class="row2a"> subcontenido 1 </li>
                <li id="tl_12" class="row2a"> subcontenido 2 </li>
                <li id="tl_13" class="row2a"> subcontenido 3 </li>
            </div>
            </li>
            <li id="tl_3" class="row1"> texto 3 </li>
            <li id="tl_4" class="row2"> texto 2 </li>
            <li id="tl_5" class="row1"> texto 3 </li>
            <li id="tl_6" class="row2"> texto 2 </li>
            <li id="tl_7" class="row1"> texto 3 </li>
            <li id="tl_8" class="row2"> texto 2 </li>
            <li id="tl_9" class="row1"> texto 3 </li>
    </div>        
    
    </td>
    </tr>
</table>
<div id="display" style="clear:both;padding-top:32px"></div>

<br />
      <br /></td>
  </tr>
<script src="js/drag_drop.js" type="text/javascript"></script>
<script type="text/javascript">

   
</script> 
<? include("skin/footer.php"); ?>
</table>
</body>
</html>