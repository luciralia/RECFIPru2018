<script type="text/javascript">
	//alert("Ingreso a getDept "+id_coord);
	//console.log(data);
</script>

<?php
require ('../conexion.php');

	
	 $iddep= $_POST['id_dep'];
	
	 $query="SELECT  * FROM academia d
			  WHERE d.id_dep=".$iddep;
	// echo $query;
	

	  $result=  @pg_query($query) or die('Hubo un error con la base de datos en departamento');
	  

	
	 while ($datosc = pg_fetch_array($result))

		$html.= "<option value='".$datosc['id_acad']."'>".$datosc['nombre']."</option>";
	
	
	echo $html;
?>