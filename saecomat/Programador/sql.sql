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

CREATE TABLE motivo_inv(
	dato character(10) null,
	id_motivo character(10) not null,
	nombre_motivo character(30) null,
	status_motivo character(10) null,
	CONSTRAINT pk_motivo_inv primary key (id_motivo)
);
case motivo_inv:
	AgregarCampoClave=@motivo_inv=@texto=@id_motivo=@id_motivo=@character=@isAlphanumeric=@10=@=@=@30=@3=@not null=@
	AgregarCampo=@motivo_inv=@texto=@nombre_motivo=@nombre=@character=@isTexto=@30=@=@=@30=@30=@null=@
	AgregarCampo=@motivo_inv=@radio=@status_motivo=@Status=@character=@isSelect=@10=@=@ACTIVO;INACTIVO=@1=@1=@null=@
break;

CREATE TABLE familia(
	dato character(10) null,
	id_fam character(5) not null,
	nombre_fam character(10) null,
	status_fam character(10) null,
	CONSTRAINT pk_familia primary key (id_fam)
);
case familia:
	AgregarCampoClave=@familia=@texto=@id_fam=@id_fam=@character=@isAlphabetic=@5=@=@=@30=@5=@not null=@
	AgregarCampo=@familia=@texto=@nombre_fam=@Nombre Familia=@character=@isTexto=@10=@=@=@30=@50=@null=@
	AgregarCampo=@familia=@radio=@status_fam=@Status=@character=@isSelect=@10=@=@ACTIVO;INACTIVO=@1=@1=@null=@
break;

CREATE TABLE inventario_materiales(
	dato character(10) null,
	id_mat character(10) not null,
	id_inv character(10) null,
	cant_sist character(10) null,
	cant_real character(10) null,
	justi_inv character(10) null,
	CONSTRAINT pk_inventario_materiales primary key (id_mat)
);
case inventario_materiales:
	AgregarCampoClave=@inventario_materiales=@texto=@id_mat=@id_mat=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
	AgregarCampo=@inventario_materiales=@texto=@id_inv=@id_inv=@character=@isAlphanumeric=@10=@=@=@30=@8=@null=@
	AgregarCampo=@inventario_materiales=@texto=@cant_sist=@cant_sist=@character=@isInteger=@10=@=@=@30=@8=@null=@
	AgregarCampo=@inventario_materiales=@texto=@cant_real=@cant_real=@character=@isNumber=@10=@=@=@30=@8=@null=@
	AgregarCampo=@inventario_materiales=@area=@justi_inv=@justi_inv=@character=@isTexto=@10=@=@=@20=@2=@null=@
break;

CREATE TABLE deposito(
	dato character(10) null,
	id_dep character(10) not null,
	nombre_dep character(10) null,
	descrip_dep character(10) null,
	status_dep character(10) null,
	CONSTRAINT pk_deposito primary key (id_dep)
);
case deposito:
	AgregarCampoClave=@deposito=@texto=@id_dep=@id_dep=@character=@isAlphanumeric=@10=@=@=@30=@8=@not null=@
	AgregarCampo=@deposito=@texto=@nombre_dep=@Nombre Deposito=@character=@isTexto=@10=@=@=@40=@50=@null=@
	AgregarCampo=@deposito=@area=@descrip_dep=@Descripcion Deposito=@character=@isTexto=@10=@=@=@20=@2=@null=@
	AgregarCampo=@deposito=@radio=@status_dep=@Status=@character=@isSelect=@10=@=@ACTIVO;INACTIVO=@1=@1=@null=@
break;

CREATE TABLE unidad_medida(
	dato character(10) null,
	id_unidad character(10) not null,
	nombre_unidad character(10) null,
	unidad_ent character(10) null,
	unidad_sal character(10) null,
	status_unidad character(10) null,
	CONSTRAINT pk_unidad_medida primary key (id_unidad)
);
case unidad_medida:
	AgregarCampoClave=@unidad_medida=@texto=@id_unidad=@id_unidad=@character=@isAlphanumeric=@10=@=@=@30=@8=@not null=@
	AgregarCampo=@unidad_medida=@texto=@nombre_unidad=@Nombre Unidad=@character=@isTexto=@10=@=@=@30=@30=@null=@
	AgregarCampo=@unidad_medida=@texto=@unidad_ent=@Unidad Entrante=@character=@isInteger=@10=@=@=@30=@10=@null=@
	AgregarCampo=@unidad_medida=@texto=@unidad_sal=@Unidad Saliente=@character=@isInteger=@10=@=@=@30=@10=@null=@
	AgregarCampo=@unidad_medida=@casilla=@status_unidad=@Status=@character=@isTexto=@10=@=@ACTIVO;INACTIVO=@1=@1=@null=@
