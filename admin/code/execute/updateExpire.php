<?php
include_once ("../../core/admin.php"); 

$mcp_exp_day = admin::toSql(admin::getParam("dates"),"String");
$mcl_cost= admin::toSql(admin::getParam("val"),"Number");

$diaExp=substr($mcp_exp_day,0,2);
$mesExp=substr($mcp_exp_day,3,2);
$anoExp=substr($mcp_exp_day,6,4);
$mcp_expire_day  = mktime(0, 0, 0, $mesExp+$mcl_cost, $diaExp, $anoExp);
$mcp_expire_day = date( "d/m/Y", $mcp_expire_day );  
echo $mcp_expire_day;
?>