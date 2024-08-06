<?php 
require_once('../inc/sesion.inc.php');
require_once('../conexion.php');
require_once('../clases/importa.class.php');
require_once('../inc/encabezado.inc.php'); 
session_start(); 

	
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

$titulo='Importar Departamentos';
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
</table>



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
	 
	
	 ?>
      <table>
      <?php 
     while($datos = fgetcsv ($fp, 1000, "\t")){
		  $cuenta++;
		  $datosdec=utf8_string_array_encode($datos); 
		  
	     $querytemp="SELECT * FROM departamentos WHERE 
		              id_dep=".$datosdec[0];
					  					  
		  $datostemp = pg_query($querytemp);
		   
		  if (pg_num_rows($datostemp)>0) {
			 
		         /*  $updatequery= "UPDATE usuarios SET usuario='%s'
			                      WHERE id_lab="."'".$datosdec[0]."'";
							  
			        $queryu=sprintf($updatequery,$datosdec[0] ); 
			        $result=pg_query($queryu) or die('ERROR AL ACTUALIZAR laboratorios '); */
			        $repetido++; ?>
					 <legend align="left"> <?php echo "Se insertó previamente el departamento con identificador" . $datosdec[0]; ?></legend> 
			       
		   <?php } else { 
	     

							 $strqueryd="INSERT INTO departamentos (id_dep,id_div,
							                                        id_responsable,nombre)
                                                             VALUES (%d,%d,
															          %d,'%s')";
				   
                               $queryid=sprintf($strqueryd, $datosdec[0],$datosdec[2],
					                              $datosdec[3],$datosdec[1]);
               
			         //echo $queryid;
                $result=pg_query($queryid) or die('ERROR AL INSERTAR EN Departamentos ' . pg_last_error());
				
			                 $importa++; // inserciones restantes
	
	             }
 
	 } 
	 fclose($fp);
	 ?>
		
	
	      <legend align="left"> <h3><?php echo "Se importaron " . $importa . "/". $cuenta.  " Departamentos."; ?></legend> 
<?php
  }
 ?>
 
     
</div></td>          
</tr>

<?php

 require('../inc/pie.inc.php');
 
  ?>   