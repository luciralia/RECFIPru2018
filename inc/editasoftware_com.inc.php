<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	 
<?php  
require_once('../clases/inventario.class.php');

$software = new Inventario();
$radial = new inventario();

 print_r($_POST);

if ($_REQUEST['accion']=='nuevo'){  

?>
<br>
<br>
<div class=formulario>
	
<form action="../inc/procesasoft.inc.php" method="post"  enctype="multipart/form-data" name="form_nuevo" class="formul">
<table cellpadding="2" class="formulario">
  <tr>
       <td align="right">Tipo de software</td>
       <td ><?php  $software->cmbsoftware($_POST['id_tipo_soft']); ?></td>
  </tr>
  <tr>
      <td width="151" align="right" >Proveedor</td>
      <td colspan="3"><input name="proveedor" type="text" id="proveedor" tabindex="8" size="50" 
      maxlength="55"/></td>
  </tr>
  
  <tr>
  	<td width="151" align="right"><font color="blue">Licencia</font></td>
        <td ><font color="blue"><?php $radial->radialsoflic($_POST['licencia'])?></font></td>
        <td colspan="1">&nbsp;</td>
  </tr>
  <tr>
  	<td><label>Fecha adquisición</label></td>
         <td><label><input name="fecha_adq" type="date" id="fecha_factura" step="1" min="01-01-2000" max="31-12-2040"  value="<?php echo $_POST['fecha_adq']; ?>"   ></label> </td>
  </tr>
  <tr>
      <td width="151" align="right" >Nombre responsable</td>
      <td colspan="3"><input name="pila_respons" type="text" id="pila_respons" tabindex="8" size="25" 
      maxlength="30"/></td>
  </tr>
   <tr>
      <td width="151" align="right" >Paterno responsable</td>
      <td colspan="3"><input name="pat_respons" type="text" id="pat_respons" tabindex="8" size="25" 
      maxlength="30"/></td>
  </tr>
  <tr>
      <td width="151" align="right" >Materno responsable</td>
      <td colspan="3"><input name="mat_respons" type="text" id="mat_respons" tabindex="8" size="25" 
      maxlength="30"/></td>
  </tr>
  
  <tr>
    <td colspan="4" align="right">
    <input type="submit" name="accionn" value="Guardar" />
    <input type="reset" name="accionn"  value="Limpiar" />
	<input type="submit" name="accionn" value="Cancelar" /></td>
    </tr>
</table>
<br>
<br>
<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="div" type="hidden" value="<?php echo $_GET['div']; ?>" />

</form>
</div>
<?php 	} else {

//echo "Edicion de registro de material </br>";
//print_r($_POST);?>
<br>
<br>
<div class=formulario>
	
<form action="../inc/procesasoft.inc.php" method="post"  enctype="multipart/form-data" name="form_nuevo" class="formul">
<table cellpadding="2" class="formulario">
<tr>
       <td align="right">Tipo de software</td>
      <td ><?php  $software->cmbsoftware($_POST['id_tipo_soft']); ?></td>
  </tr>
 
  <tr>
    <td width="151" align="right" >Proveedor</td>
    <td width="857" colspan="3" ><input name="proveedor" type="text" id="proveedor" tabindex="1" size="50" value="<?php echo $_POST['proveedor']; ?>"></td>
  </tr>
  <tr>
        <td width="151" align="right"><font color="blue">Licencia</font></td>
        <td ><font color="blue"><?php  $radial->radialsoflic($_POST['licencia'])?></font></td>
        <td colspan="1">&nbsp;</td>
	</tr>      
 
   <tr>
  	<td><label>Fecha adquisición</label></td>
         <td><label><input name="fecha_adq" type="date" id="fecha_factura" step="1" min="01-01-2000" max="31-12-2040"  value="<?php echo $_POST['fecha_adq']; ?>"   ></label> </td>
  </tr>
   <tr>
    <td width="151" align="right" >Nombre responsable</td>
    <td width="857" colspan="3" ><input name="pila_respons" type="text" id="pila_respons" tabindex="1" size="50" value="<?php echo $_POST['pila_respons']; ?>"></td>
  </tr>
  <tr>
    <td width="151" align="right" >Paterno responsable</td>
    <td width="857" colspan="3" ><input name="pat_respons" type="text" id="pat_respons" tabindex="1" size="50" value="<?php echo $_POST['pat_respons']; ?>"></td>
  </tr>
  <tr>
    <td width="151" align="right" >Materno responsable</td>
    <td width="857" colspan="3" ><input name="mat_respons" type="text" id="mat_respons" tabindex="1" size="50" value="<?php echo $_POST['mat_respons']; ?>"></td>
  </tr>
  <tr>
  
      <td align="right">Descripción</td>
      <td><textarea name="descripcion" id="descripcion" rows="10" cols="40"><?php echo $_POST['descripcion']?></textarea></td>
   
    
  </tr>
 
 
  
   
  <tr>
    <td colspan="4" align="right">
    <input type="submit" name="accionm" value="Guardar" />
    <input type="reset" name="accionm"  value="Limpiar" />
	<input type="submit" name="accionm" value="Cancelar" /></td>
    </tr>
</table>
<br>
<br>

<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="id_nec" type="hidden" value="<?php echo $_POST['id_nec']; ?>" />
<input name="ref" type="hidden" value="<?php echo $_POST['ref']; ?>" />
<input name="div" type="hidden" value="<?php echo $_GET['div']; ?>" />
<input name ="ruta_evidencia" type="hidden" value="<?php echo $_POST['ruta_evidencia']; ?>" />
</form>
</div>
<?php 

	}?>