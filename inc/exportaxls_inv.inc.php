<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
session_start(); //Nueva linea
require_once('../conexion.php'); // nueva linea
require_once('../clases/exporta.class.php'); //Nueva linea

require_once('../clases/inventario.class.php');
$obj_xls=new Exportaxls(); // nueva linea

$madq = new inventario();

/*  este for es para cargar los datos de los renglones*/



		
	$renglon_xls=$obj_xls->tblXls($_REQUEST['lab'],$_REQUEST['mod'],$_REQUEST['tabla']);
				
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
$texto='Content-Disposition: attachment;filename="inventario_' . date("Ymd-His") . "_" . $renglon_xls[0]['laboratorio'] . '.xls"';
header($texto);

?>

<?php

if ($mod!="invg") {	
    
?>
<table border="1">
  <tr>
    <th scope="col">Dispositivo</th>
    <th scope="col">Usuario Final</th>
    <th scope="col">Nombre Resguardo</th>
    <th scope="col">No. Empleado</th>
    <th scope="col">Nombre Usuario</th>
    <th scope="col">Ubicación</th>
    <th scope="col">Perfil</th>
    <th scope="col">Sector</th>
    <th scope="col">No. Serie</th>
    <th scope="col">Inventario UNAM</th>
    <th scope="col">Marca</th>
    <th scope="col">Modelo</th>
    <th scope="col">No. Factura</th>
    <th scope="col">Proveedor</th>
    <th scope="col">Años de garantía</th>
    <th scope="col">Fecha de Factura</th>
    <th scope="col">Familia</th>
    <th scope="col">Otra Familia</th>
    <th scope="col">Modelo Procesador</th>
    <th scope="col">Cantidad</th>
    <th scope="col">Nucleos Totales</th>
    <th scope="col">Cantidad de GPU</th>
    <th scope="col">Memoria RAM [GB]</th>
    <th scope="col">Tipo</th>
    <th scope="col">Especificar Otro</th>
    <th scope="col">Número de Elementos</th>
    <th scope="col">Tecnología</th>
    <th scope="col">Capacidad Total [GB]</th>
    <th scope="col">Arreglos</th>
    <th scope="col">Esquema Uno</th>
    <th scope="col">Tecnología Uno</th>
    <th scope="col">SubTotal Uno [GB]</th>
    <th scope="col">Esquema Dos</th>
    <th scope="col">Tecnología Dos</th>
    <th scope="col">SubTotal Dos [GB]</th>
    <th scope="col">Esquema Tres</th>
    <th scope="col">Tecnología Tres</th>
    <th scope="col">SubTotal Tres [GB]</th>
    <th scope="col">Esquema Cuatro</th>
    <th scope="col">Tecnología Cuatro [GB]</th>
    <th scope="col">SubTotal Cuatro</th>
    <th scope="col">Capacidad Total [GB]</th>
    <th scope="col">Tecnología de Comunicación</th>
    <th scope="col">Tecnología de Comunicación otro</th>
    <th scope="col">Sistema operativo</th>
    <th scope="col">Versión</th>
    <th scope="col">Licencia</th>
    <th scope="col">Inicia Licencia</th> 
    <th scope="col">Fin Licencia</th>
 </tr>
  
<?php 


for($i=0;$i<count($renglon_xls);$i++){
?>
  <tr>
    <td><?php echo $renglon_xls[$i]['nombre_dispositivo'];?></td>
    <td><?php echo $renglon_xls[$i]['tipo_usuario'];?></td>
    <td><?php echo $renglon_xls[$i]['usuario_nombre'];?></td>
    <td><?php echo $renglon_xls[$i]['resguardo_no_empleado'];?></td>
    <td><?php echo $renglon_xls[$i]['usuario_nombre'];?></td>
    <td><?php echo $renglon_xls[$i]['usuario_ubicacion'];?></td>
    <td><?php echo $renglon_xls[$i]['nombre_perfil'];?></td>
    <td><?php echo $renglon_xls[$i]['nombre_sector'];?></td>
    <td><?php echo $renglon_xls[$i]['serie'];?></td>
    <td><?php echo $renglon_xls[$i]['inventario'];?></td>
    <td><?php echo $renglon_xls[$i]['marca_p'];?></td>
    <td><?php echo $renglon_xls[$i]['modelo_p'];?></td>
    <td><?php echo $renglon_xls[$i]['no_factura'];?></td>
    <td><?php echo $renglon_xls[$i]['proveedor_p'];?></td>
    <td><?php echo $renglon_xls[$i]['anos_garantia'];?></td>
    <td><?php echo date("d-m-Y", strtotime($renglon_xls[$i]['fecha_factura']));?></td>
    <td><?php echo $renglon_xls[$i]['nombre_familia'];?></td>
    <td><?php echo $renglon_xls[$i]['familia_especificar'];?></td>
    <td><?php echo $renglon_xls[$i]['modelo_procesador'];?></td>
    <td><?php echo $renglon_xls[$i]['cantidad_procesador'];?></td>
    <td><?php echo $renglon_xls[$i]['nucleos_totales'];?></td>
    <td><?php echo $renglon_xls[$i]['nucleos_gpu'];?></td>
    <td><?php echo $renglon_xls[$i]['memoria_ram'];?></td>
    <td><?php echo $renglon_xls[$i]['nombre_tipo_ram'];?></td>
    <td><?php echo $renglon_xls[$i]['ram_especificar'];?></td>
    <td><?php echo $renglon_xls[$i]['num_elementos_almac'];?></td>
    <td><?php echo $renglon_xls[$i]['nombre_tecnologia'];?></td>
    <td><?php echo $renglon_xls[$i]['total_almac'];?></td>
    <td><?php echo $renglon_xls[$i]['numero_arreglos'];?></td>
    <td><?php echo $renglon_xls[$i]['esquema_uno'];?></td>
    <td><?php echo $renglon_xls[$i]['tec_uno'];?></td>
    <td><?php echo $renglon_xls[$i]['subtotal_uno'];?></td>
    <td><?php echo $renglon_xls[$i]['esquema_dos'];?></td>
    <td><?php echo $renglon_xls[$i]['tec_dos'];?></td>
    <td><?php echo $renglon_xls[$i]['subtotal_dos'];?></td>
    <td><?php echo $renglon_xls[$i]['esquema_tres'];?></td>
    <td><?php echo $renglon_xls[$i]['tec_tres'];?></td>
    <td><?php echo $renglon_xls[$i]['subtotal_tres'];?></td>
    <td><?php echo $renglon_xls[$i]['esquema_cuatro'];?></td>
    <td><?php echo $renglon_xls[$i]['tec_cuatro'];?></td>
    <td><?php echo $renglon_xls[$i]['subtotal_cuatro'];?></td>
    <td><?php echo $renglon_xls[$i]['arreglo_total'];?></td>
    <td><?php echo $renglon_xls[$i]['tec_com'];?></td>
    <td><?php echo $renglon_xls[$i]['tec_com_otro'];?></td>
    <td><?php echo $renglon_xls[$i]['nombre_so'];?></td>
    <td><?php echo $renglon_xls[$i]['version_sist_oper'];?></td>
    <td><?php echo $renglon_xls[$i]['licencia'];?></td>
    <td><?php echo date("d-m-Y", strtotime($renglon_xls[$i]['licencia_ini']));?></td>
    <td><?php echo date("d-m-Y", strtotime($renglon_xls[$i]['licencia_fin']));?></td>
   
  </tr>

<?php 
} // fin del for 

?>
</table>
<?php
// comienza si es 'invg'
}

