<link rel="stylesheet"  type="text/css" href="../css/menu_1.css">
<link rel="stylesheet"  type="text/css" href="../css/menu_usr.css"> 
  
  <?php require_once('../clases/laboratorios.class.php');
        $labNom = new laboratorios();
/*
   echo 'SESSION en menu1.inc';
	print_r($_SESSION);	
	
	echo 'GET en menu1.inc';
	print_r($_GET);	
*/
	
	if ( $_SESSION['id_div']==NULL  )
	       $_SESSION['id_div']=$_GET['div'];
	 elseif ( $_SESSION['tipo_usuario']==10  && $_GET['mod']=='ced')
		 $_SESSION['id_div']='';

	?>

<div id="header">

  <ul class="nav">
 
 	<!-- Boton cedula -->
    <?php $tipo=$labNom->getLaboratorio($_GET['lab']);?>
     <?php 
	 if ($_SESSION['tipo_usuario']==10){   ?>
       	      <!--<li><a href="../view/inicio.html.php?mod=ced" class="actual" >Inicio</a></li>-->
             <li><a href="../view/inicio.html.php?mod=<?php echo $_GET['mod']?>" class="actual" >Inicio</a></li>
        <?php }elseif (($_GET['lab']=='' || $_SESSION['id_div']=='' ) ) { ?>
              <!--<li><a href="../view/inicio.html.php?mod=ced&div=<?php // echo $_SESSION['id_div'];?>" class="actual">Inicio</a></li>-->
              <li><a href="../view/inicio.html.php?mod=<?php echo $_GET['mod']?>&div=<?php  echo $_SESSION['id_div']?>" class="actual">Inicio</a></li>
          <?php      
 	}elseif ($_GET['lab']!=''|| $_GET['div']!=''){   ?>
       	      <!--<li><a href="../view/inicio.html.php?mod=ced&div=<?php  //echo $_SESSION['id_div'];?>" class="actual" >Inicio</a></li>-->
             <li><a href="../view/inicio.html.php?mod=<?php  echo  $_GET['mod'];?>&div=<?php  echo $_SESSION['id_div'];?>" class="actual" >Inicio</a></li>
        <?php }	?>
        <?php  if ($_SESSION['tipo_usuario']!=10){   ?>
        <?php //$clase=($_GET['mod']=='ced')?'" class="actual"':$clase='"'; ?>
          <li><a href="../view/inicio.html.php?mod=ced&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?>"  >Cédula de Información</a></li>
 	 <?php }	?>
	<!-- Boton quejas -->
	<!--<?php $clase=($_GET['mod']=='que')?'" class="actual"':$clase='"'; ?>
	<li><a href="../view/inicio.html.php?mod=que&lab=<?php echo $_GET['lab'];?>" <?php echo $clase;?>Quejas y sugerencias</a></li> -->
                <!-- Botón inventario -->
                <?php $clase=($_GET['mod']=='inv' || $_GET['mod']=='invc' || $_GET['mod']=='invg' || $_GET['mod']=='imp' )?'"  class="actual"':$clase='"'; ?>
      
 	      <li><a href="#" <?php echo $clase;?>>Inventarios</a>
 	      
      	 
          <ul>
           <?php 
				if (isset($_GET['mod']) || isset($_GET['div'] ) ) {
			     //if (isset($_GET['mod']) || ((isset($_GET['div'] ) ) && ( isset($_GET['lab'])) )){
			?>
               <li><a href="../view/inicio.html.php?mod=invg&lab=<?php  echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?> ">General</a></li> 
             <?php 
				 }
			        else if (( $_GET['div']!='' || $_GET['lab']!='' ) && !isset($_GET['mod']) ){
			?>
             <li><a href="../view/inicio.html.php?mod=invg&lab=<?php  echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?> ">**General</a></li>
            <?php 
				 }
				
			 if ($_SESSION['tipo_lab']!='e' && $_GET['lab']!=''  )	 {?>
             
                   <li><a href="../view/inicio.html.php?mod=invc&lab=<?php  echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?> ">Equipos de c&oacute;mputo</a></li>
                   
			<?php } elseif ($_SESSION['tipo_lab']=='e'  && $_GET['lab']!=''  ) {?>
                <!--<li><a href="../view/inicio.html.php?mod=inv&lab=<?php  //echo $_GET['lab'];?>">Equipos experimentales</a></li>-->
                <li><a href="../view/inicio.html.php?mod=invc&lab=<?php  echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?> ">Equipos de c&oacute;mputo</a></li>
    	 <?php } ?> 
         <?php if ($_SESSION['tipo_usuario']==9)	 {?>
                  <!--  <li><a href="../view/inicio.html.php?mod=invear&lab=<?php // echo $_GET['lab'];?>&div=<?php // echo $_SESSION['id_div'];?>">Equipos de Alto Rendimiento</a></li> -->
         <?php } ?> 
         <?php if ($_SESSION['tipo_usuario']==9)	 {?>
                    <li><a href="../view/inicio.html.php?mod=imp&lab=<?php  echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?>">Importar</a></li>
         <?php } ?> 
         <?php // if ($_SESSION['tipo_usuario']==9)	 {?>
            <!--  <li><a href="../view/inicio.html.php?mod=act&lab=<?php  //echo $_GET['lab'];?>&div=<?php // echo $_SESSION['id_div'];?>">Actualizar</a></li> -->        <?php  // } ?> 
     
       </ul>
       </li>
       
    <?php //}
   ?>
    <?php if($_SESSION['tipo_usuario']!=1  ){ ?>
	<?php $clase=($_GET['mod']=='cen' || $_GET['mod']=='ceni' || $_GET['mod']=='cened'|| $_GET['mod']=='cenert'|| $_GET['mod']=='ceneceq'|| $_GET['mod']=='cenecso' || $_GET['mod']=='cenecuf'|| $_GET['mod']=='cenecufb'|| $_GET['mod']=='cenecar')?'" class="actual"':$clase='"'; ?>
	<li><a href="#" <?php echo $clase;?>>Censo</a>
     <?php if( $_GET['lab']!='' || $_SESSION['id_div']!='' || $_GET['div']!='' || $_SESSION['tipo_usuario']==10 ){ ?>
        <ul >
            <li><a href="#">Equipo C&oacute;mputo</a>    <!--Temporal Nivel 1--> 
                  <ul>
                     <li><a href="../view/inicio.html.php?mod=ceneceq&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?>">Estado del Equipo</a></li>
                     <li><a href="../view/inicio.html.php?mod=cenecso&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?>">Sistema Operativo</a></li>
                     <li><a href="../view/inicio.html.php?mod=cenecuf&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?>">Usuario Final</a>
                         <ul>
                              <li><a href="../view/inicio.html.php?mod=cenecufb&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?>">Usuario de Bibliotecas</a> </li>
                         </ul>
                      </li>
                     <li><a href="../view/inicio.html.php?mod=cenecar&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?>">Equipo Alto Rendimiento</a></li>
                   </ul>
             </li>   <!-- Es fin del equipo de Cómputo--> 
            
            <li><a href="../view/inicio.html.php?mod=ceni&lab=<?php  echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?>">Impresoras </a></li>
            <li><a href="../view/inicio.html.php?mod=cened&lab=<?php  echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?>">Equipo Digital</a></li>
            <li><a href="../view/inicio.html.php?mod=cenert&lab=<?php  echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?>">Equipo Redes y Telecomunicaciones</a></li>
            <?php if(($_SESSION['tipo_usuario']==10  || $_SESSION['tipo_usuario']==9) && ( $_GET['lab']=='')){
			//&& ( $_GET['div']!=''  ) ){ 
			?>
            <!--<li><a href="../view/inicio.html.php?mod=censo&lab=<?php echo $_GET['lab'];?>&div=<?php echo $_SESSION['id_div'];?>">CATIC</a></li>-->
			<li><a href="../view/inicio.html.php?mod=censoC&lab=<?php echo $_GET['lab'];?>&div=<?php echo $_SESSION['id_div'];?>">CATIC 2021</a></li> 
          <?php } ?>
         
         </ul>  <!--Fin de equipo de Cómputo-->
    </li>  
    
    <?php 
		 }
	 ?>
     <?php }?>  
