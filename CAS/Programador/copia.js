//para que ejecute la funcion cerrarSesion al cargar la pagina index.html
window.onload=cerrarSesion;
//declaracion de variables globales
var claseGlobal="";
var cedulaPersona="";
var loginUsuario="";
var perfilUsuario="";
var miFormulario="";
var nombreModulo="";
var manejador="";
var dato=new Array();

//permite iniciar sesion 
function iniciarSesion(){
	loginUsuario=document.f1.login.value;
	conexionPHP_cas("Seguridad/Seguridad.php","IniciarSesion",document.f1.login.value+"=@"+document.f1.password.value);
}
//permite cerrar la sesion en javascript inicializando las variables
function cerrarSesion(arg)
{
	muestraReloj();
	claseGlobal="";
	cedulaPersona="";
	loginUsuario="";
	perfilUsuario="";
	var cad='';
	for(i=1;i<19;i++)
		cad=cad+'<li id="imagen">&nbsp;</li>';
	var cadena= '<ul><div id="funcion">'+cad+'</ul></div>';
	var capa=document.getElementById("lateral");
	capa.innerHTML=cadena;
	//asigno los botones latelares al div lateral
//	if(cerrarSesion.arguments.length==0){
		//hace la llamada a traves de ajax
		conexionPHP_cas('formulario.php','Sesion');
	//}
}
//permite validar que la cedula de una persona este regsitrada para poder ser usuario.
function validarEmp(){
	conexionPHP_cas("validarExistencia.php","1=@persona","cedula=@"+document.f1.cedula.value,"esta Cedula no esta registrada");
}
//validar existencia de un usuario
function validarUsuario(){
	conexionPHP_cas("validarExistencia.php","1=@usuario","login=@"+document.f1.login.value);
}
//valida existencia de un perfil
function validarCodigo(){
	conexionPHP_cas("validarExistencia.php","1=@perfil","codigoperfil=@"+document.f1.codigo.value);
	//carga todos los modulos registrados
	conexionPHP_cas("informacion.php","TraerModulo",document.f1.codigo.value);
}
//valida existencia de una persona
function validarPersona(){
	conexionPHP_cas("validarExistencia.php","1=@persona","cedula=@"+document.f1.cedula.value);
}
//valida existencia de un modulo
function validarModulo(){
	conexionPHP_cas("validarExistencia.php","1=@modulo","codigomodulo=@"+document.f1.codigo.value);
	//carga todos los perfiles registrados
	conexionPHP_cas("informacion.php","TraerModulo1",document.f1.codigo.value);
}

