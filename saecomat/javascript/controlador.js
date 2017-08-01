//para que ejecute la funcion cerrarSesion al cargar la pagina index.html
//window.onload=cerrarSesion;
//declaracion de variables globales
var claseGlobal="";
var cedulaPersona="";
var loginUsuario="";
var perfilUsuario="";
var miFormulario="";
var nombreModulo="";
var idglobal="";
var id_movglobal="";
var numglobal="";
var id_mglobal="";
var manejador="";
var dato=new Array();
var mat_autoc = [
	"aceite"
];

//permite iniciar sesion 
function iniciarSesion_mat(){
	loginUsuario=document.f1.login.value;
	conexionPHP_mat("Seguridad/Seguridad.php","IniciarSesion",document.f1.login.value+"=@"+document.f1.password.value);
}
function _(id){
	return id;
}
//permite cerrar la sesion en javascript inicializando las variables
function cerrarSesion_mat(arg)
{
	muestraReloj();
	claseGlobal="";
	cedulaPersona="";
	loginUsuario="";
	perfilUsuario="";
	var cad='';
	for(i=1;i<19;i++)
		cad=cad+'<li id="imagen">&nbsp;</li>';
	var cadena= '<ul><div id="funcion">'+cad+'</ul></div>';
	var capa=document.getElementById("lateral");
	capa.innerHTML=cadena;
	//asigno los botones latelares al div lateral
//	if(cerrarSesion.arguments.length==0){
		//hace la llamada a traves de ajax
		conexionPHP_mat('formulario.php','Sesion');
//	}
}
//permite validar que la cedula de una persona este regsitrada para poder ser usuario.
function validarEmp_mat(){
	conexionPHP_mat("validarExistencia.php","1=@persona","cedula=@"+document.f1.cedula.value,"esta Cedula no esta registrada");
}
//validar existencia de un usuario
function validarUsuario_mat(){
	conexionPHP_mat("validarExistencia.php","1=@usuario","login=@"+document.f1.login.value);
}
//valida existencia de un perfil
//valida existencia de un perfil
function validarCodigo_mat(){
	conexionPHP_mat("validarExistencia.php","1=@perfil","codigoperfil=@"+document.f1.codigo.value);
	//carga todos los modulos registrados
	conexionPHP_mat("informacion.php","TraerModulo",document.f1.codigo.value);
}
//valida existencia de una persona
function validarPersona_mat(){
	conexionPHP_mat("validarExistencia.php","1=@persona","cedula=@"+document.f1.cedula.value);
}
//valida existencia de un modulo
function validarModulo_mat(){
	conexionPHP_mat("validarExistencia.php","1=@modulo","codigomodulo=@"+document.f1.codigo.value);
	//carga todos los perfiles registrados
	conexionPHP_mat("informacion.php","TraerModulo1",document.f1.codigo.value);
}

//APLICATEM - para validar la existencia de los nuevos modulos
function validarmotivo_inv(){ conexionPHP_mat("validarExistencia.php","1=@motivo_inv","nombre_motivo=@"+nombre_motivo());}
function validarfamilia(){ conexionPHP_mat("validarExistencia.php","1=@familia","nombre_fam=@"+nombre_fam());}
function validarinventario_materiales(){ conexionPHP_mat("validarExistencia.php","1=@inventario_materiales","id_mat=@"+id_mat());}
function validardeposito(){ conexionPHP_mat("validarExistencia.php","1=@deposito","nombre_dep=@"+nombre_dep());}
function validarunidad_medida(){ conexionPHP_mat("validarExistencia.php","1=@unidad_medida","nombre_unidad=@"+nombre_unidad());}
function validartipo_movimiento(){ conexionPHP_mat("validarExistencia.php","1=@tipo_movimiento","nombre_tm=@"+nombre_tm());}
function validarmovimiento(){ conexionPHP_mat("validarExistencia.php","1=@movimiento","id_mov=@"+id_mov());}
function validarproveedor(){ conexionPHP_mat("validarExistencia.php","1=@proveedor","rif_prov=@"+rif_prov());}
function validarproveedor3(){ conexionPHP_mat("validarExistencia.php","1=@proveedor","nombre_prov=@"+nombre_prov());}
function validarproveedor2(){ conexionPHP_mat("validarExistencia.php","1=@proveedor","id_prov=@"+document.f1.id_prov.value); 
conexionPHP_mat('informacion.php','traerLisMatProv',document.f1.id_prov.value);
}
function validarpedido(){ conexionPHP_mat("validarExistencia.php","1=@pedido","id_ped=@"+id_ped());}
function validarpedido2(){ 
	/*alert("sdf");
	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
	archivoDataGrid="procesos/datagrid_pedido_prov.php?id_dep="+"=="+"==1"+"=="+document.f1.id_prov.value+"=="+id_ped()+"&";*/
	conexionPHP_mat("validarExistencia.php","2=@pedido","id_prov=@"+document.f1.id_prov.value+"=@status_ped=@"+"SOLICITADO");
/*	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
	archivoDataGrid="procesos/datagrid_pedido_prov.php?id_dep="+"=="+"==1"+"=="+document.f1.id_prov.value+"=="+id_ped()+"&";*/
}
function validarpedido3(){ conexionPHP_mat("validarExistencia.php","2=@pedido","id_ped=@"+id_ped()+"=@status_ped=@"+"APROBADO");}
function validar_registro_pedido(){ conexionPHP_mat("validarExistencia.php","2=@inventario","id_inv=@"+idinventario()+"=@status_inv=@"+"REGISTRADO");}


function validarmateriales_mat(){ conexionPHP_mat("validarExistencia.php","1=@materiales","id_m=@"+id_m());}

function validarmateriales2(){ conexionPHP_mat("validarExistencia.php","1=@mat_padre","numero_mat=@"+numero_mat());}
function validarmateriales3(){ conexionPHP_mat("validarExistencia.php","1=@mat_padre","nombre_mat=@"+nombre_mat());}


function validarmat_padre4(){ conexionPHP_mat("validarExistencia.php","2=@vista_materiales","id_dep=@"+document.f1.id_dep.value+"=@numero_mat=@"+numero_mat());}
function validarmat_padre_mov_mat(){if(valSelDep()){  conexionPHP_mat("validarExistencia.php","2=@vista_materiales","id_dep=@"+document.f1.iddep.value+"=@nombre_mat=@"+document.f1.nombre_mat.value);}}
function validarmat_padre_mov_mat_autocomp(nombre){if(valSelDep()){ conexionPHP_mat("validarExistencia.php","2=@vista_materiales","id_dep=@"+document.f1.iddep.value+"=@nombre_mat=@"+nombre);}}
function validarmat_padre_mov_mat02(){ if(valSelDep()){  conexionPHP_mat("validarExistencia.php","2=@vista_materiales","id_dep=@"+document.f1.iddep.value+"=@numero_mat=@"+document.f1.numero_mat.value);}}

function validarmat_padre_mov_mat_autocomp_orden(nombre){if(valSelDep()){ conexionPHP_mat("validarExistencia.php","2=@vista_materiales_orden","id_dep=@"+document.f1.iddep.value+"=@nombre_mat=@"+nombre);}}
function validarmat_padre_mov_mat02_orden(){ if(valSelDep()){  conexionPHP_mat("validarExistencia.php","2=@vista_materiales_orden","id_dep=@"+document.f1.iddep.value+"=@numero_mat=@"+document.f1.numero_mat.value);}}

function validarmat_rec_num(){ conexionPHP_mat("validarExistencia.php","2=@vista_materiales","numero_mat=@"+numero_mat()+"=@id_dep=@"+document.f1.id_dep.value);}

function validarmat_rec_nom(){ conexionPHP_mat("validarExistencia.php","2=@vista_materiales","nombre_mat=@"+nombre_mat()+"=@id_dep=@"+document.f1.id_dep.value);}
function validarmateriales3_autocomp(data){ conexionPHP_mat("validarExistencia.php","2=@vista_materiales","nombre_mat=@"+data+"=@id_dep=@"+document.f1.id_dep.value);}
//function validarmateriales3_autocomp(data){ conexionPHP_mat("validarExistencia.php","1=@mat_padre","nombre_mat=@"+data);}


function validarmov_mat(){ conexionPHP_mat("validarExistencia.php","1=@mov_mat","id_mat=@"+id_mat());}
function validarmat_prov(){ conexionPHP_mat("validarExistencia.php","1=@mat_prov","id_mat=@"+id_mat());}
function validarmat_ped(){ conexionPHP_mat("validarExistencia.php","1=@mat_ped","id_mat=@"+id_mat());}
function validarinventario_mat(){ conexionPHP_mat("validarExistencia.php","1=@inventario","id_inv=@"+idinventario());}
function validaraprobarinventario(){ conexionPHP_mat("validarExistencia.php","1=@aprobarinventario","dato=@"+data());}
function validarmat_padre(){ conexionPHP_mat("validarExistencia.php","1=@mat_padre","id_m=@"+id_m());}
function validarmat_padre2(){ conexionPHP_mat("validarExistencia.php","1=@mat_padre","numero_mat=@"+numero_mat());setTimeout("valida_mat_t02('id_m')",600);valida_mat_t02('id_m');}

function validarmat_padre_bus(){ conexionPHP_mat("validarExistencia.php","1=@mat_padre","numero_mat=@"+numero_mat());}

function validarmat_padre3(){ conexionPHP_mat("validarExistencia.php","1=@mat_padre","nombre_mat=@"+nombre_mat());}
function validarejempl(){ conexionPHP_mat("validarExistencia.php","1=@ejempl","dato=@"+data());}
function validarDato(){ conexionPHP_mat("validarExistencia.php","1=@Dato","dato=@"+dato());}
//funciones para obtener los valores de un formulario
function idPersona(){return document.f1.idPersona.value;}
function id_persona(){return document.f1.id_persona.value;}
function cedula(){return document.f1.cedula.value;}
function nombre(){return document.f1.nombre.value;}
function name(){return document.f1.name.value;}
function apellido(){return document.f1.apellido.value;}
function email(){return document.f1.email.value;}
function telefono(){return document.f1.telefono.value;}
function codigoperfil(){return document.f1.codigoperfil.value;}
function usuario(){return document.f1.login.value;}
function password(){return document.f1.password.value;}
function otropassword(){return document.f1.otropassword.value;}
function codigo(){return document.f1.codigo.value;}
function descripcion(){return document.f1.descripcion.value;}
function database(){return document.f1.database.value;}
function servidor(){return document.f1.servidor.value;}
function objeto(){return document.f1.objeto.value;}
function codigoModulo(){return document.f1.codigomodulo.options[document.f1.codigomodulo.selectedIndex].text;}
//APLICATEM - para seguir agregando funciones
function asdfasd(){return document.f1.asdfasd.value;}
function NomBrero(){return document.f1.NomBrero.value;}
function id_motivo(){return document.f1.id_motivo.value;}
function nombre_motivo(){return document.f1.nombre_motivo.value;}
function id_fam(){return document.f1.id_fam.value;}
function nombre_fam(){return document.f1.nombre_fam.value;}
function id_mat(){return document.f1.id_mat.value;}
function id_inv(){return document.f1.id_inv.value;}
function cant_sist(){return document.f1.cant_sist.value;}
function cant_real(){return document.f1.cant_real.value;}
function justi_inv(){return document.f1.justi_inv.value;}
function id_dep(){return document.f1.id_dep.value;}
function id_gt(){return document.f1.id_gt.value;}
function nombre_dep(){return document.f1.nombre_dep.value;}
function descrip_dep(){return document.f1.descrip_dep.value;}
function id_unidad(){return document.f1.id_unidad.value;}
function uni_id_unidad(){return document.f1.uni_id_unidad.value;}
function nombre_unidad(){return document.f1.nombre_unidad.value;}
function abreviatura(){return document.f1.abreviatura.value;}

