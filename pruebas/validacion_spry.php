<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="validacion_spry.php" method="post" name="form1">
<span id="cant">
    <input name="nombre" type="text" id="nombre" size="3"/>
    <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldMaxCharsMsg">Se ha superado el número máximo de caracteres.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span>
</span>
  <p><span id="costo">
  <input name="cantidad" type="text" id="cantidad" maxlength="9"  />
  <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldMaxCharsMsg">Se ha superado el número máximo de caracteres.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span><span class="textfieldMaxValueMsg">El valor introducido es superior al máximo permitido.</span></span></p>
  <p>
  <script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("cant", "integer", {maxChars:4, validateOn:["change"]});
//-->
  </script>
    
  <input name="Enviar" type="button" value="guardar" />
  </p>
  <p>
    <input name="Docencia" type="checkbox" id="Docencia" value="si" checked="checked" />
  </p>

Pueque <input type="checkbox" disabled="disabled" checked="checked"/>&nbsp;Docencia&nbsp;&nbsp;&nbsp;

</form>
<script type="text/javascript">
<!--
var sprytextfield2 = new Spry.Widget.ValidationTextField("costo", "real", {validateOn:["change"], maxValue:999999.99});
//-->
</script>
</body>
</html>