var ventaG='';
var ventanaModal='';
var trae_ubi_gru_f_G=false;
var id_f='';
var dir_fiscal='';
var claseGlobal="";
var cedulaPersona="";
var id_per_global="";
var id_cliente_G="";
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
var imp_factG=false;
var id_cont_act_c='';
var id_notaG='';
var id_det_orderG='';
var inicialG='';
var datos_fiscal_G='';
var id_contrato_G='';
var id_contrato_GP='';
var ruta_G='';
var id_all_G='';
var id_lc_G='';
var alert_act_G='';
var dias_alert_act_G='';
var alert_imp_G='';
var correl_G='';
var dig_cont_G='';
var serie_correl_G='';
var planilla_orden_G='';
var modulo_cable_modem_G='';
var control_recibo_G='';
var dig_cont_fisico_G='';
var dig_recibo_G='';
var tipo_facturacion='';
var trae_ubi_gru_f_G=false; 
var debug_G=true;
var errorGlobal="<h4 class='titulo-alerta'><i class='fa fa-times-circle'></i> <strong> Error al validar los campos del formulario, debes corregirlo para continuar! </strong> </h4>";
function log(id){
  if(debug_G==true){
    console.log(id);
  }
}
function foco(id){
  log("foco:"+id);
  document.getElementById(id).select();
}
function getD(id){
  log("getD:"+id+":"+document.getElementById(id).value.trim());
  return document.getElementById(id).value.trim();
}
function setD(id,valor){
  log("setD:"+id);
  return document.getElementById(id).value=valor;
}
function setHTML(id,valor){
   log("setHTML:"+id);
  return document.getElementById(id).innerHTML=valor;
}
function disabled(id){
log("disabled:"+id);
  document.getElementById(id).disabled=true;
}
function enabled(id){
log("enabled:"+id);
  return document.getElementById(id).disabled=false;
}
function getOption(nombre){
  log("getOption:"+nombre);
  elementos = document.getElementById("f1").elements;
  longitud = document.getElementById("f1").length;
  for (var i = 0; i < longitud; i++){
    if(elementos[i].name == nombre && elementos[i].type == "radio" && elementos[i].checked == true){
     return elementos[i].value;
   }
 }
}
function setOption(nombre,valor){
  log("setOption:"+nombre);
  elementos = document.getElementById("f1").elements;
  longitud = document.getElementById("f1").length;
  for (var i = 0; i < longitud; i++){
    if(elementos[i].name == nombre && elementos[i].type == "radio" && elementos[i].value == valor){
       elementos[i].checked=true;
    }
  }
}

function getOption_f3(nombre){
  log("getOption_f3:"+nombre);
  elementos = document.getElementById("f3").elements;
  longitud = document.getElementById("f3").length;
  for (var i = 0; i < longitud; i++){
    if(elementos[i].name == nombre && elementos[i].type == "radio" && elementos[i].checked == true){
     return elementos[i].value;
   }
 }
 return "";
}

