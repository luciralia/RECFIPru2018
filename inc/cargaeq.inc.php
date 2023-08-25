 
<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/requerimientos.class.php');
$obj_cotiza = new Cotiza();
$lab = new laboratorios();
$obj_req= new Requerimiento();
$combofunc = new Requerimiento();

/*echo 'Valores en carga eq';
	print_r($_POST); */



if ($_SESSION['tipo_usuario']==9 && ($_GET['lab']!='' && $_GET['div']!='') ){

$query = "SELECT DISTINCT lr.id_lab_req,lr.id_req, lr.id_lab AS id_lab, cantidad, lr.descripcion,lr.id_recurso,nomb_recurso,l.nombre AS laboratorio, de.nombre AS departamento,dv.nombre AS division,act_generales AS actividades,desc_impacto,fecha_implem,detalle_func,planeacion,otro_cual
FROM requerimiento_lab lr
left JOIN requerimiento_impacto ri
ON ri.id_lab_req=lr.id_lab_req
left JOIN cat_impacto ci
on ci.id_impacto=ri.id_impacto
left JOIN requerimiento_funcion rf
ON rf.id_lab_req=lr.id_lab_req
left JOIN cat_funcion cr
ON cr.id_funcion=rf.id_funcion
left JOIN requerimiento_sistema rs
ON rs.id_lab_req=lr.id_lab_req
left JOIN sistema s
ON rs.id_sistema=s.id_sistema
LEFT join requerimiento_just rj
ON lr.id_lab_req=rj.id_lab_req
left JOIN cat_juztificacion_nec cjn
ON rj.id_req_just=cjn.id
left JOIN motivo_evidencia me
ON me.id_req_just=rj.id_req_just
left JOIN evidencia e
ON e.id_evidencia=me.id_evidencia
LEFT JOIN cat_recursos_equipo cre
ON cre.id_recurso=lr.id_recurso
left JOIN laboratorios l
ON lr.id_lab=l.id_lab
left JOIN departamentos de
ON l.id_dep=de.id_dep
left JOIN divisiones dv
ON de.id_div=dv.id_div
WHERE lr.id_lab=" . $_GET['lab'] . 
"ORDER BY lr.id_req DESC";

}if ($_SESSION['tipo_usuario']==9 && ($_GET['lab']!='' && $_GET['div']=='') ){
	
$query = "
SELECT DISTINCT lr.id_lab_req,lr.id_req, lr.id_lab AS id_lab, cantidad, lr.descripcion,e.id_evidencia,e.ruta_evidencia,lr.id_recurso,nomb_recurso,l.nombre AS laboratorio, de.nombre AS departamento,dv.nombre AS division,act_generales AS actividades,cjn.descripcion AS motivo,cjn.id AS id_just,desc_impacto,
otra_just,fecha_implem,fecha_solic,corrimiento
FROM requerimiento_lab lr
left JOIN requerimiento_impacto ri
ON ri.id_lab_req=lr.id_lab_req
left JOIN cat_impacto ci
on ci.id_impacto=ri.id_impacto
left JOIN requerimiento_funcion rf
ON rf.id_lab_req=lr.id_lab_req
left JOIN cat_funcion cr
ON cr.id_funcion=rf.id_funcion
left JOIN requerimiento_sistema rs
ON rs.id_lab_req=lr.id_lab_req
left JOIN sistema s
ON rs.id_sistema=s.id_sistema
left JOIN cat_juztificacion_nec cjn
ON lr.id_just=cjn.id
left JOIN motivo_evidencia me
ON me.id=cjn.id
left JOIN evidencia e
ON e.id_evidencia=me.id_evidencia
LEFT JOIN cat_recursos_equipo cre
ON cre.id_recurso=lr.id_recurso
left JOIN laboratorios l
ON lr.id_lab=l.id_lab
left JOIN departamentos de
ON l.id_dep=de.id_dep
left JOIN divisiones dv
ON de.id_div=dv.id_div 
WHERE lr.id_lab=" . $_GET['lab'] . 
"ORDER BY lr.id_req DESC";
	
}else if ($_SESSION['tipo_usuario']==9 && $_GET['lab']=='' && $_GET['div']!=''){
	echo'2';
$query = "SELECT DISTINCT lr.id_lab_req,lr.id_req, lr.id_lab AS id_lab, cantidad, lr.descripcion,e.id_evidencia,e.ruta_evidencia,lr.id_recurso,nomb_recurso,l.nombre AS laboratorio, de.nombre AS departamento,dv.nombre AS division,act_generales AS actividades,cjn.descripcion AS motivo,cjn.id AS id_just,desc_impacto,
otra_just,fecha_implem,fecha_solic
FROM requerimiento_lab lr
left JOIN requerimiento_impacto ri
ON ri.id_lab_req=lr.id_lab_req
left JOIN cat_impacto ci
on ci.id_impacto=ri.id_impacto
left JOIN requerimiento_funcion rf
ON rf.id_lab_req=lr.id_lab_req
left JOIN cat_funcion cr
ON cr.id_funcion=rf.id_funcion
left JOIN requerimiento_sistema rs
ON rs.id_lab_req=lr.id_lab_req
left JOIN sistema s
ON rs.id_sistema=s.id_sistema
left JOIN cat_juztificacion_nec cjn
ON lr.id_just=cjn.id
left JOIN motivo_evidencia me
ON me.id=cjn.id
left JOIN evidencia e
ON e.id_evidencia=me.id_evidencia
LEFT JOIN cat_recursos_equipo cre
ON cre.id_recurso=lr.id_recurso
left JOIN laboratorios l
ON lr.id_lab=l.id_lab
left JOIN departamentos de
ON l.id_dep=de.id_dep
left JOIN divisiones dv
ON de.id_div=dv.id_div 
WHERE dv.id_div=" . $_GET['div'] . 
"ORDER BY lr.id_req DESC";	
} 
else if ($_SESSION['tipo_usuario']==10 && $_GET['div']!='') {
	echo'3';
$query = "SELECT DISTINCT lr.id_lab_req,lr.id_req, lr.id_lab AS id_lab, cantidad, lr.descripcion,e.id_evidencia,e.ruta_evidencia,lr.id_recurso,nomb_recurso,l.nombre AS laboratorio, de.nombre AS departamento,dv.nombre AS division,act_generales AS actividades,cjn.descripcion AS motivo,cjn.id AS id_just,desc_impacto,
otra_just,fecha_implem,fecha_solic
FROM requerimiento_lab lr
left JOIN requerimiento_impacto ri
ON ri.id_lab_req=lr.id_lab_req
left JOIN cat_impacto ci
on ci.id_impacto=ri.id_impacto
left JOIN requerimiento_funcion rf
ON rf.id_lab_req=lr.id_lab_req
left JOIN cat_funcion cr
ON cr.id_funcion=rf.id_funcion
left JOIN requerimiento_sistema rs
ON rs.id_lab_req=lr.id_lab_req
left JOIN sistema s
ON rs.id_sistema=s.id_sistema
left JOIN cat_juztificacion_nec cjn
ON lr.id_just=cjn.id
left JOIN motivo_evidencia me
ON me.id=cjn.id
left JOIN evidencia e
ON e.id_evidencia=me.id_evidencia
LEFT JOIN cat_recursos_equipo cre
ON cre.id_recurso=lr.id_recurso
left JOIN laboratorios l
ON lr.id_lab=l.id_lab
left JOIN departamentos de
ON l.id_dep=de.id_dep
left JOIN divisiones dv
ON de.id_div=dv.id_div 
WHERE dv.id_div=" . $_GET['div'] . 
"ORDER BY lr.id_req DESC";	
	
} else if ($_SESSION['tipo_usuario']==10 &&  $_GET['div']==NULL) {
echo'4';	
$query = "SELECT DISTINCT lr.id_lab_req,lr.id_req, lr.id_lab AS id_lab, cantidad, lr.descripcion,e.id_evidencia,e.ruta_evidencia,lr.id_recurso,nomb_recurso,l.nombre AS laboratorio, de.nombre AS departamento,dv.nombre AS division,act_generales AS actividades,cjn.descripcion AS motivo,cjn.id AS id_just,desc_impacto,
otra_just,fecha_implem,fecha_solic
FROM requerimiento_lab lr
left JOIN requerimiento_impacto ri
ON ri.id_lab_req=lr.id_lab_req
left JOIN cat_impacto ci
on ci.id_impacto=ri.id_impacto
left JOIN requerimiento_funcion rf
ON rf.id_lab_req=lr.id_lab_req
left JOIN cat_funcion cr
ON cr.id_funcion=rf.id_funcion
left JOIN requerimiento_sistema rs
ON rs.id_lab_req=lr.id_lab_req
left JOIN sistema s
ON rs.id_sistema=s.id_sistema
left JOIN cat_juztificacion_nec cjn
ON lr.id_just=cjn.id
left JOIN motivo_evidencia me
ON me.id=cjn.id
left JOIN evidencia e
ON e.id_evidencia=me.id_evidencia
LEFT JOIN cat_recursos_equipo cre
ON cre.id_recurso=lr.id_recurso
left JOIN laboratorios l
ON lr.id_lab=l.id_lab
left JOIN departamentos de
ON l.id_dep=de.id_dep
left JOIN divisiones dv
ON de.id_div=dv.id_div 
ORDER BY lr.id_req DESC";	
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
				        <th width="20%">Recursos de cómputo</th>		  
                        <th width="10%">Cantidad de equipos</th>
                        <th width="15%">Descripci&oacute;n</th>
                        <th width="15%">Impacto</th>
                        <th width="25%">Evidencia actual</th> 
						<th width="25%">Evidencia infraestructura</th>  
                      </tr>          
	                 <tr>
						<td align="left"><?php echo $lab_nec['nomb_recurso']; ?></td> 
                        <td align="center"><?php echo $lab_nec['cantidad'];?></td>
                        
                         <?php //if($_SESSION['permisos'][2] % 3 == 0){ ?>
                  		<td align="left"><a href="#necesidades" onClick="javascript:editLabNecesidades(<?php echo $k?>);"><?php echo $lab_nec['descripcion'];?></a></td>
                        <?php //}else{ ?>
                        <!--<td align="left"><?php echo $lab_nec['descripcion'];?></td>-->
                        <?php // } ?>
                  
                        <td align="left"><?php echo $lab_nec['desc_impacto'];?></td>
                        
                        <!--
						<td align="left"><a href="<?php // echo $lab_nec['ruta_evidencia']; ?>" target="_blank"><?php //echo substr($lab_nec['ruta_evidencia'],strpos($lab_nec['ruta_evidencia'],'_')+3); ?></a></td>
						 
						<td align="left"><a href="<?php // echo $lab_nec['ruta_evidencia']; ?>" target="_blank"><?php //echo substr($lab_nec['ruta_evidencia'],strpos($lab_nec['ruta_evidencia'],'_')+3); ?></a></td> -->
						
						<td align="left"><a href="<?php  echo $combofunc->evidenciaa($lab_nec['id_lab_req']); ?>" target="_blank"><?php echo substr($combofunc->evidenciaa($lab_nec['id_lab_req']),strpos($combofunc->evidenciaa($lab_nec['id_lab_req']),'_')+4); ?></a></td>
						 <td align="left"><a href="<?php  echo $combofunc->evidenciai($lab_nec['id_lab_req']); ?>" target="_blank"><?php echo substr($combofunc->evidenciai($lab_nec['id_lab_req']),strpos($combofunc->evidenciai($lab_nec['id_lab_req']),'_')+14); ?></a></td>
					</tr>
					<!--<tr>
    	                  <td colspan="9" align="left">&nbsp;</td>
	                </tr><tr>
    	                  <td colspan="9" align="left"><strong>Justificación</strong></td>
	                </tr>-->
                    <tr>
                    <td colspan="9" align="left" ><?php echo $lab_nec['desc_impacto'];?>
						<?php if ($_SESSION['tipo_usuario']==9){ ?> <!--<br /> <hr /></td> </tr>--> <?php }?>
                    </td> 
                    </tr>
                    <tr>
                          <td align="right">Función(es)</td>
                          <td colspan="3"><?php  $combofunc->muestraselfunc($lab_nec['id_lab_req']); ?></td>
                    </tr>
                 
<?php //if($_SESSION['tipo_usuario']==9){ ?> 
			<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=".   $_REQUEST['div'];?>
			<form action="<?php echo $action; ?>" method="post" name="req_eq_<?php echo $form=$lab_nec['id_lab_req'];?>">
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