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

<?php //require_once('inc/encabezado.inc.php');  ?>
<table width="1024" border="0" cellpadding="1" class="principal">
  <tr>
    <td><img src="images/banner_principal.jpg" width="1024" height="103" /></td>
  </tr>
  <tr>
    <td align="center"><table width="400" cellspacing="0" cellpadding="0" class="login">
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
            <td align="center">SIELDI</td>

          </tr>
          <tr>
            <td align="center" style="font-size: x-large; color: #333;">En actualización</td>

          </tr>
          <tr>
            <td align="center"><?php //echo VERSION?></td>

          </tr>
        </table>
<?php if ($estado=='visible'){ ?>
        
        
<?php }?>

         </form>
        
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>