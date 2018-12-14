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
	
	
		 //detectando el tipo de error
		 
		   if($valida['id_lab']=='0' ){
			       $querye="SELECT id_lab
							  FROM equipoc
			                  WHERE inventario="."'".$valida['inventario']."'";
							  
                    $registroe= pg_query($querye) or die('Hubo un error con la base de datos');
				
		
		            $exite=pg_fetch_array($registroe);
		 
		            if ($exite[0] == NULL) 
		                   $errorlab=6;
		            else 
		                   $errorlab=5;
				  		 
               
		   }elseif ($valida['id_lab']!='0' ){  
			          //valida que sexita el area para ingresar
					  
		                $querylab="SELECT * FROM laboratorios l
                                   JOIN departamentos d
                                   ON d.id_dep=l.id_dep
                                   WHERE id_div=".$_SESSION['id_div'].
					               " AND l.id_lab=".$valida['id_lab'];
			
		                $existelab= pg_query($querylab) or die('Hubo un error con la base de datos');		
			
	    	            $cuantos=pg_num_rows($existelab);
		
			          if ($cuantos==0){
			                     $errorlab=4;
					             $lab=0;	
								 $bandera=0;
								 }	
					  else{      
						         $errorlab=8;
							     $lab=$valida['id_lab'];
						
						} 
		               
		           }
			
	  
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
	  if($valida['proveedor_p']==NULL)  //proveedor_p
		 $columna18=0; elseif(is_int($valida['proveedor_p'])) $columna18=1; else $columna18=2;
	  if($valida['fecha_factura']==NULL)  //fecha_factura
		 $columna19=0; elseif(!preg_match($regexFecha,$valida['fecha_factura'])) $columna19=3; else $columna19=2;
	  if($valida['modelo_procesador']==NULL)  //modelo_procesador
		 $columna20=0; elseif(is_int($valida['modelo_procesador'])) $columna20=1; else $columna20=2; 
	  if($valida['familia_especificar']==NULL)  //familia_especificar
		 $columna21=0; elseif(is_int($valida['familia_especificar'])) $columna21=1; else $columna21=2;
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
		 $columna30=0; elseif(preg_match("/^[0-9]+$/",$valida['esquema_uno'])) $columna30=1; else $columna30=2;	 		 		 	 	 	      if($valida['esquema_dos']==NULL)  //esquema_dos
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
	     $columna48=0;  elseif(!preg_match($regexFecha,$valida['licencia_ini'])) $columna48=3; else $columna48=2;
	  if($valida['licencia_fin']==NULL)  //licencia_fin
	     $columna49=0;  elseif(!preg_match($regexFecha,$valida['licencia_fin'])) $columna49=3; else $columna49=2;
	  if($valida['id_edif']==NULL)  //id_edif
	     $columna50=0;  elseif(preg_match("/^[0-9]+$/",$valida['id_edif'])) $columna50=1; else $columna50=2;
	
	  if($lab==NULL)  //id_lab
	          $columna51=0;   else $columna51=1;  
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
	   
		}
}

