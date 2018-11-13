select id_lab, l.id_dep, l.id_responsable, l.nombre,  u.nombre, a_paterno, a_materno, de.nombre as depa, di.nombre as div
from laboratorios l, departamentos de, divisiones di, usuarios u where l.id_responsable =3
and l.id_dep=de.id_dep
and de.id_div=di.id_div
and l.id_responsable=u.id_usuario