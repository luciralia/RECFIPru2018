<?php
require_once('../conexion.php');
	
	$idlab='103';
        $tipo_req='mn';

//        $id_cot=$necArray[$_POST['_id_nec']]['id_cotizacion'];
        
        $query="Select * from cotizaciones where id_lab=" . $idlab . " and tipo='" . $tipo_req . "' order by id_cotizacion";
//		        $query="Select * from cotizaciones where id_lab=" . $idlab .  " order by id_cotizacion";

echo "del combo archivo" . $query;
//echo $query ."</br>". $id_cot . "</br>" . $lab;
	
	$result_cot = pg_query($con, $query) or die('Hubo un error con la base de datos');?>
	<select name="id_cotizacion" id="id_cotizacion">
	<option value="0" >Ninguna</option>
	<?php
	while ($datosc = pg_fetch_array($result_cot))
		{
	if($datosc['id_cotizacion']==$id_cot){
	?>
	<option value="<?php echo $datosc['id_cotizacion']; ?>" selected="selected"><?php echo $datosc['folio'] . " - " . $datosc['proveedor'];?></option>
	
	<?php } else {?>
	<option value="<?php echo $datosc['id_cotizacion']; ?>"><?php echo $datosc['folio'] . " - " . $datosc['proveedor'];?></option>
	
	<?php
	             }
	
		}
	 ?>

	</select>
	
