
<?php
include 'c:/xampp/php/mpdf60/mpdf.php';

$mpdf = new mpdf();
$user='dcbcacfi';
$contrasena='XYZ123';
$filename='banner_principal.jpg';
$html ='<html>
<body>

<img src="' . "../images/" . $filename . '" />

<p> Tu usuario es: '.$user. ' </p>
<p> Tu contraseña es: '.$contrasena. ' </p>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output();


?>
