<link rel="stylesheet"  type="text/css" href="../css/menu_1.css">  
  <?php require_once('../clases/laboratorios.class.php');
        $labNom = new laboratorios();
		/*echo 'SESSIONen menu1.inc';
	print_r($_SESSION);	
	echo 'GETen menu1.inc';
	print_r($_REQUEST);	*/
	?>

<div id="header">

  <ul class="nav">
 
 	<!-- Boton cedula -->
    <?php $tipo=$labNom->getLaboratorio($_GET['lab']);?>
     <?php  
 	   if ($_GET['mod']=='ced') {?>
 	<li><a href="../view/inicio.html.php?mod=ced&lab=<?php echo $_GET['lab'];?>" class="actual">Cédula de Información</a></li>
 	<?php }else{ ?>
       	<li><a href="../view/inicio.html.php?mod=ced&lab=<?php echo $_GET['lab'];?>" >Cédula de Información</a></li>
        <?php }
		/*
?>

   	<!-- Boton mantenimiento -->
        <?php if($_SESSION['tipo_usuario']!=8 && $_SESSION['tipo_usuario']!=10  ){ ?>
        <?php //if($_SESSION['tipo_usuario']==9 || $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==2 || $_SESSION['tipo_usuario']==3 ){ ?>
        <?php $clase=($_GET['mod']=='serv' || $_GET['mod']=='mat' || $_GET['mod']=='mobi' || $_GET['mod']=='infr')?'" class="actual"':$clase='"'; ?>
        <li><a href="#" <?php echo $clase; ?>>Mantenimiento</a>
         <ul>
          <li><a href="../view/inicio.html.php?mod=serv&lab=<?php echo $_GET['lab'];?>">Externo</a></li>
          <li><a href="../view/inicio.html.php?mod=mat&lab=<?php echo $_GET['lab'];?>">Interno (Material)</a></li>
          <?php }?>
          
<!--          <li><a href="../view/inicio.html.php?mod=servi&lab=<?php echo $_GET['lab'];?>">Servicios internos</a></li> -->
       
           <?php if($_SESSION['tipo_usuario']!=8 && $_SESSION['tipo_usuario']!=10  ){ ?>
          <?php //if($_SESSION['tipo_usuario']==9  || $_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==2 || $_SESSION['tipo_usuario']==3){ ?>
          <li><a href="../view/inicio.html.php?mod=infr&lab=<?php echo $_GET['lab'];?>">Infraestructura</a></li>
          
          <li><a href="../view/inicio.html.php?mod=mobi&lab=<?php echo $_GET['lab'];?>">Mobiliario</a></li>
			
         </ul>
        </li>
<?php }?>
	<!-- Boton equipamiento -->
    
    <?php if($_SESSION['tipo_usuario']!=8 && $_SESSION['tipo_usuario']!=10  ){ ?>

	<?php $clase=($_GET['mod']=='eq')?'" class="actual"':$clase='"'; ?>
	<li><a href="../view/inicio.html.php?mod=eq&lab=<?php echo $_GET['lab'];?>" <?php echo $clase;?>>Equipamiento</a></li>
	<?php }?>
	
		<!-- Boton Bitacora --> 
    <?php if($_SESSION['tipo_usuario']!=8 && $_SESSION['tipo_usuario']!=10  ){ ?>   	
	<?php if ($_GET['mod']=='servibf'||$_GET['mod']=='servibp') { $clase='" class="actual"'; } else {$clase='"';}?> 
    <li><a href="#" <?php echo $clase; ?>>Bit&aacute;coras</a>
	
    	<ul >
            <!--<li><a href="../view/inicio.html.php?mod=bit&lab=<?php echo $_GET['lab'];?>">Bit&aacute;cora de uso</a></li>	-->
            <li><a href="../view/inicio.html.php?mod=servibf&lab=<?php echo $_GET['lab'];?>">Bit&aacute;cora de falla y mantenimiento correctivo interno</a></li>
            <li><a href="../view/inicio.html.php?mod=servibp&lab=<?php echo $_GET['lab'];?>">Bit&aacute;cora de mantenimiento preventivo interno</a></li>
    	</ul>
	</li>
	<?php }
	*/
	?>
	<!-- Boton quejas -->
	<!--<?php $clase=($_GET['mod']=='que')?'" class="actual"':$clase='"'; ?>
	<li><a href="../view/inicio.html.php?mod=que&lab=<?php echo $_GET['lab'];?>" <?php echo $clase;?>Quejas y sugerencias</a></li> -->

	<!-- Boton proyectos -->
    
    <?php /*
	if($_SESSION['tipo_usuario']==9){ ?>
	<?php $clase=($_GET['mod']=='pro')?'" class="actual"':$clase='"'; ?>
	<li><a href="../view/inicio.html.php?mod=pro&lab=<?php echo $_GET['lab'];?>" <?php echo $clase;?>>Detalle de Proyectos</a></li>
	<?php }
	*/?>
    
         <!-- Botón inventario -->
   <?php //echo $_REQUEST['mod'];?>
  
   <?php //if($_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==9 || $_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==2 || $_SESSION['tipo_usuario']==3){ ?>
       <?php $clase=($_GET['mod']=='inv' || $_GET['mod']=='invc')?'" class="actual"':$clase='"'; ?>
       
 	      <li><a href="#" <?php echo $clase;?>>Inventarios</a>
 	      
      	  <ul>
          <?php if ( $_SESSION['id_div']!='' || $_GET['lab']!='' )	 {
			 //if ( $_GET['lab']!='' )	 {
				 ?>
             <li><a href="../view/inicio.html.php?mod=invg&lab=<?php  echo $_GET['lab'];?>&div=<?php  echo $_REQUEST['div'];?> ">General</a></li>
           <?php } ?>   
             <?php if ($_SESSION['tipo_lab']!='e' && $_GET['lab']!='' )	 {?>
             
                   <li><a href="../view/inicio.html.php?mod=invc&lab=<?php  echo $_GET['lab'];?>">Equipos de c&oacute;mputo</a></li>
                   
			<?php } elseif ($_SESSION['tipo_lab']=='e'  && $_GET['lab']!=''  ) {?>
                <li><a href="../view/inicio.html.php?mod=inv&lab=<?php  echo $_GET['lab'];?>">Equipos experimentales</a></li>
                <li><a href="../view/inicio.html.php?mod=invc&lab=<?php  echo $_GET['lab'];?>">Equipos de c&oacute;mputo</a></li>
    	 <?php } ?> 
         <?php if ($_SESSION['tipo_usuario']!=10 )	 {?>
                    <li><a href="../view/inicio.html.php?mod=imp">Importar</a></li>
         <?php } ?> 
          </ul>
	   </li>
    
     <?php //}
   ?>
    <?php if($_SESSION['tipo_usuario']!=8 ){ ?>
	<?php $clase=($_GET['mod']=='cen' || $_GET['mod']=='ceni' || $_GET['mod']=='cened'|| $_GET['mod']=='cenert'|| $_GET['mod']=='ceneceq'|| $_GET['mod']=='cenecso' || $_GET['mod']=='cenecuf'|| $_GET['mod']=='cenecufb'|| $_GET['mod']=='cenecar')?'" class="actual"':$clase='"'; ?>
	<li><a href="#" <?php echo $clase;?>>Censo</a>
        <ul >
            <li><a href="#">Equipo C&oacute;mputo</a>    <!--Temporal Nivel 1--> 
                  <ul>
                     <li><a href="../view/inicio.html.php?mod=ceneceq&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_REQUEST['div'];?>">Estado del Equipo</a></li>
                     <li><a href="../view/inicio.html.php?mod=cenecso&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_REQUEST['div'];?>">Sistema Operativo</a></li>
                     <li><a href="../view/inicio.html.php?mod=cenecuf&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_REQUEST['div'];?>">Usuario Final</a>
                         <ul>
                              <li><a href="../view/inicio.html.php?mod=cenecufb&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_REQUEST['div'];?>">Usuario de Bibliotecas</a> </li>
                         </ul>
                      </li>
                     <li><a href="../view/inicio.html.php?mod=cenecar&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_REQUEST['div'];?>">Equipo Alto Rendimiento</a></li>
                   </ul>
             </li>   <!-- Es fin del equipo de Cómputo--> 
            
            <li><a href="../view/inicio.html.php?mod=ceni&lab=<?php  echo $_GET['lab'];?>&div=<?php  echo $_REQUEST['div'];?>">Impresoras </a></li>
            <li><a href="../view/inicio.html.php?mod=cened&lab=<?php  echo $_GET['lab'];?>&div=<?php  echo $_REQUEST['div'];?>">Equipo Digital</a></li>
            <li><a href="../view/inicio.html.php?mod=cenert&lab=<?php  echo $_GET['lab'];?>&div=<?php  echo $_REQUEST['div'];?>">Equipo Redes y Telecomunicaciones</a></li>
         </ul>  
    </li>  
     <?php }?>  
