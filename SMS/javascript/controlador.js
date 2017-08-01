
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

function validarsms(){ conexionPHP_sms("validarExistencia.php","1=@sms","dato=@"+data());}
function validarenvio_aut(){ conexionPHP_sms("validarExistencia.php","1=@envio_aut","id_envio=@"+id_envio());}
function validarcomandos_sms(){ conexionPHP_sms("validarExistencia.php","1=@comandos_sms","dato=@"+data());}

function validarformato_sms(){ conexionPHP_sms("validarExistencia.php","1=@formato_sms","id_form=@"+id_form());}
function validarconfig_sms(){ conexionPHP_sms("validarExistencia.php","1=@config_sms","id_franq=@"+id_franq());}


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


function sms_resp_aut(){return document.f1.sms_resp_aut.value;}
function marca(){return document.f1.marca.value;}
function modelo(){return document.f1.modelo.value;}
function resp_correo(){return document.f1.resp_correo.value;}
function id_franq(){return document.f1.id_franq.value;}
function verificar_sms(tipoDato,clase)
{
  switch(clase)
  {
	
	case "sms":
		if(validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_sms(tipoDato,clase,data()))
				document.f1.reset();
		}
		break;
	case "envio_aut":
		WYSIWYG.execCommand('resp_correo', 'Preview'); 
		valorTextArea =str_replace ("&", "|-and-|", valorTextArea);
		if(validaCampo(document.f1.id_envio,isAlphanumeric) && validaCampo(document.f1.id_franq,isSelect) && validaCampo(document.f1.tipo_envio,isSelect) && validaCampo(document.f1.nombre_envio,isTexto) && validaCampo(document.f1.tipo_variable,isTexto) && validaTextArea())
		{
			if(confirmacion_sms1(tipoDato,clase,document.f1.id_envio.value+"=@"+id_franq()+"=@"+tipo_envio()+"=@"+nombre_envio()+"=@"+document.f1.envio_sms.value+"=@"+document.f1.envio_email.value+"=@"+descripcion_envio()+"=@"+tipo_variable()+"=@"+valorTextArea))
				document.f1.reset();
		}
		break;
	case "comandos_sms":
		WYSIWYG.execCommand('resp_correo', 'Preview'); 
		valorTextArea =str_replace ("&", "|-and-|", valorTextArea);
		//alert(document.f1.id_com.value+"=@"+id_franq()+"=@"+tipo_com()+"=@"+nombre_com()+"=@"+descrip_com()+"=@"+document.f1.status_com.value+"=@"+sms_resp()+"=@"+tipo_variable()+"=@"+sms_error()+"=@"+status_error()+"=@"+valorTextArea);
		if(validaCampo(document.f1.id_com,isAlphanumeric) && validaCampo(document.f1.tipo_com,isSelect) && validaCampo(document.f1.nombre_com,isTexto) && validaCampo(document.f1.descrip_com,isTexto) && validaCampo(document.f1.sms_resp,isTexto) && validaCampo(document.f1.sms_error,isTexto) && validaTextArea())
		{
			if(confirmacion_sms1(tipoDato,clase,document.f1.id_com.value+"=@"+id_franq()+"=@"+tipo_com()+"=@"+nombre_com()+"=@"+descrip_com()+"=@"+document.f1.status_com.value+"=@"+sms_resp()+"=@"+tipo_variable()+"=@"+sms_error()+"=@"+status_error()+"=@"+valorTextArea))
				document.f1.reset();
		}
		break;
	case "formato_sms":
		if(validaCampo(document.f1.id_form,isAlphanumeric) && validaCampo(document.f1.nombre_form,isTexto) && validaCampo(document.f1.formato,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_sms(tipoDato,clase,id_form()+"=@"+id_franq()+"=@"+nombre_form()+"=@"+formato()+"=@"+verRadiostatus_form()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "config_sms":
		if(validaCampo(document.f1.id_conf_sms,isAlphanumeric) && validaCampo(document.f1.id_franq,isInteger) && validaCampo(document.f1.cod_telf_pais,isTexto) && validaCampo(document.f1.telefono_serv,isTexto) && validaCampo(document.f1.id_canal_sms,isAlphanumeric) && validaCampo(document.f1.correo_emp,isEmail) && validaCampo(document.f1.clave_correo,isTexto) && validaCampo(document.f1.asunto_correo,isTexto) && validaCampo(document.f1.conf_campo1,isTexto) && validaCampo(document.f1.conf_campo2,isTexto) && validaCampo(document.f1.conf_campo3,isTexto) && validaCampo(document.f1.dato,isTexto) && validaCampo(document.f1.ruta_archivo,isTexto))
		{
			//alert(document.getElementById("ruta_archivo").value);
			if(confirmacion_sms(tipoDato,clase,id_conf_sms()+"=@"+id_franq()+"=@+"+cod_telf_pais()+"=@"+telefono_serv()+"=@"+id_canal_sms()+"=@"+correo_emp()+"=@"+clave_correo()+"=@"+asunto_correo()+"=@"+verRadioper_telf_fijo()+"=@"+verRadioenv_todos_telf()+"=@"+verRadioact_resp_aut()+"=@"+conf_campo1()+"=@"+conf_campo2()+"=@"+conf_campo3()+"=@"+sms_resp_aut()+"=@"+marca()+"=@"+modelo()+"=@"+document.getElementById("ruta_archivo").value))
				document.f1.reset();
		}
		break;
	
	case "variables_sms":
		if(validaCampo(document.f1.id_var,isInteger) && validaCampo(document.f1.variable,isTexto) && validaCampo(document.f1.descrip_var,isTexto) && validaCampo(document.f1.id_franq,isSelect) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_sms(tipoDato,clase,id_var()+"=@"+variable()+"=@"+tipo_var()+"=@"+descrip_var()+"=@"+verRadiostatus_var()+"=@"+id_franq()+"=@"+data()))
				document.f1.reset();
		}
		break;
	default:
		alert("Error, la clase no esta registrada:"+clase);
  }
}

//para que el usuario confirme antes de enviar el formulario
function confirmacion_sms(tipoDato,clase,cadena){						
	if (confirm(_('seguro que desea enviar este formulario'))){
		//hace la llamada para hacer la conexion con php
		conexionPHP_sms("administrar.php",clase,cadena,tipoDato);		
		
		
		return true;
	}
	else
		return false;
}
function confirmacion_sms1(tipoDato,clase,cadena){						
	if (confirm(_('seguro que desea enviar este formulario'))){
		conexionPHP_sms1("administrar.php",clase,cadena,tipoDato);		
	}
}

function mostrarSMS(){
		//alert("hola");
	$(function() {
		runEffect();
			
			return false;
		// run the currently selected effect
		function runEffect() {

			// get effect type from 
			var selectedEffect = "blind";
			// most effect types need no options passed by default
			//var options = {};
			var options = { to: { width: 280, height: 185 } };

			$( "#effect" ).show( selectedEffect, options, 500, callback );
		};

		//callback function to bring a hidden box back
		function callback(){
			setTimeout(function() {$( "#effect:visible" ).removeAttr( "style" ).fadeOut();}, 5000 );
		};
	});
}
function detener_sinc_SMS(){
	activa_SMS=false;
	alert(_('Sincronizacion con el celular detenida'));
}
function enviar_SMS(){
	conexionPHP_sms("sms.php","EnviarSMSUnico",document.f1.telefono.value+"=@"+document.f1.sms.value);
}
function enviar_SMS_cont(){
	conexionPHP_sms("sms.php","EnviarSMSUnicoCont",document.f1.telefono_sms.value+"=@"+document.f1.sms.value+"=@"+id_contrato());
}
function editar_env_aut(id_envio){
	creaVenta('SMS/envio_aut.php?&clase=envio_aut&id_envio='+id_envio,800,600);
}
function agregar_com_aut(){
	creaVenta('SMS/agregar_comandos_sms.php',800,600);
}
function editar_com_aut(id_com){
	//creaVenta('actualizar.php?&clase=comandos_sms&id_com='+id_com,600,600);
	creaVenta('SMS/comandos_sms.php?&clase=comandos_sms&id_com='+id_com,800,600);
}
function cuenta_carac()
{
	//alert(document.f1.descripcion_envio.value.length);
	var cant_car=parseInt(document.f1.descripcion_envio.value.length);
	var cant_sms=cant_car/160;
	cant_sms=parseInt(cant_sms)+1;
	//document.f1.cant_car.value=cant_car;
	//document.f1.cant_sms.value=cant_sms;
	document.getElementById('cant_car').innerHTML=cant_car;
	document.getElementById('cant_sms').innerHTML=cant_sms;
}

function cuenta_carac_cont(){
	var cant_car=parseInt(document.f1.sms.value.length);
	var cant_sms=cant_car/160;
	cant_sms=parseInt(cant_sms)+1;
	document.getElementById('cant_car').innerHTML=cant_car;
	document.getElementById('cant_sms').innerHTML=cant_sms;
}
function cuenta_carac_com(){
	var cant_car=parseInt(document.f1.sms_resp.value.length);
	var cant_sms=cant_car/160;
	cant_sms=parseInt(cant_sms)+1;
	document.getElementById('cant_car').innerHTML=cant_car;
	document.getElementById('cant_sms').innerHTML=cant_sms;
}
function cuenta_carac_com_f(){
	var cant_car=parseInt(document.f1.formato.value.length);
	var cant_sms=cant_car/160;
	cant_sms=parseInt(cant_sms)+1;
	document.getElementById('cant_car_f').innerHTML=cant_car;
	document.getElementById('cant_sms_f').innerHTML=cant_sms;
}
function cuenta_carac_com_m(){
	var cant_car=parseInt(document.f1.sms.value.length);
	var cant_sms=cant_car/160;
	cant_sms=parseInt(cant_sms)+1;
	document.getElementById('cant_car_m').innerHTML=cant_car;
	document.getElementById('cant_sms_m').innerHTML=cant_sms;
}
function cuenta_carac_com_e(){
	var cant_car=parseInt(document.f1.sms_error.value.length);
	var cant_sms=cant_car/160;
	cant_sms=parseInt(cant_sms)+1;
	document.getElementById('cant_car_e').innerHTML=cant_car;
	document.getElementById('cant_sms_e').innerHTML=cant_sms;
}
function cuenta_carac_d(){
	var cant_car=parseInt(document.f1.sms_resp_aut.value.length);
	var cant_sms=cant_car/160;
	cant_sms=parseInt(cant_sms)+1;
	document.getElementById('cant_car_d').innerHTML=cant_car;
	document.getElementById('cant_sms_d').innerHTML=cant_sms;
}

function guardar_conf_env_aut(){
	var tam = document.f1.envio_a.length;  
	var i=0;
	var cade='';
	var sms='';
	var email='';
	var cont=0;
	for(i=0;i<tam;i=i+2){
				if (document.f1.envio_a[i].checked == true)
					sms='TRUE';
				else
					sms='FALSE';
				if (document.f1.envio_a[i+1].checked == true)
					email='TRUE';
				else
					email='FALSE';
				
				if(cont==0){
					cade=cade+document.f1.envio_a[i].value+"=@=@=@=@"+sms+"=@"+email+"=@=@=@";
				}
				else
				{
					cade=cade+"-Class-guardar=@envio_aut=@"+document.f1.envio_a[i].value+"=@=@=@=@"+sms+"=@"+email+"=@=@=@";
				}
				cont++;
	}
	if(cade!='')
	{
		//alert(cade);
		confirmacion_sms("guardar","envio_aut",cade);
	}
}

function sel_todo_envio(){
   for (i=0;i<document.f1.envio_a.length;i++)
      if(document.f1.envio_a[i].type == "checkbox")
         document.f1.envio_a[i].checked=document.f1.sel_envio_a_c.checked;
}

function guardar_conf_com_aut(){
	var tam = document.f1.envio_a.length;  
	var i=0;
	var cade='';
	var status='';
	var status_e='';

	var cont=0;
	for(i=0;i<tam;i=i+2){
				if (document.f1.envio_a[i].checked == true)
					status='TRUE';
				else
					status='FALSE';
					
				if (document.f1.envio_a[i+1].checked == true)
					status_e='TRUE';
				else
					status_e='FALSE';
				
				
				if(cont==0){
					cade=cade+document.f1.envio_a[i].value+"=@=@=@=@=@"+status+"=@=@=@=@"+status_e+"=@";
				}
				else
				{
					cade=cade+"-Class-guardar=@comandos_sms=@"+document.f1.envio_a[i].value+"=@=@=@=@=@"+status+"=@=@=@=@"+status_e+"=@";
				}
				cont++;
	}
	if(cade!='')
	{
		confirmacion_sms("guardar","comandos_sms",cade);
	}
}

function hab_text_sms(){
   if(document.f1.act_resp_aut[0].checked){
		document.f1.sms_resp_aut.disabled=false;
   }
   else{
		document.f1.sms_resp_aut.disabled=true;
		if(document.f1.sms_resp_aut.value==""){
			document.f1.sms_resp_aut.value="NO APLICA";
		}
   }
}

function recib(){
	document.getElementById('divSMS').innerHTML ='<a href="#" onclick=\'conexionPHP_sms("sms.php","mostrarSMSEsp","000001=@=@Recibidos")\'><div id="effect" class="ui-widget-content ui-corner-all"><h5 class="ui-widget-header ui-corner-all">BOLIVAR JOSE</h5><p>FALLA. TENGO PROBLEMAS CON MI SEÑAL NO SE VEN BIEN LOS CANALES</p></div></a>';
}
function validaTextArea(){
	if(valorTextArea=='' || valorTextArea=='<br>')
	{
		alert(_('Error, debe escribir una descripcion en el Editor Wysiwyg'));
		
		return false;
	}
	else
		return true;
}
function wisin(){
	WYSIWYG.execCommand('textarea1', 'Preview');
		ClaseGlobal=clase;
		
		if(validaTextArea()) 
		{
			alert(valorTextArea);
		}
}
function hab_SMS(){
	if(document.f1.omitir.checked){
		document.f1.sms_resp.disabled=true;
		if(document.f1.sms_resp.value==""){
			document.f1.sms_resp.value="NO APLICA";
		}
   }
   else{
		document.f1.sms_resp.disabled=false;
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
		if(confirm(_('seguro que desea generar estas fallas'))){
			conexionPHP_sms("informacion.php","asig_falla_rep",document.f1.omitir.checked+"=@"+id_det_orden()+"=@"+sms_resp()+"=@"+cade);
		}
	 }
	}
	else{
		alert(_("Error, debe seleccionar al menos un mensaje de la lista"));
	}
}
function procesar_list_denuncia(){
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
		if(confirm(_('seguro que desea procesar estas denuncias'))){
			conexionPHP_sms("informacion.php","procesar_list_denuncia",document.f1.omitir.checked+"=@"+sms_resp()+"=@"+cade);
		}
	 }
	}
	else{
		alert(_("Error, debe seleccionar al menos un mensaje de la lista"));
	}
}