//APLICATEM - para validar la existencia de los nuevos modulos
function validarBroadcaster(){ conexionPHP_cas("validarExistencia.php","1=@broadcaster","broadcasterId=@"+broadcasterId());}
function validarChannel(){ conexionPHP_cas("validarExistencia.php","1=@channel","channelId=@"+channelId());}
function validarSmartcard(){ conexionPHP_cas("validarExistencia.php","1=@smartcard","SMCid=@"+SMCid());}
function validarProduct(){ conexionPHP_cas("validarExistencia.php","1=@product","productId=@"+productId());}
function validarPurchase(){ conexionPHP_cas("validarExistencia.php","1=@purchase","idPurchase=@"+idPurchase());}
function validarEvent(){ conexionPHP_cas("validarExistencia.php","1=@event","eventId=@"+eventId());}
function validarSubscription(){ conexionPHP_cas("validarExistencia.php","1=@subscription","subscriptionId=@"+subscriptionId());}
function validarCASSTBBean(){ conexionPHP_cas("validarExistencia.php","1=@casstbbean","stbTypeId=@"+stbTypeId());}
function validarProductEvent(){ conexionPHP_cas("validarExistencia.php","1=@productevent","eventId=@"+eventId());}
function validarCASTimeRangeBean(){ conexionPHP_cas("validarExistencia.php","1=@castimerangebean","idCASTimeRangeBean=@"+idCASTimeRangeBean());}
function validarMessage(){ conexionPHP_cas("validarExistencia.php","1=@message","idMessage=@"+idMessage());}
function validarSubscriptionChannel(){ conexionPHP_cas("validarExistencia.php","1=@subscriptionchannel","subscriptionId=@"+subscriptionId());}
function validarDato(){ conexionPHP_cas("validarExistencia.php","1=@Dato","dato=@"+dato());}
//funciones para obtener los valores de un formulario
function idPersona(){return document.f1.idPersona.value;}
function cedula(){return document.f1.cedula.value;}
function nombre(){return document.f1.nombre.value;}
function name(){return document.f1.name.value;}
function apellido(){return document.f1.apellido.value;}
function email(){return document.f1.email.value;}
function telefono(){return document.f1.telefono.value;}
function codigoperfil(){return document.f1.codigoperfil.value;}
function usuario(){return document.f1.login.value;}
function password(){return document.f1.password.value;}
function otropassword(){return document.f1.otropassword.value;}
function codigo(){return document.f1.codigo.value;}
function descripcion(){return document.f1.descripcion.value;}
function database(){return document.f1.database.value;}
function servidor(){return document.f1.servidor.value;}
function objeto(){return document.f1.objeto.value;}
function codigoModulo(){return document.f1.codigomodulo.options[document.f1.codigomodulo.selectedIndex].text;}
//APLICATEM - para seguir agregando funciones
function asdfasd(){return document.f1.asdfasd.value;}
function NomBrero(){return document.f1.NomBrero.value;}
function broadcasterId(){return document.f1.broadcasterId.value;}
function broadcasterDs(){return document.f1.broadcasterDs.value;}
function channelId(){return document.f1.channelId.value;}
function channelDs(){return document.f1.channelDs.value;}
function parentalType(){return document.f1.parentalType.value;}
function inExportable(){return document.f1.inExportable.value;}
function inFreeAccess(){return document.f1.inFreeAccess.value;}
function SMCid(){return document.f1.SMCid.value;}
function total(){return document.f1.total.value;}
function statusId(){return document.f1.statusId.value;}
function nmIPPVbalance(){return document.f1.nmIPPVbalance.value;}
function statusDate(){return document.f1.statusDate.value;}
function productId(){return document.f1.productId.value;}
function productDs(){return document.f1.productDs.value;}
function validityDateBegin(){return document.f1.validityDateBegin.value;}
function validityDateEnd(){return document.f1.validityDateEnd.value;}
function purchaseDateBegin(){return document.f1.purchaseDateBegin.value;}
function purchaseDateEnd(){return document.f1.purchaseDateEnd.value;}
function genreId(){return document.f1.genreId.value;}
function subgenreId(){return document.f1.subgenreId.value;}
function price(){return document.f1.price.value;}
function maxEvents(){return document.f1.maxEvents.value;}
function ippv(){return document.f1.ippv.value;}
function idPurchase(){return document.f1.idPurchase.value;}
function operationType(){return document.f1.operationType.value;}
function subscriptionId(){return document.f1.subscriptionId.value;}
function subscriptionDs(){return document.f1.subscriptionDs.value;}
function eventId(){return document.f1.eventId.value;}
function title(){return document.f1.title.value;}
function broadcastBegin(){return document.f1.broadcastBegin.value;}
function broadcastEnd(){return document.f1.broadcastEnd.value;}
function previewType(){return document.f1.previewType.value;}
function previewDuration(){return document.f1.previewDuration.value;}
function inScrambled(){return document.f1.inScrambled.value;}
function stbTypeId(){return document.f1.stbTypeId.value;}
function stbManufacturerId(){return document.f1.stbManufacturerId.value;}
function serialNumber(){return document.f1.serialNumber.value;}
function barcode(){return document.f1.barcode.value;}
function inMaster(){return document.f1.inMaster.value;}
function stbMasterTypeId(){return document.f1.stbMasterTypeId.value;}
function stbMasterManufacturerId(){return document.f1.stbMasterManufacturerId.value;}
function serialNumberMaster(){return document.f1.serialNumberMaster.value;}
function idCASTimeRangeBean(){return document.f1.idCASTimeRangeBean.value;}
function day(){return document.f1.day.value;}
function broadcastTimeBegin(){return document.f1.broadcastTimeBegin.value;}
function broadcastTimeEnd(){return document.f1.broadcastTimeEnd.value;}
function idMessage(){return document.f1.idMessage.value;}
function from(){return document.f1.from.value;}
function subject(){return document.f1.subject.value;}
function text(){return document.f1.text.value;}
function sendDate(){return document.f1.sendDate.value;}
function to(){return document.f1.to.value;}
function data(){return document.f1.dato.value;}

