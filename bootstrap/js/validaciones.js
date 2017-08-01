// validate signup form on keyup and submit
$("#form_contrato").validate({
	rules: {
		firstname: "required",
		lastname: "required",
		tipo_cliente: {
			required: true,
			minlength: 2
		},
		cedula: {
			required: true,
			minlength: 5
		},
		confirm_password: {
			required: true,
			minlength: 5,
			equalTo: "#password"
		},
		email: {
			required: true,
			email: true
		},
		topic: {
			required: "#newsletter:checked",
			minlength: 2
		},
		agree: "required"
	},
	messages: {
		firstname: "Please enter your firstname",
		lastname: "Please enter your lastname",
		tipo_cliente: {
			required: "Debe ingresar un Tipo de Cliente obligatoriamente",
			minlength: "Your username must consist of at least 2 characters"
		},
		cedula: {
			required: "Debe ingresar una Cédula de Identidad obligatoriamente",
			maxlength: "Este campo permite un máximo de 10 caracteres"
		},
		confirm_password: {
			required: "Please provide a password",
			minlength: "Your password must be at least 5 characters long",
			equalTo: "Please enter the same password as above"
		},
		email: "Please enter a valid email address",
		agree: "Please accept our policy"
	}
});
