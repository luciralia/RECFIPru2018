
<?php
require_once('../conexion.php');
session_start(); 
class Inventario{

function getModo($idmod){

				if ($idmod==NULL||$idmod==0){
				
				$salidam="Ninguno"; 
				
				} else {
				
				$query="Select * from cat_modo_adq where id_mod=" . $idmod;
					
					$result_mod = pg_query($query) or die('Hubo un error con la base de datos');
				
					while ($datosm = pg_fetch_array($result_mod))
						{
						$salidam = $datosm['modo'];
						}
					}
				return $salidam;
			}


function cmbEquipo($idlab,$bnid)
	{
				//	$idlab=$_POST['_id_lab'];
				//        $tipo_req='eq';
				
				//        $id_cot=$necArray[$_POST['_id_nec']]['id_equipo'];
				if ($_SESSION['tipo_lab']!='e')	
				   {$tabla="equipoc";}
				else 
				   {$tabla="equipo";}
				$query="select e.*, l.id_lab, l.nombre, id_dep,bi.*
				from ".$tabla." e, laboratorios l, bienes_inventario bi
				where e.id_lab=l.id_lab
				AND e.bn_id=bi.bn_id
				AND e.id_lab=" . $idlab . " order by bn_desc asc";
				
						//echo $query ."</br>". $id_cot . "</br>" . $lab;
					
				//	echo $query;
					$result = pg_query($query) or die('Hubo un error con la base de datos');
					
					$salida='<select name="bn_id" id="bn_id">'; 
					
					while ($datosc = pg_fetch_array($result))
						{
				
					$sele=($datosc['bn_id']==$bnid)?" selected='selected'":"";
					$salida.= "<option value='" . $datosc['bn_id'] . "'" .$sele. ">" . $datosc['bn_desc'] . " - " . $datosc['bn_clave'] . "</option>";
			
						}
				//	return $salida;
					$salida.="</select>";
					echo $salida;
	}
	
	
function selectEquipo($desc, $serie, $inv, $marca, $inv_ant){
 		//$where=" WHERE bn_in != NULL";
		
 		if($desc != ''){
 			$array['bn_desc']="bn_desc like '%".$desc."%'";
 		}
 		if($serie != ''){
 			$array['bn_serie']="bn_serie like '%".$serie."%'";
 		}
 		if($inv != ''){
 			$array['bn_clave']="bn_clave like '%".$inv."%'";
 		}
 		if($marca != ''){
 			$array['bn_marca']="bn_marca like '%".$marca."%'";
 		}
		if($inv_ant != ''){
 			$array['bn_anterior']="bn_anterior like '%".$inv_ant."%'";
 		}
		
		$query = "SELECT * FROM bienes_inventario bi WHERE ".implode(" AND ",$array); //." ORDER BY bn_clave";
		//echo 'Consulta inventario bienes';
		//echo $query;
		
		return $query;
		
 	}
	
function selectEquipoInvC($desc, $serie, $inv, $marca, $inv_ant,$lab){
 		//$where=" WHERE bn_in != NULL";
		
		
 		if($desc != ''){
 			$array['bn_desc']="bn_desc like '%".$desc."%'";
 		}
 		if($serie != ''){
 			$array['bn_serie']="bn_serie like '%".$serie."%'";
 		}
 		if($inv != ''){
 			$array['bn_clave']="bn_clave like '%".$inv."%'";
 		}
 		if($marca != ''){
 			$array['bn_marca']="bn_marca like '%".$marca."%'";
 		}
		if($inv_ant != ''){
 			$array['bn_anterior']="bn_anterior like '%".$inv_ant."%'";
 		}
		
		/*$query = "SELECT * FROM  
                bienes_inventario bi
                JOIN dispositivo ec
                ON bi.bn_id=ec.bn_id
                WHERE id_lab=" . $lab . " AND " .implode(" AND ",$array);
		*/
		$query= "SELECT bi.bn_id,* FROM  
                bienes_inventario bi
                left JOIN dispositivo e
                ON bi.bn_id=e.bn_id
                left JOIN cat_dispositivo cd
                ON e.dispositivo_clave=cd.dispositivo_clave
                left JOIN cat_familia cf
                ON e.familia_clave=cf.id_familia
                left JOIN cat_tipo_ram ctr
                ON e.tipo_ram_clave=ctr.id_tipo_ram
                left JOIN cat_tecnologia ct
                ON e.tecnologia_clave=ct.id_tecnologia
                left JOIN cat_sist_oper cso
                ON  e.sist_oper=cso.id_sist_oper
                WHERE id_lab=" . $lab . " AND " .implode(" AND ",$array);
 		
		return $query;
		
 	}	
	
