<?php
 
//establecemos el timezone para obtener la hora local
date_default_timezone_set('America/Lima');
 
//la fecha y hora de exportación sera parte del nombre del archivo Excel
$fecha = date("d-m-Y H:i:s");
 
//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte_$fecha.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");
 
echo "<table>
  <tr>
                      <th style='background:#CCC; color:#000'>
                      Nombres
                      </th>
                      <th style='background:#CCC; color:#000'>
                      Apellidos
                      </th>
                      <th style='background:#CCC; color:#000'>
                      Email
                      </th>
  </tr>
  <tr>
                      <td>
                      Jose
                      </td>
                      <td>
                      Perez
                      </td>
                      <td>
                      jose.perez@correo.com
                      </td>
  </tr>
  <tr>
                      <td>
                      Maria
                      </td>
                      <td>
                      Sanchez
                      </td>
                      <td style='background:yellow'>
                      maria.sanchez@correo.com
                      </td>
  </tr>
  <tr>
                      <td>
                      Juan
                      </td>
                      <td>
                      Lopez
                      </td>
                      <td>
                      juan.lopez@correo.com
                      </td>
  </tr>
  <tr>
                      <td>
                      Carmen
                      </td>
                      <td>
                      Gonzales
                      </td>
                      <td>
                      carmen.gonzales@correo.com
                      </td>
  </tr>
  </table>";
 
?>