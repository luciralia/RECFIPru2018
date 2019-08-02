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
      <td align="center"><h2>Equipo Redes y Telecomunicaciones</h2></td>
   </tr>

		<?php 
			
$query=$censoxls->RedesTel($_SESSION['tipo_usuario'],$_SESSION['id_div'],$_REQUEST['lab']);
		
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
    
?>

        <table class='material'>
		    <tr>
            <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Área</th> <?php }?>
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