<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>md5 generator</title>
</head>

<body>


<form action="generar_md5.php" method="post" name="formulariog">

<input name="md5" type="text" size="35" maxlength="15" />

<input name="generar" type="submit" value="generar" />
</form>

<?php  

if(isset($_POST['md5'])){  
print_r($_POST);

	$contra=md5($_POST['md5']);
	echo "</br></br>contraseña es: " . $contra;

} 


?>





</body>
</html>