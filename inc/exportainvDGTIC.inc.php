
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
session_start(); //Nueva linea
require_once('../conexion.php'); // nueva linea
require_once('../clases/exporta.class.php'); //Nueva linea

require_once('../clases/inventario.class.php');
$obj_xls=new Exportaxls(); // nueva linea
$esquema=new inventario();
$madq = new inventario();
$exhibe_mac=new Exportaxls(); 	
	

/*  este for es para cargar los datos de los renglones*/
//echo 'imprime la datos';
//print_r ($_POST);



date_default_timezone_set('America/Mexico_City');
header('Content-type: application/x-msexcel'); 
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );

if ($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==9 ) {
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
		   
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);

    $texto='Content-Disposition: attachment;filename="inventarioDGTICdiv_' . date("Ymd-His") . "_" . $nombdiv[0]. '.xls"';


 }elseif  ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']=='' ) 
   $texto='Content-Disposition: attachment;filename="inventarioDGTIC' . date("Ymd-His") . "_FacultadIngenieria.xls";
    elseif  ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!='' ) 
	{
		$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
		   
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);

    $texto='Content-Disposition: attachment;filename="inventarioDGTICdiv_' . date("Ymd-His") . "_" . $nombdiv[0]. '.xls"';}
	
header($texto);
?>

<table>
   <tr>
       <td align="center" ><h2>Inventario para DGTIC por División</h2></td>
   </tr>
  

</table>
  
  
<?php
	
	
			/*$renglon_mac=$exhibe_mac->rengReporteMac($lab_invent['inventario']);
			   
			    foreach ($renglon_mac as $reng) {
			      					
					
						echo "</br> CampoRep: ".$campo." valor: ".$valor."</br>";
						$registro[$campo]=$valor;*/
					
					   
			/*$mac1=$renglon_mac[0]['mac'];
			$mac2=$renglon_mac[1]['mac'];  
					
					
					echo 'imprime mac 1: ', $mac1;
				    
					echo 'imprime mac 2: ', $mac2;
						
					}*/
	
	
	
if (($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==9 ) && $_SESSION['id_div']!=''){
	
$query= "SELECT  e.*, 
         l.nombre as laboratorio, bi.*,* 
         FROM dispositivo e 
          JOIN cat_marca cm
         ON cm.id_marca=e.id_marca
         JOIN bienes_inventario bi
         ON  e.bn_id = bi.bn_id
         JOIN laboratorios l
         ON  l.id_lab=e.id_lab
         JOIN departamentos d
         ON d.id_dep=l.id_dep
         JOIN divisiones div
         ON div.id_div=d.id_div
		
		 LEFT JOIN impresora i
		 ON i.id_dispositivo=e.id_dispositivo
		 LEFT JOIN access ac
		 ON ac.id_dispositivo=e.id_dispositivo
		 
		 LEFT JOIN switch sw 
		 ON sw.id_dispositivo=e.id_dispositivo
		 LEFT JOIN digitaliza dg
		 ON dg.id_dispositivo=e.id_dispositivo
		 LEFT JOIN firewall fw
		 ON e.id_dispositivo=fw.id_dispositivo
		 LEFT JOIN ips 
		 ON e.id_dispositivo=ips.id_dispositivo
		 LEFT JOIN ids 
		 ON e.id_dispositivo=ids.id_dispositivo
         WHERE div.id_div=" . $_SESSION['id_div'] .
         "
          AND e.id_dispositivo>=2240
         ORDER BY laboratorio" ;
} elseif  ($_SESSION['tipo_usuario']==10  && $_SESSION['id_div']=='' ) {
	
$query= "SELECT  e.*, 
         l.nombre as laboratorio, bi.*,* 
         FROM dispositivo e 
          JOIN cat_marca cm
         ON cm.id_marca=e.id_marca
         JOIN bienes_inventario bi
         ON  e.bn_id = bi.bn_id
         JOIN laboratorios l
         ON  l.id_lab=e.id_lab
         JOIN departamentos d
         ON d.id_dep=l.id_dep
         JOIN divisiones div
         ON div.id_div=d.id_div
		 LEFT JOIN mac m
		 ON m.id_dispositivo=e.id_dispositivo
		 LEFT JOIN impresora i
		 ON i.id_dispositivo=e.id_dispositivo
		 LEFT JOIN access ac
		 ON ac.id_dispositivo=e.id_dispositivo
		 LEFT JOIN red_difunde rd
		 ON rd.id_dispositivo=e.id_dispositivo
		 LEFT JOIN switch sw 
		 ON sw.id_dispositivo=e.id_dispositivo
		 LEFT JOIN digitaliza dg
		 ON dg.id_dispositivo=e.id_dispositivo
		 LEFT JOIN firewall fw
		 ON e.id_dispositivo=fw.id_dispositivo
		 LEFT JOIN ips 
		 ON e.id_dispositivo=ips.id_dispositivo
		 LEFT JOIN ids 
		 ON e.id_dispositivo=ids.id_dispositivo
		 
         
         ORDER BY laboratorio" ;
}  elseif  ($_SESSION['tipo_usuario']==10  && $_SESSION['id_div']!='' ) {
	
	$query= "SELECT  e.*, 
         l.nombre as laboratorio, bi.*,* 
         FROM dispositivo e 
          JOIN cat_marca cm
         ON cm.id_marca=e.id_marca
         JOIN bienes_inventario bi
         ON  e.bn_id = bi.bn_id
         JOIN laboratorios l
         ON  l.id_lab=e.id_lab
         JOIN departamentos d
         ON d.id_dep=l.id_dep
         JOIN divisiones div
         ON div.id_div=d.id_div
		 LEFT JOIN mac m
		 ON m.id_dispositivo=e.id_dispositivo
		 LEFT JOIN impresora i
		 ON i.id_dispositivo=e.id_dispositivo
		 LEFT JOIN access ac
		 ON ac.id_dispositivo=e.id_dispositivo
		 LEFT JOIN red_difunde rd
		 ON rd.id_dispositivo=e.id_dispositivo
		 LEFT JOIN switch sw 
		 ON sw.id_dispositivo=e.id_dispositivo
		 LEFT JOIN digitaliza dg
		 ON dg.id_dispositivo=e.id_dispositivo
		 LEFT JOIN firewall fw
		 ON e.id_dispositivo=fw.id_dispositivo
		 LEFT JOIN ips 
		 ON e.id_dispositivo=ips.id_dispositivo
		 LEFT JOIN ids 
		 ON e.id_dispositivo=ids.id_dispositivo
         WHERE div.id_div=" . $_SESSION['id_div'] .
         "
        
         ORDER BY laboratorio" ;
}
 $datos = pg_query($con,$query);
 $inventario= pg_num_rows($datos); 

