<?php
require_once('../conexion.php');

class Proyecto{


function getTipoProyecto($id){
 		switch ($id){
 			case 1:
 			return "Desarrollo";
 			break;
 			case 2:
 			return "Investigación";
 			break;
 			case 3:
 			return "Académico";
 			break;
 			default:
 			return "N/A";
 			break;
 		}
 	}
 	
}
?>