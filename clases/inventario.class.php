<strong></strong>
<?php
session_start(); 

require_once('../conexion.php');

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
				from ".$tabla." e, laboratorios l, bienes bi
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
		
		$query = "SELECT * FROM bienes_inventario bi WHERE ".implode(" AND ",$array); 
		//." ORDER BY bn_clave";
		//echo 'Consulta inventario bienes';
		//echo $query;
		
		return $query;
		
 	}
	
function selectEquipoInvC($desc, $serie, $inv, $marca, $inv_ant,$lab,$usu,$nivel){
 		//$where=" WHERE bn_in != NULL";
	
		
 		if($desc != ''){
 			$array['bn_desc']="bn_desc LIKE '%".$desc."%'";
 		}
 		if($serie != ''){
 			$array['bn_serie']="bn_serie LIKE '%".$serie."%'";
 		}
 		if($inv != ''){
 			$array['bn_clave']="bn_clave LIKE '%".$inv."%'";
 		}
 		if($marca != ''){
 			$array['bn_marca']="bn_marca LIKR '%".$marca."%'";
 		}
		if($inv_ant != ''){
 			$array['bn_anterior']="bn_anterior LIKE '%".$inv_ant."%'";
 		}
		
		$querytipo="SELECT tipo_usuario FROM usuarios
	                WHERE id_usuario=".$usu;	
		$resulttipo= @pg_query($querytipo) or die('Hubo un error con la base de datos en usuarios');	
		$tipo= pg_fetch_array($resulttipo);
	    $usutipo=$tipo[0];    
		//echo 'quwry typo';              	 
		//echo $tipo[0];
			
    if ($usutipo==1){
		
		$query= "SELECT bi.bn_id,* FROM  
                bienes bi
                LEFT JOIN dispositivo e
                ON bi.bn_id=e.bn_id
                LEFT JOIN cat_dispositivo cd
                ON e.dispositivo_clave=cd.dispositivo_clave
                LEFT JOIN cat_familia cf
                ON e.familia_clave=cf.id_familia
                LEFT JOIN cat_tipo_ram ctr
                ON e.tipo_ram_clave=ctr.id_tipo_ram
                LEFT JOIN cat_tecnologia ct
                ON e.tecnologia_clave=ct.id_tecnologia
                LEFT JOIN cat_sist_oper cso
                ON  e.sist_oper=cso.id_sist_oper
                LEFT JOIN(SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision, id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        on ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                           OR d.id_div=dv.id_div) ) n
                ON n.lab=e.id_lab
                LEFT JOIN usuarios u
                ON n.id_responsable=u.id_usuario
                WHERE n.id_responsable= ".$usu
				. " AND " .implode(" AND ",$array);
               // WHERE id_lab=" . $lab 
	    }
		 if ($usutipo==7){ $consultacomp="di.id_comite=";} 
           else if($usutipo==3){$consultacomp="di.id_responsable=";}
              else if($usutipo==6){$consultacomp="di.id_secacad=";}
			    else if($usutipo==9 ){$consultacomp=" n.id_cac=";}                          
			      else if($usutipo==10){$consultacomp="tipo_lab NOT LIKE 'e' ";}
		
		 if ($usutipo==9){
		
		$query= "SELECT bi.bn_id,* FROM  
                bienes bi
                LEFT JOIN dispositivo e
                ON bi.bn_id=e.bn_id
                LEFT JOIN cat_dispositivo cd
                ON e.dispositivo_clave=cd.dispositivo_clave
                LEFT JOIN cat_familia cf
                ON e.familia_clave=cf.id_familia
                LEFT JOIN cat_tipo_ram ctr
                ON e.tipo_ram_clave=ctr.id_tipo_ram
                LEFT JOIN cat_tecnologia ct
                ON e.tecnologia_clave=ct.id_tecnologia
                LEFT JOIN cat_sist_oper cso
                ON  e.sist_oper=cso.id_sist_oper
                LEFT JOIN(	
                        SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
						    OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                           OR d.id_div=dv.id_div
                        )) n
                ON n.lab=e.id_lab
                LEFT JOIN usuarios u
                ON n.id_responsable=u.id_usuario
                WHERE " . $consultacomp  . $usu . " AND " .implode(" AND ",$array);
		 }
	/*	 
	}if ($nivel==3){
	   if($desc != ''){
 			$array['bn_desc']="bn_desc LIKE '%".$desc."%'";
 		}
 		if($serie != ''){
 			$array['bn_serie']="bn_serie LIKE '%".$serie."%'";
 		}
 		if($inv != ''){
 			$array['bn_clave']="bn_clave LIKE '%".$inv."%'";
 		}
 		if($marca != ''){
 			$array['bn_marca']="bn_marca LIKE '%".$marca."%'";
 		}
		if($inv_ant != ''){
 			$array['bn_anterior']="bn_anterior LIKE '%".$inv_ant."%'";
 		}
		
		$querytipo="SELECT tipo_usuario FROM usuarios
	             WHERE id_usuario=".$usu;	
		$resulttipo= @pg_query($querytipo) or die('Hubo un error con la base de datos en usuarios');	
		$tipo= pg_fetch_array($resulttipo);
	    $usutipo=$tipo[0];    
		//echo 'quwry typo';              	 
		//echo $tipo[0];
			
    if ($usutipo==1){
		
		$query= "SELECT bi.bn_id,* FROM  
                bienes bi
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
                left join laboratorios l
                on e.id_lab=l.id_lab
                left join departamentos de
                on l.id_dep=de.id_dep
				
                left join divisiones di
                on de.id_div=di.id_div
                left join usuarios u
                on l.id_responsable=u.id_usuario
                where l.id_responsable= ".$usu
				. " AND " .implode(" AND ",$array);
               // WHERE id_lab=" . $lab 
	    }
		 if ($usutipo==7){ $consultacomp="di.id_comite=";} 
           else if($usutipo==3){$consultacomp="di.id_responsable=";}
              else if($usutipo==6){$consultacomp="di.id_secacad=";}
			    else if($usutipo==9 ){$consultacomp=" di.id_cac=";}                          
			      else if($usutipo==10){$consultacomp="tipo_lab not like 'e' ";}
		
		 if ($usutipo==9){
		
		$query= "SELECT bi.bn_id,* FROM  
                bienes bi
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
                left join laboratorios l
                on e.id_lab=l.id_lab
                left join departamentos de
                on l.id_dep=de.id_dep
				left join coordinacion co
				on co.id_coord=de.id_coord
                left join divisiones di
                on co.id_div=di.id_div
                left join usuarios u
                on l.id_responsable=u.id_usuario
                where " . $consultacomp  . $usu . " AND " .implode(" AND ",$array);
		 }*/
	
	//}
	//echo $query;
		return $query;
		
 	}	
	
