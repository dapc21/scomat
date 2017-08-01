DROP view  if exists vista_materiales;
DROP TABLE  if exists ent_sal_mat;

DROP TABLE  if exists mov_mat;
DROP TABLE  if exists mat_ped;
DROP TABLE  if exists mat_prov;
DROP TABLE  if exists inventario_materiales;
DROP TABLE  if exists pedido;
DROP TABLE  if exists proveedor;
DROP TABLE  if exists inventario;
DROP TABLE  if exists motivo_inv;
DROP TABLE  if exists materiales;
DROP TABLE  if exists deposito;
DROP TABLE  if exists mat_padre;
DROP TABLE  if exists familia;
DROP TABLE  if exists unidad_medida;
DROP TABLE  if exists movimiento;
DROP TABLE  if exists tipo_movimiento;




/*-------------------------------------------------------------------*/

CREATE TABLE deposito (
    id_dep character(8) NOT NULL,
    nombre_dep character(50),
    descrip_dep character(200),
    status_dep character(10),
    id_gt character(8),
    id_persona_enc character(10)
);


ALTER TABLE public.deposito OWNER TO postgres;

--
-- TOC entry 144 (class 1259 OID 86599)
-- Dependencies: 6
-- Name: familia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE familia (
    id_fam character(5) NOT NULL,
    nombre_fam character(50),
    status_fam character(15)
);


ALTER TABLE public.familia OWNER TO postgres;

--
-- TOC entry 2034 (class 0 OID 0)
-- Dependencies: 144
-- Name: TABLE familia; Type: COMMENT; Schema: public; Owner: postgres
--


--
-- TOC entry 147 (class 1259 OID 86608)
-- Dependencies: 6
-- Name: inventario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE inventario (
    id_inv character(8) NOT NULL,
    id_motivo character(5),
    fecha_inv date,
    hora_inv time without time zone,
    obser_inv character varying(1000),
    tipo_inv character(15),
    id_dep character(8),
    id_fam character(5),
    status_inv character(20)
);


ALTER TABLE public.inventario OWNER TO postgres;

--
-- TOC entry 148 (class 1259 OID 86614)
-- Dependencies: 6
-- Name: inventario_materiales; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE inventario_materiales (
    id_mat character(10) NOT NULL,
    id_inv character(8) NOT NULL,
    cant_sist bigint,
    cant_real bigint,
    justi_inv character varying(200)
);


ALTER TABLE public.inventario_materiales OWNER TO postgres;

--
-- TOC entry 149 (class 1259 OID 86617)
-- Dependencies: 6
-- Name: mat_padre; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE mat_padre (
    id_m character(10) NOT NULL,
    id_unidad character(8),
    id_fam character(5),
    numero_mat bigint,
    nombre_mat character(50),
    precio_u_p numeric(10,2),
    c_uni_ent integer,
    c_uni_sal integer,
    uni_id_unidad character(8)
);


ALTER TABLE public.mat_padre OWNER TO postgres;

--
-- TOC entry 150 (class 1259 OID 86620)
-- Dependencies: 6
-- Name: mat_ped; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE mat_ped (
    id_mat character(10) NOT NULL,
    id_ped character(8) NOT NULL,
    cant_ped integer,
    cant_ent integer,
    precio numeric(10,2)
);


ALTER TABLE public.mat_ped OWNER TO postgres;

--
-- TOC entry 151 (class 1259 OID 86623)
-- Dependencies: 6
-- Name: mat_prov; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE mat_prov (
    id_mat character(10) NOT NULL,
    id_prov character(8) NOT NULL
);


ALTER TABLE public.mat_prov OWNER TO postgres;

--
-- TOC entry 152 (class 1259 OID 86626)
-- Dependencies: 6
-- Name: materiales; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE materiales (
    id_mat character(10) NOT NULL,
    id_dep character(8),
    stock bigint,
    stock_min integer,
    observacion character(200),
    id_m character(10)
);


ALTER TABLE public.materiales OWNER TO postgres;

--
-- TOC entry 154 (class 1259 OID 86644)
-- Dependencies: 6
-- Name: motivo_inv; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE motivo_inv (
    id_motivo character(5) NOT NULL,
    nombre_motivo character(30),
    status_motivo character(15)
);


ALTER TABLE public.motivo_inv OWNER TO postgres;

--
-- TOC entry 155 (class 1259 OID 86647)
-- Dependencies: 6
-- Name: mov_mat; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE mov_mat (
    id_mat character(10) NOT NULL,
    id_mov character(10) NOT NULL,
    cant_mov integer
);


ALTER TABLE public.mov_mat OWNER TO postgres;

--
-- TOC entry 156 (class 1259 OID 86650)
-- Dependencies: 6
-- Name: movimiento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE movimiento (
    id_mov character(10) NOT NULL,
    id_tm character(8),
    fecha_ent_sal date,
    hora_ent_sal time without time zone,
    observacion character(200),
    referencia character(15),
    tipo_mov character(20)
);


ALTER TABLE public.movimiento OWNER TO postgres;

--
-- TOC entry 159 (class 1259 OID 86662)
-- Dependencies: 6
-- Name: pedido; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pedido (
    id_ped character(8) NOT NULL,
    id_prov character(8),
    fecha_ped date,
    fecha_ent date,
    status_ped character(20),
    obser_ped text,
    nro_fact_ped character(10),
    porc_desc numeric(10,2),
    desc_ped numeric(10,2),
    base_ped numeric(10,2),
    iva_ped numeric(10,2),
    total_ped numeric(10,2)
);


ALTER TABLE public.pedido OWNER TO postgres;

--
-- TOC entry 164 (class 1259 OID 86693)
-- Dependencies: 6
-- Name: proveedor; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE proveedor (
    id_prov character(8) NOT NULL,
    rif_prov character(15),
    nombre_prov character(50),
    direccion_prov character(200),
    telefonos_prov character(50),
    fax_prov character(20),
    web_prov character(30),
    email_prov character(40),
    obser_prov text,
    forma_pago character(20),
    banco character(50),
    cuenta character(25),
    status_prov character(10),
    contacto character(50)
);


