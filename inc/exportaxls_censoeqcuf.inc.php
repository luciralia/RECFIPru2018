<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<?php
session_start(); 
require_once('../conexion.php'); 
require_once('../clases/inventario.class.php'); 

header("Pargma:public");
header("Expires:0");
header("Content-type: application/x-msdownload");
header("Pargma:no-cache");
header("Cache-Control: must_revalidate,post-check=0,pre-check=0");
$censoxls= new inventario();

$nombredoc= new Inventario();

$textosi=$nombredoc->obtienenombre($_SESSION['tipo_usuario'],$_SESSION['id_div'],$_REQUEST['lab']);

header($textosi);

?>


      <tr>
      <td align="center"><h2>Censo de Equipo de Cómputo Usuario Final </h2></td>
      </tr>
      <tr>
      <td align="center"><h3>Anteriores a Pentium 4 o equivalentes  </h3></td>
      </tr>
 
		<?php 
$query=$censoxls->CensoUFNoMac($_SESSION['tipo_usuario'],$_SESSION['id_div'],$_REQUEST['lab']);
		
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
	    <table  class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Área</th> <?php }?>
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
       
		 if ( $lab_invent['familia_clave']==1 ||  $lab_invent['familia_clave']==2 || $lab_invent['familia_clave']==3 ||$lab_invent['familia_clave']==11 ){ ?>
          <table class='material' width=50%>
           <tr >
               <?php if ( $_SESSION['tipo_usuario']==10) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%"><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="20%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="25%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 

$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
 <tr>
      <td align="center"><h3>Pentium Celeron  o equivalentes </h3></td>
    </tr>
 <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Área</th> <?php }?>
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
		 if ( $lab_invent['familia_clave']==4 || $lab_invent['familia_clave']==5||  $lab_invent['familia_clave']==12|| $lab_invent['familia_clave']==10 ||  $lab_invent['familia_clave']==13){  ?>
          
		  <table class='material' width=50%>
		  <tr>
               <?php if ( $_SESSION['tipo_usuario']==10) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
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
   <td width="25%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
<?php 
  
			       

$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
    <tr>
    <td align="center"><h3>Intel Core i3 o equivalentes </h3></td>
    </tr>
    <table class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Área</th> <?php }?>
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
		if ($lab_invent['familia_clave']==7 || $lab_invent['familia_clave']==6 || $lab_invent['familia_clave']==15){?>
          
		   <table class='material' width=50%>
           <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
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
   <td width="25%" ><strong><?php echo $cuenta;?></strong></td>
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
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Área</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="20%" scope="col">Total</th>
         </tr>
  </table>       
 <?php $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ( $lab_invent['familia_clave']==8 || $lab_invent['familia_clave']==17 || $lab_invent['familia_clave']==14 || $lab_invent['familia_clave']==16 ){ ?>
           
          <table class='material' width=50%>
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
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
   <td width="25%" ><strong><?php echo $cuenta;?></strong></td>
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
		 <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Área</th> <?php }?>
               <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="20%" scope="col">Total</th>
            
         </tr>
   </table>


 <?php $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ($lab_invent['familia_clave']==9 || $lab_invent['familia_clave']==18 ){; ?>
    <table class='material' width=50%>
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%"><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="20%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="25%" ><strong><?php echo $cuenta;?></strong></td>
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
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Área</th> <?php }?>
              <th width="20%" scope="col">Usuario Final</th>
              <th width="20%" scope="col">Dispositivo</th>
              <th width="20%" scope="col">Alto Rendimiento</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
              <th width="20%" scope="col">Total</th>
            
         </tr>
   </table>


 <?php $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 if ( $lab_invent['familia_clave']==19 || $lab_invent['familia_clave']==20 || $lab_invent['familia_clave']==21 || $lab_invent['familia_clave']==22){ ?>
         <table class='material' width=50%>
            <tr>
               <?php if ( $_SESSION['tipo_usuario']==10|| $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%"><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="20%"><?php echo $lab_invent['cuenta'];?></td>
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
   <td width="25%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>


<tr>
      <td align="center"><h3>MAC  </h3></td>
    </tr>
  
		<?php 
			

	
$query=$censoxls->CensoUFMac($_SESSION['tipo_usuario'],$_SESSION['id_div'],$_REQUEST['lab']);
		
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
    
?>

 <table  class='material' width=50%>
		 <tr>
              <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Área</th> <?php }?>
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
		{ ?>
          <table class='material' width=50%>
          <tr >
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['tipo_usuario']));?></td>
               <td width="20%"><?php echo $lab_invent['nombre_dispositivo'];?></td>
               <td width="20%"><?php echo ucwords(strtolower($lab_invent['equipoaltorend']));?></td>
               <td width="20%"><?php echo $lab_invent['fecha_factura'];?></td>
               <td width="20%"><?php echo $lab_invent['cuenta'];?></td>
            </tr>
            </table>
       <?php 

        $cuenta=$cuenta+$lab_invent['cuenta'];  
		 }//  Usuario Final MAC?>
   
 
<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="25%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>


