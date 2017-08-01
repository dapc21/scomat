<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REP_PLANILLAMOV'))){	
?>

<input  type="hidden" name="aux_mat" id="aux_mat" maxlength="10" size="25" value="busquedad_m" >
<input  type="hidden" name="precio_u_p" maxlength="10" size="25" value="000" >
<input  type="hidden" name="id_m"id="id_m" maxlength="10" size="30"onChange="" value="">
<input  type="hidden" name="id_mat" id="id_mat" maxlength="10" size="30"onChange="validarmateriales_mat()" value="<?php $acceso->objeto->ejecutarSql("select *from materiales where (id_mat ILIKE '$ini_u%') ORDER BY id_mat desc LIMIT 1 offset 0"); echo $ini_u.verCodLong($acceso,"id_mat")?>">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_record_mat" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Récord de Materiales</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos Generales</header>
		
		<div class="panel-body">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Depósito</label >			
				<select class="form-control" name="id_dep" id="id_dep" onchange="habilita_num_mat();">
					<?php echo verDeposito02($acceso);?>
				</select>				
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Nº de Material</label >			
				<div class="input-group m-bot15">				
				<input class="form-control" disabled type="text" name="numero_mat" id="numero_mat"  onChange=""  maxlength="10" size="10" value="" style="text-align: left;">
				<span class="input-group-btn">
					<button type="button" class="btn btn-info" name="registrar" onclick="Busqueda_mat_avan();"><i class="glyphicon glyphicon-search"></i> Buscar</button>	
				</span>
				</div>
				
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<label>Nombre</label >
				<input class="form-control" disabled type="text" name="nombre_mat" id="nombre_mat" onChange="validarmat_rec_nom();" maxlength="50" size="40" value="" >				
			</div>
			
		</div>
		
		</div>
			
	</section>	
						
		<input  type="hidden" name="id_unidad" id="id_unidad" >
		<input  type="hidden" name="c_uni_ent" id="c_uni_ent" >
		<input  type="hidden" name="uni_id_unidad" id="uni_id_unidad" >
		<input  type="hidden" name="c_uni_sal" id="c_uni_sal" >
		<input  type="hidden" name="id_fam" id="id_fam" >
					
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Movimientos</header>
		
		<div class="panel-body">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Desde</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="fechades" id="fechades" maxlength="10" size="12" value="<?php echo date("d/m/Y");?>" >
			</div>	
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Hasta</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text" name="fechahas" id="fechahas" maxlength="10" size="12" value="<?php echo date("d/m/Y");?>" >
			</div>
			
		</div>
		
		</div>
			
	</section>				
				
		<input type="hidden" value="dato" name="dato">
		
		
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" type="<?php echo $obj->in;?>" name="buscar" value="<?php echo _("Buscar");?>" onclick="filtra_busquedad_m('id_dep','fechades','fechahas','id_mat');"><i class="glyphicon glyphicon-search"></i> Buscar</button>
			<button class="btn btn-success" type="<?php echo $obj->in;?>" name="imprimir" value="<?php echo _("imprimir");?>" onclick="ImprimirRep_recormov1()"><i class="glyphicon glyphicon-print"></i> Imprimir</button>
			<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP_mat('formulario.php','busquedad_m')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			<input  type="hidden" name="modificar" value="CANCELAR">
			<input  type="hidden" name="eliminar" value="CANCELAR">
			<input  type="hidden" name="Resetear" value="CANCELAR">
		</div>
		
		</div> <!-- FIN DEL PANEL --> 						
	
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
		
		<div align="center">
			<div style="display:none;">
			<input  type="hidden" name="registrar" value="<?php echo _("");?>" onclick="">&nbsp;				
			<input  type="hidden" name="modificar" value="<?php echo _("");?>" onclick="">&nbsp;				
			<input  type="hidden" name="eliminar" value="<?php echo _("");?>" onclick="">&nbsp;				
			<input  type="hidden" name="stock" value="<?php echo _("");?>" onclick="">&nbsp;				
			<input  type="hidden" name="stock_min" value="<?php echo _("");?>" onclick="">&nbsp;				
			<input  type="hidden" name="observacion" value="<?php echo _("");?>" onclick="">&nbsp;				
			</div>
		</div>
			
	<section class="panel">
		<header class="panel-heading">Movimientos</header>
		<div class="panel-body">
		
			<div id="datagrid" class="data"></div>
		
		</div> <!-- FIN DEL PANEL --> 						
	
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->		
						
</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->
				
<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>