break;

CREATE TABLE tipo_movimiento(
	dato character(10) null,
	id_tm character(10) not null,
	nombre_tm character(10) null,
	tipo_ent_sal character(10) null,
	uso_tm character(10) null,
	status_tm character(10) null,
	CONSTRAINT pk_tipo_movimiento primary key (id_tm)
);
case tipo_movimiento:
	AgregarCampoClave=@tipo_movimiento=@texto=@id_tm=@id_tm=@character=@isAlphanumeric=@10=@=@=@30=@8=@not null=@
	AgregarCampo=@tipo_movimiento=@texto=@nombre_tm=@Nombre Tipo Movimiento=@character=@isTexto=@10=@=@=@40=@50=@null=@
	AgregarCampo=@tipo_movimiento=@texto=@tipo_ent_sal=@Tipo Entrada Saliente=@character=@isTexto=@10=@=@=@30=@10=@null=@
	AgregarCampo=@tipo_movimiento=@texto=@uso_tm=@Uso Tipo de Movimiento=@character=@isTexto=@10=@=@=@30=@15=@null=@
	AgregarCampo=@tipo_movimiento=@casilla=@status_tm=@Status=@character=@isTexto=@10=@=@ACTIVO;INACTIVO=@1=@1=@null=@
break;

CREATE TABLE movimiento(
	dato character(10) null,
	id_mov character(10) not null,
	id_tm character(10) null,
	fecha_ent_sal date null,
	hora_ent_sal character(10) null,
	observacion character(10) null,
	referencia character(10) null,
	tipo_mov character(10) null,
	CONSTRAINT pk_movimiento primary key (id_mov)
);
case movimiento:
	AgregarCampoClave=@movimiento=@texto=@id_mov=@id_mov=@character=@isAlphanumeric=@10=@=@=@30=@8=@not null=@
	AgregarCampo=@movimiento=@texto=@id_tm=@id_tm=@character=@isAlphanumeric=@10=@=@=@30=@8=@null=@
	AgregarCampo=@movimiento=@fecha=@fecha_ent_sal=@Fecha=@date=@=@15=@2020=@2012=@15=@15=@null=@
	AgregarCampo=@movimiento=@texto=@hora_ent_sal=@Hora=@character=@isTexto=@10=@=@=@30=@15=@null=@
	AgregarCampo=@movimiento=@area=@observacion=@observacion=@character=@isTexto=@10=@=@=@20=@2=@null=@
	AgregarCampo=@movimiento=@texto=@referencia=@referencia=@character=@isTexto=@10=@=@=@30=@15=@null=@
	AgregarCampo=@movimiento=@texto=@tipo_mov=@tipo_mov=@character=@isTexto=@10=@=@=@30=@20=@null=@
break;

