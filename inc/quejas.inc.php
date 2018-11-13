<?php 

if (!isset($_REQUEST['accion']) || $_REQUEST['accion']=='') 
				{require_once('cargaquejas.inc.php');} 
			else if ($_REQUEST['accion']=='borrar') 
				{require_once('borrarquejas.inc.php');} 
			else if ($_REQUEST['accion']=='editar') 
				{require_once('editaquejas.inc.php');}
			else if ($_REQUEST['accion']=='nuevo') 
				{require_once('editaquejas.inc.php');}
/*			else if ($_REQUEST['accion']=='nuevob') 
				{require_once('editaservb.inc.php');}*/


?>
