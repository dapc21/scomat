<?php 

	//	$db = new SQLite3(C:\Documents and Settings\User\Datos de programa\PC Suite\352925023764220\PCCSSMS.db);
	//	$results = $db->query("SELECT * FROM sms_data");

require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
		$acceso->objeto->ejecutarSql("select *from config_sms where id_franq='1'");
		if($con=$acceso->objeto->devolverRegistro()){
			$id_conf_sms=trim($con["id_conf_sms"]);
			$cod_telf_pais=trim($con["cod_telf_pais"]);
			$telefono_serv=trim($con["telefono_serv"]);
			$puerto=trim($con["puerto"]);
			$conex=trim($con["conex"]);
			$bits=trim($con["bits"]);
			$marca=trim($con["marca"]);
			$modelo=trim($con["modelo"]);
			$encendido=trim($con["encendido"]);

		}
		$status=array("1"=>"CONECTADO","0"=>"DESCONECTADO","2"=>"CONECTANDO...");
		$status_color=array("1"=>"conectado","0"=>"noconectado","2"=>"conectando");
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title><?php echo _("servicio sms-saeco");?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<script language="JavaScript" type="text/javascript" src="javascript/ajax.js"></script>
<style type="text/css">

.fuenteP{font: 8pt arial,"arial", Times, serif;color: #000000;}
.fuente{font: 9pt arial, Times, serif;color: #000000;text-transform :uppercase;}
.fuenteNormal{font: 9pt arial, Times, serif;color: #000000;text-transform :none;}

.fuenteM{font: 9pt arial, Times, serif;color: #000000;text-transform :uppercase; font-weight: bold;text-decoration: underline;}

.fuenteN{font: 10pt "arial", Times, serif;color: #000000;font-weight: bold;text-transform :uppercase;}
.cabe{height: 40px; text-align: center;	font: 13pt arial,"arial",Times, serif;color: #4A5A6D;font-weight: bold;text-transform :uppercase;}
fieldset{
			background:#F5F9FE;
			font-size:10pt;
			font-family: Arial, sans-serif;
			color:#B9CAE1;
			/*text-transform :uppercase;*/
			font-weight :bold;
			border: 1px solid #B9CAE1; 
			-moz-border-radius: 5px;
}

legend{
			color:#B9CAE1;
			text-transform :uppercase;
			font-weight :bold;
}
.conectado{
	color: #009800;
}
.noconectado{
	color: #FF0000;
}
.conectando{
	color: #E38412;
}
.porconectar{
	color: #E32412;
}
</style>
</head>
<body >
<BR><div class="cabe"><?php echo _("configuracion sms");?></div>
<form name="f1" >

<table border="0" width="450px" align="CENTER" > 
 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos de modem/telefono");?></legend>
		<input  type="hidden" name="id_conf_sms" maxlength="8" size="30"onChange="validarconfig_sms()" value="<?php echo $id_conf_sms;?>">
		<table border="0" width="450px" align="CENTER" cellpadding="2" cellspacing="2"> 
		<tr>
			<td>
				<span class="fuente"><?php echo _("codigo telef. de pais");?>
				</span>
			</td>
			<td>
				<span class="fuente"><?php echo _("conexion");?>
				</span>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="fuente"><?php echo _("puerto com");?>
				</span>
			</td>
			
		</tr>
		<tr>
			<td class="fuente">
				<input  type="text" name="cod_telf_pais" maxlength="5" size="3" value="<?php echo $cod_telf_pais;?>" >
			</td>
			<td>
				<input  type="text" name="conf_campo2" maxlength="11" size="10" value="<?php echo $conex;?>" >
				&nbsp; &nbsp;
				<input  type="text" name="id_canal_sms" maxlength="10" size="10" value="<?php echo $puerto;?>" >
			</td>
			
		</tr>
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("bits por segundo");?>
				</span>
			</td>
			<td>
				<span class="fuente"><?php echo _("marca telf.");?>
				</span>
			</td>
			
		</tr>
		<tr>
			<td>
				<input  type="text" name="conf_campo3" maxlength="10" size="10" value="<?php echo $bits;?>" >
			</td>
			<td>
				<input  type="text" name="marca" maxlength="11" size="30" value="<?php echo $marca;?>" >
			</td>
			
		</tr>
		
		
		<tr>
			<td>
				<span class="fuente"><?php echo _("num. telf.");?>
				</span>
			</td>
			<td>
				<span class="fuente"><?php echo _("modelo telf.");?>
				</span>
			</td>
		</tr>
		<tr>
			<td class="fuente">
				<input  type="text" name="telefono_serv" maxlength="20" size="20" value="<?php echo $telefono_serv;?>" >
			</td>
			<td colspan="3">
				<input  type="text" name="modelo" maxlength="10" size="30" value="<?php echo $modelo;?>" >
			</td>
		</tr>
		<tr >
			<td align="center" colspan="2">
				<div id="status_serv">
				<span id="status_serv" class="cabe <?php echo $status_color[$encendido]; ?>"><?php echo _("status:");?> <?php echo $status[$encendido]; ?><span>
				
				<div>
			</td>
		</tr>
			</table>
	</fieldset>
  </td>		
 </tr>

		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input type="button" name="registrar" value="<?php echo _("conectar");?>" onclick="conec_ser_sms()">&nbsp;
					<input type="button" name="modificar" value="<?php echo _("detener");?>" onclick="det_sinc_SMS()">&nbsp;
					<input type="button" name="eliminar" value="<?php echo _("reconectar");?>" onclick="rei_sinc_SMS()">&nbsp;
				</div>
			</td>
		</tr>
		<tr>			
			<td colspan="2">	
				<div id="divSMS">
				</div>			
			</td>		
		</tr>
	</table>
</form>

</body>
</html>
<script>
	det_sinc_SMS();
	setTimeout('conec_ser_sms()', 1000);
	//setTimeout('conexionPHP_sms1("sms.php","ini_serv_email");', 5000);
	setTimeout('javascript:location.reload();', 18000000);
</script>