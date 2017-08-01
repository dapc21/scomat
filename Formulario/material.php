<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('material'))) //validar privilegios
{

$idMat= id_unico();
$codMat = 'MAT'.$ini_u.substr($idMat, 13,20);

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administracion de material</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos del material</header>
			<div class="panel-body">
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<input class="form-control" type="hidden" name="id_mat" id="id_mat" maxlength="20" size="20" value="<?php echo $idMat; ?>">
					</div>
				
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<label>código del material</label>
						<input data-parsley-id="codigo_mat" required="" class="form-control" type="text" name="codigo_mat" id="codigo_mat" maxlength="20" size="20" value="<?php echo $codMat; ?>" disabled />
						<ul id="parsley-id-codigo_mat" class="parsley-errors-list"></ul>							
					</div>
					
					<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<label>familia</label>
						<select data-parsley-id="id_fam" required="" class="form-control" name="id_fam" id="id_fam" onchange="">
							<?php echo verFamiliaMaterial($acceso);?>
						</select>
						<ul id="parsley-id-id_fam" class="parsley-errors-list"></ul>							
					</div>

					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>nombre del material</label>
						<input data-parsley-id="nombre_mat" required="" class="form-control" type="text" name="nombre_mat" id="nombre_mat" maxlength="150" size="20" value="" >
						<ul id="parsley-id-nombre_mat" class="parsley-errors-list"></ul>							
					</div>
				
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<label>para impresión</label>
						<select data-parsley-id="impreso" required="" class="form-control" name="impreso" id="impreso" onchange="">
							<option value="f">NO</option>
							<option value="t">SI</option>
						</select>
						<ul id="parsley-id-impreso" class="parsley-errors-list"></ul>			
					</div>
					
				</div>
					
			</div> <!-- FIN DEL PANEL -->
	
	</section>	
	<section class="panel">	
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">unidades de medidas del material</header>
		
			<div class="panel-body">
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div id="infoValStock"></div>
					</div>
						
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>cantidad (entrada)</label>
						<input data-parsley-id="cant_uni_ent" required="" class="form-control" type="text" name="cant_uni_ent" id="cant_uni_ent" maxlength="2000000000" size="20" value="" onblur="formatDec(this.id,this.value);" >
						<ul id="parsley-id-cant_uni_ent" class="parsley-errors-list"></ul>							
					</div>

					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>unidad de medida entrante</label>
						<select data-parsley-id="id_uni" required="" class="form-control" name="id_uni" id="id_uni" onchange="">
							<?php echo verUnidadMaterial($acceso);?>
						</select>
						<ul id="parsley-id-id_uni" class="parsley-errors-list"></ul>			
					</div>

					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>cantidad (salida)</label>
						<input data-parsley-id="cant_uni_sal" required="" class="form-control" type="text" name="cant_uni_sal" id="cant_uni_sal" maxlength="2000000000" size="20" value="" onblur="formatDec(this.id,this.value);" >
						<ul id="parsley-id-cant_uni_sal" class="parsley-errors-list"></ul>							
					</div>

					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>unidad de medida saliente</label>
						<select data-parsley-id="uni_id_uni" required="" class="form-control" name="uni_id_uni" id="uni_id_uni" onchange="">
							<?php echo verUnidadMaterial($acceso);?>
						</select>
						<ul id="parsley-id-uni_id_uni" class="parsley-errors-list"></ul>			
					</div>
					
				</div>
					
			</div> <!-- FIN DEL PANEL -->
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_material('incluir','material')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled name="modificar" id="modificar" class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" value="<?php echo _("modificar");?>" onclick="gestionar_material('modificar','material')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_material('eliminar','material')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_material()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos Agregados</header>
			<div class="panel-body">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid"></div>
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	 
 
</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->
<script type="text/javascript">
function formatDec(id, valor){
	var calc = parseFloat(Math.round(valor * 100) / 100).toFixed(2);
	if( calc != '0.00'){
		$('#'+id).val(calc);
	}
	else{
		console.log("Debe ingresar valores válidos o distintos a cero");
		mjeAlertaCantidad("Debe ingresar valores válidos o distintos a cero."); 
		$('#'+id).val("");
	}
}

function mjeAlertaCantidad(mje){
	$("#infoValStock").fadeIn("slow", function() {
		$("#infoValStock").html("<div class='well well-lg well-warning'><strong>Atención!</strong> "+mje+" </div>");
		$(".well-warning").css({ "background-color": "#f2dede", "border-color": "#ebccd1", "color": "#a94442" });
		$(".well-lg").css({ "padding": "15px", "border-radius": "3px" });
		$(".well-warning").effect("highlight", {color:"#ffff99"}, 1000);
	});
	$("#infoValStock").fadeOut(5000);
}
</script>	
<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" class="boton" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>

