<?php 
require_once('../inc/sesion.inc.php');
require_once('../clases/importa.class.php');
require_once('../clases/inventario.class.php');

$cuentaact=0;
$errorbn=0;
$cuenta=1;
$regvalido=0;
$errorinserta=0;
$noimportado=0;
$noo=1;
$sinlab=0;

$marca=new importa();
$botonReg=new importa();
$botonBien=new importa();
$valida=new importa();
$verifica = new inventario();

$querydt="DELETE FROM errorinserta";	
$result = pg_query($querydt) or die('Hubo un error con la base de datos');
$querypre="DELETE FROM registroerror re
	       WHERE date(fecharegistro)= current_date
		   AND id_div=" . $_SESSION['id_div'];
$result = pg_query($querypre) or die('Hubo un error con la base de datos');			 
			 

function buscaBienesAct(&$datosdec){
	
		//echo 'valores en buscabienes'. $datosdec[15];
	          
		     // Buscar en bienes 
			 
			 $queryb="SELECT bn_id
							  FROM bienes
			                  WHERE bn_clave="."'".$datosdec[15]."'" . "
							  OR bn_anterior="."'".$datosdec[15]."'";
			// echo $queryb;
			 			  
			  $registrob= @pg_query($queryb) or die('ERROR  en errorinserta'); 
              $bienes= pg_fetch_array($registrob);
			   $ebien=$bienes[0];
			//echo 'valor bien en funcion',$ebien;	
			  if(pg_num_rows($registrob)==0 ){
				 // echo 'no lo encuentra en bienes';
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
		  
			return $ebien;
			
        }//fin función buscaBienes
	
function utf8_string_array_encode(&$array){
    $func = function(&$value,&$key){
        if(is_string($value)){
            $value = utf8_encode($value);
        } 
        if(is_string($key)){
            $key = utf8_encode($key);
        }
        if(is_array($value)){
            utf8_string_array_encode($value);
        }
    };
    array_walk($array,$func);
    return $array;
}

 ?>



<table width="600" cellspacing="20" cellpadding="20" border="0" class="principal">
<form  method="POST" enctype="multipart/form-data">
 <tr>
   <td width="150" height="30" align="right">Subir archivo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
   <td width="400"><input type="file" name="archivo_txt" id='archivo'></td>
 </tr>

 <tr>
  <td width="800" height="30" colspan="2" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
     <input  type="submit" value="Actualizar">&nbsp;
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
  
//echo $tmp_name;
 if($size > 0){
 
if((pathinfo(basename($file_upload),PATHINFO_EXTENSION)=='txt')){
 
     $fp = fopen($tmp_name, "r");
   
     // Procesamos linea a linea el archivo  y 
     // lo insertamos en la base de datos
	 
	
	 ?>
      <table>
      <?php 
     while($datos = fgetcsv ($fp, 1000, "\t")){
		
		  $datosdec=utf8_string_array_encode($datos); 
		  
	      $querytemp="SELECT * FROM dispositivo WHERE 
		              inventario="."'".$datosdec[15]."'"; //previos importados	
		  //echo $querytemp;
		  $datostemp = pg_query($con,$querytemp);
		   
		if (pg_num_rows($datostemp)==0) { 
			 
		           /*$updatequery= "UPDATE dispositivo SET inventario='%s'
			                  WHERE inventario="."'".$datosdec[15]."'";
							  
			        $queryu=sprintf($updatequery, $datosdec[15] ); 
			   
                    $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR dispositivo'); */ ?>
                    
					 <legend align="left"> <strong><?php echo "No se ha importado el dispositivo con número de inventario " . $datosdec[15]; ?></strong></legend> 
		<?php 	   $noimportado++;  
		  } else { 
		   
	       //detectar errores 
		
         //muestra errores y verifica valor en catálogo
	      //print_r($datos);
		  //$marca->marcaError($datos);
		  //catálogos
		   $columna1=1; $columna2=1; $columna3=1;$columna4=1; $columna5=1;
		  $columna10=1; $columna11=1; $columna43=1; $columna45=1; $columna46=1;
		 
          $regexFecha = '/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/';
          //echo'Valores de entrada marca error';
          // print_r($datosdec);
		 
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
       

	   $busca=buscaBienesAct($datosdec); // si no  lo encuentra lo registra en errores
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
	    $result=@pg_query($query) or die('ERROR AL INSERTAR en errorinserta'); 
	   }
	    if (!$result) 
				 $errorinserta++;
				 
	         $result=@pg_query($query) or die('ERROR AL INSERTAR en errorinserta'); 
			 
			 
	   	     $queryb="SELECT bn_id
							  FROM bienes
			                  WHERE bn_clave="."'".$datosdec[15]."'" . "
							  OR bn_anterior="."'".$datosdec[15]."'";
			
			 				  
			  $registrob= pg_query($queryb) or die('ERROR  en bienes'); 
              $bienes= pg_fetch_array($registrob);
			
		
		//valida identificadores de catálogos';	
			/*$queryerror="SELECT * FROM errorinserta 
	                 WHERE tupla=" . $cuenta .
				   " AND columna9!=0
				     AND columna16!=0 AND columna17!=0
					 AND columna18!=0 AND columna19!=0
					 AND columna21!=0 AND columna22!=0
					 AND columna30!=2 AND columna31!=2
			         AND columna32!=2 AND columna33!=2 
					 AND columna34!=2 AND columna35!=2
				     AND columna36!=2 AND columna37!=2 
					 AND columna46!=0 AND columna47!=0
					 AND columna48!=0 AND columna49!=0
					 AND columna50!=0 AND columna51=1
					 ";*/
					 
					$queryerror="SELECT * FROM errorinserta 
	                 WHERE tupla=" . $cuenta .
				   " AND columna1=3 AND columna2=3 
				     AND columna3=3 AND columna4=3 
					 AND columna5=3
				     AND columna10=3 AND columna11=3
					 AND columna16!=0 AND columna17!=0
					 AND columna19!=0
					 AND columna21!=0 AND columna22!=0
					 AND columna30!=2 AND columna31!=2
			         AND columna32!=2 AND columna33!=2 
					 AND columna34!=2 AND columna35!=2
				     AND columna36!=2 AND columna37!=2 
					 AND columna46!=0 AND columna47!=0
					
					 AND columna50!=0 AND columna51=1
					 ";
			 
				 
		//echo $queryerror;	 
	   $result = pg_query($queryerror) or die('Hubo un error con la base de datos');
	   $error= pg_num_rows($result); 
	
		   // si hay error no actualiza, revisa que exista en bienes
		  // echo 'bien'. $bienes[0].  'error'.$error;
		    if ( $error>0) {
			  $regvalido++;
			if  ($busca!=NULL){
	       
		     //Revisa que el lab sea de la división(por lo del Censo 2017)
					
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
							
              $registroe= pg_query($querye) or die('ERROR ...');
              $equipoc= pg_fetch_array($registroe);
			 
			  if($datosdec[50]==0) // id id_lab=0
			     $lab=$equipoc[0];
			  else 	 
			     $lab=$datosdec[50];
				
			 	
				
			  if ($datosdec[18]==0) 
			      $datosdec[18]= date("Y-m-d", strtotime($datosdec[18]));
			  if ($datosdec[47]==0) 
			      $datosdec[47]= date("Y-m-d", strtotime($datosdec[47]));	  
              if ($datosdec[48]==0) 
			      $datosdec[48]= date("Y-m-d", strtotime($datosdec[48]));	
		   
		     // print_r($datosdec);
		   	  $updatequery= "UPDATE dispositivo SET bn_id=%d,id_lab=%d,
			  dispositivo_clave=%d,usuario_final_clave=%d,familia_clave=%d,
			 tipo_ram_clave=%d,tecnologia_clave=%d,nombre_resguardo='%s',
			 resguardo_no_empleado=%d,usuario_nombre='%s',usuario_ubicacion='%s',
			 usuario_perfil=%d,usuario_sector=%d,serie='%s',
			 marca_p='%s',no_factura='%s',anos_garantia='%s',
			 inventario='%s',modelo_p='%s',proveedor_p='%s',
             fecha_factura='%s',familia_especificar='%s',modelo_procesador='%s',
			 cantidad_procesador='%s',nucleos_totales='%s',nucleos_gpu='%s',
			 memoria_ram='%s',ram_especificar='%s',num_elementos_almac=%d,
			 total_almac=%d,num_arreglos=%d,
			 esquema_uno=%d,esquema_dos=%d,esquema_tres=%d,esquema_cuatro=%d,
			 tec_uno=%d,tec_dos=%d,tec_tres=%d,tec_cuatro=%d,
		     subtotal_uno=%d,subtotal_dos=%d,subtotal_tres=%d,subtotal_cuatro=%d,
		     arreglo_total=%d,tec_com=%d, tec_com_otro='%s',
		     sist_oper=%d, version_sist_oper='%s',
		     licencia=%d,licencia_ini='%s',licencia_fin='%s',fecha='%s',importa=%d
			  WHERE inventario="."'".$datosdec[15]."'";
				
					//echo $updatequery;		  
					$queryu=sprintf($updatequery, $bienes[0],$lab,
					                $datosdec[0],$datosdec[1], $datosdec[2],
									$datosdec[3],$datosdec[4],$datosdec[5],
									$datosdec[6],$datosdec[7],$datosdec[8],
									$datosdec[9],$datosdec[10],$datosdec[11],
									$datosdec[12],$datosdec[13],$datosdec[14],
									$datosdec[15],$datosdec[16],$datosdec[17],
									$datosdec[18],$datosdec[19],$datosdec[20],
									$datosdec[21],$datosdec[22],$datosdec[23],
									$datosdec[24],$datosdec[25],$datosdec[26],
									$datosdec[27],$datosdec[28],
									$datosdec[29],$datosdec[30],$datosdec[31],$datosdec[32],
									$datosdec[33],$datosdec[34],$datosdec[35],$datosdec[36],
									$datosdec[37],$datosdec[38],$datosdec[39],$datosdec[40],
									$datosdec[41],$datosdec[42],$datosdec[43],
									$datosdec[44],$datosdec[45],
									$datosdec[46],$datosdec[47],$datosdec[48],date("Y-m-d"),2); 
			     //  echo $queryu;
			   
                    $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR tupla en dispositivo'); 
					
					if (!$result) 
						
					     $noseact++;
					 else
						
 		                  $cuentaact++;
					 
		        }
				/*else 
				   { echo 'error de bienes inv';// fin de la validación cuando si existe en BIENES INVENTARIO    
				   $errorbn++;
				
				   }*/
				
			}else {
		                    
					$novalido++;	
					$queryd="SELECT max(id_error) FROM registroerror";
                    $registrod= pg_query($queryd) or die('Hubo un error con la base de datos');
                    $ultimo= pg_fetch_array($registrod);
	
		         if ($ultimo[0]==0)
				    $ultimo=1;
			     else 
			        $ultimo=$ultimo[0]+1;
		   
		          $querybien="INSERT INTO registroerror(id_error,inventario,clave_dispositivo,fecharegistro,id_div,tipoerror)
			                         VALUES (%d,'%s',%d,'%s',%d,'%s')";
						   
			      $queryerror=sprintf($querybien,$ultimo,$datosdec[15],$datosdec[0],date('Y-m-d H:i:s'),$_SESSION['id_div'],'ra' );
			   			 
			      $registroerror= pg_query($queryerror)or die('Hubo un error con la base de datos');
		
			           
				
			  }//else valoree esrrores de registro
		//$cuenta++;
		
		   } // else pg_num_rows($datostemp)>0 fin de la validación cuando si existe en BIENES INVENTARIO
		   $cuenta++;
		   $noo++;
		}//fin de while para insertar datos en dispositivo 
		
		echo 'nunca'.$noimportado;
        echo 'cuentaact'.$cuentaact;
		echo 'novalido'.$novalido;
		echo 'regvalido'.$regvalido;
		echo 'errorinserta'.$errorinserta;
		echo 'errorbn'.$errorbn;
		echo  'novalido'.$novalido;
		
		$cuentaTotal=$cuenta-1;
		
		?>
		 <legend align="left"> <h4><?php echo "Se actualizaron " . $cuentaact . " / " . $cuentaTotal . " dispositivos."; ?></h4> </legend>
         <br>
         <?php   if ($noimportado>0 ){	?>
	      <legend align="left"> <h4><?php echo "Se intentó actualizar  " . $noimportado . " dispositivos que no se han importado previamente"; ?></h4></legend> 
          <br>
		<?php } ?>
        <?php   if ($sinlab>0 ){	?>
	      <legend align="left"> <h3><?php echo "Tuplas con error por laboratorio inválido " . $sinlab; ?></h3></legend> 
          <br>
		<?php } ?>
          
          <?php if ($novalido >0 && $cuentaact!=0)
		  
		              $botonReg->exportaErrorRegAct();
			  
			  	
				if ($conteorrorbn >0 && $cuentaact!=0)
						 
		              $botonBien->exportaErrorBienAct();
}else {?>

  <div id="bgalerta"></div><div id="advertencia" style="box-shadow: 10px 10px 30px #000000;"><p>Tipo de archivo incorrecto</p><div id="boton1"><a href="../view/inicio.html.php?mod=<?php echo $_GET['mod'];?>&div=<?php echo $_SESSION['id_div'];?>">Cerrar</a></div></div>
 <!-- <legend align="center"><?php //echo "Tipo de archivo incorrecto"; ?></legend> -->      

<?php 

 }


	
} // existe>0

 //size >0
		?>
