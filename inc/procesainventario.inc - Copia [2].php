<?php
ob_start();
 
session_start();
require_once('../conexion.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>


<p>procesaInventario</p>
<p>&nbsp;</p>
<?php 
//echo'Equipo que llega para asignar ';
 if ( $_SESSION['tipo_usuario']==10  &&  $_SESSION['id_div']=='')
		   $_SESSION['id_div']=$_REQUEST['div'];
		   if ($_SESSION['tipo_usuario']==9 && $_SESSION['id_div']=='')
                $_SESSION['id_div']=$_REQUEST['div'];
echo 'valores en procesainventario'	;
print_r($_SESSION);
	
print_r($_REQUEST); 
?>

<!-- asigna equipo a un laboratorio-->
<?php 
if($_POST['ecasignar']=='Asignar' && ($_REQUEST ['bn_notas']=='COMPUTO' || $_REQUEST ['bn_notas']=='')){
// if($_POST['ecasignar']=='Asignar'){
$query="SELECT * FROM dispositivo d
        LEFT JOIN laboratorios l 
        ON l.id_lab=d.id_lab
        LEFT JOIN departamentos dep
	    ON dep.id_dep=l.id_dep
	    WHERE bn_id=". $_REQUEST['bn_id'] .
		" AND (id_div=". $_SESSION['id_div']. 
		" OR id_div is NULL";



$datos = pg_query($con,$query);
$reg= pg_fetch_array($datos);
$inventario= pg_num_rows($datos); 
	
	echo $query;

if ($inventario > 0 )
{   
echo 'entra a aqui primer';

$updatequery= "UPDATE dispositivo SET id_lab=" .$_REQUEST['lab'] . "WHERE  bn_id=" . $_REQUEST['bn_id'];

$result=pg_query($con,$updatequery) or die('ERROR AL ACTUALIZAR dispositivo');

// actualizar Etiqueta COMPUTO en bn_notas.

$updatequery= "UPDATE bienes SET bn_notas='COMPUTO' WHERE bn_id=" . $_REQUEST['bn_id'];

$result=pg_query($con,$updatequery) or die('ERROR AL ACTUALIZAR TABLA BIENES');

//Despues de hacer la asignacion regresa a inventarios
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']."&div=" .$_SESSION['id_div'].'&orden='. $_REQUEST['orden'];
echo $direccion;
header($direccion);
} else {?>

<p>"Si entre a asignar equipo cómputo  en lab de computo"</p>

<?php 
//Unicamente se ingresa a tabla equipoc cuando esta seguro que es un equipo de cómputo
echo 'Entra a boton Asignar';

$query="SELECT nextval('equipoc_id_equipo_seq')";
$registro = pg_query($con,$query);

$reg= pg_fetch_array($registro);

$strquery="INSERT INTO equipoC (id_equipo,bn_id,id_lab,fecha,id_asig,tipo_mant,
                                id_evento_mant,in_out,especializado,vigente,id_mod,
                                bien,inventario,serie,marca,modelo) 
								VALUES (%d,%d,%d,'%s',1,'',
								NULL,'','f','t',%d,
								'%s','%s','%s','%s','%s'
								)"
								;
$query=sprintf($strquery,$reg[0],$_REQUEST['bn_id'],$_REQUEST['lab'],date('Y-m-d'),$_POST['id_mod'],$_REQUEST['bn_desc'],$_REQUEST['bn_clave'],$_REQUEST['bn_serie'],$_REQUEST['bn_marca'],$_REQUEST['bn_modelo']);

$result=pg_query($con,$query) or die('ERROR AL INSERTAR EN EQUIPOC: ' . pg_last_error());

$queryd="SELECT max(id_dispositivo) FROM dispositivo";
$registrod= pg_query($con,$queryd);
$ultimo= pg_fetch_array($registrod);

//$querymarca="SELECT id_marca FROM cat_marca WHERE descmarca=" . $_REQUEST['bn_marca'];
//$traeidmarca=pg_query($con,$querymarca);
//$idmarca=pg_fetch_array($traeidmarca);



$strqueryd="INSERT INTO dispositivo (id_dispositivo,bn_id,id_lab,
dispositivo_clave,usuario_final_clave,familia_clave,
tipo_ram_clave,tecnologia_clave,resguardo_no_empleado,nombre_resguardo,
usuario_nombre,usuario_ubicacion,usuario_perfil,
usuario_sector,serie,marca_p,
no_factura,anos_garantia,inventario,
modelo_p,proveedor_p,
familia_especificar,modelo_procesador,cantidad_procesador,
nucleos_totales,nucleos_gpu, memoria_ram,
ram_especificar, num_elementos_almac,
total_almac,num_arreglos,esquema_uno,
esquema_dos,esquema_tres, esquema_cuatro,
tec_uno,tec_dos,tec_tres,tec_cuatro,
subtotal_uno,subtotal_dos,subtotal_tres,subtotal_cuatro,
arreglo_total,tec_com,tec_com_otro,
sist_oper,version_sist_oper,
licencia,licencia_ini,licencia_fin,fecha,id_marca)
		   VALUES (%d,%d,%d,
		           3,0,0,
				   0,0,0,NULL,
				   NULL,NULL,0,
				   0,'%s','%s',
				   0,1,'%s',
				   '%s','', 
				   '',0,'',	
				   '',0,NULL,
				   NULL,NULL,
				   NULL,1,1,
				   1,1,1,
				   1,1,1,1,
				   0,0,0,0,
				   0,0,NULL,
				   0,NULL,
				   0,'2000/01/01','2000/01/01','%s',%d)";
	         
$queryid=sprintf($strqueryd,$ultimo[0]+1,$_REQUEST['bn_id'],$_REQUEST['lab'],$_REQUEST['bn_serie'],$_REQUEST['bn_marca'],$_REQUEST['bn_clave'],$_REQUEST['bn_modelo'],date('Y-m-d'),$idmarca);

echo $queryid;

$result=pg_query($con,$queryid) or die('ERROR AL INSERTAR EN DISPOSITIVO: ' . pg_last_error());

//Despues de hacer la asignacion regresa a inventarios
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] . '&div=' . $_SESSION['id_div']. '&orden='. $_REQUEST['orden']. '&ecasignar='. $_REQUEST['ecasignar']. '&_no_inv='. $_REQUEST['_no_inv']. '&_no_inv_ant='. $_REQUEST['_no_inv_ant']. '&_marca='. $_REQUEST['_marca']. '&_descripcion='. $_REQUEST['_descripcion']. '&_no_serie='. $_REQUEST['_no_serie'];

