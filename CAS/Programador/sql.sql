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

CREATE TABLE Broadcaster(
	dato character(10) null,
	broadcasterId character(8) not null,
	broadcasterDs character(100) null,
	CONSTRAINT pk_Broadcaster primary key (broadcasterId)
);
case broadcaster:
	AgregarCampoClave=@Broadcaster=@texto=@broadcasterId=@broadcasterId=@character=@isTexto=@8=@=@=@30=@8=@not null=@
	AgregarCampo=@Broadcaster=@texto=@broadcasterDs=@descripcion=@character=@isTexto=@100=@=@=@50=@100=@null=@
break;

CREATE TABLE Channel(
	dato character(10) null,
	channelId character(8) not null,
	channelDs character(100) null,
	broadcasterId character(8) null,
	parentalType character(1) null,
	inExportable character(1) null,
	inFreeAccess character(1) null,
	CONSTRAINT pk_Channel primary key (channelId)
);
case channel:
	AgregarCampoClave=@Channel=@texto=@channelId=@ID=@character=@isAlphanumeric=@8=@=@=@30=@8=@not null=@
	AgregarCampo=@Channel=@texto=@channelDs=@Descripcion=@character=@isTexto=@100=@=@=@50=@100=@null=@
	AgregarCampo=@Channel=@lista=@broadcasterId=@broadcaster=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
	AgregarCampo=@Channel=@lista=@parentalType=@parentalType=@character=@isSelect=@1=@=@0,Undefined;1,For all ages;2,Not suitable for under-7s;3,Not suitable for under-13s;4,Not suitable for under-18s;5,Adult content=@1=@1=@null=@
	AgregarCampo=@Channel=@lista=@inExportable=@inExportable=@character=@isSelect=@1=@=@0,No exportable;1,Exportable=@1=@1=@null=@
	AgregarCampo=@Channel=@lista=@inFreeAccess=@inFreeAccess=@character=@isSelect=@1=@=@0,No Free Access;1,Free Access=@1=@1=@null=@
break;

CREATE TABLE Smartcard(
	dato character(10) null,
	SMCid character(12) not null,
	broadcasterId character(8) null,
	total character(4) null,
	statusId character(1) null,
	nmIPPVbalance character(3) null,
	statusDate date null,
	CONSTRAINT pk_Smartcard primary key (SMCid)
);
case smartcard:
	AgregarCampoClave=@Smartcard=@texto=@SMCid=@SMCid=@character=@isAlphanumeric=@12=@=@=@30=@12=@not null=@
	AgregarCampo=@Smartcard=@lista=@broadcasterId=@broadcaster=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
	AgregarCampo=@Smartcard=@texto=@total=@total=@character=@isAlphanumeric=@4=@=@=@30=@4=@null=@
	AgregarCampo=@Smartcard=@lista=@statusId=@statusId=@character=@isSelect=@1=@=@0,statusId;1,Deactivation;2,Lock=@1=@1=@null=@
	AgregarCampo=@Smartcard=@texto=@nmIPPVbalance=@nmIPPVbalance=@character=@isAlphanumeric=@3=@=@=@30=@3=@null=@
	AgregarCampo=@Smartcard=@fecha=@statusDate=@statusDate=@date=@=@15=@2020=@2012=@15=@15=@null=@
break;