CREATE TABLE proveedor(
	dato character(10) null,
	id_prov character(10) not null,
	rif_prov character(10) null,
	nombre_prov character(10) null,
	direccion_prov character(10) null,
	telefonos_prov character(10) null,
	fax_prov character(10) null,
	web_prov character(10) null,
	email_prov character(10) null,
	obser_prov character(10) null,
	forma_pago character(10) null,
	banco character(10) null,
	cuenta character(10) null,
	contacto character(10) null,
	status_prov character(10) null,
	CONSTRAINT pk_proveedor primary key (id_prov)
);
case proveedor:
	AgregarCampoClave=@proveedor=@texto=@id_prov=@id_prov=@character=@isAlphanumeric=@10=@=@=@30=@8=@not null=@
	AgregarCampo=@proveedor=@texto=@rif_prov=@Rif. Proveedor=@character=@isTexto=@10=@=@=@30=@15=@null=@
	AgregarCampo=@proveedor=@texto=@nombre_prov=@Nombre Proveedor=@character=@isTexto=@10=@=@=@50=@50=@null=@
	AgregarCampo=@proveedor=@area=@direccion_prov=@Direccion Proveedor=@character=@isTexto=@10=@=@=@20=@2=@null=@
	AgregarCampo=@proveedor=@texto=@telefonos_prov=@Telefonos Proveedor=@character=@isTexto=@10=@=@=@50=@50=@null=@
	AgregarCampo=@proveedor=@texto=@fax_prov=@Fax Proveedor=@character=@isTexto=@10=@=@=@30=@20=@null=@
	AgregarCampo=@proveedor=@texto=@web_prov=@Pagina Web Proveedor=@character=@isTexto=@10=@=@=@50=@30=@null=@
	AgregarCampo=@proveedor=@texto=@email_prov=@Email Provedor=@character=@isEmail=@10=@=@=@50=@40=@null=@
	AgregarCampo=@proveedor=@area=@obser_prov=@Observacion Proveedor=@character=@isTexto=@10=@=@=@20=@2=@null=@
	AgregarCampo=@proveedor=@lista=@forma_pago=@Forma Pago=@character=@isSelect=@10=@=@EFECTIVO,EFECTIVO;CREDITO,CREDITO=@1=@1=@null=@
	AgregarCampo=@proveedor=@texto=@banco=@banco=@character=@isTexto=@10=@=@=@50=@50=@null=@
	AgregarCampo=@proveedor=@texto=@cuenta=@cuenta=@character=@isNumber=@10=@=@=@30=@25=@null=@
	AgregarCampo=@proveedor=@texto=@contacto=@contacto=@character=@isTexto=@10=@=@=@50=@50=@null=@
	AgregarCampo=@proveedor=@radio=@status_prov=@Status=@character=@isSelect=@10=@=@ACTIVO;INACTIVO=@1=@1=@null=@
break;

CREATE TABLE pedido(
	dato character(10) null,
	id_ped character(10) not null,
	id_prov character(10) null,
	fecha_ped date null,
	fecha_ent date null,
	status_ped character(10) null,
	obser_ped character(10) null,
	nro_fact_ped character(10) null,
	porc_desc character(10) null,
	desc_ped character(10) null,
	base_ped character(10) null,
	iva_ped character(10) null,
	total_ped character(10) null,
	CONSTRAINT pk_pedido primary key (id_ped)
);
case pedido:
	AgregarCampoClave=@pedido=@texto=@id_ped=@id_ped=@character=@isAlphanumeric=@10=@=@=@30=@8=@not null=@
	AgregarCampo=@pedido=@lista=@id_prov=@id_prov=@character=@isSelect=@10=@=@0,..Seleccione..;CO000001,CO000001=@1=@1=@null=@
	AgregarCampo=@pedido=@fecha=@fecha_ped=@Fecha del Pedido=@date=@=@15=@2021=@2010=@15=@15=@null=@
	AgregarCampo=@pedido=@fecha=@fecha_ent=@Fecha de Entrega=@date=@=@15=@2021=@2010=@15=@15=@null=@
	AgregarCampo=@pedido=@radio=@status_ped=@Status=@character=@isSelect=@10=@=@ACTIVO,INACTIVO=@1=@1=@null=@
	AgregarCampo=@pedido=@area=@obser_ped=@Observacion Pedido=@character=@isTexto=@10=@=@=@20=@2=@null=@
	AgregarCampo=@pedido=@texto=@nro_fact_ped=@Num Factura=@character=@isTexto=@10=@=@=@30=@10=@null=@
	AgregarCampo=@pedido=@texto=@porc_desc=@porc_desc=@character=@isNumber=@10=@=@=@20=@3=@null=@
	AgregarCampo=@pedido=@texto=@desc_ped=@desc_ped=@character=@isNumber=@10=@=@=@20=@10=@null=@
	AgregarCampo=@pedido=@texto=@base_ped=@base_ped=@character=@isNumber=@10=@=@=@20=@10=@null=@
	AgregarCampo=@pedido=@texto=@iva_ped=@iva_ped=@character=@isNumber=@10=@=@=@20=@10=@null=@
	AgregarCampo=@pedido=@texto=@total_ped=@total_ped=@character=@isNumber=@10=@=@=@20=@10=@null=@
break;

