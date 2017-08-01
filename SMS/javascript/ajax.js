
function nuevoAjax_sms(){
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false;
	try{
		// Creacion del objeto AJAX para navegadores no IE
		//xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e){
		try{
			// Creacion del objet AJAX para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		}
		catch(E) { xmlhttp=false;}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 
	return xmlhttp; 
}
function conexionPHP_sms(archivoPHP,clase,cadena,tipoDato){
	//devuelve el numero de parametro recibidos
	var arg=conexionPHP_sms.arguments.length;
	//crea el objeto AJAX
	var ajax=nuevoAjax_sms();
	//abre la conexion con php
	ajax.open("POST", "SMS/"+archivoPHP, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//envia los datos a traves de AJAX concatenados con =@
	if(archivoPHP=="administrar.php")
		ajax.send("d="+tipoDato+"=@"+clase+"=@"+cadena);
	else
		ajax.send("d="+clase+"=@"+cadena);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			//alert(":"+ajax.responseText+":");
			//obtiene la respuesta del servidor;  verifica la seguridad
			if(ajax.responseText=="SecurityFalse"){
				alert( _("Error. Intento de Violacion de Seguridad, la Sesion sera reiniciada"));
				conexionPHP_sms('formulario.php','Sesion');
			}
			else{
				if(clase=="DataGrid"){
					document.getElementById(divDataGrid).innerHTML = ajax.responseText;
				}
				else{
					//Hace la llamada a respuestaPHP_sms() para que esla procesa la informacion devuelta
					if(arg==4)
						respuestaPHP_sms(archivoPHP,clase,ajax.responseText,tipoDato);
					else
						respuestaPHP_sms(archivoPHP,clase,ajax.responseText);
				}
			}
		}
	}
}
function conexionPHP_sms1(archivoPHP,clase,cadena,tipoDato){
	var ajax=nuevoAjax_sms();
	ajax.open("POST",archivoPHP, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	if(archivoPHP=="administrar.php"){
		//alert(tipoDato+"=@"+clase+"=@"+cadena);
		ajax.send("d="+tipoDato+"=@"+clase+"=@"+cadena);
	}
	else
		ajax.send("d="+clase+"=@"+cadena);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			if(clase=="DataGrid")
					document.getElementById(divDataGrid).innerHTML = ajax.responseText;
			else
					respuestaPHP_sms(archivoPHP,clase,ajax.responseText,tipoDato);
			
		}
	}
}

