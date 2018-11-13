
<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/inventario.class.php');
require_once('../clases/log.class.php');


$logger=new Log();
$obj_cotiza = new Cotiza();
$lab = new laboratorios();
$madq = new inventario();

$logger->putLog(7,2);
      
//if($_SESSION['tipo_usuario']!=130 ){   } 
//else { $action2="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']  .'&orden='. $_REQUEST['orden'];?>  

<!--
    <div style="text-align: center"> <div id="botonblu" > <a href="<?php //echo $action2 . '&accion="caRGAR";'?>">Usuario 1/9</a></div></div>  // 7/sept-->
   
<?php 
//}
$bandera1=0;

if ($_GET['mod']=='invg' ){

$listatablas= array("equipo","equipoc");



for ($x=0;$x<count($listatablas);$x++)
{
	
    $query = "select e.*, l.nombre as laboratorio, bi.* 
         from ".$listatablas[$x]." e, bienes_inventario bi, laboratorios l
         where e.bn_id = bi.bn_id
         and l.id_lab=e.id_lab
         and e.id_lab=";

            switch ($_GET['orden']){
 			case "descripcion":
			$query.= $_GET['lab'] . "ORDER BY bi.bn_desc ASC";
			break;
 			case "clave":
			$query.= $_GET['lab'] . "ORDER BY bi.bn_clave ASC";
			break;
			case "marca":
			$query.= $_GET['lab'] . "ORDER BY bi.bn_marca ASC";
			break;
 			default:
			$query.= $_GET['lab'] . "ORDER BY e.fecha DESC";
	    	break;
			
        } // fin de switch

$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); //lHH

if ($inventario!=0 && $bandera1==0 ) { 
 $bandera1=1;  
}
if ($inventario!=0)
{
	
 $action1="../view/inicio.html.php?lab=".$_GET['lab'] ."&mod=". $_GET['mod'].'&orden='. $_REQUEST['orden'];?>
<!-- <form action="<?php echo $action1; ?>" method="post" name="fbusqueda">
<p style="text-align: right"> <input name="accion" type="submit" value="buscar" id="botonblu"/>
</form>-->

<?php
 if ($cont==0){ ?>
<tr><td>
<div style="text-align: right"> <div id="botonblu" > <a href="<?php echo $action1 . '&accion=buscarg';?>">BúsquedaG</a></div></div>
<br/>
<br/>

<div class="block" id="necesidades_content">      
</td>
</tr>

<td></td>
<td></td>
<?php
 }
?>
<tr><td>

<?php
$cont=1;
?>
<form action="inicio.html.php" method="get" name="orderby">
        Ordenar por carga: <select name="orden">
          <option value="orden" <?php echo $sel=(!isset($_GET['orden'])||$_GET['orden']=='orden') ? 'selected="selected"':''; ?>>Seleccione...</option>
          <option value="descripcion" <?php echo $sel=($_GET['orden']=='descripcion')? 'selected="selected"': "";?>>Descripción</option>
          <option value="clave" <?php echo $sel=($_GET['orden']=='clave')? 'selected="selected"': "";?>>No. Inventario</option>
          <option value="marca" <?php echo $sel=($_GET['orden']=='marca')? 'selected="selected"': "";?>>Marca</option>
           </select>
    
<?php

	echo "<input name='lab' type='hidden' value='". $_GET['lab']."' /> \n";
	echo "<input name='mod' type='hidden' value='".$_GET['mod']."' /> \n";
	
		?>

<input name="bOrden" type="submit" value="ordenar" />
</form>
</td> 
<td>

      <?php	

      //Únicamente el inventario de equipo experimental 
  
		if($listatablas[$x]=='equipo') {
		    $tipotabla=$listatablas[$x];
		    $action="../inc/exportaxls_inv.inc.php";
             
		  ?>
              <form action=<?php echo $action; ?> method="post" name="servbit" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	          <input name="enviar" type="submit" value="Exportar a excelExp" />
	          <input name="lab" type="hidden" value="<?php echo $_GET['lab'] ?>" />
	          <input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
              <input name="tabla" type="hidden" value="<?php echo $tipotabla ?>" />
	          </form>
 
        <?php }  

       if($listatablas[$x]=='equipoc') {
		
		    $action="../inc/exportaxls_inv.inc.php";
             			
		 ?>
              <form action=<?php echo $action; ?> method="post" name="servbit" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	          <input name="enviar" type="submit" value="Exportar a excelComp" />
	          <input name="lab" type="hidden" value="<?php echo $_GET['lab'] ?>" />
	          <input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
              <input name="tabla" type="hidden" value="<?php echo $listatablas[$x] ?>" />
	          </form>
 
     <?php }  ?>

</td> 
</tr>

 <?php

}
 
if (isset($_GET['lab']) && isset($_GET['mod']))
 { ?>
      <!--<tr><td>&nbsp;</td><td>&nbsp;</td></tr>-->
  
          <?php 
		  
		  if ($listatablas[$x]=='equipo'){
			  $titulo=' experimental ';}
		   else {
			   $titulo=' de cómputo ';}
		   
          if ($inventario!=0 ) {
			   
           // para poner titulo del inventario, si hay tuplas
		   
		   ?>		   	  

   <tr>
      <td align="center"><h2>Inventario de equipo <?php echo $titulo;?> </h2></td>
   </tr>
   
   <!--<tr><td>&nbsp;</td><td>&nbsp;</td></tr>-->
  

  
 <?php  }// para exhibir letrero y botón de búsqueda
 
 
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		 
		
		 if ($listatablas[$x]=='equipo' && $inventario!=0 && $lab_invent['bn_notas']=='EQUIPO' ) { ?>
         
          <table class='material'>
		 <tr>
              <th  scope="col">No. Inventario</th>
              <th  scope="col">No. Inventario del Área</th>
              <th  scope="col">Descripción del equipo</th>
              <th  scope="col">Marca</th>
              <th  scope="col">Modelo</th>
              <th  scope="col">Serie</th>
         </tr>
   
            <tr>
               <td  scope="col"><?php echo $lab_invent['bn_clave'];?></td>
               <td  scope="col"><?php echo $lab_invent['inventario'];?></td>
               <td  scope="col"><?php echo $lab_invent['bien'];?></td>
               <td  scope="col"><?php echo $lab_invent['marca'];?></td>
               <td  scope="col"><?php echo $lab_invent['modelo'];?></td>
               <td  scope="col"><?php echo $lab_invent['serie'];?></td>
            </tr>
    
   
   <?php } elseif ($listatablas[$x]=='equipoc' && $inventario!=0 && $lab_invent['bn_notas']=='COMPUTO' ) {   
       //if ?>
   
            <table class='material'>
           <tr>
               <th scope="col">No. Inventario</th>
               <th scope="col">No. Inventario del área</th>
               <th scope="col">Descripción del equipo</th>
               <th scope="col">Marca</th>
               <th scope="col">Modelo</th>
               <th scope="col">Serie</th>
               <th scope="col">Procesador</th>
               <th scope="col">Número de  Procesadores</th>
               <th scope="col">Velocidad</th>
               <th scope="col"><font color="blue">Servidor</font></th>
               <th scope="col">Arquitectura</th>
           </tr>
          <tr>
                  <td scope="col"><?php echo $lab_invent['bn_clave'];?></td>
                  <td scope="col"><?php echo $lab_invent['inventario'];?></td>
                  <td scope="col"><?php echo $lab_invent['bien'];?></td>
                  <td scope="col"><?php echo $lab_invent['marca'];?></td>
                  <td scope="col"><?php echo $lab_invent['modelo'];?></td>
                  <td  scope="col"><?php echo $lab_invent['serie'];?></td>
                  <td scope="col"><?php echo $lab_invent['procesador'];?></td>
                  <td scope="col"><?php echo $lab_invent['noprocesadores'];?></td>
                  <td scope="col"><?php echo $lab_invent['velocidad'];?></td>
                  <td scope="col"><font color="blue"><?php echo $etiqServidor;?></font></td>
                  <td scope="col"><?php echo $lab_invent['arquitectura'];?></td>
           </tr>
   
           <tr>
               <th scope="col">Sistema Operativo</th>
               <th scope="col">Tipo de memoria</th>
               <th scope="col">Cantidad de memoria</th>
               <th scope="col">Tipo tarjeta video</th>
               <th scope="col">Modelo tarjeta video</th>
               <th scope="col">Memoria video</th>
               <th scope="col">Número de discos</th>
               <th scope="col">Capacidad de disco</th>
               <th scope="col">Tipo de interfaz</th>
               <th scope="col">Tipo Disco Duro</th>
               <th scope="col">Equipo Alto Rendimiento</th>    
             </tr>
            
             <tr>   
                  <td scope="col"><?php echo $lab_invent['so'];?></td>
                  <td scope="col"><?php echo $lab_invent['tipomemoria'];?></td>
                  <td scope="col"><?php echo $lab_invent['cantmemoria'];?></td>
                  <td scope="col"><?php echo $lab_invent['tipotarjvideo'];?></td>
                  <td scope="col"><?php echo $lab_invent['modelotarjvideo'];?></td>
                  <td scope="col"><?php echo $lab_invent['memoriavideo'];?></td>
                  <td scope="col"><?php echo $lab_invent['nodiscos'];?></td>
                  <td scope="col"><?php echo $lab_invent['capdisco'];?></td>
                  <td scope="col"><?php echo $lab_invent['tipointerfaz'];?></td>
                  <td scope="col"><?php echo $lab_invent['tipodd'];?></td>
                  <td scope="col"><?php echo $lab_invent['equipoaltorend'];?></td>
          </tr>
         
          
   <?php  } //fin elseif 
		 ?>
<?php
	    foreach ($lab_invent as $campo => $valor) {
				       
		    echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
				
		} // fin foreach
	 //print_r ($lab_invent); 
		?>
        
 <?php  if ($listatablas[$x]=='equipoc' && $lab_invent['bn_notas']=='COMPUTO' ){

 ?>
      <?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'];?>
      
      <form action="<?php echo $action; ?>" method="post" name="edi_inv_<?php echo $form=$lab_invent['id_lab'] ."_".$lab_invent['bn_id']; 
	  ?>">

            <tr ><td style="text-align: right" colspan="11"><input name="accion" type="submit" value="editar" />   </td></tr>
 
 <?php 

		foreach ($lab_invent as $campo => $valor) {
			echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
			//print_r ($lab_invent);	
		}
		//echo 'sale de cargainvent';
		//print_r($lab_invent);
		 ?>
         </form>
        
    <?php      
	} //fin if equipoc	para boton de editar	
		?>
          
    <table>

     <?php   
		 
   
     } //isset($_GET['lab']) && isset($_GET['mod']) ?>
     
  <?php   
  } // while
 
 
