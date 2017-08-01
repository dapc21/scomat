//funcion que permite crear el objeto Ajax.
function nuevoAjax(){
	var xmlhttp=false;
	try{
		//Creacion del objeto AJAX para navegadores no IE
		//xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e){
		try{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		}
		catch(E) { xmlhttp=false;}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); }
	return xmlhttp;
}
//para crear la conexion a traves de AJAX al servidor donde esta instalado php
//archivoPHP: nombre o ruta de archivo al que desea llamar;
//clase:  la clase con que desea comunicarse; 
// cadena: la lista de parametros o datos adicionales;
//tipoDato:  la operacion que desea realizar)
function conexionPHP(archivoPHP,clase,cadena,tipoDato=''){
	//devuelve el numero de parametro recibidos
	var arg=conexionPHP.arguments.length;
	//crea el objeto AJAX
	var ajax=nuevoAjax();
	//abre la conexion con php
	ajax.open("POST", archivoPHP, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//envia los datos a traves de AJAX concatenados con =@
	//alerta("d="+tipoDato+"=@"+clase+"=@"+cadena)
	if(archivoPHP=="administrar.php")
		ajax.send("d="+tipoDato+"=@"+clase+"=@"+cadena);
	else
		ajax.send("d="+clase+"=@"+cadena);
		
	if(archivoPHP=="formulario.php" && clase!='Sesion' && clase!='bienvenidos_saeco'){
		document.getElementById("principal").innerHTML='<BR><BR><BR><BR><BR><div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;">POR FAVOR ESPERE !!!<br><i class="fa fa-spinner fa-spin fa-2x"></i></div>';
	}
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			//alerta(":"+ajax.responseText+":");
			//obtiene la respuesta del servidor;  verifica la seguridad
			if(ajax.responseText=="SecurityFalse"){
				alerta("Error. Intento de Violación de Seguridad, la Sesión será reiniciada.");
				conexionPHP('formulario.php','Sesion');
			}
			else{
				if(clase=="DataGrid"){
					if(ajax.responseText=='true'){
						alerta("TRANSACCION COMPLETADA CON EXITO");
							conexionPHP('formulario.php',"status_contrato");
					}
					//alert(":"+divDataGrid+":")
					document.getElementById(divDataGrid).innerHTML = ajax.responseText;
					
					//alerta(":"+divDataGrid+":"+claseGlobal+":")
					//alerta(divDataGrid);
					if(divDataGrid=="cargos"){
						divDataGrid="datagrid";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_contrato_servicio.php?&id_contrato="+id_contrato()+"&";
						updateTable();
					}
					else if(divDataGrid=="datagrid" && claseGlobal=="pagos"){
						document.f1.saldo1.value=document.f1.sald.value;
						if(document.f1.id_select.value!=''){
							asignar_check_pagos();
						}
					}
					/*
					else if(divDataGrid=="datagrid" && claseGlobal=="act_contrato"){
						divDataGrid="decoana";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_decoana.php?&id_contrato="+id_contrato()+"&";
						updateTable();
					}/*
					else if(divDataGrid=="decoana" && claseGlobal=="act_contrato"){
						divDataGrid="cablemo";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_cablemo.php?&id_contrato="+id_contrato()+"&";
						updateTable();
					}*/
					
					else if(divDataGrid=="datagrid" && claseGlobal=="act_contrato" && modulo_cable_modem_G=='1'){
						divDataGrid="cablemo";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_cablemo.php?&id_contrato="+id_contrato()+"&";
						updateTable();
					}
					else if(divDataGrid=="cablemo" && claseGlobal=="act_contrato" && modulo_cable_modem_G=='1'){
						divDataGrid="decoana";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_decoana.php?&id_contrato="+id_contrato()+"&";
						updateTable();
					}
					else if(divDataGrid=="decoana" && claseGlobal=="act_contrato" && modulo_cable_modem_G=='1'){
						conexionPHP("informacion.php","traer_serv_acc_susc",id_contrato());
						mostrar_estado_cuenta();
					}
					/*
					else if(divDataGrid=="datagrid" && claseGlobal=="act_contrato"){
						//alerta("HOLA");
						divDataGrid="promocion";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_promocion_contrato.php?&id_contrato="+id_contrato()+"&";
						updateTable();
					}
					else if(divDataGrid=="promocion" && claseGlobal=="act_contrato"){
						divDataGrid="pagodep";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_pagodeposito_act.php?&id_contrato="+id_contrato()+"&";
						updateTable();
					}
					*/
					else if(divDataGrid=="tecnico"){
						conexionPHP("informacion.php","trae_tec_gru_disable");
						
						divDataGrid="grupo_ubicacion";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_grupo_ubicacion.php?organizar_por=ZONAS&";
						document.f1.organizar_por.value='ZONAS';
						document.f1.id_zona.disabled=true;
						document.f1.id_zona.value='';
						updateTable();
					}else if(divDataGrid=="grupo_ubicacion"){
						if(trae_ubi_gru_f_G==true){
							conexionPHP("informacion.php","trae_ubi_gru",id_gt()+"=@"+document.f1.organizar_por.value);
							trae_ubi_gru_f_G=false;
							conexionPHP("informacion.php","trae_ubi_gru_disable_existe",id_gt()+"=@"+document.f1.organizar_por.value);
						} else{
							conexionPHP("informacion.php","trae_ubi_gru_disable",document.f1.organizar_por.value);
						}
						divDataGrid="grupo";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_grupo_trabajo.php";
						updateTable();
					}
					else if(divDataGrid=="datagrid" && claseGlobal=="promocion"){
						divDataGrid="servi_promo";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_servicios_promo.php";
						updateTable();
					}
					else if(divDataGrid=="datagrid" && claseGlobal=="convenio_pago"){
						cargar_calendario_cp();
						
						divDataGrid="convenios";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/convenio_pago.php?&id_contrato="+id_contrato()+"&";
						updateTable();
					}
				}
				else{
					//Hace la llamada a respuestaPHP() para que esla procesa la informacion devuelta
					if(arg==4)
						respuestaPHP(archivoPHP,clase,ajax.responseText,tipoDato);
					else
						respuestaPHP(archivoPHP,clase,ajax.responseText);
				}
			}
		}
	}
}
//funcion encargada de procesar toda la informacion devuelta del servidor.
//archivoPHP: nombre o ruta de archivo con que establecio la conexion;
//clase:  la clase con que desea comunicarse; 
// cadena: respuesta extraida del servidor
//mensaje: algun mensaje adicional)
function respuestaPHP(archivoPHP,clase,cadena,mensaje=''){
	//para limpiar la basura de la cadena
	cadena=limpiar(cadena);
	var arg=respuestaPHP.arguments.length;	
	/** VARIACIONES REALIZADAS TRAS NUEVAS INCORPORACIONES**********/
	/** capa donde se cargan todos los formularios**********/
	var capa=document.getElementById("principal"); 
	/** Llamado a la función cargarPrincipal(); que llama a elementos que se cargan en la capa "principal", Por ejm:
	capa cargando de cada llamado en el menú, scrollbar, tooltip. Archivo: scripts-jquery.js
	******/
	//$(document).ready( cargarPrincipal() ); 
	/** FIN VARIACIONES ********************************************/
	
	switch(archivoPHP){
	
		case "formulario.php":
		
		if(clase!="Sesion"){
			//conexionPHP("informacion.php","verificaSMS");
			asignaConstantes();
		}
		
		divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			claseGlobal=clase;
			//asigna la cadena al div principal
			//alerta(cadena);
			if(clase=="Modulo"){
				capa.innerHTML=cadena;
			}
			else{
				capa.innerHTML=cadena; 
			}
		if(claseGlobal=="Sesion"){

		
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
		
			conexionPHP("Seguridad/Seguridad.php","IniciarSesion","admin=@123456");
		}
		
		if(clase=="graficoIngresoDeuda"){
			$('#gr').html('<div id="gr-cargando"><img src="bootstrap/img/ajax-loader.gif"/><br>Cargando...</div>');
			ajaxGrafico('ingresoDeuda','ingresoDeuda');
		}
		
		if(clase=="graficoIngresoDeudaMes"){
			var anio = parseInt($("#anio_f").val());
			var franq = $("#id_franq").val();
			$('#gr').html('<div id="gr-cargando"><img src="bootstrap/img/ajax-loader.gif"/><br>Cargando...</div>');
			ajaxGraficoMes('ingresoDeudaMes','ingresoDeudaParamMes', anio, franq);
		}
		
		if(clase=="graficoAbonado"){
			$('#gr').html('<div id="gr-cargando"><img src="bootstrap/img/ajax-loader.gif"/><br>Cargando...</div>');
			ajaxGrafico('abonado','abo');
		}
		
		if(clase=="graficoAbonadoMes"){
			var anio = parseInt($("#anio_f").val());
			var franq = $("#id_franq").val();
			$('#gr').html('<div id="gr-cargando"><img src="bootstrap/img/ajax-loader.gif"/><br>Cargando...</div>');
			ajaxGraficoMes('abonadoMes','aboParamMes', anio, franq);
		}
		
		if(clase=="graficoOrdenAsignada"){
			$('#gr').html('<div id="gr-cargando"><img src="bootstrap/img/ajax-loader.gif"/><br>Cargando...</div>');
			ajaxGrafico('ordenAsignada','ordAsig');
		}
		
		if(clase=="graficoOrdenAsignadaMes"){
			var anio = parseInt($("#anio_f").val());
			var franq = $("#id_franq").val();
			$('#gr').html('<div id="gr-cargando"><img src="bootstrap/img/ajax-loader.gif"/><br>Cargando...</div>');
			ajaxGraficoMes('ordenAsignadaMes','ordAsigParamMes', anio, franq);
		}
		
		if(clase=="graficoOrdenImpresa"){
			$('#gr').html('<div id="gr-cargando"><img src="bootstrap/img/ajax-loader.gif"/><br>Cargando...</div>');
			ajaxGrafico('ordenImpresa','ordImp');
		}
		
		if(clase=="graficoOrdenImpresaMes"){
			var anio = parseInt($("#anio_f").val());
			var franq = $("#id_franq").val();
			$('#gr').html('<div id="gr-cargando"><img src="bootstrap/img/ajax-loader.gif"/><br>Cargando...</div>');
			ajaxGraficoMes('ordenImpresaMes','ordImpParamMes', anio, franq);
		}
		
		if(clase=="graficoOrdenFinalizada"){
			$('#gr').html('<div id="gr-cargando"><img src="bootstrap/img/ajax-loader.gif"/><br>Cargando...</div>');
			ajaxGrafico('ordenFinalizada','ordFin');
		}
		
		if(clase=="graficoOrdenFinalizadaMes"){
			var anio = parseInt($("#anio_f").val());
			var franq = $("#id_franq").val();
			$('#gr').html('<div id="gr-cargando"><img src="bootstrap/img/ajax-loader.gif"/><br>Cargando...</div>');
			ajaxGraficoMes('ordenFinalizadaMes','ordFinParamMes', anio, franq);
		}
		
		if(clase=="tecnico"){
			numGlobal=num_tecnico();
			include_once("JGPlot/jquery.jqplot.js");
		}
		else if(clase=="vendedor"){
			numGlobal=nro_vendedor();
		//	include_once("JGPlot/jquery.jqplot.css");
		}
		else if(clase=="cobrador"){
			numGlobal=nro_cobrador();
		}
		else if(clase=="gerentes_permitidos"){
			numGlobal=nro_gerente();
		}
		if(claseGlobal=="config_sms"){
			validarconfig_sms();
		}
		if(claseGlobal=="datos_mensaje"){
			cuenta_carac_com_m();
		}
		if(clase=="variables_sms"){
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_variables_sms.php";
			updateTable();
		}
		
		if(clase=="list_falla"){
			cuenta_carac_com();
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/list_falla.php";
			updateTable();
		}
		else if(clase=="list_denuncia"){
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/list_denuncia.php";
			updateTable();
		}
		else if(clase=="list_reclamo"){
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/list_reclamo.php";
			updateTable();
		}
		if(clase=="gerentes_permitidos"){
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_gerentes_permitidos.php";
			updateTable();
		}
		if(clase=="formato_sms"){
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_formato_sms.php";
			updateTable();
		}
		if(clase=="Rep_detallecobros"){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="reportes/Rep_detallecobros.php";
			updateTable();
		}
		if(clase=="Rep_CierreDiario"){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			//archivoDataGrid="reportes/Rep_CierreDiario.php";
			//updateTable();
		}
		if(claseGlobal=="contrato_ser"){
			conexionPHP("informacion.php","traerContrato_ser");
		}
		
		if(clase=="Rep_orden"){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="reportes/Rep_orden.php";
			updateTable();
		}
		if(clase=="Rep_libroventa_tec"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		}
		if(clase=="pago_comisones"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		}
		if(clase=="pagodeposito_conf"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		}
		if(clase=="Rep_libroventa"){
			/*
			$(function () {
                $('#datetimepicker6').datetimepicker();
            });
			*/
			if(document.f1.id_f.value!='0'){
				document.f1.id_franq.value=document.f1.id_f.value;
				document.f1.id_franq.disabled=true;
			} 
			
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="reportes/Rep_libroventa.php";
			//updateTable();
			
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
			//$(function() {$('#desde').datepicker({changeMonth: true,changeYear: true});});
			//$(function() {$('#hasta').datepicker({changeMonth: true,changeYear: true});});
			
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('desde'),'',2000,2030);
		//	obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('hasta'),'',2000,2030);
		}
		
		if(clase=="datapicket"){
			
			$(function () {
                $('#datetimepicker6').datetimepicker();
            });
			
		}
	
		if(clase=="ingreso_x_serv"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		}
		if(clase=="ingreso_x_serv1"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		}
		if(clase=="Rep_libro_cobrador"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		}
		
		if(clase=="Rep_libro_vendedor"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		}
		if(clase=="Rep_totalclientes"){
			/*if(document.f1.id_f.value!='0'){
				document.f1.status_serv[1].checked=1;
				document.f1.status_serv[0].disabled=true;
				document.f1.status_serv[1].disabled=true;
				hab_total_cli_ubi();
			 
				document.f1.id_franq.value=document.f1.id_f.value;
				document.f1.id_franq.disabled=true;
				document.f1.id_franq.disabled=true;
			} 
			*/
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="reportes/Rep_totalclientes.php";
			//updateTable();
			
		}
		if(clase=="reimp_cierre_caja"){
			//myCalendar = new dhtmlXCalendarObject(["desde"]);
		}
		if(clase=="cierre_x_fecha"){
			//myCalendar = new dhtmlXCalendarObject(["desde","hasta"]);
		}
		if(clase=="reimp_cierre_diario"){
			//myCalendar = new dhtmlXCalendarObject(["desde"]);
		}
		if(clase=="reimp_cierre_diario1"){
			//myCalendar = new dhtmlXCalendarObject(["desde"]);
		}
			
		if(clase=='deposito_bancos'){
			//myCalendar = new dhtmlXCalendarObject(["fecha_db"]);
		}	
		if(clase=='tabla_cortes'){
			//myCalendar = new dhtmlXCalendarObject(["fecha_tc"]);
		
		}
		if(clase=='cuenta_bancos'){
			//myCalendar = new dhtmlXCalendarObject(["fecha_cb","fecha_reg"]);
			
		}	
		if(clase=='conciliacion_pago'){
			//myCalendar = new dhtmlXCalendarObject(["fecha_conc"]);
		}	
		
		if(clase=="Rep_libroventa1"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		}
		if(clase=="Rep_recuperados"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		}
		if(clase=="Rep_notas"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
		}
		if(clase=="Rep_estadocuenta"){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="reportes/Rep_estadocuenta.php";
		//	updateTable();
		}
		if(clase=="Rep_historialpago"){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="reportes/Rep_historialpago.php";
			//updateTable();
		}
		if(clase=="Rep_PERFILES"){
			archivoDataGrid="reportes/Rep_PERFILES.php";
			updateTable();
		}
		if(clase=="Rep_zona"){
			archivoDataGrid="reportes/Rep_zona.php";
			updateTable();
		}
		if(clase=="Rep_fran"){
			archivoDataGrid="reportes/Rep_fran.php";
			updateTable();
		}
		if(clase=="Rep_sector"){
			archivoDataGrid="reportes/Rep_sector.php";
			updateTable();
		}
		if(clase=="Rep_calle"){
			archivoDataGrid="reportes/Rep_calle.php";
			updateTable();
		}
		if(clase=="Rep_zona_p"){
			archivoDataGrid="reportes/Rep_zona_p.php";
			updateTable();
		}
		if(clase=="Rep_fran_p"){
			archivoDataGrid="reportes/Rep_fran_p.php";
			updateTable();
		}
		if(clase=="Rep_sector_p"){
			archivoDataGrid="reportes/Rep_sector_p.php";
			updateTable();
		}
		if(clase=="Rep_calle_p"){
			archivoDataGrid="reportes/Rep_calle_p.php";
			updateTable();
		}
		//alerta(clase)
		if(clase=="Rep_deudazona"){
			archivoDataGrid="reportes/Rep_deudazona.php";
			updateTable();
		}
		if(clase=="Rep_deudafran"){
			archivoDataGrid="reportes/Rep_deudafran.php";
			updateTable();
		}
		if(clase=="deuda_mes"){
			archivoDataGrid="reportes/Rep_deuda_mes.php";
			updateTable();
		}
		if(clase=="analisis_ven"){
			archivoDataGrid="reportes/analisis_ven.php";
		//	updateTable();
		}
		if(clase=="Rep_deudasector"){
			archivoDataGrid="reportes/Rep_deudasector.php";
		//	updateTable();
		}
		if(clase=="Rep_deudacalle"){
			archivoDataGrid="reportes/Rep_deudacalle.php";
			updateTable();
		}
		if(clase=="Rep_ORDENESTECNICOS"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
			archivoDataGrid="reportes/Rep_ORDENESTECNICOS.php";
			//updateTable();
		}	
		if(clase=="Rep_ORDENESTECNICOSC"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
			archivoDataGrid="reportes/Rep_ORDENESTECNICOS.php";
			//updateTable();
		}
		if(clase=="Rep_ORDENESTECNICOS"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
			archivoDataGrid="reportes/Rep_ORDENESTECNICOS.php";
			//updateTable();
		}
		if(clase=="NuevoModuloReporte"){}
			
			if( claseGlobal!="bienvenidos_saeco" &&  claseGlobal!="imprimir_ordenes_tecnicos" && claseGlobal!="final_ordenes_tecnicos" && claseGlobal!="pagos" && clase!="cerrar_caja" && clase!="Sesion" && clase!="CreaFormulario" && clase!="VerDatos"  && clase!="Configuracion" ){
				boton(false,true,true,claseGlobal);
			}
		if(clase=="Configuracion"){
			conexionPHP("informacion.php","Manejador");
		}
		if(clase=="cerrar_caja"){
			//validarcaja_cobrador();
			archivoDataGrid="reportes/Rep_detallecobros.php?&id_caja_cob="+id_caja_cob()+"&";
			updateTable();
		}
		if(clase=="persona_atc"){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_persona.php";
			updateTable();
		}
		if(clase=="autorizar_abrir_caja" || clase=="detalle_tipopago_df" || clase=="carga_tabla_banco" || clase=="tabla_bancos" || clase=="tipo_pago_df" || clase=="cuenta_bancaria" || clase=="marca" || clase=="modelo" || clase=="deco_servicio" || clase=="interfazacc" || clase=="interfaz_cablemodem" || clase=="solo_imprimir" || clase=="asigna_llamada" || clase=="asig_lla_cli" || clase=="tipo_llamada" || clase=="detalle_resp" || clase=="tipo_resp" ||  clase=="descuento_pronto_pag" || clase=="tabla_cortes" || clase=="cuenta_bancos" || clase=="conciliacion_pago" || clase=="notas_conf" ||  clase=="servidor" || clase=="inicial_id" || clase=="sincronizacion_servi" || clase=="pagodeposito"  || clase=="conf_comision" || clase=="pago_comisones_c" || clase=="proceso_corte" || clase=="promocion" || clase=="promo_serv" || clase=="promo_contrato" || clase=="convenio_pago" || clase=="conv_con" || clase=="grupo_afinidad"  || clase=="info_adic" || clase=="cablemodem" || clase=="deco_ana" || clase=="estado" || clase=="municipio" || clase=="ciudad" || clase=="tipo_alarma" || clase=="alarma_perfil" || clase=="alarmas" || clase=="grupo_ubicacion" || clase=="estacion_trabajo" || clase=="precintos" || clase=="Perfil" || clase=="statuscont" || clase=="motivollamada" || clase=="motivonotas" || clase=="tipo_orden" || clase=="tipo_orden" || clase=="cobrador" || clase=="vendedor" || clase=="cliente" || clase=="tecnico" || clase=="tipo_orden" || clase=="detalle_orden"  || clase=="franquicia" || clase=="parametros" || clase=="calle" || clase=="urbanizacion" || clase=="sector" || clase=="zona" || clase=="materiales" || clase=="ent_sal_mat" || clase=="inventario" || clase=="inventario_materiale" || clase=="tipo_servicio" || clase=="servicios" || clase=="tarifa_servicio" || clase=="contrato_servicio" || clase=="pago_servicio" || clase=="detalle_tipopago" || clase=="tipo_pago" || clase=="cierre_pago" || clase=="caja" || clase=="reclamo_denuncia" || clase=="comentario_cliente" || clase=="pago_comisiones" || clase=="edificio" || clase=="banco" || clase=="sms" || clase=="envio_aut" || clase=="comandos_sms" || clase=="otros_datos"  || clase=="contrato_servicio" || clase=="familia" || clase=="NuevoModuloDataGrid"){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_"+clase+".php";
			updateTable();
		}
		if(clase=="pagodeposito_conf"){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_pagodeposito_conf.php";
			updateTable();
		}
		if(clase=='asigna_llamada'){
			obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_all'),'',2014,2020);
		}	
		if(clase=='llamadas'){
		//	obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_lla'),'',2014,2020);
		}	
		if(clase=="pagodeposito_reg"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
			
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_pagodeposito_reg.php";
			updateTable();
		}
		
		if(clase=="recibe_recibo_c" ){
			//myCalendar = new dhtmlXCalendarObject(["fecha_rec"]);
		}
		
		if(clase=="recibe_recibo" ){
			//myCalendar = new dhtmlXCalendarObject(["fecha_rec"]);
		}
		else if(clase=='pagodeposito'){
			//myCalendar = new dhtmlXCalendarObject(["fecha_dep"]);
		/*	obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_reg'),'',2013,2020);
			obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_dep'),'',2013,2020);
			obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_conf'),'',2013,2020);
			obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_proc'),'',2013,2020);
			*/
		}	
		
		if(clase=="asigna_recibo_c" ){
			//myCalendar = new dhtmlXCalendarObject(["fecha_asig"]);
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_asigna_recibo.php?&tipo=CONTRATO&";
			updateTable();
		}
		
		if(clase=="asigna_recibo" ){
			//myCalendar = new dhtmlXCalendarObject(["fecha_asig"]);
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_asigna_recibo.php?&tipo=FACTURA&";
			updateTable();
		}
		
		
		if(clase=="grupo_trabajo"){
			divDataGrid="tecnico"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_grupo_tecnico.php";
			updateTable();
			
						divDataGrid="grupo_ubicacion";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_grupo_ubicacion.php?organizar_por=ZONAS&";
						document.f1.organizar_por.value='ZONAS';
						document.f1.id_zona.disabled=true;
						document.f1.id_zona.value='';
						updateTable();
						
						if(trae_ubi_gru_f_G==true){
							conexionPHP("informacion.php","trae_ubi_gru",id_gt()+"=@"+document.f1.organizar_por.value);
							trae_ubi_gru_f_G=false;
							conexionPHP("informacion.php","trae_ubi_gru_disable_existe",id_gt()+"=@"+document.f1.organizar_por.value);
						} else{
							conexionPHP("informacion.php","trae_ubi_gru_disable",document.f1.organizar_por.value);
						}
						divDataGrid="grupo";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_grupo_trabajo.php";
						updateTable();			

		}
		if(clase=="final_ordenes_tecnicos"){
			document.f1.nro_contrato.select();
			//myCalendar = new dhtmlXCalendarObject(["fecha_final","hasta","desde"]);
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_final_ordenes_tecnicos.php?id_gt=TODOS&";
			updateTable();

		}
		if(clase=="caja_cobrador"){
			//myCalendar = new dhtmlXCalendarObject(["fecha_sugerida"]);
		}
		if(clase=="anular_facturas"){
			//myCalendar = new dhtmlXCalendarObject(["fecha_sugerida"]);
		}
		if(clase=="factura"){
			datos_fiscal_G='';
		}
		if(clase=="anular_pagos"){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_anular_pagos.php";
			updateTable();
		}
		if(clase=="nota_de_credito"){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_anular_pagos.php";
			updateTable();
		}
		/*
		if(clase=='promocion'){
			//myCalendar = new dhtmlXCalendarObject(["inicio_promo","fin_promo","fecha_promo"]);
						//myCalendar.attachEvent("onClick",function(date, state){
				//  alerta("Date is changed to "+date) 
				if(mes_promo()!='0'){
					conexionPHP("informacion.php","calculafechapromocion",mes_promo()+"=@"+date);
				}
				else{
					alerta("Error, debe seleccionar la duracion");
					document.f1.inicio_promo.value='';
					document.f1.fin_promo.value='';
				}
			//})
		}
		*/
		if(clase=='agregar_promo_contrato'){
			document.f1.nro_contrato.select();
			//myCalendar = new dhtmlXCalendarObject(["inicio_promo"]);
			//myCalendar.attachEvent("onClick",function(date, state){
				//  alerta("Date is changed to "+date) 
				var date=document.getElementById("inicio_promo").value;
				conexionPHP("informacion.php","calculafechapromo",id_promo()+"=@"+date);
			//})
			
		}	
		if(clase=='promo_contrato'){
			//myCalendar = new dhtmlXCalendarObject(["inicio_promo","fin_promo"]);
		}	
		if(clase=='convenio_pago'){
			document.f1.nro_contrato.select();
			//myCalendar = new dhtmlXCalendarObject(["fecha_conv"]);
			//myCalendar1 = new dhtmlXCalendarObject(["fecha_lim"]);
			//myCalendar1.attachEvent("onClick",function(date, state){
				
				var fecha=date+"";
				//alerta(fecha)
				var meses=new Array();
				meses['Jan']='01';
				meses['Feb']='02';
				meses['Mar']='03';
				meses['Apr']='04';
				meses['May']='05';
				meses['Jun']='06';
				meses['Jul']='07';
				meses['Aug']='08';
				meses['Sep']='09';
				meses['Oct']='10';
				meses['Nov']='11';
				meses['Dec']='12';
				//$ini=explode(" ",$inicio_promo);
				var ini= fecha.split(" ");
				var mes=meses[ini[1]];
				dia=ini[2];
				anio=ini[3];
				var fecha=dia+"/"+mes+"/"+anio;
				asignar_fecha_lim(fecha);
			//})
		}	
		if(clase=='conv_con'){
			//myCalendar = new dhtmlXCalendarObject(["fecha_ven"]);
		}
		if(clase=="imprimir_ordenes_tecnicos_corte"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_imprimir_ordenes_tecnicos_corte.php?id_gt=TODOS&";
			updateTable();
		}
		if(clase=="imprimir_listado_llamada"){
			if(mensaje==''){
				//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="procesos/datagrid_imprimir_listado_llamada.php?login=TODOS&";
				updateTable();
			}
			else{
				ver_det_listado_llamada(mensaje);
			}	
		}
		
		if(clase=="imprimir_ordenes_tecnicos"){
			//myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_imprimir_ordenes_tecnicos.php?id_gt=TODOS&";
			updateTable();
		}
		
		if(clase=="devolver_ordenes_tecnicos"){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_devolver_ordenes_tecnicos.php";
			updateTable();
		}
		if(clase=="act_contrato"){
			id_cliente_G=document.f1.cli_id_persona.value;
			document.f1.nro_contrato.select();
			//InitAll();
			if(mensaje!='' && id_contrato_G!=''){
				conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato_G);
				id_contrato_G='';
			}
			
			if(id_cont_act_c!=''){
				conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_cont_act_c);
				id_cont_act_c='';
			}
			
			if(mensaje!='' && id_contrato_GP!=''){
				id_contrato_G=mensaje;
				conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato_G);
			}
				
			
		}
		if(clase=="pagos"){
			//myCalendar = new dhtmlXCalendarObject(["fecha_factura"]);
			
			if(id_contrato_G!=''){
				conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato_G);
				id_contrato_G='';
				id_contrato_GP='';
				ruta_G='';
			}
			else{
			
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_pagos.php";
			updateTable();
			}
			document.f1.cedula.focus();
			document.f1.nro_contrato.select();
			nro_facturaG=document.f1.nro_factura.value;
			
		}
		if(claseGlobal=="contrato"){
			document.f1.cedula.select();
			codGlobal=document.f1.cli_id_persona.value;
						divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_contrato_servicio.php?&id_contrato="+id_contrato()+"&";
						updateTable();
		}
		if(clase=="sal_mat"){
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_sal_mat.php";
			updateTable();
		}
		if(clase=="Usuario"){
			codGlobal=document.f1.id_persona;
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_usuario.php";
			updateTable();
		}
		
		if(clase=='ordenes_tecnicos'){
			document.f1.nro_contrato.select();
			if(mensaje!=''){
				id_contrato_G=mensaje;
				conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato_G);
			}
		}	
		if(clase=='llamadas'){
			if(mensaje!=''){
				document.f1.id_lc.value=id_lc_G;
				id_contrato_G=mensaje;
				conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato_G);
			}
		}	
		if(clase=='cargar_deuda'){
			document.f1.nro_contrato.select();
			if(mensaje!=''){
				id_contrato_G=mensaje;
				conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato_G);
			}
		}	
		if(clase=='parametros'){
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_param'),'',2000,2030);
		}	
		if(clase=='ent_sal_mat'){
			codGlobal=id_mat();
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_ent_sal'),'',2000,2030);
		}	
		if(clase=='inventario'){
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_inv'),'',2000,2030);
		}	
		if(clase=='tarifa_servicio'){
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_tar_ser'),'',2000,2030);
		}	
		if(clase=='contrato_servicio'){
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_inst'),'',2000,2030);
		}	
		if(clase=='contrato'){
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_contrato'),'',2000,2030);
		}	
		if(clase=='pagos'){
			contSel=0;
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_pago'),'',2000,2030);
		}	
		if(clase=='cirre_diario'){
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_cierre'),'',2000,2030);
		}
		if(clase=='caja_cobrador'){
			//alerta(id_per_global);
			document.f1.id_persona.value=id_per_global;
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_caja'),'',2000,2010);
		}
		if(clase=='anular_facturas'){
			//alerta(id_per_global);
			document.f1.id_persona.value=id_per_global;
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_caja'),'',2000,2010);
		}	
		if(clase=='reclamo_denuncia'){
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_rec'),'',2000,2030);
		}	
		if(clase=='comentario_cliente'){
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_comen'),'',2000,2030);
		}	
		if(clase=='pago_comisiones'){
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_comi'),'',2000,2030);
		}	
		if(clase=='pago_comisiones'){
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_desde'),'',2000,2030);
		}	
		if(clase=='pago_comisiones'){
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_hasta'),'',2000,2030);
		}	
		if(clase=='status_contrato'){
			//myCalendar = new dhtmlXCalendarObject(["hasta1","desde1"]);
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_status'),'',2000,2030);
		}
		
	  break;
	  
		case "informacion_externo.php":
			if(clase=="add_zona"){
				cade= cadena.split("=@");
				if(cade[0]==""){
					document.f1.id_zona.options[0]=new Option(cade[2],cade[1],true,"");
					document.f1.id_zona.value=cade[1];
					ventana.close();
				}
				else {
					alerta("Error. durante la transaccion: "+cade[0]);
				}
			}
			else if(clase=="add_sector"){
				cade= cadena.split("=@");
				if(cade[0]==""){
					document.f1.id_sector.options[0]=new Option(cade[2],cade[1],true,"");
					document.f1.id_sector.value=cade[1];
					ventana.close();
				}
				else {
					alerta("Error. durante la transaccion: "+cade[0]);
				}
			}
			else if(clase=="add_calle"){
				cade= cadena.split("=@");
				if(cade[0]==""){
					document.f1.id_calle.options[0]=new Option(cade[2],cade[1],true,"");
					document.f1.id_calle.value=cade[1];
					ventana.close();
				}
				else {
					alerta("Error. durante la transaccion: "+cade[0]);
				}
			}
			else if(clase=="add_urb"){
				cade= cadena.split("=@");
				if(cade[0]==""){
					document.f1.urbanizacion.options[0]=new Option(cade[2],cade[1],true,"");
					document.f1.urbanizacion.value=cade[1];
					ventana.close();
				}
				else {
					alerta("Error. durante la transaccion: "+cade[0]);
				}
			}
			else if(clase=="add_edificio"){
				cade= cadena.split("=@");
				if(cade[0]==""){
					document.f1.edificio.options[0]=new Option(cade[2],cade[1],true,"");
					document.f1.edificio.value=cade[1];
					ventana.close();
				}
				else {
					alerta("Error. durante la transaccion: "+cade[0]);
				}
			}
		break;

	  case "informacion.php":
			if(clase=="cargar_estado"){
				capa=document.getElementById("id_esta");
			}
			else if(clase=="cargar_todos_pagos_pend"){
				capa=document.getElementById("id_df_tp");
			}
			else if(clase=="traer_datos_abonado"){
				capa=document.getElementById("id_abonado");
			}
			else if(clase=="cargar_detalle_resp"){
				capa=document.getElementById("id_drl");
			}
			else if(clase=="bcargarZona_franq"){
				capa=document.getElementById("bid_zona");
			}
			else if(clase=="cargar_marca"){
				capa=document.getElementById("id_marca");
			}
			else if(clase=="cargar_modelo"){
				capa=document.getElementById("id_modelo");
			}
			else if(clase=="cargar_modelo_m"){
				capa=document.getElementById("id_modelo");
			}
			else if(clase=="bcargarSector"){
				capa=document.getElementById("bid_sector");
			}
			else if(clase=="bcargarCalle"){
				capa=document.getElementById("bid_calle");
			}
			else if(clase=="verServiciosCheck"){
				capa=document.getElementById("id_check_serv");
			}
			else if(clase=="cargar_cob_ven"){
				capa=document.getElementById("id_cobrador");
			}
			else if(clase=="identificar_pago_cli"){
				capa=document.getElementById("identificar_pago_cli");
			}
			else if(clase=="conciliar_pago_cli"){
				capa=document.getElementById("conciliar_pago_cli");
			}
			else if(clase=="conciliar_pago_franq"){
				capa=document.getElementById("conciliar_pago_franq");
			}
			else if(clase=="cargar_municipio"){
				capa=document.getElementById("id_mun");
			}
			else if(clase=="cargar_ciudad"){
				capa=document.getElementById("id_ciudad");
			}
			
			if(clase=="traer_tipo_pago"){
				capa=document.getElementById("id_tipo_pago1");
			}
			if(clase=="traerMensualidad"){
				capa=document.getElementById("mes");
			}
			if(clase=="traerTOStatus"){
				capa=document.getElementById("id_tipo_orden");
			}
			if(clase=="cargarServicioMensual"){
				capa=document.getElementById("id_serv");
			}
			if(clase=="cargar_servicio_tv"){
				capa=document.getElementById("id_serv");
			}
			if(clase=="cargarServicio"){
				capa=document.getElementById("id_serv");
			}	
			if(clase=="cargarZona"){
				capa=document.getElementById("id_zona");
			}	
			if(clase=="cargarDO"){
				capa=document.getElementById("id_det_orden");
			}	
			if(clase=="cargarDO1"){
				capa=document.getElementById("id_det_orden");
			}	
			if(clase=="cargarDOF"){
				capa=document.getElementById("nombre_det_orden");
				
			}	
			if(clase=="cargarTipoSer"){
				capa=document.getElementById("id_tipo_servicio");
			}	
			if(clase=="cargarSector"){
				capa=document.getElementById("id_sector");
			}
			if(clase=="cargarCalle"){
				capa=document.getElementById("id_calle");
			}
			if(clase=="cargarUrb"){
				capa=document.getElementById("urbanizacion");
			}
			if(clase=="traer_equipo_fiscal"){
				capa=document.getElementById("id_est");
			}
			if(clase=="cargarEdif"){
				if(edificio()=="0"){
					capa=document.getElementById("edificio");
				}
				else{
					capa=document.getElementById("edif_malo");
				}
			}
			
			if(clase=="Limpieza" || clase=="LimpiezaModulo"){
				capa=document.getElementById("plantilla");
			}	
			if(clase=="IniciarSesion"){
				cargarModulos(cadena);
			}
			else if(clase=="CargaObjeto" || clase=="CargaRegistro"){
				cargarDatos(cadena);
			}
			else if(clase=="ObjetoFormulario"){
				traerDatos(cadena);
			}
			else if(clase=="Manejador"){
				asignarCampos(clase,cadena);
			}
			else if(clase=="TraerModulo1"){
				asignarModulo(cadena);
			}
			else if(clase=="TraerModulo"){
				asignarModulo(cadena);
			}	
			else if(clase=="camposRep2"){
				document.getElementById("AllFields").innerHTML=cadena;
			}
			else if(clase=="validarSQL"){
				if(cadena=="true"){
					if(priSQL){
						alerta("Validacion Completada Con exito");
					}
					valSQL=true;
					priSQL=true;
				}
				else{
					alerta("Error, consulta SQL Erronea");
					valSQL=false;
				}
			}
			else if(clase=="traerTipoSer"){
				cade= cadena.split("=@");
				document.f1.id_tipo_servicio.value=cade[1];
				if(claseGlobal!='aviso_cobro'){
					document.f1.id_franq.value=cade[2];
				}
			}
			else if(clase=="traerFranq"){
				cade= cadena.split("=@");
				document.f1.id_franq.value=cade[1];
			}
			else if(clase=="traer_sistema_marca"){
				cade= cadena.split("=@");
				document.f1.id_marca.value=cade[1];
				document.f1.id_tse.value=cade[2];
			}
			else if(clase=="traerTO"){
				cade= cadena.split("=@");
				document.f1.id_tipo_orden.value=cade[1];
			}
			
			else if(clase=="traerFranqSer"){
				cade= cadena.split("=@");
				document.f1.id_franq.value=cade[1];
			}
			else if(clase=="tCodContSer"){
				cade= cadena.split("=@");
				document.f1.id_cont_serv.value=cade[1];
			}
			else if(clase=="calcularMontoPago"){
				cade= cadena.split("=@");
				document.f1.monto_pago.value=cade[1];
			}
			else if(clase=="montoCierrePunto"){
				cade= cadena.split("=@");
				document.f1.monto_acum.value=cade[1];
			}
			else if(clase=="ActualizarCampo"){	
				if(claseGlobal=="act_contrato"){
					divDataGrid="cargos"; 
					archivoDataGrid="procesos/datagrid_actualizar_pagos.php?&id_contrato="+id_contrato()+"&";
				}
				updateTable();
				cade= cadena.split("=@");
				var id_nota=cade[1];
				id_notaG=id_nota
				setTimeout('imp_nota_credito();', 2000);
				//location.href="reportepdf/imp_nota_credito.php?&id_nota="+id_nota+"&";
			}
			else if(clase=="agregar_mes"){
				//alerta(cadena);
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
					archivoDataGrid="procesos/datagrid_pagos.php?&id_contrato="+id_contrato()+"&";
				updateTable();
			}
			else if(clase=="agregar_cd"){
				//alerta(cadena);
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
					archivoDataGrid="procesos/datagrid_pagos.php?&id_contrato="+id_contrato()+"&";
				updateTable();
			}
			else if(clase=="agregar_punto"){
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="procesos/datagrid_pagos.php?&id_contrato="+id_contrato()+"&";
				updateTable();
			}
			else if(clase=="verificaOrden"){
				if(cadena=="ASIGNADO"){
					alerta("Aviso, Tiene una orden asignada");
				}
				else if(cadena=="IMPRESO"){
					alerta("Aviso, Tiene una orden Impresa");
				}
			}
			else if(clase=="filtrarcontrato"){
				//alerta(cadena);
				if(cadena==""){
					alerta("Error, este contrato no tiene una orden para finalizar");
					document.f1.nro_contrato.value='';
					document.f1.nro_contrato.select();
				}
				else{
					cade= cadena.split("=@");
					finOrdenTec(cade[1],cade[2],cade[3],cade[4],cade[5],cade[6],cade[7],cade[8],cade[9],cade[10],cade[11],cade[12]);
				}
			}
			else if(clase=="buscar_orden_final"){
				if(cadena==""){
					alerta("Error, este numero no corresponde a una orden para finalizar");
					document.f1.id_orden.value='';
					document.f1.id_orden.select();
				}
				else{
					cade= cadena.split("=@");
					finOrdenTec(cade[1],cade[2],cade[3],cade[4],cade[5],cade[6],cade[7],cade[8],cade[9],cade[10],cade[11],cade[12]);
				}
			}
			else if(clase=="trae_tec_gru"){
				asignar_tecnico(cadena);
			}
			
			else if(clase=="asignar_promo_serv"){
				asignar_promo_serv(cadena);
			}
			else if(clase=="trae_ubi_gru"){
				asignar_ubi_grupo(cadena);
			}
			else if(clase=="trae_tec_gru_disable" || clase=="trae_tec_gru_disable_existe"){
				trae_tec_gru_disable(cadena);
			}
			else if(clase=="trae_ubi_gru_disable"){
				trae_ubi_gru_disable(cadena);
			}
			
			else if(clase=="trae_ubi_gru_disable_existe"){
				trae_ubi_gru_disable(cadena);
			}
			else if(clase=="trae_info_grupo"){
				document.f1.id_gt.value=trim(cadena);
				if(cadena!=''){
					document.getElementById("id_gt").onchange();
				}
				else{
					document.getElementById("materiales").innerHTML='';
				}
			}
			else if(clase=="asig_falla_rep"){
				alerta("PROCESO REALIZADO");
				conexionPHP('formulario.php',"list_falla");
			}
			else if(clase=="rec_falla_rep"){
				alerta("PROCESO REALIZADO");
				conexionPHP('formulario.php',"list_falla");
			}
			else if(clase=="traeinfoFact"){
				if(cadena=="NO ANULAR"){
					alerta("Error, no se puede anular una factura de un dia anterior");
					if(claseGlobal=="nota_de_credito"){
						conexionPHP('formulario.php','nota_de_credito');
					}
					else{
						conexionPHP('formulario.php','anular_pagos');
					}
				}
				else{
					cade= cadena.split("=@");
					document.f1.cedula.value=cade[1];
					document.f1.nombre.value=cade[2];
					document.f1.apellido.value=cade[3];
					document.f1.nro_contrato.value=cade[4];
				}
			}
			else if(clase=="verificaSMS"){
				cade= cadena.split("=@");
				//toolbar.setItemText('smsno', cade[1]);
			}
			else if(clase=="traercs"){
				cade= cadena.split("=@");
				document.f1.costo.value=cade[1];
			}
			else if(clase=="buscardf" || clase=="buscardfID"){
			//alerta(cadena);
				if(cadena!=''){
					//alerta(cadena);
					var fiscal= cadena.split("-Fiscal-");
					var dato_fiscal= fiscal[1];
					var caden= fiscal[0];
					datos_fiscal_G=caden;
					cade= caden.split("=@");
				//	alerta(cade[18]);
					if(trim(cade[18])=="PRINCIPAL"){
						if(claseGlobal=="pagos" || claseGlobal=="pagodeposito_reg"){
						//	alerta(caden);
								if(tipo_facturacion=="BIXOLON"){
									imp_fiscal(caden);
								}
								else if(tipo_facturacion=="EPSON"){
									imp_fiscal(caden);
								}
						}
						else{
							document.getElementById("archivo").innerHTML=dato_fiscal;
							document.f1.registrar.disabled=false;
							document.f1.registrar1.disabled=false;
						}
						//
					}
					else{
						if(claseGlobal!="pagos"){
							alerta("No se puede cargar esta factura");
							document.getElementById("archivo").innerHTML='';
							document.f1.registrar.disabled=true;
						}
						else{
						//	conexionAJAX("ReporteJava/facturaPago.php?id_pago="+id_pago()+"&");
						}
					}
					
				}
				else{
				document.getElementById("archivo").innerHTML='';
						
					alerta("El numero de factura no esta registrado");
					document.f1.registrar.disabled=true;
					document.f1.id_pago.value='';
				}
			}
			
			else if(clase=="buscar_anular_df"){
				var fiscal= cadena.split("-Fiscal-");
				var dato_fiscal= fiscal[1];
				var caden= fiscal[0];
				cade= caden.split("=@");
				//alerta("hola:"+cade[18]+":"+cade[16]+":");
			
				//if(trim(cade[18])=="PRINCIPAL" && cade[16]!="CAJA EXTERNA"){
					//alerta("hola:"+cade[18]+":"+cade[16]+":");
				if(claseGlobal!="anular_pagos"){
					if (confirm('Seguro que desea REIMPRIMIR LA NOTA DE CREDITO\n'+caden)){
						imp_anular_fiscal(caden);
					}
				}else{
					imp_anular_fiscal(caden);
				}
				//}
				//alerta(cadena);
			}
			else if(clase=="c_id_contrato" || clase=="c_nro_contrato" || clase=="c_cedula"){
				if(cadena!=""){
					cade= cadena.split("=@");
					document.f1.id_contrato.value=cade[1];
					document.f1.nro_contrato.value=cade[2];
					document.f1.cedula.value=cade[3];

				}
				else{
					alerta("No se encontro ningun resultado");
				}
			}
			else if(clase=="c_id_pago" || clase=="c_nro_factura"  || clase=="c_nro_factura_nc" || clase=="c_nro_factura_nd" || clase=="c_nro_factura_reimp" || clase=="c_nro_control"){
				if(cadena!=""){
					document.getElementById("result").innerHTML=cadena;
					$(document).ready( cargarPrincipal() );
				}
				else{
					alerta("No se encontro ningun resultado");
				}
			}
			else if(clase=="traeinfoFactura_nc"){
				document.getElementById("result").innerHTML=cadena;
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				
				if(claseGlobal=="nota_credito_factura"){
						archivoDataGrid="procesos/datagrid_nota_credito.php?&id_contrato="+id_contrato()+"&id_pago="+id_pago()+"&monto_pago="+monto_pago()+"&";
						updateTable();
				}
				else if(claseGlobal=="nota_debito_factura"){
						archivoDataGrid="procesos/datagrid_nota_debito.php?&id_contrato="+id_contrato()+"&id_pago="+id_pago()+"&monto_pago="+monto_pago()+"&";
						updateTable();
				}
			}
			else if(clase=="anular_control"){
				if(cadena!=''){
					alerta("ERROR DURANTE LA ANULACION: "+cadena);
				}
				else{
					alerta("TRANSACCION COMPLETADA CON EXITO");
					conexionPHP('formulario.php','anular_control');
				}
			}
			else if(clase=="traerContrato_ser"){
				if(cadena!='false')
					asignarCampos("contrato_ser",cadena);
			}
			else if(clase=="verifica_cedula"){
				if(cadena!=""){
					cade= cadena.split("=@");
					var tipo=cade[0];
					var id_persona=cade[1];
					var nombre=cade[2];
					if(cade[0]=="CLIENTE"){
						if (confirm("AVISO: la cedula corresponde al cliente: "+nombre+", desea continuar? ")){
							conexionPHP("validarExistencia.php","1=@vista_cliente","id_persona=@"+id_persona);
						}
					}
					else{
						if (confirm("AVISO: la cedula corresponde al empleado: "+nombre+", desea continuar? ")){
							conexionPHP("validarExistencia.php","1=@persona","id_persona=@"+id_persona);
						}
					}
					
				}
			}
			else if(clase=="verifica_cedula1"){
				if(cadena!=""){
					cade= cadena.split("=@");
					var tipo=cade[0];
					var id_persona=cade[1];
					var nombre=cade[2];
					if(cade[0]=="CLIENTE"){
						alerta("AVISO: la cedula corresponde al cliente: "+nombre+", no se puede modificar ")
							
					}
					else{
						alerta("AVISO: la cedula corresponde al empleado: "+nombre+", no se puede modificar ")
							
					}
					document.f1.cedula.value='';
				}
			}else if(clase=="traerContrato_ser"){
				if(cadena!='false')
					asignarCampos("contrato_ser",cadena);
			}
			else if(clase=="cambiarIdioma"){
				if(cadena==''){
					alerta("Idioma Cambiado con Exito");
					javascript:location.reload();
				}
				else{
					alerta("Error, al cambiar idioma");
				}
			}
			else if(clase=="buscar_contr_act"){
				if(cadena!=''){
					alerta("Error el numero de contrato ya esta registrado");
					document.f1.n_contrato.value=document.f1.nro_contrato.value;
				}
			}
			else if(clase=="traer_municipio"){
				cade= cadena.split("=@");
				document.f1.id_mun.value=cade[1];
				document.f1.id_esta.value=cade[2];
				document.f1.id_franq.value=cade[3];
			}
			else if(clase=="traer_ciudad"){
				cade= cadena.split("=@");
				document.f1.id_ciudad.value=cade[1];
				document.f1.id_mun.value=cade[2];
				document.f1.id_esta.value=cade[3];
				document.f1.id_franq.value=cade[4];
			}
			else if(clase=="traerZona"){
				cade= cadena.split("=@");
				document.f1.id_zona.value=cade[1];
				document.f1.id_ciudad.value=cade[2];
				document.f1.id_mun.value=cade[3];
				document.f1.id_esta.value=cade[4];
				document.f1.id_franq.value=cade[5];
			}
			else if(clase=="traerSector"){
				cade= cadena.split("=@");
				document.f1.id_sector.value=cade[1];
				document.f1.id_zona.value=cade[2];
				document.f1.id_ciudad.value=cade[3];
				document.f1.id_mun.value=cade[4];
				document.f1.id_esta.value=cade[5];
				document.f1.id_franq.value=cade[6];
			}
			else if(clase=="traer_decuento"){
				cade= cadena.split("=@");
			//	document.f1.desc_confc.value=cade[1];
			//	document.f1.descuento_conf.value=cade[2];
			}
			else if(clase=="traerSectorUrb"){
				cade= cadena.split("=@");
				document.f1.id_sector.value=cade[1];
				document.f1.id_zona.value=cade[2];
				document.f1.id_ciudad.value=cade[3];
				document.f1.id_mun.value=cade[4];
				document.f1.id_esta.value=cade[5];
				document.f1.id_franq.value=cade[6];
			}
			else if(clase=="traerCalle"){
				cade= cadena.split("=@");
				document.f1.id_calle.value=cade[1];
				document.f1.id_sector.value=cade[2];
				document.f1.id_zona.value=cade[3];
				document.f1.id_ciudad.value=cade[4];
				document.f1.id_mun.value=cade[5];
				document.f1.id_esta.value=cade[6];
				document.f1.id_franq.value=cade[7];
			}
			else if(clase=="traer_estado"){
				cade= cadena.split("=@");
				document.f1.id_esta.value=cade[1];
				document.f1.id_franq.value=cade[2];
			}
			else if(clase=="traer_tipo_resp"){
				cade= cadena.split("=@");
				document.f1.id_trl.value=cade[1];
			}
			else if(clase=="traer_pais"){
				cade= cadena.split("=@");
				document.f1.id_franq.value=cade[1];
			}
			else if(clase=="traer_costo_servicio"){
				cade= cadena.split("=@");
				document.f1.costo_cobro.value=cade[1];
				if(cade[2]=="TRUE"){
					document.f1.costo_cobro.disabled=false;
				}
				else{
					document.f1.costo_cobro.disabled=true;
				}
				
			}
			else if(clase=="traerIDpago"){
				cade= cadena.split("=@");
				document.f1.id_pago.value=cade[1];
				document.f1.nro_factura.value=cade[2];
				if(document.f1.caja_externa.value!='OFICINA'){
					document.f1.nro_control.value=cade[3];
				}else{
					document.f1.nro_control.value='';
				}
			}
			else if(clase=="verifica_multiple_cont"){
				if(cadena=="multiple"){
					alerta("Aviso. el contratante tiene varios contratos seleccione uno")
					if(claseGlobal=="pagos"){
						
						ajaxVentana_BAT('Abonados', "buscar_avanzado_consultar_clientes");
						setTimeout('buscar_cedula_ba()', 2000);
						//abrirBusq_cont_avanz_mult()
					}
					else if(claseGlobal=="act_contrato"){
						
						ajaxVentana_BA('Abonados', "buscar_avanzado_consultar_clientes");
						setTimeout('buscar_cedula_b()', 2000);
						//abrirBusq_cont_avanz_mult()
					}
					else{
						ajaxVentana_BA('Abonados', "buscar_avanzado_consultar_clientes");
						setTimeout('buscar_cedula_ba()', 2000);
					}
				}
			}
			
			else if(clase=="valida_etiqueta"){
				if(cadena!=""){
					alerta("Error. el presinto / tag verde: "+etiqueta()+"  corresponde al abonado "+cadena)
					document.f1.etiqueta.value="";
				}
			}
			else if(clase=="buscar_deco"){
				if(cadena=="EXISTE"){
					alert(_("EL CODIGO YA ESTA REGISTRADO"))
					document.f1.etiqueta.value="";
				}
				else if(cadena!=""){
					alert(_("Error. el decodificador: "+codigo_da()+"  corresponde al contrato "+cadena))
					document.f1.etiqueta.value="";
				}
				
			}
			else if(clase=="refrescar_deco"){
				alert("Decodificadores Refrescados");
			}
			else if(clase=="valida_etiqueta_n"){
				if(cadena!=""){
					alerta("Error. el presinto / tag naranja: "+etiqueta()+"  corresponde al abonado "+cadena)
					document.f1.etiqueta.value="";
				}
				
			}
			else if(clase=="calculafechapromo"){
				if(cadena!=""){
					cade= cadena.split("=@");
					document.f1.fin_promo.value=formatdatei(cade[1]);
				}
				else {
					alerta("Error. debe introducir una fecha valida para esta promocion")
					document.f1.inicio_promo.value="";
					document.f1.fin_promo.value="";
				}
			}
			else if(clase=="calculafechapromocion"){
				if(cadena!=""){
					cade= cadena.split("=@");
					document.f1.fin_promo.value=formatdatei(cade[1]);
				}
				else {
					alerta("Error. debe introducir una fecha valida para esta promocion")
					document.f1.inicio_promo.value="";
					document.f1.fin_promo.value="";
				}
			}
			else if(clase=="anular_factura"){
				if(cadena!=""){
					alerta("Error. las siguientes facturas ya estan registradas: "+cadena)
					document.f1.desde.value='';
					document.f1.hasta.value='';
				}
				else {
					alerta("Facturas anuladas con exito")
					conexionPHP('formulario.php',"anular_facturas");
				}
			}
			else if(clase=="cambiar_grupo_trabajo"){
				if(cadena!=""){
					alerta("Error. las siguientes facturas ya estan registradas: "+cadena)
					
				}else{
					alerta("Cambio realizado con exito");
				}
				conexionPHP('formulario.php',claseGlobal);
			}
			
			else if(clase=="valida_fact"){
				cade= cadena.split("=@");
				//	alerta(":"+cade[1]+":");
				if(cade[1]!=""){
					alerta("Error, las siguientes numero de facturas estan asignadas:\n"+cade[1]);
					document.f1.cantidad.value='';
				}
			}
			/*else if(clase=="valida_fact_c"){
				cade= cadena.split("=@");
				if(cade[1]!=""){
					alerta("Error, las siguientes numero de facturas estan asignadas:\n"+cade[1]);
					document.f1.cantidad.value='';
				}
			}*/
			else if(clase=="valida_nro_control"){
				if(cadena!=""){
					alerta("Error, el numero de control no esta RECIBIDO");
					document.f1.nro_control.value='';
				}
			}
			else if(clase=="valida_num_ref"){
				if(cadena!=""){
					alerta("ERROR, "+cadena);
					document.f1.numero_ref.value='';
					document.f1.numero_ref.select();
				}
			}
			else if(clase=="validarcontrato_control"){
				if(cadena!=""){
					alerta("Error, el numero de contrato no esta ASIGNADO y RECIBIDO por este vendedor");
					document.f1.contrato_fisico.value='';
					document.f1.contrato_fisico.value='';
				}
			}
			else if(clase=="traer_numero_contrato"){
				cade= cadena.split("=@");
				if(cade[1]!=""){
					document.f1.contrato_fisico.value=cade[1];
					//document.f1.nro_contrato_nuevo.value=inicialG+cade[1];
					//document.f1.nro_contrato.value=inicialG+cade[1];
				}
				else{
					alerta("Error, este vendedor no tiene asignado y recibido ningun nro de contrato");
					document.f1.contrato_fisico.value='';
					document.f1.contrato_fisico.value='';
				}
			}
			else if(clase=="traeinfo_forma_pago"){
				resp_traeinfo_forma_pago(cadena);
			}
			else if(clase=="traer_numero_abonado"){
				cade= cadena.split("=@");
				if(cade[1]!=""){
					document.f1.nro_contrato_nuevo.value=inicialG+cade[1];
					document.f1.nro_contrato.value=inicialG+cade[1];
				}
				else{
					alerta("Error, este vendedor no tiene asignado y recibido ningun nro de contrato");
					document.f1.contrato_fisico.value='';
					document.f1.contrato_fisico.value='';
				}
			}
			else if(clase=="traer_datos_pago"){
				cade= cadena.split("=@");
				if(parseInt(cade[7])==0){
				
					document.f1.nro_contrato.value=cade[1];
					document.f1.cedula.value=cade[2];
					document.f1.cliente.value=cade[3];
					document.f1.id_caja_cob.value=cade[4];
					document.f1.monto_pago.value=cade[5];
					document.f1.id_pago.value=cade[6];
				}else{
					alerta("Error, Tiene "+parseInt(cade[7])+" pagos pendientes por facturar antes de esta fecha");
				}
					
			}
			else if(clase=="imprimir_factura_i"){
				reimprimir_factura(id_pago());
				conexionPHP('formulario.php','solo_imprimir');
			}
			else if(clase=="traer_infor_orden"){
					cade= cadena.split("=@");
					document.f1.postel.value=cade[1];
					document.f1.pto.value=cade[2];
			}
			else if(clase=="habilitar_cierre_caja"){
				alerta("Cerre habilitado con exito");
			}
			else if(clase=="desabilitar_cierre_caja"){
				alerta("Cerre desabilitado con exito");
			}
			else if(clase=="eliminar_proceso_corte"){
				alerta("Proceso de Corte eliminado con exito");
			}
			else if(clase=="confirmarpagodeposito"){
				alerta("TRANSACCION COMPLETADA CON EXITO");
				archivoDataGrid="procesos/datagrid_pagodeposito_conf.php?&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&id_franq="+document.f1.id_franq.value+"&tipo_fecha="+document.f1.tipo_fecha.value+"&";
				updateTable();
			}
			else if(clase=="confirmarpagodeposito_mod"){
				alerta("TRANSACCION COMPLETADA CON EXITO");
				document.f1.modifi.disabled=true;
				document.f1.id_pd.value=''
				document.f1.numero_ref.value='';
				document.f1.monto_dep.value='';
				archivoDataGrid="procesos/datagrid_pagodeposito_conf.php?&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&id_franq="+document.f1.id_franq.value+"&tipo_fecha="+document.f1.tipo_fecha.value+"&";
				updateTable();
			}
			else if(clase=="negarpagodeposito"){
				alerta("TRANSACCION COMPLETADA CON EXITO");
				archivoDataGrid="procesos/datagrid_pagodeposito_conf.php?&desde="+document.f1.desde.value+"&hasta="+document.f1.hasta.value+"&id_franq="+document.f1.id_franq.value+"&tipo_fecha="+document.f1.tipo_fecha.value+"&";
				updateTable();
			}
			else if(clase=="negar_nota_cd"){
				alerta("TRANSACCION COMPLETADA CON EXITO");
				archivoDataGrid="procesos/datagrid_notas_conf.php?&";
				updateTable();
			}
			else if(clase=="confirmar_nota_cd"){
				alerta("TRANSACCION COMPLETADA CON EXITO");
				archivoDataGrid="procesos/datagrid_notas_conf.php?&";
				updateTable();
			}
			else if(clase=="modificar_poste_cont"){
			}
			
			else if(clase=="ActualizarDeudaDC"){
				if(cadena!=''){
					alerta(cadena);
				}
			}
			else if(clase=="traer_serv_acc"){
				asignarCampos_serv_acc(cadena);
			}
			else if(clase=="traer_serv_franq"){
				asignarCampos_serv_franq(cadena);
			}
			else if(clase=="traer_serv_acc_susc"){
				asignarCampos_traer_serv_acc_susc(cadena);
			}
			else if(clase=="valida_numero_ref"){
				if(cadena!=''){
					alerta(cadena);
				}
			}

			else if(clase=="autorizar_abrir_caja"){
				alert( _("TRANSACCION COMPLETADA CON EXITO"));
				conexionPHP('formulario.php',"autorizar_abrir_caja");
			}
			
			else{
				capa.innerHTML=cadena;
			}
			if(clase=="cargarDOF"){
				document.f1.nombre_det_orden.value=id_det_orderG;
				if(document.f1.nombre_tipo_orden.value=="TIO00005"){
					document.f1.nombre_det_orden.disabled=false;
				}else{
					document.f1.nombre_det_orden.disabled=true;
				}
			}
			else if(clase=="identificar_pago_cli"){
				conexionPHP("informacion.php","conciliar_pago_cli");		
				document.getElementById('conciliar_pago_cli').innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;"><span class="fuente"><img id="loading" src="imagenes/loading.gif"><br></span></div>';
			}
			else if(clase=="conciliar_pago_cli"){
				conexionPHP("informacion.php","conciliar_pago_franq");		
				document.getElementById('conciliar_pago_franq').innerHTML='<div style="width: 100%;text-align: center;color:#058CB6;font-size:12pt;font-weight :bold;"><span class="fuente"><img id="loading" src="imagenes/loading.gif"><br></span></div>';
			}
	  break;
	   case "administrar.php":
	   if(clase=="pagodeposito" && mensaje=='registrar_dep'){
			var id_pagos= cadena.split("=@");
			var i=0;
			var tiempo=10;
			for(i=0;i<id_pagos.length-1;i++){
								setTimeout('mandar_imprimir_pago("'+id_pagos[i]+'")', tiempo);
								tiempo=tiempo+3000;
				
			}
	   }
	   else	if(clase!="modulo_perfil"){
			if (cadena=="true"){
				//alerta(clase+":"+claseGlobal);
					if(clase=="pagos"){
						if(mensaje=='incluir'){
							if(imp_factG==true){
								//alerta(":"+tipo_facturacion+":")
								if(tipo_facturacion=="FORMA_CONTINUA_MEDIA_CARTA_DOBLE_DERECHA"){
									conexionAJAX("ReporteJava/facturaPago.php?id_pago="+id_pago()+"&");
								}
								else if(tipo_facturacion=="BIXOLON"){
									conexionPHP("informacion.php","buscardf",id_pago());
								}
								else if(tipo_facturacion=="EPSON"){
									conexionPHP("informacion.php","buscardf",id_pago());
								}
								
							}
							conexionPHP('formulario.php',clase);
							conexionPHP_sms("sms.php","EnviarSMSAutomatico","Pago=@"+id_pago());
						}
						else if(mensaje=='anular'){
							alerta("TRANSACCION COMPLETADA CON EXITO");
							conexionPHP("informacion.php","buscar_anular_df",id_pago());
							conexionPHP('formulario.php','anular_pagos');
						}
						else if(mensaje=='nota_credito_factura'){
							alerta("TRANSACCION COMPLETADA CON EXITO");
							conexionPHP('formulario.php','nota_credito_factura');
						}
						else if(mensaje=='nota_debito_factura'){
							alerta("TRANSACCION COMPLETADA CON EXITO");
							conexionPHP('formulario.php','nota_debito_factura');
						}
						else if(mensaje=='modificar_forma_pago'){
							alerta("TRANSACCION COMPLETADA CON EXITO");
							conexionPHP('formulario.php','modificar_pagos');
						}
						else if(mensaje=='eliminar'){
							conexionPHP('formulario.php','anular_pagos');
						}
						else if(mensaje=='nota_de_credito'){
							conexionAJAX("ReporteJava/nota_credito_imp.php?id_pago="+id_pago()+"&");
							conexionPHP('formulario.php','nota_de_credito');
						}else if(mensaje=='modificar_num_fac'){
							conexionPHP('formulario.php','modificar_pagos1');
						}else if(mensaje=='modificar_num_control'){
							conexionPHP('formulario.php','modificar_pagos1');
						}
						else if(mensaje=='anularfactura'){
							conexionPHP('formulario.php',clase);
						}
						
					}
					else if(clase=="contrato" && claseGlobal=="act_datos"){
						parent.conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato());
						parent.dhxWins.window("w2").close();
					}
					else if(clase=="envio_aut" && claseGlobal=="edit_envio_aut"){
						parent.dhxWins.window("w2").close();
					}
					else if(clase=="comandos_sms"  && claseGlobal=="edit_comandos_sms"){
						parent.conexionPHP('formulario.php','config_comandos_sms');
						parent.dhxWins.window("w2").close();
					}
					else if(clase=="cargar_deuda" && claseGlobal=="cargar_d"){
						parent.conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato());
						parent.dhxWins.window("w2").close();
					}
					else if(clase=="ordenes_tecnicos" && claseGlobal=="asig_orden"){
						parent.dhxWins.window("w2").close();
						if(mensaje=="incluir" || mensaje=="finalizar"){
							parent.conexionPHP_sms("sms.php","EnviarSMSAutomatico","Ordenes=@"+id_orden()+"=@"+mensaje);
						}
					}
					else if(clase=="calle" && claseGlobal=="add_calle"){
						parent.document.f1.id_calle.options[0]=new Option(nombre_calle(),id_calle(),true,"");
						parent.document.f1.id_calle.value=document.f1.id_calle.value;
						parent.traerSector();
						parent.dhxWins.window("w2").close();
					}
					else if(clase=="sector"  && claseGlobal=="add_sector"){
						parent.document.f1.id_sector.options[0]=new Option(nombre_sector(),id_sector(),true,"");
						parent.document.f1.id_sector.value=document.f1.id_sector.value;
						parent.traerZona();
						parent.dhxWins.window("w2").close();
					}
					else if(clase=="zona"  && claseGlobal=="add_zona"){
						parent.document.f1.id_zona.options[0]=new Option(nombre_zona(),id_zona(),true,"");
						parent.document.f1.id_zona.value=document.f1.id_zona.value;
						parent.cargarSector();
						parent.dhxWins.window("w2").close();
					}
					else if(clase=="edificio"  && claseGlobal=="add_edificio"){
						parent.document.f1.edificio.options[0]=new Option(edificio(),edificio(),true,"");
						parent.document.f1.edificio.value=document.f1.edificio.value;
						parent.traerCalle();
						parent.dhxWins.window("w2").close();
					}
					else if((clase=="banco" && claseGlobal=="add_banco")){
						parent.document.f1.banco.options[0]=new Option(banco(),banco(),true,"");
						parent.document.f1.banco.value=document.f1.banco.value;
						//alerta("sss:"+document.f1.banco.value+":");
						parent.document.f1.banco1.options[0]=new Option(banco(),banco(),true,"");
						parent.document.f1.banco1.value=document.f1.banco.value;
						parent.dhxWins.window("w2").close();
					}
					else if((claseGlobal=="contrato" || claseGlobal=="act_contrato") && clase=="contrato_servicio"){
						document.f1.agregar.value="Agregar";
						divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_contrato_servicio.php?&id_contrato="+id_contrato()+"&";
						updateTable();
					//	tCodContSer();
					}
					else if((claseGlobal=="contrato" || claseGlobal=="act_contrato") && clase=="cablemodem"){
						limpiarcm();
						divDataGrid="cablemo"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_cablemo.php?&id_contrato="+id_contrato()+"&";
						updateTable();
					
					}
					else if((claseGlobal=="contrato" || claseGlobal=="act_contrato") && clase=="deco_ana"){
						limpiarda()
						divDataGrid="decoana"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_decoana.php?&id_contrato="+id_contrato()+"&";
						updateTable();
					}
					
					else if(clase=="info_adic"){
					//	divDataGrid="vitacora";params = ''; tblpage= ''; tblorder = ''; tblfilter = '';
					//	archivoDataGrid="procesos/datagrid_info_adic.php?id_contrato="+id_contrato()+"&";
						updateTable();
						document.f1.info_a.value=0;
						document.f1.desc_a.value='';
						document.f1.agregar_info_adic.value="GUARDAR";
					}
					else{
					
					
					alerta("TRANSACCION COMPLETADA CON EXITO");
					
					
					}
					if(clase=="inventario"){
						imprimirInv(id_inv());
					}
					if(claseGlobal=="ent_sal_mat" || claseGlobal=="sal_mat"){
						conexionPHP('formulario.php',claseGlobal);
					}
					else if((claseGlobal=="contrato" || claseGlobal=="act_contrato") && clase=="contrato_servicio"){
						
					}
					else if(clase=="envio_aut"){
					
					}
					else if(clase=="comandos_sms"){
					
					}
					else if(clase=="pagodeposito" && claseGlobal=='pagodeposito_reg'){
						conexionPHP('formulario.php',claseGlobal);
					}
					else if(clase=="promo_contrato"){
						conexionPHP('formulario.php',claseGlobal);
					}
					else if(clase=="persona"){
						conexionPHP('formulario.php',claseGlobal);
					}
					else if(clase=="cargar_deuda"){
						//alerta(id_contrato_G+":"+ruta_G)
							if(id_contrato_G!=''){
								conexionPHP('formulario.php',ruta_G,'',id_contrato_G);
							}
							else{
								conexionPHP('formulario.php','cargar_deuda');
							}
					}
					else if(clase=="contrato"){
						
							if(id_contrato_G!=''){
								conexionPHP('formulario.php',ruta_G,'',id_contrato_G);
							}
							else{
								conexionPHP('formulario.php',claseGlobal);
							}
					}
					else if((claseGlobal=="pagos" || claseGlobal=="act_contrato") && clase=="llamadas"){
						mostrarHistorial_vitacora();
					}
					else if(clase=="llamadas"){
							if(id_contrato_G!=''){
								conexionPHP('formulario.php','imprimir_listado_llamada','',id_all_G);
								
								id_contrato_G='';
							}
							else{
								
								conexionPHP('formulario.php','llamadas');
							}
					}
					else if(claseGlobal=="asigna_recibo_c" || claseGlobal=="recibe_recibo_c"){
						conexionPHP('formulario.php',claseGlobal);
					}
					else if(clase=="cablemodem" && claseGlobal=="cablemodem"){
						conexionPHP('formulario.php',clase);
					}
					else if((claseGlobal=="contrato" || claseGlobal=="act_contrato") && clase=="deco_ana"){
						
					}
					else if((claseGlobal=="contrato" || claseGlobal=="act_contrato") && clase=="cablemodem"){
						
					}
					else if(clase=="detalle_tipopago_df" || clase=="carga_tabla_banco" || clase=="tabla_bancos" || clase=="tipo_pago_df" || clase=="cuenta_bancaria" || clase=="deco_ana" || clase=="deco_ana" || clase=="marca" || clase=="modelo" || clase=="deco_servicio" || clase=="interfazacc" || clase=="interfaz_cablemodem" || clase=="asigna_llamada" || clase=="asig_lla_cli" || clase=="tipo_llamada" || clase=="llamadas" || clase=="detalle_resp" || clase=="tipo_resp" || clase=="descuento_pronto_pag" || clase=="tabla_cortes" || clase=="cuenta_bancos" || clase=="conciliacion_pago" || clase=="servidor" || clase=="inicial_id" || clase=="sincronizacion_servi" || clase=="pagodeposito"  || clase=="conf_comision" || clase=="pago_comisones_c" || clase=="asigna_recibo" || clase=="recibos" || clase=="recibe_recibo" || clase=="promocion" || clase=="promo_serv" || clase=="convenio_pago" || clase=="conv_con" || clase=="urbanizacion" || clase=="grupo_afinidad" || clase=="estado" || clase=="municipio" || clase=="ciudad" || clase=="tipo_alarma" || clase=="alarmas" || clase=="estacion_trabajo" || clase=="precintos" || clase=="formato_sms" || clase=="statuscont" || clase=="motivollamada" || clase=="motivonotas" || clase=="config_sms" || clase=="gerentes_permitidos" || clase=="variables_sms" || clase=='cargar_deuda' || clase=='aviso_cobro' || clase=="Modulo" || clase=="Perfil" || clase=="Persona" || clase=="tipo_orden" || clase=="tipo_orden" || clase=="cobrador" || clase=="vendedor" || clase=="cliente" || clase=="tecnico" || clase=="tipo_orden" || clase=="detalle_orden" || clase=="franquicia" || clase=="parametros" || (clase=="calle" && claseGlobal=="calle") || (clase=="sector"  && claseGlobal=="sector") || (clase=="zona"  && claseGlobal=="zona") || clase=="materiales" || clase=="ent_sal_mat" || clase=="inventario" || clase=="inventario_materiale" || clase=="tipo_servicio" || (clase=="servicios"  && claseGlobal=="servicios") || clase=="tarifa_servicio" || clase=="contrato_servicio" || clase=="pago_servicio" || (clase=="tipo_pago" && claseGlobal=="tipo_pago") || clase=="cierre_pago" || clase=="caja" || clase=="reclamo_denuncia" || clase=="comentario_cliente" || clase=="pago_comisiones" || clase=="status_contrato" || (clase=="edificio"  && claseGlobal=="edificio") || (clase=="banco" && claseGlobal=="banco") || clase=="grupo_trabajo" || clase=="sms" || clase=="otros_datos" || clase=="familia" || clase=="NuevoModulo"){
						conexionPHP('formulario.php',clase);
					}
					else if(clase=="Usuario"){
						conexionPHP('formulario.php',claseGlobal);
					}/*
					else if((claseGlobal=="contrato" || claseGlobal=="act_contrato") && clase=="contrato_servicio"){
						conexionPHP('formulario.php',claseGlobal);
					}*/
					else if(clase=="detalle_tipopago" && claseGlobal=="modificar_pagos"){
						conexionPHP('formulario.php',claseGlobal);
					}
					
					if(clase=="contrato" && (claseGlobal=="act_contrato" || claseGlobal=="contrato")){
						conexionPHP('formulario.php',claseGlobal);
					}
					
					
					
		if(clase=="recibe_recibo_c" ){
			//myCalendar = new dhtmlXCalendarObject(["fecha_rec"]);
		}
		
		if(clase=="recibe_recibo" ){
			//myCalendar = new dhtmlXCalendarObject(["fecha_rec"]);
		}
		
		if(clase=="asigna_recibo_c" ){
			//myCalendar = new dhtmlXCalendarObject(["fecha_asig"]);
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_asigna_recibo.php?&tipo=CONTRATO&";
			updateTable();
		}
		
		if(clase=="asigna_recibo" ){
			//myCalendar = new dhtmlXCalendarObject(["fecha_asig"]);
			divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_asigna_recibo.php?&tipo=FACTURA&";
			updateTable();
		}
		
		
					if(clase=="cirre_diario"){
						if(claseGlobal=="cirre_diario"){
							ImprimirRep_CierreDiario();
							conexionPHP_sms("sms.php","EnviarSMSAutomatico","Cierre_Diario=@"+id_cierre()+"=@");
							//imp_cierrez();
							//setTimeout('ImprimirRep_CierreDiario();', 2000);
							//ImprimirRep_CierreDiario();
						}
						else if(claseGlobal=="cirre_diario1"){
							ImprimirRep_CierreDiario();
							conexionPHP_sms("sms.php","EnviarSMSAutomatico","Cierre_Diario=@"+id_cierre()+"=@");
							//imp_cierrez();
							
						}
						cerrarVenta();//conexionPHP('formulario.php',claseGlobal);
					}
					if(clase=="cirre_diario_et"){
						ImprimirRep_CierreEquipo(id_cierre());
						conexionPHP('formulario.php','cirre_diario_et');
					}
					if(claseGlobal=="cambar_c"){
						conexionPHP('formulario.php',claseGlobal);
					}
					if(clase=="ordenes_tecnicos"){
						if(mensaje=='finalizar' || mensaje=='canceladafinal' || mensaje=='devolver'){
							conexionPHP('formulario.php','final_ordenes_tecnicos');
						}
						else if(mensaje=='imprimir'){
							if(planilla_orden_G==""){
								location.href="reportepdf/imp_orden_serv.php?&id_orden="+id_orden()+"&";
								//conexionAJAX("ReporteJava/imp_orden_serv.php?&id_orden="+id_orden()+"&");
							}else{
								location.href="reportepdf/imp_orden_serv"+planilla_orden_G+".php?&id_orden="+id_orden()+"&";
								//conexionAJAX("ReporteJava/imp_orden_serv"+planilla_orden_G+".php?&id_orden="+id_orden()+"&");
							}
							//conexionPHP('formulario.php','imprimir_ordenes_tecnicos');
						}
						else if(mensaje=='reasignar' || mensaje=='revertir'){
							
							conexionPHP('formulario.php','final_ordenes_tecnicos');
						}
						else if(mensaje=='incluir'){
							if(id_contrato_G!=''){
								conexionPHP('formulario.php',ruta_G,'',id_contrato_G);
							}
							else{
								conexionPHP('formulario.php','ordenes_tecnicos');
							}
						}
						else{
							conexionPHP('formulario.php','ordenes_tecnicos');
						}
						
						if(mensaje=="incluir" || mensaje=="finalizar"){
							conexionPHP_sms("sms.php","EnviarSMSAutomatico","Ordenes=@"+id_orden()+"=@"+mensaje);
						}
					}
					
					if(clase=="caja_cobrador"){
						//alerta(":"+mensaje+":");
						if(mensaje=="aperturar" || mensaje=="cambiarfecha"){
							conexionPHP('formulario.php','pagos');
							
						}
						else if(mensaje=="cerrar"){
							GuardarRep_detcob(id_caja_cob());
							//ImprimirRep_detallecobros();
							conexionPHP('formulario.php','caja_cobrador');
						}
						//imp_cierrex();
					}
					if(clase=="anular_facturas"){
						//alerta(":"+mensaje+":");
						if(mensaje=="aperturar" || mensaje=="cambiarfecha"){
							conexionPHP('formulario.php','pagos');
						}
						else if(mensaje=="cerrar"){
							GuardarRep_detcob(id_caja_cob());
							//ImprimirRep_detallecobros();
							conexionPHP('formulario.php','caja_cobrador');
						}
					}
					if(claseGlobal=="Usuario"){
						conexionPHP('formulario.php',claseGlobal);
					}
					
					if(claseGlobal=="cerrar_caja" && clase=="caja_cobrador" && mensaje=="cerrar"){
							conexionPHP_sms("sms.php","EnviarSMSAutomatico","Cierre_Caja=@"+id_caja_cob()+"=@");
						
					}
			}
			else{
				if(clase=="sincronizacion_servi"){
					alerta("ERROR DURANTE TRANSACCION");		
					document.getElementById('datagrid').innerHTML=cadena;	
				}
				else{
					alerta("ERROR DURANTE TRANSACCION"+": "+cadena);							
				}
			}
		}
	  break;
	  case "validarExistencia.php":
			if (cadena!="false")
			{
			  if(claseGlobal=="cambiar_c" && clase=="1=@usuario"){
			  }
			  else{
				var tabla=clase.split("=@")				
				asignarCampos(tabla[1],cadena);
				if (arg < 4){
					if((claseGlobal=="ent_sal_mat" || claseGlobal=="sal_mat") && clase=="1=@materiales"){}
					
					else if(claseGlobal=="contrato"  && clase=="1=@vista_cliente"){}
					else if(claseGlobal=="act_contrato"  && clase=="1=@vista_cliente"){}
					else if(claseGlobal=="act_contrato"  && clase=="1=@vista_ubica"){}
					else if(claseGlobal=="act_contrato"  && clase=="1=@pagodeposito"){}
					else if(claseGlobal=="contrato"  && clase=="1=@persona"){}
					else if((claseGlobal=="comentario_cliente" || claseGlobal=="reclamo_denuncia") && clase=="1=@vista_cliente"){}
					else if(claseGlobal=="cerrar_caja"  && clase=="1=@caja_cobrador"){}
					else if(claseGlobal=="Usuario"  && clase=="1=@usuario"){
						alerta("Error, el Nombre de Usuario ya corresponde a otra persona");
						document.f1.login.value="";
						document.f1.login.select();
						boton(true,true,true);		
					}
					else if(claseGlobal=="pagos"  && clase=="1=@vista_contrato"){
						boton(false,true,true,claseGlobal)
					}
					else if(claseGlobal=="pagos"  && clase=="1=@vista_contrato_todo"){
						boton(false,true,true,claseGlobal)
					}
					else if(claseGlobal=="pagos"  && clase=="1=@pagos"){
						alerta("Error, el numero de factura"+" "+nro_factura()+", "+"ya esta registrado");
						document.f1.nro_factura.value=nro_facturaG;
						
					}
					else if(claseGlobal=="ordenes_tecnicos"  && clase=="1=@vista_contrato"){
						//boton(false,true,true,claseGlobal)
					}
					else if(claseGlobal=="cargar_deuda"  && clase=="1=@vista_contrato"){
						boton(false,true,true,claseGlobal)
					}
					
					else if(claseGlobal=="llamadas"  && clase=="1=@vista_contrato"){
						boton(false,true,true,claseGlobal)
					}
					
					else if(claseGlobal=="agregar_promo_contrato"  && clase=="1=@vista_contrato"){
					//	boton(false,true,true,claseGlobal)
					}
					else if(claseGlobal=="convenio_pago"  && clase=="1=@vista_contrato"){
					//	boton(false,true,true,claseGlobal)
					}
					else if(claseGlobal=="agregar_promo_contrato"  && clase=="1=@promocion"){
						//boton(false,true,true,claseGlobal)
					}
					else if(claseGlobal=="Usuario"  && clase=="1=@persona"){}
					else if(claseGlobal=="cerrar_caja"  && clase=="1=@caja_cobrador"){
						document.f1.registrar.disabled=false;
					}
					else if((claseGlobal=="Rep_estadocuenta" || claseGlobal=="Rep_historialpago") && clase=="1=@vista_contrato"){
						
					}
					else if((claseGlobal=="tecnico" || claseGlobal=="cobrador" || claseGlobal=="vendedor" || claseGlobal=="gerentes_permitidos")  && clase=="1=@persona"){
						boton(false,true,true,claseGlobal);
					}
					else if(claseGlobal=="contrato"  && (clase=="1=@contrato_servicio" || clase=="1=@vista_contrato")){
					}
					else if(clase=="1=@info_adic" && (claseGlobal=="contrato" || claseGlobal=="pagos" )){}
					else{
						boton(true,false,false,claseGlobal);		
					}
				}
				else{
					if(clase=="1=@usuario"){
						alerta(mensaje);				
						boton(true,false,true,claseGlobal);			
					}
					else{
						boton(false,false,false,claseGlobal);			
					}
				}
			  }
			}
			else if(cadena=="false")
			{
				if (arg == 4 && clase=="1=@persona"){
						alerta(mensaje);
						boton(true,true,true,claseGlobal);
				}
				else
				{
					if(clase=="1=@vista_tipopago" && claseGlobal=="modificar_pagos"){
						alerta("Error, El pago no esta registrado");
						conexionPHP('formulario.php','modificar_pagos');
					}
					if((claseGlobal=="ent_sal_mat" || claseGlobal=="sal_mat") && clase=="1=@materiales"){
						existeMat=false;
						limpiarMat();
					}
					else if(claseGlobal=="contrato"  && clase=="1=@vista_cliente"){
						existeMat=false;
						limpiarCli();
					}
					else if(claseGlobal=="contrato"  && clase=="1=@persona"){
						existeMat=false;
						limpiarCli();
					}
					else if(claseGlobal=="cerrar_caja"  && clase=="1=@caja_cobrador"){
						document.f1.registrar.disabled=true;
					}
					else if((claseGlobal=="comentario_cliente"  || claseGlobal=="reclamo_denuncia")  && clase=="1=@vista_cliente"){
						alerta("Error, La cedula no corresponde a un cliente");
						document.f1.cedula.value='';
					}
					else if(claseGlobal=="Usuario"  && clase=="1=@usuario"){
						boton(false,true,true);		
					}
					else if(claseGlobal=="Usuario"  && clase=="1=@persona"){
						//limpiarPer();
						existeMat=false;
					}
					else if(claseGlobal=="pagos"  && clase=="1=@vista_contrato"){
						
	new BootstrapDialog({
		title: 'CONFIRMACIÓN DE SAECO',
		message: 'El contrato no esta registrado. Desea cargar la busqueda avanzada?',
		type: BootstrapDialog.TYPE_INFO,
		closable: false,
		buttons: [{
			label: 'NO',
			icon: 'glyphicon glyphicon-thumbs-down',
			cssClass: 'btn-danger',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
				dialog.close();
				conexionPHP('formulario.php','pagos');
			}
		}, {
			label: 'SI',
			icon : 'glyphicon glyphicon-thumbs-up',
			cssClass: 'btn-info',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
				ajaxVentana_BA('Abonados', 'buscar_avanzado_consultar_clientes');
				dialog.close();
			}
		}]
	}).open();
	
					}
					else if(claseGlobal=="pagos"  && clase=="1=@vista_contrato_todo"){
					new BootstrapDialog({
		title: 'CONFIRMACIÓN DE SAECO',
		message: 'El contrato no esta registrado. Desea cargar la busqueda avanzada?',
		type: BootstrapDialog.TYPE_INFO,
		closable: false,
		buttons: [{
			label: 'NO',
			icon: 'glyphicon glyphicon-thumbs-down',
			cssClass: 'btn-danger',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
				dialog.close();
				conexionPHP('formulario.php','pagos');
			}
		}, {
			label: 'SI',
			icon : 'glyphicon glyphicon-thumbs-up',
			cssClass: 'btn-info',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
				ajaxVentana_BA('Abonados', 'buscar_avanzado_consultar_clientes');
				dialog.close();
			}
		}]
	}).open();
						
					}
					else if(claseGlobal=="pagodeposito"  && clase=="1=@vista_contrato_todo"){
						new BootstrapDialog({
		title: 'CONFIRMACIÓN DE SAECO',
		message: 'El contrato no esta registrado. Desea cargar la busqueda avanzada?',
		type: BootstrapDialog.TYPE_INFO,
		closable: false,
		buttons: [{
			label: 'NO',
			icon: 'glyphicon glyphicon-thumbs-down',
			cssClass: 'btn-danger',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
				dialog.close();
				conexionPHP('formulario.php','pagodeposito');
			}
		}, {
			label: 'SI',
			icon : 'glyphicon glyphicon-thumbs-up',
			cssClass: 'btn-info',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
				ajaxVentana_BA('Abonados', 'buscar_avanzado_consultar_clientes');
				dialog.close();
			}
		}]
	}).open();
						
					}
					else if(claseGlobal=="ordenes_tecnicos"  && clase=="1=@vista_contrato"){
						new BootstrapDialog({
		title: 'CONFIRMACIÓN DE SAECO',
		message: 'El contrato no esta registrado. Desea cargar la busqueda avanzada?',
		type: BootstrapDialog.TYPE_INFO,
		closable: false,
		buttons: [{
			label: 'NO',
			icon: 'glyphicon glyphicon-thumbs-down',
			cssClass: 'btn-danger',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
				dialog.close();
				conexionPHP('formulario.php','ordenes_tecnicos');
			}
		}, {
			label: 'SI',
			icon : 'glyphicon glyphicon-thumbs-up',
			cssClass: 'btn-info',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
				ajaxVentana_BA('Abonados', 'buscar_avanzado_consultar_clientes');
				dialog.close();
			}
		}]
	}).open();
					
					}
					else if(claseGlobal=="act_contrato"  && clase=="1=@vista_contrato"){
						new BootstrapDialog({
		title: 'CONFIRMACIÓN DE SAECO',
		message: 'El contrato no esta registrado. Desea cargar la busqueda avanzada?',
		type: BootstrapDialog.TYPE_INFO,
		closable: false,
		buttons: [{
			label: 'NO',
			icon: 'glyphicon glyphicon-thumbs-down',
			cssClass: 'btn-danger',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
				dialog.close();
				conexionPHP('formulario.php','act_contrato');
			}
		}, {
			label: 'SI',
			icon : 'glyphicon glyphicon-thumbs-up',
			cssClass: 'btn-info',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
				ajaxVentana_BA('Abonados', 'buscar_avanzado_consultar_clientes');
				dialog.close();
			}
		}]
	}).open();
					
						
					}
					else if(claseGlobal=="cargar_deuda"  && clase=="1=@vista_contrato"){
						//limpiarDatosCon();
						new BootstrapDialog({
		title: 'CONFIRMACIÓN DE SAECO',
		message: 'El contrato no esta registrado. Desea cargar la busqueda avanzada?',
		type: BootstrapDialog.TYPE_INFO,
		closable: false,
		buttons: [{
			label: 'NO',
			icon: 'glyphicon glyphicon-thumbs-down',
			cssClass: 'btn-danger',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
				dialog.close();
				conexionPHP('formulario.php',claseGlobal);
			}
		}, {
			label: 'SI',
			icon : 'glyphicon glyphicon-thumbs-up',
			cssClass: 'btn-info',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
				ajaxVentana_BA('Abonados', 'buscar_avanzado_consultar_clientes');
				dialog.close();
			}
		}]
	}).open();
						
						
					}
					else if((claseGlobal=="Rep_estadocuenta" || claseGlobal=="Rep_historialpago") && clase=="1=@vista_contrato"){
						new BootstrapDialog({
		title: 'CONFIRMACIÓN DE SAECO',
		message: 'El contrato no esta registrado. Desea cargar la busqueda avanzada?',
		type: BootstrapDialog.TYPE_INFO,
		closable: false,
		buttons: [{
			label: 'NO',
			icon: 'glyphicon glyphicon-thumbs-down',
			cssClass: 'btn-danger',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
				dialog.close();
				conexionPHP('formulario.php','Rep_estadocuenta');
			}
		}, {
			label: 'SI',
			icon : 'glyphicon glyphicon-thumbs-up',
			cssClass: 'btn-info',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
				ajaxVentana_BA('Abonados', 'buscar_avanzado_consultar_clientes');
				dialog.close();
			}
		}]
	}).open();
						
					
					}
					else if(claseGlobal=="act_contrato"  && clase=="1=@vista_ubica"){}
					else if(claseGlobal=="cambiar_c" && clase=="1=@usuario"){
						alerta("Error, el nombre de usuario no esta registrado");
						document.f1.login.value="";
						document.f1.login.select();
					}
					else if(claseGlobal=="tecnico" && clase=="1=@persona"){
						document.f1.num_tecnico.value=numGlobal;
						boton(false,true,true,claseGlobal);
					}
					else if(claseGlobal=="tecnico"  && clase=="1=@vista_tecnico"){
						document.f1.num_tecnico.value=numGlobal;
						document.f1.direccion_tec.value=''; 
						document.f1.email.value='';
					}
					else if(claseGlobal=="cobrador" && clase=="1=@persona"){
						document.f1.nro_cobrador.value=numGlobal;
						boton(false,true,true,claseGlobal);
					}
					else if(claseGlobal=="cobrador"  && clase=="1=@vista_cobrador"){
						document.f1.nro_cobrador.value=numGlobal;
						document.f1.direccion_cob.value='';
					}
					else if(claseGlobal=="vendedor" && clase=="1=@persona"){
						document.f1.nro_vendedor.value=numGlobal;
						boton(false,true,true,claseGlobal);
					}
					else if(claseGlobal=="vendedor"  && clase=="1=@vista_vendedor"){
						document.f1.nro_vendedor.value=numGlobal;
						//document.f1.direccion_ven.value='';
					}
					else if(claseGlobal=="gerentes_permitidos" && clase=="1=@persona"){
						document.f1.nro_gerente.value=numGlobal;
						boton(false,true,true,claseGlobal);
					}
					else if(claseGlobal=="gerentes_permitidos"  && clase=="1=@vista_gerentes"){
						document.f1.nro_gerente.value=numGlobal;
						document.f1.tipo_gerente.value='0';
						document.f1.cargo_gerente.value='';
						document.f1.descrip_gerente.value='';
						document.f1.email.value='';
					}
					else if(claseGlobal=="consultar_pagos"  && clase=="1=@detalle_tipopago"){
					}
					else if(claseGlobal=="anular_pagos"  && clase=="1=@detalle_tipopago"){
					}
					else if(claseGlobal=="act_contrato"  && clase=="1=@vista_cliente"){
						if (confirm('La cédula no esta registrada. Desea modificarla?')){	
						 }
						 else{
							document.f1.cli_id_persona.value=id_cliente_G;
							document.f1.nombre.value='';
							document.f1.apellido.value='';
							document.f1.telefono.value='';
							
							document.f1.telf_casa.value='';
							document.f1.email.value='';
							document.f1.telf_adic.value='';
						 }
					}
					else if(clase=="1=@info_adic" && (claseGlobal=="contrato" || claseGlobal=="pagos" )){}
					
					//para evitar repetir nombres de campos
					else if(clase=="1=@statuscont" && claseGlobal=="statuscont" ){}
					else if(clase=="1=@motivollamada" && claseGlobal=="motivollamada" ){}
					else if(clase=="1=@motivonotas" && claseGlobal=="motivonotas" ){}
					else if(clase=="1=@grupo_afinidad" && claseGlobal=="grupo_afinidad" ){}
					else if(clase=="1=@banco" && claseGlobal=="banco" ){}
					else if(clase=="1=@caja" && claseGlobal=="caja" ){}
					else if(clase=="1=@promocion" && claseGlobal=="promocion" ){}
					else if(clase=="1=@tipo_pago" && claseGlobal=="tipo_pago" ){}
					else if(clase=="1=@detalle_orden" && claseGlobal=="detalle_orden" ){}
					else if(clase=="1=@tipo_orden" && claseGlobal=="tipo_orden" ){}
					else if(clase=="2=@servicios" && claseGlobal=="servicios" ){}
					else if(clase=="2=@tipo_servicio" && claseGlobal=="tipo_servicio" ){}
					
					else if(clase=="1=@franquicia" && claseGlobal=="franquicia" ){}
					else if(clase=="2=@estado" && claseGlobal=="estado" ){}
					else if(clase=="2=@vista_municipio" && claseGlobal=="municipio" ){}
					else if(clase=="2=@vista_ciudad" && claseGlobal=="ciudad" ){}
					else if(clase=="2=@zona" && claseGlobal=="zona" ){}
					else if(clase=="2=@sector" && claseGlobal=="sector" ){}
					else if(clase=="2=@calle" && claseGlobal=="calle" ){}
					else if(clase=="2=@urbanizacion" && claseGlobal=="urbanizacion" ){}
					
					
					
					else{
						boton(false,true,true,claseGlobal)
					}
				}
			}
			else
				alerta("ERROR DEL SISTEMA"+": "+cadena);
	  break;
	  case "Seguridad/Seguridad.php":
			if(clase=='IniciarSesion'){
				if(cadena!="false"){
					$('#carga-inicial').css({ 'display': 'block' });
					cargarModulos(cadena);
					//conexionPHP("validarExistencia.php","1=@personausuario","login=@"+loginUsuario,'hola');
					//conexionPHP_sms("sms.php","recibirSMS");
					//alerta("Sesion Iniciada con Exito");
					//conexionPHP("informacion.php","verificaSMS");
					$('#login-body').css({ 'display': 'none' });
					$('.container-login').css({ 'display': 'none' });
					$('#carga-inicial').fadeOut(4000);
					//$('#carga-inicial').css({ 'display': 'none' });
				}
				else{
					
					alerta("Error, el Usuario y/o Contraseña ingresados no son válidos. <br>Por favor intente de nuevo!");
					document.f1.password.select();
				}
			}
			else if(clase=='CerrarSesion'){
				//javascript:location.reload();
				//NOTA: AQUI DEBERÍA HABER UNA PETICIÓN PARA DESTRUIR VARIABLES DE SESIÓN PHP
				$('#login-body').css({ 'display': 'block' });
				$('.container-login').css({ 'display': 'block' });
				conexionPHP('formulario.php','Sesion');
			}
			else if(clase=='Sesion'){
				//abrirVentana1(cadena);
				//capa.innerHTML=cadena;
			}
			else if(clase=='cargarMensualidad'){
				//cerrarVenta();
				conexionPHP('formulario.php','bienvenidos_saeco');
				/*
				$('#login-body').css({ 'display': 'none' });
					$('.container-login').css({ 'display': 'none' });
					$('#carga-inicial').fadeOut(4000);
					*/
			}
	  break;
	  
	  case "datos_contrato.php":
			cadena="<div id='scroll'>"+cadena+"</div>";
			w3.attachHTMLString(cadena);
		break;
	  default:
		//alerta("entro aqui");
		respuestaPHPAplicaTem(archivoPHP,clase,cadena,mensaje);
	}
}



