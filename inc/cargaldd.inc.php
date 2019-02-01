<div id="header">
<ul class="navu">

<?php

require_once('../conexion.php');
//$query = "SELECT * FROM usuarios WHERE id_usuario =" . $_SESSION['id_usuario'];
 
  echo $laboratorio['id_lab'];
  
  echo 'session en cargaldd';
  print_r($_REQUEST);
	 
    if ($_SESSION['tipo_usuario']==1){

    /*   	
    $querydepto="SELECT id_dep from laboratorios where id_lab=" .$_REQUEST['lab'];
    $datosdepto=pg_query($con,$querydepto);

    $depto = pg_fetch_array($datosdepto, NULL, PGSQL_ASSOC);
    $_SESSION['id_dep']=$depto[0];*/

       $query="select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre, a_paterno, a_materno, de.nombre as depa,   di.nombre as div
        from laboratorios l
        join departamentos de
        on l.id_dep=de.id_dep
        join divisiones di
        on de.id_div=di.id_div
        join usuarios u
        on l.id_responsable=u.id_usuario
        where l.id_responsable =". $_SESSION['id_usuario'] . " 
        order by laboratorio";
       $datos = pg_query($con,$query);
	   
	   
	   
      }

      if ($_SESSION['tipo_usuario']==2){


         $query = "select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre, a_paterno, a_materno, de.nombre as depa,           di.nombre as div
          from laboratorios l
          join departamentos de
          on l.id_dep=de.id_dep
          join divisiones di
          on de.id_div=di.id_div
          join  usuarios u
          on l.id_responsable=u.id_usuario
          where de.id_responsable =" . $_SESSION['id_usuario'] . " 
          order by laboratorio";
          $datos = pg_query($con,$query);

      }

      if ($_SESSION['tipo_usuario']==7){ $consultacomp="di.id_comite=";} 
         else if($_SESSION['tipo_usuario']==3){$consultacomp="di.id_responsable=";}
              else if($_SESSION['tipo_usuario']==6){$consultacomp="di.id_secacad=";}
			  else if($_SESSION['tipo_usuario']==9 ){$consultacomp=" di.id_cac=";}                          else if($_SESSION['tipo_usuario']==10){$consultacomp="tipo_lab not like 'e' ";}
                   //else if($_SESSION['tipo_usuario']==9 ){$consultacomp="tipo_lab not like 'e'  and di.id_cac=";}                          else if($_SESSION['tipo_usuario']==10){$consultacomp="tipo_lab not like 'e' ";}

					


       if ($_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==6 || $_SESSION['tipo_usuario']==7){
          $query = "select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre, a_paterno, a_materno, de.nombre as depa,                     di.nombre as div
                    from laboratorios l, departamentos de, divisiones di, usuarios u where " . $consultacomp  . $_SESSION['id_usuario'] . " 
                    and l.id_dep=de.id_dep
                    and de.id_div=di.id_div
                    and l.id_responsable=u.id_usuario order by laboratorio";
                     $datos = pg_query($con,$query);
      }
	  
      if ($_SESSION['tipo_usuario']==9 ){ //se agrego el id_div LHH 7/dic/2017
	  /*
	  $querydepto="SELECT id_dep from laboratorios where id_lab=" .$_REQUEST['lab'];
      $datosdepto=pg_query($con,$querydepto);

      $depto = pg_fetch_array($datosdepto);
      $_SESSION['id_dep']=$depto[0];*/
	  
      $query = "select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre, a_paterno, a_materno, de.nombre as depa,       di.nombre as div, di.id_div 
      from laboratorios l, departamentos de, divisiones di, usuarios u where " . $consultacomp  . $_SESSION['id_usuario'] . "
      and l.id_dep=de.id_dep
      and de.id_div=di.id_div
      and l.id_responsable=u.id_usuario order by laboratorio";
      $datos = pg_query($con,$query);}

      if ($_SESSION['tipo_usuario']==10 ){
      $query = "select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre, a_paterno, a_materno, de.nombre as depa,       di.nombre as div, di.id_div 
      from laboratorios l, departamentos de, divisiones di, usuarios u where " . $consultacomp . "
      and l.id_dep=de.id_dep
      and de.id_div=di.id_div
      and l.id_responsable=u.id_usuario order by laboratorio";
      $datos = pg_query($con,$query);}

    //Para usuario administrador y ve todos los laboratorios de su división
      if ($_SESSION['tipo_usuario']==4 ){
/*$query = "select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre, a_paterno, a_materno, de.nombre as depa, di.nombre as div
from laboratorios l, departamentos de, divisiones di, usuarios u where l.id_dep=de.id_dep
and de.id_div=di.id_div
and l.id_responsable=u.id_usuario order by laboratorio";*/
        $query = "select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre, a_paterno, a_materno, de.nombre as depa,          di.nombre as div
          from laboratorios l
          join departamentos de
          on l.id_dep=de.id_dep
          join divisiones di
          on de.id_div=di.id_div
          join usuarios u
          on l.id_responsable=u.id_usuario
          order by laboratorio";
          //LHH
           $datos = pg_query($con,$query);

       }

        // Para residuos peligrosos
          if ($_SESSION['tipo_usuario']==8 ){
/*$query = "select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre, a_paterno, a_materno, de.nombre as depa, di.nombre as div
from laboratorios l, departamentos de, divisiones di, usuarios u where l.id_dep=de.id_dep
and de.id_div=di.id_div
and l.id_responsable=u.id_usuario 
and l.drp='1'
order by laboratorio";*/
          $query = "select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre, a_paterno, a_materno, de.nombre as depa,            di.nombre as div
          from laboratorios l
          join departamentos de
          on l.id_dep=de.id_dep
		  join divisiones di
		  on de.id_div=di.id_div
		  join usuarios u
		  on l.id_responsable=u.id_usuario
		  where l.drp='1'
		  order by laboratorio";
		  //LHH
          $datos = pg_query($con,$query);
       }

