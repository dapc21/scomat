//para que ejecute la funcion cerrarSesion al cargar la pagina index.html
//window.onload=cerrarSesion;
//window.onload=iniciarSesionPrueba;
//declaracion de variables globales|

//window.onUnload=cerrarSes();


	
function validarconf_comision(){ conexionPHP("validarExistencia.php","1=@conf_comision","pago_comisones=@"+pago_comisones());}
function validarpago_comisones(){ conexionPHP("validarExistencia.php","1=@pago_comisones","id_pago_com=@"+id_pago_com());}

function validar_nom_statuscont(){ conexionPHP("validarExistencia.php","1=@statuscont","nombrestatus=@"+nombrestatus());}
function validar_nom_otivonotas(){ conexionPHP("validarExistencia.php","1=@motivonotas","nombremotivonota=@"+nombremotivonota());}
function validar_nom_motivollamada(){ conexionPHP("validarExistencia.php","1=@motivollamada","nombremotivonota=@"+nombremotivonota());}
function validar_nom_grupo_afinidad(){ conexionPHP("validarExistencia.php","1=@grupo_afinidad","nombre_g_a=@"+nombre_g_a());}
function validar_nom_banco(){ conexionPHP("validarExistencia.php","1=@banco","banco=@"+banco());}
function validar_nom_caja(){ conexionPHP("validarExistencia.php","1=@caja","nombre_caja=@"+nombre_caja());}
function validar_nom_promocion(){ conexionPHP("validarExistencia.php","1=@promocion","nombre_promo=@"+nombre_promo());}
function validar_nom_tipo_pago(){ conexionPHP("validarExistencia.php","1=@tipo_pago","tipo_pago=@"+tipo_pago());}
function validar_nom_detalle_orden(){ conexionPHP("validarExistencia.php","1=@detalle_orden","nombre_det_orden=@"+nombre_det_orden());}
function validar_nom_tipo_orden(){ conexionPHP("validarExistencia.php","1=@tipo_orden","nombre_tipo_orden=@"+nombre_tipo_orden());}
function validar_nom_tipo_servicio(){ conexionPHP("validarExistencia.php","2=@tipo_servicio","tipo_servicio=@"+tipo_servicio()+"=@id_franq=@"+id_franq());}

function validar_nom_franquicia(){ conexionPHP("validarExistencia.php","1=@franquicia","nombre_franq=@"+nombre_franq());}
function valida_nom_restado(){ conexionPHP("validarExistencia.php","2=@estado","nombre_esta=@"+nombre_esta()+"=@id_franq=@"+id_franq());}
function validar_nom_municipio(){ conexionPHP("validarExistencia.php","2=@vista_municipio","nombre_mun=@"+nombre_mun()+"=@id_esta=@"+id_esta());}
function validar_num_ciudad(){ conexionPHP("validarExistencia.php","2=@vista_ciudad","nombre_ciudad=@"+nombre_ciudad()+"=@id_mun=@"+id_mun());}
function validar_nom_zona(){ conexionPHP("validarExistencia.php","2=@zona","nombre_zona=@"+nombre_zona()+"=@id_ciudad=@"+id_ciudad());}
function validar_nom_sector(){ conexionPHP("validarExistencia.php","2=@sector","nombre_sector=@"+nombre_sector()+"=@id_zona=@"+id_zona());}
function validar_nom_calle(){ conexionPHP("validarExistencia.php","2=@calle","nombre_calle=@"+nombre_calle()+"=@id_sector=@"+id_sector());}
function validar_nom_urbanizacion(){ conexionPHP("validarExistencia.php","2=@urbanizacion","nombre_urb=@"+nombre_calle()+"=@id_sector=@"+id_sector());}
function validar_nom_edificio(){ conexionPHP("validarExistencia.php","2=@edificio","edificio=@"+edificio()+"=@id_sector=@"+id_sector());}

function validar_nom_servicios(){ conexionPHP("validarExistencia.php","2=@servicios","nombre_servicio=@"+nombre_servicio()+"=@id_tipo_servicio=@"+id_tipo_servicio());}

function validarmarca(){ conexionPHP("validarExistencia.php","1=@marca","id_marca=@"+id_marca());}
function validarmodelo(){ conexionPHP("validarExistencia.php","1=@modelo","id_modelo=@"+id_modelo());}
function valida_cablemodem_c(){ conexionPHP("validarExistencia.php","1=@cablemodem","codigo_cm=@"+codigo_cm());}


//permite cerrar la sesion en javascript inicializando las variables
function cerrarSesion(arg)
{
	
}
function callApplet() {
conexionPHP('reportes/factApplet1.php',"CA0000000003");
}
//permite validar que la cedula de una persona este regsitrada para poder ser usuario.
function validarEmp(){
	conexionPHP("validarExistencia.php","1=@persona","cedula=@"+document.f1.cedula.value,"esta Cedula no esta registrada");
}
//validar existencia de un usuario
function validarUsuario(){
	conexionPHP("validarExistencia.php","1=@usuario","login=@"+document.f1.login.value);
}
function validarUsuario1(){
	conexionPHP("validarExistencia.php","1=@persona","cedula=@"+cedula());
}
//valida existencia de un perfil
function validarCodigo(){
	conexionPHP("validarExistencia.php","1=@perfil","codigoperfil=@"+document.f1.codigo.value);
	//carga todos los modulos registrados
	conexionPHP("informacion.php","TraerModulo",document.f1.codigo.value);
}
//valida existencia de una persona
function validarPersona_mod(){
	conexionPHP("validarExistencia.php","1=@persona","cedula=@"+document.f1.cedulax.value);
	document.f1.cedulax.disabled=true;
}
function validarPersona(){
	conexionPHP("validarExistencia.php","1=@persona","cedula=@"+document.f1.cedula.value);
}
//valida existencia de un modulo
function validarModulo(){
	conexionPHP("validarExistencia.php","1=@modulo","codigomodulo=@"+document.f1.codigo.value);
	//carga todos los perfiles registrados
	conexionPHP("informacion.php","TraerModulo1",document.f1.codigo.value);
}

function buscarXcedula(){
	conexionPHP('validarExistencia.php','1=@vista_contrato',"cedula=@"+cedula());	
	conexionPHP("informacion.php","verifica_multiple_cont",document.f1.cedula.value);
}

function buscarXcedula_todo(){
	conexionPHP('validarExistencia.php','1=@vista_contrato_todo',"cedula=@"+cedula());
	conexionPHP("informacion.php","verifica_multiple_cont",document.f1.cedula.value);
}
function buscarXcedula_b(){
	conexionPHP('validarExistencia.php','1=@vista_contrato',"cedula=@"+document.f1.cedula_b.value);
	conexionPHP("informacion.php","verifica_multiple_cont",document.f1.cedula_b.value);
}
function validarestado(){ conexionPHP("validarExistencia.php","2=@estado","nombre_esta=@"+nombre_esta()+"=@id_franq=@"+id_franq());}
function validarmunicipio(){ conexionPHP("validarExistencia.php","1=@municipio","id_mun=@"+id_mun());}
function validarciudad(){ conexionPHP("validarExistencia.php","1=@ciudad","id_ciudad=@"+id_ciudad());}

//APLICATEM - para validar la existencia de los nuevos modulos
function validarcobrador(){ conexionPHP("validarExistencia.php","1=@vista_cobrador","cedula=@"+cedula());}
function validarcobrador1(){ conexionPHP("validarExistencia.php","1=@vista_cobrador","nro_cobrador=@"+nro_cobrador());}
function validarvendedor(){ conexionPHP("validarExistencia.php","1=@vista_vendedor","cedula=@"+cedula());}
function validarvendedor1(){ conexionPHP("validarExistencia.php","1=@vista_vendedor","nro_vendedor=@"+nro_vendedor());}
function validarcliente(){ conexionPHP("validarExistencia.php","1=@vista_cliente","cedula=@"+cedula());}
function validartecnico(){ conexionPHP("validarExistencia.php","1=@vista_tecnico","cedula=@"+cedula());}
function validartecnico1(){ conexionPHP("validarExistencia.php","1=@vista_tecnico","num_tecnico=@"+num_tecnico());}
function validartipo_orden(){ conexionPHP("validarExistencia.php","1=@tipo_orden","id_tipo_orden=@"+id_tipo_orden());}
function validardetalle_orden(){ conexionPHP("validarExistencia.php","1=@detalle_orden","id_det_orden=@"+id_det_orden());}
function validarordenes_tecnicos(){ conexionPHP("validarExistencia.php","1=@ordenes_tecnicos","id_orden=@"+id_orden());}
function validarfranquicia(){ conexionPHP("validarExistencia.php","1=@franquicia","id_franq=@"+id_franq());}
function validarparametros(){ conexionPHP("validarExistencia.php","1=@parametros","id_param=@"+id_param());}
function validarcalle(){ conexionPHP("validarExistencia.php","1=@vista_calle","id_calle=@"+id_calle());}
function validarsector(){ conexionPHP("validarExistencia.php","1=@vista_sector","nro_sector=@"+nro_sector());}
function validarzona(){ conexionPHP("validarExistencia.php","1=@zona","nro_zona=@"+nro_zona());}
function validarmateriales(){ conexionPHP("validarExistencia.php","1=@materiales","numero_mat=@"+numero_mat());}
function validarent_sal_mat(){ conexionPHP("validarExistencia.php","1=@vista_materiales","id_ent_sal=@"+id_ent_sal());}
function validarinventario(){ conexionPHP("validarExistencia.php","1=@inventario","id_inv=@"+id_inv());}
function validarinventario_materiale(){ conexionPHP("validarExistencia.php","1=@inventario_materiales","id_mat=@"+id_mat());}
function validartipo_servicio(){ conexionPHP("validarExistencia.php","1=@tipo_servicio","id_tipo_servicio=@"+id_tipo_servicio());}
function validarservicios(){ conexionPHP("validarExistencia.php","1=@servicios","id_serv=@"+id_serv());}
function validartarifa_servicio(){ conexionPHP("validarExistencia.php","1=@vista_tarifa","id_tar_ser=@"+id_tar_ser());}
function validarcontrato_servicio(){ conexionPHP("validarExistencia.php","1=@contrato_servicio","id_cont_serv=@"+id_cont_serv());}
function buscarxcontrato_fisico(){
	conexionPHP("validarExistencia.php","1=@vista_contrato","contrato_fisico=@"+document.f1.contrato_fis.value);
}
function buscarxcontrato_fisico_todo(){
	conexionPHP("validarExistencia.php","1=@vista_contrato_todo","contrato_fisico=@"+document.f1.contrato_fis.value);
}
function buscarxprecinto(){
	conexionPHP("validarExistencia.php","1=@vista_contrato","etiqueta=@"+document.f1.precinto_b.value);
}
function validarcontrato_todo(){
	var ncont=nro_contrato();
	for(var i=ncont.length;i<dig_cont_G;i++){
		ncont="0"+ncont;
	}
	if(serie_correl_G!='0' && serie_correl_G!=''){
		if(nro_contrato().length<=dig_cont_G){
			ncont=inicialG+ncont;
		}
	}

	document.f1.nro_contrato.value=ncont;
	conexionPHP("validarExistencia.php","1=@vista_contrato_todo","nro_contrato=@"+ncont);
}

function validarpago_servicio(){ conexionPHP("validarExistencia.php","1=@pago_servicio","cierre_pago=@"+cierre_pago());}
function validarpagos(){ conexionPHP("validarExistencia.php","1=@vista_tipopago","nro_factura=@"+nro_factura());}
function validarpagos_anular(){ conexionPHP("validarExistencia.php","1=@pagos","nro_factura=@"+nro_factura());}
function validarpagos_anular_id(){ conexionPHP("validarExistencia.php","1=@pagos","id_pago=@"+id_pago());}
function validarpagosfact(){ conexionPHP("validarExistencia.php","1=@pagos","nro_factura=@"+nro_factura());}
function validardetalle_tipopago(){ conexionPHP("validarExistencia.php","1=@detalle_tipopago","id_tipo_pago=@"+id_tipo_pago());}
function validartipo_pago(){ conexionPHP("validarExistencia.php","1=@tipo_pago","id_tipo_pago=@"+id_tipo_pago());}
function validarcirre_diario(){ conexionPHP("validarExistencia.php","1=@cirre_diario","id_cierre=@"+id_cierre());}
function validarcierre_pago(){ conexionPHP("validarExistencia.php","1=@cierre_pago","id_pago=@"+id_pago());}
function validarcaja(){ conexionPHP("validarExistencia.php","1=@caja","pago_comisiones=@"+pago_comisiones());}
function validarcaja_cobrador(){ 
	//conexionPHP("validarExistencia.php","1=@caja_cobrador","id_caja_cob=@"+id_caja_cob());
	if(claseGlobal=="cerrar_caja"){
		conexionPHP("informacion.php","montoCierrePunto",id_caja_cob());
		archivoDataGrid="reportes/Rep_detallecobros.php?&id_caja_cob="+id_caja_cob()+"&";
		updateTable();
	}
}

function validarreclamo_denuncia(){ conexionPHP("validarExistencia.php","1=@vista_reclamo","status_caja=@"+status_caja());}
function validarcomentario_cliente(){ conexionPHP("validarExistencia.php","1=@vista_comentario","nro_comen=@"+nro_comen());}
function validarpago_comisiones(){ conexionPHP("validarExistencia.php","1=@pago_comisiones","id_comi=@"+id_comi());}
function validarstatus_contrato(){ conexionPHP("validarExistencia.php","1=@status_contrato","status_contrato=@"+status_contrato());}
function validaredificio(){ conexionPHP("validarExistencia.php","1=@edificio","dato=@"+data());}
function validarbanco(){ conexionPHP("validarExistencia.php","1=@banco","dato=@"+data());}
function validargrupo_trabajo(){ conexionPHP("validarExistencia.php","1=@grupo_trabajo","dato=@"+data());}
function validargrupo_tecnico(){ conexionPHP("validarExistencia.php","1=@grupo_tecnico","id_gt=@"+id_gt());}
function validarorden_grupo(){ conexionPHP("validarExistencia.php","1=@orden_grupo","id_orden=@"+id_orden());}

function validargerentes_permitidos(){ conexionPHP("validarExistencia.php","1=@vista_gerentes","id_persona=@"+id_persona());}
function validarvariables_sms(){ conexionPHP("validarExistencia.php","1=@variables_sms","id_var=@"+id_var());}

function validarotros_datos(){ conexionPHP("validarExistencia.php","1=@otros_datos","dato=@"+data());}
function validarcontrato_ser(){ conexionPHP("validarExistencia.php","1=@contrato_ser","id_seg=@"+id_seg());}

function validarfamilia(){ conexionPHP("validarExistencia.php","1=@familia","dato=@"+data());}

function validargrupo_afinidad(){ conexionPHP("validarExistencia.php","1=@grupo_afinidad","id_g_a=@"+id_g_a());}
function validartipo_alarma(){ conexionPHP("validarExistencia.php","1=@tipo_alarma","id_tipo_alarma=@"+id_tipo_alarma());}
function validaralarma_perfil(){ conexionPHP("validarExistencia.php","1=@alarma_perfil","codigoperfil=@"+codigoperfil());}
function validaralarmas(){ conexionPHP("validarExistencia.php","1=@alarmas","id_alarma=@"+id_alarma());}
function validargrupo_ubicacion(){ conexionPHP("validarExistencia.php","1=@grupo_ubicacion","id_gt=@"+id_gt());}
function validarestacion_trabajo(){ conexionPHP("validarExistencia.php","1=@estacion_trabajo","id_est=@"+id_est());}
function validarprecintos(){ conexionPHP("validarExistencia.php","1=@precintos","id_prec=@"+id_prec());}
function validarcablemodem(){ conexionPHP("validarExistencia.php","1=@cablemodem","id_cm=@"+id_cm());}
function validardeco_ana(){ conexionPHP("validarExistencia.php","1=@deco_ana","id_da=@"+id_da());}


function validarpromocion(){ conexionPHP("validarExistencia.php","1=@promocion","id_promo=@"+id_promo());}
function validarpromo_serv(){ conexionPHP("validarExistencia.php","1=@promo_serv","id_serv=@"+id_serv());}
function validarpromo_contrato(){ conexionPHP("validarExistencia.php","1=@promo_contrato","id_promo_con=@"+id_promo_con());}
function validarconvenio_pago(){ conexionPHP("validarExistencia.php","1=@convenio_pago","id_conv=@"+id_conv());}
function validarconv_con(){ conexionPHP("validarExistencia.php","1=@conv_con","id_conv_cont=@"+id_conv_cont());}

function validarasigna_recibo(){ conexionPHP("validarExistencia.php","1=@asigna_recibo","id_asig=@"+id_asig());}
function validarrecibos(){ conexionPHP("validarExistencia.php","1=@recibos","nro_recibo=@"+nro_recibo());}
function validarrecibe_recibo(){ conexionPHP("validarExistencia.php","1=@recibe_recibo","id_rec=@"+id_rec());}

function validarpagodeposito(){ conexionPHP("validarExistencia.php","1=@pagodeposito","id_pd=@"+id_pd());}

function validarservidor(){ conexionPHP("validarExistencia.php","1=@servidor","id_servidor=@"+id_servidor());}
function validarinicial_id(){ conexionPHP("validarExistencia.php","1=@inicial_id","id_inicial_id=@"+id_inicial_id());}
function validarsincronizacion_servi(){ conexionPHP("validarExistencia.php","1=@sincronizacion_servi","id_sinc=@"+id_sinc());}


function validardescuento_pronto_pag(){ conexionPHP("validarExistencia.php","1=@descuento_pronto_pag","id_dpp=@"+id_dpp());}
function validarorden_tabla_cortes(){ conexionPHP("validarExistencia.php","1=@orden_tabla_cortes","id_tc=@"+id_tc());}
function validartabla_cortes(){ conexionPHP("validarExistencia.php","1=@tabla_cortes","id_tc=@"+id_tc());}
function validarcuenta_bancos(){ conexionPHP("validarExistencia.php","1=@cuenta_bancos","id_cb=@"+id_cb());}
function validarconciliacion_pago(){ conexionPHP("validarExistencia.php","1=@conciliacion_pago","id_conc=@"+id_conc());}

function validarasigna_llamada(){ conexionPHP("validarExistencia.php","1=@asigna_llamada","id_all=@"+id_all());}
function validarasig_lla_cli(){ conexionPHP("validarExistencia.php","1=@asig_lla_cli","id_lc=@"+id_lc());}
function validartipo_llamada(){ conexionPHP("validarExistencia.php","1=@tipo_llamada","id_tll=@"+id_tll());}
function validarllamadas(){ conexionPHP("validarExistencia.php","1=@llamadas","id_lla=@"+id_lla());}
function validardetalle_resp(){ conexionPHP("validarExistencia.php","1=@detalle_resp","id_drl=@"+id_drl());}
function validartipo_resp(){ conexionPHP("validarExistencia.php","1=@tipo_resp","id_trl=@"+id_trl());}


function validarorden_tabla_cortes(){ conexionPHP("validarExistencia.php","1=@orden_tabla_cortes","id_tc=@"+id_tc());}
function validartabla_cortes(){ conexionPHP("validarExistencia.php","1=@tabla_cortes","id_tc=@"+id_tc());}
function validarcuenta_bancos(){ conexionPHP("validarExistencia.php","1=@cuenta_bancos","id_cb=@"+id_cb());}
function validarconciliacion_pago(){ conexionPHP("validarExistencia.php","1=@conciliacion_pago","id_conc=@"+id_conc());}

function validardetalle_tipopago_df(){ conexionPHP("validarExistencia.php","1=@detalle_tipopago_df","id_dbf=@"+id_dbf());}
function validarcarga_tabla_banco(){ conexionPHP("validarExistencia.php","1=@carga_tabla_banco","id_ctb=@"+id_ctb());}
function validartabla_bancos(){ conexionPHP("validarExistencia.php","1=@tabla_bancos","id_tb=@"+id_tb());}
function validartipo_pago_df(){ conexionPHP("validarExistencia.php","1=@tipo_pago_df","id_tipo_pago=@"+id_tipo_pago());}


function validarDato(){ conexionPHP("validarExistencia.php","1=@Dato","dato=@"+dato());}

//funciones para obtener los valores de un formulario
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
function nombre_det_orden(){return document.f1.nombre_det_orden.value;}
function id_orden(){return document.f1.id_orden.value;}
function fecha_orden(){return document.f1.fecha_orden.value;}
function fecha_imp(){return document.f1.fecha_imp.value;}
function ordenes(){return document.f1.orden.value;}
function comentario_orden(){return document.f1.comentario_orden.value;}
function status_orden(){return document.f1.status_orden.value;}
function detalle_orden(){return document.f1.detalle_orden.value;}
function id_franq(){return document.f1.id_franq.value;}
function nombre_franq(){return document.f1.nombre_franq.value;}
function estado_franq(){return document.f1.estado_franq.value;}
function ciudad_franq(){return document.f1.ciudad_franq.value;}
function municipio_franq(){return document.f1.municipio_franq.value;}
function direccion_franq(){return document.f1.direccion_franq.value;}
function id_param(){return document.f1.id_param.value;}
function fecha_param(){return document.f1.fecha_param.value;}
function parametro(){return document.f1.parametro.value;}
function obser_param(){return document.f1.obser_param.value;}
function valor_param(){return document.f1.valor_param.value;}
function id_calle(){return document.f1.id_calle.value;}
function nro_calle(){return document.f1.nro_calle.value;}
function id_sector(){return document.f1.id_sector.value;}
function nombre_calle(){return document.f1.nombre_calle.value;}
function nro_sector(){return document.f1.nro_sector.value;}
function id_zona(){return document.f1.id_zona.value;}
function nombre_sector(){return document.f1.nombre_sector.value;}
function nro_zona(){return document.f1.nro_zona.value;}
function nombre_zona(){return document.f1.nombre_zona.value;}
function id_mat(){return document.f1.id_mat.value;}
function numero_mat(){return document.f1.numero_mat.value;}
function nombre_mat(){return document.f1.nombre_mat.value;}
function unidad_mat(){return document.f1.unidad_mat.value;}
function abrevia_unidad(){return document.f1.abrevia_unidad.value;}
function cant_existencia(){return document.f1.cant_existencia.value;}
function precio(){return document.f1.precio.value;}
function observacion(){return document.f1.observacion.value;}
function tipo_ent_sal(){return document.f1.tipo_ent_sal.value;}
function fecha_ent_sal(){return document.f1.fecha_ent_sal.value;}
function hora_ent_sal(){return document.f1.hora_ent_sal.value;}
function cant_ent_sal(){return document.f1.cant_ent_sal.value;}
function precio_compra(){return document.f1.precio_compra.value;}
function id_inv(){return document.f1.id_inv.value;}
function fecha_inv(){return document.f1.fecha_inv.value;}
function hora_inv(){return document.f1.hora_inv.value;}
function obser_inv(){return document.f1.obser_inv.value;}
function cantidad(){return document.f1.cantidad.value;}
function id_ent_sal(){return document.f1.id_ent_sal.value;}
function id_tipo_servicio(){return document.f1.id_tipo_servicio.value;}
function tipo_servicio(){return document.f1.tipo_servicio.value;}
function id_serv(){return document.f1.id_serv.value;}
function nombre_servicio(){return document.f1.nombre_servicio.value;}
function id_tar_ser(){return document.f1.id_tar_ser.value;}
function fecha_tar_ser(){return document.f1.fecha_tar_ser.value;}
function hora_tar_ser(){return document.f1.hora_tar_ser.value;}
function obser_tarifa_ser(){return document.f1.obser_tarifa_ser.value;}
function id_cont_serv(){return document.f1.id_cont_serv.value;}
function id_contrato(){return document.f1.id_contrato.value;}
function fecha_inst(){return document.f1.fecha_inst.value;}
function cant_serv(){return document.f1.cant_serv.value;}
function cli_id_persona(){return document.f1.cli_id_persona.value;}
function nro_contrato(){return document.f1.nro_contrato.value;}
function fecha_contrato(){return document.f1.fecha_contrato.value;}
function hora_contrato(){return document.f1.hora_contrato.value;}
function etiqueta(){return document.f1.etiqueta.value;}
function costo_contrato(){return document.f1.costo_contrato.value;}
function costo_dif_men(){return document.f1.costo_dif_men.value;}
function status_pago(){return document.f1.status_pago.value;}
function tarifa_ser(){return document.f1.tarifa_ser.value;}
function id_pago(){return document.f1.id_pago.value;}
function fecha_pago(){return document.f1.fecha_pago.value;}
function hora_pago(){return document.f1.hora_pago.value;}
function monto_pago(){return document.f1.monto_pago.value;}
function obser_pago(){return document.f1.obser_pago.value;}
function id_tipo_pago(){return document.f1.id_tipo_pago.value;}
function banco(){return document.f1.banco.value;}
function tipo_banco(){return document.f1.tipo_banco.value;}
function numero_cuenta(){return document.f1.numero.value;}
function obser_detalle(){return document.f1.obser_detalle.value;}
function id_cierre(){return document.f1.id_cierre.value;}
function fecha_cierre(){return document.f1.fecha_cierre.value;}
function hora_cierre(){return document.f1.hora_cierre.value;}
function monto_total(){return document.f1.monto_total.value;}
function obser_cierre(){return document.f1.obser_cierre.value;}
function tipo_pago(){return document.f1.tipo_pago.value;}
function nro_factura(){return document.f1.nro_factura.value;}
function nombre_caja(){return document.f1.nombre_caja.value;}
function descripcion_caja(){return document.f1.descripcion_caja.value;}
function id_caja_cob(){return document.f1.id_caja_cob.value;}
function id_caja(){return document.f1.id_caja.value;}
function fecha_caja(){return document.f1.fecha_caja.value;}
function apertura_caja(){return document.f1.apertura_caja.value;}
function cierre_caja(){return document.f1.cierre_caja.value;}
function monto_acum(){return document.f1.monto_acum.value;}
function status_caja(){return document.f1.status_caja.value;}
function nro_rec(){return document.f1.nro_rec.value;}
function fecha_rec(){return document.f1.fecha_rec.value;}
function hora_rec(){return document.f1.hora_rec.value;}
function motivo_rec(){return document.f1.motivo_rec.value;}
function descrip_rec(){return document.f1.descrip_rec.value;}
function denunciado(){return document.f1.denunciado.value;}
function id_rec(){return document.f1.id_rec.value;}
function status_rec(){return document.f1.status_rec.value;}
function id_comen(){return document.f1.id_comen.value;}
function nro_comen(){return document.f1.nro_comen.value;}
function fecha_comen(){return document.f1.fecha_comen.value;}
function hora_comen(){return document.f1.hora_comen.value;}
function comentario(){return document.f1.comentario.value;}
function id_comi(){return document.f1.id_comi.value;}
function fecha_comi(){return document.f1.fecha_comi.value;}
function fecha_desde(){return document.f1.fecha_desde.value;}
function fecha_final(){return document.f1.fecha_final.value;}
function fecha_hasta(){return document.f1.fecha_hasta.value;}
function porcent_aplic(){return document.f1.porcent_aplic.value;}
function monto_comi(){return document.f1.monto_comi.value;}
function status_comi(){return document.f1.status_comi.value;}
function tipo_detalle(){return document.f1.tipo_detalle.value;}
function tipo_costo(){return document.f1.tipo_costo.value;}
function prioridad(){return document.f1.prioridad.value;}
function nombre_status(){return document.f1.nombre_status.value;}
function fecha_status(){return document.f1.fecha_status.value;}
function hora_status(){return document.f1.hora_status.value;}
function status_con(){return document.f1.status_con.value;}

function edificio(){return document.f1.edificio.value;}
function numero_piso(){return document.f1.numero_piso.value;}
function total_reg_data(){return document.f1.total_reg_data.value;}
function id_edif(){return document.f1.id_edif.value;}
function id_banco(){return document.f1.id_banco.value;}
function id_gt(){return document.f1.id_gt.value;}
function fecha_creacion(){return document.f1.fecha_creacion.value;}
function hora_creacion(){return document.f1.hora_creacion.value;}

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
function marca(){return document.f1.marca.value;}
function modelo(){return document.f1.modelo.value;}
function resp_correo(){return document.f1.resp_correo.value;}

function tipo_cliente(){return document.f1.tipo_cliente.value;}
function inicial_doc(){return document.f1.inicial_doc.value;}
function fecha_nac(){return document.f1.fecha_nac.value;}
function empresa(){return document.f1.empresa.value;}

function idstatus(){return document.f1.idstatus.value;}
function nombrestatus(){return document.f1.nombrestatus.value;}
function idmotivonota(){return document.f1.idmotivonota.value;}
function nombremotivonota(){return document.f1.nombremotivonota.value;}

function postel(){return document.f1.postel.value;}
function taps(){return document.f1.taps.value;}
function pto(){return document.f1.pto.value;}
function tipo(){return document.f1.tipo.value;}

function id_seg(){return document.f1.id_seg.value;}
function firma_seg(){return document.f1.firma_seg.value;}
function llave_enc(){return document.f1.llave_enc.value;}
function llave_dec(){return document.f1.llave_dec.value;}
function licencia_seg(){return document.f1.licencia_seg.value;}
function limite_reg(){return document.f1.limite_reg.value;}
function fecha_lic(){return document.f1.fecha_lic.value;}
function hora_lic(){return document.f1.hora_lic.value;}
function empresa_aut(){return document.f1.empresa_aut.value;}
function version_sis(){return document.f1.version_sis.value;}
function acerca_de(){return document.f1.acerca_de.value;}
function status_seg(){return document.f1.status_seg.value;}
function campo_seg1(){return document.f1.campo_seg1.value;}
function campo_seg2(){return document.f1.campo_seg2.value;}
function campo_seg3(){return document.f1.campo_seg3.value;}
function campo_seg4(){return document.f1.campo_seg4.value;}
function campo_seg5(){return document.f1.campo_seg5.value;}
function campo_seg6(){return document.f1.campo_seg6.value;}
function campo_seg7(){return document.f1.campo_seg7.value;}
function afiliacion(){return document.f1.afiliacion.value;}


function tipo_paq(){return document.f1.tipo_paq.value;}
function obser_serv(){return document.f1.obser_serv.value;}


function id_g_a(){return document.f1.id_g_a.value;}
function nombre_g_a(){return document.f1.nombre_g_a.value;}
function id_tipo_alarma(){return document.f1.id_tipo_alarma.value;}
function nombre_alarma(){return document.f1.nombre_alarma.value;}
function id_alarma(){return document.f1.id_alarma.value;}
function detalle_alarma(){return document.f1.detalle_alarma.value;}
function fecha_alarma(){return document.f1.fecha_alarma.value;}
function ref_alarma(){return document.f1.ref_alarma.value;}
function status_alarma(){return document.f1.status_alarma.value;}
function id_est(){return document.f1.id_est.value;}
function nombre_est(){return document.f1.nombre_est.value;}
function ip_est(){return document.f1.ip_est.value;}
function mac_est(){return document.f1.mac_est.value;}
function nom_comp(){return document.f1.nom_comp.value;}
function id_prec(){return document.f1.id_prec.value;}
function nombre_prec(){return document.f1.nombre_prec.value;}
function fecha_ing_prec(){return document.f1.fecha_ing_prec.value;}
function fecha_mod_prec(){return document.f1.fecha_mod_prec.value;}

//function id_franq(){return document.f1.id_franq.value;}
function id_esta(){return document.f1.id_esta.value;}
function nombre_esta(){return document.f1.nombre_esta.value;}
function id_mun(){return document.f1.id_mun.value;}
function nombre_mun(){return document.f1.nombre_mun.value;}
function id_ciudad(){return document.f1.id_ciudad.value;}
function nombre_ciudad(){return document.f1.nombre_ciudad.value;}


