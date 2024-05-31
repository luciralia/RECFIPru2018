<?php
session_start();
require_once('../conexion.php');
require_once('../clases/exporta.class.php');
require_once('../clases/inventario.class.php');

$obj_xls = new Exportaxls();
$esquema = new inventario();
$madq = new inventario();
$exhibe_mac = new Exportaxls();

date_default_timezone_set('America/Mexico_City');
header('Content-type: application/x-msexcel'); 
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

if ($_SESSION['tipo_usuario'] == 1 || $_SESSION['tipo_usuario'] == 9) {
    $querydiv = "SELECT nombre FROM divisiones WHERE id_div=" . $_SESSION['id_div'];
    $registrodiv = pg_query($con, $querydiv);
    $nombdiv = pg_fetch_array($registrodiv);

    $texto = 'Content-Disposition: attachment;filename="inventarioDGTICdiv_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
} elseif ($_SESSION['tipo_usuario'] == 10 && $_SESSION['id_div'] == '') {
    $texto = 'Content-Disposition: attachment;filename="inventarioDGTIC' . date("Ymd-His") . "_FacultadIngenieria.xls";
} elseif ($_SESSION['tipo_usuario'] == 10 && $_SESSION['id_div'] != '') {
    $querydiv = "SELECT nombre FROM divisiones WHERE id_div=" . $_SESSION['id_div'];
    $registrodiv = pg_query($con, $querydiv);
    $nombdiv = pg_fetch_array($registrodiv);

    $texto = 'Content-Disposition: attachment;filename="inventarioDGTICdiv_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
}

header($texto);
?>

<?php
echo '<?xml version="1.0"
<?mso-application progid="Excel.Sheet"?>';?>

<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author>Author Name</Author>
  <LastAuthor>Author Name</LastAuthor>
  <Created>2024-05-31T00:00:00Z</Created>
  <Version>16.00</Version>
 </DocumentProperties>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>10005</WindowHeight>
  <WindowWidth>10005</WindowWidth>
  <WindowTopX>240</WindowTopX>
  <WindowTopY>75</WindowTopY>
  <ProtectStructure>False</ProtectStructure>
  <ProtectWindows>False</ProtectWindows>
 </ExcelWorkbook>
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
 </Styles>
 <Worksheet ss:Name="Sheet1">
  <Table>
   <Row>
    <Cell><Data ss:Type="String">ID</Data></Cell>
    <Cell><Data ss:Type="String">Nombre</Data></Cell>
    <Cell><Data ss:Type="Number">Edad</Data></Cell>
   </Row>
   <Row>
    <Cell><Data ss:Type="Number">1</Data></Cell>
    <Cell><Data ss:Type="String">Juan</Data></Cell>
    <Cell><Data ss:Type="Number">30</Data></Cell>
   </Row>
   <Row>
    <Cell><Data ss:Type="Number">2</Data></Cell>
    <Cell><Data ss:Type="String">María</Data></Cell>
    <Cell><Data ss:Type="Number">25</Data></Cell>
   </Row>
   <Row>
    <Cell><Data ss:Type="Number">003</Data></Cell>
    <Cell><Data ss:Type="String">Pedro</Data></Cell>
    <Cell><Data ss:Type="Number">40</Data></Cell>
   </Row>
  </Table>
 </Worksheet>
</Workbook>