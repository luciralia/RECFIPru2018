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
	      {$titulo=' experimental';}
		  elseif ($_GET['mod']=='invg')
		  {$titulo=' general';}
		  elseif ($_GET['mod']=='invc') {$titulo=' de cómputo';}
		  elseif ($_GET['mod']=='invear') {
			  {$titulo='equipo de alto rendimiento';}
		  }
		  
		  ?>
  <tr> <td align="center"><h2>Inventario <?php echo $titulo;?> </h2></td></tr>
  
  <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr>
    <?php if($_SESSION['tipo_usuario']!=10 && $_REQUEST['lab']!='' && ($_REQUEST['div']==NULL || $_GET['mod']=='invear')){?>
    <td align="center"><strong><h3><?php echo $lab->getLaboratorio($_GET['lab']);?></h3></strong></td>
  
    <?php }elseif($_SESSION['tipo_usuario']!=10 && $_REQUEST['lab']!='' && $_REQUEST['div']!=NULL && ($_GET['mod']=='invg' || $_GET['mod']=='invear')){?>
	      <td align="center"><strong><h3><?php echo $lab->getLaboratorio($_GET['lab']);?></h3></strong></td>
    <?php }elseif($_REQUEST['div']!=NULL && $_REQUEST['lab']=='' && ($_GET['mod']=='invg' || $_GET['mod']=='invear') ){ ?>
            <td align="center"><strong><h3><?php echo $div->getDivision($_REQUEST['div']);?></h3></strong></td>
    <?php }elseif($_REQUEST['div']!=NULL && ($_GET['mod']=='invc' || $_GET['mod']=='invear') ){  ?>
          <td align="center"><strong><h3><?php echo $lab->getLaboratorio($_GET['lab']);?></h3></strong></td>
    <?php }elseif($_REQUEST['div']==NULL && $_REQUEST['lab']=='' && $_GET['mod']=='invg' ){ ?>
            <td align="center"><strong><h3><?php echo $div->getDivision($_REQUEST['div']);?></h3></strong></td>
    <?php } ?>
    
    </tr>
<tr>

<td><div class="centrado"> 


<?php


if ((!isset($_GET['lab']) || $_GET['lab']=='') && $_GET['mod']=='invg'  ) {
	//echo 'entra aquí';
	require('../inc/inventario.inc.php');
	}else if ($_SESSION['id_div']!='' && $_GET['lab']!='' ){
	  // echo 'entra a invnetario con div';
	   require('../inc/inventario.inc.php');		
	}else if ($_GET['mod']=='invc') { 
	 // echo 'entra a invnetario con lab2';
	    require('../inc/inventario.inc.php');}
	  else if ( $_GET['mod']=='invear'  ) {
	      require('../inc/inventario.inc.php');}
	
	
?>

</div></td>          
</tr>

<?php

 require('../inc/pie.inc.php');
 
  ?>