<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php  
require_once('../clases/cotiza.class.php');
require_once('../clases/requerimientos.class.php');
require_once('../clases/inventario.class.php');
require_once('../clases/log.class.php');

$combocot = new Cotiza();
$motivo = new Requerimiento();
$obj_inv = new Inventario();
$logger = new Log();

echo 'en edita serv', print_r($_REQUEST);

if ($_REQUEST['accion']=='nuevob'){  



if ($_GET['mod']=='serv') {
	$tiposerv='FALSE';} elseif ($_GET['mod']=='servi' || $_GET['mod']=='servibf' || $_GET['mod']=='servibp'){
	$tiposerv='TRUE';}

?>
<div class="formulario">
<div class="recuadro"><p>Selecciona los equipos a los cuales se les dará servicio de mantenimiento con las siguientes especificaciones en común</p></div>
<form action="../inc/procesaserv.inc.php" method="post" name="form_nuevo">
<table cellpadding="2" class="formulario">
  <tr>
    <td width="480" align="right" >Tipo de mantenimiento</td>
    <td colspan="2" ><div class="recuadro">
      <p>
	
	<!--Bloque para selecconar mantenimiento preventivo o correctivo, el primero es para internos generales los otros dos es para bitácoras -->
	<?php  if ($_GET['mod']=='servi'|| $_GET['mod']=='serv') { ?>
		        <label><input name="tipo_mant" type="radio" id="tipo_mant_0" value="P" checked="checked" />Preventivo</label>
			        &nbsp;&nbsp;&nbsp;&nbsp;
		        <label><input type="radio" name="tipo_mant" value="C" id="tipo_mant_1" />Correctivo</label>
        <?php } ?>
	
     <!-- aquí inicia para bitácoras -->
	
	<?php  if ($_GET['mod']=='servibp'){ ?>
		        <label><input name="tipo_mant" type="radio" id="tipo_mant_0" value="P" checked="checked" />Preventivo</label>
	<?php } ?>
		        
	<?php  if ($_GET['mod']=='servibf'){ ?>
		        <label><input type="radio" name="tipo_mant" value="C" id="tipo_mant_1" checked="checked" />Correctivo</label>
        <?php } ?>

    <!-- aquí termina para bitácoras -->
        
        <br />
      </p>
    </div></td>
  </tr>
<?php if ($_REQUEST['accion']!='nuevob'){
	?>
  <tr>
    <td align="right">Equipo</td>
    <td colspan="2"><?php $obj_inv->cmbEquipo($_REQUEST['lab'],$_POST['bn_id']);?></td>
  </tr>
<?php }?>

<?php  if ($_GET['mod']!='servi' && $_GET['mod']!='servibf' && $_GET['mod']!='servibp'){ ?>

	<tr>
    <td align="right">Costo presupuestado</td>
    <td colspan="2"><input name="cto_unitario" type="text" id="cto_unitario" tabindex="2" size="9" maxlength="11" />&nbsp;<span style="color: #900; font-size: small;">(El costo debe ser expresado en pesos mexicanos)</span></td>
  </tr>
<?php }?>
  <tr>

    <td align="right">Descripción del servicio</td>
    <td colspan="2"><input name="tipo_falla" type="text" id="descripcion" tabindex="3" size="100" maxlength="200" /></td>
  </tr>
      <?php if ($_REQUEST['mod']=='serv') { ?>
  <tr>
	<td align="right">Cotización</td>
    <td colspan="2"><?php $combocot->cmbCotiza($_REQUEST['lab'],'sm',$_REQUEST['id_cotizacion']); ?></td> 
  </tr>
  		<?php }?>
  <tr>
    <?php if ($_REQUEST['mod']=='servibf'){$texto_periodo="Periodo en el que se realizó el mantenimiento"; } else {$texto_periodo="Periodo propuesto para realizar el mantenimiento";}?>
    <td align="right"><?php echo $texto_periodo; ?></td>
    <td width="217">Inicio: 
      <!--<input name="fecha_salida" type="text" id="fecha_salida" value="<?php echo date("Y-m-d", strtotime($_POST['fsalida'])); ?>" size="10" maxlength="10" class="tcal"/>-->
            <input name="fecha_salida" type="text" id="fecha_salida" value="<?php echo date("d-m-Y") ?>" size="10" maxlength="10" class="tcal"/></td>
    <td width="634">Término:
      <input name="fecha_recepcion" type="text" id="fecha_recepcion" value="<?php echo date("d-m-Y") ?>" size="10" maxlength="10" class="tcal"/>
      <!--<input name="fecha_recepcion" type="text" id="fecha_recepcion" value="<?php echo date("Y-m-d", strtotime($_POST['frecepcion'])); ?>" size="10" maxlength="10" class="tcal"/> -->
      </td>
  </tr>
<?php  if ($_GET['mod']!='servi' && $_GET['mod']!='servibf' && $_GET['mod']!='servibp'){ ?>
  <tr>
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
  </tr>
<?php }?>
  
<?php if ($_GET['mod']=='servibp') { ?>  
  <tr>
    <td align="right">Fecha del próximo mantenimiento</td>
    <td colspan="2"><input name="fechaprox" type="text" id="fechaprox" value="<?php echo date("d-m-Y") ?>" size="10" maxlength="10" class="tcal"/></td>
  </tr>
<?php } ?>
<?php if ($_GET['mod']=='servibf') { ?>  

  <tr>
    <td align="right">Actividad:</td>
    <td colspan="2"><select name="actividad" id="actividad">
      <option value="2" selected="selected">Docencia</option>
      <option value="3">Investigación</option>
      <option value="5">Curso</option>
      <option value="7">Proyecto</option>
    </select></td>
  </tr>
<?php } ?>

<?php if ($_GET['mod']=='servibf' || $_GET['mod']=='servibp') { ?>  
  <tr>
    <td align="right">Semestre:</td>
    <td colspan="2"><input name="semestre" type="text" id="semestre" size="6" maxlength="6" /></td>
  </tr>
  <?php if ($_GET['mod']=='servibf'){$texto_etiq='Usuario que reporta la falla:';}
	       elseif ($_GET['mod']=='servibp') {$texto_etiq='Persona que realiz&oacute; el manteniemiento:'; } ?>
  
  <tr>
    <td align="right"><?php echo $texto_etiq; ?></td>
    <td colspan="2"><input name="reporta" type="text" id="reporta" size="20" maxlength="50" /></td>
  </tr>
  <?php } ?>
  
<?php if ($_GET['mod']=='servibf') { ?>
  <tr>
    <td align="right">Cómo se detectó la falla:</td>
    <td colspan="2"><select name="detecto" id="detecto">
      <option value="1">Por una queja en el buzón</option>
      <option value="2">Por un comentario en la encuesta de satisfacción del servicio</option>
      <option value="3">Al momento del préstamo del equipo</option>
      <option value="4">Actividades cotidianas del personal del laboratorio</option>
    </select></td>
  </tr>
 <?php } ?>
 
<?php if ($_GET['mod']=='servibf' || $_GET['mod']=='servibp') { $logger->putLog(53,3)?> 

  <tr>
    <td align="right">Supervisó:</td>
    <td colspan="2"><input name="superviso" type="text" id="superviso" size="20" maxlength="50" /></td>
  </tr>
<?php } ?>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
      
  <tr>
    <td colspan="3" align="right">
    <input type="submit" name="accionb" value="Guardar" />
    <input type="reset" name="accionb"  value="Limpiar" />
	<input type="submit" name="accionb" value="Cancelar" /></td>
    </tr>
</table>
<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="orden" type="hidden" value="<?php echo $_GET['orden']; ?>" />
<input name="div" type="hidden" value="<?php echo $_REQUEST['div']; ?>" />
<input name="fecha" type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" />
<input name="garantia" type="hidden" value="FALSE" />
<input name="id_evento" type="hidden" value="<?php echo $_POST['id_evento']; ?>" />
<input name="tipo_serv" type="hidden" value="<?php echo $tiposerv; ?>" />



<p>&nbsp;</p>
<?php 

$obj_inv->tblEquipo($_GET['lab']);
?>

</form></div>



<?php 	} else {

/*echo "Edicion de registro de material </br>";
print_r($_POST);*/?>

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
<?php  if ($_GET['mod']=='serv'){ ?>
  <tr>
    <td align="right">Costo presupuestado</td>
    <td colspan="2"><input name="cto_unitario" type="text" id="cto_unitario" tabindex="2" value="<?php echo $_POST['costo']; ?>" size="9" maxlength="11" />&nbsp;<span style="color: #900; font-size: x-small;">(El costo debe ser expresado en pesos mexicanos)</span></td>
  </tr>
<?php } ?>  
  <tr>
    <td align="right">Descripción del servicio</td>
    <td colspan="2"><input name="tipo_falla" type="text" id="descripcion" tabindex="3" value="<?php echo $_POST['falla']; ?>" size="100" maxlength="200" /></td>
  </tr>
<?php if ($_REQUEST['mod']=='serv') { ?>
  <tr>
    <td align="right">Cotización</td>
    <td colspan="2"><?php $combocot->cmbCotiza($_REQUEST['lab'],'sm',$_REQUEST['id_cotizacion']); ?></td> 
  </tr>
<?php }; ?>
  <tr>
    <td align="right">Periodo propuesto para realizar el mantenimiento</td>
    <td width="217">Inicio: 
      <input name="fecha_salida" type="text" id="fecha_salida" value="<?php echo date("d-m-Y", strtotime($_POST['fsalida'])); ?>" size="10" maxlength="10" class="tcal"/></td>
    <td width="634">Término:
      <input name="fecha_recepcion" type="text" id="fecha_recepcion" value="<?php echo date("d-m-Y", strtotime($_POST['frecepcion'])); ?>" size="10" maxlength="10" class="tcal"/></td>
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
  <?php if ($_GET['mod']=='servibf') { ?>  

  <tr>
    <td align="right">Actividad:</td>
    <td colspan="2"><select name="actividad" id="actividad">
      <option value="2" selected="selected">Docencia</option>
      <option value="3">Investigación</option>
      <option value="5">Curso</option>
      <option value="7">Proyecto</option>
    </select></td>
  </tr>
<?php } ?>
  
  <?php if ($_GET['mod']=='servibf' || $_GET['mod']=='servibp') { ?>  
  <tr>
    <td align="right">Semestre:</td>
    <td colspan="2"><input name="semestre" type="text" id="semestre" size="6" maxlength="6" /></td>
  </tr>
  <?php if ($_GET['mod']=='servibf'){$texto_etiq='Usuario que reporta la falla:';} elseif ($_GET['mod']=='servibp') {$texto_etiq='Persona que realiz&oacute; el manteniemiento:'; } ?>
  
  <tr>
    <td align="right"><?php echo $texto_etiq; ?></td>
    <td colspan="2"><input name="reporta" type="text" id="reporta" size="20" maxlength="50" /></td>
  </tr>
  <?php } ?>
  
  <?php if ($_GET['mod']=='servibf') { ?>
  <tr>
    <td align="right">Cómo se detectó la falla:</td>
    <td colspan="2"><select name="detecto" id="detecto">
      <option value="1">Por una queja en el buzón</option>
      <option value="2">Por un comentario en la encuesta de satisfacción del servicio</option>
      <option value="3">Al momento del préstamo del equipo</option>
      <option value="4">Actividades cotidianas del personal del laboratorio</option>
    </select></td>
  </tr>
 <?php } ?>
 
<?php if ($_GET['mod']=='servibf' || $_GET['mod']=='servibp') { $logger->putLog(53,3)?> 

  <tr>
    <td align="right">Supervisó:</td>
    <td colspan="2"><input name="superviso" type="text" id="superviso" size="20" maxlength="50" /></td>
  </tr>
<?php } ?>

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
<input name="div" type="hidden" value="<?php echo $_REQUEST['div']; ?>" />
<input name="fecha" type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" />
<input name="garantia" type="hidden" value="FALSE" />
<input name="id_evento" type="hidden" value="<?php echo $_POST['id_evento']; ?>" />

</form>

<?php 

	}?>