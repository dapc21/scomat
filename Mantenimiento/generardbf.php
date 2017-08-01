<?php

// "Definición" de la base de datos
$def = array(
  array("nombre",     "C",  50),
  array("telefono",      "C",   12),
  array("saldo",    "N", 10,2)
);

// creación
if (!dbase_create('telf.dbf', $def)) {
  echo "Error, no se puede crear la base de datos\n";
}
else{
	echo "creado";
}


// abrir en modo lectura-escritura
$db = dbase_open('telf.dbf', 2);

if ($db){
  dbase_add_record($db, array(
      'jesus', 
      '04148412918', 
      '200'));   
  dbase_close($db);
}
?>
