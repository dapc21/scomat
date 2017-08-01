<?php 
require_once "../procesos.php";
$acceso->objeto->ejecutarSql("select *from parametros where id_param='39' and id_franq='1'");
$row=row($acceso);
$alert_act_G=trim($row['valor_param']);
$acceso->objeto->ejecutarSql("select *from parametros where id_param='40' and id_franq='1'");
$row=row($acceso);
$dias_alert_act_G=trim($row['valor_param']);
$acceso->objeto->ejecutarSql("select *from parametros where id_param='41' and id_franq='1'");
$row=row($acceso);
$alert_imp_G=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='42' and id_franq='1'");
$row=row($acceso);
$tipo_facturacion=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='43' and id_franq='1'");
$row=row($acceso);
$dig_cont_G=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='44' and id_franq='1'");
$row=row($acceso);
$serie_correl_G=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='60' and id_franq='1'");
$row=row($acceso);
$planilla_orden_G=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='48' and id_franq='1'");
$row=row($acceso);
$modulo_cable_modem_G=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='53' and id_franq='1'");
$row=row($acceso);
$control_recibo_G=trim($row['valor_param']);

	$acceso->objeto->ejecutarSql("select *from parametros where id_param='36' and id_franq='1'");
	$row=row($acceso);
	$dig_cont_fisico_G=trim($row['valor_param']);

$acceso->objeto->ejecutarSql("select *from parametros where id_param='54' and id_franq='1'");
$row=row($acceso);
$dig_recibo_G=trim($row['valor_param']);

?>
<!--div id="login-body"-->

    <div class="container-login">

      <form class="form-signin" name="fsesion" >
        <h2 class="form-signin-heading">Inicio de Seddddsión</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" id="login" name="login" placeholder="Usuario" autofocus value="">
            <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" >
            <button class="btn btn-lg login-ini btn-block" name="entrar"  value="" type="submit">Entrar</button>
			<div class="round" align="center" style="margin-top:5px;">
			  <a href="#">
				  <img src="imagenes/logo-saeco.png" alt="">
			  </a>
			</div>
            <p>2014 &copy; SAECOSOFT C.A.</p>
        </div>
		 <input type="hidden"  id="alert_act_G" value="<?php echo $alert_act_G;?>">
		 <input type="hidden"  id="dias_alert_act_G" value="<?php echo $dias_alert_act_G;?>">
		 <input type="hidden"  id="alert_imp_G" value="<?php echo $alert_imp_G;?>">
		 <input type="hidden"  id="tipo_facturacion" value="<?php echo $tipo_facturacion;?>">
		 <input type="hidden"  id="dig_cont_G" value="<?php echo $dig_cont_G;?>">
		 <input type="hidden"  id="serie_correl_G" value="<?php echo $serie_correl_G;?>">
		 <input type="hidden"  id="planilla_orden_G" value="<?php echo $planilla_orden_G;?>">
		 <input type="hidden"  id="modulo_cable_modem_G" value="<?php echo $modulo_cable_modem_G;?>">
		 <input type="hidden"  id="control_recibo_G" value="<?php echo $control_recibo_G;?>">
		 <input type="hidden"  id="dig_cont_fisico_G" value="<?php echo $dig_cont_fisico_G;?>">
		 <input type="hidden"  id="dig_recibo_G" value="<?php echo $dig_recibo_G;?>">
      </form>

    </div>

 <!--/div-->
