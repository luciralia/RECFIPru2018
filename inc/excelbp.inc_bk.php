<?php
date_default_timezone_set('America/Mexico_City');
header('Content-type: application/x-msexcel'); 
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
//header("Content-type: text/html");
$texto='Content-Disposition: attachment;filename="bitacora_preventivo' . date("Ymd-His") . "_" . $_REQUEST['laboratorio'] . '.xls"';
header($texto);

// echo $query;  

//print_r($_REQUEST);
?>




<?php 
echo '<?xml version="1.0"?>
<?mso-application progid="Excel.Sheet"?>'
; ?>

<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:dt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 <DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <Author>Halcon</Author>
  <LastAuthor>osvaldo</LastAuthor>
  <LastPrinted>2011-10-20T14:50:02Z</LastPrinted>
  <Created>2008-03-14T03:15:30Z</Created>
  <LastSaved>2015-10-14T20:47:19Z</LastSaved>
  <Version>14.00</Version>
 </DocumentProperties>
 <CustomDocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <WorkbookGuid dt:dt="string">888cf803-2ea8-4590-a2df-89d04ff34a66</WorkbookGuid>
 </CustomDocumentProperties>
 <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
  <AllowPNG/>
 </OfficeDocumentSettings>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>7875</WindowHeight>
  <WindowWidth>15360</WindowWidth>
  <WindowTopX>0</WindowTopX>
  <WindowTopY>2460</WindowTopY>
  <ProtectStructure>False</ProtectStructure>
  <ProtectWindows>False</ProtectWindows>
 </ExcelWorkbook>
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="s40" ss:Name="�nfasis2">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#FFFFFF"/>
   <Interior ss:Color="#C0504D" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="m51184064">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m51184084">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection/>
  </Style>
  <Style ss:ID="m51184104">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection/>
  </Style>
  <Style ss:ID="m51184124">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m51184144">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m51184164">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="&quot;$&quot;#,##0.00"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m51184184">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m51184204">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection/>
  </Style>
  <Style ss:ID="m51184244">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725728">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725748">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="&quot;$&quot;#,##0.00"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725768">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725788">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="&quot;$&quot;#,##0.00"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725808">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725828">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725300">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725320">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725360">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725380">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection/>
  </Style>
  <Style ss:ID="m48725440">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725056">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725076">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection/>
  </Style>
  <Style ss:ID="m48725096">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725116">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725136">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725156">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725176">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725196">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48725216">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="&quot;$&quot;#,##0.00"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724872">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724912">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="&quot;$&quot;#,##0.00"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724932">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724952">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724972">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="&quot;$&quot;#,##0.00"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724992">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724608">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection/>
  </Style>
  <Style ss:ID="m48724628">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724648">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724668">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724688">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724748">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724788">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection/>
  </Style>
  <Style ss:ID="m48724384">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724404">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="&quot;$&quot;#,##0.00"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724424">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="&quot;$&quot;#,##0.00"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724444">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724464">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724484">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724160">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection/>
  </Style>
  <Style ss:ID="m48724200">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724220">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724240">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724280">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724320">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48723956">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48723976" ss:Parent="s40">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
   <Protection/>
  </Style>
  <Style ss:ID="m48724036">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724056">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="&quot;$&quot;#,##0.00"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48724076">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="&quot;$&quot;#,##0.00"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48723772">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48723792">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48723852">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48723872">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Short Date"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48723040">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection/>
  </Style>
  <Style ss:ID="m48723060">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection/>
  </Style>
  <Style ss:ID="m48723080">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48723100">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48723120">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48723140">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="27"
    ss:Color="#000000" ss:Bold="1"/>
  </Style>
  <Style ss:ID="m48723160" ss:Parent="s40">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
   <Protection/>
  </Style>
  <Style ss:ID="m48723200">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="27"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="m48723220" ss:Parent="s40">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
   <Protection/>
  </Style>
  <Style ss:ID="m48722592">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48722612">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48722632">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48722652">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48722672">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48722692">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48722712">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="&quot;$&quot;#,##0.00"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48722732">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48722752">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48722224" ss:Parent="s40">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
   <Protection/>
  </Style>
  <Style ss:ID="m48722244">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection/>
  </Style>
  <Style ss:ID="m48722264">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection/>
  </Style>
  <Style ss:ID="m48722284">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection/>
  </Style>
  <Style ss:ID="m48722304">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="m48722324">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="&quot;$&quot;#,##0.00"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s62">
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s63">
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="Fixed"/>
  </Style>
  <Style ss:ID="s64">
   <Alignment ss:Vertical="Bottom"/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s65">
   <Alignment ss:Vertical="Bottom"/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s66" ss:Parent="s40">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22" ss:Bold="1"/>
   <Interior ss:Color="#C0C0C0" ss:Pattern="Solid"/>
   <Protection/>
  </Style>
  <Style ss:ID="s67">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s68">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s69">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s70">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s71">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s72">
   <Alignment ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s73">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s139">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="22"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s141">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s173">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="27"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s176">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s177">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s178">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="27"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s179">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s180">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s183">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
   <NumberFormat ss:Format="#,##0"/>
   <Protection ss:Protected="0"/>
  </Style>
  <Style ss:ID="s185">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000"/>
  </Style>
  <Style ss:ID="s208">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="20"
    ss:Color="#000000" ss:Underline="Single"/>
  </Style>
 </Styles>
 <Names>
  <NamedRange ss:Name="LOCAL_DATE_SEPARATOR"
   ss:RefersTo="=INDEX(GET.WORKSPACE(37),17)" ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_DAY_FORMAT" ss:RefersTo="=INDEX(GET.WORKSPACE(37),21)"
   ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_HOUR_FORMAT"
   ss:RefersTo="=INDEX(GET.WORKSPACE(37),22)" ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_MINUTE_FORMAT"
   ss:RefersTo="=INDEX(GET.WORKSPACE(37),23)" ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_MONTH_FORMAT"
   ss:RefersTo="=INDEX(GET.WORKSPACE(37),20)" ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_MYSQL_DATE_FORMAT"
   ss:RefersTo="=REPT(LOCAL_YEAR_FORMAT,4)&amp;LOCAL_DATE_SEPARATOR&amp;REPT(LOCAL_MONTH_FORMAT,2)&amp;LOCAL_DATE_SEPARATOR&amp;REPT(LOCAL_DAY_FORMAT,2)&amp;&quot; &quot;&amp;REPT(LOCAL_HOUR_FORMAT,2)&amp;LOCAL_TIME_SEPARATOR&amp;REPT(LOCAL_MINUTE_FORMAT,2)&amp;LOCAL_TIME_SEPARATOR&amp;REPT(LOCAL_SECOND_FORMAT,2)"
   ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_SECOND_FORMAT"
   ss:RefersTo="=INDEX(GET.WORKSPACE(37),24)" ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_TIME_SEPARATOR"
   ss:RefersTo="=INDEX(GET.WORKSPACE(37),18)" ss:Hidden="1"/>
  <NamedRange ss:Name="LOCAL_YEAR_FORMAT"
   ss:RefersTo="=INDEX(GET.WORKSPACE(37),19)" ss:Hidden="1"/>
 </Names>
 <Worksheet ss:Name="Hoja1">
  <Names>
   <NamedRange ss:Name="Print_Area" ss:RefersTo="=Hoja1!R1C1:R56C12"/>
  </Names>
  <Table ss:ExpandedColumnCount="14" ss:ExpandedRowCount="56" x:FullColumns="1"
   x:FullRows="1" ss:StyleID="s62" ss:DefaultColumnWidth="60"
   ss:DefaultRowHeight="26.25">
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="371.25"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="156"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="40.5"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="119.25"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="156"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="192.75"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="334.5"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="35.25"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="213.75"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="72"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="282"/>
   <Column ss:StyleID="s62" ss:Width="86.25"/>
   <Row ss:AutoFitHeight="0" ss:Height="31.5">
    <Cell ss:MergeAcross="2" ss:MergeDown="4" ss:StyleID="m51184064"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="8" ss:MergeDown="4" ss:StyleID="m48723140"><Data
      ss:Type="String">Bit�cora de mantenimiento preventivo interno a equipo de laboratorio</Data><Comment
      ss:Author="Coordinaci�n SGC"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><Font html:Face="Tahoma"
        x:Family="Swiss" html:Size="20" html:Color="#000000">&#10;Este mantenimiento debe realizarse previo al inicio del semestre. Generalmente en el intersemestre.</Font></ss:Data></Comment><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="31.5" ss:Span="3"/>
   <Row ss:Index="6" ss:AutoFitHeight="0" ss:Height="31.5">
    <Cell ss:MergeAcross="11" ss:StyleID="s139"><Data ss:Type="String">Vigente a partir del: 28 de septiembre de 2015</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s73"/>
    <Cell ss:StyleID="s73"/>
   </Row>
   <Row ss:Height="35.25">
    <Cell ss:MergeAcross="5" ss:StyleID="s173"><Data ss:Type="String"><?php echo $_REQUEST['division'];?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="5" ss:StyleID="m48723200"><Data ss:Type="String"><?php echo $_REQUEST['laboratorio'];?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="35.0625"/>
   <Row ss:AutoFitHeight="0" ss:Height="57">
    <Cell ss:StyleID="s65"><Data ss:Type="String">Nota: Se refiere a todo el mantenimiento que no se realiza de manera externa (programado en SIELDI).</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s64"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s64"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s64"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s64"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:Index="8" ss:MergeAcross="2" ss:StyleID="s178"><Data ss:Type="String">Para iniciar el semestre:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:StyleID="s185"><Data ss:Type="String"><?php echo $_REQUEST['semestre'];?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="35.0625"/>
   <Row ss:AutoFitHeight="0" ss:Height="105">
    <Cell ss:StyleID="s66"><Data ss:Type="String">DESCRIPCI�N DEL EQUIPO</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">No. de inventario </Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:StyleID="m48723220"><Data ss:Type="String">Fecha de inicio dd/mm/aaaa</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Fecha de t�rmino dd/mm/aaaa</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:StyleID="m48722224"><Data ss:Type="String">Fecha estimada del pr�ximo mantenimiento mm/aaaa</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s66"><Data ss:Type="String">Descripci�n general del mantenimiento realizado</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:StyleID="m48723976"><Data ss:Type="String">Persona que realiz� el mantenimiento</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:StyleID="m48723160"><Data ss:Type="String">Supervis� operaci�n correcta</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeDown="2" ss:StyleID="s176"><Data ss:Type="String"><?php echo $_REQUEST['bn_desc'];?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s179"><Data ss:Type="String"><?php echo $_REQUEST['clave'];?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48723792"><Data
      ss:Type="DateTime"><?php echo date('Y-m-d', strtotime($_REQUEST['fregistro']))."T00:00:00.000";  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48723772"><Data ss:Type="DateTime"><?php echo date('Y-m-d', strtotime($_REQUEST['fsalida']))."T00:00:00.000";  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48723872"><Data
      ss:Type="DateTime"><?php echo date('Y-m-d', strtotime($_REQUEST['frecepcion']))."T00:00:00.000";  ?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48722612"><Data ss:Type="String"><?php echo $_REQUEST['falla'];?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48723100"><Data
      ss:Type="String">Persona que realiz� el mantenimiento</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s67"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s68"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:Index="11" ss:StyleID="s69"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s70"><Data ss:Type="String"><?php echo $_REQUEST['supervisor'];?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:Index="11" ss:MergeAcross="1" ss:StyleID="m48722264"><Data
      ss:Type="String">Nombre y Firma</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:MergeDown="2" ss:StyleID="s177"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s183"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48723956"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48723852"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48722324"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48722692"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48723120"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s71"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s72"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="11" ss:StyleID="s69"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s70"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="11" ss:MergeAcross="1" ss:StyleID="m48723040"><Data
      ss:Type="String">Nombre y Firma</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeDown="2" ss:StyleID="s177"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s180"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48722732"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48724280"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48722712"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48724200"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48723080"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s71"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s72"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:Index="11" ss:StyleID="s69"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s70"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="11" ss:MergeAcross="1" ss:StyleID="m48723060"><Data
      ss:Type="String">Nombre y Firma</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeDown="2" ss:StyleID="s177"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s180"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48722672"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48724240"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48724056"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48722752"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48722632"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s71"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s72"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:Index="11" ss:StyleID="s69"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s70"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="11" ss:MergeAcross="1" ss:StyleID="m48722244"><Data
      ss:Type="String">Nombre y Firma</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeDown="2" ss:StyleID="s177"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s180"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48724220"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48724036"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48724076"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48722652"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48722592"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s71"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s72"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:Index="11" ss:StyleID="s69"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s70"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="11" ss:MergeAcross="1" ss:StyleID="m48722284"><Data
      ss:Type="String">Nombre y Firma</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeDown="2" ss:StyleID="s177"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s180"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48724648"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48724320"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48724404"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48724464"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48724484"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s71"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s72"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:Index="11" ss:StyleID="s69"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s70"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="11" ss:MergeAcross="1" ss:StyleID="m48724160"><Data
      ss:Type="String">Nombre y Firma</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeDown="2" ss:StyleID="s177"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s180"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48724668"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48724748"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48724424"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48724384"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48724444"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s71"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s72"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:Index="11" ss:StyleID="s69"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s70"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="11" ss:MergeAcross="1" ss:StyleID="m48724788"><Data
      ss:Type="String">Nombre y Firma</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeDown="2" ss:StyleID="s177"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s180"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48724628"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48724688"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48724972"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48724952"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48725360"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s71"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s72"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:Index="11" ss:StyleID="s69"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s70"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="11" ss:MergeAcross="1" ss:StyleID="m48725380"><Data
      ss:Type="String">Nombre y Firma</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeDown="2" ss:StyleID="s177"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s180"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48724992"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48724872"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48724912"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48724932"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48722304"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s71"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s72"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:Index="11" ss:StyleID="s69"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s70"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="11" ss:MergeAcross="1" ss:StyleID="m48724608"><Data
      ss:Type="String">Nombre y Firma</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeDown="2" ss:StyleID="s177"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s180"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48725440"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48725056"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m51184164"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m51184184"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m51184124"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s71"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s72"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:Index="11" ss:StyleID="s69"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s70"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="11" ss:MergeAcross="1" ss:StyleID="m51184204"><Data
      ss:Type="String">Nombre y Firma</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeDown="2" ss:StyleID="s177"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s180"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48725300"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48725320"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48725748"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48725808"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48725768"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s71"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s72"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:Index="11" ss:StyleID="s69"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s70"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="11" ss:MergeAcross="1" ss:StyleID="m51184104"><Data
      ss:Type="String">Nombre y Firma</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeDown="2" ss:StyleID="s177"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="s180"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m51184244"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48725728"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48725788"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48725828"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m51184144"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s71"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s72"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:Index="11" ss:StyleID="s69"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s70"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:Index="11" ss:MergeAcross="1" ss:StyleID="m51184084"><Data
      ss:Type="String">Nombre y Firma</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:MergeDown="2" ss:StyleID="m48725096"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48725116"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48725176"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48725136"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48725216"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeDown="2" ss:StyleID="m48725196"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:MergeAcross="1" ss:MergeDown="2" ss:StyleID="m48725156"><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s71"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s72"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0">
    <Cell ss:Index="11" ss:StyleID="s69"><NamedCell ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s70"><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:Height="27">
    <Cell ss:Index="11" ss:MergeAcross="1" ss:StyleID="m48725076"><Data
      ss:Type="String">Nombre y Firma</Data><NamedCell ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="99"/>
   <Row>
    <Cell ss:MergeAcross="11" ss:StyleID="s141"><Data ss:Type="String">Revis�:</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="106.5"/>
   <Row>
    <Cell ss:MergeAcross="11" ss:StyleID="s208"><Data ss:Type="String"><?php echo $_REQUEST['rl_nombre'] ." ". $_REQUEST['rl_apaterno'] ." ". $_REQUEST['rl_amaterno'];?></Data><NamedCell
      ss:Name="Print_Area"/></Cell>
    <Cell ss:StyleID="s63"/>
   </Row>
   <Row>
    <Cell ss:MergeAcross="11" ss:StyleID="s141"><Data ss:Type="String">Responsable del laboratorio</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="11" ss:StyleID="s141"><Data ss:Type="String">Nombre y Firma</Data><NamedCell
      ss:Name="Print_Area"/></Cell>
   </Row>
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Layout x:Orientation="Landscape" x:CenterHorizontal="1" x:CenterVertical="1"/>
    <Header x:Margin="0"/>
    <Footer x:Margin="0"/>
    <PageMargins x:Bottom="0.98425196850393704" x:Left="0.74803149606299213"
     x:Right="0.74803149606299213" x:Top="0.98425196850393704"/>
   </PageSetup>
   <FitToPage/>
   <Print>
    <ValidPrinterInfo/>
    <Scale>27</Scale>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
   </Print>
   <ShowPageBreakZoom/>
   <Zoom>50</Zoom>
   <PageBreakZoom>55</PageBreakZoom>
   <Selected/>
   <Panes>
    <Pane>
     <Number>3</Number>
     <ActiveRow>50</ActiveRow>
     <ActiveCol>11</ActiveCol>
    </Pane>
   </Panes>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
</Workbook>