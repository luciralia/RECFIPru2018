 <?php 
session_start();
require_once('../conexion.php');


echo 'Actualiza  dispositivo periferico';
//si es imprsora?
         $queryd="SELECT id_dispositivo  FROM dispositivo WHERE inventario=".$datosdec[15] ;
         $registrod= pg_query($con,$queryd);
         $id_disp[0]= pg_fetch_array($registrod);  


          if ($datosdec[0]==1 || $datosdec[0]==2 || $datosdec[0]==3 || $datosdec[0]==4 ||
			 $datosdec[0]==5 || $datosdec[0]==6 || $datosdec[0]==7 ||$datosdec[0]==8 ||
			 $datosdec[0]==17 ||$datosdec[0]==18 ||$datosdec[0]==19 )
				 {

                  //es equipo de cómputo 
			  
			     //Borrar y volver a insertar
			   
			    $query="DELETE FROM mac 
			            WHERE id_dispositivo=".$id_disp;
			    $queryu=sprintf($query,$id_disp);

                 //Volver a insertar
			   
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
				   
					  // echo 'Query  INSERTA mac1'. $queryidmac;
			            $result=pg_query($queryidmac) or die('ERROR AL INSERTAR EN MAC: ' . pg_last_error());
				        $mac2=$datosdec[63];
			  
			   	      if ($mac2!='0')
						  {
						
						  $querymac="INSERT INTO mac(id_disp_mac,id_dispositivo,mac) VALUES (%d,%d,'%s')";
				          $queryidmac=sprintf($querymac,$umac+1, $ultimo,$mac2);	
						    //echo 'Query  INSERTA mac2'. $queryidmac;
						  $result=pg_query($queryidmac) or die('ERROR AL INSERTAR EN MAC: ' . pg_last_error());
						  }
			  
			  
			  
		    }else if ($datosdec[0]==10 ){
			   
			   //es impresora
			    $query="UPDATE impresora SET id_dispositivo=%d,id_impresora=%d
			            WHERE id_dispositivo=".$id_disp;
			   
			    $queryu=sprintf($query,$id_disp,$datosdec[49]);
			   
			    
			} else if ($datosdec[0]==13 ){
			   
			  // es digitalizador
			   
			   $query="UPDATE digitaliza SET id_dispositivo=%d,id_digitaliza=%d
			            WHERE id_dispositivo=".$id_disp;
			   $queryu=sprintf($query,$id_disp,$datosdec[50]);
			   
			    
			   
		   }else if ($datosdec[0]==14 ){
			   
			  // es access point
			   
			   $query="UPDATE access SET id_dispositivo=%d,id_access=%d
			            WHERE id_dispositivo=".$id_disp;
			   $queryu=sprintf($query,$id_disp,$datosdec[51]);
			   
			  //borrar red que difunde
			  
			     $query="DELETE FROM red_difunde 
			            WHERE id_dispositivo=".$id_disp;
			    $queryu=sprintf($query,$id_disp);
			  
			 // Volver a insertar
			  
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
			          $result=pg_query($queryidACr) or die('ERROR AL INSERTAR EN ACCESS: ' . pg_last_error());
				   
				      if ($datosdec[53]!=0)
						  
					  {   //inserta segunda red difunde, si existe
						  
						  $queryACr="INSERT INTO red_difunde(id_red_dif,id_dispositivo,id_tipo_red) VALUES (%d,%d,%d)";
				          $queryidACr=sprintf($queryACr,$urd+1,$ultimo,$datosdec[53]);	
						  $result=pg_query($queryidACr) or die('ERROR AL INSERTAR EN ACCESS: ' . pg_last_error());
		   
					  }
					 
                      
			   }//fin de access_point
			  
			  
			  
			   
		   }else if ($_POST['dispositivo_clave']==15 ){
			   
			  // es Firewall
			   
			   $query="UPDATE firewall SET id_dispositivo=%d,id_firewall=%d
			            WHERE id_dispositivo=".$id_disp;
			   
			    $queryu=sprintf($query,$id_disp,$datosdec[52]);
			   
			    
			   
		   }else if ($_POST['dispositivo_clave']==17 ){
			   
			  // es IDS
			   
			   $query="UPDATE ids SET id_dispositivo=%d,id_ids=%d
			            WHERE id_dispositivo=".$id_disp;
			   
			    $queryu=sprintf($query,$id_disp,$datosdec[54]);
			   
			    
			   
		   }else if ($_POST['dispositivo_clave']==18 ){
			   
			  // es IpS
			   
			   $query="UPDATE ips SET id_dispositivo=%d,id_ips=%d
			            WHERE id_dispositivo=".$id_disp;
			   
			    $queryu=sprintf($query,$id_disp,$datosdec[54]);
			   
			    
		   } else if ($_POST['dispositivo_clave']==16 ){
			   
			  // es Switch
			   
			   $query="UPDATE switch SET id_dispositivo=%d,id_tipo_switch=%d,
			          id_puerto=%d,id_chasis=%d
			          WHERE id_dispositivo=".$id_disp;
				      
			    $queryu=sprintf($query,$id_disp,$datosdec[55],
								$datosdec[56],$datosdec[57]);
		   }
			    echo $queryu;
			   
			    $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());

	$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']."&div=" .$_SESSION['id_div'];
    echo $direccion;
    header($direccion);

?>