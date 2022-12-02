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
	
	require_once('guardaevidencia.inc.php');
	
   
 }

// Guarda datos de edicion de registro 
 if($_POST['accionm']=='Guardar'){ 
  echo 'En guardar'. print_r($_POST);?>
<h1>Edicion</h1>
<?php 
  //Primero borra proyecto_nec anterior 
    $query="DELETE FROM proyecto_nec WHERE id_proy=%d AND id_lab=%d";	
    $queryp=sprintf($query,$_POST['id_proy'],$_REQUEST['lab']);
    echo $queryp;
    $result=pg_query($con,$queryp) or die('ERROR AL BORRAR DATOS queryp: ' . pg_last_error());	
    //Actualiza en proyecto	
    $strquery="UPDATE proy SET nombre_proy='%s', objetivo_general='%s', objetivo_especifico='%s', descripcion_proy='%s', beneficio='%s',cantalum=%d, cantprof=%d,cantinvest=%d,id_impacto=%d,id_producto=%d, id_resp_acad=%d, id_resp_tec=%d,id_resp_admin=%d  WHERE id_proy=" . $_POST['id_proy'];
	$queryu=sprintf($strquery,$_POST['nombre_proy'],$_POST['objetivo_general'],$_POST['objetivo_especifico'],$_POST['descripcion_proy'],$_POST['beneficio'],$_POST['cantalum'],$_POST['cantprof'],$_POST['cantinvest'],$_POST['id_impacto'],$_POST['id_producto'],$_POST['id_resp_acad'],$_POST['id_resp_tec'],$_POST['id_resp_admin']);
    echo $queryu;
	$result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());
	
// cambia vlores de necesidades
for ($i=1;$i<=$_REQUEST['j'];$i++){
	$val='id_nec_'.+$i;
     echo 'val',$val;
     if (isset($_REQUEST[$val]))	{
		 echo 'valor',$_REQUEST[$val];
        $queryaux="SELECT MAX(id_proy_nec) AS maxidpn FROM proyecto_nec";
        $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
        $row = pg_fetch_array($resultx); 
        $id_proyn_aux=$row['maxidpn']; 
        $id_proyn_aux=$id_proyn_aux+1;	
	
        $proyquery="INSERT INTO proyecto_nec (id_proy_nec,id_proy,id_lab,id_nec,fecha) VALUES 
(%d,%d,%d,%d,'%s')";
        $queryd=sprintf($proyquery,$id_proyn_aux,$_POST['id_proy'],$_REQUEST['lab'],$_REQUEST[$val],date('Y-m-d H:i:s'));
		echo $queryd;
        $result=@pg_query($con,$queryd) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        
	 }//if valor en id_nec_x
}//for inserta cada necesidad proy
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']. '&div=' . $_REQUEST['div'];
echo $direccion . "</br>";
header($direccion);


 }
 if($_POST['accionm']=='borrar'){ 
	
	
  $strquery2="DELETE FROM evidencia_actual1 WHERE id_evid_actual=%d";
  $queryp=sprintf($strquery2,$_POST['id_evid_actual']);
  $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	

  unlink($_POST['ruta_evidencia_a']); 	
	
  $strquery1="DELETE FROM proy_evid_actual WHERE id_proy=%d";
  $queryp=sprintf($strquery1,$_POST['id_proy']);
  echo $queryp;
  $result=pg_query($con,$queryp) or die('ERROR AL BORRAR DATOS queryp: ' . pg_last_error());	
 		

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
