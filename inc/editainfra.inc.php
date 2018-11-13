<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php  
require_once('../clases/cotiza.class.php');
require_once('../clases/requerimientos.class.php');
require_once('../clases/inventario.class.php');
require_once('../clases/infra.class.php');
$combocot = new Cotiza();
$motivo = new Requerimiento();
$obj_inv = new Inventario();
$obj_infra = new Infra();

if ($_REQUEST['accion']=='nuevo'){  


//print_r($_REQUEST);

if ($_GET['mod']=='serv') {
	$tiposerv='FALSE';} elseif ($_GET['mod']=='servi'){
	$tiposerv='TRUE';}

?>
<div class=formulario>
<form action="../inc/procesainfra.inc.php" method="post" name="form_nuevo">
<table cellpadding="2" class="formulario">
  <tr>
    <td width="480" align="right" >Tipo de mantenimiento</td>
    <td colspan="2" ><div class="recuadro">
      <p>
        <label>
          <input name="tipo" type="radio" id="tipo_mant_0" value="p" checked="checked" />
          Preventivo</label>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo" value="c" id="tipo_mant_1" />
          Correctivo</label>
          &nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo" value="n" id="tipo_mant_1" />
          Adecuación</label>
        <br />
      </p>
    </div></td>
  </tr>
  <!--<tr>
    <td align="right">Equipo</td>
    <td colspan="2"><?php $obj_inv->cmbEquipo($_REQUEST['lab'],$_POST['bn_id']);?></td>
  </tr> -->


	<tr>
	  <td align="right">Servicio de:</td>
	  <td colspan="2">

<?php $obj_infra->cmbServicio($_POST['id_servicio']); ?>
          
      </td>
	  </tr>
	<!--<tr>
    <td align="right">Costo presupuestado</td>
    <td colspan="2"><input name="cto_unitario" type="text" id="cto_unitario" tabindex="2" size="9" maxlength="11" /></td>
  </tr> -->

  <tr>

    <td align="right">Descripción y detalle del servicio</td>
    <td colspan="2"><input name="descripcion" type="text" id="descripcion" tabindex="3" size="100" maxlength="200" /></td>
  </tr>
  <!--<tr>
    <td align="right">Cotización</td>
    <td colspan="2"><?php $combocot->cmbCotiza($_REQUEST['lab'],'sm',$_REQUEST['id_cotizacion']); ?></td>
  </tr> -->
  <tr>
    <td align="right">Periodo para realizar el mantenimiento</td>
    <td width="217">Inicio: 
<!--      <input name="fecha_inicio" type="text" id="fecha_salida" value="<?php echo date("Y-m-d", strtotime($_POST['fecha_inicio'])); ?>" size="10" maxlength="10" class="tcal"/></td> -->
      <input name="fecha_inicio" type="text" id="fecha_salida" value="<?php echo date("d-m-Y"); ?>" size="10" maxlength="10" class="tcal"/></td>
    <td width="634">Término:
<!--      <input name="fecha_termino" type="text" id="fecha_recepcion" value="<?php echo date("Y-m-d", strtotime($_POST['fecha_termino'])); ?>" size="10" maxlength="10" class="tcal"/> -->
      <input name="fecha_termino" type="text" id="fecha_recepcion" value="<?php echo date("d-m-Y"); ?>" size="10" maxlength="10" class="tcal"/></td>
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


<input name="serv" type="hidden" value="<?php echo $_POST['id_servicio']; ?>" />
<input name="tipo_serv" type="hidden" value="<?php echo $tiposerv; ?>" />

</form>
</div>
<?php 	} else {


//print_r($_POST);?>

<?php 	
		$tipomantp=($_POST['tipo']=='p')?' checked="checked"':'';
	 	$tipomantc=($_POST['tipo']=='c')?' checked="checked"':'';
		$tipomantn=($_POST['tipo']=='n')?' checked="checked"':'';

		

?>

<form action="../inc/procesainfra.inc.php" method="post" name="form_nuevo">
<table cellpadding="2" class="formulario">
  <tr>
    <td width="480" align="right" >Tipo de mantenimiento</td>
    <td colspan="2" ><div class="recuadro">
      <p>
        <label>
          <input name="tipo" type="radio" id="tipo_mant_0" value="p" <?php echo $tipomantp ?> />
          Preventivo</label>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo" value="c" id="tipo_mant_1" <?php echo $tipomantc ?>/>
          Correctivo</label>
          &nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo" value="n" id="tipo_mant_1" <?php echo $tipomantn ?>/>
          Adecuación</label>
        <br />
      </p>
    </div></td>
  </tr>
  <!--<tr>
    <td align="right">Equipo</td>
    <td colspan="2"><?php $obj_inv->cmbEquipo($_REQUEST['lab'],$_POST['bn_id']);?></td>
  </tr> -->


	<tr>
	  <td align="right">Servicio de:</td>
	  <td colspan="2">

<?php $obj_infra->cmbServicio($_POST['id_servicio']); ?>
          
      </td>
	  </tr>
	<!--<tr>
    <td align="right">Costo presupuestado</td>
    <td colspan="2"><input name="cto_unitario" type="text" id="cto_unitario" tabindex="2" size="9" maxlength="11" /></td>
  </tr> -->

  <tr>

    <td align="right">Descripción y detalle del servicio</td>
    <td colspan="2"><input name="descripcion" type="text" id="descripcion" tabindex="3" size="100" maxlength="200" value="<?php echo $_POST['descripcion'] ?>"/></td>
  </tr>

  <tr>
    <td align="right">Periodo para realizar el mantenimiento</td>
    <td width="217">Inicio: 
      <input name="fecha_inicio" type="text" id="fecha_salida" value="<?php echo date("d-m-Y", strtotime($_POST['fecha_inicio'])); ?>" size="10" maxlength="10" class="tcal"/></td>
    <td width="634">Término:
      <input name="fecha_termino" type="text" id="fecha_recepcion" value="<?php echo date("d-m-Y", strtotime($_POST['fecha_termino'])); ?>" size="10" maxlength="10" class="tcal"/></td>
  </tr>
<?php  if ($_GET['mod']!='servi'){ ?>

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


<input name="id_infra" type="hidden" value="<?php echo $_POST['id_infra']; ?>" />
<!--<input name="tipo" type="hidden" value="<?php echo $_POST['tipo']; ?>" /> -->



</form>
<?php 

	}?>