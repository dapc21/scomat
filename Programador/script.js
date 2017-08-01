//Funciones para Generador de Reportes
var tablas="";
var campos="";
var condicion="";
var orden="";
var camposDisp="";
var aliasCampos="";
var CamposViejos="";
var consultaSQL="";
var valSQL=false;
var priSQL=false;
var nombreGlobal="";
var titulo="";
var cabecera="";
var pie="";
var vista="false";
var reporte="false";
/*|||||||||||||||||||||||||||||||||||||||||FUNCIONES CORRESPONDIENTES AL GENERADOR DE MODULOS||||||||||||||||||||||||||||||||||||||||||||*/
function verificarAplicaTem(tipoDato,clase)
{
  switch(clase)
  {
	//clase o tabla usuario
	case "Modulo":
		if(validaCampo(document.f1.codigo,isAlphanumeric) &&
		validaCampo(document.f1.nombre,isTexto) &&
		validaCampo(document.f1.descripcion,isTexto))
		{
			if(confirm('¿seguro que desea enviar este formulario?')){
			/*
				// para activa el programador de AplicaTem
			  if(nombreModulo!='Modulo' && nombreModulo!='Perfil' && nombreModulo!='Usuario' && nombreModulo!='CreaFormulario')
			  {
				conexionPHP("administrar.php","ModuloPerfil","=@"+codigo()+"=@=@=@=@","eliminarModulo");
				if(tipoDato!='modificar')
				{
					if(tipoDato=="incluir"){
						*/
						conexionPHP("Programador/Programador.php","crearClase",trim(name().toLowerCase())+"=@"+verdatagrip());
				/*	}
					else if(tipoDato=="eliminar"){
						conexionPHP("Programador/Programador.php","EliminarClase",name());
					}
				}
			  }
				
				if(tipoDato!="eliminar")
				{
					//para incluir los modulos
					cambiarModulo("incluir",clase); 
				}
				conexionPHP("administrar.php",clase,codigo()+"=@"+nombre()+"=@"+descripcion()+"=@"+verStatus()+"=@"+name(),tipoDato);
				*/
			}
		}
		break;
	case "Configuracion":
	  if(validaCampo(document.f1.servidor,isAlphanumeric) &&
		validaCampo(document.f1.login,isAlphanumeric) && 
		validaCampo(document.f1.database,isAlphanumeric)){
			conexionPHP("Programador/Programador.php",clase,verManejador()+"=@"+servidor()+"=@"+usuario()+"=@"+password()+"=@"+database()+"=@"+verdatagrip());
		}
		break;
	case "Limpiador":
		if(verCheck()!='' && validaCampo(document.f1.codigomodulo,isSelect)){
			conexionPHP("Programador/Programador.php",'Limpiador',codigoModulo()+verCheck());
		}
		break;
	default:
		alert("ERROR, no esiste la Clase"); 
  }
}

