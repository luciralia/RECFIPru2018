
<?php
// version que no toma equipoexperimentaL PARA VER
require_once('../conexion.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/inventario.class.php');
require_once('../clases/log.class.php');


$logger=new Log();

$lab = new laboratorios();
$madq = new inventario();


$logger->putLog(7,2);

$bandera1=0;
/*echo'datos en cargaInv';
print_r($_SESSION);*/

if ($_GET['mod']=='invg' ){
	
	 $action1="../view/inicio.html.php?lab=".$_GET['lab'] ."&mod=". $_GET['mod']."&div=". $_SESSION['id_div']?>


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
          <option value="orden" <?php echo $sel=(!isset($_GET['orden'])||$_GET['orden']=='orden') ? 'selected="selected"':''; ?>>Seleccione...         </option>
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
	
          if($_GET['lab']!=NULL && ($_GET['mod']=='invg' || $_SESSION['tipo_usuario']!=10)
           ){

               
                     $query= "select  e.*, l.nombre as laboratorio, bi.*,* 
                              from dispositivo e 
                              left join cat_dispositivo cd
                              on e.dispositivo_clave=cd.dispositivo_clave
                              left join cat_familia cf
                              on e.familia_clave=cf.id_familia
                              left join cat_tipo_ram ctr
                              on e.tipo_ram_clave=ctr.id_tipo_ram
                              left join cat_tecnologia ct
                              on e.tecnologia_clave=ct.id_tecnologia
                              left join cat_sist_oper cso
							  on  e.sist_oper=cso.id_sist_oper
							  left join cat_usuario_final cuf
			                  on cuf.usuario_final_clave=e.usuario_final_clave
                              left join cat_marca cm
                              on cm.id_marca=e.id_marca
                              left join cat_memoria_ram cmr
                              on e.id_mem_ram=cmr.id_mem_ram
                              left join bienes_inventario bi
                              on  e.bn_id = bi.bn_id
                              left join laboratorios l
                              on  l.id_lab=e.id_lab
                              where l.id_lab=";
                       
                      
  
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
        
               $query= "select  e.*, l.nombre as laboratorio, bi.*,* 
               from dispositivo e 
               left join cat_dispositivo cd
               on e.dispositivo_clave=cd.dispositivo_clave
               left join cat_familia cf
               on e.familia_clave=cf.id_familia
               left join cat_tipo_ram ctr
               on e.tipo_ram_clave=ctr.id_tipo_ram
               left join cat_tecnologia ct
               on e.tecnologia_clave=ct.id_tecnologia
               left join cat_sist_oper cso
               on  e.sist_oper=cso.id_sist_oper
			   left join cat_usuario_final cuf
			   on cuf.usuario_final_clave=e.usuario_final_clave
               left join cat_marca cm
               on cm.id_marca=e.id_marca
               left join cat_memoria_ram cmr
               on e.id_mem_ram=cmr.id_mem_ram
               left join bienes_inventario bi
               on  e.bn_id = bi.bn_id
               left join laboratorios l
               on  l.id_lab=e.id_lab
               left join departamentos dp
               on dp.id_dep=l.id_dep
               where id_div=";
             
               

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
  // echo 'consulta';
  //echo $query;
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
          <?php $action="../inc/exportainvDGTyC.inc.php";?>
         
              <form action=<?php  echo $action; ?> method="post" name="expDGTyC" >
	          <input name="enviar" type="submit" value="DGTyC" />
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
    

     $action1="../view/inicio.html.php?lab=".$_GET['lab'] ."&mod=". $_GET['mod'];
 
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
		
       
            if ( $inventario!=0) { 
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
	 //print_r ($lab_invent); 
		?>
        
 <?php  if (($_SESSION['tipo_usuario']!=10)) {
        $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=". $_SESSION['id_div'];?>
      <!--
      <form action="<?php echo $action; ?>" method="post" name="edi_inv_<?php echo $form=$lab_invent['id_lab'] ."_".$lab_invent['bn_id']; 
	  ?>">

            <tr ><td style="text-align: right" colspan="11"><input name="accion" type="submit" value="editarG" />   </td></tr>
 
 <?php 

		foreach ($lab_invent as $campo => $valor) {
			echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
			
		}
		
		 ?>
         </form>
        -->
       <?php      
            }//fin if equipoc	para boton de editar	
	?>
          
   <table>

     <?php  } else {
	 $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=". $_SESSION['id_div'];
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
{ //&& $_SESSION['tipo_usuario']!=10

if ( $_SESSION['id_div']==NULL)
	     $_SESSION['id_div']=$_REQUEST['div'];
		 
		 
	if($_GET['lab']!=NULL ){
    if ($_SESSION['tipo_lab']!='e' && $_GET['mod']=='invc' ){
	
	    $tabla="dispositivo";
		$query= "select  e.*, l.nombre as laboratorio, bi.*,* 
                 from " . $tabla . " e 

                 left join cat_dispositivo cd
                 on e.dispositivo_clave=cd.dispositivo_clave
                 left join cat_familia cf
                 on e.familia_clave=cf.id_familia
                 left join cat_tipo_ram ctr
                 on e.tipo_ram_clave=ctr.id_tipo_ram
                 left join cat_tecnologia ct
                 on e.tecnologia_clave=ct.id_tecnologia
                 left join cat_sist_oper cso
                 on  e.sist_oper=cso.id_sist_oper
				 left join cat_usuario_final cuf
			     on cuf.usuario_final_clave=e.usuario_final_clave
                 left join cat_marca cm
                 on cm.id_marca=e.id_marca
                 left join cat_memoria_ram cmr
                 on e.id_mem_ram=cmr.id_mem_ram
                 left join bienes_inventario bi
                 on  e.bn_id = bi.bn_id
                 join laboratorios l
                 on  l.id_lab=e.id_lab
                 where l.id_lab=";}
                 elseif ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='invc' )
                        {$tabla="dispositivo";
			             $query= "select  e.*, l.nombre as laboratorio, bi.*,* 
                          from " . $tabla . " e 

                          left join cat_dispositivo cd
                          on e.dispositivo_clave=cd.dispositivo_clave
                          left join cat_familia cf
                          on e.familia_clave=cf.id_familia
                          left join cat_tipo_ram ctr
                          on e.tipo_ram_clave=ctr.id_tipo_ram
                          left join cat_tecnologia ct
                          on e.tecnologia_clave=ct.id_tecnologia
                          left join cat_sist_oper cso
                          on  e.sist_oper=cso.id_sist_oper
						  left join cat_usuario_final cuf
			              on cuf.usuario_final_clave=e.usuario_final_clave
                          left join cat_marca cm
                          on cm.id_marca=e.id_marca
                          left join cat_memoria_ram cmr
                          on e.id_mem_ram=cmr.id_mem_ram
                          left join bienes_inventario bi
                          on  e.bn_id = bi.bn_id
                          join laboratorios l
                          on  l.id_lab=e.id_lab
                          where l.id_lab=";}
                        else 
                             { $tabla="equipo";
			                   $query= "select  e.*, l.nombre as laboratorio, bi.*,* 
                               from " . $tabla . " e 

                               left join bienes_inventario bi
                               on  e.bn_id = bi.bn_id
                               join laboratorios l
                               on  l.id_lab=e.id_lab
                               where l.id_lab=";} 

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
	         $tabla="dispositivo";
		     $query= "select  e.*, l.nombre as laboratorio, bi.*,* 
                      from " . $tabla . " e 

                      left join cat_dispositivo cd
                      on e.dispositivo_clave=cd.dispositivo_clave
                      left join cat_familia cf
                      on e.familia_clave=cf.id_familia
                      left join cat_tipo_ram ctr
                      on e.tipo_ram_clave=ctr.id_tipo_ram
                      left join cat_tecnologia ct
                      on e.tecnologia_clave=ct.id_tecnologia
                      left join cat_sist_oper cso
                      on  e.sist_oper=cso.id_sist_oper
					  left join cat_usuario_final cuf
			          on cuf.usuario_final_clave=e.usuario_final_clave
                      left join cat_marca cm
                      on cm.id_marca=e.id_marca
                      left join cat_memoria_ram cmr
                      on e.id_mem_ram=cmr.id_mem_ram
                      left join bienes_inventario bi
                      on  e.bn_id = bi.bn_id
                      left join laboratorios l
                      on  l.id_lab=e.id_lab
                      left join departamentos dp
                      on dp.id_dep=l.id_dep
                      where id_div=";}
                          elseif ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='invc' )
                                 {$tabla= "dispositivo";
			                      $query= "select  e.*, l.nombre as laboratorio, bi.*,* 
                                           from " . $tabla . " e 

                                           left join cat_dispositivo cd
                                           on e.dispositivo_clave=cd.dispositivo_clave
                                           left join cat_familia cf
                                           on e.familia_clave=cf.id_familia
                                           left join cat_tipo_ram ctr
                                           on e.tipo_ram_clave=ctr.id_tipo_ram
                                           left join cat_tecnologia ct
                                           on e.tecnologia_clave=ct.id_tecnologia
										   left join cat_usuario_final cuf
			                               on cuf.usuario_final_clave=e.usuario_final_clave
                                           left join cat_sist_oper cso
                                           on  e.sist_oper=cso.id_sist_oper
                                           left join cat_marca cm
                                           on cm.id_marca=e.id_marca
                                           left join cat_memoria_ram cmr
                                           on e.id_mem_ram=cmr.id_mem_ram
                                           left join bienes_inventario bi
                                           on  e.bn_id = bi.bn_id
                                           left join laboratorios l
                                           on  l.id_lab=e.id_lab
                                           left join departamentos dp
                                            on dp.id_dep=l.id_dep
                                           where id_div=";}
                               

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
	  
	//echo 'el query es inv';
	//echo  $query;
	  
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); //lHH

//echo $query . "</br>"; 
//print_r($_REQUEST);
//print_r($_SESSION);
/*si y solo si hay registros muestra*/

if ($inventario!=0) { ?>
   
<?php $action1="../view/inicio.html.php?lab=".$_GET['lab'] ."&mod=". $_GET['mod']."&div=". $_SESSION['id_div']?>
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



 <!--
<table>
<tr><td>-->

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
	 // fin de eauipos existentes
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
	      
         if ($inventario!=0) { ?>
         
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
      <?php //echo $form=$lab_invent['id_lab'] ."_".$lab_invent['id_equipo'];?>
      
      <?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=". $_SESSION['id_div'];?>
      
      <form action="<?php echo $action; ?>" method="post" name="edi_inv_<?php echo $form=$lab_invent['id_lab'] ."_".$lab_invent['bn_id']; ?>">
 
            <tr><td style="text-align: right" colspan="11"><input name="accion" type="submit" value="editar" /> </td></tr>
 
 <?php 
 print_r($_GET);
 ?>

 	<?php
	
		foreach ($lab_invent as $campo => $valor) {
				        //echo "\$usuario[$campo] => $valor.\n" . "</br>";
		    echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
				
		}?>
        
      </form>    
        
	        <?php	
		
			} // fin del while?> 
      </table>
	 <?php		
 } //isset($_GET['lab']) && isset($_GET['mod'])

?>

 <!-- </table> -->   
 <?php 
 	
 }

} //fin del if-else si en inventario general



?>
<br/>
<br/>
</div>