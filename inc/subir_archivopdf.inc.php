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





if($_POST['accionm']=='Cancelar'|| $_POST['accionn']=='Cancelar'){ 
$_SESSION['error']['arch']='';
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div='. $_REQUEST['div'];
echo $direccion;
	
echo " Se canceló el cargar cotización";
header($direccion);
}

if($_POST['accionm']=='Enviar'|| $_POST['accionn']=='Enviar') {
	echo 'valores de flies';
print_r ($_FILES);
	
				$query="INSERT INTO cotizaciones (folio,proveedor,ruta,id_lab,tipo) VALUES('".$_POST['folio']. "','" . $_POST['proveedor'] . "','../cotizaciones/" . $id_lab . "_" . $_FILES["file"]["name"] . "',". $id_lab .",'" . $_POST['tipo']."')";
				
				echo $query;
				
				echo "Tipo a: " . $_FILES["file"]["type"] . "<br />";
				
				$allowedExts = array("jpg", "jpeg", "gif", "png", "pdf", "PDF", "JPG");
				$extension = end(explode(".", $_FILES["file"]["name"]));
				echo "Extension: " . $extension . "</br>";
				if ($_FILES["file"]["type"] == "application/pdf" || $extension=="pdf" /*&& ($_FILES["file"]["size"] < 20000)*/
				 /*&& in_array($extension, $allowedExts)*/)
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
				
					 if (file_exists("../cotizaciones/" . $id_lab . "_" . $_FILES["file"]["name"]))
					   {
					   echo $_FILES["file"]["name"] . " ya existe. ";
					   $_SESSION['error']['arch']='ea'; 
					   $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']. '&accion=nuevo' . '&folio="' . $_REQUEST['folio'] . '"' . '&proveedor="'. $_REQUEST['proveedor'] . '"' . '&div=' . $_REQUEST['div'] ;
						echo $direccion . "</br>";
						echo $_SESSION['error']['arch'];
						header($direccion);
					   }
					 else
					   {
					   
					   $result = pg_query ($con, $query) or die('No se pudo insertar');
					   $_SESSION['error']['arch']='';	   
					   echo "inserción" . $_SESSION['error']['arch'];
					   move_uploaded_file($_FILES["file"]["tmp_name"],"../cotizaciones/" . $id_lab . "_" . $_FILES["file"]["name"]);
					   echo "Almacenado en: " . "cotizaciones/" . $_FILES["file"]["name"];
					   
					   $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'];
						echo $direccion . "</br>";
						header($direccion);
						  
					   
					   }
					 }
				   }
				 else
				   {
				   echo "Archivo inv&aacute;lido, el formato de archivo debe ser .pdf";
				   $_SESSION['error']['arch']='ai'; 
					//$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&accion=nuevo' . '&folio="' . $_REQUEST['folio'] . '"' . '&proveedor="' . $_REQUEST['proveedor']  . '"' . '&div='. $_REQUEST['div'] ;
					$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&accion=nuevo' . '&folio="' . $_REQUEST['folio'] . '"' . '&proveedor="' . $_REQUEST['proveedor']  . '"' . '&div='. $_REQUEST['div'] ;   
					echo $direccion . "</br>";
					header($direccion);
				   }
																	
	}
					 
echo "no hice nada";
//$_SESSION['error']['arch']='';
//pg_close($con);


 ?>