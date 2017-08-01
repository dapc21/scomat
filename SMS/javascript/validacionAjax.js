//permite asignar los campos traidos de una tabla.
//tabla: la tabla de donde fueron extraidos los datos
//cade: una cadena con todos los datos concatenados con =@
function asignarCampos_sms(tabla,cade)
{
	//divide los datos en un arreglo
	cadena= cade.split("=@");
	var i=0;
	for(i=0;i<cadena.length;i++){
		cadena[i]=trim(cadena[i]);
	}
	switch(tabla)
	{
		
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
			//alert(cadena[19]);
			document.getElementById("ruta_archivo").value=cadena[19];
			//document.f1.ruta_archivo.value=cadena[19];
			
			hab_text_sms();
			
			cuenta_carac_d();
			break;
		case "variables_sms":
			document.f1.id_var.value=cadena[1];
			document.f1.variable.value=cadena[2];
			asignarCheck(cadena[3]);
			document.f1.descrip_var.value=cadena[4];
			traeRadiostatus_var(cadena[5]);
			document.f1.id_franq.value=cadena[6];
			break;
		default:
			//alert("ERROR, no esiste la Tabla"+tabla); 
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