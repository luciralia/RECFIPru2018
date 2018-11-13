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
<form action="../inc/procesaqueja.inc.php" method="post" name="form_nuevo">
<table cellpadding="2" class="formulario">
  <tr>
    <td colspan="3" align="right" >Semestre:</td>
    <td colspan="2" ><input type="text" name="semestre" id="semestre" accesskey="1" tabindex="1" /></td>
    <td width="129" >Fecha del evento:</td>
    <td width="240" ><input name="fecha" type="text" id="fecha" value="<?php echo date("Y-m-d"); ?>" size="10" maxlength="10" class="tcal"/></td>
  </tr>
  <tr>
    <td colspan="3" align="right" >Tipo de usuario</td>
    <td colspan="4" ><div class="recuadro">
      <p>
        <label>
          <input name="tipo_usuario" type="radio" id="tipo_mant_0" value="2" checked="checked" />
          Alumno</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo_usuario" value="3" id="tipo_mant_1" />
          Académico</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo_usuario" value="5" id="tipo_mant_2" />
          Administrativo</label>
        <br />
        </p>
    </div></td>
  </tr>
  

    <tr>
      <td colspan="7" align="left">Por favor incluya toda la información que considere relevante para atender su queja, sugerencia o felicitación</td>
      </tr>
    <tr>

    <td colspan="3" align="right">&nbsp;</td>
    <td colspan="4"><input name="queja" type="text" id="queja" tabindex="3" size="100" maxlength="1000" /></td>
  </tr>
  
  <tr>
    <td colspan="7" align="left">Si desea que se le informe del segumiento que se le ha dado a su sugerencia, favor de proporcionar los siguientes datos:</td>
    </tr>

  <tr>
    <td colspan="3" align="right">Nombre:</td>
    <td colspan="2"><input name="quejoso" type="text" id="quejoso" size="70" maxlength="100" /></td>
    <td>Corre electrónco:</td>
    <td><input name="email" type="text" id="email" size="40" maxlength="50" /></td>
  </tr>
  <!--    
  <tr>
    <td colspan="7" align="left"><hr />Para llenado exclusivo por parte del personal del laboratorio</td>
  </tr>
  <tr>
    <td colspan="7" align="left">Folio: 
      <input name="folio" type="text" disabled="disabled" id="folio" value="1" size="6" readonly="readonly" /></td>
    </tr>
  <tr>
    <td width="79" align="right">Clasificación:</td>
    <td width="37" align="center"><label><input type="radio" name="clasificacion" value="q" id="clasificacion_0" />Queja</label></td>
    <td width="66" align="center"><label><input type="radio" name="clasificacion" value="s" id="clasificacion_1" />Sugerencia</label></td>
    <td width="73" align="center"><label><input type="radio" name="clasificacion" value="f" id="clasificacion_2" />Felicitación</label></td>
    <td width="341" align="left">&nbsp;</td>
    <td align="left"><label><input name="relevancia" type="radio" id="relevancia_0" value="t" checked="checked" />Relevante</label></td>
    <td align="left"><label><input type="radio" name="relevancia" value="f" id="relevancia_1" />No relevante</label></td>
  </tr>
  <tr>
    <td colspan="7" align="right">&nbsp;</td>
  </tr>-->
  <tr>
    <td colspan="7" align="right">
    <input type="submit" name="accionn" value="Guardar" />
    <input type="reset" name="accionn"  value="Limpiar" />
	<input type="submit" name="accionn" value="Cancelar" /></td>
    </tr>
</table>

<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="fechareg" type="hidden" value="<?php echo date("Y-m-d");; ?>" />
<input name="relevancia" type="hidden" value="t" />

<!-- Código del formulario para el reCaptcha-->
<!--<div class="g-recaptcha" data-sitekey="6LfjlxETAAAAAHcEkP14oiHbLXkbLaThTuUFN_uu"></div>-->

