
<?php
session_start(); 
require_once('../conexion.php');

require_once('../clases/laboratorios.class.php');

require_once('../clases/log.class.php');


$logger=new Log();

$logger->putLog(7,2);



 if ( $_SESSION['tipo_usuario']==10  &&  $_SESSION['id_div']=='')
		   $_SESSION['id_div']=$_REQUEST['div'];
if ($_SESSION['tipo_usuario']==9)
  $_SESSION['id_div']=$_REQUEST['div'];
  

 if ($_GET['mod']=='censo' ){
 ?>

<br>

<!--<div style="text-align:center;">-->

 <table>
  <tr>
       <legend align="right"> <h3>Censo CATIC</h3>
             <br>
              <form action="../inc/exportaxls_censoeqc.inc.php" method="post" name="ceneceq" >
	               <input name="enviar" type="submit" value="Exportar a Excel" />
                   <input name="lab" type="hidden" value="<?php echo $_GET['lab'];?>" />
              
            
   </tr>  
   </table>
   
   		<?php 
	if ( ($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==9) &&  $_REQUEST['lab'] !=NULL ){	
	
	
  $query= "select count(*) as cuenta from dispositivo d
join laboratorios l
on d.id_lab=l.id_lab
join departamentos dep
on dep.id_dep=l.id_dep
join divisiones dv
on dv.id_div=dep.id_div
join cat_usuario_final cuf
on cuf.usuario_final_clave=d.usuario_final_clave
join cat_dispositivo cd
on cd.dispositivo_clave=d.dispositivo_clave
where dv.id_div=" . $_REQUEST['lab'] . " and d.usuario_final_clave=1
and d.dispositivo_clave=3";
		
	}else
	if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div'] ==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO'OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta,l.nombre DESC";	
			
	}else
	if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div'] !="" ){	
	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			AND id_div=" .$_SESSION['id_div'] . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
		
	}else
	if ( ($_SESSION['tipo_usuario']!=10 && $_SESSION['tipo_usuario']!=1)   && $_SESSION['id_div'] !="" ){
	
	 $query= "select count(*) as cuenta from dispositivo d
              join laboratorios l
              on d.id_lab=l.id_lab
              join departamentos dep
              on dep.id_dep=l.id_dep
              join divisiones dv
              on dv.id_div=dep.id_div
               join cat_usuario_final cuf
on cuf.usuario_final_clave=d.usuario_final_clave
join cat_dispositivo cd
on cd.dispositivo_clave=d.dispositivo_clave
where dv.id_div=" . $_SESSION['id_div'] . " and d.usuario_final_clave=1
and d.dispositivo_clave=3";
	}else if ( ($_SESSION['tipo_usuario']!=10 && $_SESSION['tipo_usuario']!=1)   && $_SESSION['id_div'] =="" )
	{ 
	
	$query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
             AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
	}
	
	//echo $query;
$datos = pg_query($con,$query);
$inventario= pg_num_rows($datos); 
?>
    
   <br> <br>
   
   <table class="material">

   <tr>
              <th width="15%" scope="col">&nbsp;&nbsp;&nbsp;</th>
              <th width="15%" >Estudiantes</th>
              <th width="15%" >Académicos</th>
              <th width="15%" >Investigadores</th>
              <th width="15%" >Administrativos</th>
              <th width="1%" >Total</th>
    </tr>
    </table>  
    <?php
 $cuenta=0;
		while ($lab_invent = pg_fetch_array($datos, NULL,PGSQL_ASSOC)) 
		{ ?>         
  <table class="material">

   <tr>
    <th width="15%">Computadoras de escritorio</th>
    <td width="20%" center><?php echo $lab_invent['cuenta'];?></td>

    <td width="20%">Celda 2</td>

    <td width="20%">Celda 3</td>
    
    <td width="20%">Celda 4</td>

    <td width="15%">Celda 5</td>

  </tr>

  <tr>
    <th width="15%" >Portátiles</th>
    <td width="15%">Celda 4</td>

    <td width="15%">Celda 5</td>

    <td width="15%">Celda 6</td>
    <td width="15%">Celda 7</td>

    <td width="15%">Celda 8</td>

  </tr>
    <tr>
    <th width="15%">Tabletas</th>
    <td width="15%">Celda 9</td>

    <td width="15%">Celda 10</td>

    <td width="15%">Celda 11</td>
    <td width="15%">Celda 12</td>

    <td width="15%">Celda 13</td>
 </tr>
 
    <tr>
    <th width="15%">Equipo Alto Rendimiento</th>
    <td width="15%">Celda 14</td>

    <td width="15%">Celda 15</td>

    <td width="15%">Celda 16</td>
    <td width="15%">Celda 17</td>

    <td width="15%">Celda 18</td>
 </tr>
  <tr>
    <th width="15%">TOTAL</th>
    <td width="15%">Celda 19</td>

    <td width="15%">Celda 20</td>

    <td width="15%">Celda 21</td>
    <td width="15%">Celda 22</td>

    <td width="15%">Celda 24</td>
 </tr>
 
</table>

 <?php

    } // while equipos anteriores a Pentium 4

?>
  <br>

  

	
 <?php     
 }
 // fin de censo de equipo
 

 ?>
 </div>
<br/>
<br/>
