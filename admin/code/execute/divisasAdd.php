<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
include_once("../../core/thumb.php");

admin::initialize('divisa','divisaAdd'); 

$mythumb = new thumb(); 
//print_r($_FILES ['pro_imagen']);
//die();
	
// DATOS QUE EVITAN EL SQL INJECTION
$sub_pca_uid = 6;
$sub_description = admin::toSql($_POST["sub_description"],"String");
$sub_type = admin::toSql($_POST["sub_type"],"String");
$sub_modalidad = admin::toSql($_POST["sub_modalidad"],"String");
$sub_date = date("Y-m-d"); //admin::changeFormatDate(admin::toSql($_POST["sub_date"],"String"),1);
$sub_hour = date("h:i:s");//admin::toSql($_POST["sub_hour"],"String");
$sub_mount_base = admin::toSql($_POST["sub_mount_base"],"String");
$sub_moneda = admin::toSql($_POST["sub_moneda"],"String");
$sub_moneda = admin::toSql($_POST["sub_moneda1"],"Number");
$sub_mount_unidad = admin::toSql($_POST["sub_mount_unidad"],"String");
$sub_hour_end0 = admin::changeFormatDate(admin::toSql($_POST["sub_hour_end0"],"String"),1);
$sub_hour_end1 = admin::toSql($_POST["sub_hour_end1"],"String");
$sub_hour_end=$sub_hour_end0.' '.$sub_hour_end1;
$sub_tiempo = admin::toSql($_POST["sub_tiempo"],"Number");
$sub_status = admin::toSql($_POST["sub_status"],"String");

$sub_mountdead = admin::toSql($_POST["sub_mountdead"],"Number");
$sub_wheels = admin::toSql($_POST["sub_wheels"],"Number");
if(!$sub_mountdead) $sub_mountdead=0;
if(!$sub_wheels) $sub_wheels=0;

//2007/10/09 11:00:00
//0123456789012345678
$tmp_year = substr($sub_hour_end,0,4);
$tmp_month = substr($sub_hour_end,5,2);
$tmp_day = substr($sub_hour_end,8,2);
$tmp_hour = substr($sub_hour_end,11,2);
$tmp_min = substr($sub_hour_end,14,2);
$tmp_sec = substr($sub_hour_end,17,2);
$dead_time = date("Y-m-d H:i:s",mktime($tmp_hour,$tmp_min+$sub_tiempo,$tmp_sec,$tmp_month,$tmp_day,$tmp_year));
$pro_uid = admin::getDBvalue("select max(pro_uid) FROM mdl_product");
$pro_uid++;

$pro_name = admin::toSql($_POST["pro_name"],"String");
$pro_url = admin::urlsFriendly(trim($pro_name.'-'.$pro_uid));
$pro_quantity = admin::toSql($_POST["pro_quantity"],"String");
$pro_unidad = admin::toSql($_POST["pro_unidad"],"String");
$pro_description = admin::toSql($_POST["pro_description"],"String");

$sub_uid = admin::getDBvalue("select max(sub_uid) FROM mdl_subasta");
$sub_uid++;
$sql = "insert into mdl_subasta
					(
					sub_uid,
					sub_pca_uid,
					sub_usr_uid,
					sub_description,
					sub_type,
					sub_modalidad,
					sub_date,
					sub_hour,
					sub_wheels,
					sub_mount_base,
					sub_mountdead,
					sub_moneda,
					sub_moneda1,
					sub_mount_unidad,
					sub_hour_end,
					sub_tiempo,
					sub_status,
					sub_delete,
					sub_deadtime,
					sub_finish, 
					sub_mode
					)
			values	(
					'".$sub_uid."', 
					'".$sub_pca_uid."', 
					".admin::getSession('usr_uid').", 
					'".$sub_description."', 
					'".$sub_type."',
					'".$sub_modalidad."',
					'".$sub_date."', 
					'".$sub_hour."',
					'".$sub_wheels."',
					'".$sub_mount_base."',
					'".$sub_mountdead."',
					'".$sub_moneda."',
					'".$sub_moneda1."',
					'".$sub_mount_unidad."',
					'".$sub_hour_end."',
					".$sub_tiempo.",
					'".$sub_status."',
					0,
					'".$dead_time."',
					0,
					'DIVISA')";
	$db->query($sql);

// ingresamos producto

$sql = "insert into mdl_product
						(
						pro_uid,
						pro_sub_uid,
						pro_name,
						pro_url,
						pro_quantity,
						pro_unidad,
						pro_description
						)
				values	(
						'".$pro_uid."', 
						'".$sub_uid."', 
						'".$pro_name."', 
						'".$pro_url."', 
						'".$pro_quantity."',
						'".$pro_unidad."',
						'".$pro_description."')";
					$db->query($sql);

					//die($sql);
//ingresando ronda en caso de ser item

if($sub_modalidad=="ITEM")
{
	$sql="insert into sys_item (ite_sub_uid, ite_wheel, ite_flag) values($sub_uid,1,0)";
	$db->query($sql);
	}
// SUBIENDO LA IMAGEN PRODUCTOS
$FILES = $_FILES ['pro_image'];
if ($FILES["name"] != '')
	{
	// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
	$extensionFile = admin::getExtension($FILES["name"]);
	$fileName = $pro_uid . "." . $extensionFile;
	// DATOS DE REDIMENCION DE IMAGENES
	$nomIMG = $pro_uid.".jpg";
	$nomIMG2 = "pre_".$nomIMG;	
	$nomIMG22 = "thumb2_".$nomIMG;	
	$nomIMG3 = "img_".$nomIMG;	
	// Subimos el archivo con el nombre original
	classfile::uploadFile($FILES,PATH_ROOT . '/img/subasta/',$fileName);
	// redimencionamos al mismo pero con extencion jpg en el mismo tamao
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
	// GUARDAMOS LA PRINCIPAL EN BASE DE DATOS
	$sql = "UPDATE mdl_product SET pro_image='".$nomIMG."' WHERE pro_uid ='".$pro_uid."'";
	$db->query($sql);
	}

// SUBIENDO EL DOCUMENTO DE productos
$FILES2 = $_FILES ['pro_adjunt'];
if ($FILES2["name"] != '')
	{
	$ext = admin::getExtension($FILES2 ["name"]);
	$nomDOC = 'pro_'.$pro_uid.".".$ext;	
	classfile::uploadFile($FILES2,PATH_ROOT.'/docs/subasta/',$nomDOC);	
	$sql = "UPDATE mdl_product SET pro_document='".$nomDOC."' WHERE pro_uid='".$pro_uid."'";
	$db->query($sql);
	}
$token=admin::getParam("token");

header('Location: ../../divisasList.php?token='.$token);	
?>