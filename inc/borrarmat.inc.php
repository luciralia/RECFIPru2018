<?php 
session_start();
require_once('../conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php if(!isset($_POST['resp'])){ ?>
				<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'] .'&orden='. $_REQUEST['orden'].'&div='. $_REQUEST['div'];?>
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
                <input name="accion" type="hidden" value="borrar" />
                </form>
                </table>

<?php } else if ($_POST['resp']=='Si') { ?>

<?php if($_POST['accion']=='borrar'){ 

$strquery="DELETE FROM req_mat WHERE id_req=%d AND id_lab=%d";
$queryd=sprintf($strquery,$_POST['id_req'],$_POST['id_lab']);
$result=pg_query($con,$queryd) or die('ERROR AL BORRAR DATOS: ' . pg_last_error());

$url='../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'].'&div='. $_REQUEST['div'];
//echo $direccion . "</br>";
//echo $queryd;
//header($direccion);
	 die('<script type="text/javascript">window.location=\''.$url.'\';</script>');	

} 

	} else {
		echo "No borrar";	
		$url='../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&orden='. $_REQUEST['orden'].'&div='. $_REQUEST['div'];
		//header($direccion);
		//echo $direccion;
	 die('<script type="text/javascript">window.location=\''.$url.'\';</script>');	
}
?>
