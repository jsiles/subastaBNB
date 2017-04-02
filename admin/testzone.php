<?php
/*
America/Asuncion
*/

echo 'antes:'.date('Y/m/d H:i:s').'<br>';

date_default_timezone_set('America/Asuncion');

$script_tz = date_default_timezone_get();
ini_set('date.timezone','America/Asuncion');

if (strcmp($script_tz, ini_get('date.timezone'))){
    echo 'Script timezone differs from ini-set timezone.';
} else {
    echo 'Script timezone and ini-set timezone match.';
}

echo '<br>despues:'.date('Y/m/d H:i:s').'<br>';

?>