//$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] ."&div=" .$_SESSION['id_div']; 
echo $direccion;
header($direccion);

?>

<?php }
}?>

<?php if($_POST['eeasignar']=='Asignar' && $_REQUEST ['bn_notas']=='EQUIPO'){?>

<p>"Si entre a asignar equipo experimental en equipo experimental"</p>

<?php 
$query="SELECT * FROM equipo d
        LEFT JOIN laboratorios l 
        ON l.id_lab=d.id_lab
        LEFT JOIN departamentos dep
	    ON dep.id_dep=l.id_dep
	    WHERE bn_id=". $_REQUEST['bn_id'] .
		"AND (id_div=". $_SESSION['id_div']. 
		" OR id_div is NULL)";



$datos = pg_query($con,$query);
$reg= pg_fetch_array($datos);
$inventarioexp= pg_num_rows($datos); 

if ($inventarioexp > 0 )
{   


$updatequery= "UPDATE equipo SET id_lab=" .$_REQUEST['lab'] . "WHERE  bn_id=" . $_REQUEST['bn_id'];

$result=pg_query($con,$updatequery) or die('ERROR AL ACTUALIZAR equipo');

}else{

echo 'Entra a boton Asignar equipo exp';
//Unicamente se ingresa a tabla equipo cuando esta seguro que es un equipo experimental

$query="SELECT nextval('equipo_id_equipo_seq')";
$registro = pg_query($con,$query);

$reg= pg_fetch_array($registro);


$strquery="INSERT INTO equipo (id_equipo,bn_id,id_lab,fecha,id_asig,tipo_mant,
                                id_evento_mant,in_out,especializado,vigente,id_mod
                                ) 
								VALUES (%d,%d,%d,'%s',1,'',
								NULL,'','f','t',%d
					            )";
								
$query=sprintf($strquery,$reg[0],$_REQUEST['bn_id'],$_REQUEST['lab'],date('Y-m-d'),$_POST['id_mod'],$_REQUEST['bn_desc'],$_REQUEST['bn_clave'],$_REQUEST['bn_serie'],$_REQUEST['bn_marca'],$_REQUEST['bn_modelo']);


			$result=pg_query($con,$query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
			

} // fin else
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] ."&div=" .$_SESSION['id_div']; 
echo $direccion;
header($direccion);

}?>