	function selectEquipoInvE($desc, $serie, $inv, $marca, $inv_ant,$lab){
 		//$where=" WHERE bn_in != NULL";
		
		
 		if($desc != ''){
 			$array['bn_desc']="bn_desc like '%".$desc."%'";
 		}
 		if($serie != ''){
 			$array['bn_serie']="bn_serie like '%".$serie."%'";
 		}
 		if($inv != ''){
 			$array['bn_clave']="bn_clave like '%".$inv."%'";
 		}
 		if($marca != ''){
 			$array['bn_marca']="bn_marca like '%".$marca."%'";
 		}
		if($inv_ant != ''){
 			$array['bn_anterior']="bn_anterior like '%".$inv_ant."%'";
 		}
		
		$query = "SELECT * FROM  
                bienes_inventario bi
                left JOIN equipo ec
                ON bi.bn_id=ec.bn_id
                WHERE id_lab=" . $lab . " AND " .implode(" AND ",$array);
		
		
		return $query;
		
 	}	
function selectEquipoGen($desc, $serie, $inv, $marca, $inv_ant){
 		//$where=" WHERE bn_in != NULL";
		
 		if($desc != ''){
 			$array['bn_desc']="bn_desc like '%".$desc."%'";
 		}
 		if($serie != ''){
 			$array['bn_serie']="bn_serie like '%".$serie."%'";
 		}
 		if($inv != ''){
 			$array['bn_clave']="bn_clave like '%".$inv."%'";
 		}
 		if($marca != ''){
 			$array['bn_marca']="bn_marca like '%".$marca."%'";
 		}
		if($inv_ant != ''){
 			$array['bn_anterior']="bn_anterior like '%".$inv_ant."%'";
 		}
		
		$query ="SELECT bi.bn_id,bn_desc,bn_serie,bn_clave,bn_marca,bn_anterior,bn_notas,e.id_lab,d.id_lab,nombre_dispositivo, nombre_so FROM  
                bienes_inventario bi
                FULL OUTER JOIN equipo e
                ON bi.bn_id=e.bn_id
		        FULL OUTER JOIN dispositivo d
		        ON bi.bn_id=d.bn_id
				LEFT JOIN cat_dispositivo cd
				ON cd.dispositivo_clave=d.dispositivo_clave
				LEFT JOIN cat_sist_oper cso
				ON cso.id_sist_oper=d.sist_oper
                 
				WHERE " .implode(" AND ",$array);
		
	
		return $query;
		
 	}		
	
function getAsig($bnid){
	 //echo'bn_id'.$bnid;
	  
  	  
	  if ($_SESSION['tipo_lab']!='e' && ($_GET['mod']=='invc' || $_GET['mod']=='invg'   ) )	
       {$tabla="dispositivo";
	    $query="select e.*, l.id_lab, l.nombre, id_dep,bi.*,*
		from " . $tabla . " e
		left join laboratorios l
		on e.id_lab=l.id_lab
		left join  bienes_inventario bi
		on e.bn_id=bi.bn_id
		where bi.bn_id=" . $bnid;
		$result = pg_query($query) or die('Hubo un error con la base de datos en dispositivo/equipo');
		$inventariod= pg_num_rows($result);
		$dato=pg_fetch_array($result,NULL,PGSQL_ASSOC);
	   }
       elseif ($_SESSION['tipo_lab']=='e' && ($_GET['mod']=='invc' || $_GET['mod']=='invg' ) )
             {$tabla="dispositivo";
			 $query="select e.*, l.id_lab, l.nombre, id_dep,bi.*,*
		from " . $tabla . " e
		left join laboratorios l
		on e.id_lab=l.id_lab
		left join  bienes_inventario bi
		on e.bn_id=bi.bn_id
		where bi.bn_id=" . $bnid;
		$result = pg_query($query) or die('Hubo un error con la base de datos en dispositivo/equipo');
		$inventariod= pg_num_rows($result);
		$dato=pg_fetch_array($result,NULL,PGSQL_ASSOC);
			 }
         else 
             {$tabla="equipo";
			$query="select e.*, l.id_lab, l.nombre, id_dep,bi.*,*
		from " . $tabla . " e
		left join laboratorios l
		on e.id_lab=l.id_lab
		left join  bienes_inventario bi
		on e.bn_id=bi.bn_id
		where bi.bn_id=" . $bnid;
		$result = pg_query($query) or die('Hubo un error con la base de datos en dispositivo/equipo');
		$inventarioex= pg_num_rows($result);
		$dato=pg_fetch_array($result,NULL,PGSQL_ASSOC);
			 }
		
	
			if ($dato['nombre']!=''){
			//echo'p1';
			$asignado=$dato['nombre'];		
			
			} elseif ($_GET['mod']=='invc' && $dato['nombre']==''  ){
			//echo'p2';
			$asignado="Ninguno";
			
			}elseif ($_GET['mod']=='invg' && $inventariod!=0 ){
			if ($dato['id_lab']==NULL)
				$asignado="Ninguno";	
			else {  	
			 $tabla="equipo";$query="select e.*, l.id_lab, l.nombre, id_dep,bi.*,*
		           from " . $tabla . " e
		           left join laboratorios l
		           on e.id_lab=l.id_lab
		           left join  bienes_inventario bi
		           on e.bn_id=bi.bn_id
		           where bi.bn_id=" . $bnid;
				   
			  $result = pg_query($query) or die('Hubo un error con la base de datos en dispositivo/equipo');
			$dato=pg_fetch_array($result,NULL,PGSQL_ASSOC);
			$asignado=$dato['nombre'];
			}
			}
			elseif  ($_GET['mod']=='invg' && $inventariod==0   ){ 
			//echo'p4';
			$tabla="equipo";$query="select e.*, l.id_lab, l.nombre, id_dep,bi.*,*
		           from " . $tabla . " e
		           left join laboratorios l
		           on e.id_lab=l.id_lab
		           left join  bienes_inventario bi
		           on e.bn_id=bi.bn_id
		           where bi.bn_id=" . $bnid;
				   
		    $result = pg_query($query) or die('Hubo un error con la base de datos en dispositivo/equipo');
		    
			$dato=pg_fetch_array($result,NULL,PGSQL_ASSOC);
			if ($dato['id_lab']==NULL)
				$asignado="Ninguno";	
			else 	
			  $asignado=$dato['nombre'];	
			
			}
		
		return $asignado;

}
					
					
function tblEquipo($idlab)
	{
				
				if ($_SESSION['tipo_lab']!='e')	
				   {$tabla="dispositivo";}
				else 
				   {$tabla="equipo";}
				   		
				$query="select e.*, l.id_lab, l.nombre, id_dep,bi.*
				from ".$tabla." e, laboratorios l, bienes_inventario bi
				where e.id_lab=l.id_lab
				AND e.bn_id=bi.bn_id
				AND e.id_lab=" . $idlab . " order by bn_desc asc";
				
				//echo $query ."</br>". $id_cot . "</br>" . $lab;
					
				//	echo $query;
					$result = pg_query($query) or die('Hubo un error con la base de datos en equipo');
					
					$salida='<table class="equipob"><tr><th>No. Inv</th><th>Equipo</th><th>Seleccionar</th></tr>'; 
					
							
						$j=1;
						while ($datosc = pg_fetch_array($result, NULL, PGSQL_ASSOC))
						{ 
						$nombrechk="equipo".$j;
					
						  $salida.='<tr><td>'. $datosc['bn_clave']. '</td><td>' . $datosc['bn_desc'] .'</td><td><input type="checkbox" name="'. $nombrechk .'" value="'. $datosc['bn_id'].'"  /></td></tr>';
							
							$j++;  
					
						}
				//	return $salida;
					$salida.='</table> <input name="j" type="hidden" value="' .$j. '" />';
					echo $salida;
	}//finmetodo	


function combotecnologia($tecnologia,$tipo)
					{
                   
				    $query="Select * from  cat_tecnologia order by nombre_tecnologia asc";
				     
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_tecnologia');
					
					if ($tipo==0){
					$salida='<select name="id_tecnologia" id="id_tecnologia" > ';
					         //<option value="0" > </option>'; 
							 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['nombre_tecnologia']==$tecnologia){
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "' selected='selected'>" . $datosc['nombre_tecnologia']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "'>" . $datosc['nombre_tecnologia']. "</option>";
											  
						}
						
					}//Fin del while
					
					}
					
					if ($tipo==1){
					$salida='<select name="tec_uno" id="tec_uno">;
					         <option value="0" >No existe </option>'; 
							 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_tecnologia']==$tecnologia){
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "' selected='selected'>" . $datosc['nombre_tecnologia']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "'>" . $datosc['nombre_tecnologia']. "</option>";
											  
						}
						
					}//Fin del while
					
					
					}
				   if ($tipo==2){
					$salida='<select name="tec_dos" id="tec_dos">;
					        <option value="0" >No existe </option>'; 
							 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_tecnologia']==$tecnologia){
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "' selected='selected'>" . $datosc['nombre_tecnologia']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "'>" . $datosc['nombre_tecnologia']. "</option>";
											  
						}
						
					}//Fin del while
					
					
					}
				   
				   
				   if ($tipo==3){
					$salida='<select name="tec_tres" id="tec_tres">;
					       <option value="0" >No existe </option>' ; 
							 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_tecnologia']==$tecnologia){
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "' selected='selected'>" . $datosc['nombre_tecnologia']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "'>" . $datosc['nombre_tecnologia']. "</option>";
											  
						}
						
					}//Fin del while
					
					
					}
				   if ($tipo==4){
					$salida='<select name="tec_cuatro" id="tec_cuatro">;
					         <option value="0" > No existe</option>'; 
							 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_tecnologia']==$tecnologia){
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "' selected='selected'>" . $datosc['nombre_tecnologia']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "'>" . $datosc['nombre_tecnologia']. "</option>";
											  
						}
						
					}//Fin del while
					
					
					}
				   
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo comboTecnologia
	
	function combotecnologiades($tecnologia,$tipo)
					{
                   
				    $query="Select * from  cat_tecnologia order by nombre_tecnologia asc";
				     
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_tecnologia');
					
					
					if ($tipo==1){
					$salida='<select name="tec_uno" id="tec_uno" disabled > ;
					         <option value="0" > </option>'; 
							 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_tecnologia']==$tecnologia){
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "' selected='selected'>" . $datosc['nombre_tecnologia']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "'>" . $datosc['nombre_tecnologia']. "</option>";
											  
						}
						
					}//Fin del while
					
					
					}
				   if ($tipo==2){
					$salida='<select name="tec_dos" id="tec_dos" disabled>;
					        <option value="0" > </option>'; 
							 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_tecnologia']==$tecnologia){
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "' selected='selected'>" . $datosc['nombre_tecnologia']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "'>" . $datosc['nombre_tecnologia']. "</option>";
											  
						}
						
					}//Fin del while
					
					
					}
				   
				   
				   if ($tipo==3){
					$salida='<select name="tec_tres" id="tec_tres" disabled >;
					       <option value="0" > </option>' ; 
							 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_tecnologia']==$tecnologia){
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "' selected='selected'>" . $datosc['nombre_tecnologia']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "'>" . $datosc['nombre_tecnologia']. "</option>";
											  
						}
						
					}//Fin del while
					
					
					}
				   if ($tipo==4){
					$salida='<select name="tec_cuatro" id="tec_cuatro" disabled >;
					         <option value="0" > </option>'; 
							 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_tecnologia']==$tecnologia){
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "' selected='selected'>" . $datosc['nombre_tecnologia']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "'>" . $datosc['nombre_tecnologia']. "</option>";
											  
						}
						
					}//Fin del while
					
					
					}
				   
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combotecnologiadesactivada
	
	function comboadq($adq)
					{
                    
				    $query="Select * from  cat_modo_adq order by modo asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_modo_adq');
					
					$salida='<select name="id_mod" id="id_mod">;
					         <option value="0" >Ninguno</option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_mod']==$adq){
					
						  $salida.= "<option value='" . $datosc['id_mod'] . "' selected='selected'>" . $datosc['modo']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_mod'] . "'>" . $datosc['modo']. "</option>";
											  
						}
						
					}//Fin del while
						
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	modo adquisición	
	

	
function combodispositivo($dispositivo)
					{
                    
				    $query="Select * from  cat_dispositivo order by nombre_dispositivo asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_dispositivo');
					
					$salida='<select name="dispositivo_clave" id="dispositivo_clave">';
					        // <option value="0" >Ninguna</option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['dispositivo_clave']==$dispositivo){
					
						  $salida.= "<option value='" . $datosc['dispositivo_clave'] . "' selected='selected'>" . $datosc['nombre_dispositivo']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['dispositivo_clave'] . "'>" . $datosc['nombre_dispositivo']. "</option>";
											  
						}
						
					}//Fin del while
						
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	dispositivo	
	
	function combomemoriaram($memoriaram)
					{
                  
				    $query="Select * from  cat_memoria_ram order by id_mem_ram asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_memoria_ram');
					
					$salida='<select name="id_mem_ram" id="id_mem_ram">';
					        // <option value="0" >Ninguna</option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['cantidad_ram']==$memoriaram){
					
						  $salida.= "<option value='" . $datosc['id_mem_ram'] . "' selected='selected'>" . $datosc['cantidad_ram']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_mem_ram'] . "'>" . $datosc['cantidad_ram']. "</option>";
											  
						}
						
					}//Fin del while
						
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	memoriaRAm
	
	function comboesquema($esquema,$tipo)
					{
                    
				    $query="Select * from  cat_esquema order by id_esquema asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_esquema');
					if ($tipo==1) {
					$salida='<select name="esquema_uno" id="esquema_uno">';
					         //<option value="0" > </option>'; 
					
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_esquema']==$esquema){
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "' selected='selected'>" . $datosc['nombre_esquema']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "'>" . $datosc['nombre_esquema']. "</option>";
											  
						}
						
					}//Fin del while
					}
					if ($tipo==2) {
					$salida='<select name="esquema_dos" id="esquema_dos">';
					        // <option value="0" > </option>'; 
					
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_esquema']==$esquema){
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "' selected='selected'>" . $datosc['nombre_esquema']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "'>" . $datosc['nombre_esquema']. "</option>";
											  
						}
					
					}//Fin del while
					}
						if ($tipo==3) {
					$salida='<select name="esquema_tres" id="esquema_tres">';
					        // <option value="0" > </option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_esquema']==$esquema){
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "' selected='selected'>" . $datosc['nombre_esquema']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "'>" . $datosc['nombre_esquema']. "</option>";
											  
						}
						
					}//Fin del while
					}
					if ($tipo==4) {
					$salida='<select name="esquema_cuatro" id="esquema_cuatro">';
					   //     <option value="0" > </option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_esquema']==$esquema){
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "' selected='selected'>" . $datosc['nombre_esquema']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "'>" . $datosc['nombre_esquema']. "</option>";
											  
						}
						
					}//Fin del while
					}
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	esquema
	function comboesquemades($esquema,$tipo)
					{
                    
				    $query="Select * from  cat_esquema order by id_esquema asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_esquema');
					if ($tipo==1) {
					$salida='<select name="esquema_uno" id="esquema_uno" disabled >';
					         //<option value="0" > </option>'; 
					
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_esquema']==$esquema){
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "' selected='selected'>" . $datosc['nombre_esquema']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "'>" . $datosc['nombre_esquema']. "</option>";
											  
						}
						
					}//Fin del while
					}
					if ($tipo==2) {
					$salida='<select name="esquema_dos" id="esquema_dos" disabled>';
					        // <option value="0" > </option>'; 
					
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_esquema']==$esquema){
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "' selected='selected'>" . $datosc['nombre_esquema']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "'>" . $datosc['nombre_esquema']. "</option>";
											  
						}
					
					}//Fin del while
					}
						if ($tipo==3) {
					$salida='<select name="esquema_tres" id="esquema_tres" disabled>';
					        // <option value="0" > </option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_esquema']==$esquema){
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "' selected='selected'>" . $datosc['nombre_esquema']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "'>" . $datosc['nombre_esquema']. "</option>";
											  
						}
						
					}//Fin del while
					}
					if ($tipo==4) {
					$salida='<select name="esquema_cuatro" id="esquema_cuatro" disabled>';
					   //     <option value="0" > </option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_esquema']==$esquema){
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "' selected='selected'>" . $datosc['nombre_esquema']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_esquema'] . "'>" . $datosc['nombre_esquema']. "</option>";
											  
						}
						
					}//Fin del while
					}
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	esquema
	function combousuariofinal($ufinal)
					{
                  
				    $query="Select * from  cat_usuario_final order by tipo_usuario asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_usuariofinal');
					
					$salida='<select name="usuario_final_clave" id="usuario_final_clave">';
					         //<option value="0" >Ninguna</option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['usuario_final_clave']==$ufinal){
					
						  $salida.= "<option value='" . $datosc['usuario_final_clave'] . "' selected='selected'>" . $datosc['tipo_usuario']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['usuario_final_clave'] . "'>" . $datosc['tipo_usuario']. "</option>";
											  
						}
						
					}//Fin del while
						
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	usuario final	

