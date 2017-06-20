// JavaScript Document
// JavaScript Document
function removeList(id){
	var txt = '¿Está seguro de eliminar el registro?<br><input type="hidden" id="list" name="list" value="'+ id +'" />';
	token = $.getUrlVar('token');
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Eliminar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();

				  $('#'+uid).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/modulesDel.php',
						type: 'POST',
						data: 'uid='+uid
					});
		 
			}
			else{}
			
		}
	});
}
function removeListCat(id){
	var txt = '¿Está seguro de eliminar el registro?<br><input type="hidden" id="list" name="list" value="'+ id +'" />';
	token = $.getUrlVar('token');
	$.prompt(txt,{
		show:'fadeIn' ,
		opacity:0,
		buttons:{Eliminar:true, Cancelar:false},
		callback: function(v,m){
										   
			if(v){
				var uid = m.find('#list').val();
				  $('#list_'+id).fadeOut(500, function(){ $(this).remove(); });
					  $.ajax({
						url: 'code/execute/modulesCatDel.php',
						type: 'POST',
						data: 'uid='+id
					});
				 /********BeginResetColorDelete*************/  
				 //resetOrderRemove(id);  
				 /********EndResetColorDelete*************/ 
		 
			}
			else{}
			
		}
	});
}

function modulesCS(uid,status){
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/modulesCS.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4){
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	token = $.getUrlVar('token');
	ajax.send("uid="+uid+"&status="+status)
	}
	
function modulesCSC(uid,status){
	divx = document.getElementById('statusc_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/modulesCSC.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4){
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	token = $.getUrlVar('token');
	ajax.send("uid="+uid+"&status="+status)
	}