<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_contrato=$_GET['id_contrato'];
class PDF extends FPDF
{
	
	
	function estado_cuenta_con($acceso,$id_contrato,$titulo,$sety)
	{
		$logo=logo();
		$ancho_logo=ancho_logo();
		$direc_fiscal=direc_fiscal();
		$telef_emp=telef_emp();
		
		$this->Image("../imagenes/$logo",10,$sety-3,$ancho_logo);
		$this->SetFont('Times','B',12);
		$this->SetXY(50,$sety);
		$this->MultiCell(80,5,strtoupper(nombre_empresa()),'0','l');
		$this->SetFont('Times','B',11);
		$this->SetXY(50,$sety+5);
		$this->MultiCell(70,5,strtoupper("RIF: ".tipo_serv()),'0','l');
		$this->Ln(1);
		$this->SetX(50);
		$this->SetFont('Arial','',9);
		$this->MultiCell(150,3,"$telef_emp ",'0','L');

		$this->Ln(2);	
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		$this->Cell(12,5,strtoupper(_('fecha')).": ",0,0,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(18,5,date("d/m/Y"),0,0,'L');
		$this->SetFont('Arial','B',9);
		$this->Cell(12,5,strtoupper(_('hora')).": ",0,0,'L');
		$this->SetFont('Arial','',9);
		$this->Cell(18,5,date("h:i:s A"),0,0,'L');
		$this->Ln();		
		
		
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_contrato_auditoria where id_contrato='$id_contrato'");
		
		
		if($row=row($acceso))
		{
			$nro_contrato=trim($row["nro_contrato"]);
			$cedula=trim($row["cedula"]);
			$nombre=utf8_d(trim($row["nombre"]));
			$apellido=utf8_d(trim($row["apellido"]));
			$telefono=trim($row["telefono"]);
			$telf_casa=trim($row["telf_casa"]);
			$email=trim($row["email"]);
			$direc_adicional=utf8_d(trim($row["direc_adicional"]));
			$numero_casa=trim($row["numero_casa"]);
			$nombre_calle=utf8_d(trim($row["nombre_calle"]));
			$nombre_sector=utf8_d(trim($row["nombre_sector"]));
			
			$nombre_franq=utf8_d(trim($row["nombre_franq"]));
			$edificio=utf8_d(trim($row["edificio"]));
			$numero_piso=trim($row["numero_piso"]);
			$telf_adic=trim($row["telf_adic"]);
			$telefono ="$telefono / $telf_casa / $telf_adic"; 
			$fecha_contrato=formatofecha(trim($row["fecha_contrato"]));
			$status_contrato=trim($row["status_contrato"]);
			$status_contrato=trim($row["status_contrato"]);
			$etiqueta=utf8_d(trim($row["etiqueta"]));
		
			$nombre_zona=utf8_d(trim($row["nombre_zona"]));
			$nombre_mun=utf8_d(trim($row["nombre_mun"]));
			$nombre_sector=utf8_decode(trim($row["nombre_sector"]));
			$edificio=utf8_decode(trim($row["edificio"]));
			$numero_piso=utf8_decode(trim($row["numero_piso"]));
			$urbanizacion=utf8_decode(trim($row["urbanizacion"]));
			$nombre_calle=utf8_decode(trim($row["nombre_calle"]));
			$urbanizacion=utf8_decode(trim($row["urbanizacion"]));
			$direc_adicional=utf8_decode(trim($row["direc_adicional"]));
			
			
			if($edificio!=''){
				$edificio=",  Edif: $edificio, piso: $numero_piso ";
			}
			if($urbanizacion!=''){
				$urbanizacion=", Urb: $urbanizacion ";
			}
			$dir ="$nombre_mun, $nombre_zona, $nombre_sector, $urbanizacion,  $nombre_calle $edificio,  $numero_casa ; REF. $direc_adicional";
			
			
			$this->SetXY(125,$sety-4);
			$this->SetFont('Arial','B',10);
			$this->Cell(75,5,strtoupper(_("suscriptor")),"1",0,"C");
			
			$this->Ln();
			$this->SetX(125);
			$this->SetFont('Arial','B',9);
			$this->Cell(30,6,strtoupper(_("contrato nro")).": ","0",0,"J");
			$this->SetFont('Arial','',9);
			$this->Cell(75,6,$nro_contrato  ."         ".$status_contrato ,"0",0,"J");
	
			$this->Ln();
			$this->SetX(125);
			$this->SetFont('Arial','B',9);
			$this->Cell(75,6,$apellido."   ". $nombre,"0",0,"J");
			
			$this->Ln();
			$this->SetX(125);
			$this->SetFont('Arial','B',9);
			$this->Cell(17,6,strtoupper(_("ci/r.i.f.")).": ","0",0,"J");
			$this->SetFont('Arial','',9);
			$this->Cell(45,6,$cedula ,"0",0,"J");
			//celda
			$this->SetXY(125,$sety+1);
			$this->Cell(75,18,"","1",0,"J");
			
			$this->Ln(20);
			
			
			
			$this->SetX(10);
			$this->SetFont('Arial','B',10);
			$this->Cell(23,6,strtoupper(_("Direccion")).": ","0",0,"J");
			$this->SetFont('Arial','',10);
			$this->MultiCell(170,5,$dir ,"0","J");
		}
		
			
			$this->Ln(2);
			$this->SetX(10);
			$this->SetFont('Times','B',12);
			$this->Cell(70,6,strtoupper(_($titulo)),"1",0,"C");
		
			$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as deuda FROM contrato_servicio_deuda where id_contrato='$id_contrato'  AND costo_cobro>0");
			$row=row($acceso);
			$deuda=trim($row["deuda"]);
		
		$this->SetFont('Times','B',12);
		$this->Cell(50,6,"","0",0,"R",$fill);
		$this->Cell(70,6,strtoupper(_('monto pendiente')).": ".number_format($deuda+0, 2, ',', '.'),"1",0,"C",$fill);
		
		
		$this->Ln(7);
		
		$this->SetFillColor(244,249,255);
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(171,171,171);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(15,30,65,40,40);
		$header=array(strtoupper(_('nro')), strtoupper(_('aviso nro')),strtoupper(_('servicio')),strtoupper(_('periodo')),strtoupper(_('monto bs.f')));
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		for($k=0;$k<count($header);$k++)
			$this->Cell($w[$k],7,$header[$k],1,0,'J',1);
		$this->Ln();
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_contratodeu where id_contrato='$id_contrato'  AND costo_cobro>0 order by fecha_inst asc");
		
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		$suma=0.00;
		while ($row=row($acceso))
		{
			$tipo_costo=trim($row["tipo_costo"]);
			$total=0.00;
			$cant=trim($row["cant_serv"]);
			$tar=trim($row["costo_cobro"]);
			$total=($cant*$tar);
			$suma=$suma+$total;
			$fecha_inst=trim($row["fecha_inst"]);
			
							$fec = explode ("-",$fecha_inst);
							$me=$fec[1];
							$anio=$fec[0];
							$mes=array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
							$f_mes=$mes[$me];
							if($tipo_costo=="COSTO MENSUAL"){
								$fecha=strtoupper("$f_mes $anio");
							}
							else{
								$fecha = date("d/m/Y", strtotime($value));
							}
			
			$fill=0;
			$this->SetX(10);
			$this->Cell($w[0],5,$cont,"L",0,"J",$fill);
			$this->Cell($w[1],5,utf8_d(trim($row["id_cont_serv"])),"0",0,"J",$fill);
			$this->Cell($w[2],5,utf8_d(trim($row["nombre_servicio"])),"0",0,"J",$fill);
			$this->Cell($w[3],5,$fecha,"0",0,"J",$fill);
			$this->Cell($w[4]-15,5,number_format(utf8_d(trim($row["costo_cobro"]))+0, 2, ',', '.'),"0",0,"R",$fill);
			$this->Cell(15,5,'',"R",0,"R",$fill);
			


			$this->Ln();
			//$fill=!$fill;
			$cont++;
		}
		
		$this->SetX(10);
		$this->Cell(array_sum($w),5,'','T');
		
			$this->Ln();	
			
			$acceso->objeto->ejecutarSql("SELECT fecha_pago,fecha_inst,monto_pago, nro_factura  FROM vista_pago_ser where  id_contrato='$id_contrato'  order BY fecha_inst desc LIMIT 1");
				$row=row($acceso);
					$fecha_pago=formatofecha(trim($row["fecha_pago"]));
					$fecha_inst=trim($row["fecha_inst"]);
					list($ano,$mes,$dia)=explode("-",$fecha_inst);
					$periodo = formato_mes_com1($mes)." $ano";
					$nro_factura=trim($row["nro_factura"]);
					$monto_pago=trim($row["monto_pago"])+0;
					$monto_pago=number_format(trim($row["monto_pago"])+0, 2, ',', '.');
					$this->SetFont('Arial','B',9);
					$this->Cell(30,5,"ULTIMO PAGO","LBT",0,"J",$fill);
					$this->Cell(15,5,"FECHA: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(20,5,"$fecha_pago","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(18,5,"FACTURA: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(20,5,"$nro_factura","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(17,5,"PERIODO: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(30,5,"$periodo","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(20,5,"PAGADO: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(20,5,"$monto_pago","TBR",0,"J",$fill);
					
			$this->Ln();
			 $meses=lectura($acceso,"SELECT distinct fecha_inst  FROM contrato_servicio_deuda where   id_contrato='$id_contrato'  and status_con_ser='DEUDA' AND costo_cobro>0 order by fecha_inst");
			 $dato1=array();
			 $ind=0;
			 
			 for($k=0;$k<count($meses);$k++){
				$fecha_inst=trim($meses[$k]["fecha_inst"]);
				list($ano,$mes,$dia)=explode("-",$fecha_inst);
				$fecha1="$ano-$mes";
				//echo $fecha1;
				if(!in_array($fecha1,$dato1)){
					$dato1[$ind]=$fecha1;
					$ind++;
				}
			 }
			$meses_vencido=count($dato1);
			 $this->SetFont('Arial','B',9);
					$this->Cell(40,5,"MESES VENCIDOS","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(25,5,"$meses_vencido","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(20,5,"ETIQUETA: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(18,5,"$etiqueta","TBR",0,"J",$fill);
					
					$this->SetFont('Arial','B',9);
					$this->Cell(20,5,"TELEFONO: ","LBT",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(67,5,"$telefono","TBR",0,"J",$fill);
		
				
					
	}
	
	function datos_banco(){
		
					$this->Ln(10);
					$this->SetFont('Arial','B',9);
					$this->Cell(190,5,"CUENTAS CORRIENTES PARA DEPOSITOS Y TRANSFERENCIAS","LRT",0,"C",$fill);
					$this->Ln();
					$this->SetFont('Arial','',9);
					$this->Cell(190,5,"A NOMBRE DE CORPORACION VISUAL NUEVA ESPARTA C.A.  RIF. J-30760751-3","LRB",0,"C",$fill);
					$this->Ln();
					$this->SetFont('Arial','',9);
					$this->Cell(65,5,"BANCO PROVINCIAL","LRT",0,"C",$fill);
					$this->Cell(65,5,"BANCO DE VENEZUELA","LRT",0,"C",$fill);
					$this->Cell(60,5,"BANCO BANESCO","LRT",0,"C",$fill);
					$this->Ln();
					$this->Cell(65,5,"0108-0046-37-0100159083","LRB",0,"C",$fill);
					$this->Cell(65,5,"0102-0668-52-0000016492","LRB",0,"C",$fill);
					$this->Cell(60,5,"0134-0018-17-0181077477","LRB",0,"C",$fill);
					$this->Ln();
					$this->SetFont('Arial','',9);
					$this->Cell(90,5,"Nº DE FAX:  0295-2424290  /  0295-2421916","1",0,"J",$fill);
					$this->SetFont('Arial','',9);
					$this->Cell(100,5,"Correo Electronico: unicable.reclamosycortes@hotmail.com","1",0,"J",$fill);
	}
	
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage();

$pdf->estado_cuenta_con($acceso,$id_contrato,"ESTADO DE CUENTA",6);
//$pdf->datos_banco();	
	
//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 