 <?php 
session_start();
require_once('../conexion.php');


if (isset($_POST['chasis'])){
                   echo 'Imprime chas=1',$chas;
	               $chas=1;}
               else {
				   echo 'Imprime chas=0',$chas;
                   $chas=0;}
			   
	
		 $query="SELECT id_configuracion as maxidconf FROM config_switch
		 WHERE id_dispositivo=".$_REQUEST['id_dispositivo'];
	
         $result=@pg_query($con,$query) or die('ERROR AL LEER DATOS: ' . pg_last_error());
	
	     $cantidad= pg_num_rows($result); 
	     echo 'consulta de configuracion',$query;
	
	       if ($cantidad!=0 ){
			   
			   
			    $query="UPDATE config_switch SET id_switch=%d,id_puerto=%d, chasis=%d
			            WHERE id_configuracion=".$_POST['id_conf'];
			   
			    $queryu=sprintf($query,$_POST['id_switch'],$_POST['id_puerto'],$chas);
			   
			    echo $queryu;
			   
			    $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());
			}else{
			   
		   $queryaux1="SELECT MAX(id_configuracion) as maxidconf FROM config_switch";
	       
		   echo $queryaux1;
	
	       $resultx1=@pg_query($con,$queryaux1) or die('ERROR AL LEER DATOS: ' . pg_last_error());
           $row = pg_fetch_array($resultx1); 
	       $id_conf=$row['maxidconf']; 
	       $id_conf+=1;	
	       $strqueryconf="INSERT INTO config_switch  (id_configuracion,id_dispositivo,id_switch,id_puerto,chasis)
	               VALUES (%d,%d,%d,%d,%d);";
          $query=sprintf($strqueryconf,$id_conf,$_POST['id_dispositivo'],$_POST['id_switch'],$_POST['id_puerto'],$chas);
	
	       echo $query;

           $result=pg_query($con,$query) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());
		}
	
	
	$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']."&div=" .$_SESSION['id_div'];
    echo $direccion;
    header($direccion);

?>