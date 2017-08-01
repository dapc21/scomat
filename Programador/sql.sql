CREATE TABLE Persona(
	dato character(10) null,
	idPersona character(8) not null,
	cedula character(8) null,
	nombre character(30) null,
	apellido character(30) null,
	CONSTRAINT pk_Persona primary key (idPersona)
);
case Persona:
	AgregarCampoClave=@Persona=@texto=@idPersona=@idPersona=@character=@isAlphanumeric=@8=@=@=@30=@8=@not null=@
	AgregarCampo=@Persona=@texto=@cedula=@Cedula=@character=@isCedula=@8=@=@=@30=@8=@null=@
	AgregarCampo=@Persona=@texto=@nombre=@Nombre=@character=@isName=@30=@=@=@30=@30=@null=@
	AgregarCampo=@Persona=@texto=@apellido=@Apellido=@character=@isName=@30=@=@=@30=@30=@null=@
break;

CREATE TABLE asigna_llamada(
	dato character(10) null,
	id_all character(10) not null,
	ubica_all character(255) null,
	fecha_all date null,
	login_enc character(25) null,
	login_resp character(25) null,
	obser_all character varying(500) null,
	status_all character(20) null,
	CONSTRAINT pk_asigna_llamada primary key (id_all)
);
case asigna_llamada:
	AgregarCampoClave=@asigna_llamada=@texto=@id_all=@id_all=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
	AgregarCampo=@asigna_llamada=@texto=@ubica_all=@ubicacion=@character=@isTexto=@255=@=@=@60=@255=@null=@
	AgregarCampo=@asigna_llamada=@fecha=@fecha_all=@fecha_all=@date=@=@15=@2020=@2014=@15=@15=@null=@
	AgregarCampo=@asigna_llamada=@texto=@login_enc=@login_enc=@character=@isAlphanumeric=@25=@=@=@30=@25=@null=@
	AgregarCampo=@asigna_llamada=@texto=@login_resp=@login_resp=@character=@isAlphanumeric=@25=@=@=@30=@25=@null=@
	AgregarCampo=@asigna_llamada=@area=@obser_all=@observacion=@character varying=@isTexto=@500=@=@=@30=@1=@null=@
	AgregarCampo=@asigna_llamada=@texto=@status_all=@status=@character=@isName=@20=@=@ASIGNADO=@30=@20=@null=@
break;

CREATE TABLE asig_lla_cli(
	dato character(10) null,
	id_lc character(10) not null,
	id_all character(10) null,
	id_contrato character(10) null,
	id_lla character(10) null,
	status_lc character(20) null,
	CONSTRAINT pk_asig_lla_cli primary key (id_lc)
);
case asig_lla_cli:
	AgregarCampoClave=@asig_lla_cli=@texto=@id_lc=@id_lc=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
	AgregarCampo=@asig_lla_cli=@texto=@id_all=@id_all=@character=@isAlphanumeric=@10=@=@=@30=@10=@null=@
	AgregarCampo=@asig_lla_cli=@texto=@id_contrato=@id_contrato=@character=@isAlphanumeric=@10=@=@=@30=@10=@null=@
	AgregarCampo=@asig_lla_cli=@texto=@id_lla=@id_lla=@character=@isAlphanumeric=@10=@=@=@30=@10=@null=@
	AgregarCampo=@asig_lla_cli=@texto=@status_lc=@status_lc=@character=@isName=@20=@=@=@30=@20=@null=@
break;

CREATE TABLE tipo_llamada(
	dato character(10) null,
	id_tll character(10) not null,
	nombre_tll character(100) null,
	status_tll character(15) null,
	CONSTRAINT pk_tipo_llamada primary key (id_tll)
);
case tipo_llamada:
	AgregarCampoClave=@tipo_llamada=@texto=@id_tll=@id_tll=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
	AgregarCampo=@tipo_llamada=@texto=@nombre_tll=@nombre=@character=@isTexto=@100=@=@=@30=@100=@null=@
	AgregarCampo=@tipo_llamada=@radio=@status_tll=@status=@character=@isSelect=@15=@=@ACTIVO;INACTIVO=@1=@1=@null=@
break;