<?php if($_POST['basignarc']=='Asignar a Cómputo'){
	
	     echo 'Entra a boton Asignar equipo computo';?>

         <p>"Si entre a asignar cómputo"</p>

<?php 

//print_r($_POST);

//Se ingresa a tabla equipoc cuando NO esta seguro que es equipo de cómputo

$query="SELECT * FROM dispositivo d
        LEFT JOIN laboratorios l 
        ON l.id_lab=d.id_lab
        LEFT JOIN departamentos dep
	    ON dep.id_dep=l.id_dep
	    WHERE bn_id=". $_REQUEST['bn_id'] .
		"AND (id_div=". $_SESSION['id_div']. 
		" OR id_div is NULL)";



$datos = pg_query($con,$query);
$reg= pg_fetch_array($datos);
$inventario= pg_num_rows($datos); 

if ($inventario > 0 )
{   
echo 'entra a aquii';
$updatequery= "UPDATE dispositivo SET id_lab=" .$_REQUEST['lab'] . "WHERE  bn_id=" . $_REQUEST['bn_id'];

$result=pg_query($con,$updatequery) or die('ERROR AL ACTUALIZAR dispositivo');



//Despues de hacer la asignacion regresa a inventarios
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']."&div=" .$_SESSION['id_div'].'&orden='. $_REQUEST['orden'];
echo $direccion;
header($direccion);
} else {


$query="SELECT nextval('equipoc_id_equipo_seq')";

$registro = pg_query($con,$query);

$reg= pg_fetch_array($registro);

$strquery="INSERT INTO equipoC (id_equipo,bn_id,id_lab,fecha,id_asig,tipo_mant,
                                id_evento_mant,in_out,especializado,vigente,id_mod,
                                bien,inventario,serie,marca,modelo) 
								VALUES (%d,%d,%d,'%s',1,'',
								NULL,'','f','t',%d,
								'%s','%s','%s','%s','%s'
								)"
								;
$query=sprintf($strquery,$reg[0],$_REQUEST['bn_id'],$_REQUEST['lab'],date('Y-m-d'),$_POST['id_mod'],$_REQUEST['bn_desc'],$_REQUEST['bn_clave'],$_REQUEST['bn_serie'],$_REQUEST['bn_marca'],$_REQUEST['bn_modelo']);

$result=pg_query($con,$query) or die('ERROR AL INSERTAR EN TABLA EQUIPOC
: ' . pg_last_error());


$queryd="SELECT max(id_dispositivo) FROM dispositivo";
$registrod= pg_query($con,$queryd);
$ultimo= pg_fetch_array($registrod);



/*$strqueryd="INSERT INTO dispositivo (id_dispositivo,bn_id,id_lab,
dispositivo_clave,usuario_final_clave,familia_clave,
tipo_ram_clave,tecnologia_clave,resguardo_no_empleado,nombre_resguardo,
usuario_nombre,usuario_ubicacion,usuario_perfil,
usuario_sector,serie,marca_p,
no_factura,anos_garantia,inventario,
modelo_p,proveedor_p,
familia_especificar,modelo_procesador,cantidad_procesador,
nucleos_totales,nucleos_gpu, memoria_ram,
ram_especificar, num_elementos_almac,
total_almac,num_arreglos,esquema_uno,
esquema_dos,esquema_tres, esquema_cuatro,
tec_uno,tec_dos,tec_tres,tec_cuatro,
subtotal_uno,subtotal_dos,subtotal_tres,subtotal_cuatro,
arreglo_total,tec_com,tec_com_otro,
sist_oper,version_sist_oper,
licencia,licencia_ini,licencia_fin,fecha) 

		   VALUES (%d,%d,%d,
		           3,0,0,
				   0,0,0,NULL,
				   NULL,NULL,NULL,
				   NULL,'%s','%s',
				   NULL,1,'%s',
				   '%s','', 
				   '',NULL,'',	
				   '',0,NULL,
				   NULL,NULL,
				   NULL,1,1,
				   1,1,1,
				   1,1,1,1,
				   0,0,0,0,
				   0,0,NULL,
				   0,NULL,
				   0,NULL,NULL,'%s')";*/
	
	
	
$strqueryd="INSERT INTO dispositivo (id_dispositivo,bn_id,id_lab,
dispositivo_clave,usuario_final_clave,familia_clave,
tipo_ram_clave,tecnologia_clave,resguardo_no_empleado,nombre_resguardo,
usuario_nombre,usuario_ubicacion,usuario_perfil,
usuario_sector,serie,marca_p,
no_factura,anos_garantia,inventario,
modelo_p,proveedor_p,
familia_especificar,modelo_procesador,cantidad_procesador,
nucleos_totales,nucleos_gpu, memoria_ram,
ram_especificar, num_elementos_almac,
total_almac,num_arreglos,esquema_uno,
esquema_dos,esquema_tres, esquema_cuatro,
tec_uno,tec_dos,tec_tres,tec_cuatro,
subtotal_uno,subtotal_dos,subtotal_tres,subtotal_cuatro,
arreglo_total,tec_com,tec_com_otro,
sist_oper,version_sist_oper,
licencia,licencia_ini,licencia_fin,fecha,id_marca)
		   VALUES (%d,%d,%d,
		           3,0,0,
				   0,0,0,NULL,
				   NULL,NULL,0,
				   0,'%s','%s',
				   0,1,'%s',
				   '%s','', 
				   '',0,'',	
				   '',0,NULL,
				   NULL,NULL,
				   NULL,1,1,
				   1,1,1,
				   1,1,1,1,
				   0,0,0,0,
				   0,0,NULL,
				   0,NULL,
				   0,'2000/01/01','2000/01/01','%s',%d)";
	         
$queryid=sprintf($strqueryd,$ultimo[0]+1,$_REQUEST['bn_id'],$_REQUEST['lab'],$_REQUEST['bn_serie'],$_REQUEST['bn_marca'],$_REQUEST['bn_clave'],$_REQUEST['bn_modelo'],date('Y-m-d'),$idmarca);
	         
	/*tipo_impresora,tipo_digitaliza),%d,%d         
$queryid=sprintf($strqueryd,$ultimo[0]+1,$_REQUEST['bn_id'],$_REQUEST['lab'],$_REQUEST['bn_serie'],$_REQUEST['bn_marca'],$_REQUEST['bn_clave'],$_REQUEST['bn_modelo'],date('Y-m-d'));*/

echo $queryid;

$result=pg_query($con,$queryid) or die('ERROR AL INSERTAR EN DISPOSITIVO: ' . pg_last_error());

// actualizar Etiqueta COMPUTO en bn_notas.

$updatequery= "UPDATE bienes SET bn_notas='COMPUTO' WHERE bn_id=" . $_REQUEST['bn_id'];

$result=pg_query($con,$updatequery) or die('ERROR AL ACTUALIZAR TABLA BIENES');

//Despues de hacer la asignacion regresa a inventarios
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']."&div=" .$_SESSION['id_div'];
echo $direccion;
header($direccion);
}
}?>


