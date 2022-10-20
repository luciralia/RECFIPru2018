<?php 
session_start();
require_once('../conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>


<p>procesaeq</p>
<p>&nbsp;</p>
<?php 
	echo 'Valores en procesa eq';
	print_r($_POST); 
	echo 'Valores en REQ procesa eq';
	print_r($_REQUEST);?>

<!-- /* Guarda datos de registro nuevo */-->
<?php if($_POST['accionn']=='Guardar'){ ?>
<h1>Nuevo</h1>
<?php 
$queryaux="SELECT MAX(p.id_proy) as maxid FROM proy p";
          				
$resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
$row = pg_fetch_array($resultx); 
$id_proy_aux=$row['maxid']; 

echo "antes id_proy_aux: " . $id_proy_aux . "</br>";
$id_proy_aux=$id_proy_aux+1;
echo "despues id_proy_aux: " . $id_proy_aux . "</br>";



$strquery="INSERT INTO proy (id_proy,nombre_proy,objetivo_general, objetivo_especifico,descripcion_proy,num_equipo,justificacion,evidencia) VALUES (%d,'%s','%s','%s','%s',%d,'%s','%s')";
$queryn=sprintf($strquery,$id_proy_aux,$_POST['nombre_proy'],$_POST['objetivo_general'],$_POST['objetivo_especifico'],$_POST['descripcion_proy'],$_POST['num_equipo'],$_POST['justificacion'],'faltan');

echo $queryn;
	
$result=@pg_query($con,$queryn) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
echo $queryn;
/* Insertar datos en proyecto_nec*/
for ($i=1;$i<=$_REQUEST['j'];$i++){
	$val='id_nec_'.+$i;
     echo 'val',$val;
     if (isset($_REQUEST[$val]))	{
		 echo 'valor',$_REQUEST[$val];
        $queryaux="SELECT MAX(id_proy_nec) as maxidpn FROM proyecto_nec";
          				
        $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
        $row = pg_fetch_array($resultx); 
        $id_proyn_aux=$row['maxidpn']; 
        $id_proyn_aux=$id_proyn_aux+1;	
	
        $proyquery="INSERT INTO proyecto_nec (id_proy_nec,id_proy,id_lab,id_nec,fecha) VALUES 
(%d,%d,%d,%d,'%s')";
        $queryd=sprintf($proyquery,$id_proyn_aux,$id_proy_aux,$_REQUEST['lab'],$_REQUEST[$val],date('Y-m-d H:i:s'));
		  echo $queryd;
        $result=@pg_query($con,$queryd) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        echo $queryd;
	 }//if valor en id_nec_x
}//while
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'].'&div='. $_REQUEST['div'];
echo $direccion . "</br>";
header($direccion);

 }?>

<!-- Guarda datos de edicion de registro -->
<?php if($_POST['accionm']=='Guardar'){ 
echo 'En guardar'. print_r($_POST);?>
<h1>Edicion</h1>
<?php 

/* *******************  La buena solo que aqui no actualizo justificacion ni cotizacion ni plazo hasta que ponga los combos *********** */
$strquery="UPDATE proy SET nombre_proy='%s', objetivo_general='%s', objetivo_especifico='%s', descripcion_proy='%s', descripcion_nec='%s', num_equipo=%d, justificacion='%s', evidencia='%s'  WHERE id_proy=" . $_POST['id_proy'];
$queryu=sprintf($strquery,$_POST['nombre_proy'],$_POST['objetivo_general'],$_POST['objetivo_especifico'],$_POST['descripcion_proy'],$_POST['descripcion_nec'],$_POST['num_equipo'],$_POST['justificacion'],$_POST['evidencia']);
echo $queryu;

$result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());
	

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']. '&div=' . $_REQUEST['div'];
echo $direccion . "</br>";
header($direccion);
echo $queryu;


?>


<?php }?>
<?php if($_POST['accionm']=='borrar'){ 

$strquery="DELETE FROM proy WHERE id_proy=%d";
$queryd=sprintf($strquery,$_POST['id_proy']);
//$result=pg_query($con,$queryd) or die('ERROR AL BORRAR DATOS: ' . pg_last_error());

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'].'&div='. $_REQUEST['div'];
echo $direccion . "</br>";
header($direccion);
echo $queryd;

?>

<?php }?>

<?php if($_POST['accionm']=='Cancelar'|| $_POST['accionn']=='Cancelar'){ 

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'];
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