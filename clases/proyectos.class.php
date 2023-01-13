<?php
require_once('../conexion.php');
require_once('../clases/requerimientos.class.php');
require_once('../clases/cotiza.class.php');

$obj_req= new Requerimiento();
$obj_cotiza = new Cotiza();


class Proyecto{

function getTipoProyecto($id){
 		switch ($id){
 			case 1:
 			return "Desarrollo";
 			break;
 			case 2:
 			return "Investigación";
 			break;
 			case 3:
 			return "Académico";
 			break;
 			default:
 			return "N/A";
 			break;
 		}
 	}
	
function tblProy($idlab,$iddiv)
			{

				$query = "SELECT DISTINCT id_nec, ne.id_lab AS id_lab, cant, ne.descripcion, prioridad AS id_prio, cpn.descripcion AS plazo, cpn.id as id_plazo, l.nombre as laboratorio, de.nombre AS departamento, dv.nombre AS division, cto_unitario AS costo, act_generales AS actividades, cjn.descripcion AS motivo, cjn.id AS id_just, impacto , id_cotizacion, cto_unitario, ref ,otrajust
                FROM necesidades_equipo ne, laboratorios l, divisiones dv, departamentos de, cat_plazo_nec cpn, cat_juztificacion_nec cjn
                WHERE ne.id_lab=l.id_lab 
                AND l.id_dep=de.id_dep 
                AND de.id_div=dv.id_div 
                AND plazo=cpn.id 
                AND justificacion=cjn.id
                AND ne.id_lab=" . $idlab. 
                "ORDER BY id_nec DESC";						
						
				//echo $query;		
						
						    $result = pg_query($query) or die('Hubo un error con la base de datos');
							
							$salida='<table class="equipo" width="100%" border="0" cellpadding="5">
							<tr>
							<br>
							<th scope="col">Cant.</th>
							<th scope="col">Descripción</th>
							<th scope="col">Unitario (USD)</th>
							<th scope="col">Total(USD)</th>
							<th scope="col">Motivo</th>
							<th scope="col">Prioridad</th>
							<th scope="col">Año</th>
							<th scope="col">Cotización:</th>
							<th scope="col">Seleccionar</th>
							</tr>';
							
						 
														
								$j=1;
								while ($datosc = pg_fetch_array($result, NULL, PGSQL_ASSOC))
								{ 
								$nombrechk="proyecto".$j;
							     $total= $datosc['cant']*$datosc['cto_unitario'] ;
							        $salida.='<tr>
							        <td>'. $datosc['cant'] .'</td>
							        <td>' . $datosc['descripcion'] .'</td>
							        <td>' . $datosc['cto_unitario'] .'</td>
							        <td>' . $total .'</td>
							        <td>' . $datosc['motivo'] .'</td>
							        <td>' . $datosc['id_prio'] . '</td>
							        <td>' . $datosc['plazo'] .'</td>
							        <td>' . $datosc['id_cotizacion'] .'</td>
							        <td><input type="checkbox" name="'. $nombrechk .'" value="'. $datosc['id_evento'].'"  /></td></tr>
									<tr>
    	                                <td colspan="9" align="left">&nbsp;</td>
	                                </tr>
                                    <tr><td colspan="9" align="left"><strong>Justificación</strong></td></tr>
	                                <tr><td colspan="9" align="left" valign="top">' .$datosc['impacto'] .' 
									<br /><hr /> </td> 
									</tr>';
								  
									$j++;  
							
								}
						//	return $salida;
							$salida.='</table> <input name="j" type="hidden" value="' .$j. '" />';
							$salida.='<input name="lab" type="hidden" value="' .$idlab. '" />';
				            $salida.='<input name="div" type="hidden" value="' .$iddiv. '" />';
							$salida.='<input name="mod" type="hidden" value="' .$mod. '" />';
							echo $salida;
			}//finmetodo
	
