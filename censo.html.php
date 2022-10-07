<?php 

require_once('../inc/sesion.inc.php');
require_once('../clases/laboratorios.class.php');

$lab = new laboratorios();

?>
 


<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
   
  



<td><div class="centrado"> 

<?php if (!isset($_GET['lab']) || $_GET['lab']==""){} else {require('../inc/censo.inc.php');}

?>

</div></td>         






<?php // require('../inc/pie.inc.php'); ?>