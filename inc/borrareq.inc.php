<?php 
ob_start( );
session_start();
require_once('../conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php if(!isset($_POST['resp'])){ ?>
				<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'] .'&orden='. $_REQUEST['orden'];?>
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

$strquery="delete from necesidades_equipo where id_nec=%d and id_lab=%d";
$queryd=sprintf($strquery,$_POST['id_nec'],$_POST['id_lab']);
$result=pg_query($con,$queryd) or die('ERROR AL BORRARR DATOS: ' . pg_last_error());

//$direccion='../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'];
//echo $direccion . "</br>";
//echo $queryd;
//header($direccion);?>

<script type="text/javascript">var dir=<?php echo $direccion='../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=';?> 
location.replace(dir); </script>

<?php } 

	} else {
		echo "No borrar";	
		//$direccion='../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&orden='. $_REQUEST['orden'];
		//header($direccion);
		//echo $direccion;
		//echo "<meta http-equiv=\"refresh\" content=\"0;URL=$direccion;\">";?>
        <script type="text/javascript">var dir=<?php echo $direccion='../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']. '&orden='. $_REQUEST['orden'];?> 
location.replace(dir); </script>
    
<?php
	}
/* if($result)
                     {
                        echo "<meta http-equiv=\"refresh\" content=\"0;URL=$direccion;\">";

}*/?>
				

