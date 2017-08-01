--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.5
-- Dumped by pg_dump version 9.3.5
-- Started on 2015-06-29 15:40:40

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 171 (class 1259 OID 155664)
-- Name: almacen; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE almacen (
    id_alm character varying(20) NOT NULL,
    id_gt character varying(20) NOT NULL,
    id_enc character varying(20) NOT NULL,
    nombre_alm text NOT NULL,
    descrip_alm text NOT NULL,
    status_alm character varying(20) NOT NULL,
    direccion_alm text NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL,
    codigo_alm character varying(20) NOT NULL
);


ALTER TABLE public.almacen OWNER TO postgres;

--
-- TOC entry 3031 (class 0 OID 0)
-- Dependencies: 171
-- Name: TABLE almacen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE almacen IS 'MODULO DE MATERIALES';


--
-- TOC entry 206 (class 1259 OID 155799)
-- Name: config_mat; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE config_mat (
    id_c_mat character varying(20) NOT NULL,
    id_franq character varying(20),
    hab_alerta_min boolean,
    hab_desc_alm_gru boolean,
    hab_desc_alm_gen boolean,
    hab_mat_orden boolean,
    id_deposito character varying(8),
    hab_imp_mat boolean
);


ALTER TABLE public.config_mat OWNER TO postgres;

