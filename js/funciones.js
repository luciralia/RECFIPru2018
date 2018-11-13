<script src="funciones.js">

$(function(){
	$("#id_asig").change(function(){ //se activa cuando se selecciona la asignatura
	id_asig=$(this).val() //Toma el valor seleccionado
   //envio a la pagina donde hará la consulta
    $.get("../inc/configuraResultados.inc.php?id_asig="+id_asig,
	          function(data){ 
			       $("#id_grupo").html(data);
			  });
  });	
});

</script>