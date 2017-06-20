<?php
include_once ("../../core/admin.php");
include_once("../../core/safeHtml.php");
admin::initialize('subastas','subastasList');
$rel_new_uid = admin::toSql(safeHtml(admin::getParam('rel_new_uid')),"Number");
$rel_new_uid2 = admin::toSql(safeHtml(admin::getParam('rel_new_uid2')),"Number");

		$sql='update mdl_news_relationship set rel_delete=1 where rel_new_uid='.$rel_new_uid.' and rel_new_uid2='.$rel_new_uid2;	
		$db->query($sql);
		
?>
         	<?php 
			$dset = new DBmysql;
			$sqldat = "select rel_uid,nel_new_uid,nel_title  
						from mdl_news_relationship  
						LEFT JOIN mdl_news_languages on rel_new_uid2=nel_new_uid 
						where rel_new_uid=".$rel_new_uid." 			
						and nel_language='".$lang."' 
						and rel_delete=0 
						order by rel_uid";
				$dset->query($sqldat);
				while ($row = $dset->next_record()){
			?>
                
					<tr class="<?=(++$i%2 ? 'row0':'row')?>">

						<td>
    	                    <input type="hidden" id="related[<?=$row['nel_new_uid']?>]" name="related[<?=$row['nel_new_uid']?>]" value="<?=$row['nel_new_uid']?>"  />
							<?=utf8_encode($row['nel_title'])?>
                        </td>
                        <td >
        	                <a href="#" onclick="delNode_rel(<?=$row['nel_new_uid']?>,<?=$rel_new_uid?>);return false;">
								<img src="lib/close.gif" border="0" title="<?=admin::labels('delete')?>" alt="<?=admin::labels('delete')?>">
							</a>
                    	</td>
					</tr>
            
           <?php } ?>