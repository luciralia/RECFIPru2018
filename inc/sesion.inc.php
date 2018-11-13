<?php 
session_start(); 
//echo "la sesion es: " . $_SESSION['id_usuario'];
if(!isset($_SESSION['id_usuario'])){
header("Location:../");
}else{
$mod=$_GET['mod'];
//$txtheader="location:../view/inicio.html.php?mod=".$mod;
$txtheader="location:../view/inicio.html.php?mod=".$mod;
//echo 'de sesion.inc: </br>'.$txtheader;
//header($txtheader);

}


?>