function selectEquipoGen($desc, $serie, $inv, $marca, $inv_ant){
 		//$where=" WHERE bn_in != NULL";
		
 		if($desc != ''){
 			$array['bn_desc']="bn_desc LIKE '%".$desc."%'";
 		}
 		if($serie != ''){
 			$array['bn_serie']="bn_serie LIKE '%".$serie."%'";
 		}
 		if($inv != ''){
 			$array['bn_clave']="bn_clave LIKE '%".$inv."%'";
 		}
 		if($marca != ''){
 			$array['bn_marca']="bn_marca LIKE '%".$marca."%'";
 		}
		if($inv_ant != ''){
 			$array['bn_anterior']="bn_anterior LIKE '%".$inv_ant."%'";
 		}
		
		$query ="SELECT bi.bn_id,bn_desc,bn_serie,bn_clave,bn_marca,bn_anterior,
		        bn_notas,e.id_lab,d.id_lab,nombre_dispositivo, nombre_so 
				FROM  bienes bi
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



function selectEquipoGenDiv($desc, $serie, $inv, $marca, $inv_ant){
 		//$where=" WHERE bn_in != NULL";
		
 		if($desc != ''){
 			$array['bn_desc']="bn_desc LIKE '%".$desc."%'";
 		}
 		if($serie != ''){
 			$array['bn_serie']="bn_serie LIKE '%".$serie."%'";
 		}
 		if($inv != ''){
 			$array['bn_clave']="bn_clave LIKE '%".$inv."%'";
 		}
 		if($marca != ''){
 			$array['bn_marca']="bn_marca LIKE '%".$marca."%'";
 		}
		if($inv_ant != ''){
 			$array['bn_anterior']="bn_anterior LIKE '%".$inv_ant."%'";
 		}
		
		
		$query="SELECT  e.*, n.nomblab AS laboratorio, bi.*,* 
                FROM dispositivo e 
                LEFT JOIN cat_dispositivo cd
                ON e.dispositivo_clave=cd.dispositivo_clave
                LEFT JOIN cat_familia cf
                ON e.familia_clave=cf.id_familia
                LEFT JOIN cat_tipo_ram ctr
                ON e.tipo_ram_clave=ctr.id_tipo_ram
                LEFT JOIN cat_tecnologia ct
                ON e.tecnologia_clave=ct.id_tecnologia
				LEFT JOIN cat_usuario_final cuf
			    ON cuf.usuario_final_clave=e.usuario_final_clave
                LEFT JOIN cat_sist_oper cso
                ON  e.sist_oper=cso.id_sist_oper
                LEFT JOIN cat_marca cm
                ON cm.id_marca=e.id_marca
                LEFT JOIN cat_memoria_ram cmr
                ON e.id_mem_ram=cmr.id_mem_ram
                LEFT JOIN bienes_inventario bi
                ON  e.bn_id = bi.bn_id
		        LEFT JOIN (SELECT l.id_lab AS lab,l.nombre AS nomblab,
                           ac.id_acad,ac.nombre AS academia, 
                           d.id_dep, d.nombre AS depto, 
                           co.id_coord,co.nombre AS coord, 
                           dv.id_div,dv.nombre AS division  
                           FROM laboratorios l
                           LEFT JOIN academia ac
                           ON ac.id_acad=l.id_acad
                           LEFT JOIN departamentos d
                           ON (ac.id_dep=d.id_dep
                               OR l.id_dep=d.id_dep)
                           LEFT JOIN coordinacion co
                           ON (co.id_coord=d.id_coord
                               OR co.id_coord=l.id_coord)
                           LEFT JOIN divisiones dv
                           ON (dv.id_div=co.id_div
                               OR d.id_div=dv.id_div )) n
                           ON n.lab=e.id_lab
                WHERE " .implode( " AND ",$array). " AND n.id_div="; 
		/*
		if ($nivel==2){
		
		$query ="select  e.*, l.nombre as laboratorio, bi.*,* 
                                           from dispositivo e 

                                           left join cat_dispositivo cd
                                           on e.dispositivo_clave=cd.dispositivo_clave
                                           left join cat_familia cf
                                           on e.familia_clave=cf.id_familia
                                           left join cat_tipo_ram ctr
                                           on e.tipo_ram_clave=ctr.id_tipo_ram
                                           left join cat_tecnologia ct
                                           on e.tecnologia_clave=ct.id_tecnologia
										   left join cat_usuario_final cuf
			                               on cuf.usuario_final_clave=e.usuario_final_clave
                                           left join cat_sist_oper cso
                                           on  e.sist_oper=cso.id_sist_oper
                                           left join cat_marca cm
                                           on cm.id_marca=e.id_marca
                                           left join cat_memoria_ram cmr
                                           on e.id_mem_ram=cmr.id_mem_ram
                                           left join bienes_inventario bi
                                           on  e.bn_id = bi.bn_id
                                           left join laboratorios l
                                           on  l.id_lab=e.id_lab
                                           left join departamentos dp
                                            on dp.id_dep=l.id_dep
										
                                            where "
                                            .implode( " AND ",$array). " AND id_div= " ;
		}elseif ($nivel==3){
		$query ="select  e.*, l.nombre as laboratorio, bi.*,* 
                                           from dispositivo e 

                                           left join cat_dispositivo cd
                                           on e.dispositivo_clave=cd.dispositivo_clave
                                           left join cat_familia cf
                                           on e.familia_clave=cf.id_familia
                                           left join cat_tipo_ram ctr
                                           on e.tipo_ram_clave=ctr.id_tipo_ram
                                           left join cat_tecnologia ct
                                           on e.tecnologia_clave=ct.id_tecnologia
										   left join cat_usuario_final cuf
			                               on cuf.usuario_final_clave=e.usuario_final_clave
                                           left join cat_sist_oper cso
                                           on  e.sist_oper=cso.id_sist_oper
                                           left join cat_marca cm
                                           on cm.id_marca=e.id_marca
                                           left join cat_memoria_ram cmr
                                           on e.id_mem_ram=cmr.id_mem_ram
                                           left join bienes_inventario bi
                                           on  e.bn_id = bi.bn_id
                                           left join laboratorios l
                                           on  l.id_lab=e.id_lab
                                           left join departamentos dp
                                           on dp.id_dep=l.id_dep
										   left join coordinacion co
										   on co.id_coord=dp.id_coord
										   where "
                                           .implode( " AND ",$array). " AND id_div= " ;	
			
		}*/
		return $query;
}	

function getAsig($bnid){
	//echo'bn_id'.$bnid;
	 
		
	    $query="SELECT e.*, n.idlab AS idlab, n.nomlab AS lab, n.id_dep, n.nombdivision AS division,bi.*,*
		        FROM dispositivo e
                LEFT JOIN  bienes bi
		        ON e.bn_id=bi.bn_id
		        LEFT JOIN (SELECT l.id_lab AS idlab,l.nombre AS nomlab,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                           OR d.id_div=dv.id_div)) n
                        ON n.idlab=e.id_lab
		         WHERE bi.bn_id=" . $bnid;
				 
		        $result = pg_query($query) or die('Hubo un error con la base de datos en dispositivo/equipo');
		        $inventariod= pg_num_rows($result);
		        $dato=pg_fetch_array($result,NULL,PGSQL_ASSOC);
		        
		 	if ($inventariod==0){			   
	  	      
		        $query="SELECT e.*, n.idlab AS idlab, n.nomlab AS lab, n.id_dep, n.nombdivision AS division,bi.*,*
		        FROM equipo e
                LEFT JOIN  bienes bi
		        ON e.bn_id=bi.bn_id
		        LEFT JOIN (SELECT l.id_lab AS idlab,l.nombre AS nomlab,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div)) n
                        ON n.idlab=e.id_lab
		         WHERE bi.bn_id=" . $bnid;
				 
		             $result = pg_query($query) or die('Hubo un error con la base de datos en dispositivo/equipo');
		             $inventarioex= pg_num_rows($result);
		             $dato=pg_fetch_array($result,NULL,PGSQL_ASSOC);
		
		   
			
		  }
		// echo $query; 
		   
       if ($dato['lab']!='')
			        
			       $asignado=$dato['lab']. ' de la '. $dato['division'];		
				 else 
				   $asignado="Ninguno";
	
	  return $asignado;		   
		  
		  
}//fin de funcion asignado

