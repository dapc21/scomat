
DROP VIEW public.vistamodulo;
DROP VIEW public.vista_zona1;
DROP VIEW public.vista_vendedor;
DROP VIEW public.vista_urb;
DROP VIEW public.vista_ubicli;
DROP VIEW public.vista_tipopago;
DROP VIEW public.vista_tecnico;
DROP VIEW public.vista_tarifa;
DROP VIEW public.vista_sms;
DROP VIEW public.vista_servicio_status;
DROP VIEW public.vista_serv;
DROP VIEW public.vista_sector1;
DROP VIEW public.vista_resumen_orden;
DROP VIEW public.vista_reportemovimiento;
DROP VIEW public.vista_reporteinventario;
DROP VIEW public.vista_rep_orden;
DROP VIEW public.vista_reclamo;
DROP VIEW public.vista_recibos;
DROP VIEW public.vista_pser;
DROP VIEW public.vista_servicios;
DROP VIEW public.vista_ps_est;
DROP VIEW public.vista_promocion;
DROP VIEW public.vista_planillaped;
DROP VIEW public.vista_planillamov;
DROP VIEW public.vista_planillainv;
DROP VIEW public.vista_pedido;
DROP VIEW public.vista_para_cortar;
DROP VIEW public.vista_pagodeposito;
DROP VIEW public.vista_pago_ser;
DROP VIEW public.vista_pago_cont;
DROP VIEW public.vista_ordengrupo;
DROP VIEW public.vista_orden_rep_con;
DROP VIEW public.vista_orden_rep;
DROP VIEW public.vista_orden_imp;
DROP VIEW public.vista_orden;
DROP VIEW public.vista_orden;
DROP VIEW public.vista_notas;
DROP VIEW public.vista_ubica;
DROP VIEW public.vista_municipio;
DROP VIEW public.vista_movimiento_mov_mat_uni;
DROP VIEW public.vista_movimiento_mov_mat;
DROP VIEW public.vista_mov_materiales;
DROP VIEW public.vista_mov_mat_o;
DROP VIEW public.vista_modelo;
DROP VIEW public.vista_matped_und;
DROP VIEW public.vista_matped;
DROP VIEW public.vista_matpadre_und;
DROP VIEW public.vista_matpadre;
DROP VIEW public.vista_materialesuniinv;
DROP VIEW public.vista_materiales_unid;
DROP VIEW public.vista_materiales_prov;
DROP VIEW public.vista_materiales_orden;
DROP VIEW public.vista_materiales;
DROP VIEW public.vista_llamadas;
DROP VIEW public.vista_interfaz_equipo;
DROP VIEW public.vista_gt_tec_per;
DROP VIEW public.vista_grupoubicacion;
DROP VIEW public.vista_grupotecnico;
DROP VIEW public.vista_grupo;
DROP VIEW public.vista_gerentes;
DROP VIEW public.vista_franq;
DROP VIEW public.vista_equipo_sistema;
DROP VIEW public.vista_entidad;
DROP VIEW public.vista_edificio;
DROP VIEW public.vista_deudacli;
DROP VIEW public.vista_deuda;
DROP VIEW public.vista_detalleorden;
DROP VIEW public.vista_convenio;
DROP VIEW public.vista_contratoser;
DROP VIEW public.vista_contratorec;
DROP VIEW public.vista_contratodeu_f;
DROP VIEW public.vista_contratodeu1;
DROP VIEW public.vista_contratodeu;
DROP VIEW public.vista_contrato_todo;
DROP VIEW public.vista_contrato_status;
DROP VIEW public.vista_contrato_auditoria;
DROP VIEW public.vista_contrato1;
DROP VIEW public.vista_contrato_dir;
DROP VIEW public.vista_contrato;
DROP VIEW public.vista_cont_serv_temp;
DROP VIEW public.vista_cont_serv;
DROP VIEW public.vista_confcomision;
DROP VIEW public.vista_comisiones;
DROP VIEW public.vista_comentario;
DROP VIEW public.vista_cliente1;
DROP VIEW public.vista_cliente;
DROP VIEW public.vista_ciudad;
DROP VIEW public.vista_calle1;
DROP VIEW public.vista_caja;
DROP VIEW public.vista_cobrador;
DROP VIEW public.vista_asignarecibo;
DROP VIEW public.personausuario;
DROP VIEW public.pago_servicio;
DROP VIEW public.contrato_servicio_pagado;





--DROP VIEW public.vista_tiposerv;
--DROP VIEW public.vista_edificio1;

/*
ERROR:  no se puede eliminar tabla tipo_servicio columna id_franq porque otros objetos dependen de él
DETAIL:  vista vista_contratodeu depende de tabla tipo_servicio columna id_franq
vista vista_contratodeu1 depende de tabla tipo_servicio columna id_franq
vista vista_contratoser depende de tabla tipo_servicio columna id_franq
vista vista_servicios depende de tabla tipo_servicio columna id_franq
vista vista_pser depende de vista vista_servicios
vista vista_tarifa depende de vista vista_servicios
vista vista_tiposerv depende de tabla tipo_servicio columna id_franq
HINT:  Use DROP ... CASCADE para eliminar además los objetos dependientes.
*/



CREATE VIEW contrato_servicio_pagado AS
    SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, contrato_servicio_deuda.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, contrato_servicio_deuda.pagado AS costo_cobro, contrato_servicio_deuda.descu, contrato_servicio_deuda.modo_des FROM pago_factura, contrato_servicio_deuda WHERE (pago_factura.id_cont_serv = contrato_servicio_deuda.id_cont_serv);



CREATE VIEW pago_servicio AS
    SELECT pago_factura.id_cont_serv, pago_factura.id_pago FROM pago_factura;





CREATE VIEW personausuario AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, usuario.login, usuario.codigoperfil, usuario.password, usuario.statususuario, perfil.nombreperfil, perfil.descripcionperfil, perfil.statusperfil, usuario.id_franq, (SELECT franquicia.nombre_franq FROM franquicia WHERE (franquicia.id_franq = usuario.id_franq)) AS nombre_franq, usuario.id_servidor, (SELECT servidor.nombre_servidor FROM servidor WHERE (servidor.id_servidor = usuario.id_servidor)) AS nombre_servidor FROM persona, usuario, perfil WHERE ((persona.id_persona = usuario.id_persona) AND (usuario.codigoperfil = perfil.codigoperfil)) ORDER BY persona.cedula;
CREATE VIEW vista_asignarecibo AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, asigna_recibo.id_asig, asigna_recibo.id_cobrador, asigna_recibo.fecha_asig, asigna_recibo.obser_asig, asigna_recibo.login_asig, asigna_recibo.desde, asigna_recibo.hasta, asigna_recibo.cantidad, asigna_recibo.tipo FROM persona, asigna_recibo WHERE (persona.id_persona = asigna_recibo.id_cobrador);








ALTER TABLE public.vista_asignarecibo OWNER TO postgres;

--
-- TOC entry 337 (class 1259 OID 4579900)
-- Dependencies: 2944 6
-- Name: vista_cobrador; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_cobrador AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cobrador.nro_cobrador, cobrador.direccion_cob, cobrador.codcob, franquicia.id_franq, franquicia.nombre_franq FROM cobrador, persona, franquicia WHERE ((persona.id_persona = cobrador.id_persona) AND (franquicia.id_franq = cobrador.id_franq)) ORDER BY persona.cedula;


ALTER TABLE public.vista_cobrador OWNER TO postgres;

--
-- TOC entry 338 (class 1259 OID 4579904)
-- Dependencies: 2945 6
-- Name: vista_caja; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_caja AS
    SELECT caja_cobrador.id_caja_cob, caja_cobrador.id_caja, caja_cobrador.id_persona, caja_cobrador.fecha_caja, caja_cobrador.apertura_caja, caja_cobrador.cierre_caja, caja_cobrador.monto_acum, caja_cobrador.status_caja AS status_caja_cob, vista_cobrador.cedula, vista_cobrador.nombre, vista_cobrador.apellido, vista_cobrador.telefono, vista_cobrador.nro_cobrador, vista_cobrador.direccion_cob, caja.nombre_caja, caja.descripcion_caja, caja.status_caja, caja.inicial, caja.tipo_caja, caja.id_franq, caja.caja_externa, caja_cobrador.id_est, caja_cobrador.fecha_sugerida, estacion_trabajo.nombre_est FROM vista_cobrador, caja, caja_cobrador, estacion_trabajo WHERE (((caja_cobrador.id_caja = caja.id_caja) AND (caja_cobrador.id_persona = vista_cobrador.id_persona)) AND (caja_cobrador.id_est = estacion_trabajo.id_est));



CREATE VIEW vista_calle1 AS
    SELECT calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, ciudad.status_ciudad, municipio.id_esta, municipio.nombre_mun, sector.id_franq, estado.nombre_esta, franquicia.nombre_franq, calle.nro_calle FROM ((((((calle JOIN sector ON ((calle.id_sector = sector.id_sector))) JOIN zona ON ((sector.id_zona = zona.id_zona))) JOIN ciudad ON ((zona.id_ciudad = ciudad.id_ciudad))) JOIN municipio ON ((ciudad.id_mun = municipio.id_mun))) JOIN estado ON ((municipio.id_esta = estado.id_esta))) JOIN franquicia ON ((sector.id_franq = franquicia.id_franq))) ORDER BY zona.nombre_zona;


ALTER TABLE public.vista_calle1 OWNER TO postgres;

--
-- TOC entry 340 (class 1259 OID 4579914)
-- Dependencies: 2947 6
-- Name: vista_ciudad; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_ciudad AS
    SELECT ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, ciudad.status_ciudad, municipio.id_esta, municipio.nombre_mun, municipio.status_mun, estado.nombre_esta, estado.status_esta FROM ((ciudad JOIN municipio ON ((ciudad.id_mun = municipio.id_mun))) JOIN estado ON ((municipio.id_esta = estado.id_esta))) ORDER BY ciudad.id_ciudad;


ALTER TABLE public.vista_ciudad OWNER TO postgres;

--
-- TOC entry 341 (class 1259 OID 4579918)
-- Dependencies: 2948 6
-- Name: vista_cliente; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_cliente AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.email, cliente.telf_adic, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac FROM persona, cliente WHERE (persona.id_persona = cliente.id_persona) ORDER BY persona.cedula;


ALTER TABLE public.vista_cliente OWNER TO postgres;

--
-- TOC entry 342 (class 1259 OID 4579922)
-- Dependencies: 2949 6
-- Name: vista_cliente1; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_cliente1 AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.email, cliente.telf_adic, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac FROM (cliente JOIN persona ON ((persona.id_persona = cliente.id_persona))) ORDER BY persona.cedula;


ALTER TABLE public.vista_cliente1 OWNER TO postgres;

--
-- TOC entry 343 (class 1259 OID 4579926)
-- Dependencies: 2950 6
-- Name: vista_comentario; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_comentario AS
    SELECT comentario_cliente.id_comen, comentario_cliente.id_persona, comentario_cliente.nro_comen, comentario_cliente.fecha_comen, comentario_cliente.hora_comen, comentario_cliente.comentario, comentario_cliente.status_comen, vista_cliente.cedula, vista_cliente.nombre, vista_cliente.apellido, vista_cliente.telefono, vista_cliente.telf_casa, vista_cliente.email FROM vista_cliente, comentario_cliente WHERE (comentario_cliente.id_persona = vista_cliente.id_persona) ORDER BY vista_cliente.cedula;


ALTER TABLE public.vista_comentario OWNER TO postgres;

--
-- TOC entry 344 (class 1259 OID 4579930)
-- Dependencies: 2951 6
-- Name: vista_comisiones; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_comisiones AS
    SELECT pago_comisiones.id_comi, pago_comisiones.id_persona, pago_comisiones.comi_para, pago_comisiones.fecha_comi, pago_comisiones.fecha_desde, pago_comisiones.fecha_hasta, pago_comisiones.porcent_aplic, pago_comisiones.monto_comi, pago_comisiones.status_comi, persona.cedula, persona.nombre, persona.apellido, persona.telefono FROM persona, pago_comisiones WHERE (pago_comisiones.id_persona = persona.id_persona);


ALTER TABLE public.vista_comisiones OWNER TO postgres;

