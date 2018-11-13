<?php 

if (!isset($_REQUEST['accion']) || $_REQUEST['accion']=='') 
				{require_once('cargainfra.inc.php');} 
			else if ($_REQUEST['accion']=='borrar') 
				{require_once('borrarinfra.inc.php');} 
			else if ($_REQUEST['accion']=='editar') 
				{require_once('editainfra.inc.php');}
			else if ($_REQUEST['accion']=='nuevo') 
				{require_once('editainfra.inc.php');}
/*			else if ($_REQUEST['accion']=='nuevob') 
				{require_once('editaservb.inc.php');}*/


?>
