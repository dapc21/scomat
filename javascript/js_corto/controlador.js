//para que ejecute la funcion cerrarSesion al cargar la pagina index.html
//window.onload=cerrarSesion;
//window.onload=iniciarSesionPrueba;
//declaracion de variables globales

//window.onUnload=cerrarSes();

var claseGlobal="";
var cedulaPersona="";
var id_per_global="";
var loginUsuario="";
var perfilUsuario="";
var codigoPerfil="";
var miFormulario="";
var nombreModulo="";
var manejador="";
var VentanaGlobal=false;
var dato=new Array();
var existeMat=false;
var codGlobal="";
var codGlobal="";
var contSel=0;
var nro_facturaG='';
var sel_grupo_aut_G=true;
var activa_SMS=false;
var numGlobal='';



 function _(id) {
	if(array_test[id]!=null){
		return array_test[id];
	}
	else{
		return id;
	}
}	
function gettext (id) {
	return _(id);
}	
function gettext_noop (id) {
	return _(id);
}


//valida existencia de una persona
function validarPersona(){
	conexionPHP("validarExistencia.php","1=@persona","cedula=@"+document.f1.cedula.value);
}

function buscarXcedula(){
	conexionPHP('validarExistencia.php','1=@vista_contrato',"cedula=@"+cedula())
}


//APLICATEM - para validar la existencia de los nuevos modulos
function validarcontrato(){
	var ncont=nro_contrato();
	for(i=ncont.length;i<6;i++){
		ncont="0"+ncont;
	}
	//alert(ncont);
	conexionPHP("validarExistencia.php","1=@vista_contrato","nro_contrato=@"+ncont);
}
function validarcliente(){ conexionPHP("validarExistencia.php","1=@vista_cliente","cedula=@"+cedula());}
function validarenvio_aut(){ conexionPHP("validarExistencia.php","1=@envio_aut","id_envio=@"+id_envio());}
function validarcomandos_sms(){ conexionPHP("validarExistencia.php","1=@comandos_sms","dato=@"+data());}

function id_persona(){return document.f1.id_persona.value;}
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
function nro_cobrador(){return document.f1.nro_cobrador.value;}
function direccion_cob(){return document.f1.direccion_cob.value;}
function nro_vendedor(){return document.f1.nro_vendedor.value;}
function direccion_ven(){return document.f1.direccion_ven.value;}
function telf_casa(){return document.f1.telf_casa.value;}
function telf_adic(){return document.f1.telf_adic.value;}
function direc_adicional(){return document.f1.direc_adicional.value;}
function numero_casa(){return document.f1.numero_casa.value;}
function num_tecnico(){return document.f1.num_tecnico.value;}
function direccion_tec(){return document.f1.direccion_tec.value;}
function id_tipo_orden(){return document.f1.id_tipo_orden.value;}
function nombre_tipo_orden(){return document.f1.nombre_tipo_orden.value;}
function id_det_orden(){return document.f1.id_det_orden.value;}
function edificio(){return document.f1.edificio.value;}
function numero_piso(){return document.f1.numero_piso.value;}
function total_reg_data(){return document.f1.total_reg_data.value;}
function id_edif(){return document.f1.id_edif.value;}
function id_banco(){return document.f1.id_banco.value;}
function banco(){return document.f1.banco.value;}
function id_gt(){return document.f1.id_gt.value;}
function nombre_grupo(){return document.f1.nombre_grupo.value;}

function id_sms(){return document.f1.id_sms.value;}
function nro_sms(){return document.f1.nro_sms.value;}
function tipo_sms(){return document.f1.tipo_sms.value;}
function telefono_sms(){return document.f1.telefono_sms.value;}
function fecha_sms(){return document.f1.fecha_sms.value;}
function hora_sms(){return document.f1.hora_sms.value;}
function mensaje_sms(){return document.f1.mensaje_sms.value;}
function status_sms(){return document.f1.status_sms.value;}
function login(){return document.f1.login.value;}

function id_envio(){return document.f1.id_envio.value;}
function tipo_envio(){return document.f1.tipo_envio.value;}
function nombre_envio(){return document.f1.nombre_envio.value;}
function descripcion_envio(){return document.f1.descripcion_envio.value;}

function id_com(){return document.f1.id_com.value;}
function tipo_com(){return document.f1.tipo_com.value;}
function nombre_com(){return document.f1.nombre_com.value;}
function descrip_com(){return document.f1.descrip_com.value;}
function sms_resp(){return document.f1.sms_resp.value;}
function tipo_variable(){return document.f1.tipo_variable.value;}
function status_error(){return document.f1.status_error.value;}
function sms_error(){return document.f1.sms_error.value;}

