<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('MATERIALES'))){
	
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_material" >
	
	<div class="border-head"><h3>Administración de Materiales</h3></div>
	
	<!-- AREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Materiales</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<input  type="hidden" name="aux_mat" id="aux_mat" maxlength="10" size="25" value="materiales" >
			<input  type="hidden" name="precio_u_p" maxlength="10" size="25" value="000" >
			<input  type="hidden" id="id_m"name="id_m" maxlength="10" size="30"onChange="validarmat_padre()" value="<?php $acceso->objeto->ejecutarSql("select *from mat_padre where (id_m ILIKE '$ini_u%') ORDER BY id_m desc LIMIT 1 offset 0"); echo $ini_u.verCodlong($acceso,"id_m")?>">
			<input  type="hidden" name="id_mat" id="id_mat" maxlength="10" size="30"onChange="validarmateriales_mat()" value="<?php $acceso->objeto->ejecutarSql("select *from materiales where (id_mat ILIKE '$ini_u%') ORDER BY id_mat desc LIMIT 1 offset 0"); echo $ini_u.verCodLong($acceso,"id_mat")?>">

			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Nº de Material</label>
				<div class="input-group">							
				<input class="form-control" type="text" name="numero_mat" id="numero_mat" onKeyPress="return validar_numeros(event);"  onChange="validarmat_padre2()" maxlength="10" size="10" value="<?php $acceso->objeto->ejecutarSql("select * from mat_padre  ORDER BY numero_mat desc LIMIT 1 offset 0"); echo vernumero($acceso,"numero_mat");?>" style="text-align: left;">
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="buscar_abonado" onclick="Busqueda_mat_avan();"><i class="fa fa-search"></i></button>	
				</div>
				</div>
				
			</div>
			
			<div class="form-group col-lg-9 col-md-6 col-sm-12 col-xs-12">
				<label>Nombre</label>
				<input class="form-control" type="text" name="nombre_mat" maxlength="50" size="40" value="" onChange="validarmat_padre3();">
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Medida de Entrada</label>
				<select class="form-control" name="id_unidad" id="id_unidad" onchange="pasaRvalorUni();">
					<?php echo verUnidadMedida($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Cantidad de Entrada</label>
				<input class="form-control" type="text" name="c_uni_ent" id="c_uni_ent"  onKeyPress="return validar_numeros(event);"  onchange="pasaRvalorCan();" maxlength="4" size="5" value="1" style="text-align: left;">
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Medida de Salida</label>
				<select class="form-control" name="uni_id_unidad" id="uni_id_unidad" onchange="">
					<?php echo verUnidadMedida($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Cantidad de Salida</label>
				<input class="form-control" type="text" name="c_uni_sal" id="c_uni_sal" onKeyPress="return validar_numeros(event);"  onchange="val_ensalmed_mat('c_uni_sal','c_uni_ent');"onblur="val_ensalmed_mat('c_uni_sal','c_uni_ent');"onfocus="val_ensalmed_mat('c_uni_sal','c_uni_ent');" maxlength="4" size="5" value="1" style="text-align: left;">
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Familia</label>
				<select class="form-control" name="id_fam" id="id_fam" onchange="">
					<?php echo verFamilia($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<label>Para Impresión</label>
				<select class="form-control" name="impresion" id="impresion" onchange="">
					<option value="f">NO</option>
					<option value="t">SI</option>
				</select>
			</div>
			
			</div>
			

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Depósito</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<label>Depósito</label>
				<select class="form-control" name="id_dep" id="id_dep" onChange="validarmat_padre4();">
					<?php echo verDeposito($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<label>Stock</label>
				<input class="form-control" type="text" name="stock" disabled maxlength="8" size="20" value="0" style="text-align: left;">
			</div>
			
			<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<label>Min Stock</label>
				<input class="form-control" type="text" name="stock_min" maxlength="4" onKeyPress="return validar_numeros(event);"  size="20" value="" style="text-align: left;">
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Observación</label>
				<textarea class="form-control" name="observacion" cols="1" rows="2"></textarea>
			</div>
						
			<input  type="hidden" value="dato" name="dato">
			
			</div>
			

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<button class="btn btn-success" type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar_mat('incluir','materiales')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
			<button class="btn btn-warning" type="<?php echo $obj->mo;?>" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_mat('modificar','materiales')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
			<button class="btn btn-danger" type="<?php echo $obj->el;?>" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','materiales')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
			<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP_mat('formulario.php','materiales')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
		</div>
		
		</div> <!-- FIN DEL PANEL --> 

	</section> <!-- FIN DEL AREA DE PANEL O PANELES -->
	<section class="panel" id="tabla-material-deposito">
	
		<header class="panel-heading">Datos de los Materiales Registrados</header>
	
		<div class="panel-body">	
		<div id="datagrid" class="data"></div>	
		</div> <!-- FIN DEL PANEL --> 

	</section>

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