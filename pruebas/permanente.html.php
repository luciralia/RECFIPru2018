<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prueba habilitador</title>


</head>

<body>



<script type="text/javascript">


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