?>



  
<table border="1">

  <tr>
  
  
      <th scope="col">dispositivo_clave</th>
      <th scope="col">usuario_final_clave</th>
      <th scope="col">familia_clave</th>
      <th scope="col">tipo_ram_clave</th>
      <th scope="col">tecnologia_clave</th>
	  <th scope="col">resguardo_nombre</th>
      <th scope="col">resguardo_no_empleado</th>
      <th scope="col">usuario_nombre</th>
      <th scope="col">usuario_ubicación</th>
      <th scope="col">usuario_perfil</th>
      <th scope="col">usuario_sector</th>
      <th scope="col">no_servicio</th>
      <th scope="col">marca_p</th>
      <th scope="col">no_factura</th>
      <th scope="col">anios_garantía</th>
      <th scope="col">inventario</th>
      <th scope="col">modelo_p</th>
      <th scope="col">proveedor_p</th>
      <th scope="col">fecha_factura</th>
      <th scope="col">familia_especificar</th>
	  <th scope="col">modelo_procesador</th>
      <th scope="col">cantidad_procesador</th>
      <th scope="col">nucleos_totales</th>
      <th scope="col">nucleos_GPU</th>
      <th scope="col">memoria_RAM</th>
      <th scope="col">RAM_especificar</th>
      <th scope="col">num_elementos_almac</th>
      <th scope="col">total_almac</th>
      <th scope="col">num_arreglos</th>
      <th scope="col">esquema_uno</th>
      <th scope="col">esquema_dos</th>
	  <th scope="col">esquema_tres</th>
	  <th scope="col">esquema_cuatro</th>
	  <th scope="col">tec_uno</th>
	  <th scope="col">tec_dos</th>
	  <th scope="col">tec_tres</th>
	  <th scope="col">tec_cuatro</th>
	  <th scope="col">subtotal_uno</th>
	  <th scope="col">subtotal_dos</th>
	  <th scope="col">subtotal_tres</th>
	  <th scope="col">subtotal_cuatro</th>
	  <th scope="col">arreglo_total</th>
	  <th scope="col">tec_com</th>
	  <th scope="col">tec_com_otro</th>
	  <th scope="col">sist_oper</th>
	  <th scope="col">version_sist_oper</th>
	  <th scope="col">licencia</th>
      <th scope="col">licencia_ini</th> 
      <th scope="col">licencia_fin</th>
      <th scope="col">tipo_impresora</th>
	  <th scope="col">id_tipo_digitalizador</th>
	  <th scope="col">id_tipo_access_point</th>
	  <th scope="col">id_tipo_red1</th>
	  <th scope="col">id_tipo_red2</th>
	  <th scope="col">id_tipo_firewall</th>
	  <th scope="col">id_ids</th>
	  <th scope="col">id_ips</th>
	  <th scope="col">id_tipo_switch</th>
	  <th scope="col">id_puerto_switch</th>
	  <th scope="col">chasis_switch</th>
	  <th scope="col">estado_equipo</th>
	  <th scope="col">id_mod</th>
	  <th scope="col">mac1</th>
	  <th scope="col">mac2</th>
	  <th scope="col">id_edificio</th>
	  <th scope="col">id_lab</th>
	  
 </tr>
 
 
	
		
			
	<?php
	
	
   while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
	     $inventario= (string) $lab_invent['inventario'];
	    // echo 'imprime inventario cadena',$inventario; 
	
	   if ( $lab_invent['dispositivo_clave']>=1 && $lab_invent['dispositivo_clave']<=8)
		{
	    $query="SELECT e.id_dispositivo,id_disp_mac,mac FROM dispositivo e
		           LEFT JOIN mac m
		           ON m.id_dispositivo=e.id_dispositivo
		           WHERE inventario="."'".$lab_invent['inventario']."'";
	       
		   $result= pg_query($query) or die('Hubo un error con la base de datos');
           $arreglo= pg_fetch_array($result);
		   $cuenta= pg_num_rows($result);	
		  	
		   $id_disp_mac=$arreglo[1];
			$mac1=$arreglo[2];
		    $mac2=NULL;
		 
	       if ($cuenta==1)	{
		
		     $mac1=$arreglo[2];
			 $mac2=NULL;
				
			} else if($cuenta==2) {
		
		     $id_mac=$id_disp_mac+1;
		     $query="SELECT e.id_dispositivo,id_disp_mac,mac FROM dispositivo e
		         LEFT JOIN mac m
		         ON m.id_dispositivo=e.id_dispositivo
		         WHERE id_disp_mac= ". $id_mac . "
				 AND  inventario="."'".$lab_invent['inventario']."'";
		    // echo $query;
	       
		   $result= pg_query($query) or die('Hubo un error con la base de datos');
           $arreglo= pg_fetch_array($result);
		   $cuenta= pg_num_rows($result);	
		
		  $mac2=$arreglo[2];
		  //echo 'imprime mac',$mac2; 
			 
		   }
				
	   }
	   
	   if ( $lab_invent['dispositivo_clave']==14)
		   {
	       $query="SELECT e.id_dispositivo,id_access,id_tipo_red FROM dispositivo e
                   LEFT JOIN access a
                   ON a.id_dispositivo=e.id_dispositivo
                   LEFT JOIN red_difunde rd
                   ON rd.id_dispositivo=e.id_dispositivo
                   WHERE inventario="."'".$lab_invent['inventario']."'";
	       
		   $result= pg_query($query) or die('Hubo un error con la base de datos');
           $arreglo= pg_fetch_array($result);
		   $cuenta= pg_num_rows($result);	
		  	
		   $id_tipo_red=$arreglo[2];
		   $red1=$arreglo[2];
		   $red2=NULL;
		 
	       if ($cuenta==1)	{
		     $red1=$arreglo[2];
			 $red2=NULL;
			} else if($cuenta==2) {
		       $id_red=$id_tipo_red+1;
		       $query="SELECT e.id_dispositivo,id_access,id_tipo_red FROM dispositivo e
                   LEFT JOIN access a
                   ON a.id_dispositivo=e.id_dispositivo
                   LEFT JOIN red_difunde rd
                   ON rd.id_dispositivo=e.id_dispositivo
                   WHERE id_tipo_red= ". $id_red . "
		           AND  inventario="."'".$lab_invent['inventario']."'";
		    // echo $query;
	       
		      $result= pg_query($query) or die('Hubo un error con la base de datos');
              $arreglo= pg_fetch_array($result);
		      $cuenta= pg_num_rows($result);	
		      $red2=$arreglo[2];
		  //echo 'imprime mac',$mac2; 
		   }
		}
	
	?>
        
	
	 
