<?php 
require_once('../inc/sesion.inc.php');
require_once('../clases/importa.class.php');

//$tuplabien= new importa();
//$tupla= new importa();
$error = new importa();

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
 


<h3>&nbsp;</h3>
<p><br/>
  <br/>
</p>
<table>
  <form  method="POST" enctype="multipart/form-data">
 <tr>
   <td>Subir archivo :</td>
   <td><input type="file" name="archivo_csv" id='archivo'></td>
 </tr>
 <tr>

   <td></td>
   <td></td>
  <br/>
<br/>
   <td colspan="2" align="center">
     <input  type="submit" value="Actualizar">
     <input type="reset" value="Cancelar">
   </td>
 </tr>
</form>
</table>


<?php 

  $file_upload = $_FILES["archivo_csv"]["name"];
  $tmp_name = $_FILES["archivo_csv"]["tmp_name"];
  $size = $_FILES["archivo_csv"]["size"];
  $tipo = $_FILES["archivo_csv"]["type"];
  $contexitobn=0;

  $contexitototal=0;
//echo $tmp_name;
 if($size > 0){
 
     $fp = fopen($tmp_name, "r");
   
     // Procesamos linea a linea el archivo  y 
     // lo insertamos en la base de datos
	 
	 $cuenta=1;
	 ?>
      <table>
      <?php 
     while($datos = fgetcsv ($fp, 1000, "\t")){
		 
		  $datosdec=utf8_string_array_encode($datos); 
		  
	      $querytemp="SELECT * FROM dispositivotemp WHERE 
		              inventario="."'".$datosdec[15]."'";
					  
		  $datostemp = pg_query($con,$querytemp);
		   
		  if (pg_num_rows($datostemp)>0) {
			 
		           $updatequery= "UPDATE dispositivotemp SET inventario='%s'
			                  WHERE inventario="."'".$datosdec[15]."'";
							  
			        $queryu=sprintf($updatequery, $datosdec[15] ); 
			   
                    $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR dispositivotemp'); 
			        $contreing=$contreing+1;
			   //echo 'Actualiza en dispositivotemp...';
			 
			
		   } else { 
		   
	   //$conterroreg=0;
	   //print_r($datos);
	   //verificar errores de inserción 
	   //si encuetra error menciona tupla, error y numero de columna
	   
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
		 $columna24=0; elseif(preg_match("/^[0-9]+$/",$datosdec[23])) $columna24=1; else $columna24=2;
      if($datosdec[24]==NULL)  //memoria_ram
		 $columna25=0; elseif(preg_match("/^[0-9]+$/",$datosdec[24])) $columna25=1; else $columna25=2;
		 if($datosdec[25]==NULL)  //ram_especificar
		 $columna26=0; elseif(is_int($datosdec[25])) $columna26=1; else $columna26=2;
      if($datosdec[26]==NULL)  //num_elem_almac
		 $columna27=0; elseif(preg_match("/^[0-9]+$/",$datosdec[26])) $columna27=1; else $columna27=2;
	  if($datosdec[27]==NULL)  //total_almac
		 $columna28=0; elseif(preg_match("/^[0-9]+$/",$datosdec[27])) $columna28=1; else $columna28=2;
	  if($datosdec[28]==NULL)  //num_arreglos
		 $columna29=0; elseif(preg_match("/^[0-9]+$/",$datosdec[28])) $columna29=1; else $columna29=2;
	  if($datosdec[29]==NULL)  //esquema_uno
		 $columna30=0; elseif(preg_match("/^[0-9]+$/",$datosdec[29])) $columna30=1; else $columna30=2;	 		 		 	 	 	       if($datosdec[30]==NULL)  //esquema_dos
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
	     $columna51=0; 	elseif(preg_match("/^[0-9]+$/",$datosdec[50])) $columna51=1; else $columna51=2;
		
		      
		      
	  //Traer el último valor en errorinserta
	  
			        $queryd="SELECT max(id_error) FROM errorinserta";
                    $registrod= pg_query($con,$queryd);
                    $ultimo= pg_fetch_array($registrod);
	
		      if ($ultimo[0]==0)
				    $ultimo=1;//inicializando la tabla dispositivouno
			  else 
			        $ultimo=$ultimo[0]+1;
	   
	  
	   $query= "INSERT INTO errorinserta(id_error,tupla,columna1,columna2,columna3,columna4,columna5,
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
										 ($ultimo,$cuenta,$columna1,$columna2,$columna3,$columna4,$columna5,
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
	   	 
	   $result=pg_query($con, $query) or die('ERROR AL INSERTAR en errorinserta'); 
	  
	   // generar una tabla con nombre de las columnas 
		 								                                            
       $query = "INSERT INTO dispositivotemp ( dispositivo_clave,usuario_final_clave,familia_clave,--0,1,2
                                               tipo_ram_clave,tecnologia_clave,resguardo_nombre,--3,4,5
										       resguardo_no_empleado, usuario_nombre,usuario_ubicacion,--6,7,8
                                               usuario_perfil, usuario_sector,serie,--9,10,11
                                               marca_p, no_factura, anos_garantia,--12,13,14
                                               inventario, modelo_p, proveedor,--15,16,17
										       fecha_factura,familia_especificar,--18,19
										       modelo_procesador,cantidad_procesador,nucleos_totales,--20,21,22
										       nucleos_gpu, memoria_ram,ram_especificar, --23,24,25
										       num_elementos_almac,total_almac,num_arreglos,--26,27,28
										       esquema_uno,esquema_dos,esquema_tres, esquema_cuatro,
                                               tec_uno,tec_dos,tec_tres,tec_cuatro,
                                               subtotal_uno,subtotal_dos,subtotal_tres,subtotal_cuatro,
                                               arreglo_total,tec_com,tec_com_otro,
                                               sist_oper,version_sist_oper,licencia,
										       licencia_ini,licencia_fin,id_edificio,
											   id_lab) VALUES 
										      ( $datosdec[0], $datosdec[1], $datosdec[2], 
                                               $datosdec[3], $datosdec[4], '$datosdec[5]', --tipo_ram
											   $datosdec[6], '$datosdec[7]', '$datosdec[8]', --resguardo
											   $datosdec[9], $datosdec[10], '$datosdec[11]', --usuario_perfil
											  '$datosdec[12]', '$datosdec[13]', '$datosdec[14]', --marca_p
											  '$datosdec[15]', '$datosdec[16]', '$datosdec[17]', --inventario
											  '$datosdec[18]', '$datosdec[19]',                 --fechafactura
											  '$datosdec[20]','$datosdec[21]','$datosdec[22]', --modelo_proc
											  '$datosdec[23]','$datosdec[24]','$datosdec[25]',  --nucleos_gpu
											   $datosdec[26], $datosdec[27], $datosdec[28],    --num_elementos
											   $datosdec[29], $datosdec[30], $datosdec[31], $datosdec[32], --esquema_uno
											   $datosdec[33], $datosdec[34],$datosdec[35],$datosdec[36], --tec_uno
											   $datosdec[37], $datosdec[38],$datosdec[39],$datosdec[40], --subtotal_uno
											   $datosdec[41], $datosdec[42],'$datosdec[43]', --arreglo_total
											   $datosdec[44], '$datosdec[45]',$datosdec[46],--sist_oper
											   '$datosdec[47]', '$datosdec[48]',$datosdec[49],--licencia
											   $datosdec[50])"; //$datos[51] previendo modificaccion para idmod
                 
                          $result=@pg_query($con, $query);
						  
				          //echo $query;
		
                         if (!$result) {
		        	          $queryre="SELECT max(id_error) FROM registroerror";
                              $registrore= pg_query($con,$queryre);
                              $ultimoerror= pg_fetch_array($registrore);
	
		                     if ($ultimoerror[0]==0)
				                    $ultimoerror=1;//inicializando la tabla dispositivouno
			                 else 
			                        $ultimoerror=$ultimoerror[0]+1;	  
             
			                 $querybien="INSERT INTO registroerror(id_error,inventario,clave_dispositivo,fecharegistro,id_div,tipoerror)
			                         VALUES (%d,'%s',%d,'%s',%d,'%s')";
						   
			                 $queryerror=sprintf($querybien,$ultimoerror,$datosdec[15],$datosdec[0],date('Y-m-d H:i:s'),$_SESSION['id_div'],'ra' );			 
			                 $registroerror= pg_query($con,$queryerror);
			                 $conterroreg=$conterroreg+1;
                               //exit;
			             } else {

			                $contexitototal=	$contexitototal+1;
 		  
                    } //if(!$result) else
	
		   } //if (pg_num_rows($datostemp)>0) else
       $cuenta=$cuenta+1;
	   } //while para insertar en dispositivotemporal
	   
	   
	   // echo 'Ingresando en dispositivotemp...';
	   $cuentatotal=0;
       $cuentacat=0;
	   
	    $query="SELECT * FROM dispositivotemp"; 
		
		$datos = pg_query($con,$query);
		while ($disp = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
	          // Busca en dispositivo
		      $queryinv="SELECT * FROM dispositivo WHERE 
		              inventario="."'".$disp['inventario']."'";
					  
		       $datosinv = pg_query($con,$queryinv);
			   
		       //De existir en dispositivo actualiza toda la tupla, en caso contrario ingresa en erroractualiza
			               
							
		       if (pg_num_rows($datosinv)>0) {
			     // traer bn_id
				 // echo 'Buscar en bienes'; 
			    
							 $queryb="SELECT bn_id
							          FROM bienes
			                          WHERE bn_clave="."'".$disp['inventario']."'" . "
							          OR bn_anterior="."'".$disp['inventario']."'";
			          
			                $registrob= pg_query($con,$queryb);
			                $bienes= pg_fetch_array($registrob);
							
			                $querye="SELECT id_lab,velocidad,cache,tipotarjvideo,modelotarjvideo,
			                                memoriavideo,equipoaltorend,accesorios,garantiamanten,arquitectura,
							                estadobien,servidor,descextensa 
							                FROM equipoc
			                                WHERE inventario="."'".$disp['inventario']."'";
							  
                            $registroe= pg_query($con,$querye);
                            $equipoc= pg_fetch_array($registroe);
			 
			                if($disp['id_lab']==0) // id id_lab=0
			                       $lab=$equipo[0];
			                else 	 
			                       $lab=$disp['id_lab'];
				
			       //buscar información de los catálogos de marca y memoria ram
			  
			       $querym="SELECT id_marca 
							       FROM cat_marca
			                       WHERE descmarca="."'".strtoupper($disp['marca_p']."'");
							  
                    $registrom= pg_query($con,$querym);
              $marca= pg_fetch_array($registrom);
			  
			  $querymr="SELECT id_mem_ram 
							  FROM cat_memoria_ram
			                  WHERE cantidad_ram="."'".$disp['memoria_ram']."'";
							  
              $registromr= pg_query($con,$querymr);
              $ram= pg_fetch_array($registromr);		  
		         
		      if ($ram[0]==NULL)
				  $ram=0;
			  else 
			      $ram=$ram[0];	  

              $queryd="SELECT detalle_ub 
							  FROM laboratorios
			                  WHERE id_lab=" . $disp['id_lab'];
							  
              $registrod= pg_query($con,$queryd);
              $detalle= pg_fetch_array($registrod);	

              $updatequery= "UPDATE laboratorios SET detalle_ubcomp= '%s'
			                  WHERE id_lab=" .$disp['id_lab'];
			   
			  $queryu=sprintf($updatequery, $detalle[0]|| ' ' || $disp['usuario_ubicacion'] ); 
			   
              $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR laboratorios');
			  
			  if ($disp['fecha_factura']==0) 
			      $disp['fecha_factura']= date("Y-m-d", strtotime($disp['fecha_factura']));
			  if ($disp['licencia_ini']==0) 
			      $disp['licencia_ini']= date("Y-m-d", strtotime($disp['licencia_ini']));	  
              if ($disp['licencia_fin']==0) 
			      $disp['licencia_fin']= date("Y-m-d", strtotime($disp['licencia_fin']));	
			  
			  //if ($bienes[0]!=NULL ){
				  
			  $updatequery= "UPDATE dispositivo SET bn_id=%d,id_lab=%d,dispositivo_clave=%d,usuario_final_clave=%d,familia_clave=%d,tipo_ram_clave=%d,tecnologia_clave=%d,nombre_resguardo='%s',resguardo_no_empleado=%d,usuario_nombre='%s',usuario_ubicacion='%s',usuario_perfil=%d,usuario_sector=%d,serie='%s',marca_p='%s',no_factura='%s',anos_garantia='%s',inventario='%s',modelo_p='%s',proveedor_p='%s',fecha_factura='%s',familia_especificar='%s',modelo_procesador='%s',cantidad_procesador='%s',nucleos_totales='%s',nucleos_gpu='%s',memoria_ram='%s',ram_especificar='%s',num_elementos_almac=%d,total_almac=%d,num_arreglos=%d,esquema_uno=%d,esquema_dos=%d,esquema_tres=%d,esquema_cuatro=%d,tec_uno=%d,tec_dos=%d,tec_tres=%d,tec_cuatro=%d,subtotal_uno=%d,subtotal_dos=%d,subtotal_tres=%d,subtotal_cuatro=%d,arreglo_total=%d,tec_com=%d, sist_oper=%d, version_sist_oper='%s',licencia=%d,licencia_ini='%s',licencia_fin='%s',fecha='%s',velocidad='%s',memcache='%s',tipotarjvideo='%s', modelotarjvideo='%s', memoriavideo='%s',equipoaltorend='%s',accesorios='%s',garantiamanten='%s',arquitectura='%s',estadobien='%s',servidor='%s',descextensa='%s',id_marca=%d,marca='%s',marca_esp='%s',id_mem_ram=%d,importa=%d
				 WHERE inventario="."'".$disp['inventario']."'";
					//echo $updatequery;		  
							  
			        $queryu=sprintf($updatequery, $bienes[0],$disp['id_lab'],$disp['dispositivo_clave'],$disp['usuario_final_clave'], $disp['familia_clave'],$disp['tipo_ram_clave'],$disp['tecnologia_clave'],$disp['resguardo_nombre'],$disp['resguardo_no_empleado'],$disp['usuario_nombre'],$disp['usuario_ubicacion'],$disp['usuario_perfil'],$disp['usuario_sector'],$disp['serie'],$disp['marca_p'],$disp['no_factura'],$disp['anos_garantia'],$disp['inventario'],$disp['modelo_p'],$disp['proveedor'],$disp['fecha_factura'],$disp['familia_especificar'],$disp['modelo_procesador'],$disp['cantidad_procesador'],$disp['nucleos_totales'],$disp['nucleos_gpu'],$disp['memoria_ram'],$disp['ram_especificar'],$disp['num_elementos_almac'],$disp['total_almac'],$disp['num_arreglos'],$disp['esquema_uno'],$disp['esquema_dos'],$disp['esquema_tres'],$disp['esquema_cuatro'],$disp['tec_uno'],$disp['tec_dos'],$disp['tec_tres'],$disp['tec_cuatro'],$disp['subtotal_uno'],$disp['subtotal_dos'],$disp['subtotal_tres'],$disp['subtotal_cuatro'],$disp['arreglo_total'],$disp['tec_com'],$disp['sist_oper'],$disp['version_sist_oper'],$disp['licencia'],$disp['licencia_ini'],$disp['licencia_fin'],date("Y-m-d"),$equipoc[1],$equipoc[2],$equipoc[3], $equipoc[4],$equipoc[5],$equipoc[6], $equipoc[7],$equipoc[8],$equipoc[9], $equipoc[10],$equipoc[11],$equipoc[12], $marca[0],$disp['marca'],'', $ram[0],1); 
			   
                    $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR tupla en dispositivo'); 
					
					 if (!$result) 
					      echo "Ocurrió un error.\n";
                     else
 		                  $cuentaact++;
				
			    //  }
			 
		       
		  
		  } // fin de la validación si existe
		   else { 
		                    $queryb="SELECT bn_id
							          FROM bienes
			                          WHERE bn_clave="."'".$disp['inventario']."'" . "
							          OR bn_anterior="."'".$disp['inventario']."'";
			          
			                $registrob= pg_query($con,$queryb);
			                $bienes= pg_fetch_array($registrob);
				
			                $queryre="SELECT max(id_error) FROM registroerror";
                             $registrore= pg_query($con,$queryre);
                             $ultimoerror= pg_fetch_array($registrore);
	
		                 if ($ultimoerror[0]==0)
				             $ultimoerror=1;//inicializando la tabla dispositivouno
			             else 
			                 $ultimoerror=$ultimoerror[0]+1;	  
             
			             $querybien="INSERT INTO registroerror(id_error,inventario,clave_dispositivo,fecharegistro,id_div,tipoerror)
			                         VALUES (%d,'%s',%d,'%s',%d,'%s')";
						   
			             $queryerror=sprintf($querybien,$ultimoerror,$disp['inventario'],$disp['dispositivo_clave'],date('Y-m-d H:i:s'),$_SESSION['id_div'],'ba' );			 
			             $registroerror= pg_query($con,$queryerror);
			             $conterrorbn++;  
				
				
				
			  }//valores que estan en bienes //if ($bienes[0]!=NULL )
		
		}//fin de while para insertar datos en dispositivo 
		
		
		 $querydt="DELETE FROM dispositivotemp";	
			
	     $datosdt = pg_query($con,$querydt);
		
		 $error->importaError();

		 $total=$conterrorbn+$cuentaact; 
		
		 if ( $conterrorbn ==0 && $conterroreg == 0){?>
		 <tr>	 
		 <td> <h4><?php echo "Actualización con éxito" ?></h4> </td></tr>
         
         
		 <?php
		
		 }
		
		?>
		<br>
         <tr>
             <td> <h4><?php echo "Se actualizaron " . $cuentaact . " / " . $total . " dispositivos."; ?></h4> </td></tr><br>
               <?php  if ( $conterrorbn > 0) { ?>
             <td> <h4><?php echo "Faltó actualizar  " . $conterrorbn ." dispositivos que no se encuentran en el inventario de la facultad." ?></h4> </td></tr>
         <tr><td> <br>   
              <form action="../inc/erroresbn.inc.php" method="post" name="erroresbnact" >
	          <input name="actbn" type="submit" value="Exportar a Excel" />
	          </form>
         </td></tr>
        <?php
		 }
		 
		 if ($conterroreg > 0) { ?>
                 <td> <h4><?php echo "Hay " . $conterroreg ." dispositivos que no cumplen con los requisitos. " ?></h4> </td></tr>
              <tr><td>
                <form action="../inc/erroresreg.inc.php" method="post" name="erroresregact" >
	               <input name="actreg" type="submit" value="Exportar a Excel" />
	            </form>
              </td></tr>
         </table>
          <?php 
		  } 
 }
?>

</div></td>          
</tr>


<?php //require('pie.inc.php'); ?>


