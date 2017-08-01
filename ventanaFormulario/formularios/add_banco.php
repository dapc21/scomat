<?php 
/*session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('BANCO')))
{*/
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<form role="form" id="form_add_banco_ventana" name="f1" >
<section class="panel">
<div class="panel-body">

	<input class="form-control" type="hidden" name="id_banco" maxlength="10" size="30"onChange="" value="<?php /*$acceso->objeto->ejecutarSql("select *from banco where (id_banco ILIKE '$ini_u%') ORDER BY id_banco desc"); echo $ini_u.verCodigo($acceso,"id_banco"); */?>">

<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<label>Banco</label>
	<input class="form-control" type="text" name="banco" maxlength="50" value="" >

</div>
				<!--div align="center">
					<input  type="<?php /*echo $obj->in; */?>" name="registrar" value="REGISTRAR" onclick="verificar('incluir','add_banco')">&nbsp;
					<input  type="hidden" name="modificar" value="MODIFICAR" onclick="verificar('modificar','banco')">&nbsp;
					<input  type="hidden" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','banco')">&nbsp;
					
				</div-->
		

</div> <!-- FIN DEL PANEL -->

	<header class="panel-heading">Bancos Registrados</header>
	
<!-- INICIO DEL PANEL -->
<div class="panel-body">

	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

		<section>
			<div id="datagrid" class="data"></div>
		</section>
		
	</div>
	
</div> <!-- FIN DEL PANEL -->			


</section>
</form>
</div>
<?php 
	/*}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}*/
?>