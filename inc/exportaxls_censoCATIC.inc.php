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
              <th width="1%" >Total</th>
    </tr>
    </table>  
    <?php
      $cuenta=0;
	  
	 
			 ?>

        
         <table class="material">

             <tr>
                
                <th width="15%">Computadoras</th>
               
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],3,1)?></td>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],3,3)?></td>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],3,2)?></td>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],3,4)?></td>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],3,1)+
				                                  $censo->Cantidad($_SESSION['id_div'],3,3)+      
                                                  $censo->Cantidad($_SESSION['id_div'],3,2)+ 
												  $censo->Cantidad($_SESSION['id_div'],3,4)?></td>
            </tr>
            <tr>
                
                <th width="15%">Portátiles</th>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],2,1)?></td>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],2,3)?></td>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],2,2)?></td>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],2,4)?></td>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],2,1)+
				                                  $censo->Cantidad($_SESSION['id_div'],2,3)+      
												  $censo->Cantidad($_SESSION['id_div'],2,2)+      
												  $censo->Cantidad($_SESSION['id_div'],2,4)?></td>
            </tr>
            
            <tr>
                
                <th width="15%">Tabletas</th>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],1,1)?></td>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],1,3)?></td>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],1,2)?></td>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],1,4)?></td>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],1,1)+
				                                  $censo->Cantidad($_SESSION['id_div'],1,3)+
												  $censo->Cantidad($_SESSION['id_div'],1,2)+
												  $censo->Cantidad($_SESSION['id_div'],1,4)?></td>
            </tr>
           <tr>
                
                <th width="15%">Equipo Alto R</th>
                <td width="20%" center><?php echo $censo->EAR($_SESSION['id_div'],1)?></td>
                <td width="20%" center><?php echo $censo->EAR($_SESSION['id_div'],3)?></td>
                <td width="20%" center><?php echo $censo->EAR($_SESSION['id_div'],2)?></td>
                <td width="20%" center><?php echo $censo->EAR($_SESSION['id_div'],4)?></td>
                <td width="20%" center><?php echo $censo->EAR($_SESSION['id_div'],1)+
				                                  $censo->EAR($_SESSION['id_div'],3)+
												  $censo->EAR($_SESSION['id_div'],2)+
												  $censo->EAR($_SESSION['id_div'],4)?></td>
            </tr>
             <tr>
                
                <th width="15%">Total</th>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],3,1)+
				                                  $censo->Cantidad($_SESSION['id_div'],2,1)+
												  $censo->Cantidad($_SESSION['id_div'],1,1)+
												  $censo->EAR($_SESSION['id_div'],1)?></td>
                                                          
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],3,3)+
											      $censo->Cantidad($_SESSION['id_div'],2,3)+
												  $censo->Cantidad($_SESSION['id_div'],1,3)+
				                                  $censo->EAR($_SESSION['id_div'],3)?></td>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],3,2)+
				                                  $censo->Cantidad($_SESSION['id_div'],2,2)+
												  $censo->Cantidad($_SESSION['id_div'],1,2)+
				                                  $censo->EAR($_SESSION['id_div'],2)?></td>
                <td width="20%" center><?php echo $censo->Cantidad($_SESSION['id_div'],3,4)+
				                                  $censo->Cantidad($_SESSION['id_div'],2,4)+
												  $censo->Cantidad($_SESSION['id_div'],1,4)+
				                                  $censo->EAR($_SESSION['id_div'],4)?></td>
                                                  
                <td width="20%" right><strong><?php echo $censo->Cantidad($_SESSION['id_div'],3,1)+
				                                  $censo->Cantidad($_SESSION['id_div'],2,1)+
												  $censo->Cantidad($_SESSION['id_div'],1,1)+
												  $censo->EAR($_SESSION['id_div'],1)+
												  $censo->Cantidad($_SESSION['id_div'],3,3)+
											      $censo->Cantidad($_SESSION['id_div'],2,3)+
												  $censo->Cantidad($_SESSION['id_div'],1,3)+
				                                  $censo->EAR($_SESSION['id_div'],3)+
												  $censo->Cantidad($_SESSION['id_div'],3,2)+
				                                  $censo->Cantidad($_SESSION['id_div'],2,2)+
												  $censo->Cantidad($_SESSION['id_div'],1,2)+
				                                  $censo->EAR($_SESSION['id_div'],2)+
												  $censo->Cantidad($_SESSION['id_div'],3,4)+
				                                  $censo->Cantidad($_SESSION['id_div'],2,4)+
												  $censo->Cantidad($_SESSION['id_div'],1,4)+
				                                  $censo->EAR($_SESSION['id_div'],4)
												  ?></strong></td>
                                            
                
            </tr>