/*	
function getAsig($bnid){
	//echo'bn_id'.$bnid;
	 
	  if ($_SESSION['tipo_lab']!='e' && ($_GET['mod']=='invc' || $_GET['mod']=='invg'   ) )	
       {
		$tabla="dispositivo";
	    $query="SELECT e.*, l.id_lab, l.nombre as lab, l.id_dep, dv.nombre as division,bi.*,*
		        FROM " . $tabla . " e
		        LEFT JOIN laboratorios l
		        ON e.id_lab=l.id_lab
		        LEFT JOIN  bienes bi
		        ON e.bn_id=bi.bn_id
		        LEFT JOIN departamentos dp
		        ON dp.id_dep=l.id_dep
		        LEFT JOIN divisiones dv
		        ON dv.id_div=dp.id_div
		        WHERE bi.bn_id=" . $bnid;
		        $result = pg_query($query) or die('Hubo un error con la base de datos en dispositivo/equipo');
		        $inventariod= pg_num_rows($result);
		        $dato=pg_fetch_array($result,NULL,PGSQL_ASSOC);
		         echo '!edisp';
	   }
	   if ($inventariod==0){
		
		$tabla="equipo";// dispositivo
			 $query="SELECT e.*, l.id_lab, l.nombre as lab,l.id_dep,dv.nombre as division,bi.*,*
		             FROM " . $tabla . " e
		             LEFT JOIN laboratorios l
		             ON e.id_lab=l.id_lab
		             LEFT JOIN  bienes bi
		             ON e.bn_id=bi.bn_id
		             LEFT JOIN departamentos dp
		             ON dp.id_dep=l.id_dep
		             LEFT JOIN divisiones dv
		             ON dv.id_div=dp.id_div
		             WHERE bi.bn_id=" . $bnid;
		             $result = pg_query($query) or die('Hubo un error con la base de datos en dispositivo/equipo');
		             $inventarioex= pg_num_rows($result);
		             $dato=pg_fetch_array($result,NULL,PGSQL_ASSOC);
		
		echo '!eeq';
		   
	   }
	   
       elseif ($_SESSION['tipo_lab']=='e' && ($_GET['mod']=='invc' || $_GET['mod']=='invg' ) && $inventariod==0  )
             {
			 $tabla="equipo";// dispositivo
			 $query="SELECT e.*, l.id_lab, l.nombre as lab,l.id_dep,dv.nombre as division,bi.*,*
		             FROM " . $tabla . " e
		             LEFT JOIN laboratorios l
		             ON e.id_lab=l.id_lab
		             LEFT JOIN  bienes bi
		             ON e.bn_id=bi.bn_id
		             LEFT JOIN departamentos dp
		             ON dp.id_dep=l.id_dep
		             LEFT JOIN divisiones dv
		             ON dv.id_div=dp.id_div
		             WHERE bi.bn_id=" . $bnid;
		             $result = pg_query($query) or die('Hubo un error con la base de datos en dispositivo/equipo');
		             $inventariod= pg_num_rows($result);
		             $dato=pg_fetch_array($result,NULL,PGSQL_ASSOC);
			echo 'eeq1';
			 }
        elseif ($_SESSION['tipo_lab']=='e' && $_GET['mod']=='inv')
             {$tabla="equipo";
			  $query="SELECT e.*, l.id_lab, l.nombre, id_dep,bi.*,*
		              FROM " . $tabla . " e
		              LEFT JOIN laboratorios l
		              ON e.id_lab=l.id_lab
		              LEFT JOIN  bienes bi
		              ON e.bn_id=bi.bn_id
		              WHERE bi.bn_id=" . $bnid;
		              $result = pg_query($query) or die('Hubo un error con la base de datos en dispositivo/equipo');
		              $inventarioex= pg_num_rows($result);
		              $dato=pg_fetch_array($result,NULL,PGSQL_ASSOC);
					  echo 'eeq2';
			 }
		
	
			if ($dato['lab']!=''){
			echo'p1';
			$asignado=$dato['lab']. ' de la '. $dato['division'];		
			
			} elseif ($_GET['mod']=='invc' && $dato['lab']==''  ){
			echo'p2';
			$asignado="Ninguno";
			
			}elseif ($_GET['mod']=='invg' && $inventariod!=0 ){
			    if ($dato['lab']==''){
		           echo'p3';		
				   $asignado="Ninguno";	
			    }else {  
				   echo 'p4';	
			       $tabla="equipo";
			       $query="select e.*, l.id_lab, l.nombre as lab , l.id_dep,bi.*,*
		                   from " . $tabla . " e
		                   left join laboratorios l
		                   on e.id_lab=l.id_lab
		                   left join  bienes bi
				           on e.bn_id=bi.bn_id
				            where bi.bn_id=" . $bnid;
				   
			              $result = pg_query($query) or die('Hubo un error con la base de datos en dispositivo/equipo');
			              $dato=pg_fetch_array($result,NULL,PGSQL_ASSOC);
			              $asignado=$dato['lab']   ;
			      }
			}
			elseif  ($_GET['mod']=='invg' && $inventariod==0   ){ 
			      echo'p5';
			      $tabla="equipo";
			      $query="select e.*, l.id_lab, l.nombre, l.id_dep,bi.*,*
		                  from " . $tabla . " e
		                  left join laboratorios l
		                  on e.id_lab=l.id_lab
		                  left join  bienes bi
		                  on e.bn_id=bi.bn_id
				          where bi.bn_id=" . $bnid;
				   
		          $result = pg_query($query) or die('Hubo un error con la base de datos en dispositivo/equipo');
		    
			      $dato=pg_fetch_array($result,NULL,PGSQL_ASSOC);
			
			 
				  $asignado="Ninguno";	
			}else {	
			echo 'p6';
			  $asignado=$dato['lab'] . ' de la '. $dato['division'];	
			}
			
		return $asignado;
}*/
				
