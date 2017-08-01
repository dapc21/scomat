<?php
/*
session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('act_contrato')))
{
		
$cli_id_persona = verCod_cli($acceso,$ini_u);

	$acceso->objeto->ejecutarSql("select *from parametros where id_param='4'"); 
	if($row=row($acceso)){
		$valor_param_v=trim($row['valor_param']);
	}
		$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='7'");
		if($row=row($acceso)){
			$cargo_aut= trim($row["valor_param"]);
		}
		$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='11'");
		if($row=row($acceso)){
			$status_visible= trim($row["valor_param"]);
		}
		$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='12'");
		if($row=row($acceso)){
			$etiqueta_visible= trim($row["valor_param"]);
		}
		*/
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_prueba" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Prueba de Gráficos</h3></div>

	<!-- <section class="wrapper site-min-height"> -->
              <!-- page start-->
              <div id="morris">
                  <div class="row">
                      
                      <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                          <section class="panel">
                              <header class="panel-heading">
                                  Estadísticas de Barras - Ingresos y Deudas Anuales
                              </header>
                              <div class="panel-body">
                                  <div id="hero-bar" class="graph"></div>
                              </div>
                          </section>
                      </div>
					  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                          <section class="panel">
                              <header class="panel-heading">
                                  Estadísticas de Líneas de Tiempo - Ingresos y Deudas Anuales
                              </header>
                              <div class="panel-body">
                                  <div id="hero-graph" class="graph"></div>
                              </div>
                          </section>
                      </div>
                  
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <section class="panel">
                              <header class="panel-heading">
                                  Estadísticas de Área - Ingresos y Deudas Anuales
                              </header>
                              <div class="panel-body">
                                  <div id="hero-area" class="graph"></div>
                              </div>
                          </section>
                      </div>
                      <!--div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <section class="panel">
                              <header class="panel-heading">
                                  Donut flavours
                              </header>
                              <div class="panel-body">
                                  <div id="hero-donut" class="graph"></div>
                              </div>
                          </section>
                      </div-->
                  </div>
              </div>

              <!-- page end-->
    <!-- </section> -->
	
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<input class="btn btn-success" type="hidden" name="registrar" value="REGISTRAR" onclick="verificar('modificar','contrato')">
			<input class="btn btn-warning" type="hidden" name="modificar" value="<?php echo _("actualizar");?>" onclick="verificar('modificar','act_contrato')">
			<button class="btn btn-success" type="<?php echo $obj->mo; ?>" name="modificar" value="<?php echo _("IMPRIMIR CONTRATO");?>" onclick="imp_cont1()"><i class="glyphicon glyphicon-print"></i> Generar PDF</button>
			<input class="btn btn-danger" type="hidden" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','contrato')">
			<input class="btn btn-info" type="hidden" name="salir" onclick="conexionPHP('formulario.php','act_contrato')" value="<?php echo _("limpiar");?>">
		</div>
		
		</div> <!-- FIN DEL PANEL --> 						
	
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
	
	
</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->

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