function id_tm(){return document.f1.id_tm.value;}
function nombre_tm(){return document.f1.nombre_tm.value;}
function tipo_ent_sal(){return document.f1.tipo_ent_sal.value;}
function uso_tm(){return document.f1.uso_tm.value;}

function id_mov(){return document.f1.id_mov.value;}
function id_mov2(){return document.f1.id_mov2.value;}
function id_tmdescuento(){return document.f1.id_tmdescuento.value;}
function id_tmaunmento(){return document.f1.id_tmaunmento.value;}
function fecha_ent_sal(){return document.f1.fecha_ent_sal.value;}
function hora_ent_sal(){return document.f1.hora_ent_sal.value;}
function observacion(){return document.f1.observacion.value;}
function referencia(){return document.f1.referencia.value;}
function tipo_mov(){return document.f1.tipo_mov.value;}
function id_prov(){return document.f1.id_prov.value;}
function rif_prov(){return document.f1.rif_prov.value;}
function nombre_prov(){return document.f1.nombre_prov.value;}
function direccion_prov(){return document.f1.direccion_prov.value;}
function telefonos_prov(){return document.f1.telefonos_prov.value;}
function fax_prov(){return document.f1.fax_prov.value;}
function web_prov(){return document.f1.web_prov.value;}
function email_prov(){return document.f1.email_prov.value;}
function obser_prov(){return document.f1.obser_prov.value;}
function forma_pago(){return document.f1.forma_pago.value;}
function banco(){return document.f1.banco.value;}
function cuenta(){return document.f1.cuenta.value;}
function contacto(){return document.f1.contacto.value;}
function id_ped(){return document.f1.id_ped.value;}
function fecha_ped(){return document.f1.fecha_ped.value;}
function status_ped(){return document.f1.status_ped.value;}
function fecha_ent(){return document.f1.fecha_ent.value;}
function obser_ped(){return document.f1.obser_ped.value;}
function nro_fact_ped(){return document.f1.nro_fact_ped.value;}
function porc_desc(){return document.f1.porc_desc.value;}
function desc_ped(){return document.f1.desc_ped.value;}
function base_ped(){return document.f1.base_ped.value;}
function iva_ped(){return document.f1.iva_ped.value;}
function total_ped(){return document.f1.total_ped.value;}
function numero_mat(){return document.f1.numero_mat.value;}
function nombre_mat(){return document.f1.nombre_mat.value;}
function stock(){return document.f1.stock.value;}
function stock_min(){return document.f1.stock_min.value;}
function precio_u_p(){return document.f1.precio_u_p.value;}
function c_uni_ent(){return document.f1.c_uni_ent.value;}
function c_uni_sal(){return document.f1.c_uni_sal.value;}
function cant_mov(){return document.f1.cant_mov.value;}
function cant_ped(){return document.f1.cant_ped.value;}
function cant_ent(){return document.f1.cant_ent.value;}
function precio(){return document.f1.precio.value;}
function idinventario(){return document.f1.idinventario.value;}
function idmotivo(){return document.f1.idmotivo.value;}
function fechainv(){return document.f1.fechainv.value;}
function horainv(){return document.f1.horainv.value;}
function obserinv(){return document.f1.obserinv.value;}
function status_inv(){return document.f1.status_inv.value;}
function tipoinv(){return document.f1.tipoinv.value;}
function iddep(){return document.f1.iddep.value;}
function iddep2(){return document.f1.iddep2.value;}
function idfam(){return document.f1.idfam.value;}
function id_m(){return document.f1.id_m.value;}
function impresion(){return document.f1.impresion.value;}
function id_te(){return document.f1.id_te.value;}
function nombre_te(){return document.f1.nombre_te.value;}
function descrip_ent(){return document.f1.descrip_ent.value;}
function status_ent(){return document.f1.status_ent.value;}
function id_c_mat(){return document.f1.id_c_mat.value;}
function hab_alerta_min(){return document.f1.hab_alerta_min.value;}
function hab_desc_alm_gru(){return document.f1.hab_desc_alm_gru.value;}
function hab_desc_alm_gen(){return document.f1.hab_desc_alm_gen.value;}
function hab_mat_orden(){return document.f1.hab_mat_orden.value;}
function hab_imp_mat(){return document.f1.hab_imp_mat.value;}
function id_deposito(){return document.f1.id_deposito.value;}
function data(){return document.f1.dato.value;}

