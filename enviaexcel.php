<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>


<?php
require_once('C:/xampp/htdocs/RECFIPru2018/conexion.php');

$consulta = "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p<>'APPLE' OR marca_p<>'MAC')
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend
			ORDER BY cuenta DESC"; 
			
$datos = pg_query($con,$consulta);
//$fila= pg_num_rows($datos); 
    
?>
	    
 <?php
		
			

while($fila =  pg_fetch_array($datos,NULL,PGSQL_ASSOC)) 
    { 
    ?>
    <tr> 
        
        <td><?php echo $fila['nombre_dispositivo']?></td> 
        <td><?php echo $fila['nombre_familia']?></td> 
        <td><?php echo $fila['familia_clave']?></td> 
        <td><?php echo $fila['estadobien']?></td> 
        <td><?php echo $fila['equipoaltorend']?></td> 
       
    </tr>; 
 <?php
    } 
    

      ?> 
     <a href='excel.php'>Exportara</a>
  


<body>
</body>
</html>



    