
<?php
session_start(); 
require_once('../conexion.php');
require_once('../clases/censo.class.php');
require_once('../clases/log.class.php');


$logger=new Log();
$logger->putLog(7,2);
$censo = new censo();


 if ($_SESSION['tipo_usuario']==10  &&  $_SESSION['id_div']=='')
		   $_SESSION['id_div']=$_REQUEST['div'];
 if ($_SESSION['tipo_usuario']==9)
  $_SESSION['id_div']=$_REQUEST['div'];
  

?>

<br>

<!--<div style="text-align:center;">-->

 <table>
  <tr>
       <legend align="right"> <h3>Impresoras por tipo</h3>
             <br>
              <form action="../inc/exportaxls_censoitipo.inc.php" method="post" name="ceneceq" >
	               <input name="enviar" type="submit" value="Exportar a Excel" />
                   <input name="lab" type="hidden" value="<?php echo $_GET['lab'];?>" />
       
   </tr>  
   </table>
   
   <br> 
   
   <table class="material">
    <tr><legend align="center"></legend></tr>
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
  
  <br>

 </div>
<br/>
<br/>



















