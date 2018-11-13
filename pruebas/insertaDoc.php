

<html>
<head>
<title>Importación de un archivo CSV de excel hacia 
PostgreSQL</title>
</head>
<table>
<form action="" method="POST" enctype="multipart/form-data">
 <tr>
   <td>Subir archivo CSV:</td>
   <td><input type="file" name="archivo_csv" id='archivo'></td>
 </tr>
 <tr>
   <td colspan="2" align="center">
     <input type="submit" value="E N V I A R">
     <input type="reset" value="C A N C E L A R">
   </td>
 </tr>
</form>
</table>
</body>
</html>

<?php
require_once('../conexion.php');
//https://desarrolla2.com/post/manejo-de-excepciones-en-php		 
function foo() {
    try {
        throw new Exception(' Upps !!');
    } catch (ErrorException $e) {
        // este bloque no se ejecuta, no coincide el tipo de excepción
        echo 'ErrorException' . $e->getMessage();
    } catch (Exception $e) {
        // este bloque captura la excepción
        echo 'Exception' . $e->getMessage();
        echo 'Numero'. $e->getError();
    }
}
  $file_upload = $_FILES["archivo_csv"]["name"];
  $tmp_name = $_FILES["archivo_csv"]["tmp_name"];
  $size = $_FILES["archivo_csv"]["size"];
  $tipo = $_FILES["archivo_csv"]["type"];

 if($size > 0){
   echo "<h3>Archivo origen: $file_upload</h3>";
   echo "<h3>Archivo destino: $tmp_name</h3>";
   echo "<h3>Tamaño del archivo: ".($size/1024)." Kb.</h3>";
   echo "<h3>Tipo MIME: $tipo</h3>";
  
    //Comprobamos si el archivo a subir es CSV
   // if($tipo == 'text/csv'){
	 //$datos = pg_connect($con,$query);  
  
     echo "Insertando los datos recuperados del archivo \
           en la base de datos...<br>";
 
     $fp = fopen($tmp_name, "r");
   
     // Procesamos linea a linea el archivo CSV y 
     // lo insertamos en la base de datos
	 $cuenta=1;
     while($datos = fgetcsv ($fp, 1000, ";")){
		 
	  $querytemp="SELECT * FROM dispositivotemp WHERE 
		              inventario="."'".$datos[16]."'";
					  
		   $datostemp = pg_query($con,$querytemp);
          
		
		  if (pg_num_rows($datostemp)>0) {
		    $updatequery= "UPDATE dispositivotemp SET inventario='%s'
			                  WHERE inventario="."'".$datos[16]."'";
							  
			  $queryu=sprintf($updatequery, $datos[16] ); 
			   
              $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR dispositivo uno');
		   
			 echo "El dispositivo con número de inventario ".$datos[16] ." ya esta registrado en tabla dispositivotemp  ";
		  } else { 
	 
	 
       $query = "INSERT INTO dispositivotemp (
                                           dispositivo_clave,usuario_final_clave,familia_clave,
                                           tipo_ram_clave,tecnologia_clave,resguardo_nombre,
										   resguardo_no_empleado, usuario_nombre,id_lab,
										   usuario_ubicacion,usuario_perfil, usuario_sector,
										   serie, marca_p, no_factura,
										   anos_garantia,inventario, modelo_p,
										   proveedor,fecha_factura,familia_especificar,
										   modelo_procesador,cantidad_procesador,nucleos_totales,
										   nucleos_gpu, memoria_ram,ram_especificar, 
										   num_elementos_almac,total_almac,num_arreglos,
										   esquema_uno,esquema_dos,esquema_tres, esquema_cuatro,
                                           tec_uno,tec_dos,tec_tres,tec_cuatro,
                                           subtotal_uno,subtotal_dos,subtotal_tres,subtotal_cuatro,
                                           arreglo_total,tec_com,tec_com_otro,
                                           sist_oper,version_sist_oper,licencia,
										   licencia_ini,licencia_fin,id_edificio) VALUES 
										   ( $datos[0], $datos[1], $datos[2], 
                                             $datos[3], $datos[4], '$datos[5]',
											 $datos[6], '$datos[7]',$datos[8],
											'$datos[9]', $datos[10],$datos[11], 
											'$datos[12]', '$datos[13]','$datos[14]',
											'$datos[15]', '$datos[16]','$datos[17]', 
											'$datos[18]', '$datos[19]','$datos[20]', 
											'$datos[21]', '$datos[22]','$datos[23]',  
											'$datos[24]', '$datos[25]','$datos[26]',
											$datos[27],$datos[28],$datos[29], 
											$datos[30],$datos[31],$datos[32],$datos[33], 
											$datos[34],$datos[35],$datos[36],$datos[37],
											$datos[38],$datos[39],$datos[40],$datos[41],
											$datos[42],$datos[43],'$datos[44]',
											$datos[45],'$datos[46]',$datos[47],
											'$datos[48]','$datos[49]',$datos[50] )"; 
                 
 
          pg_query($con, $query);


foo();
		  $cuenta=$cuenta+1;
        }
		 
	   } //while para insertar en dispositivo temporal
	   $cuentatotal=0;
	  echo "Se insertaron ". $cuenta . "registros validos";
	    $query="SELECT * FROM dispositivotemp"; 
		
		$datos = pg_query($con,$query);
		while ($disp = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
	       // Busca en dispositivouno
		   $queryinv="SELECT * FROM dispositivouno WHERE 
		              inventario="."'".$disp['inventario']."'";
					  
		   $datosinv = pg_query($con,$queryinv);
          
		
		  if (pg_num_rows($datosinv)>0) {
		    $updatequery= "UPDATE dispositivouno SET inventario='%s'
			                  WHERE inventario="."'".$disp['inventario']."'";
							  
			  $queryu=sprintf($updatequery, $disp['inventario'] ); 
			   
              $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR dispositivo uno');
		   
			 echo "El dispositivo con número de inventario ".$disp['inventario']." ya esta registrado en la tabla dispositivouno  ";
		  } else { 
		   //Traer el último valor en dispositivo
			  $queryd="SELECT max(id_dispositivo) FROM dispositivouno";
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
							  
			  $registrob= pg_query($con,$queryb);
              $bienes= pg_fetch_array($registrob);
			  
			  if(pg_num_rows($registrob)==0){
				  //echo 'entra bnid NULO';
			  $queryre="SELECT max(id_error) FROM registroerror";
              $registrore= pg_query($con,$queryre);
              $ultimoerror= pg_fetch_array($registrore);
	
		      if ($ultimoerror[0]==0)
				    $ultimoerror=1;//inicializando la tabla dispositivouno
			  else 
			        $ultimoerror=$ultimoerror[0]+1;	  
             
			   $querybien="INSERT INTO registroerror(id_error,inventario,descripcion,fecharegistro)
			                 VALUES (%d,'%s','%s','%s')";
			   $queryerror=sprintf($querybien,$ultimoerror,$disp['inventario'],$disp['dispositivo_clave'],date('Y-m-d H:i:s'));			 
			   $registroerror= pg_query($con,$queryerror);
               //$result=pg_query($con,$registroerror) or die('ERROR AL insertar en registroerror');
			 
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
				 
			  
			  //buscar nformacion de los catalogos de marca y memoria ram
			  $querym="SELECT id_marca 
							  FROM cat_marca
			                  WHERE descmarca="."'".$disp['marca_p']."'";
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
              
              if ($bienes[0]!=NULL ){
			  echo 'clave_dispositivo'.$disp['clave_dispositivo'];
              $strqueryd="INSERT INTO dispositivouno (id_dispositivo,bn_id,id_lab,--3
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
              id_mem_ram )

		      VALUES (%d,%d,%d,--id_disp 3
		           %d,%d,%d,--disp_clave 6
				   %d,%d,'%s',%d,--tiporam_clave 10
				   '%s','%s',%d, --usuario_nombre 13
				   %d,'%s','%s', --suario_sector 16
				   '%s','%s','%s', --nofactura 19
				   '%s','%s', '%s',--modelo_p 22
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
				   %d )";
				   
                 $queryid=sprintf($strqueryd,$ultimo,$bienes[0],$lab, //3
                 $disp['dispositivo_clave'],$disp['usuario_final_clave'],$disp['familia_clave'], //6
				 $disp['tipo_ram_clave'], $disp['tecnologia_clave'],$disp['nombre_resguardo'], $disp['resguardo_no_empleado'] ,//10
                 $disp['usuario_nombre'],$disp['usuario_ubicacion'], $disp['usuarioperfil'], //13
				 $disp['usuario_sector'], $disp['serie'], $disp['marca_p'], //16
				 $disp['no_factura'], $disp['anos_garantia'], $disp['inventario'], //19
                 $disp['modelo_p'], $disp['proveedor_p'],date("d-m-Y", strtotime($disp['fecha_factura'])), //22
			     $disp['familia_especificar'], $disp['modelo_procesador'], $disp['cantidad_procesador'], //25
			     $disp['nucleos_totales'], $disp['nucleos_gpu'], $disp['memoria_ram'], //28
                 $disp['ram_especificar'], $disp['num_elementos_almac'], //30 
			     $disp['total_almac'], $disp['num_arreglos'], $disp['esquema_uno'], //33
			     $disp['esquema_dos'], $disp['esquema_tres'], $disp['esquema_cuatro'], //36
			     $disp['tec_uno'], $disp['tec_dos'], $disp['tec_tres'], $disp['tec_cuatro'], //40
				 $disp['subtotal_uno'], $disp['subtotal_dos'], $disp['subtotal_tres'], $disp['subtotal_cuatro'], //44
                 $disp['arreglo_total'], $disp['tec_com'], $disp['tec_com_otro'], //47
			     $disp['sist_oper'], $disp['version_sist_oper'], //49
			     $disp['licencia'], date("d-m-Y", strtotime($disp['licencia_ini'])),date("d-m-Y",
				 strtotime($disp['licencia_fin'])),date('Y-m-d'), //53
				 $equipoc[1],$equipoc[2],$equipoc[3], //56
				 $equipoc[4],$equipoc[5],$equipoc[6], //59
                 $equipoc[7],$equipoc[8],$equipoc[9], //62
				 $equipoc[10],$equipoc[11],$equipoc[12], //65
                 $marca[0],$disp['marca'],'', //68
                 $ram[0]);

                $result=pg_query($con,$queryid) or die('ERROR AL INSERTAR EN DISPOSITIVO: ' . pg_last_error());
				
				//echo "El dispositivo con número de inventario ".$disp['inventario']." fue insertado en la base de datos  ";
				$cuentatotal=$cuentatotal+1;
			  }//valores que estan en bienes
		   
		  } // fin de la validacion
			 
		}//fin de while para insertar datos en dispositivo 
		echo "Se insertaron ".$cuentatotal." registros, de un total de " .$cuenta;
    // pg_close($con);
  /* }else{
     echo "<h3>El formato para el archivo especificado \
                     no es válido.</h3>";
   }*/
 }
?>
