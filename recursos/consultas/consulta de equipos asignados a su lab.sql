/*General*/
select e.*, l.*,bi.*
from equipo e, laboratorios l, bienes_inventario bi
where e.id_lab=l.id_lab
AND e.bn_id=bi.bn_id
AND e.id_lab=103


/*Para sistema, no se necesitan tantos datos del laboratorio*/

select e.*, l.id_lab, l.nombre, id_dep,bi.*
from equipo e, laboratorios l, bienes_inventario bi
where e.id_lab=l.id_lab
AND e.bn_id=bi.bn_id
AND e.id_lab=103