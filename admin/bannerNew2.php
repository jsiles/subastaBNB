<?php  
include ("core/admin.php"); 

admin::initialize('banners','bannerNew');

$token=admin::getParam("token");
$ban_uid=admin::getParam("ban_uid");

if ($ban_uid=="") echo "<script>document.location.href='bannerList.php?token=".$token."';</script>";
$til_image=admin::getDBvalue("SELECT ban_file FROM mdl_banners where ban_uid='".$ban_uid."'");

//el crop se hara a los siguientes valores
$anchoNew=770;
$altoNew=100;
$ratio=(float)($anchoNew/$altoNew);  //ratio del cropeador base de desicion para la imagen

//se saca medidas de la imagen original a hacer cropeada
$origen=$domain.'/img/banner/Original_'.$til_image;
list($widthOriginal, $heightOriginal) = getimagesize($origen);
$ratioOriginal=(float)($widthOriginal/$heightOriginal);

//calculo porcentual de lo que se sacara a la imagen
$porcentLess=10;
$porcentCalculateX=(float)($widthOriginal*($porcentLess/100));
$porcentCalculateY=(float)($heightOriginal*($porcentLess/100));

// x0,x1,y0,y1
//$anchoNewTopL,$anchoNewTopL,$altoNewBottomL,$anchoNewTopR

	if($ratio>=1){
	//caso 1 manda el ancho sobre la original
		if($ratioOriginal>=1){
			//caso A manda el ancho en la original
			
			$anchoNewTopL=$porcentCalculateX;
			$altoNewBottomL=$widthOriginal-$porcentCalculateX;
			
			$anchoNewTopR=$porcentCalculateY;
			$altoNewBottomR=$heightOriginal-$porcentCalculateY;
		}
		else{	
			//caso B manda el alto en la original
			$anchoNewTopL=$porcentCalculateX;
			$altoNewBottomL=$widthOriginal-$porcentCalculateX;
			
			$anchoNewTopR=$porcentCalculateY;
			$altoNewBottomR=$heightOriginal-$porcentCalculateY;
		
		}
	}
	else{
	//caso 2 manda el alto sobre la original
		if($ratioOriginal>=1){
			//caso A manda el ancho en la original
			
			$anchoNewTopL=$porcentCalculateX;
			$altoNewBottomL=$widthOriginal-$porcentCalculateX;
			
			$anchoNewTopR=$porcentCalculateY;
			$altoNewBottomR=$heightOriginal-$porcentCalculateY;
		}
		else{	
			//caso B manda el alto en la original
			$anchoNewTopL=$porcentCalculateX;
			$anchoNewTopR=$porcentCalculateY;
			
			$altoNewBottomL=$widthOriginal-$porcentCalculateX;
			$altoNewBottomR=$heightOriginal-$porcentCalculateY;
		
		}
	}
/*echo 'original - '.$widthOriginal.' - '.$heightOriginal.'<br />';
echo '% - '.$porcentCalculateX.' - '.$porcentCalculateY.'<br />';	
echo $anchoNewTopL.' - '.$anchoNewTopR.' - '.$altoNewBottomL.' - '.$altoNewBottomR;*/
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
<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta name="author" content="DEVZONE">
<meta name="reply-to" content="info@devzone.xyz">
<meta name="copyright" content="Software propietario de DEVZONE">
<meta name="rating" content="General">
<META HTTP-EQUIV="Content-Type" content="text/html; ISO-8859-1">
<script language="javascript" type="text/javascript" src="js/jquery-pack.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
</head>
<body>

<div id="mask"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top"><?php include_once("skin/header.php");?>
</td></tr>
  <tr>
    <td valign="top" id="content"><?php include_once("code/template/bannerNew2Tpl.php"); ?></td>
  </tr>
<tr><td>
  <?php include("skin/footer.php"); ?>
  </td></tr>
</table>
</body>
</html>