CREATE TABLE materiales(
	dato character(10) null,
	id_mat character(10) not null,
	numero_mat character(10) null,
	nombre_mat character(10) null,
	id_unidad character(10) null,
	id_dep character(10) null,
	id_fam character(10) null,
	stock character(10) null,
	stock_min character(10) null,
	observacion character(10) null,
	precio_u_p character(10) null,
	c_uni_ent character(10) null,
	c_uni_sal character(10) null,
	CONSTRAINT pk_materiales primary key (id_mat)
);
case materiales:
	AgregarCampoClave=@materiales=@texto=@id_mat=@id_mat=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
	AgregarCampo=@materiales=@texto=@numero_mat=@Numero de Meterales=@character=@isInteger=@10=@=@=@30=@10=@null=@
	AgregarCampo=@materiales=@texto=@nombre_mat=@Nombre del Material=@character=@isTexto=@10=@=@=@30=@50=@null=@
	AgregarCampo=@materiales=@lista=@id_unidad=@Tipo Unidad de Medida=@character=@isSelect=@10=@=@0,Seleccione..;1,ok=@1=@1=@null=@
	AgregarCampo=@materiales=@lista=@id_dep=@Deposito=@character=@isSelect=@10=@=@0,Seleccione..;1,Deposito=@1=@1=@null=@
	AgregarCampo=@materiales=@lista=@id_fam=@Familia=@character=@isSelect=@10=@=@0,Seleccione..;1,familia=@1=@1=@null=@
	AgregarCampo=@materiales=@texto=@stock=@Stock=@character=@isInteger=@10=@=@=@30=@8=@null=@
	AgregarCampo=@materiales=@texto=@stock_min=@Cantidad Minima en Stock=@character=@isInteger=@10=@=@=@25=@4=@null=@
	AgregarCampo=@materiales=@area=@observacion=@Observacion=@character=@isTexto=@10=@=@=@20=@2=@null=@
	AgregarCampo=@materiales=@texto=@precio_u_p=@Precio_u_p=@character=@isNumber=@10=@=@=@25=@10=@null=@
	AgregarCampo=@materiales=@texto=@c_uni_ent=@Cant. Unid. Entrante=@character=@isInteger=@10=@=@=@25=@4=@null=@
	AgregarCampo=@materiales=@texto=@c_uni_sal=@Cant. Unid. Entrante=@character=@isInteger=@10=@=@=@25=@4=@null=@
break;

CREATE TABLE mov_mat(
	dato character(10) null,
	id_mat character(10) not null,
	id_mov character(10) null,
	cant_mov character(10) null,
	CONSTRAINT pk_mov_mat primary key (id_mat)
);
case mov_mat:
	AgregarCampoClave=@mov_mat=@lista=@id_mat=@Materiales=@character=@isSelect=@10=@=@0,Seleccione..;
1,ok=@1=@1=@not null=@
	AgregarCampo=@mov_mat=@texto=@id_mov=@id_mov=@character=@isAlphanumeric=@10=@=@=@30=@8=@null=@
	AgregarCampo=@mov_mat=@texto=@cant_mov=@cant_mov=@character=@isInteger=@10=@=@=@20=@4=@null=@
break;

CREATE TABLE motivo_inv(
	dato character(10) null
);
case motivo_inv:
break;

CREATE TABLE mat_prov(
	dato character(10) null,
	id_mat character(10) not null,
	id_prov character(10) null,
	CONSTRAINT pk_mat_prov primary key (id_mat)
);
case mat_prov:
	AgregarCampoClave=@mat_prov=@texto=@id_mat=@id_mat=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
	AgregarCampo=@mat_prov=@texto=@id_prov=@id_prov=@character=@isAlphanumeric=@10=@=@=@30=@8=@null=@
break;

CREATE TABLE mat_ped(
	dato character(10) null,
	id_mat character(10) not null,
	id_ped character(10) null,
	cant_ped character(10) null,
	cant_ent character(10) null,
	precio character(10) null,
	CONSTRAINT pk_mat_ped primary key (id_mat)
);
case mat_ped:
	AgregarCampoClave=@mat_ped=@texto=@id_mat=@id_mat=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
	AgregarCampo=@mat_ped=@texto=@id_ped=@id_ped=@character=@isAlphanumeric=@10=@=@=@30=@8=@null=@
	AgregarCampo=@mat_ped=@texto=@cant_ped=@Cantidad Pedido=@character=@isInteger=@10=@=@=@20=@4=@null=@
	AgregarCampo=@mat_ped=@texto=@cant_ent=@Cantidad Entrante=@character=@isInteger=@10=@=@=@20=@4=@null=@
	AgregarCampo=@mat_ped=@texto=@precio=@Precio=@character=@isNumber=@10=@=@=@20=@10=@null=@