function procesar_list_reclamo(){
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
		if(confirm(_('seguro que desea procesar estos reclamos'))){
			conexionPHP_sms("informacion.php","procesar_list_reclamo",document.f1.omitir.checked+"=@"+sms_resp()+"=@"+cade);
		}
	 }
	}
	else{
		alert(_("Error, debe seleccionar al menos un mensaje de la lista"));
	}
}

function rec_falla_rep(){
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
			if(confirm(_('seguro que desea rechazar estas fallas'))){
				conexionPHP_sms("informacion.php","rec_falla_rep",document.f1.omitir.checked+"=@"+id_det_orden()+"=@"+sms_resp()+"=@"+cade);
			}
		}
	}
	else{
		alert(_("Error, debe seleccionar al menos un mensaje de la lista"));
	}
}
function validaTestSMS(){
	if(document.f1.omitir.checked==false){
		if(document.f1.sms_resp.value==""){
			alert(_("ERROR, debe introducir el mensaje a responder"));
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


function buscarDatos_sms(){

if(document.f1.sms.value==""){
alert(_("Error, debe introducir el mensaje a enviar"));
}
else{
if (confirm(_('Seguro que desea enviar los mensajes de textos'))){
	
	if(validaCampo(document.f1.deuda,isInteger)){
		if(document.f1.checkgrupo.checked == true)
			var sd="";
		else 
			var sd="true";
		
		if(document.f1.checkdeposito.checked == true)
			var dep="";
		else 
			var dep="true";
		
		
		archivoDataGrid="procesos/datos_mensajes.php?&sms="+document.f1.sms.value+"&deuda="+document.f1.deuda.value+"&id_tipo_servicio="+id_tipo_servicio()+"&id_serv="+id_serv()+"&id_g_a="+id_g_a()+"&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+estatusCheck()+"&sd="+sd+"&convenio="+document.f1.convenio.value+"&id_promo="+document.f1.id_promo.value+"&edificio="+document.f1.edificio.value+"&dep="+dep+"&";
		
		updateTable();
		document.f1.modificar.disabled=false;
	
		document.f1.registrar.disabled=true;
		alert(_("Los mensajes se estan enviando internamente."));
	}
	
}
}
}
function buscarDatos_sms_listado(){
if(validaCampo(document.f1.deuda,isInteger)){
		if(document.f1.checkgrupo.checked == true)
			var sd="";
		else 
			var sd="true";
		
		if(document.f1.checkdeposito.checked == true)
			var dep="";
		else 
			var dep="true";
		
		
		archivoDataGrid="procesos/listar_datos_mensajes.php?&deuda="+document.f1.deuda.value+"&id_tipo_servicio="+id_tipo_servicio()+"&id_serv="+id_serv()+"&id_g_a="+id_g_a()+"&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+estatusCheck()+"&sd="+sd+"&convenio="+document.f1.convenio.value+"&id_promo="+document.f1.id_promo.value+"&edificio="+document.f1.edificio.value+"&dep="+dep+"&";
		
		updateTable();
		document.f1.registrar.disabled=false;
	}
	
	
}

function bloquea_sd(){
	if(document.f1.checkgrupo.checked == true){
		document.f1.desde.disabled=true;
		document.f1.hasta.disabled=true;
		document.f1.deuda.disabled=true;
	}else{
		document.f1.desde.disabled=false;
		document.f1.hasta.disabled=false;
		document.f1.deuda.disabled=false;
	}
}

function eliminar_todos_sms_enviar(){
	if (confirm(_('confirma que desea eliminar todos los mensajes'))){
		conexionPHP_sms("informacion.php",'eliminar_todos_sms_enviar');
	}
}
function eliminar_todos_email_enviar(){
	if (confirm(_('confirma que desea eliminar todos los email'))){
		conexionPHP_sms("informacion.php",'eliminar_todos_email_enviar');
	}
}
function eliminar_sms_enviados(){
	if (confirm(_('confirma que desea eliminar todos los mensajes enviados'))){
		conexionPHP_sms("informacion.php",'eliminar_sms_enviados');
	}
}
function eliminar_email_enviados(){
	if (confirm(_('confirma que desea eliminar todos los emails enviados'))){
		conexionPHP_sms("informacion.php",'eliminar_email_enviados');
	}
}
function eliminar_sms_enviar(id_sinc){
	if (confirm(_('confirma que desea eliminar este mensaje'))){
		conexionPHP_sms("informacion.php",'eliminar_sms_enviar',id_sinc);
	}
}
function eliminar_email_enviar(id_sinc){
	if (confirm(_('confirma que desea eliminar este mensaje'))){
		conexionPHP_sms("informacion.php",'eliminar_email_enviar',id_sinc);
	}
}
function buscar_sms_enviar(){
	archivoDataGrid="procesos/datagrid_sms_por_enviar.php?status_sinc="+document.f1.status_sinc.value+"&";
	updateTable_sms();
}
function buscar_email_enviar(){
	archivoDataGrid="procesos/datagrid_email_por_enviar.php?status_e_sinc="+document.f1.status_e_sinc.value+"&";
	updateTable_sms();
}
function buscar_admin_sms_enviar(){
	if(document.f1.desde.value!='' || document.f1.hasta.value!=''){
		if(valdate(document.f1.desde.value) && valdate(document.f1.hasta.value)){}else{ return;	}
	}
	
	archivoDataGrid="procesos/datagrid_admin_sms.php?tipo_sms="+document.f1.tipo_sms.value+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&";
	updateTable_sms();
}
function buscar_list_denuncia(){
	archivoDataGrid="procesos/list_denuncia.php?status_list="+document.f1.status_list.value+"&";
	updateTable_sms();
}
function buscar_list_reclamo(){
	archivoDataGrid="procesos/list_reclamo.php?status_list="+document.f1.status_list.value+"&";
	updateTable_sms();
}
function buscar_list_falla(){
	archivoDataGrid="procesos/list_falla.php?status_list="+document.f1.status_list.value+"&";
	updateTable_sms();
}
function marcar_como_sms_enviar(){
if(document.f1.marcar_como.value!=''){
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
				cade=cade+"=@"+trim(document.f1.checkbox[i].value);
				cont++;
		}
	}
	if(cade!='')
	{
		if (confirm(_("Confirma que desea aplicar estos cambios"))){
			conexionPHP_sms("informacion.php",'marcar_como_sms_enviar',document.f1.marcar_como.value+cade);
		}
	}
	else{
		alert(_("Error, debe seleccionar al menos un SMS de la lista"));
	}
}
}

function marcar_como_email_enviar(){
if(document.f1.marcar_como.value!=''){
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
				cade=cade+"=@"+trim(document.f1.checkbox[i].value);
				cont++;
		}
	}
	if(cade!='')
	{
		if (confirm(_("Confirma que desea aplicar estos cambios"))){
			conexionPHP_sms("informacion.php",'marcar_como_email_enviar',document.f1.marcar_como.value+cade);
		}
	}
	else{
		alert(_("Error, debe seleccionar al menos un Email de la lista"));
	}
}
}

