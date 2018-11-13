<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/requerimientos.class.php');
$obj_cotiza = new Cotiza();
$lab = new laboratorios();
$obj_req= new Requerimiento();

if ($_GET['mod']=='serv'){
$tiposerv="(em.tipo_serv IS NULL OR em.tipo_serv IS FALSE) ";
} else {$tiposerv='TRUE';
$tiposerv="em.tipo_serv IS TRUE";
}

$query = "SELECT l.id_lab as id_lab, em.id_evento as id_evento, em.id_bitacora as id_bitacora, em.tipo_mant as tipo, em.fecha as fregistro, em.tipo_falla as falla, em.usuario_reporta as reporta, em.fecha_salida as fsalida, em.fecha_recepcion as frecepcion, em.costo as costo, em.fecha_prox_mant as fprox, em.descripcion as desc_serv, em.garantia as garantia, bi.bn_desc as bn_desc, bi.bn_marca as marca, bi.bn_modelo as modelo, bi.bn_serie as serie, bi.bn_clave as clave, l.nombre AS laboratorio, dp.nombre AS departamento, dv.nombre AS division, u.nombre AS RL_Nombre, u.a_paterno AS RL_apaterno, u.a_materno AS RL_amaterno, em.id_cotizacion as id_cotizacion, em.ok as sitio, em.tipo_serv, e.bn_id as bn_id
FROM eventos_mantenimiento em, bitacora b, equipo e, bienes_inventario bi, laboratorios l, departamentos dp, divisiones dv, usuarios u
WHERE em.id_bitacora = b.id_bitacora 
AND bi.bn_id = e.bn_id 
AND e.bn_id = em.id_equipo 
AND e.id_lab = b.id_lab 
AND l.id_lab = e.id_lab 
AND l.id_dep = dp.id_dep 
AND dp.id_div = dv.id_div 
AND l.id_responsable=u.id_usuario 
AND " . $tiposerv . " 
AND l.id_lab=";

switch ($_GET['orden']){
 			case "equipo":
			$query.= $_GET['lab'] . " order by bn_desc asc, fregistro desc";
//			return $query;
 			break;
 			case "clave":
			$query.= $_GET['lab'] . " order by clave asc";
 			break;
 			case "reciente":
			$query.= $_GET['lab'] . " order by fregistro desc";
 			break;
			case "antiguo":
			$query.= $_GET['lab'] . " order by fregistro asc";
 			break;
 			default:
			$query.=$_GET['lab'] . " order by tipo, fregistro desc";
	//		return $query;
 			break;
}




// echo $query; ?>

<?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'] .'&orden='. $_GET['orden'];?>
<!-- <form action="<?php echo $action1; ?>" method="post" name="fnuevo">
<p style="text-align: right"> <input name="accion" type="submit" value="nuevo" id="botonblu"/>
</form>-->


<div style="text-align: right"> <div id="botonblu" > <a href="<?php echo $action1 . '&accion=nuevo';?>">Nuevo</a></div></div>	


<div class="block" id="necesidades_content">      
<?php 
		 //echo "Responsable: " . $lab->getResponsable($_SESSION['id_usuario']); echo " Tipo de servicio: " . $_GET['mod'];?> 

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
	echo "<input name='mod' type='hidden' value='".$_GET['mod']."' /> \n";
		?>

<input name="bOrden" type="submit" value="ordenar" />
</form>