//permite limpiar los caracteres no visibles de una cadena
function trim (str, charlist) {
    var whitespace, l = 0,
        i = 0;
    str += '';

    if (!charlist) {
        // default list
        whitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
    } else {
        // preg_quote custom list
        charlist += '';
        whitespace = charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '$1');
    }

    l = str.length;
    for (i = 0; i < l; i++) {
        if (whitespace.indexOf(str.charAt(i)) === -1) {
            str = str.substring(i);
            break;
        }
    }

    l = str.length;
    for (i = l - 1; i >= 0; i--) {
        if (whitespace.indexOf(str.charAt(i)) === -1) {
            str = str.substring(0, i + 1);
            break;
        }
    }

    return whitespace.indexOf(str.charAt(0)) === -1 ? str : '';
}
//limpiar una cadena de vasuras
function limpiar(cadena)
{
		
		var cad= cadena.split("=@");
		var cade = limpiarCad(cad[0]);
		var caden='';
		for(i=1;i<cad.length;i++)
		{
			caden=caden+'=@'+cad[i];
		}
		cadena=cade+caden;
		return cadena;
}
//limpiar cadena de espacios y numeros
function limpiarCad(s){
	var j=0;	
	var cad='';
	var valor=true;
	for(i=0; i<s.length;i++){
		if(valor)
		{
			if(numero(s.charAt(i))==false){
				cad=cad+s.charAt(i);
				valor=false;
			}
		}
		else{
			cad=cad+s.charAt(i);
		}
	}
	return cad;
}
//verificar si un caracter es numero
function numero(s)
{
	var j=0;
		var valor=false;
		for(j=0; j<10;j++){
			
			if(s==j){
				valor=true;
			}
		}
		return valor;
}

