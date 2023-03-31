
<?php
require_once('../conexion.php');
session_start(); 
class Censo{


function Cantidad($div,$equipo,$usu){
	if ($div!=''){
	if ($equipo<>3){
		  
		$query="SELECT count(*) AS cuenta FROM dispositivo d
                JOIN laboratorios l
                on d.id_lab=l.id_lab
                 JOIN departamentos dep
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
	//Modificacions del Censo 2022
function CantidadC($div,$coord,$perfil){
	$query="SELECT  count(*) AS cuenta FROM dispositivo d
	        JOIN laboratorios l
	        ON d.id_lab=l.id_lab
	        JOIN departamentos dep
			on dep.id_dep=l.id_dep
			JOIN divisiones dv
			ON dv.id_div=dep.id_div
			JOIN cat_usuario_final cuf
			ON cuf.usuario_final_clave=d.usuario_final_clave
			WHERE ";
	if ($perfil!=4)
          $query.="usuario_perfil=".$perfil. " AND ";
	elseif($perfil=4)
		  $query.="(usuario_perfil=4 OR usuario_perfil=5) AND ";
	
	if ($div!=''){
		
	 switch ($coord){
		  case 1:
			    $query.= " (d.dispositivo_clave=3 OR d.dispositivo_clave=4)
                           AND sist_oper=1
	                       AND dv.id_div=". $div;
			break;
 		  case 2:
			    $query.= " (dispositivo_clave=3 OR dispositivo_clave=4) 
                           AND (sist_oper=2 or sist_oper=4 OR sist_oper=5 OR sist_oper=8) 
                           AND dv.id_div=". $div;
			break;
			case 3:
			    $query.= " (dispositivo_clave=3 OR dispositivo_clave=4) 
                         AND sist_oper=3
						 AND dv.id_div=". $div;
			break;
		    case 4: 
			    $query.= " dispositivo_clave=2  
                         AND  (sist_oper=1 OR  sist_oper=2 OR sist_oper=4 OR sist_oper=5 OR sist_oper=8) 
                         AND dv.id_div=". $div;
			break;
 			case 5:
			    $query.=" dispositivo_clave=2 
                          AND sist_oper=3  
                          AND dv.id_div=". $div;
			break;
		    case 6:
			    $query.=" dispositivo_clave=1 
                          AND sist_oper=7  
                          AND dv.id_div=". $div;
            break;	
			case 7:
			    $query.=" dispositivo_clave=1 
                          AND sist_oper=6  
                          AND dv.id_div=". $div;
            break;	 
		    case 8:
			    $query.= " (dispositivo_clave=5 OR dispositivo_clave=6)  
                          AND dv.id_div=". $div;
	        break; 
		
	 }//end switch
	
	} else{
		switch ($coord){
		case 1:
			    $query.= " (d.dispositivo_clave=3 OR d.dispositivo_clave=4)
                           AND sist_oper=1";
						  
		break;
 		case 2:
			    $query.= " (dispositivo_clave=3 OR dispositivo_clave=4) 
                          AND (sist_oper=2 or sist_oper=4 or sist_oper=5 or sist_oper=8)";
                    
		break;
		case 3:
			    $query.= "(dispositivo_clave=3 OR dispositivo_clave=4) 
                          AND sist_oper=3 ";
		break;		
 		case 4: 
			    $query.="dispositivo_clave=2  
                         AND  (sist_oper=1 OR sist_oper=2 OR sist_oper=4 OR sist_oper=5 OR sist_oper=8)";
	    break;
		case 5: 
			    $query.="dispositivo_clave=2  
                         AND  sist_oper=3";
	    break;		
		case 6:
			    $query.="dispositivo_clave=1 
                         AND sist_oper=7";
        break;	
		case 7:
			    $query.="dispositivo_clave=1 
                         AND sist_oper=6";
        break;			
		case 8:
			    $query.= "(dispositivo_clave=5 OR dispositivo_clave=6)";  
                         
	    break; 
		 }//end switch
	}
	//echo $query;
	 
				$result = pg_query($query) or die('Hubo un error con la base de datos en resp lab');
			
				while ($datos = pg_fetch_array($result,NULL,PGSQL_ASSOC))
					{
					$salidar = $datos['cuenta'] ;
					}
				
			return $salidar;

	}	
	
    function CantidadP ($div,$tipo){
		
		$query="SELECT COUNT (*) as cuenta
                FROM dispositivo ec 
                LEFT JOIN laboratorios l
                ON ec.id_lab=l.id_lab
                LEFT JOIN cat_familia cf
                ON ec.familia_clave=cf.id_familia
                LEFT JOIN cat_dispositivo cd
                ON ec.dispositivo_clave=cd.dispositivo_clave
                LEFT JOIN cat_marca cm
                ON cm.id_marca=ec.id_marca
                LEFT JOIN departamentos d
                ON d.id_dep=l.id_dep
				LEFT JOIN divisiones dv
				ON dv.id_div=d.id_div
                WHERE (ec.dispositivo_clave=1 or ec.dispositivo_clave=2) ";
	
		if ($div!=''){
		switch ($tipo){
		  case 1:
			    $query.= " AND EXTRACT(YEAR FROM current_date)-EXTRACT(YEAR FROM fecha_factura) < 2
                           AND dv.id_div=". $div ;
			break;
 		  case 2:
			    $query.= " AND (EXTRACT(YEAR FROM current_date)-EXTRACT(YEAR FROM fecha_factura) > 2 
				           AND EXTRACT(YEAR FROM current_date)-EXTRACT(YEAR FROM fecha_factura)<3)
                           AND dv.id_div=". $div ;
			break;
			case 3:
			    $query.= " AND (EXTRACT(YEAR FROM current_date)-EXTRACT(YEAR FROM fecha_factura) > 4 
				           AND EXTRACT(YEAR FROM current_date)-EXTRACT(YEAR FROM fecha_factura)<5)
                           AND dv.id_div=". $div ;
			break;
		    case 4: 
			    $query.= " AND EXTRACT(YEAR FROM current_date)-EXTRACT(YEAR FROM fecha_factura) > 6
                           AND dv.id_div=". $div ;
			break;
		}//fin switch
	}//fin del if
		//echo $query;
		$result = pg_query($query) or die('Hubo un error con la base de datos en resp lab');
			
				while ($datos = pg_fetch_array($result,NULL,PGSQL_ASSOC))
					{
					$salidar = $datos['cuenta'] ;
					}
			if ($salidar == null) 
				$salidar=0;
			return $salidar;
	}
	
	function CantidadS ($div,$tipo){
		$query="SELECT COUNT (*) as cuenta
                FROM dispositivo ec 
                LEFT JOIN laboratorios l
                ON ec.id_lab=l.id_lab
                LEFT JOIN cat_familia cf
                ON ec.familia_clave=cf.id_familia
                LEFT JOIN cat_dispositivo cd
                ON ec.dispositivo_clave=cd.dispositivo_clave
                LEFT JOIN cat_marca cm
                ON cm.id_marca=ec.id_marca
                LEFT JOIN departamentos d
                ON d.id_dep=l.id_dep
				LEFT JOIN divisiones dv
				ON dv.id_div=d.id_div
                WHERE ec.dispositivo_clave=6 ";
	if ($div!=''){
		switch ($tipo){
		  case 1:
			    $query.= " AND EXTRACT(YEAR FROM current_date)-EXTRACT(YEAR FROM fecha_factura) < 2
                           AND dv.id_div=". $div ;
			break;
 		  case 2:
			    $query.= " AND (EXTRACT(YEAR FROM current_date)-EXTRACT(YEAR FROM fecha_factura) > 2 
				           AND EXTRACT(YEAR FROM current_date)-EXTRACT(YEAR FROM fecha_factura)<3)
                           AND dv.id_div=". $div ;
			break;
			case 3:
			    $query.= " AND (EXTRACT(YEAR FROM current_date)-EXTRACT(YEAR FROM fecha_factura) > 4 
				           AND EXTRACT(YEAR FROM current_date)-EXTRACT(YEAR FROM fecha_factura)<5)
                           AND dv.id_div=". $div ;
			break;
		    case 4: 
			    $query.= " AND EXTRACT(YEAR FROM current_date)-EXTRACT(YEAR FROM fecha_factura) > 6
                           AND dv.id_div=". $div ;
			break;
		}//fin switch
	}//fin del if
		//echo $query;
		$result = pg_query($query) or die('Hubo un error con la base de datos en resp lab');
			
