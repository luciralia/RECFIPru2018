<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php  
require_once('../inc/cargausr.inc.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/requerimientos.class.php');

$combocot = new Cotiza();
$motivo = new Requerimiento();

if ($_REQUEST['editardp']=='Editar'){  
//print_r($usuario);
?>
<div class="formulario">
<h4>Datos personales del responsable</h4><br />
<form action="../inc/procesaced.inc.php" method="post" name="form_edita">
<table cellpadding="2" class="formulario">
  <tr>
    <td width="151" align="right" >Nombre:</td>
    <td width="857" ><input name="nombre" type="text" id="nombre" tabindex="1" size="50" value="<?php echo $usuario['nombre']; ?>"></td>
  </tr>
  <tr>
    <td align="right">Apellido Paterno:</td>
    <td><input name="a_paterno" type="text" id="a_paterno" tabindex="2" size="50" value="<?php echo $usuario['a_paterno']; ?>"/></td>
  </tr>
  <tr>
    <td align="right">Apellido Materno</td>
    <td><input name="a_materno" type="text" id="a_materno" tabindex="3" size="50" value="<?php echo $usuario['a_materno']; ?>"/></td>
  </tr>
  <tr>
    <td align="right">Correo Electrónico</td>
    <td><input name="email" type="text" id="email" tabindex="4" size="50" value="<?php echo $usuario['email']; ?>"/></td>
    </tr>
  <tr>
    <td align="right">Teléfono 1</td>
    <td><input name="tel1" type="text" id="tel1" tabindex="5" value="<?php echo $usuario['tel1']; ?>" size="10" maxlength="10"/></td>
  </tr>
  <tr>
    <td align="right">Teléfono 2:</td>
    <td><input name="tel2" type="text" id="tel2" tabindex="5" value="<?php echo $usuario['tel2']; ?>" size="10" maxlength="10"/></td>
  </tr>
  <tr>
    <td align="right">Extensión</td>
    <td><input name="ext" type="text" id="ext" tabindex="8" size="7" maxlength="7" value="<?php echo $usuario['ext']; ?>"/></td>
  </tr>
  <tr>
    <td colspan="2" align="right">
    <input type="submit" name="accionu" value="Guardar" />
	<input type="submit" name="accionu" value="Cancelar" /></td>
    </tr>
</table>
<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="id_usuario" type="hidden" value="<?php echo $usuario['id_usuario']; ?>" />


</form>
</div>
<?php 	} else {

echo "Edicion de registro de material </br>";
print_r($_POST);?>


<?php 

	}?>