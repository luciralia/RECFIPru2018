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
//echo 'valores en exporta';
//print_r($_SESSION);
if ( $_SESSION['tipo_usuario']!=10 ){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);

$texto='Content-Disposition: attachment;filename="censoeqcomp_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';

}

if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);


$texto='Content-Disposition: attachment;filename="censoeqcomp_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
}
else if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
$titulo='FacultadIngenieria';	
$texto='Content-Disposition: attachment;filename="censoeqcomp_' . date("Ymd-His") . "_" . $titulo . '.xls"';	
}	

header($texto);
?>


   <tr>
      <td align="center" ><h2>Censo de Equipo de Cómputo</h2></td>
      
   </tr>
  <tr></tr>
		
   <tr>
      <td align="center" ><h3>Anteriores a Pentium 4 o equivalentes  </h3></td>
    </tr>

  
		<?php 
	if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div'] ==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
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
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
			
	}
	if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div'] !="" ){	
	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
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
			AND id_div=" . $_SESSION['id_div'] . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
		
	}
	if ( $_SESSION['tipo_usuario']!=10  && $_SESSION['id_div'] !="" ){
		
	 $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
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
			AND id_div=". $_SESSION['id_div'] . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
	}else if ( $_SESSION['tipo_usuario']!=10  && $_SESSION['id_div'] =="" )
	{ 
	
	$query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
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
			
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
	}	
	
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
    
?>
	    <table  class='material' width=50%>
		 <tr>  
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Familia</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Uso/Desuso</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha_Adquisición</th>
              <th width="20%" scope="col">Total</th>
            
         </tr>
        </table>
 <?php
 $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
       
        
		
		 if ( $lab_invent['familia_clave']==1 ||  $lab_invent['familia_clave']==2 || $lab_invent['familia_clave']==3 ||$lab_invent['familia_clave']==11){;// Intel Pentium OR AMD Duron
		
		  ?>
          <table class='material' width=50%>
          <tr >
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['nombre_familia']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%" ><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%"><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="20%" ><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            
         </table>    
       <?php 
      $cuenta=$cuenta+$lab_invent['cuenta'];
          
		 }//  procesador  ?>
   

   
    <?php
    } // while equipos anteriores a Pentium 4

?>


<table class='material'>
<tr>
<th scope="row">TOTAL</th>
  
    <td width="20%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>

<?php 

$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>

  
   <tr>
      <td align="center"><h3>Pentium Celeron  o equivalentes</h3></td>
    </tr>


   <table class='material' width=50%>
		 <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
               <th width="20%" scope="col">Familia</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Uso/Desuso</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="20%" scope="col">Total</th>
            
         </tr>
     </table>
         
          <?php
		$cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if (  $lab_invent['familia_clave']==4 || $lab_invent['familia_clave']==5||  $lab_invent['familia_clave']==12|| $lab_invent['familia_clave']==10 ||  $lab_invent['familia_clave']==13){;
	
		  ?>
             <table class='material' width=50%>
		     <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['nombre_familia']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%"><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="20%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            
             </table> 
<?php 
 $cuenta=$cuenta+$lab_invent['cuenta'];
          
}// procesador 


} // while equipos  Intel Celeron o equivalentes
?>


<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="20%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
  
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
 <table>
   <tr>
      <td align="center"><h3>Intel Core i3 o equivalentes </h3></td>
    </tr>
  </table>
   <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Familia</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Uso/Desuso</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="20%" scope="col">Total</th>
            
         </tr>
   </table>      
  
 <?php
 $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ( $lab_invent['familia_clave']==7 || $lab_invent['familia_clave']==6 || $lab_invent['familia_clave']==15){;
		
		  ?>
           <table class='material' width=50%>
             <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['nombre_familia']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%"><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="20%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            </table>
<?php 
 $cuenta=$cuenta+$lab_invent['cuenta'];
          
} // procesador 


} // while equipos  Intel Pentium Core i3 o equivalentes
?>

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="20%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
  
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>

   <tr>
     <td align="center"><h3>Intel Core i5 o equivalentes </h3></td>
    </tr>
 
    <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Familia</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Uso/Desuso</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="20%" scope="col">Total</th>
         </tr>
  </table>       
 <?php
 $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ($lab_invent['familia_clave']==8 || $lab_invent['familia_clave']==17 || $lab_invent['familia_clave']==14 || $lab_invent['familia_clave']==16){;
		
		  ?>
          
		   
          <table class='material' width=50%>
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['nombre_familia']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%"><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="20%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            </table>
<?php 
 $cuenta=$cuenta+$lab_invent['cuenta'];
          
} // procesador 


} // while equipos  Intel Core i5 o equivalentes
?>

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="20%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
 
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>

    <tr>
      <td align="center"><h3>Intel Core i7 o equivalentes </h3></td>
    </tr>
    
   <table class='material' width=50%>
		 <tr> <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Familia</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Uso/Desuso</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="20%" scope="col">Total</th>
            
         </tr>
</table>


 <?php
 $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ( $lab_invent['familia_clave']==9 || $lab_invent['familia_clave']==18 ){;
		
		  ?>
          
		   
    <table class='material' width=50%>
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['nombre_familia']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%"><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="20%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            </table>
<?php 
$cuenta=$cuenta+$lab_invent['cuenta'];
          
} // procesador 

} // while equipos  Intel Core i7 o equivalentes
?>

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="20%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
 
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>

    <tr>
      <td align="center"><h3>Otros </h3></td>
    </tr>
    
   <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Familia</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Uso/Desuso</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="20%" scope="col">Total</th>
            
         </tr>
</table>


 <?php
 $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ( $lab_invent['familia_clave']==22 ){;
		
		  ?>
          
		   
    <table class='material' width=50%>
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['nombre_familia']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%"><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="20%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            </table>
<?php 
$cuenta=$cuenta+$lab_invent['cuenta'];
          
} // procesador 

} // while equipos  Otros
?>


<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="20%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php
if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div'] ==""){

	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
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
			AND  (marca_p='APPLE' OR marca_p='MAC')
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
			
	}
	else if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div'] !="" ){	
	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
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
			AND  (marca_p='APPLE' OR marca_p='MAC')
			AND id_div=" . $_SESSION['id_div'] . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
		
	}
	if ( $_SESSION['tipo_usuario']!=10  && $_SESSION['id_div'] !="" ){
			
	 $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
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
			AND  (marca_p='APPLE' OR marca_p='MAC')
			AND id_div=". $_SESSION['id_div'] . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
	}else if ( $_SESSION['tipo_usuario']!=10  && $_SESSION['id_div'] =="" )
	{ 
	
	$query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
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
			AND  (marca_p='APPLE' OR marca_p='MAC')
			
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
	}    
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>

<tr>
      <td align="center"><h3>MAC </h3></td>
 </tr>
 
 <table  class='material' width=50%>
		 <tr> 
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Familia</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Uso/Desuso</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="20%" scope="col">Total</th>
            
         </tr>
        </table>

<?php
$cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		
		  ?>
          
    <table class='material' width=50%>
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['nombre_familia']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%"><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="20%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            </table>
<?php 
$cuenta=$cuenta+$lab_invent['cuenta'];
          
} // procesador MAC

?>
<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="20%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
