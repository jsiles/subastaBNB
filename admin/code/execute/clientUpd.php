<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
include_once("../../../classes/class.SymmetricCrypt.inc.php");
admin::initialize('client','clientEdit',false);

$cli_uid = admin::toSql(safeHtml(admin::getParam("cli_uid")),"String");
$cli_interno = admin::toSql(safeHtml(admin::getParam("cli_interno")),"String");
$cli_lec_uid = admin::toSql(safeHtml(admin::getParam("cli_lec_uid")),"String");
$cli_cov_uid = admin::toSql(safeHtml(admin::getParam("cli_cov_uid")),"String");
$cli_socialreason = admin::toSql(safeHtml(admin::getParam("cli_socialreason")),"String");
$cli_legaldirection = admin::toSql(safeHtml(admin::getParam("cli_legaldirection")),"String");
$cli_phone = admin::toSql(safeHtml(admin::getParam("cli_phone")),"String");
$cli_mainemail = admin::toSql(safeHtml(admin::getParam("cli_mainemail")),"String");
$cli_commercialemail = admin::toSql(safeHtml(admin::getParam("cli_commercialemail")),"String");
$cli_legal_ci = admin::toSql(safeHtml(admin::getParam("cli_legal_ci")),"String");
$cli_legalname = admin::toSql(safeHtml(admin::getParam("cli_legalname")),"String");
$cli_legallastname = admin::toSql(safeHtml(admin::getParam("cli_legallastname")),"String");
$cli_legal_ci2 = admin::toSql(safeHtml(admin::getParam("cli_legal_ci2")),"String");
$cli_legalname2 = admin::toSql(safeHtml(admin::getParam("cli_legalname2")),"String");
$cli_legallastname2 = admin::toSql(safeHtml(admin::getParam("cli_legallastname2")),"String");
$cli_legal_ci3 = admin::toSql(safeHtml(admin::getParam("cli_legal_ci3")),"String");
$cli_legalname3 = admin::toSql(safeHtml(admin::getParam("cli_legalname3")),"String");
$cli_legallastname3 = admin::toSql(safeHtml(admin::getParam("cli_legallastname3")),"String");
$cli_commercialname = admin::toSql(safeHtml(admin::getParam("cli_commercialname")),"String");
$cli_commerciallastname = admin::toSql(safeHtml(admin::getParam("cli_commerciallastname")),"String");
$cli_user = admin::toSql(safeHtml(admin::getParam("cli_user")),"String");
$cli_pass = md5(admin::toSql(safeHtml(admin::getParam("cli_pass")),"String"));
$cli_pts_uid = admin::toSql(safeHtml(admin::getParam("cli_pts_uid")),"String");
$item_uid = admin::getParam("nivel1_uid");
$cli_ite_uid =  admin::getParam("nivel2_uid");
$cli_status = admin::toSql(safeHtml(admin::getParam("cli_status")),"String");	
$cli_exist = admin::getDBvalue("select count(cli_user) FROM mdl_client where cli_nit_ci='".$cli_nit_ci."' and cli_delete=0");

$sql = "update mdl_client set
			cli_lec_uid='".$cli_lec_uid."',
			cli_interno='".$cli_interno."',
			cli_cov_uid='".$cli_cov_uid."',
			cli_socialreason='".$cli_socialreason."',
			cli_legaldirection='".$cli_legaldirection."',
			cli_phone='".$cli_phone."',
			cli_legal_ci='".$cli_legal_ci."', 
			cli_mainemail='".$cli_mainemail."',
			cli_commercialemail='".$cli_commercialemail."',
			cli_legalname='".$cli_legalname."',
			cli_legallastname='".$cli_legallastname."',
			cli_legal_ci2='".$cli_legal_ci2."',
			cli_legalname2='".$cli_legalname2."',
			cli_legallastname2='".$cli_legallastname2."',
			cli_legal_ci3='".$cli_legal_ci3."',
			cli_legalname3='".$cli_legalname3."',
			cli_legallastname3='".$cli_legallastname3."',
			cli_commercialname='".$cli_commercialname."',
			cli_commerciallastname='".$cli_commerciallastname."',
			cli_user='".$cli_user."',
			cli_password='".$cli_pass."',
			cli_pts_uid='".$cli_pts_uid."',
			cli_ite_uid='".$cli_ite_uid."',
			cli_item_uid='".$item_uid."',
			cli_status='".$cli_status."',
			cli_date=GETDATE()
		where cli_uid=".$cli_uid;
$db->query($sql);

	$cli_doc_uid = admin::getParam("cli_doc_uid");
   	if (is_array($cli_doc_uid)){
             $sql = "delete from mdl_documentsclient where dcl_cli_uid='".$cli_uid."'";
    $db->query($sql);

         foreach (array_keys($cli_doc_uid) as $value) {
              $sql = "insert into mdl_documentsclient (dcl_cli_uid, dcl_doc_uid) values (".$cli_uid.", ".$value.")";
              $db->query($sql);
		 }
    }
	
	$sql = "delete from mdl_way_desc where wde_cli_uid='".$cli_uid."'";
    $db->query($sql);
	if ($cli_pts_uid>1){
		 $sql = "select wtp_uid FROM mdl_waytopay where wtp_pts_uid='".$cli_pts_uid."' and wtp_delete=0";

         $db2->query($sql);
		 while ($content=$db2->next_record())
		 {
			 $cli_pts_description=admin::getParam("cli_pts_description".$content['wtp_uid']);
              $sql = "insert into mdl_way_desc (wde_cli_uid, wde_wtp_uid, wde_description,wde_delete) values (".$cli_uid.", ".$content['wtp_uid'].", '".$cli_pts_description."',0)";
              $db->query($sql);
		 }
    }

// SUBIENDO LA IMAGEN NOTICIAS
$FILES = $_FILES ['cli_photo'];
		
        $allowedTypes = array("jpeg","jpg","gif","bmp", "png");
        $validFile = $FILES['name'] != '' && in_array( strtolower(pathinfo($FILES["name"],PATHINFO_EXTENSION)),$allowedTypes) ? true : false;		
		
if ($validFile && $FILES['error']==0)
	{
	// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
	$extensionFile = admin::getExtension($FILES["name"]);
	$fileName=admin::imageName($cli_user)."_".$cli_uid.".".$extensionFile;
	// DATOS DE REDIMENCION DE IMAGENES
	$nomIMG= admin::imageName($cli_user)."_".$cli_uid.".jpg";
	$nomIMG2="thumb_".$nomIMG;
	// Subimos el archivo con el nombre original
	classfile::uploadFile($FILES,PATH_ROOT.'/img/client/',$fileName);
	// redimencionamos al mismo pero con extencion jpg en el mismo tama�o
	redimImgPercent(PATH_ROOT."/img/client/".$fileName, PATH_ROOT."/img/client/".$nomIMG,100,100);
	// Redimencionamos el nuevo jpg por el ancho definido
	redimImgWH(PATH_ROOT."/img/client/".$nomIMG, PATH_ROOT."/img/client/".$nomIMG2,60,100);
	// Redimencionamos el nuevo jpg por el ancho definido
	$sql = "UPDATE mdl_client SET cli_logo='".$nomIMG."' WHERE cli_uid=".$cli_uid;
	$db->query($sql);
	}
$token=admin::getParam("token");		
	
header('Location: ../../clientList.php');		
?>