<?php
include_once("../admin/core/admin.php");
$sub_type = admin::getParam("sub_type");
$sub_uid = admin::getParam("sub_uid");
$sql = "SELECT * FROM mdl_xitem,mdl_clixitem WHERE xit_uid=clx_xit_uid and clx_delete=0 and xit_delete=0 and xit_sub_uid=".$sub_uid." and clx_cli_uid=".admin::getSession("uidClient"); //and sub_deadTime>='".$deadTime."' 
$db->query($sql);
$dataRef="";
//echo $sql;
$i=0;
while($details = $db->next_record())
{
    if($sub_type=="COMPRA"){
        $montoRef = admin::getDbValue("select min(bid_mountxfac) from mdl_biditem where bid_xit_uid=".$details['xit_uid']);
    }else{
        $montoRef = admin::getDbValue("select min(bid_mountxfac) from mdl_biditem where bid_xit_uid=".$details['xit_uid']);
    }
    if($i==0)
        $dataRef.= $details['xit_uid'].";".$montoRef;
    else 
        $dataRef.="|".$details['xit_uid'].";".$montoRef;
    $i++;
}
echo $dataRef;
?>            
        