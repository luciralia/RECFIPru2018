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
header("Content-type: application/x-msdownload");
header("Pargma:no-cache");
header("Cache-Control: must_revalidate,post-check=0,pre-check=0");
if ( $_SESSION['tipo_usuario']!=10 ){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);


$texto='Content-Disposition: attachment;filename="censoeqryt_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
}


if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);


$texto='Content-Disposition: attachment;filename="censoeqryt_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
}
else if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
$titulo='FacultadIngenieria';	
$texto='Content-Disposition: attachment;filename="censoeqryt_' . date("Ymd-His") . "_" . $titulo . '.xls"';	
}
	
header($texto);


?>
 

     <tr>
      <td align="center"><h2>Equipo Redes y Telecomunicaciones</h2></td>
   </tr>

		<?php 
		if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){

	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura,l.nombre
            FROM dispositivo dp
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN laboratorios l
            ON dp.id_lab=l.id_lab
            LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (dp.dispositivo_clave=0 )
            AND  (estadoBien='USO' OR estadoBien='DESUSO')
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre ASC";	
	}
	else if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){	 
  $query= " SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura
            FROM dispositivo dp
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN laboratorios l
            ON dp.id_lab=l.id_lab
            LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (dp.dispositivo_clave=0 )
            AND id_div=".$_SESSION['id_div']  . "
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre ASC";
	}
	if ($_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']==""){

	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura,l.nombre
            FROM dispositivo dp
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN laboratorios l
            ON dp.id_lab=l.id_lab
            LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (dp.dispositivo_clave=0 )
            AND  (estadoBien='USO' OR estadoBien='DESUSO')
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre ASC";	
	}
	else if ($_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']!=""){	 
  $query= " SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura,l.nombre
            FROM dispositivo dp
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN laboratorios l
            ON dp.id_lab=l.id_lab
            LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (dp.dispositivo_clave=0 )
            AND id_div=".$_SESSION['id_div']  . "
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura
			ORDER BY cuenta,l.nombre ASC";
	}
	
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
    
?>

        <table class='material'>
		    <tr>
            <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="30%" scope="col">Dispositivo</th>
              <th width="30%" scope="col">Uso/Desuso</th>
              <th width="30%" scope="col">Total</th>
            
            </tr>
         </table>

<?php  $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ ?>
		
		
         <table class='material'>
		    
            <tr>
               
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="30%" scope="col"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="30%" scope="col"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="30%" scope="col"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
    
          </table>  
<?php 

    $cuenta=$cuenta+$lab_invent['cuenta'];      
  	
		} ?>
 

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="33%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>