</table>



  <table>
  <tr>
       <legend align="left"> <h4>Laboratorios y áreas de cómputo: <?php echo $censo->cantLab($_SESSION['id_div']);?></h4></tr></legend >
     
   </tr>   
   <br>
   <br>
    
   </table>
     <?php 
	  $datos = pg_query($con,$censo->cantEquLab($_SESSION['id_div']));
      $inventario= pg_num_rows($datos); 
	
   if ($inventario==0)
		   {?>
          <table>
		 <tr>
      <!-- <legend align="left"> <h4>No hay laboratorios con equipos registrado en esta división</h4></legend >-->
   </tr> 
   </table> 
   <?php
   
		}else{ ?>
        <table>
		 <tr>
          <legend align="left"> <h4>Laboratorios con equipos registrado en esta división</h4></legend >
        </tr> 
   </table> 
   <br>
   <br>
      <table class='material' width=50%>
      
      
		<tr>
              <th width="20%" scope="col">Laboratorio</th>
              <th  width="20%" scope="col">Cantidad</th>
       
         </tr>
   </table>
   
   <?php
   
		$cuenta=0;
		
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		  	if (count($lab_invent > 0 )){
		  
		  ?>
          
		    <table class='material' width=100%>
		 
            <tr>
            
               <td  width="20%" ><?php echo ucwords(strtolower($lab_invent['lab']));?></td>
               <td  width="20%" ><?php echo $lab_invent['cuenta'];?></td>
           </tr>
            
             </table> 
<?php 
			}
    $cuenta=$cuenta+$lab_invent['cuenta']; 
         } 
		 ?>
         
 <table class='material'>
<tr>
  <th scope="row">TOTAL</th>
   <td width="50%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
   <?php  }
	?>
   
<br/>
<br/>


 <table>
  <tr>
       <legend align="left"> <h4>Aulas con equipo de cómputo <?php echo $censo->cantAulas($_SESSION['id_div']);?></h4></tr></legend >
     
   </tr>  
    <br>
    <br>
   </table>
   
   
    <?php 
	 // echo 'consulta aula',$censo->cantEquAula($_SESSION['id_div']);
	  $datos = pg_query($con,$censo->cantEquAula($_SESSION['id_div']));
      $inventario= pg_num_rows($datos); 
	
   if ($inventario==0)
		   {?>
          <table>
		 <tr>
      <!-- <legend align="left"> <h4>No hay aulas con equipos registrado </h4></legend >-->
   </tr> 
   </table> 
   <?php
   
		}else{ ?>
        <table>
		 <tr>
          <legend align="left"> <h4>Aulas con equipo registrado </h4></legend >
        </tr> 
   </table> 
   <br>
   <br>
      <table class='material' width=50%>
      
      
		<tr>
              <th width="20%" scope="col">Aula</th>
              <th  width="20%" scope="col">Cantidad</th>
       
         </tr>
   </table>
   
   <?php
   
		$cuenta=0;
		
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		  	if (count($lab_invent > 0 )){
		  
		  ?>
          
		    <table class='material' width=100%>
		 
            <tr>
            
               <td  width="20%" ><?php echo ucwords(strtolower($lab_invent['lab']));?></td>
               <td  width="20%" ><?php echo $lab_invent['cuenta'];?></td>
           </tr>
            
             </table> 
<?php 
			}
    $cuenta=$cuenta+$lab_invent['cuenta']; 
         } 
		 ?>
         
 <table class='material'>
<tr>
  <th scope="row">TOTAL</th>
   <td width="50%" ><strong><?php echo $cuenta;?></strong></td>
</tr>
</table>
   <?php  }
	

        
  
	?>
   
  <br/>
<br/> 