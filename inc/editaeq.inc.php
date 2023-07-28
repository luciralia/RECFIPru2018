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
	
function validarRango(elemento){
  var numero = parseInt(elemento.value,10);
	
  //Validamos que se haya ingresado solo numeros
  if(isNaN(numero)){
    alert('Ingrese solo números.');
    //elemento.focus();
    //elemento.select();
    return false;
  }
  //Validamos que se cumpla el rango
if (document.getElementById("id_recurso").value==1 && (numero<0 || numero>450))
 {
    alert('Al menos 450 equipos de la configuración CatálogoBase-2022-002');
   // elemento.focus();
    return false;
  }else if (document.getElementById("id_recurso").value==2 && (numero<0 || numero>192))
 {
    alert('Al menos 192 equipos de la configuración CatálogoBase-2022-003');
   // elemento.focus();
    return false;
  }else if (document.getElementById("id_recurso").value==3 && (numero<0 || numero>70))
 {
    alert('Al menos 70 equipos de la configuración CatálogoBase-2022-008');
   // elemento.focus();
    return false;
  }
	  
  return true;
}


</script>	 
	 
<?php  
require_once('../clases/cotiza.class.php');
require_once('../clases/requerimientos.class.php');
$combocot = new Cotiza();
$motivo = new Requerimiento();
$combofunc = new Requerimiento();


 print_r($_POST);

