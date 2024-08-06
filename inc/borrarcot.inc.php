<?php
session_start();
require_once('../conexion.php');
?>

<?php //print_r($_REQUEST);?>

<?php if(!isset($_POST['resp'])){ ?>
				<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'] .'&orden='. $_REQUEST['orden']?>
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
                <input name="accion" type="hidden" value="Borrar" />
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
 //  $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] .  '&orden='. $_REQUEST['orden'];
  $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod']. '&lab=' . $_REQUEST['lab'] ;
   //echo "</br>" . $direccion . "</br>";
  
   echo "<meta http-equiv=\"refresh\" content=\"0;URL=$direccion;\">";
       // header($direccion);
		
   } 

 } else {
		//echo "No borrar";	
		
		$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod']. '&lab=' . $_REQUEST['lab'] ;
		
		// header($direccion);
	    echo "<meta http-equiv=\"refresh\" content=\"0;URL=$direccion;\">";
	
		
		
//echo "</br>" . $direccion . "</br>";
}

/*}else if ($_POST['accion']=='mod'){

echo "Entro a la parte de edición";

}else {
	$url="location:../modulo/cotizaciones.mod.php?lab=".$_POST['lab'] ."&dep=". $_POST['dep'] . "&div=" . $_POST['div'];
//echo $url;  
header($url);
		
	}*/
?>