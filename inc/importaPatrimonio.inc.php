
  <?php 

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

$titulo='Importar Inventario Patrimonio ';
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
	 
	
	 ?>
  
      <?php 
     while($datos = fgetcsv ($fp, 1000, "\t")){
		  $cuenta++;
		  $datosdec=utf8_string_array_encode($datos); 
		// $guardaPatrimonio->patrimonio($datosdec);
		  
       /*  $querytemp="SELECT * FROM invent_patrimonio WHERE 
		              inventario_inicial="."'".$datosdec[3]."'";
		  
		  $datostemp = pg_query($con,$querytemp);
		  
		  $importado=pg_num_rows($datostemp);
		   
		 if ($importado>0) {   */?>      
               <legend align="left"> <strong><?php // echo "Se importó previamente el dispositivo con número de inventario " . $datosdec[3]; ?></strong></legend> 
    <?php
		// }else {
   
   	  $queryd="INSERT INTO invent_patrimonio (id, fecha_ubica,grupo_ubica,           
           inventario_inicial,inventario_pat,inventario_anterior,
           descripcion_pat,marca_pat,modelo_pat,
		   serie_pat,fecha_alta_pat,factura_pat,
		   fecha_factura_pat,proveedor_pat,pedido_pat,
		   requesicion_pat,importe_pat,referencia_pat,
		   baja_pat,fecha_baja_pat,destino_baja,
		   id_tipobien_pat,id_usuario_pat,id_clasif_pat,
		   id_area_pat,id_observ_pat,subdep_pat,
		   adjuntos,observa_baja,fecha_ub_pat,
		   nombre_depend,mir,auditoria,
		   identif_baja,info_pat
           )

		      VALUES ('%s','%s','%s',
		           '%s','%s','%s',
				   '%s','%s','%s',
				   '%s','%s','%s', 
				   '%s','%s','%s', 
				   '%s','%s','%s', 
				   '%s','%s','%s',
				   '%s','%s','%s',	
				   '%s','%s','%s', 
				   '%s','%s','%s',   
				   '%s','%s','%s',  
				   '%s','%s')";
				   
                 $queryid=sprintf($queryd, 
                 $datosdec[0],$datosdec[1],$datosdec[2], 
				 $datosdec[3],$datosdec[4],$datosdec[5],
				 $datosdec[6],$datosdec[7],$datosdec[8],
				 $datodec[9], $datosdec[10],$datosdec[11],
				 $datosdec[12],$datosdec[13],$datosdec[14],
				 $datosdec[15],$datosdec[16],$datosdec[17],
				 $datosdec[18],$datosdec[19],$datosdec[20],
				 $datosdec[21],$datosdec[22],$datosdec[23],
				 $datosdec[24],$datosdec[25],$datosdec[26],
			     $datosdec[27],$datosdec[28],$datosdec[29],
			     $datosdec[30],$datosdec[31],$datosdec[32], 
			     $datosdec[33],$datosdec[34]);
				// echo $queryid;
               
              $result=pg_query($con,$queryid) ;


		 //}

				 
	 }
	  
	
	 fclose($fp);
	 ?>
		
	
	      <legend align="left"> <h3><?php echo "Existen  ". $cuenta;  " dispositivos ."; ?></legend> 
<?php
  }
 ?>
 
     
</div></td>          
</tr>
</table>
<?php

 require('../inc/pie.inc.php');
 
  ?>      
             
 






