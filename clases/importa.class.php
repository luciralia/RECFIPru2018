<?php

require_once(dirname(__FILE__).'/../lib/adodb5/adodb-active-record.inc.php');
require_once(dirname(__FILE__).'/class.conexion_db.php');
require_once('../conexion.php');

class importa{
	
	function importaError(){
	
	 $queryerror="SELECT * FROM errorinserta";
     $result = pg_query($queryerror) or die('Hubo un error con la base de datos');
								
   
 
		while ($disperror = pg_fetch_array($result, NULL,PGSQL_ASSOC)) 
		{ 
		
		   if ($disperror['columna1']==0) {?>
		       <tr><td> <?php echo 'La columna A,  <strong> clave_dispositivo </strong> del renglón  '.$disperror['tupla'] .' es obligatoria.'; ?></td></tr>
     <?php } ?>
	   <?php    if($disperror['columna1']==2) {?>
	 <tr><td> <?php echo 'La columna A,  <strong> clave_dispositivo </strong> del renglón  '.$disperror['tupla'] .' debe ser numérica, revisar catálogo correspondiente.'; ?></td></tr>
      <?php } ?>
      
	<?php if ($disperror['columna2']==0) {?>
		       <tr><td> <?php  echo 'La columna B, <strong> usuario_final_clave </strong> del renglón  '.$disperror['tupla'] .' es obligatoria.';?></td></tr>          	
	 <?php  }?>
     <?php    if($disperror['columna2']==2) {?>
	 <tr><td> <?php echo 'La columna B,  <strong>  usuario_final_clave </strong> del renglón  '.$disperror['tupla'] .' debe ser numérica, revisar catálogo correspondiente.'; ?></td></tr>
      <?php } ?>
      
     <?php if ($disperror['columna3']==0) { ?>
		       <tr><td> <?php echo 'La columna C, <strong> familia_clave </strong> del renglón '.$disperror['tupla'].' es obligatoria.';	?></td></tr>		
	 <?php } ?>
     <?php    if($disperror['columna3']==2) {?>
	 <tr><td> <?php echo 'La columna C,  <strong> familia_clave </strong> del renglón  '.$disperror['tupla'] .' debe ser numérica, revisar catálogo correspondiente.'; ?></td></tr>
      <?php } ?>
     
     <?php if ($disperror['columna4']==0)  {?>
		       <tr><td> <?php echo 'La columna D, <strong>tipo_ram_clave </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>		
	 <?php } ?>
     <?php if ($disperror['columna4']==2)  {?>
		       <tr><td> <?php echo 'La columna D, <strong>tipo_ram_clave </strong> del renglón '.$disperror['tupla'].' debe ser numérica, revisar catálogo correspondiente.'; ?></td></tr>		
	 <?php } ?>
     
     <?php if ($disperror['columna5']==0) { ?>
		      <tr><td> <?php echo 'La columna E, <strong> tecnologia_clave </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>				
	 <?php }  ?>
      <?php if ($disperror['columna5']==2) { ?>
		      <tr><td> <?php echo 'La columna E, <strong> tecnologia_clave </strong> del renglón '.$disperror['tupla'].' debe ser numérica, revisar catálogo correspondiente.'; ?></td></tr>				
	 <?php }  ?>
     
     <?php if ($disperror['columna6']==0) {?>
		      <tr><td> <?php echo 'La columna F, <strong> resguardo_nombre </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>				
	 <?php } if ($disperror['columna7']==0) { ?>
		      <tr><td> <?php echo 'La columna G, <strong> resguardo_no_empleado </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>		     
	  <?php }  if ($disperror['columna8']==0) {?>
		      <tr><td> <?php echo 'La columna H, <strong> usuario_nombre </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>	
     <?php }  if ($disperror['columna9']==0) {?>
		      <tr><td> <?php echo 'La columna I, <strong> usuario_ubicación </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>	 
            <?php }  ?>
			<?php  if ($disperror['columna10']==0) {?>
		      <tr><td> <?php echo 'La columna J, <strong> usuario_perfil </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>	      
			  <?php } ?>
            	<?php  if ($disperror['columna10']==2) {?>
		      <tr><td> <?php echo 'La columna J, <strong> usuario_perfil </strong> del renglón '.$disperror['tupla'].' debe ser numérica, revisar catálogo correspondiente.'; ?></td></tr>	      
			  <?php } ?>  
              
              <?php if ($disperror['columna11']==0) { ?>
		      <tr><td> <?php echo 'La columna K, <strong> usuario_sector </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>	      
			  <?php } ?>
               <?php if ($disperror['columna11']==2) { ?>
		      <tr><td> <?php echo 'La columna K, <strong> usuario_sector </strong> del renglón '.$disperror['tupla'].' debe ser numérica, revisar catálogo correspondiente.'; ?></td></tr>	      
			  <?php } ?>
              
			  <?php if ($disperror['columna13']==0) {?>
		      <tr><td> <?php echo 'La columna M, <strong> marca_p </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>	  	    	      <?php } if ($disperror['columna14']==0) { ?>
		      <tr><td> <?php echo 'La columna N, <strong> no_factura </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>	
      <?php }  if ($disperror['columna15']==0) { ?>
		      <tr><td> <?php echo 'La columna O, <strong> años garantía </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr> 
      <?php } if ($disperror['columna16']==0) { ?>
		      <tr><td> <?php echo 'La columna P, <strong> inventario </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>      
	  <?php } if ($disperror['columna17']==0) { ?>
		      <tr><td> <?php echo 'La columna Q, <strong> modelo_p </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr> 
      <?php } if ($disperror['columna18']==0) { ?>
		      <tr><td> <?php echo 'La columna R, <strong> proveedor_p </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>      
	  <?php } if ($disperror['columna19']==0) { ?>
		      <tr><td> <?php echo 'La columna S, <strong> fecha_factura </strong> del renglón '.$disperror['tupla'].' es obligatoria..'; ?></td></tr> 
      <?php }  if ($disperror['columna21']==0) { ?>
		      <tr><td> <?php echo 'La columna U, <strong> modelo_procesador </strong> del renglón '.$disperror['tupla'].' es obligatoria..'; ?></td></tr>     
               <?php } ?>
               <?php if ($disperror['columna22']==0) { ?>
		      <tr><td> <?php echo 'La columna V, <strong> cantidad_procesador </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>    
                <?php } ?>
               <?php if ($disperror['columna22']==2) { ?>
		      <tr><td> <?php echo 'La columna V, <strong> cantidad_procesador </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>    
                <?php } ?> 
                
                <?php if ($disperror['columna23']==0) { ?>
		      <tr><td> <?php echo 'La columna W, <strong> nucleos_totales </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr> 
      <?php } ?>
       <?php if ($disperror['columna23']==2) { ?>
		      <tr><td> <?php echo 'La columna W, <strong> nucleos_totales </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr> 
      <?php } ?>
      <?php if ($disperror['columna24']==0) { ?>
		      <tr><td> <?php echo 'La columna X, <strong> nucleos_GPU </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>      
	  <?php } ?>
       <?php if ($disperror['columna24']==2) { ?>
		      <tr><td> <?php echo 'La columna X, <strong> nucleos_GPU </strong> del renglón '.$disperror['tupla'].' debe ser numérica'; ?></td></tr>      
	  <?php } ?>
      <?php if ($disperror['columna25']==0) { ?>
		      <tr><td> <?php echo 'La columna Y, <strong> memoria_RAM </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>
      <?php  } ?>
      <?php if ($disperror['columna25']==2) { ?>
		      <tr><td> <?php echo 'La columna Y, <strong> memoria_RAM </strong> del renglón '.$disperror['tupla'].' debe ser numérica'; ?></td></tr>
      <?php  } ?>
      
      <?php if ($disperror['columna27']==0){ ?>
		      <tr><td> <?php echo 'La columna AA, <strong> num_elementos_almac </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>      
      <?php }  ?>
       <?php if ($disperror['columna27']==2){ ?>
		      <tr><td> <?php echo 'La columna AA, <strong> num_elementos_almac </strong> del renglón '.$disperror['tupla'].' debe ser numérica'; ?></td></tr>      
      <?php }  ?>
      <?php if ($disperror['columna28']==2){ ?>
		      <tr><td> <?php echo 'La columna AB, <strong> total_almac </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>      
      <?php }  ?>
      <?php if ($disperror['columna29']==0) { ?>
		      <tr><td> <?php echo 'La columna AC, <strong> num_arreglos </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr> 
      <?php } ?>
        <?php if ($disperror['columna29']==2) { ?>
		      <tr><td> <?php echo 'La columna AC, <strong> num_arreglos </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr> 
      <?php } ?>
      <?php if ($disperror['columna30']==0) { ?>
		      <tr><td> <?php echo 'La columna AD, <strong> esquema_uno </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>   
      <?php }  ?>
      <?php if ($disperror['columna30']==2) { ?>
		      <tr><td> <?php echo 'La columna AD, <strong> esquema_uno </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>   
      <?php }  ?>
      <?php if ($disperror['columna31']==0) { ?>
		      <tr><td> <?php echo 'La columna AE, <strong> esquema_dos </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>            
	   <?php } ?>
       <?php if ($disperror['columna31']==2) { ?>
		      <tr><td> <?php echo 'La columna AE, <strong> esquema_dos </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>            
	   <?php } ?>
       
       <?php if ($disperror['columna32']==0) { ?>
		      <tr><td> <?php echo 'La columna AF, <strong> esquema_tres </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>
      <?php } ?>
       <?php if ($disperror['columna32']==2) { ?>
		      <tr><td> <?php echo 'La columna AF, <strong> esquema_tres </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>
      <?php } ?>
      <?php if ($disperror['columna33']==0) { ?>
		      <tr><td> <?php echo 'La columna AG, <strong> esquema_cuatro </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>            
	 <?php } ?>
      <?php if ($disperror['columna33']==2) { ?>
		      <tr><td> <?php echo 'La columna AG, <strong> esquema_cuatro </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>            
	 <?php } ?>
     <?php if ($disperror['columna34']==0) { ?>
		      <tr><td> <?php echo 'La columna AH, <strong> tec_uno </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>
      <?php  } ?>
      <?php if ($disperror['columna34']==2) { ?>
		      <tr><td> <?php echo 'La columna AH, <strong> tec_uno </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?> </td></tr>
      <?php  } ?>
      <?php if ($disperror['columna35']==0) { ?>
		      <tr><td> <?php echo 'La columna AI, <strong> tec_dos </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>  
      <?php } ?>
      <?php if ($disperror['columna35']==2) { ?>
		      <tr><td> <?php echo 'La columna AI, <strong> tec_dos </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>  
      <?php } ?>
      <?php if ($disperror['columna36']==0) { ?>
		      <tr><td> <?php echo 'La columna AJ, <strong> tec_tres </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>   
      <?php }  ?>
       <?php if ($disperror['columna36']==2) { ?>
		      <tr><td> <?php echo 'La columna AJ, <strong> tec_tres </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>   
      <?php }  ?>
      <?php if ($disperror['columna37']==0) { ?>
		      <tr><td> <?php echo 'La columna AK, <strong> tec_cuatro </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>              
	<?php  } ?>
      <?php if ($disperror['columna37']==2) { ?>
		      <tr><td> <?php echo 'La columna AK, <strong> tec_cuatro </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>              
	<?php  } ?>
        <?php if ($disperror['columna38']==0) { ?>
		      <tr><td> <?php echo 'La columna AL, <strong> subtotal_uno </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>             <?php }  ?>
        <?php if ($disperror['columna38']==2) { ?>
		      <tr><td> <?php echo 'La columna AL, <strong> subtotal_uno </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>             <?php }  ?>      
        <?php if ($disperror['columna39']==0) { ?>
		      <tr><td> <?php echo 'La columna AM, <strong> subtotal_dos </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>  
      <?php  } ?>
        <?php if ($disperror['columna39']==2) { ?>
		      <tr><td> <?php echo 'La columna AM, <strong> subtotal_dos </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>  
      <?php  } ?>
      
      <?php if ($disperror['columna40']==0) {?>
		      <tr><td> <?php echo 'La columna AN, <strong> subtotal_tres </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>             <?php   } ?>
      <?php if ($disperror['columna40']==2) {?>
		      <tr><td> <?php echo 'La columna AN, <strong> subtotal_tres </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>            
        <?php   } ?>
                     
	  <?php	if ($disperror['columna41']==0) { ?>
		      <tr><td> <?php echo 'La columna AO, <strong> subtotal_cuatro </strong>del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>
      <?php } ?>
      <?php	if ($disperror['columna41']==2) { ?>
		      <tr><td> <?php echo 'La columna AO, <strong> subtotal_cuatro </strong>del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>
      <?php } ?>
      <?php if ($disperror['columna42']==0) { ?>
		      <tr><td> <?php echo 'La columna AP, <strong> arreglo_total </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>             <?php  } ?>
       <?php if ($disperror['columna42']==2) { ?>
		      <tr><td> <?php echo 'La columna AP, <strong> arreglo_total </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>             <?php  } ?>
                      
      <?php if ($disperror['columna43']==0) {?>
		      <tr><td> <?php echo 'La columna AQ, <strong> tec_com </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>   <?php }  ?>
      <?php if ($disperror['columna43']==2) {?>
		      <tr><td> <?php echo 'La columna AQ, <strong> tec_com </strong> del renglón '.$disperror['tupla'].' debe ser numérica, revisar el catálogo correspondiente.'; ?></td></tr> <?php }  ?> 
      
      <?php if ($disperror['columna45']==0) { ?>
		      <tr><td> <?php echo 'La columna AS, <strong> sist_oper </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr> <?php } ?>
         <?php if ($disperror['columna45']==2) { ?>
		      <tr><td> <?php echo 'La columna AS, <strong> sist_oper </strong> del renglón '.$disperror['tupla'].' debe ser numérica, revisar el catálogo correspondiente.'; ?></td></tr> <?php } ?>       
      <?php if ($disperror['columna46']==0) {?>
		      <tr><td> <?php echo 'La columna AT, <strong> version_sist_oper </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>
      <?php } ?>
      <?php if ($disperror['columna47']==0)  {?>
		      <tr><td> <?php echo 'La columna AU, <strong> licencia </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>      
	  <?php } ?>
       <?php if ($disperror['columna47']==2)  {?>
		      <tr><td> <?php echo 'La columna AU, <strong> licencia </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr> <?php } ?>
      <?php if ($disperror['columna48']==0) {?>
		      <tr><td> <?php echo 'La columna AV, <strong> licencia_ini </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>            
	  <?php } if ($disperror['columna49']==0) { ?>
		      <tr><td> <?php echo 'La columna AW, <strong> licencia_fin </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>     
        <?php } if ($disperror['columna50']==0) {?>
		      <tr><td> <?php echo 'La columna AX, <strong> id_edificio </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>      <?php } ?> 
             <?php if ($disperror['columna50']==2) {?>
		      <tr><td> <?php echo 'La columna AX, <strong> id_edificio </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>      <?php } ?>   
             <?php if ($disperror['columna51']==0){ ?>
		      <tr><td> <?php echo 'La columna AY, <strong> id_lab </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>            <?php  } ?>
             <?php if ($disperror['columna51']==2){ ?>
		      <tr><td> <?php echo 'La columna AY, <strong> id_lab </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>            <?php  } ?> 
            
		 <?php }//fin de while $disperro

        $querydt="DELETE FROM errorinserta";	
		$result = pg_query($querydt) or die('Hubo un error con la base de datos');
	}//finaliza Funcion importaError

}//finaliza clase importa

?>