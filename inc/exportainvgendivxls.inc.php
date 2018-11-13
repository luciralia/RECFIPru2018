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
//echo 'imprime la sesion';
//print_r ($_SESSION);

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
$texto='Content-Disposition: attachment;filename="inventariogendiv_' . date("Ymd-His") . "_" . $nombdiv[0]. '.xls"';
header($texto);

?>

<table>
   <tr>
      <td align="center" ><h2>Inventario General por División</h2></td>
      
   </tr>
  <tr></tr>

</table>
  
  
<?php

$query= "select  e.*, l.nombre as laboratorio, bi.*,* 
from dispositivo e 

left join cat_dispositivo cd
on e.dispositivo_clave=cd.dispositivo_clave
left join cat_familia cf
on e.familia_clave=cf.id_familia
left join cat_tipo_ram ctr
on e.tipo_ram_clave=ctr.id_tipo_ram
left join cat_tecnologia ct
on e.tecnologia_clave=ct.id_tecnologia
left join cat_sist_oper cso
on  e.sist_oper=cso.id_sist_oper
left join cat_marca cm
on cm.id_marca=e.id_marca
left join cat_memoria_ram cmr
on e.id_mem_ram=cmr.id_mem_ram
left join bienes_inventario bi
on  e.bn_id = bi.bn_id
join laboratorios l
on  l.id_lab=e.id_lab
join departamentos d
on d.id_dep=l.id_dep
join divisiones div
on div.id_div=d.id_div
left join cat_modo_adq cma
on e.id_mod=cma.id_mod
where div.id_div=" . $_SESSION['id_div'] .
"order by laboratorio" ;

 $datos = pg_query($con,$query);
 $inventario= pg_num_rows($datos); 
?>


<tr>
      <td align="center" ><h2> Inventario de Cómputo</h2></td>
      
   </tr>
  <tr></tr>
  
<table border="1">

  <tr>
    <th scope="col">División</th>
    <th scope="col">Laboratorio</th>
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
    <th scope="col">Modo de Adquisición</th>
 </tr>
 <?php


while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ ?>
        
