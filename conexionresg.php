<?php

//$cadena_con = "host=132.248.52.241 port=5432 dbname=recfi_pru user=sieldi_user password=s13ld1";

$cadena_con = "host=localhost port=5432 dbname=recfi_new user=sieldi_user password=s13ld1";

//$cadena_con = "host=localhost port=5432 dbname=sieldi_dbp user=sieldi_user password=s13ld1";

$con = pg_connect($cadena_con) or die('Falló la conexion');
pg_set_client_encoding($con, "UTF-8");

?>