<!-- MENU DE EQUIPOS DE ALTO RENDIMIENTO-->
  <?php  //if ($_SESSION['tipo_usuario']==9)	 {
    // $clase=($_GET['mod']=='invear' )?'" class="actual"':$clase='"'; ?>
       
 	     <!--<li><a href="#" <?php //echo $clase;?>>Equipo Alto Rendimiento</a> 
 	      
      	  <ul>-->
           <?php 
				//if (isset($_GET['mod']) || isset($_GET['div'] ) ) {
			  //  if (isset($_GET['mod']) || ((isset($_GET['div'] ) ) && ( isset($_GET['lab'])) )){
			?>
             <!--  <li><a href="../view/inicio.html.php?mod=invear&lab=<?php  //echo $_GET['lab'];?>&div=<?php  //echo $_SESSION['id_div'];?> ">Edición</a></li> 
                <li><a href="../view/inicio.html.php?mod=impear&lab=<?php // echo $_GET['lab'];?>&div=<?php //echo $_SESSION['id_div'];?> ">Importar</a></li> -->
             <?php 
				// }
				
		?>
       <!--  </ul> 
	   </li> -->
      <?php 
			//	 }
				
		?> 
<!-- Fin de menu-->

   
    <!-- Boton equipamiento -->
    <?php if($_SESSION['tipo_usuario']==9 || $_SESSION['tipo_usuario']==10){ ?>

	<?php $clase=($_GET['mod']=='eq')?'" class="actual"':$clase='"'; ?>
    <?php //$actual=($_GET['mod']=='eq')? ' class="actual"':'';?>
	    <li><a href="../view/inicio.html.php?mod=eq&lab=<?php echo  $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?>"  <?php  echo $clase;?>>Equipamiento</a></li>
	<?php }?>
	
    <!-- Botón cotizaciones-->
   <?php if($_SESSION['tipo_usuario']==9){ ?>
	<?php $actual=($_GET['mod']=='cot')? ' class="actual"':'';?>
     <li><li><a href="../view/inicio.html.php?mod=cot&lab=<?php echo  $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?>" <?php echo $actual; ?>>Cotizaciones</a></li>
<?php }?>

  <!-- Boton mantenimiento -->
        <?php if($_SESSION['tipo_usuario']==9 || $_SESSION['tipo_usuario']==10){ ?>
        <?php //if($_SESSION['tipo_usuario']==9 || $_SESSION['tipo_usuario']==10 || $_SESSION['tipo_usuario']==2 || $_SESSION['tipo_usuario']==3 ){ ?>
        <?php $clase=($_GET['mod']=='serv' || $_GET['mod']=='mat' || $_GET['mod']=='mobi' || $_GET['mod']=='infr')?'" class="actual"':$clase='"'; ?>
        <li><a href="#" <?php echo $clase; ?>>Mantenimiento</a>
         <ul>
             <li><a href="../view/inicio.html.php?mod=serv&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?> ">Externo</a></li>
             <li><a href="../view/inicio.html.php?mod=mat&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?> ">Interno (Material)</a></li>
		 </ul>
	  </li>
          <?php }?>
  	
	<!-- Boton Bitacora --> 
    <?php if($_SESSION['tipo_usuario']==9 ){ ?>   	
	<?php if ($_GET['mod']=='servibf'||$_GET['mod']=='servibp') { $clase='" class="actual"'; } else {$clase='"';}?> 
    <li><a href="#" <?php echo $clase; ?>>Bit&aacute;coras</a>
	
    	<ul>
            <!--<li><a href="../view/inicio.html.php?mod=bit&lab=<?php echo $_GET['lab'];?>">Bit&aacute;cora de uso</a></li>	-->
            <li><a href="../view/inicio.html.php?mod=servibf&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?> ">Bit&aacute;cora de falla y mantenimiento correctivo interno</a></li>
            <li><a href="../view/inicio.html.php?mod=servibp&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?> ">Bit&aacute;cora de mantenimiento preventivo interno</a></li>
    	</ul>
	</li>
	<?php }?>



 <?php //if($_SESSION['tipo_usuario']!=8 && $_SESSION['tipo_usuario']!=10 ){ ?>
           <?php $actual=($_GET['mod']=='doc')? ' class="actual"':'';?>
           <li><a href="../view/inicio.html.php?mod=doc&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?>" <?php echo $actual; ?>>Documentos</a></li>
           <?php // }?>
   
 <?php if($_SESSION['tipo_usuario']==9  || $_SESSION['tipo_usuario']==10 ) { ?>
           <?php $actual=($_GET['mod']=='cred')? ' class="actual"':'';?>
  <li><a href="../view/inicio.html.php?mod=cred&lab=<?php echo $_GET['lab'];?>&div=<?php  echo $_SESSION['id_div'];?>" <?php echo $actual; ?>>Créditos</a></li>
  <?php } ?>
    <!-- <li><a href="../view/inicio.html.php?mod=cred" <?php // echo $actual; ?>>Créditos</a></li>-->
    
    <li><a href="../inc/salir.inc.php">Salir</a></li>
    
    
    <?php //if($_SESSION['tipo_usuario']!=8 && $_SESSION['tipo_usuario']!=10 ){ ?>
           <?php $actual=($_GET['mod']=='doc')? ' class="actual"':'';?>
     <?php $actual=($_GET['mod']=='ace')? ' class="actual"':'';?>
     
    <!--<li><a href="../view/inicio.html.php?mod=ace&lab=<?php //echo $_GET['lab'];?>" <?php //echo $actual; ?>>Acerca de...</a></li>-->
    
    <!--<li><a href="#">Documentos</a></li>
      	
   	<li><a href="#">Administración</a></li>-->
    
    <?php //}?>
   
 </ul>
 
</div>


