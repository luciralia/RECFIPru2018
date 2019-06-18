
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php  
require_once('../conexion.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/inventario.class.php');

$obj_inv = new Inventario();
$madq = new Inventario();
$division= new laboratorios();

	if ( $_SESSION['id_div']==NULL)
	     $_SESSION['id_div']=$_REQUEST['div'];

echo 'en buscar inv';
print_r($_REQUEST);

if($_REQUEST['bbuscar']=='Cancelar' || $_REQUEST['bbuscarg']=='Cancelar'){ 
$direccion='location: ../view/inicio.html.php?mod=' . $_REQUEST['mod'] . '&lab=' . $_REQUEST['lab'] .'&div='. $_SESSION['id_div'];
echo $direccion;
header($direccion);

}

?>
<div class="block" id="necesidades_content">  

<?php
if($_REQUEST['accion']=='buscar' )
{
$action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod']  ."&bn_id=". $_REQUEST['bn_id'].'&div='. $_SESSION['id_div'];
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
} // fin de busrcar
?>
<br />
<br />
  <!--<div class=formulario>
  <div class="block" id="necesidades_content">-->
  <table>


<?php

if($_REQUEST['accion']=='buscarg' )
{
echo 'toma boton busquedag';
 //$action1="../view/inicio.html.php?mod=". $_GET['mod']  ."&bn_id=". $_REQUEST['bn_id'] ."&lab=". $_REQUEST['lab'].'&div='. $_SESSION['id_div'];
 $action1="../view/inicio.html.php?mod=". $_GET['mod'] .'&div='. $_SESSION['id_div'];
// agrega lab
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
echo "consulta busquedag".$query;
?>
<br />
<br />

<?php 

if ($_REQUEST['_no_inv']!=''|| $_REQUEST['_descripcion']  || $_REQUEST['_no_serie']|| $_REQUEST['_marca'] || $_REQUEST['_no_inv_ant']){
		
//no admite valores nulos

 ?> 

<?php 
	if ($_REQUEST['bbuscar']=='Buscar')   {
	
	if ( $_GET['mod']=='invc'){
		
	   $query=$obj_inv->selectEquipoInvC(strtoupper($_REQUEST['_descripcion']),strtoupper($_REQUEST['_no_serie']),strtoupper($_REQUEST['_no_inv']),strtoupper($_REQUEST['_marca']),strtoupper($_REQUEST['_no_inv_ant']),$_REQUEST['lab'],$_SESSION['id_usuario']);
	} else if ( $_GET['mod']=='inv'){
		$query=$obj_inv->selectEquipoInvE(strtoupper($_REQUEST['_descripcion']),strtoupper($_REQUEST['_no_serie']),strtoupper($_REQUEST['_no_inv']),strtoupper($_REQUEST['_marca']),strtoupper($_REQUEST['_no_inv_ant']),$_REQUEST['lab']);
	} 
	
	// fin de Asignar

//echo $query; // revisar la sesión donde viene para cambiar el inventario si es de qeuipo cambia tabla

switch ($_GET['bn_id']){
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
	}
	else if ($_REQUEST['bbuscarg']=='Buscar' ){

	$query=$obj_inv->selectEquipoGen(strtoupper($_REQUEST['_descripcion']),strtoupper($_REQUEST['_no_serie']),strtoupper($_REQUEST['_no_inv']),strtoupper($_REQUEST['_marca']),strtoupper($_REQUEST['_no_inv_ant']));
	}

echo 'exhibe consulta buscarinv ';

 echo $query;
?>

<table> 

<?php 

$datos = pg_query($con,$query); 
$inventario= pg_num_rows($datos);

if ($inventario!=0){?>


<tr><td>

<form action="../view/inicio.html.php" method="get" name="orderby">
             
			        Ordenar por: <select name="orden">
                     
			          <option value="orden" <?php echo $sel=(!isset($_GET['bn_id'])||$_GET['bn_id']=='bn_id') ? 'selected="selected"':''; ?>>Seleccione...</option>
			          <option value="descripcion" <?php echo $sel=($_GET['bn_id']=='descripcion')? 'selected="selected"': "";?>>Descripción</option>
			          <option value="clave" <?php echo $sel=($_GET['bn_id']=='clave')? 'selected="selected"': "";?>>No. Inventario</option>
			          <option value="marca" <?php echo $sel=($_GET['bn_id']=='marca')? 'selected="selected"': "";?>>Marca</option>
			           </select>
			    
			<?php
			    echo "<input name='lab' type='hidden' value='". $_GET['lab']."' /> \n";
				echo "<input name='mod' type='hidden' value='".$_GET['mod']."' /> \n";
				//echo "<input name='mod' type='hidden' value='".$_GET['bn_id']."' /> \n";
			?>
			<input name="bbuscar" type="hidden" value="Buscar" />
			<input name="accion" type="hidden" value="Buscar" />
			<!--<input name="_no_inv" type="hidden" value="<?php echo $_REQUEST['_no_inv']?>" />
			<input name="_no_inv_ant" type="hidden" value="<?php echo $_REQUEST['_no_inv_ant']?>" />
			<input name="_marca" type="hidden" value="<?php echo $_REQUEST['_marca']?>" />
			<input name="_modelo" type="hidden" value="<?php echo $_REQUEST['_modelo']?>" />
			<input name="_no_serie" type="hidden" value="<?php echo $_REQUEST['_no_serie']?>" />
            <input name="_estado" type="hidden" value="<?php echo $_REQUEST['_estado']?>" />
            <input name="bn_id" type="hidden" value="<?php echo $_REQUEST['bn_id']?>" />-->
			<input name="bOrden" type="submit" value="ordenar" />
            </form>
</td>

</tr>

<br >
<br >
  <table>
<?php
 } else { 
   if ( $_GET['mod']=='invc' && $inventario==0){?>
    <br \>
  
    <legend align="center"><h3>No se encuentra el dispositivo.</h3></legend>
    
     <br \>
<?php   } else if  ( $_GET['mod']=='inv' && $inventario==0){?>
 <br \>
    
     <legend align="center"><h3>No se encuentra el equipo experimental  en el área.</h3></legend>
     <br \>
<?php 
   } else if ( $_GET['mod']=='invg'  && $inventario==0){?>
    <br \>
   
       <legend align="center"><h3>No se encuentra el dispositivo en el inventario de la facultad.</h3></legend>
 
    <br \>
 <?php  
   } ?>
  
<?php } ?>
 </table>
 <br />
 <br />
<div class="block" id="necesidades_content">
 <?php 
//echo $query;

while ($lab_invent = pg_fetch_array($datos, NULL, PGSQL_ASSOC)) 
{ 

//print_r ($lab_invent);
 if (count($lab_invent)>0) {	
         if ($_SESSION['tipo_lab']=='e' && ($_GET['mod']=='inv'  || $_GET['mod']=='invg' || $_GET['mod']==''  )) {
	     
	  ?>
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


   
        <?php } elseif ($_SESSION['tipo_lab']=='e' && ($_GET['mod']=='invc' || $_GET['mod']=='invg'  || $_GET['mod']=='' )) {?>

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



	
    <?php 
    }elseif ($_SESSION['tipo_lab']!='e' && ($_GET['mod']=='invc' || $_GET['mod']=='invg'  || $_GET['mod']=='' ))  {   
	?>
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
      
    <?php } ?>	


<?php

if ($_SESSION['tipo_lab']=='e' && ($_GET['mod']=='inv'|| $_GET['mod']=='invg'  || $_GET['mod']=='' )) { ?>
<table class='material'>   
    <tr>
        <td width="20%" scope="col"><?php echo $lab_invent['bn_clave'];?></td>
        <td width="20%" scope="col"><?php echo $lab_invent['bn_anterior'];?></td>
        <td width="20%" scope="col"><?php echo $lab_invent['bn_desc'];?></td>
        <td width="20%" scope="col"><?php echo $lab_invent['bn_marca'];?></td>
        <td width="20%" scope="col"><?php echo $lab_invent['bn_modelo'];?></td>
       <td width="20%" scope="col"><?php echo $lab_invent['bn_serie'];?></td>
    </tr>
    <tr >
    <td style="text-align: left" colspan="11"><strong>Asignado a: </strong> <?php  
	echo $labasig=$obj_inv->getAsig($lab_invent['bn_id']);?></td>
  </tr>
  

    
	 <?php
	} elseif ($_SESSION['tipo_lab']=='e' && ($_GET['mod']=='invc' || $_GET['mod']=='invg'  || $_GET['mod']=='' )) {?>
 
  <table class='material'> 
   	<tr>
    <td width="20%" scope="col"><?php echo $lab_invent['bn_clave'];?></td>
    <td width="20%" scope="col"><?php echo $lab_invent['bn_anterior'];?></td>
    <td width="20%" scope="col"><?php echo $lab_invent['bn_desc'];?></td> <!--bn_desc-->
    <td width="20%" scope="col"><?php echo $lab_invent['bn_marca'];?></td>
    <td width="20%" scope="col"><?php echo $lab_invent['bn_modelo'];?></td>
    <td width="20%" scope="col"><?php echo $lab_invent['bn_serie'];?></td>
      
  </tr>
  <tr >
    <td style="text-align: left" colspan="11"><strong>Asignado a: </strong> <?php  
	echo $labasig=$obj_inv->getAsig($lab_invent['bn_id']);?></td>
  </tr>
  
 
 <?php
 }elseif ($_SESSION['tipo_lab']!='e' && ($_GET['mod']=='invc' || $_GET['mod']=='invg'  || $_GET['mod']=='' )) {     ?>
	
    <table class='material'>   
    <tr>
    <td width="20%" scope="col"><?php echo $lab_invent['bn_clave'];?></td>
    <td width="20%" scope="col"><?php echo $lab_invent['bn_anterior'];?></td>
    <td width="20%" scope="col"><?php echo $lab_invent['bn_desc'];?></td>
    <td width="20%" scope="col"><?php echo $lab_invent['bn_marca'];?></td>
    <td width="20%" scope="col"><?php echo $lab_invent['bn_modelo'];?></td>
    <td width="20%" scope="col"><?php echo $lab_invent['serie'];?></td>
       
  </tr>
  <tr >
    <td style="text-align: left" colspan="25"><strong>Asignado a: </strong> <?php  
	echo $labasig=$obj_inv->getAsig($lab_invent['bn_id']);?></td>
  </tr> 
    	
    
 <?php  } ?>
  
<form action="../inc/procesainventario.inc.php" method="post" name="procinvent">

  <tr><td style="text-align: right" colspan="11"> 

  <?php 

// para signar verifica que tenga laboratorio para asignar...

 if ($labasig=='Ninguno' && $_GET['lab'] != NULL ){
	
	  
 //if ($_SESSION['tipo_lab']=='e' && ($_GET['mod']=='inv' || $_GET['mod']=='invg' ) && $_SESSION['tipo_usuario']!=10) {
if (($_SESSION['tipo_lab']=='e' &&  ($_GET['mod']=='invg' ||   $_GET['mod']=='' ) ) && $_SESSION['tipo_usuario']!=10) {

         if ($lab_invent['bn_notas']=='EQUIPO' ) { ?>  
             <!--<input name="eeasignar" type="submit" value="Asignar" />-->
         <?php } elseif ($lab_invent['bn_notas']=='COMPUTO' ) { ?>  
             <input name="ecasignar" type="submit" value="Asignar" />
             <?php } else { // equipo experimental sin definir ?>
			         <font color="blue"><?php echo 'El equipo no se identifica correctamente, aún así desea:';?></font>
                   <input name="basignarc" type="submit" value="Asignar a Cómputo" />  <font color="blue"><?php //echo  ó ?> </font>   
	               <!--<input name="basignare" type="submit" value="Asignar a Equipo" />-->
                   
         <?php } ?>
   
         <?php } //if ($_SESSION['tipo_lab']=='e' && ($_GET['mod']=='inv' || $_GET['mod']=='invg' ) && $_SESSION['tipo_usuario']!=10) {
			 if (($_SESSION['tipo_lab']=='e' &&  ($_GET['mod']=='invg' ||   $_GET['mod']=='' ) ) && $_SESSION['tipo_usuario']!=10) {?>
 
              <?php if ($lab_invent['bn_notas']=='EQUIPO' ) { ?>
              <!--<input name="basignare" type="submit" value="Asignar a Equipo" />-->
              
              <?php } elseif ($lab_invent['bn_notas']=='COMPUTO' ){ ?>
                    
                    <input name="ecasignar" type="submit" value="Asignar" />
                 
	        <?php  } else { ?>
			
			                <font color="blue"><?php echo 'El equipo no se identifica correctamente, aún así desea:';?></font>

                   <input name="basignarc" type="submit" value="Asignar a Cómputo" /> <font color="blue"><?php //echo  ó ?> </font>
                   <!--<input name="basignare" type="submit" value="Asignar a Equipo" /> -->
	
	       <?php } // fin del si es de equipo/cómputo
		 
            }//if ($_SESSION['tipo_lab']=='e' && ($_GET['mod']=='inv' || $_GET['mod']=='invg' ) && $_SESSION['tipo_usuario']!=10) {  // $_SESSION['tipo_lab']!='e' 
                 if (($_SESSION['tipo_lab']=='e' && ($_GET['mod']=='invg'  ||   $_GET['mod']=='' ) ) && $_SESSION['tipo_usuario']!=10) {
				 if ($lab_invent['bn_notas']=='COMPUTO' ) { ?>
                   <input name="ecasignar" type="submit" value="Asignar" />
            <?php } elseif ($lab_invent['bn_notas']=='EQUIPO' ) { ?>   
     
     <?php        } else { ?>
			
			               <font color="blue"><?php echo 'El equipo no se identifica correctamente, aún así desea:';?></font>

                   <input name="basignarc" type="submit" value="Asignar a Cómputo" />
	               
	      
          
			<?php }  ?>
             
<?php 	} //fin de diferente de ninguno


}else { 

 if ($_SESSION['tipo_usuario']==1){

	//obtener el departamento 
	
   $querydepto="SELECT DISTINCT l.id_dep from laboratorios l
                JOIN usuarios u
				ON l.id_responsable=u.id_usuario
                where l.id_responsable=" .$_SESSION['id_usuario'];
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



// revisa que se encuentre en dispositivo y en la división  

$query="SELECT * FROM dispositivo d
        JOIN laboratorios l 
        ON l.id_lab=d.id_lab
        JOIN departamentos dep
	    ON dep.id_dep=l.id_dep
	    WHERE inventario="."'".$lab_invent['bn_clave']."'". " AND id_div=".$_SESSION['id_div'];
	
/*
$query="SELECT * FROM dispositivo d
        JOIN laboratorios l 
        ON l.id_lab=d.id_lab
        JOIN departamentos dep
	    ON dep.id_dep=l.id_dep
	    WHERE inventario="."'".$lab_invent['bn_clave']."'";	*/
//echo $query;
$datos = pg_query($con,$query);
$reg= pg_fetch_array($datos);
$inventario= pg_num_rows($datos); 
/*
$queryexp="SELECT * FROM equipo d
           JOIN bienes b
           ON b.bn_id=d.bn_id
           JOIN laboratorios l 
           ON l.id_lab=d.id_lab
           JOIN departamentos dep
	       ON dep.id_dep=l.id_dep
	       WHERE bn_clave="."'".$lab_invent['bn_clave']."'". " AND id_div=".$_SESSION['id_div'];
*/
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


 //if ($_SESSION['tipo_lab']=='e' && ($_GET['mod']=='inv' || $_GET['mod']=='invg' ) 
 if (($_SESSION['tipo_lab']=='e' &&  $_GET['mod']=='invg' ) 
 && $_SESSION['tipo_usuario']!=10 
 && $inventarioexp!=0) { 
 ?>
              <input name="eedasignar" type="submit" value="Desasignar" />
      
         <?php } //if ($_SESSION['tipo_lab']=='e' && ($_GET['mod']=='inv' || $_GET['mod']=='invg' ) 
		 if (($_SESSION['tipo_lab']=='e' && ( $_GET['mod']=='invg'  ||   $_GET['mod']=='' ))  && $_SESSION['tipo_usuario']!=10  && ($inventario!=0 ) ){
			  ?>
                <input name="ecdasignar" type="submit" value="Desasignar" />
         <?php
            }//elseif ($_SESSION['tipo_lab']!='e'  && ($_GET['mod']=='invc' || $_GET['mod']=='invg' ) && $_SESSION['tipo_usuario']!=10 
			elseif (($_SESSION['tipo_lab']!='e'  && ( $_GET['mod']=='invg'  ||   $_GET['mod']=='' )) && $_SESSION['tipo_usuario']!=10 
			&& $inventario!=0) {  ?>
                   <input name="dasignarc" type="submit" value="Desasignar" />
	      
			<?php }  
 } 

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
<input name="orden" type="hidden" value="<?php echo $_GET['bn_id']; ?>" />
</form>	

</table>


<?php  }//if(isset()) ?>


<?php
}//fin while()
 ?>



<?php 
}
?>
</div>

<br />
<br />
<br />






