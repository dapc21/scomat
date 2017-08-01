
ALTER TABLE ONLY public.zona DROP CONSTRAINT zona_id_ciudad_fkey;
ALTER TABLE ONLY public.variables_sms DROP CONSTRAINT variables_sms_id_franq_fkey;
ALTER TABLE ONLY public.sms DROP CONSTRAINT sms_login_fkey;
ALTER TABLE ONLY public.recuperado DROP CONSTRAINT recuperado_id_contrato_fkey;
ALTER TABLE ONLY public.recibos DROP CONSTRAINT recibos_id_asig_fkey;
ALTER TABLE ONLY public.pagos DROP CONSTRAINT pagos_id_contrato_fkey;
ALTER TABLE ONLY public.pagos_his DROP CONSTRAINT pagos_id_condtrato_fkey;
ALTER TABLE ONLY public.pago_servicio DROP CONSTRAINT pago_servicio_id_pago_fkey;
ALTER TABLE ONLY public.pago_servicio DROP CONSTRAINT pago_servicio_id_cont_serv_fkey;
ALTER TABLE ONLY public.notas DROP CONSTRAINT notas_idmotivonota_fkey;
ALTER TABLE ONLY public.notas DROP CONSTRAINT notas_id_contrato_fkey;
ALTER TABLE ONLY public.movimiento_orden DROP CONSTRAINT movimiento_login_fkey;
ALTER TABLE ONLY public.movimiento DROP CONSTRAINT movimiento_login_fkey;
ALTER TABLE ONLY public.movimiento_orden DROP CONSTRAINT movimiento_id_persona_fkey;
ALTER TABLE ONLY public.movimiento DROP CONSTRAINT movimiento_id_persona_fkey;
ALTER TABLE ONLY public.mov_mat_orden DROP CONSTRAINT mov_mat_orden_id_mov_fkey;
ALTER TABLE ONLY public.materiales DROP CONSTRAINT materiales_id_m_fkey;
ALTER TABLE ONLY public.mat_padre DROP CONSTRAINT mat_padre_uni_id_unidad_fkey;
ALTER TABLE ONLY public.mat_padre DROP CONSTRAINT mat_padre_id_unidad_fkey;
ALTER TABLE ONLY public.mat_padre DROP CONSTRAINT mat_padre_id_fam_fkey;
ALTER TABLE ONLY public.visitas DROP CONSTRAINT fk_visitas_reference_ordenes_;
ALTER TABLE ONLY public.vendedor DROP CONSTRAINT fk_vendedor_inheritan_persona;
ALTER TABLE ONLY public.usuario DROP CONSTRAINT fk_usuario_relations_persona;
ALTER TABLE ONLY public.usuario DROP CONSTRAINT fk_usuario_relations_perfil;
ALTER TABLE ONLY public.urbanizacion DROP CONSTRAINT fk_urbanizacion_reference_urbanizacion;
ALTER TABLE ONLY public.tipo_servicio DROP CONSTRAINT fk_tipo_ser_reference_franquic;
ALTER TABLE ONLY public.tecnico DROP CONSTRAINT fk_tecnico_inheritan_persona;
ALTER TABLE ONLY public.tarifa_servicio DROP CONSTRAINT fk_tarifa_s_relations_servicio;
ALTER TABLE ONLY public.servicios DROP CONSTRAINT fk_servicio_relations_tipo_ser;
ALTER TABLE ONLY public.sector DROP CONSTRAINT fk_sector_relations_zona;
ALTER TABLE ONLY public.abo_cortados DROP CONSTRAINT fk_reference_122;
ALTER TABLE ONLY public.reclamo_denuncia DROP CONSTRAINT fk_reclamo__reference_cliente;
ALTER TABLE ONLY public.precintos DROP CONSTRAINT fk_precinto_reference_usuario;
ALTER TABLE ONLY public.pedido DROP CONSTRAINT fk_pedido_reference_proveedo;
ALTER TABLE ONLY public.parametros DROP CONSTRAINT fk_parametr_relations_franquic;
ALTER TABLE ONLY public.pagos DROP CONSTRAINT fk_pagos_reference_caja_cob;
ALTER TABLE ONLY public.pago_comisiones DROP CONSTRAINT fk_pago_com_reference_persona;
ALTER TABLE ONLY public.ordenes_tecnicos DROP CONSTRAINT fk_ordenes__relations_contrato;
ALTER TABLE ONLY public.ordenes_tecnicos DROP CONSTRAINT fk_ordenes__reference_detalle_;
ALTER TABLE ONLY public.orden_grupo DROP CONSTRAINT fk_orden_gr_reference_ordenes_;
ALTER TABLE ONLY public.orden_grupo DROP CONSTRAINT fk_orden_gr_reference_grupo_tr;
ALTER TABLE ONLY public.municipio DROP CONSTRAINT fk_municipi_reference_estado;
ALTER TABLE ONLY public.movimiento_orden DROP CONSTRAINT fk_movimien_reference_tipo_mov;
ALTER TABLE ONLY public.movimiento DROP CONSTRAINT fk_movimien_reference_tipo_mov;
ALTER TABLE ONLY public.mov_mat DROP CONSTRAINT fk_mov_mat_reference_movimien;
ALTER TABLE ONLY public.mov_mat DROP CONSTRAINT fk_mov_mat_reference_material;
ALTER TABLE ONLY public.mov_mat_orden DROP CONSTRAINT fk_mov_mat_orden_reference_material;
ALTER TABLE ONLY public.modulo_perfil DROP CONSTRAINT fk_modulo_p_relations_perfil;
ALTER TABLE ONLY public.modulo_perfil DROP CONSTRAINT fk_modulo_p_relations_modulo;
ALTER TABLE ONLY public.mensualidad DROP CONSTRAINT fk_mensuali_reference_usuario;
ALTER TABLE ONLY public.materiales DROP CONSTRAINT fk_material_reference_deposito;
ALTER TABLE ONLY public.mat_prov DROP CONSTRAINT fk_mat_prov_reference_proveedo;
ALTER TABLE ONLY public.mat_prov DROP CONSTRAINT fk_mat_prov_reference_material;
ALTER TABLE ONLY public.mat_ped DROP CONSTRAINT fk_mat_ped_reference_pedido;
ALTER TABLE ONLY public.mat_ped DROP CONSTRAINT fk_mat_ped_reference_material;
ALTER TABLE ONLY public.inventario DROP CONSTRAINT fk_inventar_reference_motivo_i;
ALTER TABLE ONLY public.inventario_materiales DROP CONSTRAINT fk_inventar_reference_material;
ALTER TABLE ONLY public.inventario_materiales DROP CONSTRAINT fk_inventar_reference_inventar;
ALTER TABLE ONLY public.grupo_ubicacion DROP CONSTRAINT fk_grupo_ub_reference_sector;
ALTER TABLE ONLY public.grupo_ubicacion DROP CONSTRAINT fk_grupo_ub_reference_grupo_tr;
ALTER TABLE ONLY public.grupo_tecnico DROP CONSTRAINT fk_grupo_te_reference_tecnico;
ALTER TABLE ONLY public.grupo_tecnico DROP CONSTRAINT fk_grupo_te_reference_grupo_tr;
ALTER TABLE ONLY public.gerentes_permitidos DROP CONSTRAINT fk_gerentes_reference_persona;
ALTER TABLE ONLY public.formato_sms DROP CONSTRAINT fk_formato__reference_franquic;
ALTER TABLE ONLY public.estado DROP CONSTRAINT fk_estado_reference_pais;
ALTER TABLE ONLY public.estacion_trabajo DROP CONSTRAINT fk_estacion_reference_usuario;
ALTER TABLE ONLY public.envio_aut DROP CONSTRAINT fk_envio_au_reference_franquic;
ALTER TABLE ONLY public.edificio DROP CONSTRAINT fk_edificio_reference_calle;
ALTER TABLE ONLY public.detalle_tipopago DROP CONSTRAINT fk_detalle__relations_tipo_pag;
ALTER TABLE ONLY public.detalle_orden DROP CONSTRAINT fk_detalle__reference_tipo_ord;
ALTER TABLE ONLY public.contrato DROP CONSTRAINT fk_contrato_relations_vendedor;
ALTER TABLE ONLY public.contrato_servicio_pagado DROP CONSTRAINT fk_contrato_relations_servicio;
ALTER TABLE ONLY public.contrato_servicio_deuda DROP CONSTRAINT fk_contrato_relations_servicio;
ALTER TABLE ONLY public.contrato_servicio DROP CONSTRAINT fk_contrato_relations_servicio;
ALTER TABLE ONLY public.contrato DROP CONSTRAINT fk_contrato_relations_cliente;
ALTER TABLE ONLY public.contrato DROP CONSTRAINT fk_contrato_relations_calle;
ALTER TABLE ONLY public.config_mat DROP CONSTRAINT fk_config_s_reference_franquic;
ALTER TABLE ONLY public.config_sms DROP CONSTRAINT fk_config_s_reference_franquic;
ALTER TABLE ONLY public.comentario_cliente DROP CONSTRAINT fk_comentar_reference_cliente;
ALTER TABLE ONLY public.comandos_sms DROP CONSTRAINT fk_comandos_reference_franquic;
ALTER TABLE ONLY public.cobrador DROP CONSTRAINT fk_cobrador_inheritan_persona;
ALTER TABLE ONLY public.cliente DROP CONSTRAINT fk_cliente_inheritan_persona;
ALTER TABLE ONLY public.conyuge DROP CONSTRAINT fk_cliente_inheridvtan_persona;
ALTER TABLE ONLY public.ciudad DROP CONSTRAINT fk_ciudad_reference_municipi;
ALTER TABLE ONLY public.cierre_pago_et DROP CONSTRAINT fk_cierre_psd_rdeference_caja_cob;
ALTER TABLE ONLY public.cierre_pago_et DROP CONSTRAINT fk_cierre_p_rsdfedflations_cirre_di;
ALTER TABLE ONLY public.cierre_pago DROP CONSTRAINT fk_cierre_p_relations_cirre_di;
ALTER TABLE ONLY public.cierre_pago DROP CONSTRAINT fk_cierre_p_reference_caja_cob;
ALTER TABLE ONLY public.calle DROP CONSTRAINT fk_calle_relations_sector;
ALTER TABLE ONLY public.caja_cobrador DROP CONSTRAINT fk_caja_cob_reference_cobrador;
ALTER TABLE ONLY public.caja_cobrador DROP CONSTRAINT fk_caja_cob_reference_caja;
ALTER TABLE ONLY public.notas DROP CONSTRAINT fk_auditori_reference_usuario;
ALTER TABLE ONLY public.auditoria DROP CONSTRAINT fk_auditori_reference_usuario;
ALTER TABLE ONLY public.alarmas DROP CONSTRAINT fk_alarmas_reference_tipo_ala;
ALTER TABLE ONLY public.alarma_perfil DROP CONSTRAINT fk_alarma_p_reference_tipo_ala;
ALTER TABLE ONLY public.alarma_perfil DROP CONSTRAINT fk_alarma_p_reference_perfil;
ALTER TABLE ONLY public.entidad DROP CONSTRAINT entidad_id_te_fkey;
ALTER TABLE ONLY public.entidad DROP CONSTRAINT entidad_id_persona_fkey;
ALTER TABLE ONLY public.detalle_tipopago DROP CONSTRAINT detalle_tipopago_id_pago_fkey;
ALTER TABLE ONLY public.conv_con DROP CONSTRAINT conv_con_id_conv_fkey;
ALTER TABLE ONLY public.contrato_servicio_pagado DROP CONSTRAINT contrato_servicio_pagado_id_contrato_fkey;
ALTER TABLE ONLY public.contrato_servicio DROP CONSTRAINT contrato_servicio_id_contrato_fkey;
ALTER TABLE ONLY public.contrato_servicio_deuda DROP CONSTRAINT contrato_servicio_deuda_id_contrato_fkey;
ALTER TABLE ONLY public.contrato DROP CONSTRAINT contrato_id_g_a_fkey;
ALTER TABLE ONLY public.caja_cobrador DROP CONSTRAINT caja_cobrador_id_est_fkey;
ALTER TABLE ONLY public.abo_cortados DROP CONSTRAINT abo_cortados_id_orden_fkey;

