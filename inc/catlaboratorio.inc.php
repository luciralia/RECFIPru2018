<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
session_start(); 
require_once('../conexion.php'); 

header("Pargma:public");
header("Expires:0");
//$filename="nombreArchivodescarga.xls";
header("Content-type: application/x-msdownload");
//header("Content-Disposition:attachment;filename=$filename");
header("Pargma:no-cache");
header("Cache-Control: must_revalidate,post-check=0,pre-check=0");

$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);

$texto='Content-Disposition: attachment;filename="catalogolab_' . date("Ymd-His") . "_" . $nombdiv[0]. '.xls"';
header($texto);
?>


   <tr>
      <td align="center" ><h2>Catálogo de Laboratorios </h2></td>
      
   </tr>
  <tr></tr>
		
   <tr>
      <td align="center" ><h3>División <?php  $nombdiv[0] ?> </h3></td>
    </tr>

  
		<?php 
		
	    $querylab="select l.nombre,l.id_lab from laboratorios l
                     join departamentos dep
                     on l.id_dep=dep.id_dep
                     join divisiones d
                     on d.id_div=dep.id_div
                     where 
					 d.id_div=" . $_SESSION['id_div'] ."
                     order by nombre" ;	
			
	    
$datoslab = pg_query($con,$querylab);
//$registros= pg_num_rows($datoslab); 
    
?>
	    <table  class='material' width=50%>
		 <tr>
              <th width="30%" scope="col">Nombre laboratorio</th>
              <th width="30%" scope="col">Identificador </th>
         </tr>
        </table>
 <?php

		while ($reg_lab = pg_fetch_array($datoslab, NULL,PGSQL_ASSOC)) 
		{ 
       ?>
		
          <table class='material' width=50%>
         
		   <tr >
              <td width="30%" ><?php echo $reg_lab['nombre'];?></td>
               <td width="30%" ><?php echo $reg_lab['id_lab'];?></td>
               
            </tr>
            
         </table>    
       <?php 
         
          
		 }
		

		  
	 ?>
   
