<script type="text/javascript">
	//alert("Obtiene id_coord "+id_coord);
	//console.log(data);
</script>

<?php
require ('../conexion.php');

	 $idco= $_POST['id_coord'];
	
	 $query="SELECT  * FROM departamentos d
			  WHERE d.id_coord=".$idco;
	// echo $query;
	$result=  @pg_query($query) or die('Hubo un error con la base de datos en departamento');
	  

	
	 while ($datosc = pg_fetch_array($result))

		$html.= "<option value='".$datosc['id_dep']."'>".$datosc['nombre']."</option>";
	
	
	echo $html;
?>