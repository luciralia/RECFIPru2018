 <?php 
session_start();
require_once('../conexion.php');

	
$queryaux="SELECT MAX(id_evidencia) as maxevid FROM evidencia";
$resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
$row = pg_fetch_array($resultx); 
$id_evid_aux=$row['maxevid']; 

echo "antes id_evid_aux: " . $id_evid_aux . "</br>";
$id_evid_aux+=1;
echo "despues id_evid_aux: " . $id_evid_aux . "</br>";
	

	
	$tipoe='actual';
	$query="INSERT INTO evidencia (id_evidencia,tipo_evid,ruta_evidencia) VALUES('".$id_evid_aux. "','" . $tipoe . "','../evidencia/" .$_REQUEST['lab'] . "_" .$id_req_aux."_". $_FILES["file"]["name"]  ."')";
				
				echo "Tipo a: " . $_FILES["file"]["type"] . "<br />";
				
				$allowedExts = array("jpg", "jpeg", "png" , "pdf", "PDF", "JPG" );
				$extension = end(explode(".", $_FILES["file"]["name"]));
				echo "Extension: " . $extension . "</br>";
	            if ($_FILES["file"]["type"] == "application/pdf" || $extension=="pdf" )
					
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
						$queryaux="SELECT MAX(id_mot_evid) as maxnevid FROM motivo_evidencia";
                        $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
                        $row = pg_fetch_array($resultx); 
                        $id_mote_aux=$row['maxnevid']; 

                        echo "antes id_mote_aux: " . $id_mote_aux . "</br>";
                        $id_mote_aux+=1;
                        echo "despues id_mote_aux: " . $id_mote_aux . "</br>";

                        $queryne="INSERT INTO motivo_evidencia (id_mot_evid,id_motivo, id_evidencia,fecha_implem) 
						VALUES (%d,%d,%d,'%s')";
                        $queryn=sprintf($queryne,$id_mote_aux,$id_mot_aux,$id_evid_aux,date('Y-m-d H:i:s'));
	
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
				   echo "Archivo inv&aacute;lido, el formato de archivo debe ser pdf";
				   $_SESSION['error']['arch']='ai'; 
					//$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&accion=nuevo' . '&folio="' . $_REQUEST['folio'] . '"' . '&proveedor="' . $_REQUEST['proveedor']  . '"' . '&div='. $_REQUEST['div'] ;
					$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&accion=nuevo' . '&id_evidencia="' . $_REQUEST['id_evidencia'] . '"' . '&descripcion="' . $_REQUEST['descripcion']  . '"' . '&div='. $_REQUEST['div'] ;   
					echo $direccion . "</br>";
					header($direccion);
				   }
														





?>