<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/requerimientos.class.php');
require_once('../clases/log.class.php');

$logger=new Log();
$obj_cotiza = new Cotiza();
$lab = new laboratorios();
$obj_req= new Requerimiento();

if ($_GET['mod']=='serv'){
$tiposerv="(em.tipo_serv IS NULL OR em.tipo_serv IS FALSE) ";
} else {$tiposerv='TRUE';
$tiposerv="em.tipo_serv IS TRUE";
}

$logger->putLog(37,2);

$query= "select nm.*, l.nombre  from nec_mobiliario nm, laboratorios l
where nm.id_lab=l.id_lab
and nm.id_lab="; 


switch ($_GET['orden']){
 			
			case "tipo":
			$query.= $_GET['lab'] . " order by tipo asc";
 			break;
 			case "espec":
			$query.= $_GET['lab'] . " order by especificaciones asc";
 			break;
 			default:
			$query.=$_GET['lab'] . " order by id_nec asc";
	//		return $query;
 			break;
}




// echo $query; ?>

<?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'] .'&orden='. $_GET['orden'];?>
<!-- <form action="<?php echo $action1; ?>" method="post" name="fnuevo">
<p style="text-align: right"> <input name="accion" type="submit" value="nuevo" id="botonblu"/>
</form>-->


<div style="text-align: right"><?php if (($_SESSION['permisos'][2]%3)==0){ ?> <div id="botonblu" > <a href="<?php echo $action1 . '&accion=nuevo';?>">Nueva solicitud</a></div><?php }?></div>

<div class="block" id="necesidades_content">      
<?php 
		 //echo "Responsable: " . $lab->getResponsable($_SESSION['id_usuario']); echo " Tipo de servicio: " . $_GET['mod'];?> 

<form action="inicio.html.php" method="get" name="orderby">
        Ordenar por: <select name="orden">
          <option value="orden" <?php echo $sel=(!isset($_GET['orden'])||$_GET['orden']=='orden') ? 'selected="selected"':''; ?>>Seleccione...</option>
          <option value="tipo" <?php echo $sel=($_GET['orden']=='tipo')? 'selected="selected"': "";?>>Tipo de mobiliario</option>
          <option value="espec" <?php echo $sel=($_GET['orden']=='espec')? 'selected="selected"': "";?>>Especificaciones</option>
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
<th width="86" scope="col">Cantidad</th>
    <!--<th width="150" scope="col">Tipo de servicio</th> -->
    <th width="113" scope="col">Tipo de mobiliario</th>
<?php if ($_REQUEST['mod']=='serv'){?>
   <!-- <th width="99" scope="col">Costo (cotizado)</th> -->
<?php }?>
    <th width="150" scope="col">Especificaciones</th>
    <th width="250" scope="col">Justificaci&oacute;n</th>
<!--    <th width="88" scope="col">Proveedor</th>-->
    <!--<th width="88" scope="col">Cotización</th> -->
<!--	<th width="88" scope="col">Pruebas gráficas</th>          Encabezado de columna imagen-->
    <!--<th width="63" scope="col">Inicio</th>
    <th width="64" scope="col">Término</th> -->
  </tr>
  <tr>
    <td><?php echo $serv_mant['cant'];?></td>
    <!--<td><?php echo $serv_mant['bn_desc'];?></td> -->
    <!--<td><?php echo $tipo=($serv_mant['tipo']=='c')?"Correctivo":"Preventivo";?></td> -->
    <td><?php if ($serv_mant['tipo']=='rm') {echo "Remplazo";}else if ($serv_mant['tipo']=='rp'){echo "Reparación";} else {echo "Ampliación";}?></td>
<?php if ($_REQUEST['mod']=='serv'){?>
    <!--<td><?php echo $serv_mant['costo'];?></td> -->
 <?php }?>
    <td><?php echo $serv_mant['especificaciones'];?></td>
        <td><?php echo $serv_mant['justificacion'];?></td>
<!--    <td><?php echo $serv_mant['provedor'];?></td>-->
   <!-- <td><?php echo $obj_cotiza->getCotiza($serv_mant['id_cotizacion']); ?></td> -->

<!--    <td><?php echo "<pdf>"; //Campo de ruta de imagen?></td> -->

 <!--   <td><?php echo date("d-m-Y", strtotime($serv_mant['fecha_inicio']));?></td>
    <td><?php echo date("d-m-Y", strtotime($serv_mant['fecha_termino']));?></td> -->

  </tr>

		<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'] .'&orden='. $_REQUEST['orden'];?>
<form action="<?php echo $action; ?>" method="post" name="nec_mob_<?php echo $form=$serv_mant['id_lab'] ."_".$serv_mant['id_nec'];?>">

  <tr ><td style="text-align: right" colspan="4"><input name="accion" type="submit" value="borrar" /><?php if (($_SESSION['permisos'][2]%3)==0){ ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="accion" type="submit" value="editar" /><?php }?></td></tr>


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

 


          </table>
                </div>