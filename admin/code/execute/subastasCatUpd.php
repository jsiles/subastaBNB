<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('subasta','subastaAdd'); 
// VERIFICAMOS EL SQL INJECTION
$pca_uid = admin::toSql(admin::getParam("pca_uid"),"Number");
$pca_product = admin::toSql(admin::getParam("pca_product"),"Number");
$pca_title = admin::toSql(admin::getParam("pca_title"),"Text"); 
$pca_description1 = admin::toSql(admin::getParam("pca_description1"),"Text"); 
$pca_description2 = admin::toSql(admin::getParam("pca_description2"),"Text"); 
$pca_status = admin::toSql(admin::getParam("pca_status"),"Text");
$seo_metatitle = admin::toSql(admin::getParam("seo_metatitle"),"Text"); 
$seo_metadescription = admin::toSql(admin::getParam("seo_metadescription"),"Text"); 
$seo_metakeyword = admin::toSql(admin::getParam("seo_metakeyword"),"Text");
$pca_selected = admin::toSql(admin::getParam("pca_selected"),"Number");
if ($pca_selected != $pca_product)
	{
	// CONTAMOS CUANTAS CATEGORIAS HAY EN LOS PRODUCTOS VINOS O SINGANIS
	$sql = "select COUNT(*) as numpositions
			from mdl_subasta_category 
			where pca_prd_uid=" . $pca_product;
	$db->query($sql);
	$category = $db->next_record();
	$numpositions = $category["numpositions"];
	$numpositions++;
	$addsql1 = ",pca_position=" . $numpositions . " ";
	}
else
	$addsql1="";

// REGISTRAMOS LA PRIMERA PARTE DE CATEGORIA
// pca_position," . $numpositions . ", pca_delete
$sql = "update mdl_subasta_category set
			pca_prd_uid=" . $pca_product . ",
			pca_status='" . $pca_status . "'
			" . $addsql1 . "
		where pca_uid=" . $pca_uid;
$db->query($sql);

// REGISTRANDO LENGUAGES --> pcl_uid
$sql = "update mdl_subasta_category_languages set 							
			pcl_title='" . $pca_title . "',
			pcl_description1='" . $pca_description1 . "',
			pcl_description2='" . $pca_description2 . "',
			pcl_url='" . admin::urlsFriendly($pca_title) . "',
			pcl_metatitle='" . $seo_metatitle . "',			
			pcl_metadescription='" . $seo_metadescription . "',
			pcl_metakeyword='" . $seo_metakeyword . "' 
		where pcl_pca_uid=" . $pca_uid . " 
			  and pcl_language='" . $lang . "'";
$db->query($sql);

// SUBIENDO LA IMAGEN NOTICIAS
$FILES = $_FILES["pca_banner"];
if ($FILES["name"] != '')
	{
	// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
	$extensionFile = admin::getExtension($FILES["name"]);
	if ($extensionFile=="swf") $pca_banner_type=1;
	else $pca_banner_type=2;

	$fileName = admin::urlsFriendly($pca_title) . "_". $pca_uid . "." . $extensionFile;
	// Subimos el archivo con el nombre original
	classfile::uploadFile($FILES,PATH_ROOT . '/admin/upload/subasta/',$fileName);
	
	// agregando rezise a width 555
	redimImgWidth(PATH_ROOT . "/admin/upload/subasta/" . $fileName, PATH_ROOT . "/admin/upload/subasta/". $fileName,555,100);	
	
	// GUARDAMOS LA PRINCIPAL EN BASE DE DATOS
	$sql = "UPDATE mdl_subasta_category_languages SET 
				pcl_banner_type=" . $pca_banner_type . ", 
				pcl_banner='" . $fileName . "' 
			WHERE pcl_pca_uid = " . $pca_uid . " 
				  and pcl_language='" . $lang . "'";
	$db->query($sql);
	}
?>
<script language="javascript" type="text/javascript">
document.location.href='../../subastaList.php?product=<?=$pca_product?>'; 
</script>