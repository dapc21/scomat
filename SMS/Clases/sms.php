<?php
class sms
{
	private $id_sms;
	private $id_contrato;
	private $nro_sms;
	private $tipo_sms;
	private $telefono_sms;
	private $fecha_sms;
	private $hora_sms;
	private $mensaje_sms;
	private $status_sms;
	private $login;
	public $ruta;
	
	function __construct(){
		$this->ruta = 'C:\Users\jc\AppData\Roaming\PC Suite\356838022470259\PCCSSMS.db';
		//$this->ruta = 'F:\Documents and Settings\sistel\Datos de programa\PC Suite\356251046341474\PCCSSMS.db';
		
	}
	public function parametros($id_sms,$id_contrato,$nro_sms,$tipo_sms,$telefono_sms,$fecha_sms,$hora_sms,$mensaje_sms,$status_sms,$login){
		$this->id_sms = $id_sms;
		$this->id_contrato = $id_contrato;
		$this->nro_sms = $nro_sms;
		$this->tipo_sms = $tipo_sms;
		$this->telefono_sms = $telefono_sms;
		$this->fecha_sms = $fecha_sms;
		$this->hora_sms = $hora_sms;
		$this->mensaje_sms = $mensaje_sms;
		$this->status_sms = $status_sms;
		$this->login = $login;
	}
	public function verid_sms(){
		return $this->id_sms;
	}
	public function verlogin(){
		return $this->login;
	}
	public function verstatus_sms(){
		return $this->status_sms;
	}
	public function vermensaje_sms(){
		return $this->mensaje_sms;
	}
	public function verhora_sms(){
		return $this->hora_sms;
	}
	public function verfecha_sms(){
		return $this->fecha_sms;
	}
	public function vertelefono_sms(){
		return $this->telefono_sms;
	}
	public function vertipo_sms(){
		return $this->tipo_sms;
	}
	public function vernro_sms(){
		return $this->nro_sms;
	}
	public function verid_contrato(){
		return $this->id_contrato;
	}
	public function validaExistencia($acceso)	{
		$acceso->objeto->ejecutarSql("select * from sms where id_sms='$this->id_sms'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirsms($acceso)	{
		
session_start();
$ini_u = $_SESSION["ini_u"];  
$acceso->objeto->ejecutarSql("select id_sms from sms  where (id_sms ILIKE '$ini_u%')   ORDER BY id_sms desc LIMIT 1 offset 0 ");
$id_sms=$ini_u.verCoo($acceso,"id_sms");

		return $acceso->objeto->ejecutarSql("insert into sms(id_sms,id_contrato,nro_sms,tipo_sms,telefono_sms,fecha_sms,hora_sms,mensaje_sms,status_sms,login) values ('$id_sms','$this->id_contrato','$this->nro_sms','$this->tipo_sms','$this->telefono_sms','$this->fecha_sms','$this->hora_sms','$this->mensaje_sms','$this->status_sms','$this->login')");			
	}
	public function modificarsms($acceso)	{
		return $acceso->objeto->ejecutarSql("Update sms Set id_contrato='$this->id_contrato', nro_sms='$this->nro_sms', tipo_sms='$this->tipo_sms', telefono_sms='$this->telefono_sms', fecha_sms='$this->fecha_sms', hora_sms='$this->hora_sms', mensaje_sms='$this->mensaje_sms', status_sms='$this->status_sms', login='$this->login' Where id_sms='$this->id_sms'");	
	}
	public function eliminarsms($acceso)	{
		return $acceso->objeto->ejecutarSql("delete from sms where id_sms='$this->id_sms'");
	}
	public function ConsultaDeuda($acceso,$id_contrato,$num_telef)	{
		
		$deuda='';
		$acceso->objeto->ejecutarSql("select *from vista_contratodeu where id_contrato='$id_contrato'  and status_con_ser='DEUDA'");
		while($con=$acceso->objeto->devolverRegistro()){
			$nro_contrato=trim($con["nro_contrato"]);
			$email=trim($con["email"]);
			$deuda=$deuda.trim($con["nombre_servicio"])." ".trim($con["costo_cobro"])."; ";
			$acceso->objeto->siguienteRegistro();
		}
		$sms_r="$empresa; Contrato: $nro_contrato Deuda: $deuda";
		//echo $num_telef,$sms_r;
		$this->EnviarSMSUnico($acceso,$num_telef,$sms_r,$id_contrato);
		if($email!=''){
			$this->EnviarEmailUnico($acceso,$email,"Cable Opera Informa",$sms_r);
		}
	}
	public function isComando($acceso,$mensaje){
		$info=array();
		$valor=explode(" ",$mensaje);
		$comando=trim($valor[0]);
		$acceso->objeto->ejecutarSql("select * from comandos_sms");
		$i=0;
		while($con=$acceso->objeto->devolverRegistro()){
			$nombre_com=trim($con["nombre_com"]);
			//echo "es un comando:com:$comando:$nombre_com:";
			if(strtoupper($comando)==strtoupper($nombre_com)){
				
				$info['id_com']=trim($con["id_com"]);
				$info['tipo_com']=trim($con["tipo_com"]);
				$info['status_com']=trim($con["status_com"]);
				$info['sms_resp']=trim($con["sms_resp"]);
				$info['tipo_variable']=trim($con["tipo_variable"]);
				$info['sms_error']=trim($con["sms_error"]);
				$info['status_error']=trim($con["status_error"]);
				$info['resp_correo']=trim($con["resp_correo"]);
				return $info;
			}
			$acceso->objeto->siguienteRegistro();
		}
		return false;
	}
	public function verificaComando($acceso,$id_contrato,$telefono,$mensaje,$nro_sms){
		$telefono=trim($telefono);
		$info_com=$this->isComando($acceso,$mensaje);
		if($info_com!=false){
			if($info_com['tipo_com']=="PARA CLIENTES"){
				//echo "| $id_contrato |";
				if($id_contrato!="CO00000000"){
					//echo ":es cliente";
					if($info_com['status_com']=="TRUE" || $info_com['status_error']=="TRUE"){
						//echo ":estatus_com true";
						$dato=$this->obtenerSmsCon($acceso,$id_contrato);
						if($info_com['status_com']=="TRUE"){
							$mensaje=$this->obtenerMensajeSms($acceso,$dato,$info_com['sms_resp']);
							$mensaje=strtoupper(utf8_decode($mensaje));
							$this->EnviarSMSUnico($acceso,$telefono,$mensaje,$id_contrato);
						}
						$email=$this->poseeEmail($acceso,$id_contrato);
						
						if($info_com['status_error']=="TRUE" && $email!=false){
							$mensaje=strtoupper(utf8_decode($this->obtenerMensajeSms($acceso,$dato,$info_com['resp_correo'])));
							$this->EnviarEmailUnico($acceso,$email,'',$mensaje);
						}
						
						switch($info_com['id_com'])
						{
							case COM00002:
							//	echo "Update sms Set tipo_list='FALLA', status_list='POR REVISAR' Where id_sms='$nro_sms'";
								$acceso->objeto->ejecutarSql("Update sms Set tipo_list='FALLA', status_list='POR REVISAR' Where id_sms='$nro_sms'");
								return false;
								//break;
							case COM00003:
								//echo "Update sms Set tipo_list='DENUNCIA', status_list='POR REVISAR' Where nro_sms='$nro_sms'";
								$acceso->objeto->ejecutarSql("Update sms Set tipo_list='DENUNCIA', status_list='POR REVISAR' Where id_sms='$nro_sms'");
								return false;
								//break;
							case COM00004:
								//echo "Update sms Set tipo_list='RECLAMO', status_list='POR REVISAR' Where nro_sms='$nro_sms'";
								$acceso->objeto->ejecutarSql("Update sms Set tipo_list='RECLAMO', status_list='POR REVISAR' Where id_sms='$nro_sms'");
								return false;
								//break;
							default:
								return true;
						}
					}
				}
				else{
					
						$dato=$this->obtenerSmsCon($acceso,$id_contrato);
						$mensaje=$this->obtenerMensajeSms($acceso,$dato,$info_com['sms_error']);
						$mensaje=strtoupper(utf8_decode($mensaje));
						$this->EnviarSMSUnico($acceso,$telefono,$mensaje,$id_contrato);
					
				}
			}
			else if($info_com['tipo_com']=="PARA TECNICOS"){
				//echo "es tecnico";
				$isGer=$this->verificaIsEmp($acceso,$telefono);
				if($isGer!=false){
					//echo "es gerente";
					if($info_com['status_com']=="TRUE" || $info_com['status_error']=="TRUE"){
						//echo "habilitado SMS";
						$valor=explode(" ",$mensaje);
						$contra=trim($valor[1]);
						//echo ":$contra:";
						$id_contrato=$this->isContrato($acceso,$contra);
						if($id_contrato!=false){
							/*$dato=$this->obtenerSmsCon($acceso,$id_contrato);
							$mensaje=$this->obtenerMensajeSms($acceso,$dato,$info_com['sms_resp']);
							$mensaje=strtoupper(utf8_decode($mensaje));
							$this->EnviarSMSUnico($acceso,$telefono,$mensaje,$id_contrato);
							*/
							
							$dato=$this->obtenerSmsCon($acceso,$id_contrato);
							if($info_com['status_com']=="TRUE"){
								$mensaje=$this->obtenerMensajeSms($acceso,$dato,$info_com['sms_resp']);
								$mensaje=strtoupper(utf8_decode($mensaje));
								$this->EnviarSMSUnico($acceso,$telefono,$mensaje,$id_contrato);
							}
							
							$email=$this->getEmailEmp($acceso,$telefono);
							
							if($info_com['status_error']=="TRUE" && $email!=''){
								$mensaje=strtoupper(utf8_decode($this->obtenerMensajeSms($acceso,$dato,$info_com['resp_correo'])));
								$this->EnviarEmailUnico($acceso,$email,'',$mensaje);
							}
						}
						else{
							$this->EnviarSMSUnico($acceso,$telefono,"ERROR, DESPUES DEL COMANDO DEBE INDICAR EL NUMERO DE CONTRATO,CEDULA,ETIQUETA O TELEFONO DEL CLIENTE",$id_contrato);
						}
					}
				}
				else{
					ECHO "NO ES GERENTE";
						$dato=$this->obtenerSmsIngresoAct($acceso,date("Y-m-d"));
						$mensaje=$this->obtenerMensajeSms($acceso,$dato,$info_com['sms_error']);
						$mensaje=strtoupper(utf8_decode($mensaje));
						$this->EnviarSMSUnico($acceso,$telefono,$mensaje,'');
				}
			}
			else if($info_com['tipo_com']=="PARA GERENTES"){
				$isGer=$this->verificaTelGerente($acceso,$telefono);
				if($isGer!=false){
					if($info_com['status_com']=="TRUE" || $info_com['status_error']=="TRUE"){
						
						switch($info_com['id_com'])
						{
							case COM00005:
																
								$dato=$this->obtenerSmsIngresoAct($acceso,date("Y-m-d"));
								if($info_com['status_com']=="TRUE"){
									$mensaje=$this->obtenerMensajeSms($acceso,$dato,$info_com['sms_resp']);
									$mensaje=strtoupper(utf8_decode($mensaje));
									$this->EnviarSMSUnico($acceso,$telefono,$mensaje,'');
								}
								
								$email=$isGer;
								
								if($info_com['status_error']=="TRUE" && $email!=''){
									$mensaje=strtoupper(utf8_decode($this->obtenerMensajeSms($acceso,$dato,$info_com['resp_correo'])));
									$this->EnviarEmailUnico($acceso,$email,'',$mensaje);
								}
							
							
								return true;
							case COM00006:
								$valor=explode(" ",$mensaje);
								$fecha=$valor[1];
								if($this->isFecha($fecha)){
									$fecha=$this->f_fecha($fecha);
									
									$dato=$this->obtenerSmsCierreDiarioFecha($acceso,$fecha);
									
									/*
									$mensaje=$this->obtenerMensajeSms($acceso,$dato,$info_com['sms_resp']);
									$mensaje=strtoupper(utf8_decode($mensaje));
									
									$this->EnviarSMSUnico($acceso,$telefono,$mensaje,'');
									*/
									
									if($info_com['status_com']=="TRUE"){
										$mensaje=$this->obtenerMensajeSms($acceso,$dato,$info_com['sms_resp']);
										$mensaje=strtoupper(utf8_decode($mensaje));
										$this->EnviarSMSUnico($acceso,$telefono,$mensaje,'');
									}
									
									$email=$isGer;
									
									if($info_com['status_error']=="TRUE" && $email!=''){
										$mensaje=strtoupper(utf8_decode($this->obtenerMensajeSms($acceso,$dato,$info_com['resp_correo'])));
										$this->EnviarEmailUnico($acceso,$email,'',$mensaje);
									}
								
								}
								else{
									$this->EnviarSMSUnico($acceso,$telefono,"ERROR, LA FECHA DEBE TENER EL FORMATO DD/MM/AAAA",'');
								}
								return true;
								//break;
							case COM00007:
								$valor=explode(" ",$mensaje);
								$fecha=$valor[1];
								if($this->isFecha($fecha)){
									$fecha=$this->f_fecha($fecha);
									$dato=$this->obtenerSmsCierreDiarioFecha($acceso,$fecha);
									/*$mensaje=$this->obtenerMensajeSms($acceso,$dato,$info_com['sms_resp']);
									$mensaje=strtoupper(utf8_decode($mensaje));
									$this->EnviarSMSUnico($acceso,$telefono,$mensaje,'');
									*/
									if($info_com['status_com']=="TRUE"){
										$mensaje=$this->obtenerMensajeSms($acceso,$dato,$info_com['sms_resp']);
										$mensaje=strtoupper(utf8_decode($mensaje));
										$this->EnviarSMSUnico($acceso,$telefono,$mensaje,'');
									}
									
									$email=$isGer;
									
									if($info_com['status_error']=="TRUE" && $email!=''){
										$mensaje=strtoupper(utf8_decode($this->obtenerMensajeSms($acceso,$dato,$info_com['resp_correo'])));
										$this->EnviarEmailUnico($acceso,$email,'',$mensaje);
									}
								}
								else{
									$this->EnviarSMSUnico($acceso,$telefono,"ERROR, LA FECHA DEBE TENER EL FORMATO DD/MM/AAAA",'');
								}
								return true;
								break;
							
							default:
								return;
						}
					}
				}
				else{
						$dato=$this->obtenerSmsIngresoAct($acceso,date("Y-m-d"));
						$mensaje=$this->obtenerMensajeSms($acceso,$dato,$info_com['sms_error']);
						$mensaje=strtoupper(utf8_decode($mensaje));
						$this->EnviarSMSUnico($acceso,$telefono,$mensaje,'');
				}
			}
			return true;
		}
		else{
			if($id_contrato=="CO00000000"){
				$acceso->objeto->ejecutarSql("select *from config_sms where id_franq='1'");
					if($con=$acceso->objeto->devolverRegistro()){
						$act_resp_aut=trim($con["act_resp_aut"]);
						$sms_resp_aut=trim($con["sms_resp_aut"]);
					}
						if($act_resp_aut=="t"){
							$mensaje=strtoupper(utf8_decode($sms_resp_aut));
							$this->EnviarSMSUnico($acceso,$telefono,$mensaje,$id_contrato);
						}
			}
		}
		
		return false;
	}
	public function isFecha($fecha){
		$valor=explode("/",$fecha);
		$dia=$valor[0];
		$mes=$valor[1];
		$anio=$valor[2];
		if(strlen($dia)==2){
			if($dia>=0 && $dia<=31){
				if(strlen($mes)==2){
					if($mes>=0 && $mes<=12){
						if(strlen($anio)==4){
							if($anio>=2010 && $anio<=2030){
								return true;
							}
						}
					}
				}
			}
		}
		return false;
	}
	public function f_fecha($date){
		$valor=explode("/",trim($date));
		$fecha= $valor[2].'-'.$valor[1].'-'.$valor[0];
		return $fecha;
	}
	public function EnviarSMSAutomatico($acceso,$tipo_sms_aut,$referencia,$obs){
		switch($tipo_sms_aut)
		{
			
			case Ordenes:
				$id_orden=$referencia;
				$acceso->objeto->ejecutarSql("select * from ordenes_tecnicos where id_orden='$id_orden'");
				if($row=$acceso->objeto->devolverRegistro()){
					$id_det_orden=trim($row['id_det_orden']);
					$id_contrato=trim($row['id_contrato']);
				}
				if($obs=="incluir"){
					$acceso->objeto->ejecutarSql("select * from envio_aut where ref_envio='$id_det_orden' and (nombre_envio ILIKE '%AL GENERAR%')");
				}
				else if($obs=="finalizar"){
					$acceso->objeto->ejecutarSql("select * from envio_aut where ref_envio='$id_det_orden' and (nombre_envio ILIKE '%AL FINALIZAR%')");
				}
				if($row=$acceso->objeto->devolverRegistro()){
					$id_envio=trim($row['id_envio']);
					$envio_sms=trim($row['envio_sms']);
					$envio_email=trim($row['envio_email']);
					$sms_envio=trim($row['descripcion_envio']);
					$resp_correo=trim($row['resp_correo']);
					if($envio_sms=="TRUE" || $envio_email=="TRUE"){
						$acceso->objeto->ejecutarSql("select persona.telefono,cliente.telf_casa,cliente.telf_adic,cliente.email from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and contrato.id_contrato='$id_contrato'");
						$con=$acceso->objeto->devolverRegistro();
						$email=trim($con["email"]);
						$num_telef=$this->obtenerTelfCon($con);
						
						$dato=$this->obtenerSmsOrden($acceso,$id_contrato,$id_orden);
						$mensaje=$this->obtenerMensajeSms($acceso,$dato,$sms_envio);
						$mensaje=strtoupper(utf8_decode($mensaje));
						
						if($envio_sms=="TRUE"){
							$this->EnviarSMSUnico($acceso,$num_telef,$mensaje,$id_contrato);
						}
						if($envio_email=="TRUE"){
							if($email!=''){
								$mensaje=strtoupper(utf8_decode($this->obtenerMensajeSms($acceso,$dato,$resp_correo)));
								$this->EnviarEmailUnico($acceso,$email,"",$mensaje);
							}
						}
					}
				}
				break;
			case Pago:
				$id_pago=$referencia;
				$acceso->objeto->ejecutarSql("select id_contrato from pagos where id_pago='$id_pago' LIMIT 1 offset 0 ");
				if($row=$acceso->objeto->devolverRegistro()){
					$id_contrato=trim($row['id_contrato']);
				}
				$acceso->objeto->ejecutarSql("select id_tipo_pago from detalle_tipopago where id_pago='$id_pago' LIMIT 1 offset 0 ");
				if($row=$acceso->objeto->devolverRegistro()){
					$id_tipo_pago=trim($row['id_tipo_pago']);
					
				}
				if($id_tipo_pago=='TPA00003' || $id_tipo_pago=='TPA00004'){
				
				$acceso->objeto->ejecutarSql("select * from envio_aut where (nombre_envio ILIKE '%AL REALIZAR PAGOS%')");
				if($row=$acceso->objeto->devolverRegistro()){
					$id_envio=trim($row['id_envio']);
					$envio_sms=trim($row['envio_sms']);
					$envio_email=trim($row['envio_email']);
					$sms_envio=trim($row['descripcion_envio']);
					$resp_correo=trim($row['resp_correo']);
					if($envio_sms=="TRUE" || $envio_email=="TRUE"){
						$acceso->objeto->ejecutarSql("select persona.telefono,cliente.telf_casa,cliente.telf_adic,cliente.email from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and contrato.id_contrato='$id_contrato'");
						$con=$acceso->objeto->devolverRegistro();
						$email=trim($con["email"]);
						$num_telef=$this->obtenerTelfCon($con);
						
						$dato=$this->obtenerSmsPago($acceso,$id_contrato,$id_pago);
						$mensaje=$this->obtenerMensajeSms($acceso,$dato,$sms_envio);
						$mensaje=strtoupper(utf8_decode($mensaje));
						
						if($envio_sms=="TRUE"){
							$this->EnviarSMSUnico($acceso,$num_telef,$mensaje,$id_contrato);
						}
						if($envio_email=="TRUE"){
							if($email!=''){
								$mensaje=strtoupper(utf8_decode($this->obtenerMensajeSms($acceso,$dato,$resp_correo)));
								$this->EnviarEmailUnico($acceso,$email,"Cable Opera Informa",$mensaje);
							}
						}
					}
				}
				}
				break;
			case Cierre_Caja:
				$id_caja_cob=$referencia;
				
				$acceso->objeto->ejecutarSql("select * from envio_aut where (nombre_envio ILIKE '%CIERRE DE CAJA%')");
				if($row=$acceso->objeto->devolverRegistro()){
					$id_envio=trim($row['id_envio']);
					$envio_sms=trim($row['envio_sms']);
					$envio_email=trim($row['envio_email']);
					$sms_envio=trim($row['descripcion_envio']);
					$resp_correo=trim($row['resp_correo']);
					if($envio_sms=="TRUE" || $envio_email=="TRUE"){
						$acceso->objeto->ejecutarSql("select persona.telefono,cliente.telf_casa,cliente.telf_adic,cliente.email from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and contrato.id_contrato='$id_contrato'");
						$con=$acceso->objeto->devolverRegistro();
						$email=trim($con["email"]);
						$info=$this->obtenerInfoGerente($acceso,"PRINCIPAL");
						//echo "|$num_telef|";
						$dato=$this->obtenerSmsCierreCaja($acceso,$id_contrato,$id_caja_cob);
						$mensaje=$this->obtenerMensajeSms($acceso,$dato,$sms_envio);
						$mensaje=strtoupper(utf8_decode($mensaje));

						if($envio_sms=="TRUE"){
							$this->EnviarSMSUnico($acceso,$info['telf'],$mensaje,'');
						}
						if($envio_email=="TRUE"){
							$mensaje=strtoupper(utf8_decode($this->obtenerMensajeSms($acceso,$dato,$resp_correo)));
							$this->EnviarEmailUnico($acceso,$info['email'],"",$mensaje);
							
						}
					}
				}
				break;
			case Cierre_Diario:
				$id_cierre=$referencia;
				
				$acceso->objeto->ejecutarSql("select * from envio_aut where (nombre_envio ILIKE '%CIERRE DIARIO%')");
				if($row=$acceso->objeto->devolverRegistro()){
					$id_envio=trim($row['id_envio']);
					$envio_sms=trim($row['envio_sms']);
					$envio_email=trim($row['envio_email']);
					$sms_envio=trim($row['descripcion_envio']);
					$resp_correo=trim($row['resp_correo']);
					if($envio_sms=="TRUE" || $envio_email=="TRUE"){
						$acceso->objeto->ejecutarSql("select persona.telefono,cliente.telf_casa,cliente.telf_adic,cliente.email from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and contrato.id_contrato='$id_contrato'");
						$con=$acceso->objeto->devolverRegistro();
						$email=trim($con["email"]);
						$info=$this->obtenerInfoGerente($acceso,"PRINCIPAL");
						$dato=$this->obtenerSmsCierreDiario($acceso,$id_contrato,$id_cierre);
						$mensaje=$this->obtenerMensajeSms($acceso,$dato,$sms_envio);
						$mensaje=strtoupper(utf8_decode($mensaje));

						if($envio_sms=="TRUE"){
							$this->EnviarSMSUnico($acceso,$info['telf'],$mensaje,'');
						}
						if($envio_email=="TRUE"){
							$mensaje=strtoupper(utf8_decode($this->obtenerMensajeSms($acceso,$dato,$resp_correo)));
							$this->EnviarEmailUnico($acceso,$info['email'],"",$mensaje);
						}
					}
				}
				break;
			default:
				return;
		}
	}
	public function verificaTelGerente($acceso,$telefono)	{
		$info=array();
		$acceso->objeto->ejecutarSql("select * from vista_gerentes where sattus_gerente='ACTIVO' and telefono='$telefono'");
		$i=0;
		if($con=$acceso->objeto->devolverRegistro()){
			return trim($con["correo_gerente"]);
		}
		return false;
	}
	public function verificaIsEmp($acceso,$telefono){
		$acceso->objeto->ejecutarSql("select correo_tec from vista_tecnico where status_tec='ACTIVO' and  telefono='$telefono'");
		if($con=$acceso->objeto->devolverRegistro()){
			return true;
		}
		$acceso->objeto->ejecutarSql("select telefono from vista_cobrador where telefono='$telefono'");
		if($con=$acceso->objeto->devolverRegistro()){
			return true;
		}
		$acceso->objeto->ejecutarSql("select telefono from vista_vendedor where telefono='$telefono'");
		if($con=$acceso->objeto->devolverRegistro()){
			return true;
		}
		$acceso->objeto->ejecutarSql("select correo_gerente from vista_gerentes where telefono='$telefono' AND sattus_gerente='ACTIVO' ");
		if($con=$acceso->objeto->devolverRegistro()){
			return true;
		}
		
		return false;
	}
	public function verificaTelTecnico($acceso,$telefono)	{
		$acceso->objeto->ejecutarSql("select * from vista_tecnico where status_tec='ACTIVO' and  telefono='$telefono'");
		if($con=$acceso->objeto->devolverRegistro()){
			return trim($con["correo_tec"]);
		}
		$acceso->objeto->ejecutarSql("select correo_gerente from vista_gerentes where telefono='$telefono' AND sattus_gerente='ACTIVO' ");
		if($con=$acceso->objeto->devolverRegistro()){
			return trim($con["correo_gerente"]);
		}
		return false;
	}
	public function getEmailEmp($acceso,$telefono)	{
		$acceso->objeto->ejecutarSql("select * from vista_tecnico where status_tec='ACTIVO' and  telefono='$telefono'");
		if($con=$acceso->objeto->devolverRegistro()){
			return trim($con["correo_tec"]);
		}
		$acceso->objeto->ejecutarSql("select correo_gerente from vista_gerentes where telefono='$telefono' AND sattus_gerente='ACTIVO' ");
		if($con=$acceso->objeto->devolverRegistro()){
			return trim($con["correo_gerente"]);
		}
		return '';
	}
	public function isContrato($acceso,$contra){
		//echo "select * from vista_contrato where nro_contrato='$contra' or cedula='$contra'";
		$acceso->objeto->ejecutarSql("select * from vista_contrato where nro_contrato='$contra' or cedula='$contra' or etiqueta='$contra' or telefono='$contra'");
		if($con=$acceso->objeto->devolverRegistro()){
			return trim($con["id_contrato"]);
		}
		//echo "false";
		return false;
	}
	public function obtenerInfoGerente($acceso,$nivel)	{
		session_start();
		$id_f = $_SESSION["id_franq"];
		if($id_f==''){
			$id_f='0';
		}
		$consult=" and uaid_franq='$id_f'";
	
		$info=array();
		$acceso->objeto->ejecutarSql("select * from vista_gerentes,usuario where vista_gerentes.id_persona=usuario.id_persona and  sattus_gerente='ACTIVO' and tipo_gerente='$nivel' and (usuario.id_franq='$id_f' or usuario.id_franq='0')");
		$i=0;
		while($con=$acceso->objeto->devolverRegistro()){
			$info['telf']=$info['telf'].trim($con["telefono"]).";";
			if($i==0)
				$info['email']=$info['email']."".trim($con["correo_gerente"])."";
			else
				$info['email']=$info['email'].";".trim($con["correo_gerente"]);
			$i++;
			$acceso->objeto->siguienteRegistro();
		}
		
		return $info;
	}
	public function EnviarSMSContrato($acceso,$id_contrato,$sms_r)	{
					$acceso->objeto->ejecutarSql("select persona.nombre, persona.apellido, persona.telefono,cliente.telf_casa,cliente.telf_adic,cliente.email from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and contrato.id_contrato='$id_contrato'");
					if($con=$acceso->objeto->devolverRegistro()){
						$telefono_c=trim($con["telefono"]);
						$telf_casa=trim($con["telf_casa"]);
						$telf_adic=trim($con["telf_adic"]);
						$email=trim($con["email"]);
						$nombre=trim($con["apellido"])." ".trim($con["nombre"]);
					}
					$num_telef='';
					if($telefono_c!='' || $telf_casa!='' || $telf_adic!=''){
						if($telefono_c!=''){
							$num_telef=$telefono_c;
							if($telf_casa!=''){
							$num_telef=$num_telef.';'.$telf_casa;
							}
							if($telf_adic!=''){
							$num_telef=$num_telef.';'.$telf_adic;
							}
						}
						else if($telf_casa!=''){
							$num_telef=$telf_casa;
							if($telf_adic!=''){
								$num_telef=$num_telef.';'.$telf_adic;
							}
						}
						else {
							$num_telef=$telf_adic;
						}
					}
				//	echo ":$num_telef:$sms_r:";
		$this->EnviarSMSUnico($acceso,$num_telef,$sms_r,$id_contrato);
		if($email!=''){
			$this->EnviarEmailUnico($acceso,$email,"Cable Opera Informa",$sms_r);

		}
	}
	public function poseeEmail($acceso,$id_contrato){
					$acceso->objeto->ejecutarSql("select cliente.email from contrato,cliente where cliente.id_persona=contrato.cli_id_persona and contrato.id_contrato='$id_contrato'");
					if($con=$acceso->objeto->devolverRegistro()){
						$email=trim($con["email"]);
						if($email!=''){
							return $email;
						}
					}
					return false;
	}
	public function obtenerTelfCon($con){
					$telefono_c=trim($con["telefono"]);
					$telf_casa=trim($con["telf_casa"]);
					$telf_adic=trim($con["telf_adic"]);
					$email=trim($con["email"]);
					$num_telef='';
					if($telefono_c!='' || $telf_casa!='' || $telf_adic!=''){
						if($telefono_c!=''){
							$num_telef=$telefono_c;
							if($telf_casa!=''){
							$num_telef=$num_telef.';'.$telf_casa;
							}
							if($telf_adic!=''){
							$num_telef=$num_telef.';'.$telf_adic;
							}
						}
						else if($telf_casa!=''){
							$num_telef=$telf_casa;
							if($telf_adic!=''){
								$num_telef=$num_telef.';'.$telf_adic;
							}
						}
						else {
							$num_telef=$telf_adic;
						}
						return $num_telef;
					}
					else{
						return false;
					}
	}
	public function obtenerMensajeSms($acceso,$dato,$sms_envio){
		$sms_envio=strtoupper($sms_envio);
		$acceso->objeto->ejecutarSql("select variable from variables_sms");
		while($con=$acceso->objeto->devolverRegistro()){
			$variable=strtoupper(trim($con["variable"]));
			$sms_envio=str_replace($variable,$dato[$variable],$sms_envio);
			$acceso->objeto->siguienteRegistro();
		}
		return $sms_envio;
	}
	public function obtenerSmsCon($acceso,$id_contrato){
		$acceso->objeto->ejecutarSql("select *from contrato where id_contrato='$id_contrato'");
		if($con=$acceso->objeto->devolverRegistro()){
			$id_calle=trim($con["id_calle"]);
			$id_persona=trim($con["id_persona"]);
			$cli_id_persona=trim($con["cli_id_persona"]);
			$nro_contrato=trim($con["nro_contrato"]);
			$etiqueta=trim($con["etiqueta"]);
			$status_contrato=trim($con["status_contrato"]);
			$direc_adicional=trim($con["direc_adicional"]);
			$numero_casa=trim($con["numero_casa"]);
			$edificio=trim($con["edificio"]);
			$numero_piso=trim($con["numero_piso"]);
			
		}
		$acceso->objeto->ejecutarSql("select *from cliente where id_persona='$cli_id_persona'");
		if($con=$acceso->objeto->devolverRegistro()){
			$telf_casa=trim($con["telf_casa"]);
			$email=trim($con["email"]);
			$telf_adic=trim($con["telf_adic"]);
		}
		$acceso->objeto->ejecutarSql("select *from persona where id_persona='$cli_id_persona'");
		if($con=$acceso->objeto->devolverRegistro()){
			$cedula=trim($con["cedula"]);
			$nombre=trim($con["nombre"]);
			$apellido=trim($con["apellido"]);
			$telefono=trim($con["telefono"]);
		}
		$fecha_act=date("Y-m-01");
		$acceso->objeto->ejecutarSql("select sum(cant_serv * costo_cobro) as deuda from contrato_servicio_deuda where id_contrato='$id_contrato' and status_con_ser='DEUDA' and fecha_inst < '$fecha_act' ");
		if($con=$acceso->objeto->devolverRegistro()){
			$deuda=trim($con["deuda"]);
		}

		
		$det_deuda='';
		$sumdeuda=0;
		$acceso->objeto->ejecutarSql("select nombre_servicio, (contrato_servicio_deuda.cant_serv * contrato_servicio_deuda.costo_cobro) as monto, contrato_servicio_deuda.fecha_inst from contrato_servicio_deuda,servicios where servicios.id_serv=contrato_servicio_deuda.id_serv and contrato_servicio_deuda.id_contrato='$id_contrato' and contrato_servicio_deuda.status_con_ser='DEUDA' and fecha_inst < '$fecha_act' ");
		while($con=$acceso->objeto->devolverRegistro()){
			$monto=trim($con["monto"]);
			$sumdeuda = $sumdeuda + $monto;
			$nom_serv=trim($con["nombre_servicio"]);
			if($nom_serv=="MESUALIDAD CABLE"){
			 $nom_serv="M";
			}
			
			$fecha=trim($con["fecha_inst"]);
			$fechaN=explode("-",$fecha);
			$mes=formato_m($fechaN[1]);
			
			$det_deuda=$det_deuda.$mes.", ";
			
			$acceso->objeto->siguienteRegistro();
		}
		//$det_deuda=$det_deuda."DEUDA TOTAL: ".$sumdeuda;
		
			$u_f_pago="";
			$acceso->objeto->ejecutarSql("select id_pago,fecha_pago from pagos where id_contrato='$id_contrato' ORDER BY fecha_pago DESC LIMIT 1 offset 0");
				if($row2=row($acceso)){
					$id_pago=trim($row2['id_pago']);
					$fecha_pago=trim($row2['fecha_pago']);
					

					$acceso->objeto->ejecutarSql("select id_cont_serv from pago_servicio where id_pago='$id_pago' ORDER BY fecha_pago DESC LIMIT 1 offset 0");
					if($row1=row($acceso)){
						$id_cont_serv = trim($row1['id_cont_serv']);
						
						$acceso->objeto->ejecutarSql("select nombre_servicio, (contrato_servicio_deuda.cant_serv * contrato_servicio_deuda.costo_cobro) as monto, contrato_servicio_deuda.fecha_inst from contrato_servicio_deuda,servicios where servicios.id_serv=contrato_servicio_deuda.id_serv and contrato_servicio_deuda.id_cont_serv='$id_cont_serv' and contrato_servicio_deuda.status_con_ser='DEUDA'");
						if($con=$acceso->objeto->devolverRegistro()){
							$monto=trim($con["monto"]);
							$sumdeuda = $sumdeuda + $monto;
							$nom_serv=trim($con["nombre_servicio"]);
							if($nom_serv=="MESUALIDAD CABLE"){
							 $nom_serv="M";
							}
							else if($nom_serv=="PUNTOS ADICIONALES"){
							 $nom_serv="P";
							}
							$u_f_pago=form_fec(trim($con["fecha_inst"]))." ".$nom_serv." ".$monto."; ";
							
						}
					}
				}
		
		$acceso->objeto->ejecutarSql("select *from calle where id_calle='$id_calle'");
		if($con=$acceso->objeto->devolverRegistro()){
			$id_sector=trim($con["id_sector"]);
			$nombre_calle=trim($con["nombre_calle"]);
		}
		$acceso->objeto->ejecutarSql("select *from sector where id_sector='$id_sector'");
		if($con=$acceso->objeto->devolverRegistro()){
			$id_zona=trim($con["id_zona"]);
			$nombre_sector=trim($con["nombre_sector"]);
		}
		$acceso->objeto->ejecutarSql("select *from zona where id_zona='$id_zona'");
		if($con=$acceso->objeto->devolverRegistro()){
			$id_sector=trim($con["id_sector"]);
			$nombre_zona=trim($con["nombre_zona"]);
		}
		$dato=array();
		$dato['@NRO_CONTRATO@']=$nro_contrato;
		$dato['@CEDULACLI@']=$cedula;
		$dato['@NOMBRECLI@']=$nombre;
		$dato['@APELLIDOCLI@']=$apellido;
		$dato['@NOMBRE_CALLE@']=$nombre_calle;
		$dato['@NOMBRE_SECTOR@']=$nombre_sector;
		$dato['@NOMBRE_ZONA@']=$nombre_zona;
		$dato['@TOTAL_DEUDA@']=$deuda;
		$dato['@ETIQUETA@']=$etiqueta;
		$dato['@STATUS_CONTRATO@']=$status_contrato;
		$dato['@DIREC_ADICIONAL@']=$direc_adicional;
		$dato['@NUMERO_CASA@']=$numero_casa;
		$dato['@EDIFICIO@']=$edificio;
		$dato['@NUMERO_PISO@']=$numero_piso;
		$dato['@TELF_CASA@']=$telf_casa;
		$dato['@TELF_ADIC@']=$telf_adic;
		$dato['@EMAIL@']=$email;
		$dato['@D_DEUDA@']=$det_deuda;
		$dato['@U_F_PAGO@']=$u_f_pago;
		return $dato;
		
	}
	public function obtenerSmsOrden($acceso,$id_contrato,$id_orden){
		$dato=$this->obtenerSmsCon($acceso,$id_contrato);
		
		$acceso->objeto->ejecutarSql("select *from ordenes_tecnicos where id_orden='$id_orden'");
		if($con=$acceso->objeto->devolverRegistro()){
			$fecha_orden=trim($con["fecha_orden"]);
			$fecha_final=trim($con["fecha_final"]);
			$id_det_orden=trim($con["id_det_orden"]);
		}
		$acceso->objeto->ejecutarSql("select *from detalle_orden where id_det_orden='$id_det_orden'");
		if($con=$acceso->objeto->devolverRegistro()){
			$id_tipo_orden=trim($con["id_tipo_orden"]);
			$nombre_det_orden=trim($con["nombre_det_orden"]);
		}
		$acceso->objeto->ejecutarSql("select *from tipo_orden where id_tipo_orden='$id_tipo_orden'");
		if($con=$acceso->objeto->devolverRegistro()){
			$nombre_tipo_orden=trim($con["nombre_tipo_orden"]);
		}
		$dato['@ID_ORDEN@']=$id_orden;
		$dato['@F_ORDEN@']=$fecha_orden;
		$dato['@F_FINAL@']=$fecha_final;
		$dato['@STATUS_ORDEN@']=$status_orden;
		$dato['@NOMBRE_DET_ORDEN@']=$nombre_det_orden;
		$dato['@NOM_TIPO_ORDEN@']=$nombre_tipo_orden;
		return $dato;
	}
	public function obtenerSmsPago($acceso,$id_contrato,$id_pago){
		$dato=$this->obtenerSmsCon($acceso,$id_contrato);
		
		$acceso->objeto->ejecutarSql("select *from pagos where id_pago='$id_pago'");
		if($con=$acceso->objeto->devolverRegistro()){
			$fecha_pago=trim($con["fecha_pago"]);
			$hora_pago=trim($con["hora_pago"]);
			$monto_pago=trim($con["monto_pago"]);
			$status_pago=trim($con["status_pago"]);
			$nro_factura=trim($con["nro_factura"]);
		}
		//echo ":$monto_pago:";
		$dato['@F_PAGO@']=$fecha_pago;
		$dato['@HORA_PAGO@']=$hora_pago;
		$dato['@MONTO_PAGO@']=$monto_pago;
		$dato['@STATUS_PAGO@']=$status_pago;
		$dato['@NRO_FACTURA@']=$nro_factura;
		return $dato;
	}
	public function obtenerSmsCierreCaja($acceso,$id_contrato,$id_caja_cob){
		//$dato=$this->obtenerSmsCon($acceso,$id_contrato);
		$dato=array();
		
		$acceso->objeto->ejecutarSql("select *from caja_cobrador where id_caja_cob='$id_caja_cob'");
		if($con=$acceso->objeto->devolverRegistro()){
			$id_caja_cob=trim($con["id_caja_cob"]);
			$id_caja=trim($con["id_caja"]);
			$id_persona=trim($con["id_persona"]);
			$fecha_caja=trim($con["fecha_caja"]);
			$apertura_caja=trim($con["apertura_caja"]);
			$monto_acum=trim($con["monto_acum"]);
			$status_caja=trim($con["status_caja"]);

		}
		$acceso->objeto->ejecutarSql("select *from vista_cobrador where id_persona='$id_persona'");
		if($con=$acceso->objeto->devolverRegistro()){
			$cedulacob=trim($con["cedula"]);
			$nombrecob=trim($con["nombre"]);
			$apellidocob=trim($con["apellido"]);
			$nro_cobrador=trim($con["nro_cobrador"]);
		}
		$acceso->objeto->ejecutarSql("select *from caja where id_caja='$id_caja'");
		if($con=$acceso->objeto->devolverRegistro()){
			$nombre_caja=trim($con["nombre_caja"]);
		}
		
		
		$d_serv='';
		
		//include "../procesos.php";
		$dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
			 $totalG=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				$acceso->objeto->ejecutarSql("SELECT costo_cobro,cant_serv FROM vista_pago_ser where id_caja_cob='$id_caja_cob' and id_serv='$id_serv' and status_pago='PAGADO'");
				$suma=0;
				$cont=0;
				while ($row=row($acceso))
				{
					$cant=trim($row["cant_serv"]);
					$tar=trim($row["costo_cobro"]);
					$suma=$suma+($cant*$tar);
					$cont=$cont+$cant;
				}
				$total=$suma;
				$totalG=$totalG+$total;
				if($total>0){
					$d_serv=$d_serv.strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"])))." => ".$cont.' = '.number_format($total+0, 2, ',', '.').'; ';
				}
			}
			//$totalG
		$d_f_pago='';
		$dato=lectura($acceso,"SELECT *FROM tipo_pago");
			for($k=0;$k<count($dato);$k++){
				$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
				$acceso->objeto->ejecutarSql("SELECT monto_pago FROM vista_tipopago where id_caja_cob='$id_caja_cob' and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'");
				$suma=0;
				while ($row=row($acceso))
				{
					$suma=$suma+trim($row["monto_pago"]);
				}
				$total=$suma;
				if($total>0){
					$d_f_pago=$d_f_pago.trim($dato[$k]["tipo_pago"]).' '.number_format($total+0, 2, ',', '.').'; ';
				}
			}
			
			
		$dato['@R_SERV_C@']=$d_serv;
		$dato['@R_F_PAGO_C@']=$d_f_pago;
		//echo ":$monto_pago:";
		$dato['@ID_CAJA_COB@']=$id_caja_cob;
		$dato['@F_CAJA@']=$fecha_caja;
		$dato['@HORA_APERTURA_C@']=$apertura_caja;
		$dato['@HORA_CIERRE_C@']=$cierre_caja;
		$dato['@MONTO_ACUM_C@']=$monto_acum;
		$dato['@CEDULACOB@']=$cedulacob;
		$dato['@NOMBRECOB@']=$nombrecob;
		$dato['@APELLIDOCOB@']=$apellidocob;
		$dato['@NRO_COBRADOR@']=$nro_cobrador;
		$dato['@NOMBRE_CAJA@']=$nombre_caja;
		return $dato;
	}
	public function obtenerSmsIngresoAct($acceso,$fecha_pago){
		//$dato=$this->obtenerSmsCon($acceso,$id_contrato);
		$dato=array();
		
session_start();		
$id_f = $_SESSION["id_franq"];  
$consult=" and id_franq='0'";

		$acceso->objeto->ejecutarSql("select sum(monto_pago) as monto_acum,count(*) as cant_fact from vista_pago_cont where fecha_pago='$fecha_pago' and status_pago='PAGADO' $consult ");
		if($con=$acceso->objeto->devolverRegistro()){
			$monto_acum_p=trim($con["monto_acum"]);
			$cant_fact_p=trim($con["cant_fact"]);
		}
/*
		$d_serv='';
		//include "../procesos.php";
		$dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
			 $totalG=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				$acceso->objeto->ejecutarSql("SELECT costo_cobro,cant_serv FROM vista_pago_ser where fecha_pago='$fecha_pago' and id_serv='$id_serv' and status_pago='PAGADO'");
				$suma=0;
				$cont=0;
				while ($row=row($acceso))
				{
					$cant=trim($row["cant_serv"]);
					$tar=trim($row["costo_cobro"]);
					$suma=$suma+($cant*$tar);
					$cont=$cont+$cant;
				}
				$total=$suma;
				$totalG=$totalG+$total;
				if($total>0){
					$d_serv=$d_serv.strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"])))." => ".$cont.' = '.number_format($total+0, 2, ',', '.').'; ';
				}
			}
			//$totalG
		*/
/*
if($id_f!='0'){
	$consult=" and id_franq='$id_f'";
}else{
	$consult=" and (id_franq='1'";
}
*/
		
		$d_f_pago='';
		$dato=lectura($acceso,"SELECT *FROM tipo_pago");
			for($k=0;$k<count($dato);$k++){
				$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
				//echo "<br>SELECT sum(monto_pago) as monto_pago FROM vista_tipopago where fecha_pago='$fecha_pago' and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO' $consult";
				$acceso->objeto->ejecutarSql("SELECT sum(monto_pago) as monto_pago FROM vista_tipopago where fecha_pago='$fecha_pago' and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO' $consult");
				$suma=0;
				if($row=row($acceso))
				{
					$suma=$suma+trim($row["monto_pago"]);
				}
				$total=$suma;
				if($total>0){
					$d_f_pago=$d_f_pago.trim($dato[$k]["tipo_pago"]).' '.number_format($total+0, 2, ',', '.').'; ';
				}
			}
			
		
		$dato['@D_SERV@']=$d_serv;
		$dato['@D_F_PAGO@']=$d_f_pago;
		//echo ":$monto_pago:";
		$dato['@MONTO_ACUM_P@']=$monto_acum_p;
		$dato['@C_FACT_P@']=$cant_fact_p;
		
		return $dato;
	}
	public function obtenerSmsCierreDiario($acceso,$id_contrato,$id_cierre){
		session_start();
		$id_f = $_SESSION["id_franq"]; 
		if($id_f=='' or $id_f=='0'){
			$id_f='0';
			$nombre_franq='GENERAL';
		}
		else{
			$acceso->objeto->ejecutarSql("select *from franquicia where id_franq='$id_f' ");
			if($con=$acceso->objeto->devolverRegistro()){
				$nombre_franq=trim($con["nombre_franq"]);
			}
			$consult=" and id_franq='$id_f'";
		}

		
		//$dato=$this->obtenerSmsCon($acceso,$id_contrato);
		$dato=array();
		$fecha_cierre=date("Y-m-d");
		//ECHO "ID_CIERRE:$id_cierre:";
		$acceso->objeto->ejecutarSql("select *from cirre_diario where id_cierre='$id_cierre' $consult");
		if($con=$acceso->objeto->devolverRegistro()){
			$fecha_cierre=trim($con["fecha_cierre"]);
			$hora_cierre=trim($con["hora_cierre"]);
			$monto_total=trim($con["monto_total"]);
		}
		
		
		
		$d_serv='';
		//include "../procesos.php";
		$dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
			 $totalG=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				$acceso->objeto->ejecutarSql("SELECT costo_cobro,cant_serv FROM vista_pago_ser where fecha_pago='$fecha_cierre' and id_serv='$id_serv' and status_pago='PAGADO' $consult");
				$suma=0;
				$cont=0;
				while ($row=row($acceso))
				{
					$cant=trim($row["cant_serv"]);
					$tar=trim($row["costo_cobro"]);
					$suma=$suma+($cant*$tar);
					$cont=$cont+$cant;
				}
				$total=$suma;
				$totalG=$totalG+$total;
				if($total>0){
					$d_serv=$d_serv.strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"])))." => ".$cont.' = '.number_format($total+0, 2, ',', '.').'; ';
				}
			}
			//$totalG
		
		
		$d_f_pago='';
		$dato=lectura($acceso,"SELECT *FROM tipo_pago");
			for($k=0;$k<count($dato);$k++){
				$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
				$acceso->objeto->ejecutarSql("SELECT monto_pago FROM vista_tipopago where fecha_pago='$fecha_cierre' and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO' $consult");
				$suma=0;
				while ($row=row($acceso))
				{
					$suma=$suma+trim($row["monto_pago"]);
				}
				$total=$suma;
				if($total>0){
					$d_f_pago=$d_f_pago.trim($dato[$k]["tipo_pago"]).' '.number_format($total+0, 2, ',', '.').'; ';
				}
			}
			
		
		//ECHO ":fecha_cierre:$fecha_cierre:";
		//echo ":$monto_pago:";
		$dato['@FRANQUICIA@']=$nombre_franq;
		$dato['@ID_CIERRE@']=$id_cierre;
		$dato['@F_CIERRE_C@']=$fecha_cierre;
		$dato['@HORA_CIERRE_C@']=$hora_cierre;
		$dato['@MONTO_TOTAL_C@']=$monto_total;
		$dato['@D_SERV@']=$d_serv;
		$dato['@D_F_PAGO@']=$d_f_pago;
		return $dato;
	}
	public function obtenerSmsCierreDiarioFecha($acceso,$fecha_cierre){
		//$dato=$this->obtenerSmsCon($acceso,$id_contrato);
		$dato=array();
		
		//ECHO "ID_CIERRE:$id_cierre:";
		$acceso->objeto->ejecutarSql("select *from cirre_diario where fecha_cierre='$fecha_cierre'");
		if($con=$acceso->objeto->devolverRegistro()){
			$fecha_cierre=trim($con["fecha_cierre"]);
			$hora_cierre=trim($con["hora_cierre"]);
			$monto_total=trim($con["monto_total"]);
		}
		
		
		$d_serv='';
		//$cable=conectar("Postgres",'localhost','postgres','123456','saeco');
		//include "../procesos.php";

		$dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
			 $totalG=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				$acceso->objeto->ejecutarSql("SELECT costo_cobro,cant_serv FROM vista_pago_ser where fecha_pago='$fecha_cierre' and id_serv='$id_serv' and status_pago='PAGADO'");
				$suma=0;
				$cont=0;
				while ($row=row($acceso))
				{
					$cant=trim($row["cant_serv"]);
					$tar=trim($row["costo_cobro"]);
					$suma=$suma+($cant*$tar);
					$cont=$cont+$cant;
				}
				$total=$suma;
				$totalG=$totalG+$total;
				if($total>0){
					$d_serv=$d_serv.strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"])))." => ".$cont.' = '.number_format($total+0, 2, ',', '.').'; ';
				}
			}
			//$totalG
		
		
		$d_f_pago='';
		$dato=lectura($acceso,"SELECT *FROM tipo_pago");
			for($k=0;$k<count($dato);$k++){
				$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
				$acceso->objeto->ejecutarSql("SELECT monto_pago FROM vista_tipopago where fecha_pago='$fecha_cierre' and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'");
				$suma=0;
				while ($row=row($acceso))
				{
					$suma=$suma+trim($row["monto_pago"]);
				}
				$total=$suma;
				if($total>0){
					$d_f_pago=$d_f_pago.trim($dato[$k]["tipo_pago"]).' '.number_format($total+0, 2, ',', '.').'; ';
				}
			}
			
			
		//ECHO ":fecha_cierre:$fecha_cierre:";
		//echo ":$monto_pago:";
		$dato['@ID_CIERRE@']=$id_cierre;
		$dato['@F_CIERRE_C@']=$fecha_cierre;
		$dato['@HORA_CIERRE_C@']=$hora_cierre;
		$dato['@MONTO_TOTAL_C@']=$monto_total;
		$dato['@D_SERV@']=$d_serv;
		$dato['@D_F_PAGO@']=$d_f_pago;
		return $dato;
	}
	public function obtenerSmsResAdm($acceso,$fecha_cierre){
		$dato=array();
		
		//ECHO "ID_CIERRE:$id_cierre:";
		$acceso->objeto->ejecutarSql("select *from cirre_diario where fecha_cierre='$fecha_cierre'");
		if($con=$acceso->objeto->devolverRegistro()){
			$fecha_cierre=trim($con["fecha_cierre"]);
			$hora_cierre=trim($con["hora_cierre"]);
			$monto_total=trim($con["monto_total"]);
		}
	
		$dato['@ID_CIERRE@']=$id_cierre;
		$dato['@F_CIERRE_C@']=$fecha_cierre;
		$dato['@HORA_CIERRE_C@']=$hora_cierre;
		$dato['@MONTO_TOTAL_C@']=$monto_total;
		return $dato;
	}
	public function isMovil($oper,$operadora){
		for($i=0;$i<count($oper);$i++){
			if($oper[$i]==$operadora){
				return true;
			}
		}
		return false;
	}
	
	public function EnviarSMSUnico($acceso,$numero,$sms_r,$id_contrato){
		
		$acceso->objeto->ejecutarSql("select *from config_sms where id_franq='1'");
		if($con=$acceso->objeto->devolverRegistro()){
			$cod_telf_pais="+".trim($con["cod_telf_pais"]);
			$id_canal_sms=trim($con["id_canal_sms"]);
			$per_telf_fijo=trim($con["per_telf_fijo"]);
			$env_todos_telf=trim($con["env_todos_telf"]);
			$cod_ope_movil=trim($con["cod_ope_movil"]);
			$telefono_serv=trim($con["telefono_serv"]);
			
		}
		//echo ":$per_telf_fijo:$env_todos_telf:$cod_ope_movil:";
		$oper=explode(";",$cod_ope_movil);
		for($i=0;$i<count($oper);$i++){
			if(strlen($oper[$i])>3){
				$oper[$i]=trim($oper[$i]);
			}
		}
		
		if(strlen($oper[0])>3){
			//echo "entro";
			$dig=strlen($oper[0]);
		}
	/*
		
		$objConstants = new COM ( "AxSmsServer.Constants" );
	   $objMessageDB = new COM ( "AxSmsServer.MessageDB" );
	   $objMessageDB->Open ();
	   if ( $objMessageDB->LastError <> 0 )
	   {
	      $ErrorDes = $objMessageDB->GetErrorDescription ( $objMessageDB->LastError );
	      die ( $ErrorDes );
	   }
	   */
		$tel=explode(";",$numero);
		//echo "::$numero:::$sms_r::";
		$primer_movil=false;
		
	  for($i=0;$i<count($tel);$i++){
		$disponible=false;
		$telefono_r=$tel[$i];
		
		if($id_contrato==''){
			//echo "select contrato.id_contrato from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and (persona.telefono='$telefono_r' or cliente.telf_casa='$telefono_r' or cliente.telf_adic='$telefono_r')";
			$acceso->objeto->ejecutarSql("select contrato.id_contrato from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and (persona.telefono='$telefono_r' or cliente.telf_casa='$telefono_r' or cliente.telf_adic='$telefono_r')");
			if($con=$acceso->objeto->devolverRegistro()){
				$id_contrato=trim($con["id_contrato"]);
			}
		}
		$operadora=substr($telefono_r , 0,$dig);
		$movil=$this->isMovil($oper,$operadora);
		
		if($per_telf_fijo=="t" && $movil==false){
			$disponible=true;
		}
		if($env_todos_telf=="t" && $movil==true){
			$disponible=true;
		}
		if($env_todos_telf =="f" && $movil==true){
			if($primer_movil==false){
				$primer_movil=true;
				$disponible=true;
			}
		}
		if($disponible==true){
			$telefono_r=$cod_telf_pais.substr($telefono_r , 1,11);
			
			session_start();
	$ini_u = $_SESSION["ini_u"];  
	$acceso->objeto->ejecutarSql("select id_sinc from sms_sinc  where (id_sinc ILIKE '$ini_u%')   ORDER BY id_sinc desc LIMIT 1 offset 0 ");
	$id_sinc=$ini_u.verCoo($acceso,"id_sinc");

			//$cod_telf_pais="+".trim($con["cod_telf_pais"]);
			//$id_sinc="M".verNumero($acceso,"id_sinc");
			$sms_r=utf8_encode($sms_r);
			//echo "::insert into sms_sinc(id_sinc,mensaje_sinc,telefono_sinc,status_sinc) values ('$id_sinc','$sms_r','$telefono_r','FALSE')";
			//echo "<br>$i:$telefono_r:";
			if(strlen($telefono_r)>=13){
			
			$telefono_serv=$cod_telf_pais.substr($telefono_serv , 1,11);
				if($telefono_r!=$telefono_serv){
					
					
	
				//	$acceso->objeto->ejecutarSql("insert into sms_sinc(id_sinc,mensaje_sinc,telefono_sinc,status_sinc,tipo_sinc) values ('$id_sinc','$sms_r.','$telefono_r','FALSE','0')");
					
					$tipo='SUBMIT';
					$status='FALSE';
					$fecha=date("Y-m-d H:i:s");
					$hora=date("H:i:s");

					$mensaje=$sms_r;
					$mensaje=str_replace("'","''",$mensaje);
					if(strlen($telefono_r)==13){
						$telefono_r="0".substr($telefono_r , 3,13)  ;
					}
					//echo "insert into sms(id_contrato,nro_sms,tipo_sms,telefono_sms,fecha_sms,hora_sms,mensaje_sms,status_sms,login) values ('$id_contrato','','$tipo','$telefono_r','$fecha','$hora','$mensaje','$status','ADMIN')";
					
					
session_start();
$ini_u = $_SESSION["ini_u"];  
$acceso->objeto->ejecutarSql("select id_sms from sms  where (id_sms ILIKE '$ini_u%')   ORDER BY id_sms desc LIMIT 1 offset 0 ");
$id_sms=$ini_u.verCoo($acceso,"id_sms");

					$acceso->objeto->ejecutarSql("insert into sms(id_sms,id_contrato,nro_sms,tipo_sms,telefono_sms,fecha_sms,hora_sms,mensaje_sms,status_sms,login,status) values ('$id_sms','$id_contrato','','$tipo','$telefono_r','now()','now()','$mensaje','$status','ADMIN','TRUE')");
				}
			}

	  }//if permitir
	  }
	  return true; 
	}
	public function EnviarSMSUnicoLotes($acceso,$numero,$sms_r,$id_contrato){
		
		$acceso->objeto->ejecutarSql("select *from config_sms where id_franq='1'");
		if($con=$acceso->objeto->devolverRegistro()){
			$cod_telf_pais="+".trim($con["cod_telf_pais"]);
			$id_canal_sms=trim($con["id_canal_sms"]);
			$per_telf_fijo=trim($con["per_telf_fijo"]);
			$env_todos_telf=trim($con["env_todos_telf"]);
			$cod_ope_movil=trim($con["cod_ope_movil"]);
			$telefono_serv=trim($con["telefono_serv"]);
			
		}
		//echo ":$per_telf_fijo:$env_todos_telf:$cod_ope_movil:";
		$oper=explode(";",$cod_ope_movil);
		for($i=0;$i<count($oper);$i++){
			if(strlen($oper[$i])>3){
				$oper[$i]=trim($oper[$i]);
			}
		}
		
		if(strlen($oper[0])>3){
			//echo "entro";
			$dig=strlen($oper[0]);
		}
	/*
		
		$objConstants = new COM ( "AxSmsServer.Constants" );
	   $objMessageDB = new COM ( "AxSmsServer.MessageDB" );
	   $objMessageDB->Open ();
	   if ( $objMessageDB->LastError <> 0 )
	   {
	      $ErrorDes = $objMessageDB->GetErrorDescription ( $objMessageDB->LastError );
	      die ( $ErrorDes );
	   }
	   */
		$tel=explode(";",$numero);
		//echo "::$numero:::$sms_r::";
		$primer_movil=false;
		
	  for($i=0;$i<count($tel);$i++){
		$disponible=false;
		$telefono_r=$tel[$i];
		
		if($id_contrato==''){
			//echo "select contrato.id_contrato from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and (persona.telefono='$telefono_r' or cliente.telf_casa='$telefono_r' or cliente.telf_adic='$telefono_r')";
			$acceso->objeto->ejecutarSql("select contrato.id_contrato from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and (persona.telefono='$telefono_r' or cliente.telf_casa='$telefono_r' or cliente.telf_adic='$telefono_r')");
			if($con=$acceso->objeto->devolverRegistro()){
				$id_contrato=trim($con["id_contrato"]);
			}
		}
		$operadora=substr($telefono_r , 0,$dig);
		$movil=$this->isMovil($oper,$operadora);
		
		if($per_telf_fijo=="t" && $movil==false){
			$disponible=true;
		}
		if($env_todos_telf=="t" && $movil==true){
			$disponible=true;
		}
		if($env_todos_telf =="f" && $movil==true){
			if($primer_movil==false){
				$primer_movil=true;
				$disponible=true;
			}
		}
		if($disponible==true){
			$telefono_r=$cod_telf_pais.substr($telefono_r , 1,11);
			
			session_start();
	$ini_u = $_SESSION["ini_u"];  
	$acceso->objeto->ejecutarSql("select id_sinc from sms_sinc  where (id_sinc ILIKE '$ini_u%')   ORDER BY id_sinc desc LIMIT 1 offset 0 ");
	$id_sinc=$ini_u.verCoo($acceso,"id_sinc");

			//$cod_telf_pais="+".trim($con["cod_telf_pais"]);
			//$id_sinc="M".verNumero($acceso,"id_sinc");
			$sms_r=utf8_encode($sms_r);
			//echo "::insert into sms_sinc(id_sinc,mensaje_sinc,telefono_sinc,status_sinc) values ('$id_sinc','$sms_r','$telefono_r','FALSE')";
			//echo "<br>$i:$telefono_r:";
			if(strlen($telefono_r)>=13){
				$telefono_serv=$cod_telf_pais.substr($telefono_serv , 1,11);
				if($telefono_r!=$telefono_serv){
					//$acceso->objeto->ejecutarSql("insert into sms_sinc(id_sinc,mensaje_sinc,telefono_sinc,status_sinc,tipo_sinc) values ('$id_sinc','$sms_r.','$telefono_r','FALSE','5')");
					
					$tipo='SUBMIT';
					$status='FALSE';
					$fecha=date("Y-m-d");
					$hora=date("H:i:s");

					$mensaje=$sms_r;
					$mensaje=str_replace("'","''",$mensaje);
					if(strlen($telefono_r)==13){
						$telefono_r="0".substr($telefono_r , 3,13)  ;
					}
					//echo "insert into sms(id_contrato,nro_sms,tipo_sms,telefono_sms,fecha_sms,hora_sms,mensaje_sms,status_sms,login) values ('$id_contrato','','$tipo','$telefono_r','$fecha','$hora','$mensaje','$status','ADMIN')";
								
session_start();
$ini_u = $_SESSION["ini_u"];  
$acceso->objeto->ejecutarSql("select id_sms from sms  where (id_sms ILIKE '$ini_u%')   ORDER BY id_sms desc LIMIT 1 offset 0 ");
$id_sms=$ini_u.verCoo($acceso,"id_sms");

					$acceso->objeto->ejecutarSql("insert into sms(id_sms,id_contrato,nro_sms,tipo_sms,telefono_sms,fecha_sms,hora_sms,mensaje_sms,status_sms,login,status) values ('$id_sms','$id_contrato','','$tipo','$telefono_r','now()','now()','$mensaje','$status','ADMIN','TRUE')");
				}
			}

	  }//if permitir
	  }
	  return true; 
	}
	public function EnviarEmailUnico($acceso,$correo,$asunto,$mensaje)	{
	
			
	
session_start();
$ini_u = $_SESSION["ini_u"];  
$acceso->objeto->ejecutarSql("select  id_e_sinc from email_sinc  where (id_e_sinc ILIKE '$ini_u%')   ORDER BY id_e_sinc desc LIMIT 1 offset 0 ");
$id_e_sinc=$ini_u.verCoo($acceso,"id_e_sinc");

		$acceso->objeto->ejecutarSql("insert into email_sinc(id_e_sinc,mensaje_e_sinc,email_sinc,status_e_sinc) values ('$id_e_sinc','$mensaje','$correo','FALSE')");
		
	}
	public function ini_serv_email($acceso)	{
	
			
		$acceso->objeto->ejecutarSql("select * from email_sinc where status_e_sinc='FALSE' LIMIT 2 offset 0");
		if($acceso->objeto->registros>0){
			$acce=conexion();
			$acce->objeto->ejecutarSql("select *from config_sms where id_franq='1'");
			if($con=$acce->objeto->devolverRegistro()){
				$correo_emp=strtolower(trim($con["correo_emp"]));
				$clave_correo=strtolower(trim($con["clave_correo"]));
				$asunto_correo=trim($con["asunto_correo"]);
			}
			include "../include/phpmailer/class.phpmailer.php";
			$mail = new PHPMailer ();

			$mail -> From = $correo_emp;
			$mail -> FromName = $asunto_correo;
			$mail -> Subject = $asunto_correo;
			
			$mail -> IsHTML (true);

			$mail->IsSMTP();
			$mail->Host = 'ssl://smtp.gmail.com';
			$mail->Port = 465;
			$mail->SMTPAuth = true;
			$mail->Username = $correo_emp;
			$mail->Password = $clave_correo;
		}
		$i=0;
		while($con=$acceso->objeto->devolverRegistro()){
			$id_e_sinc=trim($con["id_e_sinc"]);
			$email_sinc=trim($con["email_sinc"]);
			$mensaje_e_sinc=trim($con["mensaje_e_sinc"]);
			
			$mail->Body = $mensaje_e_sinc;
			$email=explode(";",$email_sinc);
			for($i=0;$i<count($email);$i++){
				echo ":(".$email[$i].":".$mensaje_e_sinc."):";
				$mail -> AddAddress ($email[$i]);
				if(!$mail->Send()){
					echo 'Error AL ENVIAR CORREO: ' . $mail->ErrorInfo;
				}
				else {
					$acce->objeto->ejecutarSql("update email_sinc set status_e_sinc='TRUE' where id_e_sinc='$id_e_sinc'");
				}
			}
			
			$acceso->objeto->siguienteRegistro();
		}
			
	
		
		
		
	}
		public function listadoSMSEsp($acceso,$id_contrato)	{
	//	echo ":$id_contrato,$nro_sms,$tipo_sms:";
		$this->id_contrato = $id_contrato;
		
		
		$color_status_tel=array("READ"=>"fuente_sms","SENT"=>"fuente_sms","UNREAD"=>"fuente_sms_n");
		$color_status_sms=array("READ"=>"fuente_sms_corto","SENT"=>"fuente_sms_corto","UNREAD"=>"fuente_sms_corto_n");

		$color_sms=array("Todos"=>"tbl-row-odd","Sin Leer"=>"tbl-row-odd","Recibidos"=>"tbl-row-odd","Enviados"=>"tbl-row-odd");
		$color_sms[$tipo_sms]="tbl-row-sel";

		$acceso->objeto->ejecutarSql("select persona.nombre, persona.apellido, persona.telefono,cliente.telf_casa,cliente.telf_adic from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and contrato.id_contrato='$id_contrato'");
					if($con=$acceso->objeto->devolverRegistro()){
						$telefono_c=trim($con["telefono"]);
						$telf_casa=trim($con["telf_casa"]);
						$telf_adic=trim($con["telf_adic"]);
						$nombre=trim($con["apellido"])." ".trim($con["nombre"]);
					}
					$num_telef='';
					if($telefono_c!='' || $telf_casa!='' || $telf_adic!=''){
						if($telefono_c!=''){
							$num_telef=$telefono_c;
							if($telf_casa!=''){
							$num_telef=$num_telef.';'.$telf_casa;
							}
							if($telf_adic!=''){
							$num_telef=$num_telef.';'.$telf_adic;
							}
						}
						else if($telf_casa!=''){
							$num_telef=$telf_casa;
							if($telf_adic!=''){
								$num_telef=$num_telef.';'.$telf_adic;
							}
						}
						else {
							$num_telef=$telf_adic;
						}
					}
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_consultar_abonado" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<!--div class="border-head"><h3>Listado de Comunicación vía SMS</h3></div-->

	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<div class="panel-body">		
		
			
			<!--div id="envio_cont"-->

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<input class="form-control" align="left" type="text" name="telefono_sms" maxlength="50" style="width: 305px;" value="<?php echo $num_telef;?>" >
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label><i class="fa fa-edit label-blanco"></i></label>
					<textarea name="sms" class="form-control" rows="1" onKeyUp="cuenta_carac_cont();"></textarea>
				</div>
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<label>Caracteres:</label> <label id="cant_car">0</label>/<label id="cant_sms">1</label>							
				</div>

				

			<!--/div-->	
		
		</div> <!-- FIN DEL PANEL -->
	
	</section>
	<section class="panel">
	
		<div class="panel-body">
		
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="left">
			<input class="btn btn-success" type="button" name="enviar" value="Enviar" onclick="enviar_SMS_cont();">
		</div>
		
		</div> <!-- FIN DEL PANEL --> 		
	
	</section>
	
	</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->
		
			
				<?php
				
					$bgc=array("0"=>"FFFFFF","1"=>"F7F7F7");
					
					if($id_contrato!=''){
					//echo "select *from sms $where";
					
					$acceso->objeto->ejecutarSql("select * from sms where id_contrato='$id_contrato' order by fecha_sms desc, hora_sms desc");
					$fill=1;
					while ($row = $acceso->objeto->devolverRegistro()){
						$fill=!$fill;
						$id_sms=trim($row['id_sms']);
						$id=trim($row['nro_sms']);
						$id_cont=trim($row['id_contrato']);
						$tipo=trim($row['tipo_sms']);
						$status=trim($row['status_sms']);
						$telefono=trim($row['telefono_sms']);
						$fecha=trim($row['fecha_sms']);
						$hora=trim($row['hora_sms']);
						$mensaje=trim($row['mensaje_sms']);
						
						//if(strstr($tel_r,$telefono)){
						
					if($tipo=="DELIVER"){
				?>
				<div id="sms_rec_cont"><?php echo $mensaje;?></div></td>
				<span class="fuente_sms_corto"><?php echo $telefono." &nbsp; &nbsp; &nbsp; ".form_fec($fecha)." ".$hora;?></span>
				<?php
					}
					else if($tipo=="SUBMIT"){
				?>
				<div id="sms_env_cont"><?php echo $mensaje;?></div>
				<span class="fuente_sms_corto"><?php echo form_fec($fecha)." ".$hora." &nbsp; &nbsp; &nbsp; ".$telefono;?></span>
				
				<?php
					}
						
						$acceso->objeto->siguienteRegistro();
					}
				//	$acceso->objeto->ejecutarSql("Update sms Set status_sms='READ' $where and tipo_sms='DELIVER'");
				}
				?>


<?php
	}
	public function mostrarSMSEsp($acceso,$id_contrato,$nro_sms,$tipo_sms,$pagina){
	
				
	
	//	echo ":$id_contrato,$nro_sms,$tipo_sms:";
		$this->id_contrato = $id_contrato;
		$this->nro_sms = $nro_sms;
		$this->tipo_sms = $tipo_sms;

		if($tipo_sms==''){
			$tipo_sms='Todos';
		}
		
		$color_status_tel=array("READ"=>"fuente_sms","SENT"=>"fuente_sms","UNREAD"=>"fuente_sms_n");
		$color_status_sms=array("READ"=>"fuente_sms_corto","SENT"=>"fuente_sms_corto","UNREAD"=>"fuente_sms_corto_n");

		$color_sms=array("Todos"=>"tbl-row-odd","Sin Leer"=>"tbl-row-odd","Recibidos"=>"tbl-row-odd","Enviados"=>"tbl-row-odd");
		$color_sms[$tipo_sms]="tbl-row-sel";
		
		//echo "select persona.nombre, persona.apellido, persona.telefono,cliente.telf_casa,cliente.telf_adic from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and contrato.id_contrato='$id_contrato'";
		
				if($this->nro_sms==''){
						$nombre="";
				}
				else{
				//	echo ":$this->nro_sms:";
					$acceso->objeto->ejecutarSql("select id_contrato,telefono_sms from sms where id_sms='$this->nro_sms'");
					if($con=$acceso->objeto->devolverRegistro()){
						$telefono_sms=trim($con["telefono_sms"]);
					//	echo ":$telefono_sms:";
					}
					
					$acceso->objeto->ejecutarSql("select id_contrato,persona.nombre, persona.apellido, persona.telefono,cliente.telf_casa,cliente.telf_adic,contrato.nro_contrato from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and 
					(persona.telefono='$telefono_sms' or cliente.telf_casa='$telefono_sms' or cliente.telf_adic='$telefono_sms')
					");
					if($con=$acceso->objeto->devolverRegistro()){
							$id_contrato=trim($con["id_contrato"]);
							$telefono_c=trim($con["telefono"]);
							$telf_casa=trim($con["telf_casa"]);
							$telf_adic=trim($con["telf_adic"]);
							$nro_contrato=trim($con["nro_contrato"]);
							$nombre='<a href="javascript:RESPREFACT_CONT(\''.$id_contrato.'\');"">'. $nro_contrato." ".trim($con["apellido"])." ".trim($con["nombre"]) .'</a>';
					}
					else{
						$telefono_c=$telefono_sms;
						$nombre="Numero Desconocido";
					}
					
				}	
					

?>
		<form name="f1" >
<table border="0" width="780px" align="CENTER">
		<tr>
			<td valign="center"  class="tit_sms"><div id="t_mensaje" >&nbsp;<?php echo _("mensajes");?></div></td>
			<td valign="center"  class="tit_sms"><div id="t_listado">&nbsp;<?php echo strtoupper($tipo_sms);?></div></td>
			<td valign="center"  class="tit_sms"><div id="t_detalle">&nbsp;<?php echo strtoupper($nombre);?></div></td>
		</tr>
		<tr>
			<td><div id="mensaje">
			<table border="0" width="100%" align="CENTER" cellspacing="5">
				<tr class="<?php echo $color_sms['Todos'];?> tbl-row-highlight" onclick="conexionPHP_sms('sms.php','mostrarSMSEsp','=@=@Todos')">
					<td class="fuente_sms" ><img src="imagenes/mensajes.jpg" width="15px" height="14">&nbsp;&nbsp;<?php echo _("todos");?></td>
				</tr>
				<tr class="<?php echo $color_sms['Sin Leer'];?> tbl-row-highlight" onclick="conexionPHP_sms('sms.php','mostrarSMSEsp','=@=@Sin Leer')">
					<td class="fuente_sms" ><img src="imagenes/sin_leer_sms.jpg" width="15px" height="13">&nbsp;&nbsp;<?php echo _("sin leer");?></td>
				</tr>
				<tr class="<?php echo $color_sms['Recibidos'];?> tbl-row-highlight" onclick="conexionPHP_sms('sms.php','mostrarSMSEsp','=@=@Recibidos')">
					<td class="fuente_sms" ><img src="imagenes/entrada_sms.jpg" width="15px" height="14">&nbsp;&nbsp;<?php echo _("recibidos");?></td>
				</tr>
				<tr class="<?php echo $color_sms['Enviados'];?> tbl-row-highlight" onclick="conexionPHP_sms('sms.php','mostrarSMSEsp','=@=@Enviados')">
					<td class="fuente_sms" ><img src="imagenes/enviado_sms.jpg" width="15px" height="14">&nbsp;&nbsp;<?php echo _("enviados");?></td>
				</tr>
			</table>
			</div></td>
			<td><div id="listado">
			<table border="0" width="100%" align="CENTER">
				<?php
					$img_sms=array("DELIVERREAD"=>'<img src="imagenes/entrada_sms.jpg" width="15px" height="14">',"DELIVERUNREAD"=>'<img src="imagenes/sin_leer_sms.jpg" width="15px" height="13">',"SUBMITSENT"=>'<img src="imagenes/enviado_sms.jpg" width="15px" height="14">');
				//	$bgc=array("0"=>"tbl-row-even","1"=>"tbl-row-odd");
					

					//$acceso->objeto->ejecutarSql("select  from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and ((telefono ILIKE '%$telefono%') or (telf_casa ILIKE '%$telefono%') or (telf_adic ILIKE '%$telefono%'))");
					
					$where='';
					if($tipo_sms=='Sin Leer'){
						$where=" where tipo_sms='DELIVER' and status_sms='UNREAD'";
					}
					else if($tipo_sms=='Recibidos'){
						$where=" where tipo_sms='DELIVER'";
					}
					else if($tipo_sms=='Enviados'){
						$where=" where tipo_sms='SUBMIT' and status_sms='SENT'";
					}
					
					//$results = $db->query("SELECT * FROM sms_data");
					//echo "select  *from sms $where";
				//	echo "select  *from sms $where order by fecha_sms desc, hora_sms desc  limit 0 offset 100";
					$acceso->objeto->ejecutarSql("select  id_sms from sms $where order by fecha_sms desc, hora_sms desc ");
					$numeroRegistros=$acceso->objeto->registros;
						
					//echo ":$numeroRegistros:";
					/************************************/
					
				$tamPag=100;
				if(!isset($pagina))
				{
				   $pagina=1;
				   $inicio=1;
				   $final=$tamPag;
				}
				//calculo del limite inferior
				$limitInf=($pagina-1)*$tamPag;

				//calculo del numero de paginas
				$numPags=ceil($numeroRegistros/$tamPag);
				if(!isset($pagina))
				{
				   $pagina=1;
				   $inicio=1;
				   $final=$tamPag;
				}else{
				   $seccionActual=intval(($pagina-1)/$tamPag);
				   $inicio=($seccionActual*$tamPag)+1;

				   if($pagina<$numPags)
				   {
					  $final=$inicio+$tamPag-1;
				   }else{
					  $final=$numPags;
				   }

				   if ($final>$numPags){
					  $final=$numPags;
				   }
				} 
					
					/************************************/
					
					
					$acceso->objeto->ejecutarSql("select  id_sms,id_contrato,tipo_sms,status_sms,telefono_sms,fecha_sms,hora_sms,mensaje_sms    from sms $where order by fecha_sms desc, hora_sms desc  limit $tamPag offset $limitInf ");
					
					$fill=1;
					while ($row = $acceso->objeto->devolverRegistro()){
						
						$fill=!$fill;
						$id=trim($row['id_sms']);
						$id_cont=trim($row['id_contrato']);
						$tipo=trim($row['tipo_sms']);$status=trim($row['status_sms']);
						$telefono=trim($row['telefono_sms']);
						$fecha=trim($row['fecha_sms']);
						$hora=trim($row['hora_sms']);
						$mensaje=trim($row['mensaje_sms']);
						if($nro_sms==$id){
							$bgc[$fill]="tbl-row-sel";
							//echo $bgc[$fill];
						}
						else{
							$bgc=array("0"=>"tbl-row-even","1"=>"tbl-row-odd");
						}
						if(strlen($mensaje)>30){
							$mensaje=substr($mensaje,0,28)."...";
						}
						//echo ":$bgc[$fill];:";
				?>
				<tr class="<?php echo $bgc[$fill];?> tbl-row-highlight" onclick="conexionPHP_sms('sms.php','mostrarSMSEsp','<?php echo $id_cont;?>=@<?php echo $id;?>=@<?php echo $tipo_sms;?>')">
					<td  width="10%" valign="center"><?php echo $img_sms[$tipo.''.$status];?></td>
					<td ><span class="<?php echo $color_status_tel[$status];?>"><?php echo $telefono;?></span><span class="<?php echo $color_status_sms[$status];?>"><br><?php echo $mensaje;?></span></td>
					<td  width="20%" valign="top" align="right"><span class="fuente_sms_corto"><?php echo form_fec($fecha);?></span></td>
					
				</tr>
				<?php
						$acceso->objeto->siguienteRegistro();
					}//while
					$cade='<div align="center">';
					
					$image_path="include/eyedatagrid/images/";
					$derIzq=3;
					 
				//	$cade=$cade. 'Total SMS [  ' . $numeroRegistros . ' ] <br>';
					
					
					if($pagina>1)
					{
						$pag=$pagina-1;
						$cade=$cade.'<a href="javascript:;" onclick="conexionPHP_sms(\'sms.php\',\'mostrarSMSEsp\',\''.$id_cont.'=@'.$id.'=@'.$tipo_sms.'=@1\')"><img src="' . $image_path . 'arrow_first.gif" class="tbl-arrows" alt="&lt;&lt;" title="'._("primera Pagina").'"></a><a href="javascript:;" onclick="conexionPHP_sms(\'sms.php\',\'mostrarSMSEsp\',\''.$id_cont.'=@'.$id.'=@'.$tipo_sms.'=@'.$pag.'\')"><img src="' . $image_path . 'arrow_left.gif" class="tbl-arrows" alt="&lt;" title="'._("Pagina anterior").'"></a>';
						   
					}
					else{
						$cade=$cade. '<img src="' . $image_path . 'arrow_first_disabled.gif" class="tbl-arrows" alt="&lt;&lt;" title="'._("primera Pagina").'"><img src="' . $image_path . 'arrow_left_disabled.gif" class="tbl-arrows" alt="&lt;" title="'._("Pagina anterior").'">';
					}
					
					 
					if($pagina > $derIzq)
						$startpage =$pagina - $derIzq;
					else
						$startpage = 1;
			
					
					if(($numPags - $derIzq) > $pagina)
						$endpage = $pagina + $derIzq;
					else
						$endpage = $numPags;
					
					
					for ($i = $startpage; $i <= $endpage; $i++)
					{
					   if($i==$pagina)
					   {
						   $cade=$cade. '&nbsp;<span class="page-selected">' . $i . '</span>&nbsp;';
					   }else{
						  $cade=$cade. '&nbsp;<a href="javascript:;"  onclick="conexionPHP_sms(\'sms.php\',\'mostrarSMSEsp\',\''.$id_cont.'=@'.$id.'=@'.$tipo_sms.'=@'.$i.'\')">' . $i . '</a>&nbsp;';
					   }
					}
					if($pagina<$numPags)
				   {
						$pag=$pagina+1;
					   $cade=$cade. '<a href="javascript:;" onclick="conexionPHP_sms(\'sms.php\',\'mostrarSMSEsp\',\''.$id_cont.'=@'.$id.'=@'.$tipo_sms.'=@'.$pag.'\')"><img src="' . $image_path . 'arrow_right.gif" class="tbl-arrows" alt="&gt;" title="'._("Pagina siguiente").'"></a> <a href="javascript:;" onclick="conexionPHP_sms(\'sms.php\',\'mostrarSMSEsp\',\''.$id_cont.'=@'.$id.'=@'.$tipo_sms.'=@'.$numPags.'\')"><img src="' . $image_path . 'arrow_last.gif" class="tbl-arrows" alt="&gt;&gt;" title="'._("ultima Pagina").'"></a>';
				   } 
				   else{
						$cade=$cade. '<img src="' . $image_path . 'arrow_right_disabled.gif" class="tbl-arrows" alt="&gt;" title="'._("Pagina siguiente").'"><img src="' . $image_path . 'arrow_last_disabled.gif" class="tbl-arrows" alt="&gt;&gt;" title="'._("ultima Pagina").'">';
				   }
				   
				   		
				   $cade=$cade. '</div >';
				   
				   
   
   
   
					
					$num_telef='';
					$where='';
					if($telefono_c!='' || $telf_casa!='' || $telf_adic!=''){
						$where=$where.' where ';
						if($telefono_c!=''){
							$where=$where." (telefono_sms ILIKE '%$telefono_c%')";
							$num_telef=$telefono_c;
							if($telf_casa!=''){
							$where=$where." or (telefono_sms ILIKE '%$telf_casa%')";
							$num_telef=$num_telef.';'.$telf_casa;
							}
							if($telf_adic!=''){
							$where=$where." or (telefono_sms ILIKE '%$telf_adic%')";
							$num_telef=$num_telef.';'.$telf_adic;
							}
						}
						else if($telf_casa!=''){
							$where=$where." (telefono_sms ILIKE '%$telf_casa%')";
							$num_telef=$telf_casa;
							if($telf_adic!=''){
								$where=$where." or (telefono_sms ILIKE '%$telf_adic%')";
								$num_telef=$num_telef.';'.$telf_adic;
							}
						}
						else {
							$where=$where."(telefono_sms ILIKE '%$telf_adic%')";
							$num_telef=$telf_adic;
						}
					}
				?>
			</table>
			
			
			
			
			</div>
			<?php echo $cade;?>
			</td>
			<td>
			<div id="envio">
				<table border="0" width="100%" align="CENTER" valign="top">
				<tr>
					<td>
						<input class="sms_envio" align="left" type="text" name="telefono" maxlength="50" style="width: 305px;" value="<?php echo $num_telef;?>" >
					</td>
				</tr>
				<tr>
					<td >
						<textarea class="sms_envio" name="sms" style="width: 305px;" rows="1"></textarea>
					</td>
				</tr>
				<tr>
					<td align="right">
						<input  type="button" name="enviar" value="<?php echo _("enviar");?>" onclick="enviar_SMS()">&nbsp;
						<input align="right"  type="button" name="Limpiar" value="<?php echo _("limpiar");?>" onclick="">&nbsp;
					</td>
				</tr>
				</table>
			</div>
			<div id="detalle">
			
			<table border="0" width="100%" align="CENTER" >
				<tr>
					<td >
						
						
					</td>
				</tr>
				<tr>
					<td align="right">
						
					</td>
				</tr>
				
				<?php
				
				
					$bgc=array("0"=>"FFFFFF","1"=>"F7F7F7");
					
					if($where!=''){
			//		echo "select *from sms $where order by fecha_sms id_sms desc";
					
					$acceso->objeto->ejecutarSql("select *from sms $where order by fecha_sms desc, hora_sms desc");
					$fill=1;
					while ($row = $acceso->objeto->devolverRegistro()){
						$fill=!$fill;
						$id_sms=trim($row['id_sms']);
						$id=trim($row['nro_sms']);
						$id_cont=trim($row['id_contrato']);
						$tipo=trim($row['tipo_sms']);
						$status=trim($row['status_sms']);
						$telefono=trim($row['telefono_sms']);
						$fecha=trim($row['fecha_sms']);
						$hora=trim($row['hora_sms']);
						$mensaje=trim($row['mensaje_sms']);
						
						//if(strstr($tel_r,$telefono)){
						
							if($tipo=="DELIVER"){
				?>
				<tr>
					<td ><div id="sms_rec"><?php echo $mensaje;?></div></td>
				</tr>
				<tr>
					<td align="left"><span class="fuente_sms_corto"><?php echo $telefono." &nbsp; &nbsp; &nbsp; ".form_fec($fecha)." ".$hora;?></span></td>
				</tr>
				<?php
					}
					else if($tipo=="SUBMIT"){
				?>
				<tr>
					<td ><div id="sms_env"><?php echo $mensaje;?></div></td>
				</tr>
				<tr>
					<td align="right"><span class="fuente_sms_corto"><?php echo form_fec($fecha)." ".$hora." &nbsp; &nbsp; &nbsp; ".$telefono;?></span></td>
				</tr>
				<?php
					}
						
						$acceso->objeto->siguienteRegistro();
					}
					$acceso->objeto->ejecutarSql("Update sms Set status_sms='READ' $where and tipo_sms='DELIVER'");
				}
				?>

			</table>
			</div></td>
		</tr>
</table>
</form>
<?php
	}
	public function ini_serv_sms($acceso,$valor){
		$id_conf_sms = $valor[1];
		$cod_telf_pais = $valor[2];
		$telefono_serv = $valor[3];
		$puerto = $valor[4];
		$conex = $valor[5];
		$bits = $valor[6];
		$marca = $valor[7];
		$modelo = $valor[8];
		//echo "Update config_sms Set cod_telf_pais='$cod_telf_pais', telefono_serv='$telefono_serv', puerto='$puerto', conex='$conex', bits='$bits', marca='$marca', modelo='$modelo' Where id_conf_sms='$id_conf_sms'";
		$acceso->objeto->ejecutarSql("Update config_sms Set cod_telf_pais='$cod_telf_pais', telefono_serv='$telefono_serv', puerto='$puerto', conex='$conex', bits='$bits', marca='$marca', modelo='$modelo' , encendido='2' Where id_conf_sms='$id_conf_sms'");
		$this->sincronizarTelf($acceso);
		//exec('java -jar "C:\saecosms\SaecoSMS.jar" > txt.txt');
		//echo "ejecuto java";
		echo '<span id="status_serv" class="cabe noconectado">STATUS: DESCONECTADO<span>';
	}
	public function det_serv_sms($acceso){
		$acceso->objeto->ejecutarSql("Update config_sms Set encendido='0'");
		echo '<span id="status_serv" class="cabe noconectado">STATUS: DESCONECTADO<span>';
	}
	public function sincronizarTelf($acceso){
		/*$acceso->objeto->ejecutarSql("select ruta_archivo from config_sms where id_franq='1'");
		if($con=$acceso->objeto->devolverRegistro()){
			$this->ruta=trim($con["ruta_archivo"]);
		}
		*/
		$db = new SQLite3($this->ruta);
		//$results = $db->query("SELECT * FROM sms_data order by uid desc LIMIT 50 OFFSET 0 ");
		$results = $db->query("SELECT * FROM sms_data");
		//echo "entro a sincronizar";
		while($row = getDato($results)){
			$id=$row['id'];
			$acceso->objeto->ejecutarSql("select nro_sms from sms where nro_sms='$id'");
			if($acceso->objeto->registros<=0){
				$telefono=trim($row['telefono']);
				if(strlen($telefono)==13){
					$telefono="0".substr($telefono , 3,13);
				}
				//echo "\nselect persona.apellido,persona.nombre,contrato.id_contrato from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and ((telefono ILIKE '%$telefono%') or (telf_casa ILIKE '%$telefono%') or (telf_adic ILIKE '%$telefono%'))";
				$acceso->objeto->ejecutarSql("select persona.apellido,persona.nombre,contrato.id_contrato from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and ((telefono ILIKE '%$telefono%') or (telf_casa ILIKE '%$telefono%') or (telf_adic ILIKE '%$telefono%'))");
				if($con=$acceso->objeto->devolverRegistro()){
					//echo "enrto";
					$id_contrato=trim($con["id_contrato"]);
					$nombre=trim($con["nombre"]);
					$apellido=trim($con["apellido"]);
				}
				else{
					$id_contrato="CO00000000";
					$nombre="Desconocido";
					$apellido="Numero";
				}
					$tipo=$row['tipo'];
					$status=$row['status'];
					
					$fecha=$row['fecha'];
					$hora=$row['hora'];
					$mensaje=utf8_encode(trim($row['mensaje']));
					$mensaje=str_replace("'","''",$mensaje);

					//echo "insert into sms(id_contrato,nro_sms,tipo_sms,telefono_sms,fecha_sms,hora_sms,mensaje_sms,status_sms,login) values ('$id_contrato','$id','$tipo','$telefono','$fecha','$hora','$mensaje','$status','ADMIN');";
					
session_start();
$ini_u = $_SESSION["ini_u"];  
$acceso->objeto->ejecutarSql("select id_sms from sms  where (id_sms ILIKE '$ini_u%')   ORDER BY id_sms desc LIMIT 1 offset 0 ");
$id_sms=$ini_u.verCoo($acceso,"id_sms");

					$acceso->objeto->ejecutarSql("insert into sms(id_sms,id_contrato,nro_sms,tipo_sms,telefono_sms,fecha_sms,hora_sms,mensaje_sms,status_sms,login,status) values ('$id_sms','$id_contrato','$id','$tipo','$telefono','$fecha','$hora','$mensaje','$status','ADMIN','FALSE')");
			}
		}
		/*$acceso->objeto->ejecutarSql("select ruta_archivo from config_sms where id_franq='1'");
		if($con=$acceso->objeto->devolverRegistro()){
			$this->ruta=trim($con["ruta_archivo"]);
		}
		*/
		$db = new SQLite3($this->ruta);
		$results = $db->query('SELECT count(*) FROM sms_data');
		$row = $results->fetchArray();
		$_SESSION["cant_sms"]=trim($row[0]);
		
		
	}
	public function consultaSMS($acceso){
		$acceso->objeto->ejecutarSql("select nro_sms from sms where tipo_sms='DELIVER' ORDER BY nro_sms desc LIMIT 1 offset 0 ");
		if($con=$acceso->objeto->devolverRegistro())
		{
			$nro_sms=trim($con["nro_sms"]);
		}
		//echo ";$nro_sms;";
		$nro_sms1=substr($nro_sms , -8);
		$nro_sms2=substr($nro_sms ,0, -8);
		$nro_sms1++;
		//echo ":$nro_sms2./.$nro_sms1;:";
		//$nro_sms1++;

		$nro_sms=$nro_sms2."".$nro_sms1;
		/*$acceso->objeto->ejecutarSql("select ruta_archivo from config_sms where id_franq='1'");
		if($con=$acceso->objeto->devolverRegistro()){
			$this->ruta=trim($con["ruta_archivo"]);
		}
		*/
			$db = new SQLite3($this->ruta);
			$results = $db->query('SELECT count(*) FROM sms_data');
			$row = $results->fetchArray();
			$cant_sms_act=trim($row[0]);
			$db->close();
			//echo "<br>$i;".$cant_sms_act."!=".$_SESSION["cant_sms"]."||";
			/*if($_SESSION["activo_sms"]=="Off"){
				break;
			}
			else
			*/
			//echo "$cant_sms_act:".$_SESSION['cant_sms'].":$nro_sms:";
			if($cant_sms_act!=$_SESSION["cant_sms"]){
		
			$_SESSION["cant_sms"]=$_SESSION["cant_sms"]+1;
		

		
		/*$acceso->objeto->ejecutarSql("select ruta_archivo from config_sms where id_franq='1'");
		if($con=$acceso->objeto->devolverRegistro()){
			$this->ruta=trim($con["ruta_archivo"]);
		}
		*/

		$db = new SQLite3($this->ruta);
		$results = $db->query("SELECT * FROM sms_data where uid='$nro_sms'");

		$i=0;
		if($row = getDato($results)){
			$encontrado=true;
			$comando=false;
			$id=$row['id'];
			//echo "<$id>";
			//echo "esta";
			$acceso->objeto->ejecutarSql("select nro_sms from sms where nro_sms='$id'");
			if($acceso->objeto->registros<=0){
				//echo "no esta registrado";
				$telefono=$row['telefono'];
				
				//echo "<".strlen($telefono).">:$telefono:";
				if(strlen($telefono)==13){
					$telefono="0".substr($telefono , 3,13);
				}
				//echo "<>:$telefono:";
				$acceso->objeto->ejecutarSql("select persona.apellido,persona.nombre,contrato.id_contrato from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and ((telefono ILIKE '%$telefono%') or (telf_casa ILIKE '%$telefono%') or (telf_adic ILIKE '%$telefono%'))");
				if($con=$acceso->objeto->devolverRegistro()){
					//echo "enrto";
					$id_contrato=trim($con["id_contrato"]);
					$nombre=trim($con["nombre"]);
					$apellido=trim($con["apellido"]);
				}
				else{
					$id_contrato="CO00000000";
					$nombre="Desconocido";
					$apellido="Numero";
				}
					
					$mensaje=trim($row['mensaje']);
					$tipo=$row['tipo'];
					$status=$row['status'];
					$fecha=$row['fecha'];
					$hora=$row['hora'];
					
					
					$mensaje=utf8_encode(trim($row['mensaje']));
					$mensaje=str_replace("'","''",$mensaje);
					
session_start();
$ini_u = $_SESSION["ini_u"];  
$acceso->objeto->ejecutarSql("select id_sms from sms  where (id_sms ILIKE '$ini_u%')   ORDER BY id_sms desc LIMIT 1 offset 0 ");
$id_sms=$ini_u.verCoo($acceso,"id_sms");

					$acceso->objeto->ejecutarSql("insert into sms(id_sms,id_contrato,nro_sms,tipo_sms,telefono_sms,fecha_sms,hora_sms,mensaje_sms,status_sms,login,status) values ('$id_sms','$id_contrato','$id','$tipo','$telefono','$fecha','$hora','$mensaje','$status','ADMIN','FALSE')");

				//	$comando=$this->verificaComando($acceso,$id_contrato,$telefono,$mensaje,$id);
					
			}
			
		}
		else{
			$this->sincronizarTelf($acceso);
		}
			
		
		}
		else{
			
		}
		
		$this->procesarConsulta($acceso);

		
		$status=array("1"=>_("CONECTADO"),"0"=>_("DESCONECTADO"),"2"=>_("CONECTANDO..."),"3"=>_("POR CONECTAR"));
				$status_color=array("1"=>"conectado","0"=>"noconectado","2"=>"conectando","3"=>"porconectar");
			$acceso->objeto->ejecutarSql("select encendido from config_sms where id_franq='1'");
			if($con=$acceso->objeto->devolverRegistro()){
				$encendido=trim($con["encendido"]);
				echo "-Class-$encendido-Class-".'<span id="status_serv" class="cabe '.$status_color[$encendido].'">STATUS: '.$status[$encendido].'<span>';
			}
			
	}
	
	
	
	
		public function recibirSMS($acceso)	{
		$acceso->objeto->ejecutarSql("select nro_sms from sms where tipo_sms='DELIVER' ORDER BY nro_sms desc LIMIT 1 offset 0 ");
		if($con=$acceso->objeto->devolverRegistro())
		{
			$nro_sms=trim($con["nro_sms"]);
		}
		$nro_sms1=substr($nro_sms , -2);
		$nro_sms2=substr($nro_sms ,0, -2);
		$nro_sms1++;

		//$nro_sms1++;

		$nro_sms=$nro_sms2."".$nro_sms1;
			/*$acceso->objeto->ejecutarSql("select ruta_archivo from config_sms where id_franq='1'");
		if($con=$acceso->objeto->devolverRegistro()){
			$this->ruta=trim($con["ruta_archivo"]);
		}
		*/
			$db = new SQLite3($this->ruta);
			$results = $db->query('SELECT count(*) FROM sms_data');
			$row = $results->fetchArray();
			$cant_sms_act=trim($row[0]);
			$db->close();
			//echo "<br>$i;".$cant_sms_act."!=".$_SESSION["cant_sms"]."||";
			/*if($_SESSION["activo_sms"]=="Off"){
				break;
			}
			else 
			*/
			//echo "$cant_sms_act:".$_SESSION['cant_sms'].":$nro_sms:";
			if($cant_sms_act!=$_SESSION["cant_sms"]){
		if($cant_sms_act!=$_SESSION["cant_sms"]){
			$_SESSION["cant_sms"]=$_SESSION["cant_sms"]+1;
		}
		/*$acceso->objeto->ejecutarSql("select ruta_archivo from config_sms where id_franq='1'");
		if($con=$acceso->objeto->devolverRegistro()){
			$this->ruta=trim($con["ruta_archivo"]);
		}
		*/
		$db = new SQLite3($this->ruta);

		//echo "SELECT * FROM sms_data where uid='$nro_sms'";
		$results = $db->query("SELECT * FROM sms_data where uid='$nro_sms'");

		$i=0;
		if($row = getDato($results)){
			
			$comando=false;
			$id=$row['id'];
			//echo "<$id>";
			//echo "esta";
			$acceso->objeto->ejecutarSql("select nro_sms from sms where nro_sms='$id'");
			if($acceso->objeto->registros<=0){
				//echo "no esta registrado";
				$telefono=trim($row['telefono']);
				//echo "<".strlen($telefono).">:$telefono:";
				if(strlen($telefono)==13){
					$telefono="0".substr($telefono , 3,13);
				}
				//echo "<>:$telefono:";
				$acceso->objeto->ejecutarSql("select persona.apellido,persona.nombre,contrato.id_contrato from contrato,cliente,persona where persona.id_persona=cliente.id_persona and cliente.id_persona=contrato.cli_id_persona and ((telefono ILIKE '%$telefono%') or (telf_casa ILIKE '%$telefono%') or (telf_adic ILIKE '%$telefono%'))");
				if($con=$acceso->objeto->devolverRegistro()){
					//echo "enrto";
					$id_contrato=trim($con["id_contrato"]);
					$nombre=trim($con["nombre"]);
					$apellido=trim($con["apellido"]);
				}
				else{
					$id_contrato="CO00000000";
					$nombre="Desconocido";
					$apellido="Numero";
				}
					
					$mensaje=trim($row['mensaje']);
					$tipo=$row['tipo'];
					$status=$row['status'];
					$fecha=$row['fecha'];
					$hora=$row['hora'];
					
					
					$mensaje=utf8_encode(trim($row['mensaje']));
					$mensaje=str_replace("'","''",$mensaje);
					//echo ": insert into sms(id_contrato,nro_sms,tipo_sms,telefono_sms,fecha_sms,hora_sms,mensaje_sms,status_sms,login) values ('$id_contrato','$id','$tipo','$telefono','$fecha','$hora','$mensaje','$status','ADMIN')";
					
session_start();
$ini_u = $_SESSION["ini_u"];  
$acceso->objeto->ejecutarSql("select id_sms from sms  where (id_sms ILIKE '$ini_u%')   ORDER BY id_sms desc LIMIT 1 offset 0 ");
$id_sms=$ini_u.verCoo($acceso,"id_sms");


					$acceso->objeto->ejecutarSql("insert into sms(id_sms,id_contrato,nro_sms,tipo_sms,telefono_sms,fecha_sms,hora_sms,mensaje_sms,status_sms,login,status) values ('$id_sms','$id_contrato','$id','$tipo','$telefono','$fecha','$hora','$mensaje','$status','ADMIN','FALSE')");
					
						echo utf8_encode('<a href="#" onclick=\'conexionPHP_sms("sms.php","mostrarSMSEsp","'.$id_contrato.'=@'.$id.'=@Recibidos")\'><div id="effect" class="ui-widget-content ui-corner-all">
						<h5 class="ui-widget-header ui-corner-all">'.$apellido.' '.$nombre.'</h5><p>'.$mensaje.'</p>
						</div></a>');
					
					
			
			}
			
		}
		$db->close();
		//return true;
		}
		else{
			echo "false";
		}
	}
	
	public function procesarConsulta($acceso){
		//echo "entro";
		$cable=conexion();
		$cable->objeto->ejecutarSql("select id_sms,telefono_sms,id_contrato,mensaje_sms from sms where status='FALSE' ORDER BY id_sms desc  LIMIT 10 offset 0");
		$i=0;
		while($row=$cable->objeto->devolverRegistro()){
			
			$encontrado=true;
			$comando=false;
			$id=trim($row['id_sms']);
			
				$telefono=trim($row['telefono_sms']);
				if(strlen($telefono)==13){
					$telefono="0".substr($telefono , 3,13);
				}
					
					$id_contrato=trim($row["id_contrato"]);
				
					$mensaje=trim($row['mensaje_sms']);
					//echo ":$mensaje:";
					$id_sms=trim($row['id_sms']);
					
					$mensaje=str_replace("'","''",$mensaje);
					
					$comando=$this->verificaComando($acceso,$id_contrato,$telefono,$mensaje,$id);
				$acceso->objeto->ejecutarSql("Update sms Set status='TRUE' Where id_sms='$id_sms'");	
				$cable->objeto->siguienteRegistro();
		}
		//echo "salio";
	}
}//CLASS
	
function comparaSMS($tipo,$r_tipo,$status,$r_status){
	if($tipo==$r_tipo){
		if($status==$r_status){
			return true;
		}
		else{
			return false;
		}
	}
	else{
		return false;
	}
}
function for_fec($date){
	$valor=explode(".",trim($date));
	$fecha= $valor[2].'-'.$valor[1].'-'.$valor[0];
	return $fecha;
}
function form_fec($date){
	$valor=explode("-",trim($date));
	$fecha= $valor[2].'/'.$valor[1].'/'.$valor[0];
	return $fecha;
}
function transf_hora($H,$i,$s,$d,$m,$Y){
	return date("H:i:s", mktime(date("H", mktime($H, $i, $s, $m, $d, $Y))-6, $i, $s, $m, $d, $Y));
}
function transf_fecha($H,$i,$s,$d,$m,$Y){
	return date("Y-m-d", mktime(date("H", mktime($H, $i, $s, $m, $d, $Y))-6, $i, $s, $m, $d, $Y));
}
function getDato($results){
if($row = $results->fetchArray()){
	//echo ":".trim($row['folder_uid']).":";
	
	$id=trim($row[0]);
	$text=trim($row[3]);
	$sig=substr(trim($row[3]) , 1,1);
	$text=str_replace($sig,'',$text);
	
	$valor=explode("X-IRMC-STATUS:",$text);
	$cad=$valor[1];
	
	$valor=explode("X-IRMC-BOX:",$cad);
	$status=trim($valor[0]);
	$cad=$valor[1];
	
	$valor=explode("X-MESSAGE-TYPE:",$cad);
	$cad=$valor[1];
	
	$valor=explode("BEGIN:VCARD",$cad);
	$tipo=trim($valor[0]);
	$cad='';
	for($i=1;$i<count($valor);$i++)
		$cad=$cad.$valor[$i];
	
	
	if($tipo=="SUBMIT"){
		
	
	
	$valor=explode("TEL:",$cad);
	$cad='';
	$cad=$valor[2];
	
	//echo "<br>$cad:";
		
		//echo "<br>".$text."<br>";
		
	$valor=explode("END:VCARD",$cad);
	$telefono=trim($valor[0]);
	$cad='';
//	echo ":".count($valor).":";
	for($i=1;$i<count($valor);$i++){
		$cad=$cad.$valor[$i];
	}
	
	$valor=explode("BEGIN:VBODY",$cad);
	$cad='';
	for($i=1;$i<count($valor);$i++)
		$cad=$cad.$valor[$i];
	
	$valor=explode("END:VBODY",$cad);
	$mensaje=trim($valor[0]);
	$cad='';
	for($i=1;$i<count($valor);$i++)
		$cad=$cad.$valor[$i];
		
	//	echo "<br>status:$status:tipo:$tipo:telf:$telefono:mensaje:$mensaje:<br><br>";

	}
	else{
	
	
	$valor=explode("TEL:",$cad);
	$cad='';
	for($i=1;$i<count($valor);$i++)
		$cad=$cad.$valor[$i];
	
	$valor=explode("END:VCARD",$cad);
	$telefono=trim($valor[0]);
	$cad='';
//	echo ":".count($valor).":";
	for($i=1;$i<count($valor);$i++){
		$cad=$cad.$valor[$i];
	}
	
	$valor=explode("BEGIN:VBODY",$cad);
	$cad='';
	for($i=1;$i<count($valor);$i++)
		$cad=$cad.$valor[$i];
	
	$valor=explode("END:VBODY",$cad);
	$mensaje=trim($valor[0]);
	$cad='';
	for($i=1;$i<count($valor);$i++)
		$cad=$cad.$valor[$i];
		//
	}
	
	$fecha=substr($mensaje , 5,10);
	$hora=substr($mensaje , 16,8);
	$mensaje=substr($mensaje , 25);
	
	$valor=explode(".",$fecha);
	$d=$valor[0];
	$m=$valor[1];
	$Y=$valor[2];
	
	$valor=explode(":",$hora);
	$H=$valor[0];
	$i=$valor[1];
	$s=$valor[2];
	$hora=transf_hora($H,$i,$s,$d,$m,$Y);
	$fecha=transf_fecha($H,$i,$s,$d,$m,$Y);
	
	
	$dato=array();
	$dato['id']=$id;
	$dato['tipo']=$tipo;
	$dato['status']=$status;
	$dato['telefono']=$telefono;
	$dato['fecha']=$fecha;
	$dato['hora']=$hora;
	$dato['mensaje']=$mensaje;
	return $dato;
}
else{
	return false;
}
}


?>