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

//print_r ($_REQUEST);
if ($_REQUEST['lab']!='') {
	$tab='dispositivo';			
	$renglon_xls=$obj_xls->tblXls($_REQUEST['lab'],$_REQUEST['mod'],$_REQUEST['div'],$_SESSION['tipo_usuario']);
				
				foreach ($renglon_xls as $reng) {
			        					
					foreach ($reng as $campo => $valor) {
						$registro[$campo]=$valor;
					}
				
				}
}else if ($_REQUEST['div']!=''||$_REQUEST['div']=='' ) {
	
	 echo 'entra aqui';
	$renglon_xls=$obj_xls->eqDivXls($_REQUEST['div']);
	
	foreach ($renglon_xls as $reng) {
			        					
					foreach ($reng as $campo => $valor) {
						$registro[$campo]=$valor;
					}
				
				}
	}
date_default_timezone_set('America/Mexico_City');
header('Content-type: application/x-msexcel'); 
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
//header("Content-type: text/html");


if (  $_SESSION['tipo_usuario']==9  && $_SESSION['id_div']==NULL || $_REQUEST['lab']!=NULL ){
	 
$texto='Content-Disposition: attachment;filename="proyectos_' . date("Ymd-His") . "_" . $renglon_xls[0]['laboratorio'] . '.xls"';
}

if ( $_SESSION['tipo_usuario']==10 && $_REQUEST['div']!=""){
$texto='Content-Disposition: attachment;filename="proyectos_' . date("Ymd-His") . "_" . $renglon_xls[0]['division'] . '.xls"';
}else if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
$titulo='FacultadIngenieria';	
$texto='Content-Disposition: attachment;filename="proyectos_' . date("Ymd-His") . "_" . $titulo . '.xls"';
}

	
	
header($texto);

?>


<table border="1">
  <tr>
    <th scope="col">Cantidad</th>
    <th scope="col">Descripción</th>
    <th scope="col">Unitario (USD)</th>
    <th scope="col">Total(USD)</th>
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
    <td><?php echo $renglon_xls[$i]['costo']; ?></td>
    <td><?php echo $total=$renglon_xls[$i]['costo']*$renglon_xls[$i]['cant']; ?></td>
    <td><?php echo $renglon_xls[$i]['plazo']; ?></td>
    <td><?php echo $obj_cot->getCotiza($renglon_xls[$i]['id_cotizacion']); ?></td>
    <td><?php echo $renglon_xls[$i]['motivo']; ?></td>
    <td><?php echo $renglon_xls[$i]['justificacion']; ?></td>
    
  </tr>

<?php } ?>
</table>