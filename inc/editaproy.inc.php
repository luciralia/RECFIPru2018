
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script type="text/javascript">

function cargajust() {
		  var x = document.getElementById('id_just').value;
		 
		  if (x=="7")
		  
		      document.getElementById('otrajust').disabled = false; // habilitar
		  else
			  document.getElementById('otrajust').disabled = true; 
			    
			  // deshabilitar
			 
	 }
	
	

</script>	 
	 
<?php 

require_once('../clases/proyectos.class.php');
require_once('../clases/requerimientos.class.php');
$combonec = new proyecto();
$motivo = new Requerimiento();
$combousu= new laboratorios();

$combo= new proyecto();


echo 'valores en editaproy', print_r($_POST);
echo 'valores en editaproy', print_r($_REQUEST);
echo 'valores en editaproy',print_r($_SESSION);

if ($_REQUEST['accion']=='nuevo'){  

?>
<br>
<br>

<div class=formulario>	
<form action="../inc/procesaproy.inc.php" method="post" enctype="multipart/form-data" class="formul">
<div name="formcotiza" >	
<table cellpadding="2" class="formulario">
  <tr>
      <td width="151" align="right" >Nombre</td>
      <td colspan="3"><input name="nombre_proy" type="text" id="nombre_proy" tabindex="8" size="50" 
      maxlength="100"/></td>
  </tr>
  <tr>
      <td width="151" align="right" >Objetivo General</td>
      <td colspan="3"><input name="objetivo_general" type="text" id="objetivo_general" tabindex="8" size="50" maxlength="200"/></td>
  </tr>
  <tr>
      <td width="151" align="right" >Objetivo Espec&iacute;fico</td>
      <td colspan="3"><input name="objetivo_especifico" type="text" id="objetivo_especifico" tabindex="8" size="50" maxlength="200"/></td>
  </tr>
  <tr>
      <!--<td width="151" align="right" >Descripci&oacute;n detallada</td>
      <td colspan="3"><input type="text"  name="descripcion_proy"  id="descripcion_proy" tabindex="8" size="50" maxlength="200"/></td>-->
      <td align="right">Descripción detallada</td>
      <td><textarea name="descripcion_proy" id="descripcion_proy" rows="10" cols="50" placeholder="Escribe la descripción detallada del proyecto"></textarea></td>
  </tr>
	<tr>
       <td align="right">Necesidades new</td>
       <td colspan="3"><?php $combonec->selnecnew($_POST['id_nec'],$_REQUEST['lab'],$_REQUEST['div']); ?></td>
  </tr>
  
  <tr>
     <td align="right">Beneficios esperados</td>
     <td><textarea name="beneficio" id="beneficio" rows="10" cols="50" placeholder="Escribe aquí los beneficios que se esperan conseguir"></textarea></td>
  </tr>
  <tr>
	  <td >Cantidad de miembros de la comunidad universitaria beneficiados</td> 
  <td >Alumnos
      <input name="cantalum" type="text" id="cantalum" tabindex="1" size="3">
      Profesores
      <input name="cantprof" type="text" id="cantprof" tabindex="1" size="3">
      Investigadores
      <input name="cantinvest" type="text" id="cantinvest" tabindex="1" size="3"></td>    
  </tr>
  <tr>
      <td align="right">Impacto</td>
      <td ><?php  $combo->cmbImpacto($_POST['id_impacto']); ?></td>
  </tr>
  <tr>
      <td align="right">Productos a obtener</td>
      <td ><?php  $combo->cmbProducto($_POST['id_producto']); ?></td>
  </tr>
  <tr>
        <td><label>Responsable acádemico</label></td>
        <td><label><?php $combousu->combousuacad($_REQUEST['div'],$_SESSION['id_usuario'])?></label></td>
     </tr>  
     <tr>
        <td><label>Responsable técnico</label></td>
        <td><label><?php $combousu->combousuatec($_REQUEST['div'],$_SESSION['id_usuario'])?></label></td>
     </tr>  
     <tr>
        <td><label>Responsable administrativo</label></td>
        <td><label><?php $combousu->combousuadmin($_REQUEST['div'],$_SESSION['id_usuario'])?></label></td>
     </tr>  
  <tr>
	 <td align="right"><label for="file">Evidencia  de los espacios (.pdf):</label></td>
	 <td ><input type="file" name="file" id="file"/></td>
    <td><?php if ($_SESSION['error']['arch']=='ea'){?> <div id="resaltado"> El archivo ya existe </div> <?php } ?>
    <?php if ($_SESSION['error']['arch']=='ai'){?> <div id="resaltado"> El formato debe ser jpg </div> <?php } ?>
    </td>
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
<input name="div" type="hidden" value="<?php echo $_GET['div']; ?>" />
<input name="id_proy" type="hidden" value="<?php echo $_POST['id_proy']; ?>" />

</form>
<br>
<br>
</div>
<?php 	} else {
	
     echo 'proy en edita:'. $_POST['id_proy'];
?>
	
<br>
<br>
<div class=formulario>
<form action="../inc/procesaproy.inc.php" method="post" enctype="multipart/form-data" class="formul">
	<div name="formcotiza" >
	
<table cellpadding="2" class="formulario">

  <tr>
      <td width="151" align="right" >Nombre</td>
      <td colspan="3"><input name="nombre_proy" type="text" id="nombre_proy" tabindex="8" size="50" 
      maxlength="100" value="<?php echo $_POST['nombre_proy']; ?>"/></td>
  </tr>
  <tr>
      <td width="151" align="right" >Objetivo General</td>
      <td colspan="3"><input name="objetivo_general" type="text" id="objetivo_general" tabindex="8" size="50" maxlength="200"
      value="<?php echo $_POST['objetivo_general'];?>"/></td>
  </tr>
  <tr>
      <td width="151" align="right" >Objetivo Espec&iacute;fico</td>
      <td colspan="3"><input name="objetivo_especifico" type="text" id="objetivo_especifico" tabindex="8" size="50" maxlength="200"
      value="<?php echo $_POST['objetivo_especifico'];?>"/></td>
  </tr>
  <tr>
     
      <td width="151" align="right" >Descripci&oacute;n</td>
      <td colspan="3"><input name="descripcion_proy" type="text" id="descripcion_proy" tabindex="8" size="50" maxlength="200"
      value="<?php echo $_POST['descripcion_proy'];?>"/></td>
  </tr>
  <tr>
       <td align="right">Necesidades</td>
       <td colspan="3"><?php $combonec->selneced($_POST['id_nec'],$_REQUEST['lab'],$_POST['id_proy']); ?></td>
  </tr>
  
  <tr>
     <td align="right">Beneficio</td>
     <td colspan="3"><input name="beneficio" type="text" id="beneficio" tabindex="8" size="100" maxlength="400" value="<?php echo $_POST['beneficio']; ?>"/></td>
  </tr>
  
  <tr>
    <td >Cantidad de miembros de la comunidad universitaria beneficiados</td> 
     <td >Alumnos<input name="cantalum" type="text" id="cantalum" tabindex="1" size="4" value="<?php echo $_POST['cantalum']; ?> "/>
     Profesores<input name="cantprof" type="text" id="cantprof" tabindex="1" size="4" value="<?php echo $_POST['cantprof']; ?> "/>
    Investigadores<input name="cantinvest" type="text" id="cantinvest" tabindex="1" size="4" value="<?php echo $_POST['cantinvest']; ?> "/></td>
  </tr>
  <tr>
      <td align="right">Impacto</td>
      <td ><?php  $combo->cmbImpacto($_POST['id_impacto']); ?></td>
  </tr>
  <tr>
      <td align="right">Productos a obtener</td>
      <td ><?php  $combo->cmbProducto($_POST['id_producto']); ?></td>
  </tr>
   <tr>
        <td><label>Responsable acádemico</label></td>
        <td><label><?php $combousu->combousuacad($_REQUEST['div'],$_SESSION['id_usuario'])?></label></td>
     </tr>  
     <tr>
        <td><label>Responsable técnico</label></td>
        <td><label><?php $combousu->combousuatec($_REQUEST['div'],$_SESSION['id_usuario'])?></label></td>
     </tr>  
     <tr>
        <td><label>Responsable administrativo</label></td>
        <td><label><?php $combousu->combousuadmin($_REQUEST['div'],$_SESSION['id_usuario'])?></label></td>
     </tr>  
   <tr>
	 <td align="right"><label for="file">Evidencia  de los espacios (.pdf):</label></td>
	 <td><input type="file" name="file" id="file"/></td>
     <td><?php if ($_SESSION['error']['arch']=='ea'){?> <div id="resaltado"> El archivo ya existe </div> <?php } ?>
         <?php if ($_SESSION['error']['arch']=='ai'){?> <div id="resaltado"> El formato debe ser jpg </div> <?php } ?>
    </td>
  </tr>
	<td colspan="4" align="right">
    <input type="submit" name="accionm" value="Guardar" />
    <input type="reset" name="accionm"  value="Limpiar" />
	<input type="submit" name="accionm" value="Cancelar" /></td>
    </tr>
</table>
<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="id_proy" type="hidden" value="<?php echo $_POST['id_proy']; ?>" />
<input name="ref" type="hidden" value="<?php echo $_POST['ref']; ?>" />
<input name="div" type="hidden" value="<?php echo $_GET['div']; ?>" />
</form>
</div>

<br>
<?php 

	}?>