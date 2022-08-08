<?php

require_once('../conexion.php');

//$query = "SELECT * FROM usuarios WHERE id_usuario =" . $_SESSION['id_usuario'];
//echo 'En cargaced';
//print_r($_SESSION);


$query = "SELECT l.*, l.nombre AS laboratorio, u.nombre AS nresp, a_paterno, a_materno, de.nombre AS depa, di.id_div AS div, di.nombre AS division,
u.tel1 AS tel1,u.tel2 AS tel2, u.email AS email,u.ext AS ext, e.descripcion AS edif, detalle_ub AS ubica, l.dir_postal AS postal, capacidad,asignaturas,carreras
FROM laboratorios l, departamentos de, divisiones di, usuarios u, cat_edificio e 
WHERE l.id_dep=de.id_dep
AND de.id_div=di.id_div
AND l.id_edif=e.id
AND l.id_responsable=u.id_usuario
AND id_lab="  . $_GET['lab'];

//echo $query;
$datos = pg_query($con,$query);

while ($lab_ced = pg_fetch_array($datos,NULL,PGSQL_ASSOC)) 
	 { 
	  foreach($lab_ced as $campo => $valor){
		  $laboratorio[$campo]=$valor;
			}

	 }

/*while ($lab_ced = pg_fetch_array($datos)) 
	 { 
	      //echo " el depa es" . 
          $id_lab=$lab_ced['id_lab'];
		  $lab=$lab_ced['laboratorio'];
		  $depa=$lab_ced['depa'];
		  $div=$lab_ced['div'];
		  $responsable=$lab_ced['nresp'] . " " . $lab_ced['a_paterno'] . " " . $lab_ced['a_materno'];
		  $tel1=$lab_ced['tel1'];
		  $email=$lab_ced['email'];
		  $ext=$lab_ced['ext'];
		  $edif=$lab_ced['edif'];
		  $ubica=$lab_ced['ubica'];
  		  $postal=$lab_ced['postal'];
		  $capacidad=$lab_ced['capacidad'];
		  $asigs=$lab_ced['asignaturas'];
		  $carr=$lab_ced['carreras'];
	 }*/
//$_SESSION['id_usuario']=$usuario['id_usuario'];

//print_r($laboratorio);
?>