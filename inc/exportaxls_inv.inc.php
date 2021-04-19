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
  
   <?php  if ($_POST['enviar']=='Con identificador'){ ?>
      <th scope="col">dispositivo_clave</th>
   <?php } else {  ?>
      <th scope="col">Dispositivo</th>
   <?php }
      if ($_POST['enviar']=='Con identificador'){ ?> 
     <th scope="col">usuario_final_clave</th>
   <?php }  else { ?>
     <th scope="col">Usuario Final</th>
   <?php }
      if ($_POST['enviar']=='Con identificador'){ ?> 
    <th scope="col">familia_clave</th>
   <?php } else { ?>
    <th scope="col">Familia</th>
   <?php }
    if ($_POST['enviar']=='Con identificador'){ ?>
    <th scope="col">tipo_ram_clave</th>
   <?php } else {?>
    <th scope="col">Tipo</th>
   <?php }
    if ($_POST['enviar']=='Con identificador'){ ?>
    <th scope="col">tecnologia_clave</th>
   <?php }  else {?> 
    <th scope="col">Tecnología</th>
   <?php }  ?> 
    <th scope="col">No. Empleado</th>
    <th scope="col">Nombre Resguardo</th>
    <th scope="col">Nombre Usuario</th>
    <th scope="col">Ubicación</th>
   <?php  if ($_POST['enviar']=='Con identificador'){ ?>
    <th scope="col">Usuario_perfil</th>
   <?php } else { ?> 
    <th scope="col">Perfil</th>
   <?php }
      if ($_POST['enviar']=='Con identificador'){ ?> 
    <th scope="col">Usuario_sector</th>
   <?php } else { ?> 
      <th scope="col">Sector</th>
   <?php }  ?> 
    <th scope="col">No. Serie</th>
    <th scope="col">Marca</th>
    <th scope="col">No. Factura</th>
    <th scope="col">Años de garantía</th>
    <th scope="col">Inventario UNAM</th>
    <th scope="col">Modelo</th>
    <th scope="col">Proveedor</th>
    <th scope="col">Fecha de Factura</th>
    <th scope="col">Otra Familia</th>
    <th scope="col">Modelo Procesador</th>
    <th scope="col">Cantidad Procesador</th>
    <th scope="col">Nucleos Totales</th>
    <th scope="col">Cantidad de GPU</th>
    <th scope="col">Memoria RAM [GB]</th>
    <th scope="col">RAM Especificar</th>
    <th scope="col">Número de elementos</th>
    <th scope="col">Capacidad Total [GB]</th>
    <th scope="col">Número de arreglos</th>
   <?php  if ($_POST['enviar']=='Con identificador'){ ?> 
    <th scope="col">id_esquema_uno</th>
   <?php } else { ?>  
     <th scope="col">Esquema Uno</th>
   <?php }
    if ($_POST['enviar']=='Con identificador'){ ?>
     <th scope="col">id_tec_uno</th>
   <?php } else { ?> 
     <th scope="col">Tecnología Uno</th>
   <?php }  ?> 
    <th scope="col">SubTotal Uno [GB]</th>
   <?php  if ($_POST['enviar']=='Con identificador'){ ?> 
    <th scope="col">id_esquema_dos</th>
   <?php }  else {?> 
    <th scope="col">Esquema Dos</th>
   <?php }
      if ($_POST['enviar']=='Con identificador'){ ?> 
    <th scope="col">id_tec_dos</th>
   <?php } else { ?> 
      <th scope="col">Tecnología Dos</th>
    <?php }  ?> 
    <th scope="col">SubTotal Dos [GB]</th>
   <?php  if ($_POST['enviar']=='Con identificador'){ ?>
    <th scope="col">id_esquema_tres</th>
   <?php }  else {?> 
    <th scope="col">Esquema Tres</th>
   <?php }
   if ($_POST['enviar']=='Con identificador'){ ?>
    <th scope="col">id_tec_tres</th>
   <?php } else {  ?>  
    <th scope="col">Tecnología Tres</th>
   <?php } ?> 
    <th scope="col">SubTotal Tres [GB]</th>
   <?php  if ($_POST['enviar']=='Con identificador'){ ?>
    <th scope="col">id_esquema_cuatro</th>
   <?php } else { ?> 
    <th scope="col">Esquema Cuatro</th>
    
   <?php }
     if ($_POST['enviar']=='Con identificador'){ ?> 
     <th scope="col">id_tec_cuatro</th>
   <?php } else { ?> 
      <th scope="col">Tecnología Cuatro</th>
   <?php } ?> 
    <th scope="col">SubTotal Cuatro [GB]</th>
    <th scope="col">Capacidad Total [GB]</th>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?> 
      <th scope="col">id_tec_com</th>
    <?php } else {  ?>
      <th scope="col">Tecnología de Comunicación</th>
     <?php } ?> 
     <th scope="col">Tecnología de Comunicación otro</th>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
     <th scope="col">id_sistema_operativo</th>
    <?php } else { ?>
     <th scope="col">Sistema operativo</th>
    <?php } ?> 
    <th scope="col">Versión</th>
    <th scope="col">Licencia</th>
    <th scope="col">Inicia Licencia</th> 
    <th scope="col">Fin Licencia</th>
    <th scope="col">Modo de Adquisición</th>
 </tr>
 
  
