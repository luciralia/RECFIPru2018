<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
//require_once('../clases/requerimientos.class.php');
require_once('../clases/proyectos.class.php');
$obj_cotiza = new Cotiza();
$lab = new laboratorios();
//$obj_req= new Requerimiento();
$obj_proy=new Proyecto();
$cant_equi=new Proyecto();

//$logger->putLog(31,2)

if ($_GET['mod']=='pryeb' ){
/*echo'Session en cargaProy';
print_r($_SESSION);

echo'REQUEST en cargaProy';
print_r($_REQUEST); */

if ($_SESSION['tipo_usuario']==9 && ($_GET['lab']!='' && $_GET['div']!='') ){

$query = "SELECT DISTINCT l.id_lab, l.nombre as nom_area,p.id_proy,ne.id_lab AS id_lab, nombre_proy,objetivo_general,
objetivo_especifico,descripcion_proy,
beneficio,fecha,ruta_evidencia_a
FROM proy p
LEFT JOIN proyecto_nec pn
ON p.id_proy=pn.id_proy
LEFT JOIN proy_evid_actual pea
ON pea.id_proy=p.id_proy 
LEFT JOIN evidencia_actual ea
ON ea.id_evid_actual=pea.id_evid_actual
LEFT JOIN necesidades_equipo ne
ON ne.id_nec=pn.id_nec
LEFT JOIN nec_evid nec
ON nec.id_nec=ne.id_nec
LEFT JOIN evidencia e
ON nec.id_evidencia=e.id_evidencia
AND ne.id_lab=pn.id_lab
LEFT JOIN cotizaciones ct
ON ct.id_cotizacion=ne.id_cotizacion 
LEFT JOIN laboratorios l
ON l.id_lab=ne.id_lab
LEFT JOIN departamentos de
ON de.id_dep=l.id_dep
LEFT JOIN divisiones dv
ON dv.id_div=de.id_div
WHERE ne.id_lab=" . $_GET['lab'] . 
" ORDER BY id_proy ASC";
	
	
//}else if ($_SESSION['tipo_usuario']==9 && ($_GET['lab']!='' && $_GET['div']=='') ){
	
/*$query = "SELECT DISTINCT p.id_proy,ne.id_lab AS id_lab, nombre_proy,objetivo_general,
objetivo_especifico,descripcion_proy,descripcion_nec,
num_equipo,p.justificacion,evidencia,fecha 
FROM proy p
JOIN proyecto_nec pn
ON p.id_proy=pn.id_proy
JOIN proyecto_criterio pc
ON pc.id_proy_nec=pn.id_proy_nec
JOIN criterio c
ON c.id_criterio=pc.id_criterio
JOIN necesidades_equipo ne
ON ne.id_nec=pn.id_nec
AND ne.id_lab=pn.id_lab
LEFT JOIN cotizaciones ct
ON ct.id_cotizacion=ne.id_cotizacion 
JOIN laboratorios l
ON l.id_lab=ne.id_lab
JOIN departamentos de
ON de.id_dep=l.id_dep
JOIN divisiones dv
ON dv.id_div=de.id_div
WHERE ne.id_lab=" . $_GET['lab'] . 
"ORDER BY id_proy DESC";*/
	
}else if ($_SESSION['tipo_usuario']==9 && $_GET['div']!=NULL && $_GET['lab']==''){
$query = "SELECT DISTINCT l.id_lab, l.nombre as nom_area,p.id_proy,ne.id_lab AS id_lab, nombre_proy,objetivo_general,
objetivo_especifico,descripcion_proy,
beneficio,fecha,ruta_evidencia_a
FROM proy p
LEFT JOIN proyecto_nec pn
ON p.id_proy=pn.id_proy
LEFT JOIN proy_evid_actual pea
ON pea.id_proy=p.id_proy 
LEFT JOIN evidencia_actual ea
ON ea.id_evid_actual=pea.id_evid_actual
LEFT JOIN necesidades_equipo ne
ON ne.id_nec=pn.id_nec
LEFT JOIN nec_evid nec
ON nec.id_nec=ne.id_nec
LEFT JOIN evidencia e
ON nec.id_evidencia=e.id_evidencia
AND ne.id_lab=pn.id_lab
LEFT JOIN cotizaciones ct
ON ct.id_cotizacion=ne.id_cotizacion 
LEFT JOIN laboratorios l
ON l.id_lab=ne.id_lab
LEFT JOIN departamentos de
ON de.id_dep=l.id_dep
LEFT JOIN divisiones dv
ON dv.id_div=de.id_div
WHERE dv.id_div=" . $_GET['div'] . 
" ORDER BY id_proy DESC";	

} 
else if ($_SESSION['tipo_usuario']==10 && $_GET['div']!='') {
	
$query = "SELECT DISTINCT l.id_lab, l.nombre as nom_area,p.id_proy,ne.id_lab AS id_lab, nombre_proy,objetivo_general,
objetivo_especifico,descripcion_proy,
beneficio,fecha,ruta_evidencia_a
FROM proy p
LEFT JOIN proyecto_nec pn
ON p.id_proy=pn.id_proy
LEFT JOIN proy_evid_actual pea
ON pea.id_proy=p.id_proy 
LEFT JOIN evidencia_actual ea
ON ea.id_evid_actual=pea.id_evid_actual
LEFT JOIN necesidades_equipo ne
ON ne.id_nec=pn.id_nec
LEFT JOIN nec_evid nec
ON nec.id_nec=ne.id_nec
LEFT JOIN evidencia e
ON nec.id_evidencia=e.id_evidencia
AND ne.id_lab=pn.id_lab
LEFT JOIN cotizaciones ct
ON ct.id_cotizacion=ne.id_cotizacion 
LEFT JOIN laboratorios l
ON l.id_lab=ne.id_lab
LEFT JOIN departamentos de
ON de.id_dep=l.id_dep
LEFT JOIN divisiones dv
ON dv.id_div=de.id_div
WHERE dv.id_div=" . $_GET['div'] . 
" ORDER BY id_proy DESC";

	
} else if ($_SESSION['tipo_usuario']==10 &&  $_GET['div']==NULL) {
	
$query = "SELECT DISTINCT l.id_lab, l.nombre as nom_area,p.id_proy,ne.id_lab AS id_lab, nombre_proy,objetivo_general,
objetivo_especifico,descripcion_proy,
beneficio,fecha,ruta_evidencia_a
FROM proy p
LEFT JOIN proyecto_nec pn
ON p.id_proy=pn.id_proy
LEFT JOIN proy_evid_actual pea
ON pea.id_proy=p.id_proy 
LEFT JOIN evidencia_actual ea
ON ea.id_evid_actual=pea.id_evid_actual
LEFT JOIN necesidades_equipo ne
ON ne.id_nec=pn.id_nec
LEFT JOIN nec_evid nec
ON nec.id_nec=ne.id_nec
LEFT JOIN evidencia e
ON nec.id_evidencia=e.id_evidencia
AND ne.id_lab=pn.id_lab
LEFT JOIN cotizaciones ct
ON ct.id_cotizacion=ne.id_cotizacion 
LEFT JOIN laboratorios l
ON l.id_lab=ne.id_lab
LEFT JOIN departamentos de
ON de.id_dep=l.id_dep
LEFT JOIN divisiones dv
ON dv.id_div=de.id_div
ORDER BY id_proy DESC";	
	//echo 'consulta 4';
}
//echo 'query cargaproy'. $query;
  ?>

<div class="block" id="necesidades_content">   

<?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=". $_REQUEST['div'];?>
<!--<form action="<?php echo $action1; ?>" method="post" name="fnuevo">
<p style="text-align: right"> <input name="accion" type="submit" value="nuevo" id="botonblu"/></p>
</form>-->

<?php if ($_SESSION['tipo_usuario']==9 ){ ?>
<div style="text-align: right"> <?php //if (($_SESSION['permisos'][2]%3)==0){ ?><div id="botonblu" > <a href="<?php echo $action1 . '&accion=nuevo';?>">Nueva solicitud</a></div></div>
<?php } ?>




<?php 
$datos = pg_query($con,$query);
	
    $inventario= pg_num_rows($datos); 
	
	if ($inventario!=0 ){

?>   
<table>
<tr><td>

    <form action="../inc/exportaxls_proy.inc.php" method="post" name="proybit" >
	<input name="enviar" type="submit" value="Exportar a excel" />
	<input name="lab" type="hidden" value="<?php echo $_GET['lab'] ?>" />
    <input name="div" type="hidden" value="<?php echo $_GET['div'] ?>" />
    <input name="div" type="hidden" value="<?php echo $_REQUEST['div']?>" />
	<input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
	</form>
    <br />
</td></tr>
</table>

 
 <?php } ?> 

     
<?php  //Hacer funcion por cada proy y devuelva total equipos
	
 $datos = pg_query($con,$query);
	
    $inventario= pg_num_rows($datos); 
	
	if ($inventario!=0 ){

		while ($lab_proy = pg_fetch_array($datos, NULL, PGSQL_ASSOC)) 
			 { 
				 

	?>              <table class="equipo"  width="100%" border="0" cellpadding="5">
                      <tr align="left">
                         <th width="10%">&Aacute;rea</th>
                        <th width="10%">Nombre</th>
                        <th width="15%">Objetivo General</th>
                        <th width="15%">Objetivo Espec&iacute;fico</th>
                        <th width="15%">Descripci&oacute;n detallada</th>
                        <th width="12%">Cantidad de equipo</th>
                        <th width="20%">Beneficios esperados</th>
                        <th width="20%">Evidencia actual</th>
                        <th width="20%">Fecha</th>
                      </tr>          

	                 <tr>
                        <td align="center"><?php echo $lab_proy['nom_area'];?></td>
                        <td align="center"><?php echo $lab_proy['nombre_proy'];?></td>
                        
                         <?php //if($_SESSION['permisos'][2] % 3 == 0){ ?>
                  		<td align="left"><a href="#necesidades" onClick="javascript:editLabNecesidades(<?php echo $k?>);"><?php echo $lab_proy['objetivo_general'];?></a></td>
                        <?php //}else{ ?>
                        <!--<td align="left"><?php //echo $lab_proy['objetivo_especifico'];?></td>-->
                        <?php // } ?>
                        <td align="left"><?php echo $lab_proy['objetivo_especifico'];?></td>
                        <td align="left"><?php echo $lab_proy['descripcion_proy'];?></td>
                        <td align="left"><?php echo $cantproy;?></td>
                        <td align="left"><?php echo $lab_proy['beneficio'];?></td>
                        <td align="left"><a href="<?php echo $lab_proy['ruta_evidencia_a']; ?>" target="_blank"><?php echo substr($lab_proy['ruta_evidencia_a'],strpos($lab_proy['ruta_evidencia_a'],'_')+12);?></a></td>
				         <td align="left"><?php echo $lab_proy['fecha']; ?></td>
					</tr>
					
<?php //if($_SESSION['tipo_usuario']==9){ ?> 
			<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=".   $_REQUEST['div'];?>
			<form action="<?php echo $action; ?>" method="post" name="req_eq_<?php echo $form=$lab_proy['id_lab'] ."_".$lab_proy['id_proy'];?>">
			<?php if ($_SESSION['tipo_usuario']==9){ 
				?>
                     <tr><td style="text-align: right" colspan="8"><input name="accion" type="submit" value="borrar" /></td> 
                     <td style="text-align: right"><?php//if &nbsp;&nbsp;&nbsp;&nbsp;(($_SESSION['permisos'][2] %3)== 0){ ?><input name="accion" type="submit" value="editar" /></td>
                     <td style="text-align: right"><?php//if &nbsp;&nbsp;&nbsp;&nbsp;(($_SESSION['permisos'][2] %3)== 0){ ?><input name="accion" type="submit" value="evaluar" /></td>
              </tr>
              <?php }?>
	        <?php
				foreach ($lab_proy as $campo => $valor) {
				   echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
					
				}
			?>
			</form>
			
	<?php	} ?>
		<!--</table>--> 
		 
			<?php }else { ?>
             <br>
             <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
             <tr> <td align="center"> <h3>No existen necesidades registradas.</h3> </td></tr>
	
		<?php }
		//$_SESSION['id_usuario']=$usuario['id_usuario'];

 } 
 
?>

  </div>