CREATE TABLE llamadas(
	dato character(10) null,
	id_lla character(10) not null,
	id_drl character(10) null,
	id_tll character(10) null,
	id_contrato character(10) null,
	fecha_lla date null,
	hora_lla time null,
	login character(25) null,
	obser_lla character varying(500) null,
	crea_alarma character(5) null,
	CONSTRAINT pk_llamadas primary key (id_lla)
);
case llamadas:
	AgregarCampoClave=@llamadas=@texto=@id_lla=@id_lla=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
	AgregarCampo=@llamadas=@lista=@id_drl=@DETALLE LLAMADA=@character=@isSelect=@10=@=@1,1=@1=@1=@null=@
	AgregarCampo=@llamadas=@lista=@id_tll=@TIPO LLAMADA=@character=@isSelect=@10=@=@1,1=@1=@1=@null=@
	AgregarCampo=@llamadas=@texto=@id_contrato=@id_contrato=@character=@isAlphanumeric=@10=@=@=@30=@10=@null=@
	AgregarCampo=@llamadas=@fecha=@fecha_lla=@fecha=@date=@=@15=@2020=@2014=@15=@15=@null=@
	AgregarCampo=@llamadas=@texto=@hora_lla=@hora=@time=@isTexto=@=@=@=@30=@10=@null=@
	AgregarCampo=@llamadas=@texto=@login=@login=@character=@isAlphanumeric=@25=@=@=@30=@25=@null=@
	AgregarCampo=@llamadas=@area=@obser_lla=@observacion=@character varying=@isTexto=@500=@=@=@30=@1=@null=@
	AgregarCampo=@llamadas=@radio=@crea_alarma=@crear alarma=@character=@isSelect=@5=@=@NO;SI=@1=@1=@null=@
break;

CREATE TABLE detalle_resp(
	dato character(10) null,
	id_drl character(10) not null,
	id_trl character(10) null,
	nombre_drl character(100) null,
	status_drl character(15) null,
	CONSTRAINT pk_detalle_resp primary key (id_drl)
);
case detalle_resp:
	AgregarCampoClave=@detalle_resp=@texto=@id_drl=@id_drl=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
	AgregarCampo=@detalle_resp=@lista=@id_trl=@TIPO LLAMADA=@character=@isSelect=@10=@=@1,1=@1=@1=@null=@
	AgregarCampo=@detalle_resp=@texto=@nombre_drl=@NOMBRE=@character=@isTexto=@100=@=@=@30=@100=@null=@
	AgregarCampo=@detalle_resp=@radio=@status_drl=@status=@character=@isSelect=@15=@=@ACTIVO;INACTIVO=@1=@1=@null=@
break;

CREATE TABLE tipo_resp(
	dato character(10) null,
	id_trl character(10) not null,
	nombre_trl character(50) null,
	status_trl character(15) null,
	CONSTRAINT pk_tipo_resp primary key (id_trl)
);
case tipo_resp:
	AgregarCampoClave=@tipo_resp=@texto=@id_trl=@id_trl=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
	AgregarCampo=@tipo_resp=@texto=@nombre_trl=@nombre=@character=@isTexto=@50=@=@=@30=@50=@null=@
	AgregarCampo=@tipo_resp=@radio=@status_trl=@status=@character=@isSelect=@15=@=@ACTIVO;INACTIVO=@1=@1=@null=@
