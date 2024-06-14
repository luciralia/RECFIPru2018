
<?php 
require_once('../inc/sesion.inc.php');
require_once('../conexion.php');
require_once('../clases/importa.class.php');
require_once('../clases/inventario.class.php');
require_once('../clases/log.class.php');


$logger=new Log();

$logger->putLog(8,2);

session_start(); 

$marca=new importa();

$botonReg=new importa();
$botonBien=new importa();
$valida=new importa();
$error=new importa();
$verifica = new inventario();


$querydt="DELETE FROM errorinserta";	
$result = pg_query($querydt) or die('Hubo un error con la base de datos');

$querypre="DELETE FROM registroerror re
	       WHERE date(fecharegistro)= current_date
		   AND id_div=" . $_SESSION['id_div'];
$result = pg_query($querypre) or die('Hubo un error con la base de datos');	

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
  <td width="800" height="30" colspan="2" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
     <input  type="submit" value="Importar2">&nbsp;
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
  $noo=1;
  $errorimp=0;
  $errorbien=0;
  $importa=0;
  $errorinserta=0;
  $novalido=0;
  $regvalido=0;
  $nuncaimpor=0;
  $nunca=0;
  $preimpor=0;
  $sinlab=0;
//print_r($_SESSION);
 
if($size > 0){
 
 if((pathinfo(basename($file_upload),PATHINFO_EXTENSION)=='txt')){
 
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
		  //echo 	$querytemp;	  
		  $datostemp = pg_query($querytemp);
		  
		  $importado=pg_num_rows($datostemp);
		   
		  if ($importado>0) {
			  
			       //puede haber sido previamente importado o nunca importado
			       $queryimp="SELECT * FROM dispositivo WHERE 
		              inventario="."'".$datosdec[15]."'". " AND importa=1";	
					    
			     // echo $queryimp;  
				  $datosimp = pg_query($queryimp);
		  
		          $nunca=pg_num_rows($datosimp);
					
				  if ($nunca<0) {
				      echo 'ENTRO'.$datosdec[15];
				      $nunca++;
				  }else { 	
		         /*  $updatequery= "UPDATE dispositivo SET inventario='%s'
			                      WHERE inventario="."'".$datosdec[15]."'";
							  
			        $queryu=sprintf($updatequery,$datosdec[15] ); 
			        $result=pg_query($queryu) or die('ERROR AL ACTUALIZAR dispositivo '); */
			        $preimpor++; ?>
					 <legend align="left"> <strong><?php echo "Se importó previamente el dispositivo con número de inventario " . $datosdec[15]; ?></strong></legend> 
			       
		   <?php 
				}
		} else { 
	       if ($datosdec[15]!=NULL){
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
			if ($datosdec[13]==NULL ) { $columna14=0; ?>
		      <legend align="left"><?php  echo 'La columna N, <strong> no_factura </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php }  if ($datosdec[13]==NULL) { $columna14=0; ?>
				 <legend align="left"><?php  echo 'La columna N, <strong> no_factura </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' Debe ser obligatoria.'; ?></legend>					 <?php } else $columna14=2; 
			   if(is_int($datosdec[13])) $columna14=1; else $columna14=2; 
	  
	  if ($datosdec[14]==NULL) { $columna15=0;?>
		      <legend align="left"><?php echo 'La columna O, <strong> años garantía </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>
      <?php }else {
		  if(!preg_match("/^[0-9]+$/",$datosdec[14])){$columna15=1; ?>
		  <legend align="left"><?php  echo 'La columna O, <strong> años garantía </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser númerica.'; ?></legend>
		<?php   }
		  else $columna15=2; 
	 
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
		     <legend align="left"><?php  echo 'La columna R, <strong> proveedor_p </strong>del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>  
	  <?php } else{
		  if(is_int($datosdec[17])) $columna18=1; else $columna18=2; 
	  }
	  	  if ($datosdec[18]==NULL) { $columna19=0;?>
		     <legend align="left"> <?php echo 'La columna S, <strong> fecha_factura </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria..'; ?></legend>
      <?php }else{ 
		  if(!preg_match($regexFecha,$datosdec[18])) $columna19=2; else $columna19=3;
	  }
         
	 ?>	
      
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
            <?php } else {?>
            
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
           
         <?php if ($datosdec[64]==NULL) { $columna65=0;//id_edif?>
		       <legend align="left"> <?php echo 'La columna BI, <strong> id_edificio </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria.'; ?></legend>  
			<?php } else{?> 
              <?php if (!preg_match("/^[0-9]+$/",$datosdec[64])){ $columna65=2;?>
		      <legend align="left"> <?php echo 'La columna BI, <strong> id_edificio </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>    
              
               <?php } else $columna65=1; 
			}?>  
               
             <?php if ($datosdec[65]==NULL) { $columna61=0;?>
		      <legend align="left"> <?php echo 'La columna AY, <strong> id_lab </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' es obligatoria y numérica.'; ?></legend>        
             <?php }else{
				 
				 if (!preg_match("/^[0-9]+$/",$datosdec[65])){ $columna66=2;?>
		      <legend align="left"> <?php echo 'La columna AX, <strong> id_lab </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' debe ser numérica.'; ?></legend>    
               <?php } else{ // que sea laboratorio de la div
				      $querylab="SELECT * FROM laboratorios l
                                   JOIN departamentos d
                                   ON d.id_dep=l.id_dep
                                   WHERE id_div=".$_SESSION['id_div'].
					               " AND l.id_lab=".$datosdec[65];
			         // echo $querylab;
		              $existelab= pg_query($querylab) or die('Hubo un error con la base de datos');		
			
	    	          $cuantos=pg_num_rows($existelab);
					  if ($cuantos==0){
					      $columna66=3;
						  $sinlab++; ?>
						  <legend align="left"> <?php echo 'El laboratorio  <strong> id_lab </strong> del renglón correpondiente al no.inventario  '.$datosdec[15].' no existe .'; ?></legend>    
					<?php  }else{
		               $columna66=1;
					   
					  }
				  }
			 }
			 }
			  $columna50=0;$columna51=0;
              $columna52=0;$columna53=0;
			  $columna54=0;$columna55=0;
			  $columna56=0;$columna57=0;
			  $columna58=0;$columna59=0;		  

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
                    $ultimoei= pg_fetch_array($registrod);
	
		      if ($ultimoei[0]==0)
				    $ultimoei=1;//inicializando la tabla dispositivouno
			  else 
			        $ultimoei=$ultimoei[0]+1;
					
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
										 columna51,columna52,columna53,columna54,columna55,
										 columna56,columna57,columna58,columna59,columna60,
										 columna61) VALUES 
										 ($ultimoei,$noo,'$inventario',$bnid,$dispclave,$columna1,$columna2,$columna3,$columna4,$columna5,
										 $columna6,$columna7,$columna8,$columna9,$columna10,
	                                     $columna11,NULL,$columna13,$columna14,$columna15,
										 $columna16,$columna17,$columna18,$columna19,NULL,
										 $columna21,$columna22,$columna23,$columna24,$columna25,
										 NULL,$columna27,NULL,$columna29,$columna30,
										 $columna31,$columna32,$columna33,$columna34,$columna35,
										 $columna36,$columna37,$columna38,$columna39,$columna40,
										 $columna41,$columna42,$columna43,NULL,$columna45,
										 $columna46,$columna47,$columna48,$columna49,$columna50,
							             $columna51,$columna52,$columna53,$columna54,$columna55,
										 $columna56,$columna57,$columna58,$columna59,$columna65,
										 $columna66)";
		
		//echo 'Query ERROR INSERTA '. $query;
		   
	    $result=@pg_query($query) or die('ERROR AL INSERTAR en errorinserta'); 
	   }
	    if (!$result) 
				 $errorinserta++;
		
				$queryerror="SELECT * FROM errorinserta 
	                 WHERE tupla=" . $cuenta .
				   " AND columna1=3 AND columna2=3 
				     AND columna3=3 AND columna4=3 
					 AND columna5=3
				     AND columna10=3 AND columna11=3
					 AND columna16!=0 AND columna17!=0
					 AND columna21!=0 AND columna22!=0
					 AND columna30!=2 AND columna31!=2
			         AND columna32!=2 AND columna33!=2 
					 AND columna34!=2 AND columna35!=2
				     AND columna36!=2 AND columna37!=2 
					 AND columna46!=0 AND columna47!=0
					 
					 ";
			 //nuevas columnas de importación 64 y 65 Edificio y lab  
			  //--AND columna64!=0 AND columna65=1
	        $result = pg_query($queryerror) or die('Hubo un error con la base de datos');
	        $error= pg_num_rows($result); 
	  //echo 'errorno',$error;
	  // echo 'bien'. $bienes[0].  'error'.$error;
			
	 if ($error>0 ){
		 
	  $regvalido++;
	 
	  if ($busca!=NULL){
	
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
							
							  
              $registroe= pg_query($querye) or die('ERROR ...');
              $equipoc= pg_fetch_array($registroe);
			// EL INDICEDELAB  CAMBIO
			  if($datosdec[65]==0) // id id_lab=0
			     $lab=$equipoc[0];
			  else 	 
			     $lab=$datosdec[65];
		  
		      $estadobien=$datosdec[60];
				
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
			                  WHERE id_lab=" . $datosdec[65]; 
				//echo $queryd;			  
              $registrod= pg_query($queryd) or die('ERROR ...');
              $detalle= pg_fetch_array($registrod);	

              $updatequery= "UPDATE laboratorios SET detalle_ubcomp= '%s'
			                  WHERE id_lab=" .$datosdec[65];
			   
		      //REVISAR GUARDE BIEN EL DETALLE LAB
			  $queryu=sprintf($updatequery, $detalle[0] || ' ' || $datosdec[8] ); //usuario_ubicacion
			   
              $result=pg_query($queryu) or die('ERROR AL ACTUALIZAR laboratorios');
			  		
					
			  /*if ($datosdec[13]=='')
			      $datosdec[13]='  ';
			  if ($datosdec[14]=='')
			      $datosdec[14]='  ';  
			  if ($datosdec[18]=='')
			      $datosdec[18]=0;	*/  
			  if ($datosdec[18]==0) //fecha_factura
			      $datosdec[18]= date("Y-m-d H:i:s", strtotime($datosdec[18]));
			  if ($datosdec[47]==0) //fecha Inicio_lic
			      $datosdec[47]= date("Y-m-d H:i:s", strtotime($datosdec[47]));	  
              if ($datosdec[48]==0) //fecha IFin_lic
			      $datosdec[48]= date("Y-m-d H:i:s", strtotime($datosdec[48]));	
				  		
	     
			 $strqueryd="INSERT INTO dispositivo (id_dispositivo,bn_id,id_lab,
              dispositivo_clave,usuario_final_clave,familia_clave,
              tipo_ram_clave,tecnologia_clave,nombre_resguardo,resguardo_no_empleado,
              usuario_nombre,usuario_ubicacion,usuario_perfil, 
              usuario_sector,serie,marca_p, 
              no_factura,anos_garantia,inventario, 
              modelo_p,proveedor_p,fecha_factura,
              familia_especificar,modelo_procesador,cantidad_procesador,
              nucleos_totales,nucleos_gpu,memoria_ram,
              ram_especificar,num_elementos_almac,total_almac,
              num_arreglos,esquema_uno,esquema_dos,
              esquema_tres,esquema_cuatro,tec_uno, 
              tec_dos,tec_tres,tec_cuatro,
              subtotal_uno,subtotal_dos,subtotal_tres,
              subtotal_cuatro,arreglo_total,tec_com, 
              tec_com_otro,sist_oper,version_sist_oper,
              licencia,licencia_ini,licencia_fin,
			  fecha,velocidad,memcache,
              tipotarjvideo,modelotarjvideo,memoriavideo,
              equipoaltorend,accesorios,garantiamanten,
              arquitectura,estadobien,servidor,
              descextensa,id_marca,marca,
			  marca_esp,id_mem_ram,id_mod,
			  importa
              )
			 

		      VALUES (%d,%d,%d,   --id_dispositivo,bn_id,id_lab,
		           %d,%d,%d,      --dispositivo_clave,usuario_final_clave,familia_clave,
				   %d,%d,'%s',%d, --tipo_ram_clave,tecnologia_clave,nombre_resguardo,resguardo_no_empleado,
				   '%s','%s',%d,  --usuario_nombre,usuario_ubicacion,usuario_perfil,
				   %d,'%s','%s',  --usuario_sector,serie,marca_p, 
				   '%s','%s','%s',--no_factura,anos_garantia,inventario, 
				   '%s','%s','%s',--modelo_p,proveedor_p,fecha_factura,
				   '%s','%s','%s',--familia_especificar,modelo_procesador,cantidad_procesador,	
				   '%s','%s','%s',--nucleos_totales,nucleos_gpu,memoria_ram, 
				   '%s',%d,%d,    --ram_especificar,num_elementos_almac,total_almac,
				   %d,%d,%d,      --num_arreglos,esquema_uno,esquema_dos,
				   %d,%d,%d,      --esquema_tres,esquema_cuatro,tec_uno,
				   %d,%d,%d,      --tec_dos,tec_tres,tec_cuatro,
				   %d,%d,%d,      --subtotal_uno,subtotal_dos,subtotal_tres,
				   %d,%d,%d,      --subtotal_cuatro,arreglo_total,tec_com,
				  '%s',%d,'%s',   --tec_com_otro,sist_oper,version_sist_oper,   
				   %d,'%s','%s',  --licencia,licencia_ini,licencia_fin,
				   '%s','%s','%s',--fecha,velocidad,memcache,
				   '%s','%s','%s',--tipotarjvideo,modelotarjvideo,memoriavideo,
				   '%s','%s','%s',--equipoaltorend,accesorios,garantiamanten,
				   '%s','%s','%s',--arquitectura,estadobien,servidor,
				   '%s',%d,'%s',  --descextensa,id_marca,marca
				   '%s',%d,%d,    --marca_esp,id_mem_ram,id_mod
				    %d    --importa
				  )";
				   
            $queryid=sprintf($strqueryd,$ultimo,$busca,$lab,    //id_dispositivo,bn_id,id_lab,
            $datosdec[0],$datosdec[1],$datosdec[2], //dispositivo_clave,usuario_final_clave,familia_clave,
			$datosdec[3],$datosdec[4],$datosdec[5],$datosdec[6],//Son 4
            $datosdec[7],$datosdec[8],$datosdec[9], //usuario_nombre,usuario_ubicacion,usuario_perfil,
			$datosdec[10],$datosdec[11],$datosdec[12],//usuario_sector,serie,marca_p, 
			$datosdec[13],$datosdec[14],$datosdec[15],//no_factura,anos_garantia,inventario,
            $datosdec[16],$datosdec[17],$datosdec[18],//modelo_p,proveedor_p,fecha_factura, 
            $datosdec[19],$datosdec[20],$datosdec[21], //familia_especificar,modelo_procesador,cantidad_procesador,
			     $datosdec[22],$datosdec[23],$datosdec[24],//nucleos_totales,nucleos_gpu,memoria_ram,
                 $datosdec[25],$datosdec[26],$datosdec[27],//ram_especificar,num_elementos_almac,total_almac,
			     $datosdec[28],$datosdec[29],$datosdec[30],//num_arreglos,esquema_uno,esquema_dos,
			     $datosdec[31],$datosdec[32],$datosdec[33],//esquema_tres,esquema_cuatro,tec_uno, 
			     $datosdec[34],$datosdec[35],$datosdec[36],//tec_dos,tec_tres,tec_cuatro, 
				 $datosdec[37],$datosdec[38],$datosdec[39],//subtotal_uno,subtotal_dos,subtotal_tres, 
                 $datosdec[40],$datosdec[41],$datosdec[42],//subtotal_cuatro,arreglo_total,tec_com,
			     $datosdec[43],$datosdec[44],$datosdec[45],//tec_com_otro,sist_oper,version_sist_oper,  
			     $datosdec[46],$datosdec[47],$datosdec[48],//licencia,licencia_ini,licencia_fin,
				 date('Y-m-d H:i:s'),$equipoc[1],$equipoc[2], //fecha,velocidad,memcache,
				 $equipoc[3],$equipoc[4],$equipoc[5], //tipotarjvideo,modelotarjvideo,memoriavideo,
				 $equipoc[6],$equipoc[7],$equipoc[8], //equipoaltorend,accesorios,garantiamanten,
                 $equipoc[9],$estadobien,$equipoc[11], //arquitectura,estadobien,servidor,
				 $equipoc[12],$marca[0],$disp['marca'], //descextensa,id_marca,marca
			     NULL,$ram[0],$datosdec[61], 
				 1);    
				                           
				
                //echo 'Query  INSERTA DISPOSITIVO '. $queryid;
		  
		        $result=pg_query($queryid) or die('ERROR AL INSERTAR EN DISPOSITIVO: ' . pg_last_error());
		  
		      
		          if ($result)
					  
			          $importa++;
		  
		 
	             //aqui
		  
		   //  require_once('importa_adicional.inc.php');
		  
	 

 if ($datosdec[0]==1 || $datosdec[0]==2 || $datosdec[0]==3 || $datosdec[0]==4 ||
			 $datosdec[0]==5 || $datosdec[0]==6 || $datosdec[0]==7 ||$datosdec[0]==8 ||
			 $datosdec[0]==17 ||$datosdec[0]==18 ||$datosdec[0]==19 )
				 {
					  
				   //echo 'Inserta MAC';
					  // Obtener última tupla para idmac
			  
			          $mac1=$datosdec[62];
			          echo $mac1;
				   
				      $queryd="SELECT max(id_disp_mac) FROM mac";
                      $registrod= pg_query($queryd) or die('Hubo un error con la base de datos');
                      $umac= pg_fetch_array($registrod);
	
		              if ($umac[0]==0)
						 $umac=1;
			          else 
			             $umac=$umac[0]+1;
				   
				   
					   $querymac="INSERT INTO mac(id_disp_mac,id_dispositivo,mac) VALUES (%d,%d,'%s')";
				       $queryidmac=sprintf($querymac,$umac,$ultimo,$mac1);	
				   
					  // echo 'Query  INSERTA mac1'. $queryidmac;
			            $result=pg_query($queryidmac) or die('ERROR AL INSERTAR EN MAC: ' . pg_last_error());
				        $mac2=$datosdec[63];
			  
			   	      if ($mac2!=NULL && $mac2!=0)
						  {
						  $querymac="INSERT INTO mac(id_disp_mac,id_dispositivo,mac) VALUES (%d,%d,'%s')";
				          $queryidmac=sprintf($querymac,$umac+1, $ultimo,$mac2);	
						    //echo 'Query  INSERTA mac2'. $queryidmac;
						  $result=pg_query($queryidmac) or die('ERROR AL INSERTAR EN MAC: ' . pg_last_error());
						 }
				
		   
			   }//fin de MAC
		  
		   if ($datosdec[0]==10)// si es IMPRESORA
				 {
					  $queryIM="INSERT INTO impresora (id_dispositivo,id_impresora) VALUES (%d,%d)";
				      $queryidIM=sprintf($queryIM,$ultimo,$datosdec[49]);		
					  echo 'Query ERROR INSERTA IMP'. $queryidIM;
					 
                      $result=pg_query($queryidIM) or die('ERROR AL INSERTAR EN IMPRESORA: ' . pg_last_error());
					
			   }//fin de Impresora    
		  
		        if ($datosdec[0]==13)// si es DIGITALIZADOR
				 {
					  $queryDIG="INSERT INTO digitaliza (id_dispositivo,id_digitaliza) VALUES (%d,%d)";
				      $queryidDIG=sprintf($queryDIG, $ultimo, $datosdec[50]);		
					 // echo 'Query ERROR INSERTA DIG'. $queryidDIG;
					 
                      $result=pg_query($queryidDIG) or die('ERROR AL INSERTAR EN DIGITALIZADOR: ' . pg_last_error());
				 }//fin de digitalizador 
		  
		       if ($datosdec[0]==14)// si es access_point
				 {
					  $queryAC="INSERT INTO access (id_dispositivo,id_access) VALUES (%d,%d)";
				      $queryidAC=sprintf($queryAC, $ultimo,$datosdec[51]);	
				   
					  //echo 'Query ERROR INSERTA ACCESS'. $queryidAC;
					 
                      $result=pg_query($queryidAC) or die('ERROR AL INSERTAR EN ACCESS: ' . pg_last_error());
				   
					  // Obtener última tupla para red difunde 
				   
				      $queryd="SELECT max(id_red_dif) FROM red_difunde";
                      $registrod= pg_query($queryd) or die('Hubo un error con la base de datos');
                      $urd= pg_fetch_array($registrod);
	
		              if ($urd[0]==0)
				         $urd=1;
			          else 
			             $urd=$urd[0]+1;
				         $queryACr="INSERT INTO red_difunde(id_red_dif,id_dispositivo,id_tipo_red) VALUES (%d,%d,%d)";
				         $queryidACr=sprintf($queryACr,$urd,$ultimo,$datosdec[52]);	
				         $result=pg_query($queryidACr) or die('ERROR AL INSERTAR EN ACCESS: ' . pg_last_error());
				   
					  //echo 'Query ERROR INSERTA ACCESS'. $queryidAC;
				   
				      if ($datosdec[53]!=0)
						  
					  {   //inserta segunda red difunde, si existe
						  
						  $queryACr="INSERT INTO red_difunde(id_red_dif,id_dispositivo,id_tipo_red) VALUES (%d,%d,%d)";
				          $queryidACr=sprintf($queryACr,$urd+1,$ultimo,$datosdec[53]);	
						  $result=pg_query($queryidACr) or die('ERROR AL INSERTAR EN ACCESS: ' . pg_last_error());
					  }
					 
                      
		   
			   }//fin de access_point
		  
		       if ($datosdec[0]==15)// si es Firewall
				 {
					  $queryFW="INSERT INTO firewall (id_dispositivo,id_tipo_fw) VALUES (%d,%d)";
				      $queryidFW=sprintf($queryAC,$ultimo, $datosdec[54]);	
				   
					 // echo 'Query ERROR INSERTA FIREWALL'. $queryidFW;
					 
                      $result=pg_query($queryidFW) or die('ERROR AL INSERTAR EN FIREWALL: ' . pg_last_error());
					 
					 
		   
			   }//fin de firewall
		       
		        if ($datosdec[0]==21)// si es IDS
				 {
					  $queryIDS="INSERT INTO ids (id_dispositivo,id_tipo_ids) VALUES (%d,%d)";
				      $queryidIDS=sprintf($queryIDS, $ultimo, $datosdec[55]);	
				   
					  //echo 'Query ERROR INSERTA IDS'. $queryidIDS;
					 
                      $result=pg_query($queryidIDS) or die('ERROR AL INSERTAR EN IDS: ' . pg_last_error());
					 
					 
			   }//fin de IDS
		     
		       if ($datosdec[0]==20
				  )// si es IPS
				 {
					  $queryIPS="INSERT INTO ips (id_dispositivo,id_tipo_ips) VALUES (%d,%d)";
				      
				      $queryidIPS=sprintf($queryIPS,$ultimo, $datosdec[56]);	
				   
					 // echo 'Query ERROR INSERTA IPS'. $queryidIPS;
					 
                      $result=pg_query($queryidIPS) or die('ERROR AL INSERTAR EN IPS: ' . pg_last_error());
				}//fin de IDS
		  
		  
		         if ($datosdec[0]==16)// si es switch
				 {
					  $querySW="INSERT INTO switch (id_dispositivo,id_tipo_switch,id_puerto,
                                   id_chasis) VALUES (%d,%d,%d,%d)";
				     
				      $queryidSW=sprintf($querySW, $$ultimo,
					                   $datosdec[57],$datosdec[58],$datosdec[59]);		
					 // echo 'Query ERROR INSERTA SW'. $queryidSW;
					 
                      $result=pg_query($queryidSW) or die('ERROR AL INSERTAR EN SWITCH: ' . pg_last_error());
					
			   }//fin de switch
	
	  }          
		 
		 else $errorbien++;
		 
		 	
	   }else { //error
		    $novalido++;
	       //$error->errorReg();
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
		
		
	      } //error
	   
	     }// else importado
		   
		   $cuenta++;	
		   $noo++;
		 
		
	    }//while para insertar en dispositivo temporal
	 
		fclose($fp);
	    	
	    echo 'novalido '.$novalido;		 
		echo '$errorinserta'.$errorinserta;			 
	    echo 'errorimp'.$errorimp;
	    echo 'errorbien'.$errorbien;
		echo 'cuenta'.$cuenta;
		echo 'registrovalido'.$regvalido;
		echo 'importa'.$importa;
		echo 'nunca'.$nunca;
		echo 'preimporta',$preimpor;
		$cuentaTotal=$cuenta-1;
	       //falta revisar errores de lab
	 
         if ($preimpor==0 && $importa!=0){	?>
           <br>
	           <legend align="left"> <h3><?php echo "Se importaron " . $importa . " / " . $cuentaTotal . " dispositivos."; ?></h3></legend> 
           <br>
		<?php } else { ?> 
          <legend align="left"> <h3><?php echo "Se importaron previamente " . $preimpor . " / " . $cuentaTotal . " dispositivos."; ?> </h3></legend>
          <br>
          <legend align="left"> <h3><?php echo "Se importaron actualmente " . $importa  . " / " . $cuentaTotal . " dispositivos."; ?> </h3></legend>
          <br>
          <?php } if ($sinlab>0 ){	?>
	      <legend align="left"> <h3><?php echo "Tuplas con error por laboratorio inválido: " . $sinlab; ?></h3></legend> 
          <br>
		<?php } ?>
          
          
          <?php if ($novalido > 0 )
		  
		      $botonReg->exportaErrorReg($novalido);
					
			    if ($errorbien >0 )
						 
		            $botonBien->exportaErrorBien();
	
    }else {
		  
  $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']."&div=" .$_SESSION['id_div'];
    echo $direccion;
    header($direccion);
 }
}
?>
	
 
     
		  
		  
		  
		  
		  