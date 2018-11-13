<?php
session_start();
require_once('../conexion.php');

//$login=$_POST['login'];
//$password=md5($_POST['pwd']);

$login='rlaboratorio';
$password=md5('12345');



$query = "SELECT * FROM usuarios WHERE usuario = '" . $login . "' AND  password='" . $password."'";
//$query = sprintf("SELECT * FROM usuarios WHERE usuario = '%s' AND pass='%s'", trim($_POST['usuario']), trim($_POST['pwd']));

$datos=pg_query($con, $query);
$nreng = pg_num_rows($datos);


if ($nreng==1){

/*	 while ($usuario = pg_fetch_array($datos)) 
	 { 
	      echo "</br> Bienvenido: ".$usuario['nombre']." ".$usuario['a_paterno']." ".$usuario['a_materno']; 

		$_SESSION['id_usuario']=$usuario['id_usuario'];
		$_SESSION['tipo_usuario']=$usuario['tipo_usuario'];
		
		$textoheader="location:../view/inicio.html.php?mod=def&log=si&id_usuario=". $usuario['id_usuario'];
	 }*/

$usuario = pg_fetch_array($datos, NULL, PGSQL_ASSOC);
foreach ($usuario as $campo => $valor) {
    echo "\$usuario[$campo] => $valor.\n" . "</br>";
$_SESSION[$campo]=$valor;
}
$textoheader="location:../view/inicio.html.php?mod=def&log=si&id_usuario=". $usuario['id_usuario'];
echo "textoheader" . $textoheader;
//	header($textoheader);
print_r ($_SESSION);

$query2="Select * from permisos where id_usuario=" . $usuario['id_usuario'];
$datosp=pg_query($con,$query2);
$usuariop = pg_fetch_array($datosp, NULL, PGSQL_ASSOC);
foreach ($usuariop as $campo => $valor) {
$_SESSION['permisos'][$campo]=$valor;
    echo "\$usuariop[$campo] => $valor.\n" . "</br>";
}
print_r ($_SESSION['permisos']);


}else{
   	     
   	     session_destroy();
   	     $direccion='location:../?log=no&usr='.$login;
	     //header($direccion);
   	     
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

