 //funcion que permite crear el objeto Ajax.
function nuevoAjax(){
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

function conexionPHP(archivoPHP,clase,cadena,tipoDato){
	var arg=conexionPHP.arguments.length;
	var ajax=nuevoAjax();
	ajax.open("POST", archivoPHP, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	if(archivoPHP=="administrar.php")
		ajax.send("d="+tipoDato+"=@"+clase+"=@"+cadena);
	else
		ajax.send("d="+clase+"=@"+cadena);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			if(ajax.responseText=="SecurityFalse"){
				alert( "Error. Intento de Violación de Seguridad, la Sesion será reiniciada");
				conexionPHP('formulario.php','Sesion');
			}
			else{
				if(clase=="DataGrid"){
					if(ajax.responseText=='true'){
						alert( "TRANSACCIÓN COMPLETADA CON EXITO ");
							conexionPHP('formulario.php',"status_contrato");
					}
					document.getElementById(divDataGrid).innerHTML = ajax.responseText;
					if(divDataGrid=="cargos"){
						divDataGrid="datagrid";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_contrato_servicio.php?&id_contrato="+id_contrato()+"&";
						updateTable();
					}
					else if(divDataGrid=="tecnico"){
						divDataGrid="grupo";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_grupo_trabajo.php";
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

function respuestaPHP(archivoPHP,clase,cadena,mensaje){
	cadena=limpiar(cadena);
	var arg=respuestaPHP.arguments.length;	
	var capa=document.getElementById("principal");
	switch(archivoPHP)
	{
	  case "formulario.php":
		divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			claseGlobal=clase;
			abrirVentana1(cadena);
		
		if(claseGlobal=="Sesion"){
				//document.f1.password.focus();
				//document.f1.login.focus();
				//iniciarSesion();
		}
		
		
	  break;
	  case "informacion.php":
			
			if(clase=="cargarZona_franq"){
				capa=document.getElementById("id_zona");
			}	
			
			if(clase=="cargarZona"){
				capa=document.getElementById("id_zona");
			}	
			if(clase=="cargarCalle"){
				capa=document.getElementById("id_calle");
			}
			if(clase=="traerTOStatus"){
				capa=document.getElementById("id_tipo_orden");
			}
			if(clase=="cargarDO"){
				capa=document.getElementById("id_det_orden");
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
			if(clase=="cargarEdif"){
				if(edificio()=="0"){
					capa=document.getElementById("edificio");
				}
			}
			
			if(clase=="IniciarSesion"){
				cargarModulos(cadena);
			}
			
			
			else if(clase=="traerFranqSer"){
				cade= cadena.split("=@");
				document.f1.id_franq.value=cade[1];
			}
			else if(clase=="traerZona"){
				cade= cadena.split("=@");
				document.f1.id_zona.value=cade[1];
				document.f1.id_franq.value=cade[2];
			}
			else if(clase=="traerTO"){
				cade= cadena.split("=@");
				document.f1.id_tipo_orden.value=cade[1];
			}
			else if(clase=="traerSector"){
				cade= cadena.split("=@");
				document.f1.id_sector.value=cade[1];
				document.f1.id_zona.value=cade[2];
				document.f1.id_franq.value=cade[3];
			}
			else if(clase=="traerCalle"){
				cade= cadena.split("=@");
				
				document.f1.id_sector.value=cade[1];
				document.f1.id_zona.value=cade[2];
				document.f1.id_franq.value=cade[3];
				document.f1.id_calle.value=cade[4];
			}
			else if(clase=="traerFranq"){
				cade= cadena.split("=@");
				document.f1.id_franq.value=cade[1];
			}
			else if(clase=="ActualizarCampo"){
				if(claseGlobal=="act_contrato"){
					divDataGrid="cargos"; 
					archivoDataGrid="procesos/datagrid_actualizar_pagos.php?&id_contrato="+id_contrato()+"&";
				}
				updateTable();
			}
			else if(clase=="verificaOrden"){
				if(cadena=="ASIGNADO"){
					alert("Aviso, Tiene una orden asignada");
					//conexionPHP('formulario.php',claseGlobal);
				}
				else if(cadena=="IMPRESO"){
					alert("Aviso, Tiene una orden Impresa");
					//conexionPHP('formulario.php',claseGlobal);
				}
			}
			else if(clase=="traercs"){
				cade= cadena.split("=@");
				document.f1.costo.value=cade[1];
			}
			else if(clase=="verifica_cedula1"){
				//alert(":"+cadena+":");
				if(cadena!=""){
					cade= cadena.split("=@");
					var tipo=cade[0];
					var id_persona=cade[1];
					var nombre=cade[2];
					if(cade[0]=="CLIENTE"){
						alert("AVISO: la cedula corresponde al cliente: "+nombre+", no se puede modificar ")
							
					}
					else{
						alert("AVISO: la cedula corresponde al empleado: "+nombre+", no se puede modificar ")
							
					}
					document.f1.cedula.value='';
				}
			}
			else if(clase=="incluirFrac"){
				parent.conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato());
				//parent.dhxWins.window("w2").close();
			}
			else if(clase=="incluirDesc"){
				parent.conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato());
				//parent.dhxWins.window("w2").close();
			}
			else if(clase=="ActualizarDeudaDC"){
				if(cadena!=''){
					alert(cadena);
				}
			}
			else{
				capa.innerHTML=cadena;
			}
	  break;
	  
	  case "administrar.php":
		if(clase!="modulo_perfil"){
			if (cadena=="true"){
				//alert(clase+":"+claseGlobal);
					if(clase=="pagos"){
						
					}
					else if(clase=="contrato" && claseGlobal=="act_datos"){
						parent.conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato());
						//parent.dhxWins.window("w2").close();
					}
					else if(clase=="visitas" && claseGlobal=="visitas"){
						alert( "TRANSACCIÓN COMPLETADA CON EXITO ");
						//parent.conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato());
						////parent.dhxWins.window("w2").close();
					}
					else if(clase=="envio_aut" && claseGlobal=="edit_envio_aut"){
						//parent.dhxWins.window("w2").close();
					}
					else if(clase=="comandos_sms"  && claseGlobal=="edit_comandos_sms"){
						parent.conexionPHP('formulario.php','config_comandos_sms');
						//parent.dhxWins.window("w2").close();
					}
					else if(clase=="cargar_deuda" && claseGlobal=="cargar_d"){
						parent.conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato());
						//parent.dhxWins.window("w2").close();
					}
					else if(clase=="ordenes_tecnicos" && claseGlobal=="asig_orden"){
						
						if(mensaje=="incluir" || mensaje=="finalizar"){
							parent.conexionPHP_sms("sms.php","EnviarSMSAutomatico","Ordenes=@"+id_orden()+"=@"+mensaje);
						}
						//parent.dhxWins.window("w2").close();
					}
					else if(clase=="calle" && claseGlobal=="add_calle"){
						parent.document.f1.id_calle.options[0]=new Option(nombre_calle(),id_calle(),true,"");
						parent.document.f1.id_calle.value=document.f1.id_calle.value;
						parent.traerSector();
						//parent.dhxWins.window("w2").close();
					}
					else if(clase=="sector"  && claseGlobal=="add_sector"){
						parent.document.f1.id_sector.options[0]=new Option(nombre_sector(),id_sector(),true,"");
						parent.document.f1.id_sector.value=document.f1.id_sector.value;
						parent.traerZona();
						//parent.dhxWins.window("w2").close();
					}
					else if(clase=="zona"  && claseGlobal=="add_zona"){
						parent.document.f1.id_zona.options[0]=new Option(nombre_zona(),id_zona(),true,"");
						parent.document.f1.id_zona.value=document.f1.id_zona.value;
						parent.cargarSector();
						//parent.dhxWins.window("w2").close();
					}
					else if(clase=="edificio"  && claseGlobal=="add_edificio"){
						parent.document.f1.edificio.options[0]=new Option(edificio(),edificio(),true,"");
						parent.document.f1.edificio.value=document.f1.edificio.value;
						parent.traerCalle();
						//parent.dhxWins.window("w2").close();
					}
					else if((clase=="banco" && claseGlobal=="add_banco")){
						parent.document.f1.banco.options[0]=new Option(banco(),banco(),true,"");
						parent.document.f1.banco.value=document.f1.banco.value;
					//	alert(":"+document.f1.banco.value+":");
						parent.document.f1.banco1.options[0]=new Option(banco(),banco(),true,"");
						parent.document.f1.banco1.value=document.f1.banco.value;
						//parent.dhxWins.window("w2").close();
					}
					else{
					
					
						alert( "TRANSACCIÓN COMPLETADA CON EXITO ");
					
					
					}
					
					if(clase=="envio_aut"){
					
					}
					else if(clase=="comandos_sms"){
					
					}
					else if(clase=="formato_sms" || clase=="statuscont" || clase=="motivonotas" || clase=="config_sms" || clase=="gerentes_permitidos" || clase=="variables_sms" || clase=='cargar_deuda' || clase=='aviso_cobro' || clase=="Modulo" || clase=="Perfil" || clase=="Persona" || clase=="tipo_orden" || clase=="tipo_orden" || clase=="cobrador" || clase=="vendedor" || clase=="cliente" || clase=="tecnico" || clase=="tipo_orden" || clase=="detalle_orden" || clase=="franquicia" || clase=="parametros" || (clase=="calle" && claseGlobal=="calle") || (clase=="sector"  && claseGlobal=="sector") || (clase=="zona"  && claseGlobal=="zona") || clase=="materiales" || clase=="ent_sal_mat" || clase=="inventario" || clase=="inventario_materiale" || clase=="tipo_servicio" || (clase=="servicios"  && claseGlobal=="servicios") || clase=="tarifa_servicio" || clase=="contrato_servicio" || clase=="pago_servicio" || (clase=="tipo_pago" && claseGlobal=="tipo_pago") || clase=="cierre_pago" || clase=="caja" || clase=="reclamo_denuncia" || clase=="comentario_cliente" || clase=="pago_comisiones" || clase=="status_contrato" || (clase=="edificio"  && claseGlobal=="edificio") || (clase=="banco" && claseGlobal=="banco") || clase=="grupo_trabajo" || clase=="sms" || clase=="NuevoModulo"){
						conexionPHP('formulario.php',clase);
					}
					
			}
			else{
				
				alert( "ERROR DURANTE TRANSACCIÓN: "+cadena);							
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
					else if((claseGlobal=="comentario_cliente" || claseGlobal=="reclamo_denuncia") && clase=="1=@vista_cliente"){}
					else if(claseGlobal=="cerrar_caja"  && clase=="1=@caja_cobrador"){}
					else if(claseGlobal=="Usuario"  && clase=="1=@usuario"){
						alert("error el nombre de usuario ya corresponde a otra persona");
						document.f1.login.value="";
						document.f1.login.select();
						boton(true,true,true);		
					}
					else if(claseGlobal=="pagos"  && clase=="1=@vista_contrato"){
						boton(false,true,true,claseGlobal)
					}
					else if(claseGlobal=="pagos"  && clase=="1=@pagos"){
						alert("Error, el numero de factura "+nro_factura()+", ya esta registrado")
						document.f1.nro_factura.value=nro_facturaG;
						
					}
					else if(claseGlobal=="ordenes_tecnicos"  && clase=="1=@vista_contrato"){
						//boton(false,true,true,claseGlobal)
					}
					else if(claseGlobal=="cargar_deuda"  && clase=="1=@vista_contrato"){
						boton(false,true,true,claseGlobal)
					}
					else if(claseGlobal=="Usuario"  && clase=="1=@persona"){}
					else if(claseGlobal=="cerrar_caja"  && clase=="1=@caja_cobrador"){
						document.f1.registrar.disabled=false;
					}
					
					else{
						boton(true,false,false,claseGlobal);		
					}
				}
				else{
					if(clase=="1=@usuario"){
						alert(mensaje);				
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
						alert(mensaje);
						boton(true,true,true,claseGlobal);
				}
				else
				{
					if(clase=="1=@vista_tipopago" && claseGlobal=="modificar_pagos"){
						alert("Error, El pago no esta registrado");
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
					else if(claseGlobal=="cerrar_caja"  && clase=="1=@caja_cobrador"){
						document.f1.registrar.disabled=true;
					}
					else if((claseGlobal=="comentario_cliente"  || claseGlobal=="reclamo_denuncia")  && clase=="1=@vista_cliente"){
						alert("Error, La cedula no corresponde a un cliente");
						document.f1.cedula.value='';
					}
					else if(claseGlobal=="Usuario"  && clase=="1=@usuario"){
						boton(false,true,true);		
					}
					else if(claseGlobal=="Usuario"  && clase=="1=@persona"){
						limpiarPer();
						existeMat=false;
					}
					else if(claseGlobal=="pagos"  && clase=="1=@vista_contrato"){
						if (confirm('El contrato no esta registrado. ¿Desea cargar la busqueda avanzada?')){
							abrirBusq_cont_avanz();
						}
						else{
							conexionPHP('formulario.php','pagos');
						}
					}
					else if(claseGlobal=="ordenes_tecnicos"  && clase=="1=@vista_contrato"){
						if (confirm('El contrato no esta registrado. ¿Desea cargar la busqueda avanzada?')){
							abrirBusq_cont_avanz();
						}
						else{
							conexionPHP('formulario.php','ordenes_tecnicos');
						}
					}
					else if(claseGlobal=="act_contrato"  && clase=="1=@vista_contrato"){
						alert('El contrato no esta registrado.');
						conexionPHP('formulario.php','act_contrato');
					}
					else if(claseGlobal=="cargar_deuda"  && clase=="1=@vista_contrato"){
						limpiarDatosCon();
						if (confirm('El contrato no esta registrado. ¿Desea cargar la busqueda avanzada?')){
							abrirBusq_cont_avanz();
						}
						else{
							conexionPHP('formulario.php','pagos');
						}
						boton(true,true,true,claseGlobal);
						
					}
					else if((claseGlobal=="Rep_estadocuenta" || claseGlobal=="Rep_historialpago") && clase=="1=@vista_contrato"){
						if (confirm('El contrato o la cedula no esta registrado. ¿Desea cargar la busqueda avanzada?')){
							abrirBusq_cont_avanz();
						}
						else{
							conexionPHP('formulario.php','Rep_estadocuenta');
						}
					}
					
					else{
						boton(false,true,true,claseGlobal)
					}
					if(clase=="1=@personausuario"){
						codigo=document.f1.cedula.value;
						document.f1.cedula.value=codigo;
					}
					else if(clase=="1=@usuario")
					{
						login=document.f1.login.value;
						document.f1.login.value=login;
					}
					else if(clase=="1=@persona"){
						var cedula=document.f1.cedula.value;
						document.f1.reset();
						document.f1.cedula.value=cedula;
					}
				}
			}
			else
				alert("ERROR DEL SISTEMA: "+cadena);
	  break;
	 
	  default:
		//alert("entro aqui");
		respuestaPHPAplicaTem(archivoPHP,clase,cadena,mensaje);
	}
}
function abrirVentana1(cadena){
	if(VentanaGlobal==true){
		cadena="<div id='scroll'>"+cadena+"</div>";
		w1.attachHTMLString(cadena);
	}
	else{
		creaVentana();
		cadena="<div id='scroll'>"+cadena+"</div>";
		w1.attachHTMLString(cadena);
	}
}
function creaVentana(){
		//alert(w1.getText());
		//dhxWins.window("w1").close();
		var myWidth=800
		var myHeight=600
		var myLeft = (screen.width-myWidth)/2;
		var myTop = ((600-myHeight)/2);
		
		dhxWins = new dhtmlXWindows();
		dhxWins.enableAutoViewport(false);
		dhxWins.attachViewportTo("winVP");
		dhxWins.setImagePath("../../codebase/imgs/");
		w1 = dhxWins.createWindow("w1", myLeft, myTop, myWidth, myHeight);
		w1.setIcon("icon_normal.gif", "icon_normal.gif");
		//dhxWins.window(id).setIcon(String iconEnabled, String iconDisabled);
		w1.setText("SAECO v2.0");
		//w1.showHeader();
		w1.button("close").disable();
			
		VentanaGlobal=true;
		
}
function creaVenta(url,myWidth,myHeight){
		var myLeft = (screen.width-myWidth)/2;
		var myTop = 0;
		
		dhxWins = new dhtmlXWindows();
		dhxWins.enableAutoViewport(false);
		dhxWins.attachViewportTo("winVP");
		dhxWins.setImagePath("../../codebase/imgs/");
		w2 = dhxWins.createWindow("w2", myLeft, myTop, myWidth, myHeight);
		w2.setText("SAECO v2.0");
		w2.attachURL(url); 
}
function cerrarVenta(){
	dhxWins.window("w1").close();
	VentanaGlobal=false;
}
function cerrarVenta2(){
	dhxWins.window("w2").close();
}
function verRadionotacd()
{
			if(document.getElementById("tipo_nota1").checked){								
				return document.getElementById("tipo_nota1").value;
			}
			else{
				return document.getElementById("tipo_nota2").value;
			}
}
