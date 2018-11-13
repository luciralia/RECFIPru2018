/*SISTEMA*/

select e.*, l.nombre as laboratorio, bi.* 
from equipo e, bienes_inventario bi, laboratorios l
where e.bn_id = bi.bn_id
and l.id_lab=e.id_lab
and e.id_lab=103