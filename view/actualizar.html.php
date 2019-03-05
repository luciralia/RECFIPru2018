<?php 
//require_once('../inc/encabezado.inc.php'); 
require_once('../inc/sesion.inc.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/divisiones.class.php');
$lab = new laboratorios();
$div = new departamentos();
//echo "solicitud a inventario.html: "; 
//print_r($_REQUEST);
$titulo='Actualizar Dispositivos';
 ?>
 


<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
    
  <tr>
    <td align="center"><h2><?php echo $titulo ;?> </h2></td>
  </tr>
  


<tr>

<td><div class="centrado"> 


<?php


if ((!isset($_GET['lab']) || $_GET['lab']=="" ) && $_GET['mod']=='invg'  ) {
	
	require('../inc/actualizar.inc.php');
	}
	else { 
	require('../inc/actualizar.inc.php');}
	
	
	
?>

</div></td>          
</tr>

<?php

 require('../inc/pie.inc.php');
 
  ?>