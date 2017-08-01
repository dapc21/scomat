<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["$ini_u"]; 

$id_contrato=trim($_GET['id_contrato']);
class PDF extends FPDF
{
	
	//Titulo del reporte
	function Titulo($titulo,$id_contrato)
	{
	}
	//muestra el listado de los reportes 
	function Cuerpo($acceso,$id_contrato)
	{
		//echo "SELECT *FROM vista_contrato where id_contrato='$id_contrato'";
		$acceso->objeto->ejecutarSql("SELECT tarifa_ser FROM vista_tarifa where id_serv='BM00001'");
		
		if($row=row($acceso)){
			$costo_inst=utf8_decode(trim($row['tarifa_ser']));
		}
		//echo "update contrato set contrato_imp='SI' where id_contrato='$id_contrato'";
		$acceso->objeto->ejecutarSql("update contrato set contrato_imp='SI' where id_contrato='$id_contrato'");
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_contrato where id_contrato='$id_contrato'");
		if($row=row($acceso)){
		
			$observacion=utf8_decode(trim($row['observacion']));
			$costo_contrato=utf8_decode(trim($row['costo_contrato']));
			$tipo_cliente=utf8_decode(trim($row['tipo_cliente']));
			$nombrecli=utf8_decode(trim($row['nombrecli']));
			$apellidocli=utf8_decode(trim($row['apellido']));
			$nombrecli=utf8_decode(trim($row['nombre']));
			$etiqueta=utf8_decode(trim($row['etiqueta']));
			$cedulacli=utf8_decode(trim($row['cedula']));
			
			$fecha=formatofecha(trim($row["fecha_contrato"]));
			$fecha_nac=formatofecha(trim($row["fecha_nac"]));
			
			
			$nro_contrato=trim($row['nro_contrato']);
			$id_contrato=trim($row['id_contrato']);
		
		
			$puntos=utf8_decode(trim($row['puntos']));
			$deuda=utf8_decode(trim($row['deuda']));
			if($deuda==""){
				$deuda=0;
			}
			
			$deuda=number_format($deuda, 2, ',', '.');
			$nombre_zona=utf8_decode(trim($row['nombre_zona']));
			$nombre_sector=utf8_decode(trim($row['nombre_sector']));
			$nombre_calle=utf8_decode(trim($row['nombre_calle']));
			$numero_casa=utf8_decode(trim($row['numero_casa']));
			$telefono=utf8_decode(trim($row['telefono']));
			$telf_casa=utf8_decode(trim($row['telf_casa']));
			$telf_adic=utf8_decode(trim($row['telf_adic']));
			$email=utf8_decode(trim($row['email']));
			$direc_adicional=utf8_decode(trim($row['direc_adicional']));
			$id_persona=utf8_decode(trim($row['id_persona']));
			$postel=utf8_decode(trim($row['postel']));
			$taps=utf8_decode(trim($row['taps']));
			$pto=utf8_decode(trim($row['pto']));
			$edificio=utf8_decode(trim($row['edificio']));
			$numero_piso=utf8_decode(trim($row['numero_piso']));
		}
		$acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM persona where id_persona='$id_persona'  LIMIT 1 offset 0 ");
		
		if($row=row($acceso)){
			$vendedor=utf8_decode(trim($row['nombre']))." ".utf8_decode(trim($row['apellido']));
			
		}

		if($tipo_cliente=='JURIDICO'){
			$rif=$cedulacli;
			$cedulacli='';
		}
		
		
		$this->Ln();	
		$this->SetFont('times','B',11);
		$this->SetXY(10,35);		
		$this->Cell(195,10,"Abonado: $nro_contrato","0",0,"R");				
		
		
		
		$this->SetXY(40,50);						
						
		$this->Ln();
		$this->SetFont('times','B',11);
		$this->SetX(10);
		$this->Cell(195,6,"PERSONA JURIDICA.","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',11);
		$this->SetX(10);
		$this->Cell(195,6,"Raz�n Social.","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(98,6,"Actividad.","1",0,"J");
		$this->Cell(97,6,"RIF. $rif","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(98,6,"E-mail.","1",0,"J");
		$this->Cell(97,6,"Telef.","1",0,"J");
				
		$this->Ln();
		$this->SetFont('times','',11);
		$this->SetX(10);
		$this->Cell(195,6,"Representante Legal","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(98,6,"C.I: ","1",0,"J");
		$this->Cell(97,6,"Cargo en la Empresa.","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','B',11);
		$this->SetX(10);
		$this->Cell(195,6,"PERSONA NATURAL.","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(195,6,"Apellidos y Nombres: $nombrecli $apellidocli","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(65,6,"C�dula: $cedulacli","1",0,"J");
		$this->Cell(65,6,"Fecha de Nac: $fecha_nac","1",0,"J");
		$this->Cell(65,6,"Profesi�n u Oficio: ","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(65,6,"Telf. Hab: $telf_casa","1",0,"J");
		$this->Cell(65,6,"Celular: $telefono","1",0,"J");
		$this->Cell(65,6,"Telef Ofic: $telf_adic","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(65,6,"E-mail: $email","1",0,"J");
		$this->Cell(65,6,"Ingreso Mensual: ","1",0,"J");
		$this->Cell(65,6,"Deposito en Garantia: ","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(130,6,"Tipo Vivienda: Propia ___  Alquilado ___         Canon Mensual: ____","1",0,"J");		
		$this->Cell(65,6,"Vencimiento del Contrato:    /    / ","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','B',11);
		$this->SetX(10);
		$this->Cell(195,6,"DATOS DEL CONYUGUE.","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(195,6,"Apellidos y Nombres: ","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(65,6,"C�dula: ","1",0,"J");
		$this->Cell(65,6,"Fecha de Nac: ","1",0,"J");
		$this->Cell(65,6,"Profesi�n u Oficio: ","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(65,6,"Telf. Hab: ","1",0,"J");
		$this->Cell(65,6,"Celular: ","1",0,"J");
		$this->Cell(65,6,"Telef Ofic: ","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(98,6,"E-mail: ","1",0,"J");
		$this->Cell(97,6,"Ingreso Mensual.","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','B',11);
		$this->SetX(10);
		$this->Cell(195,6,"DOMICILIO DEL SERVICIO","1",0,"C");
		
		/*$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(98,6,"Apellidos: $apellidocli","1",0,"J");
		$this->Cell(97,6,"Vendedor: $vendedor","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(98,6,"Suscriptor N�: $nro_contrato","1",0,"J");
		$this->Cell(97,6,"Fecha: $fecha","1",0,"J");*/
				
	
		/*if($tipo_cliente=='JURIDICO'){
			$rif=$cedulacli;
			$cedulacli='';
		}*/
		/*$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(98,6,"C.I. $cedulacli","1",0,"J");
		$this->Cell(97,6,"RIF. $rif","1",0,"J");*/
		
		
		/*$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(65,6,"Ocupaci�n: ","1",0,"J");
		$this->Cell(65,6,"Grupo Familiar N�:","1",0,"J");
		if($fecha_nac=='11/11/1111'){
			$fecha_nac='';
		}
		$this->Cell(65,6,"Fecha de Nacimiento : $fecha_nac","1",0,"J");
		
		
		$this->Ln();
		$this->SetFont('times','B',12);
		$this->SetX(10);
		$this->SetFillColor(76,136,206);
		$this->SetTextColor(255,255,255);
		$this->Cell(195,6,"DOMICILIO DE SERVICIO","1",0,"C",'1');
		$this->SetTextColor(0,0,0);*/
		
			
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(98,6,"Urb o Sector: $nombre_sector","1",0,"J");		
		$this->Cell(97,6,"Calle n�: ","1",0,"J");		
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(98,6,"Avenida o Calle: $nombre_calle","1",0,"J");		
		$this->Cell(97,6,"Vereda : ","1",0,"J");		
		
		if($edificio!='')
			$apto=$numero_casa;
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(65,6,"Edificio: $edificio","1",0,"J");
		$this->Cell(65,6,"Piso:","1",0,"J");
		$this->Cell(65,6,"N� de Casa o Apto: $numero_casa $apto","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(130,6,"Referencia o Zona: $nombre_zona                          N�Poste:$postel","1",0,"J");
		//$this->Cell(65,6,"N� de Poste: $postel","0",0,"J");
		$this->Cell(65,6,"Ruta Cuenta: ","1",0,"J");
		
		
		/*$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(98,6,"Zona: $nombre_zona","1",0,"J");
		$this->Cell(97,6,"Manzana: ","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(98,6,"Urb.: $nombre_sector","1",0,"J");*/
		
		/*if($edificio!='')
			$apto=$numero_casa;
		
		$this->Cell(97,6,"Apto.: $apto","1",0,"J");*/
		
		
		/*$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(98,6,"Edificio: $edificio","1",0,"J");
		$this->Cell(97,6,"Cod. Postal: ","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(65,6,"Telf. Hab: $telf_casa","1",0,"J");
		$this->Cell(65,6,"Celular: $telefono","1",0,"J");
		$this->Cell(65,6,"Telef Ofic: $telf_adic","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		//Rect( float x, float y, float w, float h [, string style])
		$this->Cell(98,6,"Vivienda Alquilada: SI ____ NO ____","1",0,"J");
		$this->Cell(97,6,"Fecha de Vencimineto de Alquiler: ","1",0,"J");
	
	
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(98,6,"E-mail: $email","1",0,"J");
		$this->Cell(97,6,"Proveedor de Internet: ","1",0,"J");*/
		
		
		
		/*$this->Ln();
		$this->SetFont('times','B',12);
		$this->SetX(10);
		$this->SetFillColor(76,136,206);
		$this->SetTextColor(255,255,255);
		$this->Cell(195,6,"SERVICIOS CONTRATADOS","1",0,"C",'1');
		$this->SetTextColor(0,0,0);*/
		
		$this->Ln();
		$this->SetFont('times','B',11);
		$this->SetX(10);
		$this->Cell(195,6,"SERVICIOS CONTRATADOS","1",0,"C");		
	
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(100,6,"SERVICIOS ","1",0,"J");		
		$this->Cell(30,6,"CANT.","1",0,"C");
		$this->Cell(30,6,"P. UNITARIO ","1",0,"C");
		$this->Cell(35,6,"P. TOTAL ","1",0,"C");
	
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(100,5,"Instalaci�n Principal","1",0,"J");		
		$this->Cell(30,5,"1","1",0,"C");
		$this->Cell(30,5,"$costo_inst","1",0,"C");
		$this->Cell(35,5,"$costo_inst","1",0,"C");
	
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(100,5,"Tomas Adicionales","1",0,"J");		
		$this->Cell(30,5,"","1",0,"C");
		$this->Cell(30,5,"","1",0,"C");
		$this->Cell(35,5,"","1",0,"C");
	
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(100,5,"Cable Coaxial","1",0,"J");		
		$this->Cell(30,5,"","1",0,"C");
		$this->Cell(30,5,"","1",0,"C");
		$this->Cell(35,5,"","1",0,"C");
	
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(100,5,"Conectores","1",0,"J");		
		$this->Cell(30,5,"","1",0,"C");
		$this->Cell(30,5,"","1",0,"C");
		$this->Cell(35,5,"","1",0,"C");
	
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(100,5,"Espliter","1",0,"J");		
		$this->Cell(30,5,"","1",0,"C");
		$this->Cell(30,5,"","1",0,"C");
		$this->Cell(35,5,"","1",0,"C");
	
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(100,5," ","1",0,"J");		
		$this->Cell(60,5,"TOTAL A PAGAR BS","1",0,"R");
		$this->Cell(35,5,"$costo_inst","1",0,"C");
	
		
		
		/*$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->SetTextColor(255,255,255);
		$this->Cell(50,5,"FECHA ESTIMADA","LRT",0,"C",'1');
		$this->SetTextColor(0,0,0);
		$this->Cell(25,5,"","LRT",0,"C");
		$this->SetTextColor(255,255,255);
		$this->Cell(25,5,"HORA","LRT",0,"C",'1');
		$this->SetTextColor(0,0,0);
		$this->Cell(30,5,"","LRT",0,"C");
		$this->SetTextColor(255,255,255);
		$this->Cell(30,5,"TOTAL A","LRT",0,"C",'1');
		$this->SetTextColor(0,0,0);
		$this->Cell(35,5,"$costo_contrato","LRT",0,"C");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->SetTextColor(255,255,255);
		$this->Cell(50,5,"DE INSTALACION","LRB",0,"C",'1');
		$this->SetTextColor(0,0,0);
		$this->Cell(25,5,"","LRB",0,"C");
		$this->SetTextColor(255,255,255);
		$this->Cell(25,5,"SUGERIDA","LRB",0,"C",'1');
		$this->SetTextColor(0,0,0);
		$this->Cell(30,5,"","LRB",0,"C");
		$this->SetTextColor(255,255,255);
		$this->Cell(30,5,"PAGAR Bs.","LRB",0,"C",'1');
		$this->SetTextColor(0,0,0);
		$this->Cell(35,5,"","LRB",0,"C");*/
		
		$this->Ln();
		$this->SetFont('times','B',11);
		$this->SetX(10);
		$this->Cell(195,6,"PROGRAMACI�N","1",0,"C");					
		
		$this->Ln();
		$this->SetFont('times','',10);
		$this->SetX(10);
		$this->Cell(45,6,"Descripci�n.","1",0,"C");
		$this->Cell(25,6,"Monto","1",0,"C");
		$this->Cell(30,6,"Firma Abonado","1",0,"C");
		$this->Cell(40,6,"Descripci�n","1",0,"C");
		$this->Cell(25,6,"Monto","1",0,"C");
		$this->Cell(30,6,"Firma Abonado","1",0,"C");
		
		$this->Ln();
		$this->SetFont('times','',10);
		$this->SetX(10);
		$this->Cell(45,6,"Paquete Familiar Bs","1",0,"C");
		$this->Cell(25,6," ","1",0,"C");
		$this->Cell(30,6," ","1",0,"C");
		$this->Cell(40,6,"Paquete Extendido Bs ","1",0,"C");
		$this->Cell(25,6," ","1",0,"C");
		$this->Cell(30,6," ","1",0,"C");
		
		$this->Ln();
		$this->SetFont('times','',10);
		$this->SetX(10);
		$this->Cell(45,6,"Paquete Premium I Bs","1",0,"C");
		$this->Cell(25,6," ","1",0,"C");
		$this->Cell(30,6," ","1",0,"C");
		$this->Cell(40,6,"Paquete Premium I Bs","1",0,"C");
		$this->Cell(25,6," ","1",0,"C");
		$this->Cell(30,6," ","1",0,"C");
		
		$this->Ln();
		$this->SetFont('times','',10);
		$this->SetX(10);
		$this->Cell(45,6,"Paquete Adulto Bs","1",0,"C");
		$this->Cell(25,6," ","1",0,"C");
		$this->Cell(30,6," ","1",0,"C");
		$this->Cell(40,6,"Paquete Comercial I Bs","1",0,"C");
		$this->Cell(25,6," ","1",0,"C");
		$this->Cell(30,6," ","1",0,"C");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(100,6,"Monto de Contrato: Bs. $costo_inst","1",0,"J");		
		$this->Cell(95,6,"Firma del Abonado:_________________________ ","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(100,6,"Puntos Adicionales:_________________________","1",0,"J");		
		$this->Cell(95,6,"Costo Punto Adicional:_______________________","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(65,6,"Tiempo de Instalaci�n:","1",0,"J");
		$this->Cell(65,6,"Total a Cancelar Mensual:","1",0,"J");
		$this->Cell(30,6,"Total:","1",0,"J");
		$this->Cell(35,6,"Contrato:","1",0,"J");
		
		$this->Ln();
		$this->SetFont('times','',11);
		$this->SetX(10);
		$this->Cell(195,6,"Observaciones.","1",0,"J");
						
		
		/*$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(195,6,"$observacion","1",0,"J");*/
		
	/*	$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(98,6,"RECIBO DE PAGO","1",0,"J");
		$this->Cell(97,6,"*EL PRECIO INCLUYE EL IMPUESTO DE LEY","1",0,"J");
		
		
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(35,6,"Efectivo","1",0,"C");
		$this->Cell(35,6,"Cheque","1",0,"C");
		$this->Cell(65,6,"Cargo Cta. Cte.","1",0,"C");
		$this->Cell(60,6,"Tarjeta de Credito:","1",0,"C");
		
	
		$this->Ln();
		$this->SetFont('times','',12);
		$this->SetX(10);
		$this->Cell(35,6,"Bs. $costo_contrato","1",0,"L");
		$this->Cell(35,6,"N�.","1",0,"L");
		$this->Cell(65,6,"Cta. N�               Bco.","1",0,"L");
		$this->Cell(60,6,"Nombre:","1",0,"L");
		
	
		
		
		$this->Ln(15);
		
		$this->SetFont('times','',9);
		$this->SetX(10);
		$this->Cell(13,5,"Nota:","0",0,"L");
		$this->MultiCell(164,5,"En caso de que el televisor no acepte la se�al de todos los canales del cable, es posible que amerite la instalaci�n de un amplificador de sintonia, el cual deber� ser adquirido por el SUSCRIPTOR","0","J");
		
		$this->SetFont('times','',9);
		$this->SetX(10);
		$this->Cell(13,5,"Atenci�n: ","0",0,"L");
		$this->MultiCell(164,5,"La Empresa. No autoriza el retiro de televisores y/o VHS por el personal de la empresa. El SUSCRIPTOR conoce y acepta las condiciones del contrato del servicio que apacen al dorso del presente","0","J");
		
		$this->SetFont('times','',9);
		$this->SetX(10);
		$this->Cell(13,5,"Aviso: ","0",0,"L");
		$this->MultiCell(164,5,"Se le informa a todos los suscriptores y publico en general de acuerdo a la Ley Org�nica de Telecomunicaciones, en el Art�culo 189, Literal 2: ser� penado con prisi�n de uno (1) a cuatro (4) a�os, el que utilizando equipos o tecnolog�as de cualquier tipo, proporciones a un tercero el acceso o disfrute en forma fraudulenta o indebida de un serbicio o facilidad de telecomunicaciones ","0","J");
		
		
		
		$this->Ln(10);
		$this->SetFont('times','',10);
		$this->SetX(10);
		$this->Cell(65,5,"________________________","0",0,"C");
		$this->Cell(65,5,"_________________________________","0",0,"C");
		$this->Cell(65,5,"__________________________","0",0,"C");
		
		$this->Ln();
		
		$this->SetX(10);
		$this->Cell(65,6,"Firma del Vendedor","0",0,"C");
		$this->Cell(65,6,"Nombre y Apellido del Suscriptor","0",0,"C");
		$this->Cell(65,6,"Firma del Suscriptor","0",0,"C");*/
		
		/*$this->Ln(4);
		
		$this->SetDrawColor(76,136,206);
		$this->SetLineWidth(.4);
		$this->SetFont('times','I',12);
		$this->SetX(10);
		$this->MultiCell(195,5,'Av. Perimetral, Centro Comercial Residencial Central. P.B. Local N� 07. C�a, Edo. Miranda.
cuatv@hotmail.com / cuatv@cantv.net',"TB","C");*/
		
		//$this->clausulas();
		
		return $cad;
	}
/*	function clausulas(){
		$this->AddPage('P','letter');
		$this->SetXY(10,10);
		$this->SetFont('arial','',8);
		$this->MultiCell(195,3,strtoupper('1.- DERECHO AL SERVICIO:
La suscripci�n de este servicio de televisi�n por cable da derecho al usuario a una (1) instalaci�n principal pudiendo solicitar la instalaci�n de puntos adicionales a un costo por c/u. siempre i cuando sea para el mismo usuario bajo el mismo techo, en la direcci�n en que aparezca el contrato.
El usuario no podr� ser uso indebido de este servicio, instalado puntos adicionales propios o terceros, su pena de perder el derecho al servicio sin retribuci�n algunas y todas aquellas sanciones establecidas de acuerdo a la ley vigente del ministerio de transporte, comunicaci�n y televisi�n por cable.

2.-valor del servicio mensual.
El valor del servicio mensual para la programaci�n de canales de televisi�n por cable nacionales e internacionales es de bol�vares_____________________________________(Bs_______) pagaderos en los primeros d�as despu�s de vencida su fecha de se�al. El valor del servicio b�sico mensual puede sufrir cambios sin previo aviso, de acuerdo a la tasa de inflaci�n vigente y otras variables que est�n en el mercado, sin embargo, es de inter�s de la empresa mantener sus tarifas lo mas econ�micas y estables que les sea posible.

3.-canales adicionales:
El servicio de canales adicionales a los (25) ofrecidos. Seg�n se valla incorporando al sistema ser� con un costo adicional establecido para ese momento.

4.-garantia de servicio:
El servicio de canales de programaci�n nacional e internacional: las 24 horas del d�a en forma ininterrumpida, salvo por razones de fuerza mayor no imputable.
Cuando el servicio sea  suspendido por un lapso mayor de sesenta y dos(72) horas despu�s de haber reportado la aver�a el usuario, la empresa de servicio (cua tv. c.a.) descontara de su factura mensual el tiempo muerto correspondiente, si la aver�a afectara m�s de seis (6) canales de sus programaci�n .
Para hacer cualquier reclamo, el usuario debe de estar al dia con sus obligaciones.

5.- reconexiones  y traslados:
Todo trabajo de reconexion o traslado de servicios �l tiene un costo adicional para cubrir gastos de material y mano de obra el tiempo establecido para efectuar los trabajos de reconexion es de setenta y dos (72) horas y siete (7) d�as h�biles para traslados en sectores donde exista redes de se�al.

6.- instalaciones
Las instalaciones se realizan por orden de suscripci�n de acuerdo a la programaci�n que elabore el departamento de la empresa de servicio.7.-traspaso.
En caso de reubicaci�n el usuario podr� hacer traspaso del servicio de televisi�n por cable a otra persona de manera personal, no a trav�s de la empresa, se requer�a luego que el usuario notifique en la oficina y autorice dicho traspaso, debiendo estar al d�a  con sus obligaciones.

8.-pagos y cobranzas.
El usuario debe efectuar su pago de servicio mensual por adelanto y dentro de los primeros_________ d�as de vencimiento de su fecha de se�al. En las oficinas de cua tv, c.a. y/o bancos autorizados para tal efecto. Cuando los pagos sean realizados a trav�s de las entidades bancarias autorizadas, los dep�sitos deber�an ser notificados a la empresa a trav�s de los dichos abonos deber�an realizarse �nicamente en efectivo.

9.- programaci�n:
La programaci�n podr�a cambiar sin previo aviso en los siguientes casos:
A)	Si las se�ales de los sat�lites sufren cambios.
B)	Cuando la empresa que origina la se�al haga cambios en la programaci�n.
C)	Cundo la empresa que mande la imagen cambie su codificaci�n.

10.-inspecciones:
El usuario se compromete a facilitar la entrada a su domicilio al personal t�cnico de la empresa, este deber� estar debidamente identificado con su carnet, a fin de realizar inspecciones  y/o reparaciones, cuando las circunstancias lo requieran.

11.-reclamos:
Todo reclamo deber� ser efectuado a trav�s de las oficinas de la empresa.
La empresa est� en la obligaci�n de suministrar al usuario el numero de su reclamo e incluir en el mismo el nombre de la persona que lo atendi�.

12.-da�os ocasionados por el usuario:
Cuando la falla del servicio sea ocasionada por el usuario, ya sea por remodelaci�n de la vivienda o modificaciones de la red sin previo aviso, el usuario deber� pagar el costo de la reparaci�n. La empresa de servicio tampoco se hace responsable por fallas de receptor de televisi�n, ya que solo garantiza la se�al y no el televisor.

13.- pago de contrato:
Todo aquel suscriptor que realice contrato con cualquiera de los dos planes de cr�dito estipulado por la empresa, que tengan vencido m�s de treinta (30) d�as, cua tv c.a. se reserva el derecho de cancelar el contrato y se le reembolsa solamente el 10% de su inicial.

14.-materiales:
Todo material utilizado en instalaciones a suscriptores es y ser� propiedad de cua tv c.a. se suministrara para la instalaci�n 25 metros de cable. Todo metro adicional se cancelara a raz�n de bs (                                  )

15.-condiciones no previstas:
Cualquier otra condici�n prevista en este contrato, ser� regida por el c�digo de comercio vigente y por las normas establecidas en la ley de telecomunicaciones y de televisi�n por cable.
'),"0","J");


		$this->Ln(14);
		$this->SetFont('times','',10);
		$this->SetX(10);
		$this->Cell(65,5,"________________________","0",0,"C");
		$this->Cell(65,5,"_________________________________","0",0,"C");
		$this->Cell(65,5,"__________________________","0",0,"C");
		
		$this->Ln();
		
		$this->SetX(10);
		$this->Cell(65,6,"CUA TV","0",0,"C");
		$this->Cell(65,6,"EL VENDEDOR","0",0,"C");
		$this->Cell(65,6,"EL USUARIO","0",0,"C");
		
		$this->Ln(15);
	}*/
	
}
//crea el objeto pdf
$pdf=new PDF();    
      
$pdf->SetDisplayMode("real");
//salto de p�gina autom�tico desde la parte inferior de la p�gina 
$pdf->SetAutoPageBreak(true,5);
//agrega una nueva pagina
$pdf->AddPage('P','legal');
//$pdf->Fecha();

$pdf->Cuerpo($acceso,$id_contrato);
//dl_file($cad);


//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');

?> 