DROP INDEX public.zona_pk;
DROP INDEX public.visitas_2_pk;
DROP INDEX public.visitas_1_pk;
DROP INDEX public.vendedor_pk;
DROP INDEX public.usuario_pk;
DROP INDEX public.unidad_medidapk_6;
DROP INDEX public.tipo_servicio_pk;
DROP INDEX public.tipo_servicio_1_pk;
DROP INDEX public.tipo_pago_pk;
DROP INDEX public.tipo_orden_1_pk;
DROP INDEX public.tipo_movimientopk_6;
DROP INDEX public.tipo_entidad_pk_1;
DROP INDEX public.tecnico_pk;
DROP INDEX public.tarifa_servicio_pk;
DROP INDEX public.sms_sinc_1_pk;
DROP INDEX public.sms_2_pk;
DROP INDEX public.sms_1_pk;
DROP INDEX public.servicios_pk;
DROP INDEX public.sector_pk;
DROP INDEX public.relationship_pagado_21_fk;
DROP INDEX public.relationship_pagado_20_fk;
DROP INDEX public.relationship_deuda_21_fk;
DROP INDEX public.relationship_deuda_20_fk;
DROP INDEX public.relationship_8_fk;
DROP INDEX public.relationship_7_fk;
DROP INDEX public.relationship_6_fk;
DROP INDEX public.relationship_5_fk;
DROP INDEX public.relationship_4_fk;
DROP INDEX public.relationship_29_fk;
DROP INDEX public.relationship_28_fk;
DROP INDEX public.relationship_27_fk;
DROP INDEX public.relationship_25_fk;
DROP INDEX public.relationship_24_fk;
DROP INDEX public.relationship_23_fk;
DROP INDEX public.relationship_22_pk;
DROP INDEX public.relationship_22_fk;
DROP INDEX public.relationship_21_fk;
DROP INDEX public.relationship_20_fk;
DROP INDEX public.relationship_16_fk;
DROP INDEX public.relationship_15_fk;
DROP INDEX public.relationship_14_fk;
DROP INDEX public.relationship_13_fk;
DROP INDEX public.relationship_12_fk;
DROP INDEX public.relationship_11_fk;
DROP INDEX public.relationship_10_fk;
DROP INDEX public.relationship4_8_fk;
DROP INDEX public.relationshidp_14_fk;
DROP INDEX public.relationsdhip_20_fk;
DROP INDEX public.relationsdfdfship_12_fk;
DROP INDEX public.relationsasfhip_13_fk;
DROP INDEX public.relationdfship_29_fk;
DROP INDEX public.relatiodfff;
DROP INDEX public.relatidffk;
DROP INDEX public.reladtidffk;
DROP INDEX public.reladtiddffk;
DROP INDEX public.redflatiodfff;
DROP INDEX public.recuperado_2_pk;
DROP INDEX public.proveedorpk_6;
DROP INDEX public.provee45dorpk_67;
DROP INDEX public.provee45dorpk_6;
DROP INDEX public.provee45dorp88k_67;
DROP INDEX public.provee45dor8p88k_67;
DROP INDEX public.persona_pk;
DROP INDEX public.perfil_pk;
DROP INDEX public.pedido_pk_6;
DROP INDEX public.pedido_pk_3;
DROP INDEX public.parametros_pk;
DROP INDEX public.pagos_20_fk;
DROP INDEX public.ordenes_tecnicos_pk;
DROP INDEX public.orden_grupo_4_pk;
DROP INDEX public.orden_grupo_3_pk;
DROP INDEX public.orden_grupo_2_pk;
DROP INDEX public.notas_4_pk;
DROP INDEX public.notas_3_pk;
DROP INDEX public.notas_2_pk;
DROP INDEX public.movimientopk_6;
DROP INDEX public.movimientopk_2;
DROP INDEX public.movimiento_ordenpk_6;
DROP INDEX public.movimiento_ordenpk_2;
DROP INDEX public.mov_mat_pk_4;
DROP INDEX public.mov_mat_pk_2;
DROP INDEX public.mov_mat_pk_1;
DROP INDEX public.mov_mat_orden_pk_4;
DROP INDEX public.mov_mat_orden_pk_2;
DROP INDEX public.mov_mat_orden_pk_1;
DROP INDEX public.motivo_inv_pk_1;
DROP INDEX public.modulo_pk;
DROP INDEX public.modulo_2_pk;
DROP INDEX public.mensualidad_2_pk;
DROP INDEX public.materiales_pk;
DROP INDEX public.mat_prov_pk_32;
DROP INDEX public.mat_prov_pk_3;
DROP INDEX public.mat_prov_pk_22;
DROP INDEX public.mat_ped_pk_1;
DROP INDEX public.jjj;
DROP INDEX public.inventario_pk_2;
DROP INDEX public.inventario_pk;
DROP INDEX public.inventario_materiales_pk_3;
DROP INDEX public.inventario_materiales_pk_2;
DROP INDEX public.inventario_materiales_pk_1;
DROP INDEX public.index_pk_1;
DROP INDEX public.id_mat_pk_3;
DROP INDEX public.id_mat_pk_2;
DROP INDEX public.id_franq_1_pk;
DROP INDEX public.id_depd_pk_1;
DROP INDEX public.grupo_trabajo_2_pk;
DROP INDEX public.grupo_tecnico_3_pk;
DROP INDEX public.grupo_tecnico_2_pk;
DROP INDEX public.grupo_tecnico_1_pk;
DROP INDEX public.gerentes_permitidos_2_pk;
DROP INDEX public.franquicia_pk;
DROP INDEX public.familia_pk_1;
DROP INDEX public.est_tecnicos_2_pk;
DROP INDEX public.est_ordenes_2_pk;
DROP INDEX public.est_ingreso_2_pk;
DROP INDEX public.est_clientes_2_pk;
DROP INDEX public.entidfgad_pk_1;
DROP INDEX public.entidad_pk_1;
DROP INDEX public.email_sinc_1_pk;
DROP INDEX public.detalle_orden_2_pk;
DROP INDEX public.detalle_orden_1_pk;
DROP INDEX public.contrato_servicio_pk;
DROP INDEX public.contrato_servicio_pagado_pk;
DROP INDEX public.contrato_servicio_deuda_pk;
DROP INDEX public.contrato_sedrvicio_pagado_pk;
DROP INDEX public.contrato_sedrvdicio_pagado_pk;
DROP INDEX public.contrato_sedfdrvdicio_pagado_pk;
DROP INDEX public.contrato_pk;
DROP INDEX public.comandos_sms_22_pk;
DROP INDEX public.comandos_sms_1_pk;
DROP INDEX public.cocio_pagafdo_pk;
DROP INDEX public.cocio_pagado_pk;
DROP INDEX public.cobrador_pk;
DROP INDEX public.cliente_pk;
DROP INDEX public.ciupk;
DROP INDEX public.ciudpk;
DROP INDEX public.ciuddpk;
DROP INDEX public.cirre_diario_pk;
DROP INDEX public.cirre_ddfiario_pk;
DROP INDEX public.cierre_sdfpago_22_pk;
DROP INDEX public.cierre_pago_23_pk;
DROP INDEX public.cierre_pago_22_pk;
DROP INDEX public.calle_pk;
DROP INDEX public.cajadf_cob_pk;
DROP INDEX public.caja_pk;
DROP INDEX public.caja_cobrador_pk;
DROP INDEX public.caja_cob_pk;
DROP INDEX public.banco_pk;
ALTER TABLE ONLY public.recuperado DROP CONSTRAINT recuperado_pkey;
ALTER TABLE ONLY public.proceso_corte DROP CONSTRAINT proceso_corte_pkey;
ALTER TABLE ONLY public.zona DROP CONSTRAINT pk_zona;
ALTER TABLE ONLY public.visitas DROP CONSTRAINT pk_visitas;
ALTER TABLE ONLY public.vendedor DROP CONSTRAINT pk_vendedor;
ALTER TABLE ONLY public.variables_sms DROP CONSTRAINT pk_variables_sms;
ALTER TABLE ONLY public.usuario DROP CONSTRAINT pk_usuario;
ALTER TABLE ONLY public.urbanizacion DROP CONSTRAINT pk_urbanizacion;
ALTER TABLE ONLY public.unidad_medida DROP CONSTRAINT pk_unidad_medida;
ALTER TABLE ONLY public.tipo_servicio DROP CONSTRAINT pk_tipo_servicio;
ALTER TABLE ONLY public.tipo_pago DROP CONSTRAINT pk_tipo_pago;
ALTER TABLE ONLY public.tipo_orden DROP CONSTRAINT pk_tipo_orden;
ALTER TABLE ONLY public.tipo_movimiento DROP CONSTRAINT pk_tipo_movimiento;
ALTER TABLE ONLY public.tipo_entidad DROP CONSTRAINT pk_tipo_entidad;
ALTER TABLE ONLY public.tipo_alarma DROP CONSTRAINT pk_tipo_alarma;
ALTER TABLE ONLY public.tecnico DROP CONSTRAINT pk_tecnico;
ALTER TABLE ONLY public.tarifa_servicio DROP CONSTRAINT pk_tarifa_servicio;
ALTER TABLE ONLY public.subscriptionchannel DROP CONSTRAINT pk_subscriptionchannel;
ALTER TABLE ONLY public.subscription DROP CONSTRAINT pk_subscription;
ALTER TABLE ONLY public.statuscont DROP CONSTRAINT pk_statuscont;
ALTER TABLE ONLY public.sms_sinc DROP CONSTRAINT pk_sms_sinc;
ALTER TABLE ONLY public.sms_excel DROP CONSTRAINT pk_sms_excel;
ALTER TABLE ONLY public.sms DROP CONSTRAINT pk_sms;
ALTER TABLE ONLY public.smartcard DROP CONSTRAINT pk_smartcard;
ALTER TABLE ONLY public.servicios DROP CONSTRAINT pk_servicios;
ALTER TABLE ONLY public.sector DROP CONSTRAINT pk_sector;
ALTER TABLE ONLY public.reclamo_denuncia DROP CONSTRAINT pk_reclamo_denuncia;
ALTER TABLE ONLY public.recibos DROP CONSTRAINT pk_recibos;
ALTER TABLE ONLY public.recibe_recibo DROP CONSTRAINT pk_recibe_recibo;
ALTER TABLE ONLY public.purchase DROP CONSTRAINT pk_purchase;
ALTER TABLE ONLY public.proveedor DROP CONSTRAINT pk_proveedor;
ALTER TABLE ONLY public.promocion DROP CONSTRAINT pk_promocion;
ALTER TABLE ONLY public.promo_serv DROP CONSTRAINT pk_promo_serv;
ALTER TABLE ONLY public.promo_contrato DROP CONSTRAINT pk_promo_contrato;
ALTER TABLE ONLY public.productevent DROP CONSTRAINT pk_productevent;
ALTER TABLE ONLY public.product DROP CONSTRAINT pk_product;
ALTER TABLE ONLY public.precintos DROP CONSTRAINT pk_precintos;
ALTER TABLE ONLY public.persona DROP CONSTRAINT pk_persona;
ALTER TABLE ONLY public.perfil DROP CONSTRAINT pk_perfil;
ALTER TABLE ONLY public.pedido DROP CONSTRAINT pk_pedido;
ALTER TABLE ONLY public.parametros DROP CONSTRAINT pk_parametros;
ALTER TABLE ONLY public.pagos DROP CONSTRAINT pk_pagos;
ALTER TABLE ONLY public.pagodeposito DROP CONSTRAINT pk_pagodeposito;
ALTER TABLE ONLY public.pago_servicio DROP CONSTRAINT pk_pago_servicio;
ALTER TABLE ONLY public.pago_comisones DROP CONSTRAINT pk_pago_comisones;
ALTER TABLE ONLY public.pago_comisiones DROP CONSTRAINT pk_pago_comisiones;
ALTER TABLE ONLY public.pagos_his DROP CONSTRAINT pk_padgos;
ALTER TABLE ONLY public.ordenes_tecnicos DROP CONSTRAINT pk_ordenes_tecnicos;
ALTER TABLE ONLY public.notas DROP CONSTRAINT pk_notas;
ALTER TABLE ONLY public.municipio DROP CONSTRAINT pk_municipio;
ALTER TABLE ONLY public.movimiento_orden DROP CONSTRAINT pk_movimiento_orden;
ALTER TABLE ONLY public.movimiento DROP CONSTRAINT pk_movimiento;
ALTER TABLE ONLY public.mov_mat_orden DROP CONSTRAINT pk_mov_mat_orden;
ALTER TABLE ONLY public.mov_mat DROP CONSTRAINT pk_mov_mat;
ALTER TABLE ONLY public.motivonotas DROP CONSTRAINT pk_motivonotas;
ALTER TABLE ONLY public.motivo_inv DROP CONSTRAINT pk_motivo_inv;
ALTER TABLE ONLY public.modulo DROP CONSTRAINT pk_modulo;
ALTER TABLE ONLY public.message DROP CONSTRAINT pk_message;
ALTER TABLE ONLY public.mensualidad DROP CONSTRAINT pk_mensualidad;
ALTER TABLE ONLY public.materiales DROP CONSTRAINT pk_materiales;
ALTER TABLE ONLY public.mat_prov DROP CONSTRAINT pk_mat_prov;
ALTER TABLE ONLY public.mat_ped DROP CONSTRAINT pk_mat_ped;
ALTER TABLE ONLY public.inventario_materiales DROP CONSTRAINT pk_inventario_materiales;
ALTER TABLE ONLY public.inventario DROP CONSTRAINT pk_inventario;
ALTER TABLE ONLY public.interfazacc DROP CONSTRAINT pk_interfazacc;
ALTER TABLE ONLY public.info_adic DROP CONSTRAINT pk_info_adic;
ALTER TABLE ONLY public.hospedaje DROP CONSTRAINT pk_hospedaje;
ALTER TABLE ONLY public.grupo_ubicacion DROP CONSTRAINT pk_grupo_ubicacion;
ALTER TABLE ONLY public.grupo_trabajo DROP CONSTRAINT pk_grupo_trabajo;
ALTER TABLE ONLY public.grupo_afinidad DROP CONSTRAINT pk_grupo_afinidad;
ALTER TABLE ONLY public.gerentes_permitidos DROP CONSTRAINT pk_gerentes_permitidos;
ALTER TABLE ONLY public.franquicia DROP CONSTRAINT pk_franquicia;
ALTER TABLE ONLY public.formato_sms DROP CONSTRAINT pk_formato_sms;
ALTER TABLE ONLY public.familia DROP CONSTRAINT pk_familia;
ALTER TABLE ONLY public.event DROP CONSTRAINT pk_event;
ALTER TABLE ONLY public.estado DROP CONSTRAINT pk_estado;
ALTER TABLE ONLY public.estacion_trabajo DROP CONSTRAINT pk_estacion_trabajo;
ALTER TABLE ONLY public.est_tecnicos DROP CONSTRAINT pk_est_tecnicos;
ALTER TABLE ONLY public.est_ordenes DROP CONSTRAINT pk_est_ordenes;
ALTER TABLE ONLY public.est_ingreso DROP CONSTRAINT pk_est_ingreso;
ALTER TABLE ONLY public.est_clientes DROP CONSTRAINT pk_est_clientes;
ALTER TABLE ONLY public.envio_aut DROP CONSTRAINT pk_envio_aut;
ALTER TABLE ONLY public.entidad DROP CONSTRAINT pk_entidad;
ALTER TABLE ONLY public.edificio DROP CONSTRAINT pk_edificio;
ALTER TABLE ONLY public.detalle_orden DROP CONSTRAINT pk_detalle_orden;
ALTER TABLE ONLY public.deposito DROP CONSTRAINT pk_deposito;
ALTER TABLE ONLY public.deco_ana DROP CONSTRAINT pk_deco_ana;
ALTER TABLE ONLY public.convenio_pago DROP CONSTRAINT pk_convenio_pago;
ALTER TABLE ONLY public.conv_con DROP CONSTRAINT pk_conv_con;
ALTER TABLE ONLY public.contrato_servicio_pagado DROP CONSTRAINT pk_contrato_servicio_pagado;
ALTER TABLE ONLY public.contrato_servicio_deuda DROP CONSTRAINT pk_contrato_servicio_deuda;
ALTER TABLE ONLY public.contrato_servicio DROP CONSTRAINT pk_contrato_servicio;
ALTER TABLE ONLY public.contrato_ser DROP CONSTRAINT pk_contrato_ser;
ALTER TABLE ONLY public.contrato DROP CONSTRAINT pk_contrato;
ALTER TABLE ONLY public.config_sms DROP CONSTRAINT pk_config_sms;
ALTER TABLE ONLY public.config_mat DROP CONSTRAINT pk_config_mat;
ALTER TABLE ONLY public.conf_comision DROP CONSTRAINT pk_conf_comision;
ALTER TABLE ONLY public.comentario_cliente DROP CONSTRAINT pk_comentario_cliente;
ALTER TABLE ONLY public.comandos_sms DROP CONSTRAINT pk_comandos_sms;
ALTER TABLE ONLY public.cobrador DROP CONSTRAINT pk_cobrador;
ALTER TABLE ONLY public.cliente DROP CONSTRAINT pk_cliente;
ALTER TABLE ONLY public.conyuge DROP CONSTRAINT pk_clfdienddfte;
ALTER TABLE ONLY public.ciudad DROP CONSTRAINT pk_ciudad;
ALTER TABLE ONLY public.cirre_diario_et DROP CONSTRAINT pk_cirrfe_diario;
ALTER TABLE ONLY public.cirre_diario DROP CONSTRAINT pk_cirre_diario;
ALTER TABLE ONLY public.cierre_pago_et DROP CONSTRAINT pk_ciersdfdfre_pago;
ALTER TABLE ONLY public.cierre_pago DROP CONSTRAINT pk_cierre_pago;
ALTER TABLE ONLY public.channel DROP CONSTRAINT pk_channel;
ALTER TABLE ONLY public.castimerangebean DROP CONSTRAINT pk_castimerangebean;
ALTER TABLE ONLY public.casstbbean DROP CONSTRAINT pk_casstbbean;
ALTER TABLE ONLY public.calle DROP CONSTRAINT pk_calle;
ALTER TABLE ONLY public.caja_cobrador DROP CONSTRAINT pk_caja_cobrador;
ALTER TABLE ONLY public.caja DROP CONSTRAINT pk_caja;
ALTER TABLE ONLY public.cablemodem DROP CONSTRAINT pk_cablemodem;
ALTER TABLE ONLY public.broadcaster DROP CONSTRAINT pk_broadcaster;
ALTER TABLE ONLY public.auditoria DROP CONSTRAINT pk_auditoria;
ALTER TABLE ONLY public.asigna_recibo DROP CONSTRAINT pk_asigna_recibo;
ALTER TABLE ONLY public.alarmas DROP CONSTRAINT pk_alarmas;
ALTER TABLE ONLY public.alarma_perfil DROP CONSTRAINT pk_alarma_perfil;
ALTER TABLE ONLY public.orden_grupo DROP CONSTRAINT orden_grupo_pkey;
ALTER TABLE ONLY public.modulo_perfil DROP CONSTRAINT modulo_perfil_pkey;
ALTER TABLE ONLY public.mat_padre DROP CONSTRAINT mat_padre_pkey;
ALTER TABLE ONLY public.mantenimiento DROP CONSTRAINT mantenimiento_pkey;
ALTER TABLE ONLY public.email_sinc DROP CONSTRAINT id_e_sinc;
ALTER TABLE ONLY public.grupo_tecnico DROP CONSTRAINT grupo_tecnico_pkey;
ALTER TABLE ONLY public.detalle_tipopago DROP CONSTRAINT detalle_tipopago_pkey;
ALTER TABLE ONLY public.recibo_pago DROP CONSTRAINT detalle_tipdfopsdfago_pkey;
ALTER TABLE ONLY public.banco DROP CONSTRAINT banco_pkey;
ALTER TABLE ONLY public.abo_cortados DROP CONSTRAINT abo_cortados_pkey;


































