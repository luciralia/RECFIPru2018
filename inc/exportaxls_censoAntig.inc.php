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
    $texto='Content-Disposition: attachment;filename="censoAntig_' . date("Ymd-His") . "_" . $nomblab[0] . '.xls"';
	 $nombre=$nomblab[0];

}

if ( $_SESSION['tipo_usuario']==9 && $_SESSION['id_div']!=NULL && $_REQUEST['lab']==NULL ){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);

$texto='Content-Disposition: attachment;filename="censoAntig_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
$nombre=$nombdiv[0];
}


if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);


$texto='Content-Disposition: attachment;filename="censoAntig_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
$nombre=$nombdiv[0];
}
else if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
$titulo='FacultadIngenieria';	
$texto='Content-Disposition: attachment;filename="censoAntig_' . date("Ymd-His") . "_" . $titulo . '.xls"';	
$nombre=$titulo;
}	

header($texto);
?>

  
<table>
  <tr>
       <legend align="right"> <h3>Censo Antigüedad del equipo</h3>
       
</tr>  
 <tr>
       <legend align="right"> <h3><?php echo $nombre; ?></h3>
       
</tr>  
   </table>
       
   <br> <br>
   
  <table class="material">
    <tr><legend align="center"><h3>Equipos de cómputo</h3></legend></tr>
    <br>
  
   <tr>
              <th width="15%" >Antigüedad</th>
              
              <th width="5%"  >Cantidad</th>
    </tr>
    </table>  
    

         <table class="material">
            
             <tr>
                <th width="10%">Menor a 2 años</th>
                <td width="20%" center><?php echo $censo->CantidadP($_SESSION['id_div'],1,$_SESSION['tipo_usuario'])?></td>
             </tr>
           
            <tr>
                <th width="10%">Entre 2 y 3 años</th>
                <td width="20%" center><?php echo $censo->CantidadP($_SESSION['id_div'],2,$_SESSION['tipo_usuario'])?></td>
            </tr>
            <tr>
                <th width="10%">Entre 4 y 5 años</th>
                <td width="20%" center><?php echo $censo->CantidadP($_SESSION['id_div'],3,$_SESSION['tipo_usuario'])?></td>
             </tr>
             <tr>
                <th width="10%">Mayor a 6 años</th>
                <td width="20%" center><?php echo $censo->CantidadP($_SESSION['id_div'],4,$_SESSION['tipo_usuario'])?></td>
             </tr>
           
            </table>
 <br>
  <table class="material">
           <tr><legend align="center"><h3>Servidores</h3></legend></tr>
    <br>
           <tr>
              <th width="15%" >Antigüedad</th>
              
              <th width="5%"  >Cantidad</th>
    </tr>
    </table>  
    

         <table class="material">
            
              <tr>
                <th width="10%">Menor a 2 años</th>
                <td width="20%" center><?php echo $censo->CantidadS($_SESSION['id_div'],1,$_SESSION['tipo_usuario'])?></td>
             </tr>
           
            <tr>
                <th width="10%">Entre 2 y 3 años</th>
                <td width="20%" center><?php echo $censo->CantidadS($_SESSION['id_div'],2,$_SESSION['tipo_usuario'])?></td>
            </tr>
            <tr>
                <th width="10%">Entre 4 y 5 años</th>
                <td width="20%" center><?php echo $censo->CantidadS($_SESSION['id_div'],3,$_SESSION['tipo_usuario'])?></td>
             </tr>
             <tr>
                <th width="10%">Mayor a 6 años</th>
                <td width="20%" center><?php echo $censo->CantidadS($_SESSION['id_div'],4,$_SESSION['tipo_usuario'])?></td>
             </tr>
                  
  </table>      

   
  
  
  <br>
  <br>

 </div>
<br/>
<br/>