<?php
require_once('../conexion.php');
require_once('../clases/laboratorios.class.php');
$responsable=new laboratorios();
$query = "SELECT * FROM usuarios WHERE id_usuario =" . $_SESSION['id_usuario'];
//echo $query;
$datos = pg_query($con,$query);
while ($user = pg_fetch_array($datos,NULL, PGSQL_ASSOC)) 
	 { 
	      //echo "</br> Bienvenido [de cargausr]: ".$usuario['nombre']." ".$usuario['a_paterno']." ".$usuario['a_materno']; 
	     //echo "<h3>" . $responsable->getResponsable($_SESSION['id_usuario']) . "</h3>"; 
	 foreach($user as $campo => $valor){
		  $usuario[$campo]=$valor;
			}
	 }
	 


?>