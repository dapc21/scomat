
CREATE TABLE ordenes_tecnicos
(
  id_orden integer NOT NULL,
  fecha_imp date,
  id_det_orden character(8),
  fecha_orden date,
  fecha_final date,
  detalle_orden character varying(500),
  comentario_orden character(50),
  status_orden character(20),
  id_contrato character(10),
  prioridad character(20),
  CONSTRAINT pk_ordenes_tecnicos PRIMARY KEY (id_orden),
  CONSTRAINT fk_ordenes__reference_detalle_ FOREIGN KEY (id_det_orden)
      REFERENCES detalle_orden (id_det_orden) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT fk_ordenes__relations_contrato FOREIGN KEY (id_contrato)
      REFERENCES contrato (id_contrato) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ordenes_tecnicos OWNER TO postgres;

-- Index: ordenes_tecnicos_pk

-- DROP INDEX ordenes_tecnicos_pk;

CREATE UNIQUE INDEX ordenes_tecnicos_pk
  ON ordenes_tecnicos
  USING btree
  (id_orden);

-- Index: relationship4_8_fk

-- DROP INDEX relationship4_8_fk;

CREATE INDEX relationship4_8_fk
  ON ordenes_tecnicos
  USING btree
  (id_contrato);

-- Index: relationship_8_fk

-- DROP INDEX relationship_8_fk;

CREATE INDEX relationship_8_fk
  ON ordenes_tecnicos
  USING btree
  (id_det_orden);




CREATE TABLE orden_grupo
(
  id_orden bigint NOT NULL,
  id_gt character(8) NOT NULL,
  CONSTRAINT orden_grupo_pkey PRIMARY KEY (id_orden, id_gt),
  CONSTRAINT fk_orden_gr_reference_grupo_tr FOREIGN KEY (id_gt)
      REFERENCES grupo_trabajo (id_gt) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT fk_orden_gr_reference_ordenes_ FOREIGN KEY (id_orden)
      REFERENCES ordenes_tecnicos (id_orden) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
)
WITH (
  OIDS=FALSE
);
ALTER TABLE orden_grupo OWNER TO postgres;

-- Index: orden_grupo_2_pk

-- DROP INDEX orden_grupo_2_pk;

CREATE INDEX orden_grupo_2_pk
  ON orden_grupo
  USING btree
  (id_gt);

-- Index: orden_grupo_3_pk

-- DROP INDEX orden_grupo_3_pk;

CREATE INDEX orden_grupo_3_pk
  ON orden_grupo
  USING btree
  (id_orden);

-- Index: orden_grupo_4_pk

-- DROP INDEX orden_grupo_4_pk;

CREATE UNIQUE INDEX orden_grupo_4_pk
  ON orden_grupo
  USING btree
  (id_orden, id_gt);




CREATE TABLE visitas
(
  id_visita character(8) NOT NULL,
  id_orden bigint,
  fecha_visita date,
  comenta_visita text,
  hora character(10),
  CONSTRAINT pk_visitas PRIMARY KEY (id_visita),
  CONSTRAINT fk_visitas_reference_ordenes_ FOREIGN KEY (id_orden)
      REFERENCES ordenes_tecnicos (id_orden) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
)
WITH (
  OIDS=FALSE
);
ALTER TABLE visitas OWNER TO postgres;

-- Index: visitas_1_pk

-- DROP INDEX visitas_1_pk;

CREATE UNIQUE INDEX visitas_1_pk
  ON visitas
  USING btree
  (id_visita);

-- Index: visitas_2_pk

-- DROP INDEX visitas_2_pk;

CREATE INDEX visitas_2_pk
  ON visitas
  USING btree
  (id_orden);





CREATE OR REPLACE VIEW vista_ordengrupo AS 
 SELECT detalle_orden.id_det_orden, detalle_orden.id_tipo_orden, ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_final, ordenes_tecnicos.status_orden, orden_grupo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.status_grupo
   FROM detalle_orden, ordenes_tecnicos, orden_grupo, grupo_trabajo
  WHERE grupo_trabajo.id_gt = orden_grupo.id_gt AND orden_grupo.id_orden = ordenes_tecnicos.id_orden AND ordenes_tecnicos.id_det_orden = detalle_orden.id_det_orden;

ALTER TABLE vista_ordengrupo OWNER TO postgres;



CREATE OR REPLACE VIEW vista_orden AS 
 SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_final, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, contrato.status_contrato, zona.nombre_zona, zona.id_zona, ( SELECT count(*) AS num_vis
           FROM visitas
          WHERE ordenes_tecnicos.id_orden = visitas.id_orden) AS num_visitas
   FROM detalle_orden, contrato, ordenes_tecnicos, tipo_orden, persona, cliente, calle, sector, zona
  WHERE tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden AND detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden  AND ordenes_tecnicos.id_contrato = contrato.id_contrato AND contrato.cli_id_persona = cliente.id_persona AND cliente.id_persona = persona.id_persona AND contrato.id_calle = calle.id_calle AND calle.id_sector = sector.id_sector AND sector.id_zona = zona.id_zona
  ORDER BY ordenes_tecnicos.id_orden;

ALTER TABLE vista_orden OWNER TO postgres;




CREATE OR REPLACE VIEW vista_ordengrupo AS 
 SELECT detalle_orden.id_det_orden, detalle_orden.id_tipo_orden, ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_final, ordenes_tecnicos.status_orden, orden_grupo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.status_grupo
   FROM detalle_orden, ordenes_tecnicos, orden_grupo, grupo_trabajo
  WHERE grupo_trabajo.id_gt = orden_grupo.id_gt AND orden_grupo.id_orden = ordenes_tecnicos.id_orden AND ordenes_tecnicos.id_det_orden = detalle_orden.id_det_orden;

ALTER TABLE vista_ordengrupo OWNER TO postgres;




CREATE OR REPLACE VIEW vista_rep_orden AS 
 SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_final, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, contrato.status_contrato, contrato.id_calle, vista_calle.id_sector, vista_calle.nro_calle, vista_calle.nombre_calle, vista_calle.id_zona, vista_calle.nro_sector, vista_calle.nombre_sector, vista_calle.id_franq, vista_calle.nro_zona, vista_calle.nombre_zona, vista_calle.nombre_franq
   FROM detalle_orden, contrato, ordenes_tecnicos, tipo_orden, persona, cliente, vista_calle
  WHERE tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden AND detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden AND  ordenes_tecnicos.id_contrato = contrato.id_contrato AND contrato.cli_id_persona = cliente.id_persona AND cliente.id_persona = persona.id_persona AND vista_calle.id_calle = contrato.id_calle
  ORDER BY ordenes_tecnicos.id_orden;