<?php
session_start();
require_once('../conexion.php');
$id_lab=$_POST['lab'];

/*echo "los datos enviados son: <br />";
echo "el laboratorio es" . $_GET['lab'] . "<br/>";
echo "id de lab es:" . $id_lab . "<br/>";  
echo "Folio: " . $_POST['folio'] . "<br/>";
echo "Proveedor:" . $_POST['proveedor'] . "<br/>" ;
echo "tipo:" . $_POST['tipo'] . " <br/>";*/
/*
if($_POST['accionm']=='Cancelar'|| $_POST['accionn']=='Cancelar'){ 
$_SESSION['error']['arch']='';
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div='. $_REQUEST['div'];
echo $direccion;
echo " Se canceló el cargar cotización";
header($direccion);

}*/

print_r($_POST);

if($_POST['accionn']=='Guardar') {
	
				$query="INSERT INTO evidencia (id_evidencia,descripcion,ruta_evidencia) VALUES('".$_POST['id_evidencia']. "','" . $_POST['descripcion'] . "','../evidencia/" . $id_lab . "_" . $_FILES["file"]["name"] . "',". $id_lab .")";
				echo $query;
				
				echo "Tipo a: " . $_FILES["file"]["type"] . "<br />";
				
				$allowedExts = array("jpg", "jpeg", "gif", "png", "pdf", "PDF", "JPG");
				$extension = end(explode(".", $_FILES["file"]["name"]));
				echo "Extension: " . $extension . "</br>";
				if ($_FILES["file"]["type"] == "application/jpg" || $extension=="jpg" && in_array($extension, $allowedExts)) /*&& ($_FILES["file"]["size"] < 20000)*/
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
				
					 if (file_exists("../evidencia/" . $id_lab . "_" . $_FILES["file"]["name"]))
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
					   $_SESSION['error']['arch']='';	   
					   echo "inserción" . $_SESSION['error']['arch'];
					   move_uploaded_file($_FILES["file"]["tmp_name"],"../evidencia/" . $id_lab . "_" . $_FILES["file"]["name"]);
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
																	
	}
					 
echo "no hice nada";
//$_SESSION['error']['arch']='';
//pg_close($con);


 ?>