ALTER TABLE ONLY abo_cortados
    ADD CONSTRAINT abo_cortados_pkey PRIMARY KEY (id_abo_c);


--
-- TOC entry 2992 (class 2606 OID 267595)
-- Name: banco_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY banco
    ADD CONSTRAINT banco_pkey PRIMARY KEY (id_banco);


--
-- TOC entry 3308 (class 2606 OID 267597)
-- Name: detalle_tipdfopsdfago_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY recibo_pago
    ADD CONSTRAINT detalle_tipdfopsdfago_pkey PRIMARY KEY (id_rp);


--
-- TOC entry 3097 (class 2606 OID 267599)
-- Name: detalle_tipopago_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY detalle_tipopago
    ADD CONSTRAINT detalle_tipopago_pkey PRIMARY KEY (id_tipo_pago, id_pago);


--
-- TOC entry 3148 (class 2606 OID 267603)
-- Name: grupo_tecnico_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY grupo_tecnico
    ADD CONSTRAINT grupo_tecnico_pkey PRIMARY KEY (id_gt, id_persona);


--
-- TOC entry 3104 (class 2606 OID 267605)
-- Name: id_e_sinc; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY email_sinc
    ADD CONSTRAINT id_e_sinc PRIMARY KEY (id_e_sinc);


--
-- TOC entry 3170 (class 2606 OID 267607)
-- Name: mantenimiento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mantenimiento
    ADD CONSTRAINT mantenimiento_pkey PRIMARY KEY (id_man);


--
-- TOC entry 3172 (class 2606 OID 267609)
-- Name: mat_padre_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mat_padre
    ADD CONSTRAINT mat_padre_pkey PRIMARY KEY (id_m);


--
-- TOC entry 3202 (class 2606 OID 267611)
-- Name: modulo_perfil_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY modulo_perfil
    ADD CONSTRAINT modulo_perfil_pkey PRIMARY KEY (codigoperfil, codigomodulo);


--
-- TOC entry 3241 (class 2606 OID 267613)
-- Name: orden_grupo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY orden_grupo
    ADD CONSTRAINT orden_grupo_pkey PRIMARY KEY (id_orden, id_gt);


--
-- TOC entry 2983 (class 2606 OID 267615)
-- Name: pk_alarma_perfil; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY alarma_perfil
    ADD CONSTRAINT pk_alarma_perfil PRIMARY KEY (codigoperfil, id_tipo_alarma);


--
-- TOC entry 2985 (class 2606 OID 267617)
-- Name: pk_alarmas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY alarmas
    ADD CONSTRAINT pk_alarmas PRIMARY KEY (id_alarma);


--
-- TOC entry 2987 (class 2606 OID 267619)
-- Name: pk_asigna_recibo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY asigna_recibo
    ADD CONSTRAINT pk_asigna_recibo PRIMARY KEY (id_asig);


--
-- TOC entry 2989 (class 2606 OID 267621)
-- Name: pk_auditoria; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY auditoria
    ADD CONSTRAINT pk_auditoria PRIMARY KEY (id_auditoria);


--
-- TOC entry 2994 (class 2606 OID 267623)
-- Name: pk_broadcaster; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY broadcaster
    ADD CONSTRAINT pk_broadcaster PRIMARY KEY (broadcasterid);


--
-- TOC entry 2998 (class 2606 OID 267625)
-- Name: pk_cablemodem; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cablemodem
    ADD CONSTRAINT pk_cablemodem PRIMARY KEY (id_cm);


--
-- TOC entry 3001 (class 2606 OID 267627)
-- Name: pk_caja; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY caja
    ADD CONSTRAINT pk_caja PRIMARY KEY (id_caja);


--
-- TOC entry 3006 (class 2606 OID 267629)
-- Name: pk_caja_cobrador; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY caja_cobrador
    ADD CONSTRAINT pk_caja_cobrador PRIMARY KEY (id_caja_cob);


--
-- TOC entry 3009 (class 2606 OID 267631)
-- Name: pk_calle; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY calle
    ADD CONSTRAINT pk_calle PRIMARY KEY (id_calle);


--
-- TOC entry 3012 (class 2606 OID 267633)
-- Name: pk_casstbbean; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY casstbbean
    ADD CONSTRAINT pk_casstbbean PRIMARY KEY (stbtypeid);


--
-- TOC entry 3014 (class 2606 OID 267635)
-- Name: pk_castimerangebean; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY castimerangebean
    ADD CONSTRAINT pk_castimerangebean PRIMARY KEY (idcastimerangebean);


--
-- TOC entry 3016 (class 2606 OID 267637)
-- Name: pk_channel; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY channel
    ADD CONSTRAINT pk_channel PRIMARY KEY (channelid);


--
-- TOC entry 3020 (class 2606 OID 267639)
-- Name: pk_cierre_pago; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cierre_pago
    ADD CONSTRAINT pk_cierre_pago PRIMARY KEY (id_cierre, id_caja_cob);


--
-- TOC entry 3024 (class 2606 OID 267641)
-- Name: pk_ciersdfdfre_pago; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cierre_pago_et
    ADD CONSTRAINT pk_ciersdfdfre_pago PRIMARY KEY (id_cierre, id_caja_cob);


--
-- TOC entry 3027 (class 2606 OID 267643)
-- Name: pk_cirre_diario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cirre_diario
    ADD CONSTRAINT pk_cirre_diario PRIMARY KEY (id_cierre);


--
-- TOC entry 3030 (class 2606 OID 267645)
-- Name: pk_cirrfe_diario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cirre_diario_et
    ADD CONSTRAINT pk_cirrfe_diario PRIMARY KEY (id_cierre);


--
-- TOC entry 3033 (class 2606 OID 267647)
-- Name: pk_ciudad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ciudad
    ADD CONSTRAINT pk_ciudad PRIMARY KEY (id_ciudad);


--
-- TOC entry 3083 (class 2606 OID 267649)
-- Name: pk_clfdienddfte; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY conyuge
    ADD CONSTRAINT pk_clfdienddfte PRIMARY KEY (id_persona);


--
-- TOC entry 3037 (class 2606 OID 267651)
-- Name: pk_cliente; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cliente
    ADD CONSTRAINT pk_cliente PRIMARY KEY (id_persona);


--
-- TOC entry 3040 (class 2606 OID 267653)
-- Name: pk_cobrador; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cobrador
    ADD CONSTRAINT pk_cobrador PRIMARY KEY (id_persona);


--
-- TOC entry 3044 (class 2606 OID 267655)
-- Name: pk_comandos_sms; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY comandos_sms
    ADD CONSTRAINT pk_comandos_sms PRIMARY KEY (id_com);


--
-- TOC entry 3046 (class 2606 OID 267657)
-- Name: pk_comentario_cliente; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY comentario_cliente
    ADD CONSTRAINT pk_comentario_cliente PRIMARY KEY (id_comen);


--
-- TOC entry 3048 (class 2606 OID 267659)
-- Name: pk_conf_comision; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY conf_comision
    ADD CONSTRAINT pk_conf_comision PRIMARY KEY (id_confc);


--
-- TOC entry 3050 (class 2606 OID 267661)
-- Name: pk_config_mat; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY config_mat
    ADD CONSTRAINT pk_config_mat PRIMARY KEY (id_c_mat);


--
-- TOC entry 3052 (class 2606 OID 267663)
-- Name: pk_config_sms; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY config_sms
    ADD CONSTRAINT pk_config_sms PRIMARY KEY (id_conf_sms);


--
-- TOC entry 3055 (class 2606 OID 267665)
-- Name: pk_contrato; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY contrato
    ADD CONSTRAINT pk_contrato PRIMARY KEY (id_contrato);


--
-- TOC entry 3062 (class 2606 OID 267667)
-- Name: pk_contrato_ser; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY contrato_ser
    ADD CONSTRAINT pk_contrato_ser PRIMARY KEY (id_seg);


--
-- TOC entry 3065 (class 2606 OID 267669)
-- Name: pk_contrato_servicio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY contrato_servicio
    ADD CONSTRAINT pk_contrato_servicio PRIMARY KEY (id_cont_serv);


--
-- TOC entry 3070 (class 2606 OID 267671)
-- Name: pk_contrato_servicio_deuda; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY contrato_servicio_deuda
    ADD CONSTRAINT pk_contrato_servicio_deuda PRIMARY KEY (id_cont_serv);


--
-- TOC entry 3075 (class 2606 OID 267673)
-- Name: pk_contrato_servicio_pagado; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY contrato_servicio_pagado
    ADD CONSTRAINT pk_contrato_servicio_pagado PRIMARY KEY (id_cont_serv);


--
-- TOC entry 3079 (class 2606 OID 267675)
-- Name: pk_conv_con; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY conv_con
    ADD CONSTRAINT pk_conv_con PRIMARY KEY (id_conv_cont);


--
-- TOC entry 3081 (class 2606 OID 267677)
-- Name: pk_convenio_pago; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY convenio_pago
    ADD CONSTRAINT pk_convenio_pago PRIMARY KEY (id_conv);


--
-- TOC entry 3088 (class 2606 OID 267679)
-- Name: pk_deco_ana; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY deco_ana
    ADD CONSTRAINT pk_deco_ana PRIMARY KEY (id_da);


--
-- TOC entry 3091 (class 2606 OID 267681)
-- Name: pk_deposito; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY deposito
    ADD CONSTRAINT pk_deposito PRIMARY KEY (id_dep);


