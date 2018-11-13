<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prueba habilitador</title>


</head>

<body>


<form action="generar_md5.php" method="post" name="formulariog">

<input name="md5" type="text" size="35" maxlength="15" />

<input name="generar" type="submit" value="generar" />

<input type="date" />

</form>

<?php  

if(isset($_POST['md5'])){  
print_r($_POST);

	$contra=md5($_POST['md5']);
	echo "</br></br>contraseña es: " . $contra;

} 


?>
<form>
<select name="id_categoria" id="id_categoria" onchange="carg(this);">
      <option value="1" selected="">Clientes</option>
      <option value="2">Empresas</option>
      <option value="3">Personas</option>
</select>

<!--<input id="input" type="text">-->

<input id="input" type="date" />


</form>



<script type="text/javascript">
var input = document.getElementById('input');

function carg(elemento) {
  d = elemento.value;
  
  if(d == "1"){
    input.disabled = true;
    date.disabled=true; 
    date2.disabled=true;
  }else{
    input.disabled = false;
    date.disabled=false; 
    date2.disabled=false;
  }
}


function palomeado(){ 
    if(perm.checked){ 
        date.disabled=true; 
	date2.disabled=true;
    }else{ 
        date.disabled=false; 
	date2.disabled=false;
    } 
} 

</script>



<!--<form>
<input type="radio" name="rad" onclick="pepe.disabled = false" />
<input type="radio" name="rad" onclick="pepe.disabled = true" />

<input type="radio" name="rad" onclick="pepe.disabled = !this.checked" />

<input type="text" name="pepe"  />
<input type="date" name="date" id="date" />
</form>-->


<form id="form1" name="form1" method="post" action="">
  <input type="checkbox" name="perm" id="perm" onchange="palomeado(this);"/>
  <label for="perm">Permanente </label>
  <label for="date">Fecha1:</label>
  <input type="date" name="date" id="date" />
  <label for="date2">Fecha2:</label>
  <input type="date" name="date2" id="date2" />
</form>


</body>
</html>