<?php if($_POST['basignare']=='Asignar a Equipo'){?>

<p>"Si entre a asignar equipo"</p>

<?php 
//print_r($_POST);
//Se ingresa a tabla equipo cuando NO esta seguro que es equipo experimental

$query="SELECT * FROM equipo d
        LEFT JOIN laboratorios l 
        ON l.id_lab=d.id_lab
        LEFT JOIN departamentos dep
	    ON dep.id_dep=l.id_dep
	    WHERE bn_id=". $_REQUEST['bn_id'] .
		"AND (id_div=". $_SESSION['id_div']. 
		" OR id_div is NULL)";



$datos = pg_query($con,$query);
$reg= pg_fetch_array($datos);
$inventarioexp= pg_num_rows($datos); 

if ($inventarioexp > 0 )
{   


$updatequery= "UPDATE equipo SET id_lab=" .$_REQUEST['lab'] . "WHERE  bn_id=" . $_REQUEST['bn_id'];

$result=pg_query($con,$updatequery) or die('ERROR AL ACTUALIZAR equipo');

}else{


$query="SELECT nextval('equipo_id_equipo_seq')";

$registro = pg_query($con,$query);

$reg= pg_fetch_array($registro);

$strquery="INSERT INTO equipo (id_equipo,bn_id,id_lab,fecha,id_asig,tipo_mant,
                                id_evento_mant,in_out,especializado,vigente,id_mod
                                ) 
								VALUES (%d,%d,%d,'%s',1,'',
								NULL,'','f','t',%d
					            )";
								
$query=sprintf($strquery,$reg[0],$_REQUEST['bn_id'],$_REQUEST['lab'],date('Y-m-d'),$_POST['id_mod'],$_REQUEST['bn_desc'],$_REQUEST['bn_clave'],$_REQUEST['bn_serie'],$_REQUEST['bn_marca'],$_REQUEST['bn_modelo']);

$result=pg_query($con,$query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
			
$updatequery= "UPDATE bienes SET bn_notas='EQUIPO' WHERE  bn_id=" . $_REQUEST['bn_id'];

$result=pg_query($con,$updatequery) or die('ERROR AL ACTUALIZAR bienes');



}
//Despues de hacer la asignacion regresa a inventarios
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']."&div=" .$_SESSION['id_div'].'&orden='. $_REQUEST['orden'];
echo $direccion;
header($direccion);

}?>

<?php

// Entra a Desasignar

