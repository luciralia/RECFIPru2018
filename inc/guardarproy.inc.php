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
	echo 'Valores en guardaproy ';
	print_r($_POST); 
	echo 'Valores en REQ procesa ';
	print_r($_REQUEST);

	if($_POST['accionn']=='Guardar'){ ?>
    <h1>Nuevo</h1>
<?php 
    
$query="SELECT pc.id_proy FROM proyecto_criterio pc
        WHERE 
        EXISTS (SELECT id_proy FROM proy p
        WHERE pc.id_proy=p.id_proy AND p.id_proy=". $_REQUEST['id_proy'].")";

$result = pg_query($con,$query);
	
    $existe= pg_num_rows($result); 
	
	if ($existe!=0 ){		
    
        $queryde="DELETE FROM proyecto_criterio WHERE id_proy=".$_REQUEST['id_proy'];
	    $resultx=@pg_query($con,$queryde) or die('ERROR AL BORRAR LOS DATOS: ' . pg_last_error());
	}
		
		
/* Insertar datos en proyecto_criterio*/
for ($i=1;$i<=$_REQUEST['j']-1;$i++){
	$crit='id_criterio_'.+$i;
	$cal='id_calif_'.$i;
	$just='id_justif_'.$i;
    echo 'crit',$crit;
	echo 'calif',$cal;
     //if (isset($_REQUEST[$crit]))	{
		echo 'valor',$_REQUEST[$crit];
	     echo 'valorde calif',$_REQUEST[$cal];
        $queryaux="SELECT MAX(id_proy_crit) as maxidpc FROM proyecto_criterio ";
        $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
        $row = pg_fetch_array($resultx); 
        $id_pc_aux=$row['maxidpc']; 
        $id_pc_aux=$id_pc_aux+1;	
	
        $strquery="INSERT INTO proyecto_criterio (id_proy_crit,id_criterio,id_calif,justif,id_proy) VALUES (%d,%d,%d,'%s',%d)";
       $queryd=sprintf($strquery,$id_pc_aux,$_REQUEST[$crit],$_REQUEST[$cal],$_REQUEST[$just],$_REQUEST['id_proy']);
		 echo $queryd;
        $result=@pg_query($con,$queryd) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
     
}//for inserta cada necesidad proy
//}//fin de existe
	}
		$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'].'&div='. $_REQUEST['div'];
echo $direccion . "</br>";
header($direccion);

 if($_POST['accionm']=='Cancelar'|| $_POST['accionn']=='Cancelar'){ 

$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_REQUEST['div'];
echo $direccion;
header($direccion);

}?>


	

