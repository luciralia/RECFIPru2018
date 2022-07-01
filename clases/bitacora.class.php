<?php
require_once('../conexion.php');

class Bitacora{

		function tblServ($idlab, $mod)
			{

				if ($mod=='serv'){
				$tiposerv="(em.tipo_serv IS NULL OR em.tipo_serv IS FALSE) ";
				} else {$tiposerv='TRUE';
				$tiposerv="em.tipo_serv IS TRUE";
				}
				
				if ($mod=='servibf'){
				$tipomant=" AND em.tipo_mant='C'";
				$textocol='Usuario que reporta la falla';
				} 
				else if($mod=='servibp'){ 
				$tipomant=" AND em.tipo_mant='P'";
				$textocol='Persona que realizó el mantenimiento';
				} else {$tipomant=" ";}

			
						
				$query = "SELECT l.id_lab as id_lab, em.id_evento as id_evento, em.id_bitacora as id_bitacora, em.tipo_mant as tipo, em.fecha as fregistro, em.tipo_falla as falla, em.usuario_reporta as reporta, em.fecha_salida as fsalida, em.fecha_recepcion as frecepcion, em.costo as costo, em.fecha_prox_mant as fprox, em.descripcion as desc_serv, em.garantia as garantia, bi.bn_desc as bn_desc, bi.bn_marca as marca, bi.bn_modelo as modelo, bi.bn_serie as serie, bi.bn_clave as clave, l.nombre AS laboratorio, dp.nombre AS departamento, dv.nombre AS division, u.nombre AS RL_Nombre, u.a_paterno AS RL_apaterno, u.a_materno AS RL_amaterno, em.id_cotizacion as id_cotizacion, em.ok as sitio, em.tipo_serv, e.bn_id as bn_id, em.semestre as semestre, em.actividad as actividad, em.supervisor as supervisor, em.detecto as detecto 
				FROM eventos_mantenimiento em, bitacora b, dispositivo e, bienes_inventario bi, laboratorios l, departamentos dp, divisiones dv, usuarios u 
				WHERE em.id_bitacora = b.id_bitacora 
				AND bi.bn_id = e.bn_id 
				AND e.bn_id = em.id_equipo 
				AND e.id_lab = b.id_lab 
				AND l.id_lab = e.id_lab 
				AND l.id_dep = dp.id_dep 
				AND dp.id_div = dv.id_div
				AND l.id_responsable=u.id_usuario" .$tipomant. " 
				AND " . $tiposerv . " 
				AND l.id_lab=" . $idlab . " order by fregistro DESC";						
						
				//echo $query;		
						
						
						
							$result = pg_query($query) or die('Hubo un error con la base de datos');
							
							$salida='<table class="equipob"><tr>
							<br>
							<th scope="col">Inventario</th>
							<th scope="col">Equipo</th>
							<th scope="col">Tipo de mantenimiento</th>
							<th scope="col">Descripción del Servicio</th>
							<th scope="col">Inicio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
							<th scope="col">Término&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
							<th scope="col">'. $textocol.'</th>
							<th scope="col">Supervisó operación correcta</th>
							<th scope="col">Semestre</th>
							<th scope="col">Seleccionar</th>
							</tr>'; 
															
								$j=1;
								while ($datosc = pg_fetch_array($result, NULL, PGSQL_ASSOC))
								{ 
								$nombrechk="servicio".$j;
							
							        $salida.='<tr>
							        <td>'. $datosc['clave']. '</td>
							        <td>' . $datosc['bn_desc'] .'</td>
							        <td>' . $datosc['tipo'] .'</td>
							        <td>' . $datosc['falla'] .'</td>
							        <td>' . date("d-m-Y", strtotime($datosc['fsalida'])) .'</td>
							        <td>' . date("d-m-Y", strtotime($datosc['frecepcion'])) .'</td>
							        <td>' . $datosc['reporta'] .'</td>
							        <td>' . $datosc['supervisor'] .'</td>
							        <td>' . $datosc['semestre'] .'</td>
							        <td><input type="checkbox" name="'. $nombrechk .'" value="'. $datosc['id_evento'].'"  /></td>
							        </tr>';
									
									$j++;  
							
								}
						//	return $salida;
							$salida.='</table> <input name="j" type="hidden" value="' .$j. '" />';
							$salida.='<input name="lab" type="hidden" value="' .$idlab. '" />';
							$salida.='<input name="mod" type="hidden" value="' .$mod. '" />';
							echo $salida;
			}//finmetodo	


function getDiv($idlab)
	{
		$query="select dv.nombre as division 
		FROM laboratorios l, departamentos dp, divisiones dv 
		WHERE l.id_dep=dp.id_dep
		AND dp.id_div=dv.id_div
		AND id_lab=" . $idlab;
		
		$result = pg_query($query) or die('Hubo un error con la base de datos');
		while ($datosdiv = pg_fetch_array($result, NULL, PGSQL_ASSOC))	{
		$salida=$datosdiv['division'];
		}
	echo $salida;
	}//termina metodo getDiv

private $datos;

function __construct() {
$this->datos=array();
}//termina constructor

function rengBit($idlab,$mod,$checkbox){

//echo "datos que llegan:$idlab,$mod,$checkbox";

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
	

$query="SELECT l.id_lab as id_lab, em.id_evento as id_evento, em.id_bitacora as id_bitacora, em.tipo_mant as tipo, em.fecha as fregistro, em.tipo_falla as falla, em.usuario_reporta as reporta, em.fecha_salida as fsalida, em.fecha_recepcion as frecepcion, em.costo as costo, em.fecha_prox_mant as fprox, em.descripcion as desc_serv, em.garantia as garantia, bi.bn_desc as bn_desc, bi.bn_marca as marca, bi.bn_modelo as modelo, bi.bn_serie as serie, bi.bn_clave as clave, l.nombre AS laboratorio, dp.nombre AS departamento, dv.nombre AS division, u.nombre AS RL_Nombre, u.a_paterno AS RL_apaterno, u.a_materno AS RL_amaterno, em.id_cotizacion as id_cotizacion, em.ok as sitio, em.tipo_serv, e.bn_id as bn_id, em.semestre as semestre, em.actividad as actividad, em.supervisor as supervisor, em.detecto as detecto 
				FROM eventos_mantenimiento em, bitacora b, dispositivo e, bienes_inventario bi, laboratorios l, departamentos dp, divisiones dv, usuarios u 
				WHERE em.id_bitacora = b.id_bitacora 
				AND bi.bn_id = e.bn_id 
				AND e.bn_id = em.id_equipo 
				AND e.id_lab = b.id_lab 
				AND l.id_lab = e.id_lab 
				AND l.id_dep = dp.id_dep 
				AND dp.id_div = dv.id_div
				AND l.id_responsable=u.id_usuario" .$tipomant. " 
				AND " . $tiposerv . " 
				AND em.id_evento=" . $checkbox . "
				AND l.id_lab=" . $idlab . " order by fregistro DESC";
		
//		echo "QUERY EN LA CLASE *******************************". $query;		
		$result = pg_query($query) or die('Hubo un error con la base de datos');
		while ($datosdiv = pg_fetch_array($result, NULL, PGSQL_ASSOC))	{
//		Echo "</br>el valor de los datosdiv dentro del while" . "    " . print_r($datosdiv) . "</br>";
		$this->datos[]=$datosdiv;
		}
	
//	Echo "</br>el valor de los datosdiv" . "    " . print_r($datosdiv) . "</br></br></br>";
//	Echo "</br>el valor de los datos" . "    " . print_r($datos). "</br></br></br>";
	return $this->datos;
	unset ($datos);

}//termina metodo rengbit





}
?>