<?php
require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('inventario'))) //validar privilegios
{

$acceso->objeto->ejecutarSql("select * from estatus_inventario where codigo_est_inv = 'REV'");
while($row=row($acceso)){
	$nom_estatus = trim($row['nombre_est_inv']);
	$idEstInv = trim($row['id_est_inv']);
}

$idInv = id_unico();
$refInv = 'INV'.$ini_u.substr($idInv, 13,20);
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate="" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administración de inventario de materiales</h3></div>
	
	<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<section class="panel">
			
				<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
				<header class="panel-heading">Datos del Inventario</header>
					<div class="panel-body">
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label>Referencia</label>
								<input data-parsley-id="ref_inv" required="" disabled class="form-control" type="text" name="ref_inv" id="ref_inv" maxlength="20" size="20" value="<?php echo $refInv; ?>">
								<ul id="parsley-id-ref_inv" class="parsley-errors-list"></ul>
							</div>

							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label>Estatus</label>
								<input data-parsley-id="nombre_est_inv" required="" class="form-control" type="text" name="nombre_est_inv" id="nombre_est_inv" maxlength="120" value="<?php echo $nom_estatus;  ?>" disabled >
								<ul id="parsley-id-nombre_est_inv" class="parsley-errors-list"></ul>							
							</div>
							
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label>Motivo</label>
								<select data-parsley-id="id_mot_inv" required="" class="form-control" name="id_mot_inv" id="id_mot_inv" onchange="">
									<?php echo verMotivoInventario($acceso);?>
								</select>
								<ul id="parsley-id-id_mot_inv" class="parsley-errors-list"></ul>			
							</div>
							
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label>Observación</label>
								<textarea data-parsley-id="obser_inv" required="" class="form-control" name="obser_inv" id="obser_inv" rows="2" maxlength="65"></textarea>
								<ul id="parsley-id-obser_inv" class="parsley-errors-list"></ul>
							</div>
						
						</div>
						
					</div> <!-- FIN DEL PANEL -->	
			</section>
		
		</div>
		
	</div>
	<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<section class="panel">
				
					<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
					<header class="panel-heading">Datos del Almacén</header>
						<div class="panel-body">
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<label>almacén</label>
									<select data-parsley-id="id_alm" required="" class="form-control" name="id_alm" id="id_alm" onchange="">
										<?php echo verAlmacenStock($acceso);?>
									</select>
									<ul id="parsley-id-id_alm" class="parsley-errors-list"></ul>			
								</div>
								
							</div>
						
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							
								<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<input type="hidden" class="form-control" name="id_inv" id="id_inv" maxlength="" size="" value="<?php echo $idInv; ?>">
								</div>
								
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<input class="form-control" type="hidden" name="id_est_inv" id="id_est_inv" maxlength="20" size="20" value="<?php echo $idEstInv; ?>">
								</div>
								
								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<select style="display:none;" class="form-control" multiple="" name="id_mat[]" id="id_mat" onchange="" disabled >
									</select>						
								</div>
							
							</div>
							
						</div> <!-- FIN DEL PANEL -->	
				</section>
				
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<section class="panel">
			
				<header class="panel-heading" id="header_mat">Material(es)</header>
					
					<div class="panel-body2">
						<section id="flip-scroll" style="height:150px;">
							<table id="tabla_inventario_material" class="table-aux">
								<thead>
									<tr>
										<th>NRO</th>
										<th class="hidden">ID MATERIAL</th>
										<th class="hidden">ID STOCK</th>
										<th class="hidden-phone">MATERIAL(ES)</th>
										<th>CANTIDAD DISPONIBLE</th>
										<th>STOCK MÍNIMO</th>
										<th>CANT. EXPRESADAS EN</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</section>
					</div>	
			</section>
		
		</div>
	
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<!-- ?EA DE PANEL O PANELES -->
			<section class="panel">		
				<div class="panel-body">	
					<div id="error"  class="  alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12 "></div>
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
						<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_inventario('incluir','inventario');"><i class="glyphicon glyphicon-pencil"></i> Revisar</button>		
						<button disabled name="modificar" id="modificar" class="btn btn-danger" type="button" type="<?php echo $obj->mo; ?>" class="boton" value="<?php echo _("modificar");?>" onclick="gestionar_inventario('modificar','inventario');"><i class="glyphicon glyphicon-ok-circle"></i> Finalizar</button>
						<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_inventario()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
					</div>	
				</div> <!-- FIN DEL PANEL -->	
			</section>
	
		</div>
			
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
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

		</div>
	
	</div>
 
</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->
<script type="text/javascript">
var alm='', valAlm='';
$('#id_alm').on('change', function() {
	valAlm = $(this).val();
	alm = this.options[this.selectedIndex].text;
	if(valAlm == ''){
		$('#header_mat').html("material(es)");
		$("#tabla_inventario_material tbody").html('');
	}
	else{
	
		console.log("ID: "+valAlm + " - Nombre Almacen: "+this.options[this.selectedIndex].text);
		$('#header_mat').html("material(es) en "+alm);
		buscar_mat_stock(valAlm);
	}
	
});

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

