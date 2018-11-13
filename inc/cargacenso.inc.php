
<?php
session_start(); 
require_once('../conexion.php');

require_once('../clases/laboratorios.class.php');

require_once('../clases/log.class.php');


$logger=new Log();

$logger->putLog(7,2);
/*
echo 'Div en carga censo';
print_r ($_SESSION);
echo 'Div en carga censo RQ';
print_r ($_REQUEST);
*/
if ($_SESSION['tipo_usuario']==10)
    $_SESSION['id_div']=$_REQUEST['div'];
   
 if ($_GET['mod']=='ceneceq' ){
 ?>
<br \>
<br \>

<div style="text-align:center;">
 <table>
  <tr>
      <td align="center" ><h2>Censo de Equipo de Cómputo&nbsp;&nbsp;&nbsp;</h2></td>
   
  <td  align="center">
		      <form action="../inc/exportaxls_censoeqc.inc.php" method="post" name="ceneceq" >
	          <input name="enviar" type="submit" value="Exportar a Excel" />
	          </form>
   </td>           
   </tr>  
   <tr>  </tr>  
   <tr>  </tr>  
       <tr>  </tr>  
   <tr>  </tr>    
   <tr>
      <td align="center" ><h3>Anteriores a Pentium 4 o equivalentes</h3></td>
    </tr>
    <tr>  </tr>  
   <tr>  </tr>
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
	
	//echo 'query en censo';
	//echo $query;		       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
	    <table  class='material' width=50%>
		 <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="15%" scope="col">Familia</th>
              <th width="15%" scope="col">Dispositivo</th>
              <th width="15%" scope="col">Uso/Desuso</th>
              <th width="15%" scope="col">Alto Rendimiento</th>
              <th width="15%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
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
              <td width="15%"><?php echo ucwords(strtolower($lab_invent['nombre_familia']));?></td>
               <td width="15%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="15%"  ><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="15%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%" ><?php echo $lab_invent['cuenta'];?></td>
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
<th >TOTAL</th>
  
    <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>

<?php 

$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>

  <table>
   <tr>
      <td align="center"><h3>Pentium Celeron  o equivalentes</h3></td>
    </tr>
     <tr></tr>
  </table>

   <table class='material' width=50%>
		 <tr>
             <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
             <th width="15%" scope="col">Familia</th>
              <th width="15%" scope="col">Dispositivo</th>
              <th width="15%" scope="col">Uso/Desuso</th>
              <th width="15%" scope="col">Alto Rendimiento</th>
              <th width="15%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
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
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['nombre_familia']));?></td>
               <td width="15%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="15%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
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
              <th width="15%" scope="col">Familia</th>
              <th width="15%" scope="col">Dispositivo</th>
              <th width="15%" scope="col">Uso/Desuso</th>
              <th width="15%" scope="col">Alto Rendimiento</th>
              <th width="15%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
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
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['nombre_familia']));?></td>
               <td width="15%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="15%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
  
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
    <table>
   <tr>
     <td align="center"><h3>Intel Core i5 o equivalentes </h3></td>
    </tr>
   </table>
    <table class='material' width=50%>
		 <tr>  
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="15%" scope="col">Familia</th>
              <th width="15%" scope="col">Dispositivo</th>
              <th width="15%" scope="col">Uso/Desuso</th>
              <th width="15%" scope="col">Alto Rendimiento</th>
              <th width="15%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
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
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['nombre_familia']));?></td>
               <td width="15%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="15%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
 
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
    <table>
    <tr>
      <td align="center"><h3>Intel Core i7 o equivalentes </h3></td>
    </tr>
    </table>
   <table class='material' width=50%>
		 <tr>  
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="15%" scope="col">Familia</th>
              <th width="15%" scope="col">Dispositivo</th>
              <th width="15%" scope="col">Uso/Desuso</th>
              <th width="15%" scope="col">Alto Rendimiento</th>
              <th width="15%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
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
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['nombre_familia']));?></td>
               <td width="15%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="15%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
 
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
    <table>
    <tr>
      <td align="center"><h3>Otros </h3></td>
    </tr>
    </table>
   <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="15%" scope="col">Familia</th>
              <th width="15%" scope="col">Dispositivo</th>
              <th width="15%" scope="col">Uso/Desuso</th>
              <th width="15%" scope="col">Alto Rendimiento</th>
              <th width="15%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
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
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['nombre_familia']));?></td>
               <td width="15%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="15%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
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
	echo 'usu!=10,div!=null OTRO';
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
<table>
<tr>
      <td align="center"><h3>MAC </h3></td>
 </tr>
 </table>
 
 <table  class='material' width=50%>
		 <tr>  
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9){ ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="15%" scope="col">Familia</th>
              <th width="15%" scope="col">Dispositivo</th>
              <th width="15%" scope="col">Uso/Desuso</th>
              <th width="15%" scope="col">Alto Rendimiento</th>
              <th width="15%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
         </tr>
        </table>

<?php
$cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		
		  ?>
          
    <table class='material' width=50%>
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['nombre_familia']));?></td>
               <td width="15%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="15%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            </table>