break;
CREATE  VIEW vista_llamadas AS select tipo_llamada.dato, tipo_llamada.id_tll, tipo_llamada.nombre_tll, tipo_llamada.status_tll, llamadas.id_lla, llamadas.id_drl, llamadas.id_contrato, llamadas.fecha_lla, llamadas.hora_lla, llamadas.login, llamadas.obser_lla, llamadas.crea_alarma, detalle_resp.id_trl, detalle_resp.nombre_drl, detalle_resp.status_drl, tipo_resp.nombre_trl, tipo_resp.status_trl, vista_contrato_auditoria.id_persona, vista_contrato_auditoria.cli_id_persona, vista_contrato_auditoria.nro_contrato, vista_contrato_auditoria.fecha_contrato, vista_contrato_auditoria.etiqueta, vista_contrato_auditoria.costo_dif_men, vista_contrato_auditoria.status_contrato, vista_contrato_auditoria.nro_factura, vista_contrato_auditoria.cedula, vista_contrato_auditoria.nombre, vista_contrato_auditoria.apellido, vista_contrato_auditoria.telefono, vista_contrato_auditoria.telf_casa, vista_contrato_auditoria.telf_adic, vista_contrato_auditoria.direc_adicional, vista_contrato_auditoria.numero_casa, vista_contrato_auditoria.edificio, vista_contrato_auditoria.numero_piso, vista_contrato_auditoria.urbanizacion, vista_contrato_auditoria.id_g_a, vista_contrato_auditoria.nombre_g_a, vista_contrato_auditoria.id_calle, vista_contrato_auditoria.nombre_calle, vista_contrato_auditoria.id_sector, vista_contrato_auditoria.nombre_sector, vista_contrato_auditoria.id_zona, vista_contrato_auditoria.nombre_zona, vista_contrato_auditoria.id_ciudad, vista_contrato_auditoria.id_mun, vista_contrato_auditoria.nombre_ciudad, vista_contrato_auditoria.id_esta, vista_contrato_auditoria.nombre_mun, vista_contrato_auditoria.id_franq, vista_contrato_auditoria.nombre_esta, vista_contrato_auditoria.nombre_franq, vista_contrato_auditoria.postel, vista_contrato_auditoria.pto, vista_contrato_auditoria.cod_id_persona, vista_contrato_auditoria.cobrador, vista_contrato_auditoria.etiqueta_n, vista_contrato_auditoria.taps, vista_contrato_auditoria.tipo_fact from tipo_llamada, llamadas, detalle_resp, tipo_resp, vista_contrato_auditoria where tipo_llamada.id_tll = llamadas.id_tll and llamadas.id_drl = detalle_resp.id_drl and detalle_resp.id_trl = tipo_resp.id_trl and llamadas.id_contrato = vista_contrato_auditoria.id_contrato order by llamadas.fecha_lla Desc,llamadas.hora_lla Desc
);
CREATE TABLE cat_inc(
	dato character(10) null,
	id_cat_s character(8) not null,
	nombre_cat_s character(100) null,
	status_cat_s character(10) null,
	CONSTRAINT pk_cat_inc primary key (id_cat_s)
);
case cat_inc:
	AgregarCampoClave=@cat_inc=@texto=@id_cat_s=@id_cat_s=@character=@isAlphanumeric=@8=@=@=@30=@8=@not null=@
	AgregarCampo=@cat_inc=@texto=@nombre_cat_s=@categoria=@character=@isTexto=@100=@=@=@30=@100=@null=@
	AgregarCampo=@cat_inc=@radio=@status_cat_s=@status_cat_s=@character=@isSelect=@10=@=@ACTIVO;INACTIVO=@1=@1=@null=@