//echo $query;
//$datos = pg_query($query);
//Despliegue del menu para el responsable del laboratorio
       if ($_SESSION['tipo_usuario']==1){

       echo '<li><a href="#" >Área...</a>
            <ul>';
	       while ($laboratorio = pg_fetch_array($datos)) 
		 { 
	        
			/* if($_SESSION['tipo_lab']!='e' && $_GET['mod']=='inv'){
        echo $modulo='invc';}
	else {echo $modulo=$_GET['mod'];}	*/
			
								
	echo " <li><a href='../view/inicio.html.php?mod=". $_GET['mod'] . "&lab=". $laboratorio['id_lab'] . "&accion=". $_REQUEST['accion'] . "'>" . $laboratorio['laboratorio'] . "</a></li>";
	 
		 }         
   
         echo "</ul>
			 
        </li>";

}
// Despliegue del menu para el responsable del departamento
           if ($_SESSION['tipo_usuario']==2){

      echo '<li><a href="#" >Área...</a>
         <ul>';
	  while ($laboratorio = pg_fetch_array($datos)) 
		 { 
  	        echo " <li><a href='../view/inicio.html.php?mod=". $_GET['mod'] . "&lab=". $laboratorio['id_lab'] . "&accion=". $_REQUEST['accion'] . "'>" . $laboratorio['laboratorio'] . "</a></li>";
	 
		 }         
     
         echo "</ul>
			 
        </li>";
}
 //Despliegue del menu para el usuario jefe de divisiòn, sec. acad, comite de lab, comite de computo respectivamente.
 //if ($_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==6 || $_SESSION['tipo_usuario']==7 || $_SESSION['tipo_usuario']==9){
      if ($_SESSION['tipo_usuario']==3 || $_SESSION['tipo_usuario']==6 || $_SESSION['tipo_usuario']==7 ){
    echo '<li><a href="#" >Área...</a>
         <ul>';
		 
		 
	while ($laboratorio = pg_fetch_array($datos)) 
		 { 
	        echo " <li><a href='../view/inicio.html.php?mod=". $_GET['mod'] . "&lab=". $laboratorio['id_lab'] . "&accion=". $_REQUEST['accion'] . "'>" . $laboratorio['laboratorio'] . "</a></li>";
	 
		 }         
     

         echo "</ul>
			 
        </li>";
}


//if ($_SESSION['tipo_usuario']==9 || $_SESSION['tipo_usuario']==10){
	
if ($_SESSION['tipo_usuario']==9){
    echo '<li><a href="#" >Área...</a>
         <ul>';
	while ($laboratorio = pg_fetch_array($datos)) 
		 { 
		 	
	        echo " <li><a href='../view/inicio.html.php?mod=".  $_GET['mod'] . "&lab=". $laboratorio['id_lab'] . "&accion=". $_REQUEST['accion'] . "&div=" . $laboratorio['id_div'] . "'>" . $laboratorio['laboratorio'] .  "</a></li>";
	 
		 }         
         
         echo "</ul>
			 
        </li>";
		//echo $query;
}

// Despliega menu para visita y residuos peligrosos

if ($_SESSION['tipo_usuario']==4 || $_SESSION['tipo_usuario']==5 || $_SESSION['tipo_usuario']==8){

    echo '<li><a href="#" >Área...</a>
         <ul>';
	while ($laboratorio = pg_fetch_array($datos)) 
		 { 
  	       // echo " <li><a href='../view/inicio.html.php?mod=". $_GET['mod'] . "&lab=". $laboratorio['id_lab'] . "&accion=". $_REQUEST['accion'] . "'>" . $laboratorio['laboratorio'] . "</a></li>";
	      
		 }         
     

         echo "</ul>
			 
        </li>";
}
 
//}

?>
 <?php if ($_SESSION['lab']!=''&& $_SESSION['mod']!='')
      $_SESSION['lab']=''; ?>
 </ul>
    
    
</div>
