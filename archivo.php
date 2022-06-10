
<?php
	
$nombre=$_FILES['file']['name'];
$tipo=$_FILES['file']['type'];
$tamanio= $_FILES['file']['size'];
$ruta= $_FILES['file']['tmp_name'];
$destivo = 'C:/xampp/htdocs/RECFIPru2018/cotizaciones/'.$nombre;
	
if (move_uploaded_file($ruta, $destino )){
	echo 'Se subio con exito';
}else{
	echo 'Errores al subir';
}
echo 'Mas informacióon de depuración';
print_r($_FILES);


?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>

<div style="width:500px;margin: auto;border: 1px solid blue;padding: 30px;"></div>
     <h4>Subir PDF</h4>
     <form method="post" action="" enctype="multipart/form-data">
     	<table>
     		<tr>
     			<td><label>Titulo</label></td>
				<td><input type="text" name="titulo"></td>
    		</tr>
    		<tr>
     			<td><label>Descripcion/label></td>
				<td><textarea name ="despcrpcion"></textarea></td>
    		</tr>
    		<tr>
    		  <td><label for="file">Archivo (.pdf):</label>
          <input type="file" name="file" id="file"/></td>
    			<td><input type="submit" value="subir"></td>
    			
    		</tr>
    		
     	</table>
     	
     </form>
	</div>
	
</body>
</html>
