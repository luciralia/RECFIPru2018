<?php 
session_start();
require_once('../conexion.php');
?>

<p>procesacot</p>
<p>&nbsp;</p>
<?php echo 'REQUST en procesacot';
print_r($_REQUST); ?>

<!-- /* Guarda datos de registro nuevo */-->
<?php if($_POST['accionn']=='Guardar'){ ?>
<h1>Nuevo</h1>
<?php 
/*$queryaux="Select max(id_nec) as maxid from necesidades_equipo where id_lab=". $_REQUEST['lab'];
$resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
$row = pg_fetch_array($resultx); 
$id_req_aux=$row['maxid']; 

echo "antes id_req_aux: " . $id_req_aux . "</br>";
$id_req_aux+=1;
echo "despues id_req_aux: " . $id_req_aux . "</br>";


$strquery="INSERT INTO necesidades_equipo (id_nec, id_lab, cant, descripcion, prioridad, plazo, justificacion, impacto, cto_unitario, id_cotizacion) VALUES (%d,%d,%d,'%s',%d,%d,%d,'%s',%.2f,%d)";
$queryn=sprintf($strquery,$id_req_aux,$_POST['lab'],$_POST['cant'],$_POST['descripcion'],$_POST['id_prio'],$_POST['id_plazo'],$_POST['id_just'],$_POST['impacto'],$_POST['cto_unitario'],$_POST['id_cotizacion']);


$result=@pg_query($con,$queryn) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());
echo $queryn;*/

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'].'&div='. $_SESSION['id_div'];
echo $direccion . "</br>";
header($direccion);

 }?>



<!-- Guarda datos de edicion de registro -->
<?php if($_POST['accionm']=='Guardar'){ ?>
<h1>Edicion</h1>
<?php 

/* *******************  actualiza *********** */

/*
$strquery="UPDATE necesidades_equipo SET id_nec=%d, id_lab=%d, cant=%d, descripcion='%s', prioridad=%d, plazo=%d, justificacion=%d, impacto='%s', cto_unitario=%.2f, id_cotizacion=%d, ref=%d where id_nec=" . $_POST['id_nec'] . " and id_lab=" . $_POST['lab'];
$queryu=sprintf($strquery,$_POST['id_nec'],$_POST['lab'],$_POST['cant'],$_POST['descripcion'],$_POST['id_prio'],$_POST['id_plazo'],$_POST['id_just'],$_POST['impacto'],$_POST['cto_unitario'],$_POST['id_cotizacion'],$_POST['ref']);


$result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());
*/
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'].'&div='. $_SESSION['id_div'];;
echo $direccion . "</br>";
header($direccion);
echo $queryu;


?>


<?php }?>
<?php if($_POST['accionm']=='borrar'){ 
/*
$strquery="delete from req_mat where id_nec=%d and id_lab=%d";
$queryd=sprintf($strquery,$_POST['id_nec'],$_POST['id_lab']);
//$result=pg_query($con,$queryd) or die('ERROR AL BORRAR DATOS: ' . pg_last_error());

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'];
echo $direccion . "</br>";
header($direccion);
echo $queryd;*/

?>

<?php }?>

<?php if($_POST['accionm']=='Cancelar'|| $_POST['accionn']=='Cancelar'){ 

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'].'&div='. $_SESSION['id_div'];;
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