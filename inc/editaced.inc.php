<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php  
require_once('../inc/cargausr.inc.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/requerimientos.class.php');
require_once('../clases/laboratorios.class.php');

$combocot = new Cotiza();
$motivo = new Requerimiento();
$obj_lab = new laboratorios();

if ($_REQUEST['editarced']=='Editar'){  
echo 'editar editaced';
print_r($_SESSION);
//print_r($usuario);
?>
<div class="formulario">
<h4> Ubicación y Actividades Generales</h4><br />
<form action="../inc/procesaced.inc.php" method="post" name="form_edita">
<table width="988" cellpadding="2" class="formulario">
  <tr>
    <td width="354" align="right" >Laboratorio:</td>
    <td colspan="3" ><input name="nombre" type="text" id="nombre" tabindex="1" size="50" value="<?php echo $_POST['nombre']; ?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td align="right">Ubicación</td>
    <td width="177"><?php $obj_lab->cmbEdif($_POST['id_edif']);?></td>
    <td width="179">Detalle de ubicación:</td>
    <td width="250"><input name="detalle_ub" type="text" id="detalle_ub" value="<?php echo $_POST['detalle_ub']; ?>" size="40" /></td>
  </tr>
  <tr>
    <td align="right">Dirección postal</td>
    <td colspan="3"><input name="postal" type="text" id="a_materno" tabindex="3" size="50" value="<?php echo $_POST['postal'];?>"/></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
				<?php  if ($obj_lab->getAct($_POST['act_generales'],'doc')==2){$d='checked="checked"';}?>
                <?php  if ($obj_lab->getAct($_POST['act_generales'],'inv')==3){$i='checked="checked"';}?>
                <?php  if ($obj_lab->getAct($_POST['act_generales'],'abi')==5){$a='checked="checked"';}?>

    <td align="right">Actividades Generales:</td>
    <td><input type="checkbox" name="doc" id="doc"  value="2" <?php echo $d;?>/>
      Docencia</td>
    <td><input type="checkbox" name="inv" id="inv"  value="3" <?php echo $i;?>/>
      Investigación</td>
    <td><input type="checkbox" name="abi" id="abi"  value="5" <?php echo $a;?>/>
      Abierto</td>
  </tr>
  <tr>
    <td colspan="4" align="right"><hr /></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="3" class="name"><strong>Servicio</strong></td>
  </tr>
  <tr>
    <td align="right">Capacidad máxima de alumnos por clase:</td>
    <td colspan="3"><input name="capacidad" type="text" id="capacidad" tabindex="5" value="<?php echo $_POST['capacidad']; ?>" size="3" maxlength="3"/></td>
  </tr>
  <tr>
    <td align="right">Carreras</td>
    <td colspan="3"><textarea name="carreras" cols="70" rows="5" id="carreras2"><?php echo $_POST['carreras'] ?>
    </textarea></td>
  </tr>
  <tr>
    <td align="right">Asignaturas</td>
    <td align="left" colspan="3"><textarea name="asignaturas" cols="70" rows="5" id="carreras"><?php echo $_POST['asignaturas'] ?>
    </textarea></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right" colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="4" align="right">
    <input type="submit" name="accionc" value="Guardar" />
	<input type="submit" name="accionc" value="Cancelar" /></td>
    </tr>
</table>
<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="id_usuario" type="hidden" value="<?php echo $usuario['id_usuario']; ?>" />
<input name="id_div" type="hidden" value="<?php echo $_SESSION['id_div']; ?>" />

</form>
</div>
<?php 	} else {

echo "Edicion de registro de material </br>";
print_r($_POST);?>


<?php 

	}?>