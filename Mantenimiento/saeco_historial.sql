--------------------------------------------------------17/07/2014-------------------------------------------------------

CREATE OR REPLACE VIEW vista_pser AS 
 SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, 
    pagos.monto_pago, pagos.nro_factura, contrato_servicio_pagado.id_cont_serv, 
    pagos.id_contrato, contrato_servicio_pagado.fecha_inst, 
    contrato_servicio_pagado.cant_serv, contrato_servicio_pagado.costo_cobro, 
    vista_servicios.id_serv, vista_servicios.tipo_servicio, 
    vista_servicios.nombre_servicio, vista_servicios.tipo_costo, 
    vista_servicios.status_servicio AS status_serv, 
    contrato_servicio_pagado.status_con_ser, pagos.status_pago, 
    pagos.obser_pago, 
    (vista_caja.nombre::text || ' '::text) || vista_caja.apellido::text AS cobrador, 
    pagos.nro_control, pagos.fecha_factura, vista_caja.id_franq, 
    franquicia.nombre_franq
   FROM pago_servicio, pagos, contrato_servicio_pagado, vista_servicios, 
    vista_caja, franquicia
  WHERE vista_caja.id_caja_cob = pagos.id_caja_cob AND pagos.id_pago = pago_servicio.id_pago AND pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv AND contrato_servicio_pagado.id_serv = vista_servicios.id_serv AND franquicia.id_franq = vista_caja.id_franq
  ORDER BY contrato_servicio_pagado.fecha_inst DESC;
  
  --------------------------------------------------------24/07/2014-------------------------------------------------------


CREATE TABLE asigna_llamada(
	dato character(10) null,
	id_all character(10) not null,
	ubica_all character(255) null,
	fecha_all date null,
	login_enc character(25) null,
	login_resp character(25) null,
	obser_all text,
	status_all character(20) null,
	CONSTRAINT pk_asigna_llamada primary key (id_all)
);

CREATE TABLE asig_lla_cli(
	dato character(10) null,
	id_lc character(10) not null,
	id_all character(10) null,
	id_contrato character(10) null,
	id_lla character(10) null,
	status_lc character(20) null,
	CONSTRAINT pk_asig_lla_cli primary key (id_lc)
);
CREATE TABLE tipo_llamada(
	dato character(10) null,
	id_tll character(10) not null,
	nombre_tll character(100) null,
	status_tll character(15) null,
	CONSTRAINT pk_tipo_llamada primary key (id_tll)
);

CREATE TABLE llamadas(
	dato character(10) null,
	id_lla character(10) not null,
	id_drl character(10) null,
	id_tll character(10) null,
	id_contrato character(10) null,
	fecha_lla date null,
	hora_lla time null,
	login character(25) null,
	obser_lla text,
	crea_alarma character(5) null,
	CONSTRAINT pk_llamadas primary key (id_lla)
);

CREATE TABLE detalle_resp(
	dato character(10) null,
	id_drl character(10) not null,
	id_trl character(10) null,
	nombre_drl character(100) null,
	status_drl character(15) null,
	CONSTRAINT pk_detalle_resp primary key (id_drl)
);

CREATE TABLE tipo_resp(
	dato character(10) null,
	id_trl character(10) not null,
	nombre_trl character(50) null,
	status_trl character(15) null,
	CONSTRAINT pk_tipo_resp primary key (id_trl)
);


INSERT INTO modulo (codigomodulo, nombremodulo, descripcionmodulo, statusmodulo, namemodulo) VALUES ('MOU009', 'asigna llamada           ', 'asigna llamada', 'Activo  ', 'asigna_llamada');
INSERT INTO modulo (codigomodulo, nombremodulo, descripcionmodulo, statusmodulo, namemodulo) VALUES ('MOU011', 'tipo llamada             ', 'tipo_llamada', 'Activo  ', 'tipo_llamada');
INSERT INTO modulo (codigomodulo, nombremodulo, descripcionmodulo, statusmodulo, namemodulo) VALUES ('MOU012', 'llamadas                 ', 'llamadas', 'Activo  ', 'llamadas');
INSERT INTO modulo (codigomodulo, nombremodulo, descripcionmodulo, statusmodulo, namemodulo) VALUES ('MOU013', 'detalle respuesta        ', 'detalle_resp', 'Activo  ', 'detalle_resp');
INSERT INTO modulo (codigomodulo, nombremodulo, descripcionmodulo, statusmodulo, namemodulo) VALUES ('MOU014', 'tipo respuesta          ', 'tipo_resp', 'Activo  ', 'tipo_resp');








-----------------------------------------------------------30/07/2014--------------------------------------------



ALTER TABLE contrato ADD tipo_fact character(20);
ALTER TABLE contrato ADD contrato_imp character(20);
ALTER TABLE contrato ADD ultima_act date;

update cliente set fecha_nac='1111-11-11';
update contrato set tipo_fact='POSTPAGO', ultima_act='2014-01-01', contrato_imp='NO';



CREATE OR REPLACE VIEW vista_contrato AS 
 SELECT contrato.id_contrato, contrato.id_calle, contrato.id_persona, 
    contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, 
    contrato.hora_contrato, contrato.observacion, contrato.etiqueta, 
    contrato.costo_contrato, contrato.costo_dif_men, contrato.status_contrato, 
    contrato.nro_factura, persona.cedula, persona.nombre, persona.apellido, 
    persona.telefono, cliente.telf_casa, cliente.email, 
    contrato.direc_adicional, contrato.numero_casa, calle.id_sector, 
    calle.nro_calle, calle.nombre_calle, sector.id_zona, sector.nro_sector, 
    sector.nombre_sector, franquicia.id_franq, zona.nro_zona, zona.nombre_zona, 
    franquicia.nombre_franq, franquicia.municipio_franq, 
    franquicia.ciudad_franq, franquicia.estado_franq, 
    franquicia.direccion_franq, contrato.edificio, contrato.numero_piso, 
    cliente.telf_adic, cliente.tipo_cliente, cliente.inicial_doc, 
    cliente.fecha_nac, contrato.deuda, contrato.postel, contrato.taps, 
    contrato.pto, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, 
    contrato.urbanizacion, zona.id_ciudad, contrato.cod_id_persona, 
    contrato.contrato_fisico, contrato.etiqueta_n,tipo_fact,contrato_imp,ultima_act
   FROM contrato, cliente, persona, calle, sector, zona, franquicia, ciudad, 
    municipio, estado, grupo_afinidad
  WHERE persona.id_persona = cliente.id_persona AND contrato.cli_id_persona = cliente.id_persona AND contrato.id_calle = calle.id_calle AND calle.id_sector = sector.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND contrato.id_g_a = grupo_afinidad.id_g_a AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND estado.id_franq = franquicia.id_franq
  ORDER BY contrato.nro_contrato;


INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (39, '1    ', '2013-04-14', 'HABILITAR ALERTA DE ACTUALIZACION                 ', '1                                                           ', '1 HABILITADO 
0 DESABILITADO                                                                                                                                                                            ');
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (40, '1    ', '2013-04-14', '"FECHA DE ACTUALIZACION"', '"01/07/2014"', '"SI LA ULTIMA FECHA DE ACTUALIZACION ES MAYOR MUESTRA LA ALARMA"');
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (41, '1    ', '2013-04-14', 'HABILITAR ALERTA DE IMPRESION  DE CONTRATO        ', '1                                                           ', '1 HABILITADO 
0 DESABILITADO                                                                                                                                                                            ');




CREATE OR REPLACE VIEW vista_contrato_auditoria AS 
 SELECT contrato.id_contrato, contrato.id_persona, contrato.cli_id_persona, 
    contrato.nro_contrato, contrato.fecha_contrato, contrato.etiqueta, 
    contrato.costo_dif_men, contrato.status_contrato, contrato.nro_factura, 
    persona.cedula, persona.nombre, persona.apellido, persona.telefono, 
    cliente.telf_casa, cliente.telf_adic, contrato.direc_adicional, 
    contrato.numero_casa, contrato.edificio, contrato.numero_piso, 
    contrato.urbanizacion, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, 
    calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, 
    zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, 
    ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, 
    estado.id_franq, estado.nombre_esta, franquicia.nombre_franq, 
    contrato.postel, contrato.pto, contrato.cod_id_persona, 
    (vista_cobrador.nombre::text || ' '::text) || vista_cobrador.apellido::text AS cobrador, 
    contrato.etiqueta_n, contrato.taps,tipo_fact
   FROM contrato, sector, zona, ciudad, franquicia, municipio, estado, calle, 
    cliente, persona, grupo_afinidad, vista_cobrador
  WHERE vista_cobrador.id_persona = contrato.cod_id_persona AND persona.id_persona = cliente.id_persona AND contrato.cli_id_persona = cliente.id_persona AND contrato.id_g_a = grupo_afinidad.id_g_a AND contrato.id_calle = calle.id_calle AND calle.id_sector = sector.id_sector AND sector.id_zona = zona.id_zona AND zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND estado.id_franq = franquicia.id_franq;

  
CREATE OR REPLACE VIEW vista_llamadas AS 
 SELECT tipo_llamada.dato, tipo_llamada.id_tll, tipo_llamada.nombre_tll, 
    tipo_llamada.status_tll, llamadas.id_lla, llamadas.id_drl, 
    llamadas.id_contrato, llamadas.fecha_lla, llamadas.hora_lla, llamadas.login, 
    llamadas.obser_lla, llamadas.crea_alarma, detalle_resp.id_trl, 
    detalle_resp.nombre_drl, detalle_resp.status_drl, tipo_resp.nombre_trl, 
    tipo_resp.status_trl, vista_contrato_auditoria.id_persona, 
    vista_contrato_auditoria.cli_id_persona, 
    vista_contrato_auditoria.nro_contrato, 
    vista_contrato_auditoria.fecha_contrato, vista_contrato_auditoria.etiqueta, 
    vista_contrato_auditoria.costo_dif_men, 
    vista_contrato_auditoria.status_contrato, 
    vista_contrato_auditoria.nro_factura, vista_contrato_auditoria.cedula, 
    vista_contrato_auditoria.nombre, vista_contrato_auditoria.apellido, 
    vista_contrato_auditoria.telefono, vista_contrato_auditoria.telf_casa, 
    vista_contrato_auditoria.telf_adic, 
    vista_contrato_auditoria.direc_adicional, 
    vista_contrato_auditoria.numero_casa, vista_contrato_auditoria.edificio, 
    vista_contrato_auditoria.numero_piso, vista_contrato_auditoria.urbanizacion, 
    vista_contrato_auditoria.id_g_a, vista_contrato_auditoria.nombre_g_a, 
    vista_contrato_auditoria.id_calle, vista_contrato_auditoria.nombre_calle, 
    vista_contrato_auditoria.id_sector, vista_contrato_auditoria.nombre_sector, 
    vista_contrato_auditoria.id_zona, vista_contrato_auditoria.nombre_zona, 
    vista_contrato_auditoria.id_ciudad, vista_contrato_auditoria.id_mun, 
    vista_contrato_auditoria.nombre_ciudad, vista_contrato_auditoria.id_esta, 
    vista_contrato_auditoria.nombre_mun, vista_contrato_auditoria.id_franq, 
    vista_contrato_auditoria.nombre_esta, vista_contrato_auditoria.nombre_franq, 
    vista_contrato_auditoria.postel, vista_contrato_auditoria.pto, 
    vista_contrato_auditoria.cod_id_persona, vista_contrato_auditoria.cobrador, 
    vista_contrato_auditoria.etiqueta_n, vista_contrato_auditoria.taps, 
    vista_contrato_auditoria.tipo_fact
   FROM tipo_llamada, llamadas, detalle_resp, tipo_resp, 
    vista_contrato_auditoria
  WHERE tipo_llamada.id_tll = llamadas.id_tll AND llamadas.id_drl = detalle_resp.id_drl AND detalle_resp.id_trl = tipo_resp.id_trl AND llamadas.id_contrato = vista_contrato_auditoria.id_contrato
  ORDER BY llamadas.fecha_lla DESC, llamadas.hora_lla DESC;

  
delete from  statuscont where  idstatus='EA00004';

INSERT INTO detalle_orden (id_det_orden, id_tipo_orden, nombre_det_orden, tipo_detalle, id_serv, emite_status, final_status, emite_cargo_tipo, emite_cargo_id_serv, final_cargo_tipo, final_cargo_id_serv, emite_deco, final_deco, emite_cablemoden, final_cablemodem, final_anula_status, fecha_ult_id_det_orden, reemplaza_act, final_agrega_id_serv) VALUES ('EA00207 ', 'EA00001 ', 'PASAR STATUS A DUPLICADO                      ', 'ACTIVO;ANULADO;CORTADO;EXONERADO;POR CORTAR;POR INSTALAR;POR RECONECTAR;POR REINSTALAR;RETIRADO;SUSPENDIDO;                                                                                             ', '        ', 'DUPLICADO                     ', 'DUPLICADO           ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);



INSERT INTO detalle_resp (dato, id_drl, id_trl, nombre_drl, status_drl) VALUES ('DATO      ', 'BG001     ', 'BG002     ', 'NUMERO EQUIVOCADO                                                                                   ', 'ACTIVO         ');
INSERT INTO detalle_resp (dato, id_drl, id_trl, nombre_drl, status_drl) VALUES ('DATO      ', 'BG002     ', 'BG002     ', 'NO DISPONIBLE                                                                                       ', 'ACTIVO         ');
INSERT INTO detalle_resp (dato, id_drl, id_trl, nombre_drl, status_drl) VALUES ('DATO      ', 'BG003     ', 'BG001     ', 'INFORMADO                                                                                           ', 'ACTIVO         ');
INSERT INTO detalle_resp (dato, id_drl, id_trl, nombre_drl, status_drl) VALUES ('DATO      ', 'BG004     ', 'BG001     ', 'CLIENTE INCONFORME                                                                                  ', 'ACTIVO         ');
INSERT INTO detalle_resp (dato, id_drl, id_trl, nombre_drl, status_drl) VALUES ('DATO      ', 'BG005     ', 'BG001     ', 'VA A PAGAR                                                                                          ', 'ACTIVO         ');


--
-- TOC entry 2742 (class 0 OID 1983691)
-- Dependencies: 402
-- Data for Name: tipo_llamada; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipo_llamada (dato, id_tll, nombre_tll, status_tll) VALUES ('DATO      ', 'BG001     ', 'LLAMADAS PARA COBROS                                                                                ', 'ACTIVO         ');
INSERT INTO tipo_llamada (dato, id_tll, nombre_tll, status_tll) VALUES ('DATO      ', 'BG002     ', 'LLAMADAS PARA RECUPERACION                                                                          ', 'ACTIVO         ');


--
-- TOC entry 2744 (class 0 OID 1983709)
-- Dependencies: 405
-- Data for Name: tipo_resp; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipo_resp (dato, id_trl, nombre_trl, status_trl) VALUES ('DATO      ', 'BG001     ', 'LLAMADA CONTESTADAS                               ', 'ACTIVO         ');
INSERT INTO tipo_resp (dato, id_trl, nombre_trl, status_trl) VALUES ('DATO      ', 'BG002     ', 'LLAMADAS NO CONTESTADAS                           ', 'ACTIVO         ');






-----------------------------------------------------------12/08/2014--------------------------------------------





create table CIERRE_HISTORICO (
   ID_CIERRE            CHAR(10)             not null,
   ID_FRANQ             CHAR(5)              null,
   FECHA_C              DATE                 null,
   TOTAL_INGRESO        NUMERIC(10,2)        null,
   TOTAL_FACTURADO      NUMERIC(10,2)        null,
   TOTAL_NOTA_CREDITO   NUMERIC(10,2)        null,
   TOTAL_X_SERVICIO     NUMERIC(10,2)        null,
   TOTAL_X_FORM_PAGO    NUMERIC(10,2)        null,
   CANT_FACTURAS        INT4                 null,
   CANT_NOTA_CREDITO    INT4                 null,
   DEUDA_ACT            NUMERIC(10,2)        null,
   DEUDA_COR            NUMERIC(10,2)        null,
   DEUDA_XINT           NUMERIC(10,2)        null,
   DEUDA_XCOR           NUMERIC(10,2)        null,
   DEUDA_XREC           NUMERIC(10,2)        null,
   DEUDA_EXO            NUMERIC(10,2)        null,
   DEUDA_OTROS          NUMERIC(10,2)        null,
   DEUDA_TOTAL          NUMERIC(10,2)        null,
   ABO_ACTIVOS          INT4                 null,
   ABO_CORTADOS         INT4                 null,
   ABO_X_INSTALAR       INT4                 null,
   ABO_X_CORTAR         INT4                 null,
   ABO_X_RECONECTAR     INT4                 null,
   ABO_EXONERADO        INT4                 null,
   ABO_OTROS            INT4                 null,
   ABO_TOTAL            INT4                 null,
   ORD_ASIG_INST        INT4                 null,
   ORD_ASIG_CORTE       INT4                 null,
   ORD_ASIG_REC         INT4                 null,
   ORD_ASIG_RECLAMO     INT4                 null,
   ORD_ASIG_OTRAS       INT4                 null,
   ORD_ASIG_TOTAL       INT4                 null,
   ORD_IMP_INST         INT4                 null,
   ORD_IMP_CORTE        INT4                 null,
   ORD_IMP_REC          INT4                 null,
   ORD_IMP_RECLAMO      INT4                 null,
   ORD_IMP_OTRAS        INT4                 null,
   ORD_IMP_TOTAL        INT4                 null,
   ORD_FIN_CORTE        INT4                 null,
   ORD_FIN_REC          INT4                 null,
   ORD_FIN_RECLAMO      INT4                 null,
   ORD_FIN_OTRAS        INT4                 null,
   ORD_FIN_TOTAL        INT4                 null,
   ORD_FIN_INST         INT4                 null,
   constraint PK_CIERRE_HISTORICO primary key (ID_CIERRE)
);





-----------------------------------------------------------13/08/2014--------------------------------------------




INSERT INTO comandos_sms (id_com, id_franq, tipo_com, nombre_com, descrip_com, status_com, sms_resp, tipo_variable, sms_error, status_error, resp_correo) VALUES ('COM00008', '1    ', 'PARA TECNICOS', 'C', 'PARA CONSULTAR  LOS DATOS DE UN CLIENTE', 'TRUE', 'CONT: @NRO_CONTRATO@,  CI :@CEDULACLI@, @NOMBRECLI@ @APELLIDOCLI@ @STATUS_CONTRATO@, DEUDA: @TOTAL_DEUDA@; @D_DEUDA@', 'CONTRATO            ', 'ERROR ESTE COMANDO ESTA HABILITADO SOLO PARA LOS EMPLEADOS DE LA EMPRESA', 'FALSE          ', '<I><B>CONT: @NRO_CONTRATO@, PRE: @ETIQUETA@, CI :@CEDULACLI@,@APELLIDOCLI@ @NOMBRECLI@, @STATUS_CONTRATO@, DEUDA: @TOTAL_DEUDA@</B></I>');
INSERT INTO comandos_sms (id_com, id_franq, tipo_com, nombre_com, descrip_com, status_com, sms_resp, tipo_variable, sms_error, status_error, resp_correo) VALUES ('COM00005', '1    ', 'PARA GERENTES', 'INGRESO', 'PARA CONSULTAR LOS INGRESOS DEL DIA ACTUAL', 'TRUE', 'MONTO ACUMULADO EN FACTURACION ES @MONTO_ACUM_P@ CON TOTAL DE @C_FACT_P@ FACTURAS. RESUMEN: @D_F_PAGO@', 'INGRESO_ACTUAL      ', 'ERROR  ESTE COMANDO SOLO ESTA PERMITIDO PARA GERENTES DE LA EMPRESA', 'FALSE          ', 'SDF');
INSERT INTO comandos_sms (id_com, id_franq, tipo_com, nombre_com, descrip_com, status_com, sms_resp, tipo_variable, sms_error, status_error, resp_correo) VALUES ('COM00006', '1    ', 'PARA GERENTES', 'CIERRE', 'C_CIERRE FECHA ONSULTA EL CIERRE DIARIO DE UN DIA ESPECIFICO', 'TRUE', 'DATOS DE CIERRE DEL DIA : @F_CIERRE_C@ CON UN MONTO ACUMULADO DE  @MONTO_TOTAL_C@', 'CIERRE_DIARIO       ', 'ERROR COMANDO SOLO PARA GERENTES', 'FALSE          ', 'AA');
INSERT INTO comandos_sms (id_com, id_franq, tipo_com, nombre_com, descrip_com, status_com, sms_resp, tipo_variable, sms_error, status_error, resp_correo) VALUES ('COM00007', '1    ', 'PARA GERENTES', 'C_REP_G', 'CONSULTA REPORTE DE GERENCIA DADA UNA FECHA', 'TRUE', NULL, 'CIERRE_DIARIO       ', NULL, 'FALSE          ', NULL);
INSERT INTO comandos_sms (id_com, id_franq, tipo_com, nombre_com, descrip_com, status_com, sms_resp, tipo_variable, sms_error, status_error, resp_correo) VALUES ('COM00001', '1    ', 'PARA CLIENTES', 'DEUDA', 'PARA RETORNAR LA DEUDA DEL CLIENTE', 'TRUE', 'SALUDOS SR(A)@NOMBRECLI@  @APELLIDOCLI@ , SU DEUDA ES: @TOTAL_DEUDA@ CORRESPONDIENTE A: @D_DEUDA@', 'CONTRATO            ', 'ERROR DEBE ENVIAR LA PALABRA DEUDA DESDE SU NUMERO REGISTRADO, ACTUALIZA TUS DATOS A TRAVES DE ESTE NUMERO 0212-3416094 / 3811460 / 3619766', 'FALSE          ', '<B></B><BR><FONT SIZE="3"><I><B></B></I></FONT>');
INSERT INTO comandos_sms (id_com, id_franq, tipo_com, nombre_com, descrip_com, status_com, sms_resp, tipo_variable, sms_error, status_error, resp_correo) VALUES ('COM00002', '1    ', 'PARA CLIENTES', 'FALLA', 'PARA REPORTAR FALLA A LA DFSDSF', 'TRUE', 'SALUDOS SR(A) @APELLIDOCLI@ @NOMBRECLI@. HEMOS RECIBIDO SU REQUERIMIENTO. PRONTO SERA ATENDIDO.', 'CONTRATO            ', 'DEBE ENVIAR LA PALABRA FALLA ESPACIO EXPLICACION DE LA FALLA DESDE SU NUMERO DE TELEFONO REGISTRADO  ACTUALICE SUS DATOS 0212-3416094/3811460/3619766', 'FALSE          ', 'SALUDOS <SPAN STYLE="FONT-WEIGHT: BOLD; COLOR: #CC6600;">@APELLIDOCLI@ @NOMBRECLI@.</SPAN> HEMOS RECIBIDO SU REQUERIMIENTO. PRONTO SERA ATENDIDO.SDFDS');
INSERT INTO comandos_sms (id_com, id_franq, tipo_com, nombre_com, descrip_com, status_com, sms_resp, tipo_variable, sms_error, status_error, resp_correo) VALUES ('COM00003', '1    ', 'PARA CLIENTES', 'DENUNCIA', 'PARA DENUNCIAR EL ROBO DE CABLE EN SU LOCALIDAD', 'FALSE', 'SALUDOS @APELLIDOCLI@ @NOMBRECLI@. SU REQUERIMIENTO HA SIDO RECIBIDO Y ES TOTALMENTE CONFIDENCIAL', 'CONTRATO            ', 'SS', 'FALSE          ', 'ASFD');
INSERT INTO comandos_sms (id_com, id_franq, tipo_com, nombre_com, descrip_com, status_com, sms_resp, tipo_variable, sms_error, status_error, resp_correo) VALUES ('COM00004', '1    ', 'PARA CLIENTES', 'RECLAMO', 'PARA HACER UN RECLAMO CONTRA LOS TECNICOS DE LA EMPRESA', 'FALSE', 'SALUDOS @APELLIDOCLI@ @NOMBRECLI@. SU REQUERIMIENTO HA SIDO RECIBIDO Y ES CONFIDENCIAL', 'CONTRATO            ', 'ASDF', 'FALSE          ', 'SALUDOS @APELLIDOCLI@ @NOMBRECLI@. SU REQUERIMIENTO HA SIDO RECIBIDO Y ES TOTALMENTE CONFIDENCIAL');


--
-- TOC entry 2737 (class 0 OID 1991212)
-- Dependencies: 214
-- Data for Name: envio_aut; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00030', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE CORTE DE SERVICIO', 'FALSE', 'FALSE', 'LATIN (L.A.C.) LE INFORMA QUE HEMOS REALIZADO LA SUSPENCION DEL SERVICIO DEL CONT.NRO.@NRO_CONTRATO@, POR PRESENTAR UNA DEUDA DE BSF.@TOTAL_DEUDA@, SI DESEA LA REACTIVACIÃƒâ€œN DEL SERVICIO COMUNIQUESE AL 0212-8151624', 'DEO00010  ', 'ORDEN               ', 'LATIN (L.A.C.) LE INFORMA QUE HEMOS REALIZADO LA SUSPENCION DEL SERVICIO DEL CONT.NRO.@NRO_CONTRATO@, POR PRESENTAR UNA DEUDA DE BSF.@TOTAL_DEUDA@, SI DESEA LA REACTIVACIÃƒâ€œN DEL SERVICIO COMUNIQUESE AL 0212-8151624');
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00029', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE CORTE DE SERVICIO', 'TRUE', 'FALSE', 'PLATINIUM SYSTEM CABLE LE INFORMA QUE SE HA EMITIDO UNA ORDEN DE CORTE DEBIDO A LA FALTA DE CANCELACION,  SU DEUDA ES: @TOTAL_DEUDA@', 'DEO00010  ', 'ORDEN               ', 'DFG');
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00028', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE ILEGALES EN SU TAP', 'FALSE', 'FALSE', NULL, 'DEO00013  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00027', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE ILEGALES EN SU TAP', 'FALSE', 'FALSE', NULL, 'DEO00013  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00026', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE CABLE QUEMADO', 'FALSE', 'FALSE', NULL, 'DEO00012  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00025', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE CABLE QUEMADO', 'FALSE', 'FALSE', NULL, 'DEO00012  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00024', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE COLOCAR PRESINTO', 'FALSE', 'FALSE', NULL, 'DEO00015  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00023', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE COLOCAR PRESINTO', 'FALSE', 'FALSE', NULL, 'DEO00015  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00022', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE ILEGALES EN LA CALLE O VERE', 'FALSE', 'FALSE', NULL, 'DEO00014  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00021', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE ILEGALES EN LA CALLE O VEREDA', 'FALSE', 'FALSE', NULL, 'DEO00014  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00020', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE REPROGRAMACION', 'FALSE', 'FALSE', NULL, 'DEO00007  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00019', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE REPROGRAMACION', 'FALSE', 'FALSE', NULL, 'DEO00007  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00018', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE CABLE CAIDO', 'FALSE', 'FALSE', NULL, 'DEO00006  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00017', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE CABLE CAIDO', 'FALSE', 'FALSE', NULL, 'DEO00006  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00016', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE PROB ECUALIZACION REDES', 'FALSE', 'FALSE', NULL, 'DEO00005  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00015', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE PROB ECUALIZACION REDES', 'FALSE', 'FALSE', NULL, 'DEO00005  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00014', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE COLOCAR PRESINTO', 'FALSE', 'FALSE', NULL, 'DEO00016  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00013', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE COLOCAR PRESINTO', 'FALSE', 'FALSE', NULL, 'DEO00016  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00012', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE SIN SEÃƒÆ’Ã‚Â±AL', 'FALSE', 'FALSE', 'ASDÃƒÆ’Ã‚Â±ALLDS', 'DEO00009  ', 'ORDEN               ', 'SDFSEÃƒÆ’Ã‚Â±AL');
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00010', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE MALA SEÃƒÆ’Ã‚Â±AL', 'FALSE', 'FALSE', NULL, 'DEO00008  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00009', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE MALA SEÃƒÆ’Ã‚Â±AL', 'FALSE', 'FALSE', 'DETALLE <%NRO_CONTRATO%> DE DEUDA: 
<%D_DEUDA%> ', 'DEO00008  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00008', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE TRANSLADO', 'FALSE', 'FALSE', NULL, 'DEO00004  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00007', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE TRANSLADO', 'FALSE', 'FALSE', NULL, 'DEO00004  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00006', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE RECONEXION', 'TRUE', 'FALSE', NULL, 'DEO00003  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00005', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE RECONEXION', 'FALSE', 'FALSE', 'CABLE BRASIL, SE HA REALIZADO UNA ORDEN DE RECONEXION EN SU CUENTA NRO <%NRO_CONTRATO%>', 'DEO00003  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00004', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE PUNTO ADICIONAL', 'FALSE', 'FALSE', NULL, 'DEO00002  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00003', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE PUNTO ADICIONAL', 'FALSE', 'FALSE', NULL, 'DEO00002  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00002', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE INSTALACION NUEVA', 'FALSE', 'FALSE', NULL, 'DEO00001  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00001', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE INSTALACION NUEVA', 'FALSE', 'FALSE', 'SE LE INFORMA QUE SE HA GENERADO UNA ORDEN DE <%NOMBRE_DET_ORDEN%> CON EL NRO DE ORDEN: <%ID_ORDEN%> ', 'DEO00001  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00034', '1    ', 'PARA GERENTES', 'REPORTE DE CAJA AL REALIZAR CIERRE DE CAJA', 'FALSE', 'FALSE', 'SE HA REALIZADO EL CIERRE DE LA: @NOMBRE_CAJA@ ABIERTA A LAS @HORA_APERTURA_C@ POR @NOMBRECOB@  @APELLIDOCOB@ TOTAL ACUMULADO: @MONTO_ACUM_C@', NULL, 'CIERRE_CAJA         ', '<B><FONT COLOR="#3300FF"><FONT COLOR="#CC3300">SE HA REALIZADO EL CIERRE DE LA:</FONT></FONT></B><FONT COLOR="#3300FF"><FONT COLOR="#CC3300"> @NOMBRE_CAJA@ ABIERTA A LAS @HORA_APERTURA_C@ POR @NOMBRECOB@&NBSP; @APELLIDOCOB@ TOTAL ACUM</FONT></FONT><B><FONT COLOR="#3300FF"><FONT COLOR="#CC3300">ULADO: @MONTO_ACUM_C@</FONT></FONT></B><FONT COLOR="#CC3300"><SPAN STYLE="BACKGROUND-COLOR: #663399;"></SPAN></FONT>');
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00035', '1    ', 'PARA GERENTES', 'REPORTE DE GERENCIA AL REALIZAR CIERRE DIARIO', 'TRUE', 'TRUE', 'CIERRE DIARIO @FRANQUICIA@ DEL DIA @F_CIERRE_C@ TOTAL  @MONTO_TOTAL_C@ RESUMEN: @D_F_PAGO@', NULL, 'CIERRE_DIARIO       ', '<SPAN STYLE="COLOR: #CC9933;"><FONT COLOR="#000000"><SPAN STYLE="BACKGROUND-COLOR: #FFFFFF;"><B>SE HA REALIZADO EL CIERRE DIARIO D</B><I><U>EL DIA : @F_CIERRE_C@ CON UN MONTO ACUMULADO DE&AMP;NBSP; @MONTO_TOTAL_C@ @D_SERV@&AMP;NBSP;&AMP;NBSP; @D_F_</U></I><B>PAGO@</B></SPAN></FONT><B><FONT COLOR="#000000"><SPAN STYLE="BACKGROUND-COLOR: #FFFFFF;">TO ACUMULADO DE @MONTO_TOTAL_C@</SPAN></FONT><BR></B></SPAN>');
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00032', '1    ', 'PARA CLIENTES', 'AL FINALIZAR ORDEN DE SUSPENSION DE  SERVICIO', 'FALSE', 'FALSE', 'SCZDFADSFASDF', 'DEO00011  ', 'ORDEN               ', 'DASDASASADSFASDFADSF');
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00031', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE SUSPENSION DE  SERVICIO', 'FALSE', 'FALSE', NULL, 'DEO00011  ', 'ORDEN               ', NULL);
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00033', '1    ', 'PARA CLIENTES', 'AL REALIZAR PAGOS', 'TRUE', 'FALSE', 'PLATINIUM INFORMA QUE SE HA REALIZADO UN PAGO EN SU CUENTA @NRO_CONTRATO@ POR UN MONTO DE @MONTO_PAGO@, CON NUMERO DE FACTURA @NRO_FACTURA@', NULL, 'PAGO                ', '<U><I><B>INFORMA QUE SE HA REALIZADO UN PAGO E<FONT COLOR="#000033">ND SU CUENTA @NRO_CONTRATO@ POR UN SDFMONTO DE @MONTO_PAGO@, CON NUMERO DE FA</FONT>CTURA @NRO_FACTURA@</B></I></U>');
INSERT INTO envio_aut (id_envio, id_franq, tipo_envio, nombre_envio, envio_sms, envio_email, descripcion_envio, ref_envio, tipo_variable, resp_correo) VALUES ('ENV00011', '1    ', 'PARA CLIENTES', 'AL GENERAR ORDEN DE SIN SEÃƒÆ’Ã‚Â±AL', 'FALSE', 'FALSE', 'CUATV, LE INFORMA QUE SE HA GENERADO UNA ORDEN DE @NOMBRE_DET_ORDEN@ EN SU CUENTA: @NRO_CONTRATO@, CALLE @NOMBRE_CALLE@', 'DEO00009  ', 'ORDEN               ', 'CUAT<SPAN STYLE="FONT-FAMILY: SANS SERIF;">V, LE INFO</SPAN>RMA Q<SPAN STYLE="COLOR: #996633;">UE</SPAN><FONT STYLE="COLOR: #996633;" SIZE="5"> SE HA GENERADO </FONT><SPAN STYLE="COLOR: #996633;">UNA ORDEN DE @NOMBRE_DET_ORDEN@ EN SU</SPAN> CUENTA: @NRO_CONTRATO@, CALLE @NOMBRE_CALLE@');


