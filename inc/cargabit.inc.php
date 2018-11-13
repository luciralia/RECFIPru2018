<?php

require_once('../conexion.php');
require_once('../clases/cotiza.class.php');
require_once('../clases/laboratorios.class.php');
require_once('../clases/requerimientos.class.php');
require_once('../clases/log.class.php');

$obj_cotiza = new Cotiza();
$lab = new laboratorios();
$obj_req= new Requerimiento();
$logger=new Log();

/*
if ($_GET['mod']=='serv'){
$tiposerv="(em.tipo_serv IS NULL OR em.tipo_serv IS FALSE) ";
} else {$tiposerv='TRUE';
$tiposerv="em.tipo_serv IS TRUE";
}

$query = "SELECT l.id_lab as id_lab, em.id_evento as id_evento, em.id_bitacora as id_bitacora, em.tipo_mant as tipo, em.fecha as fregistro, em.tipo_falla as falla, em.usuario_reporta as reporta, em.fecha_salida as fsalida, em.fecha_recepcion as frecepcion, em.costo as costo, em.fecha_prox_mant as fprox, em.descripcion as desc_serv, em.garantia as garantia, bi.bn_desc as bn_desc, bi.bn_marca as marca, bi.bn_modelo as modelo, bi.bn_serie as serie, bi.bn_clave as clave, l.nombre AS laboratorio, dp.nombre AS departamento, dv.nombre AS division, u.nombre AS RL_Nombre, u.a_paterno AS RL_apaterno, u.a_materno AS RL_amaterno, em.id_cotizacion as id_cotizacion, em.ok as sitio, em.tipo_serv, e.bn_id as bn_id
FROM eventos_mantenimiento em, bitacora b, equipo e, bienes_inventario bi, laboratorios l, departamentos dp, divisiones dv, usuarios u
WHERE em.id_bitacora = b.id_bitacora 
AND bi.bn_id = e.bn_id 
AND e.bn_id = em.id_equipo 
AND e.id_lab = b.id_lab 
AND l.id_lab = e.id_lab 
AND l.id_dep = dp.id_dep 
AND dp.id_div = dv.id_div 
AND l.id_responsable=u.id_usuario 
AND " . $tiposerv . " 
AND l.id_lab=";

switch ($_GET['orden']){
 			case "equipo":
			$query.= $_GET['lab'] . " order by bn_desc asc, fregistro desc";
//			return $query;
 			break;
 			case "clave":
			$query.= $_GET['lab'] . " order by clave asc";
 			break;
 			case "reciente":
			$query.= $_GET['lab'] . " order by fregistro desc";
 			break;
			case "antiguo":
			$query.= $_GET['lab'] . " order by fregistro asc";
 			break;
 			default:
			$query.=$_GET['lab'] . " order by tipo, fregistro desc";
	//		return $query;
 			break;
}

*/


// echo $query; ?>

<?php $action1="../view/inicio.html.php?lab=". $_GET['lab'] ."&mod=". $_GET['mod'] .'&orden='. $_GET['orden'];?>
<!-- <form action="<?php echo $action1; ?>" method="post" name="fnuevo">
<p style="text-align: right"> <input name="accion" type="submit" value="nuevo" id="botonblu"/>
</form>-->
<?php if ($_GET['mod']=='servi'){ $logger->putLog(47,2);?>
<!--<div style="text-align: right; display: inline-block;"> <div id="botonblu" > <a href="<?php echo $action1 . '&accion=nuevo';?>">Nuevo individual</a></div></div> -->
<!-- <div style="text-align: right; display: inline-block;"> <?php if (($_SESSION['permisos'][2]%3)==0){ ?><div id="botonblu" > <a href="<?php echo $action1 . '&accion=nuevob';?>">Seleccionar equipos</a></div><?php }?></div>-->	
<?php } else { $logger->putLog(23,2);?>

<div style="text-align: right"><?php if (($_SESSION['permisos'][2]%3)==0){ ?> <div id="botonblu" > <a href="<?php echo $action1 . '&accion=nuevo';?>">Nuevo registro</a></div><?php }?></div>	
<?php }?>

<div class="block" id="necesidades_content">      
<?php 
		 //echo "Responsable: " . $lab->getResponsable($_SESSION['id_usuario']); echo " Tipo de servicio: " . $_GET['mod'];?> 