ALTER TABLE public.proveedor OWNER TO postgres;

--
-- TOC entry 166 (class 1259 OID 86702)
-- Dependencies: 6
-- Name: tipo_movimiento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipo_movimiento (
    id_tm character(8) NOT NULL,
    nombre_tm character(50),
    tipo_ent_sal character(10),
    uso_tm character(15),
    status_tm character(10)
);


ALTER TABLE public.tipo_movimiento OWNER TO postgres;

--
-- TOC entry 167 (class 1259 OID 86705)
-- Dependencies: 6
-- Name: unidad_medida; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE unidad_medida (
    id_unidad character(8) NOT NULL,
    nombre_unidad character(30),
    abreviatura character(10),
    status_unidad character(10)
);


ALTER TABLE public.unidad_medida OWNER TO postgres;

--
-- TOC entry 2017 (class 0 OID 86596)
-- Dependencies: 143
-- Data for Name: deposito; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO deposito (id_dep, nombre_dep, descrip_dep, status_dep, id_gt, id_persona_enc) VALUES ('A0000001', 'DEPOSITO PRINCIPAL                                ', 'DEPOSITO INTERNO PRINCIPAL                                                                                                                                                                              ', 'INTERNO   ', NULL, NULL);


--
-- TOC entry 2018 (class 0 OID 86599)
-- Dependencies: 144
-- Data for Name: familia; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2019 (class 0 OID 86608)
-- Dependencies: 147
-- Data for Name: inventario; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2020 (class 0 OID 86614)
-- Dependencies: 148
-- Data for Name: inventario_materiales; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2021 (class 0 OID 86617)
-- Dependencies: 149
-- Data for Name: mat_padre; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2022 (class 0 OID 86620)
-- Dependencies: 150
-- Data for Name: mat_ped; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2023 (class 0 OID 86623)
-- Dependencies: 151
-- Data for Name: mat_prov; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2024 (class 0 OID 86626)
-- Dependencies: 152
-- Data for Name: materiales; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2025 (class 0 OID 86644)
-- Dependencies: 154
-- Data for Name: motivo_inv; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2026 (class 0 OID 86647)
-- Dependencies: 155
-- Data for Name: mov_mat; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2027 (class 0 OID 86650)
-- Dependencies: 156
-- Data for Name: movimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2028 (class 0 OID 86662)
-- Dependencies: 159
-- Data for Name: pedido; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2029 (class 0 OID 86693)
-- Dependencies: 164
-- Data for Name: proveedor; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2030 (class 0 OID 86702)
-- Dependencies: 166
-- Data for Name: tipo_movimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipo_movimiento (id_tm, nombre_tm, tipo_ent_sal, uso_tm, status_tm) VALUES ('A0000001', 'COMPRA MOVIENTO                                   ', 'ENTRADA   ', 'COMPRA INTERNA ', 'INTERNO   ');
INSERT INTO tipo_movimiento (id_tm, nombre_tm, tipo_ent_sal, uso_tm, status_tm) VALUES ('A0000002', 'SALIDA DE ORDEN INTERNO                           ', 'SALIDA    ', 'SALIDA INTERNA ', 'INTERNO   ');
INSERT INTO tipo_movimiento (id_tm, nombre_tm, tipo_ent_sal, uso_tm, status_tm) VALUES ('A0000003', 'INVENTARIO AUMENTO                                ', 'ENTRADA   ', 'AUMENTO STOCK  ', 'INTERNO   ');
INSERT INTO tipo_movimiento (id_tm, nombre_tm, tipo_ent_sal, uso_tm, status_tm) VALUES ('A0000004', 'INVENTARIO DESCUENTO                              ', 'SALIDA    ', 'DESCUENTO STOCK', 'INTERNO   ');
INSERT INTO tipo_movimiento (id_tm, nombre_tm, tipo_ent_sal, uso_tm, status_tm) VALUES ('A0000006', 'TRANSFERENCIA                                     ', 'ENTRADA   ', 'AUMENTO TD     ', 'INTERNO   ');
INSERT INTO tipo_movimiento (id_tm, nombre_tm, tipo_ent_sal, uso_tm, status_tm) VALUES ('A0000005', 'TRANSFERENCIA                                     ', 'SALIDA    ', 'DESCUENTO TD   ', 'INTERNO   ');


--
-- TOC entry 2031 (class 0 OID 86705)
-- Dependencies: 167
-- Data for Name: unidad_medida; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 1956 (class 2606 OID 86796)
-- Dependencies: 149 149
-- Name: mat_padre_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mat_padre
    ADD CONSTRAINT mat_padre_pkey PRIMARY KEY (id_m);


--
-- TOC entry 1942 (class 2606 OID 86806)
-- Dependencies: 143 143
-- Name: pk_deposito; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY deposito
    ADD CONSTRAINT pk_deposito PRIMARY KEY (id_dep);


--
-- TOC entry 1945 (class 2606 OID 86808)
-- Dependencies: 144 144
-- Name: pk_familia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY familia
    ADD CONSTRAINT pk_familia PRIMARY KEY (id_fam);


--
-- TOC entry 1949 (class 2606 OID 86812)
-- Dependencies: 147 147
-- Name: pk_inventario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT pk_inventario PRIMARY KEY (id_inv);


--
-- TOC entry 1954 (class 2606 OID 86814)
-- Dependencies: 148 148 148
-- Name: pk_inventario_materiales; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY inventario_materiales
    ADD CONSTRAINT pk_inventario_materiales PRIMARY KEY (id_mat, id_inv);


--
-- TOC entry 1965 (class 2606 OID 86816)
-- Dependencies: 150 150 150
-- Name: pk_mat_ped; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mat_ped
    ADD CONSTRAINT pk_mat_ped PRIMARY KEY (id_mat, id_ped);


