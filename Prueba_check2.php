<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>checkbox por id</title>
</head>
	
	
	
<body>
  
<form id="formulario" action="procesar_formulario.php" method="post">
    <label>
        <input type="checkbox" name="opciones[]" value="opcion1"> Opción 1
    </label><br>
    <label>
        <input type="checkbox" name="opciones[]" value="opcion2"> Opción 2
    </label><br>
    <label>
        <input type="checkbox" name="opciones[]" value="opcion3"> Opción 3
    </label><br>
    <input type="submit" name="submit" value="Generar Reporte" onclick="return validarFormulario();">
</form>
	
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado el formulario
    if (isset($_POST['submit'])) {
        // Verificar si se han seleccionado checkboxes
        if (!isset($_POST['opciones']) || !is_array($_POST['opciones']) || count($_POST['opciones']) == 0) {
            // Si no se han seleccionado checkboxes, mostrar advertencia
            echo '<script>alert("Debes seleccionar al menos una opción para generar el reporte."); history.back();</script>';
            exit; // Detener la ejecución para que no se procese el formulario vacío
        } else {
            // Procesar el formulario aquí
            // Puedes acceder a los checkboxes seleccionados usando $_POST['opciones']
            // Por ejemplo, para mostrar las opciones seleccionadas:
            echo "<p>Opciones seleccionadas:</p>";
            foreach ($_POST['opciones'] as $opcion) {
                echo "<p>$opcion</p>";
            }
        }
    }
}
?>
```
	
	
</body>
</html>