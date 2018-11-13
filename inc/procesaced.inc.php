<?php 
session_start();
require_once('../conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>


<p>procesaced</p>
<p>&nbsp;</p>
<?php print_r($_POST); ?>

<!-- /* Guarda datos de registro nuevo */-->
<?php if($_POST['accionc']=='Guardar'){ ?>
<h1>Edición Cédula</h1>
<?php 

if(!isset($_POST['doc'])){$doc=1;} else {$doc=$_POST['doc'];}
if(!isset($_POST['inv'])){$inv=1;} else {$inv=$_POST['inv'];}
if(!isset($_POST['abi'])){$abi=1;} else {$abi=$_POST['abi'];}

$act_generales=$doc*$inv*$abi;
echo "act grales" . $act_generales;

$strquery="UPDATE laboratorios SET id_edif=%d, detalle_ub='%s', dir_postal='%s', capacidad=%d, carreras='%s', asignaturas='%s', act_generales=%d where id_lab=" . $_POST['lab'];
$queryu=sprintf($strquery,$_POST['id_edif'],$_POST['detalle_ub'],$_POST['postal'],$_POST['capacidad'],$_POST['carreras'],$_POST['asignaturas'],$act_generales);


$result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'];
echo $direccion . "</br>";
header($direccion);
echo $queryu;



}?>



<!-- Guarda datos de edicion de datos personales -->
<?php if($_POST['accionu']=='Guardar'){ ?>
<h1>Edicion usuario</h1>
<?php 

/* *******************  La buena solo que aqui no actualizo justificacion ni cotizacion ni plazo hasta que ponga los combos *********** */
$strquery="UPDATE usuarios SET nombre='%s', a_paterno='%s', a_materno='%s', email='%s', tel1='%s',tel2='%s', ext=%d where id_usuario=" . $_POST['id_usuario'];
$queryu=sprintf($strquery,$_POST['nombre'],$_POST['a_paterno'],$_POST['a_materno'],$_POST['email'],$_POST['tel1'],$_POST['tel2'],$_POST['ext']);


$result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'];
echo $direccion . "</br>";
header($direccion);
echo $queryu;


?>


<?php }?>
<?php if($_POST['accionm']=='borrar'){ 

/*$strquery="delete from req_mat where id_nec=%d and id_lab=%d";
$queryd=sprintf($strquery,$_POST['id_nec'],$_POST['id_lab']);
//$result=pg_query($con,$queryd) or die('ERROR AL BORRAR DATOS: ' . pg_last_error());

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'];
echo $direccion . "</br>";
header($direccion);
echo $queryd;*/

?>

<?php }?>

<?php if($_POST['accionc']=='Cancelar'|| $_POST['accionu']=='Cancelar'){ 

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'];
echo $direccion;
header($direccion);

}?>

<?php   //Codigo que podria servir en otros casos

/*$comp_query=array();
$i=0;
foreach ($_POST as $campo => $valor) {
		$comp_query[$i]= $campo	. "=" .$valor; 
		$i++;
//echo "\$usuario[$campo] => $valor.\n" . "</br>";
		//echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
}
$queryc=implode(",", $comp_query);
$queryu.=$queryc . " where id_req=" . $_POST['id_req'] . "and id_lab=" . $_POST['id_lab'];*/
?>