function respuestaPHPAplicaTem(archivoPHP,clase,cadena,mensaje){
	//para limpiar la basura de la cadena
	cadena=limpiar(cadena);
	var arg=respuestaPHP.arguments.length;	
	var capa=document.getElementById("principal");
	//para saber de que archivo o ruta extrajola respuesta
	switch(archivoPHP)
	{
	  //APLICATEM - los case siguientes son propios de aplicatem
	  case "../informacion.php":
			if(clase=="ObjetoFormulario"){
				traerDatos(cadena);
			}
	  break;
	  case "creaFormulario.php":
			capa.innerHTML=cadena;
	  break;
	  case "Programador/creaFormulario.php":
			claseGlobal=clase;
			capa.innerHTML=cadena;
			if(clase!='Plantilla')
				PermisionFormulario(clase);
			if(clase=="Configuracion"){
				conexionPHP("informacion.php","Manejador");
			}
			else if(clase=="GenerarReportes"){
				if(tablas!=""){
					RespantallaRep1();
				}
			}
			else if(clase=="pantallaRep2"){
			
				if(condicion!=""){
					RespantallaRep2();
				}
				else if(campos!=""){
					RespantallaRep2();
				}
				else{
					conexionPHP("informacion.php","camposRep2",tablas);
				}
			}
			else if(clase=="pantallaRep3"){
				CargarCampos();
				if(condicion!="")
					RespantallaRep3();
			}
			else if(clase=="pantallaRep4"){
				priSQL=false;
				CargarCamposOrden();
				if(orden!="")
					RespantallaRep4();
			}
			else if(clase=="pantallaRep5"){
				var campo= tablas.split("=@");
				if(campo.length>1){
					document.form1.vista[0].checked=1;
					document.form1.vista[0].disabled=true;
				}
				if(campo.length==1){
					document.form1.vista[0].checked=0;
					document.form1.vista[0].disabled=true;
				}
				priSQL=false;
				CargarSQL();
				if(nombreGlobal!="")
					RespantallaRep5();
			}
			else if(clase=="pantallaRep6"){
				priSQL=false;
				CargarCamposListar();
				if(CamposViejos!="")
					RespantallaRep6();
			}
	  break;
	  case "Programador/Programador.php":
		if(clase=='crearClase' || clase=='EliminarClase' || clase=='modificarClase'  || clase=='restaurarDataBase'){}
		else{
			if (cadena=="true"){
				alert( "TRANSACCIÓN COMPLETADA CON EXITO ");
				if(clase=="Configuracion" || clase=="Plantillas" || clase=="Temas"  || clase=="GenerarReporte"){
					javascript:location.reload();
				}
			}
			else
					alert( "ERROR DURANTE TRANSACCIÓN VUELVA A INTENTARLO");
				
		}
	  break;
	  case "Programador.php":
			if (cadena=="true"){
				alert( "TRANSACCIÓN COMPLETADA CON EXITO ");
			}
			else
				alert( "ERROR DURANTE TRANSACCIÓN: "+cadena);
	  break;
	  default:
		alert("ERROR, no esiste el archivo: "+archivoPHP); 
	}
}

/*|||||||||||||||||||||||||||||||||||||||||FUNCIONES CORRESPONDIENTES AL GENERADOR DE REPORTES||||||||||||||||||||||||||||||||||||||||||||*/
function CargarSQL(){
	var tab=tablas.replace(/=@/g, ", "); 
	var cam=campos.replace(/=@/g, ", ");
	var con=condicion.replace(/=@/g, " and ");
	var ord=orden.replace(/=@/g, ",");
	if(con!='')
		con=" where "+con;
	if(ord!='')
		ord=" order by "+ord;
	consultaSQL="select "+cam+" from "+tab+con+ord;
	document.form1.consulta.value=consultaSQL;
	validarSQL();
}

