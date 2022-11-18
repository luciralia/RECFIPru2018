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
	print_r($_REQUEST);?>

<!-- /* Guarda datos de registro nuevo */-->
<?php if($_POST['accionn']=='Guardar'){ ?>
<h1>Nuevo</h1>
<?php 
$queryaux="SELECT MAX(id_nec) as maxid FROM necesidades_equipo WHERE id_lab=". $_REQUEST['lab'];
$resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
$row = pg_fetch_array($resultx); 
$id_req_aux=$row['maxid']; 
//echo "antes id_req_aux: " . $id_req_aux . "</br>";
$id_req_aux+=1;
//echo "despues id_req_aux: " . $id_req_aux . "</br>";


$strquery="INSERT INTO necesidades_equipo (id_nec, id_lab, cant, descripcion, prioridad, plazo, justificacion, impacto, cto_unitario, id_cotizacion,otrajust,id_recurso) VALUES (%d,%d,%d,'%s',%d,%d,%d,'%s',%.2f,%d,'%s',%d)";
$queryn=sprintf($strquery,$id_req_aux,$_POST['lab'],$_POST['cant'],$_POST['descripcion'],$_POST['id_prio'],$_POST['id_plazo'],$_POST['id_just'],$_POST['impacto'],$_POST['cto_unitario'],$_POST['id_cotizacion'],$_POST['otrajust'], $_POST['id_recurso']);


$result=@pg_query($con,$queryn) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());
//echo $queryn;
	
//Guardar imagen
$queryaux="SELECT MAX(id_evidencia) as maxevid FROM evidencia";
$resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
$row = pg_fetch_array($resultx); 
$id_evid_aux=$row['maxevid']; 

echo "antes id_evid_aux: " . $id_evid_aux . "</br>";
$id_evid_aux+=1;
echo "despues id_req_aux: " . $id_evid_aux . "</br>";
	
	$query="INSERT INTO evidencia (id_evidencia,descripcion,ruta_evidencia) VALUES('".$id_evid_aux. "','" . $_POST['descripcion'] . "','../evidencia/" .$_REQUEST['lab'] . "_" .$id_req_aux."_". $_FILES["file"]["name"]  ."')";
				
				echo "Tipo a: " . $_FILES["file"]["type"] . "<br />";
				
				$allowedExts = array("jpg", "jpeg", "png" , "pdf", "PDF", "JPG" , "PNG" );
				$extension = end(explode(".", $_FILES["file"]["name"]));
				echo "Extension: " . $extension . "</br>";
				if ($_FILES["file"]["type"] == "application/pdf" || $extension=="pdf"  || in_array($extension, $allowedExts)) /*&& ($_FILES["file"]["size"] < 20000)*/
				 /*&& in_array($extension, $allowedExts)*/
					
				  {
				   if ($_FILES["file"]["error"] > 0)
					 {
					 echo "código de error: " . $_FILES["file"]["error"] . "<br />";
					 }
				   else
					 {
					 echo "Archivo: " . $_FILES["file"]["name"] . "<br />";
					 echo "Tipo: " . $_FILES["file"]["type"] . "<br />";
					 echo "Tamaño: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
					 echo "Archivo temporal: " . $_FILES["file"]["tmp_name"] . "<br />";
				
					 if (file_exists("../evidencia/" . $_REQUEST['lab'] . "_". $id_req_aux."_". $_FILES["file"]["name"]))
					   {
					    echo $_FILES["file"]["name"] . " ya existe. ";
					   $_SESSION['error']['arch']='ea'; 
					   $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']. '&accion=nuevo' . '&id_evidencia="' . $_REQUEST['id_evidencia'] . '"' . '&descripcion="'. $_REQUEST['descripcion'] . '"' . '&div=' . $_REQUEST['div'] ;
						echo $direccion . "</br>";
						echo $_SESSION['error']['arch'];
						header($direccion);
						
					   }
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

                        $queryne="INSERT INTO nec_evid (id_nec_evid,id_lab,id_nec, id_evidencia,fechaevid) 
						VALUES (%d,%d,%d,%d,'%s')";
                        $queryn=sprintf($queryne,$id_ne_aux,$_POST['lab'],$id_req_aux,$id_evid_aux,date('Y-m-d H:i:s'));
	
                        $result = pg_query ($con, $queryn) or die('No se pudo insertar');   
					    $_SESSION['error']['arch']='';	   
					    echo "inserción" . $_SESSION['error']['arch'];
					    move_uploaded_file($_FILES["file"]["tmp_name"],"../evidencia/" . $_REQUEST['lab'] . "_" .$id_req_aux."_". $_FILES["file"]["name"]);
					    echo "Almacenado en: " . "evidencia/" . $_FILES["file"]["name"];
					   
					   $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'];
						echo $direccion . "</br>";
						header($direccion);
						}
					 }
				   }
				 else
				   {
				   echo "Archivo inv&aacute;lido, el formato de archivo debe ser imagen";
				   $_SESSION['error']['arch']='ai'; 
					//$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&accion=nuevo' . '&folio="' . $_REQUEST['folio'] . '"' . '&proveedor="' . $_REQUEST['proveedor']  . '"' . '&div='. $_REQUEST['div'] ;
					$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&accion=nuevo' . '&id_evidencia="' . $_REQUEST['id_evidencia'] . '"' . '&descripcion="' . $_REQUEST['descripcion']  . '"' . '&div='. $_REQUEST['div'] ;   
					echo $direccion . "</br>";
					header($direccion);
				   }
																	
//Falta insertar en evidencia nec
	

/*	
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'].'&div='. $_REQUEST['div'];
echo $direccion . "</br>";
header($direccion);*/

 }
	?>

