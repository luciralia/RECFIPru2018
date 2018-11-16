<?php 
//require_once('../inc/sesion.inc.php');
require_once('../conexion.php');
require_once('../clases/importa.class.php');

session_start(); 
//$invent = new importa();
$error = new importa();


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

<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr>
    <td align="center"><h2>Importar Dispositivos  </h2></td>
  </tr>
<tr>

<td><div class="centrado"> 

<br/>
<br/>
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
     <input  type="submit" value="Importar">
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
   
     // Procesamos linea a linea el archivo CSV y 
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
			   
                    $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR dispositivo uno'); 
			        $contreing=$contreing+1;
			   //echo 'Actualiza en dispositivotemp...';
			 
			
		   } else { 
	   //$conterroreg=0;
	   //print_r($datos);
	   //verificar errores de inserción 
	   //si encuetra error menciona tupla, error y numero de columna
	   
	   
	  if($datosdec[0]==NULL) //dispositivo_clave
	     $columna1=0; else $columna1=1;	 
	  if($datosdec[1]==NULL)//usuario_final_clave
	     $columna2=0; else  $columna2=1;	
	  if($datosdec[2]==NULL) //familia_clave
	     $columna3=0; else  $columna3=1;	
	  if($datosdec[3]==NULL) //tipo_ram_clave
		 $columna4=0; else  $columna4=1;
	  if($datosdec[4]==NULL) //tecnologia_clave
		 $columna5=0; else $columna5=1;
	  if($datosdec[5]==NULL) //resguardo_nombre
		 $columna6=0; else $columna6=1;
	  if($datosdec[6]==NULL) //resguardo_no_empleado
	     $columna7=0; else $columna7=1;
	  if($datosdec[7]==NULL) //usuario_nombre
		 $columna8=0; else $columna8=1;
	  if($datosdec[8]==NULL) //usuario_ubicación
	     $columna9=0; else  $columna9=1;
	  if($datosdec[9]==NULL) //usuario_perfil
		 $columna10=0; else $columna10=1;
	  if($datosdec[10]==NULL) //usuario_sector
		 $columna11=0; else  $columna11=1;
	  if($datosdec[11]==NULL) //no_servicio o inventario
		 $columna12=0; else  $columna12=NULL;	 
	  if($datosdec[12]==NULL) //marca_p
		 $columna13=0; else  $columna13=1;
	  if($datosdec[13]==NULL) //no_factura
		 $columna14=0; else  $columna14=1;
	  if($datosdec[14]==NULL) //años_garantia
		 $columna15=0; else  $columna15=1;
	  if($datosdec[15]==NULL)  //inventario
		 $columna16=0; else  $columna16=1;
	  if($datosdec[16]==NULL)  //modelo_p
		 $columna17=0; else  $columna17=1;
	  if($datosdec[17]==NULL)  //proveedor_p
		 $columna18=0;	else  $columna18=1;
	  if($datosdec[18]==NULL)  //fecha_factura
		 $columna19=0;	else  $columna19=1; 
	  if($datosdec[19]==NULL)  //modelo_procesador
		 $columna20=0;	else  $columna20=NULL;  
	  if($datosdec[20]==NULL)  //familia_especificar
		 $columna21=0;	else  $columna21=1;  
	  if($datosdec[21]==NULL)  //cantidad_procesador
		 $columna22=0; else  $columna22=1;
	  if($datosdec[22]==NULL)  //nucleos_totales
		 $columna23=0;	else  $columna23=1;
	  if($datosdec[23]==NULL)  //nucleos_gpu
		 $columna24=0;	else  $columna24=1;
      if($datosdec[24]==NULL)  //memoria_ram
		 $columna25=0;	else  $columna25=1;
		 if($datosdec[25]==NULL)  //ram_especificar
		 $columna26=0; else  $columna26=NULL;
      if($datosdec[26]==NULL)  //num_elem_almac
		 $columna27=0; else  $columna27=1;
	  if($datosdec[27]==NULL)  //total_almac
		 $columna28=0; else  $columna28=NULL;
	  if($datosdec[28]==NULL)  //num_arreglos
		 $columna29=0; else  $columna29=1;
	  if($datosdec[29]==NULL)  //esquema_uno
		 $columna30=0;	else  $columna30=1; 	 		 		 	 	 	   
	  if($datosdec[30]==NULL)  //esquema_dos
		 $columna31=0;  else  $columna31=1;
	  if($datosdec[31]==NULL)  //esquema_tres
		 $columna32=0;  else  $columna32=1;
	  if($datosdec[32]==NULL)  //esquema_cuatro
		 $columna33=0;  else  $columna33=1;
	  if($datosdec[33]==NULL)  //tec_uno
		 $columna34=0;  else  $columna34=1;
	  if($datosdec[34]==NULL)  //tec_dos
		 $columna35=0;  else  $columna35=1;
	  if($datosdec[35]==NULL)  //tec_tres
		 $columna36=0;	else  $columna36=1;	
	  if($datosdec[36]==NULL)  //tec_cuatro
		 $columna37=0;  else  $columna37=1;
	  if($datosdec[37]==NULL)  //subtotal_uno
		 $columna38=0;  else  $columna38=1;
	  if($datosdec[38]==NULL)  //subtotal_dos
		 $columna39=0;  else  $columna39=1;
	  if($datosdec[39]==NULL)  //subtotal_tres
		 $columna40=0;	else  $columna40=1; 
	  if($datosdec[40]==NULL)  //subtotal_cuatro
		 $columna41=0;	 else  $columna41=1;	 	 
	  if($datosdec[41]==NULL)  //arreglo_total
		 $columna42=0;  else  $columna42=1;
	  if($datosdec[42]==NULL)  //tec_com
		 $columna43=0;	else  $columna43=1; 
	  if($datosdec[43]==NULL)  //tec_com_tro
		 $columna44=0;	else  $columna44=NULL; 
	  if($datosdec[44]==NULL)  //sist_oper
		 $columna45=0;  else  $columna45=1;
	  if($datosdec[45]==NULL)  //version_sist_oper
	     $columna46=0;  else  $columna46=1;
	  if($datosdec[46]==NULL)  //licencia
	     $columna47=0;  else  $columna47=1;
	  if($datosdec[47]==NULL)  //licencia_ini
	     $columna48=0;  else  $columna48=1;
	  if($datosdec[48]==NULL)  //licencia_fin
	     $columna49=0;  else  $columna49=1;
	  if($datosdec[49]==NULL)  //id_edif
	     $columna50=0;  else  $columna50=1;
	  if($datosdec[50]==NULL)  //id_lab
	     $columna51=0; 	 else  $columna51=1;
		
		      
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
						   
			            $queryerror=sprintf($querybien,$ultimoerror,$datosdec[15],$datosdec[0],date('Y-m-d H:i:s'),$_SESSION['id_div'],'r' );			 
			            $registroerror= pg_query($con,$queryerror);
			            $conterroreg=$conterroreg+1;
                     //exit;
			          } else {

			             $contexitototal=	$contexitototal+1;
 		  
                    } //if(!$result) else
	
		   } //if (pg_num_rows($datostemp)>0) else
       $cuenta=$cuenta+1;
	   } //while para insertar en dispositivo temporal
	   
	   
	   // echo 'Ingresando en dispositivotemp...';
	   $cuentatotal=0;?>
       <tr>
       <td> <?php // echo "Se insertaron ". $cuenta . " registros validos"; ?>  </td></tr>
	 <?php
	    $query="SELECT * FROM dispositivotemp"; 
		
		$datos = pg_query($con,$query);
		while ($disp = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
	          // Busca en dispositivouno
		      $queryinv="SELECT * FROM dispositivo WHERE 
		              inventario="."'".$disp['inventario']."'";
					  
		       $datosinv = pg_query($con,$queryinv);
          
		       //verifica si existe en dispositivo
		       if (pg_num_rows($datosinv)>0) {
			  
		            $updatequery= "UPDATE dispositivo SET inventario='%s'
			                       WHERE inventario="."'".$disp['inventario']."'";
							  
				    //echo 'Actualiza en dispositivouno...';			  
			        $queryu=sprintf($updatequery, $disp['inventario'] ); 
			   
                    $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR dispositivo'); 
              
          
	 
			 
		        } else { 
				
				//$invent->importaInventario($disp['inventario'],$disp['clave_disp'],$_SESSION['id_div'],$_SESSION['id_lab']);
				
				
		      //Traer el último valor en dispositivo
			        $queryd="SELECT max(id_dispositivo) FROM dispositivo";
                    $registrod= pg_query($con,$queryd);
                    $ultimo= pg_fetch_array($registrod);
	
		      if ($ultimo[0]==0)
				    $ultimo=1;//inicializando la tabla dispositivouno
			  else 
			        $ultimo=$ultimo[0]+1;
					
		      //Buscar en bienes 
			 
			 $queryb="SELECT bn_id
							  FROM bienes
			                  WHERE bn_clave="."'".$disp['inventario']."'" . "
							  OR bn_anterior="."'".$disp['inventario']."'";
			 //echo $queryb;
			 				  
			  $registrob= pg_query($con,$queryb);
              $bienes= pg_fetch_array($registrob);
			  
			  if(pg_num_rows($registrob)==0){
				  
			  $queryre="SELECT max(id_error) FROM registroerror";
              $registrore= pg_query($con,$queryre);
              $ultimoerror= pg_fetch_array($registrore);
	
		      if ($ultimoerror[0]==0)
				    $ultimoerror=1;//inicializando la tabla dispositivouno
			  else 
			        $ultimoerror=$ultimoerror[0]+1;	  
             
			   $querybien="INSERT INTO registroerror(id_error,inventario,clave_dispositivo,fecharegistro,id_div,tipoerror)
			               VALUES (%d,'%s',%d,'%s',%d,'%s')";
						   
			   $queryerror=sprintf($querybien,$ultimoerror,$disp['inventario'],$disp['dispositivo_clave'],date('Y-m-d H:i:s'),$_SESSION['id_div'],'b' );			 
			   $registroerror= pg_query($con,$queryerror);
			   
			   if ($registroerror) 
                   $conterrorbn=$conterrorbn+1;
			    else
				   $contexitobn=$contexitobn+1;
              
				
			  }
			  //Buscar en equipoc valores por inventario
			  
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
				  
              if ($bienes[0]!=NULL ){
			  //echo 'clave_dispositivo'.$disp['clave_dispositivo'];
              $strqueryd="INSERT INTO dispositivo (id_dispositivo,bn_id,id_lab,--3
              dispositivo_clave,usuario_final_clave,familia_clave,--6
              tipo_ram_clave,tecnologia_clave,nombre_resguardo,resguardo_no_empleado,--10
              usuario_nombre,usuario_ubicacion,usuario_perfil, --13
              usuario_sector,serie,marca_p, --16
              no_factura,anos_garantia,inventario, --19
              modelo_p,proveedor_p,fecha_factura,--22
              familia_especificar,modelo_procesador,cantidad_procesador,--25
              nucleos_totales,nucleos_gpu, memoria_ram,--28
              ram_especificar, num_elementos_almac,--30
              total_almac,num_arreglos,esquema_uno, --33
              esquema_dos,esquema_tres, esquema_cuatro, --36
              tec_uno,tec_dos,tec_tres,tec_cuatro, --40
              subtotal_uno,subtotal_dos,subtotal_tres,subtotal_cuatro, --44
              arreglo_total,tec_com,tec_com_otro, --47
              sist_oper,version_sist_oper, --49
              licencia,licencia_ini,licencia_fin,fecha, --53
			  velocidad,memcache,tipotarjvideo , --56
              modelotarjvideo,memoriavideo,equipoaltorend, --59
              accesorios,garantiamanten,arquitectura , --62
              estadobien,servidor,descextensa , --65
              id_marca , marca, marca_esp, --68
              id_mem_ram)--idmod

		      VALUES (%d,%d,%d,--id_disp 3
		           %d,%d,%d,--disp_clave 6
				   %d,%d,'%s',%d,--tiporam_clave 10
				   '%s','%s',%d, --usuario_nombre 13
				   %d,'%s','%s', --suario_sector 16
				   '%s','%s','%s', --nofactura 19
				   '%s','%s','%s',--modelo_p 22
				   '%s','%s','%s',	--familia_espec 25
				   '%s','%s','%s', --nucleos_totales 28
				   '%s',%d,   --ram_espec 30
				   %d,%d,%d,  --total_almac 33
				   %d,%d,%d,  --esquema_dos  36
				   %d,%d,%d,%d, --tec_uno  40
				   %d,%d,%d,%d, --subtotal 44
				   %d,%d,'%s',  --arreglo_total 47
				   %d,'%s',      --sist_oper 49
				   %d,'%s','%s','%s', --licencia 53
				   '%s','%s','%s', --velodidad 56 
				   '%s','%s','%s', --modelotarj 59
				   '%s','%s','%s',  --accesorios 62
				   '%s','%s','%s',  --estadobin 65
				   %d,'%s','%s', --idmarca 68
				   %d )";//%d
				   
                 $queryid=sprintf($strqueryd,$ultimo,$bienes[0],$lab, //3
                 $disp['dispositivo_clave'],$disp['usuario_final_clave'],$disp['familia_clave'], //6
				 $disp['tipo_ram_clave'], $disp['tecnologia_clave'],$disp['resguardo_nombre'], $disp['resguardo_no_empleado'] ,//10
                 $disp['usuario_nombre'],$disp['usuario_ubicacion'], $disp['usuario_perfil'], //13
				 $disp['usuario_sector'], $disp['serie'], $disp['marca_p'], //16
				 $disp['no_factura'], $disp['anos_garantia'], $disp['inventario'], //19
                 $disp['modelo_p'], $disp['proveedor_p'],$disp['fecha_factura'], //22 date("Y-m-d", strtotime($disp['fecha_factura']))
			     $disp['familia_especificar'], $disp['modelo_procesador'], $disp['cantidad_procesador'], //25
			     $disp['nucleos_totales'], $disp['nucleos_gpu'], $disp['memoria_ram'], //28
                 $disp['ram_especificar'], $disp['num_elementos_almac'], //30 
			     $disp['total_almac'], $disp['num_arreglos'], $disp['esquema_uno'], //33
			     $disp['esquema_dos'], $disp['esquema_tres'], $disp['esquema_cuatro'], //36
			     $disp['tec_uno'], $disp['tec_dos'], $disp['tec_tres'], $disp['tec_cuatro'], //40
				 $disp['subtotal_uno'], $disp['subtotal_dos'], $disp['subtotal_tres'], $disp['subtotal_cuatro'], //44
                 $disp['arreglo_total'], $disp['tec_com'], $disp['tec_com_otro'], //47
			     $disp['sist_oper'], $disp['version_sist_oper'], //49
			     $disp['licencia'],$disp['licencia_ini'],$disp['licencia_fin'],date('Y-m-d'), //53
				 $equipoc[1],$equipoc[2],$equipoc[3], //56
				 $equipoc[4],$equipoc[5],$equipoc[6], //59
                 $equipoc[7],$equipoc[8],$equipoc[9], //62
				 $equipoc[10],$equipoc[11],$equipoc[12], //65
                 $marca[0],$disp['marca'],'', //68
                 $ram[0]);//,$disp['id_mod']
               
                $result=pg_query($con,$queryid) or die('ERROR AL INSERTAR EN DISPOSITIVO: ' . pg_last_error());
				// echo 'query que inserta';
                // echo $strqueryd;
				 
				    if (!$result) {
                          echo "Ocurrió un error.\n";
                     //exit;
					}else{
 		              $cuentatotal=$cuentatotal+1;
					}
				// actualiaza bit de importación
				
		      $updatequery= "UPDATE dispositivo SET importa=1
			                  WHERE inventario="."'".$disp['inventario']."'";
							  
				//echo 'Actualiza en dispositivouno...';			  
			  $queryu=sprintf($updatequery, $disp['inventario'] ); 
			   
              $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR dispositivo'); 
              
				//Llenar tabla respaldoDispositivo
				
			  $queryd="SELECT max(id_dispositivo) FROM dispositivorespaldo";
              $registrod= pg_query($con,$queryd);
              $ultimoreg= pg_fetch_array($registrod);
	
		      if ($ultimoreg[0]==0)
				    $ultimoreg=1;//inicializando la tabla dispositivouno
			  else 
			        $ultimoreg=$ultimoreg[0]+1;
				
			   $strqueryd="INSERT INTO dispositivorespaldo (id_dispositivo,bn_id,id_lab,--3
              dispositivo_clave,usuario_final_clave,familia_clave,--6
              tipo_ram_clave,tecnologia_clave,nombre_resguardo,resguardo_no_empleado,--10
              usuario_nombre,usuario_ubicacion,usuario_perfil, --13
              usuario_sector,serie,marca_p, --16
              no_factura,anos_garantia,inventario, --19
              modelo_p,proveedor_p,fecha_factura,--22
              familia_especificar,modelo_procesador,cantidad_procesador,--25
              nucleos_totales,nucleos_gpu, memoria_ram,--28
              ram_especificar, num_elementos_almac,--30
              total_almac,num_arreglos,esquema_uno, --33
              esquema_dos,esquema_tres, esquema_cuatro, --36
              tec_uno,tec_dos,tec_tres,tec_cuatro, --40
              subtotal_uno,subtotal_dos,subtotal_tres,subtotal_cuatro, --44
              arreglo_total,tec_com,tec_com_otro, --47
              sist_oper,version_sist_oper, --49
              licencia,licencia_ini,licencia_fin,fecha, --53
			  velocidad,memcache,tipotarjvideo , --56
              modelotarjvideo,memoriavideo,equipoaltorend, --59
              accesorios,garantiamanten,arquitectura , --62
              estadobien,servidor,descextensa , --65
              id_marca , marca, marca_esp, --68
              id_mem_ram)--idmod

		      VALUES (%d,%d,%d,--id_disp 3
		           %d,%d,%d,--disp_clave 6
				   %d,%d,'%s',%d,--tiporam_clave 10
				   '%s','%s',%d, --usuario_nombre 13
				   %d,'%s','%s', --suario_sector 16
				   '%s','%s','%s', --nofactura 19
				   '%s','%s','%s',--modelo_p 22
				   '%s','%s','%s',	--familia_espec 25
				   '%s','%s','%s', --nucleos_totales 28
				   '%s',%d,   --ram_espec 30
				   %d,%d,%d,  --total_almac 33
				   %d,%d,%d,  --esquema_dos  36
				   %d,%d,%d,%d, --tec_uno  40
				   %d,%d,%d,%d, --subtotal 44
				   %d,%d,'%s',  --arreglo_total 47
				   %d,'%s',      --sist_oper 49
				   %d,'%s','%s','%s', --licencia 53
				   '%s','%s','%s', --velodidad 56 
				   '%s','%s','%s', --modelotarj 59
				   '%s','%s','%s',  --accesorios 62
				   '%s','%s','%s',  --estadobin 65
				   %d,'%s','%s', --idmarca 68
				   %d)"
				   ;//%d
				   
                 $queryid=sprintf($strqueryd,$ultimoreg,$bienes[0],$lab, //3
                 $disp['dispositivo_clave'],$disp['usuario_final_clave'],$disp['familia_clave'], //6
				 $disp['tipo_ram_clave'], $disp['tecnologia_clave'],$disp['resguardo_nombre'], $disp['resguardo_no_empleado'] ,//10
                 $disp['usuario_nombre'],$disp['usuario_ubicacion'], $disp['usuario_perfil'], //13
				 $disp['usuario_sector'], $disp['serie'], $disp['marca_p'], //16
				 $disp['no_factura'], $disp['anos_garantia'], $disp['inventario'], //19
                 $disp['modelo_p'], $disp['proveedor_p'],$disp['fecha_factura'], //22
			     $disp['familia_especificar'], $disp['modelo_procesador'], $disp['cantidad_procesador'], //25
			     $disp['nucleos_totales'], $disp['nucleos_gpu'], $disp['memoria_ram'], //28
                 $disp['ram_especificar'], $disp['num_elementos_almac'], //30 
			     $disp['total_almac'], $disp['num_arreglos'], $disp['esquema_uno'], //33
			     $disp['esquema_dos'], $disp['esquema_tres'], $disp['esquema_cuatro'], //36
			     $disp['tec_uno'], $disp['tec_dos'], $disp['tec_tres'], $disp['tec_cuatro'], //40
				 $disp['subtotal_uno'], $disp['subtotal_dos'], $disp['subtotal_tres'], $disp['subtotal_cuatro'], //44
                 $disp['arreglo_total'], $disp['tec_com'], $disp['tec_com_otro'], //47
			     $disp['sist_oper'], $disp['version_sist_oper'], //49
			     $disp['licencia'], $disp['licencia_ini'],
				 $disp['licencia_fin'],date('Y-m-d'), //53
				 $equipoc[1],$equipoc[2],$equipoc[3], //56
				 $equipoc[4],$equipoc[5],$equipoc[6], //59
                 $equipoc[7],$equipoc[8],$equipoc[9], //62
				 $equipoc[10],$equipoc[11],$equipoc[12], //65
                 $marca[0],$disp['marca'],'', //68
                 $ram[0]);//,$disp['id_mod']
               
                 $result=pg_query($con,$queryid) or die('ERROR AL INSERTAR EN dispositivorespaldo: ' . pg_last_error());	
				
			     $updatequery= "UPDATE dispositivorespaldo SET importa=1
			                    WHERE inventario="."'".$disp['inventario']."'";
							  
				 //echo 'Actualiza en dispositivouno...';			  
			     $queryu=sprintf($updatequery, $disp['inventario'] ); 
			   
                 $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR dispositivorespaldo'); 
				
				//echo "El dispositivo con número de inventario ".$disp['inventario']." fue insertado en la base de datos  ";
				
			  }//valores que estan en bienes
		  
		  } // fin de la validación si existe
		
		}//fin de while para insertar datos en dispositivo 
		
		
		 $querydt="DELETE FROM dispositivotemp";	
			
	     $datosdt = pg_query($con,$querydt);
		
		// $error->importaError();
		$queryerror="SELECT * FROM errorinserta WHERE 
	                columna1=0 OR columna2=0 OR columna3=0 OR columna4=0 OR columna5=0 
					OR columna6=0 OR columna7=0 OR columna8=0 OR columna9=0 OR columna10=0
					OR columna11=0  OR columna13=0 OR columna14=0 OR columna15=0
					OR columna16=0 OR columna17=0 OR columna18=0 OR columna19=0 
					OR columna21=0 OR columna22=0 OR columna23=0 OR columna24=0 OR columna25=0
				    OR columna27=0 OR columna29=0 OR columna30=0
					OR columna31=0 OR columna32=0 OR columna33=0 OR columna34=0 OR columna35=0
					OR columna36=0 OR columna37=0 OR columna38=0 OR columna39=0 OR columna40=0
					OR columna41=0 OR columna42=0 OR columna43=0 OR columna45=0
					OR columna46=0 OR columna47=0 OR columna48=0 OR columna49=0 OR columna50=0 ";
			//echo $queryerror;			
					
        $result=pg_query($con, $queryerror);
		
		
		while ($disperror = pg_fetch_array($result, NULL,PGSQL_ASSOC)) 
		{ 
		
		    if ($disperror['columna1']==0) {?>
		       <tr><td> <?php echo 'La columna A,  <strong> clave_dispositivo </strong> del renglón  '.$disperror['tupla'] .' es obligatoria'; ?></td></tr>
     <?php }if ($disperror['columna2']==0) {?>
		       <tr><td> <?php  echo 'La columna B, <strong> usuario_final_clave </strong> del renglón  '.$disperror['tupla'] .' es obligatoria';?></td></tr>	
	 <?php  }if ($disperror['columna3']==0) { ?>
		       <tr><td> <?php echo 'La columna C, <strong> familia_clave </strong> del renglón '.$disperror['tupla'].' es obligatoria';	?></td></tr>		
	 <?php }if ($disperror['columna4']==0)  {?>
		       <tr><td> <?php echo 'La columna D, <strong>tipo_ram_clave </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>		
	 <?php } if ($disperror['columna5']==0) { ?>
		      <tr><td> <?php echo 'La columna E, <strong> tecnologia_clave </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>				
	 <?php }   if ($disperror['columna6']==0) {?>
		      <tr><td> <?php echo 'La columna F, <strong> resguardo_nombre </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>				
	 <?php } if ($disperror['columna7']==0) { ?>
		      <tr><td> <?php echo 'La columna G, <strong> resguardo_no_empleado </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>		     <?php }  if ($disperror['columna8']==0) {?>
		      <tr><td> <?php echo 'La columna H, <strong> usuario_nombre </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>	
     <?php }  if ($disperror['columna9']==0) {?>
		      <tr><td> <?php echo 'La columna I, <strong> usuario_ubicación </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>	      <?php }  if ($disperror['columna10']==0) {?>
		      <tr><td> <?php echo 'La columna J, <strong> usuario_perfil </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>	      <?php }  if ($disperror['columna11']==0) { ?>
		      <tr><td> <?php echo 'La columna K, <strong> usuario_sector </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>	      <?php }  if ($disperror['columna13']==0) {?>
		      <tr><td> <?php echo 'La columna M, <strong> marca_p </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>	  	    	      <?php } if ($disperror['columna14']==0) { ?>
		      <tr><td> <?php echo 'La columna N, <strong> no_factura </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>	
      <?php }  if ($disperror['columna15']==0) { ?>
		      <tr><td> <?php echo 'La columna O, <strong> años garantía </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr> 
      <?php } if ($disperror['columna16']==0) { ?>
		      <tr><td> <?php echo 'La columna P, <strong> inventario </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>      
	  <?php } if ($disperror['columna17']==0) { ?>
		      <tr><td> <?php echo 'La columna Q, <strong> modelo_p </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr> 
      <?php } if ($disperror['columna18']==0) { ?>
		      <tr><td> <?php echo 'La columna R, <strong> proveedor_p </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>      
	  <?php } if ($disperror['columna19']==0) { ?>
		      <tr><td> <?php echo 'La columna S, <strong> fecha_factura </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr> 
      <?php }  if ($disperror['columna21']==0) { ?>
		      <tr><td> <?php echo 'La columna U, <strong> modelo_procesador </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>      <?php }  if ($disperror['columna22']==0) { ?>
		      <tr><td> <?php echo 'La columna V, <strong> cantidad_procesador </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>      <?php } if ($disperror['columna23']==0) { ?>
		      <tr><td> <?php echo 'La columna W, <strong> nucleos_totales </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr> 
      <?php } if ($disperror['columna24']==0) { ?>
		      <tr><td> <?php echo 'La columna X, <strong> nucleos_GPU </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>      
	  <?php } if ($disperror['columna25']==0) { ?>
		      <tr><td> <?php echo 'La columna Y, <strong> memoria_RAM </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>
      <?php  } if ($disperror['columna27']==0){ ?>
		      <tr><td> <?php echo 'La columna AA, <strong> num_elementos_almac </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>      <?php }  if ($disperror['columna29']==0) { ?>
		      <tr><td> <?php echo 'La columna AC, <strong> num_arreglos del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>            <?php } if ($disperror['columna30']==0) { ?>
		      <tr><td> <?php echo 'La columna AD, <strong> esquema_uno </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>   
      <?php }  if ($disperror['columna31']==0) { ?>
		      <tr><td> <?php echo 'La columna AE, <strong> esquema_dos </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>            <?php } if ($disperror['columna32']==0) { ?>
		      <tr><td> <?php echo 'La columna AF, <strong> esquema_tres </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>
      <?php } if ($disperror['columna33']==0) { ?>
		      <tr><td> <?php echo 'La columna AG, <strong> esquema_cuatro </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>            <?php }  if ($disperror['columna34']==0) { ?>
		      <tr><td> <?php echo 'La columna AH, <strong> tec_uno </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>
      <?php  } if ($disperror['columna35']==0) { ?>
		      <tr><td> <?php echo 'La columna AI, <strong> tec_dos </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>  
      <?php } if ($disperror['columna36']==0) { ?>
		      <tr><td> <?php echo 'La columna AJ, <strong> tec_tres </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>   
      <?php }  if ($disperror['columna37']==0) { ?>
		      <tr><td> <?php echo 'La columna AK, <strong> tec_cuatro </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>              <?php  } if ($disperror['columna38']==0) { ?>
		      <tr><td> <?php echo 'La columna AL, <strong> subtotal_uno </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>             <?php }  if ($disperror['columna39']==0) { ?>
		      <tr><td> <?php echo 'La columna AM, <strong> subtotal_dos </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>  
      <?php  }if ($disperror['columna40']==0) {?>
		      <tr><td> <?php echo 'La columna AN, <strong> subtotal_tres </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>             <?php   } if ($disperror['columna41']==0) { ?>
		      <tr><td> <?php echo 'La columna AO, <strong> subtotal_cuatro </strong>del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>
      <?php } if ($disperror['columna42']==0) { ?>
		      <tr><td> <?php echo 'La columna AP, <strong> arreglo_total </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>             <?php  } if ($disperror['columna43']==0) {?>
		      <tr><td> <?php echo 'La columna AQ, <strong> tec_com </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>  
      <?php }  if ($disperror['columna45']==0) { ?>
		      <tr><td> <?php echo 'La columna AS, <strong> sist_oper </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>      
	  <?php } if ($disperror['columna46']==0) {?>
		      <tr><td> <?php echo 'La columna AT, <strong> version_sist_oper </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>
      <?php } if ($disperror['columna47']==0)  {?>
		      <tr><td> <?php echo 'La columna AU, <strong> licencia </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>      
	  <?php } if ($disperror['columna48']==0) {?>
		      <tr><td> <?php echo 'La columna AV, <strong> licencia_ini </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>            <?php } if ($disperror['columna49']==0) { ?>
		      <tr><td> <?php echo 'La columna AW, <strong> licencia_fin </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>      <?php } if ($disperror['columna50']==0) {?>
		      <tr><td> <?php echo 'La columna AX, <strong> id_edificio </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>      <?php } if ($disperror['columna51']==0){ ?>
		      <tr><td> <?php echo 'La columna AY, <strong> id_lab </strong> del renglón '.$disperror['tupla'].' es obligatoria'; ?></td></tr>            <?php 
			  
			  } 
		 }//fin de while $disperro

         $querydt="DELETE FROM errorinserta";	
			
	     $datosdt = pg_query($con,$querydt);
		
		// echo 'Ingresando en dispositivo....';
		
		$total=$conterroreg+$contexitototal; 
		 if ( $conterrorbn ==0 && $conterroreg == 0){?>
		 <tr>	 
		 <td> <h4><?php echo "Importación con éxito" ?></h4> </td></tr>
         
         
		 <?php
		
		 }
		
		?>
		
         <tr>
             <td> <h4><?php echo "Se importaron " . $cuentatotal . " / " . $total . " dispositivos."; ?></h4> </td></tr>
               <?php  if ( $conterrorbn > 0) { ?>
             <td> <h4><?php echo "Faltó registrar  " . $conterrorbn ." dispositivos que no se encuentran en el inventario de la facultad." ?></h4> </td></tr>
         <tr><td>    
              <form action="../inc/erroresbn.inc.php" method="post" name="erroresbn" >
	          <input name="enviar" type="submit" value="Exportar a Excel" />
	          </form>
         </td></tr>
        <?php
		 }
		 
		 if ($conterroreg > 0) { ?>
                 <td> <h4><?php echo "Hay " . $conterroreg ." dispositivos que no cumplen con los requisitos. " ?></h4> </td></tr>
              <tr><td>
                <form action="../inc/erroresreg.inc.php" method="post" name="erroresreg" >
	               <input name="enviar" type="submit" value="Exportar a Excel" />
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


