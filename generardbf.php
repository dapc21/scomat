<?php
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 


// "Definición" de la base de datos
$def = array(
  array("nombre",     "C",  50),
  array("telefono",      "C",   12),
  array("saldo",    "N", 10,2)
);

// creación
if (!dbase_create('../../../telf/telf.dbf', $def)) {
  echo "Error, no se puede crear la base de datos\n";
}
else{
	echo "creado";
}


$sql=" 
	SELECT nombre,apellido,telefono,
	( SELECT sum(contrato_servicio.cant_serv::numeric * contrato_servicio.costo_cobro)FROM contrato_servicio WHERE contrato_servicio.id_contrato = vista_contrato.id_contrato AND contrato_servicio.status_con_ser = 'DEUDA'::bpchar  and fecha_inst between '2006-01-01' and '2010-11-01') AS deuda

 
   FROM vista_contrato
  WHERE vista_contrato.status_contrato = 'ACTIVO'::bpchar and 
  ( SELECT sum(contrato_servicio.cant_serv::numeric * contrato_servicio.costo_cobro) FROM contrato_servicio WHERE contrato_servicio.id_contrato = vista_contrato.id_contrato AND contrato_servicio.status_con_ser = 'DEUDA'::bpchar  and fecha_inst between '2006-01-01' and '2010-11-01')>0
  ";
	//4echo $sql;
	$db = dbase_open('../../../telf/telf.dbf', 2);

if ($db){

  $acceso->objeto->ejecutarSql($sql);
	$i=1;
	while($row=row($acceso)){
		//if(strpos(trim($row["telefono"]),"0416") || strpos(trim($row["telefono"]),"0426") || strpos(trim($row["telefono"]),"0414") || strpos(trim($row["telefono"]),"0424")){
			dbase_add_record($db, array(
			trim($row["apellido"])." ".trim($row["nombre"]), 
			trim($row["telefono"]), 
			trim($row["deuda"]))); 
			echo "<br>$i:".trim($row["nombre"])." ".trim($row["apellido"])." ".trim($row["telefono"])." ".trim($row["deuda"]);
			$i++;
	//	}
	}
// abrir en modo lectura-escritura

    
  dbase_close($db);
}

?>
