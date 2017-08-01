--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.5
-- Dumped by pg_dump version 9.3.5
-- Started on 2015-06-08 10:45:19

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
-- TOC entry 2824 (class 0 OID 0)
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
-- TOC entry 2818 (class 0 OID 17324)
-- Dependencies: 288
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuario (login, id_persona, codigoperfil, password, statususuario, inicial, id_franq, id_usuario, id_servidor) FROM stdin;
ADMIN                    	PER00001  	PERF001 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EA	0    	1         	          
ABUEN                    	AB00000020	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AR	     	3         	EA001     
AFERN                    	AB00000003	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	A]	     	5         	EA001     
AFONS                    	AB00000012	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AJ	     	6         	EA001     
AGALI                    	AB00000018	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AP	     	7         	EA001     
AHURT                    	AB00000005	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AC	     	8         	EA001     
ALOPE                    	AB00000007	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AE	     	9         	EA001     
APERE                    	AB00000002	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	A[	     	11        	EA001     
AREPI                    	AB00000015	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AM	     	12        	EA001     
AREYE                    	AB00000004	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AA	     	13        	EA001     
ASANC                    	AB00000016	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AN	     	14        	EA001     
ASIER                    	AB00000011	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AI	     	15        	EA001     
ATC1P                    	AB00000128	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EN	     	16        	EA001     
ATC1T                    	AB00000009	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AG	     	17        	EA001     
ATC1V                    	AB00000228	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	IB	     	18        	EA001     
ATC22                    	AB00000129	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EO	     	19        	EA001     
ATC2V                    	AB00000220	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HV	     	20        	EA001     
ATC3C                    	AB00000115	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EA	     	21        	EA001     
ATC3T                    	AB00000082	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CX	     	22        	EA001     
ATC3V                    	AB00000013	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AK	     	23        	EA001     
ATC4C                    	AB00000006	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AD	     	24        	EA001     
ATC4V                    	AB00000167	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FY	     	25        	EA001     
ATC5V                    	AB00000160	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FR	     	26        	EA001     
ATC6V                    	AB00000230	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	ID	     	27        	EA001     
ATC7V                    	AB00000122	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EH	     	28        	EA001     
ATC8C                    	AB00000054	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BX	     	29        	EA001     
ATC9V                    	AB00000213	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HO	     	30        	EA001     
ATREJ                    	AB00000010	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AH	     	32        	EA001     
AVALE                    	AB00000019	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AQ	     	33        	EA001     
BMARU                    	AB00000027	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AY	     	35        	EA001     
BMOLI                    	AB00000026	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AX	     	36        	EA001     
BSUCR                    	AB00000022	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AT	     	38        	EA001     
CABUE                    	AB00000029	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	B[	     	39        	EA001     
CBUEN                    	AB00000028	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AZ	     	40        	EA001     
CCARD                    	AB00000030	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	B]	     	41        	EA001     
CCARV                    	AB00000047	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BQ	     	42        	EA001     
CERIC                    	AB00000066	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CH	     	43        	EA001     
CGASP                    	AB00000034	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BD	     	44        	EA001     
CGONZ                    	AB00000032	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BB	     	45        	EA001     
CLAND                    	AB00000036	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BF	     	48        	EA001     
CLUIS                    	AB00000139	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EY	     	49        	EA001     
CMART                    	AB00000041	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BK	     	50        	EA001     
CMUÑO                    	AB00000046	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BP	     	51        	EA001     
CNEIR                    	AB00000037	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BG	     	52        	EA001     
CONTR                    	AB00000031	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BA	     	53        	EA001     
CPERE                    	AB00000039	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BI	     	55        	EA001     
CRAMO                    	AB00000033	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BC	     	56        	EA001     
CRIGU                    	AB00000043	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BM	     	57        	EA001     
CRUIZ                    	AB00000044	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BN	     	58        	EA001     
DAREV                    	AB00000048	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BR	     	59        	EA001     
DCHAC                    	AB00000050	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BT	     	60        	EA001     
DGUTI                    	AB00000057	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	C[	     	61        	EA001     
DJARA                    	AB00000059	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CA	     	62        	EA001     
DOSOR                    	AB00000058	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	C]	     	63        	EA001     
DPERE                    	AB00000052	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BV	     	64        	EA001     
DQUIN                    	AB00000053	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BW	     	65        	EA001     
DSINZ                    	AB00000056	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BZ	     	67        	EA001     
DYELI                    	AB00000216	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HR	     	68        	EA001     
EBARR                    	AB00000070	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CL	     	69        	EA001     
ECOLE                    	AB00000071	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CM	     	70        	EA001     
EDIAZ                    	AB00000064	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CF	     	71        	EA001     
EGOME                    	AB00000060	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CB	     	72        	EA001     
ELADI                    	AB00000063	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CE	     	73        	EA001     
EPACH                    	AB00000068	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CJ	     	74        	EA001     
EPARR                    	AB00000069	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CK	     	75        	EA001     
ERODR                    	AB00000061	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CC	     	76        	EA001     
EROJA                    	AB00000067	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CI	     	77        	EA001     
ESERV                    	AB00000065	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CG	     	78        	EA001     
ESIER                    	AB00000062	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CD	     	79        	EA001     
FMUNO                    	AB00000075	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CQ	     	81        	EA001     
FREDD                    	AB00000079	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CU	     	82        	EA001     
FSALG                    	AB00000073	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CO	     	83        	EA001     
FSIER                    	AB00000076	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CR	     	84        	EA001     
FZABA                    	AB00000077	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CS	     	86        	EA001     
FZAPA                    	AB00000074	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CP	     	87        	EA001     
GMEZA                    	AB00000083	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CY	     	89        	EA001     
GOROP                    	AB00000081	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CW	     	90        	EA001     
GREVI                    	AB00000080	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CV	     	91        	EA001     
HAGUI                    	AB00000085	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	D[	     	92        	EA001     
HANA                     	AB00000088	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DB	     	93        	EA001     
HERN                     	AB00000199	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HA	     	94        	EA001     
HERR                     	AB00000178	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GH	     	95        	EA001     
HSOSA                    	AB00000086	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	D]	     	97        	EA001     
IGOME                    	AB00000092	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DF	     	98        	EA001     
IGONZ                    	AB00000089	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DC	     	99        	EA001     
IPERE                    	AB00000090	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DD	     	100       	EA001     
ISARM                    	AB00000091	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DE	     	101       	EA001     
IZAG                     	AB00000192	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GV	     	102       	EA001     
JBARB                    	AB00000104	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DR	     	104       	EA001     
JCATI                    	AB00000108	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DV	     	105       	EA001     
JDIAZ                    	AB00000111	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DY	     	106       	EA001     
JDONO                    	AB00000099	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DM	     	107       	EA001     
JENDI                    	AB00000095	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DI	     	108       	EA001     
JESCO                    	AB00000097	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DK	     	109       	EA001     
JESPI                    	AB00000105	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DS	     	110       	EA001     
JMANT                    	AB00000093	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DG	     	112       	EA001     
JMONT                    	AB00000112	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DZ	     	113       	EA001     
JMORI                    	AB00000106	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DT	     	114       	EA001     
JQUIN                    	AB00000101	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DO	     	116       	EA001     
JRIGU                    	AB00000109	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DW	     	117       	EA001     
JSCOT                    	AB00000096	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DJ	     	119       	EA001     
JVILO                    	AB00000098	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DL	     	120       	EA001     
JZERP                    	AB00000100	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DN	     	121       	EA001     
KALEM                    	AB00000118	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	ED	     	122       	EA001     
KGIRA                    	AB00000119	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EE	     	123       	EA001     
KLEAL                    	AB00000113	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	E[	     	124       	EA001     
KPARE                    	AB00000116	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EB	     	125       	EA001     
KPOLO                    	AB00000114	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	E]	     	126       	EA001     
KSILV                    	AB00000120	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EF	     	128       	EA001     
LANDR                    	AB00000125	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EK	     	129       	EA001     
LCARD                    	AB00000140	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EZ	     	131       	EA001     
LDIAZ                    	AB00000134	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	ET	     	132       	EA001     
LDURA                    	AB00000132	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	ER	     	133       	EA001     
LGODO                    	AB00000127	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EM	     	134       	EA001     
LILID                    	AB00000131	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EQ	     	135       	EA001     
LKOLK                    	AB00000136	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EV	     	136       	EA001     
LOMAN                    	AB00000123	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EI	     	140       	EA001     
LPAEZ                    	AB00000143	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FA	     	142       	EA001     
LREIN                    	AB00000137	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EW	     	143       	EA001     
LVELI                    	AB00000130	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EP	     	146       	EA001     
MACEV                    	AB00000161	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FS	     	147       	EA001     
MARIB                    	AB00000154	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FL	     	148       	EA001     
MARR                     	AB00000024	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AV	     	149       	EA001     
MBLAN                    	AB00000157	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FO	     	151       	EA001     
MCARN                    	AB00000162	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FT	     	152       	EA001     
MCORT                    	AB00000159	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FQ	     	154       	EA001     
MESPI                    	AB00000158	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FP	     	155       	EA001     
MGARC                    	AB00000156	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FN	     	156       	EA001     
MPARR                    	AB00000145	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FC	     	159       	EA001     
MROA                     	AB00000149	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FG	     	162       	EA001     
MRODR                    	AB00000146	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FD	     	163       	EA001     
MROOS                    	AB00000166	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FX	     	165       	EA001     
MVARG                    	AB00000147	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FE	     	167       	EA001     
NDIAZ                    	AB00000172	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GB	     	168       	EA001     
NGONZ                    	AB00000170	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	G]	     	169       	EA001     
NMART                    	AB00000168	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FZ	     	170       	EA001     
NNAVA                    	AB00000121	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EG	     	171       	EA001     
NROJA                    	AB00000173	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GC	     	172       	EA001     
NROME                    	AB00000174	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GD	     	173       	EA001     
NSERR                    	AB00000171	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GA	     	174       	EA001     
NVARG                    	AB00000169	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	G[	     	175       	EA001     
OCOLI                    	AB00000177	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GG	     	176       	EA001     
OOSOR                    	AB00000179	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GI	     	178       	EA001     
OPEC2                    	AB00000045	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BO	     	179       	EA001     
OPEV1                    	AB00000202	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HD	     	180       	EA001     
OQUIN                    	AB00000180	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GJ	     	181       	EA001     
ORUDA                    	AB00000175	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GE	     	182       	EA001     
OVALE                    	AB00000176	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GF	     	183       	EA001     
PBARR                    	AB00000182	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GL	     	184       	EA001     
PCANI                    	AB00000185	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GO	     	185       	EA001     
PDIAZ                    	AB00000184	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GN	     	186       	EA001     
PERE                     	AB00000038	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BH	     	187       	EA001     
PMORE                    	AB00000183	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GM	     	188       	EA001     
RBRIZ                    	AB00000191	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GU	     	189       	EA001     
RCARR                    	AB00000186	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GP	     	190       	EA001     
RHIDA                    	AB00000189	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GS	     	191       	EA001     
RMOLI                    	AB00000187	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GQ	     	192       	EA001     
ROSAN                    	AB00000194	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GX	     	193       	EA001     
RREYE                    	AB00000196	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GZ	     	194       	EA001     
RSANC                    	AB00000193	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GW	     	196       	EA001     
SANDY                    	AB00000203	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HE	     	199       	EA001     
SDUAR                    	AB00000197	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	H[	     	200       	EA001     
SERV1                    	AB00000155	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FM	     	201       	EA001     
SHERN                    	AB00000198	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	H]	     	202       	EA001     
SOPO2                    	AB00000055	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BY	     	203       	EA001     
SOPO3                    	AB00000133	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	ES	     	204       	EA001     
SOPOR                    	AB00000049	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BS	     	205       	EA001     
SPADI                    	AB00000200	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HB	     	206       	EA001     
SRUIZ                    	AB00000201	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HC	     	207       	EA001     
VDIAZ                    	AB00000204	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HF	     	209       	EA001     
VGARC                    	AB00000206	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HH	     	210       	EA001     
VMARB                    	AB00000205	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HG	     	211       	EA001     
VQUES                    	AB00000207	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HI	     	212       	EA001     
WCAST                    	AB00000212	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HN	     	213       	EA001     
WHENR                    	AB00000209	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HK	     	215       	EA001     
WMORA                    	AB00000211	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HM	     	216       	EA001     
YARAU                    	AB00000221	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HW	     	217       	EA001     
YBAST                    	AB00000227	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	IA	     	218       	EA001     
YDELG                    	AB00000226	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	I]	     	220       	EA001     
YEHER                    	AB00000214	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HP	     	222       	EA001     
YESCA                    	AB00000217	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HS	     	223       	EA001     
YJAEN                    	AB00000225	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	I[	     	224       	EA001     
YMART                    	AB00000229	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	IC	     	225       	EA001     
YMOTA                    	AB00000224	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HZ	     	226       	EA001     
YPACH                    	AB00000218	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HT	     	227       	EA001     
YREQU                    	AB00000219	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HU	     	228       	EA001     
YROJA                    	AB00000222	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HX	     	229       	EA001     
YROSA                    	AB00000231	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	IE	     	230       	EA001     
ZDIAZ                    	AB00000232	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	IF	     	231       	EA001     
ATOVA                    	AB00000008	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AF	AB007	31        	EA001     
ACHIQ                    	AB00000014	PERF027 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AL	1    	4         	EA001     
AAMAY                    	AB00000017	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AO	AB007	2         	EA001     
APALO                    	AB00000021	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AS	1    	10        	EA001     
BCAST                    	AB00000023	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AU	AB010	34        	EA001     
BPERE                    	AB00000025	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	AW	1    	37        	EA001     
CHERR                    	AB00000035	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BE	AB006	47        	EA001     
CHERN                    	AB00000040	PERF036 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BJ	AB003	46        	EA001     
CPARA                    	AB00000042	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BL	AB010	54        	EA001     
DSAND                    	AB00000051	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	BU	AB007	66        	EA001     
FTREJ                    	AB00000072	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CN	AB007	85        	EA001     
FMALD                    	AB00000078	PERF027 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CT	AB005	80        	EA001     
GCORD                    	AB00000084	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	CZ	1    	88        	EA001     
HGARC                    	AB00000087	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DA	1    	96        	EA001     
JGONZ                    	AB00000094	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DH	AB006	111       	EA001     
ZERP                     	AB00000102	PERF006 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DP	AB010	          	EA001     
JARAU                    	AB00000103	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DQ	AB007	103       	EA001     
JRIOS                    	AB00000107	PERF031 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DU	AB004	118       	EA001     
JPARE                    	AB00000110	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	DX	AB010	115       	EA001     
KRODR                    	AB00000117	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EC	1    	127       	EA001     
LARVE                    	AB00000124	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EJ	AB006	130       	EA001     
LNOLA                    	AB00000126	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EL	AB006	139       	EA001     
LMORA                    	AB00000135	PERF036 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EU	AB003	138       	EA001     
LROJA                    	AB00000138	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	EX	AB006	144       	EA001     
LMONT                    	AB00000141	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	F[	AB006	137       	EA001     
LOROZ                    	AB00000142	PERF036 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	F]	AB003	141       	EA001     
LSANC                    	AB00000144	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FB	AB006	145       	EA001     
MMEDI                    	AB00000148	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FF	AB010	158       	EA001     
MPEST                    	AB00000150	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FH	1    	160       	EA001     
MBERD                    	AB00000151	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FI	AB010	150       	EA001     
MRIVA                    	AB00000152	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FJ	AB003	161       	EA001     
MROME                    	AB00000153	PERF030 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FK	AB006	164       	EA001     
MCARP                    	AB00000163	PERF031 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FU	AB003	153       	EA001     
MSILV                    	AB00000164	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FV	AB003	166       	EA001     
MJOGA                    	AB00000165	PERF030 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	FW	AB008	157       	EA001     
OHERR                    	AB00000181	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GK	1    	177       	EA001     
RROJA                    	AB00000188	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GR	AB003	195       	EA001     
RSANT                    	AB00000190	PERF036 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GT	AB004	197       	EA001     
RVERA                    	AB00000195	PERF031 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	GY	AB005	198       	EA001     
VDELG                    	AB00000208	PERF033 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HJ	1    	208       	EA001     
WFERN                    	AB00000210	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HL	AB006	214       	EA001     
YDIAZ                    	AB00000215	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HQ	AB007	221       	EA001     
YBERM                    	AB00000223	PERF028 	E10ADC3949BA59ABBE56E057F20F883E                  	ACTIVO         	HY	AB006	219       	EA001     
\.


--
-- TOC entry 2825 (class 0 OID 0)
-- Dependencies: 326
-- Name: usuario_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuario_id_usuario_seq', 117, true);


--
-- TOC entry 2610 (class 2606 OID 18176)
-- Name: pk_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT pk_usuario PRIMARY KEY (id_usuario);


--
-- TOC entry 2608 (class 1259 OID 18206)
-- Name: addssbddfadfd; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX addssbddfadfd ON usuario USING btree (login);


--
-- TOC entry 2611 (class 1259 OID 18343)
-- Name: relationship_14_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_14_fk ON usuario USING btree (codigoperfil);


--
-- TOC entry 2612 (class 1259 OID 18348)
-- Name: relationship_24_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_24_fk ON usuario USING btree (id_persona);


--
-- TOC entry 2613 (class 1259 OID 18393)
-- Name: usuaddio_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX usuaddio_pk ON usuario USING btree (id_usuario);


--
-- TOC entry 2614 (class 2606 OID 18797)
-- Name: fk_usuario_relations_perfil; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_usuario_relations_perfil FOREIGN KEY (codigoperfil) REFERENCES perfil(codigoperfil) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2615 (class 2606 OID 18802)
-- Name: fk_usuario_relations_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_usuario_relations_persona FOREIGN KEY (id_persona) REFERENCES persona(id_persona) ON UPDATE RESTRICT ON DELETE RESTRICT;


-- Completed on 2015-06-08 10:45:19

--
-- PostgreSQL database dump complete
--

