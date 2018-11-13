<?php
/*header('Pragma: public'); 
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past    
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1 
header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1 
header('Pragma: no-cache'); 
header('Expires: 0'); 
header('Content-Transfer-Encoding: none'); 
header('Content-Type: application/vnd.ms-excel'); // This should work for IE & Opera 
header('Content-type: application/x-msexcel'); // This should work for the rest */

header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
$texto='Content-Disposition: attachment;filename="reporte_' . $_REQUEST['mod'] . '.xls"';
header($texto);


require_once('../conexion.php');
$query= "select nm.*, l.nombre  from nec_mobiliario nm, laboratorios l
where nm.id_lab=l.id_lab
and nm.id_lab="; 


switch ($_GET['orden']){
 			
			case "tipo":
			$query.= $_REQUEST['lab'] . " order by tipo asc";
 			break;
 			case "espec":
			$query.= $_REQUEST['lab'] . " order by especificaciones asc";
 			break;
 			default:
			$query.=$_REQUEST['lab'] . " order by id_nec asc";
	//		return $query;
 			break;
}




// echo $query; ?>

  <table border=1>
  <tr>
	<td width="86" scope="col">Cantidad</td>
    <td width="113" scope="col">Tipo de mobiliario</td>
    <td width="150" scope="col">Especificaciones</td>
    <td width="250" scope="col">Justificaci&oacute;n</td>
  </tr>

<?php

	$datos = pg_query($con,$query) or die('Existe un error con la base de datos' . pg_result_error($datos));

		while ($serv_mant = pg_fetch_array($datos, NULL, PGSQL_ASSOC)) 
			 { 
	
	?>
	
  <tr>
    <td><?php echo $serv_mant['cant'];?></td>
    <td><?php if ($serv_mant['tipo']=='rm') {echo "Remplazo";}else if ($serv_mant['tipo']=='rp'){echo "Reparación";} else {echo "Ampliación";}?></td>
    <td><?php echo $serv_mant['especificaciones'];?></td>
    <td><?php echo $serv_mant['justificacion'];?></td>
<!--    <td><?php echo "<pdf>"; //Campo de ruta de imagen?></td> -->

  </tr>

 
	
			<?php	
		 	 
			}
		//$_SESSION['id_usuario']=$usuario['id_usuario'];
			?>
          </table>


