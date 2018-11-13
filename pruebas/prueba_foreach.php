<?php 
session_start();
require_once('../conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<?php

/* Ejemplo 3 de foreach: clave y valor */
echo "Ejemplo 3\n\n";
$a = array(
    "uno" => 1,
    "dos" => 2,
    "tres" => 3,
    "diecisiete" => 17
);

foreach ($a as $k => $v) {
    echo "\$a[$k] => $v.\n";
}
?>




<?php
/* Ejemplo 4 de foreach: arrays multidimensionales */

echo "Ejemplo 4\n\n";


$a = array();
$a[0][0] = "a";
$a[0][1] = "b";
$a[1][0] = "y";
$a[1][1] = "z";

foreach ($a as $v1) {
    foreach ($v1 as $v2) {
        echo "$v2\n";
    }
}

?>
<body>
<p>
<form action="prueba_foreach.php" method="post" name="form_casillas"> 

  <p>
    <?php 

$idlab=103;
$query="select e.*, l.id_lab, l.nombre, id_dep,bi.*
				from equipo e, laboratorios l, bienes_inventario bi
				where e.id_lab=l.id_lab
				AND e.bn_id=bi.bn_id
				AND e.id_lab=" . $idlab . " order by bn_desc asc";
						//echo $query ."</br>". $id_cot . "</br>" . $lab;
					
				//	echo $query;
					$result = pg_query($query) or die('Hubo un error con la base de datos');
					
//					$salida='<select name="bn_id" id="bn_id">'; 
					?>
  </p>
  <p>descripción
    <input type="text" name="descripcion" id="descripcion" />
  </p>
  <p>
    fecha
    <input type="text" name="fecha" id="fecha" />
  </p>
                   <table><tr><td>No. Inv</td><td>Equipo</td><td>Seleccionar</td></tr>

					<?php 
						$j=1;
						while ($datosc = pg_fetch_array($result, NULL, PGSQL_ASSOC))
						{ 
						$nombrechk="equipo".$j;
						?>
						  <tr><td><?php echo $datosc['bn_clave']; ?></td><td><?php echo $datosc['bn_desc']; ?></td><td><input type="checkbox" name="<?php echo $nombrechk; ?>" value="<?php echo $datosc['bn_id']; ?>"  /></td></tr> 				
							
					
					<?php	$j++;}  


?>
</table>



  
  <input type="submit" name="enviar" id="enviar" value="Enviar" />
<input name="lab" type="hidden" value="103" />
<input name="mod" type="hidden" value="servi" />
</form>
  <?php print_r($_POST);
  if ($_POST['enviar']=='Enviar'){
	echo "al inicio " . $strquery;
	  for ($i=0;$i<=$j;$i++){
		   $checkbox='equipo'.$i;
			 if (isset($_POST[$checkbox])){
				 
						$strquery= "INSERT INTO eventos_mantenimiento (id_bitacora, id_equipo, tipo_mant, fecha, tipo_falla) VALUES  (%d,%d,'%s','%s','%s')";
						$queryn=sprintf($strquery,$_POST[$checkbox],$_POST['lab'],$_POST['mod'],$_POST['descripcion'],$_POST['fecha']);
						echo "<br />" . $queryn . "<br />";
				 
			 }//fin if
		   
		   
	   }//fin for
  
  
  }//fin if
  ?>
</p>
</body>
</html>