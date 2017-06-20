<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
include_once("../../core/images.php");
admin::initialize('subasta','subastaAdd'); 
// VERIFICAMOS EL SQL INJECTION
$lin_uid = admin::toSql(admin::getParam("lin_uid"),"Text");
$lin_name = admin::toSql(admin::getParam("lin_name"),"Text");
$lin_status = admin::toSql(admin::getParam("lin_status"),"Text");
$seo_metatitle = admin::toSql(admin::getParam("seo_metatitle"),"Text"); 
$seo_metadescription = admin::toSql(admin::getParam("seo_metadescription"),"Text"); 
$seo_metakeyword = admin::toSql(admin::getParam("seo_metakeyword"),"Text");

// Verificamos que el codigo no exista
$existLin=admin::getDBvalue("select COUNT(*) from mdl_line where lin_uid='".$lin_uid."'");
//echo $existLin;//die;
if ($existLin==0)
{
$sql = "insert into mdl_line(
							lin_uid,
							lin_name,
							lin_status,
							lin_delete
							)
					values	(
							'".$lin_uid."', 
							'".$lin_name."',
							'".$lin_status."',
							0
							)";
$db->query($sql);
//agregando al content para los submenus y rutas
$maxPosition=admin::getDBvalue("select MAX(con_position) from mdl_contents where con_parent=3 and con_level=1");
$sql = "insert into mdl_contents(
								con_parent,
								con_level,
								con_position,
								con_createuser,
								con_createdate,
								con_updateuser,
								con_updatedate,
								con_delete,
								con_sit_uid
								) 
						values	(
								3, 
								1, 
								".$maxPosition.", 
								1, 
								GETDATE(), 
								1, 
								GETDATE(), 
								0, 
								1)";
$db->query($sql);

// OBTENEMOS EL ULTIMO ID INSTRODUCIDO POR EL USUARIO EN LA CONSULTA SUPERIOR
$sql = "select con_uid 
		from mdl_contents 
		where con_parent=3
		and con_level=1
		order by con_uid desc limit 1";
$db2->query($sql);
$content = $db2->next_record();
$con_uid = $content["con_uid"];

// GUARDAMOS EN LOS LENGUAGES QUE SE ENCUENTREN ACTIVOS EN LA TABLA SYS_LANGUAGE
$sql = "select * from sys_language where lan_status='ACTIVE' and lan_delete<>1";
$db2->query($sql);
while ($sys_language = $db2->next_record())
	{
	// ACTIVANDO SOLO EN EL LENGUAJE EN EL QUE FUE CREADO
	if ($lang==$sys_language["lan_code"]) $col_status = admin::getParam("col_status");
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
								".admin::toSql($con_uid,"Number").", 
								'".$sys_language["lan_code"]."', 
								'".$lin_name."', 
								'".$lin_name."', 
								'".$lin_name."',
								'".$seo_metatitle."',
								'".$seo_metadescription."',
								'".$seo_metakeyword."',
								'".$lin_status."'
								)";
	$db->query($sql);
	}

}
?>
<script language="javascript" type="text/javascript">
document.location.href='../../subastaList.php'; 
</script>