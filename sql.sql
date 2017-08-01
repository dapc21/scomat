CREATE TABLE grupo_trabajo
(
  id_gt character(8) NOT NULL,
  fecha_creacion date,
  hora_creacion time without time zone,
  id_zona character(8),
  nombre_grupo character(30),
  status_grupo character(15),
  CONSTRAINT pk_grupo_trabajo PRIMARY KEY (id_gt)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE grupo_trabajo OWNER TO postgres;



CREATE TABLE grupo_tecnico
(
  id_gt character(8) NOT NULL,
  id_persona character(10) NOT NULL,
  CONSTRAINT grupo_tecnico_pkey PRIMARY KEY (id_gt, id_persona),
  CONSTRAINT fk_grupo_te_reference_grupo_tr FOREIGN KEY (id_gt)
      REFERENCES grupo_trabajo (id_gt) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT fk_grupo_te_reference_tecnico FOREIGN KEY (id_persona)
      REFERENCES tecnico (id_persona) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
)
WITH (
  OIDS=FALSE
);
ALTER TABLE grupo_tecnico OWNER TO postgres;


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



CREATE OR REPLACE VIEW vista_grupo AS 
 SELECT grupo_trabajo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.hora_creacion, grupo_trabajo.id_zona, grupo_trabajo.nombre_grupo, grupo_trabajo.status_grupo, zona.nombre_zona, ( SELECT count(*) AS count
           FROM grupo_tecnico
          WHERE grupo_trabajo.id_gt = grupo_tecnico.id_gt) AS nro_tecnico
   FROM zona, grupo_trabajo
  WHERE grupo_trabajo.id_zona = zona.id_zona
  ORDER BY grupo_trabajo.nombre_grupo;

ALTER TABLE vista_grupo OWNER TO postgres;


CREATE OR REPLACE VIEW vista_orden AS 
 SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.id_persona, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_final, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, vista_tecnico.cedula, vista_tecnico.nombre, vista_tecnico.apellido, detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, contrato.status_contrato, zona.nombre_zona
   FROM detalle_orden, contrato, ordenes_tecnicos, tipo_orden, persona, vista_tecnico, cliente, calle, sector, zona
  WHERE tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden AND detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden AND ordenes_tecnicos.id_persona = vista_tecnico.id_persona AND ordenes_tecnicos.id_contrato = contrato.id_contrato AND contrato.cli_id_persona = cliente.id_persona AND cliente.id_persona = persona.id_persona AND contrato.id_calle = calle.id_calle AND calle.id_sector = sector.id_sector AND sector.id_zona = zona.id_zona
  ORDER BY ordenes_tecnicos.id_orden;

ALTER TABLE vista_orden OWNER TO postgres;


insert into grupo_trabajo(id_gt,nombre_grupo,id_zona,fecha_creacion,hora_creacion,status_grupo) values ('GRT00000','ASIGNAR LUEGO','00000000','2011-04-07','18:25:49','INACTIVO');




///////////////////////05-05-2011/////////////////////////////////////


CREATE OR REPLACE VIEW vista_ordengrupo AS 
 SELECT detalle_orden.id_det_orden, detalle_orden.id_tipo_orden, ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_final, ordenes_tecnicos.status_orden, orden_grupo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.status_grupo
   FROM detalle_orden, ordenes_tecnicos, orden_grupo, grupo_trabajo
  WHERE grupo_trabajo.id_gt = orden_grupo.id_gt AND orden_grupo.id_orden = ordenes_tecnicos.id_orden AND ordenes_tecnicos.id_det_orden = detalle_orden.id_det_orden;

  
  
CREATE OR REPLACE VIEW vista_grupotecnico AS 
 SELECT tecnico.id_persona, grupo_tecnico.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.nombre_grupo, grupo_trabajo.status_grupo
   FROM tecnico, grupo_tecnico, grupo_trabajo
  WHERE tecnico.id_persona = grupo_tecnico.id_persona AND grupo_tecnico.id_gt = grupo_trabajo.id_gt;


///////////////////////28-06-2011//////////////////////////////// componente comunicacion

CREATE TABLE sms
(
  id_sms character(12) NOT NULL,
  id_contrato character(10),
  nro_sms character(20),
  tipo_sms character(15),
  telefono_sms character(20),
  fecha_sms date,
  hora_sms time without time zone,
  mensaje_sms character varying(1000),
  status_sms character(15),
  "login" character(25),
  CONSTRAINT pk_sms PRIMARY KEY (id_sms),
  CONSTRAINT fk_sms_reference_contrato FOREIGN KEY (id_contrato)
      REFERENCES contrato (id_contrato) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT sms_login_fkey FOREIGN KEY ("login")
      REFERENCES usuario ("login") MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sms OWNER TO postgres;



create table ENVIO_AUT (
   ID_ENVIO             VARCHAR(8)           not null,
   ID_FRANQ             CHAR(5)              null,
   TIPO_ENVIO           VARCHAR(15)          null,
   NOMBRE_ENVIO         VARCHAR(40)          null,
   ENVIO_SMS            VARCHAR(5)           null,
   ENVIO_EMAIL          VARCHAR(5)           null,
   DESCRIPCION_ENVIO    TEXT                 null,
   REF_ENVIO            VARCHAR(10)          null,
   TIPO_VARIABLE        VARCHAR(20)          null,
   constraint PK_ENVIO_AUT primary key (ID_ENVIO)
);

alter table ENVIO_AUT
   add constraint FK_ENVIO_AU_REFERENCE_FRANQUIC foreign key (ID_FRANQ)
      references FRANQUICIA (ID_FRANQ)
      on delete restrict on update restrict;

create table COMANDOS_SMS (
   ID_COM               VARCHAR(8)           not null,
   ID_FRANQ             CHAR(5)              null,
   TIPO_COM             VARCHAR(15)          null,
   NOMBRE_COM           VARCHAR(15)          null,
   DESCRIP_COM          TEXT                 null,
   STATUS_COM           VARCHAR(15)          null,
   constraint PK_COMANDOS_SMS primary key (ID_COM)
);
alter table COMANDOS_SMS
   add constraint FK_COMANDOS_REFERENCE_FRANQUIC foreign key (ID_FRANQ)
      references FRANQUICIA (ID_FRANQ)
      on delete restrict on update restrict;

	  
create table FORMATO_SMS (
   ID_FORM              CHAR(8)              not null,
   ID_FRANQ             CHAR(5)              null,
   NOMBRE_FORM          CHAR(50)             null,
   FORMATO              TEXT                 null,
   STATUS               CHAR(15)             null,
   constraint PK_FORMATO_SMS primary key (ID_FORM)
);

alter table FORMATO_SMS
   add constraint FK_FORMATO__REFERENCE_FRANQUIC foreign key (ID_FRANQ)
      references FRANQUICIA (ID_FRANQ)
      on delete restrict on update restrict;
	  
create table CONFIG_SMS (
   ID_CONF_SMS          CHAR(8)              not null,
   ID_FRANQ             CHAR(5)              null,
   COD_TELF_PAIS        CHAR(10)             null,
   TELEFONO_SERV        CHAR(15)             null,
   ID_CANAL_SMS         CHAR(10)             null,
   CORREO_EMP           CHAR(50)             null,
   CLAVE_CORREO         CHAR(50)             null,
   ASUNTO_CORREO        CHAR(100)            null,
   PER_TELF_FIJO        BOOL                 null,
   ENV_TODOS_TELF       BOOL                 null,
   ACT_RESP_AUT         BOOL                 null,
   SMS_RESP_AUT         TEXT                 null,
   CAMPO1               CHAR(50)             null,
   CAMPO2               CHAR(50)             null,
   CAMPO3               CHAR(50)             null,
   constraint PK_CONFIG_SMS primary key (ID_CONF_SMS)
);


alter table CONFIG_SMS
   add constraint FK_CONFIG_S_REFERENCE_FRANQUIC foreign key (ID_FRANQ)
      references FRANQUICIA (ID_FRANQ)
      on delete restrict on update restrict;

create table GERENTES_PERMITIDOS (
   ID_PERSONA           CHAR(10)             not null,
   NRO_GERENTE          CHAR(5)              null,
   TIPO_GERENTE         CHAR(30)             null,
   CARGO_GERENTE        CHAR(50)             null,
   DESCRIP_GERENTE      TEXT                 null,
   SATTUS_GERENTE       CHAR(15)             null,
   constraint PK_GERENTES_PERMITIDOS primary key (ID_PERSONA)
);

alter table GERENTES_PERMITIDOS
   add constraint FK_GERENTES_REFERENCE_PERSONA foreign key (ID_PERSONA)
      references PERSONA (ID_PERSONA)
      on delete restrict on update restrict;

	  

CREATE TABLE tecnico
(
  id_persona character(10) NOT NULL,
  num_tecnico integer,
  direccion_tec character(100),
  correo_tec character(50),
  status_tec character(15),
  CONSTRAINT pk_tecnico PRIMARY KEY (id_persona),
  CONSTRAINT fk_tecnico_inheritan_persona FOREIGN KEY (id_persona)
      REFERENCES persona (id_persona) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tecnico OWNER TO postgres;

-- Index: tecnico_pk

-- DROP INDEX tecnico_pk;

CREATE UNIQUE INDEX tecnico_pk
  ON tecnico
  USING btree
  (id_persona);


CREATE OR REPLACE VIEW vista_tecnico AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, tecnico.num_tecnico, tecnico.direccion_tec
   FROM tecnico, persona
  WHERE persona.id_persona = tecnico.id_persona
  ORDER BY persona.cedula;

ALTER TABLE vista_tecnico OWNER TO postgres;

--MODIFICAR A PARTIR DE AQUI EN CABLE BRASIL

INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU062 ', 'LEER SMS', 'LEER_SMS', 'ASDFADF', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU063 ', 'ENVIAR SMS UNICO', 'ENVIAR_SMS_UNICO', 'ASDFADF', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU064 ', 'ENVIAR SMS LOTES', 'ENVIAR_SMS_LOTES', 'ASDFADF', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU065 ', 'CONFIGURAR SMS', 'CONFIG_SMS', 'ASDFADF', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU066 ', 'VARIABLE SMS', 'VARIABLE_SMS', 'ASDFADF', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU067 ', 'PLANTILLA ENVIO', 'FORMATO_SMS', 'ASDFADF', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU068 ', 'REVISAR LISTADO SMS', 'REV_LISTADO_SMS', 'ASDFADF', 'ACTIVO');


INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001', 'MODU062', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001', 'MODU063', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001', 'MODU064', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001', 'MODU065', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001', 'MODU066', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001', 'MODU067', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001', 'MODU068', 'TRUE', 'TRUE', 'TRUE');


INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF002', 'MODU062', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF002', 'MODU063', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF002', 'MODU064', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF002', 'MODU065', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF002', 'MODU066', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF002', 'MODU067', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF002', 'MODU068', 'TRUE', 'TRUE', 'TRUE');


INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF003', 'MODU062', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF003', 'MODU063', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF003', 'MODU064', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF003', 'MODU065', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF003', 'MODU066', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF003', 'MODU067', 'TRUE', 'TRUE', 'TRUE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF003', 'MODU068', 'TRUE', 'TRUE', 'TRUE');

--eliminar el que esta y poner este con el id_sinc int
CREATE TABLE sms_sinc
(
  id_sinc bigint NOT NULL,
  mensaje_sinc text,
  telefono_sinc character(20),
  status_sinc character(15),
  CONSTRAINT pk_sms_sinc PRIMARY KEY (id_sinc)
)
WITH (
  OIDS=FALSE
);

---actualizar en personas todos las personas con rif pasarlas a cliente juridico


CREATE TABLE notas
(
  id_nota bigserial NOT NULL,
  "login" character(25),
  id_cont_serv character(12),
  tipo character(30),
  dir_ip character(20),
  fecha date,
  hora time without time zone,
  monto_anterior numeric(10,2),
  monto_posterior numeric(10,2),
  motivo character(200),
  comentario character(200),
  status character(200),
  CONSTRAINT pk_notas PRIMARY KEY (id_nota),
  CONSTRAINT fk_auditori_reference_usuario FOREIGN KEY ("login")
      REFERENCES usuario ("login") MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT notas_id_cont_serv_fkey FOREIGN KEY (id_cont_serv)
      REFERENCES contrato_servicio (id_cont_serv) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE notas OWNER TO postgres;


CREATE TABLE motivonotas
(
  idmotivonota character(8) NOT NULL,
  nombremotivonota character(50),
  status character(15),
  CONSTRAINT pk_motivonotas PRIMARY KEY (idmotivonota)
)
WITH (
  OIDS=FALSE
);



CREATE TABLE statuscont
(
  idstatus character(8) NOT NULL,
  nombrestatus character(30),
  status character(15),
  CONSTRAINT pk_statuscont PRIMARY KEY (idstatus)
)
WITH (
  OIDS=FALSE
);

CREATE TABLE recuperado
(
  id_contrato character(10),
  fecha_rec date,
  CONSTRAINT recuperado_id_contrato_fkey FOREIGN KEY (id_contrato)
      REFERENCES contrato (id_contrato) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);