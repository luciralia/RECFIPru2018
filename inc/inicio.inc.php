<?php require_once('../clases/laboratorios.class.php');
$responsable=new laboratorios();?>
<tr>
   <td><div style="text-align:center;"><h3>Registro de Equipos de C&oacute;mputo de la Facultad de Ingenier&iacute;a (RECFI)</h3></div></td>
</tr>
<tr>
<td><div style="text-align:center;"> <?php //print_r($_SESSION['permisos']); echo '</br>Permisos' . $_SESSION['permisos']['2']; ?></div></td>
</tr>
<tr>
<td><div style="text-align:center;"> <?php  echo "<h2>" . $responsable->getResponsable($_SESSION['id_usuario']) . "</h2>"; ?></div></td>
</tr>
<tr>
<td><div style="text-align:center;"> <?php require('../inc/cargausr.inc.php'); //print_r($usuario);?></div></td>
</tr>
<tr>
<?php if (!isset($_GET['lab']) && !isset($_GET['div'])){ ?>
<td><div style="text-align:center;" id="resaltado"> En el men&uacute; Documentos se encuentra una Gu&iacute;a r&aacute;pida para utilizar RECFI</div></td>
	<?php } ?>
</tr>