select distinct id_nec, necesidades_equipo.descripcion,prioridad,plazo, cat_plazo_nec.descripcion as Plazo, laboratorios.nombre, departamentos.nombre, divisiones.nombre, cto_unitario from necesidades_equipo, laboratorios, divisiones, departamentos, cat_plazo_nec where necesidades_equipo.id_lab=laboratorios.id_lab and laboratorios.id_dep=departamentos.id_dep and departamentos.id_div=divisiones.id_div and plazo=id and divisiones.id_div=1


select distinct cant, necesidades_equipo.descripcion,prioridad, cat_plazo_nec.descripcion as Plazo, laboratorios.nombre as laboratorio, departamentos.nombre as departamento, divisiones.nombre as division, cto_unitario as costo from necesidades_equipo, laboratorios, divisiones, departamentos, cat_plazo_nec where necesidades_equipo.id_lab=laboratorios.id_lab and laboratorios.id_dep=departamentos.id_dep and departamentos.id_div=divisiones.id_div and plazo=id and divisiones.id_div=5


select distinct cant, necesidades_equipo.descripcion,prioridad, cat_plazo_nec.descripcion as Plazo, laboratorios.nombre as laboratorio, departamentos.nombre as departamento, divisiones.nombre as division, cto_unitario as costo, act_generales as actividades, cat_juztificacion_nec.descripcion as justificacion, cat_juztificacion_nec.id as num_just, impacto from necesidades_equipo, laboratorios, divisiones, departamentos, cat_plazo_nec, cat_juztificacion_nec where necesidades_equipo.id_lab=laboratorios.id_lab and laboratorios.id_dep=departamentos.id_dep and departamentos.id_div=divisiones.id_div and plazo=cat_plazo_nec.id and justificacion=cat_juztificacion_nec.id


/* Consulta original se tiene que adaptar para sistema*/

select distinct cant, ne.descripcion,prioridad, cpn.descripcion as Plazo, l.nombre as laboratorio, de.nombre as departamento, dv.nombre as division, cto_unitario as costo, act_generales as actividades, cjn.descripcion as justificacion, cjn.id as num_just, impacto 
from necesidades_equipo ne, laboratorios l, divisiones dv, departamentos de, cat_plazo_nec cpn, cat_juztificacion_nec cjn 
where ne.id_lab=l.id_lab 
and l.id_dep=de.id_dep 
and de.id_div=dv.id_div 
and plazo=cpn.id 
and justificacion=cjn.id
and ne.id_lab=103