break;

	CREATE TABLE sub_cat_inc(
		dato character(10) null,
		id_sub_cat_s character(8) not null,
		id_cat_s character(8) null,
		nombre_sub_cat_s character(200) null,
		status_sub_cat_s character(10) null,
		CONSTRAINT pk_sub_cat_inc primary key (id_sub_cat_s)
	);
	case sub_cat_inc:
		AgregarCampoClave=@sub_cat_inc=@texto=@id_sub_cat_s=@id_sub_cat_s=@character=@isAlphanumeric=@8=@=@=@30=@8=@not null=@
		AgregarCampo=@sub_cat_inc=@lista=@id_cat_s=@categoria=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
		AgregarCampo=@sub_cat_inc=@texto=@nombre_sub_cat_s=@Sub categoria=@character=@isTexto=@200=@=@=@200=@30=@null=@
		AgregarCampo=@sub_cat_inc=@radio=@status_sub_cat_s=@status=@character=@isSelect=@10=@=@ACTIVO;INACTIVO=@1=@1=@null=@
	break;

	CREATE TABLE incidencia(
		dato character(10) null,
		nro_inc character(10) not null,
		id_sub_cat_s character(8) null,
		fecha_inc date null,
		prioridad_inc character(30) null,
		fecha_sol date null,
		fecha_ven date null,
		incidencia character varying(500) null,
		solucion_inc character varying(500) null,
		obser_inc character varying(500) null,
		login_resp character(25) null,
		status_inc character(20) null,
		tipo_inc character(20) null,
		id_contacto character(10) null,
		id_contrato character(10) null,
		CONSTRAINT pk_incidencia primary key (nro_inc)
	);
	case incidencia:
		AgregarCampoClave=@incidencia=@texto=@nro_inc=@nro_inc=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
		AgregarCampo=@incidencia=@lista=@id_sub_cat_s=@Sub categoria=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
		AgregarCampo=@incidencia=@fecha=@fecha_inc=@fecha inc=@date=@=@15=@2020=@2014=@15=@15=@null=@
		AgregarCampo=@incidencia=@lista=@prioridad_inc=@prioridad=@character=@isSelect=@30=@=@REGISTRADA,REGISTRADA;ASIGNADA,ASIGNADA;EN SOLUCION,EN SOLUCION;REASIGNADO,REASIGNADO;SOLUCIONADO,SOLUCIONADO;SIN SOLUCION,SIN SOLUCION;CANCELADO,CANCELADO=@1=@1=@null=@
		AgregarCampo=@incidencia=@fecha=@fecha_sol=@fecha sol=@date=@=@15=@2020=@2014=@15=@15=@null=@
		AgregarCampo=@incidencia=@fecha=@fecha_ven=@fecha ven=@date=@=@15=@2020=@2014=@15=@15=@null=@
		AgregarCampo=@incidencia=@area=@incidencia=@incidencia reg=@character varying=@isTexto=@500=@=@=@30=@2=@null=@
		AgregarCampo=@incidencia=@area=@solucion_inc=@solucion_inc=@character varying=@isTexto=@500=@=@=@30=@2=@null=@
		AgregarCampo=@incidencia=@area=@obser_inc=@observacion=@character varying=@isTexto=@500=@=@=@30=@2=@null=@
		AgregarCampo=@incidencia=@texto=@login_resp=@login_resp=@character=@isAlphanumeric=@25=@=@=@30=@25=@null=@
		AgregarCampo=@incidencia=@lista=@status_inc=@status=@character=@isSelect=@20=@=@BAJA,BAJA;MEDIA,MEDIA;ALTA,ALTA=@1=@1=@null=@
		AgregarCampo=@incidencia=@lista=@tipo_inc=@tipo_inc=@character=@isSelect=@20=@=@PRIVADO,PRIVADO;PUBLICO,PUBLICO=@1=@1=@null=@
		AgregarCampo=@incidencia=@texto=@id_contacto=@id_contacto=@character=@isAlphanumeric=@10=@=@=@30=@10=@null=@
		AgregarCampo=@incidencia=@texto=@id_contrato=@id_contrato=@character=@isAlphanumeric=@10=@=@10=@30=@10=@null=@
	break;

	CREATE TABLE ayuda_inc(
		dato character(10) null,
		id_ay character(10) not null,
		nro_inc integer null,
		login character(25) null,
		descripcion character varying(500) null,
		fecha date null,
		CONSTRAINT pk_ayuda_inc primary key (id_ay)
	);

	CREATE TABLE sub_cat_inc(
		dato character(10) null,
		id_sub_cat_s character(8) not null,
		id_cat_s character(8) null,
		nombre_sub_cat_s character(200) null,
		status_sub_cat_s character(10) null,
		CONSTRAINT pk_sub_cat_inc primary key (id_sub_cat_s)
	);
	case sub_cat_inc:
		AgregarCampoClave=@sub_cat_inc=@texto=@id_sub_cat_s=@id_sub_cat_s=@character=@isAlphanumeric=@8=@=@=@30=@8=@not null=@
		AgregarCampo=@sub_cat_inc=@lista=@id_cat_s=@categoria=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
		AgregarCampo=@sub_cat_inc=@texto=@nombre_sub_cat_s=@Sub categoria=@character=@isTexto=@200=@=@=@200=@30=@null=@
		AgregarCampo=@sub_cat_inc=@radio=@status_sub_cat_s=@status=@character=@isSelect=@10=@=@ACTIVO;INACTIVO=@1=@1=@null=@
	break;

	CREATE TABLE incidencia(
		dato character(10) null,
		nro_inc character(10) not null,
		id_sub_cat_s character(8) null,
		fecha_inc date null,
		prioridad_inc character(30) null,
		fecha_sol date null,
		fecha_ven date null,
		incidencia character varying(500) null,
		solucion_inc character varying(500) null,
		obser_inc character varying(500) null,
		login_resp character(25) null,
		status_inc character(20) null,
		tipo_inc character(20) null,
		id_contacto character(10) null,
		id_contrato character(10) null,
		CONSTRAINT pk_incidencia primary key (nro_inc)
	);
	case incidencia:
		AgregarCampoClave=@incidencia=@texto=@nro_inc=@nro_inc=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
		AgregarCampo=@incidencia=@lista=@id_sub_cat_s=@Sub categoria=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
		AgregarCampo=@incidencia=@fecha=@fecha_inc=@fecha inc=@date=@=@15=@2020=@2014=@15=@15=@null=@
		AgregarCampo=@incidencia=@lista=@prioridad_inc=@prioridad=@character=@isSelect=@30=@=@REGISTRADA,REGISTRADA;ASIGNADA,ASIGNADA;EN SOLUCION,EN SOLUCION;REASIGNADO,REASIGNADO;SOLUCIONADO,SOLUCIONADO;SIN SOLUCION,SIN SOLUCION;CANCELADO,CANCELADO=@1=@1=@null=@
		AgregarCampo=@incidencia=@fecha=@fecha_sol=@fecha sol=@date=@=@15=@2020=@2014=@15=@15=@null=@
		AgregarCampo=@incidencia=@fecha=@fecha_ven=@fecha ven=@date=@=@15=@2020=@2014=@15=@15=@null=@
		AgregarCampo=@incidencia=@area=@incidencia=@incidencia reg=@character varying=@isTexto=@500=@=@=@30=@2=@null=@
		AgregarCampo=@incidencia=@area=@solucion_inc=@solucion_inc=@character varying=@isTexto=@500=@=@=@30=@2=@null=@
		AgregarCampo=@incidencia=@area=@obser_inc=@observacion=@character varying=@isTexto=@500=@=@=@30=@2=@null=@
		AgregarCampo=@incidencia=@texto=@login_resp=@login_resp=@character=@isAlphanumeric=@25=@=@=@30=@25=@null=@
		AgregarCampo=@incidencia=@lista=@status_inc=@status=@character=@isSelect=@20=@=@BAJA,BAJA;MEDIA,MEDIA;ALTA,ALTA=@1=@1=@null=@
		AgregarCampo=@incidencia=@lista=@tipo_inc=@tipo_inc=@character=@isSelect=@20=@=@PRIVADO,PRIVADO;PUBLICO,PUBLICO=@1=@1=@null=@
		AgregarCampo=@incidencia=@texto=@id_contacto=@id_contacto=@character=@isAlphanumeric=@10=@=@=@30=@10=@null=@
		AgregarCampo=@incidencia=@texto=@id_contrato=@id_contrato=@character=@isAlphanumeric=@10=@=@10=@30=@10=@null=@
	break;

	CREATE TABLE ayuda_inc(
		dato character(10) null,
		id_ay character(10) not null,
		nro_inc integer null,
		login character(25) null,
		descripcion character varying(500) null,
		fecha date null,
		CONSTRAINT pk_ayuda_inc primary key (id_ay)
	);
