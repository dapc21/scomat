<?php
class asigna_recibo
{
	private $id_asig;
	private $id_cobrador;
	private $fecha_asig;
	private $obser_asig;
	private $login_asig;
	private $desde;
	private $hasta;
	private $cantidad;
	private $tipo;
	private $serie;

	function __construct($dat)
	{
		$this->id_asig =$dat['id_asig'];
		$this->id_cobrador =$dat['id_cobrador'];
		$this->fecha_asig =$dat['fecha_asig'];
		$this->obser_asig =$dat['obser_asig'];
		$this->login_asig =$dat['login_asig'];
		$this->desde =$dat['desde'];
		$this->hasta =$dat['hasta'];
		$this->cantidad =$dat['cantidad'];
		$this->tipo =$dat['tipo'];
		$this->serie =$dat['serie'];
	}
	public function verid_asig(){
		return $this->id_asig;
	}
	public function vertipo(){
		return $this->tipo;
	}
	public function vercantidad(){
		return $this->cantidad;
	}
	public function verhasta(){
		return $this->hasta;
	}
	public function verdesde(){
		return $this->desde;
	}
	public function verlogin_asig(){
		return $this->login_asig;
	}
	public function verobser_asig(){
		return $this->obser_asig;
	}
	public function verfecha_asig(){
		return $this->fecha_asig;
	}
	public function verid_cobrador(){
		return $this->id_cobrador;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from asigna_recibo where id_asig='$this->id_asig'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{				
		//CARECE DE SERIA A PESAR QUE EN LA CLASE ESTA DECLARADA
		$acceso->objeto->ejecutarSql("insert into asigna_recibo(id_asig,id_cobrador,fecha_asig,obser_asig,login_asig,desde,hasta,cantidad,tipo) values ('$this->id_asig','$this->id_cobrador','$this->fecha_asig','$this->obser_asig','$this->login_asig', '$this->desde', '$this->hasta', '$this->cantidad','$this->tipo')");	
		$this->incluirrecibos($acceso);
	}
	public function modificar($acceso)
	{
		 $acceso->objeto->ejecutarSql("Update asigna_recibo Set id_cobrador='$this->id_cobrador', fecha_asig='$this->fecha_asig', obser_asig='$this->obser_asig', login_asig='$this->login_asig', desde='$this->desde', hasta='$this->hasta', cantidad='$this->cantidad', tipo='$this->tipo' Where id_asig='$this->id_asig'");	
		
	}
	public function eliminar($acceso)
	{
		
		$acceso->objeto->ejecutarSql("delete from recibos where id_asig='$this->id_asig' ");
		 $acceso->objeto->ejecutarSql("delete from asigna_recibo where id_asig='$this->id_asig'");
		
	}
	public function incluirrecibos($acceso)
	{
		require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		$acceso->objeto->ejecutarSql("select id_recibo from recibos  where (id_recibo ILIKE '$ini_u%')   ORDER BY id_recibo desc LIMIT 1 offset 0 ");
		$id_recibo=$ini_u.verCodLong($acceso,"id_recibo");
		
	//	ECHO ":$this->tipo:";
		if($this->tipo=='FACTURA'){
						
			$acceso->objeto->ejecutarSql("select *from parametros where id_param='54' and id_franq='1'");
			$row=row($acceso);
			$dig_recibo_G=trim($row['valor_param']);


			$nro_factura=$this->serie.$this->desde;
			for($i=0;$i<$this->cantidad;$i++){								
				$acceso->objeto->ejecutarSql("insert into recibos(id_recibo,nro_recibo,id_asig,status_pago,tipo) values ('$id_recibo','$nro_factura','$this->id_asig','ASIGNADO','$this->tipo')");
				$nro_factura=$this->serie.verNumero_recibo_v4($acceso,$nro_factura,$dig_recibo_G);
				$id_recibo=$ini_u.verNumero_recibo_v4($acceso,$nro_factura,$dig_recibo_G);
			}	
		}
		else if($this->tipo=='CONTRATO'){
						
			
			$acceso->objeto->ejecutarSql("select *from parametros where id_param='36' and id_franq='1'");
			$row=row($acceso);
			$dig_cont_fisico_G=trim($row['valor_param']);



			$nro_factura=$this->serie.$this->desde;
			for($i=0;$i<$this->cantidad;$i++){
				$acceso->objeto->ejecutarSql("insert into recibos(id_recibo,nro_recibo,id_asig,status_pago,tipo) values ('$id_recibo','$nro_factura','$this->id_asig','ASIGNADO','$this->tipo')");
				$nro_factura=$this->serie.verNumero_recibo_v4($acceso,$nro_factura,$dig_cont_fisico_G);
				$id_recibo=$ini_u.verNumero_recibo_v4($acceso,$nro_factura,$dig_cont_fisico_G);
			}	
		}
	}
	
}
?>