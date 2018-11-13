<?php 
//require_once('../inc/encabezado.inc.php'); 
require_once('../inc/sesion.inc.php');
require_once('../clases/laboratorios.class.php');

$lab = new laboratorios();
 ?>
<!--  <tr>
    <td><?php //require('../inc/menu.inc.php'); ?>&nbsp;</td>
  </tr> -->
  <!-- <tr>
    <td><?php //require('../inc/menu1.inc.php'); ?>&nbsp;</td>
  </tr>-->

<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
    
  <tr>
    <td align="center"><h2>Necesidades de Equipamiento</h2></td>
  </tr>
  <tr>
    <td align="center"><?php echo $lab->getLaboratorio($_GET['lab']);?></td>
  </tr>

  
<tr>
<td><div class="centrado"> <?php //require('../inc/cargaldd.inc.php'); ?></div></td>
</tr>
<tr>
<td><div class="centrado"> <?php if (!isset($_GET['lab']) || $_GET['lab']==""){} else {require('../inc/equipo.inc.php');} ?></div></td>
</tr>




<?php require('../inc/pie.inc.php'); ?>