break;
CREATE  VIEW vista_pedido AS select pedido.id_ped, pedido.id_prov, pedido.fecha_ped, pedido.fecha_ent, pedido.status_ped, pedido.obser_ped, pedido.nro_fact_ped, pedido.porc_desc, pedido.desc_ped, pedido.base_ped, pedido.iva_ped, pedido.total_ped, proveedor.rif_prov, proveedor.nombre_prov, proveedor.direccion_prov, proveedor.telefonos_prov, proveedor.fax_prov, proveedor.web_prov, proveedor.email_prov, proveedor.obser_prov, proveedor.forma_pago, proveedor.banco, proveedor.cuenta, proveedor.status_prov, proveedor.contacto from pedido, proveedor where pedido.id_prov = proveedor.id_prov order by pedido.id_ped Desc
);CREATE  VIEW vista_materiales AS select materiales.id_mat, materiales.numero_mat, materiales.nombre_mat, materiales.id_unidad, materiales.uni_id_unidad, materiales.id_dep, materiales.id_fam, materiales.stock, materiales.stock_min, materiales.observacion, materiales.precio_u_p, materiales.c_uni_ent, materiales.c_uni_sal, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, familia.nombre_fam, familia.status_fam, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad from unidad_medida, materiales, deposito, familia where materiales.id_dep = deposito.id_dep and materiales.id_unidad = unidad_medida.id_unidad and materiales.id_fam = familia.id_fam order by materiales.id_mat Asc
);CREATE  VIEW vista_matpedmateriales AS select materiales.id_mat, materiales.nombre_mat, unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, materiales.numero_mat, materiales.id_dep, materiales.id_fam, materiales.stock, materiales.stock_min, deposito.nombre_dep, mat_ped.id_ped, mat_ped.cant_ped, mat_ped.cant_ent, mat_ped.precio, familia.nombre_fam from unidad_medida, materiales, deposito, familia, mat_ped where materiales.id_unidad = unidad_medida.id_unidad and materiales.id_dep = deposito.id_dep and familia.id_fam = materiales.id_fam and materiales.id_mat = mat_ped.id_mat order by materiales.id_mat Asc
);
CREATE TABLE inventario(
	dato character(10) null,
	idinventario character(10) not null,
	idmotivo character(10) null,
	fechainv date null,
	horainv character(10) null,
	obserinv character(10) null,
	tipoinv character(10) null,
	iddep character(10) null,
	idfam character(10) null,
	CONSTRAINT pk_inventario primary key (idinventario)
);
case inventario:
	AgregarCampoClave=@inventario=@texto=@idinventario=@id_inv=@character=@isAlphanumeric=@10=@=@=@30=@8=@not null=@
	AgregarCampo=@inventario=@lista=@idmotivo=@id_motivo=@character=@isSelect=@10=@=@seleccione,0;dos,1=@1=@1=@null=@
	AgregarCampo=@inventario=@fecha=@fechainv=@fechainv=@date=@=@15=@2021=@2010=@15=@15=@null=@
	AgregarCampo=@inventario=@texto=@horainv=@hora_inv=@character=@isTexto=@10=@=@=@30=@12=@null=@
	AgregarCampo=@inventario=@area=@obserinv=@obser_inv=@character=@isTexto=@10=@=@=@20=@2=@null=@
	AgregarCampo=@inventario=@texto=@tipoinv=@tipo_inv=@character=@isTexto=@10=@=@=@30=@15=@null=@
	AgregarCampo=@inventario=@lista=@iddep=@id_dep=@character=@isSelect=@10=@=@seleccione,0;uno,1=@1=@1=@null=@
	AgregarCampo=@inventario=@lista=@idfam=@id_fam=@character=@isSelect=@10=@=@seleccione,0;uno,1=@1=@1=@null=@
break;

CREATE TABLE aprobarinventario(
	dato character(10) null
);
case aprobarinventario:
break;

