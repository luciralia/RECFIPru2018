 
<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/requerimientos.class.php');
$obj_cotiza = new Cotiza();
$lab = new laboratorios();
$obj_req= new Requerimiento();
   echo 'Valores en carga software_desa';
	print_r($_POST); 


if ($_SESSION['tipo_usuario']==9 && ($_GET['lab']!='' && $_GET['div']!='') ){
	echo 'Entra a la consulta de lab';
$query = "SELECT s.id_responsable,desc_software,no_software,pila_respons,pat_respons,mat_respons,fecha_adq,s.id_software
FROM software s
JOIN area_software ars
ON s.id_software=ars.id_software
left JOIN resp_soft sr
ON sr.id_responsable=s.id_responsable
LEFT JOIN soft_desarrollo sd
ON sd.id_soft_desa=s.id_software
LEFT JOIN laboratorios l
ON l.id_lab=ars.id_lab
LEFT JOIN departamentos de
ON l.id_dep=de.id_dep
JOIN divisiones dv
ON de.id_div=dv.id_div
WHERE ars.id_lab=" . $_GET['lab'] ;	
} 
else if ($_SESSION['tipo_usuario']==9 && $_GET['lab']=='' && $_GET['div']!='') {
	
$query = "SELECT s.id_responsable,cs.id_tipo_soft,desc_tipo,desc_software,pila_respons,pat_respons,mat_respons,fecha_adq,proveedor,licencia
FROM software s
JOIN area_software ars
ON s.id_software=ars.id_software
left JOIN resp_soft sr
ON sr.id_responsable=s.id_responsable
LEFT JOIN soft_comercial sc
ON sc.id_soft_com=s.id_software
LEFT JOIN cat_software cs
ON cs.id_tipo_soft=sc.id_tipo_soft
LEFT JOIN laboratorios l
ON l.id_lab=ars.id_lab
LEFT JOIN departamentos de
ON l.id_dep=de.id_dep
JOIN divisiones dv
ON de.id_div=dv.id_div
WHERE dv.id_div=" . $_GET['div'];	
}else if ($_SESSION['tipo_usuario']==10 && $_GET['div']!='') {	
	
$query = "SELECT s.id_responsable,cs.id_tipo_soft,desc_tipo,desc_software,pila_respons,pat_respons,mat_respons,fecha_adq,proveedor,licencia
FROM software s
JOIN area_software ars
ON s.id_software=ars.id_software
left JOIN resp_soft sr
ON sr.id_responsable=s.id_responsable
LEFT JOIN soft_comercial sc
ON sc.id_soft_com=s.id_software
LEFT JOIN cat_software cs
ON cs.id_tipo_soft=sc.id_tipo_soft
LEFT JOIN laboratorios l
ON l.id_lab=ars.id_lab
LEFT JOIN departamentos de
ON l.id_dep=de.id_dep
JOIN divisiones dv
ON de.id_div=dv.id_div
WHERE dv.id_div=" . $_GET['div'] ;		
} else if ($_SESSION['tipo_usuario']==10 &&  $_GET['div']==NULL) {
	
$query = "SELECT s.id_responsable,cs.id_tipo_soft,desc_tipo,desc_software,pila_respons,pat_respons,mat_respons,fecha_adq,proveedor,licencia
FROM software s
JOIN area_software ars
ON s.id_software=ars.id_software
left JOIN resp_soft sr
ON sr.id_responsable=s.id_responsable
LEFT JOIN soft_comercial sc
ON sc.id_soft_com=s.id_software
LEFT JOIN cat_software cs
ON cs.id_tipo_soft=sc.id_tipo_soft
LEFT JOIN laboratorios l
ON l.id_lab=ars.id_lab
LEFT JOIN departamentos de
ON l.id_dep=de.id_dep
JOIN divisiones dv
ON de.id_div=dv.id_div
";	
}
echo 'query'. $query;
  ?>

<div class="block" id="necesidades_content">   


<?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=". $_REQUEST['div'];?>
<!--<form action="<?php echo $action1; ?>" method="post" name="fnuevo">
<p style="text-align: right"> <input name="accion" type="submit" value="nuevo" id="botonblu"/></p>
</form>-->

<?php if ($_SESSION['tipo_usuario']==9){ ?>
<div style="text-align: right"> <?php //if (($_SESSION['permisos'][2]%3)==0){ ?><div id="botonblu" > <a href="<?php echo $action1 . '&accion=nuevo';?>">Nueva solicitud</a></div></div>
<?php } ?>


<br>
<br> 

<?php 
$datos = pg_query($con,$query);
	
    $inventario= pg_num_rows($datos); 
	
	if ($inventario!=0 ){

?>   
<table>
<tr><td>
<br />
    <form action="../inc/exportaxls_equip.inc.php" method="post" name="servbit" >
	<input name="enviar" type="submit" value="Exportar a excel" />
	<input name="lab" type="hidden" value="<?php echo $_GET['lab'] ?>" />
    <input name="div" type="hidden" value="<?php echo $_GET['div'] ?>" />
    <input name="div" type="hidden" value="<?php echo $_REQUEST['div']?>" />
	<input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
	</form>
    <br />
</td></tr>
</table>

 <?php }//echo "Responsable: " . $lab->getResponsable($_SESSION['id_usuario']); ?> 

   
<?php
	
   $datos = pg_query($con,$query);
	
    $inventario= pg_num_rows($datos); 
	
	if ($inventario!=0 ){

		while ($soft = pg_fetch_array($datos, NULL, PGSQL_ASSOC)) 
			 { //FALTA VER LO DE LOS MANUALES

	?>                           <table class="equipo"  width="100%" border="0" cellpadding="5">
                      <tr align="left">
				        
                      	<th width="20%">Descripción del software</th>
                        <th width="20%">Número de Software</th>
                        <th width="25%">Desarrolló</th>	
                      	<th width="15%">Fecha de desarrollo </th>  
                       </tr>          

	                 <tr>
						
                        <td align="left"><?php echo $soft['desc_software']; ?></td> 
                        <td align="left"><?php echo $soft['no_software']; ?></td> 
                        <td align="left"><?php echo $soft['pila_respons']. ' '. $soft['pat_respons'].  ' '. $soft ['mat_respons']; ?></td>
                        <td align="left"><?php echo $soft['fecha_adq']; ?></td> 
                     </tr>
                    
<?php //if($_SESSION['tipo_usuario']==9){ ?> 
			<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=".   $_REQUEST['div'];?>
			<form action="<?php echo $action; ?>" method="post" name="req_eq_<?php echo $form=$soft['id_lab'] ."_".$soft['no_software'];?>">
			<?php if ($_SESSION['tipo_usuario']==9){ 
				?>
		          
			      <tr><td style="text-align: right" colspan="8"><input name="accion" type="submit" value="borrar" /></td> 
                      <td style="text-align: right"> <?php //if &nbsp;&nbsp;&nbsp;&nbsp;(($_SESSION['permisos'][2] %3)== 0){ ?><input name="accion" type="submit" value="editar" /></td>
              </tr>
              <?php }?>
	        <?php
				foreach ($soft as $campo => $valor) {
				        //echo "\$usuario[$campo] => $valor.\n" . "</br>";
				echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
				
				}
				?>
			</form>
</table> 
 <br>
	<?php	
		 	 
			}
			 }else { ?>
             <br>
             <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
             <tr> <td align="center"> <h3>No existe software desarrollado</h3> </td></tr>
	
		<?php }
		//$_SESSION['id_usuario']=$usuario['id_usuario'];


?>

  </div>