				while ($datos = pg_fetch_array($result,NULL,PGSQL_ASSOC))
					{
					$salidar = $datos['cuenta'] ;
					}
			if ($salidar == null) 
				$salidar=0;
			return $salidar;
	}
	
	
	function EAR($div,$usu){
	
	if ($div!=''){
		  
		$query="SELECT COUNT(*) AS cuenta FROM dispositivo d
                 JOIN laboratorios l
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
	
	function cantImpresoras($div,$tipo){
	
	if ($div!=''){
		   
			$query="select count(*) as cuenta from dispositivo d
            join cat_impresora ci
            on ci.id_tipoi=d.tipo_impresora
            join laboratorios l
            on d.id_lab=l.id_lab
            join departamentos dep
            on dep.id_dep=l.id_dep
            join divisiones dv
            on dv.id_div=dep.id_div
            where dv.id_div=".$div . "
            and tipo_impresora=".$tipo;
      
		
		    
	   }else {
	
				$query="select count(*) as cuenta from dispositivo d
                    join cat_impresora ci
                    on ci.id_tipoi=d.tipo_impresora
                    where tipo_impresora=".$tipo;
	}
	 $result = pg_query($query) or die('Hubo un error con la base de datos en resp lab');
	 
	 // $datos = pg_query($query);
     // $cantidad= pg_num_rows($datos); 
			
				while ($datos = pg_fetch_array($result,NULL,PGSQL_ASSOC))
					{
					$salidar = $datos['cuenta'] ;
					}
				
			return $salidar;

	}
	
	function cantDigita($div,$tipo){
	
	if ($div!=''){
		   
			$query="select count(*) as cuenta from dispositivo d
            join cat_digitaliza cd
            on cd.id_digitaliza=d.tipo_digitaliza
            join laboratorios l
            on d.id_lab=l.id_lab
            join departamentos dep
            on dep.id_dep=l.id_dep
            join divisiones dv
            on dv.id_div=dep.id_div
            where dv.id_div=".$div . "
            and d.tipo_digitaliza=".$tipo;
      
		
		    
	   }else {
	
				$query="select count(*) as cuenta from dispositivo d
                    join cat_digitaliza cd
                    on cd.id_digitaliza=d.tipo_digitaliza
                    where d.tipo_digitaliza=".$tipo;
	}
	 $result = pg_query($query) or die('Hubo un error con la base de datos en resp lab');
	 
	 // $datos = pg_query($query);
     // $cantidad= pg_num_rows($datos); 
			
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