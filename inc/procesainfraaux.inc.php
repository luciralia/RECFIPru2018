<?php 
session_start();
require_once('../conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>


<p>procesa infra</p>
<p>&nbsp;</p>
<?php print_r($_REQUEST); ?>

<!-- /* Guarda datos de registro nuevo */-->
<?php if($_POST['accionn']=='Guardar'){ ?>
<h1>Nuevo</h1>
<?php 
//Nuevo registro


$strquery="INSERT INTO eventos_infra (id_servicio, tipo, descripcion, fecha_inicio, fecha_termino, imagen, id_lab) VALUES (%d,'%s','%s','%s','%s','%s','%d')";
$queryn=sprintf($strquery,$_POST['id_servicio'],$_POST['tipo'],$_POST['descripcion'],$_POST['fecha_inicio'],$_POST['fecha_termino'],$_POST['imagen'],$_POST['lab']);

echo $queryn;
$result=@pg_query($con,$queryn) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());


$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] .'&orden='. $_REQUEST['orden'];
echo $direccion . "</br>";
header($direccion);

 }?>



<!-- Guarda datos de edicion de registro -->
<?php if($_POST['accionm']=='Guardar'){ ?>
<h1>Edicion</h1>
<?php 

/* *******************  La buena  *********** */
$strquery="UPDATE eventos_infra SET id_servicio=%d, tipo='%s', descripcion='%s', fecha_inicio='%s', fecha_termino='%s', imagen='%s', id_lab=%d where id_infra=" . $_POST['id_infra'];
$queryu=sprintf($strquery,$_POST['id_servicio'],$_POST['tipo'],$_POST['descripcion'],$_POST['fecha_inicio'],$_POST['fecha_termino'],$_POST['imagen'],$_POST['lab']);


$result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] .'&orden='. $_REQUEST['orden'];
echo $direccion . "</br>";
header($direccion);
echo $queryu;


}?>


<?php if($_POST['accionm']=='Cancelar'|| $_POST['accionn']=='Cancelar'|| $_POST['accionb']=='Cancelar'){ 

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] .'&orden='. $_REQUEST['orden'];
echo $direccion;
header($direccion);

}?>



<!-- /* Guarda datos de registro nuevo en bloque */-->
<?php if($_POST['accionb']=='Guardar'){ ?>
<h1>Nuevo</h1>
<?php 
//Determina si exite bitacora de mantenimiento para agregar el registro, si no existe se crea automaticamente, el proceso es transparente para el usuario
$queryaux="Select id_bitacora from bitacora where id_lab=". $_REQUEST['lab'] . " AND tipo_bit='3' AND vb_rl IS FALSE and vb_jdep IS FALSE";
$resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
$nreng = pg_num_rows($resultx);
			if ($nreng==1){
					$row = pg_fetch_array($resultx); 
					$id_bit_aux=$row['id_bitacora']; 
					echo "id_bit_aux_existe: " . $id_bit_aux . "</br>";
			
			} else {
				
						//Inserta una nueva bitacora para ese laboratorio para que pueda agregarse un registro en la tabla eventos_mantenimiento
						$strquery="INSERT INTO bitacora (id_lab,vb_rl,vb_jdep,tipo_bit,fecha_creacion) VALUES (%d,'f','f','3','%s')";
						$query=sprintf($strquery,$_REQUEST['lab'],$_POST['fecha']);
						echo $query;
						$result=pg_query($con,$query) or die('ERROR AL LEER DATOS: ' . pg_last_error());				
			
			//Carga el id_bitacora recien creada
						$queryaux="Select id_bitacora from bitacora where id_lab=". $_REQUEST['lab'] . " AND tipo_bit='3' AND vb_rl IS FALSE and vb_jdep IS FALSE";
						$resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
						$row = pg_fetch_array($resultx); 
						$id_bit_aux=$row['id_bitacora']; 
						echo "id_bit_aux insertada: " . $id_bit_aux . "</br>";
			
				}

//Cuando es mantenimiento interno se hacen estos ajustes para que la insercion sea permitida
		if (!isset($_POST['cto_unitario'])||!isset($_POST['ok'])){
			$cto_unitario=0;
			$ok='TRUE';
			}



						echo "al inicio " . $strquery;
						  for ($i=1;$i<$_POST['j'];$i++){
							   $checkbox='equipo'.$i;
								 if (isset($_POST[$checkbox])){
							 
							$strquery="INSERT INTO eventos_mantenimiento (id_bitacora, id_equipo, tipo_mant, fecha, tipo_falla, fecha_salida, fecha_recepcion, costo, ok, id_cotizacion, tipo_serv) VALUES (%d,%d,'%s','%s','%s','%s','%s',%.2f,'%s','%s','%s')";
								$queryn=sprintf($strquery,$id_bit_aux,$_POST[$checkbox],$_POST['tipo_mant'],$_POST['fecha'],$_POST['tipo_falla'],$_POST['fecha_salida'],$_POST['fecha_recepcion'],$cto_unitario,$ok,$_POST['id_cotizacion'],$_POST['tipo_serv']);
											echo "<br />" . " equipo " .$i. " " .  $_POST[$checkbox]. "<br />";
											echo "<br />" . $queryn . "<br />";
								$result=@pg_query($con,$queryn) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());									 
								
								 }//fin if
							   
							   
						   }//fin for
					  
			  

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] .'&orden='. $_REQUEST['orden'];
echo $direccion . "</br>";
header($direccion);

 }?>






