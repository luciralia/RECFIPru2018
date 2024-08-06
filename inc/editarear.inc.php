<script type="text/javascript">
function palomeadoCon(){ 
    if(conexion.checked)
        velocidad.disabled=true; 
	 else
        velocidad.disabled=false; 
} 
function palomeadoSal(){ 
    if(salida.checked) 
        velocidadint.disabled=true; 
	else
        velocidadint.disabled=false; 
} 

function validaNum(formulario) {
	
		if (isNaN(parseInt(formulario.num_dd.value))) {
                    alert('El campo número de disco duro debe ser un número');
                    return false;
                }  
}

</script>
<?php 
require_once('../clases/inventario.class.php');


$combo = new inventario();
$radial = new inventario();

//echo 'Valores a editar de inventario';
//print_r ($_REQUEST);


//echo 'Valores de session';
//print_r ($_SESSION);

if ($_REQUEST['accion']=='editarAR'){  
require_once('../conexion.php');

$query="select * from dispositivo d
        join equipoarendimiento ear
		on d.id_dispositivo=ear.id_dispositivo
		Where d.inventario='". $_REQUEST['inv']."'";
		
$datos = pg_query($con,$query);		

	while ($inventAR = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
	   //  print_r($inventAR);
?>




<form action="../inc/procesainventario.inc.php" method="post" id="formedi" name="form_edita" class="formul" onsubmit="return validaNum(this);"  >

 <br>  <br> 
          
 <table class="formulario" style="width:100%">
        <tr ><legend align="center"><h3>Información de Equipo </h3></legend></tr>
   <br/>
     <tr>
        <td><label>No.de serie/etiqueta de servicio</label></td>
        <td><label><input name="serie" type="text" id="serie" tabindex="1" size="30" value="<?php echo $inventAR['serie'];  ?>" disabled="disabled" / ></label></td>
     </tr>
     <tr>
        <td><label>No.Inventario UNAM</label></td>
        <td><label><input type="text" name="bn_clave" size="13" value="<?php echo $inventAR['bn_clave']; ?>" disabled="disabled" /></label></td>
        <td colspan="1">&nbsp;</td>
        <td><label>No.Inventario del Área</label></td>
        <td><label><input type="text" name="inventario" size="13" value="<?php echo $inventAR['inventario'];  ?>" disabled="disabled"></label></td>
    </tr>
    <tr>
        <td><label>Marca </label></td>
         <td><label><input type="text" name="marca" size="20" value="<?php echo $inventAR['marca_p'];  ?>" disabled="disabled"  /></label></td>
        
     </tr> 
     <tr>
          <td><label>Modelo</label></td>
          <td><label><input type="text" name="modelo_p" size="20" value="<?php echo $inventAR['modelo_p'];  ?>" disabled="disabled" /></label></td>
          <td colspan="2">&nbsp;</td>
     </tr>
     
   </table>
  <br />
<br />

<table class="formulario" style="width:100%">
        <tr ><legend align="center"><h3>Características de Equipo </h3></legend></tr>
   <br/>
     <tr>
         <td><label>Clúster</label></td>
         <?php if ( $inventAR['cluster']==1 ) { 
	         $checked = 'checked="checked" '; 
           }else {   $checked = ' ';
         }
	    ?>
 
        <td ><label><input type="checkbox" name="cluster" id="cluster"  <?php echo $checked ?>   value="<?php echo $inventAR['cluster'];?>"  /> <label for="cluster"></label> </td>
        </tr>
        <tr><td><legend ><h4>Procesador </h4></legend></td></tr>
        <tr>
           <td><label>Cantidad Procesador</label></td>
           <td><label><input type="text" name="num_proc" size="13" value="<?php echo $inventAR['num_proc']; ?>"></label></td>
           <td><label>Tipo Procesador</label></td>
           <td><label><input type="text" name="tipo_proc" size="13" value="<?php echo $inventAR['tipo_proc']; ?>"></label></td>
        </tr>
        <tr>
           <td><label>Velocidad Procesador</label></td>
           <td><label><input type="text" name="vel_proc" size="13" value="<?php echo $inventAR['vel_proc']; ?>"></label></td>
           <td><label>Memoria Caché</label></td>
           <td><label><input type="text" name="cache" size="13" value="<?php echo $inventAR['cache']; ?>"></label></td>
        </tr>
        <tr><td><legend ><h4>RAM </h4></legend></td></tr>
        <tr>  
           <td><label>RAM cantidad</label></td>
           <td><label><input type="text" name="ram_cant" size="13" value="<?php echo $inventAR['ram_cant'];  ?>" ></label></td>
           <td><label>RAM tipo</label></td>
            <td><input type="text" name="ram_tipo" size="20" value="<?php echo $inventAR['ram_tipo'];  ?>" /></label></td>
         </tr>
        
         <tr><td><legend ><h4>Video</h4></legend></td></tr>
        <tr>  
           <td><label>Tipo de video</label></td>
           <td><label><input type="text" name="videotipo" size="13" value="<?php echo $inventAR['videotipo'];  ?>" ></label></td>
           <td><label>Modelo de video</label></td>
           <td><input type="text" name="modelovideo" size="20" value="<?php echo $inventAR['modelovideo'];  ?>" /></label></td>
        </tr>
        <tr>  
          <td><label>Memoria de video</label></td>
          <td><label><input type="text" name="videomem" size="20" value="<?php echo $inventAR['videomem'];  ?>"  /></label></td>
          <td colspan="2">&nbsp;</td>
       </tr>
      <tr>  
           <tr><td><legend ><h4>Disco Duro </h4></legend></td></tr>
           <td><label>Número de DD</label></td>
           <td><label><input type="text" name="num_dd" size="13" value="<?php echo $inventAR['num_dd'];  ?>" ></label></td>
           <td><label>Interfaz</label></td>
           <td><label><input type="text" name="interf_dd" size="20" value="<?php echo $inventAR['interf_dd'];  ?>" /></label></td>
      </tr>
      <tr>  
           <td><label>Capacidad de DD</label></td>
           <td><label><input type="text" name="cap_dd" size="13" value="<?php echo $inventAR['cap_dd'];  ?>" ></label></td>
           <td><label>Capacidad Secundaria</label></td>
            <td><label><input type="text" name="cap_sec" size="20" value="<?php echo $inventAR['cap_sec'];  ?>" /></label></td>
        </tr>
        <tr><td><legend ><h4>Conexiones</h4></legend></td></tr>
     <tr>
     
         <td><label>Conexión a Internet</label></td>
         <?php  if ( $inventAR['conexion']==1 ) { 
	         $checked = 'checked="checked" '; 
         }else {   $checked = ' ';
       }
	   ?>
      <form id="formCon" name="formCon" method="post" action="">
       
         <td ><label><input type="checkbox" name="conexion" id="conexion"  <?php echo $checked ?>  onChange="palomeadoCon(this);" value="<?php echo $inventAR['conexion'];?>"  /> <label for="conexion"></label></td> 
        
          <?php if ($inventAR['conexion']==1){ ?>
            <td><label for="velocidad">Velocidad de la conexión</label></td>
            <td><label><input type="text" name="velocidad" size="13" value="<?php echo $inventAR['velocidad']; ?>" /></label></td>
          
          <?php } else  { ?>
	        <td><label for="velocidad">Velocidad de la conexión</label></td>
            <td><label><input type="text" name="velocidad" size="13" value="<?php echo $inventAR['velocidad']; ?>"  disabled="disabled" / ></label></td>
          
        <?php } ?>
        
          </form>  
     </tr>
      
        <tr>
        <td><label>Salida a Internet</label></td>
         <?php if ( $inventAR['salida']==1 ) { 
	         $checked = 'checked="checked" '; 
         }else {   $checked = ' ';
       }  ?>  
       <!--<form id="formSal" name="formSal" method="post" action="">-->
        <td><label><input type="checkbox" name="salida" id="salida"  <?php echo $checked ?>  onChange="palomeadoSal(this);" value="<?php echo $inventAR['salida'];?>"  /> <label for="salida"></label></td>
         <?php //if ( $inventAR['salida']==1 ) { ?>
           <td><label for="velocidadint">Velocidad de Internet</label></td>
           <td><label><input type="text" name="velocidadint" size="13" value="<?php echo $inventAR['velocidadint'];  ?>" / ></label></td>
          
     <?php //} else  { ?>
	   <!-- <td ><label for="salida">Velocidad de Internet</label></td>
           <td><label><input type="text" name="velocidadint" size="13" value="<?php //echo $inventAR['velocidadint'];  ?>" disabled="disabled" /></label></td> -->
          
      <?php //} ?>
        
        <!--</form>-->
     
      </tr>
        <tr><td><legend ><h4>Principal utilización</h4></legend></td></tr>
     <tr> 
      
        <td><label>Uso</label></td>
        <td><label><input type="text" name="uso" size="20" value="<?php echo $inventAR['uso'];  ?>" ></label></td>
      </tr>
        <tr><td><legend ><h4>Número de equipos a los que da servicio</h4></legend></td></tr>
      <tr>  
        <td><label>Terminales</label></td>
        <td><label><input type="text" name="terminal" size="13" value="<?php echo $inventAR['terminal'];  ?>" ></label></td>
        </tr>
         <tr><td><legend ><h4>Criticidad</h4></legend></td></tr>
        <tr>
         <td  colspan="1"><label>Criticidad</label></td>
           <td> <label> <?php $combo->comboCrit($inventAR['criticidad'])?></label>
        </td>
        </tr>
          <tr><td><legend ><h4>Recursos de Adquisición</h4></legend></td></tr>
          <tr>
        <td  colspan="1"><label>Adquisición</label></td>
           <td> <label><?php $combo->comboAdqu($inventAR['adquision'])?></label>
        </td>
     
      
    </tr>
   </table>
   
   <table style="width:100%; align:center;">
   <br/>
   <br/>
  <tr>
       <td colspan="3" align="center">
        <input type="submit" name="accionear" value="Guardar" />
        <input type="reset" name="accionear"  value="Limpiar" />
	    <?php  $retorno="../view/inicio.html.php?mod=" . $_REQUEST['mod'] . "&lab=" . $_REQUEST['lab']."&div=". $_SESSION['id_div'];?>
	    <input type="button" name="accionear" value="Cancelar" onClick="window.parent.location='<?php echo  $retorno;?>' "/>
     </td>
  </tr>    
     </table>
<br/>
<br/>


<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="bn_id" type="hidden" value="<?php echo $_POST['bn_id']; ?>" />

<input name="id_dispositivo" type="hidden" value="<?php echo $inventAR['id_dispositivo']; ?>" />

</form>

<?php   }
		}else
		if ($_REQUEST['accion']=='editarG'){ ?>
	
	<form action="../inc/procesainventario.inc.php" method="post" id="formedi" name="form_edita" class="formul" onsubmit="return validaNum(this);"  >

 <br>  <br> 
          
 <table class="formulario" style="width:100%">
        <tr ><legend align="center"><h3>Información de Equipo </h3></legend></tr>
   <br/>
     <tr>
        <td><label>No.de serie/etiqueta de servicio</label></td>
        <td><label><input name="serie" type="text" id="serie" tabindex="1" size="30" value="<?php echo $_POST['serie'];  ?>" disabled="disabled" / ></label></td>
     </tr>
     <tr>
        <td><label>No.Inventario UNAM</label></td>
        <td><label><input type="text" name="bn_clave" size="13" value="<?php echo $_REQUEST['bn_clave']; ?>" disabled="disabled" /></label></td>
        <td colspan="1">&nbsp;</td>
        <td><label>No.Inventario del Área</label></td>
        <td><label><input type="text" name="inventario" size="13" value="<?php echo $_REQUEST['inventario'];  ?>" disabled="disabled"></label></td>
    </tr>
    <tr>
        <td><label>Marca </label></td>
         <td><label><input type="text" name="marca" size="20" value="<?php echo $_POST['marca_p'];  ?>" disabled="disabled"  /></label></td>
        
     </tr> 
     <tr>
          <td><label>Modelo</label></td>
          <td><label><input type="text" name="modelo_p" size="20" value="<?php echo $_POST['modelo_p'];  ?>" disabled="disabled" /></label></td>
          <td colspan="2">&nbsp;</td>
     </tr>
     
   </table>
  <br />
   
<br />

<table class="formulario" style="width:100%">
        <tr ><legend align="center"><h3>Características de Equipo </h3></legend></tr>
   <br/>
     <tr>
        <td><label>Clúster</label></td>
        <?php if ( $_POST['cluster']==1 ) { 
	      $checked = 'checked="checked" '; 
         }else {   $checked = ' ';
       }
	   ?>
 
       
          <td ><input type="checkbox" name="cluster" id="cluster"  <?php echo $checked ?>   value="<?php echo $_POST['cluster'];?>"  /> <label for="cluster"></label> </td>
        </tr>
        <tr><td><legend ><h4>Procesador </h4></legend></td></tr>
        <tr>
        <td><label>Cantidad Procesador</label></td>
        <td><label><input type="text" name="num_proc" size="13" value="<?php echo $_POST['num_proc']; ?>"></label></td>
        <td><label>Tipo Procesador</label></td>
        <td><label><input type="text" name="tipo_proc" size="13" value="<?php echo $_POST['tipo_proc']; ?>"></label></td>
        </tr>
        <tr>
        <td><label>Velocidad Procesador</label></td>
        <td><label><input type="text" name="vel_proc" size="13" value="<?php echo $_POST['vel_proc']; ?>"></label></td>
       
        <td><label>Memoria Caché</label></td>
        <td><label><input type="text" name="cache" size="13" value="<?php echo $_POST['cache']; ?>"></label></td>
       
        </tr>
        <tr><td><legend ><h4>RAM</h4></legend></td></tr>
        <tr>  
           <td><label>RAM cantidad</label></td>
           <td><label><input type="text" name="ram_cant" size="13" value="<?php echo $_POST['ram_cant'];  ?>" ></label></td>
           <td><label>RAM tipo</label></td>
            <td><label><input type="text" name="ram_tipo" size="20" value="<?php echo $_POST['ram_tipo'];  ?>" /></label></td>
         </tr>
        
        <tr><td><legend ><h4>Video</h4></legend></td></tr>
       <tr>
        <td><label>Tipo de video</label></td>
        <td><label><input type="text" name="videotipo" size="13" value="<?php echo $_POST['videotipo'];  ?>" ></label></td>
    
          <td><label>Modelo de video</label></td>
          <td><label><input type="text" name="modelovideo" size="20" value="<?php echo $_POST['modelovideo'];  ?>" /></label></td>
       </tr>
       <tr>   
          <td><label>Memoria de video</label></td>
          <td><label><input type="text" name="videomem" size="20" value="<?php echo $_POST['videomem'];  ?>"  /></label></td>
          
     </tr>
      <tr><td><legend ><h4>Disco Duro</h4></legend></td></tr>
     <tr>  
            <td><label>Número de DD</label></td>
            <td><label><input type="text" name="num_dd" size="13" value="<?php echo $_POST['num_dd'];  ?>" ></label></td>
            <td><label>Interfaz</label></td>
            <td><label><input type="text" name="interf_dd" size="20" value="<?php echo $_POST['interf_dd'];  ?>" /></label></td>
         </tr>
      <tr>  
           <td><label>Capacidad de DD</label></td>
           <td><label><input type="text" name="cap_dd" size="13" value="<?php echo $_POST['cap_dd'];  ?>" ></label></td>
           <td><label>Capacidad Secundaria</label></td>
            <td><label><input type="text" name="cap_sec" size="20" value="<?php echo $_POST['cap_sec'];  ?>" /></label></td>
         </tr>
     
      <tr><td><legend ><h4>Conexiones</h4></legend></td></tr>
     <tr>
      <td><label>Conexión a Internet</label></td>
         <?php  if ( $_POST['conexion']==1 ) { 
	      $checked = 'checked="checked" '; 
         }else {   $checked = ' ';
       }
	   ?>
      <form id="formCon" name="formCon" method="post" action="">
       
         <td ><label><input type="checkbox" name="conexion" id="conexion"  <?php echo $checked ?>  onChange="palomeadoCon(this);" value="<?php echo $_POST['conexion'];?>"  /> <label for="conexion"></label> </td>
        
          <?php if ($_POST['conexion']==1){ ?>
         <td><label for="velocidad">Velocidad de la conexión</label></td>
         <td>  <label><input type="text" name="velocidad" size="13" value="<?php echo $_POST['velocidad'];  ?>" /></label></td>
          
     <?php } else  { ?>
	     <td >  <label for="velocidad">Velocidad de la conexión</label></td>
         <td>   <label><input type="text" name="velocidad" size="13" value="<?php echo $_POST['velocidad'];  ?>"  disabled="disabled" / ></label></td>
          
      <?php } ?>
        
          </form>  
          </tr> 
      
        <tr>
        <td><label>Salida a Internet</label></td>
         <?php if ($_POST['salida']==1 ) { 
	      $checked = 'checked="checked" '; 
         }else {   $checked=' ';
       }  ?>  
       <!--<form id="formSal" name="formSal" method="post" action="">-->
        <td><label><input type="checkbox" name="salida" id="salida"  <?php echo $checked ?> onChange="palomeadoSal(this);" value="<?php echo $_POST['salida'];?>" /> <label for="salida"></label></td>
         <?php //if ( $_POST['salida']==1 ) { ?>
           <td><label for="velocidadint">Velocidad de Internet</label></td>
           <td><label><input type="text" name="velocidadint" size="13" value="<?php echo $_POST['velocidadint'];  ?>" / ></label></td>
          
     <?php // } else  { ?>
	        <!--<td><label for="velocidadint">Velocidad de Internet</label></td>
           <td><label><input type="text" name="velocidadint" size="13" value="<?php echo $_POST['velocidadint'];  ?>" disabled="disabled" /></label></td>-->
          
      <?php //} ?>
          
      <!--</form>-->
      </tr>
    <tr><td><legend ><h4>Principal utilización</h4></legend></td></tr>
     <tr> 
      
        <td><label>Uso</label></td>
        <td><label><input type="text" name="uso" size="20" value="<?php echo $_POST['uso'];  ?>" ></label></td>
      </tr>
        <tr><td><legend ><h4>Número de equipos a los que da servicio</h4></legend></td></tr>
      <tr>  
        <td><label>Terminales</label></td>
        <td><label><input type="text" name="terminal" size="13" value="<?php echo $_POST['terminal'];  ?>" ></label></td>
        </tr>
         <tr><td><legend ><h4>Criticidad</h4></legend></td></tr>
        <tr>
         <td  colspan="1"><label>Criticidad</label></td>
           <td> <label> <?php $combo->comboCrit($_POST['criticidad'])?></label>
        </td>
        </tr>
          <tr><td><legend ><h4>Recursos de Adquisición</h4></legend></td></tr>
          <tr>
        <td  colspan="1"><label>Adquisición</label></td>
           <td> <label><?php $combo->comboAdqu($_POST['adquision'])?></label>
        </td>
     
     
    </tr>
   </table>
   
   <table style="width:100%; align:center;">
   <br/>
   <br/>
  <tr>
       <td colspan="3" align="center">
        <input type="submit" name="accionear" value="Guardar" />
        <input type="reset" name="accionear"  value="Limpiar" />
	    <?php  $retorno="../view/inicio.html.php?mod=" . $_REQUEST['mod'] . "&lab=" . $_REQUEST['lab']."&div=". $_SESSION['id_div'];?>
	    <input type="button" name="accionear" value="Cancelar" onClick="window.parent.location='<?php echo  $retorno;?>' "/>
     </td>
  </tr>    
     </table>
<br/>
<br/>


<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="bn_id" type="hidden" value="<?php echo $_POST['bn_id']; ?>" />
<input name="id_equipo" type="hidden" value="<?php echo $_POST['id_equipo']; ?>" />
<input name="id_dispositivo" type="hidden" value="<?php echo $_POST['id_dispositivo']; ?>" />

</form>
	
	
<?php	
}

?>
