<?php
require_once("../procesos.php");
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db); $modo=trim($_GET['modo']);
 $ini_u = $_SESSION["ini_u"];  
$id_contrato=$_GET['id_contrato'];
if($id_contrato!=''){
	$sql="id_contrato='$id_contrato' ";
}
//crea la consulta SQL 
//campos, tabla, campo clave
$x->setQuery("id_lla,  fecha_lla, hora_lla,login, nombre_tll,nombre_trl , nombre_drl,obser_lla", "vista_llamadas","id_lla","$sql");
$x->hideColumn('id_lla');
$x->setColumnHeader('login', 'responsable');
$x->setColumnHeader('fecha_lla', 'fecha');
$x->setColumnHeader('hora_lla', 'hora');
$x->setColumnHeader('nombre_tll', 'tipo');
$x->setColumnHeader('nombre_drl', 'detalle resp');
$x->setColumnHeader('nombre_trl', 'tipo resp.');
$x->setColumnHeader('cliente', 'cliente');
$x->setColumnHeader('obser_lla', 'Observacion');
$x->setColumnHeader('', '');

//para permitir filtros
$x->allowFilters();
//para ir contanfo las filas
$x->showRowNumber();
//maximo resultados permitidos por paginas
$x->setResultsPerPage(20);

$x->setColumnType('fecha_lla', EyeDataGrid::TYPE_DATE, 'd/m/Y', true);
//llama al evento al darle click a la fila
if($id_contrato==''){
$x->addRowSelect("conexionPHP('validarExistencia.php','1=@llamadas','id_lla=@%id_lla%');window.location.replace('#');");
}
/*
//para que activar el boton modificar
$x->addStandardControl(EyeDataGrid::STDCTRL_EDIT, "modificarllamadas('%id_lla%')");
//para activar el boton eliminar
$x->addStandardControl(EyeDataGrid::STDCTRL_DELETE, "eliminarllamadas('%id_lla%')");
*/
	
if($modo!='EXCEL'){
$login = strtoupper(trim($_SESSION["login"]));
?>

<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		
			<div class="panel-body">	
				
				<input class="form-control" type="hidden" name="id_lla" maxlength="5" size="30"onChange="validarllamadas()" value="<?php $acceso->objeto->ejecutarSql("select *from llamadas   where (id_lla ILIKE '$ini_u%') ORDER BY id_lla desc"); echo $ini_u.verCodigo($acceso,"id_lla")?>">
				<input  type="hidden" name="id_lc" value="">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<label>TIPO LLAMADA</label>
							<select class="form-control" name="id_tll" id="id_tll" onchange="">
								<?php echo verTipoLlamada($acceso);?>
							</select>
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>TIPO RESPUESTA</label>													
						<select class="form-control" name="id_trl" id="id_trl" onchange="cargar_detalle_resp();">
							<?php echo verTipoResp($acceso);?>
						</select>	
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<label>DETALLE RESPUESTA</label>													
						<select class="form-control" name="id_drl" id="id_drl" onchange="traer_tipo_resp()">
							<?php echo verDetalleResp($acceso);?>
						</select>	
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<label>Responsable</label>													
								<input disabled class="form-control" type="text" name="login" maxlength="30" size="30" value="<?php echo $login;?>"  >							
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<label>fecha</label>													
								<input disabled class="form-control" type="text" name="fecha_lla" id="fecha_lla" maxlength="30" size="30" value="<?php echo date("d/m/Y");?>"  >							
					</div>
					
					<div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<label>hora</label>													
								<input disabled class="form-control" type="text" name="hora_lla" id="hora_lla" maxlength="30" size="30" value="<?php echo date("H:i");?>"  >							
					</div>
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>observacion</label>													
							<textarea class="form-control" name="obser_lla" rows="2"></textarea>					
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>crear alarma</label>
						<div>																	
							
								<input  type="radio" name="crea_alarma" value="NO"CHECKED/>NO
								<input  type="radio" name="crea_alarma" value="SI"/>SI
						
						</div>
					</div>		
					<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
					<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','llamadas')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>
					</div>		
				
				</div>
			
			<input class="form-control" type="hidden" value="dato" name="dato">			
			</div> <!-- FIN DEL PANEL -->	
			
	</section>	
		

<?php
}
$x->printTable();
?>
