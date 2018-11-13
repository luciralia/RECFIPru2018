<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/inventario.class.php');
require_once('../clases/log.class.php');

$logger=new Log();
$obj_cotiza = new Cotiza();
$lab = new laboratorios();
$madq = new inventario();

$logger->putLog(7,2);

/*$query = "select e.*, l.nombre as laboratorio, bi.* 
from equipo e, bienes_inventario bi, laboratorios l
where e.bn_id = bi.bn_id
and l.id_lab=e.id_lab
and e.id_lab=";*/
$query ="select e.*, l.nombre as laboratorio, bi.*
from equipoc e
left join  bienes_inventario bi
on e.bn_id = bi.bn_id
left join laboratorios l
on l.id_lab = e.id_lab";
//where e.id_lab=";

switch ($_GET['orden']){
 			case "descripcion":
			//$query.= $_GET['lab'] . "order by bn_desc asc";
			$query = "order by bn_desc asc";
//			return $query;
 			break;
 			case "clave":
			//$query. = $_GET['lab'] . "order by bn_clave asc";
			$query = "order by bn_clave asc";
 			break;
			case "marca":
			//$query.= $_GET['lab'] . "order by bn_marca asc";
			$query=  "order by bn_marca asc";
 			break;
 			default:
			//$query.= $_GET['lab'] . "order by e.fecha desc";
			$query =  "order by e.fecha asc";
	//		return $query;
 			break;
}


// echo $query . "</br>"; 
// print_r($_REQUEST);
 ?>

<?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']  .'&orden='. $_REQUEST['orden'];?>
<!-- <form action="<?php echo $action1; ?>" method="post" name="fbusqueda">
<p style="text-align: right"> <input name="accion" type="submit" value="buscar" id="botonblu"/>
</form>-->
<div style="text-align: right"> <div id="botonblu" > <a href="<?php echo $action1 . '&accion=buscar';?>">Búsqueda</a></div></div>

<div class="block" id="necesidades_content">      

 <?php //echo "Responsable: " . $lab->getResponsable($_SESSION['id_usuario']); ?>
<table><tr><td>
<form action="inicio.html.php" method="get" name="orderby">
        Ordenar por: <select name="orden">
          <option value="orden" <?php echo $sel=(!isset($_GET['orden'])||$_GET['orden']=='orden') ? 'selected="selected"':''; ?>>Seleccione...</option>
          <option value="descripcion" <?php echo $sel=($_GET['orden']=='descripcion')? 'selected="selected"': "";?>>Descripción</option>
          <option value="clave" <?php echo $sel=($_GET['orden']=='clave')? 'selected="selected"': "";?>>No. Inventario</option>
          <option value="marca" <?php echo $sel=($_GET['orden']=='marca')? 'selected="selected"': "";?>>Marca</option>
           </select>
    
<?php
	echo "<input name='lab' type='hidden' value='". $_GET['lab']."' /> \n";
	echo "<input name='mod' type='hidden' value='".$_GET['mod']."' /> \n";
		?>

<input name="bOrden" type="submit" value="ordenar" />
</form>
</td><td>
<br />
    <form action="../inc/exportaxls_inv.inc.php" method="post" name="servbit" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="enviar" type="submit" value="Exportar a excel" />
	<input name="lab" type="hidden" value="<?php echo $_GET['lab'] ?>" />
	<input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
	</form>
    <br />
</td></tr>
</table>


<?php

	$datos = pg_query($con,$query);

		//while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		while ($lab_invent = pg_fetch_array($datos))
			 { 
		
    //  echo "</br>cantidad:" . $lab_nec['cant']; 
	//	echo "</br>Descripción:" . $lab_nec['descripcion']; 
	//  echo "</br>Cotización: "; echo $obj_cotiza->getCotiza($lab_nec['id_cotizacion']);
	?>
	
 <table class='material'>
  <tr>
<th width="95" scope="col">No. Inventario</th>
    <th width="113" scope="col">No. Inventario Anterior</th>
    <th width="236" scope="col">Descripción del equipo</th>
    <th width="80" scope="col">Marca</th>
    <th width="87" scope="col">Modelo</th>
    <th width="78" scope="col">Serie</th>
    <th width="85" scope="col">Fecha de adquisición</th>
    <th width="71" scope="col">Estado</th>
    <th width="123" scope="col">Modo de adquisición</th>  
 </tr>
  <tr>
    <td><?php echo $lab_invent['bn_clave'];?></td>
    <td><?php echo $lab_invent['bn_anterior'];?></td>
    <td><?php echo $lab_invent['bn_desc'];?></td>
    <td><?php echo $lab_invent['bn_marca'];?></td>
    <td><?php echo $lab_invent['bn_modelo'];?></td>
    <td><?php echo $lab_invent['bn_serie'];?></td>
    <td><?php echo date("d-m-Y", strtotime($lab_invent['bn_fadq']));?></td>
    <td><?php echo $lab_invent['co_descr'];?></td>
    <td><?php echo $madq->getModo($lab_invent['id_mod']); ?></td>
        
  </tr>
<form action="../inc/editainv.inc.php" method="post" name="req_mat_<?php echo $form=$lab_invent['id_lab'] ."_".$lab_invent['id_req'];?>">

  <tr ><td style="text-align: right" colspan="9"><!--<input name="accion" type="submit" value="editar" /><input name="accion" type="submit" value="borrar" /> --></td></tr>


<?php
foreach ($lab_invent as $campo => $valor) {
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