
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php  
require_once('../conexion.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/inventario.class.php');

$obj_inv = new Inventario();
$madq = new Inventario();
$division= new laboratorios();

if ($_SESSION['tipo_usuario']==1){

	    //obtener el departamento 
	
        $querydepto="SELECT DISTINCT l.id_dep from laboratorios l
                     JOIN usuarios u
				     ON l.id_responsable=u.id_usuario
                     WHERE l.id_responsable=" .$_SESSION['id_usuario'];
        $datosdepto=pg_query($con,$querydepto);

        $depto = pg_fetch_array($datosdepto);
        $_SESSION['id_dep']=$depto[0];
   
        //obtener division
         $querydiv="SELECT DISTINCT dv.id_div from laboratorios l 
                    JOIN departamentos d
                    ON l.id_dep=d.id_dep
                    JOIN divisiones dv
                    ON dv.id_div=d.id_div
                    JOIN usuarios u
		            ON l.id_responsable=u.id_usuario
                    WHERE l.id_responsable=" .$_SESSION['id_usuario'];
         $datosdiv=pg_query($con,$querydiv);
         $div = pg_fetch_array($datosdiv);
         $_SESSION['id_div']=$div[0];
      }


	if ( $_SESSION['id_div']==NULL)
	     $_SESSION['id_div']=$_REQUEST['div'];
/*
echo 'en buscarcambio REQUEST';
print_r($_REQUEST);*/

if($_REQUEST['bbuscar']=='Cancelar' || $_REQUEST['bbuscarg']=='Cancelar'){ 
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] .'&div='. $_SESSION['id_div']. $_REQUEST['orden'];
echo $direccion;
header($direccion);

}

?>
<div class="block" id="necesidades_content">  

<?php
if($_REQUEST['accion']=='buscar' )
{
$action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']  ."&bn_id=". $_REQUEST['bn_id'].'&div='. $_SESSION['id_div']. $_REQUEST['orden'];
?>

<form action="<?php echo $action1; ?>" method="post" name="formbusca">

        <table width="800" cellpadding="2" class="formulario">
          <tr>
            <td>Descripción:   </td>
            <td><input type="text" name="_descripcion" id="_descripcion" /></td>
            <td>No. Serie:    </td>
            <td><input type="text" name="_no_serie" id="_no_serie" /></td>
            <td>No. Inventario:      </td>
            <td><input type="text" name="_no_inv" id="_no_inv" /></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td>No. Inventario<br />
              anterior</td>
            <td><input type="text" name="_no_inv_ant" id="_no_inv_ant" /></td>
          </tr>
          <tr>
            <td>Marca: </td>
            <td><input type="text" name="_marca" id="_marca" /></td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            
            <td colspan="2" align="right">
            <input type="submit" name="bbuscar" id="Buscar" value="Buscar" />
            <input type="reset"  name="bbuscar" id="Limpiar" value="Limpiar" />
            <input type="submit" name="bbuscar" id="Cancelar" value="Cancelar" /></td>
          </tr>
        </table>
<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="bn_id" type="hidden" value="<?php echo $_GET['bn_id']; ?>" />
</form>
<br />
<br />

<?php
} // fin de buscar
?>
<br />
<br />
  <!--<div class=formulario>
  <div class="block" id="necesidades_content">-->
  <table>

<?php 


if($_REQUEST['accion']=='buscarg' )
{

 $action1="../view/inicio.html.php?mod=". $_GET['mod']  ."&bn_id=". $_REQUEST['bn_id'] ."&lab=". $_REQUEST['lab'].'&div='. $_SESSION['id_div']. '&orden='.$_REQUEST['orden'];

?>
<form action="<?php echo $action1; ?>" method="post" name="formbusca">

        <table width="800" cellpadding="2" class="formulario">
          <tr>
            <td>Descripción:   </td>
            <td><input type="text" name="_descripcion" id="_descripcion" /></td>
            <td>No. Serie:    </td>
            <td><input type="text" name="_no_serie" id="_no_serie" /></td>
            <td>No. Inventario:      </td>
            <td><input type="text" name="_no_inv" id="_no_inv" /></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td>No. Inventario<br />
              anterior</td>
            <td><input type="text" name="_no_inv_ant" id="_no_inv_ant" /></td>
          </tr>
          <tr>
            <td>Marca: </td>
            <td><input type="text" name="_marca" id="_marca" /></td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2" align="right">
           <input type="submit" name="bbuscarg" id="Buscar" value="Buscar" />
            <input type="reset"  name="bbuscarg" id="Limpiar" value="Limpiar" />
            <input type="submit" name="bbuscarg" id="Cancelar" value="Cancelar" /></td>
          </tr>
        </table>
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="bn_id" type="hidden" value="<?php echo $_GET['bn_id']; ?>" />
</form>

<?php
}
?>
<!--<br />
<br />-->