function iniciarSesionPrueba(){
	conexionPHP('formulario.php','Sesion');
}
//permite iniciar sesion 



//para habilitar o desabilitar los botones dependiento de los privilegios
function boton(registrar,modificar,eliminar,clase)
{
	document.f1.registrar.disabled = registrar;
	document.f1.modificar.disabled = modificar;
	document.f1.eliminar.disabled = eliminar;
}

/*
function include(file_path){
	var j = document.createElement("script");
	j.type = "text/javascript";
	j.src = file_path;
	document.body.appendChild(j);
}	
function include_once(file_path){
	var sc = document.getElementsByTagName("script");
	for (var x in sc)
		if (sc[x].src != null && sc[x].src.indexOf(file_path) != -1) return;
	include(file_path);
}
	
function include_css(file_path){
	var j = document.createElement("script");
	j.type = "text/css";
	j.src = file_path;
	document.body.appendChild(j);
}	

function include_once_css(file_path){
	var sc = document.getElementsByTagName("script");
	for (var x in sc)
		if (sc[x].src != null && sc[x].src.indexOf(file_path) != -1) return;
	include_css(file_path);
}
*/
function asignaConstantes(){
 pPrompt = _("Error") +": ";
 mMessage = _("Error: no puede dejar este espacio vacio");
 pAlphanumeric = _("ingrese un texto que contenga solo letras y/o numeros");
 pAlphabetic   = _("ingrese un texto que contenga solo letras");
 pTexto   = _("ingrese un texto que contenga solo letras numeros");
 pInteger = _("ingrese un numero entero");
 pNumber = _("ingrese un numero");
 pPhoneNumber = _("ingrese un numero de telefono de 11 digitos");
 pEmail = _("ingrese una direccion de correo electronico valida");
 pName = _("ingrese un texto que contenga solo letras y/o espacios");
 pCedula = _("ingrese un numero de cedula valido de 6 hasta 10 Digitos");
 pCedulaE = _("ingrese un numero de cedula valido de 6 hasta 10 Digitos");
 pPassword = _("la contrasena debe ser minimo 6 digitos");
 pSelect = _("no ha Seleccionado ninguna opcion en el Select");
 pDate = _("debe introducir una fecha en este formato  DD/MM/AAAA");
 pRif = _("ingrese un numero de rif en este formato xxxxxxxx-x");

}


