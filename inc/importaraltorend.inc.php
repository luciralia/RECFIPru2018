
  <?php 

require_once('../conexion.php');
require_once('../clases/importa.class.php');
require_once('../inc/encabezado.inc.php'); 
session_start(); 



function buscaBienes(&$datosdec){
	
		//echo 'valores en buscabienes'. $invent;
	          
		     // Buscar en bienes 
			 
			 $queryb="SELECT id_dispositivo
							  FROM dispositivo
			                  WHERE inventario="."'".$datosdec[0]."'";
			 // echo $queryb;
			 			  
			  $registrob= @pg_query($queryb) or die('ERROR  en errorinserta'); 
              $disp= pg_fetch_array($registrob);
			  $iddisp=$disp[0];
			
			 
		 
			return $iddisp;
        }//fin función bsucadisp
	
function utf8_string_array_encode(&$array){
    $func = function(&$value,&$key){
        if(is_string($value))
            $value = utf8_encode($value);
         
        if(is_string($key))
            $key = utf8_encode($key);
        
        if(is_array($value))
            utf8_string_array_encode($value);
        
    };
    array_walk($array,$func);
    return $array;
}

$titulo='Importar equipo alto rendimiento ';
$guardaPatrimonio=new importa();
 ?>
 
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
    
  <tr>
    <td align="center"><h2><?php echo $titulo ;?> </h2></td>
  </tr>

<tr>

<td><div class="centrado"> 



<table width="600" cellspacing="20" cellpadding="20" border="0" class="principal">
<form  method="POST" enctype="multipart/form-data">
 <tr>
   <td width="150" height="30" align="right">Subir archivo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
   <td width="400"><input type="file" name="archivo_txt" id='archivo'></td>
 </tr>
 
 <tr>
   <td width="800" height="30" colspan="2" align="center"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

   
     <input  type="submit" value="Importar">
     <input type="reset" value="Cancelar">
   </td>
 </tr>
</form>




<?php 

  $file_upload = $_FILES["archivo_txt"]["name"];
  $tmp_name = $_FILES["archivo_txt"]["tmp_name"];
  $size = $_FILES["archivo_txt"]["size"];
  $tipo = $_FILES["archivo_txt"]["type"];
  $cuenta=0;
  $importa=0;
 
 //echo $tmp_name;
 if($size > 0){
 
 
     $fp = fopen($tmp_name, "r");
   
     // Procesamos linea a linea el archivo CSV y 
     // lo insertamos en la base de datos
	 
	
	 
     while($datos = fgetcsv ($fp, 1000, "\t")){
		  $cuenta++;
		  $datosdec=utf8_string_array_encode($datos); 
		 
		  $queryb="SELECT id_dispositivo
							  FROM dispositivo
			                  WHERE inventario="."'".$datosdec[0]."'";
			// echo $queryb;
			 			  
		 $registrob= @pg_query($queryb) or die('ERROR  en errorinserta'); 
         $disp= pg_fetch_array($registrob);
		 $iddisp=$disp[0];
			
		
		if( $iddisp!=0){
			
   	  $queryd="INSERT INTO equipoarendimiento (
	           id_dispositivo,inventario,
	           cluster,cache,
	           videotipo, modelovideo,
	           videomem,conexion,
	           velocidad, salida,
	           velocidadInt,terminal,
	           criticidad,adquision )
               VALUES (%d,'%s',
			          %d,'%s',
					 '%s','%s',
				     '%s',%d,
				     '%s',%d, 
				     '%s','%s', 
				     '%s','%s')";
				   
                 $queryid=sprintf($queryd, 
                 $iddisp,$datosdec[0],
				 $datosdec[1],$datosdec[2], 
				 $datosdec[3],$datosdec[4],                 
				 $datosdec[5],$datosdec[6],                 
				 $datosdec[7],$datosdec[8],
				 $datosdec[9],$datosdec[10],
				 $datosdec[11],$datosdec[12]);
				// echo $queryid;
               
              $result=pg_query($con,$queryid) ;
               $inserta++;
        }else{?>
			 <legend align="left"> <strong><?php echo "No se ha importado en RECFI  el dispositivo con número de inventario " . $datosdec[0]; ?></strong></legend> 
			
		<?php }

				 
	 }
	  
	
	 fclose($fp);
	 ?>
		
	
	      <legend align="left"> <h3><?php echo "Se importaron  ". $inserta. "/".$cuenta .  " dispositivos "; ?></legend> 
<?php
  }
 ?>
 
     
</div></td>          
</tr>
</table>
<?php

 require('../inc/pie.inc.php');
 
  ?>      
             
 






