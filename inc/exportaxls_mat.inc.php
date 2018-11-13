<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
session_start(); //Nueva linea
require_once('../conexion.php'); // nueva linea
require_once('../clases/exporta.class.php'); //Nueva linea
require_once('../clases/cotiza.class.php');
$obj_xls=new Exportaxls(); // nueva linea
$obj_cot=new Cotiza();

/*  este for es para cargar los datos de los renglones*/
				
	$renglon_xls=$obj_xls->tblXls($_REQUEST['lab'],$_REQUEST['mod']);
				
				foreach ($renglon_xls as $reng) {
			        					
					foreach ($reng as $campo => $valor) {
						$registro[$campo]=$valor;
					}
				
				}

date_default_timezone_set('America/Mexico_City');
header('Content-type: application/x-msexcel'); 
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
//header("Content-type: text/html");
$texto='Content-Disposition: attachment;filename="requerimientos_mat_' . date("Ymd-His") . "_" . $renglon_xls[0]['laboratorio'] . '.xls"';
header($texto);

?>


<table border="1">
  <tr>
    <th scope="col">Cantidad</th>
    <th scope="col">Descripción</th>
    <th scope="col">Unidad de medida</th>
    <th scope="col">Unitario (MX)</th>
    <th scope="col">Total(MX)</th>
    <th scope="col">Año</th>
    <th scope="col">Cotización</th>
    <th scope="col">Motivo</th>
    <th scope="col">Justificación</th>
  </tr>
<?php 


for($i=0;$i<count($renglon_xls);$i++){
?>
  <tr>
    <td><?php echo $renglon_xls[$i]['cant']; ?></td>
    <td><?php echo $renglon_xls[$i]['descripcion']; ?></td>
    <td><?php echo $renglon_xls[$i]['medida']; ?></td>
    <td><?php echo $renglon_xls[$i]['costo']; ?></td>
    <td><?php echo $total=$renglon_xls[$i]['costo']*$renglon_xls[$i]['cant']; ?></td>
    <td><?php echo $renglon_xls[$i]['plazo']; ?></td>
    <td><?php echo $obj_cot->getCotiza($renglon_xls[$i]['id_cotizacion']); ?></td>
    <td><?php echo $renglon_xls[$i]['motivo']; ?></td>
    <td><?php echo $renglon_xls[$i]['justificacion']; ?></td>
    
  </tr>

<?php } ?>
</table>