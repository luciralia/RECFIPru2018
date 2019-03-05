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
	
 function combolabdiv($id_lab,$usuario)
 {
	    $querytipo="SELECT tipo_usuario FROM usuarios
	             WHERE id_usuario=".$usuario;	
		$resulttipo= @pg_query($querytipo) or die('Hubo un error con la base de datos en usuarios');	
		$tipo= pg_fetch_array($resulttipo);
	    $usutipo=$tipo[0];                  	 
		
			
    if ($usutipo==1){
          $query="select id_lab,  l.nombre as laboratorio
                  from laboratorios l
                  join departamentos de
                  on l.id_dep=de.id_dep
                  join divisiones di
                  on de.id_div=di.id_div
                  join usuarios u
                  on l.id_responsable=u.id_usuario
                  where l.id_responsable =". $usuario . " 
                  order by laboratorio";
				 
        }
	    if ($usutipo==2){
             $query = "select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre, a_paterno, a_materno, de.nombre as depa,  di.nombre as div
          from laboratorios l
          join departamentos de
          on l.id_dep=de.id_dep
          join divisiones di
          on de.id_div=di.id_div
          join  usuarios u
          on l.id_responsable=u.id_usuario
          where de.id_responsable =" . $usuario . " 
          order by laboratorio";
        
      }
	  
      if ($usutipo==7){ $consultacomp="di.id_comite=";} 
         else if($usutipo==3){$consultacomp="di.id_responsable=";}
              else if($usutipo==6){$consultacomp="di.id_secacad=";}
			  else if($usutipo==9 ){$consultacomp=" di.id_cac=";} 

					


       if ($usutipo==3 || $usutipo==6 || $usutipo==7){
          $query = "select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre, a_paterno, a_materno, de.nombre as depa,                     di.nombre as div
                    from laboratorios l, departamentos de, divisiones di, usuarios u where " . $consultacomp  . $usuario . " 
                    and l.id_dep=de.id_dep
                    and de.id_div=di.id_div
                    and l.id_responsable=u.id_usuario order by laboratorio";
                   
      }
	  
      if ($usutipo==9 ){ //se agrego el id_div LHH 7/dic/2017
      $query = "select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre, a_paterno, a_materno, de.nombre as depa,       di.nombre as div, di.id_div 
      from laboratorios l, departamentos de, divisiones di, usuarios u where " . $consultacomp  . $usuario. "
      and l.id_dep=de.id_dep
      and de.id_div=di.id_div
      and l.id_responsable=u.id_usuario order by laboratorio";
    }

				    
				
					$result = @pg_query($query) or die('Hubo un error con la base de datos en laboratoriosmmm');
					
					$salida='<select name="id_lab" id="id_lab">';
					        // <option value="0" >Ninguna</option>'; 
					
					while ($datosc = pg_fetch_array($result))
					{
						
					if($datosc['id_lab']==$id_lab)
					      $salida.= "<option value='" . $datosc['id_lab'] . "' selected='selected'>" . $datosc['laboratorio']. "</option>";
					 else 
					      $salida.= "<option value='" . $datosc['id_lab'] . "'>" . $datosc['laboratorio']. "</option>";
						
					}//Fin del while
						
				//	return $salida;
					$salida.="</select>";
					
					echo $salida;
					
	}//fin del metodo combo	dispositivo		



function getDivision($iddiv){
echo $iddiv;
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