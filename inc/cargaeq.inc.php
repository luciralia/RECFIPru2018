 
<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/requerimientos.class.php');
$obj_cotiza = new Cotiza();
$lab = new laboratorios();
$obj_req= new Requerimiento();


//$query = "SELECT * FROM usuarios WHERE id_usuario =" . $_SESSION['id_usuario'];


/*$query = "select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre, a_paterno, a_materno, de.nombre as depa, di.nombre as div
from laboratorios l, departamentos de, divisiones di, usuarios u where l.id_responsable =" . $_SESSION['id_usuario'] . " 
and id_lab=" . $_REQUEST['lab'] . "
and l.id_dep=de.id_dep
and de.id_div=di.id_div
and l.id_responsable=u.id_usuario";*/
//echo $query; Tenìa id_lab=" . $_POST['lab'] . " LHH 30/marzo

//$logger->putLog(31,2)

if ($_SESSION['tipo_usuario']==9 && ($_GET['lab']!='' && $_GET['div']!='') ){

$query = "SELECT DISTINCT id_nec, ne.id_lab AS id_lab, cant, ne.descripcion, prioridad as id_prio, cpn.descripcion AS plazo, cpn.id AS id_plazo, l.nombre AS laboratorio, de.nombre AS departamento, dv.nombre AS division, cto_unitario AS costo, act_generales AS actividades, cjn.descripcion AS motivo, cjn.id AS id_just, impacto , id_cotizacion, cto_unitario, ref ,otrajust
FROM necesidades_equipo ne, laboratorios l, divisiones dv, departamentos de, cat_plazo_nec cpn, cat_juztificacion_nec cjn
WHERE ne.id_lab=l.id_lab 
AND l.id_dep=de.id_dep 
AND de.id_div=dv.id_div 
AND plazo=cpn.id 
AND justificacion=cjn.id
AND ne.id_lab=" . $_GET['lab'] . 
"ORDER BY id_nec DESC";
}if ($_SESSION['tipo_usuario']==9 && ($_GET['lab']!='' && $_GET['div']=='') ){
	
$query = "SELECT DISTINCT id_nec, ne.id_lab AS id_lab, cant, ne.descripcion, prioridad AS id_prio, cpn.descripcion AS plazo, cpn.id as id_plazo, l.nombre as laboratorio, de.nombre AS departamento, dv.nombre AS division, cto_unitario AS costo, act_generales AS actividades, cjn.descripcion AS motivo, cjn.id AS id_just, impacto , id_cotizacion, cto_unitario, ref ,otrajust
FROM necesidades_equipo ne, laboratorios l, divisiones dv, departamentos de, cat_plazo_nec cpn, cat_juztificacion_nec cjn
WHERE ne.id_lab=l.id_lab 
AND l.id_dep=de.id_dep 
AND de.id_div=dv.id_div 
AND plazo=cpn.id 
AND justificacion=cjn.id
AND ne.id_lab=" . $_GET['lab'] . 
"ORDER BY id_nec DESC";
}else if ($_SESSION['tipo_usuario']==9 && $_GET['lab']=='' && $_GET['div']!=''){
$query = "SELECT DISTINCT id_nec, ne.id_lab AS id_lab, cant, ne.descripcion, prioridad AS id_prio, cpn.descripcion AS plazo, cpn.id AS id_plazo, l.nombre AS laboratorio, de.nombre AS departamento, dv.nombre AS division, cto_unitario AS costo, act_generales AS actividades, cjn.descripcion AS motivo, cjn.id as id_just, impacto , id_cotizacion, cto_unitario, ref ,otrajust
FROM necesidades_equipo ne, laboratorios l, divisiones dv, departamentos de, cat_plazo_nec cpn, cat_juztificacion_nec cjn
WHERE ne.id_lab=l.id_lab 
AND l.id_dep=de.id_dep 
AND de.id_div=dv.id_div 
AND plazo=cpn.id 
AND justificacion=cjn.id
AND dv.id_div=" . $_GET['div'] . 
"ORDER BY id_nec DESC";	
} 
else if ($_SESSION['tipo_usuario']==10 && $_GET['div']!='') {
	
$query = "SELECT DISTINCT id_nec, ne.id_lab AS id_lab, cant, ne.descripcion, prioridad as id_prio, cpn.descripcion as plazo, cpn.id as id_plazo, l.nombre as laboratorio, de.nombre as departamento, dv.nombre as division, cto_unitario as costo, act_generales as actividades, cjn.descripcion as motivo, cjn.id as id_just, impacto , id_cotizacion, cto_unitario, ref ,otrajust
FROM necesidades_equipo ne, laboratorios l, divisiones dv, departamentos de, cat_plazo_nec cpn, cat_juztificacion_nec cjn
WHERE ne.id_lab=l.id_lab 
AND l.id_dep=de.id_dep 
AND de.id_div=dv.id_div 
AND plazo=cpn.id 
AND justificacion=cjn.id
AND dv.id_div=" . $_GET['div'] . 
"ORDER BY id_nec DESC";	
} else if ($_SESSION['tipo_usuario']==10 &&  $_GET['div']==NULL) {
	
$query = "SELECT DISTINCT id_nec, ne.id_lab AS id_lab, cant, ne.descripcion, prioridad as id_prio, cpn.descripcion AS plazo, cpn.id AS id_plazo, l.nombre AS laboratorio, de.nombre AS departamento, dv.nombre AS division, cto_unitario AS costo, act_generales AS actividades, cjn.descripcion AS motivo, cjn.id AS id_just, impacto , id_cotizacion, cto_unitario, ref ,otrajust
FROM necesidades_equipo ne, laboratorios l, divisiones dv, departamentos de, cat_plazo_nec cpn, cat_juztificacion_nec cjn
WHERE ne.id_lab=l.id_lab 
AND l.id_dep=de.id_dep 
AND de.id_div=dv.id_div 
AND plazo=cpn.id 
AND justificacion=cjn.id
ORDER BY id_nec DESC";	
}
//echo 'query'. $query;
  ?>