<?php 


for($i=0;$i<count($renglon_xls);$i++){
?>
  <table border="1">
  <tr>
    
   <?php  if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $renglon_xls[$i]['dispositivo_clave'];?></td>
   <?php } else {  ?>
     <td><?php echo $renglon_xls[$i]['nombre_dispositivo'];?></td>
   <?php }
   if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $renglon_xls[$i]['usuario_final_clave'];?></td>
   <?php } else {  ?>
     <td><?php echo $renglon_xls[$i]['tipo_usuario'];?></td>
   <?php }
    if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $renglon_xls[$i]['familia_clave'];?></td>
   <?php } else { ?> 
      <td><?php echo $renglon_xls[$i]['nombre_familia'];?></td>
   <?php }
   if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $renglon_xls[$i]['tipo_ram_clave'];?></td>
   <?php }  else {?>
      <td><?php echo $renglon_xls[$i]['nombre_tipo_ram'];?></td>
   <?php }
    if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $renglon_xls[$i]['tecnologia_clave'];?></td>
   <?php } else { ?> 
    <td><?php echo $renglon_xls[$i]['nomtec'];?></td>
   <?php }  ?>
    <td><?php echo $renglon_xls[$i]['resguardo_no_empleado'];?></td>
    <td><?php echo $renglon_xls[$i]['nombre_resguardo'];?></td>
    <td><?php echo $renglon_xls[$i]['usuario_nombre'];?></td>
    <td><?php echo $renglon_xls[$i]['usuario_ubicacion'];?></td> 
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $renglon_xls[$i]['usuario_perfil'];?></td> 
    <?php } else { ?>
       <td><?php echo $renglon_xls[$i]['nombre_perfil'];?></td>
    <?php }  ?>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $renglon_xls[$i]['usuario_sector'];?></td> 
    <?php } else { ?>
      <td><?php echo $renglon_xls[$i]['nombre_sector'];?></td>
    <?php }  ?>
    <td><?php echo $renglon_xls[$i]['serie'];?></td>
    <td><?php echo $renglon_xls[$i]['marca_p'];?></td>
    <td><?php echo $renglon_xls[$i]['no_factura'];?></td>
    <td><?php echo $renglon_xls[$i]['anos_garantia'];?></td>
    <td><?php echo $renglon_xls[$i]['inventario'];?></td>
    <td><?php echo $renglon_xls[$i]['modelo_p'];?></td>
    <td><?php echo $renglon_xls[$i]['proveedor_p'];?></td>
    <td><?php echo $renglon_xls[$i]['fecha_factura'];?></td><!-- echo date("d-m-Y", strtotime($lab_invent['fecha_factura']));-->
    <td><?php echo $renglon_xls[$i]['familia_especificar'];?></td>
    <td><?php echo $renglon_xls[$i]['modelo_procesador'];?></td>
    <td><?php echo $renglon_xls[$i]['cantidad_procesador'];?></td>
    <td><?php echo $renglon_xls[$i]['nucleos_totales'];?></td>
    <td><?php echo $renglon_xls[$i]['nucleos_gpu'];?></td>
    <td><?php echo $renglon_xls[$i]['memoria_ram'];?></td>
    <td><?php echo $renglon_xls[$i]['ram_especificar'];?></td>
    <td><?php echo $renglon_xls[$i]['num_elementos_almac'];?></td>
    <td><?php echo $renglon_xls[$i]['total_almac'];?></td>
    <td><?php echo $renglon_xls[$i]['num_arreglos'];?></td>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $renglon_xls[$i]['esquema_uno'];?></td>
    <?php } else { ?>
       <td><?php echo $renglon_xls[$i]['esquemauno'];?></td>
    <?php }  ?>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $renglon_xls[$i]['tec_uno'];?></td>
    <?php } else { ?>
       <td><?php echo $renglon_xls[$i]['tecuno'];?></td>
    <?php }  ?>
       <td><?php echo $renglon_xls[$i]['subtotal_uno'];?></td>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $renglon_xls[$i]['esquema_dos'];?></td>
    <?php } else { ?>
       <td><?php echo $renglon_xls[$i]['esquemados'];?></td>
    <?php }  ?>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $renglon_xls[$i]['tec_dos'];?></td>
    <?php } else { ?>
      <td><?php echo $renglon_xls[$i]['tecdos'];?></td>
    <?php }  ?>
    <td><?php echo $renglon_xls[$i]['subtotal_dos'];?></td>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $renglon_xls[$i]['esquema_tres'];?></td>
    <?php }  else {?>
    <td><?php echo $renglon_xls[$i]['esquematres'];?></td>
    
    <?php }
	 if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $renglon_xls[$i]['tec_tres'];?></td>
    <?php }  else { ?>
      <td><?php echo $renglon_xls[$i]['tectres'];?></td>
    <?php }  ?>
    <td><?php echo $renglon_xls[$i]['subtotal_tres'];?></td>
    <?php if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $renglon_xls[$i]['esquema_cuatro'];?></td>
    <?php }  else { ?>
    <td><?php echo $renglon_xls[$i]['esquemacuatro'];?></td>
    <?php }
	if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $renglon_xls[$i]['tec_cuatro'];?></td>
    <?php } else { ?>
       <td><?php echo $renglon_xls[$i]['teccuatro'];?></td>
    <?php }  ?>
    <td><?php echo $renglon_xls[$i]['subtotal_cuatro'];?></td>
    <td><?php echo $renglon_xls[$i]['arreglo_total'];?></td>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $renglon_xls[$i]['id_tec_com'];?></td>
    <?php } else { ?>
    <td><?php echo $renglon_xls[$i]['nombre_tec_com'];?></td>
    <?php }  ?>
    <td><?php echo $renglon_xls[$i]['tec_com_otro'];?></td>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $renglon_xls[$i]['sist_oper'];?></td>
    <?php } else { ?>
    <td><?php echo $renglon_xls[$i]['nombre_so'];?></td>
    <?php }  ?>
    <td><?php echo $renglon_xls[$i]['version_sist_oper'];?></td>
    <td><?php echo $renglon_xls[$i]['licencia'];?></td>
    <td><?php echo $renglon_xls[$i]['licencia_ini'];?></td><!-- echo date("d-m-Y", strtotime($lab_invent['licencia_ini']));-->
    <td><?php echo $renglon_xls[$i]['licencia_fin'];?></td>
    <td><?php echo $renglon_xls['modo'];?></td>
     
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
    <td><?php echo $renglon_xls[$i]['num_arreglos'];?></td>
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
