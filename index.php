<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="css/styles_general.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" type="image/gif" href="images/favicon_cpd.gif" />
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
<?php require_once('config.php');?>
<title><?php echo TITULO . " " . VERSION ?></title>
</head>

<body>
<?php

function getBrowser($user_agent){

if(strpos($user_agent, 'MSIE') !== FALSE) //'Internet explorer'
   return 1;
 elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
   return 2;
 elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
    return 3;
 elseif(strpos($user_agent, 'Opera Mini') !== FALSE) //Opera Mini
   return 4;
 elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE) //Opera
   return 5;
 elseif(strpos($user_agent, 'Firefox') !== FALSE)//Mozilla FireFox
   return 6;
 elseif(strpos($user_agent, 'Chrome') !== FALSE)//Google Chrome
   return 7;
 elseif(strpos($user_agent, 'Safari') !== FALSE) // Safari
   return 8;
 else
   return 0;


}

$navegador=getBrowser($_SERVER['HTTP_USER_AGENT']);

//echo $navegador;


?>
<?php //require_once('inc/encabezado.inc.php');  ?>


<table width="1024" border="0" cellpadding="1" class="principal">
  <tr>
    <td><img src="images/banner_principalsin.jpg" width="1024" height="103" /></td>
  </tr>
  
   <td>&nbsp;</td> <td>&nbsp;</td>
 <tr><td>&nbsp;</td> <td>&nbsp;</td></tr>
 
   
      <table align="center" width="1000" border="1" cellspacing="5" class="login2">
     
        <tr>
          <td font-size="11pt" >
           <p> Bienvenido al Registro de Equipos de Cómputo de la  Facultad de Ingeniería (RECFI), sistema que facilita la gestión de inventarios de las diferentes áreas y la realización del censo de cómputo anual de la Facultad de Ingeniería de la Universidad Nacional Autónoma de México.<br />
Para acceder al RECFI, ingrese el usuario y contraseña que se le proporcionó como miembro del Comité Asesor de Cómputo de la Facultad de Ingeniería.</p>
         </td>
         </tr>
        </table>
        <br />
        
         <td>&nbsp;</td><td>&nbsp;</td> <td>&nbsp;</td><td>&nbsp;</td>
 
  
          
   <!-- <td align="center">-->
    <table align="center" width="200" cellspacing="0" cellpadding="0" class="login">
      <tr>
        <td align="center" valign="middle">
       <?php $estado='oculto'; ?>        

       <?php 
        if ($_GET['log']=='no'){
   
           $usuario=$_GET['usr'];
           $rusuario=$_GET['usr'];
           $estado='visible';
        }else{
           $usuario='';      
 
         }
		
       ?>
       
   
       
       <form action="mod/autentica.mod.php" method="post" name="formlog">
        <p>&nbsp;</p>
          <table width="300" border="0" cellspacing="5" cellpadding="5">
           <tr>
              <td align="right">Usuario:</td>
              <td><input name="login" type="text" id="login" value="<?php echo $_GET['usr'];  ?>" placeholder="nombre de usuario"/> </td>
           </tr>
           <tr>
              <td align="right">Contraseña:</td>
              <td><input type="password" name="pwd" id="pwd" placeholder="escriba su contraseña"/></td>
           </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="entrar" id="entrar" value="Entrar" /></td>
          </tr>
        </table>
        
        
        </table>
          </form>
           <p>&nbsp;&nbsp;</p>
          <tr>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td align="left"> <img src="images/offices-1181385_1280.jpg" width="200" height="170" alt="Imagen"/></td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>  
             <td align="right"><img src="images/compu.jpg" width="200" height="170" alt="Imagen"/></td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
             <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>  
             <td align="right"><img src="images/classroom.jpg" width="200" height="170" alt="Imagen"/></td>
         </tr> 
        
<?php if ($estado=='visible'){ ?>
        <div  id="bgalerta"></div><div id="advertencia" style="box-shadow: 10px 10px 30px #000000;"><p>El nombre de usuario o contraseña son incorrectos</p><div id="boton1"><a href="./?usr=<?php echo $rusuario; ?>">Cerrar</a></div></div>
       
<?php }

	  ?>
    <?php if ($navegador==7) {
		  // $estado='visible'; 
	   ?>
     
       <br />
        <td>&nbsp;</td>  
        <table align="center">
         <td >
          <div id="resaltado">
              Para una mejor visualización se recomienda evitar el uso de Google Chrome. 
          </div>  
         
         </td>
         </table>
         
<?php }
 ?>
  <p>&nbsp;&nbsp;</p>

</body>
</html>