<?php
//Archivo que permite identificar que formulario se desea cargar
//verifica que antes se haya iniciado sesion
require_once("DataBase/Acceso.php");
$acceso=conexion();
if($acceso)
{
	session_start();
	$valor=explode("=@",$_POST['d']);
	$clase=$valor[0];
	if($_SESSION["autenticacion"]!="On"){
		if($clase=='Sesion')
			include "Formulario/Sesion.php";
		else
			echo "SecurityFalse";
	}
	else{
		switch($clase)
		{
			case Sesion:
				//incluyo todo el formulario que se encuentre en ese archivo 
				//se puede ejecutar codigo php en los archivos
				include "Formulario/Sesion.php";
				break;
			case Usuario:
				include "Formulario/Usuario.php";
				break;
			case Perfil:
				include "Formulario/Perfil.php";
				break;
			case Modulo:
				include "Formulario/Modulo.php";
				break;
		case Persona:
			include "Formulario/Persona.php";
			break;
	case motivo_inv:
		include "Formulario/motivo_inv.php";
		break;
	case familia:
		include "Formulario/familia.php";
		break;
	case inventario_materiales:
		include "Formulario/inventario_materiales.php";
		break;
	case deposito:
		include "Formulario/deposito.php";
		break;
	case unidad_medida:
		include "Formulario/unidad_medida.php";
		break;
	case tipo_movimiento:
		include "Formulario/tipo_movimiento.php";
		break;
	case movimiento:
		include "Formulario/movimiento.php";
		break;
	case proveedor:
		include "Formulario/proveedor.php";
		break;
	case pedido:
		include "Formulario/pedido.php";
		break;
	case materiales:
		include "Formulario/materiales.php";
		break;
	case mov_mat:
		include "Formulario/mov_mat.php";
		break;
	case motivo_inv:
		include "Formulario/motivo_inv.php";
		break;
	case mat_prov:
		include "Formulario/mat_prov.php";
		break;
	case mat_ped:
		include "Formulario/mat_ped.php";
		break;
	case confir_pedido:
		include "Formulario/confir_pedido.php";
		break;
	case realizar_compra:
		include "Formulario/realizar_compra.php";
		break;
	case Rep_reportepedido:
		include "Formulario/Rep_reportepedido.php";
		break;
	case inventario:
		include "Formulario/inventario.php";
		break;
	case aprobarinventario:
		include "Formulario/aprobarinventario.php";
		break;
	case mat_padre:
		include "Formulario/mat_padre.php";
		break;
	case Rep_matpadre:
		include "Formulario/Rep_matpadre.php";
		break;
	case Rep_proveedores:
		include "Formulario/Rep_proveedores.php";
		break;
	case Rep_materialesuniinv:
		include "Formulario/Rep_materialesuniinv.php";
		break;
	case Rep_planillamov:
		include "Formulario/Rep_planillamov.php";
		break;
	case Rep_planillaped:
		include "Formulario/Rep_planillaped.php";
		break;
	case Rep_planillainv:
		include "Formulario/Rep_planillainv.php";
		break;
	case Rep_reportemovimiento:
		include "Formulario/Rep_reportemovimiento.php";
		break;
	case Rep_reporteinventario:
		include "Formulario/Rep_reporteinventario.php";
		break;
	case ejempl:
		include "Formulario/ejempl.php";
		break;
	default:
		include "Formulario/$clase.php";
		}// fin switch
	}
}
else{
	include "Formulario/Configuracion.php";
}
?>