function marcar_como_admin_sms_enviar(){
  if(document.f1.marcar_como.value!=''){	
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
				cade=cade+"=@"+trim(document.f1.checkbox[i].value);
				cont++;
		}
	}
	if(cade!='')
	{
		if (confirm(_("Confirma que desea aplicar estos cambios"))){
			conexionPHP_sms("informacion.php",'marcar_como_admin_sms_enviar',document.f1.marcar_como.value+cade);
		}
	}
	else{
		alert(_("Error, debe seleccionar al menos un SMS de la lista"));
	}
  }//if
}

function marcar_list_denuncia(){
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
				cade=cade+"=@"+trim(document.f1.checkbox[i].value);
				cont++;
		}
	}
	if(cade!='')
	{
		if (confirm(_("Confirma que desea aplicar estos cambios"))){
			conexionPHP_sms("informacion.php",'marcar_list_denuncia',document.f1.marcar_como.value+cade);
		}
	}
	else{
		alert(_("Error, debe seleccionar al menos un SMS de la lista"));
	}
}

function marcar_list_reclamo(){
if(document.f1.marcar_como.value!=''){
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
				cade=cade+"=@"+trim(document.f1.checkbox[i].value);
				cont++;
		}
	}
	if(cade!='')
	{
		if (confirm(_("Confirma que desea aplicar estos cambios"))){
			conexionPHP_sms("informacion.php",'marcar_list_reclamo',document.f1.marcar_como.value+cade);
		}
	}
	else{
		alert(_("Error, debe seleccionar al menos un SMS de la lista"));
	}
}
}