if( $_POST['ecdasignar']=='Desasignar' || $_POST['dasignarc']=='Desasignar' ){
	//solo requiere actualiazar en dispositivo
	echo 'Entra a proceso de  Desasignar ecdasignar ';?>
    
<?php 

print_r($_POST);

// verificar que el equipo pertenezca a la division del jefe de división que desea modificar

$query="SELECT importa FROM dispositivo d
        JOIN laboratorios l 
        ON l.id_lab=d.id_lab
        JOIN departamentos dep
	    ON dep.id_dep=l.id_dep
	    WHERE bn_id=". $_REQUEST['bn_id'] .
        "AND (id_div=". $_SESSION['id_div'] . " OR id_div IS NULL)";
		
$datos = pg_query($con,$query);
$reg= pg_fetch_array($datos);
$inventario= pg_num_rows($datos); 
//echo 'inventario'. $query;
if ($inventario>0) {
	//echo 'importa', $reg[0];
		  if($reg[0]==1){    
		     echo 'Es importación';
               $updatequery= "UPDATE dispositivo SET id_lab=NULL WHERE  bn_id=" . $_REQUEST['bn_id'];

               $result=pg_query($con,$updatequery) or die('ERROR AL ACTUALIZAR dispositivo');

               //verifica que el equipo se encuantre en equipoC, de ser así se actualiza.

               $query="SELECT * FROM equipoc ec
                       JOIN laboratorios l 
                       ON l.id_lab=ec.id_lab
                       JOIN departamentos dep
	                   ON dep.id_dep=l.id_dep
	                   WHERE bn_id=". $_REQUEST['bn_id'] .
                       "AND id_div=". $_SESSION['id_div'];

               $datos = pg_query($con,$query);
               $inveneqc= pg_num_rows($datos); 

               if ($inveneqc>0){
	
                        $updatequery= "UPDATE equipoc SET id_lab=NULL WHERE  bn_id=" . $_REQUEST['bn_id'];

                        $result=pg_query($con,$updatequery) or die('ERROR AL ACTUALIZAR equipoc');
			   }
		  } // Cuando proviene de una importación
		  else { 
		  echo ' NO es importación';
		  $updatequery= "DELETE FROM dispositivo WHERE  bn_id=" . $_REQUEST['bn_id'];

               $result=pg_query($con,$updatequery) or die('ERROR AL ELIMINAR dispositivo');

               //verifica que el equipo se encuantre en equipoC, de ser así se actualiza.

               $query="SELECT * FROM equipoc ec
                       JOIN laboratorios l 
                       ON l.id_lab=ec.id_lab
                       JOIN departamentos dep
	                   ON dep.id_dep=l.id_dep
	                   WHERE bn_id=". $_REQUEST['bn_id'] .
                       "AND id_div=". $_SESSION['id_div'];

               $datos = pg_query($con,$query);
               $inveneqc= pg_num_rows($datos); 

               if ($inveneqc>0){
	
                        $updatequery= "DELETE FROM equipoc WHERE  bn_id=" . $_REQUEST['bn_id'];

                        $result=pg_query($con,$updatequery) or die('ERROR AL ELIMINAR equipoc');
			   } // cuando proviene de bienes_inventario
		  
		   //Despues de hacer la asignacion regresa a inventarios
 
 
		  
		  }
		  $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']."&div=" .$_SESSION['id_div'].'&orden='. $_REQUEST['orden'];
          echo $direccion;
          header($direccion);
             
 }else { ?>

<table>
<tr>
    <td><h3> El dispositivo pertenece a otra División </h3><td>
 
</tr>  
</table> 

<?php

}


              
?>
<?php 
}// fin de la desaginación de dispostivo sin  eliminar


 if( $_POST['eedasignar']=='Desasignar'  ){
	//solo requiere actualizar en equipo
	echo 'Entra a proceso de  Desasignar experimental';?>
    
<?php 
print_r($_POST);

// verificar que el equipo pertenezca a la division del jefe de división que desea modificar

$queryexp="SELECT * FROM equipo d
           left JOIN bienes b
           ON b.bn_id=d.bn_id
           left JOIN laboratorios l 
           ON l.id_lab=d.id_lab
           left JOIN departamentos dep
	       ON dep.id_dep=l.id_dep
	       WHERE bn_clave="."'".$_REQUEST['bn_clave']."'". " AND id_div=".$_SESSION['id_div'];
		   
$datosexp = pg_query($con,$queryexp);
$reg= pg_fetch_array($datosexp);
$inventarioexp= pg_num_rows($datosexp); 
//echo 'valor tuplas'.$inventarioexp;
//echo $queryexp;

if ($inventarioexp>0) { // pertenece a la División
		  /*echo 'entra ';
		  echo 'importa', $reg[11];*/
		   if($reg[11]==1){   
               $updatequery= "UPDATE equipo SET id_lab=NULL WHERE  bn_id=" . $_REQUEST['bn_id'];

               $result=pg_query($con,$updatequery) or die('ERROR AL ACTUALIZAR equipo');
		   }else{
             
			   $updatequery= "DELETE FROM equipo WHERE  bn_id=" . $_REQUEST['bn_id'];

               $result=pg_query($con,$updatequery) or die('ERROR AL ELIMINAR equipo');
		   }
		             
	
 }
else { ?>

<table>
<tr>
    <td><h3> El equipo experimental pertenece a otra División </h3><td>
 
</tr>  
</table> 

<?php

   }
  //Despues de hacer la asignacion regresa a inventarios
 $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']."&div=" .$_SESSION['id_div']; 
echo $direccion;
header($direccion);
 
}// fin de la desaginación de equipo experimental 

