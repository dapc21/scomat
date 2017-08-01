//funcion que permite crear el objeto Ajax.
function nuevoAjax_cas(){
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
function conexionPHP_cas(archivoPHP,clase,cadena,tipoDato){
	//devuelve el numero de parametro recibidos
	var arg=conexionPHP_cas.arguments.length;
	//crea el objeto AJAX
	var ajax=nuevoAjax_cas();
	//abre la conexion con php
	ajax.open("POST", "CAS/"+archivoPHP, true);
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
				conexionPHP_cas('Seguridad/Seguridad.php','CerrarSesion');
			}
			else{
				if(clase=="DataGrid"){
					document.getElementById(divDataGrid).innerHTML = ajax.responseText;
				}
				else{
					//Hace la llamada a respuestaPHP_cas() para que esla procesa la informacion devuelta
					if(arg==4)
						respuestaPHP_cas(archivoPHP,clase,ajax.responseText,tipoDato);
					else
						respuestaPHP_cas(archivoPHP,clase,ajax.responseText);
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
function respuestaPHP_cas(archivoPHP,clase,cadena,mensaje){
	//para limpiar la basura de la cadena
	cadena=limpiar(cadena);
	var arg=respuestaPHP_cas.arguments.length;	
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
	  case "formulario.php":
			claseGlobal=clase;
			//asigna la cadena al div principal
			//capa.innerHTML=cadena;
			abrirVentana1(cadena);	
			
			if(clase!="Sesion" && clase!="CreaFormulario" && clase!="VerDatos"  && clase!="Configuracion"){
				boton(false,true,true,claseGlobal);
			}
		if(claseGlobal=="Sesion"){
			//iniciarSesion();
		}
		if(clase=="Configuracion"){
			conexionPHP_cas("informacion.php","Manejador");
		}
		if(clase=="Broadcaster" || clase=="Channel" || clase=="Smartcard" || clase=="Product" || clase=="Purchase" || clase=="Event" || clase=="Subscription" || clase=="CASSTBBean" || clase=="ProductEvent" || clase=="CASTimeRangeBean" || clase=="Message" || clase=="NuevoModuloDataGrid"){
			params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
			archivoDataGrid="procesos/datagrid_"+clase+".php";
			updateTable_cas();
		}
		if( clase=="SubscriptionChannel"){
			listarCanalSusc();
		}
		if(clase=="NuevoModuloReporte"){}
		if(clase=='Smartcard'){
			myCalendar = new dhtmlXCalendarObject(["statusDate"]);
		}	
		if(clase=='Product'){
			myCalendar = new dhtmlXCalendarObject(["validityDateBegin","validityDateEnd","purchaseDateBegin","purchaseDateEnd"]);
		}
		if(clase=='Purchase'){
			myCalendar = new dhtmlXCalendarObject(["statusDate"]);
		}	
		if(clase=='Subscription'){
			myCalendar = new dhtmlXCalendarObject(["purchaseDateEnd","purchaseDateEnd"]);
		}	
		if(clase=='Event'){
			myCalendar = new dhtmlXCalendarObject(["broadcastBegin","broadcastEnd"]);
		}	
		if(clase=='Message'){
			myCalendar = new dhtmlXCalendarObject(["sendDate"]);
		}	
	  break;
	  case "informacion.php":
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
				asignarCampos_cas(clase,cadena);
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
			else{
				capa.innerHTML=cadena;			
			}
	  break;
	  case "administrar.php":
		if(clase!="ModuloPerfil"){
			if (cadena=="true"){
					alert( "TRANSACCIÓN COMPLETADA CON EXITO ");
					if(claseGlobal=="activateSMC" ||claseGlobal=="decreaseIPPVbalance" ||claseGlobal=="increaseIPPVbalance"){
						conexionPHP_cas('formulario.php',claseGlobal);
					}
					else if(clase=="Modulo" || clase=="Perfil" || clase=="Persona" || clase=="Broadcaster" || clase=="Channel" || clase=="Smartcard" || clase=="Product" || clase=="Purchase" || clase=="Subscription" || clase=="Event" || clase=="Subscription" || clase=="CASSTBBean" || clase=="ProductEvent" || clase=="CASTimeRangeBean" || clase=="Message" || clase=="SubscriptionChannel" || clase=="NuevoModulo"){
						conexionPHP_cas('formulario.php',clase);
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
				var tabla=clase.split("=@")				
				asignarCampos_cas(tabla[1],cadena);
				if (arg < 4){
					boton(true,false,false,claseGlobal);		
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
			else if(cadena=="false")
			{
				if (arg == 4 && clase=="1=@persona"){
						alert(mensaje);
						boton(true,true,true,claseGlobal);
				}
				else
				{
					boton(false,true,true,claseGlobal);
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
	  case "Seguridad/Seguridad.php":
			if(clase=='IniciarSesion'){
				if(cadena!="false"){
					cargarModulos(cadena);
					conexionPHP_cas("validarExistencia.php","1=@personausuario","login=@"+loginUsuario,'hola');
				}
				else{
					alert("Error, el Usuario y/o Contraseña ingresados no son validos.	Por favor intente de nuevo.");
				}
			}
			else if(clase=='CerrarSesion'){
				if(cadena=="true")
					cerrarSesion();
			}
			else if(clase=='Sesion'){
				capa.innerHTML=cadena;
			}
	  break;
	  default:
		respuestaPHPAplicaTem(archivoPHP,clase,cadena,mensaje);
	}
}