--
-- TOC entry 345 (class 1259 OID 4579934)
-- Dependencies: 2952 6
-- Name: vista_confcomision; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_confcomision AS
    SELECT franquicia.id_franq, franquicia.nombre_franq, franquicia.id_emp, franquicia.id_gf, franquicia.obser_franq, franquicia.direccion_franq, franquicia.serie, conf_comision.id_confc, conf_comision.fecha_confc, conf_comision.status_confc, conf_comision.porc_acord, conf_comision.porc_com_reca, conf_comision.porc_com_venta, conf_comision.porc_ret_iva, conf_comision.porc_ret_islr, conf_comision.descuento_conf, conf_comision.tipo_e_p, conf_comision.empresa_confc, conf_comision.rif_empresa, conf_comision.represen_confc, conf_comision.cedula_rep, conf_comision.desc_confc FROM franquicia, conf_comision WHERE (franquicia.id_franq = conf_comision.id_franq) ORDER BY franquicia.nombre_franq;


ALTER TABLE public.vista_confcomision OWNER TO postgres;

--
-- TOC entry 430 (class 1259 OID 4583410)
-- Dependencies: 3035 6
-- Name: vista_cont_serv; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_cont_serv AS
    SELECT contrato_servicio.id_cont_serv, contrato_servicio.id_serv, contrato_servicio.id_contrato, contrato_servicio.fecha_inst, contrato_servicio.cant_serv, contrato_servicio.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, tipo_servicio.tipo_servicio, contrato_servicio.costo_cobro, servicios.tipo_paq FROM contrato_servicio, tipo_servicio, servicios WHERE ((contrato_servicio.id_serv = servicios.id_serv) AND (servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio));


ALTER TABLE public.vista_cont_serv OWNER TO postgres;

--
-- TOC entry 346 (class 1259 OID 4579939)
-- Dependencies: 2953 6
-- Name: vista_cont_serv_temp; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_cont_serv_temp AS
    SELECT contrato_servicio_temp.id_cont_serv, contrato_servicio_temp.id_serv, contrato_servicio_temp.id_contrato, contrato_servicio_temp.fecha_inst, contrato_servicio_temp.cant_serv, contrato_servicio_temp.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, tipo_servicio.tipo_servicio, contrato_servicio_temp.costo_cobro, servicios.tipo_paq FROM contrato_servicio_temp, tipo_servicio, servicios WHERE ((contrato_servicio_temp.id_serv = servicios.id_serv) AND (servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio));


ALTER TABLE public.vista_cont_serv_temp OWNER TO postgres;

--
-- TOC entry 347 (class 1259 OID 4579943)
-- Dependencies: 2954 6
-- Name: vista_contrato; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contrato AS
    SELECT contrato.id_contrato, contrato.id_calle, contrato.id_venta, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.observacion, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.email, contrato.direc_adicional, contrato.numero_casa, calle.id_sector, calle.nro_calle, calle.nombre_calle, sector.id_zona, sector.nro_sector, sector.nombre_sector, franquicia.id_franq, zona.nro_zona, zona.nombre_zona, franquicia.nombre_franq, franquicia.id_emp, franquicia.id_gf, franquicia.obser_franq, franquicia.direccion_franq, contrato.id_edif, contrato.numero_piso, cliente.telf_adic, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac, contrato.deuda, contrato.postel, contrato.taps, contrato.pto, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, contrato.id_urb, zona.id_ciudad, contrato.cod_id_persona, contrato.contrato_fisico, contrato.etiqueta_n, contrato.tipo_fact, contrato.contrato_imp, contrato.ultima_act FROM contrato, cliente, persona, calle, sector, zona, franquicia, ciudad, municipio, estado, grupo_afinidad WHERE ((((((((((persona.id_persona = cliente.id_persona) AND (contrato.cli_id_persona = cliente.id_persona)) AND (contrato.id_calle = calle.id_calle)) AND (calle.id_sector = sector.id_sector)) AND (sector.id_zona = zona.id_zona)) AND (zona.id_ciudad = ciudad.id_ciudad)) AND (contrato.id_g_a = grupo_afinidad.id_g_a)) AND (ciudad.id_mun = municipio.id_mun)) AND (municipio.id_esta = estado.id_esta)) AND (sector.id_franq = franquicia.id_franq)) ORDER BY contrato.nro_contrato;


ALTER TABLE public.vista_contrato OWNER TO postgres;

--
-- TOC entry 348 (class 1259 OID 4579948)
-- Dependencies: 2955 6
-- Name: vista_contrato_dir; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contrato_dir AS
    SELECT contrato.id_contrato, calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, sector.id_franq, estado.nombre_esta, franquicia.nombre_franq FROM contrato, sector, zona, ciudad, franquicia, municipio, estado, calle WHERE (((((((contrato.id_calle = calle.id_calle) AND (calle.id_sector = sector.id_sector)) AND (sector.id_zona = zona.id_zona)) AND (zona.id_ciudad = ciudad.id_ciudad)) AND (ciudad.id_mun = municipio.id_mun)) AND (municipio.id_esta = estado.id_esta)) AND (sector.id_franq = franquicia.id_franq));


ALTER TABLE public.vista_contrato_dir OWNER TO postgres;

--
-- TOC entry 349 (class 1259 OID 4579953)
-- Dependencies: 2956 6
-- Name: vista_contrato1; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contrato1 AS
    SELECT contrato.id_contrato, contrato.id_calle, contrato.id_venta, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.observacion, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.email, contrato.direc_adicional, contrato.numero_casa, vista_contrato_dir.id_sector, vista_contrato_dir.nombre_calle, vista_contrato_dir.id_zona, vista_contrato_dir.nombre_sector, vista_contrato_dir.id_franq, vista_contrato_dir.nombre_zona, vista_contrato_dir.id_esta, vista_contrato_dir.nombre_esta, vista_contrato_dir.id_ciudad, vista_contrato_dir.nombre_ciudad, vista_contrato_dir.nombre_mun, vista_contrato_dir.id_mun, vista_contrato_dir.nombre_franq, contrato.id_edif, contrato.numero_piso, cliente.telf_adic, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac, contrato.deuda, contrato.postel, contrato.taps, contrato.pto, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, contrato.id_urb FROM contrato, cliente, persona, vista_contrato_dir, grupo_afinidad WHERE ((((persona.id_persona = cliente.id_persona) AND (contrato.cli_id_persona = cliente.id_persona)) AND (contrato.id_calle = vista_contrato_dir.id_calle)) AND (contrato.id_g_a = grupo_afinidad.id_g_a)) ORDER BY contrato.nro_contrato;


ALTER TABLE public.vista_contrato1 OWNER TO postgres;

--
-- TOC entry 350 (class 1259 OID 4579958)
-- Dependencies: 2957 6
-- Name: vista_contrato_auditoria; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contrato_auditoria AS
    SELECT contrato.id_contrato, contrato.id_venta, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.telf_adic, contrato.direc_adicional, contrato.numero_casa, contrato.id_edif, contrato.numero_piso, contrato.id_urb, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, sector.id_franq, estado.nombre_esta, franquicia.nombre_franq, contrato.postel, contrato.pto, contrato.cod_id_persona, (((vista_cobrador.nombre)::text || ' '::text) || (vista_cobrador.apellido)::text) AS cobrador, contrato.etiqueta_n, contrato.taps, contrato.tipo_fact, edificio.edificio, urbanizacion.nombre_urb AS urbanizacion, contrato.contrato_fisico, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac, contrato.observacion, statuscont.nombrestatus, contrato.contrato_imp, contrato.ultima_act, cliente.email, venta_contrato.id_persona, venta_contrato.id_serv AS id_serv_v FROM (((((((((((((((contrato JOIN calle ON ((contrato.id_calle = calle.id_calle))) JOIN sector ON ((calle.id_sector = sector.id_sector))) JOIN zona ON ((sector.id_zona = zona.id_zona))) JOIN ciudad ON ((zona.id_ciudad = ciudad.id_ciudad))) JOIN municipio ON ((ciudad.id_mun = municipio.id_mun))) JOIN estado ON ((municipio.id_esta = estado.id_esta))) JOIN franquicia ON ((sector.id_franq = franquicia.id_franq))) JOIN cliente ON ((contrato.cli_id_persona = cliente.id_persona))) JOIN persona ON ((persona.id_persona = cliente.id_persona))) JOIN grupo_afinidad ON ((contrato.id_g_a = grupo_afinidad.id_g_a))) JOIN vista_cobrador ON ((vista_cobrador.id_persona = contrato.cod_id_persona))) JOIN statuscont ON ((statuscont.status_contrato = contrato.status_contrato))) LEFT JOIN edificio ON ((contrato.id_edif = edificio.id_edif))) LEFT JOIN urbanizacion ON ((contrato.id_urb = urbanizacion.id_urb))) LEFT JOIN venta_contrato ON ((contrato.id_venta = venta_contrato.id_venta)));


ALTER TABLE public.vista_contrato_auditoria OWNER TO postgres;

--
-- TOC entry 351 (class 1259 OID 4579963)
-- Dependencies: 2958 854 6
-- Name: vista_contrato_status; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contrato_status AS
    SELECT contrato.id_contrato, contrato.*::contrato AS contrato, contrato.status_contrato, calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, sector.id_franq, estado.nombre_esta, franquicia.nombre_franq FROM contrato, sector, zona, ciudad, franquicia, municipio, estado, calle WHERE (((((((contrato.id_calle = calle.id_calle) AND (calle.id_sector = sector.id_sector)) AND (sector.id_zona = zona.id_zona)) AND (zona.id_ciudad = ciudad.id_ciudad)) AND (ciudad.id_mun = municipio.id_mun)) AND (municipio.id_esta = estado.id_esta)) AND (sector.id_franq = franquicia.id_franq));


ALTER TABLE public.vista_contrato_status OWNER TO postgres;

--
-- TOC entry 352 (class 1259 OID 4579968)
-- Dependencies: 2959 6
-- Name: vista_contrato_todo; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contrato_todo AS
    SELECT contrato.id_contrato, contrato.id_calle, contrato.id_venta, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.observacion, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.email, contrato.direc_adicional, contrato.numero_casa, calle.id_sector, calle.nro_calle, calle.nombre_calle, sector.id_zona, sector.nro_sector, sector.nombre_sector, franquicia.id_franq, zona.nro_zona, zona.nombre_zona, franquicia.nombre_franq, franquicia.id_emp, franquicia.id_gf, franquicia.obser_franq, franquicia.direccion_franq, contrato.id_edif, contrato.numero_piso, cliente.telf_adic, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac, contrato.deuda, contrato.postel, contrato.taps, contrato.pto, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, contrato.id_urb, zona.id_ciudad, contrato.cod_id_persona FROM contrato, cliente, persona, calle, sector, zona, franquicia, ciudad, municipio, estado, grupo_afinidad WHERE ((((((((((persona.id_persona = cliente.id_persona) AND (contrato.cli_id_persona = cliente.id_persona)) AND (contrato.id_calle = calle.id_calle)) AND (calle.id_sector = sector.id_sector)) AND (sector.id_zona = zona.id_zona)) AND (zona.id_ciudad = ciudad.id_ciudad)) AND (contrato.id_g_a = grupo_afinidad.id_g_a)) AND (ciudad.id_mun = municipio.id_mun)) AND (municipio.id_esta = estado.id_esta)) AND (sector.id_franq = franquicia.id_franq)) ORDER BY contrato.nro_contrato;


ALTER TABLE public.vista_contrato_todo OWNER TO postgres;

--
-- TOC entry 353 (class 1259 OID 4579973)
-- Dependencies: 2960 6
-- Name: vista_contratodeu; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contratodeu AS
    SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, contrato_servicio_deuda.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, tipo_servicio.tipo_servicio, tipo_servicio.status_servicio,  contrato.costo_dif_men, contrato.nro_contrato, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, servicios.tipo_costo, contrato_servicio_deuda.costo_cobro, contrato.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, zona.nombre_zona, contrato.status_contrato, contrato_servicio_deuda.descu, contrato_servicio_deuda.inc, servicios.tipo_serv FROM contrato_servicio_deuda, tipo_servicio, servicios, contrato, cliente, persona, calle, sector, zona WHERE ((((((((contrato_servicio_deuda.id_serv = servicios.id_serv) AND (servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio)) AND (contrato_servicio_deuda.id_contrato = contrato.id_contrato)) AND (persona.id_persona = cliente.id_persona)) AND (contrato.cli_id_persona = cliente.id_persona)) AND (contrato.id_calle = calle.id_calle)) AND (calle.id_sector = sector.id_sector)) AND (sector.id_zona = zona.id_zona)) ORDER BY contrato_servicio_deuda.id_cont_serv;


ALTER TABLE public.vista_contratodeu OWNER TO postgres;