?>

<?php if($_POST['accioned']=='Guardar'){ ?>
<h1>GUARDAR</h1>
<?php 
echo 'Salvar una edición de inventarios';
//echo 'valores para guardar registros:';
print_r ($_REQUEST);

if ($_POST['servidor']=='Si'){
	$servidor='1';}
	else {$servidor='0';}

if($_POST['total_almac'] == NULL){
	$totalalmac=0;
	}
	else{$totalalmac=$_POST['total_almac'];};
	
if (isset($_POST['licencia']))

	$licencia=1;
else 
    $licencia=0;

//echo 'licencia'. $licencia;

$arregloTotal=$_POST['subtotal_uno']+$_POST['subtotal_dos']+$_POST['subtotal_tres']+$_POST['subtotal_cuatro'];

if ($_POST['anos_garantia']=='0')
	$anos_garantia=1;
else	
   $anos_garantia=$_POST['anos_garantia'];
   
if ($_POST['nucleos_totales']=='0')
	$nucleos_totales=1;
else	
   $nucleos_totales=$_POST['nucleos_totales'];  
   
if ( $_POST['cantidad_procesador']=='0')
    $cantidad_procesador=1;
else
	$cantidad_procesador= $_POST['cantidad_procesador']; 
    
if ($_POST['nucleos_gpu']=='')
    $nucleos_gpu=1;
else
	$nucleos_gpu=  $_POST['nucleos_gpu'];
	
if ($_POST['tec_uno']=='0')
    $tec_uno=1;
else
	$tec_uno=$_POST['tec_uno']; 
	
if ($_POST['tec_dos']=='0')
    $tec_dos=1;
else
	$tec_dos=$_POST['tec_dos']; 	
	
if ($_POST['tec_tres']=='0')
    $tec_tres=1;
else
	$tec_tres=$_POST['tec_tres']; 	
	
if ($_POST['tec_cuatro']=='0')
    $tec_cuatro=1;
else
	$tec_cuatro=$_POST['tec_cuatro']; 
	
if ($_POST['no_factura']=='')
    $no_factura='  ';
else 
    $no_factura=$_POST['no_factura'];	


if ($_POST['proveedor_p']=='')
    $proveedor_p='  ';
else 
    $proveedor_p=$_POST['proveedor_p'];	
	
if ($_POST['fecha_factura']=='')
    $fecha_factura='  ';
else 
    $fecha_factura=date("d-m-Y", strtotime($_POST['fecha_factura']));	
	
				
	//busca la marca en el catálogo de marcas...
	
	    
	  
	  
	      		
	  $querym="SELECT descmarca 
							  FROM cat_marca
			                  WHERE id_marca=".$_POST['id_marca'];
		
							  
              $registrom= pg_query($con,$querym);
              $marca= pg_fetch_array($registrom);
			
if (isset($_POST['id_mem_ram'])){
    $memram= "select cantidad_ram from cat_memoria_ram where id_mem_ram=" . $_POST['id_mem_ram'];	
   	$result = pg_query($memram) or die('Hubo un error con la base de datos cat_memoria_ram');
    $datosram=pg_fetch_array($result,NULL,PGSQL_ASSOC);	  
}

$strqueryd="UPDATE dispositivo SET  dispositivo_clave=%d, id_lab=%d, usuario_final_clave=%d, familia_clave=%d,
                                    tipo_ram_clave=%d,tecnologia_clave=%d,resguardo_no_empleado=%d,nombre_resguardo='%s',
                                    usuario_nombre='%s',usuario_ubicacion='%s',usuario_perfil=%d,
                                    usuario_sector=%d,marca_p='%s',no_factura='%s',
                                    modelo_p='%s',proveedor_p='%s',fecha_factura='%s',familia_especificar='%s',
                                    modelo_procesador='%s',cantidad_procesador='%s',nucleos_totales='%s',
                                    nucleos_gpu='%s',id_mem_ram=%d,ram_especificar='%s',
									memoria_ram='%s',
                                    num_elementos_almac=%d,total_almac='%s', num_arreglos=%d,
                                    esquema_uno=%d,esquema_dos=%d,esquema_tres=%d,esquema_cuatro=%d,
                                    tec_uno=%d,tec_dos=%d,tec_tres=%d,tec_cuatro=%d,
                                    subtotal_uno=%d,subtotal_dos=%d,subtotal_tres=%d,subtotal_cuatro=%d,
                                    arreglo_total=%d,tec_com=%d,tec_com_otro='%s',
                                    sist_oper=%d,version_sist_oper='%s',licencia=%d,
licencia_ini='%s',licencia_fin='%s',arquitectura='%s',estadobien='%s',servidor='%s',descextensa='%s',id_marca=%d,marca_esp='%s',tipotarjvideo='%s',modelotarjvideo='%s',memoriavideo='%s',anos_garantia='%s',id_mod=%d,tipo_impresora=%d,tipo_digitaliza=%d
WHERE id_dispositivo=". $_POST['id_dispositivo'];
	


$queryud=sprintf($strqueryd,$_POST['dispositivo_clave'], $_POST['id_lab'], $_POST['usuario_final_clave'],$_POST['id_familia'],
                          $_POST['id_tipo_ram'],$_POST['id_tecnologia'],$_POST['resguardo_no_empleado'],$_POST['nombre_resguardo'],
                          $_POST['usuario_nombre'],$_POST['usuario_ubicacion'],$_POST['id_usuario_perfil'],
                          $_POST['id_usuario_sector'],$marca[0],$no_factura,
                          $_POST['modelo_p'],$proveedor_p,$fecha_factura,$_POST['familia_especificar'],$_POST['modelo_procesador'],$cantidad_procesador,$nucleos_totales,
                          $nucleos_gpu,$_POST['id_mem_ram'],$_POST['ram_especificar'],
						  $datosram['cantidad_ram'],
                          $_POST['id_elemento'],$totalalmac,$_POST['id_arreglo'],
                          $_POST['esquema_uno'],$_POST['esquema_dos'],$_POST['esquema_tres'],$_POST['esquema_cuatro'],
						  $tec_uno,$tec_dos,$tec_tres,$tec_cuatro,
                          $_POST['subtotal_uno'],$_POST['subtotal_dos'],$_POST['subtotal_tres'],$_POST['subtotal_cuatro'],
                          $arregloTotal,$_POST['id_tec_com'],$_POST['tec_com_otro'],
                          $_POST['id_sist_oper'],$_POST['version_sist_oper'],$licencia,
                          date("d-m-Y", strtotime($_POST['licencia_ini'])),date("d-m-Y", strtotime($_POST['licencia_fin'])),
						  $_POST['arquitectura'],$_POST['estadobien'], $servidor,$_POST['descextensa'],                         $_POST['id_marca'],$_POST['marca_esp'],$_POST['tipotarjvideo'],$_POST['modelotarjvideo'],
						  $_POST['memoriavideo'],$anos_garantia,$_POST['id_mod'],$_POST['id_tipoi'],$_POST['id_digitaliza']);	
						  
echo $queryud;
	
 $result=pg_query($con,$queryud) or die('ERROR AL ACTUALIZAR DATOS en dispositivo: ' . pg_last_error());

if (isset($_POST['idsoper']))

   $sistemaoper= "select sistemaoperativo from cat_sistema_operativo where id_so=" . $_POST['idsoper'];

if (isset($_POST['idtipomemoria']))

   $tipomemoria= "select tipomemoria from cat_tipo_memoria where id_tipo_memoria=" . $_POST['idtipomemoria'];

if (isset($_POST['idnumdisco']))

    $numdisco="select numerodisco from cat_num_disco where id_num_disco=" . $_POST['idnumdisco'];

if (isset($_POST['idtinterfaz']))

    $tipointerfaz="select tipointerfaz from cat_tipo_interfaz where idtipointerfaz=" . $_POST['idtinterfaz'];


if (isset($_POST['servidor']))

    $tipoequipo="select servidor from cat_servidor where etiqueta='" . $_POST['servidor'] . "'";


if (isset($_POST['arquitectura']))
	$arquit="select arquitectura from cat_arquitectura where arquitectura=" . $_POST['arquitectura'];

if (isset($_POST['idcatproc']))

	$proc="select descprocesador from cat_procesador  where idcatproc=" . $_POST['idcatproc'];


if (isset($sistemaoper)){

   $result = pg_query($sistemaoper) or die('Hubo un error con la base de datos sisoper');
   $datoso=pg_fetch_array($result,NULL,PGSQL_ASSOC);
}
if (isset($tipomemoria)){
    $result = pg_query($tipomemoria) or die('Hubo un error con la base de datos tipomemo');
    $datotm=pg_fetch_array($result,NULL,PGSQL_ASSOC);
}
if (isset($numdisco)){
    $result = pg_query($numdisco) or die('Hubo un error con la base de datos numdisco');
    $datond=pg_fetch_array($result,NULL,PGSQL_ASSOC);
}
if (isset($tipointerfaz)){
   $result = pg_query($tipointerfaz) or die('Hubo un error con la base de datos tipointerfaz');
   $datoti=pg_fetch_array($result,NULL,PGSQL_ASSOC);
}
if (isset($arquit)){
    $result = pg_query($arquit) or die('Hubo un error con la base de datos arquitectura');
    $datoarq=pg_fetch_array($result,NULL,PGSQL_ASSOC);
}

if (isset($proc)){
   $result = pg_query($proc) or die('Hubo un error con la base de datos procesador');
   $datoproc=pg_fetch_array($result,NULL,PGSQL_ASSOC);
}
if (isset($tipoequipo)){
   $result = pg_query($tipoequipo) or die('Hubo un error con la base de datos servidor');
   $datoserv=pg_fetch_array($result,NULL,PGSQL_ASSOC);
}

$strquery="UPDATE equipoc SET descextensa='%s', procesador='%s', 
            noprocesadores='%s', velocidad='%s', so='%s', 
			cache='%s',cantmemoria='%s', tipomemoria='%s', 
			tipotarjvideo='%s', modelotarjvideo='%s', memoriavideo='%s', 
			nodiscos='%s', capdisco='%s', tipointerfaz='%s', 
			tipodd='%s', equipoaltorend='%s',
		    accesorios='%s', arquitectura='%s', estadobien='%s', servidor='%s',id_mod=%d
            WHERE bn_id=". $_REQUEST['bn_id'];

$queryu=sprintf($strquery,$_POST['descextensa'],$datoproc['descprocesador'],
               $_POST['noprocesadores'],$_POST['velocidad'],$datoso['sistemaoperativo'],
			   $_POST['cache'], $_POST['cantmemoria'], $datotm['tipomemoria'], 
			   $_POST['tipotarjvideo'], $_POST['modelotarjvideo'], $_POST['memoriavideo'],
			   $datond['numerodisco'], $_POST['capdisco'], $datoti['tipointerfaz'], $_POST['tipodd'],
			   $_POST['equipoaltorend'], $_POST['accesorios'],$datoarq['arquitectura'],$_POST['estadobien'], $datoserv['servidor'],$_POST['id_mod']);


    $result=pg_query($con,$queryu) or die('ERROR AL ACTUALIZAR DATOS: ' . pg_last_error());

    $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']."&div=" .$_SESSION['id_div'];
    echo $direccion;
    header($direccion);

}

