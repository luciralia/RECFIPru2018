 <?php 
session_start();
require_once('../conexion.php');


    $queryaux="SELECT MAX(p.id_proy) as maxid FROM proy p";
          				
    $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
    $row = pg_fetch_array($resultx); 
    $id_proy_aux=$row['maxid']; 

    echo "antes id_proy_aux: " . $id_proy_aux . "</br>";
    $id_proy_aux=$id_proy_aux+1;
    echo "despues id_proy_aux: " . $id_proy_aux . "</br>";

    $strquery="INSERT INTO proy (id_proy,nombre_proy,objetivo_general, objetivo_especifico,descripcion_proy,beneficio,cantalum,cantprof,cantinvest,id_impacto,id_producto,id_resp_acad,id_resp_tec,id_resp_admin) VALUES (%d,'%s','%s','%s','%s','%s',%d,%d,%d,%d,%d,%d,%d,%d)";
   $queryn=sprintf($strquery,$id_proy_aux,$_POST['nombre_proy'],$_POST['objetivo_general'],$_POST['objetivo_especifico'],$_POST['descripcion_proy'],$_POST['beneficio'],$_POST['cantalum'],$_POST['cantprof'],$_POST['cantinvest'],$_POST['id_impacto'],$_POST['id_producto'],$_POST['id_resp_acad'],$_POST['id_resp_tec'],$_POST['id_resp_admin']);
   echo $queryn;
   $result=@pg_query($con,$queryn) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    echo $queryn;
/* Insertar datos en proyecto_nec*/
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
        $queryd=sprintf($proyquery,$id_proyn_aux,$id_proy_aux,$_REQUEST['lab'],$_REQUEST[$val],date('Y-m-d H:i:s'));
		  echo $queryd;
        $result=@pg_query($con,$queryd) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        echo $queryd;
	 }//if valor en id_nec_x
}//for inserta cada necesidad proy

//comienza a guardar las evidencias del proyecto

$queryaux="SELECT MAX(id_evid_actual) as maxevid FROM evidencia_actual";
$resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
$row = pg_fetch_array($resultx); 
$id_evid_aux=$row['maxevid']; 

echo "antes id_evid_aux: " . $id_evid_aux . "</br>";
$id_evid_aux+=1;
echo "despues id_req_aux: " . $id_evid_aux . "</br>";
	
	$query="INSERT INTO evidencia_actual (id_evid_actual,ruta_evidencia_a) VALUES (".$id_evid_aux. ", '../evidencia_proy/" .$_REQUEST['lab'] . "_" .$id_proy_aux."_". $_FILES["file"]["name"]. "')";


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
				
					 if (file_exists("../evidencia_proy/" . $_REQUEST['lab'] . "_". $id_proy_aux."_". $_FILES["file"]["name"]))
					   {
					    echo $_FILES["file"]["name"] . " ya existe. ";
					   $_SESSION['error']['arch']='ea'; 
					   $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']. '&accion=nuevo' . '&id_evid_actual="' . $_REQUEST['id_evid_actual'] . '"' . '"' . '&div=' . $_REQUEST['div'] ;
						echo $direccion . "</br>";
						echo $_SESSION['error']['arch'];
						header($direccion);
						
					   }
					 else
					   {
						echo $query;
					    $result = pg_query ($con, $query) or die('No se pudo insertar');
						$queryaux="SELECT MAX(id_proy_evid) as maxproye FROM proy_evid_actual";
                        $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
                        $row = pg_fetch_array($resultx); 
                        $id_pe_aux=$row['maxproye']; 

                        echo "antes id_pe_aux: " . $id_pe_aux . "</br>";
                        $id_pe_aux+=1;
                        echo "despues id_pe_aux: " . $id_pe_aux . "</br>";

                        $querype="INSERT INTO proy_evid_actual(id_proy_evid,id_proy,id_evid_actual,fecha_evid) 
						VALUES (%d,%d,%d,'%s')";
                        $queryn=sprintf($querype,$id_pe_aux,$id_proy_aux,$id_evid_aux,date('Y-m-d H:i:s'));
	
                        $result = pg_query ($con, $queryn) or die('No se pudo insertar');   
					    $_SESSION['error']['arch']='';	   
					    echo "inserción" . $_SESSION['error']['arch'];
					    move_uploaded_file($_FILES["file"]["tmp_name"],"../evidencia_proy/" . $_REQUEST['lab'] . "_" .$id_proy_aux."_". $_FILES["file"]["name"]);
					    echo "Almacenado en: " . "evidencia_proy/" . $_FILES["file"]["name"];
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
					$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&accion=nuevo' . '&id_evid_actual="' . $_REQUEST['id_evid_actual'] . '"' . '"' . '&div='. $_REQUEST['div'] ;   
					echo $direccion . "</br>";
					header($direccion);
				   }
							





?>