<?php
include_once("../../core/admin.php");
include_once("../../core/files.php");
admin::initialize('docs','docsNew',false); 
$doc_uid = $_REQUEST["uid"];
$sql = "update mdl_docs_languages  
		set dol_adjunt=''  
		where dol_doc_uid=" . $doc_uid;
$db->query($sql);
?>