<?php
require_once("procesos.php");
$acceso = conexion();

/****************************************************** 
ELIMINAR TABLAS
******************************************************/

/** Eliminar Tabla tipo_movimiento **/
$acceso->objeto->ejecutarSql(
'DROP TABLE tipo_movimiento;'
);
/** Eliminar Tabla mov_mat **/
$acceso->objeto->ejecutarSql(
'DROP TABLE mov_mat;'
);
/** Eliminar Tabla movimiento **/
$acceso->objeto->ejecutarSql(
'DROP TABLE movimiento;'
);
/** Eliminar Tabla deposito **/
$acceso->objeto->ejecutarSql(
'DROP TABLE deposito;'
);
/** Eliminar Tabla unidad_medida **/
$acceso->objeto->ejecutarSql(
'DROP TABLE unidad_medida;'
);



/****************************************************** 
CREAR TABLAS E ÍNDICES
******************************************************/

/** Crear Tabla tipo_movimiento **/
$acceso->objeto->ejecutarSql(
'CREATE TABLE tipo_movimiento
(
  id_tm character(13) NOT NULL,
  nombre_tm character(50),
  tipo_ent_sal character(10),
  uso_tm character(15),
  status_tm character(10),
  CONSTRAINT pk_tipo_movimiento PRIMARY KEY (id_tm)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tipo_movimiento
  OWNER TO postgres;'
);
$acceso->objeto->ejecutarSql(
'CREATE UNIQUE INDEX tipo_movimientopk_6
  ON tipo_movimiento
  USING btree
  (id_tm COLLATE pg_catalog."default");'
);
/*while ($row=row($acceso))
	{
		$cad=$cad.opcion(trim($row["id_tm"]),trim($row["nombre_tm"])." ".trim($row["tipo_ent_sal"]));
	}

echo $cad;
echo 'listo';
*/
?>