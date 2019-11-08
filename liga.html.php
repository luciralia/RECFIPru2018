<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Otra liga</title>
</head>
<?php 
 
 $logger->putLog(1,1,'Prueba');
 
$strquery="INSERT INTO log (ip,id_user,fecha,modulo,funcion,nomb_arch) VALUES ('%s',%d,'%s',%d,%d,'%s')";
$queryn=sprintf($strquery,$_SERVER['REMOTE_ADDR'],$_SESSION['id_usuario'],date("Y-m-d H:i:s"),1,1,'Prueba');
echo $queryn;
$result=@pg_query($con,$queryn) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


 ?>
 





<body>
</body>
</html>
