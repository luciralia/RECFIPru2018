<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php  
require_once('../clases/cotiza.class.php');
require_once('../clases/requerimientos.class.php');
require_once('../clases/inventario.class.php');
$combocot = new Cotiza();
$motivo = new Requerimiento();
$obj_inv = new Inventario();

if ($_REQUEST['accion']=='nuevo'){  


//print_r($_REQUEST);

if ($_GET['mod']=='serv') {
	$tiposerv='FALSE';} elseif ($_GET['mod']=='servi'){
	$tiposerv='TRUE';}

?>
<div class=formulario>
<form action="../inc/procesamobi.inc.php" method="post" name="form_nuevo">
<table cellpadding="2" class="formulario">
  <tr>
    <td width="480" align="right" >Necesidad</td>
    <td colspan="2" ><div class="recuadro">
      <p>
        <label>
          <input name="tipo" type="radio" id="tipo_mant_0" value="rp" checked="checked" />
          Reparación</label>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo" value="rm" id="tipo_mant_1" />
          Remplazo</label>
          &nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo" value="am" id="tipo_mant_1" />
          Ampliación de mobiliario</label>
        <br />
      </p>
    </div></td>
  </tr>
    <tr>
      <td align="right">Cantidad</td>
      <td colspan="2"><input name="cant" type="text" id="cantidad" tabindex="2" size="2" maxlength="2" /></td>
    </tr>
    <tr>
      <td align="right">Especificaciones</td>
      <td colspan="2"><input name="especificaciones" type="text" id="especificacion" tabindex="3" size="100" maxlength="200" /></td>
    </tr>
    <tr>

    <td align="right">Justificación</td>
    <td colspan="2"><input name="justificacion" type="text" id="justificacion" tabindex="4" value="" size="100" maxlength="400" /></td>
  </tr>
  <!--<tr>
    <td align="right">Cotización</td>
    <td colspan="2"><?php $combocot->cmbCotiza($_REQUEST['lab'],'sm',$_REQUEST['id_cotizacion']); ?></td>
  </tr> -->
  <!--<tr>
    <td align="right">Periodo para realizar el mantenimiento</td>
    <td width="217">Inicio: 
      <input name="fecha_inicio" type="text" id="fecha_salida" value="<?php echo date("Y-m-d", strtotime($_POST['fecha_inico'])); ?>" size="10" maxlength="10" /></td>
    <td width="634">Término:
      <input name="fecha_termino" type="text" id="fecha_recepcion" value="<?php echo date("Y-m-d", strtotime($_POST['fecha_termino'])); ?>" size="10" maxlength="10" /></td>
  </tr> -->
<?php  if ($_GET['mod']!='servi'){ ?>
  <!--<tr>
    <td colspan="3">
    <div class="recuadro"><p>¿El servicio de mantenimiento debe ser realizado en sitio? </p>
      <p>
        <label>
          <input name="ok" type="radio" id="tipo_mant_2" value="TRUE" checked="checked" />
          Sí</label>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input name="ok" type="radio"  value="FALSE" id="tipo_mant_3" />
          No</label>
              </p>
    </div>
    </td>
  </tr> -->
<?php }?>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
      
  <tr>
    <td colspan="3" align="right">
    <input type="submit" name="accionn" value="Guardar" />
    <input type="reset" name="accionn"  value="Limpiar" />
	<input type="submit" name="accionn" value="Cancelar" /></td>
    </tr>
</table>
<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="orden" type="hidden" value="<?php echo $_GET['orden']; ?>" />


<input name="serv" type="hidden" value="<?php echo $_POST['id_servicio']; ?>" />
<input name="tipo_serv" type="hidden" value="<?php echo $tiposerv; ?>" />

</form>
</div>
<?php 	} else {


//print_r($_POST);?>

<?php 	
		$tiponecrp=($_POST['tipo']=='rp')?' checked="checked"':'';
	 	$tiponecrm=($_POST['tipo']=='rm')?' checked="checked"':'';
		$tiponecam=($_POST['tipo']=='am')?' checked="checked"':'';

		

?>

<form action="../inc/procesamobi.inc.php" method="post" name="form_edita">
<table cellpadding="2" class="formulario">
  <tr>
    <td width="480" align="right" >Necesidad</td>
    <td colspan="2" ><div class="recuadro">
      <p>
        <label>
          <input name="tipo" type="radio" id="tipo_mant_0" value="rp" <?php echo $tiponecrp; ?> />
          Reparación</label>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo" value="rm" id="tipo_mant_1" <?php echo $tiponecrm; ?>/>
          Remplazo</label>
          &nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo" value="am" id="tipo_mant_1" <?php echo $tiponecam; ?>/>
          Ampliación de mobiliario</label>
        <br />
      </p>
    </div></td>
  </tr>

    <tr>
      <td align="right">Cantidad</td>
      <td colspan="2"><input name="cant" type="text" id="cantidad" tabindex="2" size="2" maxlength="2" value="<?php echo $_POST['cant']; ?>"/></td>
    </tr>
    <tr>
      <td align="right">Especificaciones</td>
      <td colspan="2"><input name="especificaciones" type="text" id="especificacion" tabindex="3" size="100" maxlength="200" value="<?php echo $_POST['especificaciones']; ?>"/></td>
    </tr>
    <tr>

    <td align="right">Justificación</td>
    <td colspan="2"><input name="justificacion" type="text" id="justificacion" tabindex="4" size="100" maxlength="400" value="<?php echo $_POST['justificacion']; ?>"/></td>
  </tr>
  <!--<tr>
    <td align="right">Cotización</td>
    <td colspan="2"><?php $combocot->cmbCotiza($_REQUEST['lab'],'sm',$_REQUEST['id_cotizacion']); ?></td>
  </tr> -->
  <!--<tr>
    <td align="right">Periodo para realizar el mantenimiento</td>
    <td width="217">Inicio: 
      <input name="fecha_inicio" type="text" id="fecha_salida" value="<?php echo date("Y-m-d", strtotime($_POST['fecha_inico'])); ?>" size="10" maxlength="10" /></td>
    <td width="634">Término:
      <input name="fecha_termino" type="text" id="fecha_recepcion" value="<?php echo date("Y-m-d", strtotime($_POST['fecha_termino'])); ?>" size="10" maxlength="10" /></td>
  </tr> -->
<?php  if ($_GET['mod']!='servi'){ ?>
  <!--<tr>
    <td colspan="3">
    <div class="recuadro"><p>¿El servicio de mantenimiento debe ser realizado en sitio? </p>
      <p>
        <label>
          <input name="ok" type="radio" id="tipo_mant_2" value="TRUE" checked="checked" />
          Sí</label>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input name="ok" type="radio"  value="FALSE" id="tipo_mant_3" />
          No</label>
              </p>
    </div>
    </td>
  </tr> -->
<?php }?>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
      
  <tr>
    <td colspan="3" align="right">
    <input type="submit" name="accionm" value="Guardar" />
    <input type="reset" name="accionm"  value="Limpiar" />
	<input type="submit" name="accionm" value="Cancelar" /></td>
    </tr>
</table>

  <input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="orden" type="hidden" value="<?php echo $_GET['orden']; ?>" />

<input name="fecha" type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" />
<input name="garantia" type="hidden" value="FALSE" />
<input name="id_nec" type="hidden" value="<?php echo $_POST['id_nec']; ?>" />

</form>
<?php 

	}?>