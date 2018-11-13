<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script language="JavaScript">
function CambiarFormulario(){
	switch(document.forms[0].LISTA.selectedIndex){
		case 0: 
			document.forms[0].Texto1.disabled=false;
			document.forms[0].Texto2.disabled=false;	
			document.forms[0].Texto3.disabled=false;
			break;
		case 1: 
			document.forms[0].Texto1.disabled=false;
			document.forms[0].Texto2.disabled=true;	
			document.forms[0].Texto3.disabled=false;
			break;
		case 2: 
			document.forms[0].Texto1.disabled=true;
			document.forms[0].Texto2.disabled=false;	
			document.forms[0].Texto3.disabled=true;
			break;
	}
}

</script>

<body  onLoad="CambiarFormulario();">
<form name="form1" method="post" action="">
  <p>Seleccion: 
    <select name="LISTA" id="LISTA" onChange="CambiarFormulario()">
      <option selected>Opcion 1</option>
      <option>Opcion 2</option>
      <option>Opcion 3</option>
    </select>
  </p>
  <p>Texto1 
    <input name="Texto1" type="text" id="Texto1">
    <br>
    Texto2 
    <input name="Texto2" type="text" id="Texto2">
    <br>
    Texto3 
    <input name="Texto3" type="text" id="Texto3">
  </p>
</form>
</body>
</html>