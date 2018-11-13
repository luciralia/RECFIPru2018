"select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre as nresp, a_paterno, a_materno, de.nombre as depa, di.nombre as div,
u.tel1 as tel1,u.email as email,u.ext as ext
from laboratorios l, departamentos de, divisiones di, usuarios u, cat_edificio e where l.id_responsable =" . $_SESSION['id_usuario'] . " 
and id_lab=103
and l.id_dep=de.id_dep
and de.id_div=di.id_div
and l.id_edif=e.id
and l.id_responsable=u.id_usuario";


select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre as nresp, a_paterno, a_materno, de.nombre as depa, di.nombre as div,
u.tel1 as tel1,u.email as email,u.ext as ext, e.descripcion as edif, l.detalle_ub as ubica, l.dir_postal as postal
from laboratorios l, departamentos de, divisiones di, usuarios u, cat_edificio e where l.id_responsable = 3 
and id_lab=103
and l.id_dep=de.id_dep
and de.id_div=di.id_div
and l.id_edif=e.id
and l.id_responsable=u.id_usuario


/* La buena para el sistema */

"select id_lab, l.id_dep, l.id_responsable, l.nombre as laboratorio,  u.nombre as nresp, a_paterno, a_materno, de.nombre as depa, di.nombre as div,
u.tel1 as tel1,u.email as email,u.ext as ext, e.descripcion as edif, l.detalle_ub as ubica, l.dir_postal as postal
from laboratorios l, departamentos de, divisiones di, usuarios u, cat_edificio e where l.id_responsable = " . $_SESSION['id_usuario'] . " 
and id_lab=103
and l.id_dep=de.id_dep
and de.id_div=di.id_div
and l.id_edif=e.id
and l.id_responsable=u.id_usuario";