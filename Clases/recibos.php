<?php
class recibos
{
	private $nro_recibo;
	private $id_asig;
	private $id_rec;
	private $status_pago;
	private $tipo;
	private $obser;

	function __construct($dat)
	{
		$this->nro_recibo =$dat['nro_recibo'];
		$this->id_asig =$dat['id_asig'];
		$this->id_rec =$dat['id_rec'];
		$this->status_pago =$dat['status_pago'];
		$this->tipo =$dat['tipo'];
		$this->obser =$dat['obser'];
	}
	public function vernro_recibo(){
		return $this->nro_recibo;
	}
	public function vertipo(){
		return $this->tipo;
	}
	public function verstatus_pago(){
		return $this->status_pago;
	}
	public function verid_rec(){
		return $this->id_rec;
	}
	public function verid_asig(){
		return $this->id_asig;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from recibos where nro_recibo='$this->nro_recibo'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		$acceso->objeto->ejecutarSql("select id_recibo from recibos  where (id_recibo ILIKE '$ini_u%')   ORDER BY id_recibo desc LIMIT 1 offset 0 ");
		$id_recibo=$ini_u.verCodLong($acceso,"id_recibo");
		
		 $acceso->objeto->ejecutarSql("insert into recibos(id_recibo,nro_recibo,id_asig,id_rec,status_pago,tipo) values ('$id_recibo','$this->nro_recibo','$this->id_asig','$this->id_rec','$this->status_pago','$this->tipo')");			
		
	}
	public function modificar($acceso)
	{
		 $acceso->objeto->ejecutarSql("Update recibos Set id_rec='$this->id_rec', status_pago='$this->status_pago', obser='$this->obser' Where nro_recibo='$this->nro_recibo' and tipo='$this->tipo'");	
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from recibos where nro_recibo='$this->nro_recibo' and tipo='$this->tipo'");
		
	}
}
?>