--
-- TOC entry 354 (class 1259 OID 4579978)
-- Dependencies: 2961 6
-- Name: vista_contratodeu1; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contratodeu1 AS
    SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, contrato_servicio_deuda.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, tipo_servicio.tipo_servicio, tipo_servicio.status_servicio,  contrato_servicio_deuda.costo_cobro FROM contrato_servicio_deuda, tipo_servicio, servicios WHERE ((contrato_servicio_deuda.id_serv = servicios.id_serv) AND (servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio)) ORDER BY contrato_servicio_deuda.fecha_inst;


ALTER TABLE public.vista_contratodeu1 OWNER TO postgres;

--
-- TOC entry 355 (class 1259 OID 4579982)
-- Dependencies: 2962 6
-- Name: vista_contratodeu_f; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contratodeu_f AS
    SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, contrato_servicio_deuda.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, tipo_servicio.tipo_servicio, servicios.tipo_costo, contrato_servicio_deuda.costo_cobro, contrato_servicio_deuda.descu, contrato_servicio_deuda.inc, contrato_servicio_deuda.apagar, pagos.id_pago, pagos.nro_factura, servicios.tipo_serv, pagos.tipo_doc, pagos.status_pago, contrato_servicio_deuda.pagado FROM pagos, contrato_servicio_deuda, tipo_servicio, servicios WHERE (((contrato_servicio_deuda.id_serv = servicios.id_serv) AND (servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio)) AND (contrato_servicio_deuda.id_pago = pagos.id_pago)) ORDER BY contrato_servicio_deuda.inc;


ALTER TABLE public.vista_contratodeu_f OWNER TO postgres;

--
-- TOC entry 356 (class 1259 OID 4579987)
-- Dependencies: 2963 6
-- Name: vista_contratorec; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contratorec AS
    SELECT vista_contrato.id_contrato, vista_contrato.id_calle, vista_contrato.id_venta, vista_contrato.cli_id_persona, vista_contrato.nro_contrato, vista_contrato.fecha_contrato, vista_contrato.observacion, vista_contrato.etiqueta, vista_contrato.costo_dif_men, vista_contrato.status_contrato, vista_contrato.cedula, vista_contrato.nombre, vista_contrato.apellido, vista_contrato.telefono, vista_contrato.telf_casa, vista_contrato.email, vista_contrato.direc_adicional, vista_contrato.numero_casa, vista_contrato.id_sector, vista_contrato.nro_calle, vista_contrato.nombre_calle, vista_contrato.id_zona, vista_contrato.nro_sector, vista_contrato.nombre_sector, vista_contrato.id_franq, vista_contrato.nro_zona, vista_contrato.nombre_zona, vista_contrato.nombre_franq, vista_contrato.id_emp, vista_contrato.id_gf, vista_contrato.obser_franq, vista_contrato.direccion_franq, vista_contrato.id_edif, vista_contrato.numero_piso, vista_contrato.telf_adic, vista_contrato.tipo_cliente, vista_contrato.inicial_doc, vista_contrato.fecha_nac, recuperado.fecha_rec, vista_contrato.deuda FROM recuperado, vista_contrato WHERE (vista_contrato.id_contrato = recuperado.id_contrato) ORDER BY vista_contrato.id_contrato, recuperado.fecha_rec;


ALTER TABLE public.vista_contratorec OWNER TO postgres;

--
-- TOC entry 357 (class 1259 OID 4579992)
-- Dependencies: 2964 6
-- Name: vista_contratoser; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contratoser AS
    SELECT contrato_servicio.id_cont_serv, contrato_servicio.id_serv, contrato_servicio.id_contrato, contrato_servicio.fecha_inst, contrato_servicio.cant_serv, contrato_servicio.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, tipo_servicio.tipo_servicio, tipo_servicio.status_servicio, tarifa_servicio.id_tar_ser, tarifa_servicio.fecha_tar_ser, tarifa_servicio.status_tarifa_ser, tarifa_servicio.tarifa_ser, contrato.costo_dif_men, contrato.nro_contrato, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, servicios.tipo_costo, contrato_servicio.costo_cobro, contrato.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, zona.nombre_zona, contrato.status_contrato FROM contrato_servicio, tarifa_servicio, tipo_servicio, servicios, contrato, cliente, persona, calle, sector, zona WHERE ((((((((((contrato_servicio.id_serv = servicios.id_serv) AND (tarifa_servicio.id_serv = servicios.id_serv)) AND (servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio))  AND (contrato_servicio.id_contrato = contrato.id_contrato)) AND (tarifa_servicio.status_tarifa_ser = 'ACTIVO'::bpchar)) AND (persona.id_persona = cliente.id_persona)) AND (contrato.cli_id_persona = cliente.id_persona)) AND (contrato.id_calle = calle.id_calle)) AND (calle.id_sector = sector.id_sector)) AND (sector.id_zona = zona.id_zona)) ORDER BY contrato_servicio.id_cont_serv;


ALTER TABLE public.vista_contratoser OWNER TO postgres;

--
-- TOC entry 358 (class 1259 OID 4579997)
-- Dependencies: 2965 6
-- Name: vista_convenio; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_convenio AS
    SELECT servicios.id_serv, servicios.nombre_servicio, conv_con.id_conv_cont, conv_con.id_conv, conv_con.id_cont_serv, conv_con.fecha_ven, conv_con.fecha_inst, conv_con.status_con_ser, conv_con.costo_cobro, convenio_pago.dato, convenio_pago.fecha_conv, convenio_pago.obser_conv, convenio_pago.login, convenio_pago.status_conv, convenio_pago.id_contrato FROM ((servicios JOIN conv_con ON ((servicios.id_serv = conv_con.id_serv))) JOIN convenio_pago ON ((convenio_pago.id_conv = conv_con.id_conv)));


ALTER TABLE public.vista_convenio OWNER TO postgres;

--
-- TOC entry 359 (class 1259 OID 4580002)
-- Dependencies: 2966 6
-- Name: vista_detalleorden; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_detalleorden AS
    SELECT detalle_orden.id_det_orden, detalle_orden.id_tipo_orden, detalle_orden.nombre_det_orden, tipo_orden.nombre_tipo_orden, detalle_orden.tipo_detalle, tipo_orden.status_tipord FROM detalle_orden, tipo_orden WHERE (detalle_orden.id_tipo_orden = tipo_orden.id_tipo_orden);


ALTER TABLE public.vista_detalleorden OWNER TO postgres;

--
-- TOC entry 360 (class 1259 OID 4580006)
-- Dependencies: 2967 6
-- Name: vista_deuda; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_deuda AS
    SELECT contrato_servicio_deuda.id_contrato, servicios.id_serv, servicios.id_tipo_servicio, ((((contrato_servicio_deuda.cant_serv)::numeric * contrato_servicio_deuda.costo_cobro) - contrato_servicio_deuda.descu) - contrato_servicio_deuda.pagado) AS deuda, contrato_servicio_deuda.fecha_inst FROM contrato_servicio_deuda, servicios WHERE (((contrato_servicio_deuda.id_serv = servicios.id_serv) AND (contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar)) AND (((((contrato_servicio_deuda.cant_serv)::numeric * contrato_servicio_deuda.costo_cobro) - contrato_servicio_deuda.descu) - contrato_servicio_deuda.pagado) > (0)::numeric));


ALTER TABLE public.vista_deuda OWNER TO postgres;

--
-- TOC entry 361 (class 1259 OID 4580010)
-- Dependencies: 2968 6
-- Name: vista_deudacli; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_deudacli AS
    SELECT contrato.id_contrato, calle.id_calle, calle.id_sector, sector.id_zona, contrato.status_contrato, (SELECT sum(((contrato_servicio_deuda.cant_serv)::numeric * contrato_servicio_deuda.costo_cobro)) AS sum FROM contrato_servicio_deuda WHERE ((contrato_servicio_deuda.id_contrato = contrato.id_contrato) AND (contrato_servicio_deuda.status_con_ser = 'DEUDA'::bpchar))) AS deuda, (SELECT sum(contrato_servicio_deuda.pagado) AS sum FROM contrato_servicio_deuda WHERE ((contrato_servicio_deuda.id_contrato = contrato.id_contrato) AND (contrato_servicio_deuda.status_con_ser = 'PAGADO'::bpchar))) AS pagado FROM calle, contrato, sector WHERE ((calle.id_calle = contrato.id_calle) AND (calle.id_sector = sector.id_sector)) ORDER BY contrato.id_contrato;


ALTER TABLE public.vista_deudacli OWNER TO postgres;

--
-- TOC entry 362 (class 1259 OID 4580015)
-- Dependencies: 2969 6
-- Name: vista_edificio; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_edificio AS
    SELECT edificio.id_edif, edificio.edificio, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, ciudad.status_ciudad, municipio.id_esta, municipio.nombre_mun, municipio.status_mun, sector.id_franq, estado.nombre_esta, estado.status_esta, franquicia.nombre_franq FROM ((((((edificio JOIN sector ON ((edificio.id_sector = sector.id_sector))) JOIN zona ON ((sector.id_zona = zona.id_zona))) JOIN ciudad ON ((zona.id_ciudad = ciudad.id_ciudad))) JOIN municipio ON ((ciudad.id_mun = municipio.id_mun))) JOIN estado ON ((municipio.id_esta = estado.id_esta))) JOIN franquicia ON ((sector.id_franq = franquicia.id_franq)));



CREATE VIEW vista_entidad AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, entidad.id_te, entidad.descrip_ent, entidad.status_ent, tipo_entidad.nombre_te, tipo_entidad.status_te FROM persona, entidad, tipo_entidad WHERE ((persona.id_persona = entidad.id_persona) AND (entidad.id_te = tipo_entidad.id_te)) ORDER BY persona.cedula;


ALTER TABLE public.vista_entidad OWNER TO postgres;

--
-- TOC entry 365 (class 1259 OID 4580029)
-- Dependencies: 2972 6
-- Name: vista_equipo_sistema; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_equipo_sistema AS
    SELECT contrato.id_contrato, contrato.nro_contrato, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, equipo_sistema.id_es, modelo.id_modelo, equipo_sistema.codigo_es, equipo_sistema.status_es, equipo_sistema.codigo_adic, equipo_sistema.estado_fisico, modelo.nombre_modelo, tipo_sist_equipo.id_tse, tipo_sist_equipo.abrev_nombre_tse AS sistema FROM (((((equipo_sistema JOIN modelo ON ((equipo_sistema.id_modelo = modelo.id_modelo))) JOIN tipo_sist_equipo ON ((modelo.id_tse = tipo_sist_equipo.id_tse))) LEFT JOIN contrato ON ((contrato.id_contrato = equipo_sistema.id_contrato))) LEFT JOIN cliente ON ((contrato.cli_id_persona = cliente.id_persona))) LEFT JOIN persona ON ((persona.id_persona = cliente.id_persona)));


ALTER TABLE public.vista_equipo_sistema OWNER TO postgres;

--
-- TOC entry 427 (class 1259 OID 4580312)
-- Dependencies: 3034 6
-- Name: vista_franq; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_franq AS
    SELECT franquicia.id_franq, franquicia.nombre_franq, franquicia.id_emp, franquicia.obser_franq, franquicia.direccion_franq, franquicia.serie, franquicia.id_gf, grupo_franq.nombre_gf, empresa.rif_emp, empresa.razon_social_emp, empresa.nombre_comercial_emp FROM ((franquicia JOIN grupo_franq ON ((franquicia.id_gf = grupo_franq.id_gf))) JOIN empresa ON ((franquicia.id_emp = empresa.id_emp)));


ALTER TABLE public.vista_franq OWNER TO postgres;

--
-- TOC entry 366 (class 1259 OID 4580034)
-- Dependencies: 2973 6
-- Name: vista_gerentes; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_gerentes AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, gerentes_permitidos.nro_gerente, gerentes_permitidos.tipo_gerente, gerentes_permitidos.cargo_gerente, gerentes_permitidos.descrip_gerente, gerentes_permitidos.sattus_gerente, gerentes_permitidos.correo_gerente, gerentes_permitidos.id_franq FROM persona, gerentes_permitidos WHERE (persona.id_persona = gerentes_permitidos.id_persona) ORDER BY persona.cedula;


ALTER TABLE public.vista_gerentes OWNER TO postgres;

