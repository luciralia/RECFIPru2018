select p.*,op.organizacion as organizacion
from proyectos p, organizaciones_proyectos op
where p.id_organizacion=op.id_organizacion
and p.id_lab=103