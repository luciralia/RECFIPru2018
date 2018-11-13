<?php 
if (!isset($_REQUEST['accion']) || $_REQUEST['accion']=='') 
				{require_once('cargaserv.inc.php');
				} 
			else if ($_REQUEST['accion']=='borrar') 
				{require_once('borrarserv.inc.php');
				} 
			else if ($_REQUEST['accion']=='editar') 
				{require_once('editaservb.inc.php');
				}
			else if ($_REQUEST['accion']=='nuevo') 
				{require_once('editaservb.inc.php');
				}
			else if ($_REQUEST['accion']=='nuevob') 
				{require_once('editaservb.inc.php');
				}
			else if ($_REQUEST['accion']=='nuevobf') 
				{require_once('editaservb.inc.php');
				}
			else if ($_REQUEST['accion']=='nuevobp') 
				{require_once('editaservb.inc.php');
				}
			else if ($_REQUEST['accion']=='formato') 
				{require_once('excelbf.inc.php');
				}
			else if ($_REQUEST['accion']=='formato') 
				{require_once('excelbp.inc.php');
				}
?>
