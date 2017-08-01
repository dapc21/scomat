--------------------------------------------------------20/05/2015-------------------------------------------------------


ALTER TABLE notas_cd ADD generado_por character(20);
ALTER TABLE notas_cd ADD monto_cd numeric(10,2);

--------------------------------------------------------24/05/2015-------------------------------------------------------


DROP VIEW public.vistamodulo;
DROP VIEW public.vista_zona1;
DROP VIEW public.vista_vendedor;
DROP VIEW public.vista_urb;
DROP VIEW public.vista_ubicli;
DROP VIEW public.vista_tipopago_temp;
DROP VIEW public.vista_tipopago;
DROP VIEW public.vista_tecnico;
DROP VIEW public.vista_tarifa;
DROP VIEW public.vista_tablabancos;
DROP VIEW public.vista_sms;
DROP VIEW public.vista_servicios;
DROP VIEW public.vista_servicio_status;
DROP VIEW public.vista_serv;
DROP VIEW public.vista_sector1;
DROP VIEW public.vista_reportemovimiento;
DROP VIEW public.vista_reporteinventario;
DROP VIEW public.vista_reclamo;
DROP VIEW public.vista_recibos;
DROP VIEW public.vista_promocion;
DROP VIEW public.vista_planillaped;
DROP VIEW public.vista_planillamov;
DROP VIEW public.vista_planillainv;
DROP VIEW public.vista_pedido;
DROP VIEW public.vista_pagodeposito;
DROP VIEW public.vista_pago_ser;
DROP VIEW public.vista_pago_cont;
DROP VIEW public.vista_pago;
DROP VIEW public.vista_ordengrupo;
DROP VIEW public.vista_orden_rep_con;
DROP VIEW public.vista_orden_rep;
DROP VIEW public.vista_orden_imp;
DROP VIEW public.vista_orden;
DROP VIEW public.vista_notas_cd;
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
DROP VIEW public.vista_contratodeu_f;
DROP VIEW public.vista_contratodeu;
DROP VIEW public.vista_contrato_todo;
DROP VIEW public.vista_contrato_status;
DROP VIEW public.vista_contrato_servicio_deuda;
DROP VIEW public.vista_contrato_dir;
DROP VIEW public.vista_contrato_auditoria;
DROP VIEW public.vista_contrato;
DROP VIEW public.vista_cont_serv_temp;
DROP VIEW public.vista_cont_serv_sist_paq;
DROP VIEW public.vista_cont_serv;
DROP VIEW public.vista_confcomision;
DROP VIEW public.vista_comisiones;
DROP VIEW public.vista_cobrador;
DROP VIEW public.vista_cliente1;
DROP VIEW public.vista_cliente;
DROP VIEW public.vista_ciudad;
DROP VIEW public.vista_calle1;
DROP VIEW public.vista_caja;
DROP VIEW public.vista_asignarecibo;
DROP VIEW public.personausuario;
DROP VIEW public.pago_servicio;
DROP VIEW public.contrato_servicio_pagado;






ALTER TABLE asig_lla_cli ALTER column deuda TYPE numeric(10,4);
ALTER TABLE caja_cobrador ALTER column monto_acum TYPE numeric(10,4);
ALTER TABLE cargar_deuda ALTER column costo TYPE numeric(10,4);
ALTER TABLE cierre_historico ALTER column total_ingreso TYPE numeric(10,4);
ALTER TABLE cierre_historico ALTER column total_facturado TYPE numeric(10,4);
ALTER TABLE cierre_historico ALTER column total_nota_credito TYPE numeric(10,4);
ALTER TABLE cierre_historico ALTER column total_x_servicio TYPE numeric(10,4);
ALTER TABLE cierre_historico ALTER column total_x_form_pago TYPE numeric(10,4);
ALTER TABLE cierre_historico ALTER column deuda_act TYPE numeric(10,4);
ALTER TABLE cierre_historico ALTER column deuda_cor TYPE numeric(10,4);
ALTER TABLE cierre_historico ALTER column deuda_xint TYPE numeric(10,4);
ALTER TABLE cierre_historico ALTER column deuda_xcor TYPE numeric(10,4);
ALTER TABLE cierre_historico ALTER column deuda_xrec TYPE numeric(10,4);
ALTER TABLE cierre_historico ALTER column deuda_exo TYPE numeric(10,4);
ALTER TABLE cierre_historico ALTER column deuda_otros TYPE numeric(10,4);
ALTER TABLE cierre_historico ALTER column deuda_total TYPE numeric(10,4);
ALTER TABLE cirre_diario ALTER column monto_total TYPE numeric(10,4);
ALTER TABLE cirre_diario_et ALTER column monto_total TYPE numeric(10,4);
ALTER TABLE conciliacion_pago ALTER column monto_conc TYPE numeric(10,4);
ALTER TABLE conf_comision ALTER column porc_acord TYPE numeric(10,4);
ALTER TABLE conf_comision ALTER column porc_com_reca TYPE numeric(10,4);
ALTER TABLE conf_comision ALTER column porc_com_venta TYPE numeric(10,4);
ALTER TABLE conf_comision ALTER column porc_ret_iva TYPE numeric(10,4);
ALTER TABLE conf_comision ALTER column porc_ret_islr TYPE numeric(10,4);
ALTER TABLE conf_comision ALTER column descuento_conf TYPE numeric(10,4);
ALTER TABLE contrato ALTER column costo_dif_men TYPE numeric(10,4);
ALTER TABLE contrato ALTER column saldo TYPE numeric(10,4);
ALTER TABLE contrato_servicio ALTER column costo_cobro TYPE numeric(10,4);
ALTER TABLE contrato_servicio_deuda ALTER column costo_cobro TYPE numeric(10,4);
ALTER TABLE contrato_servicio_deuda ALTER column descu TYPE numeric(10,4);
ALTER TABLE contrato_servicio_deuda ALTER column apagar TYPE numeric(10,4);
ALTER TABLE contrato_servicio_deuda ALTER column pagado TYPE numeric(10,4);
ALTER TABLE pago_factura ALTER column costo_cobro_serv TYPE numeric(10,4);
ALTER TABLE pagos ALTER column monto_pago TYPE numeric(10,4);
ALTER TABLE pagos ALTER column desc_pago TYPE numeric(10,4);
ALTER TABLE pagos ALTER column por_iva TYPE numeric(10,4);
ALTER TABLE contrato_servicio_temp ALTER column costo_cobro TYPE numeric(10,4);
ALTER TABLE conv_con ALTER column costo_cobro TYPE numeric(10,4);
ALTER TABLE cuenta_bancos ALTER column monto_db TYPE numeric(10,4);
ALTER TABLE deposito_franq ALTER column monto_z TYPE numeric(10,4);
ALTER TABLE deposito_franq_tp ALTER column monto_df_tp TYPE numeric(10,4);
ALTER TABLE descuento_pronto_pag ALTER column monto_dpp TYPE numeric(10,4);
ALTER TABLE detalle_tipopago ALTER column monto_tp TYPE numeric(10,4);
ALTER TABLE detalle_tipopago_df ALTER column monto_dbf TYPE numeric(10,4);
ALTER TABLE detalle_tipopago_temp ALTER column monto_tp TYPE numeric(10,4);
ALTER TABLE deudalanto ALTER column costo_cobro TYPE numeric(10,4);
ALTER TABLE est_ingreso ALTER column ingreso_ei TYPE numeric(10,4);
ALTER TABLE est_ingreso ALTER column deuda_ei TYPE numeric(10,4);
ALTER TABLE est_tecnicos ALTER column ordenes_rea TYPE numeric(10,4);
ALTER TABLE mat_padre ALTER column precio_u_p TYPE numeric(10,4);
ALTER TABLE mat_ped ALTER column precio TYPE numeric(10,4);
ALTER TABLE notas ALTER column monto_anterior TYPE numeric(10,4);
ALTER TABLE notas ALTER column monto_posterior TYPE numeric(10,4);
ALTER TABLE notas ALTER column monto_nota TYPE numeric(10,4);
ALTER TABLE notas_cd ALTER column monto_cd TYPE numeric(10,4);
ALTER TABLE pago_comisiones ALTER column porcent_aplic TYPE numeric(10,4);
ALTER TABLE pago_comisiones ALTER column monto_comi TYPE numeric(10,4);
ALTER TABLE pago_comisones ALTER column total_cob_sis TYPE numeric(10,4);
ALTER TABLE pago_comisones ALTER column por_comision TYPE numeric(10,4);
ALTER TABLE pago_comisones ALTER column monto_comision TYPE numeric(10,4);
ALTER TABLE pago_comisones ALTER column monto_ret_iva TYPE numeric(10,4);
ALTER TABLE pago_comisones ALTER column monto_ret_islr TYPE numeric(10,4);
ALTER TABLE pago_comisones ALTER column total_reintegro TYPE numeric(10,4);
ALTER TABLE pago_comisones ALTER column monto_desc TYPE numeric(10,4);
ALTER TABLE pago_comisones ALTER column total_deposito TYPE numeric(10,4);
ALTER TABLE pagos_his ALTER column monto_pago TYPE numeric(10,4);
ALTER TABLE pedido ALTER column porc_desc TYPE numeric(10,4);
ALTER TABLE pedido ALTER column desc_ped TYPE numeric(10,4);
ALTER TABLE pedido ALTER column base_ped TYPE numeric(10,4);
ALTER TABLE pedido ALTER column iva_ped TYPE numeric(10,4);
ALTER TABLE pedido ALTER column total_ped TYPE numeric(10,4);
ALTER TABLE promocion ALTER column descuento_promo TYPE numeric(10,4);
ALTER TABLE recibo_pago ALTER column monto_tp TYPE numeric(10,4);
ALTER TABLE tarifa_servicio ALTER column tarifa_ser TYPE numeric(10,4);
ALTER TABLE venta_contrato ALTER column costo_venta TYPE numeric(10,4);









CREATE VIEW contrato_servicio_pagado AS
    SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, pagos.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.status_con_ser, pago_factura.costo_cobro_serv AS costo_cobro FROM ((pago_factura JOIN contrato_servicio_deuda ON (((pago_factura.id_cont_serv)::text = (contrato_servicio_deuda.id_cont_serv)::text))) JOIN pagos ON (((pago_factura.id_pago)::text = (pagos.id_pago)::text)));


CREATE VIEW pago_servicio AS
    SELECT pago_factura.id_cont_serv, pago_factura.id_pago FROM pago_factura;



CREATE VIEW personausuario AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, usuario.login, usuario.codigoperfil, usuario.password, usuario.statususuario, perfil.nombreperfil, perfil.descripcionperfil, perfil.statusperfil, usuario.id_franq, franquicia.nombre_franq, servidor.nombre_servidor, usuario.id_usuario FROM ((((persona JOIN usuario ON (((persona.id_persona)::text = (usuario.id_persona)::text))) JOIN perfil ON (((usuario.codigoperfil)::text = (perfil.codigoperfil)::text))) LEFT JOIN franquicia ON (((franquicia.id_franq)::text = (usuario.id_franq)::text))) LEFT JOIN servidor ON (((servidor.id_servidor)::text = (usuario.id_servidor)::text)));



CREATE VIEW vista_asignarecibo AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, asigna_recibo.id_asig, asigna_recibo.id_cobrador, asigna_recibo.fecha_asig, asigna_recibo.obser_asig, asigna_recibo.login_asig, asigna_recibo.desde, asigna_recibo.hasta, asigna_recibo.cantidad, asigna_recibo.tipo FROM (persona JOIN asigna_recibo ON (((persona.id_persona)::text = (asigna_recibo.id_cobrador)::text)));











ALTER TABLE public.vista_asignarecibo OWNER TO postgres;

--
-- TOC entry 318 (class 1259 OID 2650995)
-- Dependencies: 2714 6
-- Name: vista_caja; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_caja AS
    SELECT caja_cobrador.id_caja_cob, caja_cobrador.id_caja, caja_cobrador.id_persona, caja_cobrador.fecha_caja, caja_cobrador.apertura_caja, caja_cobrador.cierre_caja, caja_cobrador.monto_acum, caja_cobrador.status_caja AS status_caja_cob, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cobrador.nro_cobrador, cobrador.direccion_cob, caja.nombre_caja, caja.descripcion_caja, caja.status_caja, caja.inicial, caja.tipo_caja, caja.id_franq, caja.caja_externa, caja_cobrador.id_est, caja_cobrador.fecha_sugerida, estacion_trabajo.nombre_est FROM ((((caja JOIN caja_cobrador ON (((caja_cobrador.id_caja)::text = (caja.id_caja)::text))) JOIN persona ON (((caja_cobrador.id_persona)::text = (persona.id_persona)::text))) JOIN cobrador ON (((cobrador.id_persona)::text = (persona.id_persona)::text))) JOIN estacion_trabajo ON (((caja_cobrador.id_est)::text = (estacion_trabajo.id_est)::text)));



