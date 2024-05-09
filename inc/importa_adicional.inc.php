 <?php 
session_start();
require_once('../conexion.php');


echo 'Importa  dispositivo periferico';


echo 'Valor inventario'. $datosdec[15];

 
echo 'valor disp', $ultimo;



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
				   
					   //echo 'Query  INSERTA mac1'. $queryidmac;
			            $result=pg_query($queryidmac) or die('ERROR AL INSERTAR EN MAC: ' . pg_last_error());
				        $mac2=$datosdec[63];
			  
			   	      if ($mac2!='0')
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
				      $queryidDIG=sprintf($queryDIG, $ultimo,
					                   $datosdec[50]);		
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
				   
					  //echo 'Query ERROR INSERTA ACCESS'. $queryidAC;
				   
				      if ($datosdec[53]!=0)
						  
					  {   //inserta segunda red difunde, si existe
						  
						  $queryACr="INSERT INTO red_difunde(id_red_dif,id_dispositivo,id_tipo_red) VALUES (%d,%d,%d)";
				          $queryidACr=sprintf($queryACr,$urd+1,$ultimo,$datosdec[53]);	
					  }
					 
                      $result=pg_query($queryidACr) or die('ERROR AL INSERTAR EN ACCESS: ' . pg_last_error());
		   
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
		  


  require_once('importar_2024.inc.php');
	  

?>