--
-- TOC entry 1970 (class 2606 OID 86818)
-- Dependencies: 151 151 151
-- Name: pk_mat_prov; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mat_prov
    ADD CONSTRAINT pk_mat_prov PRIMARY KEY (id_mat, id_prov);


--
-- TOC entry 1975 (class 2606 OID 86820)
-- Dependencies: 152 152
-- Name: pk_materiales; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY materiales
    ADD CONSTRAINT pk_materiales PRIMARY KEY (id_mat);


--
-- TOC entry 1978 (class 2606 OID 86824)
-- Dependencies: 154 154
-- Name: pk_motivo_inv; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY motivo_inv
    ADD CONSTRAINT pk_motivo_inv PRIMARY KEY (id_motivo);


--
-- TOC entry 1983 (class 2606 OID 86826)
-- Dependencies: 155 155 155
-- Name: pk_mov_mat; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY mov_mat
    ADD CONSTRAINT pk_mov_mat PRIMARY KEY (id_mat, id_mov);


--
-- TOC entry 1987 (class 2606 OID 86828)
-- Dependencies: 156 156
-- Name: pk_movimiento; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY movimiento
    ADD CONSTRAINT pk_movimiento PRIMARY KEY (id_mov);


--
-- TOC entry 1991 (class 2606 OID 86832)
-- Dependencies: 159 159
-- Name: pk_pedido; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pedido
    ADD CONSTRAINT pk_pedido PRIMARY KEY (id_ped);


--
-- TOC entry 1993 (class 2606 OID 86836)
-- Dependencies: 164 164
-- Name: pk_proveedor; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY proveedor
    ADD CONSTRAINT pk_proveedor PRIMARY KEY (id_prov);


--
-- TOC entry 1996 (class 2606 OID 86840)
-- Dependencies: 166 166
-- Name: pk_tipo_movimiento; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_movimiento
    ADD CONSTRAINT pk_tipo_movimiento PRIMARY KEY (id_tm);


--
-- TOC entry 1999 (class 2606 OID 86842)
-- Dependencies: 167 167
-- Name: pk_unidad_medida; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY unidad_medida
    ADD CONSTRAINT pk_unidad_medida PRIMARY KEY (id_unidad);


--
-- TOC entry 1943 (class 1259 OID 86846)
-- Dependencies: 144
-- Name: familia_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX familia_pk_1 ON familia USING btree (id_fam);


--
-- TOC entry 1971 (class 1259 OID 86851)
-- Dependencies: 152
-- Name: id_depd_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX id_depd_pk_1 ON materiales USING btree (id_dep);


--
-- TOC entry 1961 (class 1259 OID 86852)
-- Dependencies: 150
-- Name: id_mat_pk_2; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX id_mat_pk_2 ON mat_ped USING btree (id_mat);


--
-- TOC entry 1962 (class 1259 OID 86853)
-- Dependencies: 150
-- Name: id_mat_pk_3; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX id_mat_pk_3 ON mat_ped USING btree (id_ped);


--
-- TOC entry 1940 (class 1259 OID 86854)
-- Dependencies: 143
-- Name: index_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX index_pk_1 ON deposito USING btree (id_dep);


--
-- TOC entry 1950 (class 1259 OID 86855)
-- Dependencies: 148 148
-- Name: inventario_materiales_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX inventario_materiales_pk_1 ON inventario_materiales USING btree (id_mat, id_inv);


--
-- TOC entry 1951 (class 1259 OID 86856)
-- Dependencies: 148
-- Name: inventario_materiales_pk_2; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX inventario_materiales_pk_2 ON inventario_materiales USING btree (id_mat);


--
-- TOC entry 1952 (class 1259 OID 86857)
-- Dependencies: 148
-- Name: inventario_materiales_pk_3; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX inventario_materiales_pk_3 ON inventario_materiales USING btree (id_inv);


--
-- TOC entry 1946 (class 1259 OID 86858)
-- Dependencies: 147
-- Name: inventario_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX inventario_pk ON inventario USING btree (id_inv);


--
-- TOC entry 1947 (class 1259 OID 86859)
-- Dependencies: 147
-- Name: inventario_pk_2; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX inventario_pk_2 ON inventario USING btree (id_motivo);


--
-- TOC entry 1972 (class 1259 OID 86860)
-- Dependencies: 152
-- Name: jjj; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX jjj ON materiales USING btree (id_m);


--
-- TOC entry 1963 (class 1259 OID 86861)
-- Dependencies: 150 150
-- Name: mat_ped_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX mat_ped_pk_1 ON mat_ped USING btree (id_mat, id_ped);


--
-- TOC entry 1966 (class 1259 OID 86862)
-- Dependencies: 151
-- Name: mat_prov_pk_22; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX mat_prov_pk_22 ON mat_prov USING btree (id_prov);


--
-- TOC entry 1967 (class 1259 OID 86863)
-- Dependencies: 151 151
-- Name: mat_prov_pk_3; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX mat_prov_pk_3 ON mat_prov USING btree (id_mat, id_prov);


--
-- TOC entry 1968 (class 1259 OID 86864)
-- Dependencies: 151
-- Name: mat_prov_pk_32; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX mat_prov_pk_32 ON mat_prov USING btree (id_mat);


--
-- TOC entry 1973 (class 1259 OID 86865)
-- Dependencies: 152
-- Name: materiales_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX materiales_pk ON materiales USING btree (id_mat);


--
-- TOC entry 1976 (class 1259 OID 86868)
-- Dependencies: 154
-- Name: motivo_inv_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX motivo_inv_pk_1 ON motivo_inv USING btree (id_motivo);


--
-- TOC entry 1979 (class 1259 OID 86869)
-- Dependencies: 155 155
-- Name: mov_mat_pk_1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX mov_mat_pk_1 ON mov_mat USING btree (id_mat, id_mov);


