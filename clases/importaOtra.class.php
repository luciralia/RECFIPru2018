<?php

require_once('../conexion.php');
require_once('../inc/sesion.inc.php');

class importa{


function detectaError(){
	
	    $cuenta=1;
	    $querydet="SELECT * FROM dispositivotemp";
		
		$datosdet = pg_query($querydet)or die('Hubo un error con la base de datos con la tabla dispositivotemp');
		
		while ($valida = pg_fetch_array($datosdet, NULL,PGSQL_ASSOC)) 
		{ 
	    // print_r($valida);
	
		 //detectando el tipo de error
		 
		   if($valida['id_lab']=='0' ){
			       /*$querye="SELECT id_lab
							  FROM equipoc
			                  WHERE inventario="."'".$valida['inventario']."'";*/
							  
					$querye="SELECT ec.id_lab
							  FROM equipoc ec
							  JOIN laboratorios l
							  ON l.id_lab=ec.id_lab
							  JOIN departamentos d
							  ON l.id_dep=d.id_dep
							  JOIN divisiones dv
							  ON dv.id_div=d.id_div
			                  WHERE inventario="."'".$valida['inventario']."'".
							  " AND dv.id_div=" .$_SESSION['id_div'];
							  		  
							  
                    $registroe= pg_query($querye) or die('Hubo un error con la base de datos');
				
		
		            $exite=pg_fetch_array($registroe);
		 
		            if ($exite[0] == NULL) 
		                   $errorlab=6;
		            else 
		                   $errorlab=5; //se ingreso como 0  y no se encontró en equipoc previo inventario 2017
				  		 
               
		   }elseif ($valida['id_lab']!='0' ){  
			          //valida que sexita el area para ingresar
					  
		                $querylab="SELECT * FROM laboratorios l
                                   JOIN departamentos d
                                   ON d.id_dep=l.id_dep
                                   WHERE id_div=".$_SESSION['id_div'].
					               " AND l.id_lab=".$valida['id_lab'];
			           // echo $querylab;
						
		                $existelab= pg_query($querylab) or die('Hubo un error con la base de datos');		
			
	    	            $cuantos=pg_num_rows($existelab);
		
			          if ($cuantos==0){
			                     $errorlab=4;//lab no existe en la división
					             $lab=0;	
								 $bandera=0;
								 }	
					  else{      
						         $errorlab=8;
							     $lab=$valida['id_lab'];
						
						} //fin else cuantos
		               
		           }//fin de elseif valida
			
	  
	   $regexFecha = '/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/';
	 
	   
	  if($valida['dispositivo_clave']==NULL) //dispositivo_clave
	     $columna1=0; elseif(preg_match("/^[0-9]+$/",$valida['dispositivo_clave'])) $columna1=1; else $columna1=2;	 
	  if($valida['usuario_final_clave']==NULL)//usuario_final_clave
	     $columna2=0; elseif(preg_match("/^[0-9]+$/",$valida['usuario_final_clave'])) $columna2=1; else $columna2=2;	
	  if($valida['familia_clave']==NULL) //familia_clave
	     $columna3=0;  elseif(preg_match("/^[0-9]+$/",$valida['familia_clave'])) $columna3=1; else $columna3=2;
	  if($valida['tipo_ram_clave']==NULL) //tipo_ram_clave
		 $columna4=0; elseif(preg_match("/^[0-9]+$/",$valida['tipo_ram_clave'])) $columna4=1; else $columna4=2;
	  if($valida['tecnologia_clave']==NULL) //tecnologia_clave
		 $columna5=0; elseif(preg_match("/^[0-9]+$/",$valida['tecnologia_clave'])) $columna5=1; else $columna5=2;
	  if($valida['resguardo_nombre']==NULL) //resguardo_nombre
		 $columna6=0; elseif(is_int($valida['resguardo_nombre'])) $columna6=1; else $columna6=2;
	  if($valida['resguardo_no_empleado']==NULL) //resguardo_no_empleado
	     $columna7=0; elseif(is_int($valida['resguardo_no_empleado'])) $columna7=1; else $columna7=2;
	  if($valida['usuario_nombre']==NULL) //usuario_nombre
		 $columna8=0; elseif(is_int($valida['usuario_nombre'])) $columna8=1; else $columna8=2;
	  if($valida['usuario_ubicacion']==NULL) //usuario_ubicación
	     $columna9=0;  elseif(is_int($valida['usuario_ubicacion'])) $columna9=1; else $columna9=2;
	  if($valida['usuario_perfil']==NULL) //usuario_perfil
		 $columna10=0;  elseif(preg_match("/^[0-9]+$/",$valida['usuario_perfil'])) $columna10=1; else $columna10=2;
	  if($valida['usuario_sector']==NULL) //usuario_sector
		 $columna11=0; elseif(preg_match("/^[0-9]+$/",$valida['usuario_sector'])) $columna11=1; else $columna11=2;
	  if($valida['serie']==NULL) //no_servicio o serie
		 $columna12=0; elseif(is_int($valida['serie'])) $columna12=1; else $columna12=2;
	  if($valida['marca_p']==NULL) //marca_p
		 $columna13=0;  elseif(is_int($valida['marca_p'])) $columna13=1; else $columna13=2;
	  if($valida['no_factura']==NULL) //no_factura
		 $columna14=0; elseif(is_int($valida['no_factura'])) $columna14=1; else $columna14=2;
	  if($valida['anos_garantia']==NULL) //años_garantia
		 $columna15=0; elseif(is_int($valida['anos_garantia'])) $columna15=1; else $columna15=2;
	  if($valida['inventario']==NULL)  //inventario
		 $columna16=0; elseif(is_int($valida['inventario'])) $columna16=1; else $columna16=2;
	  if($valida['modelo_p']==NULL)  //modelo_p
		 $columna17=0; elseif(is_int($valida['modelo_p'])) $columna17=1; else $columna17=2;
	  if($valida['proveedor']==NULL)  //proveedor_p
		 $columna18=0; elseif(is_int($valida['proveedor'])) $columna18=1; else $columna18=2;
	  if($valida['fecha_factura']==NULL)  //fecha_factura
		 $columna19=0; elseif(!preg_match($regexFecha,$valida['fecha_factura'])) $columna19=2; else $columna19=3;
	  if($valida['familia_especificar']==NULL)  //familia_especificar
		 $columna20=0; elseif(is_int($valida['familia_especificar'])) $columna20=1; else $columna20=2;	 
	  if($valida['modelo_procesador']==NULL)  //modelo_procesador
		 $columna21=0; elseif(is_int($valida['modelo_procesador'])) $columna21=1; else $columna21=2; 
	  if($valida['cantidad_procesador']==NULL)  //cantidad_procesador
		 $columna22=0; elseif(preg_match("/^[0-9]+$/",$valida['cantidad_procesador'])) $columna22=1; else $columna22=2;
	  if($valida['nucleos_totales']==NULL)  //nucleos_totales
		 $columna23=0; elseif(preg_match("/^[0-9]+$/",$valida['nucleos_totales'])) $columna23=1; else $columna23=2;
	  if($valida['nucleos_gpu']==NULL)  //nucleos_gpu
		 $columna24=0; elseif(preg_match("/^[0-9]+$/",$valida['nucleos_gpu'])) $columna24=1; else $columna24=2;
      if($valida['memoria_ram']==NULL)  //memoria_ram
		 $columna25=0; elseif(preg_match("/^[0-9]+$/",$valida['memoria_ram'])) $columna25=1; else $columna25=2;
	  if($valida['ram_especificar']==NULL)  //ram_especificar
		 $columna26=0; elseif(is_int($valida['ram_especificar'])) $columna26=1; else $columna26=2;
      if($valida['num_elementos_almac']==NULL)  //num_elementos_almac
		 $columna27=0; elseif(preg_match("/^[0-9]+$/",$valida['num_elementos_almac'])) $columna27=1; else $columna27=2;
	  if($valida['total_almac']==NULL)  //total_almac
		 $columna28=0; elseif(preg_match("/^[0-9]+$/",$valida['total_almac'])) $columna28=1; else $columna28=2;
	  if($valida['num_arreglos']==NULL)  //num_arreglos
		 $columna29=0; elseif(preg_match("/^[0-9]+$/",$valida['num_arreglos'])) $columna29=1; else $columna29=2;
	  if($valida['esquema_uno']==NULL)  //esquema_uno
		 $columna30=0; elseif(preg_match("/^[0-9]+$/",$valida['esquema_uno'])) $columna30=1; else $columna30=2;	 		 		 	 	  
	  if($valida['esquema_dos']==NULL)  //esquema_dos
		 $columna31=0;  elseif(preg_match("/^[0-9]+$/",$valida['esquema_dos'])) $columna31=1; else $columna31=2;
	  if($valida['esquema_tres']==NULL)  //esquema_tres
		 $columna32=0;  elseif(preg_match("/^[0-9]+$/",$valida['esquema_tres'])) $columna32=1; else $columna32=2;
	  if($valida['esquema_cuatro']==NULL)  //esquema_cuatro
		 $columna33=0;  elseif(preg_match("/^[0-9]+$/",$valida['esquema_cuatro'])) $columna33=1; else $columna33=2;
	  if($valida['tec_uno']==NULL)  //tec_uno
		 $columna34=0;  elseif(preg_match("/^[0-9]+$/",$valida['tec_uno'])) $columna34=1; else $columna34=2;
	  if($valida['tec_dos']==NULL)  //tec_dos
		 $columna35=0;  elseif(preg_match("/^[0-9]+$/",$valida['tec_dos'])) $columna35=1; else $columna35=2;
	  if($valida['tec_tres']==NULL)  //tec_tres
		 $columna36=0;	elseif(preg_match("/^[0-9]+$/",$valida['tec_tres'])) $columna36=1; else $columna36=2;	
	  if($valida['tec_cuatro']==NULL)  //tec_cuatro
		 $columna37=0;  elseif(preg_match("/^[0-9]+$/",$valida['tec_cuatro'])) $columna37=1; else $columna37=2;
	  if($valida['subtotal_uno']==NULL)  //subtotal_uno
		 $columna38=0;  elseif(preg_match("/^[0-9]+$/",$valida['subtotal_uno'])) $columna38=1; else $columna38=2;
	  if($valida['subtotal_dos']==NULL)  //subtotal_dos
		 $columna39=0;  elseif(preg_match("/^[0-9]+$/",$valida['subtotal_dos'])) $columna39=1; else $columna39=2;
	  if($valida['subtotal_tres']==NULL)  //subtotal_tres
		 $columna40=0;	elseif(preg_match("/^[0-9]+$/",$valida['subtotal_tres'])) $columna40=1; else $columna40=2;
	  if($valida['subtotal_cuatro']==NULL)  //subtotal_cuatro
		 $columna41=0;	elseif(preg_match("/^[0-9]+$/",$valida['subtotal_cuatro'])) $columna41=1; else $columna41=2; 	 
	  if($valida['arreglo_total']==NULL)  //arreglo_total
		 $columna42=0;  elseif(preg_match("/^[0-9]+$/",$valida['arreglo_total'])) $columna42=1; else $columna42=2;
	  if($valida['tec_com']==NULL)  //tec_com
		 $columna43=0;	elseif(preg_match("/^[0-9]+$/",$valida['tec_com'])) $columna43=1; else $columna43=2;
	  if($valida['tec_com_otro']==NULL)  //tec_com_tro
		 $columna44=0;	elseif(is_int($valida['tec_com_otro'])) $columna44=1; else $columna44=2;
	  if($valida['sist_oper']==NULL)  //sist_oper
		 $columna45=0;  elseif(preg_match("/^[0-9]+$/",$valida['sist_oper'])) $columna45=1; else $columna45=2;
	  if($valida['version_sist_oper']==NULL)  //version_sist_oper
	     $columna46=0;  elseif(is_int($valida['version_sist_oper'])) $columna46=1; else $columna46=2;
	  if($valida['licencia']==NULL)  //licencia
	     $columna47=0;  elseif(preg_match("/^[0-9]+$/",$valida['licencia'])) $columna47=1; else $columna47=2;
	  if($valida['licencia_ini']==NULL)  //licencia_ini
	     $columna48=0;  elseif(!preg_match($regexFecha,$valida['licencia_ini'])) $columna48=2; else $columna48=3;
	  if($valida['licencia_fin']==NULL)  //licencia_fin
	     $columna49=0;  elseif(!preg_match($regexFecha,$valida['licencia_fin'])) $columna49=2; else $columna49=3;
	  if($valida['id_edificio']==NULL)  //id_edif
	     $columna50=0;  elseif(preg_match("/^[0-9]+$/",$valida['id_edificio'])) $columna50=1; else $columna50=2;
	
	  if($lab==NULL)  //id_lab
	      $columna51=0;   
	  else 
	      $columna51=1;  
	  if($errorlab==4)
		  $columna51=4; 
      if ($errorlab==5)	
		  $columna51=5;
	  if ($errorlab==6)	
		  $columna51=6;		
		  
	  //Traer el último valor en errorinserta
			        $queryd="SELECT max(id_error) FROM errorinserta";
                    $registrod= pg_query($queryd)or die('Error en la base de datos'); 
                    $ultimo= pg_fetch_array($registrod);
	
		      if ($ultimo[0]==0)
				     $ultimo=1;//inicializando la tabla dispositivouno
			  else 
			         $ultimo=$ultimo[0]+1;
	   
	  $inventario=$valida['inventario'];
	  
	   $query= "INSERT INTO errorinserta(id_error,tupla,inventario,columna1,columna2,columna3,columna4,columna5,
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
										 ($ultimo,$cuenta,'$inventario',$columna1,$columna2,$columna3,$columna4,$columna5,
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
		
	   $result=pg_query( $query) or die('ERROR AL INSERTAR en errorinserta'); 
	   $cuenta++;
	   echo $query;
		}//fin while
		

}//fin funcion detecta error

function marcaerror($no,$datos){ 
 $regexFecha = '/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/';
//echo'valores de entrada';
//print_r($datos);
$inventario=$datos[15];

 if ($datos[0]==NULL) { $columna1=0;?>
	           <legend align="left"><?php echo 'La columna A,  <strong> clave_dispositivo </strong> del renglón correpondiente al no.inventario '.$datos[15] .' es obligatoria.'; ?></legend>
     <?php } 
	    if(!preg_match("/^[0-9]+$/",$datos[0])) { $columna1=2;?>
	<legend align="left"><?php echo 'La columna A,  <strong> clave_dispositivo </strong> del renglón correpondiente al no.inventario  '.$datos[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend><?php }else $columna1=1; ?>
      
	<?php if ($datos[1]==NULL) { $columna2=0;?>
		      <legend align="left"><?php echo 'La columna B, <strong> usuario_final_clave </strong> del renglón correpondiente al no.inventario  '.$datos[15] .' es obligatoria.';?></legend>     	
	 <?php  }	 
	    if(!preg_match("/^[0-9]+$/",$datos[1])){ $columna2=2;?>
	<legend align="left"><?php  echo 'La columna B,  <strong>  usuario_final_clave </strong> del renglón correpondiente al no.inventario  '.$datos[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>
      <?php } else $columna2=1;
   if ($datos[2]==NULL) { $columna3=0;?>
		     <legend align="left"><?php echo 'La columna C, <strong> familia_clave </strong> del renglón correpondiente al no.inventario  '.$datos[15] .' es obligatoria.';	?></legend>
	 <?php } 
        if(!preg_match("/^[0-9]+$/",$datos[2])) { $columna3=2;?>
	<legend align="left"><?php echo 'La columna C,  <strong> familia_clave </strong> del renglón correpondiente al no.inventario  '.$datos[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>
      <?php } else $columna3=1;

	  if ($datos[3]==NULL) { $columna4=0; ?>
		      <legend align="left"><?php echo 'La columna D, <strong> tipo_ram_clave </strong> del renglón correpondiente al no.inventario  '.$datos[15] .' es obligatoria.'; ?></legend>
	 <?php } ?>
     <?php if (!preg_match("/^[0-9]+$/",$datos[3]))  { $columna4=2;?>
		     <legend align="left"><?php echo 'La columna D, <strong>tipo_ram_clave </strong> del renglón correpondiente al no.inventario  '.$datos[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>	
	 <?php }  else $columna4=1;?>
     <?php if ($datos[4]==NULL) { 
	            $columna5=0;?>
		    <legend align="left"><?php echo 'La columna E, <strong> tecnologia_clave </strong> del renglón correpondiente al no.inventario  '.$datos[15] .' es obligatoria.'; ?></legend>
	 <?php }  ?>
      <?php if (!preg_match("/^[0-9]+$/",$datos[4])) { 
	            $columna5=2;?>
		      <legend align="left"><?php echo 'La columna E, <strong> tecnologia_clave </strong>del renglón correpondiente al no.inventario  '.$datos[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>			
	 <?php } else $columna5=1;?> 
    
     <?php if ($datos[5]==NULL) {
		       $columna6=0;?>
		       <legend align="left"><?php echo 'La columna F, <strong> resguardo_nombre </strong> del renglón correpondiente al no.inventario  '.$datos[15] .' es obligatoria.'; ?></legend>	
      <?php   } elseif(is_int($datos[5])) $columna6=1; else $columna6=2;       			
	if ($datos[6]==NULL) { $columna7=0;?>
		      <legend align="left"><?php echo 'La columna G, <strong> resguardo_no_empleado </strong> del renglón correpondiente al no.inventario  '.$datos[15] .' es obligatoria.'; ?></legend>	     
	  <?php } elseif(is_int($datos[6])) $columna7=1; else $columna7=2;  ?>
       <?php  if ($datos[7]==NULL) { $columna8=0;?>
		      <legend align="left"><?php echo 'La columna H, <strong> usuario_nombre </strong> del renglón correpondiente al no.inventario  '.$datos[15] .' es obligatoria.'; ?></legend>
     <?php } elseif(is_int($datos[7])) $columna8=1; else $columna8=2; 
	  if ($datos[8]==NULL) { $columna9=0;?>
		     <legend align="left"><?php echo 'La columna I, <strong> usuario_ubicación </strong> del renglón correpondiente al no.inventario  '.$datos[15] .' es obligatoria.'; ?></legend>
            <?php }  elseif(is_int($datos[8])) $columna9=1; else $columna9=2; 
			 if($datos[9]==NULL) { $columna10=0;?>
		     <legend align="left"><?php echo 'La columna J, <strong> usuario_perfil </strong> del renglón correpondiente al no.inventario  '.$datos[15] .' es obligatoria.'; ?></legend>      
			  <?php } ?>
             <?php  if(!preg_match("/^[0-9]+$/",$datos[9])) { $columna10=2;?>
		      <legend align="left"><?php echo 'La columna J, <strong> usuario_perfil </strong>del renglón correpondiente al no.inventario  '.$datos[15] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>   <?php } else $columna10=1;?>  
              
              <?php if ($datos[10]==NULL) { $columna11=0;?>
		       <legend align="left"><?php echo 'La columna K, <strong> usuario_sector </strong> del renglón correpondiente al no.inventario  '.$datos[15] .' es obligatoria.'; ?></legend>	      
			  <?php } ?>
               <?php if (!preg_match("/^[0-9]+$/",$datos[10])) { $columna11=2; ?>
		     <legend align="left"><?php echo 'La columna K, <strong> usuario_sector </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>   <?php } else $columna11=1;?>   
             <?php if ($datos[11]==NULL) { $columna12=0;?>
		     <legend align="left"><?php //echo 'La columna L, <strong> no servicio </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
			<?php } ?>
		   <?php if ($datos[12]==NULL) { $columna13=0;?>
		     <legend align="left"><?php echo 'La columna M, <strong> marca_p </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
			<?php } elseif(is_int($datos[12])) $columna13=1; else $columna13=2; 
			if ($datos[13]==NULL) { $columna14=0; ?>
		      <legend align="left"><?php echo 'La columna N, <strong> no_factura </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
      <?php }  elseif(is_int($datos[13])) $columna14=1; else $columna14=2; 
	  if ($datos[14]==NULL) { $columna15=0;?>
		      <legend align="left"><?php echo 'La columna O, <strong> años garantía </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
      <?php } elseif(is_int($datos[14])) $columna15=1; else $columna15=2; 
	  if ($datos[15]==NULL) { $columna16=0;?>
		     <legend align="left"><?php echo 'La columna P, <strong> inventario </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
	  <?php } elseif(is_int($datos[15])) $columna16=1; else $columna16=2; 
	  if ($datos[16]==NULL) { $columna17=0;?>
		     <legend align="left"><?php echo 'La columna Q, <strong> modelo_p </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
      <?php } elseif(is_int($datos[16])) $columna17=1; else $columna17=2; 
	  if ($datos[17]==NULL) { $columna18=0;?>
		     <legend align="left"><?php echo 'La columna R, <strong> proveedor_p </strong>del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>  
	  <?php } elseif(is_int($datos[17])) $columna18=1; else $columna18=2; 
	  if ($datos[18]==NULL) { $columna19=0;?>
		     <legend align="left"> <?php echo 'La columna S, <strong> fecha_factura </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria..'; ?></legend>
            
      <?php } elseif(!preg_match($regexFecha,$datos[18])) $columna19=2; else $columna19=3;
      if ($datos[18]==NULL) { $columna19=2;?>
		     <legend align="left"><?php echo 'El formato de fecha de la columna S, <strong> fecha_factura </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es incorrecto.'; ?></legend>
      <?php } ?>
	  <?php if ($datos[20]==NULL) { $columna21=0;?>
		     <legend align="left"><?php echo 'La columna U, <strong> modelo_procesador </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>     
               <?php } elseif(is_int($datos[20])) $columna21=1; else $columna21=2;  ?>
               <?php if ($datos[21]==NULL) { $columna22=0;?>
		      <legend align="left"> <?php echo 'La columna V, <strong> cantidad_procesador </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend> 
                <?php } ?>
               <?php if (!preg_match("/^[0-9]+$/",$datos[21])) { $columna22=2;?>
		     <legend align="left"> <?php echo 'La columna V, <strong> cantidad_procesador </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>
                <?php } else $columna22=1;?> 
                <?php if ($datos[22]==NULL) { $columna23=0;?>
		     <legend align="left"> <?php echo 'La columna W, <strong> nucleos_totales </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
            <?php } ?>
              <?php if (!preg_match("/^[0-9]+$/",$datos[22]))  { $columna23=2;?>
		     <legend align="left"> <?php echo 'La columna W, <strong> nucleos_totales </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>
      <?php }  else $columna23=1;?>
      <?php if ($datos[23]==NULL) { $columna24=0;?>
		      <legend align="left"><?php echo 'La columna X, <strong> nucleos_GPU </strong>del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
	  <?php } ?>
        <?php if (!preg_match("/^[0-9]+$/",$datos[23]))  { $columna24=2;?>
		     <legend align="left"><?php echo 'La columna X, <strong> nucleos_GPU </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica'; ?></legend>
	  <?php } else $columna24=1;?>
      <?php if ($datos[24]==NULL) { $columna25=0;?>
		      <legend align="left"><?php echo 'La columna Y, <strong> memoria_RAM </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
      <?php  } elseif(is_int($datos[24])) $columna25=1; else $columna25=2; 
      if (!preg_match("/^[0-9]+$/",$datos[24])) { ?>
		     <legend align="left"> <?php //echo 'La columna Y, <strong> memoria_RAM </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica'; ?></legend>
      <?php //  } ?>
      
		     <legend align="left"><?php echo 'La columna R, <strong> proveedor_p </strong>del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>  
	  <?php } elseif(is_int($datos[17])) $columna18=1; else $columna18=2; 
	 
      if ($datos[26]==NULL) { $columna27=0;?>
		      <legend align="left"><?php echo 'La columna AA, <strong> num_elementos_almac </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
      <?php }elseif(is_int($datos[26])) $columna27=1; else $columna27=2; 
		      
     
       if (!preg_match("/^[0-9]+$/",$datos[27])){ $columna28=2;?>
		      <legend align="left"> <?php echo 'La columna AB, <strong> total_almac </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>
      <?php }  else $columna28=1; ?>
      <?php if ($datos[28]==NULL) { $columna29=0;?>
		       <legend align="left"><?php echo 'La columna AC, <strong> num_arreglos </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
      <?php } ?>
        <?php if (!preg_match("/^[0-9]+$/",$datos[28])){ $columna29=2;?>
		  <legend align="left"><?php echo 'La columna AC, <strong> num_arreglos </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>
      <?php } else $columna29=1;?>
      <?php if ($datos[29]==NULL) { $columna30=0;?>
		      <legend align="left"><?php echo 'La columna AD, <strong> esquema_uno </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
      <?php }  ?>
      <?php if (!preg_match("/^[0-9]+$/",$datos[29])){ $columna30=2;?>
		     <legend align="left"><?php echo 'La columna AD, <strong> esquema_uno </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>
      <?php }  else $columna30=1; ?>
      <?php if ($datos[30]==NULL) { $columna31=0;?>
		      <legend align="left"><?php echo 'La columna AE, <strong> esquema_dos </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
	   <?php } ?>
        <?php if (!preg_match("/^[0-9]+$/",$datos[30])){ $columna31=2;?>
		      <legend align="left"> <?php echo 'La columna AE, <strong> esquema_dos </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>         
	   <?php } else $columna31=1; ?>
       <?php if ($datos[31]==NULL) { $columna32=0;?>
		      <legend align="left"> <?php echo 'La columna AF, <strong> esquema_tres </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
      <?php } ?>
      <?php if (!preg_match("/^[0-9]+$/",$datos[31])){ $columna32=2;?>
		      <legend align="left">  <?php echo 'La columna AF, <strong> esquema_tres </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>
      <?php } else $columna32=1; ?>
      <?php if ($datos[32]==NULL) { $columna33=0;?>
		      <legend align="left"><?php echo 'La columna AG, <strong> esquema_cuatro </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>           
	 <?php } ?>
      <?php if (!preg_match("/^[0-9]+$/",$datos[32])){ $columna33=2;?>
		     <legend align="left"> <?php echo 'La columna AG, <strong> esquema_cuatro </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>
	 <?php } else $columna33=1; ?>
     <?php if ($datos[33]==NULL) { $columna34=0;?>
		     <legend align="left"><?php echo 'La columna AH, <strong> tec_uno </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
      <?php  } if (!preg_match("/^[0-9]+$/",$datos[33])){ $columna34=2;?>
		       <legend align="left"> <?php echo 'La columna AH, <strong> tec_uno </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend> 
      <?php  } else $columna34=1; ?>
      <?php if ($datos[34]==NULL) { $columna35=0;?>
		      <legend align="left"> <?php echo 'La columna AI, <strong> tec_dos </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
      <?php } ?>
    <?php if (!preg_match("/^[0-9]+$/",$datos[34])){ $columna35=2;?>
		    <legend align="left"> <?php echo 'La columna AI, <strong> tec_dos </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>
      <?php } else $columna35=1; ?>
      <?php if ($datos[35]==NULL) { $columna36=0;?>
		     <legend align="left">  <?php echo 'La columna AJ, <strong> tec_tres </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend> 
      <?php }  ?>
       <?php if (!preg_match("/^[0-9]+$/",$datos[35])){ $columna36=2;?>
		      <legend align="left"> <?php echo 'La columna AJ, <strong> tec_tres </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>   
      <?php } else $columna36=1; ?> 
      <?php if ($datos[36]==NULL) { $columna37=0;?>
		     <legend align="left"><?php echo 'La columna AK, <strong> tec_cuatro </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
	<?php  } ?>
      <?php if (!preg_match("/^[0-9]+$/",$datos[36])){ $columna37=2;?>
		      <legend align="left">  <?php echo 'La columna AK, <strong> tec_cuatro </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>              
	<?php  } else $columna37=1; ?>
        <?php if ($datos[37]==NULL) { $columna38=0;?>
		      <legend align="left"> <?php echo 'La columna AL, <strong> subtotal_uno </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
                   <?php }  ?>
         <?php if (!preg_match("/^[0-9]+$/",$datos[37])){ $columna38=2;?>
		     <legend align="left"> <?php echo 'La columna AL, <strong> subtotal_uno </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>             
			 <?php } else $columna38=1; ?>      
         <?php if ($datos[38]==NULL) { $columna39=0;?>
		      <legend align="left"> <?php echo 'La columna AM, <strong> subtotal_dos </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
      <?php  } ?>
        <?php if (!preg_match("/^[0-9]+$/",$datos[38])){ $columna39=2;?>
		      <legend align="left"> <?php echo 'La columna AM, <strong> subtotal_dos </strong> ddel renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>
      <?php  } else $columna39=1; ?> 
      
      <?php if ($datos[39]==NULL) { $columna40=0;?>
		       <legend align="left"> <?php echo 'La columna AN, <strong> subtotal_tres </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>            <?php   } ?>
      <?php if (!preg_match("/^[0-9]+$/",$datos[39])){ $columna40=2;?>
		     <legend align="left"><?php echo 'La columna AN, <strong> subtotal_tres </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>          
        <?php   } else $columna40=1; ?> 
                     
	  <?php if ($datos[40]==NULL) { $columna41=0;?>
		      <legend align="left"> <?php echo 'La columna AO, <strong> subtotal_cuatro </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
      <?php } ?>
      <?php if (!preg_match("/^[0-9]+$/",$datos[40])){ $columna41=2;?>
		      <legend align="left"> <?php echo 'La columna AO, <strong> subtotal_cuatro </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>
      <?php } else $columna41=1; ?>
      <?php if ($datos[41]==NULL) { $columna42=0;?>
		  <legend align="left"> <?php echo 'La columna AP, <strong> arreglo_total </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>          <?php  } ?>
       <?php if (!preg_match("/^[0-9]+$/",$datos[41])){ $columna42=2;?>
		     <legend align="left"> <?php echo 'La columna AP, <strong> arreglo_total </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>            
         <?php  }else $columna42=1; ?>  
                      
       <?php if ($datos[42]==NULL) { $columna43=0;?>
		     <legend align="left"> <?php echo 'La columna AQ, <strong> tec_com </strong>  del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend> 
        <?php }  ?>
      <?php if (!preg_match("/^[0-9]+$/",$datos[42])){ $columna43=2;?>
		     <legend align="left"> <?php echo 'La columna AQ, <strong> tec_com </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica, revisar el catálogo correspondiente.'; ?></legend><?php } else $columna43=1; ?>  
      
       <?php if ($datos[44]==NULL) { $columna45=0;?>
		       <legend align="left"> <?php echo 'La columna AS, <strong> sist_oper </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend> <?php } ?>
         <?php if (!preg_match("/^[0-9]+$/",$datos[44])){ $columna45=2;?>
		     <legend align="left"><?php echo 'La columna AS, <strong> sist_oper </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica, revisar el catálogo correspondiente.'; ?></legend> <?php } else $columna45=1; ?>        
      <?php if ($datos[45]==NULL) { $columna46=0;?>
		     <legend align="left"> <?php echo 'La columna AT, <strong> version_sist_oper </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
      <?php } elseif(is_int($datos[45])) $columna46=1; else $columna46=2; 
        if ($datos[46]==NULL) { $columna47=0;?>
		      <legend align="left"><?php echo 'La columna AU, <strong> licencia </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
	  <?php } ?>
      
        <?php if (!preg_match("/^[0-9]+$/",$datos[46])){ $columna47=2;?>
		     <legend align="left"> <?php echo 'La columna AU, <strong> licencia </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>
			 <?php } else $columna47=1;  ?>
       <?php if ($datos[47]==NULL) { $columna48=0;?>
		      <legend align="left"><?php echo 'La columna AV, <strong> licencia_ini </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>            
	  <?php } ?>
      <?php if (!preg_match("/^[0-9]+$/",$datos[47])){ $columna48=2;?>
		     <legend align="left"> <?php echo 'El formato de fecha de la columna AV, <strong> licencia_ini </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es incorrecto.'; ?></legend>
      <?php }  else $columna48=1; ?>
      <?php if ($datos[48]==NULL) { $columna49=0;?>
		      <legend align="left">  <?php echo 'La columna AW, <strong> licencia_fin </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>
        <?php } elseif(!preg_match($regexFecha,$datos[48])) { $columna49=2; ?>
		     <legend align="left"><?php echo 'El formato de fecha de la columna AW, <strong> licencia_fin </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es incorrecto.'; ?></legend>
        <?php } else $columna49=3;?>
         <?php if ($datos[49]==NULL) { $columna50=0;?>
		       <legend align="left"> <?php echo 'La columna AX, <strong> id_edificio </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>  
			<?php } ?> 
              <?php if (!preg_match("/^[0-9]+$/",$datos[49])){ $columna50=2;?>
		      <legend align="left"> <?php echo 'La columna AX, <strong> id_edificio </strong> del renglón correpondiente al no.inventario  '.$datos[15].' debe ser numérica.'; ?></legend>    
              
               <?php } else $columna50=1; ?>  
               
             <?php if ($datos[50]==NULL) { $columna51=0;?>
		      <legend align="left"> <?php echo 'La columna AY, <strong> id_lab </strong> del renglón correpondiente al no.inventario  '.$datos[15].' es obligatoria.'; ?></legend>        
             <?php }elseif(is_int( $datos[50])) $columna51=1; else $columna51=2; ?>
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
				    $registrod= pg_query($queryd) or die('Hubo un error con la base de datos');
                    $ultimo= pg_fetch_array($registrod);
	
		      if ($ultimo[0]==0)
				    $ultimo=1;//inicializando la tabla dispositivouno
			  else 
			        $ultimo=$ultimo[0]+1;
	   
	         $query= "INSERT INTO errorinserta(id_error,tupla,inventario,columna1,columna2,columna3,columna4,columna5,
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
										 ($ultimo,$no,'$inventario',$columna1,$columna2,$columna3,$columna4,$columna5,
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
	   $result=pg_query( $query) or die('ERROR AL INSERTAR en errorinserta'); 

	 
	
	 
		 
         
       } //fin marcaerror



function revisarError($no,$datos){
	//guarda en errorinserta
	//echo 'valores recibidos cuernta';
	//echo ($no);
	
	 $regexFecha = '/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/';
	  $inventario=$datos[15];
	 
	  if($datos[0]==NULL) {//dispositivo_clave
	     $columna1=0;
		  }elseif(preg_match("/^[0-9]+$/",$datos[0])) $columna1=1; else $columna1=2;	 
	  if($datos[1]==NULL)//usuario_final_clave
	     $columna2=0; elseif(preg_match("/^[0-9]+$/",$datos[1])) $columna2=1; else $columna2=2;	
	  if($datos[2]==NULL) //familia_clave
	     $columna3=0;  elseif(preg_match("/^[0-9]+$/",$datos[2])) $columna3=1; else $columna3=2;
	  if($datos[3]==NULL) //tipo_ram_clave
		 $columna4=0; elseif(preg_match("/^[0-9]+$/",$datos[3])) $columna4=1; else $columna4=2;
	  if($datos[4]==NULL) //tecnologia_clave
		 $columna5=0; elseif(preg_match("/^[0-9]+$/",$datos[4])) $columna5=1; else $columna5=2;
	  if($datos[5]==NULL) //resguardo_nombre
		 $columna6=0; elseif(is_int($datosdec[5])) $columna6=1; else $columna6=2;
	  if($datos[6]==NULL) //resguardo_no_empleado
	     $columna7=0; elseif(is_int($datos[6])) $columna7=1; else $columna7=2;
	  if($datos[7]==NULL) //usuario_nombre
		 $columna8=0; elseif(is_int($datos[7])) $columna8=1; else $columna8=2;
	  if($datos[8]==NULL) //usuario_ubicación
	     $columna9=0;  elseif(is_int($datos[8])) $columna9=1; else $columna9=2;
	  if($datos[9]==NULL) //usuario_perfil
		 $columna10=0;  elseif(preg_match("/^[0-9]+$/",$datos[9])) $columna10=1; else $columna10=2;
	  if($datos[10]==NULL) //usuario_sector
		 $columna11=0; elseif(preg_match("/^[0-9]+$/",$datos[10])) $columna11=1; else $columna11=2;
	  if($datos[11]==NULL) //no_servicio o inventario
		 $columna12=0; elseif(is_int($datos[11])) $columna12=1; else $columna12=2;
	  if($datos[12]==NULL) //marca_p
		 $columna13=0;  elseif(is_int($datos[12])) $columna13=1; else $columna13=2;
	  if($datos[13]==NULL) //no_factura
		 $columna14=0; elseif(is_int($datos[13])) $columna14=1; else $columna14=2;
	  if($datos[14]==NULL) //años_garantia
		 $columna15=0; elseif(is_int($datos[14])) $columna15=1; else $columna15=2;
	  if($datos[15]==NULL)  //inventario
		 $columna16=0; elseif(is_int($datos[15])) $columna16=1; else $columna16=2;
	  if($datos[16]==NULL)  //modelo_p
		 $columna17=0; elseif(is_int($datos[16])) $columna17=1; else $columna17=2;
	  if($datos[17]==NULL)  //proveedor_p
		 $columna18=0; elseif(is_int($datos[17])) $columna18=1; else $columna18=2;
	  if($datos[18]==NULL)  //fecha_factura
		 $columna19=0; elseif(!preg_match($regexFecha,$datos[18])) $columna19=3; else $columna19=2;
	  if($datos[19]==NULL)  //familia_especificar
		 $columna20=0; elseif(is_int($datos[19])) $columna20=1; else $columna20=2; 
	  if($datos[20]==NULL)  //modelo_procesador
		 $columna21=0; elseif(is_int($datos[20])) $columna21=1; else $columna21=2;
	  if($datos[21]==NULL)  //cantidad_procesador
		 $columna22=0; elseif(preg_match("/^[0-9]+$/",$datos[21])) $columna22=1; else $columna22=2;
	  if($datos[22]==NULL)  //nucleos_totales
		 $columna23=0; elseif(preg_match("/^[0-9]+$/",$datos[22])) $columna23=1; else $columna23=2;
	  if($datos[23]==NULL)  //nucleos_gpu
		 $columna24=0; elseif(is_int($datosdec[23])) $columna24=1; else $columna24=2;
      if($datos[24]==NULL)  //memoria_ram
		 $columna25=0; elseif(preg_match("/^[0-9]+$/",$datos[24])) $columna25=1; else $columna25=2;
		 if($datos[25]==NULL)  //ram_especificar
		 $columna26=0; elseif(is_int($datos[25])) $columna26=1; else $columna26=2;
      if($datos[26]==NULL)  //num_elem_almac
		 $columna27=0; elseif(preg_match("/^[0-9]+$/",$datos[26])) $columna27=1; else $columna27=2;
	  if($datos[27]==NULL)  //total_almac
		 $columna28=0; elseif(preg_match("/^[0-9]+$/",$datos[27])) $columna28=1; else $columna28=2;
	  if($datos[28]==NULL)  //num_arreglos
		 $columna29=0; elseif(is_int($datosdec[28])) $columna29=1; else $columna29=2;
	  if($datos[29]==NULL)  //esquema_uno
		 $columna30=0; elseif(preg_match("/^[0-9]+$/",$datos[29])) $columna30=1; else $columna30=2;	 		 		 	 	 	      if($datos[30]==NULL)  //esquema_dos
		 $columna31=0;  elseif(preg_match("/^[0-9]+$/",$datos[30])) $columna31=1; else $columna31=2;
	  if($datos[31]==NULL)  //esquema_tres
		 $columna32=0;  elseif(preg_match("/^[0-9]+$/",$datos[31])) $columna32=1; else $columna32=2;
	  if($datos[32]==NULL)  //esquema_cuatro
		 $columna33=0;  elseif(preg_match("/^[0-9]+$/",$datos[32])) $columna33=1; else $columna33=2;
	  if($datos[33]==NULL)  //tec_uno
		 $columna34=0;  elseif(preg_match("/^[0-9]+$/",$datos[33])) $columna34=1; else $columna34=2;
	  if($datos[34]==NULL)  //tec_dos
		 $columna35=0;  elseif(preg_match("/^[0-9]+$/",$datos[34])) $columna35=1; else $columna35=2;
	  if($datos[35]==NULL)  //tec_tres
		 $columna36=0;	elseif(preg_match("/^[0-9]+$/",$datos[35])) $columna36=1; else $columna36=2;	
	  if($datos[36]==NULL)  //tec_cuatro
		 $columna37=0;  elseif(preg_match("/^[0-9]+$/",$datos[36])) $columna37=1; else $columna37=2;
	  if($datos[37]==NULL)  //subtotal_uno
		 $columna38=0;  elseif(preg_match("/^[0-9]+$/",$datos[37])) $columna38=1; else $columna38=2;
	  if($datos[38]==NULL)  //subtotal_dos
		 $columna39=0;  elseif(preg_match("/^[0-9]+$/",$datos[38])) $columna39=1; else $columna39=2;
	  if($datos[39]==NULL)  //subtotal_tres
		 $columna40=0;	elseif(preg_match("/^[0-9]+$/",$datos[39])) $columna40=1; else $columna40=2;
	  if($datos[40]==NULL)  //subtotal_cuatro
		 $columna41=0;	elseif(preg_match("/^[0-9]+$/",$datos[40])) $columna41=1; else $columna41=2; 	 
	  if($datos[41]==NULL)  //arreglo_total
		 $columna42=0;  elseif(preg_match("/^[0-9]+$/",$datos[41])) $columna42=1; else $columna42=2;
	  if($datos[42]==NULL)  //tec_com
		 $columna43=0;	elseif(preg_match("/^[0-9]+$/",$datos[42])) $columna43=1; else $columna43=2;
	  if($datos[43]==NULL)  //tec_com_tro
		 $columna44=0;	elseif(is_int($datosdec[43])) $columna44=1; else $columna44=2;
	  if($datos[44]==NULL)  //sist_oper
		 $columna45=0;  elseif(preg_match("/^[0-9]+$/",$datos[44])) $columna45=1; else $columna45=2;
	  if($datos[45]==NULL)  //version_sist_oper
	     $columna46=0;  elseif(is_int($datosdec[45])) $columna46=1; else $columna46=2;
	  if($datos[46]==NULL)  //licencia
	     $columna47=0;  elseif(preg_match("/^[0-9]+$/",$datos[46])) $columna47=1; else $columna47=2;
	  if($datos[47]==NULL)  //licencia_ini
	     $columna48=0;  elseif(!preg_match($regexFecha,$datos[47])) $columna48=3; else $columna48=2;
	  if($datos[48]==NULL)  //licencia_fin
	     $columna49=0;  elseif(!preg_match($regexFecha,$datos[48])) $columna49=3; else $columna49=2;
	  if($datos[49]==NULL)  //id_edif
	     $columna50=0;  elseif(preg_match("/^[0-9]+$/",$datos[49])) $columna50=1; else $columna50=2;
	  if($datos[50]==NULL)  //id_lab
	     $columna51=0; 	elseif(preg_match("/^[0-9]+$/",$datos[50])) $columna51=1; elseif($datosdec[50]==0) $columna51=3; else $columna51=2;
		      
	      //Traer el último valor en errorinserta
			        $queryd="SELECT max(id_error) FROM errorinserta";
                   // $registrod= pg_query($con,$queryd);
				    $registrod= pg_query($queryd) or die('Hubo un error con la base de datos');
                    $ultimo= pg_fetch_array($registrod);
	
		      if ($ultimo[0]==0)
				    $ultimo=1;//inicializando la tabla dispositivouno
			  else 
			        $ultimo=$ultimo[0]+1;
	   
	         $query= "INSERT INTO errorinserta(id_error,tupla,inventario,columna1,columna2,columna3,columna4,columna5,
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
										 ($ultimo,$no,'$inventario',$columna1,$columna2,$columna3,$columna4,$columna5,
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
		
	   $result=pg_query( $query) or die('ERROR AL INSERTAR en errorinserta'); 

	 
	

	
	
} //finaliza funcion revisa error
   

	function importaError(){
	//echo ' Despliega errores'; 	
	
	 $queryerror="SELECT * FROM errorinserta
	 WHERE  columna1!=1 OR columna2!=1 OR columna3!=1 OR columna4!=1 
				OR  columna10!=1 OR columna11!=1 
				OR columna25!=1 OR columna28!=1
				OR columna30!=1 OR columna31!=1
			    OR columna32!=1 OR columna33!=1 OR columna34!=1 OR columna35!=1
				OR columna36!=1 OR columna37!=1 OR columna45!=1
				OR columna51!=1 "; 
	 
     $result = pg_query($queryerror) or die('Hubo un error con la base de datos');
	 $existen= pg_num_rows($result); 
	
	 
	 if ($existen>0){
		?>
        <br> 
		<legend align="center"><h3>Listado de errores</h3></legend>
         <br>    <br> 
        <?php 						
	 }
 
		while ($disperror = pg_fetch_array($result, NULL,PGSQL_ASSOC)) 
		{  
		
		 if ($disperror['columna1']==0) {?>
		        <!-- <tr><td>--> <legend align="left"><?php echo 'La columna A,  <strong> clave_dispositivo </strong> del renglón correpondiente al no.inventario '.$disperror['inventario'] .' es obligatoria.'; ?></legend><!--</td></tr>-->
     <?php } ?>
	   <?php    if($disperror['columna1']==2) {?>
	 <!-- <tr><td>--><legend align="left"><?php echo 'La columna A,  <strong> clave_dispositivo </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend><!--</td></tr>-->
      <?php } ?>
      
	<?php if ($disperror['columna2']==0) {?>
		      <!-- <tr><td>--> <legend align="left"><?php  echo 'La columna B, <strong> usuario_final_clave </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' es obligatoria.';?></legend><!--</td></tr>-->         	
	 <?php  }?>
     <?php    if($disperror['columna2']==2) {?>
	 <!-- <tr><td>--><legend align="left"><?php echo 'La columna B,  <strong>  usuario_final_clave </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend><!--</td></tr>-->
      <?php } ?>
      
     <?php if ($disperror['columna3']==0) { ?>
		       <!-- <tr><td>--> <legend align="left"><?php echo 'La columna C, <strong> familia_clave </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' es obligatoria.';	?></legend><!--</td></tr>-->	
	 <?php } ?>
     <?php    if($disperror['columna3']==2) {?>
	<!-- <tr><td>--> <legend align="left"><?php echo 'La columna C,  <strong> familia_clave </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend><!--</td></tr>-->
      <?php } ?>
     
     <?php if ($disperror['columna4']==0)  {?>
		      <!-- <tr><td>--> <legend align="left"><?php echo 'La columna D, <strong>tipo_ram_clave </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' es obligatoria.'; ?></legend><!--</td></tr>-->		
	 <?php } ?>
     <?php if ($disperror['columna4']==2)  {?>
		      <!-- <tr><td>--><legend align="left"><?php echo 'La columna D, <strong>tipo_ram_clave </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend><!--</td></tr>-->		
	 <?php } ?>
     
     <?php if ($disperror['columna5']==0) { ?>
		     <!-- <tr><td>--> <legend align="left"><?php echo 'La columna E, <strong> tecnologia_clave </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' es obligatoria.'; ?></legend><!--</td></tr>-->				
	 <?php }  ?>
      <?php if ($disperror['columna5']==2) { ?>
		      <!-- <tr><td>--> <legend align="left"><?php echo 'La columna E, <strong> tecnologia_clave </strong>del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend><!--</td></tr>-->				
	 <?php }  ?>
     
     <?php if ($disperror['columna6']==0) {?>
		       <legend align="left"><?php echo 'La columna F, <strong> resguardo_nombre </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' es obligatoria.'; ?></legend>				
	 <?php } if ($disperror['columna7']==0) { ?>
		      <legend align="left"><?php echo 'La columna G, <strong> resguardo_no_empleado </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' es obligatoria.'; ?></legend><!--</td></tr>-->	     
	  <?php }  if ($disperror['columna8']==0) {?>
		      <legend align="left"><?php echo 'La columna H, <strong> usuario_nombre </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' es obligatoria.'; ?></legend><!--</td></tr>-->
     <?php }  if ($disperror['columna9']==0) {?>
		     <legend align="left"><?php echo 'La columna I, <strong> usuario_ubicación </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' es obligatoria.'; ?></legend>
            <?php }  ?>
			<?php  if ($disperror['columna10']==0) {?>
		     <legend align="left"><?php echo 'La columna J, <strong> usuario_perfil </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' es obligatoria.'; ?></legend>      
			  <?php } ?>
            	<?php  if ($disperror['columna10']==2) {?>
		      <legend align="left"><?php echo 'La columna J, <strong> usuario_perfil </strong>del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' debe ser numérica, revisar catálogo correspondiente.'; ?></legend>      
			  <?php } ?>  
              
              <?php if ($disperror['columna11']==0) { ?>
		       <legend align="left"><?php echo 'La columna K, <strong> usuario_sector </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'] .' es obligatoria.'; ?></legend>	      
			  <?php } ?>
               <?php if ($disperror['columna11']==2) { ?>
		     <legend align="left"><?php echo 'La columna K, <strong> usuario_sector </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica, revisar catálogo correspondiente.'; ?></legend><!--</td></tr>-->	      
			  <?php } ?>
              
			  <?php if ($disperror['columna13']==0) {?>
		     <!-- <tr><td>--><legend align="left"><?php echo 'La columna M, <strong> marca_p </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->	
			<?php } if ($disperror['columna14']==0) { ?>
		      <!-- <tr><td>--><legend align="left"><?php echo 'La columna N, <strong> no_factura </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->	
      <?php }  if ($disperror['columna15']==0) { ?>
		      <!-- <tr><td>--> <legend align="left"><?php echo 'La columna O, <strong> años garantía </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>--> 
      <?php } if ($disperror['columna16']==0) { ?>
		     <!-- <tr><td>--><legend align="left"><?php echo 'La columna P, <strong> inventario </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->      
	  <?php } if ($disperror['columna17']==0) { ?>
		     <!-- <tr><td>--><legend align="left"><?php echo 'La columna Q, <strong> modelo_p </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->
      <?php } if ($disperror['columna18']==0) { ?>
		     <!-- <tr><td>--> <legend align="left"><?php echo 'La columna R, <strong> proveedor_p </strong>del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->      
	  <?php } if ($disperror['columna19']==0) { ?>
		     <!-- <tr><td>--><legend align="left"> <?php echo 'La columna S, <strong> fecha_factura </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria..'; ?></legend><!--</td></tr>--> 
      <?php }  ?>
      <?php if ($disperror['columna19']==3) { ?>
		     <!-- <tr><td>--> <legend align="left"><?php echo 'El formato de fecha de la columna S, <strong> fecha_factura </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es incorrecto.'; ?></legend><!--</td></tr>-->
      <?php } ?>
	  <?php if ($disperror['columna21']==0) { ?>
		     <!-- <tr><td>--><legend align="left"><?php echo 'La columna U, <strong> modelo_procesador </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria..'; ?></legend><!--</td></tr>-->     
               <?php } ?>
               <?php if ($disperror['columna22']==0) { ?>
		      <!-- <tr><td>--><legend align="left"> <?php echo 'La columna V, <strong> cantidad_procesador </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->    
                <?php } ?>
               <?php if ($disperror['columna22']==2) { ?>
		     <!-- <tr><td>--><legend align="left"> <?php echo 'La columna V, <strong> cantidad_procesador </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>-->    
                <?php } ?> 
                
                <?php if ($disperror['columna23']==0) { ?>
		     <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna W, <strong> nucleos_totales </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>--> 
      <?php } ?>
       <?php if ($disperror['columna23']==2) { ?>
		     <!-- <tr><td>--><legend align="left"> <?php echo 'La columna W, <strong> nucleos_totales </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>--> 
      <?php } ?>
      <?php if ($disperror['columna24']==0) { ?>
		      <!-- <tr><td>--><legend align="left"><?php echo 'La columna X, <strong> nucleos_GPU </strong>del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->      
	  <?php } ?>
       <?php if ($disperror['columna24']==2) { ?>
		     <!-- <tr><td>--><legend align="left"><?php echo 'La columna X, <strong> nucleos_GPU </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica'; ?></legend><!--</td></tr>-->      
	  <?php } ?>
      <?php if ($disperror['columna25']==0) { ?>
		     <!-- <tr><td>--> <legend align="left"><?php echo 'La columna Y, <strong> memoria_RAM </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->
      <?php  } ?>
      <?php //if ($disperror['columna25']==2) { ?>
		     <!-- <tr><td>--><legend align="left"> <?php //echo 'La columna Y, <strong> memoria_RAM </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica'; ?></legend><!--</td></tr>-->
      <?php //  } ?>
      
      <?php if ($disperror['columna27']==0){ ?>
		      <!-- <tr><td>--><legend align="left"><?php echo 'La columna AA, <strong> num_elementos_almac </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->      
      <?php }  ?>
       <?php if ($disperror['columna27']==2){ ?>
		     <!-- <tr><td>--><legend align="left"> <?php echo 'La columna AA, <strong> num_elementos_almac </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica'; ?></legend><!--</td></tr>-->      
      <?php }  ?>
      <?php if ($disperror['columna28']==2){ ?>
		      <!-- <tr><td>--><legend align="left"> <?php echo 'La columna AB, <strong> total_almac </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>-->      
      <?php }  ?>
      <?php if ($disperror['columna29']==0) { ?>
		      <!-- <tr><td>--> <legend align="left"><?php echo 'La columna AC, <strong> num_arreglos </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>--> 
      <?php } ?>
        <?php if ($disperror['columna29']==2) { ?>
		     <!-- <tr><td>--><legend align="left"><?php echo 'La columna AC, <strong> num_arreglos </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>--> 
      <?php } ?>
      <?php if ($disperror['columna30']==0) { ?>
		      <!-- <tr><td>--> <legend align="left"><?php echo 'La columna AD, <strong> esquema_uno </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->  
      <?php }  ?>
      <?php if ($disperror['columna30']==2) { ?>
		     <!-- <tr><td>--><legend align="left"><?php echo 'La columna AD, <strong> esquema_uno </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>-->  
      <?php }  ?>
      <?php if ($disperror['columna31']==0) { ?>
		      <!-- <tr><td>--> <legend align="left"><?php echo 'La columna AE, <strong> esquema_dos </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->           
	   <?php } ?>
       <?php if ($disperror['columna31']==2) { ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AE, <strong> esquema_dos </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>-->            
	   <?php } ?>
       
       <?php if ($disperror['columna32']==0) { ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AF, <strong> esquema_tres </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->
      <?php } ?>
       <?php if ($disperror['columna32']==2) { ?>
		      <!-- <tr><td>--><legend align="left">  <?php echo 'La columna AF, <strong> esquema_tres </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>-->
      <?php } ?>
      <?php if ($disperror['columna33']==0) { ?>
		      <!-- <tr><td>-->  <legend align="left"><?php echo 'La columna AG, <strong> esquema_cuatro </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->            
	 <?php } ?>
      <?php if ($disperror['columna33']==2) { ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AG, <strong> esquema_cuatro </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>-->           
	 <?php } ?>
     <?php if ($disperror['columna34']==0) { ?>
		      <!-- <tr><td>-->  <legend align="left"><?php echo 'La columna AH, <strong> tec_uno </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->
      <?php  } ?>
      <?php if ($disperror['columna34']==2) { ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AH, <strong> tec_uno </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend> <!--</td></tr>-->
      <?php  } ?>
      <?php if ($disperror['columna35']==0) { ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AI, <strong> tec_dos </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->
      <?php } ?>
      <?php if ($disperror['columna35']==2) { ?>
		     <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AI, <strong> tec_dos </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>--> 
      <?php } ?>
      <?php if ($disperror['columna36']==0) { ?>
		      <!-- <tr><td>-->  <?php echo 'La columna AJ, <strong> tec_tres </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->  
      <?php }  ?>
       <?php if ($disperror['columna36']==2) { ?>
		     <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AJ, <strong> tec_tres </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>-->   
      <?php }  ?>
      <?php if ($disperror['columna37']==0) { ?>
		     <!-- <tr><td>--> <legend align="left"><?php echo 'La columna AK, <strong> tec_cuatro </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->             
	<?php  } ?>
      <?php if ($disperror['columna37']==2) { ?>
		      <!-- <tr><td>--><legend align="left">  <?php echo 'La columna AK, <strong> tec_cuatro </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>-->              
	<?php  } ?>
        <?php if ($disperror['columna38']==0) { ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AL, <strong> subtotal_uno </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->           <?php }  ?>
        <?php if ($disperror['columna38']==2) { ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AL, <strong> subtotal_uno </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>-->             <?php }  ?>      
        <?php if ($disperror['columna39']==0) { ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AM, <strong> subtotal_dos </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->
      <?php  } ?>
        <?php if ($disperror['columna39']==2) { ?>
		     <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AM, <strong> subtotal_dos </strong> ddel renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>--> 
      <?php  } ?>
      
      <?php if ($disperror['columna40']==0) {?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AN, <strong> subtotal_tres </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->            <?php   } ?>
      <?php if ($disperror['columna40']==2) {?>
		     <!-- <tr><td>--> <legend align="left"><?php echo 'La columna AN, <strong> subtotal_tres </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>-->          
        <?php   } ?>
                     
	  <?php	if ($disperror['columna41']==0) { ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AO, <strong> subtotal_cuatro </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->
      <?php } ?>
      <?php	if ($disperror['columna41']==2) { ?>
		     <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AO, <strong> subtotal_cuatro </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>-->
      <?php } ?>
      <?php if ($disperror['columna42']==0) { ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AP, <strong> arreglo_total </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->             <?php  } ?>
       <?php if ($disperror['columna42']==2) { ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AP, <strong> arreglo_total </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>-->             <?php  } ?>
                      
      <?php if ($disperror['columna43']==0) {?>
		     <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AQ, <strong> tec_com </strong>  del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->  <?php }  ?>
      <?php if ($disperror['columna43']==2) {?>
		     <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AQ, <strong> tec_com </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica, revisar el catálogo correspondiente.'; ?></legend><!--</td></tr>--> <?php }  ?> 
      
      <?php if ($disperror['columna45']==0) { ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AS, <strong> sist_oper </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>--> <?php } ?>
         <?php if ($disperror['columna45']==2) { ?>
		     <!-- <tr><td>--> <legend align="left"><?php echo 'La columna AS, <strong> sist_oper </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica, revisar el catálogo correspondiente.'; ?></legend><!--</td></tr>--> <?php } ?>       
      <?php if ($disperror['columna46']==0) {?>
		     <legend align="left"> <?php echo 'La columna AT, <strong> version_sist_oper </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend>
      <?php } ?>
      <?php if ($disperror['columna47']==0)  {?>
		       <legend align="left"><?php echo 'La columna AU, <strong> licencia </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend>      
	  <?php } ?>
      
       <?php if ($disperror['columna47']==2)  {?>
		      <legend align="left"> <?php echo 'La columna AU, <strong> licencia </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><?php } ?>
      <?php if ($disperror['columna48']==0) {?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AV, <strong> licencia_ini </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->            
	  <?php } ?>
      <?php if ($disperror['columna48']==3) { ?>
		       <legend align="left"> <?php echo 'El formato de fecha de la columna AV, <strong> licencia_ini </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es incorrecto.'; ?></legend>
      <?php } ?>
      <?php if ($disperror['columna49']==0) { ?>
		      <!-- <tr><td>--><legend align="left">  <?php echo 'La columna AW, <strong> licencia_fin </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->    
         <?php } ?>
        <?php if ($disperror['columna49']==3) { ?>
		      <!-- <tr><td>--><legend align="left">  <?php echo 'El formato de fecha de la columna AW, <strong> licencia_fin </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es incorrecto.'; ?></legend><!--</td></tr>--> 
        <?php } ?>
         <?php if ($disperror['columna50']==0) {?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AX, <strong> id_edificio </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->     
			<?php } ?> 
             <?php if ($disperror['columna50']==2) {?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AX, <strong> id_edificio </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>-->      <?php } ?>   
             <?php if ($disperror['columna51']==0){ ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AY, <strong> id_lab </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' es obligatoria.'; ?></legend><!--</td></tr>-->            <?php  } ?>
             <?php //if ($disperror['columna51']==2){ ?>
		      <!-- <tr><td>--><legend align="left"> <?php //echo 'La columna AY, <strong> id_lab </strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].' debe ser numérica.'; ?></legend><!--</td></tr>-->           <?php // } ?> 
            <?php if ($disperror['columna51']==4){ ?>
		    <!-- <tr><td>--> <legend align="left"> <?php echo 'Revisar la columna AY, <strong>id_lab</strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].'. <strong> El área no existe para está división </strong>'; ?></legend><!--</td></tr>--> <?php  } ?>
                <?php if ($disperror['columna51']==6){ ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'Revisar la columna AY, <strong>id_lab</strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].'. <strong> se ingresó con cero y no se pudo localizar el dispositivo </strong>'; ?></legend><!--</td></tr>--><?php  } ?>
              <?php if ($disperror['columna51']==5){ ?>
		      <!-- <tr><td>--> <legend align="left"> <?php echo 'La columna AY, <strong>id_lab</strong> del renglón correpondiente al no.inventario  '.$disperror['inventario'].'. <strong> se ingresó con cero aún así se localizó el dispositivo y se registró.</strong>'; ?></legend><!--</td></tr>--><?php  } ?>
		 <?php } //fin de while $disperro
	 
		 ?>
         
        
         <br/>
 <?php 
        //$querydt="DELETE FROM errorinserta";	
		//$result = pg_query($querydt) or die('Hubo un error con la base de datos');
	}//finaliza Funcion importaError

 function guardaDispError(){
	//detecta errores de datos en las columnas  
	  $querydisp="SELECT dt.inventario, CAST(dt.dispositivo_clave AS INTEGER) FROM dispositivotemp dt
                  JOIN bienes b
                  ON b.bn_clave=dt.inventario
                  JOIN errorinserta ei
                  ON ei.inventario=dt.inventario
				   WHERE columna51!=4 AND columna51!=6
                  EXCEPT
                  SELECT d.inventario,d.dispositivo_clave from dispositivo d";
				  
      $result = pg_query($querydisp) or die('Hubo un error con la base de datos');
	  $existen= pg_num_rows($result); 
	   if ($existen>0){
		?>
        <br>
      
         <legend align="left"> <h4><?php echo "Se intentaron registrar  " . $existen ." dispositivos que no cumplen con los requisitos. " ?></h4></legend> 
         
 				
	<?php
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
                <form action="../inc/erroresreg.inc.php" method="post" name="erroresreg" >
	               <legend align="left"><input name="enviar" type="submit" value="Exportar a Excel" /></legend>
	            </form>
              
              <br>
	<?php   }
	 
	}//finaliza funcion guardaDisError
	
function guardaDispErrorAct(){
	//detecta errores de datos en las columnas  
	  $querydisp="SELECT dt.inventario, CAST(dt.dispositivo_clave AS INTEGER) FROM dispositivotemp dt
                  JOIN bienes b
                  ON b.bn_clave=dt.inventario
                  JOIN errorinserta ei
                  ON ei.inventario=dt.inventario
				  WHERE columna51!=4 AND columna51!=6
                  EXCEPT
                  SELECT d.inventario,d.dispositivo_clave from dispositivo d";
				  
      $result = pg_query($querydisp) or die('Hubo un error con la base de datos');
	  $existen= pg_num_rows($result); 
	   if ($existen>0){
		?>
        <br>
          <legend align="left"> <h4><?php echo "Se intentaron actualizar  " . $existen ." dispositivos que no cumplen con los requisitos. " ?></h4></legend> 
        
 				
	<?php
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
                <form action="../inc/erroresreg.inc.php" method="post" name="erroresregact" >
	            <legend align="left"><input name="enviar" type="submit" value="Exportar a Excel" /></legend>               </form>
              
              <br>
	<?php   
	  
	}//finaliza funcion guardaDisError
	
}//finaliza clase importa
}


?>