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
$esquema=new inventario();
$madq = new inventario();

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
if ($_SESSION['nivel']==2){
$query= "SELECT  e.*, ct.nombre_tecnologia as nomtec,
cequ.nombre_esquema as esquemauno,
         ceqd.nombre_esquema as esquemados, 
         ceqt.nombre_esquema as esquematres,
         ceqc.nombre_esquema as esquemacuatro,
		 ctu.nombre_tecnologia as tecuno,
		 ctd.nombre_tecnologia as tecdos,
		 ctt.nombre_tecnologia as tectres,
		 ctc.nombre_tecnologia as teccuatro,
         l.nombre as laboratorio, bi.*,* 
         FROM dispositivo e 
         LEFT JOIN cat_dispositivo cd
         ON e.dispositivo_clave=cd.dispositivo_clave
         LEFT JOIN cat_familia cf
         ON e.familia_clave=cf.id_familia
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
join cat_usuario_final uf
on uf.usuario_final_clave=e.usuario_final_clave
join cat_usuario_perfil up
on up.id_usuario_perfil=e.usuario_perfil
join cat_usuario_sector us
on us.id_usuario_sector=e.usuario_sector

left join cat_esquema cequ
on e.esquema_uno=cequ.id_esquema
left join cat_esquema ceqd
on e.esquema_dos=ceqd.id_esquema
left join cat_esquema ceqt
on e.esquema_tres=ceqt.id_esquema
left join cat_esquema ceqc
on e.esquema_tres=ceqc.id_esquema
left join cat_tecnologia ctu
on e.tec_uno=ctu.id_tecnologia
left join cat_tecnologia ctd
on e.tec_dos=ctd.id_tecnologia
left join cat_tecnologia ctt
on e.tec_tres=ctt.id_tecnologia
left join cat_tecnologia ctc
on e.tec_cuatro=ctc.id_tecnologia
left join cat_tec_com ctcom
on ctcom.id_tec_com=e.tec_com
where div.id_div=" . $_SESSION['id_div'] .
"order by laboratorio" ;
}else if ($_SESSION['nivel']==3){
$query= "SELECT  e.*, ct.nombre_tecnologia as nomtec,
cequ.nombre_esquema as esquemauno,
         ceqd.nombre_esquema as esquemados, 
         ceqt.nombre_esquema as esquematres,
         ceqc.nombre_esquema as esquemacuatro,
		 ctu.nombre_tecnologia as tecuno,
		 ctd.nombre_tecnologia as tecdos,
		 ctt.nombre_tecnologia as tectres,
		 ctc.nombre_tecnologia as teccuatro,
         l.nombre as laboratorio, bi.*,* 
         FROM dispositivo e 
         LEFT JOIN cat_dispositivo cd
         ON e.dispositivo_clave=cd.dispositivo_clave
         LEFT JOIN cat_familia cf
         ON e.familia_clave=cf.id_familia
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
join coordinacion co
co.id_coord=d.id_coord
join divisiones div
on div.id_div=co.id_div
left join cat_modo_adq cma
on e.id_mod=cma.id_mod
join cat_usuario_final uf
on uf.usuario_final_clave=e.usuario_final_clave
join cat_usuario_perfil up
on up.id_usuario_perfil=e.usuario_perfil
join cat_usuario_sector us
on us.id_usuario_sector=e.usuario_sector

left join cat_esquema cequ
on e.esquema_uno=cequ.id_esquema
left join cat_esquema ceqd
on e.esquema_dos=ceqd.id_esquema
left join cat_esquema ceqt
on e.esquema_tres=ceqt.id_esquema
left join cat_esquema ceqc
on e.esquema_tres=ceqc.id_esquema
left join cat_tecnologia ctu
on e.tec_uno=ctu.id_tecnologia
left join cat_tecnologia ctd
on e.tec_dos=ctd.id_tecnologia
left join cat_tecnologia ctt
on e.tec_tres=ctt.id_tecnologia
left join cat_tecnologia ctc
on e.tec_cuatro=ctc.id_tecnologia
left join cat_tec_com ctcom
on ctcom.id_tec_com=e.tec_com
where div.id_div=" . $_SESSION['id_div'] .
"order by laboratorio";



}


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
    <th scope="col">Área</th>
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
   while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ ?>
        
