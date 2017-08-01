//permite asignar los campos traidos de una tabla.
//tabla: la tabla de donde fueron extraidos los datos
//cade: una cadena con todos los datos concatenados con =@
function asignarCampos(tabla,cade)
{
	//divide los datos en un arreglo
	cadena= cade.split("=@");
	var i=0;
	for(i=0;i<cadena.length;i++){
		cadena[i]=trim(cadena[i]);
	}
	switch(tabla){
		case "vista_contrato":
			if(claseGlobal=="pagos"){
				document.f1.id_contrato.value=cadena[1];
				
				document.f1.nro_contrato.value=cadena[5];
				
				document.getElementById("abonado").innerHTML="<label class='border-head'><h4>Abonado: </h4></label > </label> "+cadena[5]+"</label > ";
				document.getElementById("status").innerHTML="<label class='border-head'><h4>Status: </h4></label > <span style='color:blue; font-weight:blod; font-size:12pt'  >"+cadena[12]+" </span > ";
				document.getElementById("ced").innerHTML="<label  class='border-head'><h4>C.I/RIF: </h4></label > </label> "+cadena[40]+cadena[14]+"</label >  ";
				document.getElementById("cliente").innerHTML="<label class='border-head'><h4>CLIENTE: </h4></label > </label>"+cadena[15]+" "+cadena[16]+"</label >";
				document.getElementById("direccion").innerHTML="<label class='border-head'><h4>DIRECCION: </h4></label > </label> "+cadena[30]+"; "+cadena[27]+"; "+cadena[24]+"; "+cadena[23]+"</label >  </div >	<label class='border-head'><h4> REFERENCIA: </h4></label > </label> "+cadena[20]+"</label >  </div >	";
				
				/*
				//document.f1.fecha_contrato.value=formatdatei(cadena[6]);
				document.f1.fecha_contrato.value=cadena[21];
				document.f1.etiqueta.value=cadena[9];
				
				document.f1.cedula.value=cadena[14];
				document.f1.apellido.value=cadena[16];
				document.f1.telefono.value=cadena[17];
				
				document.f1.id_sector.value=cadena[27];
				document.f1.id_zona.value=cadena[30];
				document.f1.id_calle.value=cadena[24];
				document.f1.status_contrato.value=cadena[12];
				*/
				/*
				if(claseGlobal=="pagos"){
					//alerta(cadena[39]);
					if(cadena[39]==""){
						cadena[39]="NATURAL";
					}
					document.f1.tipo_cliente.value=cadena[39];
					document.f1.inicial_doc.value=cadena[40];
					activa_tipo_c();
					asigna_tipo_c_pago(cadena[15],cadena[16]);
					
					document.f1.monto_pago.select();
					
					showTab('dhtmlgoodies_tabView1','3');
					showTab('dhtmlgoodies_tabView1','0');
					
					*/
					//conexionPHP("informacion.php","traer_datos_abonado",document.f1.id_contrato.value);
					divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
					archivoDataGrid="procesos/datagrid_pagos.php?&id_contrato="+id_contrato()+"&";
					updateTable();
					/*
					document.f1.contrato_fisico.value=cadena[51];
					document.f1.direc_adicional.value=cadena[20];
					document.f1.observacion.value=cadena[8];
				}
					*/
				
			}
			else if(claseGlobal=="actualizar_pagos"  || claseGlobal=="anular_pagos"  || claseGlobal=="nota_de_credito"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				//document.f1.fecha_contrato.value=formatdatei(cadena[6]);
				document.f1.fecha_contrato.value=cadena[21];
				document.f1.etiqueta.value=cadena[9];
				document.f1.cedula.value=cadena[14];
				document.f1.nombre.value=cadena[15];
				document.f1.apellido.value=cadena[16];
				document.f1.telefono.value=cadena[17];
				document.f1.id_sector.value=cadena[27];
				document.f1.id_zona.value=cadena[30];
				document.f1.id_calle.value=cadena[24];
				document.f1.status_contrato.value=cadena[12];
				
				if(claseGlobal=="pagos"){
					//alertaa(cadena[39]);
					if(cadena[39]==""){
						cadena[39]="NATURAL";
					}
					document.f1.tipo_cliente.value=cadena[39];
					document.f1.inicial_doc.value=cadena[40];
					activa_tipo_c();
					asigna_tipo_c_pago(cadena[15],cadena[16]);
					
					document.f1.monto_pago.select();
					
					showTab('dhtmlgoodies_tabView1','7');
					showTab('dhtmlgoodies_tabView1','0');
					divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
					archivoDataGrid="procesos/datagrid_pagos.php?&id_contrato="+id_contrato()+"&";
					updateTable();
					document.f1.contrato_fisico.value=cadena[51];
					document.f1.direc_adicional.value=cadena[20];
					document.f1.observacion.value=cadena[8];
				}
			}
			else if(claseGlobal=="interfazacc" || claseGlobal=="interfaz_cablemodem"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				
				document.f1.cedula.value=cadena[14];
				document.f1.nombre.value=cadena[15] +" "+cadena[16];
				//document.f1.apellido.value=cadena[16];
				
				document.f1.status_contrato.value=cadena[12];
				
			}
			else if(claseGlobal=="consultar_pagos"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				document.f1.fecha_contrato.value=formatdatei(cadena[6]);
				document.f1.etiqueta.value=cadena[9];
				
				document.f1.cedula.value=cadena[14];
				document.f1.nombre.value=cadena[15];
				document.f1.apellido.value=cadena[16];
				document.f1.telefono.value=cadena[17];
				
				document.f1.status_contrato.value=cadena[12];
				
			}
			else if(claseGlobal=="actualizar_pagos"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.id_calle.value=cadena[2];
				document.f1.nro_contrato.value=cadena[5];
				document.f1.fecha_contrato.value=formatdatei(cadena[6]);
				document.f1.etiqueta.value=cadena[9];
				
				document.f1.cedula.value=cadena[14];
				document.f1.nombre.value=cadena[15];
				document.f1.apellido.value=cadena[16];
				document.f1.telefono.value=cadena[17];
				
				document.f1.id_sector.value=cadena[22];
				document.f1.id_zona.value=cadena[25];
				document.f1.status_contrato.value=cadena[12];
				
				if(claseGlobal=="actualizar_pagos"){
					divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
					archivoDataGrid="procesos/datagrid_actualizar_pagos.php?&id_contrato="+id_contrato()+"&";
					updateTable();
				}
			}
			else if(claseGlobal=="ordenes_tecnicos"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				document.f1.cedula.value=cadena[14];
				document.f1.nombre.value=cadena[15];
				document.f1.apellido.value=cadena[16];
				document.f1.status_pago.value=cadena[12];
				
				document.f1.id_sector.value=cadena[27];
				document.f1.id_zona.value=cadena[30];
				document.f1.id_calle.value=cadena[24];
				
				document.f1.status_con.value=cadena[12];
				document.f1.contrato_fisico.value=cadena[51];
				
				//conexionPHP('informacion.php',"traerTOStatus",status_con());
				conexionPHP('informacion.php',"verificaOrden",id_contrato());
			}
			else if(claseGlobal=="ordenes_tecnicos_modificar"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				document.f1.cedula.value=cadena[14];
				document.f1.nombre.value=cadena[15];
				document.f1.apellido.value=cadena[16];
				document.f1.status_pago.value=cadena[12];
				
				document.f1.id_sector.value=cadena[27];
				document.f1.id_zona.value=cadena[30];
				document.f1.id_calle.value=cadena[24];
				
				document.f1.status_con.value=cadena[12];
				
				conexionPHP("informacion.php","trae_info_grupo",id_orden());
			}
			else if(claseGlobal=="reimp_factura"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				document.f1.cedula.value=cadena[14];
				document.f1.nombre.value=cadena[15];
				document.f1.apellido.value=cadena[16];
				document.f1.status_contrato.value=cadena[12];
				
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="reportes/reimp_factura.php?&id_contrato="+id_contrato()+"&";
				updateTable();
			}
			else if(claseGlobal=="reimp_ordenes"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				document.f1.cedula.value=cadena[14];
				document.f1.nombre.value=cadena[15];
				document.f1.apellido.value=cadena[16];
				document.f1.status_contrato.value=cadena[12];
				
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="reportes/reimp_ordenes.php?&id_contrato="+id_contrato()+"&";
				updateTable();
			}
			
			else if(claseGlobal=="agregar_promo_contrato"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				
				document.f1.cedula.value=cadena[14];
				document.f1.nombre.value=cadena[15];
				document.f1.apellido.value=cadena[16];
				document.f1.status_pago.value=cadena[12];
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
					archivoDataGrid="procesos/datagrid_promo_contrato.php?&id_contrato="+id_contrato()+"&";
					updateTable();
			//	conexionPHP("informacion.php","traerMensualidad",id_contrato());
			}
			else if(claseGlobal=="convenio_pago"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				
				document.f1.cedula.value=cadena[14];
				document.f1.nombre.value=cadena[15];
				document.f1.apellido.value=cadena[16];
				document.f1.status_pago.value=cadena[12];
				
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
					archivoDataGrid="procesos/datagrid_convenio_pago.php?&id_contrato="+id_contrato()+"&";
					updateTable();
			
			}
			else if(claseGlobal=="cargar_deuda"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				
				document.f1.cedula.value=cadena[14];
				document.f1.nombre.value=cadena[15];
				document.f1.apellido.value=cadena[16];
				document.f1.status_pago.value=cadena[12];
			//	conexionPHP("informacion.php","traerMensualidad",id_contrato());
			}
			else if(claseGlobal=="llamadas"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				
				document.f1.cedula.value=cadena[14];
				document.f1.nombre.value=cadena[15];
				document.f1.apellido.value=cadena[16];
				document.f1.status_pago.value=cadena[12];
				
			//	conexionPHP("informacion.php","traerMensualidad",id_contrato());
			}
			else if(claseGlobal=="Rep_estadocuenta"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				document.f1.cedula.value=cadena[14];
				
				archivoDataGrid="reportes/Rep_estadocuenta.php?&id_contrato="+id_contrato()+"&";
				updateTable();
			}
			else if(claseGlobal=="Rep_historialpago"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				document.f1.cedula.value=cadena[14];
				
				archivoDataGrid="reportes/Rep_historialpago.php?&id_contrato="+id_contrato()+"&";
				updateTable();
			}
			else if(claseGlobal=="contrato"){
				alerta("Error, el numero de contrato ya corresponde a un Cliente");
				//alerta(document.f1.nro_contrato_nuevo.value);
				document.f1.nro_contrato.value=document.f1.nro_contrato_nuevo.value;
			}
			else{
				//alerta(cadena);
				document.f1.id_contrato.value=cadena[1];
				document.f1.id_calle.value=cadena[2];
				document.f1.id_persona.value=cadena[3];
				document.f1.cli_id_persona.value=cadena[4];
				document.f1.nro_contrato.value=cadena[5];
				document.f1.fecha_contrato.value=formatdatei(cadena[6]);
				document.f1.hora_contrato.value=cadena[7];
				document.f1.observacion.value=cadena[8];
				document.f1.etiqueta.value=cadena[9];
				document.f1.costo_contrato.value=cadena[10];
				document.f1.costo_dif_men.value=cadena[11];
				
				document.f1.status_pago.value=cadena[12];

				document.f1.nro_factura.value=cadena[13];
				
				document.f1.direc_adicional.value=cadena[20];
				document.f1.numero_casa.value=cadena[21];

				if(cadena[36]!='' && cadena[36]!='0'){
					document.f1.edificio.value=cadena[36];
					
					document.f1.edificio.disabled=false;
					document.f1.numero_piso.disabled=false;
					document.f1.tipo_costo[1].checked=true;
				}
				else{
					document.f1.edificio.disabled=true;
					document.f1.numero_piso.disabled=true;
					document.f1.edificio.selectedIndex=0;
					document.f1.numero_piso.value='';
				}
				document.f1.numero_piso.value=cadena[37];
				
				document.f1.postel.value=cadena[43];
				document.f1.taps.value=cadena[44];
				document.f1.pto.value=cadena[45];
				document.f1.id_g_a.value=cadena[46];
				document.f1.urbanizacion.value=cadena[48];
				document.f1.cod_id_persona.value=cadena[50];
				
				
				document.f1.cedula.value=cadena[14];
				document.f1.nombre.value=cadena[15];
				document.f1.apellido.value=cadena[16];
				document.f1.telefono.value=cadena[17];
				
				document.f1.telf_casa.value=cadena[18];
				document.f1.email.value=cadena[19];
				document.f1.telf_adic.value=cadena[38];
				
				document.f1.tipo_cliente.value=cadena[39];
				activa_tipo_c()
				document.f1.inicial_doc.value=cadena[40];
				asigna_tipo_c(cadena[15],cadena[16]);
				document.f1.fecha_nac.value=formatdatei(cadena[41]);
				
				
				//conexionPHP("validarExistencia.php","1=@vista_cliente","id_persona=@"+cli_id_persona());
				
				if(claseGlobal=="act_contrato"){
						conexionPHP("validarExistencia.php","1=@vista_ubica","id_calle=@"+id_calle());
						
						document.f1.n_contrato.value=cadena[5];
						document.f1.contrato_fisico.value=cadena[51];
						document.f1.etiqueta_n.value=cadena[52];
						traeRadiotipo_fact(cadena[53]);
						traeRadiocontrato_imp(cadena[54]);
						document.f1.ultima_act.value=formatdatei(cadena[55]);
						
						//mostrar_estado_cuenta();
						
						divDataGrid="datagrid";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_contrato_servicio.php?&id_contrato="+id_contrato()+"&";
						listar_datos(archivoDataGrid,divDataGrid);


						if( modulo_cable_modem_G=='1'){
							divDataGrid="cablemo";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
							archivoDataGrid="procesos/datagrid_cablemo.php?&id_contrato="+id_contrato()+"&";
							listar_datos(archivoDataGrid,divDataGrid);

							divDataGrid="decoana";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
							archivoDataGrid="procesos/datagrid_decoana.php?&id_contrato="+id_contrato()+"&";
							listar_datos(archivoDataGrid,divDataGrid);
							
							conexionPHP("informacion.php","traer_serv_acc_susc",id_contrato());
							
						}
						divDataGrid="estado_cuenta"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_estado_cuenta.php?&id_contrato="+id_contrato()+"&";
						listar_datos(archivoDataGrid,divDataGrid);
						


						
						/*
						divDataGrid="cargos"; 
						archivoDataGrid="procesos/datagrid_actualizar_pagos.php?&id_contrato="+id_contrato()+"&";
						updateTable();
						*/
						var id_cont_cli = id_contrato();
						$(document).ready( tabConsultarCliente(id_cont_cli) ); //función personalizada en bootstrap/js/tab.js
						
						//showTab('dhtmlgoodies_tabView1','7');
						//showTab('dhtmlgoodies_tabView1','0');
				}
				traerSector();
				
			}
		//	alert(":"+alert_act_G+":"+alert_imp_G+":")
			if(alert_act_G=="1"){
				if(compara_fecha(formatdate(dias_alert_act_G),formatdate(document.f1.ultima_act.value))>0){
					alerta("El contrato NO esta Actualizado\nUltima fecha de Actualizacion: "+document.f1.ultima_act.value);
				}
			}
			if(alert_imp_G=="1"){
				if(verRadiocontrato_imp()=="NO"){
					alerta("El cliente no posee Contrato impreso");
				}
			}
			break;
		case "vista_contrato_todo":
			if(claseGlobal=="pagos"){
				document.f1.id_contrato.value=cadena[1];
				
				document.f1.nro_contrato.value=cadena[5];
				
				document.getElementById("abonado").innerHTML="<label class='border-head'><h4>Abonado: </h4></label > </label> "+cadena[5]+"</label > ";
				document.getElementById("status").innerHTML="<label class='border-head'><h4>Status: </h4></label > <span style='color:blue; font-weight:blod; font-size:12pt'  >"+cadena[12]+" </span > ";
				document.getElementById("ced").innerHTML="<label  class='border-head'><h4>C.I/RIF: </h4></label > </label> "+cadena[40]+cadena[14]+"</label >  ";
				document.getElementById("cliente").innerHTML="<label class='border-head'><h4>CLIENTE: </h4></label > </label>"+cadena[15]+" "+cadena[16]+"</label >";
				document.getElementById("direccion").innerHTML="<label class='border-head'><h4>DIRECCION: </h4></label > </label> "+cadena[30]+"; "+cadena[27]+"; "+cadena[24]+"; "+cadena[23]+"</label >  </div >	<label class='border-head'><h4> REFERENCIA: </h4></label > </label> "+cadena[20]+"</label >  </div >	";
				
				/*
				//document.f1.fecha_contrato.value=formatdatei(cadena[6]);
				document.f1.fecha_contrato.value=cadena[21];
				document.f1.etiqueta.value=cadena[9];
				
				document.f1.cedula.value=cadena[14];
				document.f1.apellido.value=cadena[16];
				document.f1.telefono.value=cadena[17];
				
				document.f1.id_sector.value=cadena[27];
				document.f1.id_zona.value=cadena[30];
				document.f1.id_calle.value=cadena[24];
				document.f1.status_contrato.value=cadena[12];
				*/
				/*
				if(claseGlobal=="pagos"){
					//alerta(cadena[39]);
					if(cadena[39]==""){
						cadena[39]="NATURAL";
					}
					document.f1.tipo_cliente.value=cadena[39];
					document.f1.inicial_doc.value=cadena[40];
					activa_tipo_c();
					asigna_tipo_c_pago(cadena[15],cadena[16]);
					
					document.f1.monto_pago.select();
					
					showTab('dhtmlgoodies_tabView1','3');
					showTab('dhtmlgoodies_tabView1','0');
					
					*/
					//conexionPHP("informacion.php","traer_datos_abonado",document.f1.id_contrato.value);
					divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
					archivoDataGrid="procesos/datagrid_pagos.php?&id_contrato="+id_contrato()+"&";
					updateTable();
					/*
					document.f1.contrato_fisico.value=cadena[51];
					document.f1.direc_adicional.value=cadena[20];
					document.f1.observacion.value=cadena[8];
				}
					*/
				
			}
			else if(claseGlobal=="pagodeposito"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				document.f1.fecha_contrato.value=cadena[21];
				document.f1.etiqueta.value=cadena[9];
				
				document.f1.cedula.value=cadena[14];
				document.f1.nombre.value=cadena[15];
				document.f1.apellido.value=cadena[16];
				document.f1.telefono.value=cadena[17];
				
				document.f1.id_sector.value=cadena[27];
				document.f1.id_zona.value=cadena[30];
				document.f1.id_calle.value=cadena[24];
				document.f1.status_contrato.value=cadena[12];
					if(cadena[39]==""){
						cadena[39]="NATURAL";
					}
					document.f1.tipo_cliente.value=cadena[39];
					document.f1.inicial_doc.value=cadena[40];
					activa_tipo_c();
					asigna_tipo_c_pago(cadena[15],cadena[16]);
					
					document.f1.monto_pago.select();
					
					document.f1.contrato_fisico.value=cadena[51];
					document.f1.direc_adicional.value=cadena[20];
		
			}
			break;
		case "usuario":
			break;
		case "perfil":
			document.f1.codigo.value=cadena[1];
			document.f1.nombre.value=cadena[2];
			document.f1.descripcion.value=cadena[3];
			estatus(cadena[4]);
			break;
		case "vista_ubica":
			document.f1.id_sector.value=cadena[2];
			document.f1.id_zona.value=cadena[4];
			document.f1.id_ciudad.value=cadena[6];
			document.f1.id_mun.value=cadena[7];
			document.f1.id_esta.value=cadena[9];
			document.f1.id_franq.value=cadena[11];
			break;
		case "modulo":
			document.f1.codigo.value=cadena[1];
			document.f1.nombre.value=cadena[2];
			document.f1.name.value=cadena[3];
			document.f1.descripcion.value=cadena[4];
			estatus(cadena[5]);
			nombreModulo=document.f1.nombre.value;
			if(cadena[2]=='Modulo' || cadena[2]=='Perfil' || cadena[2]=='Usuario' || cadena[2]=='Persona' || cadena[2]=='CreaFormulario' || cadena[2]=='VerDatos')
				document.f1.nombre.disabled=true;
			else
				document.f1.nombre.disabled=false;
			break;
		case "personausuario":
			existeMat=true;
			document.f1.id_persona.value=cadena[1];
			document.f1.cedula.value=cadena[2];
			document.f1.nombre.value=cadena[3];
			document.f1.apellido.value=cadena[4];
			document.f1.telefono.value=cadena[5];
			
			document.f1.login.value=cadena[6];
			document.f1.codigoperfil.value=cadena[7];
			document.f1.password.value=cadena[8];
			document.f1.otropassword.value=cadena[8];			
			estatus(cadena[9]);
			
			document.f1.id_franq.value=cadena[13];			
			document.f1.id_servidor.value=cadena[15];			
			
			break;
		case "Manejador":
			radio(cadena[0]);
			document.f1.servidor.value=cadena[1];
			document.f1.login.value=cadena[2];
			document.f1.password.value=cadena[3];
			document.f1.database.value=cadena[4];
			manejador=cadena[0];
			break;
		case "persona":
			if(claseGlobal=="contrato"){
				document.f1.cli_id_persona.value=cadena[1];
			}else{
				document.f1.id_persona.value=cadena[1];
			}
			
			document.f1.cedula.value=cadena[2];
			document.f1.nombre.value=cadena[3];
			document.f1.apellido.value=cadena[4];
			document.f1.telefono.value=cadena[5];
			existeMat=true;
			
			if(claseGlobal=="tecnico"){
				validartecnico();
			}
			else if(claseGlobal=="cobrador"){
				validarcobrador();
			}
			else if(claseGlobal=="vendedor"){
				validarvendedor();
			}
			else if(claseGlobal=="gerentes_permitidos"){
				validargerentes_permitidos();
			}
			
			break;
		
		
		case "vista_cobrador":
			document.f1.id_persona.value=cadena[1];
			document.f1.cedula.value=cadena[2];
			document.f1.nombre.value=cadena[3];
			document.f1.apellido.value=cadena[4];
			document.f1.telefono.value=cadena[5];
			
			document.f1.nro_cobrador.value=cadena[6];
			document.f1.direccion_cob.value=cadena[7];
			document.f1.dato.value=cadena[9];
			document.f1.id_franq.value=cadena[9];
			break;
		case "vista_vendedor":
			document.f1.id_persona.value=cadena[1];
			document.f1.cedula.value=cadena[2];
			document.f1.nombre.value=cadena[3];
			document.f1.apellido.value=cadena[4];
			document.f1.telefono.value=cadena[5];
			
			document.f1.nro_vendedor.value=cadena[6];
			document.f1.direccion_ven.value=cadena[7];
			document.f1.id_franq.value=cadena[8];
			break;
		case "vista_cliente":
		
			if(claseGlobal=="comentario_cliente" || claseGlobal=="reclamo_denuncia"){
				document.f1.id_persona.value=cadena[1];
				document.f1.cedula.value=cadena[2];
				document.f1.nombre.value=cadena[3]+" "+cadena[4];
			}
			else{
				if(claseGlobal=="contrato"){
					existeMat=true;
					document.f1.cli_id_persona.value=cadena[1];
				}
				else{
					
						document.f1.id_persona.value=cadena[1];
				}
				if(cadena[9]==""){
					cadena[9]="NATURAL";
				}
				
				document.f1.cedula.value=cadena[2];
				document.f1.nombre.value=cadena[3];
				document.f1.apellido.value=cadena[4];
				document.f1.telefono.value=cadena[5];
				
				document.f1.telf_casa.value=cadena[6];
				document.f1.email.value=cadena[7];
				document.f1.telf_adic.value=cadena[8];
				
				document.f1.tipo_cliente.value=cadena[9];
				activa_tipo_c()
				document.f1.inicial_doc.value=cadena[10];
				asigna_tipo_c(cadena[3],cadena[4]);
				document.f1.fecha_nac.value=formatdatei(cadena[11]);
				
			}
			break;
		case "vista_cliente":
			//alerta(claseGlobal);
			if(claseGlobal=="act_contrato"){
			
			new BootstrapDialog({
		title: 'CONFIRMACIÓN DE SAECO',
		message: '¿la cedula corresponde a otro cliente. desea asignarle este contrato?',
		type: BootstrapDialog.TYPE_INFO,
		closable: false,
		buttons: [{
			label: 'NO',
			icon: 'glyphicon glyphicon-thumbs-down',
			cssClass: 'btn-danger',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
				document.f1.cedula.value='';
				dialog.close();
			}
		}, {
			label: 'SI',
			icon : 'glyphicon glyphicon-thumbs-up',
			cssClass: 'btn-info',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
				document.f1.cli_id_persona.value=cadena[1];
				document.f1.cedula.value=cadena[2];
				document.f1.nombre.value=cadena[3];
				document.f1.apellido.value=cadena[4];
				document.f1.telefono.value=cadena[5];
				
				document.f1.telf_casa.value=cadena[6];
				document.f1.email.value=cadena[7];
				document.f1.telf_adic.value=cadena[8];
				
				document.f1.tipo_cliente.value=cadena[9];
				activa_tipo_c()
				document.f1.inicial_doc.value=cadena[10];
				asigna_tipo_c(cadena[3],cadena[4]);
				document.f1.fecha_nac.value=formatdatei(cadena[11]);
				dialog.close();
			}
		}]
	}).open();
			
			 
			}
			
			break;
		case "vista_tecnico":
			document.f1.id_persona.value=cadena[1];
			document.f1.cedula.value=cadena[2];
			document.f1.nombre.value=cadena[3];
			document.f1.apellido.value=cadena[4];
			document.f1.telefono.value=cadena[5];
			
			document.f1.num_tecnico.value=cadena[6];
			document.f1.direccion_tec.value=cadena[7]; 
			document.f1.email.value=cadena[8];
			traeRadiosattus_gerente(cadena[9]);
			
			document.f1.id_franq.value=cadena[10];
			
			break;
		case "tipo_orden":
			document.f1.id_tipo_orden.value=cadena[1];
			document.f1.nombre_tipo_orden.value=cadena[2];
			break;
		case "detalle_orden":
			document.f1.id_det_orden.value=cadena[1];
			document.f1.id_tipo_orden.value=cadena[2]
			document.f1.nombre_det_orden.value=cadena[3];
			//document.f1.tipo_detalle.value=cadena[4];
			asignarCheck(cadena[4]);
			if(cadena[5]!=''){
				document.f1.status[0].click();
				document.f1.id_serv.value=cadena[5];
			}
			else{
				document.f1.status[1].click();
				document.f1.id_serv.value='0';
			}
			break;
		case "ordenes_tecnicos":
		//alerta(formatdatei(cadena[17])+":"+fecha_orden());
			if(formatdatei(cadena[17])==fecha_orden()){
			document.f1.id_orden.value=cadena[1];
			document.f1.id_persona.value=cadena[2];
			document.f1.id_det_orden.value=cadena[3];
			document.f1.fecha_orden.value=formatdatei(cadena[4]);
			document.f1.fecha_final.value=cadena[5];
			document.f1.detalle_orden.value=cadena[6];
			document.f1.comentario_orden.value=cadena[7];
			document.f1.status_orden.value=cadena[8];
			document.f1.id_contrato.value=cadena[9];
			document.f1.prioridad.value=cadena[10];
			traerTO();
			conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato());
			}else{
				alerta("Aviso, error solo puede modificar una finalizada el dia de hoy");
				
			}
			break;
		case "vista_orden":

			
			document.f1.id_orden.value=cadena[1];
			document.f1.fecha_imp.value=cadena[2];
			document.f1.id_det_orden.value=cadena[3];
			document.f1.fecha_orden.value=formatdatei(cadena[4]);
			document.f1.fecha_final.value=cadena[5];
			document.f1.detalle_orden.value=cadena[6];
			document.f1.comentario_orden.value=cadena[7];
			document.f1.status_orden.value=cadena[8];
			document.f1.id_contrato.value=cadena[9];
			document.f1.prioridad.value=cadena[10];
			
			document.f1.id_tipo_orden.value=cadena[11];
			
			

			//conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato());
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				
				document.f1.cedula.value=cadena[13];
				document.f1.nombre.value=cadena[14];
				document.f1.apellido.value=cadena[15];
				
				document.f1.status_pago.value=cadena[21];
				
				document.f1.id_sector.value=cadena[25];
				document.f1.id_zona.value=cadena[23];
				document.f1.id_calle.value=cadena[27];
				
				document.f1.status_con.value=cadena[21];
				//conexionPHP('informacion.php',"traerTOStatus",status_con());
				//conexionPHP('informacion.php',"verificaOrden",id_contrato());
				
			break;
		case "franquicia":
			document.f1.id_franq.value=cadena[1];
			document.f1.nombre_franq.value=cadena[2];
			document.f1.estado_franq.value=cadena[3];
			document.f1.ciudad_franq.value=cadena[4];
			document.f1.municipio_franq.value=cadena[5];
			document.f1.direccion_franq.value=cadena[6];
			break;
		case "parametros":
			document.f1.id_param.value=cadena[1];
			document.f1.id_franq.value=cadena[2];
			document.f1.fecha_param.value=formatdatei(cadena[3]);
			document.f1.parametro.value=cadena[4];
			document.f1.valor_param.value=cadena[5];
			document.f1.obser_param.value=cadena[6];
			break;
		case "calle":
			document.f1.id_calle.value=cadena[1];
			document.f1.id_sector.value=cadena[2];
			document.f1.nro_calle.value=cadena[3];
			document.f1.nombre_calle.value=cadena[4];
			traerZona();
			break;
		case "urbanizacion":
			document.f1.id_calle.value=cadena[1];
			document.f1.id_sector.value=cadena[2];
			
			document.f1.nombre_calle.value=cadena[3];
			traerZona();
			break;
		case "vista_calle":
			document.f1.id_calle.value=cadena[1];
			document.f1.id_sector.value=cadena[2];
			document.f1.nro_calle.value=cadena[3];
			document.f1.nombre_calle.value=cadena[4];
			
			document.f1.id_zona.value=cadena[5];
			document.f1.id_franq.value=cadena[8];
			break;
		case "vista_sector":
			document.f1.id_sector.value=cadena[1];
			document.f1.id_zona.value=cadena[2];
			document.f1.nro_sector.value=cadena[3];
			document.f1.nombre_sector.value=cadena[4];
			document.f1.id_franq.value=cadena[5];
			document.f1.dato.value=cadena[13];
			document.f1.afiliacion.value=cadena[14];
			break;
		case "sector":
			document.f1.id_sector.value=cadena[1];
			document.f1.id_zona.value=cadena[2];
			document.f1.nro_sector.value=cadena[3];
			document.f1.nombre_sector.value=cadena[4];
			traer_ciudad();
			break;
		case "zona":
			document.f1.id_zona.value=cadena[1];
			
			document.f1.nro_zona.value=cadena[3];
			document.f1.nombre_zona.value=cadena[4];
			document.f1.id_ciudad.value=cadena[6];
			traer_municipio();
			break;
		case "materiales":
			
			document.f1.id_mat.value=cadena[1];
			document.f1.numero_mat.value=cadena[2];
			document.f1.nombre_mat.value=cadena[3];
			document.f1.unidad_mat.value=cadena[4];
			document.f1.abrevia_unidad.value=cadena[5];
			document.f1.cant_existencia.value=cadena[6];
			document.f1.precio.value=cadena[7];
			if(claseGlobal=="ent_sal_mat"){
				existeMat=true;
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="procesos/datagrid_ent_sal_mat.php?id_mat="+id_mat()+"&";
				updateTable();
			}
			if(claseGlobal=="sal_mat"){
				existeMat=true;
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="procesos/datagrid_sal_mat.php?id_mat="+id_mat()+"&";
				updateTable();
			}
			else{
				document.f1.observacion.value=cadena[8];
			}
			break;
		case "vista_materiales":
			document.f1.id_ent_sal.value=cadena[1];
			document.f1.id_mat.value=cadena[2];
			document.f1.tipo_ent_sal.value=cadena[3];
			document.f1.fecha_ent_sal.value=formatdatei(cadena[4]);
			document.f1.hora_ent_sal.value=cadena[5];
			document.f1.cant_ent_sal.value=cadena[6];
			document.f1.precio_compra.value=cadena[7];
			document.f1.observacion.value=cadena[8];
			
			document.f1.numero_mat.value=cadena[9];
			document.f1.nombre_mat.value=cadena[10];
			document.f1.unidad_mat.value=cadena[11];
			document.f1.abrevia_unidad.value=cadena[12];
			document.f1.cant_existencia.value=cadena[13];
			document.f1.precio.value=cadena[14];
			existeMat=true;
			break;
		case "inventario":
			document.f1.id_inv.value=cadena[1];
			document.f1.fecha_inv.value=formatdatei(cadena[2]);
			document.f1.hora_inv.value=cadena[3];
			document.f1.obser_inv.value=cadena[4];
			break;
		case "inventario_materiales":
			document.f1.id_mat.value=cadena[1];
			document.f1.id_inv.value=cadena[2];
			document.f1.cantidad.value=cadena[3];
			break;
		case "tipo_servicio":
			document.f1.id_tipo_servicio.value=cadena[1];
			document.f1.tipo_servicio.value=cadena[2];
			traeRadiostatus_servicio(cadena[3]);
			document.f1.id_franq.value=cadena[4];
			break;
		case "servicios":
			document.f1.id_serv.value=cadena[1];
			document.f1.id_tipo_servicio.value=cadena[2];
			document.f1.nombre_servicio.value=cadena[3];
			traeRadiostatus_serv(cadena[4]);
			traeRadiotipo_costo(cadena[5]);
			hab_tipo_paq();
			document.f1.tipo_paq.value=cadena[6];
			document.f1.obser_serv.value=cadena[7];
			document.f1.tarifa_esp.value=cadena[8];                                                                                       
			document.f1.tipo_serv.value=cadena[10];
			document.f1.id_paq.value=cadena[11];
			document.f1.id_cant.value=cadena[12];
			
			conexionPHP("informacion.php","traer_serv_acc",document.f1.id_serv.value);
			conexionPHP("informacion.php","traer_serv_franq",document.f1.id_serv.value);

			break;
		case "vista_tarifa":
			document.f1.id_tar_ser.value=cadena[1];
			document.f1.id_serv.value=cadena[2];
			document.f1.fecha_tar_ser.value=formatdatei(cadena[3]);
			document.f1.hora_tar_ser.value=cadena[4];
			document.f1.obser_tarifa_ser.value=cadena[5];
			traeRadiostatus_tarifa_ser(cadena[6]);
			document.f1.tarifa_ser.value=cadena[7];
			
			document.f1.id_tipo_servicio.value=cadena[8];
			
			break;
		case "contrato_servicio":
			document.f1.id_cont_serv.value=cadena[1];
			document.f1.id_serv.value=cadena[2];
			//document.f1.id_contrato.value=cadena[3];
			document.f1.cant_serv.value=cadena[5];
			document.f1.costo_cobro.value=cadena[7];
			document.f1.agregar.value="Modificar";
			break;
		
		case "pago_servicio":
			document.f1.id_pago.value=cadena[1];
			document.f1.id_cont_serv.value=cadena[2];
			break;
		case "pagos":
			document.f1.id_pago.value=cadena[1];
			document.f1.id_caja_cob.value=cadena[2];
			document.f1.fecha_pago.value=formatdatei(cadena[3]);
			document.f1.hora_pago.value=cadena[4];
			document.f1.monto_pago.value=cadena[5];
			document.f1.obser_pago.value=cadena[6];
			document.f1.status_pago.value=cadena[7];
			document.f1.nro_factura.value=cadena[8];
			document.f1.id_contrato.value=cadena[9];
			
			/*
				document.f1.total.value=cadena[19];
				document.f1.desc.value=cadena[14];
				document.f1.monto_iva.value=cadena[16];
				document.f1.porc_reten.value=cadena[17];
				document.f1.monto_reten.value=cadena[18];
				document.f1.islr.value=cadena[20];
				document.f1.status_contrato.value=cadena[12];
				document.f1.fecha_factura.value=formatdatei(cadena[22]);
*/				

			if(claseGlobal=="anular_pagos" || claseGlobal=="nota_de_credito"){
				
				conexionPHP('validarExistencia.php','1=@vista_contrato',"id_contrato=@"+document.f1.id_contrato.value);
				conexionPHP('validarExistencia.php','1=@detalle_tipopago',"id_pago=@"+document.f1.id_pago.value);
				conexionPHP("informacion.php","traeinfoFact",id_pago());
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="procesos/datagrid_anular_pagos.php?&id_pago="+id_pago()+"&";
				updateTable();
				
			}else if(claseGlobal=="consultar_pagos"){
				
				conexionPHP('validarExistencia.php','1=@vista_contrato',"id_contrato=@"+document.f1.id_contrato.value);
				conexionPHP('validarExistencia.php','1=@detalle_tipopago',"id_pago=@"+document.f1.id_pago.value);
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="procesos/datagrid_anular_pagos.php?&id_pago="+id_pago()+"&";
				updateTable();
				
			}else if(claseGlobal=="modificar_pagos"){
				conexionPHP("informacion.php","traeinfo_forma_pago",id_pago());
			}else if(claseGlobal=="modificar_pagos1"){
				document.f1.nro_factura1.value=cadena[8];
				document.f1.nro_control1.value=cadena[12];
			}
			
			break;
		case "detalle_tipopago":
			document.f1.id_tipo_pago.value=cadena[1];
			//cargarDetTipoPago();
			document.f1.banco.value=cadena[3];
			document.f1.numero.value=cadena[4];
			
			document.f1.banco.disabled=true;
			document.f1.numero.disabled=true;
			
			
			
			break;
		case "vista_tipopago":
			document.f1.id_pago.value=cadena[2];
			document.f1.id_caja_cob.value=cadena[6];
			document.f1.fecha_pago.value=formatdatei(cadena[7]);
			document.f1.hora_pago.value=cadena[8];
			document.f1.monto_pago.value=cadena[9];
			document.f1.obser_pago.value=cadena[10];
			document.f1.status_pago.value=cadena[11];
			document.f1.nro_factura.value=cadena[12];
			
			document.f1.id_tipo_pago.value=cadena[1];
			cargarDetTipoPago();	
			document.f1.banco.value=cadena[3];
			document.f1.numero.value=cadena[4];
			
			document.f1.banco.disabled=true;
			document.f1.numero.disabled=true;
			
			if(claseGlobal=="anular_pagos"){
				
				conexionPHP('validarExistencia.php','1=@vista_contrato',"id_contrato=@"+cadena[15])
				conexionPHP('validarExistencia.php','1=@vista_contrato',"id_contrato=@"+cadena[15])
				conexionPHP("informacion.php","traeinfoFact",id_pago());
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="procesos/datagrid_anular_pagos.php?&id_pago="+id_pago()+"&";
				updateTable();
				
			}
			else if(claseGlobal=="modificar_pagos"){
				document.f1.monto_tp.value=cadena[5];
				document.f1.nro_factura1.value=cadena[12];	
				monto_tp=cadena[9];
				cargarDetTipoPago();
			}
			else if(claseGlobal=="modificar_pagos1"){
				document.f1.nro_factura1.value=cadena[12];
				cargarDetTipoPago();
			}
			break;
		case "vista_pagoser":
			document.f1.id_contrato.value=cadena[11];
			conexionPHP('validarExistencia.php','1=@vista_contrato',"id_contrato=@"+id_contrato())
			break;
		case "tipo_pago":
			document.f1.id_tipo_pago.value=cadena[1];
			document.f1.tipo_pago.value=cadena[2];
			traeRadiostatus_pago(cadena[3]);
			break;
		case "cirre_diario":
			document.f1.id_cierre.value=cadena[1];
			document.f1.fecha_cierre.value=formatdatei(cadena[2]);
			document.f1.hora_cierre.value=cadena[3];
			document.f1.monto_total.value=cadena[4];
			document.f1.obser_cierre.value=cadena[5];
			document.f1.id_franq.value=cadena[7];
			break;
		case "cierre_pago":
			document.f1.id_cont_serv.value=cadena[1];
			document.f1.id_cierre.value=cadena[2];
			break;
		case "caja":
			document.f1.id_caja.value=cadena[1];
			document.f1.nombre_caja.value=cadena[2];
			document.f1.descripcion_caja.value=cadena[3];
			document.f1.id_franq.value=cadena[7];
			traeRadiostatus_caja(cadena[4]);
			//alerta(cadena[5]);
			traeRadiotipo_caja(cadena[8]);
			break;
		case "caja_cobrador":
			document.f1.id_caja_cob.value=cadena[1];
			document.f1.id_caja.value=cadena[2];
			document.f1.id_persona.value=cadena[3];
			document.f1.fecha_caja.value=formatdatei(cadena[4]);
			document.f1.apertura_caja.value=cadena[5];
			//document.f1.cierre_caja.value=cadena[6];
			//document.f1.monto_acum.value=cadena[7];
			//document.f1.status_caja.value=cadena[8];
			document.f1.registrar.disabled=false;
			
			break;
		case "vista_reclamo":
			document.f1.id_rec.value=cadena[1];
			document.f1.id_persona.value=cadena[2];
			document.f1.nro_rec.value=cadena[3];
			traeRadiotipo_rec(cadena[4]);
			document.f1.fecha_rec.value=formatdatei(cadena[5]);
			document.f1.hora_rec.value=cadena[6];
			document.f1.motivo_rec.value=cadena[7];
			document.f1.descrip_rec.value=cadena[8];
			document.f1.denunciado.value=cadena[9];
			document.f1.status_rec.value=cadena[10];
			
			document.f1.cedula.value=cadena[11];
			document.f1.nombre.value=cadena[12]+" "+cadena[13];
			
			
			break;
		case "vista_comentario":
			document.f1.id_comen.value=cadena[1];
			document.f1.id_persona.value=cadena[2];
			document.f1.nro_comen.value=cadena[3];
			document.f1.fecha_comen.value=formatdatei(cadena[4]);
			document.f1.hora_comen.value=cadena[5];
			document.f1.comentario.value=cadena[6];
			traeRadiostatus_comen(cadena[7]);
			
			
				document.f1.cedula.value=cadena[8];
				document.f1.nombre.value=cadena[9]+" "+cadena[10];
			break;
		case "pago_comisiones":
			document.f1.id_comi.value=cadena[1];
			document.f1.id_persona.value=cadena[2];
			traeRadiocomi_para(cadena[3]);
			document.f1.fecha_comi.value=formatdatei(cadena[4]);
			document.f1.fecha_desde.value=formatdatei(cadena[5]);
			document.f1.fecha_hasta.value=formatdatei(cadena[6]);
			document.f1.porcent_aplic.value=cadena[7];
			document.f1.monto_comi.value=cadena[8];
			document.f1.status_comi.value=cadena[9];
			break;
		case "status_contrato":
			document.f1.dato.value=cadena[1];
			document.f1.status_contrato.value=cadena[2];
			document.f1.id_contrato.value=cadena[3];
			document.f1.nombre_status.value=cadena[4];
			document.f1.fecha_status.value=formatdatei(cadena[5]);
			document.f1.hora_status.value=cadena[6];
			document.f1.status_con.value=cadena[7];
			break;
		case "edificio":
			document.f1.id_edif.value=cadena[1];
			document.f1.id_sector.value=cadena[2];
			document.f1.edificio.value=cadena[3];
			traerZona();
			break;
		case "banco":
			document.f1.id_banco.value=cadena[1];
			document.f1.banco.value=cadena[2];
			document.f1.tipo_banco.value=cadena[3];
			break;
		case "grupo_trabajo":
			//alerta(cadena);
			document.f1.id_gt.value=cadena[1];
			document.f1.nombre_grupo.value=cadena[5];
			document.f1.organizar_por.value=cadena[4];
			document.f1.fecha_creacion.value=formatdatei(cadena[2]);
			document.f1.hora_creacion.value=cadena[3];
			document.f1.id_franq.value=cadena[7];
			traeRadiostatus_grupo(cadena[6]);
			
			trae_ubi_gru_f_G=true;
			divDataGrid="grupo_ubicacion";params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_grupo_ubicacion.php?organizar_por="+document.f1.organizar_por.value+"&";
			updateTable();
		
			conexionPHP("informacion.php","trae_tec_gru",id_gt());
		
			break;
		case "grupo_tecnico":
			document.f1.id_gt.value=cadena[1];
			document.f1.id_persona.value=cadena[2];
			break;
		case "orden_grupo":
			document.f1.id_orden.value=cadena[1];
			document.f1.id_gt.value=cadena[2];
			break;
		case "sms":
			document.f1.dato.value=cadena[1];
			document.f1.id_sms.value=cadena[2];
			document.f1.id_contrato.value=cadena[3];
			document.f1.nro_sms.value=cadena[4];
			document.f1.tipo_sms.value=cadena[5];
			document.f1.telefono_sms.value=cadena[6];
			document.f1.fecha_sms.value=cadena[7];
			document.f1.hora_sms.value=cadena[8];
			document.f1.mensaje_sms.value=cadena[9];
			document.f1.status_sms.value=cadena[10];
			document.f1.login.value=cadena[11];
			break;
		case "envio_aut":
			document.f1.id_envio.value=cadena[1];
			document.f1.id_franq.value=cadena[2];
			document.f1.tipo_envio.value=cadena[3];
			document.f1.nombre_envio.value=cadena[4];
			document.f1.envio_sms.value=cadena[5];
			document.f1.envio_email.value=cadena[6];
			document.f1.descripcion_envio.value=cadena[7];
			document.f1.tipo_variable.value=cadena[9];
			document.f1.resp_correo.value=cadena[10];
			if(claseGlobal=="edit_envio_aut"){
				cuenta_carac();
				
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="procesos/listadovariables.php?tipo_variable="+tipo_variable()+"&";
				updateTable();
			}
			
			break;
		case "comandos_sms":
			document.f1.id_com.value=cadena[1];
			document.f1.id_franq.value=cadena[2];
			document.f1.tipo_com.value=cadena[3];
			document.f1.nombre_com.value=cadena[4];
			document.f1.descrip_com.value=cadena[5];
			document.f1.status_com.value=cadena[6];
			document.f1.sms_resp.value=cadena[7];
			document.f1.tipo_variable.value=cadena[8];
			document.f1.sms_error.value=cadena[9];
			document.f1.status_error.value=cadena[10];
			document.f1.resp_correo.value=cadena[11];
			
			if(claseGlobal=="edit_comandos_sms"){
				cuenta_carac_com();
				cuenta_carac_com_e();
				
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="procesos/listadovariables.php?tipo_variable="+tipo_variable()+"&";
				updateTable();
			}
			break;
		case "formato_sms":
			if(claseGlobal=="datos_mensajes"){
				document.f1.sms.value=cadena[4];
			}
			else{
			document.f1.id_form.value=cadena[1];
			document.f1.id_franq.value=cadena[2];
			document.f1.nombre_form.value=cadena[3];
			document.f1.formato.value=cadena[4];
			traeRadiostatus_form(cadena[5]);
			}
			
			break;
		case "config_sms":
			document.f1.id_conf_sms.value=cadena[1];
			document.f1.id_franq.value=cadena[2];
			document.f1.cod_telf_pais.value=cadena[3];
			document.f1.telefono_serv.value=cadena[4];
			document.f1.id_canal_sms.value=cadena[5];
			document.f1.correo_emp.value=cadena[6];
			document.f1.clave_correo.value=cadena[7];
			document.f1.asunto_correo.value=cadena[8];
			traeRadioper_telf_fijo(cadena[9]);
			traeRadioenv_todos_telf(cadena[10]); 
			traeRadioact_resp_aut(cadena[11]);
			document.f1.sms_resp_aut.value=cadena[12];
			document.f1.conf_campo1.value=cadena[13];
			document.f1.conf_campo2.value=cadena[14];
			document.f1.conf_campo3.value=cadena[15];
			document.f1.marca.value=cadena[16];
			document.f1.modelo.value=cadena[17];
			hab_text_sms();
			
			cuenta_carac_d();
			break;
		case "vista_gerentes":
			document.f1.id_persona.value=cadena[1];
			document.f1.cedula.value=cadena[2];
			document.f1.nombre.value=cadena[3];
			document.f1.apellido.value=cadena[4];
			document.f1.telefono.value=cadena[5];
			document.f1.nro_gerente.value=cadena[6];
			document.f1.tipo_gerente.value=cadena[7];
			document.f1.cargo_gerente.value=cadena[8];
			document.f1.descrip_gerente.value=cadena[9];
			traeRadiosattus_gerente(cadena[10]);
			document.f1.email.value=cadena[11];
			document.f1.id_franq.value=cadena[12];
			break;
		case "variables_sms":
			document.f1.id_var.value=cadena[1];
			document.f1.variable.value=cadena[2];
			asignarCheck(cadena[3]);
			document.f1.descrip_var.value=cadena[4];
			traeRadiostatus_var(cadena[5]);
			document.f1.id_franq.value=cadena[6];
			break;
		case "statuscont":
			document.f1.idstatus.value=cadena[1];
			document.f1.nombrestatus.value=cadena[2];
			document.f1.dato.value=cadena[4];
			traeRadiostatus(cadena[3]);
			break;
		case "motivonotas":
			document.f1.idmotivonota.value=cadena[1];
			document.f1.nombremotivonota.value=cadena[2];
			traeRadiostatus(cadena[3]);
			break;
		case "motivollamada":
			document.f1.idmotivonota.value=cadena[1];
			document.f1.nombremotivonota.value=cadena[2];
			traeRadiostatus(cadena[3]);
			break;
		case "otros_datos":
			document.f1.dato.value=cadena[1];
			break;
		case "contrato_ser":
			/*document.f1.dato.value=cadena[];
			document.f1.id_seg.value=cadena[];
			document.f1.firma_seg.value=cadena[];
			document.f1.llave_enc.value=cadena[];
			*/
			document.f1.llave_dec.value=cadena[1];
			document.f1.licencia_seg.value=cadena[3];
			document.f1.limite_reg.value=cadena[2];
			document.f1.fecha_lic.value=formatdatei(cadena[4]);
			document.f1.hora_lic.value=cadena[5];
			document.f1.empresa_aut.value=cadena[6];
			document.f1.version_sis.value=cadena[7];
			document.f1.acerca_de.value=cadena[8];
			document.f1.status_seg.value=cadena[9];
			/*document.f1.campo_seg1.value=cadena[];
			document.f1.campo_seg2.value=cadena[];
			document.f1.campo_seg3.value=cadena[];
			document.f1.campo_seg4.value=cadena[];
			document.f1.campo_seg5.value=cadena[];
			document.f1.campo_seg6.value=cadena[];
			document.f1.campo_seg7.value=cadena[];
			*/
			break;
		case "familia":
			document.f1.dato.value=cadena[1];
			document.f1.id_fam.value=cadena[2];
			document.f1.nombre_fam.value=cadena[3];
			traeRadiostatus_fam(cadena[4]);
			break;
		case "grupo_afinidad":
			document.f1.id_g_a.value=cadena[1];
			document.f1.nombre_g_a.value=cadena[2];
			traeRadiostatus_g_a(cadena[3]);
			break;
		case "tipo_alarma":
			document.f1.id_tipo_alarma.value=cadena[1];
			document.f1.nombre_alarma.value=cadena[2];
			traeRadiostatus_alarma(cadena[3]);
			break;
		case "alarma_perfil":
			document.f1.codigoperfil.value=cadena[1];
			document.f1.id_tipo_alarma.value=cadena[2];
			break;
		case "interfazacc":
			document.f1.id_alarma.value=cadena[1];
			document.f1.id_tipo_alarma.value=cadena[2];
			document.f1.nombre_alarma.value=cadena[3];
			document.f1.detalle_alarma.value=cadena[4];
			document.f1.fecha_alarma.value=formatdatei(cadena[5]);
			document.f1.ref_alarma.value=cadena[6];
			document.f1.status_alarma.value=cadena[7];
			break;
		case "grupo_ubicacion":
			document.f1.id_gt.value=cadena[1];
			document.f1.id_sector.value=cadena[2];
			break;
		case "estacion_trabajo":
			document.f1.id_est.value=cadena[1];
			document.f1.login.value=cadena[2];
			document.f1.nombre_est.value=cadena[3];
			document.f1.ip_est.value=cadena[4];
			document.f1.mac_est.value=cadena[5];
			document.f1.nom_comp.value=cadena[6];
			traeRadiostatus_est(cadena[7]);
			break;
		case "precintos":
			document.f1.id_prec.value=cadena[1];
			document.f1.login.value=cadena[2];
			document.f1.nombre_prec.value=cadena[3];
			document.f1.fecha_ing_prec.value=formatdatei(cadena[4]);
			document.f1.fecha_mod_prec.value=formatdatei(cadena[5]);
			traeRadiostatus_prec(cadena[6]);
			break;
		case "estado":
			document.f1.id_esta.value=cadena[1];
			document.f1.id_franq.value=cadena[2];
			document.f1.nombre_esta.value=cadena[3];
			traeRadiostatus_esta(cadena[4]);
			break;
		case "vista_municipio":
			
			document.f1.id_mun.value=cadena[1];
			document.f1.id_esta.value=cadena[2];
			document.f1.nombre_mun.value=cadena[3];
			traeRadiostatus_mun(cadena[4]);
			document.f1.id_franq.value=cadena[5];
			break;
		case "vista_ciudad":
			
			document.f1.id_ciudad.value=cadena[1];
			document.f1.id_mun.value=cadena[2];
			document.f1.nombre_ciudad.value=cadena[3];
			traeRadiostatus_ciudad(cadena[4]);
			document.f1.id_esta.value=cadena[5];
			document.f1.id_franq.value=cadena[8];
			break;
		/*
		case "cablemodem":
		if(claseGlobal=="act_contrato"){
			document.f1.id_cm.value=cadena[1];
			document.f1.codigo_cm.value=cadena[3];
			document.f1.status_cm.value=cadena[7];
			document.f1.marca_cm.value=cadena[4];
			document.f1.modelo_cm.value=cadena[5];
			document.f1.agregarcm.value="Modificar";
		}
		else{
			document.f1.id_cm.value=cadena[1];
			document.f1.id_contrato.value=cadena[2];
			document.f1.codigo_cm.value=cadena[3];
			document.f1.marca_cm.value=cadena[4];
			document.f1.modelo_cm.value=cadena[5];
			//document.f1.prov_cm.value=cadena[6];
			document.f1.status_cm.value=cadena[7];
			//document.f1.fecha_act_cm.value=formatdatei(cadena[8]);
			//document.f1.obser_cm.value=cadena[9];
			//document.f1.nota1.value=cadena[10];
			//document.f1.nota2.value=cadena[11];
			//document.f1.nota3.value=cadena[12];
		//	document.f1.agregarcm.value="Modificar";
		}
			break;
			*/
		case "cablemodem":
				
			if(claseGlobal=='act_contrato'){
				document.f1.id_cm.value=cadena[1];
				document.f1.codigo_cm.value=cadena[3];
				document.f1.status_cm.value=cadena[7];
				document.f1.nota1.value=cadena[10];
				document.f1.nota2.value=cadena[11];
				document.f1.agregarcm.value="Modificar";
			}
			else if(claseGlobal=="interfaz_cablemodem"){
				document.f1.id_da.value=cadena[1];
				document.f1.id_contrato.value=cadena[2];
				document.f1.codigo_da.value=cadena[3];
				document.f1.marca_da.value=cadena[4];
				document.f1.modelo_da.value=cadena[5];
				document.f1.status_da.value=cadena[7];
				document.f1.nota1.value=cadena[10];
				document.f1.nota2.value=cadena[11];		
				
				document.f1.serial_deco.value=document.f1.codigo_da.value;
				conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+document.f1.id_contrato.value);
				
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="procesos/datagrid_interfaz_cablemodem.php?serial_deco="+document.f1.serial_deco.value+"&";
				updateTable();
			
			//document.f1.servicio.value=cadena[13];
			
			}
			else if(claseGlobal=='cablemodem'){
				document.f1.id_cm.value=cadena[1];
				document.f1.codigo_cm.value=cadena[3];
				document.f1.status_cm.value=cadena[7];
				
				document.f1.marca_cm.value=cadena[4];
				document.f1.modelo_cm.value=cadena[5];
				document.f1.fecha_act_cm.value=formatdatei(cadena[8]);
				document.f1.obser_cm.value=cadena[9];
				document.f1.nota1.value=cadena[10];
				document.f1.nota2.value=cadena[11];	
				document.f1.nota3.value=cadena[12];	
				document.f1.id_contrato.value=cadena[2];	
				c_id_contrato();	
			}
			break;/*
		case "deco_ana":
			document.f1.id_da.value=cadena[1];
			document.f1.id_contrato.value=cadena[2];
			document.f1.codigo_da.value=cadena[3];
			document.f1.marca_da.value=cadena[4];
			document.f1.modelo_da.value=cadena[5];
			//document.f1.prov_da.value=cadena[6];
			document.f1.tipo_da.value=cadena[7];
			//document.f1.chanmap_da.value=cadena[8];
			//document.f1.punto_da.value=cadena[9];
			document.f1.status_da.value=cadena[10];
			//document.f1.fecha_act_da.value=formatdatei(cadena[11]);
			//document.f1.obser_da.value=cadena[12];
			document.f1.servicio.value=cadena[13];
			//document.f1.nota2.value=cadena[14];
			//document.f1.nota3.value=cadena[15];
			document.f1.agregarda.value="Modificar";
			break;
			*/
		case "info_adic":
			document.f1.id_inf_a.value=cadena[1];
			document.f1.info_a.value=cadena[3];
			document.f1.desc_a.value=cadena[4];
			document.f1.agregar_info_adic.value="MODIFICAR";
			break;
		
		case "promocion":
			//document.f1.dato.value=cadena[1];
			if(claseGlobal=="agregar_promo_contrato"){
				document.f1.fecha_promo.value=formatdatei(cadena[4]);
				document.f1.inicio_promo.value=formatdatei(cadena[5]);
				document.f1.fin_promo.value=formatdatei(cadena[6]);
				document.f1.mes_promo.value=cadena[7];
				document.f1.tipo_promo.value=cadena[8];
				document.f1.descuento_promo.value=cadena[9];
			}
			else{
				document.f1.id_promo.value=cadena[2];
				document.f1.nombre_promo.value=cadena[3];
				document.f1.fecha_promo.value=formatdatei(cadena[4]);
				document.f1.inicio_promo.value=formatdatei(cadena[5]);
				document.f1.fin_promo.value=formatdatei(cadena[6]);
				document.f1.mes_promo.value=cadena[7];
				document.f1.tipo_promo.value=cadena[8];
				document.f1.descuento_promo.value=cadena[9];
				document.f1.login.value=cadena[10];
				traeRadiostatus_promo(cadena[11]);
				conexionPHP('informacion.php',"asignar_promo_serv",id_promo());
			}
			break;
		case "promo_serv":
			document.f1.dato.value=cadena[1];
			document.f1.id_serv.value=cadena[2];
			document.f1.id_promo.value=cadena[3];
			break;
		case "promo_contrato":
			//document.f1.dato.value=cadena[1];
			document.f1.id_promo_con.value=cadena[2];
			document.f1.id_contrato.value=cadena[3];
			document.f1.id_promo.value=cadena[4];
		//	document.f1.inicio_promo.value=formatdatei(cadena[5]);
		//	document.f1.fin_promo.value=formatdatei(cadena[6]);
		//	document.f1.login.value=cadena[7];
			traeRadiostatus_promo_con(cadena[8]);
			conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato());
			cargar_promocion();
			break;
		case "convenio_pago":
			document.f1.dato.value=cadena[1];
			document.f1.id_conv.value=cadena[2];
			document.f1.fecha_conv.value=formatdatei(cadena[3]);
			document.f1.obser_conv.value=cadena[4];
			document.f1.login.value=cadena[5];
		//	document.f1.status_conv.value=cadena[6];
			traeRadiostatus_conv(cadena[6]);
			break;
		case "conv_con":
			document.f1.dato.value=cadena[1];
			document.f1.id_conv_cont.value=cadena[2];
			document.f1.id_conv.value=cadena[3];
			document.f1.id_cont_serv.value=cadena[4];
			document.f1.fecha_ven.value=formatdatei(cadena[5]);
			break;
		case "asigna_recibo":
			document.f1.dato.value=cadena[1];
			document.f1.id_asig.value=cadena[2];
			for(i=0;i<document.f1.id_cobrador.options.length;i++)
			{
				if(document.f1.id_cobrador.options[i].value==cadena[3])
					document.f1.id_cobrador.selectedIndex=i;	
			}
			document.f1.fecha_asig.value=formatdatei(cadena[4]);
			document.f1.obser_asig.value=cadena[5];
			document.f1.login_asig.value=cadena[6];
			document.f1.desde.value=cadena[7];
			document.f1.hasta.value=cadena[8];
			document.f1.cantidad.value=cadena[9];
			break;
		case "recibos":
			document.f1.dato.value=cadena[1];
			document.f1.nro_recibo.value=cadena[2];
			document.f1.id_asig.value=cadena[3];
			document.f1.id_rec.value=cadena[4];
			document.f1.status_pago.value=cadena[5];
			break;
		case "recibe_recibo":
			document.f1.dato.value=cadena[1];
			document.f1.id_rec.value=cadena[2];
			for(i=0;i<document.f1.id_cobrador.options.length;i++)
			{
				if(document.f1.id_cobrador.options[i].value==cadena[3])
					document.f1.id_cobrador.selectedIndex=i;	
			}
			document.f1.fecha_rec.value=formatdatei(cadena[4]);
			document.f1.obser_rec.value=cadena[5];
			document.f1.login_rec.value=cadena[6];
			break;
		case "pagodeposito":
			document.f1.monto_dep.value=cadena[1];
			document.f1.id_pd.value=cadena[2];
			document.f1.id_contrato.value=cadena[3];
			document.f1.fecha_reg.value=formatdatei(cadena[4]);
			document.f1.hora_reg.value=cadena[5];
			document.f1.login_reg.value=cadena[6];
			document.f1.fecha_dep.value=formatdatei(cadena[7]);
			document.f1.banco.value=cadena[8];
			document.f1.numero_ref.value=cadena[9];
			document.f1.fecha_conf.value=formatdatei(cadena[10]);
			document.f1.hora_conf.value=cadena[11];
			document.f1.login_conf.value=cadena[12];
			document.f1.status_pd.value=cadena[13];
			document.f1.fecha_proc.value=formatdatei(cadena[14]);
			traeRadiotipo_dt(cadena[15]);
			document.f1.login_proc.value=cadena[16];
			document.f1.cedula_titular.value=cadena[17];
			document.f1.obser_p.value=cadena[18];
			
			conexionPHP("validarExistencia.php","1=@vista_contrato_todo","id_contrato=@"+id_contrato());
			break;
		case "conf_comision":
			document.f1.dato.value=cadena[1];
			document.f1.pago_comisones.value=cadena[2];
			for(i=0;i<document.f1.id_franq.options.length;i++)
			{
				if(document.f1.id_franq.options[i].value==cadena[3])
					document.f1.id_franq.selectedIndex=i;	
			}
			document.f1.fecha_confc.value=formatdatei(cadena[4]);
			document.f1.status_confc.value=cadena[5];
			document.f1.porc_acord.value=cadena[6];
			document.f1.porc_com_reca.value=cadena[7];
			document.f1.porc_com_venta.value=cadena[8];
			document.f1.porc_ret_iva.value=cadena[9];
			document.f1.porc_ret_islr.value=cadena[10];
			document.f1.descuento_conf.value=cadena[11];
			traeRadiotipo_e_p(cadena[12]);
			document.f1.empresa_confc.value=cadena[13];
			document.f1.rif_empresa.value=cadena[14];
			document.f1.represen_confc.value=cadena[15];
			document.f1.cedula_rep.value=cadena[16];
			document.f1.desc_confc.value=cadena[17];
			break;
		case "pago_comisones":
			document.f1.dato.value=cadena[1];
			document.f1.id_pago_com.value=cadena[2];
			for(i=0;i<document.f1.id_confc.options.length;i++)
			{
				if(document.f1.id_confc.options[i].value==cadena[3])
					document.f1.id_confc.selectedIndex=i;	
			}
			document.f1.nro_comprob.value=cadena[4];
			document.f1.fecha_pc.value=formatdatei(cadena[5]);
			document.f1.p_desde.value=formatdatei(cadena[6]);
			document.f1.p_hasta.value=formatdatei(cadena[7]);
			document.f1.total_cob_sis.value=cadena[8];
			document.f1.por_comision.value=cadena[9];
			document.f1.monto_comision.value=cadena[10];
			document.f1.monto_ret_iva.value=cadena[11];
			document.f1.monto_ret_islr.value=cadena[12];
			document.f1.total_reintegro.value=cadena[13];
			document.f1.monto_desc.value=cadena[14];
			document.f1.total_deposito.value=cadena[15];
			document.f1.realizado_por.value=cadena[16];
			document.f1.registrado_por.value=cadena[17];
			document.f1.pagado_por.value=cadena[18];
			document.f1.status_pago_com.value=cadena[19];
			break;
		case "servidor":
			document.f1.database.value=cadena[1];
			document.f1.id_servidor.value=cadena[2];
			document.f1.nombre_servidor.value=cadena[3];
			document.f1.direc_servidor.value=cadena[4];
			traeRadiostatus_servidor(cadena[5]);
			traeRadiosincronizar(cadena[6]);
			traeRadiostatus_ser(cadena[7]);
			document.f1.direccio_ip.value=cadena[8];
			document.f1.usuario_p.value=cadena[9];
			document.f1.clave_p.value=cadena[10];
			break;
		case "inicial_id":
			document.f1.dato.value=cadena[1];
			document.f1.id_inicial_id.value=cadena[2];
			for(i=0;i<document.f1.id_servidor.options.length;i++)
			{
				if(document.f1.id_servidor.options[i].value==cadena[3])
					document.f1.id_servidor.selectedIndex=i;	
			}
			document.f1.inicial.value=cadena[4];
			document.f1.status.value=cadena[5];
			break;
		case "sincronizacion_servi":
			document.f1.dato.value=cadena[1];
			document.f1.id_sinc.value=cadena[2];
			for(i=0;i<document.f1.id_servidor.options.length;i++)
			{
				if(document.f1.id_servidor.options[i].value==cadena[3])
					document.f1.id_servidor.selectedIndex=i;	
			}
			document.f1.fecha_sinc.value=formatdatei(cadena[4]);
			document.f1.hora_sin.value=cadena[5];
			document.f1.oid_inicial.value=cadena[6];
			document.f1.oid_final.value=cadena[7];
			document.f1.status_sinc.value=cadena[8];
			break;
		case "descuento_pronto_pag":
			document.f1.dato.value=cadena[1];
			document.f1.id_dpp.value=cadena[2];
			for(i=0;i<document.f1.id_franq.options.length;i++)
			{
				if(document.f1.id_franq.options[i].value==cadena[3])
					document.f1.id_franq.selectedIndex=i;	
			}
			for(i=0;i<document.f1.dia_dpp.options.length;i++)
			{
				if(document.f1.dia_dpp.options[i].value==cadena[4])
					document.f1.dia_dpp.selectedIndex=i;	
			}
			document.f1.monto_dpp.value=cadena[5];
			asignarCheck(cadena[6]);
			traeRadiostatus_dpp(cadena[7]);
			document.f1.obser_dpp.value=cadena[8];
			break;
		case "orden_tabla_cortes":
			document.f1.dato.value=cadena[1];
			document.f1.id_tc.value=cadena[2];
			document.f1.id_orden.value=cadena[3];
			break;
		case "tabla_cortes":
			document.f1.dato.value=cadena[1];
			document.f1.id_tc.value=cadena[2];
			for(i=0;i<document.f1.id_franq.options.length;i++)
			{
				if(document.f1.id_franq.options[i].value==cadena[3])
					document.f1.id_franq.selectedIndex=i;	
			}
			document.f1.fecha_tc.value=formatdatei(cadena[4]);
			document.f1.id_gt.value=formatdatei(cadena[5]);
			document.f1.obser_tc.value=cadena[6];
			traeRadiostatus_tc(cadena[7]);
			break;
		case "cuenta_bancos":
			document.f1.dato.value=cadena[1];
			document.f1.id_cb.value=cadena[2];
			for(i=0;i<document.f1.banco.options.length;i++)
			{
				if(document.f1.banco.options[i].value==cadena[3])
					document.f1.banco.selectedIndex=i;	
			}
			document.f1.fecha_cb.value=formatdatei(cadena[4]);
			for(i=0;i<document.f1.tipo_db.options.length;i++)
			{
				if(document.f1.tipo_db.options[i].value==cadena[5])
					document.f1.tipo_db.selectedIndex=i;	
			}
			document.f1.referencia_db.value=cadena[6];
			document.f1.monto_db.value=cadena[7];
			document.f1.descrip_db.value=cadena[8];
			document.f1.status_db.value=cadena[9];
			for(i=0;i<document.f1.tipo_cb.options.length;i++)
			{
				if(document.f1.tipo_cb.options[i].value==cadena[10])
					document.f1.tipo_cb.selectedIndex=i;	
			}
			document.f1.relacion_cb.value=cadena[11];
			document.f1.login_conf.value=cadena[12];
			document.f1.fecha_reg.value=formatdatei(cadena[13]);
			break;
		case "conciliacion_pago":
			document.f1.dato.value=cadena[1];
			document.f1.id_conc.value=cadena[2];
			for(i=0;i<document.f1.id_franq.options.length;i++)
			{
				if(document.f1.id_franq.options[i].value==cadena[3])
					document.f1.id_franq.selectedIndex=i;	
			}
			document.f1.fecha_conc.value=formatdatei(cadena[4]);
			for(i=0;i<document.f1.banco.options.length;i++)
			{
				if(document.f1.banco.options[i].value==cadena[5])
					document.f1.banco.selectedIndex=i;	
			}
			document.f1.refer_conc.value=cadena[6];
			document.f1.monto_conc.value=cadena[7];
			document.f1.status_conc.value=cadena[8];
			document.f1.login_conc.value=cadena[9];
			document.f1.obser_conc.value=cadena[10];
			break;
		case "asigna_llamada":
			document.f1.dato.value=cadena[1];
			document.f1.id_all.value=cadena[2];
			document.f1.ubica_all.value=cadena[3];
			document.f1.fecha_all.value=formatdatei(cadena[4]);
			document.f1.login_enc.value=cadena[5];
			document.f1.login_resp.value=cadena[6];
			document.f1.obser_all.value=cadena[7];
			document.f1.status_all.value=cadena[8];
			break;
		case "asig_lla_cli":
			document.f1.dato.value=cadena[1];
			document.f1.id_lc.value=cadena[2];
			document.f1.id_all.value=cadena[3];
			document.f1.id_contrato.value=cadena[4];
			document.f1.id_lla.value=cadena[5];
			document.f1.status_lc.value=cadena[6];
			break;
		case "tipo_llamada":
			document.f1.dato.value=cadena[1];
			document.f1.id_tll.value=cadena[2];
			document.f1.nombre_tll.value=cadena[3];
			traeRadiostatus_tll(cadena[4]);
			break;
		case "llamadas":
			document.f1.dato.value=cadena[1];
			document.f1.id_lla.value=cadena[2];
			for(i=0;i<document.f1.id_drl.options.length;i++)
			{
				if(document.f1.id_drl.options[i].value==cadena[3])
					document.f1.id_drl.selectedIndex=i;	
			}
			for(i=0;i<document.f1.id_tll.options.length;i++)
			{
				if(document.f1.id_tll.options[i].value==cadena[4])
					document.f1.id_tll.selectedIndex=i;	
			}
			document.f1.id_contrato.value=cadena[5];
			document.f1.fecha_lla.value=formatdatei(cadena[6]);
			document.f1.hora_lla.value=cadena[7];
			document.f1.login.value=cadena[8];
			document.f1.obser_lla.value=cadena[9];
			traeRadiocrea_alarma(cadena[10]);
			conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato());
			break;
		case "detalle_resp":
			document.f1.dato.value=cadena[1];
			document.f1.id_drl.value=cadena[2];
			for(i=0;i<document.f1.id_trl.options.length;i++)
			{
				if(document.f1.id_trl.options[i].value==cadena[3])
					document.f1.id_trl.selectedIndex=i;	
			}
			document.f1.nombre_drl.value=cadena[4];
			traeRadiostatus_drl(cadena[5]);
			break;
		case "tipo_resp":
			document.f1.dato.value=cadena[1];
			document.f1.id_trl.value=cadena[2];
			document.f1.nombre_trl.value=cadena[3];
			traeRadiostatus_trl(cadena[4]);
			break;
		
		case "deco_ana":
			if(claseGlobal=="deco_ana"){
				document.f1.id_da.value=cadena[1];
			document.f1.id_contrato.value=cadena[2];
			document.f1.codigo_da.value=cadena[3];
			document.f1.marca_da.value=cadena[4];
			document.f1.modelo_da.value=cadena[5];
			//document.f1.prov_da.value=cadena[6];
			document.f1.tipo_da.value=cadena[7];
			//document.f1.chanmap_da.value=cadena[8];
			//document.f1.punto_da.value=cadena[9];
			document.f1.status_da.value=cadena[10];
			//document.f1.fecha_act_da.value=formatdatei(cadena[11]);
			document.f1.obser_da.value=cadena[12];
			
			document.f1.servicio.value=cadena[13];
			//document.f1.nota2.value=cadena[14];
			//document.f1.nota3.value=cadena[15];
			//document.f1.agregarda.value="Modificar";
			}
			else if(claseGlobal=="interfazacc"){
				document.f1.id_da.value=cadena[1];
				document.f1.id_contrato.value=cadena[2];
				document.f1.codigo_da.value=cadena[3];
				document.f1.marca_da.value=cadena[4];
				document.f1.modelo_da.value=cadena[5];
				document.f1.tipo_da.value=cadena[7];
				document.f1.status_da.value=cadena[10];
				
				document.f1.serial_deco.value=document.f1.codigo_da.value;
				conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+document.f1.id_contrato.value);
				
				divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
				archivoDataGrid="procesos/datagrid_interfazacc.php?serial_deco="+document.f1.serial_deco.value+"&";
				updateTable();
			
			//document.f1.servicio.value=cadena[13];
			}
			else{
			document.f1.id_da.value=cadena[1];
		//	document.f1.id_contrato.value=cadena[2];
			document.f1.codigo_da.value=cadena[3];
			document.f1.marca_da.value=cadena[4];
			document.f1.modelo_da.value=cadena[5];
			//document.f1.prov_da.value=cadena[6];
			document.f1.tipo_da.value=cadena[7];
			//document.f1.chanmap_da.value=cadena[8];
			document.f1.punto_da.value=cadena[9];
			document.f1.status_da.value=cadena[10];
			//document.f1.fecha_act_da.value=formatdatei(cadena[11]);
			//document.f1.obser_da.value=cadena[12];
			document.f1.servicio.value=cadena[13];
			//document.f1.nota2.value=cadena[14];
			//document.f1.nota3.value=cadena[15];
			document.f1.agregarda.value="Modificar";
			}
			break;
		case "marca":
			document.f1.dato.value=cadena[1];
			document.f1.id_marca.value=cadena[2];
			document.f1.nombre_marca.value=cadena[3];
			traeRadiostatus_marca(cadena[4]);
			break;
		case "deco_servicio":
			document.f1.dato.value=cadena[1];
			document.f1.id_cont_serv.value=cadena[2];
			document.f1.id_da.value=cadena[3];
			break;
		case "interfazacc":
			document.f1.id_accquery.value=cadena[1];
			document.f1.serial_deco.value=cadena[2];
			document.f1.comando_acc.value=cadena[3];
			traeRadiostatus_accquery(cadena[4]);
			document.f1.fecha_accquery.value=formatdatei(cadena[5]);
			break;
		case "interfaz_cablemodem":
			document.f1.id_accquery.value=cadena[1];
			document.f1.serial_deco.value=cadena[2];
			document.f1.comando_acc.value=cadena[3];
			traeRadiostatus_accquery(cadena[4]);
			document.f1.fecha_accquery.value=formatdatei(cadena[5]);
			break;
		case "modelo":
			document.f1.dato.value=cadena[1];
			document.f1.id_modelo.value=cadena[2];
			for(i=0;i<document.f1.id_marca.options.length;i++)
			{
				if(document.f1.id_marca.options[i].value==cadena[3])
					document.f1.id_marca.selectedIndex=i;	
			}
			document.f1.nombre_modelo.value=cadena[4];
			for(i=0;i<document.f1.id_tse.options.length;i++)
			{
				if(document.f1.id_tse.options[i].value==cadena[5])
					document.f1.id_tse.selectedIndex=i;	
			}
			traeRadiostatus_modelo(cadena[6]);
			break;
		
		case "detalle_tipopago_df":
			//document.f1.dato.value=cadena[1];
			document.f1.id_dbf.value=cadena[1];
			for(i=0;i<document.f1.id_tipo_pago.options.length;i++)
			{
				if(document.f1.id_tipo_pago.options[i].value==cadena[2])
					document.f1.id_tipo_pago.selectedIndex=i;	
			}
			for(i=0;i<document.f1.id_cuba.options.length;i++)
			{
				if(document.f1.id_cuba.options[i].value==cadena[3])
					document.f1.id_cuba.selectedIndex=i;	
			}
			for(i=0;i<document.f1.id_df_tp.options.length;i++)
			{
				if(document.f1.id_df_tp.options[i].value==cadena[4])
					document.f1.id_df_tp.selectedIndex=i;	
			}
			document.f1.fecha_dbf.value=formatdatei(cadena[5]);
			document.f1.refer_dbf.value=cadena[6];
			document.f1.monto_dbf.value=cadena[7];
			document.f1.obser_dbf.value=cadena[8];
			document.f1.status_dbf.value=cadena[9];
			document.f1.hora_dbf.value=cadena[10];
			document.f1.login_dbf.value=cadena[11];
			break;
		case "carga_tabla_banco":
			//document.f1.dato.value=cadena[1];
			document.f1.id_ctb.value=cadena[1];
			for(i=0;i<document.f1.id_cuba.options.length;i++)
			{
				if(document.f1.id_cuba.options[i].value==cadena[2])
					document.f1.id_cuba.selectedIndex=i;	
			}
			document.f1.fecha_ctb.value=formatdatei(cadena[3]);
			document.f1.hora_ctb.value=cadena[4];
			document.f1.login_ctb.value=cadena[5];
			document.f1.fecha_desde_ctb.value=formatdatei(cadena[6]);
			document.f1.fecha_hasta_ctb.value=formatdatei(cadena[7]);
			document.f1.status_ctb.value=cadena[8];
			document.f1.formato_ctb.value=cadena[9];
			break;
		case "tabla_bancos":
			//document.f1.dato.value=cadena[1];
			document.f1.id_tb.value=cadena[1];
			document.f1.id_ctb.value=cadena[2];
			document.f1.fecha_tb.value=formatdatei(cadena[3]);
			document.f1.tipo_tb.value=cadena[4];
			document.f1.referencia_tb.value=cadena[5];
			document.f1.monto_tb.value=cadena[6];
			document.f1.descrip_tb.value=cadena[7];
			document.f1.status_tb.value=cadena[8];
			break;
		case "tipo_pago_df":
			//document.f1.dato.value=cadena[1];
			document.f1.id_tipo_pago.value=cadena[1];
			document.f1.tipo_pago.value=cadena[2];
			for(i=0;i<document.f1.tipo_tp.options.length;i++)
			{
				if(document.f1.tipo_tp.options[i].value==cadena[3])
					document.f1.tipo_tp.selectedIndex=i;	
			}
			traeRadiostatus_pago(cadena[4]);
			break;
		case "cuenta_bancaria":
			document.f1.id_cuba.value=cadena[1];
			document.f1.numero_cuba.value=cadena[2];
			document.f1.banco_cuba.value=cadena[3];
			document.f1.abrev_cuba.value=cadena[4];
			document.f1.desc_cuba.value=cadena[5];
			traeRadiostatus_cuba(cadena[6]);
			traeRadioconc_cliente(cadena[7]);
			traeRadioconc_franq(cadena[8]);
			document.f1.formato_archivo.value=cadena[9];
			document.f1.comision_pv.value=cadena[10];
			document.f1.comision_pv_c.value=cadena[11];
			//alert(cadena[5]);
			//traeRadiotipo_caja(cadena[6]);
			break;
		default:
			//alerta("ERROR, no esiste la Tabla"+tabla); 
	}
}
function limpiarcm(){
			document.f1.codigo_cm.value='';
			document.f1.marca_cm.value=0;
			document.f1.modelo_cm.value=0;
			document.f1.status_cm.value=0;
			document.f1.agregarcm.value="Agregar";
}
function limpiarda(){
			document.f1.codigo_da.value='';
			document.f1.marca_da.value=0;
			document.f1.modelo_da.value=0;
			document.f1.tipo_da.value=0;
			document.f1.status_da.value=0;
			document.f1.servicio.value='';
			document.f1.agregarda.value="Agregar";
}
function limpiarMat(){
		
			var num=document.f1.numero_mat.value;
			document.f1.reset();
			document.f1.id_mat.value=codGlobal;
			document.f1.numero_mat.value=num;
}
function limpiarCli(){
			var ced=document.f1.cedula.value;
			var tipo_cliente=document.f1.tipo_cliente.value;
			var inicial_doc=document.f1.inicial_doc.value;
			document.f1.reset();
			document.f1.cli_id_persona.value=codGlobal;
			document.f1.cedula.value=ced;
			document.f1.tipo_cliente.value=tipo_cliente;
			document.f1.inicial_doc.value=inicial_doc;
}
function limpiarPer(){
			var ced=document.f1.cedula.value;
			document.f1.reset();
			document.f1.id_persona.value=codGlobal;
			document.f1.cedula.value=ced;
			boton(false,true,true,claseGlobal);
}
function limpiarPagoCon(){
			
			var ced=document.f1.cedula.value;
			document.f1.reset();
			document.f1.cli_id_persona.value=codGlobal;
			document.f1.cedula.value=ced;
}
function limpiarDatosCon(){
				document.f1.id_contrato.value='';
				document.f1.nro_contrato.value='';
				
				document.f1.cedula.value='';
				document.f1.nombre.value='';
				document.f1.apellido.value='';
				document.f1.telefono.value='';
}
//para selecionar y deseleccionar todos los checkbox
function asignaCheck(i){
	if(document.f1.modulo[i].checked==true)
	{
		document.f1.modulo[i+1].checked=1
		document.f1.modulo[i+2].checked=1
		document.f1.modulo[i+3].checked=1
	}
	else
	{
		document.f1.modulo[i+1].checked=0
		document.f1.modulo[i+2].checked=0
		document.f1.modulo[i+3].checked=0
	}
}
//dependiendo si esta seleccionado o no llama a un metodo
function seleccionCheck(){
	if(document.f1.seleccion.checked == true)
	{
		seleccionarTodo();
	}
	else{
		deseleccionarTodo();
	}
}
//deselecciona todos los chek del campo modulo
function deseleccionarTodo(){
   for (i=0;i<document.f1.modulo.length;i++)
      if(document.f1.modulo[i].type == "checkbox")
         document.f1.modulo[i].checked=0
} 
function deseleccionar_todo_check(){
   for (i=0;i<document.f1.checkbox.length;i++)
      if(document.f1.checkbox[i].type == "checkbox")
         document.f1.checkbox[i].checked=0
} 
//selecciona todos los chek del campo modulo
function seleccionarTodo(){
   for (i=0;i<document.f1.modulo.length;i++)
      if(document.f1.modulo[i].type == "checkbox")
         document.f1.modulo[i].checked=1
}
//asigna todos los modulos y sus privilegios a un perfil
function asignarModulo(cadena)
{
		deseleccionar_todo();
			cade=cadena.split("=@");
			tam=cade.length-1;
			tam1=document.f1.modulo.length;
			var i=0,j=0;
			for(i=0;i<tam;i++){
				ca=cade[i].split(",");
				for(j=0;j<tam1;j++){
					if(trim(document.f1.modulo[j].value)==trim(ca[0])){
						document.f1.modulo[j].checked=1;
						if('TRUE'==ca[1]){
							document.f1.modulo[j+1].checked=1;
						}
						if('TRUE'==ca[2]){
							document.f1.modulo[j+2].checked=1;
						}
						if('TRUE'==ca[3]){
							document.f1.modulo[j+3].checked=1;
						}
					}
				}
			}
}
//activa los check dependiendo de los privilegios
function asignarCheck(cadena)
{
		deseleccionar_todo();
			cade=cadena.split(";");
			tam=cade.length-1;
			
			var i=0,j=0;
			for(i=0;i<tam;i++){
				for(j=0;j<document.f1.elements.length;j++){
					if(document.f1.elements[j].type == "checkbox"){
						if(trim(document.f1.elements[j].value)==cade[i]){
							document.f1.elements[j].click();
						}
					
					}
				}
			}	
}
//funcion deseleccionar todos los check de cualquier elemento
function deseleccionar_todo(){
   for (i=0;i<document.f1.elements.length;i++)
      if(document.f1.elements[i].type == "checkbox")
         document.f1.elements[i].checked=0
}
//para saber si un estatus esta activo o inactivo
function estatus(cadena)
{
	if(cadena=="Inactivo")								
		document.f1.status[1].click();	
	else					
		document.f1.status[0].checked;
}
//para saber que radio de un elemento esta activo o inactivo
function radio(cadena)
{
	for (i=0;i<document.f1.elements.length;i++){
		if(document.f1.elements[i].type == "radio"){
			if(cadena==document.f1.elements[i].value)								
				document.f1.elements[i].click();
		}
	}
}
//para retornar el valor seleccionado de un radio
function verRadio()
{
	for (i=0;i<document.f1.elements.length;i++){
		if(document.f1.elements[i].type == "radio"){
			if(document.f1.elements[i].checked)								
				return document.f1.elements[i].value;
		}
	}
}
function PermisionFormulario(clase)
{
		for(i=0;i<dato.length;i++)
		{
			if(dato[i][1]==clase){
				if (dato[i][2] == 'true')
					document.f1.registrar.disabled =false;
				else
					document.f1.registrar.disabled =true;
				if (dato[i][3] == 'true')
					document.f1.modificar.disabled =false;
				else
					document.f1.modificar.disabled =true;
				if (dato[i][4] == 'true')
					document.f1.eliminar.disabled =false;
				else
					document.f1.eliminar.disabled =true;
				break;
			}
		}
}
//para ver si un Status esta activo o inactivo
function verStatus(){
	if (document.f1.status[0].checked)
		return document.f1.status[0].value;
	else
		return document.f1.status[1].value;
}
function verdatagrip(){
	if(document.f1.datagrid.checked == true)
		return 'true';
	else 
		return 'false';
}
function traeRadiostatus(cadena)
{
	for (i=0;i<document.f1.status.length;i++){
			if(cadena==document.f1.status[i].value)								
				document.f1.status[i].click();
	}
}
function verRadiostatus()
{
	for (i=0;i<document.f1.status.length;i++){
			if(document.f1.status[i].checked)								
				return document.f1.status[i].value;
	}
}
function traeRadiosexo(cadena)
{
	for (i=0;i<document.f1.sexo.length;i++){
			if(cadena==document.f1.sexo[i].value)								
				document.f1.sexo[i].click();
	}
}
function verRadiosexo()
{
	for (i=0;i<document.f1.sexo.length;i++){
			if(document.f1.sexo[i].checked)								
				return document.f1.sexo[i].value;
	}
}

