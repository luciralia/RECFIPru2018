
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

 <table>
  <tr>
       <legend align="right"> <h3>Equipo de digitalización por tipo</h3>
             <br>
              <form action="../inc/exportaxls_censoedtipo.inc.php" method="post" name="ceneceq" >
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
                <th width="10%">Digitalizador de cama plana para oficina</th>
                <td width="20%" center><?php echo $totalD1=$censo->cantImpresoraT($_SESSION['id_div'],1,$_SESSION['tipo_usuario'])?></td>
             </tr>
           
            <tr>
                <th width="10%">Digitalizador con alimentador de hojas para oficina</th>
                <td width="20%" center><?php echo $totalD2=$censo->cantImpresoraT($_SESSION['id_div'],2,$_SESSION['tipo_usuario'])?></td>
            </tr>
            <tr>
                <th width="10%">Digitalizador de gran volumen</th>
                <td width="20%" center><?php echo $totalD3=$censo->cantImpresoraT($_SESSION['id_div'],3,$_SESSION['tipo_usuario'])?></td>
             </tr>
             <tr>
                <th width="10%">Otros</th>
                <td width="20%" center><?php echo $totalD4=$censo->cantImpresoraT($_SESSION['id_div'],4,$_SESSION['tipo_usuario'])?></td>
             </tr>
             
             <th width="15%"><strong>TOTAL</strong></th>
                   <td width="20%" right><strong><?php echo $totalD1+$totalD2+$totalD3+$totalD4?></strong></td>
           </table>
 <br>
  
  <br>

 </div>
<br/>
<br/>



















