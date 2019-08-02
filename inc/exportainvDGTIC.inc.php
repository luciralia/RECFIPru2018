<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
session_start(); //Nueva linea
require_once('../conexion.php'); // nueva linea


require_once('../clases/inventario.class.php');

$inventarioxls= new inventario();

/*  este for es para cargar los datos de los renglones*/
//echo 'imprime la datos';
//print_r ($_POST);

$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
		   
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);

date_default_timezone_set('America/Mexico_City');
header('Content-type: application/x-msexcel'); 
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
//header("Content-type: text/html");
$texto='Content-Disposition: attachment;filename="inventarioDGTICdiv_' . date("Ymd-His") . "_" . $nombdiv[0]. '.xls"';
header($texto);

?>

<table>
   <tr>
       <td align="center" ><h2>Inventario para DGTIC por División</h2></td>
   </tr>
  

</table>
  
  
<?php

 $query=$inventarioxls->exportaInv();

 $query=$query . $_SESSION['id_div'] .
           " ORDER BY laboratorio" ;
		   
 $datos = pg_query($con,$query);
 $inventario= pg_num_rows($datos); 
?>



  
<table border="1">

  <tr>
  
   <?php  if ($_POST['enviar']=='DGTIC'){ ?>
      <th scope="col">dispositivo_clave</th>
   <?php } else {  ?>
      <th scope="col">Dispositivo</th>
   <?php }
      if ($_POST['enviar']=='DGTIC'){ ?> 
     <th scope="col">usuario_final_clave</th>
   <?php }  else { ?>
     <th scope="col">Usuario Final</th>
   <?php }
      if ($_POST['enviar']=='DGTIC'){ ?> 
    <th scope="col">familia_clave</th>
   <?php } else { ?>
    <th scope="col">Familia</th>
   <?php }
    if ($_POST['enviar']=='DGTIC'){ ?>
    <th scope="col">tipo_ram_clave</th>
   <?php } else {?>
    <th scope="col">Tipo</th>
   <?php }
    if ($_POST['enviar']=='DGTIC'){ ?>
    <th scope="col">tecnologia_clave</th>
   <?php }  else {?> 
    <th scope="col">Tecnología</th>
   <?php }  ?> 
    <th scope="col">No. Empleado</th>
    <th scope="col">Nombre Resguardo</th>
    <th scope="col">Nombre Usuario</th>
    <th scope="col">Ubicación</th>
   <?php  if ($_POST['enviar']=='DGTIC'){ ?>
    <th scope="col">Usuario_perfil</th>
   <?php } else { ?> 
    <th scope="col">Perfil</th>
   <?php }
      if ($_POST['enviar']=='DGTIC'){ ?> 
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
   <?php  if ($_POST['enviar']=='DGTIC'){ ?> 
    <th scope="col">id_esquema_uno</th>
   <?php } else { ?>  
     <th scope="col">Esquema Uno</th>
   <?php }
    if ($_POST['enviar']=='DGTIC'){ ?>
     <th scope="col">id_tec_uno</th>
   <?php } else { ?> 
     <th scope="col">Tecnología Uno</th>
   <?php }  ?> 
    <th scope="col">SubTotal Uno [GB]</th>
   <?php  if ($_POST['enviar']=='DGTIC'){ ?> 
    <th scope="col">id_esquema_dos</th>
   <?php }  else {?> 
    <th scope="col">Esquema Dos</th>
   <?php }
      if ($_POST['enviar']=='DGTIC'){ ?> 
    <th scope="col">id_tec_dos</th>
   <?php } else { ?> 
      <th scope="col">Tecnología Dos</th>
    <?php }  ?> 
    <th scope="col">SubTotal Dos [GB]</th>
   <?php  if ($_POST['enviar']=='DGTIC'){ ?>
    <th scope="col">id_esquema_tres</th>
   <?php }  else {?> 
    <th scope="col">Esquema Tres</th>
   <?php }
   if ($_POST['enviar']=='DGTIC'){ ?>
    <th scope="col">id_tec_tres</th>
   <?php } else {  ?>  
    <th scope="col">Tecnología Tres</th>
   <?php } ?> 
    <th scope="col">SubTotal Tres [GB]</th>
   <?php  if ($_POST['enviar']=='DGTIC'){ ?>
    <th scope="col">id_esquema_cuatro</th>
   <?php } else { ?> 
    <th scope="col">Esquema Cuatro</th>
    
   <?php }
     if ($_POST['enviar']=='DGTIC'){ ?> 
     <th scope="col">id_tec_cuatro</th>
   <?php } else { ?> 
      <th scope="col">Tecnología Cuatro</th>
   <?php } ?> 
    <th scope="col">SubTotal Cuatro [GB]</th>
    <th scope="col">Capacidad Total [GB]</th>
    <?php  if ($_POST['enviar']=='DGTIC'){ ?> 
      <th scope="col">id_tec_com</th>
    <?php } else {  ?>
      <th scope="col">Tecnología de Comunicación</th>
     <?php } ?> 
     <th scope="col">Tecnología de Comunicación otro</th>
    <?php  if ($_POST['enviar']=='DGTIC'){ ?>
     <th scope="col">id_sistema_operativo</th>
    <?php } else { ?>
     <th scope="col">Sistema operativo</th>
    <?php } ?> 
    <th scope="col">Versión</th>
    <th scope="col">Licencia</th>
    <th scope="col">Inicia Licencia</th> 
    <th scope="col">Fin Licencia</th>
   
 </tr>
 
 <?php
   while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ ?>
        
<table border="1">
  <tr>
  
   <?php  if ($_POST['enviar']=='DGTIC'){ ?>
      <td><?php echo $lab_invent['dispositivo_clave'];?></td>
   <?php } else {  ?>
     <td><?php echo $lab_invent['nombre_dispositivo'];?></td>
   <?php }
   if ($_POST['enviar']=='DGTIC'){ ?>
      <td><?php echo $lab_invent['usuario_final_clave'];?></td>
   <?php } else {  ?>
     <td><?php echo $lab_invent['tipo_usuario'];?></td>
   <?php }
    if ($_POST['enviar']=='DGTIC'){ ?>
      <td><?php echo $lab_invent['familia_clave'];?></td>
   <?php } else { ?> 
      <td><?php echo $lab_invent['nombre_familia'];?></td>
   <?php }
   if ($_POST['enviar']=='DGTIC'){ ?>
      <td><?php echo $lab_invent['tipo_ram_clave'];?></td>
   <?php }  else {?>
      <td><?php echo $lab_invent['nombre_tipo_ram'];?></td>
   <?php }
    if ($_POST['enviar']=='DGTIC'){ ?>
      <td><?php echo $lab_invent['tecnologia_clave'];?></td>
   <?php } else { ?> 
    <td><?php echo $lab_invent['nomtec'];?></td>
   <?php }  ?>
    <td><?php echo $lab_invent['resguardo_no_empleado'];?></td>
    <td><?php echo $lab_invent['nombre_resguardo'];?></td>
    <td><?php echo $lab_invent['usuario_nombre'];?></td>
    <td><?php echo $lab_invent['usuario_ubicacion'];?></td> 
    <?php  if ($_POST['enviar']=='DGTIC'){ ?>
       <td><?php echo $lab_invent['usuario_perfil'];?></td> 
    <?php } else { ?>
       <td><?php echo $lab_invent['nombre_perfil'];?></td>
    <?php }  ?>
    <?php  if ($_POST['enviar']=='DGTIC'){ ?>
      <td><?php echo $lab_invent['usuario_sector'];?></td> 
    <?php } else { ?>
      <td><?php echo $lab_invent['nombre_sector'];?></td>
    <?php }  ?>
    <td><?php echo $lab_invent['serie'];?></td>
    <td><?php echo $lab_invent['marca_p'];?></td>
    <td><?php echo $lab_invent['no_factura'];?></td>
    <td><?php echo $lab_invent['anos_garantia'];?></td>
    <td><?php echo $lab_invent['inventario'];?></td>
    <td><?php echo $lab_invent['modelo_p'];?></td>
    <td><?php echo $lab_invent['proveedor_p'];?></td>
    <td><?php echo $lab_invent['fecha_factura'];?></td><!-- echo date("d-m-Y", strtotime($lab_invent['fecha_factura']));-->
    <td><?php echo $lab_invent['familia_especificar'];?></td>
    <td><?php echo $lab_invent['modelo_procesador'];?></td>
    <td><?php echo $lab_invent['cantidad_procesador'];?></td>
    <td><?php echo $lab_invent['nucleos_totales'];?></td>
    <td><?php echo $lab_invent['nucleos_gpu'];?></td>
    <td><?php echo $lab_invent['memoria_ram'];?></td>
    <td><?php echo $lab_invent['ram_especificar'];?></td>
    <td><?php echo $lab_invent['num_elementos_almac'];?></td>
    <td><?php echo $lab_invent['total_almac'];?></td>
    <td><?php echo $lab_invent['num_arreglos'];?></td>
    <?php  if ($_POST['enviar']=='DGTIC'){ ?>
       <td><?php echo $lab_invent['esquema_uno'];?></td>
    <?php } else { ?>
       <td><?php echo $lab_invent['esquemauno'];?></td>
    <?php }  ?>
    <?php  if ($_POST['enviar']=='DGTIC'){ ?>
       <td><?php echo $lab_invent['tec_uno'];?></td>
    <?php } else { ?>
       <td><?php echo $lab_invent['tecuno'];?></td>
    <?php }  ?>
       <td><?php echo $lab_invent['subtotal_uno'];?></td>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $lab_invent['esquema_dos'];?></td>
    <?php } else { ?>
       <td><?php echo $lab_invent['esquemados'];?></td>
    <?php }  ?>
    <?php  if ($_POST['enviar']=='DGTIC'){ ?>
      <td><?php echo $lab_invent['tec_dos'];?></td>
    <?php } else { ?>
      <td><?php echo $lab_invent['tecdos'];?></td>
    <?php }  ?>
    <td><?php echo $lab_invent['subtotal_dos'];?></td>
    <?php  if ($_POST['enviar']=='DGTIC'){ ?>
      <td><?php echo $lab_invent['esquema_tres'];?></td>
    <?php }  else {?>
    <td><?php echo $lab_invent['esquematres'];?></td>
    
    <?php }
	 if ($_POST['enviar']=='DGTIC'){ ?>
      <td><?php echo $lab_invent['tec_tres'];?></td>
    <?php }  else { ?>
      <td><?php echo $lab_invent['tectres'];?></td>
    <?php }  ?>
    <td><?php echo $lab_invent['subtotal_tres'];?></td>
    <?php if ($_POST['enviar']=='DGTIC'){ ?>
       <td><?php echo $lab_invent['esquema_cuatro'];?></td>
    <?php }  else { ?>
    <td><?php echo $lab_invent['esquemacuatro'];?></td>
    <?php }
	if ($_POST['enviar']=='DGTIC'){ ?>
       <td><?php echo $lab_invent['tec_cuatro'];?></td>
    <?php } else { ?>
       <td><?php echo $lab_invent['teccuatro'];?></td>
    <?php }  ?>
    <td><?php echo $lab_invent['subtotal_cuatro'];?></td>
    <td><?php echo $lab_invent['arreglo_total'];?></td>
    <?php  if ($_POST['enviar']=='DGTIC'){ ?>
       <td><?php echo $lab_invent['id_tec_com'];?></td>
    <?php } else { ?>
    <td><?php echo $lab_invent['nombre_tec_com'];?></td>
    <?php }  ?>
    <td><?php echo $lab_invent['tec_com_otro'];?></td>
    <?php  if ($_POST['enviar']=='DGTIC'){ ?>
       <td><?php echo $lab_invent['sist_oper'];?></td>
    <?php } else { ?>
    <td><?php echo $lab_invent['nombre_so'];?></td>
    <?php }  ?>
    <td><?php echo $lab_invent['version_sist_oper'];?></td>
    <td><?php echo $lab_invent['licencia'];?></td>
    <td><?php echo $lab_invent['licencia_ini'];?></td><!-- echo date("d-m-Y", strtotime($lab_invent['licencia_ini']));-->
    <td><?php echo $lab_invent['licencia_fin'];?></td>
  
  </tr>
  
 
 <?php }  ?>
</table>