<?php 
$cuenta=$cuenta+$lab_invent['cuenta'];
          
} // procesador MAC

?>
<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>

<?php
 } // fin de censo de equipo
 
 
 if ($_GET['mod']=='cenecso' ){
 
?>
 <br />
  <br />

<table>
  <tr>
      <td align="center" ><h2>Censo de Equipo de Cómputo Sistema Operativo</h2></td>
   
  <td  align="center">
		<form action="../inc/exportaxls_censoeqcso.inc.php" method="post" name="ceneceq" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	          <input name="enviar" type="submit" value="Exportar a Excel" />
	          </form>
   </td>           
   </tr>  
   <tr>  </tr>  
   <tr>  </tr>  
       <tr>  </tr>  
   <tr>  </tr>    
   <tr>
      <td align="center" ><h3>Anteriores a Pentium 4 o equivalentes  </h3></td>
    </tr>
    <tr>  </tr>  
   <tr>  </tr>
</table>



		<?php 
		if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p<>'APPLE' OR marca_p<>'MAC')
            GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
	}
	else if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p<>'APPLE' OR marca_p<>'MAC')
			AND id_div=". $_SESSION['id_div'] . "
            GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC ";
	}
	
	if ( $_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p<>'APPLE' OR marca_p<>'MAC')
            GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
	}else if ( $_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p<>'APPLE' OR marca_p<>'MAC')
			AND id_div=". $_SESSION['id_div'] . "
            GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC ";
	}
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
    
?>
	    <table  class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="15%" scope="col">Laboratorio</th> <?php }?>
              <th width="15%" scope="col">Sistema Operativo</th>
              <th width="15%" scope="col">Familia</th>
              <th width="15%" scope="col">Dispositivo</th>
              <th width="15%" scope="col">Uso/Desuso</th>
              <th width="15%" scope="col">Alto Rendimiento</th>
              <th width="15%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
         </tr>
        </table>
 <?php
 $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
       
     
		
		 if ( $lab_invent['familia_clave']==1 ||  $lab_invent['familia_clave']==2 || $lab_invent['familia_clave']==3 ||$lab_invent['familia_clave']==11){;
		
		  ?>
          <table class='material' width=50%>
          
		   <tr >
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="15%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="15%"><?php echo $lab_invent['nombre_so'];?></td>
               <td width="15%"><?php echo $lab_invent['nombre_familia'];?></td>
               <td width="15%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="15%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            </table>
       <?php 

          $cuenta=$cuenta+$lab_invent['cuenta']; 
		 }//  Sistema operativo ?>
   

    <?php
    } // while equipos anteriores a Pentium 4

?>

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 

