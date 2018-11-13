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
  <input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />

                                            	<table cellspacing="5" align="left" class="formulario">
                                                	<tr align="left">
                                                    	<td width="20%"><label for="wi-title">Evento</label></td>
                                                        <td><input type="hidden" id="id_evento" value="<?php echo "".$edit==1?$evento->id_evento:""; ?>" /><input id="nombre" type="text" name="text" value="<?php echo "".$edit==1?$evento->nombre_evento:""; ?>" size="40"/></td>
                                                    </tr>
                                                    <tr align="left">
                                                    	<td width="20%"><label for="wi-title">Fecha</label> 
                                                    	de registro</td>
                                                        <td><input id="fecha" type="text" name="fecha" size="9" value="<?php echo "".$edit==1?substr($evento->hora_inicial,0,10):$_POST['_fecha_select']; ?>" class="tcal"/>&nbsp;&nbsp;&nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr align="left">
                                                    	<td width="20%"><label for="wi-title">Horario</label></td>
                                                        <td><select id="hora_inicio" onchange="javascript:actualiza()">
                                                        <?php
                                                        $hora=$edit==1?(int)substr($evento->hora_inicial,11,2):7;
                                                        $min=$edit==1?(int)substr($evento->hora_inicial,14,2):0;
														for($i=7;$i<=22;$i++){
															$selected=$min==0?$hora==$i?" selected":"":"";
															echo "<option value=\"".$i.":00\"".$selected.">".$i.":00</option>";
															if($i<22){
																$selected=$min>0?$hora==$i?" selected":"":"";
																echo "<option value=\"".$i.":30\"".$selected.">".$i.":30</option>";
															}
														}
														
														?>
                                                        </select>&nbsp;&nbsp;a&nbsp;&nbsp;
                                                      <select id="hora_fin">
                                                        <?php
                                                        $hora=$edit==1?(int)substr($evento->hora_final,11,2):8;
                                                        $min=$edit==1?(int)substr($evento->hora_final,14,2):0;
														for($i=8;$i<=22;$i++){
															$selected=$min==0?$hora==$i?" selected":"":"";
															echo "<option value=\"".$i.":00\"".$selected.">".$i.":00</option>";
															if($i<22){
																$selected=$min>0?$hora==$i?" selected":"":"";
																echo "<option value=\"".$i.":30\"".$selected.">".$i.":30</option>";
															}
														}
														
														?>
                                                        </select></td>
                                                    </tr>
                                                    <tr <?php echo "".$edit==1?" style=\"visibility:collapse;\"":""; ?> align="left">
                                                    	<td>Se repite:</td>
                                                        <td>
                                                        	<select id="repite" class="recur-persel" onchange="javascript: showFechaFin()">
																<option value="0" selected="selected">No se repite</option>
																<option value="1">Cada d&iacute;a</option>
																<option value="2">Cada d&iacute;a laborable (lun.-vie.)</option>
																<option value="3">Cada lun., mié. y vie.</option>
																<option value="4">Cada mar. y jue.</option>
																<option value="5">Cada semana</option>
																<option value="6">Mensualmente</option>
															</select>
                                                        </td>
                                                    </tr>
                                                    <tr id="fecha_fin_tr" align="left">
                                                    	<td><label for="wi-where">Fecha Fin</label></td>
                                                        <td><input id="fecha_fin" type="text" name="fecha" value="<?php echo $_POST['_fecha_select'];?>" size="9" autocomplete="off" class="tcal" />&nbsp;&nbsp;&nbsp;</td>
                                                    </tr>
                                                    <tr align="left">
                                                    	<td><label for="wi-where">Actividad</label></td>
                                                        <td><?php 	/*$val=$edit==1?$evento->tipo_actividad:"";
                                                        			echo $bit -> cmbTipoAct('tipo_actividad',$val);*/?></td>
                                                    </tr>
                                                    <tr align="left">
                                                    	<td><label for="wi-where">Descripci&oacute;n</label></td>
                                                        <td><textarea id="descripcion" rows="3" cols="37"><?php //echo "".$edit==1?$evento->descripcion:""; ?></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" align="right">
                                                        <input type="submit" name="accionn" value="Guardar" />
                                                        <input type="reset" name="accionn"  value="Limpiar" />
                                                        <input type="submit" name="accionn" value="Cancelar" /></td>
                                                        </tr>
                                                </table>


  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>
  <input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
  <input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
  <input name="id_nec" type="hidden" value="<?php echo $_POST['id_nec']; ?>" />
  <input name="ref" type="hidden" value="<?php echo $_POST['ref']; ?>" />
  </p>


</form>
</div>
<?php 	} else {

//echo "Edicion de registro de material </br>";
//print_r($_POST);?>



<?php 

	}?>