--
-- TOC entry 367 (class 1259 OID 4580038)
-- Dependencies: 2974 6
-- Name: vista_grupo; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_grupo AS
    SELECT grupo_trabajo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.hora_creacion, grupo_trabajo.id_zona, grupo_trabajo.nombre_grupo, grupo_trabajo.status_grupo, (SELECT count(*) AS count FROM grupo_tecnico WHERE (grupo_trabajo.id_gt = grupo_tecnico.id_gt)) AS nro_tecnico, (SELECT count(*) AS count FROM grupo_ubicacion WHERE (grupo_trabajo.id_gt = grupo_ubicacion.id_gt)) AS nro_sector, franquicia.id_franq, franquicia.nombre_franq FROM grupo_trabajo, franquicia WHERE (franquicia.id_franq = grupo_trabajo.id_franq);


ALTER TABLE public.vista_grupo OWNER TO postgres;

--
-- TOC entry 368 (class 1259 OID 4580042)
-- Dependencies: 2975 6
-- Name: vista_grupotecnico; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_grupotecnico AS
    SELECT tecnico.id_persona, grupo_tecnico.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.nombre_grupo, grupo_trabajo.status_grupo, persona.cedula, persona.nombre, persona.apellido FROM tecnico, grupo_tecnico, grupo_trabajo, persona WHERE (((tecnico.id_persona = persona.id_persona) AND (tecnico.id_persona = grupo_tecnico.id_persona)) AND (grupo_tecnico.id_gt = grupo_trabajo.id_gt));


ALTER TABLE public.vista_grupotecnico OWNER TO postgres;

--
-- TOC entry 369 (class 1259 OID 4580046)
-- Dependencies: 2976 6
-- Name: vista_grupoubicacion; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_grupoubicacion AS
    SELECT sector.id_sector, sector.id_zona, sector.nro_sector, sector.nombre_sector, sector.n_sector, sector.afiliacion, sector.id_franq, zona.nro_zona, zona.nombre_zona, zona.n_zona, grupo_trabajo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.hora_creacion, grupo_trabajo.nombre_grupo, grupo_trabajo.status_grupo FROM sector, zona, grupo_trabajo, grupo_ubicacion WHERE (((sector.id_sector = grupo_ubicacion.id_sector) AND (sector.id_zona = zona.id_zona)) AND (grupo_trabajo.id_gt = grupo_ubicacion.id_gt)) ORDER BY sector.nombre_sector;


ALTER TABLE public.vista_grupoubicacion OWNER TO postgres;

--
-- TOC entry 370 (class 1259 OID 4580050)
-- Dependencies: 2977 6
-- Name: vista_gt_tec_per; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_gt_tec_per AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, tecnico.num_tecnico, tecnico.direccion_tec, tecnico.correo_tec, tecnico.status_tec, grupo_trabajo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.hora_creacion, grupo_trabajo.id_zona, grupo_trabajo.nombre_grupo FROM persona, tecnico, grupo_tecnico, grupo_trabajo WHERE (((persona.id_persona = tecnico.id_persona) AND (tecnico.id_persona = grupo_tecnico.id_persona)) AND (grupo_trabajo.id_gt = grupo_tecnico.id_gt)) ORDER BY persona.nombre;


ALTER TABLE public.vista_gt_tec_per OWNER TO postgres;

--
-- TOC entry 371 (class 1259 OID 4580054)
-- Dependencies: 2978 6
-- Name: vista_interfaz_equipo; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_interfaz_equipo AS
    SELECT contrato.id_contrato, contrato.nro_contrato, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, equipo_sistema.id_es, modelo.id_modelo, equipo_sistema.codigo_es, equipo_sistema.status_es, equipo_sistema.codigo_adic, equipo_sistema.estado_fisico, modelo.nombre_modelo, tipo_sist_equipo.id_tse, tipo_sist_equipo.abrev_nombre_tse AS sistema, comandos_interfaz.id_com_int, comandos_interfaz.nombre_com_int, interfaz_equipos.id_inte, interfaz_equipos.status, interfaz_equipos.fecha, interfaz_equipos.login, interfaz_equipos.errmsg, interfaz_equipos.fecha_ejec FROM (((((((equipo_sistema JOIN interfaz_equipos ON ((interfaz_equipos.id_es = equipo_sistema.id_es))) JOIN comandos_interfaz ON ((interfaz_equipos.id_com_int = comandos_interfaz.id_com_int))) JOIN modelo ON ((equipo_sistema.id_modelo = modelo.id_modelo))) JOIN tipo_sist_equipo ON ((modelo.id_tse = tipo_sist_equipo.id_tse))) LEFT JOIN contrato ON ((contrato.id_contrato = equipo_sistema.id_contrato))) LEFT JOIN cliente ON ((contrato.cli_id_persona = cliente.id_persona))) LEFT JOIN persona ON ((persona.id_persona = cliente.id_persona)));


ALTER TABLE public.vista_interfaz_equipo OWNER TO postgres;

--
-- TOC entry 372 (class 1259 OID 4580059)
-- Dependencies: 2979 6
-- Name: vista_llamadas; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_llamadas AS
    SELECT tipo_llamada.dato, tipo_llamada.id_tll, tipo_llamada.nombre_tll, tipo_llamada.status_tll, llamadas.id_lla, llamadas.id_drl, llamadas.id_contrato, llamadas.fecha_lla, llamadas.hora_lla, llamadas.login, llamadas.obser_lla, llamadas.crea_alarma, detalle_resp.id_trl, detalle_resp.nombre_drl, detalle_resp.status_drl, tipo_resp.nombre_trl, tipo_resp.status_trl, vista_contrato_auditoria.id_venta, vista_contrato_auditoria.cli_id_persona, vista_contrato_auditoria.nro_contrato, vista_contrato_auditoria.fecha_contrato, vista_contrato_auditoria.etiqueta, vista_contrato_auditoria.costo_dif_men, vista_contrato_auditoria.status_contrato, vista_contrato_auditoria.cedula, vista_contrato_auditoria.nombre, vista_contrato_auditoria.apellido, vista_contrato_auditoria.telefono, vista_contrato_auditoria.telf_casa, vista_contrato_auditoria.telf_adic, vista_contrato_auditoria.direc_adicional, vista_contrato_auditoria.numero_casa, vista_contrato_auditoria.id_edif, vista_contrato_auditoria.numero_piso, vista_contrato_auditoria.id_urb, vista_contrato_auditoria.id_g_a, vista_contrato_auditoria.nombre_g_a, vista_contrato_auditoria.id_calle, vista_contrato_auditoria.nombre_calle, vista_contrato_auditoria.id_sector, vista_contrato_auditoria.nombre_sector, vista_contrato_auditoria.id_zona, vista_contrato_auditoria.nombre_zona, vista_contrato_auditoria.id_ciudad, vista_contrato_auditoria.id_mun, vista_contrato_auditoria.nombre_ciudad, vista_contrato_auditoria.id_esta, vista_contrato_auditoria.nombre_mun, vista_contrato_auditoria.id_franq, vista_contrato_auditoria.nombre_esta, vista_contrato_auditoria.nombre_franq, vista_contrato_auditoria.postel, vista_contrato_auditoria.pto, vista_contrato_auditoria.cod_id_persona, vista_contrato_auditoria.cobrador, vista_contrato_auditoria.etiqueta_n, vista_contrato_auditoria.taps, vista_contrato_auditoria.tipo_fact FROM tipo_llamada, llamadas, detalle_resp, tipo_resp, vista_contrato_auditoria WHERE ((((tipo_llamada.id_tll = llamadas.id_tll) AND (llamadas.id_drl = detalle_resp.id_drl)) AND (detalle_resp.id_trl = tipo_resp.id_trl)) AND (llamadas.id_contrato = vista_contrato_auditoria.id_contrato)) ORDER BY llamadas.fecha_lla DESC, llamadas.hora_lla DESC;


ALTER TABLE public.vista_llamadas OWNER TO postgres;

