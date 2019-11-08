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

$texto='Content-Disposition: attachment;filename="comparaPatrimonioRECFI_' . date("Ymd-His") . "_" . $siglasdiv[1] . '.xls"';
//header("Content-type: text/html");


header($texto);




?>
<table>
   <tr>
      <td align="center" ><h2>Inventario Patrimonio RECFI </h2></td>
      <td align="center" ><h2><?php echo  "de ".$siglasdiv[0]; ?> </h2></td>
   </tr>
  <tr></tr>


               
<?php



$query="SELECT * FROM invent_patrimonio ip
         LEFT JOIN area_patrimonio ap
         ON (ip.id_area_pat=ap.id_area_pat )
         LEFT JOIN resguardante r
         ON r.id_usuario_pat=ip.id_usuario_pat
         LEFT JOIN clasif_bien_pat cp
         on cp.id_clasif_pat=ip.id_clasif_pat
		 WHERE division_pat = '" . $siglasdiv[0] . "'
          AND(ip.id_clasif_pat='1' OR  ip.id_clasif_pat='2' ) AND (descripcion_pat like '%OMPUT%'
         OR  descripcion_pat like '%APTO%'  )
         ";

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

while ($datos_pat = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{
		$cad=substr($datos_pat['ínventario_pat'],4,5);	
		$expreg= '/^(\d{5}(\d{4})?)?$/';
		  if(preg_match("/^(\d{5}?)?$/",$datos_pat['inventario_pat'])) {
			  
			  //$cad=substr($datos_pat['ínventario_pat'],4,5);
			 
			  
		$querydisp="SELECT dep.nombre as nombdep,div.nombre as nombdiv,l.nombre as nomblab,* FROM 
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
                    WHERE
					div.id_div= ". $_REQUEST['div']."
                    AND inventario='FI:".$datos_pat['inventario_pat']."'"
					;
                   
					//echo $datos_pat['inventario_pat'];
		  }else{
			  $querydisp="SELECT inventario,dep.nombre as nombdep,div.nombre as nombdiv,l.nombre as nomblab,ce.descripcion as edif,* FROM 
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
                    WHERE
					div.id_div= ". $_REQUEST['div']. " AND
                    inventario='". $datos_pat['inventario_pat']."'" ;
					
					
		  }
					//echo $querydisp;
	     $queryverif= pg_query($con,$querydisp);	
		 
         $verifica= pg_fetch_array($queryverif);
		  
		 $existe= pg_num_rows($queryverif);
		 
		 if ($existe>0)
		    $valorexiste=$verifica['inventario'];
		 else
			$valorexiste ='No existe en RECFI';
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
                  <td ><?php echo $valorexiste;?></td>
                  <td ><?php echo $verifica['nombre_dispositivo'];?></td>
                  <td ><?php echo $verifica['nombdiv'];?></td>
                  <td ><?php echo $verifica['nomblab'];?></td>
                  <td ><?php echo $verifica['nombre_resguardo'];?></td>
                  <td ><?php echo $verifica['nombre_pat'];?></td>
                  <td ><?php echo $verifica['nombdep'];?></td>
                  <td ><?php echo $verifica['edif'];?></td>
                  <td ><?php echo $verifica['nivel'];?></td>
                  <td ><?php echo $verifica['detalle_ub'];?></td>
                  
           </tr>
           
            </table>
            
            <?php
		}
		?>