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
		
	?>
	<!-- Boton quejas -->
	<!--<?php $clase=($_GET['mod']=='que')?'" class="actual"':$clase='"'; ?>
	<li><a href="../view/inicio.html.php?mod=que&lab=<?php echo $_GET['lab'];?>" <?php echo $clase;?>Quejas y sugerencias</a></li> -->

	
    
         <!-- Botón inventario -->
     <?php //echo $_REQUEST['mod'];?>
  
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
         <?php if ($_SESSION['tipo_usuario']!=10 )	 {?>
                    <li><a href="../view/inicio.html.php?mod=act">Actualizar</a></li>
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


