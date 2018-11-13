<?php 

require_once('file:///C|/xampp/htdocs/inc/sesion.inc.php');
require_once('file:///C|/xampp/htdocs/clases/laboratorios.class.php');

$lab = new laboratorios();
 ?>
 


<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
   
  <tr>
    <td align="center"><h2>Reportes <?php echo $titulo ;?> </h2></td>
  </tr>
  <tr>
    <td align="center"><?php //echo $lab->getLaboratorio($_GET['lab']);?></td>
  </tr>




<!--
<tr>

<td><div class="centrado"> <?php if (!isset($_GET['lab']) || $_GET['lab']==""){} else {require('file:///C|/xampp/htdocs/inc/reportes.inc.php');}

?>

</div></td>          
</tr>
-->




<?php // require('file:///C|/xampp/htdocs/inc/pie.inc.php'); ?>