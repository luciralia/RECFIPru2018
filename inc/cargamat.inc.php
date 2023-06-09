<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/requerimientos.class.php');
require_once('../clases/laboratorios.class.php');
$obj_cotiza = new Cotiza();
$lab = new laboratorios();
$obj_req= new Requerimiento();

if ($_SESSION['tipo_usuario']==9 && ($_GET['lab']!='' && $_GET['div']!='') ){
// Consulta con catalogo de justificacion de equipo y no de materiales
$query = "SELECT DISTINCT rm.id_req AS id_req, rm.id_lab AS id_lab,cant, rm.descripcion AS descripcion, rm.unidad_medida AS medida, cpn.descripcion AS plazo, l.nombre AS laboratorio, dp.nombre AS departamento, di.nombre AS division, cto_unitario AS costo, act_generales AS actividades, cjnm.descripcion AS motivo, cjnm.id AS num_just, impacto AS justificacion, rm.id_cotizacion AS id_cotizacion, rm.ref AS ref
FROM req_mat rm, laboratorios l, divisiones di, departamentos dp, cat_plazo_nec cpn, cat_juztificacion_nec cjnm 
WHERE rm.id_lab=l.id_lab 
AND l.id_dep=dp.id_dep 
AND dp.id_div=di.id_div 
AND plazo=cpn.id 
AND justificacion=cjnm.id
AND l.id_lab=";


switch ($_GET['orden']){
 			case "descripcion":
			$query.= $_GET['lab'] . " order by descripcion asc";
//			return $query;
 			break;
 			case "reciente":
			$query.= $_GET['lab'] . " order by rm.ref desc";
 			break;
			case "antiguo":
			$query.= $_GET['lab'] . " order by rm.ref asc";
 			break;
 			default:
			$query.= $_GET['lab'] . " order by rm.ref desc";
	//		return $query;
 			break;
}

}
else if ($_SESSION['tipo_usuario']==9 && $_GET['lab']=='' && $_GET['div']!=''){
	$query = "SELECT DISTINCT rm.id_req as id_req, rm.id_lab as id_lab,cant, rm.descripcion as descripcion, rm.unidad_medida as medida, cpn.descripcion as plazo, l.nombre as laboratorio, dp.nombre as departamento, di.nombre as division, cto_unitario as costo, act_generales as actividades, cjnm.descripcion as motivo, cjnm.id as num_just, impacto as justificacion, rm.id_cotizacion as id_cotizacion, rm.ref as ref
FROM req_mat rm, laboratorios l, divisiones di, departamentos dp, cat_plazo_nec cpn, cat_juztificacion_nec cjnm 
WHERE rm.id_lab=l.id_lab 
AND l.id_dep=dp.id_dep 
AND dp.id_div=di.id_div 
AND plazo=cpn.id 
AND justificacion=cjnm.id
AND di.id_div=".$_REQUEST['div'];
	
}else if ($_SESSION['tipo_usuario']==10 && $_GET['div']!='') {
	$query = "SELECT DISTINCT rm.id_req as id_req, rm.id_lab as id_lab,cant, rm.descripcion as descripcion, rm.unidad_medida as medida, cpn.descripcion as plazo, l.nombre as laboratorio, dp.nombre as departamento, di.nombre as division, cto_unitario as costo, act_generales as actividades, cjnm.descripcion as motivo, cjnm.id as num_just, impacto as justificacion, rm.id_cotizacion as id_cotizacion, rm.ref as ref
FROM req_mat rm, laboratorios l, divisiones di, departamentos dp, cat_plazo_nec cpn, cat_juztificacion_nec cjnm 
WHERE rm.id_lab=l.id_lab 
AND l.id_dep=dp.id_dep 
AND dp.id_div=di.id_div 
AND plazo=cpn.id 
AND justificacion=cjnm.id
AND di.id_div=".$_REQUEST['div'];
	
}else if ($_SESSION['tipo_usuario']==10 &&  $_GET['div']==NULL) {

	$query = "SELECT DISTINCT rm.id_req as id_req, rm.id_lab as id_lab,cant, rm.descripcion as descripcion, rm.unidad_medida as medida, cpn.descripcion as plazo, l.nombre as laboratorio, dp.nombre as departamento, di.nombre as division, cto_unitario as costo, act_generales as actividades, cjnm.descripcion as motivo, cjnm.id as num_just, impacto as justificacion, rm.id_cotizacion as id_cotizacion, rm.ref as ref
FROM req_mat rm, laboratorios l, divisiones di, departamentos dp, cat_plazo_nec cpn, cat_juztificacion_nec cjnm 
WHERE rm.id_lab=l.id_lab 
AND l.id_dep=dp.id_dep 
AND dp.id_div=di.id_div 
AND plazo=cpn.id 
AND justificacion=cjnm.id";
	
}
	
// echo 'Carga_material',$query; ?>

