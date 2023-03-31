 
<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/requerimientos.class.php');
$obj_cotiza = new Cotiza();
$lab = new laboratorios();
$obj_req= new Requerimiento();
echo 'Valores en carga eq';
	print_r($_POST); 


if ($_SESSION['tipo_usuario']==9 && ($_GET['lab']!='' && $_GET['div']!='') ){

$query = "SELECT DISTINCT ne.id_nec, ne.id_lab AS id_lab, cant, ne.descripcion,e.id_evidencia,e.ruta_evidencia,ne.id_recurso,nomb_recurso,   l.nombre AS laboratorio, de.nombre AS departamento, dv.nombre AS division,  act_generales AS actividades, cjn.descripcion AS motivo, cjn.id AS id_just, impacto , id_cotizacion, ref ,otrajust
FROM necesidades_equipo ne
LEFT JOIN nec_evid nec
ON nec.id_lab=ne.id_lab
AND nec.id_nec=ne.id_nec
LEFT JOIN evidencia e
ON nec.id_evidencia=e.id_evidencia
LEFT JOIN cat_recursos_equipo cre
ON cre.id_recurso=ne.id_recurso
JOIN laboratorios l
ON ne.id_lab=l.id_lab
JOIN departamentos de
ON l.id_dep=de.id_dep
JOIN divisiones dv
ON de.id_div=dv.id_div 
JOIN cat_juztificacion_nec cjn
ON justificacion=cjn.id
WHERE ne.id_lab=" . $_GET['lab'] . 
"ORDER BY id_nec DESC";

}if ($_SESSION['tipo_usuario']==9 && ($_GET['lab']!='' && $_GET['div']=='') ){
	
$query = "SELECT DISTINCT ne.id_nec, ne.id_lab AS id_lab, cant, ne.descripcion,e.id_evidencia,e.ruta_evidencia,ne.id_recurso,nomb_recurso, prioridad as id_prio,  l.nombre AS laboratorio, de.nombre AS departamento, dv.nombre AS division, cto_unitario AS costo, act_generales AS actividades, cjn.descripcion AS motivo, cjn.id AS id_just, impacto , id_cotizacion, cto_unitario, ref ,otrajust
FROM necesidades_equipo ne
LEFT JOIN nec_evid nec
ON nec.id_lab=ne.id_lab
AND nec.id_nec=ne.id_nec
LEFT JOIN evidencia e
ON nec.id_evidencia=e.id_evidencia
LEFT JOIN cat_recursos_equipo cre
ON cre.id_recurso=ne.id_recurso
JOIN laboratorios l
ON ne.id_lab=l.id_lab
JOIN departamentos de
ON l.id_dep=de.id_dep
JOIN divisiones dv
ON de.id_div=dv.id_div 

JOIN cat_juztificacion_nec cjn
ON justificacion=cjn.id
WHERE ne.id_lab=" . $_GET['lab'] . 
"ORDER BY id_nec DESC";
	
}else if ($_SESSION['tipo_usuario']==9 && $_GET['lab']=='' && $_GET['div']!=''){
$query = "SELECT DISTINCT ne.id_nec, ne.id_lab AS id_lab, cant, ne.descripcion,e.id_evidencia,e.ruta_evidencia,ne.id_recurso,nomb_recurso, prioridad as id_prio,  l.nombre AS laboratorio, de.nombre AS departamento, dv.nombre AS division, cto_unitario AS costo, act_generales AS actividades, cjn.descripcion AS motivo, cjn.id AS id_just, impacto , id_cotizacion, cto_unitario, ref ,otrajust
FROM necesidades_equipo ne
LEFT JOIN nec_evid nec
ON nec.id_lab=ne.id_lab
AND nec.id_nec=ne.id_nec
LEFT JOIN evidencia e
ON nec.id_evidencia=e.id_evidencia
LEFT JOIN cat_recursos_equipo cre
ON cre.id_recurso=ne.id_recurso
JOIN laboratorios l
ON ne.id_lab=l.id_lab
JOIN departamentos de
ON l.id_dep=de.id_dep
JOIN divisiones dv
ON de.id_div=dv.id_div 
JOIN cat_juztificacion_nec cjn
ON justificacion=cjn.id
WHERE dv.id_div=" . $_GET['div'] . 
"ORDER BY id_nec DESC";	
} 
else if ($_SESSION['tipo_usuario']==10 && $_GET['div']!='') {
	
$query = "SELECT DISTINCT ne.id_nec, ne.id_lab AS id_lab, cant, ne.descripcion,e.id_evidencia,e.ruta_evidencia,ne.id_recurso,nomb_recurso, prioridad as id_prio,  l.nombre AS laboratorio, de.nombre AS departamento, dv.nombre AS division, cto_unitario AS costo, act_generales AS actividades, cjn.descripcion AS motivo, cjn.id AS id_just, impacto , id_cotizacion, cto_unitario, ref ,otrajust
FROM necesidades_equipo ne
LEFT JOIN nec_evid nec
ON nec.id_lab=ne.id_lab
AND nec.id_nec=ne.id_nec
LEFT JOIN evidencia e
ON nec.id_evidencia=e.id_evidencia
LEFT JOIN cat_recursos_equipo cre
ON cre.id_recurso=ne.id_recurso
JOIN laboratorios l
ON ne.id_lab=l.id_lab
JOIN departamentos de
ON l.id_dep=de.id_dep
JOIN divisiones dv
ON de.id_div=dv.id_div 
JOIN cat_juztificacion_nec cjn
ON justificacion=cjn.id
WHERE dv.id_div=" . $_GET['div'] . 
"ORDER BY id_nec DESC";	
	
} else if ($_SESSION['tipo_usuario']==10 &&  $_GET['div']==NULL) {
	
$query = "SELECT DISTINCT ne.id_nec, ne.id_lab AS id_lab, cant, ne.descripcion,e.id_evidencia,e.ruta_evidencia,ne.id_recurso,nomb_recurso, prioridad as id_prio,  l.nombre AS laboratorio, de.nombre AS departamento, dv.nombre AS division, cto_unitario AS costo, act_generales AS actividades, cjn.descripcion AS motivo, cjn.id AS id_just, impacto , id_cotizacion, cto_unitario, ref ,otrajust
FROM necesidades_equipo ne
LEFT JOIN nec_evid nec
ON nec.id_lab=ne.id_lab
AND nec.id_nec=ne.id_nec
LEFT JOIN evidencia e
ON nec.id_evidencia=e.id_evidencia
LEFT JOIN cat_recursos_equipo cre
ON cre.id_recurso=ne.id_recurso
JOIN laboratorios l
ON ne.id_lab=l.id_lab
JOIN departamentos de
ON l.id_dep=de.id_dep
JOIN divisiones dv
ON de.id_div=dv.id_div 
JOIN cat_juztificacion_nec cjn
ON justificacion=cjn.id
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
				        <th width="15%">Recursos de cómputo</th>		  
                        <th width="5%"> Cantidad de equipos</th>
                        <th width="15%">Descripci&oacute;n</th>
                        <th width="20%">Motivo</th>
                        <th width="20%">Evidencia</th>  
                      </tr>          

	                 <tr>
						<td align="left"><?php echo $lab_nec['nomb_recurso']; ?></td> 
                        <td align="center"><?php echo $lab_nec['cant'];?></td>
                        
                         <?php //if($_SESSION['permisos'][2] % 3 == 0){ ?>
                  		<td align="left"><a href="#necesidades" onClick="javascript:editLabNecesidades(<?php echo $k?>);"><?php echo $lab_nec['descripcion'];?></a></td>
                        <?php //}else{ ?>
                        <!--<td align="left"><?php echo $lab_nec['descripcion'];?></td>-->
                        <?php // } ?>
                        
                        <td align="left"><?php echo $lab_nec['motivo'];?></td>
                        
						<td align="left"><a href="<?php echo $lab_nec['ruta_evidencia']; ?>" target="_blank"><?php echo substr($lab_nec['ruta_evidencia'],strpos($lab_nec['ruta_evidencia'],'_')+3);?></a></td>
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