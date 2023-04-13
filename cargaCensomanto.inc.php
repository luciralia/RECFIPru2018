
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
       <legend align="right"> <h3></h3>
             <br>
              <form action="../inc/exportaxls_censoAntig.inc.php" method="post" name="ceneceq" >
	               <input name="enviar" type="submit" value="Exportar a Excel" />
                   <input name="lab" type="hidden" value="<?php echo $_GET['lab'];?>" />
       
   </tr>  
   </table>
   
   <br> 
   
   <table class="material">
    <tr><legend align="center"><h3>Equipos de cómputo mod</h3></legend></tr>
    <br>
  
     <tr>
              <th width="15%" >Cantidad de equipos</th>
             
    </tr>
    </table>  
   

         <table class="material">
            
             <tr>
                <th width="10%"></th>
                <td width="20%" center><?php echo $censo->CantidadM($_SESSION['id_div'],$_SESSION['tipo_usuario']);?></td>
             </tr>
           
            
           
            </table>
 <br>
 
  <br>

 </div>
<br/>
<br/>
