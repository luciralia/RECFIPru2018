<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/requerimientos.class.php');
require_once('../clases/inventario.class.php');
require_once('../clases/bitacora.class.php');
require_once('../clases/log.class.php');
require_once('../clases/exporta.class.php');

$obj_cotiza = new Cotiza();
$lab = new laboratorios();
$obj_req= new Requerimiento();
$logger=new Log();
$obj_bit=new Bitacora();
$obj_exporta=new Exportaxls();



if ($_GET['mod']=='serv'){
$tiposerv="(em.tipo_serv IS NULL OR em.tipo_serv IS FALSE) ";
} else {$tiposerv='TRUE';
$tiposerv="em.tipo_serv IS TRUE";
}

if ($_GET['mod']=='servibf'){
$tipomant=" AND em.tipo_mant='C'";
} 
else if($_GET['mod']=='servibp'){ 
$tipomant=" AND em.tipo_mant='P'";
} else {$tipomant=" ";}

if ($_SESSION['tipo_usuario']==9 && ($_GET['lab']!='' && $_GET['div']!='') ){
/*$query = "SELECT l.id_lab as id_lab, em.id_evento as id_evento, em.id_bitacora as id_bitacora, em.tipo_mant as tipo, em.fecha as fregistro, em.tipo_falla as falla, em.usuario_reporta as reporta, em.fecha_salida as fsalida, em.fecha_recepcion as frecepcion, em.costo as costo, em.fecha_prox_mant as fprox, em.descripcion as desc_serv, em.garantia as garantia, bi.bn_desc as bn_desc, bi.bn_marca as marca, bi.bn_modelo as modelo, bi.bn_serie as serie, bi.bn_clave as clave, l.nombre AS laboratorio, dp.nombre AS departamento, dv.nombre AS division, u.nombre AS RL_Nombre, u.a_paterno AS RL_apaterno, u.a_materno AS RL_amaterno, em.id_cotizacion as id_cotizacion, em.ok as sitio, em.tipo_serv, e.bn_id as bn_id, em.semestre as semestre, em.actividad as actividad, em.supervisor as supervisor, em.detecto as detecto 
FROM eventos_mantenimiento em, bitacora b, dispositivo e, bienes_inventario bi, laboratorios l, departamentos dp, divisiones dv, usuarios u 
WHERE em.id_bitacora = b.id_bitacora 
AND bi.bn_id = e.bn_id 
AND e.bn_id = em.id_equipo 
AND e.id_lab = b.id_lab 
AND l.id_lab = e.id_lab 
AND l.id_dep = dp.id_dep 
AND dp.id_div = dv.id_div
AND l.id_responsable=u.id_usuario" .$tipomant. " 
AND " . $tiposerv . " 
AND l.id_lab=";*/
	$query="SELECT l.id_lab as id_lab, em.id_evento as id_evento, em.id_bitacora as id_bitacora, 
em.tipo_mant as tipo, em.fecha as fregistro, em.tipo_falla as falla, 
em.usuario_reporta as reporta, em.fecha_salida as fsalida, 
em.fecha_recepcion as frecepcion, em.costo as costo, 
em.fecha_prox_mant as fprox, em.descripcion as desc_serv, 
em.garantia as garantia, bi.bn_desc as bn_desc, bi.bn_marca as marca, 
bi.bn_modelo as modelo, bi.bn_serie as serie, bi.bn_clave as clave, 
l.nombre AS laboratorio, dp.nombre AS departamento, dv.nombre AS division,
u.nombre AS RL_Nombre, u.a_paterno AS RL_apaterno, u.a_materno AS RL_amaterno, 
em.id_cotizacion as id_cotizacion, em.ok as sitio, em.tipo_serv, 
e.bn_id as bn_id, em.semestre as semestre, em.actividad as actividad, 
em.supervisor as supervisor, em.detecto as detecto
FROM eventos_mantenimiento em
JOIN  bitacora b
ON em.id_bitacora = b.id_bitacora 
JOIN dispositivo e
ON e.bn_id = em.id_equipo
JOIN bienes bi
ON e.bn_id = bi.bn_id 
JOIN laboratorios l
ON l.id_lab = e.id_lab 
JOIN departamentos dp
ON l.id_dep = dp.id_dep
JOIN divisiones dv
ON dp.id_div = dv.id_div
JOIN usuarios u
ON l.id_responsable=u.id_usuario
WHERE " .$tiposerv . $tipomant .
" AND l.id_lab= ";		
	switch ($_GET['orden']){
 			case "equipo":
			$query.= $_GET['lab'] . " ORDER BY bn_desc asc, fregistro DESC";
//			return $query;
 			break;
 			case "clave":
			$query.= $_GET['lab'] . " ORDER BY clave ASC";
 			break;
 			case "reciente":
			$query.= $_GET['lab'] . " ORDER BY fregistro DESC";
 			break;
			case "antiguo":
			$query.= $_GET['lab'] . " ORDER BY fregistro ASC";
 			break;
 			default:
			$query.=$_GET['lab'] .  " ORDER BY tipo, fregistro DESC";
	//		return $query;
 			break;
}
	
}else if ($_SESSION['tipo_usuario']==9 && $_GET['lab']=='' && $_GET['div']!=''){
	$query = "SELECT l.id_lab as id_lab, em.id_evento as id_evento, em.id_bitacora as id_bitacora, 
em.tipo_mant as tipo, em.fecha as fregistro, em.tipo_falla as falla, 
em.usuario_reporta as reporta, em.fecha_salida as fsalida, 
em.fecha_recepcion as frecepcion, em.costo as costo, 
em.fecha_prox_mant as fprox, em.descripcion as desc_serv, 
em.garantia as garantia, bi.bn_desc as bn_desc, bi.bn_marca as marca, 
bi.bn_modelo as modelo, bi.bn_serie as serie, bi.bn_clave as clave, 
l.nombre AS laboratorio, dp.nombre AS departamento, dv.nombre AS division,
u.nombre AS RL_Nombre, u.a_paterno AS RL_apaterno, u.a_materno AS RL_amaterno, 
em.id_cotizacion as id_cotizacion, em.ok as sitio, em.tipo_serv, 
e.bn_id as bn_id, em.semestre as semestre, em.actividad as actividad, 
em.supervisor as supervisor, em.detecto as detecto
FROM eventos_mantenimiento em
JOIN  bitacora b
ON em.id_bitacora = b.id_bitacora 
JOIN dispositivo e
ON e.bn_id = em.id_equipo
JOIN bienes bi
ON e.bn_id = bi.bn_id 
JOIN laboratorios l
ON l.id_lab = e.id_lab 
JOIN departamentos dp
ON l.id_dep = dp.id_dep
JOIN divisiones dv
ON dp.id_div = dv.id_div
JOIN usuarios u
ON l.id_responsable=u.id_usuario
WHERE " .$tiposerv . $tipomant .
		
 " AND dv.id_div= ".$_REQUEST['div'];
	
}else if ($_SESSION['tipo_usuario']==10 && $_GET['div']!='') {
$query = "SELECT l.id_lab as id_lab, em.id_evento as id_evento, em.id_bitacora as id_bitacora, 
em.tipo_mant as tipo, em.fecha as fregistro, em.tipo_falla as falla, 
em.usuario_reporta as reporta, em.fecha_salida as fsalida, 
em.fecha_recepcion as frecepcion, em.costo as costo, 
em.fecha_prox_mant as fprox, em.descripcion as desc_serv, 
em.garantia as garantia, bi.bn_desc as bn_desc, bi.bn_marca as marca, 
bi.bn_modelo as modelo, bi.bn_serie as serie, bi.bn_clave as clave, 
l.nombre AS laboratorio, dp.nombre AS departamento, dv.nombre AS division,
u.nombre AS RL_Nombre, u.a_paterno AS RL_apaterno, u.a_materno AS RL_amaterno, 
em.id_cotizacion as id_cotizacion, em.ok as sitio, em.tipo_serv, 
e.bn_id as bn_id, em.semestre as semestre, em.actividad as actividad, 
em.supervisor as supervisor, em.detecto as detecto
FROM eventos_mantenimiento em
JOIN  bitacora b
ON em.id_bitacora = b.id_bitacora 
JOIN dispositivo e
ON e.bn_id = em.id_equipo
JOIN bienes bi
ON e.bn_id = bi.bn_id 
JOIN laboratorios l
ON l.id_lab = e.id_lab 
JOIN departamentos dp
ON l.id_dep = dp.id_dep
JOIN divisiones dv
ON dp.id_div = dv.id_div
JOIN usuarios u
ON l.id_responsable=u.id_usuario
WHERE "  .$tiposerv . $tipomant .
		
 " AND dv.id_div= ".$_REQUEST['div'];
	
}else if ($_SESSION['tipo_usuario']==10 &&  $_GET['div']==NULL) {
	$query = "SELECT l.id_lab as id_lab, em.id_evento as id_evento, em.id_bitacora as id_bitacora, 
em.tipo_mant as tipo, em.fecha as fregistro, em.tipo_falla as falla, 
em.usuario_reporta as reporta, em.fecha_salida as fsalida, 
em.fecha_recepcion as frecepcion, em.costo as costo, 
em.fecha_prox_mant as fprox, em.descripcion as desc_serv, 
em.garantia as garantia, bi.bn_desc as bn_desc, bi.bn_marca as marca, 
bi.bn_modelo as modelo, bi.bn_serie as serie, bi.bn_clave as clave, 
l.nombre AS laboratorio, dp.nombre AS departamento, dv.nombre AS division,
u.nombre AS RL_Nombre, u.a_paterno AS RL_apaterno, u.a_materno AS RL_amaterno, 
em.id_cotizacion as id_cotizacion, em.ok as sitio, em.tipo_serv, 
e.bn_id as bn_id, em.semestre as semestre, em.actividad as actividad, 
em.supervisor as supervisor, em.detecto as detecto
FROM eventos_mantenimiento em
JOIN  bitacora b
ON em.id_bitacora = b.id_bitacora 
JOIN dispositivo e
ON e.bn_id = em.id_equipo
JOIN bienes bi
ON e.bn_id = bi.bn_id 
JOIN laboratorios l
ON l.id_lab = e.id_lab 
JOIN departamentos dp
ON l.id_dep = dp.id_dep
JOIN divisiones dv
ON dp.id_div = dv.id_div
JOIN usuarios u
ON l.id_responsable=u.id_usuario
WHERE " .$tiposerv . $tipomant ;
}
//echo 'En cargaserv '.$query; 
?>

