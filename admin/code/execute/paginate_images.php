<?php
include_once ("../../core/admin.php");
include_once("../../core/safeHtml.php");
admin::initialize('subastas','subastasList');
$search_box = admin::toSql(safeHtml(admin::getParam('search_box')),"Text");
$by_category = admin::toSql(safeHtml(admin::getParam('by_category')),"Number");

$fecha1 = admin::changeFormatDate(admin::getParam("fecha1"),1);
$fecha2 = admin::changeFormatDate(admin::getParam("fecha2"),1);

$rel_list = admin::toSql(safeHtml(admin::getParam('rel_list')),"Text");

$sels = explode(',',$rel_list);
//print_r($sels);					 
?>
        <link rel="stylesheet" type="text/css" href="css/jPaginate.css" media="screen"/>
		<script src="js/jquery.paginate.js" type="text/javascript"></script>
<?php
		$max_rows = 25;
		$between = ($fecha1!='--' && $fecha2!='--') ? " and new_date between '".$fecha1."' and '".$fecha2."' ":"";
		
		if($by_category)
			$sql="SELECT nel_new_uid,nel_title,nel_image_foot,nel_image FROM mdl_news left join mdl_news_languages on new_uid=nel_new_uid WHERE nel_language='es' and (nel_title like '%".$search_box."%' or nel_image_foot like '%".$search_box."%' or nel_titlepage like '%".$search_box."%') and new_nec_uid=".$by_category . $between;
		else{
			if($fecha1!='--' && $fecha2!='--')
				$sql="SELECT nel_new_uid,nel_title,nel_image_foot,nel_image FROM mdl_news left join mdl_news_languages on new_uid=nel_new_uid WHERE nel_language='es' and (nel_title like '%".$search_box."%'  or nel_image_foot like '%".$search_box."%' or nel_titlepage like '%".$search_box."%') ". $between;
			else 
				$sql="SELECT nel_new_uid,nel_title,nel_image_foot,nel_image FROM mdl_news_languages WHERE nel_language='es' and (nel_title like '%".$search_box."%' or nel_image_foot like '%".$search_box."%' or nel_titlepage like '%".$search_box."%') ";	
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
			echo '<ul>';
			$i=1;
			while($i <= $max_rows )	{
				if ($news = $db->next_record()) {
					echo '<li><a href="#" onclick="addRelated_images('.$news['nel_new_uid'].');return false;"><img id="imgID_'.$news['nel_new_uid'].'" src="'.PATH_DOMAIN.'/img/news/thumb_'.$news['nel_image'].'" alt="'.utf8_encode($news['nel_image_foot']).'" title="'.utf8_encode($news['nel_image_foot']).'" ></a></li>';
				}
				$i++;
			}
			echo '</ul>';
			echo '</div>';
		}?>
				<div id="demo5">                   
                </div>
            </div>
 
    
 