<?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']. "&div=". $_REQUEST['div'];?>
<?php $action2="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=servi". "&accion=nuevob" . "&div=". $_REQUEST['div'];?>
<!--<form action="<?php echo $action1; ?>" method="post" name="fnuevo">
<p style="text-align: right"> <input name="accion" type="submit" value="nuevo" id="botonblu"/>
</form>-->
<div style="text-align: right"> <div class="recuadro2" style="display:inline"><p>Estimado usuario: Favor de indicar el(los) equipo(s) que recibirá(n) mantenimiento con los componentes que está solicitando.</p> </div><div id="botonblu" > <a href="<?php echo $action2;?>">Selecciónando de equipo</a></div></div>
<div style="text-align: left"><?php //if (($_SESSION['permisos'][2]%3)==0){ ?> <div id="botonblu" > <a href="<?php echo $action1 . '&accion=nuevo';?>">Nueva solicitud</a></div><?php //}?></div>
<div class="block" id="necesidades_content">

<div class="block" id="necesidades_content">      

 <?php  
	$datos = pg_query($con,$query);
	
	$inventario= pg_num_rows($datos); 
	
	if ($inventario!=0 ){
	
	//echo "Responsable: " . $lab->getResponsable($_SESSION['id_usuario']); ?> 


<table><tr>
<td>
<form action="inicio.html.php" method="get" name="orderby">
        Ordenar por: <select name="orden">
          <option value="orden" <?php echo $sel=(!isset($_GET['orden'])||$_GET['orden']=='orden') ? 'selected="selected"':''; ?>>Seleccione...</option>
          <option value="descripcion" <?php echo $sel=($_GET['orden']=='descripcion')? 'selected="selected"': "";?>>Descripción</option>
          <option value="reciente" <?php echo $sel=($_GET['orden']=='reciente')? 'selected="selected"': "";?>>Más reciente</option>
          <option value="antiguo" <?php echo $sel=($_GET['orden']=='antiguo')? 'selected="selected"': "";?>>Más antiguo</option>
           </select>
    
<?php
	echo "<input name='lab' type='hidden' value='".$_GET['lab']."' /> \n";
	echo "<input name='mod' type='hidden' value='".$_GET['mod']."' /> \n";
	echo "<input name='div' type='hidden' value='".$_REQUEST['div']."' /> \n";
		?>

<input name="bOrden" type="submit" value="ordenar" />
</form>
</td>
<td>
<br />
    <form action="../inc/exportaxls_mat.inc.php" method="post" name="servbit" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	<input name="enviar" type="submit" value="Exportar a excel" />
	<input name="lab" type="hidden" value="<?php echo $_GET['lab'] ?>" />
	<input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
	<input name="div" type="hidden" value="<?php echo $_REQUEST['div']?>" />
	</form>
    <br />
</td>
</tr></table>
<?php
	 //fin de si no existe inventario
	$datos = pg_query($con,$query);
		   

		while ($lab_necmat = pg_fetch_array($datos, NULL, PGSQL_ASSOC)) 
			 { 

	?>
	
 <table class='material'>
  <tr>
<th width="54" scope="col">Cant</th>
    <th width="182" scope="col">Descripción</th>
    <th width="94" scope="col">Unidad de medida</th>
    <th width="96" scope="col">Precio Unitario (MX)</th>
    <th width="123" scope="col">Total</th>
    <th width="78" scope="col">Año</th>
    <th width="155" scope="col">Motivo</th>
    <th width="139" scope="col">Justificación</th>
    <th width="98" scope="col">Cotización</th>
  </tr>
  <tr>
    <td><?php echo $lab_necmat['cant'];?></td>
    <td><?php echo $lab_necmat['descripcion'];?></td>
    <td><?php echo $lab_necmat['medida'];?></td>
    <td><?php echo $lab_necmat['costo'];?></td>
    <td><?php echo $total=$lab_necmat['cant']*$lab_necmat['costo'];?></td>
    <td><?php echo /*$lab_necmat['plazo'];*/ $obj_req->getPlazo($lab_necmat['id_plazo'],'descripcion');?></td>
    <td align="right"><?php echo $lab_necmat['motivo'];?></td>
    <td align="right"><?php echo $lab_necmat['justificacion'];?></td>
    <td><?php echo $obj_cotiza->getCotiza($lab_necmat['id_cotizacion']); ?></td>
        
  </tr>
<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']. "&div=". $_REQUEST['div'];?>
<form action="<?php echo $action; ?>" method="post" name="req_mat_<?php echo $form=$lab_necmat['id_lab'] ."_".$lab_necmat['id_req'];?>">

  <tr ><td style="text-align: right" colspan="8"><input name="accion" type="submit" value="borrar" /></td><td style="text-align: right">&nbsp;&nbsp;&nbsp;&nbsp;<?php //if (($_SESSION['permisos'][2]%3)==0){ ?><input name="accion" type="submit" value="editar" /><?php //} ?></td></tr>


<?php
   foreach ($lab_necmat as $campo => $valor) {
        //echo "\$usuario[$campo] => $valor.\n" . "</br>";
       echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
   }
?>
<input name="mod" type="hidden" value="<?php echo $_GET['mod'];?>" />
</form>

	<?php	
			 }
	}else{ ?>
             
             <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
	         <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
	          <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
             <tr> <td align="center"> <h3>No existen órdenes de mantenimiento interno registradas.</h3> </td></tr>
	
		<?php } ?>
	 
	 </table>
    </br>                
	</br> 
 </div>