<!-- Botón cotizaciones-->
   <?php /*
   if($_SESSION['tipo_usuario']!=8 && $_SESSION['tipo_usuario']!=10 ){ ?>
	<?php $actual=($_GET['mod']=='cot')? ' class="actual"':'';?>
    <li><a href="../view/inicio.html.php?mod=cot&lab=<?php echo $_GET['lab'];?>" <?php echo $actual; ?>>Cotizaciones</a></li>
<?php }
*/?>

    <?php if($_SESSION['tipo_usuario']!=8 && $_SESSION['tipo_usuario']!=10 ){ ?>
    <?php $actual=($_GET['mod']=='doc')? ' class="actual"':'';?>
    <li><a href="../view/inicio.html.php?mod=doc&lab=<?php echo $_GET['lab'];?>" <?php echo $actual; ?>>Documentos</a></li>
    <?php }?>
     <?php $actual=($_GET['mod']=='ace')? ' class="actual"':'';?>
     
    <!--<li><a href="../view/inicio.html.php?mod=ace&lab=<?php echo $_GET['lab'];?>" <?php echo $actual; ?>>Acerca de...</a></li>-->
    
    <!--<li><a href="#">Documentos</a></li>
      	
   	<li><a href="#">Administración</a></li>-->
    
    <li><a href="../inc/salir.inc.php">Salir</a></li>
   
 </ul>
 
</div>


