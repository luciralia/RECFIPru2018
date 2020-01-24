<?php 

require_once('../inc/sesion.inc.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/divisiones.class.php');
$lab = new laboratorios();
$div = new departamentos();
$dep = new departamentos();
 ?>
 


   
 <tr>
    <td align="center"><h2>Censo</h2></td>
  </tr>
  <tr><?php if($_SESSION['tipo_usuario']==1){?>
    <td align="center"><?php echo $lab->getLaboratorio($_REQUEST['lab']);?></td>

    <?php }else if($_SESSION['tipo_usuario']!=10 && $_SESSION['tipo_usuario']!=1){?>
    <td align="center"><?php echo $div->getDivision($_REQUEST['div']);?></td>
    <?php } else if($_SESSION['tipo_usuario']==10){?>
             <td align="center"><?php echo $div->getDivision($_REQUEST['div']);?></td>
    <?php } ?>
     
  </tr>
  
<tr>
<td><div class="centrado"> <?php require('../inc/cargacenso.inc.php'); ?></div></td>
</tr>




<tr>

<td><div class="centrado"> <?php if (!isset($_GET['lab']) || $_GET['lab']==""){} else {require('../inc/censo.inc.php');}

?>

</div></td>          
</tr>





<?php //require('../inc/pie.inc.php'); ?>