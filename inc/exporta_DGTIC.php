
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
	

/*  este for es para cargar los datos de los renglones*/
//echo 'imprime la datos';
//print_r ($_POST);



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

<table>
   <tr>
       <td align="center" ><h2>Inventario para DGTIC por cada División</h2></td>
   </tr>
  

</table>
  
    <?php
          echo '<?xml version="1.0"?><?mso-application progid="Excel.Sheet"?>'; 
      ?>
<Workbook xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:x2="urn:schemas-microsoft-com:office:excel2" xmlns:html="http://www.w3.org/TR/REC-html40" xmlns:dt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">
 <x:ExcelWorkbook>
  <x:ActiveSheet>0</x:ActiveSheet>
 </x:ExcelWorkbook>
 <o:DocumentProperties>
  <o:Author>LUCIRALIA HERNANDEZ HERNANDEZ</o:Author>
  <o:Created>2024-05-07T14:30:05Z</o:Created>
  <o:LastSaved>2024-05-14T20:31:46Z</o:LastSaved>
 </o:DocumentProperties>
 <o:CustomDocumentProperties>
  <o:ContentTypeId>0x01010070B2076F8ADCAA4D947248F6310A519A</o:ContentTypeId>
  <o:Solution_x0020_ID>{15727DE6-F92D-4E46-ACB4-0E2C58B31A18}</o:Solution_x0020_ID>
 </o:CustomDocumentProperties>
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <ss:Alignment ss:Vertical="Bottom" />
   <ss:Font ss:Color="#000000" ss:FontName="Aptos Narrow" ss:Size="11" />
  </Style>
  <Style ss:ID="S21">
   <ss:Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1" />
   <ss:Borders>
    <ss:Border ss:Position="Left" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Top" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Right" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Bottom" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
   </ss:Borders>
   <ss:Font ss:Bold="1" ss:Color="#000000" ss:FontName="Aptos Narrow" ss:Size="10" />
  </Style>
  <Style ss:ID="S22">
   <ss:Alignment ss:Vertical="Bottom" ss:WrapText="1" />
   <ss:Borders>
    <ss:Border ss:Position="Left" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Top" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Right" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Bottom" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
   </ss:Borders>
   <ss:Font ss:Color="#000000" ss:FontName="Aptos Narrow" ss:Size="10" />
  </Style>
  <Style ss:ID="S23">
   <ss:Alignment ss:Vertical="Bottom" ss:WrapText="1" />
   <ss:Borders>
    <ss:Border ss:Position="Left" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Top" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Right" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Bottom" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
   </ss:Borders>
   <ss:Font ss:Color="#000000" ss:FontName="Aptos Narrow" ss:Size="10" />
   <ss:NumberFormat ss:Format="MM/dd/yyyy" />
  </Style>
  <Style ss:ID="S24">
   <ss:Alignment ss:Vertical="Bottom" ss:WrapText="1" />
   <ss:Borders>
    <ss:Border ss:Position="Left" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Top" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Right" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Bottom" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
   </ss:Borders>
   <ss:Font ss:Color="#000000" ss:FontName="Aptos Narrow" ss:Size="11" />
  </Style>
  <Style ss:ID="S25">
   <ss:Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1" />
   <ss:Font ss:Bold="1" ss:Color="#000000" ss:FontName="Aptos Narrow" ss:Size="18" />
  </Style>
  <Style ss:ID="S26">
   <ss:Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1" />
   <ss:Borders>
    <ss:Border ss:Position="Bottom" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
   </ss:Borders>
   <ss:Font ss:Bold="1" ss:Color="#000000" ss:FontName="Aptos Narrow" ss:Size="18" />
  </Style>
  <Style ss:ID="S27">
   <ss:Alignment ss:Vertical="Bottom" ss:WrapText="1" />
   <ss:Borders>
    <ss:Border ss:Position="Left" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Top" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Right" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Bottom" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
   </ss:Borders>
   <ss:Font ss:Color="#000000" ss:FontName="Aptos Narrow" ss:Size="10" />
   <ss:NumberFormat ss:Format="@" />
  </Style>
  <Style ss:ID="S28">
   <ss:Alignment ss:Vertical="Bottom" />
   <ss:Font ss:Color="#000000" ss:FontName="Aptos Narrow" ss:Size="11" />
   <ss:NumberFormat ss:Format="@" />
  </Style>
  <Style ss:ID="S29">
   <ss:Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1" />
   <ss:Borders>
    <ss:Border ss:Position="Left" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Top" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Right" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
    <ss:Border ss:Position="Bottom" ss:Color="#000000" ss:LineStyle="Continuous" ss:Weight="1" />
   </ss:Borders>
   <ss:Font ss:Bold="1" ss:Color="#000000" ss:FontName="Aptos Narrow" ss:Size="10" />
   <ss:NumberFormat ss:Format="@" />
  </Style>
 </Styles>
 <Worksheet ss:Name="Hoja1">
  <ss:Names />
  <ss:Table ss:DefaultRowHeight="15" ss:DefaultColumnWidth="67.5" ss:ExpandedRowCount="4" ss:ExpandedColumnCount="66">
   <Column ss:Index="1" ss:AutoFitWidth="0" ss:Width="96" />
   <Column ss:Index="2" ss:AutoFitWidth="0" ss:Width="97.5" />
   <Column ss:Index="4" ss:AutoFitWidth="0" ss:Width="78.75" />
   <Column ss:Index="5" ss:AutoFitWidth="0" ss:Width="88.5" />
   <Column ss:Index="6" ss:AutoFitWidth="0" ss:Width="90.75" />
   <Column ss:Index="7" ss:AutoFitWidth="0" ss:Width="72.75" />
   <Column ss:Index="8" ss:AutoFitWidth="0" ss:Width="87.75" />
   <Column ss:Index="9" ss:AutoFitWidth="0" ss:Width="89.25" />
   <Column ss:Index="11" ss:AutoFitWidth="0" ss:Width="82.5" />
   <Column ss:Index="15" ss:AutoFitWidth="0" ss:Width="76.5" />
   <Column ss:Index="16" ss:StyleID="S28" ss:Width="68.25" />
   <Column ss:Index="20" ss:AutoFitWidth="0" ss:Width="98.25" />
   <Column ss:Index="55" ss:AutoFitWidth="0" ss:Width="84.75" />
   <Row ss:Index="1">
    <Cell ss:MergeAcross="3" ss:MergeDown="1" ss:StyleID="S25"><Data ss:Type="String">Inventario importación por cada División</Data>
    </Cell>
   </Row>
   <Row ss:Index="2" ss:Height="42" />
   <Row ss:Index="3" ss:Height="27">
    <Cell ss:StyleID="S21"><Data ss:Type="String">dispositivo_clave</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">usuario_final_clave</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">familia_clave</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">tipo_ram_clave</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">tecnologia_clave</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">resguardo_nombre</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">resguardo_no_empleado</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">usuario_nombre</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">usuario_ubicación</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">usuario_perfil</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">usuario_sector</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">no_servicio</Data>
    </Cell>
	<Cell ss:StyleID="S21"><Data ss:Type="String">marca_p</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">no_factura</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">anios_garantía</Data>
    </Cell>
    <Cell ss:StyleID="S29"><Data ss:Type="String">inventario</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">modelo_p</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">proveedor_p</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">fecha_factura</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">familia_especificar</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">modelo_procesador</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">cantidad_procesador</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">nucleos_totales</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">nucleos_GPU</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">memoria_RAM</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">RAM_especificar</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">num_elementos_almac</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">total_almac</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">num_arreglos</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">esquema_uno</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">esquema_dos</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">esquema_tres</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">esquema_cuatro</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">tec_uno</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">tec_dos</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">tec_tres</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">tec_cuatro</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">subtotal_uno</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">subtotal_dos</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">subtotal_tres</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">subtotal_cuatro</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">arreglo_total</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">tec_com</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">tec_com_otro</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">sist_oper</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">version_sist_oper</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">licencia</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">licencia_ini</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">licencia_fin</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">tipo_impresora</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">id_tipo_digitalizador</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">id_tipo_access_point</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">id_tipo_red1</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">id_tipo_red2</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">id_tipo_firewall</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">id_ids</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">id_ips</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">id_tipo_switch</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">id_puerto_switch</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">chasis_switch</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">estado_equipo</Data>
    </Cell>
	<Cell ss:StyleID="S21"><Data ss:Type="String">id_mod</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">mac1</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">mac2</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">id_edificio</Data>
    </Cell>
    <Cell ss:StyleID="S21"><Data ss:Type="String">id_lab</Data>
    </Cell>
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
 $datos = pg_query($con,$query);
 $inventario= pg_num_rows($datos); 

  while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
	   
	  
	    // $inventario=(string)$lab_invent['inventario'];
	     $inventario=$lab_invent['inventario']; 
	    // echo 'imprime inventario cadena',$inventario; 
	
	    if ( $lab_invent['dispositivo_clave']>=1 && $lab_invent['dispositivo_clave']<=8)
		{
	       $query="SELECT e.id_dispositivo,id_disp_mac,red_acceso FROM dispositivo e
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
	<Row ss:Index="4">
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['dispositivo_clave']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['usuario_final_clave']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['familia_clave']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['tipo_ram_clave']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['tecnologia_clave']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['nombre_resguardo']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['resguardo_no_empleado']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['usuario_nombre']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['usuario_ubicacion']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['usuario_perfil']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['usuario_sector']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['serie']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['marca_p']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['no_factura']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['anos_garantia']; ?>
    <Cell ss:StyleID="S27" /> <?php echo $lab_invent['inventario']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['modelo_p']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['proveedor_p']; ?>
    <Cell ss:StyleID="S23" /> <?php echo $lab_invent['fecha_factura']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['familia_especificar']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['modelo_procesador']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['cantidad_procesador']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['nucleos_totales']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['nucleos_gpu']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['memoria_ram']; ?>
    <Cell ss:StyleID="S24" /> <?php echo $lab_invent['ram_especificar']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['num_elementos_almac']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['total_almac']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['num_arreglos']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['esquema_uno']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['esquema_dos']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['esquema_tres']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['esquema_cuatro']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['tec_uno']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['tec_dos']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['tec_tres']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['tec_cuatro']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['subtotal_uno']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['subtotal_dos']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['subtotal_tres']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['subtotal_cuatro']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['arreglo_total']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['tec_com']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['tec_com_otro']; ?>
    <Cell ss:StyleID="S24" /> <?php echo $lab_invent['sist_oper']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['version_sist_oper']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['licencia']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['licencia_ini']; ?>
    <Cell ss:StyleID="S23" /> <?php echo $lab_invent['licencia_fin']; ?>
    <Cell ss:StyleID="S23" /> <?php echo $lab_invent['id_impresora']; ?>
    <Cell ss:StyleID="S24" /> <?php echo $lab_invent['id_digitaliza']; ?>
    <Cell ss:StyleID="S24" /> <?php echo $lab_invent['id_access']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $red1; ?>
    <Cell ss:StyleID="S22" /> <?php echo $red2; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['id_firewall']; ?>
    <Cell ss:StyleID="S24" /> <?php echo $lab_invent['id_ids']; ?>
    <Cell ss:StyleID="S24" /> <?php echo $lab_invent['id_ips']; ?>
    <Cell ss:StyleID="S24" /> <?php echo $lab_invent['id_tipo_switch']; ?>
    <Cell ss:StyleID="S24" /> <?php echo $lab_invent['id_puerto']; ?>
    <Cell ss:StyleID="S24" /> <?php echo $lab_invent['id_chasis']; ?>
    <Cell ss:StyleID="S24" /> <?php echo $lab_invent['estado_equipo']; ?>
    <Cell ss:StyleID="S24" /> <?php echo $lab_invent['id_mod']; ?>
    <Cell ss:StyleID="S24" /> <?php echo $mac1;?>
    <Cell ss:StyleID="S22" /> <?php echo $mac2;?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['id_edif']; ?>
    <Cell ss:StyleID="S22" /> <?php echo $lab_invent['id_lab']; ?>
   </Row>	
	   </ss:Table>
	<?php   
        $mac1=NULL;
	    $mac2=NULL;
	    $red1=NULL;
	    $red2=NULL;
  } 
  ?>
<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Header x:Margin="0.3" />
    <Footer x:Margin="0.3" />
    <PageMargins x:Top="0.75" x:Bottom="0.75" x:Left="0.7" x:Right="0.7" />
   </PageSetup>
   <Print>
    <PaperSizeIndex>9</PaperSizeIndex>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
   </Print>
   <LeftColumnVisible>5</LeftColumnVisible>
   <Panes>
    <Pane>
     <Number>3</Number>
     <ActiveRow>3</ActiveRow>
     <ActiveCol>17</ActiveCol>
     <RangeSelection>R4C18</RangeSelection>
    </Pane>
   </Panes>
  </WorksheetOptions>
 </Worksheet>
</Workbook>	 
	 
  	