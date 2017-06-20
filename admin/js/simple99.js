function newAjax(){
        var xmlhttp=false;
        try{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(e){
                try{
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }catch(E){
                        xmlhttp = false;
                }
        }

        if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
                xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
}

function load(url){
        var contenido, preloader, departamento, entidad, selObjDep, selObjEnt, selIndexDep, selIndexEnt;
        selObjDep = document.getElementById('departamento');
        selObjEnt = document.getElementById('entidad');
        selIndexDep = selObjDep.selectedIndex;
        selIndexEnt = selObjEnt.selectedIndex;
        departamento = selObjDep.options[selIndexDep].text;
        entidad = selObjEnt.options[selIndexEnt].text;
        
        contenido = document.getElementById('contenido');
        preloader = document.getElementById('preloader');
        
        var dir=url+'?dep_id='+departamento+'&ent_id='+entidad+'&';
        //alert (dir);
        //creamos el objeto XMLHttpRequest
        ajax=NuevoAjax(); 
        //peticionamos los datos, le damos la url enviada desde el link
        ajax.open("GET", url+'?dep_id='+departamento+'&ent_id='+entidad+'&',true); 
        ajax.onreadystatechange=function(){
                if(ajax.readyState==1){
                        contenido.innerHTML = "<table width='100%'><td width='100%' height='150' align='center' valign='center'><img src='lib/loading.gif'></td></table>";
                        //modificamos el estilo de la div, mostrando una imagen de fondo
                        //preloader.style.background = "url('loading.gif') no-repeat"; 
                }else if(ajax.readyState==4){
                        if(ajax.status==200){
                                //mostramos los datos dentro de la div
                                contenido.innerHTML = ajax.responseText; 
                              //  preloader.innerHTML = "Cargado.";
                               // preloader.style.background = "url('loaded.gif') no-repeat";
                        }else if(ajax.status==404){
                                preloader.innerHTML = "La página no existe";
                        }else{
                                //mostramos el posible error
                                preloader.innerHTML = "Error:".ajax.status; 
                        }
                }
        }
        ajax.send(null);
}
function is_number(e)
  {                                    // DECLARACION DE CONSTANTES
    var num = "0123456789";            // caracteres numericos
    for (i=0; i<e.length; i++) {
        if (num.indexOf(e.charAt(i),0) == -1) return false;
    }
    return true;
  }


function goToPag()
{
	NumPag = document.getElementById('webPag').value;
	$secNum = is_number(NumPag);
	if ($secNum==true)
	{
	token = $.getUrlVar('token');
	maxLineP = $.getUrlVar('maxLineP');
	if(maxLineP!=undefined)
		maxL = '&maxLineP='+maxLineP;
	else
		maxL ='';

   if(NumPag!='')
		nPag = '&_pagi_pg='+NumPag;
	else 
		nPag='';
	document.location.href='http://'+window.location.hostname+window.location.pathname+'?t='+maxL+nPag;
	}
}	


function loadThickboxState()
{
    var expdate = new Date();
    var state;
    expdate.setTime(expdate.getTime() + (24 * 60 * 60 * 1000 * 365)); 
 if(!(state = GetCookie("state"))) 
 {
//    SetCookie("departamento", state, expdate, "/", null, false);
     tb_show('Loaded onload', 'changeState.php?height=155&width=300&modal=true&', null);
 }
  else
  {
   alert('ya escogio un departamento');
  }
  return true;      
}

// manejo de cookies
function getCookieVal (offset) 
{
    var endstr = document.cookie.indexOf (";", offset);
    if (endstr == -1)
        endstr = document.cookie.length;
    return unescape(document.cookie.substring(offset, endstr));
}

function GetCookie (name) 
{
    var arg = name + "=";
    var alen = arg.length;
    var clen = document.cookie.length;
    var i = 0;
        while (i < clen) 
        {
            var j = i + alen;
            if (document.cookie.substring(i, j) == arg)
                return getCookieVal (j);
            i = document.cookie.indexOf(" ", i) + 1;
            if (i == 0) 
                break; 
        }
   return null;
}
function setSate()
{
    var    departamento, selObjDep, selIndexDep;
    var expdate = new Date();
    selObjDep = document.getElementById('departamento');
    selIndexDep = selObjDep.selectedIndex;
    departamento = selObjDep.options[selIndexDep].value;
    anio = 24 * 60 * 60 * 1000 * 365; //24 hrs 60 min 60 segungos 1000 milesimas 365 dias
    minuto = 60*1000;
    expdate.setTime(expdate.getTime() + (minuto)); 

         if(departamento) 
         {
            SetCookie("state", departamento, expdate, "/", null, false);
            tb_remove();
         }
    return true;   
}
function SetCookie (name, value) 
{
    var argv = SetCookie.arguments;
    var argc = SetCookie.arguments.length;
    var expires = (2 < argc) ? argv[2] : null;
    var path = (3 < argc) ? argv[3] : null;
    var domain = (4 < argc) ? argv[4] : null;
    var secure = (5 < argc) ? argv[5] : false;
    document.cookie = name + "=" + escape (value) +
    ((expires == null) ? "" : ("; expires=" + expires.toGMTString())) +
    ((path == null) ? "" : ("; path=" + path)) +
    ((domain == null) ? "" : ("; domain=" + domain)) +
    ((secure == true) ? "; secure" : "");
}

function ResetCounts() 
{
    var expdate = new Date();
    expdate.setTime(expdate.getTime() + (24 * 60 * 60 * 1000 * 365)); 
    visit = 0;
    SetCookie("visit", visit, expdate , "/", null, false);
    leapto();
}
function RowsF(e)
{
	token = $.getUrlVar('token');
	document.location.href='newsList.php?maxLineP='+e;
}