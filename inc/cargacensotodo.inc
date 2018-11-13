
<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/inventario.class.php');
require_once('../clases/log.class.php');


$logger=new Log();

$lab = new laboratorios();
$madq = new inventario();

$logger->putLog(7,2);
      
  

	



if (isset($_GET['lab']) && isset($_GET['mod']))
 { 
    



 
 //if ($_GET['mod']=='cenec' ){
 
 
 ?>
      <!--<tr><td>&nbsp;</td><td>&nbsp;</td></tr>-->
  
  
  
    

     
   <tr>
      <td align="center"><h2>Censo de Equipo de Cómputo <?php echo $titulo;?> </h2></td>
   </tr>

		
   <tr>
      <td align="center"><h3>Anteriores a Pentium 4 o equivalentes <?php echo $titulo;?> </h3></td>
    </tr>
  
		<?php 
  $query= "SELECT COUNT (*),bien, procesador,estadoBien
            FROM equipoc ec 
            JOIN laboratorios l
            ON ec.id_lab=l.id_lab
            JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (bien='CPU' 
                  OR bien='TABLET'
				  OR bien='SERVIDOR'
				  OR bien='LAPTOP'
				  OR bien='WORKSTATION')
            AND  (estadoBien='USO'OR estadoBien='DESUSO')
            GROUP BY bien,procesador,estadobien
			ORDER BY procesador DESC";
			       
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>    
<?php	

      
  
				    $action="../inc/exportaxls_censo.inc.php";
             
		  ?>
              <form action=<?php echo $action; ?> method="post" name="cenec" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	          <input name="enviar" type="submit" value="Exportar a excelCenso" />
	          <input name="lab" type="hidden" value="<?php echo $_GET['lab'] ?>" />
	          <input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
              <input name="tabla" type="hidden" value="<?php echo $tipotabla ?>" />
              
	      
 
  
 <?php
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ ?>
        
         <table class='material'>
		
		
		   
		 <tr>
             <th  scope="col">Procesador</th>
              <th  scope="col">Bien</th>
              <th  scope="col">Uso/Desuso</th>
              <th  scope="col">Total</th>
            
         </tr>
   
            <tr>
              <td  scope="col"><?php echo $lab_invent['procesador'];?></td>
               <td  scope="col"><?php echo $lab_invent['bien'];?></td>
               <td  scope="col"><?php echo $lab_invent['estadobien'];?></td>
               <td  scope="col"><?php echo $lab_invent['count'];?></td>
            </tr>
            
            
            
            
            
            
            
            
 	<?php
	
		foreach ($lab_invent as $campo => $valor) {
				       echo "\$usuario[$campo] => $valor.\n" . "</br>";
		    echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
				
		}?>
          
        </form>
       <?php 

		} //while
		?>
        
        
          </table>
  <?php          
 //}
 }?>
   
   
 
   


<br/>
<br/>
</div>