//es llamada cuando se desea incluir, modificar o eliminar datos de una tabla.
//tipoDato: representa la operacion que desea hacer; incluir, modificar o eliminar
//clase: a que  clase o tabla  desea hacer la operacion
function verificar_cas(tipoDato,clase)
{
  switch(clase)
  {
	//clase o tabla usuario
	case "Usuario":
		//antes de hacer la peticion valida los campos si es cedula, tipo seleccion o lista, alfanumericos, password
	  if(validaCampo(document.f1.cedula,isCedula) &&
		validaCampo(document.f1.codigoperfil,isSelect) && 
		validaCampo(document.f1.login,isAlphanumeric) && 
		validaCampo(document.f1.password,isPassword)){
			if(document.f1.password.value!=document.f1.otropassword.value){
				alert("La Contraseña no coincide con la otra");
				document.f1.password.focus(); return; 
			}
			else{
				//al llegar aqui todos los campos del formulario son correctos
				//llama a la funcion confirmacion para confirmar el envio de los datos
				//y se le envia como parametro el (la operacion,la clase,y la lista de parametros concatenados con =@)
				confirmacion_cas(tipoDato,clase,usuario()+"=@"+password()+"=@"+verStatus()+"=@"+codigoperfil()+"=@"+cedula());
			 }
		}
		break;
	case "Perfil":
	  if(validaCampo(document.f1.codigo,isAlphanumeric) &&
		validaCampo(document.f1.descripcion,isTexto) &&
		validaCampo(document.f1.nombre,isName)){
			if(confirm('¿seguro que desea enviar este formulario?')){
				conexionPHP_cas("administrar.php","ModuloPerfil",codigo()+"=@=@=@=@","eliminarPerfil");
				if(tipoDato!="eliminar"){ 
					cambiarModulo("incluir",clase); 
				}
				conexionPHP_cas("administrar.php",clase,codigo()+"=@"+nombre()+"=@"+descripcion()+"=@"+verStatus(),tipoDato);
			}
		}
		break;
	case "Persona":
		if(validaCampo(document.f1.idPersona,isAlphanumeric) && validaCampo(document.f1.cedula,isCedula) && validaCampo(document.f1.nombre,isName) && validaCampo(document.f1.apellido,isName) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_cas(tipoDato,clase,idPersona()+"=@"+cedula()+"=@"+nombre()+"=@"+apellido()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "Broadcaster":
		if(validaCampo(document.f1.broadcasterId,isTexto) && validaCampo(document.f1.broadcasterDs,isTexto))
		{
			if(confirmacion_cas(tipoDato,clase,broadcasterId()+"=@"+broadcasterDs()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "Channel":
		if(validaCampo(document.f1.channelId,isInteger) && validaCampo(document.f1.channelDs,isTexto))
		{
			if(confirmacion_cas(tipoDato,clase,channelId()+"=@"+channelDs()+"=@"+broadcasterId()+"=@"+ver_tipo_canal()+verRadiotipoCanal()))
				document.f1.reset();
		}
		break;
	case "Smartcard":
		if(validaCampo(document.f1.SMCid,isAlphanumeric) && validaCampo(document.f1.total,isInteger))
		{
			if(confirmacion_cas(tipoDato,clase,SMCid()+"=@"+broadcasterId()+"=@"+total()+"=@"+statusId()+"=@"+nmIPPVbalance()+"=@"+formatdate(statusDate())+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "activateSMC":
		if(validaCampo(document.f1.SMCid,isAlphanumeric) )
		{
			if(confirmacion_cas(tipoDato,"Smartcard",SMCid()+"=@=@=@"+statusId()+"=@=@=@"))
				document.f1.reset();
		}
		break;
	case "decreaseIPPVbalance":
		if(validaCampo(document.f1.SMCid,isAlphanumeric) && validaCampo(document.f1.nmIPPVbalance,isNumber) )
		{
			if(confirmacion_cas(tipoDato,"Smartcard",SMCid()+"=@=@=@=@"+nmIPPVbalance()+"=@=@"))
				document.f1.reset();
		}
		break;
	case "increaseIPPVbalance":
		if(validaCampo(document.f1.SMCid,isAlphanumeric) && validaCampo(document.f1.nmIPPVbalance,isNumber) )
		{
			if(confirmacion_cas(tipoDato,"Smartcard",SMCid()+"=@=@=@=@"+nmIPPVbalance()+"=@=@"))
				document.f1.reset();
		}
		break;
	case "Product":
		if(validaCampo(document.f1.productId,isAlphanumeric) && validaCampo(document.f1.productDs,isTexto) && valdate(validityDateBegin()) && valdate(validityDateEnd()) && valdate(purchaseDateBegin()) && valdate(purchaseDateEnd()) && validaCampo(document.f1.genreId,isInteger) && validaCampo(document.f1.subgenreId,isInteger) && validaCampo(document.f1.price,isNumber) && validaCampo(document.f1.maxEvents,isInteger) && validaCampo(document.f1.ippv,isSelect) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_cas(tipoDato,clase,productId()+"=@"+productDs()+"=@"+broadcasterId()+"=@"+formatdate(validityDateBegin())+"=@"+formatdate(validityDateEnd())+"=@"+formatdate(purchaseDateBegin())+"=@"+formatdate(purchaseDateEnd())+"=@"+genreId()+"=@"+subgenreId()+"=@"+price()+"=@"+maxEvents()+"=@"+ippv()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "Purchase":
		if(validaCampo(document.f1.idPurchase,isAlphanumeric) && validaCampo(document.f1.operationType,isSelect) && validaCampo(document.f1.productId,isSelect) && validaCampo(document.f1.subscriptionId,isSelect) && validaCampo(document.f1.SMCid,isAlphanumeric) && validaCampo(document.f1.statusId,isInteger) && valdate(statusDate()) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_cas(tipoDato,clase,idPurchase()+"=@"+operationType()+"=@"+productId()+"=@"+subscriptionId()+"=@"+SMCid()+"=@"+statusId()+"=@"+formatdate(statusDate())+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "Event":
		if(validaCampo(document.f1.eventId,isAlphanumeric) && validaCampo(document.f1.title,isTexto) && valdate(broadcastBegin()) && valdate(broadcastEnd()) && validaCampo(document.f1.channelId,isSelect) && validaCampo(document.f1.genreId,isInteger) && validaCampo(document.f1.subgenreId,isInteger) && validaCampo(document.f1.parentalType,isSelect) && validaCampo(document.f1.previewType,isSelect) && validaCampo(document.f1.previewDuration,isInteger) && validaCampo(document.f1.inScrambled,isSelect) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_cas(tipoDato,clase,eventId()+"=@"+title()+"=@"+formatdate(broadcastBegin())+"=@"+formatdate(broadcastEnd())+"=@"+channelId()+"=@"+genreId()+"=@"+subgenreId()+"=@"+parentalType()+"=@"+previewType()+"=@"+previewDuration()+"=@"+inScrambled()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "Subscription":
		if(validaCampo(document.f1.subscriptionId,isAlphanumeric) && validaCampo(document.f1.subscriptionDs,isTexto) && validaCampo(document.f1.channelId,isSelect) && valdate(purchaseDateBegin()) && valdate(purchaseDateEnd()) && validaCampo(document.f1.price,isNumber) && validaCampo(document.f1.ippv,isSelect) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_cas(tipoDato,clase,subscriptionId()+"=@"+subscriptionDs()+"=@"+channelId()+"=@"+formatdate(purchaseDateBegin())+"=@"+formatdate(purchaseDateEnd())+"=@"+price()+"=@"+ippv()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "CASSTBBean":
		if(validaCampo(document.f1.stbTypeId,isAlphanumeric) && validaCampo(document.f1.stbManufacturerId,isInteger) && validaCampo(document.f1.serialNumber,isTexto) && validaCampo(document.f1.barcode,isTexto) && validaCampo(document.f1.inMaster,isSelect) && validaCampo(document.f1.stbMasterTypeId,isInteger) && validaCampo(document.f1.stbMasterManufacturerId,isInteger) && validaCampo(document.f1.serialNumberMaster,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_cas(tipoDato,clase,stbTypeId()+"=@"+stbManufacturerId()+"=@"+broadcasterId()+"=@"+serialNumber()+"=@"+barcode()+"=@"+inMaster()+"=@"+stbMasterTypeId()+"=@"+stbMasterManufacturerId()+"=@"+serialNumberMaster()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "ProductEvent":
		if(validaCampo(document.f1.eventId,isAlphanumeric) && validaCampo(document.f1.productId,isAlphanumeric) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_cas(tipoDato,clase,eventId()+"=@"+productId()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "CASTimeRangeBean":
		if(validaCampo(document.f1.idCASTimeRangeBean,isAlphanumeric) && validaCampo(document.f1.subscriptionId,isAlphanumeric) && validaCampo(document.f1.day,isSelect) && validaCampo(document.f1.broadcastTimeBegin,isTexto) && validaCampo(document.f1.broadcastTimeEnd,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_cas(tipoDato,clase,idCASTimeRangeBean()+"=@"+subscriptionId()+"=@"+day()+"=@"+broadcastTimeBegin()+"=@"+broadcastTimeEnd()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "Message":
		if(validaCampo(document.f1.idMessage,isAlphanumeric) && validaCampo(document.f1.to,isAlphanumeric) && validaCampo(document.f1.from,isTexto) && validaCampo(document.f1.subject,isTexto) && validaCampo(document.f1.text,isTexto) && valdate(sendDate()) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_cas(tipoDato,clase,idMessage()+"=@"+to()+"=@"+from()+"=@"+subject()+"=@"+text()+"=@"+formatdate(sendDate())+"=@"+broadcasterId()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "SubscriptionChannel":
		if(validaCampo(document.f1.subscriptionId,isAlphanumeric) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_cas(tipoDato,clase,subscriptionId()+"=@"+data()))
				document.f1.reset();
		}
		break;
	default:
		verificarAplicaTem(tipoDato,clase);
  }
}
//para que el usuario confirme antes de enviar el formulario
function confirmacion_cas(tipoDato,clase,cadena){						
	if (confirm('¿seguro que desea enviar este formulario?')){
		//hace la llamada para hacer la conexion con php
		conexionPHP_cas("administrar.php",clase,cadena,tipoDato);		
		return true;
	}
	else
		return false;
}
//SEGURIDAD - permite darle permiso de incluir, modificar o eliminar a un perfil.
function cambiarModulo(tipoDato,clase){
	var tam = document.f1.modulo.length;  
	var i=0;
	var cade='';
	var incluir='';
	var modificar='';
	var eliminar='';
	var cont=0;
	for(i=0;i<tam;i=i+4){
		if(clase=="Modulo"){
			if (document.f1.modulo[i].checked == true){
				if (document.f1.modulo[i+1].checked == true)
					incluir='true';
				else
					incluir='false';
				if (document.f1.modulo[i+2].checked == true)
					modificar='true';
				else
					modificar='false';
				if(document.f1.modulo[i+3].checked == true)
					eliminar='true';
				else
					eliminar='false';

				if(cont==0){
					cade=trim(document.f1.modulo[i].value)+"=@"+codigo()+"=@"+incluir+"=@"+modificar+"=@"+eliminar;
				}
				else
				{
					cade=cade+"-Class-"+tipoDato+"=@ModuloPerfil=@"+trim(document.f1.modulo[i].value)+"=@"+codigo()+"=@"+incluir+"=@"+modificar+"=@"+eliminar;
				}
				cont++;
			}
		}
		else if(clase=="Perfil"){ 
			if(document.f1.modulo[i].checked == true){				
				if (document.f1.modulo[i+1].checked == true)
					incluir='true';
				else
					incluir='false';
				if (document.f1.modulo[i+2].checked == true)
					modificar='true';
				else
					modificar='false';
				if (document.f1.modulo[i+3].checked == true)
					eliminar='true';
				else
					eliminar='false';
				if(cont==0){
					cade=codigo()+"=@"+trim(document.f1.modulo[i].value)+"=@"+incluir+"=@"+modificar+"=@"+eliminar;
				}
				else
				{
					cade=cade+"-Class-"+tipoDato+"=@ModuloPerfil=@"+codigo()+"=@"+trim(document.f1.modulo[i].value)+"=@"+incluir+"=@"+modificar+"=@"+eliminar;
				}
				cont++;
			}
		}
	}
	if(cade!='')
	{
		conexionPHP_cas("administrar.php","ModuloPerfil",cade,tipoDato);
	}
	conexionPHP_cas('formulario.php',clase);
}


function habilita_tipo_canal(){
	if (verRadiotipoCanal()=='NORMAL'){
			document.f1.parentalType.disabled=true;
			document.f1.inExportable.disabled=true;
			document.f1.inFreeAccess.disabled=true;
			
			document.f1.parentalType.value=0;
			document.f1.inExportable.value=0;
			document.f1.inFreeAccess.value=0;
	}
	else{
			document.f1.parentalType.disabled=false;
			document.f1.inExportable.disabled=false;
			document.f1.inFreeAccess.disabled=false;
	}
}

function ver_tipo_canal(){
	if (verRadiotipoCanal()=='NORMAL'){
		return "=@=@=@";
	}
	return parentalType()+"=@"+inExportable()+"=@"+inFreeAccess()+"=@";
}