<?php

	$datos = pg_query($con,$query) or die('Existe un error con la base de datos' . pg_result_error($datos));

		while ($serv_mant = pg_fetch_array($datos, NULL, PGSQL_ASSOC)) 
			 { 
		
//		echo "</br>cantidad:" . $serv_mant['cant']; 
	//	echo "</br>Descripción:" . $serv_mant['descripcion']; 
	//  echo "</br>Cotización: "; echo $obj_cotiza->getCotiza($serv_mant['id_cotizacion']);
	?>
	
    <table class='serviciosm'>
  <tr>
<th width="86" scope="col">Servicio de:</th>
    <!--<th width="150" scope="col">Tipo de servicio</th> -->
    <th width="113" scope="col">Tipo de servicio</th>
<?php if ($_REQUEST['mod']=='serv'){?>
   <!-- <th width="99" scope="col">Costo (cotizado)</th> -->
<?php }?>
    <th width="233" scope="col">Descripción del Servicio</th>
<!--    <th width="88" scope="col">Proveedor</th>-->
    <!--<th width="88" scope="col">Cotización</th> -->
<!--	<th width="88" scope="col">Pruebas gráficas</th>          Encabezado de columna imagen-->
    <th width="63" scope="col">Inicio</th>
    <th width="64" scope="col">Término</th>
  </tr>
  <tr>
    <td><?php echo $serv_mant['clave'];?></td>
    <!--<td><?php echo $serv_mant['bn_desc'];?></td> -->
    <td><?php echo $tipo=($serv_mant['tipo']=='C')?"Correctivo":"Preventivo";?></td>
<?php if ($_REQUEST['mod']=='serv'){?>
    <!--<td><?php echo $serv_mant['costo'];?></td> -->
 <?php }?>
    <td><?php echo $serv_mant['falla'];?></td>
<!--    <td><?php echo $serv_mant['provedor'];?></td>-->
   <!-- <td><?php echo $obj_cotiza->getCotiza($serv_mant['id_cotizacion']); ?></td> -->

<!--    <td><?php echo "<pdf>"; //Campo de ruta de imagen?></td> -->

    <td><?php echo date("d-m-Y", strtotime($serv_mant['fsalida']));?></td>
    <td><?php echo date("d-m-Y", strtotime($serv_mant['frecepcion']));?></td>

  </tr>

		<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'] .'&orden='. $_REQUEST['orden'];?>
<form action="<?php echo $action; ?>" method="post" name="req_mat_<?php echo $form=$serv_mant['id_lab'] ."_".$serv_mant['id_req'];?>">

  <tr ><td style="text-align: right" colspan="9"><input name="accion" type="submit" value="editar" /><input name="accion" type="submit" value="borrar" /></td></tr>


<?php
foreach ($serv_mant as $campo => $valor) {
        //echo "\$usuario[$campo] => $valor.\n" . "</br>";
echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";

}
?>
<input name="mod" type="hidden" value="<?php echo $_GET['mod'];?>" />
</form>
</table>

    </br>
     
    
    
    
    
    
<!--	<tr>
                        <td align="center"><?php echo $serv_mant['cant'];?></td>
                         <?php if($_SESSION['permisos'][2] % 3 == 0){ ?>
                  		<td align="left"><a href="#necesidades" onClick="javascript:editLabNecesidades(<?php echo $k?>);"><?php echo $serv_mant['descripcion'];?></a></td>
                        <?php }else{ ?>
                        <td align="left"><?php echo $serv_mant['descripcion'];?></td>
                        <?php } ?>
                        <td align="left">$<?php echo $serv_mant['cto_unitario'];?></td>
                        <td align="left">$<?php echo $serv_mant['cant']*$serv_mant['cto_unitario'];?></td>
                        <td align="left"><?php echo $serv_mant['prioridad'];?></td>
                        <td align="left"><?php echo $serv_mant['plazo'];?></td>
                        <td align="left"><?php echo $serv_mant['justificacion'];?></td>
                
                        
                        
                        <!-- <td align="left"><?php //echo $lab->getPrioridadNec($v['prioridad']);?></td>
                        <td align="left"><?php //echo $lab->getPlazoNec($v['plazo']);?></td>
                        <td align="left"><?php //echo $lab->getJustificacionNec($v['justificacion']);?></td>
                        <td align="left"><?php //echo $v['impacto'];?></td> -->
<!--                      </tr>
                      <tr>
                        <td colspan="9" align="left"><strong>Cotización: <?php echo $obj_cotiza->getCotiza($serv_mant['id_cotizacion']); ?></strong></td>
                      </tr>
	
     					<tr>
    	                  <td colspan="9" align="left"><strong>Justificación</strong></td>
	                    </tr>
                      <tr>
                        <td colspan="9" align="left" valign="top"><?php echo $serv_mant['impacto'];?><br />
                        <hr /></td>
                      </tr>
			<tr><td colspan="9" align="left">&nbsp;</td></tr>
			<tr><td colspan="9" align="left"><?php print_r($serv_mant); echo "</br>"?> &nbsp;</td></tr>-->
	
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
                        <td colspan="9" align="left" valign="top"><?php echo $serv_mant['impacto'];?><br />
                        <hr /></td>
                      </tr>
                   			 <!--<table width="100%"> -->
                   	  		<!--</table> -->
					  <?php } ?>
                      <?php if($_SESSION['permisos'][2] % 3 == 0){ ?>
                      		<tr>
                     		<td colspan="8" align="right"><a href="#necesidades" onClick="javascript:editLabNecesidades(0);">Nueva</a></td>2                            					</tr>
                        <?php } */?>


          </table>
                </div>