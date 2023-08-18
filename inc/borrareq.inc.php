<?php 
session_start();
require_once('../conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php

echo 'valores de POSTen borrareq';
print_r ($_POST);

if(!isset($_POST['resp'])){ ?>
				<?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'] .'&orden='. $_REQUEST['orden'].'&div='. $_REQUEST['div'];?>
               <table class="login"><tr><td><p>&iquest;Realmente desea borrar el registro?</p></td></tr>
                <form action="<?php echo $action; ?>" method="post" name="borrado">
                
                  <tr ><td style="text-align: center" colspan="4">
                  <input name="resp" type="submit" value="Si" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name="resp" type="submit" value="No" /></td></tr>
                    
                
                <?php
                foreach ($_REQUEST as $campo => $valor) {
                        //echo "\$usuario[$campo] => $valor.\n" . "</br>";
                echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
                
                }
                ?>
                <input name="mod" type="hidden" value="<?php echo $_GET['mod'];?>" />
                <input name="accion" type="hidden" value="borrar" />
                </form>
                </table>

<?php } else if ($_POST['resp']=='Si') {

if($_POST['accion']=='borrar'){
	
  //borrar impacto
	
	//faltaria obtener requerimiento impcto
	
 $queryimp="SELECT distinct id_req_imp
            FROM requerimiento_lab lr
            LEFT JOIN requerimiento_impacto ri
            ON ri.id_lab_req=lr.id_lab_req
            LEFT JOIN cat_impacto ci
            ON ci.id_impacto=ri.id_impacto
            WHERE lr.id_lab_req=".$_POST['id_lab_req'];
	
$resultx=@pg_query($con,$queryimp) or die('ERROR AL LEER DATOS: ' . pg_last_error());
$row = pg_fetch_array($resultx);  
$req_imp=$row['id_req_imp'];	

$queryjust="SELECT  id_req_just
            FROM requerimiento_just
            WHERE id_lab_req=".$_POST['id_lab_req'];
	
$resultx=@pg_query($con,$queryjust) or die('ERROR AL LEER DATOS: ' . pg_last_error());
$row = pg_fetch_array($resultx);  
$req_just=$row['id_req_just'];
	

	
  $strquery2="DELETE FROM requerimiento_impacto WHERE id_req_imp=%d";
  $queryp=sprintf($strquery2,$req_imp);
  $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	
	
  //borrar requerimiento_just
	
 
  /*$strquery2="DELETE FROM requerimiento_funcion WHERE id_func_req=%d";
  $queryp=sprintf($strquery2,$_POST['id_func_req']);
  $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	*/


  
  //recuperar motivo evid 	???
	
  /*$queryaux="SELECT id_evidencia FROM motivo_evidencia WHERE id_mot_evid=%d";
  $querye=sprintf($queryaux,$_POST['id_mot_evid']);
  $resultx=@pg_query($con,$querye) or die('ERROR AL LEER DATOS: ' . pg_last_error());
  $row = pg_fetch_array($resultx); 
  $id_evid=$row['id_evidencia']; */
	
  //Recuperando valores de evidencias una por una
	
  $querye1="SELECT me.id_evidencia FROM evidencia e
            LEFT JOIN motivo_evidencia me
            ON e.id_evidencia=me.id_evidencia
            LEFT JOIN requerimiento_just rj
            ON rj.id_req_just=me.id_req_just
            LEFT JOIN requerimiento_lab rl
            ON rl.id_lab_req=rj.id_lab_req
            WHERE tipo_evid='actual' AND rl.id_lab_req=". $_POST['id_lab_req'];
	
	echo 'qurye1',$$querye1;
	
  $resulte1=@pg_query($con,$querye1) or die('ERROR AL LEER DATOS: ' . pg_last_error());
  $row = pg_fetch_array($resulte1); 
  $e1=$row['id_evidencia']; 
  echo 'evidencia1 es=',$e1;	
	 
  $querye2="SELECT me.id_evidencia FROM evidencia e
            LEFT JOIN motivo_evidencia me
            ON e.id_evidencia=me.id_evidencia
            LEFT JOIN requerimiento_just rj
            ON rj.id_req_just=me.id_req_just
            LEFT JOIN requerimiento_lab rl
            ON rl.id_lab_req=rj.id_lab_req
            WHERE tipo_evid='infra' AND rl.id_lab_req=". $_POST['id_lab_req'];
	echo 'qurye2',$$querye2;
	
  $resulte2=@pg_query($con,$querye2) or die('ERROR AL LEER DATOS: ' . pg_last_error());
  $row = pg_fetch_array($resulte2); 
  $e2=$row['id_evidencia']; 	
	echo 'evidencia es=',$e2;
  
  $queryaux="SELECT ruta_evidencia FROM evidencia WHERE id_evidencia=%d ";
  $querye=sprintf($queryaux,$e1);
  $resultx=@pg_query($con,$querye) or die('ERROR AL LEER DATOS: ' . pg_last_error());
  $row = pg_fetch_array($resultx); 
  $rutae1=$row['ruta_evidencia']; 
	
  echo 'la ruta evidencia es',$rutae1;	
  
  $queryaux="SELECT ruta_evidencia FROM evidencia WHERE id_evidencia=%d ";
  $querye=sprintf($queryaux,$e2);
  $resultx=@pg_query($con,$querye) or die('ERROR AL LEER DATOS: ' . pg_last_error());
  $row = pg_fetch_array($resultx); 
  $rutae2=$row['ruta_evidencia']; 
	
  echo 'la ruta evidencia es',$rutae2;		
	
  $strquery1="DELETE FROM motivo_evidencia WHERE id_evidencia=%d";
  $queryp=sprintf($strquery1,$e1);
  echo $queryp;
  $result=pg_query($con,$queryp) or die('ERROR AL BORRAR DATOS queryp: ' . pg_last_error());
	
  $strquery1="DELETE FROM motivo_evidencia WHERE id_evidencia=%d";
  $queryp=sprintf($strquery1,$e2);
  echo $queryp;
  $result=pg_query($con,$queryp) or die('ERROR AL BORRAR DATOS queryp: ' . pg_last_error());

  $strquery2="DELETE FROM evidencia WHERE id_evidencia=%d";
  $queryp=sprintf($strquery2,$e1);
  $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	
	
	
  $strquery2="DELETE FROM evidencia WHERE id_evidencia=%d";
  $queryp=sprintf($strquery2,$e2);
  $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	
	
   $strquery2="DELETE FROM requerimiento_just WHERE id_req_just=%d";
  $queryp=sprintf($strquery2,$req_just);
  $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	
	
  //borrar requerimiento_funcion para borrar uno o mas
	
 	
  $strquery2="DELETE FROM requerimiento_funcion WHERE id_lab_req=%d";
  $queryp=sprintf($strquery2,$_POST['id_lab_req']);
  $result=pg_query($con,$queryp) or die ('ERROR AL BORRAR DATOS queryp:'.pg_last_error());	
				
	
  $strquery1="DELETE FROM requerimiento_lab WHERE id_lab_req=%d";
  $queryd=sprintf($strquery1,$_POST['id_lab_req']);
  $result=pg_query($con,$queryd) or die('ERROR AL BORRAR DATOS: ' . pg_last_error());
	
  unlink($rutae1);
  unlink($rutae2);
	
  $direccion='../view/inicio.html.php?mod=' . $_REQUEST['mod']. '&orden='. $_REQUEST['orden'] .'&lab=' . $_REQUEST['lab'] . '&div='. $_REQUEST['div'];
	
die('<script type="text/javascript">window.location=\''.$direccion.'\';</script>');	
	
} 

 } else {
		//echo "No borrar";	
		
		 $direccion='../view/inicio.html.php?mod=' . $_REQUEST['mod']. '&orden='. $_REQUEST['orden'] .'&lab=' . $_REQUEST['lab'] . '&div='.  $_REQUEST['div'];
		
            die('<script type="text/javascript">window.location=\''.$direccion.'\';</script>');	

}
?>
				