<!-- Guarda datos de edicion de registro -->
<?php if($_POST['accionm']=='Guardar'){ 
echo 'En guardar'. print_r($_POST);?>
<h1>Edicion</h1>
<?php 

/* *******************  Obtener id evidencia y ruta*/
	
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
	
  
	
  $strquery="UPDATE necesidades_equipo SET id_nec=%d, id_lab=%d, cant=%d, descripcion='%s', prioridad=%d, plazo=%d, justificacion=%d, impacto='%s', cto_unitario=%.2f, id_cotizacion=%d, ref=%d , otrajust='%s',id_recurso=%d where id_nec=" . $_POST['id_nec'] . " and id_lab=" . $_POST['lab'];
  $queryu=sprintf($strquery,$_POST['id_nec'],$_POST['lab'],$_POST['cant'],$_POST['descripcion'],$_POST['id_prio'],$_POST['id_plazo'],$_POST['id_just'],$_POST['impacto'],$_POST['cto_unitario'],$_POST['id_cotizacion'],$_POST['ref'],$_POST['otrajust'],$_POST['id_recurso']);
	$result=pg_query($con,$queryu) or die ('ERROR AL ACTUALIZAR DATOS queryp:'.pg_last_error());	
  //Guardar imagen por la actualización
	
	
  $queryaux="SELECT MAX(id_evidencia) as maxevid FROM evidencia";
  $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
  $row = pg_fetch_array($resultx); 
  $id_evid_aux=$row['maxevid']; 

  echo "antes id_evid_aux: " . $id_evid_aux . "</br>";
  $id_evid_aux+=1;
  echo "despues id_req_aux: " . $id_evid_aux . "</br>";
	
   $query="INSERT INTO evidencia1 (id_evidencia,descripcion,ruta_evidencia) VALUES('".$id_evid_aux. "','" . $_POST['descripcion'] . "','../evidencia/" .$_REQUEST['lab'] . "_" .$id_req_aux."_". $_FILES["file"]["name"]  ."')";
	
	echo "Tipo a: " . $_FILES["file"]["type"] . "<br />";
				
				$allowedExts = array("jpg", "jpeg", "png" , "pdf", "PDF", "JPG" , "PNG" );
				$extension = end(explode(".", $_FILES["file"]["name"]));
				echo "Extension: " . $extension . "</br>";
				if ($_FILES["file"]["type"] == "application/pdf" || $extension=="pdf" || in_array($extension, $allowedExts)) /*&& ($_FILES["file"]["size"] < 20000)*/
				 /*&& in_array($extension, $allowedExts)*/
					
				  {
				   if ($_FILES["file"]["error"] > 0)
					 {
					 echo "código de error: " . $_FILES["file"]["error"] . "<br />";
					 }
				   else
					 {
					 echo "Archivo: " . $_FILES["file"]["name"] . "<br />";
					 echo "Tipo: " . $_FILES["file"]["type"] . "<br />";
					 echo "Tamaño: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
					 echo "Archivo temporal: " . $_FILES["file"]["tmp_name"] . "<br />";
				
					 if (file_exists("../evidencia/" . $_REQUEST['lab'] . "_". $id_req_aux."_". $_FILES["file"]["name"]))
					   {
					    echo $_FILES["file"]["name"] . " ya existe. ";
					   $_SESSION['error']['arch']='ea'; 
						
			
					   $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']. '&accion=editar' .'&id_recurso="' . $_REQUEST['id_recurso'] . '"' .'id_evidencia="' . $_REQUEST['id_evidencia'] . '"' . '&descripcion="'. $_REQUEST['descripcion'] . '"' . '&div=' . $_REQUEST['div'] ;
						echo $direccion . "</br>";
						echo $_SESSION['error']['arch'];
						header($direccion);
						
					   }
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

                        $queryne="INSERT INTO nec_evid (id_nec_evid,id_lab,id_nec, id_evidencia,fechaevid) 
						VALUES (%d,%d,%d,%d,'%s')";
                        $queryn=sprintf($queryne,$id_ne_aux,$_POST['lab'],$id_req_aux,$id_evid_aux,date('Y-m-d H:i:s'));
	
                        $result = pg_query ($con, $queryn) or die('No se pudo insertar');   
					    $_SESSION['error']['arch']='';	   
					    echo "inserción" . $_SESSION['error']['arch'];
					    move_uploaded_file($_FILES["file"]["tmp_name"],"../evidencia/" . $_REQUEST['lab'] . "_" .$id_req_aux."_". $_FILES["file"]["name"]);
					    echo "Almacenado en: " . "evidencia/" . $_FILES["file"]["name"];
					   
					   $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'];
						echo $direccion . "</br>";
						header($direccion);
						}
					 }
				   }
				 else
				   {
				   echo "Archivo inv&aacute;lido, el formato de archivo debe ser imagen";
				   $_SESSION['error']['arch']='ai'; 
					   
					//$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&accion=nuevo' . '&folio="' . $_REQUEST['folio'] . '"' . '&proveedor="' . $_REQUEST['proveedor']  . '"' . '&div='. $_REQUEST['div'] ;
					$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&accion=editar' . '&id_recurso="' . $_REQUEST['id_recurso'] . '"' .'&id_evidencia="' . $_REQUEST['id_evidencia'] . '"' . '&descripcion="' . $_REQUEST['descripcion']  . '"' . '&div='. $_REQUEST['div'] ;   
					echo $direccion . "</br>";
					header($direccion);
				   }
} ?>
					
  	



<?php if($_POST['accionm']=='borrar'){ 
	
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