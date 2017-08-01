<?php session_start();
/*require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ordenes_tecnicos2')))
{

session_start();
						$id_fr = $_SESSION["id_franq"]; 
						$serie='';
						if($id_fr!='0'){
							$cons=" and  id_franq='$id_fr'";
							$acceso->objeto->ejecutarSql("select serie from franquicia where id_franq='$id_fr'");
							$row=row($acceso);
							$serie= trim($row["serie"]);
						}
						else{
							$cons=" and  id_franq='1'";
						}
						
						$acceso->objeto->ejecutarSql("select id_orden from ordenes_tecnicos, contrato,vista_ubica where  ordenes_tecnicos.id_contrato = contrato.id_contrato and contrato.id_calle=vista_ubica.id_calle  ORDER BY num_o desc  LIMIT 1 offset 0 "); 
						$id_orden = verNumero($acceso,"id_orden");*/
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<form role="form" id="form_add_banco_ventana" name="f1" >
<section class="panel">
<div class="panel-body">

			<input  type="hidden" name="id_contrato" maxlength="10" size="15" value="">
			<input  type="hidden" name="status_con" maxlength="10" size="20" value="POR INSTALAR">

<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">

				<label>Nº de orden</label>
				<input class="form-control" disabled type="text" name="id_orden" maxlength="12" size="20"onChange="validarordenes_tecnicos()" value="<?php /*echo $id_orden;*/?>">
				
</div>
<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">

				<label>Técnico</label>
				<select class="form-control" disabled name="id_persona" id="-1" onchange="">
					<?php /*echo utf8_decode(verTecnicos($acceso));*/?>
				</select>

</div>
<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">				
				
				<label>Tipo de Orden</label>
				<select class="form-control" disabled name="id_tipo_orden" id="id_tipo_orden" onchange="">
					<?php /*echo utf8_decode(verTipoOrdenFalla($acceso));*/?>
				</select>
				
</div>
<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">				

				<label>Detalle de Orden</label>

				<select class="form-control" name="id_det_orden" id="id_det_orden" onchange="">
					<?php /*echo verDetalleOrdenFalla($acceso);*/?>
				</select>

</div>
		
		<input  type="hidden" name="fecha_orden" id="fecha_orden" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
		<input  type="hidden" name="fecha_final" id="fecha_final" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
		
		
		<input  type="hidden" value="CREADO" name="status_orden">
		<input  type="hidden" value="" name="comentario_orden">
		<input  type="hidden" value="" name="detalle_orden">
		<input  type="hidden" value="NORMAL" name="prioridad">

				<!--div align="center">
					<input  type="<?php /*echo $obj->in;*/?>" name="registrar" value="<?php /*echo _("registrar");*/?>" onclick="verificar('incluir','asig_orden')">&nbsp;
					<input  type="hidden" name="modificar" value="<?php /*echo _("modificar");*/?>" onclick="verificar('modificar','asig_orden')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php /*echo _("eliminar");*/?>" onclick="verificar('eliminar','ordenes_tecnicos')">&nbsp;
					
				</div-->

</div> <!-- FIN DEL PANEL -->			


</section>
</form>
</div>

<?php 
/*	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}*/
?>