<?php
class servidor
{
	private $id_servidor;
	private $nombre_servidor;
	private $direc_servidor;
	private $status_servidor;
	private $sincronizar;
	private $status_ser;
	private $direccio_ip;
	private $usuario_p;
	private $clave_p;
	private $database;

	function __construct($id_servidor,$nombre_servidor,$direc_servidor,$status_servidor,$sincronizar,$status_ser,$direccio_ip,$usuario_p,$clave_p,$database)
	{
		$this->id_servidor = $id_servidor;
		$this->nombre_servidor = $nombre_servidor;
		$this->direc_servidor = $direc_servidor;
		$this->status_servidor = $status_servidor;
		$this->sincronizar = $sincronizar;
		$this->status_ser = $status_ser;
		$this->direccio_ip = $direccio_ip;
		$this->usuario_p = $usuario_p;
		$this->clave_p = $clave_p;
		$this->database = $database;
	}
	public function verid_servidor(){
		return $this->id_servidor;
	}
	public function verdatabase(){
		return $this->database;
	}
	public function verclave_p(){
		return $this->clave_p;
	}
	public function verusuario_p(){
		return $this->usuario_p;
	}
	public function verdireccio_ip(){
		return $this->direccio_ip;
	}
	public function verstatus_ser(){
		return $this->status_ser;
	}
	public function versincronizar(){
		return $this->sincronizar;
	}
	public function verstatus_servidor(){
		return $this->status_servidor;
	}
	public function verdirec_servidor(){
		return $this->direc_servidor;
	}
	public function vernombre_servidor(){
		return $this->nombre_servidor;
	}
	public function validaExistencia($acceso){
		$acceso->objeto->ejecutarSql("select * from servidor where id_servidor='$this->id_servidor'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirservidor($acceso)
	{
		
		$acceso->objeto->ejecutarSql("insert into servidor(id_servidor,nombre_servidor,direc_servidor,status_servidor,sincronizar,status_ser,direccio_ip,usuario_p,clave_p,database) values ('$this->id_servidor','$this->nombre_servidor','$this->direc_servidor','$this->status_servidor','$this->sincronizar','$this->status_ser','$this->direccio_ip','$this->usuario_p','$this->clave_p','$this->database')");		
		if($this->status_servidor=='LOCAL'){
			$acceso->objeto->ejecutarSql("Update servidor Set status_servidor='EXTERNO' Where id_servidor<>'$this->id_servidor'");
		}	
								
	}
	public function modificarservidor($acceso)
	{
		
		$acceso->objeto->ejecutarSql("Update servidor Set nombre_servidor='$this->nombre_servidor', direc_servidor='$this->direc_servidor', status_servidor='$this->status_servidor', sincronizar='$this->sincronizar', status_ser='$this->status_ser', direccio_ip='$this->direccio_ip', usuario_p='$this->usuario_p', clave_p='$this->clave_p', database='$this->database' Where id_servidor='$this->id_servidor'");	
		if($this->status_servidor=='LOCAL'){
			$acceso->objeto->ejecutarSql("Update servidor Set status_servidor='EXTERNO' Where id_servidor<>'$this->id_servidor'");
		}		
				
	}
	public function eliminarservidor($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("delete from servidor where id_servidor='$this->id_servidor'");
				
	}
}
?>