<table border="1">
	

		
  <tr>
  
   
      <td><?php echo $lab_invent['dispositivo_clave'];?></td>
      <td><?php echo $lab_invent['usuario_final_clave'];?></td>
      <td><?php echo $lab_invent['familia_clave'];?></td>
      <td><?php echo $lab_invent['tipo_ram_clave'];?></td>
      <td><?php echo $lab_invent['tecnologia_clave'];?></td>
      <td><?php echo $lab_invent['nombre_resguardo'];?></td>  
      <td><?php echo $lab_invent['resguardo_no_empleado'];?></td>
      <td><?php echo $lab_invent['usuario_nombre'];?></td>
      <td><?php echo $lab_invent['usuario_ubicacion'];?></td> 
      <td><?php echo $lab_invent['usuario_perfil'];?></td> 
      <td><?php echo $lab_invent['usuario_sector'];?></td> 
      <td><?php echo $lab_invent['serie'];?></td>
      <td><?php echo $lab_invent['marca_p'];?></td>
      <td><?php echo $lab_invent['no_factura'];?></td>
      <td><?php echo $lab_invent['anos_garantia'];?></td>
      <td><?php echo $inventario;?></td>
      <td><?php echo $lab_invent['modelo_p'];?></td>
      <td><?php echo $lab_invent['proveedor_p'];?></td>
      <td><?php echo $lab_invent['fecha_factura'];?></td><!-- echo date("d-m-Y", strtotime($lab_invent['fecha_factura']));-->
      <td><?php echo $lab_invent['familia_especificar'];?></td>
      <td><?php echo $lab_invent['modelo_procesador'];?></td>
      <td><?php echo $lab_invent['cantidad_procesador'];?></td>
      <td><?php echo $lab_invent['nucleos_totales'];?></td>
      <td><?php echo $lab_invent['nucleos_gpu'];?></td>
      <td><?php echo $lab_invent['memoria_ram'];?></td>
      <td><?php echo $lab_invent['ram_especificar'];?></td>
      <td><?php echo $lab_invent['num_elementos_almac'];?></td>
      <td><?php echo $lab_invent['total_almac'];?></td>
      <td><?php echo $lab_invent['num_arreglos'];?></td>
	  <td><?php echo $lab_invent['esquema_uno'];?></td>
	  <td><?php echo $lab_invent['esquema_dos'];?></td>
      <td><?php echo $lab_invent['esquema_tres'];?></td>
      <td><?php echo $lab_invent['esquema_cuatro'];?></td>
	  <td><?php echo $lab_invent['tec_uno'];?></td>
	  <td><?php echo $lab_invent['tec_dos'];?></td>
	  <td><?php echo $lab_invent['tec_tres'];?></td>
	  <td><?php echo $lab_invent['tec_cuatro'];?></td>
	  <td><?php echo $lab_invent['subtotal_uno'];?></td>
	  <td><?php echo $lab_invent['subtotal_dos'];?></td>
	  <td><?php echo $lab_invent['subtotal_tres'];?></td>
	  <td><?php echo $lab_invent['subtotal_cuatro'];?></td>
	  <td><?php echo $lab_invent['arreglo_total'];?></td>
	  <td><?php echo $lab_invent['tec_com'];?></td>
	  <td><?php echo $lab_invent['tec_com_otro'];?></td>
	  <td><?php echo $lab_invent['sist_oper'];?></td>
	  <td><?php echo $lab_invent['version_sist_oper'];?></td>
	  <td><?php echo $lab_invent['licencia'];?></td>
	  <td><?php echo $lab_invent['licencia_ini'];?></td>
	  <td><?php echo $lab_invent['licencia_fin'];?></td>
	  <td><?php echo $lab_invent['id_impresora'];?></td>
	  <td><?php echo $lab_invent['id_digitaliza'];?></td>
	  <td><?php echo $lab_invent['id_access'];?></td>
	  <td><?php echo $red1;?></td>
	  <td><?php echo $red2;?></td>
	  <td><?php echo $lab_invent['id_firewall'];?></td>
	  <td><?php echo $lab_invent['id_ids'];?></td>
	  <td><?php echo $lab_invent['id_ips'];?></td>
	  <td><?php echo $lab_invent['id_tipo_switch'];?></td>
	  <td><?php echo $lab_invent['id_puerto'];?></td>
	  <td><?php echo $lab_invent['id_chasis'];?></td>
	  <td><?php echo $lab_invent['estado_equipo'];?></td>
	  <td><?php echo $lab_invent['id_mod'];?></td>
	  <td><?php echo $mac1;?></td>
	  <td><?php echo $mac2;?></td>  
	  <td><?php echo $lab_invent['id_edif'];?></td>
	  <td><?php echo $lab_invent['id_lab'];?></td>
	 
	  
	</tr>
	   
 
  
 
 
		
		
<?php
	   $mac1=NULL;
	    $mac2=NULL;
	    $red1=NULL;
	    $red2=NULL;
   } //fin de while ?>
</table>