function tblEquipo($idlab)
	{
				
				if ($_SESSION['tipo_lab']!='e')	
				   {$tabla="dispositivo";}
				else 
				   {$tabla="equipo";}
				   		
				$query="SELECT e.*, l.id_lab, l.nombre, id_dep,bi.*
				        FROM ".$tabla." e, laboratorios l, bienes bi
				        WHERE e.id_lab=l.id_lab
				        AND e.bn_id=bi.bn_id
				        AND e.id_lab=" . $idlab . " ORDER BY bn_desc ASC";
				
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
                   
				    $query="SELECT * FROM  cat_tecnologia ORDER BY nombre_tecnologia ASC";
				     
					$result = @pg_query($query) or die('Hubo un error con la base de datos en cat_tecnologia');
					
					if ($tipo==0){
					$salida='<select name="id_tecnologia" id="id_tecnologia" > ';
					         //<option value="0" > </option>'; 
							 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['nombre_tecnologia']==$tecnologia)
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "' selected='selected'>" . $datosc['nombre_tecnologia']. "</option>";
					 
					  else 
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "'>" . $datosc['nombre_tecnologia']. "</option>";
											  
						
						
					}//Fin del while
					
					}
					
					if ($tipo==1){
					$salida='<select name="tec_uno" id="tec_uno">;
					         <option value="0" >No existe </option>'; 
							 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_tecnologia']==$tecnologia)
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "' selected='selected'>" . $datosc['nombre_tecnologia']. "</option>";
					 
					  else 
					
						$salida.= "<option value='" . $datosc['id_tecnologia'] . "'>" . $datosc['nombre_tecnologia']. "</option>";
					
						
					}//Fin del while
					
					
					}
				   if ($tipo==2){
					$salida='<select name="tec_dos" id="tec_dos">;
					        <option value="0" >No existe </option>'; 
							 while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_tecnologia']==$tecnologia)
					
						  $salida.= "<option value='" . $datosc['id_tecnologia'] . "' selected='selected'>" . $datosc['nombre_tecnologia']. "</option>";
					  else 
					     $salida.= "<option value='" . $datosc['id_tecnologia'] . "'>" . $datosc['nombre_tecnologia']. "</option>";
					
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
					
					$salida='
					<select name="id_sist_oper" id="id_sist_oper
					 " onChange="limpia_Onchange();" >';
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
		  
		  echo $salida;
          
  //        }// fin del while

} //fin radial alto Rendimiento
function radialestado($estado)
{  
	      

		  if ($estado == 'USO'){ 

			$auxcheck= ' checked="checked"';	
			
				 
		  } elseif ($estado == 'DESUSO'){ 
		  			
		  $auxcheck2=' checked="checked"';
		 
		  
		  } else { }
		  
		  	  
		  $salida='<label><input type="radio" name="estadobien" value="USO" '. $auxcheck . ">Uso</label>";  
		  $salida.='<label><input type="radio" name="estadobien" value="DESUSO" '. $auxcheck2 . ">Desuso</label>";  
		 
		  echo $salida;
      
} //fin radial estadobien
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
			if($bien<>9 && $bien<>10 && $bien<>11 && $bien<>12)
					$salida=1 ;
			else  $salida=0;		
					return $salida;
		
		}//fin metodo
		
