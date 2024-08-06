<link rel="stylesheet" type="text/css" href="../css/menu_1.css">  

<div id="header">
 <ul class="nav">
 	
 	
 	<!-- Boton cedula -->
 	<?php if ($_GET['mod']=='ced') {?>
 	<li><a href="../view/inicio.html.php?mod=ced&lab=<?php echo $_GET['lab'];?>" class="actual">Cédula de Información</a></li>
 	<?php }else{ ?>
       	<li><a href="../view/inicio.html.php?mod=ced&lab=<?php echo $_GET['lab'];?>" >Cédula de Información</a></li>
        <?php } ?>

   	<!-- Boton manteniemiento -->
    
        <?php $clase=($_GET['mod']=='serv' || $_GET['mod']=='mat' || $_GET['mod']=='mobi' || $_GET['mod']=='infr')?'" class="actual"':$clase='"'; ?>
        <li><a href="#" <?php echo $clase; ?>>Mantenimiento</a>
         <ul>
          <li><a href="../view/inicio.html.php?mod=serv&lab=<?php echo $_GET['lab'];?>">Externo</a></li>
          <li><a href="../view/inicio.html.php?mod=mat&lab=<?php echo $_GET['lab'];?>">Interno (Material)</a></li>
<!--          <li><a href="../view/inicio.html.php?mod=servi&lab=<?php echo $_GET['lab'];?>">Servicios internos</a></li> -->
          
          <?php if($_SESSION['tipo_usuario']!=9 || $_SESSION['tipo_usuario']!=10){ ?>
          <li><a href="../view/inicio.html.php?mod=infr&lab=<?php echo $_GET['lab'];?>">Infraestructura</a></li>
          <li><a href="../view/inicio.html.php?mod=mobi&lab=<?php echo $_GET['lab'];?>">Mobiliario</a></li>
			<?php }?>
         </ul>
        </li>

	<!-- Boton equipamiento -->
    <?php if($_SESSION['tipo_usuario']!=9 || $_SESSION['tipo_usuario']!=10){ ?>

	<?php $clase=($_GET['mod']=='eq')?'" class="actual"':$clase='"'; ?>
	<li><a href="../view/inicio.html.php?mod=eq&lab=<?php echo $_GET['lab'];?>" <?php echo $clase;?>>Equipamiento</a></li>
	<?php }?>
	
		<!-- Boton Bitacora --> 	
	<?php if ($_GET['mod']=='servibf'||$_GET['mod']=='servibp') { $clase='" class="actual"'; } else {$clase='"';}?> 
    <li><a href="#" <?php echo $clase; ?>>Bit&aacute;coras</a>
	
    	<ul>
            <!--<li><a href="../view/inicio.html.php?mod=bit&lab=<?php echo $_GET['lab'];?>">Bit&aacute;cora de uso</a></li>	-->
            <li><a href="../view/inicio.html.php?mod=servibf&lab=<?php echo $_GET['lab'];?>">Bit&aacute;cora de falla y mantenimiento correctivo interno</a></li>
            <li><a href="../view/inicio.html.php?mod=servibp&lab=<?php echo $_GET['lab'];?>">Bit&aacute;cora de mantenimiento preventivo interno</a></li>
    	</ul>
	</li>
	
	<!-- Boton quejas -->
	<!--<?php $clase=($_GET['mod']=='que')?'" class="actual"':$clase='"'; ?>
	<li><a href="../view/inicio.html.php?mod=que&lab=<?php echo $_GET['lab'];?>" <?php echo $clase;?>>Quejas y sugerencias</a></li> -->


	<!-- Boton proyectos -->
       <?php if($_SESSION['tipo_usuario']!=9 || $_SESSION['tipo_usuario']!=10){ ?>
	<?php $clase=($_GET['mod']=='pro')?'" class="actual"':$clase='"'; ?>
	<li><a href="../view/inicio.html.php?mod=pro&lab=<?php echo $_GET['lab'];?>" <?php echo $clase;?>>Detalle de Proyectos</a></li>
	<?php }?>
    
   
   <!-- Botón inventario -->
   <?php echo $_GET['mod'] ?>
   <?php if ($_GET['mod']=='inv') {?>
 	<li><a href="../view/inicio.html.php?mod=ced&lab=<?php echo $_GET['lab'];?>" class="actual">inventario</a></li>
 	<?php }else{ ?>
       	<li><a href="../view/inicio.html.php?mod=ced&lab=<?php echo $_GET['lab'];?>" >inventario</a></li>
    <?php } ?>
        
	<!-- Boton equipamiento -->
    <?php if($_SESSION['tipo_usuario']!=9 || $_SESSION['tipo_usuario']!=10){ ?>

	<?php $clase=($_GET['mod']=='eq')?'" class="actual"':$clase='"'; ?>
	<li><a href="../view/inicio.html.php?mod=eq&lab=<?php echo $_GET['lab'];?>" <?php echo $clase;?>>Equipamiento</a></li>
	<?php }?>



<!-- Botón cotizaciones-->
   <?php if($_SESSION['tipo_usuario']!=9){ ?>
	<?php $actual=($_GET['mod']=='cot')? ' class="actual"':'';?>
    <li><a href="../view/inicio.html.php?mod=cot&lab=<?php echo $_GET['lab'];?>" <?php echo $actual; ?>>Cotizaciones</a></li>
<?php }?>

    <?php $actual=($_GET['mod']=='doc')? ' class="actual"':'';?>
    <li><a href="../view/inicio.html.php?mod=doc&lab=<?php echo $_GET['lab'];?>" <?php echo $actual; ?>>Documentos</a></li>
    
        <?php $actual=($_GET['mod']=='ace')? ' class="actual"':'';?>
    <!--<li><a href="../view/inicio.html.php?mod=ace&lab=<?php echo $_GET['lab'];?>" <?php echo $actual; ?>>Acerca de...</a></li>-->
    
    	<!--<li><a href="#">Documentos</a></li>
      	
   	<li><a href="#">Administración</a></li>-->
        
    <li><a href="../inc/salir.inc.php">Salir</a></li>
      

 </ul>
    
    
</div>