//para mostrar datos de tiempo en el div 'tiempo'
//ejemplo 'Lunes 17 de Agosto de 2009 - 11:29:38 AM'
function muestraReloj()
{
//arreglo de los meses
var monthNames = new makeArray(12);
monthNames[0] = "Enero";
monthNames[1] = "Febrero";
monthNames[2] = "Marzo";
monthNames[3] = "Abril";
monthNames[4] = "Mayo";
monthNames[5] = "Junio";
monthNames[6] = "Julio";
monthNames[7] = "Agosto";
monthNames[8] = "Septiembre";
monthNames[9] = "Octubre";
monthNames[10] = "Noviembre";
monthNames[11] = "Diciembre";

// Arreglo de los días

var dayNames = new makeArray(7);
dayNames[0] = "Domingo";
dayNames[1] = "Lunes";
dayNames[2] = "Martes";
dayNames[3] = "Mi&eacute;rcoles";
dayNames[4] = "Jueves";
dayNames[5] = "Viernes";
dayNames[6] = "S&aacute;bado";

var now = new Date();
var year = now.getYear();

if (year < 2000) year = year + 1900;


function makeArray(len)
{
for (var i = 0; i < len; i++) this[i] = null;
this.length = len;
}

// Compruebo si se puede ejecutar el script en el navegador del usuario
if (!document.layers && !document.all && !document.getElementById) return;
// Obtengo la hora actual y la divido en sus partes
var fechacompleta = new Date();
var horas = fechacompleta.getHours();
var minutos = fechacompleta.getMinutes();
var segundos = fechacompleta.getSeconds();
var mt = "AM";
// Pongo el formato 12 horas
if (horas > 12) {
mt = "PM";
horas = horas - 12;
}
if (horas == 0) horas = 12;
// Pongo minutos y segundos con dos dígitos
if (minutos <= 9) minutos = "0" + minutos;
if (segundos <= 9) segundos = "0" + segundos;
// En la variable 'cadenareloj' puedes cambiar los colores y el tipo de fuente
cadenareloj = dayNames[now.getDay()] + " " + now.getDate() + " de " + monthNames[now.getMonth()] + " " +" de " + year +"  -  "+ horas + ":" + minutos + ":" + segundos + " " + mt;
// Escribo el reloj de una manera u otra, según el navegador del usuario
if (document.layers) {
document.layers.tiempo.document.write(cadenareloj);
document.layers.tiempo.document.close();
}
else if (document.all) tiempo.innerHTML = cadenareloj;
else if (document.getElementById) document.getElementById("tiempo").innerHTML = '<div ></div>'+cadenareloj;
// Ejecuto la función con un intervalo de un segundo
setTimeout("muestraReloj()", 1000);
}
function traeRadioSexo(cadena)
{
	for (i=0;i<document.f1.Sexo.length;i++){
			if(cadena==document.f1.Sexo[i].value)								
				document.f1.Sexo[i].click();
	}
}
function verRadioSexo()
{
	for (i=0;i<document.f1.Sexo.length;i++){
			if(document.f1.Sexo[i].checked)								
				return document.f1.Sexo[i].value;
	}
}
function traeRadiosexo(cadena)
{
	for (i=0;i<document.f1.sexo.length;i++){
			if(cadena==document.f1.sexo[i].value)								
				document.f1.sexo[i].click();
	}
}
function verRadiosexo()
{
	for (i=0;i<document.f1.sexo.length;i++){
			if(document.f1.sexo[i].checked)								
				return document.f1.sexo[i].value;
	}
}
function quitaDato(cade)
{
	cade= '=@'+cade;
	var cadena= cade.split("=@");
	for(i=0;i<cadena.length;i++){cadena[i]=trim(cadena[i]);}
	return cadena;
}
function strstr (haystack, needle, bool) {
    haystack += '';
    pos = haystack.indexOf( needle );    if (pos == -1) {
        return false;
    } else{
        if (bool){
            return haystack.substr( 0, pos );        } else{
            return haystack.slice( pos );
        }
    }
}
function traeRadiostatus_servicio(cadena)
{
	for (i=0;i<document.f1.status_servicio.length;i++){
			if(cadena==document.f1.status_servicio[i].value)								
				document.f1.status_servicio[i].click();
	}
}
function verRadiostatus_servicio()
{
	for (i=0;i<document.f1.status_servicio.length;i++){
			if(document.f1.status_servicio[i].checked)								
				return document.f1.status_servicio[i].value;
	}
}
function traeRadiostatus_grupo(cadena)
{
	for (i=0;i<document.f1.status_grupo.length;i++){
			if(cadena==document.f1.status_grupo[i].value)								
				document.f1.status_grupo[i].click();
	}
}
function verRadiostatus_grupo()
{
	for (i=0;i<document.f1.status_grupo.length;i++){
			if(document.f1.status_grupo[i].checked)								
				return document.f1.status_grupo[i].value;
	}
}
function traeRadiostatus_serv(cadena)
{
	for (i=0;i<document.f1.status_serv.length;i++){
			if(cadena==document.f1.status_serv[i].value)								
				document.f1.status_serv[i].click();
	}
}
function verRadiostatus_serv()
{
	for (i=0;i<document.f1.status_serv.length;i++){
			if(document.f1.status_serv[i].checked)								
				return document.f1.status_serv[i].value;
	}
}
function traeRadiostatus_tarifa_ser(cadena)
{
	for (i=0;i<document.f1.status_tarifa_ser.length;i++){
			if(cadena==document.f1.status_tarifa_ser[i].value)								
				document.f1.status_tarifa_ser[i].click();
	}
}
function verRadiostatus_tarifa_ser()
{
	for (i=0;i<document.f1.status_tarifa_ser.length;i++){
			if(document.f1.status_tarifa_ser[i].checked)								
				return document.f1.status_tarifa_ser[i].value;
	}
}
function traeRadioPago(cadena)
{
	for (i=0;i<document.f1.Pago.length;i++){
			if(cadena==document.f1.Pago[i].value)								
				document.f1.Pago[i].click();
	}
}
function verRadioPago()
{
	for (i=0;i<document.f1.Pago.length;i++){
			if(document.f1.Pago[i].checked)								
				return document.f1.Pago[i].value;
	}
}
function traeRadiostatus_pago(cadena)
{
	for (i=0;i<document.f1.status_pago.length;i++){
			if(cadena==document.f1.status_pago[i].value)								
				document.f1.status_pago[i].click();
	}
}
function verRadiostatus_pago()
{
	for (i=0;i<document.f1.status_pago.length;i++){
			if(document.f1.status_pago[i].checked)								
				return document.f1.status_pago[i].value;
	}
}
function traeRadiostatus_caja(cadena)
{
	for (i=0;i<document.f1.status_caja.length;i++){
			if(cadena==document.f1.status_caja[i].value)								
				document.f1.status_caja[i].checked=true;
	}
}
function verRadiostatus_caja()
{
	for (i=0;i<document.f1.status_caja.length;i++){
			if(document.f1.status_caja[i].checked)								
				return document.f1.status_caja[i].value;
	}
}
function traeRadiotipo_caja(cadena)
{
	for (i=0;i<document.f1.tipo_caja.length;i++){
			if(cadena==document.f1.tipo_caja[i].value)								
				document.f1.tipo_caja[i].checked=true;
	}
}
function verRadiotipo_caja()
{
	for (i=0;i<document.f1.tipo_caja.length;i++){
			if(document.f1.tipo_caja[i].checked)								
				return document.f1.tipo_caja[i].value;
	}
}
function traeRadiotipo_rec(cadena)
{
	for (i=0;i<document.f1.tipo_rec.length;i++){
			if(cadena==document.f1.tipo_rec[i].value)								
				document.f1.tipo_rec[i].click();
	}
}
function verRadiotipo_rec()
{
	for (i=0;i<document.f1.tipo_rec.length;i++){
			if(document.f1.tipo_rec[i].checked)								
				return document.f1.tipo_rec[i].value;
	}
}
function traeRadiostatus_comen(cadena)
{
	for (i=0;i<document.f1.status_comen.length;i++){
			if(cadena==document.f1.status_comen[i].value)								
				document.f1.status_comen[i].click();
	}
}
function verRadiostatus_comen()
{
	for (i=0;i<document.f1.status_comen.length;i++){
			if(document.f1.status_comen[i].checked)								
				return document.f1.status_comen[i].value;
	}
}
function traeRadiocomi_para(cadena)
{
	for (i=0;i<document.f1.comi_para.length;i++){
			if(cadena==document.f1.comi_para[i].value)								
				document.f1.comi_para[i].click();
	}
}
function verRadiocomi_para()
{
	for (i=0;i<document.f1.comi_para.length;i++){
			if(document.f1.comi_para[i].checked)								
				return document.f1.comi_para[i].value;
	}
}

