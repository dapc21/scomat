var mje_Glo='';
function alerta(mensaje) {

	 mje_Glo = BootstrapDialog.show({
		title: 'INFORMACIÓN DE SAECO',
		message: mensaje,
		type: BootstrapDialog.TYPE_INFO, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
		closable: false, // <-- Default value is true
		//buttonLabel: 'Roar! Why!', // <-- Default value is 'OK',
		buttons  : [{
			icon     : 'glyphicon glyphicon-thumbs-up',
			label    : 'OK',
			cssClass : 'btn-info',
			action   : function(dialogItself) {
				dialogItself.close();
			}
		}],
		callback: function(result) {
			// result will be true if button was click, while it will be false if users close the dialog directly.
			//alert('Result is: ' + result);
		}
	});

}


function confirmar(mensaje, callback) {

	return new BootstrapDialog({
		title: 'CONFIRMACIÓN DE SAECO',
		message: mensaje,
		type: BootstrapDialog.TYPE_INFO,
		closable: false,
		data: {
			'callback': callback
		},
		buttons: [{
			label: 'NO',
			icon: 'glyphicon glyphicon-thumbs-down',
			cssClass: 'btn-danger',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
				dialog.close();
			}
		}, {
			label: 'SI',
			icon : 'glyphicon glyphicon-thumbs-up',
			cssClass: 'btn-info',
			action: function(dialog) {
				typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
				dialog.close();
			}
		}]
	}).open();

}