CREATE TABLE Product(
	dato character(10) null,
	productId character(8) not null,
	productDs character(100) null,
	broadcasterId character(8) null,
	validityDateBegin date null,
	validityDateEnd date null,
	purchaseDateBegin date null,
	purchaseDateEnd date null,
	genreId integer null,
	subgenreId integer null,
	price numeric(10,2) null,
	maxEvents integer null,
	ippv integer null,
	CONSTRAINT pk_Product primary key (productId)
);
case product:
	AgregarCampoClave=@Product=@texto=@productId=@productId=@character=@isAlphanumeric=@8=@=@=@30=@30=@not null=@
	AgregarCampo=@Product=@texto=@productDs=@productDs=@character=@isTexto=@100=@=@=@30=@50=@null=@
	AgregarCampo=@Product=@lista=@broadcasterId=@broadcasterId=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
	AgregarCampo=@Product=@fecha=@validityDateBegin=@validityDateBegin=@date=@=@15=@2020=@2012=@15=@15=@null=@
	AgregarCampo=@Product=@fecha=@validityDateEnd=@validityDateEnd=@date=@=@15=@2020=@2012=@15=@15=@null=@
	AgregarCampo=@Product=@fecha=@purchaseDateBegin=@purchaseDateBegin=@date=@=@15=@2020=@2012=@15=@15=@null=@
	AgregarCampo=@Product=@fecha=@purchaseDateEnd=@purchaseDateEnd=@date=@=@15=@2020=@2012=@15=@15=@null=@
	AgregarCampo=@Product=@texto=@genreId=@genreId=@integer=@isInteger=@=@=@=@30=@4=@null=@
	AgregarCampo=@Product=@texto=@subgenreId=@subgenreId=@integer=@isInteger=@=@=@=@30=@30=@null=@
	AgregarCampo=@Product=@texto=@price=@price=@numeric=@isNumber=@10=@2=@=@30=@10=@null=@
	AgregarCampo=@Product=@texto=@maxEvents=@maxEvents=@integer=@isInteger=@=@=@=@30=@4=@null=@
	AgregarCampo=@Product=@lista=@ippv=@ippv=@integer=@isSelect=@=@=@0,Non IPPV product;1,IPPV product=@1=@1=@null=@
break;

CREATE TABLE Purchase(
	dato character(10) null,
	idPurchase character(8) not null,
	operationType character(1) null,
	productId character(8) null,
	subscriptionId character(8) null,
	SMCid character(12) null,
	statusId character(1) null,
	statusDate date null,
	CONSTRAINT pk_Purchase primary key (idPurchase)
);
case purchase:
	AgregarCampoClave=@Purchase=@texto=@idPurchase=@idPurchase=@character=@isAlphanumeric=@8=@=@=@30=@8=@not null=@
	AgregarCampo=@Purchase=@lista=@operationType=@operationType=@character=@isSelect=@1=@=@0,Purchase;1,Cancellation;2,Immediate subscription deactivation=@1=@1=@null=@
	AgregarCampo=@Purchase=@lista=@productId=@productId=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
	AgregarCampo=@Purchase=@lista=@subscriptionId=@subscriptionId=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
	AgregarCampo=@Purchase=@texto=@SMCid=@SMCid=@character=@isAlphanumeric=@12=@=@=@30=@12=@null=@
	AgregarCampo=@Purchase=@texto=@statusId=@statusId=@character=@isInteger=@1=@=@=@30=@1=@null=@
	AgregarCampo=@Purchase=@fecha=@statusDate=@statusDate=@date=@=@15=@2020=@2012=@15=@15=@null=@
break;

CREATE TABLE Subscription(
	dato character(10) null,,
	purchaseDateBegin date not null,
	purchaseDateEnd date null,
	price numeric(10,2) null,
	ippv character(1) null,
	subscriptionDs character(100) null,
	channelId character(8) null,
	purchaseDateBegin date null,
	purchaseDateEnd date null,
	price numeric(10,2) null,
	ippv character(1) null,
	CONSTRAINT pk_Subscription primary key (purchaseDateBegin)
	subscriptionId character(8) not null,
	CONSTRAINT pk_Subscription primary key (subscriptionId)
);