--
-- TOC entry 1980 (class 1259 OID 86870)
-- Dependencies: 155
-- Name: mov_mat_pk_2; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX mov_mat_pk_2 ON mov_mat USING btree (id_mat);


--
-- TOC entry 1981 (class 1259 OID 86871)
-- Dependencies: 155
-- Name: mov_mat_pk_4; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX mov_mat_pk_4 ON mov_mat USING btree (id_mov);


--
-- TOC entry 1984 (class 1259 OID 86872)
-- Dependencies: 156
-- Name: movimientopk_2; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX movimientopk_2 ON movimiento USING btree (id_tm);


--
-- TOC entry 1985 (class 1259 OID 86873)
-- Dependencies: 156
-- Name: movimientopk_6; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX movimientopk_6 ON movimiento USING btree (id_mov);


--
-- TOC entry 1988 (class 1259 OID 86878)
-- Dependencies: 159
-- Name: pedido_pk_3; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pedido_pk_3 ON pedido USING btree (id_ped);


--
-- TOC entry 1989 (class 1259 OID 86879)
-- Dependencies: 159
-- Name: pedido_pk_6; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX pedido_pk_6 ON pedido USING btree (id_prov);


--
-- TOC entry 1957 (class 1259 OID 86880)
-- Dependencies: 149
-- Name: provee45dor8p88k_67; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX provee45dor8p88k_67 ON mat_padre USING btree (uni_id_unidad);


--
-- TOC entry 1958 (class 1259 OID 86881)
-- Dependencies: 149
-- Name: provee45dorp88k_67; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX provee45dorp88k_67 ON mat_padre USING btree (id_unidad);


--
-- TOC entry 1959 (class 1259 OID 86882)
-- Dependencies: 149
-- Name: provee45dorpk_6; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX provee45dorpk_6 ON mat_padre USING btree (id_m);


--
-- TOC entry 1960 (class 1259 OID 86883)
-- Dependencies: 149
-- Name: provee45dorpk_67; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX provee45dorpk_67 ON mat_padre USING btree (id_fam);


--
-- TOC entry 1994 (class 1259 OID 86884)
-- Dependencies: 164
-- Name: proveedorpk_6; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX proveedorpk_6 ON proveedor USING btree (id_prov);


--
-- TOC entry 1997 (class 1259 OID 86887)
-- Dependencies: 166
-- Name: tipo_movimientopk_6; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX tipo_movimientopk_6 ON tipo_movimiento USING btree (id_tm);


--
-- TOC entry 2000 (class 1259 OID 86888)
-- Dependencies: 167
-- Name: unidad_medidapk_6; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX unidad_medidapk_6 ON unidad_medida USING btree (id_unidad);


--
-- TOC entry 2002 (class 2606 OID 86899)
-- Dependencies: 148 1948 147
-- Name: fk_inventar_reference_inventar; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario_materiales
    ADD CONSTRAINT fk_inventar_reference_inventar FOREIGN KEY (id_inv) REFERENCES inventario(id_inv) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2003 (class 2606 OID 86904)
-- Dependencies: 152 148 1974
-- Name: fk_inventar_reference_material; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario_materiales
    ADD CONSTRAINT fk_inventar_reference_material FOREIGN KEY (id_mat) REFERENCES materiales(id_mat) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2001 (class 2606 OID 86909)
