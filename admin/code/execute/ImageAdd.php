<?php
ini_set("memory_limit","65M");
@set_time_limit(0);
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
include_once("../../core/thumb.php");
$mythumb = new thumb();
admin::initialize('image','imageNew');

$token=admin::getParam("token");
$nextUrl="imageList.php?token=".$token;

$mim_uid=admin::toSql($_POST["mim_uid"],"Number");

if (!$mim_uid)
{
	$maxMim=admin::getDBvalue("select max(mim_uid) from mdl_image");
	$maxMim++;
	$mim_uid=$maxMim;
	$sql = "insert into mdl_image(
								mim_uid,
								mim_title,
								mim_metatitle,
								mim_metadescription,
								mim_metakeyword,
								mim_status,
								mim_delete
								) 
						values	(
								".$maxMim.", 
								'".admin::toSql($_POST["mim_title"],"String")."', 
								'".admin::toSql($_POST["mim_metatitle"],"String")."', 
								'".admin::toSql($_POST["mim_metadescription"],"String")."', 
								'".admin::toSql($_POST["mim_metakeyword"],"String")."',
								'".admin::toSql($_POST["mim_status"],"String")."',0)";
	$db->query($sql);
}
else
{
	$sql='update mdl_image set 
							mim_title="'.admin::toSql($_POST["mim_title"],"String").'",
							mim_metatitle="'.admin::toSql($_POST["mim_metatitle"],"String").'",
							mim_metadescription="'.admin::toSql($_POST["mim_metadescription"],"String").'",
							mim_metakeyword="'.admin::toSql($_POST["mim_metakeyword"],"String").'",
							mim_status="'.admin::toSql($_POST["mim_status"],"String").'" 
		where mim_uid="'.$mim_uid.'"';
		$db->query($sql);
}

// DECLARANDO LAS VARIABLES PARA EVITAR SQL INJECTION
$picName=admin::toSql($_POST["mim_title"],"String");
$pathIMG = PATH_ROOT . "/img/packgallery/";
$pathIMG2 = PATH_ROOT . "/img/news/";
$x = 0;
$titleArr = array();
foreach($_POST as $c=>$v){
	if($x >= 2){
	 $titleArr[$x-2] = $v;
	}
	 $x++;
}	 

// OBTENEMOS EL NUMERO DE IMAGENES RELACIONADAS AL PAQUETE
$sql = "select count(*) AS numgallery from mdl_news_images where nei_mim_uid=".$mim_uid." and nei_delete<>1";
$db->query($sql);
$data = $db->next_record();
$nro = $data["numgallery"];

$tmpname['name']= $_FILES['file']['name'];
$tmpname['tmpname'] = $_FILES['file']['tmp_name'];

$j=(count($_FILES['file']['tmp_name']));
$j=$j-1;