function adapta($tipo,$tipolab){
	
	if ($tipo =='invg' ){
		
		$query= "SELECT  e.*, n.nomlab AS laboratorio, bi.*,* 
                 FROM dispositivo e 
                 LEFT JOIN cat_dispositivo cd
                 ON e.dispositivo_clave=cd.dispositivo_clave
                 LEFT JOIN cat_familia cf
                 ON e.familia_clave=cf.id_familia
                 LEFT JOIN cat_tipo_ram ctr
                 ON e.tipo_ram_clave=ctr.id_tipo_ram
                 LEFT JOIN cat_tecnologia ct
                 on e.tecnologia_clave=ct.id_tecnologia
                 LEFT JOIN cat_sist_oper cso
                 on  e.sist_oper=cso.id_sist_oper
	             LEFT JOIN cat_usuario_final cuf
	             on cuf.usuario_final_clave=e.usuario_final_clave
                 LEFT JOIN cat_marca cm
                 on cm.id_marca=e.id_marca
                 LEFT JOIN cat_memoria_ram cmr
                 on e.id_mem_ram=cmr.id_mem_ram
                 LEFT JOIN bienes_inventario bi
                 ON e.bn_id = bi.bn_id
                 LEFT JOIN(	
                          SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                          ac.id_acad,ac.nombre AS academia, 
                          d.id_dep, d.nombre AS depto, 
                          co.id_coord,co.nombre AS coord, 
                          dv.id_div,dv.nombre AS nombdivision,id_cac
                          FROM laboratorios l
                          LEFT JOIN academia ac
                          on ac.id_acad=l.id_acad
                          LEFT JOIN departamentos d
                          ON (ac.id_dep=d.id_dep
                              OR l.id_dep=d.id_dep)
                          LEFT JOIN coordinacion co
                          ON (co.id_coord=d.id_coord
                              OR co.id_coord=l.id_coord)
                          LEFT JOIN divisiones dv
                          ON (dv.id_div=co.id_div
                             OR d.id_div=dv.id_div )) n
                ON n.lab=e.id_lab
			    WHERE n.id_div=";
		
		
		}elseif  ($tipo =='invg'  && $tipolab!='e'){
	        $query= "SELECT  e.*, n.nomlab AS laboratorio, bi.*,* 
                 FROM dispositivo e 
                 LEFT JOIN cat_dispositivo cd
                 ON e.dispositivo_clave=cd.dispositivo_clave
                 LEFT JOIN cat_familia cf
                 ON e.familia_clave=cf.id_familia
                 LEFT JOIN cat_tipo_ram ctr
                 ON e.tipo_ram_clave=ctr.id_tipo_ram
                 LEFT JOIN cat_tecnologia ct
                 on e.tecnologia_clave=ct.id_tecnologia
                 LEFT JOIN cat_sist_oper cso
                 on  e.sist_oper=cso.id_sist_oper
	             LEFT JOIN cat_usuario_final cuf
	             on cuf.usuario_final_clave=e.usuario_final_clave
                 LEFT JOIN cat_marca cm
                 on cm.id_marca=e.id_marca
                 LEFT JOIN cat_memoria_ram cmr
                 on e.id_mem_ram=cmr.id_mem_ram
                 LEFT JOIN bienes_inventario bi
                 ON e.bn_id = bi.bn_id
                 LEFT JOIN(	
                          SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                          ac.id_acad,ac.nombre AS academia, 
                          d.id_dep, d.nombre AS depto, 
                          co.id_coord,co.nombre AS coord, 
                          dv.id_div,dv.nombre AS nombdivision,id_cac
                          FROM laboratorios l
                          LEFT JOIN academia ac
                          on ac.id_acad=l.id_acad
                          LEFT JOIN departamentos d
                          ON (ac.id_dep=d.id_dep
                              OR l.id_dep=d.id_dep)
                          LEFT JOIN coordinacion co
                          ON (co.id_coord=d.id_coord
                              OR co.id_coord=l.id_coord)
                          LEFT JOIN divisiones dv
                          ON (dv.id_div=co.id_div
                              OR d.id_div=dv.id_div )) n
                ON n.lab=e.id_lab
			    WHERE n.id_div=";
		
	
	}
	
	return $query;
	
}

function CensoECNoMac($tipousu,$div,$lab){
	//quitar el tipo de usuario o se utiliza 
	if ( ($tipousu==1 || $tipousu==9) &&  $lab !=NULL ){	
	
	
   $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
	        LEFT JOIN cat_marca cm
	        ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	
                        SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                           OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			AND n.lab=" . $lab . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
		
	}else if ( $tipousu==10 && $div =="" ){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
	        LEFT JOIN cat_marca cm
	        ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	
                        SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                           OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
			
	}elseif ( $tipousu==10 && $div !="" ){	
	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
	        LEFT JOIN cat_marca cm
	        ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	
                        SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                           OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			AND n.id_div=" . $div . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
		
	}elseif ( ($tipousu!=10 && $tipousu!=1)   && $div!=""  ){
	
	 $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
	        LEFT JOIN cat_marca cm
	        ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	
                        SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                           OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			AND n.id_div=" . $div . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
	}else if ( ($tipousu!=10 && $tipousu!=1)   && $div =="" ){ 
	
	$query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
	        LEFT JOIN cat_marca cm
	        ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	
                        SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                           OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			 GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
	}
	

  return $query;


}//fin clase censoecnomacxls



function CensoECMac($tipousu,$div,$lab){


if (($tipousu==1 || $tipousu==9)  &&  $lab!=NULL){
			
	 $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
	        LEFT JOIN cat_marca cm
	        ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	
                        SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                           OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 AND sist_oper=7)
			AND n.lab=". $lab . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
			
	}elseif ($tipousu==10 && $div =="" ){

	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
	        LEFT JOIN cat_marca cm
	        ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	
                        SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                           OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 AND sist_oper=7)
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
			
	}elseif ( $tipousu==10 && $div!="" ){	
	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
	        LEFT JOIN cat_marca cm
	        ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                           OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
			WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 AND sist_oper=7)
			AND n.id_div=" . $div . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
		
	}
	else
	if ( ($tipousu!=10 && $tipousu!=1) && $div !="" ){
		//echo 'usu!=10  and usu!=1 and div!=NULL';	
	 $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
	        LEFT JOIN cat_marca cm
	        ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                           OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
			WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 AND sist_oper=7)
			AND n.id_div=" . $div . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
			
	}else if ( ($tipousu!=10 && $tipousu!=1)  && $div =="" )
	{ 
		$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
	        LEFT JOIN cat_marca cm
	        ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 AND sist_oper=7)
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
	
	}  
	
	return $query;	       
}//fin funcion censo mac

function CensoSONoMac($tipousu,$div,$lab){

if (( $tipousu==1 || $tipousu==9)  &&  $lab !=NULL  ){
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec
			LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			AND n.lab=". $lab . "
            GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien
			,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC ";
	}else
		
		if ( $tipousu==10 && $div==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec
			LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
		    GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien
			,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC ";	
	}
	else if ( $tipousu==10 && $div!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec
			LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			AND n.id_div=". $div . "
		    GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien
			,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC ";
			
	}elseif ( ($tipousu!=10 && $tipousu!=1 ) && $div==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec
			LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
		    GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien
			,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
			
	}else if ( ($tipousu!=10 && $tipousu!=1 ) && $div!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec
			LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			AND n.id_div=". $div . "
		    GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien
			,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC ";
	}
	return $query;
}


