<?php
include_once("../../core/admin.php");

// OBTENEMOS LA ULTIMA POSICION EN LA CUAL SERA COLOCADA LA CATEGORIA
$sql = "select count(*) as POSITION
		from mdl_team_category 
		where tca_delete=0";
$db->query($sql);
$catPosition = $db->next_record();
$position =  $catPosition["POSITION"] + 1;

// REGISTRAMOS LA CATEGORIA
	$categoryName = admin::toSql(utf8_decode($_POST["other_category"]),"String");
$sql = "insert into mdl_team_category(
							tca_position, 
							tca_delete ,
							tca_category,
							tca_url,
							tca_status 
							)
					values	(
							" . $position . ", 
							0,
							'" . $categoryName . "',
							'" . admin::urlsFriendly($categoryName) . "',
							'ACTIVE'
							)";
$db->query($sql);

// ULTIMO REGISTRO
$sql="SELECT LAST_INSERT_ID() as UID;";
$db->query($sql);
$news = $db->next_record();
$LAST_UID = $news["UID"];


// CONSTRUIMOS EL NUEVO SELECT	
				$sql = "select *
						from mdl_team_category   
						where 
							  tca_delete<>1 and
							  tca_status='ACTIVE' 			
						order by tca_category";
$db->query($sql);
?>
<select name="doc_dca_uid" class="listMenu" id="doc_dca_uid" onfocus="this.className='listMenu';document.getElementById('div_doc_dca_uid').style.display='none';">				
	<option value="0"><?=admin::labels('select');?></option>
<? while ($category = $db->next_record())
	{ ?>
	<option value="<?=$category["tca_uid"]?>" <? if ($category["tca_uid"]==$LAST_UID) echo "selected"; ?>><?=utf8_encode($category["tca_category"])?></option>
<?	} ?>				
</select>			
<a href="javascript:changeOtherCategory('on');" class="link2"><?=admin::labels('add');?></a>

