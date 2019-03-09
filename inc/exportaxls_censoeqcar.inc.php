<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<?php
session_start(); 
require_once('../conexion.php'); 

header("Pargma:public");
header("Expires:0");
header("Content-type: application/x-msdownload");
header("Pargma:no-cache");
header("Cache-Control: must_revalidate,post-check=0,pre-check=0");


if ( $_SESSION['tipo_usuario']==1){
	 
	$querylab="SELECT nombre FROM laboratorios
           WHERE id_lab=" . $_REQUEST['lab'] ;
    $registrolab = pg_query($con,$querylab);
    $nomblab= pg_fetch_array($registrolab);
    $texto='Content-Disposition: attachment;filename="censoeqcomp_' . date("Ymd-His") . "_" . $nomblab[0] . '.xls"';
}

if ( $_SESSION['tipo_usuario']!=10 && $_SESSION['tipo_usuario']!=1){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);


$texto='Content-Disposition: attachment;filename="censoeqar_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
}

if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);


$texto='Content-Disposition: attachment;filename="censoeqar_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
}
else if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
$titulo='FacultadIngenieria';	
$texto='Content-Disposition: attachment;filename="censoeqar_' . date("Ymd-His") . "_" . $titulo . '.xls"';	
}
	
header($texto);

?>
   <tr>
      <td align="center"><h2>Censo de Equipos de Alto Rendimiento</h2></td>
   </tr>
 
		<?php 
		
	if ($_SESSION['tipo_usuario']==1){

  $query= " SELECT  equipoaltorend,descmarca,modelo_p,serie,inventario,sist_oper,nombre_so,fecha_factura,l.nombre
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN laboratorios l
			ON dp.id_lab=l.id_lab
            LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN departamentos d 
			ON d.id_dep=l.id_dep
            WHERE equipoaltorend='Si'
			AND l.id_lab=". $_REQUEST['lab']  . "
			ORDER BY marca_p,l.nombre ASC";
	}
	if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
	
	$query=" SELECT  equipoaltorend,descmarca,modelo_p,serie,inventario,sist_oper,nombre_so,fecha_factura,l.nombre
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN laboratorios l
			ON dp.id_lab=l.id_lab
            LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN departamentos d 
			ON d.id_dep=l.id_dep
            WHERE equipoaltorend='Si'
			ORDER BY marca_p,l.nombre ASC";	
	}
	else if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){

  $query= " SELECT  equipoaltorend,descmarca,modelo_p,serie,inventario,sist_oper,nombre_so,fecha_factura,l.nombre
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN laboratorios l
			ON dp.id_lab=l.id_lab
            LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN departamentos d 
			ON d.id_dep=l.id_dep
            WHERE equipoaltorend='Si'
			AND id_div=". $_SESSION['id_div']  . "
			ORDER BY marca_p,l.nombre ASC";
	}
		if (($_SESSION['tipo_usuario']!=10 && $_SESSION['tipo_usuario']!=1) && $_SESSION['id_div']==""){
	
	$query=" SELECT  equipoaltorend,descmarca,modelo_p,serie,inventario,sist_oper,nombre_so,fecha_factura,l.nombre,l.nombre
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN laboratorios l
			ON dp.id_lab=l.id_lab
            LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN departamentos d 
			ON d.id_dep=l.id_dep
            WHERE equipoaltorend='Si'
			ORDER BY marca_p,l.nombre ASC";	
	}
	else if (($_SESSION['tipo_usuario']!=10 && $_SESSION['tipo_usuario']!=1) && $_SESSION['id_div']!=""){

  $query= " SELECT  equipoaltorend,descmarca,modelo_p,serie,inventario,sist_oper,nombre_so,fecha_factura,l.nombre
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN laboratorios l
			ON dp.id_lab=l.id_lab
            LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN departamentos d 
			ON d.id_dep=l.id_dep
            WHERE equipoaltorend='Si'
			AND id_div=". $_SESSION['id_div']  . "
			ORDER BY marca_p,l.nombre ASC";
	}
	
	
	
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
    ?>
    
    	 <table class='material' width=50%>
		 <tr>
             <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Área</th> <?php }?>
              <th width="20%" scope="col">Marca</th>
              <th width="20%" scope="col">Modelo</th>
              <th width="20%" scope="col">Serie</th>
              <th width="20%" scope="col">Inventario</th>
              <th width="20%" scope="col">Sistema Operativo</th>
              <th width="20%" scope="col">Fecha Adquisición</th>
         </tr>

         </table>


	<?php
        
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
	
		  ?>
          
		    <table class='material' width=50%>
		 
            <tr>
               
               <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%" scope="col"><?php echo ucwords(strtolower($lab_invent['descmarca']));?></td>
               <td width="20%" scope="col"><?php echo ucwords(strtolower($lab_invent['modelo_p']));?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['serie'];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['inventario'];?></td>
               <td width="20%" scope="col"><?php echo ucwords(strtolower($lab_invent['nombre_so']));?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['feche_factura'];?></td>
            </tr>
        </table>  
<?php 

    $cuenta=$cuenta+$lab_invent['cuenta'];      
  	
		} ?>
 
<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="20%" ><strong><?php echo $inventario . "  " . "Equipos";?></strong></td>
</tr>
</table>
 