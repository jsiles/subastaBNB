<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
include_once("../../core/thumb.php");

admin::initialize('subastas','subastaAdd'); 

$mythumb = new thumb(); 
//print_r($_FILES ['pro_imagen']);
//die();
	
// DATOS QUE EVITAN EL SQL INJECTION
$sub_pca_uid = admin::toSql(admin::getParam("sub_pca_uid"),"Text");
$sub_description = admin::toSql(admin::getParam("sub_description"),"Text");
$sub_type = admin::toSql(admin::getParam("sub_type"),"Text");
$sub_modalidad = admin::toSql(admin::getParam("sub_modalidad"),"Text");
$sub_date = date("Y-m-d"); //admin::changeFormatDate(admin::toSql(admin::getParam("sub_date"],"Text"),1);
$sub_hour = date("H:i:s");//admin::toSql(admin::getParam("sub_hour"],"Text");
$sub_mount_base = admin::getParam("sub_mount_base");
$sub_moneda = admin::toSql(admin::getParam("sub_moneda"),"Text");
$sub_mount_unidad = admin::getParam("sub_mount_unidad");
if($sub_modalidad!='TIEMPO') $sub_mount_unidad=0;
$sub_hour_end0 = admin::changeFormatDate(admin::toSql(admin::getParam("sub_hour_end0"),"Text"),1);
$sub_hour_end1 = admin::toSql(admin::getParam("sub_hour_end1"),"Text");
$sub_hour_end=$sub_hour_end0.' '.$sub_hour_end1;
$sub_tiempo = admin::toSql(admin::getParam("sub_tiempo"),"Number");
$sub_status = admin::toSql(admin::getParam("sub_status"),"Text");
$sub_mountdead = admin::toSql(admin::getParam("sub_mountdead"),"Number");
$sub_wheels = admin::toSql(admin::getParam("sub_wheels"),"Number");
$xhoras = admin::getParam("xhoras");
if(!is_numeric($xhoras)) $xhoras=0;
if(!isset($xhoras)) $xhoras=0;

if(!$sub_mountdead) $sub_mountdead=0;
if(!$sub_wheels) $sub_wheels=0;
if($sub_modalidad=='PRECIO') $sub_wheels=1;
//2007/10/09 11:00:00
//0123456789012345678
$tmp_year = substr($sub_hour_end,0,4);
$tmp_month = substr($sub_hour_end,5,2);
$tmp_day = substr($sub_hour_end,8,2);
$tmp_hour = substr($sub_hour_end,11,2);
$tmp_min = substr($sub_hour_end,14,2);
$tmp_sec = substr($sub_hour_end,17,2);
if($sub_modalidad!="TIEMPO")
{
$dead_time = date("Y-m-d H:i:s",mktime($tmp_hour,$tmp_min+($sub_tiempo*$sub_wheels),$tmp_sec,$tmp_month,$tmp_day,$tmp_year));
}else
{
$dead_time = date("Y-m-d H:i:s",mktime($tmp_hour,$tmp_min+$sub_tiempo,$tmp_sec,$tmp_month,$tmp_day,$tmp_year));
}
$timePrevio = date("Y-m-d H:i:s",mktime($tmp_hour - $xhoras, $tmp_min, $tmp_sec,$tmp_month,$tmp_day,$tmp_year));

$pro_uid = admin::getDBvalue("select max(pro_uid) FROM mdl_product");
$pro_uid++;

$pro_name = admin::toSql(admin::getParam("pro_name"),"Text");
$pro_url = admin::urlsFriendly(trim($pro_name.'-'.$pro_uid));
$pro_quantity = admin::toSql(admin::getParam("pro_quantity"),"Text");
$pro_unidad = admin::toSql(admin::getParam("pro_unidad"),"Text");
$pro_description = admin::toSql(admin::getParam("pro_description"),"Text");

$sub_uid = admin::getDBvalue("select max(sub_uid) FROM mdl_subasta");
if(!$sub_uid) $sub_uid=0;
$sub_uid++;
$sub_sol_uid=  admin::getParam("sol_uid");
if(!is_numeric($sub_sol_uid)) $sub_sol_uid=0;
if(!isset($sub_sol_uid)) $sub_sol_uid=0;

$sql = "insert into mdl_subasta
					(
					sub_uid,
					sub_pca_uid,
					sub_usr_uid,
					sub_sol_uid,
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
					'".$sub_sol_uid."', 
					'".$sub_description."', 
					'".$sub_type."',
					'".$sub_modalidad."',
					'".$sub_date."', 
					'".$sub_hour."',
					'".$sub_wheels."',
					'".$sub_mount_base."',
					'".$sub_mountdead."',
					'".$sub_moneda."',
					0,
					'".$sub_mount_unidad."',
					'".$sub_hour_end."',
					".$sub_tiempo.",
					'".$sub_status."',
					0,
					'".$dead_time."',
					0,
					'SUBASTA')";
//echo $sql."<br>";die;

$db->query($sql);

$validateInsert=admin::getDbValue("select count(*) from mdl_subasta where sub_uid=$sub_uid");        
// ingresamos producto
if($validateInsert>0){
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
//echo $sql;die;
					$db->query($sql);
//ingresando ronda en caso de ser item
$sql ="delete from mdl_notificacion_previa where nop_sub_uid=".$sub_uid;
$db->query($sql);

if($xhoras>0){
    $sql="insert into mdl_notificacion_previa (nop_sub_uid, nop_tiempo, nop_datetime, nop_estado) values($sub_uid, $xhoras, '$timePrevio',0)";
    $db->query($sql);
}

if($sub_modalidad=="ITEM")
{
//	$sql="insert into sys_item (ite_sub_uid, ite_wheel, ite_flag) values($sub_uid,1,0)";
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

if($sub_modalidad=="PRECIO")
{
//	$sql="insert into sys_item (ite_sub_uid, ite_wheel, ite_flag) values($sub_uid,1,0)";
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
$rav_uni_uid=  admin::getParam("rav_uni_uid", "strip");
//if(is_array($rav_uni_uid)){
       admin::getDbValue("delete from mdl_subasta_unidad where suu_sub_uid=$sub_uid");
//   foreach($rav_uni_uid as $value)
//   {
       $sql="insert into mdl_subasta_unidad (suu_sub_uid, suu_uni_uid) values($sub_uid, $rav_uni_uid)";
      // echo $rav_tipo."#".$sql;
       $db->query($sql);
//   }
//}
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

header('Location: ../../subastasNew2.php?pro_uid='.$pro_uid."&sub_uid=".$sub_uid."&tipUid=".admin::getParam("tipUid"));	
}else{
    $token=admin::getParam("token");
    header('Location: ../../subastasNew.php?tipUid='.admin::getParam("tipUid"));	    
}
?>