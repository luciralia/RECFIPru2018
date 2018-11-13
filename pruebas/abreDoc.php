<?php
$file = fopen("inventarioDECD.csv","r");

while(! feof($file))
  {
  print_r(fgetcsv($file));
  }

fclose($file);
?>