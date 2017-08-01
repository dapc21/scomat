<?php
	session_start();
require('../include/FPDF/fpdf.php');
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 

$id_orden=trim($_GET['id_orden']);
$id_gt=trim($_GET['id_gt']);
class PDF extends FPDF
{
	//Titulo del reporte
	function Titulo($titulo,$id_orden,$y)
	{
		$sety=$y;
                
                $this->SetFont('Times','B',12);
                $this->SetXY(5,$sety);
                $this->MultiCell(80,5,strtoupper(nombre_empresa()),'0','l');
                $this->SetFont('Times','B',11);
                $this->SetXY(150,$sety);
                $this->MultiCell(60,5,strtoupper("RIF ".tipo_serv()),'0','R');
		
				$this->SetTextColor(0,0,0);
                $this->SetXY(5,5+$y);
                $this->SetFont('Arial','B',14);
                $this->MultiCell(205,6,"ORDEN # $id_orden      $titulo ",'0','C');
	}
	//Titulo del reporte
	
	//muestra el listado de los reportes 
	function orden($acceso,$id_orden,$id_gt){
		$valor=explode("=@",$id_orden);
		$tam=count($valor)-1;
		//echo ":$tam:";
		$cad='';
					require_once "../Clases/trans_pago.php";
					$obj_trans=new trans_pago();
					$obj_trans->begin($acceso);	
			
		for($i=0;$i<$tam;$i++){
			
			
			$id_orden=$valor[$i];
			require_once "../Clases/orden_grupo.php";
			$obj=new orden_grupo($id_orden,$id_gt,"f");
			$obj->modif_orden_grupo_aut($acceso);
			$fecha_imp=date("Y-m-d");
			$login= $_SESSION["login"];
			$hora=date("H:i:s");
			$acceso->objeto->ejecutarSql("Update ordenes_tecnicos Set status_orden='IMPRESO',fecha_imp='$fecha_imp',login_imp='$login', hora_imp='$hora' Where id_orden='$id_orden'");
			
			//$this->Titulo($titulo,$id_orden);
			//echo "<br>:".$i%2;
			if($i%2==0){
				$this->AddPage('P','letter');
				$x=5;
			}else{
				$x=145;
			}
			$this->Cuerpo($acceso,$valor[$i],$x);
		//	$this->materiales($acceso,$id_orden);
			$this->mas_datos($acceso,$id_orden);
		}
		$obj_trans->commit($acceso);	
	}
	
function Cuerpo($acceso,$id_orden,$x)
        {
			
                $acceso->objeto->ejecutarSql("SELECT *FROM vista_orden where id_orden='$id_orden'  LIMIT 1 offset 0");
                if($row=row($acceso)){
                        $id_tipo_orden=utf8_decode(trim($row['id_tipo_orden']));
                        $nombre_tipo_orden=utf8_decode(trim($row['nombre_tipo_orden']));
                        $nombre_det_orden=utf8_decode(trim($row['nombre_det_orden']));
                        $detalle_orden=utf8_decode(trim($row['detalle_orden']));
                        $comentario_orden=utf8_decode(trim($row['comentario_orden']));
                        
                        $this->Titulo($nombre_det_orden,$id_orden,$x);
                        $fecha_orden=formatofecha(trim($row['fecha_orden']));
                        $fecha_imp=formatofecha(trim($row['fecha_imp']));
                        $login=trim($row['login_emi']);
                        $login_imp=trim($row['login_imp']);
                        $hora_emi=trim($row['hora_emi']);
                        $hora_imp=trim($row['hora_imp']);
                        
                        //$nombre_tec=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
                        
                        $nombre_tipo_orden=utf8_decode(trim($row['nombre_tipo_orden']));
                        $nombrecli=utf8_decode(trim($row['nombrecli'])." ".trim($row['apellidocli']));
                        $etiqueta=utf8_decode(trim($row['etiqueta']));
                        $cedulacli=utf8_decode(trim($row['cedulacli']));
                        
                        $nro_contrato=trim($row['nro_contrato']);
                        $id_contrato=trim($row['id_contrato']);
                
                }
                
                $acceso->objeto->ejecutarSql("SELECT contrato_fisico,taps,pto,telefono,postel,telf_casa,telf_adic,id_persona,cod_id_persona FROM vista_contrato_auditoria where id_contrato='$id_contrato'  LIMIT 1 offset 0 ");
                
                if($row=row($acceso)){
                        $postel=utf8_decode(trim($row['postel']));
                        $telefono=utf8_decode(trim($row['telefono']));
                        $telf_casa=utf8_decode(trim($row['telf_casa']));
                        $telf_adic=utf8_decode(trim($row['telf_adic']));
                        $id_persona=utf8_decode(trim($row['id_persona']));
                        $cod_id_persona=utf8_decode(trim($row['cod_id_persona']));
                        $taps=utf8_decode(trim($row['taps']));
                        $pto=utf8_decode(trim($row['pto']));
                        $contrato_fisico=utf8_decode(trim($row['contrato_fisico']));
                }
                
                
                
                        $acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM vista_cobrador where id_persona='$cod_id_persona'  LIMIT 1 offset 0 ");
                        if($row=row($acceso)){
                                $cobrador=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
                        
                        }
                        //echo "SELECT nombre,apellido FROM vista_vendedor where id_persona='$id_persona'  LIMIT 1 offset 0 ";
                        $acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM vista_vendedor where id_persona='$id_persona'  LIMIT 1 offset 0 ");
                        if($row=row($acceso)){
                                $vendedor=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
                        
                        }
                
                $acceso->objeto->ejecutarSql("SELECT numero_casa,direc_adicional,numero_piso,urbanizacion,etiqueta,status_contrato FROM vista_contrato_auditoria where id_contrato='$id_contrato'  LIMIT 1 offset 0 ");

                if($row=row($acceso)){
                        
                        $numero_casa=utf8_decode(trim($row['numero_casa']));
                        
                        $direc_adicional=utf8_decode(trim($row['direc_adicional']));
                        $urbanizacion=utf8_decode(trim($row['urbanizacion']));
                        $numero_piso=utf8_decode(trim($row['numero_piso']));
                        $edificio=utf8_decode(trim($row['edificio']));
                        $etiqueta=utf8_decode(trim($row['etiqueta']));
                        $status_contrato=utf8_decode(trim($row['status_contrato']));
                }
                
                $acceso->objeto->ejecutarSql("select sum(costo_cobro) as deuda from vista_contrato_servicio_deuda where id_contrato='$id_contrato'");
                
                if($row=row($acceso)){
                        $deuda=utf8_decode(trim($row['deuda']))+0;
                        
                        $deuda=number_format($deuda+0, 2, ',', '.');
                        
                }
                
                
                if($edificio!=''){
                        $edificio=",  Edif: $edificio, piso: $numero_piso ";
                }
                if($urbanizacion!=''){
                        $urbanizacion=", Urb: $urbanizacion ";
                }
                
                
                
                        $acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM personausuario where login='$login'  LIMIT 1 offset 0 ");
                        if($row=row($acceso)){
                                $atendido_por=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
                        
                        }
                
                        $acceso->objeto->ejecutarSql("SELECT nombre,apellido FROM personausuario where login='$login_imp'  LIMIT 1 offset 0 ");
                        if($row=row($acceso)){
                                $impreso_por=utf8_decode(trim($row['nombre'])." ".trim($row['apellido']));
                        
                        }
                
                
                
                $acceso->objeto->ejecutarSql("SELECT nombre_mun,nombre_zona,nombre_sector,nombre_calle
                FROM vista_contrato_dir where id_contrato='$id_contrato'  LIMIT 1 offset 0 ");
                
                if($row=row($acceso)){
                        
                        $nombre_mun=utf8_decode(trim($row['nombre_mun']));
                        $nombre_zona=utf8_decode(trim($row['nombre_zona']));
                        $nombre_sector=utf8_decode(trim($row['nombre_sector']));
                        $nombre_calle=utf8_decode(trim($row['nombre_calle']));
                }
                
                $fecha=date("d/m/Y");
                $x_izq=10;
                $x_medio=70;
                $x_medio1=120;
                $x_der=170;
                
                $this->Ln(10);
                $x=$x-5;
                $this->SetFont('Arial','B',9);
                $this->SetXY($x_izq,19 + $x);
                $this->Cell(25,6,strtoupper(_('contrato')).": ","1",0,"C");
                $this->SetXY($x_izq,25 + $x);
                $this->SetFont('Arial','',9);
                $this->Cell(25,6,$nro_contrato,"1",0,"C"); 
                
                $this->SetXY($x_izq+25,19 + $x);
                $this->SetFont('Arial','B',9);
                $this->Cell(25,6,strtoupper(_('poste')).": ","1",0,"C");
                $this->SetXY($x_izq+25,25 + $x);
                $this->SetFont('Arial','',9);
                $this->Cell(25,6,$postel,"1",0,"C");
                
                $this->SetXY($x_izq+50,19 + $x);
                $this->SetFont('Arial','B',10);
                $this->Cell(150,6,strtoupper(_('cedula')).": $cedulacli                                        STATUS : $status_contrato","1",0,"L");
                $this->SetXY($x_izq+50,25 + $x);
                $this->SetFont('Arial','',9);
                $this->Cell(150,6,$nombrecli,"1",0,"L");
                
                
                $this->Ln();
                $this->SetX($x_izq);
                $this->SetFont('Arial','B',9);
                $this->Cell(25,6,_("CELULAR")." ","1",0,"C");
                
                $this->SetX($x_izq+25);
                $this->SetFont('Arial','B',9);
                $this->Cell(25,6,strtoupper(_("telefono"))." ","1",0,"C");
                
                $this->Ln();
                $this->SetX($x_izq);
                $this->SetFont('Arial','',9);
                $this->Cell(25,6," $telefono","1",0,"C");
                
                $this->SetX($x_izq+25);
                $this->SetFont('Arial','',9);
                $this->Cell(25,6," $telf_casa","1",0,"C");
                
                $this->SetXY($x_izq+50,31 + $x);
                $this->SetFont('Arial','B',9);
                $this->Cell(25,6,strtoupper(_("direccion")).": ","0",0,"L");
                
                $this->SetXY($x_izq+75,31 + $x);
                $this->SetFont('Arial','',9);
                $this->MultiCell(125,6,"$nombre_mun, $nombre_zona,  $nombre_sector $urbanizacion,  $nombre_calle $edificio,  $numero_casa    $telf_adic","0","L");
                
                
                $this->Ln();
                $this->SetXY($x_izq,43 + $x);
                $this->SetFont('Arial','B',9);
                $this->Cell(25,6,strtoupper(_('precinto')),"1",0,"C");
                
                $this->SetXY($x_izq+25,43 + $x);
                $this->SetFont('Arial','B',9);
                $this->Cell(25,6,strtoupper(_('PUNTOS ')),"1",0,"C");
                
                $this->SetXY($x_izq+50,43 + $x);
                $this->SetFont('Arial','B',9);
                $this->Cell(25,6,strtoupper(_('referencia')).": ","0",0,"L");
                
                
                $this->SetXY($x_izq+50,43 + $x);
                $this->SetFont('Arial','',9);
                $this->MultiCell(150,6,"                            ".$direc_adicional,"1","L");
                
                $this->SetXY($x_izq+50,31 + $x);
                $this->Cell(150,24,"","1",0,"C");
                
                $this->Ln();
                $this->SetXY($x_izq,49 + $x);
                $this->Cell(25,6,$etiqueta,"1",0,"C");
                $this->SetFont('Arial','',9);
                $this->SetXY($x_izq+25,49 + $x);
                $this->Cell(25,6,$pto,"1",0,"C");
                
                
                $this->Ln(7);
                $this->SetX($x_izq);
                $this->SetFont('Arial','B',9);
                /*
                $this->Cell(30,5,strtoupper(_('tipo de servicio')).":","0",0,"J");
                $this->SetFont('Arial','',9);
                
                $this->Cell(60,5,$nombre_tipo_orden,"0",0,"J");
                */
                /*
                $this->SetFont('Arial','B',9);
                $this->Cell(50,5,"$postel","1",0,"J");
                $this->SetFont('Arial','B',9);
                $this->Cell(22,5,strtoupper(_('Vendedor')).":","1",0,"J");
                $this->SetFont('Arial','',9);
                $this->Cell(48,5,"$vendedor","1",0,"J");
                $this->SetFont('Arial','B',9);
                $this->Cell(22,5,strtoupper(_('Cobrador')).":","1",0,"J");
                $this->SetFont('Arial','',9);
                $this->Cell(48,5,"$cobrador","1",0,"J");
                */
                
                $this->SetFont('Arial','B',9);
                $this->Cell(30,5,strtoupper(_('detalle orden')).": ","0",0,"J");
                
                $this->SetFont('Arial','',9);
                $this->Cell(70,5,$nombre_det_orden,"0",0,"J");
                
                
                
                $acceso->objeto->ejecutarSql("SELECT *FROM orden_grupo where id_orden='$id_orden'  LIMIT 1 offset 0");
                if($row=row($acceso)){
                        $id_gt=utf8_decode(trim($row['id_gt']));
                }
                $acceso->objeto->ejecutarSql("SELECT *FROM grupo_trabajo where id_gt='$id_gt'  LIMIT 1 offset 0");
                if($row=row($acceso)){
                        $nombre_grupo=utf8_decode(trim($row['nombre_grupo']));
                }
                
                
                
                $this->SetFont('Arial','B',9);
                $this->Cell(30,5,strtoupper(_('asignada a')).": ","0",0,"J");
                
                $this->SetFont('Arial','',9);
                $this->Cell(75,5,''.$nombre_grupo,"0",0,"J");
                
                $this->Ln();
                $this->SetX($x_izq);
                $this->SetFont('Arial','B',9);
                $this->Cell(30,5,strtoupper(_('descripcion')).": ","0",0,"J");
                
                $this->SetFont('Arial','',9);
                $y=$this->GetX();
                $this->MultiCell(167,5,$detalle_orden,"0","J");
                
                
                
                
                
                $this->SetX($x_izq);
                $this->SetFont('Arial','B',9);
                $this->Cell(20,6,strtoupper(_('creada')).": ","LTB",0,"L");
                $this->SetFont('Arial','',9);
                $this->Cell(45,6,$atendido_por,"RTB",0,"L");
                $this->SetFont('Arial','B',9);
                $this->Cell(12,6,strtoupper(_('fecha')).": ","LTB",0,"L");
                $this->SetFont('Arial','',9);
                $this->Cell(23,6,$fecha_orden,"RTB",0,"L");
                
                
                $this->SetFont('Arial','B',9);
                $this->Cell(20,6,strtoupper(_('impresa')).": ","LTB",0,"L");
                $this->SetFont('Arial','',9);
                $this->Cell(45,6,$impreso_por,"RTB",0,"L");
                $this->SetFont('Arial','B',9);
                $this->Cell(12,6,strtoupper(_('fecha')).": ","LTB",0,"L");
                $this->SetFont('Arial','',9);
                $this->Cell(22,6,$fecha_imp,"RTB",0,"L");
                
                
        //      if($id_tipo_orden!="EA00001"){
                
                
                
                $this->Ln();
                
                $this->SetX($x_izq);
                $this->SetFont('Arial','B',9);
                $this->Cell(100,6,strtoupper(_('observaciones')).": ","0",0,"L");
                $this->SetX($x_izq);
                $this->Cell(100,20,'',"1",0,"L");
                $this->Cell(99,20,'',"1",0,"L");
                $this->SetX($x_izq+100);
                
                $this->SetFont('Arial','B',8);          
                $this->Cell(110,7,strtoupper(_('realizado por')).": ".' ______________________________________________',"0",0,"J");
                $this->Ln();
                $this->SetX($x_izq+100);
                $this->Cell(110,7,strtoupper(_('Ayudante')).     ": ".' ______________________________________________',"0",0,"J");
                $this->Ln();
                $this->SetX($x_izq+100);
                $this->Cell(25,7,strtoupper(_('fecha y hora')).": ","0",0,"J");
                $this->Cell(43,7,' _______/_______/__________',"0",0,"J");
                $this->Cell(30,7,' _________:_________',"0",0,"J");
                
                
                        $this->Ln(7);
                
                $this->materiales($acceso);
        /*      
        }//if tipo de orden
        else{
                $this->estado_cuenta_con($acceso,$id_contrato,"ESTADO DE CUENTA",150);
        }
        */
                
        }
        function materiales($acceso)
        {
                $acceso->objeto->ejecutarSql("select hab_imp_mat from config_mat");
                if($row=row($acceso)){
                        $hab_imp_mat=trim($row["hab_imp_mat"]);
                }
                if($hab_imp_mat=="t"){
                        $acceso->objeto->ejecutarSql("SELECT nombre_mat FROM mat_padre where impresion='t' ORDER BY nombre_mat");
                        
                        $this->SetX(10);
                        $this->SetFont('Arial','B',10);
                        $this->Cell(100,6,strtoupper("materiales utilizados"),'0',0,'L'); 
                        $this->SetFont('Arial','B',8);
                        $this->Cell(100,6,strtoupper("inicio cable _______________  FIN CABLE _______________"),'0',0,'R'); 
                        
                        $this->Ln();
                        
                        $this->SetX(10);
                        $this->SetFont('Arial','',8);
                        $i=0;
                        while ($row=row($acceso))
                        {
                                if($i==3){
                                        $this->Ln();
                                        $this->SetX(10);
                                        $i=0;
                                }
                                        $nombre_mat=substr(trim($row['nombre_mat']),0,30);
                                        $this->Cell(37,5,ucfirst(strtolower("$nombre_mat")),"0",0,"J");
                                        $this->Cell(30,5,"______________","0",0,"J");
                                        $i++;
                        }
                }
                
                
        }
        function mas_datos($acceso,$id_orden)
        {
                $x_izq=10;
                $x_medio=100;
                $x_der=150;
                
                                
                $this->Ln(5);
                $this->SetX($x_izq);
                $this->SetFont('times','B',10);
                $this->Cell(200,5,strtoupper(_('conformidad del cliente ')).": ","1",0,"C");
                
                $this->Ln();
                $this->SetX($x_izq);
                $this->Cell(110,7,strtoupper(_('nombre legible ')).": ","1",0,"J");
                $this->Cell(50,7,strtoupper(_('cedula')).": ","1",0,"J");
                $this->Cell(40,7,strtoupper(_('  ')),"LRT",0,"C");
                
                $this->Ln();
                $this->SetX($x_izq);
                $this->Cell(160,7,strtoupper(_('observaciones ')).": ","1",0,"J");
                $this->Cell(40,7,strtoupper(_('FIRMA'))."","LRB",0,"C");
                $this->SetFont('times','',9);
                $this->Ln(7);
                $this->SetX($x_izq);
                $this->MultiCell(196,5,"Estimado Suscriptor: su firma da conformidad de los trabajos realizados por nuestro personal","0","J");
                
                
        }
        
	function estado_cuenta_con($acceso,$id_contrato,$titulo,$sety)
	{
		
		
		
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
			
			
		}
		
			
			$this->Ln(7);
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
		
		$acceso->objeto->ejecutarSql("SELECT *FROM vista_contratodeu where id_contrato='$id_contrato' order by fecha_inst asc");
		
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
	
}
//crea el objeto pdf
$pdf=new PDF();              
$pdf->SetAutoPageBreak(true,5);
//agrega una nueva pagina


$pdf->orden($acceso,$id_orden,$id_gt);

$pdf->Output('reporte.pdf','D');
?> 