//es llamada cuando se desea incluir, modificar o eliminar datos de una tabla.
//tipoDato: representa la operacion que desea hacer; incluir, modificar o eliminar
//clase: a que  clase o tabla  desea hacer la operacion
function verificar_mat(tipoDato,clase)
{
  switch(clase)
  {
	//clase o tabla usuario
	case "Usuario":
		//antes de hacer la peticion valida los campos si es cedula, tipo seleccion o lista, alfanumericos, password
	  if(validaCampo(document.f1.cedula,isCedula) &&
		validaCampo(document.f1.codigoperfil,isSelect) && 
		validaCampo(document.f1.login,isAlphanumeric) && 
		validaCampo(document.f1.password,isPassword)){
			if(document.f1.password.value!=document.f1.otropassword.value){
				alert("La Contraseña no coincide con la otra");
				document.f1.password.focus(); return; 
			}
			else{
				//al llegar aqui todos los campos del formulario son correctos
				//llama a la funcion confirmacion para confirmar el envio de los datos
				//y se le envia como parametro el (la operacion,la clase,y la lista de parametros concatenados con =@)
				confirmacion_mat(tipoDato,clase,usuario()+"=@"+password()+"=@"+verStatus()+"=@"+codigoperfil()+"=@"+cedula());
			 }
		}
		break;
	case "Perfil":
	  if(validaCampo(document.f1.codigo,isAlphanumeric) &&
		validaCampo(document.f1.descripcion,isTexto) &&
		validaCampo(document.f1.nombre,isName)){
			if(confirm('seguro que desea enviar este formulario?')){
				conexionPHP_mat("administrar.php","ModuloPerfil",codigo()+"=@=@=@=@","eliminarPerfil");
				if(tipoDato!="eliminar"){ 
					cambiarModulo_mat("incluir",clase); 
				}
				conexionPHP_mat("administrar.php",clase,codigo()+"=@"+nombre()+"=@"+descripcion()+"=@"+verStatus(),tipoDato);
			}
		}
		break;
	case "Persona":
		if(validaCampo(document.f1.idPersona,isAlphanumeric) && validaCampo(document.f1.cedula,isCedula) && validaCampo(document.f1.nombre,isName) && validaCampo(document.f1.apellido,isName) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_mat(tipoDato,clase,idPersona()+"=@"+cedula()+"=@"+nombre()+"=@"+apellido()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "motivo_inv":
		if(validaCampo(document.f1.id_motivo,isAlphanumeric) && validaCampo(document.f1.nombre_motivo,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_mat(tipoDato,clase,id_motivo()+"=@"+nombre_motivo()+"=@"+verRadiostatus_motivo()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "familia":
		if(validaCampo(document.f1.id_fam,isAlphanumeric) && validaCampo(document.f1.nombre_fam,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_mat(tipoDato,clase,id_fam()+"=@"+nombre_fam()+"=@"+verRadiostatus_fam()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "inventario_materiales":
		if(validaCampo(document.f1.id_mat,isAlphanumeric) && validaCampo(document.f1.id_inv,isAlphanumeric) && validaCampo(document.f1.cant_sist,isInteger) && validaCampo(document.f1.cant_real,isNumber) && validaCampo(document.f1.justi_inv,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_mat(tipoDato,clase,id_mat()+"=@"+id_inv()+"=@"+cant_sist()+"=@"+cant_real()+"=@"+justi_inv()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "deposito":
		if(validaCampo(document.f1.id_dep,isAlphanumeric) && validaCampo(document.f1.nombre_dep,isTexto) && validaCampo(document.f1.descrip_dep,isTexto) && validaCampo(document.f1.dato,isTexto)&& validaGtPersona())
		{
			//alert("=@"+nombre_dep()+"=@"+descrip_dep()+"=@"+verRadiostatus_dep()+"=@"+traerGtPerso()+"=@"+data());
			confirmacion_mat(tipoDato,clase,document.f1.id_dep.value+"=@"+nombre_dep()+"=@"+descrip_dep()+"=@"+verRadiostatus_dep()+"=@"+traerGtPerso()+"=@"+data()+"=@"+id_franq());
				//document.f1.reset();
		}
		break;
	case "unidad_medida":
		if(validaCampo(document.f1.id_unidad,isAlphanumeric) && validaCampo(document.f1.nombre_unidad,isTexto) && validaCampo(document.f1.abreviatura,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_mat(tipoDato,clase,id_unidad()+"=@"+nombre_unidad()+"=@"+abreviatura()+"=@"+verRadiostatus_unidad()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "tipo_movimiento":
		if(validaCampo(document.f1.id_tm,isAlphanumeric) && validaCampo(document.f1.nombre_tm,isTexto) && validaCampo(document.f1.tipo_ent_sal,isSelect) && validaCampo(document.f1.uso_tm,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_mat(tipoDato,clase,id_tm()+"=@"+nombre_tm()+"=@"+tipo_ent_sal()+"=@"+uso_tm()+"=@"+verRadiostatus_tm()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "movimiento":
		//alert(id_mov()+"=@"+valor[0]+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+observacion()+"=@"+referencia()+"=@"+iddep()+"=@"+id_persona()+"-Class-incluir=@mov_mat=@"+document.getElementById("numero_m").value+"=@"+id_mov()+"=@"+document.getElementById("cantNew").value+"=@"+data());
		if(validaCampo(document.f1.id_mov,isAlphanumeric)  && valdate(fecha_ent_sal()) && validaCampo(document.f1.id_tm,isSelect) && valdate(fecha_ent_sal()) && validaCampo(document.f1.hora_ent_sal,isTexto)  && validaCampo(document.f1.id_persona,isSelect) && valida_ent_mov())
		{
			valor=id_tm().split("==");			
			//confirmacion_mat(tipoDato,clase,id_mov()+"=@"+valor[0]+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+observacion()+"=@"+referencia()+"=@"+iddep()+"=@"+data()+traer_mov_mat());
			//alert("=@"+valor[0]+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+observacion()+"=@"+referencia()+"=@"+iddep()+"=@"+data()+"-Class-incluir=@mov_mat=@"+document.getElementById("numero_m").value+"=@"+id_mov()+"=@"+document.getElementById("cantNew").value+"=@"+data());
			if(document.getElementById("auxi").value=="0"){
				confirmacion_mat1(tipoDato,clase,id_mov()+"=@"+valor[0]+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+observacion()+"=@"+referencia()+"=@"+iddep()+"=@"+id_persona()+"-Class-incluir=@mov_mat=@"+document.getElementById("numero_m").value+"=@"+id_mov()+"=@"+document.getElementById("cantNew").value+"=@"+data());
			}else{
				combinado=document.getElementById("numero_m").value+"<@@>"+valor[1];
					confirmacion_mat1("modificar",clase,id_mov()+"=@"+valor[0]+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+observacion()+"=@"+referencia()+"=@"+iddep()+"=@"+id_persona()+"-Class-eliminar=@mov_mat=@"+document.getElementById("numero_m").value+"=@"+id_mov()+"=@"+document.getElementById("cantNew").value+"=@"+combinado+"-Class-incluir=@mov_mat=@"+document.getElementById("numero_m").value+"=@"+id_mov()+"=@"+document.getElementById("cantNew").value+"=@"+data());
			}
		}
		break;
	case "movimiento_orden":
		if(validaCampo(document.f1.id_mov,isAlphanumeric)  && valdate(fecha_ent_sal()) && validaCampo(document.f1.id_tm,isSelect) && valdate(fecha_ent_sal()) && validaCampo(document.f1.hora_ent_sal,isTexto)  && validaCampo(document.f1.id_persona,isSelect) && valida_ent_mov())
		{
			valor=id_tm().split("==");			
			if(document.getElementById("auxi").value=="0"){
				confirmacion_mat1(tipoDato,clase,id_mov()+"=@"+valor[0]+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+observacion()+"=@"+referencia()+"=@"+iddep()+"=@"+id_persona()+"-Class-incluir=@mov_mat_orden=@"+document.getElementById("numero_m").value+"=@"+id_mov()+"=@"+document.getElementById("cantNew").value+"=@"+data());
			}else{
				combinado=document.getElementById("numero_m").value+"<@@>"+valor[1];
					confirmacion_mat1("modificar",clase,id_mov()+"=@"+valor[0]+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+observacion()+"=@"+referencia()+"=@"+iddep()+"=@"+id_persona()+"-Class-eliminar=@mov_mat_orden=@"+document.getElementById("numero_m").value+"=@"+id_mov()+"=@"+document.getElementById("cantNew").value+"=@"+combinado+"-Class-incluir=@mov_mat_orden=@"+document.getElementById("numero_m").value+"=@"+id_mov()+"=@"+document.getElementById("cantNew").value+"=@"+data());
			}
		}
		break;
	case "movimiento_transferencia":
		clase="movimiento";
		id=document.getElementById("numero_m").value;
		//valor=id_tm().split("==");	
		if(validaCampo(document.f1.id_mov,isAlphanumeric) && validaCampo(document.f1.iddep2,isSelect) &&  valdate(fecha_ent_sal()) && validaCampo(document.f1.hora_ent_sal,isTexto) && validaCampo(document.f1.observacion,isTexto) && validaCampo(document.f1.tipo_mov,isTexto) && validaCampo(document.f1.id_persona,isSelect)  && valida_ent_mov())
		{
			if(document.getElementById("auxi").value=="0"){
				confirmacion_mat1(tipoDato,clase,id_mov()+"=@"+id_tmdescuento()+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+observacion()+"=@"+id_mov2()+"=@"+iddep()+"=@"+id_persona()+"-Class-incluir=@mov_mat=@"+id+"=@"+id_mov()+"=@"+document.getElementById("cantNew").value+"=@"+data()+"-Class-incluir=@movimiento=@"+id_mov2()+"=@"+id_tmaunmento()+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+observacion()+"=@"+id_mov()+"=@"+iddep2()+"=@"+data()+"-Class-incluir=@mov_mat=@"+id+"=@"+id_mov2()+"=@"+document.getElementById("cantNew").value+"=@"+document.f1.iddep2.value+"<@@>"+document.getElementById("id_m").value);
			}else{
				combinado=document.getElementById("numero_m").value+"<@@>"+"SALIDA";
				combinado2=document.getElementById("numero_m").value+"<@@>"+"ENTRADA";
				confirmacion_mat1("modificar",clase,id_mov()+"=@"+id_tmdescuento()+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+observacion()+"=@"+id_mov2()+"=@"+iddep()+"=@"+id_persona()+"-Class-eliminar=@mov_mat=@"+document.getElementById("numero_m").value+"=@"+id_mov()+"=@"+document.getElementById("cantNew").value+"=@"+combinado+"-Class-incluir=@mov_mat=@"+id+"=@"+id_mov()+"=@"+document.getElementById("cantNew").value+"=@"+data()+"-Class-modificar=@movimiento=@"+id_mov2()+"=@"+id_tmaunmento()+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+observacion()+"=@"+id_mov()+"=@"+iddep2()+"=@"+data()+"-Class-eliminarDos=@mov_mat=@"+document.getElementById("numero_m").value+"=@"+id_mov2()+"=@"+document.f1.iddep2.value+"<@@>"+document.getElementById("id_m").value+"=@"+combinado2+"-Class-incluir=@mov_mat=@"+id+"=@"+id_mov2()+"=@"+document.getElementById("cantNew").value+"=@"+document.f1.iddep2.value+"<@@>"+document.getElementById("id_m").value);
			}
		}
		break;
	case "proveedor":
		if(validaCampo(document.f1.id_prov,isAlphanumeric) && validaCampo(document.f1.rif_prov,isTexto) && validaCampo(document.f1.nombre_prov,isTexto) && validaCampo(document.f1.direccion_prov,isTexto) && validaCampo(document.f1.telefonos_prov,isTexto) && validaCampo(document.f1.fax_prov,isTexto) && validaCampo(document.f1.web_prov,isTexto,true) && validaCampo(document.f1.email_prov,isEmail,true) && validaCampo(document.f1.obser_prov,isTexto) && validaCampo(document.f1.forma_pago,isSelect) && validaCampo(document.f1.banco,isTexto) && validaCampo(document.f1.cuenta,isNumber) && validaCampo(document.f1.contacto,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_mat(tipoDato,clase,document.f1.id_prov.value+"=@"+rif_prov()+"=@"+nombre_prov()+"=@"+direccion_prov()+"=@"+telefonos_prov()+"=@"+fax_prov()+"=@"+web_prov()+"=@"+email_prov()+"=@"+obser_prov()+"=@"+forma_pago()+"=@"+banco()+"=@"+cuenta()+"=@"+contacto()+"=@"+verRadiostatus_prov()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "pedido":
		if(validaCampo(document.f1.id_ped,isAlphanumeric) && validaCampo(document.f1.id_prov,isSelect) && valdate(fecha_ped()) && valdate(fecha_ent()) && validaCampo(document.f1.obser_ped,isTexto) && validaCampo(document.f1.nro_fact_ped,isTexto) && validaCampo(document.f1.porc_desc,isNumber) && validaCampo(document.f1.desc_ped,isNumber) && validaCampo(document.f1.base_ped,isNumber) && validaCampo(document.f1.iva_ped,isNumber) && validaCampo(document.f1.total_ped,isNumber) && validaCampo(document.f1.dato,isTexto) && valida_mat_pedido())
		{
			if(confirmacion_mat(tipoDato,clase,id_ped()+"=@"+document.f1.id_prov.value+"=@"+formatdate(fecha_ped())+"=@"+formatdate(fecha_ent())+"=@"+status_ped()+"=@"+obser_ped()+"=@"+nro_fact_ped()+"=@"+porc_desc()+"=@"+desc_ped()+"=@"+base_ped()+"=@"+iva_ped()+"=@"+total_ped()+"=@"+data()+"-Class-eliminarMatPedido=@pedido=@"+id_ped()+"=@=@=@=@=@=@=@=@=@=@=@=@"+data()+traerPedido()))
				document.f1.reset();
		}
		break;
	case "realizar_compra":
		if(validaCampo(document.f1.id_ped,isAlphanumeric) && validaCampo(document.f1.id_prov,isSelect) && valdate(fecha_ped()) && valdate(fecha_ent()) && validaCampo(document.f1.obser_ped,isTexto) && validaCampo(document.f1.nro_fact_ped,isTexto) && validaCampo(document.f1.porc_desc,isNumber) && validaCampo(document.f1.desc_ped,isNumber) && validaCampo(document.f1.base_ped,isNumber) && validaCampo(document.f1.iva_ped,isNumber) && validaCampo(document.f1.total_ped,isNumber) && validaCampo(document.f1.dato,isTexto) && valida_mat_pedido() && validaPrecio())
		{
			confirmacion_mat(tipoDato,"pedido",id_ped()+"=@"+document.f1.id_prov.value+"=@"+formatdate(fecha_ped())+"=@"+formatdate(fecha_ent())+"=@"+status_ped()+"=@"+obser_ped()+"=@"+nro_fact_ped()+"=@"+porc_desc()+"=@"+desc_ped()+"=@"+base_ped()+"=@"+iva_ped()+"=@"+total_ped()+"=@"+data()+"-Class-eliminarMatPedido=@pedido=@"+id_ped()+"=@=@=@=@=@=@=@=@=@=@=@=@"+data()+traerPedido2()+"-Class-incluir=@movimiento=@"+id_mov()+"=@"+id_tm()+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+"COMPRA"+"=@"+id_ped()+"=@"+tipo_mov()+"=@"+data()+traer_mov_mat2())
			
		}
		break;
	case "materiales":
	//alert(clase);
		if(validaCampo(document.f1.id_mat,isAlphanumeric) && validaCampo(document.f1.numero_mat,isAlphanumeric) && validaCampo(document.f1.nombre_mat,isTexto) && validaCampo(document.f1.id_unidad,isSelect)&& validaCampo(document.f1.uni_id_unidad,isSelect) && validaCampo(document.f1.id_dep,isSelect) && validaCampo(document.f1.id_fam,isSelect) && validaCampo(document.f1.stock,isInteger) && validaCampo(document.f1.stock_min,isInteger)  && validaCampo(document.f1.c_uni_ent,isInteger) && validaCampo(document.f1.c_uni_sal,isInteger) && validaCampo(document.f1.id_m,isTexto))
		{
			confirmacion_mat(tipoDato,clase,id_mat()+"=@"+numero_mat()+"=@"+nombre_mat()+"=@"+id_unidad()+"=@"+uni_id_unidad()+"=@"+document.f1.id_dep.value+"=@"+id_fam()+"=@"+stock()+"=@"+stock_min()+"=@"+observacion()+"=@"+precio_u_p()+"=@"+c_uni_ent()+"=@"+c_uni_sal()+"=@"+id_m()+"=@"+impresion())
				//document.f1.reset();
		}
		break;
	case "mov_mat":
		if(validaCampo(document.f1.id_mat,isAlphanumeric) && validaCampo(document.f1.id_mov,isAlphanumeric) && validaCampo(document.f1.cant_mov,isInteger) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_mat(tipoDato,clase,id_mat()+"=@"+id_mov()+"=@"+cant_mov()+"=@"+data()))
				document.f1.reset();
		}
		break;
	/*case "motivo_inv":
		if(validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_mat(tipoDato,clase,data()))
				document.f1.reset();
		}
		break;*/
	case "mat_prov":
		if(validaCampo(document.f1.id_prov,isSelect) && validaCampo(document.f1.dato,isTexto) )
		{
		if(confirmacion_mat("eliminarMatProv","proveedor",document.f1.id_prov.value+"=@=@=@=@=@=@=@=@=@=@=@=@=@=@"+data()+traer_mat_prov())){
		}
			
		}
		break;
	case "mat_ped":
		if(validaCampo(document.f1.id_mat,isAlphanumeric) && validaCampo(document.f1.id_ped,isAlphanumeric) && validaCampo(document.f1.cant_ped,isInteger) && validaCampo(document.f1.cant_ent,isInteger) && validaCampo(document.f1.precio,isNumber) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_mat(tipoDato,clase,id_mat()+"=@"+id_ped()+"=@"+cant_ped()+"=@"+cant_ent()+"=@"+precio()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "inventario":		
		if(validaCampo(document.f1.idinventario,isAlphanumeric) && validaCampo(document.f1.iddep,isSelect) && validaCampo(document.f1.idmotivo,isSelect) && valdate(fechainv()) && validaCampo(document.f1.horainv,isTexto) && validaCampo(document.f1.obserinv,isTexto) && validaCampo(document.f1.tipoinv,isTexto)   && validaCampo(document.f1.dato,isTexto))
		{
			//alert("=@"+idmotivo()+"=@"+formatdate(fechainv())+"=@"+horainv()+"=@"+obserinv()+"=@"+tipoinv()+"=@"+iddep()+"=@"+idfam()+"=@"+data())
			//confirmacion_mat(tipoDato,clase,idinventario()+"=@"+idmotivo()+"=@"+formatdate(fechainv())+"=@"+horainv()+"=@"+obserinv()+"=@"+tipoinv()+"=@"+iddep()+"=@"+idfam()+"=@"+status_inv()+"=@"+data()+traer_inv_mat_ingresar())
			//traer_inv_mat_modificar
			if(tipoDato!="modificar"){				
				confirmacion_mat(tipoDato,clase,idinventario()+"=@"+idmotivo()+"=@"+formatdate(fechainv())+"=@"+horainv()+"=@"+obserinv()+"=@"+tipoinv()+"=@"+iddep()+"=@"+idfam()+"=@"+status_inv()+"=@"+data()+traer_inv_mat_ingresar())
			}else{
				if(valida_inv_mat())
				{
					confirmacion_mat(tipoDato,clase,idinventario()+"=@"+idmotivo()+"=@"+formatdate(fechainv())+"=@"+horainv()+"=@"+obserinv()+"=@"+tipoinv()+"=@"+iddep()+"=@"+idfam()+"=@"+"REVISADO"+"=@"+data()+traer_inv_mat_modificar())
				}
			}
		}
		break;
	case "aprobarinventario":
		if(validaCampo(document.f1.idinventario,isAlphanumeric) && validaCampo(document.f1.idmotivo,isSelect) && valdate(fechainv()) && validaCampo(document.f1.horainv,isTexto) && validaCampo(document.f1.obserinv,isTexto) && validaCampo(document.f1.tipoinv,isTexto)   && validaCampo(document.f1.dato,isTexto) && valida_inv_mat())
		{
			clase="inventario";
			//alert(traer_mov_mat_inventario());
			confirmacion_mat(tipoDato,clase,idinventario()+"=@"+idmotivo()+"=@"+formatdate(fechainv())+"=@"+horainv()+"=@"+obserinv()+"=@"+tipoinv()+"=@"+iddep()+"=@"+idfam()+"=@"+status_inv()+"=@"+data()+traer_inv_mat_modificar()+traer_mov_mat_inventario())
		}
		break;
	case "mat_padre":
		if(validaCampo(document.f1.id_m,isAlphanumeric) && validaCampo(document.f1.id_unidad,isSelect)&& validaCampo(document.f1.uni_id_unidad,isSelect) && validaCampo(document.f1.id_fam,isSelect) && validaCampo(document.f1.numero_mat,isAlphanumeric) && validaCampo(document.f1.nombre_mat,isTexto) && validaCampo(document.f1.precio_u_p,isNumber) && validaCampo(document.f1.c_uni_ent,isInteger) && validaCampo(document.f1.c_uni_sal,isInteger) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_mat(tipoDato,clase,id_m()+"=@"+id_unidad()+"=@"+uni_id_unidad()+"=@"+id_fam()+"=@"+numero_mat()+"=@"+nombre_mat()+"=@"+precio_u_p()+"=@"+c_uni_ent()+"=@"+c_uni_sal()+"=@"+impresion()))
				document.f1.reset();
		}
		break;
	case "tipo_entidad":
		if(validaCampo(document.f1.id_te,isAlphanumeric) && validaCampo(document.f1.nombre_te,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_mat(tipoDato,clase,id_te()+"=@"+nombre_te()+"=@"+verRadiostatus_te()+"=@"+data()))
				document.f1.reset();
		}
		break;
	case "entidad":
		//alert(id_persona()+"=@"+cedula()+"=@"+nombre()+"=@"+apellido()+"=@"+telefono()+"=@"+id_te()+"=@"+descrip_ent()+"=@"+verRadiostatus_ent());
		if(validaCampo(document.f1.id_persona,isAlphanumeric) && validaCampo(document.f1.cedula,isCedula) && validaCampo(document.f1.nombre,isName) && validaCampo(document.f1.apellido,isName) && validaCampo(document.f1.telefono,isPhoneNumber) && validaCampo(document.f1.id_te,isSelect) && validaCampo(document.f1.descrip_ent,isTexto) && validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_mat(tipoDato,clase,id_persona()+"=@"+cedula()+"=@"+nombre()+"=@"+apellido()+"=@"+telefono()+"=@"+id_te()+"=@"+descrip_ent()+"=@"+verRadiostatus_ent()))
				document.f1.reset();
		}
		break;
	case "config_mat":
		if(valConfMatDep()){
			confirmacion_mat(tipoDato,clase,id_c_mat()+"=@"+id_franq()+"=@"+hab_alerta_min()+"=@"+hab_desc_alm_gru()+"=@"+hab_desc_alm_gen()+"=@"+hab_mat_orden()+"=@"+id_deposito()+"=@"+hab_imp_mat());
		}
		break;
	case "ejempl":
		if(validaCampo(document.f1.dato,isTexto))
		{
			if(confirmacion_mat(tipoDato,clase,data()))
				document.f1.reset();
		}
		break;
	default:
		verificarAplicaTem(tipoDato,clase);
  }
}
//para que el usuario confirme antes de enviar el formulario
function confirmacion_mat1(tipoDato,clase,cadena){						
		conexionPHP_mat("administrar.php",clase,cadena,tipoDato);		
}
function confirmacion_mat(tipoDato,clase,cadena){						
	if (confirm('seguro que desea enviar este formulario?')){
		//hace la llamada para hacer la conexion con php
		conexionPHP_mat("administrar.php",clase,cadena,tipoDato);		
		return true;
	}
	else
		return false;
}
//SEGURIDAD - permite darle permiso de incluir, modificar o eliminar a un perfil.
function cambiarModulo_mat(tipoDato,clase){
	var tam = document.f1.modulo.length;  
	var i=0;
	var cade='';
	var incluir='';
	var modificar='';
	var eliminar='';
	var cont=0;
	for(i=0;i<tam;i=i+4){
		if(clase=="Modulo"){
			if (document.f1.modulo[i].checked == true){
				if (document.f1.modulo[i+1].checked == true)
					incluir='true';
				else
					incluir='false';
				if (document.f1.modulo[i+2].checked == true)
					modificar='true';
				else
					modificar='false';
				if(document.f1.modulo[i+3].checked == true)
					eliminar='true';
				else
					eliminar='false';

				if(cont==0){
					cade=trim(document.f1.modulo[i].value)+"=@"+codigo()+"=@"+incluir+"=@"+modificar+"=@"+eliminar;
				}
				else
				{
					cade=cade+"-Class-"+tipoDato+"=@ModuloPerfil=@"+trim(document.f1.modulo[i].value)+"=@"+codigo()+"=@"+incluir+"=@"+modificar+"=@"+eliminar;
				}
				cont++;
			}
		}
		else if(clase=="Perfil"){ 
			if(document.f1.modulo[i].checked == true){				
				if (document.f1.modulo[i+1].checked == true)
					incluir='true';
				else
					incluir='false';
				if (document.f1.modulo[i+2].checked == true)
					modificar='true';
				else
					modificar='false';
				if (document.f1.modulo[i+3].checked == true)
					eliminar='true';
				else
					eliminar='false';
				if(cont==0){
					cade=codigo()+"=@"+trim(document.f1.modulo[i].value)+"=@"+incluir+"=@"+modificar+"=@"+eliminar;
				}
				else
				{
					cade=cade+"-Class-"+tipoDato+"=@ModuloPerfil=@"+codigo()+"=@"+trim(document.f1.modulo[i].value)+"=@"+incluir+"=@"+modificar+"=@"+eliminar;
				}
				cont++;
			}
		}
	}
	if(cade!='')
	{
		conexionPHP_mat("administrar.php","ModuloPerfil",cade,tipoDato);
	}
	conexionPHP_mat('formulario.php',clase);
}



/****************************************************--------------------------------********************************************************************************/
/****************************************************FUNCIONES AGREGADAS POR RICARDO ********************************************************************************/
/***************************************************----------------------------------*******************************************************************************/
function pasaRvalorUni(){document.f1.uni_id_unidad.value=id_unidad();}
function pasaRvalorCan(){document.f1.c_uni_sal.value=c_uni_ent();}
function func_vacia(){return;}
function habiTodosMov(){
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		if(document.f1.checkbox[i].checked == true){
			
			document.getElementById("cant_"+id).disabled=false;
		}else{
			document.getElementById("cant_"+id).disabled=true;
		
		}
	}
}
function valida_mov_mat(){
	paso=0;
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		if(document.f1.checkbox[i].checked == true){
			paso=1;
			if(document.getElementById("cant_"+id).value==""){
				alert("Ingrese un valor valido en el campo cantidad.");
				document.getElementById("cant_"+id).focus();
				return false;
			}
		}
	}
	if(paso==0){
		alert("Debe seleccionar algun material");
		return false;
	}else{
		return true;
	}
	
}
function valida_mat_pedido(){
	paso=0;
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		if(document.f1.checkbox[i].checked == true){
			paso=1;
			if(document.getElementById("cant_"+id).value==""){
				alert("Ingrese un valor valido en el campo cantidad.");
				document.getElementById("cant_"+id).focus();
				return false;
			}
		}
	}
	if(paso==0){
		alert("Debe seleccionar algun material");
		return false;
	}else{
		return true;
	}
	
}
function calcuSalida_Pedido(id){
		cannew=parseInt(document.getElementById("cantNew_"+id).value);
		csal=parseInt(document.getElementById("csal"+id).value);
		cant=parseInt(document.getElementById("cant_"+id).value);
		if(document.getElementById("cant_"+id).value == "" ){
			cant=0;
		}
		if(cant != " "  && cant != ""  && cant != 0){
			document.getElementById("cantNew_"+id).value=cant*csal;
		}else{
			document.getElementById("cantNew_"+id).value="";
		}
}
function calcuSalida(id){
		cannew=parseInt(document.getElementById("cantNew_"+id).value);
		csal=parseInt(document.getElementById("csal"+id).value);
		cant=parseInt(document.getElementById("cant_"+id).value);
		if(trim(document.getElementById("cant_"+id).value) == "" ){
			cant=0;
		}
		if(cant != " "  && cant != ""  && cant != 0){
			document.getElementById("cantNew_"+id).value=cant*csal;
		}else{
			document.getElementById("cantNew_"+id).value=0;
		}
		calcuSalida02(id);
}
function calcuSalida02(id,abre,sal_abre){
		valor=0;
		cannew=parseInt(document.getElementById("cantNew_"+id).value);
		csal=parseInt(document.getElementById("csal"+id).value);
		cant=parseInt(document.getElementById("cant_"+id).value);
		
		//cantabre=parseInt(document.getElementById("cantabre_"+id).value);
		
		//alert(cantabre);
		
		if(trim(document.getElementById("cant_"+id).value) == "" ){
			document.getElementById("cant_"+id).value=0;
			cant=0;
		}
		if(cant != " "  && cant != ""  && cant != 0){
			valor=cant*csal;
		}else{
			//document.getElementById("cantNew_"+id).value=0;
		}
		valor=cant*csal;
		
		if(abre!=sal_abre){
			cantabre=parseInt(document.getElementById('cantabre_'+id).value);
			if(trim(document.getElementById("cantabre_"+id).value) == "" ){				
				cantabre=0;
			}
			if(cantabre != " "  || cantabre != "" ||  cantabre != 0){
				valor=valor+cantabre;
			}
		}		
			document.getElementById("cantNew_"+id).value=valor;
	
}
function calcuSal(id){
		cannew=parseInt(document.getElementById("cantNew").value);
		csal=parseInt(document.getElementById("csal").value);
		cant=parseInt(document.getElementById("cant").value);
		if(trim(document.getElementById("cant").value) == "" ){
			cant=0;
		}
		if(cant != " "  && cant != ""  && cant != 0){
			document.getElementById("cantNew").value=cant*csal;
		}else{
			document.getElementById("cantNew").value=0;
		}
		calcuSal02(id);
}
function calcuSal02(id,abre,sal_abre){
		valor=0;
		cannew=parseInt(document.getElementById("cantNew").value);
		csal=parseInt(document.getElementById("csal").value);
		cant=parseInt(document.getElementById("cant").value);
		
		//cantabre=parseInt(document.getElementById("cantabre_"+id).value);
		
		//alert(cantabre);
		
		if(trim(document.getElementById("cant").value) == "" ){
			//document.getElementById("cant").value=0;
			cant=0;
		}
		if(cant != " "  && cant != ""  && cant != 0){
			valor=cant*csal;
		}else{
			//document.getElementById("cantNew_"+id).value=0;
		}
		valor=cant*csal;
		
		if(abre!=sal_abre){
			cantabre=parseInt(document.getElementById('cantabre').value);
			if(trim(document.getElementById("cantabre").value) == "" ){				
				cantabre=0;
			}
			if(cantabre != " "  || cantabre != "" ||  cantabre != 0){
				valor=valor+cantabre;
			}
		}		
			document.getElementById("cantNew").value=valor;
	
}
function traer_mov_mat(){
	var cad='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		if(document.f1.checkbox[i].checked == true){
			//cad=cad+"-Class-incluir=@mov_mat=@"+id+"=@"+id_mov()+"=@"+document.getElementById("cant_"+id).value+"=@"+data();
			cad=cad+"-Class-incluir=@mov_mat=@"+id+"=@"+id_mov()+"=@"+document.getElementById("cantNew_"+id).value+"=@"+data();
		}
	}
	if(cad!=''){
		return cad;
	}
}
function traer_mov_mat_transferD(){
	var cad='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		if(document.f1.checkbox[i].checked == true){
			//cad=cad+"-Class-incluir=@mov_mat=@"+id+"=@"+id_mov()+"=@"+document.getElementById("cant_"+id).value+"=@"+data();
			cad=cad+"-Class-incluir=@mov_mat=@"+id+"=@"+id_mov()+"=@"+document.getElementById("cantNew_"+id).value+"=@"+data();
		}
	}
	if(cad!=''){
		return cad;
	}
}
function traer_mov_mat_transferA(){
	var cad='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		if(document.f1.checkbox[i].checked == true){
			//cad=cad+"-Class-incluir=@mov_mat=@"+id+"=@"+id_mov2()+"=@"+document.getElementById("cant_"+id).value+"=@"+document.f1.iddep2.value+"<@@>"+document.getElementById("id_m_"+id).value;
			cad=cad+"-Class-incluir=@mov_mat=@"+id+"=@"+id_mov2()+"=@"+document.getElementById("cantNew_"+id).value+"=@"+document.f1.iddep2.value+"<@@>"+document.getElementById("id_m_"+id).value;
		}
	}
	if(cad!=''){
		return cad;
	}
}
function traer_mov_mat_inventario(){
	var cad='',cadD='',cadA='',cadmA='',cadmD='';
	
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		if(document.f1.checkbox[i].checked == true){
			canreal=parseInt(document.getElementById("cantNew_"+id).value);
			stock=parseInt(document.getElementById("stock_"+id).value);
			
			//alert("stock "+stock+" - canreal="+canreal);
			if(stock < canreal){
				resto=canreal-stock;
				cadA=cadA+"-Class-incluir=@mov_mat=@"+id+"=@"+id_mov()+"=@"+resto+"=@"+data();
			}else if(stock > canreal){				
				resto=stock-canreal;
				cadD=cadD+"-Class-incluir=@mov_mat=@"+id+"=@"+id_mov2()+"=@"+resto+"=@"+data();
			}
			
		}
	}
	cadmA="-Class-incluir=@movimiento=@"+id_mov()+"=@"+id_tmaunmento()+"=@"+formatdate(fechainv())+"=@"+horainv()+"=@"+"AUMENTO POR INVENTARIO"+"=@"+idinventario()+"=@"+iddep()+"=@"+data();
	cadmD="-Class-incluir=@movimiento=@"+id_mov2()+"=@"+id_tmdescuento()+"=@"+formatdate(fechainv())+"=@"+horainv()+"=@"+"DESCUENTO POR INVENTARIO"+"=@"+idinventario()+"=@"+iddep()+"=@"+data();
	
	if(cadA!=''){
		cad=cad+cadmA+cadA;
	}
	if(cadD!=''){
		cad=cad+cadmD+cadD;
	}
							
	if(cad!=''){
		return cad;
	}else{
		return '';
	}
}
function valida_mat_prov(){
	paso=0;
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		if(document.f1.checkbox[i].checked == true){
			paso=1;
		}
	}
	if(paso==0){
		alert("Debe seleccionar algun material");
		return false;
	}else{
		return true;
	}	
}
function traer_mat_prov(){
	var cad='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		if(document.f1.checkbox[i].checked == true){
			cad=cad+"-Class-incluir=@mat_prov=@"+id+"=@"+document.f1.id_prov.value+"=@"+data();
		}
	}
	if(cad!=''){
		return cad;
	}
}
///////////////////////////////FUNCIONES DEL FORMULARIO PEDIDO.PHP
function validaPedido(){
	paso=0;
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		if(document.f1.checkbox[i].checked == true){
			paso=1;
			if(document.getElementById("cant_"+id).value==""){
				alert("Ingrese un valor valido en el campo cantidad.");
				document.getElementById("cant_"+id).focus();
				return false;
			}
		}
	}
	if(paso==0){
		alert("Debe seleccionar algun material");
		return false;
	}else{
		return true;
	}	
}
function traerPedido(){
	var cad='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		if(document.f1.checkbox[i].checked == true){
			cad=cad+"-Class-incluir=@mat_ped=@"+id+"=@"+id_ped()+"=@"+document.getElementById("cant_"+id).value+"=@"+document.getElementById("cant_"+id).value+"=@"+total_ped()+"=@"+data();
		}
	}
	if(cad!=''){
		return cad;
	}
}
function traerPedido2(){
	var cad='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		if(document.f1.checkbox[i].checked == true){
			cad=cad+"-Class-incluir=@mat_ped=@"+id+"=@"+id_ped()+"=@"+document.getElementById("cant2_"+id).value+"=@"+document.getElementById("cant_"+id).value+"=@"+document.getElementById("precio_"+id).value+"=@"+data();
		}
	}
	if(cad!=''){
		return cad;
	}
}
function traer_mov_mat2(){
	
	var cad='';
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		if(document.f1.checkbox[i].checked == true){
			cad=cad+"-Class-incluir=@mov_mat=@"+id+"=@"+id_mov()+"=@"+document.getElementById("cantNew_"+id).value+"=@"+data();
		}
	}
	if(cad!=''){
		return cad;
	}
}


