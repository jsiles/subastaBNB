// JavaScript Document
function login()
{
usernameClient = $("#usernameClient").val();
passwordClient = $("#passwordClient").val();

$.ajax({
   type: "POST",
   url: SERVER+"/code/session.php",
   data: "usernameClient="+usernameClient+"&passwordClient="+passwordClient,
   success: function(msg){
     document.location.href=msg;
   }
 });
	return false;
}
function altas(ruta)
{
	pass2 = $("#pass2").val();
	pass = $("#pass").val();
	idUser = $("#idUser").val();
	msg='Usuario, contrase&ntilde;a y/o correo electr&oacute;nico requeridos.';
	if((idUser.length>0)&&(pass.length>0)&&(pass2.length>0))
	{
		$.ajax({
   			type: "POST",
   			url: SERVER+"/code/userAdd.php",
  			data: "pass="+pass+"&pass2="+pass2+"&idUser="+idUser,
   			success: function(msg2){
	     		$("#message").html(msg2);
				msg=msg2;
   			},
			complete: function(data) {
				if (msg.substring(0,3)=='Act'){
					setTimeout(function () {
					   window.location.href = ruta;
					}, 4000);
				}
				else{
					setTimeout(function () {
					   $("#message").show();
					}, 3000);
				}
        	}
 		});
	}else{
		$("#message").html(msg);
	}
}