--
-- TOC entry 3095 (class 2606 OID 267683)
-- Name: pk_detalle_orden; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY detalle_orden
    ADD CONSTRAINT pk_detalle_orden PRIMARY KEY (id_det_orden);


--
-- TOC entry 3101 (class 2606 OID 267685)
-- Name: pk_edificio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY edificio
    ADD CONSTRAINT pk_edificio PRIMARY KEY (id_edif);


--
-- TOC entry 3108 (class 2606 OID 267687)
-- Name: pk_entidad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY entidad
    ADD CONSTRAINT pk_entidad PRIMARY KEY (id_persona);


--
-- TOC entry 3110 (class 2606 OID 267689)
-- Name: pk_envio_aut; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY envio_aut
    ADD CONSTRAINT pk_envio_aut PRIMARY KEY (id_envio);


--
-- TOC entry 3113 (class 2606 OID 267691)
-- Name: pk_est_clientes; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY est_clientes
    ADD CONSTRAINT pk_est_clientes PRIMARY KEY (fecha_ec, id_calle);


--
-- TOC entry 3116 (class 2606 OID 267693)
-- Name: pk_est_ingreso; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY est_ingreso
    ADD CONSTRAINT pk_est_ingreso PRIMARY KEY (fecha_ei, id_calle);


--
-- TOC entry 3119 (class 2606 OID 267695)
-- Name: pk_est_ordenes; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY est_ordenes
    ADD CONSTRAINT pk_est_ordenes PRIMARY KEY (fecha_eo, id_calle, id_det_orden);


--
-- TOC entry 3122 (class 2606 OID 267697)
-- Name: pk_est_tecnicos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY est_tecnicos
    ADD CONSTRAINT pk_est_tecnicos PRIMARY KEY (fecha_et, id_det_orden, id_persona);


--
-- TOC entry 3124 (class 2606 OID 267699)
-- Name: pk_estacion_trabajo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY estacion_trabajo
    ADD CONSTRAINT pk_estacion_trabajo PRIMARY KEY (id_est);


--
-- TOC entry 3127 (class 2606 OID 267701)
-- Name: pk_estado; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY estado
    ADD CONSTRAINT pk_estado PRIMARY KEY (id_esta);


--
-- TOC entry 3130 (class 2606 OID 267703)
-- Name: pk_event; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY event
    ADD CONSTRAINT pk_event PRIMARY KEY (eventid);


--
-- TOC entry 3133 (class 2606 OID 267705)
-- Name: pk_familia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY familia
    ADD CONSTRAINT pk_familia PRIMARY KEY (id_fam);


--
-- TOC entry 3135 (class 2606 OID 267707)
-- Name: pk_formato_sms; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY formato_sms
    ADD CONSTRAINT pk_formato_sms PRIMARY KEY (id_form);


--
-- TOC entry 3138 (class 2606 OID 267709)
-- Name: pk_franquicia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY franquicia
    ADD CONSTRAINT pk_franquicia PRIMARY KEY (id_franq);


--
-- TOC entry 3141 (class 2606 OID 267711)
-- Name: pk_gerentes_permitidos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY gerentes_permitidos
    ADD CONSTRAINT pk_gerentes_permitidos PRIMARY KEY (id_persona);


--
-- TOC entry 3143 (class 2606 OID 267713)
-- Name: pk_grupo_afinidad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY grupo_afinidad
    ADD CONSTRAINT pk_grupo_afinidad PRIMARY KEY (id_g_a);


--
-- TOC entry 3151 (class 2606 OID 267715)
-- Name: pk_grupo_trabajo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY grupo_trabajo
    ADD CONSTRAINT pk_grupo_trabajo PRIMARY KEY (id_gt);


--
-- TOC entry 3153 (class 2606 OID 267717)
-- Name: pk_grupo_ubicacion; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY grupo_ubicacion
    ADD CONSTRAINT pk_grupo_ubicacion PRIMARY KEY (id_gt, id_sector);


--
-- TOC entry 3155 (class 2606 OID 267719)
-- Name: pk_hospedaje; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY hospedaje
    ADD CONSTRAINT pk_hospedaje PRIMARY KEY (id_hosp);


--
-- TOC entry 3157 (class 2606 OID 267721)
-- Name: pk_info_adic; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY info_adic
    ADD CONSTRAINT pk_info_adic PRIMARY KEY (id_inf_a);


--
-- TOC entry 3159 (class 2606 OID 267723)
-- Name: pk_interfazacc; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY interfazacc
    ADD CONSTRAINT pk_interfazacc PRIMARY KEY (id_accquery);


--
-- TOC entry 3163 (class 2606 OID 267725)
-- Name: pk_inventario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT pk_inventario PRIMARY KEY (id_inv);


--
-- TOC entry 3168 (class 2606 OID 267727)
-- Name: pk_inventario_materiales; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY inventario_materiales
    ADD CONSTRAINT pk_inventario_materiales PRIMARY KEY (id_mat, id_inv);


--
-- TOC entry 3181 (class 2606 OID 267729)
-- Name: pk_mat_ped; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mat_ped
    ADD CONSTRAINT pk_mat_ped PRIMARY KEY (id_mat, id_ped);


--
-- TOC entry 3186 (class 2606 OID 267731)
-- Name: pk_mat_prov; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mat_prov
    ADD CONSTRAINT pk_mat_prov PRIMARY KEY (id_mat, id_prov);


--
-- TOC entry 3191 (class 2606 OID 267733)
-- Name: pk_materiales; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY materiales
    ADD CONSTRAINT pk_materiales PRIMARY KEY (id_mat);


--
-- TOC entry 3194 (class 2606 OID 267735)
-- Name: pk_mensualidad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mensualidad
    ADD CONSTRAINT pk_mensualidad PRIMARY KEY (id_mensualidad);


--
-- TOC entry 3196 (class 2606 OID 267737)
-- Name: pk_message; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY message
    ADD CONSTRAINT pk_message PRIMARY KEY (idmessage);


--
-- TOC entry 3200 (class 2606 OID 267739)
-- Name: pk_modulo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY modulo
    ADD CONSTRAINT pk_modulo PRIMARY KEY (codigomodulo);


--
-- TOC entry 3207 (class 2606 OID 267741)
-- Name: pk_motivo_inv; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY motivo_inv
    ADD CONSTRAINT pk_motivo_inv PRIMARY KEY (id_motivo);


--
-- TOC entry 3209 (class 2606 OID 267743)
-- Name: pk_motivonotas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY motivonotas
    ADD CONSTRAINT pk_motivonotas PRIMARY KEY (idmotivonota);


--
-- TOC entry 3214 (class 2606 OID 267745)
-- Name: pk_mov_mat; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mov_mat
    ADD CONSTRAINT pk_mov_mat PRIMARY KEY (id_mat, id_mov);


--
-- TOC entry 3219 (class 2606 OID 267747)
-- Name: pk_mov_mat_orden; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mov_mat_orden
    ADD CONSTRAINT pk_mov_mat_orden PRIMARY KEY (id_mat, id_mov);


--
-- TOC entry 3223 (class 2606 OID 267749)
-- Name: pk_movimiento; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY movimiento
    ADD CONSTRAINT pk_movimiento PRIMARY KEY (id_mov);


--
-- TOC entry 3227 (class 2606 OID 267751)
-- Name: pk_movimiento_orden; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY movimiento_orden
    ADD CONSTRAINT pk_movimiento_orden PRIMARY KEY (id_mov);


--
-- TOC entry 3230 (class 2606 OID 267753)
-- Name: pk_municipio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT pk_municipio PRIMARY KEY (id_mun);


--
-- TOC entry 3236 (class 2606 OID 267755)
-- Name: pk_notas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY notas
    ADD CONSTRAINT pk_notas PRIMARY KEY (id_nota);


--
-- TOC entry 3244 (class 2606 OID 267757)
-- Name: pk_ordenes_tecnicos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ordenes_tecnicos
    ADD CONSTRAINT pk_ordenes_tecnicos PRIMARY KEY (id_orden);


--
-- TOC entry 3265 (class 2606 OID 267759)
-- Name: pk_padgos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pagos_his
    ADD CONSTRAINT pk_padgos PRIMARY KEY (id_pago);


--
-- TOC entry 3248 (class 2606 OID 267761)
-- Name: pk_pago_comisiones; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pago_comisiones
    ADD CONSTRAINT pk_pago_comisiones PRIMARY KEY (id_comi);


--
-- TOC entry 3250 (class 2606 OID 267763)
-- Name: pk_pago_comisones; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pago_comisones
    ADD CONSTRAINT pk_pago_comisones PRIMARY KEY (id_pago_com);


--
-- TOC entry 3252 (class 2606 OID 267765)
-- Name: pk_pago_servicio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pago_servicio
    ADD CONSTRAINT pk_pago_servicio PRIMARY KEY (id_pago, id_cont_serv);


--
-- TOC entry 3257 (class 2606 OID 267767)
-- Name: pk_pagodeposito; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pagodeposito
    ADD CONSTRAINT pk_pagodeposito PRIMARY KEY (id_pd);


--
-- TOC entry 3260 (class 2606 OID 267769)
-- Name: pk_pagos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pagos
    ADD CONSTRAINT pk_pagos PRIMARY KEY (id_pago);


--
-- TOC entry 3269 (class 2606 OID 267773)
-- Name: pk_parametros; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY parametros
    ADD CONSTRAINT pk_parametros PRIMARY KEY (id_param);


--
-- TOC entry 3274 (class 2606 OID 267775)
-- Name: pk_pedido; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pedido
    ADD CONSTRAINT pk_pedido PRIMARY KEY (id_ped);


--
-- TOC entry 3277 (class 2606 OID 267777)
-- Name: pk_perfil; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY perfil
    ADD CONSTRAINT pk_perfil PRIMARY KEY (codigoperfil);


--
-- TOC entry 3280 (class 2606 OID 267779)
-- Name: pk_persona; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY persona
    ADD CONSTRAINT pk_persona PRIMARY KEY (id_persona);


--
-- TOC entry 3287 (class 2606 OID 267781)
-- Name: pk_precintos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY precintos
    ADD CONSTRAINT pk_precintos PRIMARY KEY (id_prec);


--
-- TOC entry 3291 (class 2606 OID 267783)
-- Name: pk_product; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY product
    ADD CONSTRAINT pk_product PRIMARY KEY (productid);


--
-- TOC entry 3293 (class 2606 OID 267785)
-- Name: pk_productevent; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY productevent
    ADD CONSTRAINT pk_productevent PRIMARY KEY (eventid, productid);


--
-- TOC entry 3295 (class 2606 OID 267787)
-- Name: pk_promo_contrato; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY promo_contrato
    ADD CONSTRAINT pk_promo_contrato PRIMARY KEY (id_promo_con);


--
-- TOC entry 3297 (class 2606 OID 267789)
-- Name: pk_promo_serv; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY promo_serv
    ADD CONSTRAINT pk_promo_serv PRIMARY KEY (id_serv, id_promo);


--
-- TOC entry 3299 (class 2606 OID 267791)
-- Name: pk_promocion; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY promocion
    ADD CONSTRAINT pk_promocion PRIMARY KEY (id_promo);


--
-- TOC entry 3301 (class 2606 OID 267793)
-- Name: pk_proveedor; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY proveedor
    ADD CONSTRAINT pk_proveedor PRIMARY KEY (id_prov);


--
-- TOC entry 3304 (class 2606 OID 267795)
-- Name: pk_purchase; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY purchase
    ADD CONSTRAINT pk_purchase PRIMARY KEY (idpurchase);


--
-- TOC entry 3306 (class 2606 OID 267797)
-- Name: pk_recibe_recibo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY recibe_recibo
    ADD CONSTRAINT pk_recibe_recibo PRIMARY KEY (id_rec);


--
-- TOC entry 3312 (class 2606 OID 267799)
-- Name: pk_recibos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY recibos
    ADD CONSTRAINT pk_recibos PRIMARY KEY (nro_recibo, tipo);


--
-- TOC entry 3314 (class 2606 OID 267801)
-- Name: pk_reclamo_denuncia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY reclamo_denuncia
    ADD CONSTRAINT pk_reclamo_denuncia PRIMARY KEY (id_rec);


--
-- TOC entry 3319 (class 2606 OID 267803)
-- Name: pk_sector; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sector
    ADD CONSTRAINT pk_sector PRIMARY KEY (id_sector);


--
-- TOC entry 3323 (class 2606 OID 267805)
-- Name: pk_servicios; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY servicios
    ADD CONSTRAINT pk_servicios PRIMARY KEY (id_serv);


--
-- TOC entry 3327 (class 2606 OID 267807)
-- Name: pk_smartcard; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY smartcard
    ADD CONSTRAINT pk_smartcard PRIMARY KEY (smcid);


--
-- TOC entry 3329 (class 2606 OID 267809)
-- Name: pk_sms; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sms
    ADD CONSTRAINT pk_sms PRIMARY KEY (id_sms);


--
-- TOC entry 3333 (class 2606 OID 267811)
-- Name: pk_sms_excel; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sms_excel
    ADD CONSTRAINT pk_sms_excel PRIMARY KEY (ids);


--
-- TOC entry 3335 (class 2606 OID 267813)
-- Name: pk_sms_sinc; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sms_sinc
    ADD CONSTRAINT pk_sms_sinc PRIMARY KEY (id_sinc);


--
-- TOC entry 3338 (class 2606 OID 267815)
-- Name: pk_statuscont; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY statuscont
    ADD CONSTRAINT pk_statuscont PRIMARY KEY (idstatus);


--
-- TOC entry 3340 (class 2606 OID 267817)
-- Name: pk_subscription; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY subscription
    ADD CONSTRAINT pk_subscription PRIMARY KEY (subscriptionid);


--
-- TOC entry 3342 (class 2606 OID 267819)
-- Name: pk_subscriptionchannel; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY subscriptionchannel
    ADD CONSTRAINT pk_subscriptionchannel PRIMARY KEY (subscriptionid, channelid);


