<HEAD>
 <meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
</HEAD>
<?php

include_once 'c:/xampp/php/mpdf60/mpdf.php';
$mpdf = new mPDF('R','A4', 11,'Arial');
$mpdf -> SetTitle('Ejemplo de generación de PDF'); 

$mpdf -> WriteHTML('<table>');
$mpdf -> WriteHTML('<p>Aquí puedes poner todas las etiquetas HTML <br>que mpdf te permite utilizar.</p>');
//$mpdf -> WriteHTML('<tr><td>Aquí puedes poner todas las etiquetas HTML </td><td>que mpdf te permite utilizar.</td></tr>');

$mpdf -> WriteHTML('</table>');

$mpdf -> Output('NombreDeTuArchivo.pdf', 'I');
exit;
?>