CREATE TABLE matpadre(
	dato character(10) null,
	id_m character(10) not null,
	id_unidad character(10) null,
	id_fam character(10) null,
	numero_mat character(10) null,
	nombre_mat character(10) null,
	precio_u_p character(10) null,
	c_uni_ent character(10) null,
	c_uni_sal character(10) null,
	CONSTRAINT pk_matpadre primary key (id_m)
);
case matpadre:
	AgregarCampoClave=@matpadre=@texto=@id_m=@id_m=@character=@isAlphanumeric=@10=@=@=@30=@10=@not null=@
	AgregarCampo=@matpadre=@lista=@id_unidad=@id_unidad=@character=@isSelect=@10=@=@seleccione,0;uno,1=@1=@1=@null=@
	AgregarCampo=@matpadre=@lista=@id_fam=@id_fam=@character=@isSelect=@10=@=@selecciones,0;uno,1=@1=@1=@null=@
	AgregarCampo=@matpadre=@texto=@numero_mat=@numero_mat=@character=@isInteger=@10=@=@=@30=@8=@null=@
	AgregarCampo=@matpadre=@texto=@nombre_mat=@nombre_mat=@character=@isTexto=@10=@=@=@30=@50=@null=@
	AgregarCampo=@matpadre=@texto=@precio_u_p=@precio_u_p=@character=@isNumber=@10=@=@=@30=@10=@null=@
	AgregarCampo=@matpadre=@texto=@c_uni_ent=@c_uni_ent=@character=@isInteger=@10=@=@=@30=@4=@null=@
	AgregarCampo=@matpadre=@texto=@c_uni_sal=@c_uni_sal=@character=@isInteger=@10=@=@=@30=@4=@null=@
