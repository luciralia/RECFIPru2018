<strong></strong>
<?php
require_once('../conexion.php');
session_start(); 
class Censo{




function Cantidad($div,$equipo,$usu){
	if ($div!=''){
	
	 if ($equipo<>3){
		  
		$query="select count(*) as cuenta from dispositivo d
                 join laboratorios l
                 on d.id_lab=l.id_lab
                 join departamentos dep
                 on dep.id_dep=l.id_dep
                 join divisiones dv
                 on dv.id_div=dep.id_div
                 join cat_usuario_final cuf
                 on cuf.usuario_final_clave=d.usuario_final_clave
                 join cat_dispositivo cd
                 on cd.dispositivo_clave=d.dispositivo_clave
                 where dv.id_div=" . $div . 
				 " and d.dispositivo_clave=" .$equipo.
				 " and d.usuario_final_clave= " .$usu ;
			
	 }
	 else{
	 $query="select count(*) as cuenta from dispositivo d
                 join laboratorios l
                 on d.id_lab=l.id_lab
                 join departamentos dep
                 on dep.id_dep=l.id_dep
                 join divisiones dv
                 on dv.id_div=dep.id_div
                 join cat_usuario_final cuf
                 on cuf.usuario_final_clave=d.usuario_final_clave
                 join cat_dispositivo cd
                 on cd.dispositivo_clave=d.dispositivo_clave
                 where dv.id_div=" . $div . 
				 " and ( d.dispositivo_clave=3 OR  d.dispositivo_clave=4)
				   and d.usuario_final_clave= " .$usu ;
		 
	 }
	} else{$query="select count(*) as cuenta from dispositivo d
                 join laboratorios l
                 on d.id_lab=l.id_lab
                 join departamentos dep
                 on dep.id_dep=l.id_dep
                 join divisiones dv
                 on dv.id_div=dep.id_div
                 join cat_usuario_final cuf
                 on cuf.usuario_final_clave=d.usuario_final_clave
                 join cat_dispositivo cd
                 on cd.dispositivo_clave=d.dispositivo_clave
                 where d.dispositivo_clave=" .$equipo.
				 " and d.usuario_final_clave= " .$usu ;
	}
	//echo $query;
	 
				$result = pg_query($query) or die('Hubo un error con la base de datos en resp lab');
			
				while ($datos = pg_fetch_array($result,NULL,PGSQL_ASSOC))
					{
					$salidar = $datos['cuenta'] ;
					}
				
			return $salidar;

	}
	
	
	function EAR($div,$usu){
	
	if ($div!=''){
		  
		$query="select count(*) as cuenta from dispositivo d
                 join laboratorios l
                 on d.id_lab=l.id_lab
                 join departamentos dep
                 on dep.id_dep=l.id_dep
                 join divisiones dv
                 on dv.id_div=dep.id_div
                 join cat_usuario_final cuf
                 on cuf.usuario_final_clave=d.usuario_final_clave
                 join cat_dispositivo cd
                 on cd.dispositivo_clave=d.dispositivo_clave
                 where dv.id_div=" . $div . 
				 " and equipoAltorend='Si'" .
				 " and d.usuario_final_clave= " .$usu ;
	}else {
		$query="select count(*) as cuenta from dispositivo d
                 join laboratorios l
                 on d.id_lab=l.id_lab
                 join departamentos dep
                 on dep.id_dep=l.id_dep
                 join divisiones dv
                 on dv.id_div=dep.id_div
                 join cat_usuario_final cuf
                 on cuf.usuario_final_clave=d.usuario_final_clave
                 join cat_dispositivo cd
                 on cd.dispositivo_clave=d.dispositivo_clave
                 where equipoAltorend='Si'" .
				 " and d.usuario_final_clave= " .$usu ;
	}
	 $result = pg_query($query) or die('Hubo un error con la base de datos en resp lab');
			
				while ($datos = pg_fetch_array($result,NULL,PGSQL_ASSOC))
					{
					$salidar = $datos['cuenta'] ;
					}
			return $salidar;
	}
	