if ($mod=="invg") {	

if ($listatablas[$x]=='dispositivo'){        

	 
?>
<table border="1">
  <tr>
    <th scope="col">Dispositivo</th>
    <th scope="col">Usuario Final</th>
    <th scope="col">Nombre Resguardo</th>
    <th scope="col">No. Empleado</th>
    <th scope="col">Nombre Usuario</th>
    <th scope="col">Ubicación</th>
    <th scope="col">Perfil</th>
    <th scope="col">Sector</th>
    <th scope="col">No. Serie</th>
    <th scope="col">Inventario UNAM</th>
    <th scope="col">Marca</th>
    <th scope="col">Modelo</th>
    <th scope="col">No. Factura</th>
    <th scope="col">Proveedor</th>
    <th scope="col">Años de garantía</th>
    <th scope="col">Fecha de Factura</th>
    <th scope="col">Familia</th>
    <th scope="col">Otra Familia</th>
    <th scope="col">Modelo Procesador</th>
    <th scope="col">Cantidad</th>
    <th scope="col">Nucleos Totales</th>
    <th scope="col">Cantidad de GPU</th>
    <th scope="col">Memoria RAM [GB]</th>
    <th scope="col">Tipo</th>
    <th scope="col">Especificar Otro</th>
    <th scope="col">Número de Elementos</th>
    <th scope="col">Tecnología</th>
    <th scope="col">Capacidad Total [GB]</th>
    <th scope="col">Arreglos</th>
    <th scope="col">Esquema Uno</th>
    <th scope="col">Tecnología Uno</th>
    <th scope="col">SubTotal Uno [GB]</th>
    <th scope="col">Esquema Dos</th>
    <th scope="col">Tecnología Dos</th>
    <th scope="col">SubTotal Dos [GB]</th>
    <th scope="col">Esquema Tres</th>
    <th scope="col">Tecnología Tres</th>
    <th scope="col">SubTotal Tres [GB]</th>
    <th scope="col">Esquema Cuatro</th>
    <th scope="col">Tecnología Cuatro [GB]</th>
    <th scope="col">SubTotal Cuatro</th>
    <th scope="col">Capacidad Total [GB]</th>
    <th scope="col">Tecnología de Comunicación</th>
    <th scope="col">Tecnología de Comunicación otro</th>
    <th scope="col">Sistema operativo</th>
    <th scope="col">Versión</th>
    <th scope="col">Licencia</th>
    <th scope="col">Inicia Licencia</th> 
    <th scope="col">Fin Licencia</th>
 </tr>
  
<?php 


for($i=0;$i<count($renglon_xls);$i++){
?>
  <tr>
    <td><?php echo $renglon_xls[$i]['nombre_dispositivo'];?></td>
    <td><?php echo $renglon_xls[$i]['tipo_usuario'];?></td>
    <td><?php echo $renglon_xls[$i]['usuario_nombre'];?></td>
    <td><?php echo $renglon_xls[$i]['resguardo_no_empleado'];?></td>
    <td><?php echo $renglon_xls[$i]['usuario_nombre'];?></td>
    <td><?php echo $renglon_xls[$i]['usuario_ubicacion'];?></td>
    <td><?php echo $renglon_xls[$i]['nombre_perfil'];?></td>
    <td><?php echo $renglon_xls[$i]['nombre_sector'];?></td>
    <td><?php echo $renglon_xls[$i]['serie'];?></td>
    <td><?php echo $renglon_xls[$i]['inventario'];?></td>
    <td><?php echo $renglon_xls[$i]['marca_p'];?></td>
    <td><?php echo $renglon_xls[$i]['modelo_p'];?></td>
    <td><?php echo $renglon_xls[$i]['no_factura'];?></td>
    <td><?php echo $renglon_xls[$i]['proveedor_p'];?></td>
    <td><?php echo $renglon_xls[$i]['anos_garantia'];?></td>
    <td><?php echo date("d-m-Y", strtotime($renglon_xls[$i]['fecha_factura']));?></td>
    <td><?php echo $renglon_xls[$i]['nombre_familia'];?></td>
    <td><?php echo $renglon_xls[$i]['familia_especificar'];?></td>
    <td><?php echo $renglon_xls[$i]['modelo_procesador'];?></td>
    <td><?php echo $renglon_xls[$i]['cantidad_procesador'];?></td>
    <td><?php echo $renglon_xls[$i]['nucleos_totales'];?></td>
    <td><?php echo $renglon_xls[$i]['nucleos_gpu'];?></td>
    <td><?php echo $renglon_xls[$i]['memoria_ram'];?></td>
    <td><?php echo $renglon_xls[$i]['nombre_tipo_ram'];?></td>
    <td><?php echo $renglon_xls[$i]['ram_especificar'];?></td>
    <td><?php echo $renglon_xls[$i]['num_elementos_almac'];?></td>
    <td><?php echo $renglon_xls[$i]['nombre_tecnologia'];?></td>
    <td><?php echo $renglon_xls[$i]['total_almac'];?></td>
    <td><?php echo $renglon_xls[$i]['numero_arreglos'];?></td>
    <td><?php echo $renglon_xls[$i]['esquema_uno'];?></td>
    <td><?php echo $renglon_xls[$i]['tec_uno'];?></td>
    <td><?php echo $renglon_xls[$i]['subtotal_uno'];?></td>
    <td><?php echo $renglon_xls[$i]['esquema_dos'];?></td>
    <td><?php echo $renglon_xls[$i]['tec_dos'];?></td>
    <td><?php echo $renglon_xls[$i]['subtotal_dos'];?></td>
    <td><?php echo $renglon_xls[$i]['esquema_tres'];?></td>
    <td><?php echo $renglon_xls[$i]['tec_tres'];?></td>
    <td><?php echo $renglon_xls[$i]['subtotal_tres'];?></td>
    <td><?php echo $renglon_xls[$i]['esquema_cuatro'];?></td>
    <td><?php echo $renglon_xls[$i]['tec_cuatro'];?></td>
    <td><?php echo $renglon_xls[$i]['subtotal_cuatro'];?></td>
    <td><?php echo $renglon_xls[$i]['arreglo_total'];?></td>
    <td><?php echo $renglon_xls[$i]['tec_com'];?></td>
    <td><?php echo $renglon_xls[$i]['tec_com_otro'];?></td>
    <td><?php echo $renglon_xls[$i]['nombre_so'];?></td>
    <td><?php echo $renglon_xls[$i]['version_sist_oper'];?></td>
    <td><?php echo $renglon_xls[$i]['licencia'];?></td>
    <td><?php echo date("d-m-Y", strtotime($renglon_xls[$i]['licencia_ini']));?></td>
    <td><?php echo date("d-m-Y", strtotime($renglon_xls[$i]['licencia_fin']));?></td>
    
  </tr>
  
  
<?php

//poner listado de inventario cómputo			 
				 } ?>
                 </table>
 <?php
                
 }
 //elseif ($listatablas[$x]=='equipo'){
?>	 
	  <!-- 
  <table border="1">
  <tr>
    <th scope="col">No. Inventario</th>
    <th scope="col">No. Inventario Anterior</th>
    <th scope="col">Descripción del equipo FI</th>
    <th scope="col">Descripción del equipo Área</th>
    <th scope="col">Marca</th>
    <th scope="col">Modelo</th>
    <th scope="col">Serie</th>
    <th scope="col">Fecha de adquisición</th>
    <th scope="col">Estado</th>
    <th scope="col">Modo de adquisición</th>  
 </tr>
  -->
<?php 
/*

for($i=0;$i<count($renglon_xls);$i++){ */
?>
  <!-- 
  <tr>
    <td><?php // echo $renglon_xls[$i]['bn_clave'];?></td>
    <td><?php // echo $renglon_xls[$i]['bn_anterior'];?></td>
    <td><?php // echo $renglon_xls[$i]['bn_desc'];?></td>
    <td><?php // echo $renglon_xls[$i]['bien'];?></td>
    <td><?php // echo $renglon_xls[$i]['bn_marca'];?></td>
    <td><?php // echo $renglon_xls[$i]['bn_modelo'];?></td>
    <td><?php // echo $renglon_xls[$i]['bn_serie'];?></td>
    <td><?php // echo date("d-m-Y", strtotime($renglon_xls[$i]['bn_fadq']));?></td>
    <td><?php // echo $renglon_xls[$i]['co_descr'];?></td>
    <td><?php // echo $madq->getModo($renglon_xls[$i]['id_mod']); ?></td>
  </tr>
 -->
    
<?php
// } 
?>
  <!--</table>  -->

<?php
//} 
}?>
