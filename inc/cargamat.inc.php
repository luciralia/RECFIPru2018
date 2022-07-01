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
$query = "select distinct rm.id_req as id_req, rm.id_lab as id_lab,cant, rm.descripcion as descripcion, rm.unidad_medida as medida, cpn.descripcion as plazo, l.nombre as laboratorio, dp.nombre as departamento, di.nombre as division, cto_unitario as costo, act_generales as actividades, cjnm.descripcion as motivo, cjnm.id as num_just, impacto as justificacion, rm.id_cotizacion as id_cotizacion, rm.ref as ref
from req_mat rm, laboratorios l, divisiones di, departamentos dp, cat_plazo_nec cpn, cat_juztificacion_nec cjnm 
where rm.id_lab=l.id_lab 
and l.id_dep=dp.id_dep 
and dp.id_div=di.id_div 
and plazo=cpn.id 
and justificacion=cjnm.id
and l.id_lab=";


switch ($_GET['orden']){
 			case "descripcion":
			$query.= $_GET['lab'] . "order by descripcion asc";
//			return $query;
 			break;
 			case "reciente":
			$query.= $_GET['lab'] . "order by rm.ref desc";
 			break;
			case "antiguo":
			$query.= $_GET['lab'] . "order by rm.ref asc";
 			break;
 			default:
			$query.= $_GET['lab'] . "order by rm.ref desc";
	//		return $query;
 			break;
}

}
else if ($_SESSION['tipo_usuario']==9 && $_GET['lab']=='' && $_GET['div']!=''){
	$query = "select distinct rm.id_req as id_req, rm.id_lab as id_lab,cant, rm.descripcion as descripcion, rm.unidad_medida as medida, cpn.descripcion as plazo, l.nombre as laboratorio, dp.nombre as departamento, di.nombre as division, cto_unitario as costo, act_generales as actividades, cjnm.descripcion as motivo, cjnm.id as num_just, impacto as justificacion, rm.id_cotizacion as id_cotizacion, rm.ref as ref
from req_mat rm, laboratorios l, divisiones di, departamentos dp, cat_plazo_nec cpn, cat_juztificacion_nec cjnm 
where rm.id_lab=l.id_lab 
and l.id_dep=dp.id_dep 
and dp.id_div=di.id_div 
and plazo=cpn.id 
and justificacion=cjnm.id
and di.id_div=".$_REQUEST['div'];
	
}else if ($_SESSION['tipo_usuario']==10 && $_GET['div']!='') {
	$query = "select distinct rm.id_req as id_req, rm.id_lab as id_lab,cant, rm.descripcion as descripcion, rm.unidad_medida as medida, cpn.descripcion as plazo, l.nombre as laboratorio, dp.nombre as departamento, di.nombre as division, cto_unitario as costo, act_generales as actividades, cjnm.descripcion as motivo, cjnm.id as num_just, impacto as justificacion, rm.id_cotizacion as id_cotizacion, rm.ref as ref
from req_mat rm, laboratorios l, divisiones di, departamentos dp, cat_plazo_nec cpn, cat_juztificacion_nec cjnm 
where rm.id_lab=l.id_lab 
and l.id_dep=dp.id_dep 
and dp.id_div=di.id_div 
and plazo=cpn.id 
and justificacion=cjnm.id
and di.id_div=".$_REQUEST['div'];
	
}
else if ($_SESSION['tipo_usuario']==10 &&  $_GET['div']==NULL) {

	$query = "select distinct rm.id_req as id_req, rm.id_lab as id_lab,cant, rm.descripcion as descripcion, rm.unidad_medida as medida, cpn.descripcion as plazo, l.nombre as laboratorio, dp.nombre as departamento, di.nombre as division, cto_unitario as costo, act_generales as actividades, cjnm.descripcion as motivo, cjnm.id as num_just, impacto as justificacion, rm.id_cotizacion as id_cotizacion, rm.ref as ref
from req_mat rm, laboratorios l, divisiones di, departamentos dp, cat_plazo_nec cpn, cat_juztificacion_nec cjnm 
where rm.id_lab=l.id_lab 
and l.id_dep=dp.id_dep 
and dp.id_div=di.id_div 
and plazo=cpn.id 
and justificacion=cjnm.id";
	
}



	
 echo $query; ?>

<?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']. "&div=". $_REQUEST['div'];?>
<?php $action2="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=servi" ."&div=". $_REQUEST['div'];?>
<!--<form action="<?php echo $action1; ?>" method="post" name="fnuevo">
<p style="text-align: right"> <input name="accion" type="submit" value="nuevo" id="botonblu"/>
</form>-->
<div style="text-align: right"> <div class="recuadro2" style="display:inline"><p>Estimado usuario: Favor de indicar el(los) equipo(s) que recibirá(n) mantenimiento con el material que está solicitando.</p> </div><div id="botonblu" > <a href="<?php echo $action2;?>">Selección de equipo</a></div></div>
<div style="text-align: left"><?php if (($_SESSION['permisos'][2]%3)==0){ ?> <div id="botonblu" > <a href="<?php echo $action1 . '&accion=nuevo';?>">Nueva solicitud</a></div><?php }?></div>
<div class="block" id="necesidades_content">

<div class="block" id="necesidades_content">      

 <?php //echo "Responsable: " . $lab->getResponsable($_SESSION['id_usuario']); ?> 


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

	$datos = pg_query($con,$query);

		while ($lab_necmat = pg_fetch_array($datos, NULL, PGSQL_ASSOC)) 
			 { 
		
//		echo "</br>cantidad:" . $lab_nec['cant']; 
	//	echo "</br>Descripción:" . $lab_nec['descripcion']; 
	//  echo "</br>Cotización: "; echo $obj_cotiza->getCotiza($lab_nec['id_cotizacion']);
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

  <tr ><td style="text-align: right" colspan="8"><input name="accion" type="submit" value="borrar" /></td><td style="text-align: right">&nbsp;&nbsp;&nbsp;&nbsp;<?php if (($_SESSION['permisos'][2]%3)==0){ ?><input name="accion" type="submit" value="editar" /><?php } ?></td></tr>


<?php
foreach ($lab_necmat as $campo => $valor) {
        //echo "\$usuario[$campo] => $valor.\n" . "</br>";
echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";

}
?>
<input name="mod" type="hidden" value="<?php echo $_GET['mod'];?>" />
</form>

</table>
    </br>                
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