function CensoSOMac($tipousu,$div,$lab){
		if (($tipousu==1 ||$tipousu==9)  &&  $lab !=NULL  ){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec
			LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 OR sist_oper=7)
			AND n.lab=". $lab . "
            GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien
			,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
	}else
	if ($tipousu==10 && $div==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec
			LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 OR sist_oper=7)
			AND n.id_div=". $div. "
            GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien
			,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
	}
	else if ( $tipousu==10 && $div!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec
			LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 OR sist_oper=7)
			AND n.id_div=". $div. "
            GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien
			,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
	}else
	
	if ( ($tipousu!=10 && $tipousu!=1) && $div==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec
			LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 OR sist_oper=7)
			GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien
			,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
	}else if (  ($tipousu!=10 && $tipousu!=1) && $div!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec
			LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_sist_oper cso
			ON ec.sist_oper=cso.id_sist_oper 
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN(	SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 OR sist_oper=7)
			AND n.id_div=". $div. "
            GROUP BY nombre_dispositivo,nombre_familia,nombre_so,familia_clave,estadobien
			,equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
	}
	return $query;
}


function CensoUFNoMac($tipousu,$div,$lab){
if (($tipousu==1 ||$tipousu==9)  &&  $lab !=NULL  ){
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			AND n.lab=". $lab . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
	}else
	if ($tipousu==10 && $div==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
	}
	else if ($tipousu==10 && $div!=""){	
	
    $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			AND n.id_div=". $div . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
	}else
	if (($tipousu!=10 && $tipousu!=1) && $div==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
	}
	else if (($tipousu!=10 && $tipousu!=1) && $div!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			AND n.id_div=". $div . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
	}
	return $query;
}

function CensoUFMac($tipousu,$div,$lab){
	
	if (($tipousu==1 || $tipousu==9)  &&  $lab !=NULL  ){
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 AND sist_oper=7)
			AND n.lab=". $lab . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
	}else
		if ($tipousu==10 && $div==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 AND sist_oper=7)
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
	}
	else if ($tipousu==10 && $div!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 AND sist_oper=7)
			AND n.id_div=". $div . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
	}else
	if (($tipousu!=10 && $tipousu!=1) && $div==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 AND sist_oper=7)
			AND n.id_div=". $div . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
	}
	else if (($tipousu!=10 && $tipousu!=1) && $div!=""){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper=3 AND sist_oper=7)
			AND n.id_div=". $div . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
	}
	return $query;

}

function CensoUFBNoMac($tipousu,$div,$lab){
	
if (($tipousu==1 ||$tipousu==9)  &&  $lab !=NULL  ){	
  $query= " SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND tipo_lab='b'
			AND (sist_oper<>3 AND sist_oper<>7)
			AND n.lab=". $lab . "
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC ";
	}elseif ($tipousu==10 && $div==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND tipo_lab='b'
			AND (sist_oper<>3 AND sist_oper<>7)
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
	}	
	else if ($tipousu==10 && $div!=""){			
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND tipo_lab='b'
			AND (sist_oper<>3 AND sist_oper<>7)
			AND n.id_div=". $div . "
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
	} else
	if (($tipousu!=10 && $tipousu!=1 ) && $div==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND tipo_lab='b'
			AND (sist_oper<>3 AND sist_oper<>7)
			AND n.id_div=". $div . "
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
	}	
	else if ( ($tipousu!=10 && $tipousu!=1 ) && $div!=""){			
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
            FROM dispositivo ec 
            LEFT JOIN laboratorios l
            ON ec.id_lab=l.id_lab
	        LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN departamentos d
            ON d.id_dep=l.id_dep
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND tipo_lab='b'
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND (sist_oper<>3 AND sist_oper<>7)
			AND id_div=". $div . "
            GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,equipoaltorend,fecha_factura,l.nombre
			ORDER BY cuenta DESC";
	}
	return $query;
}

function CensoUFBMac($tipousu,$div,$lab){
	if (($tipousu==1 ||$tipousu==9)  &&  $lab !=NULL  ){	
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND tipo_lab='b'
			AND (sist_oper=3 AND sist_oper=7)
			AND n.lab=". $lab . "
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
	}else	
if ($tipousu==10 && $div==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND tipo_lab='b'
			AND (sist_oper=3 AND sist_oper=7)
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
	}	
	else if ($tipousu==10 && $div!=""){			
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND tipo_lab='b'
			AND (sist_oper=3 AND sist_oper=7)
			AND n.id_div=". $div . "
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
	}else
	if (($tipousu!=10 && $tipousu!=1) && $div==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND tipo_lab='b'
			AND (sist_oper=3 AND sist_oper=7)
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";	
	}	
	else if ($tipousu!=10 && $div!=""){			
  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
            equipoaltorend,fecha_factura,n.nomlab
            FROM dispositivo ec 
            LEFT JOIN cat_familia cf
            ON ec.familia_clave=cf.id_familia
            LEFT JOIN cat_usuario_final cuf
            ON ec.usuario_final_clave=cuf.usuario_final_clave
            LEFT JOIN cat_dispositivo cd
            ON ec.dispositivo_clave=cd.dispositivo_clave
			LEFT JOIN cat_marca cm
			ON cm.id_marca=ec.id_marca
	        LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=ec.id_lab
            WHERE (ec.dispositivo_clave<>9 AND ec.dispositivo_clave<>10 AND ec.dispositivo_clave<>11)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND tipo_lab='b'
			AND (sist_oper=3 AND sist_oper=7)
			AND n.id_div=". $div . "
			GROUP BY nombre_dispositivo,nombre_familia,familia_clave,estadobien,tipo_usuario,
			equipoaltorend,fecha_factura,n.nomlab
			ORDER BY cuenta DESC";
	}
	
	return $query;
}
function Impresora($tipousu,$div,$lab){
	
	if (($tipousu==1 || $tipousu==9)  &&  $lab !=NULL  ){

  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura
            FROM dispositivo dp 
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
            WHERE (dp.dispositivo_clave=10 OR dp.dispositivo_clave=11 )
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND n.lab=".$lab  . "
			GROUP BY nombre_dispositivo,estadobien,fecha_factura
			ORDER BY cuenta";
	}else
	if ($tipousu==10 && $div==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura
            FROM dispositivo dp 
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
            WHERE (dp.dispositivo_clave=10 OR dp.dispositivo_clave=11 )
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			GROUP BY nombre_dispositivo,estadobien,fecha_factura
			ORDER BY cuenta";	
	}
	else if ($tipousu==10 && $div!=""){

  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura
            FROM dispositivo dp 
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
            WHERE (dp.dispositivo_clave=10 OR dp.dispositivo_clave=11 )
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND n.id_div=".$div  . "
			GROUP BY nombre_dispositivo,estadobien,fecha_factura
			ORDER BY cuenta";
	}else
	if (($tipousu!=10 && $tipousu!=1) && $div==""){
	
	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura
            FROM dispositivo dp 
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
            WHERE (dp.dispositivo_clave=10 OR dp.dispositivo_clave=11 )
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			GROUP BY nombre_dispositivo,estadobien,fecha_factura
			ORDER BY cuenta";	
	}
	else if (($tipousu!=10 && $tipousu!=1) && $div!=""){

  $query= "SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura
            FROM dispositivo dp 
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
            WHERE (dp.dispositivo_clave=10 OR dp.dispositivo_clave=11 )
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			AND n.id_div=".$div  . "
			GROUP BY nombre_dispositivo,estadobien,fecha_factura
			ORDER BY cuenta";
	}
	return $query;
}

