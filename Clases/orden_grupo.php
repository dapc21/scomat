<?php
class orden_grupo
{
	private $id_orden;
	private $id_gt;

	function __construct($dat)
	{
		$this->id_orden = $dat['id_orden'];
		$this->id_gt = $dat['id_gt'];
	}
	public function incluir($acceso){
		$acceso->objeto->ejecutarSql("select * from orden_grupo where id_orden='$this->id_orden'");
		if($acceso->objeto->registros>0){
			return $acceso->objeto->ejecutarSql("Update orden_grupo Set id_gt='$this->id_gt' Where id_orden='$this->id_orden'");	
		}
		else{
			return $acceso->objeto->ejecutarSql("insert into orden_grupo(id_orden,id_gt) values ('$this->id_orden','$this->id_gt')");
		}
	}
		
}
?>