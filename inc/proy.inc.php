<?php if (!isset($_REQUEST['accion']) || $_REQUEST['accion']=='') 
				{require_once('cargaproyecto.inc.php');} 
			else if ($_REQUEST['accion']=='borrar') 
				{require_once('borrarproy.inc.php');} 
			else if ($_REQUEST['accion']=='editar') 
				{require_once('editaproy.inc.php');}
			else if ($_REQUEST['accion']=='nuevo') 
				{require_once('editaproy.inc.php');}


?>