-- Dependencies: 147 154 1977
-- Name: fk_inventar_reference_motivo_i; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT fk_inventar_reference_motivo_i FOREIGN KEY (id_motivo) REFERENCES motivo_inv(id_motivo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2007 (class 2606 OID 86914)
-- Dependencies: 152 1974 150
-- Name: fk_mat_ped_reference_material; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mat_ped
    ADD CONSTRAINT fk_mat_ped_reference_material FOREIGN KEY (id_mat) REFERENCES materiales(id_mat) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2008 (class 2606 OID 86919)
-- Dependencies: 159 1990 150
-- Name: fk_mat_ped_reference_pedido; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mat_ped
    ADD CONSTRAINT fk_mat_ped_reference_pedido FOREIGN KEY (id_ped) REFERENCES pedido(id_ped) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2009 (class 2606 OID 86924)
-- Dependencies: 1974 151 152
-- Name: fk_mat_prov_reference_material; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mat_prov
    ADD CONSTRAINT fk_mat_prov_reference_material FOREIGN KEY (id_mat) REFERENCES materiales(id_mat) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2010 (class 2606 OID 86929)
-- Dependencies: 164 1992 151
-- Name: fk_mat_prov_reference_proveedo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mat_prov
    ADD CONSTRAINT fk_mat_prov_reference_proveedo FOREIGN KEY (id_prov) REFERENCES proveedor(id_prov) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2011 (class 2606 OID 86934)
-- Dependencies: 143 1941 152
-- Name: fk_material_reference_deposito; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY materiales
    ADD CONSTRAINT fk_material_reference_deposito FOREIGN KEY (id_dep) REFERENCES deposito(id_dep) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2013 (class 2606 OID 86944)
-- Dependencies: 1974 152 155
-- Name: fk_mov_mat_reference_material; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mov_mat
    ADD CONSTRAINT fk_mov_mat_reference_material FOREIGN KEY (id_mat) REFERENCES materiales(id_mat) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2014 (class 2606 OID 86949)
-- Dependencies: 1986 155 156
-- Name: fk_mov_mat_reference_movimien; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mov_mat
    ADD CONSTRAINT fk_mov_mat_reference_movimien FOREIGN KEY (id_mov) REFERENCES movimiento(id_mov) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2015 (class 2606 OID 86954)
-- Dependencies: 156 1995 166
-- Name: fk_movimien_reference_tipo_mov; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento
    ADD CONSTRAINT fk_movimien_reference_tipo_mov FOREIGN KEY (id_tm) REFERENCES tipo_movimiento(id_tm) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2016 (class 2606 OID 86969)
-- Dependencies: 1992 164 159
-- Name: fk_pedido_reference_proveedo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pedido
    ADD CONSTRAINT fk_pedido_reference_proveedo FOREIGN KEY (id_prov) REFERENCES proveedor(id_prov) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2004 (class 2606 OID 86979)
-- Dependencies: 144 149 1944
-- Name: mat_padre_id_fam_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mat_padre
    ADD CONSTRAINT mat_padre_id_fam_fkey FOREIGN KEY (id_fam) REFERENCES familia(id_fam);


--
-- TOC entry 2005 (class 2606 OID 86984)
-- Dependencies: 167 149 1998
-- Name: mat_padre_id_unidad_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mat_padre
    ADD CONSTRAINT mat_padre_id_unidad_fkey FOREIGN KEY (id_unidad) REFERENCES unidad_medida(id_unidad);


--
-- TOC entry 2006 (class 2606 OID 86989)
-- Dependencies: 1998 149 167
-- Name: mat_padre_uni_id_unidad_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mat_padre
    ADD CONSTRAINT mat_padre_uni_id_unidad_fkey FOREIGN KEY (uni_id_unidad) REFERENCES unidad_medida(id_unidad);


--
-- TOC entry 2012 (class 2606 OID 86994)
-- Dependencies: 1955 149 152
-- Name: materiales_id_m_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY materiales
    ADD CONSTRAINT materiales_id_m_fkey FOREIGN KEY (id_m) REFERENCES mat_padre(id_m);


-- Completed on 2012-07-17 18:03:28

--
-- PostgreSQL database dump complete
--


CREATE VIEW vista_gt_tec_per AS
    SELECT persona.id_persona, persona.cedula, persona.nombre, persona.apellido, persona.telefono, tecnico.num_tecnico, tecnico.direccion_tec, tecnico.correo_tec, tecnico.status_tec, grupo_trabajo.id_gt, grupo_trabajo.fecha_creacion, grupo_trabajo.hora_creacion, grupo_trabajo.id_zona, grupo_trabajo.nombre_grupo FROM persona, tecnico, grupo_tecnico, grupo_trabajo WHERE (((persona.id_persona = tecnico.id_persona) AND (tecnico.id_persona = grupo_tecnico.id_persona)) AND (grupo_trabajo.id_gt = grupo_tecnico.id_gt)) ORDER BY persona.nombre;


CREATE VIEW vista_materiales AS
    SELECT materiales.id_mat, materiales.id_dep, materiales.stock, materiales.stock_min, materiales.observacion, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.id_unidad, mat_padre.uni_id_unidad, mat_padre.id_fam, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, familia.nombre_fam, familia.status_fam, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad FROM unidad_medida, materiales, deposito, familia, mat_padre WHERE ((((materiales.id_dep = deposito.id_dep) AND (mat_padre.id_unidad = unidad_medida.id_unidad)) AND (materiales.id_m = mat_padre.id_m)) AND (mat_padre.id_fam = familia.id_fam)) ORDER BY materiales.id_mat;


CREATE VIEW vista_materiales_prov AS
    SELECT pedido.id_prov, materiales.id_mat, materiales.id_dep, materiales.stock, materiales.stock_min, materiales.observacion, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.id_unidad, mat_padre.uni_id_unidad, mat_padre.id_fam, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, familia.nombre_fam, familia.status_fam, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad FROM unidad_medida, materiales, deposito, familia, mat_padre, pedido, mat_ped WHERE ((((((materiales.id_mat = mat_ped.id_mat) AND (pedido.id_ped = mat_ped.id_ped)) AND (materiales.id_dep = deposito.id_dep)) AND (mat_padre.id_unidad = unidad_medida.id_unidad)) AND (materiales.id_m = mat_padre.id_m)) AND (mat_padre.id_fam = familia.id_fam)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_materiales_prov OWNER TO postgres;

--
-- TOC entry 171 (class 1259 OID 86722)
-- Dependencies: 1781 6
-- Name: vista_materiales_unid; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_materiales_unid AS
    SELECT us.id_unidad AS us_id, us.nombre_unidad AS us_nombre, us.abreviatura AS us_abre, materiales.id_mat, materiales.id_dep, materiales.stock, materiales.stock_min, materiales.observacion, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.id_unidad, mat_padre.uni_id_unidad, mat_padre.id_fam, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, familia.nombre_fam, familia.status_fam, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad FROM unidad_medida us, unidad_medida, materiales, deposito, familia, mat_padre WHERE (((((materiales.id_dep = deposito.id_dep) AND (mat_padre.uni_id_unidad = us.id_unidad)) AND (mat_padre.id_unidad = unidad_medida.id_unidad)) AND (materiales.id_m = mat_padre.id_m)) AND (mat_padre.id_fam = familia.id_fam)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_materiales_unid OWNER TO postgres;

--
-- TOC entry 172 (class 1259 OID 86727)
-- Dependencies: 1782 6
-- Name: vista_materialesuniinv; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_materialesuniinv AS
    SELECT inventario_materiales.id_mat, inventario_materiales.id_inv, inventario_materiales.cant_sist, inventario_materiales.cant_real, inventario_materiales.justi_inv, vista_materiales_unid.us_id, vista_materiales_unid.us_nombre, vista_materiales_unid.us_abre, vista_materiales_unid.id_dep, vista_materiales_unid.stock, vista_materiales_unid.stock_min, vista_materiales_unid.observacion, vista_materiales_unid.id_m, vista_materiales_unid.numero_mat, vista_materiales_unid.nombre_mat, vista_materiales_unid.id_unidad, vista_materiales_unid.uni_id_unidad, vista_materiales_unid.id_fam, vista_materiales_unid.precio_u_p, vista_materiales_unid.c_uni_ent, vista_materiales_unid.c_uni_sal, vista_materiales_unid.nombre_dep, vista_materiales_unid.descrip_dep, vista_materiales_unid.status_dep, vista_materiales_unid.nombre_fam, vista_materiales_unid.status_fam, vista_materiales_unid.nombre_unidad, vista_materiales_unid.abreviatura, vista_materiales_unid.status_unidad FROM inventario_materiales, vista_materiales_unid WHERE (inventario_materiales.id_mat = vista_materiales_unid.id_mat);


ALTER TABLE public.vista_materialesuniinv OWNER TO postgres;

--
-- TOC entry 173 (class 1259 OID 86732)
-- Dependencies: 1783 6
-- Name: vista_matpadre; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_matpadre AS
    SELECT unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, familia.id_fam, familia.nombre_fam, familia.status_fam, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, mat_padre.uni_id_unidad FROM unidad_medida, familia, mat_padre WHERE ((mat_padre.id_unidad = unidad_medida.id_unidad) AND (mat_padre.id_fam = familia.id_fam)) ORDER BY mat_padre.numero_mat;


ALTER TABLE public.vista_matpadre OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 86736)
-- Dependencies: 1784 6
-- Name: vista_matpadre_und; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_matpadre_und AS
    SELECT us.id_unidad AS us_id, us.nombre_unidad AS us_nombre, us.abreviatura AS us_abre, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, familia.id_fam, familia.nombre_fam, familia.status_fam, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, mat_padre.uni_id_unidad FROM unidad_medida us, unidad_medida, familia, mat_padre WHERE (((mat_padre.uni_id_unidad = us.id_unidad) AND (mat_padre.id_unidad = unidad_medida.id_unidad)) AND (mat_padre.id_fam = familia.id_fam)) ORDER BY mat_padre.numero_mat;


ALTER TABLE public.vista_matpadre_und OWNER TO postgres;

--
-- TOC entry 175 (class 1259 OID 86740)
-- Dependencies: 1785 6
-- Name: vista_matped; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_matped AS
    SELECT materiales.id_mat, mat_padre.nombre_mat, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, mat_padre.numero_mat, materiales.id_dep, mat_padre.id_fam, materiales.stock, materiales.stock_min, deposito.nombre_dep, mat_ped.id_ped, mat_ped.cant_ped, mat_ped.cant_ent, mat_ped.precio, familia.nombre_fam FROM unidad_medida, materiales, deposito, familia, mat_ped, mat_padre WHERE (((((mat_padre.id_unidad = unidad_medida.id_unidad) AND (materiales.id_dep = deposito.id_dep)) AND (materiales.id_m = mat_padre.id_m)) AND (familia.id_fam = mat_padre.id_fam)) AND (materiales.id_mat = mat_ped.id_mat)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_matped OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 86745)
-- Dependencies: 1786 6
-- Name: vista_matped_und; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_matped_und AS
    SELECT us.id_unidad AS us_id, us.nombre_unidad AS us_nombre, us.abreviatura AS us_abre, materiales.id_mat, mat_padre.nombre_mat, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, mat_padre.numero_mat, materiales.id_dep, mat_padre.id_fam, mat_padre.c_uni_ent, mat_padre.c_uni_sal, materiales.stock, materiales.stock_min, deposito.nombre_dep, mat_ped.id_ped, mat_ped.cant_ped, mat_ped.cant_ent, mat_ped.precio, familia.nombre_fam FROM unidad_medida us, unidad_medida, materiales, deposito, familia, mat_ped, mat_padre WHERE ((((((mat_padre.id_unidad = unidad_medida.id_unidad) AND (mat_padre.uni_id_unidad = us.id_unidad)) AND (materiales.id_dep = deposito.id_dep)) AND (materiales.id_m = mat_padre.id_m)) AND (familia.id_fam = mat_padre.id_fam)) AND (materiales.id_mat = mat_ped.id_mat)) ORDER BY materiales.id_mat;


ALTER TABLE public.vista_matped_und OWNER TO postgres;

--
-- TOC entry 177 (class 1259 OID 86750)
-- Dependencies: 1787 6
-- Name: vista_movimiento_mov_mat; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_movimiento_mov_mat AS
    SELECT mov_mat.id_mat, mov_mat.cant_mov, tipo_movimiento.id_tm, tipo_movimiento.nombre_tm, tipo_movimiento.tipo_ent_sal, tipo_movimiento.uso_tm, tipo_movimiento.status_tm, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, movimiento.id_mov, movimiento.fecha_ent_sal, movimiento.hora_ent_sal, movimiento.observacion, movimiento.referencia, movimiento.tipo_mov FROM tipo_movimiento, deposito, movimiento, mov_mat WHERE (((movimiento.tipo_mov = deposito.id_dep) AND (movimiento.id_tm = tipo_movimiento.id_tm)) AND (movimiento.id_mov = mov_mat.id_mov)) ORDER BY movimiento.fecha_ent_sal, movimiento.hora_ent_sal;


ALTER TABLE public.vista_movimiento_mov_mat OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 86754)
-- Dependencies: 1788 6
-- Name: vista_movimiento_mov_mat_uni; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_movimiento_mov_mat_uni AS
    SELECT mov_mat.id_mat, mov_mat.cant_mov, tipo_movimiento.id_tm, tipo_movimiento.nombre_tm, tipo_movimiento.tipo_ent_sal, tipo_movimiento.uso_tm, tipo_movimiento.status_tm, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, movimiento.id_mov, movimiento.fecha_ent_sal, movimiento.hora_ent_sal, movimiento.observacion, movimiento.referencia, movimiento.tipo_mov, us.id_unidad AS us_id, us.nombre_unidad AS us_nombre, us.abreviatura AS us_abre, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, familia.id_fam, familia.nombre_fam, familia.status_fam, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, mat_padre.uni_id_unidad, materiales.stock, materiales.stock_min FROM tipo_movimiento, deposito, movimiento, mov_mat, unidad_medida us, unidad_medida, familia, mat_padre, materiales WHERE ((((((((movimiento.tipo_mov = deposito.id_dep) AND (movimiento.id_tm = tipo_movimiento.id_tm)) AND (movimiento.id_mov = mov_mat.id_mov)) AND (materiales.id_m = mat_padre.id_m)) AND (mat_padre.uni_id_unidad = us.id_unidad)) AND (mat_padre.id_unidad = unidad_medida.id_unidad)) AND (mat_padre.id_fam = familia.id_fam)) AND (mov_mat.id_mat = materiales.id_mat)) ORDER BY movimiento.fecha_ent_sal, movimiento.hora_ent_sal;


ALTER TABLE public.vista_movimiento_mov_mat_uni OWNER TO postgres;

--
-- TOC entry 179 (class 1259 OID 86759)
-- Dependencies: 1789 6
-- Name: vista_pedido; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_pedido AS
    SELECT pedido.id_ped, pedido.id_prov, pedido.fecha_ped, pedido.fecha_ent, pedido.status_ped, pedido.obser_ped, pedido.nro_fact_ped, pedido.porc_desc, pedido.desc_ped, pedido.base_ped, pedido.iva_ped, pedido.total_ped, proveedor.rif_prov, proveedor.nombre_prov, proveedor.direccion_prov, proveedor.telefonos_prov, proveedor.fax_prov, proveedor.web_prov, proveedor.email_prov, proveedor.obser_prov, proveedor.forma_pago, proveedor.banco, proveedor.cuenta, proveedor.status_prov, proveedor.contacto FROM pedido, proveedor WHERE (pedido.id_prov = proveedor.id_prov) ORDER BY pedido.id_ped DESC;


ALTER TABLE public.vista_pedido OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 86764)
-- Dependencies: 1790 6
-- Name: vista_planillainv; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_planillainv AS
    SELECT inventario_materiales.id_mat, inventario_materiales.id_inv, inventario_materiales.cant_sist, inventario_materiales.cant_real, inventario_materiales.justi_inv, inventario.id_motivo, inventario.fecha_inv, inventario.hora_inv, inventario.obser_inv, inventario.tipo_inv, inventario.id_dep, inventario.id_fam, inventario.status_inv, vista_materiales_unid.us_id, vista_materiales_unid.us_nombre, vista_materiales_unid.us_abre, vista_materiales_unid.stock, vista_materiales_unid.stock_min, vista_materiales_unid.observacion, vista_materiales_unid.id_m, vista_materiales_unid.numero_mat, vista_materiales_unid.nombre_mat, vista_materiales_unid.id_unidad, vista_materiales_unid.uni_id_unidad, vista_materiales_unid.precio_u_p, vista_materiales_unid.c_uni_ent, vista_materiales_unid.c_uni_sal, vista_materiales_unid.nombre_dep, vista_materiales_unid.descrip_dep, vista_materiales_unid.status_dep, vista_materiales_unid.nombre_fam, vista_materiales_unid.status_fam, vista_materiales_unid.nombre_unidad, vista_materiales_unid.abreviatura, vista_materiales_unid.status_unidad FROM inventario_materiales, inventario, vista_materiales_unid WHERE ((inventario_materiales.id_inv = inventario.id_inv) AND (inventario_materiales.id_mat = vista_materiales_unid.id_mat)) ORDER BY vista_materiales_unid.nombre_mat;