<form action="inicio.html.php" method="get" name="orderby">
        Ordenar por: <select name="orden">
          <option value="orden" <?php echo $sel=(!isset($_GET['orden'])||$_GET['orden']=='orden') ? 'selected="selected"':''; ?>>Seleccione...</option>
          <option value="equipo" <?php echo $sel=($_GET['orden']=='equipo')? 'selected="selected"': "";?>>Equipo</option>
          <option value="clave" <?php echo $sel=($_GET['orden']=='clave')? 'selected="selected"': "";?>>No. Inventario</option>
          <option value="orden" <?php echo $sel=($_GET['orden']=='orden')? 'selected="selected"': "";?>>Tipo</option>
          <option value="reciente" <?php echo $sel=($_GET['orden']=='reciente')? 'selected="selected"': "";?>>Más reciente</option>
          <option value="antiguo" <?php echo $sel=($_GET['orden']=='antiguo')? 'selected="selected"': "";?>>Más antiguo</option>
           </select>
    
<?php
	echo "<input name='lab' type='hidden' value='". $_GET['lab']."' /> \n";
	echo "<input name='mod' type='hidden' value='".$_GET['mod']."' /> \n";
		?>

<input name="bOrden" type="submit" value="ordenar" />
</form>
<?php
/**
 * Calendario PHP/HTML5
 *
 * Calendario muy básico desarrollado sobre PHP y HTML5, que nos muestra el mes
 * actual con la posibilidad de elegir otro.
 *
 * @author		Rubén Martín - www.rubenmartin.me | @hasdpk | skype: hasdpk
 * @copyright	CC BY-SA
 * @version		0.1 first release
 */

// Establecer el idioma al Español para strftime().
setlocale( LC_TIME, 'spanish' );

// Si no se ha seleccionado mes, ponemos el actual y el año
$month = isset( $_GET[ 'month' ] ) ? $_GET[ 'month' ] : date( 'Y-n' );

$week = 1;

for ( $i=1;$i<=date( 't', strtotime( $month ) );$i++ ) {

	$day_week = date( 'N', strtotime( $month.'-'.$i )  );

	$calendar[ $week ][ $day_week ] = $i;

	if ( $day_week == 7 )
		$week++;

}

?>

<!DOCTYPE html>


		<table border="1">
		
			<thead>
		
				<tr>
				
					<td colspan="7"><?php echo strftime( '%B %Y', strtotime( $month ) ); ?></td>
				
				</tr>
			
				<tr>
				
					<td>Lunes</td>
					<td>Martes</td>			
					<td>Miércoles</td>			
					<td>Jueves</td>			
					<td>Viernes</td>			
					<td>Sábado</td>			
					<td>Domingo</td>			
				
				</tr>
				
			</thead>
			
			<tbody>
		
				<?php foreach ( $calendar as $days ) : ?>
				
					<tr>
					
						<?php for ( $i=1;$i<=7;$i++ ) : ?>
						
							<td>
							
								<?php echo isset( $days[ $i ] ) ? $days[ $i ] : ''; ?>
							
							</td>
						
						<?php endfor; ?>
					
					</tr>
				
				<?php endforeach; ?>
				
			</tbody>
			
			<tfoot>
			
				<tr>
				
					<td colspan="7">
			
						<form method="get">
						
							<input type="month" name="month">
							<input type="submit">
						
						</form>
						
					</td>
					
				</tr>
				
			</tfoot>
		
		</table>


<?php


$tipo_semana = 1;
$tipo_mes = 1;

$MESCOMPLETO[1] = 'Enero';
$MESCOMPLETO[2] = 'Febrero';
$MESCOMPLETO[3] = 'Marzo';
$MESCOMPLETO[4] = 'Abril';
$MESCOMPLETO[5] = 'Mayo';
$MESCOMPLETO[6] = 'Junio';
$MESCOMPLETO[7] = 'Julio';
$MESCOMPLETO[8] = 'Agosto';
$MESCOMPLETO[9] = 'Septiembre';
$MESCOMPLETO[10] = 'Octubre';
$MESCOMPLETO[11] = 'Noviembre';
$MESCOMPLETO[12] = 'Diciembre';

$MESABREVIADO[1] = 'Ene';
$MESABREVIADO[2] = 'Feb';
$MESABREVIADO[3] = 'Mar';
$MESABREVIADO[4] = 'Abr';
$MESABREVIADO[5] = 'May';
$MESABREVIADO[6] = 'Jun';
$MESABREVIADO[7] = 'Jul';
$MESABREVIADO[8] = 'Ago';
$MESABREVIADO[9] = 'Sep';
$MESABREVIADO[10] = 'Oct';
$MESABREVIADO[11] = 'Nov';
$MESABREVIADO[12] = 'Dic';

$SEMANACOMPLETA[0] = 'Domingo';
$SEMANACOMPLETA[1] = 'Lunes';
$SEMANACOMPLETA[2] = 'Martes';
$SEMANACOMPLETA[3] = 'Miércoles';
$SEMANACOMPLETA[4] = 'Jueves';
$SEMANACOMPLETA[5] = 'Viernes';
$SEMANACOMPLETA[6] = 'Sábado';