function combousuarioperfil($uperfil)
					{
					
                     //echo $uperfil;
				    $query="Select * from  cat_usuario_perfil order by nombre_perfil asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_usuario_perfil');
					
					$salida='<select name="id_usuario_perfil" id="id_usuario_perfil" required >';
					     //    <option value="0" >Ninguna</option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_usuario_perfil']==$uperfil){
					
						  $salida.= "<option value='" . $datosc['id_usuario_perfil'] . "' selected='selected'>" . $datosc['nombre_perfil']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_usuario_perfil'] . "'>" . $datosc['nombre_perfil']. "</option>";
											  
						}
						
					}//Fin del while
						
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	usuario perfil	
	
	function combousuariosector($usector)
					{
                    //echo $usector;
				    $query="Select * from  cat_usuario_sector order by nombre_sector asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_usuario_sector');
					
					$salida='<select name="id_usuario_sector" id="id_usuario_sector" required >';
					        // <option value="0" >Ninguna</option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_usuario_sector']==$usector){
					
						  $salida.= "<option value='" . $datosc['id_usuario_sector'] . "' selected='selected'>" . $datosc['nombre_sector']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_usuario_sector'] . "'>" . $datosc['nombre_sector']. "</option>";
											  
						}
						
					}//Fin del while
						
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	usuario sector	
		
