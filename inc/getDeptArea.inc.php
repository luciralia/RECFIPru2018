<script type="text/javascript">
	//alert("Obtiene id_deptArea "+id_dep);
	//console.log(data);
</script>

<?php
require ('../conexion.php');

	 $iddep= $_POST['id_dep'];
	
	 $query="SELECT  * FROM laboratorios l
			 WHERE l.id_dep=".$iddep;
			  
	 echo $query;
	

	  $result=  @pg_query($query) or die('Hubo un error con la base de datos en departamento');
	  

	
	 while ($datosc = pg_fetch_array($result))

		$html.= "<option value='".$datosc['id_lab']."'>".$datosc['nombre']."</option>";
	
	
	echo $html;
?>