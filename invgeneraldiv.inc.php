
<?php

			                      $query= "select  e.*, l.nombre as laboratorio, bi.*,* 
                                           from dispositivo e 

                                           left join cat_dispositivo cd
                                           on e.dispositivo_clave=cd.dispositivo_clave
                                           left join cat_familia cf
                                           on e.familia_clave=cf.id_familia
                                           left join cat_tipo_ram ctr
                                           on e.tipo_ram_clave=ctr.id_tipo_ram
                                           left join cat_tecnologia ct
                                           on e.tecnologia_clave=ct.id_tecnologia
										   left join cat_usuario_final cuf
			                               on cuf.usuario_final_clave=e.usuario_final_clave
                                           left join cat_sist_oper cso
                                           on  e.sist_oper=cso.id_sist_oper
                                           left join cat_marca cm
                                           on cm.id_marca=e.id_marca
                                           left join cat_memoria_ram cmr
                                           on e.id_mem_ram=cmr.id_mem_ram
                                           left join bienes_inventario bi
                                           on  e.bn_id = bi.bn_id
                                           left join laboratorios l
                                           on  l.id_lab=e.id_lab
                                           left join departamentos dp
                                            on dp.id_dep=l.id_dep
                                           where id_div=";
                                           
 ?>