?>

<?php 
} // fin del for que recorre cada inventarios experimental y cómputo

?>

<?php


} 
// fin del inventario general
else 
{
  if ($_SESSION['tipo_lab']!='e' && $_GET['mod']=='invc' )	
             {$tabla="equipoc";}
           elseif ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='invc' )
             {$tabla="equipoc";}
             else 
               {$tabla="equipo";} 
			   

$inventario=0;
$query = "select e.*, l.nombre as laboratorio, bi.* 
from equipoc e 
left join bienes_inventario bi
on  e.bn_id = bi.bn_id
left join laboratorios l
on  l.id_lab=e.id_lab
where  e.id_lab=";

/*
$query = "select e.*, l.nombre as laboratorio, bi.* 
         from ".$tabla." e, bienes_inventario bi, laboratorios l
         where e.bn_id = bi.bn_id
         and l.id_lab=e.id_lab
         and e.id_lab=";
*/


switch ($_GET['orden']){
 			case "descripcion":
			$query.= $_GET['lab'] . "ORDER BY bi.bn_desc ASC";
			//$query = "order by bn_desc asc";
//			return $query;
 			break;
 			case "clave":
			$query.= $_GET['lab'] . "ORDER BY bi.bn_clave ASC";
			//$query = "order by bn_clave asc";
 			break;
			case "marca":
			$query.= $_GET['lab'] . "ORDER BY bi.bn_marca ASC";
			//$query=  "order by bn_marca asc";
 			break;
 			default:
			$query.= $_GET['lab'] . "ORDER BY e.fecha DESC";
			//$query =  "order by e.fecha asc";
	//		return $query;
 			break;
}

