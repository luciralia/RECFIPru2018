<script>
 
			
function divo(){
	 var divor= document.getElementById("id_div").value;
				
	 window.location='../inc/comparaRECFI_pat.inc.php?div='+ divor;
			 
};
</script>
<?php

require_once('../conexion.php');
require_once('../inc/encabezado.inc.php'); 

if (isset($_REQUEST['div'] )){
$querydiv="SELECT siglas FROM divisiones
           WHERE id_div=". $_REQUEST['div'];
		   
$siglas= pg_query ($con,$querydiv);
$siglasdiv= pg_fetch_array($siglas);
}

?>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
    
   <div class="block" id="necesidades_content">    
     
  
    
      <td>
      <?php
       $query="SELECT * FROM divisiones";

                 $result=  @pg_query($query) or die('Hubo un error con la base de datos en divisiones');
?>                
                 <div class="caja">
                 <select name="id_div" id="id_div"  onChange="divo();">
                        <option value="0">Seleccionar División</option>
                              <?php while ($datosc = pg_fetch_array($result)){?>
               	                            <option value="<?php echo $datosc['id_div']; ?>"><?php echo $datosc['nombre']; ?></option>
			                  <?php } 
							   
							  ?>
		         </select></div>
       </td>
                                         
    
     
       <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
     
     
        
 
      
       
         <tr>
        <td><legend align="right"><h4>Exportar a Excel</h4></legend>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         
       
        <legend align="right">
          <?php $action="../inc/exportacomparaRECFI.inc.php";?>
         
              <form action=<?php  echo $action; ?> method="post" name="expcompara" >
	          <input name="enviar" type="submit" value="Exportar" />
               <input name="div" type="hidden" value="<?php echo $_REQUEST['div'] ?>" />
	   
       
 <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td align="center" ><h2><?php echo 'Compara  RECFI vs Patrimonio';?></h2></td></tr>
 
 <tr> <td>
     
<?php
if (isset($_REQUEST['div'] )){ //solo si se tiene división

            $query="SELECT inventario,dep.nombre as nombdep,div.nombre as nombdiv,l.nombre as nomblab,ce.descripcion as edif,* FROM 
                    dispositivo d
					JOIN laboratorios l
                    ON l.id_lab=d.id_lab
                    JOIN departamentos dep
                    ON dep.id_dep=l.id_dep
                    JOIN divisiones div
                    ON div.id_div=dep.id_div
                    JOIN cat_dispositivo cd
                    ON cd.dispositivo_clave=d.dispositivo_clave
                    JOIN cat_edificio ce
                    ON ce.id=l.id_edif
                    WHERE div.id_div= ". $_REQUEST['div'];


 //echo $query;
   $datos = pg_query($con,$query);
   $inventario= pg_num_rows($datos); 
   
while ($datos_RECFI = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) {
		 //$cad=substr($datos_RECFI['ínventario'],4,5);
		 //echo "cadena".$cad;
		 // echo 'cadenita'.$datos_RECFI['inventario'];
		  if(preg_match("/^[0-9]+$/",$datos_RECFI['inventario'])) {
			  
			  //$cad=substr($datos_RECFI['ínventario_pat'],4,5);
			  // echo "inv".$datos_RECFI['inventario'];	
			  //echo "cadena".$cad;
			  //"/^(\d{1,5}?)?$/"
			  $querydisp="SELECT * FROM invent_patrimonio ip
                               LEFT JOIN area_patrimonio ap
                               ON (ip.id_area_pat=ap.id_area_pat )
                               LEFT JOIN resguardante r
                               ON r.id_usuario_pat=ip.id_usuario_pat
                               LEFT JOIN clasif_bien_pat cp
                               ON cp.id_clasif_pat=ip.id_clasif_pat
		                       WHERE  inventario_pat='".$datos_RECFI['inventario'].
                               "'  " ;
					//echo $querydisp;
		  }else
		if(preg_match("/^F/",$datos_RECFI['inventario'])) {
			   $cad=substr($datos_RECFI['inventario'],3,5);
			  // echo 'cadenita'.$cad;
			   
			       $querydisp="SELECT * FROM invent_patrimonio ip
                               LEFT JOIN area_patrimonio ap
                               ON (ip.id_area_pat=ap.id_area_pat )
                               LEFT JOIN resguardante r
                               ON r.id_usuario_pat=ip.id_usuario_pat
                               LEFT JOIN clasif_bien_pat cp
                               ON cp.id_clasif_pat=ip.id_clasif_pat
		                       WHERE  inventario_pat='".$cad.
                               "'" ;
					
					//echo $querydisp;
		  }
					//echo $querydisp;
	     $queryverif= pg_query($con,$querydisp);	
		 
         $datos_pat= pg_fetch_array($queryverif);
		  
		 $existe= pg_num_rows($queryverif);
		 
		 
		 //guardar en una tabla temporal y comenzar a comparar ?>
		

        <table class='material'>
           
           <tr>
               <th width="20%" scope="col">Inventario RECFI</th>
               <th width="20%" scope="col">Descripción RECFI</th>
               <th width="20%" scope="col">División</th>
               <th width="20%" scope="col">Ubicación RECFI</th>
               <th width="20%" scope="col">ap_pat</th>
               <th width="20%" scope="col">Nombres</th>
               <th width="20%" scope="col">Departamento</th>
               <th width="20%" scope="col">Edificio</th>
               <th width="20%" scope="col">Nivel</th>
               <th width="20%" scope="col">Detalle Ubic</th>
            
           </tr>
		<tr>
                  <td width="20%" scope="col"><?php echo $datos_RECFI['inventario'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_RECFI['nombre_dispositivo'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_RECFI['nombdiv'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_RECFI['nomblab'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_RECFI['nombre_resguardo'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_RECFI['nombre_pat'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_RECFI['nombdep'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_RECFI['edif'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_RECFI['nivel'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_RECFI['detalle_ub'];?></td>
                  
           </tr>
            <tr>
               <th width="20%" scope="col">Inventario Patrimonio</th>
               <th width="20%" scope="col">Descripción Pat</th>
               <th width="20%" scope="col">División Pat</th>
               <th width="20%" scope="col">Ubicación Pat</th>
               <th width="20%" scope="col">ap_pat Pat</th>
               <th width="20%" scope="col">Nombres</th>
               <th width="20%" scope="col">Departamento</th>
               <th width="20%" scope="col">Edificio Pat</th>
               <th width="20%" scope="col">Nivel Pat</th>
            
           </tr>
          <tr>
                  <td width="20%" scope="col"><?php echo $datos_pat['inventario_pat'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_pat['descripcion_pat'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_pat['division_pat'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_pat['local_pat'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_pat['ap_pat'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_pat['nombre_pat'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_pat['depto_pat'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_pat['id_edif_pat'];?></td>
                  <td width="20%" scope="col"><?php echo $datos_pat['nivel_pat'];?></td>
           </tr>
   
<?php		
		 
 }
}
?>
</legend>
       </form>
       </td>
</tr>
 </table>

  
            
           
             <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>       
            
 <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 </div>

 
 <?php

 require('../inc/pie.inc.php');
 
  ?>     