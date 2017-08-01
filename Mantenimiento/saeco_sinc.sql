DROP TABLE alarma_perfil;
DROP VIEW vista_alarmas;
DROP TABLE alarmas;
DROP TABLE auditoria;


CREATE TABLE auditoria
(
  id_auditoria character(10) NOT NULL,
  login character(25),
  fecha date,
  hora time without time zone,
  tipo character(30),
  marca character(20),
  dir_ip character(20),
  comentario character(200),
  CONSTRAINT auditoria_pkey PRIMARY KEY (id_auditoria)
)
WITH (
  OIDS=FALSE
);

DROP TABLE broadcaster;
DROP TABLE casstbbean;

DROP TABLE castimerangebean;
DROP TABLE channel;
DROP TABLE event;
DROP TABLE hospedaje;
DROP TABLE habitacion;
DROP TABLE product;
DROP TABLE productevent;
DROP TABLE purchase;
DROP TABLE smartcard;
DROP TABLE subscription;
DROP TABLE subscriptionchannel;
DROP TABLE message;
DROP TABLE email_sinc;

CREATE TABLE email_sinc
(
  id_e_sinc character(10),
  mensaje_e_sinc text,
  email_sinc character(255),
  status_e_sinc character(5),
  CONSTRAINT id_e_sinc PRIMARY KEY (id_e_sinc)
)
WITH (
  OIDS=FALSE
);

DROP TABLE est_clientes;

