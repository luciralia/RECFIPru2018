<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php  
require_once('../clases/cotiza.class.php');
require_once('../clases/requerimientos.class.php');
$combocot = new Cotiza();
$motivo = new Requerimiento();

if ($_REQUEST['accion']=='nuevo'){  


//print_r($_POST);
?>
<div class=formulario>
<form action="../inc/procesaeq.inc.php" method="post" name="form_nuevo" class="formul">
<table cellpadding="2" class="formulario">
  <tr>
    <td width="151" align="right" >Cantidad</td>
    <td width="857" colspan="3" ><input name="cant" type="text" id="cant" tabindex="1" size="4"></td>
  </tr>
  <tr>
    <td align="right">Costo Unitario</td>
    <td colspan="3"><input name="cto_unitario" type="text" id="cto_unitario" tabindex="2" size="9" maxlength="11" /> 
    &nbsp;<span style="color: #900; font-size: x-small;">(El costo debe ser expresado en dólares americanos USD)</span></td>
  </tr>
  <tr>
   <td align="right">Descripción</td>
   <!--<td colspan="3"> <input name="descripcion" type="text" id="descripcion" tabindex="3" size="100" maxlength="200" /></td>-->
   <td colspan="3"> <textarea name="descripcion" id="descripcion" tabindex="3"></textarea></td>
  
   
  </tr>
  <tr>
    <td align="right">Prioridad</td>
    <td><?php $motivo->cmbPrioridad($_POST['id_prio'])?></td>
    <td align="right">Año</td>
    <td><?php $motivo->cmbPlazo($_POST['id_plazo']) ?></td>
  </tr>
  <tr>
    <td align="right">Cotización</td>
    <td colspan="3"><?php $combocot->cmbCotiza($_REQUEST['lab'],'eq',$_REQUEST['id_cotizacion']); ?></td>
  </tr>
  <tr>
    <td align="right">Motivo</td>
    <td colspan="3"><?php $motivo->cmbJustEq($_POST['num_just']) ?></td>
  </tr>
  <tr>
    <td align="right">Justificación ampliada</td>
    <!--<td colspan="3"><input name="impacto" type="text" id="impacto" tabindex="8" size="100" maxlength="400" /></td>-->
    <td colspan="3"> <textarea name="impacto" id="impacto" tabindex="8"></textarea></td>
  </tr>
  <tr>
    <td colspan="4" align="right">
    <input type="submit" name="accionn" value="Guardar" />
    <input type="reset" name="accionn"  value="Limpiar" />
	<input type="submit" name="accionn" value="Cancelar" /></td>
    </tr>
</table>
<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />

</form>
</div>
<?php 	} else {

//echo "Edicion de registro de material </br>";
//print_r($_POST);?>


<form action="../inc/procesaeq.inc.php" method="post" name="form_edita">
<table cellpadding="2" class="formulario">
  <tr>
    <td width="151" align="right" >Cantidad</td>
    <td width="857" colspan="3" ><input name="cant" type="text" id="cant" tabindex="1" size="4" value="<?php echo $_POST['cant']; ?>"></td>
  </tr>
  <tr>
    <td align="right">Costo Unitario</td>
    <td colspan="3"><input name="cto_unitario" type="text" id="cto_unitario" tabindex="2" size="9" maxlength="9" value="<?php echo $_POST['costo']; ?>"/></td>
  </tr>
  <tr>
    <td align="right">Descripción</td>
   <!-- <td colspan="3"><input name="descripcion" type="text" id="descripcion" tabindex="3" size="100" maxlength="200" value="<?php //echo $_POST['descripcion']; ?>"/></td>-->
     <td colspan="3"> <textarea name="descripcion" id="descripcion" tabindex="3" value="<?php echo $_POST['descripcion']; ?>"></textarea></td>
    
  </tr>
  <tr>
    <td align="right">Prioridad</td>
    <td><?php $motivo->cmbPrioridad($_POST['id_prio'])?></td>
    <td align="right">Año</td>
    <td><?php $motivo->cmbPlazo($_POST['id_plazo']) ?></td>
  </tr>
  <tr>
    <td align="right">Cotización</td>
    <td colspan="3"><?php $combocot->cmbCotiza($_REQUEST['lab'],'eq',$_REQUEST['id_cotizacion']); ?></td>
  </tr>
  <tr>
    <td align="right">Motivo</td>
    <td colspan="3"><?php $motivo->cmbJustEq($_POST['num_just'])    //echo "</br>" . $motivo->getJustMat($_POST['num_just'],'descripcion');?></td>
  </tr>
  <tr>
    <td align="right">Justificación ampliada</td>
   <!--<td colspan="3"><input name="impacto" type="text" id="impacto" tabindex="8" size="100" maxlength="400" value="<?php // echo $_POST['justificacion']; ?>"/></td>-->
     <td colspan="3"> <textarea name="impacto" id="impacto" tabindex="8" value="<?php echo $_POST['justificacion'];  ?>"/></textarea></td>
  </tr>
  <tr>
    <td colspan="4" align="right">
    <input type="submit" name="accionm" value="Guardar" />
    <input type="reset" name="accionm"  value="Limpiar" />
	<input type="submit" name="accionm" value="Cancelar" /></td>
    </tr>
</table>
<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="id_nec" type="hidden" value="<?php echo $_POST['id_nec']; ?>" />
<input name="ref" type="hidden" value="<?php echo $_POST['ref']; ?>" />

</form>
<?php 

	}?>