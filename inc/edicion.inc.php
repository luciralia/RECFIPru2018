<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<script type="text/javascript">

function palomeado(){ 
    if(licencia.checked){ 
        licencia_ini.disabled=true; 
	    licencia_fin.disabled=true;
    }else{ 
        licencia_ini.disabled=false; 
	    licencia_fin.disabled=false;
    } 
} 

     function myFunctionFamilia() {
		  var x = document.getElementById("id_familia").value;
		  
          if (document.getElementById("id_familia").value==0){
		  document.getElementById("familia_especificar").disabled = false; // habilitar
		 
		  }
		  else{
			  document.getElementById("familia_especificar").disabled = true; // deshabilitar
		
	      }
	 }
	 function limpia_Onchange() {
          document.getElementById("id_version_sist_oper").value = "";
    }

     function myFunctionMarca() {
		  var x = document.getElementById("id_marca").value;
		  
          if (document.getElementById("id_marca").value==0)
		      document.getElementById("marca_esp").disabled = false; // habilitar
		  else
			  document.getElementById("marca_esp").disabled = true; // deshabilitar
			 
	 }
	 
     function myFunctionMemoria() {
		  var x = document.getElementById("id_tipo_ram").value;
		
          if (document.getElementById("id_tipo_ram").value==0){
		      document.getElementById("ram_especificar").disabled = false; // habilitar
		
		  }
		  else{
			  document.getElementById("ram_especificar").disabled = true; // deshabilitar
			
	      }
	 }
  
	 /*
	 function sumar(valor) {
		 var total = 0;
		 valor = parseInt(valor);
		 document.getElementById('demo8').innerHTML = "Ingreso " + valor;
         total = document.getElementById('arreglo_total').innerHTML;
		  
		 total = (total == null || total == undefined || total == "") ? 0 : total;
		 total = (parseInt(total) + parseInt(valor));
		 document.getElementById('arreglo_total').innerHTML = total;
		// document.getElementById('demo9').innerHTML = "Total " + total;
		
		
//var totalcol = document.querySelector('arreglo_total').innerText;
//var enttotalcol = document.querySelector('input[name="totalcol"]');
//enttotalcol.value = totalcol;

	     } 
		*/ 
		
     function myFunctionTecCom() {
		  var x = document.getElementById("id_tec_com").value;
		 
          if (document.getElementById("id_tec_com").value==0)
		       document.getElementById("tec_com_otro").disabled = false; // habilitar
		  else
			  document.getElementById("tec_com_otro").disabled = true; // deshabilitar
			
	 }
	 
	
		 function calculo()
{
valor1js= parseFloat(document.form.valor1.value);
valor2js = parseFloat(document.form.valor2.value);
resultado=valor1*valor2;


document.form.resultado.value=resultado;
}  

function validaNum(formulario) {
	  
	  /*if ((formulario.descextensa.value.length == 0 )  ){
                    window.alert('Falta información obligatoria');
					//formulario.descextensa.focus();
		return false;
   
	  }*/
		if (isNaN(parseInt(formulario.anos_garantia.value))) {
                    alert('El campo Años de garantía debe ser un número');
                    return false;
                }  
		if (isNaN(parseInt(formulario.anos_garantia.value))) {
			        formulario.anos_garantia.focus();
                    alert('El campo años de garantía debe ser un número');
                    return false;
                }  	
		if (isNaN(parseInt(formulario.cantidad_procesador.value))) {
			         formulario.cantidad_procesador.focus();
                    alert('El campo cantidad procesador debe ser un número');
                    return false;
                }  		
		if (isNaN(parseInt(formulario.nucleos_totales.value))) {
			         formulario.nucleos_totales.focus();
                    alert('El campo núcleos totales debe ser un número');
                    return false;
                }  	
		if (isNaN(parseInt(formulario.nucleos_gpu.value))) {
			         formulario.nucleos_gpu.focus();
                    alert('El campo núcleos totales debe ser un número');
                    return false;
                }  							
		 /* si no hemos detectado fallo devolvemos TRUE */
		 if (isNaN(parseInt(formulario.subtotal_uno.value))) {
			         formulario.subtotal_uno.focus();
                    alert('El campo Subtotal debe ser un número');
                    return false;
                }  
		 if (isNaN(parseInt(formulario.subtotal_dos.value))) {
			        formulario.subtotal_dos.focus();
                    alert('El campo Subtotal debe ser un número');
					
                    return false;
                }  
		 if (isNaN(parseInt(formulario.subtotal_tres.value))) {
			        formulario.subtotal_tres.focus();
                    alert('El campo Subtotal debe ser un número');
					
                    return false;
                }  	
		if (isNaN(parseInt(formulario.subtotal_cuatro.value))) {
			        formulario.subtotal_cuatro.focus();
                    alert('El campo Subtotal debe ser un número');
					
                    return false;
                }  											
                return true;		
				
  }
   
