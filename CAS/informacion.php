<?php
//archivo destinado a procesar y devolver datos o informacion relaciona con la aplicacion
session_start();
require_once "procesos.php";
$cadena=$_POST['d'];
$valor=explode("=@",$cadena);
$clase=$valor[0];

if($_SESSION["autenticacion"]!="On"){
	
	if($clase=='Manejador')
		echo Manejador();
	else
		echo "SecurityFalse";
}
else{
require_once "procesos.php";
$cadena=$_POST['d'];
$valor=explode("=@",$cadena);
$clase=$valor[0];
switch($clase)
{
	case TraerModulo:
		echo traerModulo(acceso($acceso,sql(consulta("moduloperfil","codigoperfil",$valor[1],'ORDER BY codigomodulo'))),"codigomodulo");
		break;
	case TraerModulo1:
		echo traerModulo(acceso($acceso,sql(consulta("moduloperfil","codigomodulo",$valor[1],'ORDER BY codigoperfil'))),"codigoperfil");
		break;
	case Manejador:
		echo Manejador();
		break;
	case ObjetoFormulario:
		echo ObjetoForm($valor);
		break;
	case CargaObjeto:
		echo CargaObjeto($valor);
		break;
	case CargaRegistro:
		echo CargaRegistro($valor,acceso($acceso,sql($valor[1])));
		break;
	case Limpieza:
		echo Limpieza();
		break;
	case LimpiezaModulo:
		echo  LimpiezaModulo();
		break;
	case camposRep2:
		echo  camposRep2($acceso,$valor);
		break;
	case validarSQL:
		echo  validarSQL($acceso,$valor[1]);
		break;
	default:
		echo titulo("El contenido de ".$clase." no esta Construdio Disculpe las molestias");
}
}//security
function validarSQL($acceso,$sql){
	if($acceso->objeto->validarSql($sql)==true)
		return 'true';
	else{
		return 'false';
	}
}
function camposRep2($acceso,$tabla){
	$manejador=$acceso->objeto->getManejador();
	$cad="";
	$primero=false;
	for($i=1;$i<count($tabla);$i++)
	{
		$table=$tabla[$i];
		$acceso->objeto->ejecutarSql("select * from $table");
		$num=$acceso->objeto->num_fields();
		for($j=0;$j<$num;$j++)
		{
			$meta = $acceso->objeto->fetch_field($j);
			if($manejador=="MySql")
			{
				if($primero==false)
					$cad='<option selected="selected" value="'.$table.'.'.$meta->name.'">'.$table.'.'.$meta->name.'</option>';
				else
					$cad.='<option value="'.$table.'.'.$meta->name.'">'.$table.'.'.$meta->name.'</option>';
			}
			else if($manejador=="Postgres"){
				if($primero==false)
					$cad='<option selected="selected" value="'.$table.'.'.$meta.'">'.$table.'.'.$meta.'</option>';
				else
					$cad.='<option value="'.$table.'.'.$meta.'">'.$table.'.'.$meta.'</option>';
			}
			
			$primero=true;
		}
	}
	return $cad;
}
//retorna los datos de un perfil para saber a que modulos tiene acceso
function traerModulo($acceso,$dato){
	$cadena="";
	while($row=row($acceso)){				
		$cadena=$cadena.trim($row[$dato]).','.trim($row[2]).','.trim($row[3]).','.trim($row[4]).'=@';
	}
	return $cadena;
}

?>