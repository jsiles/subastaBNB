// JavaScript Document
function show_new_circuit(status)
	{	
	if (status=='on')
	$('#new_circuit').fadeIn(500);
	else
		{
		$('#new_circuit').fadeOut(500);
		document.getElementById('cil_title').value='';
		document.getElementById('cil_code').value='';
		document.getElementById('cil_description').value='';
		}
	scroll(0,400);
	}
function verifycircuit()
	{
	// CIRCUITOS SELECCIONADOS
	var numcircuits = document.getElementById('numcircuits').value;
	var circuitSelected ="";
	for (i=1;i<=numcircuits;i++)
		{
		if (document.getElementById('circuit_'+i).checked==true)
			{
			if (circuitSelected=="")
				circuitSelected = document.getElementById('circuit_'+i).value;
			else
				circuitSelected = circuitSelected + ","+ document.getElementById('circuit_'+i).value;
			}
		}
	// FIN SELECCIONADOS
	
	var cil_title = document.getElementById('cil_title').value;	
	var cil_code = document.getElementById('cil_code').value;	
	var cil_description = document.getElementById('cil_description').value;
	/* 
	var cir_type = document.getElementById('cir_type');
	var cir_type_selected = cir_type.selectedIndex;
	var cir_type_value = cir_type[cir_type_selected].value; 
	*/
	document.getElementById('div_cil_title').style.display='none';
	document.getElementById('div_cil_description').style.display='none';
	//document.getElementById('div_cir_type').style.display='none';
	
//	var inv_uid = document.getElementById('inv_uid').value;
	
	var sw=true;
	if (cil_title=="")
		{
		$('#div_cil_title').fadeIn();
		sw=false;
		}
	if (cil_description=="")
		{
		$('#div_cil_description').fadeIn();
		sw=false;
		}
		/*
	if (cir_type_selected<=0)
		{
		$('#div_cir_type').fadeIn();
		sw=false;
		} */ 
	if (sw)
		{			
		divx = document.getElementById('div_circuit_list');
		divx.innerHTML = document.getElementById('DIV_WAIT1').innerHTML;
		//instanciamos el objetoAjax
		ajax=objectAjax();
		//uso del medotod POST
		ajax.open("POST", "code/execute/circuitAdd.php",true);
		ajax.onreadystatechange=function() {
					if (ajax.readyState==4) 
						{
						//mostrar resultados en esta capa
						divx.innerHTML=ajax.responseText;
						document.getElementById('div_cil_title').style.display='none';
						document.getElementById('div_cil_description').style.display='none';
	//					document.getElementById('cil_title').className='input';
//						document.getElementById('cil_description').className='input';
						$('#new_circuit').fadeOut(700);
						document.getElementById('cil_title').value='';
						document.getElementById('cil_description').value='';
//						alert(document.getElementById('cil_code').value);
						document.getElementById('cil_code').value='';
						
						}
					}  
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores
		//"&cir_type=" + cir_type_value + 
		ajax.send("cil_title=" + cil_title + "&cil_description=" + cil_description + "&circuitSelected=" + circuitSelected + "&cil_code=" + cil_code)
		}
	}

function tmp_circuit(circuit)
	{
	var cir_uid='';	
	//instanciamos el objetoAjax
	ajax=objectAjax();	
	if (circuit.checked)
		{
		//uso del medotod POST
		cir_uid=circuit.value;
		ajax.open("POST", "code/execute/circuitmpAdd.php",true);
		}
	else
		{
		//uso del medotod POST
		cir_uid=circuit.value;
		ajax.open("POST", "code/execute/circuitmpDel.php",true);		
		}
	ajax.onreadystatechange=function() {
							  if (ajax.readyState==4) 
								{
								//mostrar resultados en esta capa
								values =ajax.responseText;
								refresh_circuit();
								}
							}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	if (circuit.checked)
		{
		ajaxData = "cir_uid="+cir_uid;
		}
	else
		{
		ajaxData = "uid="+cir_uid;
		}
	ajax.send(ajaxData)	
	}
function refresh_circuit()
	{
	var div = document.getElementById('circuit_selected');	
	div.innerHTML = document.getElementById('div_wait_2').innerHTML;
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/circuitSelected.php",true);
	ajax.onreadystatechange=function() {
							  if (ajax.readyState==4) 
								{
								//mostrar resultados en esta capa
								div.innerHTML = ajax.responseText;								
								}
							}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("cir_uid=0")
	}