	function cantLab($div){
	
	if ($div!=''){
		  
		/*$query="select count(*) as cuenta from laboratorios l
                join departamentos dep
                on dep.id_dep=l.id_dep
                join divisiones dv
                on dv.id_div=dep.id_div
                where (tipo_lab='t' or tipo_lab='c')".
				 " and dv.id_div=".$div;*/
				 
			$query="select l.nombre, count(*) cuenta from dispositivo d
                 join laboratorios l
                 on d.id_lab=l.id_lab
				 join departamentos dep
                 on dep.id_dep=l.id_dep
                 join divisiones dv
                 on dv.id_div=dep.id_div
                 where (tipo_lab='t' or tipo_lab='c')
                 and dv.id_div=".$div ." group by l.nombre";
				 
	}else {
	/*	$query="select count(*) as cuenta from laboratorios l
                join departamentos dep
                on dep.id_dep=l.id_dep
                join divisiones dv
                on dv.id_div=dep.id_div
                where (tipo_lab='t' or tipo_lab='c')";*/
				$query="select l.nombre, count(*) cuenta from dispositivo d
                 join laboratorios l
                 on d.id_lab=l.id_lab
				 join departamentos dep
                 on dep.id_dep=l.id_dep
                 join divisiones dv
                 on dv.id_div=dep.id_div
                 where (tipo_lab='t' or tipo_lab='c')
                 group by l.nombre";
	}
	 //$result = pg_query($query) or die('Hubo un error con la base de datos en resp lab');
	 
	  $datos = pg_query($query);
      $cantidad= pg_num_rows($datos); 
			
				/*while ($datos = pg_fetch_array($result,NULL,PGSQL_ASSOC))
					{
					$salidar = $datos['cuenta'] ;
					}
				*/
			return $cantidad;

	}
	function cantAulas($div){
	
	if ($div!=''){
		  
		/*$query="select count(*) as cuenta from laboratorios l
                join departamentos dep
                on dep.id_dep=l.id_dep
                join divisiones dv
                on dv.id_div=dep.id_div
                where (tipo_lab='s' or tipo_lab='a')".
				 " and dv.id_div=".$div;*/
		$query="select l.nombre, count(*) cuenta from dispositivo d
                 join laboratorios l
                 on d.id_lab=l.id_lab
				 join departamentos dep
                 on dep.id_dep=l.id_dep
                 join divisiones dv
                 on dv.id_div=dep.id_div
                 where (tipo_lab='s' or tipo_lab='a')
                 and dv.id_div=".$div ." group by l.nombre";		 
	}else {
		/*$query="select count(*) as cuenta from laboratorios l
                join departamentos dep
                on dep.id_dep=l.id_dep
                join divisiones dv
                on dv.id_div=dep.id_div
                where (tipo_lab='s' or tipo_lab='a')";*/
		$query="select l.nombre, count(*) cuenta from dispositivo d
                 join laboratorios l
                 on d.id_lab=l.id_lab
				 join departamentos dep
                 on dep.id_dep=l.id_dep
                 join divisiones dv
                 on dv.id_div=dep.id_div
                 where (tipo_lab='s' or tipo_lab='a')
                 group by l.nombre";		
	}
	/* $result = pg_query($query) or die('Hubo un error con la base de datos en resp lab');
			
				while ($datos = pg_fetch_array($result,NULL,PGSQL_ASSOC))
					{
					$salidar = $datos['cuenta'] ;
					}*/
			$datos = pg_query($query);
            
			$cantidad= pg_num_rows($datos); 
				
			return $cantidad;

	}
	
	function cantEquLab($div){
	
	if ($div!=''){
		  
		$query="select l.nombre as lab,count(*) as cuenta from dispositivo d
                 join laboratorios l
                 on d.id_lab=l.id_lab
                 join departamentos dep
                 on dep.id_dep=l.id_dep
                 join divisiones dv
                 on dv.id_div=dep.id_div
                 join cat_usuario_final cuf
                 on cuf.usuario_final_clave=d.usuario_final_clave
                 join cat_dispositivo cd
                 on cd.dispositivo_clave=d.dispositivo_clave
                 where (tipo_lab='t' or tipo_lab='c')
				 and dv.id_div=".$div. 
                 " group by lab order by lab";
				
	}else {
		$query="select l.nombre as lab,count(*) as cuenta from dispositivo d
                 join laboratorios l
                 on d.id_lab=l.id_lab
                 join departamentos dep
                 on dep.id_dep=l.id_dep
                 join divisiones dv
                 on dv.id_div=dep.id_div
                 join cat_usuario_final cuf
                 on cuf.usuario_final_clave=d.usuario_final_clave
                 join cat_dispositivo cd
                 on cd.dispositivo_clave=d.dispositivo_clave
                 where (tipo_lab='t' or tipo_lab='c')
                 group by lab order by lab";
	}
	
			return $query;

	}
	function cantEquAula($div){
	
	if ($div!=''){
		  
		$query="select l.nombre as lab,count(*) as cuenta from dispositivo d
                 join laboratorios l
                 on d.id_lab=l.id_lab
                 join departamentos dep
                 on dep.id_dep=l.id_dep
                 join divisiones dv
                 on dv.id_div=dep.id_div
                 join cat_usuario_final cuf
                 on cuf.usuario_final_clave=d.usuario_final_clave
                 join cat_dispositivo cd
                 on cd.dispositivo_clave=d.dispositivo_clave
                 where (tipo_lab='s' or tipo_lab='a')
				 and dv.id_div=".$div. 
                 " group by lab order by lab";
				
	}else {
		$query="select l.nombre as lab,count(*) as cuenta from dispositivo d
                 join laboratorios l
                 on d.id_lab=l.id_lab
                 join departamentos dep
                 on dep.id_dep=l.id_dep
                 join divisiones dv
                 on dv.id_div=dep.id_div
                 join cat_usuario_final cuf
                 on cuf.usuario_final_clave=d.usuario_final_clave
                 join cat_dispositivo cd
                 on cd.dispositivo_clave=d.dispositivo_clave
                 where (tipo_lab='s' or tipo_lab='a')
                 group by lab order by lab";
	}
	
			return $query;

	}

}
?>