	function califcrit($idproy){
		$combocal= new Requerimiento();
		
		$query="SELECT DISTINCT c.id_criterio as criterio, texto_criterio, pc.id_calif,justif
                FROM  criterio c
                LEFT JOIN proyecto_criterio pc
                ON c.id_criterio=pc.id_criterio
                LEFT JOIN califica cl
                ON cl.id_calif=pc.id_calif
                LEFT JOIN proyecto_nec pn
                ON pn.id_proy=pc.id_proy
				WHERE pc.id_proy=". $idproy .
			   "ORDER BY c.id_criterio";
		
		$result_crit = pg_query($query) or die('Hubo un error con la base de datos');
		//$inventario= pg_num_rows($result_crit); 
	
	
		$salida='<table class="equipob" width="100%" border="0" cellpadding="40"><br><tr><th>Criterio</th><th>Justificación</th><th>Calificación</th></tr>'; 
		
		$j=1;
	     
		 while ($datosc = pg_fetch_array($result_crit))
		   {
			    $nombrechk="id_justif_".$j;
			    $nombrecrit="id_criterio_".$j;
			    $cal=$datosc['id_calif'];
			   //<input name="'. $nombrecrit .'" type="hidden" value="' .$j. '" />
			
			    $salida.='<tr><td>'.$datosc['texto_criterio']. '</td><td><input name="'. $nombrechk .'" type="text" id="justif" tabindex="8" size="50" value="'.$datosc['justif'].'"/></td><td> <input name="'. $nombrecrit .'" type="hidden" value="' .$j. '" />'.$combocal->cmbcal($cal,$j).'</td>';
				$j++;
			
			}
			$salida.='<input name="j" type="hidden" value="' .$j. '" />';
			echo $salida;
	}
	
	function muestracrit(){
		$combocal= new Requerimiento();
		
		$query="SELECT DISTINCT c.id_criterio as criterio, texto_criterio
                FROM  criterio c
                ORDER BY c.id_criterio";
		
		$result_crit = pg_query($query) or die('Hubo un error con la base de datos');
		
		$inventario= pg_num_rows($result_crit); 
	
	
		$salida='<table class="equipob" width="100%" border="0" cellpadding="40"><br><tr><th>Criterio</th><th>Justificación</th><th>Calificación</th></tr>'; 
		
		$j=1;
	     
		 while ($datosc = pg_fetch_array($result_crit))
		   {
			    $nombrechk="id_justif_".$j;
			    $nombrecrit="id_criterio_".$j;
			    $cal=1;
			   //<input name="'. $nombrecrit .'" type="hidden" value="' .$j. '" />
			 
			   
			    
			    $salida.='<tr><td>'.$datosc['texto_criterio']. '</td><td><input name="'. $nombrechk .'" type="text" id="justif" tabindex="8" size="50"/></td><td> <input name="'. $nombrecrit .'" type="hidden" value="' .$j. '" />'.$combocal->cmbcal($cal,$j).'</td>';
				$j++;
				$cal++;  
			
			}
		
			$salida.='<input name="j" type="hidden" value="' .$j. '" />';
			echo $salida;
	}
	function selnecproy($idproy){
		
		$query="SELECT ne.id_nec, pn.id_lab,ne.descripcion,prioridad,plazo,e.id_evidencia,ruta_evidencia
			                FROM proy p
                            JOIN proyecto_nec pn
                            ON pn.id_proy=p.id_proy
                            JOIN necesidades_equipo ne
                            ON ne.id_lab=pn.id_lab
                            AND ne.id_nec=pn.id_nec
                            LEFT JOIN nec_evid nev
                            ON nev.id_lab=ne.id_lab
							AND nev.id_nec=ne.id_nec
                            LEFT JOIN evidencia e
                            ON e.id_evidencia=nev.id_evidencia
							WHERE p.id_proy=".$idproy ;
		
		echo 'selnecproy'.$query;
		
		 $result_opc = pg_query($query) or die('Hubo un error con la base de datos');
		
		$salida='<table class="equipob"><br><tr><th>Requerimientos</th><th>Prioridad</th><th>Plazo</th><th>Evidencia</th></tr>'; 
	
		$j=1;
		
		 while ($datosc = pg_fetch_array($result_opc))
		   {
			    $nombrechk="id_nec_".$j;
			   
				 $salida.='<tr><td >'. $datosc['descripcion']. '</td><td> '. $datosc['prioridad']. 		
			      '</td><td> ' .$datosc['plazo'].'</td><td><a href="'. $datosc['ruta_evidencia'].'"target="_blank">'. substr($datosc['ruta_evidencia'],strpos($datosc['ruta_evidencia'], "'_'")+19).'</a></td></tr>';
				
				$j++;
				}
		
		 
				$salida.='</table> <input name="j" type="hidden" value="' .$j. '" />';
				echo $salida;
	}
	/*Para validar*/
	function selnecnew($idnec,$idlab){
		
		$query="SELECT id_nec, id_lab,descripcion FROM necesidades_equipo 
            WHERE id_lab=" . $idlab. "
            EXCEPT
            SELECT ne.id_nec,ne.id_lab,descripcion 
            FROM necesidades_equipo ne
            JOIN proyecto_nec pn
            ON ne.id_lab=pn.id_lab
            AND ne.id_nec=pn.id_nec
            WHERE pn.id_lab=" . $idlab;
		
		$result_opc = pg_query($query) or die('Hubo un error con la base de datos');
		
        $inventario = pg_num_rows($result_opc); 
	
	    if ($inventario!=0 ){
		
		$salida='<table class="equipob"><br><br><tr><th>Requerimientos</th><th>Seleccionar</th></tr>'; 
		   $j=1;
		
		 while ($datosc = pg_fetch_array($result_opc))
		   {
			    $nombrechk="id_nec_".$j;
			    $auxcheck= ' checked="checked"';
			    
				 $salida.='<tr><td>'. $datosc['descripcion']. '</td><td>		
			      <input type="checkbox" name="'. $nombrechk .'" value="'. $datosc['id_nec'] .'" 
				  </tr>';
				
				$j++;
				}
				$salida.='</table><br> <input name="j" type="hidden" value="' .$j. '" />';
				
		} else 
			$salida = '<h5>No hay necesidades registradas</h5>';
			
		echo $salida;
		
	}
	
