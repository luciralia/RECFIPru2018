
<?php
require ('../conexion.php');


	
function MenuTres ($pid=0){ 

 
if ($_SESSION['tipo_usuario']!=10){
  if ($_SESSION['tipo_usuario']==1){
     //obtener el departamento 
	
     $querydeptos="SELECT DISTINCT l.id_dep FROM laboratorios l
                   JOIN usuarios u
				   ON l.id_responsable=u.id_usuario
                   WHERE l.id_responsable=" .$_SESSION['id_usuario'];
     $datosdeptos=@pg_query($querydeptos) or die('Hubo un error depsesion');
     //echo $querydeptos;
     $depto = pg_fetch_array($datosdeptos);
     $_SESSION['id_dep']=$depto[0];
   
     //obtener division
     $querydivs="SELECT id_div FROM departamentos d
                WHERE id_dep=" .$_SESSION['id_dep'];
				 
     $datosdivs=@pg_query($querydivs) or die('Hubo un error divsesion');
     //echo $querydivs;
     $div = pg_fetch_array($datosdivs);
     $_SESSION['id_div']=$div[0];
    }
  
      $menu= "<li><a href=\"#\" >Área...</a>
              <ul>";
      if ($_SESSION['tipo_usuario']==10)	
	  	   $querydiv = "SELECT  di.id_div, di.id_responsable, di.nombre as division,  u.nombre, a_paterno, a_materno  
                        FROM  divisiones di
                        JOIN usuarios u   
                        ON di.id_responsable=u.id_usuario";
	  else		   
	  			   
           $querydiv = "SELECT  di.id_div, di.id_responsable, di.nombre as division,  u.nombre, a_paterno, a_materno  
                        FROM  divisiones di
                        JOIN usuarios u   
                        ON di.id_responsable=u.id_usuario
				        WHERE di.id_div=" . $_SESSION['id_div'];
	  
				   // echo $querydiv;
           $datosdiv = @pg_query($querydiv) or die('Hubo un error división ');
  
     //if (empty($datosdiv)){return "";} 
           //echo count($query)."<br/>"; 
	// while ($divisiones =pg_fetch_array($datosdiv)) 
    // {

     if ($_SESSION['tipo_usuario']==1){$consultacomp=" l.id_responsable= ";}
       else if ($_SESSION['tipo_usuario']==7){$consultacomp="di.id_comite= ";} 
          else if($_SESSION['tipo_usuario']==3){$consultacomp="di.id_responsable= ";}
              else if($_SESSION['tipo_usuario']==6){$consultacomp="di.id_secacad= ";}
		    	  else if($_SESSION['tipo_usuario']==9 ){$consultacomp=" c.id_responsable= ";
				                                       $consultadepto= " AND de.id_dep= "; 
													   $consultadiv=" AND di.id_div= ";}                         
			         else if($_SESSION['tipo_usuario']==10){$consultacomp="tipo_lab NOT LIKE 'e' ";
				                                          $consultadepto= "";} 
	  if ($_SESSION['tipo_usuario']!=10 && $_SESSION['tipo_usuario']!=1 ){
       $querycoord = "SELECT  c.id_coord, c.id_responsable,c.nombre as coordinacion, di.nombre  as div,  di.id_div 
                    FROM coordinacion c
                    JOIN divisiones di 
                    ON  c.id_div=di.id_div
                    JOIN usuarios u
                    ON di.id_responsable=u.id_usuario
                    WHERE " . $consultacomp  . $_SESSION['id_usuario'] .
                    $consultadiv . $_SESSION['id_div'].
                   " ORDER BY coordinacion";
				    echo 'coord '. $querycoord;
	  
      $datoscoord = @pg_query($querycoord)  or die('Hubo un error coordinacion');
	
	  }
	         if ($_SESSION['tipo_usuario']!=1){
                while ($coordinaciones = pg_fetch_array($datoscoord)) { 
				     	//deptos
                          if ($_SESSION['tipo_usuario']!=10 ){ 
                             /* $querydeptos = "SELECT  c.id_coord,c.nombre as coordinacion
                                              FROM   departamentos d
                                              JOIN coordinacion c
                                              ON  d.id_coord=c.id_coord
                                              JOIN usuarios u
                                              ON d.id_responsable=u.id_usuario
							                  WHERE " . $consultacomp . $_SESSION['id_usuario'] 
										      . " AND d.id_coord=" .$coordinaciones['id_coord'].
										      $consultadiv . $_SESSION['id_div'].
										      " ORDER BY coordinacion";*/
											  
											  $querydeptos = "SELECT  c.id_coord,c.nombre as coordinacion
                                              FROM  coordinacion c
                                              left  JOIN departamentos d
                                              ON  d.id_coord=c.id_coord
                                              JOIN usuarios u
                                              ON d.id_responsable=u.id_usuario
							                  WHERE " . $consultacomp . $_SESSION['id_usuario'] 
										      . " AND d.id_coord=" .$coordinaciones['id_coord'].
										      
										      " ORDER BY coordinacion";
											  echo 'deptos'.$querydeptos;
                           }
						  
						 // echo $querydepto;
						   $datosdeptos = @pg_query($querydeptos) or die('Hubo un error lab');
						   $coord=strtoupper($coordinaciones['coordinacion']);
                           if (pg_num_rows($datosdeptos)==0 ){//si no tiene hijos imprime la lista 
				   
                             $menu.="<li><a href=\"#\">{$coord}</a></li>"; 
                          }//if (mysql_num_rows($querysub2)==0){ 
                          else{//si tiene hijos empieza a buscarlos  
                             $menu.="<li><a href=\"#\">{$coord}</a><ul>"; 
                              while ($departamentos = pg_fetch_array($datosdeptos)) { 
                                   $menu.="<li><a href=\"../view/inicio.html.php?lab={$laboratorios['id_lab']}&mod={$_GET['mod']}&accion={$_REQUEST['accion']}&div={$_SESSION['id_div']}\">{$laboratorios['laboratorio']}</a></li>"; 
							}//while laboratorios { 
                               $menu.="</ul> </li>";
                          }//else tercer nivel 
                     
                    }//while deptos { 
                 $menu.="</ul>	</li>";
				}else  if ($_SESSION['tipo_usuario']==1){ //para usuario encargado de lab
                              $querylab = "SELECT  l.id_lab,l.nombre as laboratorio
                                           FROM  laboratorios l
                                           JOIN departamentos d
                                           ON l.id_dep=d.id_Dep
										   LEFT JOIN coordinacion c
										   on 
                                           JOIN divisiones di 
                                           ON  d.id_div=di.id_div
                                           JOIN usuarios u
                                           ON di.id_responsable=u.id_usuario
							               WHERE " . $consultacomp . $_SESSION['id_usuario'] 
										  . " AND l.id_dep=" .$_SESSION['id_dep'].
										   " ORDER BY laboratorio";
								$datoslab = @pg_query($querylab) or die('Hubo un error lab');		   
								 while ($laboratorios = pg_fetch_array($datoslab)) { 
                                   $menu.="<li><a href=\"../view/inicio.html.php?lab={$laboratorios['id_lab']}&mod={$_GET['mod']}&accion={$_REQUEST['accion']}&div={$_SESSION['id_div']}\">{$laboratorios['laboratorio']}</a></li>"; 
							}//while laboratorios { 		   
										   
                    }
			
              return $menu; 
				}
}//function Menu ($pid=0,)

$menu=MenuTres(0); 

    $menu="<div id=\"header\"><ul class=\"navu\">$menu</ul>
	 
	</div>";//añade el div y el ul externo y con eso se completa la lista del menu  

    echo $menu;


 if ($_SESSION['lab']!=''&& $_SESSION['mod']!='')
          $_SESSION['lab']=''; 
     
?>


