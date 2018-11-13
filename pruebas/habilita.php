<html> 
<head> 
<script type="text/javascript"> 
function habilitar(obj) { 
  var hab; 
  frm=obj.form; 
  num=obj.selectedIndex; 
  var lista = document.getElementById("opciones");
  var vs = obj.options[obj.selectedIndex].value;
//  var vs = lista.options[lista.selectedIndex].value;
  if (vs=="tr") hab=true; 
  else if (vs=="vg") hab=false; 
  frm.sueldo.disabled=hab; 
  frm.nombre.disabled=hab; 

} 
</script> 
</head> 
<body> 
<form> 
<select onchange="habilitar(this)" name="opciones" id="opciones"> 
<option value="tr">trabaja</option> 
<option value="ntr">no trabaja</option> 
<option value="in">independiente</option> 
<option value="NI">NINI</option> 
<option value="vg"'>Vago</option> 
</select> 
<input type="text" name="sueldo" /> 
<input type="text" name="nombre" /> 
</form>
</body> 
</html>  