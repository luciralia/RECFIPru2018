<html>
<head><title> Ejemplo de los Eventos onChange y onBlur </title>
<script language=JavaScript>
function butCheckForm_onclick() {
   var myForm = document.form1;
   if (myForm.txtAge.value == "" || myForm.txtName.value == "") {
      alert("Complete todo el formulario, por favor");
      if (myForm.txtName.value == "") {
         myForm.txtName.focus();
      }
      else {
         myForm.txtAge.focus();
      }
   }
   else {
      alert("Gracias por rellenar el formulario " + myForm.txtName.value);
   }
}
function txtAge_onblur() {
   var txtAge = document.form1.txtAge;
   if (isNaN(txtAge.value) == true) {
      alert("Inserte una edad válida");
      txtAge.focus();
      txtAge.select();
   }
}
function txtName_onchange() {
   window.status = " Hola ;-) " + document.form1.txtName.value;
}
</script>
</head>
<body>
<FORM NAME=form1>
   Por favor, introduzca la siguiente información:
   <P>
   Nombre:
   <BR>
   <INPUT TYPE="text" NAME=txtName onchange="txtName_onchange()">
   <BR>
   Edad:
   <BR>
   <INPUT TYPE="text" NAME=txtAge onblur="txtAge_onblur()" SIZE=3 MAXLENGTH=3>
   <BR>
   <INPUT TYPE="button" VALUE="Verificar" NAME=butCheckForm 
      onclick="butCheckForm_onclick()">
</FORM>
</body>
</html>