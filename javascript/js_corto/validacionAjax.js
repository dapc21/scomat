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
	switch(tabla)
	{
		case "visitas":
			document.f1.id_visita.value=cadena[1];
			document.f1.id_orden.value=cadena[2];
			document.f1.fecha_visita.value=formatdatei(cadena[3]);
			document.f1.comenta_visita.value=cadena[4];
			document.f1.hora.value=cadena[5];
			
			break;
		case "vista_contrato":
			//alert(claseGlobal);
			if(claseGlobal=="pagos" || claseGlobal=="actualizar_pagos"  || claseGlobal=="anular_pagos"){
				document.f1.id_contrato.value=cadena[1];
				document.f1.nro_contrato.value=cadena[5];
				document.f1.fecha_contrato.value=formatdatei(cadena[6]);
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
					//alert(cadena[39]);
					if(cadena[39]==""){
						cadena[39]="NATURAL";
					}
					document.f1.tipo_cliente.value=cadena[39];
					document.f1.inicial_doc.value=cadena[40];
					asigna_tipo_c_pago(cadena);
					
					showTab('dhtmlgoodies_tabView1','3');
					showTab('dhtmlgoodies_tabView1','0');
					divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
					archivoDataGrid="procesos/datagrid_pagos.php?&id_contrato="+id_contrato()+"&";
					updateTable();
					
				}
				
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
				conexionPHP('informacion.php',"traerTOStatus",status_con());
				conexionPHP('informacion.php',"verificaOrden",id_contrato());
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
			else if(claseGlobal=="cargar_deuda"){
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
				alert("Error, el numero de contrato ya corresponde a un Cliente");
				//alert(document.f1.nro_contrato_nuevo.value);
				document.f1.nro_contrato.value=document.f1.nro_contrato_nuevo.value;
			}
			else{
				//alert(cadena);
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
				traerSector();
				
				if(claseGlobal=="act_contrato"){
						document.f1.n_contrato.value=cadena[5];
						divDataGrid="cargos"; 
						archivoDataGrid="procesos/datagrid_actualizar_pagos.php?&id_contrato="+id_contrato()+"&";
						updateTable();
						showTab('dhtmlgoodies_tabView1','4');
						showTab('dhtmlgoodies_tabView1','0');
				}
				
				
				
				
			}
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
		
		default:
			
	}
}

//para habilitar o desabilitar los botones dependiento de los privilegios
function boton(registrar,modificar,eliminar,clase)
{
	document.f1.registrar.disabled = registrar;
	document.f1.modificar.disabled = modificar;
	document.f1.eliminar.disabled = eliminar;
}

//permite limpiar los caracteres no visibles de una cadena
function trim(s){
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
				document.f1.status_caja[i].click();
	}
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

function verRadiotipo_costo()
{
	for (i=0;i<document.f1.tipo_costo.length;i++){
			if(document.f1.tipo_costo[i].checked)								
				return document.f1.tipo_costo[i].value;
	}
}