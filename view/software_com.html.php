<?php 
require_once('../inc/encabezado.inc.php'); 
require_once('../inc/sesion.inc.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/divisiones.class.php');
$lab = new laboratorios();
$div = new departamentos();
 ?>
<tr>
              <td align="center"><h2>Utilización de software comercial</h2></td>
  </tr>
  <tr><?php if($_SESSION['tipo_usuario']==1 && $_REQUEST['lab'] !=NULL){?>
    <td align="center"><?php echo $lab->getLaboratorio($_REQUEST['lab']);?></td>

    <?php }else if($_SESSION['tipo_usuario']!=10 && $_SESSION['tipo_usuario']!=1 &&  $_REQUEST['lab'] !=NULL){?>
     <td align="center"><?php echo $lab->getLaboratorio($_REQUEST['lab']);?></td>
  
     <?php }else if($_SESSION['tipo_usuario']!=10 && $_SESSION['tipo_usuario']!=1 &&  $_REQUEST['lab'] ==NULL){?>
    <td align="center"><?php echo $div->getDivision($_REQUEST['div']);?></td>
    <?php } else if($_SESSION['tipo_usuario']==10){?>
             <td align="center"><?php echo $div->getDivision($_REQUEST['div']);?></td>
    <?php } ?>
  </tr>
  
   <?php
         if($_GET['lab']!='' && $_GET['div']==NULL ){?>
     <tr>
          <td><div class="centrado"> <?php require('../inc/software_com.inc.php');?></div></td>
     </tr>
   <?php  }else if ($_GET['lab']!='' && $_GET['div']!='' ){?>
      <tr>
          <td><div class="centrado"> <?php require('../inc/software_com.inc.php');?></div></td>
     </tr>
	 <?php  }else if($_GET['div']!=NULL && $_GET['lab']=='' ) {?>
		
	 <tr>
          <td><div class="centrado"> <?php require('../inc/software_com.inc.php');?></div></td>
     </tr>
	<?php 
	 }else if($_GET['div']==NULL && $_GET['lab']=='' ){?>
      <tr>
           <td><div class="centrado"> <?php require('../inc/software_com.inc.php');?></div></td>
      </tr>
 <?php  } ?>


<?php require('../inc/pie.inc.php'); ?>