function id_var(){return document.f1.id_var.value;}
function variable(){return document.f1.variable.value;}

function descrip_var(){return document.f1.descrip_var.value;}
function id_form(){return document.f1.id_form.value;}
function nombre_form(){return document.f1.nombre_form.value;}
function formato(){return document.f1.formato.value;}
function id_conf_sms(){return document.f1.id_conf_sms.value;}
function cod_telf_pais(){return document.f1.cod_telf_pais.value;}
function telefono_serv(){return document.f1.telefono_serv.value;}
function id_canal_sms(){return document.f1.id_canal_sms.value;}
function correo_emp(){return document.f1.correo_emp.value;}
function clave_correo(){return document.f1.clave_correo.value;}
function asunto_correo(){return document.f1.asunto_correo.value;}
function conf_campo1(){return document.f1.conf_campo1.value;}
function conf_campo2(){return document.f1.conf_campo2.value;}
function conf_campo3(){return document.f1.conf_campo3.value;}
function id_persona(){return document.f1.id_persona.value;}
function nro_gerente(){return document.f1.nro_gerente.value;}
function tipo_gerente(){return document.f1.tipo_gerente.value;}
function cargo_gerente(){return document.f1.cargo_gerente.value;}
function descrip_gerente(){return document.f1.descrip_gerente.value;}
function tipo_var(){
	var cadena="",i=0;
	for(i=0;i<document.f1.tipo_var.length;i++){
		if(document.f1.tipo_var[i].checked == true)
			cadena=cadena+document.f1.tipo_var[i].value+";";
	}
	return cadena;
}

function sms_resp_aut(){return document.f1.sms_resp_aut.value;}
function tipo_cliente(){return document.f1.tipo_cliente.value;}
function inicial_doc(){return document.f1.inicial_doc.value;}
function fecha_nac(){return document.f1.fecha_nac.value;}
function empresa(){return document.f1.empresa.value;}

function idstatus(){return document.f1.idstatus.value;}
function nombrestatus(){return document.f1.nombrestatus.value;}
function idmotivonota(){return document.f1.idmotivonota.value;}
function nombremotivonota(){return document.f1.nombremotivonota.value;}
function id_contrato(){return document.f1.id_contrato.value;}
function id_serv(){return document.f1.id_serv.value;}
function nombre_servicio(){return document.f1.nombre_servicio.value;}
function status_con(){return document.f1.status_con.value;}
function id_orden(){return document.f1.id_orden.value;}
function fecha_orden(){return document.f1.fecha_orden.value;}
function ordenes(){return document.f1.orden.value;}
function comentario_orden(){return document.f1.comentario_orden.value;}
function status_orden(){return document.f1.status_orden.value;}
function detalle_orden(){return document.f1.detalle_orden.value;}
function prioridad(){return document.f1.prioridad.value;}

function cli_id_persona(){return document.f1.cli_id_persona.value;}
function id_calle(){return document.f1.id_calle.value;}
function fecha_contrato(){return document.f1.fecha_contrato.value;}
function hora_contrato(){return document.f1.hora_contrato.value;}
function nro_contrato(){return document.f1.nro_contrato.value;}
function observacion(){return document.f1.observacion.value;}
function etiqueta(){return document.f1.etiqueta.value;}
function costo_contrato(){return document.f1.costo_contrato.value;}
function costo_dif_men(){return document.f1.costo_dif_men.value;}
function status_pago(){return document.f1.status_pago.value;}
function nro_factura(){return document.f1.nro_factura.value;}
function id_zona(){return document.f1.id_zona.value;}
function data(){return document.f1.dato.value;}
function id_calle(){return document.f1.id_calle.value;}
function nro_calle(){return document.f1.nro_calle.value;}
function id_sector(){return document.f1.id_sector.value;}
function nro_zona(){return document.f1.nro_zona.value;}
function nombre_zona(){return document.f1.nombre_zona.value;}
function id_franq(){return document.f1.id_franq.value;}
function nro_sector(){return document.f1.nro_sector.value;}
function nombre_calle(){return document.f1.nombre_calle.value;}

function nombre_sector(){return document.f1.nombre_sector.value;}
function postel(){return document.f1.postel.value;}
function taps(){return document.f1.taps.value;}
function pto(){return document.f1.pto.value;}
function hora(){return document.f1.hora.value;}

function id_visita(){return document.f1.id_visita.value;}
function fecha_visita(){return document.f1.fecha_visita.value;}
function comenta_visita(){return document.f1.comenta_visita.value;}