--
-- TOC entry 2738 (class 0 OID 1991250)
-- Dependencies: 227
-- Data for Name: formato_sms; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO formato_sms (id_form, id_franq, nombre_form, formato, status) VALUES ('AO00002 ', '1    ', 'INFORMACION                                       ', 'PLATINIUM SYSTEM LE INFORMA A NUESTROS CLIENTES QUE PODRA DISFRUTAR EN EL CANAL 79 EL CANAL DE LAS ESTRELLAS', 'INACTIVO       ');
INSERT INTO formato_sms (id_form, id_franq, nombre_form, formato, status) VALUES ('DA00001 ', '1    ', 'CLIENTES MOROSOS                                  ', 'PLATINIUM SYSTEM CABLE LE INFORMA QUE USTED PRESENTA UNA DEUDA DE  @TOTAL_DEUDA@ CANCELE Y EVITE EL CORTE Y GASTOS POR RECONEXION', 'INACTIVO       ');
INSERT INTO formato_sms (id_form, id_franq, nombre_form, formato, status) VALUES ('FOR00003', '1    ', 'AVISO DE CORTE                                    ', 'PLATINIUM SYSTEM CABLE  INFORMA QUE TIENE UNA DEUDA DE: @TOTAL_DEUDA@; CORRESPONDIENTE A: @D_DEUDA@  EVITE EL CORTE Y CARGO DE RECONEXION', 'INACTIVO       ');
INSERT INTO formato_sms (id_form, id_franq, nombre_form, formato, status) VALUES ('BD00001 ', '1    ', 'CONSULTA DE SALDO                                 ', 'PLATINIUM SYSTEM CABLE LE INFORMA QUE PARA CONSULTAR SU SALDO DEBE ENVIAR UN SMS CON LA PALABRA DEUDA A ESTE NUMERO, DESDE SU NUMERO DE TELEFONO REGISTRADO', 'INACTIVO       ');
INSERT INTO formato_sms (id_form, id_franq, nombre_form, formato, status) VALUES ('EA00001 ', '1    ', 'INFO                                              ', 'PLATINIUM SYSTEM CABLE C.A. LE INFORMA A TODOS SUS SUSCRIPTORES QUE PUEDEN CANCELAR LA MENSUALIDAD POR LA OFICINA UBICADA EN EL C.C. OASIS CENTER EN EL PISO 2', 'INACTIVO       ');
INSERT INTO formato_sms (id_form, id_franq, nombre_form, formato, status) VALUES ('EA00002 ', '1    ', 'MENSAJE DE NO HAY SEÑAL                           ', 'PLATINIUM SYSTEM CABLE, LE INFORMA A NUESTROS CLIENTES QUE POR MEJORAS DEL SERVICIOS SE ESTA HACIENDO MANTENIMIENTO EN EL MARQUEZ, POR LO CUAL NO HAY SEÑAL', 'INACTIVO       ');
INSERT INTO formato_sms (id_form, id_franq, nombre_form, formato, status) VALUES ('AX00001 ', '1    ', 'JORNADA DE INSTALACION                            ', 'PLATINIUM SYSTEM CABLE INFORMA QUE EL DIA 04-01-14 HABRA JORNADA DE INSTALACION, POR FAVOR ESTAR ATENTO', 'ACTIVO         ');