ALTER TABLE public.vista_planillainv OWNER TO postgres;

--
-- TOC entry 181 (class 1259 OID 86769)
-- Dependencies: 1791 6
-- Name: vista_planillamov; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_planillamov AS
    SELECT mov_mat.id_mat, mov_mat.id_mov, mov_mat.cant_mov, vista_materiales_unid.us_id, vista_materiales_unid.us_nombre, vista_materiales_unid.us_abre, vista_materiales_unid.id_dep, vista_materiales_unid.stock, vista_materiales_unid.stock_min, vista_materiales_unid.observacion, vista_materiales_unid.id_m, vista_materiales_unid.numero_mat, vista_materiales_unid.nombre_mat, vista_materiales_unid.id_unidad, vista_materiales_unid.uni_id_unidad, vista_materiales_unid.id_fam, vista_materiales_unid.precio_u_p, vista_materiales_unid.c_uni_ent, vista_materiales_unid.c_uni_sal, vista_materiales_unid.nombre_dep, vista_materiales_unid.descrip_dep, vista_materiales_unid.status_dep, vista_materiales_unid.nombre_fam, vista_materiales_unid.status_fam, vista_materiales_unid.nombre_unidad, vista_materiales_unid.abreviatura, vista_materiales_unid.status_unidad FROM mov_mat, vista_materiales_unid WHERE (mov_mat.id_mat = vista_materiales_unid.id_mat) ORDER BY vista_materiales_unid.nombre_mat;


