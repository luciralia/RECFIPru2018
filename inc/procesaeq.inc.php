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
<?php if($_POST['accionn']=='Guardar'){ ?>
<h1>Nuevo</h1>
<?php 
// Obtener id_lab_req
	
	
    $queryaux="SELECT MAX(id_req) as maxidr FROM requerimiento_lab
    WHERE id_lab=". $_REQUEST['lab']; 
		
	
	//Obtiene el siguiente valor del requerimiento
	$resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
    $row = pg_fetch_array($resultx); 
	$id_req_aux=$row['maxidr']; 
	
    $id_req_aux+=1;		
	
	$strquery="INSERT INTO requerimiento_lab (id_lab,id_req, descripcion,id_just,otra_just,cantidad,id_recurso,id_motivo) VALUES (%d,%d,'%s',%d,'%s',%d,%d,%d)";
    $queryr=sprintf($strquery,$_POST['lab'],$id_req_aux,$_POST['descripcion'],$_POST['id_just'],$_POST['otra_just'],$_POST['cantidad'], $_POST['id_recurso'],$id_mot_aux);
    $result=@pg_query($con,$queryr) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());
	
	
    $queryaux1="SELECT MAX(id_lab_req) as maxidlr FROM requerimiento_lab
    WHERE id_lab=". $_REQUEST['lab'];
	echo $queryaux;
	
	$resultx1=@pg_query($con,$queryaux1) or die('ERROR AL LEER DATOS: ' . pg_last_error());
    $row = pg_fetch_array($resultx1); 
	$id_reqlab_aux=$row['maxidlr']; 
	
	
  // Guardar en sustitución_motivo	
	
   $queryaux="SELECT MAX(id_motivo) as maxmot FROM sustitucion_motivo";
   $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
   $row = pg_fetch_array($resultx); 
   $id_mot_aux=$row['maxmot']; 	
   $id_mot_aux+=1;	
	
$strquery="INSERT INTO sustitucion_motivo (id_motivo,motivo_desc,corrimiento,planeacion) VALUES (%d,'%s',%d,'%s')";	
$queryr=sprintf($strquery,$id_mot_aux,$_POST['motivo_desc'],$_POST['corrimiento'],$_POST['planeacion']);
$result=@pg_query($con,$queryr) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());
	
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
}//for inserta cada necesidad proyy

// Guarda en requerimiento_impacto o justificaciòn????
	
$query_imp="SELECT MAX(id_req_imp) as maximpac FROM requerimiento_impacto";
$resulti=@pg_query($con,$query_imp) or die('ERROR AL LEER DATOS: ' . pg_last_error());
$row = pg_fetch_array($resulti); 
$id_impact_aux=$row['maximpac']; 
$id_impact_aux+=1;
$query_aux="INSERT INTO requerimiento_impacto (id_req_imp,id_lab_req,id_impacto,desc_impacto) VALUES(%d,%d,%d,'%s')";
$queryi=sprintf($query_aux, $id_impact_aux,$id_reqlab_aux,$_POST['id_impacto'],$_POST['desc_impacto']);
	
//Guarda en evidencia actual	
require_once('guardaevidenciaactual.inc.php');	
//Guarda en evidencia de la infraestructura	
require_once('guardaevidenciainfra.inc.php');		


																	
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'];
echo $direccion;
header($direccion);

 }
	?>

