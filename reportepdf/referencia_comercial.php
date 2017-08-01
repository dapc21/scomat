<?php
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_contrato=$_GET['id_contrato'];
$titulo=$_GET['titulo'];
class PDF extends FPDF
{
	
	
	
	function estado_cuenta_con($acceso,$id_contrato,$titulo,$sety)
	{
		$logo=logo();
		$ancho_logo=ancho_logo();
		$direc_fiscal=direc_fiscal();
		$telef_emp=telef_emp();
		$rif=tipo_serv();
		
		$this->Image("../imagenes/$logo",20,$sety-3,$ancho_logo);
		$this->SetFont('Times','B',10);
		$this->SetXY(60,$sety);
		$this->MultiCell(120,5,strtoupper(nombre_empresa()),'0','l');
		$this->SetFont('Times','B',10);
		$this->SetXY(60,$sety+5);
		//$this->MultiCell(70,5,strtoupper("RIF ".tipo_serv()),'0','l');
		$this->Ln(1);
		$this->SetX(60);
		$this->SetFont('Arial','',9);
		$this->MultiCell(150,3,"RIF: $rif $telef_emp ",'0','L');

		$this->Ln(25);		
		
		$this->SetFont('Times','B',20);
		$this->SetX(10);
		$this->MultiCell(190,5,strtoupper(_('A QUIEN PUEDA INTERESAR')),'0','C');
		
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_contrato_auditoria where id_contrato='$id_contrato'");
		
		
		if($row=row($acceso))
		{
			$nro_contrato=trim($row["nro_contrato"]);
			$cedula=trim($row["cedula"]);
			$nombre=utf8_d(trim($row["nombre"]))." ".utf8_d(trim($row["apellido"]));
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
			
			
		}
		
		session_start();
		$login=$_SESSION["login"];
		
		$acceso->objeto->ejecutarSql("SELECT *FROM personausuario where login='$login'");
		
		
		if($row=row($acceso))
		{
			$cedula_ope=trim($row["cedula"]);
			$nombre_ope=utf8_d(trim($row["nombre"]))." ". utf8_d(trim($row["apellido"]));
		}	
		$fecha=date("Y-m-d");
		list($ano,$mes,$dia)=explode("-",$fecha);
		$mes_letra = formato_mes_com1($mes);
		$this->SetFont('Times','',12);
		$this->Ln(20);		
		$this->SetX(20);
		
		$this->MultiCell(170,8,utf8_decode("         Quien Suscribe,  $nombre_ope Portador de la Cédula de Identidad V-$cedula_ope , en mi caracter de OPERADORA DE SISTEMA , hago constar que el(la) Ciudadano(a) $nombre portador de la Cédula de Identidad V-$cedula ,  es cliente de esta empresa desde el $fecha_contrato y hasta la fecha se ha mantenido solvente.
		
		
		
         Constancia que se expide a los $dia días del mes de $mes_letra de $ano."),'0','J');	


		$this->SetFont('Times','',12);
		$this->Ln(30);		
		$this->SetX(70);
		
		$this->MultiCell(90,5,utf8_decode("_____________________________________
$nombre_ope
                                V-$cedula_ope
OPERADORA DE SISTEMA
                                0281-2684685"),'0','L');	
		 
	}
	
	
}
//crea el objeto pdf
$pdf=new PDF();              
//salto de página automático desde la parte inferior de la página 
$pdf->SetAutoPageBreak(true,25);
//agrega una nueva pagina
$pdf->AddPage();

$pdf->estado_cuenta_con($acceso,$id_contrato,$titulo,25);

//imprime el reporte en formato PDF
$pdf->Output('reporte.pdf','D');
?> 