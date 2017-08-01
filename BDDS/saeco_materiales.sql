--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.5
-- Dumped by pg_dump version 9.3.5
-- Started on 2015-06-08 10:35:19

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
-- TOC entry 254 (class 1259 OID 17204)
-- Name: modulo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE modulo (
    codigomodulo character(8) NOT NULL,
    nombremodulo character(25),
    namemodulo character(25),
    descripcionmodulo text,
    statusmodulo character(15)
);


ALTER TABLE public.modulo OWNER TO postgres;

--
-- TOC entry 256 (class 1259 OID 17216)
-- Name: modulo_perfil; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE modulo_perfil (
    codigoperfil character(8) NOT NULL,
    codigomodulo character(8) NOT NULL,
    incluir character(5),
    modificar character(5),
    eliminar character(5)
);


ALTER TABLE public.modulo_perfil OWNER TO postgres;

--
-- TOC entry 285 (class 1259 OID 17309)
-- Name: perfil; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE perfil (
    codigoperfil character(8) NOT NULL,
    nombreperfil character(25),
    descripcionperfil text,
    statusperfil character(15)
);


ALTER TABLE public.perfil OWNER TO postgres;

--
-- TOC entry 288 (class 1259 OID 17324)
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuario (
    login character(25) NOT NULL,
    id_persona character(10),
    codigoperfil character(8),
    password character(50),
    statususuario character(15),
    inicial character(2),
    id_franq character(5),
    id_usuario character(10) NOT NULL,
    id_servidor character(10)
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- TOC entry 326 (class 1259 OID 17458)
-- Name: usuario_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuario_id_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_id_usuario_seq OWNER TO postgres;

--
-- TOC entry 2840 (class 0 OID 0)
-- Dependencies: 326
-- Name: usuario_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuario_id_usuario_seq OWNED BY usuario.id_usuario;


--
-- TOC entry 2607 (class 2604 OID 17911)
-- Name: id_usuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario ALTER COLUMN id_usuario SET DEFAULT nextval('usuario_id_usuario_seq'::regclass);


--
-- TOC entry 2831 (class 0 OID 17204)
-- Dependencies: 254
-- Data for Name: modulo; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU053 ', 'RESPALDAR                ', 'RESPALDAR                ', 'RESPALDAR BASE DE DATOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU054 ', 'RESTAURAR                ', 'RESTAURAR                ', 'RESTAURAR BASE DE DATOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU013 ', 'CERRAR PUNTO DE COBRO    ', 'CERRAR_CAJA              ', 'CERRAR_CAJA', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU016 ', 'COMENTARIO CLIENTE       ', 'COMENTARIO_CLIENTE       ', 'COMENTARIO_CLIENTE', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU044 ', 'CORTE DE SERVICIO        ', 'STATUS_CONTRATO          ', 'STATUS_CONTRATO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU061 ', 'ESTADISTICAS DE TECNICOS ', 'EST_TEC                  ', 'ESTADISTICAS DE TECNICOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU060 ', 'ESTADISTICAS DE ORDENES  ', 'EST_ORD                  ', 'ESTADISTICAS DE ORDENES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU059 ', 'ESTADISTICAS DE CLIENTES ', 'EST_CLI                  ', 'ESTADISTICAS DE CLIENTES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU058 ', 'ESTADISTICAS DE INGRESOS ', 'EST_ING                  ', 'ESTADISTICAS DE INGRESOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU062 ', 'LEER SMS                 ', 'LEER_SMS                 ', 'LEER SMS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU077 ', 'CONTRATO_SER             ', 'CONTRATO_SER             ', 'CONTRATO SERVICIO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU026 ', 'MATERIALES               ', 'MATERIALES               ', 'MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU025 ', 'INVENTARIO DE MATERIALES ', 'INVENTARIO               ', 'INVENTARIO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU021 ', 'ENTRADA DE MATERIALE     ', 'ENT_SAL_MAT              ', 'ENTRADA Y SALIDA DE MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU079 ', 'MOTIVO_INV               ', 'MOTIVO_INV               ', 'MOTIVO DE INVENTARIO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU080 ', 'FAMILIA                  ', 'FAMILIA                  ', 'FAMILIA DE MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU081 ', 'INVENTARIO_MATERIALES    ', 'INVENTARIO_MATERIALES    ', 'INVENTARIO DE MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU082 ', 'DEPOSITO                 ', 'DEPOSITO                 ', 'DEPOSITO DE MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU083 ', 'UNIDAD_MEDIDA            ', 'UNIDAD_MEDIDA            ', 'UNIDAD_MEDIDA DE LOS MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00003 ', 'FRANQUICIA               ', 'FRANQUICIA               ', 'REGISTRO DE UNA NUEVA FRANQUICIA', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00007 ', 'ZONA                     ', 'ZONA                     ', 'ADMINISTRACION DE LAS ZONAS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00024 ', 'DETALLE ORDEN            ', 'DETALLE_ORDEN            ', 'DETALLES DE LAS ORDENES DE SERVICIOS Y RECLAMOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00008 ', 'SECTOR                   ', 'SECTOR                   ', 'ADMINISTRACION DE SECTORES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00050 ', 'BANCO                    ', 'BANCO                    ', 'ADMINISTRACION DE LOS  BANCOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00010 ', 'CALLE                    ', 'CALLE                    ', 'ADMINISTRACION DE CALLES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00011 ', 'EDIFICIO                 ', 'EDIFICIO                 ', 'ADMINISTRACION DE LOS EDIFICIOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00012 ', 'TECNICO                  ', 'TECNICO                  ', 'ADMINISTRACION DE LOSTECNICOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00013 ', 'COBRADOR                 ', 'COBRADOR                 ', 'ADMINISTRACIONS DE LOS COBRADORES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00014 ', 'VENDEDOR                 ', 'VENDEDOR                 ', 'ADMINISTRACION DE LOS VENDEDORES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00026 ', 'TIPO DE ORDEN            ', 'TIPO_ORDEN               ', 'ADMINISTRACION DE LOS TIPOS DE ORDENES DE SERVICIOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00028 ', 'TARIFAS Y SERVICIOS      ', 'SERVICIOS                ', 'ADMINISTRACION DE LOS PLANES Y SERVICIOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00032 ', 'TARIFA SERVICIO          ', 'TARIFA_SERVICIO          ', 'REGISTRAR LA TARIFA DE LOS PLANES Y/O SERVICOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00036 ', 'STATUS DEL CONTRATO      ', 'STATUS_CONTRATO          ', 'ADMINISTRAR LOS STAUS DE LOS CONTRATOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00054 ', 'PARAMETROS GENERALES     ', 'PARAMETROS               ', 'CONFIGURACION DE LOS PARAMETROS GENERALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00048 ', 'FORMA DE PAGO            ', 'TIPO_PAGO                ', 'ADMINISTRACION DE LA FORMA DE PAGOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00062 ', 'ABRIR PUNTO DE COBRO     ', 'CAJA_COBRADOR            ', 'ABRIR PUNTOS DE COBROS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00064 ', 'COBRAR POR PUNTO DE COBRO', 'PAGOS                    ', 'COBRARAR POR PUNTO DE COBRO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00066 ', 'CIRRE DIARIO             ', 'CIRRE_DIARIO             ', 'CIRRE_DIARIO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00072 ', 'IMPRIMIR ORDENES         ', 'IMPRIMIR_ORDENES_TECNICOS', 'IMPRIMIR ORDENES DE SERVICIOS Y / RECLAMOS Y ASIGNARLO A TECNICO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00074 ', 'FINAL ORDENES            ', 'FINAL_ORDENES_TECNICOS   ', 'FINAL ORDENES DE SERVICIOS Y/O RECLAMOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00076 ', 'CARGAR DEUDA             ', 'CARGAR_DEUDA             ', 'CARGAR DEUDA DE COSTO UNICO Y MENSUAL', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00118 ', 'REIMPRIMIR ULTIMA FACTURA', 'REIMP_FACTURA            ', 'REIMPRIMIR ULTIMA FACTURA DE PAGO POR IMPRESORA MATRIZIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00120 ', 'REIMPRIMIR UNA ORDENES   ', 'REIMP_ORDENES            ', 'REIMPRIMIR CUALQUIER ORDEN DE UN ABONADO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU666 ', 'REIMPRIMIR CIERRE DIARIO ', 'REP_CIERREDIARIO         ', 'REIMPRIMIR EL CIERRE DIARIO DE UN FRAQUICIA', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00124 ', 'REIMPRIMIR CIERRE DIARIO ', 'REIMP_CIERRE_DIARIO      ', 'REIMP_CIERRE_DIARIO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00126 ', 'REIMPRIMIR CIERRE CAJA   ', 'REIMP_CIERRE_CAJA        ', 'REIMP_CIERRE_CAJA', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU084 ', 'TIPO_MOVIMIENTO          ', 'TIPO_MOVIMIENTO          ', 'TIPO MOVIMIENTO DE MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU085 ', 'MOVIMIENTO               ', 'MOVIMIENTO               ', 'MOVIMIENTO DE MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU086 ', 'PROVEEDOR                ', 'PROVEEDOR                ', 'PROVEEDOR', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU087 ', 'PEDIDO                   ', 'PEDIDO                   ', 'PEDIDO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU088 ', 'MATERIALES               ', 'MATERIALES               ', 'MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU089 ', 'MOV_MAT                  ', 'MOV_MAT                  ', 'MOVIMIENTO DE MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU090 ', 'MAT_PROV                 ', 'MAT_PROV                 ', 'MATERIAL PROVEEDOR', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU091 ', 'MAT_PED                  ', 'MAT_PED                  ', 'MATERIAL PEDIDO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU092 ', 'CONFIR_PEDIDO            ', 'CONFIR_PEDIDO            ', 'CONFIRMAR PEDIDO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU093 ', 'REPORTEPEDIDO            ', 'REP_REPORTEPEDIDO        ', 'REPORTE PEDIDO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU094 ', 'REGISTRAR_COMPRA         ', 'REALIZAR_COMPRA          ', 'REGISTAR COMPRA DE MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU095 ', 'INVENTARIO               ', 'INVENTARIO               ', 'INVENTARIO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU096 ', 'APROBAR INVENTARIO       ', 'APROBARINVENTARIO        ', 'APROBAR_INVENTARIO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU097 ', 'MAT_PADRE                ', 'MAT_PADRE                ', 'MATERIALES PADRE, ES EL CONTENEDOR DE TODOS LOS MATERIALES ASOCIADOS A SU DEPOSITO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU098 ', 'MATPADRE                 ', 'REP_MATPADRE             ', 'REPORTE DE MATERIALES PADRES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU099 ', 'PROVEEDORES              ', 'REP_PROVEEDORES          ', 'REPORTE DE PROVEEDORES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU100 ', 'MATERIALES UNI INV       ', 'REP_MATERIALESUNIINV     ', 'REPORTE MATERIALES UNI INV', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU101 ', 'PLANILLAMOV              ', 'REP_PLANILLAMOV          ', 'REPORTE PLANILLA MOVIMIENTO DE MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU102 ', 'PLANILLAPED              ', 'REP_PLANILLAPED          ', 'REPORTE PLANILLA PEDIDO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU103 ', 'PLANILLAINV              ', 'REP_PLANILLAINV          ', 'REP PLANILLA INVENTARIO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU104 ', 'REPORTEMOVIMIENTO        ', 'REP_REPORTEMOVIMIENTO    ', 'REPORTE MOVIMIENTO DE MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU105 ', 'REPORTEINVENTARIO        ', 'REP_REPORTEINVENTARIO    ', 'REPORTE DE INVENTARIO DE MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU106 ', 'RECORD DE MATERIALES     ', 'RECORD                   ', 'REPORTE RECORD  MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU200 ', 'LEER SMS                 ', 'LEER_SMS                 ', 'LEER MENSAJES DE TEXTO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU201 ', 'ENVIAR SMS UNICO         ', 'ENVIAR_SMS_UNICO         ', 'ENVIAR SMS UNICO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU202 ', 'ENVIAR SMS LOTES         ', 'ENVIAR_SMS_LOTES         ', 'ENVIAR SMS EN LOTES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU203 ', 'CONFIGURAR SMS           ', 'CONFIG_SMS               ', 'CONFIGURAR SMS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU204 ', 'VARIABLE SMS             ', 'VARIABLE_SMS             ', 'VARIABLE SMS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU205 ', 'PLANTILLA ENVIO          ', 'FORMATO_SMS              ', 'PLANTILLA DE ENVIO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU206 ', 'REVISAR LISTADO SMS      ', 'REV_LISTADO_SMS          ', 'REVISAR LISTADO SMS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU207 ', 'ADMINISTRAR SMS          ', 'ADMIN_SMS                ', 'ADMINISTRAR SMS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU208 ', 'CONFIGURAR COMANDO SMS   ', 'COMANDO_SMS              ', 'CONFIG COMANDO SMS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU209 ', 'CONFIGURAR ENVIO SMS     ', 'ENVIO_SMS                ', 'CONFIG ENVIO SMS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU210 ', 'ENVIAR SMS EXCEL         ', 'ENVIAR_SMS_EXCEL         ', 'ENVIAR SMS EXCEL', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU301 ', 'HOSPEDAJE                ', 'HOSPEDAJE                ', 'HOSPEDAJE', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU302 ', 'ACTUALIZAR DATOS         ', 'ACT_DATOS                ', 'ACTUALIZAR LOS DATOS DE UN CLIENTE POR MODULO DE COBRANZA', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU303 ', 'ASIGNAR ORDEN POR COBRO  ', 'ORDENES_TECNICOS2        ', 'ASIGNAR ORDENES DE SERVICIOS POR COBRO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU311 ', 'DECODIFICADORES ANALOGICO', 'DECO_ANA                 ', 'ADMINISTRACION DE DECODIFICADORES ANALOGICOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU304 ', 'ASIGNAR ORDEN ACTUALIZAR ', 'ORDENES_TECNICOS1        ', 'ASIGNAR ORDENES POR ACTUALIZAR DATOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU15  ', 'CABLE MODEM              ', 'CALEMODEN                ', 'ADMINISTRACION DE CABLE MODEM', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU16  ', 'CONSULTAR CIERRE DIARIO  ', 'CIERRE_CONSULTA          ', 'CONSULTAR EL CIERRE DIARIO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU306 ', 'INTERFAZ ACC             ', 'DECO_ANA                 ', 'INTERFAZ DEL ACC', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU313 ', 'ORD. DE SER. COMPLETO    ', 'REP_ORDENESCOMPLETO      ', 'REPORTE DE ORDENES DE SERVICIO COMPLETO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU316 ', 'HISTORIAL DE PAGOS       ', 'REP_HISTORIALDEPAGOS     ', 'REPORTE DEL HISTORIAL DE PAGOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU318 ', 'REIMPRIMIR FACTURA       ', 'REIM_FACTURA             ', 'REIMPRIMIR ULTIMA FACTUAR', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU317 ', 'ORDEN DE SERVICO CLIENTE ', 'REIMP_ESTADODECUENTA     ', 'REPORTE DEL HISTORIA L DE ORDENES ', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU319 ', 'REIMPRIMIR ORDENES SERV  ', 'REIMP_ORDENES            ', 'REIMPRIMIR LAS ORDENES DE SERVICIOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU320 ', 'REIMPRIMIR CIERRE DIARIO ', 'REIMP_CIERRE_DIARIO      ', 'REIMPRIMIR CIERRE DIARIO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00005 ', 'MUNICIPIO                ', 'MUNICIPIO                ', 'ADMINISTRACION DE LOS  MUNICIPIOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00004 ', 'ESTADOS                  ', 'ESTADO                   ', 'REGISTRO DE UN NUEVO ESTADO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00009 ', 'URBANIZACION             ', 'URBANIZACION             ', 'ADMINISTRACION DE URBANIZACION', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00038 ', 'MOTIVOS  NOTA            ', 'MOTIVO_NOTA              ', 'ADMINISTRACION DE MOTIVO NOTA', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00040 ', 'GRUPO DE AFINIDAD        ', 'GRUPO_AFINIDAD           ', 'ADMINISTRACION DE LOS GRUPOS DE AFINIDAD', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00068 ', 'CIERRE ESTACION TRABAJO  ', 'CIERRE_ESTACION          ', 'CIERRE DE ESTACION DE TRABAJO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00078 ', 'CARGAR DEUDA ACTUALIZAR  ', 'CARGAR_DEUDA1            ', 'CARGAR DEUDA POR ACTUALIZACION DE DATOS DEL CLIENTE', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00096 ', 'DESCUENTO POR LOTES      ', 'DESCUENTO_LOTES          ', 'DESCUENTO POR LOTES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00086 ', 'MODIFICAR NRO FACTURA    ', 'MODIFICAR_FACT           ', 'MODIFICAR EL NUEMERO DE  FACTURA DE UN PAGO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00142 ', 'REPORTE DE RECUPERADOS   ', 'REP_RECUPERADOS          ', 'REPORTE DE CLIENTES RECUPERADOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00138 ', 'REPORTE ORDEN SERVICIOS  ', 'REP_ORDENES              ', 'REPORTE DE LAS ORDENES DE SERVICIOS Y RECLAMOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00144 ', 'REPORTE POR COBRADOR     ', 'REP_COBRADOR             ', 'REPORTE DE COBRANZA DE UN COBRADOR', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU13  ', 'PRESINTO                 ', 'PRESINTOS                ', 'ADMINSTRACION DE PRECINTOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU322 ', 'MODIFICAR_GRUPO_ORDEN    ', 'MODIFICAR_GRUPO_ORDEN    ', 'MODIFICAR_GRUPO_ORDEN', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AUT001  ', 'PERMITE CIERRE CAJA      ', 'PERMITE CIERRE CAJA      ', 'PERMITE CIERRE CAJA', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00001 ', 'NUEVO CONTRATO           ', 'CONTRATO                 ', 'PARA REGISTRAR NUEVOS CONTRATOS EN SAECO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00002 ', 'ACTUALIZAR CONTRATOS     ', 'ACT_CONTRATO             ', 'ACTUALIZAR DATOS DEL CLIENTE P. PERSONALES, DIRECCIONES, DATOS DE CONTRATOS Y CARGOS.', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00006 ', 'CIUDAD                   ', 'CIUDAD                   ', 'ADMINISTRACIOS DE CIUDADES ', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00016 ', 'GERENTES                 ', 'GERENTES                 ', 'ADMINISTRACION DE LOS GERENTES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00030 ', 'TIPO SERVICIO            ', 'TIPO_SERVICIO            ', 'ADMINISTRACION DE LOS TIPOS DE SERVICIOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00052 ', 'CAJAS DE COBROS          ', 'CAJA                     ', 'ADMINISTRACION DE LAS CAJAS DE COBROS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00056 ', 'REIMPRIMIR FACTURA FISCAL', 'REIMPRIMIR FACTURA FISCAL', 'REIMPRIMIR FACTURA FISCAL', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00060 ', 'PROMOCIONES              ', 'PROMOCIONES              ', 'REGISTRO DE LA PROMOCIONES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU001 ', 'MODULOS                  ', 'MODULO                   ', 'ADMINISTAR MODULO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU005 ', 'ACTUALIZAR PAGOS         ', 'ACTUALIZAR_PAGOS         ', 'ACTUALIZAR_PAGOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU008 ', 'AVISO COBRO              ', 'AVISO_COBRO              ', 'AVISO_COBRO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU019 ', 'DETALLE TIPO PAGO        ', 'DETALLE_TIPOPAGO         ', 'DETALLE_TIPOPAGO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU035 ', 'REPORTE  DETALLE COBROS  ', 'REP_DETALLECOBROS        ', 'REPORTE DETALLE COBROS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU036 ', 'REPORTE DE ESTADO CUENTA ', 'REP_ESTADOCUENTA         ', 'REPORTE DE ESTADO DE CUENTA DEL CLIENTE', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU037 ', 'REPORTE HISTORIAL PAGO   ', 'REP_HISTORIALPAGO        ', 'REPORTE DE HISTORIAL DE PAGO DEL CLIENTE', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU039 ', 'REPORTE TOTAL CLIENTES   ', 'REP_TOTALCLIENTES        ', 'REPORTE DE TOTAL DE CLIENTES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU040 ', 'SALIDA DE MATERIALES     ', 'SAL_MAT                  ', 'SALIDA DE MATERIALES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU043 ', 'SESION                   ', 'SESION                   ', 'SESION', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU002 ', 'PERFIL                   ', 'PERFIL                   ', 'ADMINISTAR PERFIL', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU052 ', 'ACTUALIZAR MONTO PAGO    ', 'ACTUALIZAR_CAMPO         ', 'ACTUALIZAR MONTO DE PAGO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00070 ', 'ASIGNAR ORDENES-RECLAMOS ', 'ORDENES_TECNICOS         ', 'ASIGNAR LAS ORDENES DE SERVICIOS Y / O RECLAMOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00080 ', 'CONSULTAR PAGOS          ', 'CONSULTAR_PAGOS          ', 'CONSULTAR PAGOS REALIZADOS CON EL NUMERO DE FACTURA O ID DEL PAGO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00082 ', 'ANULAR O ELIMIAR  PAGOS  ', 'ANULAR_PAGOS             ', 'ANULAR O ELIMINAR  PAGOS REALIZADO HACIENDO LA NOTA DE CREDITO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00128 ', 'ARCHIVOS ALMALCENADOS    ', 'REIMP_ARCIVO             ', 'REPORTE ARCHIVOS ALMACENADOS PARA ENVIAR A GERENCIA', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00132 ', 'CLIENTES POR ZONAS       ', 'REPORTE_CLI_ZONA         ', 'REPORTE DE CLIENTES POR ZONAS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00130 ', 'CLIENTES POR FRANQUICIA  ', 'REPORTE_CLI_FRAN         ', 'REPORTE DE LOS ESTATUS DE LOS CLIENTES POR FRANQUICIAS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00134 ', 'CLIENTES POR SECTORES    ', 'REPORTE_CLI_SECTORES     ', 'REPORTE DE CLIENTES POR SECTORES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00140 ', 'REPORTE DE NOTAS         ', 'REP_NOTAS                ', 'REPORTE DE NOTAS DE CREDITOS Y NOTAS DE DEBITOS DE UN CARGO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU315 ', 'ZZDSDADSAS               ', 'REP_NOTAS                ', 'REPORTE DE INFORME DE NOTAS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00148 ', 'REPORTE POR VENDEDOR     ', 'REP_VENDEDOR             ', 'REPORTE DE COBRANZA DE UN VENDEDOR', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00150 ', 'INGRESO POR SERVICIOS    ', 'INGRESO_X_SERV           ', 'REPORTE DE INGRESOS POR SERVICIOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00152 ', 'ANALISIS DE  VENCIMIENTO ', 'ANALISIS_VEN             ', 'REPORTE DE ANALISIS DE VENCIMIENTOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00154 ', 'REPORTE DE BITACORA      ', 'BITACORA                 ', 'REPORTE DE BITACORAS POR USUARIOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00158 ', 'REP. DE FACTURA-CONTRATOS', 'REP_FACTURAS             ', 'REPORTE DE FACTURAS Y CONTRATOS ENTREGADOS, RECIBIDOS Y FACTURADOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU400 ', 'AUTORIZAR CREDITO/DEBITO ', 'AUTORIZAR CREDITO/DEBITO ', 'AUTORIZAR CREDITO/DEBITO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU003 ', 'USUARIO                  ', 'USUARIO                  ', 'ADMINISTRAR USUARIO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00112 ', 'REPORTE LIBRO DE VENTA   ', 'REP_LIBROVENTA           ', 'REPORTE DEL LIBRO DEVENTAS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU300 ', 'HABITACION               ', 'HABITACION               ', 'HABITACION', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00084 ', 'MODIFICAR FORMA DE PAGOS ', 'FORMA_PAGOS              ', 'MODIFICAR LA FORMA DE PAGO DE UNA FACTURA', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00090 ', 'REGISTRAR PAGO DEPOSITO  ', 'REGISTRAR PAGO DEPOSITO  ', 'REGISTRAR PAGO DEPOSITO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00092 ', 'CONFIRMAR PAGO DEPOSITO  ', 'CONFIRMAR PAGO DEPOSITO  ', 'CONFIRMAR PAGO DEPOSITO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00094 ', 'PROCESAR PAGO DEPOSITO   ', 'PROCESAR PAGO DEPOSITO   ', 'PROCESAR PAGO DEPOSITO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00098 ', 'AGREGAR PROMOCIONES      ', 'AREGAR_PROMOCION         ', 'AGREGAR PROMOCIONES A LOS CONTRATOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00100 ', 'CONVENIOS DE PAGOS       ', 'CONVENIO_PAGO            ', 'CONVENIOS DE PAGOS CON UN CLIENTES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00102 ', 'PROCESO DE CORTE         ', 'PROCESO_CORTE            ', 'ADMINISTRAR LOS PROCESOS DE CORTES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00104 ', 'ASIGNAR RECIBO DE COBROS ', 'ASIGNAR_RECIBO           ', 'ASIGNAR FACTURAS A LOS COBRADORES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00106 ', 'ASIGNAR CONTRATOS        ', 'ASIGNAR_CONTRATO         ', 'ASIGNAR CONTRATOS A LOS VENDEDORES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00108 ', 'RECIBIR CONTRATOS        ', 'RECIBIR_CONTRATO         ', 'RECIBIR LOS CONTRATOS A LOS VENDEDORES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00105 ', 'RECIBIR RECIBOS DE COBROS', 'RECIBIR_RECIBO           ', 'RECIBIR RECIBOS DE COBROS A LOS COBRADORES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00110 ', 'LISTADOR DE ABONADOS     ', 'LISTADO_ABONADOS         ', 'REPORTE DE LOS ABONADO Y REPORTES IMPRESO, AVISOS DE COBROS Y PROCESO DE CORTE', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00136 ', 'CLIENTES POR CALLES      ', 'REPORTE_CLI_SECTORES     ', 'REPORTE DE TOTAL CLIENTES POR CALLES', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00018 ', 'GRUPO DE TRABAJOS        ', 'GRUPO_TRABAJO            ', 'ADMINISTRACION DE GRUPOS DE TRABAJOS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00116 ', 'REPORTE FISCAL X Y Z     ', 'REPORTE_FISCAL           ', 'SACAR REPORTE X Y Z Y FACTURAS POR RANGO DE FECHAS', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MODU327 ', 'SDFSDF                   ', 'REPORTE FISCAL           ', 'REPORTE FISCAL', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('AA00114 ', 'REPORTE RESUMEN TECNICA  ', 'REP_RESUMEN_TEC          ', 'REPORTE DEL DEPARTAMENTO TECNICO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('CODU001 ', 'MODIFICAR CEDULA         ', 'MODIFICAR_CEDULA         ', 'MODIFICAR LA CEDULA DEL CLIENTE', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('CODU002 ', 'MODIFICAR PRECINTO       ', 'MODIFICAR_PRECINTO       ', 'MODIFICAR LA PRECINTO DEL CLIENTE', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('CODU003 ', 'MODIFICAR POSTE          ', 'MODIFICAR_POSTE          ', 'MODIFICAR LA POSTE DEL CLIENTE', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('CODU004 ', 'MODIFICAR PUNTO ADICIONAL', 'MODIFICAR_PUNTOADI       ', 'MODIFICAR EL PUNTO ADICIONAL DEL CLIENTE', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('CODU005 ', 'MODIFICAR NRO ABONADO    ', 'MODIFICAR_NRO_ABONADO    ', 'MODIFICAR EL NRO_ABONADO DEL CLIENTE', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('CODU006 ', 'MODIFICAR CONTRATO FISICO', 'MODIFICAR_CONTRATO_FISICO', 'MODIFICAR EL CONTRATO FISICO DEL CLIENTE', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('CODU007 ', 'AGREGAR SUSCRIPCION      ', 'AGREGAR_SUSCRIPCION      ', 'AGREGAR SUSCRIPCION DEL CLIENTE', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU021  ', 'MODIFICAR_CEDULA         ', 'MODIFICAR_CEDULA         ', 'MODIFICAR_CEDULA', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU015  ', 'MODIFICAR_PRECINTO       ', 'MODIFICAR_PRECINTO       ', 'MODIFICAR_PRECINTO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU012  ', 'LLAMADAS                 ', 'LLAMADAS                 ', 'LLAMADAS                 ', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU014  ', 'TIPO RESPUESTA           ', 'TIPO_RESP                ', 'TIPO RESPUESTA                ', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU016  ', 'MODIFICAR_POSTE          ', 'MODIFICAR_POSTE          ', 'MODIFICAR_POSTE', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU017  ', 'MODIFICAR_PUNTOADI       ', 'MODIFICAR_PUNTOADI       ', 'MODIFICAR_PUNTOADI', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU018  ', 'MODIFICAR_NRO_ABONADO    ', 'MODIFICAR_NRO_ABONADO    ', 'MODIFICAR_NRO_ABONADO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU019  ', 'MODIFICAR_CONTRATO_FISICO', 'MODIFICAR_CONTRATO_FISICO', 'MODIFICAR_CONTRATO_FISICO', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU020  ', 'AGREGAR_SUSCRIPCION      ', 'AGREGAR_SUSCRIPCION      ', 'AGREGAR_SUSCRIPCION', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU013  ', 'DETALLE_RESPUESTA        ', 'DETALLE_RESPUESTA        ', 'DETALLE_RESPUESTA', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU009  ', 'ASIGNA LLAMADA           ', 'ASIGNA_LLAMADA           ', 'ASIGNA LLAMADA', 'ACTIVO         ');
INSERT INTO modulo (codigomodulo, nombremodulo, namemodulo, descripcionmodulo, statusmodulo) VALUES ('MOU011  ', 'TIPO LLAMADA             ', 'TIPO_LLAMADA             ', 'TIPO LLAMADA             ', 'ACTIVO         ');


--
-- TOC entry 2832 (class 0 OID 17216)
-- Dependencies: 256
-- Data for Name: modulo_perfil; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU302 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU052 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00098 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00152 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00128 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU304 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00070 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU303 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU400 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00136 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00130 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00134 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00132 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00013 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU016 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00092 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU16  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU077 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00100 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU044 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00096 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00024 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MOU013  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU019 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU021 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU059 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU058 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU061 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00074 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00048 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00018 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU316 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00072 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00150 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00110 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MOU012  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU313 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU317 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU087 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU103 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00062 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU101 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU099 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00108 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00090 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU319 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00120 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00158 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00154 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU036 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00140 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00142 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU035 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00116 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU037 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00112 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00138 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU093 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00144 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00148 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00114 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU039 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU053 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU054 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU206 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU327 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU043 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00032 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00028 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00012 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MOU011  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MOU014  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'AA00030 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU083 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF034 ', 'MODU315 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU302 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU052 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00098 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00152 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00128 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU304 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00070 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU303 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU400 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00050 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00076 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00078 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00136 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00130 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00134 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00132 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00013 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU016 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00092 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU16  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU077 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00100 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU044 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00096 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00024 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MOU013  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU019 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU021 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU302 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00098 ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00152 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00082 ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MOU009  ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU304 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00070 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU303 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00010 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00076 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00078 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU013 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00136 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00130 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00134 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00132 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00064 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU016 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU077 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU044 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00024 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MOU013  ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU019 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00011 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00004 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00074 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU316 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00072 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00110 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MOU012  ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00038 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU317 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AUT001  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00102 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00108 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00090 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00126 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU318 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00056 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU319 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00118 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00120 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00158 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU059 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU058 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU061 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00074 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00048 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00018 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU316 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00072 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00150 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00110 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MOU012  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU313 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU317 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU087 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU103 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU101 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU099 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00108 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00090 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU319 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00120 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00158 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00154 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU036 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00140 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00142 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU035 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00116 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU037 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00112 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00138 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU093 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00144 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00154 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU036 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00140 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00142 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU035 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00116 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU037 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00112 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00138 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00144 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00148 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00114 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MODU039 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00036 ', 'FALSE', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00012 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00148 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00114 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU039 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU053 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU054 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU206 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU327 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU043 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00032 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00028 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00012 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MOU011  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MOU014  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'AA00030 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU083 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF035 ', 'MODU315 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'CODU007 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU302 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU052 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00098 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'CODU007 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MOU020  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00152 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00082 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00128 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU304 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MOU020  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MOU009  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MODU304 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00070 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MODU303 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MODU008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00076 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00078 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00130 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00132 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00024 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MODU019 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MODU202 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MODU201 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00074 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00018 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MODU316 ', 'TRUE ', 'FALSE', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00072 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MODU062 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MODU200 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00110 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MOU012  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'CODU001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MOU021  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'CODU006 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MOU019  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MODU322 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'CODU003 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MOU016  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'MODU317 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00102 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00108 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00138 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00114 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF032 ', 'AA00026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00070 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU303 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU400 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00050 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00052 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00076 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00078 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00136 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00130 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00134 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00132 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00013 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU016 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00092 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU16  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU077 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00100 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU044 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00096 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00024 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MOU013  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU019 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU021 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU202 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU201 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU059 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU058 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00074 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00048 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00018 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU316 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00072 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00150 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00110 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MOU012  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'CODU001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MOU021  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'CODU006 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MOU019  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'CODU005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MOU018  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'CODU003 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MOU016  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MOU011  ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'MOU014  ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00009 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF006 ', 'AA00007 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'CODU002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MOU015  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MOU017  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'CODU004 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU313 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU317 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU087 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU103 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU101 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU099 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00108 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU302 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU052 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00098 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'CODU007 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MOU020  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00152 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00082 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU096 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00128 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU304 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00070 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU303 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU400 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00050 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU15  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00076 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00078 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00066 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00136 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00130 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00134 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00132 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00013 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU016 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00092 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU092 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU16  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU077 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00100 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU311 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU082 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00096 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00024 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MOU013  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU019 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU021 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU059 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU058 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU061 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00074 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00048 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00018 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU316 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00072 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00150 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU306 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU095 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU025 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU081 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU062 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU200 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00110 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MOU012  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU088 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU100 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU098 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU097 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'CODU001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MOU021  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'CODU006 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MOU019  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU322 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'CODU005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MOU018  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'CODU003 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MOU016  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'CODU002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MOU015  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MOU017  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'CODU004 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU079 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00038 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU313 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU317 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU087 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU103 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU101 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU102 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU205 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00102 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU099 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00108 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00090 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00126 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU320 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU666 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00124 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU319 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00120 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00158 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00154 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU036 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00140 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00142 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU035 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00116 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU037 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00112 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00138 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU093 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00144 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00148 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00114 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU039 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'MODU206 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00036 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00032 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00028 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00012 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00014 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF027 ', 'AA00007 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00090 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00126 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU319 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00120 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00158 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00154 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU036 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00140 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00142 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU035 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00116 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU037 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00112 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00138 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU093 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00144 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00148 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00114 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU039 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU053 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU054 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU206 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU327 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00032 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00028 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MOU011  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MOU014  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'AA00030 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU083 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF036 ', 'MODU315 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00002 ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'CODU007 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MOU020  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00070 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU303 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU15  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00010 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00136 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00130 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00134 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00132 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU044 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU311 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU082 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00024 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MOU013  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00011 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU021 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU202 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU201 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU059 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU061 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00074 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00018 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU316 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00072 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU306 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU095 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU025 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU081 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU062 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU200 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00110 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MOU012  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU088 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU100 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU098 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU097 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU091 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU090 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU322 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'CODU003 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MOU016  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'CODU002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MOU015  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MOU017  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'CODU004 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU079 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00038 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU085 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU089 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU313 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU317 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00102 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00138 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'AA00114 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF033 ', 'MODU083 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU302 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU052 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00098 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'CODU007 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MOU020  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00152 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00082 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU096 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00128 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU304 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00070 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU303 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU400 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU15  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00052 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00076 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00078 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00136 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00134 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00132 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00013 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU016 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00092 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU092 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU16  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU077 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00100 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU311 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU082 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00096 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00024 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MOU013  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU019 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU021 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU202 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU201 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00052 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00076 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00078 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00136 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00130 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00134 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00132 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00013 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU016 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00092 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU16  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU077 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00100 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU044 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00096 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00024 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MOU013  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU019 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU021 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU059 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU058 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU061 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00074 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00048 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00018 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU316 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00072 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00150 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00110 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MOU012  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU313 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU317 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU087 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU059 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU058 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU061 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00074 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00048 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00018 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU316 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00072 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00150 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU306 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU095 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU025 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU081 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU062 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU200 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00110 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MOU012  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU088 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU100 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU098 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU097 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'CODU001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MOU021  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'CODU006 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MOU019  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU322 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'CODU005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MOU018  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'CODU003 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MOU016  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'CODU002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MOU015  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MOU017  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'CODU004 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU079 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00038 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU313 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU317 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU087 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU103 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU101 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU102 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU205 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00102 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU099 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00108 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00090 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00126 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU320 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU666 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00124 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU319 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00120 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00158 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00154 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU036 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00140 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00142 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU035 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00116 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU037 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00112 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00138 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU093 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00144 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00148 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00114 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU039 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'MODU206 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00036 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00032 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00028 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00012 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00014 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF037 ', 'AA00007 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU302 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU052 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU207 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00098 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00152 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00082 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU096 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00128 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU304 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00070 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU303 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU400 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00062 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU302 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU052 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU207 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00098 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'CODU007 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MOU020  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00152 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00082 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU096 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00128 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MOU009  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU304 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU303 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00070 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU400 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00050 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU15  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00052 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00010 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00076 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00078 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU013 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00068 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00066 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00006 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00136 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00130 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00134 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00132 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00013 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00064 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU016 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU208 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU209 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU203 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU092 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00092 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU16  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU077 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00100 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU044 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU311 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU082 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00096 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00024 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MOU013  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU019 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00011 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU021 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU210 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU202 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU201 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU059 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU058 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU061 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00004 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00074 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00048 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00003 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00016 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00018 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU300 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU316 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU301 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00072 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00150 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU306 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU095 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU025 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU081 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU062 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU200 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00110 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MOU012  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU097 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU091 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU090 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU088 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU100 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU098 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'CODU001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'CODU006 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'CODU005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'CODU003 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'CODU002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'CODU004 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MOU021  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MOU019  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU322 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MOU018  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MOU016  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MOU015  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MOU017  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU079 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00038 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU089 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU085 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU313 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU317 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00054 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU087 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AUT001  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU103 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU101 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU102 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU205 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU13  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00102 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU099 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00108 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00090 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00126 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU666 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00124 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU320 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU318 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00056 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU319 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00118 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00120 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00158 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU035 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00154 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU036 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00140 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00142 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00116 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU037 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00112 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00138 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00144 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00148 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00114 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU039 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU093 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU053 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU054 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU206 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU327 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU043 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00036 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00032 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00028 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00012 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MOU011  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MOU014  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00030 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU083 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00009 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU003 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU204 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00014 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'AA00007 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF001 ', 'MODU315 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'MOU009  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'MODU304 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00070 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'MODU008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00132 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00024 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'MODU019 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'MODU202 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'MODU201 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00074 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00018 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'MODU316 ', 'TRUE ', 'FALSE', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00072 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'MODU062 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'MODU200 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00110 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'MOU012  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'MODU322 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'MODU317 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00102 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00108 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00138 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF028 ', 'AA00026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU103 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU101 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU099 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00108 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00090 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00126 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU320 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU666 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00124 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU318 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00056 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU319 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00118 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00120 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00158 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00154 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU036 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00140 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00142 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU035 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00116 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU037 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00112 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00138 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU093 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00144 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00148 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00114 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU039 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU053 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU054 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU206 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU327 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU043 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00032 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00028 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00012 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MOU011  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MOU014  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'AA00030 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU083 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF030 ', 'MODU315 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU302 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU052 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU207 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'CODU007 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MOU020  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00152 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU096 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00128 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MOU009  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU304 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00070 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU303 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00050 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU15  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00052 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00010 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00076 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00078 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00006 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00136 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00130 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00134 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00132 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00013 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU016 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU208 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU209 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU203 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00092 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU092 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU16  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU077 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00100 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU044 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU311 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU082 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00096 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00024 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MOU013  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU019 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00011 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU021 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU210 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU202 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU201 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU059 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU058 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU061 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00004 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00074 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00048 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00016 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00018 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU300 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU316 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU301 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00072 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00150 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU306 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU095 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU025 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU081 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU062 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU200 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00110 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MOU012  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU088 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU100 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU098 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU097 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU091 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU090 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'CODU001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MOU021  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'CODU006 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MOU019  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU322 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'CODU005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MOU018  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'CODU003 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MOU016  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'CODU002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MOU015  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MOU017  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'CODU004 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU079 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00038 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU085 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU089 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU313 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU317 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00054 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU087 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU103 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU101 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU102 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU205 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU13  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00102 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU099 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00108 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00090 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00126 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU320 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU666 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00124 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU318 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00056 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU319 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00118 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00120 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00158 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00154 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU036 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00140 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00142 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU035 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00116 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU037 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00112 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00138 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU093 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00144 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00148 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00114 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU039 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU053 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU054 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU206 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU327 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU043 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00036 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00032 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00028 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00012 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MOU011  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MOU014  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00030 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU083 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00009 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU003 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU204 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00014 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'AA00007 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF031 ', 'MODU315 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU302 ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00152 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU304 ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00070 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU303 ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU008 ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00010 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00078 ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00006 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00136 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00130 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00134 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00132 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU092 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU044 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU311 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU082 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00011 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU021 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU059 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU060 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU061 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00004 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU080 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00074 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00018 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU316 ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00072 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU095 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU025 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU081 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU200 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00110 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU088 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU100 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU098 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU097 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU091 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU090 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MOU021  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'CODU006 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU322 ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MOU018  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'CODU003 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MOU016  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'CODU002 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MOU015  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU079 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU085 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU089 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00005 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00001 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU313 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU317 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU087 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU103 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU101 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU102 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU13  ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00102 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU086 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU099 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00108 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU106 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU094 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00090 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU319 ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00120 ', 'TRUE ', 'TRUE ', 'FALSE');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00154 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00140 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00142 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU035 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU105 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU104 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00138 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU093 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00144 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00114 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU039 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU040 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00008 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00012 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00026 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU084 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'MODU083 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00009 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00014 ', 'TRUE ', 'TRUE ', 'TRUE ');
INSERT INTO modulo_perfil (codigoperfil, codigomodulo, incluir, modificar, eliminar) VALUES ('PERF026 ', 'AA00007 ', 'TRUE ', 'TRUE ', 'TRUE ');


--
-- TOC entry 2833 (class 0 OID 17309)
-- Dependencies: 285
-- Data for Name: perfil; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO perfil (codigoperfil, nombreperfil, descripcionperfil, statusperfil) VALUES ('PERF001 ', 'ADMINISTRADOR DE SISTEMAS', 'ADMINISTRADOR DE LA APLICACION', 'ACTIVO         ');
INSERT INTO perfil (codigoperfil, nombreperfil, descripcionperfil, statusperfil) VALUES ('PERF028 ', 'ATENCION AL CLIENTE      ', 'ATENCION ALO CLIENTE', 'ACTIVO         ');
INSERT INTO perfil (codigoperfil, nombreperfil, descripcionperfil, statusperfil) VALUES ('PERF006 ', 'COBRANZA                 ', 'CAJA COBRANZAS', 'ACTIVO         ');
INSERT INTO perfil (codigoperfil, nombreperfil, descripcionperfil, statusperfil) VALUES ('PERF027 ', 'GERENTE                  ', 'GERENTES DE LAS EMPRESAS', 'ACTIVO         ');
INSERT INTO perfil (codigoperfil, nombreperfil, descripcionperfil, statusperfil) VALUES ('PERF032 ', 'CALL CENTER              ', 'CALL CENTER CABLE HOGAR', 'ACTIVO         ');
INSERT INTO perfil (codigoperfil, nombreperfil, descripcionperfil, statusperfil) VALUES ('PERF033 ', 'OPERACIONES              ', 'OPERACIONES', 'ACTIVO         ');
INSERT INTO perfil (codigoperfil, nombreperfil, descripcionperfil, statusperfil) VALUES ('PERF030 ', 'DPTO. ADMINISTRACION     ', 'OFICINA ADMINISTRATIVA', 'ACTIVO         ');
INSERT INTO perfil (codigoperfil, nombreperfil, descripcionperfil, statusperfil) VALUES ('PERF031 ', 'DPTO. DE SISTEMAS        ', 'DPTO DE SISTEMAS DE CABLE HOGAR', 'ACTIVO         ');
INSERT INTO perfil (codigoperfil, nombreperfil, descripcionperfil, statusperfil) VALUES ('PERF026 ', 'DPTO. TECNICO            ', 'PARA EL DEPARTAMENTO TECNICO', 'ACTIVO         ');
INSERT INTO perfil (codigoperfil, nombreperfil, descripcionperfil, statusperfil) VALUES ('PERF034 ', 'DPTO. DE TESORERIA       ', 'TESORERIA', 'ACTIVO         ');
INSERT INTO perfil (codigoperfil, nombreperfil, descripcionperfil, statusperfil) VALUES ('PERF035 ', 'DPTO. DE CONTABILIDAD    ', 'CONTABILIDAD', 'ACTIVO         ');
INSERT INTO perfil (codigoperfil, nombreperfil, descripcionperfil, statusperfil) VALUES ('PERF036 ', 'DPTO. COMERCIAL          ', 'COMERCIAL', 'ACTIVO         ');
INSERT INTO perfil (codigoperfil, nombreperfil, descripcionperfil, statusperfil) VALUES ('PERF037 ', 'DESARROLLISTAS           ', 'EMPRESAS DESARROLLISTAS', 'ACTIVO         ');


--
-- TOC entry 2834 (class 0 OID 17324)
-- Dependencies: 288
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ADMIN                    ', 'PER00001  ', 'PERF001 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EA', '0    ', '1         ', '          ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ABUEN                    ', 'AB00000020', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AR', '     ', '3         ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('AFERN                    ', 'AB00000003', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'A]', '     ', '5         ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('AFONS                    ', 'AB00000012', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AJ', '     ', '6         ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('AGALI                    ', 'AB00000018', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AP', '     ', '7         ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('AHURT                    ', 'AB00000005', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AC', '     ', '8         ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ALOPE                    ', 'AB00000007', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AE', '     ', '9         ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('APERE                    ', 'AB00000002', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'A[', '     ', '11        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('AREPI                    ', 'AB00000015', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AM', '     ', '12        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('AREYE                    ', 'AB00000004', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AA', '     ', '13        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ASANC                    ', 'AB00000016', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AN', '     ', '14        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ASIER                    ', 'AB00000011', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AI', '     ', '15        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC1P                    ', 'AB00000128', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EN', '     ', '16        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC1T                    ', 'AB00000009', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AG', '     ', '17        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC1V                    ', 'AB00000228', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'IB', '     ', '18        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC22                    ', 'AB00000129', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EO', '     ', '19        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC2V                    ', 'AB00000220', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HV', '     ', '20        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC3C                    ', 'AB00000115', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EA', '     ', '21        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC3T                    ', 'AB00000082', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CX', '     ', '22        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC3V                    ', 'AB00000013', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AK', '     ', '23        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC4C                    ', 'AB00000006', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AD', '     ', '24        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC4V                    ', 'AB00000167', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FY', '     ', '25        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC5V                    ', 'AB00000160', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FR', '     ', '26        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC6V                    ', 'AB00000230', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'ID', '     ', '27        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC7V                    ', 'AB00000122', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EH', '     ', '28        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC8C                    ', 'AB00000054', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BX', '     ', '29        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATC9V                    ', 'AB00000213', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HO', '     ', '30        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATREJ                    ', 'AB00000010', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AH', '     ', '32        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('AVALE                    ', 'AB00000019', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AQ', '     ', '33        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('BMARU                    ', 'AB00000027', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AY', '     ', '35        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('BMOLI                    ', 'AB00000026', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AX', '     ', '36        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('BSUCR                    ', 'AB00000022', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AT', '     ', '38        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CABUE                    ', 'AB00000029', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'B[', '     ', '39        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CBUEN                    ', 'AB00000028', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AZ', '     ', '40        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CCARD                    ', 'AB00000030', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'B]', '     ', '41        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CCARV                    ', 'AB00000047', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BQ', '     ', '42        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CERIC                    ', 'AB00000066', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CH', '     ', '43        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CGASP                    ', 'AB00000034', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BD', '     ', '44        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CGONZ                    ', 'AB00000032', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BB', '     ', '45        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CLAND                    ', 'AB00000036', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BF', '     ', '48        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CLUIS                    ', 'AB00000139', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EY', '     ', '49        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CMART                    ', 'AB00000041', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BK', '     ', '50        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CMUÑO                    ', 'AB00000046', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BP', '     ', '51        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CNEIR                    ', 'AB00000037', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BG', '     ', '52        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CONTR                    ', 'AB00000031', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BA', '     ', '53        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CPERE                    ', 'AB00000039', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BI', '     ', '55        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CRAMO                    ', 'AB00000033', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BC', '     ', '56        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CRIGU                    ', 'AB00000043', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BM', '     ', '57        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CRUIZ                    ', 'AB00000044', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BN', '     ', '58        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('DAREV                    ', 'AB00000048', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BR', '     ', '59        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('DCHAC                    ', 'AB00000050', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BT', '     ', '60        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('DGUTI                    ', 'AB00000057', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'C[', '     ', '61        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('DJARA                    ', 'AB00000059', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CA', '     ', '62        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('DOSOR                    ', 'AB00000058', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'C]', '     ', '63        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('DPERE                    ', 'AB00000052', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BV', '     ', '64        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('DQUIN                    ', 'AB00000053', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BW', '     ', '65        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('DSINZ                    ', 'AB00000056', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BZ', '     ', '67        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('DYELI                    ', 'AB00000216', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HR', '     ', '68        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('EBARR                    ', 'AB00000070', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CL', '     ', '69        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ECOLE                    ', 'AB00000071', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CM', '     ', '70        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('EDIAZ                    ', 'AB00000064', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CF', '     ', '71        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('EGOME                    ', 'AB00000060', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CB', '     ', '72        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ELADI                    ', 'AB00000063', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CE', '     ', '73        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('EPACH                    ', 'AB00000068', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CJ', '     ', '74        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('EPARR                    ', 'AB00000069', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CK', '     ', '75        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ERODR                    ', 'AB00000061', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CC', '     ', '76        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('EROJA                    ', 'AB00000067', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CI', '     ', '77        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ESERV                    ', 'AB00000065', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CG', '     ', '78        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ESIER                    ', 'AB00000062', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CD', '     ', '79        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('FMUNO                    ', 'AB00000075', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CQ', '     ', '81        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('FREDD                    ', 'AB00000079', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CU', '     ', '82        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('FSALG                    ', 'AB00000073', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CO', '     ', '83        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('FSIER                    ', 'AB00000076', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CR', '     ', '84        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('FZABA                    ', 'AB00000077', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CS', '     ', '86        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('FZAPA                    ', 'AB00000074', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CP', '     ', '87        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('GMEZA                    ', 'AB00000083', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CY', '     ', '89        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('GOROP                    ', 'AB00000081', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CW', '     ', '90        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('GREVI                    ', 'AB00000080', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CV', '     ', '91        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('HAGUI                    ', 'AB00000085', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'D[', '     ', '92        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('HANA                     ', 'AB00000088', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DB', '     ', '93        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('HERN                     ', 'AB00000199', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HA', '     ', '94        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('HERR                     ', 'AB00000178', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GH', '     ', '95        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('HSOSA                    ', 'AB00000086', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'D]', '     ', '97        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('IGOME                    ', 'AB00000092', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DF', '     ', '98        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('IGONZ                    ', 'AB00000089', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DC', '     ', '99        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('IPERE                    ', 'AB00000090', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DD', '     ', '100       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ISARM                    ', 'AB00000091', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DE', '     ', '101       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('IZAG                     ', 'AB00000192', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GV', '     ', '102       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JBARB                    ', 'AB00000104', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DR', '     ', '104       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JCATI                    ', 'AB00000108', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DV', '     ', '105       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JDIAZ                    ', 'AB00000111', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DY', '     ', '106       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JDONO                    ', 'AB00000099', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DM', '     ', '107       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JENDI                    ', 'AB00000095', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DI', '     ', '108       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JESCO                    ', 'AB00000097', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DK', '     ', '109       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JESPI                    ', 'AB00000105', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DS', '     ', '110       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JMANT                    ', 'AB00000093', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DG', '     ', '112       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JMONT                    ', 'AB00000112', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DZ', '     ', '113       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JMORI                    ', 'AB00000106', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DT', '     ', '114       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JQUIN                    ', 'AB00000101', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DO', '     ', '116       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JRIGU                    ', 'AB00000109', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DW', '     ', '117       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JSCOT                    ', 'AB00000096', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DJ', '     ', '119       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JVILO                    ', 'AB00000098', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DL', '     ', '120       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JZERP                    ', 'AB00000100', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DN', '     ', '121       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('KALEM                    ', 'AB00000118', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'ED', '     ', '122       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('KGIRA                    ', 'AB00000119', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EE', '     ', '123       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('KLEAL                    ', 'AB00000113', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'E[', '     ', '124       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('KPARE                    ', 'AB00000116', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EB', '     ', '125       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('KPOLO                    ', 'AB00000114', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'E]', '     ', '126       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('KSILV                    ', 'AB00000120', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EF', '     ', '128       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LANDR                    ', 'AB00000125', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EK', '     ', '129       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LCARD                    ', 'AB00000140', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EZ', '     ', '131       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LDIAZ                    ', 'AB00000134', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'ET', '     ', '132       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LDURA                    ', 'AB00000132', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'ER', '     ', '133       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LGODO                    ', 'AB00000127', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EM', '     ', '134       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LILID                    ', 'AB00000131', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EQ', '     ', '135       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LKOLK                    ', 'AB00000136', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EV', '     ', '136       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LOMAN                    ', 'AB00000123', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EI', '     ', '140       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LPAEZ                    ', 'AB00000143', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FA', '     ', '142       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LREIN                    ', 'AB00000137', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EW', '     ', '143       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LVELI                    ', 'AB00000130', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EP', '     ', '146       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MACEV                    ', 'AB00000161', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FS', '     ', '147       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MARIB                    ', 'AB00000154', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FL', '     ', '148       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MARR                     ', 'AB00000024', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AV', '     ', '149       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MBLAN                    ', 'AB00000157', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FO', '     ', '151       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MCARN                    ', 'AB00000162', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FT', '     ', '152       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MCORT                    ', 'AB00000159', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FQ', '     ', '154       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MESPI                    ', 'AB00000158', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FP', '     ', '155       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MGARC                    ', 'AB00000156', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FN', '     ', '156       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MPARR                    ', 'AB00000145', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FC', '     ', '159       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MROA                     ', 'AB00000149', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FG', '     ', '162       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MRODR                    ', 'AB00000146', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FD', '     ', '163       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MROOS                    ', 'AB00000166', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FX', '     ', '165       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MVARG                    ', 'AB00000147', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FE', '     ', '167       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('NDIAZ                    ', 'AB00000172', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GB', '     ', '168       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('NGONZ                    ', 'AB00000170', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'G]', '     ', '169       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('NMART                    ', 'AB00000168', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FZ', '     ', '170       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('NNAVA                    ', 'AB00000121', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EG', '     ', '171       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('NROJA                    ', 'AB00000173', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GC', '     ', '172       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('NROME                    ', 'AB00000174', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GD', '     ', '173       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('NSERR                    ', 'AB00000171', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GA', '     ', '174       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('NVARG                    ', 'AB00000169', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'G[', '     ', '175       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('OCOLI                    ', 'AB00000177', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GG', '     ', '176       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('OOSOR                    ', 'AB00000179', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GI', '     ', '178       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('OPEC2                    ', 'AB00000045', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BO', '     ', '179       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('OPEV1                    ', 'AB00000202', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HD', '     ', '180       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('OQUIN                    ', 'AB00000180', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GJ', '     ', '181       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ORUDA                    ', 'AB00000175', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GE', '     ', '182       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('OVALE                    ', 'AB00000176', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GF', '     ', '183       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('PBARR                    ', 'AB00000182', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GL', '     ', '184       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('PCANI                    ', 'AB00000185', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GO', '     ', '185       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('PDIAZ                    ', 'AB00000184', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GN', '     ', '186       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('PERE                     ', 'AB00000038', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BH', '     ', '187       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('PMORE                    ', 'AB00000183', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GM', '     ', '188       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('RBRIZ                    ', 'AB00000191', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GU', '     ', '189       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('RCARR                    ', 'AB00000186', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GP', '     ', '190       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('RHIDA                    ', 'AB00000189', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GS', '     ', '191       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('RMOLI                    ', 'AB00000187', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GQ', '     ', '192       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ROSAN                    ', 'AB00000194', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GX', '     ', '193       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('RREYE                    ', 'AB00000196', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GZ', '     ', '194       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('RSANC                    ', 'AB00000193', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GW', '     ', '196       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('SANDY                    ', 'AB00000203', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HE', '     ', '199       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('SDUAR                    ', 'AB00000197', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'H[', '     ', '200       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('SERV1                    ', 'AB00000155', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FM', '     ', '201       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('SHERN                    ', 'AB00000198', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'H]', '     ', '202       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('SOPO2                    ', 'AB00000055', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BY', '     ', '203       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('SOPO3                    ', 'AB00000133', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'ES', '     ', '204       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('SOPOR                    ', 'AB00000049', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BS', '     ', '205       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('SPADI                    ', 'AB00000200', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HB', '     ', '206       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('SRUIZ                    ', 'AB00000201', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HC', '     ', '207       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('VDIAZ                    ', 'AB00000204', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HF', '     ', '209       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('VGARC                    ', 'AB00000206', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HH', '     ', '210       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('VMARB                    ', 'AB00000205', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HG', '     ', '211       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('VQUES                    ', 'AB00000207', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HI', '     ', '212       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('WCAST                    ', 'AB00000212', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HN', '     ', '213       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('WHENR                    ', 'AB00000209', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HK', '     ', '215       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('WMORA                    ', 'AB00000211', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HM', '     ', '216       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('YARAU                    ', 'AB00000221', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HW', '     ', '217       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('YBAST                    ', 'AB00000227', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'IA', '     ', '218       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('YDELG                    ', 'AB00000226', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'I]', '     ', '220       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('YEHER                    ', 'AB00000214', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HP', '     ', '222       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('YESCA                    ', 'AB00000217', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HS', '     ', '223       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('YJAEN                    ', 'AB00000225', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'I[', '     ', '224       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('YMART                    ', 'AB00000229', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'IC', '     ', '225       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('YMOTA                    ', 'AB00000224', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HZ', '     ', '226       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('YPACH                    ', 'AB00000218', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HT', '     ', '227       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('YREQU                    ', 'AB00000219', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HU', '     ', '228       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('YROJA                    ', 'AB00000222', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HX', '     ', '229       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('YROSA                    ', 'AB00000231', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'IE', '     ', '230       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ZDIAZ                    ', 'AB00000232', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'IF', '     ', '231       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ATOVA                    ', 'AB00000008', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AF', 'AB007', '31        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ACHIQ                    ', 'AB00000014', 'PERF027 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AL', '1    ', '4         ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('AAMAY                    ', 'AB00000017', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AO', 'AB007', '2         ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('APALO                    ', 'AB00000021', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AS', '1    ', '10        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('BCAST                    ', 'AB00000023', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AU', 'AB010', '34        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('BPERE                    ', 'AB00000025', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'AW', '1    ', '37        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CHERR                    ', 'AB00000035', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BE', 'AB006', '47        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CHERN                    ', 'AB00000040', 'PERF036 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BJ', 'AB003', '46        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('CPARA                    ', 'AB00000042', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BL', 'AB010', '54        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('DSAND                    ', 'AB00000051', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'BU', 'AB007', '66        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('FTREJ                    ', 'AB00000072', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CN', 'AB007', '85        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('FMALD                    ', 'AB00000078', 'PERF027 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CT', 'AB005', '80        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('GCORD                    ', 'AB00000084', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'CZ', '1    ', '88        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('HGARC                    ', 'AB00000087', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DA', '1    ', '96        ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JGONZ                    ', 'AB00000094', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DH', 'AB006', '111       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('ZERP                     ', 'AB00000102', 'PERF006 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DP', 'AB010', '          ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JARAU                    ', 'AB00000103', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DQ', 'AB007', '103       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JRIOS                    ', 'AB00000107', 'PERF031 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DU', 'AB004', '118       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('JPARE                    ', 'AB00000110', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'DX', 'AB010', '115       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('KRODR                    ', 'AB00000117', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EC', '1    ', '127       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LARVE                    ', 'AB00000124', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EJ', 'AB006', '130       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LNOLA                    ', 'AB00000126', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EL', 'AB006', '139       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LMORA                    ', 'AB00000135', 'PERF036 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EU', 'AB003', '138       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LROJA                    ', 'AB00000138', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'EX', 'AB006', '144       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LMONT                    ', 'AB00000141', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'F[', 'AB006', '137       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LOROZ                    ', 'AB00000142', 'PERF036 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'F]', 'AB003', '141       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('LSANC                    ', 'AB00000144', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FB', 'AB006', '145       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MMEDI                    ', 'AB00000148', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FF', 'AB010', '158       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MPEST                    ', 'AB00000150', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FH', '1    ', '160       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MBERD                    ', 'AB00000151', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FI', 'AB010', '150       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MRIVA                    ', 'AB00000152', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FJ', 'AB003', '161       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MROME                    ', 'AB00000153', 'PERF030 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FK', 'AB006', '164       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MCARP                    ', 'AB00000163', 'PERF031 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FU', 'AB003', '153       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MSILV                    ', 'AB00000164', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FV', 'AB003', '166       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('MJOGA                    ', 'AB00000165', 'PERF030 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'FW', 'AB008', '157       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('OHERR                    ', 'AB00000181', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GK', '1    ', '177       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('RROJA                    ', 'AB00000188', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GR', 'AB003', '195       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('RSANT                    ', 'AB00000190', 'PERF036 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GT', 'AB004', '197       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('RVERA                    ', 'AB00000195', 'PERF031 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'GY', 'AB005', '198       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('VDELG                    ', 'AB00000208', 'PERF033 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HJ', '1    ', '208       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('WFERN                    ', 'AB00000210', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HL', 'AB006', '214       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('YDIAZ                    ', 'AB00000215', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HQ', 'AB007', '221       ', 'EA001     ');
INSERT INTO usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) VALUES ('YBERM                    ', 'AB00000223', 'PERF028 ', 'E10ADC3949BA59ABBE56E057F20F883E                  ', 'ACTIVO         ', 'HY', 'AB006', '219       ', 'EA001     ');


--
-- TOC entry 2841 (class 0 OID 0)
-- Dependencies: 326
-- Name: usuario_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuario_id_usuario_seq', 117, true);


--
-- TOC entry 2613 (class 2606 OID 17936)
-- Name: modulo_perfil_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY modulo_perfil
    ADD CONSTRAINT modulo_perfil_pkey PRIMARY KEY (codigoperfil, codigomodulo);


--
-- TOC entry 2611 (class 2606 OID 18070)
-- Name: pk_modulo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY modulo
    ADD CONSTRAINT pk_modulo PRIMARY KEY (codigomodulo);


--
-- TOC entry 2618 (class 2606 OID 18112)
-- Name: pk_perfil; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY perfil
    ADD CONSTRAINT pk_perfil PRIMARY KEY (codigoperfil);


--
-- TOC entry 2621 (class 2606 OID 18176)
-- Name: pk_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT pk_usuario PRIMARY KEY (id_usuario);


--
-- TOC entry 2619 (class 1259 OID 18206)
-- Name: addssbddfadfd; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX addssbddfadfd ON usuario USING btree (login);


--
-- TOC entry 2608 (class 1259 OID 18277)
-- Name: modulo_2_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX modulo_2_pk ON modulo USING btree (codigomodulo);


--
-- TOC entry 2609 (class 1259 OID 18278)
-- Name: modulo_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX modulo_pk ON modulo USING btree (codigomodulo);


--
-- TOC entry 2616 (class 1259 OID 18303)
-- Name: perfil_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX perfil_pk ON perfil USING btree (codigoperfil);


--
-- TOC entry 2622 (class 1259 OID 18343)
-- Name: relationship_14_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_14_fk ON usuario USING btree (codigoperfil);


--
-- TOC entry 2614 (class 1259 OID 18344)
-- Name: relationship_15_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_15_fk ON modulo_perfil USING btree (codigoperfil);


--
-- TOC entry 2615 (class 1259 OID 18345)
-- Name: relationship_16_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_16_fk ON modulo_perfil USING btree (codigomodulo);


--
-- TOC entry 2623 (class 1259 OID 18348)
-- Name: relationship_24_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_24_fk ON usuario USING btree (id_persona);


--
-- TOC entry 2624 (class 1259 OID 18393)
-- Name: usuaddio_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX usuaddio_pk ON usuario USING btree (id_usuario);


--
-- TOC entry 2625 (class 2606 OID 18667)
-- Name: fk_modulo_p_relations_modulo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY modulo_perfil
    ADD CONSTRAINT fk_modulo_p_relations_modulo FOREIGN KEY (codigomodulo) REFERENCES modulo(codigomodulo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2626 (class 2606 OID 18672)
-- Name: fk_modulo_p_relations_perfil; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY modulo_perfil
    ADD CONSTRAINT fk_modulo_p_relations_perfil FOREIGN KEY (codigoperfil) REFERENCES perfil(codigoperfil) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2627 (class 2606 OID 18797)
-- Name: fk_usuario_relations_perfil; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_usuario_relations_perfil FOREIGN KEY (codigoperfil) REFERENCES perfil(codigoperfil) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2628 (class 2606 OID 18802)
-- Name: fk_usuario_relations_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_usuario_relations_persona FOREIGN KEY (id_persona) REFERENCES persona(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


-- Completed on 2015-06-08 10:35:19

--
-- PostgreSQL database dump complete
--

