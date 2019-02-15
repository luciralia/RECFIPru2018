<?php 
//require_once('../inc/sesion.inc.php');
require_once('../conexion.php');
require_once('../clases/importa.class.php');

session_start(); 

$error = new importa();
$registroerror = new importa();
$buscaerror = new importa();
$disperror =new importa();

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
			        $contreing=$contreing+1; // para la actualización
			   //echo 'Actualiza en dispositivotemp...';
			 
			
		   } else { 
	   //$conterroreg=0;
	   
	   // generar una tabla con nombre de las columnas 
	  /* 								                                            
       $query = "INSERT INTO dispositivotempo ( dispositivo_clave,usuario_final_clave,familia_clave,
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
										      ( $datosdec[0], $datosdec[1], $datosdec[2], 
                                               $datosdec[3], $datosdec[4], '$datosdec[5]',
											   $datosdec[6], '$datosdec[7]', '$datosdec[8]', 
											   $datosdec[9], $datosdec[10], '$datosdec[11]', 
											  '$datosdec[12]', '$datosdec[13]', '$datosdec[14]', 
											  '$datosdec[15]', '$datosdec[16]', '$datosdec[17]', 
											  '$datosdec[18]', '$datosdec[19]',                
											  '$datosdec[20]','$datosdec[21]','$datosdec[22]', 
											  '$datosdec[23]','$datosdec[24]','$datosdec[25]', 
											   $datosdec[26], $datosdec[27], $datosdec[28],   
											   $datosdec[29], $datosdec[30], $datosdec[31], $datosdec[32], 
											   $datosdec[33], $datosdec[34],$datosdec[35],$datosdec[36], 
											   $datosdec[37], $datosdec[38],$datosdec[39],$datosdec[40],
											   $datosdec[41], $datosdec[42],'$datosdec[43]',
											   $datosdec[44], '$datosdec[45]',$datosdec[46],
											   '$datosdec[47]', '$datosdec[48]',$datosdec[49],
											   $datosdec[50])"; //$datos[51] previendo modificaccion para idmod
                 
*/
 
 $query = "INSERT INTO dispositivotemp ( dispositivo_clave,usuario_final_clave,familia_clave,
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
										      ('$datosdec[0]', '$datosdec[1]', '$datosdec[2]', 
                                               '$datosdec[3]', '$datosdec[4]', '$datosdec[5]',
											   '$datosdec[6]', '$datosdec[7]', '$datosdec[8]', 
											   '$datosdec[9]', '$datosdec[10]', '$datosdec[11]', 
											   '$datosdec[12]', '$datosdec[13]', '$datosdec[14]', 
											   '$datosdec[15]', '$datosdec[16]', '$datosdec[17]', 
											   '$datosdec[18]', '$datosdec[19]',                
											   '$datosdec[20]','$datosdec[21]','$datosdec[22]', 
											   '$datosdec[23]','$datosdec[24]','$datosdec[25]', 
											   '$datosdec[26]','$datosdec[27]', '$datosdec[28]',   
											   '$datosdec[29]','$datosdec[30]', '$datosdec[31]','$datosdec[32]', 
											   '$datosdec[33]', '$datosdec[34]','$datosdec[35]','$datosdec[36]', 
											   '$datosdec[37]', '$datosdec[38]','$datosdec[39]','$datosdec[40]',
											   '$datosdec[41]', '$datosdec[42]','$datosdec[43]',
											   '$datosdec[44]', '$datosdec[45]','$datosdec[46]',
											   '$datosdec[47]', '$datosdec[48]','$datosdec[49]',
											   '$datosdec[50]')"; //$datos[51] previendo modificaccion para idmod
										   
                          $result=@pg_query($con, $query);
						  
						 // echo 'inserta en dispostivotemp';
				          
						 // echo $query;
		
                         if (!$result) {
		        	         $queryre="SELECT max(id_error) FROM registroerror";
                             $registrore= pg_query($con,$queryre);
                             $ultimoerror= pg_fetch_array($registrore);
	
		                          if ($ultimoerror[0]==0)
				                    $ultimoerror=1;//inicializando la tabla dispositivouno
			                      else 
			                        $ultimoerror=$ultimoerror[0]+1;	  
             
			                         $querybien="INSERT INTO
									 registroerror(id_error,inventario,clave_dispositivo,fecharegistro,id_div,tipoerror)
			                         VALUES (%d,'%s',%d,'%s',%d,'%s')";
						   
			                         $queryerror=sprintf($querybien,$ultimoerror,$datosdec[15],$datosdec[0],date('Y-m-d H:i:s'),$_SESSION['id_div'],'t' );			 
			                         $registroerror= pg_query($con,$queryerror);
			                         $conterroreg++; //inserciones con errores por error de registro
									
                         //exit;
			              } else {

			             $contexitototal++; // inserciones restantes
 		  
                    } //if(!$result) else
	
		   } //if (pg_num_rows($datostemp)>0) else
       
	   } //while para insertar en dispositivo temporal
	   
	
	   $buscaerror->detectaError();
	  
	   $cuentatotal=0;?>
       <tr>
       <td> <?php // echo "Se insertaron ". $cuenta . " registros validos"; ?>  </td></tr>
	 <?php
	   
	    $query="SELECT * FROM dispositivotemp dt
		        JOIN errorinserta ei
				on dt.inventario=ei.inventario
				WHERE columna51!=4 AND columna51!=6
				AND columna1=1 AND columna2=1 AND columna3=1 AND columna4=1 AND columna5=1
				AND  columna10=1 AND columna11=1 
				AND columna30=1 AND columna31=1 AND columna32=1
				AND columna33=1 AND columna34=1 AND columna35=1
				AND columna36=1 AND columna37=1 AND columna45=1";
				
		
		// valida obligatoriedad
		
		/*$query="SELECT * FROM dispositivotempo dt
                JOIN errorinserta ei
                ON dt.inventario=ei.inventario
                WHERE columna51!=4 AND columna51!=6
                AND columna1=1 AND columna2=1 
				AND columna3=1 AND columna4=1 
				AND columna5=1
                AND columna6=2 AND columna7=2 
                AND columna8=2 AND columna9=2
                AND columna10=1 AND columna11=1 
                AND columna13=2 AND (columna14=2 OR columna14=1) 
                AND columna18=2 AND columna19=2 
                AND columna21=2 AND columna22=1 AND columna23=1
                AND columna24=1 AND columna25=1
                AND columna27=1 AND columna29=1
                AND columna30=1 AND columna31=1 AND columna32=1
                AND columna33=1 AND columna34=1 AND columna35=1
                AND columna36=1 AND columna37=1 
                AND columna38=1 AND columna39=1 AND columna40=1
                AND columna41=1 AND columna42=1 AND columna43=1
                AND columna45=1 AND columna46=2 AND columna47=1
                AND columna50=1 AND columna51=1"; 
*/
		$datos = pg_query($con,$query);
		
		/*
		$querye="SELECT * FROM dispositivotempo dt
		             JOIN errorinserta ei
				     ON dt.inventario=ei.inventario
				     WHERE columna51=4 OR columna51=6";
		
		$existee= pg_query($querye) or die('Hubo un error con la base de datos');		
			
	    $cuantose=pg_num_rows($existee);
		*/
		
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
			   
			   $conterrorbn=$conterrorbn+1;
			 
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
			     $lab=$equipoc[0];
			  else 	 
			     $lab=$disp['id_lab'];
				
			  //buscar información de los catálogos de marca y memoria ram
			  
			  $querym="SELECT id_marca 
							  FROM cat_marca
			                  WHERE descmarca="."'".strtoupper($disp['marca_p']."'");
		
							  
              $registrom= pg_query($con,$querym);
              $marca= pg_fetch_array($registrom);
			  //Revisar al ingresar memoria RAM
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
                 $disp['modelo_p'], $disp['proveedor'],$disp['fecha_factura'], //22 date("Y-m-d", strtotime($disp['fecha_factura']))
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
				 //echo 'query que inserta';
             // echo $strqueryd;
				 
				    if (!$result) 
					    echo "Ocurrió un error.\n";
                    else
 		                $cuentatotal=$cuentatotal+1;
				
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
                 $disp['modelo_p'], $disp['proveedor'],$disp['fecha_factura'], //22
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
		
		
		$error->importaError();
		
	
		//$querydt="DELETE FROM dispositivotempo";	
			
	    // $datosdt = pg_query($con,$querydt); 
		
		//Almacena los  dispositivos con error
		
		
		 $querylab="SELECT * FROM errorinserta
		           WHERE columna51=4 OR columna51=6";
				   
		 $result = pg_query($querylab) or die('Hubo un error con la base de datos en error inserta');
		
         $sinlab= pg_num_rows($result); 
		 
		 $total=$conterroreg+$contexitototal; 
		 
		//$querydt="DELETE FROM errorinserta";	
		//$result = pg_query($querydt) or die('Hubo un error con la base de datos');
		?>
         <tr>
             <td><legend align="center"> <h4><?php echo "Se importaron " . $cuentatotal . " / " . $total . " dispositivos."; ?></h4> </legend></td></tr>
               <?php  if ( $conterrorbn > 0) { ?>
            <br/> <td><legend align="center"> <h4><?php echo "Faltó registrar  " . $conterrorbn ." dispositivos que no se encuentran en el inventario de la facultad." ?></h4> </legend></td></tr>
         <tr><td> <br>  
              <form action="../inc/erroresbn.inc.php" method="post" name="erroresbn" >
	          <input name="enviar" type="submit" value="Exportar a Excel" />
	          </form>
         </td></tr>
        <?php
		 }
		 
		 $disperror->guardaDispError();
	
	   if ($sinlab>0){
		?>
		<br>
        <tr>
            <td><legend align="center"> <h4><?php echo "Dispositivos  sin lab " . $sinlab ; ?></h4> </legend>
            </td>
        </tr>
        <br/>
       <?php } 
 }
?>
</td>          
</tr>
</table>
</div>

<br/>