function respuestaPHP_sms(archivoPHP,clase,cadena,mensaje){
	var arg=respuestaPHP_sms.arguments.length;	
	var capa=document.getElementById("principal");
	//para saber de que archivo o ruta extrajola respuesta
	switch(archivoPHP)
	{
		case "sms.php":

			if(clase=="recibirSMS"){
				if(cadena!='false'){
				//alert(cadena);
					document.getElementById('divSMS').innerHTML = cadena;
					
					//mostrarSMS();
					//conexionPHP_sms1("sms.php","recibirSMS");
					if(activa_SMS==true){
						setTimeout('conexionPHP_sms1("sms.php","recibirSMS");', 6000);
					}
				}
				else{
					if(activa_SMS==true){
						setTimeout('conexionPHP_sms1("sms.php","recibirSMS");', 2000);
					}
				}
			}
			else if(clase=="sincronizarTelf"){
				alert(_("Sincronización realizada con exito"));
				conexionPHP_sms1("sms.php","recibirSMS");
				activa_SMS=true;
			}
			else if(clase=="ini_serv_sms"){
				document.getElementById('status_serv').innerHTML = cadena;
				
				conexionPHP_sms1("sms.php","consultaSMS");
				
				activa_SMS=true;
				cargarJava();
			}
			else if(clase=="det_serv_sms"){
				//document.f1.registrar.disabled=false;
				//document.f1.modificar.disabled=true;
				//document.f1.eliminar.disabled=true;
				document.getElementById('status_serv').innerHTML = cadena;
			}
			else if(clase=="rei_serv_sms"){
				document.getElementById('status_serv').innerHTML = cadena;
				conec_ser_sms();
			}
			if(clase=="consultaSMS"){
				//if(cadena!='false'){
					cade= cadena.split("-Class-");
					cad=cade[2];
					var statusTel=cade[1];
					if(statusTel=='3'){
						location.reload();
					}
					
					document.getElementById('status_serv').innerHTML = cad;
					//alert(":"+cadena+":");
					if(activa_SMS==true){
						setTimeout('conexionPHP_sms1("sms.php","consultaSMS");', 2000);
					}
				//}
			}
			if(clase=="ini_serv_email"){
					if(activa_SMS==true){
						setTimeout('conexionPHP_sms1("sms.php","ini_serv_email");', 3000);
					}
			}
			else if(clase=="cerrarSMS"){
				//alert("Sincronización realizada con exito")
			}
			else if(clase=="mostrarSMSEsp"){
				capa.innerHTML=cadena; 
			}
			else if(clase=="mostrarSMSUnico"){
				document.getElementById('detalle').innerHTML = cadena;
			}
			else if(clase=="listadoSMSEsp"){
				document.getElementById('comunicacion').innerHTML = cadena;
			}
			else if(clase=="EnviarSMSUnico"){
				alert(_("Mensaje enviado con exito"));
				conexionPHP_sms("sms.php","mostrarSMSEsp","=@=@Todos");
			}
			else if(clase=="EnviarSMSUnicoCont"){
				alert(_("Mensaje enviado con exito"));
				conexionPHP_sms("sms.php","listadoSMSEsp",id_contrato());
			}
	  break;
	  case "formulario.php":
		if(clase!="Sesion"){
		//	conexionPHP_sms("informacion.php","verificaSMS");
			asignaConstantes();
		}
		
		divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			claseGlobal=clase;
			if(clase=="Modulo"){
				capa.innerHTML=cadena;
			}
			else{
				//abrirVentana1(cadena);
				capa.innerHTML=cadena; 
			}

			
		if(claseGlobal=="config_sms"){
			validarconfig_sms();
		}
		else if(claseGlobal=="datos_mensaje"){
			cuenta_carac_com_m();
		}
		else if(claseGlobal=="sms_por_enviar"){
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_sms_por_enviar.php?status_sinc=FALSE&";
			updateTable_sms();
		}
		else if(claseGlobal=="email_por_enviar"){
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_email_por_enviar.php?status_e_sinc=FALSE&";
			updateTable_sms();
		}
		else if(claseGlobal=="admin_sms"){
			myCalendar = new dhtmlXCalendarObject(["hasta","desde"]);
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_admin_sms.php?tipo_sms=SIN LEER&";
			updateTable_sms();
		}
		else if(clase=="variables_sms"){
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_variables_sms.php";
			updateTable_sms();
		}
		else if(clase=="list_falla"){
			cuenta_carac_com();
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/list_falla.php?status_list=POR REVISAR&";
			updateTable_sms();
		}
		else if(clase=="list_denuncia"){
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/list_denuncia.php?status_list=POR REVISAR&";
			updateTable_sms();
		}
		else if(clase=="list_reclamo"){
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/list_reclamo.php?status_list=POR REVISAR&";
			updateTable_sms();
		}
		else if(clase=="gerentes_permitidos"){
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_gerentes_permitidos.php";
			updateTable_sms();
		}
		else if(clase=="formato_sms"){
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_formato_sms.php";
			updateTable_sms();
		}

			if( claseGlobal!="sms_por_enviar" && claseGlobal!="email_por_enviar" && claseGlobal!="imprimir_ordenes_tecnicos" && claseGlobal!="final_ordenes_tecnicos" && claseGlobal!="pagos" && clase!="cerrar_caja" && clase!="Sesion" && clase!="CreaFormulario" && clase!="VerDatos"  && clase!="Configuracion" ){
				boton(false,true,true,claseGlobal);
			}
	  break;
	  case "informacion.php":
			if(clase=="traerMensualidad"){
				capa=document.getElementById("mes");
			}
			
			
			if(clase=="verificaSMS"){
				cade= cadena.split("=@");
				toolbar.setItemText('smsno', cade[1]);
			}
			else if(clase=="asig_falla_rep"){
				alert(_("PROCESO REALIZADO"));
				conexionPHP_sms('formulario.php',"list_falla");
			}
			else if(clase=="procesar_list_denuncia"){
				alert(_("PROCESO REALIZADO"));
				conexionPHP_sms('formulario.php',"list_denuncia");
			}
			else if(clase=="procesar_list_reclamo"){
				alert(_("PROCESO REALIZADO"));
				conexionPHP_sms('formulario.php',"list_reclamo");
			}
			else if(clase=="rec_falla_rep"){
				alert(_("PROCESO REALIZADO"));
				conexionPHP_sms('formulario.php',"list_falla");
			}
			else if(clase=="eliminar_sms_enviar"){
			//	alert(_("sms Eliminado del listado de envio"));
				updateTable_sms();
			}
			else if(clase=="eliminar_email_enviar"){
				updateTable_sms();
			}
			else if(clase=="eliminar_todos_sms_enviar"){
				alert(_("sms Eliminado con exito"));
				updateTable_sms();
			}
			
			else if(clase=="eliminar_todos_email_enviar"){
				alert(_("sms Eliminado con exito"));
				updateTable_sms();
			}
			else if(clase=="eliminar_sms_enviados"){
				alert(_("sms enviados eliminado con exito"));
				updateTable_sms();
			}
			else if(clase=="eliminar_email_enviados"){
				alert(_("sms enviados eliminado con exito"));
				updateTable_sms();
			}
			else if(clase=="marcar_como_sms_enviar"){
				alert(_("cambios aplicado con exito"));
				updateTable_sms();
			}
			else if(clase=="marcar_como_email_enviar"){
				alert(_("cambios aplicado con exito"));
				updateTable_sms();
			}
			else if(clase=="marcar_como_admin_sms_enviar"){
				alert(_("cambios aplicado con exito"));
				updateTable_sms();
			}
			else if(clase=="marcar_list_denuncia"){
				alert(_("cambios aplicado con exito"));
				updateTable_sms();
			}
			else if(clase=="marcar_list_reclamo"){
				alert(_("cambios aplicado con exito"));
				updateTable_sms();
			}
			else if(clase=="marcar_list_falla"){
				alert(_("cambios aplicado con exito"));
				updateTable_sms();
			}
			else{
				capa.innerHTML=cadena;			
			}
	  break;
	   case "administrar.php":
		if(clase!="modulo_perfil"){
			if (cadena=="true"){
					
					alert( _("TRANSACCION COMPLETADA CON EXITO"));

					if(clase=="envio_aut" && claseGlobal=="edit_envio_aut"){
						parent.dhxWins.window("w2").close();
					}
					else if(clase=="comandos_sms"  && claseGlobal=="edit_comandos_sms"){
						parent.conexionPHP_sms('formulario.php','config_comandos_sms');
						parent.dhxWins.window("w2").close();
					}
					else if(clase=="formato_sms" || clase=="config_sms" || clase=="variables_sms"){
						conexionPHP_sms('formulario.php',clase);
					}
					
			}
			else{
				
				alert( _("ERROR DURANTE TRANSACCION")+": "+cadena);							
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
				asignarCampos_sms(tabla[1],cadena);
				
				boton(true,false,false,claseGlobal);		
				
			  }
			}
			else if(cadena=="false")
			{
				boton(false,true,true,claseGlobal)
			}
			else
				alert(_("ERROR DEL SISTEMA")+": "+cadena);
	  break;
	  default:
		respuestaPHPAplicaTem(archivoPHP,clase,cadena,mensaje);
	}
}
function rei_sinc_SMS(){
	det_sinc_SMS();
	setTimeout('conec_ser_sms()', 1000);
}
function det_sinc_SMS(){
	activa_SMS=false;
	conexionPHP_sms1('sms.php','det_serv_sms');
}
function conec_ser_sms(){
	document.getElementById('status_serv').innerHTML = '<span id="status_serv" class="cabe noconectado">STATUS: DESCONECTADO<span>';
	conexionPHP_sms1('sms.php','ini_serv_sms',document.f1.id_conf_sms.value+"=@"+document.f1.cod_telf_pais.value+"=@"+document.f1.telefono_serv.value+"=@"+document.f1.id_canal_sms.value+"=@"+document.f1.conf_campo2.value+"=@"+document.f1.conf_campo3.value+"=@"+document.f1.marca.value+"=@"+document.f1.modelo.value);
//	conexionPHP_sms1('sms.php','ini_serv_email');
}
var venta
function cargarJava(){
		venta = window.open("iniciarSaecoSMS.php","", 'left=0,top=0,width=1,height=1,menubar=0,scrollbars=0');
		setTimeout('cerrar_venta()', 9000);
		//venta.close();
}
function cerrarSes(){
conexionPHP_sms1("sms.php","cerrarSMS");
}

function cerrar_venta(){
venta.close();
}




