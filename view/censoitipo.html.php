
<?php 

require_once('../inc/sesion.inc.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/divisiones.class.php');
$lab = new laboratorios();
$div = new departamentos();

 ?>
 
  <tr>
              <td align="center"><h2>Censo de impresoras por tipo</h2></td>
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
  
<tr>
 <?php if ( $_GET['lab']==''){
 //( !isset($_GET['div'])|| !isset($_REQUEST['id_div']) ){ ?>
<td><div class="centrado"> <?php  require('../inc/cargacensoitipo.inc.php'); ?></div></td>
<?php } else{ ?>

<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
    
 <tr><td align="center"><h3> Este censo se obtiene únicamente a nivel Secretaría o División</h3></td> </tr>


 <?php } ?>
 
 
</tr>

<tr>

<td><div class="centrado"> <?php //if (!isset($_GET['lab']) || $_GET['lab']==""){} else {require('../inc/censo.inc.php');}
                            //if (isset($_GET['lab'])){require('../view/inicio.html.php');}  ?>

</div></td>          
</tr>


