function eliminarCamposRepetidos(){
	var verdad=false;
	var selec= document.form1.consulta.value.split("select ");
	var from= selec[1].split(" from ");
	var campo= from[0].split(", ");
	var len1 = campo.length;
	var camposR="";
	for(i=0;i<len1;i++)
	{
		var repetir=false;
		var nue= camposR.split("=@");
		for(k=0;k<nue.length;k++){
			if(nue[k]==campo[i])
				repetir=true;
		}
		if(repetir==false){
			var cam= campo[i].split(".");
			for(j=0;j<len1;j++)
			{
				if(campo[i]!=campo[j]){
					var ca= campo[j].split(".");
					if(cam[1]==ca[1]){
						if(verdad==false)
							camposR=campo[j];
						else
							camposR=camposR+"=@"+campo[j];
						verdad=true;
					}
				}
			}
		}
	}
	var nuevo=from[0];
	
	var nue= camposR.split("=@");
	for(i=0;i<nue.length;i++){
		verdad=false;
		campo= nuevo.split(", ");
		for(j=0;j<campo.length;j++){
			if(nue[i]!=campo[j]){
				if(verdad==false)
					nuevo=campo[j];
				else
					nuevo=nuevo+", "+campo[j];
				verdad=true;
			}
		}
	}
	consultaSQL="select "+nuevo+" from "+from[1];
	document.form1.consulta.value=consultaSQL;
}
function validarSQL(){
	var verdad=false;
	var selec= document.form1.consulta.value.split("select ");
	var from= selec[1].split(" from");
	var campo= from[0].split(",");
	var len1 = campo.length;
	for(i=0;i<len1;i++)
	{
		var cam= campo[i].split(".");
		for(j=0;j<len1;j++)
		{
			if(campo[i]!=campo[j]){
				var ca= campo[j].split(".");
				if(cam[1]==ca[1]){
					verdad=true;
					break;
				}
			}
		}
	}
	if(verdad==true){
		if (confirm('Error, En la Consulta hay Campos Repetidos. ¿Desea Eliminarlos?')){
			eliminarCamposRepetidos();
		}
	}
	else{
		conexionPHP('informacion.php','validarSQL',document.form1.consulta.value);
	}
}
function GenerarReporte(){
	var verdad=false;
	var cad="";
	var num=document.form1.fields.options.length;
	if(num<2){
		alert("Error Debe Seleccionar al menos dos Campos");
	}
	else{
		for(i=0;i<num;i++)
		{
			if(!verdad)
				cad=document.form1.fields[i].value;
			else
				cad=cad+"=@"+document.form1.fields[i].value;
			verdad=true;
		}
		aliasCampos=cad;
		
		var num=document.form1.AllFields.options.length;
		cad="";
		for(i=0;i<num;i++)
		{
			cad=cad+"<option value='"+document.form1.AllFields[i].value+"'>"+document.form1.AllFields[i].value+"</option>";
		}
		CamposViejos=cad;
		if (confirm('¿seguro que desea Generar el Reporte?')){
			conexionPHP("Programador/Programador.php",'GenerarReporte',tablas+"=@="+campos+"=@="+condicion+"=@="+orden+"=@="+aliasCampos+"=@="+consultaSQL+"=@="+nombreGlobal+"=@="+titulo+"=@="+cabecera+"=@="+pie+"=@="+vista+"=@="+reporte);
		}
	}
}

function limpiarTablas(){
campos="";
limpiarCampos();
}
function limpiarCampos(){
 condicion="";
 orden="";
 camposDisp="";
 aliasCampos="";
 CamposViejos="";
 consultaSQL="";
 valSQL=false;
 priSQL=false;
 nombreGlobal="";
 titulo="";
 cabecera="";
 pie="";
 vista="false";
 reporte="false";
}