<?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&div=". $_REQUEST['div']. "&mod=". $_GET['mod'] .'&orden='. $_GET['orden'];?>
<!-- <form action="<?php echo $action1; ?>" method="post" name="fnuevo">
<p style="text-align: right"> <input name="accion" type="submit" value="nuevo" id="botonblu"/>
</form>-->
<?php if ($_GET['mod']=='servi'|| $_GET['mod']=='servibf' || $_GET['mod']=='servibp'){ $logger->putLog(47,2);?>
<!--<div style="text-align: right; display: inline-block;"> <div id="botonblu" > <a href="<?php echo $action1 . '&accion=nuevo';?>">Nuevo individual</a></div></div> -->
<div style="text-align: right; display: inline-block;"> 

<?php if ($_GET['mod']=='servi'){$texto_bot='Seleccionar equipos';} elseif ($_GET['mod']=='servibf' || $_GET['mod']=='servibp') { $logger->putLog(53,2); $texto_bot='Agregar servicio para bit&aacute;cora'; }

?>
<?php //if (($_SESSION['permisos'][2]%3)==0){ ?><div id="botonblu" > 
	
	<a href="<?php echo $action1 . '&accion=nuevob';?>"><?php echo $texto_bot;?></a></div><?php }?>
	
	
</div>	
<?php //} else 
	if  ($_SESSION['tipo_usuario']!=10)  { $logger->putLog(23,2);?>

<div style="text-align: right"><?php //if (($_SESSION['permisos'][2]%3)==0){ ?> <div id="botonblu" > <a href="<?php echo $action1 . '&accion=nuevob';?>">Nueva solicitud</a></div><?php }?></div>	
<?php //}?>

<div class="block" id="necesidades_content">    
  
<table><tr>
<?php 		 //echo "Responsable: " . $lab->getResponsable($_SESSION['id_usuario']); echo " Tipo de servicio: " . $_GET['mod'];
	
	if($_GET['mod']=='serv' || $_GET['mod']=='servi'){ 
		
	    $datos = pg_query($con,$query);

        $inventario= pg_num_rows($datos); 
	if ($inventario!=0 ){ 
	?> 
<td></br>
<form action="inicio.html.php" method="get" name="orderby">
        Ordenar por: <select name="orden">
          <option value="orden" <?php echo $sel=(!isset($_GET['orden'])||$_GET['orden']=='orden') ? 'selected="selected"':''; ?>>Seleccione...</option>
          <option value="equipo" <?php echo $sel=($_GET['orden']=='equipo')? 'selected="selected"': "";?>>Equipo</option>
          <option value="clave" <?php echo $sel=($_GET['orden']=='clave')? 'selected="selected"': "";?>>No. Inventario</option>
          <option value="orden" <?php echo $sel=($_GET['orden']=='orden')? 'selected="selected"': "";?>>Tipo</option>
          <option value="reciente" <?php echo $sel=($_GET['orden']=='reciente')? 'selected="selected"': "";?>>Más reciente</option>
          <option value="antiguo" <?php echo $sel=($_GET['orden']=='antiguo')? 'selected="selected"': "";?>>Más antiguo</option>
           </select>
    
	<?php
	echo "<input name='lab' type='hidden' value='". $_GET['lab']."' /> \n";
	echo "<input name='mod' type='hidden' value='". $_GET['mod']."' /> \n";
	echo "<input name='div' type='hidden' value='". $_REQUEST['div']."' /> \n";													  
	?>

<input name="bOrden" type="submit" value="ordenar" />
</form></br></td>

<td>
<br />
    <form action="../inc/exportaxls_serv.inc.php" method="post" name="servbit" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	<input name="enviar" type="submit" value="Exportar a excel" />
	<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
	<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
	<input name="div" type="hidden" value="<?php echo $_REQUEST['div'];?>" />
	</form>
    <br />
</td>
</tr></table>
<?php } 
	}// Termina el if de la opción de ordenar y exportar a excel
?>

<?php 
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 

if ($inventario!=0 ){ 
	
if($_GET['mod']=='servibf' || $_GET['mod']=='servibp'){ 
$action=($_GET['mod']=='servibf')?'../inc/excelbf2.inc.php':'../inc/excelbp2.inc.php';
	
?>
   <br />
  <form action="<?php echo $action; ?>" method="post" name="servbit" >
	<input name="enviar" type="submit" value="Generar bitácora" />
	<?php
	$obj_bit->tblServ($_GET['lab'],$_GET['mod'],$_REQUEST['div'],$_SESSION['tipo_usuario'] );
	?>
	</form>
    <br />
<?php  }
 } 
 ?>


<?php

if($_GET['mod']=='serv' || $_GET['mod']=='servi'){  //If para que haga la tabla solo si no es para bitácora
	
	$datos = pg_query($con,$query) or die('Existe un error con la base de datos' . pg_result_error($datos));
			
    $inventario= pg_num_rows($datos); 
	
	if ($inventario!=0 ){

		while ($serv_mant = pg_fetch_array($datos, NULL, PGSQL_ASSOC)) 
			 { 
	?>
	
<table class='serviciosm'>
<tr>
<th width="86" scope="col">Inventario</th>
    <th width="150" scope="col">Equipo</th>
    <th width="113" scope="col">Tipo de mantenimiento</th>
<?php if ($_REQUEST['mod']=='serv'){?>
    <th width="99" scope="col">Costo (cotizado MX)</th>
<?php }?>
    <th width="233" scope="col">Descripción del Servicio</th>
<!--    <th width="88" scope="col">Proveedor</th>-->
<?php if ($_REQUEST['mod']=='serv'){?>
    <th width="88" scope="col">Cotización</th>
<?php }?>
    <th width="63" scope="col">Inicio</th>
    <th width="64" scope="col">Término</th>
  </tr>
  <tr>
    <td><?php echo $serv_mant['clave'];?></td>
    <td><?php echo $serv_mant['bn_desc'];?></td>
    <td><?php echo $tipo=($serv_mant['tipo']=='C')?"Correctivo":"Preventivo";?></td>
<?php if ($_REQUEST['mod']=='serv'){?>
    <td><?php echo $serv_mant['costo'];?></td>
 <?php }?>
    <td><?php echo $serv_mant['falla'];?></td>
<!--    <td><?php echo $serv_mant['provedor'];?></td>-->
<?php if ($_REQUEST['mod']=='serv'){?>
    <td><?php echo $obj_cotiza->getCotiza($serv_mant['id_cotizacion']); ?></td>
 <?php }?>
    <td><?php echo date("d-m-Y", strtotime($serv_mant['fsalida']));?></td>
    <td><?php echo date("d-m-Y", strtotime($serv_mant['frecepcion']));?></td>
</tr>
       <?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&div=". $_REQUEST['div'] ."&mod=". $_GET['mod'] .'&orden='. $_REQUEST['orden'];?>
<form action="<?php echo $action; ?>" method="post" name="req_mat_<?php echo $form=$serv_mant['id_lab'] ."_".$serv_mant['id_req'];?>">

<?php if ($_REQUEST['mod']=='serv' ){ $colspan=6;} else { $colspan=7;}                    ?> 
  <tr >
   <?php   if ( $_SESSION['tipo_usuario']!=10) { ?>
    <td style="text-align: right" colspan="<?php echo $colspan; ?>">
  	<input name="accion" type="submit" value="borrar" />
  </td>
  <?php  } ?>
  <td style="text-align: right">
  <?php //if (($_SESSION['permisos'][2]%3)==0  ){ ?>&nbsp;&nbsp;&nbsp;&nbsp;

	<?php  if ($_REQUEST['mod']!='servibf' && $_REQUEST['mod']!='servibp' && $_SESSION['tipo_usuario']!=10){ ?>
  		<input name="accion" type="submit" value="editar" />
  	<?php }?>
  <?php //} ?>

			<?php
			foreach ($serv_mant as $campo => $valor) {
			        //echo "\$usuario[$campo] => $valor.\n" . "</br>";
			echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
			
			}
			?>
  <input name="mod" type="hidden" value="<?php echo $_GET['mod'];?>" />
  </form>
  </td>
  <td style="text-align: right">
	
	
<?php	if ($_REQUEST['mod']=='servibf' ){ $destino="../inc/excelbf.inc.php";} else if ($_REQUEST['mod']=='servibp'){ $destino="../inc/excelbp.inc.php";
																												}
?>
	
	<form action="<?php echo $destino; ?>" method="post">
  
			  <?php
				foreach ($serv_mant as $campo => $valor) {
				        //echo "\$usuario[$campo] => $valor.\n" . "</br>";
				echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
				}
			?>

		  <?php 
		  
		  if ($_REQUEST['mod']=='servibf'|| $_REQUEST['mod']=='servibp'){ ?>&nbsp;&nbsp;&nbsp;&nbsp;
			<input name="accion" type="submit" value="formato" />
  	
		  <?php }?>
		
	   <input name="mod" type="hidden" value="<?php echo $_GET['mod'];?>" />
	</form>
  </td>
    
  </tr>

	<?php	
			 }//fin if servibf or servibp
	     }
		
    }else { ?>
             
            <!--<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 
             <tr> <td align="center"> <h3>No existen necesidades* registradas.</h3> </td></tr>-->
	  
		<?php }
   ?>


 
</table>

  </br>
 </div>