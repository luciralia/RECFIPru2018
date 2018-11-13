<?php
require_once('../conexion.php');

class Log{

function putLog($modulo,$funcion){

// //////////////////////////////////Graba en el log/////////////////////////////
$strquery="INSERT INTO log (ip,id_user,fecha,modulo,funcion) VALUES ('%s',%d,'%s',%d,%d)";
$queryn=sprintf($strquery,$_SERVER['REMOTE_ADDR'],$_SESSION['id_usuario'],date("Y-m-d H:i:s"),$modulo,$funcion);
//echo $queryn;

$result=@pg_query($queryn) or die('ERROR AL INSERTAR DATOS DE LOG: ' . pg_last_error());

//$log = pg_fetch_array($result, NULL, PGSQL_ASSOC);
//print_r($log);

///////////////////////////////////////////////////////////////////////////////////////////////


	return 0;
			}


				
	} 
	
	?>

