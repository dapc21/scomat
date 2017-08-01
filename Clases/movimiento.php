<?php
class movimiento
{
	private $id_mov;
	private $id_res;
	private $id_tipo_mov;
	private $id_alm;
	private $ref_mov;
	private $mot_mov;
	private $movimiento_material;

	function __construct($dat)
	{
		$this->id_mov = $dat['id_mov'];
		$this->id_res = $dat['id_res'];
		$this->id_tipo_mov = $dat['id_tipo_mov'];
		$this->id_alm = $dat['id_alm'];
		$this->ref_mov = $dat['ref_mov'];
		$this->mot_mov = $dat['mot_mov'];
		$this->movimiento_material = $dat['movimiento_material'];
	}
	public function verid_mov(){
		return $this->id_mov;
	}
	public function vermot_mov(){
		return $this->mot_mov;
	}
	public function verref_mov(){
		return $this->ref_mov;
	}
	public function verid_alm(){
		return $this->id_alm;
	}
	public function verid_tipo_mov(){
		return $this->id_tipo_mov;
	}
	public function verid_res(){
		return $this->id_res;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from movimiento where id_mov='$this->id_mov'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	
	public function consultarTipoMovimiento($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tipo_movimiento where id_tipo_mov='$this->id_tipo_mov' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0){
			while($row = row($acceso)){
				$tipoMov = trim($row['nombre_tipo_mov']);
			}
			return $tipoMov;
		}
		else{
			return false; //probablemente devolver un mensaje que no existe el movimiento
		}
	}
	
	public function incluir($acceso)
	{
		$tipoMov = $this->consultarTipoMovimiento($acceso);
		require_once "movimiento_material.php";
		for ($i=0; $i < count($this->movimiento_material); $i++){
			$MovMat = new movimiento_material($this->movimiento_material[$i]);
			$verificaStock = $MovMat->verificarExistenciaStock($acceso, $tipoMov);
		}
		if( $verificaStock ){
			$incluirMov = $acceso->objeto->ejecutarSql("insert into movimiento(id_mov,id_res,id_tipo_mov,id_alm,ref_mov,mot_mov) values ('$this->id_mov','$this->id_res','$this->id_tipo_mov','$this->id_alm','$this->ref_mov','$this->mot_mov')");
		}
		for ($i=0; $i < count($this->movimiento_material); $i++){
			if( $incluirMov ){
				$MovMat1 = new movimiento_material($this->movimiento_material[$i]);
				$MovMat1->incluir($acceso, $tipoMov);
			}else return false;
		}
		
	}
	
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update movimiento Set id_res='$this->id_res', id_tipo_mov='$this->id_tipo_mov', id_alm='$this->id_alm', ref_mov='$this->ref_mov', mot_mov='$this->mot_mov' Where id_mov='$this->id_mov'");	
	}
	
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from movimiento where id_mov='$this->id_mov'");
	}
}
?>