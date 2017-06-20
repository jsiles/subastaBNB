<?php
include_once ("../../core/admin.php");
include_once("../../core/safeHtml.php");
admin::initialize('subastas','subastasList');
$search_box = admin::toSql(safeHtml(admin::getParam('search_box')),"Text");
$by_category = admin::toSql(safeHtml(admin::getParam('by_category')),"Number");
$new_uid = admin::toSql(safeHtml(admin::getParam('new_uid')),"Number");
$fecha1 = admin::changeFormatDate(admin::getParam("fecha1"),1);
$fecha2 = admin::changeFormatDate(admin::getParam("fecha2"),1);

?>
        <link rel="stylesheet" type="text/css" href="css/jPaginate.css" media="screen"/>
		<script src="js/jquery.paginate.js" type="text/javascript"></script>
<?php
		$max_rows = 25;
		$between = ($fecha1!='--' && $fecha2!='--') ? " and new_date between '".$fecha1."' and '".$fecha2."' ":"";
		
		if($by_category)
			$sql="SELECT nel_new_uid,nel_title FROM mdl_news left join mdl_news_languages on new_uid=nel_new_uid WHERE nel_language='es' and nel_title like '%".$search_box."%' and new_nec_uid=".$by_category . $between;
		else{
			if($fecha1!='--' && $fecha2!='--')
				$sql="SELECT nel_new_uid,nel_title FROM mdl_news left join mdl_news_languages on new_uid=nel_new_uid WHERE nel_language='es' and nel_title like '%".$search_box."%' ". $between;
			else 
				$sql="SELECT nel_new_uid,nel_title FROM mdl_news_languages WHERE nel_language='es' and nel_title like '%".$search_box."%'";	
		}

		$Consulta_ID = $db->query($sql);
		$total = $Consulta_ID ? $db->numrows(): 1 ;
		$num_pages = ceil($total / $max_rows);
		
?>        
		<script type="text/javascript">
		$(function() {
			$("#demo5").paginate({
				count 		: <?=$num_pages?>,
				start 		: 1,
				display     : 5,
				border					: true,
				border_color			: '#fff',
				text_color  			: '#fff',
				background_color    	: 'black',	
				border_hover_color		: '#ccc',
				text_hover_color  		: '#000',
				background_hover_color	: '#fff', 
				images					: false,
				mouse					: 'press',
				onChange     			: function(page){
											$('._current','#paginationdemo').removeClass('_current').hide();
											$('#p'+page).addClass('_current').show();
										  }
			});
		});
		</script>
			<div id="paginationdemo" class="demo">
				
        <?php 

		for($page=1 ; $page <= $num_pages ; $page++) {
			if($page==1) 
				echo '<div id="p'.$page.'" class="pagedemo _current" style="">';
			else 
				echo '<div id="p'.$page.'" class="pagedemo" style="display:none;">';
			echo '<table class="list" border="0" cellspacing="5" cellpadding="0" width="100%">';
			$i=1;
			while($i <= $max_rows )	{
				if ($news = $db->next_record()) {
					$sqldat = 'select rel_uid,rel_delete from mdl_news_relationship where rel_new_uid='.$new_uid.' and rel_new_uid2='.$news['nel_new_uid'].' and rel_delete=0';
					$db2->query($sqldat);
					if($rel = $db2->next_record()){
						$agregado = '<input type="checkbox" name="check_'.$news['nel_new_uid'].'" id="check_'.$news['nel_new_uid'].'" checked="checked" onclick="addRelated('.$news['nel_new_uid'].','.$new_uid.',this)" />';
					} 
					else{
						$agregado = '<input type="checkbox" name="check_'.$news['nel_new_uid'].'" id="check_'.$news['nel_new_uid'].'" onclick="addRelated('.$news['nel_new_uid'].','.$new_uid.',this)" />';
					}
				echo '<tr class="'.($i%2 ? 'row':'row0').'"><td id="td_'.$news['nel_new_uid'].'">'.$agregado.'</td><td id="tit_'.$news['nel_new_uid'].'">'.utf8_encode($news['nel_title']).'</td></tr>';
				//echo 'pag='.$i;
				}
				$i++;
			}
			echo '</table>';
			echo '</div>';
		}?>
				<div id="demo5">                   
                </div>
            </div>
 
    
 