$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); //lHH

// echo $query . "</br>"; 
// print_r($_REQUEST);

/*si y solo si hay registros muestra*/

if ($inventario!=0) { ?>
   
<?php $action1="../view/inicio.html.php?lab=".$_GET['lab'] ."&mod=". $_GET['mod'].'&orden='. $_REQUEST['orden'];?>
<!-- <form action="<?php echo $action1; ?>" method="post" name="fbusqueda">
<p style="text-align: right"> <input name="accion" type="submit" value="buscar" id="botonblu"/>
</form>-->

<div style="text-align: right"> <div id="botonblu" > <a href="<?php echo $action1 . '&accion=buscar';?>">Búsqueda</a></div></div>

<div class="block" id="necesidades_content">      

 <?php //echo "Responsable: " . $lab->getResponsable($_SESSION['id_usuario']); ?>

 
<table>
<tr><td>

<form action="inicio.html.php" method="get" name="orderby">
        Ordenar por: <select name="orden">
          <option value="orden" <?php echo $sel=(!isset($_GET['orden'])||$_GET['orden']=='orden') ? 'selected="selected"':''; ?>>Seleccione...</option>
          <option value="descripcion" <?php echo $sel=($_GET['orden']=='descripcion')? 'selected="selected"': "";?>>Descripción</option>
          <option value="clave" <?php echo $sel=($_GET['orden']=='clave')? 'selected="selected"': "";?>>No. Inventario</option>
          <option value="marca" <?php echo $sel=($_GET['orden']=='marca')? 'selected="selected"': "";?>>Marca</option>
           </select>
    
<?php

	echo "<input name='lab' type='hidden' value='". $_GET['lab']."' /> \n";
	echo "<input name='mod' type='hidden' value='".$_GET['mod']."' /> \n";
	
		?>

<input name="bOrden" type="submit" value="ordenar" />
</form>

</td>
<td>
  
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
            
              <form action=<?php echo $action; ?> method="post" name="servbit" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	          <input name="enviar" type="submit" value="Exportar a Eexcel" />
	          <input name="lab" type="hidden" value="<?php echo $_GET['lab'] ?>" />
	          <input name="mod" type="hidden" value="<?php echo $_GET['mod'] ?>" />
	          </form>

     <?php } // if(inventario ==0 )?>
 
   </td>
   </tr>
   