--
-- TOC entry 236 (class 1259 OID 155926)
-- Name: encargado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE encargado (
    id_enc character varying(20) NOT NULL,
    id_persona character varying(20) NOT NULL,
    descrip_enc text NOT NULL,
    status_enc character varying(20) NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.encargado OWNER TO postgres;

--
-- TOC entry 3032 (class 0 OID 0)
-- Dependencies: 236
-- Name: TABLE encargado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE encargado IS 'MODULO DE MATERIALES';


--
-- TOC entry 3033 (class 0 OID 0)
-- Dependencies: 236
-- Name: COLUMN encargado.id_estatus_reg; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN encargado.id_estatus_reg IS 'CAMPO PARA REALIZAR ELIMINADOS LÓGICOS';


--
-- TOC entry 246 (class 1259 OID 155969)
-- Name: estatus_inventario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE estatus_inventario (
    id_est_inv character varying(20) NOT NULL,
    nombre_est_inv text NOT NULL,
    descrip_est_inv text NOT NULL,
    status_est_inv character varying(20) NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.estatus_inventario OWNER TO postgres;

--
-- TOC entry 3034 (class 0 OID 0)
-- Dependencies: 246
-- Name: TABLE estatus_inventario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE estatus_inventario IS 'MODULO DE MATERIALES';


--
-- TOC entry 247 (class 1259 OID 155976)
-- Name: estatus_registro; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE estatus_registro (
    id_estatus_reg integer NOT NULL,
    cod_estatus_reg character(1) NOT NULL,
    descrip_estatus_reg text NOT NULL,
    coment_estatus_reg text
);


ALTER TABLE public.estatus_registro OWNER TO postgres;

--
-- TOC entry 3035 (class 0 OID 0)
-- Dependencies: 247
-- Name: TABLE estatus_registro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE estatus_registro IS 'Materiales

Estatus_registro: Tabla que almacena los estados de los registros de algunas tablas. Por ej. Activo, Eliminado o cualquier otro con la finalidad de no eliminar físicamente ningun registro de la BD que pueda afectar alguna referencia o funcionamiento.';


--
-- TOC entry 248 (class 1259 OID 155982)
-- Name: estatus_registro_id_estatus_reg_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE estatus_registro_id_estatus_reg_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estatus_registro_id_estatus_reg_seq OWNER TO postgres;

--
-- TOC entry 3036 (class 0 OID 0)
-- Dependencies: 248
-- Name: estatus_registro_id_estatus_reg_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE estatus_registro_id_estatus_reg_seq OWNED BY estatus_registro.id_estatus_reg;


--
-- TOC entry 249 (class 1259 OID 155984)
-- Name: familia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE familia (
    id_fam character varying(20) NOT NULL,
    nombre_fam text NOT NULL,
    descrip_fam text NOT NULL,
    status_fam character varying(20) NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.familia OWNER TO postgres;

--
-- TOC entry 3037 (class 0 OID 0)
-- Dependencies: 249
-- Name: TABLE familia; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE familia IS 'MODULO DE MATERIALES

*productos nuevo
*productos obsoletos
*productos bajo margen
*productos caducables';


--
-- TOC entry 263 (class 1259 OID 156049)
-- Name: inventario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE inventario (
    id_inv character varying(20) NOT NULL,
    id_mot_inv character varying(20) NOT NULL,
    fecha_inv date DEFAULT ('now'::text)::date NOT NULL,
    hora_inv time without time zone DEFAULT ('now'::text)::time with time zone NOT NULL,
    obser_inv text NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL,
    id_est_inv character varying(20) NOT NULL,
    ref_inv character varying(20) NOT NULL,
    id_alm character varying(20) NOT NULL
);


ALTER TABLE public.inventario OWNER TO postgres;

--
-- TOC entry 3038 (class 0 OID 0)
-- Dependencies: 263
-- Name: TABLE inventario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE inventario IS 'MODULO DE MATERIALES';


--
-- TOC entry 264 (class 1259 OID 156058)
-- Name: inventario_material; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE inventario_material (
    id_inv_mat character varying(20) NOT NULL,
    id_inv character varying(20) NOT NULL,
    id_stock character varying(20),
    cant_sist numeric(20,2) DEFAULT 0.00 NOT NULL,
    cant_real numeric(20,2) DEFAULT 0.00 NOT NULL,
    CONSTRAINT ck_inventario_material_cant_positiva CHECK (((cant_sist >= (0)::numeric) AND (cant_real >= (0)::numeric)))
);


ALTER TABLE public.inventario_material OWNER TO postgres;

--
-- TOC entry 3039 (class 0 OID 0)
-- Dependencies: 264
-- Name: TABLE inventario_material; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE inventario_material IS 'MODULO DE MATERIALES';


--
-- TOC entry 269 (class 1259 OID 156081)
-- Name: material; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE material (
    id_mat character varying(20) NOT NULL,
    id_fam character varying(20) NOT NULL,
    id_uni character varying(20) NOT NULL,
    uni_id_uni character varying(20) NOT NULL,
    codigo_mat character varying(20) NOT NULL,
    nombre_mat text NOT NULL,
    cant_uni_ent numeric(20,2) DEFAULT 0.00 NOT NULL,
    cant_uni_sal numeric(20,2) DEFAULT 0.00 NOT NULL,
    impreso boolean DEFAULT false NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL,
    CONSTRAINT ck_material_cant_positiva CHECK (((cant_uni_ent >= (0)::numeric) AND (cant_uni_sal >= (0)::numeric)))
);


ALTER TABLE public.material OWNER TO postgres;

--
-- TOC entry 3040 (class 0 OID 0)
-- Dependencies: 269
-- Name: TABLE material; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE material IS 'MODULO DE MATERIALES';


--
-- TOC entry 279 (class 1259 OID 156125)
-- Name: motivo_inventario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE motivo_inventario (
    id_mot_inv character varying(20) NOT NULL,
    nombre_mot_inv text NOT NULL,
    status_mot_inv character varying(20) NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.motivo_inventario OWNER TO postgres;

--
-- TOC entry 3041 (class 0 OID 0)
-- Dependencies: 279
-- Name: TABLE motivo_inventario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE motivo_inventario IS 'MODULO DE MATERIALES';


--
-- TOC entry 280 (class 1259 OID 156132)
-- Name: motivo_movimiento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE motivo_movimiento (
    id_mot_mov character varying(20) NOT NULL,
    nombre_mot_mov text NOT NULL,
    status_mot_mov character varying(20) NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL,
    id_tipo_mov character varying(20) NOT NULL
);


ALTER TABLE public.motivo_movimiento OWNER TO postgres;

--
-- TOC entry 3042 (class 0 OID 0)
-- Dependencies: 280
-- Name: TABLE motivo_movimiento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE motivo_movimiento IS 'MODULO DE MATERIALES';


--
-- TOC entry 3043 (class 0 OID 0)
-- Dependencies: 280
-- Name: COLUMN motivo_movimiento.id_estatus_reg; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN motivo_movimiento.id_estatus_reg IS 'CAMPO PARA REALIZAR ELIMINADOS LÓGICOS';


--
-- TOC entry 283 (class 1259 OID 156145)
-- Name: movimiento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE movimiento (
    id_mov character varying(20) NOT NULL,
    id_tipo_mov character varying(20) NOT NULL,
    id_res character varying(20) NOT NULL,
    ref_mov character varying(20) NOT NULL,
    mot_mov text NOT NULL,
    fecha_mov date DEFAULT ('now'::text)::date NOT NULL,
    hora_mov time with time zone DEFAULT ('now'::text)::time with time zone NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL,
    id_alm character varying(20) NOT NULL
);


ALTER TABLE public.movimiento OWNER TO postgres;

--
-- TOC entry 285 (class 1259 OID 156160)
-- Name: movimiento_material; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE movimiento_material (
    id_mov_mat character varying(20) NOT NULL,
    id_stock character varying(20) NOT NULL,
    id_mov character varying(20) NOT NULL,
    cant_mov_mat numeric(20,2) DEFAULT 0.00 NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.movimiento_material OWNER TO postgres;

--
-- TOC entry 3044 (class 0 OID 0)
-- Dependencies: 285
-- Name: TABLE movimiento_material; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE movimiento_material IS 'MODULO DE MATERIALES';


--
-- TOC entry 303 (class 1259 OID 156225)
-- Name: pedido; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pedido (
    id_ped character varying(20) NOT NULL,
    ref_ped character(20) NOT NULL,
    fecha_ped date DEFAULT ('now'::text)::date NOT NULL,
    status_ped character varying(20) NOT NULL,
    obser_ped text NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.pedido OWNER TO postgres;

--
-- TOC entry 3045 (class 0 OID 0)
-- Dependencies: 303
-- Name: TABLE pedido; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE pedido IS 'MODULO DE MATERIALES';


--
-- TOC entry 304 (class 1259 OID 156233)
-- Name: pedido_material; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pedido_material (
    id_ped_mat character varying(20) NOT NULL,
    id_ped character varying(20) NOT NULL,
    id_stock character varying(20) NOT NULL,
    cant_ped_mat numeric(20,2) DEFAULT 0.00 NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL,
    CONSTRAINT ck_pedido_material_cant_positiva CHECK ((cant_ped_mat >= (0)::numeric))
);


ALTER TABLE public.pedido_material OWNER TO postgres;

--
-- TOC entry 3046 (class 0 OID 0)
-- Dependencies: 304
-- Name: TABLE pedido_material; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE pedido_material IS 'MODULO DE MATERIALES';


--
-- TOC entry 321 (class 1259 OID 156307)
-- Name: responsable; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE responsable (
    id_res character varying(20) NOT NULL,
    id_tipo_res character varying(20) NOT NULL,
    id_persona character varying(20) NOT NULL,
    descrip_res text NOT NULL,
    status_res character varying(20) NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.responsable OWNER TO postgres;

--
-- TOC entry 3047 (class 0 OID 0)
-- Dependencies: 321
-- Name: TABLE responsable; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE responsable IS 'MODULO DE MATERIALES';


--
-- TOC entry 3048 (class 0 OID 0)
-- Dependencies: 321
-- Name: COLUMN responsable.id_estatus_reg; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN responsable.id_estatus_reg IS 'CAMPO PARA REALIZAR ELIMINADOS LÓGICOS';


--
-- TOC entry 335 (class 1259 OID 156362)
-- Name: stock_material; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE stock_material (
    id_stock character varying(20) NOT NULL,
    id_mat character(20) NOT NULL,
    id_alm character(20) NOT NULL,
    stock numeric(20,2) DEFAULT 0.00 NOT NULL,
    stock_min numeric(20,2) DEFAULT 0.00 NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL,
    CONSTRAINT ck_stock_material_cant_positiva CHECK (((stock >= (0)::numeric) AND (stock_min >= (0)::numeric)))
);


ALTER TABLE public.stock_material OWNER TO postgres;

--
-- TOC entry 3049 (class 0 OID 0)
-- Dependencies: 335
-- Name: TABLE stock_material; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE stock_material IS 'MODULO DE MATERIALES';


--
-- TOC entry 343 (class 1259 OID 156390)
-- Name: tipo_movimiento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipo_movimiento (
    id_tipo_mov character varying(20) NOT NULL,
    nombre_tipo_mov text NOT NULL,
    descrip_tipo_mov text NOT NULL,
    status_tipo_mov character varying(20) NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.tipo_movimiento OWNER TO postgres;

--
-- TOC entry 3050 (class 0 OID 0)
-- Dependencies: 343
-- Name: TABLE tipo_movimiento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE tipo_movimiento IS 'MODULO DE MATERIALES';


--
-- TOC entry 3051 (class 0 OID 0)
-- Dependencies: 343
-- Name: COLUMN tipo_movimiento.id_estatus_reg; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tipo_movimiento.id_estatus_reg IS 'CAMPO PARA REALIZAR ELIMINADOS LÓGICOS';


--
-- TOC entry 348 (class 1259 OID 156409)
-- Name: tipo_responsable; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipo_responsable (
    id_tipo_res character varying(20) NOT NULL,
    nombre_tipo_res text NOT NULL,
    status_tipo_res character varying(20) NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.tipo_responsable OWNER TO postgres;

--
-- TOC entry 3052 (class 0 OID 0)
-- Dependencies: 348
-- Name: TABLE tipo_responsable; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE tipo_responsable IS 'MODULO DE MATERIALES';


--
-- TOC entry 3053 (class 0 OID 0)
-- Dependencies: 348
-- Name: COLUMN tipo_responsable.id_estatus_reg; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tipo_responsable.id_estatus_reg IS 'CAMPO PARA REALIZAR ELIMINADOS LÓGICOS';


--
-- TOC entry 353 (class 1259 OID 156431)
-- Name: unidad_medida; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE unidad_medida (
    id_uni character varying(20) NOT NULL,
    nombre_uni text NOT NULL,
    abrev_uni text NOT NULL,
    status_uni character varying(20) NOT NULL,
    id_estatus_reg integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.unidad_medida OWNER TO postgres;

--
-- TOC entry 3054 (class 0 OID 0)
-- Dependencies: 353
-- Name: TABLE unidad_medida; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE unidad_medida IS 'MODULO DE MATERIALES';


--
-- TOC entry 2701 (class 2604 OID 156850)
-- Name: id_estatus_reg; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estatus_registro ALTER COLUMN id_estatus_reg SET DEFAULT nextval('estatus_registro_id_estatus_reg_seq'::regclass);


--
-- TOC entry 3006 (class 0 OID 155664)
-- Dependencies: 171
-- Data for Name: almacen; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO almacen VALUES ('558CEAD1C24F88661595', 'AB00007', '558CEA71956C68025606', 'PRINCIPAL', 'EDIFICIO PRINCIPAL', 'ACTIVO', 'OFICINA CENTRAL', 1, 'ALMAB8661595');


--
-- TOC entry 3007 (class 0 OID 155799)
-- Dependencies: 206
-- Data for Name: config_mat; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO config_mat VALUES ('CM001', '1', true, true, false, false, '0', true);


--
-- TOC entry 3008 (class 0 OID 155926)
-- Dependencies: 236
-- Data for Name: encargado; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO encargado VALUES ('AB000001', 'ENT00001', 'INTERNO', 'INTERNO', 1);
INSERT INTO encargado VALUES ('558CEA71956C68025606', 'AA00000003', 'ENCARGAD@ DE ALMACEN PRINCIPAL', 'ACTIVO', 1);


--
-- TOC entry 3009 (class 0 OID 155969)
-- Dependencies: 246
-- Data for Name: estatus_inventario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO estatus_inventario VALUES ('558D70E6601D43188755', 'EN REVISIÓN', 'LOS MATERIALES SE ENCUENTRAN SIENDO INSPECCIONADOS ACTUALMENTE.', 'INTERNO', 1);
INSERT INTO estatus_inventario VALUES ('558D71768B3E56116475', 'FINALIZADO', 'LOS MATERIALES SE INSPECCIONARON Y SE ARROJÓ EL RESULTADO FINAL.', 'INTERNO', 1);


--
-- TOC entry 3010 (class 0 OID 155976)
-- Dependencies: 247
-- Data for Name: estatus_registro; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO estatus_registro VALUES (1, 'A', 'ACTIVO', 'ESTADO PARA TODOS LOS REGISTROS ACTIVOS DE LA BD');
INSERT INTO estatus_registro VALUES (2, 'E', 'ELIMINADO', 'ESTADO PARA TODOS LOS REGISTROS ELIMINADOS LOGICAMENTE DE LA BD');


--
-- TOC entry 3055 (class 0 OID 0)
-- Dependencies: 248
-- Name: estatus_registro_id_estatus_reg_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('estatus_registro_id_estatus_reg_seq', 1, false);


--
-- TOC entry 3012 (class 0 OID 155984)
-- Dependencies: 249
-- Data for Name: familia; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO familia VALUES ('558CF20D974F95618792', 'NUEVOS', 'MATERIALES NUEVOS PARA EL STOCK', 'ACTIVO', 1);
INSERT INTO familia VALUES ('558CF22EC35829631974', 'BAJO MARGEN', 'MATERIALES BAJO MARGEN', 'ACTIVO', 1);
INSERT INTO familia VALUES ('558CF2417ACB36433901', 'OBSOLETOS', 'MATERIALES OBSOLETOS O ECHADOS A PERDER', 'ACTIVO', 1);
INSERT INTO familia VALUES ('558CF26D3027C5843016', 'CADUCABLES', 'MATERIALES CON FECHA DE VENCIMIENTO', 'ACTIVO', 1);


--
-- TOC entry 3013 (class 0 OID 156049)
-- Dependencies: 263
-- Data for Name: inventario; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3014 (class 0 OID 156058)
-- Dependencies: 264
-- Data for Name: inventario_material; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3015 (class 0 OID 156081)
-- Dependencies: 269
-- Data for Name: material; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO material VALUES ('558F022B04F758997561', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB8997561', 'CANDADO PARA CAJAS (EDIFICIO)', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0266328AC4027293', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB4027293', 'CASCOS', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0278C19587530225', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB7530225', 'CIZALLA GRANDE', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F02B2C73ED4684194', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB4684194', 'CLOUSERS DE 24', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EF76806AE98922464', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB8922464', 'ABRAZADERA 3 1/2', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EF8AE54B485472637', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB5472637', 'ABRAZADERA 4 1/2', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EF8EF5A7593546417', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB3546417', 'ABRAZADERA 5 1/2', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EF92F2D0410398161', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB0398161', 'ABRAZADERA 6 1/2', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EF943D3A592139678', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB2139678', 'ABRAZADERA 7 1/2', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFA1C4907C5910094', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB5910094', 'ACOPLADOR óPTICO DE VíAS 25/25/25/25', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFA4A31AEC2747139', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB2747139', 'ADAPTADOR ACC 90', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFA9E8AD734207488', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB4207488', 'AISLADORES DE CARRETE', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFAC228A537454036', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB7454036', 'ALAMBRES', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFADFB3BF45564294', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB5564294', 'ALICATE', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFAF661EC51970522', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB1970522', 'AMPLIFICADOR SCIENTIFIC DUAL 750', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFB307FB722630837', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB2630837', 'AMPLIFICADOR SCIENTIFIC DUAL 550', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFB5E20FF23644567', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB3644567', 'AMPLIFICADOR SCIENTIFIC 750', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFB89C0F645323213', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB5323213', 'AMPLIFICADOR SCIENTIFIC 550', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFB9DB28E36730700', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB6730700', 'AMPLIFICADOR GAIN MAKER 1 GHZ', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFBD03568F9974992', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB9974992', 'AMPLIFICADOR JERROLD 550', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFBF0EE9BA1218145', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB1218145', 'ARANDELAS', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFC226B41D1985982', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB1985982', 'ATENUADOR GIAN MAKER', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFC41E1A376646107', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB6646107', 'ATENUADOR PARA JERROLD', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFC5D1D7490488952', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB0488952', 'ATENUADOR PARA SCIENTIFIC', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFC91A28AE3802369', '558CF20D974F95618792', '558EEACADF5573167277', '558CEDA6DC2CA6299748', 'MATAB3802369', 'BALITAS (UNIóN F-81)', 1.00, 50.00, false, 1);
INSERT INTO material VALUES ('558EFD18BED840925880', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB0925880', 'BARRA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFD2C5206D0994846', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB0994846', 'BOMBONAS PARA QUEMA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFD4BC29FA3223067', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB3223067', 'BRAZO BANDERA 3 1/2', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFD6A6C8C09905828', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB9905828', 'BRAZO BANDERA 5 1/2', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558EFDC00A7135655538', '558CF20D974F95618792', '558CEDB5501DD3342227', '558CEDCEA8AF11751456', 'MATAB5655538', 'CABLE FIBRA óPTICA 6000', 1.00, 6000.00, false, 1);
INSERT INTO material VALUES ('558EFFC7BD4CB2534292', '558CF20D974F95618792', '558CEDB5501DD3342227', '558CEDCEA8AF11751456', 'MATAB2534292', 'CABLE FIBRA óPTICA 5000', 1.00, 5000.00, false, 1);
INSERT INTO material VALUES ('558F0016681CA3172600', '558CF20D974F95618792', '558CEDB5501DD3342227', '558CEDCEA8AF11751456', 'MATAB3172600', 'CABLE RG 11', 1.00, 305.00, false, 1);
INSERT INTO material VALUES ('558F00AEF34BD0078099', '558CF20D974F95618792', '558CEDB5501DD3342227', '558CEDCEA8AF11751456', 'MATAB0078099', 'CABLE RG 6', 1.00, 305.00, false, 1);
INSERT INTO material VALUES ('558F00D58414C5187946', '558CF20D974F95618792', '558CEDB5501DD3342227', '558CEDCEA8AF11751456', 'MATAB5187946', 'CABLE RG 6 C/M 150', 1.00, 150.00, false, 1);
INSERT INTO material VALUES ('558F00F813B629906533', '558CF20D974F95618792', '558CEDB5501DD3342227', '558CEDCEA8AF11751456', 'MATAB9906533', 'CABLE RG PTO 500', 1.00, 750.00, false, 1);
INSERT INTO material VALUES ('558F016666AEF5590117', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB5590117', 'CAJA DE SEGURIDAD CUADRADA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F01D7CC1F83123100', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB3123100', 'CAJA DE SEGURIDAD DE 4 SALIDAS', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F01FF4CBEB7797746', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB7797746', 'CAJA DE SEGURIDAD DE 8 SALIDAS', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F021485AC58950226', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB8950226', 'CAJA DE HERRAMIENTAS', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F02E51CD2B3400542', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB3400542', 'CLOUSERS DE 48', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F02F9BA9361701787', '558CF20D974F95618792', '558EEACADF5573167277', '558CEDA6DC2CA6299748', 'MATAB1701787', 'CONECTOR DOBLE PIN (KS KS)', 1.00, 5.00, false, 1);
INSERT INTO material VALUES ('558F036E4BDEF3321017', '558CF20D974F95618792', '558EEACADF5573167277', '558CEDA6DC2CA6299748', 'MATAB3321017', 'CONECTOR RG 11', 1.00, 50.00, false, 1);
INSERT INTO material VALUES ('558F038667BD37989272', '558CF20D974F95618792', '558EEACADF5573167277', '558CEDA6DC2CA6299748', 'MATAB7989272', 'CONECTOR 500', 1.00, 5.00, false, 1);
INSERT INTO material VALUES ('558F03B7BB8FB2083257', '558CF20D974F95618792', '558EEACADF5573167277', '558CEDA6DC2CA6299748', 'MATAB2083257', 'CONECTOR RG 6', 1.00, 50.00, false, 1);
INSERT INTO material VALUES ('558F03DBD66705579112', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB5579112', 'CONO DE SEGURIDAD', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F04944C1722764283', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB2764283', 'DESTORNILLADOR PALETA PEQUEñA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F04B825B246179600', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB6179600', 'DESTORNILLADOR PALETA GRANDE', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F04CF8686F3873026', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB3873026', 'DESTORNILLADOR PEQUEñO DE ESTRíA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F050C572A86783115', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB6783115', 'DESTORNILLADOR GRANDE DE ESTRíA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F052102E6A9834696', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB9834696', 'EQUALIZADOR PARA EQUIPOS SCIENTIFIC', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F054384BB71959980', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB1959980', 'EQUALIZADOR GIAN MAKER', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0560871926368127', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB6368127', 'ESCALERA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F057DA48F67921506', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB7921506', 'FLEJADORA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F058B7F88C7877031', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB7877031', 'FLEJE 1/2', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F05A3F14325775953', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB5775953', 'FUENTE DE PODER', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F05EB204EC8294095', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB8294095', 'GRAPAS PLáSTICAS RG-6 NEGRA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F061122DF00689111', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB0689111', 'GUAYA PARA HERRAJE', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0629ECFD84052264', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB4052264', 'HEBILLA DE 1/2', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F064ADD2EA6493152', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB6493152', 'HERRAJE', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F065A260EA5093883', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB5093883', 'INSERTADOR DE POTENCIA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0697E32EA0267267', '558CF20D974F95618792', '558EEC0FE98047430005', '558CEDA6DC2CA6299748', 'MATAB0267267', 'MARTILLO', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F06C58AE1F3648125', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB3648125', 'MECHA PARA TALADRO', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F06D95E5267631886', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB7631886', 'MEDIDOR DE CAMPO', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F06EFE98052752742', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB2752742', 'MODULADOR áGIL', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0722F21E13832711', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB3832711', 'MODULADOR FIJO', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F07342C6326650024', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB6650024', 'MONITOR óPTICO (CLOUSORE)', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0758136464446215', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB4446215', 'PALA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F076789D7F6022494', '558CF20D974F95618792', '558EEACADF5573167277', '558CEDA6DC2CA6299748', 'MATAB6022494', 'PASADORES', 1.00, 500.00, false, 1);
INSERT INTO material VALUES ('558F089C69DF28373892', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB8373892', 'PELA CABLE', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F08D093BF69558274', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB9558274', 'PERCHAS CON TORNILLOS', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F08E9756970794314', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB0794314', 'PIQUETA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F08FB0FDD73511820', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB3511820', 'PONCHADORA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0914931D25669832', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB5669832', 'PRECINTOS', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F092ABAEE23388082', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB3388082', 'PREFORMADO', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0949C77732339257', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB2339257', 'PREFORMADO PARA FIBRA óPTICA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0961BDA778367725', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB8367725', 'PROTECTORES DE EMPALME DE F.O. (SMUFF)', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0993804BD9502448', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB9502448', 'QUEMADOR', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F09EC318B55781337', '558CF20D974F95618792', '558EEACADF5573167277', '558CEDA6DC2CA6299748', 'MATAB5781337', 'REDUCTORES DE PIN', 1.00, 500.00, false, 1);
INSERT INTO material VALUES ('558F0A6E31AEE9295094', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB9295094', 'SEPO', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0A943A9B80221213', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB0221213', 'SPLITTER 1X2 DOMICILIARIO', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0AD3501309350716', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB9350716', 'SPLITTER 1X3 DOMICILIARIO', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0AEB8DEC32375718', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB2375718', 'SPLITTER 1X4 DOMICILIARIO', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0AFC9B1470049898', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB0049898', 'SPLITTER 2W INDOOR', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0B9A1D1F84645352', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB4645352', 'SPLITTER 2W OUTDOOR', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0BAFD9D842126215', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB2126215', 'SPLITTER 3W INDOOR', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0BF17C4852396455', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB2396455', 'SPLITTER 3W OUTDOOR', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0C08E857C2450296', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB2450296', 'SPLITTER óPTICO', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0C286ED1C7523997', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB7523997', 'STRAND WIRW P/CABLE 500', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0C577C8A18006027', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB8006027', 'TALADRO', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0C74035080857235', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB0857235', 'TAP 4X11 DB', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0CBA6FB404764471', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB4764471', 'TAP 4X14', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0CCD5280D9474843', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB9474843', 'TAP 4X14 DB', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0CEC6755F3979633', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB3979633', 'TAP 4X17 DB', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0D009060E5104199', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB5104199', 'TAP 4X20 DB', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0D28D47556980082', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB6980082', 'TAP 4X23 DB', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0D4099DE44529042', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB4529042', 'TAP 4X26 DB', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0D5A269797616471', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB7616471', 'TAP 4X8 DB', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0D7B511287855300', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB7855300', 'TAP 8X11 DB', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0D9C676FD5501281', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB5501281', 'TAP 8X14', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0DAEDF5D81172291', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB1172291', 'TAP 8X17 DB', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0DD200EBA8144961', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB8144961', 'TAP 8X20 DB', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0DE5166279913615', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB9913615', 'TAP 8X23 DB', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0DFF2CD107571126', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB7571126', 'TAP 8X26 DB', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0E15A8E8D7389367', '558CF20D974F95618792', '558EEACADF5573167277', '558CEDA6DC2CA6299748', 'MATAB7389367', 'TAPONES PARA CANDADO BOCA TAP', 1.00, 50.00, false, 1);
INSERT INTO material VALUES ('558F0E91612F72941955', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB2941955', 'TENSOR PARA FIBRA óPTICA 0.351 NCM 617', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0F563DA609802785', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB9802785', 'THERMO ENCOGIBLE', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0F81969881815544', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB1815544', 'THERMO ENCOGIBLE/CANUSA', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0F957AA467873313', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB7873313', 'TRANSMISOR óPTICO', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0FAAD1DCD9981574', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB9981574', 'OTROS', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F0FCDF08592460191', '558CF20D974F95618792', '558EEACADF5573167277', '558CEDA6DC2CA6299748', 'MATAB2460191', 'UNIóN KS-KS/CONECTOR KS-KS', 1.00, 100.00, false, 1);
INSERT INTO material VALUES ('558F1018111DE4690767', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB4690767', 'UNIóN RG-11', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F1039099B17528276', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB7528276', 'UNIONES .500', 1.00, 1.00, false, 1);
INSERT INTO material VALUES ('558F104F7874A9644425', '558CF20D974F95618792', '558CEDA6DC2CA6299748', '558CEDA6DC2CA6299748', 'MATAB9644425', 'VARILLA COOPER WELL', 1.00, 1.00, false, 1);


--
-- TOC entry 3016 (class 0 OID 156125)
-- Dependencies: 279
-- Data for Name: motivo_inventario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO motivo_inventario VALUES ('558D7278D84EB6655935', 'INVENTARIO SEMANAL', 'ACTIVO', 1);
INSERT INTO motivo_inventario VALUES ('558D72825330D2439415', 'INVENTARIO MENSUAL', 'ACTIVO', 1);
INSERT INTO motivo_inventario VALUES ('558D72978FB987428323', 'INVENTARIO EVENTUAL', 'ACTIVO', 1);
INSERT INTO motivo_inventario VALUES ('558D726CCDBF82510488', 'INVENTARIO INICIAL', 'INTERNO', 1);
INSERT INTO motivo_inventario VALUES ('558D728C49CB87398557', 'INVENTARIO POR AUDITORIA', 'INTERNO', 1);


--
-- TOC entry 3017 (class 0 OID 156132)
-- Dependencies: 280
-- Data for Name: motivo_movimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO motivo_movimiento VALUES ('558CE2136C65F6040058', 'DEVOLUCIÓN DE MATERIALES', 'ACTIVO', 1, '558CDD7BF22DF0917878');
INSERT INTO motivo_movimiento VALUES ('558CDE146A0AE5962382', 'INVENTARIO INICIAL POR ENTRADAS', 'INTERNO', 1, '558CDD7BF22DF0917878');
INSERT INTO motivo_movimiento VALUES ('558CE1B0685168501001', 'TRANSFERENCIAS ENTRE ALMACENES', 'INTERNO', 1, '558CDD95D59A28310560');
INSERT INTO motivo_movimiento VALUES ('558CE21BB95B77529067', 'COMPRA DE MATERIALES', 'ACTIVO', 1, '558CDD7BF22DF0917878');
INSERT INTO motivo_movimiento VALUES ('558CE28A89A389717250', 'SALIDA DE MATERIAL POR DETERIORO', 'ACTIVO', 1, '558CDD89C0A902954161');
INSERT INTO motivo_movimiento VALUES ('558CE2AA821AB0645797', 'SALIDA DE MATERIAL POR MANTENIMIENTO', 'ACTIVO', 1, '558CDD89C0A902954161');
INSERT INTO motivo_movimiento VALUES ('558CE19FBFAC76643790', 'TRANSFERENCIAS ENTRE ALMACENES', 'SISTEMA', 1, '558CDD89C0A902954161');
INSERT INTO motivo_movimiento VALUES ('558CDE4583D5F6010318', 'TRANSFERENCIAS ENTRE ALMACENES', 'SISTEMA', 1, '558CDD7BF22DF0917878');
INSERT INTO motivo_movimiento VALUES ('558EE8771D0320157028', 'ORDEN DE SERVICIO', 'INTERNO', 1, '558CDD89C0A902954161');


--
-- TOC entry 3018 (class 0 OID 156145)
-- Dependencies: 283
-- Data for Name: movimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3019 (class 0 OID 156160)
-- Dependencies: 285
-- Data for Name: movimiento_material; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3020 (class 0 OID 156225)
-- Dependencies: 303
-- Data for Name: pedido; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3021 (class 0 OID 156233)
-- Dependencies: 304
-- Data for Name: pedido_material; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3022 (class 0 OID 156307)
-- Dependencies: 321
-- Data for Name: responsable; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO responsable VALUES ('AB000001', 'TE001', 'ENT00001', 'INTERNO', 'INTERNO', 1);
INSERT INTO responsable VALUES ('558CDC12B2ACE8357356', '558CDA652FC701114439', 'AA00000003', 'RESPONSABLE DE REALIZAR MOVIMIENTOS DE ENTRADAS, SALIDAS Y TRANSFERENCIAS.', 'ACTIVO', 1);


--
-- TOC entry 3023 (class 0 OID 156362)
-- Dependencies: 335
-- Data for Name: stock_material; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3024 (class 0 OID 156390)
-- Dependencies: 343
-- Data for Name: tipo_movimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipo_movimiento VALUES ('558CDD7BF22DF0917878', 'ENTRADA', 'REGISTRO PARA LAS ENTRADAS DE MATERIALES', 'INTERNO', 1);
INSERT INTO tipo_movimiento VALUES ('558CDD89C0A902954161', 'SALIDA', 'REGISTRO PARA LAS SALIDAS DE MATERIALES', 'INTERNO', 1);
INSERT INTO tipo_movimiento VALUES ('558CDD95D59A28310560', 'TRANSFERENCIA', 'REGISTRO PARA TRANSFERENCIAS ENTRE ALMACENES', 'INTERNO', 1);


--
-- TOC entry 3025 (class 0 OID 156409)
-- Dependencies: 348
-- Data for Name: tipo_responsable; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipo_responsable VALUES ('TE001', 'INTERNO', 'INTERNO', 1);
INSERT INTO tipo_responsable VALUES ('558CDA652FC701114439', 'EMPLEADOS', 'ACTIVO', 1);
INSERT INTO tipo_responsable VALUES ('558CDABEA90346020522', 'OPERACIONES', 'ACTIVO', 1);
INSERT INTO tipo_responsable VALUES ('558CDAC8D10F58205002', 'DESARROLLISTA', 'ACTIVO', 1);
INSERT INTO tipo_responsable VALUES ('558CDAD3C74D63603364', 'ADMINISTRATIVO', 'ACTIVO', 1);
INSERT INTO tipo_responsable VALUES ('558CDAE2D18763040162', 'TECNICOS', 'ACTIVO', 1);
INSERT INTO tipo_responsable VALUES ('558CDAEC4813F1823134', 'PERSONAS EXTERNAS', 'ACTIVO', 1);
INSERT INTO tipo_responsable VALUES ('558CDAF9417D35627951', 'CONTRATISTAS', 'ACTIVO', 1);


--
-- TOC entry 3026 (class 0 OID 156431)
-- Dependencies: 353
-- Data for Name: unidad_medida; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO unidad_medida VALUES ('558CED92107497158724', 'CAJA', 'CAJ', 'ACTIVO', 1);
INSERT INTO unidad_medida VALUES ('558CEDCEA8AF11751456', 'METRO', 'MTS', 'ACTIVO', 1);
INSERT INTO unidad_medida VALUES ('558CEDB5501DD3342227', 'BOBINA', 'BNA', 'ACTIVO', 1);
INSERT INTO unidad_medida VALUES ('558CEDA6DC2CA6299748', 'UNIDAD', 'UNI', 'ACTIVO', 1);
INSERT INTO unidad_medida VALUES ('558EEACADF5573167277', 'BOLSA', 'BOL', 'ACTIVO', 1);
INSERT INTO unidad_medida VALUES ('558EEADBA87402089305', 'KILOGRAMO', 'KGR', 'ACTIVO', 1);
INSERT INTO unidad_medida VALUES ('558EEAF1C3DBA7773912', 'METRO CUADRADO', 'MX2', 'ACTIVO', 1);
INSERT INTO unidad_medida VALUES ('558EEC03A11E01453566', 'METRO CÚBICO', 'MX3', 'ACTIVO', 1);
INSERT INTO unidad_medida VALUES ('558EEC0FE98047430005', 'TONELADA', 'TON', 'ACTIVO', 1);
INSERT INTO unidad_medida VALUES ('558EEC346002E1554680', 'LITRO', 'LTS', 'ACTIVO', 1);


--
-- TOC entry 2735 (class 2606 OID 248612)
-- Name: pk_almacen; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY almacen
    ADD CONSTRAINT pk_almacen PRIMARY KEY (id_alm);


--
-- TOC entry 2737 (class 2606 OID 248668)
-- Name: pk_config_mat; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY config_mat
    ADD CONSTRAINT pk_config_mat PRIMARY KEY (id_c_mat);


--
-- TOC entry 2739 (class 2606 OID 248712)
-- Name: pk_encargado; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY encargado
    ADD CONSTRAINT pk_encargado PRIMARY KEY (id_enc);


--
-- TOC entry 2741 (class 2606 OID 248732)
-- Name: pk_estatus_inv; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY estatus_inventario
    ADD CONSTRAINT pk_estatus_inv PRIMARY KEY (id_est_inv);


--
-- TOC entry 2743 (class 2606 OID 248734)
-- Name: pk_estatus_registro; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY estatus_registro
    ADD CONSTRAINT pk_estatus_registro PRIMARY KEY (id_estatus_reg);


--
-- TOC entry 2745 (class 2606 OID 248740)
-- Name: pk_familia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY familia
    ADD CONSTRAINT pk_familia PRIMARY KEY (id_fam);


--
-- TOC entry 2748 (class 2606 OID 248764)
-- Name: pk_inventario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT pk_inventario PRIMARY KEY (id_inv);


--
-- TOC entry 2750 (class 2606 OID 248766)
-- Name: pk_inventario_materiales; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY inventario_material
    ADD CONSTRAINT pk_inventario_materiales PRIMARY KEY (id_inv_mat);


--
-- TOC entry 2764 (class 2606 OID 248772)
-- Name: pk_mat_solicitado; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pedido_material
    ADD CONSTRAINT pk_mat_solicitado PRIMARY KEY (id_ped_mat);


--
-- TOC entry 2752 (class 2606 OID 248774)
-- Name: pk_material; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY material
    ADD CONSTRAINT pk_material PRIMARY KEY (id_mat);


--
-- TOC entry 2754 (class 2606 OID 248788)
-- Name: pk_motivo_inv; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY motivo_inventario
    ADD CONSTRAINT pk_motivo_inv PRIMARY KEY (id_mot_inv);


--
-- TOC entry 2756 (class 2606 OID 248790)
-- Name: pk_motivo_movimiento; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY motivo_movimiento
    ADD CONSTRAINT pk_motivo_movimiento PRIMARY KEY (id_mot_mov);


--
-- TOC entry 2760 (class 2606 OID 248794)
-- Name: pk_mov_mat; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY movimiento_material
    ADD CONSTRAINT pk_mov_mat PRIMARY KEY (id_mov_mat);


--
-- TOC entry 2758 (class 2606 OID 248796)
-- Name: pk_movimiento; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY movimiento
    ADD CONSTRAINT pk_movimiento PRIMARY KEY (id_mov);


--
-- TOC entry 2766 (class 2606 OID 248846)
-- Name: pk_responsable; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY responsable
    ADD CONSTRAINT pk_responsable PRIMARY KEY (id_res);


--
-- TOC entry 2762 (class 2606 OID 248866)
-- Name: pk_solicitud_pedido; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pedido
    ADD CONSTRAINT pk_solicitud_pedido PRIMARY KEY (id_ped);


--
-- TOC entry 2769 (class 2606 OID 248870)
-- Name: pk_stock_material; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY stock_material
    ADD CONSTRAINT pk_stock_material PRIMARY KEY (id_stock);


--
-- TOC entry 2771 (class 2606 OID 248886)
-- Name: pk_tipo_movimiento; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_movimiento
    ADD CONSTRAINT pk_tipo_movimiento PRIMARY KEY (id_tipo_mov);


--
-- TOC entry 2773 (class 2606 OID 248896)
-- Name: pk_tipo_responsable; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_responsable
    ADD CONSTRAINT pk_tipo_responsable PRIMARY KEY (id_tipo_res);


--
-- TOC entry 2775 (class 2606 OID 248906)
-- Name: pk_unidad_medida; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY unidad_medida
    ADD CONSTRAINT pk_unidad_medida PRIMARY KEY (id_uni);


--
-- TOC entry 2746 (class 1259 OID 249069)
-- Name: inventario_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX inventario_pk ON inventario USING btree (id_inv);


--
-- TOC entry 2767 (class 1259 OID 249084)
-- Name: materiales_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX materiales_pk ON stock_material USING btree (id_stock);


--
-- TOC entry 2776 (class 2606 OID 249245)
-- Name: fk_almacen_encargado; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY almacen
    ADD CONSTRAINT fk_almacen_encargado FOREIGN KEY (id_enc) REFERENCES encargado(id_enc);


--
-- TOC entry 2777 (class 2606 OID 249250)
-- Name: fk_almacen_grupo_trab; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY almacen
    ADD CONSTRAINT fk_almacen_grupo_trab FOREIGN KEY (id_gt) REFERENCES grupo_trabajo(id_gt);


--
-- TOC entry 2779 (class 2606 OID 249370)
-- Name: fk_config_s_reference_franquic; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY config_mat
    ADD CONSTRAINT fk_config_s_reference_franquic FOREIGN KEY (id_franq) REFERENCES franquicia(id_franq) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2780 (class 2606 OID 249460)
-- Name: fk_enc_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY encargado
    ADD CONSTRAINT fk_enc_persona FOREIGN KEY (id_persona) REFERENCES persona(id_persona);


--
-- TOC entry 2797 (class 2606 OID 249480)
-- Name: fk_est_reg; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento
    ADD CONSTRAINT fk_est_reg FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2801 (class 2606 OID 249485)
-- Name: fk_est_reg; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento_material
    ADD CONSTRAINT fk_est_reg FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2781 (class 2606 OID 249490)
-- Name: fk_estatus_reg; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY encargado
    ADD CONSTRAINT fk_estatus_reg FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2794 (class 2606 OID 249495)
-- Name: fk_estatus_reg; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY motivo_inventario
    ADD CONSTRAINT fk_estatus_reg FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2783 (class 2606 OID 249500)
-- Name: fk_estatus_reg; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY familia
    ADD CONSTRAINT fk_estatus_reg FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2790 (class 2606 OID 249505)
-- Name: fk_estatus_reg; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY material
    ADD CONSTRAINT fk_estatus_reg FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2811 (class 2606 OID 249510)
-- Name: fk_estatus_reg; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY stock_material
    ADD CONSTRAINT fk_estatus_reg FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2778 (class 2606 OID 249515)
-- Name: fk_estatus_reg; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY almacen
    ADD CONSTRAINT fk_estatus_reg FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2782 (class 2606 OID 249520)
-- Name: fk_estatus_reg; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estatus_inventario
    ADD CONSTRAINT fk_estatus_reg FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2804 (class 2606 OID 249525)
-- Name: fk_estatus_reg; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pedido
    ADD CONSTRAINT fk_estatus_reg FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2784 (class 2606 OID 249530)
-- Name: fk_estatus_reg; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT fk_estatus_reg FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2805 (class 2606 OID 249535)
-- Name: fk_estatus_reg; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pedido_material
    ADD CONSTRAINT fk_estatus_reg FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2815 (class 2606 OID 249540)
-- Name: fk_estatus_registro; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_responsable
    ADD CONSTRAINT fk_estatus_registro FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2795 (class 2606 OID 249545)
-- Name: fk_estatus_registro; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY motivo_movimiento
    ADD CONSTRAINT fk_estatus_registro FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2814 (class 2606 OID 249550)
-- Name: fk_estatus_registro; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_movimiento
    ADD CONSTRAINT fk_estatus_registro FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2808 (class 2606 OID 249555)
-- Name: fk_estatus_regristro; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY responsable
    ADD CONSTRAINT fk_estatus_regristro FOREIGN KEY (id_estatus_reg) REFERENCES estatus_registro(id_estatus_reg);


--
-- TOC entry 2785 (class 2606 OID 249605)
-- Name: fk_inventar_reference_estatus_inventario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT fk_inventar_reference_estatus_inventario FOREIGN KEY (id_est_inv) REFERENCES estatus_inventario(id_est_inv);


--
-- TOC entry 2788 (class 2606 OID 249610)
-- Name: fk_inventar_reference_inventar; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario_material
    ADD CONSTRAINT fk_inventar_reference_inventar FOREIGN KEY (id_inv) REFERENCES inventario(id_inv) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2786 (class 2606 OID 249615)
-- Name: fk_inventar_reference_motivo_inventario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT fk_inventar_reference_motivo_inventario FOREIGN KEY (id_mot_inv) REFERENCES motivo_inventario(id_mot_inv);


--
-- TOC entry 2789 (class 2606 OID 249620)
-- Name: fk_inventar_reference_stock_ma; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario_material
    ADD CONSTRAINT fk_inventar_reference_stock_ma FOREIGN KEY (id_stock) REFERENCES stock_material(id_stock) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2787 (class 2606 OID 250005)
-- Name: fk_inventar_references_alm; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inventario
    ADD CONSTRAINT fk_inventar_references_alm FOREIGN KEY (id_alm) REFERENCES almacen(id_alm);


--
-- TOC entry 2806 (class 2606 OID 249650)
-- Name: fk_mat_soli_reference_solicitu; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pedido_material
    ADD CONSTRAINT fk_mat_soli_reference_solicitu FOREIGN KEY (id_ped) REFERENCES pedido(id_ped) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2807 (class 2606 OID 249655)
-- Name: fk_mat_soli_reference_stock_ma; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pedido_material
    ADD CONSTRAINT fk_mat_soli_reference_stock_ma FOREIGN KEY (id_stock) REFERENCES stock_material(id_stock) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2791 (class 2606 OID 249660)
-- Name: fk_material_reference_familia; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY material
    ADD CONSTRAINT fk_material_reference_familia FOREIGN KEY (id_fam) REFERENCES familia(id_fam) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2792 (class 2606 OID 249665)
-- Name: fk_material_reference_unidad_m; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY material
    ADD CONSTRAINT fk_material_reference_unidad_m FOREIGN KEY (uni_id_uni) REFERENCES unidad_medida(id_uni) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2793 (class 2606 OID 249670)
-- Name: fk_material_reference_unidad_m2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY material
    ADD CONSTRAINT fk_material_reference_unidad_m2 FOREIGN KEY (id_uni) REFERENCES unidad_medida(id_uni) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2800 (class 2606 OID 250000)
-- Name: fk_mov_alm; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento
    ADD CONSTRAINT fk_mov_alm FOREIGN KEY (id_alm) REFERENCES almacen(id_alm);


--
-- TOC entry 2802 (class 2606 OID 249700)
-- Name: fk_mov_mat_reference_movimiento; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento_material
    ADD CONSTRAINT fk_mov_mat_reference_movimiento FOREIGN KEY (id_mov) REFERENCES movimiento(id_mov);


--
-- TOC entry 2803 (class 2606 OID 249705)
-- Name: fk_mov_mat_reference_stock_ma; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento_material
    ADD CONSTRAINT fk_mov_mat_reference_stock_ma FOREIGN KEY (id_stock) REFERENCES stock_material(id_stock) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2798 (class 2606 OID 249710)
-- Name: fk_mov_res; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento
    ADD CONSTRAINT fk_mov_res FOREIGN KEY (id_res) REFERENCES responsable(id_res);


--
-- TOC entry 2799 (class 2606 OID 249715)
-- Name: fk_mov_tipo_mov; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento
    ADD CONSTRAINT fk_mov_tipo_mov FOREIGN KEY (id_tipo_mov) REFERENCES tipo_movimiento(id_tipo_mov);


--
-- TOC entry 2809 (class 2606 OID 249767)
-- Name: fk_persona_responsable; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY responsable
    ADD CONSTRAINT fk_persona_responsable FOREIGN KEY (id_persona) REFERENCES persona(id_persona);


--
-- TOC entry 2810 (class 2606 OID 249782)
-- Name: fk_responsa_reference_tipo_res; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY responsable
    ADD CONSTRAINT fk_responsa_reference_tipo_res FOREIGN KEY (id_tipo_res) REFERENCES tipo_responsable(id_tipo_res) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2812 (class 2606 OID 249842)
-- Name: fk_stock_ma_reference_almacen; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY stock_material
    ADD CONSTRAINT fk_stock_ma_reference_almacen FOREIGN KEY (id_alm) REFERENCES almacen(id_alm) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2813 (class 2606 OID 249847)
-- Name: fk_stock_ma_reference_material; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY stock_material
    ADD CONSTRAINT fk_stock_ma_reference_material FOREIGN KEY (id_mat) REFERENCES material(id_mat) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2796 (class 2606 OID 249867)
-- Name: fk_tipo_movimiento; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY motivo_movimiento
    ADD CONSTRAINT fk_tipo_movimiento FOREIGN KEY (id_tipo_mov) REFERENCES tipo_movimiento(id_tipo_mov);


-- Completed on 2015-06-29 15:40:41

--
-- PostgreSQL database dump complete
--