function llamadoUno(id,i){

//alert(document.f1.checkbox[i].checked+"  .."+id+"  .."+i);
	if(document.f1.checkbox[i].checked == true){		
			document.getElementById("cant_"+id).disabled=false;
			document.getElementById("cant_"+id).focus();
	}else{
		
		document.getElementById("cant_"+id).value="";
		document.getElementById("cant_"+id).disabled=true;	
			
	}
	
}
function llamadoUnoMovimiento(id,i){
//alert(document.f1.checkbox[i].checked+"  .."+id+"  .."+i);
	if(document.f1.checkbox[i].checked == true){			
		if(document.getElementById("cent"+id).value != document.getElementById("csal"+id).value){		
			document.getElementById("cantabre_"+id).disabled=false;
			//alert("65");
		}
			document.getElementById("cant_"+id).disabled=false;
			document.getElementById("cant_"+id).focus();
	}else{
		if(document.getElementById("cent"+id).value != document.getElementById("csal"+id).value){		
			document.getElementById("cantabre_"+id).disabled=true;
			document.getElementById("cantabre_"+id).value="";
		}
		document.getElementById("cantNew_"+id).value="";
		document.getElementById("cant_"+id).value="";
		document.getElementById("cant_"+id).disabled=true;	
			
	}
	
}
function escondeCant(id,i){
//alert(document.f1.checkbox[i].checked);
	document.getElementById("cant_"+id).value="";
	document.getElementById("cant_"+id).disabled=true;	
	//(document.f1.checkbox[i].checked == true){	
	document.f1.checkbox[i].checked=false;	
	
}
function escondeCant2(id,i){
//alert(document.f1.checkbox[i].checked);
	document.getElementById("cantabre_"+id).value="";
	document.getElementById("cantabre_"+id).disabled=true;	
	//(document.f1.checkbox[i].checked == true){	
	document.f1.checkbox[i].checked=false;	
	
}

