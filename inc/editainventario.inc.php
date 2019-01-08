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
$combo = new inventario();
$radial = new inventario();
$cbox = new inventario();
$verifica = new inventario();
$combolab= new laboratorios();

if ($_POST['accion']=='editar'){  

echo 'Valores a editar';
print_r ($_REQUEST);
echo 'Valores de session';
print_r ($_SESSION);
?>

<form action="../inc/procesainventario.inc.php" method="post" name="form_edita" class="formul" onsubmit="return validaNum(this);" >

 <br>  <br> 
          
<table  class="formulario">
 
<tr ><legend align="center"><h3>Equipo de cómputo -Por dispositivo</h3></legend></tr>
 <br> 
   <tr>
      <td  ><label>Dispositivo: </label></td>
      <td ><label><?php $combo->combodispositivo($_POST['dispositivo_clave'])?></label></td>
      <td   ><label>Usuario Final:</label></td>
      
      <td ><label><?php $combo->combousuariofinal($_POST['usuario_final_clave'])?></label></td>
   </tr>
      <tr>
      <td   ><label>Descripción Extensa</label></td>
     <td><label><input type="text" name="descextensa" id="descextensa"size="55" value="<?php  echo $_POST['descextensa'];?>" required></label></td>
      </tr>
       <tr>
        <td   ><label>Área</label></td>
        <td ><label><?php $combolab->combolabdiv($_POST['id_lab'],$_SESSION['id_div'])?></label></td>
    </table>
<br />

 <table cellpadding="5" class="formulario">
 
  <tr ><legend align="center"><h3>Resguardo</h3></legend></tr>
  <br />
   <tr>
   <td   ><label>Nombre</td>
     <td ><input type="text" name="nombre_resguardo"  id="nombre_resguardo" size="37"  value="<?php echo $_POST['nombre_resguardo'];?>" required></label></td>
      
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td>
    </td>
    
  <td>Número de empleado</td>
     <td><input type="text" name="resguardo_no_empleado" id="resguardo_no_empleado"size="10" value="<?php echo $_POST['resguardo_no_empleado'];?>" required ></td>
    </tr>
      <td   >Modo de Adquisición</td>
      <td><?php $combo->comboadq($_POST['id_mod'])?></td> 
    </tr>
  </table>
  <br />

 <table cellpadding="5" class="formulario">
   <tr ><legend align="center"><h3>Datos del usuario</h3></legend></tr>
  <br />
   <tr>
     <td >Nombre</td>
     <td><input type="text" name="usuario_nombre" size="37" value="<?php echo $_POST['usuario_nombre'];?>" required ></td>
       <td ></td><!--<td ></td>-->
      
     <td >Ubicación</td>
     <td><input type="text" name="usuario_ubicacion" id="usuario_ubicacion"size="40" value="<?php echo $_POST['usuario_ubicacion'];?>" required >   </td>
     <td ></td>
    </tr>
    <tr>
  <td  >Perfil</td>
      <td><?php $combo->combousuarioperfil($_POST['usuario_perfil'])?></td>
      <td ></td> 

    <td   >Sector</td>
      <td><?php $combo->combousuariosector($_POST['usuario_sector'])?></td>
     <td ></td>
    </tr>   
 </table>
  <br />
  
 <table cellpadding="5" class="formulario">
   <tr ><legend align="center"><h3>Información de patrimonio</h3></legend></tr>
   <br />
  <tr>
     <td >No.de serie/etiqueta de servicio</td>
     <td  ><input name="serie" type="text" id="serie" tabindex="1" size="30" value="<?php echo $_POST['serie'];  ?>" disabled="disabled" ></td>
   </tr>
   <tr>
    <td  >No.Inventario UNAM</td>
        <td ><input type="text" name="bn_clave" size="13" value="<?php echo $_REQUEST['bn_clave']; ?>" disabled="disabled" ></td>
     
        <td >No.Inventario del Área</td>
        <td ><input type="text" name="inventario" size="13" value="<?php echo $REQUEST['inventario'];  ?>" disabled="disabled"></td>
  
 </tr>
  <tr>
    
     <td  >Marca </td>
     <td><?php $combo->combomarca($_POST['descmarca'])?></td>
     <td><?php //$combo->combomarca($_POST['id_marca'])?></td>
    
     <td   >Otra Marca </td>
      <?php
	 
     if ($_POST['id_marca']==''){  ?>
		
     <td   ><input type="text" name="marca_esp" id="marca_esp" size="13" value="<?php echo $_POST['marca_esp'];  ?>" required ></td>
     <?php } else {  ?>
      
     <td   ><input type="text" name="marca_esp" id="marca_esp" size="13" value="<?php echo $_POST['marca_esp'];  ?>" disabled="disabled" ></td>
     
	 <?php }  ?>
     </tr> 
     <tr>
     <td   >Modelo</td>
     <td ><input type="text" name="modelo_p" size="20" value="<?php echo $_POST['modelo_p'];  ?>" required ></td>
     <td ></td><td ></td><td ></td> <td ></td>
  </tr>
   <tr>
     <td   >Factura</td>
     <td   ><input type="text" name="no_factura" size="40" value="<?php echo $_POST['no_factura'];  ?>" required ></td>
     
     
     <td  >Proveedor</td>
     <td ><input type="text" name="proveedor_p" size="25" value="<?php echo $_POST['proveedor_p'];  ?>" required ></td>
  
  </tr>
 
              
 
  <tr>
     <td   >Años de garantía</td>
     <td   ><input type="text" name="anos_garantia" size="20" value="<?php echo $_POST['anos_garantia'];  ?>" ></td>
     <td >Fecha Factura</td>
     
     <td  ><input name="fecha_factura" type="date" id="fecha_factura" step="1" min="01-01-1985" max="31-12-2030"  value="<?php echo $_POST['fecha_factura']; ?>"  required > </td>
  </tr>
   </table>
  <br />
  
   <?php  if ($verifica->verificaTipoEquipo($_POST['dispositivo_clave'])==1 ) {?>
 
   <table cellpadding="5" class="formulario">
    <tr ><legend align="center"><h3>Información del procesador</h3></legend></tr>
      <br> 
       <tr>
  
   <td  >Familia</td>
   <td><?php $combo->combofamilia($_POST['nombre_familia'])?></td>
  
     <td ></td><td ></td> <td ></td><td ></td><td ></td>
      <td >Especificar otro</td>
      
     <?php
     if ($_POST['id_familia']==''){  ?>
     
     <td   ><input type="text" name="familia_especificar" id="familia_especificar" size="13" value="<?php echo $_POST['familia_especificar'];  ?>" required ></td>
     <?php } else {  ?>
      <td   ><input type="text" name="familia_especificar" id="familia_especificar" size="13" value="<?php echo $_POST['familia_especificar'];  ?>" disabled="disabled"></td>
     <?php }  ?> 
     <td ></td><td ></td><td ></td>
     </tr>
     
     <tr>
     
     <td >Modelo</td>
     <td ><input type="text" name="modelo_procesador" size="30" value="<?php echo $_POST['modelo_procesador'];  ?>" required ></td>
     <td ></td><td ></td><td ></td><td ></td><td ></td><td ></td><td></td><td></td><td ></td>
     <td ></td> <td ></td><td ></td><td ></td><td ></td><td ></td>
    
     
  </tr>
  <tr>
  <td   >Cantidad </td>
    <td  ><input name="cantidad_procesador" type="text" id="cantidad_procesador"  tabindex="1" size="25" value="<?php echo $_POST['cantidad_procesador']; ?>"  > </td>
     <td ></td><td ></td><td ></td><td></td><td></td>
     <td  >Núcleos Totales</td>
    <td  ><input name="nucleos_totales" type="text" id="nucleos_totales" tabindex="1"  size="25" value="<?php echo $_POST['nucleos_totales']; ?>" > </td>
     <td></td><td ></td><td ></td>
    </tr>
</table>
  <br />
 <table cellpadding="5" class="formulario">
  <tr ><legend align="center"><h3>Núcleos GPU</h3></legend></tr>
      <br> 
    <td  >Cantitad Total</td>
    <td  ><input name="nucleos_gpu" type="text" id="nucleos_gpu" tabindex="1" size="25" value="<?php echo $_POST['nucleos_gpu']; ?>" > </td>
    
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    
 
  </table>
  <br />
  
   <table cellpadding="5" class="formulario">
    <tr ><legend align="center"><h3>Memoria RAM</h3></legend></tr>
      <br> 
   <td  >Memoria RAM [GB]</td>
    
   <td><?php $combo->combomemoriaram($_POST['cantidad_ram'])?></td>
    </td>
    
    <td></td> <td></td><td></td> <td></td> <td></td> <td></td><td></td> <td></td> <td></td>
      
       <td   >Tipo</td>
       <td ><?php $combo->combotipomemoria($_POST['nombre_tipo_ram'])?></td>
    
       <td></td> <td></td><td></td> <td></td><td></td><td></td> <td></td> <td></td>
       <td >Especificar otra</td>
      <?php if ($_POST['id_tipo_ram']==''){  ?>
     
       <td ><input type="text" name="ram_especificar" id="ram_especificar" size="7" value="<?php echo $_POST['ram_especificar'];  ?>"  >
       </td><td></td>
       <?php } else {  ?>
       <td ><input type="text" name="ram_especificar" id="ram_especificar" size="7" value="<?php echo $_POST['ram_especificar'];  ?>"  disabled="disabled">
       </td><td></td>
       
       <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> <td></td>
      <?php } ?>
  </table>
  <br />
  
  <table cellpadding="5" class="formulario">
   <tr ><legend align="center"><h3>Almacenamiento</h3></legend></tr>
      <br> 
     <td><legend ><h5>Almacenamiento estándar</h5></legend></td>
 
   <tr>
    <td  >Número de elementos</td>
    
    <td><?php $combo->comboelementos($_POST['num_elementos_almac'])?></td>
    <td></td>
    <td  >Tecnología</td>
    <td ><?php $combo->combotecnologia($_POST['nombre_tecnologia'],0)?></td>
   <td></td> 
    <td >Capacidad Total [GB]</td>
    <td ><input name="total_almac" type="text" id="total_almac" tabindex="1" size="7" value="<?php echo $_POST['total_almac']; ?>"  > <td>
    <td></td><td></td><td></td>
    </tr>
  <tr>
  <td ><h5>Almacenamiento con arreglos de discos duros</h5></td>
  </tr>
  <tr> 
     <td >Arreglos</td>
     <td ><?php $combo->comboarreglo($_POST['num_arreglos'])?> 
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
     </td>
  </tr>
  
     <td></td><td></td><td></td>
    <?php if ($_POST['num_arreglos']==1){  ?>
   
    <tr>
    <td></td><td></td><td></td>
    <td  >Esquema</td>
    <td><?php $combo->comboesquema($_POST['esquema_uno'],1)?></td>
    <td  >Tecnología</td>
    <td><?php $combo->combotecnologia($_POST['tec_uno'],1)?></td>
    
    <td >Subtotal [GB]</td>
    <td><input name="subtotal_uno" type="text" id="subtotal_uno" tabindex="1"  size="7" onChange="sumar(this.value);" value="<?php echo $_POST['subtotal_uno']; ?>" > </td>
    </tr>
    <tr>
    <td></td><td></td><td></td>
    <td   >Esquema</td>
    
    <td> <?php $combo->comboesquemades($_POST['esquema_dos'],2)?> </td>    
    <td   >Tecnología</td>
    <td>  <?php $combo->combotecnologiades($_POST['tec_dos'],2)?> </td>
    
    <td  >Subtotal [GB]</td>
    <td ><input name="subtotal_dos" type="text" id="subtotal_dos" tabindex="1" size="7" onChange="sumar(this.value);" value="<?php echo $_POST['subtotal_dos']; ?>" disabled="disabled" > </td>
    </tr>
    <tr>
    <td></td><td></td><td></td>
    <td  >Esquema</td>
    <td ><?php $combo->comboesquemades($_POST['esquema_tres'],3)?></td>
    <td   >Tecnología</td>
    <td><?php $combo->combotecnologiades($_POST['tec_tres'],3)?></td>
     <td  >Subtotal [GB]</td>
    <td ><input name="subtotal_tres" type="text" id="subtotal_tres" tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_tres']; ?>" disabled="disabled" > </td>
    </tr>
    <tr>
    <td></td><td></td><td></td>
    <td   >Esquema</td>
    <td> <?php $combo->comboesquemades($_POST['esquema_cuatro'],4)?></td>
    <td   >Tecnología</td>
     <td ><?php $combo->combotecnologiades($_POST['tec_cuatro'],4)?></td>
     <td  >Subtotal [GB]</td>
    <td ><input name="subtotal_cuatro" type="text" id="subtotal_cuatro" tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_cuatro']; ?>" disabled="disabled" > </td>
   </tr>
   <?php  } ?>
   <?php if ($_POST['num_arreglos']==2){  ?>
   
    <tr>
    <td></td><td></td><td></td>
    <td   >Esquema</td>
    <td><?php $combo->comboesquema($_POST['esquema_uno'],1)?></td>
    <td  >Tecnología</td>
    <td><?php $combo->combotecnologia($_POST['tec_uno'],1)?></td>
    <td  >Subtotal [GB]</td>
    <td><input name="subtotal_uno" type="text" id="subtotal_uno"  tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_uno']; ?>" > </td>
    </tr>
    <tr>
    <td   >Esquema</td>
    <td></td><td></td><td></td>
    <td ><?php $combo->comboesquema($_POST['esquema_dos'],2)?> </td>    
    <td   >Tecnología</td>
     <td> <?php $combo->combotecnologia($_POST['tec_dos'],2)?> </td>
    <td  >Subtotal [GB]</td>
    <td ><input name="subtotal_dos" type="text" id="subtotal_dos"  tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_dos']; ?>"  > </td>
    </tr>
    <tr>
    <td></td><td></td><td></td>
    <td >Esquema</td>
    <td ><?php $combo->comboesquemades($_POST['esquema_tres'],3)?></td>
    <td  >Tecnología</td>
    <td><?php $combo->combotecnologiades($_POST['tec_tres'],3)?></td>
     <td >Subtotal [GB]</td>
    <td ><input name="subtotal_tres" type="text" id="subtotal_tres" tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_tres']; ?>"   disabled="disabled" > </td>
    </tr>
    <tr>
    <td></td><td></td><td></td>
    <td >Esquema</td>
    <td><?php $combo->comboesquemades($_POST['esquema_cuatro'],4)?> </td>
    <td  >Tecnología</td>
     <td ><?php $combo->combotecnologiades($_POST['tec_cuatro'],4)?></td>
     <td  >Subtotal [GB]</td>
    <td ><input name="subtotal_cuatro" type="text" id="subtotal_cuatro" tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_cuatro']; ?>"  disabled="disabled" > </td>
   </tr>
   <?php  } ?>
   <?php if ($_POST['num_arreglos']==3){  ?>
   
    <tr>
    <td></td><td></td><td></td>
    <td   >Esquema</td>
    <td><?php $combo->comboesquema($_POST['esquema_uno'],1)?></td>
    <td  >Tecnología</td>
    <td><?php $combo->combotecnologia($_POST['tec_uno'],1)?></td>
    <td  >Subtotal [GB]</td>
    <td><input name="subtotal_uno" type="text" id="subtotal_uno"  tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_uno']; ?>" > </td>
    </tr>
    <tr>
    <td></td><td></td><td></td>
    <td  >Esquema</td>
    
    <td><?php $combo->comboesquema($_POST['esquema_dos'],2)?> </td>    
    <td  >Tecnología</td>
    <td><?php $combo->combotecnologia($_POST['tec_dos'],2)?></td>
    <td >Subtotal [GB]</td>
    <td ><input name="subtotal_dos" type="text" id="subtotal_dos"  tabindex="1" size="7" onChange="sumar(this.value)" value="<?php echo $_POST['subtotal_dos']; ?>"  > </td>
    </tr>
    <tr>
    <td></td><td></td><td></td>
    <td  >Esquema</td>
    <td><?php $combo->comboesquema($_POST['esquema_tres'],3)?></td>
    <td  >Tecnología</td>
    <td><?php $combo->combotecnologia($_POST['tec_tres'],3)?></td>
     <td  >Subtotal [GB]</td>
    <td ><input name="subtotal_tres" type="text" id="subtotal_tres"  tabindex="1" size="7" onChange="sumar(this.value)"  value="<?php echo $_POST['subtotal_tres']; ?>" > </td>
    </tr>
    <tr>
    <td></td><td></td><td></td>
    <td >Esquema</td>
    <td><?php $combo->comboesquemades($_POST['esquema_cuatro'],4)?></td>
    <td   >Tecnología</td>
     <td ><?php $combo->combotecnologiades($_POST['tec_cuatro'],4)?></td>
     <td >Subtotal [GB]</td>
    <td ><input name="subtotal_cuatro" type="text" id="subtotal_cuatro" tabindex="1" size="7" onChange="sumar(this.value);"  value="<?php echo $_POST['subtotal_cuatro']; ?>"  disabled="disabled"  > </td>
   </tr>
   <?php } ?>
   <?php if ($_POST['num_arreglos']==4){  ?>
   
    <tr>
    <td></td><td></td><td></td>
    <td  >Esquema</td>
    <td><?php $combo->comboesquema($_POST['esquema_uno'],1)?></td>
    <td  >Tecnología</td>
    <td><?php $combo->combotecnologia($_POST['tec_uno'],1)?></td>
    <td  >Subtotal [GB]</td>
    <td><input name="subtotal_uno" type="text" id="subtotal_uno" pattern="[0-9]" tabindex="1" size="7" onChange="sumar(this.value);" value="<?php echo $_POST['subtotal_uno']; ?>" > </td>
    </tr>
    <tr>
    <td></td><td></td><td></td>
    <td   >Esquema</td>
    
    <td ><?php $combo->comboesquema($_POST['esquema_dos'],2)?> </td>    
    <td  >Tecnología</td>
    <td ><?php $combo->combotecnologia($_POST['tec_dos'],2)?></td>
    <td  >Subtotal [GB]</td>
    <td ><input name="subtotal_dos" type="text" id="subtotal_dos"  tabindex="1" size="7" onChange="sumar(this.value);"  value="<?php echo $_POST['subtotal_dos']; ?>"  > </td>
    </tr>
    <tr>
    <td></td><td></td><td></td>
    <td >Esquema</td>
    <td ><?php $combo->comboesquema($_POST['esquema_tres'],3)?></td>
    <td   >Tecnología</td>
    <td><?php $combo->combotecnologia($_POST['tec_tres'],3)?></td>
     <td >Subtotal [GB]</td>
    <td ><input name="subtotal_tres" type="text" id="subtotal_tres"  tabindex="1" size="7" onChange="sumar(this.value);" value="<?php echo $_POST['subtotal_tres']; ?>"   > </td>
    </tr>
    <tr>
    <td   >Esquema</td>
    <td></td><td></td><td></td>
    <td><?php $combo->comboesquema($_POST['esquema_cuatro'],4)?></td>
    <td   >Tecnología</td>
     <td ><?php $combo->combotecnologia($_POST['tec_cuatro'],4)?></td>
     <td  >Subtotal [GB]</td>
    <td ><input name="subtotal_cuatro" type="text" id="subtotal_cuatro"  tabindex="1" size="7" onChange="sumar(this.value);" value="<?php echo $_POST['subtotal_cuatro']; ?>"   > </td>
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
 <td></td><td></td><td></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
    <td  ></td>
   <td  >Capacidad Total [GB]</td>
   <td ><input name="arreglo_total"  id="arreglo_total" tabindex="1" size="7" value="<?php echo $_POST['arreglo_total']; ?>" disabled="disabled"/></td>
   <td></td><td></td><td></td>
</tr> 
 </table>
 <br />
  <table cellpadding="5" class="formulario">
 <tr ><legend align="center"><h3>Conectividad</h3></legend></tr>
      <br> 
    
    
    <td  >Tecnología de comunicación </td>
    <td ><?php $combo->combotecom($_POST['tec_com'])?></td>
     <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    
    <td   >Otra </td>
  
    <?php if ($_POST['id_tec_com']=='0'){  ?>
    <td ><input name="tec_com_otro" type="text" id="tec_com_otro"   tabindex="1" size="15" value="<?php echo $_POST['tec_com_otro']; ?>" required > </td>
    
    <?php } else{ ?>
    <td ><input name="tec_com_otro" type="text" id="tec_com_otro" tabindex="1" size="15" value="<?php echo $_POST['tec_com_otro']; ?>" disabled="disabled">  </td>
    <?php } ?>
    <td></td><td></td><td></td>
</table>
  <br />
 <table cellpadding="5" class="formulario">
 
  <tr ><legend align="center"><h3>Plataforma</h3></legend></tr>
      <br> 
   <td   >Sistema Operativo </td>
    <td ><?php $combo->combosistemao($_POST['nombre_so'])?></td>
    <td  >Versión </td>
     <?php if ($_POST['version_sist_oper']=='' ) { ?>
    <td  ><input name="version_sist_oper" type="text" id="version_sist_oper" tabindex="1" size="30" value="<?php echo $_POST['so']; ?>" required  > 
     <?php } else {?>
    <td  ><input name="version_sist_oper" type="text" id="version_sist_oper" tabindex="1" size="30" value="<?php echo $_POST['version_sist_oper']; ?>" required > </td>
   <?php } ?>
    <tr>
    
    <?php if ( $_POST['licencia']==1 ) { 
	   $checked = 'checked="checked" '; 
       }else {   $checked = ' ';
    }?>
	
     <form id="form1" name="form1" method="post" action="">
    <!-- <td >  <input type="checkbox" name="licencia" id="licencia" onChange="palomeado(this);" value="<?php //echo $lic;?>"  /></td>-->
     <td ><input type="checkbox" name="licencia" id="licencia"  <?php echo $checked ?> onChange="palomeado(this);" value="<?php echo $_POST['licencia'];?>"  /> <label for="licencia"></label></td>
     
     <td >  <label for="licencia">Permanente</label></td>
     
      <?php if ( $_POST['licencia']==1 ) { ?>
     <td   >  <label for="licencia_ini">Inicia</label></td>
     <td >  <input type="date" name="licencia_ini" id="licencia_ini"  value="<?php echo $_POST['licencia_ini']; ?>" disabled="disabled"/></td>
     <td >  <label for="licencia_fin">Termina</label></td>
     <td >  <input type="date" name="licencia_fin" id="licencia_fin" value="<?php echo $_POST['licencia_fin']; ?>" disabled="disabled"/></td>
     <?php } else { ?>
	<td  >  <label for="licencia_ini">Inicia</label></td>
     <td >  <input type="date" name="licencia_ini" id="licencia_ini" min="01-01-1985" max="31-12-2030"  value="<?php echo $_POST['licencia_ini']; ?>" /></td>
     <td >  <label for="licencia_fin">Termina</label></td>
     <td >  <input type="date" name="licencia_fin" id="licencia_fin" min="01-01-1985" max="31-12-2030" value="<?php echo $_POST['licencia_fin']; ?>" /></td>	
      <?php } ?>
      </form>
 </tr>
  
<tr>  

   <td >Equipo alto rendimiento</td>
   <td ><?php $radial->radialtorendimiento($_POST['equipoaltorend'])?></td>
   
    <td  >Arquitectura</td>
   
    <td><?php $radial->radialarquitectura($_POST['arquitectura'])?></td>
  
    <td   ><font color="blue">Servidor</font></td>
    
    <td><font color="blue"><?php $radial->radialservidor($_POST['servidor'])?></font></td>

  </tr>
 
   <tr> 
    <td >Tipo tarjeta de video</td>
    <td  ><input name="tipotarjvideo" type="text" id="tipotarjvideo" tabindex="1" size="7" value="<?php echo $_POST['tipotarjvideo']; ?>"></td>
    
    <td  >Modelo de tarjeta de video</td>
    <td  ><input name="modelotarjvideo" type="text" id="modelotarjvideo" tabindex="1" size="15" value="<?php echo $_POST['modelotarjvideo']; ?>"></td>
    <td >Memoria de video [GB] </td>
    <td   ><input name="memoriavideo" type="text" id="memoriavideo"  tabindex="1" size="7" value="<?php echo $_POST['memoriavideo']; ?>"></td>
  </tr>
</table>
  <?php } ?>
  <table>
   <br/>
 <br/>
  <tr>

    <td colspan="3" align="center">
    
    <input type="submit" name="accione" value="Guardar" />
    <input type="reset" name="accione"  value="Limpiar" />
	<input type="submit" name="accione" value="Cancelar" />
    
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
<input name="bien" type="hidden" value="<?php echo $_POST['bien']; ?>" />


</form>
  
<?php 
}
?>