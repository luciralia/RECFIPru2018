<div id="header">
<ul class="navu">

<?php

require_once('../conexion.php');


  echo $division['id_div'];
	 
    if ($_SESSION['tipo_usuario']==10){

       $query="SELECT id_div,nombre FROM divisiones";
       $datos = pg_query($con,$query);
      }
// Des0pliega menú para el usuario
       if ($_SESSION['tipo_usuario']==10){

       echo '<li><a href="#" >División...</a>
            <ul>';
	       while ($division = pg_fetch_array($datos)) 
		 { 
	   						
	echo " <li><a href='../view/inicio.html.php?mod=". $_GET['mod'] . "&div=". $division['id_div'] . "&accion=". $_REQUEST['accion'] . "'>" . $division['nombre'] . "</a></li>";
	
		 }         
   
         echo "</ul>
			 
        </li>";

}

?>
 <?php 
		if ($_SESSION['id_div']!='' && $_SESSION['mod']!='')
                $_SESSION['id_div']=''; 
		else 		
		        $_SESSION['id_div']=$_REQUEST['div'];
	  //echo 'la div en cargadiv';
	  //echo  $_SESSION['id_div'];
	?>
    
    
    <?php 
/*Otra version
 if ($_SESSION['id_div']=='' && $_SESSION['mod']!=''   ){
    
	     $_SESSION['id_div']=$_GET['div'];
 }
      //$_SESSION['id_div']=$division['id_div'] ; 		
	
/*	  
	  if ($_SESSION['id_div']!= '' && $_SESSION['mod']!=''  )
		;
		 */
	 /*else 	 
	     $_SESSION['id_div']=''; */
		 /*
		 if (($_SESSION['id_div']!= '' && $_SESSION['mod']!='' ) && $_SESSION['tipo_usuario']==10)
		    */
	  ?>
 </ul>
    
    
</div>
