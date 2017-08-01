<?php
class pagodeposito
{
	private $id_pd;
	private $id_contrato;
	private $fecha_reg;
	private $hora_reg;
	private $login_reg;
	private $fecha_dep;
	private $banco;
	private $numero_ref;
	private $fecha_conf;
	private $hora_conf;
	private $login_conf;
	private $status_pd;
	private $fecha_proc;
	private $tipo_dt;
	private $login_proc;
	private $monto_dep;
	private $cedula_titular;
	private $obser_p;

	function __construct($id_pd,$id_contrato,$fecha_reg,$hora_reg,$login_reg,$fecha_dep,$banco,$numero_ref,$fecha_conf,$hora_conf,$login_conf,$status_pd,$fecha_proc,$tipo_dt,$login_proc,$monto_dep,$cedula_titular='',$obser_p='')
	{
		$this->id_pd = $id_pd;
		$this->id_contrato = $id_contrato;
		$this->fecha_reg = $fecha_reg;
		$this->hora_reg = $hora_reg;
		$this->login_reg = $login_reg;
		$this->fecha_dep = $fecha_dep;
		$this->banco = $banco;
		$this->numero_ref = $numero_ref;
		$this->fecha_conf = $fecha_conf;
		$this->hora_conf = $hora_conf;
		$this->login_conf = $login_conf;
		$this->status_pd = $status_pd;
		$this->fecha_proc = $fecha_proc;
		$this->tipo_dt = $tipo_dt;
		$this->login_proc = $login_proc;
		$this->monto_dep = $monto_dep;
		$this->cedula_titular = $cedula_titular;
		$this->obser_p = $obser_p;
	}
	public function verid_pd(){
		return $this->id_pd;
	}
	public function vermonto_dep(){
		return $this->monto_dep;
	}
	public function verlogin_proc(){
		return $this->login_proc;
	}
	public function vertipo_dt(){
		return $this->tipo_dt;
	}
	public function verfecha_proc(){
		return $this->fecha_proc;
	}
	public function verstatus_pd(){
		return $this->status_pd;
	}
	public function verlogin_conf(){
		return $this->login_conf;
	}
	public function verhora_conf(){
		return $this->hora_conf;
	}
	public function verfecha_conf(){
		return $this->fecha_conf;
	}
	public function vernumero_ref(){
		return $this->numero_ref;
	}
	public function verbanco(){
		return $this->banco;
	}
	public function verfecha_dep(){
		return $this->fecha_dep;
	}
	public function verlogin_reg(){
		return $this->login_reg;
	}
	public function verhora_reg(){
		return $this->hora_reg;
	}
	public function verfecha_reg(){
		return $this->fecha_reg;
	}
	public function verid_contrato(){
		return $this->id_contrato;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from pagodeposito where id_pd='$this->id_pd'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirpagodeposito($acceso)
	{
		
		require_once "procesos.php";
		
		 $acceso->objeto->ejecutarSql("insert into pagodeposito(id_pd,id_contrato,fecha_reg,hora_reg,login_reg,fecha_dep,banco,numero_ref,fecha_conf,hora_conf,login_conf,status_pd,fecha_proc,tipo_dt,login_proc,monto_dep,cedula_titular,obser_p) values ('$this->id_pd','$this->id_contrato','$this->fecha_reg','$this->hora_reg','$this->login_reg','$this->fecha_dep','$this->banco','$this->numero_ref','$this->fecha_conf','$this->hora_conf','$this->login_conf','$this->status_pd','$this->fecha_proc','$this->tipo_dt','$this->login_proc','$this->monto_dep','$this->cedula_titular','$this->obser_p')");	
		 
		conciliar_pago_cli($acceso,$this->id_pd);
		
	}
	public function modificarpagodeposito($acceso)
	{
		require_once "procesos.php";
		
		 $acceso->objeto->ejecutarSql("Update pagodeposito Set id_contrato='$this->id_contrato', fecha_reg='$this->fecha_reg', hora_reg='$this->hora_reg', login_reg='$this->login_reg', fecha_dep='$this->fecha_dep', banco='$this->banco', numero_ref='$this->numero_ref', tipo_dt='$this->tipo_dt', monto_dep='$this->monto_dep' , cedula_titular='$this->cedula_titular' , obser_p='$this->obser_p' Where id_pd='$this->id_pd'");	
		 
		 conciliar_pago_cli($acceso,$this->id_pd);
		
	}
	public function eliminarpagodeposito($acceso)
	{
		
		
		 $acceso->objeto->ejecutarSql("delete from pagodeposito where id_pd='$this->id_pd'");
		
	}
	public function registrar_deppagodeposito($acceso)
	{
		require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
		require_once "pagos.php";
		require_once "pago_servicio.php";
		require_once "detalle_tipopago.php";
		$login_proc = $_SESSION["login"];
		$id_caja_cob=$this->id_contrato;
		$valor=explode("-@-",$this->fecha_reg);
		
		$ip_est = $_SERVER['REMOTE_ADDR'];
		$acceso->objeto->ejecutarSql("select * from estacion_trabajo where ip_est='$ip_est' and status_est='IMPRESORAFISCAL'");
		if($row=row($acceso)){
			$id_est=trim($row['id_est']);
			$nombre_est=trim($row['nombre_est']);
		}
	
		for($y=0;$y<count($valor)-1;$y++)
		{
			
		
		
		
			$id_pd=$valor[$y];
			$acceso->objeto->ejecutarSql("select id_contrato,banco,numero_ref,monto_dep,tipo_dt from pagodeposito where id_pd='$id_pd'");
			if($row=row($acceso)){
					$id_contrato=trim($row['id_contrato']);
					$banco=trim($row['banco']);
					$numero=trim($row['numero_ref']);
					$monto_dep=trim($row['monto_dep']);
					$tipo_dt=trim($row['tipo_dt']);
					
					if($tipo_dt=="DEPOSITO"){
						$id_tipo_pago="TPA00003";
					}else{
						$id_tipo_pago="TPA00004";
					}
					//echo "<br>select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 ";
					$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
					$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
					$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob ORDER BY inc desc LIMIT 1 offset 0 "); 
					$nro_factura = verCodFact($acceso,"nro_factura");
					$fecha_pago=date("Y-m-d");
					$fecha_factura=date("Y-m-d");
					$hora_pago=date("H:i:s");
					$monto_pago=$monto_dep+0;
					$obser_pago="pago en lotes";
					$status_pago="PAGADO";
					$base_imp=$monto_pago/1.12;
					$monto_iva=$base_imp*0.12;
					$n_credito='';
					$islr=0;
					$monto_reten=0;
					$por_reten=0;
					$por_iva=12;
					$desc_pago=0;
					$obj_pago=new pagos($id_pago,$id_caja_cob,$fecha_pago,$hora_pago,$monto_pago,$obser_pago,$status_pago,$nro_factura,$id_contrato,$nro_control,$desc_pago,$por_iva,$monto_iva,$por_reten,$monto_reten,$base_imp,$islr,$n_credito,$fecha_factura);
					$obj_pago->incluirpagos($acceso);
					
					$obj_tipopago=new detalle_tipopago($id_tipo_pago,$id_pago,$banco,$numero,$monto_pago,'');
					$obj_tipopago->incluirdetalle_tipopago($acceso);
					
					$id_select = ajusta_cargo_pago($acceso,$id_contrato,$monto_pago);
				//	echo "$id_select";
					$cargo=explode("=@",$id_select);
					for($j=1;$j<count($cargo);$j++)
					{
						$id_cont_serv=$cargo[$j];
						$acceso->objeto->ejecutarSql("select * from contrato_servicio_deuda where id_cont_serv='$id_cont_serv'");
						if($row=$acceso->objeto->devolverRegistro()){		
					//		echo "EXISTE $id_cont_serv: ";
							$obj_pago_servicio=new pago_servicio($id_pago,$id_cont_serv,'');
							$obj_pago_servicio->incluirpago_servicio($acceso);
						}
					}
				$acceso->objeto->ejecutarSql("Update pagodeposito Set  fecha_proc='$fecha_pago', login_proc='$login_proc', status_pd='PROCESADO' Where id_pd='$id_pd'");
				
			}
		}
	}
}
?>