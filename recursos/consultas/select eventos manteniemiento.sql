select eventos_mantenimiento.id_bitacora, eventos_mantenimiento.tipo_mant, eventos_mantenimiento.fecha, eventos_mantenimiento.tipo_falla, eventos_mantenimiento.usuario_reporta, eventos_mantenimiento.fecha_salida, eventos_mantenimiento.fecha_recepcion, eventos_mantenimiento.costo, eventos_mantenimiento.fecha_prox_mant, eventos_mantenimiento.descripcion, eventos_mantenimiento.garantia from eventos_mantenimiento, bitacora WHERE eventos_mantenimiento.id_bitacora=bitacora.id_bitacora AND bitacora.id_bitacora=27


, equipo, departamentos, laboratorios, divisiones, usuarios


la buena solo eventos

select eventos_mantenimiento.id_bitacora, eventos_mantenimiento.tipo_mant, eventos_mantenimiento.fecha, eventos_mantenimiento.tipo_falla, eventos_mantenimiento.usuario_reporta, eventos_mantenimiento.fecha_salida, eventos_mantenimiento.fecha_recepcion, eventos_mantenimiento.costo, eventos_mantenimiento.fecha_prox_mant, eventos_mantenimiento.descripcion, eventos_mantenimiento.garantia, bienes_inventario.bn_desc FROM eventos_mantenimiento, bitacora, equipo, bienes_inventario WHERE eventos_mantenimiento.id_bitacora=bitacora.id_bitacora AND bienes_inventario.bn_id=equipo.bn_id AND equipo.bn_id=eventos_mantenimiento.id_equipo AND bitacora.id_bitacora=61


la buena eventos con div y departamento
select eventos_mantenimiento.id_evento, eventos_mantenimiento.id_bitacora, eventos_mantenimiento.tipo_mant, eventos_mantenimiento.fecha, eventos_mantenimiento.tipo_falla, eventos_mantenimiento.usuario_reporta, eventos_mantenimiento.fecha_salida, eventos_mantenimiento.fecha_recepcion, eventos_mantenimiento.costo, eventos_mantenimiento.fecha_prox_mant, eventos_mantenimiento.descripcion, eventos_mantenimiento.garantia, bienes_inventario.bn_desc, l.nombre, dp.nombre, dv.nombre FROM eventos_mantenimiento, bitacora, equipo, bienes_inventario, laboratorios l, departamentos dp, divisiones dv WHERE eventos_mantenimiento.id_bitacora=bitacora.id_bitacora AND bienes_inventario.bn_id=equipo.bn_id AND equipo.bn_id=eventos_mantenimiento.id_equipo AND equipo.id_lab=bitacora.id_lab AND l.id_lab=equipo.id_lab AND l.id_dep=dp.id_dep AND dp.id_div=dv.id_div AND bitacora.id_bitacora=61


buena para simplificar

select em.id_evento, em.id_bitacora, em.tipo_mant, em.fecha, em.tipo_falla, em.usuario_reporta, em.fecha_salida, em.fecha_recepcion, em.costo, em.fecha_prox_mant, em.descripcion, em.garantia, bi.bn_desc, l.nombre, dp.nombre, dv.nombre FROM eventos_mantenimiento em, bitacora b, equipo e, bienes_inventario bi, laboratorios l, departamentos dp, divisiones dv WHERE em.id_bitacora=b.id_bitacora AND bi.bn_id=e.bn_id AND e.bn_id=em.id_equipo AND e.id_lab=b.id_lab AND l.id_lab=e.id_lab AND l.id_dep=dp.id_dep AND dp.id_div=dv.id_div AND b.id_bitacora=61


Simplificada buena para vistas

SELECT em.id_evento, em.id_bitacora, em.tipo_mant, em.fecha, em.tipo_falla, em.usuario_reporta, em.fecha_salida, em.fecha_recepcion, em.costo, em.fecha_prox_mant, em.descripcion, em.garantia, bi.bn_desc, l.nombre AS laboratorio, dp.nombre AS departamento, dv.nombre AS division
 FROM eventos_mantenimiento em, bitacora b, equipo e, bienes_inventario bi, laboratorios l, departamentos dp, divisiones dv
 WHERE em.id_bitacora = b.id_bitacora AND bi.bn_id = e.bn_id AND e.bn_id = em.id_equipo AND e.id_lab = b.id_lab AND l.id_lab = e.id_lab AND l.id_dep = dp.id_dep AND dp.id_div = dv.id_div;


