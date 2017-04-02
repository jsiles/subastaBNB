<?php
include_once("../../core/admin.php");
include_once("../../core/safeHtml.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('content','contentList',false); 

$con_parent = admin::getParam("con_parent");
$conAudio = admin::getParam("parent");
$con_parent2 = admin::getParam("con_parent2");
$con_parentant = admin::getParam("con_parent_ant");
$con_position = admin::getParam("con_position");

if ($con_parent2=='') $con_parent2=$con_parent;

if ($con_parent2!=$con_parentant)
{
    $sql = "select max(con_position) as POSITION from mdl_contents where con_parent=" . admin::toSql($con_parent,"Number");
    $db->query($sql);
    $Data = $db->next_record();
    $position =  $Data['POSITION'];
    $position = $position + 1;
}else
{
 $position = $_POST["con_position"];
}

if ($con_parent==0&&$con_parent2==0)
    {
    $conlevel = 0;
    }
else if ($con_parent2!=$con_parent&&$con_parent2!=0&&$con_parent!=0)
    {
        $con_parent=$con_parent2;
        $conlevel=2;
    }
else
    {
    $conlevel = 1;
    }

$sql = "update mdl_contents set 
							con_parent=" . $con_parent . ",
							con_position=" . $con_position . ", 
							con_level=" . $conlevel . ", 							
							con_updateuser=" . $_SESSION["usr_uid"] . ", 
							con_updatedate=GETDATE()
		where con_uid='" . $_POST["con_uid"]."'";
        //echo $sql;die;
        $db->query($sql);

$sql = "update mdl_contents_languages set 
							col_title='" . admin::toSql($_POST["col_title"],"Text") . "',
							col_content='" . admin::toSql($_POST["col_content"],"Text") . "',
							col_url='" . admin::urlsFriendly($_POST["col_title"]) . "', 
							col_metatitle='" . admin::toSql($_POST["col_metatitle"],"Text") . "',
							col_metadescription='" . admin::toSql($_POST["col_metadescription"],"Text") . "',
							col_metakeyword='" . admin::toSql($_POST["col_metakeyword"],"Text") . "',
							col_status='" . $_POST["col_status"] . "'   
		where col_con_uid='" . $_POST["con_uid"] . "' and col_language='" . $lang . "'";
$db->query($sql);

 //*****************             begin para llenar obtener multiple uploads          *****/
//krumo($_FILES);
foreach( $_FILES as $key => $FILES2){
	$uid = substr($key,12);
	
	$allowedTypes = array("doc","docx","pdf","txt","xls","xlsx");
	$validFile = $FILES2["error"] == 0 && in_array( strtolower(pathinfo($FILES2["name"],PATHINFO_EXTENSION)) ,$allowedTypes) ? true : false;

	if($validFile && substr($key,0,12)=="edit_adjunt_"){
		$filename = admin::getDBValue("select mcd_ruta from mdl_contents_docs where mcd_uid=".$uid);		

		$info = pathinfo( $filename );	
		$old_name = $info["filename"];
		$info = pathinfo( $FILES2["name"] );	
		$new_extension = $info["extension"];
		$nomDOC = $old_name.".".$new_extension;	
		classfile::uploadFile($FILES2,PATH_ROOT.'/docs/',$nomDOC);
		$sql = "UPDATE mdl_contents_docs SET mcd_ruta='".$nomDOC."' WHERE  mcd_uid = ".$uid ;	
		$db->query($sql);
	}
	if($validFile && substr($key,0,11)=="new_adjunt_"){
		$uid = substr($key,11);
		$info = pathinfo( $FILES2["name"] );	
		$new_extension = $info["extension"];
		$new_name = $info["filename"];
		
		$MaxUid = admin::getDbValue("SELECT max(mcd_uid) FROM mdl_contents_docs");
		$MaxUid = $MaxUid+1;	

		if($_POST["text_adjunt_".$uid]!="")
			$nomDOC = admin::getImageName($_POST["text_adjunt_".$uid])."_".$MaxUid.".".$new_extension;	
		else
			$nomDOC = admin::imageName($new_name)."_".$MaxUid.".".$new_extension;
		classfile::uploadFile($FILES2,PATH_ROOT.'/docs/content/',$nomDOC);

		$sql = "insert into mdl_contents_docs (mcd_uid, mcd_con_uid, mcd_ruta, mcd_delete, mcd_status) values (".$MaxUid.",".$con_uid.",'".$nomDOC."', 0,'ACTIVE')";	
		$db->query($sql);
	}
	
}
$token=admin::getParam("token");

header('Location: ../../contentList.php?token='.$token);
?>