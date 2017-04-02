// JavaScript Document
// Obtener parametros del URL
// ejemplo:
//		token = $.getUrlVar('token');
$.extend({
  getUrlVars: function(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
  },
  getUrlVar: function(name){
    return $.getUrlVars()[name];
  }
});

// JavaScript Document
function objectAjax()
	{
	var xmlhttp=false;
	try 
		{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} 
	catch (e) 
		{
		try 
			{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} 
		catch (E) 
			{
			xmlhttp = false;
			}
		}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') 
		{
  		xmlhttp = new XMLHttpRequest();
  		}
  	return xmlhttp;
  	}

function viewInputFile2(uid,status)
	{
	if (status=='on')
		{
		$('#imageChange_'+uid).show();
		}
	if (status=='off')
		{
		$('#imageChange_'+uid).hide();
		}
	}
// SCRIPT PARA LOS ARCHIVOS SUBIDOS POR FORMULARIO
function viewInputFile(status)
	{
	if (status=='on')
		{
		$('#imageChange1').show();
		}
	if (status=='off')
		{
		$('#imageChange1').hide();
		}
	}
function changeInputFile(status)
	{
	if (status=='on')
		{
		$('#div_adjunt_file_change').show();
		}
	if (status=='off')
		{
		$('#div_adjunt_file_change').hide();
		}
	}

function showHide(e)
	{
		$('#'+e).toggle();					
	}
function updateExpireDate()
	{
		token = $.getUrlVar('token');
		divx = document.getElementById('mcp_exp_day');
		valE = document.getElementById('mcl_cost');
		dates = document.getElementById('mcp_type_date');
  		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
 		 //instanciamos el objetoAjax
 		 ajax=objectAjax();
 		 ajax.open("POST", "code/execute/updateExpire.php",true);
 		 ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
 		 ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 		 //enviando los valores
  		ajax.send("dates="+dates.value+"&val="+valE.value+"&token="+token)						
	}	
	
function changeUploadFile(e)
	{
		$('#div_adjunt_file_change_'+e).toggle();					
	}
// SCRIPT PARA LA CABEZERA DEL SISTEMA	
function changeSiteHeader(status)
	{
	if (status=='on')
		$('#changeDiv2').fadeIn();
	else
		$('#changeDiv2').fadeOut();
	}
function changeLanguageHeader(status)
	{
	if (status=='on')
		$('#changeDiv').fadeIn();
	else
		$('#changeDiv').fadeOut();
	}
function moreMinusContent(ID)
	{
	if (document.getElementById('div_more_'+ID).style.display=='')
		{
		document.getElementById('div_minus_'+ID).style.display='';
		document.getElementById('div_more_'+ID).style.display='none';
        $('#subList_'+ID).fadeIn(500);
        }
	else
		{
		document.getElementById('div_more_'+ID).style.display='';
		document.getElementById('div_minus_'+ID).style.display='none';
        $('#subList_'+ID).fadeOut(500);
        }
	//Effect.toggle('subList_'+ID,'appear', { duration: 0.5 });
	//return false;
	}

function moreOffContent(ID)
	{
	document.getElementById('div_more_off_'+ID).style.display='';
	document.getElementById('div_more_'+ID).style.display='none';
	document.getElementById('div_minus_'+ID).style.display='none';
	
	document.getElementById('div_view_off_'+ID).style.display='none';
	document.getElementById('div_view_on_'+ID).style.display='';
/*	document.getElementById('div_edit_off_'+ID).style.display='none';
	document.getElementById('div_edit_on_'+ID).style.display='';*/
	}
	
function setClassInput(input,status)
	{
	if (status=='ON')
		input.className = 'inputover';
	else
		input.className = 'input';
	}
function setClassInput3(input,status)
	{
	if (status=='ON')
		input.className = 'input3Over';
	else
		input.className = 'input3';
	}
	
function setClassTextarea(textarea,status)
	{
	if (status=='ON')
		textarea.className = 'textareaOver';
	else
		textarea.className = 'textarea';
	}
function setClassTextarea2(textarea,status)
	{
	if (status=='ON')
		textarea.className = 'textarea2Over';
	else
		textarea.className = 'expanding';
	}
function setClassInputLogin(input,status)
	{
	if (status=='ON')
		input.className = 'inputOverl';
	else
		input.className = 'inputl';
	}
	
 function growTextarea(textarea)	
	{
	// Opera isn't just broken. It's really twisted.
	if (textarea.scrollHeight > textarea.clientHeight && !window.opera)
		{
		while(textarea.scrollHeight > textarea.clientHeight)
			{
			textarea.rows += 1;
			}
		}
	}

// Permite marcar el registro en donde se encuentra el ratón
function checkSelectedRow(id,div1,status)
	{
	if (status=='on')
		{
		document.getElementById('category_'+id).innerHTML=div1.className;
		div1.className='rowOver2';
		}
	if (status=='off')
		{
		div1.className=document.getElementById('category_'+id).innerHTML;
		}
	}	
//SCRIPT PARA CONTENIDOS
function verifyContent()
	{
	sw=true;
	
	document.getElementById('div_col_title').style.display='none';
	if (document.getElementById('col_title').value=='')
		{
		document.getElementById('col_title').className='inputError';
		document.getElementById('div_col_title').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmContent.submit();
		}
	else
		{
		scroll(0,0);
		}
		
	}


