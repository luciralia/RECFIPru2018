<?php echo'REQUEST en inc/proy';
print_r($_REQUEST);

if (!isset($_REQUEST['accion']) || $_REQUEST['accion']=='') 
				require_once('cargaproyecto.inc.php');
			else if ($_REQUEST['accion']=='borrar') 
				require_once('borrarproy.inc.php'); 
			else if ($_REQUEST['accion']=='editar') 
				require_once('editaproy.inc.php');
				 else if ($_REQUEST['accion']=='evaluar') 
				require_once('evaluarproy2.inc.php');
			else if ($_REQUEST['accion']=='nuevo') { echo 'Entra aqui y comienza...';
				require_once('editaproy.inc.php');
			}

?>