$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>

    <table>
   <tr>
      <td align="center"><h3>Pentium Celeron  o equivalentes </h3></td>
    </tr>
    </table>

   <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="15%" scope="col">Laboratorio</th> <?php }?>
              <th width="15%" scope="col">Sistema Operativo</th>
              <th width="15%" scope="col">Familia</th>
              <th width="15%" scope="col">Dispositivo</th>
              <th width="15%" scope="col">Uso/Desuso</th>
              <th width="15%" scope="col">Alto Rendimiento</th>
              <th width="15%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
         </tr>
     </table>
         
          <?php
		$cuenta=0;  
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ( $lab_invent['familia_clave']==4 || $lab_invent['familia_clave']==5||  $lab_invent['familia_clave']==12|| $lab_invent['familia_clave']==10 ||  $lab_invent['familia_clave']==13){;
		
		  ?>
          
		    <table class='material' width=50%>
		 
   
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9){ ?> <td width="15%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="15%"><?php echo $lab_invent['nombre_so'];?></td>
               <td width="15%"><?php echo $lab_invent['nombre_familia'];?></td>
               <td width="15%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="15%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
  
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
   <table>
   <tr>
      <td align="center"><h3>Intel Core i3 o equivalentes</h3></td>
    </tr>
   </table>
   <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="15%" scope="col">Laboratorio</th> <?php }?>
              <th width="15%" scope="col">Sistema Operativo</th>
              <th width="15%" scope="col">Familia</th>
              <th width="15%" scope="col">Dispositivo</th>
              <th width="15%" scope="col">Uso/Desuso</th>
              <th width="15%" scope="col">Alto Rendimiento</th>
              <th width="15%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
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
               <?php if ( $_SESSION['tipo_usuario']==10) { ?> <td width="15%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="15%"><?php echo $lab_invent['nombre_so'];?></td>
               <td width="15%"><?php echo $lab_invent['nombre_familia'];?></td>
               <td width="15%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="15%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>

<?php 
  		       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>

   <table>
   <tr>
     <td align="center"><h3>Intel Core i5 o equivalentes </h3></td>
    </tr>
    </table>
    <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9){ ?> <th width="15%" scope="col">Laboratorio</th> <?php }?>
              <th width="15%" scope="col">Sistema Operativo</th>
              <th width="15%" scope="col">Familia</th>
              <th width="15%" scope="col">Dispositivo</th>
              <th width="15%" scope="col">Uso/Desuso</th>
              <th width="15%" scope="col">Alto Rendimiento</th>
              <th width="15%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
         </tr>
  </table>       
 <?php $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ( $lab_invent['familia_clave']==8 || $lab_invent['familia_clave']==17 || $lab_invent['familia_clave']==14 || $lab_invent['familia_clave']==16){;
		
		  ?>
          
		   
          <table class='material' width=50%>
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="15%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="15%"><?php echo $lab_invent['nombre_so'];?></td>
               <td width="15%"><?php echo $lab_invent['nombre_familia'];?></td>
               <td width="15%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="15%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
 		       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
    <table>
    <tr>
      <td align="center"><h3>Intel Core i7 o equivalentes</h3></td>
    </tr>
    </table>
   
   <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="15%" scope="col">Laboratorio</th> <?php }?>
              <th width="15%" scope="col">Sistema Operativo</th>
              <th width="15%" scope="col">Familia</th>
              <th width="15%" scope="col">Dispositivo</th>
              <th width="15%" scope="col">Uso/Desuso</th>
              <th width="15%" scope="col">Alto Rendimiento</th>
              <th width="15%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
         </tr>
</table>

 <?php
        $cuenta=0; 
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ($lab_invent['familia_clave']==9 || $lab_invent['familia_clave']==18  ){;
		
		  ?>
          
		   
    <table class='material' width=50%>
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="15%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="15%"><?php echo $lab_invent['nombre_so'];?></td>
               <td width="15%"><?php echo $lab_invent['nombre_familia'];?></td>
               <td width="15%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="15%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            </table>
<?php 
 $cuenta=$cuenta+$lab_invent['cuenta'];
          
      } // so

  }// while equipos  Intel Core i7 o equivalentes
		
?>


<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>

<?php 
 
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
    <table>
    <tr>
      <td align="center"><h3>Otros </h3></td>
    </tr>
    </table>
   <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="15%" scope="col">Laboratorio</th> <?php }?>
              <th width="15%" scope="col">Sistema Operativo</th>
              <th width="15%" scope="col">Familia</th>
              <th width="15%" scope="col">Dispositivo</th>
              <th width="15%" scope="col">Uso/Desuso</th>
              <th width="15%" scope="col">Alto Rendimiento</th>
              <th width="15%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
            
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
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="15%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="15%"><?php echo $lab_invent['nombre_so'];?></td>
               <td width="15%"><?php echo $lab_invent['nombre_familia'];?></td>
               <td width="15%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="15%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>