CREATE VIEW vista_calle1 AS
    SELECT calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, ciudad.status_ciudad, municipio.id_esta, municipio.nombre_mun, sector.id_franq, estado.nombre_esta, franquicia.nombre_franq, calle.nro_calle FROM ((((((calle JOIN sector ON (((calle.id_sector)::text = (sector.id_sector)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) JOIN ciudad ON (((zona.id_ciudad)::text = (ciudad.id_ciudad)::text))) JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text))) JOIN franquicia ON (((sector.id_franq)::text = (franquicia.id_franq)::text))) ORDER BY zona.nombre_zona;


ALTER TABLE public.vista_calle1 OWNER TO postgres;

--
-- TOC entry 321 (class 1259 OID 2651008)
-- Dependencies: 2716 6
-- Name: vista_ciudad; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_ciudad AS
    SELECT ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, ciudad.status_ciudad, municipio.id_esta, municipio.nombre_mun, municipio.status_mun, estado.nombre_esta, estado.status_esta FROM ((ciudad JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text))) ORDER BY ciudad.id_ciudad;


ALTER TABLE public.vista_ciudad OWNER TO postgres;

--
-- TOC entry 322 (class 1259 OID 2651012)
-- Dependencies: 2717 6
-- Name: vista_cliente; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_cliente AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.email, cliente.telf_adic, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac FROM (persona JOIN cliente ON (((persona.id_persona)::text = (cliente.id_persona)::text))) ORDER BY persona.cedula;


ALTER TABLE public.vista_cliente OWNER TO postgres;

--
-- TOC entry 323 (class 1259 OID 2651016)
-- Dependencies: 2718 6
-- Name: vista_cliente1; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_cliente1 AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.email, cliente.telf_adic, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac FROM (cliente JOIN persona ON (((persona.id_persona)::text = (cliente.id_persona)::text))) ORDER BY persona.cedula;


ALTER TABLE public.vista_cliente1 OWNER TO postgres;

--
-- TOC entry 324 (class 1259 OID 2651020)
-- Dependencies: 2719 6
-- Name: vista_cobrador; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_cobrador AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cobrador.nro_cobrador, cobrador.direccion_cob, cobrador.codcob, franquicia.id_franq, franquicia.nombre_franq FROM ((cobrador JOIN persona ON (((persona.id_persona)::text = (cobrador.id_persona)::text))) JOIN franquicia ON (((franquicia.id_franq)::text = (cobrador.id_franq)::text))) ORDER BY persona.cedula;


ALTER TABLE public.vista_cobrador OWNER TO postgres;

--
-- TOC entry 325 (class 1259 OID 2651025)
-- Dependencies: 2720 6
-- Name: vista_comisiones; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_comisiones AS
    SELECT pago_comisiones.id_comi, pago_comisiones.id_persona, pago_comisiones.comi_para, pago_comisiones.fecha_comi, pago_comisiones.fecha_desde, pago_comisiones.fecha_hasta, pago_comisiones.porcent_aplic, pago_comisiones.monto_comi, pago_comisiones.status_comi, persona.cedula, persona.nombre, persona.apellido, persona.telefono FROM (persona JOIN pago_comisiones ON (((pago_comisiones.id_persona)::text = (persona.id_persona)::text)));


ALTER TABLE public.vista_comisiones OWNER TO postgres;

--
-- TOC entry 326 (class 1259 OID 2651029)
-- Dependencies: 2721 6
-- Name: vista_confcomision; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_confcomision AS
    SELECT franquicia.id_franq, franquicia.nombre_franq, franquicia.id_emp, franquicia.id_gf, franquicia.obser_franq, franquicia.direccion_franq, franquicia.serie, conf_comision.id_confc, conf_comision.fecha_confc, conf_comision.status_confc, conf_comision.porc_acord, conf_comision.porc_com_reca, conf_comision.porc_com_venta, conf_comision.porc_ret_iva, conf_comision.porc_ret_islr, conf_comision.descuento_conf, conf_comision.tipo_e_p, conf_comision.empresa_confc, conf_comision.rif_empresa, conf_comision.represen_confc, conf_comision.cedula_rep, conf_comision.desc_confc FROM (franquicia JOIN conf_comision ON (((franquicia.id_franq)::text = (conf_comision.id_franq)::text))) ORDER BY franquicia.nombre_franq;


ALTER TABLE public.vista_confcomision OWNER TO postgres;

--
-- TOC entry 327 (class 1259 OID 2651034)
-- Dependencies: 2722 6
-- Name: vista_cont_serv; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_cont_serv AS
    SELECT contrato_servicio.id_cont_serv, contrato_servicio.id_serv, contrato_servicio.id_contrato, contrato_servicio.fecha_inst, contrato_servicio.cant_serv, contrato_servicio.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, tipo_servicio.tipo_servicio, contrato_servicio.costo_cobro, servicios.tipo_paq FROM ((contrato_servicio JOIN servicios ON (((contrato_servicio.id_serv)::text = (servicios.id_serv)::text))) JOIN tipo_servicio ON (((servicios.id_tipo_servicio)::text = (tipo_servicio.id_tipo_servicio)::text)));


ALTER TABLE public.vista_cont_serv OWNER TO postgres;

--
-- TOC entry 328 (class 1259 OID 2651039)
-- Dependencies: 2723 6
-- Name: vista_cont_serv_sist_paq; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_cont_serv_sist_paq AS
    SELECT contrato_servicio.id_serv, contrato_servicio.id_contrato, servicios.nombre_servicio, serv_sist_paq.id_serv_sist FROM ((contrato_servicio JOIN servicios ON (((contrato_servicio.id_serv)::text = (servicios.id_serv)::text))) JOIN serv_sist_paq ON (((servicios.id_serv)::text = (serv_sist_paq.id_serv)::text)));


ALTER TABLE public.vista_cont_serv_sist_paq OWNER TO postgres;

--
-- TOC entry 329 (class 1259 OID 2651044)
-- Dependencies: 2724 6
-- Name: vista_cont_serv_temp; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_cont_serv_temp AS
    SELECT contrato_servicio_temp.id_cont_serv, contrato_servicio_temp.id_serv, contrato_servicio_temp.id_contrato, contrato_servicio_temp.fecha_inst, contrato_servicio_temp.cant_serv, contrato_servicio_temp.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, tipo_servicio.tipo_servicio, contrato_servicio_temp.costo_cobro, servicios.tipo_paq FROM ((contrato_servicio_temp JOIN servicios ON (((contrato_servicio_temp.id_serv)::text = (servicios.id_serv)::text))) JOIN tipo_servicio ON (((servicios.id_tipo_servicio)::text = (tipo_servicio.id_tipo_servicio)::text)));


ALTER TABLE public.vista_cont_serv_temp OWNER TO postgres;

--
-- TOC entry 330 (class 1259 OID 2651049)
-- Dependencies: 2725 6
-- Name: vista_contrato; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contrato AS
    SELECT contrato.id_contrato, contrato.id_calle, contrato.id_venta, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.observacion, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.email, contrato.direc_adicional, contrato.numero_casa, calle.id_sector, calle.nro_calle, calle.nombre_calle, sector.id_zona, sector.nro_sector, sector.nombre_sector, franquicia.id_franq, zona.nro_zona, zona.nombre_zona, franquicia.nombre_franq, franquicia.id_emp, franquicia.id_gf, franquicia.obser_franq, franquicia.direccion_franq, contrato.id_edif, contrato.numero_piso, cliente.telf_adic, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac, contrato.saldo AS deuda, contrato.postel, contrato.taps, contrato.pto, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, contrato.id_urb, zona.id_ciudad, contrato.cod_id_persona, contrato.contrato_fisico, contrato.etiqueta_n, contrato.tipo_fact, contrato.contrato_imp, contrato.ultima_act FROM ((((((((((contrato JOIN cliente ON (((contrato.cli_id_persona)::text = (cliente.id_persona)::text))) JOIN persona ON (((persona.id_persona)::text = (cliente.id_persona)::text))) JOIN calle ON (((contrato.id_calle)::text = (calle.id_calle)::text))) JOIN sector ON (((calle.id_sector)::text = (sector.id_sector)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) JOIN franquicia ON (((sector.id_franq)::text = (franquicia.id_franq)::text))) JOIN ciudad ON (((zona.id_ciudad)::text = (ciudad.id_ciudad)::text))) JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text))) JOIN grupo_afinidad ON (((contrato.id_g_a)::text = (grupo_afinidad.id_g_a)::text)));


ALTER TABLE public.vista_contrato OWNER TO postgres;

--
-- TOC entry 331 (class 1259 OID 2651054)
-- Dependencies: 2726 6
-- Name: vista_contrato_auditoria; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contrato_auditoria AS
    SELECT contrato.id_contrato, contrato.id_venta, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.telf_adic, contrato.direc_adicional, contrato.numero_casa, contrato.id_edif, contrato.numero_piso, contrato.id_urb, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, sector.id_franq, estado.nombre_esta, franquicia.nombre_franq, contrato.postel, contrato.pto, contrato.cod_id_persona, (((vista_cobrador.nombre)::text || ' '::text) || (vista_cobrador.apellido)::text) AS cobrador, contrato.etiqueta_n, contrato.taps, contrato.tipo_fact, edificio.edificio, urbanizacion.nombre_urb AS urbanizacion, contrato.contrato_fisico, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac, contrato.observacion, statuscont.nombrestatus, contrato.contrato_imp, contrato.ultima_act, cliente.email, venta_contrato.id_persona, venta_contrato.id_serv AS id_serv_v, contrato.saldo, statuscont.color FROM (((((((((((((((contrato JOIN calle ON (((contrato.id_calle)::text = (calle.id_calle)::text))) JOIN sector ON (((calle.id_sector)::text = (sector.id_sector)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) JOIN ciudad ON (((zona.id_ciudad)::text = (ciudad.id_ciudad)::text))) JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text))) JOIN franquicia ON (((sector.id_franq)::text = (franquicia.id_franq)::text))) JOIN cliente ON (((contrato.cli_id_persona)::text = (cliente.id_persona)::text))) JOIN persona ON (((persona.id_persona)::text = (cliente.id_persona)::text))) JOIN grupo_afinidad ON (((contrato.id_g_a)::text = (grupo_afinidad.id_g_a)::text))) JOIN vista_cobrador ON (((vista_cobrador.id_persona)::text = (contrato.cod_id_persona)::text))) JOIN statuscont ON (((statuscont.status_contrato)::text = (contrato.status_contrato)::text))) LEFT JOIN edificio ON (((contrato.id_edif)::text = (edificio.id_edif)::text))) LEFT JOIN urbanizacion ON (((contrato.id_urb)::text = (urbanizacion.id_urb)::text))) LEFT JOIN venta_contrato ON (((contrato.id_venta)::text = (venta_contrato.id_venta)::text)));


ALTER TABLE public.vista_contrato_auditoria OWNER TO postgres;

--
-- TOC entry 332 (class 1259 OID 2651059)
-- Dependencies: 2727 6
-- Name: vista_contrato_dir; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contrato_dir AS
    SELECT contrato.id_contrato, calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, sector.id_franq, estado.nombre_esta, franquicia.nombre_franq FROM (((((((contrato JOIN calle ON (((contrato.id_calle)::text = (calle.id_calle)::text))) JOIN sector ON (((calle.id_sector)::text = (sector.id_sector)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) JOIN franquicia ON (((sector.id_franq)::text = (franquicia.id_franq)::text))) JOIN ciudad ON (((zona.id_ciudad)::text = (ciudad.id_ciudad)::text))) JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text)));


ALTER TABLE public.vista_contrato_dir OWNER TO postgres;

--
-- TOC entry 333 (class 1259 OID 2651064)
-- Dependencies: 2728 6
-- Name: vista_contrato_servicio_deuda; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contrato_servicio_deuda AS
    SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, pagos.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, contrato_servicio_deuda.costo_cobro, contrato_servicio_deuda.descu, contrato_servicio_deuda.inc, contrato_servicio_deuda.apagar, pagos.id_pago, contrato_servicio_deuda.pagado, pagos.tipo_doc FROM (contrato_servicio_deuda JOIN pagos ON (((contrato_servicio_deuda.id_pago)::text = (pagos.id_pago)::text)));


ALTER TABLE public.vista_contrato_servicio_deuda OWNER TO postgres;

--
-- TOC entry 334 (class 1259 OID 2651069)
-- Dependencies: 2729 824 6
-- Name: vista_contrato_status; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contrato_status AS
    SELECT contrato.id_contrato, contrato AS contrato, contrato.status_contrato, calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, sector.id_franq, estado.nombre_esta, franquicia.nombre_franq FROM (((((((contrato JOIN calle ON (((contrato.id_calle)::text = (calle.id_calle)::text))) JOIN sector ON (((calle.id_sector)::text = (sector.id_sector)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) JOIN franquicia ON (((sector.id_franq)::text = (franquicia.id_franq)::text))) JOIN ciudad ON (((zona.id_ciudad)::text = (ciudad.id_ciudad)::text))) JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text)));


ALTER TABLE public.vista_contrato_status OWNER TO postgres;

--
-- TOC entry 335 (class 1259 OID 2651074)
-- Dependencies: 2730 6
-- Name: vista_contrato_todo; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contrato_todo AS
    SELECT contrato.id_contrato, contrato.id_calle, contrato.id_venta, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.observacion, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.email, contrato.direc_adicional, contrato.numero_casa, calle.id_sector, calle.nro_calle, calle.nombre_calle, sector.id_zona, sector.nro_sector, sector.nombre_sector, franquicia.id_franq, zona.nro_zona, zona.nombre_zona, franquicia.nombre_franq, franquicia.id_emp, franquicia.id_gf, franquicia.obser_franq, franquicia.direccion_franq, contrato.id_edif, contrato.numero_piso, cliente.telf_adic, cliente.tipo_cliente, cliente.inicial_doc, cliente.fecha_nac, contrato.saldo AS deuda, contrato.postel, contrato.taps, contrato.pto, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, contrato.id_urb, zona.id_ciudad, contrato.cod_id_persona FROM ((((((((((contrato JOIN cliente ON (((contrato.cli_id_persona)::text = (cliente.id_persona)::text))) JOIN persona ON (((persona.id_persona)::text = (cliente.id_persona)::text))) JOIN calle ON (((contrato.id_calle)::text = (calle.id_calle)::text))) JOIN sector ON (((calle.id_sector)::text = (sector.id_sector)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) JOIN franquicia ON (((sector.id_franq)::text = (franquicia.id_franq)::text))) JOIN ciudad ON (((zona.id_ciudad)::text = (ciudad.id_ciudad)::text))) JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text))) JOIN grupo_afinidad ON (((contrato.id_g_a)::text = (grupo_afinidad.id_g_a)::text)));


ALTER TABLE public.vista_contrato_todo OWNER TO postgres;

--
-- TOC entry 336 (class 1259 OID 2651079)
-- Dependencies: 2731 6
-- Name: vista_contratodeu; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contratodeu AS
    SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, pagos.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, tipo_servicio.tipo_servicio, tipo_servicio.status_servicio, contrato.costo_dif_men, contrato.nro_contrato, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, servicios.tipo_costo, contrato_servicio_deuda.costo_cobro, contrato.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, zona.nombre_zona, contrato.status_contrato, contrato_servicio_deuda.descu, contrato_servicio_deuda.inc, servicios.tipo_serv, contrato_servicio_deuda.pagado, contrato_servicio_deuda.apagar, pagos.id_pago, pagos.tipo_doc FROM (((((((((pagos JOIN contrato_servicio_deuda ON (((pagos.id_pago)::text = (contrato_servicio_deuda.id_pago)::text))) JOIN servicios ON (((contrato_servicio_deuda.id_serv)::text = (servicios.id_serv)::text))) JOIN tipo_servicio ON (((servicios.id_tipo_servicio)::text = (tipo_servicio.id_tipo_servicio)::text))) JOIN contrato ON (((pagos.id_contrato)::text = (contrato.id_contrato)::text))) JOIN cliente ON (((contrato.cli_id_persona)::text = (cliente.id_persona)::text))) JOIN persona ON (((cliente.id_persona)::text = (persona.id_persona)::text))) JOIN calle ON (((contrato.id_calle)::text = (calle.id_calle)::text))) JOIN sector ON (((calle.id_sector)::text = (sector.id_sector)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) ORDER BY contrato_servicio_deuda.id_cont_serv;


ALTER TABLE public.vista_contratodeu OWNER TO postgres;

--
-- TOC entry 337 (class 1259 OID 2651084)
-- Dependencies: 2732 6
-- Name: vista_contratodeu_f; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contratodeu_f AS
    SELECT contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.id_serv, pagos.id_contrato, contrato_servicio_deuda.fecha_inst, contrato_servicio_deuda.cant_serv, contrato_servicio_deuda.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, tipo_servicio.tipo_servicio, servicios.tipo_costo, contrato_servicio_deuda.costo_cobro, contrato_servicio_deuda.descu, contrato_servicio_deuda.inc, contrato_servicio_deuda.apagar, pagos.id_pago, pagos.nro_factura, servicios.tipo_serv, pagos.tipo_doc, pagos.status_pago, contrato_servicio_deuda.pagado FROM pagos, contrato_servicio_deuda, tipo_servicio, servicios WHERE ((((contrato_servicio_deuda.id_serv)::text = (servicios.id_serv)::text) AND ((servicios.id_tipo_servicio)::text = (tipo_servicio.id_tipo_servicio)::text)) AND ((contrato_servicio_deuda.id_pago)::text = (pagos.id_pago)::text)) ORDER BY contrato_servicio_deuda.inc;


ALTER TABLE public.vista_contratodeu_f OWNER TO postgres;

--
-- TOC entry 338 (class 1259 OID 2651089)
-- Dependencies: 2733 6
-- Name: vista_contratoser; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_contratoser AS
    SELECT contrato_servicio.id_cont_serv, contrato_servicio.id_serv, contrato_servicio.id_contrato, contrato_servicio.fecha_inst, contrato_servicio.cant_serv, contrato_servicio.status_con_ser, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, tipo_servicio.tipo_servicio, tipo_servicio.status_servicio, tarifa_servicio.id_tar_ser, tarifa_servicio.fecha_tar_ser, tarifa_servicio.status_tarifa_ser, tarifa_servicio.tarifa_ser, contrato.costo_dif_men, contrato.nro_contrato, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, servicios.tipo_costo, contrato_servicio.costo_cobro, contrato.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, zona.nombre_zona, contrato.status_contrato FROM (((((((((contrato_servicio JOIN servicios ON (((contrato_servicio.id_serv)::text = (servicios.id_serv)::text))) LEFT JOIN tarifa_servicio ON ((((tarifa_servicio.id_serv)::text = (servicios.id_serv)::text) AND ((tarifa_servicio.status_tarifa_ser)::bpchar = 'ACTIVO'::bpchar)))) JOIN tipo_servicio ON (((servicios.id_tipo_servicio)::text = (tipo_servicio.id_tipo_servicio)::text))) JOIN contrato ON (((contrato_servicio.id_contrato)::text = (contrato.id_contrato)::text))) JOIN cliente ON (((contrato.cli_id_persona)::text = (cliente.id_persona)::text))) JOIN persona ON (((persona.id_persona)::text = (cliente.id_persona)::text))) JOIN calle ON (((contrato.id_calle)::text = (calle.id_calle)::text))) JOIN sector ON (((calle.id_sector)::text = (sector.id_sector)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) ORDER BY contrato_servicio.id_cont_serv;


ALTER TABLE public.vista_contratoser OWNER TO postgres;

--
-- TOC entry 339 (class 1259 OID 2651094)
-- Dependencies: 2734 6
-- Name: vista_convenio; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_convenio AS
    SELECT servicios.id_serv, servicios.nombre_servicio, conv_con.id_conv_cont, conv_con.id_conv, conv_con.id_cont_serv, conv_con.fecha_ven, conv_con.fecha_inst, conv_con.status_con_ser, conv_con.costo_cobro, convenio_pago.dato, convenio_pago.fecha_conv, convenio_pago.obser_conv, convenio_pago.login, convenio_pago.status_conv, convenio_pago.id_contrato FROM ((servicios JOIN conv_con ON (((servicios.id_serv)::text = (conv_con.id_serv)::text))) JOIN convenio_pago ON (((convenio_pago.id_conv)::text = (conv_con.id_conv)::text)));


ALTER TABLE public.vista_convenio OWNER TO postgres;

--
-- TOC entry 340 (class 1259 OID 2651099)
-- Dependencies: 2735 6
-- Name: vista_detalleorden; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_detalleorden AS
    SELECT detalle_orden.id_det_orden, detalle_orden.id_tipo_orden, detalle_orden.nombre_det_orden, tipo_orden.nombre_tipo_orden, detalle_orden.tipo_detalle, tipo_orden.status_tipord FROM (detalle_orden JOIN tipo_orden ON (((detalle_orden.id_tipo_orden)::text = (tipo_orden.id_tipo_orden)::text)));


ALTER TABLE public.vista_detalleorden OWNER TO postgres;

--
-- TOC entry 341 (class 1259 OID 2651103)
-- Dependencies: 2736 6
-- Name: vista_deuda; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_deuda AS
    SELECT pagos.id_contrato, servicios.id_serv, servicios.id_tipo_servicio, ((((contrato_servicio_deuda.cant_serv)::numeric * contrato_servicio_deuda.costo_cobro) - contrato_servicio_deuda.descu) - contrato_servicio_deuda.pagado) AS deuda, contrato_servicio_deuda.fecha_inst FROM pagos, contrato_servicio_deuda, servicios WHERE (((((pagos.id_pago)::text = (contrato_servicio_deuda.id_pago)::text) AND ((contrato_servicio_deuda.id_serv)::text = (servicios.id_serv)::text)) AND ((contrato_servicio_deuda.status_con_ser)::bpchar = 'DEUDA'::bpchar)) AND (((((contrato_servicio_deuda.cant_serv)::numeric * contrato_servicio_deuda.costo_cobro) - contrato_servicio_deuda.descu) - contrato_servicio_deuda.pagado) > (0)::numeric));


ALTER TABLE public.vista_deuda OWNER TO postgres;

--
-- TOC entry 342 (class 1259 OID 2651107)
-- Dependencies: 2737 6
-- Name: vista_deudacli; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_deudacli AS
    SELECT contrato.id_contrato, calle.id_calle, calle.id_sector, sector.id_zona, contrato.status_contrato, (SELECT sum(((contrato_servicio_deuda.cant_serv)::numeric * contrato_servicio_deuda.costo_cobro)) AS sum FROM contrato_servicio_deuda, pagos WHERE ((((pagos.id_pago)::text = (contrato_servicio_deuda.id_pago)::text) AND ((pagos.id_contrato)::text = (contrato.id_contrato)::text)) AND ((contrato_servicio_deuda.status_con_ser)::bpchar = 'DEUDA'::bpchar))) AS deuda, (SELECT sum(contrato_servicio_deuda.pagado) AS sum FROM contrato_servicio_deuda, pagos WHERE ((((pagos.id_pago)::text = (contrato_servicio_deuda.id_pago)::text) AND ((pagos.id_contrato)::text = (contrato.id_contrato)::text)) AND ((contrato_servicio_deuda.status_con_ser)::bpchar = 'PAGADO'::bpchar))) AS pagado FROM calle, contrato, sector WHERE (((calle.id_calle)::text = (contrato.id_calle)::text) AND ((calle.id_sector)::text = (sector.id_sector)::text)) ORDER BY contrato.id_contrato;


ALTER TABLE public.vista_deudacli OWNER TO postgres;

--
-- TOC entry 343 (class 1259 OID 2651112)
-- Dependencies: 2738 6
-- Name: vista_edificio; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_edificio AS
    SELECT edificio.id_edif, edificio.edificio, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, ciudad.status_ciudad, municipio.id_esta, municipio.nombre_mun, municipio.status_mun, sector.id_franq, estado.nombre_esta, estado.status_esta, franquicia.nombre_franq FROM ((((((edificio JOIN sector ON (((edificio.id_sector)::text = (sector.id_sector)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) JOIN ciudad ON (((zona.id_ciudad)::text = (ciudad.id_ciudad)::text))) JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text))) JOIN franquicia ON (((sector.id_franq)::text = (franquicia.id_franq)::text)));


ALTER TABLE public.vista_edificio OWNER TO postgres;

--
-- TOC entry 344 (class 1259 OID 2651117)
-- Dependencies: 2739 6
-- Name: vista_entidad; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_entidad AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, entidad.id_te, entidad.descrip_ent, entidad.status_ent, tipo_entidad.nombre_te, tipo_entidad.status_te FROM ((persona JOIN entidad ON (((persona.id_persona)::text = (entidad.id_persona)::text))) JOIN tipo_entidad ON (((entidad.id_te)::text = (tipo_entidad.id_te)::text))) ORDER BY persona.cedula;


ALTER TABLE public.vista_entidad OWNER TO postgres;

--
-- TOC entry 345 (class 1259 OID 2651121)
-- Dependencies: 2740 6
-- Name: vista_equipo_sistema; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_equipo_sistema AS
    SELECT contrato.id_contrato, contrato.nro_contrato, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, equipo_sistema.id_es, modelo.id_modelo, equipo_sistema.codigo_es, equipo_sistema.status_es, equipo_sistema.codigo_adic, equipo_sistema.estado_fisico, modelo.nombre_modelo, tipo_sist_equipo.id_tse, tipo_sist_equipo.abrev_nombre_tse AS sistema, equipo_sistema.tipo_es, equipo_sistema.ubicacion FROM (((((equipo_sistema JOIN modelo ON (((equipo_sistema.id_modelo)::text = (modelo.id_modelo)::text))) JOIN tipo_sist_equipo ON (((modelo.id_tse)::text = (tipo_sist_equipo.id_tse)::text))) LEFT JOIN contrato ON (((contrato.id_contrato)::text = (equipo_sistema.id_contrato)::text))) LEFT JOIN cliente ON (((contrato.cli_id_persona)::text = (cliente.id_persona)::text))) LEFT JOIN persona ON (((persona.id_persona)::text = (cliente.id_persona)::text)));


ALTER TABLE public.vista_equipo_sistema OWNER TO postgres;

--
-- TOC entry 346 (class 1259 OID 2651126)
-- Dependencies: 2741 6
-- Name: vista_franq; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_franq AS
    SELECT franquicia.id_franq, franquicia.nombre_franq, franquicia.id_emp, franquicia.obser_franq, franquicia.direccion_franq, franquicia.serie, franquicia.id_gf, grupo_franq.nombre_gf, empresa.rif_emp, empresa.razon_social_emp, empresa.nombre_comercial_emp FROM ((franquicia JOIN grupo_franq ON (((franquicia.id_gf)::text = (grupo_franq.id_gf)::text))) JOIN empresa ON (((franquicia.id_emp)::text = (empresa.id_emp)::text)));


ALTER TABLE public.vista_franq OWNER TO postgres;

--
-- TOC entry 347 (class 1259 OID 2651131)
-- Dependencies: 2742 6
-- Name: vista_gerentes; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_gerentes AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, gerentes_permitidos.nro_gerente, gerentes_permitidos.tipo_gerente, gerentes_permitidos.cargo_gerente, gerentes_permitidos.descrip_gerente, gerentes_permitidos.sattus_gerente, gerentes_permitidos.correo_gerente, gerentes_permitidos.id_franq FROM (persona JOIN gerentes_permitidos ON (((persona.id_persona)::text = (gerentes_permitidos.id_persona)::text))) ORDER BY persona.cedula;


ALTER TABLE public.vista_gerentes OWNER TO postgres;

--
-- TOC entry 348 (class 1259 OID 2651135)
-- Dependencies: 2743 6
-- Name: vista_grupo; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_grupo AS
    SELECT grupo_trabajo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.hora_creacion, grupo_trabajo.id_zona, grupo_trabajo.nombre_grupo, grupo_trabajo.status_grupo, (SELECT count(*) AS count FROM grupo_tecnico WHERE ((grupo_trabajo.id_gt)::text = (grupo_tecnico.id_gt)::text)) AS nro_tecnico, (SELECT count(*) AS count FROM grupo_ubicacion WHERE ((grupo_trabajo.id_gt)::text = (grupo_ubicacion.id_gt)::text)) AS nro_sector, franquicia.id_franq, franquicia.nombre_franq FROM grupo_trabajo, franquicia WHERE ((franquicia.id_franq)::text = (grupo_trabajo.id_franq)::text);


ALTER TABLE public.vista_grupo OWNER TO postgres;

--
-- TOC entry 349 (class 1259 OID 2651139)
-- Dependencies: 2744 6
-- Name: vista_grupotecnico; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_grupotecnico AS
    SELECT tecnico.id_persona, grupo_tecnico.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.nombre_grupo, grupo_trabajo.status_grupo, persona.cedula, persona.nombre, persona.apellido FROM (((tecnico JOIN grupo_tecnico ON (((tecnico.id_persona)::text = (grupo_tecnico.id_persona)::text))) JOIN grupo_trabajo ON (((grupo_tecnico.id_gt)::text = (grupo_trabajo.id_gt)::text))) JOIN persona ON (((tecnico.id_persona)::text = (persona.id_persona)::text)));


ALTER TABLE public.vista_grupotecnico OWNER TO postgres;

--
-- TOC entry 350 (class 1259 OID 2651144)
-- Dependencies: 2745 6
-- Name: vista_grupoubicacion; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_grupoubicacion AS
    SELECT sector.id_sector, sector.id_zona, sector.nro_sector, sector.nombre_sector, sector.n_sector, sector.afiliacion, sector.id_franq, zona.nro_zona, zona.nombre_zona, zona.n_zona, grupo_trabajo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.hora_creacion, grupo_trabajo.nombre_grupo, grupo_trabajo.status_grupo FROM (((sector JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) JOIN grupo_ubicacion ON (((sector.id_sector)::text = (grupo_ubicacion.id_sector)::text))) JOIN grupo_trabajo ON (((grupo_trabajo.id_gt)::text = (grupo_ubicacion.id_gt)::text))) ORDER BY sector.nombre_sector;


ALTER TABLE public.vista_grupoubicacion OWNER TO postgres;

--
-- TOC entry 351 (class 1259 OID 2651149)
-- Dependencies: 2746 6
-- Name: vista_gt_tec_per; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_gt_tec_per AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, tecnico.num_tecnico, tecnico.direccion_tec, tecnico.correo_tec, tecnico.status_tec, grupo_trabajo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.hora_creacion, grupo_trabajo.id_zona, grupo_trabajo.nombre_grupo FROM (((persona JOIN tecnico ON (((persona.id_persona)::text = (tecnico.id_persona)::text))) JOIN grupo_tecnico ON (((tecnico.id_persona)::text = (grupo_tecnico.id_persona)::text))) JOIN grupo_trabajo ON (((grupo_trabajo.id_gt)::text = (grupo_tecnico.id_gt)::text))) ORDER BY persona.nombre;


ALTER TABLE public.vista_gt_tec_per OWNER TO postgres;

--
-- TOC entry 352 (class 1259 OID 2651154)
-- Dependencies: 2747 6
-- Name: vista_interfaz_equipo; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_interfaz_equipo AS
    SELECT contrato.id_contrato, contrato.nro_contrato, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, equipo_sistema.id_es, modelo.id_modelo, equipo_sistema.codigo_es, equipo_sistema.status_es, equipo_sistema.codigo_adic, equipo_sistema.estado_fisico, modelo.nombre_modelo, tipo_sist_equipo.id_tse, tipo_sist_equipo.abrev_nombre_tse AS sistema, comandos_interfaz.id_com_int, comandos_interfaz.nombre_com_int, interfaz_equipos.id_inte, interfaz_equipos.status, interfaz_equipos.fecha, interfaz_equipos.login, interfaz_equipos.errmsg, interfaz_equipos.fecha_ejec, equipo_sistema.tipo_es FROM (((((((equipo_sistema JOIN interfaz_equipos ON (((interfaz_equipos.id_es)::text = (equipo_sistema.id_es)::text))) JOIN comandos_interfaz ON (((interfaz_equipos.id_com_int)::text = (comandos_interfaz.id_com_int)::text))) JOIN modelo ON (((equipo_sistema.id_modelo)::text = (modelo.id_modelo)::text))) JOIN tipo_sist_equipo ON (((modelo.id_tse)::text = (tipo_sist_equipo.id_tse)::text))) LEFT JOIN contrato ON (((contrato.id_contrato)::text = (equipo_sistema.id_contrato)::text))) LEFT JOIN cliente ON (((contrato.cli_id_persona)::text = (cliente.id_persona)::text))) LEFT JOIN persona ON (((persona.id_persona)::text = (cliente.id_persona)::text)));


ALTER TABLE public.vista_interfaz_equipo OWNER TO postgres;

--
-- TOC entry 353 (class 1259 OID 2651159)
-- Dependencies: 2748 6
-- Name: vista_llamadas; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_llamadas AS
    SELECT tipo_llamada.dato, tipo_llamada.id_tll, tipo_llamada.nombre_tll, tipo_llamada.status_tll, llamadas.id_lla, llamadas.id_drl, llamadas.id_contrato, llamadas.fecha_lla, llamadas.hora_lla, llamadas.login, llamadas.obser_lla, llamadas.crea_alarma, detalle_resp.id_trl, detalle_resp.nombre_drl, detalle_resp.status_drl, tipo_resp.nombre_trl, tipo_resp.status_trl, contrato.nro_contrato, contrato.fecha_contrato, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, persona.cedula, persona.nombre, persona.apellido, persona.telefono, cliente.telf_casa, cliente.telf_adic, contrato.direc_adicional, contrato.numero_casa, contrato.id_edif, contrato.numero_piso, urbanizacion.id_urb, contrato.id_g_a, grupo_afinidad.nombre_g_a, calle.id_calle, calle.nombre_calle, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, municipio.id_mun, ciudad.nombre_ciudad, estado.id_esta, municipio.nombre_mun, franquicia.id_franq, estado.nombre_esta, franquicia.nombre_franq, contrato.postel, contrato.pto, contrato.cod_id_persona, (((vista_cobrador.nombre)::text || ''::text) || (vista_cobrador.apellido)::text) AS cobrador, contrato.etiqueta_n, contrato.taps, contrato.tipo_fact, contrato.saldo FROM ((((((((((((((((((tipo_llamada JOIN llamadas ON (((tipo_llamada.id_tll)::text = (llamadas.id_tll)::text))) JOIN detalle_resp ON (((llamadas.id_drl)::text = (detalle_resp.id_drl)::text))) JOIN tipo_resp ON (((detalle_resp.id_trl)::text = (tipo_resp.id_trl)::text))) JOIN contrato ON (((llamadas.id_contrato)::text = (contrato.id_contrato)::text))) JOIN calle ON (((contrato.id_calle)::text = (calle.id_calle)::text))) JOIN sector ON (((calle.id_sector)::text = (sector.id_sector)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) JOIN ciudad ON (((zona.id_ciudad)::text = (ciudad.id_ciudad)::text))) JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text))) JOIN franquicia ON (((sector.id_franq)::text = (franquicia.id_franq)::text))) JOIN cliente ON (((contrato.cli_id_persona)::text = (cliente.id_persona)::text))) JOIN persona ON (((persona.id_persona)::text = (cliente.id_persona)::text))) JOIN grupo_afinidad ON (((contrato.id_g_a)::text = (grupo_afinidad.id_g_a)::text))) JOIN vista_cobrador ON (((vista_cobrador.id_persona)::text = (contrato.cod_id_persona)::text))) JOIN statuscont ON (((statuscont.status_contrato)::text = (contrato.status_contrato)::text))) LEFT JOIN edificio ON (((contrato.id_edif)::text = (edificio.id_edif)::text))) LEFT JOIN urbanizacion ON (((contrato.id_urb)::text = (urbanizacion.id_urb)::text))) ORDER BY llamadas.fecha_lla DESC, llamadas.hora_lla DESC;


ALTER TABLE public.vista_llamadas OWNER TO postgres;

--
-- TOC entry 354 (class 1259 OID 2651164)
-- Dependencies: 2749 6
-- Name: vista_materiales; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_materiales AS
    SELECT materiales.id_mat, materiales.id_dep, materiales.stock, materiales.stock_min, materiales.observacion, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.id_unidad, mat_padre.uni_id_unidad, mat_padre.id_fam, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, familia.nombre_fam, familia.status_fam, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, mat_padre.impresion, deposito.id_franq FROM unidad_medida, materiales, deposito, familia, mat_padre WHERE (((((materiales.id_dep)::text = (deposito.id_dep)::text) AND ((mat_padre.id_unidad)::text = (unidad_medida.id_unidad)::text)) AND ((materiales.id_m)::text = (mat_padre.id_m)::text)) AND ((mat_padre.id_fam)::text = (familia.id_fam)::text)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_materiales OWNER TO postgres;

--
-- TOC entry 355 (class 1259 OID 2651169)
-- Dependencies: 2750 6
-- Name: vista_materiales_orden; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_materiales_orden AS
    SELECT materiales.id_mat, materiales.id_dep, materiales.stock, materiales.stock_min, materiales.observacion, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.id_unidad, mat_padre.uni_id_unidad, mat_padre.id_fam, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, familia.nombre_fam, familia.status_fam, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, mat_padre.impresion FROM unidad_medida, materiales, deposito, familia, mat_padre WHERE (((((materiales.id_dep)::text = (deposito.id_dep)::text) AND ((mat_padre.id_unidad)::text = (unidad_medida.id_unidad)::text)) AND ((materiales.id_m)::text = (mat_padre.id_m)::text)) AND ((mat_padre.id_fam)::text = (familia.id_fam)::text)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_materiales_orden OWNER TO postgres;

--
-- TOC entry 356 (class 1259 OID 2651174)
-- Dependencies: 2751 6
-- Name: vista_materiales_prov; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_materiales_prov AS
    SELECT pedido.id_prov, materiales.id_mat, materiales.id_dep, materiales.stock, materiales.stock_min, materiales.observacion, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.id_unidad, mat_padre.uni_id_unidad, mat_padre.id_fam, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, familia.nombre_fam, familia.status_fam, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad FROM unidad_medida, materiales, deposito, familia, mat_padre, pedido, mat_ped WHERE (((((((materiales.id_mat)::text = (mat_ped.id_mat)::text) AND ((pedido.id_ped)::text = (mat_ped.id_ped)::text)) AND ((materiales.id_dep)::text = (deposito.id_dep)::text)) AND ((mat_padre.id_unidad)::text = (unidad_medida.id_unidad)::text)) AND ((materiales.id_m)::text = (mat_padre.id_m)::text)) AND ((mat_padre.id_fam)::text = (familia.id_fam)::text)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_materiales_prov OWNER TO postgres;

--
-- TOC entry 357 (class 1259 OID 2651179)
-- Dependencies: 2752 6
-- Name: vista_materiales_unid; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_materiales_unid AS
    SELECT us.id_unidad AS us_id, us.nombre_unidad AS us_nombre, us.abreviatura AS us_abre, materiales.id_mat, materiales.id_dep, materiales.stock, materiales.stock_min, materiales.observacion, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.id_unidad, mat_padre.uni_id_unidad, mat_padre.id_fam, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, familia.nombre_fam, familia.status_fam, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad FROM unidad_medida us, unidad_medida, materiales, deposito, familia, mat_padre WHERE ((((((materiales.id_dep)::text = (deposito.id_dep)::text) AND ((mat_padre.uni_id_unidad)::text = (us.id_unidad)::text)) AND ((mat_padre.id_unidad)::text = (unidad_medida.id_unidad)::text)) AND ((materiales.id_m)::text = (mat_padre.id_m)::text)) AND ((mat_padre.id_fam)::text = (familia.id_fam)::text)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_materiales_unid OWNER TO postgres;

--
-- TOC entry 358 (class 1259 OID 2651184)
-- Dependencies: 2753 6
-- Name: vista_materialesuniinv; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_materialesuniinv AS
    SELECT inventario_materiales.id_mat, inventario_materiales.id_inv, inventario_materiales.cant_sist, inventario_materiales.cant_real, inventario_materiales.justi_inv, vista_materiales_unid.us_id, vista_materiales_unid.us_nombre, vista_materiales_unid.us_abre, vista_materiales_unid.id_dep, vista_materiales_unid.stock, vista_materiales_unid.stock_min, vista_materiales_unid.observacion, vista_materiales_unid.id_m, vista_materiales_unid.numero_mat, vista_materiales_unid.nombre_mat, vista_materiales_unid.id_unidad, vista_materiales_unid.uni_id_unidad, vista_materiales_unid.id_fam, vista_materiales_unid.precio_u_p, vista_materiales_unid.c_uni_ent, vista_materiales_unid.c_uni_sal, vista_materiales_unid.nombre_dep, vista_materiales_unid.descrip_dep, vista_materiales_unid.status_dep, vista_materiales_unid.nombre_fam, vista_materiales_unid.status_fam, vista_materiales_unid.nombre_unidad, vista_materiales_unid.abreviatura, vista_materiales_unid.status_unidad FROM inventario_materiales, vista_materiales_unid WHERE ((inventario_materiales.id_mat)::text = (vista_materiales_unid.id_mat)::text);


ALTER TABLE public.vista_materialesuniinv OWNER TO postgres;

--
-- TOC entry 359 (class 1259 OID 2651189)
-- Dependencies: 2754 6
-- Name: vista_matpadre; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_matpadre AS
    SELECT unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, familia.id_fam, familia.nombre_fam, familia.status_fam, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, mat_padre.uni_id_unidad, mat_padre.impresion FROM unidad_medida, familia, mat_padre WHERE (((mat_padre.id_unidad)::text = (unidad_medida.id_unidad)::text) AND ((mat_padre.id_fam)::text = (familia.id_fam)::text)) ORDER BY mat_padre.numero_mat;


ALTER TABLE public.vista_matpadre OWNER TO postgres;

--
-- TOC entry 360 (class 1259 OID 2651193)
-- Dependencies: 2755 6
-- Name: vista_matpadre_und; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_matpadre_und AS
    SELECT us.id_unidad AS us_id, us.nombre_unidad AS us_nombre, us.abreviatura AS us_abre, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, familia.id_fam, familia.nombre_fam, familia.status_fam, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, mat_padre.uni_id_unidad FROM unidad_medida us, unidad_medida, familia, mat_padre WHERE ((((mat_padre.uni_id_unidad)::text = (us.id_unidad)::text) AND ((mat_padre.id_unidad)::text = (unidad_medida.id_unidad)::text)) AND ((mat_padre.id_fam)::text = (familia.id_fam)::text)) ORDER BY mat_padre.numero_mat;


ALTER TABLE public.vista_matpadre_und OWNER TO postgres;

--
-- TOC entry 361 (class 1259 OID 2651197)
-- Dependencies: 2756 6
-- Name: vista_matped; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_matped AS
    SELECT materiales.id_mat, mat_padre.nombre_mat, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, mat_padre.numero_mat, materiales.id_dep, mat_padre.id_fam, materiales.stock, materiales.stock_min, deposito.nombre_dep, mat_ped.id_ped, mat_ped.cant_ped, mat_ped.cant_ent, mat_ped.precio, familia.nombre_fam FROM unidad_medida, materiales, deposito, familia, mat_ped, mat_padre WHERE ((((((mat_padre.id_unidad)::text = (unidad_medida.id_unidad)::text) AND ((materiales.id_dep)::text = (deposito.id_dep)::text)) AND ((materiales.id_m)::text = (mat_padre.id_m)::text)) AND ((familia.id_fam)::text = (mat_padre.id_fam)::text)) AND ((materiales.id_mat)::text = (mat_ped.id_mat)::text)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_matped OWNER TO postgres;

--
-- TOC entry 362 (class 1259 OID 2651202)
-- Dependencies: 2757 6
-- Name: vista_matped_und; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_matped_und AS
    SELECT us.id_unidad AS us_id, us.nombre_unidad AS us_nombre, us.abreviatura AS us_abre, materiales.id_mat, mat_padre.nombre_mat, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, mat_padre.numero_mat, materiales.id_dep, mat_padre.id_fam, mat_padre.c_uni_ent, mat_padre.c_uni_sal, materiales.stock, materiales.stock_min, deposito.nombre_dep, mat_ped.id_ped, mat_ped.cant_ped, mat_ped.cant_ent, mat_ped.precio, familia.nombre_fam FROM unidad_medida us, unidad_medida, materiales, deposito, familia, mat_ped, mat_padre WHERE (((((((mat_padre.id_unidad)::text = (unidad_medida.id_unidad)::text) AND ((mat_padre.uni_id_unidad)::text = (us.id_unidad)::text)) AND ((materiales.id_dep)::text = (deposito.id_dep)::text)) AND ((materiales.id_m)::text = (mat_padre.id_m)::text)) AND ((familia.id_fam)::text = (mat_padre.id_fam)::text)) AND ((materiales.id_mat)::text = (mat_ped.id_mat)::text)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_matped_und OWNER TO postgres;

--
-- TOC entry 363 (class 1259 OID 2651207)
-- Dependencies: 2758 6
-- Name: vista_modelo; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_modelo AS
    SELECT marca.id_marca, marca.nombre_marca, marca.status_marca, modelo.id_modelo, modelo.nombre_modelo, modelo.id_tse, modelo.status_modelo, (((tipo_sist_equipo.sistema)::text || ''::text) || (tipo_sist_equipo.ubicacion)::text) AS sistema FROM ((modelo JOIN marca ON (((marca.id_marca)::text = (modelo.id_marca)::text))) JOIN tipo_sist_equipo ON (((modelo.id_tse)::text = (tipo_sist_equipo.id_tse)::text)));


ALTER TABLE public.vista_modelo OWNER TO postgres;

--
-- TOC entry 364 (class 1259 OID 2651211)
-- Dependencies: 2759 6
-- Name: vista_mov_mat_o; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_mov_mat_o AS
    SELECT mov_mat_orden.id_mat, mov_mat_orden.cant_mov, tipo_movimiento.id_tm, tipo_movimiento.nombre_tm, tipo_movimiento.tipo_ent_sal, tipo_movimiento.uso_tm, tipo_movimiento.status_tm, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, movimiento_orden.id_mov, movimiento_orden.fecha_ent_sal, movimiento_orden.hora_ent_sal, movimiento_orden.observacion, movimiento_orden.referencia, movimiento_orden.tipo_mov, us.id_unidad AS us_id, us.nombre_unidad AS us_nombre, us.abreviatura AS us_abre, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, familia.id_fam, familia.nombre_fam, familia.status_fam, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, mat_padre.uni_id_unidad, materiales.stock, materiales.stock_min FROM tipo_movimiento, deposito, movimiento_orden, mov_mat_orden, unidad_medida us, unidad_medida, familia, mat_padre, materiales WHERE (((((((((movimiento_orden.tipo_mov)::text = (deposito.id_dep)::text) AND ((movimiento_orden.id_tm)::text = (tipo_movimiento.id_tm)::text)) AND ((movimiento_orden.id_mov)::text = (mov_mat_orden.id_mov)::text)) AND ((materiales.id_m)::text = (mat_padre.id_m)::text)) AND ((mat_padre.uni_id_unidad)::text = (us.id_unidad)::text)) AND ((mat_padre.id_unidad)::text = (unidad_medida.id_unidad)::text)) AND ((mat_padre.id_fam)::text = (familia.id_fam)::text)) AND ((mov_mat_orden.id_mat)::text = (materiales.id_mat)::text)) ORDER BY movimiento_orden.fecha_ent_sal, movimiento_orden.hora_ent_sal;


ALTER TABLE public.vista_mov_mat_o OWNER TO postgres;

--
-- TOC entry 365 (class 1259 OID 2651216)
-- Dependencies: 2760 6
-- Name: vista_mov_materiales; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_mov_materiales AS
    SELECT mov_mat.id_mat, mov_mat.cant_mov, tipo_movimiento.id_tm, tipo_movimiento.nombre_tm, tipo_movimiento.tipo_ent_sal, tipo_movimiento.uso_tm, tipo_movimiento.status_tm, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, movimiento.id_mov, movimiento.fecha_ent_sal, movimiento.hora_ent_sal, movimiento.observacion, movimiento.referencia, movimiento.tipo_mov, materiales.id_m, entidad.id_te, entidad.id_persona, movimiento.num_mov FROM tipo_movimiento, deposito, movimiento, mov_mat, materiales, entidad WHERE ((((((movimiento.tipo_mov)::text = (deposito.id_dep)::text) AND ((movimiento.id_tm)::text = (tipo_movimiento.id_tm)::text)) AND ((movimiento.id_mov)::text = (mov_mat.id_mov)::text)) AND ((materiales.id_mat)::text = (mov_mat.id_mat)::text)) AND ((movimiento.id_persona)::text = (entidad.id_persona)::text)) ORDER BY movimiento.fecha_ent_sal, movimiento.hora_ent_sal;


ALTER TABLE public.vista_mov_materiales OWNER TO postgres;

--
-- TOC entry 366 (class 1259 OID 2651221)
-- Dependencies: 2761 6
-- Name: vista_movimiento_mov_mat; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_movimiento_mov_mat AS
    SELECT mov_mat.id_mat, mov_mat.cant_mov, tipo_movimiento.id_tm, tipo_movimiento.nombre_tm, tipo_movimiento.tipo_ent_sal, tipo_movimiento.uso_tm, tipo_movimiento.status_tm, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, movimiento.id_mov, movimiento.fecha_ent_sal, movimiento.hora_ent_sal, movimiento.observacion, movimiento.referencia, movimiento.tipo_mov, movimiento.num_mov FROM tipo_movimiento, deposito, movimiento, mov_mat WHERE ((((movimiento.tipo_mov)::text = (deposito.id_dep)::text) AND ((movimiento.id_tm)::text = (tipo_movimiento.id_tm)::text)) AND ((movimiento.id_mov)::text = (mov_mat.id_mov)::text)) ORDER BY movimiento.fecha_ent_sal, movimiento.hora_ent_sal;


ALTER TABLE public.vista_movimiento_mov_mat OWNER TO postgres;

--
-- TOC entry 367 (class 1259 OID 2651226)
-- Dependencies: 2762 6
-- Name: vista_movimiento_mov_mat_uni; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_movimiento_mov_mat_uni AS
    SELECT mov_mat.id_mat, mov_mat.cant_mov, tipo_movimiento.id_tm, tipo_movimiento.nombre_tm, tipo_movimiento.tipo_ent_sal, tipo_movimiento.uso_tm, tipo_movimiento.status_tm, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, movimiento.id_mov, movimiento.fecha_ent_sal, movimiento.hora_ent_sal, movimiento.observacion, movimiento.referencia, movimiento.tipo_mov, us.id_unidad AS us_id, us.nombre_unidad AS us_nombre, us.abreviatura AS us_abre, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, familia.id_fam, familia.nombre_fam, familia.status_fam, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, mat_padre.uni_id_unidad, materiales.stock, materiales.stock_min FROM tipo_movimiento, deposito, movimiento, mov_mat, unidad_medida us, unidad_medida, familia, mat_padre, materiales WHERE (((((((((movimiento.tipo_mov)::text = (deposito.id_dep)::text) AND ((movimiento.id_tm)::text = (tipo_movimiento.id_tm)::text)) AND ((movimiento.id_mov)::text = (mov_mat.id_mov)::text)) AND ((materiales.id_m)::text = (mat_padre.id_m)::text)) AND ((mat_padre.uni_id_unidad)::text = (us.id_unidad)::text)) AND ((mat_padre.id_unidad)::text = (unidad_medida.id_unidad)::text)) AND ((mat_padre.id_fam)::text = (familia.id_fam)::text)) AND ((mov_mat.id_mat)::text = (materiales.id_mat)::text)) ORDER BY movimiento.fecha_ent_sal, movimiento.hora_ent_sal;


ALTER TABLE public.vista_movimiento_mov_mat_uni OWNER TO postgres;

--
-- TOC entry 368 (class 1259 OID 2651231)
-- Dependencies: 2763 6
-- Name: vista_municipio; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_municipio AS
    SELECT municipio.id_mun, municipio.id_esta, municipio.nombre_mun, municipio.status_mun, estado.nombre_esta, estado.status_esta FROM (municipio JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text))) ORDER BY municipio.id_mun;


ALTER TABLE public.vista_municipio OWNER TO postgres;

--
-- TOC entry 369 (class 1259 OID 2651235)
-- Dependencies: 2764 6
-- Name: vista_ubica; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_ubica AS
    SELECT calle.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, municipio.id_esta, municipio.nombre_mun, franquicia.id_franq, zona.nombre_zona, franquicia.nombre_franq, sector.id_franq AS id_pais, estado.nombre_esta, zona.n_zona FROM ((((((calle JOIN sector ON (((sector.id_sector)::text = (calle.id_sector)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) JOIN ciudad ON (((zona.id_ciudad)::text = (ciudad.id_ciudad)::text))) JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN franquicia ON (((sector.id_franq)::text = (franquicia.id_franq)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text)));


ALTER TABLE public.vista_ubica OWNER TO postgres;

--
-- TOC entry 370 (class 1259 OID 2651240)
-- Dependencies: 2765 6
-- Name: vista_notas; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_notas AS
    SELECT notas.id_nota, notas.login, notas.id_cont_serv, notas.tipo, notas.dir_ip, notas.fecha, notas.hora, notas.monto_anterior, notas.monto_posterior, notas.idmotivonota, notas.comentario, notas.status, notas.generado_por, motivonotas.nombremotivonota, contrato.id_contrato, contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, contrato.status_contrato, vista_ubica.id_sector, vista_ubica.nombre_calle, persona.id_persona, persona.cedula, persona.nombre, persona.apellido, vista_ubica.id_zona, vista_ubica.nombre_sector, vista_ubica.id_franq, vista_ubica.nombre_zona, vista_ubica.nombre_franq, vista_ubica.nombre_ciudad, notas.login_aut, notas.servicio, notas.fecha_inst, notas.nro_nota, notas.monto_nota FROM (((((notas JOIN motivonotas ON (((notas.idmotivonota)::text = (motivonotas.idmotivonota)::text))) JOIN contrato ON (((contrato.id_contrato)::text = (notas.id_contrato)::text))) JOIN cliente ON (((cliente.id_persona)::text = (contrato.cli_id_persona)::text))) JOIN persona ON (((persona.id_persona)::text = (cliente.id_persona)::text))) JOIN vista_ubica ON (((contrato.id_calle)::text = (vista_ubica.id_calle)::text))) ORDER BY notas.id_nota;


ALTER TABLE public.vista_notas OWNER TO postgres;

--
-- TOC entry 371 (class 1259 OID 2651245)
-- Dependencies: 2766 6
-- Name: vista_notas_cd; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_notas_cd AS
    SELECT notas_cd.id_nota, notas_cd.login_sol, notas_cd.tipo, notas_cd.dir_ip_sol, notas_cd.fecha_sol, notas_cd.hora_sol, notas_cd.idmotivonota, notas_cd.comentario_sol, notas_cd.status, motivonotas.nombremotivonota, contrato.id_contrato, contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, contrato.status_contrato, vista_ubica.id_sector, vista_ubica.nombre_calle, persona.id_persona, persona.cedula, persona.nombre, persona.apellido, vista_ubica.id_zona, vista_ubica.nombre_sector, vista_ubica.id_franq, vista_ubica.nombre_zona, vista_ubica.nombre_franq, vista_ubica.nombre_ciudad, notas_cd.login_aut, pagos.monto_pago, pagos.id_pago FROM ((((((notas_cd JOIN motivonotas ON (((notas_cd.idmotivonota)::text = (motivonotas.idmotivonota)::text))) JOIN pagos ON (((pagos.id_pago)::text = (notas_cd.id_pago)::text))) JOIN contrato ON (((contrato.id_contrato)::text = (pagos.id_contrato)::text))) JOIN cliente ON (((cliente.id_persona)::text = (contrato.cli_id_persona)::text))) JOIN persona ON (((persona.id_persona)::text = (cliente.id_persona)::text))) JOIN vista_ubica ON (((contrato.id_calle)::text = (vista_ubica.id_calle)::text)));


ALTER TABLE public.vista_notas_cd OWNER TO postgres;

--
-- TOC entry 372 (class 1259 OID 2651250)
-- Dependencies: 2767 6
-- Name: vista_orden; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_orden AS
    SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, contrato.status_contrato, orden_grupo.id_gt, grupo_trabajo.nombre_grupo, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, ordenes_tecnicos.login AS login_emi, ordenes_tecnicos.hora AS hora_emi, ordenes_tecnicos.login_imp, ordenes_tecnicos.hora_imp, ordenes_tecnicos.login_fin, ordenes_tecnicos.hora_fin, contrato.id_calle, calle.id_sector, calle.nombre_calle, sector.id_zona, sector.nombre_sector, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, estado.id_esta, municipio.nombre_mun, sector.id_franq, zona.nombre_zona, estado.nombre_esta, grupo_afinidad.id_g_a, grupo_afinidad.nombre_g_a, contrato.contrato_fisico, contrato.postel, franquicia.nombre_franq, contrato.saldo, statuscont.color, contrato.pto, ordenes_tecnicos.comentario_cliente FROM ((((((((((((((((ordenes_tecnicos JOIN detalle_orden ON (((detalle_orden.id_det_orden)::text = (ordenes_tecnicos.id_det_orden)::text))) JOIN contrato ON (((ordenes_tecnicos.id_contrato)::text = (contrato.id_contrato)::text))) JOIN statuscont ON (((statuscont.status_contrato)::text = (contrato.status_contrato)::text))) JOIN tipo_orden ON (((tipo_orden.id_tipo_orden)::text = (detalle_orden.id_tipo_orden)::text))) JOIN grupo_afinidad ON (((grupo_afinidad.id_g_a)::text = (contrato.id_g_a)::text))) JOIN cliente ON (((contrato.cli_id_persona)::text = (cliente.id_persona)::text))) JOIN persona ON (((persona.id_persona)::text = (cliente.id_persona)::text))) JOIN calle ON (((contrato.id_calle)::text = (calle.id_calle)::text))) JOIN sector ON (((calle.id_sector)::text = (sector.id_sector)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) JOIN ciudad ON (((zona.id_ciudad)::text = (ciudad.id_ciudad)::text))) JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text))) LEFT JOIN orden_grupo ON (((ordenes_tecnicos.id_orden)::text = (orden_grupo.id_orden)::text))) LEFT JOIN grupo_trabajo ON (((orden_grupo.id_gt)::text = (grupo_trabajo.id_gt)::text))) JOIN franquicia ON (((sector.id_franq)::text = (franquicia.id_franq)::text)));


ALTER TABLE public.vista_orden OWNER TO postgres;

--
-- TOC entry 373 (class 1259 OID 2651255)
-- Dependencies: 2768 6
-- Name: vista_orden_imp; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_orden_imp AS
    SELECT ordenes_tecnicos.id_orden, ordenes_tecnicos.id_det_orden, ordenes_tecnicos.detalle_orden, ordenes_tecnicos.comentario_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.id_contrato, ordenes_tecnicos.prioridad, tipo_orden.id_tipo_orden, tipo_orden.nombre_tipo_orden, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, detalle_orden.nombre_det_orden, detalle_orden.tipo_detalle, contrato.cli_id_persona, contrato.nro_contrato, contrato.etiqueta, contrato.status_contrato, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, ordenes_tecnicos.login AS login_emi, ordenes_tecnicos.hora AS hora_emi, ordenes_tecnicos.login_imp, ordenes_tecnicos.hora_imp, ordenes_tecnicos.login_fin, ordenes_tecnicos.hora_fin, contrato.id_calle, vista_ubica.id_sector, vista_ubica.nombre_calle, vista_ubica.id_zona, vista_ubica.nombre_sector, vista_ubica.id_ciudad, vista_ubica.id_mun, vista_ubica.nombre_ciudad, vista_ubica.id_esta, vista_ubica.nombre_mun, vista_ubica.id_franq, vista_ubica.nombre_zona, vista_ubica.nombre_franq, vista_ubica.nombre_esta, contrato.contrato_fisico FROM detalle_orden, contrato, ordenes_tecnicos, tipo_orden, persona, cliente, vista_ubica WHERE (((((((tipo_orden.id_tipo_orden)::text = (detalle_orden.id_tipo_orden)::text) AND ((detalle_orden.id_det_orden)::text = (ordenes_tecnicos.id_det_orden)::text)) AND ((ordenes_tecnicos.id_contrato)::text = (contrato.id_contrato)::text)) AND ((contrato.cli_id_persona)::text = (cliente.id_persona)::text)) AND ((cliente.id_persona)::text = (persona.id_persona)::text)) AND ((contrato.id_calle)::text = (vista_ubica.id_calle)::text)) ORDER BY ordenes_tecnicos.id_orden;


ALTER TABLE public.vista_orden_imp OWNER TO postgres;

--
-- TOC entry 374 (class 1259 OID 2651260)
-- Dependencies: 2769 6
-- Name: vista_orden_rep; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_orden_rep AS
    SELECT ordenes_tecnicos.id_det_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, vista_ubica.id_franq, ordenes_tecnicos.fecha_canc, ordenes_tecnicos.id_orden FROM ordenes_tecnicos, vista_ubica, contrato WHERE (((contrato.id_calle)::text = (vista_ubica.id_calle)::text) AND ((ordenes_tecnicos.id_contrato)::text = (contrato.id_contrato)::text));


ALTER TABLE public.vista_orden_rep OWNER TO postgres;

--
-- TOC entry 375 (class 1259 OID 2651264)
-- Dependencies: 2770 6
-- Name: vista_orden_rep_con; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_orden_rep_con AS
    SELECT ordenes_tecnicos.id_det_orden, ordenes_tecnicos.status_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_imp, ordenes_tecnicos.fecha_final, ordenes_tecnicos.fecha_cierre, vista_ubica.id_franq, ordenes_tecnicos.fecha_canc, contrato.id_contrato, ordenes_tecnicos.id_orden FROM ordenes_tecnicos, vista_ubica, contrato WHERE (((contrato.id_calle)::text = (vista_ubica.id_calle)::text) AND ((ordenes_tecnicos.id_contrato)::text = (contrato.id_contrato)::text));


ALTER TABLE public.vista_orden_rep_con OWNER TO postgres;

--
-- TOC entry 376 (class 1259 OID 2651268)
-- Dependencies: 2771 6
-- Name: vista_ordengrupo; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_ordengrupo AS
    SELECT detalle_orden.id_det_orden, detalle_orden.id_tipo_orden, ordenes_tecnicos.id_orden, ordenes_tecnicos.fecha_orden, ordenes_tecnicos.fecha_final, ordenes_tecnicos.status_orden, orden_grupo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.status_grupo, grupo_trabajo.nombre_grupo FROM (((detalle_orden JOIN ordenes_tecnicos ON (((ordenes_tecnicos.id_det_orden)::text = (detalle_orden.id_det_orden)::text))) JOIN orden_grupo ON (((orden_grupo.id_orden)::text = (ordenes_tecnicos.id_orden)::text))) JOIN grupo_trabajo ON (((grupo_trabajo.id_gt)::text = (orden_grupo.id_gt)::text)));


ALTER TABLE public.vista_ordengrupo OWNER TO postgres;

--
-- TOC entry 377 (class 1259 OID 2651273)
-- Dependencies: 2772 6
-- Name: vista_pago; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_pago AS
    SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, pagos.status_pago, pagos.nro_factura, pagos.id_contrato, pagos.nro_control, pagos.desc_pago, (pagos.monto_pago / ((pagos.por_iva / (100)::numeric) + (1)::numeric)) AS base_imp, (((pagos.monto_pago / ((pagos.por_iva / (100)::numeric) + (1)::numeric)) * (12)::numeric) / (100)::numeric) AS monto_iva, pagos.n_credito, pagos.n_credito AS nota_credito, pagos.fecha_factura, pagos.impresion, pagos.inc, pagos.obser_pago, pagos.tipo_doc, pagos.desc_pago AS por_reten, pagos.desc_pago AS monto_reten, pagos.desc_pago AS islr, pagos.inc AS cont FROM pagos;


ALTER TABLE public.vista_pago OWNER TO postgres;

--
-- TOC entry 378 (class 1259 OID 2651278)
-- Dependencies: 2773 6
-- Name: vista_pago_cont; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_pago_cont AS
    SELECT pagos.id_pago, pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, pagos.status_pago, pagos.nro_factura, pagos.id_contrato, contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, contrato.status_contrato, persona.cedula AS cedulacli, persona.nombre AS nombrecli, persona.apellido AS apellidocli, cliente.tipo_cliente, cliente.inicial_doc, caja.tipo_caja, caja_cobrador.id_persona AS id_persona_cob, contrato.taps, caja.id_caja, caja.id_franq, pagos.nro_control, pagos.desc_pago, (pagos.monto_pago / ((pagos.por_iva / (100)::numeric) + (1)::numeric)) AS base_imp, (((pagos.monto_pago / ((pagos.por_iva / (100)::numeric) + (1)::numeric)) * (12)::numeric) / (100)::numeric) AS monto_iva, pagos.n_credito, pagos.fecha_factura, caja_cobrador.id_est, pagos.impresion, pagos.inc, zona.nombre_zona, sector.nombre_sector, pagos.obser_pago, sector.id_sector, pagos.tipo_doc, pagos.desc_pago AS por_reten, pagos.desc_pago AS monto_reten, pagos.desc_pago AS islr, pagos.inc AS cont FROM ((((((((pagos JOIN contrato ON (((contrato.id_contrato)::text = (pagos.id_contrato)::text))) JOIN cliente ON (((cliente.id_persona)::text = (contrato.cli_id_persona)::text))) JOIN persona ON (((persona.id_persona)::text = (cliente.id_persona)::text))) JOIN caja_cobrador ON (((pagos.id_caja_cob)::text = (caja_cobrador.id_caja_cob)::text))) JOIN caja ON (((caja_cobrador.id_caja)::text = (caja.id_caja)::text))) JOIN calle ON (((calle.id_calle)::text = (contrato.id_calle)::text))) JOIN sector ON (((calle.id_sector)::text = (sector.id_sector)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text)));


ALTER TABLE public.vista_pago_cont OWNER TO postgres;

--
-- TOC entry 379 (class 1259 OID 2651283)
-- Dependencies: 2774 6
-- Name: vista_pago_ser; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_pago_ser AS
    SELECT pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, contrato_servicio_deuda.cant_serv, pago_factura.costo_cobro_serv AS costo_cobro, contrato_servicio_deuda.id_serv, pagos.status_pago, caja.tipo_caja, pagos.id_pago, contrato_servicio_deuda.fecha_inst, servicios.nombre_servicio, caja.id_franq, caja_cobrador.id_est, contrato_servicio_deuda.descu, pagos.nro_factura, pagos.id_contrato, caja_cobrador.id_persona, pagos.obser_pago, servicios.tipo_serv, contrato_servicio_deuda.id_cont_serv, contrato_servicio_deuda.costo_cobro AS costo_cobro_fact, contrato_servicio_deuda.status_con_ser, pagos.tipo_doc, contrato_servicio_deuda.pagado FROM (((((pago_factura JOIN pagos ON (((pagos.id_pago)::text = (pago_factura.id_pago)::text))) JOIN contrato_servicio_deuda ON (((pago_factura.id_cont_serv)::text = (contrato_servicio_deuda.id_cont_serv)::text))) JOIN caja_cobrador ON (((pagos.id_caja_cob)::text = (caja_cobrador.id_caja_cob)::text))) JOIN caja ON (((caja_cobrador.id_caja)::text = (caja.id_caja)::text))) JOIN servicios ON (((contrato_servicio_deuda.id_serv)::text = (servicios.id_serv)::text)));


ALTER TABLE public.vista_pago_ser OWNER TO postgres;

--
-- TOC entry 380 (class 1259 OID 2651288)
-- Dependencies: 2775 6
-- Name: vista_pagodeposito; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_pagodeposito AS
    SELECT persona.cedula, persona.nombre, persona.apellido, contrato.nro_contrato, sector.nombre_sector, franquicia.nombre_franq, franquicia.id_franq, pagodeposito.monto_dep, pagodeposito.id_pd, pagodeposito.id_contrato, pagodeposito.fecha_reg, pagodeposito.hora_reg, pagodeposito.login_reg, pagodeposito.fecha_dep, pagodeposito.banco, pagodeposito.numero_ref, pagodeposito.fecha_conf, pagodeposito.hora_conf, pagodeposito.login_conf, pagodeposito.fecha_proc, pagodeposito.tipo_dt, pagodeposito.login_proc, pagodeposito.status_pd, ciudad.id_mun, pagodeposito.cedula_titular, pagodeposito.obser_p FROM ((((((((((cliente JOIN contrato ON (((cliente.id_persona)::text = (contrato.cli_id_persona)::text))) JOIN calle ON (((contrato.id_calle)::text = (calle.id_calle)::text))) JOIN sector ON (((calle.id_sector)::text = (sector.id_sector)::text))) JOIN persona ON (((persona.id_persona)::text = (cliente.id_persona)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) JOIN ciudad ON (((zona.id_ciudad)::text = (ciudad.id_ciudad)::text))) JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text))) JOIN franquicia ON (((sector.id_franq)::text = (franquicia.id_franq)::text))) JOIN pagodeposito ON (((pagodeposito.id_contrato)::text = (contrato.id_contrato)::text))) ORDER BY pagodeposito.fecha_reg, pagodeposito.hora_reg;


ALTER TABLE public.vista_pagodeposito OWNER TO postgres;

--
-- TOC entry 381 (class 1259 OID 2651293)
-- Dependencies: 2776 6
-- Name: vista_pedido; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_pedido AS
    SELECT pedido.id_ped, pedido.id_prov, pedido.fecha_ped, pedido.fecha_ent, pedido.status_ped, pedido.obser_ped, pedido.nro_fact_ped, pedido.porc_desc, pedido.desc_ped, pedido.base_ped, pedido.iva_ped, pedido.total_ped, proveedor.rif_prov, proveedor.nombre_prov, proveedor.direccion_prov, proveedor.telefonos_prov, proveedor.fax_prov, proveedor.web_prov, proveedor.email_prov, proveedor.obser_prov, proveedor.forma_pago, proveedor.banco, proveedor.cuenta, proveedor.status_prov, proveedor.contacto, pedido.num_ped, pedido.login_sol, pedido.login_apr, pedido.login_com FROM pedido, proveedor WHERE ((pedido.id_prov)::text = (proveedor.id_prov)::text) ORDER BY pedido.num_ped DESC;


ALTER TABLE public.vista_pedido OWNER TO postgres;

--
-- TOC entry 382 (class 1259 OID 2651298)
-- Dependencies: 2777 6
-- Name: vista_planillainv; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_planillainv AS
    SELECT inventario_materiales.id_mat, inventario_materiales.id_inv, inventario_materiales.cant_sist, inventario_materiales.cant_real, inventario_materiales.justi_inv, inventario.id_motivo, inventario.fecha_inv, inventario.hora_inv, inventario.obser_inv, inventario.tipo_inv, inventario.id_dep, inventario.id_fam, inventario.status_inv, vista_materiales_unid.us_id, vista_materiales_unid.us_nombre, vista_materiales_unid.us_abre, vista_materiales_unid.stock, vista_materiales_unid.stock_min, vista_materiales_unid.observacion, vista_materiales_unid.id_m, vista_materiales_unid.numero_mat, vista_materiales_unid.nombre_mat, vista_materiales_unid.id_unidad, vista_materiales_unid.uni_id_unidad, vista_materiales_unid.precio_u_p, vista_materiales_unid.c_uni_ent, vista_materiales_unid.c_uni_sal, vista_materiales_unid.nombre_dep, vista_materiales_unid.descrip_dep, vista_materiales_unid.status_dep, vista_materiales_unid.nombre_fam, vista_materiales_unid.status_fam, vista_materiales_unid.nombre_unidad, vista_materiales_unid.abreviatura, vista_materiales_unid.status_unidad FROM inventario_materiales, inventario, vista_materiales_unid WHERE (((inventario_materiales.id_inv)::text = (inventario.id_inv)::text) AND ((inventario_materiales.id_mat)::text = (vista_materiales_unid.id_mat)::text)) ORDER BY vista_materiales_unid.nombre_mat;


ALTER TABLE public.vista_planillainv OWNER TO postgres;

--
-- TOC entry 383 (class 1259 OID 2651303)
-- Dependencies: 2778 6
-- Name: vista_planillamov; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_planillamov AS
    SELECT mov_mat.id_mat, mov_mat.id_mov, mov_mat.cant_mov, vista_materiales_unid.us_id, vista_materiales_unid.us_nombre, vista_materiales_unid.us_abre, vista_materiales_unid.id_dep, vista_materiales_unid.stock, vista_materiales_unid.stock_min, vista_materiales_unid.observacion, vista_materiales_unid.id_m, vista_materiales_unid.numero_mat, vista_materiales_unid.nombre_mat, vista_materiales_unid.id_unidad, vista_materiales_unid.uni_id_unidad, vista_materiales_unid.id_fam, vista_materiales_unid.precio_u_p, vista_materiales_unid.c_uni_ent, vista_materiales_unid.c_uni_sal, vista_materiales_unid.nombre_dep, vista_materiales_unid.descrip_dep, vista_materiales_unid.status_dep, vista_materiales_unid.nombre_fam, vista_materiales_unid.status_fam, vista_materiales_unid.nombre_unidad, vista_materiales_unid.abreviatura, vista_materiales_unid.status_unidad FROM mov_mat, vista_materiales_unid WHERE ((mov_mat.id_mat)::text = (vista_materiales_unid.id_mat)::text) ORDER BY vista_materiales_unid.nombre_mat;


ALTER TABLE public.vista_planillamov OWNER TO postgres;

--
-- TOC entry 384 (class 1259 OID 2651308)
-- Dependencies: 2779 6
-- Name: vista_planillaped; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_planillaped AS
    SELECT pedido.id_ped, pedido.id_prov, pedido.fecha_ped, pedido.fecha_ent, pedido.status_ped, pedido.obser_ped, pedido.nro_fact_ped, pedido.porc_desc, pedido.desc_ped, pedido.base_ped, pedido.iva_ped, pedido.total_ped, vista_matped_und.us_id, vista_matped_und.us_nombre, vista_matped_und.us_abre, vista_matped_und.id_mat, vista_matped_und.nombre_mat, vista_matped_und.id_unidad, vista_matped_und.nombre_unidad, vista_matped_und.abreviatura, vista_matped_und.numero_mat, vista_matped_und.id_dep, vista_matped_und.id_fam, vista_matped_und.c_uni_ent, vista_matped_und.c_uni_sal, vista_matped_und.stock, vista_matped_und.stock_min, vista_matped_und.nombre_dep, vista_matped_und.cant_ped, vista_matped_und.cant_ent, vista_matped_und.precio, vista_matped_und.nombre_fam FROM pedido, vista_matped_und WHERE ((vista_matped_und.id_ped)::text = (pedido.id_ped)::text);


ALTER TABLE public.vista_planillaped OWNER TO postgres;

--
-- TOC entry 385 (class 1259 OID 2651313)
-- Dependencies: 2780 6
-- Name: vista_promocion; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_promocion AS
    SELECT promocion.id_promo, promocion.nombre_promo, promocion.fecha_promo, promo_contrato.inicio_promo, promo_contrato.fin_promo, promocion.mes_promo, promocion.tipo_promo, promocion.descuento_promo, promocion.login, promocion.status_promo, promo_contrato.id_promo_con, promo_contrato.id_contrato, promo_contrato.status_promo_con FROM promocion, promo_contrato WHERE ((promocion.id_promo)::text = (promo_contrato.id_promo)::text);


ALTER TABLE public.vista_promocion OWNER TO postgres;

--
-- TOC entry 386 (class 1259 OID 2651317)
-- Dependencies: 2781 6
-- Name: vista_recibos; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_recibos AS
    SELECT recibos.nro_recibo, recibos.id_asig, recibos.id_rec, recibos.status_pago, vista_asignarecibo.id_persona, vista_asignarecibo.cedula, vista_asignarecibo.nombre, vista_asignarecibo.apellido, vista_asignarecibo.telefono, vista_asignarecibo.id_cobrador, vista_asignarecibo.fecha_asig, vista_asignarecibo.obser_asig, vista_asignarecibo.login_asig, vista_asignarecibo.desde, vista_asignarecibo.hasta, vista_asignarecibo.cantidad, recibos.tipo, recibos.obser FROM (recibos JOIN vista_asignarecibo ON (((recibos.id_asig)::text = (vista_asignarecibo.id_asig)::text))) ORDER BY recibos.nro_recibo;


ALTER TABLE public.vista_recibos OWNER TO postgres;

--
-- TOC entry 387 (class 1259 OID 2651322)
-- Dependencies: 2782 6
-- Name: vista_reclamo; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_reclamo AS
    SELECT reclamo_denuncia.id_rec, reclamo_denuncia.id_persona, reclamo_denuncia.nro_rec, reclamo_denuncia.tipo_rec, reclamo_denuncia.fecha_rec, reclamo_denuncia.hora_rec, reclamo_denuncia.motivo_rec, reclamo_denuncia.descrip_rec, reclamo_denuncia.denunciado, reclamo_denuncia.status_rec, vista_cliente.cedula, vista_cliente.nombre, vista_cliente.apellido, vista_cliente.telefono, vista_cliente.telf_casa, vista_cliente.email FROM (vista_cliente JOIN reclamo_denuncia ON (((reclamo_denuncia.id_persona)::text = (vista_cliente.id_persona)::text))) ORDER BY reclamo_denuncia.nro_rec;


ALTER TABLE public.vista_reclamo OWNER TO postgres;

--
-- TOC entry 388 (class 1259 OID 2651327)
-- Dependencies: 2783 6
-- Name: vista_reporteinventario; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_reporteinventario AS
    SELECT motivo_inv.id_motivo, motivo_inv.nombre_motivo, motivo_inv.status_motivo, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, inventario.id_inv, inventario.fecha_inv, inventario.hora_inv, inventario.obser_inv, inventario.tipo_inv, inventario.id_fam, inventario.status_inv, inventario.num_inv, inventario.login_reg, inventario.login_aju FROM motivo_inv, deposito, inventario WHERE (((inventario.id_motivo)::text = (motivo_inv.id_motivo)::text) AND ((inventario.id_dep)::text = (deposito.id_dep)::text)) ORDER BY inventario.num_inv;


ALTER TABLE public.vista_reporteinventario OWNER TO postgres;

--
-- TOC entry 389 (class 1259 OID 2651331)
-- Dependencies: 2784 6
-- Name: vista_reportemovimiento; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_reportemovimiento AS
    SELECT tipo_movimiento.id_tm, tipo_movimiento.nombre_tm, tipo_movimiento.tipo_ent_sal, tipo_movimiento.uso_tm, tipo_movimiento.status_tm, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, movimiento.id_mov, movimiento.fecha_ent_sal, movimiento.hora_ent_sal, movimiento.observacion, movimiento.referencia, movimiento.tipo_mov, movimiento.num_mov FROM tipo_movimiento, deposito, movimiento WHERE (((movimiento.tipo_mov)::text = (deposito.id_dep)::text) AND ((movimiento.id_tm)::text = (tipo_movimiento.id_tm)::text)) ORDER BY movimiento.fecha_ent_sal;


ALTER TABLE public.vista_reportemovimiento OWNER TO postgres;

--
-- TOC entry 390 (class 1259 OID 2651335)
-- Dependencies: 2785 6
-- Name: vista_sector1; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_sector1 AS
    SELECT sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, ciudad.status_ciudad, municipio.id_esta, municipio.nombre_mun, municipio.status_mun, sector.id_franq, estado.nombre_esta, estado.status_esta, franquicia.nombre_franq, sector.nro_sector FROM (((((sector JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) JOIN ciudad ON (((zona.id_ciudad)::text = (ciudad.id_ciudad)::text))) JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text))) JOIN franquicia ON (((sector.id_franq)::text = (franquicia.id_franq)::text))) ORDER BY zona.nombre_zona;


ALTER TABLE public.vista_sector1 OWNER TO postgres;

--
-- TOC entry 391 (class 1259 OID 2651340)
-- Dependencies: 2786 6
-- Name: vista_serv; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_serv AS
    SELECT servicios.id_serv, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, servicios.tipo_costo, servicios.tipo_paq, servicios.tarifa_esp, servicios.tipo_serv, cant_tv.cantidad, contrato_servicio.id_cont_serv, contrato_servicio.id_contrato, cant_tv.id_cant, servicios.id_paq FROM ((servicios JOIN cant_tv ON (((servicios.id_cant)::text = (cant_tv.id_cant)::text))) JOIN contrato_servicio ON (((servicios.id_serv)::text = (contrato_servicio.id_serv)::text)));


ALTER TABLE public.vista_serv OWNER TO postgres;

--
-- TOC entry 392 (class 1259 OID 2651345)
-- Dependencies: 2787 6
-- Name: vista_servicio_status; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_servicio_status AS
    SELECT DISTINCT servicios.id_tipo_servicio, contrato.id_contrato, contrato.status_contrato FROM ((contrato JOIN contrato_servicio ON (((contrato.id_contrato)::text = (contrato_servicio.id_contrato)::text))) JOIN servicios ON (((contrato_servicio.id_serv)::text = (servicios.id_serv)::text)));


ALTER TABLE public.vista_servicio_status OWNER TO postgres;

--
-- TOC entry 393 (class 1259 OID 2651350)
-- Dependencies: 2788 6
-- Name: vista_servicios; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_servicios AS
    SELECT servicios.id_serv, servicios.id_tipo_servicio, servicios.nombre_servicio, servicios.status_serv, tipo_servicio.tipo_servicio, tipo_servicio.status_servicio, servicios.tipo_costo, servicios.tipo_paq, servicios.tarifa_esp, servicios.tipo_serv, servicios.id_cant, cant_tv.cantidad, paquete.id_paq, paquete.nombre_paq, tarifa_servicio.tarifa_ser, tarifa_servicio.id_tar_ser, tarifa_servicio.fecha_tar_ser FROM ((((servicios JOIN tipo_servicio ON (((servicios.id_tipo_servicio)::text = (tipo_servicio.id_tipo_servicio)::text))) LEFT JOIN cant_tv ON (((servicios.id_cant)::text = (cant_tv.id_cant)::text))) LEFT JOIN paquete ON (((servicios.id_paq)::text = (paquete.id_paq)::text))) LEFT JOIN tarifa_servicio ON ((((servicios.id_serv)::text = (tarifa_servicio.id_serv)::text) AND ((tarifa_servicio.status_tarifa_ser)::bpchar = 'ACTIVO'::bpchar))));


ALTER TABLE public.vista_servicios OWNER TO postgres;

--
-- TOC entry 394 (class 1259 OID 2651355)
-- Dependencies: 2789 6
-- Name: vista_sms; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_sms AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, sms.id_sms, sms.id_contrato, sms.nro_sms, sms.tipo_sms, sms.telefono_sms, sms.fecha_sms, sms.hora_sms, sms.mensaje_sms, sms.status_sms, sms.login, sms.tipo_list, sms.status_list, contrato.id_calle, contrato.cli_id_persona, contrato.nro_contrato, contrato.fecha_contrato, contrato.observacion, contrato.etiqueta, contrato.costo_dif_men, contrato.status_contrato, contrato.id_edif, contrato.direc_adicional, contrato.numero_casa, contrato.numero_piso, cliente.telf_casa, cliente.email, cliente.telf_adic FROM (((persona JOIN cliente ON (((persona.id_persona)::text = (cliente.id_persona)::text))) JOIN contrato ON (((cliente.id_persona)::text = (contrato.cli_id_persona)::text))) JOIN sms ON (((contrato.id_contrato)::text = (sms.id_contrato)::text))) ORDER BY sms.id_sms;


ALTER TABLE public.vista_sms OWNER TO postgres;

--
-- TOC entry 412 (class 1259 OID 7881279)
-- Dependencies: 2798 6
-- Name: vista_tablabancos; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_tablabancos AS
    SELECT carga_tabla_banco.id_ctb, carga_tabla_banco.id_cuba, carga_tabla_banco.hora_ctb, carga_tabla_banco.login_ctb, carga_tabla_banco.fecha_desde_ctb, carga_tabla_banco.fecha_hasta_ctb, carga_tabla_banco.status_ctb, tabla_bancos.id_tb, tabla_bancos.fecha_tb, tabla_bancos.tipo_tb, tabla_bancos.referencia_tb, tabla_bancos.monto_tb, tabla_bancos.descrip_tb, tabla_bancos.status_tb, tabla_bancos.saldo, cuenta_bancaria.numero_cuba, cuenta_bancaria.banco_cuba, cuenta_bancaria.abrev_cuba, cuenta_bancaria.desc_cuba, cuenta_bancaria.status_cuba, cuenta_bancaria.conc_cliente, cuenta_bancaria.conc_franq, cuenta_bancaria.formato_archivo, carga_tabla_banco.fecha_ctb FROM carga_tabla_banco, tabla_bancos, cuenta_bancaria WHERE ((carga_tabla_banco.id_ctb = tabla_bancos.id_ctb) AND (carga_tabla_banco.id_cuba = cuenta_bancaria.id_cuba));


ALTER TABLE public.vista_tablabancos OWNER TO postgres;

--
-- TOC entry 395 (class 1259 OID 2651360)
-- Dependencies: 2790 6
-- Name: vista_tarifa; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_tarifa AS
    SELECT tarifa_servicio.id_tar_ser, tarifa_servicio.id_serv, tarifa_servicio.fecha_tar_ser, tarifa_servicio.hora_tar_ser, tarifa_servicio.obser_tarifa_ser, tarifa_servicio.status_tarifa_ser, tarifa_servicio.tarifa_ser, vista_servicios.id_tipo_servicio, vista_servicios.nombre_servicio, vista_servicios.status_serv, vista_servicios.tipo_servicio, vista_servicios.status_servicio, vista_servicios.tipo_costo, vista_servicios.tarifa_esp, vista_servicios.tipo_serv FROM (tarifa_servicio JOIN vista_servicios ON (((tarifa_servicio.id_serv)::text = (vista_servicios.id_serv)::text)));


ALTER TABLE public.vista_tarifa OWNER TO postgres;

--
-- TOC entry 396 (class 1259 OID 2651364)
-- Dependencies: 2791 6
-- Name: vista_tecnico; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_tecnico AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, tecnico.num_tecnico, tecnico.direccion_tec, tecnico.correo_tec, tecnico.status_tec, franquicia.id_franq, franquicia.nombre_franq FROM ((tecnico JOIN persona ON (((persona.id_persona)::text = (tecnico.id_persona)::text))) JOIN franquicia ON (((franquicia.id_franq)::text = (tecnico.id_franq)::text))) ORDER BY persona.cedula;


ALTER TABLE public.vista_tecnico OWNER TO postgres;

--
-- TOC entry 413 (class 1259 OID 7881821)
-- Dependencies: 2799 6
-- Name: vista_tipopago; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_tipopago AS
    SELECT detalle_tipopago.id_tp, detalle_tipopago.id_tipo_pago, detalle_tipopago.id_pago, detalle_tipopago.id_banco, detalle_tipopago.refer_tp, detalle_tipopago.monto_tp, banco.banco, detalle_tipopago.lote_tp, pagos.id_caja_cob, pagos.fecha_pago, pagos.monto_pago, pagos.obser_pago, pagos.status_pago, pagos.nro_factura, tipo_pago.tipo_pago, caja.tipo_caja, pagos.id_contrato, caja.id_franq, caja_cobrador.id_est, pagos.impresion, pagos.tipo_doc FROM (((((detalle_tipopago JOIN pagos ON (((detalle_tipopago.id_pago)::text = (pagos.id_pago)::text))) JOIN caja_cobrador ON (((pagos.id_caja_cob)::text = (caja_cobrador.id_caja_cob)::text))) JOIN caja ON (((caja_cobrador.id_caja)::text = (caja.id_caja)::text))) LEFT JOIN tipo_pago ON (((detalle_tipopago.id_tipo_pago)::text = (tipo_pago.id_tipo_pago)::text))) LEFT JOIN banco ON (((banco.id_banco)::text = (detalle_tipopago.id_banco)::text)));


ALTER TABLE public.vista_tipopago OWNER TO postgres;

--
-- TOC entry 397 (class 1259 OID 2651374)
-- Dependencies: 2792 6
-- Name: vista_tipopago_temp; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_tipopago_temp AS
    SELECT detalle_tipopago_temp.id_tp, detalle_tipopago_temp.id_tipo_pago, detalle_tipopago_temp.id_pago, detalle_tipopago_temp.id_banco, detalle_tipopago_temp.refer_tp, detalle_tipopago_temp.monto_tp, banco.banco, detalle_tipopago_temp.lote_tp, tipo_pago.tipo_pago FROM ((detalle_tipopago_temp LEFT JOIN tipo_pago ON (((detalle_tipopago_temp.id_tipo_pago)::text = (tipo_pago.id_tipo_pago)::text))) LEFT JOIN banco ON (((banco.id_banco)::text = (detalle_tipopago_temp.id_banco)::text)));


ALTER TABLE public.vista_tipopago_temp OWNER TO postgres;

--
-- TOC entry 398 (class 1259 OID 2651378)
-- Dependencies: 2793 6
-- Name: vista_ubicli; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_ubicli AS
    SELECT contrato.id_contrato, calle.id_calle, calle.id_sector, sector.id_zona, contrato.status_contrato FROM ((calle JOIN contrato ON (((calle.id_calle)::text = (contrato.id_calle)::text))) JOIN sector ON (((calle.id_sector)::text = (sector.id_sector)::text))) ORDER BY contrato.id_contrato;


ALTER TABLE public.vista_ubicli OWNER TO postgres;

--
-- TOC entry 399 (class 1259 OID 2651383)
-- Dependencies: 2794 6
-- Name: vista_urb; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_urb AS
    SELECT urbanizacion.id_urb, urbanizacion.nombre_urb, sector.id_sector, sector.nombre_sector, zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, ciudad.status_ciudad, municipio.id_esta, municipio.nombre_mun, municipio.status_mun, sector.id_franq, estado.nombre_esta, estado.status_esta, franquicia.nombre_franq FROM ((((((urbanizacion JOIN sector ON (((urbanizacion.id_sector)::text = (sector.id_sector)::text))) JOIN zona ON (((sector.id_zona)::text = (zona.id_zona)::text))) JOIN ciudad ON (((zona.id_ciudad)::text = (ciudad.id_ciudad)::text))) JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text))) JOIN franquicia ON (((sector.id_franq)::text = (franquicia.id_franq)::text)));


ALTER TABLE public.vista_urb OWNER TO postgres;

--
-- TOC entry 400 (class 1259 OID 2651388)
-- Dependencies: 2795 6
-- Name: vista_vendedor; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_vendedor AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, vendedor.nro_vendedor, vendedor.direccion_ven, franquicia.id_franq, franquicia.nombre_franq FROM ((vendedor JOIN persona ON (((persona.id_persona)::text = (vendedor.id_persona)::text))) JOIN franquicia ON (((franquicia.id_franq)::text = (vendedor.id_franq)::text))) ORDER BY persona.cedula;


ALTER TABLE public.vista_vendedor OWNER TO postgres;

--
-- TOC entry 401 (class 1259 OID 2651393)
-- Dependencies: 2796 6
-- Name: vista_zona1; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_zona1 AS
    SELECT zona.id_zona, zona.nombre_zona, ciudad.id_ciudad, ciudad.id_mun, ciudad.nombre_ciudad, ciudad.status_ciudad, municipio.id_esta, municipio.nombre_mun, municipio.status_mun, estado.nombre_esta, estado.status_esta, zona.nro_zona, zona.n_zona FROM (((zona JOIN ciudad ON (((zona.id_ciudad)::text = (ciudad.id_ciudad)::text))) JOIN municipio ON (((ciudad.id_mun)::text = (municipio.id_mun)::text))) JOIN estado ON (((municipio.id_esta)::text = (estado.id_esta)::text))) ORDER BY zona.nombre_zona;


ALTER TABLE public.vista_zona1 OWNER TO postgres;

--
-- TOC entry 402 (class 1259 OID 2651398)
-- Dependencies: 2797 6
-- Name: vistamodulo; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vistamodulo AS
    SELECT perfil.codigoperfil, perfil.nombreperfil, perfil.descripcionperfil, modulo.codigomodulo, modulo.nombremodulo, modulo.namemodulo, modulo_perfil.incluir, modulo_perfil.modificar, modulo_perfil.eliminar FROM ((modulo JOIN modulo_perfil ON (((modulo_perfil.codigomodulo)::text = (modulo.codigomodulo)::text))) JOIN perfil ON (((((modulo_perfil.codigoperfil)::text = (perfil.codigoperfil)::text) AND ((modulo.statusmodulo)::bpchar = 'ACTIVO'::bpchar)) AND ((perfil.statusperfil)::bpchar = 'ACTIVO'::bpchar))));
