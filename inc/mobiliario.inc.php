<?php 

if (!isset($_REQUEST['accion']) || $_REQUEST['accion']=='') 
				{require_once('cargamobi.inc.php');} 
			else if ($_REQUEST['accion']=='borrar') 
				{require_once('borrarmobi.inc.php');} 
			else if ($_REQUEST['accion']=='editar') 
				{require_once('editamob.inc.php');}
			else if ($_REQUEST['accion']=='nuevo') 
				{require_once('editamob.inc.php');}
			else if ($_REQUEST['accion']=='nuevomb') 
				{require_once('editamob.inc.php');}


?>
