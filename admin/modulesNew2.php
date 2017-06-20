<?php include ("core/admin.php"); 
admin::initialize('team','teamNew'); ?>
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
<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">
<META NAME="author" CONTENT="DEVZONE">
<META NAME="reply-to" CONTENT="info@devzone.xyz">
<META NAME="copyright" CONTENT="Software propietario de DEVZONE">
<META NAME="rating" CONTENT="General">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; ISO-8859-1">
<script language="javascript" type="text/javascript" src="js/jquery-pack.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top"><? include_once("skin/header.php");?>
</td></tr>
  <tr>
    <td valign="top" id="content"><? include_once("code/template/teamNew2Tpl.php"); ?></td>
  </tr>
<tr><td>
  <? include("skin/footer.php"); ?>
  </td></tr>
</table>
</body>
</html>