$x = 1;
if($j){
	for ($i=0;$i<$j;$i++)
		{	
		// SUBIENDO IMAGENES ADJUNTAS
		$FILES = $_FILES['GALLERY_IMG_' . $i];	
		$FILES['name'] = $tmpname['name'][$i];
		$FILES['tmp_name'] = $tmpname['tmpname'][$i];
		
		if ($FILES['name'] != '')
			{
			$nro = $nro + 1;
			// DATOS DE ARCHIVO EN SU FORMATO ORIGINAL
			$extensionFile = admin::getExtension($FILES["name"]);
			
			$fileName = admin::imageName($picName)."_".$nro.".jpg";
			
			//$filenoExt=str_replace('.'.$extensionFile,"",$FILES['name']);
			
			// DATOS DE REDIMENCION DE IMAGENES
			
			$nomIMG = $mim_uid."_".admin::imageName($picName)."_".$nro.".jpg";
			
			// Subimos el archivo con el nombre original
			classfile::uploadFile($FILES,$pathIMG,$fileName);

			$QUALITY=75;
			// redimencionamos al mismo pero con extencion jpg en el mismo tamaño
			redimImgPercent($pathIMG.$fileName, $pathIMG.$fileName,100,100);
						
			// para noticias reutilización de imagenes*************************************************************
			/*
			$nomIMGn1 = "img_" . $nomIMG;		//958x268		c 	destacado1
			$nomIMGn0 = "img2_" . $nomIMG;			//633x268	r	destacado2
			$nomIMGn2 = "thumb_" . $nomIMG;		//70x70    		r	admin no alto
			$nomIMGn3 = "thumb2_" . $nomIMG;	//306x213  		c	interior
			$nomIMGn4 = "thumb3_" . $nomIMG;		//286x199	r 	foto del dia
			$nomIMGn6 = "thumb4_" . $nomIMG;		//180x125	r	rotatorio inferior
			$nomIMGn5 = "thumb5_" . $nomIMG;		//178x123	r	listado
			$nomIMGn7 = "thumb6_" . $nomIMG;	//306x213		r(c)columna a
			$nomIMGn8 = "thumb7_" . $nomIMG;	//298x207		r(c)columna b
			
			admin::resize($pathIMG.$fileName,$pathIMG2.$nomIMGn1,958,100); // 958x268 pack
			$mythumb->loadImage($pathIMG2.$nomIMGn1); 
			$mythumb->crop(958,268,"top"); 
			$mythumb->save($pathIMG2.$nomIMGn1,100);
			
			admin::resize($pathIMG2.$nomIMGn1,$pathIMG2.$nomIMGn0,633,100); // 633x268 pack
			admin::resize($pathIMG.$fileName,$pathIMG2.$nomIMGn2,70,100); // 70xn pack
			
			admin::resize($pathIMG.$fileName,$pathIMG2.$nomIMGn7,306,100); // 306x213 pack
			$mythumb->loadImage($pathIMG2.$nomIMGn7); 
			$mythumb->crop(306,213,"top"); 
			$mythumb->save($pathIMG2.$nomIMGn3,100);
			
			admin::resize($pathIMG2.$nomIMGn3,$pathIMG2.$nomIMGn4,286,100); // 286x199 pack
			admin::resize($pathIMG2.$nomIMGn3,$pathIMG2.$nomIMGn6,180,100); // 180x125 pack
			admin::resize($pathIMG2.$nomIMGn3,$pathIMG2.$nomIMGn5,178,100); // 178x123 pack
			admin::resize($pathIMG2.$nomIMGn3,$pathIMG2.$nomIMGn8,298,100); // 298x207 pack
			*/
			// para galeria**************************************************************************************
			
			$nomIMG1 = "img_" . $nomIMG;		//585x405		    r* 	galeria interna
			$nomIMG4 = "thumb3_" . $nomIMG;
			$nomIMG5 = "thumb5_" . $nomIMG;						
			admin::resize($pathIMG.$fileName,$pathIMG . $nomIMG1,585,100); // 585 x405 pack
			//admin::resize($pathIMG . $fileName,$pathIMG . $nomIMG2,70,100); // 70x70
						
			// concatenando con marca de agua
			$watermark = PATH_ROOT."/img/anf.png";
			$im = imagecreatefrompng($watermark);
			if(strtolower($extensionFile) == "gif"){
				if (!$im2 = imagecreatefromgif($pathIMG . $nomIMG1)){
					echo "Error opening $image!";
					exit;
					}
				}
			else if(strtolower($extensionFile) == "jpg"){
				if (!$im2 = imagecreatefromjpeg($pathIMG . $nomIMG1)){
					echo "Error opening $image!";
					exit;
					}
				}
			else if(strtolower($extensionFile) == "png"){
				if (!$im2 = imagecreatefrompng($pathIMG . $nomIMG1)){
					echo "Error opening $image!"; exit;
					}
				}
			list($width, $height) = getimagesize($pathIMG . $nomIMG1);	

			$xcoord = ($width/2)-153; 
			$ycoord = ($height/2)-69;
			imagecopy($im2,$im,$xcoord,$ycoord,0,0,imagesx($im),imagesy($im));
			imagejpeg($im2,$pathIMG.$nomIMG1,100);
			// fin marca de agua
		
		list($width, $height) = getimagesize($pathIMG . $fileName);	
		
		if($width <= $height){
				// crop automatico
				admin::resize($pathIMG.$fileName,$pathIMG . $nomIMG4,70,100);
				
				$mythumb->loadImage($pathIMG . $nomIMG4); 
				//"left", "top", "right", "bottom" o "center"
				$mythumb->crop(70, 49,"top"); 
				$mythumb->save($pathIMG . $nomIMG4,100);
				
				admin::resize($pathIMG . $fileName,$pathIMG . $nomIMG5,285,100);
				$mythumb->loadImage($pathIMG .$nomIMG5); 
				//"left", "top", "right", "bottom" o "center"
				$mythumb->crop(285, 195,"top"); 
				$mythumb->save($pathIMG . $nomIMG5,100);
		
		}
		else{

			admin::resize2($pathIMG . $fileName,$pathIMG . $nomIMG4,49);

			list($r1width, $r1height) = getimagesize($pathIMG . $nomIMG4);	
			if ($r1width<=70) admin::resize($pathIMG . $fileName,$pathIMG . $nomIMG4,70,100);
				
			// crop automatico
				$mythumb->loadImage($pathIMG . $nomIMG4); 
				//"left", "top", "right", "bottom" o "center"
				$mythumb->crop(70, 49,"left",'nada'); 
				$mythumb->save($pathIMG . $nomIMG4,100);

		// ************************

			admin::resize2($pathIMG . $fileName,$pathIMG . $nomIMG5,195);	
				
			list($r1width, $r1height) = getimagesize($pathIMG . $nomIMG5);	
			if ($r1width<=285) admin::resize($pathIMG . $fileName,$pathIMG . $nomIMG5,285,100);
				
				$mythumb->loadImage($pathIMG . $nomIMG5); 
				//"left", "top", "right", "bottom" o "center"
				$mythumb->crop(285, 195,"left",'nada'); 
				$mythumb->save($pathIMG . $nomIMG5,100);
		}

			// pai_uid, pai_status, pai_delete
			$title = $titleArr[$x];
			$title = $_POST['title'.($x*2)];
	//		print($title."<br>");
			$sql = "insert into mdl_news_images(nei_mim_uid, nei_position, nei_image, nei_description)
											values(" . $mim_uid . "," . $nro . ",'" . $nomIMG . "','" . $title . "')";
			$db->query($sql);
			$x = $x + 1;
			}
		}
}	


header('Location: ../../'.$nextUrl);
?>