function validar_numeros(elEvento){	var evento = elEvento || window.event;var tcl = evento.which || evento.keyCode;	if ((tcl >= 48 && tcl <= 57) || tcl==9 || tcl==13 || tcl==8 || tcl==37 || tcl==39 || tcl==46) {	return true;}return false;}


function ImprimirRep_reportepedido(){
		location.href="saecomat/reportes/Rep_reportepedidoImpreso.php";
}

function denegarPedido(estatus,cla){
	document.f1.status_ped.value=estatus;
	verificar_mat('modificar',cla);
}
//////////////////FUNCIONES PARA CARGAR LOS DATOS DE LOS INVENTARIOS EN LA TABLA DINAMICA UBICADA EN EL FORMULARIO APROBARINVENTARIO.PHP
function cargarDatosInventario(valPI,iddepo,idfami){
	document.f1.idinventario.value=valPI;
	document.getElementById("div_ped").style.display="block";
	//alert(claseGlobal);
	if(claseGlobal=="confirmarpedido"){
		idglobal="1";
	}
	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
			archivoDataGrid="procesos/datagrid_inventario.php?";
			//archivoDataGrid="procesos/datagrid_inventario.php?id_ped="+valP+"&";
		//	updateTable_mat();  //TEMBLA HICE ESTE CAMBIO PARA EVITAR QUE LLAME DOS VECES AL LISTADO
			
	document.f1.iddep.value=iddepo;
	document.f1.idfam.value=idfami;
	filtraInventario('iddep','idfam','aprobarinventario',valPI);
	validarinventario_mat();
//function idinventario(){return document.f1.idinventario.value;}
	//document.f1.id_prov.value=valProv;
	
	//conexionPHP_mat('informacion.php','pasaPedidoAconfir','id_ped=@%id_ped%')
		
}//////////////////FUNCIONES PARA CARGAR LOS DATOS DE LOS MATERIALES EN LA TABLA DINAMICA UBICADA EN EL FORMULARIO CONFIR_PEDIDO.PHP
function cargarDatosP(valP,valProv){
	document.getElementById("div_ped").style.display="block";
	if(claseGlobal=="confir_pedido"){
		idglobal="1";
	}
	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
			archivoDataGrid="procesos/datagrid_pedidoFil.php?id_ped="+valP+"&";
			updateTable_mat();
	
	
	document.f1.id_prov.value=valProv;
	
	//conexionPHP_mat('informacion.php','pasaPedidoAconfir','id_ped=@%id_ped%')
		
}
function cargarDatosP_dos(valP,valProv){
	document.getElementById("div_ped").style.display="block";
	document.f1.id_prov.value=valProv;
	document.f1.id_ped.value=valP;
	if(claseGlobal=="realizar_compra"){
		idglobal="1";
	}
	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
	archivoDataGrid="procesos/datagrid_pedidoFilcompra.php?id_ped="+valP+"&";
	updateTable_mat();
	
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function calculaTotalCP(){
	//alert(claseGlobal);
	if(claseGlobal=="realizar_compra"){
		iva=12/100;
		ivaT=0;
		//pd=iva/100+1; /////////activar para cuando no se tiene la base imponible	
		val=0;
		cant=0;
		total=0;
		baImponible=0;
		tam1=document.f1.checkbox.length;
		var i=0,j=0;
		for(j=0;j<tam1;j++){
			if(trim(document.f1.checkbox[j].value)!='on'){
				campo=trim(document.getElementById("precio_"+trim(document.f1.checkbox[j].value)).value);
				cant=trim(document.getElementById("cant_"+trim(document.f1.checkbox[j].value)).value);
				if(trim(document.f1.checkbox[j].value)!='on' && campo!="" && cant!=""){
					cant=parseInt(cant);
					val=parseFloat(campo)*cant;
					document.getElementById("preciot_"+trim(document.f1.checkbox[j].value)).value=decimalRedondear(val,2);
					baImponible=baImponible+val;			
				}else if(campo==""){
					document.getElementById("preciot_"+trim(document.f1.checkbox[j].value)).value="";
				}
			}
		}//baImponible=total/pd; /////////activar para cuando no se tiene la base imponible	
		ivaT=baImponible*iva;
		total=baImponible+ivaT;
		document.f1.base_ped.value=decimalRedondear(baImponible,2);
		document.f1.iva_ped.value=decimalRedondear(ivaT,2);
		document.f1.total_ped.value=decimalRedondear(total,2);	
	}
}
function calculaTotalCP2(){
	//alert(id);
	iva=12/100;
	ivaT=0;
	//pd=iva/100+1; /////////activar para cuando no se tiene la base imponible	
	val=0;
	cant=0;
	total=0;
	baImponible=0;
	tam1=document.f1.checkbox.length;
	var i=0,j=0;
	for(j=0;j<tam1;j++){
		if(trim(document.f1.checkbox[j].value)!='on'){
			campo=trim(document.getElementById("preciot_"+trim(document.f1.checkbox[j].value)).value);
			cant=trim(document.getElementById("cant_"+trim(document.f1.checkbox[j].value)).value);
			if(trim(document.f1.checkbox[j].value)!='on' && campo!="" && cant!=""){
				cant=parseInt(cant);
				val=parseFloat(campo)/cant;
				document.getElementById("precio_"+trim(document.f1.checkbox[j].value)).value=decimalRedondear(val,2);	
				baImponible=baImponible+val;			
			}else if(campo==""){
				document.getElementById("precio_"+trim(document.f1.checkbox[j].value)).value="";
			}
		}
	}//baImponible=total/pd; /////////activar para cuando no se tiene la base imponible	
	ivaT=baImponible*iva;
	total=baImponible+ivaT;
	document.f1.base_ped.value=decimalRedondear(baImponible,2);
	document.f1.iva_ped.value=decimalRedondear(ivaT,2);
	document.f1.total_ped.value=decimalRedondear(total,2);		
}
function validaPrecio(){
	paso=0;
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		if(document.f1.checkbox[i].checked == true){
			paso=1;
			if(document.getElementById("precio_"+id).value==""){
				alert("Ingrese un valor valido en el campo precio.");
				document.getElementById("precio_"+id).focus();
				return false;
			}
		}
	}
	if(paso==0){
		alert("Debe seleccionar algun material");
		return false;
	}else{
		return true;
	}	
}
///////////FUNCION PARA EXTRAER LOS DATOS DE LOS MATERIALES INVENTARIADOS EN  LA TABLA DINAMICA UBICADA EN EL FORMULARIO INVENTARIO.PHP
/*function traer_inv_mat(){
	
	var cad='';//,id_mat()+"=@"+id_inv()+"=@"+cant_sist()+"=@"+cant_real()+"=@"+justi_inv()+"=@"+data(
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		//alert(id);
		//if(document.f1.checkbox[i].checked == true){			
		if(id!=""){
			//alert(document.getElementById("justifi_"+id).value+"    .....  "+"justifi_"+id);
			
			//if(document.f1.checkbox[i].checked == true){
			cad=cad+"-Class-incluir=@inventario_materiales=@"+id+"=@"+idinventario()+"=@"+document.getElementById("stock_"+id).value+"=@"+document.getElementById("canreal_"+id).value+"=@"+document.getElementById("justifi_"+id).value+"=@"+data();
		}
	}
	if(cad!=''){
		return cad;
	}
}*/
function traer_inv_mat_ingresar(){
	
	var cad='';//,id_mat()+"=@"+id_inv()+"=@"+cant_sist()+"=@"+cant_real()+"=@"+justi_inv()+"=@"+data(
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		//alert(id);
		//if(document.f1.checkbox[i].checked == true){			
		if(id!=""){
			//alert(document.getElementById("justifi_"+id).value+"    .....  "+"justifi_"+id);
			
			//if(document.f1.checkbox[i].checked == true){
			cad=cad+"-Class-incluir=@inventario_materiales=@"+id+"=@"+idinventario()+"=@"+document.getElementById("stock_"+id).value+"=@"+document.getElementById("stock_"+id).value+"=@"+document.getElementById("justifi_"+id).value+"=@"+data();
		}
	}
	if(cad!=''){
		return cad;
	}
}
function traer_inv_mat_modificar(){
	
	var cad='';//,id_mat()+"=@"+id_inv()+"=@"+cant_sist()+"=@"+cant_real()+"=@"+justi_inv()+"=@"+data(
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		//alert(id);
		//if(document.f1.checkbox[i].checked == true){			
		if(id!=""){
			//alert(document.getElementById("justifi_"+id).value+"    .....  "+"justifi_"+id);
			
			//if(document.f1.checkbox[i].checked == true){
			cad=cad+"-Class-modificar=@inventario_materiales=@"+id+"=@"+idinventario()+"=@"+document.getElementById("stock_"+id).value+"=@"+document.getElementById("cantNew_"+id).value+"=@"+document.getElementById("justifi_"+id).value+"=@"+data();
		}
	}
	if(cad!=''){
		return cad;
	}
}
function valida_inv_mat(){
	paso=0;
	//alert(document.f1.checkbox);
	//alert(document.f1.checkbox.length);
	for (i = 1; i < document.f1.checkbox.length; i++) {
		var id= document.f1.checkbox[i].value;
		//alert(id);
		//if(document.f1.checkbox[i].checked == true){			
		if(id!=""){
			paso=1;
			canreal=parseInt(document.getElementById("cantNew_"+id).value);
			stock=parseInt(document.getElementById("stock_"+id).value);
			//alert(canreal+"=real <=> sdtock="+stock);
			if(document.getElementById("cantNew_"+id).value==""){
				alert("Ingrese un valor valido en el campo Cantidad Real.");
				document.getElementById("cantNew_"+id).focus();
				return false;
			}else if(canreal!=stock){
				if(trim(document.getElementById("justifi_"+id).value)==" " || trim(document.getElementById("justifi_"+id).value)==""){
					alert("Ingrese un valor valido en el campo Justificacion.");////  =just_ es el id de la capa oculta, y justifi_ es el id del texarea de jutificacion
					muestrajusti2("just_"+id,"but_"+id);
					document.getElementById("justifi_"+id).value="";
					document.getElementById("justifi_"+id).focus();
					
					return false;
				}
			}
		}
		//}
	}
	//alert(paso);
	if(paso==0){
		alert("No se encontro datos en materiales, intente ralizando una nueva busquedad. Gracias");
		return false;
	}else{
		return true;
	}
	
}
/////////////FUNCION HABILITA EL TEXAREA EN EL FORMULARIO INVENTARIO EN LA PARTE DE MATERIALES
function muestrajusti2(id,boton) {
		document.getElementById(id).style.display="block";
		document.getElementById(boton).value="<<";	
} function muestrajusti(id,boton) {
	//alert(document.getElementById(id).style.display);
	if(document.getElementById(id).style.display=="none"){//
		//document.getElementById(id).type="text";
		document.getElementById(id).style.display="block";
		document.getElementById(boton).value="<<";
	}else{
		//document.getElementById(id).type="hidden";
		document.getElementById(id).style.display="none";
		document.getElementById(boton).value=">>";
	} 	
} 	
function filtraInventario_inv(id,id2,donde) {
	//alert(document.getElementById(id).value);
	dep=document.getElementById(id).value;
	fam=document.getElementById(id2).value;
	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
	archivoDataGrid="procesos/datagrid_inventario.php?id_dep="+dep+"=="+fam+"==1"+"=="+donde+"&";
	updateTable_mat();
} 
function filtraInventario(id,id2,donde,id_inv) {
	//alert(document.getElementById(id).value);
	dep=document.getElementById(id).value;
	fam=document.getElementById(id2).value;
	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
	archivoDataGrid="procesos/datagrid_inventario_02.php?id_dep="+dep+"=="+fam+"==1"+"=="+donde+"=="+id_inv+"&";
	updateTable_mat();
} 
function filtraMovimiento(id,id2,id3,id4) {
	//alert(document.getElementById(id).value);
	dep=document.getElementById(id).value;
	fam=document.getElementById(id2).value;
	nom=document.getElementById(id3).value;
	num=document.getElementById(id4).value;
	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
	archivoDataGrid="../procesos/datagrid_movimiento.php?id_dep="+dep+"=="+fam+"=="+nom+"=="+num+"==1"+"&";
	updateTable_mat();
} 
function filtraPedido(id,id2) {
	//alert(document.getElementById(id).value);
	dep=document.getElementById(id).value;
	fam=document.getElementById(id2).value;

	if(document.f1.stock_min.checked == true)
		var stock_min="true";
	else 
		var stock_min="false";

	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
	archivoDataGrid="procesos/datagrid_pedido.php?id_dep="+dep+"=="+fam+"==1"+"&stock_min="+stock_min+"&";
	updateTable_mat();
}
function filtraReporPedido(id,id2,id3,id4) {
	status=document.getElementById(id).value;
	desde=document.getElementById(id2).value;
	hasta=document.getElementById(id3).value;
	id_prov=document.getElementById(id4).value;
	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
	archivoDataGrid="reportes/Rep_reportepedido.php?status="+status+"=="+desde+"=="+hasta+"=="+id_prov+"&";
	updateTable_mat();
} 
function buscarRepMP() {
	archivoDataGrid="reportes/Rep_matpadre.php?id_fam="+id_fam()+"&id_unidad="+id_unidad()+"&impresion="+impresion()+"&";
	updateTable_mat();
} 
function filtraReporMovimiento(id,id2,id3,id4,id5) {
	id_tm=document.getElementById(id).value;
	desde=document.getElementById(id2).value;
	hasta=document.getElementById(id3).value;
	id_dep=document.getElementById(id4).value;
	tip=document.getElementById(id5).value;
	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
	archivoDataGrid="reportes/Rep_reportemovimiento.php?status="+id_tm+"=="+desde+"=="+hasta+"=="+id_dep+"=="+tip+"&";
	updateTable_mat();
} 
function filtraReporMov_cierre() {
	
	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
	archivoDataGrid="reportes/Rep_reportemov_cierre.php?id_dep="+document.f1.id_dep.value+"&desde="+document.f1.fechades.value+"&hasta="+document.f1.fechahas.value+"&";
	updateTable_mat();
} 
function imprimirReporMov_cierre() {
	location.href="saecomat/reportes/Rep_reportemov_cierreImpreso.php?id_dep="+document.f1.id_dep.value+"&desde="+document.f1.fechades.value+"&hasta="+document.f1.fechahas.value+"&";
} 
function filtraReporMov_esp() {
	
	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
	archivoDataGrid="reportes/Rep_reportemov_esp.php?id_dep="+document.f1.id_dep.value+"&desde="+document.f1.fechades.value+"&hasta="+document.f1.fechahas.value+"&tipo_ent_sal="+document.f1.tipo_ent_sal.value+"&id_tm="+document.f1.id_tm.value+"&id_te="+document.f1.id_te.value+"&id_persona="+document.f1.id_persona.value+"&";
	updateTable_mat();
} 
function imprimirReporMov_esp() {
	location.href="saecomat/reportes/Rep_reportemov_espImpreso.php?id_dep="+document.f1.id_dep.value+"&desde="+document.f1.fechades.value+"&hasta="+document.f1.fechahas.value+"&tipo_ent_sal="+document.f1.tipo_ent_sal.value+"&id_tm="+document.f1.id_tm.value+"&id_te="+document.f1.id_te.value+"&id_persona="+document.f1.id_persona.value+"&";
} 
function filtraReporInventario(id,id2,id3,id4,id5) {
	id_mov=document.getElementById(id).value;
	desde=document.getElementById(id2).value;
	hasta=document.getElementById(id3).value;
	id_dep=document.getElementById(id4).value;
	status=document.getElementById(id5).value;
	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
	archivoDataGrid="reportes/Rep_reporteinventario.php?status="+id_mov+"=="+desde+"=="+hasta+"=="+id_dep+"=="+status+"&";
	updateTable_mat();
} 	
function traerGtPersona(val){
	idGlobal=val;
	conexionPHP_mat("informacion.php","traerGtPersona",document.f1.id_gt.value);
}
function traerTmovi(val){
	idGlobal=val;
	conexionPHP_mat("informacion.php","traerTmovi",document.f1.tip.value);
}
function traerTipocon(){
	conexionPHP_mat("informacion.php","traerTipocon",document.f1.id_te.value);
}
function traerTC(){
	conexionPHP_mat("informacion.php","traerTC",document.f1.id_persona.value);
}
function traerTipomov(){
	conexionPHP_mat("informacion.php","traerTipomov",document.f1.tipo_ent_sal.value);
}
function traerTM(){
	conexionPHP_mat("informacion.php","traerTM",document.f1.id_tm.value);
}
function traerGtPerso(){
	if(id_gt()!='0'){		
		if(id_persona()!='0'){
			return id_gt()+"=@"+id_persona();
		}else
			{
			alert("seleccione una persona valida.");
		}
	}else{
		return "0=@0";
	}
}
function validar_can_blur(id,i){

   if(document.f1.checkbox[i].checked==true){
		if(document.getElementById('cant_'+id).value==""){
			escondeCant(id,i);
		}
    }
}
function validar_can_blur_movimiento(id,i){

   if(document.f1.checkbox[i].checked==true){
		if(document.getElementById('cant_'+id).value==""){
			if(document.getElementById('cantabre_'+id).value==""){
				escondeCant(id,i);
				escondeCant2(id,i);
			}
		}
    }
}
function valIqualD(){
 dep=document.getElementById("iddep").value;
 dep2=document.getElementById("iddep2").value;
	if(dep!="0" && dep2!="0"){
		if(dep!=dep2){
			
		}else {
			document.getElementById("iddep2").value="0";
			alert("seleccione un deposito destino diferente al de origen");
			document.getElementById("iddep2").focus();
			
		}
	}
}
function validaTransfer(id){
	//alert(id);
	
	/*alert(document.getElementById(id).value);
	document.getElementById(id).checked=false;
	alert(document.getElementById(id).value);*/
	//filtraMovimiento('iddep','idfam','nombre_mat','numero_mat');valIqualD();
   if(document.getElementById(id).checked==true){
		document.getElementById("iddepdesti").style.display="block";
		document.getElementById("idregis2").style.display="block";
		document.getElementById("idregis1").style.display="none";
		document.getElementById("id_tm").value="0";
		document.getElementById("id_tm").disabled=true;
	}else {
		document.getElementById("iddepdesti").style.display="none";
		document.getElementById("idregis2").style.display="none";
		document.getElementById("idregis1").style.display="block";
		document.getElementById("id_tm").disabled=false;
	}
}
function val_ensalmed_mat(sal,ent){
	salida=parseInt(document.getElementById(sal).value);
	entrada=parseInt(document.getElementById(ent).value);
	if(entrada==0){
		document.getElementById(ent).value=1;
	}
    if(salida<entrada || salida==0){
		document.getElementById(sal).value=entrada;
	}
	
}
function validar_can_movimien(id,i,uni_sal,abre,sal_abre){//\''.$c_uni_sal.'\',\''.$abreviatura.'\',\''.$us_abre.'\'
	chif=0;	
	if(document.getElementById("id_tm").value!="0"){
		document.getElementById("id_tm").disabled=true;
		valor=id_tm().split("==");
		//alert("cdigo:"+valor[0]+"   tipo:"+valor[1]);
		if(valor[1]=="SALIDA"){
			chif=1;
		}
    }else if(document.getElementById("checkboxTrans").checked==true){
		chif=1;
    }else{
		escondeCant(id,i);
		escondeCant2(id,i);
		document.getElementById('cantNew_'+id).value="0";
		alert("Seleccione un movimiento. Gracias");		
		document.getElementById("id_tm").focus();
		
	}
	if(chif!=0){
		cant=parseInt(document.getElementById('cantNew_'+id).value);
		if(abre!=sal_abre){
			cantabre=parseInt(document.getElementById('cantabre_'+id).value);
		}
		
		stock=parseInt(document.getElementById('stock_'+id).value);
		min=parseInt(document.getElementById('min_'+id).value);
		//alert(cant);
		if(cant=="" && cantabre==""){
			escondeCant(id,i);
			escondeCant2(id,i);
		}
		if(stock>=0 && cant!=""){
			resta=stock-cant;
			//alert(resta+"  "+min);
			if(stock < cant){
				document.getElementById('cantNew_'+id).value="0";
				if(abre!=sal_abre){
					document.getElementById('cantabre_'+id).value="0";
				}
				
				document.getElementById('cant_'+id).value="0";
				alert("Disculpe el stock no cubre la cantidad solicitada");
			}else if(resta<min){
				cadena="";
				st=resta/parseInt(uni_sal);
				st=st+"";
				st=st.split('.');
				st2=resta%parseInt(uni_sal);
				cadena=st2+" "+abre;
				if(abre!=sal_abre){
					cadena=cadena+","+st[1]+" "+sal_abre;
				}
				if(confirm("La cantidad solicitada dejara el stock con:"+cadena+" , cifra menor al Stock Min: "+min/parseInt(uni_sal)+ " " +abre+"'. \n esta usted de acuerdo?")){
				
				}else{
					document.getElementById('cantNew_'+id).value="";
					document.getElementById('cant_'+id).value="0";
					document.getElementById('cantabre_'+id).value="0";
					document.getElementById('cant_'+id).focus();
				}
			}
		}else if(stock==0){
			escondeCant(id,i);
			escondeCant(id2,i);
			alert("Disculpe este material no cuenta con unidades disponible en su stock");
		}
	}
	
}
function validar_can_movimien_dos(id,i,uni_sal,abre,sal_abre){//\''.$c_uni_sal.'\',\''.$abreviatura.'\',\''.$us_abre.'\'
	//alert(":"+uni_sal+":"+abre+":"+sal_abre+":");
	chif=0;	resta=0;
	if(document.getElementById("id_tm").value!="0"){
		document.getElementById("id_tm").disabled=true;
		valor=id_tm().split("==");
		//alert("cdigo:"+valor[0]+"   tipo:"+valor[1]);
		if(valor[1]=="SALIDA"){
			chif=1;
		}
    }else if(document.getElementById("checkboxTrans").checked==true){
		chif=1;
    }else{
		//escondeCant(id,i);
		//escondeCant2(id,i);
		document.getElementById('cantNew').value="0";
		alert("Seleccione un movimiento. Gracias");		
		document.getElementById("id_tm").focus();
		
	}
	if(chif!=0){
	
		canti=parseInt(document.getElementById('cantNew').value)+0;
		if(abre!=sal_abre){
			cantabre=parseInt(document.getElementById('cantabre').value)+0;
		}
		
		stockgen=parseInt(document.getElementById('stockgen').value)+0;
		min=parseInt(document.getElementById('min').value)+0;
		//alert(cant);
		if(canti=="" && cantabre==""){
			//escondeCant(id,i);
			//escondeCant2(id,i);
		}
		if(stockgen>=0 && canti!=""){
		//alert("can="+canti+"  stock="+stockgen);
			resta=stockgen - canti;
		//	alert(resta+"  "+min);
			if(stockgen < canti){
				document.getElementById('cantNew').value="0";
				if(abre!=sal_abre){
					document.getElementById('cantabre').value="0";
				}				
				document.getElementById('cant').value="0";
				alert("Disculpe el stock no cubre la cantidad solicitada");
			}else if(resta<min){
				cadena="";
				st=resta/parseInt(uni_sal);
				st=st+"";
				st=st.split('.');
				st2=resta%parseInt(uni_sal);
				cadena=st[0]+" "+abre;
				if(abre!=sal_abre){
					cadena=cadena+","+st[1]+" "+sal_abre;
				}
				if(confirm("La cantidad solicitada dejara el stock con:"+cadena+" , cifra menor al Stock Min: "+min/parseInt(uni_sal)+ " " +abre+"'. \n esta usted de acuerdo?")){
				
				}else{
					document.getElementById('cantNew').value="";
					document.getElementById('cant').value="0";
					document.getElementById('cantabre').value="0";
					document.getElementById('cant').focus();
				}
			}
		}else if(stock==0){
			//escondeCant(id,i);
		//	escondeCant(id2,i);
			alert("Disculpe este material no cuenta con unidades disponible en su stock");
		}
	}
	
}
function validaGtPersona(){

	if(id_gt()!='0'){		
		if(id_persona()!='0'){
			return true;
		}else
			{
			alert("seleccione una persona valida.");
		}
	}else{
		return true;
	}
}
function decimalRedondear(num,decimal) {var fact = Math.pow(10, decimal); return Math.round(num * fact) / fact;} 	
function ImprimirRep_matpadre(){
		location.href="saecomat/reportes/Rep_matpadreImpreso.php?id_fam="+id_fam()+"&id_unidad="+id_unidad()+"&impresion="+impresion()+"&";
}

