<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/requerimientos.class.php');
require_once('../clases/log.class.php');

$logger=new Log();
$obj_cotiza = new Cotiza();
$lab = new laboratorios();
$obj_req= new Requerimiento();


if ($_GET['mod']=='serv'){
$tiposerv="(em.tipo_serv IS NULL OR em.tipo_serv IS FALSE) ";
} else {$tiposerv='TRUE';
$tiposerv="em.tipo_serv IS TRUE";
}

//$logger->putLog(19,2);
 ?>


<p>Versión <strong> <?php echo VERSION ?></strong></p>
</br><p><strong>Recomendaciones para acceso óptimo</strong></p>


<p>Para garantizar un acceso &oacute;ptimo a este sistema, se recomiendan los navegadores:</p>

                          <ul>

                            <li>Internet Explorer ver. 8 </li>
                            <li>Chrome </li>

                            <li>Fireforx </li>
                            <li>Opera </li>
                            <li>Safari</li>
                          </ul>
                          <p>en esa versi&oacute;n o superior.</p>

<br /><p align="justify">Asimismo, es necesario tener activadas las opciones Javascript y CSS.</p>
<br /><p align="justify">Para visualizar los documentos en formato PDF, es necesario contar con el programa Adobe Reader que se puede descargar de la siguiente <a href="http://get.adobe.com/es/reader/" target="_blank"> liga</a>.</p>
<br /><p>La resoluci&oacute;n del monitor minima que se recomienda es de 1024 x 768.</p>


</br> <p><br>
  <strong>C r &eacute; d i t o s</strong></p>


    <br /><p><span style="color: #000000">Responsable </span></p>

                          <ul>

                            <li><strong>M.I. Abigail Serralde Ruiz</strong><br>

                              abigail<img src="../images/arroba.png" alt="arroba" width="15" height="15" align="top">ingenieria.unam.mx</li>

    </ul>


                          <br /><p><strong>Programaci&oacute;n y mantenimiento</strong></p>

                          <ul>

                            <li>Ing. Cesar Osvaldo Pereida Gómez<br>

                              pereida<img src="../images/arroba.png" alt="arroba" width="15" height="15" align="top">ingenieria.unam.mx</li>
                          </ul>
<p style="color: #FF0000">&nbsp;</p>



