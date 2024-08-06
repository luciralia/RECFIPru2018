<?php

require_once('../conexion.php');

//$query = "SELECT * FROM usuarios WHERE id_usuario =" . $_SESSION['id_usuario'];
//echo 'En cargaced';
//print_r($_SESSION);


$query = "select l.*, l.nombre as laboratorio, u.nombre as nresp, a_paterno, a_materno, de.nombre as depa, di.id_div as div, di.nombre as division,
u.tel1 as tel1,u.tel2 as tel2, u.email as email,u.ext as ext, e.descripcion as edif, detalle_ub as ubica, l.dir_postal as postal, capacidad,asignaturas,carreras
from laboratorios l, departamentos de, divisiones di, usuarios u, cat_edificio e 
where l.id_dep=de.id_dep
and de.id_div=di.id_div
and l.id_edif=e.id
and l.id_responsable=u.id_usuario
and id_lab="  . $_GET['lab'];

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