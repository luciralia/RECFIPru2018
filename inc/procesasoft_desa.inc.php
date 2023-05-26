
<?php 
session_start();
require_once('../conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<p>procesasoft_desa</p>
<p>&nbsp;</p>
<?php 
	echo 'Valores en procesa_desa';
	print_r($_POST); 
	echo 'Valores en REQ procesa_desa';
	print_r($_REQUEST);
	
	?>

<!-- /* Guarda datos de registro nuevo */-->
<?php if($_POST['accionn']=='Guardar'){ ?>
<h1>Nuevo</h1>
<?php 
	
	// Buscar al responsable del software
	
	$query="SELECT id_responsable FROM resp_soft WHERE pila_respons='".$_POST['pila_respons']. 
		   "' AND pat_respons= '".$_POST['pat_respons']."' AND mat_respons='".$_POST['mat_respons']."'";
	$resultx=@pg_query($con,$query) or die('ERROR AL LEER DATOS: ' . pg_last_error());
	
	echo $query;
    $row = pg_fetch_array($resultx); 
	$id_responsable=$row['id_responsable']; 
	
    if ($row['id_responsable']==''){
	echo'Entra porque encontro resp';
	$queryaux="SELECT MAX(id_responsable) as maxid FROM resp_soft";
          				
    $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
    $row = pg_fetch_array($resultx); 
    $id_resp_aux=$row['maxid']; 
		
    $id_responsable=$id_resp_aux;	
		
	$strquery="INSERT INTO resp_soft (id_responsable,pila_respons,pat_respons,mat_respons) VALUES (%d,'%s','%s','%s')";
	$queryr=sprintf($strquery,$id_responsable,$_POST['pila_respons'],$_POST['pat_respons'],$_POST['mat_respons']);
    echo $queryr;
    $result=@pg_query($con,$queryr) or die('ERROR AL INSERTA DATOS: ' . pg_last_error());
		
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
	
	$strquery="INSERT INTO soft_desarrollo (id_soft_desa,no_software) VALUES (%d,%d,'%s','%s')";
	$querysc=sprintf($strquery,$id_soft_aux,$_POST['id_tipo_soft'],$_POST['proveedor'],$lic);
    echo $querysc;
    $result=@pg_query($con,$querysc) or die('ERROR AL INSERTA DATOS: ' . pg_last_error());
    echo $querysc;	
	
	
	// FALTA  AGREGAR LOS MANUALES DE DESARROLLO
	
	
	
	$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'];
echo $direccion;
header($direccion);
   
 }

// Guarda datos de edicion de registro 
 if($_POST['accionm']=='Guardar'){ 
  echo 'En guardar'. print_r($_POST);?>
<h1>Edicion</h1>
<?php 
	
	 
  $ant_resp=$_POST['id_responsable'];
  $ant_soft=$_POST['id_tipo_soft'];	 
  
  $query="SELECT id_responsable FROM resp_soft WHERE pila_respons='".$_POST['pila_respons']. 
		   "' AND pat_respons= '".$_POST['pat_respons']."' AND mat_respons='".$_POST['mat_respons']."'";
	 echo 'Busqueda',$query;
  $resultx=@pg_query($con,$query) or die('ERROR AL LEER DATOS: ' . pg_last_error());

  $row = pg_fetch_array($resultx); 
	 
  $id_responsable=$row['id_responsable']; 
	
	  echo 'ant_resp',$ant_resp;
	 echo 'actual',$id_responsable;
  	 
  if ($ant_resp!=$id_responsable){
	  echo 'solo actualiza puedo haber corregido  el nombre del reponsable';
	  $querya="UPDATE resp_soft SET pila_respons='%s' ,pat_respons='%s',mat_respons='%s' WHERE id_responsable=". $ant_resp;
	  $queryu=sprintf($querya,$_POST['pila_respons'],$_POST['pat_respons'],$_POST['mat_respons']);
      echo $queryu;
	  $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());  
	  
  }
	 
	  $querya="UPDATE soft_comercial SET id_tipo_soft=%d, proveedor='%s', licencia='%s' WHERE id_soft_com=".$_POST['id_software'];
	  $queryu=sprintf($querya,$_POST['id_tipo_soft'],$_POST['proveedor'],$lic);
      echo $queryu;
	  $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());  
	
 
	 
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']. '&div=' . $_REQUEST['div'];
echo $direccion . "</br>";
header($direccion);


 }
 if($_POST['accionm']=='borrar'){ 
	
	
  $strquery2="DELETE FROM soft_comercial1 WHERE id_soft_com=%d";
  $queryp=sprintf($strquery2,$_POST['id_software']);
  $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	

	
  $strquery1="DELETE FROM software WHERE id_software=%d";
  $queryp=sprintf($strquery1,$_POST['id_software']);
  echo $queryp;
  $result=pg_query($con,$queryp) or die('ERROR AL BORRAR DATOS queryp: ' . pg_last_error());	
 		

  $strquery="DELETE FROM area_software WHERE id_software=%d";
  $queryd=sprintf($strquery,$_POST['id_software']);
  $result=pg_query($con,$queryd) or die('ERROR AL BORRAR DATOS: ' . pg_last_error());

  $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'].'&div='. $_REQUEST['div'];
  echo $direccion; 
  header($direccion);
 }


 if($_POST['accionm']=='Cancelar'|| $_POST['accionn']=='Cancelar'){ 
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'].'&div='. $_REQUEST['div'];
echo $direccion;
header($direccion);

}
	?>