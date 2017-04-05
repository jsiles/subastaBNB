<?php
include_once("../../core/admin.php");
admin::initialize('reportes','reporteList',false);
$pro_uid =admin::toSql(admin::getParam("pro"),"Number");
$formato =admin::toSql(admin::getParam("type"),"String");

$sql ="SELECT pro_name,pca_name,pro_description,pro_quantity,pro_unidad,sub_status, sub_modalidad, sub_type, sub_hour_end, sub_mount_base, sub_mount_unidad, sub_tiempo, sub_uid 
FROM mdl_subasta, mdl_product,mdl_pro_category
WHERE sub_uid=pro_sub_uid and pca_uid=sub_pca_uid and sub_status='ACTIVE' and sub_uid='$pro_uid'";
$db->query($sql);
while ($firstPart = $db->next_record())
{ 
	$pro_name=$firstPart['pro_name'];
	$pca_name=$firstPart['pca_name'];
	$pro_description=$firstPart['pro_description'];
	$pro_quantity=$firstPart['pro_quantity'];
	$pro_unidad=$firstPart['pro_unidad'];
	$sub_status=$firstPart['sub_status'];
	$sub_modalidad=$firstPart['sub_modalidad'];
	$sub_type=$firstPart['sub_type'];
	$sub_hour_end=explode(" ", $firstPart['sub_hour_end']);
	$sub_mount_base=$firstPart['sub_mount_base'];
	$sub_mount_unidad=$firstPart['sub_mount_unidad'];
	$sub_tiempo=$firstPart['sub_tiempo'];
	$sub_uid=$firstPart['sub_uid'];
}

$html= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte del proceso de compra</title>
</head>

<body>
<table width="100%">
<tr><td ><img src="'.$domain.'/lib/logo.png" width="100" /></td><td colspan="4"><h1> Parametrizaci&oacute;n del proceso de compra</h1><br /><span>Fecha: '.date("d/m/Y").'</span></td></tr>
<tr><td><br /><br /></td><td><br /><br /></td></tr>
<tr><td colspan="5"><h2>1: Datos generales del proceso de compra</h2></td></tr>
<tr><td><br /></td><td><br /></td></tr>
<tr><td width="21%">Nombre:</td><td width="21%" align="left">'.$pro_name.'</td><td width="6%"></td><td width="21%">Cantidad:</td><td width="21%" align="left">'.$pro_quantity.'</td></tr>
<tr><td width="21%">Categoria:</td><td width="21%" align="left">'.$pca_name.'</td><td width="6%"></td><td width="21%">Unidades:</td><td width="21%" align="left">'.$pro_unidad.'</td></tr>
<tr><td width="21%">Descripcion:</td><td width="21%"></td><td width="6%"></td><td width="21%"></td><td width="21%"></td></tr>
<tr><td colspan="5" align="left">'.$pro_description.'</td></tr>
<tr><td><br /><br /></td><td><br /><br /></td></tr>
<tr><td colspan="5"><h2>2: Datos particulares del proceso de compra</h2></td></tr>
<tr><td><br /></td><td><br /></td></tr>
<tr><td width="26%">Modalidad del proceso de compra:</td><td width="21%" align="left">'.$sub_modalidad.'</td><td width="6%"></td><td width="26%">Fecha de subasta:</td><td width="21%" align="left">'.$sub_hour_end[0].'</td></tr>
<tr><td width="21%">Tipo:</td><td width="21%" align="left">'.$sub_type.'</td><td width="6%"></td><td width="21%">Hora de subasta:</td><td width="21%" align="left">'.$sub_hour_end[1].'</td></tr>
<tr><td width="21%">Monto Referencial:</td><td width="21%" align="left">'.$sub_mount_base.'</td><td width="6%"></td><td width="21%">Tiempo límite de mejora en min.:</td><td width="21%" align="left">'.$sub_tiempo.'</td></tr>
<tr><td width="21%">Unidad de mejora:</td><td width="21%" align="left">'.$sub_mount_unidad.'</td><td width="6%"></td><td width="21%"></td><td width="21%"></td></tr>
<tr><td><br /><br /></td><td><br /><br a/></td></tr>
<tr><td colspan="5"><h2>3: Proveedores habilitados</h2></td></tr>
<tr><td><br /></td><td><br /></td></tr>
<tr><td colspan="5">
	<table width="100%">
    	<tr><th width="20%">Proveedor:</th><th width="20%">Lugar de entrega:</th><th width="20%">Medio de transporte:</th><th width="20%">Incoterm:</th><th width="20%">Factor de ajuste:</th></tr>';

$sql ="select cli_socialreason as nombre, inc_lugar_entrega, tra_name, inl_name, inc_ajuste 
from mdl_incoterm, mdl_incoterm_language, mdl_transporte, mdl_client 
where inc_inl_uid=inl_uid and inc_tra_uid=tra_uid and inc_cli_uid=cli_uid and inc_delete=0 and inc_sub_uid='$sub_uid' 
order by inc_uid desc";
$db2->query($sql);	
$i = 26;
while ($secPart = $db2->next_record())
{		
     $html.= '<tr><td width="20%" align="center">'.$secPart['nombre'].'</td><td width="20%" align="center">'.$secPart['inc_lugar_entrega'].'</td><td width="20%" align="center">'.$secPart['tra_name'].'</td><td width="20%" align="center">'.$secPart['inl_name'].'</td><td width="20%" align="center">'.$secPart['inc_ajuste'].'</td></tr>';
 }   
$html.=	'</table>
</td></tr>
</table>
</body>
</html>
';
if ($formato=="pdf") {
	 require '../../MPDF57/mpdf.php';
	 $mpdf = new mPDF('win-1252', 'A4', '', '', 10, '', '', '', '', '');
	 $mpdf -> useOnlyCoreFonts = true;
	 $mpdf -> SetDisplayMode('fullpage');
	 $mpdf -> WriteHTML($html);
	 $mpdf-> Output('Reportedepujas-'.date("YmdHis").'.pdf','D');
	 exit;
}
else {
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Reportedepujas-'.date("YmdHis").'.xls"');
	header('Cache-Control: max-age=0');
	echo $html;
}
?>