case ayuda_inc:
	AgregarCampoClave=@ayuda_inc=@texto=@id_ay=@id_ay=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
	AgregarCampo=@ayuda_inc=@texto=@nro_inc=@nro_inc=@integer=@isNumber=@=@=@=@30=@10=@null=@
	AgregarCampo=@ayuda_inc=@texto=@login=@login=@character=@isAlphanumeric=@25=@=@=@30=@25=@null=@
	AgregarCampo=@ayuda_inc=@area=@descripcion=@descripcion=@character varying=@isTexto=@500=@=@=@30=@2=@null=@
	AgregarCampo=@ayuda_inc=@fecha=@fecha=@fecha=@date=@=@15=@2020=@2012=@15=@15=@null=@
break;
CREATE  VIEW vista_subcategoria AS select sub_cat_inc.id_sub_cat_s, sub_cat_inc.id_cat_s, sub_cat_inc.nombre_sub_cat_s, sub_cat_inc.status_sub_cat_s, tipo_inc.id_ti, tipo_inc.tipo_ti, tipo_inc.status_ti, cat_inc.nombre_cat_s, cat_inc.status_cat_s from sub_cat_inc, tipo_inc, cat_inc where tipo_inc.id_ti = cat_inc.id_ti and cat_inc.id_cat_s = sub_cat_inc.id_cat_s
);CREATE  VIEW vista_incidencia AS select incidencia.nro_inc, incidencia.id_sub_cat_s, incidencia.fecha_inc, incidencia.prioridad_inc, incidencia.fecha_sol, incidencia.fecha_ven, incidencia.incidencia, incidencia.solucion_inc, incidencia.obser_inc, incidencia.login_resp, incidencia.status_inc, incidencia.tipo_inc, incidencia.id_contacto, incidencia.id_contrato, vista_contratoclic.id_cli, vista_contratoclic.id_tipo_cli, vista_contratoclic.id_status_cli, vista_contratoclic.razon_social, vista_contratoclic.rif_cli, vista_contratoclic.obser_cli, vista_contratoclic.id_g_a, vista_contratoclic.nro_contrato, vista_contratoclic.fecha_contrato, vista_contratoclic.observacion, vista_contratoclic.costo_contrato, vista_contratoclic.status_contrato, vista_contratoclic.nro_factura, vista_contratoclic.frecuencia_pago, vista_contratoclic.meses_cortesia, vista_contratoclic.nombre_est_cli, vista_contratoclic.status_sc, vista_contratoclic.nombre_tipo, vista_contratoclic.status_tipo, vista_contratoclic.nombre_g_a, vista_contratoclic.status_g_a, vista_contratoclic.id_dir, vista_contratoclic.id_ciudad, vista_contratoclic.calle, vista_contratoclic.sector, vista_contratoclic.edif, vista_contratoclic.nro_piso, vista_contratoclic.nro_casa, vista_contratoclic.parroquia, vista_contratoclic.referencia, vista_contratoclic.id_mun, vista_contratoclic.nombre_ciudad, vista_contratoclic.status_ciudad, vista_contratoclic.id_esta, vista_contratoclic.nombre_mun, vista_contratoclic.status_mun, vista_contratoclic.id_pais, vista_contratoclic.nombre_esta, vista_contratoclic.status_esta, vista_contratoclic.nombre_pais, vista_contratoclic.status_pais, vista_contratoclic.telefono_cli, vista_contratoclic.email_cli, vista_contratoclic.ciudad, vista_contratoclic.cabecera, vista_contratoclic.tipo_contrato, vista_contratoclic.cob_id_persona, vista_contratoclic.tipo_aviso, vista_contratoclic.cobrador, vista_contratoclic.hgts, vista_contratoclic.otro, vista_contratoclic.tipo_factura, vista_contacto_cli.id_persona, vista_contacto_cli.cedula, vista_contacto_cli.nombre, vista_contacto_cli.apellido, vista_contacto_cli.telefono, vista_contacto_cli.saludo, vista_contacto_cli.telf_particular, vista_contacto_cli.telf_trabajo, vista_contacto_cli.fax, vista_contacto_cli.email, vista_contacto_cli.tipo_contacto, vista_contacto_cli.obser_cont, vista_contacto_cli.ext_cont, vista_contacto_cli.status_cont, vista_contacto_cli.id_gru_c, vista_contacto_cli.franq, vista_contacto_cli.direc, vista_contacto_cli.id_tcontc, vista_contacto_cli.id_tcont, vista_contacto_cli.nombre_tcont, vista_contacto_cli.tipo_tcont, vista_contacto_cli.status_tcont, vista_subcategoria.id_cat_s, vista_subcategoria.nombre_sub_cat_s, vista_subcategoria.status_sub_cat_s, vista_subcategoria.id_ti, vista_subcategoria.tipo_ti, vista_subcategoria.status_ti, vista_subcategoria.nombre_cat_s, vista_subcategoria.status_cat_s from incidencia, vista_contratoclic, vista_contacto_cli, vista_subcategoria where incidencia.id_sub_cat_s = vista_subcategoria.id_sub_cat_s and vista_contratoclic.id_cli = incidencia.id_contrato and incidencia.id_contacto = vista_contacto_cli.id_persona order by incidencia.nro_inc Asc
);
CREATE TABLE detalle_tipopago_df(
	dato character(10) null,
	id_dbf character(8) not null,
	id_tipo_pago character(8) null,
	id_cuba character(8) null,
	id_df_tp character(8) null,
	fecha_dbf date null,
	refer_dbf character(25) null,
	monto_dbf numeric(10,2) null,
	obser_dbf character(255) null,
	status_dbf character(20) null,
	hora_dbf time null,
	login_dbf character(25) null,
	CONSTRAINT pk_detalle_tipopago_df primary key (id_dbf)
);
case detalle_tipopago_df:
	AgregarCampoClave=@detalle_tipopago_df=@texto=@id_dbf=@id_dbf=@character=@isAlphanumeric=@8=@=@=@30=@8=@not null=@
	AgregarCampo=@detalle_tipopago_df=@lista=@id_tipo_pago=@id_tipo_pago=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
	AgregarCampo=@detalle_tipopago_df=@lista=@id_cuba=@cuenta bancaria=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
	AgregarCampo=@detalle_tipopago_df=@lista=@id_df_tp=@pagos pendientes=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
	AgregarCampo=@detalle_tipopago_df=@fecha=@fecha_dbf=@fecha pago=@date=@=@15=@2020=@2014=@15=@15=@null=@
	AgregarCampo=@detalle_tipopago_df=@texto=@refer_dbf=@referencia=@character=@isInteger=@25=@=@=@30=@25=@null=@
	AgregarCampo=@detalle_tipopago_df=@texto=@monto_dbf=@monto=@numeric=@isNumber=@10=@2=@=@30=@10=@null=@
	AgregarCampo=@detalle_tipopago_df=@area=@obser_dbf=@observacion=@character=@isTexto=@255=@=@=@2=@30=@null=@
	AgregarCampo=@detalle_tipopago_df=@texto=@status_dbf=@status=@character=@isTexto=@20=@=@REGISTRADO=@30=@20=@null=@
	AgregarCampo=@detalle_tipopago_df=@texto=@hora_dbf=@hora=@time=@isTexto=@=@=@=@30=@8=@null=@
	AgregarCampo=@detalle_tipopago_df=@texto=@login_dbf=@login=@character=@isTexto=@25=@=@=@30=@25=@null=@
