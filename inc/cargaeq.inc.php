 

<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/requerimientos.class.php');
$obj_cotiza = new Cotiza();
$lab = new laboratorios();
$obj_req= new Requerimiento();


//$query = "SELECT * FROM usuarios WHERE id_usuario =" . $_SESSION['id_usuario'];
//print_r ($_SESSION);
/*$query = "select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre, a_paterno, a_materno, de.nombre as depa, di.nombre as div
from laboratorios l, departamentos de, divisiones di, usuarios u where l.id_responsable =" . $_SESSION['id_usuario'] . " 
and id_lab=" . $_REQUEST['lab'] . "
and l.id_dep=de.id_dep
and de.id_div=di.id_div
and l.id_responsable=u.id_usuario";*/
//echo $query; Tenìa id_lab=" . $_POST['lab'] . " LHH 30/marzo

//$logger->putLog(31,2)
if ($_SESSION['tipo_usuario']==9 && $_GET['lab']!='' ){
$query = "select distinct id_nec, ne.id_lab as id_lab, cant, ne.descripcion, prioridad as id_prio, cpn.descripcion as plazo, cpn.id as id_plazo, l.nombre as laboratorio, de.nombre as departamento, dv.nombre as division, cto_unitario as costo, act_generales as actividades, cjn.descripcion as motivo, cjn.id as id_just, impacto , id_cotizacion, cto_unitario, ref ,otrajust
from necesidades_equipo ne, laboratorios l, divisiones dv, departamentos de, cat_plazo_nec cpn, cat_juztificacion_nec cjn
where ne.id_lab=l.id_lab 
and l.id_dep=de.id_dep 
and de.id_div=dv.id_div 
and plazo=cpn.id 
and justificacion=cjn.id
and ne.id_lab=" . $_GET['lab'] . 
"order by id_nec desc";
} else if ($_SESSION['tipo_usuario']==10 && $_GET['div']!='') {
$query = "select distinct id_nec, ne.id_lab as id_lab, cant, ne.descripcion, prioridad as id_prio, cpn.descripcion as plazo, cpn.id as id_plazo, l.nombre as laboratorio, de.nombre as departamento, dv.nombre as division, cto_unitario as costo, act_generales as actividades, cjn.descripcion as motivo, cjn.id as id_just, impacto , id_cotizacion, cto_unitario, ref ,otrajust
from necesidades_equipo ne, laboratorios l, divisiones dv, departamentos de, cat_plazo_nec cpn, cat_juztificacion_nec cjn
where ne.id_lab=l.id_lab 
and l.id_dep=de.id_dep 
and de.id_div=dv.id_div 
and plazo=cpn.id 
and justificacion=cjn.id
and dv.id_div=" . $_GET['div'] . 
"order by id_nec desc";	
} else if ($_SESSION['tipo_usuario']==10 &&  $_GET['div']==NULL) {
$query = "select distinct id_nec, ne.id_lab as id_lab, cant, ne.descripcion, prioridad as id_prio, cpn.descripcion as plazo, cpn.id as id_plazo, l.nombre as laboratorio, de.nombre as departamento, dv.nombre as division, cto_unitario as costo, act_generales as actividades, cjn.descripcion as motivo, cjn.id as id_just, impacto , id_cotizacion, cto_unitario, ref ,otrajust
from necesidades_equipo ne, laboratorios l, divisiones dv, departamentos de, cat_plazo_nec cpn, cat_juztificacion_nec cjn
where ne.id_lab=l.id_lab 
and l.id_dep=de.id_dep 
and de.id_div=dv.id_div 
and plazo=cpn.id 
and justificacion=cjn.id
order by id_nec desc";	
}else {}
	
// echo $query;
  ?>

<div class="block" id="necesidades_content">   


<?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'];?>
<!--<form action="<?php echo $action1; ?>" method="post" name="fnuevo">
<p style="text-align: right"> <input name="accion" type="submit" value="nuevo" id="botonblu"/></p>
</form>-->

<?php if ($_SESSION['tipo_usuario']==9){ ?>
<div style="text-align: right"> <?php //if (($_SESSION['permisos'][2]%3)==0){ ?><div id="botonblu" > <a href="<?php echo $action1 . '&accion=nuevo';?>">Nueva solicitud</a></div><?php // }?></div>
<div class="block" id="necesidades_content">  

<br>
<br> 

<?php } ?>   
<table>
<tr><td>
<br />
    <form action="../inc/exportaxls_equip.inc.php" method="post" name="servbit" >
	<input name="enviar" type="submit" value="Exportar a excel" />
	<input name="lab" type="hidden" value="<?php echo $_GET['lab'] ?>" />
    <input name="div" type="hidden" value="<?php echo $_GET['div'] ?>" />
	<input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
	</form>
    <br />
</td></tr>
</table>

 <?php //echo "Responsable: " . $lab->getResponsable($_SESSION['id_usuario']); ?> 

   
<?php
   

	$datos = pg_query($con,$query);

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
                        <td colspan="9" align="left" valign="top"><?php echo $lab_nec['impacto'];?><br /><hr /></td>
                      </tr>

			<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'];?>
			<form action="<?php echo $action; ?>" method="post" name="req_eq_<?php echo $form=$lab_nec['id_lab'] ."_".$lab_nec['id_nec'];?>">
			
			     <tr><td style="text-align: right" colspan="8"><input name="accion" type="submit" value="borrar" /></td>
                   <td style="text-align: right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php //if (($_SESSION['permisos'][2] %3)== 0){ ?><input name="accion" type="submit" value="editar" /><?php //}?>
                   </td>
              </tr>
	
				
				<?php
				foreach ($lab_nec as $campo => $valor) {
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

 <?php ?>

 
          
                </div>