function ImprimirRep_proveedores(){
		location.href="saecomat/reportes/Rep_proveedoresImpreso.php";
}

function ImprimirRep_materialesuniinv(){
		location.href="saecomat/reportes/Rep_materialesuniinvImpreso.php";
}

function ImprimirRep_planillamov(){
	location.href="saecomat/reportes/Rep_planillamovImpreso.php";
}

function ImprimirRep_planillaped(){
	location.href="saecomat/reportes/Rep_planillapedImpreso.php";
}
function ImprimirRep_planillaped02(id_ped){
	location.href="saecomat/reportes/Rep_planillapedImpreso.php?id_ped="+id_ped+"&";
}
function ImprimirRep_planillainv(){
	location.href="saecomat/reportes/Rep_planillainvImpreso.php";
}
function ImprimirRep_planillainv02(id_inv){
	location.href="saecomat/reportes/Rep_planillainvImpreso.php?id_inv="+id_inv+"&";
}

function ImprimirRep_reportemovimiento(){
	location.href="saecomat/reportes/Rep_reportemovimientoImpreso.php";
}
function ImprimirRep_reportemovimiento02(id_mov){
	location.href="saecomat/reportes/Rep_planillamovImpreso.php?id_mov="+id_mov+"&";

}
function ImprimirRep_reportemovimiento_new(){
	location.href="saecomat/reportes/Rep_planillamovImpreso.php?id_mov="+id_mov()+"&";
		conexionPHP_mat('formulario.php','movimiento');
}