</table> 
    

<br/>
<br/>
  
<?php

if (isset($_GET['lab']) && isset($_GET['mod']))
 { 
 
  $bandera=0;
 

		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ 
		
		 
		if ((integer)$lab_invent['servidor']==1)
		 {$etiqServidor='Si';}
		 else 
		 { $etiqServidor='No';} 
	      
         if ($inventario!=0) { ?>
         
		<table class='material'>
         
		 <?php
		 if ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='inv' && $lab_invent['bn_notas']=='EQUIPO') { ?>
         
		 <tr>
              <th  scope="col">No. Inventario</th>
              <th  scope="col">No. Inventario del Área</th>
              <th  scope="col">Descripción del equipo</th>
              <th  scope="col">Marca</th>
              <th  scope="col">Modelo</th>
              <th  scope="col">Serie</th>
        </tr>
          	
			<?php
			
			$bandera=1;
			
			} elseif ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='invc' ) { ?>
            
			<tr>
               <th scope="col">No. Inventario</th>
               <th scope="col">No. Inventario Anterior</th>
               <th scope="col">Descripción del equipo</th>
               <th scope="col">Marca</th>
               <th scope="col">Modelo</th>
               <th scope="col">Serie</th>
               <th scope="col">Procesador</th>
               <th scope="col">Número de  Procesadores</th>
               <th scope="col">Velocidad</th>
               <th scope="col"><font color="blue">Servidor</font></th>
               <th scope="col">Arquitectura</th>
           </tr>
       
     <?php     
    
	 }elseif ($_SESSION['tipo_lab']!='e' && $_GET['mod']=='invc') {   ?>
        
         <tr>
               <th scope="col">No. Inventario</th>
               <th scope="col">No. Inventario del Área</th>
               <th scope="col">Descripción del equipo</th>
               <th scope="col">Marca</th>
               <th scope="col">Modelo</th>
               <th scope="col">Serie</th>
               <th scope="col">Procesador</th>
               <th scope="col">Número de  Procesadores</th>
               <th scope="col">Velocidad</th>
               <th scope="col"><font color="blue">Servidor</font></th>
               <th scope="col">Arquitectura</th>
           </tr>
           
         
  <?php } //fin elseif ?> 

