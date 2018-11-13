
<?php  
//echo "solicitud a inventario.inc: "; 
//print_r($_REQUEST);
if ($_REQUEST['accion']=='buscar'||$_REQUEST['bbuscar']=='Buscar'|| $_REQUEST['accion']=='buscarg' || $_REQUEST['bbuscarg']=='Buscar') 
				{ //echo 'buscar en invgen';
				require_once('buscarinv.inc.php');} 
				else if ( $_REQUEST['lab']==NULL || !isset($_REQUEST['lab']))
				{//echo 'buscar en invgensin';
				require_once('cargainvent.inc.php');}
			    else if (!isset($_REQUEST['accion']) || $_REQUEST['accion']=='')
				{require_once('cargainvent.inc.php');} 
			    else if ($_REQUEST['accion']=='editar') 
				{require_once('editainventario.inc.php');}
				else if ($_REQUEST['accion']=='nuevo') 
				{require_once('editainventario.inc.php');}
             
?>
<!-- <table class="cedula" width="100%" border="0" cellpadding="5">
                        <tr>
                          <th colspan="4"><?php echo $div;  ?></th>
                        </tr>
                        <tr>
                          <th colspan="4"><?php  echo $depa; ?></th>
                        </tr>
                        <tr>
                          <th colspan="4"><?php  echo "&nbsp;"; ?></th>
                        </tr>
                        <tr align="left">
                          <td colspan="2" class="name">Nombre del laboratorio:</td>
                          <td colspan="2"><?php echo $lab;?></td>
                        </tr>
                        <tr align="left">
                          <td colspan="2" class="name">Responsable: </td>
                          <td colspan="2"><?php echo $responsable;?></td>
                        </tr>
                        <tr align="left">
                          <td colspan="2" class="name">Correo electrónico:<?php echo $email;?></td>
                          <td width="31%">Teléfonos: <?php echo $tel1;?></td>
                          <td width="29%">ext: <?php echo $ext; ?></td>
                        </tr>
                        <tr align="left">
                          <th colspan="4"><hr />
                          Ubicación</th>
                        </tr>
                        <tr align="left">
                          <td width="11%" class="name"><strong>Edificio:</strong></td>
                          <td width="29%" class="name"><?php  echo $edif;?></td>
                          <td colspan="2"><strong>Detalle de ubicación:</strong> <?php echo $ubica;?></td>
                        </tr>
                        <tr align="left">
                          <td colspan="2" class="name"><strong>Direcci&oacute;n postal:</strong></td>
                          <td colspan="2"><?php  echo $postal; ?></td>
                        </tr>
                        <tr align="left">
                          <td height="58" colspan="2" class="name"><hr />
                          Actividades generales:</td>
                          <?php  ?>
                          <td colspan="2"><hr />
                          <input type="checkbox" disabled="disabled" <?php $c=$act['D']==true?"checked":""; echo $c;?> />&nbsp;Docencia&nbsp;&nbsp;&nbsp;
                          <input type="checkbox" disabled="disabled" <?php $c=$act['I']==true?"checked":""; echo $c;?> />&nbsp;Investigaci&oacute;n&nbsp;&nbsp;&nbsp;
                          <input type="checkbox" disabled="disabled" <?php $c=$act['A']==true?"checked":""; echo $c;?> />&nbsp;Abierto</td>
                        </tr>
                         <tr align="left">
                          <th colspan="4">Servicio</th>
                        </tr>
                        <tr align="left">
                           <td colspan="2" class="name">Capacidad máxima de alumnos por clase: <?php  echo $capacidad;?></td>
                           <td colspan="2" class="name">&nbsp;</td>
                      </tr>
                        <tr align="left">
                          <td colspan="2" class="name">&nbsp;</td>
                          <td colspan="2" class="name">&nbsp;</td>
                        </tr>
                        <tr align="left">
                          <td colspan="2" class="name">Carreras</td>
                          <td colspan="2" class="name">Asignaturas</td>
                        </tr>
                        <tr align="center">
                          <td colspan="2" style="border:1px solid; padding:5px 5px 5px 5px;"><?php   ?></td>
                          <td colspan="2" style="border:1px solid; padding:5px 5px 5px 5px;"><?php  ?></td>
                        </tr>
                        <?php if($_SESSION['permisos'][2] % 3 == 0){ ?>
                        	<tr align="right">
                        		<td colspan='4'><a href="#datos" onClick="javascript:editLabDatos();">Editar</a></td>
                        	</tr>
                        <?php } ?>
                    </table> -->