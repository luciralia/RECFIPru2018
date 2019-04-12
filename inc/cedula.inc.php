

<?php  
require_once('cargaced.inc.php');
require_once('../clases/laboratorios.class.php');
$lab = new laboratorios();

 ?>

<?php 

//echo 'session en cedula.inc.php';
/*print_r($laboratorio);
print_r ($_GET); */?>
<div class="block2">
<table class="cedula" width="100%" border="0" cellpadding="5">
                        <tr>
                          <th colspan="6" class="titulo"><?php echo $laboratorio['division'];  ?></th>
                        </tr>
                        <tr>
                          <th colspan="6" class="titulo"><?php  echo $laboratorio['depa']; ?></th>
                        </tr>
                                                <tr>
                          <td colspan="6" ><?php  echo '&nbsp;'; ?></td>
                        </tr>
                        <tr>
                          <td colspan="6" ><?php  echo '&nbsp;'; ?></td>
                        </tr>
                        <tr>
                          <td colspan="6"><?php  echo "&nbsp;"; ?></td>
                        </tr>
                        <tr align="left">
                          <td colspan="2" class="name">Nombre del espacio o área:</td>
                          <td colspan="4"><h4><?php echo $laboratorio['laboratorio'];?></h4></td>
                        </tr>
                        <tr align="left">
                          <td colspan="2" class="name">&nbsp;</td>
                          <td colspan="4">&nbsp;</td>
                        </tr>
                        <tr align="left" class="seccion">
                          <td colspan="2" class="name">Responsable: </td>
                          <td colspan="4"><?php echo $lab->getResplab($_GET['lab']);?></td>
                        </tr>
                        <tr align="left" class="seccion">
                          <td class="name">Correo electrónico: </td>
                          <td ><?php echo $laboratorio['email'];?></td>
                          <td width="6%" class="name">Teléfonos: </td>
                          <td width="10%"><?php echo $laboratorio['tel1'];?><br /><?php echo $laboratorio['tel2'];?></td>
                          <td width="6%" class="name">ext: </td>
                          <td width="38%" ><?php echo $laboratorio['ext']; ?></td>
                        </tr>
                         <tr align="left" class="seccion"><?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'];?>
                          <td colspan="6" style="text-align:right">
                          <form action="<?php echo $action1; ?>" method="get" name="usredita">
                          <?php if ($_SESSION['tipo_usuario']==1){?><input type="submit" name="editardp" value="Editar"/> <?php }?>
                          <input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
						  <input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
                          <input name="idusr" type="hidden" value="<?php echo $_SESSION['id_usuario']; ?>" />
                          </form>
                          </td>
                        </tr>
                        <tr align="left">
                           <td colspan="6">&nbsp;</td>
    </tr>
                        <tr align="left">
                          <th colspan="6" class="titulo"></hr>
                          Ubicación y actividades generales</th>
                        </tr>
                        <tr align="left">
                          <td width="15%" class="name">Edificio:</td>
                          <td width="25%" ><?php  echo $laboratorio['edif'];?></td>
                          <td colspan="2" class="name">Detalle de ubicación:&nbsp;</td>
                          <td colspan="2" ><?php echo $laboratorio['ubica'];?></td>
                        </tr>
                        <tr align="left">
                          <td colspan="2" class="name">Direcci&oacute;n postal: &nbsp;</td>
                          <td colspan="4"><?php  echo $laboratorio['postal']; ?></td>
                        </tr>
                        <tr align="left">
                          <td height="58" colspan="2" class="name"><hr />
                          Actividades generales:</td>
                          <?php  ?>

                          <td colspan="4"><hr />
                        	<?php  if ($lab->getAct($laboratorio['act_generales'],'doc')==2){$d='checked="checked"';}?>
                           	<?php  if ($lab->getAct($laboratorio['act_generales'],'inv')==3){$i='checked="checked"';}?>
							<?php  if ($lab->getAct($laboratorio['act_generales'],'abi')==5){$a='checked="checked"';}?>


                          <input type="checkbox" disabled="disabled" <?php echo $d;?> />&nbsp;Docencia&nbsp;&nbsp;&nbsp;
                          <input type="checkbox" disabled="disabled" <?php echo $i?> />&nbsp;Investigaci&oacute;n&nbsp;&nbsp;&nbsp;
                          <input type="checkbox" disabled="disabled" <?php echo $a;?> />&nbsp;Abierto</td>
                        
                        </tr>
                         <tr align="left">
                          <th colspan="6">Servicio</th>
                        </tr>
                        <tr align="left">
                           <td colspan="2" class="name">Capacidad máxima del área (alumnos, académicos, administrativos): <?php  echo $laboratorio['capacidad'];?></td>
                           <td colspan="4" class="name">&nbsp;</td>
                      </tr>
                        <tr align="left">
                          <td colspan="2" class="name">&nbsp;</td>
                          <td colspan="4" class="name">&nbsp;</td>
                        </tr>
                        <tr align="left">
                          <td colspan="2" class="name">Carreras</td>
                          <td colspan="4" class="name">Asignaturas</td>
                        </tr>
                        <tr align="center">
                          <td colspan="2" style="border:1px solid; padding:5px 5px 5px 5px;"><?php  echo $laboratorio['carreras']; ?></td>
                          <td colspan="4" style="border:1px solid; padding:5px 5px 5px 5px;"><?php  echo $laboratorio['asignaturas'];?></td>
                        </tr>
                        	<tr align="right">
                        		<td colspan='6'><p>&nbsp;</p></td>
                        	</tr>
                        <?php if($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==2 || $_SESSION['tipo_usuario']==9){ ?>
                        	<tr align="right">
							<?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'];?>
                          <td colspan="6" style="text-align:right">
                          <form action="<?php echo $action1; ?>" method="post" name="cededita"><input type="submit" name="editarced" value="Editar"/>
                          <input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
						  <input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />

							<?php 
							foreach($laboratorio as $campo=>$valor){ ?>
							<input name="<?php echo $campo ?>" type="hidden" value="<?php echo $valor ?>" />
							<?php }?>

                          </form>
                          </td>
                        	</tr>
                        <?php } ?>
  </table>
                    </div>
                    <br>
                    <br>
                    