--
-- TOC entry 3344 (class 2606 OID 267821)
-- Name: pk_tarifa_servicio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tarifa_servicio
    ADD CONSTRAINT pk_tarifa_servicio PRIMARY KEY (id_tar_ser);


--
-- TOC entry 3348 (class 2606 OID 267823)
-- Name: pk_tecnico; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tecnico
    ADD CONSTRAINT pk_tecnico PRIMARY KEY (id_persona);


--
-- TOC entry 3351 (class 2606 OID 267825)
-- Name: pk_tipo_alarma; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_alarma
    ADD CONSTRAINT pk_tipo_alarma PRIMARY KEY (id_tipo_alarma);


--
-- TOC entry 3353 (class 2606 OID 267827)
-- Name: pk_tipo_entidad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_entidad
    ADD CONSTRAINT pk_tipo_entidad PRIMARY KEY (id_te);


--
-- TOC entry 3356 (class 2606 OID 267829)
-- Name: pk_tipo_movimiento; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_movimiento
    ADD CONSTRAINT pk_tipo_movimiento PRIMARY KEY (id_tm);


--
-- TOC entry 3359 (class 2606 OID 267831)
-- Name: pk_tipo_orden; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_orden
    ADD CONSTRAINT pk_tipo_orden PRIMARY KEY (id_tipo_orden);


--
-- TOC entry 3362 (class 2606 OID 267833)
-- Name: pk_tipo_pago; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_pago
    ADD CONSTRAINT pk_tipo_pago PRIMARY KEY (id_tipo_pago);


--
-- TOC entry 3365 (class 2606 OID 267835)
-- Name: pk_tipo_servicio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_servicio
    ADD CONSTRAINT pk_tipo_servicio PRIMARY KEY (id_tipo_servicio);


--
-- TOC entry 3369 (class 2606 OID 267837)
-- Name: pk_unidad_medida; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY unidad_medida
    ADD CONSTRAINT pk_unidad_medida PRIMARY KEY (id_unidad);


--
-- TOC entry 3372 (class 2606 OID 267839)
-- Name: pk_urbanizacion; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY urbanizacion
    ADD CONSTRAINT pk_urbanizacion PRIMARY KEY (id_urb);


--
-- TOC entry 3282 (class 2606 OID 267841)
-- Name: pk_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT pk_usuario PRIMARY KEY (login);


--
-- TOC entry 3374 (class 2606 OID 267843)
-- Name: pk_variables_sms; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY variables_sms
    ADD CONSTRAINT pk_variables_sms PRIMARY KEY (id_var);


--
-- TOC entry 3376 (class 2606 OID 267845)
-- Name: pk_vendedor; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY vendedor
    ADD CONSTRAINT pk_vendedor PRIMARY KEY (id_persona);


--
-- TOC entry 3379 (class 2606 OID 267847)
-- Name: pk_visitas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY visitas
    ADD CONSTRAINT pk_visitas PRIMARY KEY (id_visita);


--
-- TOC entry 3384 (class 2606 OID 267849)
-- Name: pk_zona; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY zona
    ADD CONSTRAINT pk_zona PRIMARY KEY (id_zona);


--
-- TOC entry 3289 (class 2606 OID 267851)
-- Name: proceso_corte_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY proceso_corte
    ADD CONSTRAINT proceso_corte_pkey PRIMARY KEY (id_proc);


--
-- TOC entry 3317 (class 2606 OID 267853)
-- Name: recuperado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY recuperado
    ADD CONSTRAINT recuperado_pkey PRIMARY KEY (id_contrato, fecha_rec);


--
-- TOC entry 2990 (class 1259 OID 267854)
-- Name: banco_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX banco_pk ON banco USING btree (id_banco);


--
-- TOC entry 3002 (class 1259 OID 267855)
-- Name: caja_cob_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX caja_cob_pk ON caja_cobrador USING btree (id_caja);


--
-- TOC entry 3003 (class 1259 OID 267856)
-- Name: caja_cobrador_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX caja_cobrador_pk ON caja_cobrador USING btree (id_caja_cob);


--
-- TOC entry 2999 (class 1259 OID 267857)
-- Name: caja_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX caja_pk ON caja USING btree (id_caja);


--
-- TOC entry 3004 (class 1259 OID 267858)
-- Name: cajadf_cob_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX cajadf_cob_pk ON caja_cobrador USING btree (id_est);


--
-- TOC entry 3007 (class 1259 OID 267859)
-- Name: calle_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX calle_pk ON calle USING btree (id_calle);

ALTER TABLE calle CLUSTER ON calle_pk;


--
-- TOC entry 3017 (class 1259 OID 267860)
-- Name: cierre_pago_22_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX cierre_pago_22_pk ON cierre_pago USING btree (id_cierre, id_caja_cob);


--
-- TOC entry 3018 (class 1259 OID 267861)
-- Name: cierre_pago_23_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX cierre_pago_23_pk ON cierre_pago USING btree (id_caja_cob);


--
-- TOC entry 3022 (class 1259 OID 267862)
-- Name: cierre_sdfpago_22_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX cierre_sdfpago_22_pk ON cierre_pago_et USING btree (id_cierre, id_caja_cob);


--
-- TOC entry 3028 (class 1259 OID 267863)
-- Name: cirre_ddfiario_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX cirre_ddfiario_pk ON cirre_diario_et USING btree (id_cierre);


--
-- TOC entry 3025 (class 1259 OID 267864)
-- Name: cirre_diario_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX cirre_diario_pk ON cirre_diario USING btree (id_cierre);


--
-- TOC entry 3125 (class 1259 OID 267865)
-- Name: ciuddpk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX ciuddpk ON estado USING btree (id_esta);


--
-- TOC entry 3228 (class 1259 OID 267866)
-- Name: ciudpk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX ciudpk ON municipio USING btree (id_mun);


--
-- TOC entry 3031 (class 1259 OID 267867)
-- Name: ciupk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX ciupk ON ciudad USING btree (id_ciudad);


--
-- TOC entry 3035 (class 1259 OID 267868)
-- Name: cliente_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX cliente_pk ON cliente USING btree (id_persona);

ALTER TABLE cliente CLUSTER ON cliente_pk;


--
-- TOC entry 3038 (class 1259 OID 267869)
-- Name: cobrador_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX cobrador_pk ON cobrador USING btree (id_persona);


--
-- TOC entry 3084 (class 1259 OID 267870)
-- Name: cocio_pagado_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX cocio_pagado_pk ON deco_ana USING btree (id_contrato);


--
-- TOC entry 2995 (class 1259 OID 267871)
-- Name: cocio_pagafdo_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX cocio_pagafdo_pk ON cablemodem USING btree (id_contrato);


--
-- TOC entry 3041 (class 1259 OID 267872)
-- Name: comandos_sms_1_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX comandos_sms_1_pk ON comandos_sms USING btree (id_franq);


--
-- TOC entry 3042 (class 1259 OID 267873)
-- Name: comandos_sms_22_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX comandos_sms_22_pk ON comandos_sms USING btree (id_com);


--
-- TOC entry 3053 (class 1259 OID 267874)
-- Name: contrato_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX contrato_pk ON contrato USING btree (id_contrato);

ALTER TABLE contrato CLUSTER ON contrato_pk;


--
-- TOC entry 2996 (class 1259 OID 267875)
-- Name: contrato_sedfdrvdicio_pagado_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX contrato_sedfdrvdicio_pagado_pk ON cablemodem USING btree (id_cm);


--
-- TOC entry 3085 (class 1259 OID 267876)
-- Name: contrato_sedrvdicio_pagado_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX contrato_sedrvdicio_pagado_pk ON deco_ana USING btree (id_da);


--
-- TOC entry 3086 (class 1259 OID 267877)
-- Name: contrato_sedrvicio_pagado_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX contrato_sedrvicio_pagado_pk ON deco_ana USING btree (id_da);


--
-- TOC entry 3068 (class 1259 OID 267878)
-- Name: contrato_servicio_deuda_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX contrato_servicio_deuda_pk ON contrato_servicio_deuda USING btree (id_cont_serv);


--
-- TOC entry 3073 (class 1259 OID 267879)
-- Name: contrato_servicio_pagado_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX contrato_servicio_pagado_pk ON contrato_servicio_pagado USING btree (id_cont_serv);


--
-- TOC entry 3063 (class 1259 OID 267880)
-- Name: contrato_servicio_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX contrato_servicio_pk ON contrato_servicio USING btree (id_cont_serv);


--
-- TOC entry 3092 (class 1259 OID 267881)
-- Name: detalle_orden_1_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX detalle_orden_1_pk ON detalle_orden USING btree (id_det_orden);


--
-- TOC entry 3093 (class 1259 OID 267882)
-- Name: detalle_orden_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX detalle_orden_2_pk ON detalle_orden USING btree (id_tipo_orden);


--
-- TOC entry 3102 (class 1259 OID 267883)
-- Name: email_sinc_1_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX email_sinc_1_pk ON email_sinc USING btree (id_e_sinc);


--
-- TOC entry 3105 (class 1259 OID 267884)
-- Name: entidad_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX entidad_pk_1 ON entidad USING btree (id_persona);


--
-- TOC entry 3106 (class 1259 OID 267885)
-- Name: entidfgad_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX entidfgad_pk_1 ON entidad USING btree (id_te);


--
-- TOC entry 3111 (class 1259 OID 267886)
-- Name: est_clientes_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX est_clientes_2_pk ON est_clientes USING btree (id_ec);


--
-- TOC entry 3114 (class 1259 OID 267887)
-- Name: est_ingreso_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX est_ingreso_2_pk ON est_ingreso USING btree (id_ei);


--
-- TOC entry 3117 (class 1259 OID 267888)
-- Name: est_ordenes_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX est_ordenes_2_pk ON est_ordenes USING btree (id_eo);


--
-- TOC entry 3120 (class 1259 OID 267889)
-- Name: est_tecnicos_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX est_tecnicos_2_pk ON est_tecnicos USING btree (id_et);


--
-- TOC entry 3131 (class 1259 OID 267890)
-- Name: familia_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX familia_pk_1 ON familia USING btree (id_fam);


--
-- TOC entry 3136 (class 1259 OID 267891)
-- Name: franquicia_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX franquicia_pk ON franquicia USING btree (id_franq);

ALTER TABLE franquicia CLUSTER ON franquicia_pk;


--
-- TOC entry 3139 (class 1259 OID 267892)
-- Name: gerentes_permitidos_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX gerentes_permitidos_2_pk ON gerentes_permitidos USING btree (id_persona);


--
-- TOC entry 3144 (class 1259 OID 267893)
-- Name: grupo_tecnico_1_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX grupo_tecnico_1_pk ON grupo_tecnico USING btree (id_gt);


--
-- TOC entry 3145 (class 1259 OID 267894)
-- Name: grupo_tecnico_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX grupo_tecnico_2_pk ON grupo_tecnico USING btree (id_gt, id_persona);


--
-- TOC entry 3146 (class 1259 OID 267895)
-- Name: grupo_tecnico_3_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX grupo_tecnico_3_pk ON grupo_tecnico USING btree (id_persona);


--
-- TOC entry 3149 (class 1259 OID 267896)
-- Name: grupo_trabajo_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX grupo_trabajo_2_pk ON grupo_trabajo USING btree (id_gt);


--
-- TOC entry 3187 (class 1259 OID 267897)
-- Name: id_depd_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX id_depd_pk_1 ON materiales USING btree (id_dep);


--
-- TOC entry 3382 (class 1259 OID 267898)
-- Name: id_franq_1_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX id_franq_1_pk ON zona USING btree (id_franq);


--
-- TOC entry 3177 (class 1259 OID 267899)
-- Name: id_mat_pk_2; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX id_mat_pk_2 ON mat_ped USING btree (id_mat);


--
-- TOC entry 3178 (class 1259 OID 267900)
-- Name: id_mat_pk_3; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX id_mat_pk_3 ON mat_ped USING btree (id_ped);


--
-- TOC entry 3089 (class 1259 OID 267901)
-- Name: index_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX index_pk_1 ON deposito USING btree (id_dep);


--
-- TOC entry 3164 (class 1259 OID 267902)
-- Name: inventario_materiales_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX inventario_materiales_pk_1 ON inventario_materiales USING btree (id_mat, id_inv);


--
-- TOC entry 3165 (class 1259 OID 267903)
-- Name: inventario_materiales_pk_2; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX inventario_materiales_pk_2 ON inventario_materiales USING btree (id_mat);


--
-- TOC entry 3166 (class 1259 OID 267904)
-- Name: inventario_materiales_pk_3; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX inventario_materiales_pk_3 ON inventario_materiales USING btree (id_inv);


--
-- TOC entry 3160 (class 1259 OID 267905)
-- Name: inventario_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX inventario_pk ON inventario USING btree (id_inv);


--
-- TOC entry 3161 (class 1259 OID 267906)
-- Name: inventario_pk_2; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX inventario_pk_2 ON inventario USING btree (id_motivo);


--
-- TOC entry 3188 (class 1259 OID 267907)
-- Name: jjj; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX jjj ON materiales USING btree (id_m);


--
-- TOC entry 3179 (class 1259 OID 267908)
-- Name: mat_ped_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX mat_ped_pk_1 ON mat_ped USING btree (id_mat, id_ped);


--
-- TOC entry 3182 (class 1259 OID 267909)
-- Name: mat_prov_pk_22; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX mat_prov_pk_22 ON mat_prov USING btree (id_prov);


--
-- TOC entry 3183 (class 1259 OID 267910)
-- Name: mat_prov_pk_3; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX mat_prov_pk_3 ON mat_prov USING btree (id_mat, id_prov);


--
-- TOC entry 3184 (class 1259 OID 267911)
-- Name: mat_prov_pk_32; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX mat_prov_pk_32 ON mat_prov USING btree (id_mat);