function urbanizacion(){return document.f1.urbanizacion.value;}
function id_cm(){return document.f1.id_cm.value;}
function codigo_cm(){return document.f1.codigo_cm.value;}
function marca_cm(){return document.f1.marca_cm.value;}
function modelo_cm(){return document.f1.modelo_cm.value;}
function prov_cm(){return document.f1.prov_cm.value;}
function status_cm(){return document.f1.status_cm.value;}
function fecha_act_cm(){return document.f1.fecha_act_cm.value;}
function obser_cm(){return document.f1.obser_cm.value;}
function nota1(){return document.f1.nota1.value;}
function nota2(){return document.f1.nota2.value;}
function nota3(){return document.f1.nota3.value;}
function id_da(){return document.f1.id_da.value;}
function codigo_da(){return document.f1.codigo_da.value;}
function marca_da(){return document.f1.marca_da.value;}
function modelo_da(){return document.f1.modelo_da.value;}
function prov_da(){return document.f1.prov_da.value;}
function tipo_da(){return document.f1.tipo_da.value;}
function chanmap_da(){return document.f1.chanmap_da.value;}
function punto_da(){return document.f1.punto_da.value;}
function status_da(){return document.f1.status_da.value;}
function fecha_act_da(){return document.f1.fecha_act_da.value;}
function obser_da(){return document.f1.obser_da.value;}
function servicio(){return document.f1.servicio.value;}


function id_marca(){return document.f1.id_marca.value;}
function nombre_marca(){return document.f1.nombre_marca.value;}
function id_modelo(){return document.f1.id_modelo.value;}
function nombre_modelo(){return document.f1.nombre_modelo.value;}
function id_tse(){return document.f1.id_tse.value;}
function id_cont_serv(){return document.f1.id_cont_serv.value;}
function id_da(){return document.f1.id_da.value;}
function id_accquery(){return document.f1.id_accquery.value;}
function serial_deco(){return document.f1.serial_deco.value;}
function comando_acc(){return document.f1.comando_acc.value;}
function fecha_accquery(){return document.f1.fecha_accquery.value;}


function id_promo(){return document.f1.id_promo.value;}
function nombre_promo(){return document.f1.nombre_promo.value;}
function fecha_promo(){return document.f1.fecha_promo.value;}
function inicio_promo(){return document.f1.inicio_promo.value;}
function fin_promo(){return document.f1.fin_promo.value;}
function mes_promo(){return document.f1.mes_promo.value;}
function tipo_promo(){return document.f1.tipo_promo.value;}
function descuento_promo(){return document.f1.descuento_promo.value;}
function login(){return document.f1.login.value;}
function id_serv(){return document.f1.id_serv.value;}
function id_promo_con(){return document.f1.id_promo_con.value;}
function id_contrato(){return document.f1.id_contrato.value;}
function status_promo_con(){return document.f1.status_promo_con.value;}
function id_conv(){return document.f1.id_conv.value;}
function fecha_conv(){return document.f1.fecha_conv.value;}
function obser_conv(){return document.f1.obser_conv.value;}
function status_conv(){return document.f1.status_conv.value;}
function id_conv_cont(){return document.f1.id_conv_cont.value;}
function fecha_ven(){return document.f1.fecha_ven.value;}


function id_asig(){return document.f1.id_asig.value;}
function id_cobrador(){return document.f1.id_cobrador.value;}
function fecha_asig(){return document.f1.fecha_asig.value;}
function obser_asig(){return document.f1.obser_asig.value;}
function login_asig(){return document.f1.login_asig.value;}
function nro_recibo(){return document.f1.nro_recibo.value;}
function id_rec(){return document.f1.id_rec.value;}
function status_pago(){return document.f1.status_pago.value;}
function fecha_rec(){return document.f1.fecha_rec.value;}
function obser_rec(){return document.f1.obser_rec.value;}
function login_rec(){return document.f1.login_rec.value;}
function desde(){return document.f1.desde.value;}
function hasta(){return document.f1.hasta.value;}


function nro_control(){return document.f1.nro_control.value;}
function contrato_fisico(){return document.f1.contrato_fisico.value;}
function etiqueta_n(){return document.f1.etiqueta_n.value;}


function id_pd(){return document.f1.id_pd.value;}
function fecha_reg(){return document.f1.fecha_reg.value;}
function hora_reg(){return document.f1.hora_reg.value;}
function login_reg(){return document.f1.login_reg.value;}
function fecha_dep(){return document.f1.fecha_dep.value;}
function numero_ref(){return document.f1.numero_ref.value;}
function fecha_conf(){return document.f1.fecha_conf.value;}
function hora_conf(){return document.f1.hora_conf.value;}
function login_conf(){return document.f1.login_conf.value;}
function status_pd(){return document.f1.status_pd.value;}
function fecha_proc(){return document.f1.fecha_proc.value;}

function login_proc(){return document.f1.login_proc.value;}
function monto_dep(){return document.f1.monto_dep.value;}
function cedula_titular(){return document.f1.cedula_titular.value;}


function pago_comisones(){return document.f1.pago_comisones.value;}
function id_franq(){return document.f1.id_franq.value;}
function fecha_confc(){return document.f1.fecha_confc.value;}
function status_confc(){return document.f1.status_confc.value;}
function porc_acord(){return document.f1.porc_acord.value;}
function porc_com_reca(){return document.f1.porc_com_reca.value;}
function porc_com_venta(){return document.f1.porc_com_venta.value;}
function porc_ret_iva(){return document.f1.porc_ret_iva.value;}
function porc_ret_islr(){return document.f1.porc_ret_islr.value;}
function descuento_conf(){return document.f1.descuento_conf.value;}
function empresa_confc(){return document.f1.empresa_confc.value;}
function rif_empresa(){return document.f1.rif_empresa.value;}
function represen_confc(){return document.f1.represen_confc.value;}
function cedula_rep(){return document.f1.cedula_rep.value;}
function desc_confc(){return document.f1.desc_confc.value;}
function pago_comisones(){return document.f1.pago_comisones.value;}
function id_pago_com(){return document.f1.id_pago_com.value;}
function id_confc(){return document.f1.id_confc.value;}
function nro_comprob(){return document.f1.nro_comprob.value;}
function fecha_pc(){return document.f1.fecha_pc.value;}
function p_desde(){return document.f1.p_desde.value;}
function p_hasta(){return document.f1.p_hasta.value;}
function total_cob_sis(){return document.f1.total_cob_sis.value;}
function por_comision(){return document.f1.por_comision.value;}
function monto_comision(){return document.f1.monto_comision.value;}
function monto_ret_iva(){return document.f1.monto_ret_iva.value;}
function monto_ret_islr(){return document.f1.monto_ret_islr.value;}
function total_reintegro(){return document.f1.total_reintegro.value;}
function monto_desc(){return document.f1.monto_desc.value;}
function total_deposito(){return document.f1.total_deposito.value;}
function realizado_por(){return document.f1.realizado_por.value;}
function registrado_por(){return document.f1.registrado_por.value;}
function pagado_por(){return document.f1.pagado_por.value;}
function status_pago_com(){return document.f1.status_pago_com.value;}

function id_servidor(){return document.f1.id_servidor.value;}
function nombre_servidor(){return document.f1.nombre_servidor.value;}
function direc_servidor(){return document.f1.direc_servidor.value;}
function direccio_ip(){return document.f1.direccio_ip.value;}
function usuario_p(){return document.f1.usuario_p.value;}
function clave_p(){return document.f1.clave_p.value;}
function id_inicial_id(){return document.f1.id_inicial_id.value;}
function inicial(){return document.f1.inicial.value;}
function status(){return document.f1.status.value;}
function id_sinc(){return document.f1.id_sinc.value;}
function fecha_sinc(){return document.f1.fecha_sinc.value;}
function hora_sin(){return document.f1.hora_sin.value;}
function oid_inicial(){return document.f1.oid_inicial.value;}
function oid_final(){return document.f1.oid_final.value;}
function status_sinc(){return document.f1.status_sinc.value;}

function tipo_serv(){return document.f1.tipo_serv.value;}

function id_dpp(){return document.f1.id_dpp.value;}
function dia_dpp(){return document.f1.dia_dpp.value;}
function monto_dpp(){return document.f1.monto_dpp.value;}
function id_serv_dpp(){
	var cadena="",i=0;
	for(i=0;i<document.f1.id_serv_dpp.length;i++){
		if(document.f1.id_serv_dpp[i].checked == true)
			cadena=cadena+document.f1.id_serv_dpp[i].value+";";
	}
	return cadena;
}
function obser_dpp(){return document.f1.obser_dpp.value;}
function id_tc(){return document.f1.id_tc.value;}
function id_orden(){return document.f1.id_orden.value;}
function fecha_tc(){return document.f1.fecha_tc.value;}
function id_gt(){return document.f1.id_gt.value;}
function obser_tc(){return document.f1.obser_tc.value;}
function id_cb(){return document.f1.id_cb.value;}
function banco(){return document.f1.banco.value;}
function fecha_cb(){return document.f1.fecha_cb.value;}
function descrip_db(){return document.f1.descrip_db.value;}
function tipo_cb(){return document.f1.tipo_cb.value;}
function relacion_cb(){return document.f1.relacion_cb.value;}
function login_conf(){return document.f1.login_conf.value;}
function fecha_reg(){return document.f1.fecha_reg.value;}
function id_conc(){return document.f1.id_conc.value;}
function fecha_conc(){return document.f1.fecha_conc.value;}
function refer_conc(){return document.f1.refer_conc.value;}
function monto_conc(){return document.f1.monto_conc.value;}
function status_conc(){return document.f1.status_conc.value;}
function login_conc(){return document.f1.login_conc.value;}
function obser_conc(){return document.f1.obser_conc.value;}

function tipo_db(){return document.f1.tipo_db.value;}
function referencia_db(){return document.f1.referencia_db.value;}
function monto_db(){return document.f1.monto_db.value;}
function obser_db(){return document.f1.obser_db.value;}
function status_db(){return document.f1.status_db.value;}


function id_all(){return document.f1.id_all.value;}
function ubica_all(){return document.f1.ubica_all.value;}
function fecha_all(){return document.f1.fecha_all.value;}
function login_enc(){return document.f1.login_enc.value;}
function login_resp(){return document.f1.login_resp.value;}
function obser_all(){return document.f1.obser_all.value;}
function status_all(){return document.f1.status_all.value;}
function id_lc(){return document.f1.id_lc.value;}
function id_contrato(){return document.f1.id_contrato.value;}
function id_lla(){return document.f1.id_lla.value;}
function status_lc(){return document.f1.status_lc.value;}
function id_tll(){return document.f1.id_tll.value;}
function nombre_tll(){return document.f1.nombre_tll.value;}
function id_drl(){return document.f1.id_drl.value;}
function fecha_lla(){return document.f1.fecha_lla.value;}
function hora_lla(){return document.f1.hora_lla.value;}
function login(){return document.f1.login.value;}
function obser_lla(){return document.f1.obser_lla.value;}
function id_trl(){return document.f1.id_trl.value;}
function nombre_drl(){return document.f1.nombre_drl.value;}
function nombre_trl(){return document.f1.nombre_trl.value;}

function id_paq(){return document.f1.id_paq.value;}
function id_cant(){return document.f1.id_cant.value;}


function id_cuba(){return document.f1.id_cuba.value;}
function numero_cuba(){return document.f1.numero_cuba.value;}
function banco_cuba(){return document.f1.banco_cuba.value;}
function abrev_cuba(){return document.f1.abrev_cuba.value;}
function desc_cuba(){return document.f1.desc_cuba.value;}

function id_dbf(){return document.f1.id_dbf.value;}
function id_tipo_pago(){return document.f1.id_tipo_pago.value;}
function id_cuba(){return document.f1.id_cuba.value;}
function id_df_tp(){return document.f1.id_df_tp.value;}
function fecha_dbf(){return document.f1.fecha_dbf.value;}
function refer_dbf(){return document.f1.refer_dbf.value;}
function monto_dbf(){return document.f1.monto_dbf.value;}
function obser_dbf(){return document.f1.obser_dbf.value;}
function status_dbf(){return document.f1.status_dbf.value;}
function hora_dbf(){return document.f1.hora_dbf.value;}
function login_dbf(){return document.f1.login_dbf.value;}
function id_ctb(){return document.f1.id_ctb.value;}
function fecha_ctb(){return document.f1.fecha_ctb.value;}
function hora_ctb(){return document.f1.hora_ctb.value;}
function login_ctb(){return document.f1.login_ctb.value;}
function fecha_desde_ctb(){return document.f1.fecha_desde_ctb.value;}
function fecha_hasta_ctb(){return document.f1.fecha_hasta_ctb.value;}
function status_ctb(){return document.f1.status_ctb.value;}
function id_tb(){return document.f1.id_tb.value;}
function fecha_tb(){return document.f1.fecha_tb.value;}
function tipo_tb(){return document.f1.tipo_tb.value;}
function referencia_tb(){return document.f1.referencia_tb.value;}
function monto_tb(){return document.f1.monto_tb.value;}
function descrip_tb(){return document.f1.descrip_tb.value;}
function status_tb(){return document.f1.status_tb.value;}
function tipo_tp(){return document.f1.tipo_tp.value;}
function tipo_pago(){return document.f1.tipo_pago.value;}
function formato_archivo(){return document.f1.formato_archivo.value;}