<?php } //fin de si y solo hay registros 

	      if ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='inv' && $lab_invent['bn_notas']=='EQUIPO') { ?>
          
          <tr>
               <td  scope="col"><?php echo $lab_invent['bn_clave'];?></td>
               <td  scope="col"><?php echo $lab_invent['inventario'];?></td>
               <td  scope="col"><?php echo $lab_invent['bien'];?></td>
               <td  scope="col"><?php echo $lab_invent['marca'];?></td>
               <td  scope="col"><?php echo $lab_invent['modelo'];?></td>
               <td  scope="col"><?php echo $lab_invent['serie'];?></td>
         </tr>
          
          <?php
		    
           $bandera=1;
		   
			} elseif ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='invc' ) { ?>
           
           <tr>
                  <td scope="col"><?php echo $lab_invent['bn_clave'];?></td>
                  <td scope="col"><?php echo $lab_invent['inventario'];?></td>
                  <td scope="col"><?php echo $lab_invent['bien'];?></td>
                  <td scope="col"><?php echo $lab_invent['marca'];?></td>
                  <td scope="col"><?php echo $lab_invent['modelo'];?></td>
                  <td scope="col"><?php echo $lab_invent['serie'];?></td>
                  <td scope="col"><?php echo $lab_invent['procesador'];?></td>
                  <td scope="col"><?php echo $lab_invent['noprocesadores'];?></td>
                  <td scope="col"><?php echo $lab_invent['velocidad'];?></td>
                  <td scope="col"><font color="blue"><?php echo $etiqServidor;?></font></td>
                  <td scope="col"><?php echo $lab_invent['arquitectura'];?></td>
         </tr>
         
         <?php     
         }  elseif ($_SESSION['tipo_lab']!='e' &&  $_GET['mod']=='invc' ) {   ?>
           
           <tr>
                  <td scope="col"><?php echo $lab_invent['bn_clave'];?></td>
                  <td scope="col"><?php echo $lab_invent['inventario'];?></td>
                  <td scope="col"><?php echo $lab_invent['bien'];?></td>
                  <td scope="col"><?php echo $lab_invent['marca'];?></td>
                  <td scope="col"><?php echo $lab_invent['modelo'];?></td>
                  <td scope="col"><?php echo $lab_invent['serie'];?></td>
                  <td scope="col"><?php echo $lab_invent['procesador'];?></td>
                  <td scope="col"><?php echo $lab_invent['noprocesadores'];?></td>
                  <td scope="col"><?php echo $lab_invent['velocidad'];?></td>
                  <td scope="col"><font color="blue"><?php echo $etiqServidor;?></font></td>
                  <td scope="col"><?php echo $lab_invent['arquitectura'];?></td>
           </tr>
           
         <?php } //fin elseif ?> 

<?php  if (($_SESSION['tipo_lab']=='e' && $bandera==0) && $_GET['mod']=='inv' && $lab_invent['bn_notas']=='EQUIPO' ) { ?>
         
		 <tr>
              <th  scope="col">No. Inventario</th>
              <th  scope="col">No. Inventario del Área</th>
              <th  scope="col">Descripción del equipo</th>
              <th  scope="col">Marca</th>
              <th  scope="col">Modelo</th>
              <th  scope="col">Serie</th>
          </tr>
          
          	<?php 
        }elseif ($_SESSION['tipo_lab']=='e'  && $_GET['mod']=='invc' ) { ?>
        
           <tr>
               <th scope="col">Sistema Operativo</th>
               <th scope="col">Tipo de memoria</th>
               <th scope="col">Cantidad de memoria</th>
               <th scope="col">Tipo tarjeta video</th>
               <th scope="col">Modelo tarjeta video</th>
               <th scope="col">Memoria video</th>
               <th scope="col">Número de discos</th>
               <th scope="col">Capacidad de disco</th>
               <th scope="col">Tipo de interfaz</th>
               <th scope="col">Tipo Disco Duro</th>
               <th scope="col">Equipo Alto Rendimiento</th>
               
           </tr>
           
     <?php     
			
			}elseif ($_SESSION['tipo_lab']!='e' && $_GET['mod']=='invc' ) {   ?>
           
           <tr>
               <th scope="col">Sistema Operativo</th>
               <th scope="col">Tipo de memoria</th>
               <th scope="col">Cantidad de memoria</th>
               <th scope="col">Tipo tarjeta video</th>
               <th scope="col">Modelo tarjeta video</th>
               <th scope="col">Memoria video</th>
               <th scope="col">Número de discos</th>
               <th scope="col">Capacidad de disco</th>
               <th scope="col">Tipo de interfaz</th>
               <th scope="col">Tipo Disco Duro</th>
               <th scope="col">Equipo Alto Rendimiento</th>
           </tr>
           
         
  <?php } //fin elseif ?> 
