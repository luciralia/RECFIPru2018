<?php
require_once('../conexion.php');

class Infra{

function getServicio($idserv){

			if ($idserv==NULL||$idserv==0){
			
			$salidac="Ninguna"; 
			
			} else {
			
			$query="Select * from cat_servicios where id_servicio=" . $idserv;
				
				$result = @pg_query($query) or die('Hubo un error con la base de datos en getServicio');
			
				while ($datosc = pg_fetch_array($result))
					{
					$salidac = $datosc['servicio'];
					}
				}
			return $salidac;
			}


function cmbServicio($id_serv)
					{

				        
				        $query="Select * from cat_servicios order by id_servicio";
				        //echo $query ."</br>". $id_serv . "</br>" . $lab;
				
					$result = pg_query($query) or die('Hubo un error con la base de datos');
					
					$salida='<select name="id_servicio" id="id_servicio">
					<option value="0" >Seleccione</option>'; 
					
					while ($datosc = pg_fetch_array($result))
						{
					if($datosc['id_servicio']==$id_serv){
					
						$salida.= "<option value='" . $datosc['id_servicio'] . "' selected='selected'>" .$datosc['servicio'] . "</option>";
					
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_servicio'] . "' >" .$datosc['servicio'] . "</option>";
						
					             }
					
						}
				//	return $salida;
					$salida.="</select>";
					echo $salida;
					} 
				
				} 
	
	?>

