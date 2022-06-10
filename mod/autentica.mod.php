<?php
session_start();
require_once('../conexion.php');
require_once('../clases/log.class.php');

$logger=new Log();


$login=$_POST['login'];
$password=md5($_POST['pwd']);
  
/*$query = "SELECT * FROM usuarios U
          FULL OUTER JOIN divisiones d
          ON u.id_usuario=d.id_cac
          WHERE usuario = '" . $login . "' AND  password='" . $password."'";
		  
		  $query ="select  id_usuario,dv.id_div as dvdiv,d.id_div as div,d.id_dep as dep, tipo_usuario from usuarios u */
	$query ="select * from usuarios u  
             full outer join departamentos d
             on d.id_dep=u.id_dep
             full join divisiones dv
             on dv.id_cac=u.id_usuario 
             where usuario= '" . $login . "' AND  password='" . $password."'";
		  
		  		  
//$query = sprintf("SELECT * FROM usuarios WHERE usuario = '%s' AND pass='%s'", trim($_POST['usuario']), trim($_POST['pwd']));
$datos=pg_query($con, $query);



//si encuentra coincidencia
$nreng = pg_num_rows($datos);


if ($nreng==1){
$datos=pg_query($con, $query);		  
$usuario = pg_fetch_array($datos, NULL, PGSQL_ASSOC);
foreach ($usuario as $campo => $valor) {
    //echo "\$usuario[$campo] => $valor.\n" . "</br>";
	$_SESSION[$campo]=$valor;
		}



//consulta permisos
$query2="Select * from permisod where id_usuario=" . $usuario['id_usuario'];
$datosp=pg_query($con,$query2);

$usuariop = pg_fetch_array($datosp, NULL, PGSQL_ASSOC);
foreach ($usuariop as $campo => $valor) {
$_SESSION['permisos'][$campo]=$valor;
   echo "\$usuariop[$campo] => $valor.\n" . "</br>";
}

//si usurio es tipo_usuario=1 obtener que depto y div

if ($usuario['tipo_usuario']==1){
	
	//obtener el departamento 
	
   $querydepto="SELECT DISTINCT l.id_dep from laboratorios l
                JOIN usuarios u
				ON l.id_responsable=u.id_usuario
                where l.id_responsable=" .$usuario['id_usuario'];
   $datosdepto=pg_query($con,$querydepto);

   $depto = pg_fetch_array($datosdepto);
   $_SESSION['id_dep']=$depto[0];
   
   //obtener division
   $querydiv="SELECT DISTINCT dv.id_div from laboratorios l 
               JOIN departamentos d
               ON l.id_dep=d.id_dep
               JOIN divisiones dv
               ON dv.id_div=d.id_div
               JOIN usuarios u
		       ON l.id_responsable=u.id_usuario
               WHERE l.id_responsable=" .$usuario['id_usuario'];
   $datosdiv=pg_query($con,$querydiv);

   $div = pg_fetch_array($datosdiv);
   $_SESSION['id_div']=$div[0];
}



// //////////////////////////////////Graba en el log/////////////////////////////

$logger->putLog(1,1);

/*$strquery="INSERT INTO log (ip,id_user,fecha,modulo,funcion) VALUES ('%s',%d,'%s',%d,%d)";
$queryn=sprintf($strquery,$_SERVER['REMOTE_ADDR'],$_SESSION['id_usuario'],date("Y-m-d H:i:s"),1,1);
echo $queryn;
$result=@pg_query($con,$queryn) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());*/

//$log = pg_fetch_array($result, NULL, PGSQL_ASSOC);
//print_r($log);

///////////////////////////////////////////////////////////////////////////////////////////////


pg_close($con);
$textoheader="location:../view/inicio.html.php?mod=def&log=si&id_usuario=". $usuario['id_usuario'];
echo $textoheader;
header($textoheader);



}else{
   	     
   	     session_destroy();
   	     pg_close($con);
		 $direccion='location:../?log=no&usr='.$login;
	     header($direccion);
   	     
   	     }

/*
if($datosf=mysql_fetch_array($datos)){
//echo 'Bienvenidos ' . $datosf['nombre'] . " " .$datosf['apaterno']. " " .$datosf['amaterno']; 
		$_SESSION['id_usuario']=$datosf['id_usuario'];
		$_SESSION['nombre']=$datosf['nombre'];
		$_SESSION['apaterno']=$datosf['apaterno'];
		$_SESSION['amaterno']=$datosf['amaterno'];
		$_SESSION['res']=1;
		$_SESSION['usuario']=$datosf['ususario'];
		
		
		$txtheader='Location: inicio.php?m=' . trim($m);
		header($txtheader);


}else { 
		$txtheader='Location: login.php?err=1&m='. trim($m);
		//header($txtheader);
		//echo "La consulta: " . $query . "</br>";
		}

mysql_close($conexion);*/


/* ---------------------   termina validacion por bd--------------*/


/*---------------  pruebas de acceso  ---------- */
/*if($login=='rlaboratorio' && $password=='12345'){
	header("location:../view/inicio.html.php?m=res");
}else{*/
?>
<!-- <script type="text/javascript">
alert("Usuario o password incorrecto, \n intente nuevamente");
</script>-->
<?php
	 /*$direccion='location:../?log=no&usr='.$login;
//	 header($direccion);
	 }*/
?>

