<?php 
//require_once('../inc/encabezado.inc.php'); 
require_once('../inc/sesion.inc.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/divisiones.class.php');
$lab = new laboratorios();
$div = new departamentos();
//echo "solicitud a inventario.html: "; 
//print_r($_REQUEST);
 ?>
 


<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
    <?php 
		  
		  if ($_GET['mod']=='inv')
	      {$titulo=' experimental ';}
		  elseif ($_GET['mod']=='invg')
		  {$titulo=' general';}
		  elseif ($_GET['mod']=='invc') {$titulo=' de cómputo';}
		  elseif ($_GET['mod']=='invear') {
			  {$titulo='Equipo de Alto Rendimiento';}
		  }
		  
		  ?>
  <tr>
    <td align="center"><h2>Inventario <?php echo $titulo ;?> </h2></td>
  </tr>
  <tr>
    <?php if($_SESSION['tipo_usuario']!=10){?>
    <td align="center"><?php echo $lab->getLaboratorio($_GET['lab']);?></td>
    <?php } else {?>
     
    <td align="center"><?php echo $div->getDivision($_SESSION['id_div']);?></td>
    <?php } ?>
  </tr>




<tr>

<td><div class="centrado"> 


<?php


if ((!isset($_GET['lab']) || $_GET['lab']=="" ) && $_GET['mod']=='invg'  ) {
	
	require('../inc/inventario.inc.php');
	}
	else if ($_GET['mod']=='invc') { //echo 'entra a invnetario con lab2';
	    require('../inc/inventario.inc.php');}
	  else if ( $_GET['mod']=='invear'  ) {
	      require('../inc/inventario.inc.php');}
	
	
?>

</div></td>          
</tr>

<?php

 require('../inc/pie.inc.php');
 
  ?>