<?php
class cirre_diario
{
	private $id_cierre;
	private $fecha_cierre;
	private $hora_cierre;
	private $monto_total;
	private $obser_cierre;
	private $reporte_z;
	private $id_franq;

	function __construct($id_cierre,$fecha_cierre,$hora_cierre,$monto_total,$obser_cierre,$reporte_z,$id_franq='0')
	{
		$this->id_cierre = $id_cierre;
		$this->fecha_cierre = $fecha_cierre;
		$this->hora_cierre = $hora_cierre;
		$this->monto_total = $monto_total;
		$this->obser_cierre = $obser_cierre;
		$this->reporte_z = $reporte_z;
		$this->id_franq = $id_franq;
	}
	public function verid_cierre(){
		return $this->id_cierre;
	}
	public function verreporte_z(){
		return $this->reporte_z;
	}
	public function verobser_cierre(){
		return $this->obser_cierre;
	}
	public function vermonto_total(){
		return $this->monto_total;
	}
	public function verhora_cierre(){
		return $this->hora_cierre;
	}
	public function verfecha_cierre(){
		return $this->fecha_cierre;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from cirre_diario where id_cierre='$this->id_cierre'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluircirre_diario($acceso)
	{
		
		//echo "insert into cirre_diario(id_cierre,fecha_cierre,hora_cierre,monto_total,obser_cierre) values ('$this->id_cierre','$this->fecha_cierre','$this->hora_cierre','$this->monto_total','$this->obser_cierre')";
		$acceso->objeto->ejecutarSql("insert into cirre_diario(id_cierre,fecha_cierre,hora_cierre,monto_total,obser_cierre,reporte_z,id_franq) values ('$this->id_cierre','$this->fecha_cierre','$this->hora_cierre','$this->monto_total','$this->obser_cierre','$this->reporte_z','$this->id_franq')");			
		
		$fecha= date("Y-m-d");
		$dato = lectura1($acceso,"select *from vista_caja where fecha_caja='$fecha' and status_caja_cob='CERRADA'");
		//echo "\n:".count($dato).":";
		for($i=0;$i<count($dato);$i++)
		{
			$id_caja_cob=trim($dato[$i]["id_caja_cob"]);
			$acceso->objeto->ejecutarSql("insert into cierre_pago(id_caja_cob,id_cierre) values ('$id_caja_cob','$this->id_cierre')");
		}
		
		$fecha= date("Y-m-d");
		//echo "select *from cirre_diario_et where fecha_cierre='$fecha'";
		$dato = lectura1($acceso,"select *from cirre_diario_et where fecha_cierre='$fecha'");
		//echo "\n:".count($dato).":";
		for($i=0;$i<count($dato);$i++)
		{
			$id_est=trim($dato[$i]["id_cierre"]);
			//echo "insert into cierre_et_pago(id_est,id_cierre) values ('$id_est','$this->id_cierre')";
			$acceso->objeto->ejecutarSql("insert into cierre_et_pago(id_est,id_cierre) values ('$id_est','$this->id_cierre')");
		}
		
		$acceso->objeto->ejecutarSql("update parametros set valor_param='0' where id_param='35'");
		/*
		require_once "Graficos/Clases/estadisticas.php";
		$est=new estadisticas();
		$est->guardarDatos($acceso);
		*/
		return true;
	}
	public function modificarcirre_diario($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update cirre_diario Set id_franq='$this->id_franq', fecha_cierre='$this->fecha_cierre',   hora_cierre='$this->hora_cierre', monto_total='$this->monto_total', obser_cierre='$this->obser_cierre', reporte_z='$this->reporte_z' Where id_cierre='$this->id_cierre'");	
	}
	public function eliminarcirre_diario($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from cirre_diario where id_cierre='$this->id_cierre'");
	}
}
function lectura1($acceso,$sql){
	//echo "\n$sql";
	$acceso->objeto->ejecutarSql($sql);
	$i=0;
	$datoPaq=array();
	while($row=$acceso->objeto->devolverRegistro()){
		$datoPaq[$i]=$row;
		$i++;
		$acceso->objeto->siguienteRegistro();
	}
	
	return $datoPaq;
}
?>