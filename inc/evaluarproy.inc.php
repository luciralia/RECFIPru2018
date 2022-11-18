
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script type="text/javascript">

function cargajust() {
		  var x = document.getElementById('id_just').value;
		 
		  if (x=="7")
		  
		      document.getElementById('otrajust').disabled = false; // habilitar
		  else
			  document.getElementById('otrajust').disabled = true; 
			    
			  // deshabilitar
			 
	 }
	
	

</script>	 
	 
<?php 

require_once('../clases/proyectos.class.php');
require_once('../clases/requerimientos.class.php');
$combonec = new proyecto();
$motivo = new Requerimiento();
$combousu= new laboratorios();
$comboproy= new proyecto();

$query="
SELECT *
FROM proy p
LEFT JOIN proyecto_nec pn
ON p.id_proy=pn.id_proy
LEFT JOIN proyecto_criterio pc
ON pc.id_proy_nec=pn.id_proy_nec
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

/*echo 'valores en editaproy', print_r($_POST);
echo 'valores en editaproy', print_r($_REQUEST);*/
//if ($_REQUEST['accion']=='nuevo'){  

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

     
<?php
	
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
	
// $datos = pg_query($con,$query);
	
  //  $inventario= pg_num_rows($datos); 
	
	//if ($inventario!=0 ){

		//while ($lab_proy = pg_fetch_array($datos, NULL, PGSQL_ASSOC)) 
			// { 

	?>              <table class="equipo"  width="100%" border="0" cellpadding="5">
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
                        <?php $combonec->selnecproy($_REQUEST['id_proy']); ?>
                  
						<?php $comboproy->califcrit($_REQUEST['id_proy']); ?>
                  </tr>
			<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=".   $_REQUEST['div'];?>
			
	        <?php
				/*foreach ($lab_proy as $campo => $valor) {
				   echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
				}*/
				?>
			
	        
  		
	
	<?php	//} ?>
		</table> 
	
		 <br>
	     
  
 <?php // } ?>