function RespantallaRep1(){
	var verdad=false;
	var cad="";
	
	var campo= tablas.split("=@");
	var len1 = campo.length;
	for(j=0;j<len1;j++)
	{
		
		for (i=0;i<document.f1.tablas.length;i++){
			
	        if(document.f1.tablas[i].value == campo[j]){
				document.f1.tablas[i].checked=1;
			}
	    }
	}
}
function RespantallaRep2(){
	document.getElementById("AllFields").innerHTML=camposDisp;	
	var campo= campos.split("=@");
	var len1 = campo.length;
	for(i=0;i<len1;i++)
	{
		 var element = campo[i];
		 var len2 = document.form1.fields.length;
		 document.form1.fields.options[len2] =  new Option(element,element,false,false);
	}
	
}
function RespantallaRep3(){
	var campo= condicion.split("=@");
	var len1 = campo.length;
	for(i=0;i<len1;i++)
	{
		 var element = campo[i];
		 var len2 = document.form1.fields.length;
		 document.form1.fields.options[len2] =  new Option(element,element,false,false);
	}
	
}
function RespantallaRep4(){
	var campo= orden.split("=@");
	var len1 = campo.length;
	for(i=0;i<len1;i++)
	{
		 var element = campo[i];
		 var len2 = document.form1.fields.length;
		 document.form1.fields.options[len2] =  new Option(element,element,false,false);
	}
	
}
function RespantallaRep6(){
	document.getElementById("AllFields").innerHTML=CamposViejos;	
	
	var index = document.form1.AllFields.selectedIndex;
	var choice = document.form1.AllFields.options[index].text;
	 
	var cam= choice.split(".");
	document.form1.nombre.value=ucWords(cam[1]);
	
	var campo= aliasCampos.split("=@");
	var len1 = campo.length;
	for(i=0;i<len1;i++)
	{
		 var element = campo[i];
		 var len2 = document.form1.fields.length;
		 document.form1.fields.options[len2] =  new Option(element,element,false,false);
	}
	
}
function RespantallaRep5(){
	
			document.form1.nombre.value=nombreGlobal;
			document.form1.titulo.value=titulo;
			document.form1.cabecera.value=cabecera;
			document.form1.pie.value=pie;
			if(vista=="true")
				 document.form1.vista[0].checked=1;
			else
				 document.form1.vista[0].checked=0;
			if(reporte=="true")
				 document.form1.vista[1].checked=1;
			else
				 document.form1.vista[1].checked=0;
				
			
}
function cargarTablasRep6(){
	var verdad=false;
	var cad="";
	var num=document.form1.fields.options.length;

		for(i=0;i<num;i++)
		{
			if(!verdad)
				cad=document.form1.fields[i].value;
			else
				cad=cad+"=@"+document.form1.fields[i].value;
			verdad=true;
		}
		aliasCampos=cad;
		var num=document.form1.AllFields.options.length;
		cad="";
		for(i=0;i<num;i++)
		{
			cad=cad+"<option value='"+document.form1.AllFields[i].value+"'>"+document.form1.AllFields[i].value+"</option>";
		}
		CamposViejos=cad;
}



function cambiarNombreRep()
{
    var index = document.form1.AllFields.selectedIndex;
	var choice = document.form1.AllFields.options[index].text;
	
	var cam= choice.split(".");
	document.form1.nombre.value=ucWords(cam[1]);  
}
function moveRenombre()
{
    var index = document.form1.AllFields.selectedIndex;
	var choice = document.form1.AllFields.options[index].text;
	var len = document.form1.fields.length;
	choice=choice+"->"+document.form1.nombre.value;
	document.form1.fields.options[len] = new Option(choice,choice,false,false);
	document.form1.AllFields.remove(index);
	
	var num=document.form1.AllFields.options.length;
	if(num>0){
		var cam= document.form1.AllFields.options[index].text.split(".");
		document.form1.nombre.value=ucWords(cam[1]);  
	}
	else{
		document.form1.nombre.value="";
		document.form1.agregar.disabled=true;
	}
}
function eliminarListar()
{
	 var index = document.form1.fields.selectedIndex;
	 var choice = document.form1.fields.options[index].text;
	 	document.form1.fields.remove(index);
	
	var camp= choice.split("->");
	var ca= camp[0];
	
	var len = document.form1.AllFields.length;
	document.form1.AllFields.options[len] = new Option(ca,ca,false,false);
	if(len==0){
		var cam= ca.split(".");
		document.form1.nombre.value=ucWords(cam[1]);
	}
	document.form1.agregar.disabled=false;
}
function CargarCamposListar()
{
	var campo= campos.split("=@");

	var len1 = campo.length;
	for(i=0;i<len1;i++)
	{
		 var element = campo[i];
		 var len2 = document.form1.AllFields.length;
		 document.form1.AllFields.options[len2] =  new Option(element,element,false,false);
	}
	var cam= campo[0].split(".");
	document.form1.nombre.value=ucWords(cam[1]);
}
function anteriorTablas5(){
			nombreGlobal=document.form1.nombre.value;
			titulo=document.form1.titulo.value;
			cabecera=document.form1.cabecera.value;
			pie=document.form1.pie.value;
			if(document.form1.vista[0].checked == true){
				vista="true";
			}
			else
				vista="false";
			if(document.form1.vista[1].checked == true){
				reporte="true";
			}
			else
				reporte="false";

}
function cargarTablasRenombre(){
	if(validaCampo(document.form1.nombre,isName) &&
		validaCampo(document.form1.titulo,isTexto) &&
		validaCampo(document.form1.consulta,isTexto) && validavalSQL())
		{
			nombreGlobal=document.form1.nombre.value;
			titulo=document.form1.titulo.value;
			cabecera=document.form1.cabecera.value;
			pie=document.form1.pie.value;
			if(document.form1.vista[0].checked == true){
				vista="true";
			}
			else
				vista="false";
			if(document.form1.vista[1].checked == true){
				reporte="true";
			}
			else
				reporte="false";
				
			conexionPHP('Programador/creaFormulario.php','pantallaRep6')
		}
}
function validavalSQL(){
	if(valSQL)
		return true;
	else{
		alert("Error, debe Validar nuevamente la consulta SQL");
		return false;
	}
}
function cargarTablasRep5(){
	if(validaCampo(document.form1.nombre,isName) &&
		validaCampo(document.form1.titulo,isTexto) &&
		validaCampo(document.form1.consulta,isTexto) && validavalSQL())
		{
		}
}
function minUno(){
	
	if(document.form1.vista[0].checked == false){
		if(document.form1.vista[1].checked == false)
			document.form1.vista[1].checked=1
	}
}
function habilitarSQL(){
	valSQL=false;
	if(document.form1.consul.checked == true)
		document.form1.consulta.disabled=false;
	else 
		document.form1.consulta.disabled=true;
}

