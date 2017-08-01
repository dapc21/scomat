function nuevoAjax(){
	var xmlhttp=false;
	try{
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
				}
				else{
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
			
			else if(clase=="traerZona"){
				cade= cadena.split("=@");
				document.f1.id_zona.value=cade[1];
				document.f1.id_franq.value=cade[2];
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
			else{
				capa.innerHTML=cadena;			
			}
	  break;
	}
}


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


function id_persona(){return document.f1.id_persona.value;}
function cedula(){return document.f1.cedula.value;}
function nombre(){return document.f1.nombre.value;}
function name(){return document.f1.name.value;}
function apellido(){return document.f1.apellido.value;}
function email(){return document.f1.email.value;}
function telefono(){return document.f1.telefono.value;}

function telf_casa(){return document.f1.telf_casa.value;}
function telf_adic(){return document.f1.telf_adic.value;}
function numero_casa(){return document.f1.numero_casa.value;}
function edificio(){return document.f1.edificio.value;}
function numero_piso(){return document.f1.numero_piso.value;}
function id_edif(){return document.f1.id_edif.value;}
function cli_id_persona(){return document.f1.cli_id_persona.value;}
function id_calle(){return document.f1.id_calle.value;}
function fecha_contrato(){return document.f1.fecha_contrato.value;}
function etiqueta(){return document.f1.etiqueta.value;}
function costo_contrato(){return document.f1.costo_contrato.value;}
function status_pago(){return document.f1.status_pago.value;}
function id_zona(){return document.f1.id_zona.value;}
function id_calle(){return document.f1.id_calle.value;}
function id_sector(){return document.f1.id_sector.value;}
function id_franq(){return document.f1.id_franq.value;}
function postel(){return document.f1.postel.value;}
function taps(){return document.f1.taps.value;}
function pto(){return document.f1.pto.value;}
function nro_contrato(){return document.f1.nro_contrato.value;}


function cargarZona(){
	conexionPHP('informacion.php',"cargarZona",id_franq());
}
function cargarZona_franq(){
	conexionPHP('informacion.php',"cargarZona_franq",id_franq());
}
function traerFranq(){
	conexionPHP('informacion.php',"traerFranq",id_zona());
}
function traerFranqSer(){
	conexionPHP('informacion.php',"traerFranqSer",id_tipo_servicio());
}
function cargarSector(){
	conexionPHP('informacion.php',"cargarSector",id_zona());
}
function cargarCalle(){
	conexionPHP('informacion.php',"cargarCalle",id_sector());
}
function traerZona_solo(){
	conexionPHP('informacion.php',"traerZona",id_sector());
	
}
function traerZona(){
	conexionPHP('informacion.php',"traerZona",id_sector());
	cargarCalle();
}
function traerSector(){
	conexionPHP('informacion.php',"traerSector",id_calle());
	
}
function traerCalle(){
	conexionPHP('informacion.php',"traerCalle",edificio());
}
function cargarEdif(){
	conexionPHP('informacion.php',"cargarEdif",id_calle());
}

function buscarContAvanz_todo(){
	var fecha='';
	var val=true;
	if(fecha_contrato()!=''){
		if(valdate(fecha_contrato())){
			fecha=formatdate(fecha_contrato())
		}
		else{
			val=false;
			document.f1.fecha_contrato.value='';
			fecha='';
		}
	}
	else{
		fecha='';
	}
	archivoDataGrid="busqueda/busq_cont_avanz_todo.php?&cedula="+cedula()+"&nombre="+nombre()+"&apellido="+apellido()+"&nro_contrato="+nro_contrato()+"&etiqueta="+etiqueta()+"&fecha_contrato="+fecha+"&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&numero_casa="+numero_casa()+"&telefono="+telefono()+"&telf_casa="+telf_casa()+"&status_contrato="+document.f1.status_contrato.value+"&id_g_a="+document.f1.id_g_a.value+"&cod_id_persona="+document.f1.cod_id_persona.value+"&id_persona="+document.f1.id_persona.value+"&postel="+document.f1.postel.value+"&contrato_fisico="+document.f1.contrato_fisico.value+"&";
	if(val==true){
		updateTable();
	}
}
function buscarContAvanz(){
	var fecha='';
	var val=true;
	if(fecha_contrato()!=''){
		if(valdate(fecha_contrato())){
			fecha=formatdate(fecha_contrato())
		}
		else{
			val=false;
			document.f1.fecha_contrato.value='';
			fecha='';
		}
	}
	else{
		fecha='';
	}
	archivoDataGrid="busqueda/busq_cont_avanz.php?&cedula="+cedula()+"&nombre="+nombre()+"&apellido="+apellido()+"&nro_contrato="+nro_contrato()+"&etiqueta="+etiqueta()+"&fecha_contrato="+fecha+"&id_franq="+id_franq()+"&id_zona="+id_zona()+"&id_sector="+id_sector()+"&id_calle="+id_calle()+"&numero_casa="+numero_casa()+"&telefono="+telefono()+"&telf_casa="+telf_casa()+"&status_contrato="+document.f1.status_contrato.value+"&id_g_a="+document.f1.id_g_a.value+"&cod_id_persona="+document.f1.cod_id_persona.value+"&id_persona="+document.f1.id_persona.value+"&postel="+document.f1.postel.value+"&contrato_fisico="+document.f1.contrato_fisico.value+"&";
	if(val==true){
		updateTable();
	}
}
function respBuscarContAvanz_todo(id_contrato){
	parent.conexionPHP("validarExistencia.php","1=@vista_contrato_todo","id_contrato=@"+id_contrato);
	parent.dhxWins.window("w2").close();
	
}
function respBuscarContAvanz1(id_contrato){
	parent.conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+id_contrato);
	parent.dhxWins.window("w2").close();
	
}
function respBuscarContAvanz(nro_contrato){
	parent.conexionPHP("validarExistencia.php","1=@vista_contrato","nro_contrato=@"+nro_contrato);
	parent.dhxWins.window("w2").close();
	
}

function buscarC(evt)
{
	
	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
	((evt.which) ? evt.which : 0));
	//alert(charCode);
	if (charCode == 13){
		buscarContAvanz();
	}
	else{
		return true;
	}
}


function buscarC_todo(evt)
{
	
	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
	((evt.which) ? evt.which : 0));
	//alert(charCode);
	if (charCode == 13){
		buscarContAvanz_todo();
	}
	else{
		return true;
	}
}



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

function valdate(fecha){
	if(fecha!='')
	{
		var date=fecha.split("/");
		if(date.length==3)
		{
			if(date[2].length!=4 || date[1].length!=2 || date[0].length!=2)
			{
				alert('Error, debe introducir una fecha en este formato  DD/MM/AAAA');
				return false;
			}
			else{
				return true;
			}
		}
		else{
			alert('Error, debe introducir una fecha en este formato  DD/MM/AAAA');
			return false;
		}
	}
	else{
		alert('Error, debe introducir una fecha valida en este formato  DD/MM/AAAA');
			return false;
	}
}

function formatdate(fecha){
	var date=fecha.split("/");
	var result=date[2]+'-'+date[1]+'-'+date[0]; 
	//alert(result);
	return result;
}
function formatdatei(fecha){
	var date=fecha.split("-");
	var result=date[2]+'/'+date[1]+'/'+date[0]; 
	//alert(result);
	return result;
}