<!-- Guarda datos de edicion de registro -->
<?php if($_POST['accionm']=='Guardar'){ 
echo 'En guardar'. print_r($_POST);
	echo 'valores de archivos';
    print_r ($_FILES);	
?>
<h1>Edicion</h1>
<?php 

/* *******************  Obtener id evidencia y ruta*/
	
if (empty($_FILES["file"]["name"])){}else{	
  $queryaux="SELECT id_evidencia FROM nec_evid WHERE id_nec=%d AND id_lab=%d";
  $querye=sprintf($queryaux,$_POST['id_nec'],$_REQUEST['lab']);
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

 $strquery1="DELETE FROM nec_evid WHERE id_nec=%d AND id_lab=%d";
  $queryp=sprintf($strquery1,$_POST['id_nec'],$_REQUEST['lab']);
  echo $queryp;
  $result=pg_query($con,$queryp) or die('ERROR AL BORRAR DATOS queryp: ' . pg_last_error());	
  		
  $strquery2="DELETE FROM evidencia WHERE id_evidencia=%d";
  $queryp=sprintf($strquery2,$id_evid);
	
  $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	

  unlink($ruta); 	
}
 
	
  $strquery="UPDATE necesidades_equipo SET id_nec=%d, id_lab=%d, cant=%d, descripcion='%s', prioridad=%d, plazo=%d, justificacion=%d, impacto='%s', cto_unitario=%.2f, id_cotizacion=%d, ref=%d , otrajust='%s',id_recurso=%d where id_nec=" . $_POST['id_nec'] . " and id_lab=" . $_POST['lab'];
  $queryu=sprintf($strquery,$_POST['id_nec'],$_POST['lab'],$_POST['cant'],$_POST['descripcion'],$_POST['id_prio'],$_POST['id_plazo'],$_POST['id_just'],$_POST['impacto'],$_POST['cto_unitario'],$_POST['id_cotizacion'],$_POST['ref'],$_POST['otrajust'],$_POST['id_recurso']);
	$result=pg_query($con,$queryu) or die ('ERROR AL ACTUALIZAR DATOS queryp:'.pg_last_error());	
  //Guardar imagen por la actualización
	
if (empty($_FILES["file"]["name"])){
	$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'];
    echo $direccion;
    header($direccion);
}else{		
  $queryaux="SELECT MAX(id_evidencia) as maxevid FROM evidencia";
  $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
  $row = pg_fetch_array($resultx); 
  $id_evid_aux=$row['maxevid']; 

  echo "antes id_evid_aux: " . $id_evid_aux . "</br>";
  $id_evid_aux+=1;
  echo "despues id_req_aux: " . $id_evid_aux . "</br>";
	
   $query="INSERT INTO evidencia (id_evidencia,descripcion,ruta_evidencia) VALUES('".$id_evid_aux. "','" . $_POST['descripcion'] . "','../evidencia/" .$_REQUEST['lab'] . "_" .$_POST['id_nec']."_". $_FILES["file"]["name"]  ."')";

	echo "Tipo a: " . $_FILES["file"]["type"] . "<br />";
				
				
				$allowedExts = array("jpg", "jpeg", "png" , "pdf", "PDF", "JPG"  );
				$extension = end(explode(".", $_FILES["file"]["name"]));
				echo "Extension: " . $extension . "</br>";
	            if ($_FILES["file"]["type"] == "application/pdf" || $extension=="pdf" )     
					
				  {
				   if ($_FILES["file"]["error"] > 0)
					 
					 echo "código de error: " . $_FILES["file"]["error"] . "<br />";
					
				   else
					 {
					 echo "Archivo: " . $_FILES["file"]["name"] . "<br />";
					 echo "Tipo: " . $_FILES["file"]["type"] . "<br />";
					 echo "Tamaño: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
					 echo "Archivo temporal: " . $_FILES["file"]["tmp_name"] . "<br />";
				
					 if (file_exists("../evidencia/" . $_REQUEST['lab'] . "_". $_POST['id_nec']."_". $_FILES["file"]["name"]))
					   {
					    echo $_FILES["file"]["name"] . " ya existe. ";
					   $_SESSION['error']['arch']='ea'; 
						
			
					   $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']. '&accion=editar' .'&id_recurso="' . $_REQUEST['id_recurso'] . '"' .'id_evidencia="' . $_REQUEST['id_evidencia'] . '"' . '&descripcion="'. $_REQUEST['descripcion'] . '"' . '&div=' . $_REQUEST['div'] ;
						echo $direccion . "</br>";
						echo $_SESSION['error']['arch'];
						header($direccion);
						
					   } //fin de almacenar en evidencia
					 else
					   {
					    $result = pg_query ($con, $query) or die('No se pudo insertar');
						   
						$queryaux="SELECT MAX(id_nec_evid) as maxnevid FROM nec_evid";
                        $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
                        $row = pg_fetch_array($resultx); 
                        $id_ne_aux=$row['maxnevid']; 

                        echo "antes id_ne_aux: " . $id_ne_aux . "</br>";
                        $id_ne_aux+=1;
                        echo "despues id_ne_aux: " . $id_ne_aux . "</br>";

                        $queryne="INSERT INTO nec_evid (id_nec_evid,id_lab,id_nec,id_evidencia,fechaevid) 
						VALUES (%d,%d,%d,%d,'%s')";
                        $queryn=sprintf($queryne,$id_ne_aux,$_POST['lab'],$_POST['id_nec'],$id_evid_aux,date('Y-m-d H:i:s'));
	
                        $result = pg_query ($con, $queryn) or die('No se pudo insertar');   
					    $_SESSION['error']['arch']='';	   
					    echo "inserción" . $_SESSION['error']['arch'];
					    move_uploaded_file($_FILES["file"]["tmp_name"],"../evidencia/" . $_REQUEST['lab'] . "_" .$_POST['id_nec']."_". $_FILES["file"]["name"]);
					    echo "Almacenado en: " . "evidencia/" . $_FILES["file"]["name"];
					   
					   $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'];
						echo $direccion . "</br>";
						header($direccion);
						}// fin de else evidencia
					 }// fin de else error
				   }// fin de validar en pdf
				 else
				   {
				   echo "Archivo inv&aacute;lido, el formato de archivo debe ser imagen";
				   $_SESSION['error']['arch']='ai'; 
					   
					//$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&accion=nuevo' . '&folio="' . $_REQUEST['folio'] . '"' . '&proveedor="' . $_REQUEST['proveedor']  . '"' . '&div='. $_REQUEST['div'] ;
					$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&accion=editar' . '&id_recurso="' . $_REQUEST['id_recurso'] . '"' .'&id_evidencia="' . $_REQUEST['id_evidencia'] . '"' . '&descripcion="' . $_REQUEST['descripcion']  . '"' . '&div='. $_REQUEST['div'] ;   
					echo $direccion . "</br>";
					header($direccion);
				   }
	}//fin de else de validar pdf
} //fin de modificar>

	
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

if($_POST['accionm']=='Cancelar'|| $_POST['accionn']=='Cancelar'){ 

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'];
echo $direccion;
header($direccion);

}?>