	function selneced ($idnec,$idlab,$idproy){
		
			
			//Permite elejir cualquier necesidad previamente 
			$query="SELECT id_nec, id_lab,descripcion FROM necesidades_equipo 
            WHERE id_lab=" . $idlab; /*."
			EXCEPT 
			SELECT ne.id_nec,ne.id_lab,descripcion 
			FROM proy p
            LEFT JOIN proyecto_nec pn
            ON pn.id_proy=p.id_proy
            LEFT JOIN necesidades_equipo ne
            ON ne.id_lab=pn.id_lab
            AND ne.id_nec=pn.id_nec
			WHERE pn.id_lab=". $idlab;*/
			
		   $result_opc = pg_query($query) or die('Hubo un error con la base de datos');
		 // $salida='<table class="equipob"><br><br><tr><th>Requerimientos</th><th>Seleccionar</th></tr>'; 
		  // $j=1;
		
		
		   
		   $querysel= "SELECT  ne.id_nec, pn.id_lab,descripcion
			                FROM proy p
                            JOIN proyecto_nec pn
                            ON pn.id_proy=p.id_proy
                            JOIN necesidades_equipo ne
                            ON ne.id_lab=pn.id_lab
                            AND ne.id_nec=pn.id_nec
			                WHERE p.id_proy= " . $idproy;  
		
				            $result = pg_query($querysel) or die('Hubo un error con la base de datos');
		   
		   $nec=array();
		   $count=0;
		   $valor=1;
		   while ($row = pg_fetch_array($result)) {
              $nec[$cont] = $row['id_nec'];
              $cont++;
			  $valor++; 
            }
		
		  $desc=array();
		  $opc=array();
		   $i=0;
		   $valori=1;
		   $valorj=1;
		   while ($opcrow = pg_fetch_array($result_opc)){
			   $opc[$i]=$opcrow['id_nec'];
			   $desc[$i]=$opcrow['descripcion'];
			   $i++;
			   $valori++;
			//   $valorj++;
		   }
		
		foreach ($opc as $valori) {
         // echo 'opc',$valori;
         }
	    foreach ($nec as $valor) {
         // echo 'nec',$valor;
         }
		/*foreach ($desc as $valorj) {
          echo 'desc',$valorj;
         }*/
		
		 if($opc){
			
		   $salida='<table class="equipob"><br><br><tr><th>Requerimientos</th><th>Seleccionar</th></tr>'; 
		   $j=1;
			 
		  foreach($opc as $elemento){
			 // foreach($desc as $descripcion){
			 $selected="";
			 $nombrechk="id_nec_".$j;
			  
			 $querynec="SELECT descripcion FROM necesidades_equipo 
             WHERE id_lab=".$idlab. " AND id_nec=" . $elemento;
			  
			 // echo $querynec; 
			$result_nec = pg_query($querynec) or die('Hubo un error con la base de datos');  
			$descripcion=pg_fetch_array($result_nec);
			$edesc=$descripcion[0]; 
			  
			 if(in_array($elemento,$nec)){
				
			    $selected= ' checked="checked"';
			    $salida.='<tr><td>'. $edesc. '</td><td>		
			         <input type="checkbox" name="'. $nombrechk .'" value="'. $elemento .'" '. $selected .'
				     </tr>';
			
		    }else {
				
				 $salida.='<tr><td>'. $edesc . '</td><td>		
			         <input type="checkbox" name="'. $nombrechk .'" value="'. $elemento .'" '. $selected .'
				     </tr>';
			 }
			 $j++;
		  }
					
			$salida.='</table><br> <input name="j" type="hidden" value="' .$j. '" />';
			echo $salida;
		}
	   
	}
	
