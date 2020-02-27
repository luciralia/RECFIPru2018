<?php  
//echo 'hace solicitud a editainventario.inc'; print_r($_POST);

require_once('../clases/inventario.class.php');
require_once('../clases/laboratorios.class.php');

$combo = new inventario();
$radial = new inventario();
$cbox = new inventario();
$verifica = new inventario();
$combolab= new laboratorios();


if ($_POST['accionear']=='editarG'){  

//echo 'Valores a editar';
//print_r ($_REQUEST);
//echo 'Valores de session';
//print_r ($_SESSION);
?>


<script type="text/javascript">
function palomeadoCon(){ 
    if(conexion.checked)
        velocidad.disabled=true; 
	    
   else
        velocidad.disabled=false; 

} 
</script>

<form action="../inc/procesainventario.inc.php" method="post" id="formedi" name="form_edita" class="formul"  >

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
        <td><label><input type="text" name="inventario" size="13" value="<?php echo $REQUEST['inventario'];  ?>" disabled="disabled"></label></td>
    </tr>
    <tr>
        <td><label>Marca </label></td>
         <td><input type="text" name="marca" size="20" value="<?php echo $_POST['marca_p'];  ?>" disabled="disabled"  /></label></td>
        
     </tr> 
     <tr>
          <td><label>Modelo</label></td>
          <td><input type="text" name="modelo_p" size="20" value="<?php echo $_POST['modelo_p'];  ?>" disabled="disabled" /></label></td>
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
       
    
        <td><label>Memoria Caché</label></td>
        <td><label><input type="text" name="cache" size="13" value="<?php echo $_POST['cache']; ?>"></label></td>
        <td colspan="1">&nbsp;</td>
        </tr>
        <tr>  
        <td><label>Tipo de video</label></td>
        <td><label><input type="text" name="videotipo" size="13" value="<?php echo $_POST['videotipo'];  ?>" ></label></td>
    
          <td><label>Modelo de video</label></td>
          <td><input type="text" name="modelovideo" size="20" value="<?php echo $_POST['modelovideo'];  ?>" /></label></td>
          <td><label>Memoria de video</label></td>
          <td><input type="text" name="videomem" size="20" value="<?php echo $_POST['videomem'];  ?>"  /></label></td>
          <td colspan="2">&nbsp;</td>
     </tr>
     <tr>
     
         <td><label>Conexión a Internet</label></td>
         <?php  if ( $_POST['conexion']==1 ) { 
	      $checked = 'checked="checked" '; 
         }else {   $checked = ' ';
       }
	   ?>
      <form id="formCon" name="formCon" method="post" action="">
       
         <td ><input type="checkbox" name="conexion" id="conexion"  <?php echo $checked ?>  onChange="palomeadoCon(this);" value="<?php echo $_POST['conexion'];?>"  /> <label for="conexion"></label> </td>
        
          <?php if ($_POST['conexion']==1){ ?>
         <td>  <label for="conexion">Velocidad de la conexión</label></td>
         <td>  <label><input type="text" name="velocidad" size="13" value="<?php echo $_POST['velocidad'];  ?>" /></label></td>
          
     <?php } else  { ?>
	      <td>  <label for="velocidad">Velocidad de la conexión</label></td>
         <td>   <label><input type="text" name="velocidad" size="13" value="<?php echo $_POST['velocidad'];  ?>"  disabled="disabled" / ></label></td>
          
      <?php } ?>
        
          </form>  
          </tr> 
        <td colspan="1">&nbsp;</td>
      </tr>
       
        <tr>
        <td><label>Salida a Internet</label></td>
         <?php if ( $_POST['salida']==1 ) { 
	      $checked = 'checked="checked" '; 
         }else {   $checked = ' ';
       }  ?>  
      <!-- <form id="formSal" name="formSal" method="post" action="">-->
        <td ><input type="checkbox" name="salida" id="salida"  <?php echo $checked ?>  value="<?php echo $_POST['salida'];?>"  /> <label for="salida"></label></td>
         <?php //if ( $_POST['salida']==1 ) { ?>
           <td><label>Velocidad de Internet</label></td>
           <td><label><input type="text" name="velocidadInt" size="13" value="<?php echo $_POST['velocidadInt'];  ?>" / ></label></td>
          
     <?php //} else  { ?>
	     <!--  <td><label>Velocidad de Internet</label></td>
           <td><label><input type="text" name="velocidadInt" size="13" value="<?php echo $_POST['velocidadInt'];  ?>" disabled="disabled" /></label></td>-->
          
      <?php //} ?>
          
      
        <!--</form>-->
        <td colspan="1">&nbsp;</td>
      </tr>
   
     <tr>  
        <td><label>Terminal</label></td>
        <td><label><input type="text" name="terminal" size="13" value="<?php echo $_POST['terminal'];  ?>" ></label></td>
        <td  colspan="1"><label>Criticidad</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label><?php $combo->comboCrit($_POST['criticidad'])?></label>
        &nbsp;</td>
        <td><label>Adquisición</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label><?php $combo->comboAdqu($_POST['adquision'])?></label>
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