function traeRadiotipo_costo(cadena)
{
	for (i=0;i<document.f1.tipo_costo.length;i++){
			if(cadena==document.f1.tipo_costo[i].value)								
				document.f1.tipo_costo[i].click();
	}
}
function verRadiotipo_costo()
{
	for (i=0;i<document.f1.tipo_costo.length;i++){
			if(document.f1.tipo_costo[i].checked)								
				return document.f1.tipo_costo[i].value;
	}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function asignar_tecnico(cadena)
{
		deseleccionarTodo_tec();
			cade=cadena.split("=@");
			tam=cade.length;
			tam1=document.f1.checkbox.length;
			document.f1.checkbox[0].disabled=true;
			for(i=1;i<tam;i++){
				
				for(j=1;j<tam1;j++){
					if(trim(document.f1.checkbox[j].value)==trim(cade[i])){
						document.f1.checkbox[j].checked=1;
					}
						document.f1.checkbox[j].disabled=true;
				}
			
			}	
}

function asignar_ubi_grupo(cadena)
{
		deseleccionarTodo_gru();
		
			cade=cadena.split("=@");
			tam=cade.length;
			tam1=document.f1.checkbox_gu.length;
			for(i=1;i<tam;i++){
				
				for(j=1;j<tam1;j++){
					if(trim(document.f1.checkbox_gu[j].value)==trim(cade[i])){
						document.f1.checkbox_gu[j].checked=1;
					}
				}
			}	
}

function trae_tec_gru_disable(cadena)
{
			cade=cadena.split("=@");
			tam=cade.length;
			tam1=document.f1.checkbox.length;
			for(i=1;i<tam;i++){
				for(j=1;j<tam1;j++){
					if(trim(document.f1.checkbox[j].value)==trim(cade[i])){
						document.f1.checkbox[0].disabled=true;
						document.f1.checkbox[j].disabled=true;
					}
				}
			}	
}

function trae_ubi_gru_disable(cadena)
{
			cade=cadena.split("=@");
			tam=cade.length;
			tam1=document.f1.checkbox_gu.length;
			document.f1.checkbox_gu[0].disabled=true;
			for(i=1;i<tam;i++){
				
				for(j=1;j<tam1;j++){
					if(trim(document.f1.checkbox_gu[j].value)==trim(cade[i])){
						document.f1.checkbox_gu[j].disabled=true;
					}
				}
			}	
}

function deseleccionarTodo_tec(){
   for (i=0;i<document.f1.checkbox.length;i++)
      if(document.f1.checkbox[i].type == "checkbox")
         document.f1.checkbox[i].checked=0
} 

function deseleccionarTodo_gru(){
   for (i=0;i<document.f1.checkbox_gu.length;i++)
      if(document.f1.checkbox_gu[i].type == "checkbox")
         document.f1.checkbox_gu[i].checked=0
} 

function traeRadioenvio_sms(cadena)
{
	for (i=0;i<document.f1.envio_sms.length;i++){
			if(cadena==document.f1.envio_sms[i].value)								
				document.f1.envio_sms[i].click();
	}
}
function verRadioenvio_sms()
{
	for (i=0;i<document.f1.envio_sms.length;i++){
			if(document.f1.envio_sms[i].checked)								
				return document.f1.envio_sms[i].value;
	}
}
function traeRadioenvio_email(cadena)
{
	for (i=0;i<document.f1.envio_email.length;i++){
			if(cadena==document.f1.envio_email[i].value)								
				document.f1.envio_email[i].click();
	}
}
function verRadioenvio_email()
{
	for (i=0;i<document.f1.envio_email.length;i++){
			if(document.f1.envio_email[i].checked)								
				return document.f1.envio_email[i].value;
	}
}

function traeRadiostatus_com(cadena)
{
	for (i=0;i<document.f1.status_com.length;i++){
			if(cadena==document.f1.status_com[i].value)								
				document.f1.status_com[i].click();
	}
}
function verRadiostatus_com()
{
	for (i=0;i<document.f1.status_com.length;i++){
			if(document.f1.status_com[i].checked)								
				return document.f1.status_com[i].value;
	}
}

function traeRadiostatus_var(cadena)
{
	for (i=0;i<document.f1.status_var.length;i++){
			if(cadena==document.f1.status_var[i].value)								
				document.f1.status_var[i].click();
	}
}
function verRadiostatus_var()
{
	for (i=0;i<document.f1.status_var.length;i++){
			if(document.f1.status_var[i].checked)								
				return document.f1.status_var[i].value;
	}
}
function traeRadiostatus_form(cadena)
{
	for (i=0;i<document.f1.status_form.length;i++){
			if(cadena==document.f1.status_form[i].value)								
				document.f1.status_form[i].click();
	}
}
function verRadiostatus_form()
{
	for (i=0;i<document.f1.status_form.length;i++){
			if(document.f1.status_form[i].checked)								
				return document.f1.status_form[i].value;
	}
}
function traeRadioper_telf_fijo(cadena)
{
	for (i=0;i<document.f1.per_telf_fijo.length;i++){
			if(cadena==document.f1.per_telf_fijo[i].value)								
				document.f1.per_telf_fijo[i].click();
	}
}
function verRadioper_telf_fijo()
{
	for (i=0;i<document.f1.per_telf_fijo.length;i++){
			if(document.f1.per_telf_fijo[i].checked)								
				return document.f1.per_telf_fijo[i].value;
	}
}
function traeRadioenv_todos_telf(cadena)
{
	for (i=0;i<document.f1.env_todos_telf.length;i++){
			if(cadena==document.f1.env_todos_telf[i].value)								
				document.f1.env_todos_telf[i].click();
	}
}
function verRadioenv_todos_telf()
{
	for (i=0;i<document.f1.env_todos_telf.length;i++){
			if(document.f1.env_todos_telf[i].checked)								
				return document.f1.env_todos_telf[i].value;
	}
}
function traeRadioact_resp_aut(cadena)
{
	for (i=0;i<document.f1.act_resp_aut.length;i++){
			if(cadena==document.f1.act_resp_aut[i].value)								
				document.f1.act_resp_aut[i].click();
	}
}
function verRadioact_resp_aut()
{
	for (i=0;i<document.f1.act_resp_aut.length;i++){
			if(document.f1.act_resp_aut[i].checked)								
				return document.f1.act_resp_aut[i].value;
	}
}
function traeRadiosattus_gerente(cadena)
{
	for (i=0;i<document.f1.sattus_gerente.length;i++){
			if(cadena==document.f1.sattus_gerente[i].value)								
				document.f1.sattus_gerente[i].click();
	}
}
function verRadiosattus_gerente()
{
	for (i=0;i<document.f1.sattus_gerente.length;i++){
			if(document.f1.sattus_gerente[i].checked)								
				return document.f1.sattus_gerente[i].value;
	}
}
function traeRadiotipo_dt(cadena)
{
	for (i=0;i<document.f1.tipo_dt.length;i++){
			if(cadena==document.f1.tipo_dt[i].value)								
				document.f1.tipo_dt[i].click();
	}
}
function verRadiotipo_dt()
{
	for (i=0;i<document.f1.tipo_dt.length;i++){
			if(document.f1.tipo_dt[i].checked)								
				return document.f1.tipo_dt[i].value;
	}
}function traeRadiostatus_fam(cadena)
{
	for (i=0;i<document.f1.status_fam.length;i++){
			if(cadena==document.f1.status_fam[i].value)								
				document.f1.status_fam[i].click();
	}
}
function verRadiostatus_fam()
{
	for (i=0;i<document.f1.status_fam.length;i++){
			if(document.f1.status_fam[i].checked)								
				return document.f1.status_fam[i].value;
	}
}

function traeRadiostatus_g_a(cadena)
{
	for (i=0;i<document.f1.status_g_a.length;i++){
			if(cadena==document.f1.status_g_a[i].value)								
				document.f1.status_g_a[i].click();
	}
}
function verRadiostatus_g_a()
{
	for (i=0;i<document.f1.status_g_a.length;i++){
			if(document.f1.status_g_a[i].checked)								
				return document.f1.status_g_a[i].value;
	}
}
function traeRadiostatus_alarma(cadena)
{
	for (i=0;i<document.f1.status_alarma.length;i++){
			if(cadena==document.f1.status_alarma[i].value)								
				document.f1.status_alarma[i].click();
	}
}
function verRadiostatus_alarma()
{
	for (i=0;i<document.f1.status_alarma.length;i++){
			if(document.f1.status_alarma[i].checked)								
				return document.f1.status_alarma[i].value;
	}
}
function traeRadiostatus_est(cadena)
{
	for (i=0;i<document.f1.status_est.length;i++){
			if(cadena==document.f1.status_est[i].value)								
				document.f1.status_est[i].click();
	}
}
function verRadiostatus_est()
{
	for (i=0;i<document.f1.status_est.length;i++){
			if(document.f1.status_est[i].checked)								
				return document.f1.status_est[i].value;
	}
}
function traeRadiostatus_prec(cadena)
{
	for (i=0;i<document.f1.status_prec.length;i++){
			if(cadena==document.f1.status_prec[i].value)								
				document.f1.status_prec[i].click();
	}
}
function verRadiostatus_prec()
{
	for (i=0;i<document.f1.status_prec.length;i++){
			if(document.f1.status_prec[i].checked)								
				return document.f1.status_prec[i].value;
	}
}


function traeRadiostatus_esta(cadena)
{
	for (i=0;i<document.f1.status_esta.length;i++){
			if(cadena==document.f1.status_esta[i].value)								
				document.f1.status_esta[i].click();
	}
}
function verRadiostatus_esta()
{
	for (i=0;i<document.f1.status_esta.length;i++){
			if(document.f1.status_esta[i].checked)								
				return document.f1.status_esta[i].value;
	}
}
function traeRadiostatus_mun(cadena)
{
	for (i=0;i<document.f1.status_mun.length;i++){
			if(cadena==document.f1.status_mun[i].value)								
				document.f1.status_mun[i].click();
	}
}
function verRadiostatus_mun()
{
	for (i=0;i<document.f1.status_mun.length;i++){
			if(document.f1.status_mun[i].checked)								
				return document.f1.status_mun[i].value;
	}
}
function traeRadiostatus_ciudad(cadena)
{
	for (i=0;i<document.f1.status_ciudad.length;i++){
			if(cadena==document.f1.status_ciudad[i].value)								
				document.f1.status_ciudad[i].click();
	}
}
function verRadiostatus_ciudad()
{
	for (i=0;i<document.f1.status_ciudad.length;i++){
			if(document.f1.status_ciudad[i].checked)								
				return document.f1.status_ciudad[i].value;
	}
}


function traeRadiostatus_contrato(cadena)
{
	for (i=0;i<document.f1.status_contrato.length;i++){
			if(cadena==document.f1.status_contrato[i].value)								
				document.f1.status_contrato[i].checked=true;
	}
}
function number_format (number, decimals, dec_point, thousands_sep) {
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function (n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}


function traeRadiostatus_promo(cadena)
{
	for (i=0;i<document.f1.status_promo.length;i++){
			if(cadena==document.f1.status_promo[i].value)								
				document.f1.status_promo[i].click();
	}
}
function verRadiostatus_promo()
{
	for (i=0;i<document.f1.status_promo.length;i++){
			if(document.f1.status_promo[i].checked)								
				return document.f1.status_promo[i].value;
	}
}

function traeRadiostatus_promo_con(cadena)
{
	for (i=0;i<document.f1.status_promo_con.length;i++){
			if(cadena==document.f1.status_promo_con[i].value)								
				document.f1.status_promo_con[i].click();
	}
}
function verRadiostatus_promo_con()
{
	for (i=0;i<document.f1.status_promo_con.length;i++){
			if(document.f1.status_promo_con[i].checked)								
				return document.f1.status_promo_con[i].value;
	}
}

function traeRadiostatus_conv(cadena)
{
	for (i=0;i<document.f1.status_conv.length;i++){
			if(cadena==document.f1.status_conv[i].value)								
				document.f1.status_conv[i].click();
	}
}
function verRadiostatus_conv()
{
	for (i=0;i<document.f1.status_conv.length;i++){
			if(document.f1.status_conv[i].checked)								
				return document.f1.status_conv[i].value;
	}
}


function asignar_promo_serv(cadena)
{
		deseleccionarTodo_tec();
			cade=cadena.split("=@");
			tam=cade.length;
			tam1=document.f1.checkbox.length;
			document.f1.checkbox[0].disabled=true;
			for(i=1;i<tam;i++){
				
				for(j=1;j<tam1;j++){
					if(trim(document.f1.checkbox[j].value)==trim(cade[i])){
						document.f1.checkbox[j].checked=1;
					}
				}
			
			}	
}

function traeRadiotipo_e_p(cadena)
{
	for (i=0;i<document.f1.tipo_e_p.length;i++){
			if(cadena==document.f1.tipo_e_p[i].value)								
				document.f1.tipo_e_p[i].click();
	}
}
function verRadiotipo_e_p()
{
	for (i=0;i<document.f1.tipo_e_p.length;i++){
			if(document.f1.tipo_e_p[i].checked)								
				return document.f1.tipo_e_p[i].value;
	}
}

function resp_traeinfo_forma_pago(cadena)
{
		cade= cadena.split("-Class-");
		ca= cade[1].split("=@");
		
		document.f1.id_tipo_pago.value=ca[0];
		document.f1.monto_tp.value=ca[3];
			document.f1.banco.value=ca[1];
			document.f1.numero.value=ca[2];
		//alerta(cade.length)
		if(cade.length==3){
			ca= cade[2].split("=@");
			document.f1.id_tipo_pago1.value=ca[0];
			document.f1.monto_tp1.value=ca[3];
			document.f1.banco1.value=ca[1];
			document.f1.numero1.value=ca[2];
			document.f1.checktp1.checked=true;
			
			document.f1.banco1.disabled=false;
			document.f1.numero1.disabled=false;
			document.f1.monto_tp1.disabled=false;
			document.f1.id_tipo_pago1.disabled=false;
		}else{
			document.f1.checktp1.checked=false;
			document.f1.monto_tp1.value = '';
			document.f1.banco1.value = '';
			document.f1.numero1.value = '';
			document.f1.id_tipo_pago1.value=0;
			
			document.f1.banco1.disabled=true;
			document.f1.numero1.disabled=true;
			document.f1.monto_tp1.disabled=true;
			document.f1.id_tipo_pago1.disabled=true;
		}
}


function traeRadiostatus_servidor(cadena)
{
	for (i=0;i<document.f1.status_servidor.length;i++){
			if(cadena==document.f1.status_servidor[i].value)								
				document.f1.status_servidor[i].click();
	}
}
function verRadiostatus_servidor()
{
	for (i=0;i<document.f1.status_servidor.length;i++){
			if(document.f1.status_servidor[i].checked)								
				return document.f1.status_servidor[i].value;
	}
}
function traeRadiosincronizar(cadena)
{
	for (i=0;i<document.f1.sincronizar.length;i++){
			if(cadena==document.f1.sincronizar[i].value)								
				document.f1.sincronizar[i].click();
	}
}
function verRadiosincronizar()
{
	for (i=0;i<document.f1.sincronizar.length;i++){
			if(document.f1.sincronizar[i].checked)								
				return document.f1.sincronizar[i].value;
	}
}
function traeRadiostatus_ser(cadena)
{
	for (i=0;i<document.f1.status_ser.length;i++){
			if(cadena==document.f1.status_ser[i].value)								
				document.f1.status_ser[i].click();
	}
}
function verRadiostatus_ser()
{
	for (i=0;i<document.f1.status_ser.length;i++){
			if(document.f1.status_ser[i].checked)								
				return document.f1.status_ser[i].value;
	}
}


function traeRadiostatus_dpp(cadena)
{
	for (i=0;i<document.f1.status_dpp.length;i++){
			if(cadena==document.f1.status_dpp[i].value)								
				document.f1.status_dpp[i].click();
	}
}
function verRadiostatus_dpp()
{
	for (i=0;i<document.f1.status_dpp.length;i++){
			if(document.f1.status_dpp[i].checked)								
				return document.f1.status_dpp[i].value;
	}
}
function traeRadiostatus_tc(cadena)
{
	for (i=0;i<document.f1.status_tc.length;i++){
			if(cadena==document.f1.status_tc[i].value)								
				document.f1.status_tc[i].click();
	}
}
function verRadiostatus_tc()
{
	for (i=0;i<document.f1.status_tc.length;i++){
			if(document.f1.status_tc[i].checked)								
				return document.f1.status_tc[i].value;
	}
}
function traeRadiostatus_tll(cadena)
{
	for (i=0;i<document.f1.status_tll.length;i++){
			if(cadena==document.f1.status_tll[i].value)								
				document.f1.status_tll[i].click();
	}
}
function verRadiostatus_tll()
{
	for (i=0;i<document.f1.status_tll.length;i++){
			if(document.f1.status_tll[i].checked)								
				return document.f1.status_tll[i].value;
	}
}
function traeRadiocrea_alarma(cadena)
{
	for (i=0;i<document.f1.crea_alarma.length;i++){
			if(cadena==document.f1.crea_alarma[i].value)								
				document.f1.crea_alarma[i].click();
	}
}
function verRadiocrea_alarma()
{
	for (i=0;i<document.f1.crea_alarma.length;i++){
			if(document.f1.crea_alarma[i].checked)								
				return document.f1.crea_alarma[i].value;
	}
}
function traeRadiostatus_drl(cadena)
{
	for (i=0;i<document.f1.status_drl.length;i++){
			if(cadena==document.f1.status_drl[i].value)								
				document.f1.status_drl[i].click();
	}
}
function verRadiostatus_drl()
{
	for (i=0;i<document.f1.status_drl.length;i++){
			if(document.f1.status_drl[i].checked)								
				return document.f1.status_drl[i].value;
	}
}
function traeRadiostatus_trl(cadena)
{
	for (i=0;i<document.f1.status_trl.length;i++){
			if(cadena==document.f1.status_trl[i].value)								
				document.f1.status_trl[i].click();
	}
}
function verRadiostatus_trl()
{
	for (i=0;i<document.f1.status_trl.length;i++){
			if(document.f1.status_trl[i].checked)								
				return document.f1.status_trl[i].value;
	}
}


function traeRadiotipo_fact(cadena)
{
	for (i=0;i<document.f1.tipo_fact.length;i++){
			if(cadena==document.f1.tipo_fact[i].value)								
				document.f1.tipo_fact[i].click();
	}
}
function verRadiotipo_fact()
{
	for (i=0;i<document.f1.tipo_fact.length;i++){
			if(document.f1.tipo_fact[i].checked)								
				return document.f1.tipo_fact[i].value;
	}
}
function traeRadiocontrato_imp(cadena)
{
			
			if(cadena==document.getElementById("contrato_imp1").value){						
				document.getElementById("contrato_imp1").checked=true;
			}
			else{
				document.getElementById("contrato_imp2").checked=true;
			}
	
}
function verRadiocontrato_imp()
{
	
			if(document.getElementById("contrato_imp1").checked){								
				return document.getElementById("contrato_imp1").value;
			}
			else{
				return document.getElementById("contrato_imp2").value;
			}
			
}





function traeRadiostatus_marca(cadena)
{
	for (i=0;i<document.f1.status_marca.length;i++){
			if(cadena==document.f1.status_marca[i].value)								
				document.f1.status_marca[i].click();
	}
}
function verRadiostatus_marca()
{
	for (i=0;i<document.f1.status_marca.length;i++){
			if(document.f1.status_marca[i].checked)								
				return document.f1.status_marca[i].value;
	}
}
function traeRadiostatus_modelo(cadena)
{
	for (i=0;i<document.f1.status_modelo.length;i++){
			if(cadena==document.f1.status_modelo[i].value)								
				document.f1.status_modelo[i].click();
	}
}
function verRadiostatus_modelo()
{
	for (i=0;i<document.f1.status_modelo.length;i++){
			if(document.f1.status_modelo[i].checked)								
				return document.f1.status_modelo[i].value;
	}
}
function traeRadiostatus_modelo(cadena)
{
	for (i=0;i<document.f1.status_modelo.length;i++){
			if(cadena==document.f1.status_modelo[i].value)								
				document.f1.status_modelo[i].click();
	}
}
function verRadiostatus_modelo()
{
	for (i=0;i<document.f1.status_modelo.length;i++){
			if(document.f1.status_modelo[i].checked)								
				return document.f1.status_modelo[i].value;
	}
}
function traeRadiostatus_accquery(cadena)
{
	for (i=0;i<document.f1.status_accquery.length;i++){
			if(cadena==document.f1.status_accquery[i].value)								
				document.f1.status_accquery[i].click();
	}
}

function verRadiostatus_accquery()
{
	for (i=0;i<document.f1.status_accquery.length;i++){
			if(document.f1.status_accquery[i].checked)								
				return document.f1.status_accquery[i].value;
	}
}

function asignarCampos_serv_franq(cadena)
{
		tam1=document.f1.franquicia.length;
		for(j=0;j<tam1;j++){
			document.f1.franquicia[j].checked=0;
		}

			cade=cadena.split("=@");
			tam=cade.length;
			
			for(i=0;i<tam;i++){
				for(j=0;j<tam1;j++){
					if(trim(document.f1.franquicia[j].value)==trim(cade[i])){
						document.f1.franquicia[j].checked=1;
					}
					
				}
			
			}	
}
function asignarCampos_serv_acc_act(cadena)
{
		deseleccionar_todo_servicio();
			cade=cadena.split(":");
			tam=cade.length;
			tam1=document.f1.servicio.length;
			
			for(i=0;i<tam;i++){
				for(j=0;j<tam1;j++){
					if(trim(document.f1.servicio[j].value)==trim(cade[i])){
						document.f1.servicio[j].checked=1;
					}
					
				}
			
			}	
}
function asignarCampos_traer_serv_acc_susc(cadena)
{
		deseleccionar_todo_servicio();
			cade=cadena.split("=@");
			tam=cade.length;
			tam1=document.f1.servicio.length;
			for(j=0;j<tam1;j++){
				document.f1.servicio[j].disabled=true;
			}
			//alert("HOLA");
			for(i=0;i<tam;i++){
				for(j=0;j<tam1;j++){
					if(trim(document.f1.servicio[j].value)==trim(cade[i])){
						//alert("hola");
						document.f1.servicio[j].disabled=false;
						document.f1.servicio[j].checked=1;
					}
					
				}
			
			}	
}
function deseleccionar_todo_servicio(){
   for (i=0;i<document.f1.servicio.length;i++)
      if(document.f1.servicio[i].type == "checkbox")
         document.f1.servicio[i].checked=0
} 




function traeRadiostatus_cuba(cadena)
{
	for (i=0;i<document.f1.status_cuba.length;i++){
			if(cadena==document.f1.status_cuba[i].value)								
				document.f1.status_cuba[i].click();
	}
}
function verRadiostatus_cuba()
{
	for (i=0;i<document.f1.status_cuba.length;i++){
			if(document.f1.status_cuba[i].checked)								
				return document.f1.status_cuba[i].value;
	}
}

function traeRadioconc_cliente(cadena)
{
	for (i=0;i<document.f1.conc_cliente.length;i++){
			if(cadena==document.f1.conc_cliente[i].value)								
				document.f1.conc_cliente[i].click();
	}
}
function verRadioconc_cliente()
{
	for (i=0;i<document.f1.conc_cliente.length;i++){
			if(document.f1.conc_cliente[i].checked)								
				return document.f1.conc_cliente[i].value;
	}
}


function traeRadioconc_franq(cadena)
{
	for (i=0;i<document.f1.conc_franq.length;i++){
			if(cadena==document.f1.conc_franq[i].value)								
				document.f1.conc_franq[i].click();
	}
}
function verRadioconc_franq()
{
	for (i=0;i<document.f1.conc_franq.length;i++){
			if(document.f1.conc_franq[i].checked)								
				return document.f1.conc_franq[i].value;
	}
}

