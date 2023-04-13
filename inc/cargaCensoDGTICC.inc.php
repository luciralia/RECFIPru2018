
<?php
session_start(); 
require_once('../conexion.php');

require_once('../clases/censo.class.php');

require_once('../clases/log.class.php');


$logger=new Log();

$logger->putLog(7,2);

$censo = new censo();


 if ( $_SESSION['tipo_usuario']==10  &&  $_SESSION['id_div']=='')
		   $_SESSION['id_div']=$_REQUEST['div'];
if ($_SESSION['tipo_usuario']==9)
  $_SESSION['id_div']=$_REQUEST['div'];
  
//if ($_GET['mod']=='censo'  ){
?>

<br>

<!--<div style="text-align:center;">-->

 <table>
  <tr>
       <legend align="right"> <h3></h3>
             <br>
              <form action="../inc/exportaxls_censoCATICC.inc.php" method="post" name="ceneceq" >
	               <input name="enviar" type="submit" value="Exportar a Excel" />
                   <input name="lab" type="hidden" value="<?php echo $_GET['lab'];?>" />
       
   </tr>  
   </table>
   
   <br> 
   
   <table class="material">
    <tr><legend align="center"><h3>Equipo de cómputo</h3></legend></tr>
    <br>
  
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
	  $totalI1=0;$totalI2=0;$totalI3=0;$totalI4=0;$totalI5=0;
	  $totalI6=0;$totalI7=0;$totalI8=0;$totalI9=0;
	  $totalD1=0;$totalD2=0;$totalD3=0;$totalD4=0;
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
                
                <th width="15%">Tabletas iPadOS</th>
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
  <table class="material">
            
             <tr><legend align="center"><h3>Impresoras</h3></legend></tr>
             <br>
             
             <tr>
                  <th width="15%">Inyecciòn de tinta</th>
                  <td width="40%" center><?php echo $totalI1=$censo->cantImpresoras($_SESSION['id_div'],1)?></td>
	           </tr>
               <tr>
                  <th width="15%">Láser de alto volumen B/N</th>
                  <td width="40%" center><?php echo $totalI2=$censo->cantImpresoras($_SESSION['id_div'],2)?></td>
	           </tr> 
               <tr>
                  <th width="15%">Láser de lato volumen Color</th>
                  <td width="20%" center><?php echo $totalI3=$censo->cantImpresoras($_SESSION['id_div'],3)?></td>
                </tr>
                <tr>
                
                  <th width="15%">Láser pequeña B/N</th>
                  <td width="20%" center><?php echo $totalI4=$censo->cantImpresoras($_SESSION['id_div'],4)?></td>
	           </tr>
               <tr>
                  <th width="15%">Láser pequeña Color</th>
                  <td width="20%" center><?php echo $totalI5=$censo->cantImpresoras($_SESSION['id_div'],5)?></td>
	           </tr> 
               <tr>
                  <th width="15%">3D</th>
                  <td width="20%" center><?php echo  $totalI6=$censo->cantImpresoras($_SESSION['id_div'],6)?></td>
                </tr>
                <tr>
                  <th width="15%">Matriz</th>
                  <td width="20%" center><?php echo  $totalI7=$censo->cantImpresoras($_SESSION['id_div'],7)?></td>
                </tr>
                <tr>
                  <th width="15%">Multifuncional</th>
                  <td width="20%" center><?php echo  $totalI8=$censo->cantImpresoras($_SESSION['id_div'],8)?></td>
                </tr>
                <tr>
                  <th width="15%">Otros</th>
                  <td width="20%" center><?php echo  $totalI9=$censo->cantImpresoras($_SESSION['id_div'],9)?></td>
                </tr>
                
                   <th width="15%">Total</th>
                   <td width="20%" right><strong><?php echo $totalI1+$totalI2+$totalI3+$totalI4+$totalI5+$totalI6
					   +$totalI7+$totalI8+$totalI9?></strong></td>
  </table>            
  <br>
 
  
  <table class="material">
              
             <tr><legend align="center"><h3>Digitalizadores</h3></legend></tr>
               <br>
               
             <tr>
                  <th width="15%">Digitalizador cama plana para oficina</th>
                  <td width="40%" center><?php echo $totalD1=$censo->cantDigita($_SESSION['id_div'],1)?></td>
	           </tr>
               <tr>
                  <th width="15%">Digitalizador con alimentador de hojas para oficina</th>
                  <td width="20%" center><?php echo $totalD2=$censo->cantDigita($_SESSION['id_div'],2)?></td>
	           </tr> 
               <tr>
                  <th width="15%">Digitalizador de gran volumen</th>
                  <td width="20%" center><?php echo $totalD3=$censo->cantDigita($_SESSION['id_div'],3)?></td>
                </tr>
                <tr>
                 <th width="15%">Otros</th>
                  <td width="20%" center><?php echo $totalD4=$censo->cantDigita($_SESSION['id_div'],4)?></td>
	           </tr>
               <th width="15%">Total</th>
                   <td width="20%" right><strong><?php echo $totalD1+$totalD2+$totalD3+$totalD4?></strong></td>
  </table>            
  <br>
  <br>

 </div>
<br/>
<br/>
