<?php 
session_start();
require_once('../conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>


<p>procesa Quejas</p>
<p>&nbsp;</p>
<?php print_r($_REQUEST); ?>

<!-- /* Guarda datos de registro nuevo */-->
<?php if($_POST['accionn']=='Guardar'){ ?>
<h1>Nuevo</h1>
<?php 
//Nuevo registro


$strquery="INSERT INTO quejas (id_lab, semestre, fechareg, tipo_usuario, queja, quejoso, email,clasificacion, relevancia, fecha) VALUES (%d,'%s','%s',%d,'%s','%s','%s','%s','%s','%s')";
$queryn=sprintf($strquery,$_REQUEST['lab'],$_POST['semestre'],$_POST['fechareg'],$_POST['tipo_usuario'],$_POST['queja'],$_POST['quejoso'],$_POST['email'],$_POST['clasificacion'],$_POST['relevancia'],date('Y-m-d H:i:s', strtotime($_POST['fecha'])));

echo $queryn;
$result=@pg_query($con,$queryn) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());


$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] .'&orden='. $_REQUEST['orden'];
echo $direccion . "</br>";
header($direccion);

 }?>



<!-- Guarda datos de edicion de registro -->
<?php if($_POST['accionm']=='Guardar'){ ?>
<h1>Edicion</h1>
<?php 
echo "en edicion " . "<br>"; print_r($_REQUEST); 

/* *******************  La buena  *********** */

$strquery="UPDATE quejas SET clasificacion='%s', relevancia='%s' WHERE id_queja=" . $_POST['id_queja'];
$queryu=sprintf($strquery,$_REQUEST['clasificacion'],$_REQUEST['relevancia']);
echo $queryu;
$result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] .'&orden='. $_REQUEST['orden'];
echo $direccion . "</br>";
header($direccion);



}?>


<?php if($_POST['accionm']=='Cancelar'|| $_POST['accionn']=='Cancelar'|| $_POST['accionb']=='Cancelar'){ 

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] .'&orden='. $_REQUEST['orden'];
echo $direccion;
header($direccion);

}?>

</html>