<table>
<tr>
      <td align="center"><h3>MAC </h3></td>
    </tr>
</table>
		<?php 
	if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p='APPLE' OR marca_p='MAC')
            GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
	}
	else if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p='APPLE' OR marca_p='MAC')
			AND id_div=". $_SESSION['id_div'] . "
            GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC ";
	}
	
	if ( $_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p='APPLE' OR marca_p='MAC')
            GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
	}else if ( $_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p='APPLE' OR marca_p='MAC')
			AND id_div=". $_SESSION['id_div'] . "
            GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC ";
	}
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
    
?>
	    <table  class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="15%" scope="col">Laboratorio</th> <?php }?>
              <th width="15%" scope="col">Sistema Operativo</th>
              <th width="15%" scope="col">Familia</th>
              <th width="15%" scope="col">Dispositivo</th>
              <th width="15%" scope="col">Uso/Desuso</th>
              <th width="15%" scope="col">Alto Rendimiento</th>
              <th width="15%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
         </tr>
        </table>


 <?php
        $cuenta=0; 
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		
		  ?>
          
		   
    <table class='material' width=50%>
            <tr>
                <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="15%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="15%"><?php echo $lab_invent['nombre_so'];?></td>
               <td width="15%"><?php echo $lab_invent['nombre_familia'];?></td>
               <td width="15%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="15%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="15%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            </table>
<?php 
       $cuenta=$cuenta+$lab_invent['cuenta'];
	
		
		}// while equipos  MAC procesador
		
		?>

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>


<?php		
		
 }

 if ($_GET['mod']=='cenecuf' ){
    
		  ?>
 <br />
  <br />
 <table>  
  <tr>
      <td align="center" ><h2>Censo de Equipo de Cómputo Usuario Final</h2></td>
   
  <td  align="center">
		<form action="../inc/exportaxls_censoeqcuf.inc.php" method="post" name="ceneceq" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	          <input name="enviar" type="submit" value="Exportar a Excel" />
	          </form>
   </td>           
   </tr>  
   <tr>  </tr>  
   <tr>  </tr>  
       <tr>  </tr>  
   <tr>  </tr>    
   <tr>
      <td align="center" ><h3>Anteriores a Pentium 4 o equivalentes  </h3></td>
    </tr>
    <tr>  </tr>  
   <tr>  </tr>
</table>
        
   
		<?php 
	if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p<>'APPLE' OR marca_p<>'MAC')
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
	}
	else if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
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
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
	}
	if ($_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p<>'APPLE' OR marca_p<>'MAC')
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
	}
	else if ($_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
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
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
	}
	
	
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
    
?>
	    <table  class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9){ ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
         </tr>
        </table>
 <?php
 $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
   
		 if ( $lab_invent['familia_clave']==1 ||  $lab_invent['familia_clave']==2 || $lab_invent['familia_clave']==3 ||$lab_invent['familia_clave']==11 ){;
		
		  ?>
          <table class='material' width=50%>
          <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
              <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
              <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
              <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
              <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
              <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            </table>
       <?php 

        $cuenta=$cuenta+$lab_invent['cuenta'];  
		 }//  Usuario Final ?>
   
    <?php
    } // while equipos anteriores a Pentium 4

?>

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 

$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>

<table>
   <tr>
      <td align="center"><h3>Pentium Celeron  o equivalentes </h3></td>
    </tr>
