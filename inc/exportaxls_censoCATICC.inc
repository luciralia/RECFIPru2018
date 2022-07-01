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
    $texto='Content-Disposition: attachment;filename="censoCATIC_' . date("Ymd-His") . "_" . $nomblab[0] . '.xls"';
	 $nombre=$nomblab[0];

}

if ( $_SESSION['tipo_usuario']==9 && $_SESSION['id_div']!=NULL && $_REQUEST['lab']==NULL ){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);

$texto='Content-Disposition: attachment;filename="censoCATIC_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
$nombre=$nombdiv[0];
}


if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'] ;
$registrodiv = pg_query($con,$querydiv);
$nombdiv= pg_fetch_array($registrodiv);


$texto='Content-Disposition: attachment;filename="censoCATIC_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
$nombre=$nombdiv[0];
}
else if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
$titulo='FacultadIngenieria';	
$texto='Content-Disposition: attachment;filename="censoCATIC_' . date("Ymd-His") . "_" . $titulo . '.xls"';	
$nombre=$titulo;
}	

header($texto);
?>

  
<table>
  <tr>
       <legend align="right"> <h3>Censo CATIC</h3>
       
</tr>  
 <tr>
       <legend align="right"> <h3><?php echo $nombre; ?></h3>
       
</tr>  
   </table>
       
   <br> <br>
   
   <table class="material">

   <tr>
              <th width="15%" scope="col">&nbsp;&nbsp;&nbsp;</th>
              <th width="15%" >Estudiantes</th>
              <th width="15%" >Académicos</th>
              <th width="15%" >Investigadores</th>
              <th width="15%" >Administrativos</th>
              <th width="5%" >Total</th>
    </tr>
    </table>  
    <?php
      $cuenta=0;
	  $totalC1=0;$totalC2=0;$totalC3=0;$totalC4=0;
	  
	 
			 ?>

        
         <table class="material">

             <tr>
                
                <th width="15%">Computadoras de escritorio Windows</th>
               
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],1,1)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],1,2)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],1,3)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],1,4)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],1,1)+
				                                  $censo->CantidadC($_SESSION['id_div'],1,2)+      
                                                  $censo->CantidadC($_SESSION['id_div'],1,3)+ 
												  $censo->CantidadC($_SESSION['id_div'],1,4)?></td>
            </tr>
            <tr>
                
                <th width="15%">Computadoras de escritorio Linux</th>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],2,1)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],2,2)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],2,3)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],2,4)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],2,1)+
				                                  $censo->CantidadC($_SESSION['id_div'],2,2)+      
												  $censo->CantidadC($_SESSION['id_div'],2,3)+      
												  $censo->CantidadC($_SESSION['id_div'],2,4)?></td>
            </tr>
            
            <tr>
                
                <th width="15%">Computadoras de Escritorio Apple Mac</th>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],3,1)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],3,2)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],3,3)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],3,4)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],3,1)+
				                                  $censo->CantidadC($_SESSION['id_div'],3,2)+
												  $censo->CantidadC($_SESSION['id_div'],3,3)+
												  $censo->CantidadC($_SESSION['id_div'],3,4)?></td>
            </tr>
           <tr>
                <th width="15%">Computadoras portátiles</th>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],4,1)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],4,2)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],4,3)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],4,4)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],4,1)+
				                                  $censo->CantidadC($_SESSION['id_div'],4,2)+
												  $censo->CantidadC($_SESSION['id_div'],4,3)+
												  $censo->CantidadC($_SESSION['id_div'],4,4)?></td>
            </tr>
            <tr>
                
                <th width="15%">Computadoras
                                portátiles Apple Mac</th>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],5,1)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],5,2)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],5,3)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],5,4)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],5,1)+
				                                  $censo->CantidadC($_SESSION['id_div'],5,2)+
												  $censo->CantidadC($_SESSION['id_div'],5,3)+
												  $censo->CantidadC($_SESSION['id_div'],5,4)?></td>
            </tr>
            <tr>
                
                <th width="15%">Tabletas Android </th>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],6,1)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],6,2)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],6,3)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],6,4)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],6,1)+
				                                  $censo->CantidadC($_SESSION['id_div'],6,2)+
												  $censo->CantidadC($_SESSION['id_div'],6,3)+
												  $censo->CantidadC($_SESSION['id_div'],6,4)?></td>
            </tr>
            
            <tr>
                
                <th width="15%">Tabletas
                                Android
                                </th>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],7,1)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],7,2)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],7,3)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],7,4)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],7,1)+
				                                  $censo->CantidadC($_SESSION['id_div'],7,2)+
												  $censo->CantidadC($_SESSION['id_div'],7,3)+
												  $censo->CantidadC($_SESSION['id_div'],7,4)?></td
            </tr>
            
            <tr>
                
                <th width="15%">Servidores
                                </th>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],8,1)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],8,2)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],8,3)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],8,4)?></td>
                <td width="20%" center><?php echo $censo->CantidadC($_SESSION['id_div'],8,1)+
				                                  $censo->CantidadC($_SESSION['id_div'],8,2)+
												  $censo->CantidadC($_SESSION['id_div'],8,3)+
	                                              $censo->CantidadC($_SESSION['id_div'],8,4)?></td>
            </tr>
            
             <tr>
                
                <th width="15%">Total</th>
                <td width="20%" center><?php echo $totalC1= $censo->CantidadC($_SESSION['id_div'],1,1)+
				                                  $censo->CantidadC($_SESSION['id_div'],2,1)+
												  $censo->CantidadC($_SESSION['id_div'],3,1)+
	                                              $censo->CantidadC($_SESSION['id_div'],4,1)+
												  $censo->CantidadC($_SESSION['id_div'],5,1)+
                                                  $censo->CantidadC($_SESSION['id_div'],6,1)+
	                                              $censo->CantidadC($_SESSION['id_div'],7,1)+
	                                              $censo->CantidadC($_SESSION['id_div'],8,1)?></td>
                                                          
                <td width="20%" center><?php echo $totalC2= $censo->CantidadC($_SESSION['id_div'],1,2)+
				                                  $censo->CantidadC($_SESSION['id_div'],2,2)+
												  $censo->CantidadC($_SESSION['id_div'],3,2)+
	                                              $censo->CantidadC($_SESSION['id_div'],4,2)+
												  $censo->CantidadC($_SESSION['id_div'],5,2)+
                                                  $censo->CantidadC($_SESSION['id_div'],6,2)+
	                                              $censo->CantidadC($_SESSION['id_div'],7,2)+
	                                              $censo->CantidadC($_SESSION['id_div'],8,2)?></td>
	                                              
                <td width="20%" center><?php echo $totalC3= $censo->CantidadC($_SESSION['id_div'],1,3)+
				                                  $censo->CantidadC($_SESSION['id_div'],2,3)+
												  $censo->CantidadC($_SESSION['id_div'],3,3)+
	                                              $censo->CantidadC($_SESSION['id_div'],4,3)+
												  $censo->CantidadC($_SESSION['id_div'],5,3)+
                                                  $censo->CantidadC($_SESSION['id_div'],6,3)+
	                                              $censo->CantidadC($_SESSION['id_div'],7,3)+
	                                              $censo->CantidadC($_SESSION['id_div'],8,3)?></td>
	                                              
                <td width="20%" center><?php echo $totalC4= $censo->CantidadC($_SESSION['id_div'],1,4)+
				                                  $censo->CantidadC($_SESSION['id_div'],2,4)+
												  $censo->CantidadC($_SESSION['id_div'],3,4)+
	                                              $censo->CantidadC($_SESSION['id_div'],4,4)+
												  $censo->CantidadC($_SESSION['id_div'],5,4)+
                                                  $censo->CantidadC($_SESSION['id_div'],6,4)+
	                                              $censo->CantidadC($_SESSION['id_div'],7,4)+
	                                              $censo->CantidadC($_SESSION['id_div'],8,4)?></td>
                
           
           
               <td width="20%" right><strong><?php echo $totalC1+$totalC2+$totalC3+$totalC4?></strong></td>
         
            
             </tr>
            
</table>
  <br>
  <br>

 </div>
<br/>
<br/>