function filter_search_circuit(keyword)
	{
	var div = document.getElementById('div_circuit_list');	
	div.innerHTML = document.getElementById('div_wait_2').innerHTML;
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/circuitFilter.php",true);
	ajax.onreadystatechange=function() {
							  if (ajax.readyState==4) 
								{
								//mostrar resultados en esta capa
								div.innerHTML = ajax.responseText;								
								}
							}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("keyword="+keyword)
	
	}
	
function verifycircuitUpd()
	{
	var cil_title = document.getElementById('cil_title').value;	
	var frmcircuit = document.getElementById('frmcircuit');
/*	var cir_type = document.getElementById('cir_type');
	var cir_type_selected = cir_type.selectedIndex;
	var cir_type_value = cir_type[cir_type_selected].value;	*/
	var cil_description = document.getElementById('cil_description').value;
	document.getElementById('div_cil_title').style.display='none';
	document.getElementById('div_cil_description').style.display='none';	
//	document.getElementById('div_cir_type').style.display='none';
//	var inv_uid = document.getElementById('inv_uid').value;
	var sw=true;
	if (cil_title=="")
		{
		$('#div_cil_title').fadeIn();
		sw=false;
		}
	if (cil_description=="")
		{
		$('#div_cil_description').fadeIn();
		sw=false;
		}
/*	if (cir_type_selected<=0)
		{
		$('#div_cir_type').fadeIn();
		sw=false;
		} */
	if (sw)
		{
		document.frmcircuit.submit();
		}
	}

