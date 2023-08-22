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
	echo 'valores de flies';
    print_r ($_FILES);
	echo 'Valores en REQ procesa eq';
	print_r($_REQUEST);
	echo "Archivo: " . $_FILES["file"]["name"] . "<br />";
	?>
<!-- /* Guarda datos de registro nuevo */-->
	
<h1>Nuevo</h1>
<?php 
	if($_POST['accionn']=='Guardar'){
// Obtener id_lab_req
	echo 'iuardar';
	
    $queryaux="SELECT MAX(id_req) as maxidr FROM requerimiento_lab
    WHERE id_lab=". $_REQUEST['lab']; 
	
	//Obtiene el siguiente valor del requerimiento
	$resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
    $row = pg_fetch_array($resultx); 
	$id_req_aux=$row['maxidr']; 
	
    $id_req_aux+=1;		
	
	$strquery="INSERT INTO requerimiento_lab (id_lab,id_req, descripcion,id_just,otra_just,cantidad,id_recurso,id_motivo,fecha_solic) VALUES (%d,%d,'%s',%d,'%s',%d,%d,%d,'%s')";
    $queryr=sprintf($strquery,$_POST['lab'],$id_req_aux,$_POST['descripcion'],$_POST['id_just'],$_POST['otra_just'],$_POST['cantidad'], $_POST['id_recurso'],$_POST['id_just'], date('Y-m-d H:i:s'));
    $result=@pg_query($con,$queryr) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());
	
	
    $queryaux1="SELECT MAX(id_lab_req) as maxidlr FROM requerimiento_lab
    WHERE id_lab=". $_REQUEST['lab'];
	echo $queryaux;
	
	$resultx1=@pg_query($con,$queryaux1) or die('ERROR AL LEER DATOS: ' . pg_last_error());
    $row = pg_fetch_array($resultx1); 
	$id_reqlab_aux=$row['maxidlr']; 
	
   //El motivo es del catálogo de justificación se guarda en guardaevidenciaactual.inc.php
 
   //Funciones va con un check
   // Lectura del check
	
  for ($i=1;$i<=$_REQUEST['j'];$i++){
	 $val='id_funcion_'.+$i;
     echo 'val',$val;
     if (isset($_REQUEST[$val]))	{
		 echo 'valor',$_REQUEST[$val];
        $queryaux="SELECT MAX(id_func_req) AS maxidrf FROM requerimiento_funcion";
        $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
        $row = pg_fetch_array($resultx); 
        $id_reqf_aux=$row['maxidrf']; 
        $id_reqf_aux=$id_reqf_aux+1;	
	
        $proyquery="INSERT INTO requerimiento_funcion (id_func_req,id_lab_req,id_funcion,detalle_func,otro_cual) VALUES 
(%d,%d,%d,'%s','%s')";
        $queryd=sprintf($proyquery,$id_reqf_aux,$id_reqlab_aux,$_REQUEST[$val],$_REQUEST['detalle_func'],$_REQUEST['otro_cual']);
		echo $queryd;
        $result=@pg_query($con,$queryd) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        
	 }//if valor en id_nec_x
}//for inserta cada funcion requerimiento

// Guarda en requerimiento_justificación

$query_imp="SELECT MAX(id_req_imp) as maximpac FROM requerimiento_impacto";
$resulti=@pg_query($con,$query_imp) or die('ERROR AL LEER DATOS: ' . pg_last_error());
$row = pg_fetch_array($resulti); 
$id_impact_aux=$row['maximpac']; 
$id_impact_aux+=1;
$query_aux="INSERT INTO requerimiento_impacto(id_req_imp,id_lab_req,id_impacto,desc_impacto) VALUES(%d,%d,%d,'%s')";
$queryi=sprintf($query_aux, $id_impact_aux,$id_reqlab_aux,$_POST['id_impacto'],$_POST['desc_impacto']);
		
$resultx=@pg_query($con,$queryi) or die('ERROR AL LEER DATOS: ' . pg_last_error());		
	
//Guarda en evidencia actual	
require_once('guardaevidenciaactual.inc.php');	
//Guarda en evidencia de la infraestructura	
require_once('guardaevidenciainfra.inc.php');		
																
