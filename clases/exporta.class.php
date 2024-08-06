<?php
require_once('../conexion.php');

class Exportaxls{


private $datos;

function __construct() {
$this->datos=array();
}//termina constructor

function tblXls($idlab,$mod,$tabla){
	

		if ($_SESSION['tipo_lab']!='e' && $mod=='invc' )	
             $tabla="dispositivo";
           elseif ($_SESSION['tipo_lab']=='e' && $mod=='invc' )
               $tabla="dispositivo";
              else 
                $tabla="equipo";	   
	
	if ($mod=='serv'||$mod=='servi'){


				if ($mod=='serv'){
				$tiposerv="(em.tipo_serv IS NULL OR em.tipo_serv IS FALSE) ";
				} else {$tiposerv='TRUE';
				$tiposerv="em.tipo_serv IS TRUE";
				}
				
				if ($mod=='servibf'){
				$tipomant=" AND em.tipo_mant='C'";
				} 
				else if($mod=='servibp'){ 
				$tipomant=" AND em.tipo_mant='P'";
				} else {$tipomant=" ";}
				
		

				$query="SELECT l.id_lab AS id_lab, em.id_evento AS id_evento, em.id_bitacora AS id_bitacora, em.tipo_mant AS tipo, em.fecha                 AS fregistro, em.tipo_falla AS falla, em.usuario_reporta AS reporta, em.fecha_salida AS fsalida, em.fecha_recepcion AS                 frecepcion, em.costo AS costo, em.fecha_prox_mant AS fprox, em.descripcion AS desc_serv, em.garantia AS garantia,                 bi.bn_desc AS bn_desc, bi.bn_marca AS marca, bi.bn_modelo AS modelo, bi.bn_serie AS serie, bi.bn_clave AS clave, procesador                 AS procesador, noprocesadores AS procesadores, velocidad AS velocidad, l.nombre AS laboratorio, dp.nombre AS departamento,                 dv.nombre AS division, u.nombre AS RL_Nombre, u.a_paterno AS RL_apaterno, u.a_materno AS RL_amaterno, em.id_cotizacion AS                 id_cotizacion, em.ok AS sitio, em.tipo_serv, e.bn_id AS bn_id, em.semestre AS semestre, em.actividad AS actividad,                 em.supervisor AS supervisor, em.detecto AS detecto 
				 FROM eventos_mantenimiento em, bitacora b, ".$tabla." e, bienes_inventario bi, laboratorios l, departamentos dp, divisiones                 dv, usuarios u 
				 WHERE em.id_bitacora = b.id_bitacora 
				 AND bi.bn_id = e.bn_id 
				 AND e.bn_id = em.id_equipo 
				 AND e.id_lab = b.id_lab 
				 AND l.id_lab = e.id_lab 
				 AND l.id_dep = dp.id_dep 
				 AND dp.id_div = dv.id_div
				 AND l.id_responsable=u.id_usuario 
				 AND " . $tiposerv . " 
				 AND l.id_lab=" . $idlab . " ORDER BY fregistro DESC";
		} //fin de if para servicios

	if ($mod=="eq"){

				$query = "SELECT DISTINCT id_nec, ne.id_lab AS id_lab, cant, ne.descripcion, prioridad AS id_prio, cpn.descripcion AS plazo,                cpn.id AS id_plazo, l.nombre AS laboratorio, de.nombre AS departamento, dv.nombre AS division, cto_unitario AS costo,                 act_generales AS actividades, cjn.descripcion AS motivo, cjn.id AS num_just, impacto AS justificacion, id_cotizacion,                 cto_unitario, ref 
				FROM necesidades_equipo ne, laboratorios l, divisiones dv, departamentos de, cat_plazo_nec cpn, cat_juztificacion_nec cjn 
				WHERE ne.id_lab=l.id_lab 
				AND l.id_dep=de.id_dep 
				AND de.id_div=dv.id_div 
				AND plazo=cpn.id 
				AND justificacion=cjn.id
				AND ne.id_lab=" . $idlab . 
				"ORDER BY id_nec DESC";

     }

	if ($mod=="mat"){
				$query = "SELECT distinct rm.id_req AS id_req, rm.id_lab AS id_lab,cant, rm.descripcion AS descripcion, rm.unidad_medida AS                 medida, cpn.descripcion AS plazo, cpn.id AS id_plazo, l.nombre AS laboratorio, dp.nombre AS departamento, di.nombre AS                 division, cto_unitario AS costo, act_generales AS actividades, cjnm.descripcion AS motivo, cjnm.id AS num_just, impacto AS                 justificacion, rm.id_cotizacion AS id_cotizacion, rm.ref AS ref
				FROM req_mat rm, laboratorios l, divisiones di, departamentos dp, cat_plazo_nec cpn, cat_just_mat cjnm 
				WHERE rm.id_lab=l.id_lab 
				AND l.id_dep=dp.id_dep 
				AND dp.id_div=di.id_div 
				AND plazo=cpn.id 
				AND justificacion=cjnm.id
				AND l.id_lab=". $idlab;
    }

	if (($mod=="inv" || $mod=="invc" || $mod=="invg") && ( $tabla="dispositivo")){
		
      
	    $query = "SELECT e.*, ct.nombre_tecnologia as nomtec,cequ.nombre_esquema as esquemauno,
         ceqd.nombre_esquema as esquemados, 
         ceqt.nombre_esquema as esquematres,
         ceqc.nombre_esquema as esquemacuatro,
		 ctu.nombre_tecnologia as tecuno,
		 ctd.nombre_tecnologia as tecdos,
		 ctt.nombre_tecnologia as tectres,
		 ctc.nombre_tecnologia as teccuatro,
         l.nombre as laboratorio, bi.*,*  FROM ".$tabla." e 

         LEFT JOIN cat_dispositivo cd
         ON e.dispositivo_clave=cd.dispositivo_clave
         LEFT JOIN cat_familia cf
         ON e.familia_clave=cf.id_familia
         LEFT JOIN cat_tipo_ram ctr
on e.tipo_ram_clave=ctr.id_tipo_ram
left join cat_tecnologia ct
on e.tecnologia_clave=ct.id_tecnologia
left join cat_sist_oper cso
on  e.sist_oper=cso.id_sist_oper
left join cat_marca cm
on cm.id_marca=e.id_marca
left join cat_memoria_ram cmr
on e.id_mem_ram=cmr.id_mem_ram
left join bienes_inventario bi
on  e.bn_id = bi.bn_id
left join cat_modo_adq cma
on e.id_mod=cma.id_mod
join cat_usuario_final uf
on uf.usuario_final_clave=e.usuario_final_clave
join cat_usuario_perfil up
on up.id_usuario_perfil=e.usuario_perfil
join cat_usuario_sector us
on us.id_usuario_sector=e.usuario_sector
left join cat_esquema cequ
on e.esquema_uno=cequ.id_esquema
left join cat_esquema ceqd
on e.esquema_dos=ceqd.id_esquema
left join cat_esquema ceqt
on e.esquema_tres=ceqt.id_esquema
left join cat_esquema ceqc
on e.esquema_tres=ceqc.id_esquema
left join cat_tecnologia ctu
on e.tec_uno=ctu.id_tecnologia
left join cat_tecnologia ctd
on e.tec_dos=ctd.id_tecnologia
left join cat_tecnologia ctt
on e.tec_tres=ctt.id_tecnologia
left join cat_tecnologia ctc
on e.tec_cuatro=ctc.id_tecnologia
left join cat_tec_com ctcom
on ctcom.id_tec_com=e.tec_com
join laboratorios l
on  l.id_lab=e.id_lab
where e.id_lab=" . $idlab;
	
    } elseif (($mod=="inv" || $mod=="invg") && ( $tabla="equipo")){
		
	$query = "SELECT e.*, l.nombre AS laboratorio, bi.* from ".$tabla." e 

left join bienes_inventario bi
on  e.bn_id = bi.bn_id
join laboratorios l
on  l.id_lab=e.id_lab
where e.id_lab=" . $idlab;	
		
	}
	
	//echo $query;
	
	    //echo "QUERY EN LA CLASE *******************************". $query;		
		$result = pg_query($query) or die('Hubo un error con la base de datos');
		while ($datosr = pg_fetch_array($result, NULL, PGSQL_ASSOC))	{
		//echo "</br>el valor de los datosdiv dentro del whileAHORA" . "    " . print_r($datosr) . "</br>";
		$this->datos[]=$datosr;
		}
	
	
    //Echo "</br>el valor de los datosdiv" . "    " . print_r($datosdiv) . "</br></br></br>";
	//echo "</br>el valor de los datos en la clase" . "    " . print_r($datos). "</br></br></br>";

	return $this->datos;
	unset ($datos);

	}//termina metodo rengXls
	
