<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<?php
session_start(); 
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
      <td align="center"><h2>Censo de Equipos de Alto Rendimiento</h2></td>
   </tr>
 
		<?php 
		
	$query=$censoxls->EquAR($_SESSION['tipo_usuario'],$_SESSION['id_div'],$_REQUEST['lab']);
		
    $datos = pg_query($con,$query);
    $inventario= pg_num_rows($datos); 
    ?>
    
    	 <table class='material' width=50%>
		 <tr>
             <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Área</th> <?php }?>
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
               
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%" scope="col"><?php echo ucwords(strtolower($lab_invent['descmarca']));?></td>
               <td width="20%" scope="col"><?php echo ucwords(strtolower($lab_invent['modelo_p']));?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['serie'];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['inventario'];?></td>
               <td width="20%" scope="col"><?php echo ucwords(strtolower($lab_invent['nombre_so']));?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['feche_factura'];?></td>
            </tr>
        </table>  
<?php 

    $cuenta=$cuenta+$lab_invent['cuenta'];      
  	
		} ?>
 
<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="20%" ><strong><?php echo $inventario . "  " . "Equipos";?></strong></td>
</tr>
</table>
 