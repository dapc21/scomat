//permite asignar los campos traidos de una tabla.
//tabla: la tabla de donde fueron extraidos los datos
//cade: una cadena con todos los datos concatenados con =@
function asignarCampos_cas(tabla,cade)
{
	//divide los datos en un arreglo
	cadena= cade.split("=@");
	var i=0;
	for(i=0;i<cadena.length;i++)
	{
		//limpia cada uno de los datos
		cadena[i]=trim(cadena[i]);
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
			estatus(cadena[5]);
			break;
		case "perfil":
			document.f1.codigo.value=cadena[1];
			document.f1.nombre.value=cadena[2];
			document.f1.descripcion.value=cadena[3];
			estatus(cadena[4]);
			break;
		case "modulo":
			document.f1.codigo.value=cadena[1];
			document.f1.nombre.value=cadena[2];
			document.f1.descripcion.value=cadena[3];
			estatus(cadena[4]);
			document.f1.name.value=cadena[5];
			nombreModulo=document.f1.nombre.value;
			if(cadena[2]=='Modulo' || cadena[2]=='Perfil' || cadena[2]=='Usuario' || cadena[2]=='Persona' || cadena[2]=='CreaFormulario' || cadena[2]=='VerDatos')
				document.f1.nombre.disabled=true;
			else
				document.f1.nombre.disabled=false;
			break;
		
		case "personausuario":
			cedulaPersona=trim(cadena[1]);
			//asigna  el usuario y el perfil al div usuario una vez iniciado sesion
			document.getElementById("usuario").innerHTML=loginUsuario+' / '+perfilUsuario;
			//asigna  el el nombre de usuario y laopcion de cerrar sesion al div sesion una vez iniciado sesion
			document.getElementById("sesion").innerHTML=cadena[2]+' '+cadena[3]+' <a href="#" onclick="conexionPHP_cas(\'Seguridad/Seguridad.php\',\'CerrarSesion\')"  class="estilo">[Cerrar Sesion]</a>';
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
			document.f1.dato.value=cadena[1];
			document.f1.idPersona.value=cadena[2];
			document.f1.cedula.value=cadena[3];
			document.f1.nombre.value=cadena[4];
			document.f1.apellido.value=cadena[5];
			break;
		case "broadcaster":
			document.f1.broadcasterId.value=cadena[1];
			document.f1.broadcasterDs.value=cadena[2];
			break;
		case "channel":
			document.f1.channelId.value=cadena[1];
			document.f1.channelDs.value=cadena[2];
			document.f1.broadcasterId.value=cadena[3];
			document.f1.parentalType.value=cadena[4];
			document.f1.inExportable.value=cadena[5];
			document.f1.inFreeAccess.value=cadena[6];
			traeRadiotipoCanal(cadena[7]);
			break;
		case "smartcard":
			document.f1.SMCid.value=cadena[1];
			document.f1.broadcasterId.value=cadena[2];
			
			document.f1.total.value=cadena[3];
			document.f1.statusId.value=cadena[4];
			
			document.f1.nmIPPVbalance.value=cadena[5];
			document.f1.statusDate.value=formatdatei(cadena[6]);
			break;
		case "product":
			document.f1.productId.value=cadena[1];
			document.f1.productDs.value=cadena[2];
			document.f1.broadcasterId.value=cadena[3];
			
			document.f1.validityDateBegin.value=formatdatei(cadena[4]);
			document.f1.validityDateEnd.value=formatdatei(cadena[5]);
			document.f1.purchaseDateBegin.value=formatdatei(cadena[6]);
			document.f1.purchaseDateEnd.value=formatdatei(cadena[7]);
			document.f1.genreId.value=cadena[8];
			document.f1.subgenreId.value=cadena[9];
			document.f1.price.value=cadena[10];
			document.f1.maxEvents.value=cadena[11];
			document.f1.ippv.value=cadena[12];
			
			break;
		case "purchase":
			document.f1.idPurchase.value=cadena[1];
			document.f1.productId.value=cadena[3];
			document.f1.subscriptionId.value=cadena[4];
			if(subscriptionId()!=''){
				traeRadiotipoCanal("SUBSCRIPTION");
			}else{
				traeRadiotipoCanal("PRODUCT");
			}
			document.f1.SMCid.value=cadena[5];
			document.f1.SMCid.disabled=true;
			document.f1.productId.disabled=true;
			document.f1.subscriptionId.disabled=true;
			document.f1.tipoCanal[0].disabled=true;
			document.f1.tipoCanal[1].disabled=true;
			document.f1.statusId.value=cadena[6];
			document.f1.statusDate.value=formatdatei(cadena[7]);
			break;
		case "event":
			document.f1.eventId.value=cadena[1];
			document.f1.title.value=cadena[2];
			document.f1.broadcastBegin.value=formatdatei(cadena[3]);
			document.f1.broadcastEnd.value=formatdatei(cadena[4]);
			document.f1.channelId.value=cadena[5];
			
			document.f1.genreId.value=cadena[6];
			document.f1.subgenreId.value=cadena[7];
			document.f1.parentalType.value=cadena[8];
			document.f1.previewType.value=cadena[9];
			
			document.f1.previewDuration.value=cadena[10];
			document.f1.inScrambled.value=cadena[11];
			
			break;
		case "subscription":
			document.f1.subscriptionId.value=cadena[1];
			document.f1.subscriptionDs.value=cadena[2];
			document.f1.channelId.value=cadena[3];
			
			document.f1.purchaseDateBegin.value=formatdatei(cadena[4]);
			document.f1.purchaseDateEnd.value=formatdatei(cadena[5]);
			document.f1.price.value=cadena[6];
			document.f1.ippv.value=cadena[7];
		
			break;
		case "casstbbean":
			document.f1.stbTypeId.value=cadena[1];
			document.f1.stbManufacturerId.value=cadena[2];
			document.f1.broadcasterId.value=cadena[3];
			
			document.f1.serialNumber.value=cadena[4];
			document.f1.barcode.value=cadena[5];
			document.f1.inMaster.value=cadena[6];
			
			document.f1.stbMasterTypeId.value=cadena[7];
			document.f1.stbMasterManufacturerId.value=cadena[8];
			document.f1.serialNumberMaster.value=cadena[9];
			break;
		case "productevent":
			document.f1.eventId.value=cadena[1];
			document.f1.productId.value=cadena[2];
			break;
		case "castimerangebean":
			document.f1.idCASTimeRangeBean.value=cadena[1];
			document.f1.subscriptionId.value=cadena[2];
			document.f1.day.value=cadena[3];
			
			document.f1.broadcastTimeBegin.value=cadena[4];
			document.f1.broadcastTimeEnd.value=cadena[5];
			break;
		case "message":
			document.f1.idMessage.value=cadena[1];
			document.f1.to.value=cadena[2];
			document.f1.from.value=cadena[3];
			document.f1.subject.value=cadena[4];
			document.f1.text.value=cadena[5];
			document.f1.sendDate.value=formatdatei(cadena[6]);
			document.f1.broadcasterId.value=cadena[7];
			
			break;
		case "subscriptionchannel":
			document.f1.dato.value=cadena[1];
			document.f1.subscriptionId.value=cadena[2];
			for(i=0;i<document.f1.channelId.options.length;i++)
			{
				if(document.f1.channelId.options[i].value==cadena[3])
					document.f1.channelId.selectedIndex=i;	
			}
			break;
		default:
			//alert("ERROR, no esiste la Tabla"+tabla); 
	}	
}
function traeRadiotipoCanal(cadena)
{
	for (i=0;i<document.f1.tipoCanal.length;i++){
			if(cadena==document.f1.tipoCanal[i].value)								
				document.f1.tipoCanal[i].click();
	}
}
function verRadiotipoCanal()
{
	for (i=0;i<document.f1.tipoCanal.length;i++){
			if(document.f1.tipoCanal[i].checked)								
				return document.f1.tipoCanal[i].value;
	}
}