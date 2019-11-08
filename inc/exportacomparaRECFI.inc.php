<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
session_start(); 
require_once('../conexion.php'); 

date_default_timezone_set('America/Mexico_City');
header('Content-type: application/x-msexcel'); 
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );


$querydiv="SELECT siglas,nombre FROM divisiones
           WHERE id_div=". $_REQUEST['div'];
		   
$siglas= pg_query ($con,$querydiv);
$siglasdiv= pg_fetch_array($siglas);

$texto='Content-Disposition: attachment;filename="comparaRECFI_Patrimonio_' . date("Ymd-His") . "_" . $siglasdiv[1] . '.xls"';
//header("Content-type: text/html");


header($texto);




?>
<table>
   <tr>
      <td align="center" ><h2>Inventario  RECFI vs Patrimonio</h2></td>
      <td align="center" ><h2><?php echo  "de ".$siglasdiv[0]; ?> </h2></td>
   </tr>
  <tr></tr>


               
<?php



  $query="SELECT inventario,dep.nombre as nombdep,div.nombre as nombdiv,l.nombre as nomblab,ce.descripcion as edif,* FROM 
                    dispositivo d
					JOIN laboratorios l
                    ON l.id_lab=d.id_lab
                    JOIN departamentos dep
                    ON dep.id_dep=l.id_dep
                    JOIN divisiones div
                    ON div.id_div=dep.id_div
                    JOIN cat_dispositivo cd
                    ON cd.dispositivo_clave=d.dispositivo_clave
                    JOIN cat_edificio ce
                    ON ce.id=l.id_edif
                    WHERE div.id_div= ". $_REQUEST['div'];

   $datos = pg_query($con,$query);
   $inventario= pg_num_rows($datos);?>
   
   
   <table  border="1">
            <tr>
               <th  scope="col">Inventario Patrimonio</th>
               <th  scope="col">Descripción Pat</th>
               <th  scope="col">División Pat</th>
               <th  scope="col">Ubicación Pat</th>
               <th  scope="col">ap_pat Pat</th>
               <th  scope="col">Nombres</th>
               <th  scope="col">Departamento</th>
               <th  scope="col">Edificio Pat</th>
               <th  scope="col">Nivel Pat</th>
               <th  scope="col">Inventario RECFI</th>
               <th  scope="col">Descripción RECFI</th>
               <th  scope="col">División</th>
               <th  scope="col">Ubicación RECFI</th>
               <th  scope="col">ap_pat</th>
               <th  scope="col">Nombres</th>
               <th  scope="col">Departamento</th>
               <th  scope="col">Edificio</th>
               <th  scope="col">Nivel</th>
               <th  scope="col">Detalle Ubic</th>
            
           </tr>
</table>

<?php

while ($datos_RECFI = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) {
		
		 if(preg_match("/^[0-9]+$/",$datos_RECFI['inventario'])) {
			  
			  $querydisp="SELECT * FROM invent_patrimonio ip
                               LEFT JOIN area_patrimonio ap
                               ON (ip.id_area_pat=ap.id_area_pat )
                               LEFT JOIN resguardante r
                               ON r.id_usuario_pat=ip.id_usuario_pat
                               LEFT JOIN clasif_bien_pat cp
                               ON cp.id_clasif_pat=ip.id_clasif_pat
		                       WHERE  inventario_pat='".$datos_RECFI['inventario'].
                               "'  " ;
					
		  }else
		if(preg_match("/^F/",$datos_RECFI['inventario'])) {
			   $cad=substr($datos_RECFI['inventario'],3,5);
			  
			   
			       $querydisp="SELECT * FROM invent_patrimonio ip
                               LEFT JOIN area_patrimonio ap
                               ON (ip.id_area_pat=ap.id_area_pat )
                               LEFT JOIN resguardante r
                               ON r.id_usuario_pat=ip.id_usuario_pat
                               LEFT JOIN clasif_bien_pat cp
                               ON cp.id_clasif_pat=ip.id_clasif_pat
		                       WHERE  inventario_pat='".$cad.
                               "'" ;
					
					
		  }
					//echo $querydisp;
	     $queryverif= pg_query($con,$querydisp);	
		 
         $datos_pat= pg_fetch_array($queryverif);
		  
		 $existe= pg_num_rows($queryverif);
		 
		
		 //guardar en una tabla temporal y comenzar a comparar ?>
         
          <table  border="1">
          <tr>
                  <td ><?php echo $datos_pat['inventario_pat'];?></td>
                  <td ><?php echo $datos_pat['descripcion_pat'];?></td>
                  <td ><?php echo $datos_pat['division_pat'];?></td>
                  <td ><?php echo $datos_pat['local_pat'];?></td>
                  <td ><?php echo $datos_pat['ap_pat'];?></td>
                  <td ><?php echo $datos_pat['nombre_pat'];?></td>
                  <td ><?php echo $datos_pat['depto_pat'];?></td>
                  <td ><?php echo $datos_pat['id_edif_pat'];?></td>
                  <td ><?php echo $datos_pat['nivel_pat'];?></td>
                  <td ><?php echo $datos_RECFI['inventario'];?></td>
                  <td ><?php echo $datos_RECFI['nombre_dispositivo'];?></td>
                  <td ><?php echo $datos_RECFI['nombdiv'];?></td>
                  <td ><?php echo $datos_RECFI['nomblab'];?></td>
                  <td ><?php echo $datos_RECFI['nombre_resguardo'];?></td>
                  <td ><?php echo $datos_RECFI['nombre_pat'];?></td>
                  <td ><?php echo $datos_RECFI['nombdep'];?></td>
                  <td ><?php echo $datos_RECFI['edif'];?></td>
                  <td ><?php echo $datos_RECFI['nivel'];?></td>
                  <td ><?php echo $datos_RECFI['detalle_ub'];?></td>
                  
           </tr>
           
            </table>
            
            <?php
		}
		?>