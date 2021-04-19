<div id="header">
<ul class="navu">

<?php

require_once('../conexion.php');

 
  echo $laboratorio['id_dep'];
	
	
      if($_SESSION['tipo_usuario']==9 ){$consultacomp="di.id_cac=";}                         
				    else if($_SESSION['tipo_usuario']==10){$consultacomp="tipo_lab not like 'e' ";}
                   //else if($_SESSION['tipo_usuario']==9 ){$consultacomp="tipo_lab not like 'e'  and di.id_cac=";}                          else if($_SESSION['tipo_usuario']==10){$consultacomp="tipo_lab not like 'e' ";}
				   
      
      if ($_SESSION['tipo_usuario']==9 ){ //se agrego el id_div LHH 7/dic/2017
      $query = "select  d.id_dep, d.id_responsable, d.nombre as departamento,  u.nombre, a_paterno, a_materno,  di.nombre as div,       di.id_div 
      from  departamentos d, divisiones di, usuarios u where " . $consultacomp  . $_SESSION['id_usuario'] . "
      and d.id_div=di.id_div
      and d.id_responsable=u.id_usuario order by departamento";
      $datos = pg_query($con,$query);}

      if ($_SESSION['tipo_usuario']==10 ){
      $query = "select  d.id_dep, d.id_responsable, d.nombre as departamento,  u.nombre, a_paterno, a_materno, di.nombre as div, di.id_div 
      from  departamentos d, divisiones di, usuarios u where " . $consultacomp . "
      and de.id_div=di.id_div
      and d.id_responsable=u.id_usuario order by departamento";
      $datos = pg_query($con,$query);}

    
//echo $query;
//$datos = pg_query($query);
//Despliegue del menu para el responsable del laboratorio

//if ($_SESSION['tipo_usuario']==9 || $_SESSION['tipo_usuario']==10){
	
if ($_SESSION['tipo_usuario']==9){
    echo '<li><a href="#" >Departamentos...</a>
         <ul>';
	while ($departamento = pg_fetch_array($datos)) 
		 { 
		 	echo " <li><a href='../view/inicio.html.php?mod=".  $_GET['mod'] . "&lab=". $departamento['id_dep'] . "&accion=". $_REQUEST['accion'] . "&div=" . $departamento['id_div'] . "'>" . $departamento['departamento'] .  "</a></li>";
	     }         
          echo "</ul>
		</li>";
		echo $query;
}

?>
 <?php if ($_SESSION['lab']!=''&& $_SESSION['mod']!='')
      $_SESSION['lab']=''; ?>
 </ul>
    
    
</div>
