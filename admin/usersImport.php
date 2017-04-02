<? include_once("database/connection.php"); ?>
<? include ("core/admin.php"); ?>
<? include ("core/files.php"); ?>
<? admin::initialize('import','importNew'); ?>
<?
$FILES = $_FILES["use_file"];
// SUBIENDO EL DOCUMENTO DE NOTICIAS
if ($FILES["name"] != '')
	{
//	echo $FILES["name"];die;
//	$ext = admin::getExtension($FILES ["name"]);
	$nomDOC = $FILES["name"];
	//admin::imageName($_POST["new_title"]) . "_". $new_uid . "." . $ext;	
	classfile::uploadFile($FILES,'upload/users/',$nomDOC);	
	$filename_to_read = file("upload/users/" . $nomDOC);
	
	foreach($filename_to_read as $linea) 
		{
		$infoInsert ="";
		$sql = "";
		$rowsList = explode(";",$linea);
		$lastname="";
		$name="";
		$rowNum=0;
		foreach($rowsList as $row)
			{
			$rowNum++;
			switch($rowNum)
				{
				case 1 :
						$sql = "select gru_uid 
								from mdl_bulletin_group 
								where gru_name='" . trim($row) . "' 
								limit 1";
						$db->query($sql);
						$numgroup = $db->numrows();
						if ($numgroup>0)
							{
							$group = $db->next_record();
							$gru_uid = $group["gru_uid"];
							}
						else
							{
							//gru_uid
							$sql = "insert into mdl_bulletin_group 
										(
										gru_name,
										gru_status,
										gru_delete
										)
									values
										(
										'" . trim($row) . "',
										'ACTIVE',
										0
										)";
							$db->query($sql);
							// ULTIMO REGISTRO
							$sql="SELECT LAST_INSERT_ID() as UID;";
							$db2->query($sql);
							$content = $db2->next_record();
							$gru_uid = $content["UID"];
							}			 
						break;
				case 2 : 
						$infoInsert = "'" . trim($row) . "',";
						break;
				case 3 :
						$infoInsert = $infoInsert . "'" . trim($row) . "',";
						break;

				}
			}	
		//use_uid,
		$sql = "insert into mdl_bulletin_users  
					(						
					use_firstname,
					use_mail,
					use_delete,
					use_gru_uid
					)
				value
					(
				    " . $infoInsert . " 
					0,
					" . $gru_uid . "
					)";
//		echo $sql;die;
		$db->query($sql);

		$msg="Importado con exito";
		}
	}
	//echo "INSERTADO";die;
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
<script language="javascript" type="text/javascript" src="js/ajaxlib.js?version=<?=VERSION?>"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/interface.js"></script>
<!--BEGINIMPROMTU-->
<link rel="stylesheet" type="text/css" href="css/impromptu.css">
<script type="text/javascript" src="js/jquery.Impromptu.js"></script>
<!--ENDIMPROMTU--> 
<script type="text/javascript">        
function removeList(id){
	var txt = '<?=admin::labels('delete','sure')?><br><input type="hidden" id="list" name="list" value="'+ id +'" />';
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Eliminar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();

				  $('#'+uid).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/pressDel.php',
						type: 'POST',
						data: 'uid='+uid
					});
		 
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
    <td valign="top" id="content">
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="77%" height="40">
		<span class="title">Importar Usuarios </span>
		</td>
		<td width="23%" height="40">&nbsp;</td>
	</tr>
  	<tr>
    	<td colspan="2" id="contentListing">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		 	<tr>
			<td width="50%" valign="top">
	
	<script>
	function verifyImport()
		{
		if (document.getElementById('use_file').value!="")
			{
			document.frmImport.submit();
			}
		}
	</script>
	
	<form name="frmImport" method="post" enctype="multipart/form-data" action="">
	<input type="file" name="use_file" id="use_file">
	<input type="button" name="Importar" value="Importar" onClick="verifyImport();">
	</form>	
	<br><br>
<?=$msg?>
</td>
				</tr>
			</table>
		</td>
	</tr>
	</table>
	</td>
  </tr>
<tr><td>
  <? include("skin/footer.php"); ?>
  </td></tr>
</table>
</body>
</html>