--
-- TOC entry 373 (class 1259 OID 4580064)
-- Dependencies: 2980 6
-- Name: vista_materiales; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_materiales AS
    SELECT materiales.id_mat, materiales.id_dep, materiales.stock, materiales.stock_min, materiales.observacion, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.id_unidad, mat_padre.uni_id_unidad, mat_padre.id_fam, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, familia.nombre_fam, familia.status_fam, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, mat_padre.impresion, deposito.id_franq FROM unidad_medida, materiales, deposito, familia, mat_padre WHERE ((((materiales.id_dep = deposito.id_dep) AND (mat_padre.id_unidad = unidad_medida.id_unidad)) AND (materiales.id_m = mat_padre.id_m)) AND (mat_padre.id_fam = familia.id_fam)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_materiales OWNER TO postgres;

--
-- TOC entry 374 (class 1259 OID 4580069)
-- Dependencies: 2981 6
-- Name: vista_materiales_orden; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_materiales_orden AS
    SELECT materiales.id_mat, materiales.id_dep, materiales.stock, materiales.stock_min, materiales.observacion, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.id_unidad, mat_padre.uni_id_unidad, mat_padre.id_fam, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, familia.nombre_fam, familia.status_fam, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, mat_padre.impresion FROM unidad_medida, materiales, deposito, familia, mat_padre WHERE ((((materiales.id_dep = deposito.id_dep) AND (mat_padre.id_unidad = unidad_medida.id_unidad)) AND (materiales.id_m = mat_padre.id_m)) AND (mat_padre.id_fam = familia.id_fam)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_materiales_orden OWNER TO postgres;

--
-- TOC entry 375 (class 1259 OID 4580074)
-- Dependencies: 2982 6
-- Name: vista_materiales_prov; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_materiales_prov AS
    SELECT pedido.id_prov, materiales.id_mat, materiales.id_dep, materiales.stock, materiales.stock_min, materiales.observacion, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.id_unidad, mat_padre.uni_id_unidad, mat_padre.id_fam, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, familia.nombre_fam, familia.status_fam, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad FROM unidad_medida, materiales, deposito, familia, mat_padre, pedido, mat_ped WHERE ((((((materiales.id_mat = mat_ped.id_mat) AND (pedido.id_ped = mat_ped.id_ped)) AND (materiales.id_dep = deposito.id_dep)) AND (mat_padre.id_unidad = unidad_medida.id_unidad)) AND (materiales.id_m = mat_padre.id_m)) AND (mat_padre.id_fam = familia.id_fam)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_materiales_prov OWNER TO postgres;

--
-- TOC entry 376 (class 1259 OID 4580079)
-- Dependencies: 2983 6
-- Name: vista_materiales_unid; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_materiales_unid AS
    SELECT us.id_unidad AS us_id, us.nombre_unidad AS us_nombre, us.abreviatura AS us_abre, materiales.id_mat, materiales.id_dep, materiales.stock, materiales.stock_min, materiales.observacion, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.id_unidad, mat_padre.uni_id_unidad, mat_padre.id_fam, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, familia.nombre_fam, familia.status_fam, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad FROM unidad_medida us, unidad_medida, materiales, deposito, familia, mat_padre WHERE (((((materiales.id_dep = deposito.id_dep) AND (mat_padre.uni_id_unidad = us.id_unidad)) AND (mat_padre.id_unidad = unidad_medida.id_unidad)) AND (materiales.id_m = mat_padre.id_m)) AND (mat_padre.id_fam = familia.id_fam)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_materiales_unid OWNER TO postgres;

--
-- TOC entry 377 (class 1259 OID 4580084)
-- Dependencies: 2984 6
-- Name: vista_materialesuniinv; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_materialesuniinv AS
    SELECT inventario_materiales.id_mat, inventario_materiales.id_inv, inventario_materiales.cant_sist, inventario_materiales.cant_real, inventario_materiales.justi_inv, vista_materiales_unid.us_id, vista_materiales_unid.us_nombre, vista_materiales_unid.us_abre, vista_materiales_unid.id_dep, vista_materiales_unid.stock, vista_materiales_unid.stock_min, vista_materiales_unid.observacion, vista_materiales_unid.id_m, vista_materiales_unid.numero_mat, vista_materiales_unid.nombre_mat, vista_materiales_unid.id_unidad, vista_materiales_unid.uni_id_unidad, vista_materiales_unid.id_fam, vista_materiales_unid.precio_u_p, vista_materiales_unid.c_uni_ent, vista_materiales_unid.c_uni_sal, vista_materiales_unid.nombre_dep, vista_materiales_unid.descrip_dep, vista_materiales_unid.status_dep, vista_materiales_unid.nombre_fam, vista_materiales_unid.status_fam, vista_materiales_unid.nombre_unidad, vista_materiales_unid.abreviatura, vista_materiales_unid.status_unidad FROM inventario_materiales, vista_materiales_unid WHERE (inventario_materiales.id_mat = vista_materiales_unid.id_mat);


ALTER TABLE public.vista_materialesuniinv OWNER TO postgres;

--
-- TOC entry 378 (class 1259 OID 4580089)
-- Dependencies: 2985 6
-- Name: vista_matpadre; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_matpadre AS
    SELECT unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, familia.id_fam, familia.nombre_fam, familia.status_fam, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, mat_padre.uni_id_unidad, mat_padre.impresion FROM unidad_medida, familia, mat_padre WHERE ((mat_padre.id_unidad = unidad_medida.id_unidad) AND (mat_padre.id_fam = familia.id_fam)) ORDER BY mat_padre.numero_mat;


ALTER TABLE public.vista_matpadre OWNER TO postgres;

--
-- TOC entry 379 (class 1259 OID 4580093)
-- Dependencies: 2986 6
-- Name: vista_matpadre_und; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_matpadre_und AS
    SELECT us.id_unidad AS us_id, us.nombre_unidad AS us_nombre, us.abreviatura AS us_abre, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, familia.id_fam, familia.nombre_fam, familia.status_fam, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, mat_padre.uni_id_unidad FROM unidad_medida us, unidad_medida, familia, mat_padre WHERE (((mat_padre.uni_id_unidad = us.id_unidad) AND (mat_padre.id_unidad = unidad_medida.id_unidad)) AND (mat_padre.id_fam = familia.id_fam)) ORDER BY mat_padre.numero_mat;


ALTER TABLE public.vista_matpadre_und OWNER TO postgres;

--
-- TOC entry 380 (class 1259 OID 4580097)
-- Dependencies: 2987 6
-- Name: vista_matped; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_matped AS
    SELECT materiales.id_mat, mat_padre.nombre_mat, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, mat_padre.numero_mat, materiales.id_dep, mat_padre.id_fam, materiales.stock, materiales.stock_min, deposito.nombre_dep, mat_ped.id_ped, mat_ped.cant_ped, mat_ped.cant_ent, mat_ped.precio, familia.nombre_fam FROM unidad_medida, materiales, deposito, familia, mat_ped, mat_padre WHERE (((((mat_padre.id_unidad = unidad_medida.id_unidad) AND (materiales.id_dep = deposito.id_dep)) AND (materiales.id_m = mat_padre.id_m)) AND (familia.id_fam = mat_padre.id_fam)) AND (materiales.id_mat = mat_ped.id_mat)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_matped OWNER TO postgres;

--
-- TOC entry 381 (class 1259 OID 4580102)
-- Dependencies: 2988 6
-- Name: vista_matped_und; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_matped_und AS
    SELECT us.id_unidad AS us_id, us.nombre_unidad AS us_nombre, us.abreviatura AS us_abre, materiales.id_mat, mat_padre.nombre_mat, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, mat_padre.numero_mat, materiales.id_dep, mat_padre.id_fam, mat_padre.c_uni_ent, mat_padre.c_uni_sal, materiales.stock, materiales.stock_min, deposito.nombre_dep, mat_ped.id_ped, mat_ped.cant_ped, mat_ped.cant_ent, mat_ped.precio, familia.nombre_fam FROM unidad_medida us, unidad_medida, materiales, deposito, familia, mat_ped, mat_padre WHERE ((((((mat_padre.id_unidad = unidad_medida.id_unidad) AND (mat_padre.uni_id_unidad = us.id_unidad)) AND (materiales.id_dep = deposito.id_dep)) AND (materiales.id_m = mat_padre.id_m)) AND (familia.id_fam = mat_padre.id_fam)) AND (materiales.id_mat = mat_ped.id_mat)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_matped_und OWNER TO postgres;

--
-- TOC entry 382 (class 1259 OID 4580107)
-- Dependencies: 2989 6
-- Name: vista_modelo; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_modelo AS
    SELECT marca.id_marca, marca.nombre_marca, marca.status_marca, modelo.id_modelo, modelo.nombre_modelo, modelo.id_tse, modelo.status_modelo, (((tipo_sist_equipo.sistema)::text || ' '::text) || (tipo_sist_equipo.ubicacion)::text) AS sistema FROM ((modelo JOIN marca ON ((marca.id_marca = modelo.id_marca))) JOIN tipo_sist_equipo ON ((modelo.id_tse = tipo_sist_equipo.id_tse)));


ALTER TABLE public.vista_modelo OWNER TO postgres;

--
-- TOC entry 383 (class 1259 OID 4580111)
-- Dependencies: 2990 6
-- Name: vista_mov_mat_o; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_mov_mat_o AS
    SELECT mov_mat_orden.id_mat, mov_mat_orden.cant_mov, tipo_movimiento.id_tm, tipo_movimiento.nombre_tm, tipo_movimiento.tipo_ent_sal, tipo_movimiento.uso_tm, tipo_movimiento.status_tm, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, movimiento_orden.id_mov, movimiento_orden.fecha_ent_sal, movimiento_orden.hora_ent_sal, movimiento_orden.observacion, movimiento_orden.referencia, movimiento_orden.tipo_mov, us.id_unidad AS us_id, us.nombre_unidad AS us_nombre, us.abreviatura AS us_abre, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, familia.id_fam, familia.nombre_fam, familia.status_fam, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, mat_padre.uni_id_unidad, materiales.stock, materiales.stock_min FROM tipo_movimiento, deposito, movimiento_orden, mov_mat_orden, unidad_medida us, unidad_medida, familia, mat_padre, materiales WHERE ((((((((movimiento_orden.tipo_mov = deposito.id_dep) AND (movimiento_orden.id_tm = tipo_movimiento.id_tm)) AND (movimiento_orden.id_mov = mov_mat_orden.id_mov)) AND (materiales.id_m = mat_padre.id_m)) AND (mat_padre.uni_id_unidad = us.id_unidad)) AND (mat_padre.id_unidad = unidad_medida.id_unidad)) AND (mat_padre.id_fam = familia.id_fam)) AND (mov_mat_orden.id_mat = materiales.id_mat)) ORDER BY movimiento_orden.fecha_ent_sal, movimiento_orden.hora_ent_sal;


ALTER TABLE public.vista_mov_mat_o OWNER TO postgres;

--
-- TOC entry 384 (class 1259 OID 4580116)
-- Dependencies: 2991 6
-- Name: vista_mov_materiales; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_mov_materiales AS
    SELECT mov_mat.id_mat, mov_mat.cant_mov, tipo_movimiento.id_tm, tipo_movimiento.nombre_tm, tipo_movimiento.tipo_ent_sal, tipo_movimiento.uso_tm, tipo_movimiento.status_tm, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, movimiento.id_mov, movimiento.fecha_ent_sal, movimiento.hora_ent_sal, movimiento.observacion, movimiento.referencia, movimiento.tipo_mov, materiales.id_m, entidad.id_te, entidad.id_persona, movimiento.num_mov FROM tipo_movimiento, deposito, movimiento, mov_mat, materiales, entidad WHERE (((((movimiento.tipo_mov = deposito.id_dep) AND (movimiento.id_tm = tipo_movimiento.id_tm)) AND (movimiento.id_mov = mov_mat.id_mov)) AND (materiales.id_mat = mov_mat.id_mat)) AND (movimiento.id_persona = entidad.id_persona)) ORDER BY movimiento.fecha_ent_sal, movimiento.hora_ent_sal;


ALTER TABLE public.vista_mov_materiales OWNER TO postgres;

--
-- TOC entry 385 (class 1259 OID 4580121)
-- Dependencies: 2992 6
-- Name: vista_movimiento_mov_mat; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_movimiento_mov_mat AS
    SELECT mov_mat.id_mat, mov_mat.cant_mov, tipo_movimiento.id_tm, tipo_movimiento.nombre_tm, tipo_movimiento.tipo_ent_sal, tipo_movimiento.uso_tm, tipo_movimiento.status_tm, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, movimiento.id_mov, movimiento.fecha_ent_sal, movimiento.hora_ent_sal, movimiento.observacion, movimiento.referencia, movimiento.tipo_mov, movimiento.num_mov FROM tipo_movimiento, deposito, movimiento, mov_mat WHERE (((movimiento.tipo_mov = deposito.id_dep) AND (movimiento.id_tm = tipo_movimiento.id_tm)) AND (movimiento.id_mov = mov_mat.id_mov)) ORDER BY movimiento.fecha_ent_sal, movimiento.hora_ent_sal;


ALTER TABLE public.vista_movimiento_mov_mat OWNER TO postgres;

--
-- TOC entry 386 (class 1259 OID 4580126)
-- Dependencies: 2993 6
-- Name: vista_movimiento_mov_mat_uni; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_movimiento_mov_mat_uni AS
    SELECT mov_mat.id_mat, mov_mat.cant_mov, tipo_movimiento.id_tm, tipo_movimiento.nombre_tm, tipo_movimiento.tipo_ent_sal, tipo_movimiento.uso_tm, tipo_movimiento.status_tm, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, movimiento.id_mov, movimiento.fecha_ent_sal, movimiento.hora_ent_sal, movimiento.observacion, movimiento.referencia, movimiento.tipo_mov, us.id_unidad AS us_id, us.nombre_unidad AS us_nombre, us.abreviatura AS us_abre, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, familia.id_fam, familia.nombre_fam, familia.status_fam, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, mat_padre.uni_id_unidad, materiales.stock, materiales.stock_min FROM tipo_movimiento, deposito, movimiento, mov_mat, unidad_medida us, unidad_medida, familia, mat_padre, materiales WHERE ((((((((movimiento.tipo_mov = deposito.id_dep) AND (movimiento.id_tm = tipo_movimiento.id_tm)) AND (movimiento.id_mov = mov_mat.id_mov)) AND (materiales.id_m = mat_padre.id_m)) AND (mat_padre.uni_id_unidad = us.id_unidad)) AND (mat_padre.id_unidad = unidad_medida.id_unidad)) AND (mat_padre.id_fam = familia.id_fam)) AND (mov_mat.id_mat = materiales.id_mat)) ORDER BY movimiento.fecha_ent_sal, movimiento.hora_ent_sal;


ALTER TABLE public.vista_movimiento_mov_mat_uni OWNER TO postgres;

--
-- TOC entry 387 (class 1259 OID 4580131)
-- Dependencies: 2994 6
-- Name: vista_municipio; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_municipio AS
    SELECT municipio.id_mun, municipio.id_esta, municipio.nombre_mun, municipio.status_mun, estado.nombre_esta, estado.status_esta FROM (municipio JOIN estado ON ((municipio.id_esta = estado.id_esta))) ORDER BY municipio.id_mun;


ALTER TABLE public.vista_municipio OWNER TO postgres;

--
-- TOC entry 388 (class 1259 OID 4580135)
-- Dependencies: 2995 6
-- Name: vista_ubica; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_ubica AS
    SELECT calle.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, franquicia.id_franq, zona.nombre_zona, franquicia.nombre_franq, sector.id_franq AS id_pais, estado.nombre_esta FROM calle, sector, ciudad, municipio, zona, franquicia, estado WHERE ((((((sector.id_sector = calle.id_sector) AND (sector.id_zona = zona.id_zona)) AND (zona.id_ciudad = ciudad.id_ciudad)) AND (ciudad.id_mun = municipio.id_mun)) AND (municipio.id_esta = estado.id_esta)) AND (sector.id_franq = franquicia.id_franq));


ALTER TABLE public.vista_ubica OWNER TO postgres;

--
-- TOC entry 389 (class 1259 OID 4580140)
-- Dependencies: 2996 6
-- Name: vista_notas; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_notas AS
    SELECT notas.id_nota, notas.login, notas.id_cont_serv, notas.tipo, notas.dir_ip, notas.fecha, notas.hora, notas.monto_anterior, notas.monto_posterior, notas.idmotivonota, notas.comentario, notas.status, notas.generado_por, motivonotas.nombremotivonota, contrato.id_contrato, contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, contrato.status_contrato, vista_ubica.id_sector, vista_ubica.nombre_calle, persona.id_persona, persona.cedula, persona.nombre, persona.apellido, vista_ubica.id_zona, vista_ubica.nombre_sector, vista_ubica.id_franq, vista_ubica.nombre_zona, vista_ubica.nombre_franq, vista_ubica.nombre_ciudad, notas.login_aut, notas.servicio, notas.fecha_inst, notas.nro_nota, notas.monto_nota FROM notas, motivonotas, contrato, cliente, persona, vista_ubica WHERE (((((persona.id_persona = cliente.id_persona) AND (cliente.id_persona = contrato.cli_id_persona)) AND (contrato.id_calle = vista_ubica.id_calle)) AND (contrato.id_contrato = notas.id_contrato)) AND (notas.idmotivonota = motivonotas.idmotivonota)) ORDER BY notas.id_nota;


ALTER TABLE public.vista_notas OWNER TO postgres;

--
-- TOC entry 390 (class 1259 OID 4580145)
-- Dependencies: 2997 6
-- Name: vista_orden; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_orden AS
    SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_final, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, contrato.status_contrato, zona.nombre_zona, zona.id_zona, (SELECT count(*) AS num_vis FROM visitas WHERE (ordenes_tecnicos.id_orden = visitas.id_orden)) AS num_visitas, sector.id_sector, (SELECT orden_grupo.id_gt FROM orden_grupo WHERE (ordenes_tecnicos.id_orden = orden_grupo.id_orden)) AS id_gt, contrato.id_calle, sector.id_franq FROM detalle_orden, contrato, ordenes_tecnicos, tipo_orden, persona, cliente, calle, sector, zona WHERE ((((((((tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden) AND (detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden)) AND (ordenes_tecnicos.id_contrato = contrato.id_contrato)) AND (contrato.cli_id_persona = cliente.id_persona)) AND (cliente.id_persona = persona.id_persona)) AND (contrato.id_calle = calle.id_calle)) AND (calle.id_sector = sector.id_sector)) AND (sector.id_zona = zona.id_zona)) ORDER BY ordenes_tecnicos.id_orden;


ALTER TABLE public.vista_orden OWNER TO postgres;

--
-- TOC entry 391 (class 1259 OID 4580150)
-- Dependencies: 2998 6
-- Name: vista_orden; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_orden AS
    SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, contrato.status_contrato, (SELECT count(*) AS num_vis FROM visitas WHERE (ordenes_tecnicos.id_orden = visitas.id_orden)) AS num_visitas, (SELECT orden_grupo.id_gt FROM orden_grupo WHERE (ordenes_tecnicos.id_orden = orden_grupo.id_orden) LIMIT 1) AS id_gt, (SELECT grupo_trabajo.nombre_grupo FROM orden_grupo, grupo_trabajo WHERE ((orden_grupo.id_gt = grupo_trabajo.id_gt) AND (ordenes_tecnicos.id_orden = orden_grupo.id_orden)) LIMIT 1) AS nombre_grupo, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, ordenes_tecnicos.login AS login_emi, ordenes_tecnicos.hora AS hora_emi, ordenes_tecnicos.login_imp, ordenes_tecnicos.hora_imp, ordenes_tecnicos.login_fin, ordenes_tecnicos.hora_fin, contrato.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, estado.id_esta, municipio.nombre_mun, franquicia.id_franq, zona.nombre_zona, franquicia.nombre_franq, estado.nombre_esta, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, contrato.contrato_fisico, contrato.postel FROM (((((((((((((ordenes_tecnicos JOIN detalle_orden ON ((detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden))) JOIN contrato ON ((ordenes_tecnicos.id_contrato = contrato.id_contrato))) JOIN tipo_orden ON ((tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden))) JOIN grupo_afinidad ON ((grupo_afinidad.id_g_a = contrato.id_g_a))) JOIN cliente ON ((contrato.cli_id_persona = cliente.id_persona))) JOIN persona ON ((persona.id_persona = cliente.id_persona))) JOIN calle ON ((contrato.id_calle = calle.id_calle))) JOIN sector ON ((calle.id_sector = sector.id_sector))) JOIN zona ON ((sector.id_zona = zona.id_zona))) JOIN ciudad ON ((zona.id_ciudad = ciudad.id_ciudad))) JOIN municipio ON ((ciudad.id_mun = municipio.id_mun))) JOIN estado ON ((municipio.id_esta = estado.id_esta))) JOIN franquicia ON ((sector.id_franq = franquicia.id_franq)));


ALTER TABLE public.vista_orden OWNER TO postgres;

--
-- TOC entry 392 (class 1259 OID 4580155)
-- Dependencies: 2999 6
-- Name: vista_orden_imp; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_orden_imp AS
    SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, contrato.status_contrato, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, ordenes_tecnicos.login AS login_emi, ordenes_tecnicos.hora AS hora_emi, ordenes_tecnicos.login_imp, ordenes_tecnicos.hora_imp, ordenes_tecnicos.login_fin, ordenes_tecnicos.hora_fin, contrato.id_calle, vista_ubica.id_sector, vista_ubica.nombre_calle, vista_ubica.id_zona, vista_ubica.nombre_sector, vista_ubica.id_ciudad, vista_ubica.id_mun, vista_ubica.nombre_ciudad, vista_ubica.id_esta, vista_ubica.nombre_mun, vista_ubica.id_franq, vista_ubica.nombre_zona, vista_ubica.nombre_franq, vista_ubica.nombre_esta, contrato.contrato_fisico FROM detalle_orden, contrato, ordenes_tecnicos, tipo_orden, persona, cliente, vista_ubica WHERE ((((((tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden) AND (detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden)) AND (ordenes_tecnicos.id_contrato = contrato.id_contrato)) AND (contrato.cli_id_persona = cliente.id_persona)) AND (cliente.id_persona = persona.id_persona)) AND (contrato.id_calle = vista_ubica.id_calle)) ORDER BY ordenes_tecnicos.id_orden;


ALTER TABLE public.vista_orden_imp OWNER TO postgres;

--
-- TOC entry 393 (class 1259 OID 4580160)
-- Dependencies: 3000 6
-- Name: vista_orden_rep; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_orden_rep AS
    SELECT ordenes_tecnicos.id_det_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, vista_ubica.id_franq, ordenes_tecnicos.fecha_canc, ordenes_tecnicos.id_orden FROM ordenes_tecnicos, vista_ubica, contrato WHERE ((contrato.id_calle = vista_ubica.id_calle) AND (ordenes_tecnicos.id_contrato = contrato.id_contrato));


ALTER TABLE public.vista_orden_rep OWNER TO postgres;

--
-- TOC entry 394 (class 1259 OID 4580164)
-- Dependencies: 3001 6
-- Name: vista_orden_rep_con; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_orden_rep_con AS
    SELECT ordenes_tecnicos.id_det_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, vista_ubica.id_franq, ordenes_tecnicos.fecha_canc, contrato.id_contrato, ordenes_tecnicos.id_orden FROM ordenes_tecnicos, vista_ubica, contrato WHERE ((contrato.id_calle = vista_ubica.id_calle) AND (ordenes_tecnicos.id_contrato = contrato.id_contrato));


ALTER TABLE public.vista_orden_rep_con OWNER TO postgres;

--
-- TOC entry 395 (class 1259 OID 4580168)
-- Dependencies: 3002 6
-- Name: vista_ordengrupo; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_ordengrupo AS
    SELECT detalle_orden.id_det_orden, detalle_orden.id_tipo_orden, ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_final, ordenes_tecnicos.status_orden, orden_grupo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.status_grupo, grupo_trabajo.nombre_grupo FROM detalle_orden, ordenes_tecnicos, orden_grupo, grupo_trabajo WHERE (((grupo_trabajo.id_gt = orden_grupo.id_gt) AND (orden_grupo.id_orden = ordenes_tecnicos.id_orden)) AND (ordenes_tecnicos.id_det_orden = detalle_orden.id_det_orden));


ALTER TABLE public.vista_ordengrupo OWNER TO postgres;

--
-- TOC entry 396 (class 1259 OID 4580172)
-- Dependencies: 3003 6
-- Name: vista_pago_cont; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_pago_cont AS
    SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, pagos.monto_pago, pagos.status_pago, pagos.nro_factura, pagos.id_contrato, contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, contrato.status_contrato, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, cliente.tipo_cliente, cliente.inicial_doc, caja.tipo_caja, caja_cobrador.id_persona AS id_persona_cob, contrato.taps, pagos.cont, caja.id_caja, caja.id_franq, pagos.nro_control, pagos.desc_pago, pagos.base_imp, pagos.monto_iva, pagos.monto_reten, pagos.islr, pagos.n_credito, pagos.fecha_factura, caja_cobrador.id_est, pagos.impresion, pagos.inc, vista_ubica.nombre_zona, vista_ubica.nombre_sector, pagos.obser_pago, vista_ubica.id_sector, pagos.tipo_doc FROM cliente, pagos, contrato, persona, caja_cobrador, caja, vista_ubica WHERE ((((((vista_ubica.id_calle = contrato.id_calle) AND (persona.id_persona = cliente.id_persona)) AND (cliente.id_persona = contrato.cli_id_persona)) AND (contrato.id_contrato = pagos.id_contrato)) AND (pagos.id_caja_cob = caja_cobrador.id_caja_cob)) AND (caja_cobrador.id_caja = caja.id_caja)) ORDER BY pagos.id_pago;


ALTER TABLE public.vista_pago_cont OWNER TO postgres;

--
-- TOC entry 397 (class 1259 OID 4580177)
-- Dependencies: 3004 6
-- Name: vista_pago_ser; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_pago_ser AS
    SELECT pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, contrato_servicio_deuda.cant_serv, pago_factura.costo_cobro_serv AS costo_cobro, contrato_servicio_deuda.id_serv, pagos.status_pago, caja.tipo_caja, pagos.id_pago, contrato_servicio_deuda.fecha_inst, servicios.nombre_servicio, caja.id_franq, caja_cobrador.id_est, contrato_servicio_deuda.descu, pagos.nro_factura, pagos.id_contrato, caja_cobrador.id_persona, pagos.obser_pago, servicios.tipo_serv, contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.costo_cobro AS costo_cobro_fact FROM pago_factura, pagos, contrato_servicio_deuda, caja_cobrador, caja, servicios WHERE (((((pagos.id_pago = pago_factura.id_pago) AND (pago_factura.id_cont_serv = contrato_servicio_deuda.id_cont_serv)) AND (pagos.id_caja_cob = caja_cobrador.id_caja_cob)) AND (caja_cobrador.id_caja = caja.id_caja)) AND (contrato_servicio_deuda.id_serv = servicios.id_serv));


ALTER TABLE public.vista_pago_ser OWNER TO postgres;

--
-- TOC entry 398 (class 1259 OID 4580182)
-- Dependencies: 3005 6
-- Name: vista_pagodeposito; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_pagodeposito AS
    SELECT persona.cedula, persona.nombre, persona.apellido, contrato.nro_contrato, sector.nombre_sector, franquicia.nombre_franq, franquicia.id_franq, pagodeposito.monto_dep, pagodeposito.id_pd, pagodeposito.id_contrato, pagodeposito.fecha_reg, pagodeposito.hora_reg, pagodeposito.login_reg, pagodeposito.fecha_dep, pagodeposito.banco, pagodeposito.numero_ref, pagodeposito.fecha_conf, pagodeposito.hora_conf, pagodeposito.login_conf, pagodeposito.fecha_proc, pagodeposito.tipo_dt, pagodeposito.login_proc, pagodeposito.status_pd, ciudad.id_mun, pagodeposito.cedula_titular, pagodeposito.obser_p FROM cliente, contrato, calle, sector, persona, zona, ciudad, municipio, estado, franquicia, pagodeposito WHERE ((((((((((cliente.id_persona = contrato.cli_id_persona) AND (contrato.id_calle = calle.id_calle)) AND (calle.id_sector = sector.id_sector)) AND (sector.id_zona = zona.id_zona)) AND (persona.id_persona = cliente.id_persona)) AND (zona.id_ciudad = ciudad.id_ciudad)) AND (ciudad.id_mun = municipio.id_mun)) AND (municipio.id_esta = estado.id_esta)) AND (sector.id_franq = franquicia.id_franq)) AND (pagodeposito.id_contrato = contrato.id_contrato)) ORDER BY pagodeposito.fecha_reg, pagodeposito.hora_reg;


ALTER TABLE public.vista_pagodeposito OWNER TO postgres;

--
-- TOC entry 399 (class 1259 OID 4580187)
-- Dependencies: 3006 6
-- Name: vista_para_cortar; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_para_cortar AS
    SELECT vista_contrato.id_contrato, vista_contrato.nro_contrato, vista_contrato.id_franq, vista_contrato.apellido, vista_contrato.nombre, vista_contrato.status_contrato, (SELECT sum(((contrato_servicio.cant_serv)::numeric * contrato_servicio.costo_cobro)) AS sum FROM contrato_servicio WHERE ((contrato_servicio.id_contrato = vista_contrato.id_contrato) AND (contrato_servicio.status_con_ser = 'DEUDA'::bpchar))) AS deuda, vista_contrato.nombre_calle, vista_contrato.nombre_sector, vista_contrato.nombre_zona, vista_contrato.nombre_franq, vista_contrato.id_calle, vista_contrato.id_sector, vista_contrato.id_zona, (SELECT DISTINCT contrato_servicio.fecha_inst FROM contrato_servicio WHERE ((contrato_servicio.id_contrato = vista_contrato.id_contrato) AND (contrato_servicio.status_con_ser = 'DEUDA'::bpchar)) ORDER BY contrato_servicio.fecha_inst DESC OFFSET 0 LIMIT 1) AS fecha_inst FROM vista_contrato WHERE (vista_contrato.status_contrato = 'ACTIVO'::bpchar);


ALTER TABLE public.vista_para_cortar OWNER TO postgres;

--
-- TOC entry 400 (class 1259 OID 4580192)
-- Dependencies: 3007 6
-- Name: vista_pedido; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_pedido AS
    SELECT pedido.id_ped, pedido.id_prov, pedido.fecha_ped, pedido.fecha_ent, pedido.status_ped, pedido.obser_ped, pedido.nro_fact_ped, pedido.porc_desc, pedido.desc_ped, pedido.base_ped, pedido.iva_ped, pedido.total_ped, proveedor.rif_prov, proveedor.nombre_prov, proveedor.direccion_prov, proveedor.telefonos_prov, proveedor.fax_prov, proveedor.web_prov, proveedor.email_prov, proveedor.obser_prov, proveedor.forma_pago, proveedor.banco, proveedor.cuenta, proveedor.status_prov, proveedor.contacto, pedido.num_ped, pedido.login_sol, pedido.login_apr, pedido.login_com FROM pedido, proveedor WHERE (pedido.id_prov = proveedor.id_prov) ORDER BY pedido.num_ped DESC;


ALTER TABLE public.vista_pedido OWNER TO postgres;

--
-- TOC entry 401 (class 1259 OID 4580197)
-- Dependencies: 3008 6
-- Name: vista_planillainv; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_planillainv AS
    SELECT inventario_materiales.id_mat, inventario_materiales.id_inv, inventario_materiales.cant_sist, inventario_materiales.cant_real, inventario_materiales.justi_inv, inventario.id_motivo, inventario.fecha_inv, inventario.hora_inv, inventario.obser_inv, inventario.tipo_inv, inventario.id_dep, inventario.id_fam, inventario.status_inv, vista_materiales_unid.us_id, vista_materiales_unid.us_nombre, vista_materiales_unid.us_abre, vista_materiales_unid.stock, vista_materiales_unid.stock_min, vista_materiales_unid.observacion, vista_materiales_unid.id_m, vista_materiales_unid.numero_mat, vista_materiales_unid.nombre_mat, vista_materiales_unid.id_unidad, vista_materiales_unid.uni_id_unidad, vista_materiales_unid.precio_u_p, vista_materiales_unid.c_uni_ent, vista_materiales_unid.c_uni_sal, vista_materiales_unid.nombre_dep, vista_materiales_unid.descrip_dep, vista_materiales_unid.status_dep, vista_materiales_unid.nombre_fam, vista_materiales_unid.status_fam, vista_materiales_unid.nombre_unidad, vista_materiales_unid.abreviatura, vista_materiales_unid.status_unidad FROM inventario_materiales, inventario, vista_materiales_unid WHERE ((inventario_materiales.id_inv = inventario.id_inv) AND (inventario_materiales.id_mat = vista_materiales_unid.id_mat)) ORDER BY vista_materiales_unid.nombre_mat;


ALTER TABLE public.vista_planillainv OWNER TO postgres;

--
-- TOC entry 402 (class 1259 OID 4580202)
-- Dependencies: 3009 6
-- Name: vista_planillamov; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_planillamov AS
    SELECT mov_mat.id_mat, mov_mat.id_mov, mov_mat.cant_mov, vista_materiales_unid.us_id, vista_materiales_unid.us_nombre, vista_materiales_unid.us_abre, vista_materiales_unid.id_dep, vista_materiales_unid.stock, vista_materiales_unid.stock_min, vista_materiales_unid.observacion, vista_materiales_unid.id_m, vista_materiales_unid.numero_mat, vista_materiales_unid.nombre_mat, vista_materiales_unid.id_unidad, vista_materiales_unid.uni_id_unidad, vista_materiales_unid.id_fam, vista_materiales_unid.precio_u_p, vista_materiales_unid.c_uni_ent, vista_materiales_unid.c_uni_sal, vista_materiales_unid.nombre_dep, vista_materiales_unid.descrip_dep, vista_materiales_unid.status_dep, vista_materiales_unid.nombre_fam, vista_materiales_unid.status_fam, vista_materiales_unid.nombre_unidad, vista_materiales_unid.abreviatura, vista_materiales_unid.status_unidad FROM mov_mat, vista_materiales_unid WHERE (mov_mat.id_mat = vista_materiales_unid.id_mat) ORDER BY vista_materiales_unid.nombre_mat;


ALTER TABLE public.vista_planillamov OWNER TO postgres;

--
-- TOC entry 403 (class 1259 OID 4580207)
-- Dependencies: 3010 6
-- Name: vista_planillaped; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_planillaped AS
    SELECT pedido.id_ped, pedido.id_prov, pedido.fecha_ped, pedido.fecha_ent, pedido.status_ped, pedido.obser_ped, pedido.nro_fact_ped, pedido.porc_desc, pedido.desc_ped, pedido.base_ped, pedido.iva_ped, pedido.total_ped, vista_matped_und.us_id, vista_matped_und.us_nombre, vista_matped_und.us_abre, vista_matped_und.id_mat, vista_matped_und.nombre_mat, vista_matped_und.id_unidad, vista_matped_und.nombre_unidad, vista_matped_und.abreviatura, vista_matped_und.numero_mat, vista_matped_und.id_dep, vista_matped_und.id_fam, vista_matped_und.c_uni_ent, vista_matped_und.c_uni_sal, vista_matped_und.stock, vista_matped_und.stock_min, vista_matped_und.nombre_dep, vista_matped_und.cant_ped, vista_matped_und.cant_ent, vista_matped_und.precio, vista_matped_und.nombre_fam FROM pedido, vista_matped_und WHERE (vista_matped_und.id_ped = pedido.id_ped);


ALTER TABLE public.vista_planillaped OWNER TO postgres;

--
-- TOC entry 404 (class 1259 OID 4580212)
-- Dependencies: 3011 6
-- Name: vista_promocion; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_promocion AS
    SELECT promocion.id_promo, promocion.nombre_promo, promocion.fecha_promo, promo_contrato.inicio_promo, promo_contrato.fin_promo, promocion.mes_promo, promocion.tipo_promo, promocion.descuento_promo, promocion.login, promocion.status_promo, promo_contrato.id_promo_con, promo_contrato.id_contrato, promo_contrato.status_promo_con FROM promocion, promo_contrato WHERE (promocion.id_promo = promo_contrato.id_promo);


ALTER TABLE public.vista_promocion OWNER TO postgres;

--
-- TOC entry 405 (class 1259 OID 4580216)
-- Dependencies: 3012 6
-- Name: vista_ps_est; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_ps_est AS
    SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, pagos.monto_pago, pagos.nro_factura, contrato_servicio_deuda.id_cont_serv, pagos.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.pagado AS costo_cobro, pagos.status_pago, contrato_servicio_deuda.id_serv FROM pago_factura, pagos, contrato_servicio_deuda WHERE (((pagos.id_pago = pago_factura.id_pago) AND (pago_factura.id_cont_serv = contrato_servicio_deuda.id_cont_serv)) AND (contrato_servicio_deuda.id_serv = 'SER00002'::bpchar)) ORDER BY pagos.nro_factura;


ALTER TABLE public.vista_ps_est OWNER TO postgres;

--
-- TOC entry 406 (class 1259 OID 4580221)
-- Dependencies: 3013 6
-- Name: vista_servicios; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_servicios AS
    SELECT servicios.id_serv, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, tipo_servicio.tipo_servicio, tipo_servicio.status_servicio,  servicios.tipo_costo, servicios.tipo_paq, servicios.tarifa_esp, servicios.tipo_serv, servicios.id_cant, cant_tv.cantidad, paquete.id_paq, paquete.nombre_paq, tarifa_servicio.tarifa_ser FROM ((((servicios JOIN tipo_servicio ON ((servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio)))  LEFT JOIN cant_tv ON ((servicios.id_cant = cant_tv.id_cant))) LEFT JOIN paquete ON ((servicios.id_paq = paquete.id_paq))) LEFT JOIN tarifa_servicio ON (((servicios.id_serv = tarifa_servicio.id_serv) AND (tarifa_servicio.status_tarifa_ser = 'ACTIVO'::bpchar))));


ALTER TABLE public.vista_servicios OWNER TO postgres;

--
-- TOC entry 407 (class 1259 OID 4580226)
-- Dependencies: 3014 6
-- Name: vista_pser; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_pser AS
    SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.hora_pago, pagos.monto_pago, pagos.nro_factura, contrato_servicio_deuda.id_cont_serv, pagos.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, pago_factura.costo_cobro_serv AS costo_cobro, vista_servicios.id_serv, vista_servicios.tipo_servicio, vista_servicios.nombre_servicio, vista_servicios.tipo_costo, vista_servicios.status_servicio AS status_serv, contrato_servicio_deuda.status_con_ser, pagos.status_pago, pagos.obser_pago, (((vista_caja.nombre)::text || ' '::text) || (vista_caja.apellido)::text) AS cobrador, pagos.nro_control, pagos.fecha_factura, vista_caja.id_franq, franquicia.nombre_franq, pagos.tipo_doc FROM pago_factura, pagos, contrato_servicio_deuda, vista_servicios, vista_caja, franquicia WHERE (((((vista_caja.id_caja_cob = pagos.id_caja_cob) AND (pagos.id_pago = pago_factura.id_pago)) AND (pago_factura.id_cont_serv = contrato_servicio_deuda.id_cont_serv)) AND (contrato_servicio_deuda.id_serv = vista_servicios.id_serv)) AND (franquicia.id_franq = vista_caja.id_franq)) ORDER BY contrato_servicio_deuda.fecha_inst DESC;


ALTER TABLE public.vista_pser OWNER TO postgres;

--
-- TOC entry 408 (class 1259 OID 4580231)
-- Dependencies: 3015 6
-- Name: vista_recibos; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_recibos AS
    SELECT recibos.nro_recibo, recibos.id_asig, recibos.id_rec, recibos.status_pago, vista_asignarecibo.id_persona, vista_asignarecibo.cedula, vista_asignarecibo.nombre, vista_asignarecibo.apellido, vista_asignarecibo.telefono, vista_asignarecibo.id_cobrador, vista_asignarecibo.fecha_asig, vista_asignarecibo.obser_asig, vista_asignarecibo.login_asig, vista_asignarecibo.desde, vista_asignarecibo.hasta, vista_asignarecibo.cantidad, recibos.tipo, recibos.obser FROM recibos, vista_asignarecibo WHERE (recibos.id_asig = vista_asignarecibo.id_asig) ORDER BY recibos.nro_recibo;


ALTER TABLE public.vista_recibos OWNER TO postgres;

--
-- TOC entry 409 (class 1259 OID 4580235)
-- Dependencies: 3016 6
-- Name: vista_reclamo; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_reclamo AS
    SELECT reclamo_denuncia.id_rec, reclamo_denuncia.id_persona, reclamo_denuncia.nro_rec, reclamo_denuncia.tipo_rec, reclamo_denuncia.fecha_rec, reclamo_denuncia.hora_rec, reclamo_denuncia.motivo_rec, reclamo_denuncia.descrip_rec, reclamo_denuncia.denunciado, reclamo_denuncia.status_rec, vista_cliente.cedula, vista_cliente.nombre, vista_cliente.apellido, vista_cliente.telefono, vista_cliente.telf_casa, vista_cliente.email FROM vista_cliente, reclamo_denuncia WHERE (reclamo_denuncia.id_persona = vista_cliente.id_persona) ORDER BY reclamo_denuncia.nro_rec;


ALTER TABLE public.vista_reclamo OWNER TO postgres;

--
-- TOC entry 410 (class 1259 OID 4580239)
-- Dependencies: 3017 6
-- Name: vista_rep_orden; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_rep_orden AS
    SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_final, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, contrato.status_contrato, contrato.id_calle, vista_calle1.id_sector, vista_calle1.nro_calle, vista_calle1.nombre_calle, vista_calle1.id_zona, vista_calle1.nombre_sector, vista_calle1.id_franq, vista_calle1.nombre_zona, vista_calle1.nombre_franq FROM detalle_orden, contrato, ordenes_tecnicos, tipo_orden, persona, cliente, vista_calle1 WHERE ((((((tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden) AND (detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden)) AND (ordenes_tecnicos.id_contrato = contrato.id_contrato)) AND (contrato.cli_id_persona = cliente.id_persona)) AND (cliente.id_persona = persona.id_persona)) AND (vista_calle1.id_calle = contrato.id_calle)) ORDER BY ordenes_tecnicos.id_orden;


ALTER TABLE public.vista_rep_orden OWNER TO postgres;

--
-- TOC entry 411 (class 1259 OID 4580244)
-- Dependencies: 3018 6
-- Name: vista_reporteinventario; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_reporteinventario AS
    SELECT motivo_inv.id_motivo, motivo_inv.nombre_motivo, motivo_inv.status_motivo, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, inventario.id_inv, inventario.fecha_inv, inventario.hora_inv, inventario.obser_inv, inventario.tipo_inv, inventario.id_fam, inventario.status_inv, inventario.num_inv, inventario.login_reg, inventario.login_aju FROM motivo_inv, deposito, inventario WHERE ((inventario.id_motivo = motivo_inv.id_motivo) AND (inventario.id_dep = deposito.id_dep)) ORDER BY inventario.num_inv;


ALTER TABLE public.vista_reporteinventario OWNER TO postgres;

--
-- TOC entry 412 (class 1259 OID 4580248)
-- Dependencies: 3019 6
-- Name: vista_reportemovimiento; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_reportemovimiento AS
    SELECT tipo_movimiento.id_tm, tipo_movimiento.nombre_tm, tipo_movimiento.tipo_ent_sal, tipo_movimiento.uso_tm, tipo_movimiento.status_tm, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, movimiento.id_mov, movimiento.fecha_ent_sal, movimiento.hora_ent_sal, movimiento.observacion, movimiento.referencia, movimiento.tipo_mov, movimiento.num_mov FROM tipo_movimiento, deposito, movimiento WHERE ((movimiento.tipo_mov = deposito.id_dep) AND (movimiento.id_tm = tipo_movimiento.id_tm)) ORDER BY movimiento.fecha_ent_sal;


ALTER TABLE public.vista_reportemovimiento OWNER TO postgres;

--
-- TOC entry 413 (class 1259 OID 4580252)
-- Dependencies: 3020 6
-- Name: vista_resumen_orden; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_resumen_orden AS
    SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_final, ordenes_tecnicos.status_orden, tipo_orden.id_tipo_orden FROM detalle_orden, ordenes_tecnicos, tipo_orden WHERE ((tipo_orden.id_tipo_orden = detalle_orden.id_tipo_orden) AND (detalle_orden.id_det_orden = ordenes_tecnicos.id_det_orden));


ALTER TABLE public.vista_resumen_orden OWNER TO postgres;

--
-- TOC entry 414 (class 1259 OID 4580256)
-- Dependencies: 3021 6
-- Name: vista_sector1; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_sector1 AS
    SELECT sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, ciudad.status_ciudad, municipio.id_esta, municipio.nombre_mun, municipio.status_mun, sector.id_franq, estado.nombre_esta, estado.status_esta, franquicia.nombre_franq, sector.nro_sector FROM (((((sector JOIN zona ON ((sector.id_zona = zona.id_zona))) JOIN ciudad ON ((zona.id_ciudad = ciudad.id_ciudad))) JOIN municipio ON ((ciudad.id_mun = municipio.id_mun))) JOIN estado ON ((municipio.id_esta = estado.id_esta))) JOIN franquicia ON ((sector.id_franq = franquicia.id_franq))) ORDER BY zona.nombre_zona;


ALTER TABLE public.vista_sector1 OWNER TO postgres;

--
-- TOC entry 415 (class 1259 OID 4580261)
-- Dependencies: 3022 6
-- Name: vista_serv; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_serv AS
    SELECT servicios.id_serv, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, servicios.tipo_costo, servicios.tipo_paq, servicios.tarifa_esp, servicios.tipo_serv, cant_tv.cantidad, contrato_servicio.id_cont_serv, contrato_servicio.id_contrato, cant_tv.id_cant, servicios.id_paq FROM servicios, cant_tv, contrato_servicio WHERE ((servicios.id_cant = cant_tv.id_cant) AND (servicios.id_serv = contrato_servicio.id_serv));


ALTER TABLE public.vista_serv OWNER TO postgres;

--
-- TOC entry 416 (class 1259 OID 4580265)
-- Dependencies: 3023 6
-- Name: vista_servicio_status; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_servicio_status AS
    SELECT DISTINCT servicios.id_tipo_servicio, contrato.id_contrato, contrato.status_contrato FROM contrato, contrato_servicio, servicios WHERE ((contrato.id_contrato = contrato_servicio.id_contrato) AND (contrato_servicio.id_serv = servicios.id_serv));


ALTER TABLE public.vista_servicio_status OWNER TO postgres;

--
-- TOC entry 417 (class 1259 OID 4580269)
-- Dependencies: 3024 6
-- Name: vista_sms; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_sms AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, sms.id_sms, sms.id_contrato, sms.nro_sms, sms.tipo_sms, sms.telefono_sms, sms.fecha_sms, sms.hora_sms, sms.mensaje_sms, sms.status_sms, sms.login, sms.tipo_list, sms.status_list, contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.observacion, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, contrato.id_edif, contrato.direc_adicional, contrato.numero_casa, contrato.numero_piso, cliente.telf_casa, cliente.email, cliente.telf_adic FROM persona, sms, contrato, cliente WHERE (((persona.id_persona = cliente.id_persona) AND (cliente.id_persona = contrato.cli_id_persona)) AND (contrato.id_contrato = sms.id_contrato)) ORDER BY sms.id_sms;


ALTER TABLE public.vista_sms OWNER TO postgres;

--
-- TOC entry 418 (class 1259 OID 4580274)
-- Dependencies: 3025 6
-- Name: vista_tarifa; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_tarifa AS
    SELECT tarifa_servicio.id_tar_ser, tarifa_servicio.id_serv, tarifa_servicio.fecha_tar_ser, tarifa_servicio.hora_tar_ser, tarifa_servicio.obser_tarifa_ser, tarifa_servicio.status_tarifa_ser, tarifa_servicio.tarifa_ser, vista_servicios.id_tipo_servicio, vista_servicios.nombre_servicio, vista_servicios.status_serv, vista_servicios.tipo_servicio, vista_servicios.status_servicio, vista_servicios.tipo_costo, vista_servicios.tarifa_esp, vista_servicios.tipo_serv FROM tarifa_servicio, vista_servicios WHERE (tarifa_servicio.id_serv = vista_servicios.id_serv);


ALTER TABLE public.vista_tarifa OWNER TO postgres;

--
-- TOC entry 419 (class 1259 OID 4580278)
-- Dependencies: 3026 6
-- Name: vista_tecnico; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_tecnico AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, tecnico.num_tecnico, tecnico.direccion_tec, tecnico.correo_tec, tecnico.status_tec, franquicia.id_franq, franquicia.nombre_franq FROM tecnico, persona, franquicia WHERE ((persona.id_persona = tecnico.id_persona) AND (franquicia.id_franq = tecnico.id_franq)) ORDER BY persona.cedula;


ALTER TABLE public.vista_tecnico OWNER TO postgres;

--
-- TOC entry 420 (class 1259 OID 4580282)
-- Dependencies: 3027 6
-- Name: vista_tipopago; Type: VIEW; Schema: public; Owner: postgres
--

CREATE OR REPLACE VIEW vista_tipopago AS 
 SELECT detalle_tipopago.id_tipo_pago, detalle_tipopago.id_pago, detalle_tipopago.id_banco, detalle_tipopago.refer_tp, detalle_tipopago.monto_tp, banco.banco, banco.lote_tp, pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, pagos.obser_pago, pagos.status_pago, pagos.nro_factura, tipo_pago.tipo_pago, caja.tipo_caja, pagos.id_contrato, caja.id_franq, caja_cobrador.id_est, pagos.impresion
   FROM detalle_tipopago
   join pagos ON detalle_tipopago.id_pago = pagos.id_pago
   JOIN tipo_pago ON detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago
   JOIN caja_cobrador ON pagos.id_caja_cob = caja_cobrador.id_caja_cob
   JOIN caja ON caja_cobrador.id_caja = caja.id_caja
   JOIN banco ON banco.id_banco=detalle_tipopago.id_bano



CREATE OR REPLACE VIEW vista_tipopago_temp AS 
 SELECT detalle_tipopago.id_tipo_pago, detalle_tipopago.id_pago, detalle_tipopago.id_banco, detalle_tipopago.refer_tp, detalle_tipopago.monto_tp, banco.banco, detalle_tipopago.lote_tp, tipo_pago.tipo_pago
   FROM detalle_tipopago
   LEFT JOIN tipo_pago ON detalle_tipopago.id_tipo_pago::text = tipo_pago.id_tipo_pago::text
   LEFT JOIN banco ON banco.id_banco::text = detalle_tipopago.id_banco::text;


CREATE VIEW vista_ubicli AS
    SELECT contrato.id_contrato, calle.id_calle, calle.id_sector, sector.id_zona, contrato.status_contrato FROM calle, contrato, sector WHERE ((calle.id_calle = contrato.id_calle) AND (calle.id_sector = sector.id_sector)) ORDER BY contrato.id_contrato;


ALTER TABLE public.vista_ubicli OWNER TO postgres;

--
-- TOC entry 423 (class 1259 OID 4580295)
-- Dependencies: 3030 6
-- Name: vista_urb; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_urb AS
    SELECT urbanizacion.id_urb, urbanizacion.nombre_urb, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, ciudad.status_ciudad, municipio.id_esta, municipio.nombre_mun, municipio.status_mun, sector.id_franq, estado.nombre_esta, estado.status_esta, franquicia.nombre_franq FROM ((((((urbanizacion JOIN sector ON ((urbanizacion.id_sector = sector.id_sector))) JOIN zona ON ((sector.id_zona = zona.id_zona))) JOIN ciudad ON ((zona.id_ciudad = ciudad.id_ciudad))) JOIN municipio ON ((ciudad.id_mun = municipio.id_mun))) JOIN estado ON ((municipio.id_esta = estado.id_esta))) JOIN franquicia ON ((sector.id_franq = franquicia.id_franq)));


ALTER TABLE public.vista_urb OWNER TO postgres;

--
-- TOC entry 424 (class 1259 OID 4580300)
-- Dependencies: 3031 6
-- Name: vista_vendedor; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_vendedor AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, vendedor.nro_vendedor, vendedor.direccion_ven, franquicia.id_franq, franquicia.nombre_franq FROM vendedor, persona, franquicia WHERE ((persona.id_persona = vendedor.id_persona) AND (franquicia.id_franq = vendedor.id_franq)) ORDER BY persona.cedula;


ALTER TABLE public.vista_vendedor OWNER TO postgres;

--
-- TOC entry 425 (class 1259 OID 4580304)
-- Dependencies: 3032 6
-- Name: vista_zona1; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_zona1 AS
    SELECT zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, ciudad.status_ciudad, municipio.id_esta, municipio.nombre_mun, municipio.status_mun, estado.nombre_esta, estado.status_esta, zona.nro_zona FROM (((zona JOIN ciudad ON ((zona.id_ciudad = ciudad.id_ciudad))) JOIN municipio ON ((ciudad.id_mun = municipio.id_mun))) JOIN estado ON ((municipio.id_esta = estado.id_esta))) ORDER BY zona.nombre_zona;


ALTER TABLE public.vista_zona1 OWNER TO postgres;

--
-- TOC entry 426 (class 1259 OID 4580308)
-- Dependencies: 3033 6
-- Name: vistamodulo; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vistamodulo AS
    SELECT perfil.codigoperfil, perfil.nombreperfil, perfil.descripcionperfil, modulo.codigomodulo, modulo.nombremodulo, modulo.namemodulo, modulo_perfil.incluir, modulo_perfil.modificar, modulo_perfil.eliminar FROM perfil, modulo, modulo_perfil WHERE ((((modulo_perfil.codigomodulo = modulo.codigomodulo) AND (modulo.statusmodulo = 'ACTIVO'::bpchar)) AND (modulo_perfil.codigoperfil = perfil.codigoperfil)) AND (perfil.statusperfil = 'ACTIVO'::bpchar));

