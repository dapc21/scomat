//permite asignar los campos traidos de una tabla.
//tabla: la tabla de donde fueron extraidos los datos
//cade: una cadena con todos los datos concatenados con =@
function asignarCampos_mat(tabla,cade)
{
	//divide los datos en un arreglo
	cadena= cade.split("=@");
	var i=0;
	for(i=0;i<cadena.length;i++)
	{
		//limpia cada uno de los datos
		cadena[i]=trim_mat(cadena[i]);
	}
	switch(tabla)
	{
		case "usuario":			
			var i=0;
			//asigna cada uno de los datos a sus campos correspondientes
			for(i=0;i<document.f1.codigoperfil.options.length;i++)
			{
				if(document.f1.codigoperfil.options[i].value==cadena[2])
					document.f1.codigoperfil.selectedIndex=i;	
			}			
			document.f1.login.value=cadena[1];
			document.f1.cedula.value=cadena[3];
			document.f1.password.value=cadena[4];
			document.f1.otropassword.value=cadena[4];			
			estatus_mat(cadena[5]);
			break;
		case "perfil":
			document.f1.codigo.value=cadena[1];
			document.f1.nombre.value=cadena[2];
			document.f1.descripcion.value=cadena[3];
			estatus_mat(cadena[4]);
			break;
		case "modulo":
			document.f1.codigo.value=cadena[1];
			document.f1.nombre.value=cadena[2];
			document.f1.descripcion.value=cadena[3];
			estatus_mat(cadena[4]);
			document.f1.name.value=cadena[5];
			nombreModulo=document.f1.nombre.value;
			if(cadena[2]=='Modulo' || cadena[2]=='Perfil' || cadena[2]=='Usuario' || cadena[2]=='Persona' || cadena[2]=='CreaFormulario' || cadena[2]=='VerDatos')
				document.f1.nombre.disabled=true;
			else
				document.f1.nombre.disabled=false;
			break;
		
		case "personausuario":
			cedulaPersona=trim_mat(cadena[1]);
			//asigna  el usuario y el perfil al div usuario una vez iniciado sesion
			document.getElementById("usuario").innerHTML=loginUsuario+' / '+perfilUsuario;
			//asigna  el el nombre de usuario y laopcion de cerrar sesion al div sesion una vez iniciado sesion
			document.getElementById("sesion").innerHTML=cadena[2]+' '+cadena[3]+' <a href="#" onclick="conexionPHP_mat(\'Seguridad/Seguridad.php\',\'CerrarSesion\')"  class="estilo">[Cerrar Sesion]</a>';
			break;
		case "Manejador":
			radio_mat(cadena[0]);
			document.f1.servidor.value=cadena[1];
			document.f1.login.value=cadena[2];
			document.f1.password.value=cadena[3];
			document.f1.database.value=cadena[4];
			manejador=cadena[0];
			break;
		case "persona":
			if(claseGlobal=="responsable"){
				document.f1.id_persona.value=cadena[1];
				document.f1.cedula.value=cadena[2];
				document.f1.nombre.value=cadena[3];
				document.f1.apellido.value=cadena[4];
				document.f1.telefono.value=cadena[5];alert("hola");
				
				conexionPHP_mat('validarExistencia.php','1=@vista_responsable','id_persona=@'+document.f1.id_persona.value);
			}
			else{
				document.f1.id_persona.value=cadena[1];
				document.f1.cedula.value=cadena[2];
				document.f1.nombre.value=cadena[3];
				document.f1.apellido.value=cadena[4];
				document.f1.telefono.value=cadena[5];
			}
			break;
		case "vista_responsable":
				document.f1.id_persona.value=cadena[1];
				document.f1.cedula.value=cadena[2];
				document.f1.nombre.value=cadena[3];
				document.f1.apellido.value=cadena[4];
				document.f1.telefono.value=cadena[5];
				document.f1.id_tipo_res.value=cadena[6];
				document.f1.descrip_res.value=cadena[7];
				document.f1.status_res.value=cadena[8];
			
			break;
		case "motivo_inv":
			document.f1.id_motivo.value=cadena[1];
			document.f1.nombre_motivo.value=cadena[2];
			traeRadiostatus_motivo(cadena[3]);
			break;
		case "familia":
			document.f1.id_fam.value=cadena[1];
			document.f1.nombre_fam.value=cadena[2];
			traeRadiostatus_fam(cadena[3]);
			break;
		case "tipo_responsable":
			document.f1.id_tipo_res.value=cadena[1];
			document.f1.nombre_te.value=cadena[2];
			traeRadiostatus_te(cadena[3]);
			break;
		case "inventario_materiales":
			document.f1.id_mat.value=cadena[1];
			document.f1.id_inv.value=cadena[2];
			document.f1.cant_sist.value=cadena[3];
			document.f1.cant_real.value=cadena[4];
			document.f1.justi_inv.value=cadena[5];
			break;
		case "deposito":			
			document.f1.id_gt.value='0';
			traerGtPersona('0');
			document.f1.id_dep.value=cadena[1];
			document.f1.nombre_dep.value=cadena[2];
			document.f1.descrip_dep.value=cadena[3];
			traeRadiostatus_dep(cadena[4]);
			document.f1.id_gt.value=cadena[5];
			document.f1.id_franq.value=cadena[7];
			if(document.f1.id_gt.value!='0'){
				traerGtPersona(cadena[6]);
			}
			
			//document.f1.id_persona.value=cadena[6];
			
			break;
		case "unidad_medida":
			document.f1.id_unidad.value=cadena[1];
			document.f1.nombre_unidad.value=cadena[2];
			document.f1.abreviatura.value=cadena[3];
			//document.f1.unidad_sal.value=cadena[4];
			traeRadiostatus_unidad(cadena[4]);
			//asignarCheck_mat(cadena[5]);
			break;
		case "tipo_movimiento":
			document.f1.id_tm.value=cadena[1];
			document.f1.nombre_tm.value=cadena[2];
			document.f1.tipo_ent_sal.value=cadena[3];
			document.f1.uso_tm.value=cadena[4];
			traeRadiostatus_tm(cadena[6]);
			//asignarCheck_mat(cadena[6]);
			
			break;
		case "movimiento":
			document.f1.id_mov.value=cadena[1];
			document.f1.id_mov.disabled=true;
			//document.f1.id_tm.value=cadena[2];
			document.f1.fecha_ent_sal.value=formatdatei(cadena[3]);
			document.f1.hora_ent_sal.value=cadena[4];
			document.f1.observacion.value=cadena[5];
			document.f1.referencia.value=cadena[6];
			document.f1.iddep.value=cadena[7];
			document.f1.iddep.disabled=true;
			document.f1.tipo_mov.value=cadena[7];
			document.f1.id_persona.value=cadena[8];
			document.f1.numero_m.value="";
			agregar_ma_movit();
			sel=document.f1.id_tm;
			varl="";
			if(trim(cadena[2])=="A0000005")
			{
				document.getElementById("checkboxTrans").checked=true;				
				validaTransfer("checkboxTrans");
				document.f1.iddep2.value=cadena[6];
				document.f1.iddep2.disabled=true;
				conexionPHP_mat('informacion.php','traeValDep',cadena[6]);
			}else if(trim(cadena[2])=="A0000006")
			{
				document.f1.id_mov.value="xxxoo1@";
				validarmovimiento();
				document.getElementById("checkboxTrans").checked=false;
				validaTransfer("checkboxTrans");
			}else
			{		
				document.getElementById("checkboxTrans").checked=false;
				validaTransfer("checkboxTrans");
				for(i=1;i<=sel.length;i++)
				{
					val=sel.options[i].value.split("==");
					//alert(val[0]+"    "+trim(cadena[2]));
					if(trim(val[0])==trim(cadena[2]))
					{						
						varl=sel.options[i].value;
						document.f1.id_tm.value=sel.options[i].value;
						document.f1.id_tm.disabled=true;
						i=sel.length;
						//alert("gano:"+varl);
					}
				}				
			}
			
			document.getElementById('id_mov2').value=cadena[6];
			document.getElementById('auxi').value="1";
			dep=document.getElementById('iddep').value;
			document.getElementById("checkboxTrans").disabled=true;
			document.getElementById("imprimir").disabled=false;
			
			//document.getElementById("registrar").value="modificar";
			//id_mov=document.getElementById(id2).value;
			params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
			archivoDataGrid="procesos/datagrid_movimiento_uni.php?id_dep="+dep+"=="+id_mov()+"&";
			updateTable_mat();
			break;
		case "proveedor":
			document.f1.id_prov.value=cadena[1];
			document.f1.rif_prov.value=cadena[2];
			document.f1.nombre_prov.value=cadena[3];
			document.f1.direccion_prov.value=cadena[4];
			document.f1.telefonos_prov.value=cadena[5];
			document.f1.fax_prov.value=cadena[6];
			document.f1.web_prov.value=cadena[7];
			document.f1.email_prov.value=cadena[8];
			document.f1.obser_prov.value=cadena[9];
			document.f1.forma_pago.value=cadena[10];
			document.f1.banco.value=cadena[11];
			document.f1.cuenta.value=cadena[12];
			document.f1.contacto.value=cadena[14];
			//alert("cadena 14:"+cadena[14]+"cadena 13:"+cadena[13]);
			traeRadiostatus_prov(cadena[13]);
			break;
		case "pedido":
			
			document.f1.id_ped.value=cadena[1];
			//document.f1.id_prov.options[2].value==cadena[2];					
			document.f1.fecha_ped.value=formatdatei(cadena[3]);
			document.f1.fecha_ent.value=formatdatei(cadena[4]);
		//	traeRadiostatus_ped(cadena[5]);
			document.f1.obser_ped.value=cadena[6];
			document.f1.nro_fact_ped.value=cadena[7];
			document.f1.porc_desc.value=cadena[8];
			document.f1.desc_ped.value=cadena[9];
			document.f1.base_ped.value=cadena[10];
			document.f1.iva_ped.value=cadena[11];
			document.f1.total_ped.value=cadena[12];
			//alert(claseGlobal);
			if(claseGlobal=="pedido" || claseGlobal=="confir_pedido"|| claseGlobal=="realizar_compra"){
				conexionPHP_mat('informacion.php','traerLisPedido',id_ped());
				calculaTotalCP();
			}
			break;
		case "vista_materiales":
			
			//alert(claseGlobal);
			if(claseGlobal=="busquedad_m"){
				document.f1.id_mat.value=cadena[1];
				document.f1.numero_mat.value=cadena[7];
				document.f1.nombre_mat.value=cadena[8];
				document.f1.buscar.disabled=false;
				document.f1.imprimir.disabled=false;
			}
			else if(claseGlobal!="movimiento" && claseGlobal!="final_ordenes_tecnicos"){
				
				document.f1.id_mat.value=cadena[1];
				document.f1.id_dep.value=cadena[2];
				document.f1.stock.value=cadena[3];
				document.f1.stock_min.value=cadena[4];
				document.f1.observacion.value=cadena[5];
				document.f1.id_m.value=cadena[6];
				document.f1.numero_mat.value=cadena[7];
				document.f1.nombre_mat.value=cadena[8];
				document.f1.id_unidad.value=cadena[9];
				document.f1.uni_id_unidad.value=cadena[10];
				document.f1.id_fam.value=cadena[11];
				document.f1.precio_u_p.value=cadena[12];
				document.f1.c_uni_ent.value=cadena[13];
				document.f1.c_uni_sal.value=cadena[14];
				//alert(":"+cadena[23]+":");
				document.f1.impresion.value=cadena[23];
				
			}else if(claseGlobal=="movimiento" || claseGlobal=="final_ordenes_tecnicos"){
			//	document.getElementById("registrar").value="modificar";
				document.f1.numero_m.value=cadena[1];
				agregar_ma_movit();
			}
			
			
			break;
		case "materiales":
		case "vista_materiales_orden":
				document.f1.numero_m.value=cadena[1];
				agregar_ma_movit_orden();
			
			break;
		case "materiales":
			/*id_mat character(10) NOT NULL,
  id_dep character(8),
  stock bigint,
  stock_min integer,
  observacion character(200),
  id_m */
			document.f1.id_mat.value=cadena[1];
			document.f1.id_dep.value=cadena[2];
			document.f1.stock.value=cadena[3];
			document.f1.stock_min.value=cadena[4];
			document.f1.observacion.value=cadena[5];
			document.f1.id_m.value=cadena[6];
						
			break;
		case "mov_mat":
			document.f1.id_mat.value=cadena[1];			
			document.f1.id_mov.value=cadena[2];
			document.f1.cant_mov.value=cadena[3];
			break;
		case "motivo_inv":
			document.f1.dato.value=cadena[1];
			break;
		case "mat_prov":
			document.f1.id_mat.value=cadena[1];
			document.f1.id_prov.value=cadena[2];
			break;
		case "mat_ped":
			document.f1.id_mat.value=cadena[1];
			document.f1.id_ped.value=cadena[2];
			document.f1.cant_ped.value=cadena[3];
			document.f1.cant_ent.value=cadena[4];
			document.f1.precio.value=cadena[5];
			break;
		case "inventario":
			document.f1.idinventario.value=cadena[1];
			document.f1.idmotivo.value=cadena[2];
			document.f1.fechainv.value=formatdatei(cadena[3]);
			document.f1.horainv.value=cadena[4];
			document.f1.obserinv.value=cadena[5];
			document.f1.tipoinv.value=cadena[6];
			document.f1.iddep.value=cadena[7];
			document.f1.idfam.value=cadena[8];
			if(claseGlobal=="aprobarinventario" ){
				document.f1.iddep.disabled=true;
				document.f1.idfam.disabled=true;
				conexionPHP_mat('informacion.php','traerLisInventario',idinventario());
				//calculaTotalCP();
			}
			break;
		case "aprobarinventario":
			//document.f1.dato.value=cadena[1];
			break;
		case "mat_padre":
			if(claseGlobal=="busquedad_m"){
				document.f1.numero_mat.value=cadena[4];
				document.f1.nombre_mat.value=cadena[5];
				document.f1.id_m.value=cadena[1];
			}
			else{
				document.f1.id_m.value=cadena[1];
				document.f1.id_unidad.value=cadena[2];			
				document.f1.numero_mat.value=cadena[4];
				document.f1.nombre_mat.value=cadena[5];
				document.f1.precio_u_p.value=cadena[6];
				document.f1.c_uni_ent.value=cadena[7];
				document.f1.c_uni_sal.value=cadena[8];
				document.f1.uni_id_unidad.value=cadena[9];
				document.f1.id_fam.value=cadena[3];
				
				document.f1.impresion.value=cadena[10];
			}
			if(claseGlobal=="materiales" ){
				//validarmateriales_mat();
				validarmat_padre4();
			}
			break;
		case "config_mat":
			
			document.f1.id_c_mat.value=cadena[1].toUpperCase();
			document.f1.id_franq.value=cadena[2].toUpperCase();			
			document.f1.hab_alerta_min.value=cadena[3].toUpperCase();
			document.f1.hab_desc_alm_gru.value=cadena[4].toUpperCase();
			if(hab_desc_alm_gru()=="T"){
				hab_alm_gen();
			}
			document.f1.hab_desc_alm_gen.value=cadena[5].toUpperCase();
			if(hab_desc_alm_gen()=="T"){
				habilitaDep();
			}
			document.f1.hab_mat_orden.value=cadena[6].toUpperCase();
			if(hab_mat_orden()=="T"){
				hab_alm_ord();
			}
			document.f1.id_deposito.value=cadena[7].toUpperCase();
			document.f1.hab_imp_mat.value=cadena[8].toUpperCase();
			
			break;
		case "ejempl":
			document.f1.dato.value=cadena[1];
			break;
		default:
			//alert("ERROR, no esiste la Tabla"+tabla); 
	}	
}
function limpiar_mat_dep(){
			document.f1.stock.value='0';
			document.f1.stock_min.value='';
			document.f1.observacion.value='';
}

