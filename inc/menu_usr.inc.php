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
if ((!isset($_GET['lab']) || $_GET['lab']=="" ) && $_SESSION['tipo_usuario']!=10) {
	
       $estado='visible'; ?>
        <div id="resaltado"> Debe seleccionar un Área </div> 
     <?php    
         require_once('../pruebas/menuNiv.php');

     }else
	
         require_once('../pruebas/menuNiv.php'); 


//echo 'Menú para Divisiones';

//print_r ($_SESSION);

// echo 'entra a menu div';

  
	  if ((!isset($_GET['id_div']) || $_GET['id_div']=="" ) && $_SESSION['tipo_usuario']==10) { 
//echo 'es rcacfi';
	 
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






