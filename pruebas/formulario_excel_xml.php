<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="../lib/tigra_calendar2/tcal.css" />
<script type="text/javascript" src="../lib/tigra_calendar2/tcal.js"></script> 

</head>

<body>

<form action="excel_xml.php" method="post" target="_blank">
  <p>
    <input name="fecha" type="text" size="10" maxlength="10" class='tcal'/>
    Fecha</p>
  <p>
    <label>
      <input type="text" name="equipo" id="equipo" accesskey="2" tabindex="2" />
      equipo</label>
  </p>
  <p>
    <label>
      <input type="text" name="inventario" id="inventario" accesskey="6" tabindex="6" />
      No. de Inventario</label>
  </p>
  <p>
    <label>
      <input type="text" name="detecto" id="detecto" accesskey="4" tabindex="4" />
      Cómo se detectó</label>
  </p>
  <p>
    <label>
      <input type="text" name="falla" id="falla" accesskey="3" tabindex="3" />
      Falla</label>
  </p>
  <p>
    
  <input type="submit" name="excel" id="excel" value="Enviar" accesskey="5" tabindex="5" />
    
  </p>
</form>

</body>
</html>