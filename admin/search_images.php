<?php
include ("core/admin.php");
?>
                <div style="width:700px;">
                    <form name="searchForm" action="<?=$_SERVER['PHP_SELF']?>" >
                        <input id="search" type="text" class="search"  autocomplete="off" onkeyup="enableSearch()"/>
                        <input id="submit_button" type="submit" value="search" class="button" onclick="paginateImages();return false" disabled="disabled" />
                        <a href="toggle" id="advanced_link" onclick="javascript:toggleRelated();return false;">Avanzado</a>
                        <div id="advanced_div" style="display:none">
                        <select id="by_category" name="by_category">
                            
                            <?php 
							$sql = "select nec_uid,ncl_category 
						from mdl_news_category 
						left join mdl_news_category_languages on (nec_uid=ncl_nec_uid)
						where nec_delete<>1 and 
							  ncl_language='" . $lang . "'			
						order by nec_position";
						
				$db->query($sql);?>
                <option value="0">--Seleccionar--</option>
                <?php while ($category = $db->next_record()){ ?>
				<option value="<?=$category["nec_uid"]?>" ><?=utf8_encode($category["ncl_category"])?></option>
				<?php } ?>
                        </select>
                        Desde <input name="fecha1" type="text" class="input"  id="fecha1" value="" size="15" readonly="" /> <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.searchForm.fecha1);return false;" >
				<img border="0" src="calendario/icon_calendar.gif">				</a>
                        Hasta <input name="fecha2" type="text" class="input"  id="fecha2" value="" size="15" readonly="" /> <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.searchForm.fecha2);return false;" >
				<img border="0" src="calendario/icon_calendar.gif">				</a>
                </div>
                    </form>
                </div>
               
             <div id="div_thumb_selected" style="display:none"><img id="thumb_selected" src="lib/spacer.gif"  />&nbsp;<a href="#" onclick="removeImg_thumb()"><img border="0" src="lib/close.gif"  /></a></div>
             
           <hr color="#D8DADD" />
           <div align="center"><img id="img_loading" style="display:none;" src="facebox_lib/loading.gif" /></div>
                <div id="listing_container" align="center" style="display:"></div>
                <!--end of listing_container-->
<script>
var obj_b;

			for(j=0;j<IMGList.length;j++){
				td_node = $('#td_'+IMGList[j]).html();
				obj_b = '<tr id="rowbox_'+IMGList[j]+'"><td>'+td_node+'</td><td><a href="#" onclick="delNode_images('+IMGList[j]+');return false;"><img src="lib/close.gif" border="0" title="dere" alt="fsefs"></a></td></tr>';
				$("#news_related2").append(obj_b);
				}
</script>                