$SEMANAABREVIADA[0] = 'Dom';
$SEMANAABREVIADA[1] = 'Lun';
$SEMANAABREVIADA[2] = 'Mar';
$SEMANAABREVIADA[3] = 'Mie';
$SEMANAABREVIADA[4] = 'Jue';
$SEMANAABREVIADA[5] = 'Vie';
$SEMANAABREVIADA[6] = 'Sáb';

////////////////////////////////////
if($tipo_semana == 0){
$ARRDIASSEMANA = $SEMANACOMPLETA;
}elseif($tipo_semana == 1){
$ARRDIASSEMANA = $SEMANAABREVIADA;
}
if($tipo_mes == 0){
$ARRMES = $MESCOMPLETO;
}elseif($tipo_mes == 1){
$ARRMES = $MESABREVIADO;
}

if(!$dia) $dia = date(d);
if(!$mes) $mes = date(n);
if(!$ano) $ano = date(Y);

$TotalDiasMes = date(t,mktime(0,0,0,$mes,$dia,$ano));
$DiaSemanaEmpiezaMes = date(w,mktime(0,0,0,$mes,1,$ano));
$DiaSemanaTerminaMes = date(w,mktime(0,0,0,$mes,$TotalDiasMes,$ano));
$EmpiezaMesCalOffset = $DiaSemanaEmpiezaMes;
$TerminaMesCalOffset = 6 - $DiaSemanaTerminaMes;
$TotalDeCeldas = $TotalDiasMes + $DiaSemanaEmpiezaMes + $TerminaMesCalOffset;


if($mes == 1){
$MesAnterior = 12;
$MesSiguiente = $mes + 1;
$AnoAnterior = $ano - 1;
$AnoSiguiente = $ano;
}elseif($mes == 12){
$MesAnterior = $mes - 1;
$MesSiguiente = 1;
$AnoAnterior = $ano;
$AnoSiguiente = $ano + 1;
}else{
$MesAnterior = $mes - 1;
$MesSiguiente = $mes + 1;
$AnoAnterior = $ano;
$AnoSiguiente = $ano;
$AnoAnteriorAno = $ano - 1;
$AnoSiguienteAno = $ano + 1;
}

$direc="mod=". $_GET['mod'] . "&lab=" . $_GET['lab'] . "&accion=" . $_GET['accion'];

print "<table style=\"font-family:arial;font-size:9px\" bordercolor=navy align=center border=0 cellpadding=1 cellspacing=1>";
print " <tr>";
print " <td colspan=10>";
print " <table border=0 align=center width=\"1%\" style=\"font-family:arial;font-size:9px\">";
print " <tr>";
print " <td width=\"1%\"><a href=\"$PHP_SELF?$direc&mes=$mes&ano=$AnoAnteriorAno\"><img src=atras2.gif border=0></a></td>";
print " <td width=\"1%\"><a href=\"$PHP_SELF?$direc&mes=$MesAnterior&ano=$AnoAnterior\"><img src=atras.gif border=0></a></td>";
print " <td width=\"1%\" colspan=\"1\" align=\"center\" nowrap><b>".$ARRMES[$mes]." - $ano</b></td>";
print " <td width=\"1%\"><a href=\"$PHP_SELF?$direc&mes=$MesSiguiente&ano=$AnoSiguiente\"><img src=avanzar.gif border=0></a></td>";
print " <td width=\"1%\"><a href=\"$PHP_SELF?$direc&mes=$mes&ano=$AnoSiguienteAno\"><img src=avanzar2.gif border=0></a></td>";
print " </tr>";
print " </table>";
print " </td>";
print "</tr>";
print "<tr>";
foreach($ARRDIASSEMANA AS $key){
print "<td bgcolor=#ccccff><b>$key</b></td>";
}
print "</tr>";

for($a=1;$a <= $TotalDeCeldas;$a++){ 
if(!$b) $b = 0;
if($b == 7) $b = 0;
if($b == 0) print '<tr>';
if(!$c) $c = 1;
if($a > $EmpiezaMesCalOffset AND $c <= $TotalDiasMes){
if($c == date(d) && $mes == date(m) && $ano == date(Y)){
print "<td bgcolor=\"#ffcc99\">$c<br></td>";
}elseif($b == 0 OR $b == 6){
print "<td bgcolor=#99cccc>$c</td>";
}else{
print "<td bgcolor=\"#EEEEEE\">$c</td>";
}
$c++;
}else{
print "<td> </td>";
}
if($b == 6) print '</tr>';
$b++;
}
print "<tr><td align=center colspan=10></a></td></tr>";
print "</table>";
?>









          </table>
                </div>