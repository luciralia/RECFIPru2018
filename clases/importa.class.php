<?php

require_once('../inc/sesion.inc.php');
require_once('../conexion.php');

//require_once('../inc/sesion.inc.php');

class importa{
	
function valida_dispositivo($val){
	/* if ( ! is_int ( $val) )
            $val=0;*/
	
	$querybet="SELECT * FROM cat_dispositivo
	           WHERE dispositivo_clave=".$val;
	
    $result = pg_query($querybet) or die('Hubo un error con la base de datos');
	$valido= pg_num_rows($result);
    return $valido;
}

function valida_usu_final($val){
   if ( ! is_int ( $val) )
            $val=0;



	$querybet="SELECT *  FROM cat_usuario_final
	           WHERE usuario_final_clave=".$val;
	//echo $querybet;
    $result = pg_query($querybet) or die('Hubo un error con la base de datos');
	$valido= pg_num_rows($result);
    return $valido;

}

function valida_familia($val){
    /* if ( ! is_int ( $val) )
            $val=0;*/
	$querybet="SELECT * FROM cat_familia
	           WHERE id_familia=".$val;
    $result = pg_query($querybet) or die('Error en tabla  ...');
	$valido= pg_num_rows($result);
    return $valido;
}
function valida_ram($val){
 /* if ( ! is_int ( $val) )
            $val=0;*/
	$querybet="SELECT * FROM cat_tipo_ram
	           WHERE id_tipo_ram=".$val;
    $result = pg_query($querybet) or die('Error en tabla  ...');
	$valido= pg_num_rows($result);
    return $valido;
}

function valida_tec($val){
    /* if ( ! is_int ( $val) )
            $val=0;*/
	$querybet="SELECT * FROM cat_tecnologia
	            WHERE id_tecnologia=".$val;
	
    $result = pg_query($querybet) or die('Error en tabla  ...');
	$valido= pg_num_rows($result);
    return $valido;
}
function valida_usu_perfil($val){
	/* if ( ! is_int ( $val) )
            $val=0;*/
	$querybet="SELECT * FROM cat_usuario_perfil
	            WHERE id_usuario_perfil=".$val;
	$result = pg_query($querybet) or die('Error en tabla  ...');
	$valido= pg_num_rows($result);
    return $valido;
	
}
function valida_usu_sector($val){
	/* if ( ! is_int ( $val) )
            $val=0;*/
	$querybet="SELECT * FROM cat_usuario_sector
	            WHERE id_usuario_sector=".$val;
	$result = pg_query($querybet) or die('Error en tabla  ...');
	$valido= pg_num_rows($result);
    return $valido;
	
}
function valida_tec_com($val){
	/* if ( ! is_int ( $val) )
            $val=0;*/
	$querybet="SELECT * FROM cat_tec_com
	            WHERE id_tec_com=".$val;
	$result = pg_query($querybet) or die('Error en tabla  ...');
	$valido= pg_num_rows($result);
    return $valido;
	
}
function valida_sistoper($val){
	/* if ( ! is_int ( $val) )
            $val=0;*/
	$querybet="SELECT * FROM cat_sistema_operativo
	            WHERE id_so=".$val;
	$result = pg_query($querybet) or die('Error en tabla  ...');
	$valido= pg_num_rows($result);
    return $valido;
	
}


function respaldo ($datos,$estado){ 
   
    $queryd="SELECT max(id_dispositivo) FROM dispositivobackup";
                    $registrod= pg_query($queryd) or die('ERROR ...'); ;
                    $ultimo= pg_fetch_array($registrod);
	
		      if ($ultimo[0]==0)
				    $ultimo=1;//inicializando la tabla dispositivo
			  else 
			        $ultimo=$ultimo[0]+1;
   
 $queryd="INSERT INTO dispositivobackup (id_dispositivo,id_lab,
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
			  id_edif,importa)

		      VALUES (%d,'%s',
		           '%s','%s','%s',
				   '%s','%s','%s','%s',
				   '%s','%s','%s', 
				   '%s','%s','%s', 
				   '%s','%s','%s', 
				   '%s','%s','%s',
				   '%s','%s','%s',	
				   '%s','%s','%s', 
				   '%s','%s',   
				   '%s','%s','%s',  
				   '%s','%s','%s',  
				   '%s','%s','%s','%s', 
				   '%s','%s','%s','%s', 
				   '%s','%s','%s',  
				   '%s','%s',      
				   '%s','%s','%s','%s', 
				   '%s',%d )";
				   
