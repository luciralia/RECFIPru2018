<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
session_start(); //Nueva linea
require_once('../conexion.php'); // nueva linea
require_once('../clases/exporta.class.php'); //Nueva linea

require_once('../clases/inventario.class.php');
$obj_xls=new Exportaxls(); // nueva linea
$esquema=new inventario();
$madq = new inventario();
$exhibe_mac=new Exportaxls(); 	

date_default_timezone_set('America/Mexico_City');
header('Content-type: application/x-msexcel'); 
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );

if ($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==9 ) {
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
		   
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);

    $texto='Content-Disposition: attachment;filename="inventarioDGTICdiv_' . date("Ymd-His") . "_" . $nombdiv[0]. '.xls"';


 }elseif  ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']=='' ) 
   $texto='Content-Disposition: attachment;filename="inventarioDGTIC' . date("Ymd-His") . "_FacultadIngenieria.xls";
    elseif  ($_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!='' ) 
	{
		$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
		   
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);

    $texto='Content-Disposition: attachment;filename="inventarioDGTICdiv_' . date("Ymd-His") . "_" . $nombdiv[0]. '.xls"';}
	
header($texto);
?>
<?php
     echo '<?xml version="1.0"?>
     <?mso-application progid="Excel.Sheet"?>'; 
 ?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:dt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author>CPD_PRUEBA</Author>
  <LastAuthor>CPD_PRUEBA</LastAuthor>
  <Created>2024-05-07T14:30:05Z</Created>
  <LastSaved>2024-05-28T19:40:57Z</LastSaved>
  <Version>16.00</Version>
 </DocumentProperties>
 <CustomDocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <ContentTypeId dt:dt="string">0x01010070B2076F8ADCAA4D947248F6310A519A</ContentTypeId>
  <Solution_x0020_ID dt:dt="string">{15727DE6-F92D-4E46-ACB4-0E2C58B31A18}</Solution_x0020_ID>
 </CustomDocumentProperties>
 <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
  <AllowPNG/>
 </OfficeDocumentSettings>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>15120</WindowHeight>
  <WindowWidth>19440</WindowWidth>
  <WindowTopX>32767</WindowTopX>
  <WindowTopY>32767</WindowTopY>
  <ProtectStructure>False</ProtectStructure>
  <ProtectWindows>False</ProtectWindows>
 </ExcelWorkbook>
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Aptos Narrow" x:Family="Swiss" ss:Size="11"
    ss:Color="#000000"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s16">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Aptos Narrow" x:Family="Swiss" ss:Color="#000000" ss:Bold="1"/>
  </Style>
  <Style ss:ID="s17">
   <Alignment ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Aptos Narrow" x:Family="Swiss" ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s22">
   <Alignment ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Aptos Narrow" x:Family="Swiss" ss:Color="#000000"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s23">
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s24">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
     ss:Color="#000000"/>
   </Borders>
   <Font ss:FontName="Aptos Narrow" x:Family="Swiss" ss:Color="#000000" ss:Bold="1"/>
   <NumberFormat ss:Format="@"/>
  </Style>
  <Style ss:ID="s25">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Font ss:FontName="Aptos Narrow" x:Family="Swiss" ss:Size="18"
    ss:Color="#000000" ss:Bold="1"/>
  </Style>
 </Styles>
 <Worksheet ss:Name="Hoja1">
  <Table ss:ExpandedColumnCount="66" ss:ExpandedRowCount="4" x:FullColumns="1"
   x:FullRows="1" ss:DefaultColumnWidth="60" ss:DefaultRowHeight="15">
   <Column ss:AutoFitWidth="0" ss:Width="84"/>
   <Column ss:AutoFitWidth="0" ss:Width="85.5"/>
   <Column ss:Index="4" ss:AutoFitWidth="0" ss:Width="69"/>
   <Column ss:AutoFitWidth="0" ss:Width="77.25"/>
   <Column ss:AutoFitWidth="0" ss:Width="79.5"/>
   <Column ss:AutoFitWidth="0" ss:Width="63.75"/>
   <Column ss:AutoFitWidth="0" ss:Width="76.5"/>
   <Column ss:AutoFitWidth="0" ss:Width="78"/>
   <Column ss:Index="11" ss:AutoFitWidth="0" ss:Width="72"/>
   <Column ss:Index="15" ss:AutoFitWidth="0" ss:Width="66.75"/>
   <Column ss:StyleID="s23" ss:AutoFitWidth="0"/>
   <Column ss:Index="20" ss:AutoFitWidth="0" ss:Width="86.25"/>
   <Column ss:Index="55" ss:AutoFitWidth="0" ss:Width="74.25"/>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeAcross="3" ss:MergeDown="1" ss:StyleID="s25"><Data
      ss:Type="String">Inventario importación por cada División</Data></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="42"/>
   <Row ss:Height="27">
    <Cell ss:StyleID="s16"><Data ss:Type="String">dispositivo_clave</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">usuario_final_clave</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">familia_clave</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">tipo_ram_clave</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">tecnologia_clave</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">resguardo_nombre</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">resguardo_no_empleado</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">usuario_nombre</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">usuario_ubicación</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">usuario_perfil</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">usuario_sector</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">no_servicio</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">marca_p</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">no_factura</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">anios_garantía</Data></Cell>
    <Cell ss:StyleID="s24"><Data ss:Type="String">inventario</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">modelo_p</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">proveedor_p</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">fecha_factura</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">familia_especificar</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">modelo_procesador</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">cantidad_procesador</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">nucleos_totales</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">nucleos_GPU</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">memoria_RAM</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">RAM_especificar</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">num_elementos_almac</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">total_almac</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">num_arreglos</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">esquema_uno</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">esquema_dos</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">esquema_tres</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">esquema_cuatro</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">tec_uno</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">tec_dos</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">tec_tres</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">tec_cuatro</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">subtotal_uno</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">subtotal_dos</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">subtotal_tres</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">subtotal_cuatro</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">arreglo_total</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">tec_com</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">tec_com_otro</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">sist_oper</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">version_sist_oper</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">licencia</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">licencia_ini</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">licencia_fin</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">tipo_impresora</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">id_tipo_digitalizador</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">id_tipo_access_point</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">id_tipo_red1</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">id_tipo_red2</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">id_tipo_firewall</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">id_ids</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">id_ips</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">id_tipo_switch</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">id_puerto_switch</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">chasis_switch</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">estado_equipo</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">mac1</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">mac2</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">id_mod</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">id_edificio</Data></Cell>
    <Cell ss:StyleID="s16"><Data ss:Type="String">id_lab</Data></Cell>
   </Row>
	 <?php  
	  	