function EquDigital($tipousu,$div,$lab){
			if (($tipousu==1 ||$tipousu==9)  &&  $lab !=NULL  ){
  $query= " SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
            FROM dispositivo dp
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
			WHERE (dp.dispositivo_clave=12 )
            AND n.lab=".$lab  . "
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
			ORDER BY cuenta ASC";
	}else if ($tipousu==10 && $div==""){

	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
            FROM dispositivo dp
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
			WHERE (dp.dispositivo_clave=12  )
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
			ORDER BY cuenta ASC";	
	}
	else if ($tipousu==10 && $div!=""){	 
  $query= " SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
            FROM dispositivo dp
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
            AND n.id_div=".$div  . "
			WHERE (dp.dispositivo_clave=12)
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
			ORDER BY cuenta ASC";
	}else if (($tipousu!=10  && $$tipousu!=1 ) && $div==""){

	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
            FROM dispositivo dp
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
			WHERE (dp.dispositivo_clave=12  )
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
			ORDER BY cuenta ASC";	
	}
	else if (($tipousu!=10  && $tipousu!=1 ) && $div!=""){	 
  $query= " SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
            FROM dispositivo dp
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
            AND n.id_div=".$div . "
			WHERE (dp.dispositivo_clave=12  )
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
			ORDER BY cuenta ASC";
	}
return $query;	
}

function RedesTel($tipousu,$div,$lab){

if ($tipousu==1 &&  $lab !=NULL ){	 
  $query= " SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
            FROM dispositivo dp
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
			WHERE (dp.dispositivo_clave=7  )
            AND n.lab=".$lab  . "
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
			ORDER BY cuenta ASC";
	 }else
		if ($tipousu==10 && $div==""){

	$query=" SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
            FROM dispositivo dp
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
			WHERE (dp.dispositivo_clave=7  )
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
			ORDER BY cuenta ASC";	
	}
	else if ($tipousu==10 && $div!=""){	 
  $query= " SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
            FROM dispositivo dp
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
			WHERE (dp.dispositivo_clave=7  )
            AND n.id_div=".$div  . "
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
			ORDER BY cuenta ASC";
	}
	if (($tipousu!=10 && $$tipousu!=1) && $div==""){

	$query="SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
            FROM dispositivo dp
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
			WHERE (dp.dispositivo_clave=7  )
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
			ORDER BY cuenta ASC";	
	}
	else if (($tipousu!=10 && $tipousu!=1) && $div!=""){	 
  $query= " SELECT COUNT (*) as cuenta,nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
            FROM dispositivo dp
            LEFT JOIN cat_dispositivo cd
            ON dp.dispositivo_clave=cd.dispositivo_clave
            LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
			WHERE (dp.dispositivo_clave=7)
            AND n.id_div=".$div  . "
            AND  (estadoBien='USO' OR estadoBien='DESUSO' OR estadoBien='')
			GROUP BY nombre_dispositivo,estadoBien,fecha_factura,n.nomlab
			ORDER BY cuenta ASC";
	}
	return $query;
}

function EquAR($tipousu,$div,$lab){
		if (($tipousu==1 || $tipousu==9)  &&  $lab !=NULL  ){

  $query= " SELECT  equipoaltorend,descmarca,modelo_p,serie,inventario,sist_oper,nombre_so,fecha_factura,n.nomlab
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
            WHERE equipoaltorend='Si'
			AND n.lab=". $lab  . "
			ORDER BY marca_p,n.nomlab ASC";
	}
	if ($tipousu==10 && $div==""){
	
	$query="SELECT  equipoaltorend,descmarca,modelo_p,serie,inventario,sist_oper,nombre_so,fecha_factura,n.nomlab
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
            WHERE equipoaltorend='Si'
			ORDER BY marca_p,n.nomlab ASC";	
	}
	else if ($tipousu==10 && $div!=""){

  $query= " SELECT  equipoaltorend,descmarca,modelo_p,serie,inventario,sist_oper,nombre_so,fecha_factura,n.nomlab
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
            WHERE equipoaltorend='Si'
			AND n.id_div=". $div  . "
			ORDER BY marca_p,n.nomlab ASC";
	}else
		if (($tipousu!=10 && $$tipousu!=1) && $div==""){
	
	$query="SELECT  equipoaltorend,descmarca,modelo_p,serie,inventario,sist_oper,nombre_so,fecha_factura,n.nomlab
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
            WHERE equipoaltorend='Si'
			ORDER BY marca_p,n.nomlab ASC";	
	}
	else if (($tipousu!=10 && $tipousu!=1) && $div!=""){

  $query= " SELECT  equipoaltorend,descmarca,modelo_p,serie,inventario,sist_oper,nombre_so,fecha_factura,n.nomlab
	        FROM dispositivo dp
            LEFT JOIN cat_marca cm
            ON cm.id_marca=dp.id_marca
			LEFT JOIN cat_sist_oper cso
            ON cso.id_sist_oper=dp.sist_oper
			LEFT JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
            ON n.lab=dp.id_lab
            WHERE equipoaltorend='Si'
			AND n.id_div=". $div  . "
			ORDER BY marca_p,n.nomlab ASC";
	}
	return $query;
}

