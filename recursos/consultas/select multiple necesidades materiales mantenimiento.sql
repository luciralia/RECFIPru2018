select distinct cant, req_mat.descripcion,unidad_medida, cat_plazo_nec.descripcion as Plazo, laboratorios.nombre as laboratorio, departamentos.nombre as departamento, divisiones.nombre as division, cto_unitario as costo, act_generales as actividades, cat_juztificacion_nec.descripcion as justificacion, cat_juztificacion_nec.id as num_just, impacto from req_mat, laboratorios, divisiones, departamentos, cat_plazo_nec, cat_juztificacion_nec where req_mat.id_lab=laboratorios.id_lab and laboratorios.id_dep=departamentos.id_dep and departamentos.id_div=divisiones.id_div and plazo=cat_plazo_nec.id and justificacion=cat_juztificacion_nec.id

/*buena para el sistema*/
select distinct rm.id_req as id_req, rm.id_lab as id_lab,cant, rm.descripcion as descripcion, rm.unidad_medida as medida, cpn.descripcion as plazo, l.nombre as laboratorio, dp.nombre as departamento, di.nombre as division, cto_unitario as costo, act_generales as actividades, cjnm.descripcion as motivo, cjnm.id as num_just, impacto as justificacion, rm.id_cotizacion as id_cotizacion, rm.ref as ref
from req_mat rm, laboratorios l, divisiones di, departamentos dp, cat_plazo_nec cpn, cat_juztificacion_nec cjnm 
where rm.id_lab=l.id_lab 
and l.id_dep=dp.id_dep 
and dp.id_div=di.id_div 
and plazo=cpn.id 
and justificacion=cjnm.id
and l.id_lab=103
order by rm.ref desc