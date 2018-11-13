<?php
require_once(dirname(__FILE__).'/../lib/adodb5/adodb-active-record.inc.php');
require_once(dirname(__FILE__).'/class.conexion_db.php');
require_once('../conexion.php');
 
 $db=conexion_db::getInstance();
 ADOdb_Active_Record::SetDatabaseAdapter($db);
 
/**
 * 
 * @author Norman E. Acosta Fonseca
 * @date Oct 13, 2009
 * @brief Esta clase permite operar con la tabla de departamentos como un objeto.
 *
 */
 class departamentos extends ADOdb_Active_Record{
 	
 	var $_table = 'departamentos';
 }





class Divisiones{

function getJdivision($idjdiv){

if ($idjdiv==NULL||$idjdiv==0){

$salidac="Ninguna"; 

} else {

$query="Select * from divisiones where id_responsable=" . $idjdiv;
	
	$result = pg_query($query) or die('Hubo un error con la base de datos');

	while ($datosc = pg_fetch_array($result_cot))
		{
		$salidac = $datosc['folio'] . " - " . $datosc['proveedor'];
		}
	}
return $salidac;
}

function cmbCotiza($idlab,$tipo_req)
	{
//	$idlab=$_POST['_id_lab'];
//        $tipo_req='eq';

//        $id_cot=$necArray[$_POST['_id_nec']]['id_cotizacion'];
        
        $query="Select * from cotizaciones where id_lab=" . $idlab . " and tipo='" . $tipo_req . "' order by id_cotizacion";
        //echo $query ."</br>". $id_cot . "</br>" . $lab;
	
	echo $query;
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