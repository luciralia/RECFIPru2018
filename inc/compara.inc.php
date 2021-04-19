<script>
 
			
function divo(){
	 var divor= document.getElementById("id_div").value;
				
	 window.location='../inc/compara.inc.php?div='+ divor;
			 
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
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
        <td>&nbsp;</td></tr>
    
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
          <?php $action="../inc/exportacompara.inc.php";?>
         
              <form action=<?php  echo $action; ?> method="post" name="expcompara" >
	          <input name="enviar" type="submit" value="ExportarPat" />
               <input name="div" type="hidden" value="<?php echo $_REQUEST['div'] ?>" />
	   
       
 <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td align="center" ><h2><?php echo 'Compara Patrimonio vs RECFI';?></h2></td></tr>
 
   <tr> <td>   
<?php
if (isset($_REQUEST['div'] )){ //solo si se tiene división

 $query="SELECT * FROM invent_patrimonio ip
         LEFT JOIN area_patrimonio ap
         ON (ip.id_area_pat=ap.id_area_pat )
         LEFT JOIN resguardante r
         ON r.id_usuario_pat=ip.id_usuario_pat
         LEFT JOIN clasif_bien_pat cp
         on cp.id_clasif_pat=ip.id_clasif_pat
		 WHERE division_pat ='".$siglasdiv[0].
         "'   AND (ip.id_clasif_pat='1'
		 OR ip.id_clasif_pat='2') AND (descripcion_pat LIKE '%OMPUT%'
         OR descripcion_pat LIKE '%APTO%'  )
         ";
//echo $query;
   $datos = pg_query($con,$query);
   $inventario= pg_num_rows($datos); 
   
while ($datos_pat = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{
		$cad=substr($datos_pat['ínventario_pat'],4,5);	
		$expreg= '/^(\d{5}(\d{4})?)?$/';
		  if(preg_match("/^(\d{1,5}?)?$/",$datos_pat['inventario_pat'])) {
			  
			  //$cad=substr($datos_pat['ínventario_pat'],4,5);
			//  echo "inv".$datos_pat['inventario_pat'];	
			  //echo "cadena".$cad;
			  
		$querydisp="SELECT inventario,dep.nombre as nombdep,div.nombre as nombdiv,l.nombre as nomblab,ce.descripcion as edif,* FROM 
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
                    WHERE
					div.id_div= ". $_REQUEST['div']."
                     AND inventario='FI:".$datos_pat['inventario_pat']."'"
					;
					//echo $querydisp;
		  }elseif(preg_match("/^(\d{7,8}?)?$/",$datos_pat['inventario_pat'])) {
			  $querydisp="SELECT inventario,dep.nombre as nombdep,div.nombre as nombdiv,l.nombre as nomblab,ce.descripcion as edif,* FROM 
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
                    WHERE
					div.id_div= ". $_REQUEST['div']. " AND
                    inventario='". $datos_pat['inventario_pat']."'" ;
					//echo $querydisp;
					
		  }
					//echo $querydisp;
	     $queryverif= pg_query($con,$querydisp);	
		 
         $verifica= pg_fetch_array($queryverif);
		  
		 $existe= pg_num_rows($queryverif);
		 
		 if ($existe>0)
		    $valorexiste=$verifica['inventario'];
		 else
			$valorexiste ='No existe en RECFI';
		 //guardar en una tabla temporal y comenzar a comparar ?>
		

        <table class='material'>
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
                  <td width="20%" scope="col"><?php echo $valorexiste;?></td>
                  <td width="20%" scope="col"><?php echo $verifica['nombre_dispositivo'];?></td>
                  <td width="20%" scope="col"><?php echo $verifica['nombdiv'];?></td>
                  <td width="20%" scope="col"><?php echo $verifica['nomblab'];?></td>
                  <td width="20%" scope="col"><?php echo $verifica['nombre_resguardo'];?></td>
                  <td width="20%" scope="col"><?php echo $verifica['nombre_pat'];?></td>
                  <td width="20%" scope="col"><?php echo $verifica['nombdep'];?></td>
                  <td width="20%" scope="col"><?php echo $verifica['edif'];?></td>
                  <td width="20%" scope="col"><?php echo $verifica['nivel'];?></td>
                  <td width="20%" scope="col"><?php echo $verifica['detalle_ub'];?></td>
                  
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