</table>
 <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
         </tr>
     </table>
         
          <?php
		$cuenta=0;  
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ( $lab_invent['familia_clave']==4 || $lab_invent['familia_clave']==5||  $lab_invent['familia_clave']==12|| $lab_invent['familia_clave']==10 ||  $lab_invent['familia_clave']==13){;
          ?>
           <table class='material' width=50%>
		 
            <tr>
            <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
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
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="20%" scope="col">Total</th>
            
         </tr>
   </table>      
  
 <?php
        $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		if ($lab_invent['familia_clave']==7 || $lab_invent['familia_clave']==6 || $lab_invent['familia_clave']==15){;
		
		  ?>
          
		   <table class='material' width=50%>
           <tr>
               <?php  if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
  
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
   <table>
   <tr>
     <td align="center"><h3>Intel Core i5 o equivalentes </h3></td>
    </tr>
    </table>
    <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
         </tr>
  </table>       
 <?php $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ( $lab_invent['familia_clave']==8 || $lab_invent['familia_clave']==17 || $lab_invent['familia_clave']==14 || $lab_invent['familia_clave']==16 ){;?>
          
          <table class='material' width=50%>
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
 
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
    <table>
    <tr>
      <td align="center"><h3>Intel Core i7 o equivalentes </h3></td>
    </tr>
    </table>
   <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
         </tr>
   </table>


 <?php $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ($lab_invent['familia_clave']==9 || $lab_invent['familia_clave']==18 ){;
		
		  ?>
          
		   
    <table class='material' width=50%>
            <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
         </table>   
<?php 
$cuenta=$cuenta+$lab_invent['cuenta'];
          
   } // usuario final


}// while equipos  Intel Core i7 o equivalentes



?>

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>

<?php			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
    <table>
    <tr>
      <td align="center"><h3>Otros </h3></td>
    </tr>
    </table>
   
   <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
         </tr>
   </table>


 <?php $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ($lab_invent['familia_clave']==22 ){;
		
		  ?>
          
		   
    <table class='material' width=50%>
            <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
              <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
         </table>   
<?php 
$cuenta=$cuenta+$lab_invent['cuenta'];
          
   } // usuario final


}// while equipos  Otros


?>

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>




   <table>
   <tr>
      <td align="center"><h3>MAC  </h3></td>
    </tr>
   </table>
		<?php 
		
		if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p='APPLE' OR marca_p='MAC')
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
	}
	else if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
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
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
	}
	if ($_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p='APPLE' OR marca_p='MAC')
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
	}
	else if ($_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
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
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
	}
	
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
    
?>

 <table  class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9){ ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
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
          <tr >
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            </table>
       <?php 

        $cuenta=$cuenta+$lab_invent['cuenta'];  
		 }//  Usuario Final MAC?>
   
 
<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>



<?php		
		
 }

 if ($_GET['mod']=='cenecufb' ){ ?>
 
<br \>
<br \>

 <table>  
 <tr>
      <td align="center" ><h2>Censo de Equipo de Cómputo Usuario Final Bibliotecas</h2></td>
      
  <td  align="center">
		<form action="../inc/exportaxls_censoeqcufb.inc.php" method="post" name="ceneceq" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	          <input name="enviar" type="submit" value="Exportar a Excel" />
	          </form>
   </td>           
   </tr>  
   <tr>  </tr>  
   <tr>  </tr>  
       <tr>  </tr>  
   <tr>  </tr>    
   <tr>
      <td align="center" ><h3>Anteriores a Pentium 4 o equivalentes  </h3></td>
    </tr>
    <tr>  </tr>  
   <tr>  </tr>
   </table>
		<?php 
		
if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND tipo_lab='b'
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p<>'APPLE' OR marca_p<>'MAC')
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
	}	
	else if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){			
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND tipo_lab='b'
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p<>'APPLE' OR marca_p<>'MAC')
			AND id_div=". $_SESSION['id_div'] . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
	}
	if ($_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND tipo_lab='b'
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p<>'APPLE' OR marca_p<>'MAC')
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
	}	
	else if ($_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']!=""){			
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND tipo_lab='b'
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p<>'APPLE' OR marca_p<>'MAC')
			AND id_div=". $_SESSION['id_div'] . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
	}
	

$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
	    <table  class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
         </tr>
        </table>
 <?php $cuenta=0;
 
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
       
		 if ($lab_invent['familia_clave']==1 ||  $lab_invent['familia_clave']==2 || $lab_invent['familia_clave']==3 || $lab_invent['familia_clave']==11 ){;
		 ?>
          <table class='material' width=50%>
          <tr >
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            </table>
       <?php 

      $cuenta=$cuenta+$lab_invent['cuenta'];    
		 }//  Usuario Final 
		 
    } // while equipos anteriores a Pentium 4

