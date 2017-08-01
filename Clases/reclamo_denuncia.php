<?php
class reclamo_denuncia
{
	private $id_rec;
	private $id_persona;
	private $nro_rec;
	private $tipo_rec;
	private $fecha_rec;
	private $hora_rec;
	private $motivo_rec;
	private $descrip_rec;
	private $denunciado;
	private $status_rec;
	private $dato;

	function __construct($id_rec,$id_persona,$nro_rec,$tipo_rec,$fecha_rec,$hora_rec,$motivo_rec,$descrip_rec,$denunciado,$status_rec,$dato)
	{
		$this->id_rec = $id_rec;
		$this->id_persona = $id_persona;
		$this->nro_rec = $nro_rec;
		$this->tipo_rec = $tipo_rec;
		$this->fecha_rec = $fecha_rec;
		$this->hora_rec = $hora_rec;
		$this->motivo_rec = $motivo_rec;
		$this->descrip_rec = $descrip_rec;
		$this->denunciado = $denunciado;
		$this->status_rec = $status_rec;
		$this->dato = $dato;
	}
	public function verid_rec(){
		return $this->id_rec;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_rec(){
		return $this->status_rec;
	}
	public function verdenunciado(){
		return $this->denunciado;
	}
	public function verdescrip_rec(){
		return $this->descrip_rec;
	}
	public function vermotivo_rec(){
		return $this->motivo_rec;
	}
	public function verhora_rec(){
		return $this->hora_rec;
	}
	public function verfecha_rec(){
		return $this->fecha_rec;
	}
	public function vertipo_rec(){
		return $this->tipo_rec;
	}
	public function vernro_rec(){
		return $this->nro_rec;
	}
	public function verid_persona(){
		return $this->id_persona;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from reclamo_denuncia where id_rec='$this->id_rec'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirreclamo_denuncia($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into reclamo_denuncia(id_rec,id_persona,nro_rec,tipo_rec,fecha_rec,hora_rec,motivo_rec,descrip_rec,denunciado,status_rec) values ('$this->id_rec','$this->id_persona','$this->nro_rec','$this->tipo_rec','$this->fecha_rec','$this->hora_rec','$this->motivo_rec','$this->descrip_rec','$this->denunciado','$this->status_rec')");			
	}
	public function modificarreclamo_denuncia($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update reclamo_denuncia Set id_persona='$this->id_persona', nro_rec='$this->nro_rec', tipo_rec='$this->tipo_rec', fecha_rec='$this->fecha_rec', hora_rec='$this->hora_rec', motivo_rec='$this->motivo_rec', descrip_rec='$this->descrip_rec', denunciado='$this->denunciado', status_rec='$this->status_rec' Where id_rec='$this->id_rec'");	
	}
	public function eliminarreclamo_denuncia($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from reclamo_denuncia where id_rec='$this->id_rec'");
	}
}
?>