function verificar(tipoDato,clase)
{
  switch(clase)
  {
	
	case "act_contrato":
		if(parseInt(document.f1.cont_serv.value)>0){
			if(validaCampo(document.f1.id_contrato,isAlphanumeric) && valida_tipo_cliente() && validaCampo(document.f1.telefono,isPhoneNumber,true) && validaCampo(document.f1.telf_casa,isPhoneNumber,true) && validaCampo(document.f1.telf_adic,isPhoneNumber,true) && validaCampo(document.f1.email,isEmail,true) && validaCampo(document.f1.direc_adicional,isTexto) && validaCampo(document.f1.numero_casa,isTexto) && validaCampo(document.f1.dato,isTexto) && validaCampo(document.f1.id_calle,isSelect) && validaCampo(document.f1.id_persona,isAlphanumeric) && validaCampo(document.f1.cli_id_persona,isAlphanumeric) && validaCampo(document.f1.nro_contrato,isAlphanumeric) && valdate(fecha_contrato()) && validaCampo(document.f1.hora_contrato,isTexto) && validaCampo(document.f1.costo_contrato,isNumber) && validaCampo(document.f1.costo_dif_men,isNumber) && validaCampo(document.f1.status_pago,isSelect) && validaCampo(document.f1.id_persona,isSelect) && validaEdif())
			{
				if(confirmacion(tipoDato,"contrato",id_contrato()+"=@"+id_calle()+"=@"+id_persona()+"=@"+cli_id_persona()+"=@"+document.f1.n_contrato.value+"=@"+formatdate(fecha_contrato())+"=@"+hora_contrato()+"=@"+observacion()+"=@"+etiqueta()+"=@"+costo_contrato()+"=@"+costo_dif_men()+"=@"+status_pago()+"=@"+nro_factura()+"=@"+direc_adicional()+"=@"+numero_casa()+"=@"+edificio()+"=@"+numero_piso()+"=@"+id_gt()+"-Class-"+tipoDato+"=@cliente=@"+cli_id_persona()+"=@"+cedula()+"=@"+get_nombre_cli()+"=@"+apellido()+"=@"+telefono()+"=@"+telf_casa()+"=@"+email()+"=@"+telf_adic()+"=@"+numero_casa()+"=@"+tipo_cliente()+"=@"+inicial_doc()+"=@"+formatdate(fecha_nac())))
					document.f1.reset();
			}
		}
		else{
			alert("Error, Debe Seleccionar al menos un servicio");
		}
		break;
	case "act_datos":
		claseGlobal="act_datos";
			if(validaCampo(document.f1.id_contrato,isAlphanumeric) && valida_tipo_cliente() && validaCampo(document.f1.telefono,isPhoneNumber,true) && validaCampo(document.f1.telf_casa,isPhoneNumber,true) && validaCampo(document.f1.telf_adic,isPhoneNumber,true) && validaCampo(document.f1.email,isEmail,true) && validaCampo(document.f1.direc_adicional,isTexto) && validaCampo(document.f1.numero_casa,isTexto) && validaCampo(document.f1.dato,isTexto) && validaCampo(document.f1.id_calle,isSelect) && validaCampo(document.f1.id_persona,isAlphanumeric) && validaCampo(document.f1.cli_id_persona,isAlphanumeric) && validaCampo(document.f1.nro_contrato,isAlphanumeric) && valdate(fecha_contrato()) && validaCampo(document.f1.hora_contrato,isTexto) && validaCampo(document.f1.costo_contrato,isNumber) && validaCampo(document.f1.costo_dif_men,isNumber) && validaCampo(document.f1.status_pago,isSelect) && validaCampo(document.f1.id_persona,isSelect) && validaEdif())
			{
				confirmacion(tipoDato,"contrato",id_contrato()+"=@"+id_calle()+"=@"+id_persona()+"=@"+cli_id_persona()+"=@"+nro_contrato()+"=@"+formatdate(fecha_contrato())+"=@"+hora_contrato()+"=@"+observacion()+"=@"+etiqueta()+"=@"+costo_contrato()+"=@"+costo_dif_men()+"=@"+status_pago()+"=@"+nro_factura()+"=@"+direc_adicional()+"=@"+numero_casa()+"=@"+edificio()+"=@"+numero_piso()+"=@"+postel()+"=@"+taps()+"=@"+pto()+"=@=@"+document.f1.id_g_a.value+"=@-Class-"+tipoDato+"=@cliente=@"+cli_id_persona()+"=@"+cedula()+"=@"+get_nombre_cli()+"=@"+apellido()+"=@"+telefono()+"=@"+telf_casa()+"=@"+email()+"=@"+telf_adic()+"=@"+numero_casa()+"=@"+tipo_cliente()+"=@"+inicial_doc()+"=@"+formatdate(fecha_nac()));
			}
		break;
	
	case "cargar_deuda":
		if(validaCampo(document.f1.id_contrato,isAlphanumeric))
		{
			confirmacion(tipoDato,clase,id_contrato()+"=@"+id_serv()+"=@"+verRadiotipo_costo()+"=@"+document.f1.mes.value+"=@"+document.f1.costo.value);
		}
		break;
		
	case "cargar_d":
		claseGlobal="cargar_d";
		if(validaCampo(document.f1.id_contrato,isAlphanumeric))
		{
			//alert(id_contrato()+"=@"+id_serv()+"=@"+verRadiotipo_costo()+"=@"+document.f1.mes.value+"=@"+document.f1.costo.value);
			confirmacion(tipoDato,"cargar_deuda",id_contrato()+"=@"+id_serv()+"=@"+verRadiotipo_costo()+"=@"+document.f1.mes.value+"=@"+document.f1.costo.value);
		}
		break;

	case "ordenes_tecnicos":
		
		if(validaCampo(document.f1.id_orden,isAlphanumeric) && validaCampo(document.f1.id_contrato,isAlphanumeric) && validaCampo(document.f1.id_persona,isSelect) && validaCampo(document.f1.id_det_orden,isSelect) && valdate(fecha_orden()))
		{
			confirmacion(tipoDato,clase,id_orden()+"=@"+id_persona()+"=@"+id_det_orden()+"=@"+formatdate(fecha_orden())+"=@=@"+detalle_orden()+"=@"+comentario_orden()+"=@"+status_orden()+"=@"+id_contrato()+"=@"+prioridad());
			
		}
		break;
	case "asig_orden":
		claseGlobal="asig_orden";
		if(validaCampo(document.f1.id_orden,isAlphanumeric) && validaCampo(document.f1.id_contrato,isAlphanumeric) && validaCampo(document.f1.id_persona,isSelect) && validaCampo(document.f1.id_det_orden,isSelect) && valdate(fecha_orden()))
		{
			if(confirmacion(tipoDato,"ordenes_tecnicos",id_orden()+"=@"+id_persona()+"=@"+id_det_orden()+"=@"+formatdate(fecha_orden())+"=@=@"+detalle_orden()+"=@"+comentario_orden()+"=@"+status_orden()+"=@"+id_contrato()+"=@"+prioridad()))
				document.f1.reset();
		}
		break;
	case "calle":
		if(validaCampo(document.f1.id_calle,isAlphanumeric) && validaCampo(document.f1.nro_calle,isInteger) && validaCampo(document.f1.id_sector,isSelect) && validaCampo(document.f1.nombre_calle,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_calle()+"=@"+nro_calle()+"=@"+id_sector()+"=@"+nombre_calle()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "sector":
		if(validaCampo(document.f1.id_sector,isAlphanumeric) && validaCampo(document.f1.nro_sector,isInteger) && validaCampo(document.f1.id_zona,isSelect) && validaCampo(document.f1.nombre_sector,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_sector()+"=@"+nro_sector()+"=@"+id_zona()+"=@"+nombre_sector()+"=@"+data()+"=@"+afiliacion()))
				document.f1.reset();
		}
		break;
	case "zona":
		if(validaCampo(document.f1.id_zona,isAlphanumeric) && validaCampo(document.f1.nro_zona,isInteger) && validaCampo(document.f1.id_franq,isSelect) && validaCampo(document.f1.nombre_zona,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_zona()+"=@"+nro_zona()+"=@"+id_franq()+"=@"+nombre_zona()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "add_calle":
		claseGlobal=clase;
		if(validaCampo(document.f1.id_calle,isAlphanumeric) && validaCampo(document.f1.nro_calle,isInteger) && validaCampo(document.f1.id_sector,isSelect) && validaCampo(document.f1.nombre_calle,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			confirmacion(tipoDato,"calle",id_calle()+"=@"+nro_calle()+"=@"+id_sector()+"=@"+nombre_calle()+"=@"+data());
				
		}
		break;
	case "visitas":
		claseGlobal=clase;
		//alert(id_visita()+"=@"+id_orden()+"=@"+formatdate(fecha_visita())+"=@"+comenta_visita()+"=@"+hora())
		if(validaCampo(document.f1.comenta_visita,isTexto) && validaCampo(document.f1.hora,isTexto))
		{
			confirmacion(tipoDato,"visitas",id_visita()+"=@"+id_orden()+"=@"+formatdate(fecha_visita())+"=@"+comenta_visita()+"=@"+hora());
		}
		break;
	case "add_sector":
		claseGlobal=clase;
		if(validaCampo(document.f1.id_sector,isAlphanumeric) && validaCampo(document.f1.nro_sector,isInteger) && validaCampo(document.f1.id_zona,isSelect) && validaCampo(document.f1.nombre_sector,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			confirmacion(tipoDato,"sector",id_sector()+"=@"+nro_sector()+"=@"+id_zona()+"=@"+nombre_sector()+"=@"+data()+"=@"+document.f1.afiliacion.value);
				
		}
		break;
	case "add_zona":
		claseGlobal=clase;
		if(validaCampo(document.f1.id_zona,isAlphanumeric) && validaCampo(document.f1.nro_zona,isInteger) && validaCampo(document.f1.id_franq,isSelect) && validaCampo(document.f1.nombre_zona,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			confirmacion(tipoDato,"zona",id_zona()+"=@"+nro_zona()+"=@"+id_franq()+"=@"+nombre_zona()+"=@"+data());

		}
		break;
	case "add_edificio":
		claseGlobal=clase;
		if(validaCampo(document.f1.id_calle,isSelect) && validaCampo(document.f1.edificio,isTexto))
		{
			confirmacion(tipoDato,"edificio",id_edif()+"=@"+id_calle()+"=@"+edificio()+"=@");
				
		}
		break;
	case "add_banco":
		claseGlobal=clase;
		if(validaCampo(document.f1.banco,isTexto))
		{
			confirmacion(tipoDato,"banco",id_banco()+"=@"+banco());
				
		}
		break;
	case "envio_aut":
		WYSIWYG.execCommand('resp_correo', 'Preview'); 
		if(validaCampo(document.f1.id_envio,isAlphanumeric) && validaCampo(document.f1.id_franq,isSelect) && validaCampo(document.f1.tipo_envio,isSelect) && validaCampo(document.f1.nombre_envio,isTexto) && validaCampo(document.f1.tipo_variable,isTexto) && validaTextArea())
		{
			if(confirmacion(tipoDato,clase,document.f1.id_envio.value+"=@"+id_franq()+"=@"+tipo_envio()+"=@"+nombre_envio()+"=@"+document.f1.envio_sms.value+"=@"+document.f1.envio_email.value+"=@"+descripcion_envio()+"=@"+tipo_variable()+"=@"+valorTextArea))
				document.f1.reset();
		}
		break;
	case "comandos_sms":
		WYSIWYG.execCommand('resp_correo', 'Preview'); 
		//alert(document.f1.id_com.value+"=@"+id_franq()+"=@"+tipo_com()+"=@"+nombre_com()+"=@"+descrip_com()+"=@"+document.f1.status_com.value+"=@"+sms_resp()+"=@"+tipo_variable()+"=@"+sms_error()+"=@"+status_error()+"=@"+valorTextArea);
		if(validaCampo(document.f1.id_com,isAlphanumeric) && validaCampo(document.f1.tipo_com,isSelect) && validaCampo(document.f1.nombre_com,isTexto) && validaCampo(document.f1.descrip_com,isTexto) && validaCampo(document.f1.sms_resp,isTexto) && validaCampo(document.f1.sms_error,isTexto) && validaTextArea())
		{
			if(confirmacion(tipoDato,clase,document.f1.id_com.value+"=@"+id_franq()+"=@"+tipo_com()+"=@"+nombre_com()+"=@"+descrip_com()+"=@"+document.f1.status_com.value+"=@"+sms_resp()+"=@"+tipo_variable()+"=@"+sms_error()+"=@"+status_error()+"=@"+valorTextArea))
				document.f1.reset();
		}
		break;
	default:
		verificarAplicaTem(tipoDato,clase);
  }
}
//para que el usuario confirme antes de enviar el formulario
function confirmacion(tipoDato,clase,cadena){						
	if (confirm('¿seguro que desea enviar este formulario?')){
		//hace la llamada para hacer la conexion con php
		conexionPHP("administrar.php",clase,cadena,tipoDato);		
		
		if(claseGlobal=="pagos" && clase=="pagos"){
			//location.href="reportes/impFactPagoRTF.php?&id_pago="+id_pago()+"&";
			//creaVenta("reportes/impFactPago.php?&id_pago="+id_pago()+"&",1000,700);
		}
		return true;
	}
	else
		return false;
}

function cargarZona(){
	conexionPHP('informacion.php',"cargarZona",id_franq());
}
function cargarZona_franq(){
	conexionPHP('informacion.php',"cargarZona_franq",id_franq());
}
function traerFranq(){
	conexionPHP('informacion.php',"traerFranq",id_zona());
}
function traerFranqSer(){
	conexionPHP('informacion.php',"traerFranqSer",id_tipo_servicio());
}
function cargarSector(){
	conexionPHP('informacion.php',"cargarSector",id_zona());
}
function cargarCalle(){
	conexionPHP('informacion.php',"cargarCalle",id_sector());
}
function traerZona_solo(){
	conexionPHP('informacion.php',"traerZona",id_sector());
	
}
function traerZona(){
	conexionPHP('informacion.php',"traerZona",id_sector());
	cargarCalle();
}
function traerSector(){
	conexionPHP('informacion.php',"traerSector",id_calle());
	if(claseGlobal=="contrato" || claseGlobal=="act_contrato"){
		cargarEdif();
	}
}
function traerCalle(){
	conexionPHP('informacion.php',"traerCalle",edificio());
}
function cargarEdif(){
	conexionPHP('informacion.php',"cargarEdif",id_calle());
}

function abrirBusq_cont_avanz(){
	creaVenta("busq_cont_avanz.php",800,600);
}
function buscarContAvanz_todo(){
	var fecha='';
	var val=true;
	if(fecha_contrato()!=''){
		if(valdate(fecha_contrato())){
			fecha=formatdate(fecha_contrato())
		}
		else{
			val=false;
			document.f1.fecha_contrato.value='';
			fecha='';
		}
	}
	else{
		fecha='';
	}
	archivoDataGrid="busqueda/busq_cont_avanz_todo.php?&cedula="+cedula()+"&nombre="+nombre()+"&apellido="+apellido()+"&nro_contrato="+nro_contrato()+"&etiqueta="+etiqueta()+"&fecha_contrato="+fecha+"&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&numero_casa="+numero_casa()+"&telefono="+telefono()+"&telf_casa="+telf_casa()+"&status_contrato="+document.f1.status_contrato.value+"&id_g_a="+document.f1.id_g_a.value+"&cod_id_persona="+document.f1.cod_id_persona.value+"&id_persona="+document.f1.id_persona.value+"&postel="+document.f1.postel.value+"&contrato_fisico="+document.f1.contrato_fisico.value+"&";
	if(val==true){
		updateTable();
	}
}
function buscarContAvanz(){
	var fecha='';
	var val=true;
	if(fecha_contrato()!=''){
		if(valdate(fecha_contrato())){
			fecha=formatdate(fecha_contrato())
		}
		else{
			val=false;
			document.f1.fecha_contrato.value='';
			fecha='';
		}
	}
	else{
		fecha='';
	}
	archivoDataGrid="busqueda/busq_cont_avanz.php?&cedula="+cedula()+"&nombre="+nombre()+"&apellido="+apellido()+"&nro_contrato="+nro_contrato()+"&etiqueta="+etiqueta()+"&fecha_contrato="+fecha+"&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&numero_casa="+numero_casa()+"&telefono="+telefono()+"&telf_casa="+telf_casa()+"&status_contrato="+document.f1.status_contrato.value+"&id_g_a="+document.f1.id_g_a.value+"&cod_id_persona="+document.f1.cod_id_persona.value+"&id_persona="+document.f1.id_persona.value+"&postel="+document.f1.postel.value+"&contrato_fisico="+document.f1.contrato_fisico.value+"&";
	if(val==true){
		updateTable();
	}
}
function respBuscarContAvanz_todo(id_contrato){
	parent.conexionPHP("validarExistencia.php","1=@vista_contrato_todo","id_contrato=@"+id_contrato);
	parent.dhxWins.window("w2").close();
	
}
function respBuscarContAvanz1(id_contrato){
	parent.conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato);
	parent.dhxWins.window("w2").close();
	
}
function respBuscarContAvanz(nro_contrato){
	parent.conexionPHP("validarExistencia.php","1=@vista_contrato","nro_contrato=@"+nro_contrato);
	parent.dhxWins.window("w2").close();
	
}

function ActualizarCampo(tabla,campo,valor,condicion,validacion){
	creaVenta("actualizar_campo.php?&tabla="+tabla+"&campo="+campo+"&valor="+valor+"&condicion="+condicion+"&validacion="+validacion+"&",500,300);
	//alert(tabla+"=@"+campo+"=@"+valor+"=@"+condicion);
//	conexionPHP("informacion.php","ActualizarCampo",tabla+"=@"+campo+"=@"+valor+"=@"+condicion+"=@"+validacion);
}
function RespActualizarCampo(tabla,campo,valor,condicion,validacion){
	if(validacion=='isNumber')
		var resp=validaCampo(document.f1.campo,isNumber);
	else if(validacion=='isAlphabetic')
		var resp=validaCampo(document.f1.campo,isAlphabetic);
	else if(validacion=='isInteger')
		var resp=validaCampo(document.f1.campo,isInteger);
	else if(validacion=='isAlphanumeric')
		var resp=validaCampo(document.f1.campo,isAlphanumeric);
	else if(validacion=='isEmail')
		var resp=validaCampo(document.f1.campo,isEmail);
	else if(validacion=='isPhoneNumber')
		var resp=validaCampo(document.f1.campo,isPhoneNumber);
	else if(validacion=='isName')
		var resp=validaCampo(document.f1.campo,isName);
	else if(validacion=='isCedula')
		var resp=validaCampo(document.f1.campo,isCedula);
	else if(validacion=='isPassword')
		var resp=validaCampo(document.f1.campo,isPassword);
	else if(validacion=='isSelect')
		var resp=validaCampo(document.f1.campo,isSelect);
	else if(validacion=='isTexto')
		var resp=validaCampo(document.f1.campo,isTexto);
	else if(validacion=='isDate')
		var resp=validaCampo(document.f1.campo,isDate);
	
	
	if(resp==true)
	{
		if(document.f1.comentario.value==""){
			alert("Error, debe describir el motivo del cambio del cargo");
		}
		else{
			parent.conexionPHP("informacion.php","ActualizarCampo",tabla+"=@"+campo+"=@"+document.f1.campo.value+"=@id_cont_serv=@"+condicion+"=@"+document.f1.motivo.value+"=@"+document.f1.comentario.value);
			parent.dhxWins.window("w2").close();
		}
	}
}

function addCampo(clase){

		creaVenta('add.php?&clase='+clase,800,600);

}
function asig_orden(){
	if(id_contrato()==""){
		alert("Error, Debe cargar un contrato");
		document.f1.nro_contrato.select();
	}
	else{
		creaVenta('actualizar.php?&clase=asig_orden&id_contrato='+id_contrato(),800,600);
	}
}
function asig_orden1(){
	if(nro_contrato()==""){
		alert("Error, Debe cargar un contrato");
		document.f1.nro_contrato.select();
	}
	else{
		creaVenta('actualizar.php?&clase=asig_orden1&id_contrato='+id_contrato(),800,600);
	}
}
function cargar_d(){
	if(nro_contrato()==""){
		alert("Error, Debe cargar un contrato");
		document.f1.nro_contrato.select();
	}
	else{
		creaVenta('actualizar.php?&clase=cargar_d&id_contrato='+id_contrato(),800,600);
	}
}

function asig_falla_rep(){
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
			//alert(trim(document.f1.checkbox[i].value));
				cade=cade+trim(document.f1.checkbox[i].value)+"-Class-";
		}
	}
	if(cade!='')
	{ 
	 if(validaTestSMS()){
		if(confirm('¿seguro que desea generar estas fallas?')){
			conexionPHP("informacion.php","asig_falla_rep",document.f1.omitir.checked+"=@"+id_det_orden()+"=@"+sms_resp()+"=@"+cade);
		}
	 }
	}
	else{
		alert("Error, debe seleccionar al menos un mensaje de la lista");
	}
}

function validaTestSMS(){
	if(document.f1.omitir.checked==false){
		if(document.f1.sms_resp.value==""){
			alert("ERROR, debe introducir el mensaje a responder");
			return false;
		}
		else{
			return true;
		}
   }
   else{
		return true
   }
}

function maxlenthced(){
  if(tipo_cliente()=="NATURAL"){
	if(cedula().length<8){
		return true;
	}
	else{
		return false;
	}
 }
}
function valida_ced_tipo_cliente(){
	if(tipo_cliente()=="NATURAL"){
		if(validaCampo(document.f1.cedula,isCedula)){
			return true;
		}
		else{
			return false;
		}
	}
	else {
		if(validaCampo(document.f1.cedula,isRif)){
			
			return true;
		}
		else{
			return false;
		}
	}
}
function valida_tipo_cliente(){
	if(tipo_cliente()=="NATURAL"){
		if(validaCampo(document.f1.cedula,isCedula) && validaCampo(document.f1.nombre,isName) && validaCampo(document.f1.apellido,isName)){
			return true;
		}
		else{
			return false;
		}
	}
	else{
		if(validaCampo(document.f1.cedula,isRif) && validaCampo(document.f1.empresa,isTexto)){
			
			return true;
		}
		else{
			return false;
		}
	}
}
function get_nombre_cli(){
	if(tipo_cliente()=="NATURAL"){
		return nombre();
	}
	else{
		return empresa();
	}
}

function cargarDO(){
	conexionPHP('informacion.php',"cargarDO",id_tipo_orden());
}
function traerTO(){
	conexionPHP('informacion.php',"traerTO",id_det_orden());
}
function asigna_tipo_c_pago(nombre,apellido){
	
	if(tipo_cliente()=="NATURAL"){
		document.f1.empresa.value='';
		document.f1.nombre.value=nombre;
		document.f1.apellido.value=apellido;
	}
	else {
		document.f1.nombre.value='';
		document.f1.apellido.value='';
		document.f1.empresa.value=nombre;
	}
}
function asigna_tipo_c(nombre,apellido){
	if(tipo_cliente()=="NATURAL"){
		document.f1.empresa.disabled=true;
		document.f1.nombre.disabled=false;
		document.f1.apellido.disabled=false;
		document.f1.empresa.value='';
		document.f1.nombre.value=nombre;
		document.f1.apellido.value=apellido;
		
	}
	else {
		document.f1.empresa.disabled=false;
		document.f1.nombre.disabled=true;
		document.f1.apellido.disabled=true;
		document.f1.nombre.value='';
		document.f1.apellido.value='';
		document.f1.empresa.value=nombre;
	}
}
function validaEdif(){
	if(verRadiotipo_costo()=="CASA"){
		return true;
	}
	else{
		if(validaCampo(document.f1.numero_piso,isInteger) && validaCampo(document.f1.edificio,isSelect,false,"Debe Selecionar un Edificio"))
		{
			return true;
		}
		else{
			return false;
		}
	}
}
function habilitaEdif(){
	if(verRadiotipo_costo()=="CASA"){
		document.f1.edificio.disabled=true;
		document.f1.numero_piso.disabled=true;
		document.f1.edificio.selectedIndex=0;
		document.f1.numero_piso.value='';
		
	}
	else{
		document.f1.edificio.disabled=false;
		document.f1.numero_piso.disabled=false;
	}
}
function activa_tipo_c(){
	if(tipo_cliente()=="NATURAL"){
		document.getElementById("inicial_doc").innerHTML='<option value="V">'+_("V")+'</option><option value="E">'+_("E")+'</option>';
		document.f1.empresa.disabled=true;
		document.f1.nombre.disabled=false;
		document.f1.apellido.disabled=false;
	}
	else {
		document.getElementById("inicial_doc").innerHTML='<option value="J">'+_("J")+'</option><option value="G">'+_("G")+'</option><option value="V">'+_("V")+'</option><option value="E">'+_("E")+'</option>';
		document.f1.empresa.disabled=false;
		document.f1.nombre.disabled=true;
		document.f1.apellido.disabled=true;
	}
}

function buscarC(evt)
{
	
	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
	((evt.which) ? evt.which : 0));
	//alert(charCode);
	if (charCode == 13){
		buscarContAvanz();
	}
	else{
		return true;
	}
}


function buscarC_todo(evt)
{
	
	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
	((evt.which) ? evt.which : 0));
	//alert(charCode);
	if (charCode == 13){
		buscarContAvanz_todo();
	}
	else{
		return true;
	}
}


function activa_serv_cargo(){
	if(verRadiotipo_costo()=="COSTO MENSUAL"){
		document.f1.mes.disabled=false;
		document.f1.id_serv.disabled=true;
		document.f1.id_serv.value='0';
		document.f1.costo.value='';
		//alert("ENTRO");
		document.f1.costo.disabled=true;
	}
	else if(verRadiotipo_costo()=="COSTO UNICO"){
		document.f1.mes.disabled=true;
		document.f1.id_serv.disabled=false;
		document.f1.id_serv.value='0';
		document.f1.costo.value='';
		document.f1.costo.disabled=false;
	}
}

function traercs(){
	//alert("hola")
	conexionPHP("informacion.php","traercs",id_serv());
}

function validar_dato_cliente(){
	if(valida_ced_tipo_cliente()){
		alert("entro");
		conexionPHP("informacion.php","verifica_cedula",document.f1.cedula.value);
	}
}

function validar_dato_cliente2(){
	if(valida_ced_tipo_cliente()){
		//validarcliente();
		conexionPHP("informacion.php","verifica_cedula1",document.f1.cedula.value);
	}
}


function resp_deco_disp(id_da){
	opener.conexionPHP('validarExistencia.php','1=@deco_ana','id_da=@'+id_da);
	window.close();	
}

function resp_cablemodem_disp(id_cm){
	opener.conexionPHP('validarExistencia.php','1=@cablemodem','id_cm=@'+id_cm);
	window.close();	
	

}