function anteriorTablas4(){
	var verdad=false;
	var cad="";
	var num=document.form1.fields.options.length;
	
		for(i=0;i<num;i++)
		{
			if(!verdad)
				cad=document.form1.fields[i].value;
			else
				cad=cad+"=@"+document.form1.fields[i].value;
			verdad=true;
		}
		orden=cad;
}
function cargarTablasRep4(){
	var verdad=false;
	var cad="";
	var num=document.form1.fields.options.length;
	
		for(i=0;i<num;i++)
		{
			if(!verdad)
				cad=document.form1.fields[i].value;
			else
				cad=cad+"=@"+document.form1.fields[i].value;
			verdad=true;
		}
		orden=cad;
		conexionPHP('Programador/creaFormulario.php','pantallaRep5')
}
function CamposRepetidosOrden()
{
	var index = document.form1.AllFields.selectedIndex;
	var choice = document.form1.AllFields.options[index].text;
	 
  	 var len1 = document.form1.fields.length;
	for(i=0;i<len1;i++)
	{
		var element = document.form1.fields.options[i].text;
		var campo= element.split(" ");
		if(campo[0]==choice){
				return true;
		}
		
	}
	return false;
}
function verOrden(){
	if (document.form1.orden[0].checked)
		return document.form1.orden[0].value;
	else
		return document.form1.orden[1].value;
}
function moveOrden()
{
  if(CamposRepetidosOrden()==false){
	
	 var index = document.form1.AllFields.selectedIndex;
	 if(index != -1)
	 {
		 var choice = document.form1.AllFields.options[index].text;
		 	 var len = document.form1.fields.length;
			 choice=choice+" "+verOrden();
			 document.form1.fields.options[len] = new Option(choice,choice,false,false);
			 document.form1.AllFields.options[0].selected = true;
	 }
	 else
	 {
	  document.form1.fields.options[0].selected = true;
	 }
  }
  else{
	alert("Error, el campo ya tiene asignado un orden");
  }
}
function anteriorTablas3(){
	var verdad=false;
	var cad="";
	var num=document.form1.fields.options.length;
	
		for(i=0;i<num;i++)
		{
			if(!verdad)
				cad=document.form1.fields[i].value;
			else
				cad=cad+"=@"+document.form1.fields[i].value;
			verdad=true;
		}
		condicion=cad;
}
function cargarTablasRep3(){
	var verdad=false;
	var cad="";
	var num=document.form1.fields.options.length;
	
		for(i=0;i<num;i++)
		{
			if(!verdad)
				cad=document.form1.fields[i].value;
			else
				cad=cad+"=@"+document.form1.fields[i].value;
			verdad=true;
		}
		condicion=cad;
		conexionPHP('Programador/creaFormulario.php','pantallaRep4')
}

