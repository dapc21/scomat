<html>
<head>
<title>Cargar Foto del Registro</title>
    <style type="text/css">
<!--
.cabe{height: 40px; text-align: center;	font: 13pt arial,"arial",Times, serif;color: #4A5A6D;font-weight: bold;text-transform :uppercase;}
.fuente{font: 9pt arial, Times, serif;color: #000000;text-transform :uppercase;}
.fuente1{font: 7pt arial, Times, serif;color: #000000;text-transform :uppercase;}
-->
    </style>
</head>
<body>
		<div id="principal">
		<form  name="f1"  action="../procesos/carga_excel.php" method="post" enctype="multipart/form-data">
		<input  type="hidden" name="codigoresgistro" value="<?php echo $_REQUEST[codigoresgistro];?>">
		<table width="500" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="40" colspan="2"><div align="center" class="cabe">Cargar Archivo Excel con los registros</div></td>
          </tr>
          <tr>
            <td width="74" height="30"><span class="fuente">Archivo</span></td>
            <td width="320" height="30"><input type="file" name="foto" size="50" onBlur=""></td>
          </tr>
          
		  <tr>
			<td colspan="3" class="fuente1" align="center">El formato v&aacute;lido es: Excel 2007 (xlsx) </td>
		</tr>
          <tr>
            <td height="50" colspan="2"><div align="center">
              <input class="boton" type="submit" name="enviar" value="Cargar Documento">
            </div></td>
          </tr>
		 
        </table>
		</form>
</div>

</body>
</html>