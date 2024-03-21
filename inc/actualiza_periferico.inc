 <?php 
session_start();
require_once('../conexion.php');


			   

echo 'Actualiza  dispositivo periferico';
//si es imprsora?
         $queryd="SELECT id_dispositivo  FROM dispositivo WHERE inventario=".$datosdec[15] ;
         $registrod= pg_query($con,$queryd);
         $id_disp= pg_fetch_array($registrod);  


	       if ($datosdec[0]==10 ){
			   
			   //es impresora
			    $query="UPDATE impresora SET id_dispositivo=%d,id_impresora=%d
			            WHERE id_dispositivo=".$id_disp;
			   
			    $queryu=sprintf($query,$id_disp,$datosdec[49]);
			   
			    
			}else if ($datosdec[0]==13 ){
			   
			  // es digitalizador
			   
			   $query="UPDATE digitaliza SET id_dispositivo=%d,id_digitaliza=%d
			            WHERE id_dispositivo=".$id_disp;
			   
			    $queryu=sprintf($query,$id_disp,$datosdec[50]);
			   
			    
			   
		   }else if ($datosdec[0]==14 ){
			   
			  // es access point
			   
			   $query="UPDATE digitaliza SET id_dispositivo=%d,id_access=%d
			            WHERE id_dispositivo=".$id_disp;
			   
			    $queryu=sprintf($query,$id_disp,$datosdec[51]);
			   
			    
			   
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