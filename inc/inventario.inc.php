
<?php  
//echo "solicitud a inventario.inc: "; 
//print_r($_REQUEST);
if (($_REQUEST['accion']=='buscar'||$_REQUEST['bbuscar']=='Buscar'|| $_REQUEST['accion']=='buscarg' || $_REQUEST['bbuscarg']=='Buscar') )
				{ //echo 'buscar en invgen';
				require_once('buscarcambio.inc.php');} 
				//else if ( $_REQUEST['lab']==NULL || (!isset($_REQUEST['lab'] ) && $_REQUEST['div']==NULL))
				else if (( $_REQUEST['lab']==NULL && !isset($_REQUEST['div'])) || (!isset($_REQUEST['lab'] )))
				{echo 'buscar en invgensin';
				require_once('cargainvent.inc.php');
				}
				else if (!isset($_REQUEST['accion']) || $_REQUEST['accion']=='')
				{ 
					require_once('cargainvent.inc.php');} 
			    else if ($_REQUEST['accion']=='editar' ) 
				    {require_once('edicion.inc.php');}
				else if ( $_REQUEST['accion']=='editarAR' || $_REQUEST['accion']=='editarG') 
				    {require_once('editarear.inc.php');}	
					
				else if ($_REQUEST['accion']=='nuevo') 
				{require_once('editainventario.inc.php');}
             
?>
