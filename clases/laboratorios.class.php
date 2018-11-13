<?php

require_once(dirname(__FILE__).'/../lib/adodb5/adodb-active-record.inc.php');
require_once(dirname(__FILE__).'/class.conexion_db.php');
require_once('../conexion.php');
 
$db=conexion_db::getInstance();
 ADOdb_Active_Record::SetDatabaseAdapter($db);
 session_start();
 

/* class laboratorios extends ADOdb_Active_Record{

var $_table = 'laboratorios';*/

 class laboratorios {


function getResponsable($idresp){

			if ($idresp==NULL||$idresp==0){
			
			$salidar=""; 
			
			} else {
			
			$query="Select * from usuarios where id_usuario=" .$idresp;
			
				$result_cot = pg_query($query) or die('Hubo un error con la base de datos en responsable');
			
				while ($datosc = pg_fetch_array($result_cot))
					{
					$salidar = $datosc['nombre'] . " " . $datosc['a_paterno'] . " " . $datosc['a_materno'];
					}
				}
			return $salidar;
	}


function getLaboratorio($idlab){

			if ($idlab==NULL||$idlab==0){
			
			$salidar="Ninguno"; 
			
			} else {
			
			$query="Select * from laboratorios where id_lab=" . $idlab;
			
				$result_cot = pg_query($query) or die('Hubo un error con la base de datos en lab con id_lab');
				
				// echo "solicitud a laboratorios.class: "; print_r($_GET);
				 
				while ($datosc = pg_fetch_array($result_cot))
					{
					$salidar = $datosc['nombre'];
					$_SESSION['tipo_lab']=$datosc['tipo_lab'];
					}
				}
			
			return $salidar;
	}

function getDivision($iddiv){

			if ($iddiv==NULL||$iddiv==0)
			
			$salidar="Ninguno"; 
			
			 else {
			
			$query="Select * from divisiones where id_div=" . $iddiv;
			
				$result_cot = pg_query($query) or die('Hubo un error con la base de datos en lab con id_lab');
				
				// echo "solicitud a laboratorios.class: "; print_r($_GET);
				 
				while ($datosc = pg_fetch_array($result_cot))
					{
					$salidar = $datosc['nombre'];
					//$_SESSION['tipo_lab']=$datosc['tipo_lab'];
					}
				}
			
			return $salidar;
	}


function getResplab($idlab){

			$query="Select l.nombre as laboratorio, u.nombre as nombrer, a_paterno, a_materno 
			from laboratorios l, usuarios u 
			where l.id_responsable=u.id_usuario
			AND id_lab=" . $idlab;
			
				$result = pg_query($query) or die('Hubo un error con la base de datos en resp lab');
			
				while ($datos = pg_fetch_array($result,NULL,PGSQL_ASSOC))
					{
					$salidar = $datos['nombrer'] .' '. $datos['a_paterno'].' '.$datos['a_materno'];
					}
				
			return $salidar;



	}


function getAct($acts,$tipo)
		{
			if($acts%2==0 && $tipo=='doc'){
					$salida=2;
					return $salida;
			} 
				   
			if($acts%3==0 && $tipo=='inv'){
				$salida=3;
				return $salida;
					} 
			if($acts%5==0 && $tipo=='abi'){
					$salida=5;
					return $salida;
					} 
		}//fin metodo

function cmbEdif($idedif)
	{
						
					$query="select * from cat_edificio order by descripcion asc";
					
				//	echo $query;
					$result = pg_query($query) or die('Hubo un error con la base de datos en cmb_edif');
					
					$salida='<select name="id_edif" id="id_edif">'; 
					
					while ($datosc = pg_fetch_array($result))
						{
				
					$sele=($datosc['id']==$idedif)?" selected='selected'":"";
					$salida.= "<option value='" . $datosc['id'] . "'" .$sele. ">" . $datosc['descripcion'] . "</option>";
					
					
						}
				//	return $salida;
					$salida.="</select>";
					echo $salida;
	}//final metodo







} //fin clase
	
	?>