//funcion que permite crear el objeto Ajax.
function nuevoAjax_mat(){
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false; 
	try{ 
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e){ 
		try{ 
			// Creacion del objet AJAX para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		}
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 
	return xmlhttp; 
}

//para crear la conexion a traves de AJAX al servidor donde esta instalado php
//archivoPHP: nombre o ruta de archivo al que desea llamar;
//clase:  la clase con que desea comunicarse; 
// cadena: la lista de parametros o datos adicionales; 
//tipoDato:  la operacion que desea realizar)

function conexionPHP_mat(archivoPHP,clase,cadena,tipoDato){
	//devuelve el numero de parametro recibidos
	var arg=conexionPHP_mat.arguments.length;
	//crea el objeto AJAX
	var ajax=nuevoAjax_mat();
	//abre la conexion con php
	ajax.open("POST", "saecomat/"+archivoPHP, true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//envia los datos a traves de AJAX concatenados con =@
	if(archivoPHP=="administrar.php")
		ajax.send("d="+tipoDato+"=@"+clase+"=@"+cadena);
	else
		ajax.send("d="+clase+"=@"+cadena);

	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			//obtiene la respuesta del servidor;  verifica la seguridad
			if(ajax.responseText=="SecurityFalse"){
				alert( "Error. Intento de Violación de Seguridad, la Sesion será reiniciada");
				conexionPHP_mat('Seguridad/Seguridad.php','CerrarSesion');
			}
			else{
				if(clase=="DataGrid"){
					if(claseGlobal=="confir_pedido" && idglobal=="1"){
						document.getElementById(divDataGrid_mat).innerHTML = ajax.responseText;
						validarpedido2();
						idglobal="0";
					}else if(claseGlobal=="realizar_compra" && idglobal=="1"){
						document.getElementById(divDataGrid_mat).innerHTML = ajax.responseText;
						validarpedido3();						
						idglobal="0";
					}else if(claseGlobal=="aprobarinventario" && idglobal=="1"){
						document.getElementById(divDataGrid_mat).innerHTML = ajax.responseText;
						validar_registro_pedido();						
						idglobal="0";
					}else{
						document.getElementById(divDataGrid_mat).innerHTML = ajax.responseText;
					}
				}
				else{
					//Hace la llamada a respuestaPHP_mat() para que esla procesa la informacion devuelta
					if(arg==4)
						respuestaPHP_mat(archivoPHP,clase,ajax.responseText,tipoDato);
					else
						respuestaPHP_mat(archivoPHP,clase,ajax.responseText);
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
function respuestaPHP_mat(archivoPHP,clase,cadena,mensaje){
	//para limpiar la basura de la cadena
	cadena=limpiar(cadena);
	var arg=respuestaPHP_mat.arguments.length;	
	/** VARIACIONES REALIZADAS TRAS NUEVAS INCORPORACIONES**********/
	/** capa donde se cargan todos los formularios**********/
	var capa=document.getElementById("principal"); 
	/** Llamado a la función cargarPrincipal(); que llama a elementos que se cargan en la capa "principal", Por ejm:
	capa cargando de cada llamado en el menú, sacrollbar, tooltip. Archivo: scripts-jquery.js
	******/
	$(document).ready( cargarPrincipal ); 
	/** FIN VARIACIONES ********************************************/
	//para saber de que archivo o ruta extrajola respuesta
	switch(archivoPHP)
	{
		case "movimiento_final_orden_gen.php":
				document.getElementById("materiales").innerHTML=cadena;
				id_movglobal=document.f1.id_mov.value;
				document.f1.referencia.value=id_orden();
				conexionPHP_mat('informacion.php',"traerDepMatGen",id_gt()+"=@"+id_orden());	
				
				clase="movimiento_final_orden_gen";
				
			if(clase=="movimiento_final_orden" || clase=="movimiento_final_orden_gen"){
			
			$().ready(function() {

				function log(event, data, formatted) {
				//	alert("hola como"+data);
					validarmat_padre_mov_mat_autocomp(data);
					
				}
				
				function formatItem(row) {
					return row[0] + " (<strong>id: " + row[1] + "</strong>)";
				}
				function formatResult(row) {
					return row[0].replace(/(<.+?>)/gi, '');
				}
				
				$("#nombre_mat").autocomplete(mat_autoc, {
					max: 100,
					width: 200,
					minChars: 0
				});

				$(":text, textarea").result(log).next().click(function() {
					$(this).prev().search();
				});
			
			
			});
			
			//conexionPHP_mat('informacion.php','traermat','A0000001');
		}
		
		case "formulario.php":
			if(clase=="movimiento_final_orden"){
				document.getElementById("materiales").innerHTML=cadena;
				id_movglobal=document.f1.id_mov.value;
				document.f1.referencia.value=id_orden();
				conexionPHP_mat('informacion.php',"traerDepMat",id_gt()+"=@"+id_orden());	
			}
			else if(clase=="movimiento_final_orden_gen"){
				document.getElementById("materiales").innerHTML=cadena;
				id_movglobal=document.f1.id_mov.value;
				document.f1.referencia.value=id_orden();
				conexionPHP_mat('informacion.php',"traerDepMatGen",id_gt()+"=@"+id_orden());	
			}
			else if(clase=="movimiento_final_orden_mat"){
				document.getElementById("materiales").innerHTML=cadena;
				id_movglobal=document.f1.id_mov.value;
				document.f1.referencia.value=id_orden();
				conexionPHP_mat('informacion.php',"traerDepMatOrd",id_gt()+"=@"+id_orden());	
			}
			else{
				claseGlobal=clase;
				capa.innerHTML=cadena;
			}
			if(clase!="movimiento_final_orden" && clase!="movimiento_final_orden_gen"  && clase!="movimiento_final_orden_mat" && clase!="config_mat" && clase!="Sesion" && clase!="CreaFormulario" && clase!="VerDatos"  && clase!="Configuracion"){
				boton_mat(false,true,true,claseGlobal);
			}
		divDataGrid_mat="datagrid"; params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
		if(clase=="Sesion"){
		//	iniciarSesion_mat();
		}
		
		if(clase=="movimiento"){
			
			validaTransfer("checkboxTrans");
			
			$().ready(function() {

				function log(event, data, formatted) {
				//	alert("hola como"+data);
					validarmat_padre_mov_mat_autocomp(data);
					
				}
				
				function formatItem(row) {
					return row[0] + " (<strong>id: " + row[1] + "</strong>)";
				}
				function formatResult(row) {
					return row[0].replace(/(<.+?>)/gi, '');
				}
				
				$("#nombre_mat").autocomplete(mat_autoc, {
					max: 100,
					width: 200,
					minChars: 0
				});

				$(":text, textarea").result(log).next().click(function() {
					$(this).prev().search();
				});
			
			
			});
			
			conexionPHP_mat('informacion.php','traermat','A0000001');
		}
		
		if(clase=="movimiento_final_orden" || clase=="movimiento_final_orden_gen"){
			
			$().ready(function() {

				function log(event, data, formatted) {
				//	alert("hola como"+data);
					validarmat_padre_mov_mat_autocomp(data);
					
				}
				
				function formatItem(row) {
					return row[0] + " (<strong>id: " + row[1] + "</strong>)";
				}
				function formatResult(row) {
					return row[0].replace(/(<.+?>)/gi, '');
				}
				
				$("#nombre_mat").autocomplete(mat_autoc, {
					max: 100,
					width: 200,
					minChars: 0
				});

				$(":text, textarea").result(log).next().click(function() {
					$(this).prev().search();
				});
			
			
			});
			
			conexionPHP_mat('informacion.php','traermat','A0000001');
		}
		if(clase=="movimiento_final_orden_mat"){
			
			$().ready(function() {

				function log(event, data, formatted) {
				//	alert("hola como"+data);
					validarmat_padre_mov_mat_autocomp_orden(data);
					
				}
				
				function formatItem(row) {
					return row[0] + " (<strong>id: " + row[1] + "</strong>)";
				}
				function formatResult(row) {
					return row[0].replace(/(<.+?>)/gi, '');
				}
				
				$("#nombre_mat").autocomplete(mat_autoc, {
					max: 100,
					width: 200,
					minChars: 0
				});

				$(":text, textarea").result(log).next().click(function() {
					$(this).prev().search();
				});
			
			
			});
			
			conexionPHP_mat('informacion.php','traermat','A0000001');
		}
		if(clase=="config_mat"){
			//conexionPHP_mat('validarExistencia.php','1=@config_mat','id_franq=@1');
			params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
			archivoDataGrid="procesos/datagrid_config_mat.php";
			updateTable_mat();
			
		}
		if(clase=="materiales" ){
			idglobal=id_mat();
			numglobal=numero_mat();
			id_mglobal=id_m();
			
		}
		if(clase=="motivo_inv" ){
			idglobal=id_motivo();
		}
		if(clase=="confir_pedido" ){
			idglobal="0";
		}
		if(clase=="realizar_compra" ){
			idglobal="0";
		}
		if(clase=="aprobarinventario" ){
			idglobal="0";
		}
		if(clase=="unidad_medida" ){
			idglobal=id_unidad();
		}
		if(clase=="deposito" ){
			idglobal=id_dep();
		}
		if(clase=="pedido" ){
			idglobal=id_ped();
		}
		if(clase=="tipo_movimiento" ){
			idglobal=id_tm();
		}
		if(clase=="entidad" ){
			idglobal=id_persona();
		}
		if(clase=="proveedor" || clase=="mat_prov"){
			idglobal=id_prov();
		}
		
		if(clase=="Configuracion"){
			conexionPHP_mat("informacion.php","Manejador");
		}
		/*if(clase=="confir_pedido" ){
			params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
			archivoDataGrid="procesos/datagrid_pedido.php";
			updateTable_mat();
		}*/
		if(clase=="realizar_compra" || clase=="confir_pedido" || clase=="motivo_inv" || clase=="deposito" || clase=="tipo_entidad"  || clase=="entidad"  || clase=="familia" || clase=="inventario_materiales" || clase=="unidad_medida" || clase=="tipo_movimiento" || clase=="movimiento" || clase=="proveedor" || clase=="pedido" || clase=="materiales" || clase=="mov_mat" || clase=="mat_prov" || clase=="mat_ped" || clase=="inventario" || clase=="aprobarinventario" || clase=="mat_padre" || clase=="ejempl" || clase=="NuevoModuloDataGrid"){
			params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
			archivoDataGrid="procesos/datagrid_"+clase+".php";
			updateTable_mat();
		}
		if(clase=="Rep_reportepedido"){
			myCalendar = new dhtmlXCalendarObject(["fechades","fechahas"]);
			archivoDataGrid="reportes/Rep_reportepedido.php";
			updateTable_mat();
		}
		if(clase=="Rep_matpadre"){
			archivoDataGrid="reportes/Rep_matpadre.php";
			updateTable_mat();
		}
		if(clase=="Rep_proveedores"){
			archivoDataGrid="reportes/Rep_proveedores.php";
			updateTable_mat();
		}
		if(clase=="Rep_materialesuniinv"){
			archivoDataGrid="reportes/Rep_materialesuniinv.php";
			updateTable_mat();
		}
		if(clase=="Rep_planillamov"){
			archivoDataGrid="reportes/Rep_planillamov.php";
			updateTable_mat();
		}
		if(clase=="Rep_planillaped"){
			archivoDataGrid="reportes/Rep_planillaped.php";
			updateTable_mat();
		}
		if(clase=="Rep_planillainv"){
			archivoDataGrid="reportes/Rep_planillainv.php";
			updateTable_mat();
		}
		if(clase=="Rep_reportemovimiento"){
			myCalendar = new dhtmlXCalendarObject(["fechades","fechahas"]);
			archivoDataGrid="reportes/Rep_reportemovimiento.php";
			updateTable_mat();
		}
		if(clase=="Rep_reportemov_cierre"){
			myCalendar = new dhtmlXCalendarObject(["fechades","fechahas"]);
			archivoDataGrid="reportes/Rep_reportemov_cierre.php?id_dep="+id_dep()+"&desde="+document.f1.fechades.value+"&hasta="+document.f1.fechahas.value+"&";
			updateTable_mat();
		}
		if(clase=="Rep_reportemov_esp"){
			myCalendar = new dhtmlXCalendarObject(["fechades","fechahas"]);
			archivoDataGrid="reportes/Rep_reportemov_esp.php?id_dep="+id_dep()+"&desde="+document.f1.fechades.value+"&hasta="+document.f1.fechahas.value+"&";
			updateTable_mat();
		}
		if(clase=="busquedad_m"){
		
			myCalendar = new dhtmlXCalendarObject(["fechades","fechahas"]);
				$().ready(function() {
					function log(event, data, formatted) {
						validarmateriales3_autocomp(data);
					}
					function formatItem(row) {
						return row[0] + " (<strong>id: " + row[1] + "</strong>)";
					}
					function formatResult(row) {
						return row[0].replace(/(<.+?>)/gi, '');
					}
					$("#nombre_mat").autocomplete(mat_autoc, {
						max: 100,
						width: 200,
						minChars: 0
					});
					$(":text, textarea").result(log).next().click(function() {
						$(this).prev().search();
					});
				});
				conexionPHP_mat('informacion.php','traermat','A0000001');
		}
		if(clase=="Rep_reporteinventario"){
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fechades'),'',2010,2020);
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fechahas'),'',2010,2020);
				//myCalendar = new dhtmlXCalendarObject(["fechades","fechahas"]);
			archivoDataGrid="reportes/Rep_reporteinventario.php";
			updateTable_mat();
		}
		if(clase=="NuevoModuloReporte"){}
		
		if(clase=='pedido'){
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_ped'),'',2010,2021);
				//myCalendar = new dhtmlXCalendarObject(["fecha_ped"]);
		}	
		if(clase=='pedido'){
			//obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fecha_ent'),'',2010,2021);
				//myCalendar = new dhtmlXCalendarObject(["fecha_ent"]);
		}	
		if(clase=='inventario'){
		//	obj_epoch  = new Epoch('epoch_popup','popup',document.getElementById('fechainv'),'',2010,2021);
				//myCalendar = new dhtmlXCalendarObject(["fechainv"]);
		}	
	  break;
	  case "informacion.php":
			
			if(clase=="Limpieza" || clase=="LimpiezaModulo"){
				capa=document.getElementById("plantilla");
			}	
				
			
			
			if(clase=="IniciarSesion"){
				cargarModulos_mat(cadena);
			}
			else if(clase=="CargaObjeto" || clase=="CargaRegistro"){
				cargarDatos(cadena);
			}
			else if(clase=="ObjetoFormulario"){
				traerDatos(cadena);
			}
			else if(clase=="Manejador"){
				asignarCampos_mat(clase,cadena);
			}
			else if(clase=="TraerModulo1"){
				asignarModulo_mat(cadena);
			}
			else if(clase=="TraerModulo"){
				asignarModulo_mat(cadena);
			}	
			else if(clase=="camposRep2"){
				document.getElementById("AllFields").innerHTML=cadena;
			}
			else if(clase=="validarSQL"){
				if(cadena=="true"){
					if(priSQL){
						alert("Validacion Completada Con exito");
					}
					valSQL=true;
					priSQL=true;
				}
				else{
					alert("Error, consulta SQL Erronea");
					valSQL=false;
				}
			}
			else if(clase=="traerLisMatProv"){
				tildaMatProv(cadena);
			}else if(clase=="traerLisPedido"){
				tildaPedido(cadena);
			}else if(clase=="traeValDep"){
				document.getElementById('iddep2').value=trim(cadena);
				//tildaPedido(cadena);
			}else if(clase=="traerLisInventario"){
				tildaInventario(cadena);
			}else if(clase=="traerGtPersona"){
				//capa.innerHTML=cadena;
				document.getElementById("id_persona").innerHTML=cadena;
				//alert(idGlobal);
				document.f1.id_persona.value=idGlobal;//idGlobal="";
				
			}else if(clase=="traerTmovi"){
				//capa.innerHTML=cadena;
				document.getElementById("id_tm").innerHTML=cadena;
				//alert(idGlobal);
				document.f1.id_tm.value=idGlobal;//idGlobal="";
				filtraReporMovimiento('id_tm','fechades','fechahas','id_dep','tip');
				
			}else if(clase=="traerTipomov"){
				document.getElementById("id_tm").innerHTML=cadena;
			}else if(clase=="traerTM"){
				document.f1.tipo_ent_sal.value=cadena;
			}
			else if(clase=="traerTipocon"){
				document.getElementById("id_persona").innerHTML=cadena;
			}else if(clase=="traerTC"){
				document.f1.id_te.value=cadena;
			}
			else if(clase=="traerDeposito02"){
				//capa.innerHTML=cadena;
				document.getElementById("id_dep").innerHTML=cadena;
				//alert(idGlobal);
				//document.f1.id_tm.value=idGlobal;//idGlobal="";
				//filtraReporMovimiento('id_tm','fechades','fechahas','id_dep','tip');
				
			}
			else if(clase=="traermat"){
				mat_autoc=cadena.split("=@");
				//alert(mat_autoc);
				autocomplete();
			}
			else if(clase=="agregar_mat_mov"){
				capa=document.getElementById("mov");
				capa.innerHTML=cadena;		
				
				$().ready(function() {

					function log(event, data, formatted) {
					//	alert("hola como"+data);
						validarmat_padre_mov_mat_autocomp(data);
					}
					function formatItem(row) {
						return row[0] + " (<strong>id: " + row[1] + "</strong>)";
					}
					function formatResult(row) {
						return row[0].replace(/(<.+?>)/gi, '');
					}
					$("#nombre_mat").autocomplete(mat_autoc, {
						max: 100,
						width: 200,
						minChars: 0
					});
					$(":text, textarea").result(log).next().click(function() {
						$(this).prev().search();
					});
				});
				if(document.getElementById("numero_mat").value==''){
					document.getElementById("numero_mat").select();
				}else{
					document.getElementById("cant").select();
				}
			}
			else if(clase=="agregar_mat_mov_orden"){
					capa=document.getElementById("mov");
					capa.innerHTML=cadena;		
					$().ready(function() {
						function log(event, data, formatted) {
							validarmat_padre_mov_mat_autocomp_orden(data);
						}
						function formatItem(row) {
							return row[0] + " (<strong>id: " + row[1] + "</strong>)";
						}
						function formatResult(row) {
							return row[0].replace(/(<.+?>)/gi, '');
						}
						$("#nombre_mat").autocomplete(mat_autoc, {
							max: 100,
							width: 200,
							minChars: 0
						});
						$(":text, textarea").result(log).next().click(function() {
							$(this).prev().search();
						});
					});
				document.getElementById("cant").select();
			}
			else if(clase=="traerDepMat"){
				if(cadena!=''){
					cade= cadena.split("=@");
					if(cade[3]!='false'){
						document.f1.iddep.value=cade[0];
						document.f1.id_persona.value=cade[1];
						document.f1.registrar_m.disabled=false;
						
						if(cade[2]!=''){	
							document.f1.id_mov.value=cade[2];
							document.getElementById('auxi').value="1";
							params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
							divDataGrid_mat="datagrid_mat";
							archivoDataGrid="procesos/datagrid_movimiento_uni.php?id_dep=0=="+id_mov()+"&";
							updateTable_mat();
						}
						else{
							document.f1.id_mov.value=id_movglobal;
							document.getElementById('auxi').value="0";
						}
						valIqualD();
						traermat();
					}
					else{
						alert("Error, el encargado del deposito grupo debe estar registrado como entidad");
						document.f1.registrar_m.disabled=true;
						document.f1.id_mov.value=id_movglobal;
						document.getElementById('auxi').value="0";
					}
				}
				else{
					alert("Error, el grupo seleccionado no tiene asociado un deposito");
					document.f1.registrar_m.disabled=true;
					document.f1.id_mov.value=id_movglobal;
					document.getElementById('auxi').value="0";
				}
			}
			else if(clase=="traerDepMatGen"){
					cade= cadena.split("=@");
					if(cade[3]!='false'){
						//document.f1.iddep.value=cade[0];
						document.f1.id_persona.value=cade[1];
						document.f1.registrar_m.disabled=false;
						
						if(cade[2]!=''){	
							document.f1.id_mov.value=cade[2];
							document.getElementById('auxi').value="1";
							params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
							divDataGrid_mat="datagrid_mat";
							archivoDataGrid="procesos/datagrid_movimiento_uni.php?id_dep=0=="+id_mov()+"&";
							updateTable_mat();
						}
						else{
							document.f1.id_mov.value=id_movglobal;
							document.getElementById('auxi').value="0";
						}
						valIqualD();
						traermat();
					}
					else{
						alert("Error, ningun miembro de este grupo esta registrado como entidad");
						document.f1.registrar_m.disabled=true;
						document.f1.id_mov.value=id_movglobal;
						document.getElementById('auxi').value="0";
					}
				
			}
			else if(clase=="traerDepMatOrd"){
					cade= cadena.split("=@");
						document.f1.registrar_m.disabled=false;
						
						if(cade[2]!=''){	
							document.f1.id_mov.value=cade[2];
							document.getElementById('auxi').value="1";
							params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
							divDataGrid_mat="datagrid_mat";
							archivoDataGrid="procesos/datagrid_movimiento_o_uni.php?id_dep=0=="+id_mov()+"&";
							updateTable_mat();
						}
						else{
							document.f1.id_mov.value=id_movglobal;
							document.getElementById('auxi').value="0";
						}
						valIqualD();
						traermat();
					
			}
			else if(clase=="ver_config_mat"){
					cade= cadena.split("=@");
					var hab_desc_alm_gru=cade[1];
					var hab_desc_alm_gen=cade[2];
					var hab_mat_orden=cade[3];
					var id_deposito=cade[4];
					
					if(hab_desc_alm_gru=="t"){
						cargarMatGrupo();
					}
					else if(hab_desc_alm_gen=="t"){
						//cargarMatGeneral();
						conexionPHP_mat('movimiento_final_orden_gen.php',id_deposito);
					}
					else if(hab_mat_orden=="t"){
						cargarMatOrden();
					}
			
			}
			else{
				capa.innerHTML=cadena;			
			}
			
			
	  break;
	  case "administrar.php":
		if(clase!="ModuloPerfil"){
			if (cadena=="true"){
			//	alert(":"+claseGlobal+":"+clase+":");
					if(clase=="movimiento" && claseGlobal=="movimiento"){
						dep=document.getElementById('iddep').value;
						//id_mov=document.getElementById(id2).value;
						params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
						archivoDataGrid="procesos/datagrid_movimiento_uni.php?id_dep="+dep+"=="+id_mov()+"&";
						updateTable_mat();
						document.f1.numero_m.value="";
						//agregar_ma_movit();
						limpiarmov_mat()
						
						document.getElementById('auxi').value="1";
						document.getElementById("id_mov").disabled=true;
						document.getElementById("iddep").disabled=true;
						document.getElementById("iddep2").disabled=true;
						document.getElementById("checkboxTrans").disabled=true;
						document.getElementById("imprimir1").disabled=false;
						/*location.href="saecomat/reportes/Rep_planillamovImpreso.php?id_mov="+id_mov()+"&";*/
					}
					else if(clase=="movimiento" && claseGlobal=="final_ordenes_tecnicos"){
						dep=document.getElementById('iddep').value;
						
						params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
						divDataGrid_mat="datagrid_mat";
						archivoDataGrid="procesos/datagrid_movimiento_uni.php?id_dep="+dep+"=="+id_mov()+"&";
						updateTable_mat();
						document.f1.numero_m.value="";
						limpiarmov_mat()
						
						document.getElementById('auxi').value="1";
						document.getElementById("id_mov").disabled=true;
						document.getElementById("iddep").disabled=true;
						document.getElementById("iddep2").disabled=true;
						document.getElementById("checkboxTrans").disabled=true;
						document.getElementById("imprimir1").disabled=false;
					}
					else if(clase=="movimiento_orden" && claseGlobal=="final_ordenes_tecnicos"){
						dep=document.getElementById('iddep').value;
						
						params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
						divDataGrid_mat="datagrid_mat";
						archivoDataGrid="procesos/datagrid_movimiento_o_uni.php?id_dep="+dep+"=="+id_mov()+"&";
						updateTable_mat();
						document.f1.numero_m.value="";
						limpiarmov_mat_orden();
						
						document.getElementById('auxi').value="1";
						document.getElementById("id_mov").disabled=true;
						document.getElementById("iddep").disabled=true;
						document.getElementById("iddep2").disabled=true;
						document.getElementById("checkboxTrans").disabled=true;
						document.getElementById("imprimir1").disabled=false;
					}
					else{
						alert( "TRANSACCION COMPLETADA CON EXITO ");
					}
					//alert(clase+"  "+claseGlobal);
					
					if(clase=="pedido" && claseGlobal=="pedido"){
						location.href="saecomat/reportes/Rep_planillapedImpreso.php?id_ped="+id_ped()+"&";
					}
					if(clase=="pedido" && claseGlobal=="realizar_compra"){
						location.href="saecomat/reportes/Rep_planillapedImpreso.php?id_ped="+id_ped()+"&";
					}
					if(clase=="pedido" && claseGlobal=="confir_pedido"){
						location.href="saecomat/reportes/Rep_planillapedImpreso.php?id_ped="+id_ped()+"&";
					}
					if(clase=="inventario" && claseGlobal=="inventario"){
						location.href="saecomat/reportes/Rep_planillainvImpreso.php?id_inv="+idinventario()+"&";
					}
					if(clase=="inventario" && claseGlobal=="aprobarinventario"){
						location.href="saecomat/reportes/Rep_planillainvImpreso.php?id_inv="+idinventario()+"&";
					}
					
					
					if(clase=="proveedor" && claseGlobal=="mat_prov" ){
						//clase="mat_prov";
						conexionPHP_mat('formulario.php',claseGlobal);
					}else if(clase=="pedido" && claseGlobal=="realizar_compra"){
						conexionPHP_mat('formulario.php',"realizar_compra");
					}else if(clase=="inventario" && claseGlobal=="aprobarinventario"){
						conexionPHP_mat('formulario.php',"aprobarinventario");
					}else if(clase=="pedido" && claseGlobal=="confir_pedido"){
						conexionPHP_mat('formulario.php',"confir_pedido");
					}else if(clase=="movimiento" && claseGlobal=="movimiento"){
					}else if(clase=="movimiento_orden" && claseGlobal=="movimiento"){
					}
					else if(clase=="movimiento" && claseGlobal=="final_ordenes_tecnicos"){
					}
					else if(clase=="config_mat" || clase=="Modulo" || clase=="Perfil" || clase=="Persona" || clase=="motivo_inv" || clase=="familia"  || clase=="entidad"  || clase=="tipo_entidad" || clase=="inventario_materiales" || clase=="deposito" || clase=="unidad_medida" || clase=="tipo_movimiento" || clase=="movimiento" || clase=="proveedor" || clase=="pedido" || clase=="materiales" || clase=="mov_mat" || clase=="mat_prov" || clase=="mat_ped" || clase=="inventario" || clase=="aprobarinventario" || clase=="mat_padre" || clase=="ejempl" || clase=="NuevoModulo"){
						conexionPHP_mat('formulario.php',clase);
					}
			}
			else{
				
				alert( "ERROR DURANTE TRANSACCION: "+cadena);							
			}
		}
	  break;
	  case "validarExistencia.php":
			if (cadena!="false")
			{
				var tabla=clase.split("=@")				
				asignarCampos_mat(tabla[1],cadena);
				if (arg < 4){
					if(clase=="1=@proveedor" && claseGlobal=="mat_prov" ){						
					
					}else if(clase=="2=@pedido" && claseGlobal=="pedido" ){						
						document.getElementById("modificar").disabled=false;
						document.getElementById("registrar").disabled=true;
					}else if(clase=="1=@mat_padre" && claseGlobal=="materiales" ){						
						
					}else if(clase=="2=@mat_padre" && claseGlobal=="mat_padre" ){						
						document.f1.modificar.disabled=false;
						document.f1.registrar.disabled=true;
					}else if(clase=="2=@inventario" && claseGlobal=="aprobarinventario" ){						
						/*document.f1.modificar.disabled=false;
						document.f1.registrar.disabled=true;*/
					}else if(clase=="1=@realizar_compra" && claseGlobal=="realizar_compra" ){						
						/*document.f1.modificar.disabled=false;
						document.f1.registrar.disabled=true;*/
					}else if(clase=="1=@confir_pedido" && claseGlobal=="confir_pedido" ){						
						document.f1.modificar.disabled=false;
						document.f1.registrar.disabled=true;
					}if(clase=="1=@persona" && claseGlobal=="entidad"){
						boton_mat(false,true,true,claseGlobal);
					}else if(clase=="2=@vista_materiales" && claseGlobal=="busquedad_m" ){						
						
					}else{
						boton_mat(true,false,false,claseGlobal);
					}					
				}
				else{						
					boton_mat(false,false,false,claseGlobal);			
				}
			}
			else if(cadena=="false")
			{
				if (arg == 4 && clase=="1=@persona"){
						alert(mensaje);
						boton_mat(true,true,true,claseGlobal);
				}
				else
				{
					//alert(clase+" n   global="+claseGlobal+"  id:"+idglobal);
					if(clase=="1=@unidad_medida" && claseGlobal=="unidad_medida" ){						
					}
					else if(clase=="1=@deposito" && claseGlobal=="deposito" ){						
					}
					else if(clase=="1=@movimiento" && claseGlobal=="movimiento" ){		
						//alert("no hay nada");
						conexionPHP_mat('formulario.php',claseGlobal);
					}
					else if(clase=="1=@mat_padre" && claseGlobal=="mat_padre" ){						
					}
					else if(clase=="1=@familia" && claseGlobal=="familia" ){						
					}
					else if(clase=="1=@tipo_entidad" && claseGlobal=="tipo_entidad" ){						
					}
					else if(clase=="1=@vista_entidad" && claseGlobal=="entidad" ){						
					}else if(clase=="1=@persona" && claseGlobal=="entidad" ){						
					}
					else if(clase=="1=@tipo_movimiento" && claseGlobal=="tipo_movimiento" ){						
					}
					else if(clase=="1=@proveedor" && claseGlobal=="proveedor" ){						
					}
					else if(clase=="1=@mat_prov" && claseGlobal=="mat_prov" ){						
					}
					else if(clase=="2=@vista_materiales" && (claseGlobal=="movimiento" || claseGlobal=="final_ordenes_tecnicos") ){	
						//alert("no hay nada");
						document.f1.numero_m.value="";
						val1=document.getElementById("numero_mat").value;
						val2=document.getElementById("nombre_mat").value;
						agregar_ma_movit();
						document.getElementById("numero_mat").value=val1;
						document.getElementById("nombre_mat").value=val2;
					}
					else if(clase=="2=@vista_materiales_orden" && claseGlobal=="final_ordenes_tecnicos" ){
						document.f1.numero_m.value="";
						val1=document.getElementById("numero_mat").value;
						val2=document.getElementById("nombre_mat").value;
						agregar_ma_movit_orden();
						document.getElementById("numero_mat").value=val1;
						document.getElementById("nombre_mat").value=val2;
					}
					else if(clase=="1=@motivo_inv" && claseGlobal=="motivo_inv" ){						
					}
					else if(clase=="2=@pedido" && claseGlobal=="pedido" ){						
						
						var prove=document.f1.id_prov.value;
						deseleccionarTodoPedido();
						document.f1.reset();
						document.f1.id_prov.value=prove;
						document.f1.id_ped.value=idglobal;
						document.f1.modificar.disabled=true;
						document.f1.registrar.disabled=false;
					}
					else if(clase=="2=@vista_materiales" && claseGlobal=="busquedad_m" ){
						alert("el material no esta registrado en este deposito");
						document.f1.buscar.disabled=true;
						document.f1.imprimir.disabled=true;
						document.f1.numero_mat.value='';
						document.f1.nombre_mat.value='';
						document.f1.id_m.value='';
						document.f1.id_mat.value='';
					}
					else{
						boton_mat(false,true,true,claseGlobal);
					}
					
					
					if(clase=="2=@vista_materiales" && claseGlobal=="materiales" ){
						document.f1.id_mat.value=idglobal;
						limpiar_mat_dep();
					}else if(clase=="1=@mat_padre" && claseGlobal=="materiales" ){
						document.f1.id_mat.value=idglobal;
					//	document.f1.numero_mat.value=numglobal;
						document.f1.id_m.value=id_mglobal;
						//id_mglobal=id_m();
						limpiar_mat_dep();
					}
					else if(clase=="1=@personausuario"){
						codigo=document.f1.cedula.value;
						document.f1.cedula.value=codigo;
					}
					else if(clase=="1=@usuario")
					{
						login=document.f1.login.value;
						document.f1.login.value=login;
					}
				/*	else if(clase=="1=@persona" && claseGlobal="entidad"){
						var cedula=document.f1.cedula.value;
						document.f1.reset();
						document.f1.cedula.value=cedula;
					}
					else if(clase=="1=@persona"){
						var cedula=document.f1.cedula.value;
						document.f1.reset();
						document.f1.cedula.value=cedula;
					}
					*/
				}
			}
			else
				alert("ERROR DEL SISTEMA: "+cadena);
	  break;
	  case "Seguridad/Seguridad.php":
			if(clase=='IniciarSesion'){
				if(cadena!="false"){
					cargarModulos_mat(cadena);
					conexionPHP_mat("validarExistencia.php","1=@personausuario","login=@"+loginUsuario,'hola');
				}
				else{
					alert("Error, el Usuario y/o Contraseña ingresados no son validos.	Por favor intente de nuevo.");
				}
			}
			else if(clase=='CerrarSesion'){
				if(cadena=="true")
					cerrarSesion_mat();
			}
			else if(clase=='Sesion'){
				capa.innerHTML=cadena;
			}
	  break;
	  default:
		respuestaPHPAplicaTem(archivoPHP,clase,cadena,mensaje);
	}
}