function marcar_list_falla(){
if(document.f1.marcar_como.value!=''){
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
				cade=cade+"=@"+trim(document.f1.checkbox[i].value);
				cont++;
		}
	}
	if(cade!='')
	{
		if (confirm(_("Confirma que desea aplicar estos cambios"))){
			conexionPHP_sms("informacion.php",'marcar_list_falla',document.f1.marcar_como.value+cade);
		}
	}
	else{
		alert(_("Error, debe seleccionar al menos un SMS de la lista"));
	}
}
}


/*para envio de lista de excel*/
function cargarExcel(){
			creaVenta("SMS/Formulario/cargarExcel.php",600,400);
		
}
function cerrarVenCarga(){
	document.f1.excel.value="Cargando Archivo...";
	parent.dhxWins.window("w2").close();
	listarDatosSMS();
}
function listarDatosSMS(){
	params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
	divDataGrid="datagrid";
	archivoDataGrid="SMS/procesos/cargarLote.php";
	updateTable();
	archivoDataGrid="SMS/procesos/listado_sms_excel.php";
}


function enviar_sms_excel(){
	params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
	divDataGrid="datagrid";
	archivoDataGrid="SMS/procesos/enviar_sms_excel.php?sms="+document.f1.sms.value+"&";
	updateTable();
	alert("lOS MENSAJES SE ESTAN ENVIANDO INTERNAMENTE.")
	document.f1.registrar.disabled=true;
	
}