<?php 

if ($_REQUEST['_no_inv']!=''|| $_REQUEST['_descripcion']  || $_REQUEST['_no_serie']|| $_REQUEST['_marca'] || $_REQUEST['_no_inv_ant']){
	if ($_REQUEST['bbuscar']=='Buscar')   {
	
	if ( $_GET['mod']=='invc'){
		
		$query=$obj_inv->selectEquipoInvC(strtoupper($_REQUEST['_descripcion']),strtoupper($_REQUEST['_no_serie']),strtoupper($_REQUEST['_no_inv']),strtoupper($_REQUEST['_marca']),strtoupper($_REQUEST['_no_inv_ant']),$_REQUEST['lab'],$_SESSION['id_usuario']);
		
	   
	} else if ( $_GET['mod']=='inv'){
		
		$query=$obj_inv->selectEquipoInvE(strtoupper($_REQUEST['_descripcion']),strtoupper($_REQUEST['_no_serie']),strtoupper($_REQUEST['_no_inv']),strtoupper($_REQUEST['_marca']),strtoupper($_REQUEST['_no_inv_ant']),$_REQUEST['lab']);
		
	
	} 
	switch ($_GET['orden']){
 			case "descripcion":
			$query.=" order by bn_desc asc";
            break;
 			case "clave":
			$query.=" order by bn_clave asc";
 			break;
			case "marca":
			$query.=" order by bn_marca asc";
 			break;
 			default:
			$query.=" order by bi.bn_id";
	        break;

	} //fin de switch


	} // frin de bbuscar
	
	else if ($_REQUEST['bbuscarg']=='Buscar' && $_GET['lab']!='' ){
	
     // realiza la consulta del inventario general de la facultad con la finalidad de poder buscar en el inventario y asignar/desasignar disp
	$query=$obj_inv->selectEquipoGen(strtoupper($_REQUEST['_descripcion']),strtoupper($_REQUEST['_no_serie']),strtoupper($_REQUEST['_no_inv']),strtoupper($_REQUEST['_marca']),strtoupper($_REQUEST['_no_inv_ant']));
	
	switch ($_GET['orden']){
 			case "descripcion":
			$query.=" order by bn_desc asc";
            break;
 			case "clave":
			$query.=" order by bn_clave asc";
 			break;
			case "marca":
			$query.=" order by bn_marca asc";
 			break;
 			default:
			$query.=" order by bi.bn_id";
	        break;
	}
	
	
	}else if ($_REQUEST['bbuscarg']=='Buscar' && $_GET['lab']=='' ){
		
    $query=$obj_inv->selectEquipoGenDiv(strtoupper($_REQUEST['_descripcion']),strtoupper($_REQUEST['_no_serie']),strtoupper($_REQUEST['_no_inv']),  strtoupper($_REQUEST['_marca']),strtoupper($_REQUEST['_no_inv_ant']));
 
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
     $inventario= pg_num_rows($datos);
	
 /*echo 'exhibe consulta buscarinv ';
 echo $query;*/

if ( ($_GET['mod']=='invg' && $_GET['lab']!='') ){

?>

<table> 

<?php 


if ($inventario!=0){?>


<tr><td>
<div class="block" id="necesidades_content">    


<form action="../view/inicio.html.php" method="get" name="orderby">

             
			        Ordenar por: <select name="orden">
                     
			          <option value="orden" <?php echo $sel=(!isset($_GET['bn_id'])||$_GET['bn_id']=='bn_id') ? 'selected="selected"':''; ?>>Seleccione...</option>
			          <option value="descripcion" <?php echo $sel=($_GET['bn_id']=='descripcion')? 'selected="selected"': "";?>>Descripción</option>
			          <option value="clave" <?php echo $sel=($_GET['bn_id']=='clave')? 'selected="selected"': "";?>>No. Inventario</option>
			          <option value="marca" <?php echo $sel=($_GET['bn_id']=='marca')? 'selected="selected"': "";?>>Marca</option>
			           </select>
			    
			<?php
			    echo "<input name='lab' type='hidden' value='".$_GET['lab']."' /> \n";
				echo "<input name='mod' type='hidden' value='".$_GET['mod']."' /> \n";
				
			?>
			          <input name="accion" type="hidden" value="bbuscarg" />
                      <input name="bOrden" type="submit" value="ordenar" />
                     
            </form>
</td>

</tr>

  <br \>
  <br \>
  <table>
<?php

 } else { ?>
    <br \>
       <legend align="center"><h3>No se encuentran coincidencias en el inventario de la facultad.</h3></legend>
   <br \>
 <?php  
    } //if ($inventario!=0){
?>
 </table>
 <br />
 <br />
<div class="block" id="necesidades_content">
 <?php 
 
//echo "la consulta es buscarcambio..".$query;

while ($lab_invent = pg_fetch_array($datos, NULL, PGSQL_ASSOC)) 
{ 

//print_r ($lab_invent);
    if (count($lab_invent > 0 )){?>
	 
	
             <table class='material'>
             <tr>
                 <th width="20%" scope="col">No. Inventario</th>
                 <th width="20%" scope="col">No. Inventario Anterior</th>
                 <th width="20%" scope="col">Descripción del equipo</th>
                 <th width="20%" scope="col">Marca</th>
                 <th width="20%" scope="col">Modelo</th>
                 <th width="20%" scope="col">Serie</th>
             </tr>
             </table> 
             <table class='material'>   
             <tr>
                 <td width="20%" scope="col"><?php echo $lab_invent['bn_clave'];?></td>
                 <td width="20%" scope="col"><?php echo $lab_invent['bn_anterior'];?></td>
                 <td width="20%" scope="col"><?php echo $lab_invent['bn_desc'];?></td>
                 <td width="20%" scope="col"><?php echo $lab_invent['bn_marca'];?></td>
                 <td width="20%" scope="col"><?php echo $lab_invent['bn_modelo'];?></td>
                 <td width="20%" scope="col"><?php echo $lab_invent['bn_serie'];?></td>
           </tr>
           <tr>
                <td style="text-align: left" colspan="11"><strong>Asignado a: </strong>   
	              <?php echo $labasig=$obj_inv->getAsig($lab_invent['bn_id']);?>
                </td>
           </tr>
  
   
 <?php

         foreach ($lab_invent as $campo => $valor) {
          // echo "\n$lab_invent[$campo] => $valor.\n" . "</br>";
              echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";

         }?>
         
  
<form action="../inc/procesainventario.inc.php" method="post" name="procinvent">

  <tr><td style="text-align: right" colspan="11"> 

  <?php 

// para signar verifica que tenga laboratorio para asignar...

 if ($labasig=='Ninguno' && $_GET['lab'] != NULL  ){
	 //echo 'asignar';
	 if ($_SESSION['tipo_lab']=='e' &&  $_SESSION['tipo_usuario']!=10 && ($lab_invent['bn_notas']=='COMPUTO' || $lab_invent['bn_notas']=='') ) { ?>
      <input name="ecasignar" type="submit" value="Asignar" />
     <?php
	 }else if ($_SESSION['tipo_lab']!='e'  && $_SESSION['tipo_usuario']!=10 && $lab_invent['bn_notas']=='COMPUTO' || $lab_invent['bn_notas']=='') { ?>
        <input name="ecasignar" type="submit" value="Asignar" />
	 <?php 
	 }else { ?>
		 
		 
		   <font color="blue"><?php echo 'El equipo no se identifica correctamente, aún así desea:';?></font>

                   <input name="basignarc" type="submit" value="Asignar a Cómputo" /> <font color="blue"><?php //echo  ó ?> </font>
                   <!--<input name="basignare" type="submit" value="Asignar a Equipo" /> -->
	
 <?php } ?>
  <?php /*
         if ($_SESSION['tipo_lab']=='e' &&  $_SESSION['tipo_usuario']!=10) {?>
 
              <?php if ($lab_invent['bn_notas']=='EQUIPO' ) { ?>
                 <input name="basignare" type="submit" value="Asignar a Equipo" />
              
             <?php } elseif ($lab_invent['bn_notas']=='COMPUTO' ){ ?>
                    
                    <input name="ecasignar" type="submit" value="Asignar" />
                 
	        <?php  } else { ?>
			
			                <font color="blue"><?php echo 'El equipo no se identifica correctamente, aún así desea:';?></font>

                   <input name="basignarc" type="submit" value="Asignar a Cómputo" /> <font color="blue"><?php //echo  ó ?> </font>
                   <!--<input name="basignare" type="submit" value="Asignar a Equipo" /> -->
	
	       <?php } // fin del si es de equipo/cómputo u otro
		 }
		 
          
			//fin if ($_SESSION['tipo_lab']=='e' &&  $_SESSION['tipo_usuario']!=10) {
      }  if ($_SESSION['tipo_lab']!='e'  && $_SESSION['tipo_usuario']!=10) {
				 if ($lab_invent['bn_notas']=='COMPUTO' ) { ?>
                   <input name="ecasignar" type="submit" value="Asignar" />
            <?php } elseif ($lab_invent['bn_notas']=='EQUIPO' ) { ?>   
                      <input name="ecasignar" type="submit" value="Asignar??" />
                     <?php } else { ?>
			            <font color="blue"><?php echo 'El disp no se identifica correctamente, aún así desea:';?></font>
                         <input name="basignarc" type="submit" value="Asignar a Cómputo" />
	               
			   <?php }  
             
	} // fin if ($_SESSION['tipo_lab']!='e'  && $_SESSION['tipo_usuario']!=10) 

*/

  }//if ($labasig=='Ninguno' && $_GET['lab'] != NULL ){
   else { 
   $querydis="SELECT * FROM dispositivo d
        JOIN laboratorios l 
        ON l.id_lab=d.id_lab
        JOIN departamentos dep
	    ON dep.id_dep=l.id_dep
	    WHERE inventario="."'".$lab_invent['bn_clave']."'". " AND id_div=".$_SESSION['id_div'];
	

$datosdis = pg_query($con,$querydis);
$reg= pg_fetch_array($datosdis);
$inventariodis= pg_num_rows($datosdis); 

$queryexp="SELECT * FROM equipo d
           JOIN bienes b
           ON b.bn_id=d.bn_id
           JOIN laboratorios l 
           ON l.id_lab=d.id_lab
           JOIN departamentos dep
	       ON dep.id_dep=l.id_dep
	       WHERE bn_clave="."'".$lab_invent['bn_clave']."'". " AND id_div=".$_SESSION['id_div'];	   
$datosexp = pg_query($con,$queryexp);
$regexp= pg_fetch_array($datosexp);
$inventarioexp= pg_num_rows($datosexp); 

     if ($_SESSION['tipo_lab']=='e'  && $_SESSION['tipo_usuario']!=10 && $inventarioexp!=0 ) { ?>
             <input name="eedasignar" type="submit" value="Desasignar" />
    <?php     }else if ($_SESSION['tipo_lab']=='e'  && $_SESSION['tipo_usuario']!=10 && $inventariodis!=0 ) { ?>
                 <input name="ecdasignar" type="submit" value="Desasignar" />
    
	 <?php   
        }elseif ($_SESSION['tipo_lab']!='e'  && $_SESSION['tipo_usuario']!=10 && $inventariodis!=0) {?>
                  <input name="dasignarc" type="submit" value="Desasignar" />
   <?php    
     } elseif ($_SESSION['tipo_lab']!='e'  && $_SESSION['tipo_usuario']!=10 && $inventarioexp!=0) {?>
                  <input name="eedasignar" type="submit" value="Desasignar" />
   <?php     
     }
   }
  
// revisa que se encuentre en dispositivo y en la división  
/*
$query="SELECT * FROM dispositivo d
        JOIN laboratorios l 
        ON l.id_lab=d.id_lab
        JOIN departamentos dep
	    ON dep.id_dep=l.id_dep
	    WHERE inventario="."'".$lab_invent['bn_clave']."'". " AND id_div=".$_SESSION['id_div'];
	

$datos = pg_query($con,$query);
$reg= pg_fetch_array($datos);
$inventariod= pg_num_rows($datos); 

$queryexp="SELECT * FROM equipo d
           JOIN bienes b
           ON b.bn_id=d.bn_id
           JOIN laboratorios l 
           ON l.id_lab=d.id_lab
           JOIN departamentos dep
	       ON dep.id_dep=l.id_dep
	       WHERE bn_clave="."'".$lab_invent['bn_clave']."'";		   
$datosexp = pg_query($con,$queryexp);
$regexp= pg_fetch_array($datosexp);
$inventarioexp= pg_num_rows($datosexp); 
//echo 'canti'.$inventarioexp;

           //if ($_SESSION['tipo_lab']=='e'  && $_SESSION['tipo_usuario']!=10 && $inventarioexp!=0) { ?>
             <!-- <input name="eedasignar" type="submit" value="Desasignare" />-->
      
         <?php 
		  // }elseif (($_SESSION['tipo_lab']=='e' && $_GET['mod']=='invg' )  && $_SESSION['tipo_usuario']!=10  && ($inventariod!=0 ) ){
			  ?>
                <!--  <input name="ecdasignar" type="submit" value="Desasignared" />-->
         <?php
           // }elseif ($_SESSION['tipo_lab']!='e'  && $_SESSION['tipo_usuario']!=10 && $inventariod!=0) {  
         if ($_SESSION['tipo_lab']!='e'  && $_SESSION['tipo_usuario']!=10 ) {  ?>
                   <input name="dasignarc" type="submit" value="Desasignarc" />
	      <?php } elseif  ($_SESSION['tipo_lab']!='e'  && $_SESSION['tipo_usuario']!=10 ) {  ?>
                     <input name="dasignarc" type="submit" value="Desasignare" />
     <?php }
    
		 } // if ($_SESSION['tipo_lab']=='e'  && $_SESSION['tipo_usuario']!=10 && $inventarioexp!=0) 
		
 //if ($labasig=='Ninguno' && $_GET['lab'] != NULL )
 */


  
?>
</td></tr>
   
  <?php
	
 
 
 
     foreach ($lab_invent as $campo => $valor) {
	      echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
              
  }

  ?>
       
<input name="bbuscar" type="hidden" value="Buscar" />
<input name="accion" type="hidden" value="Buscar" />
<input name="_no_inv" type="hidden" value="<?php echo $_REQUEST['_no_inv']?>" />
<input name="_no_inv_ant" type="hidden" value="<?php echo $_REQUEST['_no_inv_ant']?>" />
<input name="_marca" type="hidden" value="<?php echo $_REQUEST['_marca']?>" />
<input name="_descripcion" type="hidden" value="<?php echo $_REQUEST['_descripcion']?>" />
<input name="_no_serie" type="hidden" value="<?php echo $_REQUEST['_no_serie']?>" />
<input name="_marca" type="hidden" value="<?php echo $_REQUEST['_marca']?>" />
<input name="_procesador" type="hidden" value="<?php echo $_REQUEST['_procesador']?>" />
<input name="_no_procesadores" type="hidden" value="<?php echo $_REQUEST['_no_procesadores']?>" />
<input name="_velocidad" type="hidden" value="<?php echo $_REQUEST['_velocidad']?>" />
<input name="_modelo" type="hidden" value="<?php echo $_REQUEST['_modelo']?>" />
<input name="lab" type="hidden" value="<?php echo $_GET['lab']; ?>" />
<input name="mod" type="hidden" value="<?php echo $_GET['mod']; ?>" />
<input name="orden" type="hidden" value="<?php echo $_GET['orden']; ?>" />

</form>	




<?php  } //if (count($lab_invent > 0 )){	?>

<?php
   }//fin while() ?>
   </table>
 <?php
}//fin de muestra todo lo de inventario general de toda la facultad
 elseif ( $_GET['mod']=='invg' && $_GET['lab']=='') {
	 
	 $bandera=0;
	
     
if ($inventario!=0){?>


<tr><td>
<div class="block" id="necesidades_content">    

<form action="../view/inicio.html.php" method="get" name="orderby">

             
			        Ordenar por: <select name="orden">
                     
			          <option value="orden" <?php echo $sel=(!isset($_GET['bn_id'])||$_GET['bn_id']=='bn_id') ? 'selected="selected"':''; ?>>Seleccione...</option>
			          <option value="descripcion" <?php echo $sel=($_GET['bn_id']=='descripcion')? 'selected="selected"': "";?>>Descripción</option>
			          <option value="clave" <?php echo $sel=($_GET['bn_id']=='clave')? 'selected="selected"': "";?>>No. Inventario</option>
			          <option value="marca" <?php echo $sel=($_GET['bn_id']=='marca')? 'selected="selected"': "";?>>Marca</option>
			           </select>
			    
			<?php
			    echo "<input name='lab' type='hidden' value='".$_GET['lab']."' /> \n";
				echo "<input name='mod' type='hidden' value='".$_GET['mod']."' /> \n";
				
			?>
			           <input name="accion" type="hidden" value="bbuscarg" />
                       <input name="orden" type="hidden" value="<?php echo $_GET['orden']; ?>" />
                      <input name="bOrden" type="submit" value="ordenar" />
            </form>
</td>

</tr>

<br >
<br >
  <table>
<?php

 } else { ?>
    <br \>
       <legend align="center"><h3>No se encuentran coincidencias en el inventario de la división.</h3></legend>
   <br \>
 <?php  
    } //if ($inventario!=0){


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
		 if ($_SESSION['tipo_lab']=='e' && $lab_invent['bn_notas']=='EQUIPO' ) {
		 //
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
			
			} elseif ($_SESSION['tipo_lab']=='e' && ($lab_invent['bn_notas']=='COMPUTO' || $lab_invent['bn_notas']=='' ) ) { ?>
            
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
    
	 }elseif ($_SESSION['tipo_lab']!='e' && ($lab_invent['bn_notas']=='COMPUTO' || $lab_invent['bn_notas']=='' )) {   ?>
        
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
			if ($_SESSION['tipo_lab']=='e'  &&  ($lab_invent['bn_notas']=='COMPUTO'|| $lab_invent['bn_notas']=='' ) ) { /**/ ?>
           
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
         }  elseif ($_SESSION['tipo_lab']!='e' && ($lab_invent['bn_notas']=='COMPUTO'|| $lab_invent['bn_notas']=='' )  ) { /**/  ?>
           
           <tr>
                  <td width="20%" scope="col"><?php echo $lab_invent['bn_clave'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['inventario'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['tipo_usuario'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_dispositivo'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['marca_p'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['modelo_p'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['serie'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_familia'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['cantidad_procesador'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nucleos_gpu'];?></td>
                  
                 
           </tr>
           
         <?php } //fin elseif ?> 


          	<?php 
      
		
		if ($_SESSION['tipo_lab']=='e' && ($lab_invent['bn_notas']=='COMPUTO'|| $lab_invent['bn_notas']=='' ) ) { ?>
        
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
               <th width="20%" scope="col">Acceso red</th>
               <th width="20%" scope="col">Salida Internet</th>
              
           
     <?php     
			
			}elseif ($_SESSION['tipo_lab']!='e' && ($lab_invent['bn_notas']=='COMPUTO' || $lab_invent['bn_notas']=='' )) { ?>
           
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
               <th width="20%" scope="col">Acceso red</th>
               <th width="20%" scope="col">Salida Internet</th>
                
              
           </tr>
           
         
  <?php } //fin elseif ?> 

  <?php 

			if ($_SESSION['tipo_lab']=='e' && ($lab_invent['bn_notas']=='COMPUTO' || $lab_invent['bn_notas']=='' ) ) {?>
           
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
                  <td width="20%" scope="col"><?php echo $lab_invent['accesored'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['salidainternet'];?></td>
         </tr>
         
         <?php   
			
			
			}elseif ($_SESSION['tipo_lab']!='e' && ($lab_invent['bn_notas']=='COMPUTO' || $lab_invent['bn_notas']=='' )) {   ?>
            
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
                  <td width="20%" scope="col"><?php echo $lab_invent['accesored'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['salidainternet'];?></td>
                 
                  
          </tr>
         
  <?php } //fin elseif ?> 


        <?php
		
         foreach ($lab_invent as $campo => $valor) {
             // echo "\$usuario[$campo] => $valor.\n" . "</br>";
              echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";

         }?>

   <?php	
		    } // fin del while
// }
			?> 
      </table>

	 
  <?php	 
	 
	 
 } //fin de muestra todo lo de inventario general de toda la div
elseif ( $_GET['mod']=='invc' || $_GET['mod']=='inv')  {

       $bandera1=0;

	  //echo 'inventario cómputo';
	  //echo $query;
	  $datos = pg_query($con,$query); 
	  $inventario= pg_num_rows($datos);
	if ($inventario!=0){?>


<tr><td>

<form action="../view/inicio.html.php" method="get" name="orderby">
             
			        Ordenar por: 
                    <select name="orden">
                     
			          <option value="orden" <?php echo $sel=(!isset($_GET['bn_id'])||$_GET['bn_id']=='bn_id') ? 'selected="selected"':''; ?>>Seleccione...</option>
			          <option value="descripcion" <?php echo $sel=($_GET['bn_id']=='descripcion')? 'selected="selected"': "";?>>Descripción</option>
			          <option value="clave" <?php echo $sel=($_GET['bn_id']=='clave')? 'selected="selected"': "";?>>No. Inventario</option>
			          <option value="marca" <?php echo $sel=($_GET['bn_id']=='marca')? 'selected="selected"': "";?>>Marca</option>
			           </select>
			    
			<?php
			    echo "<input name='lab' type='hidden' value='". $_GET['lab']."' /> \n";
				echo "<input name='mod' type='hidden' value='".$_GET['mod']."' /> \n";
			?>
			<input name="bbuscar" type="hidden" value="Buscar" />
			<input name="accion" type="hidden" value="Buscar" />
			<input name="_no_inv" type="hidden" value="<?php echo $_REQUEST['_no_inv']?>" />
			<input name="_no_inv_ant" type="hidden" value="<?php echo $_REQUEST['_no_inv_ant']?>" />
			<input name="_marca" type="hidden" value="<?php echo $_REQUEST['_marca']?>" />
			<input name="_modelo" type="hidden" value="<?php echo $_REQUEST['_modelo']?>" />
			<input name="_no_serie" type="hidden" value="<?php echo $_REQUEST['_no_serie']?>" />
            <input name="_estado" type="hidden" value="<?php echo $_REQUEST['_estado']?>" />
            <input name="bn_id" type="hidden" value="<?php echo $_REQUEST['bn_id']?>" />
			<input name="bOrden" type="submit" value="ordenar" />
            </form>
</td>

</tr>

<br >
<br >
  <table>
<?php
 } else { ?>
    <br \>
       <legend align="center"><h3>No se encuentran coincidencias en el inventario </h3></legend>
   <br \>
 <?php  
    }
?>
 </table>
 <br />
 <br />
<div class="block" id="necesidades_content">
 <?php 
//echo $query;

	  
while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) { 
	
		if ((integer)$lab_invent['servidor']==1)
		 {$etiqServidor='Si';}
		 else 
		 {$etiqServidor='No';} ?> 
	     <table class='material'>
		 
		<?php
		 // print_r($lab_invent);
         if (isset($lab_invent)){?>
        
		 <?php
		 if ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='inv'   ) {
		 //&& $lab_invent['bn_notas']=='EQUIPO'
		?>
         
		 <tr>
              <th  width="20%" scope="col">No. Inventarioeinv</th>
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
               <th width="20%" scope="col">No. Inventarioeinvc</th>
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
               <th width="20%" scope="col">No. Inventario!einvc</th>
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
           
         
  <?php } //fin exhibe cabeceras ?> 

<?php  

	    // if ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='inv' //&& $lab_invent['bn_notas']=='EQUIPO'
		//  ) { ?>
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
			if ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='invc'  ) {  ?>
           
           <tr>
                  <td width="20%" scope="col"><?php echo $lab_invent['bn_clave'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['inventario'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['tipo_usuario'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_dispositivo'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['marca_p'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['modelo'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['serie'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_familia'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['cantidad_procesador'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nucleos_gpu'];?></td>
                  
                  
                 
         </tr>
         
         <?php     
         }  elseif ($_SESSION['tipo_lab']!='e' &&  $_GET['mod']=='invc'  ) { ?>
           
           <tr>
                  <td width="20%" scope="col"><?php echo $lab_invent['bn_clave'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['inventario'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['tipo_usuario'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['nombre_dispositivo'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['marca_p'];?></td>
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
               <th width="20%" scope="col">Sistema Operativoeinvc</th>
               <th width="20%" scope="col">Versión SO</th>
               <th width="20%" scope="col">Tipo de memoria</th>
               <th width="20%" scope="col">Cantidad de memoria</th>
               <th width="20%" scope="col">Número de Elementos</th>
               <th width="20%" scope="col">Tecnología</th>
               <th width="20%" scope="col">Total de almacenamiento</th>
               <th width="20%" scope="col">Número de arreglos</th>
               <th width="20%" scope="col">Capacidad Total</th>
               <th width="20%" scope="col">Estado</th>
               <th width="20%" scope="col">Acceso red</th>
               <th width="20%" scope="col">Salida Internet</th>
              
           
     <?php     
			
			}elseif ($_SESSION['tipo_lab']!='e' && $_GET['mod']=='invc' ) { ?>
           
           <tr>
               <th width="20%" scope="col">Sistema Operativo!einvc</th>
               <th width="20%" scope="col">Versión SO</th>
               <th width="20%" scope="col">Tipo de memoria</th>
               <th width="20%" scope="col">Cantidad de memoria</th>
               <th width="20%" scope="col">Número de Elementos</th>
               <th width="20%" scope="col">Tecnología</th>
               <th width="20%" scope="col">Total de almacenamiento</th>
               <th width="20%" scope="col">Número de arreglos</th>
               <th width="20%" scope="col">Capacidad Total</th>
               <th width="20%" scope="col">Estado</th>
               <th width="20%" scope="col">Acceso red</th>
               <th width="20%" scope="col">Salida Internet</th>
               
              
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
                  <td width="20%" scope="col"><?php echo $lab_invent['accesored'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['salidainternet'];?></td>
                
         </tr>
         
         <?php   
			
			
			}elseif ($_SESSION['tipo_lab']!='e' && $_GET['mod']=='invc'  ) {   ?>
            
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
                  <td width="20%" scope="col"><?php echo $lab_invent['accesored'];?></td>
                  <td width="20%" scope="col"><?php echo $lab_invent['salidainternet'];?></td>
                  
          </tr>
         
  <?php } //fin elseif ?> 


        <?php
		
         foreach ($lab_invent as $campo => $valor) {
           //  echo "\n$lab_invent[$campo] => $valor.\n" . "</br>";
              echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";

         }?>

 <?php  if (($_SESSION['tipo_lab']=='c' || $_SESSION['tipo_lab']=='o' || $_SESSION['tipo_lab']=='e' || $_SESSION['tipo_lab']=='u'||$_SESSION['tipo_lab']=='s' ||$_SESSION['tipo_lab']=='a'||$_SESSION['tipo_lab']=='b'||$_SESSION['tipo_lab']=='t') && $_GET['mod']=='invc' && $_SESSION['tipo_usuario']!=10 ){

 ?>
   
      
      <?php $action="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']."&div=". $_SESSION['id_div'];?>
      
      <form action="<?php echo $action; ?>" method="post" name="edi_inv_<?php echo $form=$lab_invent['id_lab'] ."_".$lab_invent['bn_id']; ?>">
 
       <tr><td style="text-align: right" colspan="11"><input name="accion" type="submit" value="editar" /> </td></tr>
 
        <?php
	
		 foreach ($lab_invent as $campo => $valor) {
				      
		      echo "<input name='".$campo."' type='hidden' value='".$valor."' /> \n";
				
		  }?>
        
      </form>    
        
	        <?php
                   }//fien de if (($_SESSION['tipo_lab']=='c' ||....
	        	} // solo si hay
		    } // fin del while
		
			?> 
     </table>
 <?php	  
     
     } //fin elseif ( $_GET['mod']=='invc' || $_GET['mod']=='inv')  {
 
  }
?>
</div>

<br />
<br />