if( $_POST['accionear']=='Guardar'){ ?>

<h1>GUARDAR</h1>

<?php
echo 'Valores a editar';
print_r ($_REQUEST);

if (isset($_POST['cluster']))
    $cluster=1;
else 
    $cluster=0;
	
if (isset($_POST['conexion']))
    $conexion=1;
else 
    $conexion=0;	
/*if (isset($_POST['salida']))
    $sal=1;
elseif ($_POST['salida']==1)
    $sal=1;	
elseif ($_POST['salida']==0)
    $sal=0;		*/
	if (isset($_POST['salida']))
    $sal=1;
else
    $sal=0;	
/*	
if (isset($_POST['id_crit']))
{
   $criticidad= "select nombCrit from cat_crit where id_crit=" . $_POST['id_crit'];
   $result = pg_query($criticidad) or die('Hubo un error con la base de datos cat_crit');
   $datoscrit=pg_fetch_array($result,NULL,PGSQL_ASSOC);
}
*/	
	
?>
	<?php
$strqueryd="UPDATE equipoarendimiento SET  cluster=%d, num_proc='%s',
                                           tipo_proc='%s', vel_proc='%s',
										   cache='%s', ram_cant='%s',
										   ram_tipo='%s', videotipo='%s',
										   modelovideo='%s',videomem='%s',
										   num_dd=%d,interf_dd='%s',
										   cap_dd='%s',cap_sec='%s',
										   conexion=%d,velocidad='%s',
										   salida=%d,velocidadint='%s',
										   uso='%s',terminal='%s',
										   criticidad=%d,adquision=%d
               WHERE id_dispositivo=". $_POST['id_dispositivo'];
	


$queryud=sprintf($strqueryd,$cluster,$_POST['num_proc'], 
                            $_POST['tipo_proc'], $_POST['vel_proc'], 
                            $_POST['cache'], $_POST['ram_cant'], 
							$_POST['ram_tipo'],$_POST['videotipo'],
							$_POST['modelovideo'],$_POST['videomem'],
							$_POST['num_dd'],$_POST['interf_dd'],
							$_POST['cap_dd'],$_POST['cap_sec'],
							$conexion,$_POST['velocidad'],
							$sal,$_POST['velocidadint'],
							$_POST['uso'],$_POST['terminal'],
							$_POST['id_crit'],$_POST['id_adq']);	
							
							
echo $queryud;

 $result=pg_query($con,$queryud) or die('ERROR AL ACTUALIZAR DATOS en equipoarendimiento: ' . pg_last_error());
 $direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab']."&div=" .$_SESSION['id_div'];
    echo $direccion;
    header($direccion);
}

ob_end_flush();
?>

