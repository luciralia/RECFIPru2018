<script type="text/javascript">
	/*alert("Ingreso a getDept "+id_dep);
	 console.log(data);*/
</script>

<?php
require ('../conexion.php');

	
	 $iddep = $_POST['id_dep'];
	
	 $query="SELECT co.nombre as coordnomb,*  FROM departamentos d
             LEFT JOIN coordinacion co
             ON co.id_coord=d.id_coord 
             LEFT JOIN divisiones dv
             ON (dv.id_div=co.id_div
                 OR d.id_div=dv.id_div)
             WHERE d.id_dep=".$iddep;
	  // echo $query;
	

	  $result=  @pg_query($query) or die('Hubo un error con la base de datos depto/coord');
	  

	
	 while ($datosc = pg_fetch_array($result))

		$html.= "<option value='".$datosc['id_coord']."'>".$datosc['coordnomb']."</option>";
	
	
	echo $html;
?>