--
-- TOC entry 3189 (class 1259 OID 267912)
-- Name: materiales_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX materiales_pk ON materiales USING btree (id_mat);


--
-- TOC entry 3192 (class 1259 OID 267913)
-- Name: mensualidad_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX mensualidad_2_pk ON mensualidad USING btree (id_mensualidad);


--
-- TOC entry 3197 (class 1259 OID 267914)
-- Name: modulo_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX modulo_2_pk ON modulo USING btree (codigomodulo);


--
-- TOC entry 3198 (class 1259 OID 267915)
-- Name: modulo_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX modulo_pk ON modulo USING btree (codigomodulo);


--
-- TOC entry 3205 (class 1259 OID 267916)
-- Name: motivo_inv_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX motivo_inv_pk_1 ON motivo_inv USING btree (id_motivo);


--
-- TOC entry 3215 (class 1259 OID 267917)
-- Name: mov_mat_orden_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX mov_mat_orden_pk_1 ON mov_mat_orden USING btree (id_mat, id_mov);


--
-- TOC entry 3216 (class 1259 OID 267918)
-- Name: mov_mat_orden_pk_2; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX mov_mat_orden_pk_2 ON mov_mat_orden USING btree (id_mat);


--
-- TOC entry 3217 (class 1259 OID 267919)
-- Name: mov_mat_orden_pk_4; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX mov_mat_orden_pk_4 ON mov_mat_orden USING btree (id_mov);


--
-- TOC entry 3210 (class 1259 OID 267920)
-- Name: mov_mat_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX mov_mat_pk_1 ON mov_mat USING btree (id_mat, id_mov);


--
-- TOC entry 3211 (class 1259 OID 267921)
-- Name: mov_mat_pk_2; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX mov_mat_pk_2 ON mov_mat USING btree (id_mat);


--
-- TOC entry 3212 (class 1259 OID 267922)
-- Name: mov_mat_pk_4; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX mov_mat_pk_4 ON mov_mat USING btree (id_mov);


--
-- TOC entry 3224 (class 1259 OID 267923)
-- Name: movimiento_ordenpk_2; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX movimiento_ordenpk_2 ON movimiento_orden USING btree (id_tm);


--
-- TOC entry 3225 (class 1259 OID 267924)
-- Name: movimiento_ordenpk_6; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX movimiento_ordenpk_6 ON movimiento_orden USING btree (id_mov);


--
-- TOC entry 3220 (class 1259 OID 267925)
-- Name: movimientopk_2; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX movimientopk_2 ON movimiento USING btree (id_tm);


--
-- TOC entry 3221 (class 1259 OID 267926)
-- Name: movimientopk_6; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX movimientopk_6 ON movimiento USING btree (id_mov);


--
-- TOC entry 3232 (class 1259 OID 267927)
-- Name: notas_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX notas_2_pk ON notas USING btree (id_nota);


--
-- TOC entry 3233 (class 1259 OID 267928)
-- Name: notas_3_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX notas_3_pk ON notas USING btree (id_contrato);


--
-- TOC entry 3234 (class 1259 OID 267929)
-- Name: notas_4_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX notas_4_pk ON notas USING btree (idmotivonota);


--
-- TOC entry 3237 (class 1259 OID 267930)
-- Name: orden_grupo_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX orden_grupo_2_pk ON orden_grupo USING btree (id_gt);


--
-- TOC entry 3238 (class 1259 OID 267931)
-- Name: orden_grupo_3_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX orden_grupo_3_pk ON orden_grupo USING btree (id_orden);


--
-- TOC entry 3239 (class 1259 OID 267932)
-- Name: orden_grupo_4_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX orden_grupo_4_pk ON orden_grupo USING btree (id_orden, id_gt);


--
-- TOC entry 3242 (class 1259 OID 267933)
-- Name: ordenes_tecnicos_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX ordenes_tecnicos_pk ON ordenes_tecnicos USING btree (id_orden);


--
-- TOC entry 3258 (class 1259 OID 267934)
-- Name: pagos_20_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX pagos_20_fk ON pagos USING btree (id_pago);


--
-- TOC entry 3267 (class 1259 OID 267941)
-- Name: parametros_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX parametros_pk ON parametros USING btree (id_param);


--
-- TOC entry 3271 (class 1259 OID 267942)
-- Name: pedido_pk_3; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pedido_pk_3 ON pedido USING btree (id_ped);


--
-- TOC entry 3272 (class 1259 OID 267943)
-- Name: pedido_pk_6; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX pedido_pk_6 ON pedido USING btree (id_prov);


--
-- TOC entry 3275 (class 1259 OID 267944)
-- Name: perfil_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX perfil_pk ON perfil USING btree (codigoperfil);


--
-- TOC entry 3278 (class 1259 OID 267945)
-- Name: persona_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX persona_pk ON persona USING btree (id_persona);

ALTER TABLE persona CLUSTER ON persona_pk;


--
-- TOC entry 3173 (class 1259 OID 267946)
-- Name: provee45dor8p88k_67; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX provee45dor8p88k_67 ON mat_padre USING btree (uni_id_unidad);


--
-- TOC entry 3174 (class 1259 OID 267947)
-- Name: provee45dorp88k_67; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX provee45dorp88k_67 ON mat_padre USING btree (id_unidad);


--
-- TOC entry 3175 (class 1259 OID 267948)
-- Name: provee45dorpk_6; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX provee45dorpk_6 ON mat_padre USING btree (id_m);


--
-- TOC entry 3176 (class 1259 OID 267949)
-- Name: provee45dorpk_67; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX provee45dorpk_67 ON mat_padre USING btree (id_fam);


--
-- TOC entry 3302 (class 1259 OID 267950)
-- Name: proveedorpk_6; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX proveedorpk_6 ON proveedor USING btree (id_prov);


--
-- TOC entry 3315 (class 1259 OID 267951)
-- Name: recuperado_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX recuperado_2_pk ON recuperado USING btree (id_contrato);


--
-- TOC entry 3056 (class 1259 OID 267952)
-- Name: redflatiodfff; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX redflatiodfff ON contrato USING btree (edificio);


--
-- TOC entry 3128 (class 1259 OID 267953)
-- Name: reladtiddffk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX reladtiddffk ON estado USING btree (id_franq);


--
-- TOC entry 3231 (class 1259 OID 267954)
-- Name: reladtidffk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX reladtidffk ON municipio USING btree (id_esta);


--
-- TOC entry 3034 (class 1259 OID 267955)
-- Name: relatidffk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relatidffk ON ciudad USING btree (id_mun);


--
-- TOC entry 3057 (class 1259 OID 267956)
-- Name: relatiodfff; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relatiodfff ON contrato USING btree (urbanizacion);


--
-- TOC entry 3261 (class 1259 OID 267957)
-- Name: relationdfship_29_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationdfship_29_fk ON pagos USING btree (inc);


--
-- TOC entry 3309 (class 1259 OID 267958)
-- Name: relationsasfhip_13_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationsasfhip_13_fk ON recibo_pago USING btree (id_pago);


--
-- TOC entry 3310 (class 1259 OID 267959)
-- Name: relationsdfdfship_12_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX relationsdfdfship_12_fk ON recibo_pago USING btree (id_rp);


--
-- TOC entry 3262 (class 1259 OID 267960)
-- Name: relationsdhip_20_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationsdhip_20_fk ON pagos USING btree (id_contrato);


--
-- TOC entry 3266 (class 1259 OID 267961)
-- Name: relationshidp_14_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationshidp_14_fk ON pagos_his USING btree (id_contrato);


--
-- TOC entry 3245 (class 1259 OID 267962)
-- Name: relationship4_8_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship4_8_fk ON ordenes_tecnicos USING btree (id_contrato);


--
-- TOC entry 3324 (class 1259 OID 267963)
-- Name: relationship_10_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_10_fk ON servicios USING btree (id_tipo_servicio);


--
-- TOC entry 3345 (class 1259 OID 267964)
-- Name: relationship_11_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_11_fk ON tarifa_servicio USING btree (id_serv);


--
-- TOC entry 3098 (class 1259 OID 267965)
-- Name: relationship_12_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_12_fk ON detalle_tipopago USING btree (id_tipo_pago);


--
-- TOC entry 3099 (class 1259 OID 267966)
-- Name: relationship_13_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_13_fk ON detalle_tipopago USING btree (id_pago);


--
-- TOC entry 3283 (class 1259 OID 267968)
-- Name: relationship_14_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_14_fk ON usuario USING btree (codigoperfil);


--
-- TOC entry 3203 (class 1259 OID 267969)
-- Name: relationship_15_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_15_fk ON modulo_perfil USING btree (codigoperfil);


--
-- TOC entry 3204 (class 1259 OID 267970)
-- Name: relationship_16_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_16_fk ON modulo_perfil USING btree (codigomodulo);


--
-- TOC entry 3066 (class 1259 OID 267971)
-- Name: relationship_20_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_20_fk ON contrato_servicio USING btree (id_contrato);


--
-- TOC entry 3067 (class 1259 OID 267972)
-- Name: relationship_21_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_21_fk ON contrato_servicio USING btree (id_serv);


--
-- TOC entry 3253 (class 1259 OID 267973)
-- Name: relationship_22_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_22_fk ON pago_servicio USING btree (id_pago);


--
-- TOC entry 3254 (class 1259 OID 267974)
-- Name: relationship_22_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX relationship_22_pk ON pago_servicio USING btree (id_pago, id_cont_serv);


--
-- TOC entry 3255 (class 1259 OID 267975)
-- Name: relationship_23_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_23_fk ON pago_servicio USING btree (id_cont_serv);


--
-- TOC entry 3284 (class 1259 OID 267976)
-- Name: relationship_24_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_24_fk ON usuario USING btree (id_persona);


--
-- TOC entry 3270 (class 1259 OID 267977)
-- Name: relationship_25_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_25_fk ON parametros USING btree (id_franq);


--
-- TOC entry 3021 (class 1259 OID 267978)
-- Name: relationship_27_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_27_fk ON cierre_pago USING btree (id_cierre);


--
-- TOC entry 3058 (class 1259 OID 267979)
-- Name: relationship_28_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_28_fk ON contrato USING btree (id_persona);


--
-- TOC entry 3263 (class 1259 OID 267980)
-- Name: relationship_29_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_29_fk ON pagos USING btree (id_caja_cob);


--
-- TOC entry 3059 (class 1259 OID 267982)
-- Name: relationship_4_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_4_fk ON contrato USING btree (cli_id_persona);


--
-- TOC entry 3060 (class 1259 OID 267983)
-- Name: relationship_5_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_5_fk ON contrato USING btree (id_calle);


--
-- TOC entry 3010 (class 1259 OID 267984)
-- Name: relationship_6_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_6_fk ON calle USING btree (id_sector);


--
-- TOC entry 3320 (class 1259 OID 267985)
-- Name: relationship_7_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_7_fk ON sector USING btree (id_zona);


--
-- TOC entry 3246 (class 1259 OID 267986)
-- Name: relationship_8_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_8_fk ON ordenes_tecnicos USING btree (id_det_orden);


--
-- TOC entry 3071 (class 1259 OID 267987)
-- Name: relationship_deuda_20_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_deuda_20_fk ON contrato_servicio_deuda USING btree (id_contrato);


--
-- TOC entry 3072 (class 1259 OID 267988)
-- Name: relationship_deuda_21_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_deuda_21_fk ON contrato_servicio_deuda USING btree (id_serv);


--
-- TOC entry 3076 (class 1259 OID 267989)
-- Name: relationship_pagado_20_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_pagado_20_fk ON contrato_servicio_pagado USING btree (id_contrato);


--
-- TOC entry 3077 (class 1259 OID 267990)
-- Name: relationship_pagado_21_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_pagado_21_fk ON contrato_servicio_pagado USING btree (id_serv);


--
-- TOC entry 3321 (class 1259 OID 267991)
-- Name: sector_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX sector_pk ON sector USING btree (id_sector);

ALTER TABLE sector CLUSTER ON sector_pk;


--
-- TOC entry 3325 (class 1259 OID 267992)
-- Name: servicios_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX servicios_pk ON servicios USING btree (id_serv);


--
-- TOC entry 3330 (class 1259 OID 267993)
-- Name: sms_1_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sms_1_pk ON sms USING btree (id_contrato);


--
-- TOC entry 3331 (class 1259 OID 267994)
-- Name: sms_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX sms_2_pk ON sms USING btree (id_sms);


--
-- TOC entry 3336 (class 1259 OID 267995)
-- Name: sms_sinc_1_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sms_sinc_1_pk ON sms_sinc USING btree (id_sinc);


--
-- TOC entry 3346 (class 1259 OID 267996)
-- Name: tarifa_servicio_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX tarifa_servicio_pk ON tarifa_servicio USING btree (id_tar_ser);


--
-- TOC entry 3349 (class 1259 OID 267997)
-- Name: tecnico_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX tecnico_pk ON tecnico USING btree (id_persona);


--
-- TOC entry 3354 (class 1259 OID 267998)
-- Name: tipo_entidad_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX tipo_entidad_pk_1 ON tipo_entidad USING btree (id_te);


--
-- TOC entry 3357 (class 1259 OID 267999)
-- Name: tipo_movimientopk_6; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX tipo_movimientopk_6 ON tipo_movimiento USING btree (id_tm);


--
-- TOC entry 3360 (class 1259 OID 268000)
-- Name: tipo_orden_1_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tipo_orden_1_pk ON tipo_orden USING btree (id_tipo_orden);


--
-- TOC entry 3363 (class 1259 OID 268001)
-- Name: tipo_pago_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX tipo_pago_pk ON tipo_pago USING btree (id_tipo_pago);


--
-- TOC entry 3366 (class 1259 OID 268002)
-- Name: tipo_servicio_1_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tipo_servicio_1_pk ON tipo_servicio USING btree (id_franq);


--
-- TOC entry 3367 (class 1259 OID 268003)
-- Name: tipo_servicio_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX tipo_servicio_pk ON tipo_servicio USING btree (id_tipo_servicio);


