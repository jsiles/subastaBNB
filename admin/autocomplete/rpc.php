<?php  
$db = mysql_connect('localhost', 'nuevatel_rrhh' ,'n43v4t3l356');
mysql_select_db("viva_intranet",$db);

// Esta es la cadena de consulta a postear
if(isset($_POST['queryString'])) 
	{
	$queryString = $_POST['queryString'];
	// Is the string length greater than 0?
	if(strlen($queryString) >0) 
		{
		// BUSCA EN EL NOMBRE DE PAIS
		$sql = "SELECT cal_title 
				FROM mdl_capa_languages 
				WHERE cal_title LIKE '" . ($queryString) . "%' 
				ORDER BY cal_title
				LIMIT 3";
		$query = mysql_query($sql,$db);
		if($query) 
			{
			// While there are results loop through them - fetching an Object (i like PHP5 btw!).
			while ($result = mysql_fetch_array($query)) 
				{
				echo '<li onClick="fill(\'' . ($result["cal_title"]) . '\');">' . ($result["cal_title"]) . '</li>';
				}
			}			
		else
			{
			// Dont do anything.
			} // There is a queryString.
		}
	else
		{
		echo 'No tiene acceso directo a este escript!';
		}
	}
?>