break;

CREATE TABLE carga_tabla_banco(
	dato character(10) null,
	id_ctb character(8) not null,
	id_cuba character(8) null,
	fecha_ctb date null,
	hora_ctb time null,
	login_ctb character(25) null,
	fecha_desde_ctb date null,
	fecha_hasta_ctb date null,
	status_ctb character(20) null,
	CONSTRAINT pk_carga_tabla_banco primary key (id_ctb)
);
case carga_tabla_banco:
	AgregarCampoClave=@carga_tabla_banco=@texto=@id_ctb=@id_ctb=@character=@isAlphanumeric=@8=@=@=@30=@30=@not null=@
	AgregarCampo=@carga_tabla_banco=@lista=@id_cuba=@cuenta bancaria=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
	AgregarCampo=@carga_tabla_banco=@fecha=@fecha_ctb=@fecha=@date=@=@15=@2020=@2014=@15=@15=@null=@
	AgregarCampo=@carga_tabla_banco=@texto=@hora_ctb=@hora=@time=@isTexto=@=@=@=@30=@8=@null=@
	AgregarCampo=@carga_tabla_banco=@texto=@login_ctb=@login=@character=@isTexto=@25=@=@=@30=@25=@null=@
	AgregarCampo=@carga_tabla_banco=@fecha=@fecha_desde_ctb=@fecha desde=@date=@=@15=@2020=@2014=@15=@15=@null=@
	AgregarCampo=@carga_tabla_banco=@fecha=@fecha_hasta_ctb=@fecha hasta=@date=@=@15=@2020=@2014=@15=@15=@null=@
	AgregarCampo=@carga_tabla_banco=@texto=@status_ctb=@status=@character=@isTexto=@20=@=@=@30=@20=@null=@
