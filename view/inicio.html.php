<?php 
require_once('../inc/encabezado.inc.php'); ?>
<!--  <tr>
  <td><?php //require('../inc/menu.inc.php'); ?>&nbsp;</td>
  </tr> -->
  <tr>
  <td><?php require_once('../inc/menu1.inc.php'); ?>      &nbsp;</td>
  </tr>
   <tr>
    <td><?php 
   
    if ($_GET['mod']<>'def' && $_GET['mod']!='imp' && $_GET['mod']!='invg' )
    require_once('../inc/menu_usr.inc.php'); 
	   ?></td>
  </tr>

<tr><td></td><td>&nbsp;</td><td>&nbsp;</td></tr>
    
<tr>


    <td><?php 
		//echo 'En inicio.html';
		//print_r ($_SESSION);
		
		if (!isset($_GET['mod']) || $_GET['mod']=='def')
		include_once("../inc/inicio.inc.php");
		else if ($_GET['mod']=='ced')
		include_once("../view/cedula.html.php");
		else if ($_GET['mod']=='eq')
		include_once("../view/equipamiento.html.php");
		else if ($_GET['mod']=='serv'|| $_GET['mod']=='servi'|| $_GET['mod']=='servibf'|| $_GET['mod']=='servibp')
		include_once("../view/servicios.html.php");
		else if ($_GET['mod']=='mat'||$_POST['mat']=='mat')
		include_once("../view/material.html.php");
		else if ($_GET['mod']=='bit')
		include_once("../bitacora.html.php");
		else if ($_GET['mod']=='pro')
		include_once("../view/proyectos.html.php");
		else if (!isset($_GET['mod'])|| $_GET['mod']=='inv')
		include_once("../view/inventario.html.php");		
		else if (!isset($_GET['mod'])|| $_GET['mod']=='invc')
		include_once("../view/inventario.html.php");	
		else if (!isset($_GET['mod'])|| ($_GET['mod']=='invg' && $_GET['lab']!=NULL)){
		include_once("../view/inventario.html.php");}
		else if (!isset($_GET['mod'])|| ($_GET['mod']=='invg' && $_GET['lab']==NULL)){
		include_once("../view/inventario.html.php");}
		else if (!isset($_GET['lab']) && $_GET['mod']=='invg'){
		include_once("../view/inventario.html.php");}
		//include_once("../inc/cargainvent.inc.php");}
		else if ($_GET['lab']==NULL  && $_GET['mod']=='invg'){
		include_once("../view/inventario.html.php");}
		else if (isset($_GET['lab'])  && $_GET['mod']=='invg'){
		include_once("../view/inventario.html.php");}
		else if ($_GET['mod']=='imp')
		include_once("../view/importamoderror.inc.php");	//modificado para deteectar errores ant importar.html.php
		else if ($_GET['mod']=='cot')
		include_once("../view/cotizaciones.html.php");
		else if ($_GET['mod']=='infr')
		include_once("../view/infraestructura.html.php");
		else if ($_GET['mod']=='mobi')
		include_once("../view/mobiliario.html.php");
		else if ($_GET['mod']=='doc')
		include_once("../view/documentos.html.php");
		else if ($_GET['mod']=='que')
		include_once("../view/quejas.html.php");
		else if ($_GET['mod']=='ceneceq' || $_GET['mod']=='ceni' || $_GET['mod']=='cened' || $_GET['mod']=='cenert'|| $_GET['mod']=='cenecso'|| $_GET['mod']=='cenecuf'|| $_GET['mod']=='cenecufb' || $_GET['mod']=='cenecar')
		include_once("../view/censo.html.php");
		//else if ($_GET['mod']=='adm')
		//include_once("../view/formularioed.php");
		else if ($_GET['mod']=='ace'){
		include_once("../view/acercade.html.php");
		}else{
//		header("Location: ./");
		header("Location: inicio.html.php");
		echo 'aqui';
		}
	?></td>
</tr>


<?php require('../inc/pie.inc.php'); ?>