<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>
<?php


include 'c:/xampp/php/mpdf60/mpdf.php';
//require_once 'c:/xampp/php/MPDF60/mpdf.php';
//include 'c:/xampp/htdocs/MPDF60/mpdf.php';

$mpdf=new mPDF();

// La variable $html es vuestro código que queréis pasar a PDF
$html = utf8_encode($html);

$mpdf-> WriteHTML($html);
$mpdf -> SetTitle('Ejemplo de generación de PDF');
$mpdf -> WriteHTML('<body>');
//$mpdf -> WriteHTML('Aquí puedes poner todas las etiquetas HTML que mpdf te permite utilizar.');
$mpdf -> WriteHTML('</body>');
// Genera el fichero y fuerza la descarga
$mpdf->Output(‘nombre.pdf’,’D’); exit;

?>

<body>
</body>
</html>