CREATE TABLE est_clientes
(
  id_ec character(10) NOT NULL,
  fecha_ec date NOT NULL,
  clientes_act bigint,
  clientes_cor bigint,
  clientes_exo bigint,
  clientes_susp bigint,
  id_calle character(10) NOT NULL,
  CONSTRAINT pk_est_clientes PRIMARY KEY (fecha_ec, id_calle)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE est_clientes
  OWNER TO postgres;

-- Index: est_clientes_2_pk

-- DROP INDEX est_clientes_2_pk;

CREATE UNIQUE INDEX est_clientes_2_pk
  ON est_clientes
  USING btree
  (id_ec);

  DROP TABLE est_ingreso;

CREATE TABLE est_ingreso
(
  id_ei character(10) NOT NULL,
  fecha_ei date NOT NULL,
  ingreso_ei numeric(10,2),
  deuda_ei numeric(10,2),
  id_calle character(10) NOT NULL,
  CONSTRAINT pk_est_ingreso PRIMARY KEY (fecha_ei, id_calle)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE est_ingreso
  OWNER TO postgres;

-- Index: est_ingreso_2_pk

-- DROP INDEX est_ingreso_2_pk;

CREATE UNIQUE INDEX est_ingreso_2_pk
  ON est_ingreso
  USING btree
  (id_ei);

DROP TABLE est_ordenes;

CREATE TABLE est_ordenes
(
  id_eo character(10) NOT NULL,
  fecha_eo date NOT NULL,
  ordenes_rea bigint,
  id_calle character(10) NOT NULL,
  id_det_orden character(8) NOT NULL,
  CONSTRAINT pk_est_ordenes PRIMARY KEY (fecha_eo, id_calle, id_det_orden)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE est_ordenes
  OWNER TO postgres;

-- Index: est_ordenes_2_pk

-- DROP INDEX est_ordenes_2_pk;

CREATE UNIQUE INDEX est_ordenes_2_pk
  ON est_ordenes
  USING btree
  (id_eo);


 DROP TABLE est_tecnicos;

CREATE TABLE est_tecnicos
(
  id_et character(10) NOT NULL,
  fecha_et date NOT NULL,
  ordenes_rea numeric(10,2),
  id_det_orden character(8) NOT NULL,
  id_persona character(10) NOT NULL,
  CONSTRAINT pk_est_tecnicos PRIMARY KEY (fecha_et, id_det_orden, id_persona)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE est_tecnicos
  OWNER TO postgres;

-- Index: est_tecnicos_2_pk

-- DROP INDEX est_tecnicos_2_pk;

CREATE UNIQUE INDEX est_tecnicos_2_pk
  ON est_tecnicos
  USING btree
  (id_et);

DROP TABLE mantenimiento;

CREATE TABLE mantenimiento
(
  id_man character(10) NOT NULL,
  param1 character(100),
  param2 character(100),
  param3 character(100),
  param4 character(100),
  param5 character(200),
  CONSTRAINT mantenimiento_pkey PRIMARY KEY (id_man)
)
WITH (
  OIDS=FALSE
);



DROP VIEW vista_notas;

ALTER TABLE notas ALTER column id_nota TYPE character(10);


CREATE OR REPLACE VIEW vista_notas AS 
 SELECT notas.id_nota, notas.login, notas.id_cont_serv, notas.tipo, 
    notas.dir_ip, notas.fecha, notas.hora, notas.monto_anterior, 
    notas.monto_posterior, notas.idmotivonota, notas.comentario, notas.status, 
    notas.generado_por, motivonotas.nombremotivonota, contrato.id_contrato, 
    contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, 
    contrato.status_contrato, calle.id_sector, calle.nombre_calle, 
    persona.id_persona, persona.cedula, persona.nombre, persona.apellido, 
    sector.id_zona, sector.nombre_sector, zona.id_franq, zona.nombre_zona
   FROM notas, motivonotas, contrato, calle, persona, sector, cliente, zona
  WHERE persona.id_persona = cliente.id_persona AND cliente.id_persona = contrato.cli_id_persona AND contrato.id_calle = calle.id_calle AND calle.id_sector = sector.id_sector AND sector.id_zona = zona.id_zona AND contrato.id_contrato = notas.id_contrato AND notas.idmotivonota = motivonotas.idmotivonota
  ORDER BY notas.id_nota;

  
DROP VIEW vista_ordengrupo;
DROP VIEW vista_orden;
DROP VIEW vista_orden;
DROP VIEW vista_orden_rep;
DROP VIEW vista_orden_rep_con;
DROP VIEW vista_resumen_orden;
DROP VIEW vista_rep_orden;

ALTER TABLE ONLY public.orden_grupo DROP CONSTRAINT fk_orden_gr_reference_ordenes_;
ALTER TABLE ONLY public.abo_cortados DROP CONSTRAINT abo_cortados_id_orden_fkey;
ALTER TABLE ONLY public.visitas DROP CONSTRAINT fk_visitas_reference_ordenes_;

ALTER TABLE ordenes_tecnicos ALTER column id_orden TYPE character(10);
ALTER TABLE orden_grupo ALTER column id_orden TYPE character(10);
ALTER TABLE visitas ALTER column id_orden TYPE character(10);
ALTER TABLE abo_cortados ALTER column id_orden TYPE character(10);



ALTER TABLE ONLY orden_grupo
    ADD CONSTRAINT fk_orden_gr_reference_ordenes_ FOREIGN KEY (id_orden) REFERENCES ordenes_tecnicos(id_orden) ON UPDATE RESTRICT ON DELETE RESTRICT;



ALTER TABLE ONLY abo_cortados
    ADD CONSTRAINT abo_cortados_id_orden_fkey FOREIGN KEY (id_orden) REFERENCES ordenes_tecnicos(id_orden);


ALTER TABLE ONLY visitas
    ADD CONSTRAINT fk_visitas_reference_ordenes_ FOREIGN KEY (id_orden) REFERENCES ordenes_tecnicos(id_orden);




CREATE OR REPLACE VIEW vista_ordengrupo AS 
 SELECT detalle_orden.id_det_orden, detalle_orden.id_tipo_orden, 
    ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_orden, 
    ordenes_tecnicos.fecha_final, ordenes_tecnicos.status_orden, 
    orden_grupo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.status_grupo, 
    grupo_trabajo.nombre_grupo
   FROM detalle_orden, ordenes_tecnicos, orden_grupo, grupo_trabajo
  WHERE grupo_trabajo.id_gt = orden_grupo.id_gt AND orden_grupo.id_orden = ordenes_tecnicos.id_orden AND ordenes_tecnicos.id_det_orden = detalle_orden.id_det_orden;



CREATE OR REPLACE VIEW vista_orden AS 
 SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.id_det_orden, 
    ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, 
    ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, 
    ordenes_tecnicos.prioridad, tipo_orden.id_tipo_orden, 
    tipo_orden.nombre_tipo_orden, persona.cedula AS cedulacli, 
    persona.nombre AS nombrecli, persona.apellido AS apellidocli, 
    detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, 
    contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, 
    contrato.status_contrato, 
    ( SELECT count(*) AS num_vis
           FROM visitas
          WHERE ordenes_tecnicos.id_orden = visitas.id_orden) AS num_visitas, 
    ( SELECT orden_grupo.id_gt
           FROM orden_grupo
          WHERE ordenes_tecnicos.id_orden = orden_grupo.id_orden
         LIMIT 1) AS id_gt, 
    ( SELECT grupo_trabajo.nombre_grupo
           FROM orden_grupo, grupo_trabajo
          WHERE orden_grupo.id_gt = grupo_trabajo.id_gt AND ordenes_tecnicos.id_orden = orden_grupo.id_orden
         LIMIT 1) AS nombre_grupo, 
    ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, 
    ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, 
    ordenes_tecnicos.login AS login_emi, ordenes_tecnicos.hora AS hora_emi, 
    ordenes_tecnicos.login_imp, ordenes_tecnicos.hora_imp, 
    ordenes_tecnicos.login_fin, ordenes_tecnicos.hora_fin, contrato.id_calle, 
    vista_ubica.id_sector, vista_ubica.nombre_calle, vista_ubica.id_zona, 
    vista_ubica.nombre_sector, vista_ubica.id_ciudad, vista_ubica.id_mun, 
    vista_ubica.nombre_ciudad, vista_ubica.id_esta, vista_ubica.nombre_mun, 
    vista_ubica.id_franq, vista_ubica.nombre_zona, vista_ubica.nombre_franq, 
    vista_ubica.nombre_esta, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, 
    contrato.contrato_fisico
   FROM detalle_orden, contrato, ordenes_tecnicos, tipo_orden, persona, cliente, 
    vista_ubica, grupo_afinidad
  WHERE tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden AND detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden AND ordenes_tecnicos.id_contrato = contrato.id_contrato AND contrato.cli_id_persona = cliente.id_persona AND cliente.id_persona = persona.id_persona AND contrato.id_calle = vista_ubica.id_calle AND grupo_afinidad.id_g_a = contrato.id_g_a
  ORDER BY ordenes_tecnicos.id_orden;



CREATE OR REPLACE VIEW vista_orden AS 
 SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_imp, 
    ordenes_tecnicos.id_det_orden, ordenes_tecnicos.fecha_orden, 
    ordenes_tecnicos.fecha_final, ordenes_tecnicos.detalle_orden, 
    ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, 
    ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, 
    tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, 
    persona.cedula AS cedulacli, persona.nombre AS nombrecli, 
    persona.apellido AS apellidocli, detalle_orden.nombre_det_orden, 
    detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, 
    contrato.etiqueta, contrato.status_contrato, zona.nombre_zona, zona.id_zona, 
    ( SELECT count(*) AS num_vis
           FROM visitas
          WHERE ordenes_tecnicos.id_orden = visitas.id_orden) AS num_visitas, 
    sector.id_sector, 
    ( SELECT orden_grupo.id_gt
           FROM orden_grupo
          WHERE ordenes_tecnicos.id_orden = orden_grupo.id_orden) AS id_gt, 
    contrato.id_calle, zona.id_franq
   FROM detalle_orden, contrato, ordenes_tecnicos, tipo_orden, persona, cliente, 
    calle, sector, zona
  WHERE tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden AND detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden AND ordenes_tecnicos.id_contrato = contrato.id_contrato AND contrato.cli_id_persona = cliente.id_persona AND cliente.id_persona = persona.id_persona AND contrato.id_calle = calle.id_calle AND calle.id_sector = sector.id_sector AND sector.id_zona = zona.id_zona
  ORDER BY ordenes_tecnicos.id_orden;



CREATE OR REPLACE VIEW vista_orden_rep AS 
 SELECT ordenes_tecnicos.id_det_orden, ordenes_tecnicos.status_orden, 
    ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, 
    ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, 
    vista_ubica.id_franq, ordenes_tecnicos.fecha_canc, 
    ordenes_tecnicos.id_orden
   FROM ordenes_tecnicos, vista_ubica, contrato
  WHERE contrato.id_calle = vista_ubica.id_calle AND ordenes_tecnicos.id_contrato = contrato.id_contrato;

CREATE OR REPLACE VIEW vista_orden_rep_con AS 
 SELECT ordenes_tecnicos.id_det_orden, ordenes_tecnicos.status_orden, 
    ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, 
    ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, 
    vista_ubica.id_franq, ordenes_tecnicos.fecha_canc, contrato.id_contrato, 
    ordenes_tecnicos.id_orden
   FROM ordenes_tecnicos, vista_ubica, contrato
  WHERE contrato.id_calle = vista_ubica.id_calle AND ordenes_tecnicos.id_contrato = contrato.id_contrato;


CREATE OR REPLACE VIEW vista_resumen_orden AS 
 SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_imp, 
    ordenes_tecnicos.id_det_orden, ordenes_tecnicos.fecha_orden, 
    ordenes_tecnicos.fecha_final, ordenes_tecnicos.status_orden, 
    tipo_orden.id_tipo_orden
   FROM detalle_orden, ordenes_tecnicos, tipo_orden
  WHERE tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden AND detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden;


CREATE OR REPLACE VIEW vista_rep_orden AS 
 SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_imp, 
    ordenes_tecnicos.id_det_orden, ordenes_tecnicos.fecha_orden, 
    ordenes_tecnicos.fecha_final, ordenes_tecnicos.detalle_orden, 
    ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, 
    ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, 
    tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, 
    persona.cedula AS cedulacli, persona.nombre AS nombrecli, 
    persona.apellido AS apellidocli, detalle_orden.nombre_det_orden, 
    detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, 
    contrato.etiqueta, contrato.status_contrato, contrato.id_calle, 
    vista_calle.id_sector, vista_calle.nro_calle, vista_calle.nombre_calle, 
    vista_calle.id_zona, vista_calle.nro_sector, vista_calle.nombre_sector, 
    vista_calle.id_franq, vista_calle.nro_zona, vista_calle.nombre_zona, 
    vista_calle.nombre_franq
   FROM detalle_orden, contrato, ordenes_tecnicos, tipo_orden, persona, cliente, 
    vista_calle
  WHERE tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden AND detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden AND ordenes_tecnicos.id_contrato = contrato.id_contrato AND contrato.cli_id_persona = cliente.id_persona AND cliente.id_persona = persona.id_persona AND vista_calle.id_calle = contrato.id_calle
  ORDER BY ordenes_tecnicos.id_orden;

  
ALTER TABLE ONLY public.recibos DROP CONSTRAINT pk_recibos;
ALTER TABLE recibos ADD id_recibo character(10);


DROP VIEW vista_sms;


ALTER TABLE sms ALTER column id_sms TYPE character(10);


CREATE OR REPLACE VIEW vista_sms AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, 
    persona.telefono, sms.id_sms, sms.id_contrato, sms.nro_sms, sms.tipo_sms, 
    sms.telefono_sms, sms.fecha_sms, sms.hora_sms, sms.mensaje_sms, 
    sms.status_sms, sms.login, sms.tipo_list, sms.status_list, 
    contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, 
    contrato.fecha_contrato, contrato.hora_contrato, contrato.observacion, 
    contrato.etiqueta, contrato.costo_contrato, contrato.costo_dif_men, 
    contrato.status_contrato, contrato.nro_factura, contrato.direc_adicional, 
    contrato.numero_casa, contrato.edificio, contrato.numero_piso, 
    cliente.telf_casa, cliente.email, cliente.telf_adic
   FROM persona, sms, contrato, cliente
  WHERE persona.id_persona = cliente.id_persona AND cliente.id_persona = contrato.cli_id_persona AND contrato.id_contrato = sms.id_contrato
  ORDER BY sms.id_sms;


ALTER TABLE sms_excel ALTER column ids TYPE character(10);
ALTER TABLE sms_sinc ALTER column id_sinc TYPE character(10);

DROP INDEX public.usuario_pk;


ALTER TABLE ONLY public.estacion_trabajo  DROP CONSTRAINT fk_estacion_reference_usuario ;
ALTER TABLE ONLY public.mensualidad  DROP CONSTRAINT fk_mensuali_reference_usuario ;
ALTER TABLE ONLY public.precintos  DROP CONSTRAINT fk_precinto_reference_usuario ;
ALTER TABLE ONLY public.movimiento   DROP CONSTRAINT movimiento_login_fkey ;
ALTER TABLE ONLY public.movimiento_orden  DROP CONSTRAINT movimiento_login_fkey ;
ALTER TABLE ONLY public.sms  DROP CONSTRAINT sms_login_fkey ;
ALTER TABLE ONLY public.notas   DROP CONSTRAINT fk_auditori_reference_usuario   ;
ALTER TABLE ONLY public.usuario DROP CONSTRAINT pk_usuario;

ALTER TABLE usuario ADD id_usuario serial;
ALTER TABLE usuario ALTER column id_usuario TYPE character(10);

ALTER TABLE ONLY usuario
    ADD CONSTRAINT pk_usuario PRIMARY KEY (id_usuario);


CREATE INDEX usuaddio_pk
  ON usuario
  USING btree
  (id_usuario);
  
  
  
  ----------------------------------------------------CAMBIOS EN LA ESTRUCTURA PARA LA SINCRONIZACION--------------------------------------------
  
CREATE TABLE servidor
(
  database character(50),
  id_servidor character(5) NOT NULL,
  nombre_servidor character(50),
  direc_servidor character(255),
  status_servidor character(30),
  sincronizar character(15),
  status_ser character(15),
  direccio_ip character(50),
  usuario_p character(50),
  clave_p character(50),
  CONSTRAINT pk_servidor PRIMARY KEY (id_servidor)
)
WITH (
  OIDS=FALSE
);


CREATE TABLE inicial_id
(
  dato character(10),
  id_inicial_id character(8) NOT NULL,
  id_servidor character(5),
  inicial character(2),
  status character(15),
  CONSTRAINT pk_inicial_id PRIMARY KEY (id_inicial_id)
)
WITH (
  OIDS=FALSE
);


CREATE TABLE sincronizacion_servi
(
  dato character(10),
  id_sinc character(10) NOT NULL,
  id_servidor character(5),
  fecha_sinc date,
  hora_sin time without time zone,
  oid_inicial integer,
  oid_final integer,
  status_sinc character(15),
  CONSTRAINT pk_sincronizacion_servi PRIMARY KEY (id_sinc)
)
WITH (
  OIDS=FALSE
);


alter table INICIAL_ID
   add constraint FK_INICIAL__REFERENCE_SERVIDOR foreign key (ID_SERVIDOR)
      references SERVIDOR (ID_SERVIDOR)
      on delete restrict on update restrict;

alter table sincronizacion_servi
   add constraint FK_SINCRONI_REFERENCE_SERVIDOR foreign key (ID_SERVIDOR)
      references SERVIDOR (ID_SERVIDOR)
      on delete restrict on update restrict;


	  
CREATE UNIQUE INDEX iniialuniqeu
  ON inicial_id
  USING btree
  (inicial);

  CREATE TABLE usuario_inicial
(
  login character(25),
  id_servidor character(5),
  inicial character(2),
  CONSTRAINT pk_usuario_inicial PRIMARY KEY (login,id_servidor,inicial),
  CONSTRAINT fk_usuario__reference_servidor FOREIGN KEY (id_servidor)
      REFERENCES servidor (id_servidor) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
)
WITH (
  OIDS=FALSE
);

ALTER TABLE usuario ADD id_servidor character(10);



CREATE OR REPLACE VIEW personausuario AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, 
    persona.telefono, usuario.login, usuario.codigoperfil, usuario.password, 
    usuario.statususuario, perfil.nombreperfil, perfil.descripcionperfil, 
    perfil.statusperfil, usuario.id_franq,
    ( SELECT franquicia.nombre_franq
           FROM franquicia
          WHERE franquicia.id_franq = usuario.id_franq) AS nombre_franq,
    usuario.id_servidor,
    ( SELECT servidor.nombre_servidor
           FROM servidor
          WHERE servidor.id_servidor = usuario.id_servidor) AS nombre_servidor
   FROM persona, usuario, perfil
  WHERE persona.id_persona = usuario.id_persona AND usuario.codigoperfil = perfil.codigoperfil
  ORDER BY persona.cedula;


