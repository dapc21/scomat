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
function conexionPHP(archivoPHP,clase,cadena,tipoDato){
	//devuelve el numero de parametro recibidos
	var arg=conexionPHP.arguments.length;
	//crea el objeto AJAX
	var ajax=nuevoAjax();
	//abre la conexion con php
	ajax.open("POST", archivoPHP, true);
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
				alert( "Error. Intento de Violación de Seguridad, la Sesion será reiniciada");
				conexionPHP('formulario.php','Sesion');
				
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

function respuestaPHP(archivoPHP,clase,cadena,mensaje){
	
	var arg=respuestaPHP.arguments.length;	
	var capa=document.getElementById("principal");
	//para saber de que archivo o ruta extrajola respuesta
	switch(archivoPHP)
	{
	   case "../informacion.php":
			if(clase=="cargarZona"){
				capa=document.getElementById("id_zona");
			}	
			if(clase=="cargarSector"){
				capa=document.getElementById("id_sector");
			}
			if(clase=="cargarCalle"){
				capa=document.getElementById("id_calle");
			}
			if(clase=="cargarDOE"){
				capa=document.getElementById("id_det_orden");
			}	
			
			
			if(clase=="IniciarSesion"){
				cargarModulos(cadena);
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
			else{
				capa.innerHTML=cadena;			
			}
	  break;
	}
}

function cargarSector(){
	conexionPHP('../informacion.php',"cargarSector",document.f1.id_zona.value);
}
function cargarCalle(){
	conexionPHP('../informacion.php',"cargarCalle",document.f1.id_sector.value);
}

function cargarDOE(){
	conexionPHP('../informacion.php',"cargarDOE",document.f1.id_tipo_orden.value);
}