break;

CREATE TABLE tabla_bancos(
	dato character(10) null,
	id_tb character(10) not null,
	id_ctb character(8) null,
	fecha_tb date null,
	tipo_tb character(30) null,
	referencia_tb character(30) null,
	monto_tb numeric(10,2) null,
	descrip_tb character(255) null,
	status_tb character(20) null,
	CONSTRAINT pk_tabla_bancos primary key (id_tb)
);
case tabla_bancos:
	AgregarCampoClave=@tabla_bancos=@texto=@id_tb=@id_tb=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
	AgregarCampo=@tabla_bancos=@texto=@id_ctb=@id_ctb=@character=@isAlphanumeric=@8=@=@=@30=@8=@null=@
	AgregarCampo=@tabla_bancos=@fecha=@fecha_tb=@fecha_tb=@date=@=@15=@2020=@2014=@15=@15=@null=@
	AgregarCampo=@tabla_bancos=@texto=@tipo_tb=@tipo_tb=@character=@isTexto=@30=@=@=@30=@30=@null=@
	AgregarCampo=@tabla_bancos=@texto=@referencia_tb=@referencia_tb=@character=@isTexto=@30=@=@=@30=@30=@null=@
	AgregarCampo=@tabla_bancos=@texto=@monto_tb=@monto_tb=@numeric=@isNumber=@10=@2=@=@30=@10=@null=@
	AgregarCampo=@tabla_bancos=@area=@descrip_tb=@descrip_tb=@character=@isTexto=@255=@=@=@30=@2=@null=@
	AgregarCampo=@tabla_bancos=@texto=@status_tb=@status_tb=@character=@isTexto=@20=@=@=@30=@20=@null=@
break;

CREATE TABLE tipo_pago_df(
	dato character(10) null,
	id_tipo_pago character(8) not null,
	tipo_pago character(30) null,
	tipo_tp character(15) null,
	status_pago character(15) null,
	CONSTRAINT pk_tipo_pago_df primary key (id_tipo_pago)
);
case tipo_pago_df:
	AgregarCampoClave=@tipo_pago_df=@texto=@id_tipo_pago=@id_tipo_pago=@character=@isAlphanumeric=@8=@=@=@30=@8=@not null=@
	AgregarCampo=@tipo_pago_df=@texto=@tipo_pago=@tipo de pago=@character=@isTexto=@30=@=@=@30=@30=@null=@
	AgregarCampo=@tipo_pago_df=@lista=@tipo_tp=@tipo tp=@character=@isSelect=@15=@=@FACTURAS,FACTURAS;PAGOS,PAGOS=@1=@1=@null=@
	AgregarCampo=@tipo_pago_df=@radio=@status_pago=@status=@character=@isSelect=@15=@=@ACTIVO;INACTIVO=@1=@1=@null=@
