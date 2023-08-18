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
                    // echo $idjust;
				        
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

function cmbRecurso($idrec)
					{

				        
				    $query="SELECT * FROM  cat_recursos_equipo ORDER BY id_recurso asc";
				        //echo $query ."</br>". $id_cot . "</br>" . $lab;
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos');
					
					/*$salida='<select name="id_just" id="id_just">
					<option value="0" >Ninguno</option>'; */
					
					$salida='<select name="id_recurso" id="id_recurso">'; 
					
					
					while ($datosc = pg_fetch_array($result))
						{
					if($datosc['id_recurso']==$idrec){
					
						$salida.= "<option value='" . $datosc['id_recurso'] . "' selected='selected'>" . $datosc['nomb_recurso']. "</option>";
					
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_recurso'] . "'>" . $datosc['nomb_recurso']. "</option>";
						
					    }
					
						}
				//	return $salida;
					$salida.="</select>";
					echo $salida;
					}
	
function comboImpacto($idimpacto)
					{

				        
				    $query="SELECT * FROM  cat_impacto ORDER BY id_impacto asc";
				        //echo $query ."</br>". $id_cot . "</br>" . $lab;
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos');
					
					/*$salida='<select name="id_just" id="id_just">
					<option value="0" >Ninguno</option>'; */
					
					$salida='<select name="id_impacto" id="id_impacto">'; 
					
					
					while ($datosc = pg_fetch_array($result))
						{
					if($datosc['id_impacto']==$idimpacto){
					
						$salida.= "<option value='" . $datosc['id_impacto'] . "' selected='selected'>" . $datosc['nomb_impacto']. "</option>";
					
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_impacto'] . "'>" . $datosc['nomb_impacto']. "</option>";
						
					    }
					
						}
				//	return $salida;
					$salida.="</select>";
					echo $salida;
					}	
