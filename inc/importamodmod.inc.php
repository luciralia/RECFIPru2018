<?php 
require_once('../inc/sesion.inc.php');
require_once('../conexion.php');
require_once('../clases/importa.class.php');
require_once('../clases/inventario.class.php');


session_start(); 

$marca=new importa();

$botonReg=new importa();
$botonBien=new importa();
$valida=new importa();
$error=new importa();
$verifica = new inventario();

$querydt="DELETE FROM errorinserta";	
$result = pg_query($querydt) or die('Hubo un error con la base de datos');

$querypre="DELETE FROM registroerror 
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
//echo $file_upload;
 
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
	     
	      //muestra errores y verifica valor en catálogo
	    
		 
		try {
				$marca->marcaError($datosdec,$noo);
				
  
        } catch (Exception $e) {
        /* Podemos finalizar la ejecución con un mensaje o mostrar HTML con él */
           die('Error modificando producto: ' .  $e->getMessage());
       }
		  
	
		  
		
	

		  
		  $busca=buscaBienes($datosdec);
		  
		 // }
	   
				
		//valida identificadores de catálogos';	
		/*$queryerror="SELECT * FROM errorinserta 
	                 WHERE tupla=" . $cuenta .
				   " AND  (
				   columna1=3 AND columna2=3 AND columna3=3 AND columna4=3 AND columna5=3
				     AND columna9!=0
				     AND columna10=3 
					 AND columna16!=0 AND columna17!=0
					 AND columna18!=0 AND columna19!=0
					 AND columna21!=0 AND columna22!=0
					 AND columna30!=2 AND columna31!=2
			         AND columna32!=2 AND columna33!=2 
					 AND columna34!=2 AND columna35!=2
				     AND columna36!=2 AND columna37!=2 
					 AND columna43=3  AND columna45=3
					 AND columna46!=0 AND columna47!=0
					 AND columna48!=0 AND columna49!=0
					 AND columna50!=0 AND columna51=1
					 )";
					 $queryerror="SELECT * FROM errorinserta 
	                 WHERE tupla=" . $cuenta .
				   " AND columna1=3 AND columna2=3 
				     AND columna3=3 AND columna4=3 
					 AND columna5=3
				     AND columna10=3 AND columna11=3
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
			 
	        $result = pg_query($queryerror) or die('Hubo un error con la base de datos');
	        $error= pg_num_rows($result); 
			
	 // echo 'errorno',$error;
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
              id_mem_ram,importa)

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
				   %d,%d )";
				   
                 $queryid=sprintf($strqueryd,$ultimo,$busca,$lab, 
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
                 $ram[0],1);
            echo   $queryid;
                $result=@pg_query($queryid);// or die('ERROR AL INSERTAR EN DISPOSITIVO: ' . pg_last_error());
				 //  $result=@pg_query($querid); 
	          $resulta = @pg_fetch_assoc($result);
				
				if ($result)
			       $importa++;
						
	      }
			else {// busca bien si hubo error de registro lo almacena
	        
	         $errorbien++;
		
			}
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
		<?php }
		else{?> 
          <legend align="left"> <h3><?php echo "Se importaron previamente " . $preimpor . " / " . $cuentaTotal . " dispositivos."; ?> </h3></legend>
          <br>
          <legend align="left"> <h3><?php echo "Se importaron ... " . $importa  . " / " . $cuentaTotal . " dispositivos."; ?> </h3></legend>
          <br>
          <?php } 
          
           if ($sinlab>0 ){	?>
	      <legend align="left"> <h3><?php echo "Tuplas con error por laboratorio inválido: " . $sinlab; ?></h3></legend> 
          <br>
		<?php } ?>
          
          
          <?php if ($novalido > 0 )
		  
		            $botonReg->exportaErrorReg($novalido);
			  
			  	
				if ($errorbien >0 )
						 
		            $botonBien->exportaErrorBien();
	

 }else {?>

  <legend align="center"><?php echo "Tipo de archivo incorrecto"; ?></legend>       

<?php 

 }
   
 }
 /*Revisar tipo de datos para validaciopnes de caTALOGOS
 QUE SEN ENTEROS.
 rEVISAR OBLIGATORIOERAD PERMITIR ALGUNOS
 */
 ?>
 
   