<table border="1">
  <tr>
     <td><?php echo $lab_invent['nombre'];?></td>
     <td><?php echo $lab_invent['laboratorio'];?></td>
   <?php  if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $lab_invent['dispositivo_clave'];?></td>
   <?php } else {  ?>
     <td><?php echo $lab_invent['nombre_dispositivo'];?></td>
   <?php }
   if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $lab_invent['usuario_final_clave'];?></td>
   <?php } else {  ?>
     <td><?php echo $lab_invent['tipo_usuario'];?></td>
   <?php }
    if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $lab_invent['familia_clave'];?></td>
   <?php } else { ?> 
      <td><?php echo $lab_invent['nombre_familia'];?></td>
   <?php }
   if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $lab_invent['tipo_ram_clave'];?></td>
   <?php }  else {?>
      <td><?php echo $lab_invent['nombre_tipo_ram'];?></td>
   <?php }
    if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $lab_invent['tecnologia_clave'];?></td>
   <?php } else { ?> 
    <td><?php echo $lab_invent['nomtec'];?></td>
   <?php }  ?>
    <td><?php echo $lab_invent['resguardo_no_empleado'];?></td>
    <td><?php echo $lab_invent['nombre_resguardo'];?></td>
    <td><?php echo $lab_invent['usuario_nombre'];?></td>
    <td><?php echo $lab_invent['usuario_ubicacion'];?></td> 
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $lab_invent['usuario_perfil'];?></td> 
    <?php } else { ?>
       <td><?php echo $lab_invent['nombre_perfil'];?></td>
    <?php }  ?>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
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
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $lab_invent['esquema_uno'];?></td>
    <?php } else { ?>
       <td><?php echo $lab_invent['esquemauno'];?></td>
    <?php }  ?>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
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
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $lab_invent['tec_dos'];?></td>
    <?php } else { ?>
      <td><?php echo $lab_invent['tecdos'];?></td>
    <?php }  ?>
    <td><?php echo $lab_invent['subtotal_dos'];?></td>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $lab_invent['esquema_tres'];?></td>
    <?php }  else {?>
    <td><?php echo $lab_invent['esquematres'];?></td>
    
    <?php }
	 if ($_POST['enviar']=='Con identificador'){ ?>
      <td><?php echo $lab_invent['tec_tres'];?></td>
    <?php }  else { ?>
      <td><?php echo $lab_invent['tectres'];?></td>
    <?php }  ?>
    <td><?php echo $lab_invent['subtotal_tres'];?></td>
    <?php if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $lab_invent['esquema_cuatro'];?></td>
    <?php }  else { ?>
    <td><?php echo $lab_invent['esquemacuatro'];?></td>
    <?php }
	if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $lab_invent['tec_cuatro'];?></td>
    <?php } else { ?>
       <td><?php echo $lab_invent['teccuatro'];?></td>
    <?php }  ?>
    <td><?php echo $lab_invent['subtotal_cuatro'];?></td>
    <td><?php echo $lab_invent['arreglo_total'];?></td>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $lab_invent['id_tec_com'];?></td>
    <?php } else { ?>
    <td><?php echo $lab_invent['nombre_tec_com'];?></td>
    <?php }  ?>
    <td><?php echo $lab_invent['tec_com_otro'];?></td>
    <?php  if ($_POST['enviar']=='Con identificador'){ ?>
       <td><?php echo $lab_invent['sist_oper'];?></td>
    <?php } else { ?>
    <td><?php echo $lab_invent['nombre_so'];?></td>
    <?php }  ?>
    <td><?php echo $lab_invent['version_sist_oper'];?></td>
    <td><?php echo $lab_invent['licencia'];?></td>
    <td><?php echo $lab_invent['licencia_ini'];?></td><!-- echo date("d-m-Y", strtotime($lab_invent['licencia_ini']));-->
    <td><?php echo $lab_invent['licencia_fin'];?></td>
    <td><?php echo $lab_invent['modo'];?></td>
     
  </tr>
  
 
 <?php }  ?>
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
 
 