function _(id){
  if(array_test[id]!=null){
    return array_test[id];
  }
  else{
    return id;
  }
}
function gettext (id){
  return _(id);
}
function gettext_noop (id) {
  return _(id);
}
function cargar_form_iniciarsesion(){
  $.ajax({
    type: "GET",
    url: "Formulario/Sesion.php",
   })
   .done(function( respuesta, textStatus, jqXHR ){
      $("#principal").html(respuesta);
      alert_act_G = document.getElementById("alert_act_G").value;
      dias_alert_act_G = document.getElementById("dias_alert_act_G").value;
      alert_imp_G = document.getElementById("alert_imp_G").value;
      tipo_facturacion = document.getElementById("tipo_facturacion").value;
      dig_cont_G = document.getElementById("dig_cont_G").value;
      serie_correl_G = document.getElementById("serie_correl_G").value;
      planilla_orden_G = document.getElementById("planilla_orden_G").value;
      modulo_cable_modem_G = document.getElementById("modulo_cable_modem_G").value;
      control_recibo_G = document.getElementById("control_recibo_G").value;
      dig_cont_fisico_G = document.getElementById("dig_cont_fisico_G").value;
      dig_recibo_G = document.getElementById("dig_recibo_G").value;

      setD("login","admin");
      setD("password","123456");
      iniciarSesion();
  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}
function iniciarSesion(){
  //log("entro a iniciarSesion")
  var login = getD("login");
  var password = getD("password");

  $.ajax({
    data: {
      "clase":"IniciarSesion",
      "login":login,
      "password":password
    },
    type: "POST",
    dataType: "json",
    url: "Seguridad/Seguridad.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if( respuesta.success ){
          $('#carga-inicial').css({ 'display': 'block' });

          perfilUsuario=respuesta.resultado.usuario.nombreperfil;
          id_f=respuesta.resultado.usuario.id_franq;
          codigoPerfil=respuesta.resultado.usuario.codigoperfil;
          cedulaPersona=respuesta.resultado.usuario.cedula;
          id_per_global=respuesta.resultado.usuario.id_persona;
          inicialG=respuesta.resultado.usuario.inicial;
          dir_fiscal="localhost";
          
          
          if(respuesta.mensualidad=="cargarMensualidad"){
            generar_mensualidad();
            document.getElementById("datos_usuario").innerHTML=respuesta.resultado.profile;
            //dialog.setMessage('<div style="text-align: center;color:#058CB6;"><br>GENERANDO FACTURACION POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>');
            document.getElementById("principal").innerHTML='<div style="text-align: center;color:#058CB6;"><br>GENERANDO FACTURACION POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
          }
          else{
            document.getElementById("datos_usuario").innerHTML=respuesta.resultado.profile;
            cargar_bienvenidos_saeco();
          }


          $('#login-body').css({ 'display': 'none' });
          $('.container-login').css({ 'display': 'none' });
          $('#carga-inicial').fadeOut(4000);
      }else {
          alerta("Error, el Usuario y/o Contraseña ingresados no son válidos. <br>Por favor intente de nuevo!");
          document.f1.password.select();
      }
   })
   .fail(function( jqXHR, textStatus, errorThrown ) {
     log( "La solicitud a fallado: " +  textStatus);
   });
}
function cargar_bienvenidos_saeco(){
  $.ajax({
      type: "GET",
      url: "Formulario/bienvenidos_saeco.php",
   })
     .done(function( respuesta, textStatus, jqXHR ){
       $("#principal").html(respuesta);
  })
}


function isset(){
  var a = arguments,
    l = a.length,
    i = 0,
    undef;
  if (l === 0) {
    throw new Error('Empty isset');
  }
  while (i !== l) {
    if (a[i] === undef || a[i] === null) {
      return false;
    }
    i++;
  }
  return true;
}
function activar_validar_datos(){
 // log("activar_validar_datos")
/*
   $.listen('parsley:field:validate', function () {
    log("parsley:field:validate")
      validar_datos_form();
   });
   */
   /*
   $('#f1 .btn').on('click', function () {
      log("entro cargar validate function")
      $('#f1').parsley().validate();
      return validar_datos_form();
   });
   */
}
function validar_datos_form(){
  //  log("entro validar_datos_form")
     $('#f1').parsley().validate();
   if (true === $('#f1').parsley().isValid()) {
      $('.bs-callout-info').removeClass('hidden');
      $('.bs-callout-warning').addClass('hidden');
      $('#error').hide();
    //  log("true");
      return true;
   } else {
      $('.bs-callout-info').addClass('hidden');
      $('.bs-callout-warning').removeClass('hidden');
      $('#error').show();
   //   log("false");
      return false;
   }
}

function validar_datos_form_f2(){
     $('#f2').parsley().validate();
   if (true === $('#f2').parsley().isValid()) {
      $('.bs-callout-info').removeClass('hidden');
      $('.bs-callout-warning').addClass('hidden');
      $('#error_f2').hide();
      return true;
   } else {
      $('.bs-callout-info').addClass('hidden');
      $('.bs-callout-warning').removeClass('hidden');
      $('#error_f2').show();
      return false;
   }
}
function validar_datos_form_f3(){
     $('#f3').parsley().validate();
   if (true === $('#f3').parsley().isValid()) {
      $('.bs-callout-info').removeClass('hidden');
      $('.bs-callout-warning').addClass('hidden');
      $('#error_f3').hide();
      return true;
   } else {
      $('.bs-callout-info').addClass('hidden');
      $('.bs-callout-warning').removeClass('hidden');
      $('#error_f3').show();
      return false;
   }
}

function validar_datos_form_f5(){
     $('#f5').parsley().validate();
   if (true === $('#f5').parsley().isValid()) {
      $('.bs-callout-info').removeClass('hidden');
      $('.bs-callout-warning').addClass('hidden');
      $('#error_f5').hide();
      return true;
   } else {
      $('.bs-callout-info').addClass('hidden');
      $('.bs-callout-warning').removeClass('hidden');
      $('#error_f5').show();
      return false;
   }
}

/*OPCIONAL CREAR SOLO EN CASO DE EJECUTAR CODIGO AL CARGAR O EN CASO DE TENER MULTIPLES LISTADOS. SI NO LLAMAR A listar_datos_general(ruta,id_div)*/
function listar_banco(archivoDataGrid,divDataGrid,params){
   if (!isset(params)) {var params="useajax=true&divDataGrid="+divDataGrid;}
      params=params+"&metodo=listar_banco";
      document.getElementById(divDataGrid).innerHTML='<div style="text-align: center;color:#058CB6;"><br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
   $.ajax({
      data: params,
      type: "GET",
      url: archivoDataGrid,
   })
   .done(function( respuesta, textStatus, jqXHR ) {
      document.getElementById(divDataGrid).innerHTML=respuesta;

  })
   .fail(function( jqXHR, textStatus, errorThrown ) {
      alerta("Error al cargar formulario:\n "+textStatus);
   });
}

function validardatos(llamafuncion,accion,clase){
  //  log("entro a validar datos")
  if(validar_datos_form()){
    //  log("vaslido correctamente")
    ventaG =  new BootstrapDialog({
    title: 'CONFIRMACIÓN DE SAECO',
    message: 'Seguro que desea enviar este formulario?',
    type: BootstrapDialog.TYPE_INFO,
    closable: true,
    buttons: [{
      label: 'NO',
      icon: 'glyphicon glyphicon-thumbs-down',
      cssClass: 'btn-danger',
      action: function(dialog) {
        dialog.close();
        return false;
      }
    }, {
      label: 'SI',
      icon : 'glyphicon glyphicon-thumbs-up',
      cssClass: 'btn-info',
      action: function(dialog) {
        //  log("acepto enviar")
        dialog.setTitle('Procesando Información');
        dialog.setButtons('');
        dialog.setType(BootstrapDialog.TYPE_SUCCESS);
        dialog.setMessage('<div style="text-align: center;color:#058CB6;"><br>Por favor espere<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>');

          eval(llamafuncion+"('"+accion+"','"+clase+"')");

        }}]}).open();
 }else{$("#error").html(errorGlobal);  }
}

function validardatos_f2(llamafuncion,accion,clase){
  //  log("entro a validar datos")
  if(validar_datos_form_f2()){
    //  log("vaslido correctamente")
    ventaG =  new BootstrapDialog({
    title: 'CONFIRMACIÓN DE SAECO',
    message: 'Seguro que desea enviar este formulario?',
    type: BootstrapDialog.TYPE_INFO,
    closable: false,
    buttons: [{
      label: 'NO',
      icon: 'glyphicon glyphicon-thumbs-down',
      cssClass: 'btn-danger',
      action: function(dialog) {
        dialog.close();
        return false;
      }
    }, {
      label: 'SI',
      icon : 'glyphicon glyphicon-thumbs-up',
      cssClass: 'btn-info',
      action: function(dialog) {
        //  log("acepto enviar")
        dialog.setTitle('Procesando Información');
        dialog.setButtons('');
        dialog.setType(BootstrapDialog.TYPE_SUCCESS);
        dialog.setMessage('<div style="text-align: center;color:#058CB6;"><br>Por favor espere<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>');

          eval(llamafuncion+"('"+accion+"','"+clase+"')");

        }}]}).open();
 }else{$("#error_f2").html(errorGlobal);}
}

function validardatos_f3(llamafuncion,accion,clase){
  //  log("entro a validar datos")
  if(validar_datos_form_f3()){
    //  log("vaslido correctamente")
    ventaG =  new BootstrapDialog({
    title: 'CONFIRMACIÓN DE SAECO',
    message: 'Seguro que desea enviar este formulario?',
    type: BootstrapDialog.TYPE_INFO,
    closable: false,
    buttons: [{
      label: 'NO',
      icon: 'glyphicon glyphicon-thumbs-down',
      cssClass: 'btn-danger',
      action: function(dialog) {
        dialog.close();
        return false;
      }
    }, {
      label: 'SI',
      icon : 'glyphicon glyphicon-thumbs-up',
      cssClass: 'btn-info',
      action: function(dialog) {
        //  log("acepto enviar")
        dialog.setTitle('Procesando Información');
        dialog.setButtons('');
        dialog.setType(BootstrapDialog.TYPE_SUCCESS);
        dialog.setMessage('<div style="text-align: center;color:#058CB6;"><br>Por favor espere<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>');

          eval(llamafuncion+"('"+accion+"','"+clase+"')");

        }}]}).open();
 }else{$("#error_f3").html(errorGlobal);}
}


function sololetras(e)
{
	key=e.keycode || e.which;
	
	teclado=String.fromCharCode(key).toLowerCase();
	
	letras=" abcdefghijklmnñopqrstuvwxyz";
	
	especiales="09-8-37-38-46-164";
	
	teclado_especial=false;
	
	for(var i in especiales){
		if(key==especiales[i]){
			teclado_especial=true;break;
		}
	}
	if(letras.indexOf(teclado)==-1 && !teclado_especial){
		return false;
	}
}




///////////////////////////////////////



function traer_estado_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traer_estado_n",
      "datos":{"id_mun":getD("id_mun")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        setD("id_esta",respuesta.campo.id_esta);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function btraer_estado_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traer_estado_n",
      "datos":{"id_mun":getD("bid_mun")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        setD("bid_esta",respuesta.campo.id_esta);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}



function cargar_municipio_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"cargar_municipio_n",
      "datos":{"id_esta":getD("id_esta")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        setHTML("id_mun",respuesta.campo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function bcargar_municipio_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"cargar_municipio_n",
      "datos":{"id_esta":getD("bid_esta")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        setHTML("bid_mun",respuesta.campo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function cargarubicacion(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"cargarubicacion",
      "datos":{"id_franq":getD("id_franq")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      var c=respuesta.campo;
      if(respuesta.success ){
        setHTML("id_esta",c.id_esta);
        setHTML("id_mun",c.id_mun);
        setHTML("id_ciudad",c.id_ciudad);
        setHTML("id_zona",c.id_zona);
        setHTML("id_sector",c.id_sector);
        setHTML("id_calle",c.id_calle);
        setHTML("id_edif",c.id_edif);
        setHTML("id_urb",c.id_urb);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function bcargarubicacion(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"cargarubicacion",
      "datos":{"id_franq":getD("bid_franq")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      var c=respuesta.campo;
      if(respuesta.success ){
        setHTML("bid_esta",c.id_esta);
        setHTML("bid_mun",c.id_mun);
        setHTML("bid_ciudad",c.id_ciudad);
        setHTML("bid_zona",c.id_zona);
        setHTML("bid_sector",c.id_sector);
        setHTML("bid_calle",c.id_calle);
        setHTML("bid_edif",c.id_edif);
        setHTML("bid_urb",c.id_urb);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function traer_municipio_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traer_municipio_n",
      "datos":{"id_ciudad":getD("id_ciudad")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("id_esta",c.id_esta);
        setD("id_mun",c.id_mun);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function btraer_municipio_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traer_municipio_n",
      "datos":{"id_ciudad":getD("bid_ciudad")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("bid_esta",c.id_esta);
        setD("bid_mun",c.id_mun);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function traer_ciudad_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traer_ciudad_n",
      "datos":{"id_zona":getD("id_zona")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("id_esta",c.id_esta);
        setD("id_mun",c.id_mun);
        setD("id_ciudad",c.id_ciudad);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function btraer_ciudad_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traer_ciudad_n",
      "datos":{"id_zona":getD("bid_zona")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("bid_esta",c.id_esta);
        setD("bid_mun",c.id_mun);
        setD("bid_ciudad",c.id_ciudad);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function traerZona_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traerZona_n",
      "datos":{"id_sector":getD("id_sector")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("id_zona",c.id_zona);
        setD("id_esta",c.id_esta);
        setD("id_mun",c.id_mun);
        setD("id_ciudad",c.id_ciudad);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function cargar_datos_sector(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"cargar_datos_sector",
      "datos":{"id_sector":getD("id_sector")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("id_zona",c.id_zona);
        setD("id_esta",c.id_esta);
        setD("id_mun",c.id_mun);
        setD("id_ciudad",c.id_ciudad);
        setD("id_franq",c.id_franq);
        setHTML("id_calle",c.id_calle);
        setHTML("id_edif",c.id_edif);
        setHTML("id_urb",c.id_urb);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function bcargar_datos_sector(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"cargar_datos_sector",
      "datos":{"id_sector":getD("bid_sector")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("bid_zona",c.id_zona);
        setD("bid_esta",c.id_esta);
        setD("bid_mun",c.id_mun);
        setD("bid_ciudad",c.id_ciudad);
        setD("bid_franq",c.id_franq);
        setHTML("bid_calle",c.id_calle);
        setHTML("bid_edif",c.id_edif);
        setHTML("bid_urb",c.id_urb);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function traerSector_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traerSector_n",
      "datos":{"id_calle":getD("id_calle")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("id_zona",c.id_zona);
        setD("id_esta",c.id_esta);
        setD("id_mun",c.id_mun);
        setD("id_ciudad",c.id_ciudad);
        setD("id_franq",c.id_franq);
        setD("id_sector",c.id_sector);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function btraerSector_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traerSector_n",
      "datos":{"id_calle":getD("bid_calle")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("bid_zona",c.id_zona);
        setD("bid_esta",c.id_esta);
        setD("bid_mun",c.id_mun);
        setD("bid_ciudad",c.id_ciudad);
        setD("bid_franq",c.id_franq);
        setD("bid_sector",c.id_sector);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function btraerSectorUrb_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traerSectorUrb_n",
      "datos":{"id_urb":getD("bid_urb")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("bid_zona",c.id_zona);
        setD("bid_esta",c.id_esta);
        setD("bid_mun",c.id_mun);
        setD("bid_ciudad",c.id_ciudad);
        setD("bid_franq",c.id_franq);
        setD("bid_sector",c.id_sector);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function traerSectorUrb_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traerSectorUrb_n",
      "datos":{"id_urb":getD("id_urb")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("id_zona",c.id_zona);
        setD("id_esta",c.id_esta);
        setD("id_mun",c.id_mun);
        setD("id_ciudad",c.id_ciudad);
        setD("id_franq",c.id_franq);
        setD("id_sector",c.id_sector);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function traerSectorEdif_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traerSectorEdif_n",
      "datos":{"id_edif":getD("id_edif")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("id_zona",c.id_zona);
        setD("id_esta",c.id_esta);
        setD("id_mun",c.id_mun);
        setD("id_ciudad",c.id_ciudad);
        setD("id_franq",c.id_franq);
        setD("id_sector",c.id_sector);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function btraerSectorEdif_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"traerSectorEdif_n",
      "datos":{"id_edif":getD("bid_edif")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ) {
      if(respuesta.success ){
        var c=respuesta.campo;
        setD("bid_zona",c.id_zona);
        setD("bid_esta",c.id_esta);
        setD("bid_mun",c.id_mun);
        setD("bid_ciudad",c.id_ciudad);
        setD("bid_franq",c.id_franq);
        setD("bid_sector",c.id_sector);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}


function cargar_ciudad_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"cargar_ciudad_n",
      "datos":{"id_mun":getD("id_mun")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        setHTML("id_ciudad",respuesta.campo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function bcargar_ciudad_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"cargar_ciudad_n",
      "datos":{"id_mun":getD("bid_mun")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        setHTML("bid_ciudad",respuesta.campo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function cargarZona_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"cargarZona_n",
      "datos":{"id_ciudad":getD("id_ciudad")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        setHTML("id_zona",respuesta.campo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function bcargarZona_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"cargarZona_n",
      "datos":{"id_ciudad":getD("bid_ciudad")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        setHTML("bid_zona",respuesta.campo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function cargarSector_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"cargarSector_n",
      "datos":{"id_zona":getD("id_zona")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        setHTML("id_sector",respuesta.campo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}
function bcargarSector_n(){
  $.ajax({data:{
      "parametros":JSON.stringify({
      "clase":"cargarSector_n",
      "datos":{"id_zona":getD("bid_zona")}
    })},
     type: "GET",
     dataType: "json",
     url: "controlador_informacion.php",
  })
   .done(function( respuesta, textStatus, jqXHR ){
      if(respuesta.success ){
        setHTML("bid_sector",respuesta.campo);
      }else {
         log( "Error: " + respuesta.error);
      }
   });
}

function formatdate(fecha){
  var date=fecha.split("/");
  var result=date[2]+'-'+date[1]+'-'+date[0]; 
  //alerta(result);
  return result;
}
function formatdatei(fecha){
  var date=fecha.split("-");
  var result=date[2]+'/'+date[1]+'/'+date[0]; 
  //alerta(result);
  return result;
}


function valida_form_externo(id) {

  switch(id)
  {
    //clase o tabla usuario
    case "add_zona":
      if(getD("id_ciudad")==''){
        alerta("Error debe cargar la Ciudad a la que va corresponder la nueva zona");
        return false;
      }
    break
    case "add_sector":
      if(getD("id_zona")=='' || getD("id_franq")==''){
        alerta("Error debe cargar la Zona y la Franquicia a la que va corresponder el nuevo sector");
        return false;
      }
    break
    case "add_urb":
      if(getD("id_sector")==''){
        alerta("Error debe cargar el Sector a la que va corresponder  la nueva urbanizacion");
        return false;
      }
    case "add_calle":
      if(getD("id_sector")==''){
        alerta("Error debe cargar el Sector a la que va corresponder  la nueva calle");
        return false;
      }
    case "add_edificio":
      if(getD("id_sector")==''){
        alerta("Error debe cargar el Sector a la que va corresponder el nuevo edificio");
        return false;
      }
    break
    case "busqueda_avanzada":
      return true;
    break
    default:
    alerta("Error, no esta definida la ventana externa: "+id);
  }
  return true;
}
function buscarC(evt)
{
  
  evt = (evt) ? evt : event;
  var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
  ((evt.which) ? evt.which : 0));
  //alerta(charCode);
  if (charCode == 13){
    buscarContAvanz();
  }
  else{
    return true;
  }
}
function buscarCT(evt)
{
  
  evt = (evt) ? evt : event;
  var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
  ((evt.which) ? evt.which : 0));
  //alerta(charCode);
  if (charCode == 13){
    buscarContAvanzT();
  }
  else{
    return true;
  }
}
function buscarContAvanz(){
  if(getD("bfecha_contrato")!='' && getD("bfecha_contrato_h")){
    var fecha_d=formatdate(getD("bfecha_contrato"))
    var fecha_h=formatdate(getD("bfecha_contrato_h"))
  }
  else{
    var fecha_d='';
    var fecha_h='';
  }
  archivoDataGrid="busqueda/busq_cont_avanz.php?&cedula="+getD("bcedula")+"&nombre="+getD("bnombre")+"&apellido="+getD("bapellido")+"&nro_contrato="+getD("bnro_contrato")+"&etiqueta="+getD("betiqueta")+"&fecha_contrato_d="+fecha_d+"&fecha_contrato_h="+fecha_h+"&id_franq="+getD("bid_franq")+"&id_zona="+getD("bid_zona")+"&id_sector="+getD("bid_sector")+"&id_calle="+getD("bid_calle")+"&numero_casa="+getD("bnumero_casa")+"&telefono="+getD("btelefono")+"&telf_casa="+getD("btelf_casa")+"&contrato_fisico="+getD("bcontrato_fisico")+"&status_contrato="+getD("bstatus_contrato")+"&id_g_a="+getD("bid_g_a")+"&id_persona="+getD("bid_persona")+"&cod_id_persona="+getD("bcod_id_persona")+"&postel="+getD("bpostel")+"&id_esta="+getD("bid_esta")+"&id_mun="+getD("bid_mun")+"&id_ciudad="+getD("bid_ciudad")+"&id_urb="+getD("bid_urb")+"&id_edif="+getD("bid_edif")+"&tipo_fact="+getOption_f3("btipo_fact")+"&";
   listar_datos(archivoDataGrid,"datagrid_busqueda");
}
function buscarContAvanzT(){
  var fecha='';
  if(getD("bfecha_contrato")!=''){
    fecha=formatdate(getD("bfecha_contrato"))
  }
  else{
    fecha='';
  }
  archivoDataGrid="busqueda/busq_cont_avanzT.php?&cedula="+getD("bcedula")+"&nombre="+getD("bnombre")+"&apellido="+getD("bapellido")+"&nro_contrato="+getD("bnro_contrato")+"&etiqueta="+getD("betiqueta")+"&fecha_contrato="+fecha+"&id_franq="+getD("bid_franq")+"&id_zona="+getD("bid_zona")+"&id_sector="+getD("bid_sector")+"&id_calle="+getD("bid_calle")+"&numero_casa="+getD("bnumero_casa")+"&telefono="+getD("btelefono")+"&telf_casa="+getD("btelf_casa")+"&contrato_fisico="+getD("bcontrato_fisico")+"&status_contrato="+getD("bstatus_contrato")+"&id_g_a="+getD("bid_g_a")+"&id_persona="+getD("bid_persona")+"&cod_id_persona="+getD("bcod_id_persona")+"&postel="+getD("bpostel")+"&";
  listar_datos(archivoDataGrid,"datagrid_busqueda");
}
function limpiarBusqAvanz(){
  getD("bfecha_contrato")='';
  getD("bcedula")='';
  getD("bnombre")='';
  getD("bapellido")='';
  getD("betiqueta")='';
  getD("bid_franq")='0';
  getD("bid_zona")='0';
  getD("bid_sector")='0';
  getD("bid_calle")='0';
  getD("bstatus_contrato")='0';
  getD("bid_g_a")='0';
  getD("bid_persona")='0';
  getD("bcod_id_persona")='0';
  getD("bnumero_casa")='';
  getD("btelefono")='';
  getD("btelf_casa")='';
  getD("bcontrato_fisico")='';
  getD("bpostel")='';
}
function cerrarBusqAvanz(){
  ventana.close();
}

function respBuscarContAvanz1(id_contrato){
  conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato);
  ventana.close();
}
function ajaxVentana(titulo, id){
  if(valida_form_externo(id)){
     $.ajax({
      type: "GET",
      url: "add/"+id+".php",
     })
     .done(function( contenido, textStatus, jqXHR ){
        ventanaExterna(titulo, contenido);
     })
     .fail(function( jqXHR, textStatus, errorThrown ) {
        alerta("Error al cargar formulario:\n "+textStatus);
     });
  }
}

/*---VENTANAS MODALES----*/
function ventanaExterna(titulo, contenido, id) {
   ventanaModal = BootstrapDialog.show({
    title    : titulo,
    message  : $(contenido),
    closable : true,
    type     : BootstrapDialog.TYPE_INFO,
    cssClass: 'ventana-formulario',
    buttons  : [{}]
  });
  ventanaModal.getModalFooter().css('border', '0');
  //ventanaModal.getModalFooter().css('text-align', 'center');
}

function cerrar_ventana_externa() {
   ventanaModal.close();
}
function trim(cadena){
  return cadena;
}
function trim(cadena){
  location.href="reportehtml2pdf/demo.php?&&";
}
function ocultarmostrardiv(div){

if(document.getElementById(div).style.display=="none"){
document.getElementById(div).style='display:block;';
}
else
document.getElementById(div).style='display:none;';
}

function mostrar(div){

	document.getElementById(div).style='display:block;';

}
function ocultar(div){

	document.getElementById(div).style='display:none;';
}