function creaVenta(url,myWidth,myHeight){
		var myLeft = (screen.width-myWidth)/2;
		var myTop = 0;
		
		var venta1 = window.open(url,"", 'left='+myLeft+',top='+myTop+',width='+myWidth+',height='+myHeight+',menubar=0,scrollbars=1');
		//venta1.close();
		
		/*
		dhxWins = new dhtmlXWindows();
		dhxWins.enableAutoViewport(false);
		dhxWins.attachViewportTo("winVP");
		dhxWins.setImagePath("../../codebase/imgs/");
		w2 = dhxWins.createWindow("w2", myLeft, myTop, myWidth, myHeight);
		w2.setText("SaEcO v3.0 --  Ventana Externa");
		w2.attachURL(url); 
		*/
}


function creaVentanaRep(url){
		
		var myWidth=960
		var myHeight=600
		var myLeft = (screen.width-myWidth)/2;
		var myTop = ((600-myHeight)/2);
		var venta1 = window.open(url,"", 'left='+myLeft+',top='+myTop+',width='+myWidth+',height='+myHeight+',menubar=0,scrollbars=1');
		
		/*
		dhxWins = new dhtmlXWindows();
		dhxWins.enableAutoViewport(false);
		dhxWins.attachViewportTo("winVP");
		dhxWins.setImagePath("../../codebase/imgs/");
		w1 = dhxWins.createWindow("w1", myLeft, myTop, myWidth, myHeight);
		w1.setText("SaEcO v3.0 --  Ventana Externa");
		w1.button("close").disable();
		VentanaGlobal=true;
		
		w1.attachURL(url); 
		*/
}
/*

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

*/

function sleep(millis)
{
var date = new Date();
var curDate = null;

do { curDate = new Date(); }
while(curDate-date < millis);
} 