function combosistemao($so)
					{
						
				    $query="Select * from  cat_sist_oper order by nombre_so asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_sist_oper');
					
					$salida='<select name="id_sist_oper" id="id_sist_oper">';
					        // <option value="0" > </option>'; 
					
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['nombre_so']==$so){
					
						$salida.= "<option value='" . $datosc['id_sist_oper'] . "' selected='selected'>" . $datosc['nombre_so']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_sist_oper'] . "'>" . $datosc['nombre_so']. "</option>";
											  
						}
						
					}//Fin del while
					
					$salida.="</select>";
					echo $salida;
					
	}//fin del metodo combo	sistema operativo
	
function combofamilia($familia)
					{
                 
				   // echo $procesador;    
				    $query="Select * from  cat_familia order by nombre_familia asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_familia');
					
					$cambio='myFunctionFamilia()" ';
					$salida='<select name="id_familia" id="id_familia" onchange="' .$cambio . '>' .
					        '<option value="0" > Otra </option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['nombre_familia']==$familia){
					
						$salida.= "<option value='" . $datosc['id_familia'] . "' selected='selected'>" . $datosc['nombre_familia']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_familia'] . "'>" . $datosc['nombre_familia']. "</option>";
											  
						}
						
					}//Fin del while
					
					$salida.= "</select>";
					
					echo $salida;
					
	}//fin del metodo combo	familia	

