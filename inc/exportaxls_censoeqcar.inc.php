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


if ( ($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==9 ) && $_SESSION['id_div']==NULL || $_REQUEST['lab']!=NULL ){
	 
	$querylab="SELECT nombre FROM laboratorios
           WHERE id_lab=" . $_REQUEST['lab'] ;
    $registrolab = pg_query($con,$querylab);
    $nomblab= pg_fetch_array($registrolab);
    //echo 'consulta'.$querylab;
    $texto='Content-Disposition: attachment;filename="censoeqcar_' . date("Ymd-His") . "_" . $nomblab[0] . '.xls"';

}

if ( $_SESSION['tipo_usuario']==9 && $_SESSION['id_div']!=NULL && $_REQUEST['lab']==NULL ){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);

$texto='Content-Disposition: attachment;filename="censoeqcar_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';

}


if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);


$texto='Content-Disposition: attachment;filename="censoeqcar_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
}
else if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
$titulo='FacultadIngenieria';	
$texto='Content-Disposition: attachment;filename="censoeqcar_' . date("Ymd-His") . "_" . $titulo . '.xls"';	
}	
header($texto);

?>
   <tr>
      <td align="center"><h2>Censo de Equipos de Alto Rendimiento</h2></td>
   </tr>
 
		<?php 
		if (($_SESSION['tipo_usuario']==1 ||$_SESSION['tipo_usuario']==9)  &&  $_REQUEST['lab'] !=NULL  ){

  $query= " SELECT  equipoaltorend,descmarca,modelo_p,serie,dp.inventario,sist_oper,nombre_so,fecha_factura,l.nombre,l.nombre,
             cluster,ear.velocidad,cantidad_procesador,cache,memoria_ram,videotipo, modelovideo,videomem,
			 num_elementos_almac,total_almac,conexion,salida,velocidadInt,
        terminal,nombcrit,nombre_perfil,cad.*
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN laboratorios l
			ON dp.id_lab=l.id_lab
            LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN departamentos d 
			ON d.id_dep=l.id_dep
            JOIN equipoarendimiento ear
            ON ear.id_dispositivo=dp.id_dispositivo
			
            LEFT JOIN cat_crit cc
            ON cc.id_crit=ear.criticidad
            LEFT JOIN cat_adq cad
            ON cad.id_adq=ear.adquision
            LEFT JOIN cat_usuario_perfil cup
            ON cup.id_usuario_perfil=dp.usuario_perfil
            WHERE 
			l.id_lab=". $_REQUEST['lab']  . "
			ORDER BY marca_p,l.nombre ASC";
	}else
	if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
	
	$query=" SELECT  equipoaltorend,descmarca,modelo_p,serie,dp.inventario,sist_oper,nombre_so,fecha_factura,l.nombre,l.nombre,
             cluster,ear.velocidad,cantidad_procesador,cache,memoria_ram,videotipo, modelovideo,videomem,
			 num_elementos_almac,total_almac,conexion,salida,velocidadInt,
             terminal,nombcrit,nombre_perfil,cad.*
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN laboratorios l
			ON dp.id_lab=l.id_lab
            LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN departamentos d 
			ON d.id_dep=l.id_dep
            JOIN equipoarendimiento ear
            ON ear.id_dispositivo=dp.id_dispositivo
			LEFT JOIN cat_crit cc
            ON cc.id_crit=ear.criticidad
            LEFT JOIN cat_adq cad
            ON cad.id_adq=ear.adquision
            LEFT JOIN cat_usuario_perfil cup
            ON cup.id_usuario_perfil=dp.usuario_perfil
           
			ORDER BY marca_p,l.nombre ASC";	
	}
	else if ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){

  $query= " SELECT  equipoaltorend,descmarca,modelo_p,serie,dp.inventario,sist_oper,nombre_so,fecha_factura,l.nombre,l.nombre,
             cluster,ear.velocidad,cantidad_procesador,cache,memoria_ram,videotipo, modelovideo,videomem,
			 num_elementos_almac,total_almac,conexion,salida,velocidadInt,
            terminal,nombcrit,nombre_perfil,cad.*
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN laboratorios l
			ON dp.id_lab=l.id_lab
            LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN departamentos d 
			ON d.id_dep=l.id_dep
            JOIN equipoarendimiento ear
            ON ear.id_dispositivo=dp.id_dispositivo
			
            LEFT JOIN cat_crit cc
            ON cc.id_crit=ear.criticidad
            LEFT JOIN cat_adq cad
            ON cad.id_adq=ear.adquision
            LEFT JOIN cat_usuario_perfil cup
            ON cup.id_usuario_perfil=dp.usuario_perfil
            WHERE 
			id_div=". $_SESSION['id_div']  . "
			ORDER BY marca_p,l.nombre ASC";
	}else
		if (($_SESSION['tipo_usuario']!=10 && $_SESSION['tipo_usuario']!=1) && $_SESSION['id_div']==""){
	
	$query="SELECT  equipoaltorend,descmarca,modelo_p,serie,dp.inventario,sist_oper,nombre_so,fecha_factura,l.nombre,l.nombre,
             cluster,ear.velocidad,cantidad_procesador,cache,memoria_ram,videotipo, modelovideo,videomem,
			 num_elementos_almac,total_almac,conexion,salida,velocidadInt,
             terminal,nombcrit,nombre_perfil,cad.*
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN laboratorios l
			ON dp.id_lab=l.id_lab
            LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN departamentos d 
			ON d.id_dep=l.id_dep
            JOIN equipoarendimiento ear
            ON ear.id_dispositivo=dp.id_dispositivo
			LEFT JOIN cat_crit cc
            ON cc.id_crit=ear.criticidad
            LEFT JOIN cat_adq cad
            ON cad.id_adq=ear.adquision
            LEFT JOIN cat_usuario_perfil cup
            ON cup.id_usuario_perfil=dp.usuario_perfil
           
			ORDER BY marca_p,l.nombre ASC";	
	}
	else if (($_SESSION['tipo_usuario']!=10 && $_SESSION['tipo_usuario']!=1) && $_SESSION['id_div']!=""){

  $query= "SELECT  equipoaltorend,descmarca,modelo_p,serie,dp.inventario,sist_oper,nombre_so,fecha_factura,l.nombre,l.nombre,
             cluster,ear.velocidad,cantidad_procesador,cache,memoria_ram,videotipo, modelovideo,videomem,
			 num_elementos_almac,total_almac,conexion,salida,velocidadInt,
             terminal,nombcrit,nombre_perfil,cad.*
			 FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN laboratorios l
			ON dp.id_lab=l.id_lab
            LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN departamentos d 
			ON d.id_dep=l.id_dep
            JOIN equipoarendimiento ear
            ON ear.id_dispositivo=dp.id_dispositivo
			
            LEFT JOIN cat_crit cc
            ON cc.id_crit=ear.criticidad
            LEFT JOIN cat_adq cad
           ON cad.id_adq=ear.adquision
            LEFT JOIN cat_usuario_perfil cup
            ON cup.id_usuario_perfil=dp.usuario_perfil
            WHERE id_div=". $_SESSION['id_div']  . "
			ORDER BY marca_p,l.nombre ASC";
	}
	
	
	
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); ?>

     <table class='material' width=50%>
		 <tr>
             <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9) { ?> <th width="20%" scope="col">Área</th> <?php }?>
              <th width="20%" scope="col">Marca</th>
              <th width="20%" scope="col">Modelo</th>
              <th width="20%" scope="col">Serie</th>
              <th width="20%" scope="col">Inventario</th>
              <th width="20%" scope="col">Clúster</th>
              <th width="20%" scope="col">No. Procesadores</th>
              <th width="20%" scope="col">Velocidad</th>
              <th width="20%" scope="col">Caché</th>
              <th width="20%" scope="col">Cantidad RAM</th>
              <th width="20%" scope="col">Tipo RAM</th>
              <th width="20%" scope="col">Tipo Video</th>
              <th width="20%" scope="col">Modelo Video</th>
              <th width="20%" scope="col">Memoria</th>
              <th width="20%" scope="col">Almacenamiento Primario</th>
              <th width="20%" scope="col">Número</th>
              <th width="20%" scope="col">Interfaz</th>
              <th width="20%" scope="col">Capacidad</th>
              <th width="20%" scope="col">Conexión</th>
              <th width="20%" scope="col">Velocidad</th>
              <th width="20%" scope="col">Salida Internet</th>
              <th width="20%" scope="col">Velocidad</th>
              <th width="20%" scope="col">Terminal</th>
              <th width="20%" scope="col">Criticidad</th>
              <th width="20%" scope="col">Recursos Adquisición</th>
              <th width="20%" scope="col">Utilización</th>
         </tr>
      <?php  
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
	   ?>
          <tr>
 <?php if ( $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9){ ?> <td width="20%"><?php echo $lab_invent['nombre'];?></td> <?php }?>
               <td width="20%" scope="col"><?php echo ucwords(strtolower($lab_invent['descmarca']));?></td>
               <td width="20%" scope="col"><?php echo ucwords(strtolower($lab_invent['modelo_p']));?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['serie'];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['inventario'];?></td>
                <?php if ( $lab_invent['cluster']==1) {?>
               <td width="20%" scope="col"><?php echo 'Si';?></td>
                <?php }else{ ?>
                <td width="20%" scope="col"><?php echo 'No';?></td>
                 <?php } ?>
               <td width="20%" scope="col"><?php echo $lab_invent['cantidad_procesador'];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['velocidad'];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['cache'];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['memoria_ram'];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['memoria_ram'];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['videotipo'];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['modelovideo'];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['videomem'];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent[''];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['num_elementos_almac'];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent[''];?></td>
               <td width="20%" scope="col"><?php echo $lab_invent['total_almac'];?></td>
                <?php if ( $lab_invent['conexion']==1) {?>
               <td width="20%" scope="col"><?php echo 'Si';?></td>
                <?php }else{ ?>
                <td width="20%" scope="col"><?php echo 'No';?></td>
                <?php } ?> 
                <td width="20%" scope="col"><?php echo $lab_invent['velocidad'];?></td>
               <?php if ( $lab_invent['salida']==1) {?>
                <td width="20%" scope="col"><?php echo 'Si';?></td>
                <?php }else{ ?>
                <td width="20%" scope="col"><?php echo 'No';?></td>
                <?php } ?> 
                <td width="20%" scope="col"><?php echo $lab_invent['velocidadint'];?></td>
                <td width="20%" scope="col"><?php echo $lab_invent['terminal'];?></td>
                <td width="20%" scope="col"><?php echo $lab_invent['nombcrit'];?></td>
                <td width="20%" scope="col"><?php echo $lab_invent['nombAdq'];?></td>
                <td width="20%" scope="col"><?php echo $lab_invent['nombre_perfil'];?></td>
            </tr>
       
           
<?php 

    $cuenta=$cuenta+$lab_invent['cuenta'];      
  	
		} ?>
  </table>  
<table class='material'>
<tr>
<th scope="row">TOTAL</th>
   <td width="20%" ><strong><?php echo $inventario . "  " . "Equipos";?></strong></td>
</tr>
</table>
 