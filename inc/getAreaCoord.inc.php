<script type="text/javascript">
	//alert("Ingreso a getAreaCoord "+id_coord);
	//(console.log(data);
</script>

<?php
require ('../conexion.php');
     $idcoord= $_POST['id_coord'];
	 
	 $query="SELECT  * FROM laboratorios  l
			  WHERE l.id_coord=".$idcoord;
	
	 //echo $query;
	

	  $result=  @pg_query($query) or die('Hubo un error con la base de datos en departamento en getArea');
	  

	
	 while ($datosc = pg_fetch_array($result))

		$html.= "<option value='".$datosc['id_lab']."'>".$datosc['nombre']."</option>";
	
	$_POST['id_lab']=$datosc['id_lab'];
	echo $html;
?>