function eliminarCondicion()
{
	 var index = document.form1.fields.selectedIndex;
	 if(index != -1)
	 {
		document.form1.fields.remove(index);
	  }
	  else
	  {
	    document.form1.AllFields.options[0].selected = true;
	  }
}

function CamposRepetidos()
{
	var repetido=false;
	var index = document.form1.AllFields.selectedIndex;
	var index1 = document.form1.AllFields1.selectedIndex;
	var choice = document.form1.AllFields.options[index].text;
	var choice1 = document.form1.AllFields1.options[index1].text;
	 
  	 var len1 = document.form1.fields.length;
	for(i=0;i<len1;i++)
	{
		var element = document.form1.fields.options[i].text;
		var campo= element.split(" = ");
		if(campo[0]==choice){
			if(campo[1]==choice1){
				repetido=true;
				return true;
			}
		}
		if(campo[0]==choice1){
			if(campo[1]==choice){
				repetido=true;
				return true;
			}
		}
	}
	return false;
}
function moveCondicion()
{
  if(CamposRepetidos()==false){
	
	 var index = document.form1.AllFields.selectedIndex;
	 var index1 = document.form1.AllFields1.selectedIndex;
	 if(index != -1)
	 {
		 var choice = document.form1.AllFields.options[index].text;
		 var choice1 = document.form1.AllFields1.options[index1].text;
		 if(choice!=choice1){
			 var len = document.form1.fields.length;
			 choice=choice+" = "+choice1;
			 document.form1.fields.options[len] = new Option(choice,choice,false,false);
			 document.form1.AllFields.options[0].selected = true;
			 document.form1.AllFields1.options[0].selected = true;
		 }
		 else{
			alert("Error,  no se permite campos iguales en la condicion");
		 }
	 }
	 else
	 {
	  document.form1.fields.options[0].selected = true;
	 }
  }
  else{
	alert("Error, la condicion ya existe, debe seleccionar nuevos campos");
  }
}
function CargarCampos()
{
	var campo= campos.split("=@");

	var len1 = campo.length;
	for(i=0;i<len1;i++)
	{
		 var element = campo[i];
		 var len2 = document.form1.AllFields.length;
		 document.form1.AllFields.options[len2] =  new Option(element,element,false,false);
		 var len2 = document.form1.AllFields1.length;
		 document.form1.AllFields1.options[len2] =  new Option(element,element,false,false);
	}
}
function CargarCamposOrden()
{
	var campo= campos.split("=@");

	var len1 = campo.length;
	for(i=0;i<len1;i++)
	{
		 var element = campo[i];
		 var len2 = document.form1.AllFields.length;
		 document.form1.AllFields.options[len2] =  new Option(element,element,false,false);
	}
}

function cargarTablasRep(){
	var verdad=false;
	var cad="";
	for (i=0;i<document.f1.tablas.length;i++){
        if(document.f1.tablas[i].checked == true){
			if(!verdad)
				cad=document.f1.tablas[i].value;
			else
				cad=cad+"=@"+document.f1.tablas[i].value;
			verdad=true;
		}
    }
	if(verdad){
		if(tablas!=cad){
			limpiarTablas();
		}
		tablas=cad;
		conexionPHP('Programador/creaFormulario.php','pantallaRep2')
	}
	else{
		alert("Error, Debe seleccionar al menos una tabla");
	}
}
function anteriorTablas2(){
	var verdad=false;
	var cad="";
	var num=document.form1.fields.options.length;
	
		for(i=0;i<num;i++)
		{
			if(!verdad)
				cad=document.form1.fields[i].value;
			else
				cad=cad+"=@"+document.form1.fields[i].value;
			verdad=true;
		}
		campos=cad;
		
		var num=document.form1.AllFields.options.length;
		cad="";
		for(i=0;i<num;i++)
		{
			cad=cad+"<option value='"+document.form1.AllFields[i].value+"'>"+document.form1.AllFields[i].value+"</option>";
		}
		camposDisp=cad;
}
function cargarTablasRep2(){
	var verdad=false;
	var cad="";
	var num=document.form1.fields.options.length;
	if(num<2){
		alert("Error Debe Seleccionar al menos dos Campos");
	}
	else{
		for(i=0;i<num;i++)
		{
			if(!verdad)
				cad=document.form1.fields[i].value;
			else
				cad=cad+"=@"+document.form1.fields[i].value;
			verdad=true;
		}
		if(campos!=cad){
			limpiarCampos();
		}
		campos=cad;
		
		var num=document.form1.AllFields.options.length;
		cad="";
		for(i=0;i<num;i++)
		{
			cad=cad+"<option value='"+document.form1.AllFields[i].value+"'>"+document.form1.AllFields[i].value+"</option>";
		}
		camposDisp=cad;
		conexionPHP('Programador/creaFormulario.php','pantallaRep3')
	}//else
}