?>

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 

$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
   <table>
   <tr>
      <td align="center"><h3>Pentium Celeron  o equivalentes</h3></td>
    </tr>
    </table>

   <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
         </tr>
     </table>
         
          <?php $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ( $lab_invent['familia_clave']==4 || $lab_invent['familia_clave']==5||  $lab_invent['familia_clave']==12|| $lab_invent['familia_clave']==10 ||  $lab_invent['familia_clave']==13 ){;
		 ?>
           <table class='material' width=50%>
		 
            <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
  
			       

$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>

   <table>
   <tr>
      <td align="center"><h3>Intel Core i3 o equivalentes</h3></td>
    </tr>
   </table>
   
   <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
         </tr>
   </table>      
  
 <?php $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ( $lab_invent['familia_clave']==7 || $lab_invent['familia_clave']==6 || $lab_invent['familia_clave']==15){;
		
		  ?>
          <table class='material' width=50%>
   
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
  
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
     <table>
     <tr>
       <td align="center"><h3>Intel Core i5 o equivalentes </h3></td>
     </tr>
     </table>
    <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
         </tr>
  </table>       
 <?php
 $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ($lab_invent['familia_clave']==8 || $lab_invent['familia_clave']==17 || $lab_invent['familia_clave']==14 || $lab_invent['familia_clave']==16  ){;?>
          
          <table class='material' width=50%>
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
       </table>     
<?php 
$cuenta=$cuenta+$lab_invent['cuenta'];
          
} // procesador 


}// while equipos  Intel Core i5 o equivalentes
?>

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
		       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
    <table>
    <tr>
      <td align="center"><h3>Intel Core i7 o equivalentes</h3></td>
    </tr>
   </table>
   <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
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
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
       </table>     
<?php 
$cuenta=$cuenta+$lab_invent['cuenta'];
          
    } // usuario final bibliotecas
 

}// while equipos  Intel Core i7 o equivalentes



?>

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>

<?php 
		       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
    <table>
    <tr>
      <td align="center"><h3>Otros</h3></td>
    </tr>
    </table>
   <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
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
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
       </table>     
<?php 
$cuenta=$cuenta+$lab_invent['cuenta'];
          
    } // usuario final bibliotecas
 

}// while equipos  Otros



?>

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
		<?php 
		
		
if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND tipo_lab='b'
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p='APPLE' OR marca_p='MAC')
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
	}	
	else if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){			
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND tipo_lab='b'
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p='APPLE' OR marca_p='MAC')
			AND id_div=". $_SESSION['id_div'] . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
	}
	if ($_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND tipo_lab='b'
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p='APPLE' OR marca_p='MAC')
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
	}	
	else if ($_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']!=""){			
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND tipo_lab='b'
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
			AND  (marca_p='APPLE' OR marca_p='MAC')
			AND id_div=". $_SESSION['id_div'] . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
	}
	
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
    
?>

<table>
 <tr>
      <td align="center"><h3>MAC</h3></td>
    </tr>
</table>   
   <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
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
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
       </table>     
<?php 
$cuenta=$cuenta+$lab_invent['cuenta'];
          
    } // usuario final bibliotecas MAC

?>

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
 <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>

