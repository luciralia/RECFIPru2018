<?php 

//require('encabezado.inc.php'); 

$mod=$_GET['mod']; 
echo "el modulo es: " . $mod;
switch ($mod){

/*case "def":
	/*echo "entre aqui";
	header("location:../view/inicio.html.php?mod=def");
	break;*/

case "ced":
	header("location:../view/cedula.html.php?mod=ced");
	echo "no redireccione";
	break;
case "eq":

case "man":

case "bit":

default:
echo "me fui hasta aca";
//header("location:../view/inicio.html.php?mod=def");
break;
}






?>