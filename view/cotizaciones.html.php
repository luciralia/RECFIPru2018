
<?php 
require_once('../inc/encabezado.inc.php'); 
require_once('../inc/sesion.inc.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/divisiones.class.php');
$lab = new laboratorios();
$div = new departamentos();
 ?>
<!--  <tr>
    <td><?php //require('../inc/menu.inc.php'); ?>&nbsp;</td>
  </tr> -->
  <!-- <tr>
    <td><?php //require('../inc/menu1.inc.php'); ?>&nbsp;</td>
  </tr>-->

<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
    
  <tr>
    <td align="center"><h2>Cotizaciones</h2></td>
  </tr>
   <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr>
    <?php if($_GET['lab']!='' && $_GET['div']==NULL ){?>
            <td align="center"><strong><h3><?php echo $lab->getLaboratorio($_GET['lab']);?></h3></strong></td>
    <?php }elseif ($_GET['lab']!='' && $_GET['div']!='' ){?>
            <td align="center"><strong><h3><?php echo $lab->getLaboratorio($_GET['lab']);?></h3></strong></td>
	<?php }elseif($_GET['div']!=NULL && $_GET['lab']==''){ ?>
            <td align="center"><strong><h3><?php echo $div->getDivision($_GET['div']);?></h3></strong></td>
    <?php }elseif($_GET['div']==NULL && $_GET['lab']=='' ){ ?>
            <td align="center"><strong><h3><?php echo $div->getDivision($_GET['div']);?></h3></strong></td>
    <?php } ?>
    
    </tr>
  <!--<tr>
          <td align="center"><strong><h3><?php // echo $lab->getLaboratorio($_GET['lab']);?></h3></strong></td>
  </tr>-->


<tr>
<td><div class="centrado"> <?php if (!isset($_GET['lab']) || $_GET['lab']==""){} else {
	require('../inc/cotizaciones.inc.php');
	} ?></div></td>
</tr>





<?php require('../inc/pie.inc.php'); ?>