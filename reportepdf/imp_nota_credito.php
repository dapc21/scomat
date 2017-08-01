<?php
session_start();
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_nota=$_GET['id_nota'];
//$titulo=$_GET['titulo'];
class PDF extends FPDF
{
	
	
	
	function estado_cuenta_con($acceso,$id_nota,$titul,$sety)
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
		$this->MultiCell(70,5,strtoupper("RIF ".tipo_serv()),'0','l');
		$this->Ln(1);
		$this->SetX(10);
		$this->SetFont('Arial','',9);
		$this->MultiCell(150,3,"$direc_fiscal  $telef_emp",'0','L');

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
			//$login= $_SESSION["login"];
			
		$acceso->objeto->ejecutarSql("SELECT *FROM notas,motivonotas where notas.idmotivonota=motivonotas.idmotivonota and  id_nota='$id_nota'");
		
		
		if($row=row($acceso))
		{
			$id_contrato=trim($row["id_contrato"]);
			$id_cont_serv=trim($row["id_cont_serv"]);
			$titulo=trim($row["tipo"]);
			$fecha=formatofecha(trim($row["fecha"]));
			$monto_anterior=trim($row["monto_anterior"]);
			$monto_posterior=trim($row["monto_posterior"]);
			$nombremotivonota=trim($row["nombremotivonota"]);
			$monto_nota=trim($row["monto_nota"]);
			$comentario=trim($row["comentario"]);
			$nro_nota=trim($row["nro_nota"]);
			$login=trim($row["login"]);
			$login_aut=trim($row["login_aut"]);
		}
		$acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM personausuario where login='$login'  LIMIT 1 offset 0 ");
			if($row=row($acceso)){
				$atendido_por=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
			
			}
			
		$acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM personausuario where login='$login_aut'  LIMIT 1 offset 0 ");
			if($row=row($acceso)){
				$autorizado_por=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
			
			}
			
			$acceso->objeto->ejecutarSql("SELECT fecha_inst,tipo_costo,nombre_servicio FROM contrato_servicio_deuda,servicios where contrato_servicio_deuda.id_serv=servicios.id_serv and  id_cont_serv='$id_cont_serv'");
		if($row=row($acceso)){
			$fecha_inst=trim($row["fecha_inst"]);
			$tipo_costo=trim($row["tipo_costo"]);
			$nombre_servicio=trim($row["nombre_servicio"]);
			if($tipo_costo=="COSTO MENSUAL"){
							$fec = explode ("-",$fecha_inst);
							$me=$fec[1];
							$anio=$fec[0];
							$mes=array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
							$f_mes=$mes[$me];
							$descripcion=strtoupper("facturacion mes $f_mes $anio");
			}
			else{
				$descripcion=$nombre_servicio;
			}
		}
		
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
			$dir ="$nombre_mun, $nombre_sector, $urbanizacion,  $nombre_calle $edificio,  $numero_casa ; REF. $direc_adicional";
			
			
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
		$this->Cell(70,6,strtoupper(_('Numero')).": $nro_nota","1",0,"C",$fill);
		
		
		
		$this->Ln(12);	
			$this->SetX(10);
			$this->SetFont('Arial','B',9);
			$this->Cell(30,4,"MOTIVO:",0,0,"L");
			$this->SetFont('Arial','',9);
			$this->Cell(40,4,"$nombremotivonota",0,0,"L");
		$this->Ln(6);	
			$this->SetX(10);
			$this->SetFont('Arial','B',9);
			$this->Cell(30,4,"COMENTARIO:",0,0,"L");
			$this->SetFont('Arial','',9);
			$this->MuLtiCell(160,4,utf8_decode($comentario),0,"J");
			
			
		$this->Ln(7);
		
		$this->SetFillColor(244,249,255);
		$this->SetFillColor(249,249,249);
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(.2);
		//dimenciones de cada campo
		$w=array(35,120,35);
		$header=array(strtoupper(_('fecha')), strtoupper(_('Descripcion')),strtoupper(_('importe')));
		$this->SetFont('Arial','B',9);
		$this->SetX(10);
		$this->Cell($w[0],7,$header[0],1,0,'J',1);
		$this->Cell($w[1],7,$header[1],1,0,'J',1);
		$this->Cell($w[2],7,$header[2],1,0,'R',1);
		$this->Ln();
		$monto_nota=number_format($monto_nota+0, 2, ',', '.');
		$this->SetFont('Arial','',9);
		$cont=1;
		$this->SetFillColor(249,249,249);
		$this->SetTextColor(0);
		$suma=0.00;
			$fill=0;
			$this->SetX(10);
			$this->Cell($w[0],5,$fecha,"L",0,"J",$fill);
			$this->Cell($w[1],5,$descripcion,"0",0,"J",$fill);
			$this->Cell($w[2],5,$monto_nota."   ","R",0,"R",$fill);
			
			$this->Ln();
			//$fill=!$fill;
			$cont++;
		
		
		$this->SetX(10);
		$this->Cell(array_sum($w),120,'','LRB');
		$this->SetFont('Arial','B',9);
			$this->Ln();	
			$this->SetX(10);
			$this->Cell($w[0]+$w[1],7,"TOTAL $titulo","LB",0,"J",$fill);
			$this->Cell($w[2],7,$monto_nota."   ","RB",0,"R",$fill);
			
			$this->SetLineWidth(.4);
			$this->SetDrawColor(0,0,0);
		$this->Ln(15);	
			$this->SetX(30);
			$this->Cell(40,5,"","B",0,"C");
			$this->Cell(70,5,"","0",0,"C");
			$this->Cell(40,5,"","B",0,"C");
		
		$this->SetFont('Arial','B',9);
		$this->Ln(5);	
			$this->SetX(30);
			$this->Cell(40,5,"Procesada Por","0",0,"C");
			$this->Cell(70,5,"","0",0,"C");
			$this->Cell(40,5,"Aprobada Por","0",0,"C");
		
		$this->SetFont('Arial','',9);
		$this->Ln(5);	
			$this->SetX(30);
			$this->Cell(40,4,"$atendido_por","0",0,"C");
			$this->Cell(70,5,"","0",0,"C");
			$this->Cell(40,5,"$autorizado_por","0",0,"C");
			
			
				
					
	}
	
	
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage();

$pdf->estado_cuenta_con($acceso,$id_nota,$titulo,6);

//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 