<?php 
}
 
 if ($_GET['mod']=='ceni' ){
 ?>
   <br \>
 <br \>

 
 <table>  
   <tr>
       <td align="center"><h2>Censo de Impresoras</h2></td>
      
  <td  align="center">
		<form action="../inc/exportaxls_censoeqimp.inc.php" method="post" name="ceneceq" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	          <input name="enviar" type="submit" value="Exportar a Excel" />
	          </form>
   </td>           
   </tr>  
   <tr>  </tr>  
   <tr>  </tr>  
       <tr>  </tr>  
   <tr>  </tr>    
    </table>
    
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
            WHERE (dp.dispositivo_clave=10 OR dp.dispositivo_clave=11 )
            AND  (estadoBien='USO' OR estadoBien='DESUSO')
			GROUP BY nombre_dispositivo,estadobien,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre";	
	}
	else if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){

  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura
            FROM dispositivo dp 
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN laboratorios l
            ON dp.id_lab=l.id_lab
            LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (dp.dispositivo_clave=10 OR dp.dispositivo_clave=11 )
            AND  (estadoBien='USO' OR estadoBien='DESUSO')
			AND id_div=".$_SESSION['id_div']  . "
			GROUP BY nombre_dispositivo,estadobien,fecha_factura
			ORDER BY cuenta";
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
            WHERE (dp.dispositivo_clave=10 OR dp.dispositivo_clave=11 )
            AND  (estadoBien='USO' OR estadoBien='DESUSO')
			GROUP BY nombre_dispositivo,estadobien,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre";	
	}
	else if ($_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']!=""){

  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura
            FROM dispositivo dp 
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN laboratorios l
            ON dp.id_lab=l.id_lab
            LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (dp.dispositivo_clave=10 OR dp.dispositivo_clave=11 )
            AND  (estadoBien='USO' OR estadoBien='DESUSO')
			AND id_div=".$_SESSION['id_div']  . "
			GROUP BY nombre_dispositivo,estadobien,fecha_factura
			ORDER BY cuenta";
	}
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
    ?>
    
    	 <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Uso/Desuso</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
          </tr>

         </table>


	<?php
         $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ ?>
          
         <table class='material' width=50%>
		    <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%" scope="col"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%" scope="col"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%" scope="col"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
         </table>
            
<?php 

    $cuenta=$cuenta+$lab_invent['cuenta'];      
  	
		} ?>
 

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
 
 
 <?php
 } 
 
 if ($_GET['mod']=='cened' ){
 
		  ?>
 <br \>
 <br \>

 <table>
   <tr>
       <td align="center"><h2>Equipo Digital</h2></td>
      
  <td  align="center">
		<form action="../inc/exportaxls_censoeqdig.inc.php" method="post" name="ceneceq" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	          <input name="enviar" type="submit" value="Exportar a Excel" />
	          </form>
   </td>           
   </tr>  
   <tr>  </tr>  
   <tr>  </tr>  
       <tr>  </tr>  
   <tr>  </tr>    
    </table>   
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
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,l.nombre
			ORDER BY cuenta ASC";
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
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,l.nombre
			ORDER BY cuenta ASC";
	}
	
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 

?>
    <table class='material'>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Bien</th>
              <th width="20%" scope="col">Uso/Desuso</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
          </tr>

         </table>

<?php  $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ ?>
		
		   <table class='material'>
             <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%" scope="col"><?php echo $lab_invent['bien'];?></td>
               <td width="20%" scope="col"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%" scope="col"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
    
            </table>
<?php 

    $cuenta=$cuenta+$lab_invent['cuenta'];      
  	
		} ?>
 

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
    
  <?php 
   	
} //termina Equipo Digital
		

 if ($_GET['mod']=='cenert' ){ ?>
 
  
 <table>
 <tr>
       <td align="center"><h2>Censo Equipo Redes y Telecomunicaciones</h2></td>
      
  <td  align="center">
		<form action="../inc/exportaxls_censoeqryt.inc.php" method="post" name="ceneceq" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	          <input name="enviar" type="submit" value="Exportar a Excel" />
	          </form>
   </td>           
   </tr>  
   <tr>  </tr>  
   <tr>  </tr>  
       <tr>  </tr>  
   <tr>  </tr>     
   </table>
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
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,l.nombre
			ORDER BY cuenta ASC";
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
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,l.nombre
			ORDER BY cuenta ASC";
	}
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
    
?>

        <table class='material'>
		    <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Uso/Desuso</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="1%" scope="col">Total</th>
            
            </tr>
         </table>