function movel2R()
{
 var index = document.form1.AllFields.selectedIndex;
 if(index != -1)
 {
 var choice = document.form1.AllFields.options[index].text;

 var len = document.form1.fields.length;
 document.form1.fields.options[len] = new Option(choice,choice,false,false);
 document.form1.AllFields.remove(index);
 document.form1.AllFields.options[0].selected = true;
 }
 else
 {
  document.form1.fields.options[0].selected = true;
 }
}

function moveR2l()
{
 var index = document.form1.fields.selectedIndex;
 if(index != -1)
 {
 var choice = document.form1.fields.options[index].text;

 var len = document.form1.AllFields.length;
 document.form1.AllFields.options[len] = new Option(choice,choice,false,false);
 document.form1.fields.remove(index);
 document.form1.fields.options[0].selected = true;
    }
  else
  {
    document.form1.AllFields.options[0].selected = true;
  }

}


function MoveAllRight()
{


var len1 = document.form1.AllFields.length;
for(i=0;i<len1;i++)
{
 var element = document.form1.AllFields.options[i].text;
 var len2 = document.form1.fields.length;
 document.form1.fields.options[len2] =  new Option(element,element,false,false);
}
document.form1.AllFields.length= 0;
}

function MoveAllLeft()
{


var len1 = document.form1.fields.length;
for(i=0;i<len1;i++)
{
 var element = document.form1.fields.options[i].text;
 var len2 = document.form1.AllFields.length;
 document.form1.AllFields.options[len2] =  new Option(element,element,false,false);
}
document.form1.fields.length= 0;
}

function SelectAll ()
{
 var len = document.form1.fields.length;
 for(i=0;i<len;i++)
 {
   document.form1.fields.options[i].selected = true;
 }
}

function ucWords(string){
 var arrayWords;
 var returnString = "";
 var len;
 arrayWords = string.split(" ");
 len = arrayWords.length;
 for(i=0;i < len ;i++){
  if(i != (len-1)){
   returnString = returnString+ucFirst(arrayWords[i])+" ";
  }
  else{
   returnString = returnString+ucFirst(arrayWords[i]);
  }
 }
 return returnString;
}
function ucFirst(string){
 return string.substr(0,1).toUpperCase()+string.substr(1,string.length).toLowerCase();
}

function ActivarCheckRep(){
	for (i=0;i<document.f1.tablas.length;i++){
         document.f1.tablas[i].disabled=false
    }
}
function DesactivarCheckRep(){
	for (i=0;i<document.f1.tablas.length;i++){
         document.f1.tablas[i].disabled=true;
    }
}

