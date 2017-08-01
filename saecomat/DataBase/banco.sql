--
-- PostgreSQL database dump
--

-- Dumped from database version 9.0.7
-- Dumped by pg_dump version 9.0.7
-- Started on 2012-05-22 09:52:19

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 144 (class 1259 OID 24590)
-- Dependencies: 6
-- Name: banco; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE banco (
    id_banco character(5) NOT NULL,
    banco character(50)
);


ALTER TABLE public.banco OWNER TO postgres;

--
-- TOC entry 2179 (class 0 OID 24590)
-- Dependencies: 144
-- Data for Name: banco; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO banco (id_banco, banco) VALUES ('BA008', 'DEL SUR                                           ');
INSERT INTO banco (id_banco, banco) VALUES ('BA011', 'BANCO DEL TESORO                                  ');
INSERT INTO banco (id_banco, banco) VALUES ('BA002', 'BANESCO                                           ');
INSERT INTO banco (id_banco, banco) VALUES ('BA013', 'EXTERIOR                                          ');
INSERT INTO banco (id_banco, banco) VALUES ('BA014', 'FONDO COMUN                                       ');
INSERT INTO banco (id_banco, banco) VALUES ('BA015', 'NACIONAL DE CREDITO                               ');
INSERT INTO banco (id_banco, banco) VALUES ('AF001', '100% BANCO                                        ');
INSERT INTO banco (id_banco, banco) VALUES ('BD001', 'BANCO BOD                                         ');
INSERT INTO banco (id_banco, banco) VALUES ('BA001', 'BANCO DE VENEZUELA                                ');
INSERT INTO banco (id_banco, banco) VALUES ('BA004', 'CORP BANCA                                        ');
INSERT INTO banco (id_banco, banco) VALUES ('BA005', 'MERCANTIL                                         ');
INSERT INTO banco (id_banco, banco) VALUES ('BA009', 'INDUSTRIAL                                        ');
INSERT INTO banco (id_banco, banco) VALUES ('BA006', 'CARONI                                            ');
INSERT INTO banco (id_banco, banco) VALUES ('BA003', 'BANCO BICENTENARIO                                ');
INSERT INTO banco (id_banco, banco) VALUES ('BA012', 'VENEZOLANO DE CREDITO                             ');
INSERT INTO banco (id_banco, banco) VALUES ('BA010', 'CARIBE                                            ');
INSERT INTO banco (id_banco, banco) VALUES ('BA007', 'PROVINCIAL                                        ');


--
-- TOC entry 2178 (class 2606 OID 25045)
-- Dependencies: 144 144
-- Name: banco_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY banco
    ADD CONSTRAINT banco_pkey PRIMARY KEY (id_banco);


--
-- TOC entry 2176 (class 1259 OID 25191)
-- Dependencies: 144
-- Name: banco_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX banco_pk ON banco USING btree (id_banco);


-- Completed on 2012-05-22 09:52:19

--
-- PostgreSQL database dump complete
--

