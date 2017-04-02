<?php

include("../spaw.inc.php");
$spaw1 = new SpawEditor("spaw1");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>SPAW Editor Demo</title>
  </head>
  <body>
  <?=$_POST['spaw1'];?>

  <form name="frm1" method="post" action="demo.php">
  <table border="0" width="100" cellpadding="0" cellspacing="0">
	<tr>
		<td width="50%">
		<?php
		$spaw1->show();
		?>
		</td>
		</tr>
		<tr>
		<td>  <p>&nbsp;
		  </p>
		  <p>
		    <input type="submit" name="btn" value="Enviar">
                  </p></td>
	</tr>
  </form>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  </body>
</html>