                 $queryid=sprintf($queryd,$ultimo,$datos[50], 
                 $datos[0],$datos[1],$datos[2], 
				 $datos[3],$datos[4],$datos[5],$datos[6] ,
                 $datos[7],$datos[8],$datos[9], 
				 $datos[10],$datos[11],$datos[12], 
				 $datos[13],$datos[14],$datos[15], 
                 $datos[16],$datos[17],$datos[18], 
			     $datos[19],$datos[20],$datos[21], 
			     $datos[22],$datos[23],$datos[24], 
                 $datos[25],$datos[26],
			     $datos[27],$datos[28],$datos[29],
			     $datos[30],$datos[31],$datos[32], 
			     $datos[33],$datos[34],$datos[35],$datos[36], 
				 $datos[37],$datos[38],$datos[39],$datos[40], 
                 $datos[41],$datos[42],$datos[43], 
			     $datos[44],$datos[45], 
			     $datos[46],$datos[47],$datos[48],date('Y-m-d H:i:s'), 
				 $datos[49],$estado);
               
                $result=pg_query($queryid) or die('ERROR AL INSERTAR EN DISPOSITIVOBackup: ' . pg_last_error());


}

public function marcaError($datosdec,$noo){ 
require_once('../clases/inventario.class.php');
require_once('../clases/importa.class.php');


$verifica = new inventario(); 
$valida=new importa();

      //muestra errores y verifica valor en catálogo
	     
		  //$marca->marcaError($datos);
		  //catálogos
		  //echo 'reg';
		// echo $row_datos[0];
		
		
		 
	 $columna1=1; $columna2=1; $columna3=1;$columna4=1; $columna5=1;
	 $columna10=1; $columna11=1; $columna43=1; $columna45=1; $columna46=1;
		 
     $regexFecha = '/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/';
    echo'Valores de entrada marca error';
     print_r($datosdec);
		 
          $inventario=$datosdec[15];
		  $dispclave=$datosdec[0];
		  
        $verifica->verificaTipoEquipo($datosdec[0]);
        if ($datosdec[0]==NULL) { $columna1=$columna1*2;
		        $dispclave=0;
				
				?>
	           <legend align="left"><?php echo 'La columna A,  <strong> clave_dispositivo </strong> del renglón correpondiente al no.inventario '.$datosdec[15] .' es obligatoria y numérica.'; ?></legend>
     <?php } else {
	    if(!preg_match("/^[0-9]+$/",$datosdec[0])) { $columna1=$columna1*4;
		$dispclave=0;?>
	<legend align="left"><?php echo 'La columna A,  <strong> clave_dispositivo </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend><?php  } else {
	//detectar si es identificador valido
	
	$valida->valida_dispositivo($datosdec[0]);
	if( $valida>0 && $verifica==1)
	   $columna1=$columna1*3;
	  else {
	   $columna1=$columna1*6; ?>
       <legend align="left"><?php  echo 'La columna A,  <strong>  clave_dispositivo </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' no es valor válido, revisar catálogo correspondiente.'; ?></legend>
       
<?php	  }
	 }
	 }
      
	 if ($datosdec[1]==NULL) { $columna2=$columna2*2;?>
		      <legend align="left"><?php echo 'La columna B, <strong> usuario_final_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria y numérica.';?></legend>     	
	 <?php  }else{ 
	    if(!preg_match("/^[0-9]+$/",$datosdec[1])){ $columna2=$columna2*4;
		// echo 'es caracter';?>
	<legend align="left"><?php  echo 'La columna B,  <strong>  usuario_final_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>
      <?php } 
		 //detectar si es identificador valido
	
	 $valida->valida_usu_final($datosdec[1]);
	if( $valida>0 && $verifica==1)
	   $columna2=$columna2*3;
	  else {
	    $columna2=$columna2*=6; ?>
		<legend align="left"><?php  echo 'La columna B,  <strong> usuario_final_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' no es valor válido, revisar catálogo correspondiente.'; ?></legend>
	<?php  }
	 }
   if ($datosdec[2]==NULL) {$columna3=$columna3*2;
 
         ?> 
		     <legend align="left"><?php echo 'La columna C, <strong> familia_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria y numérica.';	?></legend>
	 <?php } else{
        if(!preg_match("/^[0-9]+$/",$datosdec[2])) { $columna3=$columna3*4;?>
	<legend align="left"><?php echo 'La columna C,  <strong> familia_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>
      <?php }else{
		 //detectar si es identificador valido
	
	$valida->valida_familia($datosdec[2]);
	if( $valida>0 && $verifica==1)
	    $columna3=$columna3*3;
	 else {
	    $columna3=$columna3*6; 
		?>
		<legend align="left"><?php  echo 'La columna C,  <strong> familia_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' no es valor válido, revisar catálogo correspondiente.'; ?></legend>
	<?php  }
	  }
	 }

	if ($datosdec[3]==NULL) { $columna4=$columna4*2;?>
		<legend align="left"><?php echo 'La columna D, <strong> tipo_ram_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria y numérica.'; ?></legend>
	 <?php } else {?>
     <?php if (!preg_match("/^[0-9]+$/",$datosdec[3]))  { $columna4=$columna4*4;?>
		     <legend align="left"><?php echo 'La columna D, <strong> tipo_ram_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>	
	 <?php } else {
		 //detectar si es identificador valido
	
	 $valida->valida_ram($datosdec[3]);
	if( $valida>0 && $verifica==1)
	    $columna4=$columna4*3;
	else { $columna3=$columna3*6;?>
	   <legend align="left"><?php  echo 'La columna D,  <strong> tipo_ram_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' no es valor válido, revisar catálogo correspondiente.'; ?></legend>
	<?php  }
	 }
	 }
	
   if ($datosdec[4]==NULL) { 
	            $columna5=$columna5*2;?>
			 <legend align="left"><?php echo 'La columna E, <strong> tecnologia_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria y numérica.'; ?></legend>
	 <?php } else { ?>
      <?php if (!preg_match("/^[0-9]+$/",$datosdec[4])) { 
	           $columna5=$columna5*4;?>
		      <legend align="left"><?php echo 'La columna E, <strong> tecnologia_clave </strong>del renglón correpondiente al no.inventario  '.$datosdec[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>			
	 <?php } else {
		 //detectar si es identificador valido
	
	 $valida->valida_tec($datosdec[4]);
	if( $valida>0 && $verifica==1)
	    $columna5=$columna5*3;
	  else {
	    $columna5=$columna5*6; ?>
		<legend align="left"><?php  echo 'La columna E,  <strong> tecnologia_clave </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' no es valor válido, revisar catálogo correspondiente.'; ?></legend>
	<?php  }
	 }
	 }
    
     if ($datosdec[5]==NULL) {
		       $columna6=0;?>
		       <legend align="left"><?php echo 'La columna F, <strong> resguardo_nombre </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.'; ?></legend>	
      <?php   } elseif(is_int($datosdec[5])) $columna6=1; else $columna6=2;   
	      			
	if ($datosdec[6]==NULL) { $columna7=0;?>
		      <legend align="left"><?php echo 'La columna G, <strong> resguardo_no_empleado </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.'; ?></legend>	     
	  <?php } else{
	 if(!preg_match("/^[0-9]+$/",$datosdec[6])) {$columna7=1; ?>
				  <legend align="left"><?php echo 'La columna G, <strong> resguardo_no_empleado  </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser númerica'; ?></legend>
				<?php   } else $columna7=2; 
	 }
      if ($datosdec[7]==NULL) { $columna8=0;?>
		      <legend align="left"><?php echo 'La columna H, <strong> usuario_nombre </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.'; ?></legend>
     <?php } else {
		 if(!preg_match("/^[0-9]+$/",$datosdec[7])) {$columna8=2; ?>
				  <!--<legend align="left"><?php // echo 'La columna H, <strong> usuario_nombre  </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser cadena de caracteres.'; ?></legend>-->
				<?php   } else $columna8=1; 
	 }
	  if ($datosdec[8]==NULL) {$columna9=0;?>
		     <legend align="left"><?php echo 'La columna I, <strong> usuario_ubicación </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.'; ?></legend>
            <?php } else {
			if(is_int($datosdec[8])) $columna9=1; else $columna9=2; 
			}
	 if($datosdec[9]==NULL) { $columna10=$columna10*2;?>
		     <legend align="left"><?php echo 'La columna J, <strong> usuario_perfil </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria.'; ?></legend>      
			  <?php } else {?>
             <?php  if(!preg_match("/^[0-9]+$/",$datosdec[9])) { $columna10=$columna10*4;?>
		      <legend align="left"><?php echo 'La columna J, <strong> usuario_perfil </strong>del renglón correpondiente al no.inventario  '.$datosdec[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>   <?php } else{//detectar si es identificador valido
	 $valida->valida_usu_perfil($datosdec[9]);	  
	 if($valida>0 )
	   $columna10=$columna10*3;
	  else {
	    $columna10=$columna10*6; ?>
		<legend align="left"><?php  echo 'La columna J,  <strong> usuario_perfil </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' no es valor válido, revisar catálogo correspondiente.'; ?></legend>
	<?php  }
     }
	 }
		if ($datosdec[10]==NULL) { $columna11=$columna11*2;?>
		       <legend align="left"><?php echo 'La columna K, <strong> usuario_sector </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' es obligatoria y numérica.'; ?></legend>	      
			  <?php }else{?>
               <?php if (!preg_match("/^[0-9]+$/",$datosdec[10])) { $columna11=$columna11*4; ?>
		     <legend align="left"><?php echo 'La columna K, <strong> usuario_sector </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>   <?php } else{
			  if($valida->valida_usu_sector($datosdec[10])>0)
	   $columna11=$columna11*3;
	  else {
	    $columna11=$columna11*6; ?>
		<legend align="left"><?php  echo 'La columna K,  <strong> usuario_sector </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' no es valor válido, revisar catálogo correspondiente.'; ?></legend>
	<?php  }
  }
}?> 

  <?php if ($datosdec[11]==NULL) { $columna12=0;?>
		     <legend align="left"><?php //echo 'La columna L, <strong> no servicio </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
			<?php }  ?>
            
		   <?php if ($datosdec[12]==NULL) { $columna13=0;?>
		     <legend align="left"><?php echo 'La columna M, <strong> marca_p </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
			<?php } else{
			      if(preg_match("/^[0-9]+$/",$datosdec[12])) {$columna13=2; ?>
				  <legend align="left"><?php echo 'La columna M, <strong> marca_p </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es cadena de caracteres.'; ?></legend>
				<?php   } else $columna13=1; 
			}
			if ($datosdec[13]==NULL) { $columna14=0; ?>
		      <legend align="left"><?php // echo 'La columna N, <strong> no_factura </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php }  elseif(is_int($datosdec[13])) $columna14=1; else $columna14=2; 
	  
	  if ($datosdec[14]==NULL) { $columna15=0;?>
		      <legend align="left"><?php echo 'La columna O, <strong> años garantía </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php }else {
		  if(!preg_match("/^[0-9]+$/",$datosdec[14])){$columna15=1; ?>
		  <legend align="left"><?php // echo 'La columna O, <strong> años garantía </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser númerica.'; ?></legend>
		<?php   }
		  else 
		  $columna15=2; 
	 
	  }
	  if ($datosdec[15]==NULL) { $columna16=0;?>
		     <legend align="left"><?php echo 'La columna P, <strong> inventario </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
	  <?php } else{
	  if(is_int($datosdec[15])) $columna16=1; else $columna16=2; 
	  }
	  if ($datosdec[16]==NULL) { $columna17=0;?>
		     <legend align="left"><?php echo 'La columna Q, <strong> modelo_p </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php } else{
	  if(is_int($datosdec[16])) $columna17=1; else $columna17=2;
	  }
	  
	  if ($datosdec[17]==NULL) {$columna18=0;?>
		     <legend align="left"><?php // echo 'La columna R, <strong> proveedor_p </strong>del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>  
	  <?php } else{
		  if(is_int($datosdec[17])) $columna18=1; else $columna18=2; 
	  	  if ($datosdec[18]==NULL) { $columna19=0;?>
		     <legend align="left"> <?php echo 'La columna S, <strong> fecha_factura </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria..'; ?></legend>
      <?php } 
		  if(!preg_match($regexFecha,$datosdec[18])) $columna19=2; else $columna19=3;
	  }

         if ($datosdec[18]==NULL) { $columna19=0;?>
    
		     <legend align="left"><?php echo 'El formato de fecha de la columna S, <strong> fecha_factura </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es incorrecto.'; ?></legend>
      <?php } ?>
      
	  <?php if ($datosdec[20]==NULL) { $columna21=0;?>
		     <legend align="left"><?php echo 'La columna U, <strong> modelo_procesador </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>     
               <?php } else{
				   if(is_int($datosdec[20])) $columna21=1; else $columna21=2; 
			   }?>
      
       <?php if ($datosdec[21]==NULL) { $columna22=0;?>
		      <legend align="left"> <?php echo 'La columna V, <strong> cantidad_procesador </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend> 
                <?php }else{ ?>
                
               <?php if (!preg_match("/^[0-9]+$/",$datosdec[21])) { $columna22=2;?>
		     <legend align="left"> <?php echo 'La columna V, <strong> cantidad_procesador </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
                <?php } else $columna22=1;
				}?> 
                
                <?php if ($datosdec[22]==NULL) { $columna23=0;?>
		     <legend align="left"> <?php echo 'La columna W, <strong> nucleos_totales </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
            <?php } else{?>
            
              <?php if (!preg_match("/^[0-9]+$/",$datosdec[22]))  { $columna23=2;?>
		     <legend align="left"> <?php echo 'La columna W, <strong> nucleos_totales </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
      <?php }  else $columna23=1;
			}?>
      
      <?php if ($datosdec[23]==NULL) { $columna24=0;?>
		      <legend align="left"><?php echo 'La columna X, <strong> nucleos_GPU </strong>del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
	  <?php } else { if (!preg_match("/^[0-9]+$/",$datosdec[23]))  { $columna24=2;?>
		     <legend align="left"><?php echo 'La columna X, <strong> nucleos_GPU </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica'; ?></legend>
	  <?php } else $columna24=1;
	  }?>
      
      <?php if ($datosdec[24]==NULL) { $columna25=0;?>
		      <legend align="left"><?php echo 'La columna Y, <strong> memoria_RAM </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php  } else{
	  if(is_int($datosdec[24])) $columna25=1; else $columna25=2; 
	  
      //if (!preg_match("/^[0-9]+$/",$datosdec[24])) { ?>
		     <legend align="left"> <?php //echo 'La columna Y, <strong> memoria_RAM </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica'; ?></legend>
      <?php //  } ?>
      <?php //if ($datosdec[25]==NULL) { $columna25=0;?>
		     <legend align="left"><?php //echo 'La columna Z, <strong> ram_especificar</strong>del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>  
	  <?php //}  elseif(is_int($datosdec[17])) $columna25=1; else $columna25=2; 
	  }
      if ($datosdec[26]==NULL) { $columna27=0;?>
		      <legend align="left"><?php echo 'La columna AA, <strong> num_elementos_almac </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php }else{
	     if(is_int($datosdec[26])) $columna27=1; else $columna27=2; 
	  }
     
       if (!preg_match("/^[0-9]+$/",$datosdec[27])){ $columna28=2;?>
		      <legend align="left"> <?php // echo 'La columna AB, <strong> total_almac </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
      <?php }  else $columna28=1; ?>
      
      <?php if ($datosdec[28]==NULL) { $columna29=0;?>
		       <legend align="left"><?php echo 'La columna AC, <strong> num_arreglos </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php } else{
      
         if (!preg_match("/^[0-9]+$/",$datosdec[28])){ $columna29=2;?>
		  <legend align="left"><?php echo 'La columna AC, <strong> num_arreglos </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
      <?php } else $columna29=1;
      }
      if ($datosdec[29]==NULL) { $columna30=0;?>
		      <legend align="left"><?php echo 'La columna AD, <strong> esquema_uno </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria y numérica.'; ?></legend>
      <?php } else{ ?>
      
      <?php if (!preg_match("/^[0-9]+$/",$datosdec[29])){ $columna30=2;?>
		     <legend align="left"><?php echo 'La columna AD, <strong> esquema_uno </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
      <?php }  else $columna30=1; 
	  }?>
      
      <?php if ($datosdec[30]==NULL) { $columna31=0;?>
		      <legend align="left"><?php echo 'La columna AE, <strong> esquema_dos </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria y numérica.'; ?></legend>
	   <?php } else{
		   if (!preg_match("/^[0-9]+$/",$datosdec[30])){ $columna31=2;?>
		      <legend align="left"> <?php echo 'La columna AE, <strong> esquema_dos </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>         
	   <?php } else $columna31=1; 
	   }?>
       
       <?php if ($datosdec[31]==NULL) { $columna32=0;?>
		      <legend align="left"> <?php echo 'La columna AF, <strong> esquema_tres </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria y numérica.'; ?></legend>
      <?php } else {?>
     <?php if (!preg_match("/^[0-9]+$/",$datosdec[31])){ $columna32=2;?>
		      <legend align="left">  <?php echo 'La columna AF, <strong> esquema_tres </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
      <?php } else $columna32=1;
	  }?>
      
      <?php if ($datosdec[32]==NULL) { $columna33=0;?>
		      <legend align="left"><?php echo 'La columna AG, <strong> esquema_cuatro </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria y numérica.'; ?></legend>           
	 <?php } else {
      if (!preg_match("/^[0-9]+$/",$datosdec[32])){ $columna33=2;?>
		     <legend align="left"> <?php echo 'La columna AG, <strong> esquema_cuatro </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
	 <?php } else $columna33=1; 
	 }?>
     <?php if ($datosdec[33]==NULL) { $columna34=0;?>
		     <legend align="left"><?php echo 'La columna AH, <strong> tec_uno </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php  } else {if (!preg_match("/^[0-9]+$/",$datosdec[33])){ $columna34=2;?>
		       <legend align="left"> <?php echo 'La columna AH, <strong> tec_uno </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend> 
      <?php  } else $columna34=1;
	  }?>
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
        <?php } else { ?>
      <?php if (!preg_match("/^[0-9]+$/",$datosdec[42])){ $columna43=$columna43*4;?>
		     <legend align="left"> <?php echo 'La columna AQ, <strong> tec_com </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica, revisar el catálogo correspondiente.'; ?></legend><?php } else {
			  //detectar si es identificador valido
			  $valida->valida_tec_com($datosdec[42]);	  
	          if($valida>0 && $verifica==1)
	         
	               $columna43=$columna43*3;
	          else {
	            $columna43=$columna43*6; ?>
		<legend align="left"><?php  echo 'La columna AQ, <strong> tec_com </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' no es valor válido, revisar catálogo correspondiente.'; ?></legend>
	<?php  } 
	      }
		}?> 
         
      
       <?php if ($datosdec[44]==NULL) { $columna45=0;?>
		       <legend align="left"> <?php echo 'La columna AS, <strong> sist_oper </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend> 
         <?php }else{
		 if (!preg_match("/^[0-9]+$/",$datosdec[44])){ $columna45=$columna45*4?>
		     <legend align="left"><?php echo 'La columna AS, <strong> sist_oper </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica, revisar el catálogo correspondiente.'; ?></legend> <?php } else {
				  //detectar si es identificador valido
				  $valida->valida_sistoper($datosdec[42]);	  
	          if($valida>0 && $verifica==1)
                    $columna45=$columna45*3;
	           else {
	             $columna45=$columna45*6; ?>
		<legend align="left"><?php  echo 'La columna AS, <strong> sist_oper </strong> del renglón correpondiente al no.inventario  '.$datosdec[15] .' no es valor válido, revisar catálogo correspondiente.'; ?></legend>
	<?php  }
		 }
		 }
	?> 
                    
      <?php if ($datosdec[45]==NULL) {$columna46=0;?>
		     <legend align="left"> <?php echo 'La columna AT, <strong> version_sist_oper </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php } else{
	   if(is_int($datosdec[45])) $columna46=$columna46*8; else $columna46=$columna46*5;
	  
	     }
		 
        if ($datosdec[46]==NULL) { $columna47=0;?>
		      <legend align="left"><?php echo 'La columna AU, <strong> licencia </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
	  <?php } else { ?>
      <?php if (!preg_match("/^[0-9]+$/",$datosdec[46])){ $columna47=2;?>
		     <legend align="left"> <?php echo 'La columna AU, <strong> licencia </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>
			 <?php } else $columna47=1; 
	  }?>
       <?php if ($datosdec[47]==NULL) { $columna48=0;?>
		      <legend align="left"><?php echo 'La columna AV, <strong> licencia_ini </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>            
	  <?php } else {?>
      <?php if (!preg_match("/^[0-9]+$/",$datosdec[47])){ $columna48=2;?>
		     <legend align="left"> <?php //echo 'El formato de fecha de la columna AV, <strong> licencia_ini </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es incorrecto.'; ?></legend>
      <?php }  else $columna48=1; 
	  }?>
      
      <?php if ($datosdec[48]==NULL) { $columna49=0;?>
		      <legend align="left">  <?php echo 'La columna AW, <strong> licencia_fin </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
        <?php } else{
		if(!preg_match($regexFecha,$datosdec[48])) { $columna49=2; ?>
        
		     <legend align="left"><?php //echo 'El formato de fecha de la columna AW, <strong> licencia_fin </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es incorrecto.'; ?></legend>
        <?php } else $columna49=3;
		   }?>
           
         <?php if ($datosdec[49]==NULL) { $columna50=0;?>
		       <legend align="left"> <?php echo 'La columna AX, <strong> id_edificio </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>  
			<?php } else{?> 
              <?php if (!preg_match("/^[0-9]+$/",$datosdec[49])){ $columna50=2;?>
		      <legend align="left"> <?php echo 'La columna AX, <strong> id_edificio </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>    
              
               <?php } else $columna50=1; 
			}?>  
               
             <?php if ($datosdec[50]==NULL) { $columna51=0;?>
		      <legend align="left"> <?php echo 'La columna AY, <strong> id_lab </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria y numérica.'; ?></legend>        
             <?php }else{
				 
				 if (!preg_match("/^[0-9]+$/",$datosdec[50])){ $columna51=2;?>
		      <legend align="left"> <?php echo 'La columna AX, <strong> id_lab </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>    
               <?php } else{ // que sea laboratorio de la div
				      $querylab="SELECT * FROM laboratorios l
                                   JOIN departamentos d
                                   ON d.id_dep=l.id_dep
                                   WHERE id_div=".$_SESSION['id_div'].
					               " AND l.id_lab=".$datosdec[50];
			         // echo $querylab;
		              $existelab= pg_query($querylab) or die('Hubo un error con la base de datos');		
			
	    	          $cuantos=pg_num_rows($existelab);
					  if ($cuantos==0){
					      $columna51=3;
						  $sinlab++; ?>
						  <legend align="left"> <?php echo 'El laboratorio  <strong> id_lab </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' no existe .'; ?></legend>    
					<?php  }else{
		               $columna51=1;
					   
					  }
				  }
			
			 }
			 
			
	   $busca=buscaBienes($datosdec); // si no  lo encuentra lo registra en errores
		//echo 'buscabien', $busca;	
		
		if ($busca==NULL)
		    $bnid=0;
		else 	
		    $bnid=$busca;
		
			
          //Traer el último valor en errorinserta
			        $queryd="SELECT max(id_error) FROM errorinserta";
                   // $registrod= pg_query($con,$queryd);
				    $registrod= pg_query($queryd) or die('Hubo un error con la base de datosdec');
                    $ultimo= pg_fetch_array($registrod);
	
		      if ($ultimo[0]==0)
				    $ultimo=1;//inicializando la tabla dispositivouno
			  else 
			        $ultimo=$ultimo[0]+1;
					
	   if (isset($inventario) || isset($dispclave)){
	         $query= "INSERT INTO errorinserta(id_error,tupla,inventario,bnid,dispositivo_clave,columna1,columna2,columna3,columna4,columna5,
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
										 ($ultimo,$noo,'$inventario',$bnid,$dispclave,$columna1,$columna2,$columna3,$columna4,$columna5,
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
	   // 
	  
	  //
	  try {
			 $result=@pg_query($query); 
	   $resulta =@pg_fetch_assoc($result);
  
        } catch (Exception $e) {
        /* Podemos finalizar la ejecución con un mensaje o mostrar HTML con él */
           die('Error modificando producto: ' .  $e->getMessage());
       }
		  
	   echo 'consulta'. $query;
       //$r = pg_fetch_array($resulta);
		//$result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);*/
		 

	   }
	    if (!$resulta) 
				 $errorinserta++; 
		//$this->tupla[]=$datosdec;	 
      
       } //fin marcaerror

function exportaErrorReg($noval){
	//Exporta  errores de datos en las columnas  
				$queryreg="SELECT ei.inventario FROM errorinserta ei
                     JOIN registroerror re
                     ON ei.inventario=re.inventario
                     WHERE tipoerror='r'
					 AND date(fecharegistro)= current_date
					 AND bnid!=0
					 AND id_div=" . $_SESSION['id_div'];
				//AND bnid!=0	 
	    $result = pg_query($queryreg) or die('Hubo un error con la base de datos');
	    $errorreg= pg_num_rows($result); 
		//echo $queryreg;	
		?>
        
         <br>
           <legend align="left"> <h4><?php echo "Se intentó importar  " .$errorreg ." dispositivos que no cumplen con los requisitos. "  ?></h4></legend> 
   
           <br>
                <form action="../inc/erroresreg.inc.php" method="post" name="erroresreg" >
	               <legend align="left"><input name="enviar" type="submit" value="Exportar a Excel" />
                   <input name="tipo" type="hidden" value="erroresreg" /></legend>
	            </form>
           <br>
	<?php   
	} //finaliza funcion exportaErrorReg
	
function exportaErrorRegAct(){
	//Exporta  errores de datos en las columnas  
		
					 
			$queryreg="SELECT ei.inventario FROM errorinserta ei
                     JOIN registroerror re
                     ON ei.inventario=re.inventario
                     WHERE tipoerror='ra'
					 AND date(fecharegistro)= current_date
					 AND bnid!=0
					 AND id_div=" . $_SESSION['id_div'];
					 
	    $result = pg_query($queryreg) or die('Hubo un error con la base de datos');
	    $errorreg= pg_num_rows($result); 	
		
		?>
        
         <br>
           <legend align="left"> <h4><?php echo "Se intentó actualizar  " . $errorreg ." dispositivos que no cumplen con los requisitos. " ?></h4></legend> 
   
           <br>
                <form action="../inc/erroresreg.inc.php" method="post" name="actreg" >
	               <legend align="left">
                    <input name="enviar" type="submit" value="Exportar a Excel" />
                    <input name="tipo" type="hidden" value="actreg" /></legend>
	            </form>
           <br>
	<?php   
	} //finaliza funcion exportaErrorReg	

function exportaErrorBien(){
	//Exporta  errores de datos si no existen en bienes inventario  
	
		$querybien="SELECT ei.inventario FROM errorinserta ei
                     JOIN registroerror re
                     ON ei.inventario=re.inventario
                     WHERE tipoerror='b'
					 AND date(fecharegistro)= current_date
		             AND id_div=" . $_SESSION['id_div'];
		//echo $queryreg;			 
	    $result = pg_query($querybien) or die('Hubo un error con la base de datos');
	    $errorbien= pg_num_rows($result); 	
	?>
   
	      <br> 
           <legend align="left"> <h4><?php echo "Se intentó registrar  " . $errorbien ." dispositivos que no se encuentran en el inventario de la facultad." ?></h4> </legend>
          <br>
	       <form action="../inc/erroresbn.inc.php" method="post" name="erroresbn" >
	                 <legend align="left"><input name="enviar" type="submit" value="Exportar a Excel" />
                     <input name="tipo" type="hidden" value="erroresbn" />
                     </legend>
	          </form>
          <br>
	<?php   
	 
	} //finaliza funcion exportaErrorBien
	
function exportaErrorBienAct(){
	//Exporta  errores de datos si no existen en bienes inventario  
	
		$queryreg="SELECT ei.inventario FROM errorinserta ei
                   JOIN registroerror re
                   ON ei.inventario=re.inventario
                   WHERE tipoerror='ba'
				   AND date(fecharegistro)= current_date
				   AND id_div=" . $_SESSION['id_div'];
					 
	    $result = pg_query($queryreg) or die('Hubo un error con la base de datos');
	    $errorreg= pg_num_rows($result); 	
		echo $queryreg;
	?>
   
	      <br> 
           <legend align="left"> <h4><?php echo "Se intentó actualizar  " . $errorreg ." dispositivos que no se encuentran en el inventario de la facultad." ?></h4> </legend>
          <br>
	       <form action="../inc/erroresbn.inc.php" method="post" name="actbn" >
	                 <legend align="left"><input name="enviar" type="submit" value="Exportar a Excel" />
                     <input name="tipo" type="hidden" value="actbn" /></legend>
	          </form>
          <br>
	<?php   
	 
	} //finaliza funcion exportaErrorBien
	
function &buscaBienes($datosdec){
	
		//echo 'valores en buscabienes'. $invent;
	          
		     // Buscar en bienes 
			 
			 $queryb="SELECT bn_id
							  FROM bienes
			                  WHERE bn_clave="."'".$datosdec[15]."'" . "
							  OR bn_anterior="."'".$datosdec[15]."'";
			// echo $queryb;
			 			  
			  $registrob= @pg_query($queryb) or die('ERROR  en errorinserta'); 
              $bienes= pg_fetch_array($registrob);
			  $ebien=$bienes[0];
			
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
		  
			return $ebien;
        }//fin función buscaBienes
	
function errorReg(){
	 $queryd="SELECT max(id_error) FROM registroerror";
                    $registrod= pg_query($queryd) or die('Hubo un error con la base de datos');
                    $ultimo= pg_fetch_array($registrod);
	
		         if ($ultimo[0]==0)
				    $ultimo=1;
			     else 
			        $ultimo=$ultimo[0]+1;
		   
		          $querybien="INSERT INTO registroerror(id_error,inventario,clave_dispositivo,fecharegistro,id_div,tipoerror)
			                         VALUES (%d,'%s',%d,'%s',%d,'%s')";
						   
			      $queryerror=sprintf($querybien,$ultimo,$datosdec[15],$datosdec[0],date('Y-m-d H:i:s'),$_SESSION['id_div'],'r' );
			   			 
			      $registroerror= pg_query($queryerror)or die('Hubo un error con la base de datos');
		
	}
	
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
   } //fin de busca bienes

	}		  
			?>