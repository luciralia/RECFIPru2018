<?php
require_once('../conexion.php');
//session_start(); 

class importa{
	function importaError(){
	
	 $queryerror="SELECT * FROM errorinserta WHERE 
	                columna1=0 OR columna2=0 OR columna3=0 OR columna4=0 OR columna5=0 
					OR columna6=1 OR columna7=1 OR columna8=1 OR columna9=1 OR columna10=1
					OR columna11=1  OR columna13=1 OR columna14=1 OR columna15=1
					OR columna16=1 OR columna17=1 OR columna18=1 OR columna19=1 
					OR columna21=1 OR columna22=1 OR columna23=1 OR columna24=1 OR columna25=1
				    OR columna27=1 OR columna29=1 OR columna30=1
					OR columna31=1 OR columna32=1 OR columna33=1 OR columna34=1 OR columna35=1
					OR columna36=1 OR columna37=1 OR columna38=1 OR columna39=1 OR columna40=1
					OR columna41=1 OR columna42=1 OR columna43=1 OR columna45=1
					OR columna46=1 OR columna47=1 OR columna48=1 OR columna49=1 OR columna50=1 OR columna51=1";
			//echo $queryerror;			
					
        $result=pg_query($con, $queryerror);
		
		
		while ($disperror = pg_fetch_array($result, NULL,PGSQL_ASSOC)) 
		{ 
		//print_r($disperror);
		    if ($disperror['columna1']==0) { ?>
		       <tr><td> <?php echo 'Faltó ingresar columna A clave_dispositivo de la tupla: '.$disperror['tupla']; ?></td></tr>
     <?php  }else if ($disperror['columna2']==0){ ?>
		       <tr><td> <?php  echo 'Faltó ingresar columna B usuario_final_clave de la tupla: '.$disperror['tupla'];?></td></tr>	
	 <?php  }else if ($disperror['columna3']==0) { ?>
		       <tr><td> <?php echo 'Faltó ingresar columna C familia_clave de la tupla: '.$disperror['tupla'];	?></td></tr>		
	 <?php  }else if ($disperror['columna4']==0) { ?>
		       <tr><td> <?php echo 'Faltó ingresar columna D tipo_ram_clave de la tupla: '.$disperror['tupla']; ?></td></tr>		
	 <?php  }else if ($disperror['columna5']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna E tecnologia_clave de la tupla: '.$disperror['tupla']; ?></td></tr>				
	 <?php  }else if ($disperror['columna6']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna F resguardo_nombre de la tupla: '.$disperror['tupla']; ?></td></tr>				
	 <?php  }else if ($disperror['columna7']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna G resguardo_no_empleado de la tupla: '.$disperror['tupla']; ?></td></tr>		     <?php  }else if ($disperror['columna8']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna H usuario_nombre de la tupla: '.$disperror['tupla']; ?></td></tr>	
     <?php  }else if ($disperror['columna9']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna I usuario_ubicación de la tupla: '.$disperror['tupla']; ?></td></tr>	      <?php  }else if ($disperror['columna10']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna J usuario_perfil de la tupla: '.$disperror['tupla']; ?></td></tr>	      <?php  }else if ($disperror['columna11']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna K usuario_sector de la tupla: '.$disperror['tupla']; ?></td></tr>	      <?php  }else if ($disperror['columna13']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna M marca_p de la tupla: '.$disperror['tupla']; ?></td></tr>	  	    	      <?php  }else if ($disperror['columna14']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna N no_factura de la tupla: '.$disperror['tupla']; ?></td></tr>	
      <?php  }else if ($disperror['columna15']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna O años garantía de la tupla: '.$disperror['tupla']; ?></td></tr> 
      <?php  }else if ($disperror['columna16']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna P inventario de la tupla: '.$disperror['tupla']; ?></td></tr>      
	  <?php  }else if ($disperror['columna17']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna Q modelo_p de la tupla: '.$disperror['tupla']; ?></td></tr> 
      <?php  }else if ($disperror['columna18']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna R proveedor_p de la tupla: '.$disperror['tupla']; ?></td></tr>      
	  <?php  }else if ($disperror['columna19']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna S fecha_factura de la tupla: '.$disperror['tupla']; ?></td></tr> 
      <?php  }else if ($disperror['columna21']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna U modelo_procesador de la tupla: '.$disperror['tupla']; ?></td></tr>      <?php  }else if ($disperror['columna22']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna V cantidad_procesador de la tupla: '.$disperror['tupla']; ?></td></tr>      <?php  }else if ($disperror['columna23']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna W nucleos_totales de la tupla: '.$disperror['tupla']; ?></td></tr> 
      <?php  }else if ($disperror['columna24']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna X nucleos_GPU de la tupla: '.$disperror['tupla']; ?></td></tr>      
	  <?php  }else if ($disperror['columna25']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna Y memoria_RAM de la tupla: '.$disperror['tupla']; ?></td></tr>
      <?php  }else if ($disperror['columna26']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AA num_elementos_almac de la tupla: '.$disperror['tupla']; ?></td></tr>      <?php  }else if ($disperror['columna28']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AC num_arreglos de la tupla: '.$disperror['tupla']; ?></td></tr>      <?php  }else if ($disperror['columna29']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AD esquema_uno de la tupla: '.$disperror['tupla']; ?></td></tr>   
      <?php  }else if ($disperror['columna30']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AE esquema_dos de la tupla: '.$disperror['tupla']; ?></td></tr>            <?php  }else if ($disperror['columna31']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AF esquema_tres de la tupla: '.$disperror['tupla']; ?></td></tr>
      <?php  }else if ($disperror['columna32']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AG esquema_cuatro de la tupla: '.$disperror['tupla']; ?></td></tr>            <?php  }else if ($disperror['columna33']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AH tec_uno de la tupla: '.$disperror['tupla']; ?></td></tr>
      <?php  }else if ($disperror['columna34']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AI tec_dos de la tupla: '.$disperror['tupla']; ?></td></tr>  
      <?php  }else if ($disperror['columna35']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AJ tec_tres de la tupla: '.$disperror['tupla']; ?></td></tr>   
      <?php  }else if ($disperror['columna36']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AK tec_cuatro de la tupla: '.$disperror['tupla']; ?></td></tr>              <?php  }else if ($disperror['columna37']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AL subtotal_uno de la tupla: '.$disperror['tupla']; ?></td></tr>             <?php  }else if ($disperror['columna38']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AM subtotal_dos de la tupla: '.$disperror['tupla']; ?></td></tr>  
      <?php  }else if ($disperror['columna39']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AN subtotal_tres de la tupla: '.$disperror['tupla']; ?></td></tr>             <?php  }else if ($disperror['columna40']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AO subtotal_cuatro de la tupla: '.$disperror['tupla']; ?></td></tr>
      <?php  }else if ($disperror['columna41']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AP arreglo_total de la tupla: '.$disperror['tupla']; ?></td></tr>             <?php  }else if ($disperror['columna42']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AQ tec_com de la tupla: '.$disperror['tupla']; ?></td></tr>  
      <?php  }else if ($disperror['columna44']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AS sist_oper de la tupla: '.$disperror['tupla']; ?></td></tr>      
	  <?php  }else if ($disperror['columna45']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AT version_sist_oper de la tupla: '.$disperror['tupla']; ?></td></tr>
      <?php  }else if ($disperror['columna46']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AU licencia de la tupla: '.$disperror['tupla']; ?></td></tr>      
	  <?php  }else if ($disperror['columna47']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AV licencia_ini de la tupla: '.$disperror['tupla']; ?></td></tr>            <?php  }else if ($disperror['columna48']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AW licencia_fin de la tupla: '.$disperror['tupla']; ?></td></tr>      <?php  }else if ($disperror['columna49']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AX id_edificio de la tupla: '.$disperror['tupla']; ?></td></tr>      <?php  }else if ($disperror['columna50']==0) {?>
		      <tr><td> <?php echo 'Faltó ingresar columna AY id_lab de la tupla: '.$disperror['tupla']; ?></td></tr>          
	  <?php 
			}
		
	   
		}//fin de while $disperro

}//fin funcion
/*
           function buscaBien($inventario,$clave_disp,$iddiv){
	
	                //Traer el último valor en dispositivo
			       $queryd="SELECT max(id_dispositivo) FROM dispositivo";
                   $registrod= @pg_query($con,$queryd);
                   $ultimo=@pg_fetch_array($registrod);
	
		           if ($ultimo[0]==0)
				       $ultimo=1;//inicializando la tabla dispositivouno
			       else 
			           $ultimo=$ultimo[0]+1;
					
		           //Buscar en bienes 
			 
			       $queryb="SELECT bn_id
							  FROM bienes
			                  WHERE bn_clave=" .$inventario .
							  " OR bn_anterior=" .$inventario;
			        //echo $queryb;
			 				  
			       $registrob= @pg_query($con,$queryb);
                   $bienes= @pg_fetch_array($registrob);
			  
			       if(@pg_num_rows($registrob)==0){
				  
			            $queryre="SELECT max(id_error) FROM registroerror";
                        $registrore= @pg_query($con,$queryre);
                        $ultimoerror= @pg_fetch_array($registrore);
	
		                if ($ultimoerror[0]==0)
				             $ultimoerror=1;//inicializando la tabla dispositivouno
			            else 
			                 $ultimoerror=$ultimoerror[0]+1;	  
             
			            $querybien="INSERT INTO registroerror(id_error,inventario,clave_dispositivo,fecharegistro,id_div,tipoerror)
			                        VALUES (%d,'%s',%d,'%s',%d,'%s')";
						   
			            $queryerror=sprintf($querybien,$ultimoerror,$inventario,$clave_disp,date('Y-m-d H:i:s'),                        $iddiv,'b' );			 
			            $registroerror= @pg_query($con,$queryerror);
			   
			            if ($registroerror) 
                               $conterrorbn=$conterrorbn+1;
			            else
				               $contexitobn=$contexitobn+1;

                  } // if(pg_num_rows($registrob)==0)

           } // finaliza funcion buscaBien

function importaInventario($inventario,$clave_disp,$iddiv,$idLab){

//Traer el último valor en dispositivo
			       $queryd="SELECT max(id_dispositivo) FROM dispositivo";
                   $registrod= @pg_query($con,$queryd);
                   $ultimo=@pg_fetch_array($registrod);
	
		           if ($ultimo[0]==0)
				       $ultimo=1;//inicializando la tabla dispositivouno
			       else 
			           $ultimo=$ultimo[0]+1;
					
		           //Buscar en bienes 
			 
			       $queryb="SELECT bn_id
							  FROM bienes
			                  WHERE bn_clave=" .$inventario .
							  " OR bn_anterior=" .$inventario;
			        //echo $queryb;
			 				  
			       $registrob= @pg_query($con,$queryb);
                   $bienes= @pg_fetch_array($registrob);
			  
			       if(@pg_num_rows($registrob)==0){
				  
			            $queryre="SELECT max(id_error) FROM registroerror";
                        $registrore= @pg_query($con,$queryre);
                        $ultimoerror= @pg_fetch_array($registrore);
	
		                if ($ultimoerror[0]==0)
				             $ultimoerror=1;//inicializando la tabla dispositivouno
			            else 
			                 $ultimoerror=$ultimoerror[0]+1;	  
             
			            $querybien="INSERT INTO registroerror(id_error,inventario,clave_dispositivo,fecharegistro,id_div,tipoerror)
			                        VALUES (%d,'%s',%d,'%s',%d,'%s')";
						   
			            $queryerror=sprintf($querybien,$ultimoerror,$inventario,$clave_disp,date('Y-m-d H:i:s'),                        $iddiv,'b' );			 
			            $registroerror= @pg_query($con,$queryerror);
			   
			            if ($registroerror) 
                               $conterrorbn=$conterrorbn+1;
			            else
				               $contexitobn=$contexitobn+1;

                  } // if(pg_num_rows($registrob)==0)


			  $querye="SELECT id_lab,velocidad,cache,tipotarjvideo,modelotarjvideo,
			                   memoriavideo,equipoaltorend,accesorios,garantiamanten,arquitectura,
							   estadobien,servidor,descextensa 
							   FROM equipoc
			                   WHERE inventario=". $inventario;
							  
              $registroe= @pg_query($con,$querye);
              $equipoc= @pg_fetch_array($registroe);
			 
			  if($idLab==0) // id id_lab=0
			     $lab=$equipoc[0];
			  else 	 
			     $lab=$idLab;
				
			 
			   $query="SELECT * FROM dispositivotemp"; 
		
		       $datos = @pg_query($con,$query);	
			   
			   $disp= @pg_fetch_array($datos);
			   
			  //buscar información de los catalogos de marca y memoria ram
			   $querym="SELECT id_marca 
						FROM cat_marca
			            WHERE descmarca="."'".$disp['marca_p']."'";
							  
              $registrom= @pg_query($con,$querym);
              $marca= @pg_fetch_array($registrom);
			  
			   $querymr="SELECT id_mem_ram 
						 FROM cat_memoria_ram
			             WHERE cantidad_ram="."'".$disp['memoria_ram']."'";
							  
              $registromr= @pg_query($con,$querymr);
              $ram= @pg_fetch_array($registromr);		  
		         
		      if ($ram[0]==NULL)
				  $ram=0;
			  else 
			      $ram=$ram[0];	  

              $queryd="SELECT detalle_ub 
							  FROM laboratorios
			                  WHERE id_lab=" . $idLab;
							  
              $registrod= @pg_query($con,$queryd);
              $detalle= @pg_fetch_array($registrod);	

              //$updatequery= "UPDATE laboratorios SET detalle_ubcomp= '%s'
			    //              WHERE id_lab=" .$idLab;
			   
			 // $queryu=sprintf($updatequery, $detalle[0]|| ' ' || $usu_ubica ); 
			   
             // $result=@pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR laboratorios');
              
              if ($bienes[0]!=NULL ){
			        echo 'ent5ra a insettar dispsotivo';
					 
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

		             VALUES (%d,%d,%d,  --id_disp 3
		                     %d,%d,%d,  --disp_clave 6
				             %d,%d,'%s',%d,--tiporam_clave 10
				            '%s','%s',%d,    --usuario_nombre 13
				             %d,'%s','%s',   --suario_sector 16
				            '%s','%s','%s',  --nofactura 19
				            '%s','%s','%s',  --modelo_p 22
				            '%s','%s','%s',  --familia_espec 25
				            '%s','%s','%s',  --nucleos_totales 28
				            '%s',%d,   --ram_espec 30
				             %d,%d,%d,  --total_almac 33
				             %d,%d,%d,  --esquema_dos  36
				             %d,%d,%d,%d,   --tec_uno  40
				             %d,%d,%d,%d,   --subtotal 44
				             %d,%d,'%s',    --arreglo_total 47
				             %d,'%s',      --sist_oper 49
				             %d,'%s','%s','%s', --licencia 53
				            '%s','%s','%s',     --velodidad 56 
				            '%s','%s','%s',     --modelotarj 59
				            '%s','%s','%s',     --accesorios 62
				            '%s','%s','%s',     --estadobin 65
				             %d,'%s','%s',      --idmarca 68
				             %d )";//%d
				   
                     $queryid=sprintf($strqueryd,$ultimo,$bienes[0],$lab, //3
                     $disp['dispositivo_clave'],$disp['usuario_final_clave'],$disp['familia_clave'], //6
				     $disp['tipo_ram_clave'], $disp['tecnologia_clave'],$disp['nombre_resguardo'], $disp['resguardo_no_empleado'],//10
                     $disp['usuario_nombre'],$disp['usuario_ubicacion'], $disp['usuarioperfil'], //13
				     $disp['usuario_sector'], $disp['serie'], $disp['marca_p'], //16
				     $disp['no_factura'], $disp['anos_garantia'], $disp['inventario'], //19
                     $disp['modelo_p'], $disp['proveedor_p'],date("Y-m-d", strtotime($disp['fecha_factura'])), //22
			         $disp['familia_especificar'], $disp['modelo_procesador'], $disp['cantidad_procesador'], //25
			         $disp['nucleos_totales'], $disp['nucleos_gpu'], $disp['memoria_ram'], //28
                     $disp['ram_especificar'], $disp['num_elementos_almac'], //30 
			         $disp['total_almac'], $disp['num_arreglos'], $disp['esquema_uno'], //33
			         $disp['esquema_dos'], $disp['esquema_tres'], $disp['esquema_cuatro'], //36
			         $disp['tec_uno'], $disp['tec_dos'], $disp['tec_tres'], $disp['tec_cuatro'], //40
				     $disp['subtotal_uno'], $disp['subtotal_dos'], $disp['subtotal_tres'], $disp['subtotal_cuatro'], //44
                     $disp['arreglo_total'], $disp['tec_com'], $disp['tec_com_otro'], //47
			         $disp['sist_oper'], $disp['version_sist_oper'], //49
			         $disp['licencia'], date("Y-m-d", strtotime($disp['licencia_ini'])),date("Y-m-d",
				          strtotime($disp['licencia_fin'])),date('Y-m-d'), //53
				     $equipoc[1],$equipoc[2],$equipoc[3], //56
				     $equipoc[4],$equipoc[5],$equipoc[6], //59
                     $equipoc[7],$equipoc[8],$equipoc[9], //62
				     $equipoc[10],$equipoc[11],$equipoc[12], //65
                     $marca[0],$disp['marca'],'', //68
                     $ram[0]);//,$disp['id_mod']
               
                     $result= @pg_query($con,$queryid) or die('ERROR AL INSERTAR EN DISPOSITIVO: ' . pg_last_error());
				    // echo 'query que inserta';
                    // echo $strqueryd;
			
				 
				    if (!$result) 
                          echo "Ocurrió un error.\n";
                     else 
 		                  $cuentatotal=$cuentatotal+1;
                     
				    // actualiza bit de importación
				
		            $updatequery= "UPDATE dispositivo SET importa=1
			                        WHERE inventario="."'".$disp['inventario']."'";
					  
			        $queryu=sprintf($updatequery, $disp['inventario'] ); 
			   
                    $result=@pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR dispositivo'); 
              
			
				   	//Llenar tabla respaldoDispositivo
				
			  $queryd="SELECT max(id_dispositivo) FROM dispositivorespaldo";
              $registrod= @pg_query($con,$queryd);
              $ultimoreg= @pg_fetch_array($registrod);
	
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
				      %d)";//%d
				   
                 $queryid=sprintf($strqueryd,$ultimoreg,$bienes[0],$lab, //3
                 $disp['dispositivo_clave'],$disp['usuario_final_clave'],$disp['familia_clave'], //6
				 $disp['tipo_ram_clave'], $disp['tecnologia_clave'],$disp['nombre_resguardo'], $disp['resguardo_no_empleado'] ,//10
                 $disp['usuario_nombre'],$disp['usuario_ubicacion'], $disp['usuarioperfil'], //13
				 $disp['usuario_sector'], $disp['serie'], $disp['marca_p'], //16
				 $disp['no_factura'], $disp['anos_garantia'], $disp['inventario'], //19
                 $disp['modelo_p'], $disp['proveedor_p'],date("Y-m-d", strtotime($disp['fecha_factura'])), //22
			     $disp['familia_especificar'], $disp['modelo_procesador'], $disp['cantidad_procesador'], //25
			     $disp['nucleos_totales'], $disp['nucleos_gpu'], $disp['memoria_ram'], //28
                 $disp['ram_especificar'], $disp['num_elementos_almac'], //30 
			     $disp['total_almac'], $disp['num_arreglos'], $disp['esquema_uno'], //33
			     $disp['esquema_dos'], $disp['esquema_tres'], $disp['esquema_cuatro'], //36
			     $disp['tec_uno'], $disp['tec_dos'], $disp['tec_tres'], $disp['tec_cuatro'], //40
				 $disp['subtotal_uno'], $disp['subtotal_dos'], $disp['subtotal_tres'], $disp['subtotal_cuatro'], //44
                 $disp['arreglo_total'], $disp['tec_com'], $disp['tec_com_otro'], //47
			     $disp['sist_oper'], $disp['version_sist_oper'], //49
			     $disp['licencia'], date("Y-m-d", strtotime($disp['licencia_ini'])),date("Y-m-d",
				 strtotime($disp['licencia_fin'])),date('Y-m-d'), //53
				 $equipoc[1],$equipoc[2],$equipoc[3], //56
				 $equipoc[4],$equipoc[5],$equipoc[6], //59
                 $equipoc[7],$equipoc[8],$equipoc[9], //62
				 $equipoc[10],$equipoc[11],$equipoc[12], //65
                 $marca[0],$disp['marca'],'', //68
                 $ram[0]);//,$disp['id_mod']
               
                 $result=@pg_query($con,$queryid) or die('ERROR AL INSERTAR EN dispositivorespaldo: ');	
				
				 $updatequery= "UPDATE dispositivorespaldo SET importa=1
			                    WHERE inventario="."'".$disp['inventario']."'";
					  
			     $queryu=sprintf($updatequery, $disp['inventario'] ); 
			   
                 $result=@pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR dispositivorespaldo'); 
				
			  }//valores que estan en bienes
		
    } // finaliza clase importainventario
*/



}//finaliza clase importa

?>