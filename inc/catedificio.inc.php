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
/*
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);
*/
$texto='Content-Disposition: attachment;filename="catalogoedificio_' . date("Ymd-His") .'_FI.xls"';
header($texto);
//$nombre=$nombdiv[0];
?>


   <tr>
      <td align="center" ><h2>Catálogo de Edificios </h2></td>
      
   </tr>
  <tr></tr>
		
   <tr>
      <td align="center" ><h3>Facultad de Ingeniería  </h3></td>
    </tr>

  
		<?php 
		
	    $querylab="SELECT descripcion,id FROM cat_edificio
		            ORDER BY descripcion
		           " ;	
			
	    
$datoslab = pg_query($con,$querylab);
//$registros= pg_num_rows($datoslab); 
    
?>
	    <table  class='material' width=50%>
		 <tr>
              <th width="30%" scope="col">Nombre edificio</th>
              <th width="30%" scope="col">Identificador </th>
         </tr>
        </table>
 <?php

		while ($reg_lab = pg_fetch_array($datoslab, NULL,PGSQL_ASSOC)) 
		{ 
       ?>
		
          <table class='material' width=50%>
         
		   <tr >
              <td width="30%" ><?php echo $reg_lab['descripcion'];?></td>
               <td width="30%" ><?php echo $reg_lab['id'];?></td>
               
            </tr>
            
         </table>    
       <?php 
         
          
		 }
		

		  
	 ?>
   