</script>

<?php  
//echo 'hace solicitud a editainventario.inc'; print_r($_POST);
require_once('../clases/inventario.class.php');
require_once('../clases/laboratorios.class.php');

$combo = new inventario();
$radial = new inventario();
$cbox = new inventario();
$verifica = new inventario();
$combolab= new laboratorios();

if ($_POST['accion']=='editar'){  

//echo 'Valores a editar';
//print_r ($_REQUEST);
//echo 'Valores de session';
//print_r ($_SESSION);
?>

<form action="../inc/procesainventario.inc.php" method="post" id="formedi" name="form_edita" class="formul" onsubmit="return validaNum(this);"  >

 <br>  <br> 
          
<table class="formulario"  style="width:100%">
 
<tr><legend align="center"><h3>Equipo de cómputo -Por dispositivo</h3></legend></tr>
 <br> 
   <tr>
      <td><label>Dispositivo:</label> </td>
      <td><label><?php $combo->combodispositivo($_POST['dispositivo_clave'])?></label></td>
   </tr>
   <tr>   
      <td><label>Usuario Final:</label></td>
      <td><label><?php $combo->combousuariofinal($_POST['usuario_final_clave'])?></label></td>
   </tr>
   <tr>
       <td ><label>Descripción Extensa</label></td>
       <td ><label><input type="text" name="descextensa" id="descextensa"size="55" value="<?php  echo $_POST['descextensa'];?>" required></label></td>
    </tr>
     <tr>
        <td ><label>Área</label></td>
         <td ><label><?php $combolab->combolabdiv($_POST['id_lab'],$_SESSION['id_usuario'])?></label></td>
     </tr>   
    </table>
<br />

 <table class="formulario" style="width:100%">
 
  <tr><legend align="center"><h3>Resguardo</h3></legend></tr>
  <br />
   <tr>
      <td ><label>Nombre</label></td>
      <td><label><input type="text" name="nombre_resguardo"  id="nombre_resguardo" size="37"  value="<?php echo $_POST['nombre_resguardo'];?>" required></label></td>
   
      <td ><label>No. Empleado</label></td>
      <td ><label> <input type="text" name="resguardo_no_empleado" id="resguardo_no_empleado"size="10" value="<?php echo $_POST['resguardo_no_empleado'];?>" required ></label></td>
    </tr>
    <tr>
        <td> <label>Modo de Adquisición</label></td>
        <td> <label><?php $combo->comboadq($_POST['id_mod'])?></label></td> 
    </tr>
  </table>
  <br />

 <table class="formulario" style="width:100%">
   <tr ><legend align="center"><h3>Datos del usuario</h3></legend></tr>
  <br />
   <tr>
       <td ><label>Nombre</label></td>
       <td><label><input type="text" name="usuario_nombre" size="37" value="<?php echo $_POST['usuario_nombre'];?>" required ></label></td>
       <td></td>
   </tr>
   <tr>    
       <td><label>Ubicación</label></td>
       <td><label><input type="text" name="usuario_ubicacion" id="usuario_ubicacion"size="60" value="<?php echo $_POST['usuario_ubicacion'];?>" required ></label>   </td>
        
    </tr>
    <tr>
        <td><label>Perfil</label></td>
        <td><label><?php $combo->combousuarioperfil($_POST['usuario_perfil'])?></label></td>
        
        <td><label>Sector</label></td>
        <td><label><?php $combo->combousuariosector($_POST['usuario_sector'])?></label></td>
       
    </tr>   
  </table>
  <br />
  
  <table class="formulario" style="width:100%">
        <tr ><legend align="center"><h3>Información de patrimonio</h3></legend></tr>
   <br />
     <tr>
        <td><label>No.de serie/etiqueta de servicio</label></td>
        <td><label><input name="serie" type="text" id="serie" tabindex="1" size="30" value="<?php echo $_POST['serie'];  ?>" disabled="disabled" ></label></td>
     </tr>
     <tr>
        <td><label>No.Inventario UNAM</label></td>
        <td><label><input type="text" name="bn_clave" size="13" value="<?php echo $_REQUEST['bn_clave']; ?>" disabled="disabled"></label></td>
        <td><label>No.Inventario del Área</label></td>
        <td><label><input type="text" name="inventario" size="13" value="<?php echo $REQUEST['inventario'];  ?>" disabled="disabled"></label></td>
    </tr>
    <tr>
        <td><label>Marca </label></td>
        <td><label><?php $combo->combomarca($_POST['descmarca'])?></label></td>
        <td><label>Otra Marca </label></td>
        <?php
	     if ($_POST['id_marca']==''){  ?>
		 <td><label><input type="text" name="marca_esp" id="marca_esp" size="13" value="<?php echo $_POST['marca_esp'];  ?>" required ></label></td>
        <?php } else {  ?>
         <td><label><input type="text" name="marca_esp" id="marca_esp" size="13" value="<?php echo $_POST['marca_esp'];  ?>" disabled="disabled" ></label></td>
     
	 <?php }  ?>
     </tr> 
     <tr>
          <td><label>Modelo</label>/td>
          <td><input type="text" name="modelo_p" size="20" value="<?php echo $_POST['modelo_p'];  ?>" required ></label></td>
          <td></td><td></td><td></td> <td></td>
     </tr>
     <tr>
         <td><label>Factura</label></td>
         <td><label><input type="text" name="no_factura" size="35" value="<?php echo $_POST['no_factura'];  ?>" ></label></td>
         <td><label>Proveedor</label></td>
         <td><input type="text" name="proveedor_p" size="25" value="<?php echo $_POST['proveedor_p'];  ?>"  ></td>
     </tr>
     <tr>
         <td><label>Años de garantía</label></td>
         <td><label><input type="text" name="anos_garantia" size="20" value="<?php echo $_POST['anos_garantia'];  ?>" ></label></td>
         <td><label>Fecha Factura</label></td>
         <td><label><input name="fecha_factura" type="date" id="fecha_factura" step="1" min="01-01-1985" max="31-12-2030"  value="<?php echo $_POST['fecha_factura']; ?>"   ></label> </td>
     </tr>
   </table>
  <br />
  
   <?php  if ($verifica->verificaTipoEquipo($_POST['dispositivo_clave'])==1 ) {?>
 
    <table class="formulario" style="width:100%">
       <tr><legend align="center"><h3>Información del procesador</h3></legend></tr>
      <br> 
      <tr>
          <td><label>Familia</label></td>
          <td><label><?php $combo->combofamilia($_POST['nombre_familia'])?></label></td>
          <td></td><td ></td> <td ></td><td ></td><td></td>
          <td><label>Especificar</label></td>
     <?php
     if ($_POST['id_familia']==''){  ?>
     
          <td><label><input type="text" name="familia_especificar" id="familia_especificar" size="15" value="<?php echo $_POST['familia_especificar'];  ?>" required ></label></td>
     <?php } else {  ?>
          <td><label><input type="text" name="familia_especificar" id="familia_especificar" size="15" value="<?php echo $_POST['familia_especificar'];  ?>" disabled="disabled"></label></td>
     <?php }  ?> 
        
     </tr>
     <tr>
         <td><label>Modelo</td>
         <td><input type="text" name="modelo_procesador" size="30" value="<?php echo $_POST['modelo_procesador'];  ?>" required ></label></td>
         
    
      </tr>
    <tr>
       <td><label>Cantidad</label> </td>
       <td><label><input name="cantidad_procesador" type="text" id="cantidad_procesador"  tabindex="1" size="5" value="<?php echo $_POST['cantidad_procesador']; ?>"  ></label> </td>
       <td></td><td ></td><td ></td><td></td><td></td>
       <td><label>Núcleos Totales</label></td>
       <td><label><input name="nucleos_totales" type="text" id="nucleos_totales" tabindex="1"  size="5" value="<?php echo $_POST['nucleos_totales']; ?>" ></label> </td>
      
    </tr>
</table>
  <br />
  <table class="formulario" style="width:100%">
  <tr ><legend align="center"><h3>Núcleos GPU</h3></legend></tr>
   <br>   
  <tr>   
    
       <td><label>Cantitad Total 
       <input name="nucleos_gpu" type="text" id="nucleos_gpu" tabindex="1" size="5" value="<?php echo $_POST['nucleos_gpu']; ?>" ></label> </td>
   </tr> 
   
  </table>
  <br />
  
    <table class="formulario" style="width:100%">
      <tr ><legend align="center"><h3>Memoria RAM</h3></legend></tr>
      <br> 
      <tr>
           <td><label>Memoria RAM [GB]</label></td>
           <td><label><?php $combo->combomemoriaram($_POST['cantidad_ram'])?></label></td>
      
          <td> </td> <td> </td>
      
       <td><label>Tipo</label></td>
       <td><label><?php $combo->combotipomemoria($_POST['nombre_tipo_ram'])?></label></td>
    
       <td></td> <td></td>
       
       <td >Especificar</td>
      <?php if ($_POST['id_tipo_ram']==''){  ?>
     
       <td ><label><input type="text" name="ram_especificar" id="ram_especificar" size="15" value="<?php echo $_POST['ram_especificar'];  ?>"  ></label>
       </td><td></td>
       <?php } else {  ?>
       <td ><label><input type="text" name="ram_especificar" id="ram_especificar" size="15" value="<?php echo $_POST['ram_especificar'];  ?>"  disabled="disabled"></label>
       </td><td></td>
       
       
       
      <?php } ?>
      </tr>
  </table>
  <br />
  
   <table class="formulario" style="width:100%">
   <tr><legend align="center"><h3>Almacenamiento</h3></legend></tr>
       <br> 
      <td><legend ><h5>Almacenamiento estándar</h5></legend></td>
   <tr>
      <td><label>Número de elementos</label></td>
      <td><label><?php $combo->comboelementos($_POST['num_elementos_almac'])?></label></td>
     
      <td><label>Tecnología</label></td>
      <td><label><?php $combo->combotecnologia($_POST['nombre_tecnologia'],0)?></label></td>
     
      <td>Capacidad Total [GB]</td>
      <td><label><input name="total_almac" type="text" id="total_almac" tabindex="1" size="7" value="<?php echo $_POST['total_almac']; ?>"  ></label> <td>
     
    </tr>
   <tr>
       <td><h5>Almacenamiento con arreglos de discos duros</h5></td>
   </tr>
   <tr> 
       <td ><label>Arreglos</label></td>
       <td ><label><?php $combo->comboarreglo($_POST['num_arreglos'])?> </label></td>
       <td></td>
   <script>
      function myFunctionArreglos() {
          var x = document.getElementById("id_arreglo").value;
          //document.getElementById("demo").innerHTML = "Seleccionaste: " + x;
		  if (document.getElementById("id_arreglo").value==1){
			  document.getElementById("esquema_uno").disabled = false; // habilitar
		      document.getElementById("tec_uno").disabled = false;
			  document.getElementById("subtotal_uno").disabled = false;
		      document.getElementById("esquema_dos").disabled = true;
			  document.getElementById("tec_dos").disabled = true;
			  document.getElementById("subtotal_dos").disabled = true;
			  document.getElementById("esquema_tres").disabled = true;
			  document.getElementById("tec_tres").disabled = true;
			  document.getElementById("subtotal_tres").disabled = true;
			  document.getElementById("esquema_cuatro").disabled = true;
			  document.getElementById("tec_cuatro").disabled = true;
			  document.getElementById("subtotal_cuatro").disabled = true;
			   
		  }
		  if (document.getElementById("id_arreglo").value==2){
			   document.getElementById("esquema_uno").disabled = false; // habilitar
		       document.getElementById("tec_uno").disabled = false;
			   document.getElementById("subtotal_uno").disabled = false;
		       document.getElementById("esquema_dos").disabled = false;
			   document.getElementById("tec_dos").disabled = false;
			   document.getElementById("subtotal_dos").disabled = false;
			   document.getElementById("esquema_tres").disabled = true;
			   document.getElementById("tec_tres").disabled = true;
			   document.getElementById("subtotal_tres").disabled = true;
			   document.getElementById("esquema_cuatro").disabled = true;
			   document.getElementById("tec_cuatro").disabled = true;
			   document.getElementById("subtotal_cuatro").disabled = true;
			   
		  }
		   if (document.getElementById("id_arreglo").value==3){
			   document.getElementById("esquema_uno").disabled = false; // habilitar
		       document.getElementById("tec_uno").disabled = false;
			   document.getElementById("subtotal_uno").disabled = false;
		       document.getElementById("esquema_dos").disabled = false;
			   document.getElementById("tec_dos").disabled = false;
			   document.getElementById("subtotal_dos").disabled = false;
			   document.getElementById("esquema_tres").disabled = false;
			   document.getElementById("tec_tres").disabled = false;
			   document.getElementById("subtotal_tres").disabled = false;
			   document.getElementById("esquema_cuatro").disabled = true;
			   document.getElementById("tec_cuatro").disabled = true;
			   document.getElementById("subtotal_cuatro").disabled = true;
			   
		  }
		  if (document.getElementById("id_arreglo").value==4){
			   document.getElementById("esquema_uno").disabled = false; // habilitar
		       document.getElementById("tec_uno").disabled = false;
			   document.getElementById("subtotal_uno").disabled = false;
		       document.getElementById("esquema_dos").disabled = false;
			   document.getElementById("tec_dos").disabled = false;
			   document.getElementById("subtotal_dos").disabled = false;
			   document.getElementById("esquema_tres").disabled = false;
			   document.getElementById("tec_tres").disabled = false;
			   document.getElementById("subtotal_tres").disabled = false;
			   document.getElementById("esquema_cuatro").disabled = false;
			   document.getElementById("tec_cuatro").disabled = false;
			   document.getElementById("subtotal_cuatro").disabled = false;
			   
		  }
     }
     </script>
     
     </tr>
  
    
    <?php if ($_POST['num_arreglos']==1){  ?>
   
    <tr>
       
        <td align="center"><label>Esquema</label></td>
        <td><label><?php $combo->comboesquema($_POST['esquema_uno'],1)?></label></td>
        <td><label>Tecnología</label></td>
        <td><label><?php $combo->combotecnologia($_POST['tec_uno'],1)?></label></td>
        <td><label>Subtotal [GB]</label></td>
        <td><label><input name="subtotal_uno" type="text" id="subtotal_uno" tabindex="1"  size="7" onChange="sumar(this.value);" value="<?php echo $_POST['subtotal_uno']; ?>" ></label> </td>
    </tr>
    <tr>
        
          <td align="center"><label>Esquema</label></td>
        <td><label> <?php $combo->comboesquemades($_POST['esquema_dos'],2)?></label> </td>    
        <td><label>Tecnología</label></td>
        <td><label> <?php $combo->combotecnologiades($_POST['tec_dos'],2)?></label> </td>
        <td><label>Subtotal [GB]</label></td>
        <td><label><input name="subtotal_dos" type="text" id="subtotal_dos" tabindex="1" size="7" onChange="sumar(this.value);" value="<?php echo $_POST['subtotal_dos']; ?>" disabled="disabled" > </label></td>
    </tr>
    <tr>
       
        <td align="center"><label>Esquema</label></td>
       <td><label><?php $combo->comboesquemades($_POST['esquema_tres'],3)?></label></td>
       <td><label>Tecnología</label></td>
       <td><label><?php $combo->combotecnologiades($_POST['tec_tres'],3)?></label></td>
       <td><label>Subtotal [GB]</td></label>
       <td ><label><input name="subtotal_tres" type="text" id="subtotal_tres" tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_tres']; ?>" disabled="disabled" ></label> </td>
    </tr>
    <tr>
        
         <td align="center"><label>Esquema</label></td>
        <td><label> <?php $combo->comboesquemades($_POST['esquema_cuatro'],4)?></label></td>
        <td><label>>Tecnología</label></td>
        <td><label><?php $combo->combotecnologiades($_POST['tec_cuatro'],4)?></label></td>
        <td><label>Subtotal [GB]</label></td>
        <td><label><input name="subtotal_cuatro" type="text" id="subtotal_cuatro" tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_cuatro']; ?>" disabled="disabled"   ></label> </td>
     </tr>
   <?php  } ?>
   <?php if ($_POST['num_arreglos']==2){  ?>
   
    <tr>
       
        <td align="center"><label>Esquema</label></td>
        <td><label><?php $combo->comboesquema($_POST['esquema_uno'],1)?></label></td>
        <td><label>Tecnología</label></td>
        <td><label><?php $combo->combotecnologia($_POST['tec_uno'],1)?></label></td>
        <td>Subtotal [GB]</label></td>
        <td><label><input name="subtotal_uno" type="text" id="subtotal_uno"  tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_uno']; ?>" > </label></td>
    </tr>
    <tr>
        <td align="center"><label>Esquema</label></td>
        <td><label><?php $combo->comboesquema($_POST['esquema_dos'],2)?></label> </td>    
        <td><label>Tecnología</td>
        <td><label> <?php $combo->combotecnologia($_POST['tec_dos'],2)?></label> </td>
        <td><label>Subtotal [GB]</label></td>
        <td><label><input name="subtotal_dos" type="text" id="subtotal_dos"  tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_dos']; ?>"  ></label> </td>
    </tr>
    <tr>
       
        <td align="center"><label>Esquema</label></td>
        <td><label><?php $combo->comboesquemades($_POST['esquema_tres'],3)?></label></td>
        <td><label>Tecnología</label></td>
        <td><label><?php $combo->combotecnologiades($_POST['tec_tres'],3)?></label></td>
        <td><label>Subtotal [GB]</label></td>
        <td><label><input name="subtotal_tres" type="text" id="subtotal_tres" tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_tres']; ?>"   disabled="disabled" ></label> </td>
    </tr>
    <tr>
        
       <td align="center"><label>Esquema</label></td>
        <td><label><?php $combo->comboesquemades($_POST['esquema_cuatro'],4)?> </td>
        <td><label>Tecnología</td>
        <td><label><?php $combo->combotecnologiades($_POST['tec_cuatro'],4)?></td>
        <td><label>Subtotal [GB]</td>
        <td><label><input name="subtotal_cuatro" type="text" id="subtotal_cuatro" tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_cuatro']; ?>"  disabled="disabled" > </td>
     </tr>
     <?php  } ?>
     <?php if ($_POST['num_arreglos']==3){  ?>
     <tr>
         
         <td align="center"><label>Esquema</label></td>
         <td><label><?php $combo->comboesquema($_POST['esquema_uno'],1)?></label></td>
         <td><label>Tecnología</label></td>
         <td><label><?php $combo->combotecnologia($_POST['tec_uno'],1)?></label></td>
         <td><label>Subtotal [GB]</label></td>
         <td><label><input name="subtotal_uno" type="text" id="subtotal_uno"  tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_uno']; ?>" ></label> </td>
    </tr>
    <tr>
        
        <td align="center"><label>Esquema</label></td>
        <td><label><?php $combo->comboesquema($_POST['esquema_dos'],2)?></label> </td>    
        <td><label>Tecnología</label></td>
        <td><label><?php $combo->combotecnologia($_POST['tec_dos'],2)?></label></td>
        <td><label>Subtotal [GB]</label></td>
        <td><label><input name="subtotal_dos" type="text" id="subtotal_dos"  tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_dos']; ?>"  ></label> </td>
    </tr>
    <tr>
     
        <td align="center"><label>Esquema</label></td>
        <td><label><?php $combo->comboesquema($_POST['esquema_tres'],3)?></label></td>
        <td><label>Tecnología</label></td>
        <td><label><?php $combo->combotecnologia($_POST['tec_tres'],3)?></label></td>
        <td><label>Subtotal [GB]</label></td>
        <td><label><input name="subtotal_tres" type="text" id="subtotal_tres"  tabindex="1" size="7" onChange="sumar(this.value)"  value="<?php echo $_POST['subtotal_tres']; ?>" ></label> </td>
    </tr>
    <tr>
        
        <td align="center"><label>Esquema</label></td>
        <td><label><?php $combo->comboesquemades($_POST['esquema_cuatro'],4)?></label></td>
        <td><label>Tecnología</label></td>
        <td<label>><?php $combo->combotecnologiades($_POST['tec_cuatro'],4)?></label></td>
        <td><label>Subtotal [GB]</label></td>
        <td><input name="subtotal_cuatro" type="text" id="subtotal_cuatro" tabindex="1" size="7" onChange="sumar(this.value);"  value="<?php echo $_POST['subtotal_cuatro']; ?>"  disabled="disabled"  ></label> </td>
   </tr>
   <?php } ?>
   <?php if ($_POST['num_arreglos']==4){  ?>
   
    <tr>
        
       <td align="center"><label>Esquema</label></td>
        <td><label><?php $combo->comboesquema($_POST['esquema_uno'],1)?></label></td>
        <td><label>Tecnología</label></td>
        <td><label><?php $combo->combotecnologia($_POST['tec_uno'],1)?></label></td>
        <td><label>Subtotal [GB]</label></td>
        <td><label><input name="subtotal_uno" type="text" id="subtotal_uno" pattern="[0-9]" tabindex="1" size="7" onChange="sumar(this.value);" value="<?php echo $_POST['subtotal_uno']; ?>" ></label> </td>
    </tr>
    <tr>
        
        <td><label>Esquema</label></td>
        <td><label><?php $combo->comboesquema($_POST['esquema_dos'],2)?></label> </td>    
        <td><label>Tecnología</label></td>
        <td><label><?php $combo->combotecnologia($_POST['tec_dos'],2)?></label></td>
        <td><label>Subtotal [GB]</td>
        <td><<label>input name="subtotal_dos" type="text" id="subtotal_dos"  tabindex="1" size="7" onChange="sumar(this.value);"  value="<?php echo $_POST['subtotal_dos']; ?>"  ></label> </td>
    </tr>
    <tr>
        
        <td align="center"><label>Esquema</label></td>
        <td><label><?php $combo->comboesquema($_POST['esquema_tres'],3)?></label></td>
        <td><label>Tecnología</label></td>
        <td><label><?php $combo->combotecnologia($_POST['tec_tres'],3)?></label></td>
        <td><label>Subtotal [GB]</label></td>
        <td><label><input name="subtotal_tres" type="text" id="subtotal_tres"  tabindex="1" size="7" onChange="sumar(this.value);" value="<?php echo $_POST['subtotal_tres']; ?>"   ></label> </td>
    </tr>
    <tr>
        <td align="center"><label>Esquema</label></td>
        
        <td><label><?php $combo->comboesquema($_POST['esquema_cuatro'],4)?></label></td>
        <td><label>Tecnología</label></td>
        <td><label><?php $combo->combotecnologia($_POST['tec_cuatro'],4)?></label></td>
        <td><label>Subtotal [GB]</label></td>
        <td><label><input name="subtotal_cuatro" type="text" id="subtotal_cuatro"  tabindex="1" size="7" onChange="sumar(this.value);" value="<?php echo $_POST['subtotal_cuatro']; ?>"   ></label> </td>
   </tr> 
   <?php } ?>
 <!--   <p id="demo8" /p>
    <p id="demo9" /p>
    <span>El resultado es: </span> <span id="arreglo_total"></span>
    <form id="formulario_suma" method="POST" action="../inc/editainventario.inc.php">
      <span id="arreglo_total" >el resultado es </span>
      <input type="text" name="arreglo_total" id="arreglo_total"  value="0" <?php //echo $_POST['arreglo_total']; ?> />
      <!--  <input type="textbox" type="submit" id="btn_si" name="btn_si" value="arreglo_total"/>-->
<!--</form>

 align="right"
 
 -->
 <tr>
    
     <td></td>
     <td></td>
     <td></td>
     <td></td>
     <td><label>Capacidad Total [GB]</label></td>
     <td><label><input name="arreglo_total"  id="arreglo_total" tabindex="1" size="7" value="<?php echo $_POST['arreglo_total']; ?>" disabled="disabled"/></label></td>
     <td></td><td></td><td></td>
  </tr> 
 </table>
 <br />
 <table class="formulario" style="width:100%">
  <tr><legend align="center"><h3>Conectividad</h3></legend></tr>
      <br> 
  <tr>   
      <td><label>Tecnología de comunicación </td>
      <td><label><?php $combo->combotecom($_POST['tec_com'])?></td>
      <td></td><td></td><td></td><td></td><td></td><td></td>
    
       <td><label>Otra </td>
  
      <?php if ($_POST['id_tec_com']=='0'){  ?>
       <td ><label><input name="tec_com_otro" type="text" id="tec_com_otro"   tabindex="1" size="15" value="<?php echo $_POST['tec_com_otro']; ?>" required > </td>
    
    <?php } else{ ?>
      <td ><label><input name="tec_com_otro" type="text" id="tec_com_otro" tabindex="1" size="15" value="<?php echo $_POST['tec_com_otro']; ?>" disabled="disabled">  </td>
    <?php } ?>
      <td></td><td></td><td></td>
  </tr>
</table>
  <br />
  <table class="formulario" style="width:100%">
 
    <tr><legend align="center"><h3>Plataforma</h3></legend></tr>
      <br> 
    <tr>   
        <td><label>Sistema Operativo</label></td>
        <td><label><?php $combo->combosistemao($_POST['nombre_so'])?></label></td>
        <td><label>Versión </label></td>
     <?php if ($_POST['version_sist_oper']=='' ) { ?>
    <td><label><input name="version_sist_oper" type="text" id="id_version_sist_oper" tabindex="1" size="30"  value="<?php echo $_POST['so']; ?>"  required  ></label>< </td>
     <?php } else {?>
     <td><label><input name="version_sist_oper" type="text" id="id_version_sist_oper" tabindex="1" size="30"  value="<?php echo $_POST['version_sist_oper']; ?>"  required ></label> </td>
   <?php } ?>
    </tr>
    <tr>
    
    <?php if ( $_POST['licencia']==1 ) { 
	   $checked = 'checked="checked" '; 
       }else {   $checked = ' ';
    }?>
	
    <form id="form1" name="form1" method="post" action="">
    <!-- <td >  <input type="checkbox" name="licencia" id="licencia" onChange="palomeado(this);" value="<?php //echo $lic;?>"  /></td>-->
         <td ><input type="checkbox" name="licencia" id="licencia"  <?php echo $checked ?> onChange="palomeado(this);" value="<?php echo $_POST['licencia'];?>"  /> <label for="licencia"></label>
     
        <label for="licencia"><strong>Licencia Permanente</strong></label></td>
     
       <?php if ( $_POST['licencia']==1 ) { ?>
         <td>  <label for="licencia_ini">Inicia</label></td>
         <td>  <label><input type="date" name="licencia_ini" id="licencia_ini"  value="<?php echo $_POST['licencia_ini']; ?>" disabled="disabled"/></label></td>
          <td>  <label for="licencia_fin">Termina</label></td>
          <td>  <label><input type="date" name="licencia_fin" id="licencia_fin" value="<?php echo $_POST['licencia_fin']; ?>" disabled="disabled"/></label></td>
     <?php } else { ?>
	      <td>  <label for="licencia_ini">Inicia</label></td>
          <td>  <label><input type="date" name="licencia_ini" id="licencia_ini" min="01-01-1985" max="31-12-2030" value="<?php echo $_POST['licencia_ini']; ?>" /></label></td>
          <td>  <label for="licencia_fin">Termina</label></td>
          <td>  <label><input type="date" name="licencia_fin" id="licencia_fin" min="01-01-1985" max="31-12-2030" value="<?php echo $_POST['licencia_fin']; ?>" /></label></td>	
      <?php } ?>
      </form>
 </tr>
  
  <tr>  

     <td colspan="2" align="left">Equipo alto rendimiento</td>
     <td ><?php $radial->radialtorendimiento($_POST['equipoaltorend'])?></td>
     <td  align="left" >Arquitectura</td>
     <td ><?php $radial->radialarquitectura($_POST['arquitectura'])?></td>
   </tr>
   <tr>
        <td colspan="2" align="left "><font color="blue">Servidor</font></td>
        <td ><font color="blue"><?php $radial->radialservidor($_POST['servidor'])?></font></td>
        <td >Estado</td>
        <td ><?php $radial->radialestado($_POST['estadobien'])?></td>
   </tr>
   <tr> 
        <td>Tipo tarjeta de video</td>
        <td><input name="tipotarjvideo" type="text" id="tipotarjvideo" tabindex="1" size="7" value="<?php echo $_POST['tipotarjvideo']; ?>"></td>
    
        <td>Modelo de tarjeta de video</td>
        <td><input name="modelotarjvideo" type="text" id="modelotarjvideo" tabindex="1" size="15" value="<?php echo $_POST['modelotarjvideo']; ?>"></td>
        <td>Memoria de video [GB] </td>
        <td><input name="memoriavideo" type="text" id="memoriavideo"  tabindex="1" size="7" value="<?php echo $_POST['memoriavideo']; ?>"></td>
  </tr>
</table>
  <?php } ?>
  <table style="width:100%; align:center;">
   <br/>
   <br/>
  <tr>
       <td colspan="3" align="center">
        <input type="submit" name="accioned" value="Guardar" />
        <input type="reset" name="accione"  value="Limpiar" />
	    <?php  $retorno="../view/inicio.html.php?mod=" . $_REQUEST['mod'] . "&lab=" . $_REQUEST['lab'];?>
	    <input type="button" name="accionec" value="Cancelar" onClick="window.parent.location='<?php echo  $retorno;?>' "/>
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
<!--<input name="bien" type="hidden" value="<?php //echo $_POST['bien']; ?>" />-->
</form>

<?php 

}
?>