Buena eventos mantenimiento equipo datos completos y responsable de laboratorio

SELECT em.id_evento, em.id_bitacora, em.tipo_mant, em.fecha, em.tipo_falla, em.usuario_reporta, em.fecha_salida, em.fecha_recepcion, em.costo, em.fecha_prox_mant, em.descripcion, em.garantia, bi.bn_desc, bi.bn_marca, bi.bn_modelo, bi.bn_serie, bi.bn_clave, l.nombre AS laboratorio, dp.nombre AS departamento, dv.nombre AS division, u.nombre AS RL_Nombre, u.a_paterno AS RL_apaterno, u.a_materno AS RL_amaterno 
FROM eventos_mantenimiento em, bitacora b, equipo e, bienes_inventario bi, laboratorios l, departamentos dp, divisiones dv, usuarios u 
WHERE em.id_bitacora = b.id_bitacora AND bi.bn_id = e.bn_id AND e.bn_id = em.id_equipo AND e.id_lab = b.id_lab AND l.id_lab = e.id_lab AND l.id_dep = dp.id_dep AND dp.id_div = dv.id_div AND l.id_responsable=u.id_usuario AND b.id_bitacora=61

/*para sistema*/

SELECT l.id_lab, em.id_evento, em.id_bitacora, em.tipo_mant, em.fecha, em.tipo_falla, em.usuario_reporta, em.fecha_salida, em.fecha_recepcion, em.costo, em.fecha_prox_mant, em.descripcion, em.garantia, bi.bn_desc, bi.bn_marca, bi.bn_modelo, bi.bn_serie, bi.bn_clave, l.nombre AS laboratorio, dp.nombre AS departamento, dv.nombre AS division, u.nombre AS RL_Nombre, u.a_paterno AS RL_apaterno, u.a_materno AS RL_amaterno, em.id_cotizacion
FROM eventos_mantenimiento em, bitacora b, equipo e, bienes_inventario bi, laboratorios l, departamentos dp, divisiones dv, usuarios u, cotizaciones c 
WHERE em.id_bitacora = b.id_bitacora 
AND bi.bn_id = e.bn_id 
AND e.bn_id = em.id_equipo 
AND e.id_lab = b.id_lab 
AND l.id_lab = e.id_lab 
AND l.id_dep = dp.id_dep 
AND dp.id_div = dv.id_div 
AND l.id_responsable=u.id_usuario 
AND c.id_lab = l.id_lab
AND c.id_cotizacion=em_id_cotizacion
AND l.id_lab=103

/*para sistema mejor*/

SELECT l.id_lab as id_lab, em.id_evento as id_evento, em.id_bitacora as id_bitacora, em.tipo_mant as tipo, em.fecha as fregistro, em.tipo_falla as falla, em.usuario_reporta as reporta, em.fecha_salida as fsalida, em.fecha_recepcion as frecepcion, em.costo as costo, em.fecha_prox_mant as fprox, em.descripcion as desc_serv, em.garantia as garantia, bi.bn_desc as bn_desc, bi.bn_marca as marca, bi.bn_modelo as modelo, bi.bn_serie as serie, bi.bn_clave as clave, l.nombre AS laboratorio, dp.nombre AS departamento, dv.nombre AS division, u.nombre AS RL_Nombre, u.a_paterno AS RL_apaterno, u.a_materno AS RL_amaterno, em.id_cotizacion as id_cotizacion, em.ok as sitio
FROM eventos_mantenimiento em, bitacora b, equipo e, bienes_inventario bi, laboratorios l, departamentos dp, divisiones dv, usuarios u
WHERE em.id_bitacora = b.id_bitacora 
AND bi.bn_id = e.bn_id 
AND e.bn_id = em.id_equipo 
AND e.id_lab = b.id_lab 
AND l.id_lab = e.id_lab 
AND l.id_dep = dp.id_dep 
AND dp.id_div = dv.id_div 
AND l.id_responsable=u.id_usuario 
AND l.id_lab=103 order by fregistro