/*$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'];
echo $direccion;
header($direccion);*/

 }
	?>

<!-- Guarda datos de edicion de registro -->
<?php 
	if($_POST['accionm']=='Guardar'){ 
       echo 'En guardar'. print_r($_POST);
	   echo 'valores de archivos';
       print_r ($_FILES);	
?>
<h1>Edicion</h1>
<?php 

/* *******************  Obtener id evidencia y ruta*/
	
if (empty($_FILES["file"]["name"])){}else{
	// borrar evidencia por si se requiere cambiar a otros pdf
	/*
  $queryaux="SELECT id_evidencia FROM motivo_evidencia WHERE id_mot_evid=%d";
  $querye=sprintf($queryaux,$_POST['id_mot_evid']);
  $resultx=@pg_query($con,$querye) or die('ERROR AL LEER DATOS: ' . pg_last_error());
  $row = pg_fetch_array($resultx); 
  $id_evid=$row['id_evidencia']; 
  echo 'la evidencia es',$id_evid;	
  $queryaux="SELECT ruta_evidencia FROM evidencia WHERE id_evidencia=%d ";
  $querye=sprintf($queryaux,$id_evid);
  $resultx=@pg_query($con,$querye) or die('ERROR AL LEER DATOS: ' . pg_last_error());
  $row = pg_fetch_array($resultx); 
  $ruta=$row['ruta_evidencia']; 
  echo 'la evidencia es',$ruta;	

  $strquery1="DELETE FROM motivo_evidencia WHERE id_mot_evid=%d";
  $queryp=sprintf($strquery1,$_POST['id_mot_evid']);
  echo $queryp;
  $result=pg_query($con,$queryp) or die('ERROR AL BORRAR DATOS queryp: ' . pg_last_error());	
  		
  $strquery2="DELETE FROM evidencia WHERE id_evidencia=%d";
  $queryp=sprintf($strquery2,$id_evid);
  $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	

  unlink($ruta); 	
	*/
	//METER A UN ARCGJIVI
  $querye1="SELECT me.id_evidencia FROM evidencia e
            LEFT JOIN motivo_evidencia me
            ON e.id_evidencia=me.id_evidencia
            LEFT JOIN requerimiento_just rj
            ON rj.id_req_just=me.id_req_just
            LEFT JOIN requerimiento_lab rl
            ON rl.id_lab_req=rj.id_lab_req
            WHERE tipo_evid='actual' AND rl.id_lab_req=". $_POST['id_lab_req'];
	
	echo 'qurye1',$$querye1;
	
  $resulte1=@pg_query($con,$querye1) or die('ERROR AL LEER DATOS: ' . pg_last_error());
  $row = pg_fetch_array($resulte1); 
  $e1=$row['id_evidencia']; 
  echo 'evidencia1 es=',$e1;	
	 
  $querye2="SELECT me.id_evidencia FROM evidencia e
            LEFT JOIN motivo_evidencia me
            ON e.id_evidencia=me.id_evidencia
            LEFT JOIN requerimiento_just rj
            ON rj.id_req_just=me.id_req_just
            LEFT JOIN requerimiento_lab rl
            ON rl.id_lab_req=rj.id_lab_req
            WHERE tipo_evid='infra' AND rl.id_lab_req=". $_POST['id_lab_req'];
	echo 'qurye2',$$querye2;
	
  $resulte2=@pg_query($con,$querye2) or die('ERROR AL LEER DATOS: ' . pg_last_error());
  $row = pg_fetch_array($resulte2); 
  $e2=$row['id_evidencia']; 	
	echo 'evidencia es=',$e2;
  
  $queryaux="SELECT ruta_evidencia FROM evidencia WHERE id_evidencia=%d ";
  $querye=sprintf($queryaux,$e1);
  $resultx=@pg_query($con,$querye) or die('ERROR AL LEER DATOS: ' . pg_last_error());
  $row = pg_fetch_array($resultx); 
  $rutae1=$row['ruta_evidencia']; 
	
  echo 'la ruta evidencia es',$rutae1;	
  
  $queryaux="SELECT ruta_evidencia FROM evidencia WHERE id_evidencia=%d ";
  $querye=sprintf($queryaux,$e2);
  $resultx=@pg_query($con,$querye) or die('ERROR AL LEER DATOS: ' . pg_last_error());
  $row = pg_fetch_array($resultx); 
  $rutae2=$row['ruta_evidencia']; 
	
  echo 'la ruta evidencia es',$rutae2;		
	
  $strquery1="DELETE FROM motivo_evidencia WHERE id_evidencia=%d";
  $queryp=sprintf($strquery1,$e1);
  echo $queryp;
  $result=pg_query($con,$queryp) or die('ERROR AL BORRAR DATOS queryp: ' . pg_last_error());
	
  $strquery1="DELETE FROM motivo_evidencia WHERE id_evidencia=%d";
  $queryp=sprintf($strquery1,$e2);
  echo $queryp;
  $result=pg_query($con,$queryp) or die('ERROR AL BORRAR DATOS queryp: ' . pg_last_error());

  $strquery2="DELETE FROM evidencia WHERE id_evidencia=%d";
  $queryp=sprintf($strquery2,$e1);
  $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	
	
	
  $strquery2="DELETE FROM evidencia WHERE id_evidencia=%d";
  $queryp=sprintf($strquery2,$e2);
  $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	
	
  unlink($rutae1);
  unlink($rutae2);	
	
}//fin de validacion de archivos
 
	
 /* $strquery="INSERT INTO requerimiento_lab (id_lab,id_req, descripcion,id_just,otra_just,cantidad,id_recurso,id_motivo,fecha_solic)  VALUES (%d,%d,'%s',%d,'%s',%d,%d,%d,'%s')";
  $queryr=sprintf($strquery,$_POST['lab'],$id_req_aux,$_POST['descripcion'],$_POST['id_just'],$_POST['otra_just'],$_POST['cantidad'], $_POST['id_recurso'],$id_mot_aux, date('Y-m-d H:i:s'));
  $result=@pg_query($con,$queryr) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());
  
  $strquery="INSERT INTO sustitucion_motivo (id_motivo,motivo_desc,corrimiento,planeacion) VALUES (%d,'%s',%d,'%s')";	
$queryr=sprintf($strquery,$id_mot_aux,$_POST['motivo_desc'],$_POST['corrimiento'],$_POST['planeacion']);
$result=@pg_query($con,$queryr) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());
  
 */
		
 // Actualiza valores en requerimiento_lab	
		
	/*	
	$strquery="UPDATE sustitucion_motivo SET motivo_desc='%s', corrimiento=%d, planeacion='%s'
	           WHERE id_motivo=" . $_POST['id_motivo'];
	$queryu=sprintf($strquery,$_POST['motivo_desc'],$_POST['corrimiento'],$_POST['planeacion']);
	$result=pg_query($con,$queryu) or die ('ERROR AL ACTUALIZAR DATOS queryp:'.pg_last_error());	
	*/
	
    $strquery="UPDATE requerimiento_lab SET  id_lab=%d, id_req=%d, descripcion='%s', id_just=%d, otra_just='%s', cantidad=%d,  id_recurso=%d, id_motivo=%d, fecha_solic='%s' WHERE id_lab_req=" . $_POST['id_lab_req'];
	$queryu=sprintf($strquery,$_POST['lab'],$_POST['id_req'],$_POST['descripcion'],$_POST['id_just'],$_POST['otra_just'],$_POST['cantidad'],$_POST['impacto'],$_POST['id_recurso'],$_POST['id_motivo'], date('Y-m-d H:i:s'));
	$result=pg_query($con,$queryu) or die ('ERROR AL ACTUALIZAR DATOS queryp:'.pg_last_error());	
		
		
	//borrar lo anterior	BORRAR TODO? id_lab_req antes WHERE id_func_req=%d";
		
	$strquery2="DELETE FROM requerimiento_funcion WHERE id_lab_req=%d";
    $queryp=sprintf($strquery2,$_POST['id_lab_req']);
    $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	
		
		
		
		
	//Registra las funciones editadas
	
	for ($i=1;$i<=$_REQUEST['j'];$i++){
		
	 $val='id_funcion_'.+$i;
     echo 'val',$val;
     if (isset($_REQUEST[$val]))	{
		 echo 'valor',$_REQUEST[$val];
        $queryaux="SELECT MAX(id_func_req) AS maxidrf FROM requerimiento_funcion";
        $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
        $row = pg_fetch_array($resultx); 
        $id_reqf_aux=$row['maxidrf']; 
        $id_reqf_aux=$id_reqf_aux+1;	
	    $proyquery="INSERT INTO requerimiento_funcion (id_func_req,id_lab_req,id_funcion,detalle_func,otro_cual) VALUES 
       (%d,%d,%d,'%s','%s')";
        $queryd=sprintf($proyquery,$id_reqf_aux,$_REQUEST['id_lab_req'],$_REQUEST[$val],$_REQUEST['detalle_func'],$_REQUEST['otro_cual']);
		echo $queryd;
        $result=@pg_query($con,$queryd) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        
	 }//if valor en id_func_x
}	
	//Actualizar impacto 
	$strquery2="DELETE FROM requerimiento_impacto WHERE id_req_imp=%d";
    $queryp=sprintf($strquery2,$_POST['id_req_imp']);
    $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	
		
	$query_imp="SELECT MAX(id_req_imp) as maximpac FROM requerimiento_impacto";
    $resulti=@pg_query($con,$query_imp) or die('ERROR AL LEER DATOS: ' . pg_last_error());
    $row = pg_fetch_array($resulti); 
    $id_impact_aux=$row['maximpac']; 
    $id_impact_aux+=1;
    $query_aux="INSERT INTO requerimiento_impacto (id_req_imp,id_lab_req,id_impacto,desc_impacto) VALUES(%d,%d,%d,'%s')";
    $queryi=sprintf($query_aux, $id_impact_aux,$id_reqlab_aux,$_POST['id_impacto'],$_POST['desc_impacto']);
		
    $resultx=@pg_query($con,$queryi) or die('ERROR AL LEER DATOS: ' . pg_last_error());		
	
	//borrar requerimiento justificacion
		
	$strquery2="DELETE FROM requerimiento_just WHERE id_req_just=%d";
    $queryp=sprintf($strquery2,$_POST['id_req_just']);
    $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	
		
  //Guardar imagen por la actualización
	
if (empty($_FILES["file"]["name"]) || empty($_FILES["file1"]["name"]) ){
	$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'];
    echo $direccion;
    header($direccion);
}else{	
	
	
	//Guarda en evidencia actual	
    require_once('guardaevidenciaactual.inc.php');	
	// guarda evidencia de infraestructura
    require_once('guardaevidenciainfra.inc.php');	
	
 
}
} //fin de modificar>

/*	
 if($_POST['accionm']=='borrar'){ 
	
  $strquery2="DELETE FROM evidencia WHERE id_evidencia=%d";
  $queryp=sprintf($strquery2,$_POST['id_evidencia']);
  $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	

  unlink($_POST['ruta_evidencia']); 	
	
  $strquery1="DELETE FROM nec_evid WHERE id_nec=%d AND id_lab=%d";
  $queryp=sprintf($strquery1,$_POST['id_nec'],$_REQUEST['lab']);
  echo $queryp;
  $result=pg_query($con,$queryp) or die('ERROR AL BORRAR DATOS queryp: ' . pg_last_error());	
 	
	
	
  $strquery="DELETE FROM necesidades_equipo WHERE id_nec=%d AND id_lab=%d";
  $queryd=sprintf($strquery,$_POST['id_nec'],$_POST['id_lab']);
  $result=pg_query($con,$queryd) or die('ERROR AL BORRAR DATOS: ' . pg_last_error());

  $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'].'&div='. $_REQUEST['div'];
  echo $direccion . "</br>";
  header($direccion);

 }
*/
	
if($_POST['accionm']=='Cancelar'|| $_POST['accionn']=='Cancelar'){ 

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'];
echo $direccion;
header($direccion);

}?>