function limpiarmov_mat(){
						document.f1.numero_m.value="";
						val1=document.getElementById("numero_mat").value;
						val2=document.getElementById("nombre_mat").value;
						agregar_ma_movit();
						//setTimeOut("",500);
						document.getElementById("numero_mat").value=val1;
						document.getElementById("nombre_mat").value=val2;
						
					//	document.getElementById("registrar").value="agregar";
}
function limpiarmov_mat_orden(){
						document.f1.numero_m.value="";
						val1=document.getElementById("numero_mat").value;
						val2=document.getElementById("nombre_mat").value;
						agregar_ma_movit_orden();
						//setTimeOut("",500);
						document.getElementById("numero_mat").value=val1;
						document.getElementById("nombre_mat").value=val2;
						
					//	document.getElementById("registrar").value="agregar";
}
//para selecionar y deseleccionar todos los checkbox
function asignaCheck_mat(i){
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
function seleccionCheck_mat(){
	if(document.f1.seleccion.checked == true)
	{
		seleccionarTodo_mat();
	}
	else{
		deseleccionarTodo_mat();
	}
}
//deselecciona todos los chek del campo modulo
function deseleccionarTodo_mat(){
   for (i=0;i<document.f1.modulo.length;i++)
      if(document.f1.modulo[i].type == "checkbox")
         document.f1.modulo[i].checked=0
}
//selecciona todos los chek del campo modulo
function seleccionarTodo_mat(){
   for (i=0;i<document.f1.modulo.length;i++)
      if(document.f1.modulo[i].type == "checkbox")
         document.f1.modulo[i].checked=1
}
//asigna todos los modulos y sus privilegios a un perfil
function asignarModulo_mat(cadena)
{
		deseleccionar_todo_mat();
			cade=cadena.split("=@");
			tam=cade.length-1;
			tam1=document.f1.modulo.length;
			var i=0,j=0;
			for(i=0;i<tam;i++){
				ca=cade[i].split(",");
				for(j=0;j<tam1;j++){
					if(trim_mat(document.f1.modulo[j].value)==trim_mat(ca[0])){
						document.f1.modulo[j].checked=1;
						if('true'==ca[1]){
							document.f1.modulo[j+1].checked=1;
						}
						if('true'==ca[2]){
							document.f1.modulo[j+2].checked=1;
						}
						if('true'==ca[3]){
							document.f1.modulo[j+3].checked=1;
						}
					}
				}
			}	
}

//activa los check dependiendo de los privilegios
function asignarCheck_mat(cadena)
{
		deseleccionar_todo_mat();
			cade=cadena.split(";");
			tam=cade.length-1;
			
			var i=0,j=0;
			for(i=0;i<tam;i++){
				for(j=0;j<document.f1.elements.length;j++){
					if(document.f1.elements[j].type == "checkbox"){
						if(trim_mat(document.f1.elements[j].value)==cade[i]){
							document.f1.elements[j].click();
						}
					
					}
				}
			}	
}
//funcion deseleccionar todos los check de cualquier elemento
function deseleccionar_todo_mat(){
   for (i=0;i<document.f1.elements.length;i++)
      if(document.f1.elements[i].type == "checkbox")
         document.f1.elements[i].checked=0
}
//para saber si un estatus esta activo o inactivo
function estatus_mat(cadena)
{
	if(cadena=="Inactivo")								
		document.f1.status[1].click();	
	else					
		document.f1.status[0].checked;
}
//para saber que radio de un elemento esta activo o inactivo
function radio_mat(cadena)
{
	for (i=0;i<document.f1.elements.length;i++){
		if(document.f1.elements[i].type == "radio"){
			if(cadena==document.f1.elements[i].value)								
				document.f1.elements[i].click();
		}
	}
}
//para retornar el valor seleccionado de un radio
function verradio_mat()
{
	for (i=0;i<document.f1.elements.length;i++){
		if(document.f1.elements[i].type == "radio"){
			if(document.f1.elements[i].checked)								
				return document.f1.elements[i].value;
		}
	}
}
//cargar los modulos en el div lateral una vez iniciado sesion
//recibe una cadade concatenada con =@ donde trae: el perfil =@ la descripcion del perfil =@ lista de modulos asignados al perfil 
function cargarModulos_mat(cadena)
{
			var modulos=cadena.split("-Class-");
			cade=modulos[1].split("=@");
			perfilUsuario=cade[0];
			tam=cade.length-1;			
			var i=0,j=0;
			//asigno el perfil y la descripcion al div principal
			document.getElementById("principal").innerHTML='<br><H3 align=\"center\"> Cuenta de '+cade[0]+'</H3><br>Descripción<br>'+cade[1]+' ';
			var cad=modulos[0];
			var ca='';
			//recorro todos los modulos
			for(i=2;i<tam;i++){
				ca=cade[i].split(",");
				dato[j]=ca;
				j++;
			}
			//completo el div con botones vacio
			for(i=tam;i<19;i++){
				cad=cad+'<li id="imagen">&nbsp;</li>';
			}
			//asigno los botones al div funcion
			document.getElementById("funcion").innerHTML= cad;
}

//para habilitar o desabilitar los botones dependiento de los privilegios
function boton_mat(registrar,modificar,eliminar,clase)
{
	//	for(i=0;i<dato.length;i++)
	//	{		
			//if(dato[i][1].toLowerCase()==clase.toLowerCase()){
				//if (dato[i][2] == 'true')
					document.f1.registrar.disabled =registrar;
				//if (dato[i][3] == 'true')
					document.f1.modificar.disabled =modificar;
				//if (dato[i][4] == 'true')
					document.f1.eliminar.disabled =eliminar;
		//	}
	//	}
}
//verifica si tiene permiso para modificar un formulario
function PermisionFormulario_mat(clase)
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
//permite limpiar los caracteres no visibles de una cadena
function trim_mat(s){
	var j=0;	
	for(var i=s.length-1; i>-1; i--){
		if(s.substring(i,i+1) != ' '){
			j=i;
			break;
		}
	}
	return s.substring(0, j+1);
}
//limpiar una cadena de vasuras
function limpiar_mat(cadena)
{
		
		var cad= cadena.split("=@");
		var cade = limpiarCad_mat(cad[0]);
		var caden='';
		for(i=1;i<cad.length;i++)
		{
			caden=caden+'=@'+cad[i];
		}
		cadena=cade+caden;
		return cadena;
}
//limpiar cadena de espacios y numeros
function limpiarCad_mat(s){
	var j=0;	
	var cad='';
	var valor=true;
	for(i=0; i<s.length;i++){
		if(valor)
		{
			if(numero_mat(s.charAt(i))==false){
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
function numero_mat(s)
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
	for(i=0;i<cadena.length;i++){cadena[i]=trim_mat(cadena[i]);}
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

////////////////////////////////////////////////////ricardo////////////////////////////////////////////////////

function traeRadiostatus_motivo(cadena)
{
	for (i=0;i<document.f1.status_motivo.length;i++){
			if(cadena==document.f1.status_motivo[i].value)								
				document.f1.status_motivo[i].click();
	}
}
function verRadiostatus_motivo()
{
	for (i=0;i<document.f1.status_motivo.length;i++){
			if(document.f1.status_motivo[i].checked)								
				return document.f1.status_motivo[i].value;
	}
}
function traeRadiostatus_fam(cadena)
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

function traeRadiostatus_te(cadena)
{
	for (i=0;i<document.f1.status_te.length;i++){
			if(cadena==document.f1.status_te[i].value)								
				document.f1.status_te[i].click();
	}
}
function verRadiostatus_te()
{
	for (i=0;i<document.f1.status_te.length;i++){
			if(document.f1.status_te[i].checked)								
				return document.f1.status_te[i].value;
	}
}

function traeRadiostatus_ent(cadena)
{
	for (i=0;i<document.f1.status_ent.length;i++){
			if(cadena==document.f1.status_ent[i].value)								
				document.f1.status_ent[i].click();
	}
}
function verRadiostatus_ent()
{
	for (i=0;i<document.f1.status_ent.length;i++){
			if(document.f1.status_ent[i].checked)								
				return document.f1.status_ent[i].value;
	}
}

function traeRadiostatus_dep(cadena)
{
	for (i=0;i<document.f1.status_dep.length;i++){
			if(cadena==document.f1.status_dep[i].value)								
				document.f1.status_dep[i].click();
	}
}
function verRadiostatus_dep()
{
	for (i=0;i<document.f1.status_dep.length;i++){
			if(document.f1.status_dep[i].checked)								
				return document.f1.status_dep[i].value;
	}
}

function traeRadiostatus_unidad(cadena)
{
	for (i=0;i<document.f1.status_unidad.length;i++){
			if(cadena==document.f1.status_unidad[i].value)								
				document.f1.status_unidad[i].click();
	}
}
function verRadiostatus_unidad()
{
	for (i=0;i<document.f1.status_unidad.length;i++){
			if(document.f1.status_unidad[i].checked)								
				return document.f1.status_unidad[i].value;
	}
}
function traeRadiostatus_tm(cadena)
{
	for (i=0;i<document.f1.status_tm.length;i++){
			if(cadena==document.f1.status_tm[i].value)								
				document.f1.status_tm[i].click();
	}
}
function verRadiostatus_tm()
{
	for (i=0;i<document.f1.status_tm.length;i++){
			if(document.f1.status_tm[i].checked)								
				return document.f1.status_tm[i].value;
	}
}
function traeRadiostatus_prov(cadena)
{
	for (i=0;i<document.f1.status_prov.length;i++){
			if(cadena==document.f1.status_prov[i].value)								
				document.f1.status_prov[i].click();
	}
}
function verRadiostatus_prov()
{
	for (i=0;i<document.f1.status_prov.length;i++){
			if(document.f1.status_prov[i].checked)								
				return document.f1.status_prov[i].value;
	}
}
function traeRadiostatus_ped(cadena)
{
	for (i=0;i<document.f1.status_ped.length;i++){
			if(cadena==document.f1.status_ped[i].value)								
				document.f1.status_ped[i].click();
	}
}
function verRadiostatus_ped()
{
	for (i=0;i<document.f1.status_ped.length;i++){
			if(document.f1.status_ped[i].checked)								
				return document.f1.status_ped[i].value;
	}
}
/////////////////////////////////////////RICARDO ///////////////////////////////////////
function tildaMatProv(cadena)
{
	deseleccionar_todo_mat();
	cade=cadena.split("=@");
	tam=cade.length-1;
	tam1=document.f1.checkbox.length;
	var i=0,j=0;
	for(i=0;i<tam;i++){
		for(j=0;j<tam1;j++){				
			if(trim_mat(document.f1.checkbox[j].value)==trim_mat(cade[i])){
					document.f1.checkbox[j].checked=1;
					
			}
		}
	}				
}
function tildaPedido(cadena)
{
	//deseleccionar_todo_mat();
	deseleccionarTodoPedido();
	cade=cadena.split("=@");
	//dato=cade.split(",");
	tam=cade.length-1;
	tam1=document.f1.checkbox.length;
	var i=0,j=0;
	for(i=0;i<tam;i++){
		for(j=0;j<tam1;j++){	
			dato=cade[i].split(",");
			campo=trim_mat(document.f1.checkbox[j].value);
			//alert(campo);
			if(trim_mat(document.f1.checkbox[j].value)==trim_mat(dato[0])){
					document.getElementById("cant_"+dato[0]).value=dato[2];							
					document.f1.checkbox[j].checked=1;
					document.getElementById("cant_"+dato[0]).disabled=false;
					
			}/*else if(campo!="on" && trim_mat(document.f1.checkbox[j].value)!=trim_mat(dato[0])){
				document.getElementById("cant_"+campo).value="";	
			}*/
		}
	}		
}
function tildaInventario(cadena)
{
	//deseleccionar_todo_mat();
	//deseleccionarTodoPedido();
	cade=cadena.split("=@");
	//dato=cade.split(",");
	tam=cade.length-1;
	tam1=document.f1.checkbox.length;
	var i=0,j=0;
	for(i=0;i<tam;i++){
		for(j=0;j<tam1;j++){	
			dato=cade[i].split(",");
			campo=trim_mat(document.f1.checkbox[j].value);
			//alert(campo);
			if(trim_mat(document.f1.checkbox[j].value)==trim_mat(dato[0])){
				var stock=0,stock1=0,stock2=0,csal=0,cent=0,val=0,vstock1=0;
				stock=parseInt(trim_mat(dato[3]));
				cent=parseInt(document.getElementById("cent"+dato[0]).value);
				csal=parseInt(document.getElementById("csal"+dato[0]).value);
				val=stock/csal;
				//alert("stock="+stock+"  csal="+csal+"  val="+val);
				stock2=stock%csal;
				//alert("resto="+stock2);
				if(cent!=csal){
					stock1=decimalRedondear(stock/csal,0);
					vstock1=stock1;
				}else{
					vstock1=dato[3];
				}			
						
				document.getElementById("cant_"+dato[0]).value=vstock1;		
				document.getElementById("cantNew_"+dato[0]).value=stock;				
				if(cent!=csal){
					document.getElementById("cantabre_"+dato[0]).value=stock2;	
				}
											
				//document.f1.checkbox[j].checked=1;
				document.getElementById("justifi_"+dato[0]).value=dato[4];	
				if(dato[4]!=""){
					muestrajusti2("just_"+dato[0],"but_"+dato[0]);
				
				}
				document.getElementById("cant_"+dato[0]).disabled=false;
			}
		}
	}		
}
//deselecciona todos los chek e input del modulo PEDIDO
function deseleccionarTodoPedido(){
	tam1=document.f1.checkbox.length;
	var i=0,j=0;
	for(j=0;j<tam1;j++){	
		//alert(trim_mat(document.f1.checkbox[j].value));
		if(trim_mat(document.f1.checkbox[j].value)!='on'){
			document.getElementById("cant_"+trim_mat(document.f1.checkbox[j].value)).value="";							
			document.f1.checkbox[j].checked=0;
			document.getElementById("cant_"+trim_mat(document.f1.checkbox[j].value)).disabled=true;
		}
	}	
} 