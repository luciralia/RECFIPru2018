<?php 

if (!isset($_REQUEST['accion']) || $_REQUEST['accion']=='') 
			require_once('cargasoftware_com.inc.php'); 
   else if ($_REQUEST['accion']=='borrar') 
			require_once('borrarsoftware_com.inc.php'); 
		else if ($_REQUEST['accion']=='editar' || $_REQUEST['accion']=='nuevo') 
			require_once('editasoftware_com.inc.php');
        
			
?>
