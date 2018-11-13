<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>


<form action="procesaintra.php" method="post" name="formulariog">
  <p>
  <input name="md5" type="text" size="35" maxlength="15" />
  </p>

  <input name="enviar" type="submit" value="enviare" />      
  <p>&nbsp;</p>
  <p>&nbsp;</p>

            <form action="procesaintra.php" method="post" name="formulario1"> 
		<?php 
		for($i=1;$i<11;$i++){  	        
	           echo '<input name="campo1_' .$i.'" type="hidden" value="valor1_'.$i.'" />';
				
		} ?>
            
              <input name="enviar" type="submit" value="enviari" />
            </form>
             <input name="check1" type="checkbox" value="selchk1" />

            <form action="procesaintra.php" method="post" name="formulario2"> 
		<?php 
		for($i=1;$i<11;$i++){  	        
	           echo '<input name="campo2_' .$i.'" type="hidden" value="valor2_'.$i.'" />';
				
		} ?>
	            
	              <input name="enviar" type="submit" value="enviari" />
            </form>
            <input name="check2" type="checkbox" value="selchk2" />            
                     
           <form action="procesaintra.php" method="post" name="formulario3"> 
		<?php 
		for($i=1;$i<11;$i++){  	        
	           echo '<input name="campo3_' .$i.'" type="hidden" value="valor3_'.$i.'" />';
				
		} ?>
            
              <input name="enviar" type="submit" value="enviari" />
            </form>
            <input name="check3" type="checkbox" value="selchk3" />
  
           <form action="procesaintra.php" method="post" name="formulario4"> 
		<?php 
		for($i=1;$i<11;$i++){  	        
	           echo '<input name="campo4_' .$i.'" type="hidden" value="valor4_'.$i.'" />';
				
		} ?>
            
              <input name="enviar" type="submit" value="enviari" />
            </form>
            <input name="check4" type="checkbox" value="selchk4" />
  
            <form action="procesaintra.php" method="post" name="formulario5"> 
		<?php 
		for($i=1;$i<11;$i++){  	        
	           echo '<input name="campo5_' .$i.'" type="hidden" value="valor5_'.$i.'" />';
				
		} ?>
            
              <input name="enviar" type="submit" value="enviari" />
            </form>
            <input name="check5" type="checkbox" value="selchk5" />            
          

<input name="enviarex" type="button" onclick="this.form.submit()"  value="Enviarex"/>
</form>

<p>&nbsp;</p>
</body>
</html>