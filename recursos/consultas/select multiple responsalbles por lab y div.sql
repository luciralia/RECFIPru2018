select distinct laboratorios.nombre, usuarios.nombre, a_paterno, a_materno from laboratorios, usuarios, divisiones, departamentos where divisiones.id_div = 4 and laboratorios.id_dep = departamentos.id_dep and divisiones.id_div = departamentos.id_div and laboratorios.id_responsable=usuarios.id_usuario;


/*--------sistema------------*/
select departamentos.nombre as departamento, laboratorios.nombre as laboratorio, usuarios.nombre, a_paterno, a_materno 
from laboratorios, usuarios, divisiones, departamentos 
where usuarios.id_usuario = 3
and laboratorios.id_dep = departamentos.id_dep 
and divisiones.id_div = departamentos.id_div 
and laboratorios.id_responsable=usuarios.id_usuario;





select id_nec,necesidades_equipo.descripcion,prioridad,plazo,cat_plazo_nec.descripcion as Plazo from necesidades_equipo, cat_plazo_nec, laboratorios, departamentos, divisiones where necesidades_equipo.id_lab=103 and plazo=id


select distinct departamentos.nombre, usuarios.id_usuario, usuarios.nombre, a_paterno, a_materno from usuarios, divisiones, departamentos where divisiones.id_div = 1 and divisiones.id_div = departamentos.id_div and departamentos.id_responsable=usuarios.id_usuario;