function circuitCS(uid,status)
	{
	divx = document.getElementById('status_c_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/circuitCS.php",true);
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

function verifyPack(option)
	{
	scroll(0,0);
	// VARIABLES PARA VERIFICACION
	var pac_title = document.getElementById('pac_title').value;
	//var pac_price = document.getElementById('pac_price').value;
	var sw=true;
	// MENSAJES EMERGENTES
	document.getElementById('div_pac_title').style.display='none';
	//document.getElementById('div_pac_price').style.display='none';
	// VERIFICACION DE DATOS
	if (pac_title=='')
		{
		$('#div_pac_title').fadeIn(700);
		sw=false;
		}
	/*if (pac_price<=0)
		{
		$('#div_pac_price').fadeIn(700);
		sw=false;
		}	*/		
	// ENVIO DE FORMULARIO
	if (sw)
		{
		if (option==1) // ADICIONAR
			{
			document.frmPack.submit();
			}
		else
			{	// ACTUALIZAR
			document.frmPack.action="code/execute/packUpd.php";
			document.frmPack.submit();
			}
		}	
	}
	
function packageCS(uid,status)
	{
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = document.getElementById('DIV_WAIT1').innerHTML;
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/packCS.php",true);
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





// VERIFICANDO EL ITINERARIO
function verifyItin(option)
	{
	scroll(0,0);
	// VARIABLES PARA VERIFICACION
	var iti_title = document.getElementById('iti_title').value;
	var sw=true;
	// MENSAJES EMERGENTES
	document.getElementById('div_iti_title').style.display='none';	
	// VERIFICACION DE DATOS
	if (iti_title=='')
		{
		$('#div_iti_title').fadeIn(700);
		sw=false;
		}	
	// ENVIO DE FORMULARIO
	if (sw)
		{
		if (option==1) // ADICIONAR
			{
			document.frmItin.submit();
			}
		else
			{	// ACTUALIZAR
			document.frmItin.action="code/execute/itiUpd.php";
			document.frmItin.submit();
			}
		}	
	}

// VERIFICANDO EL ITINERARIO
function verifyAct(option)
	{
	scroll(0,0);
	// VARIABLES PARA VERIFICACION
	var act_title = document.getElementById('act_title').value;
	var act_iti_uid = document.getElementById('act_iti_uid');
	var itiSelected = act_iti_uid.selectedIndex;
	var sw=true;
	// MENSAJES EMERGENTES
	document.getElementById('div_act_title').style.display='none';	
	document.getElementById('div_act_iti_uid').style.display='none';	
	
	// VERIFICACION DE DATOS
	if (act_title=='')
		{
		$('#div_act_title').fadeIn(700);
		sw=false;
		}	
	if (itiSelected<=0)
		{
		$('#div_act_iti_uid').fadeIn(700);
		sw=false;
		}		
	// ENVIO DE FORMULARIO
	if (sw)
		{
		if (option==1) // ADICIONAR
			{
			document.frmAct.submit();
			}
		else
			{	// ACTUALIZAR
			document.frmAct.action="code/execute/actUpd.php";
			document.frmAct.submit();
			}
		}	
	}


function itineraryCS(uid,status)
	{
	divx = document.getElementById('status_c_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/itiCS.php",true);
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

function activityCS(uid,status)
	{
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = '<img border="0" src="lib/loading.gif">';
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/actCS.php",true);
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

function changeTab(tab)
	{
	document.frmAct.action='actEdit.php?tab='+tab;
	document.frmAct.submit();
	}

function searchTransport()
	{
	var tra_name = document.getElementById('tra_name').value;
	
	if (tra_name!="")
		{
		document.getElementById('wait_loading_data').style.display='';
		ajax=objectAjax();
		ajax.open("POST", "code/execute/actSearchTra.php",true);
		ajax.onreadystatechange=function() {
								  if (ajax.readyState==4) 
									{
									result=ajax.responseText;
									var resultpart = result.split(",");
									var parts = resultpart.length;
									if (parts==7)
										{
										value = resultpart[0];
										document.getElementById('tra_pax').selectedIndex=value;
										value = resultpart[1];
										document.getElementById('tra_std1').value=value;
										value = resultpart[2];
										document.getElementById('tra_std2').value=value;
										value = resultpart[3];
										document.getElementById('tra_oro1').value=value;
										value = resultpart[4];
										document.getElementById('tra_oro2').value=value;
										value = resultpart[5];
										document.getElementById('tra_pla1').value=value;
										value = resultpart[6];
										document.getElementById('tra_pla2').value=value;									
										document.getElementById('wait_loading_data').style.display='none';
										}									
									}
								}  
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores
		ajax.send("tra_name="+tra_name)		
		}
	}
function verifyTransport()
	{
	document.getElementById('div_tra_name').style.display='none';
	document.getElementById('div_tra_std12').style.display='none';
	document.getElementById('div_tra_oro12').style.display='none';
	document.getElementById('div_tra_pla12').style.display='none';
	
	var tra_name = document.getElementById('tra_name').value;
	var tra_pax = document.getElementById('tra_pax');
	var pax_selected = tra_pax.selectedIndex;
	var pax_value = tra_pax[pax_selected].value;
	var tra_std1 = document.getElementById('tra_std1').value;
	var tra_std2 = document.getElementById('tra_std2').value;
	var tra_oro1 = document.getElementById('tra_oro1').value;
	var tra_oro2 = document.getElementById('tra_oro2').value;
	var tra_pla1 = document.getElementById('tra_pla1').value;
	var tra_pla2 = document.getElementById('tra_pla2').value;	
	var sw=true;
	if (tra_name=="")
		{
		$('#div_tra_name').fadeIn(700);		
		sw=false;
		}
	if (tra_std1=="" || tra_std2=="")
		{
		$('#div_tra_std12').fadeIn(700);		
		sw=false;
		}
	if (tra_oro1=="" || tra_oro2=="")
		{
		$('#div_tra_oro12').fadeIn(700);		
		sw=false;
		}
	if (tra_pla1=="" || tra_pla2=="")
		{
		$('#div_tra_pla12').fadeIn(700);		
		sw=false;
		}		
	if (sw)
		{
		document.frmAct.action='actEdit.php';
		document.getElementById('add_price').value="1";
		document.frmAct.submit();
		}
	}	

function verifyLodging()
	{
	document.getElementById('div_lod_name').style.display='none';
	document.getElementById('div_lod_category').style.display='none';
	document.getElementById('div_lod_swb12').style.display='none';
	document.getElementById('div_lod_dwb12').style.display='none';
	document.getElementById('div_lod_twb12').style.display='none';
	document.getElementById('div_lod_adic12').style.display='none';
	
	var lod_name = document.getElementById('lod_name').value;
	var lod_category = document.getElementById('lod_category');
	var category_selected = lod_category.selectedIndex;
	var category_value = lod_category[category_selected].value;
	var lod_swb1 = document.getElementById('lod_swb1').value;
	var lod_swb2 = document.getElementById('lod_swb2').value;
	var lod_dwb1 = document.getElementById('lod_dwb1').value;
	var lod_dwb2 = document.getElementById('lod_dwb2').value;
	var lod_twb1 = document.getElementById('lod_twb1').value;
	var lod_twb2 = document.getElementById('lod_twb2').value;
	
	var lod_adic1 = document.getElementById('lod_adic1').value;
	var lod_adic2 = document.getElementById('lod_adic2').value;
	
	var sw=true;
	if (lod_name=="")
		{
		$('#div_lod_name').fadeIn(700);		
		sw=false;
		}
	if (category_selected<=0)
		{
		$('#div_lod_category').fadeIn(700);		
		sw=false;
		}
	if (lod_swb1=="" || lod_swb2=="")
		{
		$('#div_lod_swb12').fadeIn(700);		
		sw=false;
		}
	if (lod_dwb1=="" || lod_dwb2=="")
		{
		$('#div_lod_dwb12').fadeIn(700);		
		sw=false;
		}
	if (lod_twb1=="" || lod_twb2=="")
		{
		$('#div_lod_twb12').fadeIn(700);		
		sw=false;
		}	
	if (lod_adic1=="" || lod_adic2=="")
		{
		$('#div_lod_adic12').fadeIn(700);		
		sw=false;
		}			
	if (sw)
		{
		document.frmAct.action='actEdit.php?tab=2';
		document.getElementById('add_price').value="2";
		document.frmAct.submit();
		}
	}	
	
function searchLodging()
	{
	var lod_name = document.getElementById('lod_name').value;
	
	if (lod_name!="")
		{
		document.getElementById('wait_loading_data').style.display='';
		ajax=objectAjax();
		ajax.open("POST", "code/execute/actSearchLod.php",true);
		ajax.onreadystatechange=function() {
								  if (ajax.readyState==4) 
									{
									result=ajax.responseText;
									var resultpart = result.split(",");
									var parts = resultpart.length;
									if (parts==9)
										{
										value = resultpart[0];
										document.getElementById('lod_category').selectedIndex=value;
										value = resultpart[1];
										document.getElementById('lod_swb1').value=value;
										value = resultpart[2];
										document.getElementById('lod_swb2').value=value;
										value = resultpart[3];
										document.getElementById('lod_dwb1').value=value;
										value = resultpart[4];
										document.getElementById('lod_dwb2').value=value;
										value = resultpart[5];
										document.getElementById('lod_twb1').value=value;
										value = resultpart[6];
										document.getElementById('lod_twb2').value=value;									
										value = resultpart[7];
										document.getElementById('lod_adic1').value=value;
										value = resultpart[8];
										document.getElementById('lod_adic2').value=value;
										document.getElementById('wait_loading_data').style.display='none';
										}									
									}
								}  
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores
		ajax.send("lod_name="+lod_name)		
		}
	}


function verifyGuide()
	{
	document.getElementById('div_gui_name').style.display='none';
	document.getElementById('div_gui_pax1212').style.display='none';
	document.getElementById('div_gui_pax3512').style.display='none';
	document.getElementById('div_gui_pax6912').style.display='none';
	document.getElementById('div_gui_pax101212').style.display='none';
	document.getElementById('div_gui_pax13up12').style.display='none';
	document.getElementById('div_gui_languages').style.display='none';
	
	
	var gui_name = document.getElementById('gui_name').value;
	var gui_pax121 = document.getElementById('gui_pax121').value;
	var gui_pax122 = document.getElementById('gui_pax122').value;
	var gui_pax351 = document.getElementById('gui_pax351').value;
	var gui_pax352 = document.getElementById('gui_pax352').value;
	var gui_pax691 = document.getElementById('gui_pax691').value;
	var gui_pax692 = document.getElementById('gui_pax692').value;
	var gui_pax10121 = document.getElementById('gui_pax10121').value;
	var gui_pax10122 = document.getElementById('gui_pax10122').value;
	var gui_pax13up1 = document.getElementById('gui_pax13up1').value;
	var gui_pax13up2 = document.getElementById('gui_pax13up2').value;
	
	var gui_english = document.getElementById('gui_english').checked;
	var gui_french = document.getElementById('gui_french').checked;
	var gui_spanish = document.getElementById('gui_spanish').checked;
	var gui_aymara = document.getElementById('gui_aymara').checked;
	var gui_quechua = document.getElementById('gui_quechua').checked;
	var sw=true;
	if (gui_name=="")
		{
		$('#div_gui_name').fadeIn(700);		
		sw=false;
		}

	if (gui_pax121=="" || gui_pax122=="")
		{
		$('#div_gui_pax1212').fadeIn(700);		
		sw=false;
		}
	if (gui_pax351=="" || gui_pax352=="")
		{
		$('#div_gui_pax3512').fadeIn(700);		
		sw=false;
		}
	if (gui_pax691=="" || gui_pax692=="")
		{
		$('#div_gui_pax6912').fadeIn(700);		
		sw=false;
		}	
	if (gui_pax10121=="" || gui_pax10122=="")
		{
		$('#div_gui_pax101212').fadeIn(700);		
		sw=false;
		}
	if (gui_pax13up1=="" || gui_pax13up2=="")
		{
		$('#div_gui_pax13up12').fadeIn(700);		
		sw=false;
		}
	if (gui_english==false && gui_french==false && gui_spanish==false && gui_aymara==false && gui_quechua==false)
		{
		$('#div_gui_languages').fadeIn(700);		
		sw=false;
		}
	if (sw)
		{
		document.frmAct.action='actEdit.php?tab=3';
		document.getElementById('add_price').value="3";
		document.frmAct.submit();
		}
	}	

function searchGuide()
	{
	var gui_name = document.getElementById('gui_name').value;
	
	if (gui_name!="")
		{
		document.getElementById('wait_loading_data').style.display='';
		ajax=objectAjax();
		ajax.open("POST", "code/execute/actSearchGui.php",true);
		ajax.onreadystatechange=function() {
						  if (ajax.readyState==4) 
							{
							result=ajax.responseText;
							var resultpart = result.split(",");
							var parts = resultpart.length;
							if (parts==15)
								{
								value = resultpart[0];
								if (value==1) document.getElementById('gui_english').checked=true;
								else document.getElementById('gui_english').checked=false;
								value = resultpart[1];
								if (value==1) document.getElementById('gui_french').checked=true;
								else document.getElementById('gui_french').checked=false;
								value = resultpart[2];
								if (value==1) document.getElementById('gui_spanish').checked=true;
								else document.getElementById('gui_spanish').checked=false;
								value = resultpart[3];
								if (value==1) document.getElementById('gui_aymara').checked=true;
								else document.getElementById('gui_aymara').checked=false;
								value = resultpart[4];
								if (value==1) document.getElementById('gui_quechua').checked=true;
								else document.getElementById('gui_quechua').checked=false;
								value = resultpart[5];
								document.getElementById('gui_pax121').value=value;
								value = resultpart[6];
								document.getElementById('gui_pax122').value=value;									
								value = resultpart[7];
								document.getElementById('gui_pax351').value=value;
								value = resultpart[8];
								document.getElementById('gui_pax352').value=value;								
								value = resultpart[9];
								document.getElementById('gui_pax691').value=value;
								value = resultpart[10];
								document.getElementById('gui_pax692').value=value;
								value = resultpart[11];
								document.getElementById('gui_pax10121').value=value;
								value = resultpart[12];
								document.getElementById('gui_pax10122').value=value;
								value = resultpart[13];
								document.getElementById('gui_pax13up1').value=value;
								value = resultpart[14];
								document.getElementById('gui_pax13up2').value=value;								
								document.getElementById('wait_loading_data').style.display='none';
								}									
							}
						}  
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//enviando los valores
		ajax.send("gui_name="+gui_name)		
		}
	}
	
	

function verifyOther()
	{
	document.getElementById('div_oth_title').style.display='none';
	document.getElementById('div_oth_std12').style.display='none';
	document.getElementById('div_oth_oro12').style.display='none';
	document.getElementById('div_oth_pla12').style.display='none';
	
	var oth_title = document.getElementById('oth_title').value;
	var oth_pax = document.getElementById('oth_pax');
	var pax_selected = oth_pax.selectedIndex;
	var pax_value = oth_pax[pax_selected].value;
	var oth_std1 = document.getElementById('oth_std1').value;
	var oth_std2 = document.getElementById('oth_std2').value;
	var oth_oro1 = document.getElementById('oth_oro1').value;
	var oth_oro2 = document.getElementById('oth_oro2').value;
	var oth_pla1 = document.getElementById('oth_pla1').value;
	var oth_pla2 = document.getElementById('oth_pla2').value;	
	var sw=true;
	if (oth_title=="")
		{
		$('#div_oth_title').fadeIn(700);		
		sw=false;
		}
	if (oth_std1=="" || oth_std2=="")
		{
		$('#div_oth_std12').fadeIn(700);		
		sw=false;
		}
	if (oth_oro1=="" || oth_oro2=="")
		{
		$('#div_oth_oro12').fadeIn(700);		
		sw=false;
		}
	if (oth_pla1=="" || oth_pla2=="")
		{
		$('#div_oth_pla12').fadeIn(700);		
		sw=false;
		}		
	if (sw)
		{
		document.frmAct.action='actEdit.php?tab=4';
		document.getElementById('add_price').value="4";
		document.frmAct.submit();
		}
	}	
	
function verifyAct2(option,tab)
	{
	scroll(0,0);
	// VARIABLES PARA VERIFICACION
	var act_title = document.getElementById('act_title').value;
	var act_iti_uid = document.getElementById('act_iti_uid');
	var itiSelected = act_iti_uid.selectedIndex;
	var sw=true;
	// MENSAJES EMERGENTES
	document.getElementById('div_act_title').style.display='none';	
	document.getElementById('div_act_iti_uid').style.display='none';	
	
	// VERIFICACION DE DATOS
	if (act_title=='')
		{
		$('#div_act_title').fadeIn(700);
		sw=false;
		}	
	if (itiSelected<=0)
		{
		$('#div_act_iti_uid').fadeIn(700);
		sw=false;
		}		
	// ENVIO DE FORMULARIO
	if (sw)
		{
		if (option==1) // ADICIONAR
			{
			document.frmAct.submit();
			}
		else
			{	// ACTUALIZAR
			document.frmAct.action="code/execute/actUpd.php?tab=" + tab;
			document.frmAct.submit();
			}
		}	
	}


function nextCircuitPage(page)
	{
	//instanciamos el objetoAjax
	ajax=objectAjax();	
	//uso del medotod POST
	ajax.open("POST", "code/execute/circuitPage.php",true);		
	ajax.onreadystatechange=function() {
							  if (ajax.readyState==4) 
								{
								//mostrar resultados en esta capa
								values =ajax.responseText;
								refresh_circuit();
								}
							}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("pagi_pg="+page)	
	}
	
// JavaScript Document
function tmp_package(package)
	{
	var pac_uid='';	
	//instanciamos el objetoAjax
	ajax=objectAjax();	
	if (package.checked)
		{
		//uso del medotod POST
		pac_uid=package.value;
		ajax.open("POST", "code/execute/packagetmpAdd.php",true);
		}
	else
		{
		//uso del medotod POST
		pac_uid=package.value;
		ajax.open("POST", "code/execute/packagetmpDel.php",true);
		}
	ajax.onreadystatechange=function() {
							  if (ajax.readyState==4) 
								{
								//mostrar resultados en esta capa
								values =ajax.responseText;
								//refresh_package();
								}
							}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	if (package.checked)
		{
		ajaxData = "pac_uid="+pac_uid;
		}
	else
		{
		ajaxData = "uid="+pac_uid;
		}
	ajax.send(ajaxData)	
	}

function refresh_package()
	{
	var div = document.getElementById('package_selected');	
	div.innerHTML = document.getElementById('div_wait_2').innerHTML;
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/packSelected.php",true);
	ajax.onreadystatechange=function() {
							  if (ajax.readyState==4) 
								{
								//mostrar resultados en esta capa
								div.innerHTML = ajax.responseText;								
								}
							}  
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("pac_uid=0")
	}	
	
function pack_filter_search(value,page)
	{ 
	document.location.href=page+'?keyword='+value;			
	}


function packageCSP(uid,status)
	{
	divx = document.getElementById('status_' + uid);
	divx.innerHTML = document.getElementById('DIV_WAIT1').innerHTML;
	//instanciamos el objetoAjax
	ajax=objectAjax();
	//uso del medotod POST
	ajax.open("POST", "code/execute/packCSP.php",true);
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


/* ACA COLOCAR NUEVOS SCRIPTS */