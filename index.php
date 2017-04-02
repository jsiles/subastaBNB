<?php
include_once("admin/core/admin.php");
admin::initializeClient();
//echo "mensaje usuario:";
//echo admin::getSession("uidClient");
$Category=admin::getDBvalue("SELECT col_title FROM mdl_contents_languages WHERE col_uid=2");
$CategoryUrl=admin::getDBvalue("SELECT col_url FROM mdl_contents_languages WHERE col_uid=2");
$sql = "SELECT top 1 * 
		FROM mdl_contents 
		LEFT JOIN mdl_contents_languages ON (con_uid=col_con_uid) 
		WHERE 	con_delete<>1 and 
				col_status='ACTIVE' and 
				col_language='".$lang."' and 
				con_uid=1 ";
$db->query($sql);
$content_details = $db->next_record();

if ($content_details["col_metatitle"]) $seo = ucfirst(strtolower($content_details["col_metatitle"])).' &gt; ';
else $seo=' ';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="shortcut icon" href="<?=$domain?>/lib/favicon.ico" />
<link href="<?=$domain?>/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="<?=$domain?>/css/thickbox.css" type="text/css" media="screen" /> 
<script type="text/javascript">var SERVER='<?=$domain?>'; </script>
<script type="text/javascript" src="<?=$domain?>/js/jquery.js"></script>
<script type="text/javascript" src="<?=$domain?>/js/thickbox.js"></script>
<link href="<?=$domain?>/css/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<script src="<?=$domain?>/js/facebox.js" type="text/javascript"></script>
<style type="text/css">
@import "<?=$domain?>/css/layout.css";
</style>
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loading_image : '<?=$domain?>/lib/libface/loading.gif',
        close_image   : '<?=$domain?>/lib/libface/closelabel.gif'
      }) 
    })
  </script>
</head>
<body class="listings" >
<div id="wrapper">
	<div id="wrapper-bgbtm">
		<?php include("code/header.php");?>
        <?php include("code/menu_header.php");?>
        <div id="page" class="container">
			<?php include("code/categorias.php");?>
			<?php include("code/column.php");?>
		</div>
	</div>
</div>
<?php include("code/footer.php");?>
</body>
</html>