if ($_REQUEST['accion']=='nuevo'){  


?>
<br>
<br>
<div class=formulario>
	
<form action="../inc/procesaeq.inc.php" method="post"  enctype="multipart/form-data" name="form_nuevo" class="formul">
<table cellpadding="2" class="formulario">
  <tr>
      <td align="right">Recursos de cómputo</td>
      <td ><?php  $motivo->cmbRecurso($_POST['id_recurso']); ?></td>
  </tr>
  <tr>
      <td width="151" align="right" >Cantidad de equipos</td>
      <td width="857" colspan="3" ><input name="cantidad" type="text" id="cantidad" tabindex="1" size="4"  onblur="return validarRango(this);"></td>
   </tr>
   <tr>
      <td align="right">Descripción</td>
      <td><textarea name="descripcion" id="descripcion" rows="5" cols="50" placeholder="Escribe aquí la descripción detallada para que se utilizarán los equipos"></textarea></td>
      
   </tr>
  <tr>
      <td align="right">Costo Unitario</td>
      <td colspan="3"><input name="cto_unitario" type="text" id="cto_unitario" tabindex="2" size="9" maxlength="11"/> 
    &nbsp;<span style="color: #900; font-size: x-small;">(El costo debe ser expresado en dólares americanos USD)</span></td>
  </tr>
  <tr>
       <td align="right">Cotización</td>
       <td colspan="3"><?php $combocot->cmbCotiza($_REQUEST['lab'],'eq',$_REQUEST['id_cotizacion']); ?></td>
  </tr>
  <tr>
      <td align="right">Motivo</td>
      <td colspan="3"><?php $motivo->cmbJustEq($_POST['id_just']) ?>  
	</td>
      </tr>
      <tr>
       <td align="right">Otro Motivo</td>
        <?php
	     if ($_POST['id_just']==7){  ?>
		 <td><input type="text" name="otra_just" id="otrajust" size="50" value="<?php echo $_POST['otra_just'];  ?>" required ></td>
        <?php } else {  ?>
         <td><input type="text" name="otra_just" id="otrajust" size="50" value="<?php echo $_POST['otra_just'];  ?>" disabled="disabled" ></td>
     
	 <?php }  ?>
  </tr>
  <tr>
      <td align="right">Justificación técnica</td>
      <td><textarea name="impacto" id="impacto" rows="5" cols="50"  placeholder="Escribe aquí la justificación técnica"></textarea></td>
      
  </tr>
  <tr>
	  <td align="right">Función(es)</td>
           <td ><?php $combofunc->selfunc(); ?></td>
   </tr>
   <tr>
      <td align="right">Otra función</td>
      <td><textarea name="otro_cual" id="otro_cual" rows="2" cols="50"  placeholder="Escribe aquí otra función"></textarea></td>
      
  </tr>
  <tr>
      <td align="right">Detalle de (las) función(es)</td>
      <td><textarea name="detalle_func" id="detalle_func" rows="5" cols="50"  placeholder="Escribe aquí el detalle de la función"></textarea></td>
      
  </tr>
 
  <tr>
	 <td align="right"><label for="file">Evidencia  actual en archivo (.pdf):</label></td>
	 <td ><input type="file" name="file" id="file"/></td>
    <td><?php if ($_SESSION['error']['arch']=='ea'){?> <div id="resaltado"> El archivo ya existe </div> <?php } ?>
    <?php if ($_SESSION['error']['arch']=='ai'){?> <div id="resaltado"> El formato debe ser pdf </div> <?php } ?>
    </td>
  </tr>
  <tr>
	 <td align="right"><label for="file">Evidencia  de la infraestructura en archivo (.pdf):</label></td>
	 <td ><input type="file" name="file1" id="file1"/></td>
    <td><?php if ($_SESSION['error']['arch']=='ea'){?> <div id="resaltado"> El archivo ya existe </div> <?php } ?>
    <?php if ($_SESSION['error']['arch']=='ai'){?> <div id="resaltado"> El formato debe ser pdf </div> <?php } ?>
    </td>
  </tr>
   
	
   <tr>
    <td align="right">Prioridad</td>
    <td><?php $motivo->cmbPrioridad($_POST['id_prio'])?></td>
    <td align="right">Año</td>
    <td><?php $motivo->cmbPlazo($_POST['id_plazo']) ?></td>
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
	
<form action="../inc/procesaeq.inc.php" method="post"  enctype="multipart/form-data" name="form_nuevo" class="formul">
<table cellpadding="2" class="formulario">
<tr>
      <td align="right">Recursos de cómputo</td>
      <td><?php  $motivo->cmbRecurso($_REQUEST['id_recurso']); ?></td>
  </tr>
 
  <tr>
    <td width="151" align="right" >Cantidad</td>
    <td width="857" colspan="3" ><input name="cantidad" type="text" id="cantidad" tabindex="1" size="4" value="<?php echo $_POST['cantidad']; ?>"></td>
  </tr>
  <tr>
    <td align="right">Costo Unitario</td>
    <td colspan="3"><input name="cto_unitario" type="text" id="cto_unitario" tabindex="2" size="9" maxlength="9" value="<?php echo $_POST['costo']; ?>"/></td>
  </tr>
  <tr>
  
      <td align="right">Descripción</td>
      <td><textarea name="descripcion" id="descripcion" rows="10" cols="40"><?php echo $_POST['descripcion']?></textarea></td>
    <!--<td align="right">Descripción</td>
    <td colspan="3"><input name="descripcion" type="text" id="descripcion" tabindex="3" size="100" maxlength="200" value="<?php //echo $_POST['descripcion']; ?>"/></td>
    
    <td colspan="3"> <textarea name="descripcion" id="descripcion" tabindex="3" value="<?php //echo $_POST['descripcion']; ?>"></textarea></td>-->
    
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
    <td colspan="3"><?php $motivo->cmbJustEq($_POST['id_just']) ?> </td> 
	<!--<td colspan="3"><?php// echo "</br>" . $motivo->getJusteq($_POST['id_just'],'descripcion');?></td>-->
    </tr>
    <tr>
     <td align="right">Otro Motivo</td>
        <?php
	     if ($_POST['id_just']==7){  ?>
		 <td><input type="text" name="otrajust" id="otrajust" size="50" value="<?php echo $_POST['otrajust'];  ?>" required ></td>
        <?php } else {  ?>
         <td><input type="text" name="otrajust" id="otrajust" size="50" value="<?php echo $_POST['otrajust'];  ?>" disabled="disabled" ></td>
     
	 <?php } ?>
  </tr>
  <tr>
   <!-- <td align="right">Justificación ampliada</td>
   
   <td colspan="3"><input name="impacto" type="text" id="impacto" tabindex="8" size="100" maxlength="400" value="<?php //echo $_POST['impacto']; ?>"/></td>
    
     <td colspan="3"> <textarea name="impacto" id="impacto" tabindex="8" value="<?php //echo $_POST['justificacion'];  ?>"/></textarea></td>-->
     <td align="right">Justificación técnica</td>
      <td><textarea name="impacto" id="impacto" rows="10" cols="40"><?php echo $_POST['impacto']?></textarea></td>
    </tr>
	<tr>
	  <td align="right">Función(es)</td>
           <td ><?php $combofunc->selfunc(); ?></td>
   </tr>
   <tr>
      <td align="right">Otra función</td>
      <td><textarea name="otro_cual" id="otro_cual" rows="2" cols="50" ><?php echo $_POST['otra_cual']?></textarea></td>
    </tr>
  <tr>
      <td align="right">Detalle de (las) función(es)</td>
      <td><textarea name="detalle_func" id="detalle_func" rows="5" cols="50"  ><?php echo $_POST['detalle_func']?></textarea></td>
  </tr>	
 	
  <tr>
	 <td align="right"><label for="file">Evidencia actual en archivo (.pdf):</label></td>
	 <td ><input type="file" name="file" id="file"/><a href="<?php echo $_POST['ruta_evidencia']; ?>" target="_blank"><?php echo substr($_POST['ruta_evidencia'],strpos($_POST['ruta_evidencia'],'_')+3);?></a></td>
    <td><?php if ($_SESSION['error']['arch']=='ea'){?> <div id="resaltado"> El archivo ya existe </div> <?php } ?>
    <?php if ($_SESSION['error']['arch']=='ai'){?> <div id="resaltado"> El formato debe ser pdf </div> <?php } ?>
    </td>
	</tr>
	 <tr>
	 <td align="right"><label for="file1">Evidencia de infraestructura en archivo (.pdf):</label></td>
	 <td ><input type="file" name="file1" id="file1"/><a href="<?php echo $_POST['ruta_evidencia']; ?>" target="_blank"><?php echo substr($_POST['ruta_evidencia'],strpos($_POST['ruta_evidencia'],'_')+3);?></a></td>
    <td><?php if ($_SESSION['error']['arch']=='ea'){?> <div id="resaltado"> El archivo ya existe </div> <?php } ?>
    <?php if ($_SESSION['error']['arch']=='ai'){?> <div id="resaltado"> El formato debe ser pdf </div> <?php } ?>
    </td>
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