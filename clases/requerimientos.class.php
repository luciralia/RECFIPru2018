<?php
require_once('../conexion.php');

class Requerimiento{

function getJustEq($id_just,$col){

			if ($id_just==NULL||$id_just==0){
			
			$salidac = array();
			$salidac['descripcion']="Ninguno"; 
			
			} else {
			
			$query="SELECT * FROM  cat_juztificacion_nec WHERE id=" . $id_just;
				
				$result = @pg_query($query) or die('Hubo un error con la base de datos');
			
				while ($datosc = pg_fetch_array($result,NULL, PGSQL_ASSOC))
					{
					foreach($datosc as $columna => $valor)
					   $salidac[$columna] = $valor;
					}
				}
			return $salidac[$col];
			}


function getJustMat($id_just,$col){

			if ($id_just==NULL||$id_just==0){
			
			$salidac = array();
			$salidac['descripcion']="Ninguno"; 
			
			} else {
			
			$query="SELECT * FROM  cat_just_mat WHERE id=" . $id_just;
				
				$result = @pg_query($query) or die('Hubo un error con la base de datos');
			
				while ($datosc = pg_fetch_array($result,NULL, PGSQL_ASSOC))
					{
					foreach($datosc as $columna => $valor)
					   $salidac[$columna] = $valor;
					}
				}

			return $salidac[$col];
			}




function cmbJustMat($idjust)
					{

				        
				        $query="SELECT * FROM cat_just_mat ORDER BY id";
				        //echo $query ."</br>". $id_cot . "</br>" . $lab;
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos');
					
					$salida='<select name="id_just" id="id_just">'; 
					
					while ($datosc = pg_fetch_array($result))
						{
					if($datosc['id']==$idjust){
					
						$salida.= "<option value='" . $datosc['id'] . "' selected='selected'>" . $datosc['descripcion']. "</option>";
					
					 } else { 
					
						$salida.= "<option value='" . $datosc['id'] . "'>" . $datosc['descripcion']. "</option>";
						
					             }
					
						}
				//	return $salida;
					$salida.="</select>";
					echo $salida;
					} 
				
				 
	
	function cmbJustEq($idjust)
					{
                     echo $idjust;
				        
				        $query="SELECT * FROM cat_juztificacion_nec ORDER BY id";
				        //echo $query ."</br>". $id_cot . "</br>" . $lab;
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos');
					
					$salida='<select name="id_just" id="id_just" onchange="cargajust(this.value);">'; 
					
					while ($datosc = pg_fetch_array($result))
						{
					if($datosc['id']==$idjust){
					
						$salida.= "<option value='" . $datosc['id'] . "' selected='selected'>" . $datosc['descripcion']. "</option>";
					
					 } else { 
					
						$salida.= "<option value='" . $datosc['id'] . "'>" . $datosc['descripcion']. "</option>";
						
					             }
					
						}
				   //return $salida;
					$salida.="</select>";
					echo $salida;
					} 
				

function getPlazo($id_plazo,$col){

			if ($id_plazo==NULL){
			
			$salidac = array();
			$salidac['descripcion']="Ninguno"; 
			
			} else {
			
			$query="SELECT * FROM  cat_plazo_nec WHERE id=" . $id_plazo;
				
				$result = @pg_query($query) or die('Hubo un error con la base de datos');
			
				while ($datosc = pg_fetch_array($result,NULL, PGSQL_ASSOC))
					{
					foreach($datosc as $columna => $valor)
					   $salidac[$columna] = $valor;
					}
				}
			return $salidac[$col];
			}


function cmbPlazo($idplazo)
					{

				        
				        $query="SELECT * FROM  cat_plazo_nec ORDER BY id desc";
				        //echo $query ."</br>". $id_cot . "</br>" . $lab;
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos');
					
					/*$salida='<select name="id_just" id="id_just">
					<option value="0" >Ninguno</option>'; */
					
					$salida='<select name="id_plazo" id="id_plazo">'; 
					
					
					while ($datosc = pg_fetch_array($result))
						{
					if($datosc['id']==$idplazo){
					
						$salida.= "<option value='" . $datosc['id'] . "' selected='selected'>" . $datosc['descripcion']. "</option>";
					
					 } else { 
					
						$salida.= "<option value='" . $datosc['id'] . "'>" . $datosc['descripcion']. "</option>";
						
					             					  }
					
						}
				//	return $salida;
					$salida.="</select>";
					echo $salida;
					}

function getPrioridad($id_prio,$col){

			if ($id_prio==NULL){
			
			$salidac = array();
			$salidac['descripcion']="Ninguno"; 
			
			} else {
			
			$query="SELECT * FROM  cat_prioridad_nec WHERE id=" . $id_prio;
				
				$result = @pg_query($query) or die('Hubo un error con la base de datos');
			
				while ($datosc = pg_fetch_array($result,NULL, PGSQL_ASSOC))
					{
					foreach($datosc as $columna => $valor)
					   $salidac[$columna] = $valor;
					}
				}
			return $salidac[$col];
			}

function cmbPrioridad($idprio)
					{

				        
				        $query="SELECT * FROM  cat_prioridad_nec ORDER BY id desc";
				        //echo $query ."</br>". $id_cot . "</br>" . $lab;
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos');
					
					/*$salida='<select name="id_just" id="id_just">
					<option value="0" >Ninguno</option>'; */
					
					$salida='<select name="id_prio" id="id_prio">'; 
					
					
					while ($datosc = pg_fetch_array($result))
						{
					if($datosc['id']==$idprio){
					
						$salida.= "<option value='" . $datosc['id'] . "' selected='selected'>" . $datosc['descripcion']. "</option>";
					
					 } else { 
					
						$salida.= "<option value='" . $datosc['id'] . "'>" . $datosc['descripcion']. "</option>";
						
					             					  }
					
						}
				//	return $salida;
					$salida.="</select>";
					echo $salida;
					}



} //termina la clase
	
	
	?>

