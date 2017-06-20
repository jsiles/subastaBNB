<?php
//error_reporting(E_ALL^E_NOTICE);
include ("../../core/admin.php");
include('../../core/paginator.class.php');
admin::initialize('subastas','subastasList');
// instantiate mysqli connection
$conn = new mysqli('localhost', DBUSER, DBPASSWORD,DATABASE) ; //DBHOST

//$query = "SELECT * FROM customers WHERE id > 1";
//$query = "SELECT * FROM customers";

if(admin::getParam('by_category'))
	$query = "SELECT nel_new_uid,nel_title FROM mdl_news left join mdl_news_languages on new_uid=nel_new_uid WHERE nel_language='es'";
else 
	$query = "SELECT nel_new_uid,nel_title FROM mdl_news_languages WHERE nel_language='es'";


// set the searching query
if(!empty(admin::getParam('search'))){
	$searchQuery = admin::getParam('search');
}

$pageId= intval(admin::getParam('page'));
if (empty($pageId)) {
	$pageId = 1;
}else{
	$pageId = intval($pageId); 
}
// if you are testing it locally uncomment the following line
// to see how it is going to look like
//sleep(2);

//number of records per page
$recPerPage = 15;
$paginator = new Paginator($pageId,$recPerPage,$query,$conn);

// fields to search in
// string or array of fields
//$paginator->fields = 'name';
$paginator->fields = 'nel_title';
$paginator->by_category = admin::getParam('by_category');

$paginator->searchQuery = $searchQuery;

$rows = $paginator->paginate();
?>
    <table border="0" cellpadding="2" cellspacing="0" class="list">
	<tr>
		<th  width="40" align='center'> ID</th>
		<th  width="550" align='center'>Name</th>
        <th  width="100" align='center'>&nbsp;</th>
	</tr>

<?php

foreach($rows as $row){
	?>
	<tr class="<?=(++$i%2?'row':'row2')?>" id="sub_<?=$row['nel_new_uid']?>">
        <td ><?=$row['nel_new_uid']?></td>
        <td ><?=utf8_encode($row['nel_title'])?></td>
        <td><a href="#" onclick="addRelated(<?=$row['nel_new_uid']?>,'<?=utf8_encode($row['nel_title'])?>');return false;">Agregar</a></td>
	</tr>
    
<?php } ?>
</table><br />
<?php 
$links = $paginator->getLinks ();
echo "<div class='paginator'> " . $links ;

echo "<p>Page " . $paginator->pageId . " of " . $paginator->totalPages . "</p>";
echo "</div>";
?>