
<?php 

require_once('../clases/proyectos.class.php');
require_once('../clases/requerimientos.class.php');
$combonec = new proyecto();
$motivo = new Requerimiento();
$combousu= new laboratorios();
$comboproy= new proyecto();


//echo 'valores en evaluarproy', print_r($_POST);
//echo 'valores en editaproy', print_r($_REQUEST);

$query="
SELECT DISTINCT p.id_proy,c.id_criterio
FROM proy p
LEFT JOIN proyecto_nec pn
ON p.id_proy=pn.id_proy
LEFT JOIN proyecto_criterio pc
ON pc.id_proy=pn.id_proy
LEFT JOIN criterio c
ON c.id_criterio=pc.id_criterio
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
WHERE p.id_proy=" . $_POST['id_proy'];

$queryproy="SELECT cantalum,cantprof,cantinvest,nomb_impacto,nomb_producto FROM proy p 
            JOIN cat_impacto i
			ON p.id_impacto=i.id_impacto
			JOIN cat_producto pr
			ON pr.id_producto=p.id_producto
            WHERE id_proy=" . $_REQUEST['id_proy'];

	 $resultx=@pg_query($con,$queryproy) or die('ERROR AL LEER DATOS: ' . pg_last_error());
     $row = pg_fetch_array($resultx); 
     $calum=$row['cantalum']; 
	 $cprof=$row['cantprof'];
	 $cinvest=$row['cantinvest'];
	 $nimpacto=$row['nomb_impacto'];
	 $nprod=$row['nomb_producto'];
	
?>
<br>
<br>
<div class=formulario>
<!--<table cellpadding="2" class="formulario">-->
<form action="../inc/guardarproy.inc.php" method="post" name="form_nuevo" class="formul">
	<table class="equipo"  width="100%" border="0" cellpadding="5">
<tr align="left">		
   <th width="10%">Nombre</th>
                        <th width="15%">Objetivo General</th>
                        <th width="15%">Objetivo Espec&iacute;fico</th>
                        <th width="15%">Descripci&oacute;n detallada</th>
                        <th width="20%">Beneficios esperados</th>
                        <th width="20%">Evidencia</th>
                        <th width="10%">Cantidad de alumnos</th>
                        <th width="10%">Cantidad de profesores</th>
                        <th width="10%">Cantidad de Investigadores</th>
                        <th width="20%">Impacto</th>
                        <th width="20%">Productos</th>
                        
                      </tr>          
                      <tr>
                        
                        <td align="left"><?php echo $_REQUEST['nombre_proy'];?></td>
                        <td align="left"><?php echo $_REQUEST['objetivo_general'];?></td>
                        <td align="left"><?php echo $_REQUEST['objetivo_especifico'];?></td>
                        <td align="left"><?php echo $_REQUEST['descripcion_proy'];?></td>
                        <td align="left"><?php echo $_REQUEST['beneficio'];?></td>
                        <td align="left"><?php echo $_REQUEST['id_evidencia']; ?></td>
                        <td align="left"><?php echo $calum; ?></td>
				        <td align="left"><?php echo $cprof; ?></td>
				        <td align="left"><?php echo $cinvest; ?></td>
				        <td align="left"><?php echo $nimpacto; ?></td>
				        <td align="left"><?php echo $nprod; ?></td>
					</tr>
					<tr>
                          <?php $combonec->selnecproy($_POST['id_proy']); ?>
                    </tr>
                    <tr>
                          <?php $comboproy->califcrit($_POST['id_proy']); ?>
                   </tr>
	
  <tr>
    <td colspan="4" align="right">
    <input type="submit" name="accionn" value="Guardar" />
    <input type="reset" name="accionn"  value="Limpiar" />
	<input type="submit" name="accionn" value="Cancelar" /></td>
    </tr>
</table>
<br>
<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="div" type="hidden" value="<?php echo $_GET['div']; ?>" />
<input name="id_proy" type="hidden" value="<?php echo $_POST['id_proy']; ?>" />

</form>
<br>
</div>