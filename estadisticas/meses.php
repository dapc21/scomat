<?php

function nombreMes($opc){

	switch ($opc) {
		case '01':
			$mes = 'ENERO';
			break;
		case '02':
			$mes = 'FEBRERO';
			break;
		case '03':
			$mes = 'MARZO';
			break;
		case '04':
			$mes = 'ABRIL';
			break;
		case '05':
			$mes = 'MAYO';
			break;
		case '06':
			$mes = 'JUNIO';
			break;
		case '07':
			$mes = 'JULIO';
			break;
		case '08':
			$mes = 'AGOSTO';
			break;
		case '09':
			$mes = 'SEPTIEMBRE';
			break;
		case '10':
			$mes = 'OCTUBRE';
			break;
		case '11':
			$mes = 'NOVIEMBRE';
			break;
		case '12':
			$mes = 'DICIEMBRE';
			break;
	}

	return $mes;
}

?>