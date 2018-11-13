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
<form action="../inc/procesaserv.inc.php" method="post" name="form_nuevo">
<table cellpadding="2" class="formulario">
  <tr>
    <td width="480" align="right" >Tipo de mantenimiento</td>
    <td colspan="2" ><div class="recuadro">
      <p>
        <label>
          <input name="tipo_servinf" type="radio" id="tipo_mant_0" value="P" checked="checked" />
          Preventivo</label>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo_servinf" value="C" id="tipo_mant_1" />
          Correctivo</label>
          &nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo_servinf" value="C" id="tipo_mant_1" />
          Adecuación</label>
        <br />
      </p>
    </div></td>
  </tr>
  <!--<tr>
    <td align="right">Equipo</td>
    <td colspan="2"><?php $obj_inv->cmbEquipo($_REQUEST['lab'],$_POST['bn_id']);?></td>
  </tr> -->
<?php  if ($_GET['mod']!='servi'){ ?>

	<tr>
	  <td align="right">Servicio de:</td>
	  <td colspan="2">
                              <select name="servicio" id="servicio">
                          <option value="0" selected="selected">Seleccione...</option>
                          <option value="1">Albañilería</option>
                          <option value="2">Cerrajería</option>
                          <option value="3">Carpintería</option>
                          <option value="4">Electricidad</option>
                          <option value="5">Pintura</option>
                          <option value="6">Herrería</option>
                          <option value="7">Aire acondicionado</option>
                          <option value="8">Cortinas y persianas</option>
                          <option value="9">Plomería</option>
                          <option value="10">Impermeabilización</option>
                          <option value="11">Limpieza de techos</option>
                          <option value="12">Desazolve de bajada de agua</option>
                          <option value="13">Otro...</option>
                        </select>
           
      </td>
	  </tr>
	<!--<tr>
    <td align="right">Costo presupuestado</td>
    <td colspan="2"><input name="cto_unitario" type="text" id="cto_unitario" tabindex="2" size="9" maxlength="11" /></td>
  </tr> -->
<?php }?>
  <tr>

    <td align="right">Descripción y detalle del servicio</td>
    <td colspan="2"><input name="tipo_falla" type="text" id="descripcion" tabindex="3" size="100" maxlength="200" /></td>
  </tr>
  <!--<tr>
    <td align="right">Cotización</td>
    <td colspan="2"><?php $combocot->cmbCotiza($_REQUEST['lab'],'sm',$_REQUEST['id_cotizacion']); ?></td>
  </tr> -->
  <tr>
    <td align="right">Periodo para realizar el mantenimiento</td>
    <td width="217">Inicio: 
      <input name="fecha_salida" type="text" id="fecha_salida" value="<?php echo date("Y-m-d", strtotime($_POST['fsalida'])); ?>" size="10" maxlength="10" /></td>
    <td width="634">Término:
      <input name="fecha_recepcion" type="text" id="fecha_recepcion" value="<?php echo date("Y-m-d", strtotime($_POST['frecepcion'])); ?>" size="10" maxlength="10" /></td>
  </tr>
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


<input name="fecha" type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" />
<input name="garantia" type="hidden" value="FALSE" />
<input name="id_evento" type="hidden" value="<?php echo $_POST['id_evento']; ?>" />
<input name="tipo_serv" type="hidden" value="<?php echo $tiposerv; ?>" />

</form>
</div>
<?php 	} else {


//print_r($_POST);?>

<?php 	
		$tipomantp=($_POST['tipo']=='P')?' checked="checked"':'';
	 	$tipomantc=($_POST['tipo']=='C')?' checked="checked"':'';
		$ensitiot=($_POST['sitio']=='t')?' checked="checked"':'';
		$ensitiof=($_POST['sitio']=='f')?' checked="checked"':'';
		

?>

<form action="../inc/procesaserv.inc.php" method="post" name="form_edita">
<table cellpadding="2" class="formulario">
  <tr>
    <td width="230" align="right" >Tipo de mantenimiento</td>
    <td colspan="2" ><div class="recuadro">
      <p>
        <label>
          
          <input name="tipo_mant" type="radio" id="tipo_mant_0" value="P" <?php echo $tipomantp; ?>/>
          Preventivo</label>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo_mant"  id="tipo_mant_1" value="C" <?php echo $tipomantc; ?>/>
          Correctivo</label>
        <br />
      </p>
    </div></td>
  </tr>
  <tr>
    <td align="right">Equipo</td>
    <td colspan="2"><?php $obj_inv->cmbEquipo($_REQUEST['lab'],$_POST['bn_id']);?></td>
  </tr>
  <tr>
    <td align="right">Costo presupuestado</td>
    <td colspan="2"><input name="cto_unitario" type="text" id="cto_unitario" tabindex="2" value="<?php echo $_POST['costo']; ?>" size="9" maxlength="11" /></td>
  </tr>
  <tr>
    <td align="right">Descripción del servicio</td>
    <td colspan="2"><input name="tipo_falla" type="text" id="descripcion" tabindex="3" value="<?php echo $_POST['falla']; ?>" size="100" maxlength="200" /></td>
  </tr>
  <tr>
    <td align="right">Cotización</td>
    <td colspan="2"><?php $combocot->cmbCotiza($_REQUEST['lab'],'sm',$_REQUEST['id_cotizacion']); ?></td>
  </tr>
  <tr>
    <td align="right">Periodo para realizar el mantenimiento</td>
    <td width="217">Inicio: 
      <input name="fecha_salida" type="text" id="fecha_salida" value="<?php echo date("Y-m-d", strtotime($_POST['fsalida'])); ?>" size="10" maxlength="10" /></td>
    <td width="634">Término:
      <input name="fecha_recepcion" type="text" id="fecha_recepcion" value="<?php echo date("Y-m-d", strtotime($_POST['frecepcion'])); ?>" size="10" maxlength="10" /></td>
  </tr>
  <tr>
    <td colspan="3"><div class="recuadro">
      <p>¿El servicio de mantenimiento debe ser realizado en sitio? </p>
      <p>
        <label><input name="ok" type="radio" id="tipo_mant_2" value="TRUE" <?php echo $ensitiot; ?>/>Sí</label>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <label><input name="ok" type="radio"  value="FALSE" id="tipo_mant_3" <?php echo $ensitiof; ?>/>No</label>
      </p>
    </div></td>
    </tr>
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
<input name="id_evento" type="hidden" value="<?php echo $_POST['id_evento']; ?>" />

</form>
<?php 

	}?>