<?php 
if ($_SESSION['tipo_lab']=='e' && $bandera==0 && $_GET['mod']=='inv' && $lab_invent['bn_notas']=='EQUIPO') { ?>
          
          <tr>
               <td  scope="col"><?php echo $lab_invent['bn_clave'];?></td>
               <td  scope="col"><?php echo $lab_invent['inventario'];?></td>
               <td  scope="col"><?php echo $lab_invent['bien'];?></td>
               <td  scope="col"><?php echo $lab_invent['marca'];?></td>
               <td  scope="col"><?php echo $lab_invent['modelo'];?></td>
               <td  scope="col"><?php echo $lab_invent['serie'];?></td>
           </tr>
          
          <?php
			
			} elseif ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='invc' ) { ?>
           
           <tr>
                  <td scope="col"><?php echo $lab_invent['so'];?></td>
                  <td scope="col"><?php echo $lab_invent['tipomemoria'];?></td>
                  <td scope="col"><?php echo $lab_invent['cantmemoria'];?></td>
                  <td scope="col"><?php echo $lab_invent['tipotarjvideo'];?></td>
                  <td scope="col"><?php echo $lab_invent['modelotarjvideo'];?></td>
                  <td scope="col"><?php echo $lab_invent['memoriavideo'];?></td>
                  <td scope="col"><?php echo $lab_invent['nodiscos'];?></td>
                  <td scope="col"><?php echo $lab_invent['capdisco'];?></td>
                  <td scope="col"><?php echo $lab_invent['tipointerfaz'];?></td>
                  <td scope="col"><?php echo $lab_invent['tipodd'];?></td>
                  <td scope="col"><?php echo $lab_invent['equipoaltorend'];?></td>
         
         </tr>
         
         <?php   
			
			
			}elseif ($_SESSION['tipo_lab']!='e' && $_GET['mod']=='invc' ) {   ?>
            
           <tr>   
                  <td scope="col"><?php echo $lab_invent['so'];?></td>
                  <td scope="col"><?php echo $lab_invent['tipomemoria'];?></td>
                  <td scope="col"><?php echo $lab_invent['cantmemoria'];?></td>
                  <td scope="col"><?php echo $lab_invent['tipotarjvideo'];?></td>
                  <td scope="col"><?php echo $lab_invent['modelotarjvideo'];?></td>
                  <td scope="col"><?php echo $lab_invent['memoriavideo'];?></td>
                  <td scope="col"><?php echo $lab_invent['nodiscos'];?></td>
                  <td scope="col"><?php echo $lab_invent['capdisco'];?></td>
                  <td scope="col"><?php echo $lab_invent['tipointerfaz'];?></td>
                  <td scope="col"><?php echo $lab_invent['tipodd'];?></td>
                  <td scope="col"><?php echo $lab_invent['equipoaltorend'];?></td>
          </tr>
         
  <?php } //fin elseif ?> 


        <?php
		
         foreach ($lab_invent as $campo => $valor) {
             // echo "\$usuario[$campo] => $valor.\n" . "</br>";
              echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";

         }?>

 <?php  if (($_SESSION['tipo_lab']=='c' || $_SESSION['tipo_lab']=='o' || $_SESSION['tipo_lab']=='e' || $_SESSION['tipo_lab']=='u'||$_SESSION['tipo_lab']=='s' ||$_SESSION['tipo_lab']=='a') && $_GET['mod']=='invc' ){

 ?>
      <?php //echo $form=$lab_invent['id_lab'] ."_".$lab_invent['id_equipo'];?>
      <?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'];?>
      
      <form action="<?php echo $action; ?>" method="post" name="edi_inv_<?php echo $form=$lab_invent['id_lab'] ."_".$lab_invent['bn_id']; ?>">
 
            <tr><td style="text-align: right" colspan="11"><input name="accion" type="submit" value="editar" /> </td></tr>
 
 <?php 

 ?>

 
 	<?php
	
		foreach ($lab_invent as $campo => $valor) {
				        //echo "\$usuario[$campo] => $valor.\n" . "</br>";
		    echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
				
		}?>
        
      </form>    
        
	        <?php	
		
			} // fin del while?> 
	 <?php		
 } //isset($_GET['lab']) && isset($_GET['mod'])

?>
</table>
 <?php 
 	
 }
}// fin del if-else

?>
<br/>
<br/>
</div>