<table border="1">
  <tr>
    <td><?php echo $lab_invent['nombre'];?></td>
    <td><?php echo $lab_invent['laboratorio'];?></td>
    <td><?php echo $lab_invent['nombre_dispositivo'];?></td>
    <td><?php echo $lab_invent['tipo_usuario'];?></td>
    <td><?php echo $lab_invent['usuario_nombre'];?></td>
    <td><?php echo $lab_invent['resguardo_no_empleado'];?></td>
    <td><?php echo $lab_invent['usuario_nombre'];?></td>
    <td><?php echo $lab_invent['usuario_ubicacion'];?></td>
    <td><?php echo $lab_invent['nombre_perfil'];?></td>
    <td><?php echo $lab_invent['nombre_sector'];?></td>
    <td><?php echo $lab_invent['serie'];?></td>
    <td><?php echo $lab_invent['inventario'];?></td>
    <td><?php echo $lab_invent['marca_p'];?></td>
    <td><?php echo $lab_invent['modelo_p'];?></td>
    <td><?php echo $lab_invent['no_factura'];?></td>
    <td><?php echo $lab_invent['proveedor_p'];?></td>
    <td><?php echo $lab_invent['anos_garantia'];?></td>
    <td><?php echo date("d-m-Y", strtotime($lab_invent['fecha_factura']));?></td>
    <td><?php echo $lab_invent['nombre_familia'];?></td>
    <td><?php echo $lab_invent['familia_especificar'];?></td>
    <td><?php echo $lab_invent['modelo_procesador'];?></td>
    <td><?php echo $lab_invent['cantidad_procesador'];?></td>
    <td><?php echo $lab_invent['nucleos_totales'];?></td>
    <td><?php echo $lab_invent['nucleos_gpu'];?></td>
    <td><?php echo $lab_invent['memoria_ram'];?></td>
    <td><?php echo $lab_invent['nombre_tipo_ram'];?></td>
    <td><?php echo $lab_invent['ram_especificar'];?></td>
    <td><?php echo $lab_invent['num_elementos_almac'];?></td>
    <td><?php echo $lab_invent['nombre_tecnologia'];?></td>
    <td><?php echo $lab_invent['total_almac'];?></td>
    <td><?php echo $lab_invent['numero_arreglos'];?></td>
    <td><?php echo $lab_invent['esquema_uno'];?></td>
    <td><?php echo $lab_invent['tec_uno'];?></td>
    <td><?php echo $lab_invent['subtotal_uno'];?></td>
    <td><?php echo $lab_invent['esquema_dos'];?></td>
    <td><?php echo $lab_invent['tec_dos'];?></td>
    <td><?php echo $lab_invent['subtotal_dos'];?></td>
    <td><?php echo $lab_invent['esquema_tres'];?></td>
    <td><?php echo $lab_invent['tec_tres'];?></td>
    <td><?php echo $lab_invent['subtotal_tres'];?></td>
    <td><?php echo $lab_invent['esquema_cuatro'];?></td>
    <td><?php echo $lab_invent['tec_cuatro'];?></td>
    <td><?php echo $lab_invent['subtotal_cuatro'];?></td>
    <td><?php echo $lab_invent['arreglo_total'];?></td>
    <td><?php echo $lab_invent['tec_com'];?></td>
    <td><?php echo $lab_invent['tec_com_otro'];?></td>
    <td><?php echo $lab_invent['nombre_so'];?></td>
    <td><?php echo $lab_invent['version_sist_oper'];?></td>
    <td><?php echo $lab_invent['licencia'];?></td>
    <td><?php echo date("d-m-Y", strtotime($lab_invent['licencia_ini']));?></td>
    <td><?php echo date("d-m-Y", strtotime($lab_invent['licencia_fin']));?></td>
    <td><?php echo $lab_invent['modo'];?></td>
  </tr>
  
 
 <?php } 
  ?>
</table>


<?php 
/*
	$query = "select e.*, l.nombre as laboratorio, bi.* 
         from equipo e
		 left join bienes_inventario bi
		 on e.bn_id=bi.bn_id
		 
         join laboratorios l
         on  l.id_lab=e.id_lab
         join departamentos d
         on d.id_dep=l.id_dep
         join divisiones div
         on div.id_div=d.id_div
		 left join cat_modo_adq cma
		 on cma.id_mod=e.id_mod
         where div.id_div=" . $_SESSION['id_div'] .
		 "order by laboratorio" ;
		
	$datos = pg_query($con,$query);
     $inventario= pg_num_rows($datos); 
	 */
 ?>
<!--
 <table>
<tr>
      <td align="center" ><h2> Inventario de Equipo Experimental</h2></td>

</tr>
</table>
	
  <table border="1">
  <tr>
    <th scope="col">División</th>
    <th scope="col">Laboratorio</th>
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
while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ ?>
        
  <tr>
    <td><?php echo $lab_invent['nombre'];?></td>
    <td><?php echo $lab_invent['laboratorio'];?></td>
    <td><?php echo $lab_invent['bn_clave'];?></td>
    <td><?php echo $lab_invent['bn_anterior'];?></td>
    <td><?php echo $lab_invent['bn_desc'];?></td>
    <td><?php echo $lab_invent['bien'];?></td>
    <td><?php echo $lab_invent['bn_marca'];?></td>
    <td><?php echo $lab_invent['bn_modelo'];?></td>
    <td><?php echo $lab_invent['bn_serie'];?></td>
    <td><?php echo date("d-m-Y", strtotime($lab_invent['bn_fadq']));?></td>
    <td><?php echo $lab_invent['co_descr'];?></td>
    <td><?php echo $madq->getModo($lab_invent['id_mod']); ?></td>
  </tr>
  
  <?php }
  */
  ?>
  <!--
  </table> -->  
 
 


