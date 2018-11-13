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

$logger->putLog(59,2);

$query= "select q.*, l.nombre as laboratorio, de.nombre as departamento, di.nombre as division 
from quejas q, laboratorios l, departamentos de, divisiones di
where l.id_dep=de.id_dep
AND de.id_div=di.id_div 
AND q.id_lab=l.id_lab
AND q.id_lab=" . $_GET['lab'] . "order by folio DESC"; 


// echo $query; ?>

<?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'] .'&orden='. $_GET['orden'];?>
<!-- <form action="<?php echo $action1; ?>" method="post" name="fnuevo">
<p style="text-align: right"> <input name="accion" type="submit" value="nuevo" id="botonblu"/>
</form>-->


<div style="text-align: right"><?php if (($_SESSION['permisos'][2]%3)==0){ ?> <div id="botonblu" > <a href="<?php echo $action1 . '&accion=nuevo';?>">Nueva queja, sugerencia o felicitación</a></div><?php }?></div>

<div class="block" id="necesidades_content">      

<?php

	$datos = pg_query($con,$query) or die('Existe un error con la base de datos' . pg_result_error($datos));

		while ($serv_mant = pg_fetch_array($datos, NULL, PGSQL_ASSOC)) 
			 { 
		

	?>
	
    <table class='serviciosm'>
  <tr>
	<th width="15" scope="col">Folio</th>
	<th width="86" scope="col">Usuario</th>
	<th width="86" scope="col">Tipo de usuario</th>
	<th width="113" scope="col">Queja, sugerencia o felicitación</th>
    	<th width="150" scope="col">Semestre</th>
    	<th width="60" scope="col">Fecha del evento</th>

  </tr>
<?php  if ($serv_mant['tipo_usuario']==2){$tipo_usuario='Alumno';}else if ($serv_mant['tipo_usuario']==3){$tipo_usuario='Académico';} else {$tipo_usuario='Administrativo';} ?>
  <tr>
    <td><?php echo $serv_mant['folio'];?></td>
    <td><?php echo $serv_mant['quejoso'];?></td>
    <td><?php echo $tipo_usuario;?></td>
    <td><?php echo $serv_mant['queja'];?></td>
    <td><?php echo $serv_mant['semestre'];?></td>  
    <td><?php echo date("d-m-Y", strtotime($serv_mant['fechareg']));?></td>


  </tr>
<tr ><td style="text-align: right" colspan="5">
		<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'] .'&orden='. $_REQUEST['orden'];?>
		<form action="<?php echo $action; ?>" method="post" name="quejas_<?php echo $form=$serv_mant['id_lab'] ."_".$serv_mant['id_queja'];?>">
		
		  <!--<input name="accion" type="submit" value="borrar" />-->
		  <?php if (($_SESSION['permisos'][2]%3)==0){ ?><input name="accion" type="submit" value="editar" /><?php }?>
		
		
		<?php
				foreach ($serv_mant as $campo => $valor) {
				        //echo "\$usuario[$campo] => $valor.\n" . "</br>";
				echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
		
				}
		
		?>
		<input name="mod" type="hidden" value="<?php echo $_GET['mod'];?>" />
		</form>
</td><td style="text-align: right" >
		<form action="../inc/excelquejas.inc.php" method="post" name="quejas_<?php echo $form=$serv_mant['id_lab'] ."_".$serv_mant['id_queja'];?>">
		
		  <!--<input name="accion" type="submit" value="borrar" />-->
		  <?php if (($_SESSION['permisos'][2]%3)==0){ ?><input name="formatoxls" type="submit" value="formato" /><?php }?>
		
		
		<?php
				foreach ($serv_mant as $campo => $valor) {
				        //echo "\$usuario[$campo] => $valor.\n" . "</br>";
				echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
		
				}
		
		?>
		<input name="mod" type="hidden" value="<?php echo $_GET['mod'];?>" />
		</form>

</td>
</tr>
</table>
</br>
<?php } //fin del while?>
    
     
    