function data(){return document.f1.dato.value;}
//es llamada cuando se desea incluir, modificar o eliminar datos de una tabla.
//tipoDato: representa la operacion que desea hacer; incluir, modificar o eliminar
//clase: a que  clase o tabla  desea hacer la operacion
function verificar(tipoDato,clase)
{
	//alerta('hello como esss');
//	alerta('nuevo mensaje');
  switch(clase)
  {
	//clase o tabla usuario
	case "Usuario":
		//antes de hacer la peticion valida los campos si es cedula, tipo seleccion o lista, alfanumericos, password
	  if(validaCampo(document.f1.id_persona,isAlphanumeric) && validaCampo(document.f1.cedula,isCedula) && validaCampo(document.f1.nombre,isName) && validaCampo(document.f1.apellido,isName) && validaCampo(document.f1.telefono,isPhoneNumber) && 
		validaCampo(document.f1.codigoperfil,isSelect) && 
		validaCampo(document.f1.login,isAlphanumeric) && 
		validaCampo(document.f1.password,isPassword)){
			if(document.f1.password.value!=document.f1.otropassword.value){
				alerta("Las Contrasenas no coinciden!");
				document.f1.password.focus(); return; 
			}
			else{
				tipoMat="incluir";
				if(existeMat==true){
					tipoMat="modificar";
				}
			
				confirmacion(tipoMat,"persona",id_persona()+"=@"+cedula()+"=@"+nombre()+"=@"+apellido()+"=@"+telefono()+"-Class-"+tipoDato+"=@Usuario=@"+usuario()+"=@"+password()+"=@"+verStatus()+"=@"+codigoperfil()+"=@"+id_persona()+"=@"+id_franq()+"=@"+id_servidor());
			 }
		}
		break;
	case "cambiarCont":
		//antes de hacer la peticion valida los campos si es cedula, tipo seleccion o lista, alfanumericos, password
	  if(validaCampo(document.f1.login,isAlphanumeric)){
			if(document.f1.password1.value!=document.f1.otropassword.value){
				alerta("La nueva contraseña no coincide con la de confirmacion!");
				document.f1.password1.focus(); return; 
			}
			else{
				confirmacion(tipoDato,"Usuario",usuario()+"=@"+password()+"=@"+document.f1.password1.value+"=@=@");
			 }
		}
		break;
	case "Perfil":
	  if(validaCampo(document.f1.codigo,isAlphanumeric) &&
		validaCampo(document.f1.descripcion,isTexto) &&
		validaCampo(document.f1.nombre,isName)){
			if(confirm('Seguro que desea enviar este formulario?')){
				
				var cad='';
				cad=cad+"-Class-eliminarPerfil=@modulo_perfil=@"+codigo()+"=@=@=@=@";
				if(tipoDato!="eliminar"){ 
					cad=cad+cambiarModulo("incluir",clase); 
				}
				
				//conexionPHP("administrar.php","modulo_perfil",codigo()+"=@=@=@=@","eliminarPerfil");
				conexionPHP("administrar.php",clase,codigo()+"=@"+nombre()+"=@"+descripcion()+"=@"+verStatus()+cad,tipoDato);
			}
		}
		break;
	case "persona":
		
		if(validaCampo(document.f1.id_persona,isAlphanumeric) && validaCampo(document.f1.cedula,isCedula) && validaCampo(document.f1.nombre,isName) && validaCampo(document.f1.apellido,isName) && validaCampo(document.f1.telefono,isPhoneNumber))
		{
			if(confirmacion(tipoDato,clase,id_persona()+"=@"+cedula()+"=@"+nombre()+"=@"+apellido()+"=@"+telefono()))
				document.f1.reset();
		}
		break;
	case "cobrador":
		if(validaCampo(document.f1.id_persona,isAlphanumeric) && validaCampo(document.f1.cedula,isCedula) && validaCampo(document.f1.nombre,isName) && validaCampo(document.f1.apellido,isName) && validaCampo(document.f1.telefono,isPhoneNumber) && validaCampo(document.f1.nro_cobrador,isInteger) && validaCampo(document.f1.direccion_cob,isTexto) && validaCampo(document.f1.dato,isTexto) && validaCampo(document.f1.id_franq,isSelect))
		{
			if(confirmacion(tipoDato,clase,id_persona()+"=@"+cedula()+"=@"+nombre()+"=@"+apellido()+"=@"+telefono()+"=@"+nro_cobrador()+"=@"+direccion_cob()+"=@"+data()+"=@"+id_franq()))
				document.f1.reset();
		}
		break;
	case "vendedor":
		if(validaCampo(document.f1.id_persona,isAlphanumeric) && validaCampo(document.f1.cedula,isCedula) && validaCampo(document.f1.nombre,isName) && validaCampo(document.f1.apellido,isName) && validaCampo(document.f1.telefono,isPhoneNumber) && validaCampo(document.f1.nro_vendedor,isInteger) && validaCampo(document.f1.direccion_ven,isTexto) && validaCampo(document.f1.dato,isTexto) && validaCampo(document.f1.id_franq,isSelect))
		{
			if(confirmacion(tipoDato,clase,id_persona()+"=@"+cedula()+"=@"+nombre()+"=@"+apellido()+"=@"+telefono()+"=@"+nro_vendedor()+"=@"+direccion_ven()+"=@"+data()+"=@"+id_franq()))
				document.f1.reset();
		}
		break;
	case "cliente":
		if(validaCampo(document.f1.id_persona,isAlphanumeric) && validaCampo(document.f1.cedula,isCedula) && validaCampo(document.f1.nombre,isName) && validaCampo(document.f1.apellido,isName) && validaCampo(document.f1.telefono,isPhoneNumber) && validaCampo(document.f1.telf_casa,isPhoneNumber,true)  && validaCampo(document.f1.email,isEmail) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_persona()+"=@"+cedula()+"=@"+nombre()+"=@"+apellido()+"=@"+telefono()+"=@"+telf_casa()+"=@"+email()+"=@"+telf_adic()+"=@=@"+data()))
				document.f1.reset();
		}
		break;
	case "contrato":
		if(parseInt(document.f1.cont_serv.value)>0){
			if(validaCampo(document.f1.id_contrato,isAlphanumeric) && valida_tipo_cliente() && validaCampo(document.f1.telefono,isPhoneNumber,true) && validaCampo(document.f1.telf_casa,isPhoneNumber,true)  && validaCampo(document.f1.email,isEmail,true)  && validaCampo(document.f1.dato,isTexto) && validaCampo(document.f1.id_calle,isSelect) && validaCampo(document.f1.id_g_a,isSelect) && validaCampo(document.f1.id_persona,isSelect) && validaCampo(document.f1.cod_id_persona,isSelect) && validaCampo(document.f1.cli_id_persona,isAlphanumeric) && validaCampo(document.f1.nro_contrato,isAlphanumeric) && valdate(fecha_contrato()) && validaCampo(document.f1.hora_contrato,isTexto) && validaCampo(document.f1.direc_adicional,isTexto) && validaCampo(document.f1.costo_contrato,isNumber) && validaCampo(document.f1.costo_dif_men,isNumber) && validaCampo(document.f1.status_pago,isSelect) && validaCampo(document.f1.nro_factura,isSelect) && validaCampo(document.f1.cod_id_persona,isSelect) && validaEdif())
			{
				confirmacion(tipoDato,clase,id_contrato()+"=@"+id_calle()+"=@"+id_persona()+"=@"+cli_id_persona()+"=@"+nro_contrato()+"=@"+formatdate(fecha_contrato())+"=@"+hora_contrato()+"=@"+observacion()+"=@"+etiqueta()+"=@"+costo_contrato()+"=@"+costo_dif_men()+"=@"+status_pago()+"=@"+nro_factura()+"=@"+direc_adicional()+"=@"+numero_casa()+"=@"+edificio()+"=@"+numero_piso()+"=@"+postel()+"=@"+taps()+"=@"+pto()+"=@"+id_gt()+"=@"+id_g_a()+"=@=@"+document.f1.cod_id_persona.value+"=@"+document.f1.contrato_fisico.value+"=@"+document.f1.etiqueta_n.value+"=@"+verRadiotipo_fact()+"=@"+document.f1.ultima_act.value+"=@"+document.f1.contrato_imp.value+"-Class-"+tipoDato+"=@cliente=@"+cli_id_persona()+"=@"+cedula()+"=@"+get_nombre_cli()+"=@"+apellido()+"=@"+telefono()+"=@"+telf_casa()+"=@"+email()+"=@"+telf_adic()+"=@"+numero_casa()+"=@"+tipo_cliente()+"=@"+inicial_doc()+"=@"+formatdate(fecha_nac())+"-Class-valida_contrato_nuevo=@trans_pago=@"+id_contrato()+"=@"+id_contrato());
			}
			
		//	document.f1.id_orden.value=id_orden;
		}
		else{
			alerta("Error, Debe Seleccionar al menos un servicio.");
		}
		break;
	case "act_contrato":
		if(parseInt(document.f1.cont_serv.value)>0){
			if(validaCampo(document.f1.id_contrato,isAlphanumeric) && valida_tipo_cliente() && validaCampo(document.f1.telefono,isPhoneNumber,true) && validaCampo(document.f1.telf_casa,isPhoneNumber,true) && validaCampo(document.f1.email,isEmail,true)  && validaCampo(document.f1.dato,isTexto) && validaCampo(document.f1.id_calle,isSelect) && validaCampo(document.f1.id_persona,isSelect) && validaCampo(document.f1.cli_id_persona,isAlphanumeric) && validaCampo(document.f1.nro_contrato,isAlphanumeric) && valdate(fecha_contrato()) && validaCampo(document.f1.hora_contrato,isTexto) && validaCampo(document.f1.costo_contrato,isNumber) && validaCampo(document.f1.costo_dif_men,isNumber) && validaCampo(document.f1.status_pago,isSelect) && validaCampo(document.f1.cod_id_persona,isSelect) && validaEdif())
			{
				confirmacion(tipoDato,"contrato",id_contrato()+"=@"+id_calle()+"=@"+id_persona()+"=@"+cli_id_persona()+"=@"+document.f1.n_contrato.value+"=@"+formatdate(fecha_contrato())+"=@"+hora_contrato()+"=@"+observacion()+"=@"+etiqueta()+"=@"+costo_contrato()+"=@"+costo_dif_men()+"=@"+status_pago()+"=@"+nro_factura()+"=@"+direc_adicional()+"=@"+numero_casa()+"=@"+edificio()+"=@"+numero_piso()+"=@"+postel()+"=@"+taps()+"=@"+pto()+"=@"+id_gt()+"=@"+id_g_a()+"=@"+urbanizacion()+"=@"+document.f1.cod_id_persona.value+"=@"+document.f1.contrato_fisico.value+"=@"+document.f1.etiqueta_n.value+"=@"+verRadiotipo_fact()+"=@"+formatdate(document.f1.ultima_act.value)+"=@"+verRadiocontrato_imp()+"=@"+ver_camb_prop()+"-Class-"+tipoDato+"=@cliente=@"+cli_id_persona()+"=@"+cedula()+"=@"+get_nombre_cli()+"=@"+apellido()+"=@"+telefono()+"=@"+telf_casa()+"=@"+email()+"=@"+telf_adic()+"=@"+numero_casa()+"=@"+tipo_cliente()+"=@"+inicial_doc()+"=@"+formatdate(fecha_nac())+"-Class-valida_contrato_nuevo=@trans_pago=@"+id_contrato()+"=@"+id_contrato());
			}
		}
		else{
			alerta("Error, Debe Seleccionar al menos un servicio.");
		}
		break;
	case "act_datos":
		claseGlobal="act_datos";
			if(validaCampo(document.f1.id_contrato,isAlphanumeric) && valida_tipo_cliente() && validaCampo(document.f1.telefono,isPhoneNumber) && validaCampo(document.f1.telf_casa,isPhoneNumber,true)  && validaCampo(document.f1.email,isEmail,true)  && validaCampo(document.f1.dato,isTexto) && validaCampo(document.f1.id_calle,isSelect) && validaCampo(document.f1.id_persona,isAlphanumeric) && validaCampo(document.f1.cli_id_persona,isAlphanumeric) && validaCampo(document.f1.nro_contrato,isAlphanumeric) && valdate(fecha_contrato()) && validaCampo(document.f1.hora_contrato,isTexto) && validaCampo(document.f1.costo_contrato,isNumber) && validaCampo(document.f1.costo_dif_men,isNumber) && validaCampo(document.f1.status_pago,isSelect) && validaCampo(document.f1.id_persona,isSelect) && validaEdif())
			{
				confirmacion(tipoDato,"contrato",id_contrato()+"=@"+id_calle()+"=@"+id_persona()+"=@"+cli_id_persona()+"=@"+nro_contrato()+"=@"+formatdate(fecha_contrato())+"=@"+hora_contrato()+"=@"+observacion()+"=@"+etiqueta()+"=@"+costo_contrato()+"=@"+costo_dif_men()+"=@"+status_pago()+"=@"+nro_factura()+"=@"+direc_adicional()+"=@"+numero_casa()+"=@"+edificio()+"=@"+numero_piso()+"=@"+postel()+"=@"+taps()+"=@"+pto()+"=@-Class-"+tipoDato+"=@cliente=@"+cli_id_persona()+"=@"+cedula()+"=@"+get_nombre_cli()+"=@"+apellido()+"=@"+telefono()+"=@"+telf_casa()+"=@"+email()+"=@"+telf_adic()+"=@"+numero_casa()+"=@"+tipo_cliente()+"=@"+inicial_doc()+"=@"+formatdate(fecha_nac()));
			}
		break;
	case "contrato_servicio":
		if(validaCampo(document.f1.id_cont_serv,isAlphanumeric) && validaCampo(document.f1.nro_contrato,isAlphanumeric) && valida_ced_tipo_cliente()  && validaCampo(document.f1.id_serv,isSelect) && validaCampo(document.f1.id_contrato,isAlphanumeric) && valdate(fecha_inst()) && validaCampo(document.f1.cant_serv,isInteger) && validaCampo(document.f1.id_calle,isSelect) && validaCampo(document.f1.costo_cobro,isNumber))
		{
			if(document.f1.agregar.value=="Modificar"){
				tipoDato="mod";
			}
			conexionPHP("administrar.php",clase,id_cont_serv()+"=@"+id_serv()+"=@"+id_contrato()+"=@"+formatdate(fecha_inst())+"=@"+cant_serv()+"=@"+cli_id_persona()+"=@"+id_calle()+"=@"+document.f1.tipo_s.value+"=@"+document.f1.costo_cobro.value,tipoDato);
			//confirmacion(tipoDato,clase,);
		}
		break;
	case "aviso_cobro":
		if(validaCampo(document.f1.id_cont_serv,isAlphanumeric) && validaCampo(document.f1.id_serv,isSelect))
		{
			confirmacion(tipoDato,clase,id_cont_serv()+"=@"+id_serv()+"=@"+document.f1.status_contrato.value+"=@=@=@");
		}
		break;
	case "cargar_deuda":
		if(validaCampo(document.f1.id_contrato,isAlphanumeric))
		{
			//alerta(id_contrato()+"=@"+id_serv()+"=@"+verRadiotipo_costo()+"=@"+document.f1.mes.value+"=@"+document.f1.costo.value);
			confirmacion(tipoDato,clase,id_contrato()+"=@"+id_serv()+"=@"+verRadiotipo_costo()+"=@"+document.f1.mes.value+"=@"+document.f1.costo.value);
		}
		break;
	case "cargar_d":
		claseGlobal="cargar_d";
		if(validaCampo(document.f1.id_contrato,isAlphanumeric))
		{
			//alerta(id_contrato()+"=@"+id_serv()+"=@"+verRadiotipo_costo()+"=@"+document.f1.mes.value+"=@"+document.f1.costo.value);
			confirmacion(tipoDato,"cargar_deuda",id_contrato()+"=@"+id_serv()+"=@"+verRadiotipo_costo()+"=@"+document.f1.mes.value+"=@"+document.f1.costo.value);
		}
		break;
	case "tipo_orden":
		if(validaCampo(document.f1.id_tipo_orden,isAlphanumeric) && validaCampo(document.f1.nombre_tipo_orden,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_tipo_orden()+"=@"+nombre_tipo_orden()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "detalle_orden":
		
		if(validaCampo(document.f1.id_det_orden,isAlphanumeric) && validaCampo(document.f1.id_tipo_orden,isSelect) && validaCampo(document.f1.nombre_det_orden,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(estatusCheck_orden()==''){
				alerta("Error, debe seleccionar al menos un Estatus de Contrato.");
				return;
			}
					if(confirmacion(tipoDato,clase,id_det_orden()+"=@"+id_tipo_orden()+"=@"+nombre_det_orden()+"=@"+estatusCheck_orden()+"=@"))
					document.f1.reset();
			//}
			
		}
		break;
	case "ordenes_tecnicos":
		
		if(validaCampo(document.f1.id_orden,isAlphanumeric) && validaCampo(document.f1.id_contrato,isAlphanumeric) && validaCampo(document.f1.id_det_orden,isSelect) && valdate(fecha_orden()))
		{
			confirmacion(tipoDato,clase,id_orden()+"=@=@"+id_det_orden()+"=@"+formatdate(fecha_orden())+"=@=@"+detalle_orden()+"=@"+comentario_orden()+"=@"+status_orden()+"=@"+id_contrato()+"=@"+prioridad());
			
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
	case "franquicia":
		if(validaCampo(document.f1.id_franq,isAlphanumeric) && validaCampo(document.f1.nombre_franq,isTexto) && validaCampo(document.f1.estado_franq,isTexto) && validaCampo(document.f1.ciudad_franq,isTexto) && validaCampo(document.f1.municipio_franq,isTexto) && validaCampo(document.f1.direccion_franq,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_franq()+"=@"+nombre_franq()+"=@"+estado_franq()+"=@"+ciudad_franq()+"=@"+municipio_franq()+"=@"+direccion_franq()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "parametros":
		if(validaCampo(document.f1.id_param,isAlphanumeric) && validaCampo(document.f1.id_franq,isSelect) && valdate(fecha_param()) && validaCampo(document.f1.parametro,isTexto) && validaCampo(document.f1.obser_param,isTexto) && validaCampo(document.f1.valor_param,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_param()+"=@"+id_franq()+"=@"+formatdate(fecha_param())+"=@"+parametro()+"=@"+obser_param()+"=@"+valor_param()))
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
	case "urbanizacion":
		if(validaCampo(document.f1.id_calle,isAlphanumeric) && validaCampo(document.f1.nro_calle,isInteger) && validaCampo(document.f1.id_sector,isSelect) && validaCampo(document.f1.nombre_calle,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_calle()+"=@"+nro_calle()+"=@"+id_sector()+"=@"+nombre_calle()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "sector":
		if(validaCampo(document.f1.id_sector,isAlphanumeric) && validaCampo(document.f1.nro_sector,isInteger) && validaCampo(document.f1.id_zona,isSelect) && validaCampo(document.f1.nombre_sector,isTexto) )
		{
			if(confirmacion(tipoDato,clase,id_sector()+"=@"+nro_sector()+"=@"+id_zona()+"=@"+nombre_sector()+"=@=@"))
				document.f1.reset();
		}
		break;
	case "zona":
		if(validaCampo(document.f1.id_zona,isAlphanumeric) && validaCampo(document.f1.nro_zona,isInteger) && validaCampo(document.f1.id_ciudad,isSelect) && validaCampo(document.f1.nombre_zona,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_zona()+"=@"+nro_zona()+"=@"+id_ciudad()+"=@"+nombre_zona()+"=@"+data()))
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
	case "add_sector":
		claseGlobal=clase;
		if(validaCampo(document.f1.id_sector,isAlphanumeric) && validaCampo(document.f1.nro_sector,isInteger) && validaCampo(document.f1.id_zona,isSelect) && validaCampo(document.f1.nombre_sector,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			confirmacion(tipoDato,"sector",id_sector()+"=@"+nro_sector()+"=@"+id_zona()+"=@"+nombre_sector()+"=@"+data());
				
		}
		break;
	case "add_zona":
		claseGlobal=clase;
		if(validaCampo(document.f1.id_zona,isAlphanumeric) && validaCampo(document.f1.nro_zona,isInteger) && validaCampo(document.f1.id_franq,isSelect) && validaCampo(document.f1.nombre_zona,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			confirmacion(tipoDato,"zona",id_zona()+"=@"+nro_zona()+"=@"+id_franq()+"=@"+nombre_zona()+"=@"+data());

		}
		break;
	case "materiales":
	//alerta(id_mat()+"=@"+numero_mat()+"=@"+nombre_mat()+"=@"+unidad_mat()+"=@"+abrevia_unidad()+"=@"+cant_existencia()+"=@"+precio()+"=@"+observacion()+"=@"+data())
		if(validaCampo(document.f1.id_mat,isAlphanumeric) && validaCampo(document.f1.numero_mat,isInteger) && validaCampo(document.f1.nombre_mat,isTexto) && validaCampo(document.f1.unidad_mat,isSelect) && validaCampo(document.f1.abrevia_unidad,isTexto) && validaCampo(document.f1.cant_existencia,isInteger) && validaCampo(document.f1.precio,isSelect))
		{
			if(confirmacion(tipoDato,clase,id_mat()+"=@"+numero_mat()+"=@"+nombre_mat()+"=@"+unidad_mat()+"=@"+abrevia_unidad()+"=@"+cant_existencia()+"=@"+precio()+"=@"+observacion()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "ent_sal_mat":
		if(validaCampo(document.f1.id_ent_sal,isAlphanumeric) && validaCampo(document.f1.id_mat,isAlphanumeric) && validaCampo(document.f1.tipo_ent_sal,isAlphabetic) && valdate(fecha_ent_sal()) && validaCampo(document.f1.hora_ent_sal,isTexto) && validaCampo(document.f1.cant_ent_sal,isInteger) && validaCampo(document.f1.precio_compra,isNumber))
		{
			if(confirmacion(tipoDato,"ent_sal_mat",id_ent_sal()+"=@"+id_mat()+"=@"+tipo_ent_sal()+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+cant_ent_sal()+"=@"+precio_compra()+"=@"+observacion()+"=@0"))
				document.f1.reset();
		}
		break;
	case "inventario":
		if(validaCampo(document.f1.id_inv,isAlphanumeric) && valdate(fecha_inv()) && validaCampo(document.f1.hora_inv,isTexto) && validaCampo(document.f1.obser_inv,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			confirmacion(tipoDato,clase,id_inv()+"=@"+formatdate(fecha_inv())+"=@"+hora_inv()+"=@"+obser_inv()+"=@"+data());
			
		}
		break;
	case "inventario_materiale":
		if(validaCampo(document.f1.id_mat,isAlphanumeric) && validaCampo(document.f1.id_inv,isAlphanumeric) && validaCampo(document.f1.cantidad,isInteger) && validaCampo(document.f1.dato,isTexto)){
			if(confirmacion(tipoDato,clase,id_mat()+"=@"+id_inv()+"=@"+cantidad()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "tipo_servicio":
		if(validaCampo(document.f1.id_tipo_servicio,isAlphanumeric) && validaCampo(document.f1.tipo_servicio,isTexto) && validaCampo(document.f1.id_franq,isSelect))
		{
			if(confirmacion(tipoDato,clase,id_tipo_servicio()+"=@"+tipo_servicio()+"=@"+verRadiostatus_servicio()+"=@"+id_franq()))
				document.f1.reset();
		}
		break;
	case "servicios":
		if(validaCampo(document.f1.id_serv,isAlphanumeric) && validaCampo(document.f1.id_tipo_servicio,isSelect) && validaCampo(document.f1.nombre_servicio,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_serv()+"=@"+id_tipo_servicio()+"=@"+nombre_servicio()+"=@"+verRadiostatus_serv()+"=@"+verRadiotipo_costo()+"=@"+tipo_paq()+"=@"+obser_serv()+"=@"+tipo_serv()+"=@"+document.f1.tarifa_esp.value+"=@"+document.f1.id_paq.value+"=@"+document.f1.id_cant.value+"=@"+document.f1.id_tar_ser.value+"=@"+document.f1.tarifa_ser.value+servicioacc4000()+servicio_franquicia()))
				document.f1.reset();
		}
		break;
	case "tarifa_servicio":
		if(validaCampo(document.f1.id_tar_ser,isAlphanumeric) && validaCampo(document.f1.id_serv,isSelect) && valdate(fecha_tar_ser()) && validaCampo(document.f1.hora_tar_ser,isTexto) && validaCampo(document.f1.obser_tarifa_ser,isTexto) && validaCampo(document.f1.tarifa_ser,isNumber)){
			if(confirmacion(tipoDato,clase,id_tar_ser()+"=@"+id_serv()+"=@"+formatdate(fecha_tar_ser())+"=@"+hora_tar_ser()+"=@"+obser_tarifa_ser()+"=@"+verRadiostatus_tarifa_ser()+"=@"+tarifa_ser()))
				document.f1.reset();
		}
		break;
	case "pago_servicio":
		if(validaCampo(document.f1.id_pago,isAlphanumeric) && validaCampo(document.f1.id_cont_serv,isAlphanumeric) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_pago()+"=@"+id_cont_serv()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "pagos":
		//alert(id_pago()+"=@"+id_caja_cob()+"=@"+formatdate(fecha_pago())+"=@"+hora_pago()+"=@"+monto_pago()+"=@"+obser_pago()+"=@"+status_pago()+"=@"+nro_factura()+"=@"+id_contrato()+"=@"+document.f1.nro_control.value+"=@"+document.f1.desc.value+"=@12=@"+document.f1.monto_iva.value+"=@"+document.f1.porc_reten.value+"=@"+document.f1.monto_reten.value+"=@"+document.f1.base_imp.value+"=@"+document.f1.monto_islr.value+"=@"+document.f1.n_credito.value+"=@"+formatdate(document.f1.fecha_factura.value)+"=@"+impresion+verDetallePago()+registrarCobro()+"-Class-valida_pago=@trans_pago=@"+id_pago()+"=@")
		if(parseInt(contSel)<1){
			alerta("Error, debe seleccionar algun cargo.");
		}
		else if(parseInt(contSel)>50){
			alerta("Error, debe seleccionar maximo 50 cargos.");
		}
		else{
			if(validaCampo(document.f1.id_pago,isAlphanumeric)  && valdate(fecha_pago())  && validaCampo(document.f1.monto_pago,isNumber) && validaCampo(document.f1.nro_factura,isTexto) && validaTipoPago() && registrarCobro()!='')
			{
				if(control_recibo_G=='1'){
					if(document.f1.caja_externa.value!='OFICINA'){
						if(document.f1.nro_control.value==''){
							alerta("Error, debe introducir el numero de control de recibo de pago.");
							return false;
						}
					}else{
						document.f1.nro_control.value='';
					}
				}
				if(tipoDato=='guardar'){
					var impresion='NO';
					imp_factG=false;
					tipoDato='incluir';
				}
				else{
					imp_factG=true;
					var impresion='SI';
				}
				confirmacion(tipoDato,clase,id_pago()+"=@"+id_caja_cob()+"=@"+formatdate(fecha_pago())+"=@"+hora_pago()+"=@"+monto_pago()+"=@"+obser_pago()+"=@"+status_pago()+"=@"+nro_factura()+"=@"+id_contrato()+"=@"+document.f1.nro_control.value+"=@"+document.f1.desc.value+"=@12=@"+document.f1.monto_iva.value+"=@"+document.f1.porc_reten.value+"=@"+document.f1.monto_reten.value+"=@"+document.f1.base_imp.value+"=@"+document.f1.monto_islr.value+"=@"+document.f1.n_credito.value+"=@"+formatdate(document.f1.fecha_factura.value)+"=@"+impresion+verDetallePago()+registrarCobro()+"-Class-valida_pago=@trans_pago=@"+id_pago()+"=@");
			}
		}
		break;
	case "nota_credito_factura":
			if(valida_monto_nc() && validaCampo(document.f1.motivo,isSelect) && validaCampo(document.f1.monto_pago,isNumber) && validaCampo(document.f1.nro_factura,isTexto) && validaCampo(document.f1.nro_control,isTexto) && registrarCobroCN()!='')
			{
				confirmacion(tipoDato,"pagos",document.f1.id_pago_nc.value+"=@=@=@=@"+monto_pago()+"=@"+obser_pago()+"=@GENERADA=@"+nro_factura()+"=@"+id_contrato()+"=@"+document.f1.nro_control.value+"=@0=@12=@0=@0=@0=@0=@0=@"+document.f1.motivo.value+"=@=@NO=@"+id_pago()+registrarCobroCN()+"-Class-valida_pago_nc=@trans_pago=@"+document.f1.id_pago_nc.value+"=@");
			}
		
		break;
	case "nota_debito_factura":
		
			if(valida_monto_nc() && validaCampo(document.f1.motivo,isSelect) && validaCampo(document.f1.monto_pago,isNumber) && validaCampo(document.f1.nro_factura,isTexto) && validaCampo(document.f1.nro_control,isTexto) && registrarCobroCD()!='')
			{
				
				confirmacion(tipoDato,"pagos",document.f1.id_pago_nc.value+"=@=@=@=@"+monto_pago()+"=@"+obser_pago()+"=@GENERADA=@"+nro_factura()+"=@"+id_contrato()+"=@"+document.f1.nro_control.value+"=@0=@12=@0=@0=@0=@0=@0=@"+document.f1.motivo.value+"=@=@NO=@"+id_pago()+registrarCobroCD()+"-Class-valida_pago_nd=@trans_pago=@"+document.f1.id_pago_nc.value+"=@");
			}
		
		break;
	case "anularfactura":
			if(validaCampo(document.f1.id_pago,isAlphanumeric) && validaCampo(document.f1.id_caja_cob,isSelect) && valdate(fecha_pago()) && validaCampo(document.f1.hora_pago,isTexto) && validaCampo(document.f1.monto_pago,isNumber) && validaCampo(document.f1.nro_factura,isTexto))
			{
				
				confirmacion(tipoDato,"pagos",id_pago()+"=@"+id_caja_cob()+"=@"+formatdate(fecha_pago())+"=@"+hora_pago()+"=@"+monto_pago()+"=@"+obser_pago()+"=@"+status_pago()+"=@"+nro_factura()+"=@"+id_contrato()+"=@"+document.f1.nro_control.value+"=@"+document.f1.desc.value+"=@12=@"+document.f1.monto_iva.value+"=@"+document.f1.porc_reten.value+"=@"+document.f1.monto_reten.value+"=@"+document.f1.base_imp.value+"=@"+document.f1.monto_islr.value+"=@"+document.f1.n_credito.value+"=@"+formatdate(document.f1.fecha_factura.value));
			}
		
		break;
	case "modificar_pagos1":
		if(validaCampo(document.f1.id_pago,isAlphanumeric) && validaCampo(document.f1.nro_factura,isTexto))
			{
				confirmacion(tipoDato,"pagos",id_pago()+"=@=@=@=@=@=@=@"+document.f1.nro_factura1.value+"=@=@"+document.f1.nro_control1.value+"=@");
			}
		break;
	case "modificar_pagos":
			if(validaCampo(document.f1.id_pago,isAlphanumeric) && validaTipoPago())
			{
				tipoDato='modificar_forma_pago';
				fp=document.f1.id_tipo_pago.value+"=-="+document.f1.banco.value+"=-="+document.f1.numero.value+"=-="+document.f1.monto_tp.value;
				if(document.f1.checktp1.checked==true)
				{
					fp=fp+"-Cla-"+document.f1.id_tipo_pago1.value+"=-="+document.f1.banco1.value+"=-="+document.f1.numero1.value+"=-="+document.f1.monto_tp1.value;
				}
				confirmacion(tipoDato,"pagos",id_pago()+"=@=@=@=@=@=@=@"+fp+"=@");
				
			}
		break;
	case "anular_pagos":
		if(validaCampo(document.f1.id_pago,isAlphanumeric) && validaCampo(document.f1.nro_factura,isTexto))
			{
				if(document.f1.n_credito.value==''){
						alerta("Error, debe introducir el numero de la nota de crédito.");
						return false;
					}
				if(tipoDato=='anular'){
					
				}
				confirmacion(tipoDato,"pagos",id_pago()+"=@"+id_caja_cob()+"=@"+formatdate(fecha_pago())+"=@"+hora_pago()+"=@"+monto_pago()+"=@"+obser_pago()+"=@"+status_pago()+"=@"+nro_factura()+"=@"+id_contrato()+"=@"+document.f1.n_credito.value);
			}
		break;
	case "anular_solo_pagos":
		if(validaCampo(document.f1.id_pago,isAlphanumeric) && validaCampo(document.f1.nro_factura,isTexto))
			{
				if(document.f1.n_credito.value==''){
						alerta("Error, debe introducir el numero de la nota de crédito.");
						return false;
					}
				if(tipoDato=='anular'){
					
				}
				confirmacion(tipoDato,"pagos",id_pago()+"=@"+id_caja_cob()+"=@"+formatdate(fecha_pago())+"=@"+hora_pago()+"=@"+monto_pago()+"=@"+obser_pago()+"=@"+status_pago()+"=@"+nro_factura()+"=@"+id_contrato()+"=@"+document.f1.n_credito.value);
			}
		break;
	case "anular_control":
		if(validaCampo(document.f1.id_pago,isAlphanumeric) && validaCampo(document.f1.nro_factura,isTexto))
			{
				if(document.f1.n_credito.value==''){
						alerta("Error, debe introducir el numero de la nota de crédito.");
						return false;
					}
				if(tipoDato=='anular'){
					
				}
				confirmacion(tipoDato,"pagos",id_pago()+"=@"+id_caja_cob()+"=@"+formatdate(fecha_pago())+"=@"+hora_pago()+"=@"+monto_pago()+"=@"+obser_pago()+"=@"+status_pago()+"=@"+nro_factura()+"=@"+id_contrato()+"=@"+document.f1.n_credito.value);
			}
		break;
	case "detalle_tipopago":
		if(validaCampo(document.f1.id_tipo_pago,isAlphanumeric) && validaCampo(document.f1.id_pago,isAlphanumeric) && validaCampo(document.f1.banco,isTexto) && validaCampo(document.f1.numero,isInteger) && validaCampo(document.f1.obser_detalle,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_tipo_pago()+"=@"+id_pago()+"=@"+banco()+"=@"+numero_cuenta()+"=@"+obser_detalle()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "tipo_pago":
		if(validaCampo(document.f1.id_tipo_pago,isAlphanumeric) && validaCampo(document.f1.tipo_pago,isName) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_tipo_pago()+"=@"+tipo_pago()+"=@"+verRadiostatus_pago()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "cirre_diario":
		if(validaCampo(document.f1.id_cierre,isAlphanumeric) && valdate(fecha_cierre()) && validaCampo(document.f1.hora_cierre,isTexto) && validaCampo(document.f1.monto_total,isNumber))
		{
			confirmacion(tipoDato,clase,id_cierre()+"=@"+formatdate(fecha_cierre())+"=@"+hora_cierre()+"=@"+monto_total()+"=@"+obser_cierre()+"=@"+data()+"=@"+id_franq());
		}
		break;
	case "cirre_diario_et":
		if(validaCampo(document.f1.id_cierre,isAlphanumeric) && valdate(fecha_cierre()) && validaCampo(document.f1.hora_cierre,isTexto) && validaCampo(document.f1.monto_total,isNumber) && validaCampo(document.f1.dato,isNumber))
		{
			confirmacion(tipoDato,clase,id_cierre()+"=@"+formatdate(fecha_cierre())+"=@"+hora_cierre()+"=@"+monto_total()+"=@"+obser_cierre()+"=@"+data()+"=@"+id_est());
		}
		break;
	case "cierre_pago":
		if(validaCampo(document.f1.id_cont_serv,isAlphanumeric) && validaCampo(document.f1.id_cierre,isAlphanumeric) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_cont_serv()+"=@"+id_cierre()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "caja":
		if(validaCampo(document.f1.id_caja,isAlphanumeric) && validaCampo(document.f1.nombre_caja,isTexto) && validaCampo(document.f1.descripcion_caja,isTexto) && validaCampo(document.f1.dato,isTexto) && validaCampo(document.f1.id_franq,isSelect))
		{
			if(confirmacion(tipoDato,clase,id_caja()+"=@"+nombre_caja()+"=@"+descripcion_caja()+"=@"+verRadiostatus_caja()+"=@"+verRadiotipo_caja()+"=@"+id_franq()))
				document.f1.reset();
		}
		break;
	case "abrir_caja_cobrador":
		if(validaCampo(document.f1.id_caja_cob,isAlphanumeric) && validaCampo(document.f1.id_caja,isSelect) && validaCampo(document.f1.id_persona,isSelect) && validaCampo(document.f1.id_est,isSelect) && valdate(fecha_caja())  && valdate(document.f1.fecha_sugerida.value) && validaCampo(document.f1.apertura_caja,isTexto))
		{
			if(confirmacion(tipoDato,"caja_cobrador",id_caja_cob()+"=@"+id_caja()+"=@"+id_persona()+"=@"+formatdate(fecha_caja())+"=@"+apertura_caja()+"=@=@=@"+status_caja()+"=@"+id_est()+"=@"+formatdate(document.f1.fecha_sugerida.value)))
				document.f1.reset();
		}
		break;
	case "abrir_caja_cobrador_anular":
		if(validaCampo(document.f1.id_caja_cob,isAlphanumeric) && validaCampo(document.f1.id_caja,isSelect) && validaCampo(document.f1.id_persona,isSelect) && validaCampo(document.f1.id_est,isSelect) && valdate(fecha_caja())  && valdate(document.f1.fecha_sugerida.value) && validaCampo(document.f1.apertura_caja,isTexto))
		{
			if(confirmacion(tipoDato,"caja_cobrador",id_caja_cob()+"=@"+id_caja()+"=@"+id_persona()+"=@"+formatdate(fecha_caja())+"=@"+apertura_caja()+"=@=@=@"+status_caja()+"=@"+id_est()+"=@"+formatdate(document.f1.fecha_sugerida.value)))
				document.f1.reset();
		}
		break;
	case "cambiar_fecha_caja_cobrador":
		if(validaCampo(document.f1.id_caja_cob,isAlphanumeric) && valdate(document.f1.fecha_sugerida.value))
		{
			if(confirmacion(tipoDato,"caja_cobrador",id_caja_cob()+"=@=@=@=@=@=@=@=@=@"+formatdate(document.f1.fecha_sugerida.value)))
				document.f1.reset();
		}
		break;
	case "cerrar_caja_cobrador":
		if(validaCampo(document.f1.id_caja_cob,isAlphanumeric) && validaCampo(document.f1.id_caja,isSelect) && validaCampo(document.f1.id_persona,isSelect) && valdate(fecha_caja()) && validaCampo(document.f1.apertura_caja,isTexto))
		{
				confirmacion(tipoDato,"caja_cobrador",id_caja_cob()+"=@"+id_caja()+"=@"+id_persona()+"=@=@=@"+cierre_caja()+"=@"+monto_acum()+"=@"+status_caja()+"=@");
				
		}
		break;
	case "caja_cobrador":
		if(validaCampo(document.f1.id_caja_cob,isAlphanumeric) && validaCampo(document.f1.id_caja,isSelect) && validaCampo(document.f1.id_persona,isSelect) && valdate(fecha_caja()) && validaCampo(document.f1.apertura_caja,isTexto) && validaCampo(document.f1.cierre_caja,isTexto) && validaCampo(document.f1.monto_acum,isNumber) && validaCampo(document.f1.status_caja,isAlphanumeric) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_caja_cob()+"=@"+id_caja()+"=@"+id_persona()+"=@"+formatdate(fecha_caja())+"=@"+apertura_caja()+"=@"+cierre_caja()+"=@"+monto_acum()+"=@"+status_caja()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "reclamo_denuncia":
		if(validaCampo(document.f1.id_rec,isAlphanumeric) && validaCampo(document.f1.id_persona,isAlphanumeric) && validaCampo(document.f1.nro_rec,isInteger) && valdate(fecha_rec()) && validaCampo(document.f1.hora_rec,isTexto) && validaCampo(document.f1.motivo_rec,isTexto) && validaCampo(document.f1.descrip_rec,isTexto) && validaCampo(document.f1.denunciado,isAlphanumeric) && validaCampo(document.f1.status_rec,isAlphanumeric) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_rec()+"=@"+id_persona()+"=@"+nro_rec()+"=@"+verRadiotipo_rec()+"=@"+formatdate(fecha_rec())+"=@"+hora_rec()+"=@"+motivo_rec()+"=@"+descrip_rec()+"=@"+denunciado()+"=@"+status_rec()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "comentario_cliente":
		if(validaCampo(document.f1.id_comen,isAlphanumeric) && validaCampo(document.f1.cedula,isCedula) && validaCampo(document.f1.id_persona,isAlphanumeric) && validaCampo(document.f1.nro_comen,isInteger) && valdate(fecha_comen()) && validaCampo(document.f1.hora_comen,isTexto) && validaCampo(document.f1.comentario,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_comen()+"=@"+id_persona()+"=@"+nro_comen()+"=@"+formatdate(fecha_comen())+"=@"+hora_comen()+"=@"+comentario()+"=@"+verRadiostatus_comen()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "pago_comisiones":
		if(validaCampo(document.f1.id_comi,isAlphanumeric) && validaCampo(document.f1.id_persona,isSelect) && valdate(fecha_comi()) && valdate(fecha_desde()) && valdate(fecha_hasta()) && validaCampo(document.f1.porcent_aplic,isTexto) && validaCampo(document.f1.monto_comi,isNumber) && validaCampo(document.f1.status_comi,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_comi()+"=@"+id_persona()+"=@"+verRadiocomi_para()+"=@"+formatdate(fecha_comi())+"=@"+formatdate(fecha_desde())+"=@"+formatdate(fecha_hasta())+"=@"+porcent_aplic()+"=@"+monto_comi()+"=@"+status_comi()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "status_contrato":
		//	confirmacion(tipoDato,clase,id_franq()+"=@"+id_zona()+"=@"+id_sector()+"=@"+id_calle()+"=@"+document.f1.desde.value+"=@"+document.f1.hasta.value+"=@";
		//	archivoDataGrid="procesos/datagrid_status_contrato.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&";	
		mostrar("mostrar_busqueda");
		break;
	case "edificio":
		if(validaCampo(document.f1.id_sector,isSelect) && validaCampo(document.f1.edificio,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_edif()+"=@"+id_sector()+"=@"+edificio()+"=@"))
				document.f1.reset();
		}
		break;
	case "banco":
		if(validaCampo(document.f1.banco,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_banco()+"=@"+banco()+"=@"+document.f1.tipo_banco.value))
				document.f1.reset();
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
	case "grupo_trabajo":

		if(validaCampo(document.f1.id_gt,isAlphanumeric) && validaCampo(document.f1.nombre_grupo,isTexto) && valdate(fecha_creacion()) && validaCampo(document.f1.hora_creacion,isTexto) && val_grupo_tec() && val_grupo_ubi() && validaCampo(document.f1.id_franq,isSelect))
		{
			if(confirmacion(tipoDato,clase,id_gt()+"=@"+nombre_grupo()+"=@"+document.f1.organizar_por.value+"=@"+formatdate(fecha_creacion())+"=@"+hora_creacion()+"=@"+verRadiostatus_grupo()+"=@"+id_franq()+grupo_tec(tipoDato)+grupo_ubi(tipoDato)))
				document.f1.reset();
		}
		break;
	case "grupo_tecnico":
		if(validaCampo(document.f1.id_gt,isAlphanumeric) && validaCampo(document.f1.id_persona,isAlphanumeric) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_gt()+"=@"+id_persona()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "orden_grupo":
		if(validaCampo(document.f1.id_orden,isAlphanumeric) && validaCampo(document.f1.id_gt,isAlphanumeric) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_orden()+"=@"+id_gt()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "sms":
		if(validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,data()))
				document.f1.reset();
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
		//alerta(document.f1.id_com.value+"=@"+id_franq()+"=@"+tipo_com()+"=@"+nombre_com()+"=@"+descrip_com()+"=@"+document.f1.status_com.value+"=@"+sms_resp()+"=@"+tipo_variable()+"=@"+sms_error()+"=@"+status_error()+"=@"+valorTextArea);
		if(validaCampo(document.f1.id_com,isAlphanumeric) && validaCampo(document.f1.tipo_com,isSelect) && validaCampo(document.f1.nombre_com,isTexto) && validaCampo(document.f1.descrip_com,isTexto) && validaCampo(document.f1.sms_resp,isTexto) && validaCampo(document.f1.sms_error,isTexto) && validaTextArea())
		{
			if(confirmacion(tipoDato,clase,document.f1.id_com.value+"=@"+id_franq()+"=@"+tipo_com()+"=@"+nombre_com()+"=@"+descrip_com()+"=@"+document.f1.status_com.value+"=@"+sms_resp()+"=@"+tipo_variable()+"=@"+sms_error()+"=@"+status_error()+"=@"+valorTextArea))
				document.f1.reset();
		}
		break;
	case "formato_sms":
		if(validaCampo(document.f1.id_form,isAlphanumeric) && validaCampo(document.f1.nombre_form,isTexto) && validaCampo(document.f1.formato,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_form()+"=@"+id_franq()+"=@"+nombre_form()+"=@"+formato()+"=@"+verRadiostatus_form()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "config_sms":
		if(validaCampo(document.f1.id_conf_sms,isAlphanumeric) && validaCampo(document.f1.id_franq,isInteger) && validaCampo(document.f1.cod_telf_pais,isTexto) && validaCampo(document.f1.telefono_serv,isTexto) && validaCampo(document.f1.id_canal_sms,isAlphanumeric) && validaCampo(document.f1.correo_emp,isEmail) && validaCampo(document.f1.clave_correo,isTexto) && validaCampo(document.f1.asunto_correo,isTexto) && validaCampo(document.f1.conf_campo1,isTexto) && validaCampo(document.f1.conf_campo2,isTexto) && validaCampo(document.f1.conf_campo3,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_conf_sms()+"=@"+id_franq()+"=@+"+cod_telf_pais()+"=@"+telefono_serv()+"=@"+id_canal_sms()+"=@"+correo_emp()+"=@"+clave_correo()+"=@"+asunto_correo()+"=@"+verRadioper_telf_fijo()+"=@"+verRadioenv_todos_telf()+"=@"+verRadioact_resp_aut()+"=@"+conf_campo1()+"=@"+conf_campo2()+"=@"+conf_campo3()+"=@"+sms_resp_aut()+"=@"+marca()+"=@"+modelo()))
				document.f1.reset();
		}
		break;
	case "tecnico":
		if(validaCampo(document.f1.id_persona,isAlphanumeric) && validaCampo(document.f1.cedula,isCedula) && validaCampo(document.f1.nombre,isName) && validaCampo(document.f1.apellido,isName) && validaCampo(document.f1.telefono,isPhoneNumber) && validaCampo(document.f1.num_tecnico,isInteger) && validaCampo(document.f1.direccion_tec,isTexto) && validaCampo(document.f1.dato,isTexto) && validaCampo(document.f1.id_franq,isSelect))
		{
			if(confirmacion(tipoDato,clase,id_persona()+"=@"+cedula()+"=@"+nombre()+"=@"+apellido()+"=@"+telefono()+"=@"+num_tecnico()+"=@"+direccion_tec()+"=@"+email()+"=@"+verRadiosattus_gerente()+"=@"+id_franq()))
				document.f1.reset();
		}
		break;
	
	case "gerentes_permitidos":
	
		if(validaCampo(document.f1.id_persona,isAlphanumeric) && validaCampo(document.f1.cedula,isCedula) && validaCampo(document.f1.nombre,isName) && validaCampo(document.f1.apellido,isName) && validaCampo(document.f1.telefono,isPhoneNumber) && validaCampo(document.f1.nro_gerente,isInteger) && validaCampo(document.f1.tipo_gerente,isSelect) && validaCampo(document.f1.cargo_gerente,isTexto) && validaCampo(document.f1.descrip_gerente,isTexto) && validaCampo(document.f1.email,isEmail) && validaCampo(document.f1.id_franq,isSelect))
		{
			if(confirmacion(tipoDato,clase,id_persona()+"=@"+cedula()+"=@"+nombre()+"=@"+apellido()+"=@"+telefono()+"=@"+nro_gerente()+"=@"+tipo_gerente()+"=@"+cargo_gerente()+"=@"+descrip_gerente()+"=@"+verRadiosattus_gerente()+"=@"+email()+"=@"+id_franq()))
				document.f1.reset();
		}
		break;
	case "variables_sms":
		if(validaCampo(document.f1.id_var,isInteger) && validaCampo(document.f1.variable,isTexto) && validaCampo(document.f1.descrip_var,isTexto) && validaCampo(document.f1.id_franq,isSelect) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_var()+"=@"+variable()+"=@"+tipo_var()+"=@"+descrip_var()+"=@"+verRadiostatus_var()+"=@"+id_franq()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "statuscont":
		if(validaCampo(document.f1.idstatus,isAlphanumeric) && validaCampo(document.f1.nombrestatus,isName) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,idstatus()+"=@"+nombrestatus()+"=@"+verRadiostatus()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "motivonotas":
		if(validaCampo(document.f1.idmotivonota,isAlphanumeric) && validaCampo(document.f1.nombremotivonota,isName) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,idmotivonota()+"=@"+nombremotivonota()+"=@"+verRadiostatus()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "motivollamada":
		if(validaCampo(document.f1.idmotivonota,isAlphanumeric) && validaCampo(document.f1.nombremotivonota,isName) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,idmotivonota()+"=@"+nombremotivonota()+"=@"+verRadiostatus()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "otros_datos":
		if(validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,data()))
				document.f1.reset();
		}
		break;
	case "contrato_ser":
		if(validaCampo(document.f1.id_seg,isTexto) && validaCampo(document.f1.llave_enc,isTexto) && validaCampo(document.f1.licencia_seg,isSelect) && valdate(fecha_lic()) && validaCampo(document.f1.hora_lic,isTexto) && validaCampo(document.f1.empresa_aut,isTexto) && validaCampo(document.f1.version_sis,isTexto) && validaCampo(document.f1.acerca_de,isTexto) && validaCampo(document.f1.status_seg,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_seg()+"=@"+firma_seg()+"=@"+llave_enc()+"=@"+llave_dec()+"=@"+licencia_seg()+"=@"+limite_reg()+"=@"+formatdate(fecha_lic())+"=@"+hora_lic()+"=@"+empresa_aut()+"=@"+version_sis()+"=@"+acerca_de()+"=@"+status_seg()+"=@"+campo_seg1()+"=@"+campo_seg2()+"=@"+campo_seg3()+"=@"+campo_seg4()+"=@"+campo_seg5()+"=@"+campo_seg6()+"=@"+campo_seg7()+"=@"+data()))
				document.f1.reset();
		}
		break;
	
	case "contrato_ser1":
		if(validaCampo(document.f1.id_seg,isTexto) && validaCampo(document.f1.firma_seg,isTexto) && validaCampo(document.f1.llave_enc,isTexto) && validaCampo(document.f1.llave_dec,isTexto) && validaCampo(document.f1.licencia_seg,isSelect) && validaCampo(document.f1.limite_reg,isTexto) && valdate(fecha_lic()) && validaCampo(document.f1.hora_lic,isTexto) && validaCampo(document.f1.empresa_aut,isTexto) && validaCampo(document.f1.version_sis,isTexto) && validaCampo(document.f1.acerca_de,isTexto) && validaCampo(document.f1.status_seg,isTexto) && validaCampo(document.f1.campo_seg1,isTexto) && validaCampo(document.f1.campo_seg2,isTexto) && validaCampo(document.f1.campo_seg3,isTexto) && validaCampo(document.f1.campo_seg4,isTexto) && validaCampo(document.f1.campo_seg5,isTexto) && validaCampo(document.f1.campo_seg6,isTexto) && validaCampo(document.f1.campo_seg7,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,"contrato_ser",id_seg()+"=@"+firma_seg()+"=@"+llave_enc()+"=@"+llave_dec()+"=@"+licencia_seg()+"=@"+limite_reg()+"=@"+formatdate(fecha_lic())+"=@"+hora_lic()+"=@"+empresa_aut()+"=@"+version_sis()+"=@"+acerca_de()+"=@"+status_seg()+"=@"+campo_seg1()+"=@"+campo_seg2()+"=@"+campo_seg3()+"=@"+campo_seg4()+"=@"+campo_seg5()+"=@"+campo_seg6()+"=@"+campo_seg7()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "grupo_afinidad":
		if(validaCampo(document.f1.id_g_a,isAlphanumeric) && validaCampo(document.f1.nombre_g_a,isName) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_g_a()+"=@"+nombre_g_a()+"=@"+verRadiostatus_g_a()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "tipo_alarma":
		if(validaCampo(document.f1.id_tipo_alarma,isAlphanumeric) && validaCampo(document.f1.nombre_alarma,isName) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_tipo_alarma()+"=@"+nombre_alarma()+"=@"+verRadiostatus_alarma()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "alarma_perfil":
		if(validaCampo(document.f1.codigoperfil,isAlphanumeric) && validaCampo(document.f1.id_tipo_alarma,isAlphanumeric) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,codigoperfil()+"=@"+id_tipo_alarma()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "alarmas":
	/*	if(validaCampo(document.f1.id_alarma,isAlphanumeric) && validaCampo(document.f1.id_tipo_alarma,isSelect) && validaCampo(document.f1.nombre_alarma,isName) && validaCampo(document.f1.detalle_alarma,isTexto) && valdate(fecha_alarma()) && validaCampo(document.f1.ref_alarma,isTexto) && validaCampo(document.f1.status_alarma,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
		*/
			if(confirmacion(tipoDato,clase,id_alarma()+"=@"+id_tipo_alarma()+"=@"+nombre_alarma()+"=@"+detalle_alarma()+"=@"+formatdate(fecha_alarma())+"=@"+ref_alarma()+"=@"+status_alarma()+"=@"+data()))
				document.f1.reset();
	//	}
		break;
	case "grupo_ubicacion":
		if(validaCampo(document.f1.id_gt,isAlphanumeric) && validaCampo(document.f1.id_sector,isAlphanumeric) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_gt()+"=@"+id_sector()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "estacion_trabajo":
		if(validaCampo(document.f1.id_est,isAlphanumeric) && validaCampo(document.f1.login,isAlphanumeric) && validaCampo(document.f1.nombre_est,isTexto) && validaCampo(document.f1.ip_est,isTexto) && validaCampo(document.f1.mac_est,isTexto) && validaCampo(document.f1.nom_comp,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_est()+"=@"+login()+"=@"+nombre_est()+"=@"+ip_est()+"=@"+mac_est()+"=@"+nom_comp()+"=@"+verRadiostatus_est()+"=@"+data()+"=@"+id_franq()))
				document.f1.reset();
		}
		break;
	case "precintos":
		if(validaCampo(document.f1.id_prec,isAlphanumeric) && validaCampo(document.f1.login,isAlphanumeric) && validaCampo(document.f1.nombre_prec,isTexto) && valdate(fecha_ing_prec()) && valdate(fecha_mod_prec()) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_prec()+"=@"+login()+"=@"+nombre_prec()+"=@"+formatdate(fecha_ing_prec())+"=@"+formatdate(fecha_mod_prec())+"=@"+verRadiostatus_prec()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "estado":
		if(validaCampo(document.f1.id_esta,isAlphanumeric) && validaCampo(document.f1.id_franq,isSelect) && validaCampo(document.f1.nombre_esta,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_esta()+"=@"+id_franq()+"=@"+nombre_esta()+"=@"+verRadiostatus_esta()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "municipio":
		if(validaCampo(document.f1.id_mun,isAlphanumeric) && validaCampo(document.f1.id_esta,isSelect) && validaCampo(document.f1.nombre_mun,isName) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_mun()+"=@"+id_esta()+"=@"+nombre_mun()+"=@"+verRadiostatus_mun()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "ciudad":
		if(validaCampo(document.f1.id_ciudad,isAlphanumeric) && validaCampo(document.f1.id_mun,isSelect) && validaCampo(document.f1.nombre_ciudad,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_ciudad()+"=@"+id_mun()+"=@"+nombre_ciudad()+"=@"+verRadiostatus_ciudad()+"=@"+data()))
				document.f1.reset();
		}
		break;
	
	case "cablemodem":
		if(validaCampo(document.f1.id_cm,isAlphanumeric) && validaCampo(document.f1.id_contrato,isAlphanumeric) && validaCampo(document.f1.codigo_cm,isTexto))
		{
			if(document.f1.agregarcm.value=="Modificar"){
				tipoDato="agregar";
			}
			confirmacion(tipoDato,clase,id_cm()+"=@"+id_contrato()+"=@"+codigo_cm()+"=@"+marca_cm()+"=@"+modelo_cm()+"=@=@I=@"+formatdate(fecha_act_cm())+"=@=@=@=@=@");
		}
		break;
	case "deco_ana":
		if(validaCampo(document.f1.id_da,isAlphanumeric) && validaCampo(document.f1.id_contrato,isAlphanumeric) && validaCampo(document.f1.codigo_da,isTexto))
		{
			if(document.f1.agregarda.value=="Modificar"){
				tipoDato="modificar";
			}
		//	alert(id_da()+"=@"+id_contrato()+"=@"+codigo_da()+"=@"+marca_da()+"=@"+modelo_da()+"=@"+prov_da()+"=@"+tipo_da()+"=@=@"+punto_da()+"=@"+status_da()+"=@"+formatdate(fecha_act_da())+"=@=@"+servicioacc4000_agregar()+"=@"+document.f1.nota2.value+"=@=@")
			confirmacion(tipoDato,clase,id_da()+"=@"+id_contrato()+"=@"+codigo_da()+"=@"+marca_da()+"=@"+modelo_da()+"=@"+prov_da()+"=@"+tipo_da()+"=@=@"+punto_da()+"=@"+status_da()+"=@"+formatdate(fecha_act_da())+"=@=@"+servicioacc4000_agregar()+"=@"+document.f1.nota2.value+"=@=@"); 
		}
		break;
	case "cablemodem_i":
		if(validaCampo(document.f1.id_cm,isAlphanumeric) && validaCampo(document.f1.codigo_cm,isTexto) && validaCampo(document.f1.marca_cm,isSelect) && validaCampo(document.f1.modelo_cm,isSelect) )
		{
		
			confirmacion(tipoDato,"cablemodem",id_cm()+"=@"+id_contrato()+"=@"+codigo_cm()+"=@"+marca_cm()+"=@"+modelo_cm()+"=@=@"+status_cm()+"=@"+formatdate(fecha_act_cm())+"=@"+obser_cm()+"=@"+nota1()+"=@"+nota2()+"=@"+document.f1.nota3.value+"=@");
		}
		break;
	case "equipo_sistema":
		if(validaCampo(document.f1.id_da,isAlphanumeric) && validaCampo(document.f1.codigo_da,isTexto) && validaCampo(document.f1.marca_da,isSelect) && validaCampo(document.f1.modelo_da,isSelect)&& validaCampo(document.f1.tipo_da,isSelect) && valida_tam_campo_deco_ana())
		{
			confirmacion(tipoDato,"equipo_sistema",id_da()+"=@"+id_contrato()+"=@"+codigo_da()+"=@"+marca_da()+"=@"+modelo_da()+"=@"+prov_da()+"=@"+tipo_da()+"=@=@"+punto_da()+"=@"+status_da()+"=@"+formatdate(fecha_act_da())+"=@"+obser_da()+"=@"+servicio()+"=@"+document.f1.nota2.value+"=@=@");
				
		}
		break;
		case "marca":
		if(validaCampo(document.f1.id_marca,isAlphanumeric) && validaCampo(document.f1.nombre_marca,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_marca()+"=@"+nombre_marca()+"=@"+verRadiostatus_marca()+"=@"+data()))
				document.f1.reset();
		}
		break;
		case "info_adic":
		
		if(validaCampo(document.f1.id_inf_a,isAlphanumeric) && validaCampo(document.f1.info_a,isSelect) && validaCampo(document.f1.desc_a,isTexto) )
		{
			if(document.f1.agregar_info_adic.value=="MODIFICAR"){
				tipoDato='modificar';
			}
			conexionPHP("administrar.php",clase,document.f1.id_inf_a.value+"=@"+id_contrato()+"=@"+document.f1.info_a.value+"=@"+document.f1.desc_a.value+"=@",tipoDato);
		}
		break;
	case "promocion":
		if(validaCampo(document.f1.id_promo,isAlphanumeric) && validaCampo(document.f1.nombre_promo,isTexto) && valdate(fecha_promo()) && valdate(inicio_promo()) && valdate(fin_promo()) && validaCampo(document.f1.mes_promo,isSelect) && validaCampo(document.f1.tipo_promo,isSelect) && validaCampo(document.f1.descuento_promo,isNumber) && validaCampo(document.f1.login,isAlphanumeric) && valida_promo_serv())
		{
			if(confirmacion(tipoDato,clase,id_promo()+"=@"+nombre_promo()+"=@"+formatdate(fecha_promo())+"=@"+formatdate(inicio_promo())+"=@"+formatdate(fin_promo())+"=@"+mes_promo()+"=@"+tipo_promo()+"=@"+descuento_promo()+"=@"+login()+"=@"+verRadiostatus_promo()+"=@"+data()+registrar_promo_serv()))
				document.f1.reset();
		}
		break;
	case "promo_serv":
		if(validaCampo(document.f1.id_serv,isAlphanumeric) && validaCampo(document.f1.id_promo,isAlphanumeric) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_serv()+"=@"+id_promo()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "promo_contrato":
	//	alerta(id_promo_con()+"=@"+id_contrato()+"=@"+id_promo()+"=@"+formatdate(inicio_promo())+"=@"+formatdate(fin_promo())+"=@"+login()+"=@"+verRadiostatus_promo_con()+"=@");
		if(validaCampo(document.f1.id_promo_con,isAlphanumeric) && validaCampo(document.f1.id_contrato,isAlphanumeric) && validaCampo(document.f1.id_promo,isSelect) && valdate(inicio_promo()) && valdate(fin_promo()) && validaCampo(document.f1.login,isAlphanumeric))
		{
			confirmacion(tipoDato,clase,id_promo_con()+"=@"+id_contrato()+"=@"+id_promo()+"=@"+formatdate(inicio_promo())+"=@"+formatdate(fin_promo())+"=@"+login()+"=@"+verRadiostatus_promo_con()+"=@");
		}
		break;
	case "convenio_pago":
		if(validaCampo(document.f1.id_conv,isAlphanumeric) && validaCampo(document.f1.id_contrato,isAlphanumeric) && valdate(fecha_conv()) && validaCampo(document.f1.obser_conv,isTexto) && validaCampo(document.f1.login,isAlphanumeric) &&  valida_fecha_convenio_pago())
		{
			confirmacion(tipoDato,clase,id_conv()+"=@"+formatdate(fecha_conv())+"=@"+obser_conv()+"=@"+login()+"=@"+verRadiostatus_conv()+"=@"+id_contrato()+verconvenio_pago())
				
		}
		break;
	case "conv_con":
		if(validaCampo(document.f1.id_conv_cont,isAlphanumeric) && validaCampo(document.f1.id_conv,isAlphanumeric) && validaCampo(document.f1.id_cont_serv,isAlphanumeric) && valdate(fecha_ven()) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_conv_cont()+"=@"+id_conv()+"=@"+id_cont_serv()+"=@"+formatdate(fecha_ven())+"=@"+data()))
				document.f1.reset();
		}
		break;
	/*case "asigna_recibo":
		if(validaCampo(document.f1.id_asig,isAlphanumeric) && validaCampo(document.f1.id_cobrador,isSelect) && valdate(fecha_asig()) && validaCampo(document.f1.login_asig,isAlphanumeric) && validaCampo(document.f1.desde,isTexto) && validaCampo(document.f1.hasta,isTexto) && validaCampo(document.f1.cantidad,isInteger) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_asig()+"=@"+id_cobrador()+"=@"+formatdate(fecha_asig())+"=@"+obser_asig()+"=@"+login_asig()+"=@"+desde()+"=@"+hasta()+"=@"+cantidad()+"=@"+data()+"=@"+document.f1.serie.value))
				document.f1.reset();
		}
		break;
	case "recibos":
		if(validaCampo(document.f1.nro_recibo,isTexto) && validaCampo(document.f1.id_asig,isAlphanumeric) && validaCampo(document.f1.id_rec,isAlphanumeric) && validaCampo(document.f1.status_pago,isAlphanumeric))
		{
			if(confirmacion(tipoDato,clase,nro_recibo()+"=@"+id_asig()+"=@"+id_rec()+"=@"+status_pago()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "recibe_recibo":
		if(val_recibe_fact() && validaCampo(document.f1.id_rec,isAlphanumeric) && validaCampo(document.f1.id_cobrador,isSelect) && valdate(fecha_rec()) && validaCampo(document.f1.login_rec,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,"recibe_recibo",id_rec()+"=@"+id_cobrador()+"=@"+formatdate(fecha_rec())+"=@"+obser_rec()+"=@"+login_rec()+"=@"+data()+recibe_fact("RECIBIDO","FACTURA")))
				document.f1.reset();
		}
		break;
	case "recibe_recibo_D":
		if(val_recibe_fact() && validaCampo(document.f1.id_rec,isAlphanumeric) && validaCampo(document.f1.id_cobrador,isSelect) && valdate(fecha_rec()) && validaCampo(document.f1.login_rec,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,"recibe_recibo",id_rec()+"=@"+id_cobrador()+"=@"+formatdate(fecha_rec())+"=@"+obser_rec()+"=@"+login_rec()+"=@"+data()+recibe_fact("DEVUELTO","FACTURA")))
				document.f1.reset();
		}
		break;
	case "recibe_recibo_A":
		if(val_recibe_fact() && validaCampo(document.f1.id_rec,isAlphanumeric) && validaCampo(document.f1.id_cobrador,isSelect) && valdate(fecha_rec()) && validaCampo(document.f1.login_rec,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,"recibe_recibo",id_rec()+"=@"+id_cobrador()+"=@"+formatdate(fecha_rec())+"=@"+obser_rec()+"=@"+login_rec()+"=@"+data()+recibe_fact("ANULADO","FACTURA")))
				document.f1.reset();
		}
		break;
	case "recibe_recibo_CON":
		if(val_recibe_fact() && validaCampo(document.f1.id_rec,isAlphanumeric) && validaCampo(document.f1.id_cobrador,isSelect) && valdate(fecha_rec()) && validaCampo(document.f1.login_rec,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,"recibe_recibo",id_rec()+"=@"+id_cobrador()+"=@"+formatdate(fecha_rec())+"=@"+obser_rec()+"=@"+login_rec()+"=@"+data()+recibe_fact("RECIBIDO",'CONTRATO')))
				document.f1.reset();
		}
		break;
	case "recibe_recibo_CON_D":
		if(val_recibe_fact() && validaCampo(document.f1.id_rec,isAlphanumeric) && validaCampo(document.f1.id_cobrador,isSelect) && valdate(fecha_rec()) && validaCampo(document.f1.login_rec,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,"recibe_recibo",id_rec()+"=@"+id_cobrador()+"=@"+formatdate(fecha_rec())+"=@"+obser_rec()+"=@"+login_rec()+"=@"+data()+recibe_fact("DEVUELTO",'CONTRATO')))
				document.f1.reset();
		}
		break;
	case "recibe_recibo_CON_A":
		if(val_recibe_fact() && validaCampo(document.f1.id_rec,isAlphanumeric) && validaCampo(document.f1.id_cobrador,isSelect) && valdate(fecha_rec()) && validaCampo(document.f1.login_rec,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,"recibe_recibo",id_rec()+"=@"+id_cobrador()+"=@"+formatdate(fecha_rec())+"=@"+obser_rec()+"=@"+login_rec()+"=@"+data()+recibe_fact("ANULADO",'CONTRATO')))
				document.f1.reset();
		}
		break;
	case "recibe_recibo_eliminar":
		if(val_recibe_fact() && validaCampo(document.f1.id_rec,isAlphanumeric) && validaCampo(document.f1.id_cobrador,isSelect) && valdate(fecha_rec()) && validaCampo(document.f1.login_rec,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,"recibe_recibo",id_rec()+"=@"+id_cobrador()+"=@"+formatdate(fecha_rec())+"=@"+obser_rec()+"=@"+login_rec()+"=@"+data()+eliminar_recibe_fact()))
				document.f1.reset();
		}
		break;*/
	case "pagodeposito":
		if(validaCampo(document.f1.id_pd,isAlphanumeric) && validaCampo(document.f1.id_contrato,isAlphanumeric) && valdate(fecha_reg()) && validaCampo(document.f1.hora_reg,isTexto) && validaCampo(document.f1.login_reg,isAlphanumeric) && valdate(fecha_dep()) && validaCampo(document.f1.banco,isSelect) && validaCampo(document.f1.numero_ref,isTexto) && valdate(fecha_conf()) && validaCampo(document.f1.hora_conf,isTexto) && validaCampo(document.f1.login_conf,isAlphanumeric) && validaCampo(document.f1.status_pd,isName) && valdate(fecha_proc())  && validaCampo(document.f1.login_proc,isAlphanumeric) && validaCampo(document.f1.monto_dep,isNumber))
		{
			if(confirmacion(tipoDato,clase,id_pd()+"=@"+id_contrato()+"=@"+formatdate(fecha_reg())+"=@"+hora_reg()+"=@"+login_reg()+"=@"+formatdate(fecha_dep())+"=@"+banco()+"=@"+numero_ref()+"=@"+formatdate(fecha_conf())+"=@"+hora_conf()+"=@"+login_conf()+"=@"+status_pd()+"=@"+formatdate(fecha_proc())+"=@"+verRadiotipo_dt()+"=@"+login_proc()+"=@"+monto_dep()+"=@"+cedula_titular()+"=@"+document.f1.obser_p.value))
				document.f1.reset();
		}
		break;
	
	case "conf_comision":
		if(validaCampo(document.f1.pago_comisones,isAlphanumeric) && validaCampo(document.f1.id_franq,isSelect) && valdate(fecha_confc()) && validaCampo(document.f1.status_confc,isAlphanumeric) && validaCampo(document.f1.porc_acord,isNumber)  && validaCampo(document.f1.porc_ret_iva,isNumber) && validaCampo(document.f1.porc_ret_islr,isNumber) && validaCampo(document.f1.descuento_conf,isNumber)  && validaCampo(document.f1.represen_confc,isName) )
		{
			if(confirmacion(tipoDato,clase,pago_comisones()+"=@"+id_franq()+"=@"+formatdate(fecha_confc())+"=@"+status_confc()+"=@"+porc_acord()+"=@"+porc_com_reca()+"=@"+porc_com_venta()+"=@"+porc_ret_iva()+"=@"+porc_ret_islr()+"=@"+descuento_conf()+"=@"+verRadiotipo_e_p()+"=@"+empresa_confc()+"=@"+rif_empresa()+"=@"+represen_confc()+"=@"+cedula_rep()+"=@"+desc_confc()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "pago_comisones":
		if(validaCampo(document.f1.id_pago_com,isAlphanumeric) && validaCampo(document.f1.id_confc,isSelect) && validaCampo(document.f1.nro_comprob,isAlphanumeric) && valdate(fecha_pc()) && valdate(p_desde()) && valdate(p_hasta()) && validaCampo(document.f1.total_cob_sis,isNumber) && validaCampo(document.f1.por_comision,isNumber) && validaCampo(document.f1.monto_comision,isNumber) && validaCampo(document.f1.monto_ret_iva,isNumber) && validaCampo(document.f1.monto_ret_islr,isNumber) && validaCampo(document.f1.total_reintegro,isNumber) && validaCampo(document.f1.monto_desc,isNumber) && validaCampo(document.f1.total_deposito,isNumber) && validaCampo(document.f1.realizado_por,isAlphanumeric) && validaCampo(document.f1.registrado_por,isAlphanumeric) && validaCampo(document.f1.pagado_por,isAlphanumeric) && validaCampo(document.f1.status_pago_com,isAlphanumeric) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_pago_com()+"=@"+id_confc()+"=@"+nro_comprob()+"=@"+formatdate(fecha_pc())+"=@"+formatdate(p_desde())+"=@"+formatdate(p_hasta())+"=@"+total_cob_sis()+"=@"+por_comision()+"=@"+monto_comision()+"=@"+monto_ret_iva()+"=@"+monto_ret_islr()+"=@"+total_reintegro()+"=@"+monto_desc()+"=@"+total_deposito()+"=@"+realizado_por()+"=@"+registrado_por()+"=@"+pagado_por()+"=@"+status_pago_com()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "servidor":
		if(validaCampo(document.f1.id_servidor,isAlphanumeric) && validaCampo(document.f1.nombre_servidor,isTexto) && validaCampo(document.f1.direc_servidor,isTexto) && validaCampo(document.f1.direccio_ip,isTexto) && validaCampo(document.f1.usuario_p,isTexto) && validaCampo(document.f1.clave_p,isTexto) && validaCampo(document.f1.database,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_servidor()+"=@"+nombre_servidor()+"=@"+direc_servidor()+"=@"+verRadiostatus_servidor()+"=@"+verRadiosincronizar()+"=@"+verRadiostatus_ser()+"=@"+direccio_ip()+"=@"+usuario_p()+"=@"+clave_p()+"=@"+database()))
				document.f1.reset();
		}
		break;
	case "inicial_id":
		alerta(id_inicial_id()+"=@"+id_servidor()+"=@"+inicial()+"=@"+status()+"=@"+data());
		if(validaCampo(document.f1.id_inicial_id,isAlphanumeric) && validaCampo(document.f1.id_servidor,isSelect) && validaCampo(document.f1.inicial,isAlphabetic) && validaCampo(document.f1.status,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_inicial_id()+"=@"+id_servidor()+"=@"+inicial()+"=@"+status()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "sincronizacion_servi":
		document.f1.registrar.disabled=true;
		confirmacion(tipoDato,clase,id_sinc()+"=@=@=@=@=@=@=@");
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">SINCRONIZANDO SERVIDORES POR FAVOR ESPERE!!!<span class="fuente"><br>Esto puede Tardar varios minutos<br><img id="loading" src="imagenes/loading.gif"><br></span></div>';
		
		break;
	case "descuento_pronto_pag":
		if(validaCampo(document.f1.id_dpp,isAlphanumeric) && validaCampo(document.f1.id_franq,isSelect) && validaCampo(document.f1.dia_dpp,isSelect) && validaCampo(document.f1.monto_dpp,isNumber) && validaCampo(document.f1.obser_dpp,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_dpp()+"=@"+id_franq()+"=@"+dia_dpp()+"=@"+monto_dpp()+"=@"+id_serv_dpp()+"=@"+verRadiostatus_dpp()+"=@"+obser_dpp()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "orden_tabla_cortes":
		if(validaCampo(document.f1.id_tc,isAlphanumeric) && validaCampo(document.f1.id_orden,isAlphanumeric) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_tc()+"=@"+id_orden()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "tabla_cortes":
		if(validaCampo(document.f1.id_tc,isAlphanumeric) && validaCampo(document.f1.id_franq,isSelect) && valdate(fecha_tc()) && valdate(id_gt()) && validaCampo(document.f1.obser_tc,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_tc()+"=@"+id_franq()+"=@"+formatdate(fecha_tc())+"=@"+formatdate(id_gt())+"=@"+obser_tc()+"=@"+verRadiostatus_tc()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "cuenta_bancos":
		if(validaCampo(document.f1.id_cb,isAlphanumeric) && validaCampo(document.f1.banco,isSelect) && valdate(fecha_cb()) && validaCampo(document.f1.tipo_db,isSelect) && validaCampo(document.f1.referencia_db,isTexto) && validaCampo(document.f1.monto_db,isNumber) && validaCampo(document.f1.descrip_db,isTexto) && validaCampo(document.f1.status_db,isTexto) && validaCampo(document.f1.tipo_cb,isSelect) && validaCampo(document.f1.relacion_cb,isTexto) && validaCampo(document.f1.login_conf,isAlphanumeric) && valdate(fecha_reg()) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_cb()+"=@"+banco()+"=@"+formatdate(fecha_cb())+"=@"+tipo_db()+"=@"+referencia_db()+"=@"+monto_db()+"=@"+descrip_db()+"=@"+status_db()+"=@"+tipo_cb()+"=@"+relacion_cb()+"=@"+login_conf()+"=@"+formatdate(fecha_reg())+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "conciliacion_pago":
		if(validaCampo(document.f1.id_conc,isAlphanumeric) && validaCampo(document.f1.id_franq,isSelect) && valdate(fecha_conc()) && validaCampo(document.f1.banco,isSelect) && validaCampo(document.f1.refer_conc,isTexto) && validaCampo(document.f1.monto_conc,isNumber) && validaCampo(document.f1.status_conc,isTexto) && validaCampo(document.f1.login_conc,isAlphanumeric) && validaCampo(document.f1.obser_conc,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_conc()+"=@"+id_franq()+"=@"+formatdate(fecha_conc())+"=@"+banco()+"=@"+refer_conc()+"=@"+monto_conc()+"=@"+status_conc()+"=@"+login_conc()+"=@"+obser_conc()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "asigna_llamada":
		if(validaCampo(document.f1.id_all,isAlphanumeric) && validaCampo(document.f1.ubica_all,isTexto) && valdate(fecha_all()) && validaCampo(document.f1.login_enc,isAlphanumeric) && validaCampo(document.f1.login_resp,isAlphanumeric) && validaCampo(document.f1.obser_all,isTexto) && validaCampo(document.f1.status_all,isName) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_all()+"=@"+ubica_all()+"=@"+formatdate(fecha_all())+"=@"+login_enc()+"=@"+login_resp()+"=@"+obser_all()+"=@"+status_all()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "asig_lla_cli":
		if(validaCampo(document.f1.id_lc,isAlphanumeric) && validaCampo(document.f1.id_all,isAlphanumeric) && validaCampo(document.f1.id_contrato,isAlphanumeric) && validaCampo(document.f1.id_lla,isAlphanumeric) && validaCampo(document.f1.status_lc,isName) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_lc()+"=@"+id_all()+"=@"+id_contrato()+"=@"+id_lla()+"=@"+status_lc()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "tipo_llamada":
		if(validaCampo(document.f1.id_tll,isAlphanumeric) && validaCampo(document.f1.nombre_tll,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_tll()+"=@"+nombre_tll()+"=@"+verRadiostatus_tll()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "llamadas":
		//alert(id_lla()+"=@"+id_drl()+"=@"+id_tll()+"=@"+id_contrato()+"=@"+formatdate(fecha_lla())+"=@"+hora_lla()+"=@"+login()+"=@"+obser_lla()+"=@"+verRadiocrea_alarma()+"=@"+data())
		if(validaCampo(document.f1.id_lla,isAlphanumeric) && validaCampo(document.f1.id_drl,isSelect) && validaCampo(document.f1.id_tll,isSelect) && validaCampo(document.f1.id_contrato,isAlphanumeric) && valdate(fecha_lla()) && validaCampo(document.f1.hora_lla,isTexto) && validaCampo(document.f1.login,isAlphanumeric) && validaCampo(document.f1.obser_lla,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_lla()+"=@"+id_drl()+"=@"+id_tll()+"=@"+id_contrato()+"=@"+formatdate(fecha_lla())+"=@"+hora_lla()+"=@"+login()+"=@"+obser_lla()+"=@"+verRadiocrea_alarma()+"=@"+id_lc()))
				document.f1.reset();
		}
		break;
	case "detalle_resp":
		if(validaCampo(document.f1.id_drl,isAlphanumeric) && validaCampo(document.f1.id_trl,isSelect) && validaCampo(document.f1.nombre_drl,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_drl()+"=@"+id_trl()+"=@"+nombre_drl()+"=@"+verRadiostatus_drl()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "tipo_resp":
		if(validaCampo(document.f1.id_trl,isAlphanumeric) && validaCampo(document.f1.nombre_trl,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_trl()+"=@"+nombre_trl()+"=@"+verRadiostatus_trl()+"=@"+data()))
				document.f1.reset();
		}
		break;
		case "marca":
		if(validaCampo(document.f1.id_marca,isAlphanumeric) && validaCampo(document.f1.nombre_marca,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_marca()+"=@"+nombre_marca()+"=@"+verRadiostatus_marca()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "deco_servicio":
		if(validaCampo(document.f1.id_cont_serv,isAlphanumeric) && validaCampo(document.f1.id_da,isAlphanumeric) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_cont_serv()+"=@"+id_da()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "interfazacc":
		if(validaCampo(document.f1.id_accquery,isAlphanumeric) && validaCampo(document.f1.serial_deco,isAlphanumeric) && validaCampo(document.f1.comando_acc,isSelect) && valdate(fecha_accquery()) && validaCampo(document.f1.dato,isTexto) && valida_tam_campo())
		{
			if(confirmacion(tipoDato,clase,id_accquery()+"=@"+serial_deco()+"=@"+comando_acc()+"=@"+verRadiostatus_accquery()+"=@"+formatdate(fecha_accquery())+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "interfaz_cablemodem":
		
		if(validaCampo(document.f1.id_accquery,isAlphanumeric) && validaCampo(document.f1.serial_deco,isAlphanumeric) && validaCampo(document.f1.comando_acc,isSelect) && valdate(fecha_accquery()) && validaCampo(document.f1.dato,isTexto))
		{
			if(nro_contrato()==''){
				alert("El cable moden debe estar asignado a un contrato para ejecutar comandos");
			}else{
				if(confirmacion(tipoDato,clase,id_accquery()+"=@"+serial_deco()+"=@"+comando_acc()+"=@"+verRadiostatus_accquery()+"=@"+formatdate(fecha_accquery())+"=@"+data()))
					document.f1.reset();
			}
		}
		break;
	case "modelo":
		if(validaCampo(document.f1.id_modelo,isAlphanumeric) && validaCampo(document.f1.id_marca,isSelect) && validaCampo(document.f1.nombre_modelo,isTexto) && validaCampo(document.f1.id_tse,isSelect) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_modelo()+"=@"+id_marca()+"=@"+nombre_modelo()+"=@"+id_tse()+"=@"+verRadiostatus_modelo()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "detalle_tipopago_df":
		if(validaCampo(document.f1.id_dbf,isAlphanumeric) && validaCampo(document.f1.id_tipo_pago,isSelect) && validaCampo(document.f1.id_cuba,isSelect) && validaCampo(document.f1.id_df_tp,isSelect) && valdate(fecha_dbf()) && validaCampo(document.f1.refer_dbf,isInteger) && validaCampo(document.f1.monto_dbf,isNumber) && validaCampo(document.f1.obser_dbf,isTexto) && validaCampo(document.f1.hora_dbf,isTexto) && validaCampo(document.f1.login_dbf,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_dbf()+"=@"+id_tipo_pago()+"=@"+id_cuba()+"=@"+id_df_tp()+"=@"+formatdate(fecha_dbf())+"=@"+refer_dbf()+"=@"+monto_dbf()+"=@"+obser_dbf()+"=@"+status_dbf()+"=@"+hora_dbf()+"=@"+login_dbf()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "carga_tabla_banco":
		if(validaCampo(document.f1.id_ctb,isAlphanumeric) && validaCampo(document.f1.id_cuba,isSelect) && valdate(fecha_ctb()) && validaCampo(document.f1.hora_ctb,isTexto) && validaCampo(document.f1.login_ctb,isTexto) && valdate(fecha_desde_ctb()) && valdate(fecha_hasta_ctb()) && validaCampo(document.f1.status_ctb,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			confirmacion(tipoDato,clase,id_ctb()+"=@"+id_cuba()+"=@"+formatdate(fecha_ctb())+"=@"+hora_ctb()+"=@"+login_ctb()+"=@"+formatdate(fecha_desde_ctb())+"=@"+formatdate(fecha_hasta_ctb())+"=@"+status_ctb()+"=@"+document.f1.formato_ctb.value);
		}
		break;
	case "tabla_bancos":
		if(validaCampo(document.f1.id_tb,isAlphanumeric) && validaCampo(document.f1.id_ctb,isAlphanumeric) && valdate(fecha_tb()) && validaCampo(document.f1.tipo_tb,isTexto) && validaCampo(document.f1.referencia_tb,isTexto) && validaCampo(document.f1.monto_tb,isNumber) && validaCampo(document.f1.descrip_tb,isTexto) && validaCampo(document.f1.status_tb,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_tb()+"=@"+id_ctb()+"=@"+formatdate(fecha_tb())+"=@"+tipo_tb()+"=@"+referencia_tb()+"=@"+monto_tb()+"=@"+descrip_tb()+"=@"+status_tb()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "tipo_pago_df":
		if(validaCampo(document.f1.id_tipo_pago,isAlphanumeric) && validaCampo(document.f1.tipo_pago,isTexto) && validaCampo(document.f1.tipo_tp,isSelect) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion(tipoDato,clase,id_tipo_pago()+"=@"+tipo_pago()+"=@"+tipo_tp()+"=@"+verRadiostatus_pago()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "autorizar_abrir_caja":
		if(validaCampo(document.f1.id_franq,isSelect))
		{
			conexionPHP('informacion.php',"autorizar_abrir_caja",id_franq());
				
		}
		break;
	case "cuenta_bancaria":
		if(validaCampo(document.f1.id_cuba,isAlphanumeric) && validaCampo(document.f1.numero_cuba,isTexto) && validaCampo(document.f1.banco_cuba,isTexto) && validaCampo(document.f1.abrev_cuba,isTexto) && validaCampo(document.f1.formato_archivo,isSelect) && validaCampo(document.f1.comision_pv,isNumber) && validaCampo(document.f1.comision_pv_c,isNumber))
		{
			confirmacion(tipoDato,clase,id_cuba()+"=@"+numero_cuba()+"=@"+banco_cuba()+"=@"+abrev_cuba()+"=@"+desc_cuba()+"=@"+verRadiostatus_cuba()+"=@"+verRadioconc_cliente()+"=@"+verRadioconc_franq()+"=@"+formato_archivo()+"=@"+document.f1.comision_pv.value+"=@"+document.f1.comision_pv_c.value);
				
		}
		break;
	default:
		verificarAplicaTem(tipoDato,clase);
  }
}
//para que el usuario confirme antes de enviar el formulario
function confirmacion(tipoDato,clase,cadena){
		
	
	new BootstrapDialog({
		title: 'CONFIRMACIÓN DE SAECO',
		message: 'Seguro que desea enviar este formulario?',
		type: BootstrapDialog.TYPE_INFO,
		closable: false,
		buttons: [{
			label: 'NO',
			icon: 'glyphicon glyphicon-thumbs-down',
			cssClass: 'btn-danger',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
				dialog.close();
			}
		}, {
			label: 'SI',
			icon : 'glyphicon glyphicon-thumbs-up',
			cssClass: 'btn-info',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
				conexionPHP("administrar.php",clase,cadena,tipoDato);
				dialog.close();
			}
		}]
	}).open();
	
}
//para que el usuario confirme antes de enviar el formulario
function confirmacion_form_externo(tipoDato,clase,cadena){		
	
	
	new BootstrapDialog({
		title: 'CONFIRMACIÓN DE SAECO',
		message: 'Seguro que desea enviar este formulario?',
		type: BootstrapDialog.TYPE_INFO,
		closable: false,
		buttons: [{
			label: 'NO',
			icon: 'glyphicon glyphicon-thumbs-down',
			cssClass: 'btn-danger',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
				dialog.close();
			}
		}, {
			label: 'SI',
			icon : 'glyphicon glyphicon-thumbs-up',
			cssClass: 'btn-info',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
				conexionPHP('informacion_externo.php',clase,cadena);
				dialog.close();
			}
		}]
	}).open();
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
				/*
				if(cont==0){
					cade=trim(document.f1.modulo[i].value)+"=@"+codigo()+"=@"+incluir+"=@"+modificar+"=@"+eliminar;
				}
				else
				{
				*/	cade=cade+"-Class-"+tipoDato+"=@modulo_perfil=@"+trim(document.f1.modulo[i].value)+"=@"+codigo()+"=@"+incluir+"=@"+modificar+"=@"+eliminar;
				//}
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
			/*	if(cont==0){
					cade=codigo()+"=@"+trim(document.f1.modulo[i].value)+"=@"+incluir+"=@"+modificar+"=@"+eliminar;
				}
				else
				{*/
					cade=cade+"-Class-"+tipoDato+"=@modulo_perfil=@"+codigo()+"=@"+trim(document.f1.modulo[i].value)+"=@"+incluir+"=@"+modificar+"=@"+eliminar;
			//	}
				cont++;
			}
		}
		
	}
	if(cade!=''){
		return cade;
		//conexionPHP("administrar.php","modulo_perfil",cade,tipoDato);
	}
}
function valida_nro_control(){
	conexionPHP('informacion.php',"valida_nro_control",nro_control()+"=@"+id_persona());
}
function valida_num_ref(){
	conexionPHP('informacion.php',"valida_num_ref",numero_ref()+"=@"+banco());
}
/*
function cargar_marca_modelo(){
	conexionPHP('informacion.php',"cargar_marca",id_tse());
	conexionPHP('informacion.php',"cargar_modelo",id_tse());
}
*/
function cargar_modelo_m(){
	conexionPHP('informacion.php',"cargar_modelo_m",id_marca());
}
function cargarZona(){
	conexionPHP('informacion.php',"cargarZona",id_ciudad());
}
function traerFranq(){
	conexionPHP('informacion.php',"traerFranq",id_zona());
}
function traer_sistema_marca(){
	conexionPHP('informacion.php',"traer_sistema_marca",id_modelo());
}
function traerFranqSer(){
	conexionPHP('informacion.php',"traerFranqSer",id_tipo_servicio());
}
function cargarSector(){
	conexionPHP('informacion.php',"cargarSector",id_zona());
}
function cargarCalle(){
	conexionPHP('informacion.php',"cargarCalle",id_sector());
	if(claseGlobal=='act_contrato'){
		conexionPHP('informacion.php',"cargarUrb",id_sector());
		conexionPHP('informacion.php',"cargarEdif",id_sector());}
}
function cargarUrb(){
	//conexionPHP('informacion.php',"cargarUrb",id_sector());
}
function traer_ciudad(){
	conexionPHP('informacion.php',"traer_ciudad",id_zona());
}
function traerZona(){
	conexionPHP('informacion.php',"traerZona",id_sector());
	if(claseGlobal!="calle" && claseGlobal!="urbanizacion"){
	//	cargarCalle();
	}
}

function traerSector(){
	conexionPHP('informacion.php',"traerSector",id_calle());
	if(claseGlobal=="contrato" || claseGlobal=="act_contrato"){
		cargarEdif();
		
	}
}

function traer_decuento(){
	conexionPHP('informacion.php',"traer_decuento",id_franq());
}

function traer_equipo_fiscal(){
	conexionPHP('informacion.php',"traer_equipo_fiscal",id_franq());
}

function traerSectorUrb(){
	//conexionPHP('informacion.php',"traerSectorUrb",urbanizacion());
	
}
function traerCalle(){
	//conexionPHP('informacion.php',"traerCalle",edificio());
}
function cargarEdif(){
	//conexionPHP('informacion.php',"cargarEdif",id_calle());
}
function agregarPaquete(){
	conexionPHP('informacion.php',"agregarPaquete",id_calle());
}

function cargarServicioMensual(){
	conexionPHP('informacion.php',"cargarServicioMensual",id_tipo_servicio());
}
function cargar_servicio_tv(){
	conexionPHP('informacion.php',"cargar_servicio_tv",id_cant());
}
function cargarServicio(){
	conexionPHP('informacion.php',"cargarServicio",id_tipo_servicio());
}
function cargarTipoSer(){
	conexionPHP('informacion.php',"cargarTipoSer",id_franq());
}
function cargarServicio(){
	conexionPHP('informacion.php',"cargarServicio",id_tipo_servicio());
}
function traerTipoSer(){
	conexionPHP('informacion.php',"traerTipoSer",id_serv());
}
function cargarDO(){
	conexionPHP('informacion.php',"cargarDO",id_tipo_orden());
}
function cargarDO1(){
	conexionPHP('informacion.php',"cargarDO1",id_tipo_orden());
}
function traerTO(){
	conexionPHP('informacion.php',"traerTO",id_det_orden());
}
function verificaStock(){
	if(parseInt(cant_ent_sal())<=0){
		alerta("Error, la cantidad debe ser mayor que cero(0).");
		document.f1.cant_ent_sal.value="";
	}
	if(parseInt(cant_existencia())<parseInt(cant_ent_sal())){
		alerta("Error, no hay suficente material en almacen para esta salida verifique el Stock.");
		document.f1.cant_ent_sal.value="";
	}
}
function tCodContSer(){
	conexionPHP('informacion.php',"tCodContSer");
}


function eliminarClase(clase,parametros){
	
	var cont=0;
	cade='';
	var para="";
	for (i=0;i<parametros-1;i++) {
		para=para+"=@";
	}
	//alerta(para);
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
				if(cont==0){
					cade=document.f1.checkbox[i].value+para;
				}
				else
				{
					cade=cade+"-Class-eliminar=@"+clase+"=@"+document.f1.checkbox[i].value+para;
				}
				cont++;
		}
	}
	if(cade!='')
	{
		if (confirm("Confirma que desea eliminar estos datos?")){
			conexionPHP("administrar.php",clase,cade,'eliminar');
		}
	}
	else{
		alerta("Error, debe seleccionar al menos un Item de la lista.");
	}
}


function calcularMontofactura(){
	var porc_reten=parseFloat(document.f1.porc_reten.value)+0;
	if(porc_reten>=0 && porc_reten<=100){
		
		var base=parseFloat(document.f1.base_imp.value)+0;
		por_iva=12;
		por_islr=2;
		var monto_reten=0;
		var iva=0;
		if(document.f1.a_iva.checked==true){
			iva=(base*por_iva)/100;
		}
		
		var islr=0;
		
		if(document.f1.islr.checked==true){
			islr=(base*por_islr)/100;
		}
		else{
			islr=0;
		}
		if(porc_reten>0){
			monto_reten = (iva*porc_reten)/100;
			document.f1.monto_reten.value=monto_reten;
		
		}
		document.f1.base_imp.value=base;
		document.f1.monto_iva.value=iva;
		
		document.f1.monto_islr.value=islr;
		//document.f1.monto_pago.value=base+iva-islr-monto_reten;
		document.f1.monto_tp.value = base+iva-islr-monto_reten;
	}
	else{
		alerta("Error, debe introducir un porcentaje de retención del 0 al 100.");
		document.f1.porc_reten.value='0';
	}
}

function habilita_iva(){
	if(document.f1.a_iva.checked==true){
		//document.f1.islr.disabled=false;
		document.f1.reten.disabled=false;
	}
	else{
		//document.f1.islr.disabled=true;
		document.f1.reten.disabled=true;
		document.f1.monto_iva.value=0;
		document.f1.porc_reten.value=0;
		document.f1.monto_reten.value=0;
		document.f1.monto_islr.value=0;
	}
	calcularMontoPago();
}
function habilita_reten(){
	if(document.f1.reten.checked==true){
		document.f1.porc_reten.disabled=true;
		document.f1.porc_reten.value='75';
		calcularMontofactura();
		//document.f1.porc_reten.select();
	}
	else{
		document.f1.porc_reten.value='0';
		document.f1.monto_reten.value='0';
		document.f1.porc_reten.disabled=true;
		calcularMontofactura();
	}
}

function abrirBusq_cont_avanz(){
	creaVenta("busq_cont_avanz.php",860,600);
}
function abrirBusq_cont_avanz_todo(){
	//alerta('hola');
	creaVenta("busq_cont_avanz_todo.php",860,600);
}
function abrirBusq_cont_avanz_mat(){
	creaVenta("busq_cont_avanz_mat.php",960,600);
}
function respRefActCont(id_contrato){
	//id_cont_act_c=id_contrato;
	var myWidth=960
		var myHeight=600
		var myLeft = (screen.width-myWidth)/2;
		var myTop = ((600-myHeight)/2);
	var venta1 = window.open("datos_contrato.php?d="+id_contrato,"", 'left='+myLeft+',top='+myTop+',width='+myWidth+',height='+myHeight+',menubar=0,scrollbars=1');
	
}

function RESPREFACT_CONT(id_contrato){
	respRefActCont(id_contrato)
}
function valida_monto_nc(){
	var monto_pago=parseFloat(document.f1.monto_pago.value);
	
	if(monto_pago<=0){
		alerta("Error, debe colocar el monto de la Nota de Credito");
		return false;
	}else{
		return true;
	}
	
}
function cargarDetTipoPago(){
	if(id_tipo_pago()=="TPA00001"){
		
		document.f1.banco.disabled=true;
		document.f1.numero.disabled=true;
		
		document.f1.banco.value='';
		document.f1.numero.value='';
	}
	else{
		document.f1.banco.disabled=false;
		document.f1.numero.disabled=false;
	}
}

function cargar_demo_fiscal(){
								if(tipo_facturacion=="BIXOLON"){
									creaVenta("http://localhost/fiscal/Tfhka/DemoTfhkaPHP.php?&id_caja_cob="+id_caja_cob+"&",800,600);
								}
								else if(tipo_facturacion=="EPSON"){
									conexionPHP('formulario.php','cierre_x_fecha');
								}
}
function ReImprimirRep_detcob(id_caja_cob){
		//location.href="reportes/Rep_detallecobrosImpreso.php?&id_caja_cob="+id_caja_cob+"&";
		//creaVenta("reportes/Rep_detallecobrosImpreso.php?&id_caja_cob="+id_caja_cob+"&",1000,700);
}
function ImprimirRep_detcob(id_caja_cob){
		//location.href="reportes/Rep_detallecobrosImpreso.php?&id_caja_cob="+id_caja_cob+"&";
		//creaVenta("reportes/Rep_detallecobrosImpreso.php?&id_caja_cob="+id_caja_cob+"&",1000,700);
		conexionAJAX("ReporteJava/Rep_detallecobrosImpreso.php?&id_caja_cob="+id_caja_cob+"&");
}

function ImprimirRep_detallecobros(){
		//location.href="reportes/Rep_detallecobrosImpreso.php?&id_caja_cob="+id_caja_cob()+"&cierre_caja="+cierre_caja()+"&monto_acum="+monto_acum()+"&";
		//creaVenta("reportes/Rep_detallecobrosImpreso.php?&id_caja_cob="+id_caja_cob()+"&cierre_caja="+cierre_caja()+"&monto_acum="+monto_acum()+"&",1000,700);
		location.href="reportepdf/Rep_detallecobrosImpreso.php?&id_caja_cob="+id_caja_cob()+"&cierre_caja="+cierre_caja()+"&monto_acum="+monto_acum()+"&";
}

function ImprimirRep_CierreDiario(){
		
	//conexionAJAX("ReporteJava/Rep_CierreDiarioImpreso.php?&obser_cierre="+obser_cierre()+"&");
	  location.href="reportepdf/Rep_CierreDiarioImpreso.php?&obser_cierre="+obser_cierre()+"&id_f="+document.f1.id_f.value+"&";
		
}
function ImprimirRep_CierreEquipo(id_cierre){
	 location.href="reportepdf/Rep_CierreEquipoImpreso.php?&id_cierre="+id_cierre+"&";
}
function GuardarRep_CierreDiario(){
	location.href="reportes/Rep_CierreDiarioImpreso.php?&obser_cierre="+obser_cierre()+"&";
		//creaVenta("reportes/Rep_CierreDiarioImpreso.php?&obser_cierre="+obser_cierre()+"&",1000,700);
}

function ImprimirRep_CierreDiario1(){
	//conexionAJAX("ReporteJava/Rep_CierreDiarioImpreso1.php?&obser_cierre="+obser_cierre()+"&");
	 location.href="reportepdf/Rep_CierreDiarioImpreso1.php?&obser_cierre="+obser_cierre()+"&";
}
function GuardarRep_CierreDiario1(){
	location.href="reportes/Rep_CierreDiarioImpreso1.php?&obser_cierre="+obser_cierre()+"&";
		//creaVenta("reportes/Rep_CierreDiarioImpreso1.php?&obser_cierre="+obser_cierre()+"&",1000,700);
}


function ImprimirRep_orden(){
		//location.href="reportes/Rep_ordenImpreso.php";
		creaVenta("reportes/Rep_ordenImpreso.php",1000,700);
}
function ver_factura_html(id_pago){
		//location.href="reportes/Rep_ordenImpreso.php";
		creaVenta("ver_factura_html.php?id_pago="+id_pago,700,500);
}
function finOrdenTec(id_orden,tipo_detalle,id_contrato,nro_contrato,nombre,nombre_tipo_orden,nombre_det_orden,etiqueta,comentario_orden,id_det_orden,id_tipo_orden,contrato_fisico){
	document.f1.nombre_det_orden.disabled=false;
	document.f1.etiqueta.value=trim(etiqueta);
	document.f1.tipo_detalle.value=trim(tipo_detalle);
	
	document.f1.id_orden.value=trim(id_orden);
	
	document.f1.id_contrato.value=trim(id_contrato);
	document.f1.nro_contrato.value=trim(nro_contrato);
	document.f1.nombre.value=trim(nombre);
	document.f1.nombre_tipo_orden.value=trim(id_tipo_orden);
	document.f1.nombre_det_orden.value=trim(nombre_det_orden);
	document.f1.comentario_orden.value=trim(comentario_orden);
	document.f1.contrato_fisico.value=trim(contrato_fisico);
	
		document.f1.etiqueta.disabled=false;
		document.f1.comentario_orden.disabled=false;
		document.f1.costo_dif_men.disabled=true;
	
	document.f1.registrar_ord.disabled=false;	
	document.f1.cancelar_ord.disabled=false;
	document.f1.devolver_ord.disabled=false;
	document.f1.btnvisita_ord.disabled=false;
	conexionPHP("informacion.php","trae_info_grupo",id_orden);
	id_det_orderG=trim(id_det_orden);
	conexionPHP('informacion.php',"cargarDOF",id_tipo_orden);
	conexionPHP('informacion.php',"traer_infor_orden",id_contrato);
	
}
function cancelarOrdenTec(){
		if(validaCampo(document.f1.id_orden,isAlphanumeric)   && validaCampo(document.f1.comentario_orden,isTexto)  && valdate(fecha_final()) && validainfo_grupo() ){
			if (confirm('Confirma que NO SE REALIZÓ esta orden de servicio?')){
				conexionPHP("administrar.php","ordenes_tecnicos",id_orden()+"=@"+id_gt()+"=@=@=@"+formatdate(fecha_final())+"=@=@"+comentario_orden()+"=@"+etiqueta()+"=@=@","canceladafinal");
			}
		}
}
function devolverOrdenTec(){
		if(validaCampo(document.f1.id_orden,isAlphanumeric)  && validaCampo(document.f1.comentario_orden,isTexto)  && validainfo_grupo() ){
			if (confirm('Confirma que desea devolver esta orden de servicio?')){
				conexionPHP("administrar.php","ordenes_tecnicos",id_orden()+"=@"+id_gt()+"=@=@=@"+formatdate(fecha_final())+"=@=@"+comentario_orden()+"=@"+etiqueta()+"=@=@","devolver");
			}
		}
}
function validainfo_grupo(){
	if(id_gt()==""){
		alerta("Error, debe seleccionar el grupo que realizo la orden.");
		return false;
	}
	else{
		return true;
	}
}
function imprimir_orden_sel(){
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
				cade=cade+trim(document.f1.checkbox[i].value)+"=@";
				cont++;
		}
	}
	if(cade!=''){
		if(valida_sel_automatica()){
				if (confirm("Confirma que desea Imprimir estas ordenes de servicios seleccionadas?")){
					if(planilla_orden_G==""){
						conexionAJAX("ReporteJava/imp_orden_serv_varias.php?&id_orden="+cade+"&id_gt="+id_gt()+"&asig_aut="+ver_asig_aut()+"&");
					}else{
						conexionAJAX("ReporteJava/imp_orden_serv_varias"+planilla_orden_G+".php?&id_orden="+cade+"&id_gt="+id_gt()+"&asig_aut="+ver_asig_aut()+"&");
						
					}
					
					setTimeout("cargaforimp()", 2000);
				}
		}
		
	}
	else{
		alerta("Error, debe seleccionar al menos un Item de la lista.");
	}
}

function imprimir_listado_corte(id_tc){

		location.href="reportepdf/imprimir_listado_corte.php?&id_tc="+id_tc+"&";

}
function imprimir_listado_llamada(id_all){

		location.href="reportepdf/imprimir_listado_llamada.php?&id_all="+id_all+"&";

}
function ver_det_listado_llamada(id_all){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/ver_det_listado_llamada.php?id_all="+id_all+"&";
			updateTable();
		
}
function imprimir_fact_sel(){
	var cont=0;
	cade='';
	var fact=parseInt(document.f1.deuda.value);
	
	for (i = 1; i < document.f1.checkbox.length; i++) {
				if(document.f1.checkbox[i].checked == true){
					//alerta(trim(document.f1.checkbox[i].value));
					cade=cade+"=@"+trim(document.f1.checkbox[i].value);
					cont++;
				}
	}
			
	if(cade!='')
	{
		if (confirm("Confirma que desea Imprimir estas facturas seleccionadas?")){
			
					if(document.f1.tipo.value=='C'){
						imprimir_fact_lotes(trim(cade),fact,i);
					}
					else{
						imprimir_fact_lotes_p(trim(cade),fact,i);
					}
						fact++;
		}
	}
	else{
		alerta("Error, debe seleccionar al menos un Item de la lista.");
	}
}
function imprimir_fact_lotes_p(id_contrato_serv,fact,i){
//location.href="reportes/impFactPagoRTF.php?&id_pago="+id_pago+"&";
conexionAJAX("ReporteJava/facturaPago_lotes_p.php?id_contrato_serv=VACIO"+id_contrato_serv+"&nro_fact="+fact+"&i="+i+"&");
}
function imprimir_fact_lotes(id_contrato_serv,fact,i){
//location.href="reportes/impFactPagoRTF.php?&id_pago="+id_pago+"&";
conexionAJAX("ReporteJava/facturaPago_lotes.php?id_contrato_serv=VACIO"+id_contrato_serv+"&nro_fact="+fact+"&i="+i+"&");
}
function cargaforimp(){
	conexionPHP('formulario.php','imprimir_ordenes_tecnicos');
}
function ver_asig_aut(){
	if(document.f1.checkgrupo.checked == true){
		return "t";
	}
	else{
		return "f";
	}
}
function reimprimirOrdenTecnicos(id_orden){
					if(planilla_orden_G==""){
						conexionAJAX("ReporteJava/imp_orden_serv.php?&id_orden="+id_orden+"&");
					}else{
						conexionAJAX("ReporteJava/imp_orden_serv"+planilla_orden_G+".php?&id_orden="+id_orden+"&");
					}
					
}

function asignar_grupo(){
	if(document.f1.id_orden.value==''){
		alerta("Error. debe cargar una orden.");
	}else{
		if(confirm('Confirma que desea reasignar el grupo de trabajo?')){
			conexionPHP("administrar.php","ordenes_tecnicos",document.f1.id_orden.value+"=@"+id_gt()+"=@=@=@=@=@=@=@=@","reasignar");
		}
	}
}

function revertir_imp(){
	
		if(confirm('Confirma que desea revertir a imprimir?')){
			conexionPHP("administrar.php","ordenes_tecnicos",document.f1.id_orden.value+"=@=@=@=@=@=@=@=@=@","revertir");
		}
	
}

function imprimirOrdenTec_dir(id_orden){
					if(planilla_orden_G==""){
						conexionAJAX("ReporteJava/imp_orden_serv.php?&id_orden="+id_orden+"&");
					}else{
						conexionAJAX("ReporteJava/imp_orden_serv"+planilla_orden_G+".php?&id_orden="+id_orden+"&");
					}
}

function finalizarOrdenTec(){
		if(validaCampo(document.f1.id_orden,isAlphanumeric) && valdate(fecha_final()) && validainfo_grupo() ){
			if (confirm('Confirma que desea Finalizar esta Orden de Servicio?')){
				//conexionPHP('informacion.php',"modificar_poste_cont",id_contrato()+"=@"+postel()+"=@"+pto());
				conexionPHP("administrar.php","ordenes_tecnicos",id_orden()+"=@"+id_gt()+"=@"+document.f1.nombre_det_orden.value+"=@=@"+formatdate(fecha_final())+"=@=@"+comentario_orden()+"=@"+etiqueta()+"=@=@","finalizar");
			}
		}
}
function finOrdenSel(){
	var cont=0;
	cade='';
	if(valdate(fecha_final()) && validainfo_grupo() ){
		for (i = 1; i < document.f1.checkbox.length; i++){
			if(document.f1.checkbox[i].checked == true){
					if(cont==0){
						cade=cade+trim(document.f1.checkbox[i].value)+"=@"+id_gt()+"=@=@=@"+formatdate(fecha_final())+"=@=@"+comentario_orden()+"=@"+etiqueta()+"=@=@ENGRUPO";
					}
					else{
						cade=cade+"-Class-finalizar=@ordenes_tecnicos=@"+trim(document.f1.checkbox[i].value)+"=@"+id_gt()+"=@=@=@"+formatdate(fecha_final())+"=@=@"+comentario_orden()+"=@"+etiqueta()+"=@=@ENGRUPO";
					}
					cont++;
			}
		}
		if(cade!='')
		{
			if (confirm("Confirma que desea finalizar estas ordenes de servicios?")){
				conexionPHP("administrar.php","ordenes_tecnicos",cade,"finalizar");
			}
		}
		else{
			alerta("Error, debe seleccionar al menos un Item de la lista.");
		}
	}
}
function ActualizarCampo(tabla,campo,valor,condicion,validacion){
	creaVenta("actualizar_campo.php?&tabla="+tabla+"&campo="+campo+"&valor="+valor+"&condicion="+condicion+"&validacion="+validacion+"&",500,500);
	//alerta(tabla+"=@"+campo+"=@"+valor+"=@"+condicion);
//	conexionPHP("informacion.php","ActualizarCampo",tabla+"=@"+campo+"=@"+valor+"=@"+condicion+"=@"+validacion);
}
function ActualizarDeuda(id_cont_serv){
	creaVenta("ActualizarDeuda.php?&id_cont_serv="+id_cont_serv+"&",500,500);
	//alerta(tabla+"=@"+campo+"=@"+valor+"=@"+condicion);
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
			alerta("Error, debe describir el motivo del cambio del cargo.");
		}
		else{
			parent.conexionPHP("informacion.php","ActualizarCampo",tabla+"=@"+campo+"=@"+document.f1.campo.value+"=@id_cont_serv=@"+condicion+"=@"+document.f1.motivo.value+"=@"+document.f1.comentario.value);
			parent.dhxWins.window("w2").close();
		}
	}
}

function activa_id_serv(){
	if(verRadiostatus()=="SI"){
		document.f1.id_serv.disabled=false;
		document.f1.id_serv.value='0';
	}
	else if(verRadiostatus()=="NO"){
		document.f1.id_serv.disabled=true;
	}
}



function buscarCortar(){
	/*
	verzonasmultiples();
	versectoresmultiples();
	*/
	if(validaCampo(document.f1.deuda,isInteger)){
		if(document.f1.checkgrupo.checked == true)
			var sd="";
		else 
			var sd="true";
		
		if(document.f1.checkdeposito.checked == true)
			var dep="";
		else 
			var dep="true";
		
		if(document.f1.checksalto.checked == true)
			var salto="SALTO";
		else 
			var salto="";

		archivoDataGrid="procesos/datagrid_status_contrato.php?&deuda="+document.f1.deuda.value+"&id_tipo_servicio="+id_tipo_servicio()+"&id_serv="+id_serv()+"&id_g_a="+id_g_a()+"&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+verzonasmultiples()+"&id_sector="+versectoresmultiples()+"&orden_list="+document.f1.orden_list.value+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&cod_id_persona="+document.f1.cod_id_persona.value+"&convenio="+document.f1.convenio.value+"&status_contrato="+estatusCheck()+"&sd="+sd+"&salto="+salto+"&dep="+dep+"&gen_fec="+verRadiotipo_costo()+"&desde1="+document.f1.desde1.value+"&hasta1="+document.f1.hasta1.value+"&por_fecha="+document.f1.por_fecha.value+"&tipo_lista="+document.f1.tipo_lista.value+"&tipo_fact="+document.f1.tipo_fact.value+"&";
		updateTable();
		document.f1.modificar2.disabled=false;
		document.f1.modificar1.disabled=false;
		document.f1.modificar.disabled=false;
		document.f1.eliminar.disabled=false;
		document.f1.eliminar1.disabled=false;
		document.f1.procesos_corte.disabled=false;
		document.f1.callcenter.disabled=false;
		
		
		
	}
}

function buscarlistado_llamada(){
	
	
		archivoDataGrid="procesos/datagrid_callcenter.php?&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+verzonasmultiples()+"&id_sector="+versectoresmultiples()+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+estatusCheck()+"&id_tll="+id_tll()+"&id_trl="+id_trl()+"&id_drl="+id_drl()+"&login_resp="+login_resp()+"&";
		updateTable();

}

function buscarlistado_llamada_asig(){
		divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
		archivoDataGrid="procesos/datagrid_llamadas_asig.php?&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&";
		updateTable();
		ajaxGrafico('llamada_asig_ubic','llamada_asig_ubic=@'+document.f1.desde.value+"=@"+document.f1.hasta.value);
}

function buscarlistado_llamada_asig_resp(){
		divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
		archivoDataGrid="procesos/datagrid_llamadas_asig_resp.php?&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&";
		updateTable();
		//alert('llamada_asig_resp=@'+document.f1.desde.value+"=@"+document.f1.hasta.value)
		ajaxGrafico('llamada_asig_resp','llamada_asig_resp=@'+document.f1.desde.value+"=@"+document.f1.hasta.value);
}

function guardar_cortar_servicio(){
	
	if(validaCampo(document.f1.deuda,isInteger)){
		document.f1.registrar.disabled=false;
		if(document.f1.checkgrupo.checked == true)
			var sd="";
		else 
			var sd="true";
		
		if(document.f1.checkdeposito.checked == true)
			var dep="";
		else 
			var dep="true";
		
		if(document.f1.checksalto.checked == true)
			var salto="SALTO";
		else 
			var salto="";
			
		location.href="reportepdf/cortar_servicio.php?&deuda="+document.f1.deuda.value+"&titulo_list="+document.f1.titulo_list.value+"&id_tipo_servicio="+id_tipo_servicio()+"&id_serv="+id_serv()+"&id_g_a="+id_g_a()+"&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+verzonasmultiples()+"&id_sector="+versectoresmultiples()+"&orden_list="+document.f1.orden_list.value+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&cod_id_persona="+document.f1.cod_id_persona.value+"&status_contrato="+estatusCheck()+"&sd="+sd+"&salto="+salto+"&order=" + tblorder + "&convenio="+document.f1.convenio.value+"&dep="+dep+"&gen_fec="+verRadiotipo_costo()+"&desde1="+document.f1.desde1.value+"&hasta1="+document.f1.hasta1.value+"&por_fecha="+document.f1.por_fecha.value+"&tipo_lista="+document.f1.tipo_lista.value+"&tipo_fact="+document.f1.tipo_fact.value+"&";
		
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
		
	}
}
function auditoria_por_poste(){
	
	if(validaCampo(document.f1.deuda,isInteger)){
		document.f1.registrar.disabled=false;
		if(document.f1.checkgrupo.checked == true)
			var sd="";
		else 
			var sd="true";
		
		if(document.f1.checkdeposito.checked == true)
			var dep="";
		else 
			var dep="true";
		
		if(document.f1.checksalto.checked == true)
			var salto="SALTO";
		else 
			var salto="";
			
		location.href="reportepdf/auditoria_por_poste.php?&deuda="+document.f1.deuda.value+"&titulo_list="+document.f1.titulo_list.value+"&id_tipo_servicio="+id_tipo_servicio()+"&id_serv="+id_serv()+"&id_g_a="+id_g_a()+"&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+verzonasmultiples()+"&id_sector="+versectoresmultiples()+"&orden_list="+document.f1.orden_list.value+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&cod_id_persona="+document.f1.cod_id_persona.value+"&status_contrato="+estatusCheck()+"&sd="+sd+"&salto="+salto+"&order=" + tblorder + "&convenio="+document.f1.convenio.value+"&dep="+dep+"&gen_fec="+verRadiotipo_costo()+"&desde1="+document.f1.desde1.value+"&hasta1="+document.f1.hasta1.value+"&por_fecha="+document.f1.por_fecha.value+"&tipo_lista="+document.f1.tipo_lista.value+"&tipo_fact="+document.f1.tipo_fact.value+"&";
		
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
		
	}
}
function guardar_cortar_servicio2(){
	
	if(validaCampo(document.f1.deuda,isInteger)){
		document.f1.registrar.disabled=false;
		if(document.f1.checkgrupo.checked == true)
			var sd="";
		else 
			var sd="true";
		
		if(document.f1.checkdeposito.checked == true)
			var dep="";
		else 
			var dep="true";
		
		if(document.f1.checksalto.checked == true)
			var salto="SALTO";
		else 
			var salto="";
			
		location.href="reportepdf/cortar_servicio2.php?&deuda="+document.f1.deuda.value+"&titulo_list="+document.f1.titulo_list.value+"&id_tipo_servicio="+id_tipo_servicio()+"&id_serv="+id_serv()+"&id_g_a="+id_g_a()+"&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+verzonasmultiples()+"&id_sector="+versectoresmultiples()+"&orden_list="+document.f1.orden_list.value+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&cod_id_persona="+document.f1.cod_id_persona.value+"&status_contrato="+estatusCheck()+"&sd="+sd+"&salto="+salto+"&order=" + tblorder + "&convenio="+document.f1.convenio.value+"&dep="+dep+"&gen_fec="+verRadiotipo_costo()+"&desde1="+document.f1.desde1.value+"&hasta1="+document.f1.hasta1.value+"&por_fecha="+document.f1.por_fecha.value+"&tipo_lista="+document.f1.tipo_lista.value+"&tipo_fact="+document.f1.tipo_fact.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
		
	}
}


function verzonasmultiples(){
	var cade='';
	for (i=0;i<document.f1.id_zona.length;i++){
		if(document.f1.id_zona.options[i].selected==true){
			cade= cade+document.f1.id_zona.options[i].value+"=@";
		}
		
	}
	return cade;
}
function versectoresmultiples(){
	var cade='';
	for (i=0;i<document.f1.id_sector.length;i++){
		if(document.f1.id_sector.options[i].selected==true){
			cade= cade+document.f1.id_sector.options[i].value+"=@";
		}
	}
	return cade;
}
function buscar_ordenes(){

	archivoDataGrid="reportes/Rep_ORDENESTECNICOS.php?&id_g_a="+id_g_a()+"&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+document.f1.status_contrato.value+"&status_orden="+document.f1.status_orden.value+"&gen_ubi=&gen_fec="+verRadiotipo_costo()+"&id_tipo_orden="+id_tipo_orden()+"&id_det_orden="+id_det_orden()+"&login_emi="+document.f1.login_emi.value+"&login_imp="+document.f1.login_imp.value+"&login_final="+document.f1.login_final.value+"&id_gt="+document.f1.id_gt.value+"&por_fecha="+document.f1.por_fecha.value+"&";
	updateTable();
}

function ImprimirRep_ORDENESTECNICOS(){
		location.href="reportes/Rep_ORDENESTECNICOSImpreso.php?&id_g_a="+id_g_a()+"&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+document.f1.status_contrato.value+"&status_orden="+document.f1.status_orden.value+"&gen_ubi=&gen_fec="+verRadiotipo_costo()+"&id_tipo_orden="+id_tipo_orden()+"&id_det_orden="+id_det_orden()+"&login_emi="+document.f1.login_emi.value+"&login_imp="+document.f1.login_imp.value+"&login_final="+document.f1.login_final.value+"&id_gt="+document.f1.id_gt.value+"&por_fecha="+document.f1.por_fecha.value+"&order=" + tblorder + "&";
}

function estatusCheck(){
	var cade='';
	for (i = 0; i < document.f1.status_contrato.length; i++) {
		if(document.f1.status_contrato[i].checked == true){
			cade= cade+document.f1.status_contrato[i].value+"=@";
		}
	}
	return cade;
}
function buscar_imp_fact_lotes(){
	if(validaCampo(document.f1.deuda,isInteger)){
		archivoDataGrid="procesos/datagrid_imp_fact_lotes.php?&deuda="+document.f1.deuda.value+"&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&tipo="+document.f1.tipo.value+"&";
		updateTable();
		document.f1.modificar.disabled=false;
		document.f1.eliminar.disabled=false;
	}
}

function realizar_desc(){
	if(validaCampo(document.f1.monto_dc,isNumber)){
	if(document.f1.comentario.value==""){
			alerta("Error, debe describir el motivo del cambio del cargo.");
	}
	else{
		if(parseInt(document.f1.monto_dc.value)<=0){
			alerta("Error, el descuento debe ser mayor a cero (0).");
		}
		else{
			archivoDataGrid="reportes/realizar_descuento.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&monto_dc="+document.f1.monto_dc.value+"&mes="+document.f1.hasta.value+"&status_contrato="+document.f1.status_contrato.value+"&motivo="+document.f1.motivo.value+"&comentario="+document.f1.comentario.value+"&";
			updateTable();
			document.f1.modificar.disabled=true;
		}
	}
	}
}
function buscarDesc(){
	archivoDataGrid="reportes/descuento.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&mes="+document.f1.hasta.value+"&status_contrato="+document.f1.status_contrato.value+"&";
	
	updateTable();
	document.f1.modificar.disabled=false;
}

function buscarCortar1(){
	archivoDataGrid="procesos/datagrid_status_contrato1.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&";
	updateTable();
	document.f1.modificar.disabled=false;
}
function cortar_servicio(){
	//archivoDataGrid="procesos/cortar_servicio.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&";
	//updateTable();
	if(validaCampo(document.f1.deuda,isInteger)){
	document.f1.registrar.disabled=false;
	  //location.href="reportes/cortar_servicio.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&";
	conexionAJAX("ReporteJava/cortar_servicio.php?&deuda="+document.f1.deuda.value+"&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&");
	}
	//creaVenta("reportes/cortar_servicio.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&",1000,700);
}
function cortar_servicio(){
	//archivoDataGrid="procesos/cortar_servicio.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&";
	//updateTable();
	if(validaCampo(document.f1.deuda,isInteger)){
	document.f1.registrar.disabled=false;
	  //location.href="reportes/cortar_servicio.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&";
	conexionAJAX("ReporteJava/cortar_servicio.php?&deuda="+document.f1.deuda.value+"&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&");
	}
	//creaVenta("reportes/cortar_servicio.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&",1000,700);
}

function imprimir_aviso_est_cuenta(){
	
	if(validaCampo(document.f1.deuda,isInteger)){
		document.f1.registrar.disabled=false;
		location.href="reportepdf/imprimir_aviso_est_cuenta.php?&deuda="+document.f1.deuda.value+"&id_tipo_servicio="+id_tipo_servicio()+"&id_serv="+id_serv()+"&id_g_a="+id_g_a()+"&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+estatusCheck()+"&gen_fec="+verRadiotipo_costo()+"&desde1="+document.f1.desde1.value+"&hasta1="+document.f1.hasta1.value+"&por_fecha="+document.f1.por_fecha.value+"&tipo_lista="+document.f1.tipo_lista.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
	}
	
}


function imprimir_aviso(){
	
	if(document.f1.checkgrupo.checked == true)
			var sd="";
		else 
			var sd="true";
		
		if(document.f1.checkdeposito.checked == true)
			var dep="";
		else 
			var dep="true";
		
		if(document.f1.checksalto.checked == true)
			var salto="SALTO";
		else 
			var salto="";

	if(validaCampo(document.f1.deuda,isInteger)){
		document.f1.registrar.disabled=false;
		location.href="reportepdf/aviso_de_cobro.php?&titulo=AVISO DE COBRO&obser_aviso="+document.f1.obser_aviso.value+"&deuda="+document.f1.deuda.value+"&id_tipo_servicio="+id_tipo_servicio()+"&id_serv="+id_serv()+"&id_g_a="+id_g_a()+"&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+verzonasmultiples()+"&id_sector="+versectoresmultiples()+"&orden_list="+document.f1.orden_list.value+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+estatusCheck()+"&order=" + tblorder + "&cod_id_persona="+document.f1.cod_id_persona.value+"&sd="+sd+"&salto="+salto+"&dep="+dep+"&gen_fec="+verRadiotipo_costo()+"&desde1="+document.f1.desde1.value+"&hasta1="+document.f1.hasta1.value+"&por_fecha="+document.f1.por_fecha.value+"&tipo_lista="+document.f1.tipo_lista.value+"&tipo_fact="+document.f1.tipo_fact.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
	}
	
}

function imprimir_aviso_susp(){
	if(document.f1.checkgrupo.checked == true)
			var sd="";
		else 
			var sd="true";
		
		if(document.f1.checkdeposito.checked == true)
			var dep="";
		else 
			var dep="true";
		
		if(document.f1.checksalto.checked == true)
			var salto="SALTO";
		else 
			var salto="";

	if(validaCampo(document.f1.deuda,isInteger)){
		document.f1.registrar.disabled=false;
		location.href="reportepdf/aviso_de_cobro.php?&titulo=AVISO DE SUSPENSION&obser_aviso="+document.f1.obser_aviso.value+"&deuda="+document.f1.deuda.value+"&id_tipo_servicio="+id_tipo_servicio()+"&id_serv="+id_serv()+"&id_g_a="+id_g_a()+"&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+verzonasmultiples()+"&id_sector="+versectoresmultiples()+"&orden_list="+document.f1.orden_list.value+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+estatusCheck()+"&order=" + tblorder + "&cod_id_persona="+document.f1.cod_id_persona.value+"&sd="+sd+"&salto="+salto+"&dep="+dep+"&gen_fec="+verRadiotipo_costo()+"&desde1="+document.f1.desde1.value+"&hasta1="+document.f1.hasta1.value+"&por_fecha="+document.f1.por_fecha.value+"&tipo_lista="+document.f1.tipo_lista.value+"&tipo_fact="+document.f1.tipo_fact.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
	}
}


function estado_cuenta_b(){
	
	if(validaCampo(document.f1.deuda,isInteger)){
	
		if(document.f1.checkgrupo.checked == true)
			var sd="";
		else 
			var sd="true";
		
		if(document.f1.checkdeposito.checked == true)
			var dep="";
		else 
			var dep="true";
		
		if(document.f1.checksalto.checked == true)
			var salto="SALTO";
		else 
			var salto="";

			
		document.f1.registrar.disabled=false;
		location.href="reportepdf/aviso_de_cobro_cuenta.php?&titulo=AVISO DE COBRO&obser_aviso="+document.f1.obser_aviso.value+"&deuda="+document.f1.deuda.value+"&id_tipo_servicio="+id_tipo_servicio()+"&id_serv="+id_serv()+"&id_g_a="+id_g_a()+"&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+verzonasmultiples()+"&id_sector="+versectoresmultiples()+"&orden_list="+document.f1.orden_list.value+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+estatusCheck()+"&order=" + tblorder + "&cod_id_persona="+document.f1.cod_id_persona.value+"&sd="+sd+"&salto="+salto+"&dep="+dep+"&gen_fec="+verRadiotipo_costo()+"&desde1="+document.f1.desde1.value+"&hasta1="+document.f1.hasta1.value+"&por_fecha="+document.f1.por_fecha.value+"&tipo_lista="+document.f1.tipo_lista.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
	}
	
}
function guardar_cortar_servicio_proc(){

if (confirm('Seguro que desea REALIZAR EL PROCESO DE CORTE DEL MES?')){
	if(validaCampo(document.f1.deuda,isInteger)){
		document.f1.registrar.disabled=false;
		if(document.f1.checkgrupo.checked == true)
			var sd="";
		else 
			var sd="true";
		
		if(document.f1.checkdeposito.checked == true)
			var dep="";
		else 
			var dep="true";
		
		if(document.f1.checksalto.checked == true)
			var salto="SALTO";
		else 
			var salto="";
		
		
		
		location.href="reportepdf/proceso_corte.php?&deuda="+document.f1.deuda.value+"&titulo_list="+document.f1.titulo_list.value+"&id_tipo_servicio="+id_tipo_servicio()+"&id_serv="+id_serv()+"&id_g_a="+id_g_a()+"&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+verzonasmultiples()+"&id_sector="+versectoresmultiples()+"&orden_list="+document.f1.orden_list.value+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&cod_id_persona="+document.f1.cod_id_persona.value+"&status_contrato="+estatusCheck()+"&sd="+sd+"&salto="+salto+"&order=" + tblorder + "&convenio="+document.f1.convenio.value+"&dep="+dep+"&gen_fec="+verRadiotipo_costo()+"&desde1="+document.f1.desde1.value+"&hasta1="+document.f1.hasta1.value+"&por_fecha="+document.f1.por_fecha.value+"&tipo_lista="+document.f1.tipo_lista.value+"&tipo_fact="+document.f1.tipo_fact.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
		
	}
}
}
function guardar_listado_llamada(){

	if(validaCampo(document.f1.deuda,isInteger) && validaCampo(document.f1.login_resp,isSelect,false,"Debe Selecionar el responsable de las llamdas")  && validaCampo(document.f1.ubica_all,isTexto,false,"Debe escribir la Ubicacion de la Lista de Llamada") ){
		document.f1.registrar.disabled=false;
		if(document.f1.checkgrupo.checked == true)
			var sd="";
		else 
			var sd="true";
		
		if(document.f1.checkdeposito.checked == true)
			var dep="";
		else 
			var dep="true";
		
		if(document.f1.checksalto.checked == true)
			var salto="SALTO";
		else 
			var salto="";
		
if (confirm('Seguro que desea IMPRIMIR EL LISTADO DE LLAMADA?')){
		
		
		location.href="reportepdf/proceso_llamada.php?&deuda="+document.f1.deuda.value+"&titulo_list="+document.f1.titulo_list.value+"&id_tipo_servicio="+id_tipo_servicio()+"&id_serv="+id_serv()+"&id_g_a="+id_g_a()+"&id_franq="+id_franq()+"&id_esta="+id_esta()+"&id_mun="+id_mun()+"&id_ciudad="+id_ciudad()+"&id_zona="+verzonasmultiples()+"&id_sector="+versectoresmultiples()+"&orden_list="+document.f1.orden_list.value+"&urbanizacion="+urbanizacion()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&cod_id_persona="+document.f1.cod_id_persona.value+"&status_contrato="+estatusCheck()+"&sd="+sd+"&salto="+salto+"&order=" + tblorder + "&convenio="+document.f1.convenio.value+"&dep="+dep+"&gen_fec="+verRadiotipo_costo()+"&desde1="+document.f1.desde1.value+"&hasta1="+document.f1.hasta1.value+"&por_fecha="+document.f1.por_fecha.value+"&tipo_lista="+document.f1.tipo_lista.value+"&tipo_fact="+document.f1.tipo_fact.value+"&obser_all="+document.f1.obser_all.value+"&login_resp="+document.f1.login_resp.value+"&ubica_all="+document.f1.ubica_all.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
		
	}
}
}
function imprimir_proceso_corte(id_proc){
location.href="reportepdf/proceso_corte_reimp.php?&id_proc="+id_proc+"&";
		
}
function cortar_servicio1(){
	//archivoDataGrid="procesos/cortar_servicio.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&";
	//updateTable();
	document.f1.registrar.disabled=false;
	location.href="reportes/cortar_servicio1.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&";
	//creaVenta("reportes/cortar_servicio.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&",1000,700);
}
function rest_mes(){
	if(id_contrato()==""){
		alerta("Error, debe cargar un contrato válido.");
	}
	else{
		conexionPHP("informacion.php","agregar_mes",id_contrato());
	}
}
function agregar_cd(){
	if(id_contrato()==""){
		alerta("Error, debe cargar un contrato válido.");
	}
	else{
		conexionPHP("informacion.php","agregar_cd",id_contrato());
	}
}
function agregar_mes(){
	if(id_contrato()==""){
		alerta("Error, debe cargar un contrato válido.");
	}
	else{
		/*if(document.f1.desc_pago.value=="FALSE"){
			alerta("Error, debe cancelar todos los cargos pendiente para agregar meses adelantados")
		}else{
		*/
			conexionPHP("informacion.php","agregar_mes",id_contrato());
	//	}
	}
}
function agregar_punto(){
	if(id_contrato()==""){
		alerta("Error, debe cargar un contrato válido.");
	}
	else{
		conexionPHP("informacion.php","agregar_punto",id_contrato());
	}
}

function hab_ckeck(id){
//alerta("entro");
	document.getElementById(id).click();
	document.getElementById(id).disabled=false;
	
}
function comp_ckeck(id){
	//alerta(":"+document.getElementById("text_"+id).value+":")
	if(document.getElementById("text_"+id).value!=""){
		document.getElementById(id).click();
	}
	else{
		document.getElementById(id).disabled=true;		
	}
}

function valida_info_mat(){
	var cont=0;
	cade='';
	for (i = 0; i < document.f1.id_mat.length; i++) {
		if(document.f1.id_mat[i].checked == true){
			if(!isInteger (document.getElementById("text_"+trim(document.f1.id_mat[i].value)).value)){
				alerta("Error, el campo debe ser un entero.");
				document.getElementById("text_"+trim(document.f1.id_mat[i].value)).select();
				return false;
			}
		}
	}
	return true;
}
function info_mat(){
	var cont=0;
	cade='';
	for (i = 0; i < document.f1.id_mat.length; i++) {
		if(document.f1.id_mat[i].checked == true){
			cade=cade+"-Class-util_orden_=@materiales=@"+trim(document.f1.id_mat[i].value)+"=@"+document.getElementById("text_"+trim(document.f1.id_mat[i].value)).value+"=@"+id_orden()+"=@=@=@=@=@=@";
		}
	}
	return cade;
}
function buscar_rep_libroventa1(){
	
	archivoDataGrid="reportes/Rep_libroventa1.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&";
	updateTable();
}
function buscar_facturas_salto(){
	
	archivoDataGrid="reportes/facturas_salto.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&";
	updateTable();
}
function buscar_rep_libroventa(){
	
	archivoDataGrid="reportes/Rep_libroventa.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&";
	updateTable();
}
function buscar_libro_cobrador(){
	//alerta("reportes/Rep_libro_cobrador.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_persona="+document.f1.id_persona.value+"&")
	archivoDataGrid="reportes/Rep_libro_cobrador.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_persona="+document.f1.id_persona.value+"&com="+document.f1.com.value+"&";
	updateTable();
}
function buscar_info_adic(){
	archivoDataGrid="reportes/Rep_info_adic.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&login="+document.f1.login.value+"&";
	updateTable();
}
function buscar_rep_cobro(){
	
	archivoDataGrid="reportes/Rep_cobro.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&";
	updateTable();
}
function ImprimirRep_cobro(){
		//creaVenta("reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&",1000,700);
		conexionAJAX("ReporteJava/Rep_cobroImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&");
		//location.href="reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&";
}
function ImprimirRep_libroventa(){
		//creaVenta("reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&",1000,700);
		conexionAJAX("ReporteJava/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&");
		//location.href="reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&";
}
function ImprimirRep_libro_cobrador(){
		conexionAJAX("ReporteJava/Rep_libro_cobradorImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_persona="+document.f1.id_persona.value+"&");
		
}
function DescargarRep_libro_cobrador(){
		//creaVenta("reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&",1000,700);
		
		location.href="reportepdf/Rep_libro_cobradorImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_persona="+document.f1.id_persona.value+"&";
}
function DescargarRep_libro_cobradorTodos(){
		//creaVenta("reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&",1000,700);
		
		location.href="reportepdf/Rep_libro_cobradorTodosImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_persona="+document.f1.id_persona.value+"&";
}
function DescargarRep_info_adic(){
		location.href="reportepdf/Rep_info_adicImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&login="+document.f1.login.value+"&";
}
function ImprimirRep_libroventa1(){
		//creaVenta("reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&",1000,700);
		conexionAJAX("ReporteJava/Rep_libroventaImpreso1.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&");
		//location.href="reportes/Rep_libroventaImpreso1.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&";
}
function DescargarRep_cobro(){
		location.href="reportepdf/Rep_cobroImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&";
}
function DescargarRep_libroventa(){
		//creaVenta("reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&",1000,700);
		
		location.href="reportepdf/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function res_diario_ing_fraq(){
		//creaVenta("reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&",1000,700);
		
		location.href="reportepdf/res_diario_ing_fraq.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function reporte_franquicia(){
		//creaVenta("reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&",1000,700);
		
		location.href="reportepdf/reporte_franquicia.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function DescargarRep_libroventaDetallado(){
		//creaVenta("reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&",1000,700);
		
		location.href="reportepdf/Rep_libroventaImpresoDetallado.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function DescargarRep_libroventaDetallado2(){
		//creaVenta("reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&",1000,700);
		
		location.href="reportepdf/Rep_libroventaImpresoDetallado2.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function DescargarRep_libroventaDetallado_Servicio(){
		//creaVenta("reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&",1000,700);
		
		location.href="reportepdf/Rep_libroventaImpresoDetallado_servicio.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function DescargarRep_libroventa_sector(){
		//creaVenta("reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&",1000,700);
		
		location.href="reportepdf/Rep_libroventaImpresoSector.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function DescargarRep_libroventaDetallado_corresp(){
		//creaVenta("reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&",1000,700);
		
		location.href="reportepdf/Rep_libroventaImpresoDetallado_corresp.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function DescargarRep_libroventa_tec(){
	location.href="reportepdf/Rep_libroventaImpreso_tec.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&";
}
function DescargarRep_libroventaF(){
		location.href="reportepdf/Rep_libroventaImpresoF.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&";
}

function DescargarRep_ingreso_x_serv(){
		location.href="reportepdf/Rep_ingreso_x_servImpreso.php?&tipo="+document.f1.tipo.value+"&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&";
}

function DescargarRep_ingreso_x_serv1(){
		location.href="reportepdf/Rep_ingreso_x_serv1Impreso.php?&mes_a="+document.f1.mes_a.value+"&mes_p="+document.f1.mes_p.value+"&mes="+document.f1.mes.value+"&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&";
}

function DescargarRep_libroventa1(){
		//creaVenta("reportes/Rep_libroventaImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&",1000,700);
		
		location.href="reportepdf/Rep_libroventaImpreso1.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&";
}
function ImprimirRep_totalclientes1(){
		location.href="reportes/Rep_totalclientesImpreso1.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+document.f1.status_contrato.value+"&gen_ubi="+verRadiostatus_serv()+"&gen_fec="+verRadiotipo_costo()+"&";
		//creaVenta("reportes/Rep_totalclientesImpreso.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+document.f1.status_contrato.value+"&gen_ubi="+verRadiostatus_serv()+"&gen_fec="+verRadiotipo_costo()+"&",1000,700);
}

function ImprimirRep_totalclientes(){
		//location.href="reportes/Rep_totalclientesImpreso.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+document.f1.status_contrato.value+"&gen_ubi="+verRadiostatus_serv()+"&gen_fec="+verRadiotipo_costo()+"&";
		conexionAJAX("ReporteJava/Rep_totalclientesImpreso.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+document.f1.status_contrato.value+"&gen_ubi="+verRadiostatus_serv()+"&gen_fec="+verRadiotipo_costo()+"&");
		//creaVenta("reportes/Rep_totalclientesImpreso.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+document.f1.status_contrato.value+"&gen_ubi="+verRadiostatus_serv()+"&gen_fec="+verRadiotipo_costo()+"&",1000,700);
}


function ImprimirRep_estadocuenta(id_contrato){
		//location.href="reportes/Rep_estadocuentaImpreso.php?id_contrato="+id_contrato+"&";
		creaVenta("reportes/Rep_estadocuentaImpreso.php?id_contrato="+id_contrato+"&",1000,700);
}

function ImprimirRep_historialpago(id_contrato){
		//location.href="reportes/Rep_historialpagoImpreso.php?id_contrato="+id_contrato+"&";
		//creaVenta("reportes/Rep_historialpagoImpreso.php?id_contrato="+id_contrato+"&",1000,700);
		conexionAJAX("ReporteJava/Rep_historialpagoImpreso.php?id_contrato="+id_contrato+"&");
}
function GuardarRep_historialpago(id_contrato){
	location.href="reportepdf/Rep_historialpagoImpreso.php?id_contrato="+id_contrato+"&";
	//	creaVenta("reportes/Rep_historialpagoImpreso.php?id_contrato="+id_contrato+"&",1000,700);
}
function hab_total_cli_ubi(){
 if(verRadiostatus_serv()=="GENERAL"){
	document.f1.id_franq.disabled=true;
	document.f1.id_zona.disabled=true;
	document.f1.id_sector.disabled=true;
	document.f1.id_calle.disabled=true;
	
	document.f1.id_esta.disabled=true;
	document.f1.id_mun.disabled=true;
	document.f1.id_ciudad.disabled=true;
	document.f1.urbanizacion.disabled=true;

	document.f1.id_franq.selectedIndex=0;
	document.f1.id_zona.selectedIndex=0;
	document.f1.id_sector.selectedIndex=0;
	document.f1.id_calle.selectedIndex=0;

	document.f1.id_esta.selectedIndex=0;
	document.f1.id_mun.selectedIndex=0;
	document.f1.id_ciudad.selectedIndex=0;
	document.f1.urbanizacion.selectedIndex=0;
 }
 else if(verRadiostatus_serv()=="ESPECIFICO"){
	document.f1.id_franq.disabled=false;
	document.f1.id_zona.disabled=false;
	document.f1.id_sector.disabled=false;
	document.f1.id_calle.disabled=false;
	
	document.f1.id_esta.disabled=false;
	document.f1.id_mun.disabled=false;
	document.f1.id_ciudad.disabled=false;
	document.f1.urbanizacion.disabled=false;
 }
}

function hab_total_cli_fec(){
 if(verRadiotipo_costo()=="GENERAL"){
	document.f1.desde.disabled=true;
	document.f1.hasta.disabled=true;
	document.f1.por_fecha.disabled=true;
	document.f1.desde.selectedIndex=0;
	document.f1.hasta.selectedIndex=0;
	//document.f1.por_fecha.selectedIndex=0;
 }
 else if(verRadiotipo_costo()=="ESPECIFICO"){
	document.f1.desde.disabled=false;
	document.f1.hasta.disabled=false;
//	document.f1.por_fecha.disabled=false;
	
 }
}
function hab_total_cli_fec1(){
 if(verRadiotipo_costo()=="GENERAL"){
	document.f1.desde1.disabled=true;
	document.f1.hasta1.disabled=true;
	document.f1.por_fecha.disabled=true;
	document.f1.por_fecha.selectedIndex=0;
 }
 else if(verRadiotipo_costo()=="ESPECIFICO"){
	document.f1.desde1.disabled=false;
	document.f1.hasta1.disabled=false;
	document.f1.por_fecha.disabled=false;
	
 }
}
function buscar_totalclientes(){

	archivoDataGrid="reportes/Rep_totalclientes.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&status_contrato="+document.f1.status_contrato.value+"&gen_ubi="+verRadiostatus_serv()+"&gen_fec="+verRadiotipo_costo()+"&";
	updateTable();
}
function buscar_recuperados(){
	archivoDataGrid="reportes/Rep_recuperados.php?&tiempo="+document.f1.tiempo.value+"&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&status_contrato="+document.f1.status_contrato.value+"&gen_ubi="+verRadiostatus_serv()+"&gen_fec="+verRadiotipo_costo()+"&";
	updateTable();
}
function ImprimirRep_recuperados(){
		conexionAJAX("ReporteJava/Rep_recuperadosImpreso.php");

}
function GuardarRep_recuperados(){
		location.href="reportepdf/Rep_recuperadosImpreso.php";
}
function buscar_notas(){

	archivoDataGrid="reportes/Rep_notas.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&gen_ubi="+verRadiostatus_serv()+"&gen_fec="+verRadiotipo_costo()+"&generado_por="+document.f1.generado_por.value+"&login_aut="+document.f1.login_aut.value+"&login="+login()+"&tipo="+document.f1.tipo.value+"&idmotivonota="+document.f1.idmotivonota.value+"&dir_ip="+document.f1.dir_ip.value+"&";
	updateTable();
}
function ImprimirRep_notas(){
		conexionAJAX("ReporteJava/Rep_notasImpreso.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&gen_ubi="+verRadiostatus_serv()+"&gen_fec="+verRadiotipo_costo()+"&generado_por="+document.f1.generado_por.value+"&login="+login()+"&tipo="+document.f1.tipo.value+"&idmotivonota="+document.f1.idmotivonota.value+"&dir_ip="+document.f1.dir_ip.value+"&");

}
function GuardarRep_notas(){
		location.href="reportepdf/Rep_notasImpreso.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&gen_ubi="+verRadiostatus_serv()+"&gen_fec="+verRadiotipo_costo()+"&generado_por="+document.f1.generado_por.value+"&login="+login()+"&tipo="+document.f1.tipo.value+"&idmotivonota="+document.f1.idmotivonota.value+"&dir_ip="+document.f1.dir_ip.value+"&";
}
function reimp_factura(id_pago){
	//location.href="reportes/impFactPago.php?&id_pago="+id_pago+"&";
	creaVenta("reportes/impFactPago.php?&id_pago="+id_pago+"&",1000,700);
}
function reimp_ordenes(id_orden){
					if(planilla_orden_G==""){
						conexionAJAX("ReporteJava/imp_orden_serv.php?&id_orden="+id_orden+"&");
					}else{
						conexionAJAX("ReporteJava/imp_orden_serv"+planilla_orden_G+".php?&id_orden="+id_orden+"&");
					}
					
}
function buscar_reimp_c_caja(){
	divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
	archivoDataGrid="reportes/reimp_cierre_caja.php?&id_persona="+id_persona()+"&desde="+document.f1.desde.value+"&id_f="+document.f1.id_f.value+"&";
	updateTable();
}
function reimp_cierre_diario1(){
	//location.href="reportes/Rep_CierreDiarioImpreso1.php?&fecha="+document.f1.desde.value+"&";
	conexionAJAX("ReporteJava/Rep_CierreDiarioImpreso1.php?&fecha="+document.f1.desde.value+"&");
//	creaVenta("reportes/Rep_CierreDiarioImpreso.php?&fecha="+document.f1.desde.value+"&",1000,700);
}
function reimp_cierre_diario(){
	//  location.href="reportes/Rep_CierreDiarioImpreso.php?&fecha="+document.f1.desde.value+"&";
	conexionAJAX("ReporteJava/Rep_CierreDiarioImpreso.php?&fecha="+document.f1.desde.value+"&");
//	creaVenta("reportes/Rep_CierreDiarioImpreso.php?&fecha="+document.f1.desde.value+"&",1000,700);

}
function reimp_cierre_diario(){
	conexionAJAX("ReporteJava/Rep_CierreDiarioImpreso_general.php?&fecha="+document.f1.desde.value+"&");
}

function redes_cierre_diario1(){
	location.href="reportepdf/Rep_CierreDiarioImpreso1.php?&fecha="+document.f1.desde.value+"&";
	//conexionAJAX("ReporteJava/Rep_CierreDiarioImpreso1.php?&fecha="+document.f1.desde.value+"&");
//	creaVenta("reportes/Rep_CierreDiarioImpreso.php?&fecha="+document.f1.desde.value+"&",1000,700);
	
}
function redes_cierre_diario(){
	location.href="reportepdf/Rep_CierreDiarioImpreso.php?&fecha="+document.f1.desde.value+"&id_f="+document.f1.id_f.value+"&";
	document.getElementById("dialogo").innerHTML='<br><div class="cabe">FAVOR ESPERE!!!<span class="fuente"><br>Esto puede Tardar varios segundos<br><img id="loading" src="imagenes/loading.gif"><br><br></span><br></div>';
}
function verpagosrealizado(){
	location.href="reportepdf/Rep_CierreDiarioImpreso_solo_det.php?&";
}
function redes_cierre_diario_general(){
	  location.href="reportepdf/Rep_CierreDiarioImpreso_general.php?&fecha="+document.f1.desde.value+"&id_f="+document.f1.id_f.value+"&";
	   document.getElementById("dialogo").innerHTML='<br><div class="cabe">FAVOR ESPERE!!!<span class="fuente"><br>Esto puede Tardar varios segundos<br><img id="loading" src="imagenes/loading.gif"><br><br></span><br></div>';
}
function informe_comercial(){
	  location.href="reportepdf/informe_comercial.php?&fecha="+document.f1.desde.value+"&id_f="+document.f1.id_f.value+"&";
	  document.getElementById("dialogo").innerHTML='<br><div class="cabe">FAVOR ESPERE!!!<span class="fuente"><br>Esto puede Tardar varios segundos<br><img id="loading" src="imagenes/loading.gif"><br><br></span><br></div>';
}
function imprimir_informe_tecnico(){
	  location.href="reportepdf/informe_tecnico_diario.php?&id_f="+document.f1.id_franq.value+"&";
}
function ImprimirRep_PERFILES(){
		//location.href="reportes/Rep_PERFILESImpreso.php";
		creaVenta("reportes/Rep_PERFILESImpreso.php",1000,700);
}
function ImprimirRep_fran(){
		location.href="reportes/Rep_franImpreso.php";
}
function ImprimirRep_zona(){
		location.href="reportes/Rep_zonaImpreso.php";
}

function buscarRep_sector(){
	divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
	archivoDataGrid="reportes/Rep_sector.php?&id_zona="+id_zona()+"&";
	updateTable();
}

function ImprimirRep_sector(){
		location.href="reportes/Rep_sectorImpreso.php?&id_zona="+id_zona()+"&";
}


function ImprimirRep_fran_p(){
		location.href="reportes/Rep_fran_pImpreso.php";
}
function ImprimirRep_zona_p(){
		location.href="reportes/Rep_zona_pImpreso.php";
}

function ImprimirRep_sector_p(){
		location.href="reportes/Rep_sector_pImpreso.php?&id_zona="+id_zona()+"&";
}

function ImprimirRep_calle_p(){
		location.href="reportes/Rep_calle_pImpreso.php?&id_zona="+id_zona()+"&id_sector="+id_sector()+"&";
}
function ImprimirRep_calle(){
		location.href="reportes/Rep_calleImpreso.php?&id_zona="+id_zona()+"&id_sector="+id_sector()+"&";
}
function buscarRep_calle(){
	//	location.href="reportes/Rep_calle_pImpreso.php";
	divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
	archivoDataGrid="reportes/Rep_calle.php?&id_zona="+id_zona()+"&id_sector="+id_sector()+"&";
	updateTable();
}


function ImprimirRep_deudafran(){
		location.href="reportes/Rep_deudazonaImpreso.php";
}
function ImprimirRep_deudazona(){
		location.href="reportes/Rep_deudazonaImpreso.php";
}
function ImprimirRep_deuda_mes(){
		location.href="reportes/Rep_deuda_mesImpreso.php?&id_franq="+document.f1.id_franq.value+"&";
}
function ImprimirRep_deuda_zona(){
		location.href="reportes/Rep_deuda_zonaImpreso.php?&id_franq="+document.f1.id_franq.value+"&";
}
function ImprimirRep_deuda_sect(){
		location.href="reportes/Rep_deuda_sectImpreso.php?&id_franq="+document.f1.id_franq.value+"&";
}

function ImprimirRep_deudasector(){
		location.href="reportes/Rep_deudasectorImpreso.php?&status_contrato="+document.f1.status_contrato.value+"&deuda="+document.f1.deuda.value+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&";
		//creaVenta("reportes/Rep_deudasectorImpreso.php",1000,700);
}

function ImprimirRep_deudacalle(){
		//location.href="reportes/Rep_deudacalleImpreso.php";
		creaVenta("reportes/Rep_deudacalleImpreso.php",1000,700);
}
function reimprimir_factura(id_pago){
//location.href="reportes/impFactPagoRTF.php?&id_pago="+id_pago+"&";
conexionAJAX("ReporteJava/facturaPago.php?id_pago="+id_pago+"&");
}

function filtrarcontrato(){
	var ncont=nro_contrato();
for(var i=ncont.length;i<dig_cont_G;i++){
		ncont="0"+ncont;
	}
	if(serie_correl_G!='0' && serie_correl_G!=''){
		if(nro_contrato().length<=dig_cont_G){
			ncont=inicialG+ncont;
		}
	}
	
	document.f1.nro_contrato.value=ncont;

	conexionPHP("informacion.php","filtrarcontrato",ncont);
}
function buscar_orden_final(){
	conexionPHP("informacion.php","buscar_orden_final",id_orden());
}
function act_datos(){
	if(id_contrato()==""){
		alerta("Error, Debe cargar un contrato.");
		document.f1.nro_contrato.select();
	}
	else{
		creaVenta('actualizar.php?&clase=act_datos&id_contrato='+id_contrato(),960,600);
	}
}
function addCampo(clase,dato){
/*	if(id_contrato()==""){
		alerta("Error, Debe cargar un contrato");
		document.f1.nro_contrato.select();
	}
	else{
	*/
		creaVenta('add.php?&clase='+clase+"&dato="+document.getElementById(dato).value+"&",960,600);
	//}
}
function asig_orden(){
	if(id_contrato()==""){
		alerta("Error, Debe cargar un contrato.");
		document.f1.nro_contrato.select();
	}
	else{
		creaVenta('actualizar.php?&clase=asig_orden&id_contrato='+id_contrato(),960,600);
	}
}
function agregar_visita(){
	creaVenta('actualizar.php?&clase=visitas&id_orden='+id_orden(),960,600);
}
function agregarComenta(id_orden){
	creaVenta('actualizar.php?&clase=visitas&id_orden='+id_orden,960,600);
	
}
function verComentaOrd(id_orden){
	creaVenta('actualizar.php?&clase=verVisitas&id_orden='+id_orden,960,600);
	
}
function asig_orden1(){
	if(nro_contrato()==""){
		alerta("Error, Debe cargar un contrato.");
		document.f1.nro_contrato.select();
	}
	else{
		creaVenta('actualizar.php?&clase=asig_orden1&id_contrato='+id_contrato(),960,600);
	}
}
function cargar_d(){
	if(nro_contrato()==""){
		alerta("Error, Debe cargar un contrato.");
		document.f1.nro_contrato.select();
	}
	else{
		creaVenta('actualizar.php?&clase=cargar_d&id_contrato='+id_contrato(),960,600);
	}
}
function abrir_reporte_f(){
	creaVenta("http://"+dir_fiscal+"/fiscal/Tfhka/DemoTfhkaPHP.php",960,600);
	
}
function ImprimirRep_ORDENESTECNICOSC(){
		location.href="reportes/Rep_ORDENESTECNICOSCImpreso.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+document.f1.status_contrato.value+"&gen_ubi="+verRadiostatus_serv()+"&gen_fec="+verRadiotipo_costo()+"&id_tipo_orden="+id_tipo_orden()+"&id_det_orden="+id_det_orden()+"&";
}

function buscar_ordenesC(){
	archivoDataGrid="reportes/Rep_ORDENESTECNICOSC.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+document.f1.status_contrato.value+"&gen_ubi="+verRadiostatus_serv()+"&gen_fec="+verRadiotipo_costo()+"&id_tipo_orden="+id_tipo_orden()+"&id_det_orden="+id_det_orden()+"&";
	updateTable();
}
function manual_usuario(){
	creaVenta('ManualUsuario.pdf',960,600);
}

function val_grupo_tec(){
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
				return true;
		}
	}
		alerta("Error, debe seleccionar al menos un técnico de la lista.");
		return false;
	
}

function val_grupo_ubi(){
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox_gu.length; i++) {
		if(document.f1.checkbox_gu[i].checked == true){
				return true;
		}
	}
		alerta("Error, debe seleccionar al menos una zona/sector de la lista.");
		return false;
}

function grupo_tec(tipoDato){
	if(tipoDato=='modificar'){
		alerta("AVISO, los datos de los tecnicos no se modifican.");
		return "";
	}
	else{
		var cont=0;
		cade='';
		for (i = 1; i < document.f1.checkbox.length; i++) {
			if(document.f1.checkbox[i].checked == true){
					cade=cade+"-Class-incluir=@grupo_tecnico=@"+id_gt()+"=@"+trim(document.f1.checkbox[i].value)+"=@";
					
			}
		}
		if(cade!='')
		{
			return cade;
		}
		else{
			alerta("Error, debe seleccionar al menos un tecnico de la lista.");
		}
	}
}
function grupo_ubi(tipoDato){
		var cont=0;
		cade="-Class-eliminar=@grupo_ubicacion=@"+id_gt()+"=@=@";
		for (i = 1; i < document.f1.checkbox_gu.length; i++) {
			if(document.f1.checkbox_gu[i].checked == true){
					cade=cade+"-Class-incluir=@grupo_ubicacion=@"+id_gt()+"=@"+trim(document.f1.checkbox_gu[i].value)+"=@"+document.f1.organizar_por.value;
			}
		}
		if(cade!=''){
			return cade;
		}
		else{
			alerta("Error, debe seleccionar al menos una zona/sector de la lista.");
		}
}
function strstr(haystack, needle, bool) {
    var pos = 0;
    haystack += '';
    pos = haystack.indexOf(needle);
    if (pos == -1){
        return false;
    } else {
        if (bool){
            return haystack.substr(0, pos);
        } else {
            return haystack.slice(pos);
        }
    }
}
function bloquea_asig_grupo(){
	if(document.f1.checkgrupo.checked == true){
		document.f1.id_gt.disabled=true;
		document.f1.id_gt.value='';
	}else{
		document.f1.id_gt.disabled=false;
	}
}


function sel_grupo_aut(nombre_zona){
		//alerta(nombre_zona);
	if(document.f1.checkgrupo.checked == true){
		var x=false;
		if(sel_grupo_aut_G==true){
			for(i=0;i<document.f1.id_gt.options.length;i++)
			{
				if(strstr(document.f1.id_gt.options[i].text,trim(nombre_zona))!=false){
					x=true;
					document.f1.id_gt.selectedIndex=i;
				}
			}
		}
		if(x==false){
			document.f1.id_gt.selectedIndex=0;
		}
	}
}
function activaGrupo(){
	if(status_pago()=="CORTADO"){
		document.getElementById('grupocorte').style.display="block";
		sel_grupo_act();
	}
	else{
		document.getElementById('grupocorte').style.display="none";
	}
}
function sel_grupo_act(){
			//alerta(trim(document.f1.id_zona.options[document.f1.id_zona.selectedIndex].text));
			for(i=0;i<document.f1.id_gt.options.length;i++)
			{
				if(strstr(document.f1.id_gt.options[i].text,trim(document.f1.id_zona.options[document.f1.id_zona.selectedIndex].text))!=false){
					document.f1.id_gt.selectedIndex=i;
					break;
				}
			}
}
function conexionAJAX(archivoPHP){
	var ajax=nuevoAjax();
	//abre la conexion con php
	ajax.open("GET", archivoPHP, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//envia los datos a traves de AJAX concatenados con =@
		ajax.send();
	
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			//alerta(ajax.responseText);
			printJava(ajax.responseText);
		}
	}
}

function printJava(cadena){
	
	var pag=cadena.split("-Page-");
	var num_pag=pag.length;
	
	var applet=document.getElementById("miapplet");
	applet.creaImp();
	for(k=1;k<num_pag;k++){
		
		var separa=pag[k].split("-Param-");
		
		var param=separa[0].split("=@");
		var ori=param[0];
		var ancho=param[1];
		var alto=param[2];
		var diag=param[3];
		
		
		var mod=separa[1].split("-Class-");
		
		tam=mod.length-1;
		var array = new Array();
		for(i=0;i<tam;i++){
			cad=mod[i].split("=@");
			if(cad[0]!=''){
				array.push([''+cad[0]+'',''+cad[1]+'',''+cad[2]+'',''+cad[3]+'',''+cad[4]+'',''+cad[5]+'',""+cad[6]+""]);
			}
		}
		applet.agregar(array,''+ori+'',''+ancho+'',''+alto+'');
		
	}
	//alerta(''+diag+'');
	applet.imprimir(''+diag+'');
	//applet.destroy();
}

function reimprimir_orde(){
					if(planilla_orden_G==""){
						location.href="reportepdf/imp_orden_serv.php?&id_orden="+id_orden()+"&";
					}else{
						location.href="reportepdf/imp_orden_serv"+planilla_orden_G+".php?&id_orden="+id_orden()+"&";
					}
}

function GuardarRep_totalclientes(){
		location.href="reportepdf/Rep_totalclientesImpreso.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+document.f1.status_contrato.value+"&gen_ubi="+verRadiostatus_serv()+"&gen_fec="+verRadiotipo_costo()+"&";
		//creaVenta("reportes/Rep_totalclientesImpreso.php?&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&status_contrato="+document.f1.status_contrato.value+"&gen_ubi="+verRadiostatus_serv()+"&gen_fec="+verRadiotipo_costo()+"&",1000,700);
}
function GuardarRep_estadocuenta(id_contrato){
		location.href="reportepdf/Rep_estadocuentaImpreso.php?id_contrato="+id_contrato+"&";
		//creaVenta("reportes/Rep_estadocuentaImpreso.php?id_contrato="+id_contrato+"&",1000,700);
}

function GuardarRep_historial_deuda(id_contrato){
		location.href="reportepdf/reporte_estado_de_cuenta.php?id_contrato="+id_contrato+"&";
		//creaVenta("reportes/Rep_estadocuentaImpreso.php?id_contrato="+id_contrato+"&",1000,700);
}
function Guardar_aviso_cobro(id_contrato){
		location.href="reportepdf/reporte_aviso_cobro.php?id_contrato="+id_contrato+"&titulo=AVISO DE COBRO&";
}
function Guardar_aviso_susp(id_contrato){
		location.href="reportepdf/reporte_aviso_cobro.php?id_contrato="+id_contrato+"&titulo=AVISO DE SUSPENSION&";
}
function referencia_comercial(id_contrato){
		location.href="reportepdf/referencia_comercial.php?id_contrato="+id_contrato+"&";
}

function descargarExcel(sql){
	//alerta(sql);
		location.href="descargarExcel.php?sql="+sql+"&";
}

function ImprimirRep_estadocuenta(id_contrato){
		//location.href="reportes/Rep_estadocuentaImpreso.php?id_contrato="+id_contrato+"&";
		//creaVenta("reportes/Rep_estadocuentaImpreso.php?id_contrato="+id_contrato+"&",1000,700);
		conexionAJAX("ReporteJava/Rep_estadocuentaImpreso.php?id_contrato="+id_contrato+"&");
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


function validar_dato_cliente1(){
	if(valida_ced_tipo_cliente()){
		validarcliente1();
	}
}
function validarcliente1(){ conexionPHP("validarExistencia.php","1=@vista_cliente","cedula=@"+cedula());}


function abrir_gen_rep(){
	miFormulario = window.open("generar_reporte.php","reporte","Top=150,Left=200,width=700,height=400,scrollbars=yes,resizable=yes,Toolbar=yes");
    miFormulario.focus();
}

function abrir_creaFormulario(){
	miFormulario = window.open("creaFormulario.php","reporte","Top=150,Left=200,width=700,height=400,scrollbars=yes,resizable=yes,Toolbar=yes");
    miFormulario.focus();
}

function abrir_modulo(){
	miFormulario = window.open("modulo.php","reporte","Top=150,Left=200,width=700,height=400,scrollbars=yes,resizable=yes,Toolbar=yes");
    miFormulario.focus();
}

function c_id_contrato(){
	conexionPHP("informacion.php","c_id_contrato",document.f1.id_contrato.value);
}
function c_nro_contrato(){
	conexionPHP("informacion.php","c_nro_contrato",document.f1.nro_contrato.value);
}
function c_cedula(){
	conexionPHP("informacion.php","c_cedula",document.f1.cedula.value);
}
function c_id_pago(){
	conexionPHP("informacion.php","c_id_pago",document.f1.id_pago.value);
}
function c_nro_factura(){
	conexionPHP("informacion.php","c_nro_factura",document.f1.nro_factura.value);
}
function c_nro_factura_reimp(){
	conexionPHP("informacion.php","c_nro_factura_reimp",document.f1.nro_factura.value);
}
function c_nro_control(){
	conexionPHP("informacion.php","c_nro_control",document.f1.nro_factura.value);
}
function anular_control(){
	conexionPHP("informacion.php","anular_control",document.f1.nro_factura.value);
}

function infovieja(){
	creaVentanaRep("http://192.168.0.219/matrix_cortado/index.php");
	
}

function imprimirInv(id_inv){
		location.href="reportepdf/Rep_inventarioImpreso.php?&id_inv="+id_inv+"&";
}


function buscarRep_deudasector(){
	if(validaCampo(document.f1.deuda,isInteger)){
		archivoDataGrid="reportes/Rep_deudasector.php?&status_contrato="+document.f1.status_contrato.value+"&deuda="+document.f1.deuda.value+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&";
		//archivoDataGrid="procesos/datagrid_status_contrato.php?&deuda="+document.f1.deuda.value+"&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&";
		updateTable();
		document.f1.modificar.disabled=false;
		document.f1.eliminar.disabled=false;
	}
}

function hab_tipo_paq(){
	if(verRadiotipo_costo() == "COSTO MENSUAL")
		document.f1.tipo_paq.disabled=false;
	else 
		document.f1.tipo_paq.disabled=true;
}
function cambiar_tipo_ser(tipo_s){
	document.f1.tipo_s.value=tipo_s;
}
function cambiarIdioma(){
	conexionPHP("informacion.php","cambiarIdioma",document.f1.idioma.value+"=@"+document.f1.pais.value+"=@"+document.f1.moneda.value);
}
function organizar_grupo_por(){
	
	if(document.f1.organizar_por.value=='ZONAS'){
		document.f1.id_zona.disabled=true;
		document.f1.id_zona.value='';
	}
	else{
		document.f1.id_zona.disabled=false;
	}
	divDataGrid="grupo_ubicacion";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
	archivoDataGrid="procesos/datagrid_grupo_ubicacion.php?organizar_por="+document.f1.organizar_por.value+"&";
	updateTable();
}
function buscar_grupo_sector(){
	if(id_zona()!='0'){
		divDataGrid="grupo_ubicacion";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
		archivoDataGrid="procesos/datagrid_grupo_ubicacion.php?organizar_por="+document.f1.organizar_por.value+"&id_zona="+document.f1.id_zona.value+"&";
		updateTable();
	}
	
}

function imprimirGrupoTrabajo(id_gt){
	location.href="reportepdf/imp_grupo_trabajo.php?&id_gt="+id_gt+"&organizar_por="+document.f1.organizar_por.value+"&";
}
function eliminargrupo_trabajo(id_gt){
	if (confirm('Seguro que desea desabilitar este grupo de trabajo?')){
		conexionPHP("administrar.php","grupo_trabajo",id_gt+"=@=@=@=@=@","desabilitar");		
	}
}



function habilita_fp(){
	if(document.f1.checktp1.checked==true)
	{
		
document.getElementById("fpago2").style.display='block';

		if(parseFloat(monto_pago())==0){
			alerta("Error, debe seleccionar los cargos a facturar.");
			document.f1.checktp1.checked=false;
			habilita_fp();
		}
		else{
			var mp=parseFloat(monto_pago())/2;
			document.f1.monto_tp.value = mp;
			document.f1.monto_tp1.value = mp;
			
			document.f1.banco1.disabled=false;
			document.f1.numero1.disabled=false;
			document.f1.monto_tp1.disabled=false;
			document.f1.id_tipo_pago1.disabled=false;
		}
	}
	else
	{
		
document.getElementById("fpago2").style.display='none';

		document.f1.monto_tp.value = monto_pago();
		document.f1.monto_tp1.value = '';
		document.f1.id_tipo_pago1.value=0;
		document.f1.banco1.disabled=true;
		document.f1.numero1.disabled=true;
		document.f1.monto_tp1.disabled=true;
		document.f1.id_tipo_pago1.disabled=true;
	}
	
}

function deshabilita_fp(){
	
		document.f1.banco1.disabled=true;
		document.f1.numero1.disabled=true;
		document.f1.monto_tp1.disabled=true;
		document.f1.id_tipo_pago1.disabled=true;
		document.f1.banco.value='';
		document.f1.numero.value='';
		document.f1.monto_tp.value='';
	
}

function calc_mtp(){
	var mp=parseFloat(monto_pago());
	var mtp1=parseFloat(document.f1.monto_tp1.value);
	if(document.f1.monto_tp1.value!=''){
		if(mtp1 >= mp){
			alerta("Error, este monto de ser menor al monto del pago.");
			var mp2=mp/2;
				document.f1.monto_tp.value = mp2;
				document.f1.monto_tp1.value = mp2;	
		}
		else{
			document.f1.monto_tp.value = mp-mtp1;
		}
	}
	else{
		document.f1.monto_tp.value = mp;
	}
	
}

function cargarDetTipoPago1(){
	if(document.f1.id_tipo_pago1.value=="TPA00001"){
		document.f1.banco1.disabled=true;
		document.f1.numero1.disabled=true;
		document.f1.banco1.value='';
		document.f1.numero1.value='';
	}
	else{
		document.f1.banco1.disabled=false;
		document.f1.numero1.disabled=false;
	}
}

function validaTipoPago1(){
	if(document.f1.checktp1.checked==true)
	{
		if(document.f1.id_tipo_pago1.value=="TPA00001"){
			if(validaCampo(document.f1.id_tipo_pago1,isSelect) && validaCampo(document.f1.monto_tp1,isNumber))
			{
				return true;
			}
			else{
				return false;
			}
		}
		else{
			if(validaCampo(document.f1.id_tipo_pago1,isAlphanumeric) && validaCampo(document.f1.monto_tp1,isNumber) && validaCampo(document.f1.banco1,isSelect) && validaCampo(document.f1.numero1,isInteger))
			{
				return true;
			}
			else{
				return false;
			}
		}
	}
	else{
		return true;
	}
}
function ejecutar_sql(){
	divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
	archivoDataGrid="procesos/ejecutar_sql.php?tipo="+verRadiotipo_caja()+"&sql="+document.f1.sql.value+"&";
	updateTable();
}
function ejecutar_consulta_pred(datos){
	divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
	archivoDataGrid="procesos/ejecutar_consulta_pred.php?tipo="+datos+"&";
	updateTable();
}
function ejecutar_php(){
	divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
	archivoDataGrid="procesos/ejecutar_php.php?&php="+document.f1.sql.value+"&";
	updateTable();
}

function buscar_contr_act(){
	var ncont=nro_contrato();
	for(var i=ncont.length;i<dig_cont_G;i++){
		ncont="0"+ncont;
	}
	if(serie_correl_G!='0' && serie_correl_G!=''){
		if(nro_contrato().length<=dig_cont_G){
			ncont=inicialG+ncont;
		}
	}
	
	document.f1.nro_contrato.value=ncont;
	conexionPHP("informacion.php","buscar_contr_act",ncont);
}

/*********************fiscal*************************/


function ejecutar_df(cadena){
	
		//var venta = window.open("http://localhost/fiscal/ticket.php?datos="+cadena,"", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
	//	var venta = window.open("http://localhost/fiscal/ticket1.php?datos="+document.f1.archivo.value,"", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
		//alerta(document.f1.archivo.value);
		var valorcadena =str_replace ("<", "|-|", document.f1.archivo.value);
		 valorcadena =str_replace ("<", "|.|", valorcadena);
		 valorcadena =str_replace ("#", "|a|", valorcadena);
		// alerta(valorcadena);
		 creaVenta("http://localhost/fiscal/ticket1.php?&datos="+valorcadena+"&",300,300);
		//var venta = window.open("http://localhost/fiscal/ticket1.php?&datos="+valorcadena+"&","", 'left=110,top=110,width=1000,height=100,menubar=0,scrollbars=0');
		/*venta.close();
		var venta1 = window.open("http://localhost/fiscal/enviar.php","", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
		venta1.close();
		*/
		document.f1.registrar.disabled=true;
		
}
function imp_fiscal(cadena){
//	if (confirm(cadena)){
		//alerta(cadena);
		
		cadena=datos_fiscal_G;
		var valorcadena =str_replace ("<", "|-|", cadena);
		 valorcadena =str_replace ("<", "|.|", valorcadena);
		 valorcadena =str_replace ("#", "|a|", valorcadena);
		 
		creaVenta("http://localhost/fiscal/ticket.php?datos="+valorcadena+"&",300,300);
	//	var venta = window.open("http://localhost/fiscal/ticket.php?datos="+cadena,"", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
	//	var venta = window.open("http://localhost/fiscal/ticket1.php?datos="+document.f1.archivo.value,"", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
		//var venta = window.open("http://localhost/fiscal/ticket.php?&datos = "+cadena,"", 'left=0,top=0,width=1000,height=100,menubar=0,scrollbars=0');
		//venta.close();
	//	var venta1 = window.open("http://localhost/fiscal/enviar.php","", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
		//venta1.close();
//	}
}
function limpiarticket(){
	
		var venta = window.open("http://localhost/fiscal/limpiarticket.php","", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
	//	var venta = window.open("http://localhost/fiscal/ticket1.php?datos="+document.f1.archivo.value,"", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
		//var venta = window.open("http://localhost/fiscal/ticket.php?&datos = "+cadena,"", 'left=0,top=0,width=1000,height=100,menubar=0,scrollbars=0');
		venta.close();
		//var venta1 = window.open("http://localhost/fiscal/enviar.php","", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
		//venta1.close();
}

function habilitaArchivoPF(){
	if(document.f1.checkbox.checked == true)
		document.f1.archivo.disabled=false;
	else 
		document.f1.archivo.disabled=true;
}
function str_replace (search, replace, subject, count) {
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

function imp_anular_fiscal(cadena){
	var valorcadena =str_replace ("<", "|-|", cadena);
		 valorcadena =str_replace ("<", "|.|", valorcadena);
		 valorcadena =str_replace ("#", "|a|", valorcadena);
	creaVenta("http://"+dir_fiscal+"/fiscal/anular_ticket.php?datos="+valorcadena+"&",300,300);
}
/*
function imp_anular_fiscal(cadena){
//	alerta(":"+cadena+":")
		var venta = window.open("http://localhost/fiscal/anular_ticket.php?datos="+cadena,"", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
		venta.close();
		var venta1 = window.open("http://localhost/fiscal/enviar.php","", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
		venta1.close();
}
*/
function imp_cierrex(){
	creaVenta("http://localhost/fiscal/cierrex.php",300,300);
	//	var venta = window.open("http://localhost/fiscal/cierrex.php","", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
	//	venta.close();
	//	var venta1 = window.open("http://localhost/fiscal/enviar.php","", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
	//	venta1.close();
}
function imp_cierrez(){
	creaVenta("http://localhost/fiscal/cierrez.php",300,300);
	//	var venta = window.open("http://localhost/fiscal/cierrez.php","", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
	//	venta.close();
	//	var venta1 = window.open("http://localhost/fiscal/enviar.php","", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
	//	venta1.close();
}

function imp_cierre_x_fecha(){
	creaVenta("http://localhost/fiscal/cierre_x_fecha.php?desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&tipo="+document.f1.tipo.value+"&",300,300);
	//	var venta = window.open("http://localhost/fiscal/cierre_x_fecha.php?desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&tipo="+document.f1.tipo.value+"&","", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
	//	venta.close();
	//	var venta1 = window.open("http://localhost/fiscal/enviar.php","", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
	//	venta1.close();
}


/*********************fiscal*************************/


function editar_desc(descu,id_cont_serv){
	creaVenta("editar_desc.php?&id_cont_serv="+id_cont_serv+"&descu="+descu+"&",500,300);
	
}

function fraccionarCargo(id_cont_serv){
	creaVenta("fraccionarCargo.php?&id_cont_serv="+id_cont_serv+"&",500,300);
	
}

function fraccD(){
	//alerta("HOLA");
	if(validaCampo(document.f1.monto1,isNumber)){
		if(parseInt(document.f1.monto1.value)<parseInt(document.f1.monto.value)){
			document.f1.monto2.value=parseInt(document.f1.monto.value)-parseInt(document.f1.monto1.value);
			
		}
		else{
			alerta("Error, El monto 1 debe ser menor al monto a inicial.");
			document.f1.monto2.value="";
			
		}
	}
	else{
		document.f1.monto2.value="";
	}
	
}

/*function traer_tipo_resp(){
	conexionPHP('informacion.php',"traer_tipo_resp",id_drl());
}
function cargar_detalle_resp(){
	conexionPHP('informacion.php',"cargar_detalle_resp",id_trl());
}*/

function traer_estado(){
	conexionPHP('informacion.php',"traer_estado",id_mun());
}
function cargar_estado(){
	conexionPHP('informacion.php',"cargar_estado",id_franq());
}
function cargar_municipio(){
	conexionPHP('informacion.php',"cargar_municipio",id_esta());
}
function cargar_ciudad(){
	conexionPHP('informacion.php',"cargar_ciudad",id_mun());
}


function traer_paq(){
	conexionPHP('informacion.php',"traer_paq",id_canal());
}
function traer_pais(){
	conexionPHP('informacion.php',"traer_pais",id_esta());
}
function traer_municipio(){
	conexionPHP('informacion.php',"traer_municipio",id_ciudad());
}

function eliminardeco_ana(id_da){
	if (confirm('Seguro que desea desabilitar este decodificador analogico?')){
		conexionPHP("administrar.php","deco_ana",id_da+"=@=@=@=@=@=@=@=@=@=@=@=@=@=@=@=@","eliminar");
	}
}
function eliminarcablemodem(id_cm){
	if (confirm('Seguro que desea desabilitar este cable modem?')){
		conexionPHP("administrar.php","cablemodem",id_cm+"=@=@=@=@=@=@=@=@=@=@=@=@=@","eliminar");		
	}
}
function valida_etiqueta(){
	if(etiqueta()!=''){
		conexionPHP('informacion.php',"valida_etiqueta",etiqueta());
	}
}
function valida_etiqueta_n(){
	conexionPHP('informacion.php',"valida_etiqueta_n",etiqueta_n());
}

function buscar_cedula_b(){
	document.getElementById("bcedula").value=document.f1.cedula_b.value;
	buscarContAvanz();
}
function buscar_cedula_ba(){
	document.getElementById("bcedula").value=document.f1.cedula.value;
	buscarContAvanz();
}
function abrirBusq_cont_avanz_mult(){
	ajaxVentana_BA('Abonados', buscar_avanzado_consultar_clientes);
	//setTimeout('buscar()', 9000);
	
//	creaVenta("busq_cont_avanz.php?cedula="+document.f1.cedula_b.value+"&",960,600);
}
function abrirBusq_cont_avanz_mult_todo(){
	creaVenta("busq_cont_avanz_todo.php?cedula="+document.f1.cedula_b.value+"&",960,600);
}
function abrirBusq_cont_avanz_mult1(){
	creaVenta("busq_cont_avanz.php?cedula="+document.f1.cedula.value+"&",960,600);
}
function eliminarinfo_adic(id_inf_a){
	if (confirm('Seguro que desea eliminar esta bitacora?')){
		conexionPHP("administrar.php","info_adic",id_inf_a+"=@=@=@=@","eliminar");
	}
}
function imp_nota_credito(){
	location.href="reportepdf/imp_nota_credito.php?&id_nota="+id_notaG+"&";
	id_notaG=''
}
function reimp_nota_credito(id_nota){
	location.href="reportepdf/imp_nota_credito.php?&id_nota="+id_nota+"&";
}

function libroventa_unicable(){
		location.href="reportepdf/libroventa_unicable.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&id_est="+document.f1.id_est.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function planilla_comisiones(){
		location.href="reportepdf/planilla_comisiones.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&id_est="+document.f1.id_est.value+"&desc_confc="+document.f1.desc_confc.value+"&descuento_conf="+document.f1.descuento_conf.value+"&";
}
function libroventa_unicable_resumido(){
		location.href="reportepdf/libroventa_unicable_resumido.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&id_est="+document.f1.id_est.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function exportar_libro_excel(){
		location.href="include/PHPExcel/generaExcel_libro_venta.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}
function exportar_libro_excel_resumido(){
		location.href="include/PHPExcel/generaExcel_libro_venta_resumido.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_franq="+document.f1.id_franq.value+"&id_est="+document.f1.id_est.value+"&";
		document.getElementById(divDataGrid).innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE!!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
}


function registrar_promo_serv(){
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
			cade=cade+"-Class-incluir=@promo_serv=@"+document.f1.checkbox[i].value+"=@"+id_promo()+"=@";
		}
	}
	if(cade!='')
	{
		return cade;
	}
	else{
		alerta("Error, debe seleccionar al menos un Servicio.");
		return false;
	}
}

function valida_promo_serv(){
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
		
			return true;
		}
	}
	alerta("Error, debe seleccionar al menos un Servicio.");
		return false;
}
function cargar_promocion(){
	conexionPHP('validarExistencia.php','1=@promocion','id_promo=@'+id_promo());
}

function verconvenio_pago(){
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
			cade=cade+"-Class-incluir=@conv_con=@=@"+id_conv()+"=@"+document.f1.checkbox[i].value+"=@"+formatdate(document.getElementById("fecha_ven_"+document.f1.checkbox[i].value).value)+"=@";
	}
	if(cade!='')
	{
		return cade;
	}
	else{
		alerta("Error, debe seleccionar al menos un cargo.");
		return false;
	}
}
function asignar_fecha_lim(date){
	//alerta("entro"+date)
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
		//	alerta("fecha_ven_"+document.f1.checkbox[i].value);
			document.getElementById("fecha_ven_"+document.f1.checkbox[i].value).value=date;
			cade=cade+document.f1.checkbox[i].value;
		}
	}
	
	if(cade==''){
		alerta("Error, debe seleccionar al menos un cargo para asignarle fecha.");
		return false;
	}
	deseleccionarTodo_tec();
}

function cargar_calendario_cp(){
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var Calenda = new dhtmlXCalendarObject(["fecha_ven_"+document.f1.checkbox[i].value]);
	}
}

function valida_convenio_pago(){
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
			return true;
		}
	}
	alerta("Error, debe seleccionar al menos un cargo.");
		return false;
}
function valida_fecha_convenio_pago(){
	var cont=0;
	cade='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(!valdate(document.getElementById("fecha_ven_"+document.f1.checkbox[i].value).value)){
			return false;
		}
	}
	return true;
}

function modificarstatus_convenio(id_conv){
			if (confirm('Confirma que desea eliminar este convenio?')){
				conexionPHP("administrar.php","convenio_pago",id_conv+"=@=@=@=@=@","modificarstatus");
			}
		
}
function imprimir_convenio(id_conv){
		//location.href="reportepdf/convenio_pago.php?&id_conv="+id_conv+"&";
}
function contar_fact(){
	if(document.f1.desde.value!='' && document.f1.hasta.value!=''){
		if(validaCampo(document.f1.desde,isInteger) && validaCampo(document.f1.desde,isInteger)){ 
			var desde=parseInt(document.f1.desde.value);
			var desde=parseInt(document.f1.desde.value);
			var hasta=parseInt(document.f1.hasta.value);
			var num=hasta-desde;
			//alerta(":"+desde+":"+hasta+":"+num+":");
			document.f1.cantidad.value=num+1;
		}
	}
}
function anular_factura(){
	if(parseInt(document.f1.cantidad.value)<=0){
		alerta("Error, la cantidad debe de facturas debe ser mayor a cero (0).");
	}
	if(document.f1.desde.value!='' && document.f1.hasta.value!='' && parseInt(document.f1.cantidad.value)>0){
		if(validaCampo(document.f1.desde,isInteger) && validaCampo(document.f1.desde,isInteger)){ 
			conexionPHP("informacion.php","anular_factura",id_caja_cob()+"=@"+formatdate(document.f1.fecha_factura.value)+"=@"+document.f1.desde.value+"=@"+document.f1.hasta.value+"=@"+document.f1.serie.value);
			
		}
	}
}
function cambiar_grupo_trabajo(){
	conexionPHP("informacion.php","cambiar_grupo_trabajo",document.f1.id_orden.value+="=@"+document.f1.id_gt.value);
}

function listar_facturas_asig(){
	archivoDataGrid="procesos/datagrid_recibos.php?&id_cobrador="+id_cobrador()+"&";
	updateTable();
}
/*
function eliminar_recibe_fact(){
	
	
		var cont=0;
		cade='';
		for (i = 1; i < document.f1.checkbox.length; i++) {
			if(document.f1.checkbox[i].checked == true){
					cade=cade+"-Class-eliminar=@recibos=@"+trim(document.f1.checkbox[i].value)+"=@=@=@=@"+document.f1.tipo.value;
			}
		}
		if(cade!='')
		{
			return cade;
		}
		else{
			alerta("Error, debe seleccionar al menos un técnico de la lista.");
		}
	
}*/

function val_recibe_fact(){
	
		var cont=0;
		cade='';
		for (i = 1; i < document.f1.checkbox.length; i++) {
			if(document.f1.checkbox[i].checked == true){
					cade=cade+"-Class-incluir=@grupo_tecnico=@"+"=@"+trim(document.f1.checkbox[i].value)+"=@";
					
			}
		}
		if(cade!='')
		{
			return true;
		}
		else{
			alerta("Error, debe seleccionar al menos una factura de la lista.");
			return false;
		}
	
}



function valida_fact(){
	if(desde()!='' && hasta()!=''){
		if(validaCampo(document.f1.desde,isInteger) && validaCampo(document.f1.hasta,isInteger)){
			if(desde().length==dig_recibo_G){
				if(hasta().length==dig_recibo_G){
					if(parseInt(desde())<=parseInt(hasta())){
						document.f1.cantidad.value=parseInt(hasta())-parseInt(desde())+1;
						conexionPHP('informacion.php',"valida_fact",desde()+"=@"+hasta()+"=@"+cantidad()+"=@"+document.f1.serie.value);
					}else{
						document.f1.hasta.select();
						document.f1.cantidad.value=''
						alerta("Error, el campo factura hasta debe ser mayor o igual a la factura desde.");
					}
				}else{
					document.f1.hasta.select();
					alerta("Error, la factura hasta debe ser de "+dig_recibo_G+" digitos.");
				}
			}else{
				document.f1.desde.select();
				alerta("Error, la factura desde debe ser de "+dig_recibo_G+" digitos.");
			}
		}
	}
}

function habilitar_cierre_caja(){
	conexionPHP("informacion.php","habilitar_cierre_caja");
}
function desabilitar_cierre_caja(){
	conexionPHP("informacion.php","desabilitar_cierre_caja");
}
function eliminar_proceso_corte(id_proc){
	if (confirm('Seguro que desea eliminar este proceso de corte?')){
		conexionPHP("informacion.php","eliminar_proceso_corte",id_proc);
	}
}

function buscar_libro_vendedor(){
	archivoDataGrid="reportes/Rep_libro_vendedor.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_persona="+document.f1.id_persona.value+"&com="+document.f1.com.value+"&";
	updateTable();
}
function ImprimirRep_libro_vendedor(){
		conexionAJAX("ReporteJava/Rep_libro_vendedorImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_persona="+document.f1.id_persona.value+"&com="+document.f1.com.value+"&");
		
}
function DescargarRep_libro_vendedor(){
		location.href="reportepdf/Rep_libro_vendedorImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&id_persona="+document.f1.id_persona.value+"&com="+document.f1.com.value+"&";
}
function desc(ruta){
		//alerta(ruta);
		location.href="archivos/des.php?&ruta="+ruta+"&";
}

function buscardf(){
	conexionPHP("informacion.php","buscardf",document.f1.id_pago.value);
}


function confir_buscar_anular_df(){
	if (confirm('Seguro que desea Reimprimir esta Nota de Credito?')){
		 buscar_anular_df();
	}
	
}
function buscar_anular_df(){
	//alerta(document.f1.id_pago1.value);
	conexionPHP("informacion.php","buscar_anular_df",document.f1.id_pago1.value);
}

function buscar_reg_dep(){
	archivoDataGrid="procesos/datagrid_pagodeposito_reg.php?&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&id_franq="+document.f1.id_franq.value+"&tipo_fecha="+document.f1.tipo_fecha.value+"&";
	updateTable();
}
function buscar_confir_dep(){
	archivoDataGrid="procesos/datagrid_pagodeposito_conf.php?&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&id_franq="+document.f1.id_franq.value+"&tipo_fecha="+document.f1.tipo_fecha.value+"&banco="+document.f1.banco.value+"&status_pd="+document.f1.status_pd.value+"&";
	updateTable();
}
function confirmarpagodeposito(id_pd){
	if (confirm('Seguro que desea CONFIRMAR este deposito / transferencia?')){
		conexionPHP("informacion.php","confirmarpagodeposito",id_pd);
	}
}
function confirmarpagodeposito_mod(){
	if(confirm('Seguro que desea GUARDAR Y CONFIRMAR este deposito / transferencia?')){
		conexionPHP("informacion.php","confirmarpagodeposito_mod",id_pd()+"=@"+numero_ref()+"=@"+monto_dep());
		
	}
}
function traerpagodeposito_mod(id_pd,numero_ref,monto_dep){
	document.f1.id_pd.value=trim(id_pd);
	document.f1.numero_ref.value=trim(numero_ref);
	document.f1.monto_dep.value=trim(monto_dep);
	document.f1.modifi.disabled=false;
}
function negarpagodeposito(id_pd){
	if (confirm('Seguro que desea NEGAR es deposito / transferencia?')){
		conexionPHP("informacion.php","negarpagodeposito",id_pd);
	}
}

function registrar_pago_depositos(){
	var cont=0;
	cade='';
	var id_pd='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		if(document.f1.checkbox[i].checked == true){
				cade=cade+trim(document.f1.checkbox[i].value)+"-@-";
				id_pd=trim(document.f1.checkbox[i].value);
				cont++;
		}
	}
	if(cade!=''){
				if (confirm("Confirma que desea registrar estos depositos seleccionadas?")){
				//	alerta()
					conexionPHP("administrar.php","pagodeposito",id_pd+"=@"+id_caja_cob()+"=@"+cade+"=@=@=@=@=@=@=@=@=@=@=@=@=@","registrar_dep");		
				}
	}
	else{
		alerta("Error, debe seleccionar al menos un deposito/transferencia de la lista.");
	}
}

function buscar_facturas_a(){
	archivoDataGrid="reportes/Rep_facturas.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&gen_fec="+verRadiotipo_costo()+"&id_cobrador="+document.f1.id_cobrador.value+"&login="+login()+"&status_pago="+document.f1.status_pago.value+"&tipo="+document.f1.tipo.value+"&nro_recibo="+document.f1.nro_recibo.value+"&";
	updateTable();
}


function GuardarRep_facturas(){
		location.href="reportepdf/Rep_facturasImpreso.php?&desde="+formatdate(document.f1.desde.value)+"&hasta="+formatdate(document.f1.hasta.value)+"&gen_fec="+verRadiotipo_costo()+"&id_cobrador="+document.f1.id_cobrador.value+"&login="+login()+"&status_pago="+document.f1.status_pago.value+"&tipo="+document.f1.tipo.value+"&nro_recibo="+document.f1.nro_recibo.value+"&";
}
function colocar_id_pago(id_pago){
		document.f1.id_pago.value=id_pago;
		document.f1.id_pago.select();
		if(claseGlobal=='factura'){
			buscardf();
		} 
		else if(claseGlobal=='consultar_pagos'){
			validarpagos_anular_id();
		}
		else if(claseGlobal=='anular_pagos'){
			validarpagos_anular_id();
		}
		else if(claseGlobal=='modificar_pagos'){
			validarpagos_anular_id();
		}
		else if(claseGlobal=='modificar_pagos1'){
			validarpagos_anular_id();
		}
		else if(claseGlobal=='nota_credito_factura'){
			validarpagos_anular_id();
		}
}

function confirmar_nota_cd(id_nota,tipo){
	if (confirm('Seguro que desea AUTORIZAR esta '+tipo)){
		conexionPHP("informacion.php","confirmar_nota_cd",id_nota);
	}
}
function negar_nota_cd(id_nota,tipo){
	if(confirm('Seguro que desea RECHAZAR esta '+tipo)){
		conexionPHP("informacion.php","negar_nota_cd",id_nota);
		
	}
}
function verServiciosCheck(){
	conexionPHP('informacion.php',"verServiciosCheck",id_franq());
}

function verificar_form_externo(tipoDato,clase){
	switch(clase)
	{
		case "add_zona":
			if( validaCampoGet("nombre_campo",isTexto)){
				confirmacion_form_externo(tipoDato,clase,document.getElementById("nombre_campo").value+"=@"+id_ciudad());
			}
		break;
		case "add_sector":
			if( validaCampoGet("nombre_campo",isTexto)){
				confirmacion_form_externo(tipoDato,clase,document.getElementById("nombre_campo").value+"=@"+id_zona());
			}
		break;
		case "add_urb":
			if( validaCampoGet("nombre_campo",isTexto)){
				confirmacion_form_externo(tipoDato,clase,document.getElementById("nombre_campo").value+"=@"+id_sector());
			}
		break;
		case "add_calle":
			if( validaCampoGet("nombre_campo",isTexto)){
				confirmacion_form_externo(tipoDato,clase,document.getElementById("nombre_campo").value+"=@"+id_sector());
			}
		break;
		case "add_edificio":
			if( validaCampoGet("nombre_campo",isTexto)){
				confirmacion_form_externo(tipoDato,clase,document.getElementById("nombre_campo").value+"=@"+id_sector());
			}
		break;
		default:
		alerta("Error, no esta definida la clase externa: "+clase);
	}
	return true;
}
function llamar_ordenes_tecnicos_act(){
	if(id_contrato()!=''){
		ruta_G='act_contrato';
		conexionPHP('formulario.php','ordenes_tecnicos','',id_contrato());
	}
	else{
		alerta("debe cargar un cliente para registrarle una orden de servicio ");
	}
}
function llamar_ordenes_tecnicos_pagos(){
	if(id_contrato()!=''){
		ruta_G='pagos';
		conexionPHP('formulario.php','ordenes_tecnicos','',id_contrato());
	}
	else{
		alerta("debe cargar un cliente para registrarle una orden de servicio ");
	}
}
function llamar_llamadas(id_all,id_contrato,id_lc){
		ruta_G='imprimir_listado_llamada';
		id_all_G=id_all;
		id_lc_G=id_lc;
		conexionPHP('formulario.php','llamadas','',id_contrato);
}
function bcargarZona_franq(){
	conexionPHP('informacion.php',"bcargarZona_franq",document.getElementById("bid_franq").value);
}
function bcargarSector(){
	conexionPHP('informacion.php',"bcargarSector",document.getElementById("bid_zona").value);
}
function bcargarCalle(){
	conexionPHP('informacion.php',"bcargarCalle",document.getElementById("bid_sector").value);
}
function mostrarcargo_pendiente(){
	if(id_contrato()==''){
			alerta("Error, Debe Cargar un contrato");
	}
}
function imp_cont(){
	location.href="reportepdf/afiliacion.php?&id_contrato="+id_contrato()+"&";
}

function imp_cont1(){
	location.href="reportepdf/contratolegal.php?&id_contrato="+id_contrato()+"&";
}

function RespActualizarDeuda(){
	
	if(isNumber(document.getElementById("monto_dc").value) && isNumber(document.getElementById("campo").value))
	{
		if(document.getElementById("comentario").value==""){
			alerta("Error, debe describir el motivo de la nota de Credito / Debito");
		}
		else{
		new BootstrapDialog({
		title: 'CONFIRMACIÓN DE SAECO',
		message: "Confirma que desea solicitar esta "+verRadiotipo_nota(),
		type: BootstrapDialog.TYPE_INFO,
		closable: false,
		buttons: [{
			label: 'NO',
			icon: 'glyphicon glyphicon-thumbs-down',
			cssClass: 'btn-danger',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
				dialog.close();
			}
		}, {
			label: 'SI',
			icon : 'glyphicon glyphicon-thumbs-up',
			cssClass: 'btn-info',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
				conexionPHP("informacion.php","ActualizarDeudaDC",document.getElementById("id_cont_serv").value+"=@"+document.getElementById("monto_dc").value+"=@"+document.getElementById("campo").value+"=@"+document.getElementById("motivo").value+"=@"+document.getElementById("comentario").value+"=@"+verRadiotipo_nota());
				ventana.close();
				dialog.close();
			}
		}]
	}).open();
		
		}
	}
	else{
		alerta("ERROR, Debe ingresar un campo numerico");
		document.getElementById("monto_dc").select();
	}
}




function compara_fecha(desde,hasta){
	if (desde == hasta) {
		return 0;
	}
	
	array_fecha = desde.split("-")
	var dia=array_fecha[2]
	var mes=(array_fecha[1])
	var ano=(array_fecha[0]) 

	array_fecha = hasta.split("-")
	var dia1=array_fecha[2]
	var mes1=(array_fecha[1])
	var ano1=(array_fecha[0]) 
	var fechaDesde = new Date(ano,mes,dia)
	var fechaHasta= new Date(ano1,mes1,dia1)
	
	if (fechaDesde > fechaHasta) {
	//	alert("desde es mayor que hasta"+desde+":"+hasta);
		return 1;
	}
	if (fechaDesde < fechaHasta) {
		//alert("desde es menor que hasta"+desde+":"+hasta);
		return -1;
	}
	if (fechaDesde == fechaHasta) {
	//	alert("desde es igual que hasta"+desde+":"+hasta);
		return 0;
	}
}

function habilita_listado_llamada(){
	document.getElementById("divcallcenter").style.display='block';
}
function colocar_ubica(ubica){
	document.f1.ubica_all.value=document.f1.id_zona.options[document.f1.id_zona.selectedIndex].text;
}
function colocar_ubica_sector(){
	document.f1.ubica_all.value=document.f1.id_sector.options[document.f1.id_sector.selectedIndex].text;
}
function colocar_ubica_franq(){
	document.f1.ubica_all.value=document.f1.id_franq.options[document.f1.id_franq.selectedIndex].text;
}
function colocar_ubica_urb(){
	document.f1.ubica_all.value=document.f1.urbanizacion.options[document.f1.urbanizacion.selectedIndex].text;
}
function calculafechapromocion(){
				if(mes_promo()!='0'){
					conexionPHP("informacion.php","calculafechapromocion",mes_promo()+"=@"+inicio_promo());
				}
				else{
					alert("Error, debe seleccionar la duracion");
					document.f1.inicio_promo.value='';
					document.f1.fin_promo.value='';
				}
}
/*
function dedo_disp(){
	creaVenta("dedo_disp.php",800,600);
}
function cablemodem_disp(){
	venta=creaVenta("cablemodem_disp.php",800,600);
}

function cargar_cable_modem(){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_cablemodem.php?status="+document.f1.status.value+"&";
			updateTable();
}

function cargar_deco_ana(){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_decoana1.php?status="+document.f1.status.value+"&";
			updateTable();
}
*/
function traer_datos_pago(id_pago){
	conexionPHP('informacion.php',"traer_datos_pago",id_pago);
}
function imprimir_factura_i(){
	if(id_pago()==''){
		alerta("Error, debe seleccionar un pago para imprimir la factura")
	}else{
		conexionPHP('informacion.php',"imprimir_factura_i",id_pago()+"=@"+id_caja_cob()+"=@"+nro_factura()+"=@"+nro_control()+"=@");
	}
}


function valida_numero_ref(){
	if(document.f1.banco.value!='0' && document.f1.numero.value!='' && (document.f1.id_tipo_pago.value=="TPA00003" || document.f1.id_tipo_pago.value=="TPA00004" || document.f1.id_tipo_pago.value=="TPA00008" || document.f1.id_tipo_pago.value=="TPA00011")){
			conexionPHP("informacion.php","valida_numero_ref",id_tipo_pago()+"=@"+banco()+"=@"+document.f1.numero.value);
	}
}

function mandar_imprimir_pago(id_pago){
	
								if(tipo_facturacion=="FORMA_CONTINUA_MEDIA_CARTA_DOBLE_DERECHA"){
									conexionAJAX("ReporteJava/facturaPago.php?id_pago="+id_pago+"&");
								}
								else if(tipo_facturacion=="BIXOLON"){
									conexionPHP("informacion.php","buscardf",id_pago);
								}
								else if(tipo_facturacion=="EPSON"){
									conexionPHP("informacion.php","buscardf",id_pago);
								}
}


function habilitar_camb_prop(id_pago){
	if(document.f1.habilita_camb_prop.checked == true){
		document.f1.cedula.disabled=false;
	}else{
		document.f1.cedula.disabled=true;
	}
}


function ver_camb_prop(){
	if(document.f1.habilita_camb_prop.checked == true){
		return "TRUE";
	}else{
		return "FALSE";
	}
}





function dedo_disp(){
	creaVenta("dedo_disp.php",800,600);
}
function cablemodem_disp(){
	creaVenta("cablemodem_disp.php",800,600);
}

function cargar_cable_modem(){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_cablemodem.php?status="+document.f1.status.value+"&";
			updateTable();
}

function cargar_deco_ana(){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_decoana1.php?status="+document.f1.status.value+"&";
			updateTable();
}


function buscar_deco(){
	conexionPHP('informacion.php',"buscar_deco",codigo_da());
}
function refrescar_deco(){
	conexionPHP('informacion.php',"refrescar_deco",id_contrato());
}

function cargar_deco(){
	conexionPHP('validarExistencia.php','1=@deco_ana','codigo_da=@'+document.f1.codigo_da.value);
}

function cargar_deco2(){
	conexionPHP('validarExistencia.php','1=@deco_ana','nota2=@'+document.f1.nota2.value);
}

function cargar_cablemodem(){
	conexionPHP('validarExistencia.php','1=@cablemodem','codigo_cm=@'+document.f1.codigo_da.value);
}



function servicioacc4000_agregar(){
	var cont=0;
	cade='';
	for (i = 0; i < document.f1.servicio.length; i++) {
		if(document.f1.servicio[i].checked == true){
			var id_pago_serv= document.f1.servicio[i].value.split("=@");
				cade=cade+trim(id_pago_serv[0])+":";
		}
	}
	//	alert(cade);
		return cade;
	
}



function habilita_tam_campo(){
				if(document.f1.punto_da.value=="SM"){
					//document.getElementById("serial_deco").maxlength=16;
					document.f1.nota2.disabled=false;
					//document.f1.serial_deco.value=document.f1.codigo_da.value+""+document.f1.nota2.value;
					document.f1.serial_deco.value=document.f1.codigo_da.value;
				}
				else{
					//document.getElementById("serial_deco").maxlength=12;
					document.f1.nota2.disabled=true;
					document.f1.serial_deco.value=document.f1.codigo_da.value;
				}
}
function habilita_tam_campo_deco_ana(){
				if(document.f1.punto_da.value=="SM"){
					//document.getElementById("serial_deco").maxlength=16;
					document.f1.nota2.disabled=false;
				}
				else{
					//document.getElementById("serial_deco").maxlength=12;
					document.f1.nota2.disabled=true;
				}
}
function valida_tam_campo(){
				if(document.f1.punto_da.value=="SM"){
					if(document.f1.serial_deco.value.length!=7){
						alert("Error, el serial del decodificador debe de ser de 7 digitos");
							document.f1.serial_deco.select();
						return false;
					}else{
						return true;
					}
				}
				else{
					if(document.f1.serial_deco.value.length!=12){
						alert("Error, el serial del decodificador debe de ser de 12 digitos");
						document.f1.serial_deco.select();
						return false;
					}else{
						return true;
					}
				}
}
function valida_tam_campo_deco_ana(){
				if(document.f1.punto_da.value=="SM"){
					if(document.f1.codigo_da.value.length!=7){
						alert("Error, serial del decodificador es de 7 digitos");
							document.f1.codigo_da.select();
						return false;
					}else{
						if(document.f1.nota2.value.length!=9){
							alert("Error, el codigo2 es de 9 digitos");
								document.f1.nota2.select();
							return false;
						}else{
							return true;
						}
					}
				}
				else{
					if(document.f1.codigo_da.value.length!=12){
						alert("Error, el serial del decodificador debe de ser de 12 digitos");
						document.f1.codigo_da.select();
						return false;
					}else{
						return true;
					}
				}
}




function validapuntoventa(){
	log(parseFloat(document.f1.monto_punto_venta.value))
	if(parseFloat(document.f1.monto_punto_venta.value)>0){

		if(document.f1.numero_lote_pv.value=='' || document.f1.id_cuba.value=='0'  ){
			alert("Error, debe seleccionar la cuenta e introducir el numero de lote de la tarjeta de debito");
				document.f1.numero_lote_pv.select();
			return false;
		}
	}
	log(parseFloat(document.f1.monto_punto_venta_c.value))
	if(parseFloat(document.f1.monto_punto_venta_c.value)>0){
		if(document.f1.numero_lote_pv_c.value=='' || document.f1.id_cuba_c.value=='0'  ){
			alert("Error, debe seleccionar la cuenta e introducir el numero de lote de la tarjeta de credito");
				document.f1.numero_lote_pv_c.select();
			return false;
		}
	}
	return true;
}

function buscar_pagos_pend(){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_pagos_pendientes.php?id_franq="+id_franq()+"&fecha_desde_ctb="+fecha_desde_ctb()+"&fecha_hasta_ctb="+fecha_hasta_ctb()+"&status_df="+document.f1.status_df.value+"&";
			updateTable();
}

function iniciar_proceso_conciliacion(){
	conexionPHP("informacion.php","identificar_pago_cli");		
	document.getElementById('identificar_pago_cli').innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;"><span class="fuente"><img id="loading" src="imagenes/loading.gif"><br></span></div>';
}

function sumarmonto(){
	var monto_punto_venta=parseFloat(document.f1.monto_punto_venta.value);
	var monto_efectivo=parseFloat(document.f1.monto_efectivo.value);
	document.f1.monto_total.value=monto_punto_venta+monto_efectivo;
}
function cargar_cierre_estacion(){
	conexionPHP("cirre_diario_et1.php",formatdate(document.f1.fecha_cierre.value)+"=@"+id_est());		
	document.getElementById('identificar_pago_cli').innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;"><span class="fuente"><img id="loading" src="imagenes/loading.gif"><br></span></div>';
}

function cargar_todos_pagos_pend(){
	conexionPHP("informacion.php","cargar_todos_pagos_pend",'');
}