/*|||||||||||||||||||||||||||||||||||||||||FUNCIONES CORRESPONDIENTES A LA CREACION DE FORMULARIOS||||||||||||||||||||||||||||||||||||||||||||*/
function configuracionGeneral()
{
			var cad='';
			cad=cad+'<li id="imagen"><a href="#" onclick="conexionPHP(\'Programador/creaFormulario.php\',\'Configuracion\')">Base de Datos</a></li>';
			cad=cad+'<li id="imagen"><a href="#" onclick="conexionPHP(\'Programador/creaFormulario.php\',\'Plantillas\')">Plantillas</a></li>';
			cad=cad+'<li id="imagen"><a href="#" onclick="conexionPHP(\'Programador/creaFormulario.php\',\'Temas\')">Temas</a></li>';
			for(i=4;i<19;i++)
			{
				cad=cad+'<li id="imagen">&nbsp;</li>';
			}
			document.getElementById("funcion").innerHTML=cad;		
			conexionPHP('Programador/creaFormulario.php','Configuracion');
}
//permite cargar una ventana secundaria para agregar objetos a una clase
function abreFormulario(){
    miFormulario = window.open("Programador/Formulario.html","Formulario","Top=150,Left=400,width=410,height=400,scrollbars=yes,resizable=yes,Toolbar=yes");
    miFormulario.focus();
}
function verPlantillas(){
	var tam =document.f1.plantilla.length;
	var cad="";
	for(i=0;i<tam;i++)
	{
		if(document.f1.plantilla[i].checked)
			cad=document.f1.plantilla[i].value;
	}
	conexionPHP("Programador/Programador.php",'Plantillas',cad);
}
function verTemas(){
	var tam =document.f1.tema.length;
	var cad="";
	for(i=0;i<tam;i++)
	{
		if(document.f1.tema[i].checked)
			cad=document.f1.tema[i].value;
	}
	conexionPHP("Programador/Programador.php",'Temas',cad);
}
//APLICATEM - para cargar la plantilla de un objeto.
function cargarPlantilla(){
	if(objeto()!= 0)
		conexionPHP('formulario.php','Plantilla',objeto())		
	else
		alert("Debe Seleccionar un tipo de Objeto");
}
//APLICATEM - para cargar el formulario de un objeto
function cargarModulo(){
	if(validaCampo(document.f1.codigomodulo,isSelect))
	{
		conexionPHP("informacion.php","CargaObjeto",codigoModulo());
		document.f1.agregar.disabled=false;
		
	}
	else
		document.f1.agregar.disabled=true;
}
//APLICATEM - para traer los datos de un objeto ya registrado
function cargarRegistro(){
	if(validaCampo(document.f1.codigomodulo,isSelect))
	{
		conexionPHP("informacion.php","CargaRegistro",codigoModulo());
	}
}
//APLICATEM - asigna los datos en el div plantilla
function cargarDatos(cadena){
	var capa=document.getElementById("plantilla");
	capa.innerHTML=cadena;	
}
//APLICATEM - para cargar el formulario de limpieza
function Limpieza(){
	if(document.f1.codigomodulo.value=='limpieza')
	{
		conexionPHP("informacion.php","Limpieza");
	}
	else 
	{
		conexionPHP("informacion.php","LimpiezaModulo");
	}
}
//APLICATEM - para saber que archivo desea limpiar
function verCheck(){
	var tam = document.f1.limpieza.length;  
	//alert(tam);
	var i=0; 
	var cadena='';
	for(i=0;i<tam;i++){
			if(document.f1.limpieza[i].checked == true){
				cadena=cadena+"=@"+document.f1.limpieza[i].value;
			}
	}
	if(cadena=='')
	{
		alert('Error, debe seleccionar los archivos que desea Limpiar');
	}
	//alert(cadena);
	return cadena;
}
//APLICATEM - para saber que manejador de base de datos selecciono el usuario
function verManejador(){
	if (document.f1.manejador[0].checked)
		return document.f1.manejador[0].value;
	else if (document.f1.manejador[1].checked)
		return document.f1.manejador[1].value;
	else
		return document.f1.manejador[2].value;
}
//APLICATEM - es llamada internamente para asignar datos a una variable
function asignaNameModulo(){
	var cad=trim(nombre());
	var cade='';
	for(i=0;i<cad.length;i++)
	{
		if(cad[i]!=' ')
		{
			cade=cade+cad[i];
		}
		
	}
	document.f1.name.value=trim(cade);
}