CREATE TABLE Event(
	dato character(10) null,
	eventId character(8) not null,
	title character(100) null,
	broadcastBegin date null,
	broadcastEnd date null,
	channelId character(8) null,
	genreId integer null,
	subgenreId integer null,
	parentalType character(1) null,
	previewType character(1) null,
	previewDuration integer null,
	inScrambled character(1) null,
	CONSTRAINT pk_Event primary key (eventId)
);
case event:
	AgregarCampoClave=@Event=@texto=@eventId=@eventId=@character=@isAlphanumeric=@8=@=@=@30=@8=@not null=@
	AgregarCampo=@Event=@texto=@title=@title=@character=@isTexto=@100=@=@=@50=@100=@null=@
	AgregarCampo=@Event=@fecha=@broadcastBegin=@broadcastBegin=@date=@=@15=@2020=@2012=@15=@15=@null=@
	AgregarCampo=@Event=@fecha=@broadcastEnd=@broadcastEnd=@date=@=@15=@2020=@2012=@15=@15=@null=@
	AgregarCampo=@Event=@lista=@channelId=@channelId=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
	AgregarCampo=@Event=@texto=@genreId=@genreId=@integer=@isInteger=@=@=@=@30=@4=@null=@
	AgregarCampo=@Event=@texto=@subgenreId=@subgenreId=@integer=@isInteger=@=@=@=@30=@4=@null=@
	AgregarCampo=@Event=@lista=@parentalType=@parentalType=@character=@isSelect=@1=@=@0,Undefined;1,For all ages;2,Not suitable for under-7s;3,Not suitable for under-13s;4,Not suitable for under-18s;5,Adult content=@1=@1=@null=@
	AgregarCampo=@Event=@lista=@previewType=@previewType=@character=@isSelect=@1=@=@0,No preview;1,Preview at the beginning of event;2,Preview anytime (changing the channel)=@1=@1=@null=@
	AgregarCampo=@Event=@texto=@previewDuration=@previewDuration=@integer=@isInteger=@=@=@=@30=@4=@null=@
	AgregarCampo=@Event=@lista=@inScrambled=@inScrambled=@character=@isSelect=@1=@=@0,No scrambled;1,Scrambled;=@1=@1=@null=@
break;

CREATE TABLE Subscription(
	dato character(10) null,
	subscriptionId character(8) not null,
	subscriptionDs character(100) null,
	channelId character(8) null,
	purchaseDateBegin date null,
	purchaseDateEnd date null,
	price numeric(10,2) null,
	ippv character(1) null,
	CONSTRAINT pk_Subscription primary key (subscriptionId)
);
case subscription:
	AgregarCampoClave=@Subscription=@texto=@subscriptionId=@subscriptionId=@character=@isAlphanumeric=@8=@=@=@30=@8=@not null=@disabled
	AgregarCampo=@Subscription=@texto=@subscriptionDs=@subscriptionDs=@character=@isTexto=@100=@=@=@50=@100=@null=@
	AgregarCampo=@Subscription=@lista=@channelId=@channelId=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
	AgregarCampo=@Subscription=@fecha=@purchaseDateBegin=@purchaseDateBegin=@date=@=@15=@2020=@2012=@15=@15=@null=@
	AgregarCampo=@Subscription=@fecha=@purchaseDateEnd=@purchaseDateEnd=@date=@=@15=@2020=@2012=@15=@15=@null=@
	AgregarCampo=@Subscription=@texto=@price=@price=@numeric=@isNumber=@10=@2=@=@30=@10=@null=@
	AgregarCampo=@Subscription=@lista=@ippv=@ippv=@character=@isSelect=@1=@=@0,Non IPPV subscription;1,IPPV subscription=@1=@1=@null=@
break;

CREATE TABLE CASSTBBean(
	dato character(10) null,
	stbTypeId integer not null,
	stbManufacturerId integer null,
	broadcasterId character(8) null,
	serialNumber character(255) null,
	barcode character(255) null,
	inMaster character(1) null,
	stbMasterTypeId integer null,
	stbMasterManufacturerId integer null,
	serialNumberMaster character(255) null,
	CONSTRAINT pk_CASSTBBean primary key (stbTypeId)
);
case casstbbean:
	AgregarCampoClave=@CASSTBBean=@texto=@stbTypeId=@stbTypeId=@integer=@isAlphanumeric=@=@=@=@30=@4=@not null=@
	AgregarCampo=@CASSTBBean=@texto=@stbManufacturerId=@stbManufacturerId=@integer=@isInteger=@=@=@=@30=@4=@null=@
	AgregarCampo=@CASSTBBean=@lista=@broadcasterId=@broadcasterId=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
	AgregarCampo=@CASSTBBean=@texto=@serialNumber=@serialNumber=@character=@isTexto=@255=@=@=@50=@100=@null=@
	AgregarCampo=@CASSTBBean=@texto=@barcode=@barcode=@character=@isTexto=@255=@=@=@50=@255=@null=@
	AgregarCampo=@CASSTBBean=@lista=@inMaster=@inMaster=@character=@isSelect=@1=@=@0,Master;1,Slave=@1=@1=@null=@
	AgregarCampo=@CASSTBBean=@texto=@stbMasterTypeId=@stbMasterTypeId=@integer=@isInteger=@=@=@=@30=@4=@null=@
	AgregarCampo=@CASSTBBean=@texto=@stbMasterManufacturerId=@stbMasterManufacturerId=@integer=@isInteger=@=@=@=@30=@4=@null=@
	AgregarCampo=@CASSTBBean=@texto=@serialNumberMaster=@serialNumberMaster=@character=@isTexto=@255=@=@=@50=@255=@null=@
