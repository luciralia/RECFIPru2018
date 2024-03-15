
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
              <th width="5%" ><strong>TOTAL</strong></th>
    </tr>
    </table>  
    <?php
      $cuenta=0;
	  $totalC1=0;$totalC2=0;$totalC3=0;$totalC4=0;
	  
	  $totalS1=0;$totalS2=0;$totalS3=0;$totalS4=0;
	   ?>

        
         <table class="material">
            

             <tr>
                
                <th width="15%">Computadoras de escritorio Windows</th>
               
                <td width="20%" center><?php echo $a1=$censo->CantidadC($_SESSION['id_div'],1,1)?></td>
                <td width="20%" center><?php echo $a2=$censo->CantidadC($_SESSION['id_div'],1,2)?></td>
                <td width="20%" center><?php echo $a3=$censo->CantidadC($_SESSION['id_div'],1,3)?></td>
                <td width="20%" center><?php echo $a4=$censo->CantidadC($_SESSION['id_div'],1,4)?></td>
                <td width="20%" center><?php echo $t=$a1+$a2+$a3+$a4 ?></td>
            </tr>
            <tr>
                
                <th width="15%">Computadoras de escritorio Linux</th>
                <td width="20%" center><?php echo $b1=$censo->CantidadC($_SESSION['id_div'],2,1)?></td>
                <td width="20%" center><?php echo $b2=$censo->CantidadC($_SESSION['id_div'],2,2)?></td>
                <td width="20%" center><?php echo $b3=$censo->CantidadC($_SESSION['id_div'],2,3)?></td>
                <td width="20%" center><?php echo $b4=$censo->CantidadC($_SESSION['id_div'],2,4)?></td>
                <td width="20%" center><?php echo $u=$b1+$b2+$b3+$b4 ?></td></td>
            </tr>
            
            <tr>
                
                <th width="15%">Computadoras de Escritorio Apple Mac</th>
                <td width="20%" center><?php echo $c1=$censo->CantidadC($_SESSION['id_div'],3,1)?></td>
                <td width="20%" center><?php echo $c2=$censo->CantidadC($_SESSION['id_div'],3,2)?></td>
                <td width="20%" center><?php echo $c3=$censo->CantidadC($_SESSION['id_div'],3,3)?></td>
                <td width="20%" center><?php echo $c4=$censo->CantidadC($_SESSION['id_div'],3,4)?></td>
                <td width="20%" center><?php echo $v=$c1+$c2+$c3+$c4 ?></td></td>
           <tr>
                <th width="15%">Computadoras portátiles</th>
                <td width="20%" center><?php echo $d1=$censo->CantidadC($_SESSION['id_div'],4,1)?></td>
                <td width="20%" center><?php echo $d2=$censo->CantidadC($_SESSION['id_div'],4,2)?></td>
                <td width="20%" center><?php echo $d3=$censo->CantidadC($_SESSION['id_div'],4,3)?></td>
                <td width="20%" center><?php echo $d4=$censo->CantidadC($_SESSION['id_div'],4,4)?></td>
                <td width="20%" center><?php echo $w=$d1+$d2+$d3+$d4?></td>
            </tr>
            <tr>
                <th width="15%">Computadoras
                                portátiles Apple Mac</th>
                <td width="20%" center><?php echo $e1=$censo->CantidadC($_SESSION['id_div'],5,1)?></td>
                <td width="20%" center><?php echo $e2=$censo->CantidadC($_SESSION['id_div'],5,2)?></td>
                <td width="20%" center><?php echo $e3=$censo->CantidadC($_SESSION['id_div'],5,3)?></td>
                <td width="20%" center><?php echo $e4=$censo->CantidadC($_SESSION['id_div'],5,4)?></td>
                <td width="20%" center><?php echo $x=$e1+$e2+$e3+$e4?></td>
            </tr>
            <tr>
                
                <th width="15%">Tabletas iPadOS</th>
                <td width="20%" center><?php echo $f1=$censo->CantidadC($_SESSION['id_div'],6,1)?></td>
                <td width="20%" center><?php echo $f2=$censo->CantidadC($_SESSION['id_div'],6,2)?></td>
                <td width="20%" center><?php echo $f3=$censo->CantidadC($_SESSION['id_div'],6,3)?></td>
                <td width="20%" center><?php echo $f4=$censo->CantidadC($_SESSION['id_div'],6,4)?></td>
                <td width="20%" center><?php echo $y=$f1+$f2+$f3+$f4?></td>
            </tr>
            
            <tr>
                
                <th width="15%">Tabletas
                                Android
                                </th>
                <td width="20%" center><?php echo $g1=$censo->CantidadC($_SESSION['id_div'],7,1)?></td>
                <td width="20%" center><?php echo $g2=$censo->CantidadC($_SESSION['id_div'],7,2)?></td>
                <td width="20%" center><?php echo $g3=$censo->CantidadC($_SESSION['id_div'],7,3)?></td>
                <td width="20%" center><?php echo $g4=$censo->CantidadC($_SESSION['id_div'],7,4)?></td>
				<td width="20%" center><?php echo $z=$g1+$g2+$g3+$g4?></td>
            </tr>
            
            <tr>
                
                <th width="15%">Servidores
                                </th>
                <td width="20%" center><?php echo $h1=$censo->CantidadS($_SESSION['id_div'],1,$_SESSION['tipo_usuario'])?></td>
                <td width="20%" center><?php echo $h2=$censo->CantidadS($_SESSION['id_div'],2,$_SESSION['tipo_usuario'])?></td>
                <td width="20%" center><?php echo $h2=$censo->CantidadS($_SESSION['id_div'],3,$_SESSION['tipo_usuario'])?></td>
                <td width="20%" center><?php echo $h4=$censo->CantidadS($_SESSION['id_div'],4,$_SESSION['tipo_usuario'])?></td>
                <td width="20%" center><?php echo $s=$h1+$h2+$h3+$h4?></td>
            </tr>
            
             <tr>
                
                <th width="15%">Total</th>
                <td width="20%" center><?php echo $totalS1=$a1+$b1+$c1+$d1+$e1+$f1+$g1+$h1?></td>
                                                          
                <td width="20%" center><?php echo $totalS2=$a2+$b2+$c2+$d2+$e2+$f2+$g2+$h2?></td>
	                                              
                <td width="20%" center><?php echo $totalS3=$a3+$b3+$c3+$d3+$e3+$f3+$g3+$h3?></td>
	                                              
                <td width="20%" center><?php echo $totalS4=$a4+$b4+$c4+$d4+$e4+$f4+$g4+$h4?></td>
                
           
           
               <td width="20%" right><strong><?php echo $totalS1+$totalS2+$totalS3+$totalS4?></strong></td>
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
                
                   <th width="15%">TOTAL</th>
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
               <th width="15%">TOTAL</th>
                   <td width="20%" right><strong><?php echo $totalD1+$totalD2+$totalD3+$totalD4?></strong></td>
  </table>            
  <br>
  <br>

 </div>
<br/>
<br/>
