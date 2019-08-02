<strong></strong>
<?php
// version que no toma equipoexperimentaL PARA VER
require_once('../conexion.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/inventario.class.php');
require_once('../clases/log.class.php');


$logger=new Log();

$lab = new laboratorios();

$consulta= new inventario();


$logger->putLog(7,2);

$bandera1=0;
//echo'datos en cargaInv';
//print_r($_SESSION);

if ($_GET['mod']=='invg' ){
	 $action1="../view/inicio.html.php?lab=".$_GET['lab'] ."&mod=". $_GET['mod']."&div=". $_SESSION['id_div'].'&orden='. $_REQUEST['orden'];?>

<tr>
<td align="center">

<div style="text-align: right"> <div id="botonblu" > <a href="<?php echo $action1 . '&accion=buscarg';?>">Búsqueda</a></div>
<br/>
<br/>
</td>
 </tr>

<tr> 
<td>

<div class="block" id="necesidades_content">    
      
          <form action="../view/inicio.html.php" method="get" name="orderby">
          Ordenar por: <select name="orden">
          <option value="orden" <?php echo $sel=(!isset($_GET['orden'])||$_GET['orden']=='orden') ? 'selected="selected"':''; ?>>Seleccione...          </option>
          <option value="descripcion" <?php echo $sel=($_GET['orden']=='descripcion')? 'selected="selected"': "";?>>Descripción</option>
          <option value="clave" <?php echo $sel=($_GET['orden']=='clave')? 'selected="selected"': "";?>>No. Inventario</option>
          <option value="marca" <?php echo $sel=($_GET['orden']=='marca')? 'selected="selected"': "";?>>Marca</option>
           </select>
    
<?php

	echo "<input name='lab' type='hidden' value='". $_GET['lab']."' /> \n";
	echo "<input name='mod' type='hidden' value='".$_GET['mod']."' /> \n"; ?>
   
<input name="bOrden" type="submit" value="ordenar" />


</form>
<!--</td>-->


              
<?php // if ($_SESSION['tipo_usuario']==9 || $_SESSION['tipo_usuario']==10){ ?>
        <!--<tr>
        <td align="right">  <h3> Inventario por División</h3> </td>
       
        </tr>
        <tr></tr>
        <tr></tr>
        
       
         <tr>
        <td><legend align="right"><h4>Exportar a Excel</h4></legend>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <br>
        <legend align="right">
          <?php $action="../inc/exportainvgendivxls.inc.php";?>
         
              <form action=<?php  echo $action; ?> method="post" name="expgendividen" >
	          <input name="enviar" type="submit" value="Con identificador" />
	          <input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
              </form>
              </legend>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
            </tr> 
            <tr>
           <td>
           <legend align="right">
          <?php $action="../inc/exportainvgendivxls.inc.php";?>
         
              <form action=<?php  echo $action; ?> method="post" name="expgendivnomb" >
	          <input name="enviar" type="submit" value="Con nombre" />
	          <input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
              </form>
              </legend>
            </td>
            </tr> -->
            
 <?php //} ?>

</td>
</tr>

<?php	

//for ($x=0;$x<count($listatablas);$x++)
//{
	
          if($_GET['lab']!=NULL && ($_GET['mod']=='invg' || $_SESSION['tipo_usuario']!=10) ){

               
                     $query= "SELECT  e.*, n.nomlab as laboratorio, bi.*,* 
                              FROM dispositivo e 
                              LEFT JOIN cat_dispositivo cd
                              ON e.dispositivo_clave=cd.dispositivo_clave
                              LEFT JOIN cat_familia cf
                              ON e.familia_clave=cf.id_familia
                              LEFT JOIN cat_tipo_ram ctr
                              ON e.tipo_ram_clave=ctr.id_tipo_ram
                              LEFT JOIN cat_tecnologia ct
                              ON e.tecnologia_clave=ct.id_tecnologia
                              LEFT JOIN cat_sist_oper cso
							  ON  e.sist_oper=cso.id_sist_oper
							  LEFT JOIN cat_usuario_final cuf
			                  ON cuf.usuario_final_clave=e.usuario_final_clave
                              LEFT JOIN cat_marca cm
                              ON cm.id_marca=e.id_marca
                              LEFT JOIN cat_memoria_ram cmr
                              ON e.id_mem_ram=cmr.id_mem_ram
                              LEFT JOIN bienes_inventario bi
                              ON e.bn_id = bi.bn_id
                              LEFT JOIN (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                                          ac.id_acad,ac.nombre AS academia, 
                                          d.id_dep, d.nombre AS depto, 
                                          co.id_coord,co.nombre AS coord, 
                                          dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                                          FROM laboratorios l
                                          LEFT JOIN academia ac
                                          ON ac.id_acad=l.id_acad
                                          LEFT JOIN departamentos d
                                          ON (ac.id_dep=d.id_dep
                                              OR l.id_dep=d.id_dep)
                                          LEFT JOIN coordinacion co
                                          ON (co.id_coord=d.id_coord
                                              OR co.id_coord=l.id_coord)
                                          LEFT JOIN divisiones dv
                                          ON (dv.id_div=co.id_div
                                              OR d.id_div=dv.id_div )) n
                                          ON n.lab=e.id_lab
							  WHERE n.lab=";
                       
                      
  
            switch ($_GET['orden']){
 			case "descripcion":
			     $query.= $_GET['lab'] . " ORDER BY bi.bn_desc ASC";
			break;
 			case "clave":
			     $query.= $_GET['lab'] . " ORDER BY bi.bn_clave ASC";
			break;
			case "marca":
			     $query.= $_GET['lab'] . " ORDER BY bi.bn_marca ASC";
			break;
 			default:
			     $query.= $_GET['lab'] . " ORDER BY e.fecha DESC";
	    	break;
			
           } // fin de switch
        }else{
         //adapta la consulta    
		 // $query=$consulta->adapta($_GET['mod'],$_SESSION['nivel'],0);
		 $query= " SELECT  e.*, n.nomlab AS laboratorio, bi.*,* 
                 FROM dispositivo e 
                 LEFT JOIN cat_dispositivo cd
                 ON e.dispositivo_clave=cd.dispositivo_clave
                 LEFT JOIN cat_familia cf
                 ON e.familia_clave=cf.id_familia
                 LEFT JOIN cat_tipo_ram ctr
                 ON e.tipo_ram_clave=ctr.id_tipo_ram
                 LEFT JOIN cat_tecnologia ct
                 on e.tecnologia_clave=ct.id_tecnologia
                 LEFT JOIN cat_sist_oper cso
                 on  e.sist_oper=cso.id_sist_oper
	             LEFT JOIN cat_usuario_final cuf
	             on cuf.usuario_final_clave=e.usuario_final_clave
                 LEFT JOIN cat_marca cm
                 on cm.id_marca=e.id_marca
                 LEFT JOIN cat_memoria_ram cmr
                 on e.id_mem_ram=cmr.id_mem_ram
                 LEFT JOIN bienes_inventario bi
                 ON e.bn_id = bi.bn_id
                 LEFT JOIN(	
                          SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                          ac.id_acad,ac.nombre AS academia, 
                          d.id_dep, d.nombre AS depto, 
                          co.id_coord,co.nombre AS coord, 
                          dv.id_div,dv.nombre AS nombdivision,id_cac
                          FROM laboratorios l
                          LEFT JOIN academia ac
                          on ac.id_acad=l.id_acad
                          LEFT JOIN departamentos d
                          ON (ac.id_dep=d.id_dep
                              OR l.id_dep=d.id_dep)
                          LEFT JOIN coordinacion co
                          ON (co.id_coord=d.id_coord
                              OR co.id_coord=l.id_coord)
                          LEFT JOIN divisiones dv
                          ON (dv.id_div=co.id_div
                             OR d.id_div=dv.id_div )) n
                ON n.lab=e.id_lab
			    WHERE n.id_div=";
			
            switch ($_GET['orden']){
 			case "descripcion":
			    $query.= $_SESSION['id_div'] . " ORDER BY bi.bn_desc ASC";
			break;
 			case "clave":
			     $query.= $_SESSION['id_div'] . " ORDER BY bi.bn_clave ASC";
			break;
			case "marca":
			    $query.= $_SESSION['id_div']. " ORDER BY bi.bn_marca ASC";
			break;
 			default:
			    $query.= $_SESSION['id_div'] . " ORDER BY e.fecha DESC";
	    	break;
			
        } // fin de switch
   }
  //echo 'consulta en cargainv'. $query;

   $datos = pg_query($con,$query);
   $inventario= pg_num_rows($datos); 
    if ($_SESSION['tipo_usuario']==9 || $_SESSION['tipo_usuario']==10 && $inventario!=0){ ?>
        <tr>
        <td align="right">  <h3> Inventario por División</h3> </td>
       
        </tr>
        <tr></tr>
        <tr></tr>
        
         <tr>
        <td><legend align="right"><h4>Exportar a Excel</h4></legend>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <br>
        <legend align="right">
          <?php $action="../inc/exportainvgendivxls.inc.php";?>
         
              <form action=<?php  echo $action; ?> method="post" name="expgendividen" >
	          <input name="enviar" type="submit" value="Con identificador" />
	          <input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
              </form>
              </legend>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
            </tr> 
            
           <tr>
           <td>
            
           <legend align="right">
          <?php $action="../inc/exportainvgendivxls.inc.php";?>
         
              <form action=<?php  echo $action; ?> method="post" name="expgendivnomb" >
	          <input name="enviar" type="submit" value="Con nombre" />
	          <input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
              </form>
              </legend>
            </td>
            </tr> 
            
             <tr>
           <td>
           <br>
           <legend align="right">
          <?php $action="../inc/exportainvDGTIC.inc.php";?>
         
              <form action=<?php  echo $action; ?> method="post" name="expDGTIC" >
	          <input name="enviar" type="submit" value="DGTIC" />
	          <input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
              </form>
              </legend>
            </td>
            </tr> 
            
 <?php } ?>

</td>
</tr>
<br>
 <?php
     if (($inventario!=0 ) && $bandera1==0 ) 
         $bandera1=1;  
    

     ?>
    </td>

    <td>
 
 	<?php   

    /* if (isset($_GET['lab']) || isset($_GET['mod']))
       { 
  
			   $titulo=' de cómputo ';
		   
           if ($inventario!=0   ) {
			   
            // para poner titulo del inventario, si hay tuplas
		   
		   ?>
       <br \>         		   	  
       <table>
           <tr>
           <!--
             <legend align="center"><h2>Inventario de equipo  <?php //echo $titulo;?> </h2></legend>
               <td align="rigth"><h2>Inventario de equipo <?php //echo $titulo;?> </h2></td>-->
           </tr>
        </table>
  <br \>
 
  
 <?php  } */  ?>
 
    <br>
  <?php 
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		
          //print_r($lab_invent);
		   	if (count($lab_invent > 0 )){
        
                //&& $lab_invent['bn_notas']=='COMPUTO' 
           ?>
	 

  
            <table class='material'>
            <tr>
               <th width="20%" scope="col">No. Inventario</th>
               <th width="20%" scope="col">No. Inventario Área</th>
               <th width="20%" scope="col">Área</th>
               <th width="20%" scope="col">Usuario Final</th>
               <th width="20%" scope="col">Descripción del equipo</th>
               <th width="20%" scope="col">Marca</th>
               <th width="20%" scope="col">Modelo</th>
               <th width="20%" scope="col">Serie</th>
               <th width="20%" scope="col">Procesador</th>
               <th width="20%" scope="col">Número de  Procesadores</th>
               <th width="20%" scope="col">Núcleos GPU</th>
            
           </tr>
          <tr>
                  <td width="20%" scope="col"><?php echo $lab_invent['bn_clave'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['inventario'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['laboratorio'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['tipo_usuario'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_dispositivo'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['descmarca'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['modelo'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['serie'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_familia'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['cantidad_procesador'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nucleos_gpu'];?></td>
                  
           </tr>
   
           <tr>
               <th width="20%" scope="col">Sistema Operativo</th>
               <th width="20%" scope="col">Versión SO</th>
               <th width="20%" scope="col">Tipo de memoria</th>
               <th width="20%" scope="col">Cantidad de memoria</th>
               <th width="20%" scope="col">Número de Elementos</th>
               <th width="20%" scope="col">Tecnología</th>
               <th width="20%" scope="col">Total de almacenamiento</th>
               <th width="20%" scope="col">Número de arreglos</th>
               <th width="20%" scope="col">Capacidad Total</th>  
               <th width="20%" scope="col">Estado</th>  
               <th width="20%" scope="col">      </th>  
             </tr>
            
             <tr>   
                <td width="20%" scope="col"><?php echo $lab_invent['nombre_so'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['version_sist_oper'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_tipo_ram'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['cantidad_ram'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['num_elementos_almac'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_tecnologia'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['total_almac'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['num_arreglos'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['arreglo_total'];?></td> 
                  <td width="20%" scope="col"><?php echo $lab_invent['estadobien'];?></td>
                 
          </tr>
         
          
<?php //}

	    foreach ($lab_invent as $campo => $valor) {
				       
		    echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
				
		} // fin foreach
	
		?>
        
 <?php  if (($_SESSION['tipo_usuario']!=10)) {
     
     $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=". $_SESSION['id_div'].'&orden='. $_REQUEST['orden'];?>
      <form action="<?php echo $action1; ?>" method="post" name="edi_inv_<?php echo $form=$lab_invent['id_lab'] ."_".$lab_invent['bn_id']; 
	  ?>">

           <!-- <tr ><td style="text-align: right" colspan="11"><input name="accion" type="submit" value="editarG" />   </td></tr>-->
 
 <?php 

		foreach ($lab_invent as $campo => $valor) {
			echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
			
		}
		
		 ?>
         </form>
      
       <?php      
            }//fin if equipoc	para boton de editar	
	?>
          
   <table>

     <?php  } else {
	 //$action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=". $_SESSION['id_div'].'&orden='. $_GET['orden'];
	
	  //isset($_GET['lab']) && isset($_GET['mod']) 
	 }
	 } //while

//}  fin del for que recorre cada inventarios experimental y cómputo


 if (($inventario==0 ) && $bandera1==0 ) { ?>
<br>
<br>
<legend align="center"><h3>No existen dispositivos registrados.</h3></legend>

<?php
}

}// fin del inventario general
else 
{ 

if ( $_SESSION['id_div']==NULL)
	     $_SESSION['id_div']=$_REQUEST['div'];
		 
		 
	if($_GET['lab']!=NULL ){
    if ($_SESSION['tipo_lab']!='e' && $_GET['mod']=='invc' ){
	    $tabla="dispositivo";
		$query= "SELECT  e.*, n.nomlab AS laboratorio, bi.*,* 
                 FROM " . $tabla . " e 
                 LEFT JOIN cat_dispositivo cd
                 ON e.dispositivo_clave=cd.dispositivo_clave
                 LEFT JOIN cat_familia cf
                 ON e.familia_clave=cf.id_familia
                 LEFT JOIN cat_tipo_ram ctr
                 ON e.tipo_ram_clave=ctr.id_tipo_ram
                 LEFT JOIN cat_tecnologia ct
                 ON e.tecnologia_clave=ct.id_tecnologia
                 LEFT JOIN cat_sist_oper cso
                 ON  e.sist_oper=cso.id_sist_oper
				 LEFT JOIN cat_usuario_final cuf
			     ON cuf.usuario_final_clave=e.usuario_final_clave
                 LEFT JOIN cat_marca cm
                 ON cm.id_marca=e.id_marca
                 LEFT JOIN cat_memoria_ram cmr
                 ON e.id_mem_ram=cmr.id_mem_ram
                 LEFT JOIN bienes_inventario bi
                 ON  e.bn_id = bi.bn_id
				 LEFT JOIN (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                            ac.id_acad,ac.nombre AS academia, 
                            d.id_dep, d.nombre AS depto, 
                            co.id_coord,co.nombre AS coord, 
                            dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                            FROM laboratorios l
                            LEFT JOIN academia ac
                            ON ac.id_acad=l.id_acad
                            LEFT JOIN departamentos d
                            ON (ac.id_dep=d.id_dep
                                OR l.id_dep=d.id_dep)
                            LEFT JOIN coordinacion co
                            ON (co.id_coord=d.id_coord
                                OR co.id_coord=l.id_coord)
                            LEFT JOIN divisiones dv
                            ON (dv.id_div=co.id_div
                                OR d.id_div=dv.id_div )) n
                            ON n.lab=e.id_lab
				WHERE n.lab=";
				 
						 
				 }
                 elseif ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='invc' )
                        {$tabla="dispositivo";
			             $query= "SELECT  e.*, n.nomlab as laboratorio, bi.*,* 
                          FROM " . $tabla . " e 
                          LEFT JOIN cat_dispositivo cd
                          ON e.dispositivo_clave=cd.dispositivo_clave
                          LEFT JOIN cat_familia cf
                          on e.familia_clave=cf.id_familia
                          LEFT JOIN cat_tipo_ram ctr
                          on e.tipo_ram_clave=ctr.id_tipo_ram
                          LEFT JOIN cat_tecnologia ct
                          on e.tecnologia_clave=ct.id_tecnologia
                          LEFT JOIN cat_sist_oper cso
                          on  e.sist_oper=cso.id_sist_oper
						  LEFT JOIN cat_usuario_final cuf
			              on cuf.usuario_final_clave=e.usuario_final_clave
                          LEFT JOIN cat_marca cm
                          on cm.id_marca=e.id_marca
                          LEFT JOIN cat_memoria_ram cmr
                          on e.id_mem_ram=cmr.id_mem_ram
                          LEFT JOIN bienes_inventario bi
                          on  e.bn_id = bi.bn_id
						  LEFT JOIN (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                                    ac.id_acad,ac.nombre AS academia, 
                                    d.id_dep, d.nombre AS depto, 
                                    co.id_coord,co.nombre AS coord, 
                                    dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                                    FROM laboratorios l
                                    LEFT JOIN academia ac
                                    ON ac.id_acad=l.id_acad
                                    LEFT JOIN departamentos d
                                    ON (ac.id_dep=d.id_dep
                                       OR l.id_dep=d.id_dep)
                                    LEFT JOIN coordinacion co
                                    ON (co.id_coord=d.id_coord
                                       OR co.id_coord=l.id_coord)
                                    LEFT JOIN divisiones dv
                                    ON (dv.id_div=co.id_div
                                       OR d.id_div=dv.id_div )) n
                                    ON n.lab=e.id_lab
							        WHERE n.lab=";
						
                        						  
						  }
                        else 
                             { $tabla="equipo";
			                   $query= "SELECT  e.*, n.nomlab as laboratorio, bi.*,* 
                                FROM " . $tabla . " e 
                                LEFT JOIN bienes_inventario bi
                                ON  e.bn_id = bi.bn_id
                                LEFT JOIN (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                                          ac.id_acad,ac.nombre AS academia, 
                                          d.id_dep, d.nombre AS depto, 
                                          co.id_coord,co.nombre AS coord, 
                                          dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                                          FROM laboratorios l
                                          LEFT JOIN academia ac
                                          ON ac.id_acad=l.id_acad
                                          LEFT JOIN departamentos d
                                          ON (ac.id_dep=d.id_dep
                                              OR l.id_dep=d.id_dep)
                                          LEFT JOIN coordinacion co
                                          ON (co.id_coord=d.id_coord
                                              OR co.id_coord=l.id_coord)
                                          LEFT JOIN divisiones dv
                                          ON (dv.id_div=co.id_div
                                              OR d.id_div=dv.id_div )) n
                                          ON n.lab=e.id_lab
							              WHERE n.lab=";} 

              switch ($_GET['orden']){
 			  case "descripcion":
			     $query.= $_GET['lab'] . " ORDER BY bi.bn_desc ASC";
			  break;
 			  case "clave":
			     $query.= $_GET['lab'] . " ORDER BY bi.bn_clave ASC";
			  break;
			  case "marca":
			     $query.= $_GET['lab'] . " ORDER BY bi.bn_marca ASC";
			  break;
 			  default:
			     $query.= $_GET['lab'] . " ORDER BY e.fecha DESC";
	    	  break;
			
        } // fin de switch
  
      }else{
	     if ($_SESSION['tipo_lab']!='e' && $_GET['mod']=='invc' ){
			 
			// $query=$consulta->adapta($_GET['mod'],$_SESSION['nivel'],$_SESSION['tipo_lab']);
			 
	         $tabla="dispositivo";
		     $query= "SELECT  e.*, n.nomlab AS laboratorio, bi.*,* 
                      FROM  " . $tabla . " e 
                      LEFT JOIN cat_dispositivo cd
                      ON e.dispositivo_clave=cd.dispositivo_clave
                      LEFT JOIN cat_familia cf
                      ON e.familia_clave=cf.id_familia
                      LEFT JOIN cat_tipo_ram ctr
                      ON e.tipo_ram_clave=ctr.id_tipo_ram
                      LEFT JOIN cat_tecnologia ct
                      ON e.tecnologia_clave=ct.id_tecnologia
                      LEFT JOIN cat_sist_oper cso
                      ON  e.sist_oper=cso.id_sist_oper
					  LEFT JOIN cat_usuario_final cuf
			          ON cuf.usuario_final_clave=e.usuario_final_clave
                      LEFT JOIN cat_marca cm
                      ON cm.id_marca=e.id_marca
                      LEFT JOIN cat_memoria_ram cmr
                      ON e.id_mem_ram=cmr.id_mem_ram
                      LEFT JOIN bienes_inventario bi
                      ON  e.bn_id = bi.bn_id
                      LEFT JOIN (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                                 ac.id_acad,ac.nombre AS academia, 
                                 d.id_dep, d.nombre AS depto, 
                                 co.id_coord,co.nombre AS coord, 
                                 dv.id_div as div,dv.nombre AS nombdivision,id_cac,tipo_lab
                                 FROM laboratorios l
                                 LEFT JOIN academia ac
                                 ON ac.id_acad=l.id_acad
                                 LEFT JOIN departamentos d
                                 ON (ac.id_dep=d.id_dep
                                     OR l.id_dep=d.id_dep)
                                 LEFT JOIN coordinacion co
                                 ON (co.id_coord=d.id_coord
                                     OR co.id_coord=l.id_coord)
                                 LEFT JOIN divisiones dv
                                 ON (dv.id_div=co.id_div
                                     OR d.id_div=dv.id_div )) n
                                 ON n.lab=e.id_lab
					 WHERE  n.div=";
					  
					  }
                          elseif ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='invc' )
                                 {
								  //$query=$consulta->adapta($_GET['mod'],$_SESSION['nivel'],$_SESSION['tipo_lab']);
								  	 
								  $tabla= "dispositivo";
			                       $query= "SELECT  e.*, n.nomlab AS laboratorio, bi.*,* 
                                           FROM " . $tabla . " e 
                                           LEFT JOIN cat_dispositivo cd
                                           ON e.dispositivo_clave=cd.dispositivo_clave
                                           LEFT JOIN cat_familia cf
                                           ON e.familia_clave=cf.id_familia
                                           LEFT JOIN cat_tipo_ram ctr
                                           ON e.tipo_ram_clave=ctr.id_tipo_ram
                                           LEFT JOIN cat_tecnologia ct
                                           ON e.tecnologia_clave=ct.id_tecnologia
										   LEFT JOIN cat_usuario_final cuf
			                               ON cuf.usuario_final_clave=e.usuario_final_clave
                                           LEFT JOIN cat_sist_oper cso
                                           ON  e.sist_oper=cso.id_sist_oper
                                           LEFT JOIN cat_marca cm
                                           ON cm.id_marca=e.id_marca
                                           LEFT JOIN cat_memoria_ram cmr
                                           ON e.id_mem_ram=cmr.id_mem_ram
                                           LEFT JOIN bienes_inventario bi
                                           ON  e.bn_id = bi.bn_id
                                           LEFT JOIN (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                                                     ac.id_acad,ac.nombre AS academia, 
                                                     d.id_dep, d.nombre AS depto, 
                                                     co.id_coord,co.nombre AS coord, 
                                                     dv.id_div as div,dv.nombre AS nombdivision,id_cac,tipo_lab
                                                     FROM laboratorios l
                                                     LEFT JOIN academia ac
                                                     ON ac.id_acad=l.id_acad
                                                     LEFT JOIN departamentos d
                                                     ON (ac.id_dep=d.id_dep
                                                         OR l.id_dep=d.id_dep)
                                                     LEFT JOIN coordinacion co
                                                     ON (co.id_coord=d.id_coord
                                                         OR co.id_coord=l.id_coord)
                                                     LEFT JOIN divisiones dv
                                                     ON (dv.id_div=co.id_div
                                                         OR d.id_div=dv.id_div )) n
                                                     ON n.lab=e.id_lab
					                       WHERE  n.div=";
										   }
                               

                    switch ($_GET['orden']){
 			        case "descripcion":
			                $query.= $_SESSION['id_div'] . " ORDER BY bi.bn_desc ASC";
			        break;
 			        case "clave":
			                $query.= $_SESSION['id_div'] . " ORDER BY bi.bn_clave ASC";
			        break;
			        case "marca":
			                $query.= $_SESSION['id_div'] . " ORDER BY bi.bn_marca ASC";
			        break;
 			        default:
			                $query.= $_SESSION['id_div'] . " ORDER BY e.fecha DESC";
	    	        break;
			
        } // fin de switch
}

$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); //lHH

if ($inventario!=0) { ?>
   
<?php $action1="../view/inicio.html.php?lab=".$_GET['lab'] ."&mod=". $_GET['mod']."&div=". $_SESSION['id_div'].'&orden='. $_GET['orden'];?>
<!-- <form action="<?php echo $action1; ?>" method="post" name="fbusqueda">
<p style="text-align: right"> <input name="accion" type="submit" value="buscar" id="botonblu"/>
</form>-->

<tr>
<td align="center">
<div style="text-align: right"> <div id="botonblu" > <a href="<?php echo $action1 . '&accion=buscar';?>">Búsqueda</a></div>
<br/>
<br/>
<!--New-->
</td>
 </tr>


<tr> 
<td>

<div class="block" id="necesidades_content">      




<form action="../view/inicio.html.php" method="get" name="orderby">
        Ordenar por: <select name="orden">
          <option value="orden" <?php echo $sel=(!isset( $_GET['orden'])|| $_GET['orden']=='orden') ? 'selected="selected"':''; ?>>Seleccione...</option>
          <option value="descripcion" <?php echo $sel=( $_GET['orden']=='descripcion')? 'selected="selected"': "";?>>Descripción</option>
          <option value="clave" <?php echo $sel=( $_GET['orden']=='clave')? 'selected="selected"': "";?>>No. Inventario</option>
          <option value="marca" <?php echo $sel=( $_GET['orden']=='marca')? 'selected="selected"': "";?>>Marca</option>
           </select>
    
<?php

	echo "<input name='lab' type='hidden' value='". $_GET['lab']."' /> \n";
	echo "<input name='mod' type='hidden' value='".$_GET['mod']."' /> \n";
	
	
		?>

<input name="bOrden" type="submit" value="ordenar" />
</form>


<?php		
	if ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='inv') { 
	    $action="../inc/exportaxls_inv.inc.php";} 
		 else
		 if ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='invc') { 
		    $action="../inc/exportaxls_inv.inc.php";}
               elseif ($_SESSION['tipo_lab']!='e' ) {
		          $action="../inc/exportaxls_inv.inc.php"; 
				  }
			  ?>
              
              
        <tr></tr>
        <tr></tr>
              <tr>
              <td>
              <legend align="right"><h4>Exportar a Excel</h4></legend>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <br>
              <legend align="right">
         
              <form action=<?php  echo $action; ?> method="post" name="expgendiv" >
	          <input name="enviar" type="submit" value="Con identificador" />
	          <input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
              <input name="lab" type="hidden" value="<?php echo $_GET['lab'] ?>" />
              </form>
              </legend>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             </td>
            </tr> 
            <tr>
           <td>
              
              <legend align="right">
         
              <form action=<?php  echo $action; ?> method="post" name="expgendiv" >
	          <input name="enviar" type="submit" value="Con nombre" />
	          <input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
              <input name="lab" type="hidden" value="<?php echo $_GET['lab'] ?>" />
              </form>
              </legend>
            </td>
             
           
            </tr>
           

     <?php } elseif ($_GET['mod']=='invc' ) {// if(inventario ==0 )?> 
                <br/>
                <br/>
                <tr>  
     
                  <td align="center">
    
                  <h3> No hay dispositivos registrados. </h3>
                  </td>
                  </tr>
 
             <?php } 
	           /*elseif ($_GET['mod']=='inv' ) { */?>
	           
     <tr>  
     
     <td align="center"> 
 

<br>
<br>

<?php
	 // fin de equipos existentes
if (isset($_GET['lab']) && isset($_GET['mod']))
 { 
 
  $bandera=0;
    while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		
		 //print_r($lab_invent);
		if ((integer)$lab_invent['servidor']==1)
		 {$etiqServidor='Si';}
		 else 
		 {$etiqServidor='No';} 
	      
         if (count($lab_invent > 0 )){?>
         
		<table class='material'>
         
		 <?php
		 if ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='inv'  ) {
		 //&& $lab_invent['bn_notas']=='EQUIPO'
		?>
         
		 <tr>
              <th  width="20%" scope="col">No. Inventario</th>
              <th  width="20%" scope="col">No. Inventario del Área</th>
              <th  width="20%" scope="col">Descripción del equipo</th>
              <th  width="20%" scope="col">Marca</th>
              <th  width="20%" scope="col">Modelo</th>
              <th  width="20%" scope="col">Serie</th>
        </tr>
          	
			<?php
			
			$bandera=1;
			
			} elseif ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='invc' ) { ?>
            
			<tr>
               <th width="20%" scope="col">No. Inventario</th>
               <th width="20%" scope="col">No. Inventario Área</th>
               <th width="20%" scope="col">Usuario Final</th>
               <th width="20%" scope="col">Descripción del equipo</th>
               <th width="20%" scope="col">Marca</th>
               <th width="20%" scope="col">Modelo</th>
               <th width="20%" scope="col">Serie</th>
               <th width="20%" scope="col">Procesador</th>
               <th width="20%" scope="col">Número de  Procesadores</th>
               <th width="20%" scope="col">Núcleos GPU</th>
               
           </tr>
       
     <?php     
    
	 }elseif ($_SESSION['tipo_lab']!='e' && $_GET['mod']=='invc') {   ?>
        
         <tr>
               <th width="20%" scope="col">No. Inventario</th>
               <th width="20%" scope="col">No. Inventario Área</th>
               <th width="20%" scope="col">Usuario Final</th>
               <th width="20%" scope="col">Descripción del equipo</th>
               <th width="20%" scope="col">Marca</th>
               <th width="20%" scope="col">Modelo</th>
               <th width="20%" scope="col">Serie</th>
               <th width="20%" scope="col">Procesador</th>
               <th width="20%" scope="col">Número de Procesadores</th>
               <th width="20%" scope="col">Núcleos GPU</th>
               
           </tr>
           
         
  <?php } //fin elseif ?> 

<?php } //fin de si y solo hay registros 

	    /* if ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='inv' //&& $lab_invent['bn_notas']=='EQUIPO'
		  ) { */?>
        <!-- 
          <tr>
               <td width="20%" scope="col"><?php // echo $lab_invent['bn_clave'];?></td>
               <td width="20%" scope="col"><?php // echo $lab_invent['inventario'];?></td>
               <td width="20%" scope="col"><?php // echo $lab_invent['bn_desc'];?></td>
               <td width="20%" scope="col"><?php // echo $lab_invent['bn_marca'];?></td>
               <td width="20%" scope="col"><?php // echo $lab_invent['bn_modelo'];?></td>
               <td width="20%" scope="col"><?php // echo $lab_invent['bn_serie'];?></td>
         </tr>
          -->
          <?php
		    
           $bandera=1;
		   
		//	} else 
			if ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='invc'  ) { /**/ ?>
           
           <tr>
                  <td width="20%" scope="col"><?php echo $lab_invent['bn_clave'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['inventario'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['tipo_usuario'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_dispositivo'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['marca'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['modelo'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['serie'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_familia'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['cantidad_procesador'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nucleos_gpu'];?></td>
                  
                 
         </tr>
         
         <?php     
         }  elseif ($_SESSION['tipo_lab']!='e' &&  $_GET['mod']=='invc'  ) { /**/  ?>
           
           <tr>
                  <td width="20%" scope="col"><?php echo $lab_invent['bn_clave'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['inventario'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['tipo_usuario'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_dispositivo'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['descmarca'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['modelo_p'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['serie'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_familia'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['cantidad_procesador'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nucleos_gpu'];?></td>
                 
           </tr>
           
         <?php } //fin elseif ?> 


          	<?php 
      
		
		if ($_SESSION['tipo_lab']=='e'  && $_GET['mod']=='invc' ) { ?>
        
           <tr>
               <th width="20%" scope="col">Sistema Operativo</th>
               <th width="20%" scope="col">Versión SO</th>
               <th width="20%" scope="col">Tipo de memoria</th>
               <th width="20%" scope="col">Cantidad de memoria</th>
               <th width="20%" scope="col">Número de Elementos</th>
               <th width="20%" scope="col">Tecnología</th>
               <th width="20%" scope="col">Total de almacenamiento</th>
               <th width="20%" scope="col">Número de arreglos</th>
               <th width="20%" scope="col">Capacidad Total</th>
               <th width="20%" scope="col">Estado</th>
              
           
     <?php     
			
			}elseif ($_SESSION['tipo_lab']!='e' && $_GET['mod']=='invc' ) { ?>
           
           <tr>
               <th width="20%" scope="col">Sistema Operativo</th>
               <th width="20%" scope="col">Versión SO</th>
               <th width="20%" scope="col">Tipo de memoria</th>
               <th width="20%" scope="col">Cantidad de memoria</th>
               <th width="20%" scope="col">Número de Elementos</th>
               <th width="20%" scope="col">Tecnología</th>
               <th width="20%" scope="col">Total de almacenamiento</th>
               <th width="20%" scope="col">Número de arreglos</th>
               <th width="20%" scope="col">Capacidad Total</th>
               <th width="20%" scope="col">Estado</th>
              
           </tr>
           
         
  <?php } //fin elseif ?> 

  <?php 

			if ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='invc' ) {?>
           
           <tr>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_so'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['version_sist_oper'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_tipo_ram'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['memoria_ram'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['num_elementos_almac'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_tecnologia'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['total_almac'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['num_arreglos'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['arreglo_total'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['estadobien'];?></td>
                
         </tr>
         
         <?php   
			
			
			}elseif ($_SESSION['tipo_lab']!='e' && $_GET['mod']=='invc'  ) {   ?>
            
           <tr>   
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_so'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['version_sist_oper'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_tipo_ram'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['cantidad_ram'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['num_elementos_almac'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_tecnologia'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['total_almac'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['num_arreglos'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['arreglo_total'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['estadobien'];?></td>
                 
                  
          </tr>
         
  <?php } //fin elseif ?> 


        <?php
		
         foreach ($lab_invent as $campo => $valor) {
             // echo "\$usuario[$campo] => $valor.\n" . "</br>";
              echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";

         }?>

 <?php  if (($_SESSION['tipo_lab']=='c' || $_SESSION['tipo_lab']=='o' || $_SESSION['tipo_lab']=='e' || $_SESSION['tipo_lab']=='u'||$_SESSION['tipo_lab']=='s' ||$_SESSION['tipo_lab']=='a'||$_SESSION['tipo_lab']=='b'||$_SESSION['tipo_lab']=='t') && $_GET['mod']=='invc' && $_SESSION['tipo_usuario']!=10 ){

 ?>
   
      
      <?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=". $_SESSION['id_div'].'&orden='. $_REQUEST['orden'];?>
      
      <form action="<?php echo $action1; ?>" method="post" name="edi_inv_<?php echo $form=$lab_invent['id_lab'] ."_".$lab_invent['bn_id']; ?>">
 
       <tr><td style="text-align: right" colspan="11"><input name="accion" type="submit" value="editar" /> </td></tr>
 
        <?php
	
		 foreach ($lab_invent as $campo => $valor) {
				      
		    echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
				
		}?>
        
      </form>    
        
	        <?php	
		    } // fin del while
			?> 
      </table>
	 <?php		
   } //isset($_GET['lab']) && isset($_GET['mod'])

  }

} //fin del if-else si en inventario general



?>
<br/>
<br/>
</div>