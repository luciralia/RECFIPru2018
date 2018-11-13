
<?php
date_default_timezone_set('America/Mexico_City');
header('Content-type: application/x-msexcel'); 
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0" );
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
//header("Content-type: text/html");
$texto='Content-Disposition: attachment;filename="quejas_' . date("Ymd-His") . "_" . $_REQUEST['laboratorio'] . '.xls"';
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
  <Author>rruiz</Author>
  <LastAuthor>dsd</LastAuthor>
  <LastPrinted>2015-09-22T18:12:09Z</LastPrinted>
  <Created>2010-06-03T15:31:39Z</Created>
  <LastSaved>2015-09-22T23:39:16Z</LastSaved>
  <Version>14.00</Version>
 </DocumentProperties>
 <CustomDocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
  <WorkbookGuid dt:dt="string">417e3028-6b42-4915-ab36-ec59e026dec1</WorkbookGuid>
 </CustomDocumentProperties>
 <OfficeDocumentSettings xmlns="urn:schemas-microsoft-com:office:office">
  <AllowPNG/>
 </OfficeDocumentSettings>
 <ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
  <WindowHeight>7680</WindowHeight>
  <WindowWidth>14955</WindowWidth>
  <WindowTopX>240</WindowTopX>
  <WindowTopY>360</WindowTopY>
  <ProtectStructure>False</ProtectStructure>
  <ProtectWindows>False</ProtectWindows>
 </ExcelWorkbook>
 <Styles>
  <Style ss:ID="Default" ss:Name="Normal">
   <Alignment ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Arial" x:Family="Swiss"/>
   <Interior/>
   <NumberFormat/>
   <Protection/>
  </Style>
  <Style ss:ID="m82411232">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="m82411272">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="m82411292">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="m31666236">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="m31666256">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="m31666276">
   <Alignment ss:Horizontal="Left" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="m82410560">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="m82410580">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman" ss:Size="13" ss:Bold="1"/>
  </Style>
  <Style ss:ID="m82410600">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="m82410620">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="m82410640">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="m82410680">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s62">
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s65">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders/>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s72">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s99">
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s100">
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s101">
   <Borders/>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s103">
   <Alignment ss:Horizontal="Center" ss:Vertical="Center"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s105">
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s108">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s109">
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s112">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s114">
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Borders>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s127">
   <Alignment ss:Horizontal="Left" ss:Vertical="Bottom" ss:WrapText="1"/>
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s140">
   <Borders>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s141">
   <Borders>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s144">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s145">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
  </Style>
  <Style ss:ID="s146">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="2"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="2"/>
   </Borders>
   <Font ss:FontName="Times New Roman" x:Family="Roman"/>
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
  <Table ss:ExpandedColumnCount="20" ss:ExpandedRowCount="30" x:FullColumns="1"
   x:FullRows="1" ss:StyleID="s62" ss:DefaultColumnWidth="60">
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="19.5"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="19.5"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="47.25"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="10.5"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="45.75"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="45"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="27.75"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="45.75" ss:Span="1"/>
   <Column ss:Index="15" ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="24.75" ss:Span="1"/>
   <Column ss:Index="18" ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="45.75"/>
   <Column ss:StyleID="s62" ss:AutoFitWidth="0" ss:Width="30"/>
   <Column ss:StyleID="s62" ss:Width="45"/>
   <Row>
    <Cell ss:MergeAcross="4" ss:MergeDown="4" ss:StyleID="m82410560"/>
    <Cell ss:MergeAcross="13" ss:MergeDown="4" ss:StyleID="m82410580"><Data
      ss:Type="String">Formato de quejas, sugerencias y felicitaciones</Data></Cell>
   </Row>
   <Row ss:Index="5" ss:AutoFitHeight="0" ss:Height="25.5"/>
   <Row>
    <Cell ss:MergeAcross="18" ss:StyleID="m82410600"><Data ss:Type="String">Vigente a partir del: 28 de septiembre de 2015</Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="9" ss:StyleID="m82410620"><Data ss:Type="String">Secretaría/División:<?php echo $_POST['division']?></Data></Cell>
    <Cell ss:MergeAcross="8" ss:StyleID="m82410640"><Data ss:Type="String">Área/Departamento: <?php echo $_POST['laboratorio']?></Data></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s99"/>
    <Cell ss:Index="19" ss:StyleID="s100"/>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="13.5">
    <Cell ss:StyleID="s99"><Data ss:Type="String">Semestre:</Data></Cell>
    <Cell ss:StyleID="s101"/>
    <Cell ss:MergeAcross="2" ss:StyleID="s103"><Data ss:Type="String"><?php echo $_POST['semestre']?></Data><Comment
      ss:Author="Coordinación SGC"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><Font html:Face="Tahoma"
        x:Family="Swiss" html:Size="10" html:Color="#000000">Semestre en el que se hace el registro. Por ejemplo: 2016-1</Font></ss:Data></Comment></Cell>
    <Cell ss:StyleID="s101"/>
    <Cell ss:Index="15" ss:StyleID="s105"><Data ss:Type="String">Fecha:</Data></Cell>
    <Cell ss:MergeAcross="3" ss:StyleID="m82410680"><Data ss:Type="String"><?php echo date("d-m-Y", strtotime($_POST['fechareg']));?></Data><Comment
      ss:Author="Coordinación SGC"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><Font html:Face="Tahoma"
        x:Family="Swiss" html:Size="10" html:Color="#000000">Fecha en la que se realiza el registro. Lo llena quien hace uso del formato para expresar su queja, sugerencia o felicitación.</Font></ss:Data></Comment></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s99"/>
    <Cell ss:Index="19" ss:StyleID="s109"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s99"/>
    <Cell ss:Index="19" ss:StyleID="s109"/>
   </Row>
   <Row>
    <Cell ss:MergeAcross="7" ss:StyleID="s72"><ss:Data ss:Type="String"
      xmlns="http://www.w3.org/TR/REC-html40">_<U><?php echo $checked=($_POST['tipo_usuario']=='2')?'X"':''; ?></U><Font>_Alumno</Font></ss:Data></Cell>
    <Cell ss:MergeAcross="4" ss:StyleID="s112"><ss:Data ss:Type="String"
      xmlns="http://www.w3.org/TR/REC-html40">_<U><?php echo $checked=($_POST['tipo_usuario']=='3')?'X"':''; ?></U><Font>_Académico</Font></ss:Data></Cell>
    <Cell ss:MergeAcross="5" ss:StyleID="s114"><ss:Data ss:Type="String"
      xmlns="http://www.w3.org/TR/REC-html40">_<U><?php echo $checked=($_POST['tipo_usuario']=='5')?'X"':''; ?></U><Font>_Administrativo</Font></ss:Data></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s99"><Data ss:Type="String">Por favor, incluya toda la información que considere relevante para atender su queja o sugerencia o felicitación:</Data></Cell>
    <Cell ss:Index="19" ss:StyleID="s109"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s99"/>
    <Cell ss:Index="19" ss:StyleID="s109"/>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="13.5">
    <Cell ss:MergeAcross="18" ss:StyleID="m31666236"><Data ss:Type="String"><?php echo $_POST['queja']?></Data><Comment
      ss:Author="Coordinación SGC"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><Font html:Face="Tahoma"
        x:Family="Swiss" html:Size="15" html:Color="#000000">Quien hace uso del formato debe especificar su queja, sugerencia o felicitación.&#10;</Font></ss:Data></Comment></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="13.5">
    <Cell ss:MergeAcross="18" ss:StyleID="m31666256"><Data ss:Type="String">_</Data></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="13.5">
    <Cell ss:MergeAcross="18" ss:StyleID="m31666276"><Data ss:Type="String">_</Data></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s99"/>
    <Cell ss:Index="19" ss:StyleID="s109"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s99"><Data ss:Type="String">Si desea que se le informe del seguimiento que se ha dado a su sugerencia, favor de proporcionar los siguientes datos:</Data></Cell>
    <Cell ss:Index="19" ss:StyleID="s109"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s99"/>
    <Cell ss:Index="19" ss:StyleID="s109"/>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="13.5">
    <Cell ss:StyleID="s99"><Data ss:Type="String">Nombre:</Data></Cell>
    <Cell ss:Index="3" ss:MergeAcross="16" ss:StyleID="m82411232"><Data
      ss:Type="String"><?php echo $_POST['quejoso']?></Data><Comment ss:Author="Coordinación SGC"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><Font html:Face="Tahoma"
        x:Family="Swiss" html:Size="15" html:Color="#000000">Nombre de quien realiza la queja, sugerencia o felicitación, es opcional.</Font></ss:Data></Comment></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s99"/>
    <Cell ss:Index="19" ss:StyleID="s109"/>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="13.5">
    <Cell ss:MergeAcross="3" ss:StyleID="s127"><Data ss:Type="String">Correo electrónico:</Data></Cell>
    <Cell ss:MergeAcross="14" ss:StyleID="m82411272"><Data ss:Type="String"><?php echo $_POST['email']?></Data><Comment
      ss:Author="Coordinación SGC"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><Font html:Face="Tahoma"
        x:Family="Swiss" html:Size="12" html:Color="#000000">Correo electrónico de quien realiza la queja, sugerencia o felicitación, es opcional. En caso de que el quejoso proporcione este dato, se le debe contestar el seguimiento a su queja, sugerencia o felicitación.</Font></ss:Data></Comment></Cell>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="13.5">
    <Cell ss:MergeAcross="18" ss:StyleID="m82411292"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s140"><Data ss:Type="String">Para llenado exclusivo por parte del personal de laboratorio.</Data></Cell>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s141"/>
    <Cell ss:StyleID="s109"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s99"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s109"/>
   </Row>
   <Row>
    <Cell ss:StyleID="s99"><Data ss:Type="String">Clasificación:</Data></Cell>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:MergeAcross="3" ss:StyleID="s65"><ss:Data ss:Type="String"
      xmlns="http://www.w3.org/TR/REC-html40">Queja__<U><?php echo $checked=($_POST['clasificacion']=='q')?'X"':''; ?></U><Font>__</Font></ss:Data><Comment
      ss:Author="Coordinación SGC"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><Font html:Face="Tahoma"
        x:Family="Swiss" html:Size="12" html:Color="#000000">Se clasifica como queja si tiene que ver directamente con la impartición de la práctica o la falta de elementos para la realización de la misma. Por ejemplo: No se me proporcionó completo el equipo a utilizar en la práctica.</Font></ss:Data></Comment></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="s65"><ss:Data ss:Type="String"
      xmlns="http://www.w3.org/TR/REC-html40">Sugerencia__<U><?php echo $checked=($_POST['clasificacion']=='s')?'X"':''; ?></U><Font>__</Font></ss:Data><Comment
      ss:Author="Coordinación SGC"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><Font html:Face="Tahoma"
        x:Family="Swiss" html:Size="12" html:Color="#000000">Se clasifica como sugerencia si el algo que no impacta directamente en la realización de la práctica. Por ejemplo: deberían poner música en el laboratorio.</Font></ss:Data></Comment></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="s65"><ss:Data ss:Type="String"
      xmlns="http://www.w3.org/TR/REC-html40">Felicitación__<U><?php echo $checked=($_POST['clasificacion']=='f')?'X"':''; ?></U><Font>__</Font></ss:Data></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="s65"><ss:Data ss:Type="String"
      xmlns="http://www.w3.org/TR/REC-html40">R_<U><?php echo $checked=($_POST['relevancia']=='t')?'X':''; ?></U><Font>_</Font></ss:Data><Comment
      ss:Author="Coordinación SGC"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><Font html:Face="Tahoma"
        x:Family="Swiss" html:Size="12" html:Color="#000000">Se considera relevante si impacta en la realización de la práctica.</Font></ss:Data></Comment></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="s114"><ss:Data ss:Type="String"
      xmlns="http://www.w3.org/TR/REC-html40">NR_<U><?php echo $checked=($_POST['relevancia']=='f')?'X':''; ?></U><Font>__</Font></ss:Data><Comment
      ss:Author="Coordinación SGC"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><Font html:Face="Tahoma"
        x:Family="Swiss" html:Size="12" html:Color="#000000">Se considera no relevante si no impacta en la realización de la práctica.</Font></ss:Data></Comment></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="s99"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s101"/>
    <Cell ss:StyleID="s109"/>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="13.5">
    <Cell ss:StyleID="s99"><Data ss:Type="String">Folio:</Data></Cell>
    <Cell ss:MergeAcross="2" ss:StyleID="s103"><Data ss:Type="String"><?php echo $_POST['folio']?></Data><Comment
      ss:Author="Coordinación SGC"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><Font html:Face="Tahoma"
        x:Family="Swiss" html:Size="10" html:Color="#000000">Es folio único por semestre (es decir, se reinicia cada semestre), empezando por 001 y así sucesivamente.</Font><Font
        html:Face="Tahoma" x:Family="Swiss" html:Size="9" html:Color="#000000">&#10;</Font></ss:Data></Comment></Cell>
    <Cell ss:StyleID="s101"/>
    <Cell ss:MergeAcross="4" ss:StyleID="s65"><Data ss:Type="String">Firma del Responsable del laboratorio:</Data></Cell>
    <Cell ss:MergeAcross="7" ss:StyleID="s108"><Comment
      ss:Author="Coordinación SGC"><ss:Data
       xmlns="http://www.w3.org/TR/REC-html40"><Font html:Face="Tahoma"
        x:Family="Swiss" html:Size="9" html:Color="#000000">Debe firmar al responsable, al darse cuenta de la existencia de este registro. El buzón debe revisarse al menos cada semana y darle atención a todas las quejas, sugerencias o felicitaciones a más tardar un mes después de que el quejoso llene este formato. </Font></ss:Data></Comment></Cell>
    <Cell ss:StyleID="s109"/>
   </Row>
   <Row ss:AutoFitHeight="0" ss:Height="13.5">
    <Cell ss:StyleID="s144"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s145"/>
    <Cell ss:StyleID="s146"/>
   </Row>
  </Table>
  <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
   <PageSetup>
    <Header x:Margin="0"/>
    <Footer x:Margin="0"/>
    <PageMargins x:Bottom="0.39370078740157483" x:Left="1.3779527559055118"
     x:Right="1.3779527559055118" x:Top="0.39370078740157483"/>
   </PageSetup>
   <FitToPage/>
   <Print>
    <ValidPrinterInfo/>
    <Scale>61</Scale>
    <HorizontalResolution>600</HorizontalResolution>
    <VerticalResolution>600</VerticalResolution>
   </Print>
   <Zoom>115</Zoom>
   <Selected/>
   <TopRowVisible>9</TopRowVisible>
   <Panes>
    <Pane>
     <Number>3</Number>
     <ActiveRow>30</ActiveRow>
     <ActiveCol>11</ActiveCol>
    </Pane>
   </Panes>
   <ProtectObjects>False</ProtectObjects>
   <ProtectScenarios>False</ProtectScenarios>
  </WorksheetOptions>
 </Worksheet>
</Workbook>
