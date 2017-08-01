
<?php
require('../include/JavaPrint/JavaPrint.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"];

//$cadena=$_POST['d'];
//$valor=split("=@",$cadena);

$id_pago=$_GET['id_pago'];

class PDF extends JavaPrint
{
	public $fuente;
	public $tipo;

	function add($cad,$x,$y){
		$x=$x/2.54;
		$y=$y/2.54;
		$this->SetXY($x,$y);
	//	$this->SetFont('arial','',11);
		$this->Cell(100,5,$cad,0,0,"");
	}
	function addN($cad,$x,$y){
		$x=$x/2.54;
		$y=$y/2.54;
		$this->SetXY($x,$y);
		$this->SetFont('arial','B',10);
		$this->Cell(78,5,$cad,0,0,"");
	}
	function Cuerpo($acceso,$id_pago)
	{
		//$this->SetXY(20,40);
		//$this->Image('../imagenes/cabecera.jpg',20,10,40);
		$this->SetFont('arial','',16);

		$this->fuente='arial';
		$this->tipo='may';


		$select="SELECT vista_tarifa.id_serv,vista_tarifa.tipo_serv, pagos.id_caja_cob,pagos.obser_pago,pagos.id_pago,pagos.fecha_pago, pagos.hora_pago,pagos.monto_pago,pagos.nro_factura,
  pagos.id_contrato, contrato_servicio_pagado.fecha_inst, contrato_servicio_pagado.cant_serv, contrato_servicio_pagado.costo_cobro
  ,contrato.nro_contrato, vista_cliente.cedula AS cedulacli, vista_cliente.nombre AS nombrecli, vista_cliente.apellido AS apellidocli
  , vista_tarifa.nombre_servicio, vista_tarifa.tipo_costo
   FROM pago_servicio, pagos, contrato_servicio_pagado, vista_tarifa, contrato, vista_cliente
  WHERE pagos.id_pago = pago_servicio.id_pago AND pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv and contrato_servicio_pagado.id_serv = vista_tarifa.id_serv AND pagos.id_contrato = contrato.id_contrato AND vista_tarifa.status_tarifa_ser = 'ACTIVO'::bpchar and contrato.cli_id_persona = vista_cliente.id_persona and pagos.id_pago='$id_pago'
ORDER BY fecha_inst;";
		//echo $select;
		$pago=lectura($acceso,$select);
		$id_contrato=trim($pago[0]['id_contrato']);
		$cont=lectura($acceso,"SELECT TAPS,NUMERO_PISO,URBANIZACION,EDIFICIO,DIREC_ADICIONAL,NUMERO_CASA,NOMBRE_ZONA,NOMBRE_SECTOR,NOMBRE_CALLE,NUMERO_CASA,TELEFONO,NOMBRE_FRANQ FROM VISTA_CONTRATO_auditoria  where id_contrato='$id_contrato'  LIMIT 1 offset 0");

		$t_pago=lectura($acceso,"SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago");

		$id_caja_cob=trim($pago[0]['id_caja_cob']);
		$t_caja=lectura($acceso,"SELECT nombre_caja,nombre,apellido,id_est FROM vista_caja where id_caja_cob='$id_caja_cob'");
		$nombre_caja=trim($t_caja[0]['nombre_caja']);
		$id_est=trim($t_caja[0]['id_est']);

		$cobrador=trim($t_caja[0]['nombre'])." ".trim($t_caja[0]['apellido']);


			$id_franq='1';
			$id_contrato=trim($pago[0]['id_contrato']);
			$fecha=trim($pago[0]['fecha_pago']);
			//$fecha='2015-02-09';
			$obser_pago=trim($pago[0]['obser_pago']);
			$hora_pago=trim($pago[0]['hora_pago']);
			$fechaN=explode("-",$fecha);
			$fecha_pago= $fechaN[2].'/'.$fechaN[1].'/'.$fechaN[0];
			$meses=$fechaN[1];


			$monto_pago=trim($pago[0]['monto_pago']);
			$nro_factura=trim($pago[0]['nro_factura']);
			$cedulacli=trim($pago[0]['cedulacli']);
			$nombrecli=utf8_decode(trim($pago[0]['apellidocli'])." ".trim($pago[0]['nombrecli']));
			$nro_contrato=trim($pago[0]['nro_contrato']);
			$tipo_serv=trim($pago[0]['tipo_serv']);
		$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as deuda FROM contrato_servicio_deuda where id_contrato='$id_contrato'  AND costo_cobro>0");
            $row=row($acceso);
            $deuda=trim($row["deuda"]);


//		$acceso->objeto->ejecutarSql("SELECT nombre_zona,nombre_sector,nombre_calle,numero_casa,telefono FROM vista_contrato where id_contrato='$id_contrato' LIMIT 1 offset 0");
		//if($row=row($acceso)){
			$nombre_franq=utf8_decode(trim($cont[0]['nombre_franq']));
			$estado_franq=utf8_decode(trim($cont[0]['estado_franq']));
			$ciudad_franq=utf8_decode(trim($cont[0]['ciudad_franq']));
			$prefijo=utf8_decode(trim($cont[0]['prefijo']));
			$pref_desde=utf8_decode(trim($cont[0]['pref_desde']));
			$pref_hasta=utf8_decode(trim($cont[0]['pref_hasta']));
			$telefono_franq=utf8_decode(trim($cont[0]['telefono_franq']));
			$direccion_franq=utf8_decode(trim($cont[0]['direccion_franq']));
			$nombre_zona=utf8_decode(trim($cont[0]['nombre_zona']));
			$nombre_sector=utf8_decode(trim($cont[0]['nombre_sector']));
			$nombre_calle=utf8_decode(trim($cont[0]['nombre_calle']));
			$numero_casa=utf8_decode(trim($cont[0]['numero_casa']));
			$taps=utf8_decode(trim($cont[0]['taps']));
			$telefono=utf8_decode(trim($cont[0]['telefono']));

			$urbanizacion=utf8_decode(trim($cont[0]['urbanizacion']));
			$numero_piso=utf8_decode(trim($cont[0]['numero_piso']));
			$edificio=utf8_decode(trim($cont[0]['edificio']));
			$direc_adicional=utf8_decode(trim($cont[0]['direc_adicional']));
		//}
		$acceso->objeto->ejecutarSql("SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago");
		//if($row=row($acceso)){
		if(count($t_pago)==1){
			$tipo_pago=utf8_decode(trim($t_pago[0]['tipo_pago']));
			$banco=trim($t_pago[0]['banco']);
			$numero=trim($t_pago[0]['numero']);
		}
		else{
			$tipo_pago="MULTIPLE";
		}

		//$this->SetXY(20,30);
		$x1	=5;
		$x2	=14;
		$y1	=304.8;
		$y2	=460;
		$inter = 11;
		$alto=$inter+15;
		$alt=25;



		$this->SetFont('courier','',7);
		if($id_est=="AY003"){			//EL ESFUERZO
		$this->AddPage("p","tick");

		$this->SetXY(1,6);
		$this->SetX($x1);
		$this->Cell(46,4,"       CABLE NORTE, C.A.",'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"          J-31216176-0",'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"CALLE LOS PALOS.QTA.PARCELA 463",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4," URB. TURUMO. ZONA POSTAL 1073",'0',0,'L');


		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"     SUCURSAL: EL ESFUERZO",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"VILLA ARAURE 1, LA LAGUNITA" ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"     CALLE 6 ESQUINA, AV 9" ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"    ARAURE EDO. PORTUGUESA." ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"   TEL: 0501-NORTE00 (66873)" ,'0',0,'L');

		}
		else if($id_est=="AG003"){			//CANEYES
		$this->AddPage("p","tick");

		$this->SetXY(1,6);
		$this->SetX($x1);
		$this->Cell(46,4,"       CABLE NORTE, C.A.",'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"          J-31216176-0",'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"CALLE LOS PALOS.QTA.PARCELA 463",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4," URB. TURUMO. ZONA POSTAL 1073",'0',0,'L');


		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"     SUCURSAL: CANEYES",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"  EDIFICIO MI BARBARA, LOCAL 10" ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"  AV. PANAMERICANA COPA DE ORO" ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4," MUNICIPIO GUASIMO EDO. TACHIRA." ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"   TEL: 0501-NORTE00 (66873)" ,'0',0,'L');

		}
		else if($id_est=="AL001"){			//san antonio
		$this->AddPage("p","tick");

		$this->SetXY(1,6);
		$this->SetX($x1);
		$this->Cell(46,4,"       CABLE NORTE, C.A.",'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"          J-31216176-0",'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"CALLE LOS PALOS.QTA.PARCELA 463",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4," URB. TURUMO. ZONA POSTAL 1073",'0',0,'L');


		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"     SUCURSAL: SAN ANTONIO 2",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"  TERRAZA SANTA MARGARITA" ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"  CALLE 4 AV. 3 CASA 3-156" ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4," MUNICIPIO BOLIVAR EDO. TACHIRA." ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"   TEL: 0416-3450456" ,'0',0,'L');

		}
		else if($id_est=="AW002"){			//LAS VEGAS
		$this->AddPage("p","tick1");

		$this->SetXY(1,6);
		$this->SetX($x1);
		$this->Cell(46,4,"           CABLE NORTE, C.A.",'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"             J-31216176-0",'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"    CALLE LOS PALOS.QTA.PARCELA 463",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"     URB. TURUMO. ZONA POSTAL 1073",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"           SUCURSAL: LAS VEGAS",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"   DIR: ZORCA, SECTOR MATA DE DUADUA" ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4," VIA A CAPACHO, AL LADO DE LA FABRICA" ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4," MAGIGLIN, PARROQUIA SAN JUAN BAUTISTA" ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"      SAN CRISTOBAL EDO. TACHIRA" ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"       TEL: 0501-NORTE00 (66873)" ,'0',0,'L');

		}
		else if($id_est=="EM001"){			//SANTA ANA 2
		$this->AddPage("p","tick1");

		$this->SetXY(1,6);
		$this->SetX($x1);
		$this->Cell(46,4,"           CABLE NORTE, C.A.",'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"             J-31216176-0",'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"    CALLE LOS PALOS.QTA.PARCELA 463",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"     URB. TURUMO. ZONA POSTAL 1073",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"           SUCURSAL: SANTA ANA",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"  DIRECCION: CALLE 12 ENTRE CARRERA 4-5" ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"      CENTRO COMERCIAL CORDOBEREÑA " ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"         LOCAL 10 EDO. TACHIRA" ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"        TELEFONO: 0276-4253676" ,'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->SetFont('courier','B',8);
		$this->Cell(46,4,"               FACTURA " ,'0',0,'L');
		$this->SetFont('courier','B',7);

		}
		else if($id_est=="AG004"){			//SAN JOSECITO
		$this->AddPage("p","tick1");

		$this->SetXY(1,6);
		$this->SetX($x1);
		$this->Cell(46,4,"           CABLE NORTE, C.A.",'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"             J-31216176-0",'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"    CALLE LOS PALOS.QTA.PARCELA 463",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"     URB. TURUMO. ZONA POSTAL 1073",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"           SUCURSAL: SAN JOSECITO",'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"  DIRECCION: SECTOR LA COLINA CALLE PRINCIPAL " ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"      CENTRO COMERCIAL YAIGER " ,'0',0,'L');
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"         LOCAL 4-5 EDO. TACHIRA" ,'0',0,'L');
		$this->Ln();


		$this->Ln();
		$this->SetX($x1);
		$this->SetFont('courier','B',8);
		$this->Cell(46,4,"               FACTURA " ,'0',0,'L');
		$this->SetFont('courier','B',7);

		}

		$this->Ln();
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,substr("Cliente: $nombrecli",0,30) ,'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"C.I./R.I.F.: $cedulacli"  ,'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"Abonado No.: $nro_contrato"  ,'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,substr("Direccion: $nombre_sector, $nombre_calle, $numero_casa",0,30)  ,'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,substr("Direccion: $nombre_sector, $nombre_calle, $numero_casa",30,30)  ,'0',0,'L');


		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"Recibo No: $nro_factura"  ,'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"Forma de pago: $tipo_pago"  ,'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"Cobrador: $cobrador"  ,'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"Caja: $nombre_caja"  ,'0',0,'L');


		list($ano,$mes,$dia)=explode("-",$fecha);
		$mes_l=formato_mes_com1($mes);
		$dia_l=formato_semana(date("N"));
		//"$dia_l, $dia de $mes_l de $ano"
		$hora=date("H:i:s");

		$this->Ln();
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"Fecha: $dia/$mes/$ano     /    $pro"  ,'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"Hora: $hora"  ,'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,""  ,'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"RECIBO DE PAGO"  ,'0',0,'L');

		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,""  ,'0',0,'L');

		$alto=200;
		$suma=0;
		$xy=260;
		$alto+=$inter;
		for($i=0;$i<count($pago);$i++){
			$nombre_servicio=utf8_decode(trim($pago[$i]['nombre_servicio']));
			$id_serv=utf8_decode(trim($pago[$i]['id_serv']));
			$tipo_costo=trim($pago[$i]['tipo_costo']);
			$fecha=trim($pago[$i]['fecha_inst']);
			$fecha_contrato=formatofecha($pago[$i]['fecha_inst']);
			$fechaN=explode("-",$fecha);

			 if($id_est=="AG003"){			//CANEYES
				$mes=formato_m($fechaN[1]);
				$anio=$fechaN[0];
				if($tipo_costo=='COSTO MENSUAL'){
					if($id_serv=='ZZZ00001'){
						$nombre_servicio = "ABONO $mes $anio ";
					}else{
						$nombre_servicio = "MENS. $mes $anio ";
					}
				}
			 }
			 else{
				$mes=formato_mes_com($fechaN[1]);
				$anio=$fechaN[0];
				if($tipo_costo=='COSTO MENSUAL'){
					if($id_serv=='ZZZ00001'){
						$nombre_servicio = "ABONO $mes $anio ";
					}else{
						$nombre_servicio = "MENSUALIDAD $mes $anio ";
					}
				}
			}
			$cant_serv=trim($pago[$i]['cant_serv']);
			$costo_cobro=trim($pago[$i]['costo_cobro']);
			$total=$cant_serv*$costo_cobro;
			$suma=$suma+$total;


			$this->SetX($x_izq);
			//	$costo_cobro=$costo_cobro/1.12;
			//	$total=$total/1.12;
			$costo_cobro=number_format($costo_cobro, 2, ',', '.');
			$total=number_format($total+0, 2, ',', '.');

			 if($id_est=="AG003"){		//CANEYES
				$this->Ln();
				$this->SetX($x1);
				$this->Cell(20,4,"$nombre_servicio"  ,'0',0,'L');
				$this->Cell(10,4,"$total"  ,'0',0,'R');
			 }else{
				$this->Ln();
				$this->SetX($x1);
				$this->Cell(25,4,"$nombre_servicio"  ,'0',0,'L');
				$this->Cell(10,4,"$total"  ,'0',0,'R');
			}
		}


		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,""  ,'0',0,'L');


		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_franq='$id_franq' and id_param='2'");

		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		$total_p=$suma;
		$porc=($por_iva/100)+1;
		$base=$total_p/1.16;
		$iva=($base*$por_iva)/100;

		$base=number_format($base+0, 2, ',', '.');
		$iva=number_format($iva+0, 2, ',', '.');
		$total_p=number_format($total_p+0, 2, ',', '.');

		$this->Ln();
		$this->Ln();
		$this->SetX($x1);
		$this->Cell(46,4,"TOTAL Bs.  $total_p"  ,'0',0,'L');


		$this->Ln();

		$this->SetX($x1);
		$this->Cell(46,4,"    **GRACIAS POR SU PAGO**"  ,'0',0,'L');
		$this->Ln();
		$mes_act=$meses;
		if ($dia <= 10){
			for($v=0;$v<count($pago);$v++){
				$fecha_in=trim($pago[$v]['fecha_inst']);
				$id_serv=trim($pago[$v]['id_serv']);
					$fechaN=explode("-",$fecha_in);
					$mes=$fechaN[1]+0;
					$mese=formato_mes_com1($fechaN[1]);
					$anio=$fechaN[0];

				if ($tipo_costo=='COSTO MENSUAL' && $mes >= $mes_act-1 &&  $mes <=5 && $id_serv!='ZZZ00001' ){
					$this->Ln();
					$this->SetX($x1);
					$this->SetFont('times','B',11);
					$this->Cell(46,4," norte "  ,'0',0,'C');

					$this->Ln();
					$this->SetX($x1);
					$this->SetFont('times','',7);
					$this->Cell(46,4," ComunicacionesIntegrales>>> "  ,'0',0,'C');
					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," RIF: J-31216176-0 "  ,'0',0,'C');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Nº Factura: $nro_factura   fechaPago: $fecha_pago  "  ,'0',0,'L');
					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Mes Pagado: $mese   $anio"  ,'0',0,'L');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," $nombrecli    C:I:$cedulacli "  ,'0',0,'L');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Telefono ___________/_____________"  ,'0',0,'L');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Correo ________________________"  ,'0',0,'L');$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Promoción Autorizada por la SUNDDE."  ,'0',0,'L');$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Correo Valido desde el 15 de febrero hasta el 20 de junio."  ,'0',0,'L');

				}
			}
		}
		else {
			for($v=0;$v<count($pago);$v++){
				$fecha_in=trim($pago[$v]['fecha_inst']);


				$id_serv=trim($pago[$v]['id_serv']);
					$fechaN=explode("-",$fecha_in);
					$mes=$fechaN[1]+0;
					$mese=formato_mes_com1($fechaN[1]);
					$anio=$fechaN[0];
			$meses = $meses+1;
			if ($tipo_costo=='COSTO MENSUAL' && $mes >= $mes_act &&  $mes <=5 && $id_serv!='ZZZ00001' ){
					$this->Ln();
					$this->SetX($x1);
					$this->SetFont('times','B',11);
					$this->Cell(46,4," norte "  ,'0',0,'C');

					$this->Ln();
					$this->SetX($x1);
					$this->SetFont('times','',7);
					$this->Cell(46,4," ComunicacionesIntegrales>>> "  ,'0',0,'C');
					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," RIF: J-31216176-0 "  ,'0',0,'C');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Nº Factura: $nro_factura   fechaPago: $fecha_pago  "  ,'0',0,'L');
					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Mes Pagado: $mese   $anio"  ,'0',0,'L');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," $nombrecli    C:I:$cedulacli "  ,'0',0,'L');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Telefono ___________/_____________"  ,'0',0,'L');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Correo ________________________"  ,'0',0,'L');$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Promoción Autorizada por la SUNDDE."  ,'0',0,'L');$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Correo Valido desde el 15 de febrero hasta el 20 de junio."  ,'0',0,'L');

				}
			}
		}
		if ($tipo_serv == 'INSTALACION') {

					$this->Ln();
					$this->SetX($x1);
					$this->SetFont('times','B',11);
					$this->Cell(46,4," norte "  ,'0',0,'C');

					$this->Ln();
					$this->SetX($x1);
					$this->SetFont('times','',7);
					$this->Cell(46,4," ComunicacionesIntegrales>>> "  ,'0',0,'C');
					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," RIF: J-31216176-0 "  ,'0',0,'C');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Nº Factura: $nro_factura   fechaPago: $fecha_pago  "  ,'0',0,'L');
					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Contrato Nuevo:" .$fecha_contrato ,'0',0,'L');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," $nombrecli    C:I:$cedulacli "  ,'0',0,'L');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Telefono ___________/_____________"  ,'0',0,'L');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Correo ________________________"  ,'0',0,'L');$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Promoción Autorizada por la SUNDDE."  ,'0',0,'L');$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Correo Valido desde el 15 de febrero hasta el 20 de junio."  ,'0',0,'L');


					$this->Ln();
					$this->Ln();
					$this->SetX($x1);
					$this->SetFont('times','B',11);
					$this->Cell(46,4," norte "  ,'0',0,'C');

					$this->Ln();
					$this->SetX($x1);
					$this->SetFont('times','',7);
					$this->Cell(46,4," ComunicacionesIntegrales>>> "  ,'0',0,'C');
					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," RIF: J-31216176-0 "  ,'0',0,'C');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Nº Factura: $nro_factura   fechaPago: $fecha_pago  "  ,'0',0,'L');
					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Contrato Nuevo:" .$fecha_contrato  ,'0',0,'L');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," $nombrecli    C:I:$cedulacli "  ,'0',0,'L');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Telefono ___________/_____________"  ,'0',0,'L');

					$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Correo ________________________"  ,'0',0,'L');$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Promoción Autorizada por la SUNDDE."  ,'0',0,'L');$this->Ln();
					$this->SetX($x1);
					$this->Cell(46,4," Correo Valido desde el 15 de febrero hasta el 20 de junio."  ,'0',0,'L');

		}


		return $cad;
	}

}


$pdf=new PDF();
//$pdf->AddPage("p","factura");



$pdf->Cuerpo($acceso,$id_pago);

$pdf->Output("reporte$id_pago.pdf",'D');



function formato_semana($me){
	$mes=array("1"=>_("Lunes"),"2"=>_("Martes"),"3"=>_("Miercoles"),"4"=>_("Jueves"),"5"=>_("Vienes"),"6"=>_("Sabado"),"7"=>_("Domingo"));
	return $mes[$me];
}
?>