function revisarError($revisar,$tupla){
	
	echo 'valores recibidos';
	print_r ($revisar);
	 $regexFecha = '/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/';
	
	   
	  if($datosdec[0]==NULL) //dispositivo_clave
	     $columna1=0; elseif(preg_match("/^[0-9]+$/",$datosdec[0])) $columna1=1; else $columna1=2;	 
	  if($datosdec[1]==NULL)//usuario_final_clave
	     $columna2=0; elseif(preg_match("/^[0-9]+$/",$datosdec[1])) $columna2=1; else $columna2=2;	
	  if($datosdec[2]==NULL) //familia_clave
	     $columna3=0;  elseif(preg_match("/^[0-9]+$/",$datosdec[2])) $columna3=1; else $columna3=2;
	  if($datosdec[3]==NULL) //tipo_ram_clave
		 $columna4=0; elseif(preg_match("/^[0-9]+$/",$datosdec[3])) $columna4=1; else $columna4=2;
	  if($datosdec[4]==NULL) //tecnologia_clave
		 $columna5=0; elseif(preg_match("/^[0-9]+$/",$datosdec[4])) $columna5=1; else $columna5=2;
	  if($datosdec[5]==NULL) //resguardo_nombre
		 $columna6=0; elseif(is_int($datosdec[5])) $columna6=1; else $columna6=2;
	  if($datosdec[6]==NULL) //resguardo_no_empleado
	     $columna7=0; elseif(is_int($datosdec[6])) $columna7=1; else $columna7=2;
	  if($datosdec[7]==NULL) //usuario_nombre
		 $columna8=0; elseif(is_int($datosdec[7])) $columna8=1; else $columna8=2;
	  if($datosdec[8]==NULL) //usuario_ubicación
	     $columna9=0;  elseif(is_int($datosdec[8])) $columna9=1; else $columna9=2;
	  if($datosdec[9]==NULL) //usuario_perfil
		 $columna10=0;  elseif(preg_match("/^[0-9]+$/",$datosdec[9])) $columna10=1; else $columna10=2;
	  if($datosdec[10]==NULL) //usuario_sector
		 $columna11=0; elseif(preg_match("/^[0-9]+$/",$datosdec[10])) $columna11=1; else $columna11=2;
	  if($datosdec[11]==NULL) //no_servicio o inventario
		 $columna12=0; elseif(is_int($datosdec[11])) $columna12=1; else $columna12=2;
	  if($datosdec[12]==NULL) //marca_p
		 $columna13=0;  elseif(is_int($datosdec[12])) $columna13=1; else $columna13=2;
	  if($datosdec[13]==NULL) //no_factura
		 $columna14=0; elseif(is_int($datosdec[13])) $columna14=1; else $columna14=2;
	  if($datosdec[14]==NULL) //años_garantia
		 $columna15=0; elseif(is_int($datosdec[14])) $columna15=1; else $columna15=2;
	  if($datosdec[15]==NULL)  //inventario
		 $columna16=0; elseif(is_int($datosdec[15])) $columna16=1; else $columna16=2;
	  if($datosdec[16]==NULL)  //modelo_p
		 $columna17=0; elseif(is_int($datosdec[16])) $columna17=1; else $columna17=2;
	  if($datosdec[17]==NULL)  //proveedor_p
		 $columna18=0; elseif(is_int($datosdec[17])) $columna18=1; else $columna18=2;
	  if($datosdec[18]==NULL)  //fecha_factura
		 $columna19=0; elseif(!preg_match($regexFecha,$datosdec[18])) $columna19=3; else $columna19=2;
	  if($datosdec[19]==NULL)  //modelo_procesador
		 $columna20=0; elseif(is_int($datosdec[19])) $columna20=1; else $columna20=2; 
	  if($datosdec[20]==NULL)  //familia_especificar
		 $columna21=0; elseif(is_int($datosdec[20])) $columna21=1; else $columna21=2;
	  if($datosdec[21]==NULL)  //cantidad_procesador
		 $columna22=0; elseif(preg_match("/^[0-9]+$/",$datosdec[21])) $columna22=1; else $columna22=2;
	  if($datosdec[22]==NULL)  //nucleos_totales
		 $columna23=0; elseif(preg_match("/^[0-9]+$/",$datosdec[22])) $columna23=1; else $columna23=2;
	  if($datosdec[23]==NULL)  //nucleos_gpu
		 $columna24=0; elseif(is_int($datosdec[23])) $columna24=1; else $columna24=2;
      if($datosdec[24]==NULL)  //memoria_ram
		 $columna25=0; elseif(preg_match("/^[0-9]+$/",$datosdec[24])) $columna25=1; else $columna25=2;
		 if($datosdec[25]==NULL)  //ram_especificar
		 $columna26=0; elseif(is_int($datosdec[25])) $columna26=1; else $columna26=2;
      if($datosdec[26]==NULL)  //num_elem_almac
		 $columna27=0; elseif(preg_match("/^[0-9]+$/",$datosdec[26])) $columna27=1; else $columna27=2;
	  if($datosdec[27]==NULL)  //total_almac
		 $columna28=0; elseif(preg_match("/^[0-9]+$/",$datosdec[27])) $columna28=1; else $columna28=2;
	  if($datosdec[28]==NULL)  //num_arreglos
		 $columna29=0; elseif(is_int($datosdec[28])) $columna29=1; else $columna29=2;
	  if($datosdec[29]==NULL)  //esquema_uno
		 $columna30=0; elseif(preg_match("/^[0-9]+$/",$datosdec[29])) $columna30=1; else $columna30=2;	 		 		 	 	 	      
     if($datosdec[30]==NULL)  //esquema_dos
		 $columna31=0;  elseif(preg_match("/^[0-9]+$/",$datosdec[30])) $columna31=1; else $columna31=2;
	  if($datosdec[31]==NULL)  //esquema_tres
		 $columna32=0;  elseif(preg_match("/^[0-9]+$/",$datosdec[31])) $columna32=1; else $columna32=2;
	  if($datosdec[32]==NULL)  //esquema_cuatro
		 $columna33=0;  elseif(preg_match("/^[0-9]+$/",$datosdec[32])) $columna33=1; else $columna33=2;
	  if($datosdec[33]==NULL)  //tec_uno
		 $columna34=0;  elseif(preg_match("/^[0-9]+$/",$datosdec[33])) $columna34=1; else $columna34=2;
	  if($datosdec[34]==NULL)  //tec_dos
		 $columna35=0;  elseif(preg_match("/^[0-9]+$/",$datosdec[34])) $columna35=1; else $columna35=2;
	  if($datosdec[35]==NULL)  //tec_tres
		 $columna36=0;	elseif(preg_match("/^[0-9]+$/",$datosdec[35])) $columna36=1; else $columna36=2;	
	  if($datosdec[36]==NULL)  //tec_cuatro
		 $columna37=0;  elseif(preg_match("/^[0-9]+$/",$datosdec[36])) $columna37=1; else $columna37=2;
	  if($datosdec[37]==NULL)  //subtotal_uno
		 $columna38=0;  elseif(preg_match("/^[0-9]+$/",$datosdec[37])) $columna38=1; else $columna38=2;
	  if($datosdec[38]==NULL)  //subtotal_dos
		 $columna39=0;  elseif(preg_match("/^[0-9]+$/",$datosdec[38])) $columna39=1; else $columna39=2;
	  if($datosdec[39]==NULL)  //subtotal_tres
		 $columna40=0;	elseif(preg_match("/^[0-9]+$/",$datosdec[39])) $columna40=1; else $columna40=2;
	  if($datosdec[40]==NULL)  //subtotal_cuatro
		 $columna41=0;	elseif(preg_match("/^[0-9]+$/",$datosdec[40])) $columna41=1; else $columna41=2; 	 
	  if($datosdec[41]==NULL)  //arreglo_total
		 $columna42=0;  elseif(preg_match("/^[0-9]+$/",$datosdec[41])) $columna42=1; else $columna42=2;
	  if($datosdec[42]==NULL)  //tec_com
		 $columna43=0;	elseif(preg_match("/^[0-9]+$/",$datosdec[42])) $columna43=1; else $columna43=2;
	  if($datosdec[43]==NULL)  //tec_com_tro
		 $columna44=0;	elseif(is_int($datosdec[43])) $columna44=1; else $columna44=2;
	  if($datosdec[44]==NULL)  //sist_oper
		 $columna45=0;  elseif(preg_match("/^[0-9]+$/",$datosdec[44])) $columna45=1; else $columna45=2;
	  if($datosdec[45]==NULL)  //version_sist_oper
	     $columna46=0;  elseif(is_int($datosdec[45])) $columna46=1; else $columna46=2;
	  if($datosdec[46]==NULL)  //licencia
	     $columna47=0;  elseif(preg_match("/^[0-9]+$/",$datosdec[46])) $columna47=1; else $columna47=2;
	  if($datosdec[47]==NULL)  //licencia_ini
	     $columna48=0;  elseif(!preg_match($regexFecha,$datosdec[47])) $columna48=3; else $columna48=2;
	  if($datosdec[48]==NULL)  //licencia_fin
	     $columna49=0;  elseif(!preg_match($regexFecha,$datosdec[48])) $columna49=3; else $columna49=2;
	  if($datosdec[49]==NULL)  //id_edif
	     $columna50=0;  elseif(preg_match("/^[0-9]+$/",$datosdec[49])) $columna50=1; else $columna50=2;
	  if($datosdec[50]==NULL)  //id_lab
	     $columna51=0; 	elseif(preg_match("/^[0-9]+$/",$datosdec[50])) $columna51=1; elseif($datosdec[50]==0) $columna51=3; else $columna51=2;
		      
	      //Traer el último valor en errorinserta
			        $queryd="SELECT max(id_error) FROM errorinserta";
                   // $registrod= pg_query($con,$queryd);
				    $registrod= pg_query($queryd) or die('Hubo un error con la base de datos');
                    $ultimo= pg_fetch_array($registrod);
	
		      if ($ultimo[0]==0)
				    $ultimo=1;//inicializando la tabla dispositivouno
			  else 
			        $ultimo=$ultimo[0]+1;
	   
	          $queryei= "INSERT INTO errorinserta(id_error,tupla,columna1,columna2,columna3,columna4,columna5,
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
										 (%d,%d,%d,%d,%d,%d,%d,
										 %d,%d,%d,%d,%d,%d,
										 %d,%d,%d,%d,%d,%d,
										 %d,%d,%d,%d,%d,%d,
										 %d,%d,%d,%d,%d,%d,
										 %d,%d,%d,%d,%d,%d,
										 %d,%d,%d,%d,%d,%d,
										 %d,%d,%d,%d,%d,%d,
										 %d,%d,%d,%d,%d,%d,
										 %d,%d,%d,%d,%d,%d,
										 %d)";
				$queryerror=sprintf($queryei,$ultimo,$tupla,$columna1,$columna2,$columna3,$columna4,$columna5,
										 $columna6,$columna7,$columna8,$columna9,$columna10,
	                                     $columna11,$columna12,$columna13,$columna14,$columna15,
										 $columna16,$columna17,$columna18,$columna19,$columna20,
										 $columna21,$columna22,$columna23,$columna24,$columna25,
										 $columna26,$columna27,$columna28,$columna29,$columna30,
										 $columna31,$columna32,$columna33,$columna34,$columna35,
										 $columna36,$columna37,$columna38,$columna39,$columna40,
										 $columna41,$columna42,$columna43,$columna44,$columna45,
										 $columna46,$columna47,$columna48,$columna49,$columna50,
										 $columna51 );
				/*						 
				$queryerror=sprintf($query,$ultimo,$tupla,$columna1,$columna2,$columna3,$columna4,$columna5,
										 $columna6,$columna7,$columna8,$columna9,$columna10,
	                                     $columna11,NULL,$columna13,$columna14,$columna15,
										 $columna16,$columna17,$columna18,$columna19,NULL,
										 $columna21,$columna22,$columna23,$columna24,$columna25,
										 NULL,$columna27,NULL,$columna29,$columna30,
										 $columna31,$columna32,$columna33,$columna34,$columna35,
										 $columna36,$columna37,$columna38,$columna39,$columna40,
										 $columna41,$columna42,$columna43,NULL,$columna45,
										 $columna46,$columna47,$columna48,$columna49,$columna50,
										 $columna51 );			*/			 
			   
			    $registroerror= pg_query($queryerror) or die('ERROR AL INSERTAR en errorinserta');							 
	   //echo $query;
	 
	   
} //finaliza funcion revisa error

	function importaError(){
	
	 $queryerror="SELECT * FROM errorinserta";
     $result = pg_query($queryerror) or die('Hubo un error con la base de datos');
	 $existen= pg_num_rows($result); 
	
	 if ($existen>0){
		?>
        <br> 
		<legend align="center"><h3>Listado de errores</h3></legend>
        <?php 						
	 }
 
		while ($disperror = pg_fetch_array($result, NULL,PGSQL_ASSOC)) 
		{   if ($disperror['columna1']==0) {?>
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
      <?php }  ?>
      <?php if ($disperror['columna19']==3) { ?>
		      <tr><td> <?php echo 'El formato de fecha de la columna S, <strong> fecha_factura </strong> del renglón '.$disperror['tupla'].' es incorrecto.'; ?></td></tr> 
      <?php } ?>
	  <?php if ($disperror['columna21']==0) { ?>
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
	  <?php } ?>
      <?php if ($disperror['columna48']==3) { ?>
		      <tr><td> <?php echo 'El formato de fecha de la columna AV, <strong> licencia_ini </strong> del renglón  '.$disperror['tupla'].' es incorrecto.'; ?></td></tr> 
      <?php } ?>
      <?php if ($disperror['columna49']==0) { ?>
		      <tr><td> <?php echo 'La columna AW, <strong> licencia_fin </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>     
         <?php } ?>
        <?php if ($disperror['columna49']==3) { ?>
		      <tr><td> <?php echo 'El formato de fecha de la columna AW, <strong> licencia_fin </strong> del renglón  '.$disperror['tupla'].' es incorrecto.'; ?></td></tr> 
        <?php } ?>
         <?php if ($disperror['columna50']==0) {?>
		      <tr><td> <?php echo 'La columna AX, <strong> id_edificio </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>      
			<?php } ?> 
             <?php if ($disperror['columna50']==2) {?>
		      <tr><td> <?php echo 'La columna AX, <strong> id_edificio </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>      <?php } ?>   
             <?php if ($disperror['columna51']==0){ ?>
		      <tr><td> <?php echo 'La columna AY, <strong> id_lab </strong> del renglón '.$disperror['tupla'].' es obligatoria.'; ?></td></tr>            <?php  } ?>
             <?php //if ($disperror['columna51']==2){ ?>
		      <tr><td> <?php //echo 'La columna AY, <strong> id_lab </strong> del renglón '.$disperror['tupla'].' debe ser numérica.'; ?></td></tr>            <?php // } ?> 
            <?php if ($disperror['columna51']==4){ ?>
		      <tr><td> <?php echo 'Revisar la columna AY, <strong>id_lab</strong> del renglón '.$disperror['tupla'].'. <strong> El área no existe para está división </strong>'; ?></td></tr> <?php  } ?>
                <?php if ($disperror['columna51']==6){ ?>
		      <tr><td> <?php echo 'Revisar la columna AY, <strong>id_lab</strong> del renglón '.$disperror['tupla'].'. <strong> se ingresó con cero y no se pudo localizar el dispositivo </strong>'; ?></td></tr> <?php  } ?>
              <?php if ($disperror['columna51']==5){ ?>
		      <tr><td> <?php echo 'La columna AY, <strong>id_lab</strong> del renglón '.$disperror['tupla'].'. <strong> se ingresó con cero aún asi se localizó el dispositivo y se registró.</strong>'; ?></td></tr> <?php  } ?>
		 <?php } //fin de while $disperro
		 ?>
         
         <br>
 <?php 
        //$querydt="DELETE FROM errorinserta";	
		//$result = pg_query($querydt) or die('Hubo un error con la base de datos');
	}//finaliza Funcion importaError



}//finaliza clase importa

?>