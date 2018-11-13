<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
<HEAD>
</HEAD>
<BODY>
<?php 
session_start();
require_once('../conexion.php');
require_once('../clases/bitacora.class.php');
$obj_bit=new Bitacora();

//For principal--- peina todos los registros
for ($i=1;$i<$_POST['j'];$i++){
				
				$checkbox='servicio'.$i;
			   
			   if (isset($_POST[$checkbox])){
				
				$renglon_bit=$obj_bit->rengBit($_REQUEST['lab'],$_REQUEST['mod'],$_REQUEST[$checkbox]);

				//echo "</br>los datos del renglon $i: </br>";
				
				foreach ($renglon_bit as $reng) {
			        					
					foreach ($reng as $campo => $valor) {
						//echo "</br> Campo: ".$campo." valor: ".$valor."</br>";
						$registro[$campo]=$valor;
				
					}
				
				}
			   //print_r($registro);
			}// fin if
		
		} // fin for
	//echo  "<br>el número de renglones será" .  count($renglon_bit) . " ++++++++++++++++++++++++++++++++++++++" ;
	//print_r($renglon_bit);

for ($i=0;$i<count($renglon_bit);$i++){ ?>


</br>el equipo: <?php echo $eq=$i+1 . " "; ?>es:  <?php echo $renglon_bit[$i]['bn_desc']; ?>



   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s144"><Data ss:Type="String"><?php echo $actividad=($renglon_bit[$i]['actividad']==2)?'X':''; ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s145"><Data ss:Type="String">Docencia</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904004"><Data ss:Type="DateTime"><?php echo date('Y-m-d', strtotime($renglon_bit[$i]['fregistro']))."T00:00:00.000";  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904024"><Data ss:Type="String"><?php echo $renglon_bit[$i]['bn_desc'];  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="3" ss:StyleID="m133904044"><Data
      ss:Type="String"><?php echo $renglon_bit[$i]['clave'];  ?></Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904064"><Data ss:Type="String"><?php echo $renglon_bit[$i]['detecto'];  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904084"><Data ss:Type="String"><?php echo $renglon_bit[$i]['falla'];  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133904128"><Data
      ss:Type="String"><?php echo $renglon_bit[$i]['reporta'];  ?></Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904148"><Data ss:Type="DateTime"><?php echo date('Y-m-d', strtotime($renglon_bit[$i]['fsalida']))."T00:00:00.000";  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="3" ss:StyleID="m133904168"><Data ss:Type="DateTime"><?php echo date('Y-m-d', strtotime($renglon_bit[$i]['frecepcion']))."T00:00:00.000";  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m133904188"><Data
      ss:Type="String"><?php echo $renglon_bit[$i]['supervisor'];  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="20.25">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/><Data ss:Type="String"><?php echo $actividad=($renglon_bit[$i]['actividad']==3)?'X':''; ?></Data></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Investigación</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s195"><NamedCell ss:Name="Print_Area"/><Data ss:Type="String"><?php echo $actividad=($renglon_bit[$i]['actividad']==5)?'X':''; ?></Data></Cell>
    <Cell ss:StyleID="s196"><Data ss:Type="String">Curso</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="21">
    <Cell ss:StyleID="s197"><NamedCell ss:Name="Print_Area"/><Data ss:Type="String"><?php echo $actividad=($renglon_bit[$i]['actividad']==7)?'X':''; ?></Data></Cell>
    <Cell ss:StyleID="s198"><Data ss:Type="String">Proyecto</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="9" ss:MergeAcross="1" ss:StyleID="m133904208"><Data
      ss:Type="String">Nombre </Data><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="13" ss:MergeAcross="1" ss:StyleID="m133904228"><Data
      ss:Type="String">Nombre y Firma.</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>



<?php
} //fin del for de renglon

?>
<?php

/*
$mod=$_REQUEST['mod'];
				if ($mod=='serv'){
				$tiposerv="(em.tipo_serv IS NULL OR em.tipo_serv IS FALSE) ";
				} else {$tiposerv='TRUE';
				$tiposerv="em.tipo_serv IS TRUE";
				}
				
				if ($mod=='servibf'){
				$tipomant=" AND em.tipo_mant='C'";
				} 
				else if($mod=='servibp'){ 
				$tipomant=" AND em.tipo_mant='P'";
				} else {$tipomant=" ";}
				
				
				 for ($i=1;$i<$_POST['j'];$i++){
							   $checkbox='servicio'.$i;
							   if (isset($_POST[$checkbox])){


					 $query="SELECT l.id_lab as id_lab, em.id_evento as id_evento, em.id_bitacora as id_bitacora, em.tipo_mant as tipo, em.fecha as fregistro, em.tipo_falla as falla, em.usuario_reporta as reporta, em.fecha_salida as fsalida, em.fecha_recepcion as frecepcion, em.costo as costo, em.fecha_prox_mant as fprox, em.descripcion as desc_serv, em.garantia as garantia, bi.bn_desc as bn_desc, bi.bn_marca as marca, bi.bn_modelo as modelo, bi.bn_serie as serie, bi.bn_clave as clave, l.nombre AS laboratorio, dp.nombre AS departamento, dv.nombre AS division, u.nombre AS RL_Nombre, u.a_paterno AS RL_apaterno, u.a_materno AS RL_amaterno, em.id_cotizacion as id_cotizacion, em.ok as sitio, em.tipo_serv, e.bn_id as bn_id, em.semestre as semestre, em.actividad as actividad, em.supervisor as supervisor, em.detecto as detecto 
				FROM eventos_mantenimiento em, bitacora b, equipo e, bienes_inventario bi, laboratorios l, departamentos dp, divisiones dv, usuarios u 
				WHERE em.id_bitacora = b.id_bitacora 
				AND bi.bn_id = e.bn_id 
				AND e.bn_id = em.id_equipo 
				AND e.id_lab = b.id_lab 
				AND l.id_lab = e.id_lab 
				AND l.id_dep = dp.id_dep 
				AND dp.id_div = dv.id_div
				AND l.id_responsable=u.id_usuario" .$tipomant. " 
				AND " . $tiposerv . " 
				AND em.id_evento=" . $_POST[$checkbox] . "
				AND l.id_lab=" . $_REQUEST['lab'] . " order by fregistro DESC";
 
				echo "</br></br></br>" . "iter: " . $i . "Mod= " . $mod; // . "query: " . $query;
				
				$result = pg_query($query) or die('Hubo un error con la base de datos');
				$datosc = pg_fetch_array($result, NULL, PGSQL_ASSOC);
				print_r($datosc);
				
				
								 }//fin if
							   
							   
						   }//fin for  
					  */

?>

</BODY>
</HTML>