<div class="block" id="necesidades_content">   


<?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=". $_REQUEST['div'];?>
<!--<form action="<?php echo $action1; ?>" method="post" name="fnuevo">
<p style="text-align: right"> <input name="accion" type="submit" value="nuevo" id="botonblu"/></p>
</form>-->

<?php if ($_SESSION['tipo_usuario']==9){ ?>
<div style="text-align: right"> <?php //if (($_SESSION['permisos'][2]%3)==0){ ?><div id="botonblu" > <a href="<?php echo $action1 . '&accion=nuevo';?>">Nueva solicitud</a></div></div>
<?php } ?>


<br>
<br> 

<?php 
$datos = pg_query($con,$query);
	
    $inventario= pg_num_rows($datos); 
	
	if ($inventario!=0 ){

?>   
<table>
<tr><td>
<br />
    <form action="../inc/exportaxls_equip.inc.php" method="post" name="servbit" >
	<input name="enviar" type="submit" value="Exportar a excel" />
	<input name="lab" type="hidden" value="<?php echo $_GET['lab'] ?>" />
    <input name="div" type="hidden" value="<?php echo $_GET['div'] ?>" />
    <input name="div" type="hidden" value="<?php echo $_REQUEST['div']?>" />
	<input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
	</form>
    <br />
</td></tr>
</table>

 <?php }//echo "Responsable: " . $lab->getResponsable($_SESSION['id_usuario']); ?> 

   
<?php
	
   $datos = pg_query($con,$query);
	
    $inventario= pg_num_rows($datos); 
	
	if ($inventario!=0 ){

		while ($lab_nec = pg_fetch_array($datos, NULL, PGSQL_ASSOC)) 
			 { 

	?>              <table class="equipo"  width="100%" border="0" cellpadding="5">
                      <tr align="left">
                        <th width="5%">Cant.</th>
                        <th width="15%">Descripci&oacute;n</th>
                        <th width="12%">Unitario (USD)</th>
                        <th width="12%">Total(USD)</th>
                        <th width="20%">Motivo</th>
                        <th width="10%">Prioridad</th>
                        <th width="14%">Año</th>
                        <th width="14%">Cotización:</th>
                      </tr>          

	                 <tr>
                        <td align="center"><?php echo $lab_nec['cant'];?></td>
                        
                         <?php //if($_SESSION['permisos'][2] % 3 == 0){ ?>
                  		<td align="left"><a href="#necesidades" onClick="javascript:editLabNecesidades(<?php echo $k?>);"><?php echo $lab_nec['descripcion'];?></a></td>
                        <?php //}else{ ?>
                        <!--<td align="left"><?php echo $lab_nec['descripcion'];?></td>-->
                        <?php // } ?>
                        <td align="left">$<?php echo $lab_nec['cto_unitario'];?></td>
                        <td align="left">$<?php echo $lab_nec['cant']*$lab_nec['cto_unitario'];?></td>
                        <td align="left"><?php echo $lab_nec['motivo'];?></td>
                        <td align="left"><?php echo $lab_nec['id_prio']; $obj_req->getPrioridad($lab_nec['id_prio'],'descripcion');?></td>
                        <td align="left"><?php echo /*$lab_nec['plazo']; */ $obj_req->getPlazo($lab_nec['id_plazo'],'descripcion');?></td>
                        <td colspan="9" align="left"><?php echo $obj_cotiza->getCotiza($lab_nec['id_cotizacion']); ?></td>
                      </tr>
					<tr>
    	                  <td colspan="9" align="left">&nbsp;</td>
	                </tr>
                    <tr>
    	                  <td colspan="9" align="left"><strong>Justificación</strong></td>
	                </tr>
                    <tr>
                    <td colspan="9" align="left" valign="top"><?php echo $lab_nec['impacto'];?>
						<?php if ($_SESSION['tipo_usuario']==9){ ?> <br /><hr /> </td> </tr><?php }?>
                         
	                         </td>
                    </tr>
<?php //if($_SESSION['tipo_usuario']==9){ ?> 
			<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=".   $_REQUEST['div'];?>
			<form action="<?php echo $action; ?>" method="post" name="req_eq_<?php echo $form=$lab_nec['id_lab'] ."_".$lab_nec['id_nec'];?>">
			<?php if ($_SESSION['tipo_usuario']==9){ 
				?>
		          
			      <tr><td style="text-align: right" colspan="8"><input name="accion" type="submit" value="borrar" /></td> 
                      <td style="text-align: right"> <?php //if &nbsp;&nbsp;&nbsp;&nbsp;(($_SESSION['permisos'][2] %3)== 0){ ?><input name="accion" type="submit" value="editar" /></td>
              </tr>
              <?php }?>
	        <?php
				foreach ($lab_nec as $campo => $valor) {
				        //echo "\$usuario[$campo] => $valor.\n" . "</br>";
				echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
				
				}
				?>
			</form>
</table> 
 <br>
	<?php	
		 	 
			}
			 }else { ?>
             <br>
             <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
             <tr> <td align="center"> <h3>No existen necesidades registradas.</h3> </td></tr>
	
		<?php }
		//$_SESSION['id_usuario']=$usuario['id_usuario'];


?>

  </div>