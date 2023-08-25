<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
session_start(); 
require_once('../conexion.php'); 
require_once('../clases/censo.class.php');


header("Pargma:public");
header("Expires:0");
header("Content-type: application/x-msdownload");
header("Pargma:no-cache");
header("Cache-Control: must_revalidate,post-check=0,pre-check=0");

$censo = new censo();

$exporta=$_POST;
//echo 'exporta'.$exporta;


if ( ($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==9 ) && $_SESSION['id_div']==NULL || $_REQUEST['lab']!=NULL ){
	 
	$querylab="SELECT nombre FROM laboratorios
           WHERE id_lab=" . $_REQUEST['lab'] ;
    $registrolab = pg_query($con,$querylab);
    $nomblab= pg_fetch_array($registrolab);
    //echo 'consulta'.$querylab;
    $texto='Content-Disposition: attachment;filename="censoImpresoraTipo_' . date("Ymd-His") . "_" . $nomblab[0] . '.xls"';
	 $nombre=$nomblab[0];

}

if ( $_SESSION['tipo_usuario']==9 && $_SESSION['id_div']!=NULL && $_REQUEST['lab']==NULL ){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);

$texto='Content-Disposition: attachment;filename="censoImpresoraTipo_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
$nombre=$nombdiv[0];
}


if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);


$texto='Content-Disposition: attachment;filename="censoImpresoraTipo_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
$nombre=$nombdiv[0];
}
else if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
$titulo='FacultadIngenieria';	
$texto='Content-Disposition: attachment;filename="censoImpresoraTipo_' . date("Ymd-His") . "_" . $titulo . '.xls"';	
$nombre=$titulo;
}	

header($texto);
?>

  
<table>
  <tr>
       <legend align="right"> <h3>Censo de impresoras por tipo</h3>
       
</tr>  
 <tr>
       <legend align="right"> <h3><?php echo $nombre; ?></h3>
       
</tr>  
    <table class="material">
    <tr><legend align="center"><h3>Censo de impresoras por tipo</h3></legend></tr>
    <br>
  
   <tr>
              <th width="15%" >Tipo</th>
              
              <th width="20%" >Cantidad</th>
    </tr>
    </table>  
    

         <table class="material">
            
             <tr>
                <th width="10%">Inyección de tinta</th>
                <td width="20%" center><?php echo $totalI1=$censo->cantImpresoraT($_SESSION['id_div'],1,$_SESSION['tipo_usuario'])?></td>
             </tr>
           
            <tr>
                <th width="10%">Láser del alto volumen B/N</th>
                <td width="20%" center><?php echo $totalI2=$censo->cantImpresoraT($_SESSION['id_div'],2,$_SESSION['tipo_usuario'])?></td>
            </tr>
            <tr>
                <th width="10%">Láser de alto volumen color</th>
                <td width="20%" center><?php echo $totalI3=$censo->cantImpresoraT($_SESSION['id_div'],3,$_SESSION['tipo_usuario'])?></td>
             </tr>
             <tr>
                <th width="10%">Láser pequeña B/N</th>
                <td width="20%" center><?php echo $totalI4=$censo->cantImpresoraT($_SESSION['id_div'],4,$_SESSION['tipo_usuario'])?></td>
             </tr>
             <tr>
                <th width="10%">Láser pequeña color</th>
                <td width="20%" center><?php echo $totalI5=$censo->cantImpresoraT($_SESSION['id_div'],5,$_SESSION['tipo_usuario'])?></td>
             </tr>
             <tr>
                <th width="10%">3D</th>
                <td width="20%" center><?php echo $totalI6=$censo->cantImpresoraT($_SESSION['id_div'],6,$_SESSION['tipo_usuario'])?></td>
             </tr>
             <tr>
                <th width="10%">Matriz de puntos</th>
                <td width="20%" center><?php echo $totalI7=$censo->cantImpresoraT($_SESSION['id_div'],7,$_SESSION['tipo_usuario'])?></td>
             </tr>
             <tr>
                <th width="10%">Multifuncionales</th>
                <td width="20%" center><?php echo $totalI8=$censo->cantImpresoraT($_SESSION['id_div'],8,$_SESSION['tipo_usuario'])?></td>
             </tr>
              <tr>
                <th width="10%">Plótters</th>
                <td width="20%" center><?php echo $totalI9=$censo->cantImpresoraT($_SESSION['id_div'],9,$_SESSION['tipo_usuario'])?></td>
             </tr>
             <tr>
                <th width="10%">Otros</th>
                <td width="20%" center><?php echo $totalI10=$censo->cantImpresoraT($_SESSION['id_div'],10,$_SESSION['tipo_usuario'])?></td>
             </tr>
             <th width="15%"><strong>TOTAL</strong></th>
                   <td width="20%" right><strong><?php echo $totalI1+$totalI2+$totalI3+$totalI4+$totalI5+$totalI6
					   +$totalI7+$totalI8+$totalI9+$totalI10?></strong></td>
           </table>
 <br>
  
    


 </div>
<br/>
<br/>