<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>


<form action="generar_md5.php" method="post" name="formulariog">

<input name="md5" type="text" size="35" maxlength="15" />

<input name="generar" type="submit" value="generar" />
</form>

<p>
  <?php  

$to      = 'osvaldo.pereida@gmail.com';
$subject = 'Prueba de correo';
$message = 'Hola mundo';
$headers = 'From: caes@unam.mx' . "\r\n" .
    'Reply-To: caes@unam.mx' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers))
		echo "Se envió el correo";
	else
		echo "No se envió";


?>
  
  
  
  
  
</p>
<p>&nbsp;</p>
</body>
</html>