--
-- TOC entry 2739 (class 0 OID 1991556)
-- Dependencies: 314
-- Data for Name: variables_sms; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (21, '@TELF_ADIC@         ', 'CONTRATO;ORDEN;PAGO;                              ', 'EL TELEFONO ADICIONAL                                                                                                                                                                                   ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (22, '@EMAIL@             ', 'CONTRATO;ORDEN;PAGO;                              ', 'EL CORREO ELECTRONICO                                                                                                                                                                                   ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (14, '@ETIQUETA@          ', 'CONTRATO;ORDEN;PAGO;                              ', 'ETIQUETA O PRESINTO DE CONTRATO                                                                                                                                                                         ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (38, '@F_CAJA@            ', 'CIERRE_CAJA;                                      ', 'FECHA DE CAJA                                                                                                                                                                                           ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (34, '@NOMBRECOB@         ', 'CIERRE_CAJA;                                      ', 'NOMBRE DEL COBRADOR                                                                                                                                                                                     ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (30, '@ID_CAJA_COB@       ', 'CIERRE_CAJA;                                      ', 'IDENTIFADOR DE CIERRE DE CAJA                                                                                                                                                                           ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (8, '@ID_ORDEN@          ', 'ORDEN;                                            ', 'NRO DE ORDEN DE SERVICIO                                                                                                                                                                                ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (39, '@CEDULACOB@         ', 'CIERRE_CAJA;                                      ', 'CEDULA DEL COBRADOR                                                                                                                                                                                     ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (35, '@APELLIDOCOB@       ', 'CIERRE_CAJA;                                      ', 'APELLIDO DEL COBRADOR                                                                                                                                                                                   ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (31, '@HORA_APERTURA_C@   ', 'CIERRE_CAJA;                                      ', 'HORA EN QUE SE APERTURO LA CAJA                                                                                                                                                                         ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (15, '@STATUS_CONTRATO@   ', 'CONTRATO;ORDEN;PAGO;                              ', 'EL STATUS DEL CLIENTE                                                                                                                                                                                   ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (16, '@DIREC_ADICIONAL@   ', 'CONTRATO;ORDEN;PAGO;                              ', 'LA REFERENCIA DEL CLIENTE                                                                                                                                                                               ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (17, '@NUMERO_CASA@       ', 'CONTRATO;ORDEN;PAGO;                              ', 'EL NUMERO DE CASA O APARTAMENTO                                                                                                                                                                         ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (18, '@EDIFICIO@          ', 'CONTRATO;ORDEN;PAGO;                              ', 'EL NOMBRE DEL EDIFICIO                                                                                                                                                                                  ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (19, '@NUMERO_PISO@       ', 'CONTRATO;ORDEN;PAGO;                              ', 'EL NUMERO DE PISO DEL EDIFICIO                                                                                                                                                                          ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (7, '@NOMBRE_ZONA@       ', 'CONTRATO;ORDEN;PAGO;                              ', 'NOMBRE DE LA ZONA                                                                                                                                                                                       ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (6, '@NOMBRE_SECTOR@     ', 'CONTRATO;ORDEN;PAGO;                              ', 'NOMBRE DEL SECTOR                                                                                                                                                                                       ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (11, '@NOMBRE_DET_ORDEN@  ', 'ORDEN;                                            ', 'NOMBRE DE LA ORDEN                                                                                                                                                                                      ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (36, '@NRO_COBRADOR@      ', 'CIERRE_CAJA;                                      ', 'NUMERO DEL COBRADOR                                                                                                                                                                                     ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (44, '@MONTO_ACUM_P@      ', 'INGRESO_ACTUAL;                                   ', 'MONTO FACTURADO DURANTE EL DIA                                                                                                                                                                          ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (42, '@HORA_CIERRE_C@     ', 'CIERRE_DIARIO;                                    ', 'HORA EN QUE SE REALIZA EL CIERRE DIARIO                                                                                                                                                                 ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (32, '@HORA_CIERRE_C@     ', 'CIERRE_CAJA;                                      ', 'HORA CIERRE DE CAJA                                                                                                                                                                                     ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (29, '@NRO_FACTURA@       ', 'PAGO;                                             ', 'EL NUMERO DE FACTURA DEL PAGO                                                                                                                                                                           ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (28, '@STATUS_PAGO@       ', 'PAGO;                                             ', 'EL STATUS DE UN PAGO ESPECIFICO                                                                                                                                                                         ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (9, '@F_ORDEN@           ', 'ORDEN;                                            ', 'FECHA EN QUE SE GENERO LA ORDEN                                                                                                                                                                         ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (40, '@F_CIERRE_C@        ', 'CIERRE_DIARIO;                                    ', 'FECHA EN QUE SE REALIZO EL CIERRE DIARIO                                                                                                                                                                ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (27, '@MONTO_PAGO@        ', 'PAGO;                                             ', 'EL MONTO TOTAL PAGADO                                                                                                                                                                                   ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (25, '@F_PAGO@            ', 'PAGO;                                             ', 'LA FECHA DE PAGO                                                                                                                                                                                        ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (2, '@CEDULACLI@         ', 'CONTRATO;ORDEN;PAGO;                              ', 'CEDULA DEL CLIENTE                                                                                                                                                                                      ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (5, '@NOMBRE_CALLE@      ', 'CONTRATO;ORDEN;PAGO;                              ', 'NOMBRE DE LA CALLE                                                                                                                                                                                      ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (10, '@F_FINAL@           ', 'ORDEN;                                            ', 'FECHA EN QUE SE FINALIZO LA ORDEN                                                                                                                                                                       ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (37, '@NOMBRE_CAJA@       ', 'CIERRE_CAJA;                                      ', 'NOMBRE DE LA CAJA                                                                                                                                                                                       ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (33, '@MONTO_ACUM_C@      ', 'CIERRE_CAJA;                                      ', 'MONTO ACUMULADO AL CERRAR LA CAJA                                                                                                                                                                       ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (41, '@ID_CIERRE@         ', 'CIERRE_DIARIO;                                    ', 'IDENTIFICADOR DEL CIERRE DIARIO                                                                                                                                                                         ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (26, '@HORA_PAGO@         ', 'PAGO;                                             ', 'LA HORA DE PAGO                                                                                                                                                                                         ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (12, '@STATUS_ORDEN@      ', 'ORDEN;                                            ', 'STATUS DE LA ORDEN                                                                                                                                                                                      ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (1, '@NRO_CONTRATO@      ', 'CONTRATO;ORDEN;PAGO;                              ', 'NRO DE CONTRATO
                                                                                                                                                                                        ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (3, '@NOMBRECLI@         ', 'CONTRATO;ORDEN;PAGO;                              ', 'NOMBRE DEL CLIENTE                                                                                                                                                                                      ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (4, '@APELLIDOCLI@       ', 'CONTRATO;ORDEN;PAGO;                              ', 'APELLIDO DEL CLIENTE                                                                                                                                                                                    ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (50, '@R_F_PAGO_C@        ', 'CIERRE_CAJA;                                      ', 'RESUMEN POR FORMA DE PAGO DE CIERRE DE CAJA                                                                                                                                                             ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (46, '@D_DEUDA@           ', 'CONTRATO;                                         ', 'DETALLE DE DEUDA                                                                                                                                                                                        ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (45, '@C_FACT_P@          ', 'INGRESO_ACTUAL;                                   ', 'CANTIDAD DE FACTURAS AL DIA                                                                                                                                                                             ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (43, '@MONTO_TOTAL_C@     ', 'CIERRE_DIARIO;                                    ', 'MONTO TOTAL DEL CIERRE DIARIO                                                                                                                                                                           ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (24, '@NOM_TIPO_ORDEN@    ', 'ORDEN;                                            ', 'EL NOMBRE DE LA ORDEN DE SERVICIO                                                                                                                                                                       ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (49, '@R_SERV_C@          ', 'CIERRE_CAJA;                                      ', 'RESUMEN POR SERVICIO DE CIERRE DE CAJA                                                                                                                                                                  ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (13, '@TOTAL_DEUDA@       ', 'CONTRATO;ORDEN;PAGO;                              ', 'LA DEUDA  TOTAL ACUMULADA                                                                                                                                                                               ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (20, '@TELF_CASA@         ', 'CONTRATO;ORDEN;PAGO;                              ', 'EL TELEFONO DE CASASDSD                                                                                                                                                                                 ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (47, '@D_F_PAGO@          ', 'CIERRE_CAJA;CIERRE_DIARIO;INGRESO_ACTUAL;         ', 'RESUMEN POR FORMA DE PAGO                                                                                                                                                                               ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (48, '@D_SERV@            ', 'CIERRE_CAJA;CIERRE_DIARIO;INGRESO_ACTUAL;         ', 'RESUMEN POR SERVICIOS                                                                                                                                                                                   ', 'ACTIVO         ', '1    ');
INSERT INTO variables_sms (id_var, variable, tipo_var, descrip_var, status_var, id_franq) VALUES (51, '@FRANQUICIA@        ', 'CIERRE_CAJA;CIERRE_DIARIO;INFORME_TECNICO;        ', 'PARA TRAER LA FRANQUIA A LA CUAL CORRESPONDE                                                                                                                                                            ', 'ACTIVO         ', '1    ');













----------------------------------------------------14/08/2014--------------------------------------------------------









INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (43, '1    ', '2013-04-14', 'DIGITOS NRO CONTRATO                              ', '8                                                           ', 'cantidad de digitos que va a tener el numero de contrato                                                                                                                                                ');
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (42, '1    ', '2013-04-14', 'TIPO FACTURACION                                  ', 'EPSON                                                       ', 'EPSON; BIXOLON;FORMA_CONTINUA_MEDIA_CARTA_DOBLE_DERECHA;                                                                                                                                                ');
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (45, '1    ', '2013-04-14', 'CONSULTA NRO CONTRATO                             ', 'ESTACION                                                    ', 'ESTACION; FRANQUICIA;                                                                                                                                                                                   ');
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (44, '1    ', '2013-04-14', 'SERIE MAS CORRELATIVA CONTRATO                    ', '3                                                           ', 'CANTIDAD DE DIGITOS DE SERIE                                                                                                                                                                            ');





----------------------------------------------------14/08/2014    11:11  AM    --------------------------------------------------------






INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (46, '1    ', '2013-04-14', 'DIGITOS NRO FACTURA                               ', '10                                                          ', 'cantidad de digitos que va a tener el numero de FACTURA                                                                                                                                                 ');



----------------------------------------------------14/08/2014    17:11  AM    --------------------------------------------------------





CREATE UNIQUE INDEX llamadasssd
  ON llamadas
  USING btree
  (id_lla);

CREATE  INDEX llamadasfssd
  ON llamadas
  USING btree
  (id_drl);

CREATE  INDEX llamadfasfssd
  ON llamadas
  USING btree
  (id_tll);

CREATE  INDEX llamfdfadfasfssd
  ON llamadas
  USING btree
  (id_contrato);

  
  
CREATE UNIQUE INDEX llamdfadasssd
  ON detalle_resp
  USING btree
  (id_drl);

CREATE  INDEX llamaddfasfssd
  ON detalle_resp
  USING btree
  (id_trl);

  
  
CREATE UNIQUE INDEX llamdfadfasssd
  ON tipo_resp
  USING btree
  (id_trl);

  
  
CREATE UNIQUE INDEX lladfdfadfasssd
  ON tipo_llamada
  USING btree
  (id_tll);

  
CREATE UNIQUE INDEX sdsd
  ON asig_lla_cli
  USING btree
  (id_lc);

CREATE  INDEX dff
  ON asig_lla_cli
  USING btree
  (id_all);

CREATE  INDEX dfffg
  ON asig_lla_cli
  USING btree
  (id_contrato);

CREATE  INDEX dfffdfdfg
  ON asig_lla_cli
  USING btree
  (id_lla);

CREATE UNIQUE INDEX sdssdd
  ON asigna_llamada
  USING btree
  (id_all);


----------------------------------------------------21/08/2014 --------------------------------------------------------


INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (49, '1    ', '2013-04-14', 'HABILITAR APLET DE JAVA                           ', '1                                                           ', '1 HABILITADO 
0 DESABILITADO                                                                                                                                                                            ');
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (48, '1    ', '2013-04-14', 'HABILITAR MODULO DE CABLE MODEM                   ', '1                                                           ', '1 HABILITADO 
0 DESABILITADO                                                                                                                                                                            ');
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (50, '1    ', '2013-04-14', 'HABILITAR EFECTO CARGA INICIAL                    ', '1                                                           ', '1 HABILITADO 
0 DESABILITADO                                                                                                                                                                            ');
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (51, '1    ', '2013-04-14', 'HABILITAR EFECTO CARGA MODULO                     ', '1                                                           ', '1 HABILITADO 
0 DESABILITADO                                                                                                                                                                            ');
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (60, '1    ', '2013-04-14', 'PLANILLA ORDEN DE SERVICIO                        ', 'MDS                                                         ', 'MDS : MEDIA CARTA
CCS : CARTA COMPLETA SENCILLA
CCC : CARTA COMPLETA CON CABLE MODEM
CCD : CARTA COMPLETA CON DECODIFICADORES
CCCD :  CARTA COMPLETA CON CABLE MODEM Y DECODIFICADORES                  ');
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (47, '1    ', '2013-04-14', 'HABILITAR PAGO POR EFECTIVO                       ', 'DISABLED                                                    ', 'disabled    para desabilitar el BANCO Y NUMERO
EN BLANCO PARA DEJARLO HABILITADO                                                                                                                        ');



----------------------------------------------------26/08/2014 --------------------------------------------------------

UPDATE parametros SET parametro='CANTIDAD DIGITO CONTRATO FISICO' , valor_param='8' WHERE id_param='36';

INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (52, '1    ', '2013-04-14', 'DIGITOS NRO CONTROL de FACTURA                    ', '7                                                           ', 'cantidad de digitos que va a tener el numero de FACTURA                                                                                                                                                 ');
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (53, '1    ', '2013-04-14', 'CONTROL POR RECIBO                                ', '0                                                           ', '1 HABILITADO 
0 DESABILITADO                                                                                                                                                                           ');
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (54, '1    ', '2013-04-14', 'CANTIDAD DIGITO NRO RECIBO                        ', '6                                                           ', '1 HABILITADO 
0 DESABILITADO                                                                                                                                                                           ');



----------------------------------------------------27/08/2014 --------------------------------------------------------

INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (5, '1    ', '2011-09-30', 'EMPRESA                                           ', 'CORPORACION DIGICABLE C.A.', 'ENCABEZADO DE REPORTE                                                                                                                                                                                   ');
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (6, '1    ', '2011-09-30', 'RIF                                               ', 'J-00000000-0                                                ', 'RIF DE LA EMPRESA                                                                                                                                                                                       ');

ALTER TABLE pagos ADD impresion character(2);
update pagos set impresion='SI';


CREATE OR REPLACE VIEW vista_pago_cont AS 
 SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, 
    pagos.monto_pago, pagos.status_pago, pagos.nro_factura, pagos.id_contrato, 
    contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, 
    contrato.status_contrato, persona.cedula AS cedulacli, 
    persona.nombre AS nombrecli, persona.apellido AS apellidocli, 
    cliente.tipo_cliente, cliente.inicial_doc, caja.tipo_caja, 
    caja_cobrador.id_persona AS id_persona_cob, contrato.taps, pagos.cont, 
    caja.id_caja, caja.id_franq, pagos.nro_control, pagos.desc_pago, 
    pagos.base_imp, pagos.monto_iva, pagos.monto_reten, pagos.islr, 
    pagos.n_credito, pagos.fecha_factura, caja_cobrador.id_est,impresion
   FROM cliente, pagos, contrato, persona, caja_cobrador, caja
  WHERE persona.id_persona = cliente.id_persona AND cliente.id_persona = contrato.cli_id_persona AND contrato.id_contrato = pagos.id_contrato AND pagos.id_caja_cob = caja_cobrador.id_caja_cob AND caja_cobrador.id_caja = caja.id_caja
  ORDER BY pagos.id_pago;

  
  
  
  
  
----------------------------------------------------30/08/2014 --------------------------------------------------------

CREATE OR REPLACE VIEW vista_pago_cont AS 
 SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, 
    pagos.monto_pago, pagos.status_pago, pagos.nro_factura, pagos.id_contrato, 
    contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, 
    contrato.status_contrato, persona.cedula AS cedulacli, 
    persona.nombre AS nombrecli, persona.apellido AS apellidocli, 
    cliente.tipo_cliente, cliente.inicial_doc, caja.tipo_caja, 
    caja_cobrador.id_persona AS id_persona_cob, contrato.taps, pagos.cont, 
    caja.id_caja, caja.id_franq, pagos.nro_control, pagos.desc_pago, 
    pagos.base_imp, pagos.monto_iva, pagos.monto_reten, pagos.islr, 
    pagos.n_credito, pagos.fecha_factura, caja_cobrador.id_est, pagos.impresion,pagos.inc
   FROM cliente, pagos, contrato, persona, caja_cobrador, caja
  WHERE persona.id_persona = cliente.id_persona AND cliente.id_persona = contrato.cli_id_persona AND contrato.id_contrato = pagos.id_contrato AND pagos.id_caja_cob = caja_cobrador.id_caja_cob AND caja_cobrador.id_caja = caja.id_caja
  ORDER BY pagos.id_pago;

  
  
  
  
  
----------------------------------------------------03/08/2014 --------------------------------------------------------




CREATE TABLE camb_prop
(
  id_contrato character(10) NOT NULL,
  id_persona character(10) NOT NULL,
  login character(10),
  fecha date,
  CONSTRAINT pk_contdrdfato PRIMARY KEY (id_contrato,id_persona),
  CONSTRAINT fk_condftratodf_relations_vendedor FOREIGN KEY (id_persona)
      REFERENCES persona (id_persona) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
)
WITH (
  OIDS=FALSE
);



--propio de cosertel
/*
 update  parametros  set valor_param='' where id_param='47';
update contrato set nro_contrato='00100017330' where id_contrato='XC00017263';
update contrato set nro_contrato='00100017331' where id_contrato='AM00000016';
update contrato set nro_contrato='00100017333' where id_contrato='AL00000012';
update contrato set nro_contrato='00100017334' where id_contrato='AL00000013';

*/


  
  
  
----------------------------------------------------03/08/2014:  15:57  --------------------------------------------------------



INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (55, '1    ', '2013-04-14', 'ORDEN NRO FACTURA', 'UNICO', 'UNICO 
POR ESTACION
POR CAJA');
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (56, '1    ', '2013-04-14', 'ORDEN NRO CONTROL', 'UNICO', 'UNICO 
POR ESTACION
POR CAJA');







  
  
  
----------------------------------------------------03/08/2014: DIGICABLE  --------------------------------------------------------


ALTER TABLE asig_lla_cli ADD deuda numeric(10,2);







  
----------------------------------------------------03/08/2014: DIGICABLE  --------------------------------------------------------


CREATE OR REPLACE VIEW vista_pago_cont AS 
 SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, 
    pagos.monto_pago, pagos.status_pago, pagos.nro_factura, pagos.id_contrato, 
    contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, 
    contrato.status_contrato, persona.cedula AS cedulacli, 
    persona.nombre AS nombrecli, persona.apellido AS apellidocli, 
    cliente.tipo_cliente, cliente.inicial_doc, caja.tipo_caja, 
    caja_cobrador.id_persona AS id_persona_cob, contrato.taps, pagos.cont, 
    caja.id_caja, caja.id_franq, pagos.nro_control, pagos.desc_pago, 
    pagos.base_imp, pagos.monto_iva, pagos.monto_reten, pagos.islr, 
    pagos.n_credito, pagos.fecha_factura, caja_cobrador.id_est, pagos.impresion, 
    pagos.inc,nombre_zona
   FROM cliente, pagos, contrato, persona, caja_cobrador, caja,vista_ubica
  WHERE vista_ubica.id_calle=contrato.id_calle and persona.id_persona = cliente.id_persona AND cliente.id_persona = contrato.cli_id_persona AND contrato.id_contrato = pagos.id_contrato AND pagos.id_caja_cob = caja_cobrador.id_caja_cob AND caja_cobrador.id_caja = caja.id_caja
  ORDER BY pagos.id_pago;


----------------------------------------------------05/09/2014--------------------------------------------------------
ALTER TABLE ONLY public.detalle_tipopago DROP CONSTRAINT detalle_tipopago_pkey;

ALTER TABLE ONLY detalle_tipopago
    ADD CONSTRAINT detalle_tipopago_pkey PRIMARY KEY (id_tipo_pago,id_pago,banco,numero);
	
	
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('CODU001 ', 'MODIFICAR CEDULA', 'MODIFICAR_CEDULA', 'MODIFICAR LA CEDULA DEL CLIENTE', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('CODU002 ', 'MODIFICAR PRECINTO', 'MODIFICAR_PRECINTO', 'MODIFICAR LA PRECINTO DEL CLIENTE', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('CODU003 ', 'MODIFICAR POSTE', 'MODIFICAR_POSTE', 'MODIFICAR LA POSTE DEL CLIENTE', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('CODU004 ', 'MODIFICAR PUNTO ADICIONAL', 'MODIFICAR_PUNTOADI', 'MODIFICAR EL PUNTO ADICIONAL DEL CLIENTE', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('CODU005 ', 'MODIFICAR NRO ABONADO', 'MODIFICAR_NRO_ABONADO', 'MODIFICAR EL NRO_ABONADO DEL CLIENTE', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('CODU006 ', 'MODIFICAR CONTRATO FISICO', 'MODIFICAR_CONTRATO_FISICO', 'MODIFICAR EL CONTRATO FISICO DEL CLIENTE', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('CODU007 ', 'AGREGAR SUSCRIPCION', 'AGREGAR_SUSCRIPCION', 'AGREGAR SUSCRIPCION DEL CLIENTE', 'ACTIVO');


CREATE OR REPLACE VIEW vista_orden AS 
 SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, contrato.status_contrato, ( SELECT count(*) AS num_vis
           FROM visitas
          WHERE ordenes_tecnicos.id_orden = visitas.id_orden) AS num_visitas, ( SELECT orden_grupo.id_gt
           FROM orden_grupo
          WHERE ordenes_tecnicos.id_orden = orden_grupo.id_orden
         LIMIT 1) AS id_gt, ( SELECT grupo_trabajo.nombre_grupo
           FROM orden_grupo, grupo_trabajo
          WHERE orden_grupo.id_gt = grupo_trabajo.id_gt AND ordenes_tecnicos.id_orden = orden_grupo.id_orden
         LIMIT 1) AS nombre_grupo, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, ordenes_tecnicos.login AS login_emi, ordenes_tecnicos.hora AS hora_emi, ordenes_tecnicos.login_imp, ordenes_tecnicos.hora_imp, ordenes_tecnicos.login_fin, ordenes_tecnicos.hora_fin, contrato.id_calle, vista_ubica.id_sector, vista_ubica.nombre_calle, vista_ubica.id_zona, vista_ubica.nombre_sector, vista_ubica.id_ciudad, vista_ubica.id_mun, vista_ubica.nombre_ciudad, vista_ubica.id_esta, vista_ubica.nombre_mun, vista_ubica.id_franq, vista_ubica.nombre_zona, vista_ubica.nombre_franq, vista_ubica.nombre_esta, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, contrato.contrato_fisico, contrato.postel
   FROM detalle_orden, contrato, ordenes_tecnicos, tipo_orden, persona, cliente, vista_ubica, grupo_afinidad
  WHERE tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden AND detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden AND ordenes_tecnicos.id_contrato = contrato.id_contrato AND contrato.cli_id_persona = cliente.id_persona AND cliente.id_persona = persona.id_persona AND contrato.id_calle = vista_ubica.id_calle AND grupo_afinidad.id_g_a = contrato.id_g_a
  ORDER BY ordenes_tecnicos.id_orden;
  
  
  
CREATE OR REPLACE VIEW vista_pago_cont AS 
 SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, 
    pagos.monto_pago, pagos.status_pago, pagos.nro_factura, pagos.id_contrato, 
    contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, 
    contrato.status_contrato, persona.cedula AS cedulacli, 
    persona.nombre AS nombrecli, persona.apellido AS apellidocli, 
    cliente.tipo_cliente, cliente.inicial_doc, caja.tipo_caja, 
    caja_cobrador.id_persona AS id_persona_cob, contrato.taps, pagos.cont, 
    caja.id_caja, caja.id_franq, pagos.nro_control, pagos.desc_pago, 
    pagos.base_imp, pagos.monto_iva, pagos.monto_reten, pagos.islr, 
    pagos.n_credito, pagos.fecha_factura, caja_cobrador.id_est, pagos.impresion, 
    pagos.inc, vista_ubica.nombre_zona, nombre_sector,obser_pago
   FROM cliente, pagos, contrato, persona, caja_cobrador, caja, vista_ubica
  WHERE vista_ubica.id_calle = contrato.id_calle AND persona.id_persona = cliente.id_persona AND cliente.id_persona = contrato.cli_id_persona AND contrato.id_contrato = pagos.id_contrato AND pagos.id_caja_cob = caja_cobrador.id_caja_cob AND caja_cobrador.id_caja = caja.id_caja
  ORDER BY pagos.id_pago;



----------------------------------------------------07/09/2014--------------------------------------------------------




INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (57, '1    ', '2013-04-14', 'NOMBRE LOGO', 'cosertel.jpg', 'logo ubicado en la carpeta imagenes');

INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (58, '1    ', '2013-04-14', 'TAMAÑO LOGO', '30', 'ANCHO DE LA IMAGEN DEL LOGO');



CREATE TABLE marca
(
  dato character(10),
  id_marca character(8) NOT NULL,
  nombre_marca character(50),
  status_marca character(15),
  CONSTRAINT pk_marca PRIMARY KEY (id_marca)
)
WITH (
  OIDS=FALSE
);


CREATE TABLE modelo
(
  dato character(20),
  id_modelo character(8) NOT NULL,
  id_marca character(8),
  nombre_modelo character(50),
  tipo_modelo character(30),
  status_modelo character(15),
  CONSTRAINT pk_modelo PRIMARY KEY (id_modelo)
)
WITH (
  OIDS=FALSE
);


CREATE TABLE cablemodem_interfaz
(
  mac character varying(12) NOT NULL,
  contrato character varying(20),
  nodo character varying(6),
  plan character varying(40),
  estado character varying(4),
  dato_cliente character varying(100),
  server character varying(100),
  securelevel integer,
  CONSTRAINT cablemodem_interfaz_pkey PRIMARY KEY (mac)
)
WITH (
  OIDS=FALSE
);


CREATE OR REPLACE VIEW vista_modelo AS 
 SELECT marca.id_marca, marca.nombre_marca, marca.status_marca, 
    modelo.id_modelo, modelo.nombre_modelo, modelo.tipo_modelo, 
    modelo.status_modelo
   FROM marca, modelo
  WHERE marca.id_marca = modelo.id_marca;
  
  
  UPDATE  CABLEMODEM SET status_cm='I' WHERE status_cm='Activo';
UPDATE  CABLEMODEM SET status_cm='S' WHERE status_cm='Inactivo';
UPDATE  CABLEMODEM SET status_cm='I' WHERE status_cm='ACTIVO';
UPDATE  CABLEMODEM SET status_cm='S' WHERE status_cm='INACTIVO';
UPDATE  CABLEMODEM SET nota3=nota1 ;
UPDATE  CABLEMODEM SET nota1='CLIENTE';



UPDATE  CABLEMODEM SET nota2='BUENO';





---------------------------------------------------------------------------24/09/2014------------------------------------------------------------------------------




CREATE OR REPLACE VIEW vista_tipopago AS 
 SELECT detalle_tipopago.id_tipo_pago, detalle_tipopago.id_pago, 
    detalle_tipopago.banco, detalle_tipopago.numero, detalle_tipopago.monto_tp, 
    pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, pagos.monto_pago, 
    pagos.obser_pago, pagos.status_pago, pagos.nro_factura, tipo_pago.tipo_pago, 
    caja.tipo_caja, pagos.id_contrato, caja.id_franq, caja_cobrador.id_est, 
    pagos.monto_reten, pagos.islr, impresion
   FROM detalle_tipopago, pagos, tipo_pago, caja_cobrador, caja
  WHERE detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago AND detalle_tipopago.id_pago = pagos.id_pago AND pagos.id_caja_cob = caja_cobrador.id_caja_cob AND caja_cobrador.id_caja = caja.id_caja
  ORDER BY pagos.fecha_pago;





---------------------------------------------------------------------------01/10/2014------------------------------------------------------------------------------

INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU021  ', 'MODIFICAR_CEDULA', 'MODIFICAR_CEDULA', 'MODIFICAR_CEDULA', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU015  ', 'MODIFICAR_PRECINTO', 'MODIFICAR_PRECINTO', 'MODIFICAR_PRECINTO', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU016  ', 'MODIFICAR_POSTE', 'MODIFICAR_POSTE', 'MODIFICAR_POSTE', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU017  ', 'MODIFICAR_PUNTOADI', 'MODIFICAR_PUNTOADI', 'MODIFICAR_PUNTOADI', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU018  ', 'MODIFICAR_NRO_ABONADO', 'MODIFICAR_NRO_ABONADO', 'MODIFICAR_NRO_ABONADO', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU019  ', 'MODIFICAR_CONTRATO_FISICO', 'MODIFICAR_CONTRATO_FISICO', 'MODIFICAR_CONTRATO_FISICO', 'ACTIVO');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU020  ', 'AGREGAR_SUSCRIPCION', 'AGREGAR_SUSCRIPCION', 'AGREGAR_SUSCRIPCION', 'ACTIVO');

















---------------------------------------------------------------------------22/10/2014  digicable------------------------------------------------------------------------------














CREATE OR REPLACE VIEW vista_pago_ser AS 
 SELECT pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, 
    contrato_servicio_pagado.cant_serv, contrato_servicio_pagado.costo_cobro, 
    contrato_servicio_pagado.id_serv, pagos.status_pago, caja.tipo_caja, 
    pagos.id_pago, contrato_servicio_pagado.fecha_inst, 
    servicios.nombre_servicio, caja.id_franq, caja_cobrador.id_est, 
    contrato_servicio_pagado.descu, pagos.nro_factura, pagos.id_contrato, 
    caja_cobrador.id_persona, pagos.obser_pago, tipo_serv
   FROM pago_servicio, pagos, contrato_servicio_pagado, caja_cobrador, caja, 
    servicios
  WHERE pagos.id_pago = pago_servicio.id_pago AND pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv AND pagos.id_caja_cob = caja_cobrador.id_caja_cob AND caja_cobrador.id_caja = caja.id_caja AND contrato_servicio_pagado.id_serv = servicios.id_serv;

  
  
  
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (61, '1    ', '2014-10-22', 'MES A CARGAR', 'ANTERIOR', 'ANTERIOR
ACTUAL
POSTERIOR');

  
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (62, '1    ', '2014-10-22', 'VALIDAR IMPRIMIR PAGO', '0', '0 NO VALIDAR
1 VALIDAR');
-- NOTA  PARA CORPORACION DIGICABLE EN BARINAS PONER VALOR 1 OBLIGADO LAS DEMAS SE PUEDEN DEJAR EN 0 

--UPDATE pagos SET impresion='SI';  --MENOS PARA CORPORACION DIGICABLE EN BARINAS








---------------------------------------------------------------------------16/11/2014  digicable------------------------------------------------------------------------------




  
INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (63, '1    ', '2014-11-16', 'MONTO MINIMO DEUDA PARA RECONEXION', '0', 'MONTO MINIMO QUE DEBE QUEDAR DE DEUDA PARA PODER GENERAR LA ORDEN DE RECONEXION');



CREATE OR REPLACE VIEW vista_contratodeu AS 
 SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, 
    contrato_servicio_deuda.id_contrato, contrato_servicio_deuda.fecha_inst, 
    contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, 
    servicios.id_tipo_servicio, servicios.nombre_servicio, 
    servicios.status_serv, tipo_servicio.tipo_servicio, 
    tipo_servicio.status_servicio, tipo_servicio.id_franq, 
    contrato.costo_dif_men, contrato.nro_contrato, persona.cedula AS cedulacli, 
    persona.nombre AS nombrecli, persona.apellido AS apellidocli, 
    servicios.tipo_costo, contrato_servicio_deuda.costo_cobro, 
    contrato.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, 
    sector.nombre_sector, zona.nombre_zona, contrato.status_contrato, 
    contrato_servicio_deuda.descu, contrato_servicio_deuda.inc,tipo_serv
   FROM contrato_servicio_deuda, tipo_servicio, servicios, contrato, cliente, 
    persona, calle, sector, zona
  WHERE contrato_servicio_deuda.id_serv = servicios.id_serv AND servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio AND contrato_servicio_deuda.id_contrato = contrato.id_contrato AND persona.id_persona = cliente.id_persona AND contrato.cli_id_persona = cliente.id_persona AND contrato.id_calle = calle.id_calle AND calle.id_sector = sector.id_sector AND sector.id_zona = zona.id_zona
  ORDER BY contrato_servicio_deuda.id_cont_serv;

  /*
  A LA HORA DE SELECCIONAR LOS PAGOS AUTOMATICOS PARA PAGAR, SE ORDENA PRIMERO LA CLASIFICACION DEL SERVICIO  ES DECIR PRIMERO LAS
  INSTALACIONES
  LUEGO LOS MENSUNSUALIDADES
  LUEGO LOS OTROS 
  Y LUEGO LAS RECONEXIONES
  
  */

---------------------------------------------------------------------------18/11/2014  ricardo------------------------------------------------------------------------------




  
ALTER TABLE llamadas ADD num serial;




---------------------------------------------------------------------------23/11/2014------------------------------------------------------------------------------




INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (63, '1    ', '2014-11-23', 'TIPO FACTURA', '1', '0 FACURA=PAGO
1 FACTURA SOLO');



INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (64, '1    ', '2014-11-23', 'UNIFICAR FACTURACION', '1', '0 NO UNIFICAR
1 SEPARAR POR FRANQUICIA');


ALTER TABLE pagos ADD tipo_doc character(20);
update pagos set tipo_doc='';





---------------------------------------------------------------------------28/11/2014------------------------------------------------------------------------------



--PARA LA NUEVA ESTRUCTURA DE TRABAJO BASADO EN FACTURAS

INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (63, '1    ', '2014-11-23', 'TIPO FACTURA', '1', '0 FACURA=PAGO
1 FACTURA SOLO');



INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (64, '1    ', '2014-11-23', 'UNIFICAR FACTURACION', '1', '0 NO UNIFICAR
1 SEPARAR POR FRANQUICIA');


ALTER TABLE pagos ADD tipo_doc character(20);
update pagos set tipo_doc='';


ALTER TABLE contrato_servicio_deuda ADD id_pago character(12);


ALTER TABLE ONLY contrato_servicio_deuda
    ADD CONSTRAINT fk_contrato_relations_pago FOREIGN KEY (id_pago) REFERENCES pagos(id_pago) ON UPDATE RESTRICT ON DELETE RESTRICT;

	
	
CREATE INDEX relationship_deudfda_20_fk
  ON contrato_servicio_deuda
  USING btree
  (id_pago );

  
  
---------------------------------------------------------------------------28/11/2014------------------------------------------------------------------------------

  

CREATE OR REPLACE VIEW vista_contratodeu AS 
 SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, 
    contrato_servicio_deuda.id_contrato, contrato_servicio_deuda.fecha_inst, 
    contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, 
    servicios.id_tipo_servicio, servicios.nombre_servicio, 
    servicios.status_serv, tipo_servicio.tipo_servicio, 
    tipo_servicio.status_servicio, tipo_servicio.id_franq, 
    contrato.costo_dif_men, contrato.nro_contrato, persona.cedula AS cedulacli, 
    persona.nombre AS nombrecli, persona.apellido AS apellidocli, 
    servicios.tipo_costo, contrato_servicio_deuda.costo_cobro, 
    contrato.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, 
    sector.nombre_sector, zona.nombre_zona, contrato.status_contrato, 
    contrato_servicio_deuda.descu, contrato_servicio_deuda.inc,tipo_serv
   FROM contrato_servicio_deuda, tipo_servicio, servicios, contrato, cliente, 
    persona, calle, sector, zona
  WHERE contrato_servicio_deuda.id_serv = servicios.id_serv AND servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio AND contrato_servicio_deuda.id_contrato = contrato.id_contrato AND persona.id_persona = cliente.id_persona AND contrato.cli_id_persona = cliente.id_persona AND contrato.id_calle = calle.id_calle AND calle.id_sector = sector.id_sector AND sector.id_zona = zona.id_zona
  ORDER BY contrato_servicio_deuda.id_cont_serv;

  
  
  
ALTER TABLE contrato_servicio_deuda ADD apagar numeric(10,2) DEFAULT 0;
update contrato_servicio_deuda set apagar=0;

ALTER TABLE contrato_servicio_deuda ADD pagado numeric(10,2) DEFAULT 0;





CREATE TABLE pago_factura
(
  id_pago character(15) NOT NULL,
  id_cont_serv character(12) NOT NULL,
  costo_cobro_serv numeric(10,2),
  CONSTRAINT pk_pago_factura PRIMARY KEY (id_pago, id_cont_serv),
  CONSTRAINT pago_factura_id_cont_serv_fkey FOREIGN KEY (id_cont_serv)
      REFERENCES contrato_servicio_deuda (id_cont_serv) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT pago_factura_id_pago_fkey FOREIGN KEY (id_pago)
      REFERENCES pagos (id_pago) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE pago_factura
  OWNER TO postgres;

CREATE UNIQUE INDEX relatiofgnship_22_pk
  ON pago_factura
  USING btree
  (id_pago , id_cont_serv);



CREATE OR REPLACE VIEW vista_contratodeu_f AS 
 SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, 
    contrato_servicio_deuda.id_contrato, contrato_servicio_deuda.fecha_inst, 
    contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, 
    servicios.id_tipo_servicio, servicios.nombre_servicio, 
    tipo_servicio.tipo_servicio, servicios.tipo_costo, 
    contrato_servicio_deuda.costo_cobro, contrato_servicio_deuda.descu, 
    contrato_servicio_deuda.inc, contrato_servicio_deuda.apagar, pagos.id_pago, 
    pagos.nro_factura, servicios.tipo_serv , contrato_servicio_deuda.pagado
   FROM pagos, contrato_servicio_deuda, tipo_servicio, servicios
  WHERE contrato_servicio_deuda.id_serv = servicios.id_serv AND servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio AND contrato_servicio_deuda.id_pago = pagos.id_pago
  ORDER BY contrato_servicio_deuda.inc;

CREATE OR REPLACE VIEW vista_pago_ser AS 
 SELECT pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, 
    contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.pagado as costo_cobro, 
    contrato_servicio_deuda.id_serv, pagos.status_pago, caja.tipo_caja, 
    pagos.id_pago, contrato_servicio_deuda.fecha_inst, 
    servicios.nombre_servicio, caja.id_franq, caja_cobrador.id_est, 
    contrato_servicio_deuda.descu, pagos.nro_factura, pagos.id_contrato, 
    caja_cobrador.id_persona, pagos.obser_pago, servicios.tipo_serv
   FROM pago_factura, pagos, contrato_servicio_deuda, caja_cobrador, caja, 
    servicios
  WHERE pagos.id_pago = pago_factura.id_pago AND pago_factura.id_cont_serv = contrato_servicio_deuda.id_cont_serv AND pagos.id_caja_cob = caja_cobrador.id_caja_cob AND caja_cobrador.id_caja = caja.id_caja AND contrato_servicio_deuda.id_serv = servicios.id_serv;

  
  
CREATE OR REPLACE VIEW vista_pago_ser AS 
 SELECT pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, 
    contrato_servicio_deuda.cant_serv, 
    contrato_servicio_deuda.pagado AS costo_cobro, 
    contrato_servicio_deuda.id_serv, pagos.status_pago, caja.tipo_caja, 
    pagos.id_pago, contrato_servicio_deuda.fecha_inst, 
    servicios.nombre_servicio, caja.id_franq, caja_cobrador.id_est, 
    contrato_servicio_deuda.descu, pagos.nro_factura, pagos.id_contrato, 
    caja_cobrador.id_persona, pagos.obser_pago, servicios.tipo_serv,contrato_servicio_deuda.id_cont_serv
   FROM pago_factura, pagos, contrato_servicio_deuda, caja_cobrador, caja, 
    servicios
  WHERE pagos.id_pago = pago_factura.id_pago AND pago_factura.id_cont_serv = contrato_servicio_deuda.id_cont_serv AND pagos.id_caja_cob = caja_cobrador.id_caja_cob AND caja_cobrador.id_caja = caja.id_caja AND contrato_servicio_deuda.id_serv = servicios.id_serv;
  
  DROP VIEW vista_pago_ser;
CREATE OR REPLACE VIEW vista_pago_ser AS 
 SELECT pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, 
    contrato_servicio_deuda.cant_serv, 
    costo_cobro_serv AS costo_cobro, 
    contrato_servicio_deuda.id_serv, pagos.status_pago, caja.tipo_caja, 
    pagos.id_pago, contrato_servicio_deuda.fecha_inst, 
    servicios.nombre_servicio, caja.id_franq, caja_cobrador.id_est, 
    contrato_servicio_deuda.descu, pagos.nro_factura, pagos.id_contrato, 
    caja_cobrador.id_persona, pagos.obser_pago, servicios.tipo_serv,contrato_servicio_deuda.id_cont_serv
   FROM pago_factura, pagos, contrato_servicio_deuda, caja_cobrador, caja, 
    servicios
  WHERE pagos.id_pago = pago_factura.id_pago AND pago_factura.id_cont_serv = contrato_servicio_deuda.id_cont_serv AND pagos.id_caja_cob = caja_cobrador.id_caja_cob AND caja_cobrador.id_caja = caja.id_caja AND contrato_servicio_deuda.id_serv = servicios.id_serv;


  
  
CREATE OR REPLACE VIEW vista_pago_cont AS 
 SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, 
    pagos.monto_pago, pagos.status_pago, pagos.nro_factura, pagos.id_contrato, 
    contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, 
    contrato.status_contrato, persona.cedula AS cedulacli, 
    persona.nombre AS nombrecli, persona.apellido AS apellidocli, 
    cliente.tipo_cliente, cliente.inicial_doc, caja.tipo_caja, 
    caja_cobrador.id_persona AS id_persona_cob, contrato.taps, pagos.cont, 
    caja.id_caja, caja.id_franq, pagos.nro_control, pagos.desc_pago, 
    pagos.base_imp, pagos.monto_iva, pagos.monto_reten, pagos.islr, 
    pagos.n_credito, pagos.fecha_factura, caja_cobrador.id_est, pagos.impresion, 
    pagos.inc, vista_ubica.nombre_zona, vista_ubica.nombre_sector, 
    pagos.obser_pago, vista_ubica.id_sector, tipo_doc
   FROM cliente, pagos, contrato, persona, caja_cobrador, caja, vista_ubica
  WHERE vista_ubica.id_calle = contrato.id_calle AND persona.id_persona = cliente.id_persona AND cliente.id_persona = contrato.cli_id_persona AND contrato.id_contrato = pagos.id_contrato AND pagos.id_caja_cob = caja_cobrador.id_caja_cob AND caja_cobrador.id_caja = caja.id_caja
  ORDER BY pagos.id_pago;

  
  
  
  
CREATE OR REPLACE VIEW vista_pago_ser AS 
 SELECT pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, 
    contrato_servicio_deuda.cant_serv, 
    pago_factura.costo_cobro_serv AS costo_cobro, 
    contrato_servicio_deuda.id_serv, pagos.status_pago, caja.tipo_caja, 
    pagos.id_pago, contrato_servicio_deuda.fecha_inst, 
    servicios.nombre_servicio, caja.id_franq, caja_cobrador.id_est, 
    contrato_servicio_deuda.descu, pagos.nro_factura, pagos.id_contrato, 
    caja_cobrador.id_persona, pagos.obser_pago, servicios.tipo_serv, 
    contrato_servicio_deuda.id_cont_serv,contrato_servicio_deuda.costo_cobro as costo_cobro_fact
   FROM pago_factura, pagos, contrato_servicio_deuda, caja_cobrador, caja, 
    servicios
  WHERE pagos.id_pago = pago_factura.id_pago AND pago_factura.id_cont_serv = contrato_servicio_deuda.id_cont_serv AND pagos.id_caja_cob = caja_cobrador.id_caja_cob AND caja_cobrador.id_caja = caja.id_caja AND contrato_servicio_deuda.id_serv = servicios.id_serv;

  
  
  
  
  
---------------------------------------------------------------------------28/11/2014------------------------------------------------------------------------------

  

CREATE OR REPLACE VIEW vista_pser AS 
 SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, 
    pagos.monto_pago, pagos.nro_factura, contrato_servicio_deuda.id_cont_serv, 
    pagos.id_contrato, contrato_servicio_deuda.fecha_inst, 
    contrato_servicio_deuda.cant_serv, costo_cobro_serv as costo_cobro, 
    vista_servicios.id_serv, vista_servicios.tipo_servicio, 
    vista_servicios.nombre_servicio, vista_servicios.tipo_costo, 
    vista_servicios.status_servicio AS status_serv, 
    contrato_servicio_deuda.status_con_ser, pagos.status_pago, 
    pagos.obser_pago, 
    (vista_caja.nombre::text || ' '::text) || vista_caja.apellido::text AS cobrador, 
    pagos.nro_control, pagos.fecha_factura, vista_caja.id_franq, 
    franquicia.nombre_franq, tipo_doc
   FROM pago_factura, pagos, contrato_servicio_deuda, vista_servicios, 
    vista_caja, franquicia
  WHERE vista_caja.id_caja_cob = pagos.id_caja_cob AND pagos.id_pago = pago_factura.id_pago AND pago_factura.id_cont_serv = contrato_servicio_deuda.id_cont_serv AND contrato_servicio_deuda.id_serv = vista_servicios.id_serv AND franquicia.id_franq = vista_caja.id_franq
  ORDER BY contrato_servicio_deuda.fecha_inst DESC;


CREATE OR REPLACE VIEW vista_deudacli AS 
 SELECT contrato.id_contrato, calle.id_calle, calle.id_sector, sector.id_zona, 
    contrato.status_contrato, 
    ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) AS sum
           FROM contrato_servicio_deuda
          WHERE contrato_servicio_deuda.id_contrato = contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar) AS deuda, 
    ( SELECT sum(pagado) AS sum
           FROM contrato_servicio_deuda
          WHERE contrato_servicio_deuda.id_contrato = contrato.id_contrato AND contrato_servicio_deuda.status_con_ser = 'PAGADO'::bpchar) AS pagado
   FROM calle, contrato, sector
  WHERE calle.id_calle = contrato.id_calle AND calle.id_sector = sector.id_sector
  ORDER BY contrato.id_contrato;

  
  

CREATE OR REPLACE VIEW vista_ps_est AS 
 SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, 
    pagos.monto_pago, pagos.nro_factura, contrato_servicio_deuda.id_cont_serv, 
    pagos.id_contrato, contrato_servicio_deuda.fecha_inst, 
    contrato_servicio_deuda.cant_serv, pagado as costo_cobro, 
    pagos.status_pago, contrato_servicio_deuda.id_serv
   FROM pago_factura, pagos, contrato_servicio_deuda
  WHERE pagos.id_pago = pago_factura.id_pago AND pago_factura.id_cont_serv = contrato_servicio_deuda.id_cont_serv AND contrato_servicio_deuda.id_serv = 'SER00002'::bpchar
  ORDER BY pagos.nro_factura;


  
  DROP TABLE pago_servicio;
  
  DROP TABLE contrato_servicio_pagado;
  
  
  

CREATE OR REPLACE VIEW contrato_servicio_pagado AS 
 SELECT contrato_servicio_deuda.id_cont_serv, 
	id_serv, 
    id_contrato, 
	fecha_inst, 
    cant_serv,
	status_con_ser,
	pagado as costo_cobro, 
	descu,
	modo_des
   FROM pago_factura,  contrato_servicio_deuda
  WHERE  pago_factura.id_cont_serv = contrato_servicio_deuda.id_cont_serv ;

  
  

CREATE OR REPLACE VIEW pago_servicio AS 
 SELECT id_cont_serv, 
		id_pago
   FROM pago_factura;
  
  
  
CREATE TABLE pago_servicio
(
  id_pago character(15) NOT NULL,
  id_cont_serv character(12) NOT NULL
);



CREATE TABLE contrato_servicio_pagado
(
  id_cont_serv character(12) NOT NULL,
  id_serv character(8),
  id_contrato character(10),
  fecha_inst date,
  cant_serv integer,
  status_con_ser character(15),
  costo_cobro numeric(10,2),
  descu numeric(10,4),
  modo_des character(12),
  
  
  
  
  
  
  
  
  ----------------------------------------------------------------------12/12/2014---------------------------------------------------------
  
  
  
  
  
  
  
  
CREATE TABLE serv_acc
(
  id_serv character(15) NOT NULL,
  id_serv_acc character(12) NOT NULL,
  CONSTRAINT pk_pago_dfservicio PRIMARY KEY (id_serv, id_serv_acc),
  CONSTRAINT pago_servicio_id_serv_acc_fkey FOREIGN KEY (id_serv_acc)
      REFERENCES servicios_acc (id_serv_acc) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT pago_servicio_id_serv_fkey FOREIGN KEY (id_serv)
      REFERENCES servicios (id_serv) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE serv_acc
  OWNER TO postgres;

-- Index: relaterionship_22_pk

-- DROP INDEX relaterionship_22_pk;

CREATE UNIQUE INDEX relaterionship_22_pk
  ON serv_acc
  USING btree
  (id_serv COLLATE pg_catalog."default", id_serv_acc COLLATE pg_catalog."default");

  
  
  
  
INSERT INTO servicios_acc (id_serv_acc, nombre_servicio_acc, codigo_servicio_acc, abrev_serv, status_serv_acc) VALUES ('AA00001 ', 'HOME                          ', '1                             ', 'HOME      ', 'ACTIVO         ');
INSERT INTO servicios_acc (id_serv_acc, nombre_servicio_acc, codigo_servicio_acc, abrev_serv, status_serv_acc) VALUES ('AA00002 ', 'MAX                           ', '2                             ', 'MAX       ', 'ACTIVO         ');
INSERT INTO servicios_acc (id_serv_acc, nombre_servicio_acc, codigo_servicio_acc, abrev_serv, status_serv_acc) VALUES ('AA00003 ', 'HBO                           ', '3                             ', 'HBO       ', 'ACTIVO         ');
INSERT INTO servicios_acc (id_serv_acc, nombre_servicio_acc, codigo_servicio_acc, abrev_serv, status_serv_acc) VALUES ('AA00004 ', 'ADULTO 1                      ', '4                             ', 'ADULTO 1  ', 'ACTIVO         ');
INSERT INTO servicios_acc (id_serv_acc, nombre_servicio_acc, codigo_servicio_acc, abrev_serv, status_serv_acc) VALUES ('AA00005 ', 'ADULTO 2                      ', '5                             ', 'ADULTO 2  ', 'ACTIVO         ');
INSERT INTO servicios_acc (id_serv_acc, nombre_servicio_acc, codigo_servicio_acc, abrev_serv, status_serv_acc) VALUES ('AA00006 ', 'ADULTO 3                      ', '6                             ', 'ADULTO 3  ', 'ACTIVO         ');
INSERT INTO servicios_acc (id_serv_acc, nombre_servicio_acc, codigo_servicio_acc, abrev_serv, status_serv_acc) VALUES ('AA00007 ', 'MOVIECITY                     ', '7                             ', 'MOVIECITY ', 'ACTIVO         ');







-----------------------------------------------------------------------------------15/12/2014------------------------------------------------------------------------------------


CREATE TABLE interfaz_cablemodem
(
  id_accquery character(10) NOT NULL,
  serial_deco character(12),
  comando_acc character(20),
  status_accquery character(20),
  fecha_accquery date,
  login character(25),
  fecha date,
  hora time without time zone,
  CONSTRAINT pk_interfadzacc PRIMARY KEY (id_accquery)
)
WITH (
  OIDS=FALSE
);




 DROP TABLE interfazacc;

CREATE TABLE interfazacc
(
  id_accquery character(10) NOT NULL,
  serial_deco character(16),
  comando_acc character(20),
  status_accquery character(20),
  fecha_accquery date,
  login character(25),
  fecha date,
  hora timestamp without time zone,
  errmsg text,
  CONSTRAINT pk_interfazacc PRIMARY KEY (id_accquery)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE interfazacc
  OWNER TO postgres;











----------------------------------------------------------------------------------- 05/02/2015 --------------------------------------------------------------



  CREATE INDEX zona_ciudad_fk
    ON zona
    USING btree
    (id_ciudad);

DROP VIEW vista_calle1;
CREATE OR REPLACE VIEW vista_calle1 AS 
 SELECT calle.id_calle,
    calle.nombre_calle,
    sector.id_sector,
    sector.nombre_sector,
    zona.id_zona,
    zona.nombre_zona,
    ciudad.id_ciudad,
    ciudad.id_mun,
    ciudad.nombre_ciudad,
    ciudad.status_ciudad,
    municipio.id_esta,
    municipio.nombre_mun,
    estado.id_franq,
    estado.nombre_esta,
    franquicia.nombre_franq,
    calle.nro_calle
   FROM calle
   join sector ON calle.id_sector = sector.id_sector
    join zona ON sector.id_zona = zona.id_zona
    join ciudad ON zona.id_ciudad = ciudad.id_ciudad
    join municipio ON ciudad.id_mun = municipio.id_mun
    join estado ON municipio.id_esta = estado.id_esta
    join franquicia ON estado.id_franq = franquicia.id_franq
    
  ORDER BY zona.nombre_zona;






CREATE OR REPLACE VIEW vista_contrato_auditoria AS 
 SELECT contrato.id_contrato,
    contrato.id_persona,
    contrato.cli_id_persona,
    contrato.nro_contrato,
    contrato.fecha_contrato,
    contrato.etiqueta,
    contrato.costo_dif_men,
    contrato.status_contrato,
    contrato.nro_factura,
    persona.cedula,
    persona.nombre,
    persona.apellido,
    persona.telefono,
    cliente.telf_casa,
    cliente.telf_adic,
    contrato.direc_adicional,
    contrato.numero_casa,
    contrato.edificio,
    contrato.numero_piso,
    contrato.urbanizacion,
    grupo_afinidad.id_g_a,
    grupo_afinidad.nombre_g_a,
    calle.id_calle,
    calle.nombre_calle,
    sector.id_sector,
    sector.nombre_sector,
    zona.id_zona,
    zona.nombre_zona,
    ciudad.id_ciudad,
    ciudad.id_mun,
    ciudad.nombre_ciudad,
    municipio.id_esta,
    municipio.nombre_mun,
    estado.id_franq,
    estado.nombre_esta,
    franquicia.nombre_franq,
    contrato.postel,
    contrato.pto,
    contrato.cod_id_persona,
    (vista_cobrador.nombre::text || ' '::text) || vista_cobrador.apellido::text AS cobrador,
    contrato.etiqueta_n,
    contrato.taps,
    contrato.tipo_fact
   FROM contrato

   join calle ON contrato.id_calle = calle.id_calle
   join sector ON calle.id_sector = sector.id_sector
    join zona ON sector.id_zona = zona.id_zona
    join ciudad ON zona.id_ciudad = ciudad.id_ciudad
    join municipio ON ciudad.id_mun = municipio.id_mun
    join estado ON municipio.id_esta = estado.id_esta
    join franquicia ON estado.id_franq = franquicia.id_franq

    join cliente ON contrato.cli_id_persona = cliente.id_persona
    join persona ON persona.id_persona = cliente.id_persona
    join grupo_afinidad ON contrato.id_g_a = grupo_afinidad.id_g_a
    join vista_cobrador ON vista_cobrador.id_persona = contrato.cod_id_persona;





 CREATE OR REPLACE VIEW vista_orden AS
 SELECT ordenes_tecnicos.id_orden,
    ordenes_tecnicos.id_det_orden,
    ordenes_tecnicos.detalle_orden,
    ordenes_tecnicos.comentario_orden,
    ordenes_tecnicos.status_orden,
    ordenes_tecnicos.id_contrato,
    ordenes_tecnicos.prioridad,
    tipo_orden.id_tipo_orden,
    tipo_orden.nombre_tipo_orden,
    persona.cedula AS cedulacli,
    persona.nombre AS nombrecli,
    persona.apellido AS apellidocli,
    detalle_orden.nombre_det_orden,
    detalle_orden.tipo_detalle,
    contrato.cli_id_persona,
    contrato.nro_contrato,
    contrato.etiqueta,
    contrato.status_contrato,
    ( SELECT count(*) AS num_vis
           FROM visitas
          WHERE ordenes_tecnicos.id_orden = visitas.id_orden) AS num_visitas,
    ( SELECT orden_grupo.id_gt
           FROM orden_grupo
          WHERE ordenes_tecnicos.id_orden = orden_grupo.id_orden
         LIMIT 1) AS id_gt,
    ( SELECT grupo_trabajo.nombre_grupo
           FROM orden_grupo,
            grupo_trabajo
          WHERE orden_grupo.id_gt = grupo_trabajo.id_gt AND ordenes_tecnicos.id_orden = orden_grupo.id_orden
         LIMIT 1) AS nombre_grupo,
    ordenes_tecnicos.fecha_orden,
    ordenes_tecnicos.fecha_imp,
    ordenes_tecnicos.fecha_final,
    ordenes_tecnicos.fecha_cierre,
    ordenes_tecnicos.login AS login_emi,
    ordenes_tecnicos.hora AS hora_emi,
    ordenes_tecnicos.login_imp,
    ordenes_tecnicos.hora_imp,
    ordenes_tecnicos.login_fin,
    ordenes_tecnicos.hora_fin,
    contrato.id_calle,
    calle.id_sector,
    calle.nombre_calle,
    sector.id_zona,
    sector.nombre_sector,
    ciudad.id_ciudad,
    ciudad.id_mun,
    ciudad.nombre_ciudad,
    estado.id_esta,
    municipio.nombre_mun,
    franquicia.id_franq,
    zona.nombre_zona,
    franquicia.nombre_franq,
    estado.nombre_esta,
    grupo_afinidad.id_g_a,
    grupo_afinidad.nombre_g_a,
    contrato.contrato_fisico,
    contrato.postel
   FROM  ordenes_tecnicos
    join detalle_orden ON detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden
    join contrato ON ordenes_tecnicos.id_contrato = contrato.id_contrato
    join tipo_orden ON tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden
    join grupo_afinidad ON grupo_afinidad.id_g_a = contrato.id_g_a
    join cliente ON contrato.cli_id_persona = cliente.id_persona
    join persona ON persona.id_persona = cliente.id_persona

    join calle ON contrato.id_calle = calle.id_calle
    join sector ON calle.id_sector = sector.id_sector
    join zona ON sector.id_zona = zona.id_zona
    join ciudad ON zona.id_ciudad = ciudad.id_ciudad
    join municipio ON ciudad.id_mun = municipio.id_mun
    join estado ON municipio.id_esta = estado.id_esta
    join franquicia ON estado.id_franq = franquicia.id_franq;



DROP VIEW vista_convenio;
CREATE OR REPLACE VIEW vista_convenio AS 
 SELECT servicios.id_serv,
    servicios.nombre_servicio,
    conv_con.id_conv_cont,
    conv_con.id_conv,
    conv_con.id_cont_serv,
    conv_con.fecha_ven,
    conv_con.fecha_inst,
    conv_con.status_con_ser,
    conv_con.costo_cobro,
    convenio_pago.dato,
    convenio_pago.fecha_conv,
    convenio_pago.obser_conv,
    convenio_pago.login,
    convenio_pago.status_conv,
    convenio_pago.id_contrato
   FROM servicios
    join conv_con ON servicios.id_serv = conv_con.id_serv
    join convenio_pago ON convenio_pago.id_conv = conv_con.id_conv;











----------------------------------------------------------------------------------- 06/02/2015 --------------------------------------------------------------






CREATE INDEX rela_fk1
  ON contrato_servicio_deuda
  USING btree
  (status_con_ser);


CREATE INDEX rela_fk2
  ON contrato_servicio_deuda
  USING btree
  (fecha_inst);


CREATE INDEX zona_ciudad_fk1
  ON zona
  USING btree
  (nombre_zona);


CREATE INDEX relatsdfi332_pk1
  ON contrato
  USING btree
  (postel);


CREATE INDEX relacont1
  ON contrato
  USING btree
  (nro_contrato);



CREATE INDEX relacont12
  ON contrato
  USING btree
  (status_contrato);

CREATE INDEX relacont123
  ON contrato
  USING btree
  (contrato_fisico);


CREATE INDEX relper1
  ON persona
  USING btree
  (cedula);

CREATE INDEX relper12
  ON persona
  USING btree
  (nombre);

CREATE INDEX relper13
  ON persona
  USING btree
  (apellido);


CREATE INDEX relubi1
  ON calle
  USING btree
  (nombre_calle);


CREATE INDEX relubi2
  ON sector
  USING btree
  (nombre_sector);

CREATE INDEX relubi3
  ON sector
  USING btree
  (nombre_sector);
  
CREATE INDEX relubi4
  ON ciudad
  USING btree
  (nombre_ciudad);
  
CREATE INDEX relubi5
  ON municipio
  USING btree
  (nombre_mun);
  
CREATE INDEX relubi6
  ON estado
  USING btree
  (nombre_esta);
  
CREATE INDEX relubi7
  ON franquicia
  USING btree
  (nombre_franq);



CREATE OR REPLACE VIEW vista_deuda AS 
SELECT id_contrato,servicios.id_serv,id_tipo_servicio,(((cant_serv * costo_cobro)- descu )-pagado) as deuda,fecha_inst FROM contrato_servicio_deuda , servicios WHERE contrato_servicio_deuda.id_serv=servicios.id_serv  AND status_con_ser = 'DEUDA' and (((cant_serv * costo_cobro)- descu )-pagado)>0;







----------------------------------------------------------------------------------- 07/02/2015 --------------------------------------------------------------





CREATE TABLE paquete
(
  id_paq character(5) NOT NULL,
  nombre_paq character(30),
  status_paq character(10),
  
  CONSTRAINT pk_id_paq PRIMARY KEY (id_paq )
);

CREATE UNIQUE INDEX paquete1
  ON paquete
  USING btree
  (id_paq);

CREATE TABLE cant_tv
(
  id_cant character(5) NOT NULL,
  cantidad integer,
  status_cant character(10),
  
  CONSTRAINT pk_cant_tv PRIMARY KEY (id_cant )
);

CREATE UNIQUE INDEX paquete2
  ON cant_tv
  USING btree
  (id_cant);


  ALTER TABLE servicios ADD id_paq character(5) default '';
  ALTER TABLE servicios ADD id_cant character(5) default '';


CREATE OR REPLACE VIEW vista_serv AS 
 SELECT servicios.id_serv, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, servicios.tipo_costo, servicios.tipo_paq, servicios.tarifa_esp, servicios.tipo_serv, cant_tv.cantidad, contrato_servicio.id_cont_serv, contrato_servicio.id_contrato, cant_tv.id_cant, servicios.id_paq
   FROM servicios, cant_tv, contrato_servicio
  WHERE servicios.id_cant = cant_tv.id_cant AND servicios.id_serv = contrato_servicio.id_serv;




CREATE OR REPLACE FUNCTION modificar_paq_servicios()
  RETURNS trigger AS
$BODY$
DECLARE
serv servicios%ROWTYPE;
servic servicios%ROWTYPE;
cont_serv vista_serv%ROWTYPE;
BEGIN
  PERFORM pg_notify('watchers', TG_TABLE_NAME || ',id_cont_serv: ,' || NEW.id_cont_serv || ',id_contrato: ,' || NEW.id_contrato  || ',id_serv: ,' || NEW.id_serv );
  


 --FOR cont IN (SELECT id_cont_serv,id_serv FROM servicios where id_cont_serv<> NEW.id_cont_serv and id_contrato= NEW.id_contrato) LOOP
 FOR serv IN (SELECT * FROM servicios where id_serv= NEW.id_serv) LOOP
  IF serv.id_cant <> '' THEN
    --INSERT INTO banco (id_banco, banco,tipo_banco) VALUES(serv.id_serv, serv.id_cant, serv.id_paq);
    FOR cont_serv IN (SELECT * FROM vista_serv where id_cont_serv<> NEW.id_cont_serv and id_contrato = NEW.id_contrato and id_cant<>serv.id_cant) LOOP
  --INSERT INTO banco (id_banco, banco,tipo_banco) VALUES(cont_serv.id_cont_serv, cont_serv.id_serv, cont_serv.cantidad);
  FOR servic IN (SELECT * FROM servicios where id_cant = serv.id_cant and id_paq = cont_serv.id_paq ) LOOP
    --INSERT INTO banco (id_banco, banco,tipo_banco) VALUES(cont_serv.id_cont_serv, servic.id_serv, cont_serv.cantidad);
    update contrato_servicio set id_serv=servic.id_serv where id_cont_serv=cont_serv.id_cont_serv;
  END LOOP;
    END LOOP;
 END IF;
  

END LOOP;

  
  RETURN new;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION modificar_paq_servicios()
  OWNER TO postgres;






CREATE TRIGGER trigger_servicio_insert
  AFTER INSERT
  ON contrato_servicio
  FOR EACH ROW
  EXECUTE PROCEDURE modificar_paq_servicios();

-- Trigger: trigger_servicio_update on contrato_servicio

-- DROP TRIGGER trigger_servicio_update ON contrato_servicio;

CREATE TRIGGER trigger_servicio_update
  AFTER UPDATE
  ON contrato_servicio
  FOR EACH ROW
  EXECUTE PROCEDURE modificar_paq_servicios();








----------------------------------------------------------------------------------- 09/02/2015 --------------------------------------------------------------




CREATE TABLE servicio_franquicia
(
  id_franq character(5) NOT NULL,
  id_serv character(8) NOT NULL,
  CONSTRAINT pk_servicio_franquicia PRIMARY KEY (id_franq , id_serv )
)
WITH (
  OIDS=FALSE
);


ALTER TABLE franquicia ADD abrev_franq character(20);



CREATE OR REPLACE VIEW vista_servicios AS 
 SELECT servicios.id_serv, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, tipo_servicio.tipo_servicio, tipo_servicio.status_servicio, tipo_servicio.id_franq, franquicia.nombre_franq, franquicia.municipio_franq, franquicia.ciudad_franq, franquicia.estado_franq, franquicia.direccion_franq, servicios.tipo_costo, servicios.tipo_paq, servicios.tarifa_esp, servicios.tipo_serv, servicios.id_cant, cant_tv.cantidad, paquete.id_paq, paquete.nombre_paq,tarifa_ser
   FROM servicios
   JOIN tipo_servicio ON servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio
   JOIN franquicia ON tipo_servicio.id_franq = franquicia.id_franq
   LEFT JOIN cant_tv ON servicios.id_cant = cant_tv.id_cant
   LEFT JOIN paquete ON servicios.id_paq = paquete.id_paq
   LEFT JOIN tarifa_servicio ON servicios.id_serv = tarifa_servicio.id_serv AND tarifa_servicio.status_tarifa_ser='ACTIVO';

  

ALTER TABLE servicios_acc ADD tipo character(20);
update servicios_acc set tipo='ACC';



/*
--PRIMERO DEBEMOS ELIMINAR LOS NUMERO DE CONTRATOS REPETIDOS.
--select nro_contrato from contrato where (select count(*) from contrato as c where c.nro_contrato=contrato.nro_contrato)>1 ORDER BY NRO_CONTRATO

DROP INDEX relacont1;
CREATE unique INDEX relacont1aa
  ON contrato
  USING btree
  (nro_contrato );
*/

CREATE OR REPLACE VIEW vista_cant_serv_tv AS
 SELECT servicios.id_serv,  cant_tv.cantidad, cant_tv.id_cant, servicios.id_paq
   FROM servicios, cant_tv
  WHERE servicios.id_cant = cant_tv.id_cant

/*
  ALTER TABLE sector ADD id_franq character(5);

  update sector set id_franq= (select id_franq from vista_zona1 where sector.id_zona=vista_zona1.id_zona limit 1);

ALTER TABLE ONLY public.estado DROP CONSTRAINT fk_estado_reference_pais;
DROP INDEX reladtiddffk;



ALTER TABLE ONLY sector
    ADD CONSTRAINT fk_sector_referencia_franq FOREIGN KEY (id_franq) REFERENCES franquicia(id_franq) ON UPDATE RESTRICT ON DELETE RESTRICT;


 -- ALTER TABLE estado DROP  id_franq;
*/

CREATE TABLE grupo_franq
(
  nombre_gf character(50),
  id_gf character(5),
  status_gf character(10),
  CONSTRAINT pk_grupo_franq PRIMARY KEY (id_gf )
);


INSERT INTO grupo_franq (id_gf, nombre_gf, status_gf) VALUES ('AA001', 'CARACAS                                           ', 'ACTIVO    ');
INSERT INTO grupo_franq (id_gf, nombre_gf, status_gf) VALUES ('AA002', 'VALENCIA                                          ', 'ACTIVO    ');
INSERT INTO grupo_franq (id_gf, nombre_gf, status_gf) VALUES ('AA003', 'PUERTO CABELLO                                    ', 'ACTIVO    ');
INSERT INTO grupo_franq (id_gf, nombre_gf, status_gf) VALUES ('AA004', 'MARACAY                                           ', 'ACTIVO    ');

ALTER TABLE franquicia ADD id_gf character(5);


ALTER TABLE ONLY servicios
    ADD CONSTRAINT servicios_id_tipo_servicio_nombre_servicio_key UNIQUE (id_tipo_servicio, nombre_servicio);

CREATE TABLE serv_deco
(
  id_da character(15) NOT NULL,
  id_serv_acc character(12) NOT NULL,
  status_sd character(15),
  CONSTRAINT pk_paffgo_dfservicio PRIMARY KEY (id_da , id_serv_acc )
)
WITH (
  OIDS=FALSE
);


CREATE UNIQUE INDEX rserv_decopk
  ON serv_deco
  USING btree
  (id_da , id_serv_acc);



CREATE OR REPLACE VIEW vista_serv_deco AS 
 SELECT 
 servicios_acc.id_serv_acc,
 servicios_acc.nombre_servicio_acc,
 servicios_acc.codigo_servicio_acc,
 servicios_acc.abrev_serv,
 servicios_acc.status_serv_acc,
 serv_deco.status_sd,
 serv_deco.id_da
 from servicios_acc
 join serv_deco on servicios_acc.id_serv_acc = serv_deco.id_serv_acc







---------------------------------------------------------------12/02/2015--------------------------------------------------

CREATE TABLE tipo_sistema
(
  id_ta character(5) NOT NULL,
  sistema character(30),
  ubicacion character(30),
  abrev_nombre_ta character(12),
  status_ta character(15),
  CONSTRAINT pk_tipo_sistema PRIMARY KEY (id_ta)
);
CREATE UNIQUE INDEX tipo_sistema_pk

  ON tipo_sistema
  USING btree
  (id_ta);



INSERT INTO tipo_sistema (id_ta, sistema, ubicacion, abrev_nombre_ta, status_ta) VALUES ('AA001', 'ACC                           ', 'CARACAS                       ', 'ACC CCS     ', 'ACTIVO         ');
INSERT INTO tipo_sistema (id_ta, sistema, ubicacion, abrev_nombre_ta, status_ta) VALUES ('AA002', 'ACC                           ', 'VALENCIA                      ', 'ACC VAL     ', 'ACTIVO         ');
INSERT INTO tipo_sistema (id_ta, sistema, ubicacion, abrev_nombre_ta, status_ta) VALUES ('AA003', 'SM                            ', 'PUERTO CABELLO                ', 'SM CT       ', 'ACTIVO         ');
INSERT INTO tipo_sistema (id_ta, sistema, ubicacion, abrev_nombre_ta, status_ta) VALUES ('AA004', 'CAS                           ', 'CARACAS                       ', 'CAS CCS     ', 'ACTIVO         ');
INSERT INTO tipo_sistema (id_ta, sistema, ubicacion, abrev_nombre_ta, status_ta) VALUES ('AA005', 'CAS                           ', 'VALENCIA                      ', 'CAS VAL     ', 'ACTIVO         ');
INSERT INTO tipo_sistema (id_ta, sistema, ubicacion, abrev_nombre_ta, status_ta) VALUES ('AA006', 'CMTS                          ', 'CARACAS                       ', 'CABLE MODEM ', 'ACTIVO         ');
INSERT INTO tipo_sistema (id_ta, sistema, ubicacion, abrev_nombre_ta, status_ta) VALUES ('AA007', 'MICROTIK                      ', 'CARACAS                       ', 'MIKROTIK    ', 'ACTIVO         ');


ALTER TABLE servicios_acc ALTER column tipo TYPE character(5);
ALTER TABLE servicios_acc rename column tipo to id_ta;


ALTER TABLE deco_ana ALTER column id_da TYPE  character varying(10);
 ALTER TABLE deco_ana ALTER column id_contrato TYPE  character varying(10);
 ALTER TABLE deco_ana ALTER column codigo_da TYPE  character varying(20);
 ALTER TABLE deco_ana ALTER column marca_da TYPE  character varying(50);
 ALTER TABLE deco_ana ALTER column modelo_da  TYPE character varying(50);
 ALTER TABLE deco_ana ALTER column prov_da TYPE  character varying(80);
 ALTER TABLE deco_ana ALTER column tipo_da TYPE  character varying(30);
 ALTER TABLE deco_ana ALTER column chanmap_da  TYPE character varying(30);
 ALTER TABLE deco_ana ALTER column punto_da  TYPE character varying(30);
 ALTER TABLE deco_ana ALTER column status_da  TYPE character varying(20);

 ALTER TABLE deco_ana ALTER column obser_da  TYPE character varying(255);
 ALTER TABLE deco_ana ALTER column servicio TYPE  character varying(50);
 ALTER TABLE deco_ana ALTER column nota2  TYPE character varying(50);
 ALTER TABLE deco_ana ALTER column nota3  TYPE character varying(50);


 ALTER TABLE interfazacc ALTER id_accquery TYPE character varying(10);
 ALTER TABLE interfazacc ALTER serial_deco TYPE character varying(16);
 ALTER TABLE interfazacc ALTER comando_acc TYPE character varying(20);
ALTER TABLE interfazacc ALTER status_accquery TYPE character varying(20);


CREATE OR REPLACE FUNCTION notify_acc_trigger()
  RETURNS trigger AS
$BODY$
DECLARE
BEGIN
  PERFORM pg_notify('acc', TG_TABLE_NAME || ',id_accuery:' || NEW.id_accquery || 'serial:' || NEW.serial_deco );
  RETURN new;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION notify_acc_trigger()
  OWNER TO postgres;
GRANT EXECUTE ON FUNCTION notify_acc_trigger() TO public;
GRANT EXECUTE ON FUNCTION notify_acc_trigger() TO postgres;



DROP TABLE interfazacc;

CREATE TABLE interfazacc
(
  id_accquery character varying(10) NOT NULL,
  serial_deco character varying(16),
  comando_acc character varying(20),
  status_accquery character varying(20),
  fecha_accquery date,
  login character varying(25),
  fecha date,
  hora timestamp without time zone,
  errmsg text,
  CONSTRAINT pk_interfazacc PRIMARY KEY (id_accquery )
)
WITH (
  OIDS=FALSE
);
ALTER TABLE interfazacc
  OWNER TO postgres;
GRANT ALL ON TABLE interfazacc TO postgres;
GRANT SELECT, INSERT ON TABLE interfazacc TO soloconsulta;

-- Trigger: interfazacc_insert_trigger on interfazacc

-- DROP TRIGGER interfazacc_insert_trigger ON interfazacc;

CREATE TRIGGER interfazacc_insert_trigger
  AFTER INSERT
  ON interfazacc
  FOR EACH ROW
  EXECUTE PROCEDURE notify_acc_trigger();

-- Trigger: watched_table_trigger_update on interfazacc

-- DROP TRIGGER watched_table_trigger_update ON interfazacc;

CREATE TRIGGER watched_table_trigger_update
  AFTER UPDATE
  ON interfazacc
  FOR EACH ROW
  EXECUTE PROCEDURE notify_acc_trigger();











--------------------------------------------------------------24/02/2015------------------------------------------------------







create table COMANDOS_INTERFAZ 
(
   ID_COM_INT           CHAR(5)                        not null,
   ID_TSE               CHAR(5),
   NOMBRE_COM_INT       CHAR(20),
   STATUS_COM_INT       CHAR(10),
   TIPO_COM             CHAR(15),
   constraint PK_COMANDOS_INTERFAZ primary key (ID_COM_INT)
);


/*==============================================================*/
/* Table: EQUIPO_SISTEMA                                        */
/*==============================================================*/
create table EQUIPO_SISTEMA 
(
   ID_ES                CHAR(10)                       not null,
   ID_MODELO            CHAR(8),
   ID_UES               CHAR(5),
   ID_CONTRATO          CHAR(10),
   CODIGO_ES            CHAR(20),
   TIPO_ES              CHAR(30),
   STATUS_ES            CHAR(20),
   OBSER_ES             text,
   CODIGO_ADIC          CHAR(20),
   constraint PK_EQUIPO_SISTEMA primary key (ID_ES)
);

/*==============================================================*/
/* Table: EVENTO_INTERFAZ                                       */
/*==============================================================*/
create table INTERFAZ_EQUIPOS 
(
   ID_INTE              CHAR(10)                       not null,
   ID_COM_INT           CHAR(5),
   ID_ES                CHAR(10),
   STATUS               CHAR(10),
   FECHA                timestamp with time zone,
   login              CHAR(25),
   ERRMSG               text,
   CAD_ENV              text,
   CAD_REC              text,
   fecha_ejec           timestamp with time zone,
   constraint PK_EVENTO_INTERFAZ primary key (ID_INTE)
);

/*==============================================================*/
/* Table: MOVIMIENTO_EQUIPO                                     */
/*==============================================================*/
create table MOVIMIENTO_EQUIPO 
(
   ID_MOV_E             CHAR(8)                        not null,
   ID_ES                CHAR(10),
   UBIC_ANT             CHAR(5),
   UBIC_POST            CHAR(5),
   login              CHAR(25),
   FECHA                timestamp with time zone,
   MOTIVO               text,
   constraint PK_MOVIMIENTO_EQUIPO primary key (ID_MOV_E)
);

/*==============================================================*/
/* Table: SERVICIOS_SISTEMA                                     */
/*==============================================================*/
create table SERVICIOS_SISTEMA 
(
   ID_SERV_SIST         CHAR(8)                        not null,
   NOMBRE_SERV_SIST     CHAR(30),
   CODIGO_SERV_SIST     CHAR(10),
   ABREV_SERV_SIST      CHAR(15),
   STATUS_SERV_SIST     CHAR(15),
   ID_TSE               CHAR(5),
   constraint PK_SERVICIOS_SISTEMA primary key (ID_SERV_SIST)
);

/*==============================================================*/
/* Table: SERV_SIST_EQUIPO                                      */
/*==============================================================*/
create table SERV_SIST_EQUIPO 
(
   ID_ES                CHAR(10),
   ID_SERV_SIST         CHAR(8),
   STATUS_SSE           CHAR(15)
);

/*==============================================================*/
/* Table: SERV_SIST_PAQ                                         */
/*==============================================================*/
create table SERV_SIST_PAQ 
(
   ID_SERV              CHAR(8),
   ID_SERV_SIST         CHAR(8)
);

/*==============================================================*/
/* Table: TIPO_SIST_EQUIPO                                      */
/*==============================================================*/
create table TIPO_SIST_EQUIPO 
(
   ID_TSE               CHAR(5)                        not null,
   SISTEMA              CHAR(30),
   UBICACION            CHAR(30),
   ABREV_NOMBRE_TSE     CHAR(15),
   STATUS_TSE           CHAR(15),
   constraint PK_TIPO_SIST_EQUIPO primary key (ID_TSE)
);

/*==============================================================*/
/* Table: TRIGGER_EVENT_SAECO_INT                               */
/*==============================================================*/
create table TRIGGER_EVENT_SAECO_INT 
(
   ID_TESI              char(8)                        not null,
   ID_DET_ORDEN         CHAR(8),
   ID_COM_INT           CHAR(5),
   DESC_ESI             text,
   STATUS_ESI           char(10),
   TIPO_COM             char(15),
   TIPO_TESI            char(15),
   ID_REL               char(10),
   constraint PK_TRIGGER_EVENT_SAECO_INT primary key  (ID_TESI)
);

/*==============================================================*/
/* Table: UBICACION_EQUIPO_SIS                                 */
/*==============================================================*/
create table UBICACION_EQUIPO_SIS 
(
   ID_UES               CHAR(5)                        not null,
   NOMBRE_UES           CHAR(30),
   DIRECCION_UES        CHAR(255),
   STATUS_UES           CHAR(10),
   constraint PK_UBICACION_EQUIPO_SIS primary key (ID_UES)
);

alter table COMANDOS_INTERFAZ
   add constraint FK_COMANDOS_REFERENCE_TIPO_SIS foreign key (ID_TSE)
      references TIPO_SIST_EQUIPO (ID_TSE)
      on update restrict
      on delete restrict;

alter table EQUIPO_SISTEMA
   add constraint FK_EQUIPO_S_REFERENCE_UBICACIO foreign key (ID_UES)
      references UBICACION_EQUIPO_SIS (ID_UES)
      on update restrict
      on delete restrict;

alter table EQUIPO_SISTEMA
   add constraint FK_EQUIPO_S_REFERENCE_MODELO foreign key (ID_MODELO)
      references MODELO (ID_MODELO)
      on update restrict
      on delete restrict;


alter table EVENTO_INTERFAZ
   add constraint FK_EVENTO_I_REFERENCE_COMANDOS foreign key (ID_COM_INT)
      references COMANDOS_INTERFAZ (ID_COM_INT)
      on update restrict
      on delete restrict;

alter table EVENTO_INTERFAZ
   add constraint FK_EVENTO_I_REFERENCE_EQUIPO_S foreign key (ID_ES)
      references EQUIPO_SISTEMA (ID_ES)
      on update restrict
      on delete restrict;


alter table MOVIMIENTO_EQUIPO
   add constraint FK_MOVIMIEN_REFERENCE_EQUIPO_S foreign key (ID_ES)
      references EQUIPO_SISTEMA (ID_ES)
      on update restrict
      on delete restrict;

alter table SERVICIOS_SISTEMA
   add constraint FK_SERVICIO_REFERENCE_TIPO_SIS foreign key (ID_TSE)
      references TIPO_SIST_EQUIPO (ID_TSE)
      on update restrict
      on delete restrict;

alter table SERV_SIST_EQUIPO
   add constraint FK_SERV_SIS_REFERENCE_EQUIPO_S foreign key (ID_ES)
      references EQUIPO_SISTEMA (ID_ES)
      on update restrict
      on delete restrict;

alter table SERV_SIST_EQUIPO
   add constraint FK_SERV_SIS_REFERENCE_SERVICIO foreign key (ID_SERV_SIST)
      references SERVICIOS_SISTEMA (ID_SERV_SIST)
      on update restrict
      on delete restrict;

alter table SERV_SIST_PAQ
   add constraint FK_SERV_SIS_REFERENCE_SERVICIO1 foreign key (ID_SERV)
      references SERVICIOS (ID_SERV)
      on update restrict
      on delete restrict;

alter table SERV_SIST_PAQ
   add constraint FK_SERV_SIS_REFERENCE_SERVICIO foreign key (ID_SERV_SIST)
      references SERVICIOS_SISTEMA (ID_SERV_SIST)
      on update restrict
      on delete restrict;

alter table TRIGGER_EVENT_SAECO_INT
   add constraint FK_TRIGGER__REFERENCE_DETALLE_ foreign key (ID_DET_ORDEN)
      references DETALLE_ORDEN (ID_DET_ORDEN)
      on update restrict
      on delete restrict;

alter table TRIGGER_EVENT_SAECO_INT
   add constraint FK_TRIGGER__REFERENCE_COMANDOS foreign key (ID_COM_INT)
      references COMANDOS_INTERFAZ (ID_COM_INT)
      on update restrict
      on delete restrict;





INSERT INTO tipo_sist_equipo (id_tse, sistema, ubicacion, abrev_nombre_tse, status_tse) VALUES ('AA001', 'ACC                           ', 'CARACAS                       ', 'ACC CCS        ', 'ACTIVO         ');
INSERT INTO tipo_sist_equipo (id_tse, sistema, ubicacion, abrev_nombre_tse, status_tse) VALUES ('AA002', 'ACC                           ', 'VALENCIA                      ', 'ACC VAL        ', 'ACTIVO         ');
INSERT INTO tipo_sist_equipo (id_tse, sistema, ubicacion, abrev_nombre_tse, status_tse) VALUES ('AA003', 'SM                            ', 'PUERTO CABELLO                ', 'SM CT          ', 'ACTIVO         ');
INSERT INTO tipo_sist_equipo (id_tse, sistema, ubicacion, abrev_nombre_tse, status_tse) VALUES ('AA005', 'CAS                           ', 'VALENCIA                      ', 'CAS VAL        ', 'ACTIVO         ');
INSERT INTO tipo_sist_equipo (id_tse, sistema, ubicacion, abrev_nombre_tse, status_tse) VALUES ('AA006', 'CMTS                          ', 'CARACAS                       ', 'CABLE MODEM    ', 'ACTIVO         ');
INSERT INTO tipo_sist_equipo (id_tse, sistema, ubicacion, abrev_nombre_tse, status_tse) VALUES ('AA007', 'MICROTIK                      ', 'CARACAS                       ', 'MIKROTIK       ', 'ACTIVO         ');
INSERT INTO tipo_sist_equipo (id_tse, sistema, ubicacion, abrev_nombre_tse, status_tse) VALUES ('AA004', 'CAS                           ', 'CARACAS                       ', 'CAS CCS        ', 'ACTIVO         ');






INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00001 ', 'HOME + ADULTOS                ', '9                             ', 'HOME + ADULTOS ', 'ACTIVO         ', 'AA001');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00002 ', 'CABLE HOME                    ', '5                             ', 'CABLE HOME     ', 'ACTIVO         ', 'AA001');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00011 ', 'ADULTOS 2                     ', '108                           ', 'ADULTOS 2      ', 'ACTIVO         ', 'AA001');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00010 ', 'ADULTOS 1                     ', '107                           ', 'ADULTOS 1      ', 'ACTIVO         ', 'AA001');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00009 ', 'WEB                           ', '90                            ', 'WEB            ', 'ACTIVO         ', 'AA001');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00006 ', 'INICIAL                       ', '13                            ', 'INICIAL        ', 'ACTIVO         ', 'AA001');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00005 ', 'HBO                           ', '12                            ', 'HBO            ', 'ACTIVO         ', 'AA001');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00004 ', 'PLUS                          ', '11                            ', 'PLUS           ', 'ACTIVO         ', 'AA001');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00003 ', 'SOCIAL                        ', '10                            ', 'SOCIAL         ', 'ACTIVO         ', 'AA001');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00012 ', 'MAX                           ', '1                             ', 'MAX            ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00019 ', 'FOX+                          ', '8                             ', 'FOX+           ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00018 ', 'INICIO                        ', '7                             ', 'INICIO         ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00017 ', 'SOCIAL                        ', '6                             ', 'SOCIAL         ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00016 ', 'ADULTOS                       ', '5                             ', 'ADULTOS        ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00015 ', 'HBO                           ', '4                             ', 'HBO            ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00014 ', 'HOME                          ', '3                             ', 'HOME           ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00013 ', 'PLUS                          ', '2                             ', 'PLUS           ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00030 ', 'SOCIAL                        ', '12                            ', 'SOCIAL         ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00029 ', 'HBO                           ', '11                            ', 'HBO            ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00028 ', 'CABLE INICIO                  ', '10                            ', 'CABLE INICIO   ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00040 ', 'PAQUETE MEDIUM                ', '8                             ', 'PAQUETE MEDIUM ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00039 ', 'VENUS                         ', '5                             ', 'VENUS          ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00038 ', 'PLAY BOY                      ', '4                             ', 'PLAY BOY       ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00037 ', 'HBO                           ', '3                             ', 'HBO            ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00036 ', 'PAQUETE BASICO                ', '1                             ', 'PAQUETE BASICO ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00035 ', 'PAQUETE WEB                   ', '05                            ', 'PAQUETE WEB    ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00034 ', 'GRILLA SOCIAL                 ', '04                            ', 'GRILLA SOCIAL  ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00033 ', 'PLUS + ADULTOS                ', '03                            ', 'PLUS + ADULTOS ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00032 ', 'SUPER ESTELAR                 ', '02                            ', 'SUPER ESTELAR  ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00031 ', 'FOX+                          ', '13                            ', 'FOX+           ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00027 ', 'ADULTOS 2                     ', '9                             ', 'ADULTOS 2      ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00026 ', 'MAX                           ', '8                             ', 'MAX            ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00025 ', 'ADULTOS 1                     ', '7                             ', 'ADULTOS 1      ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00024 ', 'EMISORAS                      ', '6                             ', 'EMISORAS       ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00023 ', 'HOME                          ', '5                             ', 'HOME           ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00022 ', 'PLUS                          ', '3                             ', 'PLUS           ', 'ACTIVO         ', 'AA002');
INSERT INTO servicios_sistema (id_serv_sist, nombre_serv_sist, codigo_serv_sist, abrev_serv_sist, status_serv_sist, id_tse) VALUES ('AA00021 ', 'WEB                           ', '2                             ', 'WEB            ', 'ACTIVO         ', 'AA002');


DROP TABLE serv_acc;
DROP TABLE servicios_acc;
DROP TABLE tipo_sistema;

DROP VIEW vista_modelo;
update modelo set tipo_modelo='';
ALTER TABLE modelo
    RENAME  column tipo_modelo TO id_tse;
  ALTER TABLE modelo ALTER id_tse TYPE character(5);


CREATE OR REPLACE VIEW vista_modelo AS 
 SELECT marca.id_marca, marca.nombre_marca, marca.status_marca, modelo.id_modelo, modelo.nombre_modelo, modelo.id_tse, modelo.status_modelo,
 (sistema || ' ' || ubicacion) as sistema
   FROM modelo 
   join marca on marca.id_marca = modelo.id_marca
   join tipo_sist_equipo on modelo.id_tse=tipo_sist_equipo.id_tse

ALTER TABLE equipo_sistema ADD estado_fisico character(20);




---------------------------------------------------------26/02/2015-----------------------------------------------------------


alter table modelo
   add constraint FK_modelomarca foreign key (id_marca)
      references marca (id_marca)
      on update restrict
      on delete restrict;


alter table modelo
   add constraint FK_modelosistema foreign key (id_tse)
      references tipo_sist_equipo (id_tse)
      on update restrict
      on delete restrict;

ALTER TABLE ONLY modelo
    ADD CONSTRAINT marcamodelounique UNIQUE (id_marca,nombre_modelo);
     
ALTER TABLE ONLY modelo
    ADD CONSTRAINT marcamodelouniquesistema UNIQUE (id_tse,nombre_modelo);

CREATE UNIQUE INDEX marcaide
  ON marca
  USING btree
  (id_marca);


CREATE UNIQUE INDEX marcaide2
  ON modelo
  USING btree
  (id_modelo);




CREATE  INDEX marcafgidfde2
  ON modelo
  USING btree
  (id_marca);

CREATE  INDEX marcafgfggidfde2
  ON modelo
  USING btree
  (id_tse);





---------------------------------------02/03/2015-----------------------------------------


CREATE OR REPLACE VIEW vista_equipo_sistema AS 
 SELECT contrato.id_contrato,  contrato.nro_contrato, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, id_es, modelo.id_modelo, codigo_es, status_es, codigo_adic , estado_fisico, nombre_modelo,tipo_sist_equipo.id_tse, abrev_nombre_tse as sistema
   FROM equipo_sistema
  join modelo on equipo_sistema.id_modelo=modelo.id_modelo
  join tipo_sist_equipo on modelo.id_tse=tipo_sist_equipo.id_tse
  LEFT JOIN contrato on contrato.id_contrato=equipo_sistema.id_contrato
  LEFT JOIN cliente ON contrato.cli_id_persona = cliente.id_persona
  LEFT JOIN persona ON persona.id_persona = cliente.id_persona



CREATE OR REPLACE VIEW vista_interfaz_equipo AS 
 SELECT contrato.id_contrato,  contrato.nro_contrato, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, equipo_sistema.id_es, modelo.id_modelo, codigo_es, status_es, codigo_adic , estado_fisico, nombre_modelo,tipo_sist_equipo.id_tse, abrev_nombre_tse as sistema, comandos_interfaz.id_com_int,nombre_com_int,
 interfaz_equipos.id_inte,interfaz_equipos.status,interfaz_equipos.fecha,interfaz_equipos.login,interfaz_equipos.errmsg,fecha_ejec
   FROM equipo_sistema
  join interfaz_equipos on interfaz_equipos.id_es=equipo_sistema.id_es
  join comandos_interfaz on interfaz_equipos.id_com_int=comandos_interfaz.id_com_int
  join modelo on equipo_sistema.id_modelo=modelo.id_modelo
  join tipo_sist_equipo on modelo.id_tse=tipo_sist_equipo.id_tse
  LEFT JOIN contrato on contrato.id_contrato=equipo_sistema.id_contrato
  LEFT JOIN cliente ON contrato.cli_id_persona = cliente.id_persona
  LEFT JOIN persona ON persona.id_persona = cliente.id_persona




CREATE TABLE contrato_servicio_temp
(
  id_cont_serv character(12) NOT NULL,
  id_serv character(8),
  id_contrato character(10),
  fecha_inst date,
  cant_serv integer,
  status_con_ser character(15),
  costo_cobro numeric(10,2),
  y character(2),
  CONSTRAINT pk_contrato_servicio PRIMARY KEY (id_cont_serv ),
  CONSTRAINT fk_contrato_relations_servicio FOREIGN KEY (id_serv)
      REFERENCES servicios (id_serv) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
)
WITH (
  OIDS=FALSE
);

CREATE OR REPLACE VIEW vista_cont_serv_temp AS 
 SELECT contrato_servicio_temp.id_cont_serv, contrato_servicio_temp.id_serv, contrato_servicio_temp.id_contrato, contrato_servicio_temp.fecha_inst, contrato_servicio_temp.cant_serv, contrato_servicio_temp.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio,  tipo_servicio.tipo_servicio,costo_cobro
   FROM contrato_servicio_temp, tipo_servicio, servicios
  WHERE contrato_servicio_temp.id_serv = servicios.id_serv  AND servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio  
  

ALTER TABLE ONLY contrato_servicio
    ADD CONSTRAINT marccontrato_servicioma UNIQUE (ID_CONTRATO,id_serv);



ALTER TABLE ONLY contrato_servicio_temp
    ADD CONSTRAINT marccontrato_dfservicioma UNIQUE (ID_CONTRATO,id_serv);





-------------------------------------------------------04/03/2015----------------------------------------------------

create table EMPRESA 
(
   ID_EMP               CHAR(8)                        not null,
   RIF_EMP              CHAR(15),
   RAZON_SOCIAL_EMP     CHAR(200),
   NOMBRE_COMERCIAL_EMP CHAR(100),
   TELEFONO_EMP         CHAR(100),
   DIRECCION_EMP        CHAR(255),
   CORREO_EMP           CHAR(100),
   INFOR_ADIC_EMP       CHAR(100),
   OBSRV_EMP            text,
   LOGO_EMP             CHAR(100),
   constraint PK_EMPRESA primary key (ID_EMP)
);


ALTER TABLE ONLY public.estado DROP CONSTRAINT fk_estado_reference_pais;

ALTER TABLE sector ADD id_franq character(5);


ALTER TABLE sector ADD id_franq character(5);


update sector set  id_franq = (select zona.id_franq from  zona, ciudad, franquicia, municipio, estado
  WHERE sector.id_zona=zona.id_zona and zona.id_ciudad = ciudad.id_ciudad AND ciudad.id_mun = municipio.id_mun AND municipio.id_esta = estado.id_esta AND estado.id_franq = franquicia.id_franq)



ALTER TABLE grupo_franq ADD desc_gf text default '';


create table VENTA_CONTRATO 
(
   ID_VENTA             CHAR(10)                       not null,
   ID_PERSONA           CHAR(10),
   ID_SERV              CHAR(8),
   COSTO_VENTA          numeric(10,2),
   FECHA_VENTA          date,
   LOGIN_VENTA          CHAR(10),
   constraint PK_VENTA_CONTRATO primary key (ID_VENTA)
);

alter table VENTA_CONTRATO
   add constraint FK_VENTA_CO_REFERENCE_VENDEDOR foreign key (ID_PERSONA)
      references VENDEDOR (ID_PERSONA)
      on update restrict
      on delete restrict;

alter table VENTA_CONTRATO
   add constraint FK_VENTA_CO_REFERENCE_SERVICIO foreign key (ID_SERV)
      references SERVICIOS (ID_SERV)
      on update restrict
      on delete restrict;




/**************************


//AQUI VA TODO EL CODIGO DE LAS VISTAS



**************************/



ALTER TABLE ONLY contrato
    ADD CONSTRAINT fk_venta_contrato FOREIGN KEY (id_venta) REFERENCES venta_contrato(id_venta) ON UPDATE RESTRICT ON DELETE RESTRICT;




-----------------------------------------------------------08/03/2015------------------------------------------------


CREATE UNIQUE INDEX index1
  ON empresa
  USING btree
  (id_emp);

CREATE INDEX index2
  ON empresa
  USING btree
  (rif_emp);

CREATE INDEX index3
  ON empresa
  USING btree
  (razon_social_emp);


ALTER TABLE ONLY empresa
    ADD CONSTRAINT empresa_rif UNIQUE (rif_emp);

ALTER TABLE ONLY empresa
    ADD CONSTRAINT empresa_razon_social UNIQUE (razon_social_emp);




CREATE UNIQUE INDEX index4
  ON grupo_franq
  USING btree
  (id_gf);

CREATE INDEX index5
  ON grupo_franq
  USING btree
  (nombre_gf);



ALTER TABLE ONLY grupo_franq
    ADD CONSTRAINT uniquenombre_gf UNIQUE (nombre_gf);

ALTER TABLE ONLY franquicia
    ADD CONSTRAINT fk_franquicia_relations_empresa FOREIGN KEY (id_emp) REFERENCES empresa(id_emp) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE ONLY franquicia
    ADD CONSTRAINT fk_franquicia_relations_grupo_franq FOREIGN KEY (id_gf) REFERENCES grupo_franq(id_gf) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE ONLY franquicia
    ADD CONSTRAINT uniquenombre_franq UNIQUE (nombre_franq);

    DROP INDEX relubi3;

update sector set id_franq='1';

ALTER TABLE ONLY sector
    ADD CONSTRAINT fk_sector_relations_franquicia FOREIGN KEY (id_franq) REFERENCES franquicia(id_franq) ON UPDATE RESTRICT ON DELETE RESTRICT;

CREATE INDEX index6
  ON sector
  USING btree
  (id_franq);

ALTER TABLE ONLY sector
    ADD CONSTRAINT uniquenombresector UNIQUE (id_zona,id_franq,nombre_sector);

update municipio set id_esta='AB000001';
delete from estado where id_esta<>'AB000001';

ALTER TABLE ONLY estado
    ADD CONSTRAINT uniquenombre_esta UNIQUE (nombre_esta);


update ciudad set id_mun='AB000001';
delete from municipio where id_mun<>'AB000001';

ALTER TABLE ONLY municipio
    ADD CONSTRAINT uniquenombre_mun UNIQUE (id_esta,nombre_mun);


update zona set id_ciudad='AB000001';
delete from ciudad where id_ciudad<>'AB000001';

ALTER TABLE ONLY ciudad
    ADD CONSTRAINT uniquenombre_ciudad UNIQUE (id_mun,nombre_ciudad);

update sector set id_zona='AB000001';
delete from zona where id_zona<>'AB000001';
ALTER TABLE ONLY zona
    ADD CONSTRAINT uniquenombre_zona UNIQUE (id_ciudad,nombre_zona);

    update sector set nombre_sector= nro_sector || nombre_sector;
update sector set id_zona='XH00001';
delete from zona where id_zona<>'XH00001';
ALTER TABLE ONLY zona
    ADD CONSTRAINT uniquenombre_zona UNIQUE (id_ciudad,nombre_zona);


update contrato set id_calle='AB00000001';

delete from calle where id_calle<>'AB00000001';
ALTER TABLE ONLY calle
    ADD CONSTRAINT uniquenombre_calle UNIQUE (id_sector,nombre_calle);

ALTER TABLE ONLY edificio
    ADD CONSTRAINT uniquenedificio UNIQUE (id_sector,edificio);

ALTER TABLE ONLY edificio
    ADD CONSTRAINT uniquenedificio UNIQUE (id_sector,edificio);


CREATE  INDEX index7
  ON edificio
  USING btree
  (edificio);

CREATE  INDEX index8
  ON urbanizacion
  USING btree
  (nombre_urb);


ALTER TABLE ONLY urbanizacion
    ADD CONSTRAINT uniquenenombre_urb UNIQUE (id_sector,nombre_urb);


ALTER TABLE ONLY statuscont
    ADD CONSTRAINT uniquenombrestatus UNIQUE (nombrestatus);


CREATE UNIQUE INDEX index9
  ON statuscont
  USING btree
  (status_contrato);

CREATE INDEX index10
  ON statuscont
  USING btree
  (nombrestatus);

CREATE INDEX index11
  ON grupo_afinidad
  USING btree
  (nombre_g_a);

ALTER TABLE ONLY grupo_afinidad
    ADD CONSTRAINT uniquenombre_g_a UNIQUE (nombre_g_a);

ALTER TABLE ONLY persona
    ADD CONSTRAINT uniquecedula UNIQUE (cedula);


CREATE UNIQUE INDEX index12
  ON venta_contrato
  USING btree
  (id_venta);

CREATE INDEX index13
  ON venta_contrato
  USING btree
  (id_persona);

CREATE INDEX index14
  ON venta_contrato
  USING btree
  (id_serv);


update contrato set id_venta='AB00000001';
ALTER TABLE ONLY contrato
    ADD CONSTRAINT fk_contrato_relations_venta FOREIGN KEY (id_venta) REFERENCES venta_contrato(id_venta) ON UPDATE RESTRICT ON DELETE RESTRICT;

update contrato set status_contrato='ACTIVO' WHERE status_contrato<>'ACTIVO';

ALTER TABLE ONLY contrato
    ADD CONSTRAINT fk_contrato_relations_status FOREIGN KEY (status_contrato) REFERENCES statuscont(status_contrato) ON UPDATE RESTRICT ON DELETE RESTRICT;

update contrato set nro_contrato=num , contrato_fisico=num, etiqueta=num;

ALTER TABLE ONLY contrato
    ADD CONSTRAINT uniquenro_contrato UNIQUE (nro_contrato);

ALTER TABLE ONLY contrato
    ADD CONSTRAINT uniqueetiqueta UNIQUE (etiqueta);

ALTER TABLE ONLY contrato
    ADD CONSTRAINT uniquecontrato_fisico UNIQUE (contrato_fisico);



CREATE OR REPLACE VIEW vista_calle1 AS 
 SELECT calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, ciudad.status_ciudad, municipio.id_esta, municipio.nombre_mun, sector.id_franq, estado.nombre_esta, franquicia.nombre_franq, calle.nro_calle
   FROM calle
   JOIN sector ON calle.id_sector = sector.id_sector
   JOIN zona ON sector.id_zona = zona.id_zona
   JOIN ciudad ON zona.id_ciudad = ciudad.id_ciudad
   JOIN municipio ON ciudad.id_mun = municipio.id_mun
   JOIN estado ON municipio.id_esta = estado.id_esta
   JOIN franquicia ON sector.id_franq = franquicia.id_franq
  ORDER BY zona.nombre_zona;

------16/03/2015-----



ALTER TABLE ONLY serv_sist_equipo
    ADD CONSTRAINT detalle_tirv_sist_equiey PRIMARY KEY (id_es,id_serv_sist);
  


CREATE OR REPLACE VIEW vista_servicios AS 
 SELECT servicios.id_serv, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, tipo_servicio.tipo_servicio, tipo_servicio.status_servicio, servicios.tipo_costo, servicios.tipo_paq, servicios.tarifa_esp, servicios.tipo_serv, servicios.id_cant, cant_tv.cantidad, paquete.id_paq, paquete.nombre_paq, tarifa_servicio.tarifa_ser,tarifa_servicio.id_tar_ser,tarifa_servicio.fecha_tar_ser
   FROM servicios
   JOIN tipo_servicio ON servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio
   LEFT JOIN cant_tv ON servicios.id_cant = cant_tv.id_cant
   LEFT JOIN paquete ON servicios.id_paq = paquete.id_paq
   LEFT JOIN tarifa_servicio ON servicios.id_serv = tarifa_servicio.id_serv AND tarifa_servicio.status_tarifa_ser = 'ACTIVO'::bpchar;


CREATE OR REPLACE VIEW vista_tarifa AS 
 SELECT tarifa_servicio.id_tar_ser, tarifa_servicio.id_serv, tarifa_servicio.fecha_tar_ser, tarifa_servicio.hora_tar_ser, tarifa_servicio.obser_tarifa_ser, tarifa_servicio.status_tarifa_ser, tarifa_servicio.tarifa_ser, vista_servicios.id_tipo_servicio, vista_servicios.nombre_servicio, vista_servicios.status_serv, vista_servicios.tipo_servicio, vista_servicios.status_servicio, vista_servicios.tipo_costo, vista_servicios.tarifa_esp, vista_servicios.tipo_serv
   FROM tarifa_servicio, vista_servicios
  WHERE tarifa_servicio.id_serv = vista_servicios.id_serv;




------17/03/2015-----

ALTER TABLE contrato_servicio ADD obser character(30);
ALTER TABLE contrato_servicio ADD login character(25);
ALTER TABLE contrato_servicio ADD fecha timestamp with time zone default now();





-----------------------------------18/03/2015------------------------------------

CREATE TABLE cargar_deuda
(
  id_cd character varying(10) NOT NULL,
  id_serv character varying(8),
  id_contrato character varying(10),
  cantidad integer,
  costo numeric(10,2),
  CONSTRAINT pk_cargar_deuda PRIMARY KEY (id_cd),
  CONSTRAINT fk_concargar_deuda FOREIGN KEY (id_serv)
      REFERENCES servicios (id_serv) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT fk_concontrato FOREIGN KEY (id_contrato)
      REFERENCES contrato (id_contrato) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT servicios_id_tipo_serdvicio_nombre_servicio_key UNIQUE (id_serv, id_contrato)
)
WITH (
  OIDS=FALSE
);



-----------------------------------24/03/2015------------------------------------
DROP view vista_tipopago_temp;
DROP TABLE detalle_tipopago_temp;
CREATE TABLE detalle_tipopago_temp
(
  id_tp character varying(8) NOT NULL,
  id_tipo_pago character varying(8),
  id_pago character varying(15),
  id_banco character varying(5),
  refer_tp character varying(25),
  monto_tp numeric(10,2),
  lote_tp character varying(25),
  CONSTRAINT detalle_tipopfatgo_pkey PRIMARY KEY (id_tp),
  CONSTRAINT fk_detallte__relations_tipo_pag FOREIGN KEY (id_tipo_pago)
      REFERENCES tipo_pago (id_tipo_pago) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT uniquetpt UNIQUE (id_tipo_pago, id_pago, id_banco, refer_tp)
)
WITH (
  OIDS=FALSE
);


DROP view vista_tipopago;
DROP TABLE detalle_tipopago;

CREATE TABLE detalle_tipopago
(
  id_tp character varying(8) NOT NULL,
  id_tipo_pago character varying(8),
  id_pago character varying(15),
  id_banco character varying(5),
  refer_tp character varying(25),
  monto_tp numeric(10,2),
  lote_tp character varying(25),
  CONSTRAINT detalle_tipopfago_pkey PRIMARY KEY (id_tp),
  CONSTRAINT detalle_tipopago_id_pago_fkey FOREIGN KEY (id_pago)
      REFERENCES pagos (id_pago) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_detalle__relations_tipo_pag FOREIGN KEY (id_tipo_pago)
      REFERENCES tipo_pago (id_tipo_pago) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT uniquetp UNIQUE (id_tipo_pago, id_pago, id_banco, refer_tp)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE detalle_tipopago
  OWNER TO postgres;

-- Index: relationship_12_fk

-- DROP INDEX relationship_12_fk;

CREATE INDEX relationship_12_fk
  ON detalle_tipopago
  USING btree
  (id_tipo_pago COLLATE pg_catalog."default");

-- Index: relationship_13_fk

-- DROP INDEX relationship_13_fk;

CREATE INDEX relationship_13_fk
  ON detalle_tipopago
  USING btree
  (id_pago COLLATE pg_catalog."default");

CREATE INDEX relationship_13_fkdd
  ON detalle_tipopago
  USING btree
  (id_banco);




CREATE OR REPLACE VIEW vista_tipopago AS 
 SELECT detalle_tipopago.id_tp,detalle_tipopago.id_tipo_pago, detalle_tipopago.id_pago, detalle_tipopago.id_banco, detalle_tipopago.refer_tp, detalle_tipopago.monto_tp, banco.banco, detalle_tipopago.lote_tp, pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, pagos.obser_pago, pagos.status_pago, pagos.nro_factura, tipo_pago.tipo_pago, caja.tipo_caja, pagos.id_contrato, caja.id_franq, caja_cobrador.id_est, pagos.impresion
   FROM detalle_tipopago
   join pagos ON detalle_tipopago.id_pago = pagos.id_pago
   JOIN caja_cobrador ON pagos.id_caja_cob = caja_cobrador.id_caja_cob
   JOIN caja ON caja_cobrador.id_caja = caja.id_caja
   left JOIN tipo_pago ON detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago
   left JOIN banco ON banco.id_banco=detalle_tipopago.id_banco;


CREATE OR REPLACE VIEW vista_tipopago_temp AS 
 SELECT detalle_tipopago_temp.id_tp,detalle_tipopago_temp.id_tipo_pago, detalle_tipopago_temp.id_pago, detalle_tipopago_temp.id_banco, detalle_tipopago_temp.refer_tp, detalle_tipopago_temp.monto_tp, banco.banco, detalle_tipopago_temp.lote_tp, tipo_pago.tipo_pago
   FROM detalle_tipopago_temp
   LEFT JOIN tipo_pago ON detalle_tipopago_temp.id_tipo_pago::text = tipo_pago.id_tipo_pago::text
   LEFT JOIN banco ON banco.id_banco::text = detalle_tipopago_temp.id_banco::text;





-----------------------------------24/03/2015------------------------------------





CREATE OR REPLACE VIEW vista_contrato_servicio_deuda AS 
 SELECT id_cont_serv, id_serv, id_contrato, fecha_inst, cant_serv, status_con_ser,costo_cobro,descu, contrato_servicio_deuda.inc, apagar, pagos.id_pago, contrato_servicio_deuda.pagado
   FROM contrato_servicio_deuda
   left join pagos ON contrato_servicio_deuda.id_pago = pagos.id_pago



   


-----------------------------------25/03/2015------------------------------------



CREATE OR REPLACE VIEW vista_pago_ser AS 
 SELECT pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, contrato_servicio_deuda.cant_serv, pago_factura.costo_cobro_serv AS costo_cobro, contrato_servicio_deuda.id_serv, pagos.status_pago, caja.tipo_caja, pagos.id_pago, contrato_servicio_deuda.fecha_inst, servicios.nombre_servicio, caja.id_franq, caja_cobrador.id_est, contrato_servicio_deuda.descu, pagos.nro_factura, pagos.id_contrato, caja_cobrador.id_persona, pagos.obser_pago, servicios.tipo_serv, contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.costo_cobro AS costo_cobro_fact,status_con_ser,tipo_doc,pagado
   FROM pago_factura, pagos, contrato_servicio_deuda, caja_cobrador, caja, servicios
  WHERE pagos.id_pago::text = pago_factura.id_pago::text AND pago_factura.id_cont_serv::text = contrato_servicio_deuda.id_cont_serv::text AND pagos.id_caja_cob::text = caja_cobrador.id_caja_cob::text AND caja_cobrador.id_caja::text = caja.id_caja::text AND contrato_servicio_deuda.id_serv::text = servicios.id_serv::text;

CREATE OR REPLACE VIEW vista_contrato_servicio_deuda AS 
 SELECT id_cont_serv, id_serv, id_contrato, fecha_inst, cant_serv, status_con_ser,costo_cobro,descu, contrato_servicio_deuda.inc, apagar, pagos.id_pago, contrato_servicio_deuda.pagado
   FROM contrato_servicio_deuda
   left join pagos ON contrato_servicio_deuda.id_pago = pagos.id_pago

CREATE OR REPLACE VIEW vista_tipopago AS 
 SELECT detalle_tipopago.id_tp, detalle_tipopago.id_tipo_pago, detalle_tipopago.id_pago, detalle_tipopago.id_banco, detalle_tipopago.refer_tp, detalle_tipopago.monto_tp, banco.banco, detalle_tipopago.lote_tp, pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, pagos.obser_pago, pagos.status_pago, pagos.nro_factura, tipo_pago.tipo_pago, caja.tipo_caja, pagos.id_contrato, caja.id_franq, caja_cobrador.id_est, pagos.impresion,tipo_doc
   FROM detalle_tipopago
   JOIN pagos ON detalle_tipopago.id_pago::text = pagos.id_pago::text
   JOIN caja_cobrador ON pagos.id_caja_cob::text = caja_cobrador.id_caja_cob::text
   JOIN caja ON caja_cobrador.id_caja::text = caja.id_caja::text
   LEFT JOIN tipo_pago ON detalle_tipopago.id_tipo_pago::text = tipo_pago.id_tipo_pago::text
   LEFT JOIN banco ON banco.id_banco::text = detalle_tipopago.id_banco::text;





-----------------------------------26/03/2015------------------------------------



CREATE OR REPLACE VIEW vista_contrato_servicio_deuda AS 
 SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, pagos.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, contrato_servicio_deuda.costo_cobro, contrato_servicio_deuda.descu, contrato_servicio_deuda.inc, contrato_servicio_deuda.apagar, pagos.id_pago, contrato_servicio_deuda.pagado
   FROM contrato_servicio_deuda
   JOIN pagos ON contrato_servicio_deuda.id_pago::text = pagos.id_pago::text;



ALTER TABLE pagos ADD n_debito character varying(12) default '';





-----------------------------------28/03/2015------------------------------------



CREATE OR REPLACE VIEW contrato_servicio_pagado AS 
 SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, pagos.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.status_con_ser, pago_factura.costo_cobro_serv AS costo_cobro
   FROM pago_factura
   join contrato_servicio_deuda on pago_factura.id_cont_serv::text = contrato_servicio_deuda.id_cont_serv::text
   join pagos on pago_factura.id_pago::text = pagos.id_pago::text;



CREATE OR REPLACE VIEW vista_asignarecibo AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, asigna_recibo.id_asig, asigna_recibo.id_cobrador, asigna_recibo.fecha_asig, asigna_recibo.obser_asig, asigna_recibo.login_asig, asigna_recibo.desde, asigna_recibo.hasta, asigna_recibo.cantidad, asigna_recibo.tipo
   FROM persona
   join asigna_recibo on persona.id_persona::text = asigna_recibo.id_cobrador::text;


CREATE OR REPLACE VIEW vista_caja AS 
 SELECT caja_cobrador.id_caja_cob, caja_cobrador.id_caja, caja_cobrador.id_persona, caja_cobrador.fecha_caja, caja_cobrador.apertura_caja, caja_cobrador.cierre_caja, caja_cobrador.monto_acum, caja_cobrador.status_caja AS status_caja_cob, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cobrador.nro_cobrador, cobrador.direccion_cob, caja.nombre_caja, caja.descripcion_caja, caja.status_caja, caja.inicial, caja.tipo_caja, caja.id_franq, caja.caja_externa, caja_cobrador.id_est, caja_cobrador.fecha_sugerida, estacion_trabajo.nombre_est
   FROM caja
   join caja_cobrador on caja_cobrador.id_caja::text = caja.id_caja::text
   join persona on caja_cobrador.id_persona::text = persona.id_persona::text
   join cobrador on cobrador.id_persona::text = persona.id_persona::text
   join estacion_trabajo on caja_cobrador.id_est::text = estacion_trabajo.id_est::text;


CREATE OR REPLACE VIEW vista_cobrador AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cobrador.nro_cobrador, cobrador.direccion_cob, cobrador.codcob, franquicia.id_franq, franquicia.nombre_franq
   FROM cobrador
    join persona on persona.id_persona::text = cobrador.id_persona::text
    join franquicia on franquicia.id_franq::text = cobrador.id_franq::text
  ORDER BY persona.cedula;



CREATE OR REPLACE VIEW vista_cliente AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.email, cliente.telf_adic, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac
   FROM persona
   JOIN cliente ON persona.id_persona::text = cliente.id_persona::text
  ORDER BY persona.cedula;


drop view vista_comentario;
DROP TABLE comentario_cliente;


CREATE OR REPLACE VIEW vista_comisiones AS 
 SELECT pago_comisiones.id_comi, pago_comisiones.id_persona, pago_comisiones.comi_para, pago_comisiones.fecha_comi, pago_comisiones.fecha_desde, pago_comisiones.fecha_hasta, pago_comisiones.porcent_aplic, pago_comisiones.monto_comi, pago_comisiones.status_comi, persona.cedula, persona.nombre, persona.apellido, persona.telefono
   FROM persona
   JOIN  pago_comisiones ON pago_comisiones.id_persona::text = persona.id_persona::text;


CREATE OR REPLACE VIEW vista_confcomision AS 
 SELECT franquicia.id_franq, franquicia.nombre_franq, franquicia.id_emp, franquicia.id_gf, franquicia.obser_franq, franquicia.direccion_franq, franquicia.serie, conf_comision.id_confc, conf_comision.fecha_confc, conf_comision.status_confc, conf_comision.porc_acord, conf_comision.porc_com_reca, conf_comision.porc_com_venta, conf_comision.porc_ret_iva, conf_comision.porc_ret_islr, conf_comision.descuento_conf, conf_comision.tipo_e_p, conf_comision.empresa_confc, conf_comision.rif_empresa, conf_comision.represen_confc, conf_comision.cedula_rep, conf_comision.desc_confc
   FROM franquicia
   JOIN conf_comision on franquicia.id_franq::text = conf_comision.id_franq::text
  ORDER BY franquicia.nombre_franq;



CREATE OR REPLACE VIEW vista_cont_serv AS 
 SELECT contrato_servicio.id_cont_serv, contrato_servicio.id_serv, contrato_servicio.id_contrato, contrato_servicio.fecha_inst, contrato_servicio.cant_serv, contrato_servicio.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, tipo_servicio.tipo_servicio, contrato_servicio.costo_cobro, servicios.tipo_paq
   FROM contrato_servicio
   JOIN servicios on contrato_servicio.id_serv::text = servicios.id_serv::text 
JOIN tipo_servicio on servicios.id_tipo_servicio::text = tipo_servicio.id_tipo_servicio::text;
   

CREATE OR REPLACE VIEW vista_cont_serv_temp AS 
 SELECT contrato_servicio_temp.id_cont_serv, contrato_servicio_temp.id_serv, contrato_servicio_temp.id_contrato, contrato_servicio_temp.fecha_inst, contrato_servicio_temp.cant_serv, contrato_servicio_temp.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, tipo_servicio.tipo_servicio, contrato_servicio_temp.costo_cobro, servicios.tipo_paq
   FROM contrato_servicio_temp
   JOIN servicios on contrato_servicio_temp.id_serv::text = servicios.id_serv::text
   JOIN tipo_servicio on servicios.id_tipo_servicio::text = tipo_servicio.id_tipo_servicio::text;


CREATE OR REPLACE VIEW vista_contrato AS 
 SELECT contrato.id_contrato, contrato.id_calle, contrato.id_venta, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.observacion, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.email, contrato.direc_adicional, contrato.numero_casa, calle.id_sector, calle.nro_calle, calle.nombre_calle, sector.id_zona, sector.nro_sector, sector.nombre_sector, franquicia.id_franq, zona.nro_zona, zona.nombre_zona, franquicia.nombre_franq, franquicia.id_emp, franquicia.id_gf, franquicia.obser_franq, franquicia.direccion_franq, contrato.id_edif, contrato.numero_piso, cliente.telf_adic, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac, contrato.deuda, contrato.postel, contrato.taps, contrato.pto, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, contrato.id_urb, zona.id_ciudad, contrato.cod_id_persona, contrato.contrato_fisico, contrato.etiqueta_n, contrato.tipo_fact, contrato.contrato_imp, contrato.ultima_act
   FROM contrato
   JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN calle ON contrato.id_calle::text = calle.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
   JOIN franquicia ON sector.id_franq::text = franquicia.id_franq::text
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text
   JOIN grupo_afinidad ON contrato.id_g_a::text = grupo_afinidad.id_g_a::text;
  



CREATE OR REPLACE VIEW vista_contrato_dir AS 
 SELECT contrato.id_contrato, calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, sector.id_franq, estado.nombre_esta, franquicia.nombre_franq
   FROM contrato
  JOIN calle ON contrato.id_calle::text = calle.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
   JOIN franquicia ON sector.id_franq::text = franquicia.id_franq::text
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text;

DROP VIEW vista_contrato_servicio_deuda;


CREATE OR REPLACE VIEW vista_contrato_status AS 
 SELECT contrato.id_contrato, contrato.*::contrato AS contrato, contrato.status_contrato, calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, sector.id_franq, estado.nombre_esta, franquicia.nombre_franq
   FROM contrato
 JOIN calle ON contrato.id_calle::text = calle.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
   JOIN franquicia ON sector.id_franq::text = franquicia.id_franq::text
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text;



CREATE OR REPLACE VIEW vista_contrato_todo AS 
 SELECT contrato.id_contrato, contrato.id_calle, contrato.id_venta, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.observacion, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.email, contrato.direc_adicional, contrato.numero_casa, calle.id_sector, calle.nro_calle, calle.nombre_calle, sector.id_zona, sector.nro_sector, sector.nombre_sector, franquicia.id_franq, zona.nro_zona, zona.nombre_zona, franquicia.nombre_franq, franquicia.id_emp, franquicia.id_gf, franquicia.obser_franq, franquicia.direccion_franq, contrato.id_edif, contrato.numero_piso, cliente.telf_adic, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac, contrato.deuda, contrato.postel, contrato.taps, contrato.pto, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, contrato.id_urb, zona.id_ciudad, contrato.cod_id_persona
  FROM contrato
   JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN calle ON contrato.id_calle::text = calle.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
   JOIN franquicia ON sector.id_franq::text = franquicia.id_franq::text
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text
   JOIN grupo_afinidad ON contrato.id_g_a::text = grupo_afinidad.id_g_a::text;


CREATE OR REPLACE VIEW vista_contratodeu AS 
 SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, pagos.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, tipo_servicio.tipo_servicio, tipo_servicio.status_servicio, contrato.costo_dif_men, contrato.nro_contrato, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, servicios.tipo_costo, contrato_servicio_deuda.costo_cobro, contrato.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, zona.nombre_zona, contrato.status_contrato, contrato_servicio_deuda.descu, contrato_servicio_deuda.inc, servicios.tipo_serv
   FROM pagos
   JOIN contrato_servicio_deuda ON pagos.id_pago::text = contrato_servicio_deuda.id_pago::text
   JOIN servicios ON contrato_servicio_deuda.id_serv::text = servicios.id_serv::text
   JOIN tipo_servicio ON servicios.id_tipo_servicio::text = tipo_servicio.id_tipo_servicio::text
   JOIN contrato ON pagos.id_contrato::text = contrato.id_contrato::text
   JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
   JOIN persona ON cliente.id_persona::text = persona.id_persona::text
   JOIN calle ON contrato.id_calle::text = calle.id_calle::text 
   JOIN sector ON  calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
  ORDER BY contrato_servicio_deuda.id_cont_serv;


DROP VIEW vista_contratodeu1;
DROP VIEW vista_contratodeu_f;
DROP VIEW vista_contratorec;


CREATE OR REPLACE VIEW vista_contratoser AS 
 SELECT contrato_servicio.id_cont_serv, contrato_servicio.id_serv, contrato_servicio.id_contrato, contrato_servicio.fecha_inst, contrato_servicio.cant_serv, contrato_servicio.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, tipo_servicio.tipo_servicio, tipo_servicio.status_servicio, tarifa_servicio.id_tar_ser, tarifa_servicio.fecha_tar_ser, tarifa_servicio.status_tarifa_ser, tarifa_servicio.tarifa_ser, contrato.costo_dif_men, contrato.nro_contrato, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, servicios.tipo_costo, contrato_servicio.costo_cobro, contrato.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, zona.nombre_zona, contrato.status_contrato
   FROM contrato_servicio
   JOIN servicios ON contrato_servicio.id_serv::text = servicios.id_serv::text 
   LEFT JOIN tarifa_servicio ON tarifa_servicio.id_serv::text = servicios.id_serv::text AND tarifa_servicio.status_tarifa_ser::bpchar = 'ACTIVO'::bpchar
   JOIN tipo_servicio ON servicios.id_tipo_servicio::text = tipo_servicio.id_tipo_servicio::text
   JOIN contrato ON contrato_servicio.id_contrato::text = contrato.id_contrato::text
   JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text 
   JOIN calle ON contrato.id_calle::text = calle.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
  ORDER BY contrato_servicio.id_cont_serv;


CREATE OR REPLACE VIEW vista_detalleorden AS 
 SELECT detalle_orden.id_det_orden, detalle_orden.id_tipo_orden, detalle_orden.nombre_det_orden, tipo_orden.nombre_tipo_orden, detalle_orden.tipo_detalle, tipo_orden.status_tipord
   FROM detalle_orden
   JOIN  tipo_orden ON detalle_orden.id_tipo_orden::text = tipo_orden.id_tipo_orden::text;


drop view personausuario;
CREATE OR REPLACE VIEW personausuario AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, usuario.login, usuario.codigoperfil, usuario.password, usuario.statususuario, perfil.nombreperfil, perfil.descripcionperfil, perfil.statusperfil, usuario.id_franq, franquicia.nombre_franq, servidor.nombre_servidor
   FROM persona
   JOIN usuario ON persona.id_persona::text = usuario.id_persona::text
   JOIN perfil ON usuario.codigoperfil::text = perfil.codigoperfil::text
   left join franquicia ON franquicia.id_franq::text = usuario.id_franq::text
   left join servidor ON servidor.id_servidor::text = usuario.id_servidor::text;
  


CREATE OR REPLACE VIEW vista_deudacli AS 
 SELECT contrato.id_contrato, calle.id_calle, calle.id_sector, sector.id_zona, contrato.status_contrato, 

 ( SELECT sum(contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) AS sum
           FROM contrato_servicio_deuda, pagos
          WHERE pagos.id_pago::text = contrato_servicio_deuda.id_pago::text AND pagos.id_contrato::text = contrato.id_contrato::text AND contrato_servicio_deuda.status_con_ser::bpchar = 'DEUDA'::bpchar) AS deuda,
 ( SELECT sum(contrato_servicio_deuda.pagado) AS sum
           FROM contrato_servicio_deuda, pagos
          WHERE pagos.id_pago::text = contrato_servicio_deuda.id_pago::text AND pagos.id_contrato::text = contrato.id_contrato::text AND contrato_servicio_deuda.status_con_ser::bpchar = 'PAGADO'::bpchar) AS pagado
   FROM calle, contrato, sector
  WHERE calle.id_calle::text = contrato.id_calle::text AND calle.id_sector::text = sector.id_sector::text
  ORDER BY contrato.id_contrato;


ALTER TABLE contrato rename column deuda to saldo;


CREATE OR REPLACE FUNCTION update_saldo(text)
  RETURNS numeric AS
$BODY$
DECLARE
id_cont ALIAS FOR $1;
resultado NUMERIC;
r_fact NUMERIC;
r_pago NUMERIC;
fact record;
pago record;

BEGIN

 FOR fact IN (SELECT sum(monto_pago) as monto_f, count(*) as cant_f FROM pagos where id_contrato= id_cont and (tipo_doc='AVISO' OR tipo_doc='FACTURA' OR tipo_doc='NOTA DEBITO') ) LOOP
  IF (fact.cant_f > 0) THEN
    r_fact=fact.monto_f;
  ELSE
    r_fact=0;
  END IF;
 END LOOP;

 FOR pago IN (SELECT sum(monto_pago) as monto_p, count(*) as cant_p FROM pagos where id_contrato= id_cont and (tipo_doc='PAGOS' OR tipo_doc='NOTA CREDITO') ) LOOP
  IF (pago.cant_p>0) THEN
    r_pago=pago.monto_p;
  ELSE
    r_pago=0;
  END IF;
 END LOOP;
 
resultado= (r_fact - r_pago);

UPDATE CONTRATO SET saldo = resultado WHERE id_contrato= id_cont;

RETURN resultado;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION update_saldo(text)
  OWNER TO postgres;



CREATE OR REPLACE FUNCTION update_saldo()
  RETURNS trigger AS
$BODY$
DECLARE

BEGIN
  select update_saldo(NEW.id_contrato);
RETURN new;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION update_saldo()
  OWNER TO postgres;


CREATE TRIGGER trigger_pagos_saldo
  AFTER INSERT OR UPDATE OR DELETE
  ON pagos
  FOR EACH ROW
  EXECUTE PROCEDURE update_saldo();





CREATE OR REPLACE VIEW vista_entidad AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, entidad.id_te, entidad.descrip_ent, entidad.status_ent, tipo_entidad.nombre_te, tipo_entidad.status_te
   FROM persona
   join entidad on persona.id_persona::text = entidad.id_persona::text
   join tipo_entidad on entidad.id_te::text = tipo_entidad.id_te::text
  ORDER BY persona.cedula;



CREATE OR REPLACE VIEW vista_gerentes AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, gerentes_permitidos.nro_gerente, gerentes_permitidos.tipo_gerente, gerentes_permitidos.cargo_gerente, gerentes_permitidos.descrip_gerente, gerentes_permitidos.sattus_gerente, gerentes_permitidos.correo_gerente, gerentes_permitidos.id_franq
   FROM persona
   join gerentes_permitidos on persona.id_persona::text = gerentes_permitidos.id_persona::text
  ORDER BY persona.cedula;


CREATE OR REPLACE VIEW vista_grupotecnico AS 
 SELECT tecnico.id_persona, grupo_tecnico.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.nombre_grupo, grupo_trabajo.status_grupo, persona.cedula, persona.nombre, persona.apellido
   FROM tecnico
   join  grupo_tecnico on tecnico.id_persona::text = grupo_tecnico.id_persona::text
   join  grupo_trabajo on grupo_tecnico.id_gt::text = grupo_trabajo.id_gt::text
   join  persona on tecnico.id_persona::text = persona.id_persona::text ;


CREATE OR REPLACE VIEW vista_grupoubicacion AS 
 SELECT sector.id_sector, sector.id_zona, sector.nro_sector, sector.nombre_sector, sector.n_sector, sector.afiliacion, sector.id_franq, zona.nro_zona, zona.nombre_zona, zona.n_zona, grupo_trabajo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.hora_creacion, grupo_trabajo.nombre_grupo, grupo_trabajo.status_grupo
   FROM sector
   join zona on sector.id_zona::text = zona.id_zona::text
   join grupo_ubicacion on sector.id_sector::text = grupo_ubicacion.id_sector::text
   join grupo_trabajo on grupo_trabajo.id_gt::text = grupo_ubicacion.id_gt::text
  ORDER BY sector.nombre_sector;

DROP VIEW vista_orden;
DROP VIEW vista_orden;

CREATE OR REPLACE VIEW vista_orden AS 
 SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, contrato.status_contrato, orden_grupo.id_gt, grupo_trabajo.nombre_grupo,
          ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, ordenes_tecnicos.login AS login_emi, ordenes_tecnicos.hora AS hora_emi, ordenes_tecnicos.login_imp, ordenes_tecnicos.hora_imp, ordenes_tecnicos.login_fin, ordenes_tecnicos.hora_fin, contrato.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, estado.id_esta, municipio.nombre_mun, franquicia.id_franq, zona.nombre_zona, franquicia.nombre_franq, estado.nombre_esta, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, contrato.contrato_fisico, contrato.postel
   FROM ordenes_tecnicos
   JOIN detalle_orden ON detalle_orden.id_det_orden::text = ordenes_tecnicos.id_det_orden::text
   JOIN contrato ON ordenes_tecnicos.id_contrato::text = contrato.id_contrato::text
   JOIN tipo_orden ON tipo_orden.id_tipo_orden::text = detalle_orden.id_tipo_orden::text
   JOIN grupo_afinidad ON grupo_afinidad.id_g_a::text = contrato.id_g_a::text
   JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN calle ON contrato.id_calle::text = calle.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text
   JOIN franquicia ON sector.id_franq::text = franquicia.id_franq::text
   left join orden_grupo ON ordenes_tecnicos.id_orden::text = orden_grupo.id_orden::text
   left join grupo_trabajo ON orden_grupo.id_gt::text = grupo_trabajo.id_gt::text;










CREATE OR REPLACE VIEW vista_gt_tec_per AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, tecnico.num_tecnico, tecnico.direccion_tec, tecnico.correo_tec, tecnico.status_tec, grupo_trabajo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.hora_creacion, grupo_trabajo.id_zona, grupo_trabajo.nombre_grupo
   FROM persona
   JOIN tecnico ON persona.id_persona::text = tecnico.id_persona::text
   JOIN grupo_tecnico ON tecnico.id_persona::text = grupo_tecnico.id_persona::text
   JOIN grupo_trabajo ON grupo_trabajo.id_gt::text = grupo_tecnico.id_gt::text
  ORDER BY persona.nombre;


CREATE OR REPLACE VIEW vista_llamadas AS 
 SELECT tipo_llamada.dato, tipo_llamada.id_tll, tipo_llamada.nombre_tll, tipo_llamada.status_tll, llamadas.id_lla, llamadas.id_drl, llamadas.id_contrato, llamadas.fecha_lla, llamadas.hora_lla, llamadas.login, llamadas.obser_lla, llamadas.crea_alarma, detalle_resp.id_trl, detalle_resp.nombre_drl, detalle_resp.status_drl, tipo_resp.nombre_trl, tipo_resp.status_trl, vista_contrato_auditoria.id_venta, vista_contrato_auditoria.cli_id_persona, vista_contrato_auditoria.nro_contrato, vista_contrato_auditoria.fecha_contrato, vista_contrato_auditoria.etiqueta, vista_contrato_auditoria.costo_dif_men, vista_contrato_auditoria.status_contrato, vista_contrato_auditoria.cedula, vista_contrato_auditoria.nombre, vista_contrato_auditoria.apellido, vista_contrato_auditoria.telefono, vista_contrato_auditoria.telf_casa, vista_contrato_auditoria.telf_adic, vista_contrato_auditoria.direc_adicional, vista_contrato_auditoria.numero_casa, vista_contrato_auditoria.id_edif, vista_contrato_auditoria.numero_piso, vista_contrato_auditoria.id_urb, vista_contrato_auditoria.id_g_a, vista_contrato_auditoria.nombre_g_a, vista_contrato_auditoria.id_calle, vista_contrato_auditoria.nombre_calle, vista_contrato_auditoria.id_sector, vista_contrato_auditoria.nombre_sector, vista_contrato_auditoria.id_zona, vista_contrato_auditoria.nombre_zona, vista_contrato_auditoria.id_ciudad, vista_contrato_auditoria.id_mun, vista_contrato_auditoria.nombre_ciudad, vista_contrato_auditoria.id_esta, vista_contrato_auditoria.nombre_mun, vista_contrato_auditoria.id_franq, vista_contrato_auditoria.nombre_esta, vista_contrato_auditoria.nombre_franq, vista_contrato_auditoria.postel, vista_contrato_auditoria.pto, vista_contrato_auditoria.cod_id_persona, vista_contrato_auditoria.cobrador, vista_contrato_auditoria.etiqueta_n, vista_contrato_auditoria.taps, vista_contrato_auditoria.tipo_fact
   FROM tipo_llamada
   JOIN llamadas ON tipo_llamada.id_tll::text = llamadas.id_tll::text
   JOIN detalle_resp ON llamadas.id_drl::text = detalle_resp.id_drl::text
   JOIN tipo_resp ON detalle_resp.id_trl::text = tipo_resp.id_trl::text
   JOIN vista_contrato_auditoria ON llamadas.id_contrato::text = vista_contrato_auditoria.id_contrato::text
  ORDER BY llamadas.fecha_lla DESC, llamadas.hora_lla DESC;



CREATE OR REPLACE VIEW vista_notas AS 
 SELECT notas.id_nota, notas.login, notas.id_cont_serv, notas.tipo, notas.dir_ip, notas.fecha, notas.hora, notas.monto_anterior, notas.monto_posterior, notas.idmotivonota, notas.comentario, notas.status, notas.generado_por, motivonotas.nombremotivonota, contrato.id_contrato, contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, contrato.status_contrato, vista_ubica.id_sector, vista_ubica.nombre_calle, persona.id_persona, persona.cedula, persona.nombre, persona.apellido, vista_ubica.id_zona, vista_ubica.nombre_sector, vista_ubica.id_franq, vista_ubica.nombre_zona, vista_ubica.nombre_franq, vista_ubica.nombre_ciudad, notas.login_aut, notas.servicio, notas.fecha_inst, notas.nro_nota, notas.monto_nota
   FROM notas
    JOIN motivonotas ON notas.idmotivonota::text = motivonotas.idmotivonota::text
    JOIN contrato ON contrato.id_contrato::text = notas.id_contrato::text
    JOIN cliente ON cliente.id_persona::text = contrato.cli_id_persona::text
    JOIN persona ON persona.id_persona::text = cliente.id_persona::text
    JOIN vista_ubica ON contrato.id_calle::text = vista_ubica.id_calle::text
  ORDER BY notas.id_nota;



CREATE OR REPLACE VIEW vista_ordengrupo AS 
 SELECT detalle_orden.id_det_orden, detalle_orden.id_tipo_orden, ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_final, ordenes_tecnicos.status_orden, orden_grupo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.status_grupo, grupo_trabajo.nombre_grupo
   FROM detalle_orden
  JOIN ordenes_tecnicos ON ordenes_tecnicos.id_det_orden::text = detalle_orden.id_det_orden::text
  JOIN orden_grupo ON orden_grupo.id_orden::text = ordenes_tecnicos.id_orden::text
  JOIN grupo_trabajo ON grupo_trabajo.id_gt::text = orden_grupo.id_gt::text;


CREATE OR REPLACE VIEW vista_pago_cont AS 
 SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, pagos.status_pago, pagos.nro_factura, pagos.id_contrato, contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, contrato.status_contrato, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, cliente.tipo_cliente, cliente.inicial_doc, caja.tipo_caja, caja_cobrador.id_persona AS id_persona_cob, contrato.taps, caja.id_caja, caja.id_franq, pagos.nro_control, pagos.desc_pago, pagos.monto_pago / ((pagos.por_iva / 100::numeric) + 1::numeric) AS base_imp, (pagos.monto_pago / ((pagos.por_iva / 100::numeric) + 1::numeric) * 12::numeric / 100::numeric) AS monto_iva, pagos.n_credito, pagos.fecha_factura, caja_cobrador.id_est, pagos.impresion, pagos.inc, zona.nombre_zona, sector.nombre_sector, pagos.obser_pago, sector.id_sector, pagos.tipo_doc
   FROM pagos 
   JOIN contrato ON contrato.id_contrato::text = pagos.id_contrato::text
   JOIN cliente ON cliente.id_persona::text = contrato.cli_id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN caja_cobrador ON pagos.id_caja_cob::text = caja_cobrador.id_caja_cob::text
   JOIN caja ON caja_cobrador.id_caja::text = caja.id_caja::text
   JOIN calle ON calle.id_calle::text = contrato.id_calle::text
   JOIN sector ON calle.id_sector=sector.id_sector
   JOIN zona ON sector.id_zona=zona.id_zona; 

CREATE OR REPLACE VIEW vista_pago_ser AS 
 SELECT pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, contrato_servicio_deuda.cant_serv, pago_factura.costo_cobro_serv AS costo_cobro, contrato_servicio_deuda.id_serv, pagos.status_pago, caja.tipo_caja, pagos.id_pago, contrato_servicio_deuda.fecha_inst, servicios.nombre_servicio, caja.id_franq, caja_cobrador.id_est, contrato_servicio_deuda.descu, pagos.nro_factura, pagos.id_contrato, caja_cobrador.id_persona, pagos.obser_pago, servicios.tipo_serv, contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.costo_cobro AS costo_cobro_fact, contrato_servicio_deuda.status_con_ser, pagos.tipo_doc, contrato_servicio_deuda.pagado
   FROM pago_factura 
   JOIN pagos ON pagos.id_pago::text = pago_factura.id_pago::text
   JOIN contrato_servicio_deuda ON pago_factura.id_cont_serv::text = contrato_servicio_deuda.id_cont_serv::text
   JOIN caja_cobrador ON pagos.id_caja_cob::text = caja_cobrador.id_caja_cob::text
   JOIN caja ON caja_cobrador.id_caja::text = caja.id_caja::text
   JOIN servicios ON contrato_servicio_deuda.id_serv::text = servicios.id_serv::text;


CREATE OR REPLACE VIEW vista_pagodeposito AS 
 SELECT persona.cedula, persona.nombre, persona.apellido, contrato.nro_contrato, sector.nombre_sector, franquicia.nombre_franq, franquicia.id_franq, pagodeposito.monto_dep, pagodeposito.id_pd, pagodeposito.id_contrato, pagodeposito.fecha_reg, pagodeposito.hora_reg, pagodeposito.login_reg, pagodeposito.fecha_dep, pagodeposito.banco, pagodeposito.numero_ref, pagodeposito.fecha_conf, pagodeposito.hora_conf, pagodeposito.login_conf, pagodeposito.fecha_proc, pagodeposito.tipo_dt, pagodeposito.login_proc, pagodeposito.status_pd, ciudad.id_mun, pagodeposito.cedula_titular, pagodeposito.obser_p
   FROM cliente
   JOIN contrato ON cliente.id_persona::text = contrato.cli_id_persona::text
   JOIN calle ON contrato.id_calle::text = calle.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text
   JOIN franquicia ON sector.id_franq::text = franquicia.id_franq::text
   JOIN pagodeposito ON pagodeposito.id_contrato::text = contrato.id_contrato::text
  ORDER BY pagodeposito.fecha_reg, pagodeposito.hora_reg;

DROP VIEW vista_para_cortar;



DROP VIEW vista_pser;
DROP VIEW vista_ps_est;



  DROP VIEW vista_rep_orden;

  DROP VIEW vista_resumen_orden;



  


CREATE OR REPLACE VIEW vista_recibos AS 
 SELECT recibos.nro_recibo, recibos.id_asig, recibos.id_rec, recibos.status_pago, vista_asignarecibo.id_persona, vista_asignarecibo.cedula, vista_asignarecibo.nombre, vista_asignarecibo.apellido, vista_asignarecibo.telefono, vista_asignarecibo.id_cobrador, vista_asignarecibo.fecha_asig, vista_asignarecibo.obser_asig, vista_asignarecibo.login_asig, vista_asignarecibo.desde, vista_asignarecibo.hasta, vista_asignarecibo.cantidad, recibos.tipo, recibos.obser
   FROM recibos
   JOIN vista_asignarecibo ON recibos.id_asig::text = vista_asignarecibo.id_asig::text
  ORDER BY recibos.nro_recibo;


CREATE OR REPLACE VIEW vista_reclamo AS 
 SELECT reclamo_denuncia.id_rec, reclamo_denuncia.id_persona, reclamo_denuncia.nro_rec, reclamo_denuncia.tipo_rec, reclamo_denuncia.fecha_rec, reclamo_denuncia.hora_rec, reclamo_denuncia.motivo_rec, reclamo_denuncia.descrip_rec, reclamo_denuncia.denunciado, reclamo_denuncia.status_rec, vista_cliente.cedula, vista_cliente.nombre, vista_cliente.apellido, vista_cliente.telefono, vista_cliente.telf_casa, vista_cliente.email
   FROM vista_cliente
   JOIN reclamo_denuncia ON reclamo_denuncia.id_persona::text = vista_cliente.id_persona::text
  ORDER BY reclamo_denuncia.nro_rec;



CREATE OR REPLACE VIEW vista_serv AS 
 SELECT servicios.id_serv, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, servicios.tipo_costo, servicios.tipo_paq, servicios.tarifa_esp, servicios.tipo_serv, cant_tv.cantidad, contrato_servicio.id_cont_serv, contrato_servicio.id_contrato, cant_tv.id_cant, servicios.id_paq
   FROM servicios
   JOIN cant_tv ON servicios.id_cant::text = cant_tv.id_cant::text
   JOIN contrato_servicio ON servicios.id_serv::text = contrato_servicio.id_serv::text;


CREATE OR REPLACE VIEW vista_servicio_status AS 
 SELECT DISTINCT servicios.id_tipo_servicio, contrato.id_contrato, contrato.status_contrato
   FROM contrato
   JOIN contrato_servicio ON contrato.id_contrato::text = contrato_servicio.id_contrato::text
   JOIN servicios ON contrato_servicio.id_serv::text = servicios.id_serv::text;

CREATE OR REPLACE VIEW vista_sms AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, sms.id_sms, sms.id_contrato, sms.nro_sms, sms.tipo_sms, sms.telefono_sms, sms.fecha_sms, sms.hora_sms, sms.mensaje_sms, sms.status_sms, sms.login, sms.tipo_list, sms.status_list, contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.observacion, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, contrato.id_edif, contrato.direc_adicional, contrato.numero_casa, contrato.numero_piso, cliente.telf_casa, cliente.email, cliente.telf_adic
   FROM persona
   JOIN cliente ON persona.id_persona::text = cliente.id_persona::text
  JOIN contrato ON cliente.id_persona::text = contrato.cli_id_persona::text
   JOIN sms ON contrato.id_contrato::text = sms.id_contrato::text
  ORDER BY sms.id_sms;



CREATE OR REPLACE VIEW vista_tarifa AS 
 SELECT tarifa_servicio.id_tar_ser, tarifa_servicio.id_serv, tarifa_servicio.fecha_tar_ser, tarifa_servicio.hora_tar_ser, tarifa_servicio.obser_tarifa_ser, tarifa_servicio.status_tarifa_ser, tarifa_servicio.tarifa_ser, vista_servicios.id_tipo_servicio, vista_servicios.nombre_servicio, vista_servicios.status_serv, vista_servicios.tipo_servicio, vista_servicios.status_servicio, vista_servicios.tipo_costo, vista_servicios.tarifa_esp, vista_servicios.tipo_serv
   FROM tarifa_servicio
   JOIN vista_servicios ON tarifa_servicio.id_serv::text = vista_servicios.id_serv::text;



CREATE OR REPLACE VIEW vista_tecnico AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, tecnico.num_tecnico, tecnico.direccion_tec, tecnico.correo_tec, tecnico.status_tec, franquicia.id_franq, franquicia.nombre_franq
   FROM tecnico
   JOIN persona ON persona.id_persona::text = tecnico.id_persona::text
   JOIN franquicia ON franquicia.id_franq::text = tecnico.id_franq::text
  ORDER BY persona.cedula;


CREATE OR REPLACE VIEW vista_ubica AS 
 SELECT calle.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, franquicia.id_franq, zona.nombre_zona, franquicia.nombre_franq, sector.id_franq AS id_pais, estado.nombre_esta
   FROM calle
   JOIN sector ON sector.id_sector::text = calle.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN franquicia ON sector.id_franq::text = franquicia.id_franq::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text;



CREATE OR REPLACE VIEW vista_ubicli AS 
 SELECT contrato.id_contrato, calle.id_calle, calle.id_sector, sector.id_zona, contrato.status_contrato
   FROM calle
   JOIN contrato ON calle.id_calle::text = contrato.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
  ORDER BY contrato.id_contrato;



CREATE OR REPLACE VIEW vista_vendedor AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, vendedor.nro_vendedor, vendedor.direccion_ven, franquicia.id_franq, franquicia.nombre_franq
   FROM vendedor
   JOIN persona ON persona.id_persona::text = vendedor.id_persona::text
   JOIN franquicia ON franquicia.id_franq::text = vendedor.id_franq::text
  ORDER BY persona.cedula;



CREATE OR REPLACE VIEW vistamodulo AS 
 SELECT perfil.codigoperfil, perfil.nombreperfil, perfil.descripcionperfil, modulo.codigomodulo, modulo.nombremodulo, modulo.namemodulo, modulo_perfil.incluir, modulo_perfil.modificar, modulo_perfil.eliminar
   FROM modulo
   JOIN modulo_perfil ON modulo_perfil.codigomodulo::text = modulo.codigomodulo::text
   JOIN perfil ON modulo_perfil.codigoperfil::text = perfil.codigoperfil::text and modulo.statusmodulo::bpchar = 'ACTIVO'::bpchar AND  perfil.statusperfil::bpchar = 'ACTIVO'::bpchar;


DROP VIEW vista_contrato1;

SELECT nro_contrato,apellido,nombre,status_contrato, ( SELECT sum(deuda) FROM vista_deuda WHERE vista_deuda.id_contrato = vista_contrato_auditoria.id_contrato and fecha_inst < '2015-03-01') AS deuda_servicio, ( SELECT sum(deuda) FROM vista_deuda WHERE vista_deuda.id_contrato = vista_contrato_auditoria.id_contrato and fecha_inst < '2015-03-01') AS deuda_total, nombre_sector , direc_adicional ,postel ,etiqueta,telefono as celular,telf_casa as telefono FROM vista_contrato_auditoria WHERE vista_contrato_auditoria.id_contrato<>'' and (select count(*) FROM vista_deuda WHERE vista_deuda.id_contrato = vista_contrato_auditoria.id_contrato and fecha_inst < '2015-04-01' )>0 and (select count(*) FROM vista_deuda WHERE vista_deuda.id_contrato = vista_contrato_auditoria.id_contrato and fecha_inst < '2005-01-01' )<=0 LIMIT 1000 offset 0



------------------------------------------- 29/03/2015--------------------------------------



CREATE OR REPLACE VIEW vista_contrato_auditoria AS 
 SELECT contrato.id_contrato, contrato.id_venta, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.telf_adic, contrato.direc_adicional, contrato.numero_casa, contrato.id_edif, contrato.numero_piso, contrato.id_urb, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, sector.id_franq, estado.nombre_esta, franquicia.nombre_franq, contrato.postel, contrato.pto, contrato.cod_id_persona, (vista_cobrador.nombre::text || ''::text) || vista_cobrador.apellido::text AS cobrador, contrato.etiqueta_n, contrato.taps, contrato.tipo_fact, edificio.edificio, urbanizacion.nombre_urb AS urbanizacion, contrato.contrato_fisico, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac, contrato.observacion, statuscont.nombrestatus, contrato.contrato_imp, contrato.ultima_act, cliente.email, venta_contrato.id_persona, venta_contrato.id_serv AS id_serv_v, contrato.saldo
   FROM contrato
   JOIN calle ON contrato.id_calle::text = calle.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text
   JOIN franquicia ON sector.id_franq::text = franquicia.id_franq::text
   JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN grupo_afinidad ON contrato.id_g_a::text = grupo_afinidad.id_g_a::text
   JOIN vista_cobrador ON vista_cobrador.id_persona::text = contrato.cod_id_persona::text
   JOIN statuscont ON statuscont.status_contrato::text = contrato.status_contrato::text
   LEFT JOIN edificio ON contrato.id_edif::text = edificio.id_edif::text
   LEFT JOIN urbanizacion ON contrato.id_urb::text = urbanizacion.id_urb::text
   LEFT JOIN venta_contrato ON contrato.id_venta::text = venta_contrato.id_venta::text;



CREATE OR REPLACE VIEW vista_deuda AS 
 SELECT pagos.id_contrato, servicios.id_serv, servicios.id_tipo_servicio, (((contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) - contrato_servicio_deuda.descu) - contrato_servicio_deuda.pagado) AS deuda, contrato_servicio_deuda.fecha_inst
   FROM pagos, contrato_servicio_deuda, servicios
  WHERE pagos.id_pago::text = contrato_servicio_deuda.id_pago::text AND contrato_servicio_deuda.id_serv::text = servicios.id_serv::text AND contrato_servicio_deuda.status_con_ser::bpchar = 'DEUDA'::bpchar AND (((contrato_servicio_deuda.cant_serv::numeric * contrato_servicio_deuda.costo_cobro) - contrato_servicio_deuda.descu) - contrato_servicio_deuda.pagado) > 0::numeric;




DROP VIEW vista_llamadas;
CREATE OR REPLACE VIEW vista_llamadas AS 
 SELECT tipo_llamada.dato, tipo_llamada.id_tll, tipo_llamada.nombre_tll, tipo_llamada.status_tll, llamadas.id_lla, llamadas.id_drl, llamadas.id_contrato, llamadas.fecha_lla, llamadas.hora_lla, llamadas.login, llamadas.obser_lla, llamadas.crea_alarma, detalle_resp.id_trl, detalle_resp.nombre_drl, detalle_resp.status_drl, tipo_resp.nombre_trl, tipo_resp.status_trl,  contrato.nro_contrato, contrato.fecha_contrato, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.telf_adic, contrato.direc_adicional, contrato.numero_casa, contrato.id_edif, contrato.numero_piso, urbanizacion.id_urb, contrato.id_g_a, grupo_afinidad.nombre_g_a, calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, municipio.id_mun, ciudad.nombre_ciudad, estado.id_esta, municipio.nombre_mun, franquicia.id_franq, estado.nombre_esta, franquicia.nombre_franq, contrato.postel, contrato.pto, contrato.cod_id_persona, (vista_cobrador.nombre::text || '' || vista_cobrador.apellido::text) AS cobrador, contrato.etiqueta_n, contrato.taps, contrato.tipo_fact,contrato.saldo
   FROM tipo_llamada
   JOIN llamadas ON tipo_llamada.id_tll::text = llamadas.id_tll::text
   JOIN detalle_resp ON llamadas.id_drl::text = detalle_resp.id_drl::text
   JOIN tipo_resp ON detalle_resp.id_trl::text = tipo_resp.id_trl::text

   JOIN contrato ON llamadas.id_contrato::text = contrato.id_contrato::text
   JOIN calle ON contrato.id_calle::text = calle.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text
   JOIN franquicia ON sector.id_franq::text = franquicia.id_franq::text
   JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN grupo_afinidad ON contrato.id_g_a::text = grupo_afinidad.id_g_a::text
   JOIN vista_cobrador ON vista_cobrador.id_persona::text = contrato.cod_id_persona::text
   JOIN statuscont ON statuscont.status_contrato::text = contrato.status_contrato::text
   LEFT JOIN edificio ON contrato.id_edif::text = edificio.id_edif::text
   LEFT JOIN urbanizacion ON contrato.id_urb::text = urbanizacion.id_urb::text

  ORDER BY llamadas.fecha_lla DESC, llamadas.hora_lla DESC;



alter table llamadas
   add constraint FK_llamadas_contrato foreign key (id_drl)
      references detalle_resp (id_drl)
      on update restrict
      on delete restrict;

alter table llamadas
   add constraint FK_llamadas_id_tll foreign key (id_tll)
      references tipo_llamada (id_tll)
      on update restrict
      on delete restrict;



alter table llamadas
   add constraint FK_llamadas_id_contrato foreign key (id_contrato)
      references contrato (id_contrato)
      on update restrict
      on delete restrict;


alter table detalle_resp
   add constraint FK_lladetalle_respcontrato foreign key (id_trl)
      references tipo_resp (id_trl)
      on update restrict
      on delete restrict;



CREATE INDEX llamadfadfdffssd
  ON llamadas
  USING btree
  (fecha_lla);
CREATE INDEX llamadfadfdvvffssd
  ON llamadas
  USING btree
  (hora_lla);



CREATE INDEX relatssaldo
  ON contrato
  USING btree
  (saldo);



CREATE OR REPLACE VIEW vista_pago AS 
 SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, pagos.status_pago, pagos.nro_factura, pagos.id_contrato, pagos.nro_control, pagos.desc_pago, pagos.monto_pago / (pagos.por_iva / 100::numeric + 1::numeric) AS base_imp, pagos.monto_pago / (pagos.por_iva / 100::numeric + 1::numeric) * 12::numeric / 100::numeric AS monto_iva, pagos.n_credito,pagos.n_credito as nota_credito, pagos.fecha_factura,  pagos.impresion, pagos.inc,  pagos.obser_pago,  pagos.tipo_doc, desc_pago as por_reten, desc_pago as monto_reten, desc_pago as islr, inc as cont
   FROM pagos;



CREATE OR REPLACE VIEW vista_pago_cont AS 
 SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, pagos.status_pago, pagos.nro_factura, pagos.id_contrato, contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, contrato.status_contrato, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, cliente.tipo_cliente, cliente.inicial_doc, caja.tipo_caja, caja_cobrador.id_persona AS id_persona_cob, contrato.taps, caja.id_caja, caja.id_franq, pagos.nro_control, pagos.desc_pago, pagos.monto_pago / (pagos.por_iva / 100::numeric + 1::numeric) AS base_imp, pagos.monto_pago / (pagos.por_iva / 100::numeric + 1::numeric) * 12::numeric / 100::numeric AS monto_iva, pagos.n_credito, pagos.fecha_factura, caja_cobrador.id_est, pagos.impresion, pagos.inc, zona.nombre_zona, sector.nombre_sector, pagos.obser_pago, sector.id_sector, pagos.tipo_doc, desc_pago as por_reten, desc_pago as monto_reten, desc_pago as islr, inc as cont
   FROM pagos
   JOIN contrato ON contrato.id_contrato::text = pagos.id_contrato::text
   JOIN cliente ON cliente.id_persona::text = contrato.cli_id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN caja_cobrador ON pagos.id_caja_cob::text = caja_cobrador.id_caja_cob::text
   JOIN caja ON caja_cobrador.id_caja::text = caja.id_caja::text
   JOIN calle ON calle.id_calle::text = contrato.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text;



CREATE OR REPLACE VIEW vista_contratodeu AS 
 SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, pagos.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, tipo_servicio.tipo_servicio, tipo_servicio.status_servicio, contrato.costo_dif_men, contrato.nro_contrato, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, servicios.tipo_costo, contrato_servicio_deuda.costo_cobro, contrato.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, zona.nombre_zona, contrato.status_contrato, contrato_servicio_deuda.descu, contrato_servicio_deuda.inc, servicios.tipo_serv, pagado,apagar,id_pago
   FROM pagos
   JOIN contrato_servicio_deuda ON pagos.id_pago::text = contrato_servicio_deuda.id_pago::text
   JOIN servicios ON contrato_servicio_deuda.id_serv::text = servicios.id_serv::text
   JOIN tipo_servicio ON servicios.id_tipo_servicio::text = tipo_servicio.id_tipo_servicio::text
   JOIN contrato ON pagos.id_contrato::text = contrato.id_contrato::text
   JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
   JOIN persona ON cliente.id_persona::text = persona.id_persona::text
   JOIN calle ON contrato.id_calle::text = calle.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
  ORDER BY contrato_servicio_deuda.id_cont_serv;


CREATE OR REPLACE VIEW vista_contrato_servicio_deuda AS 
 SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, pagos.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, contrato_servicio_deuda.costo_cobro, contrato_servicio_deuda.descu, contrato_servicio_deuda.inc, contrato_servicio_deuda.apagar, pagos.id_pago, contrato_servicio_deuda.pagado
   FROM contrato_servicio_deuda
   JOIN pagos ON contrato_servicio_deuda.id_pago::text = pagos.id_pago::text;



CREATE OR REPLACE FUNCTION update_saldo()
  RETURNS trigger AS
$BODY$
DECLARE
resultado NUMERIC;
BEGIN
   resultado:= (select update_saldo(NEW.id_contrato));
  /*if (NEW.id_contrato <> OLD.id_contrato) then
    resultado:= (select update_saldo(OLD.id_contrato));
  end if;
  */
RETURN new;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION update_saldo()
  OWNER TO postgres;





---------------------------------------------------31/03/2015-------------------------------------------


ALTER TABLE contrato rename column deuda to saldo;




CREATE OR REPLACE VIEW personausuario AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, usuario.login, usuario.codigoperfil, usuario.password, usuario.statususuario, perfil.nombreperfil, perfil.descripcionperfil, perfil.statusperfil, usuario.id_franq, franquicia.nombre_franq, servidor.nombre_servidor,usuario.id_usuario
   FROM persona
   JOIN usuario ON persona.id_persona::text = usuario.id_persona::text
   JOIN perfil ON usuario.codigoperfil::text = perfil.codigoperfil::text
   LEFT JOIN franquicia ON franquicia.id_franq::text = usuario.id_franq::text
   LEFT JOIN servidor ON servidor.id_servidor::text = usuario.id_servidor::text;


ALTER TABLE statuscont ADD color character(20);


CREATE OR REPLACE VIEW vista_contrato_auditoria AS 
 SELECT contrato.id_contrato, contrato.id_venta, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.telf_adic, contrato.direc_adicional, contrato.numero_casa, contrato.id_edif, contrato.numero_piso, contrato.id_urb, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, sector.id_franq, estado.nombre_esta, franquicia.nombre_franq, contrato.postel, contrato.pto, contrato.cod_id_persona, (vista_cobrador.nombre::text || ''::text) || vista_cobrador.apellido::text AS cobrador, contrato.etiqueta_n, contrato.taps, contrato.tipo_fact, edificio.edificio, urbanizacion.nombre_urb AS urbanizacion, contrato.contrato_fisico, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac, contrato.observacion, statuscont.nombrestatus, contrato.contrato_imp, contrato.ultima_act, cliente.email, venta_contrato.id_persona, venta_contrato.id_serv AS id_serv_v, contrato.saldo,statuscont.color
   FROM contrato
   JOIN calle ON contrato.id_calle::text = calle.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text
   JOIN franquicia ON sector.id_franq::text = franquicia.id_franq::text
   JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN grupo_afinidad ON contrato.id_g_a::text = grupo_afinidad.id_g_a::text
   JOIN vista_cobrador ON vista_cobrador.id_persona::text = contrato.cod_id_persona::text
   JOIN statuscont ON statuscont.status_contrato::text = contrato.status_contrato::text
   LEFT JOIN edificio ON contrato.id_edif::text = edificio.id_edif::text
   LEFT JOIN urbanizacion ON contrato.id_urb::text = urbanizacion.id_urb::text
   LEFT JOIN venta_contrato ON contrato.id_venta::text = venta_contrato.id_venta::text;






------------------------------------------------------------------------------- 08 / 04 / 2015 --------------------------------------------------------------------------

-- Function: suscripcion(text)

-- DROP FUNCTION suscripcion(text);

CREATE OR REPLACE FUNCTION suscripcion(text)
  RETURNS numeric AS
$BODY$
DECLARE
id_cont ALIAS FOR $1;
resultado NUMERIC;
result record;

BEGIN

 FOR result IN (SELECT sum(cant_serv*costo_cobro) as monto, count(*) as cant_f FROM contrato_servicio where id_contrato= id_cont and (status_con_ser='CONTRATO' OR status_con_ser='SUSPENDIDO') ) LOOP
  IF (result.cant_f > 0) THEN
    resultado=result.monto;
  ELSE
    resultado=0;
  END IF;
 END LOOP;

--UPDATE CONTRATO SET suscripcion = resultado WHERE id_contrato= id_cont;

RETURN resultado;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION suscripcion(text) OWNER TO postgres;





CREATE OR REPLACE FUNCTION update_saldo(text)
  RETURNS numeric AS
$BODY$
DECLARE
id_cont ALIAS FOR $1;
resultado NUMERIC;
r_fact NUMERIC;
r_pago NUMERIC;
fact record;
pago record;

BEGIN

 FOR fact IN (SELECT sum(monto_pago) as monto_f, count(*) as cant_f FROM pagos where id_contrato= id_cont and (tipo_doc='AVISO' OR tipo_doc='FACTURA' OR tipo_doc='NOTA DEBITO') ) LOOP
  IF (fact.cant_f > 0) THEN
    r_fact=fact.monto_f;
  ELSE
    r_fact=0;
  END IF;
 END LOOP;

 FOR pago IN (SELECT sum(monto_pago) as monto_p, count(*) as cant_p FROM pagos where id_contrato= id_cont and (tipo_doc='PAGOS' OR tipo_doc='NOTA CREDITO' OR tipo_doc='ABONO') ) LOOP
  IF (pago.cant_p>0) THEN
    r_pago=pago.monto_p;
  ELSE
    r_pago=0;
  END IF;
 END LOOP;
 
resultado= (r_fact - r_pago);

UPDATE CONTRATO SET saldo = resultado WHERE id_contrato= id_cont;

RETURN resultado;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION update_saldo(text) OWNER TO postgres;



CREATE OR REPLACE FUNCTION update_saldo()
  RETURNS trigger AS
$BODY$
DECLARE
resultado NUMERIC;
BEGIN
	-- resultado:= (select update_saldo(NEW.id_contrato));
	/*if (NEW.id_contrato <> OLD.id_contrato) then
		resultado:= (select update_saldo(OLD.id_contrato));
	end if;
	*/
RETURN new;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION update_saldo() OWNER TO postgres;





CREATE TRIGGER trigger_pagos_saldo
  AFTER INSERT OR UPDATE OR DELETE
  ON pagos
  FOR EACH ROW
  EXECUTE PROCEDURE update_saldo();









CREATE OR REPLACE VIEW vista_contrato_servicio_deuda AS 
 SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, pagos.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, contrato_servicio_deuda.costo_cobro, contrato_servicio_deuda.descu, contrato_servicio_deuda.inc, contrato_servicio_deuda.apagar, pagos.id_pago, contrato_servicio_deuda.pagado,tipo_doc
   FROM contrato_servicio_deuda
   JOIN pagos ON contrato_servicio_deuda.id_pago::text = pagos.id_pago::text;



------------------------------------------------------- 10 / 04 / 2015 ------------------------------------------



CREATE TABLE notas_cd
(
  id_nota character varying(10) NOT NULL,
  tipo character varying(30),
  idmotivonota character varying(8),
  comentario_sol text,
  comentario_rec text,
  status character varying(200),
  id_pago character varying(12),
  login_sol character varying(25),
  dir_ip_sol character varying(20),
  fecha_sol date,
  hora_sol time without time zone,
  login_aut character varying(25),
  dir_ip_aut character varying(20),
  fecha_aut date,
  hora_aut time without time zone,
  CONSTRAINT pk_notfas_c PRIMARY KEY (id_nota),
  CONSTRAINT notas_id_pagofs_fkey FOREIGN KEY (id_pago)
      REFERENCES pagos (id_pago) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT notas_idmoftivonota_fkey FOREIGN KEY (idmotivonota)
      REFERENCES motivonotas (idmotivonota) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE notas OWNER TO postgres;

-- Index: notas_2_pk

-- DROP INDEX notas_2_pk;

CREATE UNIQUE INDEX notddas_2_pk
  ON notas_cd
  USING btree
  (id_nota);

-- Index: notas_3_pk

-- DROP INDEX notas_3_pk;

CREATE INDEX notas_id_dpago3_pk
  ON notas_cd
  USING btree
  (id_pago);

-- Index: notas_4_pk

-- DROP INDEX notas_4_pk;

CREATE INDEX nodtdas_4_pk
  ON notas_cd
  USING btree
  (idmotivonota);



CREATE OR REPLACE VIEW vista_notas_cd AS 
 SELECT notas_cd.id_nota, notas_cd.login_sol,  notas_cd.tipo, notas_cd.dir_ip_sol, notas_cd.fecha_sol, notas_cd.hora_sol,  notas_cd.idmotivonota, notas_cd.comentario_sol, notas_cd.status,  motivonotas.nombremotivonota, contrato.id_contrato, contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, contrato.status_contrato, vista_ubica.id_sector, vista_ubica.nombre_calle, persona.id_persona, persona.cedula, persona.nombre, persona.apellido, vista_ubica.id_zona, vista_ubica.nombre_sector, vista_ubica.id_franq, vista_ubica.nombre_zona, vista_ubica.nombre_franq, vista_ubica.nombre_ciudad, notas_cd.login_aut, pagos.monto_pago
   FROM notas_cd
   JOIN motivonotas ON notas_cd.idmotivonota::text = motivonotas.idmotivonota::text
   JOIN pagos ON pagos.id_pago::text = notas_cd.id_pago::text
   JOIN contrato ON contrato.id_contrato::text = pagos.id_contrato::text
   JOIN cliente ON cliente.id_persona::text = contrato.cli_id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN vista_ubica ON contrato.id_calle::text = vista_ubica.id_calle::text;



-------------------------------------12/04/2015---------------------------------


CREATE OR REPLACE VIEW vista_cont_serv_sist_paq AS 
 SELECT contrato_servicio.id_serv, contrato_servicio.id_contrato,   servicios.nombre_servicio,  serv_sist_paq.id_serv_sist
   FROM contrato_servicio
   JOIN servicios ON contrato_servicio.id_serv::text = servicios.id_serv::text
   JOIN serv_sist_paq ON servicios.id_serv::text = serv_sist_paq.id_serv::text;


delete from recibos;


CREATE OR REPLACE VIEW personausuario AS 
 SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, usuario.login, usuario.codigoperfil, usuario.password, usuario.statususuario, perfil.nombreperfil, perfil.descripcionperfil, perfil.statusperfil, usuario.id_franq, franquicia.nombre_franq, servidor.nombre_servidor,id_usuario
   FROM persona
   JOIN usuario ON persona.id_persona::text = usuario.id_persona::text
   JOIN perfil ON usuario.codigoperfil::text = perfil.codigoperfil::text
   LEFT JOIN franquicia ON franquicia.id_franq::text = usuario.id_franq::text
   LEFT JOIN servidor ON servidor.id_servidor::text = usuario.id_servidor::text;



CREATE OR REPLACE VIEW vista_notas_cd AS 
 SELECT notas_cd.id_nota, notas_cd.login_sol, notas_cd.tipo, notas_cd.dir_ip_sol, notas_cd.fecha_sol, notas_cd.hora_sol, notas_cd.idmotivonota, notas_cd.comentario_sol, notas_cd.status, motivonotas.nombremotivonota, contrato.id_contrato, contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, contrato.status_contrato, vista_ubica.id_sector, vista_ubica.nombre_calle, persona.id_persona, persona.cedula, persona.nombre, persona.apellido, vista_ubica.id_zona, vista_ubica.nombre_sector, vista_ubica.id_franq, vista_ubica.nombre_zona, vista_ubica.nombre_franq, vista_ubica.nombre_ciudad, notas_cd.login_aut, pagos.monto_pago,pagos.id_pago
   FROM notas_cd
   JOIN motivonotas ON notas_cd.idmotivonota::text = motivonotas.idmotivonota::text
   JOIN pagos ON pagos.id_pago::text = notas_cd.id_pago::text
   JOIN contrato ON contrato.id_contrato::text = pagos.id_contrato::text
   JOIN cliente ON cliente.id_persona::text = contrato.cli_id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN vista_ubica ON contrato.id_calle::text = vista_ubica.id_calle::text;



CREATE INDEX index_orden1
  ON ordenes_tecnicos
  USING btree
  (status_orden);


CREATE INDEX index_orden2
  ON ordenes_tecnicos
  USING btree
  (fecha_orden);


CREATE INDEX index_orden3
  ON ordenes_tecnicos
  USING btree
  (fecha_imp);

CREATE INDEX index_orden4
  ON ordenes_tecnicos
  USING btree
  (fecha_final);

CREATE INDEX index_orden5
  ON ordenes_tecnicos
  USING btree
  (prioridad);



--------------------------------------13/04/2015 otro -------------------------------------------


ALTER TABLE tipo_pago ADD orden character(5);
update tipo_pago set orden='02' where id_tipo_pago='TPA00005';
update tipo_pago set orden='04' where id_tipo_pago='TPA00007';
update tipo_pago set orden='06' where id_tipo_pago='TPA00001';
update tipo_pago set orden='08' where id_tipo_pago='TPA00003';
update tipo_pago set orden='10' where id_tipo_pago='TPA00004';
update tipo_pago set orden='14' where id_tipo_pago='TPA00008';
update tipo_pago set orden='16' where id_tipo_pago='TPA00009';
update tipo_pago set orden='18' where id_tipo_pago='TPA00011';



INSERT INTO banco (id_banco, banco, abrev_banco, tipo_banco) VALUES ('AB003', 'RET. IVA', NULL, 'CLIENTE');
INSERT INTO banco (id_banco, banco, abrev_banco, tipo_banco) VALUES ('AB004', 'RET. ISLR', NULL, 'CLIENTE');



ALTER TABLE ONLY equipo_sistema
    ADD CONSTRAINT maequipo_sistemasique UNIQUE (codigo_es);
     





--------------------------------------14/04/2015 -------------------------------------------



drop VIEW vista_orden;
CREATE OR REPLACE VIEW vista_orden AS 
 SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, contrato.status_contrato, orden_grupo.id_gt, grupo_trabajo.nombre_grupo, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, ordenes_tecnicos.login AS login_emi, ordenes_tecnicos.hora AS hora_emi, ordenes_tecnicos.login_imp, ordenes_tecnicos.hora_imp, ordenes_tecnicos.login_fin, ordenes_tecnicos.hora_fin, contrato.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, estado.id_esta, municipio.nombre_mun, sector.id_franq, zona.nombre_zona, estado.nombre_esta, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, contrato.contrato_fisico, contrato.postel,franquicia.nombre_franq
   FROM ordenes_tecnicos
   JOIN detalle_orden ON detalle_orden.id_det_orden::text = ordenes_tecnicos.id_det_orden::text
   JOIN contrato ON ordenes_tecnicos.id_contrato::text = contrato.id_contrato::text
   JOIN tipo_orden ON tipo_orden.id_tipo_orden::text = detalle_orden.id_tipo_orden::text
   JOIN grupo_afinidad ON grupo_afinidad.id_g_a::text = contrato.id_g_a::text
   JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN calle ON contrato.id_calle::text = calle.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text
   LEFT JOIN orden_grupo ON ordenes_tecnicos.id_orden::text = orden_grupo.id_orden::text
   LEFT JOIN grupo_trabajo ON orden_grupo.id_gt::text = grupo_trabajo.id_gt::text
   JOIN franquicia ON sector.id_franq::text = franquicia.id_franq::text;



CREATE UNIQUE INDEX index_corte_1
  ON tabla_cortes
  USING btree
  (id_tc);

CREATE INDEX index_corte_2
  ON tabla_cortes
  USING btree
  (id_franq);


CREATE INDEX index_corte_3
  ON tabla_cortes
  USING btree
  (id_gt);


CREATE UNIQUE INDEX index_corte_4
  ON orden_tabla_cortes
  USING btree
  (id_tc,id_orden);

CREATE  INDEX index_corte_5
  ON orden_tabla_cortes
  USING btree
  (id_tc);


CREATE  INDEX index_corte_6
  ON orden_tabla_cortes
  USING btree
  (id_orden);



------------------------------------------------------------15/04/2015---------------------

ALTER TABLE ordenes_tecnicos ADD comentario_cliente text;


CREATE OR REPLACE VIEW vista_orden AS 
 SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, contrato.status_contrato, orden_grupo.id_gt, grupo_trabajo.nombre_grupo, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, ordenes_tecnicos.login AS login_emi, ordenes_tecnicos.hora AS hora_emi, ordenes_tecnicos.login_imp, ordenes_tecnicos.hora_imp, ordenes_tecnicos.login_fin, ordenes_tecnicos.hora_fin, contrato.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, estado.id_esta, municipio.nombre_mun, sector.id_franq, zona.nombre_zona, estado.nombre_esta, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, contrato.contrato_fisico, contrato.postel, franquicia.nombre_franq,contrato.saldo,statuscont.color,contrato.pto,ordenes_tecnicos.comentario_cliente
   FROM ordenes_tecnicos
   JOIN detalle_orden ON detalle_orden.id_det_orden::text = ordenes_tecnicos.id_det_orden::text
   JOIN contrato ON ordenes_tecnicos.id_contrato::text = contrato.id_contrato::text
   JOIN statuscont ON statuscont.status_contrato::text = contrato.status_contrato::text
   JOIN tipo_orden ON tipo_orden.id_tipo_orden::text = detalle_orden.id_tipo_orden::text
   JOIN grupo_afinidad ON grupo_afinidad.id_g_a::text = contrato.id_g_a::text
   JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN calle ON contrato.id_calle::text = calle.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text
   LEFT JOIN orden_grupo ON ordenes_tecnicos.id_orden::text = orden_grupo.id_orden::text
   LEFT JOIN grupo_trabajo ON orden_grupo.id_gt::text = grupo_trabajo.id_gt::text
   JOIN franquicia ON sector.id_franq::text = franquicia.id_franq::text;



CREATE OR REPLACE VIEW vista_equipo_sistema AS 
 SELECT contrato.id_contrato, contrato.nro_contrato, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, equipo_sistema.id_es, modelo.id_modelo, equipo_sistema.codigo_es, equipo_sistema.status_es, equipo_sistema.codigo_adic, equipo_sistema.estado_fisico, modelo.nombre_modelo, tipo_sist_equipo.id_tse, tipo_sist_equipo.abrev_nombre_tse AS sistema,tipo_es
   FROM equipo_sistema
   JOIN modelo ON equipo_sistema.id_modelo::text = modelo.id_modelo::text
   JOIN tipo_sist_equipo ON modelo.id_tse::text = tipo_sist_equipo.id_tse::text
   LEFT JOIN contrato ON contrato.id_contrato::text = equipo_sistema.id_contrato::text
   LEFT JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
   LEFT JOIN persona ON persona.id_persona::text = cliente.id_persona::text;



--------------------------------------------------------------18/04/2015------------------------------------------------



ALTER TABLE equipo_sistema ADD ubicacion character(50);



CREATE OR REPLACE VIEW vista_equipo_sistema AS 
 SELECT contrato.id_contrato, contrato.nro_contrato, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, equipo_sistema.id_es, modelo.id_modelo, equipo_sistema.codigo_es, equipo_sistema.status_es, equipo_sistema.codigo_adic, equipo_sistema.estado_fisico, modelo.nombre_modelo, tipo_sist_equipo.id_tse, tipo_sist_equipo.abrev_nombre_tse AS sistema, equipo_sistema.tipo_es,equipo_sistema.ubicacion
   FROM equipo_sistema
   JOIN modelo ON equipo_sistema.id_modelo::text = modelo.id_modelo::text
   JOIN tipo_sist_equipo ON modelo.id_tse::text = tipo_sist_equipo.id_tse::text
   LEFT JOIN contrato ON contrato.id_contrato::text = equipo_sistema.id_contrato::text
   LEFT JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
   LEFT JOIN persona ON persona.id_persona::text = cliente.id_persona::text;


CREATE OR REPLACE FUNCTION ver_serv_sist_equipo(text)
  RETURNS text AS
$BODY$
DECLARE
id_es1 ALIAS FOR $1;
resultado text;
serv record;

BEGIN
resultado='';
 FOR serv IN (SELECT nombre_serv_sist FROM servicios_sistema,serv_sist_equipo where servicios_sistema.id_serv_sist=serv_sist_equipo.id_serv_sist and serv_sist_equipo.id_es= id_es1 order by nombre_serv_sist ) LOOP
   resultado = resultado || serv.nombre_serv_sist || '; ';
 END LOOP;

RETURN resultado;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION ver_serv_sist_equipo(text) OWNER TO postgres;





------------------------------------------20/04/2015----------------------------------------------


CREATE OR REPLACE FUNCTION update_saldo()
  RETURNS trigger AS
$BODY$
DECLARE
resultado NUMERIC;
BEGIN
   --resultado:= (select update_saldo(NEW.id_contrato));
    
  /*if (NEW.id_contrato <> OLD.id_contrato) then
    resultado:= (select update_saldo(OLD.id_contrato));
  end if;
  */
  
RETURN new;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION update_saldo() OWNER TO postgres;




CREATE OR REPLACE VIEW vista_interfaz_equipo AS 
 SELECT contrato.id_contrato,
    contrato.nro_contrato,
    contrato.status_contrato,
    persona.cedula,
    persona.nombre,
    persona.apellido,
    equipo_sistema.id_es,
    modelo.id_modelo,
    equipo_sistema.codigo_es,
    equipo_sistema.status_es,
    equipo_sistema.codigo_adic,
    equipo_sistema.estado_fisico,
    modelo.nombre_modelo,
    tipo_sist_equipo.id_tse,
    tipo_sist_equipo.abrev_nombre_tse AS sistema,
    comandos_interfaz.id_com_int,
    comandos_interfaz.nombre_com_int,
    interfaz_equipos.id_inte,
    interfaz_equipos.status,
    interfaz_equipos.fecha,
    interfaz_equipos.login,
    interfaz_equipos.errmsg,
    interfaz_equipos.fecha_ejec,
    equipo_sistema.tipo_es
   FROM equipo_sistema
     JOIN interfaz_equipos ON interfaz_equipos.id_es::text = equipo_sistema.id_es::text
     JOIN comandos_interfaz ON interfaz_equipos.id_com_int::text = comandos_interfaz.id_com_int::text
     JOIN modelo ON equipo_sistema.id_modelo::text = modelo.id_modelo::text
     JOIN tipo_sist_equipo ON modelo.id_tse::text = tipo_sist_equipo.id_tse::text
     LEFT JOIN contrato ON contrato.id_contrato::text = equipo_sistema.id_contrato::text
     LEFT JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
     LEFT JOIN persona ON persona.id_persona::text = cliente.id_persona::text;

ALTER TABLE vista_interfaz_equipo OWNER TO postgres;


------------------------------------------------20-04-2015  8:00 pm --------------------------------------

CREATE OR REPLACE FUNCTION set_status_equipo()
  RETURNS trigger AS
$BODY$
DECLARE
resultado NUMERIC;
fact record;
BEGIN
if(NEW.status='TRUE') THEN
 FOR fact IN (SELECT tipo_com FROM comandos_interfaz where id_com_int= NEW.id_com_int and (tipo_com='ACTIVAR' or tipo_com='DESACTIVAR') ) LOOP
    if(fact.tipo_com='ACTIVAR') THEN
  UPDATE equipo_sistema SET status_es = 'ACTIVO' WHERE id_es= NEW.id_es;
    end if;
    if(fact.tipo_com='DESACTIVAR') THEN
  UPDATE equipo_sistema SET status_es = 'SUSPENDIDO' WHERE id_es= NEW.id_es;
    end if;
 END LOOP;
end if;
RETURN new;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION set_status_equipo() OWNER TO postgres;



CREATE TRIGGER interfaces_sta_equipo
  AFTER UPDATE
  ON interfaz_equipos
  FOR EACH ROW
  EXECUTE PROCEDURE set_status_equipo();


------------------------------------------------21-04-2015  8:00 pm --------------------------------------



ALTER TABLE ONLY public.contrato DROP CONSTRAINT uniqueetiqueta;











------------------------------------------------22-04-2015  8:00 pm --------------------------------------


update franquicia set id_gf='AA001' where id_franq='1';
ALTER TABLE ONLY public.cargar_deuda DROP CONSTRAINT fk_concontrato;

ALTER TABLE venta_contrato ADD cant_venta integer;
ALTER TABLE venta_contrato ADD id_contrato character(10);



--funcion

CREATE OR REPLACE FUNCTION update_saldo(text)
  RETURNS numeric AS
$BODY$
DECLARE
id_cont ALIAS FOR $1;
resultado NUMERIC;
r_fact NUMERIC;
r_pago NUMERIC;
fact record;
pago record;

BEGIN

 FOR fact IN (SELECT sum(monto_pago) as monto_f, count(*) as cant_f FROM pagos where id_contrato= id_cont and (tipo_doc='AVISO' OR tipo_doc='FACTURA' OR tipo_doc='NOTA DEBITO') ) LOOP
  IF (fact.cant_f > 0) THEN
    r_fact=fact.monto_f;
  ELSE
    r_fact=0;
  END IF;
 END LOOP;

 FOR pago IN (SELECT sum(monto_pago) as monto_p, count(*) as cant_p FROM pagos where id_contrato= id_cont and (tipo_doc='PAGO' OR tipo_doc='NOTA CREDITO' OR tipo_doc='ABONO') ) LOOP
  IF (pago.cant_p>0) THEN
    r_pago=pago.monto_p;
  ELSE
    r_pago=0;
  END IF;
 END LOOP;
 
resultado= (r_fact - r_pago);

UPDATE CONTRATO SET saldo = resultado WHERE id_contrato= id_cont;

RETURN resultado;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION update_saldo(text) OWNER TO postgres;

--fin funcion
















---------------------------------------------23-04-2015----------------------------------------------













CREATE TABLE carga_tabla_banco (
    id_ctb character(8) NOT NULL,
    id_cuba character(8),
    fecha_ctb date,
    hora_ctb time without time zone,
    login_ctb character(25),
    fecha_desde_ctb date,
    fecha_hasta_ctb date,
    status_ctb character(20),
    formato_ctb character(20)
);


ALTER TABLE public.carga_tabla_banco OWNER TO postgres;


CREATE TABLE conciliacion_dep_cli (
    id_cdb character(10) NOT NULL,
    id_pd character(8),
    id_tb character(10),
    fecha_cdb date,
    hora_cdb time without time zone,
    tipo_cdb character(20),
    login_cdb character(25)
);


ALTER TABLE public.conciliacion_dep_cli OWNER TO postgres;


CREATE TABLE conciliacion_dep_franq (
    id_cdbf character(8) NOT NULL,
    id_dbf character(8),
    id_tb character(10),
    fecha_cdbf date,
    hora_cdbf time without time zone,
    tipo_cdbf character(20),
    login_cdbf character(25)
);


ALTER TABLE public.conciliacion_dep_franq OWNER TO postgres;

CREATE TABLE cuenta_bancaria (
    id_cuba character(8) NOT NULL,
    numero_cuba character(20),
    banco_cuba character(100),
    abrev_cuba character(50),
    desc_cuba text,
    status_cuba character(15),
    conc_cliente character(2),
    conc_franq character(2),
    formato_archivo character(10),
    comision_pv numeric(10,4),
    comision_pv_c numeric(10,4)
);


ALTER TABLE public.cuenta_bancaria OWNER TO postgres;


CREATE TABLE deposito_franq (
    id_df character(8) NOT NULL,
    id_est character(5),
    fecha_df date,
    reporte_z character(10),
    monto_z numeric(10,2),
    fact_desde character(10),
    status_df character(20),
    tipo_fact character(20),
    hora_df time without time zone,
    login_df character(22),
    fact_hasta character(10),
    exportado character(10)
);


ALTER TABLE public.deposito_franq OWNER TO postgres;

CREATE TABLE deposito_franq_tp (
    id_df_tp character(8) NOT NULL,
    id_df character(8),
    id_tipo_pago character(8),
    monto_df_tp numeric(10,2),
    status_df_tp character(15)
);


ALTER TABLE public.deposito_franq_tp OWNER TO postgres;

CREATE TABLE detalle_tipopago_df (
    id_dbf character(8) NOT NULL,
    id_tipo_pago character(8),
    id_cuba character(8),
    id_df_tp character(8),
    fecha_dbf date,
    refer_dbf character(25),
    monto_dbf numeric(10,2),
    obser_dbf text,
    status_dbf character(20),
    hora_dbf time without time zone,
    login_dbf character(25),
    id_tb character(10),
    exportado character(10)
);


ALTER TABLE public.detalle_tipopago_df OWNER TO postgres;


CREATE TABLE tabla_bancos (
    id_tb character(10) NOT NULL,
    id_ctb character(8),
    fecha_tb date,
    tipo_tb character(30),
    referencia_tb character(30),
    monto_tb numeric(15,4),
    descrip_tb character(255),
    status_tb character(20),
    saldo numeric(15,4)
);


ALTER TABLE public.tabla_bancos OWNER TO postgres;


COMMENT ON TABLE tabla_bancos IS 'tipo:
CLIENTES
FRANQUICIAS
OTROS';

CREATE TABLE tipo_pago_df (
    id_tipo_pago character(8) NOT NULL,
    tipo_pago character(30),
    tipo_tp character(15),
    status_pago character(15),
    id_tb character(10)
);


ALTER TABLE public.tipo_pago_df OWNER TO postgres;

ALTER TABLE ONLY carga_tabla_banco
    ADD CONSTRAINT pk_carga_tabla_banco PRIMARY KEY (id_ctb);



ALTER TABLE ONLY conciliacion_dep_cli
    ADD CONSTRAINT pk_conciliacion_dep_cli PRIMARY KEY (id_cdb);


ALTER TABLE ONLY conciliacion_dep_franq
    ADD CONSTRAINT pk_conciliacion_dep_franq PRIMARY KEY (id_cdbf);


ALTER TABLE ONLY cuenta_bancaria
    ADD CONSTRAINT pk_cuenta_bancaria PRIMARY KEY (id_cuba);


ALTER TABLE ONLY deposito_franq
    ADD CONSTRAINT pk_deposito_franq PRIMARY KEY (id_df);

ALTER TABLE ONLY deposito_franq_tp
    ADD CONSTRAINT pk_deposito_franq_tp PRIMARY KEY (id_df_tp);


ALTER TABLE ONLY detalle_tipopago_df
    ADD CONSTRAINT pk_detalle_tipopago_df PRIMARY KEY (id_dbf);


ALTER TABLE ONLY tabla_bancos
    ADD CONSTRAINT pk_tabla_bancos PRIMARY KEY (id_tb);

ALTER TABLE ONLY tipo_pago_df
    ADD CONSTRAINT pk_tipo_pago_df PRIMARY KEY (id_tipo_pago);


CREATE UNIQUE INDEX index_conc_1 ON carga_tabla_banco USING btree (id_ctb);

CREATE INDEX index_conc_10 ON detalle_tipopago_df USING btree (id_cuba);

CREATE INDEX index_conc_11 ON detalle_tipopago_df USING btree (id_df_tp);


CREATE UNIQUE INDEX index_conc_12 ON detalle_tipopago_df USING btree (id_dbf);


CREATE INDEX index_conc_13 ON detalle_tipopago_df USING btree (id_tipo_pago);


CREATE UNIQUE INDEX index_conc_14 ON tabla_bancos USING btree (id_tb);


CREATE INDEX index_conc_15 ON tabla_bancos USING btree (id_ctb);


CREATE UNIQUE INDEX index_conc_16 ON tipo_pago_df USING btree (id_tipo_pago);



CREATE INDEX index_conc_2 ON carga_tabla_banco USING btree (id_cuba);



CREATE UNIQUE INDEX index_conc_3 ON cuenta_bancaria USING btree (id_cuba);


CREATE UNIQUE INDEX index_conc_4 ON deposito_franq USING btree (id_df);


CREATE INDEX index_conc_5 ON deposito_franq USING btree (id_est);



CREATE UNIQUE INDEX index_conc_6 ON deposito_franq_tp USING btree (id_df_tp);



CREATE INDEX index_conc_7 ON deposito_franq_tp USING btree (id_df);


CREATE INDEX index_conc_8 ON deposito_franq_tp USING btree (id_tipo_pago);

CREATE INDEX relationship_12_fk2 ON detalle_tipopago_df USING btree (id_tipo_pago);

ALTER TABLE ONLY deposito_franq
    ADD CONSTRAINT deposito_franq_id_est_fkey FOREIGN KEY (id_est) REFERENCES estacion_trabajo(id_est);


ALTER TABLE ONLY carga_tabla_banco
    ADD CONSTRAINT fk_carga_ta_reference_cuenta_b FOREIGN KEY (id_cuba) REFERENCES cuenta_bancaria(id_cuba) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE ONLY conciliacion_dep_franq
    ADD CONSTRAINT fk_concilia_reference_detalle_ FOREIGN KEY (id_dbf) REFERENCES detalle_tipopago_df(id_dbf) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE ONLY conciliacion_dep_cli
    ADD CONSTRAINT fk_concilia_reference_pagodepo FOREIGN KEY (id_pd) REFERENCES pagodeposito(id_pd) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE ONLY conciliacion_dep_cli
    ADD CONSTRAINT fk_concilia_reference_tabla_ba FOREIGN KEY (id_tb) REFERENCES tabla_bancos(id_tb) ON UPDATE RESTRICT ON DELETE RESTRICT;


ALTER TABLE ONLY conciliacion_dep_franq
    ADD CONSTRAINT fk_concilia_reference_tabla_ba FOREIGN KEY (id_tb) REFERENCES tabla_bancos(id_tb) ON UPDATE RESTRICT ON DELETE RESTRICT;


ALTER TABLE ONLY deposito_franq_tp
    ADD CONSTRAINT fk_deposito_reference_deposito FOREIGN KEY (id_df) REFERENCES deposito_franq(id_df) ON UPDATE RESTRICT ON DELETE RESTRICT;


ALTER TABLE ONLY deposito_franq_tp
    ADD CONSTRAINT fk_deposito_reference_tipo_pag FOREIGN KEY (id_tipo_pago) REFERENCES tipo_pago_df(id_tipo_pago) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE ONLY detalle_tipopago_df
    ADD CONSTRAINT fk_detalle__reference_cuenta_b FOREIGN KEY (id_cuba) REFERENCES cuenta_bancaria(id_cuba) ON UPDATE RESTRICT ON DELETE RESTRICT;


ALTER TABLE ONLY detalle_tipopago_df
    ADD CONSTRAINT fk_detalle__reference_deposito FOREIGN KEY (id_df_tp) REFERENCES deposito_franq_tp(id_df_tp) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE ONLY detalle_tipopago_df
    ADD CONSTRAINT fk_detalle__relations_tipo_pag FOREIGN KEY (id_tipo_pago) REFERENCES tipo_pago_df(id_tipo_pago) ON UPDATE RESTRICT ON DELETE RESTRICT;


ALTER TABLE ONLY tabla_bancos
    ADD CONSTRAINT fk_tabla_ba_reference_carga_ta FOREIGN KEY (id_ctb) REFERENCES carga_tabla_banco(id_ctb) ON UPDATE RESTRICT ON DELETE RESTRICT;







----------------------------------



ALTER TABLE tipo_servicio ADD codificado character(20);

update tipo_servicio set codificado='SI';
update tipo_servicio set codificado='NO' where id_tipo_servicio='AB00003';



  -------------------------------------------------------------------25/04/2015----------------------------------------


  
CREATE OR REPLACE VIEW vista_tablabancos AS 
 SELECT carga_tabla_banco.id_ctb, carga_tabla_banco.id_cuba, carga_tabla_banco.hora_ctb, carga_tabla_banco.login_ctb, carga_tabla_banco.fecha_desde_ctb, carga_tabla_banco.fecha_hasta_ctb, carga_tabla_banco.status_ctb, tabla_bancos.id_tb, tabla_bancos.fecha_tb, tabla_bancos.tipo_tb, tabla_bancos.referencia_tb, tabla_bancos.monto_tb, tabla_bancos.descrip_tb, tabla_bancos.status_tb, tabla_bancos.saldo, cuenta_bancaria.numero_cuba, cuenta_bancaria.banco_cuba, cuenta_bancaria.abrev_cuba, cuenta_bancaria.desc_cuba, cuenta_bancaria.status_cuba, cuenta_bancaria.conc_cliente, cuenta_bancaria.conc_franq, cuenta_bancaria.formato_archivo, carga_tabla_banco.fecha_ctb
   FROM carga_tabla_banco, tabla_bancos, cuenta_bancaria
  WHERE carga_tabla_banco.id_ctb = tabla_bancos.id_ctb AND carga_tabla_banco.id_cuba = cuenta_bancaria.id_cuba;

ALTER TABLE vista_tablabancos OWNER TO postgres;


  -------------------------------------------------------------------27/04/2015----------------------------------------


INSERT INTO caja (id_caja, nombre_caja, descripcion_caja, status_caja, inicial, tipo_caja, id_franq, caja_externa) VALUES ('BB001', 'CAJA VIRTUAL', 'PARA LA OFICINA VIRTUAL', 'ACTIVA', 'AA', 'PRINCIPAL', '1', 'VIRTUAL');

INSERT INTO estacion_trabajo (id_est, login, nombre_est, ip_est, mac_est, nom_comp, status_est) VALUES ('BB001', 'ADMIN', 'ESTACION VIRTUAL', '127.0.0.1', '', '', 'IMPRESORAFISCAL');

insert into persona(id_persona,cedula,nombre,apellido,telefono) values ('BB00000001','01010101','COBRADOR','VIRTUAL','00000000000');
INSERT INTO cobrador (id_persona, nro_cobrador, direccion_cob, codcob, id_franq) VALUES ('BB00000001', 0, 'INTERNO', '', '1');

insert into persona(id_persona,cedula,nombre,apellido,telefono) values ('BB00000002','10101010','NO','APLICA','00000000000');
INSERT INTO cobrador (id_persona, nro_cobrador, direccion_cob, codcob, id_franq) VALUES ('BB00000002', 0, 'INTERNO', '', '1');

DROP VIEW vista_tipopago;
ALTER TABLE detalle_tipopago ALTER column id_banco TYPE character(8);


CREATE OR REPLACE VIEW vista_tipopago AS 
 SELECT detalle_tipopago.id_tp, detalle_tipopago.id_tipo_pago, detalle_tipopago.id_pago, detalle_tipopago.id_banco, detalle_tipopago.refer_tp, detalle_tipopago.monto_tp, banco.banco, detalle_tipopago.lote_tp, pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, pagos.obser_pago, pagos.status_pago, pagos.nro_factura, tipo_pago.tipo_pago, caja.tipo_caja, pagos.id_contrato, caja.id_franq, caja_cobrador.id_est, pagos.impresion, pagos.tipo_doc
   FROM detalle_tipopago
   JOIN pagos ON detalle_tipopago.id_pago::text = pagos.id_pago::text
   JOIN caja_cobrador ON pagos.id_caja_cob::text = caja_cobrador.id_caja_cob::text
   JOIN caja ON caja_cobrador.id_caja::text = caja.id_caja::text
   LEFT JOIN tipo_pago ON detalle_tipopago.id_tipo_pago::text = tipo_pago.id_tipo_pago::text
   LEFT JOIN banco ON banco.id_banco::text = detalle_tipopago.id_banco::text;

ALTER TABLE pagodeposito ADD id_tb character(10);




  -------------------------------------------------------------------28/04/2015----------------------------------------

INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (79, '1', '2015-04-28', 'HABILITAR COBRADOR', 'FALSE', 'PARA HABILITAR EL COBRADOR EN CONTRATO');

INSERT INTO parametros (id_param, id_franq, fecha_param, parametro, valor_param, obser_param) VALUES (80, '1', '2015-04-28', 'HABILITAR CANTIDAD DE SUSCRIPCION', 'FALSE', 'PARA ACTIVAR LA CANTIDAD EN SERVICIO SUSCRITO');



CREATE OR REPLACE VIEW vista_zona1 AS 
 SELECT zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, ciudad.status_ciudad, municipio.id_esta, municipio.nombre_mun, municipio.status_mun, estado.nombre_esta, estado.status_esta, zona.nro_zona,zona.n_zona
   FROM zona
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text
  ORDER BY zona.nombre_zona;

update zona set n_zona = substring(n_zona from 3 for 3);

CREATE OR REPLACE VIEW vista_ubica AS 
 SELECT calle.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, franquicia.id_franq, zona.nombre_zona, franquicia.nombre_franq, sector.id_franq AS id_pais, estado.nombre_esta,zona.n_zona
   FROM calle
   JOIN sector ON sector.id_sector::text = calle.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN franquicia ON sector.id_franq::text = franquicia.id_franq::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text;



CREATE OR REPLACE VIEW vista_contrato_auditoria AS 
 SELECT contrato.id_contrato, contrato.id_venta, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.telf_adic, contrato.direc_adicional, contrato.numero_casa, contrato.id_edif, contrato.numero_piso, contrato.id_urb, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, sector.id_franq, estado.nombre_esta, franquicia.nombre_franq, contrato.postel, contrato.pto, contrato.cod_id_persona, (vista_cobrador.nombre::text || ' '::text) || vista_cobrador.apellido::text AS cobrador, contrato.etiqueta_n, contrato.taps, contrato.tipo_fact, edificio.edificio, urbanizacion.nombre_urb AS urbanizacion, contrato.contrato_fisico, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac, contrato.observacion, statuscont.nombrestatus, contrato.contrato_imp, contrato.ultima_act, cliente.email, venta_contrato.id_persona, venta_contrato.id_serv AS id_serv_v, contrato.saldo, statuscont.color
   FROM contrato
   JOIN calle ON contrato.id_calle::text = calle.id_calle::text
   JOIN sector ON calle.id_sector::text = sector.id_sector::text
   JOIN zona ON sector.id_zona::text = zona.id_zona::text
   JOIN ciudad ON zona.id_ciudad::text = ciudad.id_ciudad::text
   JOIN municipio ON ciudad.id_mun::text = municipio.id_mun::text
   JOIN estado ON municipio.id_esta::text = estado.id_esta::text
   JOIN franquicia ON sector.id_franq::text = franquicia.id_franq::text
   JOIN cliente ON contrato.cli_id_persona::text = cliente.id_persona::text
   JOIN persona ON persona.id_persona::text = cliente.id_persona::text
   JOIN grupo_afinidad ON contrato.id_g_a::text = grupo_afinidad.id_g_a::text
   JOIN vista_cobrador ON vista_cobrador.id_persona::text = contrato.cod_id_persona::text
   JOIN statuscont ON statuscont.status_contrato::text = contrato.status_contrato::text
   LEFT JOIN edificio ON contrato.id_edif::text = edificio.id_edif::text
   LEFT JOIN urbanizacion ON contrato.id_urb::text = urbanizacion.id_urb::text
   LEFT JOIN venta_contrato ON contrato.id_venta::text = venta_contrato.id_venta::text;