--
-- TOC entry 3370 (class 1259 OID 268004)
-- Name: unidad_medidapk_6; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX unidad_medidapk_6 ON unidad_medida USING btree (id_unidad);


--
-- TOC entry 3285 (class 1259 OID 268005)
-- Name: usuario_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX usuario_pk ON usuario USING btree (login);


--
-- TOC entry 3377 (class 1259 OID 268006)
-- Name: vendedor_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX vendedor_pk ON vendedor USING btree (id_persona);


--
-- TOC entry 3380 (class 1259 OID 268007)
-- Name: visitas_1_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX visitas_1_pk ON visitas USING btree (id_visita);


--
-- TOC entry 3381 (class 1259 OID 268008)
-- Name: visitas_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX visitas_2_pk ON visitas USING btree (id_orden);


--
-- TOC entry 3385 (class 1259 OID 268009)
-- Name: zona_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX zona_pk ON zona USING btree (id_zona);


--
-- TOC entry 3386 (class 2606 OID 268012)
-- Name: abo_cortados_id_orden_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY abo_cortados
    ADD CONSTRAINT abo_cortados_id_orden_fkey FOREIGN KEY (id_orden) REFERENCES ordenes_tecnicos(id_orden);


--
-- TOC entry 3392 (class 2606 OID 268017)
-- Name: caja_cobrador_id_est_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY caja_cobrador
    ADD CONSTRAINT caja_cobrador_id_est_fkey FOREIGN KEY (id_est) REFERENCES estacion_trabajo(id_est);


--
-- TOC entry 3407 (class 2606 OID 268022)
-- Name: contrato_id_g_a_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contrato
    ADD CONSTRAINT contrato_id_g_a_fkey FOREIGN KEY (id_g_a) REFERENCES grupo_afinidad(id_g_a);


--
-- TOC entry 3413 (class 2606 OID 268027)
-- Name: contrato_servicio_deuda_id_contrato_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contrato_servicio_deuda
    ADD CONSTRAINT contrato_servicio_deuda_id_contrato_fkey FOREIGN KEY (id_contrato) REFERENCES contrato(id_contrato);


--
-- TOC entry 3411 (class 2606 OID 268032)
-- Name: contrato_servicio_id_contrato_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contrato_servicio
    ADD CONSTRAINT contrato_servicio_id_contrato_fkey FOREIGN KEY (id_contrato) REFERENCES contrato(id_contrato);


--
-- TOC entry 3415 (class 2606 OID 268037)
-- Name: contrato_servicio_pagado_id_contrato_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contrato_servicio_pagado
    ADD CONSTRAINT contrato_servicio_pagado_id_contrato_fkey FOREIGN KEY (id_contrato) REFERENCES contrato(id_contrato);


--
-- TOC entry 3417 (class 2606 OID 268042)
-- Name: conv_con_id_conv_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY conv_con
    ADD CONSTRAINT conv_con_id_conv_fkey FOREIGN KEY (id_conv) REFERENCES convenio_pago(id_conv);


--
-- TOC entry 3420 (class 2606 OID 268047)
-- Name: detalle_tipopago_id_pago_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY detalle_tipopago
    ADD CONSTRAINT detalle_tipopago_id_pago_fkey FOREIGN KEY (id_pago) REFERENCES pagos(id_pago);


--
-- TOC entry 3423 (class 2606 OID 268052)
-- Name: entidad_id_persona_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY entidad
    ADD CONSTRAINT entidad_id_persona_fkey FOREIGN KEY (id_persona) REFERENCES persona(id_persona);


--
-- TOC entry 3424 (class 2606 OID 268057)
-- Name: entidad_id_te_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY entidad
    ADD CONSTRAINT entidad_id_te_fkey FOREIGN KEY (id_te) REFERENCES tipo_entidad(id_te);


--
-- TOC entry 3388 (class 2606 OID 268062)
-- Name: fk_alarma_p_reference_perfil; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY alarma_perfil
    ADD CONSTRAINT fk_alarma_p_reference_perfil FOREIGN KEY (codigoperfil) REFERENCES perfil(codigoperfil) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3389 (class 2606 OID 268067)
-- Name: fk_alarma_p_reference_tipo_ala; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY alarma_perfil
    ADD CONSTRAINT fk_alarma_p_reference_tipo_ala FOREIGN KEY (id_tipo_alarma) REFERENCES tipo_alarma(id_tipo_alarma) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3390 (class 2606 OID 268072)
-- Name: fk_alarmas_reference_tipo_ala; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY alarmas
    ADD CONSTRAINT fk_alarmas_reference_tipo_ala FOREIGN KEY (id_tipo_alarma) REFERENCES tipo_alarma(id_tipo_alarma) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3391 (class 2606 OID 268077)
-- Name: fk_auditori_reference_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY auditoria
    ADD CONSTRAINT fk_auditori_reference_usuario FOREIGN KEY (login) REFERENCES usuario(login) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3460 (class 2606 OID 268082)
-- Name: fk_auditori_reference_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notas
    ADD CONSTRAINT fk_auditori_reference_usuario FOREIGN KEY (login) REFERENCES usuario(login) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3393 (class 2606 OID 268087)
-- Name: fk_caja_cob_reference_caja; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY caja_cobrador
    ADD CONSTRAINT fk_caja_cob_reference_caja FOREIGN KEY (id_caja) REFERENCES caja(id_caja) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3394 (class 2606 OID 268092)