break;
CREATE  VIEW vista_pagopendiente AS select estacion_trabajo.id_est, estacion_trabajo.login, estacion_trabajo.nombre_est, estacion_trabajo.ip_est, estacion_trabajo.mac_est, estacion_trabajo.nom_comp, estacion_trabajo.status_est, deposito_franq.id_df, deposito_franq.fecha_df, deposito_franq.reporte_z, deposito_franq.monto_z, deposito_franq.fact_desde, deposito_franq.status_df, deposito_franq.tipo_fact, deposito_franq.hora_df, deposito_franq.login_df, deposito_franq.fact_hasta, deposito_franq_tp.id_df_tp, deposito_franq_tp.id_tipo_pago, deposito_franq_tp.monto_df_tp, deposito_franq_tp.status_df_tp, tipo_pago_df.tipo_pago, tipo_pago_df.tipo_tp, tipo_pago_df.status_pago from estacion_trabajo, deposito_franq, deposito_franq_tp, tipo_pago_df where estacion_trabajo.id_est = deposito_franq.id_est and deposito_franq.id_df = deposito_franq_tp.id_df and deposito_franq_tp.id_tipo_pago = tipo_pago_df.id_tipo_pago
);CREATE  VIEW vista_pagosfranquicia AS select detalle_tipopago_df.id_dbf, detalle_tipopago_df.id_tipo_pago, detalle_tipopago_df.id_cuba, detalle_tipopago_df.id_df_tp, detalle_tipopago_df.fecha_dbf, detalle_tipopago_df.refer_dbf, detalle_tipopago_df.monto_dbf, detalle_tipopago_df.obser_dbf, detalle_tipopago_df.status_dbf, detalle_tipopago_df.hora_dbf, detalle_tipopago_df.login_dbf, cuenta_bancaria.numero_cuba, cuenta_bancaria.banco_cuba, cuenta_bancaria.abrev_cuba, cuenta_bancaria.desc_cuba, cuenta_bancaria.status_cuba, tipo_pago_df.tipo_pago, tipo_pago_df.tipo_tp, tipo_pago_df.status_pago from detalle_tipopago_df, cuenta_bancaria, tipo_pago_df where detalle_tipopago_df.id_cuba = cuenta_bancaria.id_cuba and detalle_tipopago_df.id_tipo_pago = tipo_pago_df.id_tipo_pago
);CREATE  VIEW vista_tablabancos AS select carga_tabla_banco.id_ctb, carga_tabla_banco.id_cuba, carga_tabla_banco.hora_ctb, carga_tabla_banco.login_ctb, carga_tabla_banco.fecha_desde_ctb, carga_tabla_banco.fecha_hasta_ctb, carga_tabla_banco.status_ctb, tabla_bancos.id_tb, tabla_bancos.fecha_tb, tabla_bancos.tipo_tb, tabla_bancos.referencia_tb, tabla_bancos.monto_tb, tabla_bancos.descrip_tb, tabla_bancos.status_tb, tabla_bancos.saldo, cuenta_bancaria.numero_cuba, cuenta_bancaria.banco_cuba, cuenta_bancaria.abrev_cuba, cuenta_bancaria.desc_cuba, cuenta_bancaria.status_cuba, cuenta_bancaria.conc_cliente, cuenta_bancaria.conc_franq, cuenta_bancaria.formato_archivo, carga_tabla_banco.fecha_ctb from carga_tabla_banco, tabla_bancos, cuenta_bancaria where carga_tabla_banco.id_ctb = tabla_bancos.id_ctb and carga_tabla_banco.id_cuba = cuenta_bancaria.id_cuba
);
CREATE TABLE ejemplo(
	dato character(10) null
);
case ejemplo:
break;

CREATE TABLE prueba(
	dato character(10) null
);
case prueba:
break;
CREATE  VIEW vista_ejemplore AS select persona.dato, persona.idpersona, persona.cedula, persona.nombre, persona.apellido, usuario.login, usuario.codigoperfil, usuario.cedulaempleado, usuario.password, usuario.statususuario from persona, usuario where persona.cedula = usuario.cedulaempleado
);