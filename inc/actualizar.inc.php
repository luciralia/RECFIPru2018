<?php 
require_once('../inc/sesion.inc.php');
require_once('../clases/importa.class.php');

//$tuplabien= new importa();
//$tupla= new importa();
$error = new importa();
$buscaerror = new importa();
$disperror =new importa();

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
		   
	
	       // $cuentatotal=0; //Revisar
	  
	       $query="INSERT INTO dispositivotemp ( dispositivo_clave,usuario_final_clave,familia_clave,
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
										      ('$datosdec[0]','$datosdec[1]','$datosdec[2]', 
                                               '$datosdec[3]','$datosdec[4]','$datosdec[5]',
											   '$datosdec[6]','$datosdec[7]','$datosdec[8]', 
											   '$datosdec[9]','$datosdec[10]','$datosdec[11]', 
											   '$datosdec[12]','$datosdec[13]','$datosdec[14]', 
											   '$datosdec[15]','$datosdec[16]','$datosdec[17]', 
											   '$datosdec[18]','$datosdec[19]',                
											   '$datosdec[20]','$datosdec[21]','$datosdec[22]', 
											   '$datosdec[23]','$datosdec[24]','$datosdec[25]', 
											   '$datosdec[26]','$datosdec[27]','$datosdec[28]',   
											                    '$datosdec[29]','$datosdec[30]','$datosdec[31]','$datosdec[32]', 
											   '$datosdec[33]','$datosdec[34]','$datosdec[35]','$datosdec[36]', 
											   '$datosdec[37]','$datosdec[38]','$datosdec[39]','$datosdec[40]',
											   '$datosdec[41]','$datosdec[42]','$datosdec[43]',
											   '$datosdec[44]','$datosdec[45]','$datosdec[46]',
											   '$datosdec[47]','$datosdec[48]','$datosdec[49]',
											   '$datosdec[50]')"; 
											   
                          $result=@pg_query($con, $query);
						  
						   if (!$result)
							    echo "Ocurrió un error.\n";
						   else 
						   		 $contexitototal=	$contexitototal+1;
								
				
		   } //if (pg_num_rows($datostemp)>0) else
      $cuenta=$cuenta+1;
	   } //while para insertar en dispositivotemporal
	   
	  // $buscaerror->detectaError();
	  
	   // echo 'Ingresando en dispositivotemp...';
	   
	   $cuentatotal=0;
       $cuentaact=0;
	   $noseimporto=0;
	   // validar solo datos obligatorios
	   
	    $query="SELECT * FROM dispositivotemp dt
		        JOIN errorinserta ei
				on dt.inventario=ei.inventario
				WHERE columna51!=4 AND columna51!=6
				AND columna1=1 AND columna2=1 AND columna3=1 AND columna4=1 AND columna5=1
				AND  columna10=1 AND columna11=1 
				AND columna30=1 AND columna31=1 AND columna32=1
				AND columna33=1 AND columna34=1 AND columna35=1
				AND columna36=1 AND columna37=1 AND columna45=1"; 
				
					
		
		$datos = pg_query($con,$query);
		while ($disp = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
	          // Busca en dispositivo
		      $queryinv="SELECT * FROM dispositivo WHERE 
		              inventario="."'".$disp['inventario']."'"
					  ; //actualiza si y solo si se ha importado
				//echo $queryinv;
				  $datosinv = pg_query($con,$queryinv);  
				  //cantidad
				  /*if (pg_num_rows($datosinv)==0) {
					
						 echo 'no se importo';
					     $noseimporto++;
					 }else{
				   echo'puede actualizar, porque ya se importo';*/
					 
		    
			
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
			                       $lab=$equipoc[0];
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
							  
			        $queryu=sprintf($updatequery, $bienes[0],$lab,$disp['dispositivo_clave'],$disp['usuario_final_clave'], $disp['familia_clave'],$disp['tipo_ram_clave'],$disp['tecnologia_clave'],$disp['resguardo_nombre'],$disp['resguardo_no_empleado'],$disp['usuario_nombre'],$disp['usuario_ubicacion'],$disp['usuario_perfil'],$disp['usuario_sector'],$disp['serie'],$disp['marca_p'],$disp['no_factura'],$disp['anos_garantia'],$disp['inventario'],$disp['modelo_p'],$disp['proveedor'],$disp['fecha_factura'],$disp['familia_especificar'],$disp['modelo_procesador'],$disp['cantidad_procesador'],$disp['nucleos_totales'],$disp['nucleos_gpu'],$disp['memoria_ram'],$disp['ram_especificar'],$disp['num_elementos_almac'],$disp['total_almac'],$disp['num_arreglos'],$disp['esquema_uno'],$disp['esquema_dos'],$disp['esquema_tres'],$disp['esquema_cuatro'],$disp['tec_uno'],$disp['tec_dos'],$disp['tec_tres'],$disp['tec_cuatro'],$disp['subtotal_uno'],$disp['subtotal_dos'],$disp['subtotal_tres'],$disp['subtotal_cuatro'],$disp['arreglo_total'],$disp['tec_com'],$disp['sist_oper'],$disp['version_sist_oper'],$disp['licencia'],$disp['licencia_ini'],$disp['licencia_fin'],date("Y-m-d"),$equipoc[1],$equipoc[2],$equipoc[3], $equipoc[4],$equipoc[5],$equipoc[6], $equipoc[7],$equipoc[8],$equipoc[9], $equipoc[10],$equipoc[11],$equipoc[12], $marca[0],$disp['marca'],'', $ram[0],2); 
			   
                    $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR tupla en dispositivo'); 
					
					 if (!$result) {
						// echo 'entrono se importo';
					    // $noseimporto++;
					 }
                     else
 		                  $cuentaact++;
				
			 
		  
		  } // fin de la validación cuando si existe en BIENES INVENTARIO
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
		

		//para detectar tuplas con errores de lab
		
	     $querylab="SELECT * FROM errorinserta
		           WHERE columna51=4 OR columna51=6";
				   
		 $result = pg_query($querylab) or die('Hubo un error con la base de datos en error inserta');
		
         $sinlab= pg_num_rows($result); 
		 
		// if ($total!=0){
		 //  $error->importaError();
		// }

		//}//no se importo
		//echo 'no se importo'.$noseimporto;
		// if ($noseimporto!=0){ ?>
	    
             <legend align="left"> <h4><?php // echo "El inventario no se ha registrado previamente."; ?></h4> </legend>
		<?php //}
		//else{?>
		
	
         
             <legend align="left"> <h4><?php echo "Se actualizaron " . $cuentaact . " / " . $contexitototal . " dispositivos."; ?></h4>  </legend>
            
             <br>
             
          <?php // }?>   
               <?php  if ( $conterrorbn > 0) { ?>
            <legend align="left"> <h4><?php echo "Faltó actualizar  " . $conterrorbn ." dispositivos que no se encuentran en el inventario de la facultad." ?></h4> </legend> 
                <br>
              <form action="../inc/erroresbn.inc.php" method="post" name="erroresbnact" >
	          <input name="actbn" type="submit" value="Exportar a Excel" />
	          </form>
              <br>
        <?php
		 }
		 
		 if ($noseimporto==0)
		   //  $disperror->guardaDispErrorAct();
		 
		 
		  if ($sinlab>0 ){
		?>
		<br>
      <legend align="left"> <h4><?php echo "Dispositivos  con laboratorio inexistente : " . $sinlab ; ?></h4> </legend>
          
        <br/>
       <?php } 
		 
		
 } else { ?>
      <!--<tr>
      <td><legend align="center"> <h4><?php //echo 'Ingrese archivo';?></h4> </legend>
            </td>
      </tr>-->
 <?php  }
 
        $querydt="DELETE FROM dispositivotemp";	
		$datosdt = pg_query($con,$querydt); 
		$querydt="DELETE FROM errorinserta";	
		$result = pg_query($querydt) or die('Hubo un error con la base de datos');
?>
</div></td>          
</tr>


<?php //require('pie.inc.php'); ?>


