<?php  


			if (!isset($_REQUEST['accion']) || $_REQUEST['accion']=='')
				{require_once('cargacenso.inc.php');} 
			if ($_GET['mod']=='censo')
			     {require_once('cargacensoDGTIC.inc.php');} 



?>