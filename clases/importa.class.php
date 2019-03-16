<?php

require_once('../conexion.php');

//require_once('../inc/sesion.inc.php');

class importa{

function marcaError(&$datosdec){ 
         $noo++;
         $regexFecha = '/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/';
         //echo'Valores de entrada marca error';
         //print_r($datosdec);
		 
          $inventario=$datosdec[15];
		  $dispclave=$datosdec[0];

        if ($datosdec[0]==NULL) { $columna1=0;?>
	           <legend align="left"><?php echo 'La columna A,  <strong> clave_dispositivo </strong> del renglón correpondiente al no.inventario '.$datosdec[15] .' es obligatoria.'; ?></legend>
     <?php } 
	    if(!preg_match("/^[0-9]+$/",$datosdec[0])) { $columna1=2;?>
	<legend align="left"><?php echo 'La columna A,  <strong> clave_dispositivo </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend><?php }else $columna1=1; ?>
      
	<?php if ($datosdec[1]==NULL) { $columna2=0;?>
		      <legend align="left"><?php echo 'La columna B, <strong> usuario_final_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.';?></legend>     	
	 <?php  }	 
	    if(!preg_match("/^[0-9]+$/",$datosdec[1])){ $columna2=2;?>
	<legend align="left"><?php  echo 'La columna B,  <strong>  usuario_final_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>
      <?php } else $columna2=1;
   if ($datosdec[2]==NULL) { $columna3=0;?>
		     <legend align="left"><?php echo 'La columna C, <strong> familia_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.';	?></legend>
	 <?php } 
        if(!preg_match("/^[0-9]+$/",$datosdec[2])) { $columna3=2;?>
	<legend align="left"><?php echo 'La columna C,  <strong> familia_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>
      <?php } else $columna3=1;

	  if ($datosdec[3]==NULL) { $columna4=0; ?>
		      <legend align="left"><?php echo 'La columna D, <strong> tipo_ram_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.'; ?></legend>
	 <?php } ?>
     <?php if (!preg_match("/^[0-9]+$/",$datosdec[3]))  { $columna4=2;?>
		     <legend align="left"><?php echo 'La columna D, <strong>tipo_ram_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>	
	 <?php }  else $columna4=1;?>
     <?php if ($datosdec[4]==NULL) { 
	            $columna5=0;?>
		    <legend align="left"><?php echo 'La columna E, <strong> tecnologia_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.'; ?></legend>
	 <?php }  ?>
      <?php if (!preg_match("/^[0-9]+$/",$datosdec[4])) { 
	            $columna5=2;?>
		      <legend align="left"><?php echo 'La columna E, <strong> tecnologia_clave </strong>del renglón correpondiente al no.inventario  '.$datosdec[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>			
	 <?php } else $columna5=1;?> 
    
     <?php if ($datosdec[5]==NULL) {
		       $columna6=0;?>
		       <legend align="left"><?php echo 'La columna F, <strong> resguardo_nombre </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.'; ?></legend>	
      <?php   } elseif(is_int($datosdec[5])) $columna6=1; else $columna6=2;       			
	if ($datosdec[6]==NULL) { $columna7=0;?>
		      <legend align="left"><?php echo 'La columna G, <strong> resguardo_no_empleado </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.'; ?></legend>	     
	  <?php } elseif(is_int($datosdec[6])) $columna7=1; else $columna7=2;  ?>
       <?php  if ($datosdec[7]==NULL) { $columna8=0;?>
		      <legend align="left"><?php echo 'La columna H, <strong> usuario_nombre </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.'; ?></legend>
     <?php } elseif(is_int($datosdec[7])) $columna8=1; else $columna8=2; 
	  if ($datosdec[8]==NULL) { $columna9=0;?>
		     <legend align="left"><?php echo 'La columna I, <strong> usuario_ubicación </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.'; ?></legend>
            <?php }  elseif(is_int($datosdec[8])) $columna9=1; else $columna9=2; 
			 if($datosdec[9]==NULL) { $columna10=0;?>
		     <legend align="left"><?php echo 'La columna J, <strong> usuario_perfil </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.'; ?></legend>      
			  <?php } ?>
             <?php  if(!preg_match("/^[0-9]+$/",$datosdec[9])) { $columna10=2;?>
		      <legend align="left"><?php echo 'La columna J, <strong> usuario_perfil </strong>del renglón correpondiente al no.inventario  '.$datosdec[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>   <?php } else $columna10=1;?>  
              
              <?php if ($datosdec[10]==NULL) { $columna11=0;?>
		       <legend align="left"><?php echo 'La columna K, <strong> usuario_sector </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.'; ?></legend>	      
			  <?php } ?>
               <?php if (!preg_match("/^[0-9]+$/",$datosdec[10])) { $columna11=2; ?>
		     <legend align="left"><?php echo 'La columna K, <strong> usuario_sector </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>   <?php } else $columna11=1;?>   
             <?php if ($datosdec[11]==NULL) { $columna12=0;?>
		     <legend align="left"><?php //echo 'La columna L, <strong> no servicio </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
			<?php } ?>
		   <?php if ($datosdec[12]==NULL) { $columna13=0;?>
		     <legend align="left"><?php echo 'La columna M, <strong> marca_p </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
			<?php } elseif(is_int($datosdec[12])) $columna13=1; else $columna13=2; 
			if ($datosdec[13]==NULL) { $columna14=0; ?>
		      <legend align="left"><?php echo 'La columna N, <strong> no_factura </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php }  elseif(is_int($datosdec[13])) $columna14=1; else $columna14=2; 
	  if ($datosdec[14]==NULL) { $columna15=0;?>
		      <legend align="left"><?php echo 'La columna O, <strong> años garantía </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php } elseif(is_int($datosdec[14])) $columna15=1; else $columna15=2; 
	  if ($datosdec[15]==NULL) { $columna16=0;?>
		     <legend align="left"><?php echo 'La columna P, <strong> inventario </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
	  <?php } elseif(is_int($datosdec[15])) $columna16=1; else $columna16=2; 
	  if ($datosdec[16]==NULL) { $columna17=0;?>
		     <legend align="left"><?php echo 'La columna Q, <strong> modelo_p </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php } elseif(is_int($datosdec[16])) $columna17=1; else $columna17=2; 
	  if ($datosdec[17]==NULL) { $columna18=0;?>
		     <legend align="left"><?php echo 'La columna R, <strong> proveedor_p </strong>del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>  
	  <?php } elseif(is_int($datosdec[17])) $columna18=1; else $columna18=2; 
	  if ($datosdec[18]==NULL) { $columna19=0;?>
		     <legend align="left"> <?php echo 'La columna S, <strong> fecha_factura </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria..'; ?></legend>
            
      <?php } elseif(!preg_match($regexFecha,$datosdec[18])) $columna19=2; else $columna19=3;
      if ($datosdec[18]==NULL) { $columna19=2;?>
		     <legend align="left"><?php echo 'El formato de fecha de la columna S, <strong> fecha_factura </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es incorrecto.'; ?></legend>
      <?php } ?>
	  <?php if ($datosdec[20]==NULL) { $columna21=0;?>
		     <legend align="left"><?php echo 'La columna U, <strong> modelo_procesador </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>     
               <?php } elseif(is_int($datosdec[20])) $columna21=1; else $columna21=2;  ?>
               <?php if ($datosdec[21]==NULL) { $columna22=0;?>
		      <legend align="left"> <?php echo 'La columna V, <strong> cantidad_procesador </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend> 
                <?php } ?>
               <?php if (!preg_match("/^[0-9]+$/",$datosdec[21])) { $columna22=2;?>
		     <legend align="left"> <?php echo 'La columna V, <strong> cantidad_procesador </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
                <?php } else $columna22=1;?> 
                <?php if ($datosdec[22]==NULL) { $columna23=0;?>
		     <legend align="left"> <?php echo 'La columna W, <strong> nucleos_totales </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
            <?php } ?>
              <?php if (!preg_match("/^[0-9]+$/",$datosdec[22]))  { $columna23=2;?>
		     <legend align="left"> <?php echo 'La columna W, <strong> nucleos_totales </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
      <?php }  else $columna23=1;?>
      <?php if ($datosdec[23]==NULL) { $columna24=0;?>
		      <legend align="left"><?php echo 'La columna X, <strong> nucleos_GPU </strong>del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
	  <?php } ?>
        <?php if (!preg_match("/^[0-9]+$/",$datosdec[23]))  { $columna24=2;?>
		     <legend align="left"><?php echo 'La columna X, <strong> nucleos_GPU </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica'; ?></legend>
	  <?php } else $columna24=1;?>
      <?php if ($datosdec[24]==NULL) { $columna25=0;?>
		      <legend align="left"><?php echo 'La columna Y, <strong> memoria_RAM </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php  } elseif(is_int($datosdec[24])) $columna25=1; else $columna25=2; 
      if (!preg_match("/^[0-9]+$/",$datosdec[24])) { ?>
		     <legend align="left"> <?php //echo 'La columna Y, <strong> memoria_RAM </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica'; ?></legend>
      <?php //  } ?>
      
		     <legend align="left"><?php echo 'La columna R, <strong> proveedor_p </strong>del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>  
	  <?php } elseif(is_int($datosdec[17])) $columna18=1; else $columna18=2; 
	 
      if ($datosdec[26]==NULL) { $columna27=0;?>
		      <legend align="left"><?php echo 'La columna AA, <strong> num_elementos_almac </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php }elseif(is_int($datosdec[26])) $columna27=1; else $columna27=2; 
		      
     
       if (!preg_match("/^[0-9]+$/",$datosdec[27])){ $columna28=2;?>
		      <legend align="left"> <?php echo 'La columna AB, <strong> total_almac </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
      <?php }  else $columna28=1; ?>
      <?php if ($datosdec[28]==NULL) { $columna29=0;?>
		       <legend align="left"><?php echo 'La columna AC, <strong> num_arreglos </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php } ?>
        <?php if (!preg_match("/^[0-9]+$/",$datosdec[28])){ $columna29=2;?>
		  <legend align="left"><?php echo 'La columna AC, <strong> num_arreglos </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
      <?php } else $columna29=1;?>
      <?php if ($datosdec[29]==NULL) { $columna30=0;?>
		      <legend align="left"><?php echo 'La columna AD, <strong> esquema_uno </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php }  ?>
      <?php if (!preg_match("/^[0-9]+$/",$datosdec[29])){ $columna30=2;?>
		     <legend align="left"><?php echo 'La columna AD, <strong> esquema_uno </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
      <?php }  else $columna30=1; ?>
      <?php if ($datosdec[30]==NULL) { $columna31=0;?>
		      <legend align="left"><?php echo 'La columna AE, <strong> esquema_dos </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
	   <?php } ?>
        <?php if (!preg_match("/^[0-9]+$/",$datosdec[30])){ $columna31=2;?>
		      <legend align="left"> <?php echo 'La columna AE, <strong> esquema_dos </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>         
	   <?php } else $columna31=1; ?>
       <?php if ($datosdec[31]==NULL) { $columna32=0;?>
		      <legend align="left"> <?php echo 'La columna AF, <strong> esquema_tres </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php } ?>
      <?php if (!preg_match("/^[0-9]+$/",$datosdec[31])){ $columna32=2;?>
		      <legend align="left">  <?php echo 'La columna AF, <strong> esquema_tres </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
      <?php } else $columna32=1; ?>
      <?php if ($datosdec[32]==NULL) { $columna33=0;?>
		      <legend align="left"><?php echo 'La columna AG, <strong> esquema_cuatro </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>           
	 <?php } ?>
      <?php if (!preg_match("/^[0-9]+$/",$datosdec[32])){ $columna33=2;?>
		     <legend align="left"> <?php echo 'La columna AG, <strong> esquema_cuatro </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
	 <?php } else $columna33=1; ?>
     <?php if ($datosdec[33]==NULL) { $columna34=0;?>
		     <legend align="left"><?php echo 'La columna AH, <strong> tec_uno </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php  } if (!preg_match("/^[0-9]+$/",$datosdec[33])){ $columna34=2;?>
		       <legend align="left"> <?php echo 'La columna AH, <strong> tec_uno </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend> 
      <?php  } else $columna34=1; ?>
      <?php if ($datosdec[34]==NULL) { $columna35=0;?>
		      <legend align="left"> <?php echo 'La columna AI, <strong> tec_dos </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php } ?>
    <?php if (!preg_match("/^[0-9]+$/",$datosdec[34])){ $columna35=2;?>
		    <legend align="left"> <?php echo 'La columna AI, <strong> tec_dos </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
      <?php } else $columna35=1; ?>
      <?php if ($datosdec[35]==NULL) { $columna36=0;?>
		     <legend align="left">  <?php echo 'La columna AJ, <strong> tec_tres </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend> 
      <?php }  ?>
       <?php if (!preg_match("/^[0-9]+$/",$datosdec[35])){ $columna36=2;?>
		      <legend align="left"> <?php echo 'La columna AJ, <strong> tec_tres </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>   
      <?php } else $columna36=1; ?> 
      <?php if ($datosdec[36]==NULL) { $columna37=0;?>
		     <legend align="left"><?php echo 'La columna AK, <strong> tec_cuatro </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
	<?php  } ?>
      <?php if (!preg_match("/^[0-9]+$/",$datosdec[36])){ $columna37=2;?>
		      <legend align="left">  <?php echo 'La columna AK, <strong> tec_cuatro </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>              
	<?php  } else $columna37=1; ?>
        <?php if ($datosdec[37]==NULL) { $columna38=0;?>
		      <legend align="left"> <?php echo 'La columna AL, <strong> subtotal_uno </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
                   <?php }  ?>
         <?php if (!preg_match("/^[0-9]+$/",$datosdec[37])){ $columna38=2;?>
		     <legend align="left"> <?php echo 'La columna AL, <strong> subtotal_uno </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>             
			 <?php } else $columna38=1; ?>      
         <?php if ($datosdec[38]==NULL) { $columna39=0;?>
		      <legend align="left"> <?php echo 'La columna AM, <strong> subtotal_dos </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php  } ?>
        <?php if (!preg_match("/^[0-9]+$/",$datosdec[38])){ $columna39=2;?>
		      <legend align="left"> <?php echo 'La columna AM, <strong> subtotal_dos </strong> ddel renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
      <?php  } else $columna39=1; ?> 
      
      <?php if ($datosdec[39]==NULL) { $columna40=0;?>
		       <legend align="left"> <?php echo 'La columna AN, <strong> subtotal_tres </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>            <?php   } ?>
      <?php if (!preg_match("/^[0-9]+$/",$datosdec[39])){ $columna40=2;?>
		     <legend align="left"><?php echo 'La columna AN, <strong> subtotal_tres </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>          
        <?php   } else $columna40=1; ?> 
                     
	  <?php if ($datosdec[40]==NULL) { $columna41=0;?>
		      <legend align="left"> <?php echo 'La columna AO, <strong> subtotal_cuatro </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php } ?>
      <?php if (!preg_match("/^[0-9]+$/",$datosdec[40])){ $columna41=2;?>
		      <legend align="left"> <?php echo 'La columna AO, <strong> subtotal_cuatro </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
      <?php } else $columna41=1; ?>
      <?php if ($datosdec[41]==NULL) { $columna42=0;?>
		  <legend align="left"> <?php echo 'La columna AP, <strong> arreglo_total </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>          <?php  } ?>
       <?php if (!preg_match("/^[0-9]+$/",$datosdec[41])){ $columna42=2;?>
		     <legend align="left"> <?php echo 'La columna AP, <strong> arreglo_total </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>            
         <?php  }else $columna42=1; ?>  
                      
       <?php if ($datosdec[42]==NULL) { $columna43=0;?>
		     <legend align="left"> <?php echo 'La columna AQ, <strong> tec_com </strong>  del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend> 
        <?php }  ?>
      <?php if (!preg_match("/^[0-9]+$/",$datosdec[42])){ $columna43=2;?>
		     <legend align="left"> <?php echo 'La columna AQ, <strong> tec_com </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica, revisar el catálogo correspondiente.'; ?></legend><?php } else $columna43=1; ?>  
      
       <?php if ($datosdec[44]==NULL) { $columna45=0;?>
		       <legend align="left"> <?php echo 'La columna AS, <strong> sist_oper </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend> <?php } ?>
         <?php if (!preg_match("/^[0-9]+$/",$datosdec[44])){ $columna45=2;?>
		     <legend align="left"><?php echo 'La columna AS, <strong> sist_oper </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica, revisar el catálogo correspondiente.'; ?></legend> <?php } else $columna45=1; ?>        
      <?php if ($datosdec[45]==NULL) { $columna46=0;?>
		     <legend align="left"> <?php echo 'La columna AT, <strong> version_sist_oper </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php } elseif(is_int($datosdec[45])) $columna46=1; else $columna46=2; 
        if ($datosdec[46]==NULL) { $columna47=0;?>
		      <legend align="left"><?php echo 'La columna AU, <strong> licencia </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
	  <?php } ?>
      
        <?php if (!preg_match("/^[0-9]+$/",$datosdec[46])){ $columna47=2;?>
		     <legend align="left"> <?php echo 'La columna AU, <strong> licencia </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
			 <?php } else $columna47=1;  ?>
       <?php if ($datosdec[47]==NULL) { $columna48=0;?>
		      <legend align="left"><?php echo 'La columna AV, <strong> licencia_ini </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>            
	  <?php } ?>
      <?php if (!preg_match("/^[0-9]+$/",$datosdec[47])){ $columna48=2;?>
		     <legend align="left"> <?php echo 'El formato de fecha de la columna AV, <strong> licencia_ini </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es incorrecto.'; ?></legend>
      <?php }  else $columna48=1; ?>
      <?php if ($datosdec[48]==NULL) { $columna49=0;?>
		      <legend align="left">  <?php echo 'La columna AW, <strong> licencia_fin </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
        <?php } elseif(!preg_match($regexFecha,$datosdec[48])) { $columna49=2; ?>
		     <legend align="left"><?php echo 'El formato de fecha de la columna AW, <strong> licencia_fin </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es incorrecto.'; ?></legend>
        <?php } else $columna49=3;?>
         <?php if ($datosdec[49]==NULL) { $columna50=0;?>
		       <legend align="left"> <?php echo 'La columna AX, <strong> id_edificio </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>  
			<?php } ?> 
              <?php if (!preg_match("/^[0-9]+$/",$datosdec[49])){ $columna50=2;?>
		      <legend align="left"> <?php echo 'La columna AX, <strong> id_edificio </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>    
              
               <?php } else $columna50=1; ?>  
               
             <?php if ($datosdec[50]==NULL) { $columna51=0;?>
		      <legend align="left"> <?php echo 'La columna AY, <strong> id_lab </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>        
             <?php }elseif(is_int( $datosdec[50])) $columna51=1; else $columna51=2; ?>
		      <legend align="left"> <?php //echo 'La columna AY, <strong> id_lab </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend>         <?php // } ?> 
            <?php // if ($disperror['columna51']==4){ ?>
		    <legend align="left"> <?php //echo 'Revisar la columna AY, <strong>id_lab</strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].'. <strong> El área no existe para está división </strong>'; ?></legend> <?php  //} ?>
                <?php //if ($disperror['columna51']==6){ ?>
		      <legend align="left"> <?php //echo 'Revisar la columna AY, <strong>id_lab</strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].'. <strong> se ingresó con cero y no se pudo localizar el dispositivo </strong>'; ?></legend><?php // } ?>
              <?php //if ($disperror['columna51']==5){ ?>
		      <legend align="left"> <?php //echo 'La columna AY, <strong>id_lab</strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].'. <strong> se ingresó con cero aún así se localizó el dispositivo y se registró.</strong>'; ?></legend>><?php // } 
		
          //Traer el último valor en errorinserta
			        $queryd="SELECT max(id_error) FROM errorinserta";
                   // $registrod= pg_query($con,$queryd);
				    $registrod= pg_query($queryd) or die('Hubo un error con la base de datosdec');
                    $ultimo= pg_fetch_array($registrod);
	
		      if ($ultimo[0]==0)
				    $ultimo=1;//inicializando la tabla dispositivouno
			  else 
			        $ultimo=$ultimo[0]+1;
	   
	         $query= "INSERT INTO errorinserta(id_error,tupla,inventario,dispositivo_clave,columna1,columna2,columna3,columna4,columna5,
	                                     columna6,columna7,columna8,columna9,columna10,
	                                     columna11,columna12,columna13,columna14,columna15,
										 columna16,columna17,columna18,columna19,columna20,
										 columna21,columna22,columna23,columna24,columna25,
										 columna26,columna27,columna28,columna29,columna30,
										 columna31,columna32,columna33,columna34,columna35,
										 columna36,columna37,columna38,columna39,columna40,
										 columna41,columna42,columna43,columna44,columna45,
										 columna46,columna47,columna48,columna49,columna50,
										 columna51) VALUES 
										 ($ultimo,$noo,'$inventario',$dispclave,$columna1,$columna2,$columna3,$columna4,$columna5,
										 $columna6,$columna7,$columna8,$columna9,$columna10,
	                                     $columna11,NULL,$columna13,$columna14,$columna15,
										 $columna16,$columna17,$columna18,$columna19,NULL,
										 $columna21,$columna22,$columna23,$columna24,$columna25,
										 NULL,$columna27,NULL,$columna29,$columna30,
										 $columna31,$columna32,$columna33,$columna34,$columna35,
										 $columna36,$columna37,$columna38,$columna39,$columna40,
										 $columna41,$columna42,$columna43,NULL,$columna45,
										 $columna46,$columna47,$columna48,$columna49,$columna50,
							 $columna51 )";
		
		//echo $query;
	   $result=@pg_query($query) or die('ERROR AL INSERTAR en errorinserta'); 

	 
	
         
       } //fin marcaerror

function exportaErrorReg(){
	//Exporta  errores de datos en las columnas  
		/* $queryreg=" SELECT inventario,dispositivo_clave FROM errorinserta 
	                 EXCEPT
                     SELECT ei.inventario,dispositivo_clave FROM errorinserta ei
                     JOIN registroerror re
                     ON ei.inventario=re.inventario
                     WHERE tipoerror='b'";*/
					 
			$queryreg="SELECT * FROM errorinserta 
	               WHERE 
				(columna1!=2 AND columna2!=2 AND columna3!=2 AND columna4!=2 
				AND  columna10!=2 AND columna11!=2 
				AND columna25!=2 AND columna28!=2
				AND columna30!=2 AND columna31!=2
			    AND columna32!=2 AND columna33!=2 AND columna34!=2 AND columna35!=2
				AND columna36!=2 AND columna37!=2 AND columna45!=2
				AND columna51!=2)";
					 
	    $result = pg_query($queryreg) or die('Hubo un error con la base de datos');
	    $errorreg= pg_num_rows($result); 
					
	
		while ($disperror = pg_fetch_array($result, NULL,PGSQL_ASSOC)) {
			
			        $queryd="SELECT max(id_error) FROM registroerror";
                    $registrod= pg_query($queryd) or die('Hubo un error con la base de datos');
                    $ultimo= pg_fetch_array($registrod);
	
		         if ($ultimo[0]==0)
				    $ultimo=1;
			     else 
			        $ultimo=$ultimo[0]+1;
		   
		          $querybien="INSERT INTO registroerror(id_error,inventario,clave_dispositivo,fecharegistro,id_div,tipoerror)
			                         VALUES (%d,'%s',%d,'%s',%d,'%s')";
						   
			      $queryerror=sprintf($querybien,$ultimo,$disperror['inventario'],$disperror['dispositivo_clave'],date('Y-m-d H:i:s'),$_SESSION['id_div'],'r' );
			   			 
			      $registroerror= pg_query($queryerror)or die('Hubo un error con la base de datos');
		
			
	    	}//fin while guarad errores
		?>
        
         <br>
           <legend align="left"> <h4><?php echo "Se intentaron registrar  " . $errorreg ." dispositivos que no cumplen con los requisitos. " ?></h4></legend> 
   
           <br>
                <form action="../inc/erroresreg.inc.php" method="post" name="erroresreg" >
	               <legend align="left"><input name="enviar" type="submit" value="Exportar a Excel" /></legend>
	            </form>
           <br>
	<?php   
	} //finaliza funcion exportaErrorReg
	
function exportaErrorRegAct(){
	//Exporta  errores de datos en las columnas  
		
					 
			$queryreg="SELECT * FROM errorinserta 
	               WHERE 
				(columna1!=2 AND columna2!=2 AND columna3!=2 AND columna4!=2 
				AND  columna10!=2 AND columna11!=2 
				
				AND columna30!=2 AND columna31!=2
			    AND columna32!=2 AND columna33!=2 AND columna34!=2 AND columna35!=2
				AND columna36!=2 AND columna37!=2 AND columna45!=2
				AND columna51!=2)";
					 
	    $result = pg_query($queryreg) or die('Hubo un error con la base de datos');
	    $errorreg= pg_num_rows($result); 
					
	
		while ($disperror = pg_fetch_array($result, NULL,PGSQL_ASSOC)) {
			
			        $queryd="SELECT max(id_error) FROM registroerror";
                    $registrod= pg_query($queryd) or die('Hubo un error con la base de datos');
                    $ultimo= pg_fetch_array($registrod);
	
		         if ($ultimo[0]==0)
				    $ultimo=1;
			     else 
			        $ultimo=$ultimo[0]+1;
		   
		          $querybien="INSERT INTO registroerror(id_error,inventario,clave_dispositivo,fecharegistro,id_div,tipoerror)
			                         VALUES (%d,'%s',%d,'%s',%d,'%s')";
						   
			      $queryerror=sprintf($querybien,$ultimo,$disperror['inventario'],$disperror['dispositivo_clave'],date('Y-m-d H:i:s'),$_SESSION['id_div'],'ra' );
			   			 
			      $registroerror= pg_query($queryerror)or die('Hubo un error con la base de datos');
		
			
	    	}//fin while guarad errores
		?>
        
         <br>
           <legend align="left"> <h4><?php echo "Se intentaron registrar  " . $errorreg ." dispositivos que no cumplen con los requisitos. " ?></h4></legend> 
   
           <br>
                <form action="../inc/erroresreg.inc.php" method="post" name="actreg" >
	               <legend align="left"><input name="enviar" type="submit" value="Exportar a Excel" /></legend>
	            </form>
           <br>
	<?php   
	} //finaliza funcion exportaErrorReg	

function exportaErrorBien(){
	//Exporta  errores de datos si no existen en bienes inventario  
	
		$queryreg="SELECT ei.inventario FROM errorinserta ei
                     JOIN registroerror re
                     ON ei.inventario=re.inventario
                     WHERE tipoerror='b'";
					 
	    $result = pg_query($queryreg) or die('Hubo un error con la base de datos');
	    $errorreg= pg_num_rows($result); 	
	?>
   
	      <br> 
           <legend align="left"> <h4><?php echo "Faltó registrar  " . $errorreg ." dispositivos que no se encuentran en el inventario de la facultad." ?></h4> </legend>
          <br>
	       <form action="../inc/erroresbn.inc.php" method="post" name="erroresbn" >
	                 <legend align="left"><input name="enviar" type="submit" value="Exportar a Excel" /></legend>
	          </form>
          <br>
	<?php   
	 
	} //finaliza funcion exportaErrorBien
	
function exportaErrorBienAct(){
	//Exporta  errores de datos si no existen en bienes inventario  
	
		$queryreg="SELECT ei.inventario FROM errorinserta ei
                     JOIN registroerror re
                     ON ei.inventario=re.inventario
                     WHERE tipoerror='ba'";
					 
	    $result = pg_query($queryreg) or die('Hubo un error con la base de datos');
	    $errorreg= pg_num_rows($result); 	
	?>
   
	      <br> 
           <legend align="left"> <h4><?php echo "Faltó registrar  " . $errorreg ." dispositivos que no se encuentran en el inventario de la facultad." ?></h4> </legend>
          <br>
	       <form action="../inc/erroresbn.inc.php" method="post" name="actbn" >
	                 <legend align="left"><input name="enviar" type="submit" value="Exportar a Excel" /></legend>
	          </form>
          <br>
	<?php   
	 
	} //finaliza funcion exportaErrorBien
function buscaBienes(&$datosdec){
	
		//echo 'valores en buscabienes'. $invent;
	          
		     // Buscar en bienes 
			 
			 $queryb="SELECT bn_id
							  FROM bienes
			                  WHERE bn_clave="."'".$datosdec[15]."'" . "
							  OR bn_anterior="."'".$datosdec[15]."'";
			// echo $queryb;
			 				  
			  $registrob= @pg_query($queryb) or die('ERROR  en errorinserta'); 
              $bienes= pg_fetch_array($registrob);
			 
			  
			  
			  if(pg_num_rows($registrob)==0 ){
				  
			        $queryre="SELECT max(id_error) FROM registroerror";
                    $registrore= pg_query($queryre) or die('Error en tabla  registroerror'); 
                    $ultimoerror= pg_fetch_array($registrore);
	
		             if ($ultimoerror[0]==0)
				         $ultimoerror=1;//inicializando la tabla dispositivo
			         else 
			             $ultimoerror=$ultimoerror[0]+1;	  
             
			        $querybien="INSERT INTO  registroerror                              (id_error,inventario,clave_dispositivo,fecharegistro,id_div,tipoerror)
			               VALUES (%d,'%s',%d,'%s',%d,'%s')";
						   
			          $queryerror=sprintf($querybien,$ultimoerror,$datosdec[15],$datosdec[0],date('Y-m-d H:i:s'),$_SESSION['id_div'],'b' );			 
			           $registroerror= @pg_query($queryerror) or die('ERROR AL INSERTAR en registroerror');
			   
			        $conterrorbn=$conterrorbn+1;
			 
			  }//fin if
		   
			//return $bienes[0];
        }//fin función buscaBienes
	
	function buscaBienesAct(&$datosdec){
	
		//echo 'valores en buscabienes'. $invent;
	          
		     // Buscar en bienes 
			 
			 $queryb="SELECT bn_id
							  FROM bienes
			                  WHERE bn_clave="."'".$datosdec[15]."'" . "
							  OR bn_anterior="."'".$datosdec[15]."'";
			// echo $queryb;
			 				  
			  $registrob= @pg_query($queryb) or die('ERROR  en errorinserta'); 
              $bienes= pg_fetch_array($registrob);
			 
			  
			  
			  if(pg_num_rows($registrob)==0 ){
				  
			        $queryre="SELECT max(id_error) FROM registroerror";
                    $registrore= pg_query($queryre) or die('Error en tabla  registroerror'); 
                    $ultimoerror= pg_fetch_array($registrore);
	
		             if ($ultimoerror[0]==0)
				         $ultimoerror=1;//inicializando la tabla dispositivo
			         else 
			             $ultimoerror=$ultimoerror[0]+1;	  
             
			        $querybien="INSERT INTO  registroerror                              (id_error,inventario,clave_dispositivo,fecharegistro,id_div,tipoerror)
			               VALUES (%d,'%s',%d,'%s',%d,'%s')";
						   
			          $queryerror=sprintf($querybien,$ultimoerror,$datosdec[15],$datosdec[0],date('Y-m-d H:i:s'),$_SESSION['id_div'],'ba' );			 
			           $registroerror= @pg_query($queryerror) or die('ERROR AL INSERTAR en registroerror');
			   
			        $conterrorbn=$conterrorbn+1;
			 
			  }//fin if
		   
			//return $bienes[0];
        }//fin función buscaBienes
	}		  
			?>