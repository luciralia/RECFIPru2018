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

$logger->putLog(19,2);
 ?>
<div class="docs">
<ul><li><a href="../documentos/guia_rapida_RECFIV0909.pdf" title="Guía Rápida" target="_blank">Guía rápida del RECFI versión 0.9.0.9</a></li>
   <br /><br />
  <ul><li><a href="../documentos/GuiaImportacionV0909.pdf" title="Guía Rápida" target="_blank">Guía de importación RECFI versión 0.9.0.9</a></li>
   <br /><br />
  <li>Catálogo de Áreas</a></li>
  <br />
  <table>
  <tr><td>
              <form action="../inc/catlaboratorio.inc.php" method="post" name="form_edita" >
	          <input name="enviar" type="submit" value="Exportar a Excel" />
	          </form>
         </td></tr>
  </table>
  <br /><br />
  <li>Catálogo de Edificios</a></li>
  <br />
  <table>
  <tr><td>
              <form action="../inc/catedificio.inc.php" method="post" name="form_edita" >
	          <input name="enviar" type="submit" value="Exportar a Excel" />
	          </form>
         </td></tr>
  </table>
   <br /><br />
   <p>______________________________________________________________________________________________________________________________</p>
     <br /><br />
  <li><a href="../documentos/Reglamento_laboratorios_31072014.pdf" target="_blank">Reglamento General de uso de laboratorios y Talleres</a></li>
  <br /><br />
  <li><a href="../documentos/lineamientos_creacion_laboratorios_final.docx" target="_blank">Lineamientos para la creación  o modificación de laboratorios</a></li>
  <br /><br />
  
  
  
</ul>

</div>


