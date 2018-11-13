<?php 

require_once('../inc/sesion.inc.php');
require_once('../clases/laboratorios.class.php');

$lab = new laboratorios();
 ?>
 


<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
   
  <tr>
    <td align="center"><h2>Reportes <?php echo $titulo ;?> </h2></td>
  </tr>
  <tr>
    <td align="center"><?php echo $lab->getLaboratorio($_GET['lab']);?></td>
  </tr>


<tr>
<td><div class="centrado"> <?php //require('../inc/cargaldd.inc.php'); ?></div></td>
</tr>




<tr>

<td><div class="centrado"> <?php if (!isset($_GET['lab']) || $_GET['lab']==""){} else {require('../inc/reportes.inc.php');}

?>

</div></td>          
</tr>





<?php require('../inc/pie.inc.php'); ?>