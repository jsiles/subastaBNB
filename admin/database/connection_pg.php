<?php
class DBpg {

private $debug;
private $row;

			var $BaseDatos_pg;
			var $Servidor_pg;
			var $Usuario_pg;
			var $Clave_pg;
			var $Conexion_ID_pg = 0;
			var $Consulta_ID_pg = 0;
			var $Errno_pg = 0;
			var $Error_pg = "";

			function __construct($db_pg=DATABASE_pg, $host_pg=DBHOST_pg, $user_pg=DBUSER_pg, $pass_pg=DBPASSWORD_pg) {
			$this->BaseDatos_pg = $db_pg;
			$this->Servidor_pg = $host_pg;
			$this->Usuario_pg = $user_pg;
			$this->Clave_pg = $pass_pg;	
			$this->connect();
	}

function connect($db_pg="", $host_pg="", $user_pg="", $pass_pg="")
	{
	if ($db_pg != "") $this->BaseDatos_pg = $db_pg;
	if ($host_pg != "") $this->Servidor_pg = $host_pg;
	if ($user_pg != "") $this->Usuario_pg = $user_pg;
	if ($pass_pg != "") $this->Clave_pg = $pass_pg;

	$this->Conexion_ID_pg = pg_connect("host=".$this->Servidor_pg." port=5432 dbname=".$this->BaseDatos_pg." user=".$this->Usuario_pg." password=".$this->Clave_pg);

if (!$this->Conexion_ID_pg) 
		{
		$this->Error_pg = "Ha fallado la conexion.";
		return 0;
		}	

if (!@pg_dbname()) {
		$this->Error = "Imposible abrir ".$this->BaseDatos_pg ;
		
		return 0;
		}
	return $this->Conexion_ID_pg;
	}
 
/**
 * Initialize debbuger
 *
 * @param boolean $debug
 */
function debug($debug=true){
   $this->debug=$debug; 
}

function saveErrorLog($sql){
    if(count($_POST)){  
		foreach($_POST as $index=>$value ){
			if($index!='contrasena')
			$postvars .= $index.'='.substr($value,0,255).' | ';
		}
		$postvars = "
	err_postvars=".$postvars;
	}
	if(count($_GET)){  
		foreach($_GET as $index=>$value ){
			$getvars .= $index.'='.$value.' | ';
		}
		$getvars = "
	err_getvars=".$getvars;
	}
$err = "
	pg error=".pg_last_error()."
	pg=".$sql."
	err_ip=".$_SERVER['REMOTE_ADDR']."
	err_computername=".$_ENV['COMPUTERNAME']."
	err_http_referer=".$_SERVER['HTTP_REFERER']."
	err_http_user_agent=".$_SERVER['HTTP_USER_AGENT']."
	err_language=".$_SESSION['LANG'].$postvars.$getvars;
	if(isset($_SESSION["authenticated"])){
		$err .= ",
	err_authenticated=".$_SESSION["authenticated"]."
	err_user_fullname=".$_SESSION["usr_firstname"]." ".$_SESSION["usr_lastname"];
	}
	$log = new logging();  
	$log->lwrite($err);
	//die;
	//header('Location: '.PATH_DOMAIN);	
}

/**
 * Show error on screen
 *
 * @param string $sql
 */

 function showError($sql){
	$error="";
   if(DEBUG===true){ 
        	$error_pg = array('Sesiones'=>$_SESSION,'Post'=>$_POST,'Get'=>$_GET,'Error '=>pg_last_error(),'query'=>$sql);
   }
   else{
   	    if($this->debug){
	    	$error_pg = array('Sesiones'=>$_SESSION,'Detalle'=>pg_last_error(),'query'=>$sql);
   	    }
   	    /*else{
			$this->saveErrorLog($sql);
			$error = array('Error mysql'=>mysql_errno());
		} */
		$this->debug(false);
   }
   if($error)  krumo($error);
   if(SAVELOG===true) $this->saveErrorLog($sql);
}

/* Ejecuta un consulta */
function query($sql = "",$show=0){

		if ($show != 0)
			echo ""; //echo "sql=$sql";
		if ($sql == "")
			{
			$this->Error = "No ha especificado una consulta SQL";
			echo "<bn>ERROR". $this->Error;
			return 0;
			}
		//ejecutamos la consulta
		$this->Consulta_ID_pg = pg_query($this->Conexion_ID_pg,$sql);
		if (!$this->Consulta_ID_pg) {
			$this->Error_pg = pg_last_error();
			// comenariuo
			$this->showError($sql);
			//$this->showError($sql);
		}
//		echo "ID=".$this->Consulta_ID."::";
		return $this->Consulta_ID_pg;
}

/* Devuelve el numero de campos de una consulta */
function numfields() {
return pg_num_fields($this->Consulta_ID_pg);
}
/* Devuelve el numero de registros de una consulta */
function numrows(){
return pg_num_rows($this->Consulta_ID_pg);
}
/* Devuelve el nombre de un campo de una consulta */
function nombrecampo($numcampo) {
return pg_field_name($this->Consulta_ID_pg, $numcampo);
}
/* Muestra los datos de una consulta */
function verconsulta() {
		echo "<table border=1>\n";
		// mostramos los nombres de los campos
		for ($i = 0; $i < $this->numfields(); $i++){
		echo "<td><b>".$this->nombrecampo($i)."</b></td>\n";
		}
		echo "</tr>\n";
		// mostrarmos los registros
		while ($row = pg_fetch_row($this->Consulta_ID_pg)) {
		echo "<tr> \n";
		for ($i = 0; $i < $this->numfields(); $i++){
		echo "<td>".$row[$i]."</td>\n";
		}
		echo "</tr>\n";
		}
}

function next_record()
	{
	//echo "MAT".mysql_fetch_array($this->Consulta_ID);
	return pg_fetch_array($this->Consulta_ID_pg);
	}
function libera()
	{
	pg_free_result ($this->Consulta_ID_pg);
	}
    
} //fin de la Clse DBpg
?>