function combomarca($marca)
					{
                   
				    $query="Select * from  cat_marca order by descmarca asc";
				     
				    $cambio='myFunctionMarca()" ';
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_marca');
					
					$salida='<select name="id_marca" id="id_marca" onchange="' .$cambio . '>' . '
					         <option value="0" >Otra</option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['descmarca']==$marca){
					
						$salida.= "<option value='" . $datosc['id_marca'] . "' selected='selected'>" . $datosc['descmarca']. "</option>";
					 
					 } else { 
					
						$salida.= "<option value='" . $datosc['id_marca'] . "'>" . $datosc['descmarca']. "</option>";
											  
						}
						
					}//Fin del while
					
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	marca	
	
function combotipoMemoria($tipomemoria)
					{
                  
				    $query="Select * from  cat_tipo_ram order by nombre_tipo_ram asc";
				     
				      $cambio='myFunctionMemoria()" ';
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_tipo_ram');
					
					$salida='<select name="id_tipo_ram" id="id_tipo_ram" onchange="' .$cambio . '>' . '
					         <option value="0" >Otra </option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['nombre_tipo_ram']==$tipomemoria){
					
						  $salida.= "<option value='" . $datosc['id_tipo_ram'] . "' selected='selected'>" . $datosc['nombre_tipo_ram']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_tipo_ram'] . "'>" . $datosc['nombre_tipo_ram']. "</option>";
											  
						}
						
					}//Fin del while
						
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	tipo memoria	


	
function comboelementos($elemento)
					{
                  
				    $query="Select * from  cat_num_elemento order by id_elemento asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_num_elemento');
					
					$salida='<select name="id_elemento" id="id_elemento">';
					         //<option value="0" >Ninguno</option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_elemento']==$elemento){
					
						  $salida.= "<option value='" . $datosc['id_elemento'] . "' selected='selected'>" . $datosc['numeroelem']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_elemento'] . "'>" . $datosc['numeroelem']. "</option>";
											  
						}
						
					}//Fin del while
						
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	num disco	
	
	
function comboarreglo($arreglo)
					{
                   
				        
				    $query="Select * from  cat_num_arreglo order by num_arreglos asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_num_arreglo');
					
					$cambio='myFunctionArreglos()" ';
					$salida='<select name="id_arreglo" id="id_arreglo" onchange="'. $cambio . '>';
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['num_arreglos']==$arreglo){
					
						  $salida.= "<option value='" . $datosc['id_arreglo'] . "' selected='selected'>" . $datosc['num_arreglos']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_arreglo'] . "'>" . $datosc['num_arreglos']. "</option>";
											  
						}
						
					}//Fin del while
						
				//	return $salida;
				  
				   
					$salida.= "</select >"  ;
					
					echo $salida;
				   
	}//fin del metodo combo	num disco	
	
