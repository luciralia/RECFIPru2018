<?php 
//require_once('../inc/encabezado.inc.php'); 
require_once('../inc/sesion.inc.php'); 
require_once('../clases/laboratorios.class.php'); ?>
<!--  <tr>
    <td><?php //require('../inc/menu.inc.php'); ?>&nbsp;</td>
  </tr> -->
  <!-- <tr>
    <td><?php //require('../inc/menu1.inc.php'); ?>&nbsp;</td>
  </tr>-->

<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
    
  <?php if ($_SESSION['tipo_usuario']!=10){  ?>
  <tr>
    <td align="center"><h3>Cédula de información</h3></td>
  </tr>
<?php } ?>
<tr>
<td><div class="centrado"> <?php //require('../inc/cargaldd.inc.php'); ?></div></td>
</tr>
<tr>
<td><div class="centrado"> <?php 

            // echo 'cedula.html.php';
			// print_r($_SESSION);
			if (!isset($_GET['lab']) || $_GET['lab']==""){} 
			
			else if ( $_REQUEST['editardp']=='Editar'){
			require_once('../inc/editadp.inc.php');
			
			} else if ( $_REQUEST['editarced']=='Editar'){
			require_once('../inc/editaced.inc.php');
			
			} else {
			
			require_once('../inc/cedula.inc.php');
					
			
			} ?></div></td>
</tr>




<?php require('../inc/pie.inc.php'); ?>