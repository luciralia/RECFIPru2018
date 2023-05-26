<?php 

if (!isset($_REQUEST['accion']) || $_REQUEST['accion']=='') {
			require_once('cargasoftware_desar.inc.php'); echo 'Entra a aquí en software.com';
        }else if ($_REQUEST['accion']=='borrar') 
			require_once('borrarsoftware_desar.inc.php'); 
		else if ($_REQUEST['accion']=='editar' || $_REQUEST['accion']=='nuevo') 
			require_once('editasoftware_desar.inc.php');
       
			
?>