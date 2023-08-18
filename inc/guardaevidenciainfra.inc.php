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
	echo 'Valores en guardainfra eq';
	print_r($_POST); 
    echo 'valores de fguarda infre FILES';
    print_r ($_FILES);

	$tipoe='infra';
	$query="INSERT INTO evidencia (id_evidencia,tipo_evid,ruta_evidencia) VALUES('".$id_evid_aux. "','" . $tipoe . "','../evidencia_infra/" .$_REQUEST['lab'] . "_" .$id_req_aux."_". $_FILES["file1"]["name"]  ."')";
				
				echo "Tipo a: " . $_FILES["file1"]["type"] . "<br />";
				
				$allowedExts = array("jpg", "jpeg", "png" , "pdf", "PDF", "JPG" );
				$extension = end(explode(".", $_FILES["file1"]["name"]));
				echo "Extension: " . $extension . "</br>";
	            if ($_FILES["file1"]["type"] == "application/pdf" || $extension=="pdf" )
					
				  {
				   if ($_FILES["file1"]["error"] > 0)
					 {
					 echo "código de error: " . $_FILES["file1"]["error"] . "<br />";
					 }
				   else
					 {
					 echo "Archivo: " . $_FILES["file1"]["name"] . "<br />";
					 echo "Tipo: " . $_FILES["file1"]["type"] . "<br />";
					 echo "Tamaño: " . ($_FILES["file1"]["size"] / 1024) . " Kb<br />";
					 echo "Archivo temporal: " . $_FILES["file1"]["tmp_name"] . "<br />";
				
					 if (file_exists("../evidencia_infra/" . $_REQUEST['lab'] . "_". $id_req_aux."_". $_FILES["file1"]["name"]))
					   {
					    echo $_FILES["file1"]["name"] . " ya existe. ";
					   $_SESSION['error']['arch']='ea'; 
					   $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']. '&accion=nuevo' . '&id_evidencia="' . $_REQUEST['id_evidencia'] . '"' . '&descripcion="'. $_REQUEST['descripcion'] . '"' . '&div=' . $_REQUEST['div'] ;
						echo $direccion . "</br>";
						echo $_SESSION['error']['arch'];
						header($direccion);
						
					   }
					 else
					   {
						
						 $result = pg_query ($con, $query) or die('No se pudo insertar');
						   
						$queryaux="SELECT MAX(id_mot_evid) as maxmote FROM motivo_evidencia";
                        $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
                        $row = pg_fetch_array($resultx); 
                        $id_mote_aux=$row['maxmote']; 	
                        $id_mote_aux+=1;	

						$queryaux="SELECT MAX(id_req_just) as maxreqj FROM requerimiento_just";
                        $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
                        $row = pg_fetch_array($resultx); 
                        $id_reqj_aux=$row['maxreqj']; 	
                        
						/* ya se lleno tomar el ultimo valor    
						$queryrj="INSERT INTO requerimiento_just(id_req_just,id_lab_req,id) VALUES (%d,%d,%d)";	
						$queryn=sprintf($queryrj,$id_reqj_aux,$id_reqlab_aux,$_POST['id']);
						$result = pg_query ($con, $queryn) or die('No se pudo insertar');   */   
						  
                        $queryne="INSERT INTO motivo_evidencia(id_mot_evid,id_evidencia,id_req_just,fecha_implem,corrimiento,planeacion) VALUES (%d,%d,%d,'%s',%d,'%s')";	
						
						
                        $queryn=sprintf($queryne,$id_mote_aux,$id_evid_aux, $id_reqj_aux,$_POST['fecha_implem'],$_POST['corrimiento'],$_POST['planeacion']);
	                    $result = pg_query ($con, $queryn) or die('No se pudo insertar');
						     
					    $_SESSION['error']['arch']='';	   
					    echo "inserción" . $_SESSION['error']['arch'];
						   
					    move_uploaded_file($_FILES["file1"]["tmp_name"],"../evidencia_infra/" . $_REQUEST['lab'] . "_" .$id_req_aux."_". $_FILES["file1"]["name"]);
						   
					    echo "Almacenado en: " . "evidencia_infra/" . $_FILES["file1"]["name"];
					    $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'] .'&evidi='. $_FILES["file1"]["name"];
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