<?php
session_start();
require_once('../conexion.php');

/*error_reporting(E_ALL);
echo 'Errores al guardar';
echo ini_set('display_errors','On');*/

?>



<?php if(!isset($_POST['resp'])){ ?>
				<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'] .'&orden='. $_REQUEST['orden']. '&div='. $_REQUEST['div'];?>
              <table class="login"><tr><td><p>&iquest;Realmente desea borrar el registro?</p></td></tr>
              
                <form action="<?php echo $action; ?>" method="post" name="borrado">
                
                  <tr ><td style="text-align: center" colspan="4">
                  <input name="resp" type="submit" value="Si" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name="resp" type="submit" value="No" /></td></tr>
                    
                
                <?php
                foreach ($_REQUEST as $campo => $valor) {
                        //echo "\$usuario[$campo] => $valor.\n" . "</br>";
                echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
                
                }
                ?>
               <input name="mod" type="hidden" value="<?php echo $_GET['mod'];?>" />
              <!--  <input name="accion" type="hidden" value="borrar" />-->
                </form>
                </table>

<?php } else if ($_POST['resp']=='Si') { ?>

<?php
$id_cotizacion=$_POST['id_cotizacion'];

if($_POST['accion']=='Borrar'){

   $query="DELETE FROM cotizaciones WHERE id_cotizacion=" . $id_cotizacion;
   //echo $query;
   $result = pg_query ($con, $query) or die('No se pudo borrar');
   unlink($_POST['ruta']);
   //echo "Coti borrada </br>";
	
  $direccion='../view/inicio.html.php?mod=' . $_REQUEST['mod']. '&orden='. $_REQUEST['orden'] .'&lab=' . $_REQUEST['lab'] . '&div='.  $_REQUEST['div'];
	
  die('<script type="text/javascript">window.location=\''.$direccion.'\';</script>');	
   
		
   } 

 } else {
		//echo "No borrar";	
		
		 $direccion='../view/inicio.html.php?mod=' . $_REQUEST['mod']. '&orden='. $_REQUEST['orden'] .'&lab=' . $_REQUEST['lab'] . '&div='.  $_REQUEST['div'];
		
		//header($direccion);
	   die('<script type="text/javascript">window.location=\''.$direccion.'\';</script>');	

}



/*}else if ($_POST['accion']=='mod'){

echo "Entro a la parte de edición";

}else {
	$url="location:../modulo/cotizaciones.mod.php?lab=".$_POST['lab'] ."&dep=". $_POST['dep'] . "&div=" . $_POST['div'];
//echo $url;  
header($url);
		
	}*/
?>




