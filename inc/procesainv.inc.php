<?php 
session_start();
require_once('../conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>


<p>procesaeq</p>


<p>&nbsp;</p>
<?php //print_r($_POST); ?>

<!-- asigna equipo a un laboratorio-->

<?php /*if($_POST['basignar']=='Asignar'){?>

<p>"Si entre a asignar"</p>

<?php 
//print_r($_POST);
//modificado para que ingrese en equipoC tabla destinada para ùnicamente equipo de cómputo LHH

$strquery="INSERT INTO equipoC (bn_id,id_lab,fecha,id_asig,tipo_mant,
                                id_evento_mant,in_out,especializado,vigente,id_mod,
                                bien,inventario,serie,marca,modelo) 
								VALUES (%d,%d,'%s',1,'',
								NULL,'','f','t',%d,
								'%s','%s','%s','%s','%s'
								)"
								;
$query=sprintf($strquery,$_REQUEST['bn_id'],$_REQUEST['lab'],date('Y-m-d'),$_POST['id_mod'],$_REQUEST['bn_desc'],$_REQUEST['bn_clave'],$_REQUEST['bn_serie'],$_REQUEST['bn_marca'],$_REQUEST['bn_modelo']);
			echo $query;
			$result=pg_query($con,$query) or die('ERROR AL INSERT DATOS: ' . pg_last_error());


//Despues de hacer la asignacion regresa a inventarios
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] .'&orden='. $_REQUEST['orden']. '&bbuscar='. $_REQUEST['bbuscar']. '&_no_inv='. $_REQUEST['_no_inv']. '&_no_inv_ant='. $_REQUEST['_no_inv_ant']. '&_marca='. $_REQUEST['_marca']. '&_descripcion='. $_REQUEST['_descripcion']. '&_no_serie='. $_REQUEST['_no_serie'];
echo $direccion;
header($direccion);

?>

<?php } */?>


<!-- /* Guarda datos de registro nuevo */-->
<?php if($_POST['accionn']=='Guardar'){ ?>
<h1>Nuevo</h1>
<?php 
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


$strquery="INSERT INTO eventos_mantenimiento (id_bitacora, id_equipo, tipo_mant, fecha, tipo_falla, fecha_salida, fecha_recepcion, costo, ok, id_cotizacion, tipo_serv) VALUES (%d,%d,'%s','%s','%s','%s','%s',%.2f,'%s','%s','%s')";
$queryn=sprintf($strquery,$id_bit_aux,$_POST['bn_id'],$_POST['tipo_mant'],$_POST['fecha'],$_POST['tipo_falla'],$_POST['fecha_salida'],$_POST['fecha_recepcion'],$_POST['cto_unitario'],$_POST['ok'],$_POST['id_cotizacion'],$_POST['tipo_serv']);


$result=@pg_query($con,$queryn) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());
echo $queryn;

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] .'&orden='. $_REQUEST['orden'];
echo $direccion . "</br>";
header($direccion);

 }?>



<!-- Guarda datos de edicion de registro -->
<?php if($_POST['accionm']=='Guardar'){ ?>
<h1>Edicion</h1>
<?php 

/* *******************  La buena  *********** */
$strquery="UPDATE eventos_mantenimiento SET tipo_mant='%s', id_equipo=%d, costo=%.2f, tipo_falla='%s', id_cotizacion=%d, fecha_salida='%s', fecha_recepcion='%s', ok='%s', fecha='%s' 
where id_evento=" . $_POST['id_evento'];
$queryu=sprintf($strquery,$_POST['tipo_mant'],$_POST['bn_id'],$_POST['cto_unitario'],$_POST['tipo_falla'],$_POST['id_cotizacion'],$_POST['fecha_salida'],$_POST['fecha_recepcion'],$_POST['ok'],$_POST['fecha']);


$result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] .'&orden='. $_REQUEST['orden'];
echo $direccion . "</br>";
header($direccion);
echo $queryu;


?>


<?php }?>
<?php /*if($_POST['accionm']=='borrar'){ 

$strquery="delete from req_mat where id_nec=%d and id_lab=%d";
$queryd=sprintf($strquery,$_POST['id_nec'],$_POST['id_lab']);
//$result=pg_query($con,$queryd) or die('ERROR AL BORRAR DATOS: ' . pg_last_error());

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'];
echo $direccion . "</br>";
//header($direccion);
echo $queryd;
}*/

?>


<?php if($_POST['accionm']=='Cancelar'|| $_POST['accionn']=='Cancelar'){ 

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] .'&orden='. $_REQUEST['orden'];
echo $direccion;
header($direccion);

}?>

<?php   //Codigo que podria servir en otros casos

/*$comp_query=array();
$i=0;
foreach ($_POST as $campo => $valor) {
		$comp_query[$i]= $campo	. "=" .$valor; 
		$i++;
//echo "\$usuario[$campo] => $valor.\n" . "</br>";
		//echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
}
$queryc=implode(",", $comp_query);
$queryu.=$queryc . " where id_req=" . $_POST['id_req'] . "and id_lab=" . $_POST['id_lab'];*/
?>