	function eqDivXls($div){
		
				if($div!=''){
					
				$query = "SELECT DISTINCT id_nec, ne.id_lab AS id_lab, cant, ne.descripcion, prioridad AS id_prio, cpn.descripcion AS plazo,                cpn.id AS id_plazo, l.nombre AS laboratorio, de.nombre AS departamento, dv.nombre AS division, cto_unitario AS costo,                 act_generales AS actividades, cjn.descripcion AS motivo, cjn.id AS num_just, impacto AS justificacion, id_cotizacion,                 cto_unitario, ref 
				FROM necesidades_equipo ne, laboratorios l, divisiones dv, departamentos de, cat_plazo_nec cpn, cat_juztificacion_nec cjn 
				WHERE ne.id_lab=l.id_lab 
				AND l.id_dep=de.id_dep 
				AND de.id_div=dv.id_div 
				AND plazo=cpn.id 
				AND justificacion=cjn.id
				AND dv.id_div=" . $div . 
				"ORDER BY id_nec DESC";
		    }else if($div==''){$query = "SELECT DISTINCT id_nec, ne.id_lab AS id_lab, cant, ne.descripcion, prioridad AS id_prio, cpn.descripcion AS plazo,                cpn.id AS id_plazo, l.nombre AS laboratorio, de.nombre AS departamento, dv.nombre AS division, cto_unitario AS costo,                 act_generales AS actividades, cjn.descripcion AS motivo, cjn.id AS num_just, impacto AS justificacion, id_cotizacion,                 cto_unitario, ref 
				FROM necesidades_equipo ne, laboratorios l, divisiones dv, departamentos de, cat_plazo_nec cpn, cat_juztificacion_nec cjn 
				WHERE ne.id_lab=l.id_lab 
				AND l.id_dep=de.id_dep 
				AND de.id_div=dv.id_div 
				AND plazo=cpn.id 
				AND justificacion=cjn.id
				ORDER BY id_nec DESC";	
		}

	     $result = pg_query($query) or die('Hubo un error con la base de datos');
		 while ($datosr = pg_fetch_array($result, NULL, PGSQL_ASSOC))	{
		    // echo "</br>el valor de los datosdiv dentro del whileAHORA" . "    " . print_r($datosr) . "</br>";
		       $this->datos[]=$datosr;	
		
	}
	return $this->datos;
	unset ($datos);

	}

function DispXls(){
	$query="SELECT  e.inventario,e.serie,e.marca_p,modelo_p,nombre_dispositivo,nombre_so,version_sist_oper,usuario_nombre,nombre_sector,tipo_usuario,
	 div.nombre as nombrediv,d.nombre as nombredep,l.nombre as laboratorio
         FROM dispositivo e 
         LEFT JOIN cat_dispositivo cd
         ON e.dispositivo_clave=cd.dispositivo_clave
         LEFT JOIN cat_familia cf
         ON e.familia_clave=cf.id_familia
         left join cat_tipo_ram ctr
         on e.tipo_ram_clave=ctr.id_tipo_ram
         left join cat_tecnologia ct
         on e.tecnologia_clave=ct.id_tecnologia
         left join cat_sist_oper cso
         on  e.sist_oper=cso.id_sist_oper
         left join cat_marca cm
         on cm.id_marca=e.id_marca
         left join cat_memoria_ram cmr
         on e.id_mem_ram=cmr.id_mem_ram
         left join bienes_inventario bi
         on  e.bn_id = bi.bn_id
         join laboratorios l
         on  l.id_lab=e.id_lab
         join departamentos d
         on d.id_dep=l.id_dep
         join divisiones div
         on div.id_div=d.id_div
         join cat_usuario_final uf
         on uf.usuario_final_clave=e.usuario_final_clave
         join cat_usuario_perfil up
         on up.id_usuario_perfil=e.usuario_perfil
         join cat_usuario_sector us
         on us.id_usuario_sector=e.usuario_sector
         where 
         cd.dispositivo_clave between 1 and 8
         order by div.id_div";

         $result = pg_query($query) or die('Hubo un error con la base de datos');
		 while ($datosr = pg_fetch_array($result, NULL, PGSQL_ASSOC))	{
		       //echo "</br>el valor de los datosdiv dentro del whileAHORA" . "    " . print_r($datosr) . "</br>";
		       $this->datos[]=$datosr;
		}
	
	
    //Echo "</br>el valor de los datosdiv" . "    " . print_r($datosdiv) . "</br></br></br>";
	//echo "</br>el valor de los datos en la clase" . "    " . print_r($datos). "</br></br></br>";

	return $this->datos;
	unset ($datos);


}

}


?>