ALTER TABLE public.vista_planillamov OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 86774)
-- Dependencies: 1792 6
-- Name: vista_planillaped; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_planillaped AS
    SELECT pedido.id_ped, pedido.id_prov, pedido.fecha_ped, pedido.fecha_ent, pedido.status_ped, pedido.obser_ped, pedido.nro_fact_ped, pedido.porc_desc, pedido.desc_ped, pedido.base_ped, pedido.iva_ped, pedido.total_ped, vista_matped_und.us_id, vista_matped_und.us_nombre, vista_matped_und.us_abre, vista_matped_und.id_mat, vista_matped_und.nombre_mat, vista_matped_und.id_unidad, vista_matped_und.nombre_unidad, vista_matped_und.abreviatura, vista_matped_und.numero_mat, vista_matped_und.id_dep, vista_matped_und.id_fam, vista_matped_und.c_uni_ent, vista_matped_und.c_uni_sal, vista_matped_und.stock, vista_matped_und.stock_min, vista_matped_und.nombre_dep, vista_matped_und.cant_ped, vista_matped_und.cant_ent, vista_matped_und.precio, vista_matped_und.nombre_fam FROM pedido, vista_matped_und WHERE (vista_matped_und.id_ped = pedido.id_ped);


ALTER TABLE public.vista_planillaped OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 86779)
-- Dependencies: 1793 6
-- Name: vista_reporteinventario; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_reporteinventario AS
    SELECT motivo_inv.id_motivo, motivo_inv.nombre_motivo, motivo_inv.status_motivo, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, inventario.id_inv, inventario.fecha_inv, inventario.hora_inv, inventario.obser_inv, inventario.tipo_inv, inventario.id_fam, inventario.status_inv FROM motivo_inv, deposito, inventario WHERE ((inventario.id_motivo = motivo_inv.id_motivo) AND (inventario.id_dep = deposito.id_dep));


