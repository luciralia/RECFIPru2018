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
	
function tblProy($idlab)
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
				            $salida.='<input name="div" type="hidden" value="' .$idlab. '" />';
							$salida.='<input name="mod" type="hidden" value="' .$mod. '" />';
							echo $salida;
			}//finmetodo
	
	function selnec ($idnec,$idlab,$edo){
		
		if ($edo=='new'){
			
			//no permite elejir una necesidad previamente asociada a un proyecto_nec
			$query="SELECT id_nec, id_lab,descripcion FROM necesidades_equipo 
            WHERE id_lab=" . $idlab. "
            EXCEPT
            SELECT ne.id_nec,ne.id_lab,descripcion 
            FROM necesidades_equipo ne
            JOIN proyecto_nec pn
            ON ne.id_lab=pn.id_lab
            AND ne.id_nec=pn.id_nec
            WHERE pn.id_lab=" . $idlab;
		   
			
			}else if ($edo=='ed') {
			
			//Permite elejir cualquier necesidad previamente 
			$query="SELECT id_nec, id_lab,descripcion FROM necesidades_equipo 
            WHERE id_lab=" . $idlab ."
			EXCEPT 
			SELECT ne.id_nec,ne.id_lab,descripcion 
			FROM proy p
            LEFT JOIN proyecto_nec pn
            ON pn.id_proy=p.id_proy
            LEFT JOIN necesidades_equipo ne
            ON ne.id_lab=pn.id_lab
            AND ne.id_nec=pn.id_nec
			WHERE pn.id_lab=". $idlab;
			
		}
		
		   $result_opc = pg_query($query) or die('Hubo un error con la base de datos');
		   $salida='<table class="equipob"><br><br><tr><th>Requerimientos</th><th>Seleccionar</th></tr>'; 
		   $j=1;
		
		
		
		   $querysel= "SELECT  ne.id_nec
			                FROM proy p
                            JOIN proyecto_nec pn
                            ON pn.id_proy=p.id_proy
                            JOIN necesidades_equipo ne
                            ON ne.id_lab=pn.id_lab
                            AND ne.id_nec=pn.id_nec
			                WHERE pn.id_lab=". $idlab;
				            $result = pg_query($querysel) or die('Hubo un error con la base de datos');
		   
		   $nec=array();
		   $count=0;
		   $valor=1;
		   while ($row = pg_fetch_array($result)) {
              $nec[$cont] = $row['id_nec'];
              $cont++;
			  $valor++; 
            }
		
		  
		   while ($datosc = pg_fetch_array($result_opc))
		   {
			    $nombrechk="id_nec_".$j;
			    $auxcheck= ' checked="checked"';
			   
				echo $valor;
			   
					if ($valor==$datosc['id_nec'])
			         $salida.='<tr><td>'. $datosc['descripcion']. '</td><td>		
			         <input type="checkbox" name="'. $nombrechk .'" value="'. $datosc['id_nec'] .'" '. $auxcheck .'
				     </tr>';
			
				  else 
				 $salida.='<tr><td>'. $datosc['descripcion']. '</td><td>		
			      <input type="checkbox" name="'. $nombrechk .'" value="'. $datosc['id_nec'] .'" 
				  </tr>';
				
				//foreach $datosnec
				$j++;
				}
				$salida.='</table><br> <input name="j" type="hidden" value="' .$j. '" />';
				echo $salida;
		
	      } //$salida.='<tr><td>'. $datosc['descripcion']. '</td><td>
	//<input type="checkbox" name="'. $nombrechk .'" value="'. $datosc['id_nec'] .'" '. $auxcheck .'
			     
					
	function cmbCotiza($idlab,$tipo_req,$id_cot)
					{

				        
				        $query="Select * from cotizaciones where id_lab=" . $idlab . " and tipo='" . $tipo_req . "' order by id_cotizacion";
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
				
}
	
	


?>