function obtienenombre ($tipousuario,$div,$lab){
	
	
if (($tipousuario==1 || $tipousuario==9 ) && $div==NULL || $lab!=NULL ){
	 
	$querylab="SELECT nombre FROM laboratorios
               WHERE id_lab=" . $lab ;
    $registrolab = pg_query($querylab) or die('Hubo un error con la base de datos en laboratorios');
    $nomblab= pg_fetch_array($registrolab);
	
    $texto='Content-Disposition: attachment;filename="censoeqcomp_' . date("Ymd-His") . "_" . $nomblab[0] . '.xls"';

}

if ($tipousuario==9 && $div!=NULL && $lab==NULL ){
	
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $div ;

$registrodiv = pg_query($querydiv) or die('Hubo un error con la base de datos en divisiones');
$nombdiv= pg_fetch_array($registrodiv);

$texto='Content-Disposition: attachment;filename="censoeqcomp_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';

}
if ( $tipousuario==9 && $div==""){
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $div ;
$registrodiv = pg_query($querydiv) or die('Hubo un error con la base de datos en divisiones');
$nombdiv= pg_fetch_array($registrodiv);


$texto='Content-Disposition: attachment;filename="censoeqcomp_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
}

if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']!=""){
	
$querydiv="SELECT nombre FROM divisiones
           WHERE id_div=" . $_SESSION['id_div'];
		   
$registrodiv = pg_query($querydiv) or die('Hubo un error con la base de datos en divisiones');
$nombdiv= pg_fetch_array($registrodiv);


$texto='Content-Disposition: attachment;filename="censoeqcomp_' . date("Ymd-His") . "_" . $nombdiv[0] . '.xls"';
}
else if ( $_SESSION['tipo_usuario']==10 && $_SESSION['id_div']==""){
$titulo='FacultadIngenieria';	
$texto='Content-Disposition: attachment;filename="censoeqcomp_' . date("Ymd-His") . "_" . $titulo . '.xls"';	
}	
echo $texto;
return $texto;
}

function exportaInv(){
	$query= "SELECT  e.*, ct.nombre_tecnologia AS nomtec,
         cequ.nombre_esquema AS esquemauno,
         ceqd.nombre_esquema AS esquemados, 
         ceqt.nombre_esquema AS esquematres,
         ceqc.nombre_esquema AS esquemacuatro,
		 ctu.nombre_tecnologia AS tecuno,
		 ctd.nombre_tecnologia AS tecdos,
		 ctt.nombre_tecnologia AS tectres,
		 ctc.nombre_tecnologia AS teccuatro,
         n.nomlab AS laboratorio, bi.*,* 
         FROM dispositivo e 
         LEFT JOIN cat_dispositivo cd
         ON e.dispositivo_clave=cd.dispositivo_clave
         LEFT JOIN cat_familia cf
         ON e.familia_clave=cf.id_familia
         LEFT JOIN cat_tipo_ram ctr
         ON e.tipo_ram_clave=ctr.id_tipo_ram
         LEFT JOIN cat_tecnologia ct
         ON e.tecnologia_clave=ct.id_tecnologia
         LEFT JOIN cat_sist_oper cso
         ON  e.sist_oper=cso.id_sist_oper
         LEFT JOIN cat_marca cm
         ON cm.id_marca=e.id_marca
         LEFT JOIN cat_memoria_ram cmr
         ON e.id_mem_ram=cmr.id_mem_ram
         LEFT JOIN bienes_inventario bi
         ON  e.bn_id = bi.bn_id
		 LEFT JOIN cat_modo_adq cma
         ON e.id_mod=cma.id_mod
         JOIN  (SELECT l.id_lab AS lab,l.nombre AS nomlab, l.id_responsable,
                        ac.id_acad,ac.nombre AS academia, 
                        d.id_dep, d.nombre AS depto, 
                        co.id_coord,co.nombre AS coord, 
                        dv.id_div as div,dv.nombre AS nombdivision,id_cac,tipo_lab
                        FROM laboratorios l
                        LEFT JOIN academia ac
                        ON ac.id_acad=l.id_acad
                        LEFT JOIN departamentos d
                        ON (ac.id_dep=d.id_dep
                            OR l.id_dep=d.id_dep)
                        LEFT JOIN coordinacion co
                        ON (co.id_coord=d.id_coord
                            OR co.id_coord=l.id_coord)
                        LEFT JOIN divisiones dv
                        ON (dv.id_div=co.id_div
                            OR d.id_div=dv.id_div )) n
           ON n.lab=e.id_lab
           JOIN cat_usuario_final uf
           ON uf.usuario_final_clave=e.usuario_final_clave
           JOIN cat_usuario_perfil up
           ON up.id_usuario_perfil=e.usuario_perfil
           JOIN cat_usuario_sector us
           ON us.id_usuario_sector=e.usuario_sector
           LEFT JOIN cat_esquema cequ
           ON e.esquema_uno=cequ.id_esquema
           LEFT JOIN cat_esquema ceqd
           ON e.esquema_dos=ceqd.id_esquema
           LEFT JOIN cat_esquema ceqt
           ON e.esquema_tres=ceqt.id_esquema
           LEFT JOIN cat_esquema ceqc
           ON e.esquema_tres=ceqc.id_esquema
           LEFT JOIN cat_tecnologia ctu
           ON e.tec_uno=ctu.id_tecnologia
           LEFT JOIN cat_tecnologia ctd
           ON e.tec_dos=ctd.id_tecnologia
           LEFT JOIN cat_tecnologia ctt
           ON e.tec_tres=ctt.id_tecnologia
           LEFT JOIN cat_tecnologia ctc
           ON e.tec_cuatro=ctc.id_tecnologia
           LEFT JOIN cat_tec_com ctcom
           ON ctcom.id_tec_com=e.tec_com
           WHERE n.div=";
	return $query;
}

} // fin de clase

?>