function cmbcal($idcalif,$i)
					{
                 $query="SELECT * FROM  califica ORDER BY id_calif asc";
				        //echo $query ."</br>". $id_cot . "</br>" . $lab;
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos');
					
					//$j=1;
				    $nombrechk="id_calif_".$i; 
					$salida='<select name="'. $nombrechk .'" id="id_calif">'; 			
					while ($datosc = pg_fetch_array($result))
						{
					if($datosc['id_calif']==$idcalif)
					    $salida.= "<option value='" . $datosc['id_calif'] . "' selected='selected'>" . $datosc['calif_texto']. "</option>";
				        
					  else 
					    $salida.= "<option value='" . $datosc['id_calif'] . "'>" . $datosc['calif_texto']. "</option>";
							
						//$j++;
						}
				
				//	return $salida;
					
					$salida.="</select>";
					return $salida;
					}
	
	//Para seleccionar funciones disponibles
	
   function selfunc(){
		
		$query="SELECT id_funcion, nomb_funcion FROM cat_funcion ORDER BY nomb_funcion ASC";
                
		$result_opc = pg_query($query) or die('Hubo un error con la base de datos');
		
        $inventario = pg_num_rows($result_opc); 
	
	    if ($inventario!=0 ){
		
		$salida='<table class="equipob"><br><br><tr><th>Funciones</th><th>Seleccionar</th></tr>'; 
		   $j=1;
		
		 while ($datosc = pg_fetch_array($result_opc))
		   {
			    $nombrechk="id_funcion_".$j;
			    $auxcheck= ' checked="checked "';
			    
				 $salida.='<tr><td>'. $datosc['nomb_funcion']. '</td><td>		
			      <input type="checkbox"   name="'. $nombrechk .'" value="'. $datosc['id_funcion'] .'" 
				  </tr>';
				
				$j++;
				}
				$salida.='</table><br> <input name="j" type="hidden" value="' .$j. '" />';
				
		} 
			
		echo $salida;
		
	}
	
	function editaselfunc ($idlabreq){
		
			//Todos las funciones sin seleccionar de la div y además los de las necesidades en edición
			echo 'idlabreq',$idlabreq;
			$query="SELECT id_funcion,nomb_funcion 
			        FROM  cat_funcion cf
                    ORDER BY id_funcion ASC";
		
		    echo 'Query de las funciones no elejidas mas las del proyecto para editar', $query;
		
		    $result_opc = pg_query($query) or die('Hubo un error con la base de datos');
		
		 // $salida='<table class="equipob"><br><br><tr><th>Requerimientos</th><th>Seleccionar</th></tr>'; 
		  // $j=1;
		
		
		   $querysel= "SELECT rf.id_funcion,nomb_funcion FROM requerimiento_lab rl
                JOIN requerimiento_funcion rf
                ON rl.id_lab_req=rf.id_lab_req 
                JOIN cat_funcion cf
                ON cf.id_funcion=rf.id_funcion 
                WHERE rf.id_lab_req= " .$idlabreq; 
		 
		   $result = pg_query($querysel) or die('Hubo un error con la base de datos');
		
		   //Reconoce las necesidades del proyecto a editar
		   $func=array();
		   $count=0;
		   $valor=1;
		   while ($row = pg_fetch_array($result)) {
              $func[$cont] = $row['id_funcion'];
              $cont++;
			  $valor++; 
            }
		   //Identifica las descripciones del proyecto y las disponibles
		
		   $desc=array();
		   $opc=array();
		   $i=0;
		   $valori=1;
		   $valorj=1;
		   while ($opcrow = pg_fetch_array($result_opc)){
			   $opc[$i]=$opcrow['id_funcion'];
			   $desc[$i]=$opcrow['nomb_funcion'];
			   $i++;
			   $valori++;
			   $valorj++;
		   }
		
		foreach ($func as $valor) {
         echo 'func',$valor;
		}
		foreach ($opc as $valori) {
        echo 'opc',$valori;
         }
	    
		foreach ($desc as $valorj) {
          echo 'desc',$valorj;
         }
		
		 if($opc){
			
		   $salida='<table class="equipob">'; 
		   $j=1;
			 
		 foreach($opc as $elemento){
		// foreach($desc as $elemento){
			 $selected="";
			 $nombrechk="id_func_".$j;
			  
			
			  $querynec="SELECT nomb_funcion 
			        FROM  cat_funcion cf WHERE id_funcion=" . $elemento;
				 $result_nec = pg_query($querynec) or die('Hubo un error con la base de datos');  
			     $descripcion=pg_fetch_array($result_nec);
			     $edesc=$descripcion[0]; 
			 
			 if(in_array($elemento, $func)){
				 	 
				 $selected= ' checked="checked"';
			     $salida.='<tr><td>'. $edesc. '</td><td>		
			             <input type="checkbox"  name="'. $nombrechk .'" value="'. $elemento .'" '. $selected .'
				         </tr>';
			 }else {
				 $salida.='<tr><td>'. $edesc . '</td><td>		
			           <input type="checkbox"  name="'. $nombrechk .'" value="'. $elemento .'" '. $selected .'
				       </tr>';
			 }
			 $j++;
			// $i++; 
		  }
					
			$salida.='</table><br> <input name="j" type="hidden" value="' .$j. '" />';
			echo $salida;
		}
	   
	}
	
	//Muestra las funciones seleccionadas
	
	function muestraselfunc($idlabreq){
		
		$query="SELECT rf.id_funcion,nomb_funcion FROM requerimiento_lab rl
                JOIN requerimiento_funcion rf
                ON rl.id_lab_req=rf.id_lab_req 
                JOIN cat_funcion cf
                ON cf.id_funcion=rf.id_funcion 
                WHERE rf.id_lab_req=".$idlabreq;
                
		$result_opc = pg_query($query) or die('Hubo un error con la base de datos');
		
        $inventario = pg_num_rows($result_opc); 
	
	    if ($inventario!=0 ){
		
		$salida='<table class="equipob" style="background-color:#FFFFFF" ><br>'; 
		   $j=1;
		
		 while ($datosc = pg_fetch_array($result_opc))
		   {
			   
			    $nombrechk="id_funcion_".$j;
			    $selected= ' checked="checked"  disabled="disabled"';
			    $salida.='<tr><td>'. $datosc['nomb_funcion']. '</td><td>		
			      <input type="checkbox" name="'. $nombrechk .'" value="'. $datosc['id_funcion'] .'"'. $selected .
				  '</tr>';
				$j++;
				}
				$salida.='</table><br> <input name="j" type="hidden" value="' .$j. '" />';
				
		} 
			
		echo $salida;
		
	}
	function radialcorrimiento($corrim)
    {  if ($corrim == 'Si')
             $auxcheck= ' checked="checked"';	
		 else  if ($corrim == 'No') 
		  	 $auxcheck2=' checked="checked"';
		 
		  $salida='<input type="radio" name="corrimiento"   value="1" '. $auxcheck . ">Si ";  
		  $salida.='<input type="radio" name="corrimiento"   value="0" '. $auxcheck2 . ">No ";  
		   echo $salida;
          
  

} //fin radial corrimiento
 function evidenciaa($idlabr){
	 
	 $query="SELECT ruta_evidencia FROM evidencia e
            LEFT JOIN motivo_evidencia me
            ON e.id_evidencia=me.id_evidencia
            LEFT JOIN requerimiento_just rj
            ON rj.id_req_just=me.id_req_just
            LEFT JOIN requerimiento_lab rl
            ON rl.id_lab_req=rj.id_lab_req
            WHERE rl.id_lab_req=".$idlabr ." AND tipo_Evid='actual'";
	 
	        $result_opc = pg_query($query) or die('Hubo un error con la base de datos');
		$row = pg_fetch_array($result_opc);
  
	$salida=$row['ruta_evidencia'];
	
	return $salida;
 }
 function evidenciai($idlabr){
	 
	 $query="SELECT ruta_evidencia FROM evidencia e
            LEFT JOIN motivo_evidencia me
            ON e.id_evidencia=me.id_evidencia
            LEFT JOIN requerimiento_just rj
            ON rj.id_req_just=me.id_req_just
            LEFT JOIN requerimiento_lab rl
            ON rl.id_lab_req=rj.id_lab_req
            WHERE rl.id_lab_req=".$idlabr ." AND tipo_Evid='infra'";
	 
	        $result_opc = pg_query($query) or die('Hubo un error con la base de datos');
		$row = pg_fetch_array($result_opc);
  
	$salida=$row['ruta_evidencia'];
	
	return $salida;
 }	
	
	
} //termina la clase
	

	?>