function ImprimirRep_reporteinventario(){
	location.href="saecomat/reportes/Rep_reporteinventarioImpreso.php";
}
function Busqueda_mat_avan(){
	 ventana_secundaria=window.open("saecomat/busquedad_mat.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=550");
}
function Busqueda_mat_avan_new(){
	valor=document.getElementById("iddep").value;
	if(document.getElementById("iddep").value!="0"){
	   ventana_secundaria=window.open("saecomat/busquedad_mat_new.php?valor="+valor+"&", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=550");
		
		//setTimeOut("document.getElementById('iddep').value=valor",1000);
		//setTimeOut("filtraMovimiento('id_dep','idfam','nombre_mat','numero_mat');",700);
	}else{
		alert("Seleccione un deposito");
	}
}
function valida_mat_t(val){
window.opener.document.getElementById('id_m').value=val;
//alert(window.opener.document.getElementById('aux_mat').value);
window.opener.validarmat_padre();
if(window.opener.document.getElementById('aux_mat').value != "materiales"){
	window.opener.conexionPHP_mat("informacion.php","traerDeposito02",val);
}

window.close();
}
function valida_mov_mta_new(valor){

window.opener.document.getElementById("numero_m").value=valor;
window.opener.agregar_ma_movit();
window.close();

}
function valida_mov_mta_new02(valor){

document.getElementById("numero_m").value=valor;
agregar_ma_movit();

}
function valida_mov_mta_new02_orden(valor){

document.getElementById("numero_m").value=valor;
agregar_ma_movit_orden();

}
function eliminar_mov_mta_new(val,id_m){
//document.getElementById(id).checked==true
	//alert(document.getElementById("checkboxTrans").checked)
	document.getElementById("numero_m").value=val;
	valor=id_tm().split("==");			
	
	if(document.getElementById("checkboxTrans").checked!=true){
		combinado=document.getElementById("numero_m").value+"<@@>"+valor[1];
		if(confirm('seguro que desea eliminar este registro?')){
			confirmacion_mat("modificar","movimiento",id_mov()+"=@"+valor[0]+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+observacion()+"=@"+referencia()+"=@"+iddep()+"=@"+data()+"-Class-eliminar=@mov_mat=@"+document.getElementById("numero_m").value+"=@"+id_mov()+"=@=@"+combinado);
		}
	}else{
		combinado=document.getElementById("numero_m").value+"<@@>"+"SALIDA";
		combinado2=document.getElementById("numero_m").value+"<@@>"+"ENTRADA";
		confirmacion_mat("modificar","movimiento",id_mov()+"=@"+id_tmdescuento()+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+observacion()+"=@"+id_mov2()+"=@"+iddep()+"=@"+data()+"-Class-eliminar=@mov_mat=@"+document.getElementById("numero_m").value+"=@"+id_mov()+"=@=@"+combinado+"-Class-eliminarDos=@mov_mat=@"+document.getElementById("numero_m").value+"=@"+id_mov2()+"=@"+document.f1.iddep2.value+"<@@>"+id_m+"=@"+combinado2);
			
	}
}
function eliminar_mov_mta_orde(val,id_m){

	document.getElementById("numero_m").value=val;
	valor=id_tm().split("==");			
	
	if(document.getElementById("checkboxTrans").checked!=true){
		combinado=document.getElementById("numero_m").value+"<@@>"+valor[1];
		if(confirm('seguro que desea eliminar este registro?')){
			confirmacion_mat("modificar","movimiento_orden",id_mov()+"=@"+valor[0]+"=@"+formatdate(fecha_ent_sal())+"=@"+hora_ent_sal()+"=@"+observacion()+"=@"+referencia()+"=@"+iddep()+"=@"+data()+"-Class-eliminar=@mov_mat_orden=@"+document.getElementById("numero_m").value+"=@"+id_mov()+"=@=@"+combinado);
		}
	}
}
function valida_mat_t02(id){
val=document.getElementById(id).value;
//conexionPHP_mat("informacion.php","traerDeposito02",val);
}

function filtra_busquedad_m(id,id2,id3,id4){
	id_dep=document.getElementById(id).value;
	desde=document.getElementById(id2).value;
	hasta=document.getElementById(id3).value;
	id_mat=document.getElementById(id4).value;
	if(id_mat==''){
		alert("Error, debe buscar un material")
	}else{
		archivoDataGrid="procesos/datagrid_busquedad_m.php?id_dep="+id_dep+"=="+desde+"=="+hasta+"=="+id_mat+"&";
		updateTable_mat();
	}
}
function ImprimirRep_recormov(id_dep){
//	=document.getElementById(id2).value;
	desde=document.getElementById('fechades').value;
	hasta=document.getElementById('fechahas').value;
	id_mat=document.getElementById('id_mat').value;
	location.href="saecomat/reportes/ImprimirRep_recormov.php?id_dep="+id_dep+"=="+desde+"=="+hasta+"=="+id_mat+"&";
}

function ImprimirRep_recormov1(){
//	=document.getElementById(id2).value;
	id_dep=document.getElementById('id_dep').value;
	desde=document.getElementById('fechades').value;
	hasta=document.getElementById('fechahas').value;
	id_mat=document.getElementById('id_mat').value;
	if(id_mat==''){
		alert("Error, debe buscar un material")
	}else{
		location.href="saecomat/reportes/ImprimirRep_recormov.php?id_dep="+id_dep+"=="+desde+"=="+hasta+"=="+id_mat+"&";
	}
}
function filtra_bavan_dep(id,id2,id3,id4,id5,id6) {//onChange="filtra_bavan_dep('id_dep','id_fam','id_unidad','uni_id_unidad','numero_mat','nombre_mat')" 
	id_dep=document.getElementById(id).value;
	id_fam=document.getElementById(id2).value;
	id_unidad=document.getElementById(id3).value;
	uni_id_unidad=document.getElementById(id4).value;
	numero_mat=document.getElementById(id5).value;
	nombre_mat=document.getElementById(id6).value;
	
	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
	archivoDataGrid="../procesos/datagrid_materiales_avanbus.php?id_dep="+id_dep+"=="+id_fam+"=="+id_unidad+"=="+uni_id_unidad+"=="+numero_mat+"=="+nombre_mat+"&";
	updateTable_mat();
} 
function filtra_bavan_dep2(id,id2,id3,id4,id5,id6) {//onChange="filtra_bavan_dep('id_dep','id_fam','id_unidad','uni_id_unidad','numero_mat','nombre_mat')" 
	id_dep=document.getElementById(id).value;
	id_fam=document.getElementById(id2).value;
	id_unidad=document.getElementById(id3).value;
	uni_id_unidad=document.getElementById(id4).value;
	numero_mat=document.getElementById(id5).value;
	nombre_mat=document.getElementById(id6).value;
	params_mat = ''; tblpage_mat = ''; tblorder_mat = ''; tblfilter_mat = '';
	archivoDataGrid="procesos/datagrid_materiales_avanbus2.php?id_dep="+id_dep+"=="+id_fam+"=="+id_unidad+"=="+uni_id_unidad+"=="+numero_mat+"=="+nombre_mat+"&";
	updateTable_mat();
} 
function agregar_ma_movit(){
	conexionPHP_mat("informacion.php","agregar_mat_mov",document.getElementById("numero_m").value+"=="+document.f1.id_mov.value);
}
function agregar_ma_movit_orden(){
	conexionPHP_mat("informacion.php","agregar_mat_mov_orden",document.getElementById("numero_m").value+"=="+id_mov());
}
function habili(id){
	document.getElementById('cant').disabled=false;
	// documente
}

function finalizar_movimiento(){
	location.href="saecomat/reportes/Rep_planillamovImpreso.php?id_mov="+id_mov()+"&";
	conexionPHP_mat('formulario.php','movimiento');
}

function  valida_ent_mov(){
	if((parseInt(document.f1.cantNew.value)+0)>0 || (parseInt(document.f1.cant.value)+0)>0 ){
		return true;
	}
	else{
		alert("Error, debe introducir la cantidad a agregar");
		return false;
	}
}

function  valSelDep(){
	if(iddep()!="0" ){
		return true;
	}
	else{
		alert("Seleccione un deposito");
		return false;
	}
}

function  traermat(){
	conexionPHP_mat('informacion.php','traermat',iddep());
}

function  autocomplete(){
	
/*
	$("#nombre_mat")
		// clear existing data
		.val("")
		// change the local data to months
		.setOptions({data: mat_autoc})
		// get the label tag
		.prev()
		// update the label tag
		.text("Month (local):");
	*/
}




function valida_info_mat(){
	return true;
	var cont=0;
	cade='';
	for (i = 0; i < document.f1.id_mat.length; i++) {
		if(document.f1.id_mat[i].checked == true){
			if(!isInteger (document.getElementById("text_"+trim(document.f1.id_mat[i].value)).value)){
				alert("Error, el campo debe ser un entero");
				document.getElementById("text_"+trim(document.f1.id_mat[i].value)).select();
				return false;
			}
		}
	}
	return true;
}
function info_mat(){
	return "";
	var cont=0;
	cade='';
	for (i = 0; i < document.f1.id_mat.length; i++){
		if(document.f1.id_mat[i].checked == true){
			cade=cade+"-Class-util_orden_=@materiales=@"+trim(document.f1.id_mat[i].value)+"=@"+document.getElementById("text_"+trim(document.f1.id_mat[i].value)).value+"=@"+id_orden()+"=@=@=@=@=@=@";
		}
	}
	return cade;
}
function habilitaDep(){
	if(hab_desc_alm_gen()=="T"){
		document.f1.id_deposito.disabled=false;
		
		document.f1.hab_desc_alm_gru.disabled=true;
		document.f1.hab_mat_orden.disabled=true;
		document.f1.hab_desc_alm_gru.value="F";
		document.f1.hab_mat_orden.value="F";
	}
	else{
		document.f1.id_deposito.disabled=true;
		document.f1.id_deposito.value='0';
		
		document.f1.hab_desc_alm_gru.disabled=false;
		document.f1.hab_mat_orden.disabled=false;
	}
}

function hab_alm_gen(){
	if(hab_desc_alm_gru()=="T"){
		document.f1.hab_desc_alm_gen.disabled=true;
		document.f1.hab_mat_orden.disabled=true;
		document.f1.id_deposito.disabled=true;
		document.f1.hab_desc_alm_gen.value="F";
		document.f1.hab_mat_orden.value="F";
		document.f1.id_deposito.value=0;
		
	}
	else{
		document.f1.hab_desc_alm_gen.disabled=false;
		document.f1.hab_mat_orden.disabled=false;
		document.f1.id_deposito.disabled=false;
	}
}

function hab_alm_ord(){
	if(hab_mat_orden()=="T"){
		document.f1.hab_desc_alm_gen.disabled=true;
		document.f1.hab_desc_alm_gru.disabled=true;
		document.f1.id_deposito.disabled=true;
		document.f1.hab_desc_alm_gen.value="F";
		document.f1.hab_desc_alm_gru.value="F";
		document.f1.id_deposito.value=0;
		
	}
	else{
		document.f1.hab_desc_alm_gen.disabled=false;
		document.f1.hab_desc_alm_gru.disabled=false;
		document.f1.id_deposito.disabled=false;
	}
}

function habilita_num_mat(){
	if(document.f1.id_dep.value!="0"){
		document.f1.numero_mat.disabled=false;
		document.f1.nombre_mat.disabled=false;
		conexionPHP_mat('informacion.php','traermat',document.f1.id_dep.value);
	}
	else{
		document.f1.numero_mat.disabled=true;
		document.f1.nombre_mat.disabled=true;
		document.f1.numero_mat.value='';
		document.f1.nombre_mat.value='';
	}
}

function valConfMatDep(){
	if(hab_desc_alm_gen()=="T"){
		if(id_deposito()!='0'){
			return true;
		}
		else{
			alert("Error, debe seleccionar un deposito para descontar al finalizar la orden");
			return false;
		}
	}
	else{
		return true;
	}
	
}

function cargarMatGrupo(){
	if(document.f1.id_gt.value!=''){
		conexionPHP_mat('formulario.php',"movimiento_final_orden");
	}else{
		document.getElementById("materiales").innerHTML='';
	}
}
function cargarMatGeneral(){
	if(document.f1.id_gt.value!=''){
		conexionPHP_mat('formulario.php',"movimiento_final_orden_gen");
	}else{
		document.getElementById("materiales").innerHTML='';
	}
}
function cargarMatOrden(){
	if(document.f1.id_gt.value!=''){
		conexionPHP_mat('formulario.php',"movimiento_final_orden_mat");
	}else{
		document.getElementById("materiales").innerHTML='';
	}
}

function ver_config_mat(){
	if(document.f1.id_gt.value!=''){
		conexionPHP_mat('informacion.php',"ver_config_mat",document.f1.id_gt.value);
	}else{
		document.getElementById("materiales").innerHTML='';
	}
}