function contentCS(con_uid,status)
  {
  token = $.getUrlVar('token');
  divx = document.getElementById('status_' + con_uid);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  //instanciamos el objetoAjax
  ajax=objectAjax();
  ajax.open("POST", "code/execute/contentCS.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("con_uid="+con_uid+"&col_status="+status+"&token="+token)
  }
  
function verifyBanner()
	{
	sw=true;
	sw0=true;
	
	if (document.getElementById('ban_title').value=='')
		{
		document.getElementById('ban_title').className='inputError';
		document.getElementById('div_ban_title').style.display='';
		sw=false;
		}
	
	if (document.getElementById('ban_adjunt').value=='')
		{
		document.getElementById('ban_adjunt').className='inputError';
		document.getElementById('div_ban_adjunt').style.display='';
		sw=false;
		}
	else{
		document.getElementById('div_ban_adjunt').style.display="none";
			var cv = document.getElementById('ban_adjunt').value;
			var filepart = cv.split(".");
			var part = filepart.length-1;
			var extension = filepart[part];
			extension = extension.toLowerCase();
			if (extension=='jpg' || extension=='jpeg' || extension=='bmp' || extension=='gif' || extension=='png' || extension=='swf')	
				{
				document.getElementById('div_ban_adjunt').style.display="none";
				}
			else
				{
				document.getElementById('div_ban_adjunt').style.display="";
				sw0=false;
				}
		}	
	if (sw && sw0) 
		{
		document.frmBanner.submit();
		}
	else
		{
		scroll(0,0);
		}
	}

function verifyBanner2()
	{
	sw=true;
	if (document.getElementById('ban_title').value=='')
		{
		document.getElementById('ban_title').className='inputError';
		document.getElementById('div_ban_title').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmBanner.submit();
		}
	else
		{
		scroll(0,0);
		}
	}

function bannerCS(uid,status)
  {
  token = $.getUrlVar('token');	  
  divx = document.getElementById('status_' + uid);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  //instanciamos el objetoAjax
  ajax=objectAjax();
  ajax.open("POST", "code/execute/bannerCS.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("uid="+uid+"&status="+status+"&token="+token);
  }

// FUNCIONES PARA EL MODULO DE NOTICIAS
function verifyCatNews()
	{
	sw=true;
	document.getElementById('div_nec_category').style.display='none';
	if (document.getElementById('nec_category').value=='')
		{
		document.getElementById('nec_category').className='inputError';
		document.getElementById('div_nec_category').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmNewsCat.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
function cagetogyNewsAdd()
	{
	document.getElementById('div_other_category_error').style.display='none';
	var other_category = document.getElementById('other_category').value;
	if (other_category=="")
		{
		$('#div_other_category_error').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_new_nec_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		//instanciamos el objetoAjax
		ajax=objectAjax();
		//uso del medotod POST
		ajax.open("POST", "code/execute/newsCatAdd2.php",true);
		ajax.onreadystatechange=function() {
					if (ajax.readyState==4) 
						{
						//mostrar resultados en esta capa
						divx.innerHTML=ajax.responseText;
						document.getElementById('div_other_category_error').style.display='none';
						document.getElementById('div_other_category').style.display='none';
						document.getElementById('div_new_nec_uid').style.display='none';						
						document.getElementById('other_category').className='input3';							
						}
					}  
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores
		ajax.send("other_category="+other_category)	
		}
	}
function cagetogyNewsBuyAdd()
	{
	token = $.getUrlVar('token');
	document.getElementById('div_other_category_error').style.display='none';
	var other_category = document.getElementById('other_category').value;
	if (other_category=="")
		{
		$('#div_other_category_error').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_new_nec_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		//instanciamos el objetoAjax
		ajax=objectAjax();
		//uso del medotod POST
		ajax.open("POST", "code/execute/newsCatAdd2Buy.php",true);
		ajax.onreadystatechange=function() {
					if (ajax.readyState==4) 
						{
						//mostrar resultados en esta capa
						divx.innerHTML=ajax.responseText;
						document.getElementById('div_other_category_error').style.display='none';
						document.getElementById('div_other_category').style.display='none';
						document.getElementById('div_new_nec_uid').style.display='none';						
						document.getElementById('other_category').className='input3';							
						}
					}  
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores
		ajax.send("other_category="+other_category+"&token="+token)	
		}
	}
function cagetogyOpinionAdd()
	{
	token = $.getUrlVar('token');
	document.getElementById('div_other_category_error').style.display='none';
	var other_category = document.getElementById('other_category').value;
	if (other_category=="")
		{
		$('#div_other_category_error').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_new_nec_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		//instanciamos el objetoAjax
		ajax=objectAjax();
		//uso del medotod POST
		ajax.open("POST", "code/execute/opinionSubcatAdd.php",true);
		ajax.onreadystatechange=function() {
					if (ajax.readyState==4) 
						{
						//mostrar resultados en esta capa
						divx.innerHTML=ajax.responseText;
						document.getElementById('div_other_category_error').style.display='none';
						document.getElementById('div_other_category').style.display='none';
						document.getElementById('div_new_nec_uid').style.display='none';						
						document.getElementById('other_category').className='input3';							
						}
					}  
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores
		ajax.send("other_category="+other_category+"&token="+token)	
		}
	}	
function verifyNews(publish){


	if(publish=='publish')
		document.getElementById('publish').value=1;
	sw=true;
	document.getElementById('div_new_title').style.display='none';
	document.getElementById('div_new_nec_uid').style.display='none';
	document.getElementById('div_other_category_error').style.display='none';
	


	if (document.getElementById('new_title').value==''){
		document.getElementById('new_title').className='inputError';
		document.getElementById('div_new_title').style.display='';
		sw=false;
	}
	if (document.getElementById('new_nec_uid').value=='0'){
		document.getElementById('new_nec_uid').className='inputError';
		document.getElementById('div_new_nec_uid').style.display='';
		sw=false;
	}
	if (document.getElementById('new_hora').value==''){
		document.getElementById('new_hora').className='inputError';
		document.getElementById('div_new_hora').style.display='';
		sw=false;
	}

	if($('#new_template0').attr('checked')){
		if($('#new_cat0').val()==0){
		document.getElementById('new_cat0').className='inputError';
		document.getElementById('div_new_cat0').style.display='';
		sw=false;
		}
	}
	if($('#new_template2').attr('checked')){
		if($('#new_cat2').val()==0){
		document.getElementById('new_cat2').className='inputError';
		document.getElementById('div_new_cat2').style.display='';
		sw=false;
		}
	}
	if($('#new_template3').attr('checked')){
		if($('#new_cat3').val()==0){
		document.getElementById('new_cat3').className='inputError';
		document.getElementById('div_new_cat3').style.display='';
		sw=false;
		}
	}
	if($('#new_template4').attr('checked')){
		if($('#new_cat4').val()==0){
		document.getElementById('new_cat4').className='inputError';
		document.getElementById('div_new_cat4').style.display='';
		sw=false;
		}
	}
   
	if (sw){
		document.frmNews.submit();
	}
	else{
		scroll(0,0);
	}
}
function verifyNewsBuy()
	{
	sw=true;
	document.getElementById('div_new_title').style.display='none';
	if (document.getElementById('new_title').value=='')
		{
		document.getElementById('new_title').className='inputError';
		document.getElementById('div_new_title').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmNewsBuy.submit();
		}
	else
		{
		scroll(0,0);
		}
	}

function verifyOpinion()
	{
	sw=true;
	document.getElementById('div_new_title').style.display='none';
	if (document.getElementById('new_title').value=='')
		{
		document.getElementById('new_title').className='inputError';
		document.getElementById('div_new_title').style.display='';
		sw=false;
		}
	else if(document.getElementById('new_nec_uid').value=='0')
		{
		document.getElementById('new_nec_uid').className='inputError';
		document.getElementById('div_new_nec_uid').style.display='';
		sw=false;
		}
		
		
		
	if (sw) 
		{
		document.frmOpinion.submit();
		}
	else
		{
		scroll(0,0);
		}
	}

function verifyAutorOpinion()
	{
	sw=true;
	sw0=true;
	document.getElementById('div_ncl_name').style.display='none';
	document.getElementById('div_ncl_column').style.display='none';
	
	if (document.getElementById('ncl_name').value=='')
		{
		document.getElementById('ncl_name').className='inputError';
		document.getElementById('div_ncl_name').style.display='';
		sw=false;
		}
	if (document.getElementById('ncl_column').value=='')
		{
		document.getElementById('ncl_column').className='inputError';
		document.getElementById('div_ncl_column').style.display='';
		sw0=false;
		}
	if (sw && sw0) 
		{
		document.frmAutorOpinion.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
function verifyAutorBuy()
	{
	sw=true;
	document.getElementById('div_ncl_category').style.display='none';
	
	if (document.getElementById('ncl_category').value=='')
		{
		document.getElementById('ncl_category').className='inputError';
		document.getElementById('div_ncl_category').style.display='';
		sw=false;
		}

	if (sw) 
		{
		document.frmAutorBuy.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
function newsCSC(uid,status)
	{
	token = $.getUrlVar('token');	
	divx = document.getElementById('status_c_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/newsCSC.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status+"&token="+token)
	}
function newsCS(uid,status)
  {
  token = $.getUrlVar('token');	 	  
  divx = document.getElementById('status_' + uid);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  //instanciamos el objetoAjax
  ajax=objectAjax();
  //uso del medotod POST
  ajax.open("POST", "code/execute/newsCS.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("uid="+uid+"&status="+status+"&token="+token)
  }
function newsBuyCSC(uid,status)
	{
	token = $.getUrlVar('token');	
	divx = document.getElementById('status_c_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/newsCSCBuy.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status+"&token="+token)
	}
function newsBuyCS(uid,status)
  {
  token = $.getUrlVar('token');	 	  
  divx = document.getElementById('status_' + uid);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  //instanciamos el objetoAjax
  ajax=objectAjax();
  //uso del medotod POST
  ajax.open("POST", "code/execute/newsCSBuy.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("uid="+uid+"&status="+status+"&token="+token)
  }  
function subastatatus(uid,status)
  {
  token = $.getUrlVar('token');	
  divx = document.getElementById('status_' + uid);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  //instanciamos el objetoAjax
  ajax=objectAjax();
  //uso del medotod POST
  ajax.open("POST", "code/execute/subastata.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("uid="+uid+"&status="+status+"&token="+token)
  }
  
// SALA DE PRENSA
function verifysubasta()
	{
	sw=true;
	document.getElementById('div_pro_name').style.display='none';
	document.getElementById('div_sol_uid').style.display='none';
	if (document.getElementById('pro_name').value=='')
		{
		document.getElementById('pro_name').className='inputError';
		document.getElementById('div_pro_name').style.display='';
		sw=false;
		}
	if (document.getElementById('sol_uid').value=='')
		{
		document.getElementById('sol_uid').className='inputError';
		document.getElementById('div_sol_uid').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmsubasta.submit();
		}
	else
		{
		scroll(0,0);
		}
	}

function changeCategoryPress()
	{
	if (document.getElementById('pre_prc_uid').selectedIndex==5)
		document.getElementById("div_thematic").style.display='';
	else
		document.getElementById("div_thematic").style.display='none';
	}
	
	
function pressCS(uid,status)
	{
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/pressCS.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status)
	}
function pressCSC(uid,status)
	{
	divx = document.getElementById('status_c_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/pressCSC.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status)
	}

// GALERIA DE IMAGENES 
function verifyGallery(type)
	{
	sw=true;
	
	document.getElementById('div_gla_title').style.display='none';
	if (document.getElementById('gla_title').value=='')
		{
		document.getElementById('gla_title').className='inputError';
		document.getElementById('div_gla_title').style.display='';
		sw=false;
		}
	if (document.getElementById('gal_gac_uid').selectedIndex==0)
		{
		document.getElementById('gal_gac_uid').className='inputError';
		document.getElementById('div_gal_gac_uid').style.display='';
		sw=false;
		}		
	if (sw) 
		{
		document.getElementById('galleryadd').value=type;
		document.frmGallery.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
function verifyCatGallery()
	{
	sw=true;
	
	document.getElementById('div_gac_category').style.display='none';
	if (document.getElementById('gac_category').value=='')
		{
		document.getElementById('gac_category').className='inputError';
		document.getElementById('div_gac_category').style.display='';
		sw=false;
		}
		/*
	if (document.getElementById('gal_gac_uid').selectedIndex==0)
		{
		document.getElementById('gal_gac_uid').className='inputError';
		document.getElementById('div_gal_gac_uid').style.display='';
		sw=false;
		}
		*/
	if (sw) 
		{
//		document.getElementById('galleryadd').value=type;
		document.frmGallery.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
	
function galleryCSC(uid,status)
	{
	divx = document.getElementById('status_c_' + uid);
	divx.innerHTML = document.getElementById('DIV_WAIT1').innerHTML;
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/galleryCSC.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status)
	}

function galleryCS(uid,status)
	{
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = document.getElementById('DIV_WAIT1').innerHTML;
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/galleryCS.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status)
	}




function verifyBlogs()
	{
	sw=true;
	
	document.getElementById('div_blo_title').style.display='none';
	if (document.getElementById('blo_title').value=='')
		{
		document.getElementById('blo_title').className='inputError';
		document.getElementById('div_blo_title').style.display='';
		sw=false;
		}
	if (document.getElementById('blo_url').value=='')
		{
		document.getElementById('blo_url').className='inputError';
		document.getElementById('div_blo_url').style.display='';
		sw=false;
		}
	if (sw) 
		{
//		document.getElementById('galleryadd').value=type;
		document.frmBlogs.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
	
function blogCS(uid,status)
	{
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = document.getElementById('DIV_WAIT1').innerHTML;
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/blogsCS.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status)
	}


// Verificador del formulario de opinion
function verifyOpi()
	{
	sw=true;
	
	document.getElementById('div_opl_title').style.display='none';
	if (document.getElementById('opl_title').value=='')
		{
		document.getElementById('opl_title').className='inputError';
		document.getElementById('div_opl_title').style.display='';
		sw=false;
		}
	if (sw) 
		{
//		document.getElementById('galleryadd').value=type;
		document.frmOpinion.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
	
function opinionCS(uid,status)
	{
	token = $.getUrlVar('token');
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = document.getElementById('DIV_WAIT1').innerHTML;
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/opinionCS.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status+"&token="+token)
	}

function opinionAutorCS(uid,status)
	{
	token = $.getUrlVar('token');
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = document.getElementById('DIV_WAIT1').innerHTML;
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/opinionAutorCS.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status+"&token="+token)
	}

function buyAutorCS(uid,status)
	{
	token = $.getUrlVar('token');
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = document.getElementById('DIV_WAIT1').innerHTML;
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/buyAutorCS.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status+"&token="+token)
	}
// PUBLICACIONES
function changeOtherCategory()
{
	$('#div_other_category').toggle();
	$('#div_other_category_error').hide();
}
function cagetogyDocsAdd()
	{
	token = $.getUrlVar('token');
	document.getElementById('div_other_category_error').style.display='none';
	var other_category = document.getElementById('other_category').value;
	if (other_category=="")
		{
		$('#div_other_category_error').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_doc_dca_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		//instanciamos el objetoAjax
				$.ajax({
				url: 'code/execute/docsCatAdd2.php',
				data: "pca_name="+other_category+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
									divx.innerHTML=datos;
            						/*	document.getElementById('div_other_category_error').style.display='none';
										document.getElementById('div_other_category').style.display='none';
										document.getElementById('div_doc_dca_uid').style.display='none';						
										document.getElementById('other_category').className='input3';	*/
        						 }	
				});
		}
	}

function deleteOtherCategory()
	{
	token = $.getUrlVar('token');
	var sub_pca_uid = document.getElementById('sub_pca_uid').value;
	if (sub_pca_uid!="")
		{
		divx = document.getElementById('div_doc_dca_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		
			$.ajax({
				url: 'code/execute/delCatSubasta.php',
				data: "pca_uid="+sub_pca_uid+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
									divx.innerHTML=datos;
            						/*	document.getElementById('div_other_category_error').style.display='none';
										document.getElementById('div_other_category').style.display='none';
										document.getElementById('div_doc_dca_uid').style.display='none';						
										document.getElementById('other_category').className='input3';	*/
        						 }	
				});
		
			}
	}
	
function changeOtherTransporte()
{
	$('#div_other_transporte').toggle();
	$('#div_other_transporte_error').hide();
}
function nivel1()
{
	$('#div_nivel1').toggle();
	$('#div_nivel1_error').hide();
}
function nivel2()
{
	$('#div_nivel2').toggle();
	$('#div_nivel2_error').hide();
}
function nivel3()
{
	$('#div_nivel3').toggle();
	$('#div_nivel3_error').hide();
}
function transporteAdd()
	{
	token = $.getUrlVar('token');
	document.getElementById('div_other_transporte_error').style.display='none';
	var other_category = document.getElementById('other_transporte').value;
	var sub_uid = document.getElementById('sub_uid').value;
	if (other_category=="")
		{
		$('#div_other_transporte_error').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_inc_tra_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		$.ajax({
				url: 'code/execute/transporteAdd.php',
				data: "tra_name="+other_category+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
									divx.innerHTML=datos;
            						//document.location.href='incotermList.php?token='+token+"&sub_uid="+sub_uid;
        						 }	
	 });
	}
}
function nivel1Add()
	{
         
	token = $.getUrlVar('token');
	document.getElementById('div_nivel1_error').style.display='none';
	var other_category = document.getElementById('nivel1').value;
	//var sol_uid = document.getElementById('sol_uid').value;

	if (other_category=="")
		{
		$('#div_nivel1_error').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_nivel1_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		$.ajax({
				url: 'code/execute/nivel1Add.php',
				data: "nivel1_desc="+other_category+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
									divx.innerHTML=datos;
            						//document.location.href='incotermList.php?token='+token+"&sub_uid="+sub_uid;
        						 }	
	 });
	}
}

function nivel2Add()
	{
	token = $.getUrlVar('token');
	document.getElementById('div_nivel2_error').style.display='none';
        var nivel1 = document.getElementById('nivel1_uid').value;
    	var other_category = document.getElementById('nivel2').value;
	//var sol_uid = document.getElementById('sol_uid').value;
	if (other_category==""||nivel1=="")
		{
		$('#div_nivel2_error').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_nivel2_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		$.ajax({
				url: 'code/execute/nivel2Add.php',
				data: "ca1_uid="+nivel1+"&nivel2_desc="+other_category+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
									divx.innerHTML=datos;
            						//document.location.href='incotermList.php?token='+token+"&sub_uid="+sub_uid;
        						 }	
	 });
	}
}

function nivel3Add()
	{
	token = $.getUrlVar('token');
	document.getElementById('div_nivel3_error').style.display='none';
        var nivel2 = document.getElementById('nivel2_uid').value;
    	var other_category = document.getElementById('nivel3').value;
	//var sol_uid = document.getElementById('sol_uid').value;
	if (other_category==""||nivel2=="")
		{
		$('#div_nivel3_error').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_nivel3_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		$.ajax({
				url: 'code/execute/nivel3Add.php',
				data: "ca2_uid="+nivel2+"&nivel3_desc="+other_category+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
									divx.innerHTML=datos;
            						//document.location.href='incotermList.php?token='+token+"&sub_uid="+sub_uid;
        						 }	
	 });
	}
}
function deleteOtherTransporte()
	{
	token = $.getUrlVar('token');
	var sub_uid = document.getElementById('sub_uid').value;
	var inc_tra_uid = document.getElementById('inc_tra_uid').value;
	if (inc_tra_uid!="")
		{
		divx = document.getElementById('div_inc_tra_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		$.ajax({
				url: 'code/execute/delCatTransporte.php',
				data: 'tra_uid='+inc_tra_uid+'&token='+token,
			 	error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
				success: function(datos){
									divx.innerHTML=datos;
            						//document.location.href='incotermList.php?token='+token+"&sub_uid="+sub_uid;
        						 }	
	 });
	}	
}

function deleteNivel1()
	{
            
	token = $.getUrlVar('token');
	var nivel1_uid = document.getElementById('nivel1_uid').value;
        //alert(nivel1_uid);
	if (nivel1_uid!="")
		{
		divx = document.getElementById('div_nivel1_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		$.ajax({
				url: 'code/execute/delNivel1.php',
				data: 'ca1_uid='+nivel1_uid+'&token='+token,
			 	error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
				success: function(datos){
									divx.innerHTML=datos;
            						//document.location.href='incotermList.php?token='+token+"&sub_uid="+sub_uid;
        						 }	
	 });
	}	
}
function deleteNivel2()
	{
	token = $.getUrlVar('token');
	var sol_ca2_uid = document.getElementById('nivel2_uid').value;
	var sol_ca1_uid = document.getElementById('nivel1_uid').value;
	if (sol_ca2_uid!="")
		{
		divx = document.getElementById('div_nivel2_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		$.ajax({
				url: 'code/execute/delNivel2.php',
				data: 'ca1_uid='+sol_ca1_uid+'&ca2_uid='+sol_ca2_uid+'&token='+token,
			 	error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
				success: function(datos){
									divx.innerHTML=datos;
            						//document.location.href='incotermList.php?token='+token+"&sub_uid="+sub_uid;
        						 }	
	 });
	}	
}
function deleteNivel3()
	{
	token = $.getUrlVar('token');
	var sol_ca2_uid = document.getElementById('nivel2_uid').value;
	var sol_ca3_uid = document.getElementById('nivel3_uid').value;
	if (sol_ca3_uid!="")
		{
		divx = document.getElementById('div_nivel3_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		$.ajax({
				url: 'code/execute/delNivel3.php',
				data: 'ca2_uid='+sol_ca2_uid+'&ca3_uid='+sol_ca3_uid+'&token='+token,
			 	error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
				success: function(datos){
									divx.innerHTML=datos;
            						//document.location.href='incotermList.php?token='+token+"&sub_uid="+sub_uid;
        						 }	
	 });
	}	
}
function changeOtherIncoterm()
{
	$('#div_other_incoterm').toggle();
	$('#div_other_incoterm_error').hide();
}
function incotermAdd()
	{
	token = $.getUrlVar('token');
	document.getElementById('div_other_incoterm_error').style.display='none';
	var other_category = document.getElementById('other_incoterm').value;
	var sub_uid = document.getElementById('sub_uid').value;
	if (other_category=="")
		{
		$('#div_other_incoterm_error').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_inc_inl_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		
		
		$.ajax({
				url: 'code/execute/incotermLanguageAdd.php',
				data: "inl_name="+other_category+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
            						divx.innerHTML=datos;
									//document.location.href='incotermList.php?token='+token+"&sub_uid="+sub_uid;
        						 }	
	 });
	}
}

function deleteOtherIncoterm()
	{
	token = $.getUrlVar('token');
	var inc_inl_uid = document.getElementById('inc_inl_uid').value;
	var sub_uid = document.getElementById('sub_uid').value;
	if (inc_inl_uid!="")
		{
		divx = document.getElementById('div_inc_inl_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		$.ajax({
				url: 'code/execute/delCatIncoterm.php',
				data: "inl_uid="+inc_inl_uid+"&token="+token,
			 	error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
				success: function(datos){
            						divx.innerHTML=datos;
									//document.location.href='incotermList.php?token='+token+"&sub_uid="+sub_uid;
        						 }	
	 });
	}
}	
	
// PUBLICACIONES
function boletinesCS(uid,status)
	{
    token = $.getUrlVar('token');	 
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/boletinesCS.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status+"&token="+token)
	}

// CONTENIDO MULTIMEDIA
function verifyCatMult()
	{
	sw=true;	
	document.getElementById('div_muc_category').style.display='none';
	if (document.getElementById('muc_category').value=='')
		{
		document.getElementById('muc_category').className='inputError';
		document.getElementById('div_muc_category').style.display='';
		sw=false;
		}	
	if (sw) 
		{
		document.frmMultCat.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
function verifyMult()
	{
	sw=true;
	
	document.getElementById('div_mul_title').style.display='none';
	document.getElementById('div_mul_muc_uid').style.display='none';
	if (document.getElementById('mul_title').value=='')
		{
		document.getElementById('mul_title').className='inputError';
		document.getElementById('div_mul_title').style.display='';
		sw=false;
		}
	if (document.getElementById('mul_muc_uid').selectedIndex==0)
		{		
		document.getElementById('mul_muc_uid').className='inputError';
		document.getElementById('div_mul_muc_uid').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmMult.submit();
		}
	else
		{
		scroll(0,0);
		}
	}

function changeCategoryMult()
	{
	if (document.getElementById('mul_muc_uid').selectedIndex==5)
		document.getElementById("div_thematic").style.display='';
	else
		document.getElementById("div_thematic").style.display='none';
	}
	
	
function multCS(uid,status)
	{
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/multCS.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status)
	}
function imageCS(uid,status)
	{
    token = $.getUrlVar('token');	
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/imageCS.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status+"&token="+token)
	}
function multCSC(uid,status)
	{
	divx = document.getElementById('status_c_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/multCSC.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status)
	}


// EVENTOS
function verifyEvents()
	{
	sw=true;
	document.getElementById('div_evl_title').style.display='none';
	if (document.getElementById('evl_title').value=='')
		{
		document.getElementById('evl_title').className='inputError';
		document.getElementById('div_evl_title').style.display='';
		sw=false;
		}

	if (sw) 
		{
		document.frmEvents.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
function verifyCatEvents()
	{
	sw=true;
	document.getElementById('div_evc_category').style.display='none';
	if (document.getElementById('evc_category').value=='')
		{
		document.getElementById('evc_category').className='inputError';
		document.getElementById('div_evc_category').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmEventsCat.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
function eventsCS(uid,status)
	{
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/eventsCS.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status)
	}
function eventsCSC(uid,status)
	{
	divx = document.getElementById('status_c_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/eventsCSC.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status)
	}
// Adicionando categorias a eventos
function cagetogyEventsAdd()
	{
	document.getElementById('div_other_category_error').style.display='none';
	var other_category = document.getElementById('other_category').value;
	if (other_category=="")
		{
		$('#div_other_category_error').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_eve_evc_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		//instanciamos el objetoAjax
		ajax=objectAjax();
		//uso del medotod POST
		ajax.open("POST", "code/execute/eventsCatAdd2.php",true);
		ajax.onreadystatechange=function() {
					if (ajax.readyState==4) 
						{
						//mostrar resultados en esta capa
						divx.innerHTML=ajax.responseText;
						document.getElementById('div_other_category_error').style.display='none';
						document.getElementById('div_other_category').style.display='none';
						document.getElementById('div_eve_evc_uid').style.display='none';						
						document.getElementById('other_category').className='input3';							
						}
					}  
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores
		ajax.send("evc_category="+other_category)	
		}
	}
/*
function addImageEvents()
	{
	document.getElementById('DIV_IMAGES').style.display='none';
	document.getElementById('DIV_IMAGES_WAIT').style.display='';
	document.frmEvents.action='code/execute/eventsImageAdd.php';
	var t = setTimeout("document.frmEvents.submit()","3000");
	}
*/
 // VALIDADOR PARA EL FORMULARIO DE CONTACTENOS
function verifyQueryContact()
	{
	var sw=true;
	document.getElementById('div_name').style.display='none';
	document.getElementById('div_email').style.display='none';
	document.getElementById('div_code').style.display='none';
	document.getElementById('div_query').style.display='none';
	
	document.getElementById('div_error_captcha').style.display='none';
	
	
	if (document.getElementById('name').value=="")
		{
		document.getElementById('div_name').style.display='';
		sw=false;
		}
	if (document.getElementById('email').value=="")
		{
		document.getElementById('div_email').style.display='';
		sw=false;
		}
	if (document.getElementById('code').value=="")
		{
		document.getElementById('div_code').style.display='';
		sw=false;
		}	
	if (document.getElementById('query').value=="")
		{
		document.getElementById('div_query').style.display='';
		sw=false;
		}	
	if (sw) document.frmQuery.submit();	
	}  

// VALIDACION PARA LAS OPINIONES DE PUBLICACIONES
function validateBulletinSuscribe()
	{

	var sw=true;
	var sus_nombre = document.getElementById('sus_name').value;
	var sus_email = document.getElementById('sus_email').value;
	document.getElementById('div_sus_name').innerHTML="";
	document.getElementById('div_sus_email').innerHTML="";

	if (document.getElementById('sus_name').value=="")
		{
		document.getElementById('div_sus_name').innerHTML="Requerido";
		sw=false;
		}
	if (document.getElementById('sus_email').value=="")
		{
		document.getElementById('div_sus_email').innerHTML="Requerido";
		sw=false;
		}		
	
	if (sw)
		{
		divx = document.getElementById('suscriber_bulletin');
		divwait = document.getElementById('wait_bulletin');
		divx.innerHTML = divwait.innerHTML;
		//instanciamos el objetoAjax
		ajax=objectAjax();
		//uso del medotod POST
		ajax.open("POST", "skin/bulletinUserAdd.php",true);
		ajax.onreadystatechange=function() {
				  if (ajax.readyState==4) 
					{
					//mostrar resultados en esta capa
					divx.innerHTML=ajax.responseText;
					}
			}  
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores
		ajax.send("sus_name="+sus_nombre+"&sus_email="+sus_email)
		}
	}
function commentEdit(id,status)
	{
	if (status==1)
		{
		document.getElementById('div_comment_edit_' + id).style.display="";
		document.getElementById('div_comment_view_' + id).style.display="none";
		}
	else
		{
		document.getElementById('div_comment_edit_' + id).style.display="none";
		document.getElementById('div_comment_view_' + id).style.display="";
		}
	}

/*implementación del tercer nível*/
function subList(e)
    {
	  token = $.getUrlVar('token');	
      divx = document.getElementById('div_con_parent2');
      divx.innerHTML = '';
      ajax=objectAjax();
      ajax.open("POST", "code/execute/subListDys.php",true);
      ajax.onreadystatechange=function() {
                                          if (ajax.readyState==4) 
                                            {
                                            divx.style.display='';
                                            divx.innerHTML=ajax.responseText;
                                            }
                                          }  
      ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      ajax.send("con_uid="+e.value+"&token="+token);
    }  

function moreMinusSubList(ID)
    {
    if (document.getElementById('div_more_'+ID).style.display=='')
        {
        document.getElementById('div_minus_'+ID).style.display='';
        document.getElementById('div_more_'+ID).style.display='none';
        $('#treeList_'+ID).fadeIn(500);
        }
    else
        {
        document.getElementById('div_more_'+ID).style.display='';
        document.getElementById('div_minus_'+ID).style.display='none';
        $('#treeList_'+ID).fadeOut(500);
        }
    }


// Capacitación 
function verifyCapa()
	{
	sw=true;
	
	document.getElementById('div_cap_title').style.display='none';
	document.getElementById('div_cap_cac_uid').style.display='none';
	
	document.getElementById('div_other_category_error').style.display='none';
	
	if (document.getElementById('cap_title').value=='')
		{
		document.getElementById('cap_title').className='inputError';
		document.getElementById('div_cap_title').style.display='';
		sw=false;
		}
	
	var category = document.getElementById('cap_cac_uid');
	if (category.selectedIndex==0)
		{		
		document.getElementById('cap_cac_uid').className='listMenuError';
		document.getElementById('div_cap_cac_uid').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmCapa.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
function verifyCatCapa()
	{
	sw=true;
	document.getElementById('div_cac_category').style.display='none';
	if (document.getElementById('cac_category').value=='')
		{
		document.getElementById('cac_category').className='inputError';
		document.getElementById('div_cac_category').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmCapaCat.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
function capaCSC(uid,status)
	{
	divx = document.getElementById('status_c_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/capaCSC.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status)
	}
function capaCS(uid,status)
  {
  divx = document.getElementById('status_' + uid);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  //instanciamos el objetoAjax
  ajax=objectAjax();
  //uso del medotod POST
  ajax.open("POST", "code/execute/capaCS.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("uid="+uid+"&status="+status)
  }
function userCS(uid,status)
  {
  token = $.getUrlVar('token');	 	  
  divx = document.getElementById('status_' + uid);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  //instanciamos el objetoAjax
  ajax=objectAjax();
  //uso del medotod POST
  ajax.open("POST", "code/execute/userCS.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("uid="+uid+"&status="+status+"&token="+token)
  }
  
  function autorizacionCS(uid,status)
  {
  token = $.getUrlVar('token');	 	  
  divx = document.getElementById('status_' + uid);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  //instanciamos el objetoAjax
  ajax=objectAjax();
  //uso del medotod POST
  ajax.open("POST", "code/execute/autorizacionCS.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("uid="+uid+"&status="+status+"&token="+token)
  }
  
function ravCS(uid,status)
  {
  token = $.getUrlVar('token');	 	  
  divx = document.getElementById('status_' + uid);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  //instanciamos el objetoAjax
  ajax=objectAjax();
  //uso del medotod POST
  ajax.open("POST", "code/execute/ravCS.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("uid="+uid+"&status="+status+"&token="+token)
  }
function clientCS(uid,status)
  {
  token = $.getUrlVar('token');	 	  
  divx = document.getElementById('status_' + uid);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  //instanciamos el objetoAjax
  ajax=objectAjax();
  //uso del medotod POST
  ajax.open("POST", "code/execute/clientCS.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("uid="+uid+"&status="+status+"&token="+token)
  }
function cagetogyCapaAdd()
	{
	document.getElementById('div_other_category_error').style.display='none';
	var other_category = document.getElementById('other_category').value;
	if (other_category=="")
		{
		$('#div_other_category_error').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_cap_cac_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		//instanciamos el objetoAjax
		ajax=objectAjax();
		//uso del medotod POST
		ajax.open("POST", "code/execute/capaCatAdd2.php",true);
		ajax.onreadystatechange=function() {
					if (ajax.readyState==4) 
						{
						//mostrar resultados en esta capa
						divx.innerHTML=ajax.responseText;
						document.getElementById('div_other_category_error').style.display='none';
						document.getElementById('div_other_category').style.display='none';
						document.getElementById('div_cap_cac_uid').style.display='none';						
						document.getElementById('other_category').className='input3';							
						}
					}  
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores
		ajax.send("other_category="+other_category)	
		}
	}

// Articulos
function cagetogyArtiAdd()
	{
	document.getElementById('div_other_category_error').style.display='none';
	var other_category = document.getElementById('other_category').value;
	if (other_category=="")
		{
		$('#div_other_category_error').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_art_arc_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		//instanciamos el objetoAjax
		ajax=objectAjax();
		//uso del medotod POST
		ajax.open("POST", "code/execute/artiCatAdd2.php",true);
		ajax.onreadystatechange=function() {
					if (ajax.readyState==4) 
						{
						//mostrar resultados en esta capa
						divx.innerHTML=ajax.responseText;
						document.getElementById('div_other_category_error').style.display='none';
						document.getElementById('div_other_category').style.display='none';
						document.getElementById('div_art_arc_uid').style.display='none';						
						document.getElementById('other_category').className='input3';							
						}
					}  
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores
		ajax.send("other_category="+other_category)	
		}
	}
function verifyArti()
	{
	sw=true;
	document.getElementById('div_art_title').style.display='none';
	document.getElementById('div_art_arc_uid').style.display='none';
	document.getElementById('div_other_category_error').style.display='none';
	if (document.getElementById('art_title').value=='')
		{
		document.getElementById('art_title').className='inputError';
		document.getElementById('div_art_title').style.display='';
		sw=false;
		}
	
	var category = document.getElementById('art_arc_uid');
	if (category.selectedIndex==0)
		{		
		document.getElementById('art_arc_uid').className='listMenuError';
		document.getElementById('div_art_arc_uid').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmArti.submit();
		}
	else
		{
		scroll(0,0);
		}
	}

function artiCSC(uid,status)
	{
	divx = document.getElementById('status_c_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/artiCSC.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status)
	}
function artiCS(uid,status)
  {
  divx = document.getElementById('status_' + uid);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  //instanciamos el objetoAjax
  ajax=objectAjax();
  //uso del medotod POST
  ajax.open("POST", "code/execute/artiCS.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("uid="+uid+"&status="+status)
  }
function filter_search(value,page)
	{ 
	document.location.href=page+'?keyword='+value;			
	}

function filter_list_category(page,category)
	{
	document.location.href=page+"?cat_uid=" + category;
	}
function verifyTheme()
	{
	sw=true;
	
	document.getElementById('div_the_title').style.display='none';
	document.getElementById('div_the_thc_uid').style.display='none';
	
	document.getElementById('div_other_category_error').style.display='none';
	
	if (document.getElementById('the_title').value=='')
		{
		document.getElementById('the_title').className='inputError';
		document.getElementById('div_the_title').style.display='';
		sw=false;
		}
	
	if (sw) 
		{
		document.frmTheme.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
function themeCS(uid,status)
	{
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/themeCS.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status)
	}
function verifyCommunique()
	{
	sw=true;
	document.getElementById('div_com_title').style.display='none';
	
	if (document.getElementById('com_title').value=='')
		{
		document.getElementById('com_title').className='inputError';
		document.getElementById('div_com_title').style.display='';
		sw=false;
		}
	// **********************************************************
	if (sw) 
		{
		document.frmCommunique.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
	

function communCS(uid,status)
	{
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/communCS.php",true);
	ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
										}
									}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("uid="+uid+"&status="+status)
	}
	
	
// Entrevistas
function verifyInter()
	{
	sw=true;
	
	document.getElementById('div_int_title').style.display='none';
	document.getElementById('div_int_inc_uid').style.display='none';
	document.getElementById('div_other_category_error').style.display='none';	
	if (document.getElementById('int_title').value=='')
		{
		document.getElementById('int_title').className='inputError';
		document.getElementById('div_int_title').style.display='';
		sw=false;
		}	
	var category = document.getElementById('int_inc_uid');
	if (category.selectedIndex==0)
		{		
		document.getElementById('int_inc_uid').className='listMenuError';
		document.getElementById('div_int_inc_uid').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmInter.submit();
		}
	else
		{
		scroll(0,0);
		}
	}

function rolesCS(uid,status)
  {
  token = $.getUrlVar('token');
  divx = document.getElementById('status_' + uid);
  divx.innerHTML = '<img border="0" src="lib/loading.gif">';
  //instanciamos el objetoAjax
  ajax=objectAjax();
  //uso del medotod POST
  ajax.open("POST", "code/execute/rolesCS.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										//mostrar resultados en esta capa
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("uid="+uid+"&status="+status+"&token="+token)
  }
function categoryLabelsAdd(){
	label_table = $("#label_table").val();
	$("#category").load('code/execute/labelsCategoryAdd2.php?action=addCat&label_table='+label_table);
	}	
function categoryLabelsCancel(){
	label_table = $("#label_table").val();
	$("#category").load('code/execute/labelsCategoryAdd2.php?action=listCat&label_table='+label_table);
	}	
//////*********************************************funciones para simple nuevo****************************************//
function delNode(node){
	$("#"+node).remove();
	return;
	}
function addMoreCla()
{
	maxValue=document.getElementById('maxVal').value;
	maxValue= parseInt(maxValue)+1;
	var index = maxValue;
	var dname = $("#dname").html();
	var adname = $("#adname").html();

var $obj = '<div class="row2" id="'+maxValue+'"><table width="98%" border="0" cellpadding="5" cellspacing="5" class="box"><tr><td width="29%" valign="top">Clasificacion:</td><td width="64%"><div id="autocomplete'+maxValue+'" style="display:none"></div><input name="position[]" type="hidden" value="'+maxValue+'"/><input name="cla_nam_'+maxValue+'" type="text" class="input" id="cla_nam_'+maxValue+'" size="74" onkeyup="lookup(this.value,'+maxValue+');"/><span id="div_cla_'+maxValue+'" style="display:none;" class="error"></span></td><td width="7%" valign="top"><a href="javascript:delNode('+maxValue+');">X</a></td><tr><td valign="top">Descripción: </td><td><textarea name="cla_cla_'+maxValue+'" cols="55" rows="6" class="textarea" id="cla_cla_'+maxValue+'" onkeydown="growTextarea(this);"></textarea></td><td width="7%" valign="top"></td></tr></table></div>';

	$("#child").append($obj);
	document.getElementById('maxVal').value=maxValue;
}

function addMoreCla2()
{
	maxValue=document.getElementById('maxVal').value;
	maxValue= parseInt(maxValue)+1;
	var index = maxValue;
	var dname = $("#dname").html();
	var adname = $("#adname").html();

var $obj ='<div class="row0" id="'+maxValue+'"><table width="98%" border="0" cellpadding="5" cellspacing="5" class="box"><tr><td width="29%" id="dname">Nombre del documento: </td><td><input type="text" name="text_adjunt_'+maxValue+'" id="text_adjunt_'+maxValue+'" size="50" class="input" /><td width="7%" valign="top"><a href="javascript:delNode('+maxValue+');">X</a></td><br /><span id="div_text_adjunt_'+maxValue+'" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels("contents","titleerror");?></span></td></tr><tr><td width="29%" id="adname">Documento adjunto: </td><td  width="64%"><input type="file" name="new_adjunt_'+maxValue+'" id="new_adjunt_'+maxValue+'" size="31" class="input"><td></td><br /><span id="div_new_adjunt_'+maxValue+'" style="display:none; padding-left:5px; padding-right:5px;" class="error"><?=admin::labels("contents","titleerror");?></span></td></tr></table></div>';

	$("#child").append($obj);
	document.getElementById('maxVal').value=maxValue;
}

function addMoreTab()
{
	maxValue=document.getElementById('maxVal').value;
	xVal=document.getElementById('yVal').value;
	yVal=document.getElementById('xVal').value;
	maxValue= parseInt(maxValue)+1;
	if (xVal>=1 && yVal>=1)
	{
    var obj ='<div id="'+maxValue+'"><div id="pos_a'+maxValue+'" class="row2"><input name="position[]" type="hidden" value="'+maxValue+'"/><table width="98%" border="0" cellpadding="5" cellspacing="5" class="box"><tr><td width="29%" valign="top">Clasificacion:</td><td width="64%"></div><input name="cla_nam_'+maxValue+'" type="text" class="input" id="cla_nam_'+maxValue+'" size="74" onkeyup="lookup(this.value,'+maxValue+');"/><div id="autocomplete'+maxValue+'" style="display:none"><span id="div_cla_'+maxValue+'" style="display:none;" class="error"></span></td></tr><tr><td width="29%" valign="top">Tabla:</td><td width="64%"><input name="Xmax'+maxValue+'" type="hidden" value="'+xVal+'"/><input name="Ymax'+maxValue+'" type="hidden" value="'+yVal+'"/>';
	for (i=1; i<=yVal; i++) {
        for (j=1; j<=xVal; j++) {
			obj=obj+'<input name="T'+maxValue+'Y'+i+'X'+j+'" type="text" class="input" id="T'+maxValue+'Y'+i+'X'+j+'" size="7"/>'
		}
		obj=obj+'<br />'
    }
	var obj =obj+'</td><td width="7%" valign="top"><a href="javascript:delNode('+maxValue+');">X</a></td></tr></table></div></div>';
	}
	
	
	$("#child").append(obj);
	document.getElementById('maxVal').value=maxValue;
	document.getElementById('yVal').value='';
	document.getElementById('xVal').value='';
	$('#addTable').hide();
}
function showTab(e)
{
		$('#'+e).toggle();
	return false;
}

function verifyCatDocs()
	{
	sw=true;
	document.getElementById('div_dca_category').style.display='none';
	if (document.getElementById('dca_category').value=='')
		{
		document.getElementById('dca_category').className='inputError';
		document.getElementById('div_dca_category').style.display='';
		sw=false;
		}
	if (sw) 
		{
		document.frmDocsCat.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
	
function verifyIncoterm()
	{
	sw=true;
	sw0=true;
	if (document.getElementById('inc_ajuste').value=='')
		{
		document.getElementById('div_inc_ajuste_error').className='inputError';
		document.getElementById('div_inc_ajuste_error').style.display='';
		sw0=false;
		}
	if (sw && sw0) 
		{
		document.frmIncoterm.submit();
		}
	else
		{
		scroll(0,0);
		}
	}

function verifySolicitud()
	{
	sw=true;
	if (document.getElementById('nivel1_uid').value=='')
		{
		//document.getElementById('div_nivel1_error').className='inputError';
		document.getElementById('div_nivel1_error').style.display='';
		sw=false;
		}
	if (document.getElementById('nivel2_uid').value=='')
		{
		//document.getElementById('div_nivel2_error').className='inputError';
		document.getElementById('div_nivel2_error').style.display='';
		sw=false;
		}
        if (document.getElementById('nivel3_uid').value=='')
		{
		//document.getElementById('div_nivel3_error').className='inputError';
		document.getElementById('div_nivel3_error').style.display='';
		sw=false;
		}                
        if (document.getElementById('sol_description').value=='')
		{
		//document.getElementById('div_sol_description_error').className='inputError';
		document.getElementById('div_sol_description_error').style.display='';
		sw=false;
		}                  
        if (document.getElementById('sol_cantidad').value=='')
		{
		//document.getElementById('div_sol_cantidad_error').className='inputError';
		document.getElementById('div_sol_cantidad_error').style.display='';
		sw=false;
		}  
        if (document.getElementById('sol_unidad').value=='')
		{
		//document.getElementById('div_sol_unidad_error').className='inputError';
		document.getElementById('div_sol_unidad_error').style.display='';
		sw=false;
		}                  
        if (sw) 
		{
		document.frmSolicitud.submit();
		}
	else
		{
		scroll(0,0);
		}
	}
function chageUploadFile(status,val){
	if(val!=undefined){
		if (status=='on'){
			$('#div_adjunt_file_change_'+val).fadeIn();					
		}
		else{
			$('#div_adjunt_file_change_'+val).fadeOut();							
		}
	}
	else{
		if (status=='on'){
			$('#div_adjunt_file_change').fadeIn();					
		}
		else{
			$('#div_adjunt_file_change').fadeOut();							
		}
		
	}
}
function subListC1(e)
    {
      divx = document.getElementById('div_con_parent2');
      divx.innerHTML = '';
      ajax=objectAjax();
      ajax.open("POST", "code/execute/subListC1.php",true);
      ajax.onreadystatechange=function() {
                                          if (ajax.readyState==4) 
                                            {
                                            divx.style.display='';
                                            divx.innerHTML=ajax.responseText;
                                            }
                                          }  
      ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      ajax.send("lin_uid="+e.value);
    }  
function subListC2(e)
    {
      divx = document.getElementById('div_con_parent3');
      divx.innerHTML = '';
      ajax=objectAjax();
      ajax.open("POST", "code/execute/subListC2.php",true);
      ajax.onreadystatechange=function() {
                                          if (ajax.readyState==4) 
                                            {
                                            divx.style.display='';
                                            divx.innerHTML=ajax.responseText;
                                            }
                                          }  
      ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      ajax.send("lin_family="+e.value);
    }

function lookup(e)
{	
	id = document.getElementById('sub_uid');
	divx = document.getElementById('autocomplete');
	divx.innerHTML = '';
	divx.style.display='';
	ajax=objectAjax();
	ajax.open("POST", "code/execute/ListAutocomplete.php",true);
    ajax.onreadystatechange=function() { 
                                          if (ajax.readyState==4) 
                                            {
                                            divx.style.display='';
                                            divx.innerHTML=ajax.responseText;
                                            }
                                        }  
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("searchA="+e+"&sub_uid="+id.value);
}

function fill(e,f)
{	
	$('#autocomplete').hide();
	document.getElementById('cli_name').value=e;
	document.getElementById('cli_uid').value=f;
}

function ComboBanner(uid)
  {
  divx = document.getElementById('checkBoxes');
  ajax=objectAjax();
  ajax.open("POST", "code/template/bannerOption.php",true);
  ajax.onreadystatechange=function() {
									  if (ajax.readyState==4) 
										{
										divx.innerHTML=ajax.responseText;
									  	}
  									}  
  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  ajax.send("mbc_place="+uid.value)
  }
function addCurrency(){
	if($("#div_add_currency").css('display')=='none')
	$("#div_add_currency").show();
	else
	$("#div_add_currency").hide();
	
	} 
function addUnidad(){
	if($("#div_add_unidad").css('display')=='none')
	$("#div_add_unidad").show();
	else
	$("#div_add_unidad").hide();
	
	} 
function addNivel1(){
	if($("#div_nivel1").css('display')=='none')
	$("#div_nivel1").show();
	else
	$("#div_nivel1").hide();
	
	} 
function addNivel2(){
    var nivel1 = document.getElementById('nivel1_uid').value;
    if(nivel1=='')
            document.getElementById('div_nivel1_error').style.display='';
    else{
    if($("#div_nivel2").css('display')=='none')
	$("#div_nivel2").show();
	else
	$("#div_nivel2").hide();
        }
}
function addNivel3(){
    var nivel2 = document.getElementById('nivel2_uid').value;
    if(nivel2=='')
            document.getElementById('div_nivel2_error').style.display='';
    else{
    if($("#div_nivel3").css('display')=='none')
	$("#div_nivel3").show();
	else
	$("#div_nivel3").hide();
        }
}
function actualizaNiveles(){
    var token = $.getUrlVar('token');
    var nivel1 = document.getElementById('nivel1_uid').value;
    if(nivel1!='')  {
        document.getElementById('div_nivel1_error').style.display='none';   
    $("#div_nivel2_select").html('<img border="0" src="'+SERVER+'/admin/lib/loading.gif">');
    $.ajax({
		   type: "POST",
		   url: "code/execute/nivel2Add.php",
		   data: "ca1_uid="+nivel1+"&token="+token,
		   success: function(msg){
			 $("#div_nivel2_select").html(msg);
		   }
		 });
             }
}
function actualizaNiveles2(){
    var token = $.getUrlVar('token');
    var nivel2 = document.getElementById('nivel2_uid').value;
    if(nivel2!='')  {document.getElementById('div_nivel2_error').style.display='none';   
    $("#div_nivel3_select").html('<img border="0" src="'+SERVER+'/admin/lib/loading.gif">');
    $.ajax({
		   type: "POST",
		   url: "code/execute/nivel3Add.php",
		   data: "ca2_uid="+nivel2+"&token="+token,
		   success: function(msg){
			 $("#div_nivel3_select").html(msg);
		   }
		 });
             }
}
        
function addCurrency1(){
	if($("#div_add_currency1").css('display')=='none')
	$("#div_add_currency1").show();
	else
	$("#div_add_currency1").hide();
	} 
function closeCurrency()
{
	$("#div_add_currency").hide();
}
function closeUnidad()
{
	$("#div_add_unidad").hide();
}
function closeCurrency1()
{
	$("#div_add_currency1").hide();
}
function addCurrencyOption()
{
	var token = $.getUrlVar('token');
	$("#div_add_currency_error").hide();
	var addCurrencyVal = $("#add_currency").val();	

	if(addCurrencyVal!="")
	{
	$("#div_sub_moneda").html('<img border="0" src="'+SERVER+'/admin/lib/loading.gif">');
		$.ajax({
		   type: "POST",
		   url: "code/execute/addCurrency.php",
		   data: "currency="+addCurrencyVal+"&token="+token,
		   success: function(msg){
			 $("#div_sub_moneda").html(msg);
			 $("#div_add_currency").hide();			 
		   }
		 });	
	}
	else $("#div_add_currency_error").show();
	
}
function addUnidadOption()
{
	var token = $.getUrlVar('token');
	$("#div_add_unidad_error").hide();
	var addCurrencyVal = $("#add_unidad").val();	

	if(addCurrencyVal!="")
	{
	$("#div_sub_unidad").html('<img border="0" src="'+SERVER+'/admin/lib/loading.gif">');
		$.ajax({
		   type: "POST",
		   url: "code/execute/addUnidad.php",
		   data: "unidad="+addCurrencyVal+"&token="+token,
		   success: function(msg){
			 $("#div_sub_unidad").html(msg);
                         $("#add_unidad").val('');
			 $("#div_add_unidad").hide();			 
		   }
		 });	
	}
	else $("#div_add_unidad_error").show();
	
}
function addCurrencyOption1()
{
	var token = $.getUrlVar('token');
	$("#div_add_currency_error1").hide();
	var addCurrencyVal = $("#add_currency1").val();	

	if(addCurrencyVal!="")
	{
	$("#div_sub_moneda1").html('<img border="0" src="'+SERVER+'/admin/lib/loading.gif">');
		$.ajax({
		   type: "POST",
		   url: "code/execute/addCurrency1.php",
		   data: "currency="+addCurrencyVal+"&token="+token,
		   success: function(msg){
			 $("#div_sub_moneda1").html(msg);
			 $("#div_add_currency1").hide();			 
		   }
		 });	
	}
	else $("#div_add_currency_error1").show();

}

function delCurrency()
{
	var token = $.getUrlVar('token');
	$("#div_add_currency").hide();	
	$("#div_add_currency_error").hide();
	var sub_moneda = $("#sub_moneda").val();	

	if(sub_moneda!="")
	{
	$("#div_sub_moneda").html('<img border="0" src="'+SERVER+'/admin/lib/loading.gif">');
		$.ajax({
		   type: "POST",
		   url: "code/execute/delCurrency.php",
		   data: "sub_moneda="+sub_moneda+"&token="+token,
		   success: function(msg){
			 $("#div_sub_moneda").html(msg);
			 $("#div_add_currency").hide();			 
		   }
		 });	
	}
	else $("#div_add_currency_error").show();
}
function delUnidad()
{
   	var token = $.getUrlVar('token');
	$("#div_add_unidad").hide();	
	$("#div_add_unidad_error").hide();
        var collection = document.getElementsByName('rav_uni_uid[]');
       var lista='';
       j=0;
       for(i=0 ; i<collection.length;i++){
           if(collection.item(i).checked)
           {
                if(j==0) lista += collection.item(i).value;
                else lista += "," + collection.item(i).value;
                j++;
            }
        }
	if(lista!="")
	{
	$("#div_sub_unidad").html('<img border="0" src="'+SERVER+'/admin/lib/loading.gif">');
		$.ajax({
		   type: "POST",
		   url: "code/execute/delUnidad.php",
		   data: "lista="+lista+"&token="+token,
		   success: function(msg){
			 $("#div_sub_unidad").html(msg);
			 $("#div_add_unidad").hide();			 
		   }
		 });	
	}
	else $("#div_add_unidad_error").show();
}
function delCurrency1()
{
	var token = $.getUrlVar('token');
	$("#div_add_currency1").hide();	
	$("#div_add_currency_error1").hide();
	var sub_moneda = $("#sub_moneda1").val();	

	if(sub_moneda!="")
	{
	$("#div_sub_moneda1").html('<img border="0" src="'+SERVER+'/admin/lib/loading.gif">');
		$.ajax({
		   type: "POST",
		   url: "code/execute/delCurrency1.php",
		   data: "sub_moneda="+sub_moneda+"&token="+token,
		   success: function(msg){
			 $("#div_sub_moneda1").html(msg);
			 $("#div_add_currency1").hide();			 
		   }
		 });	
	}
	else $("#div_add_currency_error1").show();
}

function verifyadjudicar()
	{
	sw=true;
        document.getElementById('div_elaborado').style.display='none';
        document.getElementById('div_aprobado').style.display='none';
        document.getElementById('div_ahorro').style.display='none';
        document.getElementById('div_observaciones').style.display='none';
        
	if (document.getElementById('elaborado').value=='')
		{
		document.getElementById('elborado').className='inputError';
		document.getElementById('div_elaborado').style.display='';
		sw=false;
		}
	if (document.getElementById('aprobado').value=='')
		{
		document.getElementById('aprobado').className='inputError';
		document.getElementById('div_aprobado').style.display='';
		sw=false;
		}
        if (document.getElementById('observaciones').value=='')
		{
		document.getElementById('observaciones').className='inputError';
		document.getElementById('div_observaciones').style.display='';
		sw=false;
		}        
        if (document.getElementById('ahorro').value=='')
		{
		document.getElementById('ahorro').className='inputError';
		document.getElementById('div_ahorro').style.display='';
		sw=false;
		}                        
	if (sw) 
		{
		document.frmsubasta.submit();
		}
	}

// Client category
function changeClientCategory()
{
	$('#div_client_category').toggle();
	$('#div_cli_lec_uid').hide();
}
function cagetogyClientAdd()
	{
	token = $.getUrlVar('token');
	document.getElementById('div_cli_lec_uid').style.display='none';
	var client_category = document.getElementById('client_category').value;
	if (client_category=="")
		{
		$('#div_cli_lec_uid').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_cli_lec_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		//instanciamos el objetoAjax
				$.ajax({
				url: 'code/execute/clientCatAdd2.php',
				data: "lec_uid="+client_category+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
									divx.innerHTML=datos;
        						 }	
				});
		}
	}

function deleteClientCategory()
	{
	token = $.getUrlVar('token');
	var sub_lec_uid = document.getElementById('cli_lec_uid').value;
	if (sub_lec_uid!="")
		{
		divx = document.getElementById('div_cli_lec_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		
			$.ajax({
				url: 'code/execute/delCatClient.php',
				data: "lec_uid="+sub_lec_uid+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
									divx.innerHTML=datos;
        						 }	
				});
		
			}
	}

// Client type
function changeClientType()
{
	$('#div_client_type').toggle();
	$('#div_cli_pts_uid').hide();
}
function typeClientAdd()
	{
	token = $.getUrlVar('token');
	document.getElementById('div_cli_pts_uid').style.display='none';
	var client_type = document.getElementById('client_type').value;
	if (client_type=="")
		{
		$('#div_cli_pts_uid').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_cli_pts_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		//instanciamos el objetoAjax
				$.ajax({
				url: 'code/execute/clientTypeAdd2.php',
				data: "pts_uid="+client_type+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
									divx.innerHTML=datos;
        						 }	
				});
		}
	}

function deleteClientType()
	{
	token = $.getUrlVar('token');
	var sub_pts_uid = document.getElementById('cli_pts_uid').value;
	if (sub_pts_uid!="")
		{
		divx = document.getElementById('div_cli_pts_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		
			$.ajax({
				url: 'code/execute/delTypeClient.php',
				data: "pts_uid="+sub_pts_uid+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
									divx.innerHTML=datos;
        						 }	
				});
		
			}
	}
	
// Client coverage
function changeClientCoverage()
{
	$('#div_client_coverage').toggle();
	$('#div_cli_cov_uid').hide();
}
function coverageClientAdd()
	{
	token = $.getUrlVar('token');
	document.getElementById('div_cli_cov_uid').style.display='none';
	var client_coverage = document.getElementById('client_coverage').value;
	if (client_coverage=="")
		{
		$('#div_cli_cov_uid').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_cli_cov_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		//instanciamos el objetoAjax
				$.ajax({
				url: 'code/execute/clientCovAdd2.php',
				data: "cov_uid="+client_coverage+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
									divx.innerHTML=datos;
        						 }	
				});
		}
	}

function deleteClientCoverage()
	{
	token = $.getUrlVar('token');
	var sub_cov_uid = document.getElementById('cli_cov_uid').value;
	if (sub_cov_uid!="")
		{
		divx = document.getElementById('div_cli_cov_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		
			$.ajax({
				url: 'code/execute/delCovClient.php',
				data: "cov_uid="+sub_cov_uid+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
									divx.innerHTML=datos;
        						 }	
				});
		
			}
	}


// Client item
function changeClientItem()
{
	$('#div_client_item').toggle();
	$('#div_cli_ite_uid').hide();
}
function itemClientAdd()
	{
	token = $.getUrlVar('token');
	document.getElementById('div_cli_ite_uid').style.display='none';
	var client_item = document.getElementById('client_item').value;
	var item_uid = document.getElementById('item_uid').value;
	if (client_item=="")
		{
		$('#div_cli_ite_uid').fadeIn();
		}
	else
		{
		divx = document.getElementById('div_cli_ite_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		//instanciamos el objetoAjax
				$.ajax({
				url: 'code/execute/clientIteAdd2.php',
				data: "ite_uid="+client_item+"&item_uid="+item_uid+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
									divx.innerHTML=datos;
        						 }	
				});
		}
	}

function deleteClientItem()
	{
	token = $.getUrlVar('token');
	var sub_ite_uid = document.getElementById('cli_ite_uid').value;
	var item_uid = document.getElementById('item_uid').value;
	if (sub_ite_uid!="" && item_uid!="")
		{
		divx = document.getElementById('div_cli_ite_uid_select');
		divx.innerHTML = '<img border="0" src="lib/loading.gif">';
		
			$.ajax({
				url: 'code/execute/delIteClient.php',
				data: "ite_uid="+sub_ite_uid+"&item_uid="+item_uid+"&token="+token,
			 			error: function(objeto){
            						alert("Pasó lo siguiente: "+objeto.responseText);
        						},
						success: function(datos){
									divx.innerHTML=datos;
        						 }	
				});
		
			}
	}
        
function solicitudCS(uid,status)
  {
    token = $.getUrlVar('token');	 	  
    tipUid = $.getUrlVar('tipUid');
    divx = document.getElementById('status_' + uid);
    divx.innerHTML = '<img border="0" src="lib/loading.gif">';
    //instanciamos el objetoAjax
    ajax=objectAjax();
    //uso del medotod POST
    ajax.open("POST", "code/execute/solicitudCS.php",true);
    ajax.onreadystatechange=function() {
                                                                            if (ajax.readyState==4) 
                                                                                  {
                                                                                  //mostrar resultados en esta capa
                                                                                  divx.innerHTML=ajax.responseText;
                                                                                  }
                                                                          }  
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    //enviando los valores
    ajax.send("uid="+uid+"&status="+status+"&token="+token+"&tipUid="+tipUid);
  }
function ordenCS(uid,status)
  {
    token = $.getUrlVar('token');	 	  
    tipUid = $.getUrlVar('tipUid');
    divx = document.getElementById('status_' + uid);
    divx.innerHTML = '<img border="0" src="lib/loading.gif">';
    //instanciamos el objetoAjax
    ajax=objectAjax();
    //uso del medotod POST
    ajax.open("POST", "code/execute/ordenCS.php",true);
    ajax.onreadystatechange=function() {
                                                                            if (ajax.readyState==4) 
                                                                                  {
                                                                                  //mostrar resultados en esta capa
                                                                                  divx.innerHTML=ajax.responseText;
                                                                                  }
                                                                          }  
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    //enviando los valores
    ajax.send("uid="+uid+"&status="+status+"&token="+token+"&tipUid="+tipUid);
  }     
function verifyOC()
{
    var sw=true;
    $("#div_orc_sol_uid").hide();
    $("#div_orc_nro_oc").hide();
    $("#div_orc_fecha").hide();
    $("#div_orc_hora").hide();
    $("#div_orc_aprobado").hide();
    $("#div_orc_document").hide();
    if($("#orc_sol_uid").val()=='') { sw=false; $("#div_orc_sol_uid").show();}
    if($("#orc_nro_oc").val()=='') { sw=false; $("#div_orc_nro_oc").show();}
    if($("#orc_fecha").val()=='') { sw=false; $("#div_orc_orc_fecha").show();}
    if($("#orc_hora").val()=='') { sw=false; $("#div_orc_hora").show();}
    if($("#orc_aprobado").val()=='') { sw=false; $("#div_orc_aprobado").show();}
    if($("#orc_document").val()=='') { sw=false; $("#div_orc_document").show();}
    
    if(sw) document.addOC.submit();
    else scroll(0,0);
}

function addProv()
{
    //divx = document.getElementById('addP');
    //divx.innerHTML="<div><input name=\"sol_cli_uid[]\" type=\"text\" class=\"input3 proveedor\" value=\"\" size=\"20\" /><br><br></div>";
    $("#addP").replaceWith("<div><input name=\"sol_cli_uid[]\" type=\"text\" class=\"input3 proveedor\" value=\"\" size=\"20\" /><br><br></div><div id=\"addP\"></div>");
/*    $( ".proveedor" ).autocomplete({
        source: 'code/execute/searchProv.php'
    });
    */

    $( ".proveedor" ).autocomplete({
        source: 'code/execute/searchProv.php',
        select: function(event, ui) {
        $(".proveedor").attr('name', 'sol_cli_uid['+ui.item.value+']');
        $(".proveedor").attr('id', ui.item.value);
        $(".proveedor").attr('class', 'input3');
        return false; // Prevent the widget from inserting the value.
        
    },
    focus: function(event, ui) {
        $(".proveedor").val(ui.item.label);
        return false; // Prevent the widget from inserting the value.
    }
    })
 
    
}