-- Name: fk_caja_cob_reference_cobrador; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY caja_cobrador
    ADD CONSTRAINT fk_caja_cob_reference_cobrador FOREIGN KEY (id_persona) REFERENCES cobrador(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3395 (class 2606 OID 268097)
-- Name: fk_calle_relations_sector; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY calle
    ADD CONSTRAINT fk_calle_relations_sector FOREIGN KEY (id_sector) REFERENCES sector(id_sector) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3396 (class 2606 OID 268102)
-- Name: fk_cierre_p_reference_caja_cob; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cierre_pago
    ADD CONSTRAINT fk_cierre_p_reference_caja_cob FOREIGN KEY (id_caja_cob) REFERENCES caja_cobrador(id_caja_cob) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3397 (class 2606 OID 268107)
-- Name: fk_cierre_p_relations_cirre_di; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cierre_pago
    ADD CONSTRAINT fk_cierre_p_relations_cirre_di FOREIGN KEY (id_cierre) REFERENCES cirre_diario(id_cierre) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3398 (class 2606 OID 268112)
-- Name: fk_cierre_p_rsdfedflations_cirre_di; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cierre_pago_et
    ADD CONSTRAINT fk_cierre_p_rsdfedflations_cirre_di FOREIGN KEY (id_cierre) REFERENCES cirre_diario_et(id_cierre) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3399 (class 2606 OID 268117)
-- Name: fk_cierre_psd_rdeference_caja_cob; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cierre_pago_et
    ADD CONSTRAINT fk_cierre_psd_rdeference_caja_cob FOREIGN KEY (id_caja_cob) REFERENCES caja_cobrador(id_caja_cob) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3400 (class 2606 OID 268122)
-- Name: fk_ciudad_reference_municipi; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ciudad
    ADD CONSTRAINT fk_ciudad_reference_municipi FOREIGN KEY (id_mun) REFERENCES municipio(id_mun) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3418 (class 2606 OID 268127)
-- Name: fk_cliente_inheridvtan_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY conyuge
    ADD CONSTRAINT fk_cliente_inheridvtan_persona FOREIGN KEY (id_persona_cliente) REFERENCES cliente(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3401 (class 2606 OID 268132)
-- Name: fk_cliente_inheritan_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cliente
    ADD CONSTRAINT fk_cliente_inheritan_persona FOREIGN KEY (id_persona) REFERENCES persona(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3402 (class 2606 OID 268137)
-- Name: fk_cobrador_inheritan_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cobrador
    ADD CONSTRAINT fk_cobrador_inheritan_persona FOREIGN KEY (id_persona) REFERENCES persona(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3403 (class 2606 OID 268142)
-- Name: fk_comandos_reference_franquic; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comandos_sms
    ADD CONSTRAINT fk_comandos_reference_franquic FOREIGN KEY (id_franq) REFERENCES franquicia(id_franq) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3404 (class 2606 OID 268147)
-- Name: fk_comentar_reference_cliente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comentario_cliente
    ADD CONSTRAINT fk_comentar_reference_cliente FOREIGN KEY (id_persona) REFERENCES cliente(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3406 (class 2606 OID 268152)
-- Name: fk_config_s_reference_franquic; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY config_sms
    ADD CONSTRAINT fk_config_s_reference_franquic FOREIGN KEY (id_franq) REFERENCES franquicia(id_franq) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3405 (class 2606 OID 268157)
-- Name: fk_config_s_reference_franquic; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY config_mat
    ADD CONSTRAINT fk_config_s_reference_franquic FOREIGN KEY (id_franq) REFERENCES franquicia(id_franq) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3408 (class 2606 OID 268162)
-- Name: fk_contrato_relations_calle; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contrato
    ADD CONSTRAINT fk_contrato_relations_calle FOREIGN KEY (id_calle) REFERENCES calle(id_calle) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3409 (class 2606 OID 268167)
-- Name: fk_contrato_relations_cliente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contrato
    ADD CONSTRAINT fk_contrato_relations_cliente FOREIGN KEY (cli_id_persona) REFERENCES cliente(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3412 (class 2606 OID 268172)
-- Name: fk_contrato_relations_servicio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contrato_servicio
    ADD CONSTRAINT fk_contrato_relations_servicio FOREIGN KEY (id_serv) REFERENCES servicios(id_serv) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3414 (class 2606 OID 268177)
-- Name: fk_contrato_relations_servicio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contrato_servicio_deuda
    ADD CONSTRAINT fk_contrato_relations_servicio FOREIGN KEY (id_serv) REFERENCES servicios(id_serv) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3416 (class 2606 OID 268182)
-- Name: fk_contrato_relations_servicio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contrato_servicio_pagado
    ADD CONSTRAINT fk_contrato_relations_servicio FOREIGN KEY (id_serv) REFERENCES servicios(id_serv) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3410 (class 2606 OID 268187)
-- Name: fk_contrato_relations_vendedor; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY contrato
    ADD CONSTRAINT fk_contrato_relations_vendedor FOREIGN KEY (id_persona) REFERENCES vendedor(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3419 (class 2606 OID 268192)
-- Name: fk_detalle__reference_tipo_ord; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY detalle_orden
    ADD CONSTRAINT fk_detalle__reference_tipo_ord FOREIGN KEY (id_tipo_orden) REFERENCES tipo_orden(id_tipo_orden) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3421 (class 2606 OID 268197)
-- Name: fk_detalle__relations_tipo_pag; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY detalle_tipopago
    ADD CONSTRAINT fk_detalle__relations_tipo_pag FOREIGN KEY (id_tipo_pago) REFERENCES tipo_pago(id_tipo_pago) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3422 (class 2606 OID 268202)
-- Name: fk_edificio_reference_calle; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY edificio
    ADD CONSTRAINT fk_edificio_reference_calle FOREIGN KEY (id_sector) REFERENCES sector(id_sector) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3425 (class 2606 OID 268207)
-- Name: fk_envio_au_reference_franquic; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY envio_aut
    ADD CONSTRAINT fk_envio_au_reference_franquic FOREIGN KEY (id_franq) REFERENCES franquicia(id_franq) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3426 (class 2606 OID 268212)
-- Name: fk_estacion_reference_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estacion_trabajo
    ADD CONSTRAINT fk_estacion_reference_usuario FOREIGN KEY (login) REFERENCES usuario(login) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3427 (class 2606 OID 268217)
-- Name: fk_estado_reference_pais; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estado
    ADD CONSTRAINT fk_estado_reference_pais FOREIGN KEY (id_franq) REFERENCES franquicia(id_franq) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3428 (class 2606 OID 268222)
-- Name: fk_formato__reference_franquic; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY formato_sms
    ADD CONSTRAINT fk_formato__reference_franquic FOREIGN KEY (id_franq) REFERENCES franquicia(id_franq) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3429 (class 2606 OID 268227)
-- Name: fk_gerentes_reference_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY gerentes_permitidos
    ADD CONSTRAINT fk_gerentes_reference_persona FOREIGN KEY (id_persona) REFERENCES persona(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3430 (class 2606 OID 268232)
-- Name: fk_grupo_te_reference_grupo_tr; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY grupo_tecnico
    ADD CONSTRAINT fk_grupo_te_reference_grupo_tr FOREIGN KEY (id_gt) REFERENCES grupo_trabajo(id_gt) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3431 (class 2606 OID 268237)
-- Name: fk_grupo_te_reference_tecnico; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY grupo_tecnico
    ADD CONSTRAINT fk_grupo_te_reference_tecnico FOREIGN KEY (id_persona) REFERENCES tecnico(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3432 (class 2606 OID 268242)
-- Name: fk_grupo_ub_reference_grupo_tr; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY grupo_ubicacion
    ADD CONSTRAINT fk_grupo_ub_reference_grupo_tr FOREIGN KEY (id_gt) REFERENCES grupo_trabajo(id_gt) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3433 (class 2606 OID 268247)
-- Name: fk_grupo_ub_reference_sector; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY grupo_ubicacion
    ADD CONSTRAINT fk_grupo_ub_reference_sector FOREIGN KEY (id_sector) REFERENCES sector(id_sector) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3435 (class 2606 OID 268252)
-- Name: fk_inventar_reference_inventar; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario_materiales
    ADD CONSTRAINT fk_inventar_reference_inventar FOREIGN KEY (id_inv) REFERENCES inventario(id_inv) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3436 (class 2606 OID 268257)
-- Name: fk_inventar_reference_material; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario_materiales
    ADD CONSTRAINT fk_inventar_reference_material FOREIGN KEY (id_mat) REFERENCES materiales(id_mat) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3434 (class 2606 OID 268262)
-- Name: fk_inventar_reference_motivo_i; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT fk_inventar_reference_motivo_i FOREIGN KEY (id_motivo) REFERENCES motivo_inv(id_motivo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3440 (class 2606 OID 268267)
-- Name: fk_mat_ped_reference_material; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mat_ped
    ADD CONSTRAINT fk_mat_ped_reference_material FOREIGN KEY (id_mat) REFERENCES materiales(id_mat) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3441 (class 2606 OID 268272)
-- Name: fk_mat_ped_reference_pedido; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mat_ped
    ADD CONSTRAINT fk_mat_ped_reference_pedido FOREIGN KEY (id_ped) REFERENCES pedido(id_ped) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3442 (class 2606 OID 268277)
-- Name: fk_mat_prov_reference_material; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mat_prov
    ADD CONSTRAINT fk_mat_prov_reference_material FOREIGN KEY (id_mat) REFERENCES materiales(id_mat) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3443 (class 2606 OID 268282)
-- Name: fk_mat_prov_reference_proveedo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mat_prov
    ADD CONSTRAINT fk_mat_prov_reference_proveedo FOREIGN KEY (id_prov) REFERENCES proveedor(id_prov) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3444 (class 2606 OID 268287)
-- Name: fk_material_reference_deposito; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY materiales
    ADD CONSTRAINT fk_material_reference_deposito FOREIGN KEY (id_dep) REFERENCES deposito(id_dep) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3446 (class 2606 OID 268292)
-- Name: fk_mensuali_reference_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mensualidad
    ADD CONSTRAINT fk_mensuali_reference_usuario FOREIGN KEY (login) REFERENCES usuario(login) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3447 (class 2606 OID 268297)
-- Name: fk_modulo_p_relations_modulo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY modulo_perfil
    ADD CONSTRAINT fk_modulo_p_relations_modulo FOREIGN KEY (codigomodulo) REFERENCES modulo(codigomodulo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3448 (class 2606 OID 268302)
-- Name: fk_modulo_p_relations_perfil; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY modulo_perfil
    ADD CONSTRAINT fk_modulo_p_relations_perfil FOREIGN KEY (codigoperfil) REFERENCES perfil(codigoperfil) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3451 (class 2606 OID 268307)
-- Name: fk_mov_mat_orden_reference_material; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mov_mat_orden
    ADD CONSTRAINT fk_mov_mat_orden_reference_material FOREIGN KEY (id_mat) REFERENCES materiales(id_mat) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3449 (class 2606 OID 268312)
-- Name: fk_mov_mat_reference_material; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mov_mat
    ADD CONSTRAINT fk_mov_mat_reference_material FOREIGN KEY (id_mat) REFERENCES materiales(id_mat) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3450 (class 2606 OID 268317)
-- Name: fk_mov_mat_reference_movimien; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mov_mat
    ADD CONSTRAINT fk_mov_mat_reference_movimien FOREIGN KEY (id_mov) REFERENCES movimiento(id_mov) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3453 (class 2606 OID 268322)
-- Name: fk_movimien_reference_tipo_mov; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento
    ADD CONSTRAINT fk_movimien_reference_tipo_mov FOREIGN KEY (id_tm) REFERENCES tipo_movimiento(id_tm) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3456 (class 2606 OID 268327)
-- Name: fk_movimien_reference_tipo_mov; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento_orden
    ADD CONSTRAINT fk_movimien_reference_tipo_mov FOREIGN KEY (id_tm) REFERENCES tipo_movimiento(id_tm) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3459 (class 2606 OID 268332)
-- Name: fk_municipi_reference_estado; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT fk_municipi_reference_estado FOREIGN KEY (id_esta) REFERENCES estado(id_esta) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3463 (class 2606 OID 268337)
-- Name: fk_orden_gr_reference_grupo_tr; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY orden_grupo
    ADD CONSTRAINT fk_orden_gr_reference_grupo_tr FOREIGN KEY (id_gt) REFERENCES grupo_trabajo(id_gt) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3464 (class 2606 OID 268342)
-- Name: fk_orden_gr_reference_ordenes_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY orden_grupo
    ADD CONSTRAINT fk_orden_gr_reference_ordenes_ FOREIGN KEY (id_orden) REFERENCES ordenes_tecnicos(id_orden) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3465 (class 2606 OID 268347)
-- Name: fk_ordenes__reference_detalle_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ordenes_tecnicos
    ADD CONSTRAINT fk_ordenes__reference_detalle_ FOREIGN KEY (id_det_orden) REFERENCES detalle_orden(id_det_orden) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3466 (class 2606 OID 268352)
-- Name: fk_ordenes__relations_contrato; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ordenes_tecnicos
    ADD CONSTRAINT fk_ordenes__relations_contrato FOREIGN KEY (id_contrato) REFERENCES contrato(id_contrato) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3467 (class 2606 OID 268357)
-- Name: fk_pago_com_reference_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pago_comisiones
    ADD CONSTRAINT fk_pago_com_reference_persona FOREIGN KEY (id_persona) REFERENCES persona(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3470 (class 2606 OID 268362)
-- Name: fk_pagos_reference_caja_cob; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pagos
    ADD CONSTRAINT fk_pagos_reference_caja_cob FOREIGN KEY (id_caja_cob) REFERENCES caja_cobrador(id_caja_cob) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3473 (class 2606 OID 268367)
-- Name: fk_parametr_relations_franquic; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parametros
    ADD CONSTRAINT fk_parametr_relations_franquic FOREIGN KEY (id_franq) REFERENCES franquicia(id_franq) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3474 (class 2606 OID 268372)
-- Name: fk_pedido_reference_proveedo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pedido
    ADD CONSTRAINT fk_pedido_reference_proveedo FOREIGN KEY (id_prov) REFERENCES proveedor(id_prov) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3477 (class 2606 OID 268377)
-- Name: fk_precinto_reference_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY precintos
    ADD CONSTRAINT fk_precinto_reference_usuario FOREIGN KEY (login) REFERENCES usuario(login) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3479 (class 2606 OID 268382)
-- Name: fk_reclamo__reference_cliente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reclamo_denuncia
    ADD CONSTRAINT fk_reclamo__reference_cliente FOREIGN KEY (id_persona) REFERENCES cliente(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3387 (class 2606 OID 268387)
-- Name: fk_reference_122; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY abo_cortados
    ADD CONSTRAINT fk_reference_122 FOREIGN KEY (id_proc) REFERENCES proceso_corte(id_proc) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3481 (class 2606 OID 268392)
-- Name: fk_sector_relations_zona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sector
    ADD CONSTRAINT fk_sector_relations_zona FOREIGN KEY (id_zona) REFERENCES zona(id_zona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3482 (class 2606 OID 268397)
-- Name: fk_servicio_relations_tipo_ser; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY servicios
    ADD CONSTRAINT fk_servicio_relations_tipo_ser FOREIGN KEY (id_tipo_servicio) REFERENCES tipo_servicio(id_tipo_servicio) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3484 (class 2606 OID 268402)
-- Name: fk_tarifa_s_relations_servicio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tarifa_servicio
    ADD CONSTRAINT fk_tarifa_s_relations_servicio FOREIGN KEY (id_serv) REFERENCES servicios(id_serv) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3485 (class 2606 OID 268407)
-- Name: fk_tecnico_inheritan_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tecnico
    ADD CONSTRAINT fk_tecnico_inheritan_persona FOREIGN KEY (id_persona) REFERENCES persona(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3486 (class 2606 OID 268412)
-- Name: fk_tipo_ser_reference_franquic; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_servicio
    ADD CONSTRAINT fk_tipo_ser_reference_franquic FOREIGN KEY (id_franq) REFERENCES franquicia(id_franq) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3487 (class 2606 OID 268417)
-- Name: fk_urbanizacion_reference_urbanizacion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY urbanizacion
    ADD CONSTRAINT fk_urbanizacion_reference_urbanizacion FOREIGN KEY (id_sector) REFERENCES sector(id_sector) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3475 (class 2606 OID 268422)
-- Name: fk_usuario_relations_perfil; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_usuario_relations_perfil FOREIGN KEY (codigoperfil) REFERENCES perfil(codigoperfil) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3476 (class 2606 OID 268427)
-- Name: fk_usuario_relations_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_usuario_relations_persona FOREIGN KEY (id_persona) REFERENCES persona(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3489 (class 2606 OID 268432)
-- Name: fk_vendedor_inheritan_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY vendedor
    ADD CONSTRAINT fk_vendedor_inheritan_persona FOREIGN KEY (id_persona) REFERENCES persona(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3490 (class 2606 OID 268437)
-- Name: fk_visitas_reference_ordenes_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY visitas
    ADD CONSTRAINT fk_visitas_reference_ordenes_ FOREIGN KEY (id_orden) REFERENCES ordenes_tecnicos(id_orden) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 3437 (class 2606 OID 268442)
-- Name: mat_padre_id_fam_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mat_padre
    ADD CONSTRAINT mat_padre_id_fam_fkey FOREIGN KEY (id_fam) REFERENCES familia(id_fam);


--
-- TOC entry 3438 (class 2606 OID 268447)
-- Name: mat_padre_id_unidad_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mat_padre
    ADD CONSTRAINT mat_padre_id_unidad_fkey FOREIGN KEY (id_unidad) REFERENCES unidad_medida(id_unidad);


--
-- TOC entry 3439 (class 2606 OID 268452)
-- Name: mat_padre_uni_id_unidad_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mat_padre
    ADD CONSTRAINT mat_padre_uni_id_unidad_fkey FOREIGN KEY (uni_id_unidad) REFERENCES unidad_medida(id_unidad);


--
-- TOC entry 3445 (class 2606 OID 268457)
-- Name: materiales_id_m_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY materiales
    ADD CONSTRAINT materiales_id_m_fkey FOREIGN KEY (id_m) REFERENCES mat_padre(id_m);


--
-- TOC entry 3452 (class 2606 OID 268462)
-- Name: mov_mat_orden_id_mov_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mov_mat_orden
    ADD CONSTRAINT mov_mat_orden_id_mov_fkey FOREIGN KEY (id_mov) REFERENCES movimiento_orden(id_mov);


--
-- TOC entry 3454 (class 2606 OID 268467)
-- Name: movimiento_id_persona_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento
    ADD CONSTRAINT movimiento_id_persona_fkey FOREIGN KEY (id_persona) REFERENCES entidad(id_persona);


--
-- TOC entry 3457 (class 2606 OID 268472)
-- Name: movimiento_id_persona_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento_orden
    ADD CONSTRAINT movimiento_id_persona_fkey FOREIGN KEY (id_persona) REFERENCES entidad(id_persona);


--
-- TOC entry 3455 (class 2606 OID 268477)
-- Name: movimiento_login_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento
    ADD CONSTRAINT movimiento_login_fkey FOREIGN KEY (login) REFERENCES usuario(login);


--
-- TOC entry 3458 (class 2606 OID 268482)
-- Name: movimiento_login_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento_orden
    ADD CONSTRAINT movimiento_login_fkey FOREIGN KEY (login) REFERENCES usuario(login);


--
-- TOC entry 3461 (class 2606 OID 268487)
-- Name: notas_id_contrato_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notas
    ADD CONSTRAINT notas_id_contrato_fkey FOREIGN KEY (id_contrato) REFERENCES contrato(id_contrato);


--
-- TOC entry 3462 (class 2606 OID 268492)
-- Name: notas_idmotivonota_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY notas
    ADD CONSTRAINT notas_idmotivonota_fkey FOREIGN KEY (idmotivonota) REFERENCES motivonotas(idmotivonota);


--
-- TOC entry 3468 (class 2606 OID 268497)
-- Name: pago_servicio_id_cont_serv_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pago_servicio
    ADD CONSTRAINT pago_servicio_id_cont_serv_fkey FOREIGN KEY (id_cont_serv) REFERENCES contrato_servicio_pagado(id_cont_serv);


--
-- TOC entry 3469 (class 2606 OID 268502)
-- Name: pago_servicio_id_pago_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pago_servicio
    ADD CONSTRAINT pago_servicio_id_pago_fkey FOREIGN KEY (id_pago) REFERENCES pagos(id_pago);


--
-- TOC entry 3472 (class 2606 OID 268507)
-- Name: pagos_id_condtrato_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pagos_his
    ADD CONSTRAINT pagos_id_condtrato_fkey FOREIGN KEY (id_contrato) REFERENCES contrato(id_contrato);


--
-- TOC entry 3471 (class 2606 OID 268512)
-- Name: pagos_id_contrato_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pagos
    ADD CONSTRAINT pagos_id_contrato_fkey FOREIGN KEY (id_contrato) REFERENCES contrato(id_contrato);


--
-- TOC entry 3478 (class 2606 OID 268517)
-- Name: recibos_id_asig_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY recibos
    ADD CONSTRAINT recibos_id_asig_fkey FOREIGN KEY (id_asig) REFERENCES asigna_recibo(id_asig);


--
-- TOC entry 3480 (class 2606 OID 268522)
-- Name: recuperado_id_contrato_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY recuperado
    ADD CONSTRAINT recuperado_id_contrato_fkey FOREIGN KEY (id_contrato) REFERENCES contrato(id_contrato);


--
-- TOC entry 3483 (class 2606 OID 268527)
-- Name: sms_login_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sms
    ADD CONSTRAINT sms_login_fkey FOREIGN KEY (login) REFERENCES usuario(login);


--
-- TOC entry 3488 (class 2606 OID 268532)
-- Name: variables_sms_id_franq_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY variables_sms
    ADD CONSTRAINT variables_sms_id_franq_fkey FOREIGN KEY (id_franq) REFERENCES franquicia(id_franq);


--
-- TOC entry 3491 (class 2606 OID 268537)
-- Name: zona_id_ciudad_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY zona
    ADD CONSTRAINT zona_id_ciudad_fkey FOREIGN KEY (id_ciudad) REFERENCES ciudad(id_ciudad);