ALTER TABLE public.vista_reporteinventario OWNER TO postgres;

--
-- TOC entry 184 (class 1259 OID 86783)
-- Dependencies: 1794 6
-- Name: vista_reportemovimiento; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW vista_reportemovimiento AS
    SELECT tipo_movimiento.id_tm, tipo_movimiento.nombre_tm, tipo_movimiento.tipo_ent_sal, tipo_movimiento.uso_tm, tipo_movimiento.status_tm, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, movimiento.id_mov, movimiento.fecha_ent_sal, movimiento.hora_ent_sal, movimiento.observacion, movimiento.referencia, movimiento.tipo_mov FROM tipo_movimiento, deposito, movimiento WHERE ((movimiento.tipo_mov = deposito.id_dep) AND (movimiento.id_tm = tipo_movimiento.id_tm)) ORDER BY movimiento.fecha_ent_sal;


ALTER TABLE public.vista_reportemovimiento OWNER TO postgres;


/*-----------------------------------------------------------------------------------*/


INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU079', 'MOTIVO_INV               ', 'MOTIVO_INV', 'ACTIVO  ', 'MOTIVO_INV');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU080', 'FAMILIA                  ', 'FAMILIA', 'ACTIVO  ', 'FAMILIA');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU081', 'INVENTARIO_MATERIALES    ', 'INVENTARIO_MATERIALES', 'ACTIVO  ', 'INVENTARIO_MATERIALES');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU082', 'DEPOSITO                 ', 'DEPOSITO', 'ACTIVO  ', 'DEPOSITO');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU083', 'UNIDAD_MEDIDA            ', 'UNIDAD_MEDIDA', 'ACTIVO  ', 'UNIDAD_MEDIDA');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU084', 'TIPO_MOVIMIENTO          ', 'TIPO_MOVIMIENTO', 'ACTIVO  ', 'TIPO_MOVIMIENTO');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU085', 'MOVIMIENTO               ', 'MOVIMIENTO', 'ACTIVO  ', 'MOVIMIENTO');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU086', 'PROVEEDOR                ', 'PROVEEDOR', 'ACTIVO  ', 'PROVEEDOR');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU087', 'PEDIDO                   ', 'PEDIDO', 'ACTIVO  ', 'PEDIDO');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU088', 'MATERIALES               ', 'MATERIALES', 'ACTIVO  ', 'MATERIALES');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU089', 'MOV_MAT                  ', 'MOV_MAT', 'ACTIVO  ', 'MOV_MAT');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU090', 'MAT_PROV                 ', 'MAT_PROV', 'ACTIVO  ', 'MAT_PROV');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU091', 'MAT_PED                  ', 'MAT_PED', 'ACTIVO  ', 'MAT_PED');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU092', 'CONFIR_PEDIDO            ', 'CONFIR_PEDIDO', 'ACTIVO  ', 'CONFIR_PEDIDO');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU093', 'REPORTEPEDIDO            ', 'REPORTEPEDIDO', 'ACTIVO  ', 'REP_REPORTEPEDIDO');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU094', 'REGISTRAR_COMPRA         ', 'REALIZAR_COMPRA', 'ACTIVO  ', 'REALIZAR_COMPRA');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU095', 'INVENTARIO               ', 'INVENTARIO', 'ACTIVO  ', 'INVENTARIO');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU096', 'APROBAR INVENTARIO       ', 'APROBAR_INVENTARIO', 'ACTIVO  ', 'APROBARINVENTARIO');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU097', 'MAT_PADRE                ', 'MAT_PADRE', 'ACTIVO  ', 'MAT_PADRE');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU098', 'MATPADRE                 ', 'MATPADRE', 'ACTIVO  ', 'REP_MATPADRE');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU099', 'PROVEEDORES              ', 'PROVEEDORES', 'ACTIVO  ', 'REP_PROVEEDORES');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU100', 'MATERIALES UNI INV       ', 'MATERIALES UNI INV', 'ACTIVO  ', 'REP_MATERIALESUNIINV');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU101', 'PLANILLAMOV              ', 'PLANILLAMOV', 'ACTIVO  ', 'REP_PLANILLAMOV');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU102', 'PLANILLAPED              ', 'PLANILLAPED', 'ACTIVO  ', 'REP_PLANILLAPED');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU103', 'PLANILLAINV              ', 'PLANILLAINV', 'ACTIVO  ', 'REP_PLANILLAINV');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU104', 'REPORTEMOVIMIENTO        ', 'REPORTEMOVIMIENTO', 'ACTIVO  ', 'REP_REPORTEMOVIMIENTO');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU105', 'REPORTEINVENTARIO        ', 'REPORTEINVENTARIO', 'ACTIVO  ', 'REP_REPORTEINVENTARIO');
INSERT INTO MODULO (CODIGOMODULO, NOMBREMODULO, DESCRIPCIONMODULO, STATUSMODULO, NAMEMODULO) VALUES ('MODU106', 'RECORD DE MATERIALES     ', 'REPORTEINVENTARIO', 'ACTIVO  ', 'RECORD');


/*MATERIALES VACIO*/
/*
delete from mov_mat;
delete from mat_ped;
delete from mat_prov;
delete from inventario_materiales;
delete from pedido;
delete from proveedor;
delete from inventario;
delete from motivo_inv;
delete from materiales;
delete from deposito where status_dep <> 'INTERNO';
delete from mat_padre;
delete from familia;
delete from unidad_medida;
delete from movimiento;
delete from tipo_movimiento where status_tm <> 'INTERNO';
*/
/*fin */