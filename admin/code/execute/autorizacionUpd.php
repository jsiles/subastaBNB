<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
include_once("../../core/thumb.php");
admin::initialize('subasta','subastaAdd'); 

$mythumb = new thumb(); 

// DATOS QUE EVITAN EL SQL INJECTION
$sub_uid = admin::toSql(admin::getParam("sub_uid"),"Text");
$sub_pca_uid = admin::toSql(admin::getParam("sub_pca_uid"),"Text");
$sub_description = admin::toSql(admin::getParam("sub_description"),"Text");
$sub_type = admin::toSql(admin::getParam("sub_type"),"Text");
$sub_modalidad = admin::toSql(admin::getParam("sub_modalidad"),"Text");

//$sub_date = admin::changeFormatDate(admin::toSql(admin::getParam("sub_date"],"Text"),1);
//$sub_hour = admin::toSql(admin::getParam("sub_hour"],"Text");
$sub_mount_base = admin::toSql(admin::getParam("sub_mount_base"),"Text");
$sub_moneda = admin::toSql(admin::getParam("sub_moneda"),"Text");
$sub_mount_unidad = admin::toSql(admin::getParam("sub_mount_unidad"),"Text");
$sub_hour_end0 = admin::changeFormatDate(admin::toSql(admin::getParam("sub_hour_end0"),"Text"),1);
$sub_hour_end1 = admin::toSql(admin::getParam("sub_hour_end1"),"Text");
$sub_hour_end=$sub_hour_end0.' '.$sub_hour_end1;
$sub_tiempo = admin::toSql(admin::getParam("sub_tiempo"),"Number");

$sub_status = admin::toSql(admin::getParam("sub_status"),"Text");

$sub_mountdead = admin::toSql(admin::getParam("sub_mountdead"),"Number");
$sub_wheels = admin::toSql(admin::getParam("sub_wheels"),"Number");
if(!$sub_mountdead) $sub_mountdead=0;
if(!$sub_wheels) $sub_wheels=0;

$pro_uid = admin::toSql(admin::getParam("pro_uid"),"Text");
$pro_name = admin::toSql(admin::getParam("pro_name"),"Text");
$pro_url = admin::urlsFriendly(trim($pro_name.'-'.$pro_uid));
$pro_quantity = admin::toSql(admin::getParam("pro_quantity"),"Text");
$pro_unidad = admin::toSql(admin::getParam("pro_unidad"),"Text");
$pro_description = admin::toSql(admin::getParam("pro_description"),"Text");

$tmp_year = substr($sub_hour_end,0,4);
$tmp_month = substr($sub_hour_end,5,2);
$tmp_day = substr($sub_hour_end,8,2);
$tmp_hour = substr($sub_hour_end,11,2);
$tmp_min = substr($sub_hour_end,14,2);
$tmp_sec = substr($sub_hour_end,17,2);
$dead_time = date("Y-m-d H:i:s",mktime($tmp_hour,$tmp_min+$sub_tiempo,$tmp_sec,$tmp_month,$tmp_day,$tmp_year));

$sql = "update mdl_subasta set
				sub_pca_uid='".$sub_pca_uid."',
				sub_usr_uid=".admin::getSession('usr_uid').",
				sub_description='".$sub_description."',
				sub_type='".$sub_type."',
				sub_modalidad='".$sub_modalidad."',
				sub_wheels='".$sub_wheels."',
				sub_mount_base='".$sub_mount_base."',
				sub_mountdead='".$sub_mountdead."',
				sub_moneda='".$sub_moneda."',
				sub_mount_unidad='".$sub_mount_unidad."',
				sub_status='".$sub_status."',
				sub_tiempo=".$sub_tiempo.",
				sub_hour_end='".$sub_hour_end."',
				sub_deadtime='".$dead_time."',
				sub_finish=0				
		where sub_uid='".$sub_uid."'";
$db->query($sql);
$sql ="delete from mdl_bid where bid_sub_uid=".$sub_uid;
$db->query($sql);

$sql ="delete from mdl_biditem where bid_sub_uid=".$sub_uid;
$db->query($sql);

$sql = "update mdl_product set
				pro_name='".$pro_name."',
				pro_url='".$pro_url."',
				pro_quantity='".$pro_quantity."',
				pro_unidad='".$pro_unidad."',
				pro_description='".$pro_description."'
		where pro_uid='".$pro_uid."'";
$db->query($sql);

//ingresando ronda en caso de ser item

if($sub_modalidad=="ITEM")
{
//	$sql ="delete from sys_item where ite_sub_uid=".$sub_uid;
//	$db->query($sql);

//	$sql="insert into sys_item (ite_uid, ite_sub_uid, ite_wheel, ite_flag) values(null,$sub_uid,1,0)";
//	$db->query($sql);
    $sql ="delete from mdl_round where rou_sub_uid=".$sub_uid;
    $db->query($sql);

    for($i=1; $i<=$sub_wheels;$i++)
        {
            if ($i==1) $flag0=0;
            else $flag0=1;
            $dead_time = date("Y-m-d H:i:s",mktime($tmp_hour,$tmp_min+($sub_tiempo*$i),$tmp_sec,$tmp_month,$tmp_day,$tmp_year));
        $sql="insert into mdl_round (rou_sub_uid, rou_round, rou_datetime, rou_flag0, rou_flag1) values ($sub_uid,$i,'$dead_time',$flag0,0)";
        
        $db->query($sql);
        }
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
		/*
		list($width, $height) = getimagesize($image1);
		if ($width >= $height){
		if ($width >= 132) redimImgWidth(PATH_ROOT . "/img/subasta/" . $fileName, PATH_ROOT . "/img/subasta/". $nomIMG,132,100);
		}
		else
		{
		if ($height >= 132) redimImgheight(PATH_ROOT . "/img/subasta/" . $fileName, PATH_ROOT . "/img/subasta/". $nomIMG,132,100);
		}
	*/
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
			
			}/*
			// crop de thumbnail	
			$mythumb->loadImage($image1); 
			if ($width > $height)
			{
			$mythumb->resize(115,"width"); 
			$mythumb->save( PATH_ROOT."/img/subasta/".$nomIMG2 ,100);
			}
			else
			{
			$mythumb->resize(116,"height"); 
			$mythumb->save( PATH_ROOT."/img/subasta/".$nomIMG2 ,100);
			}	
	*/
	//imagedestroy(PATH_ROOT.'/img/subasta/'.$fileName);
	//imagedestroy(PATH_ROOT.'/img/subasta/xx-'.$nomIMG);
	// GUARDAMOS LA PRINCIPAL EN BASE DE DATOS
	$sql = "UPDATE mdl_product SET pro_image='".$nomIMG."' WHERE pro_uid ='".$pro_uid."'";
	$db->query($sql);
	}

// SUBIENDO EL DOCUMENTO DE productos
$FILES2 = $_FILES ['pro_document'];
//print_r($_FILES);
if ($FILES2["name"] != '')
	{
	$ext = admin::getExtension($FILES2 ["name"]);
	$nomDOC = 'pro_'.$pro_uid.".".$ext;	
	classfile::uploadFile($FILES2,PATH_ROOT.'/docs/subasta/',$nomDOC);	
	$sql = "UPDATE mdl_product SET pro_document='".$nomDOC."' WHERE pro_uid='".$pro_uid."'";
	$db->query($sql);
	}
$token=admin::getParam("token");
if($sub_modalidad=="ITEM")
{
header('Location: ../../autorizacionEdit2.php?sub_uid='.$sub_uid.'&pro_uid='.$pro_uid);
}else{
header('Location: ../../autorizacionList.php');

}
?>