function str_replace (search, replace, subject, count) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Gabriel Paderni
    // +   improved by: Philip Peterson
    // +   improved by: Simon Willison (http://simonwillison.net)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   bugfixed by: Anton Ongson
    // +      input by: Onno Marsman
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +    tweaked by: Onno Marsman
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   input by: Oleg Eremeev
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Oleg Eremeev
    // %          note 1: The count parameter must be passed as a string in order
    // %          note 1:  to find a global variable in which the result will be given
    // *     example 1: str_replace(' ', '.', 'Kevin van Zonneveld');
    // *     returns 1: 'Kevin.van.Zonneveld'
    // *     example 2: str_replace(['{name}', 'l'], ['hello', 'm'], '{name}, lars');
    // *     returns 2: 'hemmo, mars'
    var i = 0,
        j = 0,
        temp = '',
        repl = '',
        sl = 0,
        fl = 0,
        f = [].concat(search),
        r = [].concat(replace),
        s = subject,
        ra = Object.prototype.toString.call(r) === '[object Array]',
        sa = Object.prototype.toString.call(s) === '[object Array]';
    s = [].concat(s);
    if (count) {
        this.window[count] = 0;
    }

    for (i = 0, sl = s.length; i < sl; i++) {
        if (s[i] === '') {
            continue;
        }
        for (j = 0, fl = f.length; j < fl; j++) {
            temp = s[i] + '';
            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
            s[i] = (temp).split(f[j]).join(repl);
            if (count && s[i] !== temp) {
                this.window[count] += (temp.length - s[i].length) / f[j].length;
            }
        }
    }
    return sa ? s : s[0];
}