break;

CREATE TABLE ProductEvent(
	dato character(10) null,
	eventId character(8) not null,
	productId character(8) null,
	CONSTRAINT pk_ProductEvent primary key (eventId)
);
case productevent:
	AgregarCampoClave=@ProductEvent=@texto=@eventId=@eventId=@character=@isAlphanumeric=@8=@=@=@30=@8=@not null=@
	AgregarCampo=@ProductEvent=@texto=@productId=@productId=@character=@isAlphanumeric=@8=@=@=@30=@8=@null=@
break;

CREATE TABLE CASTimeRangeBean(
	dato character(10) null,
	idCASTimeRangeBean character(8) not null,
	subscriptionId character(8) null,
	day character(1) null,
	broadcastTimeBegin time null,
	broadcastTimeEnd time null,
	CONSTRAINT pk_CASTimeRangeBean primary key (idCASTimeRangeBean)
);
case castimerangebean:
	AgregarCampoClave=@CASTimeRangeBean=@texto=@idCASTimeRangeBean=@idCASTimeRangeBean=@character=@isAlphanumeric=@8=@=@=@30=@8=@not null=@
	AgregarCampo=@CASTimeRangeBean=@texto=@subscriptionId=@subscriptionId=@character=@isAlphanumeric=@8=@=@=@30=@8=@null=@
	AgregarCampo=@CASTimeRangeBean=@lista=@day=@day=@character=@isSelect=@1=@=@1;Lunes;2,Martes;3,Miercoles;4,Jueves;5,Viernes;6,Sabado;7,Domingo=@1=@1=@null=@
	AgregarCampo=@CASTimeRangeBean=@texto=@broadcastTimeBegin=@broadcastTimeBegin=@time=@isTexto=@=@=@=@30=@8=@null=@
	AgregarCampo=@CASTimeRangeBean=@texto=@broadcastTimeEnd=@broadcastTimeEnd=@time=@isTexto=@=@=@=@30=@8=@null=@
break;

CREATE TABLE Message(
	dato character(10) null,
	idMessage character(8) not null,
	to character(12) null,
	from character(50) null,
	subject character(50) null,
	text character varying(1023) null,
	sendDate date null,
	broadcasterId character(8) null,
	CONSTRAINT pk_Message primary key (idMessage)
);
case message:
	AgregarCampoClave=@Message=@texto=@idMessage=@idMessage=@character=@isAlphanumeric=@8=@=@=@30=@8=@not null=@
	AgregarCampo=@Message=@texto=@to=@para=@character=@isAlphanumeric=@12=@=@=@30=@12=@null=@
	AgregarCampo=@Message=@texto=@from=@De=@character=@isTexto=@50=@=@=@30=@50=@null=@
	AgregarCampo=@Message=@texto=@subject=@Asunto=@character=@isTexto=@50=@=@=@30=@50=@null=@
	AgregarCampo=@Message=@area=@text=@Mensaje=@character varying=@isTexto=@1023=@=@=@50=@3=@null=@
	AgregarCampo=@Message=@fecha=@sendDate=@sendDate=@date=@=@15=@2020=@2012=@15=@15=@null=@
	AgregarCampo=@Message=@lista=@broadcasterId=@broadcasterId=@character=@isSelect=@8=@=@1,1=@1=@1=@null=@
break;

CREATE TABLE SubscriptionChannel(
	dato character(10) null,
	subscriptionId character(8) not null,
	channelId integer null,
	CONSTRAINT pk_SubscriptionChannel primary key (subscriptionId)
);
case subscriptionchannel:
	AgregarCampoClave=@SubscriptionChannel=@texto=@subscriptionId=@subscriptionId=@character=@isAlphanumeric=@8=@=@=@30=@8=@not null=@
	AgregarCampo=@SubscriptionChannel=@lista=@channelId=@channelId=@integer=@isSelect=@=@=@1,1=@1=@1=@null=@
break;
