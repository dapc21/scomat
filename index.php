<?php
	session_start();
	session_unset();
	session_destroy();
	require_once("procesos.php");									
?>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="SAECOSOFT">
		<title>Saeco v5.0</title>
		<link href="include/parsley/parsley.css" rel="stylesheet">
		<!--SAECO-->
		<!--SAECO CAS
		
		<script language="JavaScript" type="text/javascript" src="CAS/javascript/ajax.js"></script>
		<script language="JavaScript" type="text/javascript" src="CAS/javascript/controlador.js"></script>
		<script language="JavaScript" type="text/javascript" src="CAS/javascript/validacionAjax.js"></script>
		<script type="text/javascript" src="CAS/include/eyedatagrid/eyedatagrid.js"></script>
		<!--SAECO SMS-->
		<script language="JavaScript" type="text/javascript" src="js/procesos.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/banco.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/franquicia.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/estado.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/municipio.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/ciudad.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/zona.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/sector.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/urbanizacion.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/calle.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/edificio.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/marca.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/modelo.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/tipo_sist_equipo.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/tipo_sist_equipo.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/servicios_sistema.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/ubicacion_equipo_sis.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/movimiento_equipo.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/equipo_sistema.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/comandos_interfaz.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/interfaz_equipos.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/contrato.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/empresa.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/grupo_franq.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/statuscont.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/grupo_afinidad.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/tipo_servicio.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/paquete.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/cant_tv.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/servicios.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/tarifa_servicio.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/cargar_deuda.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/mensualidad.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/tipo_pago.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/caja.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/pagos.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/soporte_pago.js"></script>
		
		<script language="JavaScript" type="text/javascript" src="js/cuenta_bancaria.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/carga_tabla_banco.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/tabla_bancos.js"></script>

		<script language="JavaScript" type="text/javascript" src="js/llamadas.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/tipo_llamada.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/detalle_resp.js"></script>
		
		<script language="JavaScript" type="text/javascript" src="js/asigna_recibo_c.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/recibe_recibo_c.js"></script>
		
		<script language="JavaScript" type="text/javascript" src="js/devolver_recibo.js"></script>
				
		<script language="JavaScript" type="text/javascript" src="js/responsable.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/tipo_responsable.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/encargado.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/motivo_movimiento.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/tipo_movimiento.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/unidad_medida.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/familia.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/motivo_inventario.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/almacen.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/material.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/stock_material.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/movimiento.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/movimiento_material.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/inventario.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/inventario_material.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/pedido.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/pedido_material.js"></script>
		<!--<script language="JavaScript" type="text/javascript" src="js/-Clase-.js"></script>-->

		<script language="JavaScript" type="text/javascript" src="js/tecnicos.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/cobrador.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/vendedor.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/persona.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/gerentes_permitidos.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/scontrato.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/usuario.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/ordenes_tecnicos.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/tipo_orden.js"></script>

		
		<script language="JavaScript" type="text/javascript" src="js/caja_cobrador.js"></script>					
		
		<script language="JavaScript" type="text/javascript" src="js/tipo_resp.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/detalle_orden.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/motivonotas.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/motivollamada.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/estacion_trabajo.js"></script>		


		<!--
		<script language="JavaScript" type="text/javascript" src="js/cargar_deuda.js"></script>					
		<script language="JavaScript" type="text/javascript" src="js/cerrar_caja.js"></script>					
		<script language="JavaScript" type="text/javascript" src="js/cirre_diario_et.js"></script>					
		<script language="JavaScript" type="text/javascript" src="js/cirre_diario.js"></script>		
		<script language="JavaScript" type="text/javascript" src="js/ordenes_tecnicos.js"></script>						
		-->
		
		<!--ESTE JAVASCRIPT FUNCIONA PARA CREAR, ASIGNAR E IMPRIMIR Y FINALIZAR ORDENES-->
		
									
		<script language="JavaScript" type="text/javascript" src="SMS/javascript/ajax.js"></script>
		<script language="JavaScript" type="text/javascript" src="SMS/javascript/controlador.js"></script>
		<script language="JavaScript" type="text/javascript" src="SMS/javascript/validacionAjax.js"></script>
		<script language="JavaScript" type="text/javascript" src="SMS/include/eyedatagrid/eyedatagrid.js"></script>

		<link rel="stylesheet" type="text/css" href="estilos/css.css">

		<script language="JavaScript" type="text/javascript" src="javascript/ajax.js"></script>
		<script language="JavaScript" type="text/javascript" src="javascript/validacionAjax.js"></script>
		<script language="JavaScript" type="text/javascript" src="javascript/controlador.js"></script>

		<script language="JavaScript" type="text/javascript" src="javascript/validacion.js" charset="iso-8859-1"> </script>
		<script language="JavaScript" type="text/javascript" src="Programador/script.js"></script>
		<!--<script type="text/javascript" src="javascript/file_js.php"></script>

		fin datepicker -->
		<!--DataGrid-->
		<link rel="stylesheet" type="text/css" href="include/eyedatagrid/table.css" >
		<script type="text/javascript" src="include/eyedatagrid/eyedatagrid.js"></script>
		<!-- fin DataGrid -->
		<!--pestañas-->
		<!--link rel="stylesheet" href="include/tab-view/css/tab-view.css" type="text/css" media="screen"-->
		<script type="text/javascript" src="include/tab-view/js/ajax.js"></script>
		<script type="text/javascript" src="include/tab-view/js/tab-view.js"></script>
		<!--fin pestañas-->

		<!-- DHTMLX-->
		<script src="include/dhtmlx/codebase/dhtmlxcommon.js"></script>

		<!--MATERIALES-->

		<script language="JavaScript" type="text/javascript" src="saecomat/javascript/ajax.js"></script>
		<script language="JavaScript" type="text/javascript" src="saecomat/javascript/validacionAjax.js"></script>
		<script language="JavaScript" type="text/javascript" src="saecomat/javascript/controlador.js"></script>  
		<script language="JavaScript" type="text/javascript" src="saecomat/Programador/script.js"></script>
		<script type="text/javascript" src="saecomat/include/eyedatagrid/eyedatagrid.js"></script>

		<!--autocomplete-->
		<script type="text/javascript" src="include/autocomplete/lib/jquery.js"></script>
		<script type='text/javascript' src='include/autocomplete/jquery.autocomplete.js'></script>
		<link rel="stylesheet" type="text/css" href="include/autocomplete/jquery.autocomplete.css" />
		<!-- fin SAECO -->
		<!-- Bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap-reset.css" rel="stylesheet">
		<!-- Estilos de Adaptación de SAECO -->
		<link href="bootstrap/css/fuentes.css" rel="stylesheet">
		<link href="bootstrap/css/saeco.css" rel="stylesheet">
		<link href="bootstrap/css/saeco-responsive.css" rel="stylesheet">
		<link href="bootstrap/css/table-responsive.css" rel="stylesheet">
		<link href="bootstrap/css/cargando.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="bootstrap/css/datepicker.css" />

		<!-- Estilos para Aplicaciones Externas -->
		<link href="bootstrap/css/font-awesome.min.css" rel="stylesheet">
		<link href="bootstrap/css/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
		<link href="bootstrap/css/owl.carousel.css" rel="stylesheet"  type="text/css">
		<link href="bootstrap/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
		
		<!--JQPLOT-->	
		<link href="bootstrap/lib/jqplot/jquery.jqplot.css" rel="stylesheet" type="text/css" />
		
		<!--DataTables-->
		<link href="bootstrap/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="bootstrap/js/html5shiv.js"></script>
		<script src="bootstrap/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	<div id="login-body">
		<div class="container-login">
			<form class="form-signin" name="fsesion" action="javascript:iniciarSesion();">
				<h2 class="form-signin-heading">Inicio de Sesión</h2>
				<div class="login-wrap">
					<input type="text" class="form-control" id="login" name="login" placeholder="Usuario" autofocus >
					<input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" >
					<button class="btn btn-lg login-ini btn-block" name="entrar"  type="submit">Entrar</button>
					<div class="round" align="center" style="margin-top:5px;">
					  <a href="#">
						  <img src="imagenes/logo-saeco.png" alt="">
					  </a>
					</div>
					<p>2012 &copy; SAECOSOFT, C.A.</p>
				</div>
			</form>
		</div>
	</div>
	<?php 
		$acceso->objeto->ejecutarSql("select *from parametros where id_param='50' and id_franq='1'");
		$row=row($acceso);
		$efecto_carga_incial=trim($row['valor_param']);
		if($efecto_carga_incial=="1"){
	?>
		
	<div id="carga-inicial">
		<div class="loading5"><i></i><i></i><i></i><i></i></div>
		<div class="loading-text">Cargando Aplicación...</div>
	</div>
 <?php } ?>
	<?php 
		$acceso->objeto->ejecutarSql("select *from parametros where id_param='51' and id_franq='1'");
		$row=row($acceso);
		$efecto_carga_modulo=trim($row['valor_param']);
		if($efecto_carga_modulo=="1"){
		
	
	?>
	<div id="carga">
		<div class="loading8"><i></i><i></i></div>
		<div class="loading-text">Cargando Formulario...</div>
	</div>
 <?php 
 
 } ?>
	<!-- 
