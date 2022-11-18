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
    

    

   
/* Insertar datos en proyecto_criterio*/
for ($i=1;$i<=$_REQUEST['j']-1;$i++){
	$crit='id_criterio_'.+$i;
	$cal='id_calif_'.$i;
	$just='id_justif_'.$i;
    echo 'crit',$crit;
	echo 'calif',$calif;
     //if (isset($_REQUEST[$crit]))	{
		echo 'valor',$_REQUEST[$crit];
        $queryaux="SELECT MAX(id_proy_crit) as maxidpc FROM proyecto_criterio ";
        $resultx=@pg_query($con,$queryaux) or die('ERROR AL LEER DATOS: ' . pg_last_error());
        $row = pg_fetch_array($resultx); 
        $id_pc_aux=$row['maxidpc']; 
        $id_pc_aux=$id_pc_aux+1;	
	
        $strquery="INSERT INTO proyecto_criterio (id_proy_crit,id_criterio,id_calif,justif,id_proy) VALUES (%d,%d,%d,'%s',%d)";
       $queryd=sprintf($strquery,$id_pc_aux,$_REQUEST[$crit],$_REQUEST[$cal],$_REQUEST[$just],$_REQUEST['id_proy']);
		 echo $queryd;
        $result=@pg_query($con,$queryd) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        echo $queryd;
	// }//if valor en id_nec_x
}//for inserta cada necesidad proy
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'].'&div='. $_REQUEST['div'];
echo $direccion . "</br>";
header($direccion);

 }?>
	
	