<?php  $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ ?>
		
         <table class='material'>
		    
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9){ ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%" scope="col"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%" scope="col"><?php echo ucwords(strtolower($lab_invent['estadobien']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="1%" scope="col"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
    
          </table>  
<?php 

    $cuenta=$cuenta+$lab_invent['cuenta'];      
  	
		} ?>
 

<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="1%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
  
<?php
 } //termina Equipo Redes y Telecomunicaciones
 
 if ($_GET['mod']=='cenecar' ){?>
 
 <br \>
 <br \>

 <table>
<tr>
       <td align="center"><h2>Censo de Equipos de Alto Rendimiento</h2></td>
      
  <td  align="center">
		<form action="../inc/exportaxls_censoeqcar.inc.php" method="post" name="cenecar" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	          <input name="enviar" type="submit" value="Exportar a Excel" />
	          </form>
   </td>           
   </tr>  
   <tr>  </tr>  
   <tr>  </tr>  
       <tr>  </tr>  
   <tr>  </tr>     

    </table>
  
		<?php 
		
	if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
	
	$query=" SELECT  equipoaltorend,descmarca,modelo_p,serie,inventario,sist_oper,nombre_so,fecha_factura,l.nombre
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN laboratorios l
			ON dp.id_lab=l.id_lab
            LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN departamentos d 
			ON d.id_dep=l.id_dep
            WHERE equipoaltorend='Si'
			ORDER BY marca_p,l.nombre ASC";	
	}
	else if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){

  $query= " SELECT  equipoaltorend,descmarca,modelo_p,serie,inventario,sist_oper,nombre_so,fecha_factura,l.nombre
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN laboratorios l
			ON dp.id_lab=l.id_lab
            LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN departamentos d 
			ON d.id_dep=l.id_dep
            WHERE equipoaltorend='Si'
			AND id_div=". $_SESSION['id_div']  . "
			ORDER BY marca_p,l.nombre ASC";
	}
		if ($_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']==""){
	
	$query=" SELECT  equipoaltorend,descmarca,modelo_p,serie,inventario,sist_oper,nombre_so,fecha_factura,l.nombre,l.nombre
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN laboratorios l
			ON dp.id_lab=l.id_lab
            LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN departamentos d 
			ON d.id_dep=l.id_dep
            WHERE equipoaltorend='Si'
			ORDER BY marca_p,l.nombre ASC";	
	}
	else if ($_SESSION['tipo_usuario']!=10 && $_SESSION['id_div']!=""){

  $query= " SELECT  equipoaltorend,descmarca,modelo_p,serie,inventario,sist_oper,nombre_so,fecha_factura,l.nombre
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN laboratorios l
			ON dp.id_lab=l.id_lab
            LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN departamentos d 
			ON d.id_dep=l.id_dep
            WHERE equipoaltorend='Si'
			AND id_div=". $_SESSION['id_div']  . "
			ORDER BY marca_p,l.nombre ASC";
	}
	
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
    ?>
    
    	 <table class='material' width=50%>
		 <tr>
             <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Laboratorio</th> <?php }?>
              <th width="20%" scope="col">Marca</th>
              <th width="20%" scope="col">Modelo</th>
              <th width="20%" scope="col">Serie</th>
              <th width="20%" scope="col">Inventario</th>
              <th width="20%" scope="col">Sistema Operativo</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
         </tr>

         </table>


	<?php
        
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
	
		  ?>
          
		    <table class='material' width=50%>
		 
            <tr>
             <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9){ ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%" scope="col"><?php echo ucwords(strtolower($lab_invent['descmarca']));?></td>
               <td width="20%" scope="col"><?php echo ucwords(strtolower($lab_invent['modelo_p']));?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['serie'];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['inventario'];?></td>
               <td width="20%" scope="col"><?php echo ucwords(strtolower($lab_invent['nombre_so']));?></td>
               <td width="20%" ><?php echo $lab_invent['fecha_factura'];?></td>
            </tr>
        </table>  
<?php 

    $cuenta=$cuenta+$lab_invent['cuenta'];      
  	
		} ?>
 
<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="20%" ><strong><?php echo $inventario . "  " . " Equipos";?></strong></td>
</tr>
</table>
 
 
 <?php
 } //Termina Equipo de Alto Rendimiento
 

 ?>
 </div>
<br/>
<br/>