if (($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==9 ) && $_SESSION['id_div']!=''){
	
$query= "SELECT  e.*, 
         l.nombre as laboratorio 
         FROM dispositivo e 
         JOIN cat_marca cm
         ON cm.id_marca=e.id_marca
         JOIN laboratorios l
         ON  l.id_lab=e.id_lab
         JOIN departamentos d
         ON d.id_dep=l.id_dep
         JOIN divisiones div
         ON div.id_div=d.id_div
		 LEFT JOIN impresora i
		 ON i.id_dispositivo=e.id_dispositivo
		 LEFT JOIN access ac
		 ON ac.id_dispositivo=e.id_dispositivo
		 LEFT JOIN switch sw 
		 ON sw.id_dispositivo=e.id_dispositivo
		 LEFT JOIN digitaliza dg
		 ON dg.id_dispositivo=e.id_dispositivo
		 LEFT JOIN firewall fw
		 ON e.id_dispositivo=fw.id_dispositivo
		 LEFT JOIN ips 
		 ON e.id_dispositivo=ips.id_dispositivo
		 LEFT JOIN ids 
		 ON e.id_dispositivo=ids.id_dispositivo
         WHERE div.id_div=" . $_SESSION['id_div'] .
         "
          AND e.id_dispositivo>=2240
         ORDER BY laboratorio" ;
} elseif  ($_SESSION['tipo_usuario']==10  && $_SESSION['id_div']=='' ) {
	
$query= "SELECT  e.*, 
         l.nombre as laboratorio, bi.*,* 
         FROM dispositivo e 
         JOIN cat_marca cm
         ON cm.id_marca=e.id_marca
         JOIN laboratorios l
         ON  l.id_lab=e.id_lab
         JOIN departamentos d
         ON d.id_dep=l.id_dep
         JOIN divisiones div
         ON div.id_div=d.id_div
		 LEFT JOIN impresora i
		 ON i.id_dispositivo=e.id_dispositivo
		 LEFT JOIN access ac
		 ON ac.id_dispositivo=e.id_dispositivo
		 LEFT JOIN switch sw 
		 ON sw.id_dispositivo=e.id_dispositivo
		 LEFT JOIN digitaliza dg
		 ON dg.id_dispositivo=e.id_dispositivo
		 LEFT JOIN firewall fw
		 ON e.id_dispositivo=fw.id_dispositivo
		 LEFT JOIN ips 
		 ON e.id_dispositivo=ips.id_dispositivo
		 LEFT JOIN ids 
		 ON e.id_dispositivo=ids.id_dispositivo
		 ORDER BY laboratorio" ;
}  elseif  ($_SESSION['tipo_usuario']==10  && $_SESSION['id_div']!='' ) {
	
	$query= "SELECT  e.*, 
         l.nombre as laboratorio, bi.*,* 
         FROM dispositivo e 
         JOIN cat_marca cm
         ON cm.id_marca=e.id_marca
         JOIN laboratorios l
         ON  l.id_lab=e.id_lab
         JOIN departamentos d
         ON d.id_dep=l.id_dep
         JOIN divisiones div
         ON div.id_div=d.id_div
		 LEFT JOIN impresora i
		 ON i.id_dispositivo=e.id_dispositivo
		 LEFT JOIN access ac
		 ON ac.id_dispositivo=e.id_dispositivo
		 LEFT JOIN switch sw 
		 ON sw.id_dispositivo=e.id_dispositivo
		 LEFT JOIN digitaliza dg
		 ON dg.id_dispositivo=e.id_dispositivo
		 LEFT JOIN firewall fw
		 ON e.id_dispositivo=fw.id_dispositivo
		 LEFT JOIN ips 
		 ON e.id_dispositivo=ips.id_dispositivo
		 LEFT JOIN ids 
		 ON e.id_dispositivo=ids.id_dispositivo
         WHERE div.id_div=" . $_SESSION['id_div'] .
         "
         ORDER BY laboratorio" ;
}
	  echo $query;
 $datos = pg_query($con,$query);
 $inventario= pg_num_rows($datos); 

  while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
	   
	  
	    // $inventario=(string)$lab_invent['inventario'];
	     $inventario=$lab_invent['inventario']; 
	    // echo 'imprime inventario cadena',$inventario; 
	
	    if ( $lab_invent['dispositivo_clave']>=1 && $lab_invent['dispositivo_clave']<=8)
		{
	       $query="SELECT e.id_dispositivo,id_disp_mac,mac FROM dispositivo e
		           LEFT JOIN mac m
		           ON m.id_dispositivo=e.id_dispositivo
		           WHERE inventario="."'".$lab_invent['inventario']."'";
	       
		   $result= pg_query($query) or die('Hubo un error con la base de datos');
           $arreglo= pg_fetch_array($result);
		   $cuenta= pg_num_rows($result);	
		  	
		   $id_disp_mac=$arreglo[1];
		   $mac1=$arreglo[2];
		   $mac2=NULL;
		 
	       if ($cuenta==1)	{
		     $mac1=$arreglo[2];
			 $mac2=NULL;
			} else if($cuenta==2) {
		       $id_mac=$id_disp_mac+1;
		       $query="SELECT e.id_dispositivo,id_disp_mac,mac FROM dispositivo e
		         LEFT JOIN mac m
		         ON m.id_dispositivo=e.id_dispositivo
		         WHERE id_disp_mac= ". $id_mac . "
				 AND  inventario="."'".$lab_invent['inventario']."'";
		    // echo $query;
	          $result= pg_query($query) or die('Hubo un error con la base de datos');
              $arreglo= pg_fetch_array($result);
		      $cuenta= pg_num_rows($result);	
		      $mac2=$arreglo[2];
		  //echo 'imprime mac',$mac2; 
			 
		   }
	     }// fin de buscar mac
		   if ( $lab_invent['dispositivo_clave']==14)
		   {
	       $query="SELECT e.id_dispositivo,id_access,id_tipo_red FROM dispositivo e
                   LEFT JOIN access a
                   ON a.id_dispositivo=e.id_dispositivo
                   LEFT JOIN red_difunde rd
                   ON rd.id_dispositivo=e.id_dispositivo
                   WHERE inventario="."'".$lab_invent['inventario']."'";
	       
		   $result= pg_query($query) or die('Hubo un error con la base de datos');
           $arreglo= pg_fetch_array($result);
		   $cuenta= pg_num_rows($result);	
		  	
		   $id_tipo_red=$arreglo[2];
		   $red1=$arreglo[2];
		   $red2=NULL;
		 
	       if ($cuenta==1)	{
		     $red1=$arreglo[2];
			 $red2=NULL;
			} else if($cuenta==2) {
		       $id_red=$id_tipo_red+1;
		       $query="SELECT e.id_dispositivo,id_access,id_tipo_red FROM dispositivo e
                   LEFT JOIN access a
                   ON a.id_dispositivo=e.id_dispositivo
                   LEFT JOIN red_difunde rd
                   ON rd.id_dispositivo=e.id_dispositivo
                   WHERE id_tipo_red= ". $id_red . "
		           AND  inventario="."'".$lab_invent['inventario']."'";
		    // echo $query;
	       
		      $result= pg_query($query) or die('Hubo un error con la base de datos');
              $arreglo= pg_fetch_array($result);
		      $cuenta= pg_num_rows($result);	
		      $red2=$arreglo[2];
		  //echo 'imprime mac',$mac2; 
		   }
		}
	  
	         ?>
	  <Row>
    <Cell><Data ss:Type="String">Valor de la celda 1</Data></Cell>
    <Cell><Data ss:Type="String">Valor de la celda 2</Data></Cell>
    <!-- Más celdas aquí si es necesario -->
    </Row>
	<Row ss:Height="27">
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['dispositivo_clave'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['usuario_final_clave'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['familia_clave'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['tipo_ram_clave'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['tecnologia_clave'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['resguardo_nombre'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['resguardo_no_empleado'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['usuario_nombre'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['usuario_ubicacion'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['usuario_perfil'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['usuario_sector'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['no_servicio'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['marca_p'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['no_factura'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['anios_garantia'];?></Data></Cell>
    <Cell ss:StyleID="s22"><Data ss:Type="String"><?php echo $inventario;?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['modelo_p'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['proveedor_p'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['fecha_factura'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['familia_especificar'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['modelo_procesador'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['cantidad_procesador'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['nucleos_totales'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['nucleos_GPU'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['memoria_RAM'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['RAM_especificar'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['num_elementos_almac'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['total_almac'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['num_arreglos'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['esquema_uno'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['esquema_dos'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['esquema_tres'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['esquema_cuatro'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['tec_uno'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['tec_dos'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['tec_tres'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['tec_cuatro'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['subtotal_uno'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['subtotal_dos'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['subtotal_tres'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['subtotal_cuatro'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['arreglo_total'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['tec_com'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['tec_com_otro'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['sist_oper'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['version_sist_oper'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['licencia'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['licencia_ini'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['licencia_fin'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['tipo_impresora'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['id_tipo_digitalizador'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['id_tipo_access_point'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $red1;?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $red2;?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['id_tipo_firewall'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['id_ids'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['id_ips'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['id_tipo_switch'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['id_puerto_switch'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['chasis_switch'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['estado_equipo'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $mac1;?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $mac2;?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['id_mod'];?>#</Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['id_edificio'];?></Data></Cell>
    <Cell ss:StyleID="s17"><Data ss:Type="String"><?php echo $lab_invent['id_lab'];?></Data></Cell>
   </Row>
	
	<?php   
        $mac1=NULL;
	    $mac2=NULL;
	    $red1=NULL;
	    $red2=NULL;
  } //fin del while
  ?>
</Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Header x:Margin="0.3"/>
    <Footer x:Margin="0.3"/>
    <PageMargins x:Bottom="0.75" x:Left="0.7" x:Right="0.7" x:Top="0.75"/>
   </PageSetup>
   <Selected/>
   <Panes>
    <Pane>
     <Number>3</Number>
     <ActiveRow>2</ActiveRow>
    </Pane>
   </Panes>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
</Workbook>