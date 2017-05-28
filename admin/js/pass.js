// JavaScript Document
function generarPassword(form, idPass, longitud) {
 var strCaracteresPermitidos = 'a,b,c,d,e,f,g,h,i,j,k,m,n,p,q,r,';
 strCaracteresPermitidos += 's,t,u,v,w,x,y,z,1,2,3,4,5,6,7,8,9,0,';
 strCaracteresPermitidos += 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R';
 strCaracteresPermitidos += 'S,T,U,V,W,X,Y,Z';
 
 var strArrayCaracteres = new Array(60);
 strArrayCaracteres = strCaracteresPermitidos.split(',');
 var i = 0, j, tmpstr = "";
 do {
  var randscript = -1;
  while (randscript < 1 || randscript > strArrayCaracteres.length || isNaN(randscript)) 
  {
   randscript = parseInt(Math.random() * strArrayCaracteres.length)
  }
  j = randscript;
  
  tmpstr = tmpstr + strArrayCaracteres[j];
  i = i + 1;
 } while (i < longitud)
	document.getElementById(idPass).value = tmpstr;
 return false;
}