<?php
include_once("../../core/admin.php");
include_once("../../core/safeHtml.php");
include_once("../../core/files.php");
admin::initialize('content','contentList',false);

if ($_POST["con_parent"]==0)
	{
	$conlevel = 0;
    $parent = $_POST["con_parent"];
	}
else
	{
        if ($_POST["con_parent2"]==0)
	    {
            $conlevel = 1;
            $parent = $_POST["con_parent"];
        }
        else 
        {
            $conlevel=2;
            $parent = $_POST["con_parent2"];
        }
	}

$sql = "select COUNT(*) as POSITION 
        from mdl_contents 
        where con_parent=" . admin::toSql($parent,"Number");
$db->query($sql);
$Data = $db->next_record();
$position =  $Data['POSITION'];
if ($position<>0) $position = $position + 1;

$sql = "insert into mdl_contents(
								con_parent,
								con_level,
								con_position,
								con_createuser,
								con_createdate,
								con_updateuser,
								con_updatedate,
								con_delete
								) 
						values	(
								" . admin::toSql($parent,"Number") . ", 
								" . admin::toSql($conlevel,"Number") . ", 
								" . admin::toSql($position,"Number") . ", 
								" . admin::toSql($_SESSION["usr_uid"],"Number") . ", 
								GETDATE(), 
								" . admin::toSql($_SESSION["usr_uid"],"Number") . ", 
								GETDATE(), 
								0)";
$db->query($sql);

// OBTENEMOS EL ULTIMO ID INSTRODUCIDO POR EL USUARIO EN LA CONSULTA SUPERIOR
$sql = "select con_uid 
		from mdl_contents 
		where con_parent=" . $parent . " 
		order by con_uid desc limit 1";
$db2->query($sql);
$content = $db2->next_record();
$con_uid = $content["con_uid"];


$sql = "insert into sys_modules_users set mus_rol_uid=2, mus_mod_uid=".$con_uid .", mus_place='CONTENT', mus_delete=0 ";
$db->query($sql);
$sql = "insert into sys_modules_users set mus_rol_uid=1, mus_mod_uid=".$con_uid .", mus_place='CONTENT', mus_delete=0 ";
$db->query($sql);

// GUARDAMOS EN LOS LENGUAGES QUE SE ENCUENTREN ACTIVOS EN LA TABLA SYS_LANGUAGE
$sql = "select * from sys_language where lan_status='ACTIVE' and lan_delete<>1";
$db2->query($sql);
while ($sys_language = $db2->next_record())
	{
	// ACTIVANDO SOLO EN EL LENGUAJE EN EL QUE FUE CREADO
	if ($lang==$sys_language["lan_code"]) $col_status = $_POST["col_status"];
	else $col_status="INACTIVE";
	// col_uid
	$sql = "insert into mdl_contents_languages(
								col_con_uid,
								col_language,
								col_title,
								col_content,
								col_url,
								col_metatitle,
								col_metadescription,
								col_metakeyword,
								col_status
								) 
						values	(
								" . admin::toSql($con_uid,"Number") . ", 
								'" . $sys_language["lan_code"] . "', 
								'" . admin::toSql($_POST["col_title"],"Text") . "', 
								'" . admin::toSql($_POST["col_content"],"Text") . "', 
								'" . admin::urlsFriendly($_POST["col_title"]) . "',
								'" . admin::toSql($_POST["col_metatitle"],"Text") . "', 
								'" . admin::toSql($_POST["col_metadescription"],"Text") . "', 
								'" . admin::toSql($_POST["col_metakeyword"],"Text") . "',
								'" . admin::toSql($col_status,"Text") . "'
								)";
	$db->query($sql);
	}
 //*****************             begin para llenar obtener multiple uploads          *****/
$maxVal=admin::getParam("maxVal");
for ($i = 1; $i <= $maxVal; $i++) 
{
	$val='new_adjunt_'.$i;
	$FILES2 = $_FILES [$val];
	
	$allowedTypes = array("doc","docx","pdf","txt","xls","xlsx");
	$validFile = $FILES2['error'] == 0 && in_array( strtolower(pathinfo($FILES2["name"],PATHINFO_EXTENSION)),$allowedTypes) ? true : false;
	
		if($validFile){
			if ($FILES2["name"] != '') $nombreOrig2 = substr($FILES2["name"], 0, strpos($FILES2["name"], "."));	
			
			$MaxUid = admin::getDbValue("SELECT max(mcd_uid) FROM mdl_contents_docs");
			$MaxUid = $MaxUid+1;	
			
			$ext = admin::getExtension($FILES2["name"]);
			if($_POST["text_adjunt_".$i]!="")
				$nomDOC = admin::getImageName($_POST["text_adjunt_".$i])."_".$MaxUid.".".$ext;	
			else
				$nomDOC = admin::imageName($nombreOrig2."_".$MaxUid).".".$ext;	
			classfile::uploadFile($FILES2,PATH_ROOT.'/docs/content/',$nomDOC);
				
			$sql = "insert into mdl_contents_docs (mcd_uid, mcd_con_uid, mcd_ruta, mcd_delete, mcd_status) values (".$MaxUid.",".$con_uid.",'".$nomDOC."', 0,'ACTIVE')";
			$db->query($sql);
		}
	}
$token=admin::getParam("token");

header('Location: ../../contentList.php?token='.$token);		
?>