-->
	<section id="container" > 

		<nav class="navbar navbar-default navbar-fixed-top header white-bg" role="navigation">
		

		  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="sidebar-toggle-box">
			  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="MENÚ"></div>
			</div>
				<!--logo start-->
				<a class="logo" href="javascript:cargar_form_paquete();"><img src="imagenes/logoicon.png" alt=""></a>
				
				
				<div class="nav notify-row" id="top_menu">
					
				</div>
				<!--logo end-->
				
				<!---------------------------------------------------------------->
				<!--ÁREA DE NOTIFICACIONES (EJM FUTURO) COMENTAR SEGURAMENTE-->

			<!--
				<div class="nav notify-row" id="top_menu">
					
					<ul class="nav top-menu">
						
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="fa fa-tasks"></i>
								<span class="badge bg-success">1</span>
							</a>
							<ul class="dropdown-menu extended tasks-bar">
								<div class="notify-arrow notify-arrow-green"></div>
								<li>
									<p class="green">Tienes 1 Tarea Pendiente</p>
								</li>
								<li>
									<a href="#">
										<div class="task-info">
											<div class="desc">SAECO v4.0</div>
											<div class="percent">40%</div>
										</div>
										<div class="progress progress-striped">
											<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
												<span class="sr-only">40% Completado (success)</span>
											</div>
										</div>
									</a>
								</li>
							</ul>
							
						<li id="header_inbox_bar" class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="fa fa-envelope-o"></i>
								<span class="badge bg-important">1</span>
							</a>
							<ul class="dropdown-menu extended inbox">
								<div class="notify-arrow notify-arrow-red"></div>
								<li>
									<p class="red">Tienes 1 Mensaje</p>
								</li>
								<li>
									<a href="#">
										<span class="photo"><img alt="avatar" src="./img/avatar-mini.jpg"></span>
										<span class="subject">
										<span class="from">Daniel Peña</span>
										<span class="time">Ahora</span>
										</span>
										<span class="message">
											Esto es un ejemplo de mensaje.
										</span>
									</a>
								</li>
							</ul>
						</li>
						
						<li id="header_notification_bar" class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">

								<i class="fa fa-bell-o"></i>
								<span class="badge bg-warning">1</span>
							</a>
							<ul class="dropdown-menu extended notification">
								<div class="notify-arrow notify-arrow-yellow"></div>
								<li>
									<p class="yellow">Tienes una Notificación</p>
								</li>
								<li>
									<a href="#">
										<span class="label label-danger"><i class="fa fa-bolt"></i></span>
										Server #3 sobrecargado.
										<span class="small italic">34 mins</span>
									</a>
								</li>
							</ul>
						</li>
						
					</ul>
				</div>
				-->
				<div class="nav notify-row" id="top_menu" >
					<div id="cache_abonado" style="display:none; " >
						<select class="form-control"  id="id_cache" onclick="buscar_id_cache()" style="width:50px;height: 20px; ">
						<option value=""></option>
						</select>
					</div>
				</div>




				<!--FIN ÁREA DE NOTIFICACIONES (EJM FUTURO) COMENTAR SEGURAMENTE-->
				<!---------------------------------------------------------------->
			  
				<div class="top-nav " id="datos_usuario">
					<ul class="nav pull-right top-menu">
						
						<li class="dropdown logout-user">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-cog"></i> <b class="caret"></b></a>
							<ul class="dropdown-menu extended logout">
							<div class="log-arrow-up"></div>
								<li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Ayuda</a></li>
								<li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> Licencia</a></li>
								<li><a href="#"><i class="glyphicon glyphicon-hand-right"></i> Nosotros</a></li>
								<li><a href="#" onclick="conexionPHP('Seguridad/Seguridad.php','CerrarSesion')"><i class="glyphicon glyphicon-lock"></i> Cerrar Sesion</a></li>
							</ul>
						</li>
						<!-- user login dropdown end -->
					</ul>
				</div>
			  
			  
			<!--/div--><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		
		<!--sidebar start-->
		<aside>
			<div id="sidebar" class="nav-collapse ">
			<!-- sidebar menu start-->
				<ul class="sidebar-menu" id="nav-accordion">
					
					<li class="sub-menu">
						<a href="javascript:;" ><i class="fa fa-gavel"></i> <span>Materiales Desarrollo</span></a>
						<ul class="sub">
							<li><a  href="javascript:cargar_form_movimiento();">Movimiento de Materiales</a></li>
							<!--li><a  href="javascript:cargar_form_movimiento_material();">Movimiento de Materiales</a></li-->
							<li><a  href="javascript:cargar_form_inventario();">Inventario de Materiales</a></li>
							<li><a  href="javascript:cargar_form_pedido();">Pedido de Materiales</a></li>
							<li><a  href="javascript:cargar_form_stock_material();">Ajuste de Stock</a></li>
							<li class="sub-menu">
								<a  href="javascript:;">Configuración Materiales</a>
								<ul class="sub">
									<li><a  href="javascript:cargar_form_encargado();">Encargado de Almacén</a></li>
									<li><a  href="javascript:cargar_form_almacen();">Almacenes</a></li>
									<li><a  href="javascript:cargar_form_familia();">Familias</a></li>
									<li><a  href="javascript:cargar_form_unidad_medida();">Unidades de Medidas</a></li>
									<li><a  href="javascript:cargar_form_material();">Materiales</a></li>
									<li><a  href="javascript:cargar_form_tipo_responsable();">Tipos Responsable de Movimientos</a></li>
									<li><a  href="javascript:cargar_form_responsable();">Responsable de Movimientos</a></li>
									<li><a  href="javascript:cargar_form_tipo_movimiento();">Tipos de Movimientos</a></li>
									<li><a  href="javascript:cargar_form_motivo_movimiento();">Motivos de Movimientos</a></li>
									<li><a  href="javascript:cargar_form_motivo_inventario();">Motivos de Inventarios</a></li>
								</ul>
							</li>
							
						</ul>
					</li>
					
					
					
					
					<li class="sub-menu">
						<a href="javascript:;" ><i class="fa fa-wrench"></i> <span>Mantenimiento del Software</span></a>
						<ul class="sub">
							<li><a  href="javascript:conexionPHP('formulario.php','Modulo');">Crear Modulo</a></li>
							<li><a  href="javascript:conexionPHP('Programador/creaFormulario.php','CreaFormulario');">Crear Formulario</a></li>
							
							
							<li><a  href="javascript:cargar_form_soporte_pago();">soporte_pago</a></li>
							
							<li><a  href="javascript:respaldarDatos();">Realizar Copia de Seguridad</a></li>							
							<li><a  href="javascript:conexionPHP('formulario.php','consultaID');">Consultar ID</a></li>
							<li><a  href="javascript:conexionPHP('formulario.php','consulta_pred');">Consultas Predeterminadas</a></li>
							<li><a  href="javascript:infovieja();">Información Vieja</a></li>
							<li><a  href="javascript:conexionPHP('formulario.php','idiomas');">Configuración de Idioma</a></li>
							<li><a  href="javascript:conexionPHP('formulario.php','servidor');">Servidores</a></li>
							<li><a  href="javascript:conexionPHP('formulario.php','sincronizacion_servi');">Sincronizar Base de Datos</a></li>
							<li><a  href="javascript:conexionPHP('formulario.php','inicial_id');">Inicial para Usuarios</a></li>
							<li class="sub-menu">
								<a  href="javascript:;">Otros</a>
								<ul class="sub">
									<li><a  href="javascript:conexionPHP('formulario.php','ejecutar_sql');">Ejecutar SQL</a></li>
									<li><a  href="javascript:conexionPHP('formulario.php','ejecutar_php');">Ejecutar PHP</a></li>
								</ul>
							</li>
						</ul>
					</li>
					
				</ul>
				<!-- sidebar menu end-->
			</div>
		</aside>
		<!--sidebar end-->
		  
		  
		<!--main content start-->
		<section id="main-content"> <!--contenido global o general-->
			<section id="principal" class="wrapper"> <!--contenido donde se insertan los formularios-->

			</section> 
		</section> 