	function cmbCotiza($idlab,$tipo_req,$id_cot)
					{

				        
				    $query="SELECT * FROM cotizaciones WHERE id_lab=" . $idlab . " AND tipo='" . $tipo_req . "' ORDER BY id_cotizacion";
				        //echo $query ."</br>". $id_cot . "</br>" . $lab;
				
					$result_cot = pg_query($query) or die('Hubo un error con la base de datos');
					
					$salida='<select name="id_cotizacion" id="id_cotizacion">
					<option value="0" >Ninguna</option>'; 
					
					while ($datosc = pg_fetch_array($result_cot))
						{
					if($datosc['id_cotizacion']==$id_cot){
					
						$salida.= "<option value='" . $datosc['id_cotizacion'] . "' selected='selected'>" . $datosc['folio'] . " - " . $datosc['proveedor'] . "</option>";
					
					 } else { 
					
						$salida.="<option value='" . $datosc['id_cotizacion'] . "'>" . $datosc['folio'] . " - " . $datosc['proveedor'] . "</option>";
						
					             }
					
						}
				//	return $salida;
					$salida.="</select>";
					echo $salida;
					} 
	
	function cmbImpacto($idimpac)
					{

				        
				    $query="SELECT * FROM  cat_impacto ORDER BY id_impacto ASC";
				        //echo $query ."</br>". $id_cot . "</br>" . $lab;
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos');
					
					/*$salida='<select name="id_just" id="id_just">
					<option value="0" >Ninguno</option>'; */
					
					$salida='<select name="id_impacto" id="id_impacto">'; 
					
					
					while ($datosc = pg_fetch_array($result))
						{
					if($datosc['id_impacto']==$idimpac){
					
						$salida.= "<option value='" . $datosc['id_impacto'] . "' selected='selected'>" . $datosc['nomb_impacto']. "</option>";
					
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_impacto'] . "'>" . $datosc['nomb_impacto']. "</option>";
						
					    }
					
						}
				//	return $salida;
					$salida.="</select>";
					echo $salida;
					}


function cmbProducto($idprod)
					{

				        
				    $query="SELECT * FROM  cat_producto ORDER BY id_producto asc";
				        //echo $query ."</br>". $id_cot . "</br>" . $lab;
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos');
					
					/*$salida='<select name="id_just" id="id_just">
					<option value="0" >Ninguno</option>'; */
					
					$salida='<select name="id_producto" id="id_producto">'; 
					
					
					while ($datosc = pg_fetch_array($result))
						{
					if($datosc['id_producto']==$idprod){
					
						$salida.= "<option value='" . $datosc['id_producto'] . "' selected='selected'>" . $datosc['nomb_producto']. "</option>";
					
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_producto'] . "'>" . $datosc['nomb_producto']. "</option>";
						
					    }
					
						}
				//	return $salida;
					$salida.="</select>";
					echo $salida;
					}
 

		

}//rtermina la clase
	
	


?>