break;
CREATE  VIEW vista_matpadre AS select unidad_medida.id_unidad, unidad_medida.nombre_unidad, unidad_medida.abreviatura, unidad_medida.status_unidad, familia.id_fam, familia.nombre_fam, familia.status_fam, mat_padre.id_m, mat_padre.numero_mat, mat_padre.nombre_mat, mat_padre.precio_u_p, mat_padre.c_uni_ent, mat_padre.c_uni_sal, mat_padre.uni_id_unidad from unidad_medida, familia, mat_padre where mat_padre.id_unidad = unidad_medida.id_unidad and mat_padre.id_fam = familia.id_fam order by mat_padre.numero_mat Asc
);CREATE  VIEW vista_materialesuniinv AS select inventario_materiales.id_mat, inventario_materiales.id_inv, inventario_materiales.cant_sist, inventario_materiales.cant_real, inventario_materiales.justi_inv, vista_materiales_unid.us_id, vista_materiales_unid.us_nombre, vista_materiales_unid.us_abre, vista_materiales_unid.id_dep, vista_materiales_unid.stock, vista_materiales_unid.stock_min, vista_materiales_unid.observacion, vista_materiales_unid.id_m, vista_materiales_unid.numero_mat, vista_materiales_unid.nombre_mat, vista_materiales_unid.id_unidad, vista_materiales_unid.uni_id_unidad, vista_materiales_unid.id_fam, vista_materiales_unid.precio_u_p, vista_materiales_unid.c_uni_ent, vista_materiales_unid.c_uni_sal, vista_materiales_unid.nombre_dep, vista_materiales_unid.descrip_dep, vista_materiales_unid.status_dep, vista_materiales_unid.nombre_fam, vista_materiales_unid.status_fam, vista_materiales_unid.nombre_unidad, vista_materiales_unid.abreviatura, vista_materiales_unid.status_unidad from inventario_materiales, vista_materiales_unid
);CREATE  VIEW vista_planillamov AS select mov_mat.id_mat, mov_mat.id_mov, mov_mat.cant_mov, vista_materiales_unid.us_id, vista_materiales_unid.us_nombre, vista_materiales_unid.us_abre, vista_materiales_unid.id_dep, vista_materiales_unid.stock, vista_materiales_unid.stock_min, vista_materiales_unid.observacion, vista_materiales_unid.id_m, vista_materiales_unid.numero_mat, vista_materiales_unid.nombre_mat, vista_materiales_unid.id_unidad, vista_materiales_unid.uni_id_unidad, vista_materiales_unid.id_fam, vista_materiales_unid.precio_u_p, vista_materiales_unid.c_uni_ent, vista_materiales_unid.c_uni_sal, vista_materiales_unid.nombre_dep, vista_materiales_unid.descrip_dep, vista_materiales_unid.status_dep, vista_materiales_unid.nombre_fam, vista_materiales_unid.status_fam, vista_materiales_unid.nombre_unidad, vista_materiales_unid.abreviatura, vista_materiales_unid.status_unidad from mov_mat, vista_materiales_unid where mov_mat.id_mat = vista_materiales_unid.id_mat order by vista_materiales_unid.nombre_mat Asc
);CREATE  VIEW vista_planillaped AS select pedido.id_ped, pedido.id_prov, pedido.fecha_ped, pedido.fecha_ent, pedido.status_ped, pedido.obser_ped, pedido.nro_fact_ped, pedido.porc_desc, pedido.desc_ped, pedido.base_ped, pedido.iva_ped, pedido.total_ped, vista_matped_und.us_id, vista_matped_und.us_nombre, vista_matped_und.us_abre, vista_matped_und.id_mat, vista_matped_und.nombre_mat, vista_matped_und.id_unidad, vista_matped_und.nombre_unidad, vista_matped_und.abreviatura, vista_matped_und.numero_mat, vista_matped_und.id_dep, vista_matped_und.id_fam, vista_matped_und.c_uni_ent, vista_matped_und.c_uni_sal, vista_matped_und.stock, vista_matped_und.stock_min, vista_matped_und.nombre_dep, vista_matped_und.cant_ped, vista_matped_und.cant_ent, vista_matped_und.precio, vista_matped_und.nombre_fam from pedido, vista_matped_und where vista_matped_und.id_ped = pedido.id_ped
);CREATE  VIEW vista_planillainv AS select inventario_materiales.id_mat, inventario_materiales.id_inv, inventario_materiales.cant_sist, inventario_materiales.cant_real, inventario_materiales.justi_inv, inventario.id_motivo, inventario.fecha_inv, inventario.hora_inv, inventario.obser_inv, inventario.tipo_inv, inventario.id_dep, inventario.id_fam, inventario.status_inv, vista_materiales_unid.us_id, vista_materiales_unid.us_nombre, vista_materiales_unid.us_abre, vista_materiales_unid.stock, vista_materiales_unid.stock_min, vista_materiales_unid.observacion, vista_materiales_unid.id_m, vista_materiales_unid.numero_mat, vista_materiales_unid.nombre_mat, vista_materiales_unid.id_unidad, vista_materiales_unid.uni_id_unidad, vista_materiales_unid.precio_u_p, vista_materiales_unid.c_uni_ent, vista_materiales_unid.c_uni_sal, vista_materiales_unid.nombre_dep, vista_materiales_unid.descrip_dep, vista_materiales_unid.status_dep, vista_materiales_unid.nombre_fam, vista_materiales_unid.status_fam, vista_materiales_unid.nombre_unidad, vista_materiales_unid.abreviatura, vista_materiales_unid.status_unidad from inventario_materiales, inventario, vista_materiales_unid where inventario_materiales.id_inv = inventario.id_inv and inventario_materiales.id_mat = vista_materiales_unid.id_mat order by vista_materiales_unid.nombre_mat Asc
);CREATE  VIEW vista_reportemovimiento AS select tipo_movimiento.id_tm, tipo_movimiento.nombre_tm, tipo_movimiento.tipo_ent_sal, tipo_movimiento.uso_tm, tipo_movimiento.status_tm, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, movimiento.id_mov, movimiento.fecha_ent_sal, movimiento.hora_ent_sal, movimiento.observacion, movimiento.referencia, movimiento.tipo_mov from tipo_movimiento, deposito, movimiento where movimiento.tipo_mov = deposito.id_dep and movimiento.id_tm = tipo_movimiento.id_tm order by movimiento.fecha_ent_sal Asc
);CREATE  VIEW vista_reporteinventario AS select motivo_inv.id_motivo, motivo_inv.nombre_motivo, motivo_inv.status_motivo, deposito.id_dep, deposito.nombre_dep, deposito.descrip_dep, deposito.status_dep, deposito.id_gt, deposito.id_persona_enc, inventario.id_inv, inventario.fecha_inv, inventario.hora_inv, inventario.obser_inv, inventario.tipo_inv, inventario.id_fam, inventario.status_inv from motivo_inv, deposito, inventario where inventario.id_motivo = motivo_inv.id_motivo and inventario.id_dep = deposito.id_dep
);
CREATE TABLE ejempl(
	dato character(10) null
);
case ejempl:
break;
