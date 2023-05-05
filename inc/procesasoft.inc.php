
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
	echo 'Valores en procesa soft';
	print_r($_POST); 
	echo 'Valores en REQ procesa soft';
	print_r($_REQUEST);
	
	?>

<!-- /* Guarda datos de registro nuevo */-->
<?php if($_POST['accionn']=='Guardar'){ ?>
<h1>Nuevo</h1>
<?php 
	
	if ($_POST['licencia']=='Si')
	$lic='1';
	else $lic='0';
	// Buscar al responsable del software
	
	$query="SELECT id_responsable FROM resp_soft WHERE pila_respons='".$_POST['pila_respons']. 
		   "' AND pat_respons= '".$_POST['pat_respons']."' AND mat_respons='".$_POST['mat_respons']."'";
	$resultx=@pg_query($con,$query) or die('ERROR AL LEER DATOS: ' . pg_last_error());
	 echo $query;
    $row = pg_fetch_array($resultx); 
    $id_responsable=$row['id_responsable']; 
	
    if (!isset($id_responsable)){
		echo'Entra porque encontro resp';
	$queryaux="SELECT MAX(id_responsable) as maxid FROM resp_soft";
          				
    $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
    $row = pg_fetch_array($resultx); 
    $id_resp_aux=$row['maxid']; 

    echo "antes id_resp_aux: " . $id_resp_aux . "</br>";
    $id_resp_aux=$id_resp_aux+1;
    echo "despues id_resp_aux: " . $id_resp_aux . "</br>";
	 
	$id_responsable=$id_resp_aux;	
		
	$strquery="INSERT INTO resp_soft (id_responsable,pila_respons,pat_respons,mat_respons) VALUES (%d,'%s','%s','%s')";
	$queryr=sprintf($strquery,$id_responsable,$_POST['pila_respons'],$_POST['pat_respons'],$_POST['mat_respons']);
    echo $queryr;
    $result=@pg_query($con,$queryr) or die('ERROR AL INSERTA DATOS: ' . pg_last_error());
    echo $queryr;
		
	}
	
	
	$queryaux="SELECT MAX(id_software) as maxid FROM software";
          				
    $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
    $row = pg_fetch_array($resultx); 
    $id_soft_aux=$row['maxid']; 

    echo "antes id_soft_aux: " . $id_soft_aux . "</br>";
    $id_soft_aux=$id_soft_aux+1;
    echo "despues id_soft_aux: " . $id_soft_aux . "</br>";
	
    $strquery="INSERT INTO software (id_software,desc_software,id_responsable) VALUES (%d,'%s',%d)";
	$queryn=sprintf($strquery,$id_soft_aux,$_POST['desc_software'],$id_responsable);
    echo $queryn;
    $result=@pg_query($con,$queryn) or die('ERROR AL INSERTA DATOS: ' . pg_last_error());
    echo $queryn;
	
	//Insertar en área software
		
	$queryaux="SELECT MAX(id_area_soft) as maxid FROM area_software";
          				
    $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
    $row = pg_fetch_array($resultx); 
    $id_asoft_aux=$row['maxid']; 

    echo "antes id_asoft_aux: " . $id_asoft_aux . "</br>";
    $id_asoft_aux=$id_asoft_aux+1;
    echo "despues id_asoft_aux: " . $id_asoft_aux . "</br>";
	
    $strquery="INSERT INTO area_software (id_area_soft,id_lab,id_software,fecha_adq) VALUES (%d,%d,%d,'%s')";
	$querys=sprintf($strquery,$id_soft_aux,$_REQUEST['lab'],$id_soft_aux,$_POST['fecha_adq']);
    echo $querys;
    $result=@pg_query($con,$querys) or die('ERROR AL INSERTA DATOS: ' . pg_last_error());
    echo $querys;	
	
	// Insertar en software comercial
	
	 $strquery="INSERT INTO soft_comercial (id_soft_com,id_tipo_soft,proveedor,licencia) VALUES (%d,%d,'%s','%s')";
	$querysc=sprintf($strquery,$id_soft_aux,$_POST['id_tipo_soft'],$_POST['proveedor'],$lic);
    echo $querysc;
    $result=@pg_query($con,$querysc) or die('ERROR AL INSERTA DATOS: ' . pg_last_error());
    echo $querysc;	
   
 }

// Guarda datos de edicion de registro 
 if($_POST['accionm']=='Guardar'){ 
  echo 'En guardar'. print_r($_POST);?>
<h1>Edicion</h1>
<?php 
  $ant_resp=$_POST['id_responsable'];
	 
  $query="SELECT id_responsable FROM resp_soft WHERE pila_respons='".$_POST['pila_respons']. 
		   "' AND pat_respons= '".$_POST['pat_respons']."' AND mat_respons='".$_POST['mat_respons']."'";
  $resultx=@pg_query($con,$query) or die('ERROR AL LEER DATOS: ' . pg_last_error());
	 echo $query;
  $row = pg_fetch_array($resultx); 
  $id_responsable=$row['id_responsable']; 	 
  if ($ant_resp==$id_responsable){
	  $querya="UPDATE resp_soft SET pila_respons='%s' ,pat_respons='%s',mat_respons='%s' WHERE id_responsable=". $id_responsable;
	  $queryu=sprintf($querya,$_POST['pila_respons'],$_POST['pat_respons'],$_POST['mat_respons']);
      echo $queryu;
	  $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());   
  }else if ($ant_resp!=$id_responsable){
	
		echo'Entra porque  encontro resp';
	$queryaux="SELECT MAX(id_responsable) as maxid FROM resp_soft";
          				
    $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
    $row = pg_fetch_array($resultx); 
    $id_resp_aux=$row['maxid']; 

    echo "antes id_resp_aux: " . $id_resp_aux . "</br>";
    $id_resp_aux=$id_resp_aux+1;
    echo "despues id_resp_aux: " . $id_resp_aux . "</br>";
	 
	$id_responsable=$id_resp_aux;	
		
	$strquery="INSERT INTO resp_soft (id_responsable,pila_respons,pat_respons,mat_respons) VALUES (%d,'%s','%s','%s')";
	$queryr=sprintf($strquery,$id_responsable,$_POST['pila_respons'],$_POST['pat_respons'],$_POST['mat_respons']);
    echo $queryr;
    $result=@pg_query($con,$queryr) or die('ERROR AL INSERTA DATOS: ' . pg_last_error());
    echo $queryr;
		
	}
	 //solo se actualiza en software_comercial id_tipo_soft
//actualizar pero creo que hay que revisar si borramos resposable y se vuelve aa insertar , lo mismo en tipo de software		
 
	 
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

}
	$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'];
echo $direccion;
header($direccion);?>