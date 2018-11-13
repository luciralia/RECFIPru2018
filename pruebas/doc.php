<?php
$html = "<p>Aquí puedes poner todas las etiquetas HTML <br>que mpdf te permite utilizar.</p>
<tr><td>Aquí puedes poner todas las etiquetas HTML </td><td>que mpdf te permite utilizar.</td></tr>";
$tituloPdf="prueba.pdf";
 include 'c:/xampp/php/mpdf60/mpdf.php';
    $mpdf = new mPDF('c','A4','','',20,20,20,20,16,13);
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->setFooter('{PAGENO}');
   // $stylesheet = file_get_contents('style.css');
    $mpdf->WriteHTML($stylesheet,1);
    $mpdf->WriteHTML($html,2);
    $mpdf->Output($tituloPdf,'F');
    $fileAttach = $mpdf->Output('', 'S');
	
	?>