<!--f
		<div class="site-footer">
			 <div class="text-center">
				  <a href="#" class="go-top">
					  <i class="fa fa-angle-up"></i>
				  </a>
			 </div>
		</div>
		-->
		<!--footer start
		<footer class="site-footer">
		  
			  <a href="window.location.replace('#');" class="go-top">
				  <i class="fa fa-angle-up"></i>
			  </a>
		</footer>
		<!--footer end-->
	  
	</section>  

  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap/js/jquery-1.10.2.js"></script>
	<script src="bootstrap/js/jquery-1.8.3.min.js"></script>
	<script src="bootstrap/js/jquery-ui-1.9.2.custom.min.js"></script>
    <!-- Bootstrap -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
	<!-- Pre-carga de imágenes -->
	<script src="bootstrap/js/R-preloadcssimages.jquery.js"></script>
	<script type="text/javascript">
		 jQuery(document).ready(function(){
			   jQuery.preloadCssImages();
		 });
	</script>
	<!-- PLUGINS -->
	<script class="include" type="text/javascript" src="bootstrap/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="bootstrap/js/jquery.scrollTo.min.js"></script>
    <script src="bootstrap/js/jquery.nicescroll.js" type="text/javascript"></script>
	<!--custom checkbox & radio-->
	<script type="text/javascript" src="bootstrap/js/ga.js"></script>
	
	<!--custom switch-->
	<script src="bootstrap/js/bootstrap-switch.js"></script>
	<!--custom spinners-->
	<script type="text/javascript" src="bootstrap/js/spinner.min.js"></script>
	<!--custom tagsinput-->
	<script src="bootstrap/js/jquery.tagsinput.js"></script>
    <script src="bootstrap/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="bootstrap/js/jquery.easy-pie-chart.js"></script>
    <script src="bootstrap/js/owl.carousel.js" ></script>
    <script src="bootstrap/js/jquery.customSelect.min.js" ></script>
	<script src="bootstrap/js/jquery.validate.min.js" ></script>
	<script src="bootstrap/js/bootstrap-dialog.min.js"></script>	
	<script type="text/javascript" src="bootstrap/js/bootstrap-inputmask.min.js"></script>
	<script src="bootstrap/js/sparkline-chart.js"></script>
    <script src="bootstrap/js/easy-pie-chart.js"></script>
    <script src="bootstrap/js/count.js"></script>
	<script src="bootstrap/js/respond.min.js"></script>
	<!--DataTables-->
	<script src="bootstrap/js/jquery.dataTables.js"></script>
	<script src="bootstrap/js/dataTables.bootstrap.js"></script>

    <!--scripts personalizados-->
    <script src="bootstrap/js/scripts-jquery.js"></script>
	<script src="bootstrap/js/scripts-graficos.js"></script>
	<script src="bootstrap/js/filtros-graficos.js"></script>
	<script src="bootstrap/js/graficos-ordenes.js"></script>
	<script src="bootstrap/js/graficos-abonados.js"></script>
	<script src="bootstrap/js/graficos-ingresos-deudas.js"></script>
	<script src="bootstrap/js/ajaxParametros.js"></script>
	<script src="bootstrap/js/export-jqplot-to-png.js"></script>
	<script src="bootstrap/js/componentes-form-jquery.js"></script>
	<script src="bootstrap/js/validaciones.js" ></script>
	<script src="bootstrap/js/ventanaFormulario.js" ></script>
	<script src="bootstrap/js/mjeModal.js" ></script>
	<script src="bootstrap/js/tab.js" ></script>
	
	<!--JQPLOT-->	
	<script type="text/javascript" src="bootstrap/lib/jqplot/jquery.jqplot.js"></script>
	<script type="text/javascript" src="bootstrap/lib/jqplot/plugins/jqplot.barRenderer.js"></script>
	<script type="text/javascript" src="bootstrap/lib/jqplot/plugins/jqplot.pieRenderer.js"></script>
	<script type="text/javascript" src="bootstrap/lib/jqplot/plugins/jqplot.categoryAxisRenderer.js"></script>
	<script type="text/javascript" src="bootstrap/lib/jqplot/plugins/jqplot.pointLabels.js"></script>
	<script type="text/javascript" src="bootstrap/lib/jqplot/plugins/jqplot.cursor.js"></script>
	<script type="text/javascript" src="bootstrap/lib/jqplot/plugins/jqplot.highlighter.js"></script>
	<script type="text/javascript" src="bootstrap/lib/jqplot/plugins/jqplot.BezierCurveRenderer.js"></script>
	<script type="text/javascript" src="bootstrap/lib/jqplot/plugins/jqplot.dateAxisRenderer.js"></script>
	<script type="text/javascript" src="bootstrap/lib/jqplot/plugins/jqplot.canvasTextRenderer.js"></script>
	<script type="text/javascript" src="bootstrap/lib/jqplot/plugins/jqplot.canvasAxisTickRenderer.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap-datepicker.js"></script>


	<script type="text/javascript" src="include/parsley/parsley.js"></script>
	
	<script>
		window.onload = function () {
			
			cargar_form_iniciarsesion();
		}();
	</script>

	<?php 
		$acceso->objeto->ejecutarSql("select *from parametros where id_param='49' and id_franq='1'");
		$row=row($acceso);
		$aplet_java=trim($row['valor_param']);
		if($aplet_java=="1"){
	
	?>

	<applet id="miapplet" ARCHIVE ="include/JavaPrint/applet.jar" code="applet/PrintText.class" width="0" height="0"></applet>
 <?php } ?>
	
	</body>
	

</html>
<?php
	
?>