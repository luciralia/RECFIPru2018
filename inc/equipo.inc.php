<?php if (!isset($_REQUEST['accion']) || $_REQUEST['accion']=='') 
				{require_once('cargaeq.inc.php');} 
			else if ($_REQUEST['accion']=='borrar') 
				{require_once('borrareq.inc.php');} 
			else if ($_REQUEST['accion']=='editar') 
				{require_once('editaeq.inc.php');}
           
			else if ($_REQUEST['accion']=='nuevo') 
				{require_once('editaeq.inc.php');}


?>
