<?php 
require_once('../inc/sesion.inc.php');
require_once('../conexion.php');
require_once('../clases/importa.class.php');

session_start(); 


$marca=new importa();
$busca=new importa();
$botonReg=new importa();
$botonBien=new importa();

function utf8_string_array_encode(&$array){
    $func = function(&$value,&$key){
        if(is_string($value))
            $value = utf8_encode($value);
         
        if(is_string($key))
            $key = utf8_encode($key);
        
        if(is_array($value))
            utf8_string_array_encode($value);
        
    };
    array_walk($array,$func);
    return $array;
} ?>




<table width="600" cellspacing="20" cellpadding="20" border="0" class="principal">
<form  method="POST" enctype="multipart/form-data">
 <tr>
   <td width="150" height="30" align="right">Subir archivo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
   <td width="400"><input type="file" name="archivo_txt" id='archivo'></td>
 </tr>
 
 <tr>
   <td width="800" height="30" colspan="2" align="center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

   
     <input  type="submit" value="Importar">
     <input type="reset" value="Cancelar">
   </td>
 </tr>
</form>
</table>



<?php 

  $file_upload = $_FILES["archivo_txt"]["name"];
  $tmp_name = $_FILES["archivo_txt"]["tmp_name"];
  $size = $_FILES["archivo_txt"]["size"];
  $tipo = $_FILES["archivo_txt"]["type"];
  $contexitobn=0;
  $cuenta=1;
  $no=1;
  $errorimp=0;
  $errorbien=0;
  $importa=0;
 //echo $tmp_name;
 if($size > 0){
 
 
     $fp = fopen($tmp_name, "r");
   
     // Procesamos linea a linea el archivo CSV y 
     // lo insertamos en la base de datos
	 
	
	 ?>
      <table>
      <?php 
     while($datos = fgetcsv ($fp, 1000, "\t")){
		 
		  $datosdec=utf8_string_array_encode($datos); 
		  
	      $querytemp="SELECT * FROM dispositivo WHERE 
		              inventario="."'".$datosdec[15]."'";
					  
		  $datostemp = pg_query($querytemp);
		   
		  if (pg_num_rows($datostemp)>0) {
			 
		           $updatequery= "UPDATE dispositivo SET inventario='%s'
			                      WHERE inventario="."'".$datosdec[15]."'";
							  
			        $queryu=sprintf($updatequery,$datosdec[15] ); 
			        $result=pg_query($queryu) or die('ERROR AL ACTUALIZAR dispositivo '); 
			  
			        $contreing=$contreing+1; // para la actualización
			  
		   } else { 
	     
	
	     //muestra errores y verifica valor en catálogo
	      //print_r($datos);
		  //$marca->marcaError($datos);
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
		     <legend align="left"><?php //echo 'El formato de fecha de la columna AW, <strong> licencia_fin </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es incorrecto.'; ?></legend>
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
		      <legend align="left"> <?php //echo 'La columna AY, <strong>id_lab</strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].'. <strong> se ingresó con cero aún así se localizó el dispositivo y se registró.</strong>'; ?></legend><?php // } 
		
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
	   
       $busca->buscaBienes($datosdec); // si no  lo encuentra lo registra en errores
		 
		 
		  
		  	 $queryb="SELECT bn_id
							  FROM bienes
			                  WHERE bn_clave="."'".$datosdec[15]."'" . "
							  OR bn_anterior="."'".$datosdec[15]."'";
			
			 				  
			  $registrob= pg_query($queryb) or die('ERROR  en bienes'); 
              $bienes= pg_fetch_array($registrob);
			
		/* $queryerror="SELECT * FROM errorinserta 
	               WHERE id_error=" . $cuenta .
				 " AND  (columna1!=2 AND columna2!=2 AND columna3!=2 AND columna4!=2 
				AND  columna10!=2 AND columna11!=2 
				AND columna25!=2 AND columna28!=2
				AND columna30!=2 AND columna31!=2
			    AND columna32!=2 AND columna33!=2 AND columna34!=2 AND columna35!=2
				AND columna36!=2 AND columna37!=2 AND columna45!=2
				AND columna51!=2)";*/
		//valida identificadores de catálogos';	
		$queryerror="SELECT * FROM errorinserta 
	                 WHERE id_error=" . $cuenta .
				 "   AND  (columna1!=2 AND columna2!=2 AND columna3!=2 AND columna4!=2 
				     AND  columna10!=2 AND columna11!=2
					
					 AND columna30!=2 AND columna31!=2
			         AND columna32!=2 AND columna33!=2 AND columna34!=2 AND columna35!=2
				     AND columna36!=2 AND columna37!=2 AND columna45!=2)";
			//echo $queryerror;	 
	  $result = pg_query($queryerror) or die('Hubo un error con la base de datos');
	  $error= pg_num_rows($result); 
	  //echo 'errorno',$error;
	 // echo 'bien'. $bienes[0].  'error'.$error;
		   // para saber cuales son los qque tienen error de registro son todos excpt errorinserta
		   /*SELECT inventario FROM errorinserta 
	              
except
SELECT ei.inventario FROM errorinserta ei
join registroerror re
on ei.inventario=re.inventario
where tipoerror='b';
		   */
	 if ( $error > 0 && $bienes[0]!=NULL){
	
	      //ultimo valor en dispositivo
	      $queryd="SELECT max(id_dispositivo) FROM dispositivo";
                    $registrod= pg_query($queryd) or die('ERROR ...'); ;
                    $ultimo= pg_fetch_array($registrod);
	
		      if ($ultimo[0]==0)
				    $ultimo=1;//inicializando la tabla dispositivo
			  else 
			        $ultimo=$ultimo[0]+1;
					
					//lab de la división
					
			 $querye="SELECT ec.id_lab,velocidad,cache,tipotarjvideo,modelotarjvideo,
			                  memoriavideo,equipoaltorend,accesorios,garantiamanten,arquitectura,
							  estadobien,servidor,descextensa 
							  FROM equipoc ec
							  JOIN laboratorios l
							  ON l.id_lab=ec.id_lab
							  JOIN departamentos d
							  ON l.id_dep=d.id_dep
							  JOIN divisiones dv
							  ON dv.id_div=d.id_div
			                  WHERE inventario="."'".$datosdec[15]."'".
							  " AND dv.id_div=" .$_SESSION['id_div'];
							 /*			 $querye="SELECT ec.id_lab,velocidad,cache,tipotarjvideo,modelotarjvideo,
			                  memoriavideo,equipoaltorend,accesorios,garantiamanten,arquitectura,
							  estadobien,servidor,descextensa 
							  FROM equipoc ec
							  WHERE inventario="."'".$disp['inventario']."'";*/
							  
              $registroe= pg_query($querye) or die('ERROR ...');
              $equipoc= pg_fetch_array($registroe);
			 
			  if($datosdec[50]==0) // id id_lab=0
			     $lab=$equipoc[0];
			  else 	 
			     $lab=$datosdec[50];
				
			  //buscar información de los catálogos de marca y memoria ram
			  
			  $querym="SELECT id_marca 
							  FROM cat_marca
			                  WHERE descmarca="."'".strtoupper($datosdec[12]."'");
		
							  
              $registrom= pg_query($querym)  or die('ERROR ...');
              $marca= pg_fetch_array($registrom);
			  //Revisar al ingresar memoria RAM
			  $querymr="SELECT id_mem_ram 
							  FROM cat_memoria_ram
			                  WHERE cantidad_ram="."'".$datosdec[24]."'";
							  
              $registromr= pg_query($querymr);
              $ram= pg_fetch_array($registromr);		  
		         
		      if ($ram[0]==NULL)
				  $ram=0;
			  else 
			      $ram=$ram[0];	  

              $queryd="SELECT detalle_ub 
							  FROM laboratorios
			                  WHERE id_lab=" . $datosdec[50]; 
				//echo $queryd;			  
              $registrod= pg_query($queryd) or die('ERROR ...');
              $detalle= pg_fetch_array($registrod);	

              $updatequery= "UPDATE laboratorios SET detalle_ubcomp= '%s'
			                  WHERE id_lab=" .$datosdec[50];
			   
			  $queryu=sprintf($updatequery, $detalle[0]|| ' ' || $datosdec[8] ); //usuario_ubicacion
			   
              $result=pg_query($queryu) or die('ERROR AL ACTUALIZAR laboratorios');
			  		
					
					
			 if ($datosdec[18]==0) 
			      $datosdec[18]= date("Y-m-d", strtotime($datosdec[18]));
			  if ($datosdec[47]==0) 
			      $datosdec[47]= date("Y-m-d", strtotime($datosdec[47]));	  
              if ($datosdec[48]==0) 
			      $datosdec[48]= date("Y-m-d", strtotime($datosdec[48]));	
				  		
	        //print_r($datosdec);
			/*
            $query = "INSERT INTO dispositivotemp (dispositivo_clave,usuario_final_clave,familia_clave,
                                               tipo_ram_clave,tecnologia_clave,resguardo_nombre,
										       resguardo_no_empleado, usuario_nombre,usuario_ubicacion,
                                               usuario_perfil, usuario_sector,serie,
                                               marca_p, no_factura, anos_garantia,
                                               inventario, modelo_p, proveedor,
										       fecha_factura,familia_especificar,
										       modelo_procesador,cantidad_procesador,nucleos_totales,
										       nucleos_gpu, memoria_ram,ram_especificar, 
										       num_elementos_almac,total_almac,num_arreglos,
										       esquema_uno,esquema_dos,esquema_tres, esquema_cuatro,
                                               tec_uno,tec_dos,tec_tres,tec_cuatro,
                                               subtotal_uno,subtotal_dos,subtotal_tres,subtotal_cuatro,
                                               arreglo_total,tec_com,tec_com_otro,
                                               sist_oper,version_sist_oper,licencia,
										       licencia_ini,licencia_fin,id_edificio,
											   id_lab) VALUES 
										      ('$datosdec[0]','$datosdec[1]','$datosdec[2]', 
                                               '$datosdec[3]','$datosdec[4]','$datosdec[5]', 
											   '$datosdec[6]','$datosdec[7]','$datosdec[8]',
											   '$datosdec[9]','$datosdec[10]','$datosdec[11]',
											   '$datosdec[12]','$datosdec[13]','$datosdec[14]', 
											   '$datosdec[15]','$datosdec[16]','$datosdec[17]',
											   '$datosdec[18]','$datosdec[19]','$datosdec[20]', 
											   '$datosdec[21]','$datosdec[22]','$datosdec[23]', 
											   '$datosdec[24]','$datosdec[25]',$datosdec[26],
											   '$datosdec[27]','$datosdec[28]', 
											   '$datosdec[29]','$datosdec[30]','$datosdec[31]','$datosdec[32]',
											   '$datosdec[33]','$datosdec[34]','$datosdec[35]','$datosdec[36]', 
											   '$datosdec[37]','$datosdec[38]','$datosdec[39]','$datosdec[40]',
											   '$datosdec[41]','$datosdec[42]','$datosdec[43]','$datosdec[44]',
											   '$datosdec[45]','$datosdec[46]','$datosdec[47]', 
											   '$datosdec[48]','$datosdec[49]','$datosdec[50]');"; //$datos[51] previendo modificaccion para idmod
							
							//echo $query;
                           //$result=pg_query($query) or die('ERROR AL INSERTAR EN DISPOSITIVO: ' . pg_last_error());
							
						 $result=@pg_query($query) or die('ERROR AL INSERTAR EN DISPOSITIVO: ' );
							
			*/				
							
							 $strqueryd="INSERT INTO dispositivo (id_dispositivo,bn_id,id_lab,
                                                                  dispositivo_clave,usuario_final_clave,familia_clave,
                                                                 tipo_ram_clave,tecnologia_clave,nombre_resguardo,resguardo_no_empleado,
                                                                 usuario_nombre,usuario_ubicacion,usuario_perfil, 
              usuario_sector,serie,marca_p, 
              no_factura,anos_garantia,inventario, 
              modelo_p,proveedor_p,fecha_factura,
              familia_especificar,modelo_procesador,cantidad_procesador,
              nucleos_totales,nucleos_gpu, memoria_ram,
              ram_especificar, num_elementos_almac,
              total_almac,num_arreglos,esquema_uno,
              esquema_dos,esquema_tres, esquema_cuatro, 
              tec_uno,tec_dos,tec_tres,tec_cuatro,
              subtotal_uno,subtotal_dos,subtotal_tres,subtotal_cuatro,
              arreglo_total,tec_com,tec_com_otro, 
              sist_oper,version_sist_oper,
              licencia,licencia_ini,licencia_fin,fecha,
			  velocidad,memcache,tipotarjvideo ,
              modelotarjvideo,memoriavideo,equipoaltorend,
              accesorios,garantiamanten,arquitectura ,
              estadobien,servidor,descextensa , 
              id_marca , marca, marca_esp,
              id_mem_ram)

		      VALUES (%d,%d,%d,
		           %d,%d,%d,
				   %d,%d,'%s',%d,
				   '%s','%s',%d, 
				   %d,'%s','%s', 
				   '%s','%s','%s', 
				   '%s','%s','%s',
				   '%s','%s','%s',	
				   '%s','%s','%s', 
				   '%s',%d,   
				   %d,%d,%d,  
				   %d,%d,%d,  
				   %d,%d,%d,%d, 
				   %d,%d,%d,%d, 
				   %d,%d,'%s',  
				   %d,'%s',      
				   %d,'%s','%s','%s', 
				   '%s','%s','%s', 
				   '%s','%s','%s', 
				   '%s','%s','%s',  
				   '%s','%s','%s',  
				   %d,'%s','%s', 
				   %d )";
				   
                 $queryid=sprintf($strqueryd,$ultimo,$bienes[0],$lab, 
                 $datosdec[0],$datosdec[1],$datosdec[2], 
				 $datosdec[3],$datosdec[4],$datosdec[5],$datosdec[6] ,
                 $datosdec[7],$datosdec[8],$datosdec[9], 
				 $datosdec[10],$datosdec[11],$datosdec[12], 
				 $datosdec[13],$datosdec[14],$datosdec[15], 
                 $datosdec[16],$datosdec[17],$datosdec[18], 
			     $datosdec[19],$datosdec[20],$datosdec[21], 
			     $datosdec[22],$datosdec[23],$datosdec[24], 
                 $datosdec[25],$datosdec[26],
			     $datosdec[27],$datosdec[28],$datosdec[29],
			     $datosdec[30],$datosdec[31],$datosdec[32], 
			     $datosdec[33],$datosdec[34],$datosdec[35],$datosdec[36], 
				 $datosdec[37],$datosdec[38],$datosdec[39],$datosdec[40], 
                 $datosdec[41],$datosdec[42],$datosdec[43], 
			     $datosdec[44],$datosdec[45], 
			     $datosdec[46],$datosdec[47],$datosdec[48],date('Y-m-d'), 
				 $equipoc[1],$equipoc[2],$equipoc[3], 
				 $equipoc[4],$equipoc[5],$equipoc[6], 
                 $equipoc[7],$equipoc[8],$equipoc[9], 
				 $equipoc[10],$equipoc[11],$equipoc[12], 
                 $marca[0],$disp['marca'],'', 
                 $ram[0]);
               
                $result=pg_query($queryid) or die('ERROR AL INSERTAR EN DISPOSITIVO: ' . pg_last_error());
					
                         
                         if (!$result) {
						 $errorimp++;
							$queryre="SELECT max(id_error) FROM registroerror";
                    $registrore= pg_query($queryre) or die('Error en tabla  registroerror'); 
                    $ultimoerror= pg_fetch_array($registrore);
	
		             if ($ultimoerror[0]==0)
				         $ultimoerror=1;//inicializando la tabla dispositivo
			         else 
			             $ultimoerror=$ultimoerror[0]+1;	  
             
			        $querybien="INSERT INTO  registroerror                                                              (id_error,inventario,clave_dispositivo,fecharegistro,id_div,tipoerror)
			               VALUES (%d,'%s',%d,'%s',%d,'%s')";
						   
			          $queryerror=sprintf($querybien,$ultimoerror,$datosdec[15],$datosdec[0],date('Y-m-d H:i:s'),$_SESSION['id_div'],'i' );			 
			           $registroerror= @pg_query($queryerror) or die('ERROR AL INSERTAR en registroerror');
		        	         echo 'NO inserto';
						 }
			               else {
                        //       echo 'inserto';
			             $importa++; // inserciones restantes
 		  
                    } //if(!$result) else

	        }else { // si hubo error de registro lo almacena
	 
	          
	         $errorbien++;
		   
	      }
		
       
		   }//if (pg_num_rows($datostemp)>0) else
		   
		   $cuenta++;	
		   $no++;
					
	   } 
	   //Revisa si el inventyario fue registrado previamente
	    /*$queryant="SELECT * FROM dispositivo WHERE 
		              inventario="."'".$datosdec[15]."'" .
					" AND importa=1"  ;
					  
		  $datosant = pg_query($queryant);
		   $ant=pg_num_rows($datosant);
		   echo 'reganterior'.$ant;*/
		//Errores de registro 
		
		 /*$queryreg=" SELECT inventario FROM errorinserta 
	                 EXCEPT
                     SELECT ei.inventario FROM errorinserta ei
                     JOIN registroerror re
                     ON ei.inventario=re.inventario
                     WHERE tipoerror='b'";
					 */
		$queryreg="SELECT * FROM errorinserta 
	               WHERE 
				  columna1!=2 AND columna2!=2 AND columna3!=2 AND columna4!=2 
				   AND  columna10!=2 AND columna11!=2 
				   AND columna25!=2 AND columna28!=2
				   AND columna30!=2 AND columna31!=2
			       AND columna32!=2 AND columna33!=2 AND columna34!=2 AND columna35!=2
				   AND columna36!=2 AND columna37!=2 AND columna45!=2
				   AND columna51!=2";		 
					 
	    $result = pg_query($queryreg) or die('Hubo un error con la base de datos');
	    $regerror= pg_num_rows($result); 		 
					 
	    echo 'errorimp'.$errorimp;
	    echo 'errorbien'.$errorbien;
		echo 'cuenta'.$cuenta;
		echo 'errorreg'.$errorreg;
		echo 'importa'.$importa;
		echo 'errorreg'.$regerror;
		$cuentaTotal=$cuenta-1;
	  ?>
	       //falta revisar errores de lab	
	      <legend align="left"> <h4><?php echo "Se importaron " . $importa . " / " . $cuentaTotal . " dispositivos."; ?></h4> </legend>
          
          <?php if ($regerror >0 && $importa!=0)
		  
		              $botonReg->exportaErrorReg();
			  
			  	
				if ($errorbien >0 && $importa!=0)
						 
		              $botonBien->exportaErrorBien();
		
		
  }//while para insertar en dispositivo temporal
  
   /*$querydt="DELETE FROM errorinserta";	
   $result = pg_query($querydt) or die('Hubo un error con la base de datos');*/
   
 ?>
 
           
             