</form>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
<?php 	} else {


?>

</div>
<div class=formulario>
<?php print_r($_POST); ?>
<form action="../inc/procesaqueja.inc.php" method="post" name="form_edita">
<table cellpadding="2" class="formulario">
  <tr>
    <td colspan="3" align="right" >Semestre:</td>
    <td colspan="2" ><input name="semestre" type="text" readonly="readonly" id="semestre" accesskey="1" tabindex="1"  value="<?php echo $_POST['semestre'] ?>"/></td>
    <td width="129" >Fecha:</td>
    <td width="240" ><input name="fecha" type="text" id="fecha" value="<?php echo date("d-m-Y", strtotime($_POST['fecha'])); ?>" size="10" maxlength="10" readonly="readonly"/></td>
  </tr>
  <tr>
    <td colspan="3" align="right" >Tipo de usuario</td>
    <td colspan="4" ><div class="recuadro">
         
       <p>
        <label>
          <input name="tipo_usuario" type="radio" id="tipo_mant_0" value="2" disabled="disabled" <?php echo $checked=($_POST['tipo_usuario']=='2')?'checked="checked"':''; ?> />
          Alumno</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo_usuario" value="3" id="tipo_mant_1" disabled="disabled" <?php echo $checked=($_POST['tipo_usuario']=='3')?'checked="checked"':''; ?>/>
          Académico</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label>
          <input type="radio" name="tipo_usuario" value="5" id="tipo_mant_2" disabled="disabled" <?php echo $checked=($_POST['tipo_usuario']=='5')?'checked="checked"':''; ?>/>
          Administrativo</label>
        <br />
        </p> 
    </div></td>
  </tr>
  
    <tr>
      <td colspan="7" align="left">Por favor incluya toda la información que considere relevante para atender su queja, sugerencia o felicitación</td>
      </tr>
    <tr>

    <td colspan="3" align="right">&nbsp;</td>
    <td colspan="4"><input name="queja" type="text" id="queja" tabindex="3" value="<?php echo $_POST['queja'] ?>" size="100" maxlength="1000" readonly="readonly"/></td>
  </tr>

  <tr>
    <td colspan="7" align="left">Si desea que se le informe del segumiento que se le ha dado a su sugerencia, favor de proporcionar los siguientes datos:</td>
    </tr>

  <tr>
    <td colspan="3" align="right">Nombre:</td>
    <td colspan="2"><input name="quejoso" type="text" id="quejoso" size="70" maxlength="100" readonly="readonly" value="<?php echo $_POST['quejoso'] ?>"/></td>
    <td>Correo electrónco:</td>
    <td><input name="email" type="text" id="email" value="<?php echo $_POST['email'] ?>" size="40" maxlength="50" readonly="readonly"/></td>
  </tr>
      
  <tr>
    <td colspan="7" align="left"><hr />Para llenado exclusivo por parte del personal del laboratorio</td>
  </tr>
  <tr>
    <td colspan="7" align="left">Folio: 
      <input name="folio" type="text" id="folio" value="<?php echo $_POST['folio'] ?>" size="4" maxlength="4" readonly="readonly"/></td>
    </tr>
  <tr>
    <td width="79" align="right">Clasificación:</td>
    <td width="37" align="center"><label><input type="radio" name="clasificacion" value="q" id="clasificacion_0" <?php echo $checked=($_POST['clasificacion']=='q')?'checked="checked"':''; ?>/>Queja</label></td>
    <td width="66" align="center"><label><input type="radio" name="clasificacion" value="s" id="clasificacion_1" <?php echo $checked=($_POST['clasificacion']=='s')?'checked="checked"':''; ?>/>Sugerencia</label></td>
    <td width="73" align="center"><label><input type="radio" name="clasificacion" value="f" id="clasificacion_2" <?php echo $checked=($_POST['clasificacion']=='f')?'checked="checked"':''; ?>/>Felicitación</label></td>
    <td width="341" align="left">&nbsp;</td>
    <td align="left"><label><input name="relevancia" type="radio" id="relevancia_0" value="t"  <?php echo $checked=($_POST['relevancia']=='t')?'checked="checked"':''; ?>/>Relevante</label></td>
    <td align="left"><label><input type="radio" name="relevancia" value="f" id="relevancia_1" <?php echo $checked=($_POST['relevancia']=='f')?'checked="checked"':''; ?>/>No relevante</label></td>
  </tr>
  <tr>
    <td colspan="7" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="right">
    <input type="submit" name="accionm" value="Guardar" />
    <input type="reset" name="accionm"  value="Limpiar" />
	<input type="submit" name="accionm" value="Cancelar" /></td>
    </tr>
</table>
<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="id_queja" type="hidden" value="<?php echo $_POST['id_queja']; ?>" />



</form>
</div>
<?php 

	}?>