function combotecom($teccom)
					{
                  
				    $query="Select * from  cat_tec_com order by nombre_tec_com asc";
				     
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_tec_com');
					$cambio='myFunctionTecCom()" ';
					$salida='<select name="id_tec_com" id="id_tec_com" onchange="' .$cambio . '>' . '
					         <option value="0" >Otra </option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_tec_com']==$teccom){
					
						  $salida.= "<option value='" . $datosc['id_tec_com'] . "' selected='selected'>" . $datosc['nombre_tec_com']. "</option>";
					 
					 } else { 
					
						  $salida.= "<option value='" . $datosc['id_tec_com'] . "'>" . $datosc['nombre_tec_com']. "</option>";
											  
						}
						
					}//Fin del while
						
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	teccom	
	
	function checklicencia($licencia)
{         
          echo'llega de licencia';
		  echo $licencia;
       
          $query="Select * from  cat_licencia order by id_licencia asc";
		  
		  $result = @pg_query($query) or die('Hubo un error con la base de datos en cat_licencia');
		 
		
			        $salida='<input type="checkbox" name="licencia" ';  
		  $etiqueta='Permanente';
		        if($datosc['id_licencia']==$licencia){
			        
					//$salida.= " value='" . $datosc['id_licencia']   '> " . $etiqueta >;
				
		        }
				 
			
		echo $salida;
     /*     
	 if($datosc['servidor']==$servidor){
					
					$salida.= " value='" . $etiqueta . "' checked=''. checked . '>".$etieut ;
					
		        } else { 
					
					$salida.= " value='" . $etiqueta . "'>" .$etiqueta;
		*/	
} //fin radial licencia

