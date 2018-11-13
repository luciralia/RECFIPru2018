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

if($_REQUEST['mod']=='servi'){
$nom_arch="servicios_mant_int_";
} elseif($_REQUEST['mod']=='serv'){
$nom_arch="servicios_mant_";}

date_default_timezone_set('America/Mexico_City');
header('Content-type: application/x-msexcel'); 
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
//header("Content-type: text/html");
$texto='Content-Disposition: attachment;filename="' . $nom_arch . date("Ymd-His") . "_" . $renglon_xls[0]['laboratorio'] . '.xls"';
header($texto);

?>


<table  border="1">
  <tr>
    <th scope="col">Inventario</th>
    <th scope="col">Equipo</th>
    <th scope="col">Tipo de mantenimiento</th>
    <th scope="col">Descripción del servicio</th>
    <th scope="col">Costo (cotizado MX)</th>
    <th scope="col">Inicio</th>
    <th scope="col">Término</th>
    <th scope="col">Cotización</th>
  </tr>
<?php 


for($i=0;$i<count($renglon_xls);$i++){
?>
  <tr>
    <td><?php echo $renglon_xls[$i]['clave']; ?></td>
    <td><?php echo $renglon_xls[$i]['bn_desc']; ?></td>
    <td><?php echo $renglon_xls[$i]['tipo']; ?></td>
    <td><?php echo $renglon_xls[$i]['falla']; ?></td>
    <td><?php echo $renglon_xls[$i]['costo']; ?></td>
    <td><?php echo date("d-m-Y", strtotime($renglon_xls[$i]['frecepcion'])); ?></td>
    <td><?php echo date("d-m-Y", strtotime($renglon_xls[$i]['fsalida'])); ?></td>
    <td><?php echo $obj_cot->getCotiza($renglon_xls[$i]['id_cotizacion']); ?></td>
  </tr>

<?php } ?>
</table>