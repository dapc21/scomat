<br>
<H3 align="center"><strong>Introduzca su nombre de usuarios y contrase&ntilde;a</strong></H3>
<br>
<p align="justify">Bienvenido! al introducir sus datos, el sistema iniciar&aacute; una nueva
 sesi&oacute;n personalizada. De esta forma, Ud. podr&aacute; crear, modificar o eliminar
 la informaci&oacute;n relacionada con su cuenta.</p>
<br>
<form name="f1">
	<table border="1" width="250px" align="CENTER" bordercolor="" >
		<tr>
			<td>
				<font color="#000000" size="2" face="arial">Usuario</font>
			</td>
			<td>
				<input  type="text" name="login" maxlength="15" size="25" value="admin">
			</td>
		</tr>
		<tr>
			<td>
				<font color="#000000" size="2" face="arial">Contrase&ntilde;a</font>
			</td>
			<td>
				<input  type="password" name="password" maxlength="25" size="25" value="admin">
			</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
				<input  type="button" name="entrar" value="ENTRAR" onclick="iniciarSesion()">
				&nbsp;<input  type="hidden" value="" name="registrar">
				&nbsp;<input  type="hidden" value="" name="modificar">
				&nbsp;<input  type="hidden" value="" name="eliminar">
				<div>
			</td>
		</tr>
		</font>
	</table>
</form>