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

$texto='Content-Disposition: attachment;filename="erroresbn_' . date("Ymd-His") . "_" . $nombdiv[0]. '.xls"';
header($texto);

if ($_POST['actbn']=='Exportar a Excel'){
	$titulo='Errores al actualizar';
	$etiqueta='ba';
}
else {
    $titulo='Errores al importar';	
	$etiqueta='b';
}
?>


   <tr>
      <td align="center" ><h2><?php echo $titulo; ?></h2></td>
      
   </tr>
  <tr></tr>
		
   <tr>
      <td align="center" ><h3>Dispositivos no encontrados en bienes_inventario </h3></td>
    </tr>

  
		<?php 
		
	    $queryerror="SELECT * FROM registroerror re
	                  LEFT JOIN cat_dispositivo cd
				      ON re.clave_dispositivo=cd.dispositivo_clave
	                  WHERE date(fecharegistro)= current_date
					  AND tipoerror="."'".$etiqueta."'"."
				      AND id_div=" . $_SESSION['id_div']  ;	
			//echo $queryerror;
	    
$datoserror = pg_query($con,$queryerror);
$registros= pg_num_rows($datoserror); 
    
?>
	    <table  class='material' width=50%>
		 <tr>
              <th width="30%" scope="col">Inventario</th>
              <th width="30%" scope="col">Descripción</th>
         </tr>
        </table>
 <?php
 $cuenta=0;
 $reporteb=0;
		while ($reg_error = pg_fetch_array($datoserror, NULL,PGSQL_ASSOC)) 
		{ 
       ?>
		 <table class='material' width=50%>
            <tr >
              <td width="30%" ><?php echo $reg_error['inventario'];?></td>
               <td width="30%" ><?php echo $reg_error['nombre_dispositivo'];?></td>
             </tr>
         </table>    
       <?php 
         
          
		 }
		$reporteb=1;
		if ($reporteb==1){
		 $queryerror="DELETE FROM registroerror re
	                  WHERE date(fecharegistro)= current_date
					  AND tipoerror="."'".$etiqueta."'"."
				      AND id_div=" . $_SESSION['id_div']
					  ;	
			$datoserror = pg_query($con,$queryerror);
		}

		  
	 ?>
   
