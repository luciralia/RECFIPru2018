<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/proyectos.class.php');
$obj_cotiza = new Cotiza();
$lab = new laboratorios();
$proy= new Proyecto();


$query = "select p.*,op.organizacion as organizacion
from proyectos p, organizaciones_proyectos op
where p.id_organizacion=op.id_organizacion
and p.id_lab=" . $_GET['lab'] .
"order by p.id_proyecto desc";

// echo $query; ?>

<div class="block" id="necesidades_content">      

 <?php //echo "Responsable: " . $lab->getResponsable($_SESSION['id_usuario']); ?> 

<?php

	$datos = pg_query($con,$query);

		while ($lab_proys = pg_fetch_array($datos, NULL, PGSQL_ASSOC)) 
			 { 
		
//		echo "</br>cantidad:" . $lab_nec['cant']; 
	//	echo "</br>Descripción:" . $lab_nec['descripcion']; 
	//  echo "</br>Cotización: "; echo $obj_cotiza->getCotiza($lab_nec['id_cotizacion']);
	?>
	
 <table class="material" cellpadding="2">
  <tr>
    <th width="156" rowspan="2" scope="col">Nombre</th>
    <th width="159" rowspan="2" scope="col">Empresa o Entidad</th>
    <th width="92" rowspan="2" scope="col">Tipo de Proyecto</th>
    <th colspan="3" scope="col">Tesis</th>
    <th width="73" rowspan="2" scope="col">Artículos</th>
    <th width="79" rowspan="2" scope="col">Prototipos</th>
    <th width="66" rowspan="2" scope="col">Patentes</th>
    <th width="69" rowspan="2" scope="col">Convenio</th>
    <th width="102" rowspan="2" scope="col">Fecha</th>
    <th width="65" rowspan="2" scope="col">Status</th>
  </tr>
  <tr>
    <th width="27" scope="col">L</th>
    <th width="30" scope="col">M</th>
    <th width="32" scope="col">D</th>
  </tr>
  <tr>
    <td><?php echo $lab_proys['nombre_proyecto'];?></td>
    <td><?php echo $lab_proys['organizacion'];?></td>
    <td><?php echo $proy->getTipoProyecto($lab_proys['tipo_proyecto']);?></td>
    <td><?php echo $lab_proys['tesis_lic'];?></td>
    <td><?php echo $lab_proys['tesis_ma'];?></td>
    <td><?php echo $lab_proys['tesis_doc'];?></td>
    <td><?php echo $lab_proys['articulos'];?></td>
    <td><?php echo $lab_proys['prototipos'];?></td>
    <td><?php echo $lab_proys['patentes'];?></td>
    <td><?php echo $lab_proys['colaboracion'];?></td>
    <td><?php echo date("d-m-Y",strtotime($lab_proys['fecha']));?></td>
    <td><?php echo $lab_proys['status'];?></td>
  </tr>
<form action="../inc/procesamat.inc.php" method="post" name="req_mat_<?php echo $form=$lab_proys['id_lab'] ."_".$lab_proys['id_proyecto'];?>">

<!--  <tr ><td style="text-align: right" colspan="12"><hr /><input name="accion" type="submit" value="editar" /><input name="accion" type="submit" value="borrar" /></td></tr>-->


<?php
foreach ($lab_proys as $campo => $valor) {
        //echo "\$usuario[$campo] => $valor.\n" . "</br>";
echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";

}
?>
</form>

</table>
    </br>                
                        
    
	
	<?php	
	
				 	 
			}
		//$_SESSION['id_usuario']=$usuario['id_usuario'];


?>

 <?php /* foreach($lab->loadNecesidades($_POST['_id_lab']) as $k => $v){ ?>
                      <tr>
                        <td align="center"><?php echo $v['cant'];?></td>
                         <?php if($_SESSION['permisos'][2] % 3 == 0){ ?>
                        		<td align="left"><a href="#necesidades" onClick="javascript:editLabNecesidades(<?php echo $k?>);"><?php echo $v['descripcion'];?></a></td>
                        <?php }else{ ?>
                        <td align="left"><?php echo $v['descripcion'];?></td>
                        <?php } ?>
                        <td align="left">$<?php echo $v['cto_unitario'];?></td>
                        <td align="left">$<?php echo $v['cant']*$v['cto_unitario'];?></td>
                        <td align="left"><?php echo $lab->getPrioridadNec($v['prioridad']);?></td>
                        <td align="left"><?php echo $lab->getPlazoNec($v['plazo']);?></td>
                        <td align="left"><?php echo $lab->getJustificacionNec($v['justificacion']);?></td>
                        <td align="left"><?php //echo $v['impacto'];?></td>
                      </tr>
                      <tr>
                        <td colspan="9" align="left"><strong>Cotización: <?php /*echo $v['id_cotizacion']; include '../src/class.cotiz.getProveedor.php';?></strong>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="9" align="left"><strong>Justificación</strong></td>
                      </tr>
                      <tr>
                        <td colspan="9" align="left" valign="top"><?php echo $lab_nec['impacto'];?><br />
                        <hr /></td>
                      </tr>
                   			 <!--<table width="100%"> -->
                   	  		<!--</table> -->
					  <?php } ?>
                      <?php if($_SESSION['permisos'][2] % 3 == 0){ ?>
                      		<tr>
                     		<td colspan="8" align="right"><a href="#necesidades" onClick="javascript:editLabNecesidades(0);">Nueva</a></td>2                            					</tr>
                        <?php } */?>

                </div>