function radialtorendimiento($altorend)
{  
	      

		  if ($altorend == 'Si'){ 

			$auxcheck= ' checked="checked"';	
			
				 
		  } elseif ($altorend == 'No'){ 
		  			
		  $auxcheck2=' checked="checked"';
		 
		  
		  } else {
			 
		  }
		  
		  	  
		  $salida='<label><input type="radio" name="equipoaltorend" value="Si" '. $auxcheck . ">Sí</label>";  
		  $salida.='<label><input type="radio" name="equipoaltorend" value="No" '. $auxcheck2 . ">No</label>";  
		  

		  /*if($datosc['altorendimiento']==$altorend){
			       
				   $salida.= " value='" . $datosc['altorendimiento'] . "' checked=''. checked . '>".$datosc['altorendimiento'];
					 } else { 
					
						  $salida.= " value='" . $datosc['altorendimiento'] . " '>" .$datosc['altorendimiento'] ;
						}*/
			
			echo $salida;
          
  //        }// fin del while

} //fin radial alto Rendimiento

function radialarquitectura($arquitectura)
{         
        
          $query="Select * from  cat_arquitectura order by id_arquitectura asc";
		  
		  $result = @pg_query($query) or die('Hubo un error con la base de datos en cat_arquitectura');
		 
		  while ($datosc = pg_fetch_array($result))
		  {
			   $salida='<input type="radio" name="arquitectura" ';  
		  
		        if($datosc['arquitectura']==(integer)$arquitectura){
			        
					$salida.= " value='" . $datosc['arquitectura'] . "' checked=''. checked . '>".$datosc['arquitectura'];
		        } else { 
					
					$salida.= "value='" . $datosc['arquitectura'] . " '>" .$datosc['arquitectura'];
				}
				 
			
		echo $salida;
          
		}
			
} //fin radial arquitectura



function radialservidor($servidor)   
{        
          $query="Select * from  cat_servidor order by id_servidor desc";
		  
		  $result = @pg_query($query) or die('Hubo un error con la base de datos en cat_servidor');
		 
		  while ($datosc = pg_fetch_array($result))
		  {
			       $salida='<input type="radio" name="servidor" '; 
					
					if ($datosc['id_servidor']==1)
						$etiqueta='No';
					else 
						$etiqueta='Si';
						
		       
		        if($datosc['servidor']==$servidor){
					
					$salida.= " value='" . $etiqueta . "' checked=''. checked . '>".$etiqueta ;
					
		        } else { 
					
					$salida.= " value='" . $etiqueta . "'>" .$etiqueta;
					
				}
		
		echo $salida;
    	}
			
} //fin radial servidor

	
function verificaTipoEquipo($bien)
		{
			if($bien<>9 && $bien<>10 && $bien<>11 ){
					$salida=1 ;}
			else { $salida=0;}		
					return $salida;
		
		}//fin metodo



} // fin de clase

?>

