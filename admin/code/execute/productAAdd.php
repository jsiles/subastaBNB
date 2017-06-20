<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
include_once("../../core/thumb.php");
admin::initialize('subastas','docsCatAdd2',false); 
$sub_uid=admin::getParam("sub_uid");
$pro_uid=admin::getParam("pro_uid");
$fldpro_product=admin::getParam("pro_product");
$fldpro_description=admin::getParam("pro_description");
$fldpro_precio=admin::getParam("pro_precio");
$fldpro_unidad=admin::getParam("pro_unidad");
$fldpro_cli_id=admin::getParam("pro_cli_id");
$fldxitem = admin::getDbValue("select max(xit_uid) from mdl_xitem");
if(!$fldxitem) $fldxitem=1;
else $fldxitem++;
$sSQL = "insert into mdl_xitem(
					xit_uid,
					xit_sub_uid,
					xit_product,
					xit_description, 
					xit_image,
					xit_price,
					xit_unity,
					xit_delete
					)
				values
					(
						$fldxitem, 
						'".$sub_uid."', 
						'".$fldpro_product."',
						'".$fldpro_description."', 
						'',
						".$fldpro_precio.", 
						".$fldpro_unidad.", 
						0
					)";

$db->query($sSQL);

//die;
/*********************************************/
/*			BEGIN IMAGE						 */
/*********************************************/
$mythumb = new thumb(); 

$FILES = $_FILES ['pro_image'];
if ($FILES["name"] != '')
	{
	// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
	$extensionFile = admin::getExtension($FILES["name"]);
	$fileName = $fldxitem . "_xitem." . $extensionFile;
	// DATOS DE REDIMENCION DE IMAGENES
	$nomIMG = $fldxitem."_xitem.jpg";
	$nomIMG2 = "pre_".$nomIMG;	
	$nomIMG22 = "thumb2_".$nomIMG;	
	$nomIMG3 = "img_".$nomIMG;	
	// Subimos el archivo con el nombre original
	classfile::uploadFile($FILES,PATH_ROOT . '/img/subasta/',$fileName);
		$image1 = PATH_ROOT.'/img/subasta/'.$fileName;
		list($width, $height) = getimagesize($image1);

		if ($width >= $height) $Prioridad='width';
		else $Prioridad='height';

			// Resizing images
			$mythumb->loadImage($image1); 
			//"left", "top", "right", "bottom" o "center"
			$mythumb->resize(132,$Prioridad); 
			$mythumb->save( PATH_ROOT."/img/subasta/".$nomIMG3 ,100 );	
			
			$mythumb->loadImage($image1); 
			if ($width > $height)
			{
			$mythumb->resize(47,"width"); 
			$mythumb->save( PATH_ROOT."/img/subasta/".$nomIMG22 ,100 );	
			}
			else
			{
			$mythumb->resize(47,"height"); 
			$mythumb->save( PATH_ROOT."/img/subasta/".$nomIMG22 ,100 );	
			
			}
	$sql = "UPDATE mdl_xitem SET xit_image='".$nomIMG."' WHERE xit_uid =".$fldxitem;
	$db->query($sql);
	}
/*********************************************/
/*			END IMAGE						 */
/*********************************************/
foreach($fldpro_cli_id as $fldvalue)
{
$sql = "insert into mdl_clixitem(
					clx_cli_uid,
					clx_xit_uid,
					clx_delete
					)
				values
					(
						".$fldvalue.",
						".$fldxitem.", 
						0
					)";
echo $sql;
$db->query($sql);
}
$token=admin::getParam("token");
header('Location: ../../autorizacionEdit2.php?pro_uid='.$pro_uid.'&sub_uid='.$sub_uid);
?>