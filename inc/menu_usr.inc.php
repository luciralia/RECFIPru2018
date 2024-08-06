<!--<link rel="stylesheet" type="text/css" href="../css/caja.css">
<link rel="stylesheet" type="text/css" href="../css/menu_usr.css"> 
-->

<?php 
/*
if ((!isset($_GET['lab']) || $_GET['lab']=="" ) && $_SESSION['tipo_usuario']!=10) {
	
       $estado='visible'; ?>
        <div id="resaltado"> Debe seleccionar un Área </div> 
     <?php    
         require_once('../inc/cargaldd.inc.php');

     }else{
	
         require_once('../inc/cargaldd.inc.php'); 
} 

*/
if ((!isset($_GET['lab']) || $_GET['lab']=='' ) && $_SESSION['tipo_usuario']!=10) {
	
       $estado='visible'; ?>
        <div id="resaltado"> Debe seleccionar un Área </div> 
     <?php    
         require_once('../inc/menuNiv.inc.php');

     }else
	
         require_once('../inc/menuNiv.inc.php'); 


//echo 'Menú para rcacfi';


	 // if ((!isset($_GET['id_div']) || $_GET['id_div']=="" ) && $_SESSION['tipo_usuario']==10 ) { 
//echo 'es rcacfi';
	 if ((!isset($_GET['div']) || $_GET['div']=="" ) && $_SESSION['tipo_usuario']==10 ) {
	   $estado='visible';
	  
 ?>
<div id="resaltado"> Debe seleccionar una división </div> 
<?php 
      require_once('../inc/cargadiv.inc.php');
    }
	else{ 
     require_once('../inc/cargadiv.inc.php');
	 }
?>


<!-- <div class="lightbox" >
	<figure>
		<a href="#" class="closemsg"></a>
		<figcaption>Elija un laboratorio.</br> <?php //require_once('../inc/menu_usr.inc.php');?></figcaption>
	</figure>
</div> -->






