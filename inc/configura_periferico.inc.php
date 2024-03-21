 <?php 
session_start();
require_once('../conexion.php');


			   

echo 'Configura dispositivo periferico';
//si es imprsora?
	       if ($_POST['dispositivo_clave']==10 ){
			   
			   //es impresora
			    $query="UPDATE impresora SET id_dispositivo=%d,id_impresora=%d
			            WHERE id_dispositivo=".$_POST['id_dispositivo'];
			   
			    $queryu=sprintf($query,$_POST['id_dispositivo'],$_POST['id_tipoi']);
			   
			    
			}else if ($_POST['dispositivo_clave']==13 ){
			   
			  // es digitalizador
			   
			   $query="UPDATE digitaliza SET id_dispositivo=%d,id_digitaliza=%d
			            WHERE id_dispositivo=".$_POST['id_dispositivo'];
			   
			    $queryu=sprintf($query,$_POST['id_dispositivo'],$_POST['id_digitaliza']);
			   
			    
			   
		   }else if ($_POST['dispositivo_clave']==14 ){
			   
			  // es access point
			   
			   $query="UPDATE digitaliza SET id_dispositivo=%d,id_access=%d
			            WHERE id_dispositivo=".$_POST['id_dispositivo'];
			   
			    $queryu=sprintf($query,$_POST['id_dispositivo'],$_POST['id_access']);
			   
			    
			   
		   }else if ($_POST['dispositivo_clave']==15 ){
			   
			  // es Firewall
			   
			   $query="UPDATE firewall SET id_dispositivo=%d,id_firewall=%d
			            WHERE id_dispositivo=".$_POST['id_dispositivo'];
			   
			    $queryu=sprintf($query,$_POST['id_dispositivo'],$_POST['id_firewall']);
			   
			    
			   
		   }else if ($_POST['dispositivo_clave']==17 ){
			   
			  // es IDS
			   
			   $query="UPDATE ids SET id_dispositivo=%d,id_ids=%d
			            WHERE id_dispositivo=".$_POST['id_dispositivo'];
			   
			    $queryu=sprintf($query,$_POST['id_dispositivo'],$_POST['id_ids']);
			   
			    
			   
		   }else if ($_POST['dispositivo_clave']==18 ){
			   
			  // es IPS
			   
			   $query="UPDATE ips SET id_dispositivo=%d,id_ips=%d
			            WHERE id_dispositivo=".$_POST['id_dispositivo'];
			   
			    $queryu=sprintf($query,$_POST['id_dispositivo'],$_POST['id_ips']);
			   
			    
		   }else if ($_POST['dispositivo_clave']==16 ){
			   
			  // es Switch
			   
			   
               if (isset($_POST['chasis'])){
                   echo 'Imprime chas=1',$chas;
	               $chas=1;}
               else {
				   echo 'Imprime chas=0',$chas;
                   $chas=0;}
			   
			   $query="UPDATE switch SET id_dispositivo=%d,id_tipo_switch=%d,
			          id_puerto=%d,id_chasis=%d
			          WHERE id_dispositivo=".$_POST['id_dispositivo'];
				      
			    $queryu=sprintf($query,$_POST['id_dispositivo'],$_POST['id_switch'],
								$_POST['id_puerto'],$chas);
		   }
			    echo $queryu;
			   
			    $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());

	$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']."&div=" .$_SESSION['id_div'];
    echo $direccion;
    header($direccion);

?>