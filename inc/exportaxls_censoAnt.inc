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
require_once('../clases/inventario.class.php');
$obj_xls=new Exportaxls(); // nueva linea
$obj_cot=new Cotiza();
$madq = new inventario();
date_default_timezone_set('America/Mexico_City');
header('Content-type: application/x-msexcel'); 
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
//header("Content-type: text/html");
$texto='Content-Disposition: attachment;filename="censo_' . date("Ymd-His") . "_" . $renglon_xls[0]['laboratorio'] . '.xls"';
header($texto);
?>


<?php
/*  este for es para cargar los datos de los renglones*/


/*				
	$renglon_xls=$obj_xls->tblXls($_REQUEST['lab'],$_REQUEST['mod'],$_REQUEST['id_div']);
				
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
$texto='Content-Disposition: attachment;filename="censo_' . date("Ymd-His") . "_" . $renglon_xls[0]['laboratorio'] . '.xls"';
header($texto);



?>

<?php

if ($_REQUEST['mod']=="ceneceq") {	
   
?>

<table border="1">
 
  <tr>
         <th  scope="col">Familia</th>
         <th  scope="col">Dispositivo</th>
         <th  scope="col">Marca</th>
         <th  scope="col">Uso/Desuso</th>
         <th  scope="col">Alto Rendimiento</th>
         <th  scope="col">Total</th>
            
  </tr>


<?php 


for($i=0;$i<count($renglon_xls);$i++){
?>
  <tr>
    <td><?php echo $renglon_xls[$i]['nombre_familia'];?></td>
    <td><?php echo $renglon_xls[$i]['nombre_dispositivo'];?></td>
    <td><?php echo $renglon_xls[$i]['descmarca'];?></td>
    <td><?php echo $renglon_xls[$i]['estadobien'];?></td>
    <td><?php echo $renglon_xls[$i]['equipoaltorend'];?></td>
    <td><?php echo $renglon_xls[$i]['cuenta'];?></td>
   </tr>

<?php 
} // fin del for 
?>
</table>
<?php 
}
?>

<?php

if ($_REQUEST['mod']=="cenecso") {	
    
?>
<table border="1">
   
  <tr>
         <th  scope="col">Sistema Operativo</th>
         <th  scope="col">Bien</th>
         <th  scope="col">Uso/Desuso</th>
         <th  scope="col">Alto Rendimiento</th>
         <th  scope="col">Total</th>
            
  </tr>
  
<?php 


for($i=0;$i<count($renglon_xls);$i++){
?>
  <tr>
    <td><?php echo $renglon_xls[$i]['so'];?></td>
    <td><?php echo $renglon_xls[$i]['bien'];?></td>
    <td><?php echo $renglon_xls[$i]['estadobien'];?></td>
    <td><?php echo $renglon_xls[$i]['equipoaltorend'];?></td>
    <td><?php echo $renglon_xls[$i]['count'];?></td>
   </tr>

<?php 
} // fin del for 
?>
</table>
<?php 
}
?>

<?php

if ($mod=="cenecfu") {	
    
?>
<table border="1">
   
  <tr>
         <th  scope="col">Usuario Final</th>
         <th  scope="col">Bien</th>
         <th  scope="col">Uso/Desuso</th>
         <th  scope="col">Alto Rendimiento</th>
         <th  scope="col">Total</th>
            
  </tr>
  
<?php 


for($i=0;$i<count($renglon_xls);$i++){
?>
  <tr>
    <td><?php echo $renglon_xls[$i]['usuariofinal'];?></td>
    <td><?php echo $renglon_xls[$i]['bien'];?></td>
    <td><?php echo $renglon_xls[$i]['estadobien'];?></td>
    <td><?php echo $renglon_xls[$i]['equipoaltorend'];?></td>
    <td><?php echo $renglon_xls[$i]['count'];?></td>
   </tr>

<?php 
} // fin del for 
?>
</table>

<?php

}
?>*/
